/**
 * Claire Guiot Portfolio - Interactive JavaScript
 * Implements accessible navigation, animations, and user interactions
 */

// ==========================================================================
// Utility Functions
// ==========================================================================

/**
 * Debounce function to limit the rate of function execution
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in milliseconds
 * @returns {Function} Debounced function
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Check if user prefers reduced motion
 * @returns {boolean} True if user prefers reduced motion
 */
function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

// ==========================================================================
// Mobile Navigation
// ==========================================================================

class MobileNavigation {
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

        // Close menu on window resize
        window.addEventListener('resize', debounce(() => {
            if (window.innerWidth > 768 && this.isOpen) {
                this.closeMenu();
            }
        }, 250));

        // Handle navigation link clicks
        this.navMenu.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (this.isOpen) {
                    this.closeMenu();
                }
            });
        });
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

// ==========================================================================
// Header Scroll Effect
// ==========================================================================

class HeaderScrollEffect {
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

// ==========================================================================
// Typing Animation
// ==========================================================================

class TypingAnimation {
    constructor() {
        this.heroText = document.querySelector('.hero-intro');
        this.cursor = document.querySelector('.hero-cursor');
        this.replayBtn = document.querySelector('.replay-btn');
        this.baseText = 'Hello, my name is Claire. I am ';
        this.roles = ['instructor', 'designer', 'developer'];
        this.currentRoleIndex = 0;
        this.typeSpeed = 50;
        this.deleteSpeed = 30;
        this.startDelay = 1000;
        this.pauseDelay = 2500; // Increased to 3 seconds
        this.finalPauseDelay = 4000; // 4 seconds before final reveal
        this.isAnimating = false;

        this.init();
    }

    getArticle(word) {
        const vowels = ['a', 'e', 'i', 'o', 'u'];
        return vowels.includes(word.charAt(0).toLowerCase()) ? 'an ' : 'a ';
    }

    init() {
        if (!this.heroText || prefersReducedMotion()) {
            // Show final text immediately if reduced motion is preferred
            if (this.heroText) {
                const lastRole = this.roles[this.roles.length - 1];
                const article = this.getArticle(lastRole);
                this.heroText.innerHTML = this.baseText + '<span class="scratched-out">' + article + lastRole + '</span><br><div class="handwritten-svg-container"><svg class="handwritten-svg" viewBox="0 0 438.61 135.57" xmlns="http://www.w3.org/2000/svg"><path class="handwritten-path" d="M25.81,74.58l.97,6.82c.89,6.23,1.78,12.49,3.44,18.56.74-1.61.96-3.49,1.38-5.21.41-1.71,1.05-3.32,2.05-4.77s3.01-2.41,4.55-1.55c1.02.56,1.53,1.72,1.97,2.79,1.05,2.53,2.09,5.07,3.14,7.6"/></svg></div>';
            }
            return;
        }

        // Set up replay button
        if (this.replayBtn) {
            this.replayBtn.addEventListener('click', () => this.replayAnimation());
        }

        // Start typing animation after delay
        setTimeout(() => this.startAnimation(), this.startDelay);
    }

    async startAnimation() {
        if (this.isAnimating) return;

        this.isAnimating = true;
        this.currentRoleIndex = 0;

        // Type the initial text
        await this.typeText(this.baseText + this.getArticle(this.roles[0]) + this.roles[0]);

        // Wait before starting role cycling
        await this.pause(this.pauseDelay);

        // Cycle through roles
        for (let i = 1; i < this.roles.length; i++) {
            await this.deleteRole();
            await this.typeRole(this.roles[i]);
            await this.pause(this.pauseDelay);
        }

        // Special final sequence: pause, scratch out designer, write human
        await this.pause(800); // Shorter delay - 0.8 seconds
        await this.scratchOutRole();
        await this.pause(200); // Brief pause after scratching
        await this.writeHandwrittenHuman();

        this.isAnimating = false;
    }

    typeText(text) {
        return new Promise((resolve) => {
            this.heroText.textContent = '';
            let i = 0;

            const typeTimer = setInterval(() => {
                if (i < text.length) {
                    this.heroText.textContent += text.charAt(i);
                    i++;
                } else {
                    clearInterval(typeTimer);
                    resolve();
                }
            }, this.typeSpeed);
        });
    }

    typeRole(role) {
        return new Promise((resolve) => {
            const fullRoleText = this.getArticle(role) + role;
            let i = 0;

            const typeTimer = setInterval(() => {
                if (i < fullRoleText.length) {
                    // Get current text each time to ensure we have the base text
                    const currentText = this.heroText.textContent;
                    this.heroText.textContent = currentText + fullRoleText.charAt(i);
                    i++;
                } else {
                    clearInterval(typeTimer);
                    resolve();
                }
            }, this.typeSpeed);
        });
    }

