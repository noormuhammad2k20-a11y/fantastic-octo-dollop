<?php
/**
 * Inject SEO Content for Advanced Math Tools (Batch 4)
 */

$newPages = [
    'euler-totient-calculator' => [
        'tool_slug' => 'euler-totient-calculator',
        'h1' => 'Euler\'s Totient Function Calculator – φ(n)',
        'title' => 'Euler Totient Calculator - φ(n) Coprime Solver | ToolsHub',
        'meta_description' => 'Calculate Euler\'s totient φ(n) instantly. Find the count of positive integers up to n that are relatively prime to n.',
        'article' => "## What is Euler's Totient Function?

**Euler's Totient Function**, denoted as **φ(n)** (phi of n), is a fundamental function in number theory. It counts the number of positive integers less than or equal to *n* that are **coprime** to *n*. Two numbers are coprime if their greatest common divisor (GCD) is 1.

## Everything You Need to Know About φ(n)

First introduced by Leonhard Euler, this function is a cornerstone of modern mathematics. For a prime number *p*, φ(p) is always *p - 1*, because all numbers less than a prime are coprime to it. For composite numbers, the value is calculated using the prime factorization of *n*.

### Euler's Product Formula:
**φ(n) = n * Π (1 - 1/p)**
Where the product is over all distinct prime factors *p* of *n*.

## Use Cases + Benefits

*   **Cryptography:** Powering the RSA encryption algorithm, where φ(n) is used to calculate the private key.
*   **Euler's Theorem:** A vital theorem in modular arithmetic that states a^φ(n) ≡ 1 (mod n) for coprime *a* and *n*.
*   **Group Theory:** Determining the number of generators in cyclic groups.
*   **Fraction Simplification:** Understanding the properties of reduced fractions within a specific range.",
        'faq' => [
            ['q' => 'What is φ(10)?', 'a' => 'φ(10) = 4. The numbers are {1, 3, 7, 9}.'],
            ['q' => 'What is the totient of a prime number?', 'a' => 'For any prime p, φ(p) = p - 1.'],
            ['q' => 'Is it used in Bitcoin?', 'a' => 'While Bitcoin uses Elliptic Curve Cryptography, the underlying field theory relies on these same number-theoretic principles.'],
            ['q' => 'What if n is 1?', 'a' => 'φ(1) is defined as 1.'],
            ['q' => 'Does this tool show the factors?', 'a' => 'The calculator provides the final totient count and the ratio of coprime numbers.']
        ],
        'instructions' => [
            'Input a positive integer (n).',
            'The tool calculates the totient value φ(n) instantly.',
            'Review the result and the "Relatively Prime %" breakdown.',
            'Use the result for RSA calculations or modular arithmetic problems.'
        ],
        'related_slugs' => ['chinese-remainder-theorem-calculator', 'gcd-calculator', 'prime-factorization-calculator'],
        'canonical' => '/tools/euler-totient-calculator'
    ],
    'exponential-decay-calculator' => [
        'tool_slug' => 'exponential-decay-calculator',
        'h1' => 'Exponential Decay & Half-Life Calculator',
        'title' => 'Exponential Decay Calculator - Half-Life Solver | ToolsHub',
        'meta_description' => 'Model exponential decay for science and finance. Calculate remaining amounts over time with real-time charts.',
        'article' => "## What is Exponential Decay?

**Exponential Decay** occurs when a quantity decreases at a rate proportional to its current value. Unlike linear decay, where the amount decreases by a set number every period, exponential decay means the quantity loses a fixed *percentage* over time, leading to a rapid initial drop that slows down as the value approaches zero.

## Everything You Need to Know About Decay

Exponential decay is mathematically expressed as **y = a(1 - r)^t**, where *a* is the initial amount, *r* is the decay rate, and *t* is the time period. 

### Common Examples:
*   **Radioactive Decay:** Atoms of unstable elements like Carbon-14 or Uranium breaking down over centuries.
*   **Depreciation:** The value of a new car or computer dropping significantly as soon as it leaves the store.
*   **Medicine:** How the concentration of a drug in the bloodstream decreases as it is processed by the body.

## Use Cases + Benefits

*   **Science Labs:** Calculating the remaining mass of a radioactive sample for dating or medical treatment.
*   **Finance:** Determining the future resale value of business assets or equipment.
*   **Demographics:** Modeling population decline in specific ecological niches.
*   **Chemistry:** Solving first-order reaction rate problems in chemical kinetics.",
        'faq' => [
            ['q' => 'What is the formula for decay?', 'a' => 'y = a(1 - r)^t, where r is the decay rate as a decimal.'],
            ['q' => 'What is a half-life?', 'a' => 'The time it takes for a quantity to decrease to exactly half of its initial value.'],
            ['q' => 'Can the rate be negative?', 'a' => 'If the rate is negative, it becomes Exponential Growth.'],
            ['q' => 'What happens as time goes to infinity?', 'a' => 'The value approaches zero but theoretically never reaches it (asymptotic behavior).'],
            ['q' => 'Does this tool show a graph?', 'a' => 'Yes, our engine generates a real-time decay curve to visualize the trend.']
        ],
        'instructions' => [
            'Enter the "Initial Amount" of the substance or value.',
            'Set the "Decay Rate" as a percentage (e.g., 10% per year).',
            'Input the "Time Periods" you wish to project.',
            'Observe the "Remaining Amount" and the downward decay chart.'
        ],
        'related_slugs' => ['exponential-growth-calculator', 'normal-distribution-calculator', 'half-life-calculator'],
        'canonical' => '/tools/exponential-decay-calculator'
    ],
    'exponential-growth-calculator' => [
        'tool_slug' => 'exponential-growth-calculator',
        'h1' => 'Exponential Growth & Compounding Calculator',
        'title' => 'Exponential Growth Calculator - Project Future Values | ToolsHub',
        'meta_description' => 'Calculate exponential growth for population, finance, and biology. Predict future values with interactive charts.',
        'article' => "## What is Exponential Growth?

**Exponential Growth** is a process where a quantity increases by a fixed percentage over equal increments of time. This results in the \"hockey stick\" curve, where growth starts slowly but becomes remarkably fast as the base value increases. It is the core principle behind compound interest and population explosions.

## Everything You Need to Know About Growth

The formula for growth is **y = a(1 + r)^t**. Because the growth rate is added to the whole (1 + r), the resulting value compounds upon itself in every time period.

### Why It Matters:
Exponential growth is often counter-intuitive. Small, consistent growth rates can lead to massive numbers over long periods. This is why financial advisors emphasize starting investments early—the power of compounding is the most reliable way to build wealth.

## Use Cases + Benefits

*   **Compound Interest:** Calculating how savings or investments will grow over decades.
*   **Biology:** Predicting the spread of bacteria in a petri dish or a virus in a population.
*   **Business:** Modeling user acquisition and revenue growth for scaling startups.
*   **Social Media:** Estimating the \"viral\" potential of content based on sharing rates.",
        'faq' => [
            ['q' => 'What is the "Rule of 72"?', 'a' => 'A quick way to estimate how long it takes to double your money: Divide 72 by the growth rate.'],
            ['q' => 'What is 5% growth over 10 years?', 'a' => 'It results in a total increase of approximately 62.8%.'],
            ['q' => 'Is population growth always exponential?', 'a' => 'It starts that way, but often becomes "Logistic" (S-shaped) as it reaches the carrying capacity of the environment.'],
            ['q' => 'Can it calculate daily growth?', 'a' => 'Yes, as long as the rate and time units (days, years, etc.) match.'],
            ['q' => 'How accurate is the chart?', 'a' => 'The chart is mathematically perfect based on your inputs, using high-precision JS math.']
        ],
        'instructions' => [
            'Input the "Initial Amount" (principal or starting value).',
            'Set the "Growth Rate" as a percentage (e.g., 7% per period).',
            'Enter the number of "Time Periods" for the projection.',
            'View the "Future Value" and the upward growth curve.'
        ],
        'related_slugs' => ['exponential-decay-calculator', 'compound-interest-calculator', 'roi-calculator'],
        'canonical' => '/tools/exponential-growth-calculator'
    ],
    'exponential-integral-calculator' => [
        'tool_slug' => 'exponential-integral-calculator',
        'h1' => 'Exponential Integral (Ei) Solver',
        'title' => 'Exponential Integral Calculator - Ei(x) Function | ToolsHub',
        'meta_description' => 'Solve the exponential integral Ei(x) for real values. High precision tool for physics and engineering students.',
        'article' => "## What is the Exponential Integral (Ei)?

The **Exponential Integral**, denoted as **Ei(x)**, is a special mathematical function defined by an integral. For real values of *x*, the function *Ei(x)* is defined as the Cauchy principal value of the integral from -∞ to *x* of **exp(t)/t dt**.

## Everything You Need to Know About Ei(x)

Unlike basic functions like Sine or Logarithm, the Exponential Integral cannot be expressed in terms of elementary functions. It is a "higher-level" function that arises in many complex physical and mathematical problems.

### Physical Significance:
*   **Heat Transfer:** Modeling the temperature response in a medium with a line heat source.
*   **Number Theory:** It is closely related to the Logarithmic Integral **Li(x)**, which is central to the Prime Number Theorem (estimating the number of primes less than x).
*   **Nuclear Physics:** Analyzing neutron transport and reactor dynamics.

## Use Cases + Benefits

*   **Astrophysics:** Calculating radiation transport in stellar atmospheres.
*   **Petroleum Engineering:** Predicting pressure distribution in oil and gas reservoirs.
*   **Fluid Dynamics:** Solving potential flow problems in specialized geometries.
*   **Mathematics Research:** Evaluating integrals that involve combinations of exponential and rational functions.",
        'faq' => [
            ['q' => 'What is the value of Ei(0)?', 'a' => 'Ei(0) is undefined and approaches negative infinity.'],
            ['q' => 'What is the integral formula?', 'a' => 'Ei(x) = ∫ (e^t / t) dt from -∞ to x.'],
            ['q' => 'Is it related to the Gamma function?', 'a' => 'Yes, for negative arguments, it is related to the incomplete Gamma function.'],
            ['q' => 'How precise is this calculator?', 'a' => 'Our tool uses power series expansions and asymptotic approximations to ensure high decimal precision.'],
            ['q' => 'Is this useful for undergraduate math?', 'a' => 'Yes, it is common in Advanced Engineering Mathematics and Differential Equations courses.']
        ],
        'instructions' => [
            'Enter a non-zero value for x.',
            'The engine will compute the principal value of the integral.',
            'Review the numeric result and the mathematical breakdown.',
            'Compare with exp(x) to see the scaling relationship.'
        ],
        'related_slugs' => ['error-function-calculator', 'gamma-function-calculator', 'normal-distribution-calculator'],
        'canonical' => '/tools/exponential-integral-calculator'
    ],
    'exponents-calculator' => [
        'tool_slug' => 'exponents-calculator',
        'h1' => 'Exponents & Powers Calculator (x^y)',
        'title' => 'Exponents Calculator - Solve x to the power of y | ToolsHub',
        'meta_description' => 'Calculate exponents, powers, and roots instantly. Supports negative, fractional, and large number calculations.',
        'article' => "## What is an Exponents Calculator?

An **Exponents Calculator** is a versatile tool designed to solve powers and roots. Whether you are raising a base number *x* to an integer power *y*, or finding the root of a number using fractional exponents, this calculator provides instant, high-precision results for even the most complex expressions.

## Everything You Need to Know About Powers

Exponents represent repeated multiplication. For example, **2³ (2 to the power of 3)** is 2 × 2 × 2 = 8. 

### Key Rules of Exponents:
1.  **Zero Rule:** Any non-zero number raised to the power of 0 is 1 (e.g., 5⁰ = 1).
2.  **Negative Rule:** A negative exponent means taking the reciprocal (e.g., 2⁻² = 1/2² = 1/4).
3.  **Fractional Rule:** A fractional exponent is a root (e.g., 9^(1/2) is the square root of 9, which is 3).

## Use Cases + Benefits

*   **Algebra Mastery:** Checking homework for linear and quadratic growth problems.
*   **Science:** Converting numbers into scientific notation (e.g., base 10).
*   **Finance:** Calculating time-value-of-money formulas that involve compounding.
*   **Computer Science:** Determining memory sizes (e.g., 2^10 = 1024 bytes) and bitwise limits.",
        'faq' => [
            ['q' => 'What is 2 to the power of 10?', 'a' => '2^10 = 1024.'],
            ['q' => 'How do you solve negative exponents?', 'a' => 'Move the base to the denominator and make the exponent positive (x^-y = 1/x^y).'],
            ['q' => 'What is the cube root of 27?', 'a' => 'It is 27^(1/3) = 3.'],
            ['q' => 'What is a "base"?', 'a' => 'The large number (x) that is being multiplied by itself.'],
            ['q' => 'Can it handle decimals?', 'a' => 'Yes, you can use decimals for both the base and the exponent.']
        ],
        'instructions' => [
            'Enter the "Base" (the number you want to multiply).',
            'Enter the "Exponent" (the power or root).',
            'View the result in standard and scientific notation.',
            'Read the insights to understand the reciprocal or root equivalent.'
        ],
        'related_slugs' => ['bitwise-calculator', 'antilog-calculator', 'factorial-calculator'],
        'canonical' => '/tools/exponents-calculator'
    ]
];

$seoFile = __DIR__ . '/../storage/seo_pages.php';
$existing = include $seoFile;

if (!isset($existing['pages'])) {
    $existing['pages'] = [];
}

foreach ($newPages as $slug => $data) {
    $existing['pages'][$slug] = $data;
}

$export = var_export($existing, true);
$content = "<?php\n\nreturn " . $export . ";\n";

file_put_contents($seoFile, $content);
echo "Injected Batch 4 math tools into storage/seo_pages.php\n";
