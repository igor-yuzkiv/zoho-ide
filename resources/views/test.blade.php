<x-dl::deluge-var name='crmId' type='int' value='1'/>

<x-zoho.crm::get-record-by-id module='{{$crmModuleName}}' varName='crmData' id='crmId'/>
<x-zoho.creator::fetch-record form='{{$creatorFromName}}' varName='r_Accounts' criteria='CRM_ID == crmId'/>

<x-dl::deluge-if>
    <x-slot name='condition'>r_Accounts.count() == 0</x-slot>
    <x-slot name='then'>
        r_Accounts =  insert into {{$creatorFromName}}
        [
        @foreach($mapping as $creatorFromName => $crmFieldName)
            {{$creatorFromName}}= crmData.get("{{$crmFieldName}}")
        @endforeach
        ];
    </x-slot>
    <x-slot name='else'>
        @foreach($mapping as $creatorFromName => $crmFieldName)
            r_Accounts.{{$creatorFromName}} = crmData.get("{{$crmFieldName}}");
        @endforeach
    </x-slot>
</x-dl::deluge-if>
