<div class="row g-4 unit-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(6, 182, 212, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #06B6D4, #0891B2); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-ruler-combined"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#164e63; letter-spacing: -0.5px;">Universal Unit Dashboard</h4>
                    <p class="text-muted small mb-0">High-precision measurement extraction across 50+ scientific and imperial units.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Category & Precision --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 bg-light border h-100">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Global Parameters</h6>
                            <div class="mb-4">
                                <label class="form-label-custom">Measurement Category</label>
                                <select id="v-cat" class="form-select border-0 bg-white rounded-3 fw-bold py-2">
                                    <option value="length">📏 Length / Distance</option>
                                    <option value="weight">⚖️ Weight / Mass</option>
                                    <option value="temp">🌡️ Temperature</option>
                                    <option value="area">🌍 Area / Land</option>
                                    <option value="volume">🧪 Volume / Liquid</option>
                                    <option value="data">💾 Digital Data Size</option>
                                    <option value="time">⏱️ Time / Duration</option>
                                </select>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Decimal Precision</label>
                                <input type="range" id="v-prec" class="form-range" min="0" max="10" value="4">
                                <div class="text-center small fw-bold text-cyan" id="prec-val">4 Decimal Places</div>
                            </div>
                        </div>
                    </div>

                    {{-- Mapping --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-cyan">
                            <h6 class="fw-bold small mb-3 uppercase text-cyan opacity-70">Unit Mapping</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-5">
                                    <label class="form-label-custom">Source Unit</label>
                                    <select id="v-from" class="form-select border-0 bg-light rounded-3 fw-bold"></select>
                                </div>
                                <div class="col-2 d-flex align-items-end justify-content-center pb-1">
                                    <button class="btn btn-cyan-soft rounded-circle" id="v-swap" style="min-width: 280px; max-width: 100%; width: 40px; height: 40px;"><i class="fas fa-exchange-alt"></i></button>
                                </div>
                                <div class="col-5">
                                    <label class="form-label-custom">Target Unit</label>
                                    <select id="v-to" class="form-select border-0 bg-light rounded-3 fw-bold"></select>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom">Input Magnitude</label>
                                <input type="number" id="v-val" class="form-control border-0 bg-light rounded-3 fw-bold text-cyan h4 mb-0" value="1">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex flex-wrap gap-2">
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-c="length" data-f="mile" data-t="kilometer">Mile to KM</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-c="temp" data-f="celsius" data-t="fahrenheit">C to F</button>
                    <button class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm quick-load" data-c="weight" data-f="pound" data-t="kilogram">Lbs to Kg</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 190; --tool-color: #06B6D4; --tool-bg: rgba(6, 182, 212, .04);">
            <div class="output-hero text-center py-5">
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small" id="out-label">METERS TO KILOMETERS</span>
                <div class="output-hero-value display-1 fw-900 my-2" id="out-val">0</div>
                <div class="badge bg-cyan-soft text-cyan px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-unit">KILOMETERS</div>
            </div>

            <div class="p-4 bg-white border-top">
                <div class="row g-4">
                    {{-- Common Matrix --}}
                    <div class="col-md-7">
                        <h6 class="fw-bold small mb-3 uppercase opacity-50">Cross-Unit Matrix (Common Benchmarks)</h6>
                        <div class="row g-2" id="out-matrix">
                            {{-- JS Injected Benchmarks --}}
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-5 border-start">
                        <div class="ps-md-4">
                            <h6 class="fw-bold small mb-3 uppercase opacity-50">Calculation Identity</h6>
                            <div class="p-3 rounded-4 bg-cyan-50 border border-cyan-100 mb-4">
                                <div class="small fw-bold text-cyan-900 text-center font-monospace" id="out-equation">1 Mile = 1.60934 Kilometers</div>
                            </div>
                            
                            <div class="vstack gap-2">
                                <button class="btn d-block mx-auto btn-cyan rounded-4 fw-bold text-white shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-summary" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-copy me-2"></i>Copy Precise Result
                                </button>
                                <button class="btn btn-outline-dark w-100 py-2 rounded-4 fw-bold" id="reset-calc" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-rotate-left me-2"></i>Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const catE = $('v-cat'), fromE = $('v-from'), toE = $('v-to'), valE = $('v-val'), precE = $('v-prec');

    const units = {
        length: {
            meter: 1, kilometer: 1000, centimeter: 0.01, millimeter: 0.001,
            mile: 1609.34, yard: 0.9144, foot: 0.3048, inch: 0.0254, nautical_mile: 1852
        },
        weight: {
            kilogram: 1, gram: 0.001, milligram: 0.000001, metric_ton: 1000,
            pound: 0.453592, ounce: 0.0283495, stone: 6.35029
        },
        area: {
            sq_meter: 1, sq_km: 1000000, sq_mile: 2589988.11, acre: 4046.86, hectare: 10000, sq_foot: 0.092903
        },
        volume: {
            liter: 1, ml: 0.001, cubic_meter: 1000, gallon: 3.78541, quart: 0.946353, cup: 0.236588, fluid_ounce: 0.0295735
        },
        data: {
            bit: 0.125, byte: 1, kb: 1024, mb: 1048576, gb: 1073741824, tb: 1099511627776
        },
        time: {
            second: 1, minute: 60, hour: 3600, day: 86400, week: 604800, year: 31536000
        }
    };

    function populate(){
        const c = catE.value;
        fromE.innerHTML = ''; toE.innerHTML = '';
        if(c === 'temp'){
            ['Celsius', 'Fahrenheit', 'Kelvin'].forEach(u => {
                fromE.add(new Option(u, u.toLowerCase()));
                toE.add(new Option(u, u.toLowerCase()));
            });
        } else {
            Object.keys(units[c]).forEach(u => {
                const label = u.replace(/_/g, ' ').toUpperCase();
                fromE.add(new Option(label, u));
                toE.add(new Option(label, u));
            });
        }
        toE.selectedIndex = 1;
        calculate();
    }

    function calculate(){
        const c = catE.value;
        const v = parseFloat(valE.value) || 0;
        const p = parseInt(precE.value);
        const f = fromE.value;
        const t = toE.value;

        $('prec-val').textContent = p + ' Decimal Places';

        let res = 0;
        if(c === 'temp'){
            let baseC = (f === 'celsius') ? v : (f === 'fahrenheit' ? (v-32)*5/9 : v-273.15);
            res = (t === 'celsius') ? baseC : (t === 'fahrenheit' ? (baseC*9/5)+32 : baseC+273.15);
        } else {
            const fR = units[c][f];
            const tR = units[c][t];
            res = v * (fR / tR);
        }

        $('out-val').textContent = res % 1 === 0 ? res.toLocaleString() : res.toFixed(p);
        $('out-unit').textContent = toE.options[toE.selectedIndex].text;
        $('out-label').textContent = `${fromE.options[fromE.selectedIndex].text} TO ${$('out-unit').textContent}`;
        $('out-equation').textContent = `1 ${f} = ${c==='temp'?'Formula Mapping':(units[c][f]/units[c][t]).toFixed(p)} ${t}`;

        // Matrix
        let mHtml = '';
        if(c !== 'temp'){
            Object.keys(units[c]).slice(0, 8).forEach(key => {
                if(key !== f){
                    let mRes = v * (units[c][f] / units[c][key]);
                    mHtml += `<div class="col-6"><div class="p-2 border rounded-3 bg-light small fw-bold text-muted">${mRes.toFixed(2)} ${key.toUpperCase()}</div></div>`;
                }
            });
        }
        $('out-matrix').innerHTML = mHtml;
    }

    catE.addEventListener('change', populate);
    [fromE, toE, valE, precE].forEach(e => e.addEventListener('input', calculate));

    $('v-swap').addEventListener('click', () => {
        const tmp = fromE.value;
        fromE.value = toE.value;
        toE.value = tmp;
        calculate();
    });

    document.querySelectorAll('.quick-load').forEach(btn => {
        btn.addEventListener('click', () => {
            catE.value = btn.dataset.c;
            populate();
            fromE.value = btn.dataset.f;
            toE.value = btn.dataset.t;
            calculate();
        });
    });

    $('copy-summary').addEventListener('click', function(){
        const txt = `${valE.value} ${fromE.options[fromE.selectedIndex].text} = ${$('out-val').textContent} ${$('out-unit').textContent}\nGenerated by ToolsHub Universal Unit Dashboard`;
        navigator.clipboard.writeText(txt).then(() => {
            const o = this.innerHTML; this.innerHTML = '<i class="fas fa-check me-2"></i>Result Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('reset-calc').addEventListener('click', () => {
        catE.value = 'length'; populate(); valE.value = 1; precE.value = 4; calculate();
    });

    populate();
});
</script>

<style>
.unit-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#164e63;opacity:.7;margin-bottom:8px;display:block}
.unit-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-cyan { background: #06B6D4; color: #fff; transition: all .3s; }
.btn-cyan:hover { background: #0891B2; color: #fff; transform: translateY(-2px); }
.btn-cyan-soft { background: #ECFEFF; color: #0891B2; border: 1px solid #cffafe; }
.text-cyan { color: #06B6D4; }
.text-cyan-900 { color: #164e63; }
.bg-cyan-soft { background: #ECFEFF; }
.bg-cyan-50 { background-color: #f0fdff; }
.bg-cyan { background-color: #06B6D4 !important; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

