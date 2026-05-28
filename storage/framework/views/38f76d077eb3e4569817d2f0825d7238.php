<?php $__env->startSection('title', 'Stress Test - Multiple Interactive Tools'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Cross-Tool Stress Test</h1>
        <p class="lead text-secondary">Validating DOM/CSS/JS isolation across multiple interactive calculators.</p>
    </div>

    <div class="row g-5">
        <div class="col-lg-6">
            <h3 class="mb-4">Tool 1: Jupiter Sign</h3>
            <?php echo $__env->make('tools.interactive.jupiter-sign-calculator', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        
        <div class="col-lg-6">
            <h3 class="mb-4">Tool 2: Saturn Sign</h3>
            <?php echo $__env->make('tools.interactive.saturn-sign-calculator', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="col-lg-6">
            <h3 class="mb-4">Tool 3: Lucky Number Finder</h3>
            <?php echo $__env->make('tools.interactive.lucky-number-finder', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="col-lg-6">
            <h3 class="mb-4">Tool 4: Personality Number</h3>
            <?php echo $__env->make('tools.interactive.personality-number-calculator', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\stress-test.blade.php ENDPATH**/ ?>