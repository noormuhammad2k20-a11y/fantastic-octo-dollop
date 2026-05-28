<?php
/**
 * SEO Injection for all 23 new advanced math tools
 */

$newPages = [
    'half-life-calculator' => [
        'tool_slug' => 'half-life-calculator',
        'h1' => 'Half-Life Calculator - Radioactive Decay Tool',
        'title' => 'Half-Life Calculator - Calculate Radioactive Decay | ToolsHub',
        'meta_description' => 'Accurate half-life calculator for radioactive decay. Solve for remaining amount, initial quantity, or time elapsed.',
        'article' => "## What is the Half-Life Calculator?\n\nThe **Half-Life Calculator** models the exponential decay of substances using the formula N(t) = N0 * (1/2)^(t/h). Whether you are a student of nuclear physics, a researcher in carbon dating, or a professional in pharmacology, understanding how substances diminish over time is crucial.\n\n## Everything You Need to Know\n\nHalf-life is the time required for a quantity to reduce to half. This applies to radioactive isotopes, drug metabolism, and chemical reactions. The process follows a strict exponential curve.\n\n## Use Cases\n- **Archaeology:** Carbon-14 dating of artifacts.\n- **Medicine:** Calculating drug dose intervals.\n- **Nuclear Physics:** Monitoring spent fuel decay.\n- **Environmental Science:** Tracking pollutant persistence.",
        'faq' => [
            ['q' => 'What is the half-life formula?', 'a' => 'N(t) = N0 * (1/2)^(t/h), where N0 is the initial amount, t is time, and h is the half-life.'],
            ['q' => 'Can this be used for drug clearance?', 'a' => 'Yes, biological half-life follows the same exponential decay model.'],
            ['q' => 'What is a decay constant?', 'a' => 'Lambda = ln(2)/h, representing the probability of decay per unit time.'],
            ['q' => 'Why is half-life constant?', 'a' => 'It is a fundamental nuclear property that does not change with temperature or pressure.'],
            ['q' => 'How accurate is carbon dating?', 'a' => 'Highly accurate for samples up to 50,000 years old using C-14 half-life of 5,730 years.']
        ],
        'instructions' => ['Enter the initial amount.', 'Provide the half-life period.', 'Input the time elapsed.', 'Results update instantly.'],
        'related_slugs' => ['exponential-decay-calculator', 'exponential-growth-calculator', 'gamma-function-calculator'],
        'canonical' => '/tools/half-life-calculator'
    ],
    'markov-chain-calculator' => [
        'tool_slug' => 'markov-chain-calculator',
        'h1' => 'Markov Chain Steady State Calculator',
        'title' => 'Markov Chain Steady State Calculator - Solve 3x3 Matrices | ToolsHub',
        'meta_description' => 'Calculate the stationary distribution and steady-state probabilities of a Markov chain. Solve 3x3 transition matrices instantly.',
        'article' => "## What is a Markov Chain Steady State?\n\nThe steady state represents the long-term equilibrium of a stochastic process. Our calculator solves the linear equation system (P^T - I)pi = 0 using Gaussian elimination.\n\n## Applications\n- **Economics:** Predicting long-term market share.\n- **Genetics:** Modeling trait inheritance.\n- **Web Analysis:** Understanding PageRank logic.\n- **Weather Forecasting:** Long-term weather probabilities.",
        'faq' => [
            ['q' => 'What is a transition matrix?', 'a' => 'A square matrix where each entry represents the probability of moving between states.'],
            ['q' => 'Does every chain have a steady state?', 'a' => 'Most regular Markov chains have a unique steady state.'],
            ['q' => 'What if row sum is not 1?', 'a' => 'The matrix is invalid as probabilities must sum to 100%.'],
            ['q' => 'Is this useful for inventory?', 'a' => 'Yes, it helps predict stock levels based on demand transitions.'],
            ['q' => 'How many states supported?', 'a' => 'This tool is optimized for 3x3 systems.']
        ],
        'instructions' => ['Enter transition probabilities for each state.', 'Ensure each row sums to 1.', 'The steady state is calculated instantly.', 'Review the percentage breakdown.'],
        'related_slugs' => ['central-limit-theorem-calculator', 'poisson-distribution-calculator', 'probability-calculator'],
        'canonical' => '/tools/markov-chain-calculator'
    ],
    'mst-calculator' => [
        'tool_slug' => 'mst-calculator',
        'h1' => 'Minimum Spanning Tree Calculator',
        'title' => 'Minimum Spanning Tree Calculator - Prim Algorithm | ToolsHub',
        'meta_description' => 'Find the MST of a weighted graph instantly. Accurate logic using Prims algorithm for network optimization.',
        'article' => "## What is a Minimum Spanning Tree?\n\nThe MST minimizes the total edge weight while connecting all nodes without cycles. Uses Prims Algorithm for efficient computation.\n\n## Use Cases\n- **Telecom:** Laying fiber optic cables with minimal material.\n- **Electrical Grids:** Designing efficient power line routes.\n- **Computer Networks:** Building efficient LAN routing paths.\n- **Cluster Analysis:** Identifying related data groups in ML.",
        'faq' => [
            ['q' => 'What is a spanning tree?', 'a' => 'A subgraph that includes all vertices and is a tree (no cycles).'],
            ['q' => 'Can a graph have multiple MSTs?', 'a' => 'Yes, if different edges share the same weight.'],
            ['q' => 'What is the complexity?', 'a' => 'O(V^2) for adjacency matrix, O(E log V) with priority queue.'],
            ['q' => 'Does it work with negative weights?', 'a' => 'Yes, unlike Dijkstra, Prims works with negative weights.'],
            ['q' => 'Why Prims over Kruskals?', 'a' => 'Prims is simpler for adjacency matrix representations.']
        ],
        'instructions' => ['Enter edge weights for the 4-node graph.', 'Use 0 for missing edges.', 'MST weight is computed instantly.', 'Review the connectivity insights.'],
        'related_slugs' => ['dijkstra-calculator', 'entropy-calculator', 'complex-number-calculator'],
        'canonical' => '/tools/mst-calculator'
    ],
    'modular-inverse-calculator' => [
        'tool_slug' => 'modular-inverse-calculator',
        'h1' => 'Modular Multiplicative Inverse Calculator',
        'title' => 'Modular Inverse Calculator - Extended Euclidean | ToolsHub',
        'meta_description' => 'Find the modular multiplicative inverse of a number using the Extended Euclidean Algorithm. Essential for RSA.',
        'article' => "## Modular Inverse\n\nFinds x such that a*x mod m = 1. Uses the Extended Euclidean Algorithm. Critical in RSA encryption.\n\n## Use Cases\n- **Cryptography:** RSA key generation.\n- **Number Theory:** Solving modular equations.\n- **Computer Science:** Hash function design.",
        'faq' => [
            ['q' => 'When does the inverse not exist?', 'a' => 'When GCD(a, m) is not 1.'],
            ['q' => 'Is it used in RSA?', 'a' => 'Yes, for computing the private key.'],
            ['q' => 'What algorithm is used?', 'a' => 'The Extended Euclidean Algorithm.'],
            ['q' => 'Can a be negative?', 'a' => 'Yes, it is normalized to [0, m).'],
            ['q' => 'Is it unique?', 'a' => 'Yes, unique within [0, m).']
        ],
        'instructions' => ['Enter the number a.', 'Enter the modulus m.', 'The inverse is computed instantly.', 'Verify: a * result mod m = 1.'],
        'related_slugs' => ['euler-totient-calculator', 'gcd-calculator', 'chinese-remainder-theorem-calculator'],
        'canonical' => '/tools/modular-inverse-calculator'
    ],
    'percent-growth-calculator' => [
        'tool_slug' => 'percent-growth-calculator',
        'h1' => 'Percent Growth Rate Calculator',
        'title' => 'Percent Growth Rate Calculator - Change Analyzer | ToolsHub',
        'meta_description' => 'Calculate percentage change between two values instantly. Ideal for business KPIs, stocks, and data analysis.',
        'article' => "## Percent Growth\n\nFormula: ((New - Old) / |Old|) * 100. Measures relative change.\n\n## Use Cases\n- **Business:** Revenue growth tracking.\n- **Investing:** Stock performance analysis.\n- **Economics:** GDP year-over-year change.",
        'faq' => [
            ['q' => 'What if old value is 0?', 'a' => 'Division by zero; growth rate is undefined.'],
            ['q' => 'Can it be negative?', 'a' => 'Yes, negative means decline.'],
            ['q' => 'Difference from CAGR?', 'a' => 'This is simple period-to-period growth.'],
            ['q' => 'Is it the same as percentage points?', 'a' => 'No, those are absolute differences.'],
            ['q' => 'Used in finance?', 'a' => 'Essential for earnings reports and KPIs.']
        ],
        'instructions' => ['Enter the old value.', 'Enter the new value.', 'Growth rate is calculated instantly.', 'Review the absolute change.'],
        'related_slugs' => ['exponential-growth-calculator', 'proportion-calculator', 'scientific-notation-calculator'],
        'canonical' => '/tools/percent-growth-calculator'
    ],
    'permutation-calculator' => [
        'tool_slug' => 'permutation-calculator',
        'h1' => 'Permutation Calculator (nPr)',
        'title' => 'Permutation Calculator nPr - Ordered Arrangements | ToolsHub',
        'meta_description' => 'Calculate permutations (nPr) instantly. Find the number of ordered arrangements of r items from n.',
        'article' => "## What is a Permutation?\n\nArrangements where order matters. Formula: n!/(n-r)!.\n\n## Use Cases\n- **Security:** PIN code possibilities.\n- **Sports:** Tournament seedings.\n- **Scheduling:** Task priority orderings.",
        'faq' => [
            ['q' => 'How does it differ from combinations?', 'a' => 'Permutations consider order; combinations do not.'],
            ['q' => 'What is P(5,3)?', 'a' => '60.'],
            ['q' => 'Can r equal n?', 'a' => 'Yes, P(n,n) = n!.'],
            ['q' => 'Is it used in cryptography?', 'a' => 'Yes, for key space calculations.'],
            ['q' => 'Max n supported?', 'a' => 'Up to 170 for standard precision.']
        ],
        'instructions' => ['Enter total items (n).', 'Enter items to arrange (r).', 'Result updates instantly.', 'Compare with nCr in insights.'],
        'related_slugs' => ['combination-calculator', 'factorial-calculator', 'binomial-coefficient-calculator'],
        'canonical' => '/tools/permutation-calculator'
    ],
    'pigeonhole-calculator' => [
        'tool_slug' => 'pigeonhole-calculator',
        'h1' => 'Pigeonhole Principle Calculator',
        'title' => 'Pigeonhole Principle Calculator - Distribution Tool | ToolsHub',
        'meta_description' => 'Apply the Pigeonhole Principle to find the minimum items that must share a container. Dirichlet box principle.',
        'article' => "## Pigeonhole Principle\n\nIf n items are placed into m containers and n > m, at least one container must hold more than one item.\n\n## Use Cases\n- **Computer Science:** Hash collision proofs.\n- **Birthday Problem:** 367 people guarantee a shared birthday.\n- **Network Theory:** Packet routing constraints.",
        'faq' => [
            ['q' => 'What is the formula?', 'a' => 'ceil(items / containers).'],
            ['q' => 'Is it a proof technique?', 'a' => 'Yes, used extensively in combinatorial proofs.'],
            ['q' => 'Real-world example?', 'a' => '13 socks from 12 colors means at least one pair.'],
            ['q' => 'Is it named after pigeons?', 'a' => 'Originally yes, referring to pigeon nesting boxes.'],
            ['q' => 'Can it be generalized?', 'a' => 'Yes, to the generalized pigeonhole principle.']
        ],
        'instructions' => ['Enter number of items.', 'Enter number of containers.', 'Minimum per container is shown.', 'Compare with even distribution.'],
        'related_slugs' => ['combination-calculator', 'derangement-calculator', 'probability-calculator'],
        'canonical' => '/tools/pigeonhole-calculator'
    ],
    'poisson-distribution-calculator' => [
        'tool_slug' => 'poisson-distribution-calculator',
        'h1' => 'Poisson Distribution Calculator',
        'title' => 'Poisson Distribution Calculator - P(X=k) Solver | ToolsHub',
        'meta_description' => 'Calculate exact Poisson probabilities. Model rare events like server errors and customer arrivals.',
        'article' => "## Poisson Distribution\n\nModels the probability of k events in a fixed interval. Formula: P(X=k) = (lambda^k * e^(-lambda)) / k!.\n\n## Use Cases\n- **Call Centers:** Predicting call volume.\n- **Insurance:** Estimating claim frequencies.\n- **Manufacturing:** Defect rate modeling.",
        'faq' => [
            ['q' => 'What is lambda?', 'a' => 'The average rate of events per interval.'],
            ['q' => 'Variance equals mean?', 'a' => 'Yes, both equal lambda.'],
            ['q' => 'When to use Poisson vs Binomial?', 'a' => 'Poisson for rare events with large n and small p.'],
            ['q' => 'Can lambda be a decimal?', 'a' => 'Yes, e.g., 2.5 events per hour.'],
            ['q' => 'Max k supported?', 'a' => 'Up to k=170 for standard precision.']
        ],
        'instructions' => ['Enter the average rate (lambda).', 'Enter target events (k).', 'Probability is computed instantly.', 'Review the variance and std dev.'],
        'related_slugs' => ['binomial-probability-calculator', 'probability-calculator', 'central-limit-theorem-calculator'],
        'canonical' => '/tools/poisson-distribution-calculator'
    ],
    'polynomial-roots-calculator' => [
        'tool_slug' => 'polynomial-roots-calculator',
        'h1' => 'Polynomial Roots Calculator',
        'title' => 'Polynomial Roots Calculator - Cubic & Quadratic | ToolsHub',
        'meta_description' => 'Find roots of polynomials up to degree 3. Uses quadratic formula and Cardano method for cubics.',
        'article' => "## Polynomial Root Finding\n\nSolves linear (cx+d=0), quadratic (bx^2+cx+d=0), and cubic (ax^3+bx^2+cx+d=0) equations.\n\n## Algorithms\n- **Linear:** Direct division.\n- **Quadratic:** Discriminant-based formula.\n- **Cubic:** Cardano or trigonometric method.",
        'faq' => [
            ['q' => 'Does it handle complex roots?', 'a' => 'It identifies when roots are complex but focuses on real roots.'],
            ['q' => 'What is Cardano method?', 'a' => 'A formula for solving depressed cubic equations.'],
            ['q' => 'Can a be zero?', 'a' => 'Yes, it falls back to quadratic or linear solver.'],
            ['q' => 'Accuracy?', 'a' => 'Results to 4 decimal places.'],
            ['q' => 'Does it show all 3 roots?', 'a' => 'It shows the principal real root for cubics.']
        ],
        'instructions' => ['Enter coefficients a, b, c, d.', 'Set a=0 for quadratic, a=b=0 for linear.', 'Principal root is displayed.', 'Check discriminant in sub-stats.'],
        'related_slugs' => ['quadratic-formula-calculator', 'complex-number-calculator', 'scientific-calculator'],
        'canonical' => '/tools/polynomial-roots-calculator'
    ],
    'probability-calculator' => [
        'tool_slug' => 'probability-calculator',
        'h1' => 'Probability Calculator',
        'title' => 'Probability Calculator - Event Likelihood | ToolsHub',
        'meta_description' => 'Calculate the probability of any event. Find odds, complement, and fraction representation instantly.',
        'article' => "## Simple Probability\n\nP(E) = favorable / total. The complement is 1 - P(E).\n\n## Use Cases\n- **Games:** Calculating dice and card probabilities.\n- **Insurance:** Risk assessment.\n- **Statistics:** Hypothesis testing foundations.",
        'faq' => [
            ['q' => 'What are odds?', 'a' => 'Ratio of favorable to unfavorable outcomes.'],
            ['q' => 'Can probability exceed 1?', 'a' => 'No, it ranges from 0 to 1.'],
            ['q' => 'What is the complement?', 'a' => '1 minus the probability of the event.'],
            ['q' => 'Rolling a 6 on a die?', 'a' => '1/6 or about 16.67%.'],
            ['q' => 'Is it free?', 'a' => 'Yes, 100% free and instant.']
        ],
        'instructions' => ['Enter favorable outcomes.', 'Enter total outcomes.', 'View probability, fraction, and odds.', 'Check the complement probability.'],
        'related_slugs' => ['binomial-probability-calculator', 'poisson-distribution-calculator', 'combination-calculator'],
        'canonical' => '/tools/probability-calculator'
    ],
    'probability-distribution-calculator' => [
        'tool_slug' => 'probability-distribution-calculator',
        'h1' => 'Probability Distribution Calculator',
        'title' => 'Probability Distribution Calculator - E(X) | ToolsHub',
        'meta_description' => 'Calculate expected value, variance, and standard deviation for discrete probability distributions.',
        'article' => "## Discrete Probability Distribution\n\nE(X) = sum of x*P(x). Variance = sum of P(x)*(x-E(X))^2.\n\n## Use Cases\n- **Finance:** Expected portfolio returns.\n- **Gaming:** Expected payout calculations.\n- **Quality Control:** Defect rate analysis.",
        'faq' => [
            ['q' => 'Must probabilities sum to 1?', 'a' => 'Yes, for a valid distribution.'],
            ['q' => 'What is expected value?', 'a' => 'The long-run average of a random variable.'],
            ['q' => 'Can x values be negative?', 'a' => 'Yes, e.g., profit/loss scenarios.'],
            ['q' => 'How many outcomes?', 'a' => 'Up to 5 discrete outcomes.'],
            ['q' => 'What if probabilities sum above 1?', 'a' => 'A warning is displayed.']
        ],
        'instructions' => ['Enter up to 5 outcome values.', 'Enter corresponding probabilities.', 'E(X) and variance are shown.', 'Ensure probabilities sum to 1.'],
        'related_slugs' => ['probability-calculator', 'poisson-distribution-calculator', 'binomial-probability-calculator'],
        'canonical' => '/tools/probability-distribution-calculator'
    ],
    'proportion-calculator' => [
        'tool_slug' => 'proportion-calculator',
        'h1' => 'Proportion Calculator',
        'title' => 'Proportion Calculator - Cross Multiply Solver | ToolsHub',
        'meta_description' => 'Solve proportions a/b = c/d. Find the missing variable using cross multiplication. Instant results.',
        'article' => "## Proportions\n\nSolves a/b = c/d by cross multiplication (a*d = b*c).\n\n## Use Cases\n- **Cooking:** Scaling recipes.\n- **Maps:** Converting scale distances.\n- **Chemistry:** Dilution calculations.",
        'faq' => [
            ['q' => 'How does cross multiply work?', 'a' => 'a*d = b*c; solve for the unknown.'],
            ['q' => 'Which value is solved?', 'a' => 'The one set to 0 (leave blank).'],
            ['q' => 'Can all values be provided?', 'a' => 'Yes, it then shows the ratio.'],
            ['q' => 'Is it used in nursing?', 'a' => 'Yes, for drug dosage calculations.'],
            ['q' => 'Accuracy?', 'a' => '4 decimal places.']
        ],
        'instructions' => ['Enter three known values.', 'Set the unknown to 0.', 'The missing value is computed.', 'Verify with cross product check.'],
        'related_slugs' => ['percent-growth-calculator', 'scientific-calculator', 'quadratic-formula-calculator'],
        'canonical' => '/tools/proportion-calculator'
    ],
    'quadratic-formula-calculator' => [
        'tool_slug' => 'quadratic-formula-calculator',
        'h1' => 'Quadratic Formula Calculator',
        'title' => 'Quadratic Formula Calculator - ax2+bx+c Solver | ToolsHub',
        'meta_description' => 'Solve quadratic equations with the quadratic formula. Shows real/complex roots, discriminant, and vertex.',
        'article' => "## The Quadratic Formula\n\nx = (-b +/- sqrt(b^2-4ac)) / 2a. Universally solves ax^2+bx+c=0.\n\n## Features\n- Real and complex root detection.\n- Discriminant analysis.\n- Vertex coordinate computation.",
        'faq' => [
            ['q' => 'What if discriminant is negative?', 'a' => 'The roots are complex (imaginary).'],
            ['q' => 'What is the vertex?', 'a' => 'The peak or trough of the parabola at (-b/2a, f(-b/2a)).'],
            ['q' => 'Can a be zero?', 'a' => 'No, then it is linear, not quadratic.'],
            ['q' => 'What is discriminant 0?', 'a' => 'One repeated (double) root.'],
            ['q' => 'Used in physics?', 'a' => 'Yes, for projectile motion equations.']
        ],
        'instructions' => ['Enter coefficients a, b, c.', 'Roots are displayed instantly.', 'Check discriminant for root type.', 'View vertex coordinates.'],
        'related_slugs' => ['polynomial-roots-calculator', 'scientific-calculator', 'complex-number-calculator'],
        'canonical' => '/tools/quadratic-formula-calculator'
    ],
    'scientific-calculator' => [
        'tool_slug' => 'scientific-calculator',
        'h1' => 'Scientific Calculator',
        'title' => 'Scientific Calculator Online - Expression Evaluator | ToolsHub',
        'meta_description' => 'Evaluate complex math expressions with sin, cos, tan, sqrt, log, ln, pi, e, and exponents. Free online tool.',
        'article' => "## Scientific Calculator\n\nEvaluates arbitrary mathematical expressions including trigonometric functions, logarithms, and constants.\n\n## Supported Functions\n- sin, cos, tan (radians)\n- sqrt, log (base 10), ln (natural)\n- pi, e, ^ (power)",
        'faq' => [
            ['q' => 'Are trig functions in radians?', 'a' => 'Yes, convert degrees first if needed.'],
            ['q' => 'Does log mean base 10?', 'a' => 'Yes. Use ln() for natural log.'],
            ['q' => 'Can I use parentheses?', 'a' => 'Yes, standard order of operations.'],
            ['q' => 'What is ^ for?', 'a' => 'Exponentiation (e.g., 2^3 = 8).'],
            ['q' => 'Is it free?', 'a' => 'Yes, unlimited calculations.']
        ],
        'instructions' => ['Type your expression.', 'Result appears instantly.', 'Check scientific notation output.', 'Use pi and e as constants.'],
        'related_slugs' => ['scientific-notation-calculator', 'quadratic-formula-calculator', 'exponents-calculator'],
        'canonical' => '/tools/scientific-calculator'
    ],
    'scientific-notation-calculator' => [
        'tool_slug' => 'scientific-notation-calculator',
        'h1' => 'Scientific Notation Calculator',
        'title' => 'Scientific Notation Converter - Number Formatter | ToolsHub',
        'meta_description' => 'Convert numbers to scientific notation. Shows coefficient, exponent, and standard form instantly.',
        'article' => "## Scientific Notation\n\nRepresents numbers as coefficient x 10^n where 1 <= |coefficient| < 10.\n\n## Use Cases\n- **Astronomy:** Distances in light-years.\n- **Chemistry:** Avogadro number.\n- **Physics:** Planck constant.",
        'faq' => [
            ['q' => 'What is 93,000,000 in sci notation?', 'a' => '9.3 x 10^7.'],
            ['q' => 'Can it handle negatives?', 'a' => 'Yes, the sign is preserved.'],
            ['q' => 'What about very small numbers?', 'a' => 'Negative exponents (e.g., 0.005 = 5 x 10^-3).'],
            ['q' => 'Is this the same as E notation?', 'a' => 'Yes, 9.3E7 = 9.3 x 10^7.'],
            ['q' => 'Max precision?', 'a' => '6 decimal places for coefficient.']
        ],
        'instructions' => ['Enter any number.', 'Scientific notation appears instantly.', 'View coefficient and exponent.', 'Use for engineering calculations.'],
        'related_slugs' => ['scientific-calculator', 'significant-figures-calculator', 'exponents-calculator'],
        'canonical' => '/tools/scientific-notation-calculator'
    ],
    'set-theory-calculator' => [
        'tool_slug' => 'set-theory-calculator',
        'h1' => 'Set Theory Calculator',
        'title' => 'Set Theory Calculator - Union Intersection Diff | ToolsHub',
        'meta_description' => 'Compute Union, Intersection, and Difference of two sets. Enter elements as comma-separated values.',
        'article' => "## Set Operations\n\nCompute A union B, A intersect B, A-B, and B-A from comma-separated inputs.\n\n## Use Cases\n- **Databases:** SQL JOIN operations.\n- **Logic:** Venn diagram regions.\n- **Probability:** Event combinations.",
        'faq' => [
            ['q' => 'What is the union?', 'a' => 'All elements in A or B (no duplicates).'],
            ['q' => 'What is intersection?', 'a' => 'Elements in both A and B.'],
            ['q' => 'What is A-B?', 'a' => 'Elements in A but not in B.'],
            ['q' => 'Case sensitive?', 'a' => 'Yes, a and A are different.'],
            ['q' => 'Can I use words?', 'a' => 'Yes, any comma-separated values.']
        ],
        'instructions' => ['Enter Set A elements comma-separated.', 'Enter Set B elements.', 'All operations computed instantly.', 'Results shown in insights.'],
        'related_slugs' => ['venn-diagram-calculator', 'probability-calculator', 'truth-table-generator'],
        'canonical' => '/tools/set-theory-calculator'
    ],
    'significant-figures-calculator' => [
        'tool_slug' => 'significant-figures-calculator',
        'h1' => 'Significant Figures Calculator',
        'title' => 'Significant Figures Calculator - Sig Figs Counter | ToolsHub',
        'meta_description' => 'Count significant figures in any number. Provides rounded versions and scientific notation equivalents.',
        'article' => "## Significant Figures\n\nImportant for measurement precision. Leading zeros are never significant; trailing zeros after decimal are.\n\n## Use Cases\n- **Lab Reports:** Proper data reporting.\n- **Engineering:** Tolerance specifications.\n- **Chemistry:** Measurement precision.",
        'faq' => [
            ['q' => 'Are leading zeros significant?', 'a' => 'Never.'],
            ['q' => 'Trailing zeros with decimal?', 'a' => 'Yes, they are significant.'],
            ['q' => 'What about 100?', 'a' => 'Ambiguous: 1, 2, or 3 sig figs depending on context.'],
            ['q' => 'How to remove ambiguity?', 'a' => 'Use scientific notation.'],
            ['q' => 'Is 0.00450 three sig figs?', 'a' => 'Yes: 4, 5, and the trailing 0.']
        ],
        'instructions' => ['Enter your number as text.', 'Sig fig count appears instantly.', 'Check the rounded versions.', 'View scientific notation.'],
        'related_slugs' => ['scientific-notation-calculator', 'scientific-calculator', 'proportion-calculator'],
        'canonical' => '/tools/significant-figures-calculator'
    ],
    'stirling-numbers-calculator' => [
        'tool_slug' => 'stirling-numbers-calculator',
        'h1' => 'Stirling Numbers Calculator (Second Kind)',
        'title' => 'Stirling Numbers Calculator S(n,k) | ToolsHub',
        'meta_description' => 'Calculate Stirling numbers of the second kind. Find the number of ways to partition n elements into k subsets.',
        'article' => "## Stirling Numbers\n\nS(n,k) counts ways to partition n elements into k non-empty subsets. Uses dynamic programming.\n\n## Use Cases\n- **Combinatorics:** Set partition counting.\n- **Coding Theory:** Error correction.\n- **Polynomial Interpolation:** Basis functions.",
        'faq' => [
            ['q' => 'What is S(4,2)?', 'a' => '7.'],
            ['q' => 'Recurrence relation?', 'a' => 'S(n,k) = k*S(n-1,k) + S(n-1,k-1).'],
            ['q' => 'Is S(n,1) always 1?', 'a' => 'Yes.'],
            ['q' => 'Is S(n,n) always 1?', 'a' => 'Yes.'],
            ['q' => 'Related to Bell numbers?', 'a' => 'Yes, B(n) = sum of S(n,k) for all k.']
        ],
        'instructions' => ['Enter n (elements).', 'Enter k (subsets).', 'S(n,k) is computed via DP.', 'Review the recurrence in insights.'],
        'related_slugs' => ['combination-calculator', 'factorial-calculator', 'derangement-calculator'],
        'canonical' => '/tools/stirling-numbers-calculator'
    ],
    'sum-of-cubes-calculator' => [
        'tool_slug' => 'sum-of-cubes-calculator',
        'h1' => 'Sum of Cubes Calculator',
        'title' => 'Sum of Cubes Calculator - Nicomachus Theorem | ToolsHub',
        'meta_description' => 'Calculate the sum of cubes from 1 to n. Uses the beautiful identity [n(n+1)/2] squared.',
        'article' => "## Sum of Cubes\n\nThe sum of cubes equals the square of the sum of integers: [n(n+1)/2]^2.\n\n## Fun Fact\nThis identity is sometimes called Nicomachus theorem, dating back to ancient Greek mathematics.\n\n## Use Cases\n- **Number Theory:** Proof exercises.\n- **Physics:** Moment of inertia approximations.",
        'faq' => [
            ['q' => 'Formula?', 'a' => '[n(n+1)/2]^2.'],
            ['q' => 'Sum of cubes 1 to 10?', 'a' => '3025.'],
            ['q' => 'Why does it equal (sum of integers)^2?', 'a' => 'A beautiful algebraic identity proven by induction.'],
            ['q' => 'Is it related to Fermats theorem?', 'a' => 'Not directly, but both involve power sums.'],
            ['q' => 'Can n be 0?', 'a' => 'Yes, result is 0.']
        ],
        'instructions' => ['Enter n.', 'Sum of cubes appears.', 'Compare with sum of integers and squares.', 'Verify the identity.'],
        'related_slugs' => ['sum-of-squares-calculator', 'sum-of-integers-calculator', 'factorial-calculator'],
        'canonical' => '/tools/sum-of-cubes-calculator'
    ],
    'sum-of-integers-calculator' => [
        'tool_slug' => 'sum-of-integers-calculator',
        'h1' => 'Sum of Positive Integers Calculator',
        'title' => 'Sum of Integers Calculator - Gauss Formula | ToolsHub',
        'meta_description' => 'Calculate 1 + 2 + 3 + ... + n using Gauss formula n(n+1)/2. Lightning fast for any n.',
        'article' => "## Gauss Sum\n\nn(n+1)/2. Young Gauss famously computed 1+2+...+100 = 5050 by pairing numbers.\n\n## Use Cases\n- **Education:** Teaching series and sequences.\n- **Programming:** Loop optimization.\n- **Statistics:** Triangular numbers.",
        'faq' => [
            ['q' => 'What is 1+2+...+100?', 'a' => '5050.'],
            ['q' => 'Who discovered this?', 'a' => 'Carl Friedrich Gauss (legend says at age 10).'],
            ['q' => 'Is it always an integer?', 'a' => 'Yes, one of n or n+1 is always even.'],
            ['q' => 'What are triangular numbers?', 'a' => 'Numbers that form equilateral triangles: 1, 3, 6, 10...'],
            ['q' => 'Used in CS?', 'a' => 'Yes, for nested loop analysis (O(n^2)).']
        ],
        'instructions' => ['Enter n.', 'Sum appears instantly.', 'Compare with n squared.', 'View the average value.'],
        'related_slugs' => ['sum-of-squares-calculator', 'sum-of-cubes-calculator', 'factorial-calculator'],
        'canonical' => '/tools/sum-of-integers-calculator'
    ],
    'sum-of-squares-calculator' => [
        'tool_slug' => 'sum-of-squares-calculator',
        'h1' => 'Sum of Squares Calculator',
        'title' => 'Sum of Squares Calculator - Variance Tool | ToolsHub',
        'meta_description' => 'Calculate the sum of squares from 1 to n. Formula n(n+1)(2n+1)/6. Critical for statistics.',
        'article' => "## Sum of Squares\n\nFormula: n(n+1)(2n+1)/6. Fundamental in variance and regression.\n\n## Use Cases\n- **Statistics:** Variance computation.\n- **ANOVA:** F-test numerator.\n- **Regression:** Least squares fitting.",
        'faq' => [
            ['q' => 'Sum of squares 1 to 10?', 'a' => '385.'],
            ['q' => 'Used in regression?', 'a' => 'Yes, for calculating residual sums.'],
            ['q' => 'Related to variance?', 'a' => 'Yes, variance uses sum of squared deviations.'],
            ['q' => 'Is the formula exact?', 'a' => 'Yes, always yields an integer.'],
            ['q' => 'Can n be very large?', 'a' => 'Yes, uses closed form so its instant.']
        ],
        'instructions' => ['Enter n.', 'Sum of sqaures appears.', 'Compare with sum of integers and cubes.', 'Use for statistical calculations.'],
        'related_slugs' => ['sum-of-cubes-calculator', 'sum-of-integers-calculator', 'probability-distribution-calculator'],
        'canonical' => '/tools/sum-of-squares-calculator'
    ],
    'truth-table-generator' => [
        'tool_slug' => 'truth-table-generator',
        'h1' => 'Truth Table Generator',
        'title' => 'Truth Table Generator - Logic Gate Solver | ToolsHub',
        'meta_description' => 'Generate truth tables for AND, OR, XOR, NAND, NOR, IMPLIES, BICONDITIONAL on two variables P and Q.',
        'article' => "## Truth Tables\n\nMap all input combinations to outputs for logical operations. Essential for digital logic design.\n\n## Supported Operations\nAND, OR, XOR, NAND, NOR, IMPLIES, BICONDITIONAL.\n\n## Use Cases\n- **Digital Electronics:** Circuit design.\n- **Philosophy:** Formal logic proofs.\n- **Programming:** Boolean expression optimization.",
        'faq' => [
            ['q' => 'What is a tautology?', 'a' => 'A statement that is always true (all rows are T).'],
            ['q' => 'What is NAND?', 'a' => 'NOT AND - false only when both inputs are true.'],
            ['q' => 'What is IMPLIES?', 'a' => 'P implies Q is false only when P is true and Q is false.'],
            ['q' => 'How many rows for 2 variables?', 'a' => '4 (2^2).'],
            ['q' => 'Used in circuit design?', 'a' => 'Yes, NAND gates are universal.']
        ],
        'instructions' => ['Select a logical operation.', 'Truth table for P and Q is generated.', 'Check if result is a tautology.', 'Count true vs false outcomes.'],
        'related_slugs' => ['set-theory-calculator', 'probability-calculator', 'venn-diagram-calculator'],
        'canonical' => '/tools/truth-table-generator'
    ],
    'venn-diagram-calculator' => [
        'tool_slug' => 'venn-diagram-calculator',
        'h1' => 'Venn Diagram Generator (3 Sets)',
        'title' => 'Venn Diagram Calculator 3 Sets - Set Visualizer | ToolsHub',
        'meta_description' => 'Calculate set sizes and overlaps for 3-set Venn diagrams. Input region counts and compute unions and intersections.',
        'article' => "## 3-Set Venn Diagrams\n\nInput the count of elements in each of the 7 regions of a 3-circle Venn diagram.\n\n## Use Cases\n- **Survey Analysis:** Overlapping preferences.\n- **Education:** Teaching set theory.\n- **Data Analysis:** Category overlap visualization.",
        'faq' => [
            ['q' => 'How many regions in a 3-set Venn?', 'a' => '7 regions plus the universal set complement.'],
            ['q' => 'What is A intersect B intersect C?', 'a' => 'Elements in all three sets simultaneously.'],
            ['q' => 'Can regions be 0?', 'a' => 'Yes, meaning no elements in that region.'],
            ['q' => 'Is this for visualization?', 'a' => 'It computes values; visualization is in the insights.'],
            ['q' => 'Used in probability?', 'a' => 'Yes, for inclusion-exclusion principle problems.']
        ],
        'instructions' => ['Enter counts for each exclusive region.', 'Enter pairwise overlaps.', 'Enter the triple overlap.', 'Union and set sizes are computed.'],
        'related_slugs' => ['set-theory-calculator', 'truth-table-generator', 'probability-calculator'],
        'canonical' => '/tools/venn-diagram-calculator'
    ],
];

$seoFile = 'd:/Xamp/htdocs/ToolsHub/storage/seo_pages.php';
$existing = include $seoFile;
if (!isset($existing['pages']) || !is_array($existing['pages'])) $existing['pages'] = [];
foreach ($newPages as $slug => $data) $existing['pages'][$slug] = $data;
$content = "<?php\n\nreturn " . var_export($existing, true) . ";\n";
if (file_put_contents($seoFile, $content)) {
    echo "SUCCESS: Injected SEO for 23 new math tools.\nTotal pages: " . count($existing['pages']) . "\n";
} else {
    echo "FAILED\n";
}
