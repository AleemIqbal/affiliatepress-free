<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head() ?>
</head>

<body <?php body_class() ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content" tabindex="1">
<?php _e( 'Skip to content', 'affiliatepress' ); ?></a>
    <header class="header" id="masthead" itemtype="https://schema.org/WPHeader" itemscope itemid="#masthead" tabindex="-1">
        <div class="container">
            <div class="topnav-inner">
                <div class="logo">
                    <?php echo the_custom_logo() ?>
                    <?php if (is_home()) echo '<h1>' . get_bloginfo('name') . '</h1>' ?>
                    <button class="hamburger" aria-label="<?php echo esc_attr__( 'menu', 'affiliatepress' ); ?>">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <nav class="navigation" role="navigation" vocab="https://schema.org/" typeof="SiteNavigationElement" resource="<?php echo esc_url( home_url() ) ?>/#MainNavigation">
                <?php
                    if ( has_nav_menu( 'primary_menu' ) ) {
                    wp_nav_menu(array('theme_location' => "primary_menu", 'link_before' => '<span property="name">', 'link_after' => '</span>', 'after' => "<span class='menu-item__open-btn'>" . affiliatepress_get_the_svg("arrow_right") . "</span>"));
                    }
                ?>
                </nav>
            </div>
        </div>
    </header>
    <div class="site-content">
        <div class="container">
            <?php get_template_part("template-parts/other/breadcrumb"); ?>
            <div class="main">
                <?php do_action('before_page');
