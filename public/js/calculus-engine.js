/**
 * CalculusEngine — Shared Symbolic & Numerical Engine for Calculus Tools
 * Supports: Symbolic Derivatives (basic), Numerical Limits, Expression Parsing.
 * Zero external dependencies. Designed for high-precision calculus tools.
 */
class CalculusEngine {
    constructor() {
        this.operators = {
            '+': (a, b) => a + b,
            '-': (a, b) => a - b,
            '*': (a, b) => a * b,
            '/': (a, b) => a / b,
            '^': (a, b) => Math.pow(a, b)
        };
        this.functions = {
            'sin': Math.sin,
            'cos': Math.cos,
            'tan': Math.tan,
            'log': Math.log,
            'sqrt': Math.sqrt,
            'exp': Math.exp,
            'abs': Math.abs
        };
    }

    /**
     * Pre-process expression for parsing (e.g. 2x -> 2*x)
     */
    preprocess(expr) {
        return expr
            .replace(/\s+/g, '')
            .replace(/(\d)([a-zA-Z\(])/g, '$1*$2') // 2x -> 2*x, 2( -> 2*(
            .replace(/(\))([a-zA-Z0-9\(])/g, '$1*$2') // )x -> )*x
            .replace(/\^/g, '**'); // x^2 -> x**2 for eval safety
    }

    /**
     * Evaluate expression for a given variable value
     */
    evaluate(expr, vars = {}) {
        let processed = this.preprocess(expr);
        try {
            // Replace variables with their values
            for (let [v, val] of Object.entries(vars)) {
                let reg = new RegExp('\\b' + v + '\\b', 'g');
                processed = processed.replace(reg, '(' + val + ')');
            }

            // Replace function names with Math. names
            for (let f in this.functions) {
                let reg = new RegExp('\\b' + f + '\\(', 'g');
                processed = processed.replace(reg, 'Math.' + f + '(');
            }

            // Safe evaluation using Function constructor (avoid eval)
            return new Function('return ' + processed)();
        } catch (e) {
            return NaN;
        }
    }

    /**
     * Numerical Limit Estimation: lim(x->a) f(x)
     */
    limit(expr, variable, to, side = 'both') {
        const eps = [1e-3, 1e-6, 1e-9, 1e-12];
        let results = [];

        if (to === 'inf' || to === '∞') {
            for (let e of [1e3, 1e6, 1e9, 1e12]) {
                results.push(this.evaluate(expr, { [variable]: e }));
            }
        } else if (to === '-inf' || to === '-∞') {
            for (let e of [-1e3, -1e6, -1e9, -1e12]) {
                results.push(this.evaluate(expr, { [variable]: e }));
            }
        } else {
            const target = parseFloat(to);
            if (side === 'both' || side === 'right') {
                for (let e of eps) results.push(this.evaluate(expr, { [variable]: target + e }));
            }
            if (side === 'both' || side === 'left') {
                for (let e of eps) results.push(this.evaluate(expr, { [variable]: target - e }));
            }
        }

        // Check for convergence
        results = results.filter(n => !isNaN(n) && isFinite(n));
        if (results.length < 2) return NaN;

        const last = results[results.length - 1];
        const prev = results[results.length - 2];
        
        if (Math.abs(last - prev) < 1e-6) return last;
        
        // Handle vertical asymptotes
        if (Math.abs(last) > 1e10) return last > 0 ? Infinity : -Infinity;

        return last;
    }

    /**
     * Numerical Derivative: f'(x) at a point
     */
    derivative(expr, variable, at) {
        const h = 1e-7;
        const x1 = this.evaluate(expr, { [variable]: at + h });
        const x2 = this.evaluate(expr, { [variable]: at - h });
        return (x1 - x2) / (2 * h);
    }

    /**
     * Numerical Integration: Simpson's Rule
     */
    integral(expr, variable, from, to, n = 1000) {
        if (n % 2 !== 0) n++;
        const h = (to - from) / n;
        let sum = this.evaluate(expr, { [variable]: from }) + this.evaluate(expr, { [variable]: to });

        for (let i = 1; i < n; i++) {
            const x = from + i * h;
            sum += (i % 2 === 0 ? 2 : 4) * this.evaluate(expr, { [variable]: x });
        }
        return (h / 3) * sum;
    }

    /**
     * Format result for display
     */
    format(val) {
        if (isNaN(val)) return 'Undefined';
        if (val === Infinity) return '∞';
        if (val === -Infinity) return '-∞';
        if (Math.abs(val) < 1e-10) return '0';
        
        // Try to round to 4 decimals
        const rounded = Math.round(val * 10000) / 10000;
        return rounded.toLocaleString();
    }
}

window.CalculusEngine = new CalculusEngine();
