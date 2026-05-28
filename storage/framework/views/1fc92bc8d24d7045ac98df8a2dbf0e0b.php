<div class="row g-4 minecraft-calculator-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-4 border-bottom pb-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Shape Dimension</label>
                        <select id="mc-shape" class="form-select form-select-lg border-success-subtle rounded-3">
                            <option value="2d" selected>2D Flat Circle</option>
                            <option value="3d">3D Hollow Sphere</option>
                            <option value="dome">3D Half-Dome</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Radius (Blocks)</label>
                        <div class="input-group">
                            <input type="number" id="mc-radius" class="form-control form-control-lg border-success-subtle rounded-start-3" value="10" min="2" max="128">
                            <span class="input-group-text bg-light text-muted border-success-subtle rounded-end-3 fw-bold">r</span>
                        </div>
                    </div>

                    <div class="col-md-6 mt-4">
                        <label class="form-label-custom">Stack Size</label>
                        <select id="mc-stack" class="form-select form-select-lg border-secondary-subtle rounded-3">
                            <option value="64" selected>Standard (64 blocks)</option>
                            <option value="16">Ender Pearls / Snowballs (16)</option>
                            <option value="1">Unstackable (1)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-check form-switch card p-3 flex-grow-1 shadow-sm bg-light border-0 h-100">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="mc-toggle-fill">
                            <label class="form-check-label fw-bold d-block text-dark mt-1" for="mc-toggle-fill">Filled Solid Shape <br><span class="small text-muted fw-normal">Calculates total area instead of perimeter outline</span></label>
                        </div>
                    </div>
                </div>

                
                <div class="mt-4 pt-3 border-top d-flex gap-2 w-100 flex-wrap">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Presets:</span>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 mc-quick" data-s="2d" data-r="15" data-f="0">Medium Base Outline (r15)</button>
                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 mc-quick" data-s="dome" data-r="30" data-f="0">Massive Glass Dome (r30)</button>
                    <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold ms-auto" id="mc-calc-btn" style="min-width: 280px; max-width: 100%;">Generate Blueprint</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="mc-output-card" style="--tool-hue:142;--tool-color:#22c55e;--tool-bg:rgba(34,197,94,.04);">
            <div class="output-hero mb-2">
                <span class="output-hero-label text-uppercase">TOTAL BLOCKS REQUIRED</span>
                <div class="d-flex justify-content-center align-items-baseline gap-2">
                    <span class="output-hero-value" id="out-blocks" style="font-size:4rem;">0</span>
                </div>
            </div>

            <div class="row g-3 mt-3 justify-content-center">
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 5px solid #a855f7; background: white;">
                        <span class="stat-card-label text-start text-purple" style="color:#a855f7">Required Shulker Boxes</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-shulker">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 5px solid #3b82f6; background: white;">
                        <span class="stat-card-label text-start text-primary">Required Inventory Stacks</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-stacks">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-top: 5px solid #10b981; background: white;">
                        <span class="stat-card-label text-start text-success">Total Diameter</span>
                        <span class="stat-card-value text-dark text-start mt-2 pt-1 border-top" id="out-dia">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 bg-white rounded-3 border shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted letter-spacing-1 d-flex align-items-center">
                    <i class="fas fa-hammer text-success me-2"></i>Construction Notes
                </h6>
                <div id="out-insights" class="small text-secondary"></div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mc-copy-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2 text-success"></i>Copy Materials List
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2 rounded-3 border-0 py-1 small opacity-50" id="mc-reset" style="min-width: 280px; max-width: 100%;">Reset</button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="mc-share-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-share-alt me-2"></i>Share Schematic Math
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const shapeE = $('mc-shape'), radE = $('mc-radius'), stackE = $('mc-stack'), fillE = $('mc-toggle-fill');

    function calculate() {
        const r = parseInt(radE.value) || 10;
        const stackLimit = parseInt(stackE.value) || 64;
        const isFilled = fillE.checked;
        const shape = shapeE.value;

        $('out-dia').textContent = (r * 2) + 1; // Block grid mapping puts center block + 2r

        let blocks = 0;
        
        // Exact pixel math approximations for voxel grids
        if (shape === '2d') {
            if(isFilled) {
                // Area of circle PI * r^2
                blocks = Math.floor(Math.PI * Math.pow(r, 2));
            } else {
                // Circumference ~ 2 * PI * r
                blocks = Math.floor(2 * Math.PI * r);
            }
        } else if (shape === '3d') {
            if(isFilled) {
                // Volume of sphere 4/3 * PI * r^3
                blocks = Math.floor((4/3) * Math.PI * Math.pow(r, 3));
            } else {
                // Surface Area 4 * PI * r^2
                blocks = Math.floor(4 * Math.PI * Math.pow(r, 2));
            }
        } else if (shape === 'dome') {
            if(isFilled) {
                blocks = Math.floor(((4/3) * Math.PI * Math.pow(r, 3)) / 2);
            } else {
                blocks = Math.floor((4 * Math.PI * Math.pow(r, 2)) / 2);
            }
        }

        $('out-blocks').textContent = blocks.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        let stacks = blocks / stackLimit;
        let shulkers = stacks / 27; // 27 slots in a shulker

        $('out-stacks').textContent = Number.isInteger(stacks) ? stacks : stacks.toFixed(1);
        $('out-shulker').textContent = Number.isInteger(shulkers) ? shulkers : shulkers.toFixed(2);

        const outCard = $('mc-output-card');
        const ins = [];

        if (blocks > 100000) {
            outCard.style.setProperty('--tool-hue', '0');
            outCard.style.setProperty('--tool-color', '#ef4444');
            ins.push('<strong>Massive Project Warning:</strong> This build requires over 100,000 blocks. WorldEdit, Litematica, or a server building mod is highly recommended to save time.');
        } else {
            outCard.style.setProperty('--tool-hue', '142');
            outCard.style.setProperty('--tool-color', '#22c55e');
        }

        if (isFilled && shape === '3d') {
            ins.push('You selected a solid 3D Sphere. Ensure you actually need it solid! A hollow sphere uses significantly fewer materials if you just need the exterior shell.');
        }

        if (shulkers > 36) {
            ins.push('This will take more than an entire inventory full of Shulker boxes to transport. Plan a temporary storage system (chests/hoppers) off-site.');
        } else if (shulkers > 1) {
            ins.push(`You will need ${Math.ceil(shulkers)} shulker boxes to easily transport these materials.`);
        }

        $('out-insights').innerHTML = `<ul class="list-unstyled mb-0">${ins.map(i=>`<li class="mb-2 d-flex align-items-start"><i class="fas fa-cubes text-success me-2 mt-1"></i><span>${i}</span></li>`).join('')}</ul>`;
    }

    [shapeE, radE, stackE, fillE].forEach(el => {
        el.addEventListener('input', calculate);
        el.addEventListener('change', calculate);
    });

    $('mc-calc-btn').addEventListener('click', calculate);

    document.querySelectorAll('.mc-quick').forEach(btn => {
        btn.addEventListener('click', ()=>{
            shapeE.value = btn.dataset.s;
            radE.value = btn.dataset.r;
            fillE.checked = btn.dataset.f == "1";
            calculate();
        });
    });

    $('mc-reset').addEventListener('click', ()=>{
        shapeE.value = '2d'; radE.value = 10; stackE.value = 64; fillE.checked = false;
        calculate();
    });

    $('mc-copy-btn').addEventListener('click', function(){
        const b = fillE.checked ? "Solid" : "Hollow";
        const text = `Minecraft Blueprint Info:\nShape: ${shapeE.options[shapeE.selectedIndex].text} (${b}, r=${radE.value})\nTotal Blocks: ${$('out-blocks').textContent}\nStacks Needed: ${$('out-stacks').textContent}\nShulkers Needed: ${$('out-shulker').textContent}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2 text-success"></i> Copied!'; setTimeout(()=>this.innerHTML=o,2000);
        });
    });

    calculate();
});
</script>

<style>
.minecraft-calculator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2.5rem;box-shadow:0 8px 48px rgba(34,197,94,.05)}
.minecraft-calculator-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2.5rem}
.minecraft-calculator-rebuilt .calculator-header h4{margin:0;font-weight:900;color:#0f172a;letter-spacing:-1px;font-size:1.5rem}
.minecraft-calculator-rebuilt .calculator-header p{margin:0;font-size:1rem;color:#64748b;line-height:1.6}
.minecraft-calculator-rebuilt .tool-icon-circle{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.minecraft-calculator-rebuilt .form-label-custom{font-size:.70rem;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:1px;margin-bottom:.5rem;display:block}

.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08); transition: all 0.3s ease;}
.output-hero{text-align:center;padding:1.5rem 0;border-bottom:2px solid rgba(0,0,0,.04);margin-bottom:2rem}
.output-hero-label{display:block;font-size:.85rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;margin-bottom:0.5rem; color:var(--tool-color);}
.output-hero-value{font-weight:900;line-height:1; letter-spacing: -2px; color:#0f172a;}
.stat-card{background:#fff;border:1px solid #f1f5f9;border-radius:12px;padding:1.5rem;text-align:center;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);height:100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02);}
.stat-card:hover { transform: translateY(-3px); }
.stat-card-label{display:block;font-size:.60rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-bottom:5px;}
.stat-card-value{font-weight:900;display:block;line-height:1.2; font-size:1.6rem; letter-spacing: -1px;}

@media (max-width: 768px) {
    .minecraft-calculator-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3rem !important; }
}
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\minecraft-circle-calculator.blade.php ENDPATH**/ ?>