<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="EditModalLabel">{{$translate::trans('EditingServiceNotes')}}</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="tblhosting_id">
                    <div class="form-group">
                        <label for="NoticeLabel">{{$translate::trans('Label')}}</label>
                        <input class="form-control" id="NoticeLabel">
                    </div>
                    <div class="form-group">
                        <label for="NoticeComment">{{$translate::trans('Comment')}}</label>
                        <textarea class="form-control" id="NoticeComment" maxlength="400" rows="6"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{$translate::trans('Close')}}</button>
                <button id="saveNotice" type="button" class="btn btn-primary" data-dismiss="modal">{{$translate::trans('Save')}}</button>
            </div>
        </div>
    </div>
</div>