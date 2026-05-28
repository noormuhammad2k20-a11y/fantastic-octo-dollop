<div class="row g-4 bingo-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Card Title</label>
                        <input type="text" id="bingo-title" class="form-control form-control-lg" value="BINGO" placeholder="e.g., Party Bingo">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Grid Size</label>
                        <select id="bingo-size" class="form-select form-select-lg">
                            <option value="3">3x3 Grid</option>
                            <option value="4">4x4 Grid</option>
                            <option value="5" selected>5x5 Grid (Standard)</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Content Mode</label>
                        <div class="d-flex gap-2 mb-3">
                            <button type="button" class="btn btn-outline-primary active flex-grow-1" id="mode-numbers" style="min-width: 280px; max-width: 100%;">🔢 Numbers (1-75)</button>
                            <button type="button" class="btn btn-outline-primary flex-grow-1" id="mode-custom" style="min-width: 280px; max-width: 100%;">✍️ Custom Words</button>
                        </div>
                    </div>
                    <div id="custom-words-container" class="col-md-12 d-none">
                        <label class="form-label-custom">Word List (One per line, min <span id="min-words">24</span>)</label>
                        <textarea id="bingo-words" class="form-control" rows="5" placeholder="Enter one word or phrase per line..."></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Number of Cards</label>
                        <input type="number" id="bingo-count" class="form-control form-control-lg" value="1" min="1" max="50">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Options</label>
                        <div class="form-check form-switch pt-2">
                            <input class="form-check-input" type="checkbox" id="bingo-free-space" checked>
                            <label class="form-check-label" for="bingo-free-space">Include "FREE" Center Space</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-primary py-3 px-5 fw-bold rounded-pill shadow-sm" id="bingo-generate" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-magic me-2"></i>Generate Bingo Cards
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="bingo-output-card" style="--tool-hue:270;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04);">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="fw-bold mb-0"><i class="fas fa-print me-2 text-primary"></i>Generated Cards</h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-dark" id="bingo-print" style="min-width: 280px; max-width: 100%;"><i class="fas fa-print me-1"></i>Print All</button>
                    <button class="btn btn-sm btn-outline-dark" id="bingo-clear" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash-alt me-1"></i>Clear</button>
                </div>
            </div>
            
            <div id="bingo-cards-grid" class="bingo-grid-display">
                <!-- Cards will be injected here -->
            </div>
        </div>
    </div>
</div>

<style>
.bingo-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.bingo-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.bingo-generator-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.bingo-generator-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.bingo-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.bingo-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

.bingo-grid-display {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: center;
}

.bingo-card-item {
    background: white;
    border: 2px solid #000;
    padding: 1rem;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
}

.bingo-card-header {
    text-align: center;
    font-size: 2rem;
    font-weight: 900;
    letter-spacing: 5px;
    margin-bottom: 0.5rem;
    border-bottom: 2px solid #000;
}

.bingo-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

.bingo-table td {
    border: 1px solid #000;
    height: 60px;
    text-align: center;
    vertical-align: middle;
    font-weight: 700;
    font-size: 1.1rem;
    word-break: break-word;
    padding: 4px;
}

.bingo-free {
    background: #f8fafc;
    font-size: 0.7rem !important;
    color: #64748b;
}

