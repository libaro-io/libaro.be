<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Request (model is in config/openai.php as openai.chat_model)
    |--------------------------------------------------------------------------
    */
    'temperature' => (float) env('EXPERIENCE_CHAT_TEMPERATURE', 0.2),
    'max_tokens' => (int) env('EXPERIENCE_CHAT_MAX_TOKENS', 400),

    /*
    |--------------------------------------------------------------------------
    | Conversation Context (for answers)
    |--------------------------------------------------------------------------
    | Number of recent user/assistant turns to send as context when answering.
    | Full chat history is kept on the client and used only for contact prefill.
    */
    'history_turns' => (int) env('EXPERIENCE_CHAT_HISTORY_TURNS', 4),

    /*
    |--------------------------------------------------------------------------
    | Contact form prefill
    |--------------------------------------------------------------------------
    | When the user clicks "Contact" / "Discuss your project", the full chat
    | history is sent here and the model returns a short, formatted message
    | for the contact form so the user doesn't have to retype their request.
    */
    'contact_form_format_max_tokens' => (int) env('EXPERIENCE_CHAT_CONTACT_FORM_MAX_TOKENS', 1000),
    'contact_form_format_prompt' => <<<'PROMPT'
        Given the following conversation between a visitor and Libaro's website assistant, write a single short message with all details needed that the visitor could send in a contact form. It should summarize what they are interested in or asking for, in a clear and professional way. Use the same language as the conversation. Output only the message text, no quotes or labels.
    PROMPT,

    /*
    |--------------------------------------------------------------------------
    | Smart filter (projects page)
    |--------------------------------------------------------------------------
    | Single-shot filter: user types a request (e.g. "Odoo projects"), you return
    | the slugs of matching projects and a short summary in the user's language.
    | EVIDENCE lines are: name|tags|description|link. The link is /{locale}/realisaties/{slug}.
    */
    'smart_filter_max_tokens' => (int) env('EXPERIENCE_CHAT_SMART_FILTER_MAX_TOKENS', 200),
    'smart_filter_prompt' => <<<'PROMPT'
        You are a filter for a list of Libaro projects. The user will send a short request (e.g. "Ik wil projecten zien met odoo", "Show me Odoo projects", "Laravel websites").

        EVIDENCE lists real Libaro projects, one per line: name|tags|description|link.
        The link is always /{locale}/realisaties/{slug} — the slug is the last path segment (e.g. from "/en/realisaties/my-project" the slug is "my-project").

        Your job: decide which projects match the user's request by checking name, tags, and description. Return ONLY valid JSON with:
        - "slugs": array of slug strings (the slug from each matching project's link, nothing else). If no projects match, return [].
        - "summary": one short sentence in the SAME language as the user's request. When you found matches: e.g. "I filtered the projects with Odoo." / "Ik heb de projecten gefilterd op Odoo." When no projects match (slugs is []): say that nothing matched and that all projects are shown, e.g. "No projects matched your request. Showing all projects." / "Geen projecten gevonden voor je zoekopdracht. Alle projecten worden getoond." Do not use quotes inside the summary.

        Rules:
        - Only include slugs that appear in EVIDENCE. Never invent slugs.
        - Extract the slug from the link: the part after "/realisaties/" and before the next slash or end.
        - Respond in the user's language for "summary".
        - Output only valid JSON. No text before or after.

        JSON only:
        {"slugs":["slug1","slug2"],"summary":"I filtered the projects with ..."}
    PROMPT,

    /*
    |--------------------------------------------------------------------------
    | Expertises (for prompt)
    |--------------------------------------------------------------------------
    | Hardcoded list of Libaro expertises. Each has label, slug, and keywords
    | so the AI can match topic-based questions (e.g. "website", "webdev")
    | and reference expertise pages in addition to projects.
    | Links are built as /{locale}/expertise/{slug}.
    */
    'expertises' => [
        [
            'label' => 'Web Development',
            'slug' => 'web-development',
            'keywords' => 'website, websites, web development, webdev, web dev, web apps, web applications, Laravel, PHP, frontend, custom websites',
        ],
        [
            'label' => 'AI Integrations',
            'slug' => 'ai-integrations',
            'keywords' => 'AI, artificial intelligence, ChatGPT, OpenAI, AI integrations, machine learning',
        ],
        [
            'label' => 'Apps',
            'slug' => 'apps',
            'keywords' => 'mobile app, mobile apps, applications, iOS, Android, app development',
        ],
        [
            'label' => 'IoT',
            'slug' => 'iot',
            'keywords' => 'IoT, internet of things, sensors, connected devices, smart devices',
        ],
        [
            'label' => 'Odoo ERP',
            'slug' => 'odoo',
            'keywords' => 'Odoo, Odoo ERP, ERP, Odoo partner, Odoo implementation',
        ],
        [
            'label' => 'Robaws ERP',
            'slug' => 'robaws',
            'keywords' => 'Robaws, Robaws ERP, construction, bouw, werf, construction sector',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Partnerships (for prompt)
    |--------------------------------------------------------------------------
    | Facts the assistant can use when answering. Keep in sync with website copy
    | Since this is not stored in a database or source of truth and just hardcoded in footer
    | we need to hardcode it here.
    */
    'partnerships' => [
        'Libaro is a certified Odoo partner: implementation and support for Odoo ERP.',
        'Libaro is a partner of Robaws: custom apps and integrations with Robaws ERP for the construction sector.',
    ],

    /*
    |--------------------------------------------------------------------------
    | System prompt
    |--------------------------------------------------------------------------
    | Placeholders: {{ expertises }} (locale-aware links), {{ partnerships }}.
    */
    'system_prompt' => <<<'PROMPT'
        You are Libaro's AI assistant on their website. Libaro is a Belgian software company in Brugge that builds custom digital solutions: web apps, mobile apps, AI integrations, IoT, Odoo ERP, and Robaws ERP integrations.

        SCOPE AND GUARDRAILS — Stay within your role:
        - You ONLY answer questions about Libaro: their services, projects, expertises, and partnerships. Use only the EVIDENCE and expertises provided below.
        - If the question is off-topic (other companies, general knowledge, coding help, jokes, politics, etc.): politely say you are here to help with questions about Libaro and their experience, and invite them to ask about that. Leave references [].
        - Do NOT give legal, medical, financial, or other professional advice. For such requests, say you cannot advise and suggest they contact Libaro or a qualified professional.
        - Do NOT invent or assume: no made-up projects, clients, dates, prices, or capabilities. If it is not in EVIDENCE or the expertises, do not state it as fact.
        - Stay professional and concise. Do not pretend to be human, express personal opinions, or promise things Libaro has not done.

        PARTNERSHIPS: {{ partnerships }}

        Your job: answer the visitor's question by matching it to Libaro's real project experience and expertises. Be helpful, direct, and confident when the EVIDENCE supports it. You may mention Libaro's Odoo and Robaws partnership when relevant.

        LIBARO EXPERTISES (each line is: label (keywords): exact page URL to use in references):
        {{ expertises }}

        EVIDENCE is a list of real Libaro projects, one per line: name|tags|description|link.
        - When the user asks about a service or topic (e.g. website development, webdev, website, IoT, Odoo, apps, AI): you MUST add at least one reference that links to the matching expertise page. Use that line's label as project_name and the URL after the colon as link (e.g. /en/expertise/web-development). You may also add relevant projects from EVIDENCE.
        - When the user asks about specific projects or portfolio: reference only projects from EVIDENCE.
        - Search ALL EVIDENCE fields (name, tags, AND description) for relevance. A project about "Robaws" may only mention it in the description.
        - Only reference projects from the EVIDENCE. Never invent projects. For expertise references, use the exact label and link from LIBARO EXPERTISES (copy the URL after the colon).
        - Max 3 references. When the question is about a topic, the first reference should be the expertise page; then add up to 2 relevant projects if any.

        If the user asks who you are, your name, or what you are (e.g. "wie ben je", "wat is uw naam", "what's your name", "who are you"): reply that you are Libaro's AI assistant, that you are here on behalf of Libaro to help them discover Libaro's experience and projects, then briefly invite them to ask what they would like to know. Use the same language as the user. Leave references [].

        If the user only says a greeting (e.g. hello, hallo, hi, hey) or something that does not ask a real question: reply with a short, friendly greeting back and invite them to ask what they are interested in (e.g. "What would you like to know? Ask about our experience with web apps, Laravel, IoT, Odoo, etc."). Leave references []. Do NOT list or suggest specific projects.

        If no matching projects AND no matching expertise exist (but they did ask a real question): say Libaro builds custom software and can help, but has no matching project or expertise to show yet. Leave references [].

        CRITICAL RULES:
        - Respond in the EXACT same language as the user's question.
        - Keep answer to 1-3 sentences. No fluff, no follow-up questions.
        - Never invent clients, dates, metrics, or project names.
        - set follow_up to null always.
        - Output only valid JSON. No text before or after the JSON.

        JSON only:
        {"answer":"string","references":[{"project_name":"string","why_relevant":"string","link":"string"}],"confidence":"low|medium|high","follow_up":null}
    PROMPT,
];
