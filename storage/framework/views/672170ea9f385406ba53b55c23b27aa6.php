<div class="temp-mail-container">
    
    <div class="card border-0 shadow-sm mb-4 overflow-hidden" style="border-radius: var(--radius-lg);">
        <div class="card-body p-4 text-center">
            <h5 class="text-secondary mb-3 fw-semibold">Your Temporary Email Address</h5>
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-3">
                <div class="email-box d-flex align-items-center px-4 py-3 bg-light rounded-pill border w-100" style="max-width: 500px;">
                    <i class="fas fa-envelope text-accent me-3"></i>
                    <span id="temp-email-address" class="fw-bold text-primary fs-5 text-truncate">Loading...</span>
                </div>
                <div class="d-flex gap-2">
                    <button id="copy-email-btn" class="btn btn-accent rounded-pill px-4 py-2 fw-semibold shadow-sm">
                        <i class="fas fa-copy me-2"></i> Copy
                    </button>
                    <button id="refresh-email-btn" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">
                        <i class="fas fa-sync-alt me-2" id="refresh-icon"></i> New
                    </button>
                </div>
            </div>
            <p class="mt-3 text-muted small"><i class="fas fa-info-circle me-1"></i> Address expires when you close this session. Auto-refreshing inbox...</p>
        </div>
        <div class="progress" style="height: 4px; border-radius: 0;">
            <div id="polling-progress" class="progress-bar bg-accent" role="progressbar" style="width: 0%; transition: width 3s linear;"></div>
        </div>
    </div>

    
    <div class="inbox-container">
        <div class="d-flex align-items-center justify-content-between mb-3 px-2">
            <h4 class="fw-bold m-0"><i class="fas fa-inbox me-2 text-accent"></i> Your Inbox</h4>
            <span id="inbox-status" class="badge bg-soft-accent text-accent px-3 py-2 rounded-pill">
                <i class="fas fa-circle-notch fa-spin me-2"></i> Checking...
            </span>
        </div>

        <div id="inbox-list" class="list-group shadow-sm" style="border-radius: var(--radius-md); min-height: 200px;">
            <div class="list-group-item text-center py-5 border-0">
                <div class="opacity-50 mb-3">
                    <i class="fas fa-envelope-open fa-3x text-muted"></i>
                </div>
                <h5 class="text-secondary">Your inbox is empty</h5>
                <p class="text-muted small">Send an email to the address above to see it here.</p>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: var(--radius-lg);">
                <div class="modal-header border-bottom-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold" id="msg-subject">Email Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                        <div class="flex-shrink-0">
                            <div class="avatar-circle bg-accent text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="ms-3 flex-grow-1">
                            <div class="fw-bold text-primary" id="msg-sender">Sender Name</div>
                            <div class="text-muted small" id="msg-date">Date Received</div>
                        </div>
                        <div id="otp-highlight" class="d-none">
                            <span class="badge bg-warning text-dark p-2 animate__animated animate__pulse animate__infinite">
                                <i class="fas fa-key me-1"></i> OTP Found: <strong id="otp-code" class="fs-6"></strong>
                            </span>
                        </div>
                    </div>
                    <div id="msg-body" class="email-content-wrapper p-3 border rounded-3 bg-white" style="min-height: 200px; max-height: 500px; overflow-y: auto;">
                        
                    </div>
                </div>
                <div class="modal-footer border-top-0 p-4 pt-0 text-center justify-content-center">
                    <button type="button" class="btn btn-secondary rounded-pill px-5" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-soft-accent { background-color: rgba(255, 106, 0, 0.1); }
    .btn-accent { background: var(--accent-gradient); color: white; border: none; }
    .btn-accent:hover { opacity: 0.9; color: white; }
    .text-accent { color: var(--accent) !important; }
    .inbox-item { cursor: pointer; transition: all 0.2s ease; border-left: 4px solid transparent; }
    .inbox-item:hover { background-color: var(--accent-soft); border-left-color: var(--accent); transform: translateX(5px); }
    .inbox-item.unread { background-color: #fff9f5; font-weight: 600; }
    .email-content-wrapper iframe { width: 100%; border: none; height: auto; min-height: 300px; }
    .email-content-wrapper img { max-width: 100%; height: auto; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentEmail = '';
    let seenMessageIds = new Set();
    let pollingInterval = null;
    let messageModal = new bootstrap.Modal(document.getElementById('messageModal'));

    // Initialize Tool
    initEmail();

    // Event Listeners
    document.getElementById('copy-email-btn').addEventListener('click', copyEmail);
    document.getElementById('refresh-email-btn').addEventListener('click', refreshEmail);

    function initEmail() {
        console.log('Initializing Temp Mail...');
        fetch('<?php echo e(route('tempmail.email')); ?>')
            .then(r => r.json())
            .then(data => {
                console.log('Init Data:', data);
                if (data.success) {
                    currentEmail = data.email;
                    updateUI(currentEmail, data.provider);
                    startPolling();
                }
            });
    }

    function refreshEmail() {
        console.log('Refreshing email...');
        const btn = document.getElementById('refresh-email-btn');
        const icon = document.getElementById('refresh-icon');
        btn.disabled = true;
        icon.classList.add('fa-spin');

        fetch('<?php echo e(route('tempmail.refresh')); ?>', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' }
        })
        .then(r => r.json())
        .then(data => {
            console.log('Refresh Data:', data);
            if (data.success) {
                currentEmail = data.email;
                updateUI(currentEmail, data.provider);
                seenMessageIds.clear();
                checkInbox();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .finally(() => {
            btn.disabled = false;
            icon.classList.remove('fa-spin');
        });
    }

    function updateUI(email, provider) {
        document.getElementById('temp-email-address').textContent = email;
        console.log(`Current Provider: ${provider}`);
    }

    function copyEmail() {
        navigator.clipboard.writeText(currentEmail).then(() => {
            const btn = document.getElementById('copy-email-btn');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            btn.classList.replace('btn-accent', 'btn-success');
            setTimeout(() => {
                btn.innerHTML = originalHtml;
                btn.classList.replace('btn-success', 'btn-accent');
            }, 2000);
        });
    }

    function startPolling() {
        if (pollingInterval) clearInterval(pollingInterval);
        checkInbox();
        
        // Setup progress bar animation
        function resetProgress() {
            const bar = document.getElementById('polling-progress');
            bar.style.transition = 'none';
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.transition = 'width 3s linear';
                bar.style.width = '100%';
            }, 50);
        }

        resetProgress();
        pollingInterval = setInterval(() => {
            checkInbox();
            resetProgress();
        }, 3000);
    }

    function checkInbox() {
        const statusEl = document.getElementById('inbox-status');
        statusEl.innerHTML = '<i class="fas fa-circle-notch fa-spin me-2"></i> Checking...';
        
        console.log('Polling inbox...');
        fetch('<?php echo e(route('tempmail.check')); ?>', { cache: 'no-store' })
            .then(r => r.json())
            .then(data => {
                console.log('Inbox Data:', data);
                if (data.success) {
                    renderInbox(data.emails);
                } else {
                    console.error('Inbox API Error:', data.message);
                }
            })
            .catch(err => {
                console.error('Fetch Error:', err);
                statusEl.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i> Connection Error';
            })
            .finally(() => {
                if (statusEl.innerHTML.includes('Checking')) {
                    statusEl.innerHTML = '<i class="fas fa-check-circle me-2"></i> Live Updating';
                }
            });
    }

    function renderInbox(emails) {
        const container = document.getElementById('inbox-list');
        if (!emails || emails.length === 0) {
            container.innerHTML = `
                <div class="list-group-item text-center py-5 border-0 bg-white">
                    <div class="opacity-50 mb-3"><i class="fas fa-clock fa-3x text-muted"></i></div>
                    <h5 class="text-secondary">Waiting for emails...</h5>
                    <p class="text-muted small">Your inbox will update automatically as soon as an email arrives.</p>
                </div>`;
            return;
        }

        let html = '';
        emails.forEach(email => {
            const isNew = !seenMessageIds.has(email.id);
            if (isNew && seenMessageIds.size > 0) {
                // Play subtle sound or show notification if needed
            }
            seenMessageIds.add(email.id);

            html += `
                <button class="list-group-item list-group-item-action inbox-item p-3 border-bottom ${isNew ? 'unread shadow-sm' : ''}" 
                        onclick="viewMessage(${email.id})">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-accent-soft text-accent rounded-circle me-3 d-flex align-items-center justify-content-center" 
                                 style="width: 38px; height: 38px; flex-shrink: 0;">
                                <i class="fas fa-user-alt small"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-primary fw-bold text-truncate" style="max-width: 250px;">${email.from}</h6>
                                <div class="text-accent small text-truncate" style="max-width: 400px;">${email.subject}</div>
                            </div>
                        </div>
                        <small class="text-muted opacity-75">${email.date.split(' ')[1]}</small>
                    </div>
                </button>
            `;
        });
        container.innerHTML = html;
    }

    window.viewMessage = function(id) {
        console.log(`Loading message ${id}...`);
        const bodyContent = document.getElementById('msg-body');
        bodyContent.innerHTML = '<div class="text-center py-5"><i class="fas fa-circle-notch fa-spin fa-2x text-accent"></i><p class="mt-2">Loading content...</p></div>';
        messageModal.show();

        fetch(`<?php echo e(url('/temp-mail-api/message')); ?>/${id}`)
            .then(r => r.json())
            .then(data => {
                console.log('Message Data:', data);
                if (data.success) {
                    const msg = data.message;
                    document.getElementById('msg-subject').textContent = msg.subject || '(No Subject)';
                    document.getElementById('msg-sender').textContent = msg.from;
                    document.getElementById('msg-date').textContent = msg.date;
                    
                    if (data.otp) {
                        document.getElementById('otp-highlight').classList.remove('d-none');
                        document.getElementById('otp-code').textContent = data.otp;
                    } else {
                        document.getElementById('otp-highlight').classList.add('d-none');
                    }

                    if (msg.htmlBody) {
                        // Use iframe for HTML body to prevent CSS leaking
                        const iframe = document.createElement('iframe');
                        bodyContent.innerHTML = '';
                        bodyContent.appendChild(iframe);
                        const doc = iframe.contentWindow.document;
                        doc.open();
                        doc.write(msg.htmlBody);
                        doc.close();
                        // Adjust iframe height
                        setTimeout(() => {
                            iframe.style.height = doc.body.scrollHeight + 'px';
                        }, 100);
                    } else {
                        bodyContent.innerHTML = `<pre style="white-space: pre-wrap; font-family: inherit;">${msg.textBody}</pre>`;
                    }
                }
            });
    };
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\temp-mail.blade.php ENDPATH**/ ?>