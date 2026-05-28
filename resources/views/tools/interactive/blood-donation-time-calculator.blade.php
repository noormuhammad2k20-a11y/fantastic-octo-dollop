<div class="container-fluid donation-rebuilt">
    <div class="row g-4">
        {{-- Input Card --}}
        <div class="col-lg-12">
            <div class="tool-card-premium">
                <div class="tool-header-modern">
                    <div class="tool-icon-circle" style="background:rgba(220, 38, 38, 0.1); color:#dc2626;">
                        <i class="fas fa-droplet"></i>
                    </div>
                    <div class="tool-title-section">
                        <h3 class="tool-title">Blood Donation Eligibility Tracker</h3>
                        <p class="tool-subtitle">Precision scheduling for whole blood, platelets, and double red cell donations based on clinical recovery windows.</p>
                    </div>
                </div>

                <div class="tool-body-modern">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">Donation Procedure Type</label>
                            <select id="donation_type" class="form-select-custom">
                                <option value="whole_blood" selected>Whole Blood (Standard)</option>
                                <option value="platelets">Platelets (Apheresis)</option>
                                <option value="power_red">Power Red / Double Reds</option>
                                <option value="plasma">Plasma</option>
                            </select>
                            <span class="text-muted tiny mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Recovery windows vary by procedure.</span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Last Donation Date</label>
                            <input type="date" id="last_date" class="form-control-custom" value="">
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn-calculate-pro flex-grow-1" style="min-width: 280px; max-width: 100%; background:#dc2626;" onclick="calculateEligibility()">
                                    <i class="fas fa-calendar-check me-2"></i> Compute Next Eligibility
                                </button>
                                <button type="button" class="btn-reset-pro" onclick="resetDonation()">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Results Card --}}
        <div class="col-lg-12">
            <div class="output-card-themed" id="donation-result-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5 text-center px-4 border-end">
                        <div class="hero-date-badge">
                            <span class="hero-label">Earliest Return Date</span>
                            <h2 class="hero-value" id="next-date" style="font-size:2.8rem; letter-spacing: -1px;">Select Date</h2>
                            <div class="hero-days-tag" id="days-remaining">-- Days to go</div>
                            <div class="hero-status-pill mt-3" id="elig-status">Status Pending</div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 px-4">
                        <div class="eligibility-details">
                            <h6 class="fw-bold mb-3 small text-uppercase ls-1 text-primary"><i class="fas fa-clock-rotate-left me-2"></i>Procedure Recovery Schedule</h6>
                            <div class="d-flex flex-column gap-3">
                                <div class="recov-row">
                                    <span class="r-label">Required Gap</span>
                                    <span class="r-value" id="wait-period">56 Days</span>
                                </div>
                                <div class="recov-row">
                                    <span class="r-label">Annual Limit</span>
                                    <span class="r-value" id="annual-limit">6 Times / Year</span>
                                </div>
                                <div class="recov-row">
                                    <span class="r-label">Health Safety</span>
                                    <span class="r-value text-success">Verified Range</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="insights-container-soft bg-light p-3 rounded-4">
                                <h6 class="fw-bold small mb-2"><i class="fas fa-circle-info text-info me-2"></i>Clinical Guide</h6>
                                <p id="donation-advice" class="tiny text-muted mb-0">
                                    Whole blood donation requires an 8-week interval to ensure iron replenishment.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 p-3">
                        <button class="btn d-block mx-auto -action-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-btn" onclick="copyDonation()">
                            <i class="fas fa-copy me-2 text-info"></i> Copy Eligibility Timeline
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.donation-rebuilt { font-family: 'Inter', system-ui, sans-serif; }

