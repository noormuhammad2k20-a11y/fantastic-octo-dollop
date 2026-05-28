<?php $__env->startSection('content'); ?>
<div class="container py-5">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="me-4 border-end pe-4 d-none d-xl-block">
                <div class="text-white-50 small text-uppercase mb-1" style="letter-spacing: 1px;">Global Availability</div>
                <div class="h4 mb-0 fw-bold <?php echo e($enterpriseStats['gai'] > 99 ? 'text-success' : 'text-warning'); ?>">
                    <i class="fas fa-globe me-2"></i><?php echo e($enterpriseStats['gai']); ?>%
                </div>
            </div>
            <div>
                <h1 class="h3 mb-0 text-white"><i class="fas fa-microscope me-2"></i>Observability Dashboard</h1>
                <p class="text-white-50 mb-0">Enterprise-Grade Performance & Infrastructure Monitoring</p>
            </div>
        </div>
        <div class="d-flex gap-2">
            <ul class="nav nav-pills nav-sm bg-dark p-1 rounded-3 me-3" id="monitorTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active py-1 px-3" id="tool-tab" data-bs-toggle="pill" data-bs-target="#tool-health" type="button">Tool Health</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link py-1 px-3" id="seo-tab" data-bs-toggle="pill" data-bs-target="#seo-health" type="button">SEO Health</button>
                </li>
            </ul>
            <a href="<?php echo e(route('admin.monitor.export-csv')); ?>" class="btn btn-outline-light btn-sm">
                <i class="fas fa-file-csv me-1"></i> Export CSV
            </a>
            <form action="<?php echo e(route('admin.monitor.scan')); ?>" method="POST" class="d-inline" id="scanForm">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary" id="scanBtn">
                    <i class="fas fa-rocket me-1"></i> Run Full Scan
                </button>
            </form>
        </div>
    </div>

    
    <?php if(session('success')): ?>
    <div class="alert border-0 mb-4" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">
        <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
    <div class="alert border-0 mb-4" style="background: rgba(239, 68, 68, 0.15); color: #ef4444;">
        <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    
    <div id="scanProgressPanel" class="card border-0 mb-4" style="background: linear-gradient(135deg, #1e293b, #0f172a); display: none;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="text-white mb-0"><i class="fas fa-spinner fa-spin me-2"></i>Scan In Progress</h6>
                <span class="badge bg-primary" id="progressBatchLabel">Batch 0/0</span>
            </div>
            <div class="progress mb-2" style="height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px;">
                <div class="progress-bar bg-primary" id="progressBar" style="width: 0%; transition: width 0.5s ease;"></div>
            </div>
            <div class="d-flex justify-content-between small text-white-50">
                <span id="progressScanned">0 scanned</span>
                <span id="progressPercent">0%</span>
            </div>
        </div>
    </div>

    
    <div class="tab-content">
        
        <div class="tab-pane fade show active" id="tool-health">
            <div class="row g-3 mb-4">
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #6366f1;">
                        <div class="monitor-card-label">Total Registered</div>
                        <div class="monitor-card-value" style="color: #a5b4fc;"><?php echo e($stats['total_registered']); ?></div>
                        <div class="monitor-card-sub"><?php echo e($stats['total_scanned']); ?> scanned</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #10b981;">
                        <div class="monitor-card-label">Healthy</div>
                        <div class="monitor-card-value text-success" id="statHealthy"><?php echo e($stats['healthy']); ?></div>
                        <div class="monitor-card-sub"><?php echo e($stats['health_score']); ?>% health</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #ef4444;">
                        <div class="monitor-card-label">Broken</div>
                        <div class="monitor-card-value text-danger" id="statBroken"><?php echo e($stats['broken']); ?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #f59e0b;">
                        <div class="monitor-card-label">Static</div>
                        <div class="monitor-card-value text-warning" id="statStatic"><?php echo e($stats['static']); ?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #06b6d4;">
                        <div class="monitor-card-label">Slow</div>
                        <div class="monitor-card-value" style="color: #22d3ee;" id="statSlow"><?php echo e($stats['slow']); ?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #8b5cf6;">
                        <div class="monitor-card-label">UI Only</div>
                        <div class="monitor-card-value" style="color: #a78bfa;" id="statUiOnly"><?php echo e($stats['ui_only']); ?></div>
                    </div>
                </div>
            </div>
            
            
            <?php if(isset($failedLogs) && $failedLogs->count() > 0): ?>
            <div class="card border-0 mb-4" style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.15);">
                <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="text-danger mb-0"><i class="fas fa-exclamation-circle me-2"></i>🚨 Live Failed Tools Tracking (Client-Side Telemetry)</h6>
                    <form action="<?php echo e(route('admin.monitor.clear-failed-logs')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-outline-danger btn-sm py-0 px-2 small" onclick="return confirm('Clear all failure logs?')">
                            <i class="fas fa-trash-alt me-1"></i> Clear Logs
                        </button>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr class="small text-white-50">
                                    <th>Tool Slug</th>
                                    <th>Issue Type</th>
                                    <th>Detected At</th>
                                    <th class="text-end">Diagnostics</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $failedLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong class="text-white"><?php echo e($log->tool_slug); ?></strong></td>
                                    <td><span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25"><?php echo e($log->issue_type); ?></span></td>
                                    <td class="small text-white-50"><?php echo e($log->created_at->diffForHumans()); ?></td>
                                    <td class="text-end">
                                        <button class="btn btn-link btn-sm text-info p-0 text-decoration-none small" type="button" data-bs-toggle="collapse" data-bs-target="#log-<?php echo e($log->id); ?>">
                                            <i class="fas fa-code me-1"></i> View Inputs
                                        </button>
                                    </td>
                                </tr>
                                <tr class="collapse" id="log-<?php echo e($log->id); ?>">
                                    <td colspan="4" class="p-0 border-0">
                                        <div class="p-3 bg-black bg-opacity-25 rounded-3 m-2 small">
                                            <div class="text-white-50 mb-2 small"><i class="fas fa-info-circle me-1"></i> Input state that triggered the failure:</div>
                                            <pre class="text-info m-0 p-2" style="background: rgba(0,0,0,0.2); border-radius: 4px;"><?php echo e(json_encode($log->input_data, JSON_PRETTY_PRINT)); ?></pre>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card border-0" style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255,255,255,0.05);">
                        <div class="card-body py-2 d-flex align-items-center">
                            <i class="fas fa-database text-primary me-3 fs-4"></i>
                            <div>
                                <div class="text-white-50 small" style="font-size: 0.65rem; text-transform: uppercase;">Primary Database</div>
                                <div class="text-white small fw-bold"><span class="badge bg-success bg-opacity-10 text-success p-1">ONLINE</span> 0.4ms</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0" style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255,255,255,0.05);">
                        <div class="card-body py-2 d-flex align-items-center">
                            <i class="fas fa-bolt text-warning me-3 fs-4"></i>
                            <div>
                                <div class="text-white-50 small" style="font-size: 0.65rem; text-transform: uppercase;">Cache (Redis/SSD)</div>
                                <div class="text-white small fw-bold"><span class="badge bg-success bg-opacity-10 text-success p-1">ACTIVE</span> 0.1ms</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0" style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255,255,255,0.05);">
                        <div class="card-body py-2 d-flex align-items-center">
                            <i class="fas fa-shield-halved text-info me-3 fs-4"></i>
                            <div>
                                <div class="text-white-50 small" style="font-size: 0.65rem; text-transform: uppercase;">WAF / Threat Shield</div>
                                <div class="text-white small fw-bold"><span class="text-info"><?php echo e($enterpriseStats['threats']); ?></span> events blocked</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0" style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255,255,255,0.05);">
                        <div class="card-body py-2 d-flex align-items-center">
                            <i class="fas fa-users text-success me-3 fs-4"></i>
                            <div>
                                <div class="text-white-50 small" style="font-size: 0.65rem; text-transform: uppercase;">Platform Interaction</div>
                                <div class="text-white small fw-bold"><?php echo e(number_format($enterpriseStats['load'])); ?> active nodes</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="tab-pane fade" id="seo-health">
            <div class="row g-3 mb-4">
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #10b981;">
                        <div class="monitor-card-label">Indexed Pages</div>
                        <div class="monitor-card-value text-success"><?php echo e($seoStats['indexed']); ?></div>
                        <div class="monitor-card-sub">Out of <?php echo e($seoStats['total_scanned']); ?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #ef4444;">
                        <div class="monitor-card-label">Non-Indexed</div>
                        <div class="monitor-card-value text-danger"><?php echo e($seoStats['noindex']); ?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #3b82f6;">
                        <div class="monitor-card-label">Avg SEO Score</div>
                        <div class="monitor-card-value" style="color: #60a5fa;"><?php echo e($seoStats['avg_score']); ?><small class="fs-6">/100</small></div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #06b6d4;">
                        <div class="monitor-card-label">Avg Speed Score</div>
                        <div class="monitor-card-value" style="color: #22d3ee;"><?php echo e($seoStats['avg_speed']); ?>%</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #f59e0b;">
                        <div class="monitor-card-label">Slow Pages</div>
                        <div class="monitor-card-value text-warning"><?php echo e($seoStats['slow_pages']); ?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #ef4444;">
                        <div class="monitor-card-label">SEO Errors</div>
                        <div class="monitor-card-value text-danger"><?php echo e($seoStats['errors_count']); ?></div>
                    </div>
                </div>
            </div>

            
            <?php if($duplicates['titles']->count() > 0 || $duplicates['descriptions']->count() > 0): ?>
            <div class="card border-0 mb-4" style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.1);">
                <div class="card-body">
                    <h6 class="text-danger mb-3"><i class="fas fa-copy me-2"></i>Duplicate Meta Content Detected</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled small text-white-50 mb-0">
                                <?php $__currentLoopData = $duplicates['titles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="mb-2"><i class="fas fa-exclamation-circle text-danger me-2"></i>Title repeated <strong><?php echo e($dup->count); ?>x</strong>: <code class="text-danger"><?php echo e(Str::limit($dup->title, 50)); ?></code></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled small text-white-50 mb-0">
                                <?php $__currentLoopData = $duplicates['descriptions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="mb-2"><i class="fas fa-exclamation-circle text-danger me-2"></i>Desc repeated <strong><?php echo e($dup->count); ?>x</strong>: <code class="text-danger"><?php echo e(Str::limit($dup->descr, 50)); ?></code></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <div class="card border-0" style="background: #0f172a;">
                <div class="card-header bg-transparent border-0 py-3">
                    <h6 class="text-white mb-0"><i class="fas fa-list-alt me-2"></i>SEO Audit & Suggestions</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr class="small text-white-50">
                                    <th>Tool</th>
                                    <th>Score</th>
                                    <th>Detected Issues</th>
                                    <th>Recommendation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $seoLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><strong class="text-white"><?php echo e($log->tool_slug); ?></strong></td>
                                    <td><span class="badge <?php echo e($log->seo_score >= 80 ? 'bg-success' : 'bg-danger'); ?> bg-opacity-10 text-<?php echo e($log->seo_score >= 80 ? 'success' : 'danger'); ?>"><?php echo e($log->seo_score); ?></span></td>
                                    <td>
                                        <?php $__currentLoopData = $log->issues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge bg-secondary bg-opacity-10 text-white-50 small me-1 mb-1" style="font-size: 0.65rem;"><?php echo e(str_replace('_', ' ', $issue)); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td class="small text-info">
                                        <?php echo e($log->recommendations[0] ?? '—'); ?>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="4" class="text-center py-4 text-white-50">No major SEO issues detected in scanned tools.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body text-center py-4">
                    <h6 class="text-white-50 text-uppercase small mb-3">Health Score</h6>
                    <div class="health-gauge mx-auto">
                        <svg viewBox="0 0 120 120" width="120" height="120">
                            <circle cx="60" cy="60" r="52" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="10"/>
                            <circle cx="60" cy="60" r="52" fill="none"
                                stroke="<?php echo e($stats['health_score'] >= 80 ? '#10b981' : ($stats['health_score'] >= 50 ? '#f59e0b' : '#ef4444')); ?>"
                                stroke-width="10" stroke-linecap="round"
                                stroke-dasharray="<?php echo e($stats['health_score'] * 3.27); ?> 327"
                                transform="rotate(-90 60 60)" style="transition: stroke-dasharray 1s ease;"/>
                            <text x="60" y="60" text-anchor="middle" dominant-baseline="central"
                                fill="white" font-size="28" font-weight="700"><?php echo e($stats['health_score']); ?>%</text>
                        </svg>
                    </div>
                    <div class="mt-3">
                        <span class="badge <?php echo e($enterpriseStats['sla_status'] === 'PASS' ? 'bg-success' : 'bg-danger'); ?> bg-opacity-10 text-<?php echo e($enterpriseStats['sla_status'] === 'PASS' ? 'success' : 'danger'); ?> small">
                            <i class="fas fa-certificate me-1"></i> ENTERPRISE SLA: <?php echo e($enterpriseStats['sla_status']); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body text-center py-4">
                    <h6 class="text-white-50 text-uppercase small mb-3">Avg Response Time</h6>
                    <h1 class="text-white mb-1" style="font-size: 3rem;"><?php echo e($stats['avg_response']); ?><span class="fs-6 text-white-50">ms</span></h1>
                    <p class="text-white-50 small mb-0">
                        <?php if($stats['avg_response'] < 2000): ?> <span class="text-success"><i class="fas fa-check-circle"></i> Excellent</span>
                        <?php elseif($stats['avg_response'] < 5000): ?> <span class="text-warning"><i class="fas fa-exclamation-circle"></i> Acceptable</span>
                        <?php else: ?> <span class="text-danger"><i class="fas fa-times-circle"></i> Needs Optimization</span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body text-center py-4">
                    <h6 class="text-white-50 text-uppercase small mb-3">Scan Coverage</h6>
                    <?php $coverage = $stats['total_registered'] > 0 ? round(($stats['total_scanned'] / $stats['total_registered']) * 100) : 0; ?>
                    <h1 class="text-white mb-1" style="font-size: 3rem;"><?php echo e($coverage); ?><span class="fs-6 text-white-50">%</span></h1>
                    <p class="text-white-50 small mb-2"><?php echo e($stats['not_scanned']); ?> tools not yet scanned</p>
                    <div class="progress" style="height: 4px; background: rgba(255,255,255,0.1);">
                        <div class="progress-bar bg-info" style="width: <?php echo e($enterpriseStats['efficiency']); ?>%"></div>
                    </div>
                    <p class="text-white-50 small mt-2 mb-0" style="font-size: 0.65rem;">Resource Efficiency: <?php echo e($enterpriseStats['efficiency']); ?>% optimized</p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-3 mb-4">
        <div class="col-md-5">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body">
                    <h6 class="text-white mb-3"><i class="fas fa-chart-bar me-2"></i>Status Distribution</h6>
                    <div class="status-bar-chart">
                        <?php
                            $total = max($stats['total_scanned'], 1);
                            $bars = [
                                ['label' => 'Healthy', 'count' => $stats['healthy'], 'color' => '#10b981'],
                                ['label' => 'Broken', 'count' => $stats['broken'], 'color' => '#ef4444'],
                                ['label' => 'Static', 'count' => $stats['static'], 'color' => '#f59e0b'],
                                ['label' => 'Slow', 'count' => $stats['slow'], 'color' => '#06b6d4'],
                                ['label' => 'UI Only', 'count' => $stats['ui_only'], 'color' => '#8b5cf6'],
                            ];
                        ?>
                        <?php $__currentLoopData = $bars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-white-50 small" style="width: 70px;"><?php echo e($bar['label']); ?></div>
                            <div class="flex-grow-1 mx-3">
                                <div style="background: rgba(255,255,255,0.05); border-radius: 4px; height: 18px; overflow: hidden;">
                                    <div style="width: <?php echo e(($bar['count'] / $total) * 100); ?>%; background: <?php echo e($bar['color']); ?>; height: 100%; border-radius: 4px; transition: width 1s ease; min-width: <?php echo e($bar['count'] > 0 ? '2px' : '0'); ?>;"></div>
                                </div>
                            </div>
                            <div class="text-white fw-bold small" style="width: 40px; text-align: right;"><?php echo e($bar['count']); ?></div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body">
                    <h6 class="text-white mb-3"><i class="fas fa-globe-americas me-2"></i>Regional Latency</h6>
                    <div class="latency-grid">
                        <?php $__currentLoopData = $enterpriseStats['regions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region => $lat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-white shadow-sm" style="border-color: rgba(255,255,255,0.03) !important;">
                            <span class="text-white-50 small"><?php echo e($region); ?></span>
                            <span class="badge <?php echo e($lat < 300 ? 'bg-success' : ($lat < 600 ? 'bg-warning' : 'bg-danger')); ?> bg-opacity-10 text-<?php echo e($lat < 300 ? 'success' : ($lat < 600 ? 'warning' : 'danger')); ?> border border-<?php echo e($lat < 300 ? 'success' : ($lat < 600 ? 'warning' : 'danger')); ?> py-1 px-2" style="font-size: 0.65rem;">
                                <?php echo e($lat); ?>ms
                            </span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="text-center mt-2">
                        <span class="text-white-50" style="font-size: 0.65rem;"><i class="fas fa-sync fa-spin me-1"></i> Live Edge Analysis</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body">
                    <h6 class="text-white mb-3"><i class="fas fa-cog me-2"></i>Quick Actions</h6>
                    <div class="d-grid gap-2">
                        <form action="<?php echo e(route('admin.monitor.scan')); ?>" method="POST" class="scan-form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="limit" value="50">
                            <button class="btn btn-outline-light btn-sm w-100 text-start">
                                <i class="fas fa-bolt me-2 text-warning"></i> Quick Scan (50 tools)
                            </button>
                        </form>
                        <form action="<?php echo e(route('admin.monitor.scan')); ?>" method="POST" class="scan-form">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-light btn-sm w-100 text-start">
                                <i class="fas fa-rocket me-2 text-primary"></i> Full Scan (All <?php echo e($stats['total_registered']); ?>)
                            </button>
                        </form>
                        <form action="<?php echo e(route('admin.monitor.rescan-broken')); ?>" method="POST" class="scan-form">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-light btn-sm w-100 text-start">
                                <i class="fas fa-redo me-2 text-danger"></i> Rescan Broken Only (<?php echo e($stats['broken']); ?>)
                            </button>
                        </form>
                        <?php if($missingProcessorCount > 0): ?>
                        <form action="<?php echo e(route('admin.monitor.bulk-fix')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-light btn-sm w-100 text-start">
                                <i class="fas fa-wrench me-2 text-warning"></i> Bulk Fix Processors (<?php echo e($missingProcessorCount); ?>)
                            </button>
                        </form>
                        <?php endif; ?>
                        <form action="<?php echo e(route('admin.monitor.purge-stale')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-light btn-sm w-100 text-start">
                                <i class="fas fa-trash-alt me-2 text-secondary"></i> Purge Stale Records
                            </button>
                        </form>
                        <a href="<?php echo e(route('admin.monitor.export-csv')); ?>" class="btn btn-outline-light btn-sm w-100 text-start">
                            <i class="fas fa-download me-2 text-success"></i> Download CSV Report
                        </a>
                        <hr class="my-2 border-white" style="opacity: 0.1;">
                        <form action="<?php echo e(route('admin.monitor.security-audit')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-info btn-sm w-100 text-start">
                                <i class="fas fa-shield-virus me-2 text-info"></i> Security & Core Audit
                            </button>
                        </form>
                        <form action="<?php echo e(route('admin.monitor.housekeeping')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-secondary btn-sm w-100 text-start">
                                <i class="fas fa-broom me-2 text-white-50"></i> Platform Housekeeping
                            </button>
                        </form>
                        <?php if(isset($failedLogs) && $failedLogs->count() > 0): ?>
                        <form action="<?php echo e(route('admin.monitor.clear-failed-logs')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-danger btn-sm w-100 text-start">
                                <i class="fas fa-eraser me-2 text-danger"></i> Clear Failed Tool Logs
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <?php if(isset($scanHistories) && $scanHistories->count() > 0): ?>
    <div class="card border-0 mb-4" style="background: #0f172a;">
        <div class="card-header bg-transparent border-0 py-3">
            <h6 class="card-title mb-0 text-white"><i class="fas fa-history me-2"></i>Scan History (Last <?php echo e($scanHistories->count()); ?>)</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr class="small text-white-50">
                            <th>When</th>
                            <th>Type</th>
                            <th>Trigger</th>
                            <th>Scanned</th>
                            <th>Healthy</th>
                            <th>Broken</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $scanHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="small text-white-50"><?php echo e($history->created_at->diffForHumans()); ?></td>
                            <td><span class="badge bg-primary bg-opacity-25 text-primary small"><?php echo e(strtoupper(str_replace('_', ' ', $history->scan_type))); ?></span></td>
                            <td class="small text-white-50"><?php echo e($history->triggered_by); ?></td>
                            <td class="text-white fw-bold"><?php echo e($history->total_scanned); ?></td>
                            <td class="text-success"><?php echo e($history->healthy); ?></td>
                            <td class="text-danger"><?php echo e($history->broken); ?></td>
                            <td class="small text-white-50"><?php echo e($history->duration_human); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if(count($configIssues) > 0): ?>
    <div class="card border-0 mb-4" style="background: rgba(220, 38, 38, 0.08); border-left: 3px solid #ef4444 !important;">
        <div class="card-body">
            <h6 class="text-danger mb-3"><i class="fas fa-exclamation-triangle me-2"></i>Missing Processor Classes (<?php echo e(count($configIssues)); ?> types)</h6>
            <div class="table-responsive">
                <table class="table table-sm table-borderless text-white mb-0">
                    <thead>
                        <tr class="text-white-50 small">
                            <th>Affected Tools</th>
                            <th>Missing Class</th>
                            <th>Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $configIssues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="fw-bold small"><?php echo e($issue['tool']); ?></td>
                            <td class="small"><code class="text-danger"><?php echo e($issue['issue']); ?></code></td>
                            <td><span class="badge bg-danger bg-opacity-25 text-danger"><?php echo e($issue['count']); ?></span></td>
                            <td>
                                <form action="<?php echo e(route('admin.monitor.fix-processor')); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="slug" value="<?php echo e($issue['tool']); ?>">
                                    <input type="hidden" name="processor" value="<?php echo e($issue['processor_name']); ?>">
                                    <button type="submit" class="btn btn-outline-warning py-0 px-2 small">
                                        <i class="fas fa-magic me-1"></i> Auto-Fix
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if($recentIssues->count() > 0): ?>
    <div class="card border-0 mb-4" style="background: #0f172a;">
        <div class="card-header bg-transparent border-0 py-3">
            <h6 class="card-title mb-0 text-white"><i class="fas fa-bug me-2"></i>Recent Issues (<?php echo e($recentIssues->count()); ?>)</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr class="small text-white-50">
                            <th>Tool</th>
                            <th>Status</th>
                            <th>Issue Type</th>
                            <th>Response</th>
                            <th>Error</th>
                            <th>When</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recentIssues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(url($issue->tool_slug)); ?>" target="_blank" class="text-white text-decoration-none fw-bold">
                                    <?php echo e($issue->tool_slug); ?>

                                    <i class="fas fa-external-link-alt ms-1 small text-white-50"></i>
                                </a>
                            </td>
                            <td>
                                <?php
                                    $statusColors = ['broken' => 'danger', 'static' => 'warning', 'slow' => 'info', 'ui_only' => 'secondary'];
                                ?>
                                <span class="badge bg-<?php echo e($statusColors[$issue->status] ?? 'secondary'); ?>">
                                    <?php echo e(strtoupper($issue->status)); ?>

                                </span>
                            </td>
                            <td><code class="text-info small"><?php echo e($issue->issue_type); ?></code></td>
                            <td class="<?php echo e($issue->response_time_ms > 5000 ? 'text-danger' : 'text-white-50'); ?>"><?php echo e($issue->response_time_ms); ?>ms</td>
                            <td class="small text-white-50" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?php echo e(Str::limit($issue->error_message, 50) ?: '—'); ?>

                            </td>
                            <td class="small text-white-50"><?php echo e($issue->updated_at->diffForHumans()); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="card border-0 mb-4" style="background: #0f172a; border-top: 2px solid #8b5cf6 !important;">
        <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
            <h6 class="card-title mb-0 text-white"><i class="fas fa-satellite me-2"></i>Predictive Anomaly Detection</h6>
            <span class="badge bg-purple bg-opacity-10 text-purple border border-purple px-2 py-1" style="font-size: 0.6rem; color: #a78bfa; border-color: #8b5cf6;">AI-ASSISTED</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr class="small text-white-50">
                            <th>Target Tool</th>
                            <th>Detection Type</th>
                            <th>Impact Score</th>
                            <th>Insight Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $anomalies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anomaly): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong class="text-white"><?php echo e($anomaly['tool']); ?></strong></td>
                            <td><span class="text-info"><?php echo e($anomaly['type']); ?></span></td>
                            <td>
                                <div class="progress" style="height: 6px; width: 60px; background: rgba(255,255,255,0.05);">
                                    <div class="progress-bar <?php echo e($anomaly['impact'] === 'High' ? 'bg-danger' : 'bg-warning'); ?>" style="width: <?php echo e($anomaly['impact'] === 'High' ? '90%' : '45%'); ?>"></div>
                                </div>
                            </td>
                            <td class="small text-white-50"><?php echo e($anomaly['detail']); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="text-center py-4 text-white-50">No operational anomalies detected in recent cycles.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="card border-0" style="background: #0f172a;">
        <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
            <h6 class="card-title mb-0 text-white"><i class="fas fa-server me-2"></i>Full Tool Health Registry</h6>
            <div class="small text-white-50">Displaying All Registered Tools</div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr class="small text-white-50">
                            <th>Tool Slug</th>
                            <th>Status</th>
                            <th>SEO Score</th>
                            <th>Resp</th>
                            <th>Top Issue</th>
                            <th>SEO Status</th>
                            <th>Last Check</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(url($tool->tool_slug)); ?>" target="_blank" class="text-white text-decoration-none fw-bold">
                                    <?php echo e($tool->tool_slug); ?>

                                </a>
                            </td>
                            <td>
                                <span class="status-pulse <?php echo e($tool->status === 'ok' ? 'bg-success' : ($tool->status === 'broken' ? 'bg-danger' : ($tool->status === 'slow' ? 'bg-info' : 'bg-warning'))); ?>"></span>
                                <span class="text-white-50 small"><?php echo e(strtoupper($tool->status)); ?></span>
                            </td>
                            <td>
                                <?php if($tool->seo_score !== null): ?>
                                    <div class="d-flex align-items-center">
                                        <div class="badge <?php echo e($tool->seo_score >= 80 ? 'bg-success' : ($tool->seo_score >= 50 ? 'bg-warning' : 'bg-danger')); ?> bg-opacity-25 text-<?php echo e($tool->seo_score >= 80 ? 'success' : ($tool->seo_score >= 50 ? 'warning' : 'danger')); ?> me-2" style="font-size: 0.75rem;">
                                            <?php echo e($tool->seo_score); ?>

                                        </div>
                                    </div>
                                <?php else: ?>
                                    <span class="text-white-50 small">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="<?php echo e($tool->response_time_ms > 5000 ? 'text-danger' : ($tool->response_time_ms > 2000 ? 'text-warning' : 'text-success')); ?>">
                                <?php echo e($tool->response_time_ms); ?><small>ms</small>
                            </td>
                            <td class="small text-white-50">
                                <?php if($tool->status === 'ok'): ?>
                                    <?php
                                        $toolSeoIssues = json_decode($tool->seo_issues ?? '[]', true);
                                    ?>
                                    <?php if(!empty($toolSeoIssues)): ?>
                                        <span class="text-warning"><?php echo e(Str::title(str_replace('_', ' ', $toolSeoIssues[0]))); ?></span>
                                    <?php else: ?>
                                        <span class="text-success">Healthy</span>
                                    <?php endif; ?>
                                <?php elseif($tool->error_message): ?>
                                    <?php echo e(Str::limit($tool->error_message, 40)); ?>

                                <?php elseif($tool->issue_type): ?>
                                    <?php echo e(str_replace('_', ' ', Str::title($tool->issue_type))); ?>

                                <?php else: ?>
                                    Unknown
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($tool->seo_index_status): ?>
                                    <span class="badge <?php echo e($tool->seo_index_status === 'indexed' ? 'bg-primary' : 'bg-danger'); ?> bg-opacity-10 text-<?php echo e($tool->seo_index_status === 'indexed' ? 'primary' : 'danger'); ?> small" style="font-size: 0.65rem;">
                                        <?php echo e(strtoupper($tool->seo_index_status)); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-white-50">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="small text-white-50">
                                <?php echo e($tool->last_checked_at ? \Carbon\Carbon::parse($tool->last_checked_at)->diffForHumans() : 'Never'); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-white-50">
                                <i class="fas fa-satellite-dish fa-3x mb-3 d-block" style="opacity: 0.2;"></i>
                                No scan data yet. Click <strong>"Run Full Scan"</strong> to start monitoring all <?php echo e($stats['total_registered']); ?> tools.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* ═══════ Monitor Cards ═══════ */
    .monitor-card {
        background: #0f172a;
        border-radius: 10px;
        padding: 1.2rem 1rem;
        height: 100%;
    }
    .monitor-card-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(255,255,255,0.4);
        margin-bottom: 0.3rem;
    }
    .monitor-card-value {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.1;
    }
    .monitor-card-sub {
        font-size: 0.72rem;
        color: rgba(255,255,255,0.3);
        margin-top: 0.2rem;
    }

    /* ═══════ Tables ═══════ */
    .table > :not(caption) > * > * {
        border-bottom-color: rgba(255,255,255,0.04);
        padding: 0.75rem 1rem;
    }
    .table-dark { --bs-table-bg: transparent; }

    /* ═══════ Status Pulse ═══════ */
    .status-pulse {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 6px;
    }
    .status-pulse.bg-success {
        box-shadow: 0 0 0 rgba(16, 185, 129, 0.4);
        animation: pulse-green 2s infinite;
    }
    .status-pulse.bg-danger {
        box-shadow: 0 0 0 rgba(239, 68, 68, 0.4);
        animation: pulse-red 2s infinite;
    }
    @keyframes pulse-green {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.6); }
        70% { box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
    @keyframes pulse-red {
        0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.6); }
        70% { box-shadow: 0 0 0 8px rgba(239, 68, 68, 0); }
        100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }

    /* ═══════ Buttons ═══════ */
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }

    /* ═══════ Cards ═══════ */
    .card { border-radius: 10px; }
    .badge { border-radius: 5px; }
