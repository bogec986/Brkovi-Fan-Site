<?php get_header(); ?>

<main class="container my-5 pt-4">
    <!-- NASLOV ARHIVE -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold text-body-emphasis">Turneja</h1>
            <p class="lead text-body-secondary">Pratite nas na putu – Punk-Folk-Wellness uživo u vašem gradu!</p>
        </div>
    </div>

    <!-- LISTA KONCERATA -->
    <div class="row g-4">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="col-12">
                <div class="card border-0 shadow-sm overflow-hidden hover-shadow transition-all" style="border-left: 5px solid #d4af37 !important;">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="h4 fw-bold mb-1">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-body-emphasis">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                <p class="text-body-secondary mb-0">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </p>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <a href="<?php the_permalink(); ?>" class="btn btn-dark rounded-pill px-4">
                                    Detalji svirke <i class="bi bi-chevron-right ms-1 small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; else : ?>
            <div class="col-12 text-center py-5">
                <p class="lead text-body-secondary">Trenutno nema zakazanih koncerata. Proverite uskoro!</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- PAGINACIJA -->
    <div class="mt-5">
        <?php the_posts_pagination( array('class' => 'pagination justify-content-center') ); ?>
    </div>
</main>

<style>
    .transition-all { transition: all 0.3s ease; }
    .hover-shadow:hover { transform: translateX(10px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
</style>

<?php get_footer(); ?>
