<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-pie-chart"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Asset Allocation Tool</h1>
                <p class="text-sm text-slate-500 m-0">Determine exactly how much to buy or sell to reach your target allocation.</p>
            </div>
        </div>
        
        <div class="overflow-x-auto mb-4 border border-slate-200 rounded-xl">
            <table class="w-full text-left border-collapse min-w-[500px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-1/3">Asset Class</th>
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-1/3">Current ($)</th>
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-1/4">Target (%)</th>
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-12 text-center"></th>
                    </tr>
                </thead>
                <tbody id="aa-assets-body">
                    <!-- Rows generated via JS -->
                </tbody>
            </table>
        </div>
        <div class="flex justify-between items-center mb-4">
            <button type="button" onclick="addAaRow()" class="text-sm font-bold text-violet-600 hover:text-violet-700 bg-violet-50 hover:bg-violet-100 py-1.5 px-3 rounded-lg transition-colors">
                <i class="fas fa-plus me-1"></i> Add Asset
            </button>
            <div class="text-sm font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                Total Target: <span id="aa-target-sum" class="text-slate-900">100%</span>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-2">
            <button type="button" onclick="calcAa()" class="flex-grow bg-violet-600 hover:bg-violet-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors min-w-[140px]">
                <i class="fas fa-bolt me-1"></i> Run Analysis
            </button>
            <button type="button" onclick="resetAa()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div id="aa-output-card" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-violet-500 transition-colors duration-300">
        <div class="text-center pb-4 border-b border-gray-100 mb-4">
            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Total Portfolio Value</span>
            <div class="text-3xl font-extrabold text-violet-600 leading-none" id="out-aa-total">$0.00</div>
        </div>
        
        <div class="overflow-x-auto border border-slate-200 rounded-xl">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="p-3 font-bold text-slate-600">Asset</th>
                        <th class="p-3 font-bold text-slate-600 text-right">Target ($)</th>
                        <th class="p-3 font-bold text-slate-600 text-right">Action</th>
                    </tr>
                </thead>
                <tbody id="out-aa-results">
                    <!-- Results populated via JS -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
let aaRows = [
    { name: 'US Stocks', value: 50000, target: 60 },
    { name: 'Intl Stocks', value: 10000, target: 20 },
    { name: 'Bonds', value: 40000, target: 20 }
];

function renderAaRows() {
    const tbody = document.getElementById('aa-assets-body');
    tbody.innerHTML = '';
    let sum = 0;
    aaRows.forEach((row, idx) => {
        sum += row.target;
        const tr = document.createElement('tr');
        tr.className = 'border-b border-slate-100 last:border-0';
        tr.innerHTML = `
            <td class="p-2"><input type="text" class="w-full bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm font-bold text-slate-800" value="${row.name}" onchange="updateAaRow(${idx}, 'name', this.value)"></td>
            <td class="p-2"><input type="number" class="w-full bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm font-bold text-slate-800" value="${row.value}" min="0" onchange="updateAaRow(${idx}, 'value', this.value)"></td>
            <td class="p-2"><input type="number" class="w-full bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm font-bold text-slate-800" value="${row.target}" min="0" max="100" onchange="updateAaRow(${idx}, 'target', this.value)"></td>
            <td class="p-2 text-center"><button class="text-slate-400 hover:text-red-500 transition-colors" onclick="removeAaRow(${idx})"><i class="fas fa-times"></i></button></td>
        `;
        tbody.appendChild(tr);
    });
    
    const sumEl = document.getElementById('aa-target-sum');
    sumEl.innerText = sum + '%';
    sumEl.className = sum === 100 ? 'text-emerald-600' : 'text-red-600';
}

function updateAaRow(idx, field, val) {
    aaRows[idx][field] = field === 'name' ? val : (parseFloat(val) || 0);
    renderAaRows();
    calcAa();
}

function addAaRow() {
    aaRows.push({ name: 'New Asset', value: 0, target: 0 });
    renderAaRows();
    calcAa();
}

function removeAaRow(idx) {
    if(aaRows.length > 1) {
        aaRows.splice(idx, 1);
        renderAaRows();
        calcAa();
    }
}

function calcAa() {
    let totalValue = 0;
    let targetSum = 0;
    aaRows.forEach(row => { totalValue += row.value; targetSum += row.target; });
    
    document.getElementById('out-aa-total').innerText = totalValue.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    
    const resTbody = document.getElementById('out-aa-results');
    resTbody.innerHTML = '';
    
    if (targetSum !== 100) {
        resTbody.innerHTML = '<tr><td colspan="3" class="p-4 text-center text-red-500 font-bold">Target allocations must sum exactly to 100%. Currently: ' + targetSum + '%</td></tr>';
        return;
    }

    aaRows.forEach(row => {
        const targetValue = totalValue * (row.target / 100);
        const diff = targetValue - row.value;
        const isBuy = diff > 0;
        const diffStr = Math.abs(diff).toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        
        let actionHtml = '';
        if (Math.abs(diff) < 0.01) {
            actionHtml = '<span class="text-slate-400 font-bold">Perfect</span>';
        } else if (isBuy) {
            actionHtml = `<span class="text-emerald-600 font-bold">Buy ${diffStr}</span>`;
        } else {
            actionHtml = `<span class="text-red-600 font-bold">Sell ${diffStr}</span>`;
        }

        const tr = document.createElement('tr');
        tr.className = 'border-b border-slate-100 last:border-0';
        tr.innerHTML = `
            <td class="p-3 font-bold text-slate-800">${row.name}</td>
            <td class="p-3 font-bold text-slate-700 text-right">${targetValue.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</td>
            <td class="p-3 text-right">${actionHtml}</td>
        `;
        resTbody.appendChild(tr);
    });
}

function resetAa() {
    aaRows = [
        { name: 'US Stocks', value: 50000, target: 60 },
        { name: 'Intl Stocks', value: 10000, target: 20 },
        { name: 'Bonds', value: 40000, target: 20 }
    ];
    renderAaRows();
    calcAa();
}

document.addEventListener('DOMContentLoaded', () => {
    renderAaRows();
    calcAa();
});
</script>
