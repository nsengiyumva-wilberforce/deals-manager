var getUrl = $('#base_url').val();
$(document).ready(function () {
    jQuery.validator.addMethod("greaterThan",
            function (value, element, params) {

                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) >= new Date($(params).val());
                }
                return isNaN(value) && isNaN($(params).val())
                        || (Number(value) >= Number($(params).val()));
            }, 'End date must be equal or greater than Start date.');
    $('.vForm').validate({
        errorClass: 'form-error',
        rules: {
            "data[Pipeline][name]": "required",
            "data[Source][name]": "required",
            "data[Contact][name]": "required",
            "data[Contact][title]": "required",
            "data[Stage][name]": "required",
            "data[Stage][pipeline_id]": "required",
            "data[Product][name]": "required",
            "data[Note][value]": "required",
            "data[Label][name]": "required",
            "data[Task][task]": "required",
            "data[Company][name]": "required",
            "data[Company][email]": "required",
            "data[Ticket][subject]": "required",
            "data[Ticket][message]": "required",
            "data[Message][message]": "required",
            "data[Deal][name]": "required",
            "data[Deal][pipeline_id]": "required",
            "data[Deal][stage_id]": "required",
            "data[Setting][title_text]": "required",
            "data[Setting][currency]": "required",
            "data[Setting][currency_symbol]": "required",
            "data[SettingCompany][name]": "required",
            "data[SettingCompany][system_email]": "required",
            "data[SettingCompany][system_email_from]": "required",
            "data[User][password]": {minlength: 6},
            "data[User][cPassword]": {minlength: 6, equalTo: "#UserPassword"},
            "data[Role][name]": "required",
            "data[Announcement][start_date]": "required",
            "data[Announcement][end_date]": {greaterThan: "#StartDate"},
            "data[Invoice][custom_id]": "required",
            "data[Invoice][issue_date]": "required",
            "data[Invoice][client_id]": "required",
            "data[Invoice][due_date]": {greaterThan: "#StartDate"},
            "data[Invoice][currency]": "required",
            "data[Invoice][discount]": {required: true, number: true},
            "data[Invoice][custom_tax]": {number: true},
            "data[Product][price]": {required: true, number: true},
            "data[Tax][name]": "required",
            "data[Tax][rate]": "required",
            "data[Custom][name]": "required",
            "data[Deal][group_id]": "required",
            "data[Task][task]": "required",
            "data[Task][deal_id]": "required",
            "data[Task][user_id]": "required",
            "data[Task][date]": "required",
            "data[Task][time]": "required",
            "data[Deal][price]": {required: true, digits: true}
        },
        messages: {"data[Deal][price]": "", "data[Product][price]": ""},
        submitHandler: function (form) {
            $('.loader').show();
            form.submit();
        }
    });

    $('.userForm').validate({
        errorClass: 'form-error',
        rules: {
            "data[User][first_name]": "required",
            "data[User][last_name]": "required",
            "data[User][email]": {required: true, email: true},
            "data[User][password]": {required: true, minlength: 6},
            "data[User][job_title]": "required",
            "data[User][group_id]": "required",
        },
        submitHandler: function (form) {
            adduser(form);
        }
    });

    function adduser(form) {
        $('.loader').show();
        $.ajax({
            type: "POST",
            url: getUrl + 'users/add',
            dataType: 'json',
            data: $(form).serialize(),
            success: function (data) {
                $('.loader').hide();
                if (data.bug == '0') {
                    $('.modal').modal('hide');
                    location.reload();
                } else {
                    $('.error-Msg').text(data.data.User.email);
                }
            }
        });
    }

    $('.vFormN').validate({
        errorClass: 'form-error',
        rules: {
            "data[SettingCompany][name]": "required",
            "data[SettingCompany][system_email]": "required",
            "data[SettingCompany][system_email_from]": "required",
            "data[Role][name]": "required",
            "data[SettingCompany][title]": "required",
            "data[SettingCompany][start_date]": "required",
            "data[SettingCompany][end_date]": "required",
            "data[InvoiceProduct][product_quantity]": {numeric: true},
            "data[SettingEmail][host]": "required",
            "data[SettingEmail][user]": "required",
            "data[SettingEmail][password]": "required",
            "data[SettingEmail][port]": "required",

        },
        submitHandler: function (form) {
            $('.loader').show();
            form.submit();
        }
    });

    $('.vEdit').editable({
        emptytext: '---',
        mode: 'inline',
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'This field is required';
            }
        }
    });

    $(".user-perm").on('click', function () {
        var id = parseInt($(this).val(), 10);
        var pipe = $('#pipeinput').val();
        if ($(this).is(":checked")) {
            var status = 1;
        } else {
            var status = 0;
        }
        $.ajax({
            type: "POST",
            url: "",
            data: "user=" + id + "&status=" + status + "&pipe=" + pipe,
            success: function (data) {
            }
        });
    });

    $(".sortabless").sortable({
        placeholder: "ui-state-highlight",
        update: function (event, ui) {
            var data = $(this).sortable('serialize');
            $.ajax({
                data: data,
                type: 'POST',
                url: 'stages/update'
            });
        }
    });
    $(".contact-letter").click(function (e) { //user clicks on button 
        $('.loader').show();//show loading image 
        $(this).parent().addClass('active-letter').siblings().removeClass('active-letter');
        var letter = $(this).text();
        var module = $(this).data('id');
        if (letter == 'All') {
            letter = '';
        }
        ;
        $.ajax({
            type: "json",
            url: getUrl + module + "/index/" + letter,
            success: function (data) {
                $('.loader').hide();
                $('.contact-list').html(data.html);
                $('#letter').val(letter)
                if (data.total <= '1')
                {
                    $(".load_contact").hide();

                } else {
                    $(".load_contact").show();
                    $('#totalPages').val(data.total);
                    $('#number').val('2')
                }

            }
        });
    });



    $(".load_contact").click(function (e) { //user clicks on button  
        $(this).hide(); //hide load more button on click
        $('.animation_image').show(); //show loading image
        var letter = $('#letter').val();
        var no = $('#number').val();
        var total_pages = $('#totalPages').val();
        var cont = $(this).attr("data-id");
        if (no <= total_pages) //user click number is still less than total pages
        {
            $.ajax({
                type: "json",
                url: getUrl + cont + "/index/page:" + no + "/" + letter,
                success: function (data) {
                    $('.load_contact').show();
                    $('.animation_image').hide();
                    $('#contacts-div .contact-list').append(data.html);
                    if (no == total_pages)
                    {
                        $(".load_contact").hide();
                    }
                    no++;
                    $('#number').val(no);
                }
            });
        }
        if (total_pages < no) {
            $('.animation_image').hide();
        }
    });

    var track_click = 1;
    var total_p = $('#totalP').val();
    $(".load_more").click(function (e) { //user clicks on button  
        $(this).hide(); //hide load more button on click
        $('.animation_image').show(); //show loading image
        if (track_click < total_p) //user click number is still less than total pages
        {
            var pipeline = $('#TaskPipelineId').val();
            var motive = $('#TaskMotiveF').val();
            $.ajax({
                type: "POST",
                url: "tasks/more?page=" + track_click + "&pipeline=" + pipeline + "&motive=" + motive,
                success: function (data) {
                    $(".load_more").show();
                    $('#tasks-table tr:last').after(data);
                    $('.animation_image').hide();
                    track_click++;
                    if (track_click == total_p)
                    {
                        $(".load_more").hide();

                    }
                }

            });
        }
        if (track_click == total_p) {
            $('.animation_image').hide();
        }
    });

    var track_clickT = 1;
    var total_timeline = $('#totalTimeline').val();
    $(".load_moreT").click(function (e) { //user clicks on button  
        $(this).hide(); //hide load more button on click
        $('.animation_image').show(); //show loading image
        if (track_clickT < total_timeline) //user click number is still less than total pages
        {
            var deal = $('#dealid').val();
            $.ajax({
                type: "POST",
                url: getUrl + "deals/more?page=" + track_clickT + "&deal=" + deal,
                success: function (data) {
                    $(".load_more").show();
                    $('.activity-inner #cd-timeline').append(data);
                    $('.animation_image').hide();
                    track_clickT++;
                    if (track_clickT == total_timeline)
                    {
                        $(".load_more").hide();

                    }
                }

            });
        }
        if (track_clickT == total_timeline) {
            $('.animation_image').hide();
        }
    });
    var track_clickT = 1;
    var total_timeline = $('#totalTimeline').val();
    $(".load_moreU").click(function (e) { //user clicks on button  
        $(this).hide(); //hide load more button on click
        $('.animation_image').show(); //show loading image
        if (track_clickT < total_timeline) //user click number is still less than total pages
        {
            var user = $('#UserId').val();
            $.ajax({
                type: "POST",
                url: getUrl + "users/more?page=" + track_clickT + "&user=" + user,
                success: function (data) {
                    $(".load_more").show();
                    $('.profile-activity #cd-timeline').append(data);
                    $('.animation_image').hide();
                    track_clickT++;
                    if (track_clickT == total_timeline)
                    {
                        $(".load_more").hide();

                    }
                }

            });
        }
        if (track_clickT == total_timeline) {
            $('.animation_image').hide();
        }
    });


    setTimeout(function () {
        $('#successMessage').fadeOut('fast');
    }, 900);
    setTimeout(function () {
        $('#failMessage').fadeOut('fast');
    }, 900);

    $("#report-form").submit(function () {
        $('.loader').show();
        $.ajax({
            type: "POST",
            url: "reports/index",
            data: $("#report-form").serialize(), // serializes the form's elements.
            success: function (data)
            {
                $('.loader').hide();
                $('#report-div').html(data);
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });

    $('#sources,#contacts,#products,#users').typeahead({
        source: function (query, process) {
            var currentId = this.$element.attr('id');
            return   $.ajax({
                type: "POST",
                url: getUrl + "" + currentId + "/search?name=" + query,
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        sources = [];
                        deal = {};
                        $.each(data, function (i, source) {
                            deal[source.name] = source;
                            sources.push(source.name);
                        });
                        return  process(sources);
                    }
                }
            });
        },
        updater: function (item) {
            $('.loader').show();
            var currentId = this.$element.attr('id');
            selectedSource = deal[item].name;
            itemId = deal[item].id;
            dealId = $('#dealid').val();
            $.ajax({
                type: "POST",
                url: getUrl + "" + currentId + "/deal",
                cache: false,
                dataType: 'json',
                data: {dealId: dealId, itemId: itemId},
                success: function (data) {
                    $('.loader').hide();
                    if (data.module == 1) {
                        $('#tab-' + currentId + ' table tbody').prepend(data.html);
                    } else {
                        $('#tab-' + currentId + ' .contact-list').prepend(data.html);
                    }
                    $('input.blank').val('');
                }
            });

        }


    });

    $('[ref="popover"]').popover({trigger: 'hover', placement: 'bottom'});

    $('.search-data').typeahead({
        source: function (query, process) {
            var action = this.$element.attr('data-name');
            var dataId = this.$element.attr('id');
            return   $.ajax({
                type: "POST",
                url: getUrl + "" + action + "/search?name=" + query,
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        sources = [];
                        deal = {};
                        $.each(data, function (i, source) {
                            deal[source.name] = source;
                            sources.push(source.name);
                        });
                        return  process(sources);
                    }
                }
            });
        },
        updater: function (item) {
            var selectData = deal[item].name;
            var action = this.$element.attr('data-name');
            var vId = deal[item].id;
            location.href = getUrl + action + "/view/" + vId;
            return selectData;

        }
    });

    $.ajax({
        type: "GET",
        url: getUrl + "messages/notifications",
        dataType: 'json',
        success: function (data) {
            $('.message-notification .m-total').html(data.notifications_total).addClass('count');
            $('.message-notification li.pointer').after(data.notifications_list);

        }
    });
    $.ajax({
        type: "GET",
        url: getUrl + "tasks/notifications",
        dataType: 'json',
        success: function (data) {
            $('.task-notification .m-total').html(data.notifications_total).addClass('count');
            $('.task-notification li.pointer').after(data.notifications_list);

        }
    });
    $('.dataTables').DataTable({
        dom: "<'datatable-tools'<'col-md-6'l><'col-md-3 custom-toolbar'B><'col-md-3'f>r>t<'datatable-tools clearfix'<'col-md-3'i><'col-md-9'p>>",
        buttons: [
            {extend: 'csv'},
            {extend: 'excel', title: 'ExampleFile'},
            {extend: 'pdf', title: 'ExampleFile'},
            {extend: 'print',
                customize: function (win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                }
            }
        ],
        order: [],
        "language": {
            lengthMenu: "_MENU_",
            info: "_START_-_END_ / _TOTAL_",
            sInfo: "_START_-_END_ / _TOTAL_",
            sInfoEmpty: "0-0 / 0",
            sInfoFiltered: "(_MAX_)",
            sInfoPostFix: "",
            sInfoThousands: ",",
            "sSearch": "",
            "searchPlaceholder": 'Search',
        }

    });
    $(document).on("click", ".add-btn", function () {
        var title = $(this).data('title');
        var cont = $(this).data('cont');
        var action = $(this).data('action');
        var id = $(this).data('id');
        $('#ajaxM .modal-title').html(title);
        $('#ajaxM').modal('show');
        $.ajax({
            type: "html",
            url: getUrl + cont + "/" + action + "/" + id,
            success: function (data) {
                //$('.loader').hide();
                $('.ajaxMContent').html(data);
                ajaxvalidation();
                selectload();
            }
        });
    });
    function ajaxvalidation() {
        $('.ajaxValidation').validate({
            errorClass: 'form-error',
            rules: {
                "data[Note][title]": "required",
                "data[Note][description]": "required"
            },
            submitHandler: function (form) {
                $('.loader').show();
                form.submit();
            }
        });
    }
    function selectload() {
        $('.select-box-search').select2();
    }
    $(document).on("click", '.del-btn', function (e) {
        $('.loader').show();
        $.ajax({
            type: "POST",
            url: $('#del-form').attr("action"),
            dataType: 'json',
            data: $('#del-form').serialize(),
            success: function (data) {
                $('.loader').hide();
                if (data.bug == '0') {
                    $('.modal').modal('hide');
                    $('#' + data.module + ' #' + data.action + data.vId).hide('slow');
                    successMsg();
                } else {
                    $('.modal').modal('hide');
                    alert(data.msg);
                }
            }
        });
    });

});
$(document).on('submit', 'form.vForm1', function () {
    $('.loader').show();
});
function fieldU(fieldId, id) {
    $("#" + fieldId).val(id);
}
function loadmodal(id) {
    $('#TaskM .modal-body').html('<div class="loader-modal"></div>');
    $.ajax({
        type: "POST",
        url: getUrl + "tasks/update?id=" + id,
        success: function (data) {
            $('#TaskM .modal-body').html(data);

        }
    });
}
$(document).on("click", '.vUpdate', function (e) {
    $('#uM .modal-body').html('<div class="loader-modal"></div>');
    var id = $(this).attr('data-id');
    var cont = $(this).attr('data-cont');
    $.ajax({
        type: "Get",
        url: getUrl + cont + "/edit/" + id,
        success: function (data) {
            $('#uM .modal-update').html(data);

        }
    });
});
$(".load-m").click(function (e) {
    var name = $(this).attr("data-name");
    var email = $(this).attr("data-email");
    $('#uM .modal-body .to-name').html(name);
    $('#uM .modal-body .to-mail').val(email);
});
$(document).on("click", '.vEdit', function (e) {
    $('.vEdit').editable({
        emptytext: '---',
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'This field is required';
            }
        }
    });
});
$(document).on("click", '.delSubmit', function (e) {
    $('.loader').show();
    var form = $(this).parents('form:first');
    $.ajax({
        type: "POST",
        url: form.attr("action"),
        dataType: 'json',
        data: form.serialize(),
        success: function (data) {
            $('.loader').hide();
            if (data.bug == '0') {
                $('.modal').modal('hide');
                var action = $('#DealAction').val();
                if (action) {
                    $('#tab-' + action + ' #row' + data.vId).hide('slow');
                } else {
                    $('#row' + data.vId).hide('slow');
                }
                successMsg();
            } else {
                $('.modal').modal('hide');
                alert(data.msg);
            }
        }
    });

});

