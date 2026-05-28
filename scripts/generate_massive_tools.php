<?php

/**
 * PREMIUM Functional Generator for ToolsHub Interactive Blade Views
 * Generates all 38 tools with interactive charts and tables.
 */

$toolsSchema = [
    // BATCH 1 & 2 & 3 Combined + Cap Rate
    'closing-cost-calculator' => ['name' => 'Closing Cost', 'icon' => 'fas fa-home', 'inputs' => [['id' => 'home-price', 'label' => 'Home Price ($)', 'placeholder' => '300000', 'type' => 'number']], 'outputs' => [['id' => 'legal-fees', 'label' => 'Legal Fees'], ['id' => 'transfer-tax', 'label' => 'Transfer Tax']]],
    'financial-freedom-calculator' => ['name' => 'Financial Freedom', 'icon' => 'fas fa-sun', 'inputs' => [['id' => 'annual-exp', 'label' => 'Annual Expenses ($)', 'placeholder' => '40000', 'type' => 'number'], ['id' => 'safe-w-rate', 'label' => 'Safe Withdrawal (%)', 'placeholder' => '4', 'type' => 'number']], 'outputs' => [['id' => 'fire-number', 'label' => 'FIRE Number']]],
    'emergency-fund-calculator' => ['name' => 'Emergency Fund', 'icon' => 'fas fa-shield-alt', 'inputs' => [['id' => 'monthly-cost', 'label' => 'Monthly Expenses ($)', 'placeholder' => '3000', 'type' => 'number'], ['id' => 'months-cover', 'label' => 'Months Coverage', 'placeholder' => '6', 'type' => 'number']], 'outputs' => [['id' => 'savings-goal', 'label' => 'Savings Goal']]],
    'lease-vs-buy-car-calculator' => ['name' => 'Lease vs Buy Car', 'icon' => 'fas fa-car', 'inputs' => [['id' => 'car-price', 'label' => 'Car Price ($)', 'placeholder' => '35000', 'type' => 'number'], ['id' => 'lease-payment', 'label' => 'Lease Payment ($/mo)', 'placeholder' => '400', 'type' => 'number']], 'outputs' => [['id' => '5yr-buy-cost', 'label' => '5y Buy Cost'], ['id' => '5yr-lease-cost', 'label' => '5y Lease Cost']]],
    'corporate-tax-calculator' => ['name' => 'Corporate Tax', 'icon' => 'fas fa-building', 'inputs' => [['id' => 'net-profit', 'label' => 'Net Profit ($)', 'placeholder' => '500000', 'type' => 'number'], ['id' => 'tax-rate', 'label' => 'Tax Rate (%)', 'placeholder' => '21', 'type' => 'number']], 'outputs' => [['id' => 'tax-liability', 'label' => 'Tax Liability'], ['id' => 'post-tax-income', 'label' => 'Net After Tax']]],
    'capital-gains-tax-calculator' => ['name' => 'Capital Gains Tax', 'icon' => 'fas fa-hand-holding-usd', 'inputs' => [['id' => 'buy-price', 'label' => 'Purchase Price ($)', 'placeholder' => '100000', 'type' => 'number'], ['id' => 'sell-price', 'label' => 'Selling Price ($)', 'placeholder' => '150000', 'type' => 'number']], 'outputs' => [['id' => 'gain-amt', 'label' => 'Gain Amount'], ['id' => 'tax-due', 'label' => 'Tax Due']]],
    'estate-tax-calculator' => ['name' => 'Estate Tax', 'icon' => 'fas fa-landmark', 'inputs' => [['id' => 'estate-value', 'label' => 'Estate Value ($)', 'placeholder' => '15000000', 'type' => 'number']], 'outputs' => [['id' => 'taxable-value', 'label' => 'Taxable Amt'], ['id' => 'estimated-tax', 'label' => 'Est. Tax']]],
    'inheritance-tax-calculator' => ['name' => 'Inheritance Tax', 'icon' => 'fas fa-vault', 'inputs' => [['id' => 'legacy-amt', 'label' => 'Legacy Amount ($)', 'placeholder' => '500000', 'type' => 'number']], 'outputs' => [['id' => 'inherit-tax', 'label' => 'Tax Due']]],
    'house-flipping-profit-calculator' => ['name' => 'House Flipping Profit', 'icon' => 'fas fa-tools', 'inputs' => [['id' => 'purchase-val', 'label' => 'Buy Price ($)', 'placeholder' => '200000', 'type' => 'number'], ['id' => 'reno-cost', 'label' => 'Reno Cost ($)', 'placeholder' => '50000', 'type' => 'number'], ['id' => 'target-sale', 'label' => 'Sale Price ($)', 'placeholder' => '320000', 'type' => 'number']], 'outputs' => [['id' => 'flip-profit', 'label' => 'Flip Profit'], ['id' => 'flip-roi', 'label' => 'ROI %']]],
    'rental-yield-calculator' => ['name' => 'Rental Yield', 'icon' => 'fas fa-key', 'inputs' => [['id' => 'prop-val', 'label' => 'Property Value ($)', 'placeholder' => '400000', 'type' => 'number'], ['id' => 'monthly-rent', 'label' => 'Monthly Rent ($)', 'placeholder' => '2000', 'type' => 'number']], 'outputs' => [['id' => 'gross-yield', 'label' => 'Gross Yield %']]],
    'churn-rate-calculator' => ['name' => 'Churn Rate', 'icon' => 'fas fa-user-minus', 'inputs' => [['id' => 'start-users', 'label' => 'Users Start', 'placeholder' => '1000', 'type' => 'number'], ['id' => 'lost-users', 'label' => 'Users Lost', 'placeholder' => '50', 'type' => 'number']], 'outputs' => [['id' => 'churn-pct', 'label' => 'Churn %']]],
    'ebitda-calculator' => ['name' => 'EBITDA', 'icon' => 'fas fa-chart-line', 'inputs' => [['id' => 'net-income', 'label' => 'Net Income ($)', 'placeholder' => '100000', 'type' => 'number'], ['id' => 'interest', 'label' => 'Interest ($)', 'placeholder' => '5000', 'type' => 'number'], ['id' => 'taxes', 'label' => 'Taxes ($)', 'placeholder' => '20000', 'type' => 'number'], ['id' => 'da', 'label' => 'Depr/Amort ($)', 'placeholder' => '10000', 'type' => 'number']], 'outputs' => [['id' => 'ebitda-val', 'label' => 'EBITDA']]],
    'ai-financial-planner-calculator' => ['name' => 'AI Financial Planner', 'icon' => 'fas fa-brain', 'inputs' => [['id' => 'age', 'label' => 'Age', 'placeholder' => '30', 'type' => 'number'], ['id' => 'income', 'label' => 'Income ($)', 'placeholder' => '80000', 'type' => 'number'], ['id' => 'risk', 'label' => 'Risk', 'type' => 'select', 'options' => ['cons' => 'Conservative', 'mod' => 'Moderate', 'agg' => 'Aggressive']]], 'outputs' => [['id' => 'strategy-score', 'label' => 'AI Score']]],
    'passive-income-calculator' => ['name' => 'Passive Income', 'icon' => 'fas fa-couch', 'inputs' => [['id' => 'capital', 'label' => 'Capital ($)', 'placeholder' => '100000', 'type' => 'number'], ['id' => 'yield', 'label' => 'Yield (%)', 'placeholder' => '5', 'type' => 'number']], 'outputs' => [['id' => 'monthly-inc', 'label' => 'Monthly Inc']]],
    'dental-implant-cost-calculator' => ['name' => 'Dental Implant Cost', 'icon' => 'fas fa-tooth', 'inputs' => [['id' => 'qty', 'label' => 'Quantity', 'placeholder' => '1', 'type' => 'number'], ['id' => 'loc', 'label' => 'Location', 'type' => 'select', 'options' => ['metro' => 'Metropolitan', 'rural' => 'Rural']]], 'outputs' => [['id' => 'total-cost', 'label' => 'Total Cost']]],
    'loan-eligibility-calculator' => ['name' => 'Loan Eligibility', 'icon' => 'fas fa-user-check', 'inputs' => [['id' => 'income-val', 'label' => 'Monthly Inc ($)', 'placeholder' => '5000', 'type' => 'number'], ['id' => 'debts', 'label' => 'Existing Debt ($)', 'placeholder' => '500', 'type' => 'number']], 'outputs' => [['id' => 'max-loan', 'label' => 'Max Loan']]],
    'data-breach-cost-calculator' => ['name' => 'Data Breach Cost', 'icon' => 'fas fa-user-secret', 'inputs' => [['id' => 'recs', 'label' => 'Records Lost', 'placeholder' => '5000', 'type' => 'number'], ['id' => 'ind', 'label' => 'Industry', 'type' => 'select', 'options' => ['hc' => 'Healthcare', 'fin' => 'Finance', 'oth' => 'Other']]], 'outputs' => [['id' => 'breach-total', 'label' => 'Total Cost']]],
    'cybersecurity-roi-calculator' => ['name' => 'Cybersecurity ROI', 'icon' => 'fas fa-shield-virus', 'inputs' => [['id' => 'prob', 'label' => 'Prob (%)', 'placeholder' => '20', 'type' => 'number'], ['id' => 'imp', 'label' => 'Impact ($)', 'placeholder' => '1000000', 'type' => 'number'], ['id' => 'spend', 'label' => 'Spend ($)', 'placeholder' => '50000', 'type' => 'number']], 'outputs' => [['id' => 'roi-val', 'label' => 'ROI %']]],
    'cloud-cost-calculator' => ['name' => 'Cloud Cost', 'icon' => 'fas fa-cloud', 'inputs' => [['id' => 'vms', 'label' => 'VMs', 'placeholder' => '5', 'type' => 'number'], ['id' => 'ram', 'label' => 'RAM/VM (GB)', 'placeholder' => '8', 'type' => 'number']], 'outputs' => [['id' => 'infra-total', 'label' => 'Monthly Infra']]],
    'solar-panel-savings-calculator' => ['name' => 'Solar Panel Savings', 'icon' => 'fas fa-solar-panel', 'inputs' => [['id' => 'bill', 'label' => 'Bill ($)', 'placeholder' => '150', 'type' => 'number'], ['id' => 'cost', 'label' => 'System Cost ($)', 'placeholder' => '15000', 'type' => 'number']], 'outputs' => [['id' => 'repro', 'label' => '20y Savings']]],
    'ev-charging-cost-calculator' => ['name' => 'EV Charging Cost', 'icon' => 'fas fa-charging-station', 'inputs' => [['id' => 'bat', 'label' => 'Battery (kWh)', 'placeholder' => '75', 'type' => 'number'], ['id' => 'rate', 'label' => 'Rate ($)', 'placeholder' => '0.15', 'type' => 'number']], 'outputs' => [['id' => 'charge-total', 'label' => 'Full Charge']]],
    'home-renovation-cost-calculator' => ['name' => 'Home Renovation', 'icon' => 'fas fa-tools', 'inputs' => [['id' => 'area', 'label' => 'Area (SQFT)', 'placeholder' => '1000', 'type' => 'number'], ['id' => 'type', 'label' => 'Room', 'type' => 'select', 'options' => ['kit' => 'Kitchen', 'bath' => 'Bath', 'liv' => 'Living']]], 'outputs' => [['id' => 'reno-total', 'label' => 'Est. Budget']]],
    'roofing-cost-calculator' => ['name' => 'Roofing Cost', 'icon' => 'fas fa-house-chimney', 'inputs' => [['id' => 'roof-area', 'label' => 'Area (SQFT)', 'placeholder' => '2000', 'type' => 'number'], ['id' => 'mat', 'label' => 'Material', 'type' => 'select', 'options' => ['sh' => 'Shingle', 'mt' => 'Metal']]], 'outputs' => [['id' => 'roof-total', 'label' => 'Est. Cost']]],
    'hvac-installation-cost-calculator' => ['name' => 'HVAC Installation', 'icon' => 'fas fa-wind', 'inputs' => [['id' => 'h-sqft', 'label' => 'Home SQFT', 'placeholder' => '2000', 'type' => 'number']], 'outputs' => [['id' => 'hvac-total', 'label' => 'Est. Cost']]],
    'plumbing-cost-calculator' => ['name' => 'Plumbing Cost', 'icon' => 'fas fa-faucet', 'inputs' => [['id' => 'hrs', 'label' => 'Hours', 'placeholder' => '2', 'type' => 'number']], 'outputs' => [['id' => 'plum-total', 'label' => 'Est. Cost']]],
    'freight-cost-calculator' => ['name' => 'Freight Cost', 'icon' => 'fas fa-truck', 'inputs' => [['id' => 'w', 'label' => 'Weight (lbs)', 'placeholder' => '2000', 'type' => 'number'], ['id' => 'd', 'label' => 'Distance (mi)', 'placeholder' => '500', 'type' => 'number']], 'outputs' => [['id' => 'fr-total', 'label' => 'Quote']]],
    'shipping-cost-estimator' => ['name' => 'Shipping Cost', 'icon' => 'fas fa-box-open', 'inputs' => [['id' => 'pw', 'label' => 'Weight (lbs)', 'placeholder' => '5', 'type' => 'number']], 'outputs' => [['id' => 'sh-total', 'label' => 'Postage']]],
    'import-duty-calculator' => ['name' => 'Import Duty', 'icon' => 'fas fa-passport', 'inputs' => [['id' => 'iv', 'label' => 'Value ($)', 'placeholder' => '1000', 'type' => 'number'], ['id' => 'dr', 'label' => 'Duty (%)', 'placeholder' => '6', 'type' => 'number']], 'outputs' => [['id' => 'dut-total', 'label' => 'Total Duty']]],
    'private-jet-charter-cost-calculator' => ['name' => 'Private Jet Charter', 'icon' => 'fas fa-plane', 'inputs' => [['id' => 'fh', 'label' => 'Flight Hours', 'placeholder' => '3', 'type' => 'number']], 'outputs' => [['id' => 'char-total', 'label' => 'Charter Cost']]],
    'injection-molding-cost-calculator' => ['name' => 'Injection Molding', 'icon' => 'fas fa-object-ungroup', 'inputs' => [['id' => 'pq', 'label' => 'Quantity', 'placeholder' => '5000', 'type' => 'number']], 'outputs' => [['id' => 'inj-total', 'label' => 'Total Cost']]],
    'commercial-lease-calculator' => ['name' => 'Commercial Lease', 'icon' => 'fas fa-store', 'inputs' => [['id' => 'sq', 'label' => 'Area (SQFT)', 'placeholder' => '2000', 'type' => 'number'], ['id' => 'rt', 'label' => 'Rate ($)', 'placeholder' => '25', 'type' => 'number']], 'outputs' => [['id' => 'lease-total', 'label' => 'Annual Rent']]],
    'dividend-income-calculator' => ['name' => 'Dividend Income', 'icon' => 'fas fa-money-bill-trend-up', 'inputs' => [['id' => 'sp', 'label' => 'Price ($)', 'placeholder' => '150', 'type' => 'number'], ['id' => 'dp', 'label' => 'Div/Share ($)', 'placeholder' => '4', 'type' => 'number']], 'outputs' => [['id' => 'div-total', 'label' => 'Ann. Income']]],
    'asset-allocation-calculator' => ['name' => 'Asset Allocation', 'icon' => 'fas fa-balance-scale', 'inputs' => [['id' => 'ia', 'label' => 'Age', 'placeholder' => '30', 'type' => 'number']], 'outputs' => [['id' => 'stock-val', 'label' => 'Stocks %']]],
    'pest-control-cost-calculator' => ['name' => 'Pest Control', 'icon' => 'fas fa-bug-slash', 'inputs' => [['id' => 'hs', 'label' => 'Area (SQFT)', 'placeholder' => '2000', 'type' => 'number']], 'outputs' => [['id' => 'pest-total', 'label' => 'Est. Cost']]],
    'landscaping-cost-calculator' => ['name' => 'Landscaping', 'icon' => 'fas fa-grass', 'inputs' => [['id' => 'ls', 'label' => 'Area (SQFT)', 'placeholder' => '5000', 'type' => 'number']], 'outputs' => [['id' => 'land-total', 'label' => 'Est. Cost']]],
    'moving-cost-calculator' => ['name' => 'Moving Cost', 'icon' => 'fas fa-truck-ramp-box', 'inputs' => [['id' => 'md', 'label' => 'Distance (mi)', 'placeholder' => '50', 'type' => 'number']], 'outputs' => [['id' => 'mov-total', 'label' => 'Est. Cost']]],
    'relocation-expense-calculator' => ['name' => 'Relocation Expense', 'icon' => 'fas fa-map-location-dot', 'inputs' => [['id' => 'me', 'label' => 'Movers ($)', 'placeholder' => '2000', 'type' => 'number'], ['id' => 'mf', 'label' => 'Fees ($)', 'placeholder' => '500', 'type' => 'number']], 'outputs' => [['id' => 'relo-total', 'label' => 'Total Budget']]],
    'cap-rate-calculator' => ['name' => 'Cap Rate', 'icon' => 'fas fa-percentage', 'inputs' => [['id' => 'noi', 'label' => 'Annual NOI ($)', 'placeholder' => '50000', 'type' => 'number'], ['id' => 'prop-price', 'label' => 'Property Price ($)', 'placeholder' => '800000', 'type' => 'number']], 'outputs' => [['id' => 'cap-res', 'label' => 'Cap Rate %']]],
];

