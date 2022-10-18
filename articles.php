<?php

$page = 'articles';
$page_google = 'articles';

include 'includes/config.php';
include 'includes/includes.php';
include 'templates/' . $_SESSION['TEMPLATE'] . '/header.php';

// If specific category
if ( $_GET['category_id'] != '' )
{
	$whereSQL = " AND articles.category_id = '" . $db->makeSafe( $_GET['category_id'] ) . "' ";
}

// If specific category
if ( $_GET['search'] != '' )
{
	$whereSQL = " AND articles.title LIKE '%" . $db->makeSafe( $_GET['search'] ) . "%' ";
}

// Regular listings
$sql = "
SELECT articles.id, title, content, articles.category_id, created, status, category_title, content_url
FROM articles
LEFT JOIN articles_categories USING ( category_id )
LEFT JOIN articles_syndication ON articles_syndication.a_id = articles.id
WHERE 
	status = '1'
	AND s_id = '" . $conf['s_id'] . "'
	" . $whereSQL . "
ORDER BY featured ASC, created DESC
LIMIT 100
";
$q = $db->query( $sql );
if ( $db->numrows( $q ) > 0 )
{
	$template_header = new Template;
	$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/loops/articles_header.tpl';
	$template_header->load( $tpl );

	$template_body_output = '';

	$rand_images = array(
		1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15
	);

	while( $f = $db->fetcharray( $q ) )
	{
		// Grab a random number
		$rand_num = array_rand( $rand_images );
		$number = $rand_images[$rand_num];

		$random_image = '/includes/classes/resize.php?src=/templates/' . $_SESSION['TEMPLATE'] . '/images/categories/' . $number . '.jpg&w=120&h=120&zc=1';
		
		if ( $f['content_url'] == '' )
		{
			// Regular content article
			$link = '/article/' . $f['id'] . '-' . makeSeo( $f['title'] );
		}
		else
		{
			// Link out offer
			$link = $f['content_url'];
		}

		$template_body = new Template;
		$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/loops/articles_body.tpl';
		$template_body->load( $tpl );
		
		if ( strlen( $f['title'] ) > 150 )
		{
			$f['title'] = substr( $f['title'], 0, 150 ) . '...';
		}		 
		$f['content'] = strip_tags( $f['content'] );
		$content_limit = 275 - strlen( $f['title'] );
		$f['content'] = substr( $f['content'], 0, $content_limit );

		$template_body->set( 'image', $random_image );
		$template_body->set( 'title', $f['title'] );
		$template_body->set( 'content', $f['content'] );
		$template_body->set( 'date', date( 'm/d/y', strtotime( $f['created'] ) ) );
		$template_body->set( 'link', $link );
		$template_body->set( 'category', $f['category_title'] );
		$template_body->set( 'teaser', substr( $f['content'], 0, 275 ) . '...' );

		$template_body_output .= $template_body->publish(true);
	}

	$template_footer = new Template;
	$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/loops/articles_footer.tpl';
	$template_footer->load( $tpl );	

	$listings = $template_header->publish(true) . $template_body_output . $template_footer->publish(true);
}
else
{
	$listings = 'There are no listings in the system. Please check back later.';
}

$template = new Template;
$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/articles.tpl';
$template->load( $tpl );

$citystate = ( $geo_data['city'] != '' && $geo_data['state'] != '' ) ? $geo_data['city'] . ', ' . $state_list[$geo_data['state']] : ' in your area';

$state_adv = ( $geo_data['state'] != '' ) ? $geo_data['state'] : 'US';
$state_short = ( $geo_data['state'] != '' ) ? $geo_data['state'] : 'US';
$state_full = ( $geo_data['state'] != '' ) ? $state_list[$geo_data['state']] : 'US';

// Variables specific to the article
$template->set( 'heading', 'Article Archive' );
$template->set( 'article_listings', $listings );

// Featured images for slideshow
$template->set( 'link1', $link1 );
$template->set( 'link2', $link2 );
$template->set( 'link3', $link3 );

$template->set( 'image1', $image1 );
$template->set( 'image2', $image2 );
$template->set( 'image3', $image3 );

$template->set( 'title1', $title1 );
$template->set( 'title2', $title2 );
$template->set( 'title3', $title3 );

// General variables
$template->set( 'keywords', $_REQUEST['keywords'] );
$template->set( 'location', $citystate );
$template->set( 'pagination', $pagination );
$template->set( 'state_adv', $state_adv );
$template->set( 'state_short', $state_short );
$template->set( 'state_full', $state_full );
$template->set( 'site', $_SERVER['SERVER_NAME'] );
$template->set( 'link_key', $_SESSION['INCOMING_LINK_KEY'] );
$template->set( 'date', date( 'F d, Y' ) );
$template->set( 'template', $_SESSION['TEMPLATE']);

$template->publish();

include 'templates/' . $_SESSION['TEMPLATE'] . '/footer.php'; 

?>