<?php

namespace App\Abstractions;

use Illuminate\Contracts\Support\Arrayable;

/**
 *
 */
abstract class ValueObject implements Arrayable
{
    /**
     * @param array $data
     * @return static
     */
    public static function of(array $data): static
    {
        $static = new static();

        foreach ($data as $property => $value) {
            if (property_exists($static, $property)) {
                $static->$property = $value;
            }
        }

        return $static;
    }

    /**
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * @return array
     */
    public function validate(): array
    {
        return \Validator::validate($this->toArray(), $this->rules());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
