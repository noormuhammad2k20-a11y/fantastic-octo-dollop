<div class="row g-4 roi-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label-custom">Select Format</label>
                        <select id="ig-format" class="form-select form-select-lg fw-bold">
                            <option value="profile">Profile Picture</option>
                            <option value="square" selected>Square Post (1:1)</option>
                            <option value="portrait">Portrait Post (4:5)</option>
                            <option value="landscape">Landscape Post (1.91:1)</option>
                            <option value="story">Instagram Story</option>
                            <option value="reel">Instagram Reel</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-hue:320;--tool-color:#ec4899;--tool-bg:rgba(236,72,153,.04);">
            <div class="output-hero">
                <span class="output-hero-label">RECOMMENDED DIMENSIONS</span>
                <div class="output-hero-value" id="ig-dims">1080 x 1080 px</div>
                <span class="output-hero-unit" id="ig-ratio">Aspect Ratio: 1:1</span>
            </div>
            
            <div class="mt-4" id="ig-insights"></div>
            
            <div class="row g-2 mt-4">
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ig-copy" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i>Copy Result
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn d-block mx-auto btn-outline-dark py-3 px-5 fw-bold rounded-pill shadow-sm" id="ig-reset" style="min-width: 280px; max-width: 100%;">
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
    
    const formats = {
        profile: { dims: '320 x 320 px', ratio: '1:1', insights: ['Displays at 110 x 110 pixels on mobile.', 'Upload a 320 x 320 px image to avoid pixelation.', 'Keep important elements centered as it will be cropped into a circle.'] },
        square: { dims: '1080 x 1080 px', ratio: '1:1', insights: ['Maximum resolution is 1080 x 1080 pixels.', 'Displays in feed as a perfect square.', 'Ideal for carousels and standard photo sharing.'] },
        portrait: { dims: '1080 x 1350 px', ratio: '4:5', insights: ['Takes up the most vertical space in the mobile feed.', 'Highly recommended for better engagement and visibility.', 'Images larger than 1080 x 1350 px will be cropped.'] },
        landscape: { dims: '1080 x 566 px', ratio: '1.91:1', insights: ['Also known as horizontal posts.', 'Can be as small as 600 x 315 px, but 1080 px width is recommended.', 'Takes up less screen real estate, which may result in lower engagement.'] },
        story: { dims: '1080 x 1920 px', ratio: '9:16', insights: ['Fills the entire mobile screen.', 'Leave 250 pixels at the top and bottom free from text/logos to avoid UI overlap.', 'Maximum video length is 60 seconds per slide.'] },
        reel: { dims: '1080 x 1920 px', ratio: '9:16', insights: ['Fills the entire mobile screen.', 'Appears as 4:5 (1080 x 1350 px) in the main news feed.', 'Keep important text/visuals in the safe zone (middle 1080 x 1350 px).'] }
    };

    function calculate() {
        const format = $('ig-format').value;
        const data = formats[format];
        
        $('ig-dims').textContent = data.dims;
        $('ig-ratio').textContent = 'Aspect Ratio: ' + data.ratio;
        
        const insightsHtml = '<h6 class="fw-bold mb-3"><i class="fas fa-lightbulb me-2 text-warning"></i>Format Guide & Tips</h6>' + 
                             '<ul class="list-unstyled mb-0">' + 
                             data.insights.map(i => `<li class="mb-2 pb-1" style="font-size:0.9rem"><i class="fas fa-check-circle text-success me-2"></i>${i}</li>`).join('') + 
                             '</ul>';
        $('ig-insights').innerHTML = insightsHtml;
    }

    $('ig-format').addEventListener('change', calculate);

    $('ig-copy').addEventListener('click', function() {
        const format = $('ig-format').options[$('ig-format').selectedIndex].text;
        const t = `Instagram Size Guide: ${format}\nDimensions: ${$('ig-dims').textContent}\n${$('ig-ratio').textContent}\n— ToolsHub`;
        navigator.clipboard.writeText(t).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });

    $('ig-reset').addEventListener('click', () => {
        $('ig-format').value = 'square';
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
.roi-rebuilt .output-hero-unit { font-size:1rem; font-weight:600; color:#475569; }
.roi-rebuilt .overflow-x-auto { overflow-x: auto; }
.roi-rebuilt .break-words { word-break: break-word; }
@media(max-width:768px){ 
    .roi-rebuilt .calculator-card, .roi-rebuilt .output-card-themed { padding:1.5rem; }
    .roi-rebuilt .output-hero-value { font-size:2rem; }
    .roi-rebuilt .calculator-header h4 { font-size:1.2rem; }
}
</style>
