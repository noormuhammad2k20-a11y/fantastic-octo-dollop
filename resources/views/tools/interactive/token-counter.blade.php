<div class="row g-4">
    {{-- Input Card --}}
    <div class="col-lg-12">
        <div class="calculator-card shadow-sm border-0">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label-custom mb-0">Input Content</label>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light-custom" id="btn-sample" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-vial me-1"></i> Sample
                            </button>
                            <button class="btn btn-sm btn-light-custom" id="btn-clear" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-trash-alt me-1"></i> Clear
                            </button>
                        </div>
                    </div>
                    <textarea id="input-text" class="form-control tool-textarea" rows="10" placeholder="Paste your text here for deep analysis..."></textarea>
                </div>

                {{-- Metrics Grid --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="p-3 rounded-4 border bg-white text-center shadow-sm">
                            <h3 class="fw-bold text-primary mb-1" id="stat-tokens">0</h3>
                            <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Est. Tokens</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded-4 border bg-white text-center shadow-sm">
                            <h3 class="fw-bold text-success mb-1" id="stat-words">0</h3>
                            <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Word Count</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded-4 border bg-white text-center shadow-sm">
                            <h3 class="fw-bold text-info mb-1" id="stat-chars">0</h3>
                            <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Char Count</p>
                        </div>
                    </div>
                </div>

                {{-- Analysis Card --}}
                <div class="p-4 rounded-4" style="background:#f8fafc; border:1px solid #e2e8f0;">
                    <h6 class="fw-bold text-dark mb-4 small text-uppercase letter-spacing-1 d-flex align-items-center">
                        <i class="fas fa-brain me-2 text-primary"></i> Context Window Usage
                    </h6>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-white border">
                                <div class="d-flex justify-content-between align-items-end mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-0">GPT-4o / GPT-4</h6>
                                        <div class="x-small text-muted">128k Tokens</div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill px-3" id="gpt4-percent">0%</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 8px;">
                                    <div id="gpt4-progress" class="progress-bar bg-primary progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-white border">
                                <div class="d-flex justify-content-between align-items-end mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-0">Claude 3.5 Sonnet</h6>
                                        <div class="x-small text-muted">200k Tokens</div>
                                    </div>
                                    <span class="badge bg-info text-white rounded-pill px-3" id="claude-percent">0%</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 8px;">
                                    <div id="claude-progress" class="progress-bar bg-info progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.calculator-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 24px; padding: 2rem; }
.calculator-header { display: flex; align-items: center; gap: 1.25rem; margin-bottom: 2rem; }
.calculator-header h4 { margin: 0; font-weight: 800; color: #1e293b; letter-spacing: -0.02em; }
.calculator-header p { margin: 0; font-size: 0.95rem; color: #64748b; }
.tool-icon-circle { width: 64px; height: 64px; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; flex-shrink: 0; }
.form-label-custom { font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }
.tool-textarea { border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 1.25rem; font-family: 'Inter', sans-serif; font-size: 1.1rem; transition: all 0.2s; }
.tool-textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79,70,229,0.1); outline: none; }
.btn-light-custom { background: #f1f5f9; border: none; color: #475569; font-weight: 600; border-radius: 10px; }
.btn-light-custom:hover { background: #e2e8f0; color: #1e293b; }
.letter-spacing-1 { letter-spacing: 1px; }
.x-small { font-size: 0.75rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const statTokens = document.getElementById('stat-tokens');
    const statWords = document.getElementById('stat-words');
    const statChars = document.getElementById('stat-chars');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    
    const gpt4Prog = document.getElementById('gpt4-progress');
    const gpt4Perc = document.getElementById('gpt4-percent');
    const claudeProg = document.getElementById('claude-progress');
    const claudePerc = document.getElementById('claude-percent');

    function updateStats() {
        const text = input.value;
        const charCount = text.length;
        const wordCount = text.trim() ? text.trim().split(/\s+/).length : 0;
        
        // Rough token estimate (Total Chars / 4 is standard for English content)
        const tokenEstimate = Math.ceil(charCount / 4);

        statChars.textContent = charCount.toLocaleString();
        statWords.textContent = wordCount.toLocaleString();
        statTokens.textContent = tokenEstimate.toLocaleString();

        const gpt4Max = 128000;
        const claudeMax = 200000;

        const gpt4P = Math.min((tokenEstimate / gpt4Max) * 100, 100).toFixed(2);
        const claudeP = Math.min((tokenEstimate / claudeMax) * 100, 100).toFixed(2);

        gpt4Prog.style.width = gpt4P + '%';
        gpt4Perc.textContent = (gpt4P < 0.01 && tokenEstimate > 0 ? "0.01" : gpt4P) + '%';
        claudeProg.style.width = claudeP + '%';
        claudePerc.textContent = (claudeP < 0.01 && tokenEstimate > 0 ? "0.01" : claudeP) + '%';
    }

    input.addEventListener('input', updateStats);
    
    btnClear.addEventListener('click', () => {
        input.value = '';
        updateStats();
    });

    btnSample.addEventListener('click', () => {
        input.value = "Tokens are the basic units of text that LLMs process. For English text, 1,000 tokens is approximately 750 words. This estimate helps you gauge context window usage and pricing across various AI models like GPT-4, Claude, and Gemini.";
        updateStats();
    });

    // Initial
    updateStats();
});
</script>

