

<?php $__env->startSection('title', $tool['title']); ?>
<?php $__env->startSection('meta_description', $tool['description'] ?? $tool['subtitle'] ?? ''); ?>

<?php $__env->startSection('schema'); ?>
    <script type="application/ld+json">
        <?php echo $schemaMarkup; ?>

    </script>
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
                    $breadcrumbItems[] = ['name' => $tool['h1'] ?? ($tool['title'] ?? 'Tool')];
                ?>
                <div class="mt-4">
                    <?php echo $__env->make('partials.breadcrumbs', ['items' => $breadcrumbItems], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                
                <div class="tool-page-header text-center py-4" style="margin-bottom: 1.5rem;">
                    <h1 class="fw-black letter-spacing-tight mb-2">
                        <?php echo e($tool['h1'] ?? ($tool['title'] ?? ($tool['name'] ?? 'Tool'))); ?>

                    </h1>
                    <p class="subtitle text-secondary fs-5 opacity-75 mx-auto" style="max-width: 700px;">
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
                    <?php elseif(($tool['type'] ?? '') === 'interactive' || ($tool['processor'] ?? '') === 'interactive'): ?>
                        <div class="interactive-tool-container">
                            <?php if(View::exists('tools.interactive.' . ($tool['slug'] ?? $slug))): ?>
                                <?php echo $__env->make('tools.interactive.' . ($tool['slug'] ?? $slug), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('tools.interactive.generic-text-tool', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        
                        <?php echo $__env->make('tools.partials.upload_zone', ['tool' => $tool, 'slug' => $slug], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endif; ?>

                    <?php if(($tool['type'] ?? '') !== 'interactive' && ($tool['processor'] ?? '') !== 'interactive' && ($tool['processor'] ?? '') !== 'pro_calculator'): ?>
                        
                        <?php echo $__env->make('tools.partials.progress_result', ['tool' => $tool], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endif; ?>
                </div>

                

                
                <?php echo $__env->make('partials.disclaimers', ['category' => $tool['category'] ?? ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                
                <section class="seo-section">
                    <h2>How to Use This Tool in 3 Steps</h2>
                    <div class="steps-grid">
                        <?php if(!empty($tool['custom_steps'])): ?>
                            <?php $__currentLoopData = $tool['custom_steps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="step-card">
                                    <div class="step-number"><?php echo e($index + 1); ?></div>
                                    <h4><?php echo e($step['title']); ?></h4>
                                    <p><?php echo e($step['description']); ?></p>
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

                
                <?php echo $__env->yieldContent('seo_content'); ?>

                
                <?php if(!View::hasSection('seo_content')): ?>
                    <?php echo $__env->make('tools.partials.seo_content', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>


                
                <?php echo $__env->yieldContent('faq_content'); ?>

                
                <?php if(!View::hasSection('faq_content')): ?>
                <section class="seo-section" style="padding-top: 0;">
                    <h2>Frequently Asked Questions</h2>
                    <div class="faq-section">
                        <div class="accordion" id="faqAccordion">
                            <?php if(!empty($tool['custom_faq'])): ?>
                                <?php $__currentLoopData = $tool['custom_faq']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button <?php echo e($index > 0 ? 'collapsed' : ''); ?>" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#customFaq<?php echo e($index); ?>">
                                                <?php echo e($faq['q']); ?>

                                            </button>
                                        </h2>
                                        <div id="customFaq<?php echo e($index); ?>" class="accordion-collapse collapse <?php echo e($index === 0 ? 'show' : ''); ?>" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <?php echo $faq['a']; ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq1">
                                            Is this tool really free?
                                        </button>
                                    </h2>
                                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Yes! All tools on ToolsHub are 100% free to use. There are no hidden costs, no
                                            subscriptions, and no signup required. You can process unlimited files.
                                        </div>
                                    </div>
                                </div>
                                <?php if(($tool['type'] ?? '') !== 'interactive'): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq2">
                                            Are my files secure?
                                        </button>
                                    </h2>
                                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Absolutely. Your files are processed on our secure servers and automatically deleted
                                            after you download the result. We never store, share, or access your file contents.
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($tool['max_size_mb'])): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq3">
                                            What is the maximum file size?
                                        </button>
                                    </h2>
                                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            The maximum file size for this tool is <?php echo e($tool['max_size_mb']); ?>MB. If you need to
                                            process larger files, please contact our support team.
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq4">
                                            Do I need to create an account?
                                        </button>
                                    </h2>
                                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            No. ToolsHub does not require any registration or login. 
                                            <?php echo e(($tool['type'] ?? '') === 'interactive' ? 'Simply use the tool' : 'Simply upload your file, process it,'); ?> 
                                            and get your result. It's that simple.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq5">
                                            Which browsers are supported?
                                        </button>
                                    </h2>
                                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            ToolsHub works on all modern browsers including Google Chrome, Firefox, Safari,
                                            Microsoft Edge, and Opera. It also works perfectly on mobile browsers.
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <?php endif; ?>

                
                <?php echo $__env->yieldContent('related_tools'); ?>
                
                
                <?php if(!View::hasSection('related_tools')): ?>
                <section class="seo-section related-tools-section" style="padding-top: 0;">
                    <div class="category-header">
                    
                        <div>
                            <h2>Related Tools</h2>
                        </div>
                    </div>

                    <div class="row g-3">
                        <?php
                            // Inject slug into the array to preserve it after shuffle() which loses keys
                            $toolsWithSlugs = collect($tools)->map(function($item, $key) {
                                $item['slug'] = $key;
                                return $item;
                            });
                            $related = $toolsWithSlugs->where('category', $tool['category'] ?? 'General')->except($slug)->shuffle()->take(12);
                        ?>
                        <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relTool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <a href="<?php echo e(url('/' . $relTool['slug'])); ?>" class="tool-card h-100">
                                    <div class="tool-icon">
                                        <i class="<?php echo e($relTool['icon'] ?? 'fas fa-tools'); ?>"></i>
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
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if( ($tool['type'] ?? '') !== 'interactive' && !in_array(($tool['processor'] ?? ''), ['pro_calculator', 'pro']) ): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new UploadEngine({
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
                processUrl: "<?php echo e(route('tool.process', $slug)); ?>",
                slug: '<?php echo e($slug); ?>',
                processor: '<?php echo e($tool['processor'] ?? 'utility'); ?>',
                acceptedTypes: <?php echo json_encode(array_filter(explode(',', $tool['accepted_types'] ?? ''))); ?>,
                maxSizeMB: <?php echo e($tool['max_size_mb'] ?? 10); ?>,
                supportsBatch: <?php echo e(($tool['supports_batch'] ?? false) ? 'true' : 'false'); ?>,
            });
        });
    </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/tool.blade.php ENDPATH**/ ?>