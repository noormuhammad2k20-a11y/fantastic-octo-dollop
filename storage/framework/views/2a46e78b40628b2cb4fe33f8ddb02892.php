<div class="interactive-wrapper">
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Raw YAML Source</label>
                <textarea id="input-text" class="form-control rounded-3" rows="10" placeholder="key: value&#10;list:&#10;  - item1&#10;  - item2" style="font-family:'Fira Code',monospace;font-size:0.9rem;"></textarea>
            </div>
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Indentation Size</label>
                    <select id="indent-size" class="form-select rounded-3">
                        <option value="2" selected>2 Spaces (Standard)</option>
                        <option value="4">4 Spaces</option>
                        <option value="8">8 Spaces</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Normalize Keys</label>
                    <select id="normalize-keys" class="form-select rounded-3">
                        <option value="yes" selected>Yes — Trim & Fix Spacing</option>
                        <option value="no">No — Keep Original</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-dark btn-lg w-100 rounded-3 fw-bold" id="btn-format">
                        <i class="fas fa-magic me-2"></i> Format YAML
                    </button>
                </div>
            </div>
            <div class="mt-3 p-3 rounded-3" style="background:#f8fafc;border:1.5px solid #e2e8f0">
                <p class="mb-0 small text-secondary"><i class="fas fa-info-circle me-2" style="color:#4f46e5"></i>
                    <strong>Tip:</strong> Paste raw YAML, select indent size, and click Format. The tool re-indents all nested levels using your chosen spacing.
                </p>
            </div>
        </div>
    </div>

    <div class="card tool-card-stacked shadow-sm border-0" id="result-card">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="background:rgba(16,185,129,.1);color:#10b981"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Formatted Output</h5>
                        <p class="text-muted small mb-0">Cleaned and re-indented YAML result</p>
                    </div>
                </div>
                <div class="header-actions d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" id="btn-copy"><i class="fas fa-copy me-1"></i> Copy</button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <textarea id="output-text" class="form-control rounded-3 bg-white" rows="12" readonly placeholder="Formatted YAML will appear here..." style="font-family:'Fira Code',monospace;font-size:0.9rem;"></textarea>
            <div class="row g-3 mt-3">
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Lines</span><span class="stat-card-value" id="stat-lines">0</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Size</span><span class="stat-card-value" id="stat-size">0 KB</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Indent</span><span class="stat-card-value" id="stat-indent">2</span></div></div>
                <div class="col-md-3"><div class="stat-card"><span class="stat-card-label">Status</span><span class="stat-card-value" id="stat-status">Ready</span></div></div>
            </div>
        </div>
    </div>
</div>

