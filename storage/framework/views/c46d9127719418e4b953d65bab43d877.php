<?php
    $inputId = $input['id'] ?? uniqid('input_');
    $inputLabel = $input['label'] ?? $input['name'] ?? \Illuminate\Support\Str::title(str_replace(['_', '-'], ' ', $inputId));
    $inputType = $input['type'] ?? 'text';
    // Fix: Fallback for select default boolean casting
    $inputDefault = $input['default'] ?? $input['value'] ?? '';
?>

<div class="form-group-custom mb-4 position-relative">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <label class="form-label-custom mb-0" for="pro-<?php echo e($inputId); ?>"><?php echo e($inputLabel); ?></label>
        <div class="input-quick-actions" data-target="pro-<?php echo e($inputId); ?>">
            <?php if($inputType !== 'select' && $inputType !== 'checkbox' && $inputType !== 'toggle'): ?>
                <button type="button" class="btn-action-icon btn-copy-paste" title="Paste from Clipboard" data-action="paste"><i class="fas fa-paste"></i></button>
            <?php endif; ?>
            <?php if($inputType === 'number' || $inputType === 'slider'): ?>
                <button type="button" class="btn-action-icon btn-random" title="Generate Random Value" data-action="random"><i class="fas fa-random"></i></button>
            <?php endif; ?>
            <?php if($inputType !== 'select'): ?>
                <button type="button" class="btn-action-icon btn-reset" title="Reset Field" data-action="reset"><i class="fas fa-undo"></i></button>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="input-wrapper-refined">
        <?php if($inputType === 'select'): ?>
            <select id="pro-<?php echo e($inputId); ?>" class="form-select form-select-custom" data-id="<?php echo e($inputId); ?>">
                <?php $__currentLoopData = $input['options'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $optVal = is_array($option) ? ($option['value'] ?? $val) : $val;
                        $optLabel = is_array($option) ? ($option['label'] ?? $option) : $option;
                    ?>
                    <option value="<?php echo e($optVal); ?>" <?php echo e($inputDefault == $optVal ? 'selected' : ''); ?>><?php echo e($optLabel); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

        <?php elseif($inputType === 'checkbox' || $inputType === 'toggle'): ?>
            <div class="form-check form-switch custom-switch-lg p-3 border rounded bg-white shadow-sm">
                <input class="form-check-input ms-0 me-2" type="checkbox" id="pro-<?php echo e($inputId); ?>" data-id="<?php echo e($inputId); ?>" <?php echo e($inputDefault ? 'checked' : ''); ?>>
                <span class="text-secondary small fw-bold text-uppercase"><?php echo e($input['description'] ?? 'Enable this option'); ?></span>
            </div>

        <?php elseif($inputType === 'textarea'): ?>
            <textarea id="pro-<?php echo e($inputId); ?>" class="form-control form-control-custom" placeholder="<?php echo e($input['placeholder'] ?? 'Enter data here...'); ?>" data-id="<?php echo e($inputId); ?>" rows="4"><?php echo e($inputDefault); ?></textarea>

        <?php elseif($inputType === 'slider'): ?>
            <div class="range-slider-container p-2 border rounded bg-white shadow-sm">
                <input type="range" 
                       id="pro-<?php echo e($inputId); ?>" 
                       class="form-range range-slider-custom w-100" 
                       value="<?php echo e(empty($inputDefault) ? '0' : $inputDefault); ?>"
                       data-id="<?php echo e($inputId); ?>"
                       <?php if(isset($input['min'])): ?> min="<?php echo e($input['min']); ?>" <?php endif; ?>
                       <?php if(isset($input['max'])): ?> max="<?php echo e($input['max']); ?>" <?php endif; ?>
                       <?php if(isset($input['step'])): ?> step="<?php echo e($input['step']); ?>" <?php endif; ?>
                       oninput="document.getElementById('display-<?php echo e($inputId); ?>').textContent = this.value">
                <div class="range-value-display ms-2" id="display-<?php echo e($inputId); ?>"><?php echo e(empty($inputDefault) ? '0' : $inputDefault); ?></div>
            </div>

        <?php else: ?>
            <?php if(!empty($input['unit'])): ?>
                <div class="input-group">
                    <input type="<?php echo e($inputType); ?>" 
                           id="pro-<?php echo e($inputId); ?>" 
                           class="form-control form-control-custom" 
                           placeholder="<?php echo e($input['placeholder'] ?? ''); ?>"
                           value="<?php echo e($inputDefault); ?>"
                           data-id="<?php echo e($inputId); ?>"
                           <?php if($inputType === 'number' && isset($input['min'])): ?> min="<?php echo e($input['min']); ?>" <?php endif; ?>
                           <?php if($inputType === 'number' && isset($input['max'])): ?> max="<?php echo e($input['max']); ?>" <?php endif; ?>
                           <?php if($inputType === 'number' && isset($input['step'])): ?> step="<?php echo e($input['step']); ?>" <?php endif; ?>>
                    <select class="form-select unit-selector" id="pro-<?php echo e($inputId); ?>-unit" data-id="<?php echo e($inputId); ?>_unit">
                        <option value="mm">mm</option>
                        <option value="cm" selected>cm</option>
                        <option value="m">m</option>
                        <option value="in">in</option>
                        <option value="ft">ft</option>
                        <option value="yd">yd</option>
                    </select>
                </div>
            <?php else: ?>
                <input type="<?php echo e($inputType); ?>" 
                       id="pro-<?php echo e($inputId); ?>" 
                       class="form-control form-control-custom" 
                       placeholder="<?php echo e($input['placeholder'] ?? ''); ?>"
                       value="<?php echo e($inputDefault); ?>"
                       data-id="<?php echo e($inputId); ?>"
                       <?php if($inputType === 'number' && isset($input['min'])): ?> min="<?php echo e($input['min']); ?>" <?php endif; ?>
                       <?php if($inputType === 'number' && isset($input['max'])): ?> max="<?php echo e($input['max']); ?>" <?php endif; ?>
                       <?php if($inputType === 'number' && isset($input['step'])): ?> step="<?php echo e($input['step']); ?>" <?php endif; ?>>
            <?php endif; ?>
        <?php endif; ?>
        
        <div id="pro-hint-<?php echo e($inputId); ?>" class="input-guided-hint small text-muted mt-2 d-flex align-items-center" style="min-height: 1.5rem;">
            <!-- Hints injected via JS -->
        </div>

        <?php if(!empty($input['quick_actions'])): ?>
            <div class="input-specific-chips d-flex flex-wrap gap-2 mt-2">
                <?php $__currentLoopData = $input['quick_actions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" class="btn-input-chip" data-target="pro-<?php echo e($inputId); ?>" data-value="<?php echo e($chip['value'] ?? ''); ?>">
                        <?php echo e($chip['label'] ?? ''); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\partials\pro-input.blade.php ENDPATH**/ ?>