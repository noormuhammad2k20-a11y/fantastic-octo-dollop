<?php
    $semanticLinks = \App\Models\InternalLink::from($toolSlug)
        ->active()
        ->byRelevance()
        ->limit(6)
        ->get();
?>

<?php if($semanticLinks->isNotEmpty()): ?>
    <div class="related-tools-section mt-5 mb-4">
        <div class="category-header mb-3">
            <div class="cat-icon" style="background: rgba(79, 70, 229, 0.1); color: var(--accent);">
                <i class="fa-solid fa-link"></i>
            </div>
            <div>
                <h3 class="h5 mb-0 fw-bold" style="color: var(--text-primary);">Related Tools</h3>
                <p class="mb-0 text-muted" style="font-size: 0.85rem;">Frequently used with <?php echo e($tool['name'] ?? 'this tool'); ?></p>
            </div>
        </div>

        <div class="row g-3">
            <?php $__currentLoopData = $semanticLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $targetConfig = $link->target_tool_config;
                    if (!$targetConfig) continue;
                    
                    // Generate correct URL
                    $url = isset($targetConfig['is_pro_calculator']) && $targetConfig['is_pro_calculator']
                        ? route('pro.calculator.show', ['slug' => $link->target_tool_slug])
                        : route('tool.show', ['slug' => $link->target_tool_slug]);
                        
                    // Get random anchor text variation to keep profile natural
                    $anchorText = $link->random_anchor;
                ?>
                <div class="col-md-6 col-lg-4">
                    <a href="<?php echo e($url); ?>" class="tool-card text-decoration-none">
                        <div class="tool-icon">
                            <?php echo $targetConfig['icon'] ?? '<i class="fa-solid fa-wrench"></i>'; ?>

                        </div>
                        <div class="tool-body">
                            <h4 class="tool-name"><?php echo e($anchorText); ?></h4>
                            <p class="tool-desc"><?php echo e(Str::limit($targetConfig['description'] ?? '', 60)); ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/partials/semantic-links.blade.php ENDPATH**/ ?>