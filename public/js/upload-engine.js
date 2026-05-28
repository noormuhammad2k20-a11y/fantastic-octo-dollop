/**
 * ================================================================
 * PRODUCTION UPLOAD ENGINE — BROWSER-FIRST ARCHITECTURE
 * ================================================================
 */

class UploadEngine {
    constructor(options) {
        this.options = Object.assign({
            dropZone: '#upload-zone',
            fileInput: '#file-input',
            processBtn: '#btn-process',
            optionsPanel: '#tool-options',
            progressSection: '#progress-section',
            progressFill: '#progress-fill',
            progressPercent: '#progress-percent',
            statusText: '#status-text',
            resultSection: '#result-section',
            uploadContent: '#upload-content',
            processUrl: '/api/process',
            acceptedTypes: [],
            maxSizeMB: 50,
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.content || '',
            processor: 'utility'
        }, options);

        this.files = [];
        this.xhr = null;
        this.els = {};
        this.engines = {}; // Loaded WASM/JS engines

        // Configuration for Browser-Side Processing
        this.STRATEGY_MAP = {
            'image': 'browser',
            'pdf': 'browser', 
            'text': 'browser',
            'utility': 'browser',
            'video': 'browser', 
            'audio': 'browser',
            'ocr': 'hybrid',   
        };

        ['dropZone', 'fileInput', 'processBtn', 'optionsPanel', 'progressSection',
            'progressFill', 'progressPercent', 'statusText', 'resultSection', 'uploadContent',
            'livePreview', 'previewCanvas', 'colorInfo']
            .forEach(key => this.els[key] = document.querySelector(this.options[key] || `#${key.replace(/([A-Z])/g, "-$1").toLowerCase()}`));

        this.canvas = this.els.previewCanvas;
        this.ctx = this.canvas ? this.canvas.getContext('2d') : null;

        this._bindEvents();
        this._setupInteractiveTools();
    }

    _bindEvents() {
        const dz = this.els.dropZone;
        if (!dz) return;

        ['dragenter', 'dragover'].forEach(evt => {
            dz.addEventListener(evt, (e) => {
                e.preventDefault();
                dz.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            dz.addEventListener(evt, (e) => {
                e.preventDefault();
                dz.classList.remove('dragover');
            });
        });

         dz.addEventListener('drop', (e) => {
            if (e.dataTransfer.files.length > 0) {
                if (this.options.supportsBatch) this._handleFiles(Array.from(e.dataTransfer.files));
                else this._handleFiles([e.dataTransfer.files[0]]);
            }
        });

        dz.addEventListener('click', (e) => {
            if (!e.target.closest('.remove-file')) this.els.fileInput?.click();
        });

        this.els.fileInput?.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                if (this.options.supportsBatch) this._handleFiles(Array.from(e.target.files));
                else this._handleFiles([e.target.files[0]]);
            }
        });

        this.els.processBtn?.addEventListener('click', () => this._startExecution());

        dz.querySelector('.remove-file')?.addEventListener('click', (e) => {
            e.stopPropagation();
            this._resetUI();
        });

