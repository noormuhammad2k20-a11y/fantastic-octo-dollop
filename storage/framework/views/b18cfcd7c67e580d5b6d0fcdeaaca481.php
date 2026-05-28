<div class="row g-4 twitter-timestamp-v2">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label-custom">Snowflake ID (Status or User ID)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-fingerprint text-muted"></i></span>
                            <input type="text" id="snowflake-input" class="form-control form-control-lg border-start-0 rounded-end-3" placeholder="e.g. 1775656578350" value="1775656578350">
                        </div>
                        <span class="text-muted x-small mt-2 d-block">Supports Status IDs, User IDs, and other Twitter Snowflake formats.</span>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Display Timezone</label>
                        <select id="timezone-select" class="form-select form-select-lg rounded-3">
                            <option value="local" selected>Local Time</option>
                            <option value="UTC">UTC</option>
                            <option value="America/New_York">New York (EST/EDT)</option>
                            <option value="Europe/London">London (GMT/BST)</option>
                            <option value="Asia/Tokyo">Tokyo (JST)</option>
                            <option value="Asia/Dubai">Dubai (GST)</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-dark flex-grow-1 py-3 fw-bold rounded-pill shadow-sm" id="btn-resolve">
                        <i class="fas fa-bolt me-2 text-warning"></i> Resolve Timestamp
                    </button>
                    <button type="button" class="btn btn-outline-secondary px-4 fw-bold rounded-pill shadow-sm" id="btn-reset">
                        <i class="fas fa-undo me-2"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="timestamp-output-card" style="--tool-hue:222;--tool-color:#0f172a;--tool-bg:rgba(15,23,42,.03);">
            <div class="output-hero">
                <span class="output-hero-label">Resolved Creation Date</span>
                <div class="output-hero-value" id="out-full-date" style="font-size:2.5rem">--</div>
                <span class="output-hero-unit" id="out-relative-time">--</span>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label"><i class="far fa-calendar-alt me-1"></i> Exact Date</span>
                        <span class="stat-card-value" id="out-date">--</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label"><i class="far fa-clock me-1"></i> Exact Time</span>
                        <span class="stat-card-value" id="out-time">--</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <span class="stat-card-label"><i class="fas fa-globe me-1"></i> Timezone</span>
                        <span class="stat-card-value" id="out-timezone">--</span>
                    </div>
                </div>
            </div>

            <div class="mt-5 p-4 rounded-4 bg-white border shadow-sm">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>About Twitter Snowflakes</h6>
                <p class="small text-secondary mb-0">
                    A Twitter Snowflake is a 64-bit unsigned integer used by X (formerly Twitter) to generate unique IDs for objects like tweets and users. 
                    These IDs are roughly sortable by time because they contain a timestamp encoded in the first 41 bits.
                </p>
                <div class="mt-3 font-monospace x-small bg-light p-2 rounded border">
                    Formula: (ID >> 22) + 1288834974657 (Twitter Epoch)
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-5 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Timestamp Report
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const snowflakeInput = document.getElementById('snowflake-input');
    const timezoneSelect = document.getElementById('timezone-select');
    const outFullDate = document.getElementById('out-full-date');
    const outRelativeTime = document.getElementById('out-relative-time');
    const outDate = document.getElementById('out-date');
    const outTime = document.getElementById('out-time');
    const outTimezone = document.getElementById('out-timezone');

    const TWITTER_EPOCH = 1288834974657n;

    function resolve() {
        const idStr = snowflakeInput.value.trim();
        if (!idStr || isNaN(idStr)) return;

        try {
            const id = BigInt(idStr);
            const timestampMs = (id >> 22n) + TWITTER_EPOCH;
            const date = new Date(Number(timestampMs));

            const tz = timezoneSelect.value === 'local' ? undefined : timezoneSelect.value;
            const optionsDate = { year: 'numeric', month: 'long', day: 'numeric', timeZone: tz };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true, timeZoneName: 'short', timeZone: tz };

            const formattedDate = date.toLocaleDateString('en-US', optionsDate);
            const formattedTime = date.toLocaleTimeString('en-US', optionsTime);
            
            outFullDate.textContent = formattedDate;
            outDate.textContent = formattedDate;
            outTime.textContent = formattedTime.split(' ').slice(0, 2).join(' ');
            outTimezone.textContent = formattedTime.split(' ').slice(2).join(' ') || (tz || 'Local');

            // Relative time
            const now = new Date();
            const diffSeconds = Math.floor((now - date) / 1000);
            let relative = '';
            if (diffSeconds < 60) relative = 'Just now';
            else if (diffSeconds < 3600) relative = Math.floor(diffSeconds/60) + ' minutes ago';
            else if (diffSeconds < 86400) relative = Math.floor(diffSeconds/3600) + ' hours ago';
            else if (diffSeconds < 2592000) relative = Math.floor(diffSeconds/86400) + ' days ago';
            else if (diffSeconds < 31536000) relative = Math.floor(diffSeconds/2592000) + ' months ago';
            else relative = Math.floor(diffSeconds/31536000) + ' years ago';

            outRelativeTime.textContent = relative;

        } catch (e) {
            console.error(e);
            outFullDate.textContent = 'Invalid ID';
        }
    }

    snowflakeInput.addEventListener('input', resolve);
    timezoneSelect.addEventListener('change', resolve);
    document.getElementById('btn-resolve').addEventListener('click', resolve);
    document.getElementById('btn-reset').addEventListener('click', () => {
        snowflakeInput.value = '';
        resolve();
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const summary = `Twitter Snowflake Report\nID: ${snowflakeInput.value}\nDate: ${outDate.textContent}\nTime: ${outTime.textContent} (${outTimezone.textContent})\nRelative: ${outRelativeTime.textContent}\n— ToolsHub Twitter Utilities`;
        navigator.clipboard.writeText(summary).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    resolve();
});
</script>

