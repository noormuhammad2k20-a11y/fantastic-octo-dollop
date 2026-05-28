<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-sync-alt"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Portfolio Rebalancing Tool</h1>
                <p class="text-sm text-slate-500 m-0">Realign your portfolio to its original target allocations.</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 pb-4 border-b border-gray-100">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">New Cash Contribution ($)</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-amber-500 transition-colors">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-r border-slate-200"><i class="fas fa-plus"></i></span>
                    <input type="number" id="prb-cash" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" value="0" min="0">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto mb-4 border border-slate-200 rounded-xl">
            <table class="w-full text-left border-collapse min-w-[500px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-1/3">Asset Name</th>
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-1/3">Current ($)</th>
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-1/4">Target (%)</th>
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-12 text-center"></th>
                    </tr>
                </thead>
                <tbody id="prb-assets-body">
                    <!-- Rows generated via JS -->
                </tbody>
            </table>
        </div>
        <div class="flex justify-between items-center mb-4">
            <button type="button" onclick="addPrbRow()" class="text-sm font-bold text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 py-1.5 px-3 rounded-lg transition-colors">
                <i class="fas fa-plus me-1"></i> Add Asset
            </button>
            <div class="text-sm font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                Target Sum: <span id="prb-target-sum" class="text-slate-900">100%</span>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-2">
            <button type="button" onclick="calcPrb()" class="flex-grow bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors min-w-[140px]">
                <i class="fas fa-bolt me-1"></i> Run Rebalance
            </button>
            <button type="button" onclick="resetPrb()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div id="prb-output-card" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-amber-500 transition-colors duration-300">
        <div class="text-center pb-4 border-b border-gray-100 mb-4">
            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">New Total Portfolio Value</span>
            <div class="text-3xl font-extrabold text-amber-500 leading-none" id="out-prb-total">$0.00</div>
        </div>
        
        <div class="overflow-x-auto border border-slate-200 rounded-xl">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="p-3 font-bold text-slate-600">Asset</th>
                        <th class="p-3 font-bold text-slate-600 text-right">Current %</th>
                        <th class="p-3 font-bold text-slate-600 text-right">Action Needed</th>
                        <th class="p-3 font-bold text-slate-600 text-right">New ($)</th>
                    </tr>
                </thead>
                <tbody id="out-prb-results">
                    <!-- Results populated via JS -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
let prbRows = [
    { name: 'US Equities', value: 65000, target: 50 },
    { name: 'Intl Equities', value: 15000, target: 20 },
    { name: 'Fixed Income', value: 20000, target: 30 }
];

function renderPrbRows() {
    const tbody = document.getElementById('prb-assets-body');
    tbody.innerHTML = '';
    let sum = 0;
    prbRows.forEach((row, idx) => {
        sum += row.target;
        const tr = document.createElement('tr');
        tr.className = 'border-b border-slate-100 last:border-0';
        tr.innerHTML = `
            <td class="p-2"><input type="text" class="w-full bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm font-bold text-slate-800" value="${row.name}" onchange="updatePrbRow(${idx}, 'name', this.value)"></td>
            <td class="p-2"><input type="number" class="w-full bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm font-bold text-slate-800" value="${row.value}" min="0" onchange="updatePrbRow(${idx}, 'value', this.value)"></td>
            <td class="p-2"><input type="number" class="w-full bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm font-bold text-slate-800" value="${row.target}" min="0" max="100" onchange="updatePrbRow(${idx}, 'target', this.value)"></td>
            <td class="p-2 text-center"><button class="text-slate-400 hover:text-red-500 transition-colors" onclick="removePrbRow(${idx})"><i class="fas fa-times"></i></button></td>
        `;
        tbody.appendChild(tr);
    });
    
    const sumEl = document.getElementById('prb-target-sum');
    sumEl.innerText = sum + '%';
    sumEl.className = sum === 100 ? 'text-emerald-600' : 'text-red-600';
}

function updatePrbRow(idx, field, val) {
    prbRows[idx][field] = field === 'name' ? val : (parseFloat(val) || 0);
    renderPrbRows();
    calcPrb();
}

function addPrbRow() {
    prbRows.push({ name: 'New Asset', value: 0, target: 0 });
    renderPrbRows();
    calcPrb();
}

function removePrbRow(idx) {
    if(prbRows.length > 1) {
        prbRows.splice(idx, 1);
        renderPrbRows();
        calcPrb();
    }
}

function calcPrb() {
    let currentTotal = 0;
    let targetSum = 0;
    const cashAdd = parseFloat(document.getElementById('prb-cash').value) || 0;

    prbRows.forEach(row => { currentTotal += row.value; targetSum += row.target; });
    const newTotal = currentTotal + cashAdd;
    
    document.getElementById('out-prb-total').innerText = newTotal.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    
    const resTbody = document.getElementById('out-prb-results');
    resTbody.innerHTML = '';
    
    if (targetSum !== 100) {
        resTbody.innerHTML = '<tr><td colspan="4" class="p-4 text-center text-red-500 font-bold">Target allocations must sum to 100%.</td></tr>';
        return;
    }

    prbRows.forEach(row => {
        const currentPct = currentTotal > 0 ? (row.value / currentTotal) * 100 : 0;
        const targetValue = newTotal * (row.target / 100);
        const diff = targetValue - row.value;
        const isBuy = diff > 0;
        const diffStr = Math.abs(diff).toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        
        let actionHtml = '';
        if (Math.abs(diff) < 0.01) {
            actionHtml = '<span class="text-slate-400 font-bold">Hold</span>';
        } else if (isBuy) {
            actionHtml = `<span class="text-emerald-600 font-bold">+ ${diffStr}</span>`;
        } else {
            actionHtml = `<span class="text-red-600 font-bold">- ${diffStr}</span>`;
        }

        const tr = document.createElement('tr');
        tr.className = 'border-b border-slate-100 last:border-0';
        tr.innerHTML = `
            <td class="p-3 font-bold text-slate-800">${row.name}</td>
            <td class="p-3 text-slate-600 text-right">${currentPct.toFixed(1)}%</td>
            <td class="p-3 text-right">${actionHtml}</td>
            <td class="p-3 font-bold text-slate-700 text-right">${targetValue.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</td>
        `;
        resTbody.appendChild(tr);
    });
}

function resetPrb() {
    document.getElementById('prb-cash').value = 0;
    prbRows = [
        { name: 'US Equities', value: 65000, target: 50 },
        { name: 'Intl Equities', value: 15000, target: 20 },
        { name: 'Fixed Income', value: 20000, target: 30 }
    ];
    renderPrbRows();
    calcPrb();
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('prb-cash').addEventListener('input', calcPrb);
    renderPrbRows();
    calcPrb();
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\portfolio-rebalancing-tool.blade.php ENDPATH**/ ?>