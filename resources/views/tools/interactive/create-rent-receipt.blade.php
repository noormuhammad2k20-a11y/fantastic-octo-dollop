<div class="interactive-tool-grid rent-receipt-tool">
    <!-- Form Card -->
    <div class="calculator-card">
        

        <div class="calculator-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label-custom">Receipt Number</label>
                    <input type="text" id="rrReceiptNo" class="form-control-custom" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Receipt Date</label>
                    <input type="date" id="rrDate" class="form-control-custom">
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Tenant Name <span class="text-danger">*</span></label>
                    <input type="text" id="rrTenant" class="form-control-custom" placeholder="e.g. John Smith">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Landlord Name <span class="text-danger">*</span></label>
                    <input type="text" id="rrLandlord" class="form-control-custom" placeholder="e.g. Jane Doe">
                </div>

                <div class="col-12">
                    <label class="form-label-custom">Property Address <span class="text-danger">*</span></label>
                    <input type="text" id="rrAddress" class="form-control-custom" placeholder="e.g. 123 Main St, Apt 4B, City, State, ZIP">
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Rent Amount <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select id="rrCurrency" class="form-control-custom" style="max-width: 80px; border-right: 0; border-radius: var(--radius-md, 12px) 0 0 var(--radius-md, 12px);">
                            <option value="₹">₹</option>
                            <option value="$">$</option>
                            <option value="€">€</option>
                            <option value="£">£</option>
                        </select>
                        <input type="number" id="rrAmount" class="form-control-custom" placeholder="10000" min="0" style="border-radius: 0 var(--radius-md, 12px) var(--radius-md, 12px) 0;">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Payment Method</label>
                    <select id="rrPayMethod" class="form-control-custom">
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="UPI">UPI</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Online Payment">Online Payment</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Period From</label>
                    <input type="date" id="rrPeriodFrom" class="form-control-custom">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Period To</label>
                    <input type="date" id="rrPeriodTo" class="form-control-custom">
                </div>
            </div>

            <div class="d-flex gap-3 mt-4 flex-wrap">
                <button id="rrDownloadPdf" class="btn btn-accent flex-grow-1 py-3 fw-bold">
                    <i class="fas fa-file-pdf me-2"></i> Download PDF
                </button>
                <button id="rrPrintBtn" class="btn btn-outline-accent flex-grow-1 py-3 fw-bold">
                    <i class="fas fa-print me-2"></i> Print Receipt
                </button>
            </div>
        </div>
    </div>

    <!-- Live Preview Card -->
    <div class="result-panel">
        <div class="calculator-card h-100">
            <div class="calculator-header mb-3">
                <div class="tool-icon-circle" style="background: var(--accent-soft); color: var(--accent);">
                    <i class="fas fa-eye"></i>
                </div>
                <div>
                    <h4>Live Preview</h4>
                    <p>Receipt updates as you type</p>
                </div>
            </div>

            <div class="receipt-preview-wrapper" id="receiptPreview">
                <div class="receipt-paper">
                    <div class="receipt-header-bar">
                        <div class="receipt-title-block">
                            <h3 class="receipt-doc-title">RENT RECEIPT</h3>
                            <span class="receipt-badge">Original</span>
                        </div>
                    </div>

                    <div class="receipt-meta-row">
                        <div><strong>Receipt No:</strong> <span id="prevReceiptNo">—</span></div>
                        <div><strong>Date:</strong> <span id="prevDate">—</span></div>
                    </div>

                    <div class="receipt-divider"></div>

                    <div class="receipt-body-details">
                        <div class="receipt-row">
                            <span class="receipt-label">Received From (Tenant):</span>
                            <span class="receipt-value" id="prevTenant">—</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Received By (Landlord):</span>
                            <span class="receipt-value" id="prevLandlord">—</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Property Address:</span>
                            <span class="receipt-value" id="prevAddress">—</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Rental Period:</span>
                            <span class="receipt-value" id="prevPeriod">—</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Payment Method:</span>
                            <span class="receipt-value" id="prevPayMethod">Cash</span>
                        </div>
                    </div>

                    <div class="receipt-amount-box">
                        <span class="receipt-amount-label">Amount Received</span>
                        <span class="receipt-amount-value" id="prevAmount">₹ 0</span>
                    </div>

                    <div class="receipt-amount-words" id="prevAmountWords"></div>

                    <div class="receipt-signatures">
                        <div class="sig-block">
                            <div class="sig-line"></div>
                            <span>Tenant's Signature</span>
                        </div>
                        <div class="sig-block">
                            <div class="sig-line"></div>
                            <span>Landlord's Signature</span>
                        </div>
                    </div>

                    <div class="receipt-footer-note">
                        This is a computer-generated receipt. Generated on ToolsHub.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('seo_content')

