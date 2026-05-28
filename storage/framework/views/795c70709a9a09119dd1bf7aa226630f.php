<div class="tool-interactive">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-3"><i class="fas fa-font me-2 text-primary"></i> Pro Font Converter</h5>
            <p class="text-muted small mb-4">Generate premium font styles for your social media bios, nicknames, and creative designs.</p>

            <div class="mb-4">
                <label for="fontText" class="form-label fw-semibold">Your Text</label>
                <input type="text" id="fontText" class="form-control form-control-lg border-primary shadow-sm" placeholder="Type or paste something cool..." value="ToolsHub is Awesome!">
            </div>

            <div id="previewGrid" class="row g-3">
                <!-- Font previews will be injected here -->
            </div>
            
            <div class="mt-4 p-3 bg-light rounded text-center small text-muted">
                <i class="fas fa-lightbulb me-2 text-warning"></i> Tip: Click on any result to copy it instantly to your clipboard.
            </div>
        </div>
    </div>
</div>

<div id="copyToast" class="position-fixed bottom-0 start-50 translate-middle-x mb-4 bg-dark text-white p-3 rounded shadow-lg d-none" style="z-index: 9999;">
    <i class="fas fa-check-circle text-success me-2"></i> Font Copied to Clipboard!
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fontText = document.getElementById('fontText');
    const previewGrid = document.getElementById('previewGrid');
    const copyToast = document.getElementById('copyToast');

    const styles = [
        { name: 'Bold Sans', transform: text => text.replace(/[A-Z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 120211)).replace(/[a-z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 120205)) },
        { name: 'Italic Serif', transform: text => text.replace(/[A-Z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 120263)).replace(/[a-z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 120257)) },
        { name: 'Cursive', transform: text => text.replace(/[A-Z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 119931)).replace(/[a-z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 119925)) },
        { name: 'Bubble', transform: text => text.replace(/[A-Z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 124619)).replace(/[a-z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 124613)).replace(/[0-9]/g, c => String.fromCodePoint(c.charCodeAt(0) + 124613)) },
        { name: 'Double Struck', transform: text => text.replace(/[A-Z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 120081)).replace(/[a-z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 120075)) },
        { name: 'Fraktur', transform: text => text.replace(/[A-Z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 120029)).replace(/[a-z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 120023)) },
        { name: 'Monospace', transform: text => text.replace(/[A-Z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 120367)).replace(/[a-z]/g, c => String.fromCodePoint(c.charCodeAt(0) + 120361)) },
        { name: 'Wavy', transform: text => text.split('').join('~') }
    ];

    function updateGrid() {
        const text = fontText.value.trim() || "Type something...";
        previewGrid.innerHTML = '';
        
        styles.forEach(style => {
            const col = document.createElement('div');
            col.className = 'col-md-6 col-lg-4';
            
            const transformed = style.transform(text);
            
            col.innerHTML = `
                <div class="card h-100 font-preview-card border border-light-subtle shadow-xs cursor-pointer" style="cursor: pointer;">
                    <div class="card-body">
                        <small class="text-muted d-block mb-2">${style.name}</small>
                        <div class="fs-5 fw-normal text-dark text-truncate">${transformed}</div>
                    </div>
                </div>
            `;
            
            col.addEventListener('click', () => copyText(transformed));
            previewGrid.appendChild(col);
        });
    }

    function copyText(text) {
        navigator.clipboard.writeText(text).then(() => {
            copyToast.classList.remove('d-none');
            setTimeout(() => copyToast.classList.add('d-none'), 2000);
        });
    }

    fontText.addEventListener('input', updateGrid);
    updateGrid();
});
</script>

<style>
    .font-preview-card {
        transition: all 0.2s ease-in-out;
    }
    .font-preview-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border-color: #0d6efd !important;
    }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\font-converter-premium.blade.php ENDPATH**/ ?>