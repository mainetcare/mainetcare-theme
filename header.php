<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mncm-theme
 */

?>
    <!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;600&family=Material+Icons&family=Roboto:wght@100;200;300;400;500;700&display=swap"
              rel="stylesheet">
		<?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mncm-theme' ); ?></a>

    <header class="mnc-header mnc-navbar">
        <div class="container navbar navbar-expand navbar-dark flex-column flex-md-row align-items-md-end">
            <a title="Zur Hauptseite" class="mnc-logo mr-0 mr-md-2" href="/" aria-label="MaiNetCare GmbH Logo">
                <img width="150" src="/wp-content/uploads/2019/09/logo_mainetcare_weiss.svg" alt="Logo MaiNetCare GmbH">
            </a>
			<?php
			wp_nav_menu( array(
				// 'theme_location'  => 'menu-1',
				'menu'         => 'main',
				'menu_id'         => 'primary-menu',
				'container'       => 'div',
				'container_class' => 'navbar-nav-scroll ml-md-auto',
				'container_id'    => 'primary-menu-wrap',
				'menu_class'      => 'navbar-nav',
				'fallback_cb'     => '__return_false',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 2,
				'walker'          => new WP_bootstrap_4_walker_nav_menu()
			) );
			?>
        </div>
    </header>
<?php if ( function_exists( 'yoast_breadcrumb' ) && !is_front_page()): ?>
    <div class="container">
    <div class="row">
        <div class="col">
            <div class="mnc-block">
				<?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ) ?>
            </div>
        </div>
    </div>
    </div>
    <?php endif; ?>