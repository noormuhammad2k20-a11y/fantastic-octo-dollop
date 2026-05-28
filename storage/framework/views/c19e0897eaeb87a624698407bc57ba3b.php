<div class="row g-4 ascii-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #0f172a; box-shadow: 0 4px 30px rgba(56, 189, 248, .1);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm terminal-glow" style="background: linear-gradient(135deg, #0ea5e9, #0284c7); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-font"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#f8fafc; letter-spacing: -0.5px;">ASCII Matrix Reference</h4>
                    <p class="text-slate-400 small mb-0">High-speed character encoding lookup. Decipher Decimal, Hex, and Binary streams instantly.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-slate-900 border border-slate-800 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-500">Fast Character Lookup</h6>
                            <div class="input-group input-group-lg bg-slate-800 rounded-4 overflow-hidden border border-slate-700 mb-4">
                                <span class="input-group-text border-0 ps-3 bg-transparent text-sky-400"><i class="fas fa-search"></i></span>
                                <input type="text" id="ascii-search" class="form-control border-0 bg-transparent text-white fw-bold" placeholder="Type a character or decimal code...">
                            </div>
                            
                            <div id="ascii-detail" class="p-4 rounded-4 bg-slate-950 border border-sky-500/30 text-center shadow-lg">
                                <div class="display-1 fw-900 text-sky-400 mb-2" id="det-char">A</div>
                                <div class="badge bg-sky-500 text-white px-3 py-1 rounded-pill mb-4" id="det-name">Uppercase A</div>
                                <div class="row g-2">
                                    <div class="col-4"><div class="p-2 rounded bg-slate-900 border border-slate-800"><div class="small text-slate-500">DEC</div><div class="fw-bold text-white" id="det-dec">65</div></div></div>
                                    <div class="col-4"><div class="p-2 rounded bg-slate-900 border border-slate-800"><div class="small text-slate-500">HEX</div><div class="fw-bold text-white" id="det-hex">0x41</div></div></div>
                                    <div class="col-4"><div class="p-2 rounded bg-slate-900 border border-slate-800"><div class="small text-slate-500">BIN</div><div class="fw-bold text-white" id="det-bin" style="font-size: 0.7rem;">01000001</div></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-slate-900 border-slate-800">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-500">Grid Context</h6>
                            <div class="vstack gap-3">
                                <div class="p-3 rounded-4 bg-slate-800 border border-slate-700">
                                    <label class="form-label-custom text-slate-400">View Range</label>
                                    <select id="ascii-range" class="form-select border-0 bg-slate-900 text-white fw-bold rounded-3">
                                        <option value="all">Full Table (0-127)</option>
                                        <option value="control">Control Characters (0-31)</option>
                                        <option value="printable">Printable (32-126)</option>
                                        <option value="ext">Extended (128-255)</option>
                                    </select>
                                </div>
                                <div class="p-3 rounded-4 bg-slate-800 border border-slate-700">
                                    <h6 class="small fw-bold text-slate-400 mb-3">Quick Navigation</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-slate-950 btn-sm text-sky-400 fw-bold border border-slate-700 quick-go" data-v="0">NULL</button>
                                        <button class="btn btn-slate-950 btn-sm text-sky-400 fw-bold border border-slate-700 quick-go" data-v="32">SPACE</button>
                                        <button class="btn btn-slate-950 btn-sm text-sky-400 fw-bold border border-slate-700 quick-go" data-v="48">0-9</button>
                                        <button class="btn btn-slate-950 btn-sm text-sky-400 fw-bold border border-slate-700 quick-go" data-v="65">A-Z</button>
                                        <button class="btn btn-slate-950 btn-sm text-sky-400 fw-bold border border-slate-700 quick-go" data-v="97">a-z</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 195; --tool-color: #0ea5e9; --tool-bg: rgba(14, 165, 233, .04);">
            <div class="p-4 bg-white border-top rounded-bottom-5">
                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-hover align-middle font-monospace mb-0" id="ascii-table">
                        <thead class="sticky-top bg-white shadow-sm">
                            <tr>
                                <th class="text-slate-400 small">DEC</th>
                                <th class="text-slate-400 small">HEX</th>
                                <th class="text-slate-400 small">BIN</th>
                                <th class="text-slate-400 small">CHR</th>
                                <th class="text-slate-400 small">NAME</th>
                            </tr>
                        </thead>
                        <tbody id="ascii-body">
                            
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 pt-4 border-top d-flex justify-content-between align-items-center">
                    <button class="btn btn-sky px-4 py-2 rounded-4 fw-bold text-white shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i>Copy Selection
                    </button>
                    <div class="small text-muted">Total Characters: <span id="out-count">128</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const body = $('ascii-body'), search = $('ascii-search'), range = $('ascii-range');
    
    const asciiData = [];
    const controlNames = ["NUL", "SOH", "STX", "ETX", "EOT", "ENQ", "ACK", "BEL", "BS", "TAB", "LF", "VT", "FF", "CR", "SO", "SI", "DLE", "DC1", "DC2", "DC3", "DC4", "NAK", "SYN", "ETB", "CAN", "EM", "SUB", "ESC", "FS", "GS", "RS", "US"];
    controlNames[32] = "SPACE";

    for(let i=0; i<256; i++){
        let chr = String.fromCharCode(i);
        let name = "Printable";
        if(i < 32) name = controlNames[i];
        else if(i === 32) name = "Space";
        else if(i === 127) name = "Delete";
        else if(i > 127) name = "Extended ASCII";
        
        asciiData.push({
            dec: i,
            hex: '0x' + i.toString(16).toUpperCase().padStart(2, '0'),
            bin: i.toString(2).padStart(8, '0'),
            chr: i < 32 || i === 127 ? '·' : chr,
            name: name
        });
    }

    function render(filter = ''){
        const r = range.value;
        let data = asciiData;
        
        if(r === 'control') data = asciiData.slice(0, 32);
        else if(r === 'printable') data = asciiData.slice(32, 127);
        else if(r === 'ext') data = asciiData.slice(128);
        else if(r === 'all') data = asciiData.slice(0, 128);

        if(filter){
            data = data.filter(i => 
                i.dec.toString().includes(filter) || 
                i.hex.toLowerCase().includes(filter.toLowerCase()) || 
                i.name.toLowerCase().includes(filter.toLowerCase()) ||
                (filter.length === 1 && String.fromCharCode(i.dec) === filter)
            );
        }

        body.innerHTML = data.map(i => `
            <tr style="cursor: pointer;" onclick="window.asciiSelect(${i.dec})">
                <td class="fw-bold text-slate-600">${i.dec}</td>
                <td class="text-sky-600">${i.hex}</td>
                <td class="text-slate-400 small">${i.bin}</td>
                <td class="h5 fw-bold text-slate-800">${i.chr}</td>
                <td class="small text-slate-500">${i.name}</td>
            </tr>
        `).join('');
        $('out-count').textContent = data.length;
    }

    window.asciiSelect = function(dec){
        const item = asciiData[dec];
        $('det-char').textContent = item.chr === '·' ? '?' : item.chr;
        $('det-name').textContent = item.name;
        $('det-dec').textContent = item.dec;
        $('det-hex').textContent = item.hex;
        $('det-bin').textContent = item.bin;
        
        // Glow effect
        $('ascii-detail').style.borderColor = '#0ea5e9';
        setTimeout(() => $('ascii-detail').style.borderColor = 'rgba(14, 165, 233, 0.3)', 300);
    };

    search.addEventListener('input', e => render(e.target.value));
    range.addEventListener('change', () => render());
    
    document.querySelectorAll('.quick-go').forEach(btn => {
        btn.addEventListener('click', () => {
            window.asciiSelect(parseInt(btn.dataset.v));
            search.value = '';
            render();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `ASCII Entry: ${$('det-name').textContent} (DEC: ${$('det-dec').textContent}, HEX: ${$('det-hex').textContent})\nGenerated by ToolsHub ASCII Matrix`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    render();
    window.asciiSelect(65); // Initial select 'A'
});
</script>

<style>
.ascii-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#94a3b8;opacity:.7;margin-bottom:8px;display:block}
.ascii-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-sky { background: #0ea5e9; color: #fff; transition: all .3s; }
.btn-sky:hover { background: #0284c7; color: #fff; transform: translateY(-2px); }
.text-sky-400 { color: #38bdf8; }
.text-sky-600 { color: #0284c7; }
.text-slate-400 { color: #94a3b8; }
.text-slate-500 { color: #64748b; }
.bg-slate-900 { background-color: #0f172a; }
.bg-slate-950 { background-color: #020617; }
.fw-900 { font-weight: 900; }
.terminal-glow { box-shadow: 0 0 15px rgba(14, 165, 233, 0.3); }
#ascii-table thead th { border-bottom: 2px solid #f1f5f9; }
#ascii-body tr:hover { background: rgba(14, 165, 233, 0.05); }
.font-monospace { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ascii-table-look-up.blade.php ENDPATH**/ ?>