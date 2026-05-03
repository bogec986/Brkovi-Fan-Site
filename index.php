<?php get_header(); ?>

<main class="container my-5">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="mb-4">
            <h1><?php the_title(); ?></h1>
            <div><?php the_content(); ?></div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
