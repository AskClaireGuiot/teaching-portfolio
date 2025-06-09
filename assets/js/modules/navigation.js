/**
 * Navigation Module
 * Handles mobile navigation and header scroll effects
 */

import { debounce } from './utils.js';

/**
 * Mobile Navigation Handler
 */
export class MobileNavigation {
    constructor() {
        this.menuToggle = document.querySelector('.menu-toggle');
        this.navMenu = document.querySelector('.nav-menu');
        this.header = document.querySelector('.header');
        this.isOpen = false;

        this.init();
    }

    init() {
        if (!this.menuToggle || !this.navMenu) return;

        // Bind events
        this.menuToggle.addEventListener('click', () => this.toggleMenu());

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeMenu();
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (this.isOpen && !this.header.contains(e.target)) {
                this.closeMenu();
            }
        });

        // Close menu on window resize and handle transitions
        window.addEventListener('resize', debounce(() => {
            // Temporarily disable transitions during resize
            document.body.classList.add('disable-transitions');

            if (window.innerWidth > 768 && this.isOpen) {
                this.closeMenu();
            }

            // Re-enable transitions after a short delay
            setTimeout(() => {
                document.body.classList.remove('disable-transitions');
            }, 100);
        }, 250));

        // Handle navigation link clicks
        for (const link of this.navMenu.querySelectorAll('.nav-link')) {
            link.addEventListener('click', () => {
                if (this.isOpen) {
                    this.closeMenu();
                }
            });
        }
    }

    toggleMenu() {
        if (this.isOpen) {
            this.closeMenu();
        } else {
            this.openMenu();
        }
    }

    openMenu() {
        this.isOpen = true;
        this.menuToggle.setAttribute('aria-expanded', 'true');
        this.navMenu.classList.add('active');

        // Focus first menu item
        const firstMenuItem = this.navMenu.querySelector('.nav-link');
        if (firstMenuItem) {
            firstMenuItem.focus();
        }
    }

    closeMenu() {
        this.isOpen = false;
        this.menuToggle.setAttribute('aria-expanded', 'false');
        this.navMenu.classList.remove('active');

        // Return focus to menu toggle
        this.menuToggle.focus();
    }
}

/**
 * Header Scroll Effect Handler
 */
export class HeaderScrollEffect {
    constructor() {
        this.header = document.querySelector('.header');
        this.lastScrollY = window.scrollY;

        this.init();
    }

    init() {
        if (!this.header) return;

        window.addEventListener('scroll', debounce(() => this.handleScroll(), 10));
    }

    handleScroll() {
        const currentScrollY = window.scrollY;

        if (currentScrollY > 50) {
            this.header.classList.add('scrolled');
        } else {
            this.header.classList.remove('scrolled');
        }

        this.lastScrollY = currentScrollY;
    }
}
