<?php

namespace App\Data\ExperienceChat;

readonly class ChatReference
{
    public function __construct(
        public string $projectName,
        public string $whyRelevant,
        public string $link,
        public ?string $image = null,
    ) {}

    /**
     * @param  array{project_name: string, why_relevant: string, link: string, image?: string|null}  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            projectName: $data['project_name'],
            whyRelevant: $data['why_relevant'],
            link: $data['link'],
            image: $data['image'] ?? null,
        );
    }

    /**
     * @return array{project_name: string, why_relevant: string, link: string, image?: string|null}
     */
    public function toArray(): array
    {
        $arr = [
            'project_name' => $this->projectName,
            'why_relevant' => $this->whyRelevant,
            'link' => $this->link,
        ];
        if ($this->image !== null) {
            $arr['image'] = $this->image;
        }

        return $arr;
    }
}
