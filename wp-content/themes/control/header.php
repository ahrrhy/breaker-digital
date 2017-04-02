<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package control
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'control' ); ?></a>

	<header id="masthead" class="container-fluid site-header" role="banner">
        <div class="row">
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <button class="menu-toggle menu-btn" aria-controls="primary-menu" aria-expanded="false"><img src="<?php echo wp_get_attachment_url(get_theme_mod('control-logo')); ?>" /></button>
                <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'menu_class' => 'custom-menu row', 'container' => 'div', 'container_class' => '') ); ?>
            </nav>
        </div>
        <a class="navbar-brand" id="logo" href="<?php echo site_url(); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="logo" class="img-responsive logo center-block"/></a>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
