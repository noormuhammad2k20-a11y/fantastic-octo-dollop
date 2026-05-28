<div class="row g-4 random-color-palette-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-12">
                    <label class="form-label-custom">Palette Size</label>
                    <input type="range" id="paletteSize" class="form-range" min="3" max="10" value="5">
                    <div class="text-muted small mt-1">Size: <span id="sizeVal" class="fw-bold">5</span></div>
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="generatePalette()">Generate Palette</button>
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
                
            <div id="paletteResults" class="d-flex flex-wrap gap-2 overflow-x-auto w-100 rounded"></div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            document.getElementById("paletteSize").addEventListener("input", function(e){
                document.getElementById("sizeVal").innerText = e.target.value;
            });
            window.generatePalette = function() {
                let count = document.getElementById("paletteSize").value;
                let html = "";
                let hue = Math.floor(Math.random() * 360);
                for(let i=0; i<count; i++) {
                    let h = (hue + (i * (360 / count))) % 360;
                    let s = 70 + Math.random() * 30;
                    let l = 40 + Math.random() * 20;
                    let hsl = `hsl(${Math.round(h)}, ${Math.round(s)}%, ${Math.round(l)}%)`;
                    html += `<div class="flex-grow-1 p-4 text-center d-flex align-items-center justify-content-center" style="background-color: ${hsl}; min-height: 150px; min-width:100px;">
                        <span class="bg-white px-2 py-1 rounded shadow-sm fw-bold">${hsl}</span>
                    </div>`;
                }
                document.getElementById("paletteResults").innerHTML = html;
            };
            window.resetApp = function() {
                document.getElementById("paletteSize").value = 5;
                document.getElementById("sizeVal").innerText = "5";
                document.getElementById("paletteResults").innerHTML = "";
            };
            setTimeout(window.generatePalette, 100);
        
</script>

<style>
.random-color-palette-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.random-color-palette-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.random-color-palette-generator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.random-color-palette-generator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.random-color-palette-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.random-color-palette-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\random-color-palette-generator.blade.php ENDPATH**/ ?>