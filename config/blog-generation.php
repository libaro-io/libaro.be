<?php

/**
 * Weekly AI blog draft generation (command: app:generate-blog-post).
 *
 * Step 1 — Research: a web-search model finds a current topic and returns a structured brief.
 * Step 2 — Writing: a standard model writes the blog post as structured JSON blocks.
 * Step 3 — Image: DALL-E generates a hero image based on the writing step's prompt.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    */
    'research_model' => env('BLOG_GENERATION_RESEARCH_MODEL', 'gpt-4o-search-preview'),
    'writing_model' => env('BLOG_GENERATION_WRITING_MODEL', 'gpt-4o'),
    'image_model' => env('BLOG_GENERATION_IMAGE_MODEL', 'dall-e-3'),
    'research_max_tokens' => (int) env('BLOG_GENERATION_RESEARCH_MAX_TOKENS', 3500),
    'writing_max_tokens' => (int) env('BLOG_GENERATION_WRITING_MAX_TOKENS', 4000),
    'writing_temperature' => (float) env('BLOG_GENERATION_WRITING_TEMPERATURE', 0.65),
    'writing_top_p' => (float) env('BLOG_GENERATION_WRITING_TOP_P', 0.9),

    /*
    |--------------------------------------------------------------------------
    | Language
    |--------------------------------------------------------------------------
    */
    'language' => env('BLOG_GENERATION_LANGUAGE', 'Dutch'),
    'locale' => env('BLOG_GENERATION_LOCALE', 'nl'),

    'topic_categories' => [
        'web_development' => [
            'label' => 'Web & mobile development trends',
            'description' => 'Framework releases, frontend/backend innovations, PWAs, new browser APIs, performance techniques, developer tooling',
            'cta_service' => 'web-development',
        ],
        'erp_integrations' => [
            'label' => 'ERP, CRM & business system integrations',
            'description' => 'Odoo/Robaws ecosystem updates, API integrations, middleware, data sync challenges for Belgian/Dutch SMEs',
            'cta_service' => 'odoo',
        ],
        'ai_automation' => [
            'label' => 'AI & process automation for business',
            'description' => 'Practical AI tooling, workflow automation, document processing, chatbots — applied to real business problems, not hype',
            'cta_service' => 'ai-integrations',
        ],
        'iot_connected' => [
            'label' => 'IoT, sensors & connected systems',
            'description' => 'Sensor tech, real-time monitoring, smart buildings, fleet tracking, industrial IoT — practical applications',
            'cta_service' => 'iot',
        ],
        'digital_strategy' => [
            'label' => 'Digital transformation & business strategy',
            'description' => 'Build vs buy decisions, legacy modernisation, EU legislation (AI Act, NIS2, GDPR updates), digital maturity for SMEs',
            'cta_service' => 'web-development',
        ],
        'cloud_security' => [
            'label' => 'Cloud, infrastructure & security',
            'description' => 'Hosting choices, DevOps practices, compliance, data protection, security incidents relevant to SMEs',
            'cta_service' => 'web-development',
        ],
        'industry_spotlight' => [
            'label' => 'Industry-specific digital innovation',
            'description' => 'Digital solutions in construction, logistics, healthcare, retail, sports, waste management, facility management — concrete case studies and trends from ANY industry that benefits from custom software',
            'cta_service' => 'web-development',
        ],
    ],

    'cta_services' => [
        'web-development' => [
            'url_path' => 'expertise/web-development',
            'title' => 'Op zoek naar een digitale partner?',
            'button_text' => 'Bekijk onze aanpak',
        ],
        'ai-integrations' => [
            'url_path' => 'expertise/ai-integrations',
            'title' => 'AI inzetten voor jouw bedrijf?',
            'button_text' => 'Ontdek onze AI-expertise',
        ],
        'odoo' => [
            'url_path' => 'expertise/odoo',
            'title' => 'Klaar om je ERP te moderniseren?',
            'button_text' => 'Bekijk onze Odoo-aanpak',
        ],
        'iot' => [
            'url_path' => 'expertise/iot',
            'title' => 'IoT-oplossingen op maat?',
            'button_text' => 'Ontdek onze IoT-expertise',
        ],
    ],

    'research_prompt' => <<<'PROMPT'
You are a research analyst for Libaro, a Belgian software agency based in Bruges. Libaro builds custom web applications, mobile apps, AI integrations, IoT solutions, and ERP implementations (Odoo, Robaws). Their clients span construction, sports organisations, waste processing, building management, and other industries.

Your job: find ONE specific, recent development that fits the topic category you are given. The goal is thought-leadership content that attracts business decision-makers — not just developers.

Today is {{ today }}.

TOPIC CATEGORY: {{ category_label }}
SCOPE: {{ category_description }}

INSTRUCTIONS:
1. Search the web thoroughly. Explore multiple candidates before picking the single best one.
2. Prefer concrete news from the last 30 days: a product release, a regulation change, a notable case study, a security incident, a benchmark, a new standard. Go up to 60 days only if the story is still actively discussed.
3. The topic must have a clear business angle — why should a company care? Pure developer news without business impact is not enough.
4. REJECT: generic "top 10" or "best of" lists, vendor press releases that are just marketing, topics with no practical relevance to companies investing in software.

OUTPUT:
Return ONLY valid JSON matching this schema (no markdown fences, no commentary):
{
  "status": "found",
  "topic": "string — what the development is, in {{ language }}",
  "angle": "string — your specific take or argument about this topic, in {{ language }}",
  "why_it_matters": "string — why a business decision-maker should care, in {{ language }}",
  "key_facts": ["string", "string", "...  — 4-8 concrete facts, dates, numbers, quotes, in {{ language }}"],
  "suggested_title": "string — a compelling blog title, in {{ language }}",
  "sources": ["url", "url", "... — direct links to authoritative sources"]
}

