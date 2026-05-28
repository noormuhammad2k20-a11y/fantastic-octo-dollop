<?php
/**
 * Master SEO Injection Script - ALL 25 Advanced Math Tools
 * This script ensures all metadata, articles, and FAQs are correctly synced.
 */

$newPages = [
    // BATCH 1
    'antilog-calculator' => [
        'tool_slug' => 'antilog-calculator',
        'h1' => 'Antilog Calculator – Inverse Logarithm Solver',
        'title' => 'Antilog Calculator - Calculate Inverse Logarithm | ToolsHub',
        'meta_description' => 'Calculate the antilogarithm of any number with base 10, e, or custom bases instantly. Fast, accurate, and free tool.',
        'article' => "## What is an Antilog Calculator?

An **Antilog Calculator** find the inverse of a logarithm. If you know that log_b(x) = y, then the antilog is b^y = x. This tool is essential for reversing logarithmic scales and performing complex exponential math.

## Everything You Need to Know

The antilogarithm is frequently used in chemistry (pH scales), acoustics (decibels), and finance (compounding interest). Our tool supports:
- **Common Antilog:** Base 10.
- **Natural Antilog:** Base e (2.718...).
- **Custom Bases:** Any positive base you specify.

## Use Cases + Benefits
- **Science:** Converting pH values back to hydrogen ion concentration.
- **Engineering:** Reversing signal-to-noise ratios from dB to absolute power.
- **Academic:** Solving algebraic equations where variables are trapped in logs.",
        'faq' => [
            ['q' => 'What is the antilog of 2 base 10?', 'a' => 'The antilog of 2 with base 10 is 10^2 = 100.'],
            ['q' => 'Is antilog the same as exponentiation?', 'a' => 'Yes, antilog_b(y) is exactly b raised to the power of y.'],
            ['q' => 'What is a natural antilog?', 'a' => 'A natural antilog uses Euler’s number (e ≈ 2.71828) as the base.'],
            ['q' => 'Why use logs instead of absolute numbers?', 'a' => 'Log scales compress massive ranges (like earthquake intensity) into manageable numbers.'],
            ['q' => 'Is this tool free?', 'a' => 'Yes, all calculations are performed instantly in your browser for free.']
        ],
        'instructions' => [
            'Enter the value of the logarithm you want to reverse.',
            'Select or enter the base (default is 10).',
            'The result is calculated instantly as you type.',
            'Check the insights for a breakdown of the calculation.'
        ],
        'related_slugs' => ['log-calculator', 'exponents-calculator', 'complex-number-calculator'],
        'canonical' => '/tools/antilog-calculator'
    ],
    'beta-function-calculator' => [
        'tool_slug' => 'beta-function-calculator',
        'h1' => 'Beta Function Calculator – B(x, y) Solver',
        'title' => 'Beta Function Calculator - Euler Integral Type I | ToolsHub',
        'meta_description' => 'Calculate the Beta function B(x, y) instantly. High precision tool for statistics, physics, and advanced calculus.',
        'article' => "## What is the Beta Function?

The **Beta Function**, also known as the Euler integral of the first kind, is a special function defined for complex numbers with positive real parts. It is closely related to the Gamma function and plays a critical role in calculus and statistics.

## Use Cases + Benefits
- **Statistics:** Defining the Beta distribution, used for Bayesian inference and modeling probabilities.
- **Physics:** Essential in string theory and fluid mechanics.
- **Math:** Simplifying complex integrals and binomial coefficients.

## Key Properties
B(x, y) = Γ(x)Γ(y) / Γ(x+y). This relationship allows for high-precision calculations using Gamma function approximations.",
        'faq' => [
            ['q' => 'What is the Beta function used for?', 'a' => 'It is primarily used in statistics for the Beta distribution and in calculus for solving integrals.'],
            ['q' => 'How is it related to Gamma?', 'a' => 'B(x, y) = (Γ(x) * Γ(y)) / Γ(x + y).'],
            ['q' => 'Is it symmetric?', 'a' => 'Yes, B(x, y) = B(y, x).'],
            ['q' => 'What is B(1, 1)?', 'a' => 'B(1, 1) = 1.'],
            ['q' => 'Can x and y be decimals?', 'a' => 'Yes, the Beta function is defined for all positive real numbers.']
        ],
        'instructions' => [
            'Enter the value for x.',
            'Enter the value for y.',
            'The tool will calculate the exact Beta value using the Gamma relationship.',
            'Review the sub-stats for the intermediate calculation parts.'
        ],
        'related_slugs' => ['gamma-function-calculator', 'binomial-distribution-calculator', 'error-function-calculator'],
        'canonical' => '/tools/beta-function-calculator'
    ],
    'binomial-coefficient-calculator' => [
        'tool_slug' => 'binomial-coefficient-calculator',
        'h1' => 'Binomial Coefficient Calculator (n choose k)',
        'title' => 'Binomial Coefficient Calculator - nCr Solver | ToolsHub',
        'meta_description' => 'Calculate nCr (n choose k) instantly. Find binomial coefficients for probability and Pascal’s triangle.',
        'article' => "## What is the Binomial Coefficient?

The **Binomial Coefficient** is the number of ways to choose *k* items from *n* items without regard to order. It is also known as the \"combination\" function.

## Fast & Accurate nCr
Calculating large coefficients manually is error-prone. Our tool uses iterative logic to handle large values without overflow, providing the exact count for your probability models or expansion problems.

## Use Cases
- **Probability:** Finding the number of ways specific outcomes can occur.
- **Algebra:** Expanding polynomials using the Binomial Theorem.
- **Computer Science:** Powering algorithms for data selection and pathfinding.",
        'faq' => [
            ['q' => 'What does nCr mean?', 'a' => 'It stands for \"n choose r,\" representing the number of combinations.'],
            ['q' => 'What is the formula?', 'a' => 'n! / (k!(n-k)!)'],
            ['q' => 'What is 5C2?', 'a' => '5 choose 2 is 10.'],
            ['q' => 'Is nCr related to Pascal’s triangle?', 'a' => 'Yes, the value of nCr is exactly the number at row n and position r in the triangle.'],
            ['q' => 'Can k be larger than n?', 'a' => 'No, you cannot choose more items than the total available in the set.']
        ],
        'instructions' => [
            'Enter the total number of items (n).',
            'Enter the number of items to choose (k).',
            'View the result and the total number of permutations (nPr) for comparison.',
            'Read the insights to learn about the probability context.'
        ],
        'related_slugs' => ['combination-calculator', 'permutation-calculator', 'factorial-calculator'],
        'canonical' => '/tools/binomial-coefficient-calculator'
    ],
    'binomial-probability-calculator' => [
        'tool_slug' => 'binomial-probability-calculator',
        'h1' => 'Binomial Probability Calculator – n, k, p Solver',
        'title' => 'Binomial Probability Calculator - Find P(X=k) | ToolsHub',
        'meta_description' => 'Calculate binomial probabilities instantly. Find the likelihood of exactly k successes in n trials with probability p.',
        'article' => "## What is Binomial Probability?

**Binomial Probability** measures the likelihood of a specific number of \"successes\" in a fixed number of independent \"trials,\" where each trial has only two outcomes (success/failure).

## How to use the Calculator
- **n:** Number of trials (e.g., flipping a coin 10 times).
- **k:** Number of successes (e.g., getting exactly 5 heads).
- **p:** Probability of success on a single trial (e.g., 0.5 for a fair coin).

## Use Cases
- **Business:** Calculating the success rate of a cold call campaign.
- **Health:** Estimating the efficacy of a treatment across a group.
- **Games:** Finding the odds of winning a set number of rounds in a tournament.",
        'faq' => [
            ['q' => 'What are the conditions for a binomial distribution?', 'a' => 'Fixed trials, independent events, two possible outcomes, and constant probability.'],
            ['q' => 'What is p?', 'a' => 'p is the probability of success, ranging from 0 to 1.'],
            ['q' => 'How is the mean calculated?', 'a' => 'Mean = n * p.'],
            ['q' => 'Can this tool calculate cumulative probability?', 'a' => 'This tool focuses on the exact P(X=k) result.'],
            ['q' => 'Can n be very large?', 'a' => 'Our engine handles up to 500 trials with precision.']
        ],
        'instructions' => [
            'Input the number of trials (n).',
            'Input the number of successes (k).',
            'Input the success probability (p, between 0 and 1).',
            'The result and the expected value (mean) will be displayed.'
        ],
        'related_slugs' => ['normal-distribution-calculator', 'probability-calculator', 'binomial-coefficient-calculator'],
        'canonical' => '/tools/binomial-probability-calculator'
    ],
    'bitwise-calculator' => [
        'tool_slug' => 'bitwise-calculator',
        'h1' => 'Bitwise Calculator – Binary Operations Tool',
        'title' => 'Bitwise Calculator - AND, OR, XOR, NOT, Shift | ToolsHub',
        'meta_description' => 'Perform bitwise operations on bits and integers. Fast tool for AND, OR, XOR, NOT, and bit shifting (L/R).',
        'article' => "## What is a Bitwise Calculator?

A **Bitwise Calculator** performs operations on the individual bits of a number rather than its decimal value. This is fundamental to low-level programming, cryptography, and logic design.

## Supported Operations
- **AND (&):** Result is 1 only if both bits are 1.
- **OR (|):** Result is 1 if at least one bit is 1.
- **XOR (^):** Result is 1 if bits are different.
- **NOT (~):** Inverts all bits.
- **Shifts (<< / >>):** Moves bits to the left or right.

## Why use Bitwise Math?
- **Speed:** Bitwise operations are significantly faster than multiplication/division at the CPU level.
- **Flags:** Efficiently storing multiple boolean values in a single integer using bitmasking.
- **Encryption:** Powering complex data scrambling algorithms like AES.",
        'faq' => [
            ['q' => 'What is XOR used for?', 'a' => 'XOR is used in parity checks and as a basic building block for encryption.'],
            ['q' => 'How does bit shifting work?', 'a' => 'Shift left (<<) multiplies by 2; shift right (>>) divides by 2 (floored).'],
            ['q' => 'What is a bitmask?', 'a' => 'A bitmask is data used with bitwise AND/OR to select or toggle specific bits.'],
            ['q' => 'Does this tool support 32-bit integers?', 'a' => 'Yes, it handles standard 32-bit signed and unsigned operations.'],
            ['q' => 'Can I see the binary result?', 'a' => 'The calculator shows the result in both decimal and binary formats.']
        ],
        'instructions' => [
            'Enter the first number.',
            'Select the operation (AND, OR, XOR, etc.).',
            'Enter the second number (if required).',
            'Review the decimal result and its binary representation.'
        ],
        'related_slugs' => ['binary-converter', 'hex-calculator', 'entropy-calculator'],
        'canonical' => '/tools/bitwise-calculator'
    ],

    // BATCH 2
    'central-limit-theorem-calculator' => [
        'tool_slug' => 'central-limit-theorem-calculator',
        'h1' => 'Central Limit Theorem (CLT) Calculator & Simulator',
        'title' => 'Central Limit Theorem Calculator - CLT Simulator | ToolsHub',
        'meta_description' => 'Visualize how sample means converge to a normal distribution. Adjust sample size and see the Power of CLT in real-time.',
        'article' => "## Understanding the Central Limit Theorem (CLT)

The **Central Limit Theorem (CLT)** states that for a relatively large sample size, the distribution of the sample means will follow a normal distribution, regardless of the shape of the original population distribution.

## Why the Sample Size Matters
- **Small Samples (n < 30):** The sampling distribution might still reflect the skewness of the original population.
- **Large Samples (n >= 30):** The distribution consistently becomes symmetric and \"normal,\" which is the standard threshold for most statistical tests.

## Use Cases
- **Academic Learning:** A perfect visual aid for students studying probability and statistics.
- **Data Science:** Understanding why many models assume normally distributed residuals.
- **Quality Control:** Determining the range of acceptable variation in manufacturing.",
        'faq' => [
            ['q' => 'What is the "magic number" for CLT?', 'a' => 'Typically, a sample size of n=30 is considered sufficient.'],
            ['q' => 'Does the population have to be normal?', 'a' => 'No! The population can be uniform, exponential, or even binomial.'],
            ['q' => 'What happens as n increases?', 'a' => 'The standard error decreases, and the bell curve becomes narrower.'],
            ['q' => 'Is this a real-time simulator?', 'a' => 'Yes, our engine runs thousands of random trials instantly.'],
            ['q' => 'Which distributions can I test?', 'a' => 'Uniform, Exponential, Bernoulli, and Normal.']
        ],
        'instructions' => [
            'Choose a source distribution.',
            'Select your sample size (n) using the slider.',
            'Set the number of samples to simulate.',
            'Watch the histogram to see the Normal Distribution emerge.'
        ],
        'related_slugs' => ['normal-distribution-calculator', 'probability-calculator', 'binomial-probability-calculator'],
        'canonical' => '/tools/central-limit-theorem-calculator'
    ],
    'chinese-remainder-theorem-calculator' => [
        'tool_slug' => 'chinese-remainder-theorem-calculator',
        'h1' => 'Chinese Remainder Theorem (CRT) Solver',
        'title' => 'Chinese Remainder Theorem Calculator - solve x ≡ a mod n | ToolsHub',
        'meta_description' => 'Solve systems of simultaneous congruences using the Chinese Remainder Theorem. Fast calculator for modular arithmetic solutions.',
        'article' => "## What is the Chinese Remainder Theorem?

The **Chinese Remainder Theorem (CRT)** allows you to uniquely determine a number if you know its remainders when divided by several pairwise coprime integers.

## Applications in Cryptography
CRT is vital in the RSA algorithm for speeding up decryption. It allows complex calculations on massive numbers to be broken down into faster operations on smaller numbers.

## Use Cases
- **Computer Arithmetic:** Parallelizing arithmetic operations.
- **Secret Sharing:** Distributing data parts to reconstruct a secret.
- **Logic Puzzles:** Solving classical \"riddle\" style problems involving modular cycles.",
        'faq' => [
            ['q' => 'What if the moduli are not coprime?', 'a' => 'A solution might not exist or might not be unique.'],
            ['q' => 'Is the solution unique?', 'a' => 'Yes, within the product of all moduli.'],
            ['q' => 'How many equations can this handle?', 'a' => 'Up to 3 simultaneous congruences.'],
            ['q' => 'Is this useful for RSA?', 'a' => 'Yes, it makes decryption up to 4x faster.'],
            ['q' => 'Does it show the steps?', 'a' => 'It provides the final result and the product N.']
        ],
        'instructions' => [
            'Enter the remainder (a) for each equation.',
            'Enter the modulus (n) for each equation.',
            'Ensure moduli are coprime (GCD = 1).',
            'Click calculate to find the smallest positive x.'
        ],
        'related_slugs' => ['gcd-calculator', 'euler-totient-calculator', 'complex-number-calculator'],
        'canonical' => '/tools/chinese-remainder-theorem-calculator'
    ],
    'combination-calculator' => [
        'tool_slug' => 'combination-calculator',
        'h1' => 'Combination Calculator (nCr)',
        'title' => 'Combination Calculator - Subset Finder | ToolsHub',
        'meta_description' => 'Calculate combinations (nCr) instantly. Find how many ways to choose r items from n without order.',
        'article' => "## What is a Combination?

A **Combination** is a way of selecting items from a larger group where the **order does not matter**. This is often used in probability and lottery calculations.

## Use Cases
- **Lottery:** Finding the total possible ticket combinations.
- **Project Management:** Creating team pairings.
- **Biology:** Estimating genetic combinations.",
        'faq' => [
            ['q' => 'What is the formula?', 'a' => 'nCr = n! / (r!(n-r)!)'],
            ['q' => 'What is 10C3?', 'a' => '120.'],
            ['q' => 'How does it differ from Permutations?', 'a' => 'Permutations care about order; combinations do not.'],
            ['q' => 'Is it used in poker?', 'a' => 'Yes, for calculating hand probabilities.'],
            ['q' => 'Can n be very large?', 'a' => 'Our tool handles up to n=1000 efficiently.']
        ],
        'instructions' => [
            'Enter the total items (n).',
            'Enter the items to choose (r).',
            'The tool will instantly show the total combinations.',
            'Read the insights for the probability context.'
        ],
        'related_slugs' => ['binomial-coefficient-calculator', 'factorial-calculator', 'fibonacci-calculator'],
        'canonical' => '/tools/combination-calculator'
    ],
    'complementary-error-function-calculator' => [
        'tool_slug' => 'complementary-error-function-calculator',
        'h1' => 'erfc(x) – Complementary Error Function Solver',
        'title' => 'erfc(x) Calculator - Complementary Error Function | ToolsHub',
        'meta_description' => 'Calculate erfc(x) with high precision. Essential for heat equations and diffusion modeling.',
        'article' => "## What is erfc(x)?

The **Complementary Error Function**, erfc(x), is defined as 1 - erf(x). It represents the probability that a random variable falls outside a specific normal range.

## Use Cases
- **Heat Transfer:** Modeling temperature spread in solids.
- **Signal Processing:** Estimating bit error rates.
- **Material Science:** Predicting penetration depth.",
        'faq' => [
            ['q' => 'What is erfc(0)?', 'a' => '1.'],
            ['q' => 'What is the limit at infinity?', 'a' => '0.'],
            ['q' => 'Is it used in finance?', 'a' => 'Yes, in Black-Scholes variations.'],
            ['q' => 'How accurate is this tool?', 'a' => 'Provides 8+ decimal places using Chebyshev approximations.'],
            ['q' => 'Is it related to the Q-function?', 'a' => 'Yes, used in telecommunications.']
        ],
        'instructions' => [
            'Enter x.',
            'The result is calculated instantly.',
            'View the decay chart.',
            'Use results for engineering models.'
        ],
        'related_slugs' => ['error-function-calculator', 'gamma-function-calculator', 'exponential-decay-calculator'],
        'canonical' => '/tools/complementary-error-function-calculator'
    ],
    'complex-number-calculator' => [
        'tool_slug' => 'complex-number-calculator',
        'h1' => 'Complex Number Calculator (a + bi)',
        'title' => 'Complex Number Calculator - Imaginary Math Solver | ToolsHub',
        'meta_description' => 'Add, Multiply, and Divide complex numbers. Convert between rectangular and polar forms instantly.',
        'article' => "## What are Complex Numbers?

Numbers with a real part and an imaginary part (i^2 = -1). They are vital for 2D plane calculations in physics and engineering.

## Use Cases
- **Electrical Engineering:** Analyzing AC circuit impedance.
- **Physics:** Wave function calculations.
- **Signal Processing:** Fourier transformations.",
        'faq' => [
            ['q' => 'What is i squared?', 'a' => '-1.'],
            ['q' => 'Does it show polar form?', 'a' => 'Yes, including magnitude and phase angle.'],
            ['q' => 'How do you multiply complex numbers?', 'a' => 'Using FOIL, where i^2 = -1.'],
            ['q' => 'What is a complex conjugate?', 'a' => 'a - bi (reverses the imaginary part).'],
            ['q' => 'Is it free?', 'a' => 'Yes, 100% free online solver.']
        ],
        'instructions' => [
            'Enter Real/Imaginary parts for Number A.',
            'Enter Real/Imaginary parts for Number B.',
            'Select the operation.',
            'View results in all formats (Rect, Polar, Mag).'
        ],
        'related_slugs' => ['bitwise-calculator', 'continued-fraction-calculator', 'exponents-calculator'],
        'canonical' => '/tools/complex-number-calculator'
    ],

    // BATCH 3
    'continued-fraction-calculator' => [
        'tool_slug' => 'continued-fraction-calculator',
        'h1' => 'Continued Fraction Expansion Calculator',
        'title' => 'Continued Fraction Calculator - Find [a0; a1, a2...] | ToolsHub',
        'meta_description' => 'Convert any decimal or fraction into its unique continued fraction expansion. High precision solver.',
        'article' => "## What are Continued Fractions?

A representation of a number as a nested reciprocal sequence. Rational numbers termiante; irrationals like pi are infinite.

## Use Cases
- **Rational Approximation:** Finding simple fractions close to complex decimals.
- **Number Theory:** Solving Pell's equations.
- **Engineering:** Optimizing gear ratios.",
        'faq' => [
            ['q' => 'What is the CF of pi?', 'a' => '[3; 7, 15, 1, 292...]'],
            ['q' => 'Do they always terminate for rational numbers?', 'a' => 'Yes.'],
            ['q' => 'What is a convergent?', 'a' => 'The rational number formed by stopping the expansion at a specific point.'],
            ['q' => 'Can I enter fractions?', 'a' => 'Yes, use \"n/d\" format.'],
            ['q' => 'Is it useful for leap years?', 'a' => 'Yes, historically used to refine calendar cycles.']
        ],
        'instructions' => [
            'Enter your number or fraction.',
            'Adjust the depth slider.',
            'The expansion results update instantly.',
            'Review the convergents in the insights panel.'
        ],
        'related_slugs' => ['gcd-calculator', 'complex-number-calculator', 'fibonacci-calculator'],
        'canonical' => '/tools/continued-fraction-calculator'
    ],
    'derangement-calculator' => [
        'tool_slug' => 'derangement-calculator',
        'h1' => 'Derangement Calculator (!n) – Subfactorial Solver',
        'title' => 'Derangement Calculator - Calculate Subfactorial !n | ToolsHub',
        'meta_description' => 'Find the number of derangements (!n) for any set. Calculate subfactorials and probabilities.',
        'article' => "## What is a Derangement?

A permutation where no element is in its original place. Denoted as subfactorial !n.

## The Hat-Check Problem
The probability that nobody gets their own item back in a random distribution. This converges to 1/e (36.8%) as n grows.

## Use Cases
- **Secret Santa:** Ensuring nobody draws their own name.
- **Cybersecurity:** Analyzing unpredictable permutations.
- **Testing:** Shuffling data so no input matches its default.",
        'faq' => [
            ['q' => 'What is !3?', 'a' => '2.'],
            ['q' => 'What is the limit of !n/n!?', 'a' => '1/e.'],
            ['q' => 'What is !0?', 'a' => '1.'],
            ['q' => 'Is it the same as factorial?', 'a' => 'No, it counts restricted permutations.'],
            ['q' => 'Is it useful for coding?', 'a' => 'Yes, for shuffling and anonymity.']
        ],
        'instructions' => [
            'Enter n.',
            'Instantly get !n.',
            'See the probability of a random derangement.',
            'Compare !n with total permutations n!.'
        ],
        'related_slugs' => ['factorial-calculator', 'combination-calculator', 'binomial-coefficient-calculator'],
        'canonical' => '/tools/derangement-calculator'
    ],
    'dijkstra-calculator' => [
        'tool_slug' => 'dijkstra-calculator',
        'h1' => 'Dijkstra’s Algorithm Simulator',
        'title' => 'Dijkstra’s Algorithm Calculator - Shortest Path Finder | ToolsHub',
        'meta_description' => 'Interactive Dijkstra shortest path solver. Find the most efficient route between nodes instantly.',
        'article' => "## Dijkstra's Algorithm

The gold standard for find the shortest path in a weighted graph.

## Applications
- **GPS:** Finding the fastest route in Google Maps.
- **Network Routing:** OSPF protocol for internet traffic.
- **Social Networks:** Degrees of separation.",
        'faq' => [
            ['q' => 'Can it handle negative weights?', 'a' => 'No. Use Bellman-Ford for that.'],
            ['q' => 'What is the complexity?', 'a' => 'O(V^2) or O(E log V).'],
            ['q' => 'Is it used in games?', 'a' => 'Yes, for NPC pathfinding.'],
            ['q' => 'What are edges?', 'a' => 'The connections between points (nodes).'],
            ['q' => 'Does this tool show the path?', 'a' => 'Yes, it visualizes the traversal and distance.']
        ],
        'instructions' => [
            'Select grid complexity.',
            'Watch the simulation.',
            'Review the shortest distance result.',
            'Read the routing insights.'
        ],
        'related_slugs' => ['entropy-calculator', 'chinese-remainder-theorem-calculator', 'complex-number-calculator'],
        'canonical' => '/tools/dijkstra-calculator'
    ],
    'entropy-calculator' => [
        'tool_slug' => 'entropy-calculator',
        'h1' => 'Shannon Entropy Calculator',
        'title' => 'Entropy Calculator - Measure Data Randomness | ToolsHub',
        'meta_description' => 'Measure uncertainty in data using Shannon Entropy. Supports text and sequences.',
        'article' => "## What is Shannon Entropy?

A measure of randomness in information. Predictable data has 0 entropy; random data has high entropy.

## Use Cases
- **Data Compression:** Finding the theoretical limit (ZIP, JPEG).
- **Cryptography:** Checking password strength.
- **ML:** Decision tree information gain.",
        'faq' => [
            ['q' => 'What is the unit?', 'a' => 'The bit.'],
            ['q' => 'Entropy of a coin flip?', 'a' => '1 bit.'],
            ['q' => 'What is max entropy?', 'a' => 'All outcomes are equally likely.'],
            ['q' => 'Does it check passwords?', 'a' => 'Yes, measures character variety.'],
            ['q' => 'Formula?', 'a' => 'H(X) = -Σ P(x) log2 P(x).']
        ],
        'instructions' => [
            'Paste your text.',
            'Frequency counts are generated.',
            'Shannon Entropy updates instantly.',
            'Observe the randomness percentage.'
        ],
        'related_slugs' => ['bitwise-calculator', 'binomial-probability-calculator', 'factorial-calculator'],
        'canonical' => '/tools/entropy-calculator'
    ],
    'error-function-calculator' => [
        'tool_slug' => 'error-function-calculator',
        'h1' => 'erf(x) – Gauss Error Function Solver',
        'title' => 'Error Function Calculator - erf(x) Online | ToolsHub',
        'meta_description' => 'Calculate the Gauss error function (erf) instantly. Essential for statistics and physics.',
        'article' => "## What is erf(x)?

The integral of the normal distribution. Vital for confidence intervals and heat spread modeling.

## Use Cases
- **Statistics:** p-values and confidence levels.
- **Physics:** Heat equation solutions.
- **Diffusion:** Predicting molecule spread.",
        'faq' => [
            ['q' => 'What is erf(1)?', 'a' => '0.8427.'],
            ['q' => 'Limit at infinity?', 'a' => '1.'],
            ['q' => 'Is it an odd function?', 'a' => 'Yes, erf(-x) = -erf(x).'],
            ['q' => 'Related to Normal CDF?', 'a' => 'Yes.'],
            ['q' => 'What is erfc?', 'a' => 'Complementary error function (1-erf).']
        ],
        'instructions' => [
            'Enter x.',
            'erf(x) result appears.',
            'View the probability curve.',
            'Use result for stats models.'
        ],
        'related_slugs' => ['complementary-error-function-calculator', 'gamma-function-calculator', 'normal-distribution-calculator'],
        'canonical' => '/tools/error-function-calculator'
    ],

    // BATCH 4
    'euler-totient-calculator' => [
        'tool_slug' => 'euler-totient-calculator',
        'h1' => 'Euler Totient Calculator (phi)',
        'title' => 'Euler Totient Calculator - phi(n) Solver | ToolsHub',
        'meta_description' => 'Calculate phi(n) – the count of numbers coprime to n. Essential for RSA and number theory.',
        'article' => "## Euler's Totient Function

Counts integers up to n that are relatively prime to n.

## Use Cases
- **RSA:** Creating public/private key pairs.
- **Number Theory:** Studying cyclic groups.
- **Cryptography:** Modular exponentiation efficiency.",
        'faq' => [
            ['q' => 'What is phi(10)?', 'a' => '4 (1, 3, 7, 9).'],
            ['q' => 'Phi(p) for prime p?', 'a' => 'p - 1.'],
            ['q' => 'What if n is prime?', 'a' => 'Result is n-1.'],
            ['q' => 'Useful for RSA?', 'a' => 'Yes, used in the totient of the modulus.'],
            ['q' => 'Is it multiplicative?', 'a' => 'Yes, if a and b are coprime, phi(ab) = phi(a)phi(b).']
        ],
        'instructions' => [
            'Enter n.',
            'Get phi(n) result.',
            'See the coprime list comparison.',
            'Review prime factors panel.'
        ],
        'related_slugs' => ['gcd-calculator', 'chinese-remainder-theorem-calculator', 'complex-number-calculator'],
        'canonical' => '/tools/euler-totient-calculator'
    ],
    'exponential-decay-calculator' => [
        'tool_slug' => 'exponential-decay-calculator',
        'h1' => 'Exponential Decay Calculator',
        'title' => 'Exponential Decay Calculator - Half-Life Solver | ToolsHub',
        'meta_description' => 'Model quantity decrease over time. Calculate radioactive decay and depreciation.',
        'article' => "## What is Decay?
Quantities decreasing at a percentage rate. Result is f(t) = a * (1 - r)^t.

## Use Cases
- **Science:** Carbon dating.
- **Economy:** Asset depreciation.
- **Medicine:** Drug clearance rates.",
        'faq' => [
            ['q' => 'What is half-life?', 'a' => 'Time taken for half of the substance to decay.'],
            ['q' => 'Is rate decimal or %?', 'a' => 'Use % for this tool.'],
            ['q' => 'Does it handle large time?', 'a' => 'Yes.'],
            ['q' => 'Can rate be 100%?', 'a' => 'Yes, quantity becomes 0 immediately.'],
            ['q' => 'Is it like growth?', 'a' => 'Yes, but with a subtraction in the base.']
        ],
        'instructions' => [
            'Enter initial amount.',
            'Select decay rate.',
            'Enter time periods.',
            'View the decline curve and final value.'
        ],
        'related_slugs' => ['exponential-growth-calculator', 'exponential-integral-calculator', 'exponents-calculator'],
        'canonical' => '/tools/exponential-decay-calculator'
    ],
    'exponential-growth-calculator' => [
        'tool_slug' => 'exponential-growth-calculator',
        'h1' => 'Exponential Growth Calculator',
        'title' => 'Exponential Growth Calculator - Future Value Solver | ToolsHub',
        'meta_description' => 'Model rapid quantity increase. Calculate compounding growth and population expansions.',
        'article' => "## What is Growth?
Quantities increasing at a constant percentage. f(t) = a * (1 + r)^t.

## Use Cases
- **Finance:** Interest compounding.
- **Biology:** Bacterial growth.
- **Tech:** Viral user adoption.",
        'faq' => [
            ['q' => 'What is doubling time?', 'a' => 'Time to double the initial value.'],
            ['q' => 'How differs from linear?', 'a' => 'Linear is constant amount; exponential is constant %.'],
            ['q' => 'Can rate > 100%?', 'a' => 'Yes.'],
            ['q' => 'Is it used for stocks?', 'a' => 'Yes, for estimating long term value.'],
            ['q' => 'Is initial amount 0 possible?', 'a' => 'No, growth would remain 0.']
        ],
        'instructions' => [
            'Enter initial value.',
            'Choose growth rate.',
            'Enter time.',
            'Review the growth chart and final total.'
        ],
        'related_slugs' => ['exponential-decay-calculator', 'exponents-calculator', 'fibonacci-calculator'],
        'canonical' => '/tools/exponential-growth-calculator'
    ],
    'exponential-integral-calculator' => [
        'tool_slug' => 'exponential-integral-calculator',
        'h1' => 'Exponential Integral Ei(x) Solver',
        'title' => 'Exponential Integral Calculator - Ei(x) Tool | ToolsHub',
        'meta_description' => 'Evaluate Ei(x) special function. Important for heat and fluid flow equations.',
        'article' => "## Ei(x) Function
Integral of exp(t)/t. Non-elementary function used in specific physical problems.

## Use Cases
- **Thermodynamics:** Heat flow solutions.
- **Fluids:** Non-steady flow in aquifers.
- **Math:** Prime number theorem approximations.",
        'faq' => [
            ['q' => 'Value at Ei(1)?', 'a' => '1.8951.'],
            ['q' => 'Is it related to li(x)?', 'a' => 'Yes, logarithmic integral.'],
            ['q' => 'Can x be negative?', 'a' => 'Yes, Ei(x) is defined for negative x.'],
            ['q' => 'Is it an integral?', 'a' => 'Yes, from -inf to x.'],
            ['q' => 'Used in physics?', 'a' => 'Extensively in engineering transience.']
        ],
        'instructions' => [
            'Enter x.',
            'Result displays Ei(x).',
            'Check sub-stats for scale.',
            'Use result for engineering formulas.'
        ],
        'related_slugs' => ['error-function-calculator', 'gamma-function-calculator', 'exponential-decay-calculator'],
        'canonical' => '/tools/exponential-integral-calculator'
    ],
    'exponents-calculator' => [
        'tool_slug' => 'exponents-calculator',
        'h1' => 'Exponents and Roots Calculator',
        'title' => 'Exponents Calculator - Power and Root Solver | ToolsHub',
        'meta_description' => 'Calculate x^y and nth roots instantly. Support for negative, fractional, and large exponents.',
        'article' => "## Power Math
Efficiently calculate base raised to a power. Includes roots as fractional exponents.

## Use Cases
- **Geometry:** Area and volume (squared/cubed).
- **Physics:** Inverse square laws.
- **Finanace:** Compounding multipliers.",
        'faq' => [
            ['q' => 'What is x^0?', 'a' => '1 (except 0^0).'],
            ['q' => 'Negative exponents?', 'a' => 'Reciprocals (1 / x^y).'],
            ['q' => 'Fractional exponents?', 'a' => 'Roots (x^(1/2) is sqrt).'],
            ['q' => 'Very large results?', 'a' => 'Shown in scientific notation.'],
            ['q' => 'Is it free?', 'a' => 'Yes, instant results.']
        ],
        'instructions' => [
            'Enter base.',
            'Enter exponent.',
            'Get the power result.',
            'See the reciprocal and root stats.'
        ],
        'related_slugs' => ['antilog-calculator', 'complex-number-calculator', 'factorial-calculator'],
        'canonical' => '/tools/exponents-calculator'
    ],

    // BATCH 5
    'factorial-calculator' => [
        'tool_slug' => 'factorial-calculator',
        'h1' => 'Factorial Calculator (n!)',
        'title' => 'Factorial Calculator - n! Solver | ToolsHub',
        'meta_description' => 'Calculate n! instantly. Essential for counting permutations and probability.',
        'article' => "## What is Factorial?
Product of all integers up to n. n! = n * (n-1)... * 1.

## Use Cases
- **Permutations:** Number of ways to arrange items.
- **Combinations:** Binomial denominator.
- **Probability:** Odd calculations.",
        'faq' => [
            ['q' => 'What is 0!?', 'a' => '1.'],
            ['q' => 'What is 5!?', 'a' => '120.'],
            ['q' => 'Result of 70!?', 'a' => 'Exceeds atoms in universe.'],
            ['q' => 'Large factorials?', 'a' => 'Uses scientific notation.'],
            ['q' => 'Factorial of decimals?', 'a' => 'Use Gamma function.']
        ],
        'instructions' => [
            'Enter n.',
            'Get n! result.',
            'See the digit count.',
            'Review permutation insights.'
        ],
        'related_slugs' => ['binomial-coefficient-calculator', 'gamma-function-calculator', 'fibonacci-calculator'],
        'canonical' => '/tools/factorial-calculator'
    ],
    'fibonacci-calculator' => [
        'tool_slug' => 'fibonacci-calculator',
        'h1' => 'Fibonacci Sequence Calculator',
        'title' => 'Fibonacci Calculator - Find nth Term | ToolsHub',
        'meta_description' => 'Generate Fibonacci numbers instantly. Explore sequence and Golden Ratio convergence.',
        'article' => "## Fibonacci sequence
0, 1, 1, 2, 3, 5, 8... where each is the sum of previous two.

## Appearance in Nature
- **Shells & Sprials:** Golden ratio growth.
- **Flowers:** Petal counts.
- **Galaxies:** Scaling patterns.",
        'faq' => [
            ['q' => 'Next number after 5?', 'a' => '8.'],
            ['q' => 'Ratio limit?', 'a' => 'Golden Ratio (1.618).'],
            ['q' => 'F(10)?', 'a' => '55.'],
            ['q' => 'Recursive or Iterative?', 'a' => 'This tool uses fast iterative logic.'],
            ['q' => 'Can n be 500?', 'a' => 'Yes, but result is extremely large.']
        ],
        'instructions' => [
            'Enter index n.',
            'Get Fn term.',
            'See ratio Fn/Fn-1.',
            'Observe error from Golden Ratio.'
        ],
        'related_slugs' => ['golden-ratio-calculator', 'factorial-calculator', 'exponents-calculator'],
        'canonical' => '/tools/fibonacci-calculator'
    ],
    'gamma-function-calculator' => [
        'tool_slug' => 'gamma-function-calculator',
        'h1' => 'Gamma Function Γ(z) Solver',
        'title' => 'Gamma Function Calculator - Factorial Extension | ToolsHub',
        'meta_description' => 'Calculate Γ(z) for real and complex numbers. Essential for statistics.',
        'article' => "## Gamma Function
Extension of factorial to all numbers. Γ(n) = (n-1)!.

## Use Cases
- **Stats:** Gamma and t-distributions.
- **Physics:** Quantum field theory.
- **Engineering:** Signal processing.",
        'faq' => [
            ['q' => 'Γ(5)?', 'a' => '24 (which is 4!).'],
            ['q' => 'Γ(1/2)?', 'a' => 'sqrt(pi).'],
            ['q' => 'Can z be negative?', 'a' => 'Yes, except for non-positive integers.'],
            ['q' => 'Accuracy?', 'a' => 'High precision via Lanczos.'],
            ['q' => 'Difference from factorial?', 'a' => 'Gamma is continuous.']
        ],
        'instructions' => [
            'Enter z.',
            'Get Γ(z) value.',
            'Review Γ(z+1).',
            'Read stats insights.'
        ],
        'related_slugs' => ['factorial-calculator', 'beta-function-calculator', 'error-function-calculator'],
        'canonical' => '/tools/gamma-function-calculator'
    ],
    'gcd-calculator' => [
        'tool_slug' => 'gcd-calculator',
        'h1' => 'Greatest Common Divisor (GCD) Solver',
        'title' => 'GCD Calculator - Find Highest Common Factor | ToolsHub',
        'meta_description' => 'Find the largest common factor between two numbers instantly. Fast Euclidean solver.',
        'article' => "## What is GCD?
The largest number that goes into both values evenly.

## Use Cases
- **Fractions:** Simplifying to lowest terms.
- **Layout:** Fitting grids in design.
- **Music:** Harmonizing rhythm cycles.",
        'faq' => [
            ['q' => 'GCD of 24 and 36?', 'a' => '12.'],
            ['q' => 'What if it’s 1?', 'a' => 'Numbers are coprime.'],
            ['q' => 'Does it find LCM?', 'a' => 'Yes, LCM is shown in stats.'],
            ['q' => 'Algorithm?', 'a' => 'Euclidean Algorithm.'],
            ['q' => 'Is it useful for coding?', 'a' => 'Yes, for ratio management.']
        ],
        'instructions' => [
            'Enter first number.',
            'Enter second number.',
            'Instantly see GCD and LCM.',
            'Review simplification insights.'
        ],
        'related_slugs' => ['euler-totient-calculator', 'chinese-remainder-theorem-calculator', 'complex-number-calculator'],
        'canonical' => '/tools/gcd-calculator'
    ],
    'golden-ratio-calculator' => [
        'tool_slug' => 'golden-ratio-calculator',
        'h1' => 'Golden Ratio Calculator (phi)',
        'title' => 'Golden Ratio Calculator - Divine Proportion | ToolsHub',
        'meta_description' => 'Calculate perfect Golden Ratio proportions for design and art. phi = 1.618.',
        'article' => "## Golden Ratio
phi ≈ 1.618033. Proportions believed to be most pleasing.

## Use Cases
- **Art:** Composition framing.
- **Architecture:** Room proportions.
- **Design:** Logo and sidebar layout.",
        'faq' => [
            ['q' => 'What is phi?', 'a' => '1.618.'],
            ['q' => 'How to calculate?', 'a' => 'Multiply by 1.618 or find side B.'],
            ['q' => 'Same as rule of thirds?', 'a' => 'Similar, but tighter math.'],
            ['q' => 'Useful for web?', 'a' => 'Yes, for grid content/sidebar.'],
            ['q' => 'Is it in nature?', 'a' => 'Yes, in shells and spirals.']
        ],
        'instructions' => [
            'Enter length val.',
            'Select which part it is.',
            'Get the other side and total.',
            'Apply to your visual design.'
        ],
        'related_slugs' => ['fibonacci-calculator', 'exponents-calculator', 'beta-function-calculator'],
        'canonical' => '/tools/golden-ratio-calculator'
    ]
];

$seoFile = 'd:/Xamp/htdocs/ToolsHub/storage/seo_pages.php';

// Safe load of the massive file
$existing = include $seoFile;

if (!isset($existing['pages']) || !is_array($existing['pages'])) {
    $existing['pages'] = [];
}

// Inject/Update math tools
foreach ($newPages as $slug => $data) {
    $existing['pages'][$slug] = $data;
}

// Write it back with standard export
$content = "<?php\n\nreturn " . var_export($existing, true) . ";\n";

if (file_put_contents($seoFile, $content)) {
    echo "Successfully consolidated 25 math tools into storage/seo_pages.php\n";
    echo "Total pages now: " . count($existing['pages']) . "\n";
} else {
    echo "FAILED to write to $seoFile\n";
}
