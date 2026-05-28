
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'banner', 'class' => '']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['type' => 'banner', 'class' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(config('ads.enabled')): ?>
    <div class="ad-slot-container <?php echo e($class); ?> my-4 text-center">
        
        <!-- [AdSense Placeholder: <?php echo e($type); ?>] -->
        <div class="ad-placeholder-inner" style="min-height: 90px; background: rgba(0,0,0,0.02); border-radius: 8px;">
            
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\components\ad-slot.blade.php ENDPATH**/ ?>