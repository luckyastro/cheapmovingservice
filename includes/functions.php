<?php

$state_list = array(
	"AL" => "Alabama", 
	"AK" => "Alaska", 
	"AZ" => "Arizona", 
	"AR" => "Arkansas", 
	"CA" => "California", 
	"CO" => "Colorado", 
	"CT" => "Connecticut", 
	"DE" => "Delaware", 
	"DC" => "District of Columbia", 
	"FL" => "Florida", 
	"GA" => "Georgia", 
	"HI" => "Hawaii", 
	"ID" => "Idaho", 
	"IL" => "Illinois", 
	"IN" => "Indiana", 
	"IA" => "Iowa", 
	"KS" => "Kansas", 
	"KY" => "Kentucky", 
	"LA" => "Louisiana", 
	"ME" => "Maine", 
	"MD" => "Maryland", 
	"MA" => "Massachusetts", 
	"MI" => "Michigan", 
	"MN" => "Minnesota", 
	"MS" => "Mississippi", 
	"MO" => "Missouri", 
	"MT" => "Montana", 
	"NE" => "Nebraska", 
	"NV" => "Nevada", 
	"NH" => "New Hampshire", 
	"NJ" => "New Jersey", 
	"NM" => "New Mexico", 
	"NY" => "New York", 
	"NC" => "North Carolina", 
	"ND" => "North Dakota", 
	"OH" => "Ohio", 
	"OK" => "Oklahoma",
	"OR" => "Oregon", 
	"PA" => "Pennsylvania", 
	"RI" => "Rhode Island", 
	"SC" => "South Carolina", 
	"SD" => "South Dakota", 
	"TN" => "Tennessee", 
	"TX" => "Texas", 
	"UT" => "Utah", 
	"VT" => "Vermont", 
	"VA" => "Virginia", 
	"WA" => "Washington", 
	"WV" => "West Virginia", 
	"WI" => "Wisconsin", 
	"WY" => "Wyoming"
);

//----------------------------------------------------//
function add_permissions( $user_id, $permissions )
//----------------------------------------------------//
{
    global $db;

    if ( $user_id != '' && $user_id != 0 && is_array( $permissions ) )
    {
        foreach( $permissions AS $permission_id )
        {
            $sql = "
            UPDATE permissions
            SET
                perm_users = CONCAT( perm_users, '" . $db->makeSafe( $user_id ) . "', ':' ) 
            WHERE 
                perm_id = '" . $db->makeSafe( $permission_id ) . "' 
            ";
            $db->query( $sql );
        }

        return true;
    }

    return false;
}

//----------------------------------------------------//
function get_article_navigation( $limit = 7, $type = 'list', $link_out = 'category' )
//----------------------------------------------------//
{
	global $db, $conf;

	$sql = "
	SELECT 
		category_id, category_title, content_url, title, articles.id
	FROM articles
	LEFT JOIN articles_categories USING ( category_id )
	LEFT JOIN articles_syndication ON articles_syndication.a_id = articles.id
	WHERE 
		status = '1'
		AND articles_syndication.s_id = '" . $conf['s_id'] . "'
	GROUP BY category_id
	ORDER BY category_title ASC
	LIMIT " . $limit . "
	";
	$q = $db->query( $sql );
	if ( $db->numrows( $q ) > 0 )
	{
		while( $f = $db->fetcharray( $q ) )
		{
			if ( $link_out == 'category' )
			{
				$url = '/category/' . $f['category_id'] . '-' . makeSeo( $f['category_title'] );	
			}
			elseif ( $link_out == 'article' )
			{				
				if ( $f['content_url'] == '' )
				{
					// Regular content article
					$url = '/article/' . $f['id'] . '-' . makeSeo( $f['title'] );
				}
				else
				{
					// Link out offer
					$url = $f['content_url'];
				}
			}
			
			if ( $type == 'select' )
			{
				echo '<option value="' . $url . '">' . $f['category_title'] . '</option>';
			}
			elseif ( $type == 'list' )
			{
				echo '<li><a href="' . $url . '">' . $f['category_title'] . '</a></li>';
			}

		}
	}
}

