<?php

namespace App\Containers\Deluge\ZohoCreator\Snippets;

use App\Containers\Deluge\Base\DelugeSyntax;
use App\Containers\Deluge\Base\IfStatements;
use App\Containers\Deluge\Base\Variables\MapVariable;
use App\Containers\Deluge\Base\Variables\PrimitiveVariable;
use App\Containers\Deluge\ZohoCrm\IntegrationTasks\CrmGetRecordByIdTask;

class SyncCrmRecordWithCreator
{
    protected string $code = "";

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

        $this->addCodeLine((new FetchRecord($this->formName, "CRM_ID == " . $this->crmId->getName(), "r_$this->formName"))->build());

        $this->addCodeLine(IfStatements::if("r_$this->formName.count() == 0"));

        foreach ($this->fieldsMapping as $creatorField => $crmField) {
            $this->addCodeLine("r_$this->formName.$creatorField = " .  $this->crmRecord->get($crmField) );
        }

        $this->addCodeLine(IfStatements::else());

        $this->insertNewRecord();

        $this->addCodeLine(IfStatements::endIf());


        return $this->code;
    }

    public function insertNewRecord(): void
    {
        $this->addCodeLine("r_$this->formName = insert into $this->formName\n\t[");
        foreach ($this->fieldsMapping as $creatorField => $crmField) {
            $this->addCodeLine("\n\t\t$creatorField = " . $this->crmRecord->get($crmField, ''));
        }
        $this->addCodeLine(DelugeSyntax::NEW_LINE . "]" . DelugeSyntax::CLOSE);
    }

    private function fetchCrmRecord(): MapVariable
    {
        $task = new CrmGetRecordByIdTask(
            module: $this->crmModule,
            id: $this->crmId->getName(),
            responseVariable: 'crmData'
        );

        $this->code .= $task->build();
        return $task->responseMap();
    }

    public function addCodeLine(string $line) : self {
        $this->code .= $line;
        return  $this;
    }
}
