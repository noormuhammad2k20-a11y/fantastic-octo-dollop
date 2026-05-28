<div class="row g-4 barcode-rebuilt">
    <!-- Input Card -->
    <div class="col-lg-12">
        <div class="calculator-card">
            

            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Barcode Content</label>
                        <input type="text" id="barcode-value" class="form-control form-control-lg" placeholder="Enter text or numbers" value="123456789012">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Symbology (Format)</label>
                        <select id="barcode-format" class="form-select form-control-lg">
                            <option value="CODE128">Code 128 (Auto)</option>
                            <option value="EAN13">EAN-13 (13 digits)</option>
                            <option value="UPC">UPC (12 digits)</option>
                            <option value="CODE39">Code 39</option>
                            <option value="ITF14">ITF-14</option>
                            <option value="EAN8">EAN-8</option>
                            <option value="pharmacode">Pharmacode</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Human Readable Text</label>
                        <select id="barcode-show-text" class="form-select form-control-lg">
                            <option value="true">Show Text</option>
                            <option value="false">Hide Text</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label-custom">Bar Width: <span id="val-width">2</span>px</label>
                        <input type="range" id="barcode-width" class="form-range" min="1" max="4" step="1" value="2">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label-custom">Bar Height: <span id="val-height">100</span>px</label>
                        <input type="range" id="barcode-height" class="form-range" min="40" max="200" step="1" value="100">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label-custom">Margin: <span id="val-margin">10</span>px</label>
                        <input type="range" id="barcode-margin" class="form-range" min="0" max="50" step="1" value="100">
                    </div>
                </div>

                <div class="row g-2 mt-4">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary w-100 py-3 fw-bold shadow-sm" id="generate-btn">
                            <i class="fas fa-sync-alt me-2"></i> Generate Barcode
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Output Card -->
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:210;--tool-color:#3b82f6;--tool-bg:rgba(59,130,246,.04);">
            <div class="output-hero">
                <span class="output-hero-label">GENERATED OUTPUT</span>
                <div class="barcode-preview-container bg-white border rounded p-4 mt-3 text-center" style="overflow-x: auto; max-width: 100%;">
                    <svg id="barcode-svg"></svg>
                    <canvas id="barcode-canvas" style="display:none;"></canvas>
                </div>
                <div id="error-message" class="text-danger mt-3 fw-bold small d-none text-center">
                    <i class="fas fa-exclamation-circle me-1"></i> Invalid input for selected symbology.
                </div>
            </div>

            <div class="row g-2 mt-4">
                <div class="col-md-4">
                    <button class="btn d-block mx-auto btn-primary py-3 px-4 fw-bold rounded shadow-sm w-100" id="download-btn">
                        <i class="fas fa-download me-2"></i> Download
                    </button>
                </div>
                <div class="col-md-4">
                    <button class="btn d-block mx-auto btn-dark py-3 px-4 fw-bold rounded shadow-sm w-100" id="copy-btn">
                        <i class="fas fa-copy me-2"></i> Copy Output
                    </button>
                </div>
                <div class="col-md-4">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-4 fw-bold rounded shadow-sm w-100" id="reset-btn">
                        <i class="fas fa-rotate-left me-2"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include JsBarcode -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    const valueInp = $('barcode-value');
    const formatSel = $('barcode-format');
    const textSel = $('barcode-show-text');
    const widthInp = $('barcode-width');
    const heightInp = $('barcode-height');
    const marginInp = $('barcode-margin');
    const errorMsg = $('error-message');
    const svgEl = $('barcode-svg');
    const canvasEl = $('barcode-canvas');

    function updateLabels() {
        $('val-width').textContent = widthInp.value;
        $('val-height').textContent = heightInp.value;
        $('val-margin').textContent = marginInp.value;
    }

    function generate() {
        const value = valueInp.value.trim();
        if (!value) return;

        try {
            JsBarcode("#barcode-svg", value, {
                format: formatSel.value,
                width: parseInt(widthInp.value),
                height: parseInt(heightInp.value),
                displayValue: textSel.value === 'true',
                margin: parseInt(marginInp.value),
                background: "#ffffff",
                lineColor: "#000000",
                valid: function(valid) {
                    if (valid) {
                        errorMsg.classList.add('d-none');
                        svgEl.style.display = 'inline-block';
                    } else {
                        errorMsg.classList.remove('d-none');
                        svgEl.style.display = 'none';
                    }
                }
            });
            
            // Also render to canvas for copying/downloading functionality
            JsBarcode("#barcode-canvas", value, {
                format: formatSel.value,
                width: parseInt(widthInp.value),
                height: parseInt(heightInp.value),
                displayValue: textSel.value === 'true',
                margin: parseInt(marginInp.value),
                background: "#ffffff",
                lineColor: "#000000"
            });

        } catch (e) {
            errorMsg.classList.remove('d-none');
            svgEl.style.display = 'none';
        }
    }

    // Event Listeners
    $('generate-btn').addEventListener('click', generate);
    [valueInp, formatSel, textSel, widthInp, heightInp, marginInp].forEach(el => {
        el.addEventListener('input', () => {
            updateLabels();
            generate();
        });
    });

    $('download-btn').addEventListener('click', function() {
        try {
            const url = canvasEl.toDataURL("image/png");
            const a = document.createElement("a");
            a.download = `barcode-${formatSel.value}-${valueInp.value}.png`;
            a.href = url;
            a.click();
        } catch (e) {
            alert("Error downloading barcode.");
        }
    });

    $('copy-btn').addEventListener('click', async function() {
        try {
            canvasEl.toBlob(async (blob) => {
                const item = new ClipboardItem({ "image/png": blob });
                await navigator.clipboard.write([item]);
                const original = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
                this.classList.replace('btn-dark', 'btn-success');
                setTimeout(() => {
                    this.innerHTML = original;
                    this.classList.replace('btn-success', 'btn-dark');
                }, 2000);
            });
        } catch (err) {
            // Fallback: Copy value text if image copy fails
            navigator.clipboard.writeText(valueInp.value);
            alert("Failed to copy image. Text value copied instead.");
        }
    });

    $('reset-btn').addEventListener('click', () => {
        valueInp.value = '123456789012';
        formatSel.value = 'CODE128';
        textSel.value = 'true';
        widthInp.value = 2;
        heightInp.value = 100;
        marginInp.value = 10;
        updateLabels();
        generate();
    });

    // Init
    updateLabels();
    generate();
});
</script>

