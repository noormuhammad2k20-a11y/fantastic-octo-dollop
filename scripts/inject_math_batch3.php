<?php
/**
 * Inject SEO Content for Advanced Math Tools (Batch 3)
 */

$newPages = [
    'continued-fraction-calculator' => [
        'tool_slug' => 'continued-fraction-calculator',
        'h1' => 'Continued Fraction Expansion Calculator',
        'title' => 'Continued Fraction Calculator - Find [a0; a1, a2...] | ToolsHub',
        'meta_description' => 'Convert any decimal or fraction into its unique continued fraction expansion. High precision solver with step-by-step terms.',
        'article' => "## What is a Continued Fraction?

A **Continued Fraction** is a way of representing a number as the sum of its integer part and the reciprocal of another number, which is itself represented in the same way. This process can be finite (for rational numbers) or infinite (for irrational numbers like π or √2). 

## Everything You Need to Know About Continued Fractions

Continued fractions are denoted by the notation **[a0; a1, a2, a3, ...]**. They are considered one of the most \"natural\" ways to represent real numbers because they provide the best possible rational approximations. For example, the famous approximation of π as 22/7 comes directly from its continued fraction expansion.

### Why Use Continued Fractions?
*   **Rational Approximation:** They allow you to find simple fractions that are very close to complex decimals.
*   **Number Theory:** They are essential in solving Pell's equations and understanding the structure of quadratic irrationals.
*   **Aesthetics:** Many mathematical constants have surprisingly regular or beautiful continued fraction patterns.

## Use Cases + Benefits

*   **Engineering:** Finding gear ratios that closely approximate a specific decimal value.
*   **Calendar Design:** Historically used to determine leap year cycles based on the length of the solar year.
*   **Algorithm Design:** Used in the Shor's algorithm for quantum computing and integer factorization.
*   **Mathematics Education:** Visualizing the recursive nature of numbers and limits.",
        'faq' => [
            ['q' => 'What is the continued fraction of π?', 'a' => 'The first few terms are [3; 7, 15, 1, 292, ...].'],
            ['q' => 'Do rational numbers terminate?', 'a' => 'Yes, every rational number has a finite continued fraction expansion.'],
            ['q' => 'What is a "simple" continued fraction?', 'a' => 'A version where all the numerators are 1.'],
            ['q' => 'How accurate are the approximations?', 'a' => 'Each successive term in the expansion provides an increasingly accurate "convergent" fraction.'],
            ['q' => 'Can this tool handle fractions like 22/7?', 'a' => 'Yes, you can input values in "n/d" format or as standard decimals.']
        ],
        'instructions' => [
            'Enter your number (e.g., 3.14159 or 22/7).',
            'Adjust the "Max Depth" slider if you need more or fewer terms.',
            'The expansion [a0; a1, a2...] will appear in the results panel.',
            'Review the insights for the mathematical significance of the terms.'
        ],
        'related_slugs' => ['complex-number-calculator', 'binomial-coefficient-calculator', 'gcd-calculator'],
        'canonical' => '/tools/continued-fraction-calculator'
    ],
    'derangement-calculator' => [
        'tool_slug' => 'derangement-calculator',
        'h1' => 'Derangement Calculator (!n) – Subfactorial Solver',
        'title' => 'Derangement Calculator - Calculate Subfactorial !n | ToolsHub',
        'meta_description' => 'Find the number of derangements (!n) for any set. Calculate subfactorials and probabilities for the Hat-Check problem.',
        'article' => "## What is a Derangement?

In combinatorics, a **Derangement** is a permutation of the elements of a set in which no element appears in its original position. For example, if you have three hats {1, 2, 3}, a derangement would be {2, 3, 1}. The number of derangements of a set of size *n* is called the **Subfactorial** of *n* and is denoted as **!n**.

## Everything You Need to Know About the Hat-Check Problem

The study of derangements is often introduced via the \"Hat-Check Problem\": if *n* people leave their hats at a counter and the clerk returns them completely at random, what is the probability that *nobody* gets their own hat back?

### Fascinating Probability:
As the number of items *n* grows, the probability of a random permutation being a derangement approaches **1/e (approximately 36.79%)**. Remarkably, this probability is almost the same for 10 items as it is for 1,000,000 items!

## Use Cases + Benefits

*   **Probability Theory:** Solving complex "matching" problems in statistics.
*   **Computer Science:** Designing algorithms for anonymous data shuffling or "Secret Santa" generators.
*   **Software Testing:** Creating test cases where no input should map to its default output.
*   **Cybersecurity:** Analyzing the randomness and unpredictability of permutations in cryptographic protocols.",
        'faq' => [
            ['q' => 'What is !n mean?', 'a' => 'It is the notation for "subfactorial," representing the number of derangements.'],
            ['q' => 'What is !3?', 'a' => '!3 = 2. The possible derangements of {1,2,3} are {2,3,1} and {3,1,2}.'],
            ['q' => 'What is !0 and !1?', 'a' => '!0 is defined as 1, and !1 is 0.'],
            ['q' => 'How is it related to e?', 'a' => 'The ratio n! / !n approaches the mathematical constant e (2.718...).'],
            ['q' => 'Is this useful for Secret Santa?', 'a' => 'Yes! A successful Secret Santa where nobody draws their own name is a perfect derangement.']
        ],
        'instructions' => [
            'Enter the number of items in your set (n).',
            'The tool will instantly calculate the subfactorial value.',
            'Review the "Total Permutations" vs "Derangements" comparison.',
            'Note the probability percentage for a random derangement.'
        ],
        'related_slugs' => ['combination-calculator', 'binomial-coefficient-calculator', 'factorial-calculator'],
        'canonical' => '/tools/derangement-calculator'
    ],
    'dijkstra-calculator' => [
        'tool_slug' => 'dijkstra-calculator',
        'h1' => 'Dijkstra’s Algorithm Calculator – Shortest Path Finder',
        'title' => 'Dijkstra’s Algorithm Calculator - Find Shortest Path | ToolsHub',
        'meta_description' => 'Interactive Dijkstra shortest path solver. Find the most efficient route between nodes in a weighted graph instantly.',
        'article' => "## What is Dijkstra's Algorithm?

**Dijkstra's Algorithm** is a famous graph-based search algorithm that finds the shortest path between a starting node and all other nodes in a weighted graph. Developed by Edsger W. Dijkstra in 1956, it remains the gold standard for routing and network optimization.

## Everything You Need to Know About Shortest Paths

The algorithm works by maintaining a set of \"tentative distances\" and greedily expanding the node with the smallest distance. It is highly efficient and guaranteed to find the absolute shortest path, provided that all edge weights are non-negative.

### Key Concepts:
1.  **Nodes (Vertices):** Points on the map or network.
2.  **Edges (Links):** The paths connecting the nodes.
3.  **Weights (Cost):** The distance, time, or cost associated with traveling an edge.

## Use Cases + Benefits

*   **GPS & Navigation:** Powering the logic behind Google Maps and other routing software to find the quickest drive.
*   **Network Routing:** Used in the OSPF (Open Shortest Path First) protocol for directing internet traffic.
*   **Social Networks:** Finding \"degrees of separation\" between users.
*   **Logistics:** Optimizing delivery routes to minimize fuel consumption and time.",
        'faq' => [
            ['q' => 'Can Dijkstra handle negative weights?', 'a' => 'No. For negative weights, you must use the Bellman-Ford algorithm.'],
            ['q' => 'Is Dijkstra the fastest?', 'a' => 'For many graphs, yes. For specific grids, A* (A-Star) can be faster by using heuristics.'],
            ['q' => 'What is O(V^2)?', 'a' => 'This is the time complexity of the basic algorithm, where V is the number of vertices.'],
            ['q' => 'Is it used in video games?', 'a' => 'Frequently. It helps NPCs (Non-Player Characters) navigate complex maps.'],
            ['q' => 'Does this tool show the path?', 'a' => 'Our simulator visualizes the node traversal and provides the total calculated distance.']
        ],
        'instructions' => [
            'Select the grid complexity (Small or Medium).',
            'Observe the simulation as the algorithm explores the nodes.',
            'Review the "Shortest Distance" result in the panel.',
            'Read the insights to see how the mathematical logic applies to your result.'
        ],
        'related_slugs' => ['chinese-remainder-theorem-calculator', 'central-limit-theorem-calculator', 'complex-number-calculator'],
        'canonical' => '/tools/dijkstra-calculator'
    ],
    'entropy-calculator' => [
        'tool_slug' => 'entropy-calculator',
        'h1' => 'Shannon Entropy Calculator – Information Theory Tool',
        'title' => 'Entropy Calculator - Calculate Shannon Entropy (H) | ToolsHub',
        'meta_description' => 'Measure the randomness and uncertainty in your data using Shannon Entropy. Supports text and probability sequences.',
        'article' => "## What is Shannon Entropy?

**Shannon Entropy**, named after the father of information theory, Claude Shannon, is a measure of the average amount of information produced by a stochastic source of data. In simpler terms, it measures the \"uncertainty\" or \"randomness\" contained in a message or sequence.

## Everything You Need to Know About Entropy

In a predictable sequence (like \"AAAAA\"), the entropy is 0 because you always know what comes next. In a completely random sequence, the entropy is high. This value is calculated in \"bits\" per character, representing the minimum number of binary digits needed to encode the information.

### The Formula:
**H(X) = -Σ P(xi) log2 P(xi)**
Where P(xi) is the probability of character *i* appearing in the sequence.

## Use Cases + Benefits

*   **Data Compression:** Determining the theoretical limit of how much a file can be compressed (e.g., ZIP, JPEG).
*   **Cryptography:** Measuring the randomness of passwords or encryption keys. High entropy equals higher security.
*   **Machine Learning:** Used as \"Information Gain\" in Decision Tree algorithms to pick the best split.
*   **Biology:** Comparing genetic sequences and measuring biodiversity in ecosystems.",
        'faq' => [
            ['q' => 'What does high entropy mean?', 'a' => 'High entropy means the data is very random and contains a lot of information/uncertainty.'],
            ['q' => 'What is the unit of entropy?', 'a' => 'The standard unit is the \"bit\" (when using log base 2).'],
            ['q' => 'What is the entropy of a coin flip?', 'a' => 'A fair coin flip has exactly 1 bit of entropy.'],
            ['q' => 'Can I use this for passwords?', 'a' => 'Yes, it is a great way to see if your password has enough character variety to be secure.'],
            ['q' => 'Is there a maximum entropy?', 'a' => 'Yes, it occurs when all possible outcomes are equally likely (Uniform Distribution).']
        ],
        'instructions' => [
            'Paste your text or sequence into the input field.',
            'The tool will count the frequency of each unique character.',
            'The Shannon Entropy result updates in real-time.',
            'Observe the "Max Possible" value to see how close your data is to pure randomness.'
        ],
        'related_slugs' => ['bitwise-calculator', 'binomial-probability-calculator', 'factorial-calculator'],
        'canonical' => '/tools/entropy-calculator'
    ],
    'error-function-calculator' => [
        'tool_slug' => 'error-function-calculator',
        'h1' => 'erf(x) – Gauss Error Function Calculator',
        'title' => 'Error Function Calculator - erf(x) Solver Online | ToolsHub',
        'meta_description' => 'Calculate the Gauss error function (erf) for any real value. Essential for probability, statistics, and diffusion math.',
        'article' => "## What is the Error Function (erf)?

The **Error Function (erf)**, also known as the Gauss error function, is a special mathematical function that occurs frequently in probability, statistics, and partial differential equations. It is defined as the integral of the normal distribution curve from 0 to *x*.

## Everything You Need to Know About erf(x)

The error function describes the probability that a measurement, subject to a normal distribution with standard deviation 1/√2, falls within the range [-x, x]. It is a sigmoidal (S-shaped) curve that starts at -1 (for x=-∞), passes through 0 (for x=0), and approaches 1 (for x=+∞).

### Why "Error" Function?
The name comes from its 19th-century origins in the theory of errors, where it was used to model the distribution of measurement errors in astronomy and surveying.

## Use Cases + Benefits

*   **Statistics:** Calculating confidence intervals and p-values for normal distributions.
*   **Heat Equation:** Solving problems related to how heat spreads through a material over time.
*   **Diffusion:** Predicting how molecules move from areas of high concentration to low concentration.
*   **Optical Physics:** Used in the analysis of diffraction patterns and beam propagation.",
        'faq' => [
            ['q' => 'What is the formula for erf(x)?', 'a' => 'erf(x) = (2/√π) * ∫ exp(-t²) dt from 0 to x.'],
            ['q' => 'What is erf(1)?', 'a' => 'erf(1) is approximately 0.8427.'],
            ['q' => 'Is erf related to the Normal Distribution?', 'a' => 'Yes, the Cumulative Distribution Function (CDF) of the Normal Distribution can be written in terms of erf.'],
            ['q' => 'What is the result at infinity?', 'a' => 'As x approaches infinity, erf(x) approaches 1.'],
            ['q' => 'Is it symmetric?', 'a' => 'Yes, erf is an odd function, meaning erf(-x) = -erf(x).']
        ],
        'instructions' => [
            'Enter the value for x in the input box.',
            'The tool will instantly calculate the corresponding erf(x) value.',
            'View the probability percentage and the S-curve chart.',
            'Use the results for your statistical or engineering computations.'
        ],
        'related_slugs' => ['complementary-error-function-calculator', 'normal-distribution-calculator', 'gamma-function-calculator'],
        'canonical' => '/tools/error-function-calculator'
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
echo "Injected Batch 3 math tools into storage/seo_pages.php\n";