    deleteRole() {
        return new Promise((resolve) => {
            const baseLength = this.baseText.length;

            const deleteTimer = setInterval(() => {
                const currentText = this.heroText.textContent;
                if (currentText.length > baseLength) {
                    this.heroText.textContent = currentText.substring(0, currentText.length - 1);
                } else {
                    clearInterval(deleteTimer);
                    resolve();
                }
            }, this.deleteSpeed);
        });
    }

    pause(duration) {
        return new Promise((resolve) => {
            setTimeout(resolve, duration);
        });
    }

    scratchOutRole() {
        return new Promise((resolve) => {
            const lastRole = this.roles[this.roles.length - 1];
            const article = this.getArticle(lastRole);

            // Add scratch-out effect to the current role (including article)
            const roleSpan = document.createElement('span');
            roleSpan.className = 'scratched-out';
            roleSpan.textContent = article + lastRole;

            // Replace the text with base + scratched span
            this.heroText.innerHTML = this.baseText + roleSpan.outerHTML;

            // Animate the scratch line
            setTimeout(() => {
                roleSpan.classList.add('scratch-animate');
                setTimeout(resolve, 800); // Duration of scratch animation
            }, 100);
        });
    }

    writeHandwrittenHuman() {
        return new Promise((resolve) => {
            // Create SVG container
            const svgContainer = document.createElement('div');
            svgContainer.className = 'handwritten-svg-container';

            // Add the SVG with your paths
            svgContainer.innerHTML = `
                <svg class="handwritten-svg" viewBox="0 0 438.61 135.57" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <style>
                            .handwritten-path {
                                fill: none;
                                stroke: #0b42db;
                                stroke-linecap: round;
                                stroke-linejoin: round;
                                stroke-width: 3px;
                                stroke-dasharray: 1000;
                                stroke-dashoffset: 1000;
                            }
                        </style>
                    </defs>
                    <!-- All paths from your SVG with handwritten-path class -->
                    <path class="handwritten-path" d="M25.81,74.58l.97,6.82c.89,6.23,1.78,12.49,3.44,18.56.74-1.61.96-3.49,1.38-5.21.41-1.71,1.05-3.32,2.05-4.77s3.01-2.41,4.55-1.55c1.02.56,1.53,1.72,1.97,2.79,1.05,2.53,2.09,5.07,3.14,7.6"/>
                    <path class="handwritten-path" d="M48.29,87.97c-.17,2.3,2.62,10.09,4.73,10.4,2.85-.05,3.49-6.77,4.3-9.15.45-1.32.74-2.76.4-4.12-.23,2.49-.43,5.14.71,7.37.33.63.75,1.21,1.19,1.77.91,1.16,1.91,2.29,3.19,3,1.04.58,2.24.87,3.43.83.08,0,.16-.01.22-.06s.06-.17-.01-.2"/>
                    <path class="handwritten-path" d="M67.81,85.06c1.41,3.44,2.29,7.09,2.6,10.8-.11-.96.27-1.89.48-2.83.87-3.98,2.36-7.57,4.54-9.66.11-.1.18-.29.33-.26.11.02.18.14.23.24,1.55,3.41,2.14,7.22,3.87,10.54-.34-3.41,3.07-11.33,3.91-10.14,1.12,3.73,3.35,8.05,6.67,10.09"/>
                    <path class="handwritten-path" d="M104.07,84.23c-.52-.84-1.35-1.5-2.3-1.76s-1.94.03-2.83.45c-1,.47-4.28,4.29-4.21,7.61.05,2.24.52,3.59,2.31,3.51,1.6-.08,7.45-4.34,7.99-8.32.01-.09.09-.18.05-.27-.07-.14-.3-.08-.36.06s0,.3.06.45c1.21,2.82,2.81,5.48,4.73,7.88"/>
                    <path class="handwritten-path" d="M112.26,80.53c.32.75,3.65,8.7,4.55,10.65-.43-2.68,4.38-11.63,6.49-11.44,2,.17,6.51,7.16,9.66,10.27"/>
                    <path class="handwritten-path" d="M159.16,76.64c.59,10.23,3.02,20.36,7.14,29.75"/>
                    <path class="handwritten-path" d="M150.21,75.86c1.75-.46,11.19-.44,12.85-.21,3.24.46,8.08,3.46,9.19,6.88,0,3.1-1.77,4.14-4.28,4.69-2.64.59-7.63.59-10.18-.31.22-.08.44-.16.66-.25"/>
                    <path class="handwritten-path" d="M173.82,81.94c.88.67,1.25,2,1.91,2.89s1.84,2.16,1.62,3.25c.95-1.9-.12-5.13.94-6.97.66-1.16,1.93-1.81,3.13-2.4,2.07-1.02,4.15-2.05,6.3-2.88-.22.24-.18,1.22-.21,1.55-.17,1.81.66,3.56,1.65,5.08,1.76,2.72,6.36,3.83,7.91,2.23,3.94-4.08-1.99-9.19-7.38-7.24"/>
                    <path class="handwritten-path" d="M198.37,58.24c.6,1.31.87,2.74,1.15,4.16,1.3,6.64,2.91,13.21,4.8,19.7.3-3.14,2.38-5.78,4.37-8.22.36-.44.74-.9,1.24-1.17.55-.31,1.21-.36,1.84-.38,1.65-.04,3.34.19,4.81.94s2.7,2.08,3.07,3.68c.12.52.15,1.05.18,1.58.01.22.02.45-.05.65-.1.27-.32.46-.55.63-2.11,1.54-4.88,1.76-7.49,1.93-2.38.15-4.79.29-7.12-.18"/>
                    <path class="handwritten-path" d="M223.77,61.26c.16,6.39.39,13.06,3.44,18.68"/>
                    <path class="handwritten-path" d="M233.29,78.08c1.66-.75,3.3-1.69,4.44-3.11s1.73-3.4,1.1-5.11c-.16-.44-.4-.87-.77-1.16-1.18-.96-3.11-.13-3.74,1.26s-.32,3.01.14,4.45c.42,1.31,1.01,2.66,2.15,3.43.68.46,1.5.67,2.31.83,1.22.24,2.53.37,3.67-.14,1.68-.74,2.52-2.66,2.82-4.47s.24-3.7.83-5.44c-.71,1.63-.12,3.52.56,5.17.74,1.79,1.57,3.55,2.5,5.25,1.06-3.35,2.23-6.86,4.79-9.26,1.12,2.02,2.66,5.17,4.23,6.86.77-1.45,1.86-3.9,3.36-4.58.4-.18.84-.33,1.26-.22.39.1.7.41.99.69,1.9,1.87,4.15,3.37,6.6,4.41"/>
                    <path class="handwritten-path" d="M276.16,74l7.49-.62c1.82-.15,3.66-.3,5.43-.78.05-.01.09-.02.14-.04"/>
                    <path class="handwritten-path" d="M301.59,59.93c-1.02.47-3.51.37-3.94,1.41-.32.77.23,1.6.78,2.22,1.13,1.26,3.41,2.39,4.82,3.33,1.3.88,2.71,1.61,3.89,2.65s2.12,2.48,2.11,4.05c0,.32-.05.65-.24.9-.2.27-.52.41-.83.52-2.54.94-5.45.83-7.9-.31-.24-.11-.5-.25-.6-.5-.12-.32.06-.67.29-.92.7-.78,1.77-1.11,2.8-1.32,2.38-.48,4.83-.49,7.26-.49,2.39,0,5.05.69,7.45.68,2.59,0,4.61.03,7.05-.84.45-.16.92-.37,1.21-.74.26-.33.36-.75.39-1.17.06-1.12-.43-2.22-1.13-3.1s-1.68-1.13-2.63-1.73c-5.31-3.34-10.03,3.22-6.87,5.71"/>
                    <path class="handwritten-path" d="M327.97,46.63c-.35.39-.44.95-.48,1.47-.5,7.43,1.11,15.46,4.24,21.59"/>
                    <path class="handwritten-path" d="M335.19,61.87l3.64,4.15c1.58,1.8,3.18,3.62,5.08,5.08-.18-3.64.07-19.06-.14-20.56"/>
                    <path class="handwritten-path" d="M347.9,65.36c.19.33.63.41,1.01.45,1.29.15,2.61.3,3.87,0s2.13-.82,2.93-1.84c1.88-2.42-.34-7.49-3.05-5.96-.66.37-1.25.88-1.57,1.57s-.43,1.45-.45,2.21c-.04,1.74.44,3.5,1.42,4.94s3.86,2.82,6.06,2.51"/>
                    <path class="handwritten-path" d="M363.47,59.89c.48,3.21.99,7.31,1.31,10.54.24-2.34-.33-3.26,0-5.59.27-1.92,1.37-4.41,2.96-6.07.58-.61,1.51-1.35,2.34-1.47.65-.09,1.85-.24,2.39-.2.43.03,1.66.49,1.72.92"/>
                    <path class="handwritten-path" d="M388.7,32.31c4.06,8.95,2.97,19.31,4.92,28.95"/>
                    <path class="handwritten-path" d="M394.44,73.99c-.13.2-.07.5.12.63"/>
                </svg>
            `;

            // Position below the scratched out text
            this.heroText.appendChild(svgContainer);

            // Start the handwriting animation
            this.animateHandwriting(svgContainer, resolve);
        });
    }

