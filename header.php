<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Simple
 */
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<!-- SEO Comment -->
		<?php 
			if( is_single() || is_page() ) {
			    if( function_exists('get_query_var') ) {
			        $cpage = intval(get_query_var('cpage'));
			        $commentPage = intval(get_query_var('comment-page'));
			    }
			    if( !empty($cpage) || !empty($commentPage) ) {
			        echo '<meta name="robots" content="noindex, nofollow" />';
			        echo "\n";
			    }
			}
		?>

		<!--Support MathJax-->
		<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>

		<!--Support Font Awesome-->
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fonts/font-awesome.css" type="text/css" media="screen" />

		<?php wp_enqueue_script("jquery"); ?>
		<?php wp_head(); ?>

		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/site.js"></script>
	</head>

	<body <?php body_class(); ?>>
		<!-- Left Navigation -->
		<div class="button-up">
			<i class="fa fa-arrow-circle-up"></i>
		</div>

		<div id="page" class="hfeed site">
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'simple' ); ?></a>

			<header id="masthead" class="site-header" role="banner">
				<div class="site-branding">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle" aria-controls="menu" aria-expanded="false">导航</button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #site-navigation -->
			</header><!-- #masthead -->

			<div id="content" class="site-content">
