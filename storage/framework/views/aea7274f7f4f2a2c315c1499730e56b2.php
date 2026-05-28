<?php $tool = (array)$tool; ?>


<div class="upload-zone-wrapper">
    <div class="upload-zone" id="upload-zone">
        <div class="upload-icon">
            <i class="fas fa-cloud-upload-alt"></i>
        </div>
        <h3>Drag & Drop Your <?php echo e(($tool['supports_batch'] ?? false) ? 'Files' : 'File'); ?> Here</h3>
        <p>or <span class="browse-link">browse files</span> from your device</p>
        <p class="file-info">
            <i class="fas fa-info-circle"></i>
            Accepted:
            <?php
                $types = $tool['accepted_types'] ?? '';
                if (is_array($types)) $types = implode(', ', $types);
            ?>
            <?php echo e(strtoupper(str_replace(['image/', 'video/', 'application/', ','], ['', '', '', ', '], $types))); ?>

            <?php if(isset($tool['max_size_mb'])): ?>
                &bull; Max <?php echo e($tool['max_size_mb']); ?>MB
            <?php endif; ?>
        </p>

        
        <div class="selected-file">
            <div class="file-icon"><i class="<?php echo e($tool['icon'] ?? 'fas fa-file'); ?>"></i></div>
            <div class="file-details">
                <div class="name">filename.jpg</div>
                <div class="size">2.4 MB</div>
            </div>
            <button type="button" class="remove-file" title="Remove file">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    
    <input type="file" id="file-input" accept="<?php echo e($tool['accepted_types'] ?? '*'); ?>" <?php echo e(($tool['supports_batch'] ?? false) ? 'multiple' : ''); ?> hidden>

    
    <?php
        $hasUioptions = false;
        if (isset($tool['options']) && is_array($tool['options'])) {
            foreach($tool['options'] as $opt) {
                if (is_array($opt) && isset($opt['name'], $opt['type'])) {
                    $hasUioptions = true;
                    break;
                }
            }
        }
    ?>

    <?php if($hasUioptions): ?>
    <div class="tool-options-container" id="tool-options">
        <div class="options-card">
            <h4><i class="fas fa-sliders-h"></i> Configuration Options</h4>
            <div class="options-grid">
                <?php $__currentLoopData = $tool['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(is_array($option) && isset($option['name'], $option['type'])): ?>
                    <div class="option-group">
                        <label for="opt-<?php echo e($option['name']); ?>"><?php echo e($option['label'] ?? $option['name']); ?></label>

                        <?php if($option['type'] === 'select'): ?>
                            <select name="<?php echo e($option['name']); ?>" id="opt-<?php echo e($option['name']); ?>">
                                <?php $__currentLoopData = $option['choices'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val); ?>" <?php echo e(($option['default'] ?? '') == $val ? 'selected' : ''); ?>>
                                        <?php echo e($lbl); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        <?php elseif($option['type'] === 'slider'): ?>
                            <div class="slider-group">
                                <div class="slider-info">
                                    <span class="slider-value"><?php echo e($option['default'] ?? 0); ?>%</span>
                                </div>
                                <input type="range" 
                                    name="<?php echo e($option['name']); ?>" 
                                    class="option-slider" 
                                    id="opt-<?php echo e($option['name']); ?>"
                                    min="<?php echo e($option['min'] ?? 0); ?>" 
                                    max="<?php echo e($option['max'] ?? 100); ?>" 
                                    step="<?php echo e($option['step'] ?? 1); ?>"
                                    value="<?php echo e($option['default'] ?? 50); ?>"
                                    data-default="<?php echo e($option['default'] ?? 50); ?>">
                            </div>

                        <?php elseif($option['type'] === 'number'): ?>
                            <input type="number" 
                                name="<?php echo e($option['name']); ?>" 
                                id="opt-<?php echo e($option['name']); ?>"
                                value="<?php echo e($option['default'] ?? ''); ?>"
                                min="<?php echo e($option['min'] ?? ''); ?>" 
                                max="<?php echo e($option['max'] ?? ''); ?>">

                        <?php elseif($option['type'] === 'checkbox'): ?>
                            <div class="checkbox-group">
                                <input type="checkbox" 
                                    name="<?php echo e($option['name']); ?>" 
                                    id="opt-<?php echo e($option['name']); ?>" 
                                    <?php echo e(($option['default'] ?? false) ? 'checked' : ''); ?>>
                                <label for="opt-<?php echo e($option['name']); ?>"><?php echo e($option['label'] ?? $option['name']); ?></label>
                            </div>

                        <?php elseif($option['type'] === 'text'): ?>
                            <input type="text" 
                                name="<?php echo e($option['name']); ?>" 
                                id="opt-<?php echo e($option['name']); ?>"
                                value="<?php echo e($option['default'] ?? ''); ?>"
                                placeholder="<?php echo e($option['placeholder'] ?? ''); ?>">
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div id="tool-options" style="display:none;"></div>
    <?php endif; ?>

    
    <div class="text-center">
        <button class="btn-accent btn-accent-lg btn-process" id="btn-process">
            <i class="fas fa-cog"></i> Process File
        </button>
    </div>
</div>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\partials\upload_zone.blade.php ENDPATH**/ ?>