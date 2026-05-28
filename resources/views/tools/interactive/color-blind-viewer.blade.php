<div class="row g-4 color-blind-viewer-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-12">
                    <label class="form-label-custom">Select Color to Simulate</label>
                    <input type="color" id="baseColor" class="form-control form-control-color w-100" style="height:60px;" value="#ff4444">
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="simulateColors()">Simulate Vision Types</button>
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
                
            <div class="row text-center g-3" id="colorViews"></div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            window.simulateColors = function() {
                let color = document.getElementById("baseColor").value;
                let r = parseInt(color.slice(1,3), 16);
                let g = parseInt(color.slice(3,5), 16);
                let b = parseInt(color.slice(5,7), 16);
                
                let p = `rgb(${r*0.56 + g*0.43}, ${r*0.55 + g*0.44}, ${b})`;
                let d = `rgb(${r*0.62 + g*0.37}, ${r*0.7 + g*0.3}, ${b})`;
                let t = `rgb(${r*0.95 + g*0.05}, ${g*0.43 + b*0.56}, ${g*0.47 + b*0.53})`;
                
                document.getElementById("colorViews").innerHTML = `
                    <div class="col-md-3 col-6"><div class="p-3 bg-white rounded-3 border shadow-sm"><div style="height:80px; background:${color};" class="rounded-3 mb-2 border"></div><small class="fw-bold text-muted text-uppercase" style="letter-spacing:1px">Normal</small></div></div>
                    <div class="col-md-3 col-6"><div class="p-3 bg-white rounded-3 border shadow-sm"><div style="height:80px; background:${p};" class="rounded-3 mb-2 border"></div><small class="fw-bold text-muted text-uppercase" style="letter-spacing:1px">Protanopia</small></div></div>
                    <div class="col-md-3 col-6"><div class="p-3 bg-white rounded-3 border shadow-sm"><div style="height:80px; background:${d};" class="rounded-3 mb-2 border"></div><small class="fw-bold text-muted text-uppercase" style="letter-spacing:1px">Deuteranopia</small></div></div>
                    <div class="col-md-3 col-6"><div class="p-3 bg-white rounded-3 border shadow-sm"><div style="height:80px; background:${t};" class="rounded-3 mb-2 border"></div><small class="fw-bold text-muted text-uppercase" style="letter-spacing:1px">Tritanopia</small></div></div>
                `;
            };
            window.resetApp = function() {
                document.getElementById("baseColor").value = "#ff4444";
                window.simulateColors();
            };
            setTimeout(window.simulateColors, 100);
        
</script>

<style>
.color-blind-viewer-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.color-blind-viewer-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.color-blind-viewer-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.color-blind-viewer-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.color-blind-viewer-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.color-blind-viewer-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style>