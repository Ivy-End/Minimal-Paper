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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/favicon.png" />
		<link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_url'); ?>/favicon.png" />

		<!--Support MathJax-->
		<!-- <script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script> -->

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
			<header id="header" class="site-header" role="banner">
				<div class="site-header-inner">
					<img src = "<?php bloginfo('template_url'); ?>/favicon.png" width="48" style="margin-right: 24px;" />
					<div>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					</div>
				</div><!-- .site-branding -->
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary' ) ); ?>
					<div class="site-search">
						<?php get_search_form(true); ?>
					</div>
				</nav><!-- #site-navigation -->
			</header><!-- #masthead -->

			<div id="content" class="site-content">
