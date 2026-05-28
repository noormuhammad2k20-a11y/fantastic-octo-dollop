<div class="row g-4 buzzword-bingo-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-12">
                    <label class="form-label-custom">Custom Words (comma separated)</label>
                    <textarea id="wordsStr" class="form-control rounded-3" rows="4">Synergy, Paradigm Shift, Leverage, Disruptive, Bandwidth, Out of the box, Granular, Pivot, Alignment, Agnostic, Deep dive, Ecosystem, Traction, Holistic, Scalable</textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label-custom">Grid Size</label>
                    <select id="gridSize" class="form-select form-select-lg rounded-3">
                        <option value="3">3x3</option>
                        <option value="4">4x4</option>
                        <option value="5">5x5</option>
                    </select>
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="generateBingo()">Generate Board</button>
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
                
            <div class="table-responsive text-center w-100 mx-auto">
                <table class="table table-bordered table-striped bg-white shadow-sm rounded-3" id="bingoBoard"></table>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            window.generateBingo = function() {
                let text = document.getElementById("wordsStr").value;
                let words = text.split(",").map(w => w.trim()).filter(w => w.length > 0);
                let size = parseInt(document.getElementById("gridSize").value);
                
                // shuffle array
                for (let i = words.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [words[i], words[j]] = [words[j], words[i]];
                }
                
                let board = document.getElementById("bingoBoard");
                let html = "";
                let count = 0;
                for(let r=0; r<size; r++) {
                    html += "<tr>";
                    for(let c=0; c<size; c++) {
                        let word = words[count % words.length] || "Free Space";
                        if(size === 5 && r === 2 && c === 2) word = "FREE SPACE";
                        html += `<td class="p-3 align-middle fw-bold text-dark" style="width:${100/size}%;">${word}</td>`;
                        count++;
                    }
                    html += "</tr>";
                }
                board.innerHTML = html;
            };
            window.resetApp = function() {
                document.getElementById("wordsStr").value = "Synergy, Paradigm Shift, Leverage, Disruptive, Bandwidth, Out of the box, Granular, Pivot, Alignment, Agnostic, Deep dive, Ecosystem, Traction, Holistic, Scalable";
                document.getElementById("gridSize").value = "3";
                document.getElementById("bingoBoard").innerHTML = "";
            };
            setTimeout(window.generateBingo, 100);
        
</script>

<style>
.buzzword-bingo-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.buzzword-bingo-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.buzzword-bingo-generator-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.buzzword-bingo-generator-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.buzzword-bingo-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.buzzword-bingo-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\buzzword-bingo-generator.blade.php ENDPATH**/ ?>