//----------------------------------------------------//
function get_articles( $limit = 10, $type = 'random', $link_class = '', $inner_start_output = '', $inner_end_output = '', $start_output = '', $end_output = '' )
//----------------------------------------------------//
{
	global $db, $conf;
	
	if ( $start_output != '' )
	{
		echo $start_output;
	}
	
	if ( $type == 'revenue' )
	{
		// List of highest performing articles by CPC w/ at least 10 clicks, 1-week rolling average
		$sql = "
		SELECT 
			articles.id, title, content, articles.category_id, created, status, category_title, content_url,
			revenue, clicks, revenue/clicks AS cpc
		FROM articles
		LEFT JOIN articles_categories USING ( category_id )
		LEFT JOIN articles_syndication ON articles_syndication.a_id = articles.id
		LEFT JOIN stats_adsense ON stats_adsense.article_id = articles.id
		WHERE 
			status = '1'
			AND articles_syndication.s_id = '" . $conf['s_id'] . "'
			AND clicks >= 10
			AND date BETWEEN '" . date( 'Y-m-d', strtotime( 'now -1 week' ) ) . "' AND '" . date( 'Y-m-d' ) . "'
		GROUP BY articles.id
		ORDER BY cpc DESC
		LIMIT " . $limit . "
		";
	}
	elseif ( $type == 'random' )
	{
		// Return random articles
		$sql = "
		SELECT 
			articles.id, title, content, articles.category_id, created, status, category_title, content_url
		FROM articles
		LEFT JOIN articles_categories USING ( category_id )
		LEFT JOIN articles_syndication ON articles_syndication.a_id = articles.id
		WHERE 
			status = '1'
			AND articles_syndication.s_id = '" . $conf['s_id'] . "'
		ORDER BY RAND()
		LIMIT " . $limit . "
		";		
	}
	$q = $db->query( $sql ) or die( mysql_error() );
	if ( $db->numrows( $q ) > 0 )
	{
		while( $f = $db->fetcharray( $q ) )
		{
			$f['title'] = substr( $f['title'], 0, 35 ) . '...';
		
			if ( $inner_start_output != '' )
			{
				echo $inner_start_output;
			}
			
			if ( $link_class != '' )
			{
				$class = ' class="' . $link_class . '"';
			}
			else
			{
				$class = '';
			}
		
			echo '<a href="/article/' . $f['id'] . '-' . cleanURL( $f['title'] ) . '"' . $class . '>' . $f['title'] . '</a>';
		
			if ( $inner_end_output != '' )
			{
				echo $inner_end_output;
			}
		}
	}

	if ( $end_output != '' )
	{
		echo $end_output;
	}
}

//----------------------------------------------------//
function adv_geo_lookup( $zip )
//----------------------------------------------------//
{
	global $db, $conf;
	
	$sql = "SELECT * FROM ZIPCodes WHERE ZipCode = '" . $db->makeSafe( $zip ) . "' ";
	$q = $db->query( $sql );
	if ( $db->numrows( $q ) > 0 )
	{
		$geo_data = array();
		$f = $db->fetcharray( $q );
		
		foreach( $f AS $key => $value )
		{
			$geo_data[$key] = $value;
		}
		
		return $geo_data;
	}
	else
	{
		return false;
	}
}

//------------------------------------------------------//
function slow_lead_log( $lead_id, $label, $duration, $parameters, $response, $s_id = 0, $a_id = 0, $source_id = 0 )
//------------------------------------------------------//
{
	global $db;

	// Log this response from this particular account
	$sql = "
	INSERT INTO leads_log_slow
	(
		lead_id, 
		datetime,
		a_id,
		source_id,
		duration,
		a_label,
		parameters,
		response
	)
	VALUES
	(
		'" . $lead_id . "',
		'" . date( 'Y-m-d H:i:s' ) . "',
		'" . $a_id . "',
		'" . $source_id . "',
		'" . $duration . "',
		'" . $db->makeSafe( $label ) . "',
		'" . $db->makeSafe( $parameters ) . "',
		'" . $db->makeSafe( $response ) . "'
	)";
	$q = $db->query( $sql );
}

//------------------------------------------------------//
function cur_page( $url = '' )
//------------------------------------------------------//
{
	$url = 'http://' . $_SERVER['HTTP_HOST'] . strtok( $_SERVER['REQUEST_URI'], '?' );

	// We were using just the page.php name, but now it's the full URL
	// $url = array_pop( explode( '/', $url ) );

	return $url;
}