<style>
.barcode-rebuilt .calculator-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 24px rgba(0,0,0,.04);
}
.barcode-rebuilt .calculator-header {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    margin-bottom: 2rem;
}
.barcode-rebuilt .calculator-header h4 {
    margin: 0;
    font-weight: 800;
    color: #1e293b;
    font-size: 1.25rem; /* Compact heading */
}
.barcode-rebuilt .calculator-header p {
    margin: 0;
    font-size: .85rem;
    color: #64748b;
}
.barcode-rebuilt .tool-icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.barcode-rebuilt .form-label-custom {
    font-size: .75rem; /* Compact labels */
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: .8px;
    margin-bottom: .5rem;
    display: block;
}
.barcode-rebuilt .output-card-themed {
    background: var(--tool-bg);
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    padding: 2.5rem;
    position: relative;
    overflow: hidden;
}
.barcode-rebuilt .output-hero {
    text-align: center;
}
.barcode-rebuilt .output-hero-label {
    font-size: .75rem;
    font-weight: 800;
    color: var(--tool-color);
    letter-spacing: 2px;
    text-transform: uppercase;
    display: block;
    margin-bottom: 1rem;
}
.barcode-rebuilt .barcode-preview-container {
    background: #fff;
    min-height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
}
/* Static UI - No hovers or animations on results */
.barcode-rebuilt .output-card-themed:hover {
    transform: none;
}
.barcode-rebuilt .btn {
    transition: background-color 0.2s;
}
@media (max-width: 768px) {
    .barcode-rebuilt .calculator-card, 
    .barcode-rebuilt .output-card-themed {
        padding: 1.5rem;
    }
}
</style>

