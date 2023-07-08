<?php

namespace App\Deluge\Variable;

class DelugeMap extends DelugeVariable
{
    private array $value;

    protected string $code;


    public static function of(string $name, array $value): static
    {
        if (!\Arr::isAssoc($value)) {
            throw new \InvalidArgumentException('invalid map value');
        }

        $map = new static($name);
        $map->value = $value;

        return $map;
    }

    public function put(string $key, mixed $value): void
    {
        $this->value[$key] = $value;
    }

    public function get(string $key): mixed
    {
        return $this->value[$key];
    }

    protected function declare(): string
    {
        return $this->name . " = Map();\n\t";
    }

    public function compile(): string
    {
        $result = $this->declare();
        foreach ($this->value as $key => $item) {
            $result .= $this->name . ".put(\"$key\", \"$item\");\n\t";
        }

        return  $result;
    }
}
