<div class="row g-4 persona-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Industry / Sector</label>
                        <select id="persona-industry" class="form-select form-select-lg">
                            <option value="any" selected>Any Industry</option>
                            <option value="tech">Technology & IT</option>
                            <option value="health">Healthcare & Fitness</option>
                            <option value="retail">Retail & E-commerce</option>
                            <option value="finance">Finance & Banking</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Age Group</label>
                        <select id="persona-age" class="form-select form-select-lg">
                            <option value="any" selected>Any Age</option>
                            <option value="genz">Gen Z (18-26)</option>
                            <option value="millennial">Millennial (27-42)</option>
                            <option value="genx">Gen X (43-58)</option>
                            <option value="boomer">Boomer (59+)</option>
                        </select>
                    </div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="persona-generate" style="min-width: 280px; max-width: 100%; background:#8b5cf6; border:none;">
                    <i class="fas fa-user-plus me-2"></i>Generate Persona
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="persona-output-card" style="--tool-hue:260;--tool-color:#7c3aed;--tool-bg:rgba(139,92,246,.04); border-color:#ddd6fe; padding: 0;">
            <div class="row g-0">
                <!-- Sidebar -->
                <div class="col-md-4 bg-light border-end" style="border-radius: 12px 0 0 12px; padding: 2rem; text-align: center;">
                    <div class="mb-3">
                        <img id="persona-avatar" src="https://api.dicebear.com/7.x/avataaars/svg?seed=Felix" alt="Avatar" class="rounded-circle border bg-white" style="width: 120px; height: 120px; padding: 5px;">
                    </div>
                    <h3 id="persona-name" class="fw-black text-dark mb-1">Alex Chen</h3>
                    <div id="persona-job" class="fw-bold text-primary mb-3">Software Engineer</div>
                    
                    <ul class="list-unstyled text-start small text-muted">
                        <li class="mb-2"><i class="fas fa-birthday-cake me-2 w-15px"></i> <span id="persona-age-val">28</span> years old</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 w-15px"></i> <span id="persona-location">Seattle, WA</span></li>
                        <li class="mb-2"><i class="fas fa-graduation-cap me-2 w-15px"></i> <span id="persona-edu">B.S. Computer Science</span></li>
                        <li class="mb-2"><i class="fas fa-heart me-2 w-15px"></i> <span id="persona-status">Single</span></li>
                    </ul>
                </div>
                
                <!-- Main Content -->
                <div class="col-md-8 p-4">
                    <h5 class="fw-bold mb-2"><i class="fas fa-quote-left text-muted me-2"></i>Bio</h5>
                    <p id="persona-bio" class="text-secondary mb-4">Alex is a dedicated software engineer who loves open-source projects...</p>
                    
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <h6 class="fw-bold text-success mb-2"><i class="fas fa-bullseye me-2"></i>Goals</h6>
                            <ul id="persona-goals" class="text-secondary small ps-3">
                                <li>Improve coding skills</li>
                                <li>Launch a startup</li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="fw-bold text-danger mb-2"><i class="fas fa-bolt me-2"></i>Frustrations</h6>
                            <ul id="persona-frustrations" class="text-secondary small ps-3">
                                <li>Slow compile times</li>
                                <li>Legacy codebases</li>
                            </ul>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h6 class="fw-bold mb-3"><i class="fas fa-star me-2 text-warning"></i>Favorite Brands / Apps</h6>
                    <div id="persona-brands" class="d-flex gap-2 flex-wrap">
                        <span class="badge bg-dark">GitHub</span>
                        <span class="badge bg-dark">Spotify</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.persona-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.persona-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.persona-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.persona-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.persona-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.persona-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.4rem;}
