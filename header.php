<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- SEO & Open Graph -->
        <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <meta name="description" content="<?php echo esc_attr( is_single() ? wp_trim_words(get_the_excerpt(), 25) : get_bloginfo('description') ); ?>">

    <!-- Facebook / Open Graph -->
    <meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <meta property="og:title" content="<?php echo is_single() ? get_the_title() : get_bloginfo('name'); ?>">
    <meta property="og:description" content="<?php echo is_single() ? wp_trim_words(get_the_excerpt(), 25) : get_bloginfo('description'); ?>">
    <?php 
    $og_img_id = is_single() && has_post_thumbnail() ? get_post_thumbnail_id() : carbon_get_theme_option('crb_og_image');
    if ($og_img_id) : ?>
        <meta property="og:image" content="<?php echo esc_url(wp_get_attachment_image_url($og_img_id, 'full')); ?>">
    <?php endif; ?>

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo is_single() ? get_the_title() : get_bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php echo is_single() ? wp_trim_words(get_the_excerpt(), 25) : get_bloginfo('description'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- LOGO IZ THEME OPTIONS -->
            <a class="navbar-brand fw-bold" href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                $logo_id = carbon_get_theme_option('crb_logo');
                if ($logo_id) :
                    echo wp_get_attachment_image($logo_id, 'full', false, array(
                        'style' => 'max-height: 40px; width: auto;',
                        'class' => 'd-inline-block align-top'
                    ));
                else :
                    bloginfo('name');
                endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'navbar-nav ms-auto',
                    'fallback_cb' => '__return_false',
                ));
                ?>
            </div>
        </div>
    </nav>