/**
 * Professional Wheel Spinner Engine
 * Logic for canvas rendering, physics-based rotation, and segment mapping.
 */
class WheelSpinner {
    constructor(canvasId, options = []) {
        this.canvas = document.getElementById(canvasId);
        if (!this.canvas) return;
        this.ctx = this.canvas.getContext('2d');
        this.options = options.length > 0 ? options : ["Option 1", "Option 2", "Option 3", "Option 4"];
        
        this.colors = [
            '#1e1e2e', '#ff4d4d', '#313244', '#f5c2e7', 
            '#11111b', '#fab387', '#181825', '#a6e3a1',
            '#45475a', '#89b4fa', '#585b70', '#cba6f7'
        ];

        this.currentRotation = 0;
        this.isSpinning = false;
        this.spinVelocity = 0;
        this.friction = 0.992; // High quality deceleration
        this.minVelocity = 0.002;

        this.init();
    }

    init() {
        this.draw();
        
        // Connect to the Pro Engine inputs if available
        const textarea = document.querySelector('textarea[data-id="options"]');
        if (textarea) {
            textarea.addEventListener('input', () => {
                const raw = textarea.value;
                this.options = raw.split(/[,|\n]+/).map(x => x.trim()).filter(x => x !== "");
                if (this.options.length === 0) this.options = ["Empty"];
                this.draw();
            });
        }

        const spinBtn = document.getElementById('spin-trigger-btn');
        if (spinBtn) {
            spinBtn.addEventListener('click', () => this.spin());
        }
    }

    draw() {
        const { ctx, canvas, options, colors } = this;
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        const radius = Math.min(centerX, centerY) - 10;
        const sliceAngle = (2 * Math.PI) / options.length;

        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.save();
        ctx.translate(centerX, centerY);
        ctx.rotate(this.currentRotation);

        options.forEach((opt, i) => {
            const startAngle = i * sliceAngle;
            const endAngle = (i + 1) * sliceAngle;

            // Draw Slice
            ctx.beginPath();
            ctx.moveTo(0, 0);
            ctx.arc(0, 0, radius, startAngle, endAngle);
            ctx.fillStyle = colors[i % colors.length];
            ctx.fill();
            ctx.lineWidth = 2;
            ctx.strokeStyle = 'rgba(255,255,255,0.1)';
            ctx.stroke();

            // Draw Text
            ctx.save();
            ctx.rotate(startAngle + sliceAngle / 2);
            ctx.textAlign = "right";
            ctx.fillStyle = "#fff";
            ctx.font = "bold 18px 'Inter', sans-serif";
            
            // Text clipping/truncation
            const textToDraw = opt.length > 15 ? opt.substring(0, 15) + "..." : opt;
            ctx.fillText(textToDraw, radius - 30, 7);
            ctx.restore();
        });

        // Inner Glow Circle
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, 2 * Math.PI);
        const gradient = ctx.createRadialGradient(0, 0, radius * 0.8, 0, 0, radius);
        gradient.addColorStop(0, 'transparent');
        gradient.addColorStop(1, 'rgba(0,0,0,0.2)');
        ctx.fillStyle = gradient;
        ctx.fill();

        ctx.restore();
    }

    spin() {
        if (this.isSpinning) return;
        
        // Reset results first
        const overlay = document.getElementById('wheel-winner-overlay');
        if (overlay) overlay.classList.remove('active');

        this.isSpinning = true;
        // Start with a strong burst
        this.spinVelocity = 0.15 + (Math.random() * 0.1); 
        this.animate();
    }

    animate() {
        if (!this.isSpinning) return;

        this.currentRotation += this.spinVelocity;
        this.spinVelocity *= this.friction;

        if (this.spinVelocity < this.minVelocity) {
            this.isSpinning = false;
            this.spinVelocity = 0;
            this.handleWin();
        }

        this.draw();
        requestAnimationFrame(() => this.animate());
    }

    handleWin() {
        const sliceAngle = (2 * Math.PI) / this.options.length;
        // The pointer is at the top (-PI/2), so we need to find which index corresponds to that after rotation.
        // Rotation goes clockwise.
        let normalizedRotation = (this.currentRotation % (2 * Math.PI));
        if (normalizedRotation < 0) normalizedRotation += 2 * Math.PI;

        // Pointer is fixed at -PI/2 (top). 
        // We want the slice where: startAngle <= (-PI/2 - rotation) <= endAngle
        const pointerPos = (3 * Math.PI / 2) - normalizedRotation;
        let index = Math.floor((pointerPos % (2 * Math.PI)) / sliceAngle);
        if (index < 0) index += this.options.length;
        index = index % this.options.length;

        const winner = this.options[index];
        this.showWinner(winner);
    }

    showWinner(name) {
        const textEl = document.getElementById('winner-text');
        const overlay = document.getElementById('wheel-winner-overlay');
        if (textEl && overlay) {
            textEl.innerText = name;
            overlay.classList.add('active');
            
            // Celebration!
            if (window.confetti) {
                confetti({
                    particleCount: 150,
                    spread: 70,
                    origin: { y: 0.6 },
                    colors: ['#ff4d4d', '#a6e3a1', '#89b4fa', '#cba6f7']
                });
            }

            // Sync with main engine result display
            const mainRes = document.getElementById('pro-main-value');
            if (mainRes) mainRes.innerText = name;
        }
    }
}

// Global initialization for the standalone wheel
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('main-wheel-canvas');
    if (canvas) {
        // Get current options from textarea if available
        const textarea = document.querySelector('textarea[data-id="options"]');
        let initialOptions = [];
        if (textarea && textarea.value) {
            initialOptions = textarea.value.split(/[,|\n]+/).map(x => x.trim()).filter(x => x !== "");
        }
        window.wheelSpinner = new WheelSpinner('main-wheel-canvas', initialOptions);
    }
});
