<aside id="secondary" class="sidebar" role="complementary">

    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php else : ?>

        <!-- ══════════════════════════════
             TOP 10 CATEGORIES
        ══════════════════════════════ -->
        <div class="widget widget-categories">
            <h3 class="widget-title">CATEGORIES</h3>
            <ul>
                <?php
                $cats = get_categories( [
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'number'     => 10,
                    'hide_empty' => false,
                ] );
                foreach ( $cats as $cat ) : ?>
                    <li>
                        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                            <?php echo esc_html( $cat->name ); ?>
                        </a>
                        <span class="cat-count">(<?php echo (int) $cat->count; ?>)</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- ══════════════════════════════
             ARCHIVES (monthly)
        ══════════════════════════════ -->
        <div class="widget widget-archives">
            <h3 class="widget-title">ARCHIVES</h3>
            <ul>
                <?php wp_get_archives( [ 'type' => 'monthly', 'limit' => 24 ] ); ?>
            </ul>
        </div>

        <!-- ══════════════════════════════
             POST COUNTER (Customizer: Terminal Counter)
        ══════════════════════════════ -->
        <?php
        $counter_title = get_theme_mod( 'deepquest_counter_title', 'POST_LOG' );
        $counter_slug  = sanitize_title( get_theme_mod( 'deepquest_counter_category', '' ) );
        $counter_args  = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'no_found_rows'  => false,
        ];
        if ( $counter_slug ) {
            $counter_args['category_name'] = $counter_slug;
        }
        $counter_query = new WP_Query( $counter_args );
        $counter_count = (int) $counter_query->found_posts;
        $counter_last  = $counter_query->have_posts() ? get_the_date( 'Y-m-d', $counter_query->posts[0] ) : 'N/A';
        wp_reset_postdata();
        ?>
        <div class="widget widget-defacement-counter">
            <h3 class="widget-title"><?php echo esc_html( $counter_title ); ?></h3>
            <div class="defacement-counter">
                <div class="counter-label"><?php esc_html_e( 'TOTAL ENTRIES LOGGED:', 'deepquest-terminal' ); ?></div>
                <div class="counter-display" id="defacementCounter" data-target="<?php echo esc_attr( $counter_count ); ?>">
                    <span class="counter-num">000000</span>
                </div>
                <div class="counter-bar">
                    <div class="counter-bar-fill" style="width:100%"></div>
                </div>
                <div class="counter-meta">
                    <span>// STATUS: <span style="color:var(--green-bright)">ACTIVE</span></span>
                    <span>// LAST: <?php echo esc_html( $counter_last ); ?></span>
                </div>
            </div>
        </div>

    <?php endif; ?>

</aside><!-- #secondary -->
