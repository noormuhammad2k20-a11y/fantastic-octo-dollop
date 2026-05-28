@php
    $fractionSlugs = ['fraction-to-decimal-calculator', 'reduce-fractions-calculator'];
    $isFractionTool = in_array(request()->segment(count(request()->segments())), $fractionSlugs);
@endphp
<div class="row pro-calculator-app {{ (($tool['category'] ?? '') === 'medical' || $isFractionTool) ? 'stacked-layout' : '' }} {{ (request()->segment(count(request()->segments())) === 'spin-the-wheel') ? 'wheel-active' : '' }} {{ (request()->segment(count(request()->segments())) === 'coin-flipper') ? 'coin-active' : '' }}" id="pro-calculator-container" data-config="{{ json_encode($tool['pro_config'] ?? $tool['config'] ?? []) }}">
    <!-- Left Column: Inputs -->
    <div class="col-lg-12 mb-4">
        <div class="calculator-card {{ $isFractionTool ? 'bp-style-card' : '' }}">
            <div class="calculator-header">
                <div class="tool-icon-circle" style="{{ $isFractionTool ? 'background:rgba(37,99,235,0.1);color:#2563eb;width:56px;height:56px;border-radius:14px;' : '' }}">
                    <i class="{{ $tool['icon'] ?? 'fas fa-calculator' }}"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-1" style="{{ $isFractionTool ? 'margin:0;font-weight:800;color:#1e293b;' : 'font-size: 1.15rem;' }}">
                        {{ $tool['h1'] ?? $tool['title'] ?? 'Calculator' }}
                    </h4>
                    <p class="small text-muted mb-0" style="{{ $isFractionTool ? 'margin:0;font-size:.9rem;color:#64748b;' : 'line-height: 1.3;' }}">
                        {{ $tool['subtitle'] ?? $tool['description'] ?? 'Interactive calculation tool' }}
                    </p>
                </div>
            </div>

            <div class="calculator-body">
                @if(!empty($tool['pro_config']['inputs']['basic']))
                    <div class="row g-3">
                        @foreach($tool['pro_config']['inputs']['basic'] as $input)
                            <div class="{{ $isFractionTool ? 'col-md-4' : 'col-md-6' }}">
                                <label class="form-label-custom">{{ $input['label'] }}</label>
                                @if(($input['type'] ?? 'number') === 'select')
                                    <select id="pro-{{ $input['id'] }}" class="form-select form-select-lg rounded-3">
                                        @foreach($input['options'] as $val => $lab)
                                            <option value="{{ $val }}" {{ ($input['default'] ?? '') == $val ? 'selected' : '' }}>{{ $lab }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="{{ $input['type'] ?? 'number' }}" id="pro-{{ $input['id'] }}" class="form-control form-control-lg rounded-3" value="{{ $input['default'] ?? '' }}" placeholder="{{ $input['placeholder'] ?? '' }}">
                                @endif
                                @if(!empty($input['help']))
                                    <span class="text-muted small">{{ $input['help'] }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(!empty($tool['pro_config']['inputs']['advanced']))
                    <div class="section-advanced mt-4" style="display: none;">
                        <h6 class="fw-bold mb-3 text-uppercase small text-muted">Advanced Options</h6>
                        <div class="row g-3">
                            @foreach($tool['pro_config']['inputs']['advanced'] as $input)
                                <div class="col-md-6">
                                    <label class="form-label-custom">{{ $input['label'] }}</label>
                                    <input type="{{ $input['type'] ?? 'number' }}" id="pro-{{ $input['id'] }}" class="form-control form-control-lg rounded-3" value="{{ $input['default'] ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-link btn-sm text-decoration-none p-0 mt-3 btn-toggle-advanced" type="button">
                        <i class="fas fa-cog me-2"></i> Toggle Advanced Settings
                    </button>
                @endif

                @if(!empty($tool['pro_config']['button_text']))
                    <div class="mt-4 d-flex gap-2">
                        <button id="pro-calculate-btn" class="btn btn-primary flex-grow-1 py-3 fw-bold rounded-pill shadow-sm">
                            <i class="fas fa-bolt me-2"></i> {{ $tool['pro_config']['button_text'] }}
                        </button>
                        <button type="button" class="btn btn-outline-secondary px-4 fw-bold rounded-pill shadow-sm" onclick="resetCalculator()">
                            <i class="fas fa-undo me-2"></i> Reset
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column: Results & Charts -->
    <div class="col-lg-12">
        <div class="{{ $isFractionTool ? 'output-card-themed' : 'result-card-v2' }}" id="pro-results-container" style="{{ $isFractionTool ? '--tool-hue:220;--tool-color:#2563eb;--tool-bg:rgba(37,99,235,0.04);' : '' }}">
            <div id="pro-main-result-card" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="{{ $isFractionTool ? 'output-hero-label' : 'result-label' }}" id="pro-main-label">Result</span>
                    <span class="badge bg-light text-dark shadow-sm border" id="scenario-badge" style="display: none;"><i class="fas fa-chart-line"></i> Analysis</span>
                </div>
                
                @if($isFractionTool)
                    <div class="output-hero">
                        <div class="output-hero-value break-words overflow-x-auto" id="pro-main-value" style="font-size: 3.5rem;">&nbsp;</div>
                        <span class="output-hero-unit" id="pro-main-unit">Final Calculation</span>
                    </div>
                @else
                    <div class="d-flex align-items-center gap-3">
                        <div class="result-main-value text-accent mb-0 break-words overflow-x-auto flex-grow-1" id="pro-main-value">&nbsp;</div>
                        <button class="btn btn-sm btn-outline-primary px-3 py-2 fw-bold shadow-sm" id="pro-copy-btn" onclick="copyMainResult()" style="white-space: nowrap;">
                            <i class="far fa-copy me-1"></i> Copy Result
                        </button>
                    </div>
                @endif
                
                <div class="mt-4">
                    <canvas id="pro-chart" height="200"></canvas>
                </div>

                <div id="pro-generator-list-container" class="mt-4 pt-4 border-top" style="display: none;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold fs-6 text-uppercase text-muted m-0"><i class="fas fa-list me-2 text-accent"></i> Result Pipeline</h5>
                        <div class="btn-group shadow-sm">
                            <button class="btn btn-sm btn-outline-secondary px-3" onclick="copyAllGeneratorResults()"><i class="far fa-copy me-1"></i> Copy All</button>
                            @if(!$isFractionTool)
                                <button class="btn btn-sm btn-outline-secondary px-3" onclick="downloadGeneratorResults('txt')"><i class="fas fa-download me-1"></i> TXT</button>
                            @endif
                        </div>
                    </div>
                    <div id="pro-generator-list" class="bg-light rounded border px-2 py-1" style="max-height: 400px; overflow-y: auto;">
                        <!-- Items injected here -->
                    </div>
                </div>

                <!-- Enhanced Output Experience (For Text/Code Tools) -->
                <div id="pro-enhanced-output" style="display: none;" class="mt-4 pt-4 border-top">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold fs-6 text-uppercase text-muted m-0"><i class="fas fa-magic me-2 text-accent"></i> Output Experience</h5>
                        <div class="result-actions">
                            <button class="btn btn-sm btn-light border shadow-sm me-1" title="Copy Result" onclick="copyEnhancedOutput()">
                                <i class="far fa-copy"></i>
                            </button>
                            @if(!$isFractionTool)
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-sm btn-light border shadow-sm" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#" onclick="downloadEnhanced('txt')">Download as .txt</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="downloadEnhanced('json')">Download as .json</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="downloadEnhanced('html')">Download as .html</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="downloadEnhanced('md')">Download as .md</a></li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                    <ul class="nav nav-pills nav-fill mb-3 pro-output-tabs" id="outputTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="clean-tab" data-bs-toggle="pill" data-bs-target="#pills-clean" type="button" role="tab">Clean</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="raw-tab" data-bs-toggle="pill" data-bs-target="#pills-raw" type="button" role="tab">Raw</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="json-tab" data-bs-toggle="pill" data-bs-target="#pills-json" type="button" role="tab">JSON</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="diff-tab" data-bs-toggle="pill" data-bs-target="#pills-diff" type="button" role="tab">Diff</button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-clean" role="tabpanel">
                            <div class="output-preview-box bg-light rounded border p-3" id="pro-output-clean"></div>
                        </div>
                        <div class="tab-pane fade" id="pills-raw" role="tabpanel">
                            <pre class="output-raw-box bg-dark text-light rounded p-3 mb-0" id="pro-output-raw" style="font-size: 0.85rem; max-height: 400px; overflow: auto;"></pre>
                        </div>
                        <div class="tab-pane fade" id="pills-json" role="tabpanel">
                            <pre class="output-json-box bg-dark text-info rounded p-3 mb-0" id="pro-output-json" style="font-size: 0.85rem; max-height: 400px; overflow: auto;"></pre>
                        </div>
                        <div class="tab-pane fade" id="pills-diff" role="tabpanel">
                            <div class="output-diff-box border rounded overflow-hidden" id="pro-output-diff">
                                <!-- Diff content injected here -->
                            </div>
                        </div>
                    </div>
                </div>
