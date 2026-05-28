<?php

$tools_path = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$tools = include $tools_path;

$lifestyle_batch = [
    'brick-calculator' => [
        'title' => 'Brick & Mortar Calculator - Masonry Tool',
        'h1' => 'Brick Calculator',
        'description' => 'Estimate the number of bricks and amount of mortar needed for your wall project.',
        'icon' => 'fas fa-trowel-bricks',
        'category' => 'construction',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'wall_length', 'label' => 'Wall Length (ft)', 'type' => 'number', 'default' => 10],
                    ['id' => 'wall_height', 'label' => 'Wall Height (ft)', 'type' => 'number', 'default' => 8],
                    ['id' => 'brick_type', 'label' => 'Brick Size', 'type' => 'select', 'options' => [
                        ['value' => 'standard', 'label' => 'Standard (8" x 2.25")'],
                        ['value' => 'king', 'label' => 'King (9.6" x 2.6")'],
                        ['value' => 'utility', 'label' => 'Utility (11.6" x 3.6")']
                    ], 'default' => 'standard'],
                ]
            ],
            'engine_formula' => 'brick_calc',
        ]
    ],
    'concrete-calculator' => [
        'title' => 'Concrete Slab & Footing Calculator',
        'h1' => 'Concrete Calculator',
        'description' => 'Calculate the volume of concrete needed for slabs, footings, and columns.',
        'icon' => 'fas fa-mountain-sun',
        'category' => 'construction',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'length', 'label' => 'Length (ft)', 'type' => 'number', 'default' => 10],
                    ['id' => 'width', 'label' => 'Width (ft)', 'type' => 'number', 'default' => 10],
                    ['id' => 'thickness', 'label' => 'Thickness (inches)', 'type' => 'number', 'default' => 4],
                ]
            ],
            'engine_formula' => 'concrete_calc',
        ]
    ],
    'sourdough-hydration-calculator' => [
        'title' => 'Sourdough Hydration Calculator - Baker\'s Tool',
        'h1' => 'Sourdough Hydration Calculator',
        'description' => 'Calculate the hydration percentage of your sourdough dough for perfect crust and crumb.',
        'icon' => 'fas fa-bread-slice',
        'category' => 'kitchen',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'flour', 'label' => 'Total Flour (g)', 'type' => 'number', 'default' => 500],
                    ['id' => 'water', 'label' => 'Total Water (g)', 'type' => 'number', 'default' => 350],
                    ['id' => 'starter_amount', 'label' => 'Starter (g)', 'type' => 'number', 'default' => 100],
                    ['id' => 'starter_hydration', 'label' => 'Starter Hydration (%)', 'type' => 'number', 'default' => 100],
                ]
            ],
            'engine_formula' => 'sourdough_calc',
        ]
    ],
    'pet-age-converter' => [
        'title' => 'Pet Age to Human Years Converter',
        'h1' => 'Pet Age Converter',
        'description' => 'Convert your dog or cat\'s age to human years based on size and breed standards.',
        'icon' => 'fas fa-paw',
        'category' => 'pets',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'pet_type', 'label' => 'Pet Type', 'type' => 'select', 'options' => [
                        ['value' => 'dog_small', 'label' => 'Small Dog (< 20 lbs)'],
                        ['value' => 'dog_medium', 'label' => 'Medium Dog (21-50 lbs)'],
                        ['value' => 'dog_large', 'label' => 'Large Dog (> 50 lbs)'],
                        ['value' => 'cat', 'label' => 'Cat']
                    ], 'default' => 'dog_medium'],
                    ['id' => 'pet_age', 'label' => 'Pet Age (Years)', 'type' => 'number', 'default' => 5],
                ]
            ],
            'engine_formula' => 'pet_age_calc',
        ]
    ]
];

$tools['tools'] = array_merge($tools['tools'], $lifestyle_batch);

$content = "<?php\n\nreturn " . var_export($tools, true) . ";\n";
file_put_contents($tools_path, $content);
echo "Injected " . count($lifestyle_batch) . " lifestyle tools.\n";
