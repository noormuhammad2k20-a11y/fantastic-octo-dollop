<div class="row g-4 subnet-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label-custom">IP Address</label>
                        <input type="text" id="sub-ip" class="form-control form-control-lg rounded-3 font-monospace" value="192.168.1.100" placeholder="e.g. 10.0.0.1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">CIDR Prefix</label>
                        <select id="sub-cidr" class="form-select form-select-lg rounded-3"></select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-dark btn-lg rounded-pill w-100 fw-bold" id="sub-calc"><i class="fas fa-calculator me-2"></i>Calculate</button>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 sub-quick" data-ip="192.168.1.0" data-cidr="24">/24 Class C</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 sub-quick" data-ip="10.0.0.0" data-cidr="8">/8 Class A</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 sub-quick" data-ip="172.16.0.0" data-cidr="16">/16 Class B</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 sub-quick" data-ip="192.168.10.0" data-cidr="28">/28 Small</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="sub-output" style="--tool-color:#8b5cf6;--tool-bg:rgba(139,92,246,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Usable Hosts</span>
                <div class="output-hero-value" id="out-sub-hosts" style="font-size:3rem">254</div>
                <span class="output-hero-unit" id="out-sub-network">Network: 192.168.1.0/24</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Subnet Mask</span><span class="stat-card-value" id="out-sub-mask" style="font-size:1rem">255.255.255.0</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Wildcard</span><span class="stat-card-value" id="out-sub-wild" style="font-size:1rem">0.0.0.255</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">First Host</span><span class="stat-card-value" id="out-sub-first" style="font-size:1rem">192.168.1.1</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Last Host</span><span class="stat-card-value" id="out-sub-last" style="font-size:1rem">192.168.1.254</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>Full Breakdown</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered small mb-0">
                    <tbody id="out-sub-table"></tbody>
                </table>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="sub-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy Subnet Report</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
// Populate CIDR dropdown
const sel=$('sub-cidr');
for(let i=1;i<=32;i++){const o=document.createElement('option');o.value=i;o.textContent='/'+i+' ('+(Math.pow(2,32-i))+' IPs)';if(i===24)o.selected=true;sel.appendChild(o)}

function ipToInt(ip){return ip.split('.').reduce((a,o)=>(a<<8)+parseInt(o),0)>>>0}
function intToIp(n){return[(n>>>24)&255,(n>>>16)&255,(n>>>8)&255,n&255].join('.')}
function intToBin(n){return[(n>>>24)&255,(n>>>16)&255,(n>>>8)&255,n&255].map(b=>b.toString(2).padStart(8,'0')).join('.')}

function calc(){
    const ipStr=$('sub-ip').value.trim(),cidr=parseInt(sel.value);
    const parts=ipStr.split('.');
    if(parts.length!==4||parts.some(p=>isNaN(p)||p<0||p>255)){$('out-sub-hosts').textContent='Invalid IP';return}

    const ip=ipToInt(ipStr);
    const mask=cidr===0?0:(0xFFFFFFFF<<(32-cidr))>>>0;
    const wildcard=(~mask)>>>0;
    const network=(ip&mask)>>>0;
    const broadcast=(network|wildcard)>>>0;
    const firstHost=cidr>=31?network:(network+1)>>>0;
    const lastHost=cidr>=31?broadcast:(broadcast-1)>>>0;
    const totalHosts=Math.pow(2,32-cidr);
    const usableHosts=cidr>=31?totalHosts:Math.max(totalHosts-2,0);

    // Class
    const fb=(ip>>>24)&255;
    let cls='N/A';
    if(fb<128)cls='A';else if(fb<192)cls='B';else if(fb<224)cls='C';else if(fb<240)cls='D (Multicast)';else cls='E (Reserved)';

    // Private?
    let priv=false;
    if(fb===10)priv=true;
    else if(fb===172&&((ip>>>16)&255)>=16&&((ip>>>16)&255)<=31)priv=true;
    else if(fb===192&&((ip>>>16)&255)===168)priv=true;

    $('out-sub-hosts').textContent=usableHosts.toLocaleString();
    $('out-sub-network').textContent='Network: '+intToIp(network)+'/'+cidr;
    $('out-sub-mask').textContent=intToIp(mask);
    $('out-sub-wild').textContent=intToIp(wildcard);
    $('out-sub-first').textContent=intToIp(firstHost);
    $('out-sub-last').textContent=intToIp(lastHost);

    $('out-sub-table').innerHTML=[
        ['IP Address',ipStr],['Network Address',intToIp(network)],['Broadcast Address',intToIp(broadcast)],
        ['Subnet Mask',intToIp(mask)],['Wildcard Mask',intToIp(wildcard)],
        ['First Usable',intToIp(firstHost)],['Last Usable',intToIp(lastHost)],
        ['Total IPs',totalHosts.toLocaleString()],['Usable Hosts',usableHosts.toLocaleString()],
        ['CIDR Notation','/'+cidr],['IP Class',cls],['Private',priv?'Yes (RFC 1918)':'No (Public)'],
        ['Binary Mask',intToBin(mask)],['Binary IP',intToBin(ip)]
    ].map(r=>`<tr><td class="fw-bold text-start" style="width:40%">${r[0]}</td><td class="font-monospace text-start" style="word-break:break-all">${r[1]}</td></tr>`).join('');
}

$('sub-ip').addEventListener('input',calc);sel.addEventListener('change',calc);$('sub-calc').addEventListener('click',calc);
document.querySelectorAll('.sub-quick').forEach(b=>{b.addEventListener('click',()=>{$('sub-ip').value=b.dataset.ip;sel.value=b.dataset.cidr;calc()})});
$('sub-copy').addEventListener('click',function(){
    const rows=document.querySelectorAll('#out-sub-table tr');
    let t='IP Subnet Report\n';rows.forEach(r=>{const c=r.querySelectorAll('td');t+=c[0].textContent+': '+c[1].textContent+'\n'});t+='— ToolsHub';
    navigator.clipboard.writeText(t).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
calc();
});
</script>
<style>
.subnet-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.subnet-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.subnet-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.subnet-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.subnet-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.subnet-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
