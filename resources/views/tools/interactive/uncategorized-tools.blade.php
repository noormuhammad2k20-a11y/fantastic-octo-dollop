<div class="max-w-4xl mx-auto space-y-4 font-sans">
    <!-- Input Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-folder-open"></i>
            </div>
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 m-0 leading-tight">Uncategorized Tools</h1>
                <p class="text-sm text-slate-500 m-0">Review and organize tools that do not currently have an assigned category.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Tool Identifier</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-indigo-500 transition-colors">
                    <span class="flex items-center px-3 bg-slate-100 text-slate-500 text-sm font-bold border-r border-slate-200"><i class="fas fa-tag"></i></span>
                    <input type="text" id="uncat-id" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none" placeholder="e.g. tool-123">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1">Action Type</label>
                <div class="flex items-stretch bg-slate-50 border border-slate-200 rounded-xl overflow-hidden focus-within:border-indigo-500 transition-colors">
                    <select id="uncat-action" class="w-full bg-transparent border-none px-3 py-2 text-slate-800 font-bold focus:outline-none">
                        <option value="analyze">Analyze Tool</option>
                        <option value="archive">Archive Tool</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-2">
            <button type="button" onclick="runUncat()" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                <i class="fas fa-play me-2"></i> Run Action
            </button>
            <button type="button" onclick="resetUncat()" class="w-12 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold py-2 rounded-xl transition-colors flex items-center justify-center">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <!-- Output Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-5 border-t-4 border-t-indigo-500">
        <div class="text-center pb-4 border-b border-gray-100 mb-4">
            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Status Report</span>
            <div class="text-3xl font-extrabold text-indigo-600 leading-none" id="out-uncat-status">Ready</div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Target Tool</span>
                <span class="text-lg font-bold text-slate-800" id="out-uncat-target">---</span>
            </div>
            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Applied Action</span>
                <span class="text-lg font-bold text-slate-800" id="out-uncat-action">---</span>
            </div>
        </div>
    </div>
</div>

<script>
function runUncat() {
    const id = document.getElementById('uncat-id').value || 'Unknown';
    const action = document.getElementById('uncat-action').value;
    document.getElementById('out-uncat-status').innerText = 'Processed';
    document.getElementById('out-uncat-target').innerText = id;
    document.getElementById('out-uncat-action').innerText = action.charAt(0).toUpperCase() + action.slice(1);
}
function resetUncat() {
    document.getElementById('uncat-id').value = '';
    document.getElementById('uncat-action').value = 'analyze';
    document.getElementById('out-uncat-status').innerText = 'Ready';
    document.getElementById('out-uncat-target').innerText = '---';
    document.getElementById('out-uncat-action').innerText = '---';
}
</script>
