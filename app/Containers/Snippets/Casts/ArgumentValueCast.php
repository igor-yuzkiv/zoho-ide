<?php

namespace App\Containers\Snippets\Casts;

use App\Containers\Snippets\Enums\ArgumentType;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\matches;

/**
 *
 */
class ArgumentValueCast implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return mixed
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (ArgumentType::is(\Arr::get($attributes, 'type'), ArgumentType::mapping)) {
            return $value
                ? json_decode($value, true)
                : [];
        }

        return $value;
    }

    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return mixed
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value && ArgumentType::is(\Arr::get($attributes, 'type'), ArgumentType::mapping)) {
            return json_encode($value);
        }

        return $value;
    }
}
