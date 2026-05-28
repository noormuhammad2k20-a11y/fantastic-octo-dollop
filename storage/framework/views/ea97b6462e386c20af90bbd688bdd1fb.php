<?php $__env->startSection('title', $categoryName . ' Tools — ' . count($categoryTools) . '+ Free Online ' . $categoryName . ' | ToolsHub'); ?>
<?php $__env->startSection('meta_description', 'Access ' . count($categoryTools) . '+ free ' . strtolower($categoryName) . ' tools online. Professional-grade calculators and converters. No signup, no install required. Fast and accurate results.'); ?>

<?php $__env->startSection('schema'); ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "CollectionPage",
            "name": "<?php echo e($categoryName); ?> Tools",
            "description": "<?php echo e($category['description'] ?? 'Explore our complete collection of high-performance ' . strtolower($categoryName) . ' tools.'); ?>",
            "url": "<?php echo e(url()->current()); ?>",
            "numberOfItems": <?php echo e(count($categoryTools)); ?>,
            "isPartOf": {
                "@type": "WebSite",
                "name": "<?php echo e(config('seo.site_name', 'ToolsHub')); ?>",
                "url": "<?php echo e(url('/')); ?>"
            }
        },
        {
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "<?php echo e(url('/')); ?>"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "<?php echo e($categoryName); ?> Tools",
                    "item": "<?php echo e(url()->current()); ?>"
                }
            ]
        }
    ]
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="hero-section" style="padding: 60px 0 40px;">
        <div class="container text-center">
            <div class="d-flex justify-content-center align-items-center flex-column">

                
                <div class="mb-3 w-100">
                    <?php echo $__env->make('partials.breadcrumbs', ['items' => [['name' => $categoryName . ' Tools']]], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <h1 class="mb-3"><?php echo e($categoryName); ?> Tools</h1>
                <p class="lead" style="max-width: 600px; margin: 0 auto;">
                    <?php echo e($category['description'] ?? 'Explore our complete collection of high-performance tools in this category.'); ?>

                </p>
                <div class="mt-4">
                    <span class="badge bg-white text-primary border px-3 py-2 fs-6 shadow-sm rounded-pill"><?php echo e(count($categoryTools)); ?> Tools Available</span>
                </div>
            </div>
        </div>
    </section>

    
    <section class="category-section bg-light py-5">
        <div class="container">
            <div class="row">
                
                
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <h3 class="m-0 fw-bold" id="grid-title">All Tools</h3>
                            <button id="open-all-tools" class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm border-0 d-flex align-items-center" style="transition: all 0.3s ease; height: 32px;">
                                <i class="fas fa-external-link-alt me-2" style="font-size: 0.8rem;"></i>
                                <span class="fw-medium">Open All</span>
                            </button>
                        </div>
                        
                        
                        <div class="input-group shadow-sm rounded-pill flex-grow-1 flex-sm-grow-0" style="max-width: 100%; width: auto; min-width: 250px; overflow: hidden;">
                            <span class="input-group-text bg-white border-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" class="form-control border-0 bg-white" id="category-search" placeholder="Search <?php echo e(strtolower($categoryName)); ?>...">
                        </div>
                    </div>

                    <div class="row g-3" id="category-tools-grid">
                        <?php if(empty($categoryTools)): ?>
                            <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
                                <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                                <h5>No tools found</h5>
                                <p class="text-muted">Check back later or adjust your search.</p>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $categoryTools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 cat-tool-item" data-name="<?php echo e(strtolower($tool['h1'] ?? $tool['name'] ?? '')); ?> <?php echo e(strtolower($tool['description'] ?? '')); ?>">
                                    <a href="<?php echo e(url('/' . $key)); ?>" class="tool-card">
                                        <div class="tool-icon">
                                            <i class="<?php echo e($tool['icon'] ?? 'fas fa-tools'); ?>"></i>
                                        </div>
                                        <div class="tool-body">
                                            <h3 class="tool-name"><?php echo e($tool['h1'] ?? $tool['name'] ?? 'Tool'); ?></h3>
                                            <p class="tool-desc"><?php echo e($tool['description'] ?? ''); ?></p>
                                        </div>
                                        <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div id="cat-no-results" class="col-12 text-center py-5 bg-white rounded-4 shadow-sm d-none">
                                <i class="fas fa-search-minus fa-3x text-muted mb-3"></i>
                                <h5>No tools match your search</h5>
                                <p class="text-muted">Try a different keyword.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="seo-section">
        <div class="container">
            <h2>How <?php echo e($categoryName); ?> Tools Help You</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-bolt"></i></div>
                    <div>
                        <h5>Instant Results</h5>
                        <p>All <?php echo e(count($categoryTools)); ?> <?php echo e(strtolower($categoryName)); ?> tools deliver real-time calculations and conversions. No waiting, no delays.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <h5>100% Free & Secure</h5>
                        <p>Every tool is completely free with no registration required. Your data is processed securely and never stored.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="f-icon"><i class="fas fa-mobile-alt"></i></div>
                    <div>
                        <h5>Works Everywhere</h5>
                        <p>Use these tools on any device — desktop, tablet, or mobile. Fully responsive and optimized for all screen sizes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <?php echo $__env->make('partials.disclaimers', ['category' => $slug], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('category-search');
            const items = document.querySelectorAll('.cat-tool-item');
            const noResults = document.getElementById('cat-no-results');
            
            if(searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const query = e.target.value.toLowerCase().trim();
                    let matchCount = 0;

                    items.forEach(item => {
                        const searchKey = item.getAttribute('data-name') || '';
                        if (searchKey.includes(query)) {
                            item.classList.remove('d-none');
                            matchCount++;
                        } else {
                            item.classList.add('d-none');
                        }
                    });

                    if (matchCount === 0 && items.length > 0) {
                        noResults.classList.remove('d-none');
                    } else if (noResults) {
                        noResults.classList.add('d-none');
                    }
                });
            }

            // Simple Tab Interaction for Sidebar
            const tabs = document.querySelectorAll('#sub-category-tabs .nav-link');
            const gridTitle = document.getElementById('grid-title');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active from all
                    tabs.forEach(t => t.classList.remove('active'));
                    tabs.forEach(t => t.classList.add('text-muted'));
                    
                    // Add active to current
                    this.classList.add('active');
                    this.classList.remove('text-muted');
                    
                    const filter = this.getAttribute('data-filter');
                    
                    if (filter === 'all') {
                        gridTitle.innerText = 'All <?php echo e($categoryName); ?>';
                        // In reality, this would filter by subcategory.
                        // For now we just reset search to show visually something happening.
                        if(searchInput) {
                            searchInput.value = '';
                            searchInput.dispatchEvent(new Event('input'));
                        }
                    } else {
                        gridTitle.innerText = this.innerText.trim() + ' <?php echo e($categoryName); ?>';
                        // Placeholder behavior for future Sub-category logic...
                    }
                });
            });

            // Open All Tools Feature
            const openAllBtn = document.getElementById('open-all-tools');
            if(openAllBtn) {
                openAllBtn.addEventListener('click', function() {
                    const visibleTools = Array.from(document.querySelectorAll('.cat-tool-item:not(.d-none) a.tool-card'));
                    if (visibleTools.length === 0) return;
                    
                    if (confirm(`Open all ${visibleTools.length} ${visibleTools.length === 1 ? 'tool' : 'tools'} in separate tabs?\n\nNote: Your browser may block multiple popups. If it does, please select "Always allow popups" in the address bar.`)) {
                        visibleTools.forEach((link, index) => {
                            setTimeout(() => {
                                window.open(link.href, '_blank');
                            }, index * 200); // 200ms delay helps browsers manage the sudden load
                        });
                    }
                });
            }
        });
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/category.blade.php ENDPATH**/ ?>