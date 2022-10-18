<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://us8.api.mailchimp.com/3.0/lists/bc4e844716/members/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "email_address": "'.$_SESSION['emails'].'",
    "status": "subscribed",
    "merge_fields": {
        "FNAME": "'.$_SESSION['firstname'].'",
        "L_NAME": "'.$_SESSION['lastname'].'",
        "ADDR1": "'.$_POST['address'].'",
        "PHONE": "'. $_SESSION['phone1'].'",
        "DATE1": "'.$_SESSION['move_date'].'",
        "ZIP": "'.$_SESSION['zip2'].'",
        "STATE": "'.$_SESSION['state2'].'",
        "CITY": "'.$_SESSION['city2'].'"
    }
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic YW55c3RyaW5nOjlhMzVhNGI4YjVlZjZlNjQxN2Y4YTM0Mjc4MGRjZDI2LXVzOA==',
    'Content-Type: application/json',
    'Cookie: ak_bmsc=3455914E3712659D1C18107916A1FFD7~000000000000000000000000000000~YAAQHx0gF+mNLgt8AQAAjQY/QQ0GgI2a7yB0xrzbHXUU1Mdg1PBrYbGBO9nvivWriw4CVMLvMUv9KAIOPyb0gaf5fk58sO7APN4dSjOKPt46nCUp69TkHr5GUccnfOq1q/xaLTcnLey/49jEYBVmYIs9xr4501+688LoAfkzC1TfNd3T6EZl1r04mZzaEB8eYzoMgzJnOqXhw0aawEWgQzjPS5RIWDeeN6dRZKXkab5DiS+k2l32z7EjOWOYFKz3NM6vR+MEeXObVndzkURo1CqAV3oJtu5ZbAfhG+M9ib8jnoouAxaMCZiUsxYcf1AyL574Prw1C0DF6KixXBDiMxhOcqcQGQ7WDiJWPkPKANIly5vh+FPCgBxf5KPMLd0pwSW1QQ==; bm_sv=E250B6B80CC611D65EC1B58523FD711E~0u0RYbXaDrIlPgf5nugqeCTkuKf0nmkl/CRosJ8wycv7h2ToHF7M0qxMadZqgXIUXRRfcSYJ126P0inHU/kDGexDILwABh5Hcr5G1V6yFbHj/vHCVL5vx3X/fyiNY+vRugg+ls6tsfmQodzjIpiYL1O32RS55fEDM88y/B5EV/4='
  ),
));

$response = curl_exec($curl);
curl_close($curl);


