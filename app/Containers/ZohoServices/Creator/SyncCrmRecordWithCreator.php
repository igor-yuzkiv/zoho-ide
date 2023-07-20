<?php

namespace App\Containers\ZohoServices\Creator;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\Deluge;
use App\Containers\Deluge\DelugeSyntax;
use App\Containers\Deluge\Variables\MapVariable;
use App\Containers\Deluge\Variables\PrimitiveVariable;
use App\Containers\ZohoServices\Creator\Base\FetchRecord;
use App\Containers\ZohoServices\Creator\Base\InsertRecord;
use App\Containers\ZohoServices\Creator\Base\UpdateRecord;
use App\Containers\ZohoServices\Crm\GetRecordByIdTask;

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

        //find record by crm id
        $this->addLine(new FetchRecord($this->formName, "CRM_ID == " . $this->crmId->getVariableName(), "r_$this->formName"));

        //insert new record
        $this->code .= Deluge::if(
            "r_$this->formName.count() == 0",
            (new InsertRecord($this->formName, array_map(fn($field) => $this->crmRecord->get($field, ''), $this->fieldsMapping)))
        );

        //update existing record
        $this->code .= Deluge::else(
            (new UpdateRecord("r_$this->formName", array_map(fn($field) => $this->crmRecord->get($field, DelugeSyntax::SEMICOLON), $this->fieldsMapping))),
            true
        );

        return $this->code;
    }

    private function fetchCrmRecord(): MapVariable
    {
        $task = new GetRecordByIdTask(
            module: $this->crmModule,
            id: $this->crmId->getVariableName(),
            responseVariable: 'crmData'
        );

        $this->code .= $task->build();
        return $task->responseMap();
    }
}
