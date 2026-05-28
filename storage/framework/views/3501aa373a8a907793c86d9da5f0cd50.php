<!DOCTYPE html>
<html lang="<?php echo e($currentLocale ?? 'en'); ?>" dir="<?php echo e($localeDir ?? 'ltr'); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'ToolsHub — Free Online File Converter & Compressor'); ?></title>
    <meta name="description"
        content="<?php echo $__env->yieldContent('meta_description', 'Free online tools to convert, compress, and edit files. No signup required. Fast, secure, and easy to use.'); ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
    <link rel="alternate icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    
    <!-- DNS Prefetch & Preconnect for CDN performance -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('css/app.css')); ?>?v=1.0.6" rel="stylesheet">
    <link href="<?php echo e(asset('css/interactive-tools.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldPushContent('styles'); ?>
    
    <?php
        $canonicalLink = $canonicalUrl ?? url()->current();
    ?>
    <link rel="canonical" href="<?php echo e($canonicalLink); ?>" />

    <?php if(isset($hreflangData)): ?>
        <?php $__currentLoopData = $hreflangData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langCode => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <link rel="alternate" hreflang="<?php echo e($langCode); ?>" href="<?php echo e($url); ?>" />
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', 'ToolsHub — Free Online File Converter & Compressor'); ?>" />
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta_description', 'Free online tools to convert, compress, and edit files. No signup required. Fast, secure, and easy to use.'); ?>" />
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('images/og-default.png')); ?>" />
    <meta property="og:url" content="<?php echo e($canonicalLink); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="<?php echo e(config('seo.site_name', 'ToolsHub')); ?>" />

    <!-- Twitter/X Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('title', config('seo.site_name', 'ToolsHub')); ?>" />
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('meta_description', 'Free online calculators, converters, and tools. No signup required.'); ?>" />
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('og_image', asset('images/og-default.png')); ?>" />

    <!-- DNS Prefetch Control -->
    <meta http-equiv="x-dns-prefetch-control" content="on" />

    <?php echo $__env->yieldContent('schema'); ?>
</head>

