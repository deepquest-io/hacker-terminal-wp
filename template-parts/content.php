<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' . ( ! has_post_thumbnail() ? ' no-thumb' : '' ) ); ?>>

    <div class="post-card-header">

        <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>" tabindex="-1">
                <?php the_post_thumbnail( 'deepquest-card' ); ?>
            </a>
        </div>
        <?php endif; ?>

        <div class="post-meta-top">

            <?php
            $categories = get_the_category();
            if ( $categories ) : ?>
                <div class="post-category">
                    <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                        [<?php echo esc_html( strtoupper( $categories[0]->name ) ); ?>]
                    </a>
                </div>
            <?php endif; ?>

            <h2 class="post-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                    &gt;&gt; <?php the_title(); ?>
                </a>
            </h2>

            <div class="post-meta">
                <span class="post-author">
                    USER: <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                        <?php the_author(); ?>
                    </a>
                </span>
                <span class="sep">//</span>
                <span class="post-date">
                    <a href="<?php the_permalink(); ?>"><?php echo get_the_date( 'Y-m-d' ); ?></a>
                </span>
                <?php if ( comments_open() ) : ?>
                <span class="sep">//</span>
                <span class="post-comments">
                    <?php comments_popup_link( '0 CMT', '1 CMT', '% CMT' ); ?>
                </span>
                <?php endif; ?>
            </div>

        </div><!-- .post-meta-top -->
    </div><!-- .post-card-header -->

    <div class="post-excerpt">
        <?php the_excerpt(); ?>
    </div>

</article>
