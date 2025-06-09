/**
 * Animation Module
 * Handles typing animations and visual effects
 */

import { prefersReducedMotion, debounce } from './utils.js';

/**
 * Typing Animation Handler
 */
export class TypingAnimation {
    constructor() {
        this.heroText = document.querySelector('.hero-intro');
        this.cursor = document.querySelector('.hero-cursor');
        this.heroContainer = document.querySelector('.hero-text');
        this.replayBtn = document.querySelector('.replay-btn');
        this.heroVideo = document.querySelector('.hero-video');
        this.roles = ['n instructor', ' designer', ' developer'];
        this.currentRoleIndex = 0;
        this.typeSpeed = 50;
        this.deleteSpeed = 30;
        this.startDelay = 1000;
        this.pauseDelay = 2500;
        this.finalPauseDelay = 4000;
        this.isAnimating = false;

        // Device and performance detection
        this.deviceType = this.detectDeviceType();
        this.performanceLevel = this.detectPerformance();

        this.init();
    }

    getBaseText() {
        const isMobile = window.innerWidth <= 768;
        return isMobile ? 'Hello, my name is Claire.\nI am a' : 'Hello, my name is Claire. I am a';
    }

    updateTextFormat() {
        if (this.heroText && !this.isAnimating) {
            const hasScratchOut = this.heroText.querySelector('.scratched-out');
            const hasHandwriting = this.heroText.querySelector('.handwritten-svg-container');

            if (hasScratchOut && hasHandwriting) {
                return;
            }

            const currentText = this.heroText.textContent || '';
            const currentRole = this.getCurrentRole(currentText);

            if (currentRole) {
                this.heroText.textContent = this.getBaseText() + currentRole;
            }
        }
    }

    getCurrentRole(text) {
        for (const role of this.roles) {
            if (text.includes(role)) {
                return role;
            }
        }
        return null;
    }

    detectDeviceType() {
        const userAgent = navigator.userAgent.toLowerCase();
        const isMobile = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(userAgent);
        const isTablet = /ipad|android(?!.*mobile)/i.test(userAgent);

        if (isTablet) return 'tablet';
        if (isMobile) return 'mobile';
        return 'desktop';
    }

    detectPerformance() {
        // Simple performance detection based on device capabilities
        const hardwareConcurrency = navigator.hardwareConcurrency || 2;
        const isLowMemoryDevice = navigator.deviceMemory && navigator.deviceMemory < 4;

        if (this.deviceType === 'mobile' && (hardwareConcurrency < 4 || isLowMemoryDevice)) {
            return 'low';
        }
        if (this.deviceType === 'mobile' || this.deviceType === 'tablet') {
            return 'medium';
        }
        return 'high';
    }

    getPerformanceMultiplier() {
        // Adjust animation timing based on device performance
        switch (this.performanceLevel) {
            case 'low':
                return 1.3; // Slightly slower for low-end devices
            case 'medium':
                return 1.1; // Slightly slower for mobile/tablet
            default:
                return 1.0; // Normal speed for desktop/high-end devices
        }
    }

    init() {
        if (!this.heroText || prefersReducedMotion()) {
            if (this.heroText) {
                const lastRole = this.roles[this.roles.length - 1];
                this.heroText.innerHTML = `${this.getBaseText()}<span class="scratched-out">${lastRole}${this.getScratchSVG()}${this.getHandwrittenSVG()}</span>`;
            }
            return;
        }

        if (this.replayBtn) {
            this.replayBtn.addEventListener('click', () => this.replayAnimation());
        }

        this.initVideo();

        if (this.cursor) {
            this.cursor.style.display = 'inline-block';
        }

        // Make test function globally accessible for debugging
        window.testAnimation = () => this.testAnimationSequence();

        setTimeout(() => this.startAnimation(), this.startDelay);

        window.addEventListener('resize', debounce(() => {
            if (!this.isAnimating) {
                this.updateTextFormat();
            }
        }, 250));
    }

    initVideo() {
        // Video initialization logic will be handled by video module
    }

