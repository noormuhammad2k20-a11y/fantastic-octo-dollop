<?php

$tools_path = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$tools = include $tools_path;

$science_batch = [
    'ideal-gas-law-calculator' => [
        'title' => 'Ideal Gas Law Calculator - PV=nRT Solver',
        'h1' => 'Ideal Gas Law Calculator',
        'description' => 'Calculate P, V, n, or T using the Ideal Gas Law equation.',
        'icon' => 'fas fa-wind',
        'category' => 'science',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'solve_for', 'label' => 'Solve For', 'type' => 'select', 'options' => [
                        ['value' => 'p', 'label' => 'Pressure (P)'],
                        ['value' => 'v', 'label' => 'Volume (V)'],
                        ['value' => 'n', 'label' => 'Number of Moles (n)'],
                        ['value' => 't', 'label' => 'Temperature (T)']
                    ], 'default' => 'p'],
                    ['id' => 'pressure', 'label' => 'Pressure (atm)', 'type' => 'number', 'default' => 1],
                    ['id' => 'volume', 'label' => 'Volume (L)', 'type' => 'number', 'default' => 22.4],
                    ['id' => 'moles', 'label' => 'Moles (n)', 'type' => 'number', 'default' => 1],
                    ['id' => 'temp', 'label' => 'Temperature (K)', 'type' => 'number', 'default' => 273.15],
                ]
            ],
            'engine_formula' => 'gas_law_calc',
        ]
    ],
    'molar-mass-calculator' => [
        'title' => 'Molar Mass Calculator - Molecular Weight Tool',
        'h1' => 'Molar Mass Calculator',
        'description' => 'Calculate the molar mass (molecular weight) of chemical compounds.',
        'icon' => 'fas fa-vial',
        'category' => 'science',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'formula', 'label' => 'Chemical Formula', 'type' => 'text', 'default' => 'H2O'],
                ]
            ],
            'engine_formula' => 'molar_mass_calc',
        ]
    ],
    'grams-to-moles-calculator' => [
        'title' => 'Grams to Moles Calculator',
        'h1' => 'Grams to Moles',
        'description' => 'Convert grams of a substance to moles based on its molar mass.',
        'icon' => 'fas fa-microscope',
        'category' => 'science',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'grams', 'label' => 'Mass (grams)', 'type' => 'number', 'default' => 18.015],
                    ['id' => 'molar_mass', 'label' => 'Molar Mass (g/mol)', 'type' => 'number', 'default' => 18.015],
                ]
            ],
            'engine_formula' => 'grams_to_moles_calc',
        ]
    ],
    'chemical-equation-balancer' => [
        'title' => 'Chemical Equation Balancer - Step-by-Step',
        'h1' => 'Chemical Equation Balancer',
        'description' => 'Balance chemical reactions and equations automatically.',
        'icon' => 'fas fa-equals',
        'category' => 'science',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'equation', 'label' => 'Chemical Equation', 'type' => 'text', 'default' => 'H2 + O2 = H2O'],
                ]
            ],
            'engine_formula' => 'chem_balancer_calc',
        ]
    ]
];

$tools['tools'] = array_merge($tools['tools'], $science_batch);

$content = "<?php\n\nreturn " . var_export($tools, true) . ";\n";
file_put_contents($tools_path, $content);
echo "Injected " . count($science_batch) . " science tools.\n";
