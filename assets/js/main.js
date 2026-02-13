/**
 * Claire Guiot Portfolio - Main Application
 * Coordinates all modules and initializes the application
 */

// Import all modules (with cache busting version)
import { MobileNavigation, HeaderScrollEffect } from './modules/navigation.js?v=2.0.6';
import { TypingAnimation } from './modules/animation.js?v=2.0.6';
import { SmoothScrolling, AccessibilityEnhancements, ViewportHandler } from './modules/accessibility.js?v=2.0.6';
import { MotionController, VideoOptimizer, VideoInitializer } from './modules/video.js?v=2.0.6';
import { TeachingPageManager } from './modules/teaching.js?v=2.0.6';
import { handleError } from './modules/utils.js?v=2.0.6';

/**
 * Main Portfolio Application
 */
class PortfolioApp {
    constructor() {
        this.components = [];
        this.init();
    }

    init() {
        // Wait for DOM to be fully loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.waitForTemplates());
        } else {
            this.waitForTemplates();
        }
    }

    waitForTemplates() {
        // In WordPress, templates are loaded server-side, so initialize immediately
        this.initializeComponents();
    }

    initializeComponents() {
        try {
            // Initialize all components in order
            this.components = [
                new ViewportHandler(),
                new MobileNavigation(),
                new HeaderScrollEffect(),
                new VideoInitializer(),
                new VideoOptimizer(),
                new MotionController(),
                new TypingAnimation(),
                new TeachingPageManager(),
                new SmoothScrolling(),
                new AccessibilityEnhancements()
            ];

            // Set up global error handling
            this.setupErrorHandling();

            // Initialization complete

        } catch (error) {
            handleError(error, 'Application initialization');
        }
    }

    setupErrorHandling() {
        // Handle uncaught errors
        window.addEventListener('error', (event) => {
            handleError(event.error, 'Global error');
        });

        // Handle unhandled promise rejections
        window.addEventListener('unhandledrejection', (event) => {
            handleError(event.reason, 'Unhandled promise rejection');
        });
    }

    /**
     * Get a component instance by its constructor name
     * @param {string} componentName - Name of the component class
     * @returns {Object|null} Component instance or null if not found
     */
    getComponent(componentName) {
        return this.components.find(component =>
            component.constructor.name === componentName
        ) || null;
    }

    /**
     * Reinitialize a specific component
     * @param {string} componentName - Name of the component class to reinitialize
     */
    reinitializeComponent(componentName) {
        try {
            const componentIndex = this.components.findIndex(component =>
                component.constructor.name === componentName
            );

            if (componentIndex !== -1) {
                // Remove old component
                this.components.splice(componentIndex, 1);

                // Create new instance based on component name
                let newComponent;
                switch (componentName) {
                    case 'MobileNavigation':
                        newComponent = new MobileNavigation();
                        break;
                    case 'HeaderScrollEffect':
                        newComponent = new HeaderScrollEffect();
                        break;
                    case 'TypingAnimation':
                        newComponent = new TypingAnimation();
                        break;
                    case 'SmoothScrolling':
                        newComponent = new SmoothScrolling();
                        break;
                    case 'AccessibilityEnhancements':
                        newComponent = new AccessibilityEnhancements();
                        break;
                    case 'ViewportHandler':
                        newComponent = new ViewportHandler();
                        break;
                    case 'MotionController':
                        newComponent = new MotionController();
                        break;
                    case 'VideoOptimizer':
                        newComponent = new VideoOptimizer();
                        break;
                    case 'VideoInitializer':
                        newComponent = new VideoInitializer();
                        break;
                    case 'TeachingPageManager':
                        newComponent = new TeachingPageManager();
                        break;
                    default:
                        throw new Error(`Unknown component: ${componentName}`);
                }

                // Add new component
                this.components.push(newComponent);
            }
        } catch (error) {
            handleError(error, `Component reinitialization: ${componentName}`);
        }
    }

    /**
     * Destroy all components and clean up
     */
    destroy() {
        try {
            // Call destroy method on components that have one
            for (const component of this.components) {
                if (typeof component.destroy === 'function') {
                    component.destroy();
                }
            }

            this.components = [];
        } catch (error) {
            handleError(error, 'Application destruction');
        }
    }
}

// Initialize the portfolio application
const app = new PortfolioApp();

// Make app globally accessible for debugging
window.PortfolioApp = app;

// Export for potential module usage
export default PortfolioApp;