$(document).on("click", '.delSubmitS', function (e) {
    $('.loader').show();
    var form = $(this).parents('form:first');
    $.ajax({
        type: "POST",
        url: form.attr("action"),
        dataType: 'json',
        data: form.serialize(),
        success: function (data) {
            $('.loader').hide();
            if (data.bug == '0') {
                $('.modal').modal('hide');
                $('#item-' + data.vId).hide('slow');
                successMsg();
            } else {
                $('.modal').modal('hide');
                alert(data.msg);
            }
        }
    });

});

$(document).on("click", '.delSubmitD', function (e) {
    $('.loader').show();
    var form = $(this).parents('form:first');
    $.ajax({
        type: "POST",
        url: form.attr("action"),
        dataType: 'json',
        data: form.serialize(),
        success: function (data) {
            $('.loader').hide();
            if (data.bug == '0') {
                $('.modal').modal('hide');
                $('#$action')
                $('#row' + data.vId).hide('slow');
                successMsg();
            }
        }
    });

});

$(document).on("click", '.SubmitD', function (e) {
    $('.loader').show();
    var form = $(this).parents('form:first');
    $.ajax({
        type: "POST",
        url: form.attr("action"),
        dataType: 'json',
        data: form.serialize(),
        success: function (data) {
            location.reload();
        }
    });
});
$(document).on("click", '.submitButton', function (e) {
    $('.loader').show();
    var form = $(this).parents('form:first');
    $.ajax({
        type: "POST",
        url: form.attr("action"),
        dataType: 'json',
        data: form.serialize(),
        success: function (data) {
            $('.loader').hide();
            if (data.bug == '0') {
                $('.modal').modal('hide');
                successMsg();
            } else {
                $('.modal').modal('hide');
                failMsg();
            }
        }
    });
});

