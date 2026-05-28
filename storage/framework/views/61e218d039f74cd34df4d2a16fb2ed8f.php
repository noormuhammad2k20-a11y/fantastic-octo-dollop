<div class="row g-4 mac-analyzer-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label-custom">MAC Address</label>
                        <input type="text" id="mac-input" class="form-control form-control-lg rounded-3 font-monospace" value="00:1A:2B:3C:4D:5E" placeholder="e.g. AA:BB:CC:11:22:33" maxlength="17" style="letter-spacing:1px">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-dark btn-lg rounded-pill w-100 fw-bold" id="mac-analyze"><i class="fas fa-search me-2"></i>Analyze</button>
                    </div>
                </div>
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Quick:</span>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 mac-quick" data-mac="00:1A:2B:3C:4D:5E">Intel NIC</button>
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 mac-quick" data-mac="F8:FF:C2:11:22:33">Apple Device</button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 mac-quick" data-mac="00:50:56:AA:BB:CC">VMware VM</button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 mac-quick" data-mac="B8:27:EB:01:02:03">Raspberry Pi</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 mac-quick" data-mac="FF:FF:FF:FF:FF:FF">Broadcast</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="mac-output-card" style="--tool-hue:220;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Manufacturer (OUI)</span>
                <div class="output-hero-value" id="out-mac-vendor" style="font-size:2rem;word-break:break-word">Intel Corporation</div>
                <span class="output-hero-unit" id="out-mac-oui">OUI: 00:1A:2B</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Type</span><span class="stat-card-value" id="out-mac-type">Unicast</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Scope</span><span class="stat-card-value" id="out-mac-scope">Global</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Format</span><span class="stat-card-value" id="out-mac-format">Colon</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Valid</span><span class="stat-card-value" id="out-mac-valid">✅ Yes</span></div></div>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>Format Variants</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center small mb-0">
                    <thead class="table-light"><tr><th>Format</th><th>Value</th></tr></thead>
                    <tbody id="out-mac-formats"></tbody>
                </table>
            </div>

            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-microchip me-2 text-primary"></i>Binary Representation</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <code id="out-mac-binary" class="small" style="word-break:break-all;overflow-wrap:break-word">00000000.00011010.00101011.00111100.01001101.01011110</code>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="mac-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy MAC Report</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const inp=$('mac-input');

    // OUI database (common vendors)
    const ouiDb={
        '00:1A:2B':'Intel Corporation','F8:FF:C2':'Apple, Inc.','00:50:56':'VMware, Inc.',
        'B8:27:EB':'Raspberry Pi Foundation','00:0C:29':'VMware, Inc.','AC:DE:48':'Microsoft Corporation',
        '00:1B:44':'SanDisk Corporation','3C:5A:B4':'Google, Inc.','DC:A6:32':'Raspberry Pi Trading Ltd',
        '00:1C:42':'Parallels, Inc.','08:00:27':'PCS Systemtechnik GmbH (VirtualBox)',
        '00:15:5D':'Microsoft Corporation (Hyper-V)','00:25:90':'Super Micro Computer',
        '00:1A:A0':'Dell Inc.','D4:BE:D9':'Dell Inc.','70:10:6F':'HP Inc.',
        '00:50:43':'Marvell Technology','00:E0:4C':'Realtek Semiconductor',
        '48:2C:6A':'Cisco Systems','00:1B:21':'Intel Corporate','3C:22:FB':'Apple, Inc.',
        'A4:83:E7':'Apple, Inc.','00:16:3E':'Xen','52:54:00':'QEMU/KVM',
        'FF:FF:FF':'Broadcast Address','00:00:00':'Xerox Corporation'
    };

    function normalize(mac){
        return mac.replace(/[^0-9a-fA-F]/g,'').toUpperCase();
    }

    function analyze(){
        let raw=inp.value.trim();
        let hex=normalize(raw);
        if(hex.length!==12){
            $('out-mac-vendor').textContent='Invalid MAC Address';
            $('out-mac-vendor').style.color='#ef4444';
            $('out-mac-oui').textContent='Please enter a valid 48-bit MAC';
            $('out-mac-valid').textContent='❌ No';
            $('out-mac-type').textContent='—';
            $('out-mac-scope').textContent='—';
            $('out-mac-format').textContent='—';
            $('out-mac-formats').innerHTML='';
            $('out-mac-binary').textContent='—';
            return;
        }

        // Format
        const colon=hex.match(/.{2}/g).join(':');
        const dash=hex.match(/.{2}/g).join('-');
        const dot=hex.match(/.{4}/g).join('.');
        const bare=hex;

        // OUI
        const oui=colon.substring(0,8);
        const vendor=ouiDb[oui]||'Unknown Manufacturer';

        // Flags (first octet)
        const firstByte=parseInt(hex.substring(0,2),16);
        const isMulticast=(firstByte&1)===1;
        const isLocal=(firstByte&2)===2;

        // Detect input format
        let fmt='Bare';
        if(raw.includes(':'))fmt='Colon (IEEE)';
        else if(raw.includes('-'))fmt='Dash (Microsoft)';
        else if(raw.includes('.'))fmt='Dot (Cisco)';

        // Binary
        const binary=hex.match(/.{2}/g).map(b=>parseInt(b,16).toString(2).padStart(8,'0')).join('.');

        // Update UI
        $('out-mac-vendor').textContent=vendor;
        $('out-mac-vendor').style.color='#3b82f6';
        $('out-mac-oui').textContent='OUI: '+oui;
        $('out-mac-type').textContent=isMulticast?'Multicast':'Unicast';
        $('out-mac-scope').textContent=isLocal?'Local':'Global (UAA)';
        $('out-mac-format').textContent=fmt.split(' ')[0];
        $('out-mac-valid').textContent='✅ Yes';
        $('out-mac-binary').textContent=binary;

        // Formats table
        $('out-mac-formats').innerHTML=[
            ['Colon (IEEE 802)',colon],['Dash (Microsoft)',dash],
            ['Dot (Cisco)',dot],['Bare Hex',bare],
            ['Lowercase',colon.toLowerCase()]
        ].map(r=>`<tr><td class="fw-bold text-start">${r[0]}</td><td class="font-monospace text-start" style="word-break:break-all">${r[1]}</td></tr>`).join('');
    }

    inp.addEventListener('input',analyze);
    $('mac-analyze').addEventListener('click',analyze);
    document.querySelectorAll('.mac-quick').forEach(btn=>{
        btn.addEventListener('click',()=>{inp.value=btn.dataset.mac;analyze()});
    });
    $('mac-copy').addEventListener('click',function(){
        const text=`MAC Address Report\nAddress: ${inp.value}\nVendor: ${$('out-mac-vendor').textContent}\nOUI: ${$('out-mac-oui').textContent}\nType: ${$('out-mac-type').textContent}\nScope: ${$('out-mac-scope').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(text).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2000)});
    });
    analyze();
});
</script>
<style>
.mac-analyzer-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.mac-analyzer-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.mac-analyzer-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.mac-analyzer-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.mac-analyzer-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.mac-analyzer-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mac-address-analyzer.blade.php ENDPATH**/ ?>