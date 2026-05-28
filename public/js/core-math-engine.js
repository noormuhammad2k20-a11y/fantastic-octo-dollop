/**
 * CoreMathEngine — Shared Utility Library for Math Toolbox
 * Provides DRY utility functions used across all 21+ math calculator tools.
 * Zero external dependencies. Safe (no eval). Handles edge cases gracefully.
 */
class CoreMathEngine {

    // ── GCD (Euclidean) ──────────────────────────────────────────
    static gcd(a, b) {
        a = Math.abs(Math.round(a));
        b = Math.abs(Math.round(b));
        while (b) { [a, b] = [b, a % b]; }
        return a;
    }

    static gcdArray(arr) {
        return arr.reduce((acc, v) => CoreMathEngine.gcd(acc, v));
    }

    // ── LCM ──────────────────────────────────────────────────────
    static lcm(a, b) {
        a = Math.abs(Math.round(a));
        b = Math.abs(Math.round(b));
        if (a === 0 || b === 0) return 0;
        return (a / CoreMathEngine.gcd(a, b)) * b;
    }

    static lcmArray(arr) {
        return arr.reduce((acc, v) => CoreMathEngine.lcm(acc, v));
    }

    // ── Prime utilities ──────────────────────────────────────────
    static isPrime(n) {
        n = Math.abs(Math.round(n));
        if (n < 2) return false;
        if (n < 4) return true;
        if (n % 2 === 0 || n % 3 === 0) return false;
        for (let i = 5; i * i <= n; i += 6) {
            if (n % i === 0 || n % (i + 2) === 0) return false;
        }
        return true;
    }

    static primeFactors(n) {
        n = Math.abs(Math.round(n));
        const factors = [];
        if (n < 2) return factors;
        for (let d = 2; d * d <= n; d++) {
            while (n % d === 0) { factors.push(d); n /= d; }
        }
        if (n > 1) factors.push(n);
        return factors;
    }

    static primeFactorization(n) {
        const factors = CoreMathEngine.primeFactors(n);
        const map = {};
        factors.forEach(f => { map[f] = (map[f] || 0) + 1; });
        return map; // e.g. {2:3, 3:1} for 24
    }

    // ── Factorial ────────────────────────────────────────────────
    static factorial(n) {
        n = Math.round(n);
        if (n < 0) return NaN;
        if (n <= 1) return 1;
        if (n > 170) return Infinity; // JS Number limit
        let result = 1;
        for (let i = 2; i <= n; i++) result *= i;
        return result;
    }

    // ── N-th Root ────────────────────────────────────────────────
    static nthRoot(x, n) {
        if (n === 0) return NaN;
        if (x < 0 && n % 2 === 0) return NaN;
        if (x < 0) return -Math.pow(-x, 1 / n);
        return Math.pow(x, 1 / n);
    }

    // ── Common Factors (all divisors) ────────────────────────────
    static allFactors(n) {
        n = Math.abs(Math.round(n));
        if (n === 0) return [];
        const factors = [];
        for (let i = 1; i * i <= n; i++) {
            if (n % i === 0) {
                factors.push(i);
                if (i !== n / i) factors.push(n / i);
            }
        }
        return factors.sort((a, b) => a - b);
    }

    static commonFactors(a, b) {
        const fa = new Set(CoreMathEngine.allFactors(a));
        const fb = CoreMathEngine.allFactors(b);
        return fb.filter(x => fa.has(x)).sort((a, b) => a - b);
    }

    // ── Input parsing ────────────────────────────────────────────
    static parseNumberList(str) {
        if (!str || typeof str !== 'string') return [];
        return str
            .replace(/[^\d.\-\s,;]/g, '')
            .split(/[\s,;]+/)
            .map(s => s.trim())
            .filter(s => s.length > 0)
            .map(Number)
            .filter(n => !isNaN(n));
    }