.w-15px { width: 15px; text-align: center; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    const firstNames = ['Alex', 'Jordan', 'Taylor', 'Sam', 'Casey', 'Riley', 'Morgan', 'Cameron', 'Avery', 'Jamie', 'David', 'Sarah', 'Michael', 'Emily'];
    const lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez', 'Chen', 'Kim'];
    const locations = ['Seattle, WA', 'Austin, TX', 'New York, NY', 'Chicago, IL', 'San Francisco, CA', 'Boston, MA', 'Denver, CO', 'Miami, FL', 'London, UK', 'Toronto, ON'];
    const edus = ['B.S. Degree', 'M.S. Degree', 'High School Diploma', 'Self-Taught', 'Associate Degree', 'Ph.D.'];
    const statuses = ['Single', 'Married', 'In a relationship', 'Divorced'];

    const db = {
        tech: {
            jobs: ['Software Engineer', 'UX Designer', 'Product Manager', 'Data Analyst', 'IT Administrator'],
            bio: [
                "Always looking for the next big innovation. Spends weekends hacking on personal projects or playing video games.",
                "Detail-oriented professional focused on creating seamless digital experiences. Loves minimal design."
            ],
            goals: ['Streamline workflows', 'Learn new frameworks', 'Increase productivity', 'Build a personal brand'],
            frusts: ['Clunky interfaces', 'Slow internet speeds', 'Lack of documentation', 'Too many meetings'],
            brands: ['GitHub', 'Slack', 'Apple', 'Spotify', 'Discord']
        },
        health: {
            jobs: ['Registered Nurse', 'Fitness Coach', 'Hospital Administrator', 'Physical Therapist'],
            bio: [
                "Passionate about helping others and promoting wellness. Stays active and enjoys outdoor activities.",
                "Works long shifts and relies on efficient tools to manage patient data and personal scheduling."
            ],
            goals: ['Improve patient outcomes', 'Maintain work-life balance', 'Stay physically active', 'Eat healthier'],
            frusts: ['Outdated software systems', 'Long wait times', 'Misinformation online', 'Burnout'],
            brands: ['MyFitnessPal', 'Nike', 'Apple Watch', 'Headspace']
        },
        retail: {
            jobs: ['Store Manager', 'E-commerce Specialist', 'Customer Support', 'Merchandiser'],
            bio: [
                "Customer-focused and trend-savvy. Always tracking inventory and looking for ways to boost sales.",
                "Loves discovering new products and sharing reviews. Frequently shops online for convenience."
            ],
            goals: ['Find the best deals', 'Provide excellent service', 'Discover new trends', 'Save time shopping'],
            frusts: ['Hidden fees', 'Poor customer service', 'Complicated return policies', 'Out of stock items'],
            brands: ['Amazon', 'Target', 'Shopify', 'Instagram']
        },
        finance: {
            jobs: ['Financial Advisor', 'Accountant', 'Investment Banker', 'Loan Officer'],
            bio: [
                "Analytical and numbers-driven. Focuses on long-term growth and secure investments.",
                "Detail-oriented and cautious with data. Relies on robust software to manage portfolios."
            ],
            goals: ['Maximize returns', 'Ensure data security', 'Plan for retirement', 'Automate tracking'],
            frusts: ['Security breaches', 'Complex tax laws', 'Unintuitive dashboards', 'Slow customer support'],
            brands: ['Bloomberg', 'Mint', 'Chase', 'Excel']
        }
    };

    function pickRandom(arr) {
        return arr[Math.floor(Math.random() * arr.length)];
    }

    $('persona-generate').addEventListener('click', function() {
        let ind = $('persona-industry').value;
        let ageGroup = $('persona-age').value;

        if (ind === 'any') {
            const keys = Object.keys(db);
            ind = keys[Math.floor(Math.random() * keys.length)];
        }

        let minAge = 18, maxAge = 80;
        if (ageGroup === 'genz') { minAge = 18; maxAge = 26; }
        else if (ageGroup === 'millennial') { minAge = 27; maxAge = 42; }
        else if (ageGroup === 'genx') { minAge = 43; maxAge = 58; }
        else if (ageGroup === 'boomer') { minAge = 59; maxAge = 75; }

        const age = Math.floor(Math.random() * (maxAge - minAge + 1)) + minAge;
        const fname = pickRandom(firstNames);
        const lname = pickRandom(lastNames);
        const name = `${fname} ${lname}`;

        const data = db[ind];
        
        $('persona-avatar').src = `https://api.dicebear.com/7.x/avataaars/svg?seed=${fname}${age}`;
        $('persona-name').textContent = name;
        $('persona-job').textContent = pickRandom(data.jobs);
        $('persona-age-val').textContent = age;
        $('persona-location').textContent = pickRandom(locations);
        $('persona-edu').textContent = pickRandom(edus);
        $('persona-status').textContent = pickRandom(statuses);

        $('persona-bio').textContent = pickRandom(data.bio);

        // Shuffle goals/frusts/brands
        const get2 = arr => {
            let shuf = [...arr].sort(()=>0.5-Math.random());
            return shuf.slice(0,2);
        };

        const g = get2(data.goals);
        $('persona-goals').innerHTML = `<li>${g[0]}</li><li>${g[1]}</li>`;
        
        const f = get2(data.frusts);
        $('persona-frustrations').innerHTML = `<li>${f[0]}</li><li>${f[1]}</li>`;

        const b = get2(data.brands);
        $('persona-brands').innerHTML = `<span class="badge bg-dark">${b[0]}</span><span class="badge bg-dark">${b[1]}</span>`;

        $('persona-output-card').classList.remove('d-none');
        
        $('persona-output-card').classList.remove('animate__animated', 'animate__fadeIn');
        void $('persona-output-card').offsetWidth;
        $('persona-output-card').classList.add('animate__animated', 'animate__fadeIn');
        
        $('persona-output-card').scrollIntoView({ behavior: 'smooth' });
    });
});
</script>

