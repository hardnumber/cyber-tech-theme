<?php
/**
 * Theme Customizer functionality
 *
 * @package Cyber-Tech Theme
 */

function cybertech_customize_register( $wp_customize ) {
    $wp_customize->add_panel( 'cybertech_theme_options', array( 'title' => __( 'إعدادات قالب سايبر-تك', 'cybertech' ), 'priority' => 10, 'capability' => 'edit_theme_options' ) );
    $wp_customize->add_section( 'cybertech_social_section', array( 'title' => __( 'روابط التواصل الاجتماعي', 'cybertech' ), 'description' => __( 'أدخل الروابط الكاملة لحساباتك الاجتماعية هنا.', 'cybertech' ), 'panel' => 'cybertech_theme_options' ) );
    $wp_customize->add_setting( 'cybertech_twitter_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'cybertech_twitter_url_control', array( 'label' => __( 'رابط حساب X (تويتر)', 'cybertech' ), 'section' => 'cybertech_social_section', 'settings' => 'cybertech_twitter_url', 'type' => 'url' ) );
    $wp_customize->add_setting( 'cybertech_linkedin_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'cybertech_linkedin_url_control', array( 'label' => __( 'رابط حساب LinkedIn', 'cybertech' ), 'section' => 'cybertech_social_section', 'settings' => 'cybertech_linkedin_url', 'type' => 'url' ) );
    $wp_customize->add_setting( 'cybertech_github_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'cybertech_github_url_control', array( 'label' => __( 'رابط حساب GitHub', 'cybertech' ), 'section' => 'cybertech_social_section', 'settings' => 'cybertech_github_url', 'type' => 'url' ) );
}
add_action( 'customize_register', 'cybertech_customize_register' );
