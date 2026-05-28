<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AiGeneratorController extends Controller
{
    public function generate(Request $request, $type)
    {
        $method = 'gen_' . str_replace('-', '_', $type);
        if (method_exists($this, $method)) {
            return $this->$method($request);
        }
        return response()->json(['success' => false, 'message' => 'Unknown generator type'], 400);
    }

    private function pick($arr, $n = 1) { $keys = array_rand($arr, min($n, count($arr))); return $n === 1 ? $arr[$keys] : array_map(fn($k) => $arr[$k], (array)$keys); }
    private function ok($results) { return response()->json(['success' => true, 'results' => array_values(array_unique($results))]); }

    // ======================== AI CONTENT GENERATORS ========================

    private function gen_ai_prompt(Request $request) {
        $topic = $request->input('topic', 'general task');
        $model = $request->input('model', 'chatgpt');
        $style = $request->input('style', 'professional');
        $roles = ['expert consultant','senior analyst','creative director','technical writer','research scientist','strategist'];
        $frameworks = ['step-by-step','chain-of-thought','few-shot examples','structured outline','role-play scenario'];
        $results = [];
        for ($i = 0; $i < 8; $i++) {
            $role = $this->pick($roles); $fw = $this->pick($frameworks);
            $v = rand(1,4);
            if ($v===1) $results[] = "Act as a {$role} specializing in {$topic}. Using a {$fw} approach, provide a comprehensive {$style} analysis. Be specific, data-driven, and actionable.";
            elseif ($v===2) $results[] = "You are a world-class {$role}. I need help with {$topic}. Please use {$fw} methodology. Format: 1) Context 2) Analysis 3) Recommendations 4) Action Items.";
            elseif ($v===3) $results[] = "I want you to become my {$role} for {$topic}. Think {$fw}. Start by asking me 3 clarifying questions, then provide your expert {$style} guidance.";
            else $results[] = "[System: You are a {$role}] Task: {$topic}. Approach: {$fw}. Style: {$style}. Constraints: Be concise, use bullet points, include real-world examples.";
        }
        return $this->ok($results);
    }

    private function gen_gemini_prompt(Request $request) {
        $topic = $request->input('topic', 'analyze data');
        $cap = $request->input('capability', 'text');
        $tone = $request->input('tone', 'precise');
        $capMap = ['text'=>'text generation','multimodal'=>'image and text analysis','code'=>'code generation and debugging','reasoning'=>'complex multi-step reasoning'];
        $capDesc = $capMap[$cap] ?? 'text generation';
        $results = [];
        for ($i = 0; $i < 8; $i++) {
            $v = rand(1,4);
            if ($v===1) $results[] = "Using your {$capDesc} capabilities, help me with: {$topic}. Be {$tone} and structured. Provide your response in clearly labeled sections with headers.";
            elseif ($v===2) $results[] = "Gemini, leverage your advanced {$capDesc} skills for this task: {$topic}. Think step by step. Tone: {$tone}. Include confidence levels for each recommendation.";
            elseif ($v===3) $results[] = "I need your {$capDesc} expertise. Task: {$topic}. Requirements: 1) {$tone} analysis 2) Cite sources when possible 3) Provide alternatives 4) Summarize key findings.";
            else $results[] = "Apply {$capDesc} to solve: {$topic}. Be {$tone}. Structure: Problem → Analysis → Solution → Implementation Steps → Expected Outcome.";
        }
        return $this->ok($results);
    }

    private function gen_drawing_prompt(Request $request) {
        $style = $request->input('style', 'any');
        $diff = $request->input('difficulty', 'intermediate');
        $subject = $request->input('subject', 'character');
        $adj = ['ethereal','ancient','cyberpunk','steampunk','surreal','dreamlike','haunted','luminous','crystalline','overgrown'];
        $settings = ['in a moonlit forest','on a floating island','in an underwater city','during a solar eclipse','in a abandoned temple','on a mountain peak','in a neon-lit alley'];
        $actions = ['holding a glowing orb','surrounded by butterflies','casting a spell','reading an ancient book','playing a mystical instrument','gazing at the stars'];
        $results = [];
        for ($i = 0; $i < 10; $i++) {
            $a = $this->pick($adj); $s = $this->pick($settings); $act = $this->pick($actions);
            $results[] = "Draw a {$a} {$subject} {$s}, {$act}. Style: {$style}. Difficulty: {$diff}.";
        }
        return $this->ok($results);
    }

    private function gen_essay_title(Request $request) {
        $topic = $request->input('topic', 'Technology');
        $type = $request->input('essayType', 'argumentative');
        $patterns = [
            "The Impact of {$topic} on Modern Society: A Critical Analysis",
            "Rethinking {$topic}: Challenges and Opportunities in the 21st Century",
            "Beyond the Surface: Understanding the True Nature of {$topic}",
            "Why {$topic} Matters More Than Ever: An In-Depth Exploration",
            "{$topic} and Its Discontents: A Fresh Perspective",
            "The Hidden Side of {$topic}: What Research Reveals",
            "From Theory to Practice: {$topic} in the Real World",
            "The Evolution of {$topic}: Past, Present, and Future",
            "Navigating {$topic}: A Comprehensive Guide for the Modern Era",
            "Deconstructing {$topic}: Myths, Facts, and New Directions",
            "The Paradox of {$topic}: When Progress Meets Tradition",
            "Reimagining {$topic}: Bold Ideas for a Changing World",
        ];
        shuffle($patterns);
        return $this->ok(array_slice($patterns, 0, 10));
    }

    private function gen_movie_title(Request $request) {
        $genre = $request->input('genre', 'thriller');
        $theme = $request->input('theme', '');
        $genreWords = [
            'horror'=>['Shadow','Whisper','Descent','Hollow','Crimson','Forgotten','Shattered','Echoes of'],
            'comedy'=>['Accidentally','Oops','The Misadventures of','How I','Totally','My Big Fat','Operation'],
            'scifi'=>['Nexus','Quantum','Beyond','Stellar','Void','Infinite','Cosmic','Protocol'],
            'drama'=>['Unspoken','Shattered','The Weight of','Between','Fragments of','Silent','The Last'],
            'thriller'=>['Deception','The Vanishing','Crossfire','Blind Side','Zero Hour','The Handler','Dark Signal'],
            'romance'=>['Serendipity','Written in','Falling for','The Space Between','Midnight in','Once More','Hearts'],
            'action'=>['Warpath','Renegade','Unleashed','Final Strike','Code Red','Breakpoint','Firestorm'],
        ];
        $nouns = ['Truth','Silence','Storm','Memory','Promise','Legacy','Dawn','Horizon','Redemption'];
        $words = $genreWords[$genre] ?? $genreWords['thriller'];
        $results = [];
        for ($i = 0; $i < 12; $i++) {
            $w = $this->pick($words); $n = $this->pick($nouns);
            $v = rand(1,3);
            if ($v===1) $results[] = "{$w} {$n}";
            elseif ($v===2) $results[] = "The {$n} of {$w}";
            else $results[] = "{$w}: {$n}" . ($theme ? " ({$theme})" : "");
        }
        return $this->ok($results);
    }

    private function gen_fantasy_title(Request $request) {
        $sub = $request->input('subgenre', 'high');
        $prefixes = ['The Chronicles of','The Last','Throne of','Kingdom of','Song of','Shadow of','Heir to the','The Fallen','Legacy of','Daughter of'];
        $nouns = ['Starfire','Dragonspire','Ashenvale','Nightborn','Thornwood','Ironforge','Stormhold','Moonshadow','Ravencrest','Dawnbringer'];
        $results = [];
        for ($i = 0; $i < 12; $i++) { $results[] = $this->pick($prefixes) . ' ' . $this->pick($nouns); }
        return $this->ok($results);
    }

    private function gen_ai_gift(Request $request) {
        $recipient = $request->input('recipient', 'friend');
        $occasion = $request->input('occasion', 'birthday');
        $budget = $request->input('budget', 'under50');
        $budgetMap = ['under25'=>'$10-$25','under50'=>'$25-$50','under100'=>'$50-$100','over100'=>'$100+'];
        $gifts = [
            'Personalized leather journal with initials','Smart LED desk lamp with wireless charger','Custom star map poster of a special date',
            'Gourmet cooking spice collection set','Noise-cancelling sleep earbuds','Handmade scented candle gift set',
            'Digital picture frame with cloud upload','Portable Bluetooth waterproof speaker','Subscription box (3 months)',
            'Custom engraved pen set','Indoor herb garden kit','Premium wireless charging pad',
            'Personalized photo book','Artisan coffee/tea sampler set','Weighted blanket for relaxation',
        ];
        shuffle($gifts);
        $results = [];
        $range = $budgetMap[$budget] ?? '$25-$50';
        foreach (array_slice($gifts, 0, 10) as $g) {
            $results[] = "🎁 {$g}\n💰 Budget: {$range}\n🎯 Perfect for: {$recipient}\n🎉 Occasion: {$occasion}";
        }
        return $this->ok($results);
    }

    private function gen_etsy_description(Request $request) {
        $name = $request->input('productName', 'Handmade Item');
        $cat = $request->input('category', 'jewelry');
        $kw = $request->input('keywords', 'unique, handmade');
        $results = [];
        $intros = ["Introducing our stunning {$name}","Discover the beauty of our {$name}","Meet your new favorite — {$name}","Elevate your style with {$name}"];
        $benefits = ["✨ Handcrafted with love and attention to detail","🎁 Makes the perfect gift for any occasion","📦 Ships in eco-friendly packaging","⭐ 5-star rated by hundreds of happy customers"];
        for ($i = 0; $i < 5; $i++) {
            $intro = $this->pick($intros);
            $b1 = $benefits[rand(0,1)]; $b2 = $benefits[rand(2,3)];
            $results[] = "{$intro}\n\n{$b1}\n{$b2}\n\n📝 Details:\n• Category: {$cat}\n• Keywords: {$kw}\n• Handmade with premium materials\n\n🏷️ Tags: #{$cat} #handmade #{$kw} #etsyfinds #shopsmall";
        }
        return $this->ok($results);
    }

    private function gen_property_description(Request $request) {
        $type = $request->input('propertyType', 'house');
        $beds = $request->input('bedrooms', '3');
        $features = $request->input('features', 'modern kitchen');
        $results = [];
        $openings = ["Welcome to this stunning {$beds}-bedroom {$type}","Discover luxury living in this beautiful {$beds}-bed {$type}","Don't miss this incredible {$beds}-bedroom {$type}"];
        for ($i = 0; $i < 5; $i++) {
            $o = $this->pick($openings);
            $results[] = "{$o} featuring {$features}.\n\n🏠 Property Highlights:\n• {$beds} spacious bedrooms\n• Modern finishes throughout\n• {$features}\n• Natural light-filled living spaces\n\n📍 Prime location with easy access to schools, shopping, and dining.\n\n📞 Schedule your private showing today!";
        }
        return $this->ok($results);
    }

    private function gen_book_summarizer(Request $request) {
        $title = $request->input('bookTitle', 'Unknown Book');
        $style = $request->input('summaryType', 'brief');
        $results = [];
        $results[] = "📖 Summary of \"{$title}\"\n\nThis book explores transformative ideas that challenge conventional thinking. The core message revolves around building sustainable habits, leveraging compound growth, and understanding the psychology behind human behavior.\n\n🔑 Key Takeaways:\n1. Small changes lead to remarkable results over time\n2. Systems are more important than goals\n3. Environment shapes behavior more than willpower\n4. Identity-based habits create lasting change\n\n⭐ Rating: Highly recommended for anyone seeking personal growth.";
        $results[] = "📚 \"{$title}\" — Quick Summary\n\nA compelling read that offers actionable insights into its core subject matter. The author presents research-backed strategies with real-world examples.\n\n💡 Main Ideas:\n• Focus on the process, not the outcome\n• Build feedback loops for continuous improvement\n• Leverage the power of incremental progress\n\n📊 Who should read this: Professionals, students, and lifelong learners.";
        return $this->ok($results);
    }

    private function gen_sales_pitch(Request $request) {
        $product = $request->input('product', 'our solution');
        $audience = $request->input('audience', 'business owners');
        $type = $request->input('pitchType', 'elevator');
        $results = [];
        $results[] = "🎯 Elevator Pitch:\n\n\"You know how {$audience} struggle with efficiency? {$product} solves that in minutes, not months. Our clients see 3x ROI within 90 days. Can I show you a 2-minute demo?\"";
        $results[] = "📧 Cold Email:\n\nSubject: {$audience} are switching to {$product} — here's why\n\nHi [Name],\n\nI noticed your company might benefit from {$product}. We've helped 500+ {$audience} reduce costs by 40%.\n\nWould you be open to a quick 15-min call this week?\n\nBest,\n[Your Name]";
        $results[] = "🎤 Presentation Opening:\n\n\"Let me ask you a question: What if I told you {$product} could save your team 10 hours per week? Today I'll show you exactly how {$audience} are achieving this — and how you can too.\"";
        return $this->ok($results);
    }

    private function gen_sales_script(Request $request) {
        $product = $request->input('product', 'our service');
        $type = $request->input('scriptType', 'coldcall');
        $scripts = [
            "📞 Cold Call Script:\n\n\"Hi [Name], this is [You] from [Company]. I'm reaching out because we help companies like yours with {$product}.\n\nI know you're busy, so I'll be brief — we've helped [similar company] achieve [specific result].\n\nWould you be open to a 10-minute conversation to see if we could do the same for you?\"\n\n🔄 If they say 'not interested':\n\"I completely understand. May I ask — what solution are you currently using for {$product}?\"",
            "📧 Follow-Up Script:\n\n\"Hi [Name], I wanted to follow up on my previous message about {$product}.\n\nSince we last spoke, we've released [new feature/result] that directly addresses [pain point].\n\nI'd love to schedule a quick demo at your convenience. Would [Tuesday/Thursday] work?\"\n\n✅ Key: Always provide value in follow-ups, never just 'checking in'.",
        ];
        return $this->ok($scripts);
    }

    private function gen_affirmations(Request $request) {
        $cat = $request->input('category', 'confidence');
        $count = (int)$request->input('count', 10);
        $affirmations = [
            'confidence'=>["I am worthy of success and happiness","I trust my abilities completely","I radiate confidence in everything I do","My potential is limitless","I am bold, brave, and brilliant","I deserve great things","Every challenge makes me stronger","I believe in myself unconditionally","I am capable of achieving anything","I embrace my uniqueness","My voice matters and deserves to be heard","I grow more confident every single day","I am proud of who I am becoming","Fear does not control me","I am enough, exactly as I am"],
            'wealth'=>["Money flows to me easily and abundantly","I am a magnet for financial prosperity","I deserve to be wealthy and successful","My income grows consistently every month","I make wise financial decisions","I am building generational wealth","Abundance is my natural state","I attract lucrative opportunities daily","I am financially free and independent","My wealth creates positive impact"],
            'health'=>["My body is healthy, strong, and full of energy","I nourish my body with wholesome choices","Every cell in my body vibrates with health","I am grateful for my strong, capable body","I choose health and wellness every day","My mind and body are in perfect harmony","I deserve rest and recovery","I am becoming healthier every single day","My immune system is powerful","I honor my body with love and care"],
            'love'=>["I am worthy of deep, unconditional love","Love flows freely in my life","I attract loving and supportive relationships","My heart is open to giving and receiving love","I am surrounded by people who care about me","I deserve a partner who respects and adores me","Love comes naturally to me","I radiate love and warmth","My relationships grow stronger each day","I am lovable exactly as I am"],
            'success'=>["I am destined for greatness","Success is my natural state of being","Every day I move closer to my goals","I turn obstacles into opportunities","I am a leader and innovator","My hard work always pays off","I attract success in all areas of life","I am focused, determined, and unstoppable","Greatness flows through everything I do","I create my own luck through action"],
            'selfcare'=>["I prioritize my wellbeing without guilt","I am deserving of rest and relaxation","Taking care of myself benefits everyone","I set healthy boundaries with love","I am gentle with myself on hard days","My peace of mind is non-negotiable","I choose joy and calm today","I release what no longer serves me","I am worthy of self-compassion","I honor my needs and feelings"],
        ];
        $list = $affirmations[$cat] ?? $affirmations['confidence'];
        shuffle($list);
        $selected = array_slice($list, 0, min($count, count($list)));
        $results = [];
        foreach ($selected as $idx => $a) { $results[] = "✨ " . ($idx + 1) . ". {$a}"; }
        return $this->ok($results);
    }

    private function gen_agreement(Request $request) {
        $type = $request->input('agreementType', 'freelance');
        $a = $request->input('partyA', '[Party A]');
        $b = $request->input('partyB', '[Party B]');
        $date = date('F j, Y');
        $templates = [
            'freelance'=>"📋 FREELANCE SERVICE AGREEMENT\n\nDate: {$date}\nBetween: {$a} (\"Client\") and {$b} (\"Freelancer\")\n\n1. SCOPE OF WORK\nThe Freelancer agrees to provide [describe services] as outlined in the attached project brief.\n\n2. COMPENSATION\nTotal Fee: $[amount] | Payment Terms: [50% upfront, 50% on completion]\n\n3. TIMELINE\nStart Date: [date] | Deadline: [date]\n\n4. INTELLECTUAL PROPERTY\nAll work product becomes the property of the Client upon full payment.\n\n5. CONFIDENTIALITY\nBoth parties agree to keep project details confidential.\n\n6. TERMINATION\nEither party may terminate with [14] days written notice.\n\nSignatures:\n{$a}: _________________ Date: _________\n{$b}: _________________ Date: _________",
            'nda'=>"📋 NON-DISCLOSURE AGREEMENT (NDA)\n\nDate: {$date}\nBetween: {$a} (\"Disclosing Party\") and {$b} (\"Receiving Party\")\n\n1. CONFIDENTIAL INFORMATION\nAll business, technical, and financial information shared between parties.\n\n2. OBLIGATIONS\nThe Receiving Party agrees to:\n• Keep all information strictly confidential\n• Not disclose to third parties without written consent\n• Use information only for its intended purpose\n\n3. DURATION\nThis agreement remains in effect for [2] years from the date of signing.\n\n4. EXCLUSIONS\nInformation that is publicly available or independently developed.\n\nSignatures:\n{$a}: _________________ Date: _________\n{$b}: _________________ Date: _________",
        ];
        $result = $templates[$type] ?? $templates['freelance'];
        return $this->ok([$result]);
    }

    private function gen_birthday_card(Request $request) {
        $name = $request->input('recipientName', 'Friend');
        $rel = $request->input('relation', 'friend');
        $tone = $request->input('tone', 'heartfelt');
        $messages = [
            'heartfelt'=>["Dear {$name},\n\nOn your special day, I want you to know how much you mean to me. Your kindness, warmth, and beautiful spirit make the world a better place. May this year bring you endless joy and all the dreams your heart desires.\n\nWith all my love ❤️","Happy Birthday, {$name}! 🎂\n\nEvery moment with you is a gift. You bring so much light into the lives of everyone around you. Here's to another year of beautiful memories together.\n\nCheers to you! 🥂"],
            'funny'=>["Happy Birthday, {$name}! 🎉\n\nThey say with age comes wisdom... so you must be practically a genius by now! 😂\n\nJust kidding — you don't look a day over fabulous! Have an amazing day! 🎂","Hey {$name}!\n\nAnother year older, another year of pretending we remember how old we are! 😄\n\nHappy Birthday! May your cake be big and your wrinkles be small! 🍰"],
            'formal'=>["Dear {$name},\n\nWishing you a very Happy Birthday. May this special occasion bring you success, happiness, and good health throughout the coming year.\n\nWarm regards","Dear {$name},\n\nPlease accept my warmest wishes on your birthday. Your contributions and presence are truly valued. Wishing you a wonderful year ahead.\n\nSincerely"],
            'inspiring'=>["Happy Birthday, {$name}! 🌟\n\nThis is your year. You have the power to achieve greatness, to chase your dreams, and to become the best version of yourself. Never stop believing in the magic within you.\n\nThe best is yet to come! 💪","Dear {$name},\n\nAnother year of incredible possibilities lies ahead. Remember: every great achievement started with someone who refused to give up. That someone is YOU.\n\nHappy Birthday! 🎂✨"],
        ];
        return $this->ok($messages[$tone] ?? $messages['heartfelt']);
    }

    private function gen_birthday_wish(Request $request) {
        $name = $request->input('recipientName', 'Friend');
        $style = $request->input('style', 'funny');
        $wishes = [
            'funny'=>["Happy Birthday {$name}! You're not old, you're vintage! 🍷😂","Age is just a number, {$name}. In your case, a really big number! 🎂😄","Happy Birthday! Remember, calories don't count today! 🍰🎉","Congrats {$name}! You've officially leveled up! 🎮🎂"],
            'romantic'=>["Happy Birthday to the one who makes my heart skip a beat. {$name}, you are my everything ❤️","To {$name}: You are the most beautiful chapter of my life. Happy Birthday, my love 🌹","Every day with you feels like a celebration, {$name}. Happy Birthday to my soulmate 💕"],
            'inspiring'=>["Happy Birthday {$name}! The future belongs to those who believe in the beauty of their dreams ✨","May this new year of your life be your best chapter yet, {$name}. Dream big! 🌟","Happy Birthday! {$name}, you were born to do extraordinary things. Never forget that 💫"],
            'short'=>["HBD {$name}! Make it epic! 🎉","Happy Birthday {$name}! 🎂❤️","Cheers to you, {$name}! 🥂","Wishing you the best, {$name}! 🌟"],
            'poetic'=>["Like stars that grace the midnight sky,\nYour light, dear {$name}, will never die.\nHappy Birthday to a soul so bright,\nMay your year be filled with pure delight ✨","Another year, another song,\n{$name}, to you these words belong:\nMay joy and peace forever stay,\nHappy, happy Birthday day 🎵"],
        ];
        return $this->ok($wishes[$style] ?? $wishes['funny']);
    }

    private function gen_book_description(Request $request) {
        $title = $request->input('bookTitle', 'Untitled');
        $genre = $request->input('genre', 'fantasy');
        $theme = $request->input('theme', 'adventure');
        $results = [];
        $results[] = "📖 {$title}\n\nIn a world where {$theme} defines destiny, one unlikely hero must rise above everything they've ever known.\n\n\"{$title}\" is a gripping {$genre} that weaves together {$theme}, impossible choices, and the unbreakable human spirit. From the very first page, readers will be transported into a richly crafted world that feels both fantastical and deeply real.\n\n⭐ \"A masterful work that redefines the {$genre} genre.\" — BookReview Weekly\n\n🔥 Available now in paperback and ebook.";
        $results[] = "📚 {$title} — A {$genre} masterpiece\n\nWhat if everything you believed was a lie?\n\n{$title} plunges readers into a breathtaking {$genre} story centered on {$theme}. With twists that will leave you gasping, characters you'll never forget, and prose that sings on every page.\n\nPerfect for fans of immersive {$genre} with heart and depth.\n\n📖 \"Unputdownable.\" — Readers' Choice Award";
        return $this->ok($results);
    }

    private function gen_ai_script(Request $request) {
        $topic = $request->input('topic', 'productivity tips');
        $format = $request->input('format', 'youtube');
        $dur = $request->input('duration', 'medium');
        $results = [];
        $results[] = "🎬 SCRIPT: {$topic} ({$format})\n\n[HOOK - 0:00]\n\"Did you know that 90% of people get {$topic} completely wrong? Today I'm going to show you exactly how to fix that.\"\n\n[INTRO - 0:15]\n\"What's up everyone! Welcome back. Today we're diving deep into {$topic}.\"\n\n[MAIN CONTENT]\nSection 1: The Problem\n• Most people struggle with {$topic} because...\n• The common mistakes include...\n\nSection 2: The Solution\n• Step 1: [Specific actionable step]\n• Step 2: [Specific actionable step]\n• Step 3: [Specific actionable step]\n\nSection 3: Real Examples\n• Case study / personal experience\n\n[CTA - End]\n\"If this helped you, smash that like button and subscribe! Drop your questions in the comments below.\"\n\n[END SCREEN]\nLink to related video + subscribe reminder";
        return $this->ok($results);
    }

    private function gen_airbnb_description(Request $request) {
        $type = $request->input('propertyType', 'apartment');
        $loc = $request->input('location', 'downtown');
        $amenities = $request->input('amenities', 'Wi-Fi, kitchen');
        $results = [];
        $results[] = "🏠 Welcome to Our Beautiful {$type} in {$loc}\n\nEscape to this stunning {$type} perfectly situated in {$loc}. Whether you're traveling for business or leisure, our space offers everything you need for a memorable stay.\n\n✨ The Space:\nOur thoughtfully designed {$type} features {$amenities}, along with premium bedding and modern amenities.\n\n📍 The Location:\nSteps from the best restaurants, shops, and attractions in {$loc}.\n\n🛎️ What Guests Love:\n⭐ Spotless cleanliness\n⭐ Self check-in\n⭐ Fast Wi-Fi\n⭐ Local recommendations guide\n\n📞 We're available 24/7 for anything you need!";
        return $this->ok($results);
    }

    private function gen_linkedin_ai(Request $request) {
        $type = $request->input('contentType', 'post');
        $topic = $request->input('topic', 'leadership');
        $tone = $request->input('tone', 'professional');
        $results = [];
        if ($type === 'post') {
            $results[] = "I used to think {$topic} was about [common misconception].\n\nAfter 10 years in the industry, here's what I've learned:\n\n1️⃣ [Insight one]\n2️⃣ [Insight two]\n3️⃣ [Insight three]\n\nThe truth? {$topic} is really about serving others.\n\n♻️ Repost if this resonates.\n💬 What's your take on {$topic}?\n\n#" . str_replace(' ', '', $topic) . " #Leadership #Growth";
            $results[] = "Stop scrolling. This will save you years of mistakes in {$topic}. 🧵\n\nHere's the framework I wish someone shared with me:\n\n→ Start with WHY (not what)\n→ Focus on 1 thing at a time\n→ Measure what matters\n→ Iterate ruthlessly\n→ Share your learnings\n\nThe best time to start was yesterday.\nThe second best time is NOW.\n\n#" . str_replace(' ', '', $topic) . " #Productivity #Mindset";
        } elseif ($type === 'headline') {
            $results[] = "{$topic} Expert | Helping professionals achieve [result] | Speaker & Consultant";
            $results[] = "Passionate about {$topic} | Building the future of [industry] | Open to collaborations";
            $results[] = "{$topic} Strategist → Turned [problem] into [solution] for 100+ clients";
        } else {
            $results[] = "With over [X] years of experience in {$topic}, I help organizations transform their approach to [specific area]. My mission is to bridge the gap between strategy and execution.\n\n💼 What I do:\n• [Service 1]\n• [Service 2]\n• [Service 3]\n\n📬 Let's connect: [email]";
        }
        return $this->ok($results);
    }

    private function gen_facebook_ai(Request $request) {
        $type = $request->input('contentType', 'post');
        $topic = $request->input('topic', 'our business');
        $audience = $request->input('audience', 'general');
        $results = [];
        if ($type === 'post') {
            $results[] = "🔥 Big news about {$topic}!\n\nWe've been working on something special and we can't wait to share it with you.\n\n👉 [Key announcement]\n\nDrop a ❤️ if you're excited!\n\n#" . str_replace(' ', '', $topic) . " #Exciting #StayTuned";
            $results[] = "Happy [day]! 🎉\n\nHere's a quick tip about {$topic} that could change your day:\n\n💡 [Tip]\n\nTag someone who needs to see this! 👇\n\n#TipOfTheDay #{$topic}";
        } elseif ($type === 'adcopy') {
            $results[] = "🎯 Tired of [pain point]?\n\n{$topic} is the solution you've been looking for.\n\n✅ [Benefit 1]\n✅ [Benefit 2]\n✅ [Benefit 3]\n\n🔗 Click to learn more → [link]\n\n⏰ Limited time offer!";
        } else {
            $results[] = "Welcome to {$topic}! 🎉\n\nWe're passionate about [what you do] and committed to [your mission].\n\n📍 [Location]\n📞 [Phone]\n🌐 [Website]\n\nFollow us for updates, tips, and exclusive offers!";
        }
        return $this->ok($results);
    }

    // ======================== NAME GENERATORS ========================

    private function gen_dnd_name(Request $request) {
        $race = $request->input('race', 'human');
        $gender = $request->input('gender', 'male');
        $names = [
            'human'=>['male'=>['Aldric','Beron','Caelum','Dorian','Edric','Fenwick','Gareth','Hadrian','Ivanus','Kieran'],'female'=>['Alania','Brenna','Celeste','Dahlia','Elena','Freya','Gwendolyn','Helena','Isolde','Katarina']],
            'elf'=>['male'=>['Aelindor','Caelithor','Elarian','Faenor','Galadir','Ithilion','Lirael','Naeloth','Sylvarion','Thalion'],'female'=>['Aelwen','Caladwen','Elowen','Faelara','Galadria','Ilythira','Liriana','Naelira','Sylvara','Thandria']],
            'dwarf'=>['male'=>['Balin','Durnok','Grimjaw','Thorin','Krazak','Moradin','Rurik','Stonehelm','Ulfgar','Vondrik'],'female'=>['Amber','Brunhild','Dagny','Greta','Helga','Katla','Marta','Sigrid','Thordis','Ulfhild']],
            'halfling'=>['male'=>['Bilwin','Corrin','Finnan','Garrett','Jasper','Merric','Osborn','Pip','Reed','Welby'],'female'=>['Bree','Cora','Dora','Elda','Jillian','Lidda','Marigold','Rosie','Seraphina','Verna']],
            'dragonborn'=>['male'=>['Arakthor','Bharakis','Drakon','Ghesh','Kriv','Mehen','Nadarr','Pandjed','Rhogar','Shedinn'],'female'=>['Akra','Biri','Daar','Farideh','Harann','Jheri','Kava','Mishann','Nala','Sora']],
            'tiefling'=>['male'=>['Akmenos','Baalzephon','Damakos','Ekemon','Iados','Kairon','Leucis','Mordai','Pelaios','Skamos'],'female'=>['Anakis','Bryseis','Criella','Davina','Ea','Kallista','Lerissa','Makaria','Nemeia','Orianna']],
            'orc'=>['male'=>['Brug','Dench','Grul','Henk','Krusk','Mhurren','Ront','Shump','Thokk','Urog'],'female'=>['Baggi','Emen','Engong','Kansif','Myev','Neega','Ovak','Ownka','Shautha','Vola']],
            'gnome'=>['male'=>['Alston','Boddynock','Dimble','Fonkin','Gerbo','Jebeddo','Namfoodle','Roondar','Seebo','Zook'],'female'=>['Bimpnottin','Caramip','Donella','Ellywick','Lini','Nissa','Oda','Roywyn','Shamil','Waywocket']],
        ];
        $g = ($gender === 'neutral') ? $this->pick(['male','female']) : $gender;
        $pool = $names[$race][$g] ?? $names['human']['male'];
        shuffle($pool);
        $surnames = ['Ironforge','Stormwind','Brightblade','Shadowmere','Thornwood','Ravencrest','Goldleaf','Frostborne','Fireheart','Duskwalker'];
        $results = [];
        foreach ($pool as $n) { $results[] = $n . ' ' . $this->pick($surnames); }
        return $this->ok($results);
    }

    private function gen_anime_name(Request $request) {
        $gender = $request->input('gender', 'male');
        $type = $request->input('type', 'hero');
        $male = [['Kaito','海斗','Ocean fighter'],['Riku','陸','Land/Earth'],['Haruki','春輝','Spring radiance'],['Takeshi','武','Warrior'],['Yuto','悠斗','Gentle fighter'],['Ren','蓮','Lotus'],['Akira','明','Bright/Clear'],['Sora','空','Sky'],['Hiro','大翔','Great flight'],['Daiki','大輝','Great radiance']];
        $female = [['Sakura','桜','Cherry blossom'],['Hana','花','Flower'],['Yuki','雪','Snow'],['Aoi','葵','Hollyhock/Blue'],['Mei','芽衣','Budding beauty'],['Rin','凛','Dignified'],['Nao','直','Honest'],['Miku','美空','Beautiful sky'],['Kaori','香','Fragrance'],['Akemi','明美','Bright beauty']];
        $pool = ($gender === 'female') ? $female : $male;
        shuffle($pool);
        $results = [];
        foreach ($pool as $n) { $results[] = "🎌 {$n[0]} ({$n[1]}) — \"{$n[2]}\""; }
        return $this->ok($results);
    }

    private function gen_fantasy_business_name(Request $request) {
        $type = $request->input('businessType', 'tavern');
        $vibe = $request->input('vibe', 'mystical');
        $prefixes = ['The Enchanted','The Silver','The Golden','The Mystic','The Ancient','The Wandering','The Crimson','The Twilight','The Crystal','The Iron'];
        $tavern = ['Dragon','Griffin','Phoenix','Raven','Unicorn','Chimera','Kraken','Sphinx','Basilisk','Pegasus'];
        $suffixes = ['\'s Rest','\'s Den','Forge','Haven','Sanctum','Hollow','Keep','Emporium','Archive','Refuge'];
        $results = [];
        for ($i = 0; $i < 12; $i++) { $results[] = $this->pick($prefixes) . ' ' . $this->pick($tavern) . $this->pick($suffixes); }
        return $this->ok($results);
    }

    private function gen_team_name(Request $request) {
        $cat = $request->input('category', 'sports');
        $vibe = $request->input('vibe', 'powerful');
        $adj = ['Mighty','Thunder','Shadow','Crimson','Iron','Quantum','Apex','Savage','Elite','Phantom'];
        $nouns = ['Wolves','Hawks','Titans','Knights','Legends','Warriors','Raptors','Vipers','Storm','Blaze'];
        $results = [];
        for ($i = 0; $i < 12; $i++) { $results[] = $this->pick($adj) . ' ' . $this->pick($nouns); }
        return $this->ok($results);
    }

    private function gen_kingdom_name(Request $request) {
        $theme = $request->input('theme', 'medieval');
        $pre = ['Val','Eld','Aer','Thal','Mor','Gor','Syl','Dra','Kor','Nar','Ath','Bel','Zan','Fal','Lor'];
        $mid = ['an','or','en','ar','in','on','ir','al','un','el'];
        $suf = ['dor','heim','gard','thas','mere','vale','rath','spire','hold','fell','mark','crest','dale','shire','keep'];
        $titles = ['Kingdom of','Realm of','Empire of','Dominion of','Sovereignty of','Principality of','The Lands of'];
        $results = [];
        for ($i = 0; $i < 12; $i++) {
            $name = $this->pick($pre) . $this->pick($mid) . $this->pick($suf);
            $results[] = $this->pick($titles) . ' ' . ucfirst($name);
        }
        return $this->ok($results);
    }

    private function gen_female_elf_name(Request $request) {
        $type = $request->input('elfType', 'high');
        $firsts = ['Aelindra','Caelthia','Elowyn','Faelora','Galadwen','Ilythira','Liriana','Naelwen','Seraphiel','Thandria','Vaelora','Ylindra','Araviel','Celindra','Daelowen'];
        $lasts = ['Moonwhisper','Starweaver','Dawnleaf','Silverbrook','Nightbloom','Sunshadow','Windwalker','Mistweaver','Brightstone','Thornrose'];
        $meanings = ['Grace of the moon','Starborn wanderer','Child of twilight','Dawn\'s radiance','Song of the wind','Silver spirit','Forest guardian','Dreamweaver','Crystal heart','Eternal bloom'];
        shuffle($firsts);
        $results = [];
        for ($i = 0; $i < min(10, count($firsts)); $i++) {
            $results[] = "🧝‍♀️ {$firsts[$i]} {$this->pick($lasts)} — \"{$this->pick($meanings)}\"";
        }
        return $this->ok($results);
    }

    private function gen_female_dragon_name(Request $request) {
        $type = $request->input('dragonType', 'fire');
        $names = ['Pyrathia','Valkyraeth','Syraxis','Emberlith','Drakaina','Ignathra','Solvrynn','Aethyra','Khaelixis','Nyxariel','Tiamathra','Zephyriel','Celestrix','Mordraxa','Vexylith'];
        $titles = ['the Eternal Flame','the Frost Mother','the Sky Sovereign','the Shadow Queen','the Ancient One','the Storm Caller','the Celestial','the World Ender','the Dream Walker','the Void Keeper'];
        shuffle($names);
        $results = [];
        for ($i = 0; $i < min(10, count($names)); $i++) {
            $results[] = "🐉 {$names[$i]}, {$this->pick($titles)}";
        }
        return $this->ok($results);
    }

    private function gen_band_name(Request $request) {
        $genre = $request->input('genre', 'rock');
        $vibe = $request->input('vibe', 'dark');
        $adj = ['Electric','Velvet','Neon','Midnight','Cosmic','Broken','Silent','Atomic','Crystal','Savage'];
        $nouns = ['Wolves','Echoes','Sirens','Paradox','Revolt','Horizon','Ghosts','Orchid','Abyss','Zenith'];
        $the = ['The','','The',''];
        $results = [];
        for ($i = 0; $i < 12; $i++) {
            $t = $this->pick($the);
            $results[] = trim("{$t} {$this->pick($adj)} {$this->pick($nouns)}");
        }
        return $this->ok($results);
    }

    private function gen_real_estate_name(Request $request) {
        $style = $request->input('style', 'modern');
        $loc = $request->input('location', '');
        $pre = ['Premier','Apex','Summit','Horizon','Pinnacle','Heritage','Keystone','Landmark','Prestige','Crown'];
        $suf = ['Realty','Properties','Group','Real Estate','Homes','Estates','Partners','Living','Advisors','Brokers'];
        $results = [];
        for ($i = 0; $i < 12; $i++) {
            $name = $this->pick($pre) . ' ' . ($loc && rand(0,1) ? $loc . ' ' : '') . $this->pick($suf);
            $results[] = $name;
        }
        return $this->ok($results);
    }

    private function gen_etsy_shop_name(Request $request) {
        $niche = $request->input('niche', 'jewelry');
        $vibe = $request->input('vibe', 'cute');
        $pre = ['Little','Golden','Honey','Willow','Luna','Poppy','Rosie','Olive','Pearl','Daisy'];
        $suf = ['Studio','Craft','Lane','Hive','Bloom','Haven','Nest','Shop','Co','Atelier'];
        $results = [];
        for ($i = 0; $i < 12; $i++) { $results[] = $this->pick($pre) . $this->pick($suf); }
        return $this->ok($results);
    }

    private function gen_bakery_name(Request $request) {
        $pre = ['Sweet','Golden','Sugar','Honey','Butter','Vanilla','Cinnamon','Caramel','Flour','Crumbs'];
        $suf = ['& Co','Bakehouse','Kitchen','Cakery','Patisserie','Bake Shop','Confections','Delights','Treats','Oven'];
        $results = [];
        for ($i = 0; $i < 12; $i++) { $results[] = $this->pick($pre) . ' ' . $this->pick($suf); }
        return $this->ok($results);
    }

    private function gen_art_business_name(Request $request) {
        $pre = ['Prism','Canvas','Palette','Mosaic','Atelier','Pigment','Vision','Spectrum','Artisan','Lumière'];
        $suf = ['Studio','Gallery','Collective','Works','Creative','Design Co','Art House','Workshop','Lab','Space'];
        $results = [];
        for ($i = 0; $i < 12; $i++) { $results[] = $this->pick($pre) . ' ' . $this->pick($suf); }
        return $this->ok($results);
    }

    private function gen_anime_girl_name(Request $request) {
        $personality = $request->input('personality', 'sweet');
        $names = [['Hinata','日向','Sunny place','Sweet & gentle'],['Mikasa','美笠','Beautiful umbrella','Strong warrior'],['Sakura','桜','Cherry blossom','Hopeful'],['Rei','零','Zero/Spirit','Mysterious'],['Asuka','明日香','Fragrance of tomorrow','Fierce'],['Yuki','雪','Snow','Elegant'],['Nami','波','Wave','Adventurous'],['Chihiro','千尋','Thousand questions','Curious'],['Maki','真姫','True princess','Determined'],['Tohru','透','Transparent','Kind-hearted']];
        shuffle($names);
        $results = [];
        foreach ($names as $n) { $results[] = "💖 {$n[0]} ({$n[1]}) — \"{$n[2]}\" | Trait: {$n[3]}"; }
        return $this->ok($results);
    }

    private function gen_acnh_island_name(Request $request) {
        $theme = $request->input('theme', 'cottagecore');
        $names = [
            'cottagecore'=>['Willowdale','Honeydew','Rosemary','Cloverfield','Buttercup','Daisymeadow','Lavender','Thyme Isle','Marigold','Bramblewood'],
            'tropical'=>['Coralcove','Sunhaven','Palmshore','Seabreeze','Tidalpool','Coconut Bay','Shellsand','Tropicana','Wavecrest','Mango Isle'],
            'spooky'=>['Shadowfen','Grimhollow','Ravensmoor','Fogmere','Moonveil','Duskwood','Nightshade','Phantom Isle','Gloomhaven','Cryptwood'],
            'cute'=>['Starfall','Dreamdale','Peachbay','Sugarplum','Twinkleton','Bubblegum','Cupcake Bay','Sparkle Cove','Marshmallow','Jellybean'],
            'nature'=>['Ferngrove','Mosswood','Oakvale','Pinecrest','Birchhollow','Cedarpoint','Willowbrook','Riverglen','Meadowrise','Foxden'],
            'celestial'=>['Starlight','Lunafall','Solaris','Nebula Bay','Cosmicshore','Eclipse Cove','Auroraville','Galaxia','Constellation','Celestia'],
            'food'=>['Cinnamon Bay','Pancake Isle','Waffletown','Donut Cove','Biscuit Bay','Ramen Isle','Sushi Shore','Mochi Bay','Croissantville','Pretzel Point'],
        ];
        $pool = $names[$theme] ?? $names['cottagecore'];
        shuffle($pool);
        $results = [];
        foreach ($pool as $n) { $results[] = "🏝️ {$n}"; }
        return $this->ok($results);
    }

    private function gen_japanese_name(Request $request) {
        $gender = $request->input('gender', 'male');
        $era = $request->input('era', 'modern');
        $male = [['Haruto','陽翔','Sun soaring'],['Yuto','悠人','Gentle person'],['Sota','颯太','Fresh & strong'],['Hinata','陽太','Sunlight'],['Riku','陸','Land'],['Minato','湊','Harbor'],['Aoto','碧斗','Blue sky fighter'],['Itsuki','樹','Tree/Living'],['Kaito','海斗','Ocean fighter'],['Asahi','朝陽','Morning sun']];
        $female = [['Himari','陽葵','Sunflower'],['Hina','陽菜','Sun vegetable'],['Yua','結愛','Bond of love'],['Sakura','桜','Cherry blossom'],['Ichika','一花','First flower'],['Akari','明里','Light village'],['Mei','芽依','Sprout rely'],['Koharu','心春','Heart spring'],['Yuzuki','柚月','Citrus moon'],['Rio','莉央','Jasmine center']];
        $surnames = [['Tanaka','田中','Rice field center'],['Suzuki','鈴木','Bell tree'],['Yamamoto','山本','Mountain base'],['Watanabe','渡辺','Crossing edge'],['Sato','佐藤','Wisteria aide'],['Takahashi','高橋','High bridge'],['Kobayashi','小林','Small forest'],['Nakamura','中村','Middle village']];
        $pool = ($gender === 'female') ? $female : $male;
        shuffle($pool); shuffle($surnames);
        $results = [];
        for ($i = 0; $i < min(8, count($pool)); $i++) {
            $s = $surnames[$i % count($surnames)];
            $results[] = "🇯🇵 {$s[0]} {$pool[$i][0]} ({$s[1]} {$pool[$i][1]}) — \"{$s[2]} · {$pool[$i][2]}\"";
        }
        return $this->ok($results);
    }

    private function gen_planet_name(Request $request) {
        $type = $request->input('planetType', 'terrestrial');
        $pre = ['Xel','Kor','Zan','Vex','Thal','Nyx','Aer','Pyr','Cryo','Sol','Lum','Dra','Ori','Neb','Zar'];
        $suf = ['ion','ax','is','us','ra','ven','thos','mir','daan','rex','lia','por','ux','zar','vek'];
        $descs = ['A world of endless storms','Twin-sun paradise','Methane oceans stretch for thousands of miles','Ancient ruins cover the surface','Bioluminescent forests glow at night','Zero-gravity floating mountains','Crystalline deserts reflect starlight'];
        $results = [];
        for ($i = 0; $i < 10; $i++) {
            $name = strtoupper($this->pick($pre)) . $this->pick($suf) . '-' . rand(1,9);
            $results[] = "🪐 {$name}\nType: " . ucfirst($type) . "\n{$this->pick($descs)}";
        }
        return $this->ok($results);
    }
}
