<div class="row g-4 dev-rebuilt">
    
    <div class="col-lg-12">
        <div class="calculator-card border-0" style="border-radius: 24px; background: #0f172a; box-shadow: 0 4px 30px rgba(16, 185, 129, .1);">
            <div class="calculator-header px-4 pt-4 d-flex align-items-center">
                <div class="tool-icon-circle shadow-sm" style="background: linear-gradient(135deg, #10B981, #059669); color:#fff; width: 60px; height: 60px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                    <i class="fas fa-terminal"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0" style="color:#f8fafc; letter-spacing: -0.5px;">JSON / XML Converter</h4>
                    <p class="text-slate-400 small mb-0">Bidirectional conversion between JSON, XML, and CSV formats.</p>
                </div>
            </div>

            <div class="calculator-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-8">
                        <div class="p-4 rounded-4 bg-slate-900 border border-slate-800 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold small mb-0 uppercase text-slate-500">Source Stream</h6>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-slate-800 btn-sm text-white px-3 fw-bold rounded-pill" id="v-beautify">BEAUTIFY</button>
                                    <button class="btn btn-slate-800 btn-sm text-white px-3 fw-bold rounded-pill" id="v-clear">CLEAR</button>
                                </div>
                            </div>
                            <textarea id="v-input" class="form-control border-0 bg-slate-800 text-emerald rounded-4 p-4 font-monospace small mb-0" rows="12" placeholder='Paste JSON, XML, or CSV here...' style="resize: vertical;"></textarea>
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <div class="p-4 rounded-4 border h-100 shadow-sm bg-slate-900 border-emerald-500/20">
                            <h6 class="fw-bold small mb-3 uppercase text-emerald opacity-70">Mapping Config</h6>
                            <div class="mb-4">
                                <label class="form-label-custom text-slate-300">Conversion Type</label>
                                <select id="v-type" class="form-select border-0 bg-slate-800 text-white rounded-3 fw-bold">
                                    <option value="json2xml">JSON → XML</option>
                                    <option value="xml2json">XML → JSON</option>
                                    <option value="json2csv">JSON → CSV</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom text-slate-300">XML Root Node</label>
                                <input type="text" id="v-root" class="form-control border-0 bg-slate-800 text-white rounded-3 fw-bold" value="root">
                            </div>
                            <div class="mb-0">
                                <label class="form-label-custom text-slate-300">Formatting</label>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="v-minify">
                                    <label class="form-check-label small fw-bold text-slate-400">Minify Output</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="v-strict" checked>
                                    <label class="form-check-label small fw-bold text-slate-400">Strict Validation</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top border-slate-800 d-flex justify-content-center">
                    <button class="btn btn-emerald rounded-pill px-5 py-3 fw-bold shadow-sm" id="convert-btn">
                        <i class="fas fa-bolt me-2"></i>Convert
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-12">
        <div class="output-card-themed" id="out-wrapper" style="--tool-hue: 150; --tool-color: #10B981; --tool-bg: rgba(16, 185, 129, .04); display: none;">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-emerald-soft text-emerald px-4 py-2 rounded-pill fw-bold shadow-sm" id="out-status">STREAM OPTIMIZED</span>
                    <div class="d-flex gap-2">
                        <button class="btn btn-emerald btn-sm rounded-pill px-4 fw-bold text-white shadow-sm" id="copy-summary">COPY</button>
                        <button class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold" id="download-btn">DOWNLOAD</button>
                    </div>
                </div>
                <div class="p-4 rounded-4 bg-slate-900 border border-slate-800">
                    <pre id="out-data" class="text-emerald font-monospace small mb-0 overflow-auto" style="max-height: 600px; white-space: pre-wrap; word-break: break-all;"></pre>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const $ = id => document.getElementById(id);
    const inputE = $('v-input'), typeE = $('v-type'), rootE = $('v-root'), minifyE = $('v-minify'), outData = $('out-data'), outWrapper = $('out-wrapper');

    function jsonToXml(obj, name) {
        let xml = '';
        if (name === rootE.value) xml += '<' + '?xml version="1.0" encoding="UTF-8"?' + '>\n';
        xml += `<${name}>`;
        for (let prop in obj) {
            if (obj.hasOwnProperty(prop)) {
                if (typeof obj[prop] === 'object' && obj[prop] !== null) {
                    xml += Array.isArray(obj[prop]) 
                        ? obj[prop].map(item => jsonToXml(item, prop)).join('')
                        : jsonToXml(obj[prop], prop);
                } else {
                    xml += `<${prop}>${obj[prop]}</${prop}>`;
                }
            }
        }
        xml += `</${name}>`;
        return xml;
    }

    function xmlToJson(xml) {
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xml, "text/xml");
        function parseNode(node) {
            let obj = {};
            if (node.nodeType === 1) {
                if (node.attributes.length > 0) {
                    obj["@attributes"] = {};
                    for (let j = 0; j < node.attributes.length; j++) {
                        let attr = node.attributes.item(j);
                        obj["@attributes"][attr.nodeName] = attr.nodeValue;
                    }
                }
            } else if (node.nodeType === 3) return node.nodeValue.trim();
            if (node.hasChildNodes()) {
                for (let i = 0; i < node.childNodes.length; i++) {
                    let item = node.childNodes.item(i);
                    let nodeName = item.nodeName;
                    if (typeof(obj[nodeName]) == "undefined") obj[nodeName] = parseNode(item);
                    else {
                        if (typeof(obj[nodeName].push) == "undefined") {
                            let old = obj[nodeName];
                            obj[nodeName] = [];
                            obj[nodeName].push(old);
                        }
                        obj[nodeName].push(parseNode(item));
                    }
                }
            }
            return obj;
        }
        return parseNode(xmlDoc.documentElement);
    }

    $('convert-btn').addEventListener('click', () => {
        const raw = inputE.value.trim();
        if(!raw) return;
        try {
            let res = '';
            if(typeE.value === 'json2xml'){
                res = jsonToXml(JSON.parse(raw), rootE.value);
            } else if(typeE.value === 'xml2json'){
                res = JSON.stringify(xmlToJson(raw), null, minifyE.checked ? 0 : 4);
            }
            outData.textContent = res;
            outWrapper.style.display = 'block';
            outWrapper.scrollIntoView({ behavior: 'smooth' });
        } catch(e) {
            alert('TRANSFORMATION ERROR: ' + e.message);
        }
    });

    $('v-beautify').addEventListener('click', () => {
        try { inputE.value = JSON.stringify(JSON.parse(inputE.value), null, 4); } catch(e){}
    });

    $('v-clear').addEventListener('click', () => { inputE.value = ''; outWrapper.style.display = 'none'; });

    $('copy-summary').addEventListener('click', function(){
        navigator.clipboard.writeText(outData.textContent).then(() => {
            const o = this.innerHTML; this.innerHTML = 'COPIED!';
            setTimeout(() => this.innerHTML = o, 1500);
        });
    });

    $('download-btn').addEventListener('click', () => {
        const blob = new Blob([outData.textContent], {type: 'text/plain'});
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url; a.download = 'alchemist_data.' + (typeE.value.split('2').pop());
        a.click();
    });
});
</script>

<style>
.dev-rebuilt .form-label-custom{font-size:.7rem;font-weight:900;text-transform:uppercase;letter-spacing:1px;color:#94a3b8;opacity:.7;margin-bottom:8px;display:block}
.dev-rebuilt .calculator-card { transition: all 0.3s ease; }
.btn-emerald { background: #10B981; color: #fff; transition: all .3s; }
.btn-emerald:hover { background: #059669; color: #fff; }
.text-emerald { color: #10B981; }
.text-slate-400 { color: #94a3b8; }
.text-slate-300 { color: #cbd5e1; }
.bg-slate-900 { background-color: #0f172a; }
.bg-slate-800 { background-color: #1e293b; }
.bg-emerald-soft { background: #ecfdf5; }
.fw-900 { font-weight: 900; }
.tracking-widest { letter-spacing: 4px; }
.uppercase { text-transform: uppercase; }
</style>

<?php /**PATH D:\Xamp\htdocs\ToolsHub\resources\views\tools\interactive\json-xml-converter.blade.php ENDPATH**/ ?>