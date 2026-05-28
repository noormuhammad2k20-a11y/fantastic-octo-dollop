<div class="row g-4 insta-calc-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Post Type</label>
                        <select id="insta-type" class="form-select form-select-lg rounded-3 fw-bold">
                            <option value="post">Standard Post</option>
                            <option value="reel">Instagram Reel</option>
                            <option value="carousel">Carousel</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Total Followers</label>
                        <input type="number" id="insta-followers" class="form-control form-control-lg rounded-3" value="10000" min="1">
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label-custom">Likes</label>
                        <input type="number" id="insta-likes" class="form-control form-control-lg rounded-3" value="500" min="0">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label-custom">Comments</label>
                        <input type="number" id="insta-comments" class="form-control form-control-lg rounded-3" value="50" min="0">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label-custom">Saves</label>
                        <input type="number" id="insta-saves" class="form-control form-control-lg rounded-3" value="10" min="0">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label-custom">Shares</label>
                        <input type="number" id="insta-shares" class="form-control form-control-lg rounded-3" value="5" min="0">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button id="btn-calculate" class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill shadow-sm" style="background: linear-gradient(45deg, #e6683c, #cc2366); border: none;">
                        <i class="fas fa-bolt me-2"></i> Calculate Engagement
                    </button>
                    <button type="button" id="btn-reset" class="btn btn-outline-secondary px-4 fw-bold rounded-pill shadow-sm">
                        <i class="fas fa-undo me-2"></i> Reset Fields
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:330;--tool-color:#db2777;--tool-bg:rgba(219, 39, 119, 0.04);">
            <div class="output-hero">
                <span class="output-hero-label">Engagement Rate</span>
                <div class="output-hero-value break-words overflow-x-auto" id="out-rate">0.00%</div>
                <div class="mt-2 text-muted fw-bold" id="out-benchmark">—</div>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Interactions</span>
                        <span class="stat-card-value" id="out-interactions">0</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Followers</span>
                        <span class="stat-card-value" id="out-followers">0</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-card">
                        <span class="stat-card-label">Post Type</span>
                        <span class="stat-card-value text-capitalize" id="out-type" style="font-size: 1.5rem;">—</span>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h5 class="fw-bold fs-6 text-uppercase text-muted mb-3 small letter-spacing-1">
                    <i class="fas fa-list-ol me-2 text-info"></i> Calculation Breakdown
                </h5>
                <div class="bg-white shadow-sm border p-4 rounded-3 small text-secondary break-words overflow-x-auto">
                    <ol class="mb-0 ps-3" style="line-height: 1.8;">
                        <li><strong>Step 1:</strong> Sum all interactions. 
                            (<span id="bd-likes">0</span> Likes + <span id="bd-comments">0</span> Comments + <span id="bd-saves">0</span> Saves + <span id="bd-shares">0</span> Shares) = <strong><span id="bd-interactions">0</span> Total Interactions</strong>.
                        </li>
                        <li><strong>Step 2:</strong> Divide interactions by total followers.
                            (<span id="bd-interactions2">0</span> / <span id="bd-followers">0</span>) = <strong><span id="bd-ratio">0</span></strong>.
                        </li>
                        <li><strong>Step 3:</strong> Multiply by 100 to get the percentage.
                            (<span id="bd-ratio2">0</span> * 100) = <strong><span id="bd-rate">0</span>%</strong>.
                        </li>
                    </ol>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-dark mt-5 py-3 px-5 fw-bold rounded-pill shadow-sm" id="btn-copy" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Result
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    
    const inputs = {
        type: $('insta-type'),
        followers: $('insta-followers'),
        likes: $('insta-likes'),
        comments: $('insta-comments'),
        saves: $('insta-saves'),
        shares: $('insta-shares')
    };

    function formatNumber(num) {
        return new Intl.NumberFormat().format(num);
    }

    function calculate() {
        const followers = parseFloat(inputs.followers.value) || 0;
        const likes = parseFloat(inputs.likes.value) || 0;
        const comments = parseFloat(inputs.comments.value) || 0;
        const saves = parseFloat(inputs.saves.value) || 0;
        const shares = parseFloat(inputs.shares.value) || 0;
        const type = inputs.type.options[inputs.type.selectedIndex].text;

        if (followers <= 0) {
            $('out-rate').textContent = '0.00%';
            $('out-benchmark').textContent = 'Please enter a valid follower count.';
            return;
        }

        const totalInteractions = likes + comments + saves + shares;
        const ratio = totalInteractions / followers;
        const rate = ratio * 100;

        // Output Card Updates
        $('out-rate').textContent = rate.toFixed(2) + '%';
        $('out-interactions').textContent = formatNumber(totalInteractions);
        $('out-followers').textContent = formatNumber(followers);
        $('out-type').textContent = type;

        // Benchmarks
        let benchmarkText = "Average Engagement";
        if (rate < 1.0) benchmarkText = "Below Average (Needs Improvement)";
        else if (rate >= 1.0 && rate <= 3.5) benchmarkText = "Good/Average Engagement";
        else if (rate > 3.5 && rate <= 6.0) benchmarkText = "High Engagement";
        else benchmarkText = "Excellent/Viral Engagement";
        
        $('out-benchmark').textContent = benchmarkText;

        // Breakdown Updates
        $('bd-likes').textContent = formatNumber(likes);
        $('bd-comments').textContent = formatNumber(comments);
        $('bd-saves').textContent = formatNumber(saves);
        $('bd-shares').textContent = formatNumber(shares);
        
        $('bd-interactions').textContent = formatNumber(totalInteractions);
        $('bd-interactions2').textContent = formatNumber(totalInteractions);
        
        $('bd-followers').textContent = formatNumber(followers);
        $('bd-ratio').textContent = ratio.toFixed(5);
        $('bd-ratio2').textContent = ratio.toFixed(5);
        $('bd-rate').textContent = rate.toFixed(2);
    }

    // Event Listeners
    $('btn-calculate').addEventListener('click', calculate);
    
    // Auto-calc on input change (optional, but requested for real-time feel)
    Object.values(inputs).forEach(input => {
        input.addEventListener('input', calculate);
    });

    $('btn-reset').addEventListener('click', () => {
        inputs.type.value = 'post';
        inputs.followers.value = '10000';
        inputs.likes.value = '500';
        inputs.comments.value = '50';
        inputs.saves.value = '10';
        inputs.shares.value = '5';
        calculate();
    });

    $('btn-copy').addEventListener('click', function() {
        const rate = $('out-rate').textContent;
        const text = `Instagram Engagement Rate: ${rate}\n` +
                     `Post Type: ${$('out-type').textContent}\n` +
                     `Followers: ${$('out-followers').textContent}\n` +
                     `Interactions: ${$('out-interactions').textContent}\n` +
                     `Formula: ((Likes + Comments + Saves + Shares) / Followers) * 100\n` +
                     `— ToolsHub Calculators`;
                     
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = originalHTML, 2000);
        });
    });

    // Initial calculation
    calculate();
});
</script>

