<div class="row g-4 ua-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Device Type</label>
                        <select id="ua-device" class="form-select form-select-lg">
                            <option value="any" selected>Any Device</option>
                            <option value="desktop">Desktop (Windows / Mac / Linux)</option>
                            <option value="mobile">Mobile (iOS / Android)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Browser Engine</label>
                        <select id="ua-browser" class="form-select form-select-lg">
                            <option value="any" selected>Any Browser</option>
                            <option value="chrome">Chrome (Blink)</option>
                            <option value="firefox">Firefox (Gecko)</option>
                            <option value="safari">Safari (WebKit)</option>
                            <option value="edge">Edge</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-warning fw-bold text-white fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="ua-generate" style="min-width: 280px; max-width: 100%; background:#f97316; border:none;">
                    <i class="fas fa-sync-alt me-2"></i>Generate User-Agent
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="ua-output-card" style="--tool-hue:25;--tool-color:#ea580c;--tool-bg:rgba(249,115,22,.04); border-color:#fed7aa;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-terminal me-2" style="color:#ea580c"></i>User-Agent String</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-ua" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy</button>
            </div>
            
            <div class="bg-white p-3 border rounded-3 mb-3">
                <code id="ua-string" class="fs-6 text-dark" style="word-break: break-all;"></code>
            </div>

            <div class="d-flex gap-3">
                <span class="badge bg-light border text-dark fs-6" id="ua-badge-os"><i class="fab fa-windows me-1"></i> Windows 10</span>
                <span class="badge bg-light border text-dark fs-6" id="ua-badge-br"><i class="fab fa-chrome me-1"></i> Chrome</span>
            </div>
        </div>
    </div>
</div>

<style>
.ua-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.ua-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.ua-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.ua-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.ua-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.ua-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const uas = [
        // Windows Chrome
        { d: 'desktop', b: 'chrome', s: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', os: 'Windows 10', br: 'Chrome', i_os: 'fa-windows', i_br: 'fa-chrome' },
        { d: 'desktop', b: 'chrome', s: 'Mozilla/5.0 (Windows NT 11.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', os: 'Windows 11', br: 'Chrome', i_os: 'fa-windows', i_br: 'fa-chrome' },
        // Mac Chrome
        { d: 'desktop', b: 'chrome', s: 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', os: 'macOS', br: 'Chrome', i_os: 'fa-apple', i_br: 'fa-chrome' },
        // Windows Edge
        { d: 'desktop', b: 'edge', s: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.0.0', os: 'Windows 10', br: 'Edge', i_os: 'fa-windows', i_br: 'fa-edge' },
        // Mac Safari
        { d: 'desktop', b: 'safari', s: 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15', os: 'macOS', br: 'Safari', i_os: 'fa-apple', i_br: 'fa-safari' },
        // Windows Firefox
        { d: 'desktop', b: 'firefox', s: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', os: 'Windows 10', br: 'Firefox', i_os: 'fa-windows', i_br: 'fa-firefox' },
        { d: 'desktop', b: 'firefox', s: 'Mozilla/5.0 (Windows NT 11.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', os: 'Windows 11', br: 'Firefox', i_os: 'fa-windows', i_br: 'fa-firefox' },
        // Linux Firefox
        { d: 'desktop', b: 'firefox', s: 'Mozilla/5.0 (X11; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0', os: 'Linux', br: 'Firefox', i_os: 'fa-linux', i_br: 'fa-firefox' },
        
        // iOS Safari
        { d: 'mobile', b: 'safari', s: 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1', os: 'iOS', br: 'Safari', i_os: 'fa-apple', i_br: 'fa-safari' },
        { d: 'mobile', b: 'safari', s: 'Mozilla/5.0 (iPad; CPU OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1', os: 'iPadOS', br: 'Safari', i_os: 'fa-apple', i_br: 'fa-safari' },
        // Android Chrome
        { d: 'mobile', b: 'chrome', s: 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36', os: 'Android', br: 'Chrome', i_os: 'fa-android', i_br: 'fa-chrome' },
        { d: 'mobile', b: 'chrome', s: 'Mozilla/5.0 (Linux; Android 13; SM-S918B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36', os: 'Android', br: 'Chrome', i_os: 'fa-android', i_br: 'fa-chrome' },
        // Android Firefox
        { d: 'mobile', b: 'firefox', s: 'Mozilla/5.0 (Android 13; Mobile; rv:120.0) Gecko/120.0 Firefox/120.0', os: 'Android', br: 'Firefox', i_os: 'fa-android', i_br: 'fa-firefox' }
    ];

    $('ua-generate').addEventListener('click', function() {
        const dType = $('ua-device').value;
        const bType = $('ua-browser').value;

        let filtered = uas;
        if (dType !== 'any') filtered = filtered.filter(u => u.d === dType);
        if (bType !== 'any') filtered = filtered.filter(u => u.b === bType);

        if (filtered.length === 0) {
            // Fallback
            filtered = uas;
        }

        const ua = filtered[Math.floor(Math.random() * filtered.length)];

        $('ua-string').textContent = ua.s;
        $('ua-badge-os').innerHTML = `<i class="fab ${ua.i_os} me-1"></i> ${ua.os}`;
        $('ua-badge-br').innerHTML = `<i class="fab ${ua.i_br} me-1"></i> ${ua.br}`;

        $('ua-output-card').classList.remove('d-none');
        $('ua-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-ua').addEventListener('click', function() {
        navigator.clipboard.writeText($('ua-string').textContent).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

