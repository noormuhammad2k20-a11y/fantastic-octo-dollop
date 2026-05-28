<div class="row g-4 data-bridge-rebuilt">
    {{-- ═══════ INPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #fff; box-shadow: 0 4px 30px rgba(16, 185, 129, .05);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #10B981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-file-export"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#064e3b; letter-spacing: -0.5px;">Universal CSV to QIF Bridge</h4>
                    <p class="text-muted small mb-0">Seamlessly convert bank exports into Quicken Interchange Format (QIF). Compatible with legacy Quicken, Microsoft Money, and modern accounting apps.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <form id="toolForm" action="{{ url('/api/process/' . $tool['slug']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        {{-- Upload Zone --}}
                        <div class="col-md-7">
                            <div class="upload-zone-v2 p-5 rounded-4 border-2 border-dashed text-center h-100 d-flex flex-column align-items-center justify-content-center" id="dropZone" style="background: #f8fafc; border-color: #e2e8f0; transition: all 0.3s;">
                                <div class="icon-stack mb-3">
                                    <i class="fas fa-file-csv fs-1 text-emerald opacity-20"></i>
                                    <i class="fas fa-arrow-right mx-3 text-muted"></i>
                                    <i class="fas fa-file-code fs-1 text-success"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">Drop CSV File Here</h5>
                                <p class="small text-muted mb-3">Maximum file size: 10MB</p>
                                <input type="file" name="file" id="fileInput" class="d-none" required>
                                <button type="button" class="btn btn-emerald rounded-pill px-4 fw-bold shadow-sm" onclick="document.getElementById('fileInput').click()">Select Local File</button>
                                <div id="fileDisplay" class="mt-3 badge bg-emerald-soft text-emerald p-2 d-none"></div>
                            </div>
                        </div>

                        {{-- Configuration --}}
                        <div class="col-md-5">
                            <div class="p-4 rounded-4 border h-100 shadow-sm bg-white border-emerald">
                                <h6 class="fw-bold small mb-3 uppercase text-emerald opacity-70">Bridge Configuration</h6>
                                <div class="mb-3">
                                    <label class="form-label-custom">Source Date Format</label>
                                    <select name="date_format" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="MM/DD/YYYY">MM/DD/YYYY (US)</option>
                                        <option value="DD/MM/YYYY">DD/MM/YYYY (UK/EU)</option>
                                        <option value="YYYY-MM-DD">YYYY-MM-DD (ISO)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label-custom">QIF Header Type</label>
                                    <select name="qif_type" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="Bank">!Type:Bank</option>
                                        <option value="Cash">!Type:Cash</option>
                                        <option value="CCard">!Type:CCard (Credit Card)</option>
                                        <option value="Invst">!Type:Invst (Investment)</option>
                                    </select>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label-custom">CSV Column Mapping</label>
                                    <select name="mapping" class="form-select border-0 bg-light rounded-3 fw-bold">
                                        <option value="auto">Auto-Detect Headers</option>
                                        <option value="manual">Manual Configuration</option>
                                    </select>
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
                        <button type="submit" class="btn btn-emerald rounded-pill px-5 py-3 fw-bold shadow-lg" id="generateBtn" style="min-width: 280px; max-width: 100%;">
                            <i class="fas fa-bolt me-2"></i>Initiate Conversion
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ═══════ OUTPUT CARD — col-lg-12 ═══════ --}}
    <div class="col-lg-12">
        <div class="output-card-themed" id="results-wrapper" style="--tool-hue: 150; --tool-color: #10B981; --tool-bg: rgba(16, 185, 129, .04); display: none;">
            <div class="output-hero text-center py-5">
                <div class="success-icon-wrap mb-3">
                    <div class="tool-icon-circle mx-auto bg-success text-white shadow-lg" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
                <span class="output-hero-label text-uppercase tracking-widest opacity-70 fw-bold small">CONVERSION SUCCESSFUL</span>
                <div class="output-hero-value h2 fw-900 my-2" id="resultMessage">Your QIF is ready</div>
                <div class="mt-4">
                    <a href="#" id="downloadBtn" class="btn btn-success btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg">
                        <i class="fas fa-download me-2"></i>Download QIF File
                    </a>
                </div>
            </div>
        </div>

        {{-- Loader --}}
        <div id="loaderArea" class="p-5 text-center d-none">
            <div class="spinner-grow text-emerald" role="status" style="width: 4rem; height: 4rem;"></div>
            <h4 class="fw-bold mt-4 text-emerald-900">Synchronizing Data Bridge...</h4>
            <p class="text-muted small">Mapping QIF headers and validating transaction blocks.</p>
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
            $('dropZone').style.borderColor = '#10B981';
            $('dropZone').style.background = '#ECFDF5';
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
                $('resultMessage').textContent = data.message || 'QIF structure built successfully';
                let url = data.download_url || (data.results && data.results[0] && data.results[0].download_url);
                if(url){
                    $('downloadBtn').href = url;
                    $('downloadBtn').classList.remove('d-none');
                }
                results.scrollIntoView({ behavior: 'smooth' });
            } else {
                alert(data.message || 'Error mapping CSV columns to QIF fields.');
            }
        })
        .catch(err => {
            btn.disabled = false;
            loader.classList.add('d-none');
            alert('Connection to conversion engine lost.');
        });
    });
});
</script>

<style>
.data-bridge-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#064e3b;opacity:.7;margin-bottom:8px;display:block}
.btn-emerald { background: #10B981; color: #fff; transition: all .3s; }
.btn-emerald:hover { background: #059669; color: #fff; transform: translateY(-2px); }
.text-emerald { color: #10B981; }
.text-emerald-900 { color: #064e3b; }
.bg-emerald-soft { background: #ECFDF5; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
.upload-zone-v2:hover { border-color: #10B981 !important; background: #f0fdf4 !important; }
</style>

