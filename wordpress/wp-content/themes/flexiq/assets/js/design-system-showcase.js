/**
 * FlexIQ Design System Showcase - Interactive Features
 * Version: 1.0
 */

(function() {
    'use strict';

    /**
     * Copy color code to clipboard when clicking on color swatches
     */
    function initColorCopy() {
        const colorSwatches = document.querySelectorAll('.ds-color-swatch');
        
        colorSwatches.forEach(swatch => {
            swatch.addEventListener('click', function() {
                const colorCode = this.querySelector('code');
                if (!colorCode) return;
                
                const color = colorCode.textContent.trim();
                
                // Copy to clipboard
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(color).then(() => {
                        showCopyFeedback(this, color);
                    }).catch(err => {
                        console.error('Failed to copy:', err);
                    });
                } else {
                    // Fallback for older browsers
                    fallbackCopyTextToClipboard(color, this);
                }
            });
            
            // Add cursor pointer and title
            swatch.style.cursor = 'pointer';
            const code = swatch.querySelector('code');
            if (code) {
                swatch.title = `Click to copy ${code.textContent.trim()}`;
            }
        });
    }

    /**
     * Fallback copy method for older browsers
     */
    function fallbackCopyTextToClipboard(text, element) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showCopyFeedback(element, text);
        } catch (err) {
            console.error('Fallback: Could not copy text:', err);
        }
        
        document.body.removeChild(textArea);
    }

    /**
     * Show visual feedback when color is copied
     */
    function showCopyFeedback(element, color) {
        // Create feedback element
        const feedback = document.createElement('div');
        feedback.className = 'ds-copy-feedback';
        feedback.textContent = `Copied: ${color}`;
        feedback.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--color-success, #1ab682);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation: slideInRight 0.3s ease;
            font-family: var(--font-primary);
        `;
        
        document.body.appendChild(feedback);
        
        // Add subtle animation to the clicked swatch
        element.style.transform = 'scale(0.95)';
        setTimeout(() => {
            element.style.transform = '';
        }, 150);
        
        // Remove feedback after 2 seconds
        setTimeout(() => {
            feedback.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => {
                feedback.remove();
            }, 300);
        }, 2000);
    }

    /**
     * Add CSS animations
     */
    function addAnimations() {
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
            
            .ds-color-swatch {
                transition: transform 0.15s ease;
            }
        `;
        document.head.appendChild(style);
    }

    /**
     * Highlight current section in TOC based on scroll position
     */
    function initScrollSpy() {
        const tocLinks = document.querySelectorAll('.ds-toc-list a');
        const sections = document.querySelectorAll('.ds-section[id]');
        
        if (tocLinks.length === 0 || sections.length === 0) return;
        
        function updateActiveLink() {
            let currentSection = '';
            const scrollPosition = window.scrollY + 100;
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                
                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    currentSection = section.getAttribute('id');
                }
            });
            
            tocLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${currentSection}`) {
                    link.classList.add('active');
                }
            });
        }
        
        // Throttle scroll event
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    updateActiveLink();
                    ticking = false;
                });
                ticking = true;
            }
        });
        
        // Initial check
        updateActiveLink();
        
        // Add active state styling
        const style = document.createElement('style');
        style.textContent = `
            .ds-toc-list a.active {
                background: var(--color-accent-light) !important;
                border-color: var(--color-accent) !important;
                font-weight: var(--font-bold);
            }
        `;
        document.head.appendChild(style);
    }

    /**
     * Add copy button to code blocks
     */
    function initCodeCopy() {
        const codeBlocks = document.querySelectorAll('.ds-code-section pre');
        
        codeBlocks.forEach(pre => {
            const button = document.createElement('button');
            button.className = 'ds-copy-code-btn';
            button.textContent = 'Copy';
            button.style.cssText = `
                position: absolute;
                top: 12px;
                right: 12px;
                background: rgba(255, 255, 255, 0.2);
                color: white;
                border: 1px solid rgba(255, 255, 255, 0.3);
                padding: 6px 12px;
                border-radius: 4px;
                font-size: 12px;
                font-weight: bold;
                cursor: pointer;
                transition: all 0.2s ease;
                font-family: var(--font-primary);
            `;
            
            button.addEventListener('mouseenter', () => {
                button.style.background = 'rgba(255, 255, 255, 0.3)';
            });
            
            button.addEventListener('mouseleave', () => {
                button.style.background = 'rgba(255, 255, 255, 0.2)';
            });
            
            button.addEventListener('click', () => {
                const code = pre.querySelector('code');
                if (!code) return;
                
                const text = code.textContent;
                
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(text).then(() => {
                        button.textContent = 'Copied!';
                        button.style.background = 'var(--color-success)';
                        setTimeout(() => {
                            button.textContent = 'Copy';
                            button.style.background = 'rgba(255, 255, 255, 0.2)';
                        }, 2000);
                    });
                }
            });
            
            pre.style.position = 'relative';
            pre.appendChild(button);
        });
    }

    /**
     * Add keyboard shortcuts info
     */
    function initKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Press 'T' to scroll to top
            if (e.key === 't' || e.key === 'T') {
                if (!isInputFocused()) {
                    e.preventDefault();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            }
            
            // Press '?' to show keyboard shortcuts (future enhancement)
            if (e.key === '?') {
                if (!isInputFocused()) {
                    e.preventDefault();
                    showKeyboardShortcuts();
                }
            }
        });
    }

    /**
     * Check if an input element is currently focused
     */
    function isInputFocused() {
        const activeElement = document.activeElement;
        return activeElement && (
            activeElement.tagName === 'INPUT' ||
            activeElement.tagName === 'TEXTAREA' ||
            activeElement.isContentEditable
        );
    }

    /**
     * Show keyboard shortcuts modal (future enhancement)
     */
    function showKeyboardShortcuts() {
        // This could be enhanced to show a modal with all shortcuts
        console.log('Keyboard shortcuts: T = Top, ? = Help');
    }

    /**
     * Add "Back to Top" button
     */
    function initBackToTop() {
        const button = document.createElement('button');
        button.className = 'ds-back-to-top';
        button.innerHTML = '↑';
        button.setAttribute('aria-label', 'Back to top');
        button.style.cssText = `
            position: fixed;
            bottom: 32px;
            right: 32px;
            width: 48px;
            height: 48px;
            background: var(--color-accent);
            color: var(--color-primary);
            border: none;
            border-radius: 50%;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        `;
        
        button.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        
        // Show/hide based on scroll position
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    if (window.scrollY > 300) {
                        button.style.opacity = '1';
                        button.style.visibility = 'visible';
                    } else {
                        button.style.opacity = '0';
                        button.style.visibility = 'hidden';
                    }
                    ticking = false;
                });
                ticking = true;
            }
        });
        
        document.body.appendChild(button);
    }

    /**
     * Initialize all features when DOM is ready
     */
    function init() {
        // Check if we're on the design system page
        if (!document.querySelector('.design-system-page')) {
            return;
        }
        
        addAnimations();
        initColorCopy();
        initScrollSpy();
        initCodeCopy();
        initKeyboardShortcuts();
        initBackToTop();
        
        console.log('FlexIQ Design System Showcase: Interactive features loaded ✓');
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