    // ── Formatting ───────────────────────────────────────────────
    static fmt(n, decimals = 6) {
        if (typeof n !== 'number' || isNaN(n)) return 'NaN';
        if (!isFinite(n)) return n > 0 ? '∞' : '-∞';
        const s = n.toFixed(decimals);
        return s.replace(/\.?0+$/, '') || '0';
    }

    static fmtBig(n) {
        if (typeof n !== 'number' || isNaN(n)) return 'NaN';
        if (!isFinite(n)) return '∞';
        return n.toLocaleString('en-US', { maximumFractionDigits: 0 });
    }

    // ── Validation helpers ───────────────────────────────────────
    static isValid(n) {
        return typeof n === 'number' && isFinite(n) && !isNaN(n);
    }

    static safeDiv(a, b) {
        if (b === 0) return { error: true, msg: 'Division by zero' };
        return { error: false, quotient: Math.floor(a / b), remainder: a % b, decimal: a / b };
    }

    // ── Divisibility tests ───────────────────────────────────────
    static divisibilityTests(n) {
        n = Math.abs(Math.round(n));
        return {
            2: n % 2 === 0,
            3: n % 3 === 0,
            4: n % 4 === 0,
            5: n % 5 === 0,
            6: n % 6 === 0,
            7: n % 7 === 0,
            8: n % 8 === 0,
            9: n % 9 === 0,
            10: n % 10 === 0,
            11: n % 11 === 0,
            12: n % 12 === 0,
        };
    }

    // ── Digits of Pi (Machin's formula series, precomputed) ──────
    static digitsOfPi(n) {
        n = Math.min(Math.max(1, Math.round(n)), 1000);
        // Use pre-stored 1000 digits (fastest, no arbitrary precision needed)
        const PI_STR = '3.1415926535897932384626433832795028841971693993751058209749445923078164062862089986280348253421170679821480865132823066470938446095505822317253594081284811174502841027019385211055596446229489549303819644288109756659334461284756482337867831652712019091456485669234603486104543266482133936072602491412737245870066063155881748815209209628292540917153643678925903600113305305488204665213841469519415116094330572703657595919530921861173819326117931051185480744623799627495673518857527248912279381830119491298336733624406566430860213949463952247371907021798609437027705392171762931767523846748184676694051320005681271452635608277857713427577896091736371787214684409012249534301465495853710507922796892589235420199561121290219608640344181598136297747713099605187072113499999983729780499510597317328160963185950244594553469083026425223082533446850352619311881710100031378387528865875332083814206171776691473035982534904287554687311595628638823537875937519577818577805321712268066130019278766111959092164201989';
        return PI_STR.substring(0, n + 1); // +1 for "3."
    }

    // ── Digits of e (precomputed) ───────────────────────────────
    static digitsOfE(n) {
        n = Math.min(Math.max(1, Math.round(n)), 1000);
        const E_STR = '2.7182818284590452353602874713526624977572470936999595749669676277240766303535475945713821785251664274274663919320030599218174135966290435729003342952605956307381323286279434907632338298807531952510190115738341879307021540891499348841675092447614606680822648001684774118537423454424371075390777449920695517027618386062613313845830007520449338265602976067371132007093287091274437470472306969772093101416928368190255151086574637721112523897844250569536967707854499699679468644549059879316368892300987931277361782154249992295763514822082698951936680331825288693984964651058209392398294887933203625094431173012381970684161403970198376793206832823764648042953118023287825098194558153017567173613320698112509961818815930416903515988885193458072738667385894228792284998920868058257492796104841984443634632449684875602336248270419786232090021609902353043699418491463140934317381436405462531520961836908887070167683964243781405927145635490613031072085103837505101157477041718986106873969655212671546889570350354021234078498193343210681701210056278802';
        return E_STR.substring(0, n + 1);
    }

