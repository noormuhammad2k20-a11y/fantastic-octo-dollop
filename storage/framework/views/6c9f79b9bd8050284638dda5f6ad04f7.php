<div class="row g-4 birthday-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Quantity</label>
                        <input type="number" id="bday-count" class="form-control form-control-lg" value="5" min="1" max="100">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Min Age</label>
                        <input type="number" id="bday-min" class="form-control form-control-lg" value="18" min="0" max="120">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Max Age</label>
                        <input type="number" id="bday-max" class="form-control form-control-lg" value="65" min="0" max="120">
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-warning fw-bold text-dark fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="bday-generate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-gift me-2"></i>Generate Birthdays
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="bday-output-card" style="--tool-hue:45;--tool-color:#ca8a04;--tool-bg:rgba(234,179,8,.04); border-color:#fde047;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-calendar-check me-2" style="color:#ca8a04"></i>Generated Birthdays</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-bdays" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy Data</button>
            </div>
            
            <div class="table-responsive bg-white rounded-3 border">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-uppercase small fw-bold text-muted py-3 px-4">Date</th>
                            <th class="text-uppercase small fw-bold text-muted py-3">Age</th>
                            <th class="text-uppercase small fw-bold text-muted py-3">Zodiac Sign</th>
                        </tr>
                    </thead>
                    <tbody id="bday-table-body">
                        <!-- Rows injected here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.birthday-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.birthday-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.birthday-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.birthday-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.birthday-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.birthday-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function getZodiac(month, day) {
        if ((month == 1 && day >= 20) || (month == 2 && day <= 18)) return "♒ Aquarius";
        if ((month == 2 && day >= 19) || (month == 3 && day <= 20)) return "♓ Pisces";
        if ((month == 3 && day >= 21) || (month == 4 && day <= 19)) return "♈ Aries";
        if ((month == 4 && day >= 20) || (month == 5 && day <= 20)) return "♉ Taurus";
        if ((month == 5 && day >= 21) || (month == 6 && day <= 20)) return "♊ Gemini";
        if ((month == 6 && day >= 21) || (month == 7 && day <= 22)) return "♋ Cancer";
        if ((month == 7 && day >= 23) || (month == 8 && day <= 22)) return "♌ Leo";
        if ((month == 8 && day >= 23) || (month == 9 && day <= 22)) return "♍ Virgo";
        if ((month == 9 && day >= 23) || (month == 10 && day <= 22)) return "♎ Libra";
        if ((month == 10 && day >= 23) || (month == 11 && day <= 21)) return "♏ Scorpio";
        if ((month == 11 && day >= 22) || (month == 12 && day <= 21)) return "♐ Sagittarius";
        return "♑ Capricorn";
    }

    $('bday-generate').addEventListener('click', function() {
        const count = parseInt($('bday-count').value) || 1;
        let minAge = parseInt($('bday-min').value) || 0;
        let maxAge = parseInt($('bday-max').value) || 0;

        if (minAge > maxAge) {
            [minAge, maxAge] = [maxAge, minAge];
            $('bday-min').value = minAge;
            $('bday-max').value = maxAge;
        }

        const tbody = $('bday-table-body');
        tbody.innerHTML = '';
        const today = new Date();
        const currentYear = today.getFullYear();
        
        let rawData = "Date\tAge\tZodiac\n";

        for (let i = 0; i < count; i++) {
            const age = Math.floor(Math.random() * (maxAge - minAge + 1)) + minAge;
            const year = currentYear - age;
            const month = Math.floor(Math.random() * 12);
            
            // Handle max days in month properly
            const tempDate = new Date(year, month + 1, 0); 
            const maxDays = tempDate.getDate();
            const day = Math.floor(Math.random() * maxDays) + 1;

            const bday = new Date(year, month, day);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const formatted = bday.toLocaleDateString(undefined, options);
            
            const zodiac = getZodiac(month + 1, day);

            rawData += `${formatted}\t${age}\t${zodiac}\n`;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="px-4 fw-bold text-dark">${formatted}</td>
                <td><span class="badge bg-light border text-dark fs-6">${age} yrs</span></td>
                <td class="text-muted fw-bold">${zodiac}</td>
            `;
            tbody.appendChild(tr);
        }

        tbody.dataset.raw = rawData;
        $('bday-output-card').classList.remove('d-none');
        $('bday-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-bdays').addEventListener('click', function() {
        const data = $('bday-table-body').dataset.raw;
        navigator.clipboard.writeText(data).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\random-birthday-generator.blade.php ENDPATH**/ ?>