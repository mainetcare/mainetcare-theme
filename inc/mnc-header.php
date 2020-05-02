<header class="mnc-header mnc-navbar">
    <div class="container navbar navbar-expand navbar-dark flex-column flex-md-row align-items-md-end">
        <a title="Zur Hauptseite" class="mnc-logo mr-0 mr-md-2" href="/" aria-label="MaiNetCare GmbH Logo">
            <img width="150" src="/wp-content/uploads/2019/09/logo_mainetcare_weiss.svg" alt="Logo MaiNetCare GmbH">
        </a>
		<?php
		wp_nav_menu( array(
			// 'theme_location'  => 'menu-1',
			'menu'            => 'main',
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
<?php if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ): ?>
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