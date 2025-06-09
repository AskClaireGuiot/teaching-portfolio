/**
 * Template Loader Utility
 * Loads header and footer template parts into pages
 */

class TemplateLoader {
    constructor() {
        this.templatePath = '/templates/';
        this.init();
    }

    async init() {
        try {
            await this.loadTemplates();
            this.setActiveNavLink();

            // Dispatch custom event to signal templates are ready
            const templatesReadyEvent = new CustomEvent('templatesReady');
            document.dispatchEvent(templatesReadyEvent);
        } catch (error) {
            console.error('Template loader initialization failed:', error);
        }
    }

    async loadTemplates() {
        try {
            // Load header
            const headerPlaceholder = document.querySelector('[data-template="header"]');
            if (headerPlaceholder) {
                const headerHTML = await this.loadTemplate('header');
                headerPlaceholder.outerHTML = headerHTML;
            }

            // Load footer
            const footerPlaceholder = document.querySelector('[data-template="footer"]');
            if (footerPlaceholder) {
                const footerHTML = await this.loadTemplate('footer');
                footerPlaceholder.outerHTML = footerHTML;
            }
        } catch (error) {
            console.error('Error loading templates:', error);
            // Templates will remain as placeholders if loading fails
        }
    }

    async loadTemplate(templateName) {
        try {
            const response = await fetch(`${this.templatePath}${templateName}.html`);

            if (!response.ok) {
                throw new Error(`Template ${templateName} not found: ${response.status} ${response.statusText}`);
            }

            const content = await response.text();

            if (!content.trim()) {
                throw new Error(`Template ${templateName} is empty`);
            }

            return content;
        } catch (error) {
            console.error(`Failed to load ${templateName} template:`, error);
            // Return a fallback placeholder
            return `<!-- ${templateName} template failed to load: ${error.message} -->`;
        }
    }

    setActiveNavLink() {
        // Wait a bit for templates to be loaded
        setTimeout(() => {
            try {
                const currentPath = window.location.pathname;
                const navLinks = document.querySelectorAll('.nav-link');

                for (const link of navLinks) {
                    link.classList.remove('active');
                    link.removeAttribute('aria-current');

                    const href = link.getAttribute('href');
                    if (this.isActiveLink(href, currentPath)) {
                        link.classList.add('active');
                        link.setAttribute('aria-current', 'page');
                    }
                }
            } catch (error) {
                console.error('Error setting active nav link:', error);
            }
        }, 100);
    }

    isActiveLink(href, currentPath) {
        // Normalize paths for comparison
        const normalizedHref = href?.toLowerCase() || '';
        const normalizedPath = currentPath.toLowerCase();

        return (
            normalizedHref === normalizedPath ||
            (normalizedPath === '/' && normalizedHref === '/') ||
            (normalizedPath.includes('/teaching') && normalizedHref === '/teaching') ||
            (normalizedPath.includes('/case-study') && normalizedHref === '/case-study.html') ||
            (normalizedPath.includes('/about') && normalizedHref === '/about') ||
            (normalizedPath.includes('/contact') && normalizedHref === '/contact')
        );
    }
}

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => new TemplateLoader());
} else {
    new TemplateLoader();
}