$('#uDealSM').on('show.bs.modal', function (e) {
    var dealId = $(e.relatedTarget).attr('data-id');
    var action = $(e.relatedTarget).attr('data-name');
    $('#uDealSM #mBody').html('<div class="loader-modal"></div>');
    $.ajax({
        type: "POST",
        url: getUrl + "admins/" + action + "/" + dealId,
        data: {control: 1},
        success: function (data) {
            $('#uDealSM #mBody').html(data);

        }
    });
});
$('#uUserM').on('show.bs.modal', function (e) {
    var userId = $(e.relatedTarget).attr('data-id');
    $('#uUserM .modal-body').html('<div class="loader-modal"></div>');
    $.ajax({
        type: "GET",
        url: getUrl + "users/permission/" + userId,
        success: function (data) {
            $('#uUserM .modal-body').html(data);

        }
    });
});
function successMsg()
{
    $.toaster({priority: 'success', title: 'Success', message: 'Request has Completed'});
}
function failMsg()
{
    $.toaster({priority: 'danger', title: 'Fail', message: 'Request not Completed'});
}
$('.select-box').select2({
    minimumResultsForSearch: Infinity
});
$('.select-box-search').select2();
$(".select-tags").select2({
    tags: true,
    createTag: function (params) {
        return undefined;
    }}
);
$('.select-box-label').select2({
    templateResult: function (state) {
        var originalOption = state.element;
        if (!state.id)
            return state.text;
        return '<span class="select-label ' + $(originalOption).data('color') + '"> </span> ' + state.text;
    },
    escapeMarkup: function (markup) {
        return markup;
    }
});
$('.datepickerDate').datepicker({format: 'dd-mm-yyyy', autoclose: true}).datepicker("setDate", new Date());
$('.datepickerDateT').datepicker({format: 'dd-mm-yyyy', autoclose: true}).datepicker("setDate", new Date());
$('#datepickerDate').datepicker({format: 'dd-mm-yyyy', autoclose: true}).datepicker("setDate", new Date());
$('.datepickerDates').datepicker({format: 'dd-mm-yyyy', autoclose: true}).datepicker();
$('#timepicker').timepicker({
}).focus(function () {
    $(this).next().trigger('click');
});
;
Dropzone.options.myDropzone = {
    success: function (file, response) {
        $('#tab-files table tbody').prepend(response.html);
        location.reload();
    }
};
$('.contacts-inner').slimScroll({
    height: '190px',
    alwaysVisible: true,
});
$('.tasks-inner').slimScroll({
    height: '210px',
    alwaysVisible: true,
});
$('.products-inner').slimScroll({
    height: '210px',
    alwaysVisible: true,
});
$('.message-users').slimScroll({
    height: '600px',
    alwaysVisible: true,
});
$('#message-inner').slimScroll({
    height: '450px',
    alwaysVisible: true,
});
$('.activity-inner').slimScroll({
    height: '540px',
    alwaysVisible: true,
});
$('.profile-activity').slimScroll({
    height: '812px',
    alwaysVisible: true,
});
$('.notification-inner').slimScroll({
    height: '300px',
});
$('#DealPipelineId').change(function () {
    $('#DealStageId').load(getUrl + 'Stages/lists/' + $(this).val());
});
$('.slimScrollDiv').css('overflow', '');
$('#delM').on('show.bs.modal', function (e) {
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);
    $action = $(e.relatedTarget).attr('data-action');
    $("#confirm-form").attr("action", getUrl + $action + "/unlink");
    $id = $(e.relatedTarget).attr('data-id');
    $('#ItemId').val($id);
    $('#DealAction').val($action);
});
$(document).on("click", '.language-li', function (e) {
    $('.loader').show();
    var lng = $(this).attr("data-lng");
    $.ajax({
        type: "POST",
        url: getUrl + "settings/language/" + lng,
        success: function (data) {
            location.reload();
        }
    });
});