    async startAnimation() {
        if (this.isAnimating) return;

        this.isAnimating = true;
        this.currentRoleIndex = 0;

        await this.typeText(this.getBaseText() + this.roles[0]);
        await this.pause(this.pauseDelay);

        for (let i = 1; i < this.roles.length; i++) {
            await this.deleteRole();
            await this.typeRole(this.roles[i]);
            await this.pause(this.pauseDelay);
        }

        await this.pause(600);
        await this.scratchOutRole();
        await this.pause(150);
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
            let i = 0;

            const typeTimer = setInterval(() => {
                if (i < role.length) {
                    const currentText = this.heroText.textContent;
                    this.heroText.textContent = currentText + role.charAt(i);
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
            const baseLength = this.getBaseText().length;

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
            const parts = lastRole.split(' ');
            const article = `${parts[0]} `;
            const roleWord = parts.slice(1).join(' ');

            const articleSpan = document.createElement('span');
            articleSpan.textContent = article;

            const roleSpan = document.createElement('span');
            roleSpan.className = 'scratched-out';
            roleSpan.textContent = roleWord;

            this.heroText.innerHTML = this.getBaseText() + articleSpan.outerHTML + roleSpan.outerHTML;

            const addedSpan = this.heroText.querySelector('.scratched-out');
            const scratchContainer = document.createElement('div');
            scratchContainer.className = 'scratch-svg-container';
            scratchContainer.innerHTML = this.getScratchSVG();

            if (addedSpan) {
                addedSpan.appendChild(scratchContainer);

                setTimeout(() => {
                    const scratchPath = scratchContainer.querySelector('.scratch-path');
                    if (scratchPath) {
                        const pathLength = scratchPath.getTotalLength();
                        scratchPath.style.strokeDasharray = `${pathLength} ${pathLength}`;
                        scratchPath.style.strokeDashoffset = pathLength;

                        scratchPath.getBoundingClientRect();

                        setTimeout(() => {
                            scratchPath.style.transition = 'stroke-dashoffset 0.4s ease-in-out';
                            scratchPath.style.strokeDashoffset = '0';
                        }, 50);
                    }
                    setTimeout(resolve, 500);
                }, 100);
            }
        });
    }

    writeHandwrittenHuman() {
        return new Promise((resolve) => {
            // Clean up any existing handwritten SVGs first
            const existingHandwritten = document.querySelectorAll('.handwritten-svg-container');
            for (const svg of existingHandwritten) {
                svg.remove();
            }

            const svgContainer = document.createElement('div');
            svgContainer.className = 'handwritten-svg-container';
            svgContainer.innerHTML = this.getHandwrittenSVG();

            const scratchedSpan = this.heroText.querySelector('.scratched-out');
            if (scratchedSpan) {
                scratchedSpan.appendChild(svgContainer);
            } else {
                this.heroText.appendChild(svgContainer);
            }

            setTimeout(() => {
                this.animateHandwriting(svgContainer, resolve);
            }, 200);
        });
    }

    animateHandwriting(container, resolve) {
        const paths = container.querySelectorAll('.handwritten-path');

        if (paths.length === 0) {
            console.warn('No handwritten paths found');
            resolve();
            return;
        }

        try {
            // Set up all paths for animation - all start hidden
            for (const path of paths) {
                const pathLength = path.getTotalLength();
                // Use exact path length for more precise animation
                path.style.strokeDasharray = `${pathLength}`;
                path.style.strokeDashoffset = `${pathLength}`;
                path.style.transition = 'none'; // Remove any existing transitions
            }

            // Force a reflow
            container.getBoundingClientRect();

            // Animate paths one at a time - complete each letter before starting the next
            let currentPathIndex = 0;
            const animateNextPath = () => {
                if (currentPathIndex >= paths.length) {
                    resolve();
                    return;
                }

                const path = paths[currentPathIndex];
                let pathLength;

                try {
                    pathLength = path.getTotalLength();
                } catch (error) {
                    console.warn(`Could not get path length for path ${currentPathIndex}:`, error);
                    // Skip this path and continue
                    currentPathIndex++;
                    animateNextPath();
                    return;
                }

                // More varied timing based on path complexity - natural handwriting speed

                // Base timing tiers
                let baseDuration;
                if (pathLength < 50) {
                    // Very short strokes (dots, small marks)
                    baseDuration = 0.1;
                } else if (pathLength < 150) {
                    // Short to medium strokes
                    baseDuration = Math.max(0.2, pathLength / 350);
                } else if (pathLength < 300) {
                    // Medium strokes
                    baseDuration = Math.max(0.3, pathLength / 300);
                } else {
                    // Long, complex strokes
                    baseDuration = Math.max(0.4, pathLength / 250);
                }

                // Adjust timing based on device performance
                const performanceMultiplier = this.getPerformanceMultiplier();
                const duration = baseDuration * performanceMultiplier;

                // Set transition and start animation for this path only
                path.style.transition = `stroke-dashoffset ${duration}s ease-out`;
                path.style.strokeDashoffset = '0';

                // Wait for this path to complete before starting the next - natural flow
                setTimeout(() => {
                    currentPathIndex++;
                    animateNextPath();
                }, duration * 1000 + 60); // Comfortable buffer for natural timing
            };

            // Start animation after a brief delay - natural timing
            setTimeout(animateNextPath, 100);

        } catch (error) {
            console.error('Error animating handwriting:', error);
            resolve();
        }
    }

    getScratchSVG() {
        return `
            <svg class="scratch-svg" viewBox="0 0 210.62 54.94" xmlns="http://www.w3.org/2000/svg">
                <path class="scratch-path" d="M31.79,25.02c14.56-2.5,31.52-4.51,47.97-5.54,39.06-2.44,75.35-1.25,114.82.9-40.64-1.34-81.91,2.71-122.16,5.56-18.56,1.31-30.76,5.47-46.88,6.62,54.14.61,109.73-4.41,163.82-.65"/>
            </svg>
        `;
    }

    getHandwrittenSVG() {
        return `
            <svg class="handwritten-svg" viewBox="0 0 438.61 135.57" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <style>
                        .handwritten-path {
                            fill: none;
                            stroke: #0b42db;
                            stroke-linecap: round;
                            stroke-linejoin: round;
                            stroke-width: 3px;
                        }
                    </style>
                </defs>
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
    }

    replayAnimation() {
        if (this.isAnimating) return;

        const existingSVG = this.heroContainer.querySelector('.handwritten-svg-container');
        if (existingSVG) {
            existingSVG.remove();
        }

        this.heroText.textContent = this.getBaseText() + this.roles[0];

        if (this.cursor) {
            this.cursor.style.display = 'inline-block';
        }

        if (window.heroVideo) {
            window.heroVideo.currentTime = 0;
            window.heroVideo.play().catch(error => {
                console.log('Video replay failed:', error);
            });
        }

        this.startAnimation();
    }

    /**
     * Test animation sequence for consistency across devices
     */
    testAnimationSequence() {
        const testResults = {
            deviceType: this.deviceType,
            performanceLevel: this.performanceLevel,
            performanceMultiplier: this.getPerformanceMultiplier(),
            browserInfo: {
                userAgent: navigator.userAgent,
                hardwareConcurrency: navigator.hardwareConcurrency,
                deviceMemory: navigator.deviceMemory,
                connection: navigator.connection?.effectiveType
            },
            svgSupport: this.testSVGSupport(),
            animationSupport: this.testAnimationSupport(),
            timestamp: new Date().toISOString()
        };

        console.log('=== ANIMATION TEST RESULTS ===');
        console.table(testResults);
        console.log('==============================');

        return testResults;
    }

    testSVGSupport() {
        try {
            const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path.setAttribute('d', 'M10,10 L20,20');
            svg.appendChild(path);
            document.body.appendChild(svg);

            const hasGetTotalLength = typeof path.getTotalLength === 'function';
            const canGetLength = hasGetTotalLength ? path.getTotalLength() > 0 : false;

            document.body.removeChild(svg);

            return {
                supported: hasGetTotalLength,
                canCalculateLength: canGetLength
            };
        } catch (error) {
            return {
                supported: false,
                error: error.message
            };
        }
    }

    testAnimationSupport() {
        const testElement = document.createElement('div');
        testElement.style.transition = 'opacity 0.1s';

        return {
            cssTransitions: 'transition' in testElement.style,
            cssAnimations: 'animation' in testElement.style,
            requestAnimationFrame: typeof requestAnimationFrame === 'function',
            performance: typeof performance !== 'undefined' && typeof performance.now === 'function'
        };
    }
}
