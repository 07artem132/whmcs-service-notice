<div id="tableBackground" class="tablebg">
    <table id="tableProductsList" width="100%" class="datatable no-margin">
        <tbody>
        <tr>
            <th>
            </th>
            <th style="width: 95%;">
                {{$translate::trans('ProductName')}}
            </th>
        </tr>
        </tbody>
    </table>
    {foreach from=$productsGroupByGID item=products key=gid}
        <table class="datatable sort-groups no-margin" width="100%" border="0">
            <tbody>
            <tr class="product text-center odd" role="row">
                <td style="background-color:#f3f3f3;text-align: left;padding-left: 15px;">
                    <input type="checkbox" name="group-{{$gid}}"
                           data-group_id="{{$gid}}"
                           title="{{$translate::trans('ClickToEnableTheModuleForThisProductGroup')}}">
                </td>
                <td style="width: 95%; background-color:#f3f3f3;">
                    <div class="prodGroup" align="left">
                        &nbsp;&nbsp;&nbsp;&nbsp;<strong>{{$translate::trans('GroupName')}}</strong>
                        {{$products[0]->groupname}}
                    </div>
                </td>
            </tr>
            </tbody>
            <tbody id="tbodyGroupProduct-{{$gid}}" data-gid="{{$gid}}" class="list-group">
            {foreach from=$products item=product}
                <tr class="product text-center">
                    <td style="width: 5%;">
                        <input type="checkbox"
                               data-pid="{{$product->id}}"
                               name="product-{{$gid}}-{{$product->id}}"
                               title="{{$translate::trans('ClickToEnableTheModuleForThisProduct')}}"
                                {if $LabelAllowForProduct->contains($product->id)}
                                    checked
                                {/if}
                        >
                    </td>
                    <td style="width: 95%;" class="text-left">
                        {{$product->productname}}
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    {/foreach}
</div>