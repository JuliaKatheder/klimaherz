<?php
register_nav_menus( array( 'footer' => 'Footer Menü' ) );


function klimaherz_enqueue() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600&family=IBM+Plex+Serif:wght@600&display=swap');
}

add_action('wp_enqueue_scripts', 'klimaherz_enqueue');

function remove_actions_parent_theme() {

	remove_action('storefront_header', 'storefront_header_container', 0);
	remove_action('storefront_header', 'storefront_skip_links', 5);
	remove_action('storefront_header', 'storefront_social_icons', 10);
    remove_action('storefront_header', 'storefront_site_branding', 20);
    remove_action('storefront_header', 'storefront_secondary_navigation', 30);
	remove_action('storefront_header', 'storefront_product_search', 40);
	remove_action('storefront_header', 'storefront_header_container_close', 41);
    remove_action('storefront_header', 'storefront_header_cart', 60);
	remove_action('storefront_homepage', 'storefront_homepage_header', 10);
	remove_action('storefront_footer', 'storefront_credit', 20);
	

	if(function_exists('is_product') && !is_product()) remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
	// remove_action('homepage', 'storefront_homepage_content', 10);
	// remove_action('homepage', 'storefront_product_categories', 20 );
	// remove_action('homepage', 'storefront_recent_products', 30 );
	// remove_action('homepage', 'storefront_featured_products', 40 );
	// remove_action('homepage', 'storefront_popular_products', 50 );
	// remove_action('homepage', 'storefront_on_sale_products', 60 );
    // remove_action('homepage', 'storefront_best_selling_products', 70 );
    /**
		 * Functions hooked into storefront_header action
		 *
		 * @hooked storefront_header_container                 - 0
		 * @hooked storefront_skip_links                       - 5
		 * @hooked storefront_social_icons                     - 10
		 * @hooked storefront_site_branding                    - 20
		 * @hooked storefront_secondary_navigation             - 30
		 * @hooked storefront_product_search                   - 40
		 * @hooked storefront_header_container_close           - 41
		 * @hooked storefront_primary_navigation_wrapper       - 42
		 * @hooked storefront_primary_navigation               - 50
		 * @hooked storefront_header_cart                      - 60
		 * @hooked storefront_primary_navigation_wrapper_close - 68
		 */
};

function add_actions_parent_theme() {

    add_action('storefront_header', 'klimaherz_site_branding', 43);
	add_action('storefront_header', 'storefront_header_cart', 60);
	add_action('storefront_footer', 'klimaherz_footer', 20);
	// remove_action('homepage', 'storefront_homepage_content', 10);
	// remove_action('homepage', 'storefront_product_categories', 20 );
	// remove_action('homepage', 'storefront_recent_products', 30 );
	// remove_action('homepage', 'storefront_featured_products', 40 );
	// remove_action('homepage', 'storefront_popular_products', 50 );
	// remove_action('homepage', 'storefront_on_sale_products', 60 );
	// remove_action('homepage', 'storefront_best_selling_products', 70 );
};

add_action( 'init', 'remove_actions_parent_theme', 1);
add_action( 'init', 'add_actions_parent_theme', 2);


if ( ! function_exists( 'klimaherz_footer' ) ) {
	function klimaherz_footer() {
		wp_nav_menu(
			array(
				'theme_location'  => 'footer',
				'container_class' => 'footer-navigation'
			)
		);
	}
}

if ( ! function_exists( 'klimaherz_site_branding' ) ) {
	/**
	 * Site branding wrapper and display
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function klimaherz_site_branding() {
		?>
		<div class="site-branding">
			<?php klimaherz_site_title_and_logo(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'klimaherz_site_title_and_logo' ) ) {
	/**
	 * Display the site title or logo
	 *
	 * @since 2.1.0
	 * @param bool $echo Echo the string or return it.
	 * @return string
	 */
	function klimaherz_site_title_and_logo( $echo = true ) {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$logo = get_custom_logo();
			$html = is_home() ? '<h1 class="logo">' . $logo . '</h1>' : $logo;
		}

		$tag = is_home() ? 'h1' : 'div';
		$html = $html. '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) . '>';

		if ( ! $echo ) {
			return $html;
		}

		echo $html; // WPCS: XSS ok.
	}
}

