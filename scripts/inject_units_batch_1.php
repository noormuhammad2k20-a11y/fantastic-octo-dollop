<?php

$tools_path = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$tools = include $tools_path;

if (!is_array($tools) || !isset($tools['tools'])) {
    die("Error: Invalid tools configuration structure.\n");
}

$units_batch = [
    // --- AREA ---
    'acres-to-hectares-converter' => [
        'title' => 'Acres to Hectares Converter - Fast Area Conversion',
        'h1' => 'Acres to Hectares Converter',
        'description' => 'Convert acres to hectares instantly with high precision.',
        'icon' => 'fas fa-vector-square',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Acres (ac)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.404686,
            'from_unit' => 'Acres',
            'to_unit' => 'Hectares',
            'unit_category' => 'Area'
        ]
    ],
    'hectares-to-acres-converter' => [
        'title' => 'Hectares to Acres Converter - Precise Land Measurement',
        'h1' => 'Hectares to Acres Converter',
        'description' => 'Convert hectares to acres quickly for land and property measurement.',
        'icon' => 'fas fa-draw-polygon',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Hectares (ha)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 2.47105,
            'from_unit' => 'Hectares',
            'to_unit' => 'Acres',
            'unit_category' => 'Area'
        ]
    ],
    // --- LENGTH ---
    'cm-to-feet-converter' => [
        'title' => 'Centimeters to Feet Converter',
        'h1' => 'Centimeters to Feet Converter',
        'description' => 'Convert centimeters to feet height and length units.',
        'icon' => 'fas fa-ruler-vertical',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Centimeters (cm)', 'type' => 'number', 'default' => 100]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.0328084,
            'from_unit' => 'cm',
            'to_unit' => 'ft',
            'unit_category' => 'Length'
        ]
    ],
    'cm-to-inches-converter' => [
        'title' => 'Centimeters to Inches Converter',
        'h1' => 'Centimeters to Inches',
        'description' => 'Convert cm to inches for everyday measurements.',
        'icon' => 'fas fa-ruler',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Centimeters (cm)', 'type' => 'number', 'default' => 2.54]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.393701,
            'from_unit' => 'cm',
            'to_unit' => 'inches',
            'unit_category' => 'Length'
        ]
    ],
    'meters-to-feet-converter' => [
        'title' => 'Meters to Feet Converter',
        'h1' => 'Meters to Feet',
        'description' => 'Convert meters to feet for height and construction.',
        'icon' => 'fas fa-ruler-combined',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Meters (m)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 3.28084,
            'from_unit' => 'meters',
            'to_unit' => 'feet',
            'unit_category' => 'Length'
        ]
    ],
    'meters-to-yards-converter' => [
        'title' => 'Meters to Yards Converter',
        'h1' => 'Meters to Yards',
        'description' => 'Convert meters to yards for fabric and sports field measurements.',
        'icon' => 'fas fa-tape',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Meters (m)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 1.09361,
            'from_unit' => 'meters',
            'to_unit' => 'yards',
            'unit_category' => 'Length'
        ]
    ],
    'km-to-miles-converter' => [
        'title' => 'Kilometers to Miles Converter',
        'h1' => 'Kilometers to Miles',
        'description' => 'Convert km to miles for distance and driving.',
        'icon' => 'fas fa-road',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Kilometers (km)', 'type' => 'number', 'default' => 5]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.621371,
            'from_unit' => 'km',
            'to_unit' => 'miles',
            'unit_category' => 'Distance'
        ]
    ],
    'miles-to-km-converter' => [
        'title' => 'Miles to Kilometers Converter',
        'h1' => 'Miles to Kilometers',
        'description' => 'Convert miles to km for navigation and international travel.',
        'icon' => 'fas fa-map-location-dot',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Miles (mi)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 1.60934,
            'from_unit' => 'miles',
            'to_unit' => 'km',
            'unit_category' => 'Distance'
        ]
    ],
    // --- WEIGHT ---
    'kg-to-pounds-converter' => [
        'title' => 'Kilograms to Pounds Converter',
        'h1' => 'Kilograms to Pounds',
        'description' => 'Convert kg to lbs for weight and fitness tracking.',
        'icon' => 'fas fa-weight-hanging',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Kilograms (kg)', 'type' => 'number', 'default' => 70]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 2.20462,
            'from_unit' => 'kg',
            'to_unit' => 'lbs',
            'unit_category' => 'Weight'
        ]
    ],
    'pounds-to-kg-converter' => [
        'title' => 'Pounds to Kilograms Converter',
        'h1' => 'Pounds to Kilograms',
        'description' => 'Convert lbs to kg for medical and international weight units.',
        'icon' => 'fas fa-scale-balanced',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Pounds (lbs)', 'type' => 'number', 'default' => 150]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.453592,
            'from_unit' => 'lbs',
            'to_unit' => 'kg',
            'unit_category' => 'Weight'
        ]
    ],
    'grams-to-ounces-converter' => [
        'title' => 'Grams to Ounces Converter',
        'h1' => 'Grams to Ounces',
        'description' => 'Convert grams to ounces for cooking and baking.',
        'icon' => 'fas fa-spoon',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Grams (g)', 'type' => 'number', 'default' => 28.35]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.035274,
            'from_unit' => 'grams',
            'to_unit' => 'ounces',
            'unit_category' => 'Weight'
        ]
    ],
    'ounces-to-grams-converter' => [
        'title' => 'Ounces to Grams Converter',
        'h1' => 'Ounces to Grams',
        'description' => 'Convert ounces to grams for precise ingredient measurement.',
        'icon' => 'fas fa-kitchen-set',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Ounces (oz)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 28.3495,
            'from_unit' => 'ounces',
            'to_unit' => 'grams',
            'unit_category' => 'Weight'
        ]
    ],
    // --- MASS ---
    'acres-to-sq-ft-converter' => [
        'title' => 'Acres to Square Feet Converter',
        'h1' => 'Acres to Square Feet',
        'description' => 'Convert acres to square feet for real estate and gardening.',
        'icon' => 'fas fa-house-chimney-window',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Acres (ac)', 'type' => 'number', 'default' => 1]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 43560,
            'from_unit' => 'acres',
            'to_unit' => 'sq ft',
            'unit_category' => 'Area'
        ]
    ],
    'sq-ft-to-sq-meters-converter' => [
        'title' => 'Square Feet to Square Meters',
        'h1' => 'Square Feet to Square Meters',
        'description' => 'Convert sq ft to sq m for interior design and flooring.',
        'icon' => 'fas fa-border-all',
        'category' => 'converters',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => ['basic' => [['id' => 'input_value', 'label' => 'Sq Ft', 'type' => 'number', 'default' => 100]]],
            'engine_formula' => 'unit_converter_calc',
            'conversion_factor' => 0.092903,
            'from_unit' => 'sq ft',
            'to_unit' => 'sq meters',
            'unit_category' => 'Area'
        ]
    ]
];

$tools['tools'] = array_merge($tools['tools'], $units_batch);

$content = "<?php\n\nreturn " . var_export($tools, true) . ";\n";
file_put_contents($tools_path, $content);
echo "Injected " . count($units_batch) . " unit converters.\n";
