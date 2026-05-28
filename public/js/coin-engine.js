/**
 * Professional Coin Flipper Engine - V2
 * 3D CSS Animation, dynamic shadows, ambient particles, and history management.
 */
class CoinFlipper {
    constructor() {
        this.container = document.querySelector('.coin-main-box');
        this.coin = document.getElementById('coin-3d');
        this.btn = document.getElementById('coin-flip-trigger');
        this.overlay = document.getElementById('coin-winner-overlay');
        this.historyContainer = document.getElementById('coin-history-log');
        this.isFlipping = false;
        this.history = [];

        this.init();
    }

    init() {
        this.createCoinLayers();
        this.createParticles();
        this.createShadow();
        
        if (this.btn) {
            this.btn.addEventListener('click', () => this.flip());
        }
    }

    createCoinLayers() {
        if (!this.coin) return;
        // Create 10 layers for thickness
        for (let i = 0; i < 10; i++) {
            const layer = document.createElement('div');
            layer.className = 'edge-layer';
            layer.style.transform = `translateZ(${i - 5}px)`;
            this.coin.appendChild(layer);
        }
    }

    createParticles() {
        if (!this.container) return;
        const pContainer = document.createElement('div');
        pContainer.className = 'particles-container';
        for (let i = 0; i < 15; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            const size = Math.random() * 4 + 2;
            p.style.width = `${size}px`;
            p.style.height = `${size}px`;
            p.style.left = `${Math.random() * 100}%`;
            p.style.top = `${Math.random() * 100}%`;
            p.style.setProperty('--x', `${(Math.random() - 0.5) * 200}px`);
            p.style.setProperty('--y', `${(Math.random() - 0.5) * 200}px`);
            p.style.setProperty('--duration', `${Math.random() * 3 + 2}s`);
            p.style.animationDelay = `${Math.random() * 5}s`;
            pContainer.appendChild(p);
        }
        this.container.appendChild(pContainer);
    }

    createShadow() {
        if (!this.coin) return;
        const shadow = document.createElement('div');
        shadow.className = 'coin-shadow';
        shadow.id = 'coin-shadow-el';
        this.coin.parentElement.appendChild(shadow);
    }

    flip(forcedResult = null) {
        if (this.isFlipping) return;

        this.isFlipping = true;
        if (this.overlay) this.overlay.classList.remove('active');

        // Randomly choose heads or tails if no forced result
        const result = forcedResult || (Math.random() < 0.5 ? 'Heads' : 'Tails');
        
        // Random number of rotations (at least 5-10 full turns)
        const extraDegrees = result === 'Heads' ? 0 : 180;
        const totalRotations = (10 + Math.floor(Math.random() * 10)) * 360;
        const finalRotation = totalRotations + extraDegrees;

        // Shadow animation
        const shadow = document.getElementById('coin-shadow-el');
        if (shadow) {
            shadow.style.transform = 'translateX(-50%) scale(0.5)';
            shadow.style.opacity = '0.2';
            shadow.style.filter = 'blur(15px)';
        }

        // Apply animation
        if (this.coin) {
            this.coin.style.transition = 'transform 3s cubic-bezier(0.1, 0, 0.3, 1)';
            this.coin.style.transform = `rotateY(${finalRotation}deg)`;
            
            // Trigger the "bounce" animation in CSS
            this.coin.parentElement.classList.remove('flipping');
            void this.coin.parentElement.offsetWidth; // Trigger reflow
            this.coin.parentElement.classList.add('flipping');
        }

        setTimeout(() => {
            this.isFlipping = false;
            if (shadow) {
                shadow.style.transform = 'translateX(-50%) scale(1)';
                shadow.style.opacity = '0.6';
                shadow.style.filter = 'blur(8px)';
            }
            this.showResult(result);
            this.updateHistory(result);
        }, 3050);
    }

    showResult(side) {
        const textEl = document.getElementById('coin-winner-text');
        if (textEl && this.overlay) {
            textEl.innerText = side;
            this.overlay.classList.add('active');

            // Professional Firework Celebration
            if (window.confetti) {
                const duration = 3 * 1000;
                const animationEnd = Date.now() + duration;
                const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

                const randomInRange = (min, max) => Math.random() * (max - min) + min;

                const interval = setInterval(function() {
                    const timeLeft = animationEnd - Date.now();

                    if (timeLeft <= 0) {
                        return clearInterval(interval);
                    }

                    const particleCount = 50 * (timeLeft / duration);
                    // since particles fall down, start a bit higher than random
                    confetti(Object.assign({}, defaults, { 
                        particleCount, 
                        origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 },
                        colors: ['#ffd700', '#ffffff', '#ffcc00']
                    }));
                    confetti(Object.assign({}, defaults, { 
                        particleCount, 
                        origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 },
                        colors: ['#d4af37', '#ffffff', '#ffd700']
                    }));
                }, 250);
            }

            // Sync with Pro Engine result display
            const mainRes = document.getElementById('pro-main-value');
            if (mainRes) {
                mainRes.innerText = side;
                mainRes.style.color = '#ffd700'; 
            }
        }
    }

    updateHistory(side) {
        if (!this.historyContainer) return;
        
        const item = document.createElement('div');
        item.className = 'history-item';
        item.innerText = side.charAt(0); // 'H' or 'T'
        item.title = side;
        
        this.history.unshift(item);
        if (this.history.length > 8) {
            const last = this.history.pop();
            last.remove();
        }
        
        this.historyContainer.prepend(item);
    }
}

// Global initialization
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.coin-main-box')) {
        window.coinFlipper = new CoinFlipper();
    }
});
