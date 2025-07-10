<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Performance optimizations -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <header class="main-header" role="banner">
        <div class="container-header">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">FS</a>
            <nav class="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'القائمة الرئيسية', 'cybertech' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'menu_id'        => 'primary-menu',
                    'container'      => '', 
                    'items_wrap'     => '<ul>%3$s</ul>',
                ));
                ?>
            </nav>
            <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="sr-only">فتح القائمة</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
            </button>
        </div>
    </header>

    <main id="content" role="main">