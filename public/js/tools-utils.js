/**
 * ToolsHub Interactive Tools Shared Utilities
 * Optimized for Batch 2+ Modernization
 */

const ToolsUtils = {
    /**
     * Copy text to clipboard with button feedback
     * @param {string} text - The text to copy
     * @param {HTMLElement} btn - The button element that triggered the copy
     * @param {string} successText - The text to show on success (default: "Copied!")
     */
    copyToClipboard: function(text, btn, successText = 'Copied!') {
        if (!text) return;
        
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = btn.innerHTML;
            const successHTML = `<i class="fas fa-check me-1"></i> ${successText}`;
            
            btn.innerHTML = successHTML;
            btn.classList.add('btn-success-feedback'); // Optional visual cue
            
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('btn-success-feedback');
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy: ', err);
            alert('Failed to copy to clipboard.');
        });
    },

    /**
     * Format seconds into "Xm Ys" format
     * @param {number} seconds 
     * @returns {string}
     */
    formatTime: function(seconds) {
        if (isNaN(seconds) || seconds < 0) return '0m 0s';
        const m = Math.floor(seconds / 60);
        const s = Math.round(seconds % 60);
        return `${m}m ${s}s`;
    },

    /**
     * Common input clear functionality
     * @param {HTMLTextAreaElement|HTMLInputElement} input 
     * @param {Function} callback 
     */
    clearInput: function(input, callback) {
        if (input) {
            input.value = '';
            if (callback && typeof callback === 'function') callback();
        }
    },

    /**
     * Common sample text injector
     * @param {HTMLTextAreaElement|HTMLInputElement} input 
     * @param {string} text 
     * @param {Function} callback 
     */
    setSampleText: function(input, text, callback) {
        if (input && text) {
            input.value = text;
            if (callback && typeof callback === 'function') callback();
        }
    }
};

// Export for global use
window.ToolsUtils = ToolsUtils;