//------------------------------------------------------//
function cur_lander()
//-----------------------------------------------------//
{
	$lander = basename( $_SERVER['PHP_SELF'] );
	return $lander;
}

//------------------------------------------------------//
function lead_status( $response )
//------------------------------------------------------//
{
	// First check if error=true
	$error_codes = array(
		'error=true',
		'status: failure',
		'FAILA',
		'Lead could not be accepted this time!'
	);
	
	foreach( $error_codes AS $error_code )
	{
		if ( stripos( $response, $error_code ) !== false )
		{
			return false;
		}
	}	

	// Continue checking success if we've made it this far
	$success_codes = array(
		'success=true',
		'success',
		'record processed',
		'pass',
		'ok',
		'approved',
		'ACCEPT',
		'successful',
		'submitted',
		'inparallel_lead_id',
		'contact added',
		'true'
	);
	
	foreach( $success_codes AS $success_code )
	{
		if ( stripos( $response, $success_code ) !== false )
		{
			return true;
		}
	}
}

//------------------------------------------------------//
function getbrowser()
//------------------------------------------------------//
{
	if( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false )
		return 'ie';
	elseif( strpos( $_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false )
		return 'firefox';
	elseif( strpos( $_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false )
		return 'chrome';
	else
		return 'other';
}

//------------------------------------------------------//
function get_zip( $city, $state )
//------------------------------------------------------//
{
	global $db;
	
	$sql = "
	SELECT ZipCode 
	FROM ZIPCodes 
	WHERE 
		CityMixedCase = '" . $db->makeSafe( $city ) . "' 
		AND State = '" . $db->makeSafe( $state ) . "'
	";
	$q = $db->query( $sql );
	if ( $db->numrows( $q ) > 0 )
	{
		$f = $db->fetcharray( $q );
		$zip = $f['ZipCode'];
		
		return $zip;
	}
	
	return false;
}

//------------------------------------------------------//
function get_geo()
//------------------------------------------------------//
{
	global $db;

	$sql = "
	SELECT l.country, l.region, l.city, l.postalCode
	FROM location l 
	JOIN blocks b ON ( l.locId = b.locId )
	WHERE 
		INET_ATON( '" . $_SERVER['REMOTE_ADDR'] . "' ) >= b.startIpNum 
		AND INET_ATON( '" . $_SERVER['REMOTE_ADDR'] . "' ) <= b.endIpNum
	";
	$q = $db->query( $sql );
	$row = $db->fetcharray( $q );
	
	$city = $row['city'];
	$state = $row['region'];
	$zip = $row['postalCode'];
	
	if ( $city != '' && $state != '' && $zip == '' )
	{
		$sql = "SELECT ZipCode FROM ZIPCodes WHERE CityMixedCase = '" . $city . "' AND State = '" . $state . "'";
		$q2 = $db->query( $sql );
		$row2 = $db->fetcharray( $q2 );
		$zip = $row2['ZipCode'];
	}
	
	// Check for only 4 digits for zip
	if ( strlen( $zip ) == 4 )
	{
		$zip = '0' . $zip;
	}
	
	/*
	$_SESSION['city'] = $city;
	$_SESSION['state'] = $state;
	$_SESSION['zip'] = $zip;
	*/
	
	$location = array(
		'city' => $city,
		'state' => $state,
		'zip' => $zip
	);
	
	return $location;
}

//------------------------------------------------------//
function pagination( $pageurl, $page = 1, $totalresults, $resultsperpage, $li = false, $prefix = '', $postfix = '', $active_css = '', $inactive_css = '' )
//------------------------------------------------------//
{
	$totalpages = ceil( $totalresults / $resultsperpage );
	$pagination = '';

	if ( $page == 0 || $page == '' )
	{
		$page = 1;
	}

	if ( $prefix != '' )
	{
		$pagination .= $prefix;
	}
	
	// Add all parameters except page=
	if ( is_array( $_REQUEST ) )
	{
		$parameters = '';
		foreach ( $_REQUEST AS $key => $value )
		{
			if ( $key != 'page' && $key != 'submit' )
			{
				$parameters .= '&' . $key . '=' . $value;
			}
		}
	}
	
	// Output all pages
	$start  = $page - 4;
	$end    = $page + 4;
	for ( $i = $start; $i <= $end; $i++ )
	{
		if ( $i > 0 && $i <= $totalpages )
		{
			if ( $active_css != '' || $inactive_css != '' )
			{
				if ( $i == $page )
				{
					$class = $active_css;
				}
				else
				{
					$class = $inactive_css;
				}
			}
			
			if ( $li == true )
			{
				$pagination .= '<li><a href="' . $pageurl . '?page=' . $i . $parameters . '" ' . $class . '>' . $i . '</a></li>';
			}
			else
			{
				$pagination .= '<a href="' . $pageurl . '?page=' . $i . $parameters . '" ' . $class . '>' . $i . '</a> ';
			}
		}
	}
	
	if ( $postfix != '' )
	{
		$pagination .= $postfix;
	}
	
	return $pagination;
}

//------------------------------------------------------//
function libxml_display_error($error)
//------------------------------------------------------//
{
    $return = "<br/>\n"; 
    switch ($error->level) { 
        case LIBXML_ERR_WARNING: 
            $return .= "<b>Warning $error->code</b>: "; 
            break; 
        case LIBXML_ERR_ERROR: 
            $return .= "<b>Error $error->code</b>: "; 
            break; 
        case LIBXML_ERR_FATAL: 
            $return .= "<b>Fatal Error $error->code</b>: "; 
            break; 
    } 
    $return .= trim($error->message); 
    if ($error->file) { 
        $return .=    " in <b>$error->file</b>"; 
    } 
    $return .= " on line <b>$error->line</b>\n"; 

    return $return; 
} 

//------------------------------------------------------//
function libxml_display_errors()
//------------------------------------------------------//
{
    $errors = libxml_get_errors(); 
    foreach ($errors as $error) { 
        print libxml_display_error($error); 
    } 
    libxml_clear_errors(); 
}

//------------------------------------------------------//
function multi_fetch( $urls, $post_vars = '', $xml_content = '' )
//------------------------------------------------------//
{
	global $db, $user, $config;
	
	// $urls should be an array
	// $urls = array( md5_key(url) => 'url' );
	if ( is_array( $urls ) )
	{
		// This will store all cURL requests to be performed later
		$request = array();
			
		foreach ( $urls AS $md5_key => $url )
		{
						
			$curl = curl_init();
				
			$md5s[] = $md5_key;

			curl_setopt( $curl, CURLOPT_URL, $url );
			curl_setopt( $curl, CURLOPT_HEADER, 0 );
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $curl, CURLOPT_POST, 1 );
			
			if ( $xml_content != '' )
			{
				curl_setopt( $curl, CURLOPT_POSTFIELDS, "XML=" . $xml_content . "&this=that" );
			}
			else
			{
				curl_setopt( $curl, CURLOPT_POSTFIELDS, $post_vars );
			}
			
			array_push( $request, $curl );
		}
		
		if ( is_array( $md5s ) && !empty( $md5s ) ) 
		{
			$multi_curl = curl_multi_init();
			foreach ( $request AS $key => $value )
			{
				curl_multi_add_handle( $multi_curl, $value );
			}
			
			$live = null;
			
			// Make requests
			do
			{
				curl_multi_exec( $multi_curl, $live );
			}
			while ( $live > 0 );
		
			// Retrieve results
			foreach ( $request AS $key => $value )
			{		
				$md5_key = $md5s[$key];
				$data[$md5_key]['data'] = curl_multi_getcontent( $value );
			}
			
			// Clean up
			curl_multi_remove_handle( $multi_curl, $curl );
			curl_multi_close( $multi_curl );
		}
		
		return $data;
	}
	else
	{
		return false;
	}
}

//------------------------------------------------------//
function label( $str, $prefix = '', $postfix = '' )
//------------------------------------------------------//
{
	echo $prefix . '' . $str . '' . $postfix;
}

//------------------------------------------------------//
function debug( $str, $line_break = '<br />', $die = false )
//------------------------------------------------------//
{
	if ( DEBUG == true )
	{
		echo $str . $line_break;
		
		if ( $die == true )
		{
			die();
		}
	}
}

//------------------------------------------------------//
function makeSeo($text, $limit=75)
//------------------------------------------------------//
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  if(strlen($text) > 70) {
    $text = substr($text, 0, 70);
  } 

  if (empty($text))
  {
    //return 'n-a';
    return time();
  }

  return $text;
}

