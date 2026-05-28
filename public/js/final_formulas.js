/* FORMULA BATCH: ALL TOOLS */

    html_beautifier_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        let formatted = '';
        let indent = 0;
        const nodes = text.replace(/>\s*</g, '><').split(/(?=<)|(?<=>)/);
        nodes.forEach(node => {
            if (node.match(/^<\/\w/)) indent--;
            formatted += '  '.repeat(Math.max(0, indent)) + node + '\n';
            if (node.match(/^<\w[^>]*[^\/]>$/) && !node.match(/^<(area|base|br|col|embed|hr|img|input|link|meta|param|source|track|wbr)/)) indent++;
        });
        return {
            mainLabel: 'Original Size',
            mainValue: text.length + ' chars',
            subStats: [{ label: 'Lines', value: formatted.split('\n').length }, { label: 'Indentation', value: '2 Spaces' }],
            enhancedOutput: { clean: formatted.trim(), raw: formatted.trim(), json: { language: 'html', lines: formatted.split('\n').length } }
        };
    }

    css_js_beautifier_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        let formatted = text
            .replace(/\{/g, ' {\n  ')
            .replace(/\}/g, '\n}\n')
            .replace(/;/g, ';\n  ')
            .replace(/\n\s*\n/g, '\n')
            .replace(/  \x7d/g, '}');
        return { mainLabel: 'Code Health', mainValue: 'Beautified', enhancedOutput: { clean: formatted.trim(), raw: formatted.trim() } };
    }

    add_line_numbers_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const lines = text.split('\n');
        const formatted = lines.map((line, i) => `${(i + 1).toString().padStart(3, ' ')} | ${line}`).join('\n');
        return { mainLabel: 'Total Lines', mainValue: lines.length, enhancedOutput: { clean: formatted, raw: formatted } };
    }

    text_cleaner_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const cleaned = text.trim().replace(/\s+/g, ' ');
        return { mainLabel: 'Chars Removed', mainValue: text.length - cleaned.length, enhancedOutput: { clean: cleaned, raw: cleaned } };
    }

    readability_score_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const words = text.trim().split(/\s+/).length;
        const sentences = text.split(/[.!?]+/).length - 1 || 1;
        const syllables = text.replace(/[^aeiouy]/gi, '').length;
        const score = 206.835 - 1.015 * (words / sentences) - 84.6 * (syllables / words);
        let grade = 'Intermediate';
        if (score > 90) grade = 'Easy (5th Grade)';
        else if (score > 60) grade = 'Standard';
        else if (score > 30) grade = 'Difficult';
        else grade = 'Very Confusing';
        return {
            mainLabel: 'Readability Grade',
            mainValue: grade,
            subStats: [{ label: 'Words', value: words }, { label: 'Score', value: score.toFixed(1) }],
            insights: [`Your text has an average of ${(words / sentences).toFixed(1)} words per sentence.`, score > 60 ? "This is accessible to most readers." : "Consider simplifying your sentences."]
        };
    }

    yaml_formatter_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const cleaned = text.trim().replace(/\t/g, '  ');
        return { mainLabel: 'Status', mainValue: 'Formatted', enhancedOutput: { clean: cleaned, raw: cleaned } };
    }

    add_line_breaks_calc(s) {
        const text = s.text_input || '';
        const breakAfter = parseInt(s.break_after) || 1;
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const lines = text.split('\n');
        let formatted = '';
        lines.forEach((line, i) => { formatted += line + ( (i+1)%breakAfter === 0 ? '\n\n' : '\n' ); });
        return { mainValue: 'Success', enhancedOutput: { clean: formatted.trim(), raw: formatted.trim() } };
    }

    add_prefix_suffix_calc(s) {
        const text = s.text_input || '';
        const prefix = s.prefix || '';
        const suffix = s.suffix || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const formatted = text.split('\n').map(l => prefix + l + suffix).join('\n');
        return { mainValue: 'Processed', enhancedOutput: { clean: formatted, raw: formatted } };
    }

    text_repeater_calc(s) {
        const text = s.text_input || '';
        const count = parseInt(s.count) || 1;
        const separator = s.separator || '\\n';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const sep = separator.replace('\\n', '\n').replace('\\t', '\t');
        const formatted = Array(count).fill(text).join(sep);
        return { mainValue: count + ' Copies', enhancedOutput: { clean: formatted, raw: formatted } };
    }

    find_replace_text_calc(s) {
        const text = s.text_input || '';
        const find = s.find_text || '';
        const replace = s.replace_text || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const formatted = text.split(find).join(replace);
        return { mainValue: 'Replaced', enhancedOutput: { clean: formatted, raw: formatted } };
    }

    reverse_transform_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const formatted = text.split('\n').map(l => l.split('').reverse().join('')).reverse().join('\n');
        return { mainValue: 'Reversed', enhancedOutput: { clean: formatted, raw: formatted } };
    }

    sort_lines_alpha_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const lines = text.split('\n').filter(l => l.trim().length > 0);
        const sorted = [...lines].sort((a, b) => a.localeCompare(b)).join('\n');
        return { mainLabel: 'Lines Sorted', mainValue: lines.length, enhancedOutput: { clean: sorted, raw: sorted } };
    }

    sort_by_length_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const lines = text.split('\n').filter(l => l.trim().length > 0);
        const sorted = [...lines].sort((a, b) => a.length - b.length).join('\n');
        return { mainLabel: 'Lines Sorted', mainValue: lines.length, enhancedOutput: { clean: sorted, raw: sorted } };
    }

    text_to_sql_list_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '', raw: '' } };
        const lines = text.split('\n').map(l => l.trim()).filter(l => l.length > 0);
        const sql = '(' + lines.map(l => "'" + l.replace(/'/g, "''") + "'").join(', ') + ')';
        return { mainLabel: 'SQL Entries', mainValue: lines.length, enhancedOutput: { clean: sql, raw: sql } };
    }

    headline_analyzer_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '0', insights: [] };
        const chars = text.length;
        const words = text.trim().split(/\s+/).length;
        let score = 50;
        if (chars > 40 && chars < 60) score += 20;
        if (text.includes('?') || text.includes('!')) score += 10;
        const powerWords = ['best', 'top', 'how', 'why', 'free', 'ultimate', 'guide'];
        powerWords.forEach(w => { if (text.toLowerCase().includes(w)) score += 5; });
        score = Math.min(100, score);
        return {
            mainLabel: 'Headline Score',
            mainValue: score + '/100',
            subStats: [{ label: 'Characters', value: chars }, { label: 'SEO Fit', value: score > 70 ? 'Excellent' : 'Good' }],
            insights: [chars < 40 ? "Your headline may be too short for search results." : "Length is optimal.", words > 6 ? "Consider a more punchy, shorter word count." : "Good word count."]
        };
    }

    number_extractor_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '0', enhancedOutput: { clean: '' } };
        const matches = text.match(/\d+(\.\d+)?/g) || [];
        const result = matches.join('\n');
        return { mainLabel: 'Numbers Found', mainValue: matches.length, enhancedOutput: { clean: result, raw: result } };
    }

    zalgo_text_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '' } };
        const zalgoChars = ['\u030d', '\u030e', '\u0304', '\u0305', '\u033f', '\u0311', '\u0306', '\u0310', '\u0352', '\u0357', '\u0351', '\u0307', '\u0308', '\u030a', '\u0342', '\u0343', '\u0344', '\u034a', '\u034b', '\u034c', '\u0303', '\u0302', '\u030c', '\u0350', '\u0300', '\u0301', '\u030b', '\u030f', '\u0312', '\u0313', '\u0314', '\u033d', '\u0309', '\u0363', '\u0364', '\u0365', '\u0366', '\u0367', '\u0368', '\u0369', '\u036a', '\u036b', '\u036c', '\u036d', '\u036e', '\u036f', '\u033e', '\u035b', '\u0346', '\u031a'];
        let result = '';
        for (let i = 0; i < text.length; i++) {
            result += text[i];
            const num = Math.floor(Math.random() * 5) + 2;
            for (let j = 0; j < num; j++) result += zalgoChars[Math.floor(Math.random() * zalgoChars.length)];
        }
        return { mainLabel: 'Status', mainValue: 'Zalgo-fied', enhancedOutput: { clean: result, raw: result } };
    }

    small_text_generator_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '' } };
        const map = { 'a': 'ᵃ', 'b': 'ᵇ', 'c': 'ᶜ', 'd': 'ᵈ', 'e': 'ᵉ', 'f': 'ᶠ', 'g': 'ᵍ', 'h': 'ʰ', 'i': 'ⁱ', 'j': 'ʲ', 'k': 'ᵏ', 'l': 'ˡ', 'm': 'ᵐ', 'n': 'ⁿ', 'o': 'ᵒ', 'p': 'ᵖ', 'q': 'ᵠ', 'r': 'ʳ', 's': 'ˢ', 't': 'ᵗ', 'u': 'ᵘ', 'v': 'ᵛ', 'w': 'ʷ', 'x': 'ˣ', 'y': 'ʸ', 'z': 'ᶻ', 'A': 'ᴬ', 'B': 'ᴮ', 'C': 'ᶜ', 'D': 'ᴰ', 'E': 'ᴱ', 'F': 'ᶠ', 'G': 'ᴳ', 'H': 'ᴴ', 'I': 'ᴵ', 'J': 'ᴶ', 'K': 'ᴷ', 'L': 'ᴸ', 'M': 'ᴹ', 'N': 'ᴺ', 'O': 'ᴼ', 'P': 'ᴾ', 'Q': 'ᵠ', 'R': 'ᴿ', 'S': 'ˢ', 'T': 'ᵀ', 'U': 'ᵁ', 'V': 'ⱽ', 'W': 'ᵂ', 'X': 'ˣ', 'Y': 'ʸ', 'Z': 'ᶻ' };
        const result = text.split('').map(c => map[c] || c).join('');
        return { mainLabel: 'Status', mainValue: 'Minified', enhancedOutput: { clean: result, raw: result } };
    }

    upside_down_text_calc(s) {
        const text = s.text_input || '';
        if (!text) return { mainValue: '', enhancedOutput: { clean: '' } };
        const map = { 'a': 'ɐ', 'b': 'q', 'c': 'ɔ', 'd': 'p', 'e': 'ǝ', 'f': 'ɟ', 'g': 'ƃ', 'h': 'ɥ', 'i': 'ᴉ', 'j': 'ɾ', 'k': 'ʞ', 'l': 'l', 'm': 'ɯ', 'n': 'u', 'o': 'o', 'p': 'd', 'q': 'b', 'r': 'ɹ', 's': 's', 't': 'ʇ', 'u': 'n', 'v': 'ʌ', 'w': 'ʍ', 'x': 'x', 'y': 'ʎ', 'z': 'z', 'A': '∀', 'B': 'ᗺ', 'C': 'Ɔ', 'D': 'ᗡ', 'E': 'Ǝ', 'F': 'Ⅎ', 'G': '⅁', 'H': 'H', 'I': 'I', 'J': 'ᗿ', 'K': 'ʞ', 'L': '˥', 'M': 'W', 'N': 'N', 'O': 'O', 'P': 'Ԁ', 'Q': 'Ό', 'R': 'ᴚ', 'S': 'S', 'T': '⊥', 'U': '∩', 'V': 'Λ', 'W': 'M', 'X': 'X', 'Y': '⅄', 'Z': 'Z' };
        const result = text.split('').reverse().map(c => map[c] || c).join('');
        return { mainLabel: 'Status', mainValue: 'Flipped', enhancedOutput: { clean: result, raw: result } };
    }
}
