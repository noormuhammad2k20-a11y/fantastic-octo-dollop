<div class="row g-4 sqlfmt-rebuilt">
    <div class="col-lg-12">
        <div class="calculator-card">
            
            <div class="calculator-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-custom">SQL Query</label>
                        <textarea id="sql-input" class="form-control form-control-lg rounded-3 font-monospace" rows="6" style="font-size:.85rem" placeholder="SELECT * FROM users WHERE id = 1">select u.id, u.name, u.email, o.total from users u inner join orders o on u.id = o.user_id where u.active = 1 and o.total > 100 group by u.id having count(o.id) > 3 order by o.total desc limit 10</textarea>
                    </div>
                </div>
                <div class="mt-3 d-flex flex-wrap gap-2">
                    <button class="btn btn-dark rounded-pill fw-bold px-4" id="sql-format"><i class="fas fa-align-left me-2"></i>Format</button>
                    <button class="btn btn-outline-dark rounded-pill fw-bold px-4" id="sql-minify"><i class="fas fa-compress me-2"></i>Minify</button>
                    <button class="btn btn-outline-primary rounded-pill fw-bold px-4" id="sql-upper"><i class="fas fa-font me-2"></i>Uppercase Keywords</button>
                    <button class="btn btn-outline-secondary rounded-pill px-4" id="sql-clear"><i class="fas fa-undo me-2"></i>Clear</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="output-card-themed" style="--tool-color:#06b6d4;--tool-bg:rgba(6,182,212,.04)">
            <div class="output-hero">
                <span class="output-hero-label">Query Analysis</span>
                <div class="output-hero-value" id="out-sql-type" style="font-size:2rem">SELECT</div>
                <span class="output-hero-unit" id="out-sql-info">—</span>
            </div>
            <div class="row g-3 mt-4">
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Keywords</span><span class="stat-card-value" id="out-sql-kw">0</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Tables</span><span class="stat-card-value" id="out-sql-tables">0</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Joins</span><span class="stat-card-value" id="out-sql-joins">0</span></div></div>
                <div class="col-6 col-md-3"><div class="stat-card"><span class="stat-card-label">Chars</span><span class="stat-card-value" id="out-sql-chars">0</span></div></div>
            </div>
            <h6 class="fw-bold mt-4 mb-3"><i class="fas fa-code me-2 text-primary"></i>Formatted Output</h6>
            <div class="p-3 rounded-3" style="background:#f1f5f9;overflow-x:auto">
                <pre id="out-sql-result" class="mb-0 font-monospace small" style="white-space:pre-wrap;word-break:break-all"></pre>
            </div>
            <button class="btn d-block mx-auto btn-dark mt-4 py-3 px-5 fw-bold rounded-pill shadow-sm" id="sql-copy" style="min-width:280px;max-width:100%"><i class="fas fa-copy me-2"></i>Copy SQL</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded',function(){
const $=id=>document.getElementById(id);
const KEYWORDS=['SELECT','FROM','WHERE','AND','OR','NOT','IN','BETWEEN','LIKE','IS','NULL','AS',
    'JOIN','INNER','LEFT','RIGHT','OUTER','FULL','CROSS','ON','USING','GROUP','BY','HAVING',
    'ORDER','ASC','DESC','LIMIT','OFFSET','INSERT','INTO','VALUES','UPDATE','SET','DELETE',
    'CREATE','TABLE','ALTER','DROP','INDEX','VIEW','UNION','ALL','DISTINCT','CASE','WHEN',
    'THEN','ELSE','END','EXISTS','COUNT','SUM','AVG','MIN','MAX','CAST','COALESCE','IF'];
const MAJOR=['SELECT','FROM','WHERE','JOIN','INNER JOIN','LEFT JOIN','RIGHT JOIN','FULL JOIN',
    'CROSS JOIN','GROUP BY','HAVING','ORDER BY','LIMIT','OFFSET','INSERT INTO','VALUES',
    'UPDATE','SET','DELETE FROM','UNION','UNION ALL','ON'];

