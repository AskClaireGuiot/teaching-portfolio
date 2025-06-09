/**
 * Teaching Page Module
 * Handles table of contents functionality, sticky navigation, and smooth scrolling
 * Automatically adapts to content changes - no hard-coded section IDs needed
 */

import { debounce } from './utils.js';

/**
 * Teaching Page Table of Contents Handler
 */
export class TeachingTOC {
    constructor() {
        this.toc = document.querySelector('.teaching-toc');
        this.tocLinks = document.querySelectorAll('.teaching-toc-link');
        this.sections = document.querySelectorAll('.teaching-section');
        this.mobileToggle = document.querySelector('.mobile-toc-toggle');
        this.tocList = document.querySelector('.teaching-toc-list');
        this.currentActiveLink = null;
        this.lastAnnouncedSection = null;

        this.init();
    }

    init() {
        if (!this.toc || this.sections.length === 0) return;

        this.setupMobileNavigation();
        this.setupSmoothScrolling();
        this.setupScrollSpy();
        this.setupTOCKeyboardNavigation();

        // Set initial active state
        this.updateActiveLink();
    }

    setupMobileNavigation() {
        if (!this.mobileToggle || !this.tocList) return;

        // Set initial state - open by default on mobile
        if (window.innerWidth <= 768) {
            this.mobileToggle.setAttribute('aria-expanded', 'true');
            this.tocList.classList.add('active');

            // Set correct icon - up arrow when expanded
            const icon = this.mobileToggle.querySelector('.material-icons');
            if (icon) icon.textContent = 'keyboard_arrow_up';
        }

        // Handle mobile toggle
        this.mobileToggle.addEventListener('click', () => {
            this.toggleTOC();
        });

        // Handle keyboard navigation for TOC toggle
        this.mobileToggle.addEventListener('keydown', (e) => {
            switch (e.key) {
                case 'Enter':
                case ' ':
                    e.preventDefault();
                    this.toggleTOC();
                    break;
                case 'Escape':
                    if (this.isTOCExpanded()) {
                        this.collapseTOC();
                    }
                    break;
                case 'ArrowDown':
                    if (this.isTOCExpanded()) {
                        e.preventDefault();
                        this.focusFirstTOCLink();
                    }
                    break;
            }
        });

        // Close mobile menu when clicking a link
        for (const link of this.tocLinks) {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    this.collapseTOC();
                }
            });
        }

        // Handle window resize
        window.addEventListener('resize', debounce(() => {
            const icon = this.mobileToggle.querySelector('.material-icons');

            if (window.innerWidth > 768) {
                // Desktop: always show list, hide toggle
                this.mobileToggle.setAttribute('aria-expanded', 'false');
                this.tocList.classList.remove('active');
                if (icon) icon.textContent = 'keyboard_arrow_down';
            } else {
                // Mobile: reset to open state
                this.mobileToggle.setAttribute('aria-expanded', 'true');
                this.tocList.classList.add('active');
                if (icon) icon.textContent = 'keyboard_arrow_up';
            }
        }, 250));
    }

    /**
     * Toggle TOC expanded state
     */
    toggleTOC() {
        const isExpanded = this.isTOCExpanded();
        const newState = !isExpanded;

        this.mobileToggle.setAttribute('aria-expanded', newState);
        this.tocList.classList.toggle('active', newState);

        // Update icon - up when expanded, down when collapsed
        const icon = this.mobileToggle.querySelector('.material-icons');
        if (icon) {
            icon.textContent = newState ? 'keyboard_arrow_up' : 'keyboard_arrow_down';
        }

        // Announce state change to screen readers
        this.announceStateChange(newState);
    }

    /**
     * Collapse TOC
     */
    collapseTOC() {
        this.mobileToggle.setAttribute('aria-expanded', 'false');
        this.tocList.classList.remove('active');

        const icon = this.mobileToggle.querySelector('.material-icons');
        if (icon) {
            icon.textContent = 'keyboard_arrow_down';
        }

        this.announceStateChange(false);
    }

    /**
     * Check if TOC is expanded
     */
    isTOCExpanded() {
        return this.mobileToggle.getAttribute('aria-expanded') === 'true';
    }

    /**
     * Focus first TOC link
     */
    focusFirstTOCLink() {
        if (this.tocLinks.length > 0) {
            this.tocLinks[0].focus();
        }
    }

    /**
     * Announce state change to screen readers
     */
    announceStateChange(isExpanded) {
        // Create a live region announcement
        const announcement = document.createElement('div');
        announcement.setAttribute('aria-live', 'polite');
        announcement.setAttribute('aria-atomic', 'true');
        announcement.className = 'sr-only';
        announcement.textContent = isExpanded ? 'Table of contents expanded' : 'Table of contents collapsed';

        document.body.appendChild(announcement);

        // Remove announcement after it's been read
        setTimeout(() => {
            if (document.body.contains(announcement)) {
                document.body.removeChild(announcement);
            }
        }, 1000);
    }

    /**
     * Announce current section to screen readers
     */
    announceCurrentSection(sectionId) {
        // Get the section title for announcement
        const section = document.getElementById(sectionId);
        const sectionTitle = section?.querySelector('h2, h3, h4, h5, h6')?.textContent || sectionId;

        // Only announce if it's a different section than the last announced
        if (this.lastAnnouncedSection !== sectionId) {
            const announcement = document.createElement('div');
            announcement.setAttribute('aria-live', 'polite');
            announcement.setAttribute('aria-atomic', 'true');
            announcement.className = 'sr-only';
            announcement.textContent = `Now reading: ${sectionTitle}`;

            document.body.appendChild(announcement);
            this.lastAnnouncedSection = sectionId;

            // Remove announcement after it's been read
            setTimeout(() => {
                if (document.body.contains(announcement)) {
                    document.body.removeChild(announcement);
                }
            }, 2000);
        }
    }

    /**
     * Setup keyboard navigation for TOC links
     */
    setupTOCKeyboardNavigation() {
        for (let index = 0; index < this.tocLinks.length; index++) {
            const link = this.tocLinks[index];

            link.addEventListener('keydown', (e) => {
                let newIndex;

                switch (e.key) {
                    case 'ArrowUp':
                        e.preventDefault();
                        newIndex = index > 0 ? index - 1 : this.tocLinks.length - 1;
                        this.tocLinks[newIndex].focus();
                        break;
                    case 'ArrowDown':
                        e.preventDefault();
                        newIndex = index < this.tocLinks.length - 1 ? index + 1 : 0;
                        this.tocLinks[newIndex].focus();
                        break;
                    case 'Home':
                        e.preventDefault();
                        this.tocLinks[0].focus();
                        break;
                    case 'End':
                        e.preventDefault();
                        this.tocLinks[this.tocLinks.length - 1].focus();
                        break;
                    case 'Escape':
                        if (window.innerWidth <= 768) {
                            e.preventDefault();
                            this.collapseTOC();
                            this.mobileToggle.focus();
                        }
                        break;
                }
            });
        }
    }

    setupSmoothScrolling() {
        for (const link of this.tocLinks) {
            link.addEventListener('click', (e) => {
                e.preventDefault();

                const targetId = link.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    const headerHeight = document.querySelector('.header')?.offsetHeight || 0;
                    const tocHeight = this.toc?.offsetHeight || 0;
                    // Consistent offset for optimal heading positioning
                    const additionalOffset = 60; // Same for both desktop and mobile
                    const offset = headerHeight + tocHeight + additionalOffset;
                    const targetPosition = targetSection.offsetTop - offset;

                    // Debug logging to verify our calculations
                    console.log('=== TOC CLICK DEBUG ===');
                    console.log('Header height:', headerHeight);
                    console.log('TOC height:', tocHeight);
                    console.log('Additional offset:', additionalOffset);
                    console.log('Total offset:', offset);
                    console.log('Section top:', targetSection.offsetTop);
                    console.log('Target position:', targetPosition);
                    console.log('=======================');

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        }
    }

    setupScrollSpy() {
        // Use immediate scroll detection for responsive highlighting
        window.addEventListener('scroll', () => {
            this.updateActiveLink();
        });

        // Also update on resize to recalculate positions
        window.addEventListener('resize', debounce(() => {
            this.updateActiveLink();
        }, 100));
    }

    /**
     * Update active link based on scroll position
     * This method automatically adapts to any content changes
     */
    updateActiveLink() {
        // Use a point 1/4 down from the top of the viewport as the "reading position"
        const readingPosition = window.scrollY + (window.innerHeight / 4);

        let activeSection = null;

        // Find which section contains our reading position
        for (const section of this.sections) {
            const sectionTop = section.offsetTop;
            const sectionBottom = sectionTop + section.offsetHeight;

            if (readingPosition >= sectionTop && readingPosition < sectionBottom) {
                activeSection = section.id;
                break;
            }
        }

        // If no section contains our reading position, find the closest one
        if (!activeSection) {
            let closestDistance = Number.POSITIVE_INFINITY;

            for (const section of this.sections) {
                // Calculate distance from reading position to section center
                const sectionCenter = section.offsetTop + (section.offsetHeight / 2);
                const distance = Math.abs(readingPosition - sectionCenter);

                if (distance < closestDistance) {
                    closestDistance = distance;
                    activeSection = section.id;
                }
            }
        }

        // Special case: if we're near the bottom of the page, highlight the last section
        const bottomThreshold = document.body.offsetHeight - window.innerHeight - 50;
        if (window.scrollY >= bottomThreshold && this.sections.length > 0) {
            activeSection = this.sections[this.sections.length - 1].id;
        }

        // Update highlighting if we have a new active section
        if (activeSection && activeSection !== this.getCurrentSection()) {
            this.setActiveLink(activeSection);
        }
    }

    setActiveLink(sectionId) {
        // Remove active class from all links
        for (const link of this.tocLinks) {
            link.classList.remove('active');
            link.removeAttribute('aria-current');
        }

        // Add active class to current link
        const activeLink = document.querySelector(`.teaching-toc-link[href="#${sectionId}"]`);
        if (activeLink && activeLink !== this.currentActiveLink) {
            activeLink.classList.add('active');
            activeLink.setAttribute('aria-current', 'location');
            this.currentActiveLink = activeLink;

            // Announce to screen readers that the current section has changed
            this.announceCurrentSection(sectionId);

            // Ensure active link is visible in mobile TOC (scroll into view if needed)
            if (window.innerWidth <= 768 && this.isTOCExpanded()) {
                activeLink.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'nearest'
                });
            }
        }
    }

    /**
     * Scroll to a specific section programmatically
     * @param {string} sectionId - The ID of the section to scroll to
     */
    scrollToSection(sectionId) {
        const targetSection = document.getElementById(sectionId);
        if (targetSection) {
            const headerHeight = document.querySelector('.header')?.offsetHeight || 0;
            const tocHeight = this.toc?.offsetHeight || 0;
            // Consistent offset for all devices
            const additionalOffset = 60;
            const offset = headerHeight + tocHeight + additionalOffset;

            const targetPosition = targetSection.offsetTop - offset;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }

    /**
     * Get the currently active section
     * @returns {string|null} The ID of the currently active section
     */
    getCurrentSection() {
        return this.currentActiveLink?.getAttribute('href')?.substring(1) || null;
    }

    /**
     * Cleanup method for component destruction
     */
    destroy() {
        // Clean up any event listeners or observers if needed
        console.log('TeachingTOC destroyed');
    }
}

/**
 * Teaching Page Manager
 * Coordinates all teaching page functionality
 */
export class TeachingPageManager {
    constructor() {
        this.toc = null;
        this.init();
    }

    init() {
        // Only initialize on teaching page
        if (!document.querySelector('.teaching-hero')) return;

        this.toc = new TeachingTOC();

        // Set up any additional teaching page functionality
        this.setupPageEnhancements();
    }

    setupPageEnhancements() {
        // Add any additional enhancements for the teaching page
        this.setupAccessibilityFeatures();
    }

    setupAccessibilityFeatures() {
        // Enhance focus management for keyboard users
        const focusableElements = document.querySelectorAll(
            '.teaching-toc-link, .text-link, button, a[href]'
        );

        for (const element of focusableElements) {
            element.addEventListener('focus', () => {
                // Ensure focused elements are visible
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            });
        }
    }

    /**
     * Get the TOC instance for external access
     * @returns {TeachingTOC|null}
     */
    getTOC() {
        return this.toc;
    }
}
