<?php
/**
 * The template for displaying archive pages
 * @package Cyber-Tech Theme
 */

get_header();
?>

<main role="main">
    <div class="container">
        <header class="page-header" style="text-align: center; margin-bottom: 3rem; padding-bottom: 2rem; border-bottom: 1px solid var(--border-color);">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description" style="color: var(--secondary-text-color); margin-top: 1rem;">', '</div>' );
            ?>
            
            <?php if ( have_posts() ) : ?>
                <p style="color: var(--secondary-text-color); margin-top: 1rem;">
                    <?php echo $wp_query->found_posts; ?> مقال
                </p>
            <?php endif; ?>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="archive-posts">
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
                            <?php if ( !is_category() ) : ?>
                            <div class="article-category">
                                <?php the_category(' '); ?>
                            </div>
                            <?php endif; ?>
                            
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
            <!-- No posts found -->
            <div style="text-align: center; margin-top: 3rem;">
                <p>لا توجد مقالات في هذا القسم حالياً.</p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cta-button" style="margin-top: 2rem;">العودة للرئيسية</a>
            </div>
        <?php endif; ?>

        <!-- Related categories (for category archives) -->
        <?php if ( is_category() ) : ?>
            <?php
            $current_category = get_queried_object();
            $related_categories = get_categories(array(
                'exclude' => $current_category->term_id,
                'number' => 6,
                'hide_empty' => true
            ));
            
            if ( !empty($related_categories) ) :
            ?>
            <section style="margin-top: 4rem; padding-top: 3rem; border-top: 1px solid var(--border-color);">
                <h2 style="text-align: center; margin-bottom: 2rem;">تصفح أقسام أخرى</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                    <?php foreach ($related_categories as $category) : ?>
                    <a href="<?php echo get_category_link($category->term_id); ?>" 
                       style="display: block; background-color: var(--surface-color); padding: 1.5rem; border-radius: 8px; text-align: center; text-decoration: none; border: 1px solid var(--border-color); transition: border-color 0.3s ease;">
                        <h3 style="margin-bottom: 0.5rem; font-size: 1.1rem;"><?php echo $category->name; ?></h3>
                        <p style="margin: 0; font-size: 0.9rem; color: var(--secondary-text-color);"><?php echo $category->count; ?> مقال</p>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
?>