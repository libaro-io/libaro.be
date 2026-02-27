import { ChatRoleEnum } from "@enums/ChatRoleEnum";
import { ChatConfidenceEnum } from "@enums/ChatConfidenceEnum";

export interface ChatReference {
    project_name: string;
    why_relevant: string;
    link: string;
    image?: string | null;
}

export interface ChatMessage {
    role: ChatRoleEnum;
    content: string;
    references?: ChatReference[];
    contactLink?: string | null;
    contactQuery?: string | null;
    isTyping?: boolean;
    displayedContent?: string;
}

export interface ChatApiResponse {
    answer: string;
    references: ChatReference[];
    confidence: ChatConfidenceEnum;
    follow_up: string | null;
    contact_link?: string | null;
}
