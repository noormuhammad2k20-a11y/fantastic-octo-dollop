<div class="row g-4 flamingo-rebuilt">
    {{-- ═══════ MENU PANEL ═══════ --}}
    <div class="col-lg-8">
        <div class="calculator-card h-100">
            
            
            <div class="calculator-body pb-2">
                <div class="menu-sections">
                    {{-- Bases --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-pink"><i class="fas fa-cookie-bite me-2"></i>Step 1: Choose Your Base</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Organic Acai" data-cal="240" data-pro="2" data-fat="15" data-carb="25">Organic Acai</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Pitaya Base" data-cal="220" data-pro="2" data-fat="8" data-carb="35">Pitaya Base</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Coconut Base" data-cal="260" data-pro="3" data-fat="20" data-carb="18">Coconut Base</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Green Base" data-cal="180" data-pro="4" data-fat="2" data-carb="40">Green Base</button>
                        </div>
                    </div>

                    {{-- Fruits --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-pink"><i class="fas fa-apple-alt me-2"></i>Step 2: Add Fresh Fruit</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Strawberries" data-cal="15" data-pro="0" data-fat="0" data-carb="4">Strawberries</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Blueberries" data-cal="20" data-pro="0" data-fat="0" data-carb="5">Blueberries</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Banana" data-cal="60" data-pro="1" data-fat="0" data-carb="15">Banana</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Mango" data-cal="40" data-pro="0" data-fat="0" data-carb="10">Mango</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Pineapple" data-cal="30" data-pro="0" data-fat="0" data-carb="8">Pineapple</button>
                        </div>
                    </div>

                    {{-- Toppings --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-pink"><i class="fas fa-stroopwafel me-2"></i>Step 3: Superfoods & Crunch</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Granola" data-cal="120" data-pro="3" data-fat="5" data-carb="18">Granola</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Coconut Shavings" data-cal="30" data-pro="0" data-fat="3" data-carb="1">Coconut</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Hemp Seeds" data-cal="40" data-pro="3" data-fat="3" data-carb="1">Hemp Seeds</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Cacao Nibs" data-cal="60" data-pro="1" data-fat="6" data-carb="3">Cacao Nibs</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Bee Pollen" data-cal="20" data-pro="1" data-fat="0" data-carb="4">Bee Pollen</button>
                        </div>
                    </div>

                    {{-- Drizzles --}}
                    <div>
                        <h6 class="fw-bold mb-3 border-bottom pb-2 text-pink"><i class="fas fa-tint me-2"></i>Step 4: The Drizzle</h6>
                        <div class="d-flex flex-wrap gap-2">
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Honey" data-cal="60" data-pro="0" data-fat="0" data-carb="17">Honey</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Almond Butter" data-cal="90" data-pro="3" data-fat="8" data-carb="3">Almond Butter</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Peanut Butter" data-cal="90" data-pro="4" data-fat="8" data-carb="3">Peanut Butter</button>
                             <button class="btn btn-sm btn-outline-secondary item-btn" data-name="Nutella" data-cal="100" data-pro="1" data-fat="6" data-carb="11">Nutella</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ ORDER SUMMARY ═══════ --}}
    <div class="col-lg-4">
        <div class="output-card-themed h-100" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Total Calories</span>
                <div class="output-hero-value" id="total-calories">0</div>
                <div class="badge rounded-pill px-4 py-2 mt-2" style="background:#fce7f3;color:#9d174d;font-weight:700">Flamingo Bowl Status</div>
            </div>

            <div class="mt-4">
                <h6 class="fw-bold mb-3">Bowl Ingredients</h6>
                <div id="order-items" class="list-group list-group-flush small mb-4">
                    <div class="text-muted italic px-2">Customize your bowl...</div>
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

                <button class="btn d-block mx-auto btn-pink fw-bold text-white py-3 px-5 fw-bold rounded-pill shadow-sm"" id="clear-order" style="min-width: 280px; max-width: 100%; background:#db2777"><i class="fas fa-trash-restore me-2"></i>Reset Bowl</button>
                <button class="btn btn-outline-pink w-100 py-2 mt-2 fw-bold rounded-3 border-2" id="copy-summary" style="min-width: 280px; max-width: 100%; color:#db2777; border-color:#db2777"><i class="fas fa-copy me-2"></i>Save Details</button>
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
            list.innerHTML = '<div class="text-muted italic px-2">Customize your bowl...</div>';
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
            div.innerHTML = `<span><i class="fas fa-heart text-pink me-2 x-small"></i>${item.name}</span>
                             <button class="btn btn-link btn-sm text-muted p-0" onclick="removeItem(${idx})"><i class="fas fa-times"></i></button>`;
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
            
            btn.style.borderColor = '#db2777';
            btn.style.color = '#db2777';
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
        const text = `Flamingo Bowl Nutrition\nCalories: ${$('total-calories').textContent}\nMacros: P:${$('total-protein').textContent}, F:${$('total-fat').textContent}, C:${$('total-carbs').textContent}\nLevel: Organic & Fresh\n— ToolsHub Health`;
        navigator.clipboard.writeText(text).then(()=>{
            const o=this.innerHTML; this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(()=>this.innerHTML=o, 2000);
        });
    };
});
</script>

<style>
.flamingo-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:24px;padding:2rem;box-shadow:0 8px 30px rgba(0,0,0,.04)}
.flamingo-rebuilt .calculator-header{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.flamingo-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.flamingo-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;flex-shrink:0}
.flamingo-rebuilt .item-btn{border-radius:10px; font-weight:600; padding: .5rem 1rem; transition: all .2s; border-color: #e2e8f0; color: #64748b}
.flamingo-rebuilt .item-btn:hover{background: #fdf2f8; border-color: #ec4899; color: #db2777; transform: translateY(-1px)}
.flamingo-rebuilt .text-pink { color: #db2777; }
.flamingo-rebuilt .x-small{font-size:.7rem}
</style>
