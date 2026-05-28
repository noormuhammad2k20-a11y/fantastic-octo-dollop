<div class="interactive-tool-grid krutidev-to-unicode">
    <div class="calculator-card premium-shadow animate-up">
        

        <div class="calculator-body">
            <div class="form-group-custom mb-3">
                <label class="form-label-custom">KrutiDev Text (Hindi)</label>
                <textarea id="kruti-in" class="form-control-custom font-hindi" rows="6" placeholder="केसरिया बालम... (Paste KrutiDev here)"></textarea>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-accent flex-grow-1 py-3 hvr-grow" id="convert-kruti" style="min-width: 280px; max-width: 100%;">
                    <i class="fas fa-magic me-2"></i> Convert to Unicode
                </button>
                <button class="btn btn-outline-secondary py-3 px-4 hvr-shrink" id="clear-kruti" title="Clear All">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="result-panel animate-up-delayed">
        <div class="result-card-v2 premium-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="result-label mb-0">Unicode Output</span>
                <span class="badge bg-accent-soft text-accent rounded-pill px-3 py-2">Clean Devanagari</span>
            </div>
            
            <textarea id="unicode-out" class="form-control-custom bg-transparent border-0 mt-2 font-unicode" 
                      rows="8" readonly placeholder="Output will appear here..." 
                      style="resize: none; font-size: 1.25rem; line-height: 1.6;"></textarea>
            
            <div class="result-sub-stats mt-4 py-3 border-top border-bottom border-light d-flex justify-content-around">
                <div class="stat-item text-center">
                    <span class="stat-label d-block small text-secondary">Characters</span>
                    <span class="stat-value fw-black text-dark fs-4" id="stat-chars">0</span>
                </div>
                <div class="stat-item text-center">
                    <span class="stat-label d-block small text-secondary">Language</span>
                    <span class="stat-value fw-bold text-accent fs-5">Hindi</span>
                </div>
            </div>

            <button class="btn d-block mx-auto btn-accent mt-4 shadow-sm hvr-glow pulse-accent py-3 px-5 fw-bold rounded-pill shadow-sm" id="copy-unicode" style="min-width: 280px; max-width: 100%;">
                <i class="fas fa-copy me-2"></i> Copy Unicode Text
            </button>
        </div>
    </div>
</div>