//-----------------------------------------//
function cleanURL($string)
//-----------------------------------------//
{
    $url = str_replace("'", '', $string);
    $url = str_replace('%20', ' ', $url);
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url); // substitutes anything but letters, numbers and '_' with separator
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);  // you may opt for your own custom character map for encoding.
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url); // keep only letters, numbers, '_' and separator
    return $url;
}

//-----------------------------------------//
function array_to_json( $array )
//-----------------------------------------//
{

    if( !is_array( $array ) ){
        return false;
    }

    $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
    if( $associative ){

        $construct = array();
        foreach( $array as $key => $value ){

            // We first copy each key/value pair into a staging array,
            // formatting each key and value properly as we go.

            // Format the key:
            if( is_numeric($key) ){
                $key = "key_$key";
            }
            $key = "\"".addslashes($key)."\"";

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "\"".addslashes($value)."\"";
            }

            // Add to staging array:
            $construct[] = "$key: $value";
        }

        // Then we collapse the staging array into the JSON form:
        $result = "{ " . implode( ", ", $construct ) . " }";

    } else { // If the array is a vector (not associative):

        $construct = array();
        foreach( $array as $value ){

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "'".addslashes($value)."'";
            }

            // Add to staging array:
            $construct[] = $value;
        }

        // Then we collapse the staging array into the JSON form:
        $result = "[ " . implode( ", ", $construct ) . " ]";
    }

    return $result;
}

