<div class="row g-4 team-generator-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Player Names (One per line)</label>
                    <textarea id="team-players" class="form-control" rows="8" placeholder="Alice&#10;Bob&#10;Charlie&#10;David&#10;Eve&#10;Frank"></textarea>
                    <div class="mt-2 d-flex justify-content-between align-items-center">
                        <span class="small text-muted" id="player-count">0 players detected</span>
                        <button class="btn btn-link btn-sm text-decoration-none p-0" id="load-sample" style="min-width: 280px; max-width: 100%;">Load Sample Names</button>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Split Method</label>
                        <select id="split-method" class="form-select form-select-lg">
                            <option value="teams" selected>By Number of Teams</option>
                            <option value="per-team">By Players per Team</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom" id="split-label">Number of Teams</label>
                        <input type="number" id="split-value" class="form-control form-control-lg" value="2" min="1">
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn d-block mx-auto btn-success py-3 px-5 fw-bold rounded-pill shadow-sm" id="generate-btn" style="min-width: 280px; max-width: 100%;">
                        <i class="fas fa-users me-2"></i>Generate Teams
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="team-output-card" style="--tool-hue:140;--tool-color:#16a34a;--tool-bg:rgba(34,197,94,.04);">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="fw-bold mb-0"><i class="fas fa-check-circle me-2 text-primary"></i>Generated Teams</h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-dark" id="copy-teams" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy All</button>
                    <button class="btn btn-sm btn-outline-dark" id="clear-teams" style="min-width: 280px; max-width: 100%;"><i class="fas fa-trash-alt me-1"></i>Clear</button>
                </div>
            </div>
            
            <div id="teams-grid" class="row g-3">
                <!-- Teams will be injected here -->
            </div>
        </div>
    </div>
</div>

<style>
.team-generator-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.team-generator-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.team-generator-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.team-generator-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.team-generator-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.team-generator-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}

.team-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
    height: 100%;
}
.team-card-header {
    background: #f8fafc;
    padding: 10px 15px;
    border-bottom: 1px solid #e2e8f0;
    font-weight: 800;
    color: #1e293b;
    display: flex;
    justify-content: space-between;
}
.team-card-body {
    padding: 10px 15px;
}
.player-item {
    padding: 6px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.95rem;
    color: #475569;
}
.player-item:last-child { border-bottom: none; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);
    
    $('team-players').addEventListener('input', updateCount);
    $('load-sample').addEventListener('click', () => {
        $('team-players').value = "James\nMary\nJohn\nPatricia\nRobert\nJennifer\nMichael\nLinda\nWilliam\nElizabeth";
        updateCount();
    });

    function updateCount() {
        const list = $('team-players').value.split('\n').filter(s => s.trim().length > 0);
        $('player-count').textContent = `${list.length} players detected`;
    }

    $('split-method').addEventListener('change', function() {
        $('split-label').textContent = this.value === 'teams' ? 'Number of Teams' : 'Players per Team';
    });

    $('generate-btn').addEventListener('click', generateTeams);
    $('clear-teams').addEventListener('click', () => {
        $('team-output-card').classList.add('d-none');
    });

    function generateTeams() {
        const players = $('team-players').value.split('\n').map(s => s.trim()).filter(s => s.length > 0);
        if (players.length === 0) {
            alert('Please enter player names first.');
            return;
        }

        const method = $('split-method').value;
        const val = parseInt($('split-value').value) || 2;
        
        let numTeams;
        if (method === 'teams') {
            numTeams = Math.min(val, players.length);
        } else {
            numTeams = Math.ceil(players.length / val);
        }

        if (numTeams <= 0) numTeams = 1;

        // Shuffle players
        const shuffled = [...players];
        for (let i = shuffled.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
        }

        const teams = Array.from({ length: numTeams }, () => []);
        shuffled.forEach((player, i) => {
            teams[i % numTeams].push(player);
        });

        renderTeams(teams);
    }

    function renderTeams(teams) {
        const container = $('teams-grid');
        container.innerHTML = '';
        
        teams.forEach((team, i) => {
            const col = document.createElement('div');
            col.className = 'col-md-4 col-sm-6';
            
            let playersHtml = team.map(p => `<div class="player-item">${p}</div>`).join('');
            
            col.innerHTML = `
                <div class="team-card">
                    <div class="team-card-header">
                        <span>Team ${i + 1}</span>
                        <span class="badge bg-light text-dark border">${team.length}</span>
                    </div>
                    <div class="team-card-body">
                        ${playersHtml}
                    </div>
                </div>
            `;
            container.appendChild(col);
        });

        $('team-output-card').classList.remove('d-none');
        $('team-output-card').scrollIntoView({ behavior: 'smooth' });
    }

    $('copy-teams').addEventListener('click', function() {
        let text = "Generated Teams\n\n";
        document.querySelectorAll('.team-card').forEach(card => {
            const name = card.querySelector('.team-card-header span:first-child').innerText;
            const players = Array.from(card.querySelectorAll('.player-item')).map(p => p.innerText);
            text += `${name}:\n${players.join(', ')}\n\n`;
        });
        
        navigator.clipboard.writeText(text).then(() => {
            const o = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
            setTimeout(() => this.innerHTML = o, 2000);
        });
    });
});
</script>

