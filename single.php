<?php get_header(); ?>

<main id="primary" class="site-primary" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Post Header -->
            <div class="single-post-header">

                <?php
                $categories = get_the_category();
                if ( $categories ) : ?>
                    <div class="post-category">
                        <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                            [<?php echo esc_html( strtoupper( $categories[0]->name ) ); ?>]
                        </a>
                    </div>
                <?php endif; ?>

                <h1 class="single-post-title">&gt;&gt; <?php the_title(); ?></h1>

                <div class="single-post-meta">
                    <span>USER: <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
                    <span>//</span>
                    <span>DATE: <?php echo get_the_date( 'Y-m-d H:i' ); ?></span>
                    <span>//</span>
                    <span>MODIFIED: <?php echo get_the_modified_date( 'Y-m-d' ); ?></span>
                </div>

            </div><!-- .single-post-header -->

            <?php if ( has_post_thumbnail() ) : ?>
            <div style="margin-bottom:1.5rem;">
                <?php the_post_thumbnail( 'deepquest-single' ); ?>
            </div>
            <?php endif; ?>

            <!-- Post Content -->
            <div class="post-content">
                <?php the_content(); ?>
                <?php
                wp_link_pages( [
                    'before' => '<nav class="page-links"><span>' . esc_html__( 'Pages:', 'deepquest-terminal' ) . '</span>',
                    'after'  => '</nav>',
                ] );
                ?>
            </div><!-- .post-content -->

            <!-- Tags -->
            <?php
            $tags = get_the_tags();
            if ( $tags ) : ?>
            <div style="padding: 0.8rem 1rem; background: var(--bg-card); border: var(--border); border-top: none; font-size: 0.75rem;">
                <span style="color: var(--green-dark);">TAGS: </span>
                <?php
                foreach ( $tags as $tag ) {
                    echo '<a href="' . esc_url( get_tag_link( $tag ) ) . '" style="margin-right: 0.5rem; color: var(--green-dim);">#' . esc_html( $tag->name ) . '</a>';
                }
                ?>
            </div>
            <?php endif; ?>

            <!-- Post Navigation -->
            <nav class="post-nav" aria-label="<?php esc_attr_e( 'Post navigation', 'deepquest-terminal' ); ?>">
                <?php
                $prev = get_previous_post();
                $next = get_next_post();
                if ( $prev ) : ?>
                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
                    <span class="nav-label">&lt; PREV_POST</span>
                    <?php echo esc_html( get_the_title( $prev ) ); ?>
                </a>
                <?php endif;
                if ( $next ) : ?>
                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" style="text-align:right;">
                    <span class="nav-label">NEXT_POST &gt;</span>
                    <?php echo esc_html( get_the_title( $next ) ); ?>
                </a>
                <?php endif; ?>
            </nav>

        </article>

        <!-- Comments -->
        <?php
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
        ?>

    <?php endwhile; ?>

</main><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