/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
//----------------------------------------------------//
function check_email( $email )
//----------------------------------------------------//
{
	$isValid = true;
	$atIndex = strrpos( $email, "@" );
	
	if ( is_bool( $atIndex) && !$atIndex )
	{
		$isValid = false;
		
		//echo "isvalid triggered (0) <br />";
	}
	else
	{
		$domain = substr( $email, $atIndex+1 );
	
		// Check domain name extension
		$bad_domains = array(
			'ol.com',
			'gmial.com',
			'yshoo.com',
			'gmil.com',
			'yaho.com',
			'uahoo.com',
			'ahoo.com',
			'ail.com',
			'tahoo.com',
			'yaoo.com',
			'yahoo.co',
			'gmail.con',
			'aol.co',
			'gmai.com',
			'gmaol.com',
			'yahoo.om',
			'yahooo.com',
			'gmai.com',
			'yahoo.vom',
			'yahoo.con',
			'gnail.com',
			'aol.comm',
			'yahho.com',
			'comast.net',
			'yhoo.com',
			'gmsil.com',
			'yshoo.com',
			'uahoo.com',			
			'gmsil.com',
			'yaho.com',
			'gmai.com',
			'ahoo.vom',
			'gmil.com',
			'gmail.con',
			'gmial.com',
			'gnail.com',
			'mal.com',
			'ahoo.co',
			'tahoo.com',
			'sbcgobal.net', 
			'yahooo.com'
		);
		if ( in_array( $domain, $bad_domains ) !== false )
		{
			$isValid = false;
			
			//echo "isvalid triggered (1) <br />";
		}
      
		$local = substr($email, 0, $atIndex);
		$localLen = strlen($local);
		$domainLen = strlen($domain);
      
		if ( $localLen < 1 || $localLen > 64 )
		{
			// local part length exceeded
			$isValid = false;
			
			//echo "isvalid triggered (2) <br />";
		}
		elseif ( $domainLen < 1 || $domainLen > 255 )
		{
			// domain part length exceeded
			$isValid = false;
			
			//echo "isvalid triggered (3) <br />";
		}
		elseif ( $local[0] == '.' || $local[$localLen-1] == '.' )
		{
			// local part starts or ends with '.'
			$isValid = false;
			
			//echo "isvalid triggered (4) <br />";
		}
		elseif ( preg_match( '/\\.\\./', $local ) )
		{
			// local part has two consecutive dots
			$isValid = false;
			
			//echo "isvalid triggered (5) <br />";
		}
		elseif ( !preg_match( '/^[A-Za-z0-9\\-\\.]+$/', $domain ) )
		{
			// character not valid in domain part
			$isValid = false;
			
			//echo "isvalid triggered (6) <br />";
		}
		elseif ( preg_match( '/\\.\\./', $domain ) )
		{
			// domain part has two consecutive dots
			$isValid = false;
			
			//echo "isvalid triggered (7) <br />";
		}
		elseif ( !preg_match( '/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace( "\\\\","", $local ) ) )
		{
			// character not valid in local part unless 
			// local part is quoted
			if ( !preg_match( '/^"(\\\\"|[^"])+"$/', str_replace( "\\\\", "", $local ) ) )
			{
				$isValid = false;
				
				//echo "isvalid triggered (8) <br />";
			}
		}
		if ( $isValid && !( checkdnsrr( $domain,"MX" ) || checkdnsrr( $domain, "A" ) ) )
		{
			// domain not found in DNS
			$isValid = false;
			
			//echo "isvalid triggered (9) <br />";
		}
	}
	return $isValid;
}

//----------------------------------------------------//
function time_since( $input_time )
//----------------------------------------------------//
{
	$current	= strtotime('now');
	$post_time	= strtotime($input_time);
	$input_time	= round(($current - $post_time) / 60);
	
	/* If number of seconds is less than 1 hour */
	if ($input_time < 60) {
		$show_time	= round($input_time);
		if ($show_time == 1) $show_time .= ' minute'; else $show_time .= ' mins';
		return $show_time . ' ago';
	/* If time is more than 1 hour but less than 1 day  */
	} elseif ($input_time >= 60 && $input_time < 1440) {
		$show_time	= round($input_time / 60);
		if ($show_time == 1) $show_time .= ' hour'; else $show_time .= ' hours';
		return $show_time . ' ago';
	// If time is more than 1 day but less than 1 week 
	} elseif ($input_time >= 1440 && $input_time < 10080) {
		$show_time	= round($input_time / 60 / 24);
		if ($show_time == 1) $show_time .= ' day'; else $show_time .= ' days';
		return $show_time . ' ago';
	} else {
		$input_time	= date("M d, y h:i a", $post_time);
		return $input_time;
	}
	
}

//----------------------------------------------------//
function send_mailing( $to, $subject, $body, $from = '', $from_name = '', $bcc = '' )
//----------------------------------------------------//
{ 
	$mail = new PHPMailer( true );
	
	try
	{
		$mail->IsSMTP();
		$mail->Host = 'smtp.dreamhost.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Username = TECH_EMAIL_USER;
		$mail->Password = TECH_EMAIL_PASS;
		$mail->Port = 465;

		if ( $from != '' )
		{
			$mail->AddReplyTo( $from, $from_name );
		}
		
		$mail->From = $from;
		$mail->FromName = $from_name;
		$mail->AddAddress( $to );
		
		// BCC Recipients
		if ( $bcc != '' )
		{
			if ( is_array( $bcc ) )
			{
				foreach( $bcc AS $email )
				{
					$mail->AddBCC( $email );
				}
			}
			else
			{
				$mail->AddBCC( $bcc );
			}
		}
		
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AltBody = removehtml( $body );
	
		$mail->Send();
	}
	catch ( phpmailerException $e )
	{
		echo $e->errorMessage();
	}
	catch ( Exception $e )
	{
		echo $e->getMessage();
	}
}

//----------------------------------------------------//
function removehtml( $input, $allowed='' )
//----------------------------------------------------//
{
	$input = preg_replace( "/<((?!\/?($allowed)\b)[^>]*>)/xis", "", $input );
	$input = preg_replace( "/<($allowed).*?>/i", " \\1 ", $input );
	$input = preg_replace ("/ +/", " ", $input );
	
	return $input;
}

//----------------------------------------------------//
function id_to_domain( $s_id )
//----------------------------------------------------//
{
	global $db;
	
	$sql = "SELECT s_domain FROM sites WHERE s_id = '" . $db->makeSafe( $s_id ) . "'";
	$q = $db->query( $sql );
	if ( $db->numrows( $q ) > 0 )
	{
		$f = $db->fetcharray( $q );
		return $f['s_domain'];
	}
	else
	{
		return false;
	}
}

//----------------------------------------------------//
function get_domain( $url )
//----------------------------------------------------//
{
	$parse = parse_url( $url );
	return $parse['host'];
}

//----------------------------------------------------//
function print_rf( $array, $formatted = true, $kill = false, $non_empty_only = false, $ip_restricted = '' )
//----------------------------------------------------//
{
	if ( $ip_restricted != '' )
	{
		if ( $_SERVER['REMOTE_ADDR'] == $ip_restricted )
		{
			$continue = true;
		}
		else
		{
			$continue = false;
		}
	}
	else
	{
		$continue = true;
	}
	
	if ( $continue == true )
	{
		if ( $formatted == true )
		{
			echo '<pre>';
		}
		
		if ( $non_empty_only == true )
		{
			// Rebuild array so it only contains elements with values
			$new_array = array();
			foreach ( $array AS $key => $value )
			{
				if ( $value != '' )
				{
					$new_array[$key] = $value;
				}
			}
			$array = $new_array;
		}
		
		// Output the array
		print_r( $array );
		
		if ( $formatted == true )
		{
			echo '</pre>';
		}
		
		if ( $kill == true )
		{
			die();
		}
	}
}

//----------------------------------------------------//
function show_ads( $unit )
//----------------------------------------------------//
{
	global $db, $conf;

	if ( $unit != '' && $conf['s_id'] != '' )
	{
		// If showing an ad unit for a particular article
		if ( $_REQUEST['id'] != '' )
		{
			// Get article specific ad units
			$channelSQL = " AND channel = '" . $db->makeSafe( $_REQUEST['id'] ) . "' ";
		}
		else
		{
			// Grab ad units that are not channel specific
			$channelSQL = " AND channel = '' ";
		}
	
		$sql = "
		SELECT code 
		FROM sites_ads 
		WHERE
			status = '1'
			AND s_id = '" . $db->makeSafe( $conf['s_id'] ) . "'
			AND unit = '" . $db->makeSafe( $unit ) . "'
			" . $channelSQL . "
		ORDER BY RAND()
		";
		$q = $db->query( $sql );
		if ( $db->numrows( $q ) > 0 )
		{
			$f = $db->fetcharray( $q );
			return $f['code'];	
		}
		else
		{
			// Return regular unit
			$sql = "
			SELECT code 
			FROM sites_ads 
			WHERE
				status = '1'
				AND s_id = '" . $db->makeSafe( $conf['s_id'] ) . "'
				AND unit = '" . $db->makeSafe( $unit ) . "'
			ORDER BY RAND()
			";
			$q = $db->query( $sql );
			if ( $db->numrows( $q ) > 0 )
			{
				$f = $db->fetcharray( $q );
				return $f['code'];	
			}
		}
	}

	return false;
}

//----------------------------------------------------//
function googleRecaptchaV3Check()
//----------------------------------------------------//
{
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => RECAPTCHA_V3_SECRET_KEY,
        'response' => $_REQUEST['token'],
        'remoteip' => $_SERVER['REMOTE_ADDR']
    );
    
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $data ) );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $response = curl_exec( $ch );
    curl_close( $ch );

    $response_decode = json_decode( $response, true );

    if ( $response_decode['success'] == 1 && $response_decode['action'] == $_REQUEST['action'] && $response_decode['score'] >= RECAPTCHA_V3_SCORE_THRESHOLD )
    {
        return true;
    }
    else
    {
        return false;
    }
}

