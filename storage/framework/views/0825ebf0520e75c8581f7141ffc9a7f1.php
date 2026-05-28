
<?php
    $crossLinker = new \App\Services\CrossLinkerService();
    $crossLinks = cache()->remember(
        'cross_links_' . ($tool['slug'] ?? 'unknown'),
        86400,
        fn() => $crossLinker->getCrossLinks($tool, 3)
    );
?>

<?php if($crossLinks->isNotEmpty()): ?>
<aside class="cross-links-section" aria-label="You might also need">
    <div class="container">
        <h3 class="cross-links-title">
            <i class="fas fa-compass"></i>
            You Might Also Need
        </h3>
        <div class="cross-links-grid">
            <?php $__currentLoopData = $crossLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clSlug => $cl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(url('/' . ($cl['slug'] ?? $clSlug))); ?>" class="cross-link-card" title="<?php echo e($cl['name'] ?? $cl['h1'] ?? 'Tool'); ?>">
                    <span class="cross-link-icon">
                        <i class="<?php echo e($cl['icon'] ?? 'fas fa-calculator'); ?>"></i>
                    </span>
                    <span class="cross-link-info">
                        <span class="cross-link-name"><?php echo e($cl['h1'] ?? $cl['name'] ?? 'Tool'); ?></span>
                        <span class="cross-link-cat">
                            <?php echo e(config('tools.categories.' . ($cl['category'] ?? '') . '.name', 'Tools')); ?>

                        </span>
                    </span>
                    <span class="cross-link-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</aside>
<?php endif; ?>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\partials\cross-links.blade.php ENDPATH**/ ?>