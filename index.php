<?php get_header(); ?>

<main id="primary" class="site-primary" role="main">

    <?php if ( have_posts() ) : ?>

        <div class="posts-container">
        <?php
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', get_post_format() );
        endwhile;
        ?>
        </div><!-- .posts-container -->

        <!-- Pagination -->
        <nav class="pagination" role="navigation" aria-label="<?php esc_attr_e( 'Posts navigation', 'deepquest-terminal' ); ?>">
            <?php
            the_posts_pagination( [
                'prev_text'          => '[PREV]',
                'next_text'          => '[NEXT]',
                'before_page_number' => '',
                'after_page_number'  => '',
            ] );
            ?>
        </nav>

    <?php else : ?>

        <div class="post-card">
            <h2 class="post-title">&gt;&gt; NO_RESULTS_FOUND</h2>
            <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Try a search?', 'deepquest-terminal' ); ?></p>
            <?php get_search_form(); ?>
        </div>

    <?php endif; ?>

</main><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
