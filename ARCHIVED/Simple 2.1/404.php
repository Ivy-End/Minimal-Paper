<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<!--Support MathJax-->
		<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>

		<!--Support Font Awesome-->
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fonts/font-awesome.css" type="text/css" media="screen" />

		<?php wp_enqueue_script("jquery"); ?>
		<?php wp_head(); ?>

		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/site.js"></script>
	</head>

	<body <?php body_class(); ?>>

		<div id="page" class="hfeed site404">
			<div class="site-content404">
				<header class="site-header404">
					<div class="site-title404">
						<span>404</span>
					</div>
				</header>
				<section>
					<a class="back404" rel="nofollow" href="<?php echo esc_url( home_url( '/' ) ); ?>">返回首页</a>
				</section>

				<div class="site-info404">
					<span>Copyright © 2013-<?php echo date('Y'); ?></span>
					<a href="http://www.ivy-end.com">Ivy_End</a>
				</div>
			</div>
		</div>

<?php wp_footer(); ?>

	</body>
</html>