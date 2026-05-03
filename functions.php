<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// 1. Učitavanje Composera
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

// 2. Primer test polja (Theme Options)
add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    Container::make( 'theme_options', __( 'Podešavanja Teme' ) )
        ->add_fields( array(
            Field::make( 'text', 'crb_footer_text', 'Footer Text' )
                ->set_default_value( 'Brkovi Punk-Folk-Wellness' ),
        ) );
}


function brkovi_setup() {
    // Podrška za naslove stranica
    add_theme_support('title-tag');
    // Podrška za slike (Featured Image)
    add_theme_support('post-thumbnails');
    // Registracija menija
    register_nav_menus(array(
        'primary' => 'Glavni Meni',
    ));
}
add_action('after_setup_theme', 'brkovi_setup');

function brkovi_enqueue_assets() {
    // Učitavamo tvoj kompajlirani style.css koji u sebi sadrži i Bootstrap i tvoj SCSS
    wp_enqueue_style('brkovi-main-style',  get_template_directory_uri() . '/dist/main.css',  array(), '1.0.0');

    // Bootstrap JS (lokalni iz node_modules ili CDN)
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'brkovi_enqueue_assets');