@endsection

@section('faq_content')
<!-- Custom FAQ for Rent Receipt -->
<section class="seo-section" style="padding-top: 0;">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-section">
        <div class="accordion" id="receiptFaqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rfaq1">
                        Is this rent receipt legally valid?
                    </button>
                </h2>
                <div id="rfaq1" class="accordion-collapse collapse" data-bs-parent="#receiptFaqAccordion">
                    <div class="accordion-body">
                        While our tool provides a professional and standard format used globally for rental transactions, rent receipt laws vary by jurisdiction. In most places, a receipt containing the landlord's name, tenant's name, property address, amount paid, and date is considered a valid proof of payment. We recommend checking with your local housing authority for specific requirements.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rfaq2">
                        Do I need to sign the receipt?
                    </button>
                </h2>
                <div id="rfaq2" class="accordion-collapse collapse" data-bs-parent="#receiptFaqAccordion">
                    <div class="accordion-body">
                        For a receipt to be truly official, the landlord or their agent should sign the printed copy after generating it. Our tool includes a signature line specifically for this purpose.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rfaq3">
                        Can I generate a receipt in my local currency?
                    </button>
                </h2>
                <div id="rfaq3" class="accordion-collapse collapse" data-bs-parent="#receiptFaqAccordion">
                    <div class="accordion-body">
                        Yes! Our receipt generator supports multiple currencies including USD, EUR, GBP, INR, CAD, AUD, and more. Simply select your currency from the dropdown menu, and the preview/PDF will update accordingly.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rfaq4">
                        Is my rental information saved?
                    </button>
                </h2>
                <div id="rfaq4" class="accordion-collapse collapse" data-bs-parent="#receiptFaqAccordion">
                    <div class="accordion-body">
                        No. ToolsHub values your privacy. All information you enter stays in your browser's temporary memory while you are using the tool. Once you refresh or close the page, the information is gone. We never store or transmit your data to our servers.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('related_tools')
<!-- Related Tools -->
<section class="seo-section related-tools-section" style="padding-top: 0;">
    <div class="category-header">
        <div><h2>Related Tools</h2></div>
    </div>
    <div class="row g-3">
        @php
            $receiptRelated = [
                'barcode-generator' => $tools['barcode-generator'] ?? null,
                'qrcode-generator' => $tools['qrcode-generator'] ?? null,
                'image-to-pdf' => $tools['image-to-pdf'] ?? null,
                'word-to-pdf' => $tools['word-to-pdf'] ?? null,
                'pdf-to-word' => $tools['pdf-to-word'] ?? null,
                'image-colorizer' => $tools['image-colorizer'] ?? null,
            ];
        @endphp
        @foreach($receiptRelated as $relSlug => $relTool)
            @if($relTool)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ url('/' . $relSlug) }}" class="tool-card">
                        <div class="tool-icon">
                            <i class="{{ $relTool['icon'] }}"></i>
                        </div>
                        <div class="tool-body">
                            <h3 class="tool-name">{{ $relTool['h1'] ?? $relTool['name'] ?? '' }}</h3>
                            <p class="tool-desc">{{ $relTool['description'] ?? '' }}</p>
                        </div>
                        <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</section>
@endsection

