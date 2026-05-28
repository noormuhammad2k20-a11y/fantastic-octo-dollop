<?php
    $items = $items ?? [];
?>

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb mb-0 py-2 px-3 bg-light rounded-pill d-flex flex-wrap border"
        itemscope itemtype="https://schema.org/BreadcrumbList">
        <li class="breadcrumb-item"
            itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="<?php echo e(route('home')); ?>" class="text-decoration-none text-secondary" itemprop="item">
                <i class="fas fa-home me-1"></i>
                <span itemprop="name">Home</span>
            </a>
            <meta itemprop="position" content="1" />
        </li>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($loop->last): ?>
                <li class="breadcrumb-item active text-primary fw-bold" aria-current="page"
                    itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php echo e($item['name']); ?></span>
                    <meta itemprop="position" content="<?php echo e($i + 2); ?>" />
                </li>
            <?php else: ?>
                <li class="breadcrumb-item"
                    itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo e($item['url']); ?>" class="text-decoration-none text-secondary" itemprop="item">
                        <span itemprop="name"><?php echo e($item['name']); ?></span>
                    </a>
                    <meta itemprop="position" content="<?php echo e($i + 2); ?>" />
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
</nav>

<style>
    .breadcrumb-item + .breadcrumb-item::before { content: "\f105"; font-family: "Font Awesome 6 Free"; font-weight: 900; color: #6c757d; font-size: 0.8rem; vertical-align: middle; }
    .breadcrumb-item.active { color: var(--accent) !important; }
    .breadcrumb { font-size: 0.85rem; }
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\partials\breadcrumbs.blade.php ENDPATH**/ ?>