.tool-card-premium { background: #ffffff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
.tool-header-modern { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
.tool-title { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.tool-subtitle { color: #64748b; font-size: 0.95rem; margin: 0; }

.form-label-custom { font-size: 0.85rem; font-weight: 700; color: #475569; margin-bottom: 0.6rem; display: block; text-transform: uppercase; letter-spacing: 0.5px; }

.form-select-custom, .form-control-custom { background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1rem; font-weight: 600; width: 100%; color: #1e293b; outline: none; transition: 0.2s; }
.form-select-custom:focus, .form-control-custom:focus { border-color: #dc2626; box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1); background: #fff; }

.btn-calculate-pro { border: none; padding: 1.1rem; border-radius: 16px; color: white; font-weight: 800; cursor: pointer; transition: 0.3s; }
.btn-reset-pro { background: #f1f5f9; border: none; width: 60px; height: 60px; border-radius: 16px; color: #64748b; cursor: pointer; transition: 0.2s; }

/* Output */
.output-card-themed { background: #ffffff; border-radius: 32px; padding: 3rem; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 25px 70px rgba(0,0,0,0.06); margin-top: 2rem; }

.hero-date-badge { padding: 1rem; }
.hero-label { font-size: 0.85rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; display: block; margin-bottom: 0.5rem; }
.hero-days-tag { font-size: 1.2rem; font-weight: 800; color: #dc2626; margin-top: 0.5rem; }

.hero-status-pill { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 100px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

.recov-row { display: flex; justify-content: space-between; align-items: center; border-bottom: 1.5px dashed #e2e8f0; padding-bottom: 0.75rem; }
.r-label { font-size: 0.85rem; font-weight: 600; color: #64748b; }
.r-value { font-weight: 800; color: #1e293b; font-size: 0.95rem; }

.btn-action-dark { background: #1e293b; color: #fff; border: none; padding: 1.1rem; border-radius: 16px; font-weight: 700; cursor: pointer; }

.ls-1 { letter-spacing: 1px; }
.tiny { font-size: 0.75rem; }
</style>

<script>
const rules = {
    whole_blood: { days: 56, limit: 6, info: "Whole blood donation requires an 8-week interval for red cell replenishment." },
    platelets: { days: 7, limit: 24, info: "Platelets can be donated up to 24 times a year, with a minimum 7-day gap." },
    power_red: { days: 112, limit: 3, info: "Double red cell procedures require a 16-week recovery window." },
    plasma: { days: 28, limit: 13, info: "Plasma donation gap is typically 28 days for standard health safety." }
};

function calculateEligibility() {
    const type = document.getElementById('donation_type').value;
    const lastDateVal = document.getElementById('last_date').value;

    if (!lastDateVal) return;

    const lastDate = new Date(lastDateVal);
    const rule = rules[type];
    const nextDate = new Date(lastDate);
    nextDate.setDate(lastDate.getDate() + rule.days);

    const today = new Date();
    today.setHours(0,0,0,0);
    const diffTime = nextDate - today;
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    // Display
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('next-date').innerText = nextDate.toLocaleDateString(undefined, options);
    document.getElementById('wait-period').innerText = rule.days + " Days";
    document.getElementById('annual-limit').innerText = rule.limit + " Times / Year";
    document.getElementById('donation_advice').innerText = rule.info;

    const statusPill = document.getElementById('elig-status');
    const daysTag = document.getElementById('days-remaining');

    if (diffDays <= 0) {
        statusPill.innerText = "ELIGIBLE NOW";
        statusPill.style.background = "#10b98115";
        statusPill.style.color = "#10b981";
        statusPill.style.border = "1.5px solid #10b98130";
        daysTag.innerText = "Ready to Donate!";
        daysTag.style.color = "#10b981";
    } else {
        statusPill.innerText = "WAITING PERIOD";
        statusPill.style.background = "#f9731615";
        statusPill.style.color = "#f97316";
        statusPill.style.border = "1.5px solid #f9731630";
        daysTag.innerText = diffDays + " Days to go";
        daysTag.style.color = "#dc2626";
    }
}

function resetDonation() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('last_date').value = today;
    calculateEligibility();
}

function copyDonation() {
    const date = document.getElementById('next-date').innerText;
    const days = document.getElementById('days-remaining').innerText;
    const type = document.getElementById('donation_type').options[document.getElementById('donation_type').selectedIndex].text;
    const text = `Blood Donation Schedule\n━━━━━━━━━━━━━━━━━━━━━━\nType: ${type}\nEligible On: ${date}\nStatus: ${days}\n\nPlanned via ToolsHub Health`;
    
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i> Timeline Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy me-2 text-info"></i> Copy Eligibility Timeline', 2000);
    });
}

// Set default date to today
document.addEventListener('DOMContentLoaded', () => {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('last_date').value = today;
    
    ['donation_type', 'last_date'].forEach(id => {
        document.getElementById(id).addEventListener('change', calculateEligibility);
    });
    
    calculateEligibility();
});
</script>
