<?php

namespace App\Data\ExperienceChat;

readonly class ChatAnswerResponse
{
    /**
     * @param  array<int, ChatReference>  $references
     */
    public function __construct(
        public string $answer,
        public array $references,
        public string $confidence,
        public ?string $followUp = null,
        public ?string $contactLink = null,
    ) {}

    /**
     * @param  array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string, image?: string|null}>, confidence: string, follow_up: string|null, contact_link?: string}  $data
     */
    public static function fromArray(array $data): self
    {
        /** @var array<int, ChatReference> $references */
        $references = array_map(
            fn (array $ref): ChatReference => ChatReference::fromArray($ref),
            $data['references']
        );

        return new self(
            answer: $data['answer'],
            references: $references,
            confidence: (string) $data['confidence'],
            followUp: $data['follow_up'] ?? null,
            contactLink: $data['contact_link'] ?? null,
        );
    }

    /**
     * @return array{answer: string, references: array<int, array{project_name: string, why_relevant: string, link: string, image?: string|null}>, confidence: string, follow_up: string|null, contact_link?: string}
     */
    public function toArray(): array
    {
        $arr = [
            'answer' => $this->answer,
            'references' => array_map(fn (ChatReference $r): array => $r->toArray(), $this->references),
            'confidence' => $this->confidence,
            'follow_up' => $this->followUp,
        ];
        if ($this->contactLink !== null) {
            $arr['contact_link'] = $this->contactLink;
        }

        return $arr;
    }
}
