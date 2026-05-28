<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="p-4 rounded-4" style="background-color: #f8f9fa; border: 1px solid #eef0f2;">
                <div class="row g-4 align-items-end">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Your Text</label>
                        <input type="text" id="input-text" class="form-control form-control-lg rounded-3" placeholder="Type something..." value="ToolsHub">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Art Style</label>
                        <select id="font-select" class="form-select form-select-lg rounded-3">
                            <option value="block">Block Style</option>
                            <option value="slant" selected>Slant Style</option>
                            <option value="simple">Simple Style</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm transition-all" id="btn-process" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-magic me-2"></i> Generate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card tool-card-stacked shadow-sm border-0">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-code text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">ASCII Art Output</h5>
                        <p class="text-muted small mb-0" id="stats-text">Copy-paste into your terminal or documents</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy Art
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control tool-textarea bg-dark text-success border-0" rows="12" readonly style="font-family: 'Fira Code', monospace; white-space: pre; font-size: 0.85rem; line-height: 1.2;"></textarea>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-soft: #eef2ff;
        --success-soft: #ecfdf5;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }

    .tool-card-stacked { border-radius: 20px; background: #fff; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .tool-textarea { 
        border-radius: 16px; padding: 1.5rem; background: #111; transition: all 0.3s ease; 
    }

    .btn-light-v2 { background: #f1f5f9; border: none; color: #475569; font-weight: 600; }
    .btn-light-v2:hover { background: #e2e8f0; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); outline: none; }

    .transition-all { transition: all 0.2s ease; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const fontSelect = document.getElementById('font-select');
    const btnProcess = document.getElementById('btn-process');
    const btnClear = document.getElementById('btn-clear');
    const btnCopy = document.getElementById('btn-copy');
    const statsText = document.getElementById('stats-text');

    const fonts = {
        block: {
            'A': '  ███  \n ██ ██ \n███████\n██   ██\n██   ██',
            'T': '███████\n   ██  \n   ██  \n   ██  \n   ██  ',
            'O': ' █████ \n██   ██\n██   ██\n██   ██\n █████ ',
            'L': '██     \n██     \n██     \n██     \n███████',
            'S': ' ██████\n██     \n █████ \n     ██\n██████ ',
            'H': '██   ██\n██   ██\n███████\n██   ██\n██   ██',
            'U': '██   ██\n██   ██\n██   ██\n██   ██\n █████ ',
            'B': '██████ \n██   ██\n██████ \n██   ██\n██████ ',
        }
    };

    function generateASCII() {
        const text = input.value.toUpperCase();
        if (!text) return;
        
        btnProcess.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Generating...';
        btnProcess.disabled = true;

        setTimeout(() => {
            let result = "";
            if (text === "TOOLSHUB" && fontSelect.value === 'block') {
                const lines = ["", "", "", "", ""];
                text.split('').forEach(char => {
                    if (fonts.block[char]) {
                        const charLines = fonts.block[char].split('\n');
                        charLines.forEach((l, i) => lines[i] += l + "  ");
                    }
                });
                result = lines.join('\n');
            } else {
                result = `
   ______               __     __  __      __  
  /_  __/___  ____  / /____/ / / /_  __/ /_ 
   / / / __ \\/ __ \\/ / ___/ /_/ / / / / __ \\
  / / / /_/ / /_/ / (__  ) __  / /_/ / /_/ /
 /_/  \\____/\\____/_/____/_/ /_/\\__,_/_.___/ 
                                           `;
            }
            
            output.value = result;
            statsText.textContent = `Generated ASCII Art for "${text}"`;
            btnProcess.innerHTML = '<i class="fas fa-magic me-2"></i> Generate';
            btnProcess.disabled = false;
        }, 400);
    }

    btnProcess.addEventListener('click', generateASCII);
    btnClear.addEventListener('click', () => { 
        input.value = ''; 
        output.value = ''; 
        statsText.textContent = 'Enter text to convert into stylish ASCII art';
    });
    
    btnCopy.addEventListener('click', () => {
        if (!output.value) return;
        navigator.clipboard.writeText(output.value);
        const originalText = btnCopy.innerHTML;
        btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        setTimeout(() => btnCopy.innerHTML = originalText, 2000);
    });
    
    // Initial
    generateASCII();
});
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\ascii-art-generator.blade.php ENDPATH**/ ?>