<?php
/**
 * Bootstrap Theme for YOURLS
 *
 * @author Leo Colombaro
 * @package YOURLS
 */

// Is there things to display? If so, let's add our stuff
yourls_add_action( 'init_theme', 'lc_full_bootstrap_init' );

/**
 * Init Bootstrap Theme
 */
function lc_full_bootstrap_init() {
	yourls_add_filter( 'template_content', 'lc_full_bootstrap_template' );
	lc_full_bootstrap_add_css();
	yourls_add_filter( 'admin_menu_start', 'lc_full_bootstrap_menu_start' );
	yourls_add_filter( 'admin_menu_end', 'lc_full_bootstrap_menu_end' );
	yourls_add_filter( 'logout_link', 'lc_full_bootstrap_logout_link' );
}

/**
 * Rewrite template
 *
 * @param array $elements   Default template
 * @return array            New structure
 */
function lc_full_bootstrap_template( $elements ) {
	lc_full_bootstrap_replace_in_array( $elements, 'yourls_sidebar_start', 'lc_full_bootstrap_nav_start' );
	lc_full_bootstrap_remove_from_array( $elements, 'yourls_html_global_stats' );
	lc_full_bootstrap_remove_from_array( $elements, 'yourls_html_footer' );
	lc_full_bootstrap_replace_in_array( $elements, 'yourls_sidebar_end', 'lc_full_bootstrap_nav_end' );
	return $elements;
}

/**
 * Add required Styles
 */
function lc_full_bootstrap_add_css() {
	yourls_enqueue_style( 'lc_full_bootstrap_css', yourls_get_active_theme_url() . '/css/bootstrap.min.css' );
}

/**
 * Rewrite Nav begining
 */
function lc_full_bootstrap_nav_start() {
	echo '<header class="navbar navbar-inverse navbar-fixed-top" role="banner"><div class="container">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	  <span class="sr-only">Toggle navigation</span>
	  <span class="icon-bar"></span>
	  <span class="icon-bar"></span>
	  <span class="icon-bar"></span>
	</button>';
}

/**
 * Rewrite Nav ending
 */
function lc_full_bootstrap_nav_end() {
	echo '</div></header>';
}

/**
 * Rewrite admin-menu begining
 */
function lc_full_bootstrap_menu_start( $menu ) {
	return '<nav class="collapse navbar-collapse navbar-ex1-collapse" role="navigation"><ul class="nav navbar-nav">';
}

/**
 * Rewrite admin-menu ending
 */
function lc_full_bootstrap_menu_end( $menu ) {
	return '</ul>' . lc_full_bootstrap_logout_link( '', true ) . '</nav>' ;
}

/**
 * Rewrite logout link
 *
 * @param string $link   Default element
 * @param string $show   Allow muting
 * @return string        Logout element (HTML)
 */
function lc_full_bootstrap_logout_link( $link, $show = false ) {
	if( $show && yourls_is_private() && defined( 'YOURLS_USER' ) ) {
		return '<div class="navbar-right"><p class="navbar-text">' . sprintf( yourls__( 'Hello <strong>%s</strong>' ), YOURLS_USER ) . '</p><a href="?action=logout" title="' . yourls_esc_attr__( 'Logout' ) . '" class="btn btn-default navbar-btn"><i class="icon-signout"></i> ' . yourls__( 'Logout' ) . '</a></div>';
	} else
		return '';
}

/**
 * Helper unction to remove an element, based on its value, from a multidimensional array
 */
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

/**
 * Helper function to replace an element, based on its value, by another one, inside a multidimensional array
 */
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