//----------------------------------------------------//
function show_content( $lander, $keyword = '' )
//----------------------------------------------------//
{
	global $db, $conf;

	if ( $conf['s_id'] != '' )
	{
		if ( $keyword != '' )
		{
			$whereSQL = " AND keyword = '" . $db->makeSafe( $keyword ) . "' ";	
		}
		
		$sql = "
		SELECT title, content 
		FROM content 
		WHERE
			status = '1'
			AND s_id = '" . $db->makeSafe( $conf['s_id'] ) . "'
			AND page = '" . $db->makeSafe( $lander ) . "'
			" . $whereSQL . "
		";
		$q = $db->query( $sql );
		if ( $db->numrows( $q ) > 0 )
		{
			$f = $db->fetcharray( $q );
			$content = array(
				'title' => $f['title'],
				'content' => stripslashes( $f['content'] )
			);
			return $content;
		}
		else
		{
			$sql = "
			SELECT title, content 
			FROM content 
			WHERE
				status = '1'
				AND s_id = '" . $db->makeSafe( $conf['s_id'] ) . "'
				AND page = '" . $db->makeSafe( $lander ) . "'
			";
			$q = $db->query( $sql );
			if ( $db->numrows( $q ) > 0 )
			{
				$f = $db->fetcharray( $q );
				$content = array(
					'title' => $f['title'],
					'content' => stripslashes( $f['content'] )
				);
				return $content;	
			}
		}
	}
	return false;
}

?>