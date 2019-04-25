<div id="tableBackground" class="tablebg">
    <table id="tableLabelsList" width="100%" class="datatable no-margin">
        <thead>
        <tr>
            <th style="width: 6%;">
                {{$translate::trans('ServiceID')}}
            </th>
            <th style="width: 8%;">
                {{$translate::trans('Customer')}}
            </th>
            <th style="width: 23%;">
                {{$translate::trans('Label')}}
            </th>
            <th style="width: 27%;">
                {{$translate::trans('Comment')}}
            </th>
            <th>
                {{$translate::trans('DisplayInTheListOfServices')}}
            </th>
            <th>
                {{$translate::trans('DisplayOnTheServicePage')}}
            </th>
            <th>
                {{$translate::trans('AddToTheBillForTheService')}}
            </th>
            <th style="width: 2%;"></th>
            <th style="width: 2%;"></th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$labels item=label}
            <tr class="product text-center">
                <td class="text-left">
                    <a href="/{{$adminPath}}/clientsservices.php?userid={{$label->service->client->id}}&productselect={{$label->tblhosting_id}}">
                        {{$label->tblhosting_id}}
                    </a>
                </td>
                <td>
                    <a href="/{{$adminPath}}/clientssummary.php?userid={{$label->service->client->id}}">
                        {{$label->service->client->firstname}}
                    </a>
                </td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#EditModal"
                       data-tblhosting_id="{{$label->tblhosting_id}}"
                       id="label_{{$label->tblhosting_id}}"
                       title="{{$translate::trans('ClickToEdit')}}"
                    >
                        {{$label->label}}
                    </a>
                </td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#EditModal"
                       data-tblhosting_id="{{$label->tblhosting_id}}"
                       data-full_coment=" {{$label->comment}}"
                       id="comment_{{$label->tblhosting_id}}"
                       title="{{$translate::trans('ClickToEdit')}}"
                    >
                        {{$label->comment|truncate:30:"..."}}
                    </a>
                </td>
                <td>
                    <input type="checkbox" name="display_service_list_{{$label->tblhosting_id}}"
                           title="{{$translate::trans('EnableDisableLabelDisplayOnAllServicesListPage')}}"
                           data-tblhosting_id="{{$label->tblhosting_id}}"
                            {if $label->display_service_list}
                                checked
                            {/if}
                    >
                </td>
                <td>
                    <input type="checkbox" name="display_service_info_{{$label->tblhosting_id}}"
                           title="{{$translate::trans('EnableDisableDisplayOfCommentAndLabelOnTheServicePage')}}"
                           data-tblhosting_id="{{$label->tblhosting_id}}"
                            {if $label->display_service_info}
                                checked
                            {/if}
                    >
                </td>
                <td>
                    <input type="checkbox" name="display_invoice_info_{{$label->tblhosting_id}}"
                           title="{{$translate::trans('EnableDisableLabelAddingForServiceInvoices')}}"
                           data-tblhosting_id="{{$label->tblhosting_id}}"
                            {if $label->display_invoice_info}
                                checked
                            {/if}
                    >
                </td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#EditModal"
                       data-tblhosting_id="{{$label->tblhosting_id}}"
                       title="{{$translate::trans('ClickToEdit')}}">
                        <img src="/{{$adminPath}}/images/edit.gif" border="0" alt="{{$translate::trans('Edit')}}">
                    </a>
                </td>
                <td>
                    <a href="#"
                       onclick="deleteNotice(this);return false"
                       data-tblhosting_id="{{$label->tblhosting_id}}"
                    >
                        <img src="/{{$adminPath}}/images/delete.gif" width="16" height="16" border="0"
                             alt="{{$translate::trans('Delete')}}">
                    </a>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>