@media print {
    body * { visibility: hidden; }
    .bingo-grid-display, .bingo-grid-display * { visibility: visible; }
    .bingo-grid-display { position: absolute; left: 0; top: 0; display: block; width: 100%; }
    .bingo-card-item { page-break-after: always; margin: 0 auto 2rem; box-shadow: none; border: 2px solid #000; }
    .btn, .calculator-card, .tool-page-header, .navbar, .footer { display: none !important; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    let mode = 'numbers';

    $('mode-numbers').addEventListener('click', () => {
        mode = 'numbers';
        $('mode-numbers').classList.add('active');
        $('mode-custom').classList.remove('active');
        $('custom-words-container').classList.add('d-none');
    });

    $('mode-custom').addEventListener('click', () => {
        mode = 'custom';
        $('mode-custom').classList.add('active');
        $('mode-numbers').classList.remove('active');
        $('custom-words-container').classList.remove('d-none');
    });

    $('bingo-size').addEventListener('change', function() {
        const size = parseInt(this.value);
        $('min-words').textContent = size * size - ($('bingo-free-space').checked ? 1 : 0);
    });

    $('bingo-generate').addEventListener('click', generateBingo);
    $('bingo-print').addEventListener('click', () => window.print());
    $('bingo-clear').addEventListener('click', () => {
        $('bingo-cards-grid').innerHTML = '';
        $('bingo-output-card').classList.add('d-none');
    });

    function generateBingo() {
        const title = $('bingo-title').value || 'BINGO';
        const size = parseInt($('bingo-size').value);
        const count = parseInt($('bingo-count').value) || 1;
        const freeSpace = $('bingo-free-space').checked;
        const gridContainer = $('bingo-cards-grid');
        gridContainer.innerHTML = '';

        let source = [];
        if (mode === 'numbers') {
            for (let i = 1; i <= 75; i++) source.push(i);
        } else {
            source = $('bingo-words').value.split('\n').map(s => s.trim()).filter(s => s.length > 0);
            const minRequired = size * size - (freeSpace ? 1 : 0);
            if (source.length < minRequired) {
                alert(`Please enter at least ${minRequired} words for a ${size}x${size} grid.`);
                return;
            }
        }

        for (let c = 0; c < count; c++) {
            const cardData = generateSingleCard(source, size, freeSpace);
            const cardHtml = renderCard(title, cardData, size, freeSpace);
            gridContainer.insertAdjacentHTML('beforeend', cardHtml);
        }

        $('bingo-output-card').classList.remove('d-none');
        $('bingo-output-card').scrollIntoView({ behavior: 'smooth' });
    }

    function generateSingleCard(source, size, freeSpace) {
        // Logic for B-I-N-G-O columns if numbers mode
        if (mode === 'numbers' && size === 5) {
            const columns = [
                shuffle([...Array(15).keys()].map(i => i + 1)).slice(0, 5),
                shuffle([...Array(15).keys()].map(i => i + 16)).slice(0, 5),
                shuffle([...Array(15).keys()].map(i => i + 31)).slice(0, 5),
                shuffle([...Array(15).keys()].map(i => i + 46)).slice(0, 5),
                shuffle([...Array(15).keys()].map(i => i + 61)).slice(0, 5)
            ];
            
            const grid = [];
            for(let r=0; r<5; r++) {
                for(let c=0; c<5; c++) {
                    grid.push(columns[c][r]);
                }
            }
            return grid;
        }

        // Generic shuffle for other sizes or custom words
        const items = shuffle([...source]).slice(0, size * size);
        return items;
    }

    function shuffle(array) {
        let currentIndex = array.length, randomIndex;
        while (currentIndex != 0) {
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex--;
            [array[currentIndex], array[randomIndex]] = [array[randomIndex], array[currentIndex]];
        }
        return array;
    }

    function renderCard(title, data, size, freeSpace) {
        let html = `<div class="bingo-card-item">`;
        html += `<div class="bingo-card-header">${title}</div>`;
        html += `<table class="bingo-table">`;
        
        const mid = Math.floor((size * size) / 2);
        
        for (let r = 0; r < size; r++) {
            html += `<tr>`;
            for (let c = 0; c < size; c++) {
                const idx = r * size + c;
                if (freeSpace && idx === mid) {
                    html += `<td class="bingo-free">FREE SPACE</td>`;
                } else {
                    html += `<td>${data[idx]}</td>`;
                }
            }
            html += `</tr>`;
        }
        
        html += `</table></div>`;
        return html;
    }
});
</script>

