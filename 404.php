<?php
/**
 * The template for displaying 404 pages (not found)
 * @package Cyber-Tech Theme
 */

get_header();
?>

<main role="main">
    <div class="container">
        <div class="error-404-container" style="text-align: center; padding: 4rem 0;">
            <h1 style="font-size: 6rem; margin-bottom: 1rem; color: var(--accent-color);">404</h1>
            <h2 style="margin-bottom: 1rem;">الصفحة غير موجودة</h2>
            <p style="margin-bottom: 2rem; font-size: 1.1rem; color: var(--secondary-text-color);">
                يبدو أن الصفحة التي تبحث عنها غير موجودة أو تم نقلها.
            </p>
            
            <!-- Search form -->
            <div style="max-width: 500px; margin: 0 auto 2rem;">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <label>
                        <span class="sr-only">البحث في الموقع</span>
                        <input type="search" class="search-field" placeholder="ابحث في الموقع..." value="<?php echo get_search_query(); ?>" name="s" />
                    </label>
                    <button type="submit" class="search-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
            </div>
            
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cta-button">العودة للرئيسية</a>
            
            <!-- Recent posts -->
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 3,
                'post_status' => 'publish'
            ));
            
            if (!empty($recent_posts)) :
            ?>
            <section style="margin-top: 4rem; text-align: right;">
                <h3 style="text-align: center; margin-bottom: 2rem;">أحدث المقالات</h3>
                <div class="articles-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <?php foreach ($recent_posts as $post_item) : ?>
                    <div class="article-card">
                        <?php if (has_post_thumbnail($post_item['ID'])) : ?>
                        <div class="article-card-thumbnail">
                            <a href="<?php echo get_permalink($post_item['ID']); ?>">
                                <?php echo get_the_post_thumbnail($post_item['ID'], 'medium', array('alt' => get_the_title($post_item['ID']))); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="article-content">
                            <h3><a href="<?php echo get_permalink($post_item['ID']); ?>"><?php echo $post_item['post_title']; ?></a></h3>
                            <p><?php echo wp_trim_words($post_item['post_content'], 20); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
?>