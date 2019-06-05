<header class="fl-page-header fl-page-header-fixed fl-page-nav-center fl-page-nav-toggle-<?php echo FLTheme::get_setting( 'fl-mobile-nav-toggle' ); ?> fl-page-nav-toggle-visible-<?php echo FLTheme::get_setting( 'fl-nav-breakpoint' ); ?>">
	<div class="fl-page-header-wrap">
		<div class="fl-page-header-container <?php FLLayout::container_class(); ?>">
			<div class="fl-page-header-row <?php FLLayout::row_class(); ?>">
				<div class="<?php FLLayout::col_classes( array( 'sm' => 12, 'md' => 12 ) ); // @codingStandardsIgnoreLine ?> fl-page-logo-wrap">
					<div class="fl-page-header-logo centered">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php FLTheme::fixed_header_logo(); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header><!-- .fl-page-header-fixed -->
