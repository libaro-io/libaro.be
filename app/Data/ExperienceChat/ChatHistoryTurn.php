<?php

namespace App\Data\ExperienceChat;

readonly class ChatHistoryTurn
{
    public function __construct(
        public string $role,
        public string $content,
    ) {}

    /**
     * @param  array{role: string, content: string}  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            role: $data['role'],
            content: $data['content'],
        );
    }

    /**
     * @return array{role: string, content: string}
     */
    public function toArray(): array
    {
        return [
            'role' => $this->role,
            'content' => $this->content,
        ];
    }
}
