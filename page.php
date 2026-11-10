<?php get_header(); ?>

<main id="primary" class="site-primary" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="single-post-header">
                <h1 class="single-post-title">&gt;&gt; <?php the_title(); ?></h1>
            </div>

            <div class="post-content">
                <?php the_content(); ?>
            </div>

        </article>

    <?php endwhile; ?>

</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
