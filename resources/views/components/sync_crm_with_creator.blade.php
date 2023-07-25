crmId = 0;
crmData = <x-apps.crm.getRecordById :module="$module" id="crmId"/>
r_{{$formName}} = {{$formName}}[CRM_ID == crmId];

<x-base.if :condition="'r_'.$formName.'.count() == 0'">
    r_{{$formName}} = insert into {{$formName}}
    [
    @foreach($map as $field => $crmField)
        {{$field}} = crmData.get("{{$crmField}}")
    @endforeach
    ];
</x-base.if>

<x-base.else>
    @foreach($map as $field => $crmField)
        r_{{$formName}}.{{$field}} = crmData.get("{{$crmField}}");
    @endforeach
</x-base.else>
