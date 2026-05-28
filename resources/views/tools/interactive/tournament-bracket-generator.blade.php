<div class="row g-4 bracket-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            
            <div class="calculator-body">
                <div class="mb-4">
                    <label class="form-label-custom">Participants (One per line)</label>
                    <textarea id="bracket-input" class="form-control" rows="6" placeholder="Player 1&#10;Player 2&#10;Player 3&#10;Player 4..."></textarea>
                    <div class="form-text mt-2 text-muted"><i class="fas fa-info-circle me-1"></i> Works best with 4, 8, 16, or 32 participants. (Byes will be added automatically if needed).</div>
                </div>

                <button class="btn d-block mx-auto btn-primary fw-bold fs-5 py-3 px-5 fw-bold rounded-pill shadow-sm"" id="bracket-generate" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-random me-2"></i>Generate Bracket
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="output-card-themed d-none" id="bracket-output-card" style="--tool-hue:210;--tool-color:#2563eb;--tool-bg:rgba(59,130,246,.04); border-color:#bfdbfe;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-trophy me-2 text-warning"></i>Tournament Bracket</h5>
                <button class="btn btn-sm btn-outline-dark" id="copy-bracket" style="min-width: 280px; max-width: 100%;"><i class="fas fa-copy me-1"></i>Copy Text Bracket</button>
            </div>
            
            <div class="bracket-container overflow-auto custom-scrollbar p-3 bg-white border rounded-3" style="min-height: 300px;">
                <div class="d-flex" id="bracket-visual" style="min-width: max-content; gap: 2rem;">
                    <!-- Bracket rounds injected here -->
                </div>
            </div>
            
            <textarea id="bracket-raw" class="d-none"></textarea>
        </div>
    </div>
</div>

<style>
.bracket-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.bracket-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.bracket-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.bracket-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.bracket-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.bracket-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:.6rem;}

.bracket-round {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    min-width: 200px;
}
.bracket-match {
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    margin-bottom: 1rem;
    position: relative;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}
.bracket-team {
    padding: 0.5rem 1rem;
    font-weight: 600;
    color: #334155;
    border-bottom: 1px solid #e2e8f0;
}
.bracket-team:last-child {
    border-bottom: none;
}
.bracket-team.bye {
    color: #94a3b8;
    font-style: italic;
}
.round-title {
    text-align: center;
    font-weight: 800;
    color: #475569;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 1px;
}

/* Connector Lines (Simple visual representation) */
.bracket-round:not(:last-child) {
    position: relative;
}
.custom-scrollbar::-webkit-scrollbar { height: 8px; }
.custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const $ = id => document.getElementById(id);

    function nextPowerOfTwo(n) {
        let count = 0;
        if (n && !(n & (n - 1))) return n;
        while( n != 0) { n >>= 1; count += 1; }
        return 1 << count;
    }

    $('bracket-generate').addEventListener('click', function() {
        const input = $('bracket-input').value;
        let lines = input.split('\n').map(l => l.trim()).filter(l => l.length > 0);
        
        if (lines.length < 2) {
            alert('Please enter at least 2 participants.');
            return;
        }

        // Shuffle
        for (let i = lines.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [lines[i], lines[j]] = [lines[j], lines[i]];
        }

        const size = nextPowerOfTwo(lines.length);
        const byes = size - lines.length;
        
        // Add byes
        for (let i = 0; i < byes; i++) {
            lines.push('BYE');
        }

        // Create rounds
        let currentRound = lines;
        const rounds = [];
        let rawText = "--- TOURNAMENT BRACKET ---\n\n";

        let roundNum = 1;
        while (currentRound.length >= 2) {
            const matches = [];
            const nextRound = [];
            
            rawText += `ROUND ${roundNum}\n`;
            
            for (let i = 0; i < currentRound.length; i += 2) {
                const t1 = currentRound[i];
                const t2 = currentRound[i+1];
                matches.push([t1, t2]);
                
                rawText += `${t1}  vs  ${t2}\n`;
                
                if (t1 === 'BYE') nextRound.push(t2);
                else if (t2 === 'BYE') nextRound.push(t1);
                else nextRound.push('TBD'); // Placeholder for next round visual
            }
            rounds.push(matches);
            currentRound = nextRound;
            rawText += "\n";
            roundNum++;
        }

        // Add Winner placeholder round
        rounds.push([['Winner', '']]);

        const container = $('bracket-visual');
        container.innerHTML = '';

        rounds.forEach((rnd, rIdx) => {
            const col = document.createElement('div');
            col.className = 'bracket-round';
            
            let rName = `Round ${rIdx + 1}`;
            if (rIdx === rounds.length - 2) rName = 'Finals';
            if (rIdx === rounds.length - 1) rName = 'Champion';

            let html = `<div class="round-title">${rName}</div>`;
            
            rnd.forEach(match => {
                if (match[1] === '') {
                    // Winner block
                    html += `
                        <div class="bracket-match" style="background:#fef3c7; border-color:#fde047;">
                            <div class="bracket-team text-center fs-5 text-warning fw-black"><i class="fas fa-trophy me-2"></i>Champion</div>
                        </div>
                    `;
                } else {
                    const c1 = match[0] === 'BYE' || match[0] === 'TBD' ? 'bye' : '';
                    const c2 = match[1] === 'BYE' || match[1] === 'TBD' ? 'bye' : '';
                    html += `
                        <div class="bracket-match">
                            <div class="bracket-team ${c1}">${match[0]}</div>
                            <div class="bracket-team ${c2}">${match[1]}</div>
                        </div>
                    `;
                }
            });
            col.innerHTML = html;
            container.appendChild(col);
        });

        $('bracket-raw').value = rawText;
        $('bracket-output-card').classList.remove('d-none');
        $('bracket-output-card').scrollIntoView({ behavior: 'smooth' });
    });

    $('copy-bracket').addEventListener('click', function() {
        $('bracket-raw').classList.remove('d-none');
        $('bracket-raw').select();
        document.execCommand('copy');
        $('bracket-raw').classList.add('d-none');
        const o = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        setTimeout(() => this.innerHTML = o, 2000);
    });
});
</script>

