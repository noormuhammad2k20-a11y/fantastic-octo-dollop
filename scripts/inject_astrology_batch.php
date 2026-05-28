<?php

$tools_path = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$tools = include $tools_path;

$astrology_batch = [
    'life-path-number-calculator' => [
        'title' => 'Life Path Number Calculator - Numerology Tool',
        'h1' => 'Life Path Number Calculator',
        'description' => 'Discover your Life Path number and what it reveals about your destiny.',
        'icon' => 'fas fa-dna',
        'category' => 'astrology',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'birth_date', 'label' => 'Birth Date', 'type' => 'date', 'default' => '1990-01-01'],
                ]
            ],
            'engine_formula' => 'life_path_calc',
        ]
    ],
    'chinese-zodiac-calculator' => [
        'title' => 'Chinese Zodiac Calculator - Year of the...',
        'h1' => 'Chinese Zodiac Calculator',
        'description' => 'Find your Chinese Zodiac sign and element based on your birth year.',
        'icon' => 'fas fa-dragon',
        'category' => 'astrology',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'birth_year', 'label' => 'Birth Year', 'type' => 'number', 'default' => 2000],
                ]
            ],
            'engine_formula' => 'chinese_zodiac_calc',
        ]
    ],
    'destiny-number-calculator' => [
        'title' => 'Destiny Number Calculator - Name Numerology',
        'h1' => 'Destiny Number Calculator',
        'description' => 'Calculate your Destiny Number based on the letters in your full name.',
        'icon' => 'fas fa-signature',
        'category' => 'astrology',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'full_name', 'label' => 'Full Name', 'type' => 'text', 'default' => 'John Doe'],
                ]
            ],
            'engine_formula' => 'destiny_number_calc',
        ]
    ],
    'moon-sign-calculator' => [
        'title' => 'Moon Sign Calculator - Emotional Core Tool',
        'h1' => 'Moon Sign Calculator',
        'description' => 'A simplified moon sign calculator based on your birth date and time.',
        'icon' => 'fas fa-moon',
        'category' => 'astrology',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'birth_date', 'label' => 'Birth Date', 'type' => 'date', 'default' => '1990-05-15'],
                    ['id' => 'birth_time', 'label' => 'Birth Time (Approx)', 'type' => 'time', 'default' => '12:00'],
                ]
            ],
            'engine_formula' => 'moon_sign_calc',
        ]
    ]
];

$tools['tools'] = array_merge($tools['tools'], $astrology_batch);

$content = "<?php\n\nreturn " . var_export($tools, true) . ";\n";
file_put_contents($tools_path, $content);
echo "Injected " . count($astrology_batch) . " astrology tools.\n";
