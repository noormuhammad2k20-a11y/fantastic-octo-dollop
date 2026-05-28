<div class="row g-4 og-checker-rebuilt">
    {{-- ═══════ INPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="alert alert-light border rounded-3 small mb-4">
                    <i class="fas fa-info-circle text-primary me-2"></i><strong>Note:</strong> Due to browser CORS restrictions, direct URL fetching is limited. Enter your Open Graph meta values below to instantly preview your social cards.
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Site / Domain Name</label>
                        <input type="text" id="chk-domain" class="form-control form-control-lg rounded-3" placeholder="example.com">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">og:title</label>
                        <input type="text" id="chk-title" class="form-control form-control-lg rounded-3" placeholder="Your Page Title">
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label-custom">og:description</label>
                        <textarea id="chk-desc" class="form-control rounded-3" rows="2" placeholder="Brief summary of the page..."></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label-custom">og:image URL</label>
                        <input type="url" id="chk-img" class="form-control form-control-lg rounded-3" placeholder="https://example.com/image.jpg">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill" id="action-generate" style="background-color: #8b5cf6; border-color: #8b5cf6;"><i class="fas fa-desktop me-2"></i>Generate Preview</button>
                    <button class="btn btn-outline-secondary py-3 px-4 fw-bold rounded-pill" id="action-reset"><i class="fas fa-undo"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-container" style="--tool-hue:258;--tool-color:#8b5cf6;--tool-bg:rgba(139,92,246,.04); display: none;">
            
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3"><i class="fab fa-facebook me-2" style="color: #1877F2;"></i>Facebook Style Preview</h6>
                    <div class="fb-preview-card" style="border: 1px solid #dadde1; border-radius: 8px; overflow: hidden; background: #fff; max-width: 500px; margin: 0 auto;">
                        <div class="fb-img-container" style="width: 100%; height: 261px; background: #f0f2f5; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <img id="out-fb-img" src="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                            <i id="out-fb-icon" class="fas fa-image text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <div style="padding: 10px 12px; background: #f2f3f5; border-top: 1px solid #dadde1;">
                            <div id="out-fb-domain" style="text-transform: uppercase; color: #65676B; font-size: 12px; font-family: Helvetica, Arial, sans-serif; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">EXAMPLE.COM</div>
                            <div id="out-fb-title" style="font-weight: 600; color: #1c1e21; font-size: 16px; margin: 5px 0; font-family: Helvetica, Arial, sans-serif; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 20px;">Page Title</div>
                            <div id="out-fb-desc" style="color: #65676B; font-size: 14px; font-family: Helvetica, Arial, sans-serif; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; line-height: 20px;">Page Description</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="fw-bold mb-3"><i class="fab fa-twitter me-2" style="color: #1DA1F2;"></i>Twitter Style Preview</h6>
                    <div class="tw-preview-card" style="border: 1px solid #cfd9de; border-radius: 16px; overflow: hidden; background: #fff; max-width: 500px; margin: 0 auto;">
                        <div class="tw-img-container" style="width: 100%; height: 261px; background: #f7f9f9; display: flex; align-items: center; justify-content: center; overflow: hidden; border-bottom: 1px solid #cfd9de;">
                            <img id="out-tw-img" src="" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                            <i id="out-tw-icon" class="fas fa-image text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <div style="padding: 12px;">
                            <div id="out-tw-title" style="font-weight: 700; color: #0f1419; font-size: 15px; margin-bottom: 2px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Page Title</div>
                            <div id="out-tw-desc" style="color: #536471; font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">Page Description</div>
                            <div id="out-tw-domain" style="color: #536471; font-size: 15px; margin-top: 2px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; display: flex; align-items: center;"><i class="fas fa-link me-1" style="font-size: 12px;"></i> <span id="out-tw-domain-text">example.com</span></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $=id=>document.getElementById(id);
    
    const domainEl = $('chk-domain');
    const titleEl = $('chk-title');
    const descEl = $('chk-desc');
    const imgEl = $('chk-img');
    
    const outContainer = $('output-container');
    
    $('action-generate').addEventListener('click', function() {
        const domain = domainEl.value.trim() || 'example.com';
        const title = titleEl.value.trim() || 'Your Page Title';
        const desc = descEl.value.trim() || 'Brief summary of the page...';
        const img = imgEl.value.trim();
        
        // FB
        $('out-fb-domain').textContent = domain.toUpperCase();
        $('out-fb-title').textContent = title;
        $('out-fb-desc').textContent = desc;
        
        if(img) {
            $('out-fb-img').src = img;
            $('out-fb-img').style.display = 'block';
            $('out-fb-icon').style.display = 'none';
        } else {
            $('out-fb-img').style.display = 'none';
            $('out-fb-icon').style.display = 'block';
        }

        // Twitter
        $('out-tw-domain-text').textContent = domain.toLowerCase();
        $('out-tw-title').textContent = title;
        $('out-tw-desc').textContent = desc;
        
        if(img) {
            $('out-tw-img').src = img;
            $('out-tw-img').style.display = 'block';
            $('out-tw-icon').style.display = 'none';
        } else {
            $('out-tw-img').style.display = 'none';
            $('out-tw-icon').style.display = 'block';
        }

        outContainer.style.display = 'block';
        outContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    $('action-reset').addEventListener('click', function() {
        domainEl.value = '';
        titleEl.value = '';
        descEl.value = '';
        imgEl.value = '';
        outContainer.style.display = 'none';
    });
});
</script>

<style>
.form-label-custom {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}
.calculator-card {
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
    overflow: hidden;
}
.calculator-header {
    padding: 2rem 2rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    gap: 1.25rem;
}
.tool-icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}
.calculator-header h4 {
    margin: 0 0 0.25rem 0;
    font-weight: 700;
    color: #111827;
}
.calculator-header p {
    margin: 0;
    color: #6b7280;
    font-size: 0.95rem;
}
.calculator-body {
    padding: 2rem;
}
.output-card-themed {
    background: #fff;
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid var(--tool-bg);
    border-top: 4px solid var(--tool-color);
}
</style>
