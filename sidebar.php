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
             DEFACEMENT COUNTER
        ══════════════════════════════ -->
        <div class="widget widget-defacement-counter">
            <h3 class="widget-title">DEFACEMENT_LOG</h3>
            <?php
            // Count posts tagged "defacement" (both tag and category)
            $defacement_tag   = get_term_by( 'slug', 'defacement', 'post_tag' );
            $defacement_cat   = get_term_by( 'slug', 'defacement', 'category' );
            $defacement_count = 0;

            if ( $defacement_tag && ! is_wp_error( $defacement_tag ) ) {
                $defacement_count += (int) $defacement_tag->count;
            }
            if ( $defacement_cat && ! is_wp_error( $defacement_cat ) ) {
                $defacement_count = max( $defacement_count, (int) $defacement_cat->count );
            }

            // Fallback: query directly
            if ( $defacement_count === 0 ) {
                $dq = new WP_Query( [
                    'post_type'      => 'post',
                    'posts_per_page' => -1,
                    'fields'         => 'ids',
                    'tax_query'      => [
                        'relation' => 'OR',
                        [
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => 'defacement',
                        ],
                        [
                            'taxonomy' => 'post_tag',
                            'field'    => 'slug',
                            'terms'    => 'defacement',
                        ],
                    ],
                ] );
                $defacement_count = (int) $dq->found_posts;
                wp_reset_postdata();
            }
            ?>
            <div class="defacement-counter">
                <div class="counter-label">TOTAL DEFACEMENTS LOGGED:</div>
                <div class="counter-display" id="defacementCounter" data-target="<?php echo esc_attr( $defacement_count ); ?>">
                    <span class="counter-num">000000</span>
                </div>
                <div class="counter-bar">
                    <div class="counter-bar-fill" style="width:100%"></div>
                </div>
                <div class="counter-meta">
                    <span>// STATUS: <span style="color:var(--green-bright)">ACTIVE</span></span>
                    <span>// LAST: <?php
                        $last = new WP_Query( [
                            'posts_per_page' => 1,
                            'fields'         => 'ids',
                            'tax_query'      => [ [
                                'taxonomy' => 'category',
                                'field'    => 'slug',
                                'terms'    => 'defacement',
                            ] ],
                        ] );
                        if ( $last->have_posts() ) {
                            $last->the_post();
                            echo get_the_date( 'Y-m-d' );
                            wp_reset_postdata();
                        } else {
                            echo 'N/A';
                        }
                    ?></span>
                </div>
            </div>
        </div>

    <?php endif; ?>

</aside><!-- #secondary -->