    // ── Long Division with steps ─────────────────────────────────
    static longDivision(dividend, divisor) {
        if (divisor === 0) return { error: true, msg: 'Cannot divide by zero' };

        const isNeg = (dividend < 0) !== (divisor < 0);
        dividend = Math.abs(Math.round(dividend));
        divisor = Math.abs(Math.round(divisor));

        const digits = String(dividend).split('').map(Number);
        const steps = [];
        let carry = 0;
        let quotientStr = '';

        for (let i = 0; i < digits.length; i++) {
            carry = carry * 10 + digits[i];
            const q = Math.floor(carry / divisor);
            quotientStr += q;
            const product = q * divisor;
            steps.push({
                bringDown: digits[i],
                current: carry,
                quotientDigit: q,
                product: product,
                remainder: carry - product
            });
            carry = carry - product;
        }

        return {
            error: false,
            quotient: parseInt(quotientStr) * (isNeg ? -1 : 1),
            remainder: carry,
            steps: steps,
            expression: `${isNeg ? '-' : ''}${dividend} ÷ ${divisor} = ${parseInt(quotientStr) * (isNeg ? -1 : 1)} R ${carry}`
        };
    }

    // ── NEW: Step Generation Helpers ──────────────────────────────
    static getEuclideanSteps(a, b) {
        a = Math.abs(Math.round(a));
        b = Math.abs(Math.round(b));
        if (a < b) [a, b] = [b, a];
        const steps = [];
        while (b) {
            const r = a % b;
            const q = Math.floor(a / b);
            steps.push(`${a} = (${b} × ${q}) + ${r}`);
            a = b;
            b = r;
        }
        return steps;
    }

    static getPrimeFactorizationSteps(n) {
        n = Math.abs(Math.round(n));
        if (n < 2) return ["Number must be ≥ 2"];
        const steps = [];
        let temp = n;
        for (let d = 2; d * d <= temp; d++) {
            while (temp % d === 0) {
                steps.push(`${temp} ÷ ${d} = ${temp / d}`);
                temp /= d;
            }
        }
        if (temp > 1) steps.push(`${temp} is prime. Stop.`);
        return steps;
    }

    static getDivisibilityInsights(n) {
        const tests = this.divisibilityTests(n);
        const insights = [];
        if (tests[2]) insights.push("It is an <strong>even number</strong> (ends in " + (n % 10) + ").");
        if (tests[5]) insights.push("It is divisible by <strong>5</strong> because it ends in " + (n % 10) + ".");
        if (tests[3]) insights.push("The sum of digits is divisible by <strong>3</strong>.");
        if (this.isPrime(n)) insights.push("Interesting: This is a <strong>Prime Number</strong>.");
        return insights;
    }

    // ── Trigonometry & Geometry ──────────────────────────────────
    static degToRad(deg) { return deg * (Math.PI / 180); }
    static radToDeg(rad) { return rad * (180 / Math.PI); }

    // ── Constants ────────────────────────────────────────────────
    static get PHI() { return (1 + Math.sqrt(5)) / 2; }

    static getCartesianToPolar(x, y) {
        const r = Math.sqrt(x * x + y * y);
        const thetaRad = Math.atan2(y, x);
        const thetaDeg = this.radToDeg(thetaRad);
        
        let quadrant = 0;
        if (x > 0 && y > 0) quadrant = 1;
        else if (x < 0 && y > 0) quadrant = 2;
        else if (x < 0 && y < 0) quadrant = 3;
        else if (x > 0 && y < 0) quadrant = 4;

        return {
            r: r,
            thetaRad: thetaRad,
            thetaDeg: thetaDeg,
            quadrant: quadrant,
            isAxis: x === 0 || y === 0
        };
    }

    static ellipseCircumference(a, b) {
        // Ramanujan approximation (Formula 2 - highly accurate)
        const h = Math.pow(a - b, 2) / Math.pow(a + b, 2);
        return Math.PI * (a + b) * (1 + (3 * h) / (10 + Math.sqrt(4 - 3 * h)));
    }

