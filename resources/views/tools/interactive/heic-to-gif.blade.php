
@push('styles')
<style>
    .tool-header-card {
        background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        border: none;
        border-radius: 1rem;
        padding: 3rem 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
        text-align: center;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    .tool-header-card i {
        font-size: 3.5rem;
        background: -webkit-linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1rem;
    }
    .upload-zone {
        border: 2px dashed #a0aec0;
        border-radius: 1rem;
        padding: 4rem 2rem;
        text-align: center;
        background: #f8fafc;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .upload-zone:hover, .upload-zone.dragover {
        border-color: #667eea;
        background: #ebf4ff;
    }
    .upload-zone i {
        font-size: 3rem;
        color: #a0aec0;
        margin-bottom: 1rem;
        transition: color 0.3s ease;
    }
    .upload-zone:hover i {
        color: #667eea;
    }
    .btn-generate {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 1rem 3rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-generate:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
        color: white;
    }
</style>
@endpush

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="tool-header-card">
                <i class="fas fa-file-image"></i>
                <div class="fw-bold fs-2 text-dark mb-3">HEIC to GIF Converter</div>
                <p class="text-muted fs-5 mb-0">Use our premium tool completely free. No signup required.</p>
            </div>

            <!-- Main Interactive Component -->
            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-body p-4 p-md-5">                    <form id="toolForm" action="{{ url('/api/process/' . $tool['slug']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-zone mb-4" id="dropZone">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h4 class="fw-bold text-dark">Drag & Drop your file here</h4>
                            <p class="text-muted mb-3">Or click to browse from your device</p>
                            <input type="file" name="file" id="fileInput" class="d-none" required>
                            <button type="button" class="btn btn-outline-primary rounded-pill px-4" onclick="document.getElementById('fileInput').click()">Select File</button>
                            <div id="fileDisplay" class="mt-3 text-success fw-bold d-none"></div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-generate" id="generateBtn" style="min-width: 280px; max-width: 100%;">
                                <i class="fas fa-cogs me-2"></i> Process File
                            </button>
                        </div>
                    </form>
                    <!-- Results Area -->
                    <div id="resultsArea" class="mt-5 d-none">
                        <hr class="mb-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Your Results</h3>
                        </div>
                        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                            <i class="fas fa-check-circle fs-4 me-3"></i>
                            <div id="resultMessage">Success!</div>
                        </div>
                        <div class="text-center">
                            <a href="#" id="downloadBtn" class="btn btn-success btn-lg rounded-pill px-5 shadow-sm">
                                <i class="fas fa-download me-2"></i> Download Result
                            </a>
                        </div>
                    </div>

                    <!-- Loader -->
                    <div id="loaderArea" class="mt-5 text-center d-none">
                        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted fw-bold" id="loaderText">Processing...</p>
                    </div>

                </div>
            </div>

            <!-- SEO Content Blocks Wrapper -->
            <!-- The programmatic SEO content will be injected globally by SeoToolController if it wraps this view, 
                 or we output variables here if required. By convention ToolsHub handles SEO block injecting via layouts. -->
            
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('toolForm');
        const btn = document.getElementById('generateBtn');
        const loader = document.getElementById('loaderArea');
        const results = document.getElementById('resultsArea');
        const fileInput = document.getElementById('fileInput');
        
        if(fileInput) {
            fileInput.addEventListener('change', function() {
                if(this.files && this.files[0]) {
                    document.getElementById('fileDisplay').textContent = "Selected: " + this.files[0].name;
                    document.getElementById('fileDisplay').classList.remove('d-none');
                }
            });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            btn.disabled = true;
            loader.classList.remove('d-none');
            results.classList.add('d-none');
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = false;
                loader.classList.add('d-none');
                
                if(data.success) {
                    results.classList.remove('d-none');
                    document.getElementById('resultMessage').textContent = data.message || 'Processing completed!';
                    if(data.download_url) {
                        document.getElementById('downloadBtn').href = data.download_url;
                        document.getElementById('downloadBtn').classList.remove('d-none');
                    } else if (data.results && data.results[0] && data.results[0].download_url) {
                         document.getElementById('downloadBtn').href = data.results[0].download_url;
                         document.getElementById('downloadBtn').classList.remove('d-none');
                    } else {
                        document.getElementById('downloadBtn').classList.add('d-none');
                    }
                } else {
                    alert(data.message || 'An error occurred.');
                }
            })
            .catch(error => {
                console.error(error);
                btn.disabled = false;
                loader.classList.add('d-none');
                alert('Connection error. Please try again.');
            });
        });
    });
</script>
@endpush