$('.task-form').validate({
    errorClass: 'form-error',
    rules: {
        "data[Task][task]": "required",
    },
    submitHandler: function (form) {
        $('.loader').show();
        $.ajax({
            type: "POST",
            url: getUrl + 'tasks/deal',
            data: $(".task-form").serialize(),
            success: function (data) {
                $('.loader').hide();
                $('#tab-tasks table tbody').prepend(data);

            }
        });

    }
});
$('.edit-task').validate({
    errorClass: 'form-error',
    rules: {
        "data[Task][task]": "required",
    },
    submitHandler: function (form) {
        $('.loader').show();
        $.ajax({
            type: "POST",
            url: getUrl + 'tasks/edit',
            dataType: 'json',
            data: $(".edit-task").serialize(),
            success: function (data) {
                $('.loader').hide();
                $('.modal').modal('hide');
                $("#tab-tasks tr#row" + data.vId).replaceWith(data.html);

            }
        });

    }
});
$(document).on('change', 'input.task-checkbox', function () {
    var Str1 = this.id;
    Str2 = Str1.split("-");
    var taskId = parseFloat(Str2[1]);
    if ($(this).is(':checked')) {
        $(this).parents('.task-name').addClass("task-line");
        $.ajax({
            type: "POST",
            url: getUrl + "tasks/edit?id=" + taskId + "&status=1",
            dataType: 'json',
            success: function (data) {
            }
        });
    } else {
        $(this).parents('.task-name').removeClass("task-line");
        $.ajax({
            type: "POST",
            url: getUrl + "tasks/edit?id=" + taskId + "&status=0",
            dataType: 'json',
            success: function (data) {
            }
        });
    }
});
$(document).on("click", '.tab-load', function (e) {
    $('.loader').show();
    var type = $(this).attr("data-type");
    var deal = $('#dealid').val();
    var action = $(this).attr("data-action");
    $.ajax({
        type: "GET",
        url: getUrl + "deals/" + action + "?type=" + type + "&deal=" + deal,
        success: function (data) {
            $('.loader').hide();
            if (type == 1) {
                $('#tab-discussions').html(data);
            } else if (type == 2) {
                $('#tab-feedback').html(data);
            } else {
                $('#tab-invoices').html(data);
            }
        }
    });
});
$(document).on("click", '#discuss-button', function (e) {
    $(".discuss-add").toggle();
});
$(document).on("click", '.discuss-reply-button', function (e) {
    var id = $(this).attr("id");
    $(".discuss-reply-" + id).toggle();
});
$('#dealM').on('show.bs.modal', function (e) {
    $('#dealM .modal-body').html('<div class="loader-modal"></div>');
    $.ajax({
        type: "GET",
        url: getUrl + "deals/box",
        success: function (data) {
            $('#dealM .modal-body').html(data);
        }
    });
});
$(window).bind("load", function () {
});
$(document).on("click", '.closeit', function (e) {
    var id = $(this).attr('data-id');
    $('.loader').show();
    $.get('calenders/delete/' + id, function (response) {
        if (response.bug == '0') {
            location.reload();
        }
    }, 'json');
});
function ajaxform() {
    $('.vForm2').validate({
        errorClass: 'form-error',
        rules: {
            "data[Expense][amount]": "required",
        },
        submitHandler: function (form) {
            $('.loader').show();
            form.submit();
        }
    });
}
$(document).on("click", '.modal-form', function (e) {
    var title = $(this).attr('data-title');
    $('#updateM').modal('show');
    $('#updateM .modal-body').html('<div class="loader-modal"></div>');
    var id = $(this).attr('data-id');
    var cont = $(this).attr('data-cont');
    $.ajax({
        type: "POST",
        url: getUrl + cont + "/get_form",
        data: 'id=' + id,
        success: function (data) {

            $('#updateM .modal-data').html(data);
            ajaxform();
        }
    });
});

$(document).on("click", '.submitBtn', function (e) {
    $(".vForm2").submit();
});
$('#ajaxdelM').on('show.bs.modal', function (e) {
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);
    $action = $(e.relatedTarget).attr('data-action');
    $cont = $(e.relatedTarget).attr('data-cont');
    $("#del-form").attr("action", getUrl + $cont + '/' + $action);
    $id = $(e.relatedTarget).attr('data-id');
    $('#ItemId').val($id);
    $('#DealAction').val($action);
});
$(document).on('change', 'input.todo-input', function () {
    var Str1 = this.id;
    Str2 = Str1.split("-");
    var todoId = parseFloat(Str2[1]);
    if ($(this).is(':checked')) {
        $.ajax({
            type: "POST",
            url: getUrl + "todos/update?id=" + todoId + "&status=1",
            dataType: 'json',
            success: function (data) {
                location.reload();
            }
        });
    } 
});