<?php
/**
 * The template for displaying search results pages
 * @package Cyber-Tech Theme
 */

get_header();
?>

<main role="main">
    <div class="container">
        <header class="page-header" style="text-align: center; margin-bottom: 3rem;">
            <?php if ( have_posts() ) : ?>
                <h1 class="page-title">
                    نتائج البحث عن: "<?php echo get_search_query(); ?>"
                </h1>
                <p style="color: var(--secondary-text-color);">
                    تم العثور على <?php echo $wp_query->found_posts; ?> نتيجة
                </p>
            <?php else : ?>
                <h1 class="page-title">لا توجد نتائج</h1>
                <p style="color: var(--secondary-text-color);">
                    لم نجد أي نتائج لكلمة البحث "<?php echo get_search_query(); ?>"
                </p>
            <?php endif; ?>
            
            <!-- Search form -->
            <div style="max-width: 500px; margin: 2rem auto 0;">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <label>
                        <span class="sr-only">البحث في الموقع</span>
                        <input type="search" class="search-field" placeholder="ابحث مرة أخرى..." value="<?php echo get_search_query(); ?>" name="s" />
                    </label>
                    <button type="submit" class="search-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="search-results">
                <div class="articles-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <article class="article-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="article-card-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <div class="article-content">
                            <div class="article-category">
                                <?php the_category(' '); ?>
                            </div>
                            
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            
                            <div class="article-meta">
                                <span>بواسطة: <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-link"><?php the_author(); ?></a></span> | 
                                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('j F Y'); ?></time>
                            </div>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>
                
                <!-- Pagination -->
                <?php if ( function_exists('cybertech_pagination') ) { cybertech_pagination(); } ?>
            </div>
            
        <?php else : ?>
            <!-- No results found -->
            <div style="text-align: center; margin-top: 3rem;">
                <p style="margin-bottom: 2rem;">جرب البحث بكلمات مختلفة أو تصفح أحدث المقالات أدناه:</p>
                
                <!-- Recent posts -->
                <?php
                $recent_posts = new WP_Query(array(
                    'posts_per_page' => 6,
                    'post_status' => 'publish'
                ));
                
                if ($recent_posts->have_posts()) :
                ?>
                <section style="margin-top: 3rem;">
                    <h2 style="text-align: center; margin-bottom: 2rem;">أحدث المقالات</h2>
                    <div class="articles-grid">
                        <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                        <article class="article-card">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="article-card-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <div class="article-content">
                                <div class="article-category">
                                    <?php the_category(' '); ?>
                                </div>
                                
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                
                                <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                
                                <div class="article-meta">
                                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('j F Y'); ?></time>
                                </div>
                            </div>
                        </article>
                        <?php endwhile; ?>
                    </div>
                </section>
                <?php 
                wp_reset_postdata();
                endif; 
                ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
?>