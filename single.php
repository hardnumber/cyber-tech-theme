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
                <span class="reading-time">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12,6 12,12 16,14"></polyline></svg>
                    <span id="reading-time-value"></span> دقيقة قراءة
                </span>
            </div>
        </header>

        <?php if ( has_post_thumbnail() ) { the_post_thumbnail('large', ['class' => 'featured-image', 'alt' => get_the_title()]); } ?>

        <div class="entry-content">
            <?php 
            the_content();
            wp_link_pages(array('before' => '<div class="page-links">' . esc_html__( 'الصفحات:', 'cybertech' ), 'after'  => '</div>'));
            ?>
        </div>

        <!-- Social Sharing Buttons -->
        <div class="social-sharing">
            <h3>شارك هذا المقال</h3>
            <div class="social-share-buttons">
                <?php
                $post_url = urlencode(get_permalink());
                $post_title = urlencode(get_the_title());
                ?>
                <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>" 
                   class="social-share-button twitter" target="_blank" rel="noopener">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    تويتر
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" 
                   class="social-share-button facebook" target="_blank" rel="noopener">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    فيسبوك
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>" 
                   class="social-share-button linkedin" target="_blank" rel="noopener">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    لينكدإن
                </a>
            </div>
        </div>

        <?php if ( function_exists('cybertech_related_posts') ) { cybertech_related_posts(); } ?>

    </article>
    <?php endwhile; ?>
</main>

<script>
// Initialize reading time calculation
document.addEventListener('DOMContentLoaded', function() {
    const readingTimeElement = document.getElementById('reading-time-value');
    if (readingTimeElement && window.CyberTechTheme) {
        const readingTime = window.CyberTechTheme.calculateReadingTime();
        readingTimeElement.textContent = readingTime || 1;
    }
});
</script>

<?php
get_footer();
?>