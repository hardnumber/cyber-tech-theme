    </main> <!-- End of main role -->
    
    <footer class="main-footer" role="contentinfo">
        <div class="container">
            <div class="social-links">
                <?php 
                $twitter_url = get_theme_mod( 'cybertech_twitter_url' );
                $linkedin_url = get_theme_mod( 'cybertech_linkedin_url' );
                $github_url = get_theme_mod( 'cybertech_github_url' );
                ?>
                <?php if ( ! empty( $twitter_url ) ) : ?><a href="<?php echo esc_url( $twitter_url ); ?>" aria-label="تويتر" target="_blank" rel="noopener noreferrer">X</a><?php endif; ?>
                <?php if ( ! empty( $linkedin_url ) ) : ?><a href="<?php echo esc_url( $linkedin_url ); ?>" aria-label="لينكدإن" target="_blank" rel="noopener noreferrer">in</a><?php endif; ?>
                <?php if ( ! empty( $github_url ) ) : ?><a href="<?php echo esc_url( $github_url ); ?>" aria-label="جيت هاب" target="_blank" rel="noopener noreferrer">gh</a><?php endif; ?>
            </div>
            <p>&copy; <?php echo date('Y'); ?> جميع الحقوق محفوظة لـ <?php bloginfo('name'); ?>.</p>
        </div>
    </footer>

<?php wp_footer(); ?>

</body>
</html>