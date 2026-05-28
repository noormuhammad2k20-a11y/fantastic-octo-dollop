<div class="row g-4 twitter-calc-v2">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Tweet Content</label>
                    <textarea id="tweet-input" class="form-control form-control-lg rounded-3" rows="6" placeholder="What's happening?"></textarea>
                    <div class="d-flex justify-content-between mt-2 small text-muted">
                        <span id="char-limit-text">Standard Limit: 280</span>
                        <span id="char-remaining-text">Remaining: 280</span>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-check form-switch p-3 border rounded-3 bg-light-soft">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="premium-toggle">
                            <label class="form-check-label fw-bold small text-dark" for="premium-toggle">
                                <i class="fas fa-certificate text-primary me-1"></i> Twitter Premium (X Blue)
                            </label>
                            <p class="mb-0 x-small text-muted mt-1">Increases limit to 25,000 characters.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch p-3 border rounded-3 bg-light-soft">
                            <input class="form-check-input ms-0 me-2" type="checkbox" id="breakdown-toggle" checked>
                            <label class="form-check-label fw-bold small text-dark" for="breakdown-toggle">
                                <i class="fas fa-list-check text-info me-1"></i> Detailed Breakdown
                            </label>
                            <p class="mb-0 x-small text-muted mt-1">Analyze hashtags, mentions, and links.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill shadow-sm" id="btn-analyze">
                        <i class="fas fa-magnifying-glass me-2"></i> Analyze Tweet
                    </button>
                    <button type="button" class="btn btn-outline-secondary px-4 fw-bold rounded-pill shadow-sm" id="btn-reset">
                        <i class="fas fa-undo me-2"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed" id="twitter-output-card" style="--tool-hue:203;--tool-color:#1d9bf0;--tool-bg:rgba(29,155,240,.04);">
            <div class="output-hero">
                <span class="output-hero-label">Character Count</span>
                <div class="output-hero-value" id="out-char-count">0</div>
                <span class="output-hero-unit" id="out-char-percent">0% of limit</span>
            </div>

            <div class="position-relative mt-3 mb-4">
                <div class="progress rounded-pill" style="height:14px;background:#f1f5f9">
                    <div id="out-progress-bar" class="progress-bar rounded-pill" style="width:0%;background:#1d9bf0;transition:all .3s"></div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Remaining</span>
                        <span class="stat-card-value" id="out-remaining">280</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Hashtags</span>
                        <span class="stat-card-value" id="out-hashtags">0</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Mentions</span>
                        <span class="stat-card-value" id="out-mentions">0</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <span class="stat-card-label">Links</span>
                        <span class="stat-card-value" id="out-links">0</span>
                    </div>
                </div>
            </div>

            <div id="breakdown-section" class="mt-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-white h-100">
                            <h6 class="fw-bold small mb-2"><i class="fas fa-hashtag text-primary me-2"></i>Hashtags</h6>
                            <div id="list-hashtags" class="d-flex flex-wrap gap-1">
                                <span class="text-muted small">None detected</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-white h-100">
                            <h6 class="fw-bold small mb-2"><i class="fas fa-at text-info me-2"></i>Mentions</h6>
                            <div id="list-mentions" class="d-flex flex-wrap gap-1">
                                <span class="text-muted small">None detected</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-5 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Result Summary
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tweetInput = document.getElementById('tweet-input');
    const premiumToggle = document.getElementById('premium-toggle');
    const breakdownToggle = document.getElementById('breakdown-toggle');
    const outCharCount = document.getElementById('out-char-count');
    const outCharPercent = document.getElementById('out-char-percent');
    const outProgressBar = document.getElementById('out-progress-bar');
    const outRemaining = document.getElementById('out-remaining');
    const outHashtags = document.getElementById('out-hashtags');
    const outMentions = document.getElementById('out-mentions');
    const outLinks = document.getElementById('out-links');
    const listHashtags = document.getElementById('list-hashtags');
    const listMentions = document.getElementById('list-mentions');
    const breakdownSection = document.getElementById('breakdown-section');
    const charLimitText = document.getElementById('char-limit-text');
    const charRemainingText = document.getElementById('char-remaining-text');

    const TWITTER_URL_LENGTH = 23;
    const EMOJI_LENGTH = 2;

    function countCharacters(text) {
        if (!text) return 0;

        // 1. Handle URLs (t.co length is fixed at 23)
        // Regex for URLs
        const urlRegex = /https?:\/\/[^\s]+/g;
        let urlMatches = text.match(urlRegex) || [];
        let count = text.replace(urlRegex, '').length;
        count += urlMatches.length * TWITTER_URL_LENGTH;

        // 2. Handle Emojis (Twitter counts most as 2 chars)
        // Simplified emoji regex - in a real app use twitter-text library
        const emojiRegex = /[\u{1F300}-\u{1F9FF}\u{2600}-\u{26FF}\u{2700}-\u{27BF}]/gu;
        let emojiMatches = text.match(emojiRegex) || [];
        // The above text.length already counts emojis (sometimes as 1, sometimes as 2 depending on encoding)
        // Let's refine: replace emojis with something of length 2 and count that
        let textWithoutUrls = text.replace(urlRegex, '');
        let emojiCount = (textWithoutUrls.match(emojiRegex) || []).length;
        let textWithoutUrlsAndEmojis = textWithoutUrls.replace(emojiRegex, '');
        
        return textWithoutUrlsAndEmojis.length + (emojiCount * EMOJI_LENGTH) + (urlMatches.length * TWITTER_URL_LENGTH);
    }

    function update() {
        const text = tweetInput.value;
        const limit = premiumToggle.checked ? 25000 : 280;
        const count = countCharacters(text);
        const remaining = limit - count;
        const percent = Math.min(100, (count / limit) * 100);

        outCharCount.textContent = count.toLocaleString();
        outCharPercent.textContent = Math.round(percent) + '% of limit';
        outRemaining.textContent = remaining.toLocaleString();
        
        outProgressBar.style.width = percent + '%';
        if (percent > 100) {
            outProgressBar.style.background = '#ef4444';
        } else if (percent > 90) {
            outProgressBar.style.background = '#f59e0b';
        } else {
            outProgressBar.style.background = '#1d9bf0';
        }

        charLimitText.textContent = (premiumToggle.checked ? 'Premium' : 'Standard') + ' Limit: ' + limit.toLocaleString();
        charRemainingText.textContent = 'Remaining: ' + remaining.toLocaleString();

        // Breakdown
        if (breakdownToggle.checked) {
            breakdownSection.style.display = 'block';
            const hashtags = (text.match(/#[a-z0-9_]+/gi) || []);
            const mentions = (text.match(/@[a-z0-9_]+/gi) || []);
            const links = (text.match(/https?:\/\/[^\s]+/g) || []);

            outHashtags.textContent = hashtags.length;
            outMentions.textContent = mentions.length;
            outLinks.textContent = links.length;

            listHashtags.innerHTML = hashtags.length ? hashtags.map(h => `<span class="badge bg-primary-soft text-primary border">${h}</span>`).join('') : '<span class="text-muted small">None detected</span>';
            listMentions.innerHTML = mentions.length ? mentions.map(m => `<span class="badge bg-info-soft text-info border">${m}</span>`).join('') : '<span class="text-muted small">None detected</span>';
        } else {
            breakdownSection.style.display = 'none';
        }
    }

    tweetInput.addEventListener('input', update);
    premiumToggle.addEventListener('change', update);
    breakdownToggle.addEventListener('change', update);

    document.getElementById('btn-reset').addEventListener('click', () => {
        tweetInput.value = '';
        premiumToggle.checked = false;
        update();
    });

    document.getElementById('btn-analyze').addEventListener('click', update);

    document.getElementById('btn-copy').addEventListener('click', function() {
        const summary = `Twitter/X Analysis\nCharacters: ${outCharCount.textContent} / ${premiumToggle.checked ? '25,000' : '280'}\nHashtags: ${outHashtags.textContent}\nMentions: ${outMentions.textContent}\nLinks: ${outLinks.textContent}\n— ToolsHub Twitter Utilities`;
        navigator.clipboard.writeText(summary).then(() => {
            const original = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = original, 2000);
        });
    });

    update();
});
</script>

