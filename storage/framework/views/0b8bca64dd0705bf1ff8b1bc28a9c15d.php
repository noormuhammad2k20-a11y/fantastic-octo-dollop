

<?php $__env->startSection('title', $tool['title']); ?>
<?php $__env->startSection('meta_description', $tool['description'] ?? $tool['subtitle'] ?? ''); ?>
<?php $__env->startSection('canonical', url($page['canonical'] ?? $slug)); ?>

<?php if(in_array($tool['category'] ?? '', ['video', 'audio', 'image'])): ?>
    <?php $__env->startPush('styles'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/media-tools.css')); ?>">
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php $__env->startSection('schema'); ?>
<?php if(!empty($schemaMarkup)): ?>
<script type="application/ld+json">
<?php echo $schemaMarkup; ?>

</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
            <div class="col-12">

                
                <?php
                    $categoryData = config('tools.categories')[$tool['category'] ?? ''] ?? null;
                    $breadcrumbItems = [];
                    if ($categoryData) {
                        $breadcrumbItems[] = [
                            'name' => $categoryData['name'],
                            'url' => url('/' . ($tool['category'] ?? ''))
                        ];
                    }
                    $breadcrumbItems[] = ['name' => $tool['h1']];
                ?>
                <div class="mt-4">
                    <?php echo $__env->make('partials.breadcrumbs', ['items' => $breadcrumbItems], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                
                <div class="tool-page-header text-center py-2" style="margin-bottom: 0.5rem;">
                    <h1 class="fw-black letter-spacing-tight mb-1" style="font-size: clamp(1.2rem, 5vw, 2rem);">
                        <?php echo e($tool['h1'] ?? $tool['title'] ?? 'Tool'); ?>

                    </h1>
                    <p class="subtitle text-secondary fs-7 mx-auto px-3 mb-0" style="max-width: 600px; font-size: 0.85rem;">
                        <?php echo e($tool['description'] ?? $tool['subtitle'] ?? ''); ?>

                    </p>
                </div>

                
                <?php if (isset($component)) { $__componentOriginal43e1d90ca5f26d2b3f1aa3bef8ea2805 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43e1d90ca5f26d2b3f1aa3bef8ea2805 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ad-slot','data' => ['type' => 'top_banner']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ad-slot'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'top_banner']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43e1d90ca5f26d2b3f1aa3bef8ea2805)): ?>
