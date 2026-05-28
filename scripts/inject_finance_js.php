<?php
$jsPath = __DIR__ . '/../public/js/pro-calculator-engine.js';
if (!file_exists($jsPath)) {
    echo "ERROR: Could not find pro-calculator-engine.js\n";
    exit(1);
}

$jsContent = file_get_contents($jsPath);

// Find the last closing brace of the class
$lastBracePos = strrpos($jsContent, '}');
if ($lastBracePos === false) {
    echo "ERROR: Could not find end of class.\n";
    exit(1);
}

$jsBeforeEnd = substr($jsContent, 0, $lastBracePos);

$injection = <<<JAVASCRIPT

    // ══════════════════════════════════════════════════════════════
    // NEW BATCH: FINANCIAL CALCULATORS (SEO-FIRST PLATFORM)
    // ══════════════════════════════════════════════════════════════

    /* 1 ── Immediate Annuity Calculator ─────────────────────── */
    immediate_annuity_calc(s) {
        const p = parseFloat(s.principal) || 0;
        const rate = parseFloat(s.interest_rate) || 0;
        const years = parseFloat(s.payout_years) || 0;
        const freq = parseFloat(s.frequency) || 12;
        const C = window.CoreMathEngine || {};
        
        let pmt = 0;
        let totalReceived = 0;
        if (p > 0 && years > 0) {
            if (rate > 0) {
                const r = (rate / 100) / freq;
                const n = years * freq;
                pmt = (p * r) / (1 - Math.pow(1 + r, -n));
                totalReceived = pmt * n;
            } else {
                pmt = p / (years * freq);
                totalReceived = p;
            }
        }

        const frequencyText = freq === 12 ? 'Monthly' : (freq === 4 ? 'Quarterly' : (freq === 2 ? 'Semi-Annual' : 'Annual'));

        return {
            mainValue: '$' + (C.fmt ? C.fmt(pmt, 2) : pmt.toFixed(2)),
            mainLabel: `Guaranteed \${frequencyText} Payout`,
            subStats: [
                { label: 'Principal', value: '$' + p.toLocaleString() },
                { label: 'Total Received', value: '$' + (C.fmt ? C.fmt(totalReceived, 2) : totalReceived.toFixed(2)) },
                { label: 'Interest Gained', value: '$' + (C.fmt ? C.fmt(totalReceived - p, 2) : (totalReceived - p).toFixed(2)) }
            ],
            insights: [
                `Depositing <strong>$\${p.toLocaleString()}</strong> yields a fixed \${frequencyText.toLowerCase()} payment of <strong>$\${pmt.toFixed(2)}</strong> for \${years} years.`,
                `This payout relies on an embedded <strong>\${rate}%</strong> amortized annual interest rate.`,
                (rate > 8) ? "⚠️ Warning: This return strongly exceeds standard annuity market averages." : "💡 This calculation assumes standard end-of-period payout mechanics."
            ]
        };
    }

    /* 2 ── Present Value Annuity Due Calculator ────────────────── */
    pv_annuity_due_calc(s) {
        const pmt = parseFloat(s.payment) || 0;
        const r_pct = parseFloat(s.rate) || 0;
        const periods = parseFloat(s.periods) || 0;
        const freq = parseFloat(s.frequency) || 1;
        const C = window.CoreMathEngine || {};
        
        let pv = 0;
        const r = (r_pct / 100) / freq;
        if (r > 0 && periods > 0) {
            const ordinaryPV = pmt * (1 - Math.pow(1 + r, -periods)) / r;
            pv = ordinaryPV * (1 + r);
        } else if (periods > 0) {
            pv = pmt * periods;
        }

        return {
            mainValue: '$' + (C.fmt ? C.fmt(pv, 2) : pv.toFixed(2)),
            mainLabel: 'Present Value (Annuity Due)',
            subStats: [
                { label: 'Total PMT Outlay', value: '$' + (pmt * periods).toLocaleString() },
                { label: 'Discount Derived', value: '$' + (C.fmt ? C.fmt((pmt * periods) - pv, 2) : ((pmt * periods) - pv).toFixed(2)) },
                { label: 'Payment Timing', value: 'Beginning of Period' }
            ],
            insights: [
                `The equivalent upfront valuation of these immediate cash flows is <strong>$\${pv.toFixed(2)}</strong>.`,
                `An Annuity Due is mathematically worth <em>more</em> than an Ordinary Annuity because capital accelerates compounding earlier.`,
                `If this were an Ordinary Annuity (paid at the end), it would only be worth $\${(pv / (1 + r)).toFixed(2)}.`
            ]
        };
    }

    /* 3 ── Present Value of Annuity Calculator ───────────────── */
    pv_annuity_calc(s) {
        const pmt = parseFloat(s.payment) || 0;
        const r_pct = parseFloat(s.rate) || 0;
        const years = parseFloat(s.periods) || 0;
        const freq = parseFloat(s.frequency) || 12;
        const C = window.CoreMathEngine || {};
        
        const r = (r_pct / 100) / freq;
        const n = years * freq;
        
        let pv = 0;
        if (r > 0) {
            pv = pmt * ((1 - Math.pow(1 + r, -n)) / r);
        } else {
            pv = pmt * n;
        }

        return {
            mainValue: '$' + (C.fmt ? C.fmt(pv, 2) : pv.toFixed(2)),
            mainLabel: 'Present Value (Ordinary Annuity)',
            subStats: [
                { label: 'Periodic Payment', value: '$' + pmt.toLocaleString() },
                { label: 'Cumulative Gross', value: '$' + (pmt * n).toLocaleString() },
                { label: 'Implied Discount', value: '$' + (C.fmt ? C.fmt((pmt * n) - pv, 2) : ((pmt * n) - pv).toFixed(2)) }
            ],
            insights: [
                `Securing exactly <strong>$\${pv.toFixed(2)}</strong> today equals receiving $\${pmt} continuously over \${years} years.`,
                `As the discount rate expands, the present value valuation aggressively shrinks.`,
                `This model processes distributions occurring exclusively at the \${freq === 12 ? 'end of each month' : 'end of each period'}.`
            ]
        };
    }

    /* 4 ── Present Value of Growing Annuity Calculator ───────── */
    pv_growing_annuity_calc(s) {
        const pmt = parseFloat(s.payment) || 0;
        const g_pct = parseFloat(s.growth_rate) || 0;
        const r_pct = parseFloat(s.discount_rate) || 0;
        const n = parseFloat(s.periods) || 0;
        const C = window.CoreMathEngine || {};
        
        const g = g_pct / 100;
        const r = r_pct / 100;
        
        let pv = 0;
        let finalPmt = pmt * Math.pow(1 + g, n - 1);

        if (r !== g) {
            pv = (pmt / (r - g)) * (1 - Math.pow((1 + g) / (1 + r), n));
        } else if (r === g && r > 0) {
            pv = pmt * n / (1 + r);
        }

        return {
            mainValue: '$' + (C.fmt ? C.fmt(pv, 2) : pv.toFixed(2)),
            mainLabel: 'Present Value (Growing)',
            subStats: [
                { label: 'Initial PMT', value: '$' + pmt.toLocaleString() },
                { label: 'Final Year PMT', value: '$' + (C.fmt ? C.fmt(finalPmt, 0) : finalPmt.toFixed(0)) },
                { label: 'Rate Differential', value: (r_pct - g_pct).toFixed(1) + '%' }
            ],
            insights: [
                `Cash flows expanding at <strong>\${g_pct}%</strong> explicitly combat inflationary erosion.`,
                `The PV utilizes a structural differential denominator: (Discount - Growth).`,
                (g_pct > r_pct) ? "⚠️ Warning: Simulating growth surpassing the discount rate implies extreme terminal liability explosions." : "💡 This methodology is heavily favored by M&A dividend-discount teams."
            ]
        };
    }

    /* 5 ── PVIFA Calculator ──────────────────────────────────── */
    pvifa_calc(s) {
        const r_pct = parseFloat(s.rate) || 0;
        const n = parseFloat(s.periods) || 0;
        const C = window.CoreMathEngine || {};
        
        const r = r_pct / 100;
        let pvifa = 0;
        
        if (r > 0) {
            pvifa = (1 - Math.pow(1 + r, -n)) / r;
        } else {
            pvifa = n;
        }

        return {
            mainValue: C.fmt ? C.fmt(pvifa, 4) : pvifa.toFixed(4),
            mainLabel: 'PVIFA Multiplier',
            subStats: [
                { label: 'Discount Rate', value: r_pct + '%' },
                { label: 'Periods Count', value: n },
                { label: 'Max Potential', value: n.toFixed(1) }
            ],
            insights: [
                `The exact Present Value Interest Factor of Annuity equates to <strong>\${pvifa.toFixed(4)}</strong>.`,
                `Instead of performing iterative calculus, simply multiply this factor directly against any static periodic payment.`,
                `As localized periods approach infinity, PVIFA theoretically bounds towards (1 / \${r_pct}%).`
            ]
        };
    }

    /* 6 ── Bond Equivalent Yield Calculator ─────────────────── */
    bey_calc(s) {
        const face = parseFloat(s.face_value) || 0;
        const price = parseFloat(s.purchase_price) || 0;
        const days = parseFloat(s.days_to_maturity) || 1;
        const C = window.CoreMathEngine || {};
        
        if (price === 0 || days === 0) return { mainValue: 'Error', mainLabel: 'Invalid Inputs' };
        
        const discount = face - price;
        const bey = (discount / price) * (365 / days);
        const bey_pct = bey * 100;

        return {
            mainValue: (C.fmt ? C.fmt(bey_pct, 3) : bey_pct.toFixed(3)) + '%',
            mainLabel: 'Bond Equivalent Yield (BEY)',
            subStats: [
                { label: 'Discount Spread', value: '$' + (C.fmt ? C.fmt(discount, 2) : discount.toFixed(2)) },
                { label: 'Raw Return', value: (C.fmt ? C.fmt((discount/price)*100, 2) : ((discount/price)*100).toFixed(2)) + '%' },
                { label: 'Annual Multiplier', value: (365/days).toFixed(2) + 'x' }
            ],
            insights: [
                `Extrapolating your \${days}-day holding cycle across a pristine 365-day environment produces a <strong>\${bey_pct.toFixed(2)}%</strong> equivalent baseline.`,
                `This yield strictly utilizes simple-interest trajectories without compounding re-investment friction.`,
                (bey_pct > 10) ? "⚠️ High BEY usually denotes depressed asset pricing; investigate underlying systemic duration risks." : "💡 This standardizes short-term commercial discount paper against standard 10-Yr Treasury yields."
            ]
        };
    }

    /* 7 ── Bond Yield Calculator ────────────────────────────── */
    bond_yield_calc(s) {
        const face = parseFloat(s.face_value) || 0;
        const price = parseFloat(s.market_price) || 0;
        const coupon_pct = parseFloat(s.coupon_rate) || 0;
        const years = parseFloat(s.years_to_maturity) || 1;
        const C = window.CoreMathEngine || {};
        
        const annual_coupon = face * (coupon_pct / 100);
        let current_yield = 0;
        if (price > 0) {
            current_yield = (annual_coupon / price) * 100;
        }

        // Approximate Yield to Maturity (YTM)
        let ytm = 0;
        if (price > 0 && face > 0 && years > 0) {
            const num = annual_coupon + ((face - price) / years);
            const den = (face + price) / 2;
            ytm = (num / den) * 100;
        }

        let bondStatus = price < face ? 'Discount' : (price > face ? 'Premium' : 'Par');

        return {
            mainValue: (C.fmt ? C.fmt(ytm, 3) : ytm.toFixed(3)) + '%',
            mainLabel: 'Approximate YTM',
            subStats: [
                { label: 'Current Yield', value: (C.fmt ? C.fmt(current_yield, 2) : current_yield.toFixed(2)) + '%' },
                { label: 'Market Status', value: bondStatus },
                { label: 'Total Capital Gain/Loss', value: '$' + (C.fmt ? C.fmt(face - price, 2) : (face - price).toFixed(2)) }
            ],
            insights: [
                `This bond actively trades at a <strong>\${bondStatus}</strong> (Market $poly\${price} vs Face $\${face}).`,
                `Your immediate realized income yield operates at <strong>\${current_yield.toFixed(2)}%</strong> ignoring maturity capital.`,
                bondStatus === 'Discount' ? "💡 The YTM exceeds the stated coupon due to anticipated capital appreciation at maturation." : (bondStatus === 'Premium' ? "💡 The YTM trails the stated coupon because you paid a premium that amortizes downward." : "")
            ]
        };
    }

    /* 8 ── Zero Coupon Bond Calculator ──────────────────────── */
    zero_coupon_calc(s) {
        const face = parseFloat(s.face_value) || 0;
        const y_pct = parseFloat(s.yield_rate) || 0;
        const years = parseFloat(s.years_to_maturity) || 0;
        const freq = parseFloat(s.compounding) || 2;
        const C = window.CoreMathEngine || {};
        
        const r = y_pct / 100;
        const n_total = years * freq;
        
        let price = 0;
        if (face > 0 && y_pct >= 0) {
            price = face / Math.pow(1 + (r / freq), n_total);
        }

        return {
            mainValue: '$' + (C.fmt ? C.fmt(price, 2) : price.toFixed(2)),
            mainLabel: 'Theoretical Purchase Price',
            subStats: [
                { label: 'Discount Acquired', value: '$' + (C.fmt ? C.fmt(face - price, 2) : (face - price).toFixed(2)) },
                { label: 'Compounding Base', value: freq === 2 ? 'Semi-Annual' : 'Annual' },
                { label: 'Implied ROI', value: (price > 0) ? (C.fmt ? C.fmt(((face - price)/price)*100, 1) : (((face - price)/price)*100).toFixed(1)) + '%' : '0%' }
            ],
            insights: [
                `To enforce a rigid <strong>\${y_pct}%</strong> yield array, this instrument commands a present valuation of <strong>$\${price.toFixed(2)}</strong>.`,
                `Because this zeroes out interim payments, all $poly\${(face - price).toFixed(2)} profit accrues entirely via the maturity differential.`,
                `Zero-coupon mechanisms remain highly sensitive to macro interest curve fluctuations.`
            ]
        };
    }

    /* 9 ── Return On Equity (ROE) Calculator ────────────────── */
    roe_calc(s) {
        const income = parseFloat(s.net_income) || 0;
        const equity = parseFloat(s.shareholder_equity) || 1;
        const C = window.CoreMathEngine || {};
        
        let roe = 0;
        if (equity !== 0) {
            roe = (income / equity) * 100;
        }

        return {
            mainValue: (C.fmt ? C.fmt(roe, 2) : roe.toFixed(2)) + '%',
            mainLabel: 'Return on Equity (ROE)',
            subStats: [
                { label: 'Net Income', value: '$' + income.toLocaleString() },
                { label: 'Shareholder Equity', value: '$' + equity.toLocaleString() },
                { label: 'Status', value: roe > 15 ? 'Robust' : (roe > 0 ? 'Positive' : 'Negative') }
            ],
            insights: [
                `This enterprise effectively converted every $1.00 of underlying shareholder equity into <strong>$\${(income/equity).toFixed(3)}</strong> of naked profit.`,
                roe > 25 ? "⚠️ Extreme ROE parameters often indicate aggressive debt structuring artificially crushing the equity denominator." : "💡 Consistent 15%+ ROE metrics frequently signify profound organizational economic moats."
            ]
        };
    }

    /* 10 ── Return On Net Assets (RONA) Calculator ──────────── */
    rona_calc(s) {
        const income = parseFloat(s.net_income) || 0;
        const fixed = parseFloat(s.fixed_assets) || 0;
        const working = parseFloat(s.working_capital) || 0;
        const C = window.CoreMathEngine || {};
        
        const net_assets = fixed + working;
        let rona = 0;
        if (net_assets !== 0) {
            rona = (income / net_assets) * 100;
        }

        return {
            mainValue: (C.fmt ? C.fmt(rona, 2) : rona.toFixed(2)) + '%',
            mainLabel: 'Return on Net Assets (RONA)',
            subStats: [
                { label: 'Net Assets Base', value: '$' + net_assets.toLocaleString() },
                { label: 'Fixed Assets', value: '$' + fixed.toLocaleString() },
                { label: 'Working Capital', value: '$' + working.toLocaleString() }
            ],
            insights: [
                `Excluding esoteric intangibles and heavy debt vectors, this machinery-focused operation yields <strong>\${rona.toFixed(2)}%</strong> efficiently.`,
                `Integrating Fixed Assets explicitly judges organizational competence regarding massive physical plant expenditures.`,
                "💡 Capital-intensive sectors (utilities, heavy logistics) universally utilize RONA to prevent sprawling infrastructure bloat."
            ]
        };
    }

    /* 11 ── Return On Sales (ROS) Calculator ────────────────── */
    ros_calc(s) {
        const ebit = parseFloat(s.operating_profit) || 0;
        const revenue = parseFloat(s.net_sales) || 1;
        const C = window.CoreMathEngine || {};
        
        let ros = 0;
        if (revenue !== 0) {
            ros = (ebit / revenue) * 100;
        }

        return {
            mainValue: (C.fmt ? C.fmt(ros, 2) : ros.toFixed(2)) + '%',
            mainLabel: 'Return on Sales (ROS)',
            subStats: [
                { label: 'Operating Profit', value: '$' + ebit.toLocaleString() },
                { label: 'Top-Line Revenue', value: '$' + revenue.toLocaleString() },
                { label: 'Cost Structure', value: (C.fmt ? C.fmt(100 - ros, 1) : (100 - ros).toFixed(1)) + '% Consumed' }
            ],
            insights: [
                `For every nominal dollar generating top-line revenue, the firm retains precisely <strong>\${(ebit/revenue).toFixed(3)} cents</strong> within its mid-ledger operational vault.`,
                `This firmly establishes definitive pricing dominance devoid of tax loopholes or chaotic debt servicing ratios.`,
                ros < 5 && ros >= 0 ? "⚠️ Plunging ROS explicitly signals aggressive competitor discounting or supply-chain pricing ruptures." : "💡 A steadily ascending ROS signifies expanding proprietary moat characteristics."
            ]
        };
    }

    /* 12 ── Future Value Interest Factor (FVIF) Calculator ──── */
    fvif_calc(s) {
        const r_pct = parseFloat(s.rate) || 0;
        const n = parseFloat(s.periods) || 0;
        const C = window.CoreMathEngine || {};
        
        const r = r_pct / 100;
        const fvif = Math.pow(1 + r, n);

        return {
            mainValue: C.fmt ? C.fmt(fvif, 5) : fvif.toFixed(5),
            mainLabel: 'FVIF Multiplier',
            subStats: [
                { label: 'Input Rate', value: r_pct + '%' },
                { label: 'Chronological Periods', value: n },
                { label: 'Growth Vector', value: '+' + (C.fmt ? C.fmt((fvif - 1)*100, 1) : ((fvif - 1)*100).toFixed(1)) + '%' }
            ],
            insights: [
                `Capitalizing on a continuous compounding cycle yields a strictly mathematical multiplier of <strong>\${fvif.toFixed(5)}</strong>.`,
                `Transmute any arbitrary generic initial principal instantly into terminal projections exclusively utilizing this overarching synthesis point.`,
                "💡 Exponential frameworks heavily bias extended time horizons over outright percentage jumps."
            ]
        };
    }

JAVASCRIPT;

$finalJs = $jsBeforeEnd . $injection . "}\n";
file_put_contents($jsPath, $finalJs);
echo "Successfully injected 12 financial calculators into pro-calculator-engine.js\n";