<!-- jsPDF CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate receipt number
    const receiptNoInput = document.getElementById('rrReceiptNo');
    const randomNum = Math.floor(100000 + Math.random() * 900000);
    receiptNoInput.value = 'RR-' + randomNum;

    // Set default dates
    const today = new Date();
    document.getElementById('rrDate').value = today.toISOString().split('T')[0];
    const firstOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
    const lastOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    document.getElementById('rrPeriodFrom').value = firstOfMonth.toISOString().split('T')[0];
    document.getElementById('rrPeriodTo').value = lastOfMonth.toISOString().split('T')[0];

    // All form inputs
    const inputs = ['rrReceiptNo', 'rrDate', 'rrTenant', 'rrLandlord', 'rrAddress', 'rrAmount', 'rrCurrency', 'rrPayMethod', 'rrPeriodFrom', 'rrPeriodTo'];

    inputs.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', updatePreview);
        if (el) el.addEventListener('change', updatePreview);
    });

    function formatDate(dateStr) {
        if (!dateStr) return '—';
        const d = new Date(dateStr + 'T00:00:00');
        return d.toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' });
    }

    function numberToWords(num) {
        if (num === 0) return 'Zero';
        const ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine',
            'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

        function convert(n) {
            if (n < 20) return ones[n];
            if (n < 100) return tens[Math.floor(n / 10)] + (n % 10 ? ' ' + ones[n % 10] : '');
            if (n < 1000) return ones[Math.floor(n / 100)] + ' Hundred' + (n % 100 ? ' and ' + convert(n % 100) : '');
            if (n < 100000) return convert(Math.floor(n / 1000)) + ' Thousand' + (n % 1000 ? ' ' + convert(n % 1000) : '');
            if (n < 10000000) return convert(Math.floor(n / 100000)) + ' Lakh' + (n % 100000 ? ' ' + convert(n % 100000) : '');
            return convert(Math.floor(n / 10000000)) + ' Crore' + (n % 10000000 ? ' ' + convert(n % 10000000) : '');
        }
        return convert(Math.floor(num)) + ' Only';
    }

    function getFormData() {
        return {
            receiptNo: document.getElementById('rrReceiptNo').value,
            date: document.getElementById('rrDate').value,
            tenant: document.getElementById('rrTenant').value || '—',
            landlord: document.getElementById('rrLandlord').value || '—',
            address: document.getElementById('rrAddress').value || '—',
            amount: parseFloat(document.getElementById('rrAmount').value) || 0,
            currency: document.getElementById('rrCurrency').value,
            payMethod: document.getElementById('rrPayMethod').value,
            periodFrom: document.getElementById('rrPeriodFrom').value,
            periodTo: document.getElementById('rrPeriodTo').value,
        };
    }

    function updatePreview() {
        const d = getFormData();
        document.getElementById('prevReceiptNo').textContent = d.receiptNo;
        document.getElementById('prevDate').textContent = formatDate(d.date);
        document.getElementById('prevTenant').textContent = d.tenant;
        document.getElementById('prevLandlord').textContent = d.landlord;
        document.getElementById('prevAddress').textContent = d.address;
        document.getElementById('prevPayMethod').textContent = d.payMethod;
        document.getElementById('prevAmount').textContent = d.currency + ' ' + d.amount.toLocaleString('en-IN');

        const periodText = (d.periodFrom && d.periodTo) ? formatDate(d.periodFrom) + ' to ' + formatDate(d.periodTo) : '—';
        document.getElementById('prevPeriod').textContent = periodText;

        const wordsEl = document.getElementById('prevAmountWords');
        if (d.amount > 0) {
            wordsEl.textContent = '(In words: ' + d.currency + ' ' + numberToWords(d.amount) + ')';
        } else {
            wordsEl.textContent = '';
        }
    }

    // Initial preview
    updatePreview();

    // PDF Download
    document.getElementById('rrDownloadPdf').addEventListener('click', function() {
        const d = getFormData();
        if (!document.getElementById('rrTenant').value || !document.getElementById('rrLandlord').value || !document.getElementById('rrAddress').value || !document.getElementById('rrAmount').value) {
            alert('Please fill in all required fields (Tenant, Landlord, Address, Amount).');
            return;
        }

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const pageW = doc.internal.pageSize.getWidth();
        let y = 20;

        // Header background
        doc.setFillColor(44, 62, 80);
        doc.rect(0, 0, pageW, 40, 'F');
        doc.setTextColor(255, 255, 255);
        doc.setFontSize(22);
        doc.setFont('helvetica', 'bold');
        doc.text('RENT RECEIPT', pageW / 2, 18, { align: 'center' });
        doc.setFontSize(10);
        doc.setFont('helvetica', 'normal');
        doc.text('Receipt No: ' + d.receiptNo + '    |    Date: ' + formatDate(d.date), pageW / 2, 30, { align: 'center' });

        y = 55;
        doc.setTextColor(0, 0, 0);

        // Divider
        doc.setDrawColor(44, 62, 80);
        doc.setLineWidth(0.5);
        doc.line(15, y, pageW - 15, y);
        y += 12;

        const labelX = 20;
        const valueX = 75;

        function addRow(label, value) {
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(11);
            doc.text(label, labelX, y);
            doc.setFont('helvetica', 'normal');
            const lines = doc.splitTextToSize(value, pageW - valueX - 20);
            doc.text(lines, valueX, y);
            y += lines.length * 7 + 5;
        }

        addRow('Tenant:', d.tenant);
        addRow('Landlord:', d.landlord);
        addRow('Address:', d.address);
        addRow('Rental Period:', formatDate(d.periodFrom) + ' to ' + formatDate(d.periodTo));
        addRow('Payment Method:', d.payMethod);

        y += 5;

        // Amount box
        doc.setFillColor(236, 240, 241);
        doc.roundedRect(15, y, pageW - 30, 25, 3, 3, 'F');
        doc.setFontSize(13);
        doc.setFont('helvetica', 'bold');
        doc.text('Amount Received:', 25, y + 11);
        doc.setFontSize(16);
        doc.setTextColor(44, 62, 80);
        doc.text(d.currency + ' ' + d.amount.toLocaleString('en-IN'), pageW - 25, y + 11, { align: 'right' });
        y += 30;

        // Amount in words
        doc.setTextColor(100, 100, 100);
        doc.setFontSize(9);
        doc.setFont('helvetica', 'italic');
        doc.text('(In words: ' + d.currency + ' ' + numberToWords(d.amount) + ')', 20, y);
        y += 20;

        // Signature lines
        doc.setDrawColor(0, 0, 0);
        doc.setLineWidth(0.3);
        doc.line(20, y, 85, y);
        doc.line(pageW - 85, y, pageW - 20, y);
        y += 6;
        doc.setTextColor(0, 0, 0);
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(9);
        doc.text("Tenant's Signature", 30, y);
        doc.text("Landlord's Signature", pageW - 75, y);

        y += 15;

        // Footer
        doc.setFontSize(8);
        doc.setTextColor(150, 150, 150);
        doc.text('This is a computer-generated receipt. Generated on ToolsHub.', pageW / 2, y, { align: 'center' });

        doc.save('Rent-Receipt-' + d.receiptNo + '.pdf');
    });

    // Print
    document.getElementById('rrPrintBtn').addEventListener('click', function() {
        const previewHTML = document.getElementById('receiptPreview').innerHTML;
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Rent Receipt</title>
                    <style>
                        * { margin: 0; padding: 0; box-sizing: border-box; }
                        body { font-family: 'Segoe UI', Arial, sans-serif; padding: 30px; background: white; color: #222; }
                        .receipt-paper { max-width: 600px; margin: auto; padding: 30px; border: 1px solid #ccc; }
                        .receipt-header-bar { text-align: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #2c3e50; }
                        .receipt-doc-title { font-size: 24px; color: #2c3e50; margin: 0; }
                        .receipt-badge { display: inline-block; background: #2c3e50; color: #fff; padding: 2px 12px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; margin-top: 5px; }
                        .receipt-meta-row { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 13px; }
                        .receipt-divider { border-top: 1px dashed #ccc; margin: 12px 0; }
                        .receipt-row { display: flex; justify-content: space-between; padding: 6px 0; font-size: 13px; }
                        .receipt-label { color: #666; }
                        .receipt-value { font-weight: 600; text-align: right; max-width: 55%; }
                        .receipt-amount-box { background: #f0f0f0; padding: 12px; border-radius: 8px; text-align: center; margin: 16px 0 8px; }
                        .receipt-amount-label { font-size: 11px; color: #777; display: block; margin-bottom: 4px; }
                        .receipt-amount-value { font-size: 22px; font-weight: 800; color: #2c3e50; }
                        .receipt-amount-words { text-align: center; font-style: italic; font-size: 11px; color: #888; margin-bottom: 25px; }
                        .receipt-signatures { display: flex; justify-content: space-between; margin-top: 40px; }
                        .sig-block { text-align: center; font-size: 11px; color: #666; }
                        .sig-line { width: 120px; border-bottom: 1px solid #333; margin: 0 auto 5px; }
                        .receipt-footer-note { text-align: center; font-size: 9px; color: #aaa; margin-top: 20px; }
                        .receipt-title-block { text-align: center; }
                    </style>
                </head>
                <body>
                    ${previewHTML}
                    <script>window.onload = function() { window.print(); window.close(); }<\/script>
                </body>
            </html>
        `);
        printWindow.document.close();
    });
});
</script>

<style>
.rent-receipt-tool {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}
@media (min-width: 992px) {
    .rent-receipt-tool { grid-template-columns: 1.2fr 1fr; }
}
.input-group {
    display: flex;
}
.btn-outline-accent {
    background: transparent;
    color: var(--accent);
    border: 2px solid var(--accent);
    border-radius: var(--radius-md, 12px);
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
}
.btn-outline-accent:hover {
    background: var(--accent);
    color: #fff;
}

/* Receipt Preview Styles */
.receipt-preview-wrapper {
    background: #fff;
    border-radius: var(--radius-md, 12px);
    overflow: hidden;
}
.receipt-paper {
    padding: 1.5rem;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    background: #fefefe;
    font-family: 'Segoe UI', Arial, sans-serif;
}
.receipt-header-bar {
    text-align: center;
    padding-bottom: 1rem;
    border-bottom: 2px solid #2c3e50;
    margin-bottom: 1rem;
}
.receipt-title-block { text-align: center; }
.receipt-doc-title {
    font-size: 1.4rem;
    font-weight: 800;
    color: #2c3e50;
    letter-spacing: 2px;
    margin: 0;
}
.receipt-badge {
    display: inline-block;
    background: #2c3e50;
    color: #fff;
    padding: 2px 12px;
    border-radius: 12px;
    font-size: 0.65rem;
    font-weight: 700;
    text-transform: uppercase;
    margin-top: 6px;
    letter-spacing: 1px;
}
.receipt-meta-row {
    display: flex;
    justify-content: space-between;
    font-size: 0.82rem;
    color: #555;
    margin-bottom: 0.75rem;
}
.receipt-divider {
    border-top: 1px dashed #ccc;
    margin: 0.75rem 0;
}
.receipt-body-details {
    margin-bottom: 1rem;
}
.receipt-row {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
    font-size: 0.82rem;
    border-bottom: 1px dotted #eee;
}
.receipt-label { color: #777; }
.receipt-value {
    font-weight: 600;
    color: #333;
    text-align: right;
    max-width: 55%;
    word-break: break-word;
}
.receipt-amount-box {
    background: linear-gradient(135deg, #ecf0f1, #f0f3f5);
    padding: 0.75rem;
    border-radius: 10px;
    text-align: center;
    margin: 1rem 0 0.5rem;
}
.receipt-amount-label {
    display: block;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #888;
    margin-bottom: 4px;
}
.receipt-amount-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: #2c3e50;
}
.receipt-amount-words {
    text-align: center;
    font-style: italic;
    font-size: 0.72rem;
    color: #999;
    margin-bottom: 1.5rem;
}
.receipt-signatures {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
}
.sig-block {
    text-align: center;
    font-size: 0.72rem;
    color: #777;
}
.sig-line {
    width: 100px;
    border-bottom: 1px solid #333;
    margin: 0 auto 5px;
}
.receipt-footer-note {
    text-align: center;
    font-size: 0.62rem;
    color: #bbb;
    margin-top: 1.5rem;
}
</style>
