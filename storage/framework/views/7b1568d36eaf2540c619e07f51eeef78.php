<div class="row g-4 neumorphism-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-6">
                    <label class="form-label-custom">Size</label>
                    <input type="range" id="size" class="form-range" min="10" max="300" value="150">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Distance</label>
                    <input type="range" id="distance" class="form-range" min="5" max="50" value="20">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Intensity</label>
                    <input type="range" id="intensity" class="form-range" min="0.01" max="0.6" step="0.01" value="0.15">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Blur</label>
                    <input type="range" id="blur" class="form-range" min="0" max="100" value="40">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Shape</label>
                    <select id="shape" class="form-select form-select-lg rounded-3">
                        <option value="flat">Flat</option>
                        <option value="concave">Concave</option>
                        <option value="convex">Convex</option>
                        <option value="pressed">Pressed</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Background Color</label>
                    <input type="color" id="color" class="form-control form-control-color w-100" value="#e0e0e0">
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="generateNeu()">Generate CSS</button>
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
                
            <div id="previewContainer" class="mb-4 p-5 text-center rounded-3 d-flex justify-content-center align-items-center" style="min-height: 350px;">
                <div id="previewBox" style="border-radius: 30px;"></div>
            </div>
            <div class="bg-dark p-3 rounded-3 text-break overflow-x-auto">
                <code id="cssOutput" class="text-white"></code>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            function colorLuminance(hex, lum) {
                hex = String(hex).replace(/[^0-9a-f]/gi, "");
                if (hex.length < 6) {
                    hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
                }
                lum = lum || 0;
                let rgb = "#", c, i;
                for (i = 0; i < 3; i++) {
                    c = parseInt(hex.substr(i*2,2), 16);
                    c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                    rgb += ("00"+c).substr(c.length);
                }
                return rgb;
            }

            window.generateNeu = function() {
                let size = document.getElementById("size").value;
                let distance = document.getElementById("distance").value;
                let intensity = document.getElementById("intensity").value;
                let blur = document.getElementById("blur").value;
                let shape = document.getElementById("shape").value;
                let color = document.getElementById("color").value;
                
                let color1 = colorLuminance(color, intensity);
                let color2 = colorLuminance(color, -intensity);
                
                let shadow = "";
                let bg = color;
                
                if(shape === "flat") {
                    shadow = `${distance}px ${distance}px ${blur}px ${color2}, -${distance}px -${distance}px ${blur}px ${color1}`;
                } else if(shape === "pressed") {
                    shadow = `inset ${distance}px ${distance}px ${blur}px ${color2}, inset -${distance}px -${distance}px ${blur}px ${color1}`;
                } else if(shape === "concave") {
                    bg = `linear-gradient(145deg, ${color2}, ${color1})`;
                    shadow = `${distance}px ${distance}px ${blur}px ${color2}, -${distance}px -${distance}px ${blur}px ${color1}`;
                } else if(shape === "convex") {
                    bg = `linear-gradient(145deg, ${color1}, ${color2})`;
                    shadow = `${distance}px ${distance}px ${blur}px ${color2}, -${distance}px -${distance}px ${blur}px ${color1}`;
                }
                
                let css = `background: ${bg};\nbox-shadow: ${shadow};\nborder-radius: 30px;`;
                
                let el = document.getElementById("previewBox");
                el.style.width = size + "px";
                el.style.height = size + "px";
                el.style.background = bg;
                el.style.boxShadow = shadow;
                
                document.getElementById("previewContainer").style.background = color;
                document.getElementById("cssOutput").innerText = css;
            };
            window.resetApp = function() {
                document.getElementById("size").value = 150;
                document.getElementById("distance").value = 20;
                document.getElementById("intensity").value = 0.15;
                document.getElementById("blur").value = 40;
                document.getElementById("shape").value = "flat";
                document.getElementById("color").value = "#e0e0e0";
                window.generateNeu();
            };
            
            const inputs = document.querySelectorAll("input, select");
            inputs.forEach(input => input.addEventListener("input", window.generateNeu));
            setTimeout(window.generateNeu, 100);
        
</script>

<style>
.neumorphism-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.neumorphism-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.neumorphism-generator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.neumorphism-generator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.neumorphism-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.neumorphism-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\neumorphism-generator.blade.php ENDPATH**/ ?>