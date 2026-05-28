<?php
/**
 * Inject all 20 remaining math tool configs into config/tools.php
 * Tools: Modular Inverse, Percent Growth, Permutation, Pigeonhole, Poisson,
 *        Polynomial Roots, Probability, Probability Distribution, Proportion,
 *        Quadratic, Scientific, Scientific Notation, Set Theory, Sig Figs,
 *        Stirling, Sum Cubes, Sum Integers, Sum Squares, Truth Table, Venn
 */

$configFile = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$config = include $configFile;

$newTools = [
    'modular-inverse-calculator' => [
        'title' => 'Modular Multiplicative Inverse Calculator',
        'h1' => 'Modular Multiplicative Inverse Calculator',
        'subtitle' => 'Find the modular inverse using the Extended Euclidean Algorithm.',
        'description' => 'Calculate the modular multiplicative inverse of a number. Essential for RSA cryptography and number theory.',
        'icon' => 'fas fa-key',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'a', 'label' => 'Number (a)', 'type' => 'number', 'default' => 3],
                    ['id' => 'm', 'label' => 'Modulus (m)', 'type' => 'number', 'default' => 11],
                ],
            ],
            'engine_formula' => 'mod_inverse_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'percent-growth-calculator' => [
        'title' => 'Percent Growth Rate Calculator - Change Analyzer',
        'h1' => 'Percent Growth Rate Calculator',
        'subtitle' => 'Calculate the percentage change between two values.',
        'description' => 'Find the growth or decline rate between an old and new value. Ideal for business KPIs, stocks, and data analysis.',
        'icon' => 'fas fa-chart-line',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'old_value', 'label' => 'Old Value', 'type' => 'number', 'default' => 200],
                    ['id' => 'new_value', 'label' => 'New Value', 'type' => 'number', 'default' => 350],
                ],
            ],
            'engine_formula' => 'percent_growth_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'permutation-calculator' => [
        'title' => 'Permutation Calculator (nPr) - Ordered Arrangement',
        'h1' => 'Permutation Calculator (nPr)',
        'subtitle' => 'Calculate ordered arrangements of r items from n.',
        'description' => 'Find the number of permutations (nPr). Unlike combinations, order matters in permutations.',
        'icon' => 'fas fa-sort-amount-down',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'n', 'label' => 'Total Items (n)', 'type' => 'number', 'default' => 10],
                    ['id' => 'r', 'label' => 'Items to Arrange (r)', 'type' => 'number', 'default' => 3],
                ],
            ],
            'engine_formula' => 'permutation_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'pigeonhole-calculator' => [
        'title' => 'Pigeonhole Principle Calculator - Distribution Tool',
        'h1' => 'Pigeonhole Principle Calculator',
        'subtitle' => 'Determine the guaranteed minimum items in a container.',
        'description' => 'Apply the Pigeonhole Principle (Dirichlet box) to find the minimum number of items that must share a container.',
        'icon' => 'fas fa-inbox',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'items', 'label' => 'Number of Items', 'type' => 'number', 'default' => 13],
                    ['id' => 'containers', 'label' => 'Number of Containers', 'type' => 'number', 'default' => 5],
                ],
            ],
            'engine_formula' => 'pigeonhole_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'poisson-distribution-calculator' => [
        'title' => 'Poisson Distribution Calculator - P(X=k) Solver',
        'h1' => 'Poisson Distribution Calculator',
        'subtitle' => 'Calculate the probability of k events in a fixed interval.',
        'description' => 'Compute exact Poisson probabilities and statistics. Model rare events like call center arrivals or server errors.',
        'icon' => 'fas fa-fish',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'lambda', 'label' => 'Average Rate (lambda)', 'type' => 'number', 'default' => 4],
                    ['id' => 'k', 'label' => 'Target Events (k)', 'type' => 'number', 'default' => 2],
                ],
            ],
            'engine_formula' => 'poisson_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'polynomial-roots-calculator' => [
        'title' => 'Polynomial Roots Calculator - Cubic & Quadratic',
        'h1' => 'Polynomial Roots Calculator',
        'subtitle' => 'Find roots of polynomials up to degree 3.',
        'description' => 'Solve linear, quadratic, and cubic polynomial equations. Uses the Quadratic Formula and Cardano method for cubics.',
        'icon' => 'fas fa-wave-square',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'coeff_a', 'label' => 'Coefficient a (x cubed)', 'type' => 'number', 'default' => 1],
                    ['id' => 'coeff_b', 'label' => 'Coefficient b (x squared)', 'type' => 'number', 'default' => -6],
                    ['id' => 'coeff_c', 'label' => 'Coefficient c (x)', 'type' => 'number', 'default' => 11],
                    ['id' => 'coeff_d', 'label' => 'Coefficient d (constant)', 'type' => 'number', 'default' => -6],
                ],
            ],
            'engine_formula' => 'polynomial_roots_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'probability-calculator' => [
        'title' => 'Probability Calculator - Event Likelihood Tool',
        'h1' => 'Probability Calculator',
        'subtitle' => 'Calculate the probability of a single event.',
        'description' => 'Find the probability, complement, and odds of a specific event occurring based on favorable and total outcomes.',
        'icon' => 'fas fa-dice',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'favorable', 'label' => 'Favorable Outcomes', 'type' => 'number', 'default' => 3],
                    ['id' => 'total', 'label' => 'Total Outcomes', 'type' => 'number', 'default' => 12],
                ],
            ],
            'engine_formula' => 'probability_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'probability-distribution-calculator' => [
        'title' => 'Probability Distribution Calculator - E(X) Solver',
        'h1' => 'Probability Distribution Calculator',
        'subtitle' => 'Calculate the expected value and variance of a discrete distribution.',
        'description' => 'Define up to 5 outcomes with their probabilities to compute the expected value E(X), variance, and standard deviation.',
        'icon' => 'fas fa-chart-bar',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'x1', 'label' => 'X1 Value', 'type' => 'number', 'default' => 1],
                    ['id' => 'p1', 'label' => 'P(X1)', 'type' => 'number', 'default' => 0.2],
                    ['id' => 'x2', 'label' => 'X2 Value', 'type' => 'number', 'default' => 2],
                    ['id' => 'p2', 'label' => 'P(X2)', 'type' => 'number', 'default' => 0.3],
                    ['id' => 'x3', 'label' => 'X3 Value', 'type' => 'number', 'default' => 3],
                    ['id' => 'p3', 'label' => 'P(X3)', 'type' => 'number', 'default' => 0.5],
                    ['id' => 'x4', 'label' => 'X4 Value', 'type' => 'number', 'default' => 0],
                    ['id' => 'p4', 'label' => 'P(X4)', 'type' => 'number', 'default' => 0],
                    ['id' => 'x5', 'label' => 'X5 Value', 'type' => 'number', 'default' => 0],
                    ['id' => 'p5', 'label' => 'P(X5)', 'type' => 'number', 'default' => 0],
                ],
            ],
            'engine_formula' => 'prob_dist_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'proportion-calculator' => [
        'title' => 'Proportion Calculator - Cross Multiply Solver',
        'h1' => 'Proportion Calculator',
        'subtitle' => 'Solve a/b = c/d for any missing variable.',
        'description' => 'Given three of four values in a proportion, find the missing one using cross multiplication. Ideal for recipes, maps, and scale models.',
        'icon' => 'fas fa-balance-scale',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'a', 'label' => 'Value a', 'type' => 'number', 'default' => 3],
                    ['id' => 'b', 'label' => 'Value b', 'type' => 'number', 'default' => 5],
                    ['id' => 'c', 'label' => 'Value c', 'type' => 'number', 'default' => 9],
                    ['id' => 'd', 'label' => 'Value d (Leave 0 to solve)', 'type' => 'number', 'default' => 0],
                ],
            ],
            'engine_formula' => 'proportion_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'quadratic-formula-calculator' => [
        'title' => 'Quadratic Formula Calculator - Ax2+Bx+C Solver',
        'h1' => 'Quadratic Formula Calculator',
        'subtitle' => 'Find the roots of any quadratic equation.',
        'description' => 'Solve ax2 + bx + c = 0 using the quadratic formula. Shows discriminant, roots (real or complex), and vertex coordinates.',
        'icon' => 'fas fa-superscript',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'a', 'label' => 'Coefficient a', 'type' => 'number', 'default' => 1],
                    ['id' => 'b', 'label' => 'Coefficient b', 'type' => 'number', 'default' => -5],
                    ['id' => 'c', 'label' => 'Coefficient c', 'type' => 'number', 'default' => 6],
                ],
            ],
            'engine_formula' => 'quadratic_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'scientific-calculator' => [
        'title' => 'Scientific Calculator - Expression Evaluator Online',
        'h1' => 'Scientific Calculator',
        'subtitle' => 'Evaluate complex mathematical expressions instantly.',
        'description' => 'Enter any math expression with sin, cos, tan, sqrt, log, ln, pi, e, and exponents. Supports standard and scientific notation output.',
        'icon' => 'fas fa-calculator',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'expression', 'label' => 'Expression (e.g. sin(pi/4) + 2^3)', 'type' => 'text', 'default' => 'sqrt(144) + 2^5'],
                ],
            ],
            'engine_formula' => 'scientific_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'scientific-notation-calculator' => [
        'title' => 'Scientific Notation Converter - Number Formatter',
        'h1' => 'Scientific Notation Calculator',
        'subtitle' => 'Convert any number to scientific notation.',
        'description' => 'Transform large or small numbers into standard scientific notation (coefficient x 10^n). Shows coefficient, exponent, and original form.',
        'icon' => 'fas fa-microscope',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'number', 'label' => 'Number', 'type' => 'number', 'default' => 93000000],
                ],
            ],
            'engine_formula' => 'sci_notation_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'set-theory-calculator' => [
        'title' => 'Set Theory Calculator - Union, Intersection, Diff',
        'h1' => 'Set Theory Calculator',
        'subtitle' => 'Perform set operations on two sets.',
        'description' => 'Compute Union, Intersection, and Difference of two sets entered as comma-separated values. Essential for discrete math.',
        'icon' => 'fas fa-object-group',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'set_a', 'label' => 'Set A (comma-separated)', 'type' => 'text', 'default' => '1,2,3,4,5'],
                    ['id' => 'set_b', 'label' => 'Set B (comma-separated)', 'type' => 'text', 'default' => '3,4,5,6,7'],
                ],
            ],
            'engine_formula' => 'set_theory_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'significant-figures-calculator' => [
        'title' => 'Significant Figures Calculator - Sig Figs Counter',
        'h1' => 'Significant Figures Calculator',
        'subtitle' => 'Count and round to significant figures.',
        'description' => 'Determine how many significant figures a number has. Provides rounded versions and scientific notation equivalents.',
        'icon' => 'fas fa-ruler-combined',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'number', 'label' => 'Number (e.g. 0.00450)', 'type' => 'text', 'default' => '0.00450'],
                ],
            ],
            'engine_formula' => 'sig_figs_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'stirling-numbers-calculator' => [
        'title' => 'Stirling Numbers Calculator - S(n,k) Partitions',
        'h1' => 'Stirling Numbers Calculator (Second Kind)',
        'subtitle' => 'Calculate the number of ways to partition n items into k non-empty subsets.',
        'description' => 'Find the Stirling number of the second kind S(n,k) using dynamic programming. Used in combinatorics and coding theory.',
        'icon' => 'fas fa-th',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'n', 'label' => 'Elements (n)', 'type' => 'number', 'default' => 5],
                    ['id' => 'k', 'label' => 'Subsets (k)', 'type' => 'number', 'default' => 3],
                ],
            ],
            'engine_formula' => 'stirling_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'sum-of-cubes-calculator' => [
        'title' => 'Sum of Cubes Calculator - Nicomachus Theorem',
        'h1' => 'Sum of Cubes Calculator',
        'subtitle' => 'Calculate 1 cubed + 2 cubed + ... + n cubed.',
        'description' => 'Compute the sum of cubes from 1 to n using the famous identity [n(n+1)/2] squared. Includes cross-references to sum of integers and squares.',
        'icon' => 'fas fa-cube',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'n', 'label' => 'n (upper limit)', 'type' => 'number', 'default' => 10],
                ],
            ],
            'engine_formula' => 'sum_cubes_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'sum-of-integers-calculator' => [
        'title' => 'Sum of Positive Integers Calculator - Gauss Formula',
        'h1' => 'Sum of Positive Integers Calculator',
        'subtitle' => 'Calculate 1 + 2 + 3 + ... + n instantly.',
        'description' => 'Uses Gauss formula n(n+1)/2 to find the sum of the first n positive integers. Lightning fast for any value of n.',
        'icon' => 'fas fa-plus-circle',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'n', 'label' => 'n (upper limit)', 'type' => 'number', 'default' => 100],
                ],
            ],
            'engine_formula' => 'sum_integers_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'sum-of-squares-calculator' => [
        'title' => 'Sum of Squares Calculator - Variance Tool',
        'h1' => 'Sum of Squares Calculator',
        'subtitle' => 'Calculate 1 squared + 2 squared + ... + n squared.',
        'description' => 'Compute the sum of squares from 1 to n using closed-form n(n+1)(2n+1)/6. Critical for statistics, regression, and ANOVA.',
        'icon' => 'fas fa-vector-square',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'n', 'label' => 'n (upper limit)', 'type' => 'number', 'default' => 10],
                ],
            ],
            'engine_formula' => 'sum_squares_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'truth-table-generator' => [
        'title' => 'Truth Table Generator - Logic Gate Solver',
        'h1' => 'Truth Table Generator',
        'subtitle' => 'Generate truth tables for logical operations.',
        'description' => 'Create the truth table for AND, OR, XOR, NAND, NOR, IMPLIES, and BICONDITIONAL operations on two boolean variables P and Q.',
        'icon' => 'fas fa-table',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'operation', 'label' => 'Operation', 'type' => 'select', 'default' => 'AND', 'options' => ['AND', 'OR', 'XOR', 'NAND', 'NOR', 'IMPLIES', 'BICONDITIONAL']],
                ],
            ],
            'engine_formula' => 'truth_table_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
    'venn-diagram-calculator' => [
        'title' => 'Venn Diagram Generator (3 Sets) - Set Visualizer',
        'h1' => 'Venn Diagram Generator (3 Sets)',
        'subtitle' => 'Calculate set sizes and overlaps for 3 sets.',
        'description' => 'Input region counts for 3-set Venn diagrams. Computes total union, individual set sizes, and pairwise/triple intersections.',
        'icon' => 'fas fa-circle-notch',
        'category' => 'math',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'only_a', 'label' => 'Only A', 'type' => 'number', 'default' => 10],
                    ['id' => 'only_b', 'label' => 'Only B', 'type' => 'number', 'default' => 8],
                    ['id' => 'only_c', 'label' => 'Only C', 'type' => 'number', 'default' => 12],
                    ['id' => 'ab', 'label' => 'A and B only', 'type' => 'number', 'default' => 3],
                    ['id' => 'ac', 'label' => 'A and C only', 'type' => 'number', 'default' => 4],
                    ['id' => 'bc', 'label' => 'B and C only', 'type' => 'number', 'default' => 2],
                    ['id' => 'abc', 'label' => 'A and B and C', 'type' => 'number', 'default' => 1],
                ],
            ],
            'engine_formula' => 'venn_calc',
        ],
        'accepted_types' => '',
        'max_size_mb' => 0,
    ],
];

// Merge into existing tools
foreach ($newTools as $slug => $tool) {
    $config['tools'][$slug] = $tool;
}

// Write back
$content = "<?php\n\nreturn " . var_export($config, true) . ";\n";
if (file_put_contents($configFile, $content)) {
    echo "SUCCESS: Injected 20 remaining tool configs.\n";
    echo "Total tools now: " . count($config['tools']) . "\n";
} else {
    echo "FAILED to write config.\n";
}