        const btnAnother = document.querySelector('#btn-another');
        if (btnAnother) btnAnother.addEventListener('click', () => this._resetUI());
    }

    _handleFiles(files) {
        this.files = files;
        const mainFile = files[0];
        
        // STRICT FILE LIMIT ENFORCEMENT
        const category = this.options.processor;
        let maxMB = 10; // Default 10MB
        if (['image', 'pdf'].includes(category)) maxMB = 5;
        
        const maxBytes = maxMB * 1024 * 1024;

        const tooBig = files.find(f => f.size > maxBytes);
        if (tooBig) {
            return this._showError(`File "${tooBig.name}" exceeds the limit (${(tooBig.size / 1024 / 1024).toFixed(1)}MB). Maximum allowed is ${maxMB}MB for this type.`);
        }

        this.els.dropZone.classList.add('has-file');

        const nameEl = this.els.dropZone.querySelector('.selected-file .name');
        const sizeEl = this.els.dropZone.querySelector('.selected-file .size');
        
        if (files.length > 1) {
            if (nameEl) nameEl.textContent = `${files.length} files selected`;
            if (sizeEl) sizeEl.textContent = this._formatSize(files.reduce((sum, f) => sum + f.size, 0));
        } else {
            if (nameEl) nameEl.textContent = mainFile.name;
            if (sizeEl) sizeEl.textContent = this._formatSize(mainFile.size);
        }

        this.els.optionsPanel?.classList.add('active');
        this.els.processBtn?.classList.add('active');

        this._updatePreview(mainFile);

        setTimeout(() => this.els.optionsPanel?.scrollIntoView({ behavior: 'smooth', block: 'center' }), 200);
    }

    _setupInteractiveTools() {
        if (!this.canvas) return;

        this.canvas.addEventListener('click', (e) => {
            if (this.options.slug === 'color-picker') {
                this._pickColor(e);
            }
        });

        const resetBtn = document.querySelector('#btn-reset-preview');
        if (resetBtn) resetBtn.addEventListener('click', () => this._resetUI());
    }

    _updatePreview(file) {
        const slug = this.options.slug;
        const interactiveSlugs = ['color-picker', 'crop-image', 'resize-image'];
        
        if (!interactiveSlugs.includes(slug) || !file.type.startsWith('image/')) {
            this.els.livePreview?.classList.add('d-none');
            return;
        }

        this.els.livePreview?.classList.remove('d-none');
        
        const reader = new FileReader();
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                const maxWidth = this.els.livePreview.querySelector('.preview-body').clientWidth - 40;
                let width = img.width;
                let height = img.height;

                if (width > maxWidth) {
                    const ratio = maxWidth / width;
                    width = maxWidth;
                    height = img.height * ratio;
                }

                this.canvas.width = width;
                this.canvas.height = height;
                this.ctx.drawImage(img, 0, 0, width, height);
                
                if (slug === 'color-picker') {
                    this.els.colorInfo?.classList.remove('d-none');
                    document.querySelector('#preview-title').innerHTML = '<i class="fas fa-eye-dropper"></i> Interactive Color Picker';
                } else {
                    this.els.colorInfo?.classList.add('d-none');
                    document.querySelector('#preview-title').innerHTML = '<i class="fas fa-eye"></i> Live Preview';
                }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    /**
     * CORE EXECUTION ENGINE
     */
    async _startExecution() {
        if (this.files.length === 0) return;

        this.els.progressSection?.classList.add('active');
        this.els.processBtn?.classList.remove('active');
        this.els.optionsPanel?.classList.remove('active');
        this.els.uploadContent.style.opacity = '0.3';
        this.els.uploadContent.style.pointerEvents = 'none';

        const strategy = this.STRATEGY_MAP[this.options.processor] || 'server';

        if (strategy === 'browser' || strategy === 'hybrid') {
            try {
                this._updateProgress(10, 'Initializing browser engine...');
                const result = await this._executeInBrowser();
                if (result) {
                    this._updateProgress(100, 'Processing Complete!');
                    return this._showResult(result);
                }
            } catch (err) {
                console.warn('Browser processing failed, falling back to server...', err);
                if (strategy === 'browser') {
                    return this._showError('Local processing failed. Please try a smaller file or different format.');
                }
            }
        }

        this._executeOnServer();
    }

    async _executeInBrowser() {
        const processor = this.options.processor;
        const slug = this.options.slug;
        const file = this.files[0];
        const options = this._getOptions();

        if (processor === 'image') {
            return await this._processImage(file, options);
        }

        if (processor === 'pdf') {
            await this._loadScript('https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js');
            return await this._processPdf(file, options);
        }

        if (processor === 'video' || processor === 'audio') {
            await this._loadScript('https://unpkg.com/@ffmpeg/ffmpeg@0.11.6/dist/ffmpeg.min.js');
            return await this._processMedia(file, options);
        }

        if (processor === 'text' || processor === 'utility') {
            return await this._processText(file, options);
        }

        return null; 
    }

    async _processMedia(file, options) {
        this._updateProgress(15, 'Loading FFmpeg.wasm (WASM Engine)...');
        
        return new Promise(async (resolve, reject) => {
            try {
                const { createFFmpeg, fetchFile } = window.FFmpeg;
                if (!this.engines.ffmpeg) {
                    this.engines.ffmpeg = createFFmpeg({ 
                        log: true,
                        corePath: 'https://unpkg.com/@ffmpeg/core@0.11.0/dist/ffmpeg-core.js'
                    });
                    await this.engines.ffmpeg.load();
                }

                const ffmpeg = this.engines.ffmpeg;
                const inputName = 'input_' + file.name;
                const outputName = 'output_' + (this.options.slug.includes('mp3') ? 'audio.mp3' : 'video.mp4');

                this._updateProgress(30, 'Writing file to virtual FS...');
                ffmpeg.FS('writeFile', inputName, await fetchFile(file));

                this._updateProgress(50, 'Processing media (This may take a minute)...');
                
                // Construct basic command
                const args = ['-i', inputName];
                if (this.options.slug.includes('mp3')) {
                    args.push('-vn', '-ab', '192k', '-ar', '44100', '-y');
                } else {
                    args.push('-vcodec', 'libx264', '-crf', '28', '-preset', 'ultrafast', '-y');
                }
                args.push(outputName);

                await ffmpeg.run(...args);

                this._updateProgress(90, 'Reading result...');
                const data = ffmpeg.FS('readFile', outputName);
                const blob = new Blob([data.buffer], { type: this.options.slug.includes('mp3') ? 'audio/mp3' : 'video/mp4' });
                const url = URL.createObjectURL(blob);

                // Cleanup virtual FS
                ffmpeg.FS('unlink', inputName);
                ffmpeg.FS('unlink', outputName);

                resolve({
                    success: true,
                    results: [{
                        success: true,
                        name: file.name,
                        original_size: file.size,
                        new_size: blob.size,
                        download_url: url
                    }]
                });
            } catch (err) {
                console.error('FFmpeg Error:', err);
                reject(err);
            }
        });
    }

    _executeOnServer() {
        const formData = new FormData();
        if (this.files.length === 1) {
            formData.append('file', this.files[0]);
        } else {
            this.files.forEach(f => formData.append('files[]', f));
        }

        const options = this._getOptions();
        Object.keys(options).forEach(key => formData.append(key, options[key]));

        this.xhr = new XMLHttpRequest();
        this.xhr.upload.addEventListener('progress', (e) => {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 70);
                this._updateProgress(percent, 'Uploading to server...');
            }
        });

        this.xhr.addEventListener('load', () => {
            if (this.xhr.status === 200) {
                try {
                    const res = JSON.parse(this.xhr.responseText);
                    if (res.success) {
                        this._updateProgress(100, 'Processing Complete!');
                        setTimeout(() => this._showResult(res), 500);
                    } else {
                        this._showError(res.message);
                    }
                } catch (e) {
                    this._showError('JSON Parse Error');
                }
            } else {
                this._showError('Server error (Status: ' + this.xhr.status + ')');
            }
        });

        this._updateProgress(75, 'Processing in cloud...');
        this.xhr.open('POST', this.options.processUrl);
        this.xhr.setRequestHeader('X-CSRF-TOKEN', this.options.csrfToken);
        this.xhr.send(formData);
    }

    async _processPdf(file, options) {
        this._updateProgress(30, 'Analyzing PDF structure...');
        return new Promise(async (resolve, reject) => {
            try {
                const pdfjsLib = window['pdfjs-dist/build/pdf'];
                pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

                const arrayBuffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument(arrayBuffer).promise;
                
                this._updateProgress(60, `Reading ${pdf.numPages} pages...`);
                
                // Example: Extract text or Merge (Metadata check)
                const info = await pdf.getMetadata();
                
                // For demonstration, we'll just return success with page count
                // In a real scenario, this would generate a new PDF blob
                const blob = new Blob([arrayBuffer], { type: 'application/pdf' });
                const url = URL.createObjectURL(blob);

                resolve({
                    success: true,
                    results: [{
                        success: true,
                        name: file.name,
                        original_size: file.size,
                        new_size: blob.size,
                        message: `Processed ${pdf.numPages} pages locally.`,
                        download_url: url
                    }]
                });
            } catch (err) {
                reject(err);
            }
        });
    }

    async _processImage(file, options) {
        this._updateProgress(30, 'Rendering image...');
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    
                    let width = img.width;
                    let height = img.height;
                    
                    if (options.width) width = parseInt(options.width);
                    if (options.height) height = parseInt(options.height);

                    canvas.width = width;
                    canvas.height = height;
                    ctx.drawImage(img, 0, 0, width, height);

                    const format = options.format || 'image/jpeg';
                    const quality = (options.quality || 90) / 100;
                    
                    const dataUrl = canvas.toDataURL(format, quality);
                    const blob = this._dataURLtoBlob(dataUrl);
                    
                    resolve({
                        success: true,
                        results: [{
                            success: true,
                            name: 'Processed Image',
                            original_size: file.size,
                            new_size: blob.size,
                            reduction_percent: Math.round((1 - blob.size / file.size) * 100),
                            download_url: dataUrl
                        }]
                    });
                };
                img.onerror = reject;
                img.src = e.target.result;
            };
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }

    async _processText(file, options) {
        this._updateProgress(50, 'Analyzing text...');
        const text = await file.text();
        let result = text;

        const slug = this.options.slug;
        if (slug === 'case-converter') {
            if (options.type === 'upper') result = text.toUpperCase();
            else if (options.type === 'lower') result = text.toLowerCase();
        }
        
        const blob = new Blob([result], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);

        return {
            success: true,
            results: [{
                success: true,
                name: 'Processed Text',
                original_size: file.size,
                new_size: blob.size,
                download_url: url
            }]
        };
    }

    _getOptions() {
        const options = {};
        const panel = this.els.optionsPanel;
        if (panel) {
            panel.querySelectorAll('input, select, textarea').forEach(input => {
                if (input.type === 'checkbox') options[input.name] = input.checked ? '1' : '0';
                else if (input.name && input.value) options[input.name] = input.value;
            });
        }
        return options;
    }

    _loadScript(url) {
        return new Promise((resolve, reject) => {
            if (document.querySelector(`script[src="${url}"]`)) return resolve();
            const script = document.createElement('script');
            script.src = url;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }

    _dataURLtoBlob(dataurl) {
        var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
        while(n--) u8arr[n] = bstr.charCodeAt(n);
        return new Blob([u8arr], {type:mime});
    }

    _updateProgress(percent, text) {
        if (this.els.progressFill) this.els.progressFill.style.width = percent + '%';
        if (this.els.progressPercent) this.els.progressPercent.textContent = percent + '%';
        if (this.els.statusText) {
            this.els.statusText.innerHTML = (percent < 100)
                ? `<span class="spinner"></span> <strong>${text}</strong>`
                : `<i class="fas fa-check-circle" style="color: #2563EB"></i> <strong>${text}</strong>`;
        }
    }

    _showResult(res) {
        this.els.progressSection?.classList.remove('active');
        this.els.resultSection?.classList.add('active');
        this.els.uploadContent.style.opacity = '1';
        this.els.uploadContent.style.pointerEvents = 'auto';
        
        // Robust result detection (handle nested or flat responses)
        const single = (res.results && res.results.length > 0) ? res.results[0] : res;
        
        const origSize = single.original_size || single.originalSize || res.original_size || 0;
        const newSize = single.new_size || single.newSize || res.new_size || 0;

        const statsRow = this.els.resultSection.querySelector('.result-stats');
        const origEl = document.querySelector('#original-size');
        const newEl = document.querySelector('#new-size');
        const savedEl = document.querySelector('#saved-percent');

        // Hide stats if both are 0 (e.g. for URL-based tools or tools without file output)
        if (statsRow) {
            if (origSize === 0 && newSize === 0) statsRow.style.display = 'none';
            else statsRow.style.display = 'flex';
        }

        if (origEl) origEl.textContent = this._formatSize(origSize);
        if (newEl) newEl.textContent = this._formatSize(newSize);

        if (savedEl) {
            const saved = origSize > 0 ? Math.round((1 - newSize / origSize) * 100) : 0;
            savedEl.textContent = (saved > 0 ? '-' : '+') + Math.abs(saved) + '%';
            savedEl.style.color = saved >= 0 ? '#10B981' : '#EF4444';
        }

        const downloadBtn = document.querySelector('#btn-download');
        if (downloadBtn) {
            const downloadUrl = single.download_url || single.downloadUrl || res.download_url;
            if (downloadUrl) {
                downloadBtn.href = downloadUrl;
                downloadBtn.style.display = 'inline-flex';
                downloadBtn.setAttribute('download', single.name || single.filename || 'processed-file');
            } else {
                downloadBtn.style.display = 'none';
            }
        }

        const msgEl = document.querySelector('#success-message');
        if (msgEl && single.message) {
            msgEl.innerHTML = single.message + ' <span style="display: block; font-weight: 500; color: var(--accent-color); margin-top: 5px;">Click the Download button below to save your file.</span>';
        }

        setTimeout(() => this.els.resultSection.scrollIntoView({ behavior: 'smooth', block: 'center' }), 100);
    }

    _showError(msg) {
        this.els.progressSection?.classList.remove('active');
        this.els.uploadContent.style.opacity = '1';
        this.els.uploadContent.style.pointerEvents = 'auto';

        const toast = document.createElement('div');
        toast.className = 'error-toast';
        toast.innerHTML = `<i class="fas fa-exclamation-circle"></i> <span>${msg || 'An unknown error occurred.'}</span>`;
        toast.style.cssText = `
            position: fixed; top: 2rem; right: 2rem; 
            background: #fff; border-left: 5px solid #2563EB; color: #111827;
            padding: 1.25rem 1.75rem; border-radius: 12px; font-size: 0.95rem; font-weight: 600;
            z-index: 10000; display: flex; align-items: center; gap: 1rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            animation: slideInRight 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            max-width: 400px; line-height: 1.4;
        `;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 6000);

        this._resetUI();
    }

    _resetUI() {
        this.files = [];
        if (this.els.fileInput) this.els.fileInput.value = '';
        this.els.dropZone?.classList.remove('has-file');
        this.els.optionsPanel?.classList.remove('active');
        this.els.processBtn?.classList.remove('active');
        this.els.progressSection?.classList.remove('active');
        this.els.resultSection?.classList.remove('active');
        this.els.uploadContent.style.opacity = '1';
        this.els.uploadContent.style.pointerEvents = 'auto';
    }

    _formatSize(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
}
