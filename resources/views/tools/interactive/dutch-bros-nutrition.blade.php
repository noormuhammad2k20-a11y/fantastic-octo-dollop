<div class="row g-4 dutch-rebuilt">
    {{-- ═══════ MENU PANEL ═══════ --}}
    <div class="col-lg-8">
        <div class="calculator-card h-100">
            
            
            <div class="calculator-body pb-2">
                <div class="menu-sections">
                    {{-- Drink Bases --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary"><i class="fas fa-glass-whiskey me-2"></i>Step 1: Choose Base Drink</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Golden Eagle" data-cal="480" data-pro="10" data-fat="22" data-carb="60">Golden Eagle</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Caramelizer" data-cal="480" data-pro="9" data-fat="20" data-carb="65">Caramelizer</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Annihilator" data-cal="470" data-pro="9" data-fat="21" data-carb="61">Annihilator</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Blue Rebel" data-cal="240" data-pro="0" data-fat="0" data-carb="60">Blue Rebel</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Nitro Cold Brew" data-cal="20" data-pro="1" data-fat="0" data-carb="3">Nitro Cold Brew</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Dutch Frost" data-cal="450" data-pro="8" data-fat="18" data-carb="62">Dutch Frost</button>
                        </div>
                    </div>

                    {{-- Sizes --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary"><i class="fas fa-expand-arrows-alt me-2"></i>Step 2: Adjust Size</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary size-btn active" data-mult="1.0" id="size-medium" style="min-width: 280px; max-width: 100%;">Medium (Standard)</button>
                             <button class="btn btn-sm btn-outline-secondary size-btn" data-mult="0.75" id="size-small" style="min-width: 280px; max-width: 100%;">Small (-25%)</button>
                             <button class="btn btn-sm btn-outline-secondary size-btn" data-mult="1.5" id="size-large" style="min-width: 280px; max-width: 100%;">Large (+50%)</button>
                        </div>
                    </div>

                    {{-- Options/Add-ins --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary"><i class="fas fa-plus me-2"></i>Step 3: Add-Ins & Milk</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Soft Top" data-cal="50" data-pro="0" data-fat="4" data-carb="4">Soft Top</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Extra Shot" data-cal="5" data-pro="0" data-fat="0" data-carb="1">Extra Espresso</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Oat Milk" data-cal="40" data-pro="1" data-fat="2" data-carb="6">Oat Milk Swap</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Whip Cream" data-cal="70" data-pro="1" data-fat="7" data-carb="2">Whipped Cream</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Caramel Driz" data-cal="30" data-pro="0" data-fat="1" data-carb="6">Caramel Drizzle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ ORDER SUMMARY ═══════ --}}
    <div class="col-lg-4">
        <div class="output-card-themed h-100" style="--tool-hue:220;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total Calories</span>
                <div class="output-hero-value" id="total-calories">0</div>
                <div class="badge rounded-pill px-4 py-2 mt-2" style="background:#dbeafe;color:#1e40af;font-weight:700">Your Dutch Bros Order</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3">Order Composition</h6>
                <div id="order-items" class="list-group list-group-flush small mb-4">
                    <div class="text-muted italic px-2">Pick a base drink to start...</div>
                </div>

                <div class="row g-2 mb-4">
                    <div class="col-4">
                        <div class="p-2 border rounded-3 bg-white text-center">
                            <div class="x-small text-muted fw-bold">Protein</div>
                            <div class="fw-bold text-dark" id="total-protein">0g</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 border rounded-3 bg-white text-center">
                            <div class="x-small text-muted fw-bold">Fat</div>
                            <div class="fw-bold text-dark" id="total-fat">0g</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 border rounded-3 bg-white text-center">
                            <div class="x-small text-muted fw-bold">Carbs</div>
                            <div class="fw-bold text-dark" id="total-carbs">0g</div>
                        </div>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary py-3 px-5 fw-bold rounded-pill shadow-sm" id="clear-order" style="min-width: 280px; max-width: 100%;"><i class="fas fa-redo me-2"></i>Reset Drink</button>
                <button class="btn btn-outline-primary w-100 py-2 mt-2 fw-bold rounded-3 border-2" id="copy-summary" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Summary</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const orderItems = [];
    let sizeMult = 1.0;
    const $=id=>document.getElementById(id);

    function updateOrder(){
        const list = $('order-items');
        if(orderItems.length === 0){
            list.innerHTML = '<div class="text-muted italic px-2">Pick a base drink to start...</div>';
            $('total-calories').textContent = '0';
            $('total-protein').textContent = '0g';
            $('total-fat').textContent = '0g';
            $('total-carbs').textContent = '0g';
            return;
        }

        let cal=0, pro=0, fat=0, carb=0;
        list.innerHTML = '';
        
        orderItems.forEach((item, idx) => {
            // Only apply size multiplier to the first (base) item
            const mult = (idx === 0) ? sizeMult : 1.0;
            
            cal += (item.cal * mult);
            pro += (item.pro * mult);
            fat += (item.fat * mult);
            carb += (item.carb * mult);

            const div = document.createElement('div');
            div.className = 'list-group-item bg-transparent d-flex justify-content-between align-items-center p-2 border-0';
            div.innerHTML = `<span><i class="fas fa-check text-primary me-2 x-small"></i>${item.name}</span>
                             <button class="btn btn-link btn-sm text-muted p-0" onclick="removeItem(${idx})"><i class="fas fa-minus-circle"></i></button>`;
            list.appendChild(div);
        });

        $('total-calories').textContent = Math.round(cal).toLocaleString();
        $('total-protein').textContent = Math.round(pro) + 'g';
        $('total-fat').textContent = Math.round(fat) + 'g';
        $('total-carbs').textContent = Math.round(carb) + 'g';
    }

    document.querySelectorAll('.item-btn').forEach(btn => {
        btn.onclick = () => {
            const item = {
                name: btn.dataset.name,
                cal: parseInt(btn.dataset.cal),
                pro: parseInt(btn.dataset.pro),
                fat: parseFloat(btn.dataset.fat),
                carb: parseInt(btn.dataset.carb)
            };
            orderItems.push(item);
            updateOrder();
            
            btn.classList.add('pulse-blue');
            setTimeout(() => btn.classList.remove('pulse-blue'), 400);
        };
    });

    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.onclick = () => {
            sizeMult = parseFloat(btn.dataset.mult);
            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active', 'btn-primary'));
            btn.classList.add('active', 'btn-primary');
            updateOrder();
        };
    });

    window.removeItem = (idx) => {
        orderItems.splice(idx, 1);
        updateOrder();
    };

    $('clear-order').onclick = () => {
        orderItems.length = 0;
        updateOrder();
    };

    $('copy-summary').onclick = function(){
        if(orderItems.length === 0) return;
        const text = `Dutch Bros Order\nCalories: ${$('total-calories').textContent}\nMacros: P:${$('total-protein').textContent}, F:${$('total-fat').textContent}, C:${$('total-carbs').textContent}\nOrder: ${orderItems.map(i=>i.name).join(', ')}\n— ToolsHub Nutrition`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    };
});
</script>

<style>
.dutch-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2rem;box-shadow:0 8px 30px rgba(0,0,0,.04)}
.dutch-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.dutch-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.dutch-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.dutch-rebuilt .item-btn, .dutch-rebuilt .size-btn {border-radius:10px; font-weight:600; padding: .5rem 1rem; transition: all .2s; border-color: #e2e8f0; color: #64748b}
.dutch-rebuilt .item-btn:hover, .dutch-rebuilt .size-btn:hover {background: #eff6ff; border-color: #3b82f6; color: #2563eb; transform: translateY(-1px)}
.dutch-rebuilt .size-btn.active {background: #2563eb !important; color: #fff !important; border-color: #2563eb !important}
.dutch-rebuilt .pulse-blue { animation: pulse-blue 0.4s ease-out; }
@keyframes pulse-blue { 0% { transform: scale(1); } 50% { transform: scale(1.05); background:#dbeafe; } 100% { transform: scale(1); } }
.dutch-rebuilt .x-small{font-size:.7rem}
</style>
