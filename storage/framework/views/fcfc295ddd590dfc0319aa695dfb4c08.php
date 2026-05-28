<div class="row g-4 seo-auditor-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(79, 70, 229, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #4F46E5, #3730A3); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-microscope"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">SEO Keyword Auditor</h4>
                    <p class="text-muted small mb-0">Deep semantic analysis of content density, phrase frequency, and anti-spam (stuffing) detection.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-8">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Content Specimen</h6>
                            <textarea id="v-input" class="form-control border-0 bg-white shadow-sm rounded-4 p-4 fw-bold small mb-0" rows="10" placeholder="Paste your article or copy here for deep SEO auditing..."></textarea>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-indigo">
                            <h6 class="fw-bold small mb-3 uppercase text-indigo opacity-70">Audit Parameters</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Analysis Depth</label>
                                <select id="v-ngram" class="form-select border-0 bg-light rounded-3 fw-bold py-2">
                                    <option value="1">Single Keywords (Unigrams)</option>
                                    <option value="2">2-Word Phrases (Bigrams)</option>
                                    <option value="3">3-Word Phrases (Trigrams)</option>
                                </select>
                            </div>
                            <div class="vstack gap-3">
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Ignore Stop Words</label>
                                    <input class="form-check-input" type="checkbox" id="v-stop" checked>
                                </div>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label small fw-bold text-muted">Case Sensitive</label>
                                    <input class="form-check-input" type="checkbox" id="v-case">
                                </div>
                                <hr class="my-1 opacity-10">
                                <div class="p-3 rounded-3 bg-indigo-50 border border-indigo-100 text-center">
                                    <div class="small fw-bold text-indigo-900">READABILITY SCORE</div>
                                    <div class="h5 fw-900 text-indigo-900 mb-0" id="out-read">SCANNING...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="out-wrapper" style="--tool-hue: 240; --tool-color: #4F46E5; --tool-bg: rgba(79, 70, 229, .04); display: none;">
            <div class="p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Frequency & Density Matrix</h6>
                        <div id="out-list" class="vstack gap-2">
                            
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Document Intelligence</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="p-3 rounded-4 bg-indigo-50 border border-indigo-100 text-center">
                                        <div class="small fw-bold text-indigo-900 opacity-60 uppercase" style="font-size: 0.6rem;">Total Words</div>
                                        <div class="h5 fw-900 text-indigo-900 mb-0" id="out-total">0</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 rounded-4 bg-indigo-50 border border-indigo-100 text-center">
                                        <div class="small fw-bold text-indigo-900 opacity-60 uppercase" style="font-size: 0.6rem;">Read Time</div>
                                        <div class="h5 fw-900 text-indigo-900 mb-0" id="out-time">0m</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-3 rounded-4 bg-indigo-50 border border-indigo-100 mb-4">
                                <div class="small fw-bold text-indigo-900 mb-1">OPTIMIZATION ADVICE</div>
                                <div class="small text-muted lh-base" id="out-advice">Input content to generate SEO insights.</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-indigo rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-file-export me-2"></i>Export Audit Data
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Specimen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const inputE = $('v-input'), ngramE = $('v-ngram'), stopE = $('v-stop'), caseE = $('v-case'), wrap = $('out-wrapper');

    const stops = ["the", "and", "a", "of", "to", "in", "is", "it", "with", "for", "on", "as", "at", "by", "this", "that", "from", "are", "be", "or", "an"];

    function analyze(){
        let raw = inputE.value.trim();
        if(!raw){ wrap.style.display = 'none'; return; }

        let text = caseE.checked ? raw : raw.toLowerCase();
        let words = text.match(/\b\w+\b/g) || [];
        const totalCount = words.length;

        if(stopE.checked) words = words.filter(w => !stops.includes(w.toLowerCase()));

        const depth = parseInt(ngramE.value);
        let phrases = [];
        for(let i=0; i <= words.length - depth; i++){
            phrases.push(words.slice(i, i + depth).join(' '));
        }

        const counts = {};
        phrases.forEach(p => counts[p] = (counts[p] || 0) + 1);

        const sorted = Object.keys(counts).sort((a,b) => counts[b] - counts[a]).slice(0, 10);

        $('out-list').innerHTML = sorted.map(p => {
            const perc = ((counts[p] / totalCount) * 100).toFixed(1);
            const status = perc > 3 ? 'STUFFED' : 'OPTIMAL';
            const color = perc > 3 ? 'danger' : 'indigo';
            return `
                <div class="p-3 rounded-4 bg-white border shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold text-dark font-monospace">${p}</span>
                        <span class="badge bg-${color}-soft text-${color} small">${perc}%</span>
                    </div>
                    <div class="progress" style="height: 4px; background: #f1f5f9;">
                        <div class="progress-bar bg-${color}" style="width: ${Math.min(perc*20, 100)}%"></div>
                    </div>
                </div>
            `;
        }).join('');

        $('out-total').textContent = totalCount;
        $('out-time').textContent = Math.ceil(totalCount / 200) + 'm';
        
        let advice = "Density is looking healthy. Focus on semantic LSI variety.";
        if(parseFloat(sorted[0] ? ((counts[sorted[0]]/totalCount)*100) : 0) > 3) advice = "Keyword stuffing detected! Reduce usage of your primary term to avoid search penalties.";
        $('out-advice').textContent = advice;

        // Readability (Mock Flesch-Kincaid)
        const score = Math.min(100, Math.max(0, 100 - (totalCount/20)));
        $('out-read').textContent = score > 60 ? 'ACCESSIBLE' : 'COMPLEX';

        wrap.style.display = 'block';
    }

    [inputE, ngramE, stopE, caseE].forEach(e => e.addEventListener('input', analyze));

    $('copy-summary').addEventListener('click', function(){
        const txt = `SEO Audit Report\nTotal Words: ${$('out-total').textContent}\nTop Term: ${$('out-list').querySelector('.fw-bold').textContent}\nGenerated by ToolsHub SEO Auditor`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = 'Audit Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('reset-calc').addEventListener('click', () => { inputE.value = ''; analyze(); });
});
</script>

<style>
.seo-auditor-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e1b4b;opacity:.7;margin-bottom:8px;display:block}
.seo-auditor-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-indigo { background: #4F46E5; color: #fff; transition: all .3s; }
.btn-indigo:hover { background: #3730A3; color: #fff; transform: translateY(-2px); }
.bg-indigo-soft { background: #EEF2FF; color: #4F46E5; }
.bg-indigo-50 { background-color: #f8faff; }
.bg-danger-soft { background: #FEF2F2; color: #EF4444; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\keyword-density-calculator.blade.php ENDPATH**/ ?>