<?php $attributes = $__attributesOriginal43e1d90ca5f26d2b3f1aa3bef8ea2805; ?>
<?php unset($__attributesOriginal43e1d90ca5f26d2b3f1aa3bef8ea2805); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43e1d90ca5f26d2b3f1aa3bef8ea2805)): ?>
<?php $component = $__componentOriginal43e1d90ca5f26d2b3f1aa3bef8ea2805; ?>
<?php unset($__componentOriginal43e1d90ca5f26d2b3f1aa3bef8ea2805); ?>
<?php endif; ?>

                
                <div class="tool-content" id="upload-content">

                    <?php if(in_array(($tool['processor'] ?? ''), ['pro_calculator', 'pro'])): ?>
                        <div class="interactive-tool-container">
                            <?php echo $__env->make('tools.pro-calculator', ['tool' => $tool], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    <?php elseif(($tool['processor'] ?? '') === 'fraction'): ?>
                        <div class="interactive-tool-container">
                            <?php echo $__env->make('tools.fraction-tool', ['tool' => $tool], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    <?php elseif(($tool['type'] ?? '') === 'interactive' || ($tool['processor'] ?? '') === 'interactive'): ?>
                        <div class="interactive-tool-container">
                            <?php if(View::exists('tools.interactive.' . ($tool['slug'] ?? $slug))): ?>
                                <?php echo $__env->make('tools.interactive.' . ($tool['slug'] ?? $slug), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('tools.interactive.generic-text-tool', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                    <?php elseif(in_array($tool['category'] ?? '', ['video', 'audio', 'image'])): ?>
                        <?php echo $__env->make('tools.partials.media_tool_rebuilt', ['tool' => $tool], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php else: ?>
                        
                        <?php echo $__env->make('tools.partials.upload_zone', ['tool' => $tool, 'slug' => $tool['slug']], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        
                        <?php echo $__env->make('tools.partials.progress_result', ['tool' => $tool], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endif; ?>
                </div>

                

                
                <?php echo $__env->make('partials.disclaimers', ['category' => $tool['category'] ?? ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                
                <section class="seo-section">
                    <h2>How to Use <?php echo e($tool['h1']); ?> in 3 Easy Steps</h2>
                    <div class="steps-grid">
                        <?php if(!empty($tool['custom_steps'])): ?>
                            <?php $__currentLoopData = $tool['custom_steps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="step-card">
                                    <div class="step-number"><?php echo e($index + 1); ?></div>
                                    <h4><?php echo e($step['title']); ?></h4>
                                    <p><?php echo e($step['description']); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php elseif(!empty($tool['instructions']) && is_array($tool['instructions'])): ?>
                            <?php $__currentLoopData = array_slice($tool['instructions'], 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="step-card">
                                    <div class="step-number"><?php echo e($index + 1); ?></div>
                                    <h4>Step <?php echo e($index + 1); ?></h4>
                                    <p><?php echo e($step); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php elseif(($tool['type'] ?? '') === 'interactive' || in_array(($tool['processor'] ?? ''), ['pro_calculator', 'pro'])): ?>
                            <div class="step-card">
                                <div class="step-number">1</div>
                                <h4>Enter Your Data</h4>
                                <p>Provide the input values, text, or configuration in the interactive workspace above.</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">2</div>
                                <h4>Real-Time Results</h4>
                                <p>The tool will process your input instantly. You can see the results update as you type.</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">3</div>
                                <h4>Analyze or Copy</h4>
                                <p>Once satisfied with the result, copy the data or analysis directly from the results panel.</p>
                            </div>
                        <?php else: ?>
                            <div class="step-card">
                                <div class="step-number">1</div>
                                <h4>Upload Your File</h4>
                                <p>Drag and drop your file into the upload zone above, or click to browse from your device.</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">2</div>
                                <h4>Configure Options</h4>
                                <p>Adjust the settings based on your needs: quality, format, or dimensions, then click "Process File".</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">3</div>
                                <h4>Download Result</h4>
                                <p>Once processing is complete, check the results and click the "Download" button to save your file.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>


                
                <section class="seo-section" style="padding-top: 0;">
                    <h2>Frequently Asked Questions</h2>
                    <div class="faq-section">
                        <div class="accordion" id="faqAccordion">
                            <?php $__currentLoopData = $tool['faq']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button <?php echo e($index > 0 ? 'collapsed' : ''); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?php echo e($index); ?>">
                                            <?php echo e($item['q'] ?? $item['question'] ?? ''); ?>

                                        </button>
                                    </h2>
                                    <div id="faq<?php echo e($index); ?>" class="accordion-collapse collapse <?php echo e($index === 0 ? 'show' : ''); ?>" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <?php echo e($item['a'] ?? $item['answer'] ?? ''); ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </section>



                
                <section class="seo-section related-tools-section" style="padding-top: 0;">
                    <div class="category-header">
                        <h2>Related <?php echo e($tool['category'] ?? 'Tools'); ?></h2>
                    </div>

                    <div class="row g-2 g-md-3">
                        <?php $__currentLoopData = $relatedTools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relSlug => $relTool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-6 col-md-4 col-lg-3">
                                <a href="<?php echo e(url('/' . $relSlug)); ?>" class="tool-card">
                                    <div class="tool-icon">
                                        <i class="<?php echo e($relTool['icon']); ?>"></i>
                                    </div>
                                    <div class="tool-body">
                                        <h3 class="tool-name"><?php echo e($relTool['h1'] ?? $relTool['title'] ?? 'Tool'); ?></h3>
                                        <p class="tool-desc"><?php echo e($relTool['description'] ?? $relTool['subtitle'] ?? ''); ?></p>
                                    </div>
                                    <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>

                
                <?php echo $__env->make('partials.cross-links', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if(($tool['type'] ?? '') !== 'interactive' && !in_array(($tool['processor'] ?? ''), ['pro_calculator', 'pro', 'media']) && !in_array($tool['category'] ?? '', ['video', 'audio', 'image'])): ?>
    <script src="<?php echo e(asset('js/upload-engine.js')); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const engine = new UploadEngine({
                dropZone: '#upload-zone',
                fileInput: '#file-input',
                processBtn: '#btn-process',
                optionsPanel: '#tool-options',
                progressSection: '#progress-section',
                progressFill: '#progress-fill',
                progressPercent: '#progress-percent',
                statusText: '#status-text',
                resultSection: '#result-section',
                uploadContent: '#upload-content',
                processUrl: "<?php echo e(route('tool.process', $tool['slug'])); ?>",
                slug: '<?php echo e($tool['slug']); ?>',
                acceptedTypes: <?php echo isset($tool['accepted_types']) ? json_encode(array_filter(explode(',', $tool['accepted_types']))) : '[]'; ?>,
                maxSizeMB: <?php echo e($tool['max_size_mb'] ?? 500); ?>,
                supportsBatch: <?php echo e(($tool['supports_batch'] ?? false) ? 'true' : 'false'); ?>,
            });

            
            <?php if(isset($page['default_options'])): ?>
                const targets = <?php echo json_encode($page['default_options']); ?>;
                Object.keys(targets).forEach(key => {
                    const el = document.getElementById('opt-' + key);
                    if (el) {
                        if (el.type === 'range') {
                            el.value = targets[key];
                            const valEl = el.closest('.slider-group').querySelector('.slider-value');
                            if (valEl) valEl.textContent = targets[key] + '%';
                        } else if (el.type === 'checkbox') {
                            el.checked = targets[key];
                        } else {
                            el.value = targets[key];
                        }
                    }
                });
            <?php endif; ?>
        });
    </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<style>
    .professional-seo-content h2 { font-weight: 700; font-size: clamp(1.4rem, 5vw, 2rem); letter-spacing: -0.5px; }
    .professional-seo-content .seo-text-content { font-size: 1.05rem; text-align: justify; }
    @media (max-width: 576px) { .professional-seo-content .seo-text-content { text-align: left; font-size: 1rem; } }
    .text-gradient { background: linear-gradient(135deg, var(--accent) 0%, #ff8c00 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

    /* ── Distributed Highlight Cards (Professional/Clean) ── */
    .seo-highlight-row { margin: 2rem 0; }
    .highlight-card-simple {
        background: var(--card-bg, #f8f9fa);
        border: 1px solid #e9ecef;
        border-left: 4px solid var(--card-border, #6c757d);
        border-radius: 8px;
        padding: 1.25rem 1.5rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .highlight-card-simple:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .hc-icon-static {
        width: 42px; height: 42px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
    }
    .hc-title-clean {
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: 0.25rem;
        color: #1a1a2e;
    }
    .hc-text-clean {
        font-size: 0.95rem;
        line-height: 1.5;
        color: #4b5563;
        margin: 0;
    }
    @media (max-width: 767px) {
        .highlight-card-simple { padding: 1.25rem; }
        .hc-icon-static { width: 36px; height: 36px; font-size: 1rem; }
    }
</style>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\seo_tool.blade.php ENDPATH**/ ?>