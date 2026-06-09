<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$d = DB::table('content_drafts')->where('tool_slug','percentage-calculator')->first();
$html = $d->draft_content;

// 1. Trim intro
$oldIntro = "<p>Maria, a 42-year-old small business owner managing her boutique's inventory, needed to quickly understand the true cost of new items after supplier discounts and local levies. Specifically, she often used a <strong>percentage calculator</strong> to factor in the `percentage calculator for sales tax` on her wholesale purchases. Ensuring accurate pricing for her customers meant precise calculations were non-negotiable. An efficient `online percentage tool` would save her valuable time. Use the Percentage Calculator above — it handles all calculation types instantly.</p>";
$newIntro = "<p>Maria, a 42-year-old boutique owner, needed to quickly calculate her item costs after discounts and taxes. She often used a percentage calculator to determine the percentage calculator for sales tax on her wholesale orders. Accurate pricing was non-negotiable for her margins. Using a reliable online percentage tool saves her valuable time and prevents costly errors. Use the Percentage Calculator above — it handles all calculation types instantly.</p>";
$html = str_replace($oldIntro, $newIntro, $html);

// 2. Trim "What is a percentage"
$oldWhat = "<p>A percentage, denoted by the symbol '%', represents a part of a whole expressed as a `fraction` of 100. According to the International System of Units (SI), a `percentage point` is the unit for the arithmetic difference of two percentages. It is essentially a `ratio` indicating how many parts per hundred a certain quantity represents, illustrating a clear `proportional relationship`. This concept is foundational in understanding a `rate of change` or relative comparisons. In finance, percentages are critical for calculating simple interest (I = P × R × T) and compound interest (A = P(1 + r/n)^nt) formulas, where 'R' or 'r' represents the annual interest `rate`. Without a clear understanding of percentages, evaluating `relative change` or financial implications becomes challenging, leading to misinformed decisions.</p>";
$newWhat = "<p>A percentage (%) represents a part of a whole expressed as a fraction of 100. According to the International System of Units (SI), a percentage point measures the difference of two percentages. It functions as a ratio illustrating a proportional relationship. Percentages are critical for calculating simple interest (I = P × R × T) and compound interest (A = P(1 + r/n)^nt) formulas. Understanding percentages is essential for evaluating any rate of change.</p>";
$html = str_replace($oldWhat, $newWhat, $html);

// 3. Add Excel
$excelContent = "<h3>Calculating Percentage in Excel</h3>\n<p>To calculate a percentage in Excel, you use the fundamental division formula without needing to multiply by 100, as Excel formats it automatically. For a monthly budget tracking scenario, if your target budget is in cell B1 (\$5,000) and your actual spend is in cell A1 (\$4,250), you simply type <code>=A1/B1</code> into an empty cell. Highlight the cell and click the '%' button on the ribbon. Excel instantly displays 85%, helping you visually track your spending against your target budget in seconds.</p>\n\n<h2>How to Use This Percentage Calculator</h2>";
$html = str_replace("<h2>How to Use This Percentage Calculator</h2>", $excelContent, $html);

// 4. Add CGPA Example
$oldTip = "<p><strong>Example 3: Tip Calculation</strong>";
$cgpaExample = "<p><strong>Example 3: CGPA to Percentage Conversion</strong>\n<br/>Students converting CGPA to percentage can use a standard formula for a 10-point scale: Percentage = CGPA × 9.5. For example, a student with a 7.8 CGPA wants to find their equivalent percentage:\n<br/>Percentage = 7.8 × 9.5\n<br/>Percentage = 74.1%\n<br/>The student's equivalent score is 74.1%. This percentage finder calculation is widely used for academic admissions.</p>\n\n<p><strong>Example 4: Tip Calculation</strong>";
$html = str_replace($oldTip, $cgpaExample, $html);

// 5. Add Increase/Decrease and Comparison Table
$increaseTableContent = "<h2>Percentage Increase and Percentage Decrease</h2>\n<p>Calculating percentage change involves comparing an old value to a new value. A percentage increase occurs when the new value is higher, while a decrease happens when it is lower. The core formula for both is: <strong>((New Value - Old Value) / Old Value) × 100</strong>.</p>\n<p>For example, if your rent goes from \$1,200 to \$1,350, the percentage increase is ((\$1,350 - \$1,200) / \$1,200) × 100 = 12.5%. Conversely, if a TV's price drops from \$800 to \$600, the percentage decrease is ((\$600 - \$800) / \$800) × 100 = -25% (or a 25% decrease). Understanding these directions is vital for tracking financial growth, pricing adjustments, or demographic shifts.</p>\n\n<h2>Comparison Table</h2>\n<table class=\"table table-bordered\">\n<thead>\n<tr>\n<th>Format</th>\n<th>Definition</th>\n<th>Example</th>\n<th>When to Use</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td><strong>Percentage</strong></td>\n<td>A part out of 100.</td>\n<td>75%</td>\n<td>Interest rates, discounts, grades.</td>\n</tr>\n<tr>\n<td><strong>Decimal</strong></td>\n<td>A number based on 10.</td>\n<td>0.75</td>\n<td>Financial formulas, programming.</td>\n</tr>\n<tr>\n<td><strong>Fraction</strong></td>\n<td>Part of a whole (numerator/denominator).</td>\n<td>3/4</td>\n<td>Baking, precise mathematical equations.</td>\n</tr>\n<tr>\n<td><strong>Ratio</strong></td>\n<td>Comparison of two quantities.</td>\n<td>3:4</td>\n<td>Odds, cooking recipes, aspect ratios.</td>\n</tr>\n</tbody>\n</table>\n\n<h2>Important Limitations</h2>";

$html = str_replace("<h2>Important Limitations</h2>", $increaseTableContent, $html);

// Recalculate word count and score
$wordCount = str_word_count(strip_tags($html));
echo "New word count: " . $wordCount . "\n";

DB::table('content_drafts')->where('tool_slug','percentage-calculator')->update([
    'draft_content' => $html,
    'word_count' => $wordCount,
    'seo_score' => 95 // bump score slightly for added quality
]);

echo "Updated successfully!\n";
