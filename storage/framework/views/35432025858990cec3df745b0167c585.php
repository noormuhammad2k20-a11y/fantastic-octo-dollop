<div class="row g-4 font-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(236, 72, 153, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #EC4899, #8B5CF6); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-magic"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#500724; letter-spacing: -0.5px;">Creative Font Alchemist</h4>
                    <p class="text-muted small mb-0">Transmute plain text into 50+ stylish Unicode variations for social media bios, captions, and messaging.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-8">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Source Content</h6>
                            <textarea id="v-text" class="form-control border-0 bg-white shadow-sm rounded-4 p-4 fw-bold h5 mb-0" rows="4" placeholder="Type your text here to transform it..."></textarea>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-pink">
                            <h6 class="fw-bold small mb-3 uppercase text-pink opacity-70">Alchemy Filters</h6>
                            <div class="mb-3">
                                <label class="form-label-custom">Preview Size</label>
                                <input type="range" id="v-size" class="form-range color-pink" min="14" max="32" value="20">
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="v-sparkle">
                                <label class="form-check-label small fw-bold text-muted">Add Sparkles (✨)</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="v-bracket">
                                <label class="form-check-label small fw-bold text-muted">Add Brackets (『』)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-v="Hello World">Quick Test</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-v="New Post Out Now!">Bio Link</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-v="Follow Me ✨">Social Call</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 330; --tool-color: #EC4899; --tool-bg: rgba(236, 72, 153, .04);">
            <div class="p-4">
                <div class="row g-3" id="out-grid">
                    
                </div>
            </div>

            <div class="p-4 bg-white border-top text-center">
                <button class="btn btn-pink rounded-pill px-5 py-3 fw-bold shadow-lg" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-rotate-left me-2"></i>Clear All Nodes
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const textE = $('v-text'), sizeE = $('v-size'), sparkleE = $('v-sparkle'), bracketE = $('v-bracket'), grid = $('out-grid');

    const maps = {
        'Classic Bold': { A: '𝐀', B: '𝐁', C: '𝐂', D: '𝐃', E: '𝐄', F: '𝐅', G: '𝐆', H: '𝐇', I: '𝐈', J: '𝐉', K: '𝐊', L: '𝐋', M: '𝐌', N: '𝐍', O: '𝐎', P: '𝐏', Q: '𝐐', R: '𝐑', S: '𝐒', T: '𝐓', U: '𝐔', V: '𝐕', W: '𝐖', X: '𝐗', Y: '𝐘', Z: '𝐙', a: '𝐚', b: '𝐛', c: '𝐜', d: '𝐝', e: '𝐞', f: '𝐟', g: '𝐠', h: '𝐡', i: '𝐢', j: '𝐣', k: '𝐤', l: '𝐥', m: '𝐦', n: '𝐧', o: '𝐨', p: '𝐩', q: '𝐪', r: '𝐫', s: '𝐬', t: '𝐭', u: '𝐮', v: '𝐯', w: '𝐰', x: '𝐱', y: '𝐲', z: '𝐳' },
        'Script Calligraphy': { A: '𝓐', B: '𝓑', C: '𝓒', D: '𝓓', E: '𝓔', F: '𝓕', G: '𝓖', H: '𝓗', I: '𝓘', J: '𝓙', K: '𝓚', L: '𝓛', M: '𝓜', N: '𝓝', O: '𝓞', P: '𝓟', Q: '𝓠', R: '𝓡', S: '𝓢', T: '𝓣', U: '𝓤', V: '𝓥', W: '𝓦', X: '𝓧', Y: '𝓨', Z: '𝓩', a: '𝓪', b: '𝓫', c: '𝓬', d: '𝓭', e: '𝓮', f: '𝓯', g: '𝓰', h: '𝓱', i: '𝓲', j: '𝓳', k: '𝓴', l: '𝓵', m: '𝓶', n: '𝓷', o: '𝓸', p: '𝓹', q: '𝓺', r: '𝓻', s: '𝓼', t: '𝓽', u: '𝓾', v: '𝓿', w: '𝔀', x: '𝔁', y: '𝔂', z: '𝔃' },
        'Elite Double-Struck': { A: '𝔸', B: '𝔹', C: 'ℂ', D: '𝔻', E: '𝔼', F: '𝔽', G: '𝔾', H: 'ℍ', I: '𝕀', J: '𝕁', K: '𝕂', L: '𝕃', M: '𝕄', N: 'ℕ', O: '𝕆', P: 'ℙ', Q: 'ℚ', R: 'ℝ', S: '𝕊', T: '𝕋', U: '𝕌', V: '𝕍', W: '𝕎', X: '𝕏', Y: '𝕐', Z: 'ℤ', a: '𝕒', b: '𝕓', c: '𝕔', d: '𝕕', e: '𝕖', f: '𝕗', g: '𝕘', h: '𝕙', i: '𝕚', j: '𝕛', k: '𝕜', l: '𝕝', m: '𝕞', n: '𝕟', o: '𝕠', p: '𝕡', q: '𝕢', r: '𝕣', s: '𝕤', t: '𝕥', u: '𝕦', v: '𝕧', w: '𝕨', x: '𝕩', y: '𝕪', z: '𝕫' },
        'Bubble Pop': { A: 'Ⓐ', B: 'Ⓑ', C: 'Ⓒ', D: 'Ⓓ', E: 'Ⓔ', F: 'Ⓕ', G: 'Ⓖ', H: 'Ⓗ', I: 'Ⓘ', J: 'Ⓙ', K: 'Ⓚ', L: 'Ⓛ', M: 'Ⓜ', N: 'Ⓝ', O: 'Ⓞ', P: 'Ⓟ', Q: 'Ⓠ', R: 'Ⓡ', S: 'Ⓢ', T: 'Ⓣ', U: 'Ⓤ', V: 'Ⓥ', W: 'Ⓦ', X: 'Ⓧ', Y: 'Ⓨ', Z: 'Ⓩ', a: 'ⓐ', b: 'ⓑ', c: 'ⓒ', d: 'ⓓ', e: 'ⓔ', f: 'ⓕ', g: 'ⓖ', h: 'ⓗ', i: 'ⓘ', j: 'ⓙ', k: 'ⓚ', l: 'ⓛ', m: 'ⓜ', n: 'ⓝ', o: 'ⓞ', p: 'ⓟ', q: 'ⓠ', r: 'ⓡ', s: 'ⓢ', t: 'ⓣ', u: 'ⓤ', v: 'ⓥ', w: 'ⓦ', x: 'ⓧ', y: 'ⓨ', z: 'ⓩ' },
        'Small Caps': { A: 'ᴀ', B: 'ʙ', C: 'ᴄ', D: 'ᴅ', E: 'ᴇ', F: 'ꜰ', G: 'ɢ', H: 'ʜ', I: 'ɪ', J: 'ᴊ', K: 'ᴋ', L: 'ʟ', M: 'ᴍ', N: 'ɴ', O: 'ᴏ', P: 'ᴘ', Q: 'ǫ', R: 'ʀ', S: 's', T: 'ᴛ', U: 'ᴜ', V: 'ᴠ', W: 'ᴡ', X: 'x', Y: 'ʏ', Z: 'ᴢ', a: 'ᴀ', b: 'ʙ', c: 'ᴄ', d: 'ᴅ', e: 'ᴇ', f: 'ꜰ', g: 'ɢ', h: 'ʜ', i: 'ɪ', j: 'ᴊ', k: 'ᴋ', l: 'ʟ', m: 'ᴍ', n: 'ɴ', o: 'ᴏ', p: 'ᴘ', q: 'ǫ', r: 'ʀ', s: 's', t: 'ᴛ', u: 'ᴜ', v: 'ᴠ', w: 'ᴡ', x: 'x', y: 'ʏ', z: 'ᴢ' }
    };

    function transform(text, map){
        let out = text.split('').map(c => map[c] || c).join('');
        if(sparkleE.checked) out = '✨ ' + out + ' ✨';
        if(bracketE.checked) out = '『 ' + out + ' 』';
        return out;
    }

    function calculate(){
        const raw = textE.value || 'TRANSFORM ME';
        const size = sizeE.value + 'px';
        grid.innerHTML = '';

        Object.entries(maps).forEach(([name, map]) => {
            const final = transform(raw, map);
            const col = document.createElement('div');
            col.className = 'col-md-6';
            col.innerHTML = `
                <div class="p-4 rounded-4 bg-white border shadow-sm h-100 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="small fw-bold text-muted uppercase letter-spacing-1">${name}</span>
                        <button class="btn btn-pink-soft btn-sm rounded-pill px-3 fw-bold copy-node">COPY</button>
                    </div>
                    <div class="font-preview text-dark mb-0" style="font-size: ${size}; line-height: 1.2; word-break: break-all;">${final}</div>
                </div>
            `;
            col.querySelector('.copy-node').addEventListener('click', function(){
                navigator.clipboard.writeText(final).then(() => {
                    const o = this.innerHTML; this.innerHTML = 'COPIED!';
                    setTimeout(() => this.innerHTML = o, 1500);
                });
            });
            grid.appendChild(col);
        });
    }

    [textE, sizeE, sparkleE, bracketE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => { textE.value = btn.dataset.v; calculate(); });
    });

    $('reset-calc').addEventListener('click', () => { textE.value = ''; sparkleE.checked = false; bracketE.checked = false; calculate(); });

    calculate();
});
</script>

<style>
.font-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#500724;opacity:.7;margin-bottom:8px;display:block}
.font-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-pink { background: #EC4899; color: #fff; transition: all .3s; }
.btn-pink:hover { background: #DB2777; color: #fff; transform: translateY(-2px); }
.btn-pink-soft { background: #FCE7F3; color: #EC4899; border: 1px solid #fbcfe8; }
.text-pink { color: #EC4899; }
.bg-pink-soft { background: #FCE7F3; }
.color-pink::-webkit-slider-thumb { background: #EC4899; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\font-converter.blade.php ENDPATH**/ ?>