    static getTriangleSSS(a, b, c) {
        if (a + b <= c || a + c <= b || b + c <= a) return null;
        const cosA = (b * b + c * c - a * a) / (2 * b * c);
        const cosB = (a * a + c * c - b * b) / (2 * a * c);
        
        const A = Math.acos(Math.max(-1, Math.min(1, cosA))) * (180 / Math.PI);
        const B = Math.acos(Math.max(-1, Math.min(1, cosB))) * (180 / Math.PI);
        const C = 180 - A - B;
        
        const s = (a + b + c) / 2;
        const area = Math.sqrt(s * (s - a) * (s - b) * (s - c));
        const perimeter = a + b + c;
        
        return { A, B, C, area, perimeter };
    }

    // ── Gamma Function (Lanczos approximation) ───────────────────
    static gamma(n) {
        const g = 7;
        const p = [
            0.99999999999980993, 676.5203681218851, -1259.1392167224028,
            771.32342877765313, -176.61502916214059, 12.507343278686905,
            -0.13857109526572012, 9.9843695780195716e-6, 1.5056327351493116e-7
        ];
        if (n < 0.5) return Math.PI / (Math.sin(Math.PI * n) * CoreMathEngine.gamma(1 - n));
        n -= 1;
        let x = p[0];
        for (let i = 1; i < g + 2; i++) x += p[i] / (n + i);
        const t = n + g + 0.5;
        return Math.sqrt(2 * Math.PI) * Math.pow(t, n + 0.5) * Math.exp(-t) * x;
    }

    // ── Beta Function ────────────────────────────────────────────
    static beta(x, y) {
        return (CoreMathEngine.gamma(x) * CoreMathEngine.gamma(y)) / CoreMathEngine.gamma(x + y);
    }
    
    // ── Error Function (Abramowitz and Stegun approximation) ─────
    static erf(x) {
        const a1 =  0.254829592, a2 = -0.284496736, a3 =  1.421413741;
        const a4 = -1.453152027, a5 =  1.061405429, p  =  0.3275911;
        const sign = (x < 0) ? -1 : 1;
        x = Math.abs(x);
        const t = 1.0 / (1.0 + p * x);
        const y = 1.0 - (((((a5 * t + a4) * t) + a3) * t + a2) * t + a1) * t * Math.exp(-x * x);
        return sign * y;
    }

    static erfc(x) {
        return 1 - CoreMathEngine.erf(x);
    }

    // ── Extended Euclidean Algorithm ──────────────────────────────
    static extendedGcd(a, b) {
        let old_r = BigInt(a), r = BigInt(b);
        let old_s = 1n, s = 0n;
        let old_t = 0n, t = 1n;
        
        while (r !== 0n) {
            let quotient = old_r / r;
            [old_r, r] = [r, old_r - quotient * r];
            [old_s, s] = [s, old_s - quotient * s];
            [old_t, t] = [t, old_t - quotient * t];
        }
        
        return {
            gcd: old_r,
            x: old_s,
            y: old_t
        };
    }

    // ── Stirling Number 2nd Kind (Recursive) ──────────────────────
    static stirling2(n, k) {
        if (k === 0 && n === 0) return 1;
        if (k === 0 || k > n) return 0;
        if (k === 1 || k === n) return 1;
        // Optimization for small-ish values
        let memo = {};
        const solve = (nn, kk) => {
            if (kk === 1 || kk === nn) return 1n;
            const key = `${nn},${kk}`;
            if (memo[key]) return memo[key];
            memo[key] = BigInt(kk) * solve(nn - 1, kk) + solve(nn - 1, kk - 1);
            return memo[key];
        };
        return solve(n, k);
    }

