<div class="row g-4 roman-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Standard Number (Arabic)</label>
                        <input type="number" id="num-input" class="form-control form-control-lg" placeholder="e.g. 2024" min="1" max="3999" value="2024">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Roman Numeral</label>
                        <input type="text" id="roman-input" class="form-control form-control-lg text-uppercase font-monospace" placeholder="e.g. MMXXIV" value="MMXXIV">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill rom-quick" data-val="49">49 (XLIX)</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill rom-quick" data-val="999">999 (CMXCIX)</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill rom-quick" data-val="1994">1994 (MCMXCIV)</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:35;--tool-color:#92400e;--tool-bg:rgba(180,83,9,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Result</span>
                <div class="output-hero-value font-serif" id="out-result" style="letter-spacing: 2px;">MMXXIV</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-12">
                    <div class="stat-card">
                        <span class="stat-card-label">Basic Symbols Reference</span>
                        <div class="d-flex justify-content-between flex-wrap gap-2 mt-2">
                            <span class="badge bg-light text-dark border p-2">I = 1</span>
                            <span class="badge bg-light text-dark border p-2">V = 5</span>
                            <span class="badge bg-light text-dark border p-2">X = 10</span>
                            <span class="badge bg-light text-dark border p-2">L = 50</span>
                            <span class="badge bg-light text-dark border p-2">C = 100</span>
                            <span class="badge bg-light text-dark border p-2">D = 500</span>
                            <span class="badge bg-light text-dark border p-2">M = 1000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Result</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const numIn = document.getElementById('num-input');
    const romIn = document.getElementById('roman-input');
    const outRes = document.getElementById('out-result');

    const romanMap = [
        {m: 1000, r: 'M'}, {m: 900, r: 'CM'}, {m: 500, r: 'D'}, {m: 400, r: 'CD'},
        {m: 100, r: 'C'}, {m: 90, r: 'XC'}, {m: 50, r: 'L'}, {m: 40, r: 'XL'},
        {m: 10, r: 'X'}, {m: 9, r: 'IX'}, {m: 5, r: 'V'}, {m: 4, r: 'IV'}, {m: 1, r: 'I'}
    ];

    function toRoman(num){
        if(num <= 0 || num > 3999) return "Invalid";
        let res = "";
        for(let pair of romanMap){
            while(num >= pair.m){
                res += pair.r;
                num -= pair.m;
            }
        }
        return res;
    }

    function fromRoman(str){
        str = str.toUpperCase();
        if(!/^[MDCLXVI]+$/.test(str)) return NaN;
        let res = 0;
        let i = 0;
        for(let pair of romanMap){
            while(str.indexOf(pair.r, i) === i){
                res += pair.m;
                i += pair.r.length;
            }
        }
        return res;
    }

    numIn.addEventListener('input', () => {
        const val = parseInt(numIn.value);
        const rom = toRoman(val);
        romIn.value = rom;
        outRes.textContent = rom;
    });

    romIn.addEventListener('input', () => {
        const val = fromRoman(romIn.value);
        if(!isNaN(val)){
            numIn.value = val;
            outRes.textContent = val;
        } else {
            outRes.textContent = "Invalid";
        }
    });

    document.querySelectorAll('.rom-quick').forEach(btn => {
        btn.addEventListener('click', () => {
            numIn.value = btn.dataset.val;
            numIn.dispatchEvent(new Event('input'));
        });
    });

    document.getElementById('btn-copy').addEventListener('click', function(){
        navigator.clipboard.writeText(outRes.textContent);
        const o = this.innerHTML; this.innerHTML = 'Copied!';
        setTimeout(()=>this.innerHTML=o, 2000);
    });
});
</script>

<style>
.roman-calc-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,.04); }
.roman-calc-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.roman-calc-rebuilt .calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; }
.roman-calc-rebuilt .calculator-header p { margin: 0; font-size: .9rem; color: #64748b; }
.roman-calc-rebuilt .tool-icon-circle { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
.roman-calc-rebuilt .form-label-custom { font-size: .85rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; display: block; }

.roman-calc-rebuilt .output-card-themed { border-radius: 24px; padding: 2.5rem; border: 1px solid #e5e7eb; background-color: var(--tool-bg); }
.roman-calc-rebuilt .output-hero { text-align: center; padding-bottom: 2rem; border-bottom: 1px dashed rgba(0,0,0,.1); }
.roman-calc-rebuilt .output-hero-label { font-size: .85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
.roman-calc-rebuilt .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: .5rem 0; font-family: 'Times New Roman', serif; }

.roman-calc-rebuilt .stat-card { background: #fff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; height: 100%; }
.roman-calc-rebuilt .stat-card-label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .25rem; }

@media (max-width: 768px) {
    .roman-calc-rebuilt .output-hero-value { font-size: 2.5rem; }
}
</style>

