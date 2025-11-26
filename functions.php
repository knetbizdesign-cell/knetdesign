<?php

function borobill_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption']);

    register_nav_menus([
        'primary' => 'Primary Menu',
    ]);
}
add_action('after_setup_theme', 'borobill_theme_setup');


function borobill_enqueue_assets() {
    wp_enqueue_style('pretendard', 'https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.min.css');
    wp_enqueue_style('borobill-style', get_stylesheet_uri(), [], '1.0');

    wp_enqueue_script('jquery');
    wp_enqueue_script('borobill-main', get_template_directory_uri() . '/js/main.js', ['jquery'], '1.0', true);
}
add_action('wp_enqueue_scripts', 'borobill_enqueue_assets');


function borobill_post_date() {
    return get_the_date('Y.m.d');
}
