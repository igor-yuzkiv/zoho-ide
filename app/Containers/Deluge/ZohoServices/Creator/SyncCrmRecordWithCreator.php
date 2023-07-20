<?php

namespace App\Containers\Deluge\ZohoServices\Creator;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\Deluge;
use App\Containers\Deluge\Variables\MapVariable;
use App\Containers\Deluge\Variables\PrimitiveVariable;
use App\Containers\Deluge\ZohoServices\Crm\GetRecordByIdTask;

class SyncCrmRecordWithCreator extends CodeSnippet
{
    protected PrimitiveVariable $crmId;

    protected MapVariable $crmRecord;

    public function __construct(
        protected string $crmModule,
        protected array  $fieldsMapping,
        protected string $formName
    )
    {
        $this->crmId = new PrimitiveVariable("crmId");
    }

    public function build(): string
    {
        $this->code = $this->crmId->define(0);
        $this->crmRecord = $this->fetchCrmRecord();


        $this->addLine(new FetchRecord($this->formName, "CRM_ID == " . $this->crmId->getName(), "r_$this->formName"));

        $updateMap = [];
        foreach ($this->fieldsMapping as $creatorField => $crmField) {
            $updateMap[$creatorField] = $this->crmRecord->get($crmField, '');
        }


        $this->code .= Deluge::if(
            "r_$this->formName.count() == 0",
            (new InsertRecord($this->formName, array_map(fn($field) => $this->crmRecord->get($field, ''), $this->fieldsMapping)))
        );

        $this->code .= Deluge::else(
            (new UpdateRecord("r_$this->formName", array_map(fn($field) => $this->crmRecord->get($field, Deluge::SEMICOLON), $this->fieldsMapping))),
            true
        );

        return $this->code;
    }

    private function fetchCrmRecord(): MapVariable
    {
        $task = new GetRecordByIdTask(
            module: $this->crmModule,
            id: $this->crmId->getName(),
            responseVariable: 'crmData'
        );

        $this->code .= $task->build();
        return $task->responseMap();
    }
}
