<?php

// Is there things to display? If so, let's add our stuff
yourls_add_action( 'init_theme', 'lc_full_bootstrap_init' );
function lc_full_bootstrap_init() {
	yourls_add_filter( 'template_content', 'lc_full_bootstrap_template' );
	lc_full_bootstrap_add_css();
}

function lc_full_bootstrap_template( $elements ) {
	sample_theme_replace_in_array( $elements, 'yourls_sidebar_start', 'lc_full_bootstrap_nav_start' );
	sample_theme_replace_in_array( $elements, 'yourls_sidebar_end', 'lc_full_bootstrap_nav_end' );
}

function lc_full_bootstrap_add_css() {
	yourls_enqueue_style( 'lc_full_bootstrap_css', yourls_get_active_theme_url() . '/css/bootstrap.min.css' );
}

function lc_full_bootstrap_nav_start() {
    echo '<div class="navbar navbar-static-top">';
}

function lc_full_bootstrap_nav_end() {
    echo '</div>';
}