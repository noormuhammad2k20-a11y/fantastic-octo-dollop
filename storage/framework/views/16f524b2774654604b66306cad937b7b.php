<div class="row g-4 mercury-calc-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Select Year</label>
                        <select id="year-selector" class="form-select form-select-lg rounded-3">
                            <option value="2024">2024</option>
                            <option value="2025" selected>2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Your Timezone</label>
                        <select id="timezone-selector" class="form-select form-select-lg rounded-3">
                            <option value="-8">PST (UTC-8)</option>
                            <option value="-5">EST (UTC-5)</option>
                            <option value="0" selected>UTC (GMT)</option>
                            <option value="1">CET (UTC+1)</option>
                            <option value="5.5">IST (UTC+5:30)</option>
                            <option value="8">HKT (UTC+8)</option>
                            <option value="9">JST (UTC+9)</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" class="btn btn-info w-100 py-3 rounded-3 fw-bold text-white shadow-sm" id="btn-check">Check Retrograde Status</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-card" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(14,165,233,.04);display:none;">
            <div class="output-hero text-center py-4">
                <span class="output-hero-label">Current Status</span>
                <div class="output-hero-value" id="out-status" style="font-size:3.5rem">Direct</div>
                <div class="badge bg-info text-white px-3 py-2 rounded-pill mt-2" id="out-badge">Mercury is moving forward</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-calendar-days me-2 text-primary"></i>Retrograde Periods for <span id="out-year">2025</span></h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover small">
                        <thead class="table-light text-center">
                            <tr><th>Start Date & Time</th><th>End Date & Time</th><th>Duration</th><th>Sign</th></tr>
                        </thead>
                        <tbody id="out-table-body"></tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3 text-dark"><i class="fas fa-lightbulb me-2 text-warning"></i>Pro Guidance</h6>
                <div id="out-advice" class="text-secondary leading-relaxed small"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    const yearSel=$('year-selector'), tzSel=$('timezone-selector'), outputCard=$('output-card');

    const data = {
        2024: [
            {start: "2024-04-01T22:14:00", end: "2024-04-25T12:54:00", sign: "Aries"},
            {start: "2024-08-05T04:56:00", end: "2024-08-28T21:14:00", sign: "Virgo/Leo"},
            {start: "2024-11-25T21:42:00", end: "2024-12-15T20:56:00", sign: "Sagittarius"}
        ],
        2025: [
            {start: "2025-03-14T23:45:00", end: "2025-04-07T14:12:00", sign: "Aries"},
            {start: "2025-07-17T22:30:00", end: "2025-08-11T01:50:00", sign: "Leo"},
            {start: "2025-11-09T18:15:00", end: "2025-11-29T17:40:00", sign: "Sagittarius/Scorpio"}
        ],
        2026: [
            {start: "2026-02-25T10:00:00", end: "2026-03-20T05:00:00", sign: "Pisces"},
            {start: "2026-06-29T15:00:00", end: "2026-07-23T12:00:00", sign: "Cancer"},
            {start: "2026-10-24T08:00:00", end: "2026-11-13T22:00:00", sign: "Scorpio"}
        ],
        2027: [
            {start: "2027-02-09T12:00:00", end: "2027-03-03T08:00:00", sign: "Aquarius"},
            {start: "2027-06-10T18:00:00", end: "2027-07-04T10:00:00", sign: "Gemini"},
            {start: "2027-10-07T05:00:00", end: "2027-10-31T01:00:00", sign: "Libra"}
        ],
        2028: [
            {start: "2028-01-24T20:00:00", end: "2028-02-14T15:00:00", sign: "Aquarius/Capricorn"},
            {start: "2028-05-21T02:00:00", end: "2028-06-13T22:00:00", sign: "Gemini/Taurus"},
            {start: "2028-09-19T11:00:00", end: "2028-10-13T07:00:00", sign: "Libra/Virgo"}
        ],
        2029: [
            {start: "2029-01-07T08:00:00", end: "2029-01-27T22:00:00", sign: "Capricorn"},
            {start: "2029-05-01T15:00:00", end: "2029-05-25T10:00:00", sign: "Taurus"},
            {start: "2029-09-02T19:00:00", end: "2029-09-26T14:00:00", sign: "Virgo"}
        ]
    };

    function check() {
        const year = yearSel.value;
        const tz = parseFloat(tzSel.value);
        const periods = data[year];
        const now = new Date();
        
        let rows = '';
        let isRetro = false;

        periods.forEach(p => {
            const start = new Date(p.start);
            const end = new Date(p.end);
            
            // Apply offset
            start.setHours(start.getHours() + tz);
            end.setHours(end.getHours() + tz);

            const duration = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            
            const active = now >= start && now <= end;
            if(active) isRetro = true;

            rows += `<tr class="${active ? 'table-warning fw-bold' : ''}">
                <td>${start.toLocaleString()}</td>
                <td>${end.toLocaleString()}</td>
                <td class="text-center">${duration} Days</td>
                <td class="text-center text-primary">${p.sign}</td>
            </tr>`;
        });

        $('out-year').textContent = year;
        $('out-table-body').innerHTML = rows;
        $('out-status').textContent = isRetro ? "Retrograde" : "Direct";
        $('out-status').style.color = isRetro ? "#dc2626" : "#059669";
        $('out-badge').textContent = isRetro ? "Mercury is appearing to move backward" : "Mercury is moving forward normally";
        $('out-badge').className = `badge px-3 py-2 rounded-pill mt-2 ${isRetro ? 'bg-danger' : 'bg-success'}`;

        const advice = isRetro ? 
            "Expect delays in travel, technical glitches, and communication misunderstandings. Avoid signing major contracts or starting new ventures. It is a time for reflection, research, and review." :
            "Communication flows smoothly. It is an ideal time for starting new projects, signing agreements, and launching technological endeavors. Use this clarity to push forward.";
        
        $('out-advice').innerHTML = `<p>${advice}</p><p><strong>Shadow Period:</strong> Remember that the 'shadow' effects can be felt up to 2 weeks before and after the official dates.</p>`;

        outputCard.style.display = 'block';
        outputCard.scrollIntoView({behavior:'smooth', block:'center'});
    }

    $('btn-check').addEventListener('click', check);
    [yearSel, tzSel].forEach(el => el.addEventListener('change', check));
    
    check();
});
</script>

<style>
.mercury-calc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.mercury-calc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.mercury-calc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.mercury-calc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.mercury-calc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.mercury-calc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.leading-relaxed { line-height: 1.6; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\mercury-retrograde-checker.blade.php ENDPATH**/ ?>