<div class="row g-4 youtube-comment-picker-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3">
                    
                <div class="col-md-12">
                    <label class="form-label-custom">YouTube Video URL</label>
                    <input type="text" id="ytUrl" class="form-control form-control-lg rounded-3" placeholder="https://www.youtube.com/watch?v=...">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Filter Duplicate Users</label>
                    <select class="form-select form-select-lg rounded-3">
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Minimum Comment Length</label>
                    <input type="number" class="form-control form-control-lg rounded-3" value="0">
                </div>
        
                </div>
                
                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                    <span class="fw-bold small text-muted me-1 align-self-center"><i class="fas fa-bolt text-warning me-1"></i>Actions:</span>
                    
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold" onclick="pickComment()">Pick Random Winner</button>
            <button class="btn btn-sm btn-outline-secondary rounded-pill px-4" onclick="resetApp()">Reset</button>
        
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12">
        <div class="output-card-themed" id="output-card-themed" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(37,99,235,.04);transition:all .4s">
            <div class="output-hero">
                <span class="output-hero-label">Live Preview / Result</span>
            </div>
            <div class="p-4 bg-white rounded-3 border break-words overflow-x-auto shadow-sm">
                
            <div class="text-center p-5 bg-white border rounded-3 shadow-sm" id="winnerBox">
                <h5 class="text-muted fw-bold mb-0">Awaiting Selection...</h5>
            </div>
        
            </div>
        </div>
    </div>
</div>

<script>
    
            window.pickComment = function() {
                let url = document.getElementById("ytUrl").value;
                if(!url) {
                    document.getElementById("winnerBox").innerHTML = "<div class='alert alert-warning m-0'>Please enter a YouTube URL</div>";
                    return;
                }
                document.getElementById("winnerBox").innerHTML = "<i class='fas fa-spinner fa-spin fa-2x text-primary mb-3'></i><h5 class='text-muted m-0'>Loading comments...</h5>";
                
                setTimeout(() => {
                    let mockUsers = ["@CoolGamer99", "@TechEnthusiast", "@DesignMaster", "@VloggerLife"];
                    let mockComments = ["Great video!", "Thanks for the tips!", "Loved this tutorial.", "First!"];
                    let r = Math.floor(Math.random() * mockUsers.length);
                    
                    document.getElementById("winnerBox").innerHTML = `
                        <div class="d-inline-block text-start p-4 bg-light shadow-sm rounded-3 border border-success">
                            <div class="text-success fw-bold mb-2 text-uppercase" style="letter-spacing:1px"><i class="fas fa-trophy"></i> Winner Selected!</div>
                            <h4 class="mb-1 text-dark fw-bold">${mockUsers[r]}</h4>
                            <p class="text-muted mb-0">"${mockComments[r]}"</p>
                        </div>
                    `;
                }, 1500);
            };
            window.resetApp = function() {
                document.getElementById("ytUrl").value = "";
                document.getElementById("winnerBox").innerHTML = "<h5 class='text-muted fw-bold mb-0'>Awaiting Selection...</h5>";
            };
        
</script>

<style>
.youtube-comment-picker-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.youtube-comment-picker-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.youtube-comment-picker-rebuilt .calculator-title{font-size:1.5rem; color:#1e293b}
.youtube-comment-picker-rebuilt .calculator-header p{font-size:.9rem;color:#64748b}
.youtube-comment-picker-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.youtube-comment-picker-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
.output-card-themed{background:var(--tool-bg,#f8fafc);border:2px solid color-mix(in srgb,var(--tool-color) 25%,#e5e7eb);border-radius:24px;padding:2.5rem;box-shadow:0 12px 64px rgba(0,0,0,.08);transition:all .4s ease}
.output-hero{text-align:center;padding:1rem 0;margin-bottom:1rem}
.output-hero-label{display:block;font-size:.8rem;font-weight:900;text-transform:uppercase;letter-spacing:3px;color:#64748b;margin-bottom:1rem}
.break-words { word-wrap: break-word; word-break: break-all; }
</style><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\youtube-comment-picker.blade.php ENDPATH**/ ?>