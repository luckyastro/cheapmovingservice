<?php

class Offers
{

	public $offer_list = array();
	public $funnel_options = array();

	// Constructor
	function __construct()
	{
	}
	
	// Fetch all data relating to a given funnel (funnel / site ID must be unique combination)
	public function getOffers( $cur_page )
	{
		global $db, $conf;
		
		$this->offer_list = $this->getOfferData( $cur_page );

		return $this->offer_list;
	}

	// Grab the data for an individual offer based on its ID or whatever offer should be displayed based on a site ID
	public function getOfferData( $cur_page )
	{
		global $db, $conf, $device_type;

		// Get the current URL
		$cur_page = cur_page( $cur_page );

		// Get all main/regular offers for this site ID
		$sql = "
		SELECT
			o.id, o.name, o.label, o.link, o.mobile_link, o.offer_type, o.pixels,
			o.dayparting, o.dayparting_offer1, o.dayparting_offer1_days, o.dayparting_offer1_start_hour, o.dayparting_offer1_end_hour
		FROM offers o
		LEFT JOIN offers_funnels of ON o.funnel_id = of.id
		WHERE 
			of.s_id = '" . $conf['s_id'] . "'
			AND of.url = '" . $db->makeSafe( $cur_page ) . "'
			AND o.offer_type = '0'
			AND o.status = '1'
		ORDER BY priority ASC
		";
		$q = $db->query( $sql );
		if ( $db->numrows( $q ) > 0 )
		{
			$num = 1;
			while( $f = $db->fetchassoc( $q ) )
			{
				// Set the defaults
				$offer_id = $f['id'];
				$label = $f['label'];
				$link = $f['link'];
				$offer_type = $f['offer_type'];
				$name = $f['name'];
				$pixels = $f['pixels'];
				
				// Override w/ a mobile link if desired/possible
				if ( $this->getMobileStatus( $f, $device_type ) == true )
				{
					$link = $f['mobile_link'];
				}
			
				// Check if we should override this offer with a dayparting offer
				if ( $this->getDayPartingStatus( $f ) == true )
				{
					// Look up the dayparting information
					$sql = "
					SELECT
						o.id, o.name, o.label, o.link, o.mobile_link, o.offer_type, o.pixels
					FROM offers o
					LEFT JOIN offers_funnels of ON o.funnel_id = of.id
					WHERE 
						o.id = '" . $f['dayparting_offer1'] . "'
						AND o.status = '1'
					";
					$q2 = $db->query( $sql );
					if ( $db->numrows( $q2 ) > 0 )
					{
						$f2 = $db->fetchassoc( $q2 );
						
						// Mobile link or not
						if ( $this->getMobileStatus( $f2, $device_type ) == true )
						{
							$link = $f2['mobile_link'];
						}
						else
						{
							$link = $f2['link'];
						}
						
						$offer_id = $f2['id'];
						$label = $f2['label'];
					    $offer_type = $f2['offer_type'];
						$name = $f2['name'];
						$pixels = $f2['pixels'];
					}
				}
				
				$this->offer_list[$num]['num'] = $num;
				$this->offer_list[$num]['offer_id'] = $offer_id;
				$this->offer_list[$num]['offer_type'] = $offer_type;
				$this->offer_list[$num]['name'] = $name;
				$this->offer_list[$num]['label'] = $label;
				$this->offer_list[$num]['link'] = $link;
				$this->offer_list[$num]['pixels'] = $pixels;
				
				$num++;
			}
		}
		else
		{
			// Return existing session if it exists
			return $_SESSION['OFFER_LIST'];
		}
		
		return $this->offer_list;
	}
	
	// Get a list of options that are funnel-specific, not offer-specific
	public function getFunnelOptions( $cur_page )
	{
		global $db, $conf;
		
		// Get the current URL
		$cur_page = cur_page( $cur_page );
		
		// Get all main/regular offers for this site ID
		$sql = "
		SELECT
			of.name, of.url, of.redirect_url
		FROM offers_funnels of
		WHERE 
			of.s_id = '" . $conf['s_id'] . "'
			AND of.url = '" . $db->makeSafe( $cur_page ) . "'
			AND of.status = '1'
		";
		$q = $db->query( $sql );
		if ( $db->numrows( $q ) > 0 )
		{
			$f = $db->fetchassoc( $q );
			
			// Count total number of offers
			$sql = "
			SELECT
				COUNT(*) AS total_offers
			FROM offers_funnels of
			LEFT JOIN offers o ON o.funnel_id = of.id
			WHERE 
				of.s_id = '" . $conf['s_id'] . "'
				AND of.url = '" . $db->makeSafe( $cur_page ) . "'
				AND of.status = '1'
				AND o.offer_type = '0'
			";
			$q2 = $db->query( $sql );
			$f2 = $db->fetcharray( $q2 );
			
			// Set the defaults
			$this->funnel_options['name'] = $f['name'];
			$this->funnel_options['url'] = $f['url'];
			$this->funnel_options['redirect_url'] = $f['redirect_url'];
			$this->funnel_options['total_offers'] = $f2['total_offers'];
			
			// Since we're setting this on the initial lander/site combo, reset the session offer variables
			$_SESSION['CLICK_COUNT'] = 0;
			$_SESSION['LAST_CLICK'] = '';
		}
		else
		{
			// Return existing funnel options if they exist
			return $_SESSION['FUNNEL_OPTIONS'];
		}
		
		return $this->funnel_options;
	}
	
	// Determine if a mobile link should and can be used
	public function getMobileStatus( $data, $device_type )
	{
		// Check if we should override the offer link with a mobile offer link			
		if ( $data['mobile_link'] != '' && ( $device_type == 'tablet' || $device_type == 'phone' ) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// Will determine if dayparting is currently active/inactive based on the hour/day/etc.
	public function getDayPartingStatus( $data )
	{
		global $db, $conf;
		
		$start_hour = $data['dayparting_offer1_start_hour'];
		$end_hour = $data['dayparting_offer1_end_hour'];

		// 0 for Sunday through 6 for Saturday
		$cur_day = date( 'w' );

		$trigger_days = explode( ':', $data['dayparting_offer1_days'] );
		$cur_hour = date( 'H' );
		
		// If any hour is midnight, change it to 24 so we can calculate properly
		$cur_hour = ( $cur_hour == '00' ) ? '24' : $cur_hour;
		$start_hour = ( $start_hour == '00' ) ? '24' : $start_hour;
		$end_hour = ( $end_hour == '00' ) ? '24' : $end_hour;
		
		if ( 
			$data['dayparting'] == 1
			&& ( in_array( $cur_day, $trigger_days ) !== false )
			&& ( $cur_hour >= $start_hour && $cur_hour < $end_hour )
			&& $data['dayparting_offer1'] != 0
			)	
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

?>