<style>
.tool-card-stacked{border-radius:16px;background:#fff}
.icon-box{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem}
.btn-light-v2{background:#f1f5f9;border:none;color:#475569;font-weight:600}
.btn-light-v2:hover{background:#e2e8f0;color:#1e293b}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('input-text');
    const output = document.getElementById('output-text');
    const btnFormat = document.getElementById('btn-format');
    const btnClear = document.getElementById('btn-clear');
    const btnSample = document.getElementById('btn-sample');
    const btnCopy = document.getElementById('btn-copy');
    const indentSelect = document.getElementById('indent-size');
    const normalizeSelect = document.getElementById('normalize-keys');

    function formatYAML(yaml, indentSize, normalize) {
        const lines = yaml.split(/\r?\n/);
        const result = [];
        const spaces = ' '.repeat(indentSize);

        for (let i = 0; i < lines.length; i++) {
            let line = lines[i];
            if (line.trim().length === 0) {
                result.push('');
                continue;
            }

            // Detect current indentation level
            const originalIndent = line.match(/^(\s*)/)[1];
            let level = 0;
            // Calculate level from original indent (handle mixed tabs/spaces)
            const origSpaces = originalIndent.replace(/\t/g, '  ').length;
            if (origSpaces > 0) {
                // Detect original indent unit (find smallest non-zero indent)
                level = Math.round(origSpaces / 2); // Assume original is 2-space based
            }

            let content = line.trim();

            if (normalize) {
                // Fix key: value spacing (only for key-value pairs, not URLs or strings)
                if (content.match(/^[^#"'][^"']*:\s/) || content.match(/^[^#"'][^"']*:$/)) {
                    content = content.replace(/^([^:]+?):\s*/, '$1: ');
                }
                // Normalize list item spacing
                if (content.startsWith('-')) {
                    content = content.replace(/^-\s*/, '- ');
                }
            }

            result.push(spaces.repeat(level) + content);
        }

        return result.join('\n');
    }

    function detectIndentUnit(yaml) {
        const lines = yaml.split(/\r?\n/);
        let minIndent = Infinity;
        for (const line of lines) {
            if (line.trim().length === 0) continue;
            const indent = line.match(/^(\s*)/)[1].replace(/\t/g, '  ').length;
            if (indent > 0 && indent < minIndent) minIndent = indent;
        }
        return minIndent === Infinity ? 2 : minIndent;
    }

    function formatYAMLAdvanced(yaml, targetIndent, normalize) {
        const lines = yaml.split(/\r?\n/);
        const result = [];
        const sourceIndent = detectIndentUnit(yaml);

        for (let i = 0; i < lines.length; i++) {
            let line = lines[i];
            if (line.trim().length === 0) {
                result.push('');
                continue;
            }

            const originalSpaces = line.match(/^(\s*)/)[1].replace(/\t/g, '  ').length;
            const level = sourceIndent > 0 ? Math.round(originalSpaces / sourceIndent) : 0;

            let content = line.trim();

            if (normalize) {
                if (content.match(/^[^#"'][^"']*:\s/) || content.match(/^[^#"'][^"']*:$/)) {
                    content = content.replace(/^([^:]+?):\s*/, '$1: ');
                }
                if (content.startsWith('-')) {
                    content = content.replace(/^-\s*/, '- ');
                }
            }

            result.push(' '.repeat(targetIndent * level) + content);
        }

        return result.join('\n');
    }

    btnFormat.addEventListener('click', function() {
        const yaml = input.value;
        if (!yaml.trim()) return;

        const indentSize = parseInt(indentSelect.value);
        const normalize = normalizeSelect.value === 'yes';
        const formatted = formatYAMLAdvanced(yaml, indentSize, normalize);

        output.value = formatted;
        const lineCount = formatted.split('\n').length;
        const size = (new Blob([formatted]).size / 1024).toFixed(2);

        document.getElementById('stat-lines').textContent = lineCount;
        document.getElementById('stat-size').textContent = size + ' KB';
        document.getElementById('stat-indent').textContent = indentSize;
        document.getElementById('stat-status').textContent = 'Formatted';
    });

    btnClear.addEventListener('click', function() {
        input.value = '';
        output.value = '';
        document.getElementById('stat-lines').textContent = '0';
        document.getElementById('stat-size').textContent = '0 KB';
        document.getElementById('stat-indent').textContent = indentSelect.value;
        document.getElementById('stat-status').textContent = 'Ready';
    });

    btnSample.addEventListener('click', function() {
        input.value = "server:\n  port: 8080\n  host: localhost\n  ssl:\n    enabled: true\n    cert: /etc/ssl/cert.pem\ndatabase:\n  name: tools_hub_db\n  replicas:\n    - host: replica1.db.local\n      port: 5432\n    - host: replica2.db.local\n      port: 5432\n  users:\n    - admin\n    - developer\n    - analyst\napi:\n  version: v1\n  enabled: true\n  rate_limit: 1000";
        btnFormat.click();
    });

    btnCopy.addEventListener('click', function() {
        if (!output.value) return;
        navigator.clipboard.writeText(output.value).then(function() {
            var original = btnCopy.innerHTML;
            btnCopy.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            setTimeout(function() { btnCopy.innerHTML = original; }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\yaml-formatter.blade.php ENDPATH**/ ?>