<style>
.insta-calc-rebuilt .calculator-card { background:#fff; border:1px solid #e5e7eb; border-radius:24px; padding:2.5rem; box-shadow:0 8px 48px rgba(0,0,0,.05); }
.insta-calc-rebuilt .calculator-header { display:flex; align-items:center; gap:1.5rem; margin-bottom:2rem; }
.insta-calc-rebuilt .calculator-header h4 { margin:0; font-weight:900; color:#0f172a; letter-spacing:-0.5px; }
.insta-calc-rebuilt .calculator-header p { margin:0; font-size:1rem; color:#64748b; line-height:1.6; }
.insta-calc-rebuilt .tool-icon-circle { width:64px; height:64px; border-radius:18px; display:flex; align-items:center; justify-content:center; font-size:1.8rem; flex-shrink:0; }
.insta-calc-rebuilt .form-label-custom { font-size:0.75rem; font-weight:800; color:#1e293b; text-transform:uppercase; letter-spacing:1.2px; margin-bottom:0.75rem; display:block; }

.output-card-themed { background: var(--tool-bg, #f8fafc); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.08); }
.output-hero { padding: 2rem 0; border-bottom: 2px solid rgba(0,0,0,.04); margin-bottom: 2rem; }
.output-hero-label { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 5rem; font-weight: 900; color: var(--tool-color, #1e293b); line-height: 1; margin: 0.5rem 0; letter-spacing: -3px; }

.stat-card { background: #fff; border: 2.5px solid #f1f5f9; border-radius: 20px; padding: 1.5rem 1.25rem; text-align: center; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); height: 100%; }
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label { display: block; font-size: .65rem; font-weight: 900; text-transform: uppercase; color: #94a3b8; letter-spacing: 1.5px; margin-bottom: 8px; }
.stat-card-value { font-size: 2rem; font-weight: 900; display: block; line-height: 1.2; color: #0f172a; }

.break-words { word-break: break-all; word-wrap: break-word; overflow-wrap: break-word; }
.letter-spacing-1 { letter-spacing: 1px; }

@media (max-width: 576px) {
    .insta-calc-rebuilt .calculator-card { padding: 1.5rem; }
    .output-card-themed { padding: 1.5rem; }
    .output-hero-value { font-size: 3.5rem; letter-spacing: -2px; }
    .stat-card { padding: 1rem 0.5rem; }
    .stat-card-value { font-size: 1.5rem; }
}
</style>
