<div class="row g-4 css-gradient-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-6">
                    <label class="form-label-custom">Color 1</label>
                    <input type="color" id="color1" class="form-control form-control-color w-100" value="#ff0000">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Color 2</label>
                    <input type="color" id="color2" class="form-control form-control-color w-100" value="#0000ff">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Gradient Type</label>
                    <select id="gradType" class="form-select form-select-lg rounded-3">
                        <option value="linear-gradient">Linear</option>
                        <option value="radial-gradient">Radial</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Angle (Linear only)</label>
                    <input type="range" id="angle" class="form-range" min="0" max="360" value="90">
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="generateGradient()">Generate CSS</button>
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
                
            <div class="mb-4 p-4 text-center border rounded-3">
                <div id="previewBox" class="w-100 shadow-sm" style="height: 200px; border-radius: 12px;"></div>
            </div>
            <div class="bg-dark p-3 rounded-3 text-break overflow-x-auto">
                <code id="cssOutput" class="text-white"></code>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            window.generateGradient = function() {
                let c1 = document.getElementById("color1").value;
                let c2 = document.getElementById("color2").value;
                let type = document.getElementById("gradType").value;
                let angle = document.getElementById("angle").value;
                
                let gradStr = "";
                if(type === "linear-gradient") {
                    gradStr = `${type}(${angle}deg, ${c1}, ${c2})`;
                } else {
                    gradStr = `${type}(circle, ${c1}, ${c2})`;
                }
                
                document.getElementById("previewBox").style.background = gradStr;
                document.getElementById("cssOutput").innerText = `background: ${c1};\nbackground: ${gradStr};`;
            };
            window.resetApp = function() {
                document.getElementById("color1").value = "#ff0000";
                document.getElementById("color2").value = "#0000ff";
                document.getElementById("gradType").value = "linear-gradient";
                document.getElementById("angle").value = 90;
                window.generateGradient();
            };
            
            const inputs = document.querySelectorAll("input, select");
            inputs.forEach(input => input.addEventListener("input", window.generateGradient));
            setTimeout(window.generateGradient, 100);
        
</script>

<style>
.css-gradient-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.css-gradient-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.css-gradient-generator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.css-gradient-generator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.css-gradient-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.css-gradient-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\css-gradient-generator.blade.php ENDPATH**/ ?>