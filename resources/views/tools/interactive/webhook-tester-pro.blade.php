<div class="row g-4 webhook-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0 overflow-hidden" style="border-radius: 24px; background: #0f172a; box-shadow: 0 4px 30px rgba(16, 185, 129, .1);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm pulse-green" style="background: linear-gradient(135deg, #10b981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-satellite-dish"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0 text-white" style="letter-spacing: -0.5px;">Webhook Deep-Inspector</h4>
                    <p class="text-slate-400 small mb-0">Debug incoming HTTP callbacks in real-time. Inspect headers, verify payloads, and simulate service responses.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    {{-- Endpoint Section --}}
                    <div class="col-md-7">
                        <div class="p-4 rounded-4 bg-slate-900 border border-slate-800 h-100">
                            <h6 class="fw-bold small mb-3 uppercase text-emerald-500">Your Unique Endpoint</h6>
                            <div class="input-group input-group-lg bg-slate-950 rounded-4 overflow-hidden border border-slate-700 shadow-lg">
                                <input type="text" id="w-url" class="form-control border-0 bg-transparent text-emerald-400 fw-bold small" value="https://toolshub.io/webhook/{{ Str::random(12) }}" readonly>
                                <button class="btn btn-emerald text-white px-4 fw-bold" id="copy-url" style="min-width: 280px; max-width: 100%;">COPY URL</button>
                            </div>
                            <div class="mt-3 d-flex align-items-center gap-2">
                                <span class="badge bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-2 rounded-pill small fw-bold">
                                    <i class="fas fa-circle-notch fa-spin me-2"></i>WAITING FOR REQUESTS...
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Local Settings --}}
                    <div class="col-md-5">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-slate-900 border-slate-800">
                            <h6 class="fw-bold small mb-3 uppercase text-slate-500">Response Configuration</h6>
                            <div class="vstack gap-3">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label-custom text-slate-400">Status Code</label>
                                        <select id="w-status" class="form-select border-0 bg-slate-800 text-white rounded-3 fw-bold">
                                            <option value="200">200 OK</option>
                                            <option value="201">201 Created</option>
                                            <option value="204">204 No Content</option>
                                            <option value="400">400 Bad Request</option>
                                            <option value="500">500 Server Error</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label-custom text-slate-400">Content-Type</label>
                                        <select id="w-type" class="form-select border-0 bg-slate-800 text-white rounded-3 fw-bold">
                                            <option value="json">application/json</option>
                                            <option value="xml">text/xml</option>
                                            <option value="text">text/plain</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn d-block mx-auto btn-outline-emerald rounded-4 fw-bold shadow-sm py-3 px-5 fw-bold rounded-pill shadow-sm" id="send-test" style="min-width: 280px; max-width: 100%;">
                                    <i class="fas fa-paper-plane me-2"></i>Send Test Request
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ LOGS CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue: 150; --tool-color: #10b981; --tool-bg: rgba(16, 185, 129, .04);">
            <div class="p-4 bg-white border-top rounded-bottom-5 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0"><i class="fas fa-list me-2 opacity-50"></i>Request History</h5>
                    <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold" id="clear-logs" style="min-width: 280px; max-width: 100%;">Clear Logs</button>
                </div>
                
                <div id="logs-container" class="vstack gap-3">
                    {{-- Empty State --}}
                    <div class="text-center py-5 opacity-50" id="empty-logs">
                        <i class="fas fa-terminal fa-3x mb-3"></i>
                        <p class="fw-bold">No requests received yet.<br>Point your service to the URL above to start debugging.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const logsE = $('logs-container'), emptyE = $('empty-logs');
    
    function addLog(method, headers, body) {
        emptyE.style.display = 'none';
        const id = 'req-' + Date.now();
        const now = new Date().toLocaleTimeString();
        
        const logHtml = `
            <div class="p-4 rounded-4 border bg-white shadow-sm request-log-item" id="${id}">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-emerald-500 text-white px-3 py-1 rounded-pill fw-bold">${method}</span>
                        <span class="small fw-bold text-muted">${now}</span>
                        <span class="text-slate-400 small">IP: 192.168.1.1 (Simulated)</span>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-light btn-sm rounded-pill fw-bold" onclick="window.toggleLog('${id}')">INSPECT</button>
                        <button class="btn btn-light btn-sm rounded-pill text-danger fw-bold" onclick="document.getElementById('${id}').remove()">DELETE</button>
                    </div>
                </div>
                <div class="log-detail d-none mt-3 border-top pt-3">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <h6 class="fw-bold small uppercase text-slate-400">Headers</h6>
                            <pre class="bg-light p-3 rounded-3 font-monospace small mb-0">${JSON.stringify(headers, null, 2)}</pre>
                        </div>
                        <div class="col-md-7">
                            <h6 class="fw-bold small uppercase text-slate-400">Payload</h6>
                            <pre class="bg-slate-900 text-emerald-400 p-3 rounded-3 font-monospace small mb-0">${JSON.stringify(body, null, 2)}</pre>
                        </div>
                    </div>
                </div>
            </div>
        `;
        logsE.insertAdjacentHTML('afterbegin', logHtml);
    }

    window.toggleLog = id => {
        const el = $(id).querySelector('.log-detail');
        el.classList.toggle('d-none');
    };

    $('copy-url').addEventListener('click', function(){
        navigator.clipboard.writeText($('w-url').value).then(() => {
            const o = this.innerHTML; this.innerHTML = 'COPIED!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('send-test').addEventListener('click', () => {
        const testHeaders = {
            "Host": "toolshub.io",
            "User-Agent": "ToolsHub-Webhook-Simulator/1.0",
            "Content-Type": "application/json",
            "X-Signature": "sha256=" + Math.random().toString(16).slice(2)
        };
        const testBody = {
            "event": "payment.succeeded",
            "created": Date.now(),
            "data": {
                "id": "evt_" + Math.random().toString(36).slice(2, 9),
                "amount": 2999,
                "currency": "usd",
                "customer": "cus_test_123"
            }
        };
        addLog('POST', testHeaders, testBody);
    });

    $('clear-logs').addEventListener('click', () => {
        logsE.innerHTML = '';
        logsE.appendChild(emptyE);
        emptyE.style.display = 'block';
    });
});
</script>

<style>
.webhook-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#94a3b8;opacity:.7;margin-bottom:8px;display:block}
.webhook-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-emerald { background: #10b981; color: #fff; transition: all .3s; }
.btn-emerald:hover { background: #059669; color: #fff; transform: translateY(-2px); }
.btn-outline-emerald { color: #10b981; border: 2px solid #10b981; background: transparent; transition: all .3s; }
.btn-outline-emerald:hover { background: #10b981; color: #fff; }
.bg-emerald-500 { background-color: #10b981; }
.text-emerald-400 { color: #34d399; }
.bg-slate-900 { background-color: #0f172a; }
.bg-slate-950 { background-color: #020617; }
.pulse-green { animation: green-pulse 2s infinite; }
@keyframes green-pulse { 0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); } 70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); } 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); } }
.font-monospace { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
.request-log-item { animation: slideIn 0.3s ease-out; }
@keyframes slideIn { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
</style>

