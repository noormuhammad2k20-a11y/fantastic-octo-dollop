<?php
/**
 * scripts/register_45_tools.php
 * Registers 45 tools from Batches 1, 2, and 3 into the main Laravel pro_calculators config.
 */

$configFile = 'd:\\Xamp\\htdocs\\ToolsHub\\config\\pro_calculators.php';
$engineConfigFile = 'd:\\Xamp\\htdocs\\ToolsHub\\calculator_configs.json';

if (!file_exists($configFile)) {
    echo "Creating pro_calculators.php...\n";
    $existingConfig = [];
} else {
    $existingConfig = include $configFile;
    if (!is_array($existingConfig)) $existingConfig = [];
}

$engineConfig = json_decode(file_get_contents($engineConfigFile), true);

$toolsToRegister = [
    // --- Batch 1: Math & Basic Area ---
    "absolute-value-equation-solver" => ["title" => "Absolute Value Equation Solver", "icon" => "fas fa-sort-amount-up", "cat" => "math"],
    "absolute-value-inequality-solver" => ["title" => "Absolute Value Inequality Solver", "icon" => "fas fa-less-than-equal", "cat" => "math"],
    "algebraic-expression-simplifier" => ["title" => "Algebraic Expression Simplifier", "icon" => "fas fa-stream", "cat" => "math"],
    "area-of-a-circle-calculator" => ["title" => "Area of a Circle Calculator", "icon" => "fas fa-circle", "cat" => "geometry"],
    "area-of-a-parallelogram-calculator" => ["title" => "Area of a Parallelogram Calculator", "icon" => "fas fa-vector-square", "cat" => "geometry"],
    "area-of-a-sector-of-a-circle-calculator" => ["title" => "Area of a Sector Calculator", "icon" => "fas fa-chart-pie", "cat" => "geometry"],
    "area-of-a-trapezoid-calculator" => ["title" => "Area of a Trapezoid Calculator", "icon" => "fas fa-draw-polygon", "cat" => "geometry"],
    "area-of-an-ellipse-calculator" => ["title" => "Area of an Ellipse Calculator", "icon" => "fas fa-egg", "cat" => "geometry"],
    "area-of-an-equilateral-triangle-calculator" => ["title" => "Equilateral Triangle Area", "icon" => "fas fa-caret-up", "cat" => "geometry"],
    "surface-area-calculator" => ["title" => "General Surface Area Calculator", "icon" => "fas fa-ruler-combined", "cat" => "geometry"],
    "surface-area-of-a-cone-calculator" => ["title" => "Surface Area of a Cone", "icon" => "fas fa-ice-cream", "cat" => "geometry"],
    "surface-area-of-a-cube-calculator" => ["title" => "Surface Area of a Cube", "icon" => "fas fa-cube", "cat" => "geometry"],
    "surface-area-of-a-cylinder-calculator" => ["title" => "Surface Area of a Cylinder", "icon" => "fas fa-database", "cat" => "geometry"],
    "surface-area-of-a-rectangular-prism-calculator" => ["title" => "Surface Area of a Rectangular Prism", "icon" => "fas fa-box", "cat" => "geometry"],
    "surface-area-of-a-sphere-calculator" => ["title" => "Surface Area of a Sphere", "icon" => "fas fa-globe", "cat" => "geometry"],

    // --- Batch 2: Volume & 3D ---
    "surface-area-of-a-pyramid-calculator" => ["title" => "Surface Area of a Pyramid", "icon" => "fas fa-mountain", "cat" => "geometry"],
    "surface-area-of-a-triangular-prism-calculator" => ["title" => "Surface Area of a Triangular Prism", "icon" => "fas fa-dice-d4", "cat" => "geometry"],
    "total-surface-area-calculator" => ["title" => "Total Surface Area Calculator", "icon" => "fas fa-th", "cat" => "geometry"],
    "volume-and-surface-area-calculator" => ["title" => "Volume and Surface Area Calculator", "icon" => "fas fa-cubes", "cat" => "geometry"],
    "volume-calculator" => ["title" => "General Volume Calculator", "icon" => "fas fa-ruler-combined", "cat" => "geometry"],
    "volume-of-a-cone-calculator" => ["title" => "Volume of a Cone Calculator", "icon" => "fas fa-cone", "cat" => "geometry"],
    "volume-of-a-cube-calculator" => ["title" => "Volume of a Cube Calculator", "icon" => "fas fa-cube", "cat" => "geometry"],
    "volume-of-a-cylinder-calculator" => ["title" => "Volume of a Cylinder Calculator", "icon" => "fas fa-database", "cat" => "geometry"],
    "volume-of-a-rectangular-prism-calculator" => ["title" => "Volume of a Rectangular Prism", "icon" => "fas fa-box", "cat" => "geometry"],
    "volume-of-a-sphere-calculator" => ["title" => "Volume of a Sphere Calculator", "icon" => "fas fa-baseball-ball", "cat" => "geometry"],
    "volume-of-a-triangular-prism-calculator" => ["title" => "Volume of a Triangular Prism", "icon" => "fas fa-shapes", "cat" => "geometry"],
    "volume-of-an-ellipsoid-calculator" => ["title" => "Volume of an Ellipsoid", "icon" => "fas fa-circle-notch", "cat" => "geometry"],
    "volume-of-a-pyramid-calculator" => ["title" => "Volume of a Pyramid", "icon" => "fas fa-mountain", "cat" => "geometry"],
    "volume-of-a-torus-calculator" => ["title" => "Volume of a Torus", "icon" => "fas fa-dot-circle", "cat" => "geometry"],
    "volume-of-a-trapezoidal-prism-calculator" => ["title" => "Volume of a Trapezoidal Prism", "icon" => "fas fa-building", "cat" => "geometry"],

    // --- Batch 3: Stats & Probability ---
    "markov-chain-steady-state-calculator" => ["title" => "Markov Chain Steady State", "icon" => "fas fa-project-diagram", "cat" => "stats"],
    "modular-multiplicative-inverse-calculator" => ["title" => "Modular Inverse Calculator", "icon" => "fas fa-percentage", "cat" => "math"],
    "percent-growth-rate-calculator" => ["title" => "Percent Growth Rate Calculator", "icon" => "fas fa-chart-line", "cat" => "finance"],
    "permutation-calculator" => ["title" => "Permutation Calculator (nPr)", "icon" => "fas fa-exchange-alt", "cat" => "math"],
    "pigeonhole-principle-calculator" => ["title" => "Pigeonhole Principle Calculator", "icon" => "fas fa-dove", "cat" => "math"],
    "poisson-distribution-calculator" => ["title" => "Poisson Distribution Calculator", "icon" => "fas fa-chart-bar", "cat" => "stats"],
    "polynomial-roots-calculator" => ["title" => "Polynomial Roots Calculator", "icon" => "fas fa-square-root-alt", "cat" => "math"],
    "probability-calculator" => ["title" => "Basic Probability Calculator", "icon" => "fas fa-dice", "cat" => "probability"],
    "probability-distribution-calculator" => ["title" => "Probability Distribution Calculator", "icon" => "fas fa-chart-area", "cat" => "stats"],
    "proportion-calculator" => ["title" => "Proportion Calculator", "icon" => "fas fa-balance-scale", "cat" => "math"],
    "quadratic-formula-calculator" => ["title" => "Quadratic Formula Calculator", "icon" => "fas fa-superscript", "cat" => "math"],
    "scientific-notation-calculator" => ["title" => "Scientific Notation Calculator", "icon" => "fas fa-flask", "cat" => "science"],
    "significant-figures-calculator" => ["title" => "Significant Figures Calculator", "icon" => "fas fa-crosshairs", "cat" => "science"],
    "sum-of-squares-calculator" => ["title" => "Sum of Squares Calculator", "icon" => "fas fa-plus-square", "cat" => "math"],
    "truth-table-generator" => ["title" => "Truth Table Generator", "icon" => "fas fa-table", "cat" => "math"]
];

foreach ($toolsToRegister as $slug => $meta) {
    if (!isset($engineConfig[$slug])) {
        echo "Warning: No engine config found for $slug. Skipping.\n";
        continue;
    }

    $proConfig = $engineConfig[$slug];

    $existingConfig[$slug] = [
        "title" => $meta["title"] . " - Pro Tools",
        "h1" => $meta["title"],
        "subtitle" => "Professional " . strtolower($meta["title"]) . " with step-by-step solutions.",
        "description" => "Free online " . $meta["title"] . " designed for " . $meta["cat"] . " precision and speed. Get instant results and detailed breakdowns.",
        "icon" => $meta["icon"],
        "category" => $meta["cat"],
        "processor" => "pro_calculator",
        "pro_config" => $proConfig
    ];
    echo "Registered $slug\n";
}

$output = "<?php\n\nreturn " . var_export($existingConfig, true) . ";\n";
file_put_contents($configFile, $output);
echo "Final count in pro_calculators.php: " . count($existingConfig) . "\n";
