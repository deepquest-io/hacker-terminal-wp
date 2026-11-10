<?php
/**
 * 404 template: terminal "hacking simulation".
 * The simulation is purely fictional text rendered in the browser; it makes
 * no network requests and touches nothing.
 */
get_header();

$request_path = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/';
$request_path = function_exists( 'mb_substr' ) ? mb_substr( $request_path, 0, 80 ) : substr( $request_path, 0, 80 );
$host         = wp_parse_url( home_url(), PHP_URL_HOST );
?>

<main id="primary" class="site-primary" role="main">

    <section class="error-404 post-card" aria-labelledby="e404-title">

        <div class="e404-code" data-text="404" aria-hidden="true">404</div>
        <h1 id="e404-title" class="e404-title"><?php esc_html_e( ':: PAGE_NOT_FOUND ::', 'deepquest-terminal' ); ?></h1>
        <p class="e404-sub"><?php esc_html_e( 'The page you requested could not be located. Watch the intruder try anyway.', 'deepquest-terminal' ); ?></p>

        <div class="e404-window">
            <div class="e404-titlebar" aria-hidden="true">
                <span class="e404-dot"></span><span class="e404-dot"></span><span class="e404-dot"></span>
                <span class="e404-wintitle">intrusion-sim.sh</span>
            </div>
            <div class="e404-term" id="e404Term"
                 data-host="<?php echo esc_attr( $host ); ?>"
                 data-path="<?php echo esc_attr( $request_path ); ?>"
                 role="log" aria-live="off">
                <noscript>
                    <div class="e404-line err">ERROR 404 // PATH_UNRESOLVED // <?php echo esc_html( $request_path ); ?></div>
                </noscript>
            </div>
        </div>

        <p class="e404-note"><?php esc_html_e( '// simulation only: fake output, no real scanning takes place', 'deepquest-terminal' ); ?></p>

        <div class="e404-actions">
            <a class="e404-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">&lt; <?php esc_html_e( 'RETURN_TO_INDEX', 'deepquest-terminal' ); ?></a>
            <button type="button" class="e404-btn" id="e404Replay">&#8635; <?php esc_html_e( 'REPLAY_SIM', 'deepquest-terminal' ); ?></button>
        </div>

        <div class="e404-search">
            <?php get_search_form(); ?>
        </div>

    </section>

</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
