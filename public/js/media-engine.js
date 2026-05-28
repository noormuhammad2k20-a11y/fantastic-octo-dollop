/**
 * ================================================================
 * PREMIUM MEDIA PROCESSING ENGINE — SPA MODE
 * ================================================================
 */

class MediaEngine {
    constructor(config) {
        this.config = Object.assign({
            slug: '',
            processUrl: '',
            acceptedTypes: [],
            maxSizeMB: 50,
            mediaType: 'video', // video, audio, image
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.content || ''
        }, config);

        this.files = [];
        this.xhr = null;
        this.elements = {
            dropZone: document.getElementById('media-drop-zone'),
            fileInput: document.getElementById('media-file-input'),
            processBtn: document.getElementById('btn-process-media'),
            inputCard: document.getElementById('media-input-card'),
            outputCard: document.getElementById('media-output-card'),
            statusText: document.getElementById('output-status-text'),
            progressFill: document.getElementById('media-progress-fill'),
            progressPercent: document.getElementById('media-progress-percent'),
            resultShowcase: document.getElementById('result-showcase'),
            previewArea: document.getElementById('media-preview-area'),
            selectedFileInfo: document.getElementById('selected-file-info'),
            downloadBtn: document.getElementById('btn-download-media')
        };

        this._init();
    }

    _init() {
        if (!this.elements.dropZone) return;

        // Bind Drag & Drop
        ['dragenter', 'dragover'].forEach(evt => {
            this.elements.dropZone.addEventListener(evt, (e) => {
                e.preventDefault();
                this.elements.dropZone.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            this.elements.dropZone.addEventListener(evt, (e) => {
                e.preventDefault();
                this.elements.dropZone.classList.remove('dragover');
            });
        });

        this.elements.dropZone.addEventListener('drop', (e) => {
            if (e.dataTransfer.files.length > 0) {
                this._handleFile(e.dataTransfer.files[0]);
            }
        });

        this.elements.dropZone.addEventListener('click', (e) => {
            if (!e.target.closest('.remove-file')) this.elements.fileInput.click();
        });

        this.elements.fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                this._handleFile(e.target.files[0]);
            }
        });

        // Bind Remove File
        this.elements.selectedFileInfo.querySelector('.remove-file')?.addEventListener('click', (e) => {
            e.stopPropagation();
            this._resetUI();
        });

        // Bind Reset Tool
        document.querySelectorAll('.reset-tool').forEach(btn => {
            btn.addEventListener('click', () => this._resetUI());
        });

        // Bind Process Button
        this.elements.processBtn.addEventListener('click', () => this._startProcessing());

