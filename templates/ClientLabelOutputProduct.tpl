<div class="row clearfix">
    <div class="col-xs-12">
        <ul class="nav nav-tabs nav-tabs-overflow">
            <li class="dropdown pull-right tabdrop hide">
                <i class="icon-align-justify"></i>
                <b class="caret"></b>
                <ul class="dropdown-menu"></ul>
            </li>
            <li class="active">
                <a href="#"><i class="fa fa-globe fa-fw"></i>
                    {{$translate::trans('Label')}}
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content product-details-tab-container" style="margin-bottom: 40px;">
    <div class="tab-pane fade in active text-center" id="label">
        <div class="text-center module-client-area">
            <div class="row">
                <div class="col-sm-5" style="text-align: right;">
                    <strong>
                        {{$translate::trans('Label')}}
                    </strong>
                </div>
                <div class="col-sm-7 text-left">
                    {{$label->label}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5" style="text-align: right;">
                    <strong>
                        {{$translate::trans('Comment')}}
                    </strong>
                </div>
                <div class="col-sm-7 text-left">
                    {{$label->comment}}
                </div>
            </div>
        </div>
    </div>
</div>