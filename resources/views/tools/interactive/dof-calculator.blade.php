<div class="row g-4 dof-calculator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-6">
                    <label class="form-label-custom">Sensor Size</label>
                    <select id="sensor" class="form-select form-select-lg rounded-3">
                        <option value="0.03">Full Frame (35mm)</option>
                        <option value="0.02">APS-C (Canon)</option>
                        <option value="0.019">APS-C (Nikon/Sony)</option>
                        <option value="0.015">Micro Four Thirds</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Focal Length (mm)</label>
                    <input type="number" id="focal" class="form-control form-control-lg rounded-3" value="50">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Aperture (f/)</label>
                    <input type="number" step="0.1" id="aperture" class="form-control form-control-lg rounded-3" value="2.8">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Subject Distance (m)</label>
                    <input type="number" step="0.1" id="distance" class="form-control form-control-lg rounded-3" value="5">
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="calcDof()">Calculate DoF</button>
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
                
            <div class="row text-center g-3 mt-2">
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-3 border shadow-sm">
                        <small class="text-muted text-uppercase fw-bold" style="letter-spacing:1px">Near Limit</small>
                        <h3 class="mb-0 text-primary mt-2 fw-bold" id="nearLimit">--</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-3 border shadow-sm">
                        <small class="text-muted text-uppercase fw-bold" style="letter-spacing:1px">Far Limit</small>
                        <h3 class="mb-0 text-primary mt-2 fw-bold" id="farLimit">--</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-3 border shadow-sm">
                        <small class="text-muted text-uppercase fw-bold" style="letter-spacing:1px">Hyperfocal Dist</small>
                        <h3 class="mb-0 text-primary mt-2 fw-bold" id="hyperfocal">--</h3>
                    </div>
                </div>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            window.calcDof = function() {
                let coc = parseFloat(document.getElementById("sensor").value);
                let f = parseFloat(document.getElementById("focal").value);
                let N = parseFloat(document.getElementById("aperture").value);
                let d = parseFloat(document.getElementById("distance").value) * 1000; // to mm
                
                let H = (f * f) / (N * coc); // hyperfocal in mm
                
                let near = (H * d) / (H + (d - f));
                let far = (H * d) / (H - (d - f));
                
                if(far < 0) far = Infinity; // past infinity
                
                document.getElementById("hyperfocal").innerText = (H/1000).toFixed(2) + " m";
                document.getElementById("nearLimit").innerText = (near/1000).toFixed(2) + " m";
                document.getElementById("farLimit").innerText = (far === Infinity) ? "Infinity" : (far/1000).toFixed(2) + " m";
            };
            window.resetApp = function() {
                document.getElementById("sensor").value = "0.03";
                document.getElementById("focal").value = "50";
                document.getElementById("aperture").value = "2.8";
                document.getElementById("distance").value = "5";
                document.getElementById("hyperfocal").innerText = "--";
                document.getElementById("nearLimit").innerText = "--";
                document.getElementById("farLimit").innerText = "--";
            };
            setTimeout(window.calcDof, 100);
        
</script>

<style>
.dof-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.dof-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.dof-calculator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.dof-calculator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.dof-calculator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.dof-calculator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style>