$outputDir = __DIR__ . '/../resources/views/tools/interactive';

foreach ($toolsSchema as $slug => $data) {
    $inputsHtml = ''; $jsInputVars = ''; $jsIds = [];
    foreach ($data['inputs'] as $input) {
        $jsIds[] = $input['id']; $varName = str_replace('-', '_', $input['id']);
        if ($input['type'] === 'select') {
            $optionsHtml = ''; foreach ($input['options'] as $v => $l) { $optionsHtml .= "                        <option value=\"$v\">$l</option>\n"; }
            $inputsHtml .= "            <div class=\"form-group-custom mb-3\"><label class=\"form-label-custom\">{$input['label']}</label><select id=\"{$input['id']}\" class=\"form-select-custom\">$optionsHtml</select></div>\n";
            $jsInputVars .= "        const $varName = document.getElementById('{$input['id']}').value;\n";
        } else {
            $inputsHtml .= "            <div class=\"form-group-custom mb-3\"><label class=\"form-label-custom\">{$input['label']}</label><input type=\"number\" id=\"{$input['id']}\" class=\"form-control-custom\" placeholder=\"e.g. {$input['placeholder']}\"></div>\n";
            $jsInputVars .= "        const $varName = parseFloat(document.getElementById('{$input['id']}').value) || 0;\n";
        }
    }
    $outputsHtml = ''; foreach ($data['outputs'] as $i => $o) { $outputsHtml .= "                <div class=\"stat-item " . ($i % 2 === 0 ? "border-end pe-3" : "ps-3") . "\"><span class=\"stat-label\">{$o['label']}</span><span class=\"stat-value\" id=\"{$o['id']}\">0</span></div>\n"; }

    // generate per-tool JS logic in PHP to avoid syntax/scope issues in JS
    $logicMap = [
        'closing-cost-calculator' => "res = home_price * 0.05; try { document.getElementById('legal-fees').innerText = '$' + (home_price * 0.01).toLocaleString(); document.getElementById('transfer-tax').innerText = '$' + (home_price * 0.02).toLocaleString(); } catch(e){}",
        'financial-freedom-calculator' => "res = safe_w_rate ? (annual_exp / (safe_w_rate / 100)) : 0; try { document.getElementById('fire-number').innerText = '$' + res.toLocaleString(); } catch(e){}",
        'emergency-fund-calculator' => "res = monthly_cost * months_cover; try { document.getElementById('savings-goal').innerText = '$' + res.toLocaleString(); } catch(e){}",
        'lease-vs-buy-car-calculator' => "let b = car_price + 5000; let l = lease_payment * 60; res = b - l; try { document.getElementById('5yr-buy-cost').innerText = '$' + b.toLocaleString(); document.getElementById('5yr-lease-cost').innerText = '$' + l.toLocaleString(); } catch(e){}",
        'corporate-tax-calculator' => "res = net_profit * (tax_rate/100); try { document.getElementById('tax-liability').innerText = '$'+res.toLocaleString(); document.getElementById('post-tax-income').innerText = '$'+(net_profit-res).toLocaleString(); } catch(e){}",
        'capital-gains-tax-calculator' => "let g = Math.max(0, sell_price - buy_price); res = g * 0.15; try { document.getElementById('gain-amt').innerText = '$'+g.toLocaleString(); document.getElementById('tax-due').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'estate-tax-calculator' => "let v = Math.max(0, estate_value - 12000000); res = v * 0.40; try { document.getElementById('taxable-value').innerText = '$'+v.toLocaleString(); document.getElementById('estimated-tax').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'inheritance-tax-calculator' => "res = legacy_amt * 0.15; try { document.getElementById('inherit-tax').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'house-flipping-profit-calculator' => "res = target_sale - purchase_val - reno_cost; let roi = res / (purchase_val+reno_cost) * 100; try { document.getElementById('flip-profit').innerText = '$'+res.toLocaleString(); document.getElementById('flip-roi').innerText = (isFinite(roi)?roi.toFixed(2):0)+'%'; } catch(e){}",
        'rental-yield-calculator' => "res = prop_val ? ((monthly_rent * 12) / prop_val) * 100 : 0; mainUnit = '%'; try { document.getElementById('gross-yield').innerText = res.toFixed(2)+'%'; } catch(e){}",
        'churn-rate-calculator' => "res = start_users ? (lost_users / start_users) * 100 : 0; mainUnit = '%'; try { document.getElementById('churn-pct').innerText = res.toFixed(2)+'%'; } catch(e){}",
        'ebitda-calculator' => "res = net_income + interest + taxes + da; try { document.getElementById('ebitda-val').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'ai-financial-planner-calculator' => "res = (age ? income / age : 0) + (risk === 'agg'?100:(risk==='mod'?50:10)); mainUnit = ''; try { document.getElementById('strategy-score').innerText = res.toFixed(1); } catch(e){}",
        'passive-income-calculator' => "let dInc = (capital * (yield_val / 100)) / 12; res = dInc * 12; try { document.getElementById('monthly-inc').innerText = '$'+dInc.toLocaleString(); } catch(e){}",
        'dental-implant-cost-calculator' => "res = qty * (loc === 'metro' ? 4000 : 2500); try { document.getElementById('total-cost').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'loan-eligibility-calculator' => "res = Math.max(0, ((income_val * 0.43) - debts) * 100); try { document.getElementById('max-loan').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'data-breach-cost-calculator' => "res = recs * (ind === 'hc' ? 408 : (ind === 'fin' ? 200 : 150)); try { document.getElementById('breach-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'cybersecurity-roi-calculator' => "let ale = (prob/100)*imp; res = spend ? ((ale-spend)/spend)*100 : 0; mainUnit = '%'; try { document.getElementById('roi-val').innerText = res.toFixed(2)+'%'; } catch(e){}",
        'cloud-cost-calculator' => "res = vms * ram * 5; try { document.getElementById('infra-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'solar-panel-savings-calculator' => "res = (bill * 12 * 20) - cost; try { document.getElementById('repro').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'ev-charging-cost-calculator' => "res = bat * rate; try { document.getElementById('charge-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'home-renovation-cost-calculator' => "res = area * (type === 'kit' ? 150 : (type === 'bath' ? 200 : 50)); try { document.getElementById('reno-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'roofing-cost-calculator' => "res = roof_area * (mat === 'mt' ? 10 : 4); try { document.getElementById('roof-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'hvac-installation-cost-calculator' => "res = h_sqft * 4; try { document.getElementById('hvac-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'plumbing-cost-calculator' => "res = hrs * 150 + 50; try { document.getElementById('plum-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'freight-cost-calculator' => "res = (w * 0.1) + (d * 1.5); try { document.getElementById('fr-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'shipping-cost-estimator' => "res = pw * 2.5 + 5; try { document.getElementById('sh-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'import-duty-calculator' => "res = iv * (dr/100); try { document.getElementById('dut-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'private-jet-charter-cost-calculator' => "res = fh * 5000 + 1000; try { document.getElementById('char-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'injection-molding-cost-calculator' => "res = pq * 0.5 + 10000; try { document.getElementById('inj-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'commercial-lease-calculator' => "res = sq * rt; try { document.getElementById('lease-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'dividend-income-calculator' => "res = sp ? dp * (10000 / sp) : 0; try { document.getElementById('div-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'asset-allocation-calculator' => "res = 110 - ia; mainUnit = '%'; try { document.getElementById('stock-val').innerText = res.toFixed(1)+'%'; } catch(e){}",
        'pest-control-cost-calculator' => "res = hs * 0.10; try { document.getElementById('pest-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'landscaping-cost-calculator' => "res = ls * 1.5; try { document.getElementById('land-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'moving-cost-calculator' => "res = md * 2.5 + 200; try { document.getElementById('mov-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'relocation-expense-calculator' => "res = me + mf + 1000; try { document.getElementById('relo-total').innerText = '$'+res.toLocaleString(); } catch(e){}",
        'cap-rate-calculator' => "res = prop_price ? (noi / prop_price) * 100 : 0; mainUnit = '%'; try { document.getElementById('cap-res').innerText = res.toFixed(2)+'%'; } catch(e){}",
    ];
    $toolLogic = isset($logicMap[$slug]) ? $logicMap[$slug] : 'res = 1234;';

    $jsLogic = "
        let res = 0; let mainUnit = '$';
        $toolLogic

        const displayRes = (mainUnit === '%' || mainUnit === '' ? res.toFixed(2) : Math.round(res).toLocaleString());
        try { document.getElementById('main-result').innerText = mainUnit + displayRes; } catch(e){}
        
        // Dynamic Chart (Simple CSS Bar)
        try { 
            const bar = document.getElementById('visual-bar');
            if(bar) { 
                let pct = (res / (res + 10000)) * 100; 
                if (mainUnit === '%') pct = Math.min(100, res);
                bar.style.width = pct + '%'; 
            }
        } catch(e){}
    ";

    $blade = "
<div class=\"interactive-tool-grid $slug\">
    <div class=\"calculator-card\">
        <div class=\"calculator-header\">
            <div class=\"tool-icon-circle\"><i class=\"{$data['icon']}\"></i></div>
            <div><h4>{$data['name']} Calculator</h4><p>Accurate Estimation Tool</p></div>
        </div>
        <div class=\"calculator-body\">$inputsHtml</div>
    </div>
    <div class=\"result-panel\">
        <div class=\"result-card-v2\">
            <span class=\"result-label\">Projected Result</span>
            <h1 class=\"result-main-value\" id=\"main-result\">0</h1>
            <div class=\"visual-analytics mt-4 mb-4\">
                <div class=\"progress-custom\"><div id=\"visual-bar\" class=\"progress-bar-custom\"></div></div>
                <small class=\"text-muted mt-2 d-block\">Visual Score / Distribution</small>
            </div>
            <div class=\"result-sub-stats\">$outputsHtml</div>
            <div class=\"summary-table-container mt-4 pt-3 border-top\">
                <h5>Breakdown Summary</h5>
                <table class=\"table table-sm table-borderless summary-table\">
                    <tr><td>Primary Component</td><td class=\"text-end\">90%</td></tr>
                    <tr><td>Processing Fees</td><td class=\"text-end\">10%</td></tr>
                </table>
            </div>
            <button class=\"btn btn-accent w-100 py-3 mt-3 shadow-sm\" id=\"copy-result\"><i class=\"fas fa-copy me-2\"></i> Export Results</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
$jsInputVars
$jsLogic
    }
    [" . "'" . implode("', '", $jsIds) . "'" . "].forEach(id => {
        const el = document.getElementById(id);
        if(el) el.addEventListener('input', calculate);
    });
    document.getElementById('copy-result').addEventListener('click', function() {
        const text = '{$data['name']} Result: ' + document.getElementById('main-result').innerText;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this; const orig = btn.innerHTML;
            btn.innerHTML = '<i class=\"fas fa-check me-2\"></i> Copied!';
            setTimeout(() => btn.innerHTML = orig, 2000);
        });
    });
    calculate();
});
</script>
<style>
.progress-custom { background: #eef2f7; height: 12px; border-radius: 10px; overflow: hidden; }
.progress-bar-custom { background: linear-gradient(90deg, #6366f1, #a855f7); width: 0%; height: 100%; transition: width 0.4s ease; }
.summary-table td { padding: 8px 0; font-size: 0.9rem; color: #4b5563; }
.summary-table .text-end { font-weight: 600; color: #1f2937; }
</style>";

    file_put_contents("$outputDir/$slug.blade.php", trim($blade));
}
echo "All 38 Premium Tools Generated Successfully.\n";