        // Bind Presets
        document.querySelectorAll('.btn-quick').forEach(btn => {
            btn.addEventListener('click', () => this._applyPreset(btn.dataset.preset));
        });
    }

    _handleFile(file) {
        const maxBytes = this.config.maxSizeMB * 1024 * 1024;
        if (file.size > maxBytes) {
            alert(`File is too large. Max allowed: ${this.config.maxSizeMB}MB`);
            return;
        }

        this.files = [file];
        this.elements.dropZone.classList.add('has-file');
        this.elements.selectedFileInfo.classList.remove('d-none');
        this.elements.dropZone.querySelector('.dz-icon').classList.add('d-none');
        this.elements.dropZone.querySelector('h5').classList.add('d-none');
        this.elements.dropZone.querySelector('p').classList.add('d-none');

        const nameEl = this.elements.selectedFileInfo.querySelector('.file-name');
        const sizeEl = this.elements.selectedFileInfo.querySelector('.file-size');
        
        if (nameEl) nameEl.textContent = file.name;
        if (sizeEl) sizeEl.textContent = this._formatSize(file.size);

        // UI Feedback
        this.elements.processBtn.classList.add('pulse-blue');
    }

    _applyPreset(preset) {
        // Logic for common presets
        const qSelect = document.getElementById('opt-quality');
        const bSelect = document.getElementById('opt-bitrate');
        const cSelect = document.getElementById('opt-compression');
        const rSelect = document.getElementById('opt-resolution');

        if (preset === 'high-quality') {
            if (qSelect) qSelect.value = 'high';
            if (bSelect) bSelect.value = '320';
            if (cSelect) cSelect.value = 'light';
            if (rSelect) rSelect.value = 'original';
        } else if (preset === 'web-optimized') {
            if (qSelect) qSelect.value = 'medium';
            if (bSelect) bSelect.value = '192';
            if (cSelect) cSelect.value = 'medium';
            if (rSelect) rSelect.value = '720';
        } else if (preset === 'small-size') {
            if (qSelect) qSelect.value = 'low';
            if (bSelect) bSelect.value = '128';
            if (cSelect) cSelect.value = 'heavy';
            if (rSelect) rSelect.value = '480';
        }
    }

    _startProcessing() {
        if (this.files.length === 0) return;

        // Transition to Output Card
        this.elements.outputCard.style.display = 'block';
        this.elements.outputCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        this.elements.processBtn.disabled = true;
        this.elements.inputCard.style.opacity = '0.5';
        this.elements.inputCard.style.pointerEvents = 'none';

        this._updateStage(1, 'active');
        this._updateStatus('Uploading File...', 0);

        const formData = new FormData();
        formData.append('file', this.files[0]);

        // Gather options
        document.querySelectorAll('.pro-options-grid select, .pro-options-grid input').forEach(el => {
            const name = el.id.replace('opt-', '');
            formData.append(name, el.value);
        });

        this.xhr = new XMLHttpRequest();

        // Track Upload
        this.xhr.upload.addEventListener('progress', (e) => {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 40); // Upload is first 40%
                this._updateStatus('Uploading to secure server...', percent);
                this.elements.progressFill.style.width = percent + '%';
            }
        });

        this.xhr.addEventListener('load', () => {
            if (this.xhr.status === 200) {
                try {
                    const res = JSON.parse(this.xhr.responseText);
                    if (res.success) {
                        this._finalizeProcessing(res);
                    } else {
                        this._handleError(res.message);
                    }
                } catch (e) {
                    this._handleError('Unexpected server response.');
                }
            } else {
                this._handleError('Processing error. Please try again.');
            }
        });

        this.xhr.addEventListener('error', () => this._handleError('Connection failed.'));

        // Artificial Progress during processing (40% to 95%)
        let procPercent = 40;
        const procInterval = setInterval(() => {
            if (procPercent < 95) {
                procPercent += Math.random() * 5;
                if (procPercent > 95) procPercent = 95;
                
                if (procPercent > 45) this._updateStage(2, 'active');
                
                this._updateStatus('Processing & Optimizing...', Math.round(procPercent));
                this.elements.progressFill.style.width = procPercent + '%';
            } else {
                clearInterval(procInterval);
            }
        }, 800);

        this.xhr.open('POST', this.config.processUrl);
        this.xhr.setRequestHeader('X-CSRF-TOKEN', this.config.csrfToken);
        this.xhr.send(formData);

        this.xhr.procInterval = procInterval;
    }

    _finalizeProcessing(res) {
        clearInterval(this.xhr.procInterval);
        this._updateStage(3, 'completed');
        this._updateStatus('Processing Complete!', 100);
        this.elements.progressFill.style.width = '100%';

        const result = res.results ? res.results[0] : res;

        // Populate Results
        document.getElementById('res-new-size').textContent = this._formatSize(result.new_size);
        document.getElementById('res-reduction').textContent = result.reduction_percent + '% Smaller';
        
        if (this.elements.downloadBtn && result.download_url) {
            this.elements.downloadBtn.href = result.download_url;
        }

        // Inject Preview
        this._renderPreview(result);

        // Show Showcase
        setTimeout(() => {
            this.elements.resultShowcase.classList.remove('d-none');
            this.elements.resultShowcase.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 600);
    }

    _renderPreview(result) {
        const area = this.elements.previewArea;
        area.innerHTML = ''; // Clear

        if (this.config.mediaType === 'video') {
            const video = document.createElement('video');
            video.className = 'premium-player';
            video.controls = true;
            video.src = result.download_url;
            area.appendChild(video);
        } else if (this.config.mediaType === 'audio') {
            const audio = document.createElement('audio');
            audio.className = 'premium-player';
            audio.controls = true;
            audio.src = result.download_url;
            area.appendChild(audio);
        } else if (this.config.mediaType === 'image') {
            const img = document.createElement('img');
            img.className = 'img-fluid rounded-3';
            img.style.maxHeight = '400px';
            img.src = result.download_url;
            area.appendChild(img);
        }
    }

    _updateStage(stage, state) {
        const dot = document.getElementById(`stage-${stage}`);
        if (dot) {
            if (state === 'active') dot.classList.add('active');
            if (state === 'completed') {
                dot.classList.remove('active');
                dot.classList.add('completed');
                dot.innerHTML = '<i class="fas fa-check"></i>';
            }
        }
        
        // Mark previous stages as completed
        for(let i=1; i<stage; i++) {
            const prev = document.getElementById(`stage-${i}`);
            if (prev && !prev.classList.contains('completed')) {
                prev.classList.remove('active');
                prev.classList.add('completed');
                prev.innerHTML = '<i class="fas fa-check"></i>';
            }
        }
    }

    _updateStatus(text, percent) {
        this.elements.statusText.textContent = text;
        this.elements.progressPercent.textContent = percent + '%';
    }

    _handleError(msg) {
        clearInterval(this.xhr?.procInterval);
        alert(msg || 'An error occurred during processing.');
        this._resetUI();
    }

    _resetUI() {
        this.files = [];
        this.elements.fileInput.value = '';
        this.elements.dropZone.classList.remove('has-file');
        this.elements.selectedFileInfo.classList.add('d-none');
        this.elements.dropZone.querySelector('.dz-icon').classList.remove('d-none');
        this.elements.dropZone.querySelector('h5').classList.remove('d-none');
        this.elements.dropZone.querySelector('p').classList.remove('d-none');
        this.elements.processBtn.disabled = false;
        this.elements.processBtn.classList.remove('pulse-blue');
        this.elements.inputCard.style.opacity = '1';
        this.elements.inputCard.style.pointerEvents = 'auto';
        this.elements.outputCard.style.display = 'none';
        this.elements.resultShowcase.classList.add('d-none');
        
        // Reset stages
        [1,2,3].forEach(i => {
           const dot = document.getElementById(`stage-${i}`);
           dot.classList.remove('active', 'completed');
           dot.textContent = i;
        });
        this.elements.progressFill.style.width = '0%';
        this.elements.progressPercent.textContent = '0%';
    }

    _formatSize(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
}
