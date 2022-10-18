<?php

class Site
{

	public $conf = array();

	// Constructor
	function __construct()
	{
	}
	
	// Fetch all site level settings for this specific site
	public function getSiteConfigData()
	{
		global $db;
		
		$sql = "
		SELECT *
		FROM sites 
		WHERE 
			s_domain = '" . $this->getSiteDomain() . "'";
		$query = $db->query($sql);
		if ( $db->numrows( $query ) > 0 )
		{
			$row = $db->fetcharray($query);
			
			foreach( $row AS $key => $value )
			{
				$this->conf[$key] = $value;
			}
		}
		else
		{
			echo "ERROR in site.php: Could not load site configuration data: " . $this->getSiteDomain();
		}
		
		return $this->conf;
	}
	
	public function getSiteDomain()
	{
		$strip = array(
			'www.', 'staging.'
		);
		return str_replace( $strip, '', $_SERVER['SERVER_NAME'] );
	}
}

?>