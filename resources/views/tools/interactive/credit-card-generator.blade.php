<div class="row g-4 cc-rebuilt">
    <div class="col-lg-12">
        <div class="alert alert-warning mb-0 border-0 rounded-3 shadow-sm d-flex align-items-center">
            <i class="fas fa-exclamation-triangle fs-3 me-3 text-warning"></i>
            <div>
                <strong>Developer Testing Only:</strong> These are randomly generated dummy numbers that pass the Luhn algorithm checksum. They are <strong>NOT</strong> real credit cards and cannot be used for actual purchases.
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="calculator-card mt-0">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Card Network</label>
                        <select id="cc-network" class="form-select form-select-lg">
                            <option value="visa" selected>Visa</option>
                            <option value="mastercard">Mastercard</option>
                            <option value="amex">American Express</option>
                            <option value="discover">Discover</option>
                            <option value="random">Random Mix</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Quantity</label>
                        <select id="cc-count" class="form-select form-select-lg">
                            <option value="1">1 Card</option>
                            <option value="5" selected>5 Cards</option>
                            <option value="10">10 Cards</option>
                            <option value="20">20 Cards</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="cc-generate" style="min-width: 280px; max-width: 100%; background:#0ea5e9; border:none;">
                    <i class="fas fa-cogs me-2"></i>Generate Test Cards
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="cc-output-card" style="--tool-hue:200;--tool-color:#0284c7;--tool-bg:rgba(14,165,233,.04); border-color:#bae6fd;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-list me-2 text-primary"></i>Generated Test Data</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-cc" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy Data</button>
            </div>
            
            <div class="table-responsive bg-white rounded-3 border">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-uppercase small fw-bold text-muted py-3 px-4">Network</th>
                            <th class="text-uppercase small fw-bold text-muted py-3">Card Number</th>
                            <th class="text-uppercase small fw-bold text-muted py-3">Expiry</th>
                            <th class="text-uppercase small fw-bold text-muted py-3">CVV</th>
                        </tr>
                    </thead>
                    <tbody id="cc-table-body">
                        <!-- Rows injected here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.cc-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.cc-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.cc-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.cc-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.cc-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.cc-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const prefixes = {
        visa: ['4539', '4556', '4916', '4532', '4929', '4024', '4485', '4716', '4'],
        mastercard: ['51', '52', '53', '54', '55', '2221', '2720'],
        amex: ['34', '37'],
        discover: ['6011', '65', '644', '645']
    };

    const lengths = {
        visa: 16,
        mastercard: 16,
        amex: 15,
        discover: 16
    };

    function generateLuhnNumber(prefix, length) {
        let ccnumber = prefix;
        while (ccnumber.length < (length - 1)) {
            ccnumber += Math.floor(Math.random() * 10);
        }
        
        // Calculate Luhn checksum
        let sum = 0;
        let pos = 0;
        const reversedCCnumber = [...ccnumber].reverse();
        
        while (pos < length - 1) {
            let odd = parseInt(reversedCCnumber[pos]) * 2;
            if (odd > 9) odd -= 9;
            sum += odd;
            
            if (pos !== (length - 2)) {
                sum += parseInt(reversedCCnumber[pos + 1]);
            }
            pos += 2;
        }
        
        const checkdigit = ((Math.floor(sum / 10) + 1) * 10 - sum) % 10;
        return ccnumber + checkdigit;
    }

    $('cc-generate').addEventListener('click', function() {
        const count = parseInt($('cc-count').value);
        const reqNetwork = $('cc-network').value;

        const tbody = $('cc-table-body');
        tbody.innerHTML = '';
        let rawData = "Network\tCard Number\tExpiry\tCVV\n";

        const networks = ['visa', 'mastercard', 'amex', 'discover'];

        for (let i = 0; i < count; i++) {
            const nw = reqNetwork === 'random' ? networks[Math.floor(Math.random() * networks.length)] : reqNetwork;
            const prefix = prefixes[nw][Math.floor(Math.random() * prefixes[nw].length)];
            const len = lengths[nw];
            
            const ccNum = generateLuhnNumber(prefix, len);
            
            // Random future expiry
            const month = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            const year = String(new Date().getFullYear() + Math.floor(Math.random() * 5) + 1).slice(2);
            const exp = `${month}/${year}`;
            
            // CVV
            const cvvLen = nw === 'amex' ? 4 : 3;
            let cvv = '';
            for(let c=0; c<cvvLen; c++) cvv += Math.floor(Math.random() * 10);

            // Icon mapping
            let icon = '';
            if(nw==='visa') icon = '<i class="fab fa-cc-visa text-primary fs-3"></i>';
            if(nw==='mastercard') icon = '<i class="fab fa-cc-mastercard text-warning fs-3"></i>';
            if(nw==='amex') icon = '<i class="fab fa-cc-amex text-info fs-3"></i>';
            if(nw==='discover') icon = '<i class="fab fa-cc-discover text-orange fs-3"></i>';

            // Format number with spaces
            const formattedNum = nw === 'amex' 
                ? ccNum.slice(0,4) + ' ' + ccNum.slice(4,10) + ' ' + ccNum.slice(10)
                : ccNum.replace(/(.{4})/g, '$1 ').trim();

            rawData += `${nw.toUpperCase()}\t${ccNum}\t${exp}\t${cvv}\n`;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="px-4">${icon} <span class="ms-2 fw-bold text-uppercase small text-muted">${nw}</span></td>
                <td class="fw-bold font-monospace fs-5 text-dark" style="letter-spacing:1px">${formattedNum}</td>
                <td class="fw-bold font-monospace">${exp}</td>
                <td class="fw-bold font-monospace">${cvv}</td>
            `;
            tbody.appendChild(tr);
        }

        tbody.dataset.raw = rawData;
        $('cc-output-card').classList.remove('d-none');
        $('cc-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-cc').addEventListener('click', function() {
        const data = $('cc-table-body').dataset.raw;
        navigator.clipboard.writeText(data).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

