<?php
/**
 * Inject SEO Content for Advanced Math Tools (Batch 2)
 */

$newPages = [
    'central-limit-theorem-calculator' => [
        'tool_slug' => 'central-limit-theorem-calculator',
        'h1' => 'Central Limit Theorem (CLT) Calculator & Simulator',
        'title' => 'Central Limit Theorem Calculator - CLT Simulator | ToolsHub',
        'meta_description' => 'Visualize how sample means converge to a normal distribution. Adjust sample size and see the Power of CLT in real-time.',
        'article' => "## Understanding the Central Limit Theorem (CLT)

The **Central Limit Theorem (CLT)** is one of the most powerful concepts in statistics. It states that for a relatively large sample size, the distribution of the sample means will follow a normal distribution, regardless of the shape of the original population distribution. This allows statisticians to make inferences about a population even when the population's distribution is unknown.

## Everything You Need to Know About the CLT Calculator

Our **CLT Simulator** allows you to experiment with different sample sizes (*n*) and see how the grouping of means creates a bell curve. 

### Why the Sample Size Matters:
*   **Small Samples (n < 30):** The sampling distribution might still reflect the skewness of the original population.
*   **Large Samples (n ≥ 30):** The distribution consistently becomes symmetric and \"normal,\" which is the standard threshold for most statistical tests.

## Use Cases + Benefits

*   **Academic Learning:** A perfect visual aid for students studying probability and statistics.
*   **Data Science:** Understanding why many machine learning models assume normally distributed residuals.
*   **Quality Control:** Determining the range of acceptable variation in manufacturing processes.
*   **Survey Analysis:** Proving why a random sample of enough people can accurately represent a massive population.",
        'faq' => [
            ['q' => 'What is the "magic number" for CLT?', 'a' => 'Typically, a sample size of n=30 is considered sufficient for the theorem to hold.'],
            ['q' => 'Does the population have to be normal?', 'a' => 'No! That is the beauty of CLT; the population can be uniform, exponential, or even binomial.'],
            ['q' => 'What happens as n increases?', 'a' => 'As the sample size n increases, the standard error decreases, and the bell curve becomes narrower and taller.'],
            ['q' => 'Is this a real-time simulator?', 'a' => 'Yes, our engine runs thousands of random trials in your browser to generate the histogram instantly.'],
            ['q' => 'Which distributions can I test?', 'a' => 'You can test Uniform, Exponential, Bernoulli, and Normal distributions.']
        ],
        'instructions' => [
            'Choose a source distribution from the "Advanced Options".',
            'Select your sample size (n) using the slider.',
            'Set the number of samples to simulate (e.g., 1000).',
            'Watch the histogram results to see the Normal Distribution emerge.'
        ],
        'related_slugs' => ['normal-distribution-calculator', 'probability-calculator', 'binomial-probability-distribution-calculator'],
        'canonical' => '/tools/central-limit-theorem-calculator'
    ],
    'chinese-remainder-theorem-calculator' => [
        'tool_slug' => 'chinese-remainder-theorem-calculator',
        'h1' => 'Chinese Remainder Theorem (CRT) Solver',
        'title' => 'Chinese Remainder Theorem Calculator - solve x ≡ a mod n | ToolsHub',
        'meta_description' => 'Solve systems of simultaneous congruences using the Chinese Remainder Theorem. Fast calculator for modular arithmetic solutions.',
        'article' => "## What is the Chinese Remainder Theorem?

The **Chinese Remainder Theorem (CRT)** is a fundamental theorem in number theory. It states that if you know the remainders of an unknown number divided by several integers (moduli), and those moduli are pairwise coprime, you can uniquely determine the smallest positive integer that satisfies all those conditions.

## Everything You Need to Know About CRT

First recorded by the Chinese mathematician Sun Zi in the 3rd century, this theorem is used today in computing, cryptography, and large-number arithmetic. It provides a way to represent large integers as a set of smaller remainders, making calculations significantly faster in hardware implementations.

### Conditions for a Solution:
For the standard algorithm to work, the moduli (*n1, n2, n3...*) must be **pairwise coprime**, meaning the Greatest Common Divisor (GCD) of any two moduli must be 1.

## Use Cases + Benefits

*   **Cryptography:** Central to the RSA encryption algorithm for speeding up decryption and signing.
*   **Computer Arithmetic:** Breaking down calculations on massive numbers into parallel operations on smaller numbers.
*   **Secret Sharing:** Distributing data such that only a specific subset of people can reconstruct the original secret.
*   **Logic Puzzles:** Solving classical "riddle" style math problems involving cycles and remainders.",
        'faq' => [
            ['q' => 'What if the moduli are not coprime?', 'a' => 'If the moduli are not coprime, a solution might not exist, or it might not be unique within the product of the moduli.'],
            ['q' => 'Is the solution unique?', 'a' => 'Yes, the smallest positive solution is unique modulo the product of all moduli.'],
            ['q' => 'How many equations can this tool handle?', 'a' => 'This calculator handles up to 3 simultaneous congruences for common use cases.'],
            ['q' => 'Is this useful for RSA?', 'a' => 'Absolutely. RSA-CRT is a common optimization that makes RSA operations up to 4 times faster.'],
            ['q' => 'Does it show the steps?', 'a' => 'The calculator provides the mathematical result and the product N as a breakdown for validation.']
        ],
        'instructions' => [
            'Enter the remainder (a) for each equation.',
            'Enter the modulus (n) for each equation.',
            'Ensure the moduli are coprime (GCD = 1) for the best results.',
            'Click calculate to find the smallest positive value of x.'
        ],
        'related_slugs' => ['extended-euclidean-algorithm-calculator', 'gcd-calculator', 'prime-factorization-calculator'],
        'canonical' => '/tools/chinese-remainder-theorem-calculator'
    ],
    'combination-calculator' => [
        'tool_slug' => 'combination-calculator',
        'h1' => 'Combination Calculator (nCr)',
        'title' => 'Combination Calculator - Subset Finder | ToolsHub',
        'meta_description' => 'Calculate combinations (nCr) instantly. Find how many ways to choose r items from n without order. Fast and accurate.',
        'article' => "## What is a Combination Calculator?

A **Combination Calculator** is a mathematical tool that finds the number of ways to choose a subset of items from a larger pool where the **order of selection doesn't matter**. In mathematics, this is represented by the notation \"nCr\" (pronounced \"n choose r\").

## Everything You Need to Know About Combinations

Combinations differ from permutations because we don't care about the sequence. For example, if you are picking a starting 5 for a basketball team from a roster of 12, picking {A, B, C, D, E} is the same as picking {E, D, C, B, A}.

### The Rule of Thumb:
*   **Combinations:** Order doesn't matter (nCr).
*   **Permutations:** Order DOES matter (nPr).

### The Formula:
**nCr = n! / [r! * (n - r)!]**

## Use Cases + Benefits

*   **Lottery Selection:** Calculating the total possible number of ticket combinations.
*   **Project Management:** Finding how many different team pairings can be made.
*   **Biology:** Determining possible genetic combinations from a gene pool.
*   **Menu Planning:** Picking a set number of side dishes from a long list of options.",
        'faq' => [
            ['q' => 'What is the formula for combinations?', 'a' => 'nCr = n! / (r!(n-r)!)'],
            ['q' => 'What is 5C2?', 'a' => '5C2 = 10.'],
            ['q' => 'Is 10C3 the same as 10C7?', 'a' => 'Yes, because of the symmetry property of binomial coefficients.'],
            ['q' => 'Can r be greater than n?', 'a' => 'No, you cannot choose more items than the total number available in the pool.'],
            ['q' => 'How does this differ from Permutations?', 'a' => 'Permutations count different orders as separate results; combinations do not.']
        ],
        'instructions' => [
            'Input the total number of items (n).',
            'Input the number of items to choose (r).',
            'The result shows the total number of unique combinations.',
            'Review the insights for a breakdown of the mathematical significance.'
        ],
        'related_slugs' => ['binomial-coefficient-calculator', 'permutation-calculator', 'probability-tool'],
        'canonical' => '/tools/combination-calculator'
    ],
    'complementary-error-function-calculator' => [
        'tool_slug' => 'complementary-error-function-calculator',
        'h1' => 'erfc(x) – Complementary Error Function Solver',
        'title' => 'erfc(x) Calculator - Complementary Error Function | ToolsHub',
        'meta_description' => 'Calculate erfc(x) with high precision. Essential for error analysis, heat equations, and diffusion modeling.',
        'article' => "## What is the Complementary Error Function (erfc)?

The **Complementary Error Function**, denoted as **erfc(x)**, is a mathematical function defined as **1 - erf(x)**, where erf(x) is the Gauß error function. It represents the probability that a random variable following a normal distribution will fall outside the range [-x, x].

## Everything You Need to Know About erfc(x)

While the error function (erf) is standard in statistics, its complementary version (erfc) is particularly useful in engineering and physics, especially when dealing with the tails of a distribution or complex integration that involves boundary conditions.

### Key Characteristics:
*   **Limit at Infinity:** As x goes to infinity, erfc(x) approaches 0.
*   **Value at Zero:** erfc(0) = 1.
*   **Relationship to Normal Distribution:** It is directly related to the Q-function used in communications engineering.

## Use Cases + Benefits

*   **Heat Transfer:** Modeling temperature distributions in semi-infinite solids.
*   **Diffusion:** Calculating the concentration of molecules as they move through a medium.
*   **Signal Processing:** Estimating bit error rates (BER) in digital communications.
*   **Material Science:** Predicting the depth of chemical penetration during doping or surface treatment.",
        'faq' => [
            ['q' => 'What is the formula for erfc?', 'a' => 'erfc(x) = 1 - erf(x) = (2/√π) * ∫ exp(-t²) dt from x to ∞.'],
            ['q' => 'What is erfc(0)?', 'a' => 'erfc(0) equals 1.'],
            ['q' => 'Is it used in finance?', 'a' => 'Yes, it appears in certain variations of the Black-Scholes model for option pricing.'],
            ['q' => 'How accurate is this calculator?', 'a' => 'Our tool uses a highly precise numerical approximation (Chebyshev) to ensure 8+ decimal places of accuracy.'],
            ['q' => 'What is the difference between erf and erfc?', 'a' => 'erf gives the probability within a range; erfc gives the probability outside that range.']
        ],
        'instructions' => [
            'Enter the value of x into the input field.',
            'The engine will calculate the result instantly as you type.',
            'Observe the chart to see the exponential decay towards zero.',
            'Toggle the "Pro Mode" if you need to see intermediate erf values.'
        ],
        'related_slugs' => ['error-function-calculator', 'normal-distribution-calculator', 'exponential-decay-calculator'],
        'canonical' => '/tools/complementary-error-function-calculator'
    ],
    'complex-number-calculator' => [
        'tool_slug' => 'complex-number-calculator',
        'h1' => 'Complex Number Calculator (a + bi)',
        'title' => 'Complex Number Calculator - Imaginary Math Solver | ToolsHub',
        'meta_description' => 'Add, Multiply, and Divide complex numbers. Convert between rectangular and polar forms instantly with our free online tool.',
        'article' => "## What is a Complex Number Calculator?

A **Complex Number Calculator** is an advanced math tool capable of performing arithmetic operations on numbers that consist of a real part and an imaginary part (expressed as *a + bi*). It simplifies the often tedious process of complex multiplication and division.

## Everything You Need to Know About Complex Numbers

Complex numbers expand the standard 1D number line into a 2D \"Complex Plane.\" The imaginary unit *i* is defined by the property **i² = -1**, which allows us to find solutions to equations that have no real roots.

### Forms of Representation:
1.  **Rectangular Form:** expressed as *a + bi*.
2.  **Polar Form:** expressed via magnitude (*r*) and angle (*θ*), often written as *r ∠ θ* or *re^(iθ)*.

### Basic Operations:
*   **Addition:** Add real parts and imaginary parts separately.
*   **Multiplication:** Use the FOIL method, remembering that *i² = -1*.
*   **Division:** Multiply the numerator and denominator by the complex conjugate of the denominator.

## Use Cases + Benefits

*   **Electrical Engineering:** Analyzing impedances in AC circuits (capacitors, inductors).
*   **Aeronautics:** Modeling fluid dynamics and airflow over wings using conformal mapping.
*   **Physics:** Calculating wave functions and phase shifts in quantum mechanics.
*   **Signal Processing:** Using Fourier Transforms to shift between time and frequency domains.",
        'faq' => [
            ['q' => 'What is i squared?', 'a' => 'In complex math, i² is defined as -1.'],
            ['q' => 'How do you multiply (3+2i)(1-4i)?', 'a' => 'Result = 3 - 12i + 2i - 8i² = 3 - 10i + 8 = 11 - 10i.'],
            ['q' => 'Can it convert to polar form?', 'a' => 'Yes, our result panel automatically shows the magnitude and phase angle.'],
            ['q' => 'What is the "complex conjugate"?', 'a' => 'The conjugate of a + bi is a - bi. It is used to simplify division.'],
            ['q' => 'Is this tool free?', 'a' => 'Yes, ToolsHub offers this complex solver for free with no installation needed.']
        ],
        'instructions' => [
            'Enter the Real and Imaginary parts for Number A.',
            'Enter the Real and Imaginary parts for Number B.',
            'Select the desired operation (Add, Sub, Mul, Div).',
            'View the result in Rectangular, Polar, and Magnitude formats.'
        ],
        'related_slugs' => ['bitwise-calculator', 'antilog-calculator', 'continued-fraction-calculator'],
        'canonical' => '/tools/complex-number-calculator'
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
echo "Injected Batch 2 math tools into storage/seo_pages.php\n";
