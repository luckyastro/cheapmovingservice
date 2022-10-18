<?php

include 'includes/config.php';
include 'includes/includes.php';
// If bot detected, redirect to this URL
define( 'BOT_REDIRECT', 'http://www.google.com' );

// Verticals
define('MOVING', 1);
define('CAR_SHIPPING', 4);
define('FINDING_PACKING_SUPPLIES', 6);
define('CONTRACTOR_TO_CONTACT_YOU', 7);
define('PANELS_ON_NEW_HOME', 8);

// New service provider leads
if ( $_REQUEST['lead_type'] == 'sp' )
{
	// Defaults
	$area = 'register';

    // Random password generator
    $password = substr(md5(rand(11111,99999)), 0, 5);

	// For now, keep bot detection disabled
	$email = $_REQUEST['email'];

	// Redirect them back to the opt in page if the emails don't match
	if ( $_REQUEST['source_id'] == '21645' )
    {
        if ( $_REQUEST['email'] != $_REQUEST['email2'] )
        {
            header( 'Location: /buy-moving-leads.php?'
                . 'firstname=' . $_REQUEST['firstname']
                . '&lastname=' . $_REQUEST['lastname']
                . '&email=' . $_REQUEST['email']
                . '&email2=' . $_REQUEST['email2']
                . '&phone1=' . $_REQUEST['phone1']
                . '&company=' . $_REQUEST['company']
                . '&status_1=' . $_REQUEST['status_1']
                . '&status_2=' . $_REQUEST['status_2']
                . '&status_3=' . $_REQUEST['status_3']
                . '&status_4=' . $_REQUEST['status_4']
                . '&error=email_match_fail'
            );
            exit();
        }
    }
	
	// Cleanse phone 1
	$_REQUEST['phone1'] = preg_replace( '/[^0-9.]+/', '', $_REQUEST['phone1'] );
	
	if ( check_email( $_REQUEST['email'] ) == false )
	{
		$error_msg .= '<li>The email address is not properly formatted.';
	}
	if ( $_REQUEST['lastname'] == '' && $_REQUEST['firstname'] != '' )
	{
		// Split up the first_name into two names
		$name_data = explode( ' ', $_REQUEST['firstname'] );
		$_REQUEST['firstname'] = $name_data[0];
		$_REQUEST['lastname'] = $name_data[1];
	}

	// Account for various formats
	$phone_length = strlen( $_REQUEST['phone1'] );
	if ( $phone_length > 10 )
	{
		$start = $phone_length - 10;
		$_REQUEST['phone1'] = substr( $_REQUEST['phone1'], $start, 10 );
	}
	
	$_REQUEST['phone1_area_code'] = substr( $_REQUEST['phone1'], 0, 3 );
	$_REQUEST['phone1_region_code'] = substr( $_REQUEST['phone1'], 3, 3 );
	$_REQUEST['phone1_line_code'] = substr( $_REQUEST['phone1'], 6, 4 );
	
	if ( $error_msg == '' )
	{
		// If last name is blank, just use the first name again
		if ( $_REQUEST['lastname'] == '' )
		{
			$_REQUEST['lastname'] = $_REQUEST['firstname'];
		}
	
		$sql = "
		INSERT INTO users
		(
			u_email,
			u_pass,
			u_first,
			u_last,
			u_ip,
			u_date,
			u_area,
			u_type,
			u_status
		)
		VALUES
		(
			'" . $db->makeSafe( $_REQUEST['email'] ) . "',
			'" . $db->makeSafe( $password ) . "',
			'" . $db->makeSafe( $_REQUEST['firstname'] ) . "',
			'" . $db->makeSafe( $_REQUEST['lastname'] ) . "',
			'" . $db->makeSafe( $_SERVER['REMOTE_ADDR'] ) . "',
			'" . $db->makeSafe( date( 'Y-m-d H:i:s' ) ) . "',
			'" . $db->makeSafe( $area ) . "',
			'" . $db->makeSafe( $_REQUEST['u_type'] ) . "',
			'1'
		)
		";
		$q = $db->query( $sql );
		$user_id = $db->getLastID();

        // Add regular user permissions
        $permissions = array( 1, 14 );
        add_permissions( $user_id, $permissions );
		
		if ( $_REQUEST['p_type'] != '0' )
		{
		    // Service provider profile
		    $sql = "
		    INSERT INTO providers
		    (
		        u_id,
		        p_type,
		        date_added,
		        company,
		        source_id,
		        lead_source,
		        lander
		    )
		    VALUES
		    (
		        '" . $user_id . "',
		        '" . $db->makeSafe( $_REQUEST['p_type'] ) . "',
		        '" . date( 'Y-m-d') . "',
		        '" . $db->makeSafe( $_REQUEST['company'] ) . "',
		        '" . $db->makeSafe( $_REQUEST['source_id'] ) . "',
		        '" . $db->makeSafe( $_REQUEST['lead_source'] ) . "',
		        '" . $db->makeSafe( $_REQUEST['lander'] ) . "'
		    )
		    ";
		    $db->query( $sql );

            // Add service provider-specific permissions
            $permissions = array( 34, 35, 36, 37, 38 );
            add_permissions( $user_id, $permissions );
		}
		
			if ( $state1 == $state2 ) {
				$redirect = ( $_REQUEST['redirect'] != '' ) ? $_REQUEST['redirect'] : '/page-LOthankyou.php';
		}else{
				$redirect = ( $_REQUEST['redirect'] != '' ) ? $_REQUEST['redirect'] : '/page-LDthankyou.php';
		} 	
	}
}
elseif ( $_REQUEST['stage'] == '1' )
{	
	$bot_reason = '';
	$verticals_array = array(
		"moving"                    => MOVING,
		"car_shipping"              => $_REQUEST['status_1'] === "1" ? CAR_SHIPPING : 0, 
		"finding_packing_supplies"  => $_REQUEST['status_2'] === "1" ? FINDING_PACKING_SUPPLIES : 0,
		"contractor_to_contact_you" => $_REQUEST['status_3'] === "1" ? CONTRACTOR_TO_CONTACT_YOU : 0,
		"panels_on_new_home"        => $_REQUEST['status_4'] === "1" ? PANELS_ON_NEW_HOME : 0
	);
	$contains_vertical_car_shipping = false;
	
	// Ignore index leads
	/*
	if ( $_REQUEST['lander'] == 'index.php' )
	{
		header( 'Location: /page-thankyou.php' );
		exit();
	}
	
	// Hidden email spam trap
	if ( $_REQUEST['email'] != '' )
	{
		$bot_reason = '0';
		$email = $_REQUEST['email'];
	}
	// Better email validation
	elseif ( check_email( $_REQUEST['e14'] ) == false )
	{
		$bot_reason = '1';
		$email = $_REQUEST['e14'];
	}
	else
	{
		$email = $_REQUEST['e14'];
	}
	*/
	
	// For now, keep bot detection disabled
	$email = $_REQUEST['email'];
	
	// Cleanse phone 1
	$_REQUEST['phone1'] = preg_replace( '/[^0-9.]+/', '', $_REQUEST['phone1'] );
	
	// Better, server-side validation
	/*
	if ( $bot_reason != '' )
	{	
		// Log this bad email
		$sql = "
		INSERT INTO leads_bots
		(
			s_id,
			firstname,
			lastname,
			email,
			phone1,
			address1,
			zip,
			created,
			captured,
			ipaddr,
			referrer,
			session_id,
			universal_lead_id,
			device,
			job_search,
			lander,
			user_agent,
			bot_reason
		)
		VALUES
		(
			'" . $conf['s_id'] . "',
			'" . $db->makeSafe( $_REQUEST['firstname'] ) . "',
			'" . $db->makeSafe( $_REQUEST['lastname'] ) . "',
			'" . $db->makeSafe( $email ) . "',
			'" . $db->makeSafe( $_REQUEST['phone1'] ) . "',
			'" . $db->makeSafe( $_REQUEST['address1'] ) . "',
			'" . $db->makeSafe( $_REQUEST['zip'] ) . "',
			'" . date( 'Y-m-d H:i:s' ) . "',
			'" . date( 'Y-m-d H:i:s' ) . "',
			'" . $_SERVER['REMOTE_ADDR'] . "',
			'" . $_SERVER['HTTP_REFERER'] . "',
			'" . session_id() . "',
			'" . $db->makeSafe( $_REQUEST['universal_lead_id'] ) . "',
			'" . $db->makeSafe( $_REQUEST['device'] ) . "',
			'" . $db->makeSafe( $_REQUEST['job_search'] ) . "',
			'" . $db->makeSafe( $_REQUEST['lander'] ) . "',
			'" . $db->makeSafe( $_SERVER['HTTP_USER_AGENT'] ) . "',
			'" . $db->makeSafe( $bot_reason ) . "'
		)
		ON DUPLICATE KEY UPDATE 
			refresh = refresh + 1
		";
		$q = $db->query( $sql );
		
		// Bounce back to the lander
		if ( $_REQUEST['lander'] != '' )
		{	
			header( 'Location: /' . $_REQUEST['lander'] );
			exit();
		}
	}
	*/
	if ( check_email( $_REQUEST['email'] ) == false )
	{
		$error_msg .= '<li>The email address is not properly formatted.';
	}
	if ( $_REQUEST['lastname'] == '' && $_REQUEST['firstname'] != '' )
	{
		// Split up the first_name into two names
		$name_data = explode( ' ', $_REQUEST['firstname'] );
		$_REQUEST['firstname'] = $name_data[0];
		$_REQUEST['lastname'] = $name_data[1];
	}

	// Account for various formats
	
	$phone_length = strlen( $_REQUEST['phone1'] );
	if ( $phone_length > 10 )
	{
		$start = $phone_length - 10;
		$_REQUEST['phone1'] = substr( $_REQUEST['phone1'], $start, 10 );
	}
	
	$_REQUEST['phone1_area_code'] = substr( $_REQUEST['phone1'], 0, 3 );
	$_REQUEST['phone1_region_code'] = substr( $_REQUEST['phone1'], 3, 3 );
	$_REQUEST['phone1_line_code'] = substr( $_REQUEST['phone1'], 6, 4 );
	
	// If move_date is in the past or too far into the future
  $cur_date = date( 'Y-m-d' );
	$move_date = date( 'Y-m-d', strtotime( $_REQUEST['move_date'] ) );
	$tomorrow = date( 'Y-m-d', strtotime( 'tomorrow' ) );
	$dayaftertomorrow = date( 'Y-m-d', strtotime( 'now +2 days' ) );
	$four_months = date( 'Y-m-d', strtotime( 'now +4 months' ) );

	// Past move date or move date is today
	if ( $move_date <= $cur_date || $move_date == $cur_date || $move_date == $tomorrow || $move_date == $dayaftertomorrow )
	{
		$_REQUEST['move_date'] = date( 'Y-m-d', strtotime( 'now +3 days' ) );
	}
	// Move date too far into the future
	elseif ( $move_date >= $four_months )
	{
		$_REQUEST['move_date'] = date( 'Y-m-d', strtotime( 'now +2 months' ) );
	}

	$move_date_arr = explode("-", $_REQUEST['move_date']);
	$_REQUEST['move_year'] = $move_date_arr[0];
	$_REQUEST['move_month'] = $move_date_arr[1];
	$_REQUEST['move_day'] = $move_date_arr[2];

	// Proceed if no errors
	if ( $error_msg == '' )
	{
		// Auto leads
		if ( $_REQUEST['auto'] != '' || ( $_REQUEST['car-models'] != '' && $_REQUEST['car-makes'] != '' && $_REQUEST['car-years'] != '' ) )
		{
				$skip_auto_lead = false;

				// Check for keywords like 'no', 'none', etc.
				$no_keywords = array(
						'no', 'na', 'n/a', 'none', 'maybe'
				);
				foreach( $no_keywords AS $no_keyword )
				{
						if ( strtolower( $_REQUEST['auto'] ) == $no_keyword )
						{
								$skip_auto_lead = true;
						}
				}
				
				if ( $skip_auto_lead == false )
				{
						$move_auto = 1;

						// Hardcoded settings for auto transport leads via a site
						$vertical_id = 4; // 4 - vertical ID for auto transport leads based on verticals table
						$lead_intake_type = 5; // 5 - site optin is the source

						// Lead source network
						$lead_source_network = ( $_REQUEST['lead_source_network'] != '' ) ? $_REQUEST['lead_source_network'] : 0;

						if ( $_REQUEST['auto'] != '' )
						{
								// Grab the year / make / model from the string
								$auto_data = explode( ' ', $_REQUEST['auto'] );
								$auto_year = $auto_data[0];
								$auto_make = $auto_data[1];
								$auto_model = $auto_data[2];
						}
						elseif ( $_REQUEST['car-models'] != '' && $_REQUEST['car-makes'] != '' && $_REQUEST['car-years'] != '' )
						{
								$auto_year = $_REQUEST['car-years'];
								$auto_make = $_REQUEST['car-makes'];
								$auto_model = $_REQUEST['car-models'];
						}

						// Look up city/state values
						$geo_data1 = adv_geo_lookup( $_REQUEST['zip1'] );
						$geo_data2 = adv_geo_lookup( $_REQUEST['zip2'] );

						$city1 = ( $_REQUEST['city1'] == '' ) ? ucwords( strtolower( $geo_data1['City'] ) ) : $_REQUEST['city1'];
						$state1 = ( $_REQUEST['state1'] == '' ) ? $geo_data1['State'] : $_REQUEST['state1'];
						$country1 = ( $_REQUEST['country1'] == '' ) ? 'US' : $_REQUEST['country1'];

						$city2 = ( $_REQUEST['city2'] == '' ) ? ucwords( strtolower( $geo_data2['City'] ) ) : $_REQUEST['city2'];
						$state2 = ( $_REQUEST['state2'] == '' ) ? $geo_data2['State'] : $_REQUEST['state2'];
						$country2 = ( $_REQUEST['country2'] == '' ) ? 'US' : $_REQUEST['country2'];

						// If last name is blank, just use the first name again
						if ( $_REQUEST['lastname'] == '' )
						{
								$_REQUEST['lastname'] = $_REQUEST['firstname'];
						}

						// If phone lead that is valid, let's make sure the trustedform cert gets claimed
						if ( $_REQUEST['phone1'] != '' && strlen( $_REQUEST['phone1'] ) == '10' && $_REQUEST['xxTrustedFormCertUrl'] != '' )
						{
								// Pending processing
								$trustedform_status = '2';
						}
						else
						{
								// N/A - no phone record or no TrustedForm cert
								$trustedform_status = '0';
						}






						// Add this as a new lead in the auto vertical
						$sql = "
						INSERT INTO leads
						(
								source_id, vertical_id,
								firstname, lastname, email, phone1, 
								phone1_area_code, phone1_region_code, phone1_line_code,
								city1, state1, country1, zip1,
								city2, state2, country2, zip2,
								move_date, move_year, move_month, move_day, 
								auto, auto_model, auto_make, auto_year,
								date, created, captured,
								ipaddr, lead_source, lead_id, test_lead,
								user_agent, referrer, lander, device, session_id,
								lead_intake_type, lead_source_network, p_type,
								trustedform, trustedform_claimed, 
								gclid,car_shipping, finding_packing_supplies, contractor_to_contact_you, panels_on_new_home
						)
						VALUES
						(
								'" . $db->makeSafe( $_REQUEST['source_id'] ) . "',
								'" . $db->makeSafe( $vertical_id ) . "',
								'" . $db->makeSafe( $_REQUEST['firstname'] ) . "',
								'" . $db->makeSafe( $_REQUEST['lastname'] ) . "',
								'" . $db->makeSafe( $_REQUEST['email'] ) . "',
								'" . $db->makeSafe( $_REQUEST['phone1'] ) . "',
								'" . $db->makeSafe( $_REQUEST['phone1_area_code'] ) . "',
								'" . $db->makeSafe( $_REQUEST['phone1_region_code'] ) . "',
								'" . $db->makeSafe( $_REQUEST['phone1_line_code'] ) . "',
								'" . $db->makeSafe( $city1 ) . "',
								'" . $db->makeSafe( $state1 ) . "',
								'" . $db->makeSafe( $country1 ) . "',
								'" . $db->makeSafe( $_REQUEST['zip1'] ) . "',
								'" . $db->makeSafe( $city2 ) . "',
								'" . $db->makeSafe( $state2 ) . "',
								'" . $db->makeSafe( $country2 ) . "',
								'" . $db->makeSafe( $_REQUEST['zip2'] ) . "',
								'" . $db->makeSafe( $_REQUEST['move_date'] ) . "',
								'" . $db->makeSafe( $_REQUEST['move_year'] ) . "',
								'" . $db->makeSafe( $_REQUEST['move_month'] ) . "',
								'" . $db->makeSafe( $_REQUEST['move_day'] ) . "',
								'" . $db->makeSafe( $_REQUEST['auto'] ) . "',
								'" . $db->makeSafe( $auto_model ) . "',
								'" . $db->makeSafe( $auto_make ) . "',
								'" . $db->makeSafe( $auto_year ) . "',
								'" . date( 'Y-m-d' ) . "',
								'" . date( 'Y-m-d H:i:s' ) . "',
								'" . date( 'Y-m-d H:i:s' ) . "',
								'" . $db->makeSafe( $_SERVER['REMOTE_ADDR'] ) . "',
								'" . $db->makeSafe( $_REQUEST['lead_source'] ) . "',
								'" . $db->makeSafe( $_REQUEST['lead_id'] ) . "',
								'" . $db->makeSafe( $_REQUEST['test_lead'] ) . "',
								'" . $db->makeSafe( $_SERVER['HTTP_USER_AGENT'] ) . "',
								'" . $db->makeSafe( $_SERVER['HTTP_REFERRER'] ) . "',
								'" . $db->makeSafe( $_REQUEST['lander'] ) . "',
								'" . $_SESSION['device'] . "',
								'" . session_id() . "',
								'" . $lead_intake_type . "',
								'" . $lead_source_network . "',
								'" . $db->makeSafe( $_REQUEST['p_type'] ) . "',
								'" . $db->makeSafe( $_REQUEST['xxTrustedFormCertUrl'] ) . "',
								'" . $db->makeSafe( $trustedform_status ) . "',
								'" . $db->makeSafe( $_REQUEST['gclid'] ) . "',
								'" . $db->makeSafe( $_REQUEST['status_1'] ) . "',
								'" . $db->makeSafe( $_REQUEST['status_2'] ) . "',
									'" . $db->makeSafe( $_REQUEST['status_3'] ) . "',
									'" . $db->makeSafe( $_REQUEST['status_4'] ) . "'
								
						)
						";
						$db->query( $sql );

						$contains_vertical_car_shipping = true;
				}
		}

		// Hardcoded values
		$lead_intake_type = '5'; // lead source is a site opt in
		$vertical_id = 1; // moving parent

		// Lead source network
		$lead_source_network = ( $_REQUEST['lead_source_network'] != '' ) ? $_REQUEST['lead_source_network'] : 0;

		// Look up city/state values
		$geo_data1 = adv_geo_lookup( $_REQUEST['zip1'] );
		$geo_data2 = adv_geo_lookup( $_REQUEST['zip2'] );
		
		$city1 = ( $_REQUEST['city1'] == '' ) ? ucwords( strtolower( $geo_data1['City'] ) ) : $_REQUEST['city1'];
		$state1 = ( $_REQUEST['state1'] == '' ) ? $geo_data1['State'] : $_REQUEST['state1'];
		$country1 = ( $_REQUEST['country1'] == '' ) ? 'US' : $_REQUEST['country1'];
	
		$city2 = ( $_REQUEST['city2'] == '' ) ? ucwords( strtolower( $geo_data2['City'] ) ) : $_REQUEST['city2'];
		$state2 = ( $_REQUEST['state2'] == '' ) ? $geo_data2['State'] : $_REQUEST['state2'];
		$country2 = ( $_REQUEST['country2'] == '' ) ? 'US' : $_REQUEST['country2'];
		
		// Local or long distance lead
		$move_type = ( $state1 == $state2 ) ? '1' : '2';
		
		// If last name is blank, just use the first name again
		if ( $_REQUEST['lastname'] == '' )
		{
			$_REQUEST['lastname'] = $_REQUEST['firstname'];
		}

        // If phone lead that is valid, let's make sure the trustedform cert gets claimed
        if ( $_REQUEST['phone1'] != '' && strlen( $_REQUEST['phone1'] ) == '10' && $_REQUEST['xxTrustedFormCertUrl'] != '' )
        {
            // Pending processing
            $trustedform_status = '2';
        }
        else
        {
            // N/A - no phone record or no TrustedForm cert
            $trustedform_status = '0';
        }
        
		// If last name is blank, just use the first name again
		if ( $_REQUEST['auto'] == '' )
		{
			$_REQUEST['auto'] = $_REQUEST['auto'];
		}

		foreach ($verticals_array as $vertical) {
			if ($contains_vertical_car_shipping) {
				if ( $vertical != 0 && $vertical != 4 ) {
					$sql = "
						INSERT INTO leads
						(
							source_id, vertical_id,
							firstname, lastname, email, phone1, 
							phone1_area_code, phone1_region_code, phone1_line_code,
							city1, state1, country1, zip1,
							city2, state2, country2, zip2,
							move_date, move_year, move_month, move_day, 
							move_size, move_type, move_auto,auto,
							date, created, captured,
							ipaddr, lead_source, lead_id, test_lead,
							user_agent, referrer, lander, device, session_id,
							lead_intake_type, lead_source_network, p_type,
							trustedform, trustedform_claimed, 
							gclid, fbclid, channel,
							traffic_source_id, sub1, sub2, sub3, sub4, sub5, sub_id,car_shipping, finding_packing_supplies, contractor_to_contact_you, panels_on_new_home
						)
						VALUES
						(
							'" . $db->makeSafe( $_REQUEST['source_id'] ) . "',
							'" . $db->makeSafe( $vertical ) . "',
							'" . $db->makeSafe( $_REQUEST['firstname'] ) . "',
							'" . $db->makeSafe( $_REQUEST['lastname'] ) . "',
							'" . $db->makeSafe( $_REQUEST['email'] ) . "',
							'" . $db->makeSafe( $_REQUEST['phone1'] ) . "',
							'" . $db->makeSafe( $_REQUEST['phone1_area_code'] ) . "',
							'" . $db->makeSafe( $_REQUEST['phone1_region_code'] ) . "',
							'" . $db->makeSafe( $_REQUEST['phone1_line_code'] ) . "',
							'" . $db->makeSafe( $city1 ) . "',
							'" . $db->makeSafe( $state1 ) . "',
							'" . $db->makeSafe( $country1 ) . "',
							'" . $db->makeSafe( $_REQUEST['zip1'] ) . "',
							'" . $db->makeSafe( $city2 ) . "',
							'" . $db->makeSafe( $state2 ) . "',
							'" . $db->makeSafe( $country2 ) . "',
							'" . $db->makeSafe( $_REQUEST['zip2'] ) . "',
							'" . $db->makeSafe( $_REQUEST['move_date'] ) . "',
							'" . $db->makeSafe( $_REQUEST['move_year'] ) . "',
							'" . $db->makeSafe( $_REQUEST['move_month'] ) . "',
							'" . $db->makeSafe( $_REQUEST['move_day'] ) . "',
							'" . $db->makeSafe( $_REQUEST['move_size'] ) . "',
							'" . $move_type . "',
							'" . $move_auto . "',
							'" . $_REQUEST['auto'] . "',
							'" . date( 'Y-m-d' ) . "',
							'" . date( 'Y-m-d H:i:s' ) . "',
							'" . date( 'Y-m-d H:i:s' ) . "',
							'" . $db->makeSafe( $_SERVER['REMOTE_ADDR'] ) . "',
							'" . $db->makeSafe( $_REQUEST['lead_source'] ) . "',
							'" . $db->makeSafe( $_REQUEST['lead_id'] ) . "',
							'" . $db->makeSafe( $_REQUEST['test_lead'] ) . "',
							'" . $db->makeSafe( $_SERVER['HTTP_USER_AGENT'] ) . "',
							'" . $db->makeSafe( $_SERVER['HTTP_REFERRER'] ) . "',
							'" . $db->makeSafe( $_REQUEST['lander'] ) . "',
							'" . $_SESSION['device'] . "',
							'" . session_id() . "',
							'" . $lead_intake_type . "',
							'" . $lead_source_network . "',
							'" . $db->makeSafe( $_REQUEST['p_type'] ) . "',
												
							'" . $db->makeSafe( $_REQUEST['xxTrustedFormCertUrl'] ) . "',
							'" . $db->makeSafe( $trustedform_status ) . "',
							'" . $db->makeSafe( $_REQUEST['gclid'] ) . "',
							'" . $db->makeSafe( $_REQUEST['fbclid'] ) . "',
							'" . $db->makeSafe( $_REQUEST['channel'] ) . "',

							'" . $db->makeSafe( $_REQUEST['traffic_source_id'] ) . "',
							'" . $db->makeSafe( $_REQUEST['sub1'] ) . "',
							'" . $db->makeSafe( $_REQUEST['sub2'] ) . "',
							'" . $db->makeSafe( $_REQUEST['sub3'] ) . "',
							'" . $db->makeSafe( $_REQUEST['sub4'] ) . "',
							'" . $db->makeSafe( $_REQUEST['sub5'] ) . "',
							'" . $db->makeSafe( $geo_data1['CBSA'] ) . "',
							'" . $db->makeSafe( $_REQUEST['status_1'] ) . "',
							'" . $db->makeSafe( $_REQUEST['status_2'] ) . "',
							'" . $db->makeSafe( $_REQUEST['status_3'] ) . "',
							'" . $db->makeSafe( $_REQUEST['status_4'] ) . "'
						)
					";

					$q = $db->query( $sql );
					$insertid = $db->getLastID();

					$_SESSION['lead_id'] = $insertid;
					$_SESSION['lander'] = $_REQUEST['lander'];
					$_SESSION['firstname'] = $_REQUEST['firstname'];
					$_SESSION['source_id'] = $_REQUEST['source_id'];
					$_SESSION['traffic_source_id'] = $_REQUEST['traffic_source_id'];
					$_SESSION['sub1'] = $_REQUEST['sub1'];
					$_SESSION['sub2'] = $_REQUEST['sub2'];
					$_SESSION['sub3'] = $_REQUEST['sub3'];
					$_SESSION['sub4'] = $_REQUEST['sub4'];
					$_SESSION['sub5'] = $_REQUEST['sub5'];
					$_SESSION['status_1'] = $_REQUEST['status_1'];
					$_SESSION['status_2'] = $_REQUEST['status_2'];
					$_SESSION['status_3'] = $_REQUEST['status_3'];
					$_SESSION['status_4'] = $_REQUEST['status_4'];
					$_SESSION['gclid'] = $_REQUEST['gclid'];
					$_SESSION['fbclid'] = $_REQUEST['fbclid'];
					$_SESSION['channel'] = $_REQUEST['channel'];
					$_SESSION['zip1'] =  $_REQUEST['zip1'];
					$_SESSION['zip2'] = $_REQUEST['zip2'] ;
					$_SESSION['phone1'] = $_REQUEST['phone1'];
					$_SESSION['phone1_area_code'] = $_REQUEST['phone1_area_code'];
					$_SESSION['phone1_region_code'] = $_REQUEST['phone1_region_code'];
					$_SESSION['phone1_line_code'] = $_REQUEST['phone1_line_code'];
					$_SESSION['move_date'] = $_REQUEST['move_date'];
					$_SESSION['move_year'] = $_REQUEST['move_year'];
					$_SESSION['move_month'] = $_REQUEST['move_month'];
					$_SESSION['move_day'] = $_REQUEST['move_day'];
					$_SESSION['move_type'] = $move_type;
					$_SESSION['move_size'] = $_REQUEST['move_size'];
					$_SESSION['move_auto'] = $move_auto;
					$_SESSION['city1'] = $city1;
					$_SESSION['state1'] = $state1;
					$_SESSION['country1'] = $country1;
					$_SESSION['city2'] = $city2;
					$_SESSION['state2'] = $state2;
					$_SESSION['country2'] = $country2;
					$_SESSION['email'] = $email;
					$_SESSION['lastname'] = $_REQUEST['lastname'];
					$_SESSION['lead_source'] = $_REQUEST['lead_source'];
					$_SESSION['test_lead_id'] = $_REQUEST['lead_id'];
					$_SESSION['test_lead'] = $_REQUEST['test_lead'];
					$_SESSION['p_type'] = $_REQUEST['p_type'];
					$_SESSION['lead_intake_type'] = $lead_intake_type;
					$_SESSION['lead_source_network'] = $lead_source_network;
					$_SESSION['xxTrustedFormCertUrl'] = $_REQUEST['xxTrustedFormCertUrl'];
					$_SESSION['trustedform_status'] = $trustedform_status;
					$_SESSION['CBSA'] = $geo_data1['CBSA'];

				}
			} 
			else {
				if ( $vertical != 0 && $vertical != 4 ) {
					$sql = "
						INSERT INTO leads
						(
							source_id, vertical_id,
							firstname, lastname, email, phone1, 
							phone1_area_code, phone1_region_code, phone1_line_code,
							city1, state1, country1, zip1,
							city2, state2, country2, zip2,
							move_date, move_year, move_month, move_day, 
							move_size, move_type, move_auto,auto,
							date, created, captured,
							ipaddr, lead_source, lead_id, test_lead,
							user_agent, referrer, lander, device, session_id,
							lead_intake_type, lead_source_network, p_type,
							trustedform, trustedform_claimed, 
							gclid, fbclid, channel,
							traffic_source_id, sub1, sub2, sub3, sub4, sub5, sub_id,car_shipping, finding_packing_supplies, contractor_to_contact_you, panels_on_new_home
						)
						VALUES
						(
							'" . $db->makeSafe( $_REQUEST['source_id'] ) . "',
							'" . $db->makeSafe( $vertical ) . "',
							'" . $db->makeSafe( $_REQUEST['firstname'] ) . "',
							'" . $db->makeSafe( $_REQUEST['lastname'] ) . "',
							'" . $db->makeSafe( $_REQUEST['email'] ) . "',
							'" . $db->makeSafe( $_REQUEST['phone1'] ) . "',
							'" . $db->makeSafe( $_REQUEST['phone1_area_code'] ) . "',
							'" . $db->makeSafe( $_REQUEST['phone1_region_code'] ) . "',
							'" . $db->makeSafe( $_REQUEST['phone1_line_code'] ) . "',
							'" . $db->makeSafe( $city1 ) . "',
							'" . $db->makeSafe( $state1 ) . "',
							'" . $db->makeSafe( $country1 ) . "',
							'" . $db->makeSafe( $_REQUEST['zip1'] ) . "',
							'" . $db->makeSafe( $city2 ) . "',
							'" . $db->makeSafe( $state2 ) . "',
							'" . $db->makeSafe( $country2 ) . "',
							'" . $db->makeSafe( $_REQUEST['zip2'] ) . "',
							'" . $db->makeSafe( $_REQUEST['move_date'] ) . "',
							'" . $db->makeSafe( $_REQUEST['move_year'] ) . "',
							'" . $db->makeSafe( $_REQUEST['move_month'] ) . "',
							'" . $db->makeSafe( $_REQUEST['move_day'] ) . "',
							'" . $db->makeSafe( $_REQUEST['move_size'] ) . "',
							'" . $move_type . "',
							'" . $move_auto . "',
							'" . $_REQUEST['auto'] . "',
							'" . date( 'Y-m-d' ) . "',
							'" . date( 'Y-m-d H:i:s' ) . "',
							'" . date( 'Y-m-d H:i:s' ) . "',
							'" . $db->makeSafe( $_SERVER['REMOTE_ADDR'] ) . "',
							'" . $db->makeSafe( $_REQUEST['lead_source'] ) . "',
							'" . $db->makeSafe( $_REQUEST['lead_id'] ) . "',
							'" . $db->makeSafe( $_REQUEST['test_lead'] ) . "',
							'" . $db->makeSafe( $_SERVER['HTTP_USER_AGENT'] ) . "',
							'" . $db->makeSafe( $_SERVER['HTTP_REFERRER'] ) . "',
							'" . $db->makeSafe( $_REQUEST['lander'] ) . "',
							'" . $_SESSION['device'] . "',
							'" . session_id() . "',
							'" . $lead_intake_type . "',
							'" . $lead_source_network . "',
							'" . $db->makeSafe( $_REQUEST['p_type'] ) . "',
												
							'" . $db->makeSafe( $_REQUEST['xxTrustedFormCertUrl'] ) . "',
							'" . $db->makeSafe( $trustedform_status ) . "',
							'" . $db->makeSafe( $_REQUEST['gclid'] ) . "',
							'" . $db->makeSafe( $_REQUEST['fbclid'] ) . "',
							'" . $db->makeSafe( $_REQUEST['channel'] ) . "',

							'" . $db->makeSafe( $_REQUEST['traffic_source_id'] ) . "',
							'" . $db->makeSafe( $_REQUEST['sub1'] ) . "',
							'" . $db->makeSafe( $_REQUEST['sub2'] ) . "',
							'" . $db->makeSafe( $_REQUEST['sub3'] ) . "',
							'" . $db->makeSafe( $_REQUEST['sub4'] ) . "',
							'" . $db->makeSafe( $_REQUEST['sub5'] ) . "',
							'" . $db->makeSafe( $geo_data1['CBSA'] ) . "',
							'" . $db->makeSafe( $_REQUEST['status_1'] ) . "',
							'" . $db->makeSafe( $_REQUEST['status_2'] ) . "',
							'" . $db->makeSafe( $_REQUEST['status_3'] ) . "',
							'" . $db->makeSafe( $_REQUEST['status_4'] ) . "'
						)
					";

					$q = $db->query( $sql );
					$insertid = $db->getLastID();

					$_SESSION['lead_id'] = $insertid;
					$_SESSION['lander'] = $_REQUEST['lander'];
					$_SESSION['firstname'] = $_REQUEST['firstname'];
					$_SESSION['source_id'] = $_REQUEST['source_id'];
					$_SESSION['traffic_source_id'] = $_REQUEST['traffic_source_id'];
					$_SESSION['sub1'] = $_REQUEST['sub1'];
					$_SESSION['sub2'] = $_REQUEST['sub2'];
					$_SESSION['sub3'] = $_REQUEST['sub3'];
					$_SESSION['sub4'] = $_REQUEST['sub4'];
					$_SESSION['sub5'] = $_REQUEST['sub5'];
					$_SESSION['status_1'] = $_REQUEST['status_1'];
					$_SESSION['status_2'] = $_REQUEST['status_2'];
					$_SESSION['status_3'] = $_REQUEST['status_3'];
					$_SESSION['status_4'] = $_REQUEST['status_4'];
					$_SESSION['gclid'] = $_REQUEST['gclid'];
					$_SESSION['fbclid'] = $_REQUEST['fbclid'];
					$_SESSION['channel'] = $_REQUEST['channel'];
					$_SESSION['zip1'] =  $_REQUEST['zip1'];
					$_SESSION['zip2'] = $_REQUEST['zip2'] ;
					$_SESSION['phone1'] = $_REQUEST['phone1'];
					$_SESSION['phone1_area_code'] = $_REQUEST['phone1_area_code'];
					$_SESSION['phone1_region_code'] = $_REQUEST['phone1_region_code'];
					$_SESSION['phone1_line_code'] = $_REQUEST['phone1_line_code'];
					$_SESSION['move_date'] = $_REQUEST['move_date'];
					$_SESSION['move_year'] = $_REQUEST['move_year'];
					$_SESSION['move_month'] = $_REQUEST['move_month'];
					$_SESSION['move_day'] = $_REQUEST['move_day'];
					$_SESSION['move_type'] = $move_type;
					$_SESSION['move_size'] = $_REQUEST['move_size'];
					$_SESSION['move_auto'] = $move_auto;
					$_SESSION['city1'] = $city1;
					$_SESSION['state1'] = $state1;
					$_SESSION['country1'] = $country1;
					$_SESSION['city2'] = $city2;
					$_SESSION['state2'] = $state2;
					$_SESSION['country2'] = $country2;
					$_SESSION['email'] = $email;
					$_SESSION['lastname'] = $_REQUEST['lastname'];
					$_SESSION['lead_source'] = $_REQUEST['lead_source'];
					$_SESSION['test_lead_id'] = $_REQUEST['lead_id'];
					$_SESSION['test_lead'] = $_REQUEST['test_lead'];
					$_SESSION['p_type'] = $_REQUEST['p_type'];
					$_SESSION['lead_intake_type'] = $lead_intake_type;
					$_SESSION['lead_source_network'] = $lead_source_network;
					$_SESSION['xxTrustedFormCertUrl'] = $_REQUEST['xxTrustedFormCertUrl'];
					$_SESSION['trustedform_status'] = $trustedform_status;
					$_SESSION['CBSA'] = $geo_data1['CBSA'];
				}

				if ($vertical == 4) {
					$_SESSION['auto_moving'] = true;
				} 
				
			}
		}
		// If test lead 'Pingdom' user, delete
        if ( $_REQUEST['firstname'] == 'Pingdom' && $_REQUEST['lastname'] == 'Tester' )
        {
            $sql = "DELETE FROM leads WHERE id = '" . $db->makeSafe( $insertid ) . "' LIMIT 1";
            $db->query( $sql );
        }
		
		
		if ( $state1 == $state2 ) {
				$redirect = ( $_REQUEST['redirect'] != '' ) ? $_REQUEST['redirect'] : '/LO-thankyou.php';
		}else{
				$redirect = ( $_REQUEST['redirect'] != '' ) ? $_REQUEST['redirect'] : '/LD-thankyou.php';
		} 
		
	
	}
}

// Only redirect to thank you page if no errors (so errors can be output)
if ( $error_msg == '' )
{
	// Redirect
	header( 'Location: ' . $redirect );
	exit();
}
else
{
	echo 'Oops! We can\'t enter your quote into the system because of one of more errors. Please see below.<ul>' . $error_msg . '</ul>';
}