/**
 * Utility Functions
 * Shared helper functions used across the application
 */

/**
 * Debounce function to limit the rate of function execution
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in milliseconds
 * @returns {Function} Debounced function
 */
export function debounce(func, wait) {
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
export function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

/**
 * Get motion preference from localStorage or system preference
 * @returns {boolean} True if motion should be reduced
 */
export function getMotionPreference() {
    const saved = localStorage.getItem('motion-preference');
    if (saved !== null) {
        return saved === 'reduced';
    }
    return prefersReducedMotion();
}

/**
 * Save motion preference to localStorage
 * @param {boolean} isReduced - Whether motion should be reduced
 */
export function saveMotionPreference(isReduced) {
    localStorage.setItem('motion-preference', isReduced ? 'reduced' : 'normal');
}

/**
 * Simple error handler for application errors
 * @param {Error|string} error - Error to handle
 * @param {string} context - Context where error occurred
 */
export function handleError(error, context = 'Application') {
    console.error(`${context} error:`, error);
    // In production, you might want to send this to an error tracking service
}

// remove image from case study if small width
document.addEventListener("DOMContentLoaded", function () {
  const caseStudyLinks = document.querySelectorAll(".case-study-link");
  const desktopOnlyElements = document.querySelectorAll(".desktop-only");
  const mobileOnlyElements = document.querySelectorAll(".mobile-only");

  caseStudyLinks.forEach(link => {
    const linkWidth = link.offsetWidth;

    if (linkWidth < 500) {
      // Hide desktop-only elements
      desktopOnlyElements.forEach(el => {
        el.style.display = "none";
      });

      // Show mobile-only elements
      mobileOnlyElements.forEach(el => {
        el.style.display = "block";
      });
    } else {
      // Apply CSS to .case-study-link figure if width >= 500
      const figures = link.querySelectorAll("figure");
      figures.forEach(fig => {
        fig.style.width = "100%";
        fig.style.height = "100%";
        fig.style.overflow = "hidden";
      });
    }
  });
});


