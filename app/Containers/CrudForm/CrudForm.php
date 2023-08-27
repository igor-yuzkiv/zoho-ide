<?php

namespace App\Containers\CrudForm;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Http\JsonResponse;

/**
 *
 */
abstract class CrudForm implements Arrayable
{

    /**
     * @var array<string, FormField>
     */
    protected array $fields = [];

    /**
     * @var array <string, string>
     */
    protected array $labels = [];

    /**
     * @var array<string>
     */
    protected array $required = [];

    /**
     * @var array<string, string>
     */
    protected array $rules = [];

    /**
     * @param Model|null $model
     */
    public function __construct(readonly protected ?Model $model = null)
    {

    }

    /**
     * @param array $data
     * @return array
     */
    public function validate(array $data): array
    {
        return \Validator::validate($data, $this->getValidateRules());
    }


    /**
     * @return JsonResponse
     */
    public function respond(): JsonResponse
    {
        return \Response::json($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $result = [];

        foreach ($this->fields as $name => $fieldClass) {
            /** @var FormField $field */
            $field = app($fieldClass);

            $field->setName($name);

            if ($this->model) {
                $field->setValue($this->model->{$name});
            }

            if (isset($this->labels[$name])) {
                $field->setLabel($this->labels[$name]);
            }

            if (in_array($name, $this->required)) {
                $field->setRequired(true);
            }

            $result[] = $field->toArray();
        }

        return $result;
    }

    /**
     * @return string[]
     */
    public function getValidateRules(): array
    {
        return $this->rules;
    }
}