    // ── Stirling Number 1st Kind (Unsigned, Recursive) ────────────
    static stirling1(n, k) {
        if (k === 0 && n === 0) return 1;
        if (k === 0 || k > n) return 0;
        if (k === 1) return CoreMathEngine.factorial(n - 1);
        if (k === n) return 1;
        let memo = {};
        const solve = (nn, kk) => {
            if (kk === nn) return 1n;
            if (kk === 0 || kk > nn) return 0n;
            const key = `${nn},${kk}`;
            if (memo[key]) return memo[key];
            memo[key] = BigInt(nn - 1) * solve(nn - 1, kk) + solve(nn - 1, kk - 1);
            return memo[key];
        };
        return solve(n, k);
    }

    // ── Logarithms ────────────────────────────────────────────────
    static logBase(n, base) {
        if (n <= 0 || base <= 0 || base === 1) return NaN;
        return Math.log(n) / Math.log(base);
    }

    static antilog(n, base) {
        return Math.pow(base, n);
    }

    // ══════════════════════════════════════════════════════════════
    // GEOMETRY HELPERS
    // ══════════════════════════════════════════════════════════════

    static hypotenuse(a, b) { return Math.sqrt(a * a + b * b); }

    static pointToPlaneDistance(px, py, pz, a, b, c, d) {
        return Math.abs(a * px + b * py + c * pz + d) / Math.sqrt(a * a + b * b + c * c);
    }

    static polarToCartesian(r, theta, unit) {
        const rad = unit === 'degrees' ? this.degToRad(theta) : theta;
        return { x: r * Math.cos(rad), y: r * Math.sin(rad) };
    }

    static polygonDiagonals(n) {
        return (n * (n - 3)) / 2;
    }

    static rectangleProps(l, w) {
        return {
            area: l * w,
            perimeter: 2 * (l + w),
            diagonal: Math.sqrt(l * l + w * w)
        };
    }

    static shoelaceArea(points) {
        let area = 0;
        const n = points.length;
        for (let i = 0; i < n; i++) {
            const j = (i + 1) % n;
            area += points[i][0] * points[j][1];
            area -= points[j][0] * points[i][1];
        }
        return Math.abs(area) / 2;
    }

    static slopeCalc(x1, y1, x2, y2) {
        if (x2 === x1) return { slope: Infinity, type: 'vertical' };
        const m = (y2 - y1) / (x2 - x1);
        const b = y1 - m * x1;
        const angle = Math.atan(m) * (180 / Math.PI);
        const dist = Math.sqrt((x2 - x1) ** 2 + (y2 - y1) ** 2);
        return { slope: m, intercept: b, angle, distance: dist, type: m === 0 ? 'horizontal' : 'oblique' };
    }

    static slopeInterceptForm(m, x, y) {
        const b = y - m * x;
        return { m, b, equation: `y = ${m}x + ${b}` };
    }

    static sphereProps(r) {
        return {
            volume: (4 / 3) * Math.PI * r * r * r,
            surfaceArea: 4 * Math.PI * r * r,
            diameter: 2 * r,
            circumference: 2 * Math.PI * r
        };
    }

    static squareProps(side) {
        return {
            area: side * side,
            perimeter: 4 * side,
            diagonal: side * Math.SQRT2
        };
    }

    static triangleCentroid(x1, y1, x2, y2, x3, y3) {
        return { x: (x1 + x2 + x3) / 3, y: (y1 + y2 + y3) / 3 };
    }

