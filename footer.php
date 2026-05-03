<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <div class="header-socials">
            <?php
            $socials = carbon_get_theme_option('crb_socials');
            if (! empty($socials)) :
                foreach ($socials as $social) : ?>
                    <a href="<?php echo esc_url($social['url']); ?>"
                        aria-label="<?php echo esc_attr('Posetite naš ' . $social['platform'] . ' profil'); ?>" class="text-decoration-none">
                        <i class="bi bi-<?php echo esc_attr($social['platform']); ?>"></i>
                    </a>
            <?php endforeach;
            endif; ?>
        </div>
        <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> | Punk-Folk-Wellness</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>