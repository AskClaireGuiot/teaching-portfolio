/**
 * Accessibility Module
 * Handles accessibility enhancements and smooth scrolling
 */

import { prefersReducedMotion } from './utils.js';

/**
 * Smooth Scrolling for Anchor Links
 */
export class SmoothScrolling {
    constructor() {
        this.init();
    }

    init() {
        for (const anchor of document.querySelectorAll('a[href^="#"]')) {
            // Skip teaching TOC links - they have their own scroll handling
            if (anchor.classList.contains('teaching-toc-link')) {
                continue;
            }

            anchor.addEventListener('click', (e) => {
                e.preventDefault();

                const target = document.querySelector(anchor.getAttribute('href'));
                if (target) {
                    const headerHeight = document.querySelector('.header')?.offsetHeight || 0;
                    const targetPosition = target.offsetTop - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: prefersReducedMotion() ? 'auto' : 'smooth'
                    });
                }
            });
        }
    }
}

/**
 * Accessibility Enhancements
 */
export class AccessibilityEnhancements {
    constructor() {
        this.init();
    }

    init() {
        this.addFocusVisibleSupport();
        this.enhanceKeyboardNavigation();
        this.addSkipLinkFunctionality();
    }

    addFocusVisibleSupport() {
        // Add focus-visible polyfill behavior
        document.body.classList.add('js-focus-visible');

        let hadKeyboardEvent = true;

        const onPointerDown = () => {
            hadKeyboardEvent = false;
        };

        const onKeyDown = (e) => {
            if (e.metaKey || e.altKey || e.ctrlKey) {
                return;
            }
            hadKeyboardEvent = true;
        };

        const onFocus = (e) => {
            if (hadKeyboardEvent || e.target.matches(':focus-visible')) {
                e.target.classList.add('focus-visible');
            }
        };

        const onBlur = (e) => {
            e.target.classList.remove('focus-visible');
        };

        document.addEventListener('keydown', onKeyDown, true);
        document.addEventListener('mousedown', onPointerDown, true);
        document.addEventListener('pointerdown', onPointerDown, true);
        document.addEventListener('touchstart', onPointerDown, true);
        document.addEventListener('focus', onFocus, true);
        document.addEventListener('blur', onBlur, true);
    }

    enhanceKeyboardNavigation() {
        // Handle navigation menu keyboard interaction
        const navLinks = document.querySelectorAll('.nav-link');

        for (let index = 0; index < navLinks.length; index++) {
            const link = navLinks[index];
            link.addEventListener('keydown', (e) => {
                let newIndex;

                switch (e.key) {
                    case 'ArrowLeft':
                    case 'ArrowUp':
                        e.preventDefault();
                        newIndex = index > 0 ? index - 1 : navLinks.length - 1;
                        navLinks[newIndex].focus();
                        break;
                    case 'ArrowRight':
                    case 'ArrowDown':
                        e.preventDefault();
                        newIndex = index < navLinks.length - 1 ? index + 1 : 0;
                        navLinks[newIndex].focus();
                        break;
                    case 'Home':
                        e.preventDefault();
                        navLinks[0].focus();
                        break;
                    case 'End':
                        e.preventDefault();
                        navLinks[navLinks.length - 1].focus();
                        break;
                }
            });
        }
    }

    addSkipLinkFunctionality() {
        const skipLink = document.querySelector('.skip-link');
        if (skipLink) {
            skipLink.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(skipLink.getAttribute('href'));
                if (target) {
                    target.focus();
                    target.scrollIntoView();
                }
            });
        }
    }
}

/**
 * Viewport Resize Handler
 */
export class ViewportHandler {
    constructor() {
        this.resizeTimer = null;
        this.init();
    }

    init() {
        window.addEventListener('resize', () => this.handleResize());
    }

    handleResize() {
        // Disable transitions during resize to prevent glitches
        document.body.classList.add('disable-transitions');

        // Clear existing timer
        if (this.resizeTimer) {
            clearTimeout(this.resizeTimer);
        }

        // Re-enable transitions after resize is complete
        this.resizeTimer = setTimeout(() => {
            document.body.classList.remove('disable-transitions');
        }, 150);
    }
}
