<div class="row g-4 html-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(16, 185, 129, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #10b981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">HTML Entity Safe-Guard</h4>
                    <p class="text-muted small mb-0">Neutralize malicious scripts and display special characters correctly across all browsers. Essential for XSS prevention.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Input Zone --}}
                    <div class="col-md-8">
                        <div class="p-4 rounded-4 bg-light border h-100 position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold small mb-0 uppercase opacity-50">Content Stream</h6>
                                <button class="btn btn-white btn-sm shadow-sm rounded-pill px-3 fw-bold" id="v-clear" style="min-width: 280px; max-width: 100%;">CLEAR</button>
                            </div>
                            <textarea id="v-input" class="form-control border-0 bg-white shadow-sm rounded-4 p-4 font-monospace small mb-0" rows="10" placeholder='<b>"Hello" & World</b>' style="resize: vertical;"></textarea>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-emerald-100">
                            <h6 class="fw-bold small mb-3 uppercase text-emerald-600">Transformation Mode</h6>
                            <div class="vstack gap-4">
                                <div class="btn-group w-100 p-1 bg-light rounded-4">
                                    <input type="radio" class="btn-check" name="v-mode" id="m-encode" value="encode" checked>
                                    <label class="btn btn-emerald rounded-3 py-2 fw-bold" for="m-encode">ENCODE</label>
                                    
                                    <input type="radio" class="btn-check" name="v-mode" id="m-decode" value="decode">
                                    <label class="btn btn-emerald rounded-3 py-2 fw-bold" for="m-decode">DECODE</label>
                                </div>

                                <div class="p-3 rounded-4 bg-emerald-50 border border-emerald-100">
                                    <h6 class="small fw-bold text-emerald-900 mb-2">Security Tip</h6>
                                    <p class="small text-emerald-700 mb-0">Encoding <, >, and & prevents browsers from executing raw HTML injected via user inputs.</p>
                                </div>

                                <button class="btn d-block mx-auto btn-emerald rounded-4 fw-bold text-white shadow-lg py-3 px-5 fw-bold rounded-pill shadow-sm" id="convert-btn" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-bolt me-2"></i>Execute Conversion
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="out-wrapper" style="--tool-hue: 150; --tool-color: #10b981; --tool-bg: rgba(16, 185, 129, .04); display: none;">
            <div class="p-4 bg-white border-top rounded-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-emerald-soft text-emerald px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">CONVERSION COMPLETE</span>
                    <button class="btn btn-emerald btn-sm rounded-pill px-4 fw-bold text-white shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">COPY RESULT</button>
                </div>
                <div class="p-4 rounded-4 bg-slate-900 border border-slate-800">
                    <pre id="out-data" class="text-emerald-400 font-monospace small mb-0 overflow-auto" style="max-height: 400px; white-space: pre-wrap; word-break: break-all;"></pre>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const inputE = $('v-input'), outData = $('out-data'), outWrapper = $('out-wrapper');

    function encode(str) {
        return str.replace(/[\u00A0-\u9999<>&]/g, i => {
            return '&#' + i.charCodeAt(0) + ';';
        });
    }

    function decode(str) {
        const txt = document.createElement("textarea");
        txt.innerHTML = str;
        return txt.value;
    }

    $('convert-btn').addEventListener('click', () => {
        const raw = inputE.value;
        if (!raw) return;
        
        const mode = document.querySelector('input[name="v-mode"]:checked').value;
        const result = mode === 'encode' ? encode(raw) : decode(raw);
        
        outData.textContent = result;
        outWrapper.style.display = 'block';
        outWrapper.scrollIntoView({ behavior: 'smooth' });
    });

    $('v-clear').addEventListener('click', () => { inputE.value = ''; outWrapper.style.display = 'none'; });

    $('copy-summary').addEventListener('click', function(){
        navigator.clipboard.writeText(outData.textContent).then(() => {
            const o = this.innerHTML; this.innerHTML = 'COPIED!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });
});
</script>

<style>
.html-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
.html-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-emerald { background: #10b981; color: #fff; transition: all .3s; }
.btn-emerald:hover { background: #059669; color: #fff; transform: translateY(-2px); }
.bg-emerald-50 { background-color: #f0fdf4; }
.bg-emerald-soft { background-color: #ecfdf5; color: #10b981; }
.bg-slate-900 { background-color: #0f172a; }
.text-emerald-400 { color: #34d399; }
.fw-900 { font-weight: 900; }
.font-monospace { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
</style>

