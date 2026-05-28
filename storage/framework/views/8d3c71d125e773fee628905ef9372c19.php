<div class="interactive-wrapper">
    
    <div class="card tool-card-stacked mb-4 shadow-sm border-0">
        
        <div class="card-body-v2 p-4">
            <div class="input-section-label"><i class="fas fa-sliders-h"></i> Configuration Parameters</div>
            <div class="row g-4">
                <div class="col-md-7">
                    <div class="p-4 rounded-4 h-100" style="background-color: #fff; border: 1.5px solid #f1f5f9;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Birth Details</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Full Name (Optional)</label>
                                <input type="text" id="in-name" class="form-control form-control-lg rounded-3" placeholder="Enter your full name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Birth Date</label>
                                <input type="date" id="in-date" class="form-control form-control-lg rounded-3" value="1990-01-01">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Birth Time (Optional)</label>
                                <input type="time" id="in-time" class="form-control form-control-lg rounded-3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="p-4 rounded-4 h-100" style="background-color: #f8fafc; border: 1.5px solid #e2e8f0;">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Advanced Settings</h6>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="toggle-master" checked>
                            <label class="form-check-label fw-bold text-dark" for="toggle-master">Include Master Numbers (11, 22, 33)</label>
                            <p class="text-muted x-small mb-0">When enabled, Master Numbers will not be reduced to single digits.</p>
                        </div>
                        <div class="mt-4">
                            <label class="form-label small fw-bold text-secondary text-uppercase mb-2">Calculation Method</label>
                            <select id="calc-method" class="form-select rounded-3">
                                <option value="additive">Standard Additive (Modern)</option>
                                <option value="traditional">Traditional Reduction</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
                <button class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-calculate" style="min-width: 280px;">
                    <i class="fas fa-magic me-2"></i> Reveal Life Path
                </button>
                <button type="button" class="btn btn-light-v2 btn-lg rounded-pill px-5 shadow-sm transition-all" id="btn-reset"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>
    </div>

    
    <div id="result-card" class="card tool-card-stacked shadow-sm border-0 d-none">
        <div class="card-header-v2 bg-white border-bottom-0 py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3 bg-success-soft">
                        <i class="fas fa-star text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Destiny Blueprint</h5>
                        <p class="text-muted small mb-0">Your core vibration and personality traits</p>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-success btn-sm rounded-pill px-4 shadow-sm" id="btn-copy">
                        <i class="fas fa-copy me-1"></i> Copy Analysis
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body-v2 p-4">
            <div class="row g-4 mb-4">
                <div class="col-lg-4 text-center border-end">
                    <div class="display-1 fw-bold text-primary mb-0" id="out-number">?</div>
                    <p class="text-muted fw-bold text-uppercase small letter-spacing-1">Life Path Number</p>
                    <div class="mt-2">
                        <span class="badge rounded-pill px-4 py-2 fw-bold d-none" id="master-badge" style="background-color: #fef3c7; color: #92400e; border: 1px solid #fde68a;">
                            <i class="fas fa-crown me-1"></i> MASTER NUMBER
                        </span>
                    </div>
                </div>
                <div class="col-lg-8">
                    <h3 class="fw-bold text-dark mb-3" id="out-title">The Archetype</h3>
                    <div id="out-description" class="text-secondary leading-relaxed mb-4">
                        <!-- Description injected here -->
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-light border">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Lucky Colors</div>
                                <div class="fw-bold text-dark" id="out-colors">-</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-light border">
                                <div class="small fw-bold text-uppercase text-muted mb-1">Key Traits</div>
                                <div class="fw-bold text-dark" id="out-traits">-</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-4 bg-primary-soft border border-primary border-opacity-10 shadow-sm">
                <h6 class="fw-bold mb-3 small text-uppercase text-primary letter-spacing-1">
                    <i class="fas fa-lightbulb me-2"></i>Core Essence & Advice
                </h6>
                <div id="out-advice" class="small text-secondary leading-relaxed"></div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #6366f1;
        --primary-soft: #f5f3ff;
        --success-soft: #f0fdf4;
        --border-color: #e2e8f0;
    }

    .bg-primary-soft { background-color: var(--primary-soft); }
    .bg-success-soft { background-color: var(--success-soft); }

    .tool-card-stacked { border-radius: 24px; background: #fff; border: 1px solid #eef2f6 !important; }

    .icon-box { 
        width: 48px; height: 48px; border-radius: 14px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }

    .btn-light-v2 { background: #f8fafc; border: 1px solid #e2e8f0; color: #64748b; font-weight: 600; transition: all 0.2s; }
    .btn-light-v2:hover { background: #f1f5f9; color: #1e293b; }

    .form-control-lg, .form-select-lg { border: 1.5px solid var(--border-color); border-radius: 12px; font-size: 1.05rem; padding: 0.7rem 1rem; }
    .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); outline: none; }
    
    .transition-all { transition: all 0.3s ease; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .x-small { font-size: 0.75rem; }
    .leading-relaxed { line-height: 1.6; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameE = document.getElementById('in-name');
    const dateE = document.getElementById('in-date');
    const timeE = document.getElementById('in-time');
    const masterE = document.getElementById('toggle-master');
    const methodE = document.getElementById('calc-method');
    
    const resultCard = document.getElementById('result-card');
    const outNumber = document.getElementById('out-number');
    const outTitle = document.getElementById('out-title');
    const outDesc = document.getElementById('out-description');
    const outColors = document.getElementById('out-colors');
    const outTraits = document.getElementById('out-traits');
    const outAdvice = document.getElementById('out-advice');
    const masterBadge = document.getElementById('master-badge');
    const btnCalculate = document.getElementById('btn-calculate');

    const lpData = {
        1: { title: "The Creative Leader", traits: "Independent, Ambitious, Original", colors: "Red, Yellow, Copper", desc: "Life Path 1 individuals are the pioneers of the world. They possess a strong drive to succeed and a natural ability to take charge. They are often self-motivated and prefer to work independently to manifest their unique visions.", advice: "Trust your instincts but learn the value of collaboration. Your strength lies in your initiative, but don't forget to listen to others." },
        2: { title: "The Intuitive Diplomat", traits: "Empathetic, Cooperative, Patient", colors: "Blue, Silver, Cream", desc: "Life Path 2 is about harmony and balance. You are a natural peacemaker who excels in partnership and mediation. You possess a deep sensitivity to others' feelings and often work behind the scenes to keep things running smoothly.", advice: "Your sensitivity is your greatest power. Use it to build bridges, but ensure you set boundaries to protect your own energy." },
        3: { title: "The Expressive Artist", traits: "Creative, Social, Optimistic", colors: "Yellow, Gold, Orange", desc: "Life Path 3 represents self-expression and creativity. You are likely a natural communicator, artist, or performer. Your contagious enthusiasm and charm make you a joy to be around, and you find meaning in sharing your ideas with the world.", advice: "Focus your scattered energy. Your creativity is boundless, but discipline will help you bring your grandest ideas to fruition." },
        4: { title: "The Practical Builder", traits: "Disciplined, Organized, Reliable", colors: "Green, Brown, Earth Tones", desc: "Life Path 4 individuals are the foundation of society. You value structure, hard work, and honesty. You are highly capable of turning abstract concepts into concrete reality through methodical planning and unwavering persistence.", advice: "Embrace flexibility. While your systems provide security, life's greatest opportunities often come from unexpected changes." },
        5: { title: "The Versatile Adventurer", traits: "Dynamic, Curious, Adaptable", colors: "Turquoise, Pink, Bright White", desc: "Life Path 5 is defined by freedom and change. You crave variety and thrive on new experiences. Your adaptable nature allows you to navigate diverse social circles and environments with ease, always seeking the next big thrill or insight.", advice: "Find freedom through commitment. True exploration often requires staying in one place long enough to see what lies beneath the surface." },
        6: { title: "The Nurturing Caretaker", traits: "Responsible, Compassionate, Artistic", colors: "Indigo, Purple, Soft Green", desc: "Life Path 6 is the path of service and family. You are naturally protective of those you love and find fulfillment in creating beautiful, harmonious environments. You often take on the burdens of others, driven by a deep sense of duty.", advice: "Nurture yourself as much as you nurture others. You cannot pour from an empty cup; prioritize your own well-being." },
        7: { title: "The Analytical Seeker", traits: "Intellectual, Spiritual, Reserved", colors: "Violet, Dark Blue, Gray", desc: "Life Path 7 is the seeker of truth. You possess a brilliant mind and a deep desire to understand the mysteries of life. You often prefer solitude to contemplate complex ideas and develop your strong intuitive abilities.", advice: "Share your wisdom. Your inner world is rich, but the world needs the unique insights that only your deep reflection can provide." },
        8: { title: "The Manifesting Powerhouse", traits: "Authoritative, Successful, Resilient", colors: "Black, Dark Red, Metallic", desc: "Life Path 8 is the number of material success and karmic balance. You are a natural leader in the business world, possessing the vision and endurance to build empires. You understand the flow of energy and how to command resources.", advice: "Balance material gain with spiritual growth. True power comes not just from what you own, but from how you use your influence for good." },
        9: { title: "The Global Humanitarian", traits: "Selfless, Creative, Idealistic", colors: "Gold, White, Rose", desc: "Life Path 9 is the path of the old soul. You possess a universal perspective and a deep compassion for all of humanity. You are often drawn to charitable work or creative pursuits that aim to leave the world better than you found it.", advice: "Let go of the past. Your mission is to serve the present and future; don't let old wounds dim your visionary light." },
        11: { title: "The Master Visionary", traits: "Inspired, Charismatic, Enlightened", colors: "Electric Blue, Silver", desc: "As a Master Number 11, you possess double the energy of a 2, combined with the leadership of 1. You are a psychic bridge between the mundane and the divine, often experiencing intense intuition and visionary flashes.", advice: "Ground your energy. Your high vibration can lead to anxiety if not channeled into a meaningful, practical purpose." },
        22: { title: "The Master Builder", traits: "Architectural, Practical, Powerful", colors: "Deep Green, Gold", desc: "Master Number 22 is considered the most powerful path. You have the ability to take the loftiest spiritual visions and ground them into physical reality on a massive scale. You are a master of systems and grand designs.", advice: "Think big, act locally. Your potential is global, but every empire is built one brick at a time. Stay humble and focused." },
        33: { title: "The Master Teacher", traits: "Sacrificial, Healing, Wise", colors: "Soft Blue, Lavender", desc: "Master Number 33 represents the 'Christ consciousness' or universal love. You are here to heal and uplift humanity through your creative expression and profound compassion. This path requires great discipline and selflessness.", advice: "Accept your calling with grace. You are a beacon of hope for many; lead by example and radiate unconditional love." }
    };

    function reduce(num, allowMaster = true) {
        if (allowMaster && (num === 11 || num === 22 || num === 33)) return num;
        while (num > 9) {
            num = String(num).split('').reduce((sum, d) => sum + parseInt(d), 0);
            if (allowMaster && (num === 11 || num === 22)) break;
        }
        return num;
    }

    function calculate() {
        const dateVal = dateE.value;
        if (!dateVal) return;

        btnCalculate.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Reading Stars...';
        btnCalculate.disabled = true;

        setTimeout(() => {
            const [y, m, d] = dateVal.split('-').map(Number);
            const allowMaster = masterE.checked;
            const method = methodE.value;

            let finalLP = 0;
            if (method === 'traditional') {
                // Traditional: Sum everything first, then reduce
                const sum = String(y) + String(m) + String(d);
                let total = sum.split('').reduce((s, d) => s + parseInt(d), 0);
                finalLP = reduce(total, allowMaster);
            } else {
                // Modern: Reduce components first, then sum
                const rM = reduce(m, allowMaster);
                const rD = reduce(d, allowMaster);
                const rY = reduce(y, allowMaster);
                finalLP = reduce(rM + rD + rY, allowMaster);
            }

            // UI Updates
            outNumber.textContent = finalLP;
            const data = lpData[finalLP] || lpData[reduce(finalLP, false)];
            
            outTitle.textContent = data.title;
            outDesc.textContent = data.desc;
            outTraits.textContent = data.traits;
            outColors.textContent = data.colors;
            outAdvice.innerHTML = `<p class="mb-0">${data.advice}</p>`;

            if (finalLP === 11 || finalLP === 22 || finalLP === 33) {
                masterBadge.classList.remove('d-none');
            } else {
                masterBadge.classList.add('d-none');
            }

            resultCard.classList.remove('d-none');
            resultCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

            btnCalculate.innerHTML = '<i class="fas fa-magic me-2"></i> Reveal Life Path';
            btnCalculate.disabled = false;
        }, 800);
    }

    btnCalculate.addEventListener('click', calculate);

    document.getElementById('btn-reset').addEventListener('click', () => {
        nameE.value = '';
        dateE.value = '1990-01-01';
        timeE.value = '';
        resultCard.classList.add('d-none');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    document.getElementById('btn-copy').addEventListener('click', function() {
        const text = `Life Path Analysis\nNumber: ${outNumber.textContent}\nArchetype: ${outTitle.textContent}\nTraits: ${outTraits.textContent}\nLucky Colors: ${outColors.textContent}\nAnalysis: ${outDesc.textContent}\nGenerated via ToolsHub.`;
        navigator.clipboard.writeText(text).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Analysis Copied!';
            btn.classList.replace('btn-success', 'btn-dark');
            setTimeout(() => { 
                btn.innerHTML = originalText; 
                btn.classList.replace('btn-dark', 'btn-success');
            }, 2000);
        });
    });
});
</script>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\life-path-number-calculator.blade.php ENDPATH**/ ?>