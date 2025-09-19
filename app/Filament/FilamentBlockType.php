<?php

namespace App\Filament;

enum FilamentBlockType: string
{
    case Text = 'text';
    case Image = 'image';
    case ImageText = 'image_text';

    public static function options(): array
    {
        return [
            self::Text->value => 'Text',
            self::Image->value => 'Image',
            self::ImageText->value => 'Image and Text',
        ];
    }
}
