<div class="interactive-wrapper">
<div class="card tool-card-stacked mb-4 shadow-sm border-0">

<div class="card-body px-4 pb-4" style="overflow-x:auto">
<div class="p-3 rounded-4 mb-4" style="background:#f8fafc;border:1.5px solid #e2e8f0">
<h6 class="text-muted fw-bold small text-uppercase mb-3" style="letter-spacing:1px"><i class="fas fa-bolt text-warning me-2"></i>Quick Values</h6>
<div class="d-flex flex-wrap gap-2">
<button class="btn btn-outline-dark btn-sm rounded-pill px-3 qp" data-v="0.1" data-m="hplus">0.1M HCl</button>
<button class="btn btn-outline-dark btn-sm rounded-pill px-3 qp" data-v="7" data-m="ph">Pure Water</button>
<button class="btn btn-outline-dark btn-sm rounded-pill px-3 qp" data-v="0.001" data-m="ohmin">0.001M OH⁻</button>
</div></div>
<div class="row g-3">
<div class="col-md-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Input Mode</label>
<select id="ph-mode" class="form-select form-select-lg rounded-3" style="border:1.5px solid #e2e8f0"><option value="hplus">[H⁺] mol/L</option><option value="ohmin">[OH⁻] mol/L</option><option value="ph">pH Value</option><option value="poh">pOH Value</option></select></div>
<div class="col-md-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Value</label>
<input type="number" id="ph-val" class="form-control form-control-lg rounded-3" value="0.0001" step="any" style="border:1.5px solid #e2e8f0"></div>
<div class="col-md-6"><label class="form-label small fw-bold text-secondary text-uppercase mb-2">Temperature</label>
<div class="input-group"><input type="number" id="ph-temp" class="form-control form-control-lg" value="25" style="border:1.5px solid #e2e8f0">
<select id="ph-tu" class="form-select" style="max-width:80px;border:1.5px solid #e2e8f0"><option value="C">°C</option><option value="K">K</option><option value="F">°F</option></select></div></div>
</div>
<div class="mt-4 text-center"><button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm" id="btn-calc" style="min-width:260px;max-width:100%"><i class="fas fa-calculator me-2"></i>Calculate pH</button></div>
<div class="mt-3 p-3 rounded-4 border" style="background:#f8fafc"><p class="mb-0 small text-muted"><i class="fas fa-info-circle text-primary me-2"></i><b>Formula:</b> pH = −log₁₀[H⁺] | pOH = −log₁₀[OH⁻] | pH + pOH = 14</p></div>
</div></div>
<div id="res" class="card shadow-sm border-0 d-none" style="border-radius:24px;background:#fff;word-break:break-word">
<div class="card-header bg-white border-bottom-0 py-4 px-4">
<div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
<div class="d-flex align-items-center"><div class="icon-box me-3" style="background:#ecfdf5"><i class="fas fa-check-circle text-success"></i></div>
<div><h5 class="mb-0 fw-bold text-dark">pH Analysis</h5><p class="text-muted small mb-0">Complete acid-base breakdown</p></div></div>
<button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width:120px"><i class="fas fa-copy me-1"></i>Copy</button>
</div></div>
<div class="card-body px-4 pb-4" style="overflow-x:auto">
<div class="row g-3 mb-4">
<div class="col-lg-5 text-center border-end"><div class="display-3 fw-bold text-dark" id="o-ph">7.00</div><p class="text-muted fw-bold text-uppercase small mb-1">pH Value</p><span class="badge rounded-pill px-4 py-2 fw-bold bg-success" id="o-nat">NEUTRAL</span></div>
<div class="col-lg-7"><div class="row g-3">
<div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">pOH</div><div class="h5 fw-bold mb-0 text-primary" id="o-poh">7.00</div></div></div>
<div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">[H⁺]</div><div class="h5 fw-bold mb-0 text-danger" id="o-hp">1.0e-7</div></div></div>
<div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">[OH⁻]</div><div class="h5 fw-bold mb-0 text-info" id="o-oh">1.0e-7</div></div></div>
<div class="col-6"><div class="p-3 rounded-4 bg-light border text-center"><div class="small fw-bold text-uppercase text-muted mb-1">Nature</div><div class="h5 fw-bold mb-0" id="o-str">Neutral</div></div></div>
</div></div></div>
<div class="p-4 rounded-4 bg-light border shadow-sm"><h6 class="fw-bold mb-3 small text-uppercase text-muted" style="letter-spacing:1px"><i class="fas fa-lightbulb text-warning me-2"></i>Insights</h6><div id="o-ins" class="small text-secondary"></div></div>
</div></div></div>
<style>.tool-card-stacked{border-radius:24px;background:#fff;word-break:break-word}.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
function sc(v){return v.toExponential(2);}
function calc(){var m=document.getElementById('ph-mode').value,v=parseFloat(document.getElementById('ph-val').value),ph,poh,hp,oh;
if(isNaN(v))return;
if(m==='hplus'){hp=v;ph=-Math.log10(hp);poh=14-ph;oh=Math.pow(10,-poh);}
else if(m==='ohmin'){oh=v;poh=-Math.log10(oh);ph=14-poh;hp=Math.pow(10,-ph);}
else if(m==='ph'){ph=v;poh=14-ph;hp=Math.pow(10,-ph);oh=Math.pow(10,-poh);}
else{poh=v;ph=14-poh;hp=Math.pow(10,-ph);oh=Math.pow(10,-poh);}
document.getElementById('o-ph').textContent=ph.toFixed(2);
document.getElementById('o-poh').textContent=poh.toFixed(2);
document.getElementById('o-hp').textContent=sc(hp);
document.getElementById('o-oh').textContent=sc(oh);
var n=document.getElementById('o-nat'),s=document.getElementById('o-str');
if(ph<6.5){n.textContent='ACIDIC';n.className='badge rounded-pill px-4 py-2 fw-bold bg-danger';s.textContent='Acidic';}
else if(ph>7.5){n.textContent='BASIC';n.className='badge rounded-pill px-4 py-2 fw-bold bg-primary';s.textContent='Alkaline';}
else{n.textContent='NEUTRAL';n.className='badge rounded-pill px-4 py-2 fw-bold bg-success';s.textContent='Neutral';}
var ins=[];ins.push('pH = −log₁₀[H⁺] = <b>'+ph.toFixed(4)+'</b>');ins.push('pOH = 14 − pH = <b>'+poh.toFixed(4)+'</b>');
if(ph<2)ins.push('⚠ Strong acid — handle with caution.');else if(ph>12)ins.push('⚠ Strong base — caustic.');
document.getElementById('o-ins').innerHTML='<ul class="list-unstyled mb-0">'+ins.map(function(i){return'<li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>'+i+'</li>';}).join('')+'</ul>';
document.getElementById('res').classList.remove('d-none');document.getElementById('res').scrollIntoView({behavior:'smooth'});}
document.getElementById('btn-calc').addEventListener('click',calc);
document.querySelectorAll('.qp').forEach(function(b){b.addEventListener('click',function(){document.getElementById('ph-mode').value=b.dataset.m;document.getElementById('ph-val').value=b.dataset.v;calc();});});
document.getElementById('btn-reset').addEventListener('click',function(){document.getElementById('ph-val').value='0.0001';document.getElementById('ph-mode').value='hplus';document.getElementById('res').classList.add('d-none');});
document.getElementById('btn-copy').addEventListener('click',function(){var t='pH: '+document.getElementById('o-ph').textContent+'\npOH: '+document.getElementById('o-poh').textContent+'\n— ToolsHub';navigator.clipboard.writeText(t).then(function(){var b=document.getElementById('btn-copy'),o=b.innerHTML;b.innerHTML='<i class="fas fa-check me-1"></i>Copied!';setTimeout(function(){b.innerHTML=o;},2000);});});
});
</script>