if ( $_POST['address'] != '' )
{
	$sql = "
	UPDATE leads
	SET
		address1 = '" . $db->makeSafe( $_POST['address'] ) . "'
	WHERE
		session_id = '" . $db->makeSafe( session_id() ) . "'
	";
	$db->query( $sql );
	

} else if ($_SESSION['auto_moving']){

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
			auto_model, auto_make, auto_year,
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
			'" . $db->makeSafe( $_SESSION['source_id'] ) . "',
			'" . $db->makeSafe( 4 ) . "',
			'" . $db->makeSafe( $_SESSION['firstname'] ) . "',
			'" . $db->makeSafe( $_SESSION['lastname'] ) . "',
			'" . $db->makeSafe( $_SESSION['email'] ) . "',
			'" . $db->makeSafe( $_SESSION['phone1'] ) . "',
			'" . $db->makeSafe( $_SESSION['phone1_area_code'] ) . "',
			'" . $db->makeSafe( $_SESSION['phone1_region_code'] ) . "',
			'" . $db->makeSafe( $_SESSION['phone1_line_code'] ) . "',
			'" . $db->makeSafe( $_SESSION['city1'] ) . "',
			'" . $db->makeSafe( $_SESSION['state1'] ) . "',
			'" . $db->makeSafe( $_SESSION['country1'] ) . "',
			'" . $db->makeSafe( $_SESSION['zip1'] ) . "',
			'" . $db->makeSafe( $_SESSION['city2'] ) . "',
			'" . $db->makeSafe( $_SESSION['state2'] ) . "',
			'" . $db->makeSafe( $_SESSION['country2'] ) . "',
			'" . $db->makeSafe( $_SESSION['zip2'] ) . "',
			'" . $db->makeSafe( $_SESSION['move_date'] ) . "',
			'" . $db->makeSafe( $_SESSION['move_year'] ) . "',
			'" . $db->makeSafe( $_SESSION['move_month'] ) . "',
			'" . $db->makeSafe( $_SESSION['move_day'] ) . "',
			'" . $db->makeSafe( $_SESSION['move_size'] ) . "',
			'" . $db->makeSafe( $_SESSION['move_type'] ) . "',
			'" . $db->makeSafe( $_SESSION['move_auto'] ) . "',
			'" . $db->makeSafe( $_SESSION['auto'] ) . "',
			'" . $db->makeSafe( $_POST['car-models'] ) . "',
			'" . $db->makeSafe( $_POST['car-makes'] ) . "',
			'" . $db->makeSafe( $_POST['car-years'] ) . "',
			'" . date( 'Y-m-d' ) . "',
			'" . date( 'Y-m-d H:i:s' ) . "',
			'" . date( 'Y-m-d H:i:s' ) . "',
			'" . $db->makeSafe( $_SERVER['REMOTE_ADDR'] ) . "',
			'" . $db->makeSafe( $_SESSION['lead_source'] ) . "',
			'" . $db->makeSafe( $_SESSION['test_lead_id'] ) . "',
			'" . $db->makeSafe( $_SESSION['test_lead'] ) . "',
			'" . $db->makeSafe( $_SERVER['HTTP_USER_AGENT'] ) . "',
			'" . $db->makeSafe( $_SERVER['HTTP_REFERRER'] ) . "',
			'" . $db->makeSafe( $_SESSION['lander'] ) . "',
			'" . $_SESSION['device'] . "',
			'" . session_id() . "',
			'" . $db->makeSafe( $_SESSION['lead_intake_type'] ) . "',
			'" . $db->makeSafe( $_SESSION['lead_source_network'] ) . "',
			'" . $db->makeSafe( $_SESSION['p_type'] ) . "',
			'" . $db->makeSafe( $_SESSION['xxTrustedFormCertUrl'] ) . "',
			'" . $db->makeSafe( $_SESSION['trustedform_status'] ) . "',
			'" . $db->makeSafe( $_SESSION['gclid'] ) . "',
			'" . $db->makeSafe( $_SESSION['fbclid'] ) . "',
			'" . $db->makeSafe( $_SESSION['channel'] ) . "',
			'" . $db->makeSafe( $_SESSION['traffic_source_id'] ) . "',
			'" . $db->makeSafe( $_SESSION['sub1'] ) . "',
			'" . $db->makeSafe( $_SESSION['sub2'] ) . "',
			'" . $db->makeSafe( $_SESSION['sub3'] ) . "',
			'" . $db->makeSafe( $_SESSION['sub4'] ) . "',
			'" . $db->makeSafe( $_SESSION['sub5'] ) . "',
			'" . $db->makeSafe( $_SESSION['CBSA'] ) . "',
			'" . $db->makeSafe( $_SESSION['status_1'] ) . "',
			'" . $db->makeSafe( $_SESSION['status_2'] ) . "',
			'" . $db->makeSafe( $_SESSION['status_3'] ) . "',
			'" . $db->makeSafe( $_SESSION['status_4'] ) . "'
		)
	";

	$db->query( $sql );
	$_SESSION['auto_moving'] = false;
}

?>

<section class="page-banner">
	<div class="container">
		<h1>Thank you!</h1>
	</div>
</section>

<section class="section-services">
	<div class="container">
		<h3>Done! Be ready to answer your phone - our moving pros will call you to get more details about your move soon.</h3><br>
		<h3>Need faster service call now: (844)501-2029</h3>
		<div class="row d-flex justify-content-center">
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-residential.svg">
					<div class="service-content">
						<h2>Connect with contractors</h2>
						<p>Need work done or looking to start a project? Get help from local professionals for any job.</P>
					</div>
					<a href="http://thumbtack.57ib.net/c/2954377/269257/4348?utm_source=cma-affiliate" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-storage.svg">
					<div class="service-content">
						<h2>Get junk removed</h2>
						<p>Have some stuff to get rid of? Fast and easy junk removal.</P>
					</div>
					<a href="https://shareasale.com/r.cfm?b=1094034&u=2921664&m=75506" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-packaging.svg">
					<div class="service-content">
						<h2>Storage</h2>
						<p>Got stuff that won't fit in the next place? You don't have to part with any of your belongings. Store all your extra items safely.</P>
					</div>
					<a href="https://neighbor.pxf.io/c/2954377/1234108/14066" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
		</div>
		<div class="row d-flex justify-content-center">
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-commercial.svg">
					<div class="service-content">
						<h2>New home decoration</h2>
						<p>Want to decorate but don't know where to start? Explore tons of exciting options.</P>
					</div>
					<a href="https://www.tkqlhce.com/click-100467847-13771918" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-furniture.svg">
					<div class="service-content">
						<h2>Packing</h2>
						<p>Need help organizing for the big move?  Get high quality packing supplies to assist.</P>
					</div>
					<a href="https://shareasale.com/r.cfm?b=883129&u=2921664&m=66601" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-recycling.svg">
					<div class="service-content">
						<h2>Solar panels</h2>
						<p>Interested in renewable energy for your new home? Evaluate Solar options that work for you and your family.</P>
					</div>
					<a href="https://renogy.sjv.io/c/2954377/1200167/14864" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
		</div>
	</div>
</section>

 <script async src="https://www.googletagmanager.com/gtag/js?id=AW-869690515"></script>
<script>
 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'AW-869690515');
</script>
<script>
  gtag('event', 'conversion', {'send_to': 'AW-869690515/HT3nCOr9vvcCEJPZ2Z4D'});
</script> 