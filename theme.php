<?php

// Is there things to display? If so, let's add our stuff
yourls_add_action( 'init_theme', 'lc_full_bootstrap_init' );
function lc_full_bootstrap_init() {
	yourls_add_filter( 'template_content', 'lc_full_bootstrap_template' );
	lc_full_bootstrap_add_css();
	yourls_add_filter( 'admin_menu_start', 'lc_full_bootstrap_menu_start' );
}

function lc_full_bootstrap_template( $elements ) {
	lc_full_bootstrap_replace_in_array( $elements, 'yourls_sidebar_start', 'lc_full_bootstrap_nav_start' );
	lc_full_bootstrap_remove_from_array( $elements, 'yourls_html_global_stats' );
	lc_full_bootstrap_remove_from_array( $elements, 'yourls_html_footer' );
	lc_full_bootstrap_replace_in_array( $elements, 'yourls_sidebar_end', 'lc_full_bootstrap_nav_end' );
	return $elements;
}

function lc_full_bootstrap_add_css() {
	yourls_enqueue_style( 'lc_full_bootstrap_css', yourls_get_active_theme_url() . '/css/bootstrap.min.css' );
}

function lc_full_bootstrap_nav_start() {
	echo '<nav class="navbar navbar-fixed-top" role="navigation">';
}

function lc_full_bootstrap_nav_end() {
	echo '</nav>';
}

function lc_full_bootstrap_menu_start( $menu ) {
	$menu = '<div class="collapse navbar-collapse navbar-ex1-collapse"><ul class="nav navbar-nav">';
	return $menu;
}

// Helper unction to remove an element, based on its value, from a multidimensional array
function lc_full_bootstrap_remove_from_array( &$array, $remove ) { 
	foreach( $array as $key => &$value ) { 
		if( is_array( $value ) ) { 
			lc_full_bootstrap_remove_from_array( $value, $remove ); 
		} else {
			if( $remove == $value ) {
				unset( $array[ $key ] );
			}
		}
	}
}

// Helper function to replace an element, based on its value, by another one, inside a multidimensional array
function lc_full_bootstrap_replace_in_array( &$array, $replace, $with ) { 
	foreach( $array as $key => &$value ) { 
		if( is_array( $value ) ) { 
			lc_full_bootstrap_replace_in_array( $value, $replace, $with ); 
		} else {
			if( $replace == $value ) {
				$array[ $key ] = $with;
			}
		}
	}
}
