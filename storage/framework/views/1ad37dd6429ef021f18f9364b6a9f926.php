<div class="interactive-card">
    <div class="interactive-header">
        <h4><i class="<?php echo e($tool['icon'] ?? 'fas fa-edit'); ?>"></i> <?php echo e($tool['h1']); ?> Workspace</h4>
        <div class="header-actions">
            <button class="btn btn-sm btn-outline-secondary" id="btn-clear-all" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash-alt me-1"></i> Clear</button>
        </div>
    </div>

    <div class="interactive-body">
        <div class="row g-4">
            
            <div class="col-lg-6">
                <label class="form-label-custom">Input Data</label>
                <textarea id="generic-input" class="form-control" rows="12" placeholder="Paste your <?php echo e(strtolower($tool['h1'])); ?> data here..."></textarea>
            </div>

            
            <div class="col-lg-6">
                <label class="form-label-custom">Output Result</label>
                <div class="output-wrapper position-relative">
                    <textarea id="generic-output" class="form-control" rows="12" readonly placeholder="Result will appear here..."></textarea>
                    <button class="btn btn-sm btn-accent btn-copy-output" id="btn-copy-output" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-1"></i> Copy
                    </button>
                </div>
            </div>
        </div>

        
        <div class="action-bar mt-4 text-center">
            <button class="btn btn-lg btn-accent px-5 py-3 fw-bold shadow-sm" id="btn-process-generic" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-magic me-2"></i> Process <?php echo e($tool['h1']); ?>

            </button>
        </div>
    </div>
</div>

<style>
    .interactive-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        margin-bottom: 3rem;
    }
    .interactive-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px dashed #e5e7eb;
    }
    .interactive-header h4 {
        margin: 0;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.5px;
    }
    .form-label-custom {
        font-size: 0.75rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.75rem;
        display: block;
    }
    .form-control {
        border-radius: 16px;
        border: 2px solid #f3f4f6;
        padding: 20px;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #f9fafb;
    }
    .form-control:focus {
        background: #fff;
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(255, 107, 0, 0.1);
        outline: none;
    }
    .output-wrapper .btn-copy-output {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
        opacity: 0.8;
    }
    .output-wrapper .btn-copy-output:hover {
        opacity: 1;
    }
    .btn-accent {
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .btn-accent:hover {
        background: #e65100;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 0, 0.3);
    }
    @media (max-width: 991px) {
        .interactive-card { padding: 25px; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('generic-input');
        const output = document.getElementById('generic-output');
        const btnProcess = document.getElementById('btn-process-generic');
        const btnClear = document.getElementById('btn-clear-all');
        const btnCopy = document.getElementById('btn-copy-output');

        btnProcess.addEventListener('click', function() {
            if (!input.value.trim()) {
                alert('Please provide some input data first.');
                return;
            }

            // Simulator logic for the 30 bulk tools
            btnProcess.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
            btnProcess.disabled = true;

            setTimeout(() => {
                // For verification, we just show the input as proof of life
                output.value = input.value; 
                btnProcess.innerHTML = '<i class="fas fa-magic me-2"></i> Process <?php echo e($tool["h1"]); ?>';
                btnProcess.disabled = false;
                
                // Pulse effect on output
                output.style.borderColor = 'var(--accent)';
                setTimeout(() => output.style.borderColor = '#f3f4f6', 1000);
            }, 600);
        });

        btnClear.addEventListener('click', function() {
            input.value = '';
            output.value = '';
        });

        btnCopy.addEventListener('click', function() {
            if (!output.value) return;
            navigator.clipboard.writeText(output.value);
            const originalText = btnCopy.innerHTML;
            btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            setTimeout(() => btnCopy.innerHTML = originalText, 2000);
        });
    });
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\generic-text-tool.blade.php ENDPATH**/ ?>