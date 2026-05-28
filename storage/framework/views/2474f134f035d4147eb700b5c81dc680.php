<div class="row g-4 color-scheme-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 10px 40px rgba(0,0,0,0.05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #f43f5e, #881337); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#4c0519; letter-spacing: -0.5px;">Premium Palette Architect</h4>
                    <p class="text-muted small mb-0">Generate mathematically balanced color schemes for UI, branding, and design systems.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Seed Configuration</h6>
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label class="form-label-custom">Base Color (Seed)</label>
                                    <div class="input-group">
                                        <input type="text" id="v-hex" class="form-control form-control-lg border-0 bg-white shadow-sm rounded-start-3 fw-black" value="F43F5E">
                                        <input type="color" id="v-picker" class="form-control form-control-lg border-0 bg-white shadow-sm rounded-end-3 p-1" style="max-width: 60px;" value="#f43f5e">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label-custom">Scheme Harmony</label>
                                    <select id="v-scheme" class="form-select form-select-lg border-0 bg-white shadow-sm rounded-3 fw-bold">
                                        <option value="analogous">Analogous (Adjacent)</option>
                                        <option value="monochromatic">Monochromatic (Shades)</option>
                                        <option value="triadic" selected>Triadic (Balanced Triangle)</option>
                                        <option value="complementary">Complementary (Opposite)</option>
                                        <option value="tetradic">Tetradic (Double Comp)</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label-custom">Action</label>
                                    <button class="btn btn-dark w-100 py-2 rounded-3 fw-bold" id="random-seed" style="min-width: 280px; max-width: 100%;">
                                        <i class="fas fa-random"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 345; --tool-color: #f43f5e; --tool-bg: rgba(244, 63, 94, .04);">
            <div class="p-4">
                <div class="row g-4">
                    
                    <div class="col-md-12">
                        <div class="palette-container d-flex flex-wrap gap-3" id="palette-grid">
                            <!-- Generated colors go here -->
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm" id="copy-all" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-copy me-2"></i>Copy All HEX
                        </button>
                        <button class="btn btn-outline-secondary rounded-pill px-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                    <div class="text-muted small fw-bold uppercase">
                        Format: <span class="text-danger">Hex / RGB / HSL</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const hexInput = document.getElementById('v-hex');
    const picker = document.getElementById('v-picker');
    const schemeSelect = document.getElementById('v-scheme');
    const paletteGrid = document.getElementById('palette-grid');

    function hexToHsl(H) {
        let r = 0, g = 0, b = 0;
        if (H.length == 4) {
            r = "0x" + H[1] + H[1]; g = "0x" + H[2] + H[2]; b = "0x" + H[3] + H[3];
        } else if (H.length == 7) {
            r = "0x" + H[1] + H[2]; g = "0x" + H[3] + H[4]; b = "0x" + H[5] + H[6];
        }
        r /= 255; g /= 255; b /= 255;
        let cmin = Math.min(r,g,b), cmax = Math.max(r,g,b), delta = cmax - cmin, h = 0, s = 0, l = 0;
        if (delta == 0) h = 0;
        else if (cmax == r) h = ((g - b) / delta) % 6;
        else if (cmax == g) h = (b - r) / delta + 2;
        else h = (r - g) / delta + 4;
        h = Math.round(h * 60);
        if (h < 0) h += 360;
        l = (cmax + cmin) / 2;
        s = delta == 0 ? 0 : delta / (1 - Math.abs(2 * l - 1));
        s = +(s * 100).toFixed(1);
        l = +(l * 100).toFixed(1);
        return {h, s, l};
    }

    function hslToHex(h, s, l) {
        l /= 100;
        const a = s * Math.min(l, 1 - l) / 100;
        const f = n => {
            const k = (n + h / 30) % 12;
            const color = l - a * Math.max(Math.min(k - 3, 9 - k, 1), -1);
            return Math.round(255 * color).toString(16).padStart(2, '0');
        };
        return `#${f(0)}${f(8)}${f(4)}`.toUpperCase();
    }

    function generate() {
        let hex = hexInput.value.startsWith('#') ? hexInput.value : '#' + hexInput.value;
        if (!/^#[0-9A-F]{6}$/i.test(hex)) return;
        
        const hsl = hexToHsl(hex);
        const scheme = schemeSelect.value;
        let colors = [];

        if (scheme === 'analogous') {
            colors = [-60, -30, 0, 30, 60].map(d => hslToHex((hsl.h + d + 360) % 360, hsl.s, hsl.l));
        } else if (scheme === 'monochromatic') {
            colors = [20, 40, 60, 80, 100].map(l => hslToHex(hsl.h, hsl.s, l));
        } else if (scheme === 'triadic') {
            colors = [0, 120, 240, 150, 270].map(d => hslToHex((hsl.h + d + 360) % 360, hsl.s, hsl.l));
        } else if (scheme === 'complementary') {
            colors = [0, 180, 10, 190, -10].map(d => hslToHex((hsl.h + d + 360) % 360, hsl.s, hsl.l));
        } else if (scheme === 'tetradic') {
            colors = [0, 90, 180, 270, 45].map(d => hslToHex((hsl.h + d + 360) % 360, hsl.s, hsl.l));
        }

        paletteGrid.innerHTML = '';
        colors.forEach(c => {
            const div = document.createElement('div');
            div.className = 'palette-item flex-grow-1 text-center';
            div.innerHTML = `
                <div class="swatch rounded-4 shadow-sm mb-2" style="background:${c}; height:120px; cursor:pointer;" onclick="navigator.clipboard.writeText('${c}')"></div>
                <div class="fw-bold small text-muted">${c}</div>
            `;
            paletteGrid.appendChild(div);
        });
        
        picker.value = hex;
    }

    hexInput.addEventListener('input', generate);
    picker.addEventListener('input', () => { hexInput.value = picker.value.toUpperCase(); generate(); });
    schemeSelect.addEventListener('change', generate);

    document.getElementById('random-seed').addEventListener('click', () => {
        const rand = '#' + Math.floor(Math.random()*16777215).toString(16).padStart(6, '0').toUpperCase();
        hexInput.value = rand;
        generate();
    });

    document.getElementById('reset-calc').addEventListener('click', () => {
        hexInput.value = 'F43F5E';
        schemeSelect.value = 'triadic';
        generate();
    });

    document.getElementById('copy-all').addEventListener('click', function() {
        const hexes = Array.from(paletteGrid.querySelectorAll('.fw-bold')).map(el => el.textContent).join(', ');
        navigator.clipboard.writeText(hexes).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    generate();
});
</script>

<style>
.color-scheme-rebuilt .form-label-custom { font-size:.7rem; font-weight:900; text-transform:uppercase; letter-spacing:1px; color:#f43f5e; opacity:.7; margin-bottom:8px; display:block; }
.fw-black { font-weight: 900; }
.uppercase { text-transform: uppercase; }

.palette-item .swatch { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 4px solid #fff; }
.palette-item .swatch:hover { transform: translateY(-5px) scale(1.05); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }

.btn-dark { background: #1e1b4b; color: #fff; border: none; }
.btn-dark:hover { background: #312e81; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\color-scheme-generator.blade.php ENDPATH**/ ?>