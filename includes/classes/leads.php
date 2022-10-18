<?php

class Leads
{

	// Constructor
	function __construct()
	{
	}

	public function insertLead( $data )
    {
        global $db;

        $sql = "
		INSERT INTO leads
		(
			source_id, firstname, lastname, email, phone1,
			city1, state1, country1, zip1,
			city2, state2, country2, zip2,
			move_date, move_size, move_type, move_auto,
			auto_model, auto_make, auto_year,
			date, created, captured,
			ipaddr, lead_source, lead_id, test_lead,
			user_agent, referrer, lander, device, session_id, lead_intake_type,
			sent, lead_source_network, p_type,
		    trustedform, trustedform_claimed, 
		    gclid
		)
		VALUES
		(
			'" . $db->makeSafe( $_REQUEST['source_id'] ) . "',
			'" . $db->makeSafe( $_REQUEST['firstname'] ) . "',
			'" . $db->makeSafe( $_REQUEST['lastname'] ) . "',
			'" . $db->makeSafe( $_REQUEST['email'] ) . "',
			'" . $db->makeSafe( $_REQUEST['phone1'] ) . "',
			'" . $db->makeSafe( $city1 ) . "',
			'" . $db->makeSafe( $state1 ) . "',
			'" . $db->makeSafe( $country1 ) . "',
			'" . $db->makeSafe( $_REQUEST['zip1'] ) . "',
			'" . $db->makeSafe( $city2 ) . "',
			'" . $db->makeSafe( $state2 ) . "',
			'" . $db->makeSafe( $country2 ) . "',
			'" . $db->makeSafe( $_REQUEST['zip2'] ) . "',
			'" . $db->makeSafe( $_REQUEST['move_date'] ) . "',
			'" . $db->makeSafe( $_REQUEST['move_size'] ) . "',
			'" . $move_type . "',
			'" . $move_auto . "',
			'" . $db->makeSafe( $_REQUEST['auto_model'] ) . "',
			'" . $db->makeSafe( $_REQUEST['auto_make'] ) . "',
			'" . $db->makeSafe( $_REQUEST['auto_year'] ) . "',
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
			'0',
			'" . $lead_source_network . "',
			'" . $db->makeSafe( $_REQUEST['p_type'] ) . "',
			
            '" . $db->makeSafe( $_REQUEST['xxTrustedFormCertUrl'] ) . "',
            '" . $db->makeSafe( $trustedform_status ) . "',
            '" . $db->makeSafe( $_REQUEST['gclid'] ) . "'
		)
		";
        $db->query( $sql );
        $this->lead_id = $db->getLastID();
    }
}