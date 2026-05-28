<?php

$tools_path = 'd:/Xamp/htdocs/ToolsHub/config/tools.php';
$tools = include $tools_path;

$social_batch = [
    'instagram-engagement-rate-calculator' => [
        'title' => 'Instagram Engagement Rate Calculator - Influencer Tool',
        'h1' => 'Instagram Engagement Calculator',
        'description' => 'Calculate your Instagram engagement rate based on followers, likes, and comments.',
        'icon' => 'fab fa-instagram',
        'category' => 'marketing',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'followers', 'label' => 'Total Followers', 'type' => 'number', 'default' => 10000],
                    ['id' => 'likes', 'label' => 'Average Likes', 'type' => 'number', 'default' => 500],
                    ['id' => 'comments', 'label' => 'Average Comments', 'type' => 'number', 'default' => 50],
                ]
            ],
            'engine_formula' => 'insta_engagement_calc',
        ]
    ],
    'youtube-earnings-calculator' => [
        'title' => 'YouTube Earnings Calculator - Monetization Tool',
        'h1' => 'YouTube Earnings Calculator',
        'description' => 'Estimate your YouTube potential earnings based on views and CPM.',
        'icon' => 'fab fa-youtube',
        'category' => 'marketing',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'views', 'label' => 'Daily Video Views', 'type' => 'number', 'default' => 5000],
                    ['id' => 'cpm', 'label' => 'Estimated CPM ($)', 'type' => 'number', 'default' => 4],
                ]
            ],
            'engine_formula' => 'yt_earnings_calc',
        ]
    ],
    'cpm-calculator' => [
        'title' => 'CPM Calculator - Ad Cost Per Mille Tool',
        'h1' => 'CPM Calculator',
        'description' => 'Calculate the cost per 1,000 impressions for your advertising campaigns.',
        'icon' => 'fas fa-ad',
        'category' => 'marketing',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'cost', 'label' => 'Total Campaign Cost ($)', 'type' => 'number', 'default' => 500],
                    ['id' => 'impressions', 'label' => 'Total Impressions', 'type' => 'number', 'default' => 100000],
                ]
            ],
            'engine_formula' => 'cpm_calc',
        ]
    ],
    'roas-calculator' => [
        'title' => 'ROAS Calculator - Return on Ad Spend Tool',
        'h1' => 'ROAS Calculator',
        'description' => 'Measure the effectiveness of your advertising by calculating Return on Ad Spend.',
        'icon' => 'fas fa-chart-line',
        'category' => 'marketing',
        'type' => 'interactive',
        'processor' => 'pro_calculator',
        'pro_config' => [
            'mode' => 'pro',
            'inputs' => [
                'basic' => [
                    ['id' => 'revenue', 'label' => 'Total Revenue Genereated ($)', 'type' => 'number', 'default' => 2000],
                    ['id' => 'spend', 'label' => 'Total Ad Spend ($)', 'type' => 'number', 'default' => 500],
                ]
            ],
            'engine_formula' => 'roas_calc',
        ]
    ]
];

$tools['tools'] = array_merge($tools['tools'], $social_batch);

$content = "<?php\n\nreturn " . var_export($tools, true) . ";\n";
file_put_contents($tools_path, $content);
echo "Injected " . count($social_batch) . " social media tools.\n";
