<?php
/**
 * Fallback menu when no custom menu is set
 */
function deepquest_fallback_menu() {
    echo '<ul id="primary-menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'deepquest-terminal' ) . '</a></li>';
    wp_list_pages( [
        'title_li' => '',
        'depth'    => 1,
        'echo'     => true,
    ] );
    echo '</ul>';
}