<style>
    .font-hindi { font-family: 'Kruti Dev 010', sans-serif; }
    .font-unicode { font-family: 'Inter', 'Noto Sans Devanagari', sans-serif; }
    .premium-shadow { box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .bg-accent-soft { background-color: rgba(var(--accent-rgb), 0.1); }
    .animate-up { animation: fadeInUp 0.5s ease-out; }
    .animate-up-delayed { animation: fadeInUp 0.5s ease-out 0.2s both; }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .hvr-grow:hover { transform: scale(1.02); transition: 0.2s; }
    .hvr-shrink:active { transform: scale(0.95); transition: 0.1s; }
    
    .pulse-accent:active {
        box-shadow: 0 0 0 0 rgba(var(--accent-rgb), 0.4);
        animation: pulse 0.5s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(var(--accent-rgb), 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(var(--accent-rgb), 0); }
        100% { box-shadow: 0 0 0 0 rgba(var(--accent-rgb), 0); }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const krutiIn = document.getElementById('kruti-in');
    const unicodeOut = document.getElementById('unicode-out');
    const convertBtn = document.getElementById('convert-kruti');
    const clearBtn = document.getElementById('clear-kruti');
    const copyBtn = document.getElementById('copy-unicode');
    const statChars = document.getElementById('stat-chars');

    function convertKrutiDevToUnicode() {
        let krutiText = krutiIn.value;
        if (!krutiText) {
            unicodeOut.value = "";
            statChars.innerText = "0";
            return;
        }

        var array_one = new Array(
            "ñ", "Q+Z", "sas", "aa", ")Z", "ZZ", "‘", "’", "“", "”", "å", "ƒ", "„", "…", "†", "‡", "ˆ", "‰", "Š", "‹", "¶+", "d+", "[+k", "[+", "x+", "T+", "t+", "M+", "<+", "Q+", ";+", "j+", "u+", "Ùk", "Ù", "ä", "–", "—", "é", "™", "=kk", "f=k", "à", "á", "â", "ã", "ºz", "º", "í", "{k", "{", "=", "«", "Nî", "Vî", "Bî", "Mî", "<î", "|", "K", "}", "J", "Vª", "Mª", "<ªª", "Nª", "Ø", "Ý", "nzZ", "æ", "ç", "Á", "xz", "#", ":", "v‚", "vks", "vkS", "vk", "v", "b±", "Ã", "bZ", "b", "m", "Å", ",s", ",", "_", "ô", "d", "Dk", "D", "[k", "[", "x", "Xk", "X", "Ä", "?k", "?", "³", "pkS", "p", "Pk", "P", "N", "t", "Tk", "T", ">", "÷", "¥", "ê", "ë", "V", "B", "ì", "ï", "M+", "<+", "M", "<", ".k", ".", "r", "Rk", "R", "Fk", "F", ")", "n", "/k", "èk", "/", "Ë", "è", "u", "Uk", "U", "i", "Ik", "I", "Q", "¶", "c", "Ck", "C", "Hk", "H", "e", "Ek", "E", ";", "¸", "j", "y", "Yk", "Y", "G", "o", "Ok", "O", "'k", "'", "\"k", "\"", "l", "Lk", "L", "g", "È", "z", "Ì", "Í", "Î", "Ï", "Ñ", "Ò", "Ó", "Ô", "Ö", "Ø", "Ù", "Ük", "Ü", "‚", "ks", "kS", "k", "h", "q", "w", "`", "s", "S", "a", "¡", "%", "W", "•", "·", "∙", "·", "~j", "~", "\\", "+", " अः", "^", "*", "Þ", "ß", "(", "¼", "½", "¿", "À", "¾", "A", "-", "&", "&", "Œ", "]", "~ ", "@"
        );

        var array_two = new Array(
            "॰", "QZ+", "sa", "a", "र्द्ध", "Z", "\"", "\"", "'", "'", "०", "१", "२", "३", "४", "५", "६", "७", "८", "९", "फ़्", "क़", "ख़", "ख़्", "ग़", "ज़्", "ज़", "ड़", "ढ़", "फ़", "य़", "ऱ", "ऩ", "त्त", "त्त्", "क्त", "दृ", "कृ", "न्न", "न्न्", "=k", "f=", "ह्न", "ह्य", "हृ", "ह्म", "ह्र", "ह्", "द्द", "क्ष", "क्ष्", "त्र", "त्र्", "छ्य", "ट्य", "ठ्य", "ड्य", "ढ्य", "द्य", "ज्ञ", "द्व", "श्र", "ट्र", "ड्र", "ढ्र", "छ्र", "क्र", "फ्र", "र्द्र", "द्र", "प्र", "प्र", "ग्र", "रु", "रू", "ऑ", "ओ", "औ", "आ", "अ", "ईं", "ई", "ई", "इ", "उ", "ऊ", "ऐ", "ए", "ऋ", "क्क", "क", "क", "क्", "ख", "ख्", "ग", "ग", "ग्", "घ", "घ", "घ्", "ङ", "चै", "च", "च", "च्", "छ", "ज", "ज", "ज्", "झ", "झ्", "ञ", "ट्ट", "ट्ठ", "ट", "ठ", "ड्ड", "ड्ढ", "ड़", "ढ़", "ड", "ढ", "ण", "ण्", "त", "त", "त्", "थ", "थ्", "द्ध", "द", "ध", "ध", "ध्", "ध्", "ध्", "न", "न", "न्", "प", "प", "प्", "फ", "फ्", "ब", "ब", "ब्", "भ", "भ्", "म", "म", "म्", "य", "य्", "र", "ल", "ल", "ल्", "ळ", "व", "व", "व्", "श", "श्", "ष", "ष्", "स", "स", "स्", "ह", "ीं", "्र", "द्द", "ट्ट", "ट्ठ", "ड्ड", "कृ", "भ", "्य", "ड्ढ", "झ्", "क्र", "त्त्", "श", "श्", "ॉ", "ो", "ौ", "ा", "ी", "ु", "ू", "ृ", "े", "ै", "ं", "ँ", "ः", "ॅ", "ऽ", "ऽ", "ऽ", "ऽ", "्र", "्", "?", "़", ":", "‘", "’", "“", "”", ";", "(", ")", "{", "}", "=", "।", ".", "-", "µ", "॰", ",", "् ", "/"
        );

        var modified_substring = krutiText;
        var array_one_length = array_one.length;

        for (var input_symbol_idx = 0; input_symbol_idx < array_one_length; input_symbol_idx++) {
            var idx = 0;
            while (idx != -1) {
                modified_substring = modified_substring.replace(array_one[input_symbol_idx], array_two[input_symbol_idx]);
                idx = modified_substring.indexOf(array_one[input_symbol_idx]);
            }
        }

        // Special handling for 'f' (short-i) matra reordering
        var position_of_f = modified_substring.indexOf("f");
        while (position_of_f != -1) {
            var character_next_to_f = modified_substring.charAt(position_of_f + 1);
            var character_to_be_replaced = "f" + character_next_to_f;
            modified_substring = modified_substring.replace(character_to_be_replaced, character_next_to_f + "ि");
            position_of_f = modified_substring.search(/f/, position_of_f + 1);
        }

        // Special handling for 'Z' (reph) reordering
        var matras = "ा ि ी ु ू ृ े ै ो ौ ं ँ :";
        var position_of_Z = modified_substring.indexOf("Z");
        while (position_of_Z > 0) {
            var probable_position_of_half_char = position_of_Z - 1;
            var character_at_probable_position = modified_substring.charAt(probable_position_of_half_char);
            while (matras.match(character_at_probable_position) != null) {
                probable_position_of_half_char = probable_position_of_half_char - 1;
                character_at_probable_position = modified_substring.charAt(probable_position_of_half_char);
            }
            var character_to_be_replaced = modified_substring.substr(probable_position_of_half_char, (position_of_Z - probable_position_of_half_char));
            var replacement_string = "र्" + character_to_be_replaced;
            character_to_be_replaced = character_to_be_replaced + "Z";
            modified_substring = modified_substring.replace(character_to_be_replaced, replacement_string);
            position_of_Z = modified_substring.indexOf("Z");
        }

        unicodeOut.value = modified_substring;
        statChars.innerText = modified_substring.length;
    }

    convertBtn.addEventListener('click', convertKrutiDevToUnicode);
    
    clearBtn.addEventListener('click', () => {
        krutiIn.value = "";
        unicodeOut.value = "";
        statChars.innerText = "0";
    });

    copyBtn.addEventListener('click', function() {
        if (!unicodeOut.value) return;
        navigator.clipboard.writeText(unicodeOut.value).then(() => {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        });
    });

    krutiIn.addEventListener('input', () => {
        statChars.innerText = krutiIn.value.length;
    });
});
</script>

