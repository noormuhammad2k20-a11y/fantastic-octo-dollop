<div class="row g-4 js-enabled-checker-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-12">
                    <div class="alert alert-info border-0 shadow-sm rounded-3">This tool instantly checks your browser's capability to execute JavaScript.</div>
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="checkJs()">Run Check</button>
        
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
                
            <div class="p-5 bg-white rounded-3 border shadow-sm text-center">
                <h2 class="text-success fw-bold mb-3" id="jsStatus"><i class="fas fa-spinner fa-spin"></i> Checking...</h2>
                <p class="text-muted mb-0">If you see this changing to "Enabled", your browser fully supports modern JS execution.</p>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            window.checkJs = function() {
                document.getElementById("jsStatus").innerHTML = "<i class='fas fa-check-circle'></i> JavaScript is Enabled!";
                document.getElementById("jsStatus").classList.remove("text-success");
                document.getElementById("jsStatus").classList.add("text-success");
            };
            setTimeout(window.checkJs, 500);
        
</script>

<style>
.js-enabled-checker-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.js-enabled-checker-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.js-enabled-checker-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.js-enabled-checker-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.js-enabled-checker-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.js-enabled-checker-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style>