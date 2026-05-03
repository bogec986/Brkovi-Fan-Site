<?php
// inc/options.php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
    Container::make('theme_options', __('Podešavanja Teme'))
        ->add_tab(__('Opšte'), array(
            Field::make('image', 'crb_logo', __('Logo sajta')),
            Field::make('text', 'crb_telefon', __('Telefon'))->set_width(50),
            Field::make('text', 'crb_email', __('Email adresa'))->set_width(50),
            Field::make('image', 'crb_og_image', __('SEO / Social Share Slika'))
                ->set_help_text('Ova slika se pojavljuje kada podelite link sajta na društvenim mrežama.'),

        ))
        ->add_tab(__('Društvene mreže'), array(
            Field::make('complex', 'crb_socials', __('Linkovi'))
                ->add_fields(array(
                    Field::make('select', 'platform', 'Platforma')
                        ->add_options(array(
                            ''          => 'Izaberi platformu',
                            'facebook'  => 'Facebook',
                            'instagram' => 'Instagram',
                            'linkedin'  => 'LinkedIn',
                            'twitter-x' => 'Twitter/X',
                        ))->set_width(30),
                    Field::make('text', 'url', 'URL')->set_width(70),
                ))
                ->set_header_template('<%- platform %>: <%- url %>') // Ovo dodaj
                ->set_layout('grid'), // I ovo

        ));
}
