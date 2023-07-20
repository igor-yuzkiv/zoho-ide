<?php

namespace App\Containers\Deluge\ZohoServices\Crm;

use App\Containers\Deluge\Deluge;
use App\Containers\Deluge\Variables\MapVariable;

class GetRecordByIdTask
{
    public function __construct(
        protected string $module,
        protected string $id,
        protected string $responseVariable = 'response',
    )
    {

    }

    public function build():string {
        return "$this->responseVariable = zoho.crm.getRecordById(\"$this->module\", $this->id)" . Deluge::SEMICOLON_NEW_LINE_TAB;
    }

    public function responseMap(): MapVariable {
        return new MapVariable($this->responseVariable);
    }

    public function get(string $key, string $close = Deluge::SEMICOLON_NEW_LINE_TAB): string {
        return $this->responseVariable . ".get('$key')";
    }
}
