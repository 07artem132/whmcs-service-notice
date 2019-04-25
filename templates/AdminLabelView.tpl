<link rel="stylesheet" type="text/css" href="/modules/addons/ServiceNotice/templates/css/service_notice.css">
<link rel="stylesheet" type="text/css" href="/modules/addons/ServiceNotice/templates/css/easy-alert.css">
<script type="text/javascript" src="/modules/addons/ServiceNotice/templates/js/jQuery.succinct.js"></script>
<script type="text/javascript" src="/modules/addons/ServiceNotice/templates/js/easy-alert.js"></script>
<script type="text/javascript" src="/modules/addons/ServiceNotice/templates/js/main.js"></script>
<script>
    window.js_trans = {
        "ConfimDelete": "{{$translate::trans('ConfimDelete')}}",
        "ActionCanceled": "{{$translate::trans('ActionCanceled')}}",
        "EditingServiceNotes": "{{$translate::trans('EditingServiceNotes')}}",
        "JsTable_sEmptyTable": "{{$translate::trans('JsTable_sEmptyTable')}}",
        "JsTable_sInfo": "{{$translate::trans('JsTable_sInfo')}}",
        "JsTable_sInfoEmpty": "{{$translate::trans('JsTable_sInfoEmpty')}}",
        "JsTable_sInfoFiltered": "{{$translate::trans('JsTable_sInfoFiltered')}}",
        "JsTable_sInfoPostFix": "{{$translate::trans('JsTable_sInfoPostFix')}}",
        "JsTable_sInfoThousands": "{{$translate::trans('JsTable_sInfoThousands')}}",
        "JsTable_sLengthMenu": "{{$translate::trans('JsTable_sLengthMenu')}}",
        "JsTable_sLoadingRecords": "{{$translate::trans('JsTable_sLoadingRecords')}}",
        "JsTable_sProcessing": "{{$translate::trans('JsTable_sProcessing')}}",
        "JsTable_sSearch": "{{$translate::trans('JsTable_sSearch')}}",
        "JsTable_sZeroRecords": "{{$translate::trans('JsTable_sZeroRecords')}}",
        "JsTable_oPaginate_sFirst": "{{$translate::trans('JsTable_oPaginate_sFirst')}}",
        "JsTable_oPaginate_sLast": "{{$translate::trans('JsTable_oPaginate_sLast')}}",
        "JsTable_oPaginate_sNext": "{{$translate::trans('JsTable_oPaginate_sNext')}}",
        "JsTable_oPaginate_sPrevious": "{{$translate::trans('JsTable_oPaginate_sPrevious')}}",
        "JsTable_all": "{{$translate::trans('JsTable_all')}}"

    };
</script>
{include file="AdminEditModal.tpl" translate=$translate}

<div class="col-sm-12">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#NoticeList" aria-controls="NoticeList" role="tab" data-toggle="tab"
               aria-expanded="true">
                {{$translate::trans('NoticeList')}}
            </a>
        </li>
        <li role="presentation" class="">
            <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"
               aria-expanded="false">
                {{$translate::trans('ActiveForServices')}}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="NoticeList">
            {include file="AdminNoticeList.tpl" adminPath=$adminPath labels=$labels translate=$translate}
        </div>
        <div role="tabpanel" class="tab-pane" id="settings">
            {include file="AdminProductList.tpl" productsGroupByGID=$productsGroupByGID translate=$translate}
        </div>
    </div>
</div>
