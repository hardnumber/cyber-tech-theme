<?php
/**
 * Cyber-Tech Theme Functions and Definitions
 * @package Cyber-Tech Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.5.0' );
}

function cybertech_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus( array( 'main-menu' => esc_html__( 'القائمة الرئيسية', 'cybertech' ) ) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'cybertech_setup' );

function cybertech_scripts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;700&display=swap', array(), null );
	wp_enqueue_style( 'cybertech-style', get_stylesheet_uri(), array(), _S_VERSION );
}
add_action( 'wp_enqueue_scripts', 'cybertech_scripts' );

require get_template_directory() . '/inc/customizer.php';

function cybertech_the_breadcrumbs() {
    if ( ! is_single() ) return;
    echo '<nav class="breadcrumbs" aria-label="مسار التنقل"><ol>';
    echo '<li><a href="' . esc_url( home_url() ) . '">الرئيسية</a></li>';
    $categories = get_the_category();
    if ( ! empty( $categories ) ) {
        $category = $categories[0];
        echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
    }
    echo '<li aria-current="page">' . wp_trim_words( get_the_title(), 4 ) . '...</li>';
    echo '</ol></nav>';
}

function cybertech_json_ld_schema() {
    if ( is_single() ) {
        $post_id = get_the_ID();
        $schema = array(
            '@context'  => 'https://schema.org',
            '@type'     => 'BlogPosting',
            'mainEntityOfPage' => array('@type' => 'WebPage', '@id' => get_permalink($post_id)),
            'headline'  => get_the_title($post_id),
            'description' => get_the_excerpt($post_id),
            'image'     => get_the_post_thumbnail_url($post_id, 'full'),
            'author'    => array('@type' => 'Person', 'name'  => get_the_author_meta('display_name', get_post_field('post_author', $post_id)), 'url'   => get_author_posts_url(get_post_field('post_author', $post_id))),
            'publisher' => array('@type' => 'Organization', 'name'  => get_bloginfo('name'), 'logo'  => array('@type'  => 'ImageObject', 'url' => 'https://placehold.co/200x60/0a0a0a/ffffff?text=' . urlencode(get_bloginfo('name')))),
            'datePublished' => get_the_date('c', $post_id),
            'dateModified'  => get_the_modified_date('c', $post_id),
        );
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '<\/script>' . "\n";
    }
    if ( is_front_page() ) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type'    => 'WebSite',
            'url'      => home_url( '/' ),
            'name'     => get_bloginfo( 'name' ),
            'description' => get_bloginfo( 'description' ),
            'potentialAction' => array(
                '@type' => 'SearchAction',
                'target' => array( 'type' => 'EntryPoint', 'urlTemplate' => home_url( '/?s={search_term_string}' ) ),
                'query-input' => 'required name=search_term_string',
            ),
        );
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '<\/script>' . "\n";
    }
}
add_action('wp_head', 'cybertech_json_ld_schema');

function cybertech_related_posts() {
    $post_id = get_the_ID();
    $categories = get_the_category($post_id);
    if (empty($categories)) return;
    $category_ids = wp_list_pluck($categories, 'term_id');
    $args = array('category__in' => $category_ids, 'post__not_in' => array($post_id), 'posts_per_page' => 2, 'ignore_sticky_posts' => 1);
    $related_query = new WP_Query($args);
    if ($related_query->have_posts()) {
        echo '<section class="related-posts" aria-labelledby="related-posts-title"><h2 id="related-posts-title">مقالات ذات صلة</h2><div class="related-posts-grid">';
        while ($related_query->have_posts()) {
            $related_query->the_post();
            echo '<div class="related-post-card"><h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3><p>' . get_the_excerpt() . '</p></div>';
        }
        echo '</div></section>';
    }
    wp_reset_postdata();
}

function cybertech_pagination() {
    global $wp_query;
    $big = 999999999;
    $pages = paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $wp_query->max_num_pages,
        'type'      => 'array',
        'prev_text' => __( '« السابق', 'cybertech' ),
        'next_text' => __( 'التالي »', 'cybertech' ),
    ) );
    if ( is_array( $pages ) ) {
        echo '<nav class="pagination" role="navigation" aria-label="ترقيم الصفحات">';
        echo '<ul class="nav-links">';
        foreach ( $pages as $page ) {
            echo "<li>$page</li>";
        }
        echo '</ul>';
        echo '</nav>';
    }
}