    animateHandwriting(container, resolve) {
        const paths = container.querySelectorAll('.handwritten-path');

        // Initialize all paths
        paths.forEach((path, index) => {
            const pathLength = path.getTotalLength();
            path.style.strokeDasharray = pathLength;
            path.style.strokeDashoffset = pathLength;

            console.log(`Path ${index}: ready`);
        });

        // Debug: Log total number of paths
        console.log(`Total paths found: ${paths.length}`);

        // Let me create a more accurate grouping based on visual inspection
        // For "human problem solver" - grouping paths that form complete letters
        const letterGroups = [
            [0], // h
            [1], // u
            [2], // m
            [3], // a
            [4], // n
            [], // space
            [5], // p
            [6], // r
            [7], // o
            [8], // b
            [9], // l
            [10], // e
            [11], // m
            [], // space
            [12], // s
            [13], // o
            [14], // l
            [15], // v
            [16], // e
            [17] // r
        ];

        // Debug: Show path count vs expected
        console.log(`Expected paths for grouping: ${letterGroups.flat().length}, Actual paths: ${paths.length}`);

        let currentGroup = 0;

        const animateNextLetter = () => {
            if (currentGroup >= letterGroups.length) {
                resolve();
                return;
            }

            const pathIndices = letterGroups[currentGroup];

            // If it's a space (empty group), just delay and continue
            if (pathIndices.length === 0) {
                currentGroup++;
                setTimeout(animateNextLetter, 100); // Space delay
                return;
            }

            console.log(`Drawing letter ${currentGroup}:`, pathIndices);

            // Animate all paths in this letter group
            pathIndices.forEach((pathIndex, strokeIndex) => {
                const path = paths[pathIndex];
                if (path) {
                    setTimeout(() => {
                        path.style.transition = 'stroke-dashoffset 0.2s ease-out';
                        path.style.strokeDashoffset = '0';
                    }, strokeIndex * 30);
                }
            });

            currentGroup++;

            // Faster timing between letters
            setTimeout(animateNextLetter, 180);
        };

        // Start the letter-by-letter animation
        animateNextLetter();
    }

