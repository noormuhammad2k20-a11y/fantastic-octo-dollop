<div class="row g-4 favicon-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-12">
                    <label class="form-label-custom">Text</label>
                    <input type="text" id="favText" class="form-control form-control-lg rounded-3" value="T" maxlength="3">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Text Color</label>
                    <input type="color" id="textColor" class="form-control form-control-color w-100" value="#ffffff">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Background Color</label>
                    <input type="color" id="bgColor" class="form-control form-control-color w-100" value="#007bff">
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="generateFavicon()">Generate Favicon</button>
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
                
            <div class="text-center mb-4">
                <canvas id="favCanvas" width="64" height="64" class="d-none"></canvas>
                <img id="favImg" class="border rounded-4 shadow-sm" style="width:64px;height:64px;">
            </div>
            <div class="bg-dark p-3 rounded-3 text-break overflow-x-auto text-start">
                <code id="base64Output" class="text-white small"></code>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            window.generateFavicon = function() {
                let text = document.getElementById("favText").value;
                let txtColor = document.getElementById("textColor").value;
                let bgColor = document.getElementById("bgColor").value;
                
                let canvas = document.getElementById("favCanvas");
                let ctx = canvas.getContext("2d");
                
                ctx.fillStyle = bgColor;
                ctx.fillRect(0,0,64,64);
                
                ctx.fillStyle = txtColor;
                ctx.font = "bold 32px Arial";
                ctx.textAlign = "center";
                ctx.textBaseline = "middle";
                ctx.fillText(text, 32, 32);
                
                let dataUrl = canvas.toDataURL("image/png");
                document.getElementById("favImg").src = dataUrl;
                document.getElementById("base64Output").innerText = dataUrl;
            };
            window.resetApp = function() {
                document.getElementById("favText").value = "T";
                document.getElementById("textColor").value = "#ffffff";
                document.getElementById("bgColor").value = "#007bff";
                window.generateFavicon();
            };
            setTimeout(window.generateFavicon, 100);
        
</script>

<style>
.favicon-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.favicon-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.favicon-generator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.favicon-generator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.favicon-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.favicon-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\favicon-generator.blade.php ENDPATH**/ ?>