<body>

    
    <nav class="navbar navbar-expand-xl navbar-custom">
        <div class="container">
            <a class="navbar-brand py-0" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="ToolsHub Logo" class="brand-logo" fetchpriority="high">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <!-- Categories Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-th-large me-1"></i> Categories
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item" href="<?php echo e(url('/text')); ?>"><i class="fas fa-font me-2"></i> Text & Content</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/unit-converter')); ?>"><i class="fas fa-exchange-alt me-2"></i> Unit Converters</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/business')); ?>"><i class="fas fa-briefcase me-2"></i> Business Tools</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/finance')); ?>"><i class="fas fa-calculator me-2"></i> Financial Tools</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item fw-bold" href="<?php echo e(url('/utility')); ?>" style="color: var(--accent);">
                                    <i class="fas fa-list-ul me-2"></i> All Tools
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Unit Converters -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-exchange-alt me-1"></i> Converters
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item" href="<?php echo e(url('/unit-converter?type=length')); ?>"><i class="fas fa-ruler-combined me-2"></i> Length Converter</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/unit-converter?type=weight')); ?>"><i class="fas fa-weight-hanging me-2"></i> Weight Converter</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/unit-converter?type=data-storage')); ?>"><i class="fas fa-server me-2"></i> Data Storage</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/unit-converter?type=temperature')); ?>"><i class="fas fa-thermometer-half me-2"></i> Temperature</a></li>
                        </ul>
                    </li>

                    <!-- Business & SaaS -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-briefcase me-1"></i> Business
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item" href="<?php echo e(url('/business')); ?>"><i class="fas fa-chart-line me-2"></i> SaaS Forecaster</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/finance')); ?>"><i class="fas fa-calculator me-2"></i> ROI Calculator</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/business')); ?>"><i class="fas fa-file-invoice-dollar me-2"></i> Profitability Ratio</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/business')); ?>"><i class="fas fa-fire me-2"></i> Burn Rate Calc</a></li>
                        </ul>
                    </li>

                    <!-- Calculators -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-calculator me-1"></i> Calculators
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item" href="<?php echo e(url('/finance')); ?>"><i class="fas fa-hand-holding-dollar me-2"></i> Finance & Tax</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/health')); ?>"><i class="fas fa-heart-pulse me-2"></i> Health & Fitness</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/medical')); ?>"><i class="fas fa-stethoscope me-2"></i> Clinical & Medical</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/calculators')); ?>"><i class="fas fa-square-root-alt me-2"></i> Math & Algebra</a></li>
                        </ul>
                    </li>

                    <!-- AI Tools -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-robot me-1"></i> AI & Names
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item" href="<?php echo e(url('/ai-content')); ?>"><i class="fas fa-wand-magic-sparkles me-2"></i> Content Generator</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(url('/name-generator')); ?>"><i class="fas fa-signature me-2"></i> Name Generators</a></li>
                        </ul>
                    </li>

                    
                    <?php if(config('ads.extension.published')): ?>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-extension-nav" href="<?php echo e(config('ads.extension.chrome_web_store_url', '#')); ?>" target="_blank">
                            <span>Download Extension</span> <i class="fas fa-arrow-right"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>



    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>



    
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand-section">
                    <div class="footer-brand">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="ToolsHub Logo" class="brand-logo footer-logo" loading="lazy">
                    </div>
                    <p>Free online tools to convert, compress, and edit your files. No signup required. 100% secure and
                        privacy-first.</p>
                </div>
                <div>
                    <h6>Text & Content</h6>
                    <ul class="footer-links">
                        <li><a href="<?php echo e(url('/text')); ?>">Text Tools</a></li>
                        <li><a href="<?php echo e(url('/word-counter')); ?>">Word Counter</a></li>
                        <li><a href="<?php echo e(url('/case-converter')); ?>">Case Converter</a></li>
                        <li><a href="<?php echo e(url('/lorem-ipsum')); ?>">Lorem Ipsum</a></li>
                    </ul>
                </div>
                <div>
                    <h6>Calculators</h6>
                    <ul class="footer-links">
                        <li><a href="<?php echo e(url('/medical')); ?>">Clinical & Medical</a></li>
                        <li><a href="<?php echo e(url('/finance')); ?>">Finance & Tax</a></li>
                        <li><a href="<?php echo e(url('/health')); ?>">Health & Fitness</a></li>
                        <li><a href="<?php echo e(url('/calculators')); ?>">Math & Education</a></li>
                        <li><a href="<?php echo e(url('/algebra')); ?>">Algebra & Discrete Math</a></li>
                        <li><a href="<?php echo e(url('/gaming')); ?>">Gaming Tools</a></li>
                    </ul>
                </div>
                <div>
                    <h6>Utilities & AI</h6>
                    <ul class="footer-links">
                        <li><a href="<?php echo e(url('/utility')); ?>">All Utilities</a></li>
                        <li><a href="<?php echo e(url('/barcode-generator')); ?>">Barcode Generator</a></li>
                        <li><a href="<?php echo e(url('/csv-to-ofx')); ?>">CSV to OFX</a></li>
                        <li><a href="<?php echo e(url('/url-shortener')); ?>">URL Shortener</a></li>
                        <li><a href="<?php echo e(url('/ai-content')); ?>">AI Content Tools</a></li>
                        <li><a href="<?php echo e(url('/name-generator')); ?>">Name Generators</a></li>
                    </ul>
                </div>
                <div>
                    <h6>Company</h6>
                    <ul class="footer-links">
                        <li><a href="<?php echo e(route('about')); ?>">About Us</a></li>
                        <li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
                        <li><a href="<?php echo e(route('privacy')); ?>">Privacy Policy</a></li>
                        <li><a href="<?php echo e(route('terms')); ?>">Terms of Service</a></li>
                        <li><a href="<?php echo e(route('disclaimer')); ?>">Disclaimer</a></li>
                        <li><a href="<?php echo e(url('/api-docs')); ?>">API Documentation</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo e(date('Y')); ?> ToolsHub. All rights reserved.</p>
                
                <?php if(!empty(config('seo.social_links'))): ?>
                <div class="footer-social">
                    <?php $__currentLoopData = config('seo.social_links'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($url); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-<?php echo e($platform); ?>"></i></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- Shared Utilities -->
    <script src="<?php echo e(asset('js/tools-utils.js')); ?>" defer></script>
    <!-- Upload Engine -->
    <script src="<?php echo e(asset('js/upload-engine.js')); ?>?v=2" defer></script>

    <!-- CryptoJS for advanced hashing (deferred — not needed for initial render) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" defer></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views/layouts/app.blade.php ENDPATH**/ ?>