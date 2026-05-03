<?php
function brkovi_register_events_cpt()
{
    $labels = array(
        'name'               => 'Koncerti',
        'singular_name'      => 'Koncert',
        'add_new'            => 'Dodaj novi koncert',
        'all_items'          => 'Svi koncerti',
        'edit_item'          => 'Izmeni koncert',
        'menu_name'          => 'Turneja (Events)'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-performance',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true, // Važno za Gutenberg
        'rewrite'            => array('slug' => 'koncerti'),
        'template' => array(
            array('carbon-fields/podaci-o-koncertu'), // Automatski ubacuje tvoj blok
        ),
        'template_lock' => 'all', // Opciono: klijent ne može da obriše blok, samo da popuni polja
    );

    register_post_type('brkovi_event', $args);
}
add_action('init', 'brkovi_register_events_cpt');
