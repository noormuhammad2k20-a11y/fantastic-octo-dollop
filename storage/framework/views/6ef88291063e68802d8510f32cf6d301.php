<div class="row g-4 word-to-phone-converter-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-12">
                    <label class="form-label-custom">Alphanumeric Phone Number / Word</label>
                    <input type="text" id="phoneStr" class="form-control form-control-lg rounded-3" value="1-800-FLOWERS" placeholder="e.g. 1-800-CONTACTS">
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="convertPhone()">Convert to Digits</button>
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
                
            <div class="bg-white p-5 border rounded-3 text-center shadow-sm">
                <h2 class="text-primary fw-bold m-0" id="outputStr" style="letter-spacing: 3px;">--</h2>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            const phoneDict = {
                "A": "2", "B": "2", "C": "2", "D": "3", "E": "3", "F": "3",
                "G": "4", "H": "4", "I": "4", "J": "5", "K": "5", "L": "5",
                "M": "6", "N": "6", "O": "6", "P": "7", "Q": "7", "R": "7", "S": "7",
                "T": "8", "U": "8", "V": "8", "W": "9", "X": "9", "Y": "9", "Z": "9"
            };
            window.convertPhone = function() {
                let text = document.getElementById("phoneStr").value.toUpperCase();
                let result = Array.from(text).map(c => phoneDict[c] || c).join("");
                document.getElementById("outputStr").innerText = result;
            };
            window.resetApp = function() {
                document.getElementById("phoneStr").value = "1-800-FLOWERS";
                document.getElementById("outputStr").innerText = "--";
            };
            setTimeout(window.convertPhone, 100);
        
</script>

<style>
.word-to-phone-converter-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.word-to-phone-converter-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.word-to-phone-converter-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.word-to-phone-converter-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.word-to-phone-converter-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.word-to-phone-converter-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\word-to-phone-converter.blade.php ENDPATH**/ ?>