<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-balance-scale"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Portfolio Risk Analyzer</h1>
                <p class="text-sm text-slate-500 m-0">Evaluate your overall portfolio beta and risk classification.</p>
            </div>
        </div>
        
        <div class="overflow-x-auto mb-4 border border-slate-200 rounded-xl">
            <table class="w-full text-left border-collapse min-w-[500px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-1/3">Asset Name</th>
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-1/3">Value ($)</th>
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-1/4">Beta (Risk)</th>
                        <th class="p-3 text-xs font-bold text-slate-600 uppercase tracking-wide w-12 text-center"></th>
                    </tr>
                </thead>
                <tbody id="pra-assets-body">
                    <!-- Rows generated via JS -->
                </tbody>
            </table>
        </div>
        <div class="flex gap-2">
            <button type="button" onclick="addPraRow()" class="text-sm font-bold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 py-1.5 px-3 rounded-lg transition-colors">
                <i class="fas fa-plus me-1"></i> Add Asset
            </button>
        </div>

        <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-2">
            <button type="button" onclick="calcPra()" class="flex-grow bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors min-w-[140px]">
                <i class="fas fa-bolt me-1"></i> Run Analysis
            </button>
            <button type="button" onclick="setPraPreset('aggressive')" class="flex-grow bg-white border border-slate-200 hover:border-blue-500 hover:bg-blue-50 text-slate-600 hover:text-blue-600 text-sm font-bold py-2 px-3 rounded-xl transition-colors">
                Aggressive Preset
            </button>
            <button type="button" onclick="setPraPreset('conservative')" class="flex-grow bg-white border border-slate-200 hover:border-blue-500 hover:bg-blue-50 text-slate-600 hover:text-blue-600 text-sm font-bold py-2 px-3 rounded-xl transition-colors">
                Conservative Preset
            </button>
            <button type="button" onclick="resetPra()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center shrink-0">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div id="pra-output-card" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-blue-500 transition-colors duration-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="text-center md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Portfolio Beta</span>
                <div class="flex items-baseline justify-center gap-1">
                    <h2 id="out-pra-beta" class="text-4xl md:text-5xl font-extrabold text-blue-600 tracking-tight m-0">1.00</h2>
                </div>
                <div id="out-pra-risk" class="inline-block mt-3 px-4 py-1.5 rounded-full text-sm font-bold bg-blue-50 text-blue-700 border border-blue-100">
                    Average Risk
                </div>
            </div>
            <div class="grid grid-cols-1 gap-3 pl-0 md:pl-2">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Total Portfolio Value</span>
                    <span id="out-pra-total" class="text-xl md:text-2xl font-extrabold text-slate-800">$0.00</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let praRows = [
    { name: 'S&P 500 ETF', value: 50000, beta: 1.0 },
    { name: 'Tech Stock', value: 20000, beta: 1.5 },
    { name: 'Bonds', value: 30000, beta: 0.1 }
];

function renderPraRows() {
    const tbody = document.getElementById('pra-assets-body');
    tbody.innerHTML = '';
    praRows.forEach((row, idx) => {
        const tr = document.createElement('tr');
        tr.className = 'border-b border-slate-100 last:border-0';
        tr.innerHTML = `
            <td class="p-2"><input type="text" class="w-full bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm font-bold text-slate-800" value="${row.name}" onchange="updatePraRow(${idx}, 'name', this.value)"></td>
            <td class="p-2"><input type="number" class="w-full bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm font-bold text-slate-800" value="${row.value}" min="0" onchange="updatePraRow(${idx}, 'value', this.value)"></td>
            <td class="p-2"><input type="number" class="w-full bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm font-bold text-slate-800" value="${row.beta}" step="0.1" onchange="updatePraRow(${idx}, 'beta', this.value)"></td>
            <td class="p-2 text-center"><button class="text-slate-400 hover:text-red-500 transition-colors" onclick="removePraRow(${idx})"><i class="fas fa-times"></i></button></td>
        `;
        tbody.appendChild(tr);
    });
}

function updatePraRow(idx, field, val) {
    praRows[idx][field] = field === 'name' ? val : (parseFloat(val) || 0);
    calcPra();
}

function addPraRow() {
    praRows.push({ name: 'New Asset', value: 10000, beta: 1.0 });
    renderPraRows();
    calcPra();
}

function removePraRow(idx) {
    if(praRows.length > 1) {
        praRows.splice(idx, 1);
        renderPraRows();
        calcPra();
    }
}

function calcPra() {
    let totalValue = 0;
    let weightedBeta = 0;
    praRows.forEach(row => { totalValue += row.value; });
    
    if(totalValue > 0) {
        praRows.forEach(row => {
            const weight = row.value / totalValue;
            weightedBeta += weight * row.beta;
        });
    }

    let riskLevel = 'Market Risk';
    let colorClass = 'text-blue-600';
    let bgClass = 'bg-blue-50 text-blue-700 border-blue-100';
    let borderClass = 'border-t-blue-500';

    if(weightedBeta < 0.8) {
        riskLevel = 'Conservative'; colorClass = 'text-emerald-600'; bgClass = 'bg-emerald-50 text-emerald-700 border-emerald-100'; borderClass = 'border-t-emerald-500';
    } else if(weightedBeta > 1.2) {
        riskLevel = 'Aggressive'; colorClass = 'text-red-600'; bgClass = 'bg-red-50 text-red-700 border-red-100'; borderClass = 'border-t-red-500';
    } else {
        riskLevel = 'Moderate';
    }

    document.getElementById('out-pra-beta').innerText = weightedBeta.toFixed(2);
    document.getElementById('out-pra-beta').className = `text-4xl md:text-5xl font-extrabold tracking-tight m-0 ${colorClass}`;
    document.getElementById('pra-output-card').className = `bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 transition-colors duration-300 ${borderClass}`;
    
    document.getElementById('out-pra-risk').innerText = riskLevel;
    document.getElementById('out-pra-risk').className = `inline-block mt-3 px-4 py-1.5 rounded-full text-sm font-bold border ${bgClass}`;
    
    document.getElementById('out-pra-total').innerText = totalValue.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
}

function setPraPreset(type) {
    if(type === 'aggressive') {
        praRows = [{ name: 'Tech ETF', value: 80000, beta: 1.4 }, { name: 'Crypto', value: 20000, beta: 2.5 }];
    } else {
        praRows = [{ name: 'Bonds', value: 70000, beta: 0.2 }, { name: 'S&P 500', value: 30000, beta: 1.0 }];
    }
    renderPraRows();
    calcPra();
}

function resetPra() {
    praRows = [
        { name: 'S&P 500 ETF', value: 50000, beta: 1.0 },
        { name: 'Tech Stock', value: 20000, beta: 1.5 },
        { name: 'Bonds', value: 30000, beta: 0.1 }
    ];
    renderPraRows();
    calcPra();
}

document.addEventListener('DOMContentLoaded', () => {
    renderPraRows();
    calcPra();
});
</script>
