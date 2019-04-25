var alreadyReady = false;
jQuery(document).ready(function () {
    var table = jQuery("#tableLabelsList").DataTable({
        "ordering": false,
        "dom": '<"listtable"fit>pl',
        "responsive": true,
        "oLanguage": {
            "sEmptyTable": window.js_trans.JsTable_sEmptyTable,
            "sInfo": window.js_trans.JsTable_sInfo,
            "sInfoEmpty":window.js_trans.JsTable_sInfoEmpty,
            "sInfoFiltered": window.js_trans.JsTable_sInfoFiltered,
            "sInfoPostFix": window.js_trans.JsTable_sInfoPostFix,
            "sInfoThousands": window.js_trans.JsTable_sInfoThousands,
            "sLengthMenu": window.js_trans.JsTable_sLengthMenu,
            "sLoadingRecords": window.js_trans.JsTable_sLoadingRecords,
            "sProcessing": window.js_trans.JsTable_sProcessing,
            "sSearch": window.js_trans.JsTable_sSearch,
            "sZeroRecords": window.js_trans.JsTable_sZeroRecords,
            "oPaginate": {
                "sFirst": window.js_trans.JsTable_oPaginate_sFirst,
                "sLast": window.js_trans.JsTable_oPaginate_sLast,
                "sNext": window.js_trans.JsTable_oPaginate_sNext,
                "sPrevious": window.js_trans.JsTable_oPaginate_sPrevious
            }
        },
        "pageLength": 100,
        "lengthMenu": [
            [50, 100, 500, -1],
            [50, 100, 500, window.js_trans.JsTable_all]
        ], "stateSave": true
    });
    jQuery(".dataTables_filter input").attr("placeholder", "Условие для поиска...");

    // highlight remembered filter on page re-load
    var rememberedFilterTerm = table.state().columns[4].search.search;
    if (rememberedFilterTerm && !alreadyReady) {
        // This should only run on the first "ready" event.
        jQuery(".view-filter-btns a span").each(function (index) {
            if (jQuery(this).text().trim() == rememberedFilterTerm.replace(/\\|s\*/g, '')) {
                jQuery(this).parent('a').addClass('active');
                jQuery(this).parent('a').find('i').switchClass('fa-circle-o', 'fa-dot-circle-o', 0);
            }
        });
    }
    alreadyReady = true;
});

$(function () {
    $('#EditModal').on('shown.bs.modal', function (e) {
        var tblhosting_id = $(e.relatedTarget).data('tblhosting_id');
        $('#EditModalLabel').text(window.js_trans.EditingServiceNotes + tblhosting_id);
        $('#NoticeLabel').val($.trim($('#label_' + tblhosting_id).text()));
        $('#NoticeComment').val($.trim($('#comment_' + tblhosting_id).data('full_coment')));
        $('#tblhosting_id').val(tblhosting_id);
    });

    $("#saveNotice").click(function () {
        var tblhosting_id = $('#tblhosting_id').val();
        var Label = $('#NoticeLabel').val();
        var NoticeComment = $('#NoticeComment').val();

        saveServiceNotice({
            tblhosting_id: tblhosting_id,
            label: Label,
            comment: NoticeComment
        });

        $('#label_' + tblhosting_id).text(Label);
        $('#comment_' + tblhosting_id).data('full_coment', NoticeComment).text(NoticeComment).succinct({
            size: 30
        });

    });

    $("input[name^=display_service_list]").change(function () {
        saveServiceNotice({
            tblhosting_id: $(this).data('tblhosting_id'),
            display_service_list: Number($(this).is(':checked'))
        })
    });

    $("input[name^=display_service_info]").change(function () {
        saveServiceNotice({
            tblhosting_id: $(this).data('tblhosting_id'),
            display_service_info: Number($(this).is(':checked'))
        })
    });

    $("input[name^=display_invoice_info]").change(function () {
        saveServiceNotice({
            tblhosting_id: $(this).data('tblhosting_id'),
            display_invoice_info: Number($(this).is(':checked'))
        })
    });

    $("input[name^=group]").change(function () {
        $("input[name^=product-" + $(this).data('group_id') + "-]").prop('checked', $(this).is(':checked'));
        saveServiceNotice({
            gid: $(this).data('group_id'),
            status: Number($(this).is(':checked'))
        })
    });

    $("input[name^=product]").change(function () {
        saveServiceNotice({
            pid: $(this).data('pid'),
            status: Number($(this).is(':checked'))
        })
    });

    $("tbody[id^=tbodyGroupProduct-]").each(function () {
        var bool = true;
        $(this).find("input[type=checkbox]").each(function () {
            if (!$(this).is(':checked')) {
                bool = false;
            }
        });
        $('input[name=group-' + $(this).data('gid') + ']').prop('checked', bool);
    });
});

function deleteNotice(element) {
    var tblhosting_id = $(element).data('tblhosting_id');
    var answer = confirm(window.js_trans.ConfimDelete.format(tblhosting_id));

    if (answer) {
        saveServiceNotice({
            tblhosting_id: $(element).data('tblhosting_id'),
            delete: null
        });
        $(element).closest('tr').remove();
    } else {
        alert(window.js_trans.ActionCanceled);
    }
}

function saveServiceNotice(data) {
    $.ajax({
        type: "POST",
        url: window.location.href,
        data: data,
        dataType: 'json',
        success: function (data) {
            if (data.status === 'error') {
                this.fail(data);
                return;
            }

            $.easyAlert({
                message: data.message,  //default message to be displayed
                alertType: 'success', //alert type (warning,info,danger,success)
                time: 3000, //the time to hide the alert if previous boolean is set to true in ms
                position: "t r", //preferred position
                showAnimation: 'slide', //preferred show animation if jQuery ui is included
                autoHide: true //set whether to automatically hide the alert after a period of time
            });
        },
        fail: function (data) {
            $.easyAlert({
                message: data.message,  //default message to be displayed
                alertType: 'danger', //alert type (warning,info,danger,success)
                time: 3000, //the time to hide the alert if previous boolean is set to true in ms
                position: "t r", //preferred position
                showAnimation: 'slide', //preferred show animation if jQuery ui is included
                autoHide: true //set whether to automatically hide the alert after a period of time
            });
        }
    });
}

if (!String.prototype.format) {
    String.prototype.format = function() {
        var args = arguments;
        return this.replace(/{(\d+)}/g, function(match, number) {
            return typeof args[number] != 'undefined'
                ? args[number]
                : match
                ;
        });
    };
}
