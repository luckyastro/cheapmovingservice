<?php

$page = 'view-article';
$page_google = 'view-article';

include 'includes/config.php';
include 'includes/includes.php';
include 'templates/' . $_SESSION['TEMPLATE'] . '/header.php';

// Look up this article
if ( $_GET['id'] != '' )
{
	$sql = "
	SELECT articles.id, title, content, articles.category_id, created, status, category_title
	FROM articles
	LEFT JOIN articles_categories USING ( category_id )
	LEFT JOIN articles_syndication ON articles_syndication.a_id = articles.id
	WHERE 
		status = '1'
		AND articles.id = '" . $db->makeSafe( $_GET['id'] ) . "'
		AND articles_syndication.s_id = '" . $conf['s_id'] . "'
	";
	$q = $db->query( $sql );
	if ( $db->numrows( $q ) > 0 )
	{
		$f = $db->fetcharray( $q );
	}
	else
	{
		$redirect = true;
	}
}
else
{
	$redirect = true;
}

// Redirect if not found
if ( $redirect == true )
{
	header( 'Location: /articles.php' );
	exit();
}

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
	AND articles.id != '" . $db->makeSafe( $_GET['id'] ) . "'
	AND articles_syndication.s_id = '" . $conf['s_id'] . "'
	AND clicks >= 10
	AND date BETWEEN '" . date( 'Y-m-d', strtotime( 'now -1 week' ) ) . "' AND '" . date( 'Y-m-d' ) . "'
GROUP BY articles.id
ORDER BY cpc DESC
LIMIT 4
";
$q2 = $db->query( $sql );
if ( $db->numrows( $q2 ) == 0 )
{
	// Just grab any articles randomly
	$sql = "
	SELECT 
		articles.id, title, content, articles.category_id, created, status, category_title, content_url
	FROM articles
	LEFT JOIN articles_categories USING ( category_id )
	LEFT JOIN articles_syndication ON articles_syndication.a_id = articles.id
	WHERE 
		status = '1'
		AND articles.id != '" . $db->makeSafe( $_GET['id'] ) . "'
		AND articles_syndication.s_id = '" . $conf['s_id'] . "'
	ORDER BY RAND()
	LIMIT 4
	";	
	$q2 = $db->query( $sql );
}
	
$template_header = new Template;
$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/loops/random_articles_header.tpl';
$template_header->load( $tpl );

$template_body_output = '';

$rand_images = array(
	1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15
);

while( $f2 = $db->fetcharray( $q2 ) )
{
	// Grab a random number
	$rand_num = array_rand( $rand_images );
	$number = $rand_images[$rand_num];

	// Remove this from being available to choose from
	unset( $rand_images[$rand_num] );

	$random_image = '/includes/classes/resize.php?src=/templates/' . $_SESSION['TEMPLATE'] . '/images/categories/' . $number . '.jpg&w=120&h=120&zc=1';

	if ( $f2['content_url'] == '' )
	{
		// Regular content article
		$link = '/article/' . $f2['id'] . '-' . makeSeo( $f2['title'] );
	}
	else
	{
		// Link out offer
		$link = $f2['content_url'];
	}

	$template_body = new Template;
	$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/loops/random_articles_body.tpl';
	$template_body->load( $tpl );
	
	if ( strlen( $f2['title'] ) > 150 )
	{
		$f2['title'] = substr( $f2['title'], 0, 150 ) . '...';
	}		 
	$f2['content'] = strip_tags( $f2['content'] );
	$content_limit = 275 - strlen( $f2['title'] );
	$f2['content'] = substr( $f2['content'], 0, $content_limit );

	$template_body->set( 'image', $random_image );
	$template_body->set( 'title', $f2['title'] );
	$template_body->set( 'content', $f2['content'] );
	$template_body->set( 'date', date( 'm/d/y', strtotime( $f2['created'] ) ) );
	$template_body->set( 'link', $link );
	$template_body->set( 'category', $f2['category_title'] );
	$template_body->set( 'teaser', substr( $f2['content'], 0, 275 ) . '...' );

	$template_body_output .= $template_body->publish(true);
}

$template_footer = new Template;
$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/loops/random_articles_footer.tpl';
$template_footer->load( $tpl );	

$random_articles = $template_header->publish(true) . $template_body_output . $template_footer->publish(true);

$template = new Template;
$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/view_article.tpl';
$template->load( $tpl );

$citystate = ( $geo_data['city'] != '' && $geo_data['state'] != '' ) ? $geo_data['city'] . ', ' . $state_list[$geo_data['state']] : ' in your area';

$state_adv = ( $geo_data['state'] != '' ) ? $geo_data['state'] : 'US';
$state_short = ( $geo_data['state'] != '' ) ? $geo_data['state'] : 'US';
$state_full = ( $geo_data['state'] != '' ) ? $state_list[$geo_data['state']] : 'US';

// Get ad units for this site
//$ad_unit = '<div style="float:left;padding:10px;">' . show_ads( '336x280' ) . '</div>';
//$ad_unit2 = show_ads( 'responsive' );

// Variables specific to the article
$template->set( 'article_text', nl2br( $ad_unit . $f['content'] . '<br /><br />' . $ad_unit2 ) );
$template->set( 'heading', $f['title'] );
$template->set( 'category', $f['category_title'] );
$template->set( 'date', date( 'F d, Y', strtotime( $f['created'] ) ) );
$template->set( 'MEDIA_URL', '/includes/classes/resize.php?w=585&h=450&zc=2&src=/media/articles' );
$template->set( 'random_articles', $random_articles );

// General variables
$template->set( 'keywords', $_REQUEST['keywords'] );
$template->set( 'location', $citystate );
$template->set( 'pagination', $pagination );
$template->set( 'state_adv', $state_adv );
$template->set( 'state_short', $state_short );
$template->set( 'state_full', $state_full );
$template->set( 'site', $_SERVER['SERVER_NAME'] );
$template->set( 'link_key', $_SESSION['INCOMING_LINK_KEY'] );
$template->set( 'template', $_SESSION['TEMPLATE']);

$template->publish();

include 'templates/' . $_SESSION['TEMPLATE'] . '/footer.php'; 

?>