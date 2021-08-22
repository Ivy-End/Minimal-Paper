<?php

function custom_plugin_prism() {
    wp_register_style(
        'prismCSS',
        get_template_directory_uri() . '/plugins/prism/prism.css'
    );
    
    wp_register_script(
        'prismJS',
        get_template_directory_uri() . '/plugins/prism/prism.js'
    );
    
    wp_enqueue_style('prismCSS');
    wp_enqueue_script('prismJS');
}
add_action('wp_enqueue_scripts', 'custom_plugin_prism');

function custom_excerpt_length($length) {
    return 256;
}
add_filter('excerpt_length', 'custom_excerpt_length');

?>