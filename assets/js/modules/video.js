/**
 * Video Module
 * Handles video optimization, motion preferences, and playback
 */

import { getMotionPreference, saveMotionPreference, handleError } from './utils.js';

/**
 * Motion Controller for accessibility preferences
 */
export class MotionController {
    constructor() {
        this.motionButton = document.querySelector('.motion-toggle');
        this.motionIcon = document.querySelector('.motion-icon');
        this.heroVideo = document.querySelector('.hero-video');
        this.isMotionReduced = getMotionPreference();

        this.init();
    }

    init() {
        this.updateMotionState();

        if (this.motionButton) {
            this.motionButton.addEventListener('click', () => this.toggleMotion());
        }

        // Listen for system preference changes
        const mediaQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
        mediaQuery.addEventListener('change', () => {
            this.isMotionReduced = mediaQuery.matches;
            this.updateMotionState();
        });
    }

    toggleMotion() {
        this.isMotionReduced = !this.isMotionReduced;
        saveMotionPreference(this.isMotionReduced);
        this.updateMotionState();
    }

    updateMotionState() {
        const body = document.body;

        if (this.isMotionReduced) {
            body.classList.add('motion-reduced');
            this.updateMotionButton(true);
            this.pauseVideo();
        } else {
            body.classList.remove('motion-reduced');
            this.updateMotionButton(false);
            this.playVideo();
        }
    }

    updateMotionButton(isReduced) {
        if (!this.motionButton) return;

        if (isReduced) {
            this.motionButton.classList.add('motion-reduced');
            this.motionButton.setAttribute('aria-label', 'Enable animations and video');
            this.motionButton.setAttribute('title', 'Enable animations and video');
            if (this.motionIcon) {
                this.motionIcon.textContent = 'visibility_off';
            }
        } else {
            this.motionButton.classList.remove('motion-reduced');
            this.motionButton.setAttribute('aria-label', 'Reduce motion for accessibility');
            this.motionButton.setAttribute('title', 'Reduce motion for accessibility');
            if (this.motionIcon) {
                this.motionIcon.textContent = 'visibility';
            }
        }
    }

    pauseVideo() {
        if (this.heroVideo) {
            this.heroVideo.pause();
        }
    }

    playVideo() {
        if (this.heroVideo) {
            this.heroVideo.play().catch(error => {
                handleError(error, 'Video play');
            });
        }
    }
}

/**
 * Video Optimizer for performance and connection handling
 */
export class VideoOptimizer {
    constructor() {
        this.heroVideo = document.querySelector('.hero-video');
        this.placeholder = document.querySelector('.hero-video-placeholder');
        this.isLoaded = false;
        this.loadStartTime = Date.now();
        this.lastBufferTime = null;

        this.init();
    }

    init() {
        if (!this.heroVideo) return;

        this.preloadVideo();
        this.setupEventHandlers();
        this.optimizeForConnection();
    }

    preloadVideo() {
        try {
            const preloadVideo = document.createElement('video');
            const source = this.heroVideo.querySelector('source');
            if (source) {
                preloadVideo.src = source.src;
                preloadVideo.preload = 'metadata';
                preloadVideo.muted = true;

                preloadVideo.addEventListener('loadedmetadata', () => {

                    this.heroVideo.preload = 'auto';
                });

                preloadVideo.addEventListener('error', (e) => {
                    handleError(e, 'Video preload');
                });
            }
        } catch (error) {
            handleError(error, 'Video preload setup');
        }
    }

    setupEventHandlers() {
        // Loading progress
        this.heroVideo.addEventListener('loadstart', () => {

        });

        this.heroVideo.addEventListener('loadedmetadata', () => {

        });

        this.heroVideo.addEventListener('loadeddata', () => {
            console.log('Video data loaded');
            this.onVideoLoaded();
        });

        this.heroVideo.addEventListener('canplaythrough', () => {
            // Only log once when video first becomes ready
            if (!this.isLoaded) {
                console.log('Video can play through');
            }
            this.onVideoReady();
        });

        // Error handling
        this.heroVideo.addEventListener('error', (e) => {
            handleError(e, 'Video playback');
            this.onVideoError();
        });

        // Stall handling - only log significant issues
        this.heroVideo.addEventListener('stalled', () => {
            console.warn('Video stalled');
        });

        this.heroVideo.addEventListener('waiting', () => {
            // Only log buffering if it happens frequently (not normal loop buffering)
            if (!this.lastBufferTime || Date.now() - this.lastBufferTime > 5000) {
                console.log('Video buffering...');
                this.lastBufferTime = Date.now();
            }
        });
    }

    optimizeForConnection() {
        // Check connection quality and adjust accordingly
        if ('connection' in navigator) {
            try {
                const connection = navigator.connection;

                if (connection.effectiveType === 'slow-2g' || connection.effectiveType === '2g') {
                    this.heroVideo.style.display = 'none';
                    console.log('Slow connection detected - video disabled');
                    return;
                }

                if (connection.effectiveType === '3g') {
                    this.heroVideo.style.opacity = '0.5';
                    console.log('3G connection detected - reduced video quality');
                }
            } catch (error) {
                handleError(error, 'Connection optimization');
            }
        }
    }

    onVideoLoaded() {
        this.isLoaded = true;
        this.heroVideo.classList.add('loaded');

        const loadTime = Date.now() - this.loadStartTime;
        console.log(`Video loaded in ${loadTime}ms`);

        // Attempt to play if motion is not reduced
        if (!document.body.classList.contains('motion-reduced')) {
            this.playVideo();
        }
    }

    onVideoReady() {
        // Fade out placeholder when video is ready
        if (this.placeholder) {
            this.placeholder.style.opacity = '0';
            setTimeout(() => {
                this.placeholder.style.display = 'none';
            }, 300);
        }
    }

    onVideoError() {
        console.warn('Video failed to load - showing placeholder');
        this.heroVideo.style.display = 'none';
        if (this.placeholder) {
            this.placeholder.style.opacity = '0.3';
            this.placeholder.style.display = 'block';
        }
    }

    playVideo() {
        const playPromise = this.heroVideo.play();
        if (playPromise !== undefined) {
            playPromise.catch(error => {
                handleError(error, 'Video autoplay');
                // Show controls if autoplay fails
                this.heroVideo.controls = true;
                this.heroVideo.style.opacity = '0.5';
            });
        }
    }

    replayVideo() {
        if (this.isLoaded && !document.body.classList.contains('motion-reduced')) {
            try {
                this.heroVideo.currentTime = 0;
                this.playVideo();
            } catch (error) {
                handleError(error, 'Video replay');
            }
        }
    }
}

/**
 * Simple Video Initializer
 */
export class VideoInitializer {
    constructor() {
        this.heroVideo = document.querySelector('.hero-video');
        this.init();
    }

    init() {
        if (!this.heroVideo) return;

        // Add error handling
        this.heroVideo.addEventListener('error', (e) => {
            handleError(e, 'Video initialization');
            this.heroVideo.style.display = 'none';
        });

        // Add load handler
        this.heroVideo.addEventListener('loadeddata', () => {
            console.log('Video loaded successfully');
            this.heroVideo.classList.add('loaded');
        });

        // Try to play
        this.heroVideo.play().catch(error => {
            handleError(error, 'Video initial play');
        });

        // Make globally accessible for replay
        window.heroVideo = this.heroVideo;
    }
}
