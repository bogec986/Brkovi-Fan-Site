<?php get_header(); ?>

<main class="container my-5 pt-4">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <!-- HEADER PROJEKTA / KONCERTA -->
            <header class="entry-header mb-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('brkovi_event'); ?>" class="text-decoration-none text-secondary">Svi koncerti</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
                    </ol>
                </nav>
                <h1 class="display-3 fw-bold text-body-emphasis"><?php the_title(); ?></h1>
            </header>

            <!-- SADRŽAJ (Ovde se renderuje tvoj "Info o Koncertu" blok) -->
            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <!-- FOOTER POSTA -->
            <footer class="mt-5 pt-4 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?php echo get_post_type_archive_link('brkovi_event'); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i> Nazad na turneju
                    </a>
                    <div class="share-links">
                        <span class="small text-muted me-2">Podeli:</span>
                        <a href="https://facebook.com<?php the_permalink(); ?>" target="_blank" class="text-secondary mx-1"><i class="bi bi-facebook"></i></a>
                        <a href="https://twitter.com<?php the_permalink(); ?>" target="_blank" class="text-secondary mx-1"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </footer>

        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
