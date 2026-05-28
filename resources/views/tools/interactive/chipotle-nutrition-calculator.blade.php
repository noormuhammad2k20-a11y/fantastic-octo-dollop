<div class="row g-4 chipotle-rebuilt">
    {{-- ═══════ MENU PANEL ═══════ --}}
    <div class="col-lg-8">
        <div class="calculator-card h-100">
            
            
            <div class="calculator-body pb-2">
                <div class="menu-sections">
                    {{-- Bases --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2"><i class="fas fa-layer-group me-2 text-danger"></i>Step 1: Bases</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="White Rice" data-cal="210" data-pro="4" data-fat="4" data-carb="40">White Rice</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Brown Rice" data-cal="210" data-pro="4" data-fat="6" data-carb="36">Brown Rice</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Salad Greens" data-cal="15" data-pro="1" data-fat="0" data-carb="3">Salad Greens</button>
                        </div>
                    </div>

                    {{-- Proteins --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2"><i class="fas fa-meat me-2 text-danger"></i>Step 2: Proteins</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Chicken" data-cal="180" data-pro="32" data-fat="7" data-carb="0">Chicken</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Steak" data-cal="150" data-pro="21" data-fat="6" data-carb="1">Steak</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Barbacoa" data-cal="170" data-pro="24" data-fat="7" data-carb="2">Barbacoa</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Carnitas" data-cal="210" data-pro="23" data-fat="12" data-carb="0">Carnitas</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Sofritas" data-cal="150" data-pro="8" data-fat="10" data-carb="9">Sofritas</button>
                        </div>
                    </div>

                    {{-- Beans --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2"><i class="fas fa-seedling me-2 text-danger"></i>Step 3: Beans</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Black Beans" data-cal="130" data-pro="8" data-fat="1.5" data-carb="22">Black Beans</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Pinto Beans" data-cal="130" data-pro="8" data-fat="1.5" data-carb="21">Pinto Beans</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="No Beans" data-cal="0" data-pro="0" data-fat="0" data-carb="0">Skip Beans</button>
                        </div>
                    </div>

                    {{-- Toppings --}}
                    <div>
                        <h6 class="fw-bold mb-3 border-bottom pb-2"><i class="fas fa-plus-circle me-2 text-danger"></i>Step 4: Toppings & Salsa</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Guacamole" data-cal="230" data-pro="2" data-fat="22" data-carb="8">Guacamole</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Fresh Tomato Salsa" data-cal="25" data-pro="0" data-fat="0" data-carb="4">Tomato Salsa</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Roasted Corn Salsa" data-cal="80" data-pro="3" data-fat="1.5" data-carb="16">Corn Salsa</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Sour Cream" data-cal="110" data-pro="2" data-fat="9" data-carb="2">Sour Cream</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Cheese" data-cal="110" data-pro="6" data-fat="8" data-carb="1">Cheese</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Queso Blanco" data-cal="120" data-pro="5" data-fat="10" data-carb="4">Queso Blanco</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ ORDER SUMMARY ═══════ --}}
    <div class="col-lg-4">
        <div class="output-card-themed h-100" style="--tool-hue:0;--tool-color:#b91c1c;--tool-bg:rgba(185,28,28,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total Calories</span>
                <div class="output-hero-value" id="total-calories">0</div>
                <div class="badge rounded-pill px-4 py-2 mt-2" style="background:rgba(185,28,28,.1);color:#b91c1c;font-weight:700">Your Current Bowl</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3">Order Contents</h6>
                <div id="order-items" class="list-group list-group-flush small mb-4">
                    <div class="text-muted italic px-2">No items selected yet...</div>
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

                <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="clear-order" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash-alt me-2"></i>Reset Bowl</button>
                <button class="btn btn-outline-danger w-100 py-2 mt-2 fw-bold rounded-3 border-2" id="copy-summary" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Summary</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const orderItems = [];
    const $=id=>document.getElementById(id);

    function updateOrder(){
        const list = $('order-items');
        if(orderItems.length === 0){
            list.innerHTML = '<div class="text-muted italic px-2">No items selected yet...</div>';
            $('total-calories').textContent = '0';
            $('total-protein').textContent = '0g';
            $('total-fat').textContent = '0g';
            $('total-carbs').textContent = '0g';
            return;
        }

        let cal=0, pro=0, fat=0, carb=0;
        list.innerHTML = '';
        
        orderItems.forEach((item, idx) => {
            cal += item.cal;
            pro += item.pro;
            fat += item.fat;
            carb += item.carb;

            const div = document.createElement('div');
            div.className = 'list-group-item bg-transparent d-flex justify-content-between align-items-center p-2';
            div.innerHTML = `<span>${item.name} <small class="text-muted">(${item.cal} cal)</small></span>
                             <button class="btn btn-link btn-sm text-danger p-0" onclick="removeItem(${idx})"><i class="fas fa-times-circle"></i></button>`;
            list.appendChild(div);
        });

        $('total-calories').textContent = cal.toLocaleString();
        $('total-protein').textContent = pro + 'g';
        $('total-fat').textContent = fat + 'g';
        $('total-carbs').textContent = carb + 'g';
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
            
            // Visual feedback
            const originalText = btn.innerHTML;
            btn.classList.replace('btn-outline-secondary', 'btn-danger');
            setTimeout(() => {
                btn.classList.replace('btn-danger', 'btn-outline-secondary');
            }, 300);
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
        const text = `Chipotle Order Summary\nTotal Calories: ${$('total-calories').textContent}\nMacros: P: ${$('total-protein').textContent}, F: ${$('total-fat').textContent}, C: ${$('total-carbs').textContent}\nItems: ${orderItems.map(i=>i.name).join(', ')}\n— ToolsHub Nutrition`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    };
});
</script>

<style>
.chipotle-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2rem;box-shadow:0 8px 30px rgba(0,0,0,.04)}
.chipotle-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.chipotle-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.chipotle-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.chipotle-rebuilt .item-btn{border-radius:10px; font-weight:600; padding: .5rem 1rem; transition: all .2s}
.chipotle-rebuilt .item-btn:hover{transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.08)}
.chipotle-rebuilt .x-small{font-size:.7rem}
</style>
