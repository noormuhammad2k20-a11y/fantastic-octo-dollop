<?php
    $fractionSlugs = ['fraction-to-decimal-calculator', 'reduce-fractions-calculator'];
    $isFractionTool = in_array(request()->segment(count(request()->segments())), $fractionSlugs);
?>
<div class="row pro-calculator-app <?php echo e((in_array(($tool['category'] ?? ''), ['medical', 'geometry', 'kitchen']) || $isFractionTool) ? 'stacked-layout' : ''); ?> <?php echo e((request()->segment(count(request()->segments())) === 'spin-the-wheel') ? 'wheel-active' : ''); ?> <?php echo e((request()->segment(count(request()->segments())) === 'coin-flipper') ? 'coin-active' : ''); ?>" id="pro-calculator-container" data-config="<?php echo e(json_encode($tool['pro_config'] ?? $tool['config'] ?? [])); ?>">
    <!-- Left Column: Inputs -->
    <div class="col-lg-12 mb-4">
        <div class="<?php echo e($isFractionTool ? 'roi-style-card' : 'calculator-card'); ?> <?php echo e($isFractionTool ? 'bp-style-card' : ''); ?>">
            

            <div class="calculator-body" id="pro-calculator-inputs">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
                <?php
                    $inputs = $tool['pro_config']['inputs']['basic'] ?? [];
                    $advancedInputs = $tool['pro_config']['inputs']['advanced'] ?? [];
                    $examples = $tool['pro_config']['examples'] ?? [];
                ?>

                <?php if($isFractionTool): ?>
                    <div class="row g-4">
                        <?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <label class="form-label-custom"><?php echo e($input['label']); ?></label>
                                <div class="input-group">
                                    <input type="<?php echo e($input['type'] ?? 'number'); ?>" id="pro-<?php echo e($input['id']); ?>" class="form-control form-control-lg rounded-3" value="<?php echo e($input['default'] ?? ''); ?>" placeholder="<?php echo e($input['placeholder'] ?? ''); ?>">
                                </div>
                                <?php if(!empty($input['help'])): ?>
                                    <span class="text-muted small"><?php echo e($input['help']); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('tools.partials.pro-input', ['input' => $input], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <?php if(count($advancedInputs) > 0): ?>
                    <div class="advanced-options-toggle mt-4 mb-3">
                        <button class="btn btn-sm btn-outline-secondary w-100 fw-bold rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#advancedInputsCollapse" aria-expanded="false" aria-controls="advancedInputsCollapse">
                            <i class="fas fa-sliders-h me-1"></i> Toggle Advanced Settings
                        </button>
                    </div>
                    <div class="collapse" id="advancedInputsCollapse">
                        <div class="p-4 border rounded-3 bg-light mb-3">
                            <div class="row g-3">
                                <?php $__currentLoopData = $advancedInputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label class="form-label-custom"><?php echo e($input['label']); ?></label>
                                        <input type="<?php echo e($input['type'] ?? 'number'); ?>" id="pro-<?php echo e($input['id']); ?>" class="form-control form-control-lg rounded-3" value="<?php echo e($input['default'] ?? ''); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(!empty($tool['pro_config']['button_text'])): ?>
                    <div class="mt-4 d-flex gap-2">
                        <button id="pro-calculate-btn" class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill shadow-sm">
                            <i class="fas fa-bolt me-2"></i> <?php echo e($tool['pro_config']['button_text']); ?>

                        </button>
                        <button type="button" class="btn btn-outline-secondary px-4 fw-bold rounded-pill shadow-sm" onclick="resetCalculator()">
                            <i class="fas fa-undo me-2"></i> Reset
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <?php if(!empty($examples)): ?>
            <div class="calculator-footer border-top bg-light-soft p-3">
                <div class="d-flex align-items-center mb-2">
                    <span class="text-info small fw-bold"><i class="fas fa-magic me-1"></i> Quick Examples:</span>
                </div>
                <div class="quick-examples-row">
                    <?php $__currentLoopData = $examples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button class="btn-example-chip" data-json="<?php echo e(json_encode($ex['values'])); ?>">
                            <?php echo $ex['label']; ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Right Column: Results & Charts -->
    <div class="col-lg-12">
        <div class="result-panel">
            <?php if(request()->segment(count(request()->segments())) === 'spin-the-wheel'): ?>
                <div class="wheel-main-box h-100">
                    <div class="wheel-header-minimal">
                        <h5 class="text-white fw-bold mb-0"><i class="fas fa-dharmachakra me-2 wheel-icon-spin"></i> Interaction Zone</h5>
                    </div>
                    <div class="wheel-stage">
                        <div class="wheel-pointer"></div>
                        <canvas id="main-wheel-canvas" width="500" height="500" style="width: 100%; height: auto;"></canvas>
                        <button id="spin-trigger-btn" class="wheel-center-btn">SPIN</button>
                    </div>
                    <div id="wheel-winner-overlay" class="winner-overlay">
                        <div class="winner-content">
                            <div class="winner-badge">Winner!</div>
                            <h2 id="winner-text">---</h2>
                            <button class="btn btn-primary mt-3" onclick="document.getElementById('wheel-winner-overlay').classList.remove('active')">Dismiss</button>
                        </div>
                    </div>
                </div>
            <?php elseif(request()->segment(count(request()->segments())) === 'coin-flipper'): ?>
                <div class="coin-main-box h-100">
                    <div class="coin-header-minimal">
                        <h5 class="text-white fw-bold mb-0 text-center"><i class="fas fa-coins me-2 text-warning"></i> Interaction Zone</h5>
                    </div>
                    <div class="coin-stage">
                        <div id="coin-3d">
                            <div class="coin-side coin-heads"></div>
                            <div class="coin-side coin-tails"></div>
                        </div>
                    </div>
                    <button id="coin-flip-trigger" class="coin-flip-btn">FLIP</button>
                    <div id="coin-history-log" class="flip-history-row mt-4"></div>
                    <div id="coin-winner-overlay" class="winner-overlay coin-overlay">
                        <div class="winner-content">
                            <div class="winner-badge" style="background: #ffd700; color: #1e1e2e;">Result!</div>
                            <h2 id="coin-winner-text" style="background-image: linear-gradient(135deg, #ffd700, #ffcc00);">Heads</h2>
                            <button class="btn btn-primary mt-3" onclick="document.getElementById('coin-winner-overlay').classList.remove('active')">Dismiss</button>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="<?php echo e($isFractionTool ? 'roi-output-card' : ($isFractionTool ? 'output-card-themed' : 'result-card-v2')); ?>" id="pro-results-container" style="<?php echo e($isFractionTool ? '--tool-hue:150;--tool-color:#10b981;--tool-bg:rgba(16,185,129,0.06);' : ''); ?>">
                    <div id="pro-main-result-card" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="<?php echo e($isFractionTool ? 'output-hero-label' : 'result-label'); ?>" id="pro-main-label">Result</span>
                            <span class="badge bg-light text-dark shadow-sm border" id="scenario-badge" style="display: none;"><i class="fas fa-chart-line"></i> Analysis</span>
                        </div>
                        
                        <?php if($isFractionTool): ?>
                            <div class="output-hero" style="padding: 2rem 0; border-bottom: 2px solid rgba(0,0,0,.04); margin-bottom: 2rem;">
                                <div class="output-hero-value break-words overflow-x-auto" id="pro-main-value" style="font-size: 5rem; font-weight: 900; letter-spacing: -3px;">&nbsp;</div>
                                <span class="output-hero-unit" id="pro-main-unit" style="font-size: 1.8rem; color: #64748b; font-weight: 800;">CALCULATION COMPLETE</span>
                            </div>
                        <?php else: ?>
                            <div class="d-flex align-items-center gap-3">
                                <div class="result-main-value text-accent mb-0 break-words overflow-x-auto flex-grow-1" id="pro-main-value">&nbsp;</div>
                                <button class="btn btn-sm btn-outline-primary px-3 py-2 fw-bold shadow-sm" id="pro-copy-btn" onclick="copyMainResult()" style="white-space: nowrap;">
                                    <i class="far fa-copy me-1"></i> Copy Result
                                </button>
                            </div>
                        <?php endif; ?>
                        
                        <div id="pro-sub-stats" class="<?php echo e($isFractionTool ? 'row g-3 mt-4' : 'result-sub-stats mt-4'); ?>">
                            <!-- Sub stats injected here -->
                        </div>

                        <div class="mt-4">
                            <canvas id="pro-chart" height="200"></canvas>
                        </div>
                    </div>

                    <div id="pro-extra-results" class="mt-5 border-top pt-4" style="display: none;">
                        <div id="pro-visual-result" class="mb-4"></div>
                        <div id="pro-steps-container" class="mb-4" style="display: none;">
                            <h5 class="fw-bold fs-6 text-uppercase text-muted mb-3 <?php echo e($isFractionTool ? 'small letter-spacing-1' : ''); ?>">
                                <i class="fas fa-list-ol me-2 text-info"></i> Calculation Steps
                            </h5>
                            <div id="pro-steps-list" class="<?php echo e($isFractionTool ? 'bg-white shadow-sm border p-4 rounded-3 small text-secondary' : 'bg-light rounded p-3 small font-monospace text-dark border'); ?> break-words overflow-x-auto"></div>
                        </div>
                        <div id="pro-insights-container" style="display: none;" class="<?php echo e($isFractionTool ? 'mt-4 p-4 bg-white rounded-3 border shadow-sm' : ''); ?>">
                            <h5 class="fw-bold fs-6 text-uppercase text-muted mb-3 <?php echo e($isFractionTool ? 'small letter-spacing-1' : ''); ?>">
                                <i class="fas fa-lightbulb me-2 text-warning"></i> <?php echo e($isFractionTool ? 'Mathematical Analysis' : 'Key Insights'); ?>

                            </h5>
                            <div id="pro-insights-list" class="row g-3"></div>
                        </div>
                    </div>

                    <div id="pro-generator-list-container" class="mt-4 pt-4 border-top" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold fs-6 text-uppercase text-muted m-0"><i class="fas fa-list me-2 text-accent"></i> Result Pipeline</h5>
                            <div class="btn-group shadow-sm">
                                <button class="btn btn-sm btn-outline-secondary px-3" onclick="copyAllGeneratorResults()"><i class="far fa-copy me-1"></i> Copy All</button>
                                <?php if(!$isFractionTool): ?>
                                    <button class="btn btn-sm btn-outline-secondary px-3" onclick="downloadGeneratorResults('txt')"><i class="fas fa-download me-1"></i> TXT</button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div id="pro-generator-list" class="bg-light rounded border px-2 py-1" style="max-height: 400px; overflow-y: auto;"></div>
                    </div>

                    <div id="pro-enhanced-output" style="display: none;" class="mt-4 pt-4 border-top">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold fs-6 text-uppercase text-muted m-0"><i class="fas fa-magic me-2 text-accent"></i> Output Experience</h5>
                            <div class="result-actions">
                                <button class="btn btn-sm btn-light border shadow-sm me-1" title="Copy Result" onclick="copyEnhancedOutput()"><i class="far fa-copy"></i></button>
                                <?php if(!$isFractionTool): ?>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-sm btn-light border shadow-sm" type="button" data-bs-toggle="dropdown"><i class="fas fa-download"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#" onclick="downloadEnhanced('txt')">Download .txt</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="downloadEnhanced('json')">Download .json</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="downloadEnhanced('html')">Download .html</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="downloadEnhanced('md')">Download .md</a></li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <ul class="nav nav-pills nav-fill mb-3 pro-output-tabs" id="outputTabs" role="tablist">
                            <li class="nav-item"><button class="nav-link active" id="clean-tab" data-bs-toggle="pill" data-bs-target="#pills-clean" type="button">Clean</button></li>
                            <li class="nav-item"><button class="nav-link" id="raw-tab" data-bs-toggle="pill" data-bs-target="#pills-raw" type="button">Raw</button></li>
                            <li class="nav-item"><button class="nav-link" id="json-tab" data-bs-toggle="pill" data-bs-target="#pills-json" type="button">JSON</button></li>
                            <li class="nav-item"><button class="nav-link" id="diff-tab" data-bs-toggle="pill" data-bs-target="#pills-diff" type="button">Diff</button></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-clean"><div class="output-preview-box bg-light rounded border p-3" id="pro-output-clean"></div></div>
                            <div class="tab-pane fade" id="pills-raw"><pre class="output-raw-box bg-dark text-light rounded p-3 mb-0" id="pro-output-raw" style="font-size: 0.85rem; max-height: 400px; overflow: auto;"></pre></div>
                            <div class="tab-pane fade" id="pills-json"><pre class="output-json-box bg-dark text-info rounded p-3 mb-0" id="pro-output-json" style="font-size: 0.85rem; max-height: 400px; overflow: auto;"></pre></div>
                            <div class="tab-pane fade" id="pills-diff"><div class="output-diff-box border rounded overflow-hidden" id="pro-output-diff"></div></div>
                        </div>
                    </div>

                    <div id="pro-time-app-container" style="display: none;" class="mt-4 pt-4 border-top">
                        <div id="time-app-display" class="mb-4 text-center"></div>
                        <div id="time-app-controls" class="d-flex justify-content-center gap-3 mb-4"></div>
                        <div id="time-app-history" class="bg-light rounded p-3" style="display: none; max-height: 200px; overflow-y: auto;"></div>
                    </div>
                </div>

                <?php if($isFractionTool): ?>
                    <button class="btn d-block mx-auto btn-dark mt-5 py-3 px-5 fw-bold rounded-pill shadow-sm" id="pro-copy-btn-bp" onclick="copyMainResult()" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-copy me-2"></i> Copy Result Report
                    </button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Load MathJax for LaTeX rendering -->
<script>
window.MathJax = {
  tex: {
    inlineMath: [['$', '$'], ['\\(', '\\)']],
    displayMath: [['$$', '$$'], ['\\[', '\\]']],
    processEscapes: true
  },
  options: {
    ignoreHtmlClass: 'tex2jax_ignore',
    processHtmlClass: 'tex2jax_process'
  }
};
</script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo e(asset('js/core-math-engine.js')); ?>?v=<?php echo e(time()); ?>"></script>
<script src="<?php echo e(asset('js/pro-calculator-engine.js')); ?>?v=<?php echo e(time()); ?>"></script>
<?php if(request()->segment(count(request()->segments())) === 'spin-the-wheel'): ?>
<script src="<?php echo e(asset('js/wheel-engine.js')); ?>?v=<?php echo e(time()); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<?php endif; ?>
<?php if(request()->segment(count(request()->segments())) === 'coin-flipper'): ?>
<script src="<?php echo e(asset('js/coin-engine.js')); ?>?v=<?php echo e(time()); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.proEngine = new ProCalculatorEngine('pro-calculator-container');
});
</script>

