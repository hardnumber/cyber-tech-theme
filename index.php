<?php
/**
 * The main template file for the new homepage design
 * @package Cyber-Tech Theme
 */

get_header();
?>

<section class="hero-section" role="search">
    <div class="container hero-container">
        <h1 class="hero-title"><?php bloginfo('description'); ?></h1>
        <p class="hero-subtitle">استكشف مقالاتنا العميقة في عالم التقنية والأمن السيبراني.</p>
        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <label><span class="sr-only">ابحث عن مقال</span><input type="search" class="search-field" placeholder="ابحث عن الذكاء الاصطناعي، لينكس..." value="<?php echo get_search_query(); ?>" name="s" /></label>
            <button type="submit" class="search-submit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
        </form>
    </div>
</section>

<?php
$sticky = get_option( 'sticky_posts' );
if ( ! empty( $sticky ) ) :
    $args = array('posts_per_page' => 1, 'post__in' => $sticky, 'ignore_sticky_posts' => 1);
    $featured_query = new WP_Query( $args );
    if ( $featured_query->have_posts() ) : while ( $featured_query->have_posts() ) : $featured_query->the_post();
?>
<section class="featured-post-section" aria-labelledby="featured-post-title">
    <div class="container">
        <div class="featured-post-card">
            <div class="featured-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('large'); } else { echo '<img src="https://placehold.co/600x400/1a1a1a/00ffff?text=Featured" alt="مقال مميز">'; } ?>
                </a>
            </div>
            <div class="featured-post-content">
                <span class="featured-tag">الأكثر قراءة</span>
                <h2 id="featured-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><?php echo get_the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" class="cta-button">أكمل القراءة</a>
            </div>
        </div>
    </div>
</section>
<?php endwhile; wp_reset_postdata(); endif; endif; ?>

<section id="latest-articles" class="container" aria-labelledby="latest-articles-title">
    <h2 id="latest-articles-title" class="section-title">أحدث المقالات</h2>
    <div class="articles-grid">
        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $latest_posts_args = array(
            'posts_per_page'      => 6,
            'paged'               => $paged,
            'ignore_sticky_posts' => 1,
        );
        query_posts($latest_posts_args);
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        ?>
            <article class="article-card">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="article-card-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        </a>
                    </div>
                <?php endif; ?>
                <div class="article-content">
                    <div class="article-category"><?php the_category(', '); ?></div>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="article-meta"><time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('j F Y'); ?></time></div>
                </div>
            </article>
        <?php endwhile; else : echo '<p>لا توجد مقالات لعرضها حالياً.</p>'; endif; ?>
    </div>
    <?php if ( function_exists('cybertech_pagination') ) { cybertech_pagination(); } wp_reset_query(); ?>
</section>

<section class="popular-articles-section" aria-labelledby="popular-articles-title">
    <div class="container">
        <h2 id="popular-articles-title" class="section-title">الأكثر تفاعلاً</h2>
        <div class="articles-grid">
            <?php
            $popular_args = array( 'posts_per_page' => 7, 'orderby' => 'comment_count', 'order' => 'DESC', 'ignore_sticky_posts' => 1 );
            $popular_query = new WP_Query($popular_args);
            if ($popular_query->have_posts()) : while ($popular_query->have_posts()) : $popular_query->the_post();
            ?>
                <article class="article-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="article-card-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="article-content">
                        <div class="article-category"><?php the_category(', '); ?></div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="article-meta"><time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('j F Y'); ?></time></div>
                    </div>
                </article>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container cta-container">
        <h2 class="cta-title">انضم إلى قائمتنا البريدية</h2>
        <p>احصل على أحدث المقالات والتحليلات مباشرة في بريدك الإلكتروني.</p>
        <form class="subscribe-form"><input type="email" placeholder="أدخل بريدك الإلكتروني" required><button type="submit">اشترك الآن</button></form>
    </div>
</section>

<?php
get_footer();
?>