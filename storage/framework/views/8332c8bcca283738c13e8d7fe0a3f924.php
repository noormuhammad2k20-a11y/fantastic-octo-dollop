<div class="row g-4 bottleneck-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4 border-bottom pb-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Processor (CPU) Tier</label>
                        <select id="bn-cpu" class="form-select form-select-lg border-info-subtle rounded-3">
                            <option value="40">Entry-level (Core i3 / Ryzen 3)</option>
                            <option value="65">Mid-range (Core i5 / Ryzen 5)</option>
                            <option value="85" selected>High-end (Core i7 / Ryzen 7)</option>
                            <option value="100">Enthusiast (Core i9 / Ryzen 9 / X3D)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Graphics Card (GPU) Tier</label>
                        <select id="bn-gpu" class="form-select form-select-lg border-info-subtle rounded-3">
                            <option value="40">Entry-level (RTX 3050 / RX 6600)</option>
                            <option value="60">Mid-range (RTX 4060 / RX 7600)</option>
                            <option value="85" selected>High-end (RTX 4070 Ti / RX 7800 XT)</option>
                            <option value="100">Enthusiast (RTX 4090 / RX 7900 XTX)</option>
                        </select>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label-custom">Target Resolution</label>
                        <select id="bn-res" class="form-select form-select-lg border-secondary-subtle">
                            <option value="1080">1080p (FHD)</option>
                            <option value="1440" selected>1440p (QHD)</option>
                            <option value="2160">2160p (4K UHD)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Primary Workload Task</label>
                        <select id="bn-task" class="form-select form-select-lg border-secondary-subtle">
                            <option value="gpu-heavy">Graphic Intensive AAA Games</option>
                            <option value="cpu-heavy" selected>CPU Intensive Esports (CS2, Valorant)</option>
                            <option value="balanced">General Processing/Productivity</option>
                        </select>
                    </div>
                    <div class="col-md-4 mt-auto">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light border-0">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="bn-ram">
                            <label class="form-check-label fw-bold d-block text-dark mt-1" for="bn-ram">Under 16GB RAM Installed</label>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2 w-100 flex-wrap">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 bn-quick" data-c="40" data-g="100" data-r="1080" data-t="cpu-heavy">Extreme CPU Bottleneck Test</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 bn-quick" data-c="100" data-g="40" data-r="2160" data-t="gpu-heavy">Extreme GPU Bottleneck Test</button>
                    <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold ms-auto" id="bn-calc-btn" style="min-width: 280px; max-width: 100%;">Analyze Hardware</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="bn-output-card" style="--tool-hue:210;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero mb-2">
                <span class="output-hero-label text-uppercase">ESTIMATED BOTTLENECK PERCENTAGE</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-percent" style="font-size:5rem;">0%</span>
                </div>
                <div class="mt-2 text-dark fw-bold small">Status: <span id="out-status" class="text-primary">Perfectly Balanced</span></div>
            </div>

            <div class="row text-center mt-3 border-bottom pb-4">
                <div class="col-6">
                    <div class="p-3 bg-white border border-primary-subtle rounded-3 h-100">
                        <span class="text-muted fw-bold small text-uppercase letter-spacing-1 d-block mb-1">CPU Utilization</span>
                        <span class="fs-2 fw-bold text-dark" id="out-cu">0%</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-white border border-danger-subtle rounded-3 h-100">
                        <span class="text-muted fw-bold small text-uppercase letter-spacing-1 d-block mb-1">GPU Utilization</span>
                        <span class="fs-2 fw-bold text-dark" id="out-gu">0%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-cogs text-info me-2"></i>Hardware Recommendations
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>
            
            <button class="btn d-block mx-auto btn-dark fw-bold mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="bn-copy-btn" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-share-alt me-2 text-info"></i>Share Hardware Diagnostics
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const cpuE = $('bn-cpu'), gpuE = $('bn-gpu'), resE = $('bn-res'), taskE = $('bn-task'), ramE = $('bn-ram');

    function calculate() {
        let cpuScore = parseInt(cpuE.value);
        let gpuScore = parseInt(gpuE.value);
        let res = parseInt(resE.value); // 1080, 1440, 2160
        let task = taskE.value;

        // Resolution shifts computing load from CPU to GPU
        // Higher res = GPU bottleneck more likely. Lower res = CPU bottleneck more likely.
        let cpuResMod = 1.0;
        let gpuResMod = 1.0;
        
        if (res === 1080) { gpuResMod = 0.8; cpuResMod = 1.2; }
        else if (res === 1440) { gpuResMod = 1.1; cpuResMod = 0.9; }
        else if (res === 2160) { gpuResMod = 1.4; cpuResMod = 0.7; }

        if (task === 'gpu-heavy') { gpuResMod *= 1.2; cpuResMod *= 0.8; }
        else if (task === 'cpu-heavy') { gpuResMod *= 0.8; cpuResMod *= 1.2; }
        
        let effectiveCpu = cpuScore / cpuResMod;
        let effectiveGpu = gpuScore / gpuResMod;

        // Calculate Utilization approximations (Max one component out at 100%, the other trails behind)
        let cUtil = 0, gUtil = 0;
        let bottleneckPct = 0;
        let bottleneckType = 'none';

        if (effectiveCpu > effectiveGpu) { // GPU Bottleneck
            gUtil = 100;
            cUtil = Math.max(20, Math.min(100, (effectiveGpu / effectiveCpu) * 100));
            bottleneckPct = 100 - cUtil;
            bottleneckType = 'gpu';
        } else { // CPU Bottleneck
            cUtil = 100;
            gUtil = Math.max(20, Math.min(100, (effectiveCpu / effectiveGpu) * 100));
            bottleneckPct = 100 - gUtil;
            bottleneckType = 'cpu';
        }

        // Ram modifier applies a flat 10-15% stutter penalty causing virtual bottlenecking regardless of hw
        let ramPenalty = 0;
        if(ramE.checked) ramPenalty = 15;

        const combinedBottleneck = Math.min(100, bottleneckPct + ramPenalty);
        let displayType = bottleneckType;
        if(bottleneckPct < 5 && ramPenalty > 0) displayType = 'ram';
        
        $('out-cu').textContent = `${Math.round(cUtil)}%`;
        $('out-gu').textContent = `${Math.round(gUtil)}%`;
        $('out-percent').textContent = `${Math.round(combinedBottleneck)}%`;

        const outCard = $('bn-output-card');
        const statusEl = $('out-status');

        if (combinedBottleneck <= 5) {
            statusEl.textContent = "Perfectly Balanced";
            statusEl.style.color = '#10b981';
            outCard.style.setProperty('--tool-hue', '142');
            outCard.style.setProperty('--tool-color', '#10b981');
        } else if (combinedBottleneck <= 15) {
            statusEl.textContent = "Minor Bottleneck (Acceptable)";
            statusEl.style.color = '#3b82f6';
            outCard.style.setProperty('--tool-hue', '210');
            outCard.style.setProperty('--tool-color', '#3b82f6');
        } else if (combinedBottleneck <= 30) {
            statusEl.textContent = "Noticeable Bottleneck";
            statusEl.style.color = '#f59e0b';
            outCard.style.setProperty('--tool-hue', '35');
            outCard.style.setProperty('--tool-color', '#f59e0b');
        } else {
            statusEl.textContent = `Severe ${displayType.toUpperCase()} Bottleneck`;
            statusEl.style.color = '#ef4444';
            outCard.style.setProperty('--tool-hue', '0');
            outCard.style.setProperty('--tool-color', '#ef4444');
        }

        const ins = [];
        if (displayType === 'cpu' && bottleneckPct > 5) {
            ins.push(`Your processor is too weak for your graphics card at ${res}p. You will experience stuttering and lower 1% lows. Upgrading your CPU will yield massive FPS gains.`);
        } else if (displayType === 'gpu' && bottleneckPct > 5) {
            if(res === 2160) {
                ins.push(`You have a GPU bottleneck. This is completely normal and expected at 4K resolution. Your GPU is running at max capacity giving you every frame possible.`);
            } else {
                ins.push(`Your graphics card is too weak to keep up with your processor. Upgrading your GPU is the most direct path to higher framerates.`);
            }
        }
        
        if (ramE.checked) {
            ins.push('<strong>Insufficient RAM Warning:</strong> Less than 16GB of system RAM will cause paging/stutter issues in modern titles regardless of your CPU/GPU combo.');
        }

        if(combinedBottleneck <= 5 && !ramE.checked) {
            ins.push("Your system is exceptionally well paired for this resolution and workload! Both components will feed data to each other efficiently without wasting potential performance.");
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-caret-right text-muted me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [cpuE, gpuE, resE, taskE, ramE].forEach(el => {
        el.addEventListener('input', calculate);
        el.addEventListener('change', calculate);
    });

    $('bn-calc-btn').addEventListener('click', calculate);

    document.querySelectorAll('.bn-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            cpuE.value = btn.dataset.c;
            gpuE.value = btn.dataset.g;
            resE.value = btn.dataset.r;
            taskE.value = btn.dataset.t;
            calculate();
        });
    });

    $('bn-copy-btn').addEventListener('click', function(){
        const text = `PC Bottleneck Test:\nResolution: ${resE.value}p\nWorkload: ${taskE.options[taskE.selectedIndex].text}\nResult: ${$('out-percent').textContent} Bottleneck\nStatus: ${$('out-status').textContent}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2 text-info"></i> Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.bottleneck-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(6,182,212,.05)}
.bottleneck-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.bottleneck-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.bottleneck-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.bottleneck-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.bottleneck-calculator-rebuilt .form-label-custom{font-size:.70rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}
.letter-spacing-1 { letter-spacing: 1px;}

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); transition: all 0.3s ease;}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.85rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem; color:var(--tool-color);}
.output-hero-value{font-weight:900;line-height:1; letter-spacing: -2px;}

@media (max-width: 768px) {
    .bottleneck-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\bottleneck-calculator.blade.php ENDPATH**/ ?>