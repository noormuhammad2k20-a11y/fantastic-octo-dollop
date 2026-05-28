<?php
/**
 * Script to generate the remaining 24 scientific calculator blade files
 * Run with: php scripts/gen_science_tools.php
 */

$toolsDir = __DIR__ . '/../resources/views/tools/interactive/';

$tools = [
    // ===== Tool 3: Ideal Gas Law Calculator =====
    'ideal-gas-law-calculator' => [
        'icon' => 'fas fa-wind',
        'iconBg' => 'bg-primary-soft',
        'iconColor' => 'text-primary',
        'h5' => 'Ideal Gas Law Calculator',
        'subtitle' => 'Solve PV = nRT for any variable with unit conversion',
        'btnColor' => 'btn-primary',
        'btnIcon' => 'fas fa-calculator',
        'btnText' => 'Calculate',
        'formulaText' => '<strong>Formula:</strong> PV = nRT where R = 0.08206 L·atm/(mol·K)',
        'quickSection' => '<div class="p-3 rounded-4 mb-4" style="background-color:#f8fafc;border:1.5px solid #e2e8f0">
                <h6 class="text-muted fw-bold small text-uppercase mb-3 letter-spacing-1"><i class="fas fa-bolt text-warning me-2"></i>Quick Presets</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-preset" data-p="1" data-v="22.414" data-n="1" data-t="273.15">STP (1 mol)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-preset" data-p="1" data-v="24.79" data-n="1" data-t="298.15">Room Temp (25°C)</button>
                    <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-3 quick-preset" data-p="1" data-v="44.83" data-n="2" data-t="273.15">2 mol at STP</button>
                </div>
            </div>',
        'inputFields' => '<div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Solve For</h6>
                        <select id="igl-solve" class="form-select form-select-lg rounded-3">
                            <option value="p">Pressure (P)</option>
                            <option value="v">Volume (V)</option>
                            <option value="n">Moles (n)</option>
                            <option value="t">Temperature (T)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-4 h-100" style="background:#fff;border:1.5px solid #f1f5f9">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Conditions</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Temp Unit</label>
                                <select id="igl-tunit" class="form-select form-select-lg rounded-3">
                                    <option value="K">Kelvin (K)</option>
                                    <option value="C">Celsius (°C)</option>
                                    <option value="F">Fahrenheit (°F)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Press Unit</label>
                                <select id="igl-punit" class="form-select form-select-lg rounded-3">
                                    <option value="atm">atm</option>
                                    <option value="Pa">Pa</option>
                                    <option value="mmHg">mmHg</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Pressure</label>
                    <input type="number" id="igl-p" class="form-control form-control-lg rounded-3" value="1" step="0.01">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Volume (L)</label>
                    <input type="number" id="igl-v" class="form-control form-control-lg rounded-3" value="22.414" step="0.01">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Moles (n)</label>
                    <input type="number" id="igl-n" class="form-control form-control-lg rounded-3" value="1" step="0.01">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Temperature</label>
                    <input type="number" id="igl-t" class="form-control form-control-lg rounded-3" value="273.15" step="0.01">
                </div>
            </div>',
        'script' => "
document.addEventListener('DOMContentLoaded',function(){
    const R=0.08206;
    function toK(v,u){if(u==='C')return v+273.15;if(u==='F')return(v-32)*5/9+273.15;return v;}
    function toAtm(v,u){if(u==='Pa')return v/101325;if(u==='mmHg')return v/760;return v;}
    function calculate(){
        const solve=document.getElementById('igl-solve').value;
        const tUnit=document.getElementById('igl-tunit').value;
        const pUnit=document.getElementById('igl-punit').value;
        let p=parseFloat(document.getElementById('igl-p').value)||0;
        let v=parseFloat(document.getElementById('igl-v').value)||0;
        let n=parseFloat(document.getElementById('igl-n').value)||0;
        let t=parseFloat(document.getElementById('igl-t').value)||0;
        const tK=toK(t,tUnit);const pAtm=toAtm(p,pUnit);
        let result,label,unit;
        if(solve==='p'){result=n*R*tK/v;label='Pressure';unit='atm';}
        else if(solve==='v'){result=n*R*tK/pAtm;label='Volume';unit='L';}
        else if(solve==='n'){result=pAtm*v/(R*tK);label='Moles';unit='mol';}
        else{result=pAtm*v/(n*R);label='Temperature';unit='K';}
        document.getElementById('out-main').textContent=result.toFixed(4);
        document.getElementById('out-label').textContent=label+' ('+unit+')';
        document.getElementById('out-s1').textContent=pAtm.toFixed(4)+' atm';
        document.getElementById('out-s2').textContent=v.toFixed(4)+' L';
        document.getElementById('out-s3').textContent=n.toFixed(4)+' mol';
        document.getElementById('out-s4').textContent=tK.toFixed(2)+' K';
        const ins=[];
        ins.push('Using R = 0.08206 L·atm/(mol·K)');
        ins.push('PV = nRT → '+pAtm.toFixed(3)+'×'+v.toFixed(3)+' = '+n.toFixed(3)+'×0.08206×'+tK.toFixed(2));
        if(tK<0) ins.push('⚠ Temperature below absolute zero is physically impossible.');
        document.getElementById('out-insights').innerHTML='<ul class=\"list-unstyled mb-0\">'+ins.map(i=>'<li class=\"mb-2\"><i class=\"fas fa-check-circle text-success me-2\"></i>'+i+'</li>').join('')+'</ul>';
        document.getElementById('result-card').classList.remove('d-none');
        document.getElementById('result-card').scrollIntoView({behavior:'smooth'});
    }
    document.getElementById('btn-calculate').addEventListener('click',calculate);
    document.querySelectorAll('.quick-preset').forEach(b=>b.addEventListener('click',()=>{
        document.getElementById('igl-p').value=b.dataset.p;document.getElementById('igl-v').value=b.dataset.v;
        document.getElementById('igl-n').value=b.dataset.n;document.getElementById('igl-t').value=b.dataset.t;calculate();
    }));
    document.getElementById('btn-reset').addEventListener('click',()=>{document.getElementById('igl-p').value=1;document.getElementById('igl-v').value=22.414;document.getElementById('igl-n').value=1;document.getElementById('igl-t').value=273.15;document.getElementById('result-card').classList.add('d-none');});
    document.getElementById('btn-copy').addEventListener('click',function(){const t='Ideal Gas Law Result\\n'+document.getElementById('out-label').textContent+': '+document.getElementById('out-main').textContent+'\\n— ToolsHub';navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class=\"fas fa-check me-1\"></i> Copied!';this.classList.replace('btn-success','btn-dark');setTimeout(()=>{this.innerHTML=o;this.classList.replace('btn-dark','btn-success');},2000);});});
});",
        'outputCards' => '<div class="row g-4 align-items-center mb-4">
                <div class="col-lg-5 text-center border-end">
                    <div class="display-4 fw-bold text-dark mb-0" id="out-main">0.000</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1" id="out-label">Result</p>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Pressure</div><div class="h5 fw-bold mb-0 text-primary" id="out-s1">—</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Volume</div><div class="h5 fw-bold mb-0 text-info" id="out-s2">—</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Moles</div><div class="h5 fw-bold mb-0 text-success" id="out-s3">—</div></div></div>
                        <div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Temperature</div><div class="h5 fw-bold mb-0 text-warning" id="out-s4">—</div></div></div>
                    </div>
                </div>
            </div>',
    ],
];

// Template function
function generateBlade($config) {
    $q = $config['quickSection'] ?? '';
    $inp = $config['inputFields'];
    $out = $config['outputCards'];
    $sc = $config['script'];
    $ft = $config['formulaText'];

    return <<<BLADE
<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 {$config['iconBg']}"><i class="{$config['icon']} {$config['iconColor']}"></i></div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">{$config['h5']}</h5>
                        <p class="text-muted small mb-0">{$config['subtitle']}</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-light-v2 btn-sm rounded-pill px-3" id="btn-reset" style="min-width:140px;max-width:100%"><i class="fas fa-undo me-1"></i> Reset</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 px-4 pb-4">
            $q
            $inp
            <div class="mt-4 text-center">
                <button class="{$config['btnColor']} btn btn-lg rounded-pill px-5 shadow-sm" id="btn-calculate" style="min-width:280px;max-width:100%">
                    <i class="{$config['btnIcon']} me-2"></i> {$config['btnText']}
                </button>
            </div>
            <div class="mt-4 p-3 rounded-4 border" style="background:#f8fafc">
                <p class="mb-0 small text-muted"><i class="fas fa-info-circle text-primary me-2"></i>$ft</p>
            </div>
        </div>
    </div>
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft"><i class="fas fa-check-circle text-success"></i></div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Calculation Result</h5>
                        <p class="text-muted small mb-0">Detailed analysis and breakdown</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width:140px;max-width:100%"><i class="fas fa-copy me-1"></i> Copy</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 px-4 pb-4">
            $out
            <div class="p-4 rounded-4 bg-light border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1"><i class="fas fa-lightbulb text-warning me-2"></i>Insights</h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>
        </div>
    </div>
</div>
<style>
:root{--primary-color:#4f46e5;--primary-soft:#eef2ff;--success-soft:#ecfdf5;--danger-soft:#fef2f2;--border-color:#e2e8f0}
.bg-primary-soft{background-color:var(--primary-soft)}.bg-success-soft{background-color:var(--success-soft)}.bg-danger-soft{background-color:var(--danger-soft)}
.tool-card-stacked{border-radius:24px;background:#fff;word-break:break-word;overflow-wrap:break-word}
.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}
.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}
.form-control-lg,.form-select-lg{border:1.5px solid var(--border-color);border-radius:12px;font-size:1.05rem;padding:.75rem 1rem}
.form-control:focus,.form-select:focus{border-color:var(--primary-color);box-shadow:0 0 0 4px rgba(79,70,229,.1);outline:none}
.letter-spacing-1{letter-spacing:1px}.x-small{font-size:.75rem}.card-body-v2{overflow-x:auto}
</style>
<script>$sc</script>
BLADE;
}

// Generate ideal-gas-law-calculator
$content = generateBlade($tools['ideal-gas-law-calculator']);
file_put_contents($toolsDir . 'ideal-gas-law-calculator.blade.php', $content);
echo "Generated: ideal-gas-law-calculator\n";

echo "\nDone generating from template. Remaining tools will be generated individually.\n";
