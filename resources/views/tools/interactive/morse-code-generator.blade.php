<div class="row g-4 morse-code-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-12">
                    <label class="form-label-custom">Input Text or Morse Code</label>
                    <textarea id="inputStr" class="form-control rounded-3" rows="5" placeholder="Enter text to convert to morse, or morse to convert to text..."></textarea>
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="toMorse()">Convert to Morse</button>
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="fromMorse()">Convert to Text</button>
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
                <label class="form-label-custom mb-2">Output Result</label>
                <div class="bg-light p-4 rounded-3 text-break overflow-x-auto fw-bold fs-5 border shadow-sm" style="min-height: 100px; letter-spacing: 2px;" id="outputStr"></div>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            const morseDict = {
                "A": ".-", "B": "-...", "C": "-.-.", "D": "-..", "E": ".", "F": "..-.",
                "G": "--.", "H": "....", "I": "..", "J": ".---", "K": "-.-", "L": ".-..",
                "M": "--", "N": "-.", "O": "---", "P": ".--.", "Q": "--.-", "R": ".-.",
                "S": "...", "T": "-", "U": "..-", "V": "...-", "W": ".--", "X": "-..-",
                "Y": "-.--", "Z": "--..", "1": ".----", "2": "..---", "3": "...--",
                "4": "....-", "5": ".....", "6": "-....", "7": "--...", "8": "---..",
                "9": "----.", "0": "-----", " ": "/"
            };
            const reverseDict = Object.fromEntries(Object.entries(morseDict).map(([k, v]) => [v, k]));
            
            window.toMorse = function() {
                let text = document.getElementById("inputStr").value.toUpperCase();
                let result = Array.from(text).map(c => morseDict[c] || c).join(" ");
                document.getElementById("outputStr").innerText = result;
            };
            window.fromMorse = function() {
                let text = document.getElementById("inputStr").value.trim();
                let result = text.split(" ").map(w => reverseDict[w] || w).join("");
                // handle spaces correctly if / was used
                result = result.replace(/\//g, " ");
                document.getElementById("outputStr").innerText = result;
            };
            window.resetApp = function() {
                document.getElementById("inputStr").value = "";
                document.getElementById("outputStr").innerText = "";
            };
        
</script>

<style>
.morse-code-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.morse-code-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.morse-code-generator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.morse-code-generator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.morse-code-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.morse-code-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style>