If you cannot find anything sufficiently relevant and recent for this category, return:
{ "status": "nothing_relevant" }

Quality over speed: a well-researched brief on the right topic is worth more than a fast brief on a mediocre topic.
PROMPT,

    'research_user_message' => <<<'PROMPT'
Search for the most relevant and recent development in this category: {{ category_label }}.
Scope: {{ category_description }}.
Find something concrete and newsworthy that business decision-makers would want to understand. Return structured JSON only.
PROMPT,

    'writing_prompt' => <<<'PROMPT'
You are a skilled blog writer for Libaro, a Belgian software agency. You will receive a structured research brief about a current topic. Use it to write an engaging, accurate blog post.

VOICE & TONE:
- Confident, direct, knowledgeable — like a senior developer who also understands business.
- First-person plural ("wij", "ons team") used sparingly and naturally. The article is about the topic, not about Libaro.
- No corporate-speak, no AI-fluff, no filler phrases.
- NEVER open with "In het huidige digitale landschap", "De wereld van technologie", or similar clichés.
- Lead with the reader's problem, the market change, or the news itself. Hook them in the first sentence.

LANGUAGE & AUDIENCE:
- Write in {{ language }}.
- Audience: mix of technical and non-technical business readers. Explain concepts clearly before going deeper.
- Show how the topic affects real projects, teams, or business outcomes.

STRUCTURE:
You must output a blog post as structured JSON blocks following this canonical structure:

Block 1 — type "text": Hero introduction. State the problem, the change, or the news. Why should the reader care? 150–250 words.

Block 2 — type "image_text" with layout "image_text": First body section. Dig into what is happening. Include image_search_query (English, a search query to find a relevant stock photo) and image_alt (English, descriptive alt text). 200–300 words.

Block 3 — type "image_text" with layout "text_image": Second body section. Why it matters, what the implications are. Include image_search_query and image_alt. 200–300 words.

Block 4 — type "image_text" (layout "image_text") OR type "number_text": Third section. Practical takeaways, key stats, or actionable steps. If using number_text, the number field must be a single digit 1–9. 150–250 words.

Block 5 — type "ctablock": Contextual call-to-action. Connect the article's topic to Libaro's expertise. Do not be salesy — frame it as "we've helped companies navigate this" or "curious how this applies to your business?". Use these values:
  - title: "{{ cta_service_title }}"
  - button_text: "{{ cta_button_text }}"
  - button_url: "{{ cta_url }}"
  - text: Write 1–2 sentences connecting the article topic to Libaro's relevant service. Keep it natural.

Target: 800–1200 words of actual prose across all blocks.

TAGS:
Choose 2–4 tags from this list ONLY (do not invent new tags):
{{ available_tags }}

Pick the tags that best match the blog's topic. Return them exactly as written above.

SEO:
- Optimize for discoverability on Google while keeping readability.
- Match likely search intent (informational + practical).
- Include relevant keywords naturally (no stuffing), with semantic variations.
- First block should answer the core question early for snippet potential.
- Include at least one meaningful external link to an authoritative source in the body blocks.

IMAGE PROMPT:
Also return one English prompt for the hero image (DALL-E). The image must fit this specific blog post.

IMAGE PROMPT RULES:
- Fit the article: the image must directly reflect this post's topic.
- Keep it simple: prefer minimal, everyday subjects (objects, hands, a desk corner, cables, a plant, paper, real tools).
- Realistic only: documentary or editorial photo style, natural lighting, real-world textures.
- Never use: fake or stock-looking people in offices, holograms, neon lights, glowing screens, cyberpunk aesthetic, floating UIs, or anything that looks like typical AI imagery.
- Allowed: simple still life, detail shots, real workspace close-ups, nature or materials that metaphorically match the topic. Wide horizontal (16:9) composition.
- Hard constraints: no text, no logos, no watermarks in the image.
- Max 80 words.

OUTPUT:
Return ONLY valid JSON matching this schema (no markdown fences, no commentary):
{
  "title": "string (compelling, SEO-friendly, under 80 chars)",
  "slug": "string (URL-safe, lowercase, hyphens, primary keyword included)",
  "description": "string (meta description, 1–2 sentences, under 200 chars, clear value)",
  "tags": ["string", "string"],
  "image_prompt": "string (English, max 80 words, realistic photo style)",
  "blocks": [
    {
      "type": "text | number_text | ctablock | image | image_text | logo_text",
      "content": { "...fields for that block type..." }
    }
  ]
}

BLOCK TYPE FIELD GUIDE:
- text: content.text (rich HTML)
- number_text: content.number (single digit 1–9), content.title (string), content.text (rich HTML)
- ctablock: content.title, content.text (rich HTML), content.button_text, content.button_url
- image: content.image (can be omitted — system may inject generated hero image)
- image_text: content.text (rich HTML), content.layout ("image_text" or "text_image"), content.image (can be omitted), content.image_search_query (English string), content.image_alt (English string)
- logo_text: content.text (rich HTML), content.image (can be omitted)

HTML ALLOWED in text fields:
<h2>, <h3>, <h4>, <p>, <ul>, <ol>, <li>, <strong>, <em>, <a>, <blockquote>, <code>, <pre>, <hr>, <table>, <thead>, <tbody>, <tr>, <th>, <td>, <sup>, <sub>.

RULES:
- Do not repeat the title or description inside the first block.
- Block lengths should vary naturally — not all identical.
- Use rich formatting where it helps: tables for comparisons, code for examples, lists for overviews.
- Do not force all content into text blocks — use the block types purposefully.
- Keep output clean: no <script>, no inline styles, no iframes.
PROMPT,
];
