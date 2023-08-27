<?php

namespace App\Containers\CrudForm;

use Illuminate\Contracts\Support\Arrayable;

/**
 *
 */
abstract class FormField implements Arrayable
{
    /**
     * @var string
     */
    protected string $label;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @var mixed
     */
    protected mixed $value;

    /**
     * @var mixed|null
     */
    protected mixed $defaultValue = null;

    /**
     * @var bool
     */
    protected bool $required = false;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name'     => $this->getName(),
            'type'     => $this->getType(),
            'value'    => $this->getValue(),
            'required' => $this->isRequired(),
        ];
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        if (isset($this->label)) {
            return $this->label;
        }

        return $this->getName();
    }

    /**
     * @param string $label
     * @return void
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        if (isset($this->value)) {
            return $this->value;
        }

        return $this->defaultValue;
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     * @return void
     */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }
}
