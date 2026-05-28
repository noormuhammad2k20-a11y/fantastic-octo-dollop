<div class="row g-4 base64-converter-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-12">
                    <label class="form-label-custom">Input Data</label>
                    <textarea id="inputStr" class="form-control rounded-3" rows="6" placeholder="Enter text or Base64 here..."></textarea>
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-success rounded-pill px-4 fw-bold" onclick="encodeStr()">Encode to Base64</button>
            <button class="btn btn-sm btn-outline-warning rounded-pill px-4 fw-bold" onclick="decodeStr()">Decode from Base64</button>
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
                
            <div class="text-start">
                <label class="form-label-custom mb-2">Result Data</label>
                <div class="bg-light p-4 rounded-3 text-break overflow-x-auto border" style="min-height: 150px;" id="outputStr"></div>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            window.encodeStr = function() {
                let input = document.getElementById("inputStr").value;
                document.getElementById("outputStr").innerText = btoa(unescape(encodeURIComponent(input)));
            };
            window.decodeStr = function() {
                let input = document.getElementById("inputStr").value;
                try {
                    document.getElementById("outputStr").innerText = decodeURIComponent(escape(atob(input)));
                } catch(e) {
                    document.getElementById("outputStr").innerText = "Error: Invalid Base64 data";
                }
            };
            window.resetApp = function() {
                document.getElementById("inputStr").value = "";
                document.getElementById("outputStr").innerText = "";
            };
        
</script>

<style>
.base64-converter-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.base64-converter-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.base64-converter-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.base64-converter-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.base64-converter-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.base64-converter-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style>