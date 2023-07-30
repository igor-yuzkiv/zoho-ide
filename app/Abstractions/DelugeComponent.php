<?php

namespace App\Abstractions;

use Illuminate\View\Component;
use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

/**
 *
 */
abstract class DelugeComponent extends Component
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @return string
     */
    abstract public function handle(): string;

    /**
     * @return \Closure
     */
    public function render(): \Closure
    {
        return function (array $data) {
            $this->data = $data;
            return $this->handle();
        };
    }

    /**
     * @return array
     */
    protected function getSlots(): array
    {
        return $this->data['__laravel_slots'] ?? [];
    }

    /**
     * @return HtmlString|null
     */
    protected function getDefaultSlot(): ?HtmlString
    {
        return $this->getSlots()['__default'] ?? null;
    }

    /**
     * @param string $name
     * @return ComponentSlot|null
     */
    protected function getSlot(string $name): ?ComponentSlot
    {
        return $this->getSlots()[$name] ?? null;
    }
}