<style>
.twitter-calc-v2 .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:24px; padding:2.5rem; box-shadow:0 8px 48px rgba(29,155,240,.05); }
.twitter-calc-v2 .calculator-header { display:flex; align-items:center; gap:1.25rem; margin-bottom:2.5rem; }
.twitter-calc-v2 .calculator-header h4 { margin:0; font-weight:900; color:#0f172a; letter-spacing:-1px; font-size:1.5rem; }
.twitter-calc-v2 .calculator-header p { margin:0; font-size:1rem; color:#64748b; line-height:1.6; }
.twitter-calc-v2 .tool-icon-circle { width:64px; height:64px; border-radius:18px; display:flex; align-items:center; justify-content:center; font-size:1.8rem; flex-shrink:0; }
.twitter-calc-v2 .form-label-custom { font-size:.75rem; font-weight:800; color:#1e293b; text-transform:uppercase; letter-spacing:1.2px; margin-bottom:.75rem; display:block; }
.twitter-calc-v2 .bg-light-soft { background: rgba(248, 250, 252, 0.8); }
.twitter-calc-v2 .x-small { font-size: 0.7rem; }
.twitter-calc-v2 .bg-primary-soft { background: rgba(29, 155, 240, 0.1); }
.twitter-calc-v2 .bg-info-soft { background: rgba(14, 165, 233, 0.1); }

/* VIP Output Styles */
.twitter-calc-v2 .output-card-themed { background: var(--tool-bg); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.08); }
.twitter-calc-v2 .output-hero { text-align: center; margin-bottom: 1.5rem; }
.twitter-calc-v2 .output-hero-label { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; color: #64748b; }
.twitter-calc-v2 .output-hero-value { font-size: 4rem; font-weight: 900; color: var(--tool-color); line-height: 1; margin: 0.5rem 0; letter-spacing: -3px; }
.twitter-calc-v2 .output-hero-unit { font-size: 1rem; color: #94a3b8; font-weight: 600; }

.twitter-calc-v2 .stat-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 20px; padding: 1.25rem; text-align: center; transition: all 0.3s ease; }
.twitter-calc-v2 .stat-card:hover { transform: translateY(-5px); border-color: var(--tool-color); box-shadow: 0 10px 20px rgba(0,0,0,.05); }
.twitter-calc-v2 .stat-card-label { display: block; font-size: .65rem; font-weight: 800; text-transform: uppercase; color: #94a3b8; letter-spacing: 1px; margin-bottom: 5px; }
.twitter-calc-v2 .stat-card-value { font-size: 1.5rem; font-weight: 900; color: #1e293b; display: block; }

@media (max-width: 768px) {
    .twitter-calc-v2 .calculator-card, .twitter-calc-v2 .output-card-themed { padding: 1.5rem; }
    .twitter-calc-v2 .output-hero-value { font-size: 3rem; }
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\twitter-character-counter.blade.php ENDPATH**/ ?>