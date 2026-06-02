<?php if($seoDraft && $seoDraft->draft_content): ?>
<section class="tool-seo-content" aria-label="About this tool">
    <?php echo $seoDraft->draft_content; ?>

</section>
<?php endif; ?>

<?php if($relatedTools->isNotEmpty()): ?>
<section class="seo-section related-tools-section mt-5" style="padding-top: 0;" aria-label="Related tools">
    <div class="category-header">
        <div>
            <h2>Related Tools You Might Need</h2>
        </div>
    </div>
    <div class="row g-3">
        <?php $__currentLoopData = $relatedTools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                // Find the tool definition from config/tools.php to get icon/description
                // We assume $tools array is available in the view (passed from controller)
                $relToolConfig = $tools[$rt->tool_slug] ?? null;
            ?>
            <?php if($relToolConfig): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <a href="<?php echo e(url('/' . $rt->tool_slug)); ?>" class="tool-card h-100" title="<?php echo e($rt->anchor_text_primary); ?>">
                    <div class="tool-icon">
                        <i class="<?php echo e($relToolConfig['icon'] ?? 'fas fa-tools'); ?>"></i>
                    </div>
                    <div class="tool-body">
                        <h3 class="tool-name"><?php echo e($rt->anchor_text_primary); ?></h3>
                        <p class="tool-desc"><?php echo e(mb_strimwidth($relToolConfig['description'] ?? $relToolConfig['subtitle'] ?? '', 0, 80, '...')); ?></p>
                    </div>
                    <span class="tool-arrow">Use tool <i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php endif; ?>

<?php if($paaQuestions->isNotEmpty()): ?>
<section class="seo-section faq-section mt-5" style="padding-top: 0;" aria-label="Frequently asked questions"
         itemscope itemtype="https://schema.org/FAQPage">
    <h2>Frequently Asked Questions</h2>
    <div class="accordion" id="paaAccordion">
        <?php $__currentLoopData = $paaQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h3 class="accordion-header" itemprop="name" id="paaHeading<?php echo e($index); ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#paaCollapse<?php echo e($index); ?>" aria-expanded="false" aria-controls="paaCollapse<?php echo e($index); ?>">
                    <?php echo e($question); ?>

                </button>
            </h3>
            <div id="paaCollapse<?php echo e($index); ?>" class="accordion-collapse collapse" aria-labelledby="paaHeading<?php echo e($index); ?>" data-bs-parent="#paaAccordion" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <div class="accordion-body" itemprop="text">
                    See our detailed guide above for the complete answer regarding this topic.
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php endif; ?>


<?php if(isset($longTailTerms) && $longTailTerms->isNotEmpty()): ?>
<section class="seo-section related-searches-section mt-4" style="padding:1rem 0;">
    <h3 style="font-size:0.9rem;font-weight:600;color:#666;text-transform:uppercase;letter-spacing:.05em;">
        Related Searches
    </h3>
    <div class="d-flex flex-wrap gap-2 mt-2">
        <?php $__currentLoopData = $longTailTerms->merge($relatedTerms ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span class="badge bg-light text-dark border" style="font-weight:400;font-size:0.82rem;padding:0.35rem 0.7rem;">
            <?php echo e($term); ?>

        </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php endif; ?>


<?php if(isset($entityTerms) && $entityTerms->isNotEmpty()): ?>
<section class="seo-section entity-section mt-3" style="padding:0.5rem 0;">
    <meta itemprop="about" content="<?php echo e($entityTerms->implode(', ')); ?>">
</section>
<?php endif; ?>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/partials/tool-seo-content.blade.php ENDPATH**/ ?>