<?php

namespace App\Models;

use stdClass;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;
use Illuminate\Support\Collection;

class Documentation
{
    public Collection $items;
    public Collection $menu;

    #[Pure] public static function new(): Documentation
    {
        return new self;
    }

    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function setItems(object $repositoryFilesOverview): self
    {
        $paths = new Collection();
        foreach ($repositoryFilesOverview->tree as $file) {
            $pathsArray = explode('/', $file->path);

            if (str_ends_with($file->path, '.md') && (count($pathsArray) === 1 || $pathsArray[0] === "docs")) {
                $class = new stdClass();
                $class->uuid = Str::uuid()->toString();
                $class->path = $file->path;
                $class->file = null;
                $paths->add($class);
            }
        }
        $this->items = $paths;

        $this->buildMenu();

        return $this;
    }

    public function addFileToPath($doc, string $file): self
    {
        $this->items = $this->items->map(function ($item) use ($doc, $file) {
            if ($item->path === $doc->path) {
                $item->file = $file;
                return $item;
            }
            return $item;
        });

        return $this;
    }

    public function buildMenu()
    {
        $this->groupItemsByPath()
            ->mapMenu()
            ->moveReadeMe()
            ->orderMenuGroups();
    }

    protected function groupItemsByPath(): static
    {
        $this->menu = $this->items->groupBy(function ($item) {
            $directories = explode('/', $item->path);
            array_pop($directories);
            return implode('/', $directories);
        });

        return $this;
    }

    private function mapMenu(): static
    {
        $this->menu = $this->menu->map(function ($items, $path) {
            $nameArray = explode('/', $path);
            $name = array_pop($nameArray);

            $obj = new stdClass();
            $obj->name = $this->formatString($name);
            $obj->standalone = false;

            if (empty($obj->name)) {
                $obj->name = 'General';
            }

            $obj->level = count($nameArray);

            $obj->items = $items->map(function ($i) {
                $pathArray = explode('/', $i->path);
                $name = array_pop($pathArray);

                $item = new stdClass();
                $item->uuid = $i->uuid;
                $item->path = $i->path;
                $item->level = count($pathArray);
                $item->name = $this->formatString($name);

                return $item;
            });

            return $obj;
        });

        return $this;
    }

    protected function moveReadeMe(): static
    {
        $obj = new stdClass();
        $obj->name = "";
        $obj->level = 0;
        $obj->items = collect();
        $obj->standalone = true;
        $this->menu->put('readme', $obj);

        $general = null;

        $this->menu = $this->menu->map(function ($menuItem) use (&$general) {
            if ($menuItem->name === 'General') {
                $menuItem->items = $menuItem->items->filter(function ($item) use (&$general) {
                    if ($item->path === "README.md") {
                        $general = $item;
                    }
                    return $item->path !== "README.md";
                });

                return $menuItem;
            }

            return $menuItem;
        });

        $this->menu = $this->menu->map(function ($menuItem, $key) use ($general) {
            if ($key === 'readme') {
                $menuItem->items = $menuItem->items->add($general);
            }

            return $menuItem;
        });

        return $this;
    }

    protected function formatString(string $string): string
    {
        $string = Str::title(str_replace(['.md', '.MD'], '', $string));

        return str_replace('_', ' ', $string);
    }

    protected function orderMenuGroups(): static
    {
        foreach ($this->menu as $key => $item) {
            if ($key == 'readme') {
                $item->order = 1;
            } elseif ($key == 'docs') {
                $item->order = 2;
            } else {
                $item->order = 3;
            }
        }
        $this->menu = $this->menu->sortBy('order');

        return $this;
    }
}
