<?php

namespace App\Containers\Deluge\ZohoCrm\IntegrationTasks;

use App\Containers\Deluge\Base\DelugeSyntax;
use App\Containers\Deluge\Base\Variables\MapVariable;

class CrmGetRecordByIdTask
{
    public function __construct(
        protected string $module,
        protected string $id,
        protected string $responseVariable = 'response',
    )
    {

    }

    public function build():string {
        return "$this->responseVariable = zoho.crm.getRecordById(\"$this->module\", $this->id)" . DelugeSyntax::CLOSE;
    }

    public function responseMap(): MapVariable {
        return new MapVariable($this->responseVariable);
    }

    public function get(string $key, string $close = DelugeSyntax::CLOSE): string {
        return $this->responseVariable . ".get('$key')";
    }
}
