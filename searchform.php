<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input
        type="search"
        class="search-field"
        placeholder="<?php esc_attr_e( 'SEARCH_QUERY...', 'deepquest-terminal' ); ?>"
        value="<?php echo get_search_query(); ?>"
        name="s"
        autocomplete="off"
    >
    <button type="submit" class="search-submit">[GO]</button>
</form>
