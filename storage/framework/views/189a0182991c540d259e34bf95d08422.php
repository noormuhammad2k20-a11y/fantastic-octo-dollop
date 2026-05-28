<div class="interactive-card">
    <div class="interactive-header">
        <h4><i class="fas fa-file-archive"></i> Archive Converter (In-Browser)</h4>
        <div class="header-actions">
            <button class="btn-sm btn-outline-custom" id="btn-clear-archive" style="min-width: 280px; max-width: 100%;">Clear All</button>
        </div>
    </div>
    <div class="interactive-body">
        <div class="drop-zone-mini" id="archive-drop-zone">
            <i class="fas fa-plus fa-2x mb-2"></i>
            <p>Drag files here to add to archive</p>
            <input type="file" id="archive-file-input" multiple hidden>
        </div>

        <div id="file-list" class="mt-4 d-none">
            <h6>Files to Archive:</h6>
            <div class="list-group" id="archive-list"></div>
            
            <div class="archive-actions mt-4 text-center">
                <div class="mb-3">
                    <label class="form-label">Archive Name</label>
                    <input type="text" id="archive-name" class="form-control d-inline-block w-auto" value="tools-archive">
                    <span>.zip</span>
                </div>
                <button class="btn-accent btn-lg" id="btn-download-zip" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-download"></i> Create & Download ZIP
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<style>
    .interactive-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
    }
    .drop-zone-mini {
        border: 2px dashed var(--border-color);
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: var(--bg-light);
    }
    .drop-zone-mini:hover, .drop-zone-mini.dragover {
        border-color: var(--accent-color);
        background: rgba(255, 107, 0, 0.05);
    }
    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 10px !important;
        margin-bottom: 5px;
        border: 1px solid var(--border-color);
    }
    .btn-remove-file {
        color: #ff4d4d;
        cursor: pointer;
        border: none;
        background: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.getElementById('archive-drop-zone');
        const fileInput = document.getElementById('archive-file-input');
        const fileListContainer = document.getElementById('file-list');
        const archiveList = document.getElementById('archive-list');
        const btnDownload = document.getElementById('btn-download-zip');
        const btnClear = document.getElementById('btn-clear-archive');
        const archiveNameInput = document.getElementById('archive-name');

        let files = [];

        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        fileInput.addEventListener('change', (e) => handleFiles(e.target.files));

        function handleFiles(newFiles) {
            files = [...files, ...Array.from(newFiles)];
            updateUI();
        }

        function updateUI() {
            if (files.length > 0) {
                fileListContainer.classList.remove('d-none');
            } else {
                fileListContainer.classList.add('d-none');
            }

            archiveList.innerHTML = '';
            files.forEach((file, index) => {
                const item = document.createElement('div');
                item.className = 'list-group-item';
                item.innerHTML = `
                    <span><i class="far fa-file me-2"></i> ${file.name} <small class="text-muted">(${formatBytes(file.size)})</small></span>
                    <button class="btn-remove-file" data-index="${index}"><i class="fas fa-trash"></i></button>
                `;
                archiveList.appendChild(item);
            });

            document.querySelectorAll('.btn-remove-file').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const idx = e.currentTarget.dataset.index;
                    files.splice(idx, 1);
                    updateUI();
                });
            });
        }

        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        btnDownload.addEventListener('click', async function() {
            if (files.length === 0) return;

            const zip = new JSZip();
            files.forEach(file => {
                zip.file(file.name, file);
            });

            const content = await zip.generateAsync({type:"blob"});
            const link = document.createElement('a');
            link.href = URL.createObjectURL(content);
            link.download = (archiveNameInput.value || 'archive') + '.zip';
            link.click();
        });

        btnClear.addEventListener('click', () => {
            files = [];
            updateUI();
        });
    });
</script>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\archive-converter.blade.php ENDPATH**/ ?>