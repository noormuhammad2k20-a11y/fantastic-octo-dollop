<?php $__env->startSection('title', $category['name'] . ' — Free Online ' . $category['name']); ?>
<?php $__env->startSection('meta_description', $category['description'] . '. Fast, secure, and 100% free online tools.'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="hero-section" style="padding: 60px 0;">
        <div class="container text-center">
            <div class="cat-icon <?php echo e($category['color'] ?? 'convert'); ?> mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 20px; color: white;">
                <i class="<?php echo e($category['icon']); ?>"></i>
            </div>
            <h1><?php echo e($category['name']); ?></h1>
            <p class="lead"><?php echo e($category['description']); ?></p>
        </div>
    </section>

    
    <section class="category-section" style="padding-top: 0;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="m-0 fw-bold">Available Tools</h3>
                <button id="open-all-tools" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm border-0 d-flex align-items-center" style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); transition: all 0.3s ease; height: 32px;">
                    <i class="fas fa-external-link-alt me-2" style="font-size: 0.8rem;"></i>
                    <span class="fw-medium">Open All</span>
                </button>
            </div>
            <div class="row g-4">
                <?php $__currentLoopData = $categoryTools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toolSlug => $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="<?php echo e(url('/' . $toolSlug)); ?>" class="tool-card">
                            <div class="tool-icon">
                                <i class="<?php echo e($tool['icon']); ?>"></i>
                            </div>
                            <div class="tool-body">
                                <h3 class="tool-name"><?php echo e($tool['h1']); ?></h3>
                                <p class="tool-desc"><?php echo e($tool['description']); ?></p>
                            </div>
                            <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    <section class="seo-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>Professional Grade <?php echo e($category['name']); ?></h2>
                    <p>Our tools are designed to provide high-quality results without the complexity of professional software. Whether you're converting, compressing, or editing, we’ve got you covered.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Always free, no signup required</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> High-speed cloud processing</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Secure & Private: Files deleted hourly</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="features-grid" style="grid-template-columns: 1fr;">
                        <div class="feature-item">
                            <div class="f-icon"><i class="fas fa-shield-alt"></i></div>
                            <div>
                                <h5>Privacy First</h5>
                                <p>We value your privacy. All uploaded files are processed securely and purged automatically from our servers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openAllBtn = document.getElementById('open-all-tools');
        if(openAllBtn) {
            openAllBtn.addEventListener('click', function() {
                const links = Array.from(document.querySelectorAll('.tool-card'));
                if (links.length === 0) return;
                
                if (confirm(`Open all ${links.length} ${links.length === 1 ? 'tool' : 'tools'} in separate tabs?\n\nNote: Your browser may block multiple popups.`)) {
                    links.forEach((link, index) => {
                        setTimeout(() => {
                            window.open(link.href, '_blank');
                        }, index * 200);
                    });
                }
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\category.blade.php ENDPATH**/ ?>