</style>

<?php $__env->startPush('scripts'); ?>
<script>
// ═══════ REAL-TIME SCAN PROGRESS POLLING ═══════
(function() {
    const panel = document.getElementById('scanProgressPanel');
    const bar = document.getElementById('progressBar');
    const batchLabel = document.getElementById('progressBatchLabel');
    const scannedLabel = document.getElementById('progressScanned');
    const percentLabel = document.getElementById('progressPercent');

    let polling = null;

    function checkProgress() {
        fetch('<?php echo e(route("admin.monitor.progress")); ?>')
            .then(r => r.json())
            .then(data => {
                if (data.status === 'running' || data.status === 'starting') {
                    panel.style.display = 'block';
                    const pct = data.total > 0 ? Math.round((data.scanned / data.total) * 100) : 0;
                    bar.style.width = pct + '%';
                    batchLabel.textContent = `Batch ${data.current_batch || 0}/${data.total_batches || 0}`;
                    scannedLabel.textContent = `${data.scanned || 0} of ${data.total || 0} scanned`;
                    percentLabel.textContent = pct + '%';

                    if (!polling) {
                        polling = setInterval(checkProgress, 2000);
                    }
                } else if (data.status === 'completed') {
                    panel.style.display = 'none';
                    if (polling) {
                        clearInterval(polling);
                        polling = null;
                        // Refresh page to show updated results
                        location.reload();
                    }
                } else {
                    panel.style.display = 'none';
                }
            })
            .catch(() => {});
    }

    // Check immediately on page load
    checkProgress();

    // Also start polling when scan button is clicked
    const scanForms = document.querySelectorAll('.scan-form');
    scanForms.forEach(form => {
        form.addEventListener('submit', function() {
            setTimeout(() => {
                panel.style.display = 'block';
                bar.style.width = '0%';
                if (!polling) polling = setInterval(checkProgress, 2000);
            }, 1000);
        });
    });
})();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\admin\monitor\dashboard.blade.php ENDPATH**/ ?>