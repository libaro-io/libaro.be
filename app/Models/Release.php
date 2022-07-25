<?php

namespace App\Models;

use JetBrains\PhpStorm\Pure;

class Release
{

    public string $version;
    public string $name;
    public bool $isPrerelease;

    #[Pure] public static function new(): Release
    {
        return new self;
    }

    public function version(string $tag_name): self
    {
        $this->version = $tag_name;

        return $this;
    }

    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isPrerelease(bool $prerelease): self
    {
        $this->isPrerelease = $prerelease;

        return $this;
    }
}
