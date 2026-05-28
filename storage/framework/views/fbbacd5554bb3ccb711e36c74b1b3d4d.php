<div class="row g-4 golden-hour-calculator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-6">
                    <label class="form-label-custom">Latitude</label>
                    <input type="number" step="any" id="lat" class="form-control form-control-lg rounded-3" value="40.7128">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Longitude</label>
                    <input type="number" step="any" id="lng" class="form-control form-control-lg rounded-3" value="-74.0060">
                </div>
                <div class="col-md-12">
                    <label class="form-label-custom">Date</label>
                    <input type="date" id="date" class="form-control form-control-lg rounded-3">
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="calcGolden()">Calculate Times</button>
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
                <div class="col-md-6">
                    <div class="p-4 bg-white border-warning border-start border-4 rounded-3 shadow-sm">
                        <small class="text-muted text-uppercase fw-bold" style="letter-spacing:1px">Morning Golden Hour</small>
                        <h4 class="mb-0 text-dark mt-2 fw-bold" id="morningHour">--</h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 bg-white border-warning border-start border-4 rounded-3 shadow-sm">
                        <small class="text-muted text-uppercase fw-bold" style="letter-spacing:1px">Evening Golden Hour</small>
                        <h4 class="mb-0 text-dark mt-2 fw-bold" id="eveningHour">--</h4>
                    </div>
                </div>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            document.getElementById("date").valueAsDate = new Date();
            window.calcGolden = function() {
                let lat = parseFloat(document.getElementById("lat").value);
                let hourShift = Math.floor(lat / 15);
                
                document.getElementById("morningHour").innerText = `~ 0${6 + (hourShift % 2)}:15 AM - 0${7 + (hourShift % 2)}:00 AM`;
                document.getElementById("eveningHour").innerText = `~ 0${5 - (hourShift % 2)}:45 PM - 0${6 - (hourShift % 2)}:30 PM`;
            };
            window.resetApp = function() {
                document.getElementById("lat").value = "40.7128";
                document.getElementById("lng").value = "-74.0060";
                document.getElementById("date").valueAsDate = new Date();
                document.getElementById("morningHour").innerText = "--";
                document.getElementById("eveningHour").innerText = "--";
            };
            setTimeout(window.calcGolden, 100);
        
</script>

<style>
.golden-hour-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.golden-hour-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.golden-hour-calculator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.golden-hour-calculator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.golden-hour-calculator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.golden-hour-calculator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\golden-hour-calculator.blade.php ENDPATH**/ ?>