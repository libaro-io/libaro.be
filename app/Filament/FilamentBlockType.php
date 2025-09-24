<?php

namespace App\Filament;

enum FilamentBlockType: string
{
    case Text = 'text';
    case Image = 'image';
    case ImageText = 'image_text';
    case NumberText = 'number_text';
    case LogoText = 'logo_text';

    public static function options(): array
    {
        return [
            self::Text->value => 'Text',
            self::Image->value => 'Image',
            self::ImageText->value => 'Image and Text',
            self::NumberText->value => 'Number and Text',
            self::LogoText->value => 'Logo and Text',
        ];
    }
}
