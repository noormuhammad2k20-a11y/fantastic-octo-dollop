@php $tool = (array)$tool; @endphp
{{-- ════════════ PROGRESS ════════════ --}}

<div class="progress-section" id="progress-section">
    <div class="progress-container">
        <div class="progress-header">
            <span class="status-text" id="status-text">
                <span class="spinner"></span> Uploading file...
            </span>
            <span class="percent-text" id="progress-percent">0%</span>
        </div>
        <div class="progress-bar-custom">
            <div class="progress-bar-fill" id="progress-fill"></div>
        </div>
    </div>
</div>

{{-- ════════════ RESULT ════════════ --}}
<div class="result-section" id="result-section">
    <div class="result-card">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h3>Processing Complete!</h3>
        <p id="success-message" style="color: var(--text-secondary); margin-bottom: 1.5rem;">
            Your file has been processed successfully. <span style="display: block; font-weight: 500; color: var(--accent-color); margin-top: 5px;">Click the Download button below to save your file.</span>
        </p>

        <div class="result-stats">
            <div class="stat">
                <div class="label">Original Size</div>
                <div class="value" id="original-size">—</div>
            </div>
            <div class="stat">
                <div class="label">New Size</div>
                <div class="value" id="new-size">—</div>
            </div>
            <div class="stat">
                <div class="label">Saved</div>
                <div class="value green" id="saved-percent">—</div>
            </div>
        </div>

        <div class="result-actions">
            <a href="#" class="btn-accent btn-accent-lg" id="btn-download">
                <i class="fas fa-download"></i> Download Now
            </a>
            <button class="btn-outline-custom" id="btn-another">
                <i class="fas fa-redo"></i> Process Another File
            </button>
        </div>
    </div>
</div>
