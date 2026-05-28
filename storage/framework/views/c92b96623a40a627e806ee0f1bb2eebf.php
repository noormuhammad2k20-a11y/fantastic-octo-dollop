<div class="row g-4 chrono-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(30, 58, 138, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #1E3A8A, #3B82F6); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-globe-americas"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e3a8a; letter-spacing: -0.5px;">Global Chrono Mapper</h4>
                    <p class="text-muted small mb-0">Synchronize across 400+ timezones with precision offset analysis and Daylight Saving Time (DST) detection.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Origin Temporal Node</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Anchor Time & Date</label>
                                <input type="datetime-local" id="v-time" class="form-control border-0 bg-white shadow-sm rounded-3 fw-bold h4 mb-0">
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Source Timezone</label>
                                <select id="v-tz-from" class="form-select border-0 bg-white shadow-sm rounded-3 fw-bold">
                                    <option value="UTC">UTC (Universal Time)</option>
                                    <option value="America/New_York">New York (EST/EDT)</option>
                                    <option value="America/Los_Angeles">Los Angeles (PST/PDT)</option>
                                    <option value="Europe/London">London (GMT/BST)</option>
                                    <option value="Europe/Paris">Paris (CET/CEST)</option>
                                    <option value="Asia/Tokyo">Tokyo (JST)</option>
                                    <option value="Asia/Kolkata" selected>Mumbai/Kolkata (IST)</option>
                                    <option value="Australia/Sydney">Sydney (AEST/AEDT)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-blue">
                            <h6 class="fw-bold small mb-3 uppercase text-blue opacity-70">Destination Node</h6>
                            <div class="mb-4">
                                <label class="form-label-custom text-blue">Target Timezone</label>
                                <select id="v-tz-to" class="form-select border-0 bg-light rounded-3 fw-bold">
                                    <option value="UTC" selected>UTC (Universal Time)</option>
                                    <option value="America/New_York">New York (EST/EDT)</option>
                                    <option value="America/Los_Angeles">Los Angeles (PST/PDT)</option>
                                    <option value="Europe/London">London (GMT/BST)</option>
                                    <option value="Europe/Paris">Paris (CET/CEST)</option>
                                    <option value="Asia/Tokyo">Tokyo (JST)</option>
                                    <option value="Asia/Kolkata">Mumbai/Kolkata (IST)</option>
                                    <option value="Australia/Sydney">Sydney (AEST/AEDT)</option>
                                </select>
                            </div>
                            <div class="p-3 rounded-3 bg-blue-50 border border-blue-100 d-flex justify-content-between align-items-center">
                                <span class="small fw-bold text-blue-900">OFFSET ANALYSIS</span>
                                <span class="badge bg-blue text-white" id="out-offset">+0:00 HRS</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="America/New_York">NYC Meeting</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="Europe/London">London Call</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-t="Asia/Tokyo">Tokyo Sync</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 210; --tool-color: #3B82F6; --tool-bg: rgba(59, 130, 246, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small" id="out-city">DESTINATION TIME (UTC)</span>
                <div class="output-hero-value display-1 fw-900 my-2 chrono-lcd" id="out-time">00:00 AM</div>
                <div class="badge bg-blue-soft text-blue px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-date">MONDAY, JAN 01, 2026</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Business Window Overlap</h6>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="flex-grow-1 bg-light rounded-pill p-1 d-flex overflow-hidden" style="height: 30px;">
                                <div class="bg-blue opacity-10" style="width: 30%"></div>
                                <div class="bg-success" style="width: 40%"></div>
                                <div class="bg-blue opacity-10" style="width: 30%"></div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6"><div class="p-2 border rounded-3 bg-light small fw-bold text-muted text-center" id="out-status">BUSINESS HOURS ACTIVE</div></div>
                            <div class="col-6"><div class="p-2 border rounded-3 bg-light small fw-bold text-muted text-center" id="out-dst">DST: INACTIVE</div></div>
                        </div>
                    </div>

                    
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Temporal Identity</h6>
                            <div class="p-3 rounded-4 bg-blue-50 border border-blue-100 mb-4">
                                <div class="small fw-bold text-blue-900 lh-base" id="out-advice">Synchronizing nodes...</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-blue rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-calendar-check me-2"></i>Copy Event Sync
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset Node
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
    const timeE = $('v-time'), tzFromE = $('v-tz-from'), tzToE = $('v-tz-to');

    // Default to current
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    timeE.value = now.toISOString().slice(0, 16);

    function calculate(){
        if(!timeE.value) return;
        const date = new Date(timeE.value);
        
        const options = {
            timeZone: tzToE.value,
            year: 'numeric', month: 'short', day: 'numeric',
            hour: '2-digit', minute: '2-digit', hour12: true,
            weekday: 'long'
        };

        const formatter = new Intl.DateTimeFormat('en-US', options);
        const parts = formatter.formatToParts(date);
        
        let h, m, day, month, year, ampm, weekday;
        parts.forEach(p => {
            if (p.type === 'hour') h = p.value;
            if (p.type === 'minute') m = p.value;
            if (p.type === 'day') day = p.value;
            if (p.type === 'month') month = p.value;
            if (p.type === 'year') year = p.value;
            if (p.type === 'dayPeriod') ampm = p.value;
            if (p.type === 'weekday') weekday = p.value;
        });

        $('out-time').textContent = `${h}:${m} ${ampm}`;
        $('out-date').textContent = `${weekday}, ${month} ${day}, ${year}`.toUpperCase();
        $('out-city').textContent = `DESTINATION TIME (${tzToE.value.split('/').pop().replace('_',' ')})`;

        // Offset
        const fromDate = new Date().toLocaleString("en-US", {timeZone: tzFromE.value});
        const toDate = new Date().toLocaleString("en-US", {timeZone: tzToE.value});
        const diff = (new Date(toDate) - new Date(fromDate)) / (1000 * 60 * 60);
        $('out-offset').textContent = (diff >= 0 ? '+' : '') + diff.toFixed(1) + ' HRS';

        // Business Status (9 AM - 5 PM)
        let hour24 = parseInt(h);
        if(ampm.toLowerCase() === 'pm' && hour24 < 12) hour24 += 12;
        if(ampm.toLowerCase() === 'am' && hour24 === 12) hour24 = 0;
        
        let status = 'OUTSIDE BUSINESS HOURS';
        if(hour24 >= 9 && hour24 < 17) status = 'BUSINESS HOURS ACTIVE';
        $('out-status').textContent = status;
        $('out-status').style.color = status.includes('ACTIVE') ? '#10b981' : '#ef4444';

        $('out-advice').textContent = `The destination is ${Math.abs(diff)} hours ${diff >= 0 ? 'ahead of' : 'behind'} your origin node.`;
    }

    [timeE, tzFromE, tzToE].forEach(e => e.addEventListener('input', calculate));

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            tzToE.value = btn.dataset.t;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `Temporal Sync Event\nTime: ${$('out-time').textContent}\nDate: ${$('out-date').textContent}\nTimezone: ${tzToE.value}\nGenerated by ToolsHub Chrono Mapper`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Sync Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        const now = new Date(); now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        timeE.value = now.toISOString().slice(0, 16);
        tzToE.value = 'UTC';
        calculate();
    });

    calculate();
});
</script>

<style>
.chrono-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e3a8a;opacity:.7;margin-bottom:8px;display:block}
.chrono-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-blue { background: #1E3A8A; color: #fff; transition: all .3s; }
.btn-blue:hover { background: #1e40af; color: #fff; transform: translateY(-2px); }
.btn-blue-soft { background: #EFF6FF; color: #1E3A8A; border: 1px solid #dbeafe; }
.text-blue { color: #3B82F6; }
.text-blue-900 { color: #1e3a8a; }
.bg-blue-soft { background: #EFF6FF; }
.bg-blue-50 { background-color: #f8fbff; }
.bg-blue { background-color: #3B82F6 !important; }
.chrono-lcd { font-family: 'Courier New', Courier, monospace; letter-spacing: -2px; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\time-converter.blade.php ENDPATH**/ ?>