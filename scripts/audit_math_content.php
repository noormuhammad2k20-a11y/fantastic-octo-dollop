<?php
$arr = include 'storage/seo_pages.php';
$math_slugs = [
    'common-factor-calculator',
    'cross-multiplication-calculator',
    'cube-root-calculator',
    'divide-into-two-parts',
    'divisibility-test-calculator',
    'find-min-max-calculator',
    'first-n-digits-of-e',
    'first-n-digits-of-pi',
    'greatest-common-factor-calculator',
    'prime-number-checker',
    'least-common-multiple-calculator',
    'long-division-calculator',
    'multiplication-calculator',
    'nth-root-calculator',
    'number-of-digits-calculator',
    'prime-factor-calculator',
    'prime-factorization-calculator',
    'quotient-remainder-calculator',
    'ratio-calculator',
    'sort-numbers-calculator',
    'sum-calculator'
];

foreach ($math_slugs as $slug) {
    if (isset($arr['pages'][$slug])) {
        $article = $arr['pages'][$slug]['article'] ?? '';
        $wc = str_word_count(strip_tags($article));
        echo "$slug: $wc words\n";
    } else {
        echo "$slug: NOT FOUND\n";
    }
}
