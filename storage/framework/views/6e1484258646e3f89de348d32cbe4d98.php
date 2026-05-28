<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>

<div class="row g-4 parallel-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body pt-3">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <div class="row g-3 align-items-center mb-4">
                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Network Topology</label>
                        <select id="res-topology" class="form-select form-select-sm rounded-3 shadow-none border-secondary-subtle">
                            <option value="parallel" selected>Parallel Network (1/Req = ∑ 1/Ri)</option>
                            <option value="series">Series Network (Req = ∑ Ri)</option>
                        </select>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label-custom">Applied Circuit Voltage (Optional)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="res-voltage" class="form-control rounded-start-3 shadow-none border-secondary-subtle" value="5" step="any" min="0.01">
                            <span class="input-group-text rounded-end-3 bg-light border-secondary-subtle small fw-bold">V</span>
                        </div>
                    </div>
                </div>

                
                <div class="mb-3">
                    <label class="form-label-custom mb-2">Resistor Branches</label>
                    <div id="resistor-branches-container" class="d-flex flex-column gap-2">
                        <!-- Branches injected dynamically by JS -->
                    </div>
                </div>

                
                <div class="d-flex justify-content-start mb-3">
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" id="add-branch-btn">
                        <i class="fas fa-plus me-2"></i>Add Resistor Branch
                    </button>
                </div>

                
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 res-preset" data-vals="10,10" data-units="1000,1000">🎛️ Dual 10kΩ Parallel</button>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 res-preset" data-vals="220,470,1000" data-units="1,1,1">🎛️ 220Ω, 470Ω, 1kΩ Parallel</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-4" id="res-reset">Reset</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:220;--tool-color:#2563eb;--tool-bg:rgba(37,99,235,.03);">
            <div class="output-hero py-3 text-center">
                <span class="output-hero-label text-uppercase small fw-bold tracking-wider" id="out-hero-label">Equivalent Resistance (Req)</span>
                <div class="d-flex justify-content-center align-items-baseline gap-1 mt-1">
                    <span class="output-hero-value fw-black text-2xl" id="out-value" style="color:#2563eb;">5.0</span>
                    <span class="output-hero-unit text-muted small fw-bold" id="out-unit">kΩ</span>
                </div>
                <div class="mt-2 fw-bold small text-uppercase" id="out-status" style="letter-spacing:1px;color:#2563eb;">Calculated Network Impedance</div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Equivalent Ohms</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-ohms">5,000 Ω</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Total Current Draw</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-current">1.00 mA</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Total Dissipated Power</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-power">5.00 mW</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card p-2 bg-white border border-light-subtle rounded-3 text-center">
                        <span class="stat-card-label text-muted text-uppercase small" style="font-size:0.6rem;">Branch Count</span>
                        <span class="stat-card-value fw-bold d-block mt-1" id="out-count">2 Branches</span>
                    </div>
                </div>
            </div>

            
            <div class="mt-4 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-share-alt text-primary me-2"></i>Network Branch Current Distributions
                </h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0 text-center small align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Branch ID</th>
                                <th>Branch Resistance</th>
                                <th>Branch Current</th>
                                <th>Current Share %</th>
                                <th>Power Dissipation</th>
                            </tr>
                        </thead>
                        <tbody id="branch-distribution-body">
                            <!-- Branch listings injected by JS -->
                        </tbody>
                    </table>
                </div>
            </div>

            
            <div class="mt-4 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-calculator text-primary me-2"></i>Equivalent Network Formula
                </h6>
                <div id="latex-formula" class="my-3 overflow-x-auto text-center py-2" style="font-size: 1.1rem;"></div>
                <div id="latex-substitution" class="small text-secondary overflow-x-auto text-center border-top pt-2"></div>
            </div>

            
            <div class="mt-3 p-3 bg-white border rounded-3 shadow-sm">
                <h6 class="fw-bold mb-2 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-stethoscope text-danger me-2"></i>Branch Impedance Insights
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            
            <div class="row g-2 mt-4">
                <div class="col-md-12">
                    <button class="btn d-block mx-auto btn-dark py-2 px-4 fw-bold rounded-pill shadow-sm" id="res-copy-btn" style="min-width: 250px;">
                        <i class="fas fa-copy me-2 text-info"></i>Copy Network Specifications
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const topoEl = $('res-topology'), voltEl = $('res-voltage'),
          container = $('resistor-branches-container'), addBtn = $('add-branch-btn'),
          distBody = $('branch-distribution-body'),
          latexF = $('latex-formula'), latexSub = $('latex-substitution');

    let branchCounter = 0;

    function createBranch(val = 10, unit = 1000) {
        branchCounter++;
        const id = branchCounter;

        const html = `
            <div class="row g-2 align-items-center branch-row" id="branch-row-${id}">
                <div class="col-auto">
                    <span class="badge bg-light text-dark border rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">${id}</span>
                </div>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <input type="number" class="form-control rounded-start-3 shadow-none border-secondary-subtle branch-val" value="${val}" step="any" min="0.1">
                        <select class="form-select rounded-end-3 shadow-none border-secondary-subtle branch-unit" style="max-width: 85px;">
                            <option value="1" ${unit === 1 ? 'selected' : ''}>Ω</option>
                            <option value="1000" ${unit === 1000 ? 'selected' : ''}>kΩ</option>
                            <option value="1000000" ${unit === 1000000 ? 'selected' : ''}>MΩ</option>
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-outline-danger border-0 rounded-circle remove-branch-btn" data-id="${id}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);

        const row = $(`branch-row-${id}`);
        row.querySelector('.branch-val').addEventListener('input', calculate);
        row.querySelector('.branch-unit').addEventListener('change', calculate);
        row.querySelector('.remove-branch-btn').addEventListener('click', function() {
            const count = container.querySelectorAll('.branch-row').length;
            if (count > 2) {
                row.remove();
                renumberBranches();
                calculate();
            } else {
                alert('A network must contain at least 2 branches.');
            }
        });

        calculate();
    }

    function renumberBranches() {
        let i = 1;
        container.querySelectorAll('.branch-row').forEach(row => {
            row.querySelector('.badge').textContent = i;
            i++;
        });
    }

    function formatRes(ohms) {
        if (ohms >= 1e6) return (ohms / 1e6).toFixed(2) + ' MΩ';
        if (ohms >= 1000) return (ohms / 1000).toFixed(2) + ' kΩ';
        return ohms.toFixed(1) + ' Ω';
    }

    function formatCurrent(amps) {
        if (amps < 1e-3) return (amps * 1e6).toFixed(1) + ' µA';
        if (amps < 1) return (amps * 1000).toFixed(2) + ' mA';
        return amps.toFixed(3) + ' A';
    }

    function formatPower(watts) {
        if (watts < 1e-3) return (watts * 1e6).toFixed(1) + ' µW';
        if (watts < 1) return (watts * 1000).toFixed(2) + ' mW';
        return watts.toFixed(3) + ' W';
    }

    function renderMath() {
        if (typeof katex !== 'undefined') {
            const isParallel = topoEl.value === 'parallel';
            if (isParallel) {
                katex.render("R_{eq} = \\frac{1}{\\frac{1}{R_1} + \\frac{1}{R_2} + \\dots + \\frac{1}{R_n}}", latexF, {throwOnError: false, displayMode: true});
            } else {
                katex.render("R_{eq} = R_1 + R_2 + \\dots + R_n", latexF, {throwOnError: false, displayMode: true});
            }
        } else {
            setTimeout(renderMath, 100);
        }
    }

    function calculate() {
        const isParallel = topoEl.value === 'parallel';
        const volt = parseFloat(voltEl.value) || 0;

        renderMath();

        const branchRows = container.querySelectorAll('.branch-row');
        const count = branchRows.length;
        $('out-count').textContent = `${count} Branches`;

        let invSum = 0;
        let sum = 0;
        const list = [];

        branchRows.forEach((row, idx) => {
            const val = parseFloat(row.querySelector('.branch-val').value);
            const unit = parseFloat(row.querySelector('.branch-unit').value);
            const ohms = val * unit;

            if (!isNaN(ohms) && ohms > 0) {
                invSum += 1 / ohms;
                sum += ohms;
                list.push({ idx: idx + 1, ohms: ohms });
            }
        });

        if (list.length === 0) return;

        let req = isParallel ? (1 / invSum) : sum;

        const reqDisp = formatRes(req);
        $('out-value').textContent = reqDisp.split(' ')[0];
        $('out-unit').textContent = reqDisp.split(' ')[1];
        $('out-ohms').textContent = req.toLocaleString(undefined, {maximumFractionDigits: 1}) + ' Ω';

        const totalCurrent = volt > 0 ? volt / req : 0;
        const totalPower = volt > 0 ? volt * totalCurrent : 0;

        $('out-current').textContent = volt > 0 ? formatCurrent(totalCurrent) : '—';
        $('out-power').textContent = volt > 0 ? formatPower(totalPower) : '—';

        // Branch distribution table
        distBody.innerHTML = '';
        list.forEach(branch => {
            let branchCurrent = 0;
            let currentShare = 0;
            let branchPower = 0;

            if (volt > 0) {
                if (isParallel) {
                    branchCurrent = volt / branch.ohms;
                    currentShare = totalCurrent > 0 ? (branchCurrent / totalCurrent) * 100 : 0;
                } else {
                    branchCurrent = totalCurrent;
                    currentShare = 100;
                }
                branchPower = branchCurrent * branchCurrent * branch.ohms;
            }

            const row = `
                <tr>
                    <td class="fw-bold">Branch ${branch.idx}</td>
                    <td>${formatRes(branch.ohms)}</td>
                    <td>${volt > 0 ? formatCurrent(branchCurrent) : '—'}</td>
                    <td>${volt > 0 ? currentShare.toFixed(1) + '%' : '—'}</td>
                    <td>${volt > 0 ? formatPower(branchPower) : '—'}</td>
                </tr>
            `;
            distBody.insertAdjacentHTML('beforeend', row);
        });

        // Substitution LaTeX
        if (typeof katex !== 'undefined') {
            let subStr = '';
            if (isParallel) {
                const inner = list.map(b => `\\frac{1}{${formatRes(b.ohms).replace(' kΩ','k\\Omega').replace(' MΩ','M\\Omega').replace(' Ω','\\Omega')}}`).join(' + ');
                subStr = `R_{eq} = \\frac{1}{${inner}} = ${reqDisp}`;
            } else {
                const inner = list.map(b => formatRes(b.ohms).replace(' kΩ','k\\Omega').replace(' MΩ','M\\Omega').replace(' Ω','\\Omega')).join(' + ');
                subStr = `R_{eq} = ${inner} = ${reqDisp}`;
            }
            katex.render(subStr, latexSub, {throwOnError: false, displayMode: true});
        }

        // Insights
        let insights = [];
        if (isParallel) {
            insights.push("In a parallel network, the total equivalent resistance is **always lower** than the smallest individual branch resistor.");
            if (volt > 0) {
                insights.push("Current flows inversely proportional to branch resistance (path of least resistance).");
            }
        } else {
            insights.push("In a series network, the total equivalent resistance is simply the sum of all individual resistors.");
            if (volt > 0) {
                insights.push("Current is identical in all series branches, while voltage splits proportionally.");
            }
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${insights.map(i => `<li class="mb-2 d-flex align-items-start"><i class="fas fa-check-circle text-primary me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    addBtn.onclick = () => createBranch(10, 1000);
    topoEl.addEventListener('change', calculate);
    voltEl.addEventListener('input', calculate);

    $('res-reset').onclick = () => {
        topoEl.value = 'parallel';
        voltEl.value = '5';
        container.innerHTML = '';
        branchCounter = 0;
        createBranch(10, 1000);
        createBranch(10, 1000);
    };

    document.querySelectorAll('.res-preset').forEach(btn => {
        btn.onclick = () => {
            topoEl.value = 'parallel';
            container.innerHTML = '';
            branchCounter = 0;
            const vals = btn.dataset.vals.split(',');
            const units = btn.dataset.units.split(',');
            for (let i = 0; i < vals.length; i++) {
                createBranch(parseFloat(vals[i]), parseFloat(units[i]));
            }
        };
    });

    $('res-copy-btn').onclick = function() {
        let text = `Equivalent Resistor Network Report\n`;
        text += `Topology: ${topoEl.options[topoEl.selectedIndex].text}\n`;
        text += `Branch Count: ${$('out-count').textContent}\n`;
        text += `Equivalent Resistance (Req): ${$('out-value').textContent} ${$('out-unit').textContent}\n`;
        if (voltEl.value) {
            text += `Total Current: ${$('out-current').textContent}\n`;
            text += `Total Power: ${$('out-power').textContent}\n`;
        }
        text += `Calculated at ToolsHub Network`;
        
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML; 
            this.innerHTML = '<i class="fas fa-check me-2"></i>Network Specs Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    };

    // Initialize with two standard 10k branches
    createBranch(10, 1000);
    createBranch(10, 1000);
});
</script>

<style>
.parallel-rebuilt .calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2.5rem; box-shadow: 0 8px 48px rgba(37,99,235,.04); }
.parallel-rebuilt .calculator-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; }
.parallel-rebuilt .calculator-header h5 { margin: 0; font-weight: 900; color: #0f172a; font-size: 1.25rem; }
.parallel-rebuilt .calculator-header p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.5; }
.parallel-rebuilt .tool-icon-circle { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
.parallel-rebuilt .form-label-custom { font-size: .65rem; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem; display: block; }
.output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.03); transition: all .4s ease; }
.output-hero { border-bottom: 1px solid rgba(0,0,0,.04); }
.output-hero-label { display: block; font-size: .7rem; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3rem; font-weight: 900; line-height: 1; letter-spacing: -2px; }
.output-hero-unit { font-size: 1.25rem; font-weight: 800; margin-left: 4px; }
.stat-card { transition: all .3s ease; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.02); }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\parallel-resistor-calculator.blade.php ENDPATH**/ ?>