function formatSQL(sql){
    let s=sql.replace(/\s+/g,' ').trim();
    // Uppercase keywords
    KEYWORDS.forEach(kw=>{
        const re=new RegExp('\\b'+kw+'\\b','gi');
        s=s.replace(re,kw);
    });
    // Add newlines before major clauses
    MAJOR.forEach(kw=>{
        const re=new RegExp('\\s+'+kw.replace(/ /g,'\\s+')+'\\b','gi');
        s=s.replace(re,'\n'+kw);
    });
    // Indent after first line
    const lines=s.split('\n');
    let result=lines[0];
    for(let i=1;i<lines.length;i++){
        const line=lines[i].trim();
        if(/^(SELECT|FROM|WHERE|GROUP|HAVING|ORDER|LIMIT|OFFSET|INSERT|UPDATE|DELETE|SET|VALUES|UNION)/.test(line)){
            result+='\n'+line;
        }else{
            result+='\n  '+line;
        }
    }
    return result;
}
function minifySQL(sql){return sql.replace(/\s+/g,' ').replace(/\s*,\s*/g,', ').trim()}
function uppercaseKW(sql){
    let s=sql;
    KEYWORDS.forEach(kw=>{s=s.replace(new RegExp('\\b'+kw+'\\b','gi'),kw)});
    return s;
}
function analyze(sql){
    const upper=sql.toUpperCase();
    let kwCount=0;KEYWORDS.forEach(kw=>{const re=new RegExp('\\b'+kw+'\\b','gi');const m=sql.match(re);if(m)kwCount+=m.length});
    const joinCount=(upper.match(/\bJOIN\b/g)||[]).length;
    const fromMatch=upper.match(/\bFROM\b/g);
    const tableCount=(fromMatch?fromMatch.length:0)+joinCount;
    const type=upper.match(/^\s*(SELECT|INSERT|UPDATE|DELETE|CREATE|ALTER|DROP)/);
    return{kwCount,joinCount,tableCount,type:type?type[1]:'QUERY'};
}

function doFormat(){
    const raw=$('sql-input').value;if(!raw.trim())return;
    const formatted=formatSQL(raw);
    $('out-sql-result').textContent=formatted;
    $('sql-input').value=formatted;
    updateStats(raw);
}
function doMinify(){
    const raw=$('sql-input').value;if(!raw.trim())return;
    const min=minifySQL(raw);
    $('out-sql-result').textContent=min;
    $('sql-input').value=min;
    updateStats(raw);
}
function doUpper(){
    const raw=$('sql-input').value;if(!raw.trim())return;
    const up=uppercaseKW(raw);
    $('out-sql-result').textContent=up;
    $('sql-input').value=up;
    updateStats(raw);
}
function updateStats(sql){
    const a=analyze(sql);
    $('out-sql-type').textContent=a.type;
    $('out-sql-kw').textContent=a.kwCount;
    $('out-sql-tables').textContent=a.tableCount;
    $('out-sql-joins').textContent=a.joinCount;
    $('out-sql-chars').textContent=sql.length;
    $('out-sql-info').textContent=a.kwCount+' keywords, '+a.tableCount+' tables, '+a.joinCount+' joins';
}

$('sql-format').addEventListener('click',doFormat);
$('sql-minify').addEventListener('click',doMinify);
$('sql-upper').addEventListener('click',doUpper);
$('sql-clear').addEventListener('click',()=>{$('sql-input').value='';$('out-sql-result').textContent='';$('out-sql-type').textContent='—'});
$('sql-copy').addEventListener('click',function(){
    navigator.clipboard.writeText($('out-sql-result').textContent).then(()=>{const o=this.innerHTML;this.innerHTML='<i class="fas fa-check me-2"></i>Copied!';setTimeout(()=>this.innerHTML=o,2e3)});
});
doFormat();
});
</script>
<style>
.sqlfmt-rebuilt .calculator-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,.04)}
.sqlfmt-rebuilt .calculator-header{display:flex;align-items:center;gap:1rem;margin-bottom:2rem}
.sqlfmt-rebuilt .calculator-header h4{margin:0;font-weight:800;color:#1e293b}
.sqlfmt-rebuilt .calculator-header p{margin:0;font-size:.9rem;color:#64748b}
.sqlfmt-rebuilt .tool-icon-circle{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0}
.sqlfmt-rebuilt .form-label-custom{font-size:.8rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;display:block}
</style>
<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\sql-query-formatter.blade.php ENDPATH**/ ?>