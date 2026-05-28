<?php
/**
 * Generate all missing Blade views for AI Content and Name Generator tools.
 * Run: php scripts/generate_ai_name_views.php
 */

$viewsDir = __DIR__ . '/../resources/views/tools/interactive/';

// Common template that matches the existing site pattern
function generateView($slug, $title, $icon, $iconColor, $gradientFrom, $gradientTo, $fields, $routeType, $placeholderText) {
    $fieldsHtml = '';
    $jsFields = '';
    $jsBody = '';
    $colSize = intval(12 / (count($fields) + 1)); // +1 for button
    if ($colSize < 2) $colSize = 2;
    $btnCol = 12 - ($colSize * count($fields));
    if ($btnCol < 2) $btnCol = 3;
    $fieldCol = intval((12 - $btnCol) / count($fields));

    foreach ($fields as $f) {
        $id = $f['id'];
        $label = $f['label'];
        $type = $f['type'] ?? 'text';
        
        if ($type === 'select') {
            $opts = '';
            foreach ($f['options'] as $val => $text) {
                $opts .= "<option value=\"{$val}\">{$text}</option>\n                    ";
            }
            $fieldsHtml .= <<<HTML
            <div class="col-md-{$fieldCol}">
                <label class="form-label fw-bold small text-uppercase text-muted">{$label}</label>
                <select id="{$id}" class="form-select border-2">
                    {$opts}</select>
            </div>
HTML;
        } else {
            $ph = $f['placeholder'] ?? '';
            $fieldsHtml .= <<<HTML
            <div class="col-md-{$fieldCol}">
                <label class="form-label fw-bold small text-uppercase text-muted">{$label}</label>
                <input type="text" id="{$id}" class="form-control border-2" placeholder="{$ph}">
            </div>
HTML;
        }
        $jsFields .= "{$id}=document.getElementById('{$id}'),";
        $jsBody .= "{$id}:{$id}.value,";
    }

    $jsFields = rtrim($jsFields, ',');
    $jsBody = rtrim($jsBody, ',');

    $view = <<<BLADE
<div class="tool-interactive-container">
    <div class="card border-0 shadow-sm p-4 mb-4 bg-white rounded-4">
        <div class="row g-3 align-items-end mb-4">
{$fieldsHtml}
            <div class="col-md-{$btnCol}">
                <button id="gen-btn" class="btn btn-accent px-4 py-2 w-100 fw-bold rounded-3">
                    <i class="{$icon} me-2"></i> Generate
                </button>
            </div>
        </div>
        <div id="gen-results" class="d-none">
            <h5 class="fw-bold mb-3"><i class="{$icon} me-2 {$iconColor}"></i>{$title}</h5>
            <div id="gen-list" class="list-group gap-2"></div>
        </div>
        <div id="gen-placeholder" class="text-center py-5">
            <div class="opacity-25 mb-3"><i class="{$icon} fa-4x"></i></div>
            <h5 class="text-muted">{$placeholderText}</h5>
        </div>
    </div>
</div>
<style>
.btn-accent{background:linear-gradient(135deg,{$gradientFrom},{$gradientTo});color:#fff;border:none;transition:.3s}
.btn-accent:hover{transform:translateY(-1px);opacity:.9;color:#fff}
.list-group-item-action{border-radius:12px!important;border:2px solid #f8f9fa!important;transition:.2s;cursor:pointer}
.list-group-item-action:hover{border-color:{$gradientFrom}!important;background:#fafafa}
.copy-icon{opacity:0;transition:.2s}
.list-group-item-action:hover .copy-icon{opacity:1}
</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
const btn=document.getElementById('gen-btn'),{$jsFields},results=document.getElementById('gen-results'),list=document.getElementById('gen-list'),ph=document.getElementById('gen-placeholder');
btn.addEventListener('click',function(){
    btn.disabled=true;btn.innerHTML='<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
    fetch('{{ route("ai.generate",["type"=>"{$routeType}"]) }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},body:JSON.stringify({{$jsBody}})})
    .then(r=>r.json()).then(data=>{
        if(data.success){ph.classList.add('d-none');results.classList.remove('d-none');list.innerHTML='';
        data.results.forEach(item=>{const d=document.createElement('div');d.className='list-group-item list-group-item-action p-3 mb-2';
        d.innerHTML='<div class="d-flex justify-content-between align-items-start"><pre class="mb-0 flex-grow-1" style="white-space:pre-wrap;font-family:inherit">'+item+'</pre><i class="fas fa-copy text-primary copy-icon ms-3 mt-1"></i></div>';
        d.addEventListener('click',function(){navigator.clipboard.writeText(item).then(function(){const o=d.innerHTML;d.innerHTML='<span class="text-success fw-bold"><i class="fas fa-check me-2"></i>Copied!</span>';setTimeout(function(){d.innerHTML=o;},2e3);});});
        list.appendChild(d);});}
    }).finally(function(){btn.disabled=false;btn.innerHTML='<i class="{$icon} me-2"></i>Generate';});
});
});
</script>
BLADE;

    return $view;
}

// ===================== AI CONTENT GENERATORS =====================

$tools = [
    'essay-title-generator' => [
        'title' => 'Generated Essay Titles',
        'icon' => 'fas fa-heading',
        'iconColor' => 'text-primary',
        'gradientFrom' => '#667eea', 'gradientTo' => '#764ba2',
        'routeType' => 'essay-title',
        'placeholderText' => 'Enter your essay subject to generate titles',
        'fields' => [
            ['id' => 'topic', 'type' => 'text', 'label' => 'Essay Subject', 'placeholder' => 'e.g. Climate Change Impact'],
            ['id' => 'essayType', 'type' => 'select', 'label' => 'Essay Type', 'options' => ['argumentative'=>'Argumentative','analytical'=>'Analytical','narrative'=>'Narrative','expository'=>'Expository','research'=>'Research Paper']],
        ],
    ],
    'movie-title-generator' => [
        'title' => 'Generated Movie Titles',
        'icon' => 'fas fa-film',
        'iconColor' => 'text-danger',
        'gradientFrom' => '#f5576c', 'gradientTo' => '#ff5858',
        'routeType' => 'movie-title',
        'placeholderText' => 'Choose a genre to generate movie titles',
        'fields' => [
            ['id' => 'genre', 'type' => 'select', 'label' => 'Genre', 'options' => ['horror'=>'Horror','comedy'=>'Comedy','scifi'=>'Sci-Fi','drama'=>'Drama','thriller'=>'Thriller','romance'=>'Romance','action'=>'Action']],
            ['id' => 'theme', 'type' => 'text', 'label' => 'Theme/Keywords', 'placeholder' => 'e.g. time travel, robots'],
        ],
    ],
    'fantasy-title-generator' => [
        'title' => 'Generated Fantasy Titles',
        'icon' => 'fas fa-hat-wizard',
        'iconColor' => 'text-purple',
        'gradientFrom' => '#a18cd1', 'gradientTo' => '#fbc2eb',
        'routeType' => 'fantasy-title',
        'placeholderText' => 'Choose a subgenre to generate fantasy titles',
        'fields' => [
            ['id' => 'subgenre', 'type' => 'select', 'label' => 'Subgenre', 'options' => ['high'=>'High Fantasy','dark'=>'Dark Fantasy','urban'=>'Urban Fantasy','epic'=>'Epic Fantasy','sword'=>'Sword & Sorcery']],
            ['id' => 'theme', 'type' => 'text', 'label' => 'Theme/Element', 'placeholder' => 'e.g. dragons, ancient prophecy'],
        ],
    ],
    'ai-gift-generator' => [
        'title' => 'Gift Ideas',
        'icon' => 'fas fa-gift',
        'iconColor' => 'text-success',
        'gradientFrom' => '#11998e', 'gradientTo' => '#38ef7d',
        'routeType' => 'ai-gift',
        'placeholderText' => 'Describe the recipient to get gift ideas',
        'fields' => [
            ['id' => 'recipient', 'type' => 'text', 'label' => 'Recipient', 'placeholder' => 'e.g. 30-year-old tech enthusiast'],
            ['id' => 'occasion', 'type' => 'select', 'label' => 'Occasion', 'options' => ['birthday'=>'Birthday','wedding'=>'Wedding','christmas'=>'Christmas','valentines'=>'Valentine\'s Day','graduation'=>'Graduation','housewarming'=>'Housewarming']],
            ['id' => 'budget', 'type' => 'select', 'label' => 'Budget', 'options' => ['under25'=>'Under $25','under50'=>'Under $50','under100'=>'Under $100','over100'=>'$100+']],
        ],
    ],
    'etsy-description-generator' => [
        'title' => 'Generated Descriptions',
        'icon' => 'fab fa-etsy',
        'iconColor' => 'text-warning',
        'gradientFrom' => '#f5af19', 'gradientTo' => '#f12711',
        'routeType' => 'etsy-description',
        'placeholderText' => 'Enter your product details to generate SEO descriptions',
        'fields' => [
            ['id' => 'productName', 'type' => 'text', 'label' => 'Product Name', 'placeholder' => 'e.g. Handmade Silver Ring'],
            ['id' => 'category', 'type' => 'select', 'label' => 'Category', 'options' => ['jewelry'=>'Jewelry','clothing'=>'Clothing','home'=>'Home Decor','art'=>'Art & Prints','digital'=>'Digital Products','craft'=>'Craft Supplies']],
            ['id' => 'keywords', 'type' => 'text', 'label' => 'Keywords', 'placeholder' => 'e.g. minimalist, boho, gift'],
        ],
    ],
    'property-description-generator' => [
        'title' => 'Generated Descriptions',
        'icon' => 'fas fa-building',
        'iconColor' => 'text-info',
        'gradientFrom' => '#0575E6', 'gradientTo' => '#021B79',
        'routeType' => 'property-description',
        'placeholderText' => 'Enter property details to generate listing copy',
        'fields' => [
            ['id' => 'propertyType', 'type' => 'select', 'label' => 'Property Type', 'options' => ['house'=>'House','apartment'=>'Apartment','condo'=>'Condo','townhouse'=>'Townhouse','commercial'=>'Commercial']],
            ['id' => 'bedrooms', 'type' => 'select', 'label' => 'Bedrooms', 'options' => ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5+']],
            ['id' => 'features', 'type' => 'text', 'label' => 'Key Features', 'placeholder' => 'e.g. pool, mountain view, new kitchen'],
        ],
    ],
    'book-summarizer' => [
        'title' => 'Book Summary',
        'icon' => 'fas fa-book-open',
        'iconColor' => 'text-primary',
        'gradientFrom' => '#4facfe', 'gradientTo' => '#00f2fe',
        'routeType' => 'book-summarizer',
        'placeholderText' => 'Enter a book title to get a summary',
        'fields' => [
            ['id' => 'bookTitle', 'type' => 'text', 'label' => 'Book Title', 'placeholder' => 'e.g. Atomic Habits'],
            ['id' => 'summaryType', 'type' => 'select', 'label' => 'Summary Style', 'options' => ['brief'=>'Brief (3-5 sentences)','detailed'=>'Detailed','keypoints'=>'Key Takeaways','chapter'=>'Chapter-by-Chapter']],
        ],
    ],
    'sales-pitch-generator' => [
        'title' => 'Generated Pitches',
        'icon' => 'fas fa-bullhorn',
        'iconColor' => 'text-danger',
        'gradientFrom' => '#eb3349', 'gradientTo' => '#f45c43',
        'routeType' => 'sales-pitch',
        'placeholderText' => 'Describe your product to generate sales pitches',
        'fields' => [
            ['id' => 'product', 'type' => 'text', 'label' => 'Product/Service', 'placeholder' => 'e.g. AI-powered CRM software'],
            ['id' => 'audience', 'type' => 'text', 'label' => 'Target Audience', 'placeholder' => 'e.g. Small business owners'],
            ['id' => 'pitchType', 'type' => 'select', 'label' => 'Pitch Type', 'options' => ['elevator'=>'Elevator Pitch','email'=>'Cold Email','presentation'=>'Presentation Opening']],
        ],
    ],
    'sales-script-generator' => [
        'title' => 'Generated Scripts',
        'icon' => 'fas fa-phone-volume',
        'iconColor' => 'text-success',
        'gradientFrom' => '#56ab2f', 'gradientTo' => '#a8e063',
        'routeType' => 'sales-script',
        'placeholderText' => 'Describe your product to generate sales scripts',
        'fields' => [
            ['id' => 'product', 'type' => 'text', 'label' => 'Product/Service', 'placeholder' => 'e.g. Cloud hosting plans'],
            ['id' => 'scriptType', 'type' => 'select', 'label' => 'Script Type', 'options' => ['coldcall'=>'Cold Call','followup'=>'Follow-Up','objection'=>'Objection Handling','closing'=>'Closing Script']],
        ],
    ],
    'affirmations-generator' => [
        'title' => 'Your Affirmations',
        'icon' => 'fas fa-sun',
        'iconColor' => 'text-warning',
        'gradientFrom' => '#f7971e', 'gradientTo' => '#ffd200',
        'routeType' => 'affirmations',
        'placeholderText' => 'Choose a category to generate affirmations',
        'fields' => [
            ['id' => 'category', 'type' => 'select', 'label' => 'Category', 'options' => ['confidence'=>'Confidence','wealth'=>'Wealth & Abundance','health'=>'Health & Wellness','love'=>'Love & Relationships','success'=>'Success & Career','selfcare'=>'Self-Love & Care']],
            ['id' => 'count', 'type' => 'select', 'label' => 'Count', 'options' => ['10'=>'10 Affirmations','15'=>'15 Affirmations','20'=>'20 Affirmations']],
        ],
    ],
    'agreement-generator' => [
        'title' => 'Generated Agreement',
        'icon' => 'fas fa-file-contract',
        'iconColor' => 'text-dark',
        'gradientFrom' => '#2c3e50', 'gradientTo' => '#3498db',
        'routeType' => 'agreement',
        'placeholderText' => 'Select agreement type to generate a template',
        'fields' => [
            ['id' => 'agreementType', 'type' => 'select', 'label' => 'Agreement Type', 'options' => ['freelance'=>'Freelance Contract','nda'=>'Non-Disclosure (NDA)','rental'=>'Rental Agreement','service'=>'Service Agreement','partnership'=>'Partnership']],
            ['id' => 'partyA', 'type' => 'text', 'label' => 'Party A Name', 'placeholder' => 'e.g. John Smith'],
            ['id' => 'partyB', 'type' => 'text', 'label' => 'Party B Name', 'placeholder' => 'e.g. Acme Corp'],
        ],
    ],
    'birthday-card-writer' => [
        'title' => 'Birthday Card Messages',
        'icon' => 'fas fa-envelope-open-text',
        'iconColor' => 'text-danger',
        'gradientFrom' => '#f093fb', 'gradientTo' => '#f5576c',
        'routeType' => 'birthday-card',
        'placeholderText' => 'Describe the recipient to write birthday card messages',
        'fields' => [
            ['id' => 'recipientName', 'type' => 'text', 'label' => 'Recipient Name', 'placeholder' => 'e.g. Sarah'],
            ['id' => 'relation', 'type' => 'select', 'label' => 'Relationship', 'options' => ['friend'=>'Friend','parent'=>'Parent','partner'=>'Partner','sibling'=>'Sibling','colleague'=>'Colleague','child'=>'Child']],
            ['id' => 'tone', 'type' => 'select', 'label' => 'Tone', 'options' => ['heartfelt'=>'Heartfelt','funny'=>'Funny','formal'=>'Formal','inspiring'=>'Inspiring']],
        ],
    ],
    'birthday-wish-generator' => [
        'title' => 'Birthday Wishes',
        'icon' => 'fas fa-birthday-cake',
        'iconColor' => 'text-warning',
        'gradientFrom' => '#fc4a1a', 'gradientTo' => '#f7b733',
        'routeType' => 'birthday-wish',
        'placeholderText' => 'Choose a style to generate birthday wishes',
        'fields' => [
            ['id' => 'recipientName', 'type' => 'text', 'label' => 'Name', 'placeholder' => 'e.g. Mike'],
            ['id' => 'style', 'type' => 'select', 'label' => 'Style', 'options' => ['funny'=>'Funny','romantic'=>'Romantic','inspiring'=>'Inspiring','short'=>'Short & Sweet','poetic'=>'Poetic']],
        ],
    ],
    'book-description-generator' => [
        'title' => 'Generated Descriptions',
        'icon' => 'fas fa-book',
        'iconColor' => 'text-info',
        'gradientFrom' => '#6a11cb', 'gradientTo' => '#2575fc',
        'routeType' => 'book-description',
        'placeholderText' => 'Enter book details to generate a description',
        'fields' => [
            ['id' => 'bookTitle', 'type' => 'text', 'label' => 'Book Title', 'placeholder' => 'e.g. The Last Shadow'],
            ['id' => 'genre', 'type' => 'select', 'label' => 'Genre', 'options' => ['fantasy'=>'Fantasy','romance'=>'Romance','thriller'=>'Thriller','scifi'=>'Sci-Fi','mystery'=>'Mystery','nonfiction'=>'Non-Fiction','selfhelp'=>'Self-Help']],
            ['id' => 'theme', 'type' => 'text', 'label' => 'Main Theme', 'placeholder' => 'e.g. redemption, coming of age'],
        ],
    ],
    'ai-script-generator' => [
        'title' => 'Generated Script',
        'icon' => 'fas fa-scroll',
        'iconColor' => 'text-primary',
        'gradientFrom' => '#667eea', 'gradientTo' => '#764ba2',
        'routeType' => 'ai-script',
        'placeholderText' => 'Enter your topic to generate a script',
        'fields' => [
            ['id' => 'topic', 'type' => 'text', 'label' => 'Topic', 'placeholder' => 'e.g. 5 productivity tips'],
            ['id' => 'format', 'type' => 'select', 'label' => 'Format', 'options' => ['youtube'=>'YouTube Video','podcast'=>'Podcast Episode','tiktok'=>'TikTok/Short','webinar'=>'Webinar','presentation'=>'Presentation']],
            ['id' => 'duration', 'type' => 'select', 'label' => 'Duration', 'options' => ['short'=>'1-3 min','medium'=>'5-10 min','long'=>'15-30 min']],
        ],
    ],
    'airbnb-description-generator' => [
        'title' => 'Generated Listing',
        'icon' => 'fas fa-bed',
        'iconColor' => 'text-danger',
        'gradientFrom' => '#ff5a5f', 'gradientTo' => '#fc642d',
        'routeType' => 'airbnb-description',
        'placeholderText' => 'Enter property details for Airbnb listing copy',
        'fields' => [
            ['id' => 'propertyType', 'type' => 'select', 'label' => 'Property Type', 'options' => ['apartment'=>'Apartment','house'=>'House','cabin'=>'Cabin','villa'=>'Villa','studio'=>'Studio','loft'=>'Loft']],
            ['id' => 'location', 'type' => 'text', 'label' => 'Location', 'placeholder' => 'e.g. Downtown Miami'],
            ['id' => 'amenities', 'type' => 'text', 'label' => 'Key Amenities', 'placeholder' => 'e.g. pool, Wi-Fi, ocean view'],
        ],
    ],
    'linkedin-ai-tools' => [
        'title' => 'Generated Content',
        'icon' => 'fab fa-linkedin',
        'iconColor' => 'text-primary',
        'gradientFrom' => '#0077b5', 'gradientTo' => '#005e93',
        'routeType' => 'linkedin-ai',
        'placeholderText' => 'Choose a content type to generate LinkedIn content',
        'fields' => [
            ['id' => 'contentType', 'type' => 'select', 'label' => 'Content Type', 'options' => ['post'=>'LinkedIn Post','headline'=>'Profile Headline','summary'=>'About Me Summary','article'=>'Article Introduction']],
            ['id' => 'topic', 'type' => 'text', 'label' => 'Topic / Industry', 'placeholder' => 'e.g. SaaS, Marketing, Finance'],
            ['id' => 'tone', 'type' => 'select', 'label' => 'Tone', 'options' => ['professional'=>'Professional','inspirational'=>'Inspirational','storytelling'=>'Storytelling','thought-leader'=>'Thought Leader']],
        ],
    ],
    'facebook-ai-tools' => [
        'title' => 'Generated Content',
        'icon' => 'fab fa-facebook',
        'iconColor' => 'text-primary',
        'gradientFrom' => '#1877f2', 'gradientTo' => '#42b72a',
        'routeType' => 'facebook-ai',
        'placeholderText' => 'Choose a content type to generate Facebook content',
        'fields' => [
            ['id' => 'contentType', 'type' => 'select', 'label' => 'Content Type', 'options' => ['post'=>'Facebook Post','adcopy'=>'Ad Copy','bio'=>'Page Bio','event'=>'Event Description']],
            ['id' => 'topic', 'type' => 'text', 'label' => 'Topic / Business', 'placeholder' => 'e.g. Pizza restaurant, fitness coach'],
            ['id' => 'audience', 'type' => 'select', 'label' => 'Audience', 'options' => ['general'=>'General','business'=>'Business Owners','youth'=>'Young Adults','parents'=>'Parents','seniors'=>'Seniors']],
        ],
    ],
];

// ===================== NAME GENERATORS =====================

$nameTools = [
    'dnd-name-generator' => [
        'title' => 'Generated Names',
        'icon' => 'fas fa-dragon',
        'iconColor' => 'text-danger',
        'gradientFrom' => '#8b0000', 'gradientTo' => '#dc143c',
        'routeType' => 'dnd-name',
        'placeholderText' => 'Choose race and class to generate D&D names',
        'fields' => [
            ['id' => 'race', 'type' => 'select', 'label' => 'Race', 'options' => ['human'=>'Human','elf'=>'Elf','dwarf'=>'Dwarf','halfling'=>'Halfling','dragonborn'=>'Dragonborn','tiefling'=>'Tiefling','orc'=>'Half-Orc','gnome'=>'Gnome']],
            ['id' => 'gender', 'type' => 'select', 'label' => 'Gender', 'options' => ['male'=>'Male','female'=>'Female','neutral'=>'Neutral']],
        ],
    ],
    'anime-name-generator' => [
        'title' => 'Generated Names',
        'icon' => 'fas fa-star',
        'iconColor' => 'text-warning',
        'gradientFrom' => '#ff6b6b', 'gradientTo' => '#ffa07a',
        'routeType' => 'anime-name',
        'placeholderText' => 'Choose gender and type to generate anime names',
        'fields' => [
            ['id' => 'gender', 'type' => 'select', 'label' => 'Gender', 'options' => ['male'=>'Male','female'=>'Female','neutral'=>'Neutral']],
            ['id' => 'type', 'type' => 'select', 'label' => 'Character Type', 'options' => ['hero'=>'Hero/Heroine','villain'=>'Villain','cute'=>'Cute/Kawaii','cool'=>'Cool/Badass','ancient'=>'Ancient/Traditional']],
        ],
    ],
    'fantasy-business-name-generator' => [
        'title' => 'Generated Names',
        'icon' => 'fas fa-wand-magic-sparkles',
        'iconColor' => 'text-purple',
        'gradientFrom' => '#a18cd1', 'gradientTo' => '#fbc2eb',
        'routeType' => 'fantasy-business-name',
        'placeholderText' => 'Choose a business type for fantasy-themed names',
        'fields' => [
            ['id' => 'businessType', 'type' => 'select', 'label' => 'Business Type', 'options' => ['tavern'=>'Tavern/Inn','shop'=>'Magic Shop','bookstore'=>'Bookstore','cafe'=>'Cafe','gaming'=>'Gaming Company','studio'=>'Creative Studio']],
            ['id' => 'vibe', 'type' => 'select', 'label' => 'Vibe', 'options' => ['mystical'=>'Mystical','dark'=>'Dark & Gothic','whimsical'=>'Whimsical','elegant'=>'Elegant','rustic'=>'Rustic']],
        ],
    ],
    'ai-team-name-generator' => [
        'title' => 'Generated Team Names',
        'icon' => 'fas fa-users',
        'iconColor' => 'text-primary',
        'gradientFrom' => '#667eea', 'gradientTo' => '#764ba2',
        'routeType' => 'team-name',
        'placeholderText' => 'Choose a category to generate team names',
        'fields' => [
            ['id' => 'category', 'type' => 'select', 'label' => 'Category', 'options' => ['sports'=>'Sports Team','corporate'=>'Corporate Team','hackathon'=>'Hackathon','trivia'=>'Trivia Night','esports'=>'Esports/Gaming']],
            ['id' => 'vibe', 'type' => 'select', 'label' => 'Vibe', 'options' => ['powerful'=>'Powerful','funny'=>'Funny','techy'=>'Techy','animal'=>'Animal-themed','mythical'=>'Mythical']],
        ],
    ],
    'kingdom-name-generator' => [
        'title' => 'Generated Kingdom Names',
        'icon' => 'fas fa-chess-rook',
        'iconColor' => 'text-warning',
        'gradientFrom' => '#c79081', 'gradientTo' => '#dfa579',
        'routeType' => 'kingdom-name',
        'placeholderText' => 'Choose a theme to generate kingdom names',
        'fields' => [
            ['id' => 'theme', 'type' => 'select', 'label' => 'Kingdom Theme', 'options' => ['medieval'=>'Medieval','elven'=>'Elven','dwarven'=>'Dwarven','dark'=>'Dark/Evil','celestial'=>'Celestial','desert'=>'Desert','frozen'=>'Frozen']],
        ],
    ],
    'female-elf-name-generator' => [
        'title' => 'Generated Elf Names',
        'icon' => 'fas fa-leaf',
        'iconColor' => 'text-success',
        'gradientFrom' => '#11998e', 'gradientTo' => '#38ef7d',
        'routeType' => 'female-elf-name',
        'placeholderText' => 'Choose elf type to generate female names',
        'fields' => [
            ['id' => 'elfType', 'type' => 'select', 'label' => 'Elf Type', 'options' => ['high'=>'High Elf','wood'=>'Wood Elf','dark'=>'Dark Elf (Drow)','moon'=>'Moon Elf','sun'=>'Sun Elf','sea'=>'Sea Elf']],
        ],
    ],
    'female-dragon-name-generator' => [
        'title' => 'Generated Dragon Names',
        'icon' => 'fas fa-fire',
        'iconColor' => 'text-danger',
        'gradientFrom' => '#f5576c', 'gradientTo' => '#ff5858',
        'routeType' => 'female-dragon-name',
        'placeholderText' => 'Choose a dragon type to generate names',
        'fields' => [
            ['id' => 'dragonType', 'type' => 'select', 'label' => 'Dragon Type', 'options' => ['fire'=>'Fire Dragon','ice'=>'Ice Dragon','storm'=>'Storm Dragon','shadow'=>'Shadow Dragon','ancient'=>'Ancient Dragon','celestial'=>'Celestial Dragon']],
        ],
    ],
    'ai-band-name-generator' => [
        'title' => 'Generated Band Names',
        'icon' => 'fas fa-guitar',
        'iconColor' => 'text-danger',
        'gradientFrom' => '#f12711', 'gradientTo' => '#f5af19',
        'routeType' => 'band-name',
        'placeholderText' => 'Choose a genre to generate band names',
        'fields' => [
            ['id' => 'genre', 'type' => 'select', 'label' => 'Genre', 'options' => ['rock'=>'Rock','metal'=>'Metal','indie'=>'Indie','pop'=>'Pop','hiphop'=>'Hip-Hop','electronic'=>'Electronic','punk'=>'Punk','jazz'=>'Jazz']],
            ['id' => 'vibe', 'type' => 'select', 'label' => 'Vibe', 'options' => ['dark'=>'Dark','playful'=>'Playful','abstract'=>'Abstract','edgy'=>'Edgy','retro'=>'Retro']],
        ],
    ],
    'real-estate-business-name-generator' => [
        'title' => 'Generated Names',
        'icon' => 'fas fa-house-chimney',
        'iconColor' => 'text-primary',
        'gradientFrom' => '#0575E6', 'gradientTo' => '#021B79',
        'routeType' => 'real-estate-name',
        'placeholderText' => 'Choose a style to generate real estate names',
        'fields' => [
            ['id' => 'style', 'type' => 'select', 'label' => 'Brand Style', 'options' => ['luxury'=>'Luxury','modern'=>'Modern','traditional'=>'Traditional','family'=>'Family-Owned','corporate'=>'Corporate']],
            ['id' => 'location', 'type' => 'text', 'label' => 'City/Region', 'placeholder' => 'e.g. Manhattan, Bay Area'],
        ],
    ],
    'etsy-business-name-generator' => [
        'title' => 'Generated Shop Names',
        'icon' => 'fas fa-store',
        'iconColor' => 'text-warning',
        'gradientFrom' => '#f5af19', 'gradientTo' => '#f12711',
        'routeType' => 'etsy-shop-name',
        'placeholderText' => 'Choose your niche to generate Etsy shop names',
        'fields' => [
            ['id' => 'niche', 'type' => 'select', 'label' => 'Niche', 'options' => ['jewelry'=>'Jewelry','crafts'=>'Handmade Crafts','vintage'=>'Vintage','digital'=>'Digital Products','clothing'=>'Clothing','art'=>'Art & Prints']],
            ['id' => 'vibe', 'type' => 'select', 'label' => 'Vibe', 'options' => ['cute'=>'Cute','minimalist'=>'Minimalist','boho'=>'Boho','rustic'=>'Rustic','modern'=>'Modern']],
        ],
    ],
    'bakery-business-name-generator' => [
        'title' => 'Generated Bakery Names',
        'icon' => 'fas fa-cookie-bite',
        'iconColor' => 'text-warning',
        'gradientFrom' => '#f7971e', 'gradientTo' => '#ffd200',
        'routeType' => 'bakery-name',
        'placeholderText' => 'Choose a style to generate bakery names',
        'fields' => [
            ['id' => 'specialty', 'type' => 'select', 'label' => 'Specialty', 'options' => ['cakes'=>'Cakes','bread'=>'Bread & Pastries','cupcakes'=>'Cupcakes','cookies'=>'Cookies','vegan'=>'Vegan Bakery','french'=>'French Patisserie']],
            ['id' => 'vibe', 'type' => 'select', 'label' => 'Vibe', 'options' => ['cozy'=>'Cozy','elegant'=>'Elegant','playful'=>'Playful','rustic'=>'Rustic','modern'=>'Modern']],
        ],
    ],
    'art-business-name-generator' => [
        'title' => 'Generated Art Names',
        'icon' => 'fas fa-paintbrush',
        'iconColor' => 'text-primary',
        'gradientFrom' => '#667eea', 'gradientTo' => '#764ba2',
        'routeType' => 'art-business-name',
        'placeholderText' => 'Choose your art type to generate business names',
        'fields' => [
            ['id' => 'artType', 'type' => 'select', 'label' => 'Art Type', 'options' => ['gallery'=>'Gallery','studio'=>'Art Studio','design'=>'Design Agency','photography'=>'Photography','tattoo'=>'Tattoo Studio','digital'=>'Digital Art']],
            ['id' => 'style', 'type' => 'select', 'label' => 'Style', 'options' => ['modern'=>'Modern','abstract'=>'Abstract','classic'=>'Classic','edgy'=>'Edgy','minimalist'=>'Minimalist']],
        ],
    ],
    'anime-girl-name-generator' => [
        'title' => 'Generated Names',
        'icon' => 'fas fa-heart',
        'iconColor' => 'text-danger',
        'gradientFrom' => '#ff758c', 'gradientTo' => '#ff7eb3',
        'routeType' => 'anime-girl-name',
        'placeholderText' => 'Choose a personality type to generate anime girl names',
        'fields' => [
            ['id' => 'personality', 'type' => 'select', 'label' => 'Personality', 'options' => ['sweet'=>'Sweet & Kind','tsundere'=>'Tsundere','mysterious'=>'Mysterious','energetic'=>'Energetic','warrior'=>'Warrior Princess','intellectual'=>'Intellectual']],
        ],
    ],
    'animal-crossing-island-name-generator' => [
        'title' => 'Generated Island Names',
        'icon' => 'fas fa-tree',
        'iconColor' => 'text-success',
        'gradientFrom' => '#67b26f', 'gradientTo' => '#4ca2cd',
        'routeType' => 'acnh-island-name',
        'placeholderText' => 'Choose a theme for island name ideas',
        'fields' => [
            ['id' => 'theme', 'type' => 'select', 'label' => 'Island Theme', 'options' => ['cottagecore'=>'Cottagecore','tropical'=>'Tropical','spooky'=>'Spooky','cute'=>'Cute/Kawaii','nature'=>'Nature','celestial'=>'Celestial','food'=>'Food-Themed']],
        ],
    ],
    'japanese-name-generator' => [
        'title' => 'Generated Japanese Names',
        'icon' => 'fas fa-language',
        'iconColor' => 'text-danger',
        'gradientFrom' => '#eb3349', 'gradientTo' => '#f45c43',
        'routeType' => 'japanese-name',
        'placeholderText' => 'Choose options to generate Japanese names',
        'fields' => [
            ['id' => 'gender', 'type' => 'select', 'label' => 'Gender', 'options' => ['male'=>'Male','female'=>'Female','neutral'=>'Neutral']],
            ['id' => 'era', 'type' => 'select', 'label' => 'Style', 'options' => ['modern'=>'Modern','traditional'=>'Traditional','fantasy'=>'Fantasy/Anime','samurai'=>'Samurai Era']],
        ],
    ],
    'planet-name-generator' => [
        'title' => 'Generated Planet Names',
        'icon' => 'fas fa-globe',
        'iconColor' => 'text-info',
        'gradientFrom' => '#0f0c29', 'gradientTo' => '#302b63',
        'routeType' => 'planet-name',
        'placeholderText' => 'Choose a planet type to generate names',
        'fields' => [
            ['id' => 'planetType', 'type' => 'select', 'label' => 'Planet Type', 'options' => ['terrestrial'=>'Terrestrial','gas'=>'Gas Giant','ice'=>'Ice World','desert'=>'Desert Planet','ocean'=>'Ocean World','volcanic'=>'Volcanic','alien'=>'Alien Homeworld']],
        ],
    ],
];

$allTools = array_merge($tools, $nameTools);
$created = 0;
$skipped = 0;

foreach ($allTools as $slug => $config) {
    $file = $viewsDir . $slug . '.blade.php';
    if (file_exists($file)) {
        echo "SKIP: {$slug} (already exists)\n";
        $skipped++;
        continue;
    }
    
    $content = generateView(
        $slug,
        $config['title'],
        $config['icon'],
        $config['iconColor'],
        $config['gradientFrom'],
        $config['gradientTo'],
        $config['fields'],
        $config['routeType'],
        $config['placeholderText']
    );
    
    file_put_contents($file, $content);
    echo "CREATED: {$slug}\n";
    $created++;
}

echo "\n✅ Done! Created {$created} views, skipped {$skipped}.\n";
