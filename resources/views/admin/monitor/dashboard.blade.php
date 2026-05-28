@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- ═══════ HEADER ═══════ --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="me-4 border-end pe-4 d-none d-xl-block">
                <div class="text-white-50 small text-uppercase mb-1" style="letter-spacing: 1px;">Global Availability</div>
                <div class="h4 mb-0 fw-bold {{ $enterpriseStats['gai'] > 99 ? 'text-success' : 'text-warning' }}">
                    <i class="fas fa-globe me-2"></i>{{ $enterpriseStats['gai'] }}%
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
            <a href="{{ route('admin.monitor.export-csv') }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-file-csv me-1"></i> Export CSV
            </a>
            <form action="{{ route('admin.monitor.scan') }}" method="POST" class="d-inline" id="scanForm">
                @csrf
                <button type="submit" class="btn btn-primary" id="scanBtn">
                    <i class="fas fa-rocket me-1"></i> Run Full Scan
                </button>
            </form>
        </div>
    </div>

    {{-- ═══════ FLASH MESSAGES ═══════ --}}
    @if(session('success'))
    <div class="alert border-0 mb-4" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert border-0 mb-4" style="background: rgba(239, 68, 68, 0.15); color: #ef4444;">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
    </div>
    @endif

    {{-- ═══════ REAL-TIME SCAN PROGRESS ═══════ --}}
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

    {{-- ═══════ SUMMARY CARDS ═══════ --}}
    <div class="tab-content">
        {{-- ═══════ TOOL HEALTH TAB ═══════ --}}
        <div class="tab-pane fade show active" id="tool-health">
            <div class="row g-3 mb-4">
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #6366f1;">
                        <div class="monitor-card-label">Total Registered</div>
                        <div class="monitor-card-value" style="color: #a5b4fc;">{{ $stats['total_registered'] }}</div>
                        <div class="monitor-card-sub">{{ $stats['total_scanned'] }} scanned</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #10b981;">
                        <div class="monitor-card-label">Healthy</div>
                        <div class="monitor-card-value text-success" id="statHealthy">{{ $stats['healthy'] }}</div>
                        <div class="monitor-card-sub">{{ $stats['health_score'] }}% health</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #ef4444;">
                        <div class="monitor-card-label">Broken</div>
                        <div class="monitor-card-value text-danger" id="statBroken">{{ $stats['broken'] }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #f59e0b;">
                        <div class="monitor-card-label">Static</div>
                        <div class="monitor-card-value text-warning" id="statStatic">{{ $stats['static'] }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #06b6d4;">
                        <div class="monitor-card-label">Slow</div>
                        <div class="monitor-card-value" style="color: #22d3ee;" id="statSlow">{{ $stats['slow'] }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #8b5cf6;">
                        <div class="monitor-card-label">UI Only</div>
                        <div class="monitor-card-value" style="color: #a78bfa;" id="statUiOnly">{{ $stats['ui_only'] }}</div>
                    </div>
                </div>
            </div>
            
            {{-- ═══════ LIVE FAILED TOOLS TRACKING ═══════ --}}
            @if(isset($failedLogs) && $failedLogs->count() > 0)
            <div class="card border-0 mb-4" style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.15);">
                <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="text-danger mb-0"><i class="fas fa-exclamation-circle me-2"></i>🚨 Live Failed Tools Tracking (Client-Side Telemetry)</h6>
                    <form action="{{ route('admin.monitor.clear-failed-logs') }}" method="POST">
                        @csrf
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
                                @foreach($failedLogs as $log)
                                <tr>
                                    <td><strong class="text-white">{{ $log->tool_slug }}</strong></td>
                                    <td><span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">{{ $log->issue_type }}</span></td>
                                    <td class="small text-white-50">{{ $log->created_at->diffForHumans() }}</td>
                                    <td class="text-end">
                                        <button class="btn btn-link btn-sm text-info p-0 text-decoration-none small" type="button" data-bs-toggle="collapse" data-bs-target="#log-{{ $log->id }}">
                                            <i class="fas fa-code me-1"></i> View Inputs
                                        </button>
                                    </td>
                                </tr>
                                <tr class="collapse" id="log-{{ $log->id }}">
                                    <td colspan="4" class="p-0 border-0">
                                        <div class="p-3 bg-black bg-opacity-25 rounded-3 m-2 small">
                                            <div class="text-white-50 mb-2 small"><i class="fas fa-info-circle me-1"></i> Input state that triggered the failure:</div>
                                            <pre class="text-info m-0 p-2" style="background: rgba(0,0,0,0.2); border-radius: 4px;">{{ json_encode($log->input_data, JSON_PRETTY_PRINT) }}</pre>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            {{-- ═══════ INFRASTRUCTURE WELLNESS ═══════ --}}
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
                                <div class="text-white small fw-bold"><span class="text-info">{{ $enterpriseStats['threats'] }}</span> events blocked</div>
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
                                <div class="text-white small fw-bold">{{ number_format($enterpriseStats['load']) }} active nodes</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════ SEO HEALTH TAB ═══════ --}}
        <div class="tab-pane fade" id="seo-health">
            <div class="row g-3 mb-4">
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #10b981;">
                        <div class="monitor-card-label">Indexed Pages</div>
                        <div class="monitor-card-value text-success">{{ $seoStats['indexed'] }}</div>
                        <div class="monitor-card-sub">Out of {{ $seoStats['total_scanned'] }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #ef4444;">
                        <div class="monitor-card-label">Non-Indexed</div>
                        <div class="monitor-card-value text-danger">{{ $seoStats['noindex'] }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #3b82f6;">
                        <div class="monitor-card-label">Avg SEO Score</div>
                        <div class="monitor-card-value" style="color: #60a5fa;">{{ $seoStats['avg_score'] }}<small class="fs-6">/100</small></div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #06b6d4;">
                        <div class="monitor-card-label">Avg Speed Score</div>
                        <div class="monitor-card-value" style="color: #22d3ee;">{{ $seoStats['avg_speed'] }}%</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #f59e0b;">
                        <div class="monitor-card-label">Slow Pages</div>
                        <div class="monitor-card-value text-warning">{{ $seoStats['slow_pages'] }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="monitor-card" style="border-left: 3px solid #ef4444;">
                        <div class="monitor-card-label">SEO Errors</div>
                        <div class="monitor-card-value text-danger">{{ $seoStats['errors_count'] }}</div>
                    </div>
                </div>
            </div>

            {{-- ═══════ DUPLICATE DETECTION ═══════ --}}
            @if($duplicates['titles']->count() > 0 || $duplicates['descriptions']->count() > 0)
            <div class="card border-0 mb-4" style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.1);">
                <div class="card-body">
                    <h6 class="text-danger mb-3"><i class="fas fa-copy me-2"></i>Duplicate Meta Content Detected</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled small text-white-50 mb-0">
                                @foreach($duplicates['titles'] as $dup)
                                <li class="mb-2"><i class="fas fa-exclamation-circle text-danger me-2"></i>Title repeated <strong>{{ $dup->count }}x</strong>: <code class="text-danger">{{ Str::limit($dup->title, 50) }}</code></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled small text-white-50 mb-0">
                                @foreach($duplicates['descriptions'] as $dup)
                                <li class="mb-2"><i class="fas fa-exclamation-circle text-danger me-2"></i>Desc repeated <strong>{{ $dup->count }}x</strong>: <code class="text-danger">{{ Str::limit($dup->descr, 50) }}</code></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- ═══════ DETAILED SEO ISSUES ═══════ --}}
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
                                @forelse($seoLogs as $log)
                                <tr>
                                    <td><strong class="text-white">{{ $log->tool_slug }}</strong></td>
                                    <td><span class="badge {{ $log->seo_score >= 80 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 text-{{ $log->seo_score >= 80 ? 'success' : 'danger' }}">{{ $log->seo_score }}</span></td>
                                    <td>
                                        @foreach($log->issues as $issue)
                                            <span class="badge bg-secondary bg-opacity-10 text-white-50 small me-1 mb-1" style="font-size: 0.65rem;">{{ str_replace('_', ' ', $issue) }}</span>
                                        @endforeach
                                    </td>
                                    <td class="small text-info">
                                        {{ $log->recommendations[0] ?? '—' }}
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-4 text-white-50">No major SEO issues detected in scanned tools.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ HEALTH GAUGE + RESPONSE TIME ═══════ --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body text-center py-4">
                    <h6 class="text-white-50 text-uppercase small mb-3">Health Score</h6>
                    <div class="health-gauge mx-auto">
                        <svg viewBox="0 0 120 120" width="120" height="120">
                            <circle cx="60" cy="60" r="52" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="10"/>
                            <circle cx="60" cy="60" r="52" fill="none"
                                stroke="{{ $stats['health_score'] >= 80 ? '#10b981' : ($stats['health_score'] >= 50 ? '#f59e0b' : '#ef4444') }}"
                                stroke-width="10" stroke-linecap="round"
                                stroke-dasharray="{{ $stats['health_score'] * 3.27 }} 327"
                                transform="rotate(-90 60 60)" style="transition: stroke-dasharray 1s ease;"/>
                            <text x="60" y="60" text-anchor="middle" dominant-baseline="central"
                                fill="white" font-size="28" font-weight="700">{{ $stats['health_score'] }}%</text>
                        </svg>
                    </div>
                    <div class="mt-3">
                        <span class="badge {{ $enterpriseStats['sla_status'] === 'PASS' ? 'bg-success' : 'bg-danger' }} bg-opacity-10 text-{{ $enterpriseStats['sla_status'] === 'PASS' ? 'success' : 'danger' }} small">
                            <i class="fas fa-certificate me-1"></i> ENTERPRISE SLA: {{ $enterpriseStats['sla_status'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body text-center py-4">
                    <h6 class="text-white-50 text-uppercase small mb-3">Avg Response Time</h6>
                    <h1 class="text-white mb-1" style="font-size: 3rem;">{{ $stats['avg_response'] }}<span class="fs-6 text-white-50">ms</span></h1>
                    <p class="text-white-50 small mb-0">
                        @if($stats['avg_response'] < 2000) <span class="text-success"><i class="fas fa-check-circle"></i> Excellent</span>
                        @elseif($stats['avg_response'] < 5000) <span class="text-warning"><i class="fas fa-exclamation-circle"></i> Acceptable</span>
                        @else <span class="text-danger"><i class="fas fa-times-circle"></i> Needs Optimization</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body text-center py-4">
                    <h6 class="text-white-50 text-uppercase small mb-3">Scan Coverage</h6>
                    @php $coverage = $stats['total_registered'] > 0 ? round(($stats['total_scanned'] / $stats['total_registered']) * 100) : 0; @endphp
                    <h1 class="text-white mb-1" style="font-size: 3rem;">{{ $coverage }}<span class="fs-6 text-white-50">%</span></h1>
                    <p class="text-white-50 small mb-2">{{ $stats['not_scanned'] }} tools not yet scanned</p>
                    <div class="progress" style="height: 4px; background: rgba(255,255,255,0.1);">
                        <div class="progress-bar bg-info" style="width: {{ $enterpriseStats['efficiency'] }}%"></div>
                    </div>
                    <p class="text-white-50 small mt-2 mb-0" style="font-size: 0.65rem;">Resource Efficiency: {{ $enterpriseStats['efficiency'] }}% optimized</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ STATUS DISTRIBUTION CHART ═══════ --}}
    <div class="row g-3 mb-4">
        <div class="col-md-5">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body">
                    <h6 class="text-white mb-3"><i class="fas fa-chart-bar me-2"></i>Status Distribution</h6>
                    <div class="status-bar-chart">
                        @php
                            $total = max($stats['total_scanned'], 1);
                            $bars = [
                                ['label' => 'Healthy', 'count' => $stats['healthy'], 'color' => '#10b981'],
                                ['label' => 'Broken', 'count' => $stats['broken'], 'color' => '#ef4444'],
                                ['label' => 'Static', 'count' => $stats['static'], 'color' => '#f59e0b'],
                                ['label' => 'Slow', 'count' => $stats['slow'], 'color' => '#06b6d4'],
                                ['label' => 'UI Only', 'count' => $stats['ui_only'], 'color' => '#8b5cf6'],
                            ];
                        @endphp
                        @foreach($bars as $bar)
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-white-50 small" style="width: 70px;">{{ $bar['label'] }}</div>
                            <div class="flex-grow-1 mx-3">
                                <div style="background: rgba(255,255,255,0.05); border-radius: 4px; height: 18px; overflow: hidden;">
                                    <div style="width: {{ ($bar['count'] / $total) * 100 }}%; background: {{ $bar['color'] }}; height: 100%; border-radius: 4px; transition: width 1s ease; min-width: {{ $bar['count'] > 0 ? '2px' : '0' }};"></div>
                                </div>
                            </div>
                            <div class="text-white fw-bold small" style="width: 40px; text-align: right;">{{ $bar['count'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 h-100" style="background: #0f172a;">
                <div class="card-body">
                    <h6 class="text-white mb-3"><i class="fas fa-globe-americas me-2"></i>Regional Latency</h6>
                    <div class="latency-grid">
                        @foreach($enterpriseStats['regions'] as $region => $lat)
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-white shadow-sm" style="border-color: rgba(255,255,255,0.03) !important;">
                            <span class="text-white-50 small">{{ $region }}</span>
                            <span class="badge {{ $lat < 300 ? 'bg-success' : ($lat < 600 ? 'bg-warning' : 'bg-danger') }} bg-opacity-10 text-{{ $lat < 300 ? 'success' : ($lat < 600 ? 'warning' : 'danger') }} border border-{{ $lat < 300 ? 'success' : ($lat < 600 ? 'warning' : 'danger') }} py-1 px-2" style="font-size: 0.65rem;">
                                {{ $lat }}ms
                            </span>
                        </div>
                        @endforeach
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
                        <form action="{{ route('admin.monitor.scan') }}" method="POST" class="scan-form">
                            @csrf
                            <input type="hidden" name="limit" value="50">
                            <button class="btn btn-outline-light btn-sm w-100 text-start">
                                <i class="fas fa-bolt me-2 text-warning"></i> Quick Scan (50 tools)
                            </button>
                        </form>
                        <form action="{{ route('admin.monitor.scan') }}" method="POST" class="scan-form">
                            @csrf
                            <button class="btn btn-outline-light btn-sm w-100 text-start">
                                <i class="fas fa-rocket me-2 text-primary"></i> Full Scan (All {{ $stats['total_registered'] }})
                            </button>
                        </form>
                        <form action="{{ route('admin.monitor.rescan-broken') }}" method="POST" class="scan-form">
                            @csrf
                            <button class="btn btn-outline-light btn-sm w-100 text-start">
                                <i class="fas fa-redo me-2 text-danger"></i> Rescan Broken Only ({{ $stats['broken'] }})
                            </button>
                        </form>
                        @if($missingProcessorCount > 0)
                        <form action="{{ route('admin.monitor.bulk-fix') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-light btn-sm w-100 text-start">
                                <i class="fas fa-wrench me-2 text-warning"></i> Bulk Fix Processors ({{ $missingProcessorCount }})
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('admin.monitor.purge-stale') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-light btn-sm w-100 text-start">
                                <i class="fas fa-trash-alt me-2 text-secondary"></i> Purge Stale Records
                            </button>
                        </form>
                        <a href="{{ route('admin.monitor.export-csv') }}" class="btn btn-outline-light btn-sm w-100 text-start">
                            <i class="fas fa-download me-2 text-success"></i> Download CSV Report
                        </a>
                        <hr class="my-2 border-white" style="opacity: 0.1;">
                        <form action="{{ route('admin.monitor.security-audit') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-info btn-sm w-100 text-start">
                                <i class="fas fa-shield-virus me-2 text-info"></i> Security & Core Audit
                            </button>
                        </form>
                        <form action="{{ route('admin.monitor.housekeeping') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-secondary btn-sm w-100 text-start">
                                <i class="fas fa-broom me-2 text-white-50"></i> Platform Housekeeping
                            </button>
                        </form>
                        @if(isset($failedLogs) && $failedLogs->count() > 0)
                        <form action="{{ route('admin.monitor.clear-failed-logs') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm w-100 text-start">
                                <i class="fas fa-eraser me-2 text-danger"></i> Clear Failed Tool Logs
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════ SCAN HISTORY ═══════ --}}
    @if(isset($scanHistories) && $scanHistories->count() > 0)
    <div class="card border-0 mb-4" style="background: #0f172a;">
        <div class="card-header bg-transparent border-0 py-3">
            <h6 class="card-title mb-0 text-white"><i class="fas fa-history me-2"></i>Scan History (Last {{ $scanHistories->count() }})</h6>
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
                        @foreach($scanHistories as $history)
                        <tr>
                            <td class="small text-white-50">{{ $history->created_at->diffForHumans() }}</td>
                            <td><span class="badge bg-primary bg-opacity-25 text-primary small">{{ strtoupper(str_replace('_', ' ', $history->scan_type)) }}</span></td>
                            <td class="small text-white-50">{{ $history->triggered_by }}</td>
                            <td class="text-white fw-bold">{{ $history->total_scanned }}</td>
                            <td class="text-success">{{ $history->healthy }}</td>
                            <td class="text-danger">{{ $history->broken }}</td>
                            <td class="small text-white-50">{{ $history->duration_human }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- ═══════ CONFIG ISSUES ═══════ --}}
    @if(count($configIssues) > 0)
    <div class="card border-0 mb-4" style="background: rgba(220, 38, 38, 0.08); border-left: 3px solid #ef4444 !important;">
        <div class="card-body">
            <h6 class="text-danger mb-3"><i class="fas fa-exclamation-triangle me-2"></i>Missing Processor Classes ({{ count($configIssues) }} types)</h6>
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
                        @foreach($configIssues as $issue)
                        <tr>
                            <td class="fw-bold small">{{ $issue['tool'] }}</td>
                            <td class="small"><code class="text-danger">{{ $issue['issue'] }}</code></td>
                            <td><span class="badge bg-danger bg-opacity-25 text-danger">{{ $issue['count'] }}</span></td>
                            <td>
                                <form action="{{ route('admin.monitor.fix-processor') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="slug" value="{{ $issue['tool'] }}">
                                    <input type="hidden" name="processor" value="{{ $issue['processor_name'] }}">
                                    <button type="submit" class="btn btn-outline-warning py-0 px-2 small">
                                        <i class="fas fa-magic me-1"></i> Auto-Fix
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- ═══════ RECENT ISSUES ═══════ --}}
    @if($recentIssues->count() > 0)
    <div class="card border-0 mb-4" style="background: #0f172a;">
        <div class="card-header bg-transparent border-0 py-3">
            <h6 class="card-title mb-0 text-white"><i class="fas fa-bug me-2"></i>Recent Issues ({{ $recentIssues->count() }})</h6>
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
                        @foreach($recentIssues as $issue)
                        <tr>
                            <td>
                                <a href="{{ url($issue->tool_slug) }}" target="_blank" class="text-white text-decoration-none fw-bold">
                                    {{ $issue->tool_slug }}
                                    <i class="fas fa-external-link-alt ms-1 small text-white-50"></i>
                                </a>
                            </td>
                            <td>
                                @php
                                    $statusColors = ['broken' => 'danger', 'static' => 'warning', 'slow' => 'info', 'ui_only' => 'secondary'];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$issue->status] ?? 'secondary' }}">
                                    {{ strtoupper($issue->status) }}
                                </span>
                            </td>
                            <td><code class="text-info small">{{ $issue->issue_type }}</code></td>
                            <td class="{{ $issue->response_time_ms > 5000 ? 'text-danger' : 'text-white-50' }}">{{ $issue->response_time_ms }}ms</td>
                            <td class="small text-white-50" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ Str::limit($issue->error_message, 50) ?: '—' }}
                            </td>
                            <td class="small text-white-50">{{ $issue->updated_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    {{-- ═══════ PREDICTIVE ANOMALY DETECTION ═══════ --}}
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
                        @forelse($anomalies as $anomaly)
                        <tr>
                            <td><strong class="text-white">{{ $anomaly['tool'] }}</strong></td>
                            <td><span class="text-info">{{ $anomaly['type'] }}</span></td>
                            <td>
                                <div class="progress" style="height: 6px; width: 60px; background: rgba(255,255,255,0.05);">
                                    <div class="progress-bar {{ $anomaly['impact'] === 'High' ? 'bg-danger' : 'bg-warning' }}" style="width: {{ $anomaly['impact'] === 'High' ? '90%' : '45%' }}"></div>
                                </div>
                            </td>
                            <td class="small text-white-50">{{ $anomaly['detail'] }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4 text-white-50">No operational anomalies detected in recent cycles.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ═══════ FULL TOOL REGISTRY (N+1 ELIMINATED — uses pre-joined data) ═══════ --}}
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
                        @forelse($tools as $tool)
                        <tr>
                            <td>
                                <a href="{{ url($tool->tool_slug) }}" target="_blank" class="text-white text-decoration-none fw-bold">
                                    {{ $tool->tool_slug }}
                                </a>
                            </td>
                            <td>
                                <span class="status-pulse {{ $tool->status === 'ok' ? 'bg-success' : ($tool->status === 'broken' ? 'bg-danger' : ($tool->status === 'slow' ? 'bg-info' : 'bg-warning')) }}"></span>
                                <span class="text-white-50 small">{{ strtoupper($tool->status) }}</span>
                            </td>
                            <td>
                                @if($tool->seo_score !== null)
                                    <div class="d-flex align-items-center">
                                        <div class="badge {{ $tool->seo_score >= 80 ? 'bg-success' : ($tool->seo_score >= 50 ? 'bg-warning' : 'bg-danger') }} bg-opacity-25 text-{{ $tool->seo_score >= 80 ? 'success' : ($tool->seo_score >= 50 ? 'warning' : 'danger') }} me-2" style="font-size: 0.75rem;">
                                            {{ $tool->seo_score }}
                                        </div>
                                    </div>
                                @else
                                    <span class="text-white-50 small">—</span>
                                @endif
                            </td>
                            <td class="{{ $tool->response_time_ms > 5000 ? 'text-danger' : ($tool->response_time_ms > 2000 ? 'text-warning' : 'text-success') }}">
                                {{ $tool->response_time_ms }}<small>ms</small>
                            </td>
                            <td class="small text-white-50">
                                @if($tool->status === 'ok')
                                    @php
                                        $toolSeoIssues = json_decode($tool->seo_issues ?? '[]', true);
                                    @endphp
                                    @if(!empty($toolSeoIssues))
                                        <span class="text-warning">{{ Str::title(str_replace('_', ' ', $toolSeoIssues[0])) }}</span>
                                    @else
                                        <span class="text-success">Healthy</span>
                                    @endif
                                @elseif($tool->error_message)
                                    {{ Str::limit($tool->error_message, 40) }}
                                @elseif($tool->issue_type)
                                    {{ str_replace('_', ' ', Str::title($tool->issue_type)) }}
                                @else
                                    Unknown
                                @endif
                            </td>
                            <td>
                                @if($tool->seo_index_status)
                                    <span class="badge {{ $tool->seo_index_status === 'indexed' ? 'bg-primary' : 'bg-danger' }} bg-opacity-10 text-{{ $tool->seo_index_status === 'indexed' ? 'primary' : 'danger' }} small" style="font-size: 0.65rem;">
                                        {{ strtoupper($tool->seo_index_status) }}
                                    </span>
                                @else
                                    <span class="text-white-50">—</span>
                                @endif
                            </td>
                            <td class="small text-white-50">
                                {{ $tool->last_checked_at ? \Carbon\Carbon::parse($tool->last_checked_at)->diffForHumans() : 'Never' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-white-50">
                                <i class="fas fa-satellite-dish fa-3x mb-3 d-block" style="opacity: 0.2;"></i>
                                No scan data yet. Click <strong>"Run Full Scan"</strong> to start monitoring all {{ $stats['total_registered'] }} tools.
                            </td>
                        </tr>
                        @endforelse
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

@push('scripts')
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
        fetch('{{ route("admin.monitor.progress") }}')
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
@endpush
@endsection