    static triangleOrthocenter(x1, y1, x2, y2, x3, y3) {
        const d = 2 * (x1 * (y2 - y3) + x2 * (y3 - y1) + x3 * (y1 - y2));
        if (Math.abs(d) < 1e-10) return null;
        // Using altitude intersection approach
        const m_ab = (x2 !== x1) ? (y2 - y1) / (x2 - x1) : Infinity;
        const m_bc = (x3 !== x2) ? (y3 - y2) / (x3 - x2) : Infinity;
        let ox, oy;
        if (m_ab === 0) { ox = x3; oy = isFinite(m_bc) ? y1 - (-1 / m_bc) * (x3 - x1) : y1; }
        else if (m_bc === 0) { ox = x1; oy = isFinite(m_ab) ? y3 - (-1 / m_ab) * (x1 - x3) : y3; }
        else {
            const pm_ab = isFinite(m_ab) && m_ab !== 0 ? -1 / m_ab : (m_ab === 0 ? Infinity : 0);
            const pm_bc = isFinite(m_bc) && m_bc !== 0 ? -1 / m_bc : (m_bc === 0 ? Infinity : 0);
            if (!isFinite(pm_ab)) { ox = x3; oy = pm_bc * (ox - x1) + y1; }
            else if (!isFinite(pm_bc)) { ox = x1; oy = pm_ab * (ox - x3) + y3; }
            else {
                ox = (y3 - y1 + pm_ab * x3 - pm_bc * x1) / (pm_ab - pm_bc);
                oy = pm_ab * (ox - x3) + y3;
            }
        }
        return { x: ox || 0, y: oy || 0 };
    }

    // ══════════════════════════════════════════════════════════════
    // LINEAR ALGEBRA HELPERS
    // ══════════════════════════════════════════════════════════════

    static parseMatrix(str) {
        return str.trim().split('\n').map(row =>
            row.trim().split(/[\s,;]+/).map(Number).filter(n => !isNaN(n))
        ).filter(r => r.length > 0);
    }

    static matrixDeterminant(m) {
        const n = m.length;
        if (n === 1) return m[0][0];
        if (n === 2) return m[0][0] * m[1][1] - m[0][1] * m[1][0];
        let det = 0;
        for (let j = 0; j < n; j++) {
            const minor = m.slice(1).map(row => row.filter((_, k) => k !== j));
            det += (j % 2 === 0 ? 1 : -1) * m[0][j] * this.matrixDeterminant(minor);
        }
        return det;
    }

    static matrixTrace(m) {
        let trace = 0;
        for (let i = 0; i < Math.min(m.length, m[0].length); i++) trace += m[i][i];
        return trace;
    }

    static matrixRank(m) {
        const rows = m.length, cols = m[0].length;
        const a = m.map(r => [...r]);
        let rank = 0;
        for (let col = 0; col < cols && rank < rows; col++) {
            let pivot = -1;
            for (let row = rank; row < rows; row++) {
                if (Math.abs(a[row][col]) > 1e-10) { pivot = row; break; }
            }
            if (pivot === -1) continue;
            [a[rank], a[pivot]] = [a[pivot], a[rank]];
            const scale = a[rank][col];
            for (let j = col; j < cols; j++) a[rank][j] /= scale;
            for (let row = 0; row < rows; row++) {
                if (row !== rank && Math.abs(a[row][col]) > 1e-10) {
                    const factor = a[row][col];
                    for (let j = col; j < cols; j++) a[row][j] -= factor * a[rank][j];
                }
            }
            rank++;
        }
        return rank;
    }

    static matrixMultiply(a, b) {
        const rows = a.length, cols = b[0].length, inner = b.length;
        const result = Array.from({ length: rows }, () => Array(cols).fill(0));
        for (let i = 0; i < rows; i++)
            for (let j = 0; j < cols; j++)
                for (let k = 0; k < inner; k++)
                    result[i][j] += a[i][k] * b[k][j];
        return result;
    }

    static matrixAdd(a, b) {
        return a.map((row, i) => row.map((v, j) => v + b[i][j]));
    }

    static matrixTranspose(m) {
        return m[0].map((_, j) => m.map(row => row[j]));
    }

    static matrixScale(m, s) {
        return m.map(row => row.map(v => v * s));
    }

