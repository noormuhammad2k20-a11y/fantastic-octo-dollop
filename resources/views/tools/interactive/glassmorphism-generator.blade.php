<div class="row g-4 glassmorphism-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-6">
                    <label class="form-label-custom">Blur Value</label>
                    <input type="range" id="blur" class="form-range" min="0" max="20" step="0.5" value="10">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Transparency</label>
                    <input type="range" id="opacity" class="form-range" min="0" max="1" step="0.05" value="0.2">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Outline</label>
                    <input type="range" id="outline" class="form-range" min="0" max="1" step="0.05" value="0.3">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Color Context</label>
                    <input type="color" id="color" class="form-control form-control-color w-100" value="#ffffff">
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="generateGlass()">Generate CSS</button>
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
                
            <div class="mb-4 p-5 text-center border rounded-3" style="background: url('https://images.unsplash.com/photo-1557682224-5b8590cd9ec5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80') center/cover;">
                <div id="previewBox" class="mx-auto shadow-sm" style="width: 250px; height: 150px; border-radius: 16px;"></div>
            </div>
            <div class="bg-dark p-3 rounded-3 text-break overflow-x-auto">
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

            window.generateGlass = function() {
                let blur = document.getElementById("blur").value;
                let opacity = document.getElementById("opacity").value;
                let outline = document.getElementById("outline").value;
                let color = document.getElementById("color").value;
                
                let rgba = hexToRgba(color, opacity);
                let borderRgba = hexToRgba(color, outline);
                
                let css = `background: ${rgba};\nbackdrop-filter: blur(${blur}px);\n-webkit-backdrop-filter: blur(${blur}px);\nborder: 1px solid ${borderRgba};`;
                
                let el = document.getElementById("previewBox");
                el.style.background = rgba;
                el.style.backdropFilter = `blur(${blur}px)`;
                el.style.webkitBackdropFilter = `blur(${blur}px)`;
                el.style.border = `1px solid ${borderRgba}`;
                
                document.getElementById("cssOutput").innerText = css;
            };
            window.resetApp = function() {
                document.getElementById("blur").value = 10;
                document.getElementById("opacity").value = 0.2;
                document.getElementById("outline").value = 0.3;
                document.getElementById("color").value = "#ffffff";
                window.generateGlass();
            };
            
            const inputs = document.querySelectorAll("input");
            inputs.forEach(input => input.addEventListener("input", window.generateGlass));
            setTimeout(window.generateGlass, 100);
        
</script>

<style>
.glassmorphism-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.glassmorphism-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.glassmorphism-generator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.glassmorphism-generator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.glassmorphism-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.glassmorphism-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style>