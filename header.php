<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <!-- ═══════════════════════════════════════
         HEADER / BRANDING
    ═══════════════════════════════════════ -->
    <header id="masthead" class="site-header" role="banner">
        <div class="header-inner">

            <!-- Site Branding -->
            <div class="site-branding">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <div class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </div>
                    <?php if ( get_bloginfo( 'description' ) ) : ?>
                        <p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <!-- Status Block -->
            <div class="header-status">
                <div class="status-line">
                    <span class="status-dot"></span>
                    <span><?php echo is_ssl() ? 'CONN_SECURE' : 'CONN_OPEN'; ?></span>
                </div>
                <div><?php echo date( 'Y-m-d' ); ?></div>
                <div><?php echo date( 'H:i:s' ); ?> UTC</div>
            </div>

        </div><!-- .header-inner -->
    </header><!-- #masthead -->

    <!-- ═══════════════════════════════════════
         NAVIGATION
    ═══════════════════════════════════════ -->
    <nav id="site-navigation" class="main-navigation" role="navigation">
        <div class="nav-inner">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                [MENU]
            </button>
            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => 'deepquest_fallback_menu',
            ] );
            ?>

            <!-- Search — pinned to far right of nav bar -->
            <div class="nav-search-wrap">
                <button class="nav-search-toggle" id="navSearchToggle" aria-label="Search">[SEARCH_]</button>
                <div class="nav-search-form" id="navSearchForm">
                    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="search" name="s" id="navSearchInput"
                               placeholder="grep -r 'query' ./..."
                               value="<?php echo get_search_query(); ?>"
                               autocomplete="off">
                        <button type="submit">[GO]</button>
                    </form>
                </div>
            </div>

        </div>
    </nav><!-- #site-navigation -->

    <!-- Terminal prompt bar -->
    <div class="terminal-banner">
        <span class="prompt">root@<?php echo esc_html( parse_url( home_url(), PHP_URL_HOST ) ); ?>:~#&nbsp;</span>
        <span id="terminal-cmd"></span><span class="cursor"></span>
    </div>

    <!-- ═══════════════════════════════════════
         CONTENT
    ═══════════════════════════════════════ -->
    <div id="content" class="site-content">
