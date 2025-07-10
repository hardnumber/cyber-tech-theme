/**
 * Cyber-Tech Theme Main JavaScript
 * Enhanced functionality for better user experience
 */

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu functionality
    initMobileMenu();
    
    // Back to top button
    initBackToTop();
    
    // Reading progress indicator
    initReadingProgress();
    
    // Lazy loading for images
    initLazyLoading();
    
    // Social sharing functionality
    initSocialSharing();
    
    // Smooth scrolling for anchor links
    initSmoothScrolling();
});

/**
 * Mobile menu functionality
 */
function initMobileMenu() {
    const menuButton = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.main-nav');
    
    if (menuButton && navMenu) {
        menuButton.addEventListener('click', function() {
            const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
            menuButton.setAttribute('aria-expanded', !isExpanded);
            navMenu.classList.toggle('is-open');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menuButton.contains(e.target) && !navMenu.contains(e.target)) {
                menuButton.setAttribute('aria-expanded', 'false');
                navMenu.classList.remove('is-open');
            }
        });
    }
}

/**
 * Back to top button functionality
 */
function initBackToTop() {
    // Create back to top button
    const backToTopButton = document.createElement('button');
    backToTopButton.className = 'back-to-top';
    backToTopButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>';
    backToTopButton.setAttribute('aria-label', 'العودة إلى الأعلى');
    backToTopButton.setAttribute('title', 'العودة إلى الأعلى');
    document.body.appendChild(backToTopButton);
    
    // Show/hide based on scroll position
    function toggleBackToTop() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    }
    
    window.addEventListener('scroll', toggleBackToTop);
    
    // Smooth scroll to top
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * Reading progress indicator for single posts
 */
function initReadingProgress() {
    if (document.body.classList.contains('single-post') || document.querySelector('.entry-content')) {
        const progressBar = document.createElement('div');
        progressBar.className = 'reading-progress';
        progressBar.innerHTML = '<div class="reading-progress-bar"></div>';
        document.body.appendChild(progressBar);
        
        const progressBarFill = progressBar.querySelector('.reading-progress-bar');
        
        function updateProgress() {
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight - windowHeight;
            const scrollTop = window.pageYOffset;
            const progress = (scrollTop / documentHeight) * 100;
            
            progressBarFill.style.width = Math.min(progress, 100) + '%';
        }
        
        window.addEventListener('scroll', updateProgress);
    }
}

/**
 * Lazy loading for images
 */
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(function(img) {
            imageObserver.observe(img);
        });
    } else {
        // Fallback for browsers without IntersectionObserver
        images.forEach(function(img) {
            img.src = img.dataset.src;
        });
    }
}

/**
 * Social sharing functionality
 */
function initSocialSharing() {
    const shareButtons = document.querySelectorAll('.social-share-button');
    
    shareButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.href;
            const width = 600;
            const height = 400;
            const left = (window.innerWidth - width) / 2;
            const top = (window.innerHeight - height) / 2;
            
            window.open(url, 'share', `width=${width},height=${height},left=${left},top=${top},scrollbars=yes,resizable=yes`);
        });
    });
}

/**
 * Smooth scrolling for anchor links
 */
function initSmoothScrolling() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/**
 * Reading time estimation
 */
function calculateReadingTime() {
    const content = document.querySelector('.entry-content');
    if (content) {
        const text = content.textContent || content.innerText;
        const wordsPerMinute = 200; // Average reading speed in Arabic
        const words = text.trim().split(/\s+/).length;
        const readingTime = Math.ceil(words / wordsPerMinute);
        
        return readingTime;
    }
    return 0;
}

// Export for use in other scripts if needed
window.CyberTechTheme = {
    calculateReadingTime: calculateReadingTime
};