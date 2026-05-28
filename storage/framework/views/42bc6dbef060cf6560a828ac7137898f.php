<div class="row g-4 cava-rebuilt">
    
    <div class="col-lg-8">
        <div class="calculator-card h-100">
            
            
            <div class="calculator-body pb-2">
                <div class="menu-sections">
                    
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-success"><i class="fas fa-layer-group me-2"></i>Step 1: Bases</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Saffron Basmati" data-cal="170" data-pro="4" data-fat="3" data-carb="34">Saffron Basmati</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Brown Rice" data-cal="170" data-pro="4" data-fat="3" data-carb="34">Brown Rice</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Black Lentils" data-cal="140" data-pro="9" data-fat="1" data-carb="24">Black Lentils</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Splendid Greens" data-cal="15" data-pro="1" data-fat="0" data-carb="3">Splendid Greens</button>
                        </div>
                    </div>

                    
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-success"><i class="fas fa-meat me-2"></i>Step 2: Proteins</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Grilled Chicken" data-cal="160" data-pro="31" data-fat="4" data-carb="1">Grilled Chicken</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Harissa Chicken" data-cal="200" data-pro="29" data-fat="7" data-carb="5">Harissa Chicken</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Grilled Steak" data-cal="160" data-pro="21" data-fat="8" data-carb="1">Grilled Steak</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Lamb Meatballs" data-cal="230" data-pro="15" data-fat="17" data-carb="5">Lamb Meatballs</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Falafel" data-cal="250" data-pro="8" data-fat="14" data-carb="24">Falafel (3)</button>
                        </div>
                    </div>

                    
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-success"><i class="fas fa-cheese me-2"></i>Step 3: Dips & Spreads</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Hummus" data-cal="50" data-pro="2" data-fat="3.5" data-carb="4">Hummus</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Crazy Feta" data-cal="70" data-pro="3" data-fat="6" data-carb="1">Crazy Feta</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Harissa" data-cal="50" data-pro="1" data-fat="4" data-carb="3">Harissa</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Tzatziki" data-cal="30" data-pro="1" data-fat="2" data-carb="2">Tzatziki</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Roasted Eggplant" data-cal="40" data-pro="1" data-fat="3" data-carb="3">Roasted Eggplant</button>
                        </div>
                    </div>

                    
                    <div>
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-success"><i class="fas fa-tint me-2"></i>Step 4: Dressings</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Lemon Tahini" data-cal="100" data-pro="3" data-fat="9" data-carb="3">Lemon Tahini</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Garlic Dressing" data-cal="120" data-pro="0" data-fat="13" data-carb="1">Garlic Dressing</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Yogurt Dill" data-cal="30" data-pro="1" data-fat="2" data-carb="2">Yogurt Dill</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Sriracha Greek" data-cal="40" data-pro="1" data-fat="3" data-carb="3">Sriracha Greek</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="output-card-themed h-100" style="--tool-hue:150;--tool-color:#059669;--tool-bg:rgba(16,185,129,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total Calories</span>
                <div class="output-hero-value" id="total-calories">0</div>
                <div class="badge rounded-pill px-4 py-2 mt-2" style="background:rgba(16,185,129,.1);color:#059669;font-weight:700">Cava Bowl Summary</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3">Order Contents</h6>
                <div id="order-items" class="list-group list-group-flush small mb-4">
                    <div class="text-muted italic px-2">Select items to begin...</div>
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

                <button class="btn d-block mx-auto btn-emerald fw-bold text-white py-3 px-5 fw-bold rounded-pill shadow-sm"" id="clear-order" style="min-width: 280px; max-width: 100%; background:#059669"><i class="fas fa-sync-alt me-2"></i>Clear Selection</button>
                <button class="btn btn-outline-dark w-100 py-2 mt-2 fw-bold rounded-3" id="copy-summary" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-2"></i>Copy Nutrition</button>
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
            list.innerHTML = '<div class="text-muted italic px-2">Select items to begin...</div>';
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
            div.className = 'list-group-item bg-transparent d-flex justify-content-between align-items-center p-2 border-0';
            div.innerHTML = `<span><i class="fas fa-check-circle text-success me-2 x-small"></i>${item.name}</span>
                             <button class="btn btn-link btn-sm text-secondary p-0" onclick="removeItem(${idx})"><i class="fas fa-times"></i></button>`;
            list.appendChild(div);
        });

        $('total-calories').textContent = cal.toLocaleString();
        $('total-protein').textContent = pro + 'g';
        $('total-fat').textContent = fat.toFixed(1) + 'g';
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
            btn.style.borderColor = '#059669';
            btn.style.color = '#059669';
            setTimeout(() => {
                btn.style.borderColor = '';
                btn.style.color = '';
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
        const text = `Cava Bowl Nutrition\nCalories: ${$('total-calories').textContent}\nP: ${$('total-protein').textContent}, F: ${$('total-fat').textContent}, C: ${$('total-carbs').textContent}\nItems: ${orderItems.map(i=>i.name).join(', ')}\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    };
});
</script>

<style>
.cava-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2rem;box-shadow:0 8px 30px rgba(0,0,0,.04)}
.cava-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.cava-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.cava-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.cava-rebuilt .item-btn{border-radius:10px; font-weight:600; padding: .5rem 1rem; transition: all .2s; border-color: #e2e8f0; color: #64748b}
.cava-rebuilt .item-btn:hover{background: #f0fdf4; border-color: #10b981; color: #059669; transform: translateY(-1px)}
.cava-rebuilt .x-small{font-size:.7rem}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\cava-nutrition-calculator.blade.php ENDPATH**/ ?>