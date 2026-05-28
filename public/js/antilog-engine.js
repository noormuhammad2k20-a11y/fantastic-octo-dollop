/**
 * AntilogEngine — Modular calculation logic for Pro Antilog & Exponent Calculator.
 * Features: Fraction parsing, complex number detection, scientific formatting, and real-time updates.
 */
class AntilogEngine {
    constructor(config) {
        this.config = config;
        this.init();
    }

    init() {
        this.exponentInput = document.getElementById('exponent-y');
        this.baseSelect = document.getElementById('base-type');
        this.customBaseInput = document.getElementById('custom-base');
        this.customBaseGroup = document.getElementById('custom-base-group');
        this.equationViewer = document.getElementById('equation-viewer');
        this.mainResult = document.getElementById('main-result');
        this.copyBtn = document.getElementById('copy-result');
        this.exampleChips = document.querySelectorAll('.example-chip');

        this.addEventListeners();
        this.update();
    }

    addEventListeners() {
        const updateFn = () => this.update();
        this.exponentInput.addEventListener('input', updateFn);
        this.baseSelect.addEventListener('change', () => {
            const isCustom = this.baseSelect.value === 'custom';
            this.customBaseGroup.style.display = isCustom ? 'block' : 'none';
            this.update();
        });
        this.customBaseInput.addEventListener('input', updateFn);

        this.exampleChips.forEach(chip => {
            chip.addEventListener('click', () => {
                this.exponentInput.value = chip.dataset.y;
                this.baseSelect.value = chip.dataset.base;
                this.baseSelect.dispatchEvent(new Event('change'));
                if (chip.dataset.base === 'custom') {
                    this.customBaseInput.value = chip.dataset.customBase;
                }
                this.update();
            });
        });

        this.copyBtn.addEventListener('click', () => this.copyToClipboard());
    }

    parseFraction(str) {
        if (!str) return 0;
        str = str.trim();
        if (str.includes('/')) {
            const parts = str.split('/');
            if (parts.length === 2) {
                const num = parseFloat(parts[0]);
                const den = parseFloat(parts[1]);
                if (den !== 0) return num / den;
            }
        }
        return parseFloat(str);
    }

    getBaseValue() {
        const type = this.baseSelect.value;
        switch (type) {
            case '10': return 10;
            case 'e': return Math.E;
            case '2': return 2;
            case 'pi': return Math.PI;
            case 'custom': return parseFloat(this.customBaseInput.value) || 0;
            default: return 10;
        }
    }

    getBaseLabel() {
        const type = this.baseSelect.value;
        switch (type) {
            case '10': return '10';
            case 'e': return 'e';
            case '2': return '2';
            case 'pi': return 'π';
            case 'custom': return this.customBaseInput.value || 'b';
            default: return '10';
        }
    }

    formatResult(num) {
        if (isNaN(num)) return 'Error';
        const absNum = Math.abs(num);
        
        if (absNum === 0) return '0';
        
        // Large or tiny numbers -> Scientific
        if (absNum >= 1e12 || (absNum < 0.000001 && absNum > 0)) {
            return num.toExponential(6).replace(/e\+?/, ' × 10^');
        }

        // Standard formatting with commas
        return num.toLocaleString('en-US', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 10
        });
    }

    update() {
        const yStr = this.exponentInput.value;
        const y = this.parseFraction(yStr);
        const b = this.getBaseValue();
        const bLabel = this.getBaseLabel();

        // 1. Equation Viewer
        this.equationViewer.innerHTML = `${bLabel}<sup>${yStr || 'y'}</sup> =`;

        // 2. Logic & Error Handling
        if (yStr === '') {
            this.mainResult.innerText = '—';
            return;
        }

        // Detect Complex Numbers
        // b^y where b < 0 and y is fractional
        const isFractional = (n) => n % 1 !== 0;
        if (b < 0 && isFractional(y)) {
            this.mainResult.innerText = 'Error: Complex Number';
            this.mainResult.classList.add('text-danger');
            return;
        }
        this.mainResult.classList.remove('text-danger');

        const result = Math.pow(b, y);
        this.mainResult.innerText = this.formatResult(result);
    }

    copyToClipboard() {
        const text = this.mainResult.innerText;
        if (text === '—' || text.startsWith('Error')) return;
        
        // Remove commas for raw value if needed, but user asked for raw unformatted number
        const raw = text.replace(/,/g, '').replace(/ × 10\^/, 'e');
        
        navigator.clipboard.writeText(raw).then(() => {
            const originalText = this.copyBtn.innerHTML;
            this.copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
            this.copyBtn.classList.replace('btn-outline-secondary', 'btn-success');
            
            setTimeout(() => {
                this.copyBtn.innerHTML = originalText;
                this.copyBtn.classList.replace('btn-success', 'btn-outline-secondary');
            }, 2000);
        });
    }
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', () => {
    window.antilogEngine = new AntilogEngine();
});
