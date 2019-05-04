<script type="text/javascript" src="/modules/addons/ServiceNotice/templates/js/clientEditLabel.js"></script>
<link rel="stylesheet" type="text/css" href="/modules/addons/ServiceNotice/templates/css/clientEditLabel.css">

<form method="post" >
    <input type="hidden" id="tblhosting_id" value="{{$tblhosting_id}}">
    <div class="form-group">
        <label for="NoticeLabel">{{$translate::trans('Label')}}</label>
        <input class="form-control" name="label" id="NoticeLabel" value="{{$label}}">
    </div>
    <div class="form-group">
        <label for="NoticeComment">{{$translate::trans('Comment')}}</label>
        <textarea class="form-control" id="NoticeComment" name="comment" maxlength="400"
                  rows="6">{{$comment}}</textarea>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="display_service_list" id="display_service_list"
                    {if $display_service_list eq 1}
                        checked
                    {/if}
            >
            <label class="form-check-label" for="display_service_list">
                {{$translate::trans('DisplayInTheListOfServices')}}
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="display_service_info" id="display_service_info"
                    {if $display_service_info eq 1}
                        checked
                    {/if}
            >
            <label class="form-check-label" for="display_service_info">
                {{$translate::trans('DisplayOnTheServicePage')}}

            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="display_invoice_info" id="display_invoice_info"
                    {if $display_invoice_info eq 1}
                        checked
                    {/if}
            >
            <label class="form-check-label" for="display_invoice_info">
                {{$translate::trans('AddToTheBillForTheService')}}
            </label>
        </div>
    </div>

    <div class="modal-footer" style="border-top:none">
        <button id="saveNotice" type="button"  class="btn btn-primary" onclick="clientEditLabelValidate(this.form)"  name="save">{{$translate::trans('Save')}}</button>
    </div>
</form>
