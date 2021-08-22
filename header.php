<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="<?php bloginfo('description'); ?>">
        
        <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/favicon.png" />
		<link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_url'); ?>/favicon.png" />

        <!-- Support Fontawesome -->
        <script src="https://kit.fontawesome.com/aecc5615d4.js" crossorigin="anonymous"></script>

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>

        <div id="wrapper" class="hfeed">
            <header id="header" role="banner">
                <div id="branding">
                    <div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                        <img src = "<?php bloginfo('template_url'); ?>/favicon.png"/>
                        <div>
                            <a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>" rel="home" itemprop="url">
                                <span itemprop="name"><?php echo esc_html( get_bloginfo( 'name' ) ) ?></span>
                            </a>
                            <!-- <span id="site-description"><?php echo bloginfo( 'description' ); ?></span> -->
                        </div>
                    </div>
                </div>

                <nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
                    <div id="search">
                        <?php get_search_form(); ?>
                    </div>
                </nav>
            </header>

            <div id="container">