<div class="row g-4 roi-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Target Platform</label>
                        <select id="sp-platform" class="form-select form-select-lg">
                            <option value="twitter">X / Twitter</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="instagram">Instagram</option>
                            <option value="facebook">Facebook</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label-custom">Post Content</label>
                        <textarea id="sp-content" class="form-control" rows="5" placeholder="Type or paste your post caption here..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:199;--tool-color:#0ea5e9;--tool-bg:rgba(14,165,233,.04);">
            <div class="output-hero">
                <span class="output-hero-label">OVERALL READINESS SCORE</span>
                <div class="output-hero-value" id="sp-score">0 / 100</div>
                <span class="output-hero-unit" id="sp-status">AWAITING CONTENT</span>
            </div>
            
            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Character Count</span>
                        <span class="fs-4 fw-bold" id="sp-chars">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Word Count</span>
                        <span class="fs-4 fw-bold" id="sp-words">0</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-color:#e5e7eb;background:#fff;padding:1.5rem;border-radius:16px;text-align:center;border:1px solid #e5e7eb">
                        <span class="form-label-custom mb-1">Hashtags Found</span>
                        <span class="fs-4 fw-bold" id="sp-hashtags">0</span>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="sp-insights"></div>
            
            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="sp-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i>Copy Result
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="sp-reset" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-rotate-left me-2"></i>Reset Fields
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    const guidelines = {
        twitter: { maxChars: 280, idealChars: 100, maxHashtags: 2 },
        linkedin: { maxChars: 3000, idealChars: 150, maxHashtags: 3 },
        instagram: { maxChars: 2200, idealChars: 150, maxHashtags: 11 },
        facebook: { maxChars: 63206, idealChars: 80, maxHashtags: 2 }
    };

    function calculate() {
        const platform = $('sp-platform').value;
        const text = $('sp-content').value;
        const data = guidelines[platform];
        
        if (text.trim() === '') {
            $('sp-score').textContent = '0 / 100';
            $('sp-chars').textContent = '0';
            $('sp-words').textContent = '0';
            $('sp-hashtags').textContent = '0';
            $('sp-status').textContent = 'AWAITING CONTENT';
            $('sp-status').style.color = '#64748b';
            $('sp-insights').innerHTML = '';
            return;
        }

        const charCount = text.length;
        const wordsMatch = text.match(/\b[-?a-zA-Z0-9_]+\b/g);
        const wordCount = wordsMatch ? wordsMatch.length : 0;
        const hashtagsMatch = text.match(/#[\w]+/g);
        const hashtagCount = hashtagsMatch ? hashtagsMatch.length : 0;
        
        const hasLink = /https?:\/\/[^\s]+/.test(text);
        const hasQuestion = /\?/.test(text);

        $('sp-chars').textContent = charCount + ' / ' + data.maxChars;
        $('sp-words').textContent = wordCount;
        $('sp-hashtags').textContent = hashtagCount;

        let score = 100;
        let ins = [];
        let statusColor = '#22c55e';
        let statusText = 'OPTIMAL POST';

        // Length Check
        if (charCount > data.maxChars) {
            score -= 50;
            ins.push(`<span class="text-danger">Too Long:</span> Your post exceeds the ${data.maxChars} character limit for this platform!`);
        } else if (charCount < 10) {
            score -= 20;
            ins.push(`<span class="text-warning">Too Short:</span> Post is very short. Add more context to hook the reader.`);
        } else if (charCount > data.idealChars * 2) {
            score -= 10;
            ins.push(`Consider shortening. The ideal length for maximum engagement on this platform is around ${data.idealChars} characters.`);
        } else {
            ins.push(`<span class="text-success">Good Length:</span> Your character count is in the sweet spot for engagement.`);
        }

        // Hashtag Check
        if (hashtagCount > data.maxHashtags) {
            score -= 15;
            ins.push(`<span class="text-warning">Too Many Hashtags:</span> You used ${hashtagCount}. Limit to ${data.maxHashtags} on this platform to avoid looking spammy.`);
        } else if (hashtagCount === 0 && platform !== 'facebook') {
            score -= 10;
            ins.push(`You didn't include any hashtags. Adding 1-2 relevant hashtags can boost discoverability.`);
        } else {
            ins.push(`<span class="text-success">Optimal Hashtags:</span> You used an appropriate number of hashtags.`);
        }

        // Structure Checks
        if (!hasQuestion && platform !== 'twitter') {
            ins.push(`No question detected. Ending your post with a question is a proven way to increase comments and engagement.`);
            score -= 5;
        }
        
        if (!hasLink && platform === 'linkedin') {
            ins.push(`Consider adding a link. LinkedIn posts with links or rich media generally perform better.`);
        }

        if (score < 0) score = 0;

        if (score >= 90) {
            statusText = 'READY TO PUBLISH 🚀';
            statusColor = '#22c55e';
        } else if (score >= 70) {
            statusText = 'NEEDS MINOR TWEAKS';
            statusColor = '#f59e0b';
        } else {
            statusText = 'NEEDS REVISION';
            statusColor = '#ef4444';
        }

        $('sp-score').textContent = score + ' / 100';
        $('sp-status').textContent = statusText;
        $('sp-status').style.color = statusColor;

        $('sp-insights').innerHTML = '<h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Optimization Guide</h6>' + 
                                     '<ul class="list-unstyled mb-0">' + 
                                     ins.map(i => `<li class="mb-2 pb-1" style="font-size:0.9rem"><i class="fas fa-check-circle text-muted me-2"></i>${i}</li>`).join('') + 
                                     '</ul>';
    }

    $('sp-platform').addEventListener('change', calculate);
    $('sp-content').addEventListener('input', calculate);

    $('sp-copy').addEventListener('click', function() {
        const text = $('sp-content').value;
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied Text!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('sp-reset').addEventListener('click', () => {
        $('sp-content').value = '';
        $('sp-platform').value = 'twitter';
        calculate();
    });

    calculate();
});
</script>

<style>
.roi-rebuilt .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:20px; padding:2rem; box-shadow:0 4px 24px rgba(0,0,0,.04); }
.roi-rebuilt .calculator-header { display:flex; align-items:center; gap:1.25rem; margin-bottom:2rem; }
.roi-rebuilt .calculator-header h4 { margin:0; font-weight:800; color:#1e293b; font-size:1.4rem; }
.roi-rebuilt .calculator-header p { margin:0; font-size:0.95rem; color:#64748b; }
.roi-rebuilt .tool-icon-circle { width:60px; height:60px; border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.6rem; flex-shrink:0; }
.roi-rebuilt .form-label-custom { font-size:.8rem; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:.8px; margin-bottom:.5rem; display:block; }
.roi-rebuilt .output-card-themed { background:var(--tool-bg); border:1px solid rgba(0,0,0,.05); border-radius:20px; padding:2rem; }
.roi-rebuilt .output-hero { background:#fff; border-radius:16px; padding:2rem; text-align:center; box-shadow:0 4px 12px rgba(0,0,0,.02); border:1px solid rgba(0,0,0,.04); }
.roi-rebuilt .output-hero-label { font-size:.85rem; font-weight:700; color:#64748b; letter-spacing:1px; display:block; margin-bottom:.5rem; }
.roi-rebuilt .output-hero-value { font-size:2.5rem; font-weight:800; color:var(--tool-color); line-height:1.2; margin-bottom:.5rem; }
.roi-rebuilt .output-hero-unit { font-size:1rem; font-weight:700; color:#475569; }
.roi-rebuilt .overflow-x-auto { overflow-x: auto; }
.roi-rebuilt .break-words { word-break: break-word; }
@media(max-width:768px){ 
    .roi-rebuilt .calculator-card, .roi-rebuilt .output-card-themed { padding:1.5rem; }
    .roi-rebuilt .output-hero-value { font-size:2rem; }
    .roi-rebuilt .calculator-header h4 { font-size:1.2rem; }
}
</style>
