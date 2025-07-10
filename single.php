<?php
/**
 * The template for displaying all single posts
 * @package Cyber-Tech Theme
 */

get_header();
?>

<main role="main">
    <?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('article-container'); ?>>
        
        <header class="article-header">
            <?php if ( function_exists('cybertech_the_breadcrumbs') ) { cybertech_the_breadcrumbs(); } ?>
            <div class="article-category"><?php the_category(' '); ?></div>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="article-meta">
                <span>بواسطة: <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="author-link"><?php the_author(); ?></a></span> | 
                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('j F Y'); ?></time>
            </div>
        </header>

        <?php if ( has_post_thumbnail() ) { the_post_thumbnail('large', ['class' => 'featured-image', 'alt' => get_the_title()]); } ?>

        <div class="entry-content">
            <?php 
            the_content();
            wp_link_pages(array('before' => '<div class="page-links">' . esc_html__( 'الصفحات:', 'cybertech' ), 'after'  => '</div>'));
            ?>
        </div>

        <?php if ( function_exists('cybertech_related_posts') ) { cybertech_related_posts(); } ?>

    </article>
    <?php endwhile; ?>
</main>

<?php
get_footer();
?>