<style>
.pro-calculator-app { display: grid; grid-template-columns: 8fr 4fr; gap: 2rem; align-items: start; }
.pro-calculator-app.stacked-layout { grid-template-columns: 1fr; max-width: 900px; margin: 0 auto; }
@media (max-width: 1100px) { .pro-calculator-app { grid-template-columns: 1fr; } }

.roi-style-card { background:#fff; border:1px solid #e5e7eb; border-radius:24px; padding:2.5rem; box-shadow:0 8px 48px rgba(16,185,129,.05); }
.roi-style-card .form-label-custom { font-size:.75rem; font-weight:800; color:#1e293b; text-transform:uppercase; letter-spacing:1.2px; margin-bottom:.75rem; display:block; }

.roi-output-card { background: var(--tool-bg, #f8fafc); border: 2px solid color-mix(in srgb, var(--tool-color) 25%, #e5e7eb); border-radius: 24px; padding: 2.5rem; box-shadow: 0 12px 64px rgba(0,0,0,.08); }

.output-hero-label { font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; color: #64748b; }
.output-hero-value { font-size: 3.5rem; font-weight: 900; color: var(--tool-color, #1e293b); line-height: 1; margin: 0.5rem 0; letter-spacing: -2px; }
.output-hero-unit { font-size: 0.9rem; color: #94a3b8; font-weight: 600; }

.stat-card { background: #fff; border: 2.5px solid #f1f5f9; border-radius: 20px; padding: 1.5rem 1.25rem; text-align: center; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); height: 100%; }
.stat-card:hover { transform: translateY(-5px); border-color: inherit; }
.stat-card-label { display: block; font-size: .65rem; font-weight: 900; text-transform: uppercase; color: #94a3b8; letter-spacing: 1.5px; margin-bottom: 8px; }
.stat-card-value { font-size: 2rem; font-weight: 900; display: block; line-height: 1.2; color: #0f172a; }

.result-card-v2 { background: #fff; border-radius: 16px; padding: 2.25rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; }
.result-label { font-size: 0.9rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 1px;}
.result-main-value { font-size: 3rem; font-weight: 800; letter-spacing: -1px; line-height: 1.1; padding: 5px 0; }
.repeating-decimal { text-decoration: overline; color: var(--accent); position: relative; }
.repeating-decimal::after { content: '(repeating)'; font-size: 0.7rem; position: absolute; top: -1.2rem; left: 50%; transform: translateX(-50%); font-weight: 600; text-decoration: none; opacity: 0.7; white-space: nowrap; }
.break-words { word-break: break-all; word-wrap: break-word; overflow-wrap: break-word; }

.result-sub-stats { display: flex; gap: 1.5rem; flex-wrap: wrap; }
@media (max-width: 576px) {
    .output-hero-value { font-size: 2.5rem; }
    .stat-card { padding: 0.75rem 0.5rem; }
    .stat-card-value { font-size: 1.1rem; }
    .result-main-value { font-size: 2.2rem !important; word-break: break-all; }
}
.unit-selector {
    max-width: 90px !important;
    background-color: #f8fafc !important;
    border-left: none !important;
    font-weight: 600;
    color: #475569;
}
.input-group > .form-control:focus + .unit-selector,
.input-group > .form-control:focus ~ .unit-selector {
    border-color: #3b82f6 !important;
    box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25) !important;
}
.pro-steps-list {
    font-size: 0.95rem !important;
    overflow-x: auto;
    word-break: break-word;
}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/tools/pro-calculator.blade.php ENDPATH**/ ?>