<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0" style="background: #0f172a;">
        <div class="card-header-v2 bg-transparent border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-indigo-soft">
                        <i class="fas fa-terminal text-indigo"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-white">Unicode Alchemist</h5>
                        <p class="text-slate-400 small mb-0">Decode and transform plain text into advanced Unicode glyphs</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-slate btn-sm rounded-pill px-3" id="btn-clear">
                        <i class="fas fa-trash-alt me-1"></i> Clear
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <textarea id="text-input" class="form-control tool-textarea-dark mb-4" rows="6" placeholder="Type text to transcode..."></textarea>
            
            <div class="p-4 rounded-4 bg-slate-800/50 border border-slate-700">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-slate-400 text-uppercase">Transform Mode</label>
                        <select id="mode-select" class="form-select select-dark">
                            <optgroup label="Stylistic Maps">
                                <option value="circles">ⒶⒷⒸ Circles</option>
                                <option value="squares">🄰🄱🄲 Squares</option>
                                <option value="monospace">𝙼𝚘𝚗𝚘𝚜𝚙𝚊𝚌𝚎</option>
                                <option value="gothic">𝔊𝔬𝔱𝔥𝔦𝔠 Style</option>
                            </optgroup>
                            <optgroup label="Technical Encoding">
                                <option value="hex-u" selected>Unicode (U+XXXX)</option>
                                <option value="hex-x">Hex (\xXX)</option>
                                <option value="decimal">Decimal Entities</option>
                                <option value="html">HTML Hex Entities</option>
                            </optgroup>
                        </select>
                    </div>
                    
                    <div class="col-md-8 d-flex flex-column justify-content-end">
                        <div class="d-flex flex-wrap gap-4 mb-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="opt-reverse">
                                <label class="form-check-label small fw-semibold text-slate-300" for="opt-reverse">Reverse Output</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="opt-decode">
                                <label class="form-check-label small fw-semibold text-slate-300" for="opt-decode">Decode Input (Hex/Ent to Text)</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-white font-monospace" rows="6" readonly placeholder="Your alchemy results appear here..."></textarea>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #6366f1;
        --indigo-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --border-color: #e2e8f0;
        --slate-800: #1e293b;
        --slate-400: #94a3b8;
    }

    .bg-indigo-soft { background-color: var(--indigo-soft); }
    .bg-success-soft { background-color: var(--success-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; }

    .icon-box { 
        width: 48px; 
        height: 48px; 
        border-radius: 14px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.25rem;
    }

    .tool-textarea { 
        border: 1.5px solid var(--border-color); 
        border-radius: 16px; 
        padding: 1.25rem; 
        background: #fff; 
        transition: all 0.3s ease; 
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        line-height: 1.6;
    }

    .tool-textarea-dark {
        background: #1e293b;
        border: 1px solid #334155;
        color: #e2e8f0;
        border-radius: 16px;
        padding: 1.25rem;
        font-family: 'Fira Code', monospace;
        transition: all 0.3s ease;
    }
    .tool-textarea-dark:focus { background: #0f172a; border-color: var(--primary-color); outline: none; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); }

    .select-dark { background: #1e293b; border-color: #334155; color: #fff; }
    .select-dark:focus { background: #1e293b; border-color: var(--primary-color); color: #fff; }

    .btn-outline-slate { border-color: #334155; color: #94a3b8; }
    .btn-outline-slate:hover { background: #334155; color: #fff; }

    .transition-all { transition: all 0.2s ease; }
    
    .text-indigo { color: var(--primary-color); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('text-input');
    const output = document.getElementById('output-text');
    const modeSelect = document.getElementById('mode-select');
    const optReverse = document.getElementById('opt-reverse');
    const optDecode = document.getElementById('opt-decode');
    const btnClear = document.getElementById('btn-clear');
    const btnCopy = document.getElementById('btn-copy');
    const btnDownload = document.getElementById('btn-download');
    const btnUndo = document.getElementById('btn-undo');
    const statsText = document.getElementById('stats-text');

    const maps = {
        circles: { A: 'Ⓐ', B: 'Ⓑ', C: 'Ⓒ', D: 'Ⓓ', E: 'Ⓔ', F: 'Ⓕ', G: 'Ⓖ', H: 'Ⓗ', I: 'Ⓘ', J: 'Ⓙ', K: 'Ⓚ', L: 'Ⓛ', M: 'Ⓜ', N: 'Ⓝ', O: 'Ⓞ', P: 'Ⓟ', Q: 'Ⓠ', R: 'Ⓡ', S: 'Ⓢ', T: 'Ⓣ', U: 'Ⓤ', V: 'Ⓥ', W: 'Ⓦ', X: 'Ⓧ', Y: 'Ⓨ', Z: 'Ⓩ', a: 'ⓐ', b: 'ⓑ', c: 'ⓒ', d: 'ⓓ', e: 'ⓔ', f: 'ⓕ', g: 'ⓖ', h: 'ⓗ', i: 'ⓘ', j: 'ⓙ', k: 'ⓚ', l: 'ⓛ', m: 'ⓜ', n: 'ⓝ', o: 'ⓞ', p: 'ⓟ', q: 'ⓠ', r: 'ⓡ', s: 'ⓢ', t: 'ⓣ', u: 'ⓤ', v: 'ⓥ', w: 'ⓦ', x: 'ⓧ', y: 'ⓨ', z: 'ⓩ', '1':'①','2':'②','3':'③','4':'④','5':'⑤','6':'⑥','7':'⑦','8':'⑧','9':'⑨','0':'⓪' },
        squares: { A: '🄰', B: '🄱', C: '🄲', D: '🄳', E: '🄴', F: '🄵', G: '🄶', H: '🄷', I: '🄸', J: '🄹', K: '🄺', L: '🄻', M: '🄼', N: '🄽', O: '🄾', P: '🄿', Q: '🅀', R: '🅁', S: '🅂', T: '🅃', U: '🅄', V: '🅅', W: '🅆', X: '🅇', Y: '🅈', Z: '🅉', a: '🄰', b: '🄱', c: '🄲', d: '🄳', e: '🄴', f: '🄵', g: '🄶', h: '🄷', i: '🄸', j: '🄹', k: '🄺', l: '🄻', m: '🄼', n: '🄽', o: '🄾', p: '🄿', q: '🅀', r: '🅁', s: '🅂', t: '🅃', u: '🅄', v: '🅅', w: '🅆', x: '🅇', y: '🅈', z: '🅉' },
        monospace: { A: '𝙰', B: '𝙱', C: '𝙲', D: '𝙳', E: '𝙴', F: '𝙵', G: '𝙶', H: '𝙷', I: '𝙸', J: '𝙹', K: '𝙺', L: '𝙻', M: '𝙼', N: '𝙽', O: '𝙾', P: '𝙿', Q: '𝚀', R: '𝚁', S: '𝚂', T: '𝚃', U: '𝚄', V: '𝚅', W: '𝚆', X: '𝚇', Y: '𝚈', Z: '𝚉', a: '𝚊', b: '𝚋', c: '𝚌', d: '𝚍', e: '𝚎', f: '𝚏', g: '𝚐', h: '𝚑', i: '𝚒', j: '𝚓', k: '𝚔', l: '𝚕', m: '𝚖', n: '𝚗', o: '𝚘', p: '𝚙', q: '𝚀', r: '𝚛', s: '𝚜', t: '𝚝', u: '𝚞', v: '𝚟', w: '𝚠', x: '𝚡', y: '𝚢', z: '𝚣' },
        gothic: { A: '𝔄', B: '𝔅', C: 'ℭ', D: '𝔇', E: '𝔈', F: '𝔉', G: '𝔊', H: 'ℌ', I: 'ℑ', J: '𝔍', K: '𝔎', L: '𝔏', M: '𝔐', N: '𝔑', O: '𝔒', P: '𝔓', Q: '𝔔', R: 'ℜ', S: '𝔖', T: '𝔗', U: '𝔘', V: '𝔙', W: '𝔚', X: '𝔛', Y: '𝔜', Z: 'ℨ', a: '𝔞', b: '𝔟', c: '𝔠', d: '𝔡', e: '𝔢', f: '𝔣', g: '𝔤', h: '𝔥', i: '𝔦', j: '𝔧', k: '𝔨', l: '𝔩', m: '𝔪', n: '𝔫', o: '𝔬', p: '𝔭', q: '𝔮', r: '𝔯', s: '𝔰', t: '𝔱', u: '𝔲', v: '𝔳', w: '𝔴', x: '𝔵', y: '𝔶', z: '𝔷' }
    };

    let history = [];

    function process() {
        const raw = input.value;
        if (!raw) {
            output.value = '';
            return;
        }

        const mode = modeSelect.value;
        let res = "";

        if (optDecode.checked) {
            // Decode Logic
            if (raw.includes('&#x')) {
                res = raw.replace(/&#x([0-9A-Fa-f]+);/g, (m, g) => String.fromCharCode(parseInt(g, 16)));
            } else if (raw.includes('&#')) {
                res = raw.replace(/&#([0-9]+);/g, (m, g) => String.fromCharCode(parseInt(g, 10)));
            } else if (raw.includes('\\u')) {
                res = raw.replace(/\\u([0-9A-Fa-f]{4})/g, (m, g) => String.fromCharCode(parseInt(g, 16)));
            } else {
                res = raw;
            }
        } else {
            // Encode/Transform Logic
            if (maps[mode]) {
                res = raw.split('').map(c => maps[mode][c] || c).join('');
            } else {
                res = raw.split('').map(c => {
                    const code = c.charCodeAt(0);
                    const hex = code.toString(16).toUpperCase().padStart(4, '0');
                    switch(mode) {
                        case 'hex-u': return `U+${hex}`;
                        case 'hex-x': return `\\x${hex.slice(2)}`;
                        case 'decimal': return `&#${code};`;
                        case 'html': return `&#x${hex};`;
                        default: return c;
                    }
                }).join(' ');
            }
        }

        if (optReverse.checked) res = res.split('').reverse().join('');
        
        output.value = res;
        statsText.textContent = `Glyph stream generated | Length: ${res.length} units`;
    }

    [input, modeSelect, optReverse, optDecode].forEach(el => {
        el.addEventListener('input', () => {
            if (output.value && el !== input) {
                history.push(output.value);
                btnUndo.disabled = false;
            }
            process();
        });
    });

    btnClear.addEventListener('click', () => {
        input.value = '';
        output.value = '';
        statsText.textContent = 'Glyph stream generated successfully';
        history = [];
        btnUndo.disabled = true;
    });

    btnUndo.addEventListener('click', () => {
        if (history.length > 0) {
            output.value = history.pop();
            if (history.length === 0) btnUndo.disabled = true;
        }
    });

    btnCopy.addEventListener('click', () => {
        if (!output.value) return;
        navigator.clipboard.writeText(output.value);
        const originalText = btnCopy.innerHTML;
        btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btnCopy.classList.replace('btn-success', 'btn-dark');
        setTimeout(() => {
            btnCopy.innerHTML = originalText;
            btnCopy.classList.replace('btn-dark', 'btn-success');
        }, 2000);
    });

    btnDownload.addEventListener('click', () => {
        if (!output.value) return;
        const blob = new Blob([output.value], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `unicode-export-${Date.now()}.txt`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    });

    // Initial
    input.value = "Alchemy";
    process();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\unicode-converter.blade.php ENDPATH**/ ?>