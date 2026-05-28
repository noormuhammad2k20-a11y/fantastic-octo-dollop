<?php

$tools_path = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$tools = include $tools_path;

$units_batch = [
    // --- LENGTH / DISTANCE ---
    'feet-to-meters-converter' => [
        'title' => 'Feet to Meters Converter',
        'h1' => 'Feet to Meters',
        'description' => 'Convert feet to meters for height and construction measurements.',
        'icon' => 'fas fa-ruler-horizontal',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Feet (ft)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.3048,
            'from_unit' => 'feet',
            'to_unit' => 'meters',
            'unit_category' => 'Length'
        ]
    ],
    'inches-to-cm-converter' => [
        'title' => 'Inches to Centimeters Converter',
        'h1' => 'Inches to Centimeters',
        'description' => 'Convert inches to cm for hardware and small measurements.',
        'icon' => 'fas fa-ruler',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Inches (in)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 2.54,
            'from_unit' => 'inches',
            'to_unit' => 'cm',
            'unit_category' => 'Length'
        ]
    ],
    'yards-to-meters-converter' => [
        'title' => 'Yards to Meters Converter',
        'h1' => 'Yards to Meters',
        'description' => 'Convert yards to meters for sports and fabric.',
        'icon' => 'fas fa-tape',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Yards (yd)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.9144,
            'from_unit' => 'yards',
            'to_unit' => 'meters',
            'unit_category' => 'Length'
        ]
    ],
    // --- WEIGHT / MASS ---
    'ounces-to-pounds-converter' => [
        'title' => 'Ounces to Pounds Converter',
        'h1' => 'Ounces to Pounds',
        'description' => 'Convert ounces to pounds for parcel shipping and weight.',
        'icon' => 'fas fa-box',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Ounces (oz)', 'type' => 'number', 'default' => 16]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.0625,
            'from_unit' => 'ounces',
            'to_unit' => 'pounds',
            'unit_category' => 'Weight'
        ]
    ],
    'pounds-to-ounces-converter' => [
        'title' => 'Pounds to Ounces Converter',
        'h1' => 'Pounds to Ounces',
        'description' => 'Convert pounds to ounces for retail and weight.',
        'icon' => 'fas fa-scale-unbalanced',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Pounds (lbs)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 16,
            'from_unit' => 'pounds',
            'to_unit' => 'ounces',
            'unit_category' => 'Weight'
        ]
    ],
    // --- VOLUME (Liquid) ---
    'liters-to-gallons-converter' => [
        'title' => 'Liters to Gallons Converter (US)',
        'h1' => 'Liters to Gallons',
        'description' => 'Convert liters to US gallons for fuel and liquids.',
        'icon' => 'fas fa-gas-pump',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Liters (L)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.264172,
            'from_unit' => 'liters',
            'to_unit' => 'gallons',
            'unit_category' => 'Volume'
        ]
    ],
    'gallons-to-liters-converter' => [
        'title' => 'Gallons to Liters Converter',
        'h1' => 'Gallons to Liters',
        'description' => 'Convert US gallons to liters for international standards.',
        'icon' => 'fas fa-droplet',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Gallons (gal)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 3.78541,
            'from_unit' => 'gallons',
            'to_unit' => 'liters',
            'unit_category' => 'Volume'
        ]
    ],
    // --- DATA ---
    'mb-to-gb-converter' => [
        'title' => 'MB to GB Converter - Data Storage Tool',
        'h1' => 'Megabytes to Gigabytes',
        'description' => 'Convert MB to GB (Binary or Decimal).',
        'icon' => 'fas fa-hard-drive',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'MB (Decimal)', 'type' => 'number', 'default' => 1024]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.001,
            'from_unit' => 'MB',
            'to_unit' => 'GB',
            'unit_category' => 'Data'
        ]
    ],
    'gb-to-tb-converter' => [
        'title' => 'GB to TB Converter',
        'h1' => 'Gigabytes to Terabytes',
        'description' => 'Convert GB to TB for large data sets and cloud storage.',
        'icon' => 'fas fa-server',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'GB', 'type' => 'number', 'default' => 1000]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.001,
            'from_unit' => 'GB',
            'to_unit' => 'TB',
            'unit_category' => 'Data'
        ]
    ],
    // --- MISC ---
    'percent-to-decimal-converter' => [
        'title' => 'Percentage to Decimal Converter',
        'h1' => 'Percentage to Decimal',
        'description' => 'Quickly convert percentage values (e.g., 5%) to decimal format (0.05).',
        'icon' => 'fas fa-percent',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Percentage (%)', 'type' => 'number', 'default' => 5]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.01,
            'from_unit' => '%',
            'to_unit' => 'decimal',
            'unit_category' => 'Math'
        ]
    ],
    'decimal-to-percent-converter' => [
        'title' => 'Decimal to Percentage Converter',
        'h1' => 'Decimal to Percentage',
        'description' => 'Convert decimal values to a percentage for stats and reports.',
        'icon' => 'fas fa-chart-pie',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Decimal', 'type' => 'number', 'default' => 0.75]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 100,
            'from_unit' => 'decimal',
            'to_unit' => '%',
            'unit_category' => 'Math'
        ]
    ]
];

$tools['tools'] = array_merge($tools['tools'], $units_batch);

$content = "<?php\n\nreturn " . var_export($tools, true) . ";\n";
file_put_contents($tools_path, $content);
echo "Injected " . count($units_batch) . " additional unit converters.\n";
