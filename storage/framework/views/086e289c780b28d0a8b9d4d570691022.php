<div class="row g-4 data-bridge-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(99, 102, 241, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #6366F1, #8B5CF6); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#1e1b4b; letter-spacing: -0.5px;">Universal CSV to OFX Bridge</h4>
                    <p class="text-muted small mb-0">Seamlessly convert bank exports into standard OFX format for Quicken, QuickBooks, and Xero. Zero data storage, high-speed client-side processing.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <form id="toolForm" action="<?php echo e(url('/api/process/' . $tool['slug'])); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row g-4">
                        
                        <div class="col-md-7">
                            <div class="upload-zone-v2 p-5 rounded-4 border-2 border-dashed text-center h-100 d-flex flex-column align-items-center justify-content-center" id="dropZone" style="background: #f8fafc; border-color: #e2e8f0; transition: all 0.3s;">
                                <div class="icon-stack mb-3">
                                    <i class="fas fa-file-csv fs-1 text-indigo opacity-20"></i>
                                    <i class="fas fa-arrow-right mx-3 text-muted"></i>
                                    <i class="fas fa-file-code fs-1 text-purple"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">Drop CSV File Here</h5>
                                <p class="small text-muted mb-3">Maximum file size: 10MB</p>
                                <input type="file" name="file" id="fileInput" class="d-none" required>
                                <button type="button" class="btn btn-indigo rounded-pill px-4 fw-bold shadow-sm" onclick="document.getElementById('fileInput').click()">Select Local File</button>
                                <div id="fileDisplay" class="mt-3 badge bg-indigo-soft text-indigo p-2 d-none"></div>
                            </div>
                        </div>

                        
                        <div class="col-md-5">
                            <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-indigo">
                                <h6 class="fw-bold small mb-3 uppercase text-indigo opacity-70">Bridge Configuration</h6>
                                <div class="mb-3">
                                    <label class="form-label-custom">Source Date Format</label>
                                    <select name="date_format" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="MM/DD/YYYY">MM/DD/YYYY (US)</option>
                                        <option value="DD/MM/YYYY">DD/MM/YYYY (UK/EU)</option>
                                        <option value="YYYY-MM-DD">YYYY-MM-DD (ISO)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label-custom">OFX Account Type</label>
                                    <select name="account_type" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="CHECKING">Checking / Standard</option>
                                        <option value="SAVINGS">Savings</option>
                                        <option value="CREDITCARD">Credit Card</option>
                                    </select>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label-custom">Currency</label>
                                    <input type="text" name="currency" class="form-control border-0 bg-light rounded-3 fw-bold" value="USD">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light rounded-pill px-3 fw-bold btn-sm shadow-sm">
                                <i class="fas fa-download me-2"></i>Sample CSV
                            </button>
                        </div>
                        <button type="submit" class="btn btn-indigo rounded-pill px-5 py-3 fw-bold shadow-lg" id="generateBtn" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-bolt me-2"></i>Initiate Conversion
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="results-wrapper" style="--tool-hue: 255; --tool-color: #8B5CF6; --tool-bg: rgba(139, 92, 246, .04); display: none;">
            <div class="output-hero text-center py-5">
                <div class="success-icon-wrap mb-3">
                    <div class="tool-icon-circle mx-auto bg-success text-white shadow-lg" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">CONVERSION SUCCESSFUL</span>
                <div class="output-hero-value h2 fw-900 my-2" id="resultMessage">Your OFX is ready</div>
                <div class="mt-4">
                    <a href="#" id="downloadBtn" class="btn btn-purple btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg">
                        <i class="fas fa-download me-2"></i>Download OFX File
                    </a>
                </div>
            </div>
        </div>

        
        <div id="loaderArea" class="p-5 text-center d-none">
            <div class="spinner-grow text-indigo" role="status" style="width: 4rem; height: 4rem;"></div>
            <h4 class="fw-bold mt-4 text-indigo-900">Synchronizing Data Bridge...</h4>
            <p class="text-muted small">Optimizing column mapping and formatting OFX schema.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const form = $('toolForm');
    const fileInput = $('fileInput');
    const display = $('fileDisplay');
    const results = $('results-wrapper');
    const loader = $('loaderArea');
    const btn = $('generateBtn');

    fileInput.addEventListener('change', function(){
        if(this.files[0]){
            display.textContent = 'SELECTED: ' + this.files[0].name.toUpperCase();
            display.classList.remove('d-none');
            $('dropZone').style.borderColor = '#6366F1';
            $('dropZone').style.background = '#EEF2FF';
        }
    });

    form.addEventListener('submit', function(e){
        e.preventDefault();
        const formData = new FormData(this);
        
        btn.disabled = true;
        loader.classList.remove('d-none');
        results.style.display = 'none';
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            btn.disabled = false;
            loader.classList.add('d-none');
            
            if(data.success){
                results.style.display = 'block';
                $('resultMessage').textContent = data.message || 'Data stream mapped successfully';
                let url = data.download_url || (data.results && data.results[0] && data.results[0].download_url);
                if(url){
                    $('downloadBtn').href = url;
                    $('downloadBtn').classList.remove('d-none');
                }
                results.scrollIntoView({ behavior: 'smooth' });
            } else {
                alert(data.message || 'Stream alignment failed. Please check CSV format.');
            }
        })
        .catch(err => {
            btn.disabled = false;
            loader.classList.add('d-none');
            alert('Connection to data bridge lost.');
        });
    });
});
</script>

<style>
.data-bridge-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#1e1b4b;opacity:.7;margin-bottom:8px;display:block}
.btn-indigo { background: #6366F1; color: #fff; transition: all .3s; }
.btn-indigo:hover { background: #4F46E5; color: #fff; transform: translateY(-2px); }
.btn-purple { background: #8B5CF6; color: #fff; transition: all .3s; }
.btn-purple:hover { background: #7C3AED; color: #fff; transform: translateY(-2px); }
.text-indigo { color: #6366F1; }
.text-indigo-900 { color: #1e1b4b; }
.bg-indigo-soft { background: #EEF2FF; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.upload-zone-v2:hover { border-color: #6366F1 !important; background: #f1f5f9 !important; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\csv-to-ofx.blade.php ENDPATH**/ ?>