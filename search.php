<?php get_header(); ?>

<main id="primary" class="site-primary" role="main">

    <?php if ( have_posts() ) : ?>

        <div class="post-card" style="margin-bottom:1rem;">
            <p style="font-size:0.8rem;color:var(--green-dim);">
                &gt; SEARCH_RESULTS FOR: <span style="color:var(--green-bright);">"<?php echo get_search_query(); ?>"</span>
                &nbsp;// <?php echo $wp_query->found_posts; ?> RESULT(S)
            </p>
        </div>

        <div class="posts-container">
        <?php while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content' );
        endwhile; ?>
        </div>

        <nav class="pagination">
            <?php the_posts_pagination( [ 'prev_text' => '[PREV]', 'next_text' => '[NEXT]' ] ); ?>
        </nav>

    <?php else : ?>

        <div class="post-card">
            <h2>&gt;&gt; NO_RESULTS_FOUND</h2>
            <p style="color:var(--green-dim);font-size:0.82rem;">Query returned 0 rows. Try a different search term.</p>
            <?php get_search_form(); ?>
        </div>

    <?php endif; ?>

</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
