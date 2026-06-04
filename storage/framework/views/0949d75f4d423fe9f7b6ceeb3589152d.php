<?php if($seoDraft && $seoDraft->draft_content): ?>
<section class="tool-seo-content" aria-label="About this tool">
    <?php echo $seoDraft->draft_content; ?>

</section>
<?php endif; ?>



<?php
    // v12: Load PAA questions with real answers from semantic_keywords table
    $paaData = \Illuminate\Support\Facades\DB::table('semantic_keywords')
        ->where('tool_slug', $slug)
        ->where('keyword_type', 'paa')
        ->where('is_active', 1)
        ->limit(7)
        ->get(['keyword', 'answer']);

    // Decide data source: use DB answers if available, otherwise fall back to $paaQuestions
    $hasPaaData = $paaData->isNotEmpty();
?>
<?php if($hasPaaData || $paaQuestions->isNotEmpty()): ?>
<section class="seo-section faq-section mt-5" style="padding-top: 0;" aria-label="Frequently asked questions"
         itemscope itemtype="https://schema.org/FAQPage">
    <h2>Frequently Asked Questions</h2>
    <div class="accordion" id="paaAccordion">
        <?php if($hasPaaData): ?>
            
            <?php $__currentLoopData = $paaData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $paa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="accordion-item"
                 itemscope itemprop="mainEntity"
                 itemtype="https://schema.org/Question">
                <h3 class="accordion-header" id="paaH<?php echo e($index); ?>">
                    <button class="accordion-button <?php echo e($index > 0 ? 'collapsed' : ''); ?>"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#paaC<?php echo e($index); ?>"
                            itemprop="name">
                        <?php echo e($paa->keyword); ?>

                    </button>
                </h3>
                <div id="paaC<?php echo e($index); ?>"
                     class="accordion-collapse collapse <?php echo e($index === 0 ? 'show' : ''); ?>"
                     data-bs-parent="#paaAccordion"
                     itemscope itemprop="acceptedAnswer"
                     itemtype="https://schema.org/Answer">
                    <div class="accordion-body" itemprop="text">
                        <?php echo e($paa->answer ?? 'Based on our ' . ($tool['name'] ?? ucwords(str_replace('-', ' ', $slug))) . ' analysis, this depends on your specific inputs. Use the tool above for accurate, personalized results.'); ?>

                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            
            <?php $__currentLoopData = $paaQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="accordion-item"
                 itemscope itemprop="mainEntity"
                 itemtype="https://schema.org/Question">
                <h3 class="accordion-header" id="paaH<?php echo e($index); ?>">
                    <button class="accordion-button <?php echo e($index > 0 ? 'collapsed' : ''); ?>"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#paaC<?php echo e($index); ?>"
                            itemprop="name">
                        <?php echo e($question); ?>

                    </button>
                </h3>
                <div id="paaC<?php echo e($index); ?>"
                     class="accordion-collapse collapse <?php echo e($index === 0 ? 'show' : ''); ?>"
                     data-bs-parent="#paaAccordion"
                     itemscope itemprop="acceptedAnswer"
                     itemtype="https://schema.org/Answer">
                    <div class="accordion-body" itemprop="text">
                        Based on our <?php echo e($tool['name'] ?? ucwords(str_replace('-', ' ', $slug))); ?> analysis, this depends on your specific inputs. Use the tool above for accurate, personalized results.
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>


<?php
    $searchChips = \Illuminate\Support\Facades\DB::table('semantic_keywords')
        ->where('tool_slug', $slug)
        ->whereIn('keyword_type', ['long_tail', 'informational', 'comparison'])
        ->where('is_active', 1)
        ->where('keyword', 'not like', '% calculator')  // exclude tool names
        ->where('keyword', 'not like', '% tool')
        ->where('keyword', 'not like', '% generator')
        ->orderByDesc('confidence_score')
        ->limit(10)
        ->pluck('keyword');
?>

<?php if($searchChips->isNotEmpty()): ?>
<section style="margin-top:1.5rem;padding:1rem 0;">
    <p style="font-size:0.8rem;font-weight:600;color:#6b7280;text-transform:uppercase;
              letter-spacing:.06em;margin:0 0 0.6rem;">Related Searches</p>
    <div style="display:flex;flex-wrap:wrap;gap:0.5rem;">
        <?php $__currentLoopData = $searchChips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span style="display:inline-block;padding:0.3rem 0.75rem;background:#f3f4f6;
                     border:1px solid #e5e7eb;border-radius:20px;font-size:0.82rem;
                     color:#374151;cursor:default;">
            <?php echo e($chip); ?>

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