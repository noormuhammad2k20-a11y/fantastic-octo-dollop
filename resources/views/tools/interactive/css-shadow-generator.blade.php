<div class="row g-4 css-shadow-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-6">
                    <label class="form-label-custom">Horizontal Distance (px)</label>
                    <input type="range" id="hDist" class="form-range" min="-50" max="50" value="10">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Vertical Distance (px)</label>
                    <input type="range" id="vDist" class="form-range" min="-50" max="50" value="10">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Blur Radius (px)</label>
                    <input type="range" id="blur" class="form-range" min="0" max="100" value="15">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Spread Radius (px)</label>
                    <input type="range" id="spread" class="form-range" min="-50" max="50" value="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Shadow Color</label>
                    <input type="color" id="shadowColor" class="form-control form-control-color w-100" value="#000000">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Opacity</label>
                    <input type="range" id="opacity" class="form-range" min="0" max="1" step="0.1" value="0.5">
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="generateShadow()">Generate CSS</button>
            <button class="btn btn-sm btn-outline-secondary rounded-pill px-4" onclick="resetApp()">Reset</button>
        
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(37,99,235,.04);transition:all .4s">
            <div class="output-hero">
                <span class="output-hero-label">Live Preview / Result</span>
            </div>
            <div class="p-4 bg-white rounded-3 border break-words overflow-x-auto shadow-sm">
                
            <div class="mb-4 p-5 text-center bg-light border rounded-3">
                <div id="previewBox" class="bg-white mx-auto" style="width: 200px; height: 200px; border-radius: 8px;"></div>
            </div>
            <div class="bg-dark p-3 rounded-3 text-break overflow-x-auto shadow-sm">
                <code id="cssOutput" class="text-white"></code>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            function hexToRgba(hex, alpha) {
                let r = parseInt(hex.slice(1, 3), 16),
                    g = parseInt(hex.slice(3, 5), 16),
                    b = parseInt(hex.slice(5, 7), 16);
                return `rgba(${r}, ${g}, ${b}, ${alpha})`;
            }

            window.generateShadow = function() {
                let h = document.getElementById("hDist").value;
                let v = document.getElementById("vDist").value;
                let blur = document.getElementById("blur").value;
                let spread = document.getElementById("spread").value;
                let color = document.getElementById("shadowColor").value;
                let opacity = document.getElementById("opacity").value;
                
                let rgbaColor = hexToRgba(color, opacity);
                let shadowStr = `${h}px ${v}px ${blur}px ${spread}px ${rgbaColor}`;
                
                document.getElementById("previewBox").style.boxShadow = shadowStr;
                document.getElementById("cssOutput").innerText = `box-shadow: ${shadowStr};\n-webkit-box-shadow: ${shadowStr};\n-moz-box-shadow: ${shadowStr};`;
            };
            window.resetApp = function() {
                document.getElementById("hDist").value = 10;
                document.getElementById("vDist").value = 10;
                document.getElementById("blur").value = 15;
                document.getElementById("spread").value = 0;
                document.getElementById("shadowColor").value = "#000000";
                document.getElementById("opacity").value = 0.5;
                window.generateShadow();
            };
            
            const inputs = document.querySelectorAll("input");
            inputs.forEach(input => input.addEventListener("input", window.generateShadow));
            setTimeout(window.generateShadow, 100);
        
</script>

<style>
.css-shadow-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.css-shadow-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.css-shadow-generator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.css-shadow-generator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.css-shadow-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.css-shadow-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style>