<?php

namespace App\Containers\CrudForm;

use \Illuminate\Http\JsonResponse;

/**
 *
 */
abstract class CrudForm
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
     * @return array
     */
    public function renderFields(): array
    {
        $result = [];

        foreach ($this->getFields() as $name => $fieldClass) {
            /** @var FormField $field */
            $field = app($fieldClass);

            $field->setName($name);
            $field->setRequired($this->isRequired($name));

            if (isset($this->getLabels()[$name])) {
                $field->setLabel($this->getLabels()[$name]);
            }

            $result[] = $field->toArray();
        }

        return $result;
    }

    /**
     * @param string|null $wrap
     * @return JsonResponse
     */
    public function respond(?string $wrap = null): JsonResponse
    {
        $result = [
            'fields' => $this->renderFields(),
            'rules'  => $this->getRules()
        ];

        return \Response::json(
            $wrap ? [$wrap => $result] : $result
        );
    }

    /**
     * @param array $data
     * @return array
     */
    public function validate(array $data): array
    {
        return \Validator::validate($data, $this->getRules());
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isRequired(string $name): bool
    {
        return in_array($name, $this->getRequired());
    }

    /**
     * @return string[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @return FormField[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return array
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @return string[]
     */
    public function getRequired(): array
    {
        return $this->required;
    }
}