    replayAnimation() {
        if (this.isAnimating) return;
        // Reset text to basic structure before replaying
        this.heroText.innerHTML = '';
        this.startAnimation();
    }
}

// ==========================================================================
// Smooth Scrolling for Anchor Links
// ==========================================================================

class SmoothScrolling {
    constructor() {
        this.init();
    }

    init() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();

                const target = document.querySelector(anchor.getAttribute('href'));
                if (target) {
                    const headerHeight = document.querySelector('.header').offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: prefersReducedMotion() ? 'auto' : 'smooth'
                    });
                }
            });
        });
    }
}

// ==========================================================================
// Accessibility Enhancements
// ==========================================================================

class AccessibilityEnhancements {
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

        function onPointerDown() {
            hadKeyboardEvent = false;
        }

        function onKeyDown(e) {
            if (e.metaKey || e.altKey || e.ctrlKey) {
                return;
            }
            hadKeyboardEvent = true;
        }

        function onFocus(e) {
            if (hadKeyboardEvent || e.target.matches(':focus-visible')) {
                e.target.classList.add('focus-visible');
            }
        }

        function onBlur(e) {
            e.target.classList.remove('focus-visible');
        }

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

        navLinks.forEach((link, index) => {
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
        });
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

// ==========================================================================
// Application Initialization
// ==========================================================================

class PortfolioApp {
    constructor() {
        this.components = [];
        this.init();
    }

    init() {
        // Wait for DOM to be fully loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.initializeComponents());
        } else {
            this.initializeComponents();
        }
    }

    initializeComponents() {
        // Initialize all components
        this.components = [
            new MobileNavigation(),
            new HeaderScrollEffect(),
            new TypingAnimation(),
            new SmoothScrolling(),
            new AccessibilityEnhancements()
        ];

        // Set up error handling
        window.addEventListener('error', this.handleError.bind(this));
        window.addEventListener('unhandledrejection', this.handleError.bind(this));

        // Log successful initialization
        console.log('Portfolio app initialized successfully');
    }

    handleError(error) {
        console.error('Portfolio app error:', error);
        // In production, you might want to send this to an error tracking service
    }
}

// ==========================================================================
// Start the Application
// ==========================================================================

// Initialize the portfolio application
const app = new PortfolioApp();