    static matrixLU(m) {
        const n = m.length;
        const L = Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => i === j ? 1 : 0));
        const U = m.map(r => [...r]);
        for (let j = 0; j < n; j++) {
            for (let i = j + 1; i < n; i++) {
                if (Math.abs(U[j][j]) < 1e-10) continue;
                const factor = U[i][j] / U[j][j];
                L[i][j] = factor;
                for (let k = j; k < n; k++) U[i][k] -= factor * U[j][k];
            }
        }
        return { L, U };
    }

    static eigenvalues2x2(m) {
        const a = m[0][0], b = m[0][1], c = m[1][0], d = m[1][1];
        const trace = a + d;
        const det = a * d - b * c;
        const disc = trace * trace - 4 * det;
        if (disc >= 0) {
            return [
                (trace + Math.sqrt(disc)) / 2,
                (trace - Math.sqrt(disc)) / 2
            ];
        }
        return [
            { real: trace / 2, imag: Math.sqrt(-disc) / 2 },
            { real: trace / 2, imag: -Math.sqrt(-disc) / 2 }
        ];
    }

    static vectorDot(a, b) {
        return a.reduce((sum, v, i) => sum + v * (b[i] || 0), 0);
    }

    static vectorMagnitude(v) {
        return Math.sqrt(v.reduce((sum, x) => sum + x * x, 0));
    }

    static vectorAdd(a, b) { return a.map((v, i) => v + (b[i] || 0)); }
    static vectorSub(a, b) { return a.map((v, i) => v - (b[i] || 0)); }
    static vectorScale(v, s) { return v.map(x => x * s); }

    static vectorCross(a, b) {
        return [
            a[1] * b[2] - a[2] * b[1],
            a[2] * b[0] - a[0] * b[2],
            a[0] * b[1] - a[1] * b[0]
        ];
    }

    static vectorProjection(a, b) {
        const dot = this.vectorDot(a, b);
        const magB2 = this.vectorDot(b, b);
        if (magB2 === 0) return a.map(() => 0);
        const scalar = dot / magB2;
        return b.map(v => v * scalar);
    }

    static gramSchmidt(vectors) {
        const result = [];
        for (let i = 0; i < vectors.length; i++) {
            let v = [...vectors[i]];
            for (let j = 0; j < result.length; j++) {
                const proj = this.vectorProjection(v, result[j]);
                v = this.vectorSub(v, proj);
            }
            const mag = this.vectorMagnitude(v);
            if (mag > 1e-10) result.push(v.map(x => x / mag));
        }
        return result;
    }

    // ══════════════════════════════════════════════════════════════
    // NUMBER SYSTEM CONVERSION HELPERS
    // ══════════════════════════════════════════════════════════════

    static decToBase(dec, base) {
        if (dec === 0) return '0';
        const digits = '0123456789ABCDEF';
        let result = '';
        let n = Math.abs(Math.floor(dec));
        const steps = [];
        while (n > 0) {
            const rem = n % base;
            steps.push(`${n} ÷ ${base} = ${Math.floor(n / base)} remainder ${rem} (${digits[rem]})`);
            result = digits[rem] + result;
            n = Math.floor(n / base);
        }
        return { value: (dec < 0 ? '-' : '') + result, steps };
    }

    static baseToDec(str, base) {
        const digits = '0123456789ABCDEF';
        str = str.toUpperCase().replace(/[^0-9A-F]/g, '');
        let dec = 0;
        const steps = [];
        for (let i = 0; i < str.length; i++) {
            const d = digits.indexOf(str[i]);
            const pos = str.length - 1 - i;
            const val = d * Math.pow(base, pos);
            steps.push(`${str[i]} × ${base}^${pos} = ${val}`);
            dec += val;
        }
        return { value: dec, steps };
    }

    static baseToBase(str, fromBase, toBase) {
        const dec = this.baseToDec(str, fromBase);
        const result = this.decToBase(dec.value, toBase);
        return { value: result.value, decimalValue: dec.value, stepsIn: dec.steps, stepsOut: result.steps };
    }

    static binaryAdd(a, b) {
        const da = parseInt(a, 2), db = parseInt(b, 2);
        return { result: (da + db).toString(2), decimal: da + db };
    }
    static binarySub(a, b) {
        const da = parseInt(a, 2), db = parseInt(b, 2);
        return { result: (da - db).toString(2), decimal: da - db };
    }
    static binaryMul(a, b) {
        const da = parseInt(a, 2), db = parseInt(b, 2);
        return { result: (da * db).toString(2), decimal: da * db };
    }
    static binaryDiv(a, b) {
        const da = parseInt(a, 2), db = parseInt(b, 2);
        if (db === 0) return { result: 'Error', decimal: NaN };
        return { result: Math.floor(da / db).toString(2), decimal: Math.floor(da / db), remainder: (da % db).toString(2) };
    }

    static hexAdd(a, b) {
        const da = parseInt(a, 16), db = parseInt(b, 16);
        return { result: (da + db).toString(16).toUpperCase(), decimal: da + db };
    }
    static hexSub(a, b) {
        const da = parseInt(a, 16), db = parseInt(b, 16);
        return { result: (da - db).toString(16).toUpperCase(), decimal: da - db };
    }
    static hexMul(a, b) {
        const da = parseInt(a, 16), db = parseInt(b, 16);
        return { result: (da * db).toString(16).toUpperCase(), decimal: da * db };
    }

    static octAdd(a, b) {
        const da = parseInt(a, 8), db = parseInt(b, 8);
        return { result: (da + db).toString(8), decimal: da + db };
    }
    static octSub(a, b) {
        const da = parseInt(a, 8), db = parseInt(b, 8);
        return { result: (da - db).toString(8), decimal: da - db };
    }
    static octMul(a, b) {
        const da = parseInt(a, 8), db = parseInt(b, 8);
        return { result: (da * db).toString(8), decimal: da * db };
    }

    static decToSciNotation(n) {
        if (n === 0) return { coefficient: 0, exponent: 0, notation: '0' };
        const exp = Math.floor(Math.log10(Math.abs(n)));
        const coeff = n / Math.pow(10, exp);
        return { coefficient: coeff, exponent: exp, notation: `${coeff.toFixed(6)} × 10^${exp}` };
    }

    static sciToDecimal(coeff, exp) {
        return coeff * Math.pow(10, exp);
    }

    static decToRoman(num) {
        if (num < 1 || num > 3999) return 'Out of range (1-3999)';
        const lookup = [
            [1000, 'M'], [900, 'CM'], [500, 'D'], [400, 'CD'],
            [100, 'C'], [90, 'XC'], [50, 'L'], [40, 'XL'],
            [10, 'X'], [9, 'IX'], [5, 'V'], [4, 'IV'], [1, 'I']
        ];
        let result = '';
        const steps = [];
        let remaining = Math.floor(num);
        for (const [value, symbol] of lookup) {
            while (remaining >= value) {
                result += symbol;
                steps.push(`${remaining} → subtract ${value} (${symbol}) → ${remaining - value}`);
                remaining -= value;
            }
        }
        return { value: result, steps };
    }

    static romanToDec(str) {
        const map = { I: 1, V: 5, X: 10, L: 50, C: 100, D: 500, M: 1000 };
        str = str.toUpperCase();
        let result = 0;
        const steps = [];
        for (let i = 0; i < str.length; i++) {
            const curr = map[str[i]] || 0;
            const next = map[str[i + 1]] || 0;
            if (curr < next) {
                result += next - curr;
                steps.push(`${str[i]}${str[i + 1]} = ${next} - ${curr} = ${next - curr}`);
                i++;
            } else {
                result += curr;
                steps.push(`${str[i]} = ${curr}`);
            }
        }
        return { value: result, steps };
    }
}

// Make globally available
window.CoreMathEngine = CoreMathEngine;

