<?php get_header(); ?>

<main id="primary" class="site-primary" role="main">

    <div class="post-card" style="padding: 3rem 1.5rem; text-align: center;">
        <h1 style="font-size:5rem;color:var(--green-bright);text-shadow:var(--glow-lg);margin-bottom:0.5rem;">404</h1>
        <h2 style="font-size:1.5rem;margin-bottom:1rem;">:: PAGE_NOT_FOUND ::</h2>
        <p style="color:var(--green-dim);margin-bottom:0.5rem;">The page you requested could not be located.</p>
        <p style="color:var(--green-dark);font-size:0.8rem;margin-bottom:2rem;">ERROR: 404 // PATH_UNRESOLVED // <?php echo esc_html( $_SERVER['REQUEST_URI'] ?? '' ); ?></p>
        <div style="font-size:0.8rem;color:var(--green-dim);">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:inline-block;border:var(--border-bright);padding:0.4rem 1.2rem;color:var(--green-bright);">
                &lt; RETURN_TO_INDEX
            </a>
        </div>
    </div>

</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
