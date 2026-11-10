<?php get_header(); ?>

<main id="primary" class="site-primary" role="main">

    <div class="post-card" style="margin-bottom:1rem;">
        <header class="page-header">
            <?php
            if ( is_category() ) {
                echo '<h1 class="page-title">&gt;&gt; CATEGORY: ' . esc_html( single_cat_title( '', false ) ) . '</h1>';
            } elseif ( is_tag() ) {
                echo '<h1 class="page-title">&gt;&gt; TAG: #' . esc_html( single_tag_title( '', false ) ) . '</h1>';
            } elseif ( is_author() ) {
                echo '<h1 class="page-title">&gt;&gt; AUTHOR: ' . esc_html( get_queried_object()->display_name ) . '</h1>';
            } elseif ( is_date() ) {
                echo '<h1 class="page-title">&gt;&gt; ARCHIVE: ' . esc_html( get_the_date( 'Y-m' ) ) . '</h1>';
            } else {
                the_archive_title( '<h1 class="page-title">&gt;&gt; ', '</h1>' );
            }
            ?>
        </header>
    </div>

    <?php if ( have_posts() ) : ?>
        <div class="posts-container">
        <?php while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content' );
        endwhile; ?>
        </div>

        <nav class="pagination">
            <?php the_posts_pagination( [ 'prev_text' => '[PREV]', 'next_text' => '[NEXT]' ] ); ?>
        </nav>

    <?php else : ?>
        <div class="post-card"><p><?php esc_html_e( 'No posts found.', 'deepquest-terminal' ); ?></p></div>
    <?php endif; ?>

</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