<style>
.twitter-timestamp-v2 .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:24px; padding:2.5rem; box-shadow:0 8px 48px rgba(15,23,42,.05); }
.twitter-timestamp-v2 .calculator-header { display:flex; align-items:center; gap:1.25rem; margin-bottom:2.5rem; }
.twitter-timestamp-v2 .calculator-header h4 { margin:0; font-weight:900; color:#0f172a; letter-spacing:-1px; font-size:1.5rem; }
.twitter-timestamp-v2 .calculator-header p { margin:0; font-size:1rem; color:#64748b; line-height:1.6; }
.twitter-timestamp-v2 .tool-icon-circle { width:64px; height:64px; border-radius:18px; display:flex; align-items:center; justify-content:center; font-size:1.8rem; flex-shrink:0; }
.twitter-timestamp-v2 .form-label-custom { font-size:.75rem; font-weight:800; color:#1e293b; text-transform:uppercase; letter-spacing:1.2px; margin-bottom:.75rem; display:block; }
.twitter-timestamp-v2 .x-small { font-size: 0.7rem; }

/* VIP Output Styles */
.twitter-timestamp-v2 .output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.08); }
.twitter-timestamp-v2 .output-hero { text-align: center; margin-bottom: 1.5rem; }
.twitter-timestamp-v2 .output-hero-label { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; color: #64748b; }
.twitter-timestamp-v2 .output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color); line-height: 1.1; margin: 0.5rem 0; letter-spacing: -2px; }
.twitter-timestamp-v2 .output-hero-unit { font-size: 1.1rem; color: #64748b; font-weight: 700; background: rgba(0,0,0,0.05); padding: 5px 15px; border-radius: 50px; display: inline-block; }

.twitter-timestamp-v2 .stat-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 1.25rem; text-align: center; transition: all 0.3s ease; }
.twitter-timestamp-v2 .stat-card:hover { transform: translateY(-5px); border-color: var(--tool-color); box-shadow: 0 10px 20px rgba(0,0,0,.05); }
.twitter-timestamp-v2 .stat-card-label { display: block; font-size: .65rem; font-weight: 800; text-transform: uppercase; color: #94a3b8; letter-spacing: 1px; margin-bottom: 8px; }
.twitter-timestamp-v2 .stat-card-value { font-size: 1.25rem; font-weight: 900; color: #1e293b; display: block; }

@media (max-width: 768px) {
    .twitter-timestamp-v2 .calculator-card, .twitter-timestamp-v2 .output-card-themed { padding: 1.5rem; }
    .twitter-timestamp-v2 .output-hero-value { font-size: 2rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\twitter-timestamp-resolver.blade.php ENDPATH**/ ?>