<?php
/*
Theme Name: Full Bootstrap
Theme URI: http://getbootstrap.com
Description: hhhh
Version: 1.0
Author: Leo Colomb
Author URI: http://colombaro.fr/
*/

yourls_add_filter( 'html_template_content', 'lpc_full_bootstrap_template' );
yourls_add_filter( 'html_assets_queue', 'lpc_full_bootstrap_assets' );

function lpc_full_bootstrap_template() {
    return $elements = array(
        'before' => array(
			'yourls_wrapper_start',
            'lpc_full_bootstrap_nav_start',
            'yourls_html_logo',
            'yourls_html_menu',
            'lpc_full_bootstrap_nav_end',
            ),
        'after' => array(
        	'yourls_html_footer',
			'yourls_wrapper_end',
        ),
    );
}

function lpc_full_bootstrap_assets() {
    return $assets = array(
        'css' => array(
            'bootstrap.min',
            ),
    );
}

function lpc_full_bootstrap_nav_start() {
    ?>
    <div class="navbar navbar-static-top">
<?php
}

function lpc_full_bootstrap_nav_end() {
    ?>
    </div>
<?php
}