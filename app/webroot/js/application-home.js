var getUrl = $('#base_url').val();
$(document).ready(function () {
    $('.vForm').validate({
        errorClass: 'form-error',
        rules: {
            "data[Deal][name]": "required",
            "data[Deal][pipeline_id]": "required",
            "data[Deal][stage_id]": "required",
            "data[Deal][group_id]": "required",
            "data[Task][task]": "required",
            "data[Task][deal_id]": "required",
            "data[Deal][price]": { required: true, digits: true },
            "data[Task][user_id]": "required",
            "data[Task][date]": "required",
            "data[Task][time]": "required",
        },
        messages: {"data[Deal][price]":""},
        submitHandler: function (form) {
            $('.loader').show();
            form.submit();
        }
    });
    $(".manager-home ul.droppable").sortable(
            {
                items: "li:not(.ui-state-disabled)",
                cursor: 'move',
                connectWith: "ul",
                receive: function (e, ui) {
                    var dealId = ui.item.context.id;
                    var stageId = ui.item.context.parentElement.id;
                    var parentId = ui.sender.context.id;
                    $.ajax({
                        url: 'Deals/stage',
                        type: 'POST',
                        data: {dealId: dealId, stageId: stageId, parentId: parentId}

                    });
                }
            });
    $(".task-dashboard ul.droppable").sortable(
            {
                items: "li:not(.ui-state-disabled)",
                cursor: 'move',
                connectWith: "ul",
                receive: function (e, ui) {
                    var taskId = ui.item.context.id;
                    var stageId = ui.item.context.parentElement.id;
                    var parentId = ui.sender.context.id;
                    $.ajax({
                        url: getUrl + 'tasks/dashboard',
                        type: 'GET',
                        dataType: 'json',
                        data: {taskId: taskId, stageId: stageId, parentId: parentId},
                        success: function (data) {
                            if (data.bug == '0') {
                                $('.task-date').text(data.date);
                            }
                        }
                    });
                }
            });

    $('#DealPipelineId').change(function () {
        $('#DealStageId').load('Stages/lists/' + $(this).val());
    });

    $('.slimScrollDiv').css('overflow', '');
    $(document).on('submit', 'form.vForm1', function () {
        $('.loader').show();
    });
    function fieldU(fieldId, id) {
        $("#" + fieldId).val(id);
    }
    $('.select-box-search').select2();
    $('.select-box-label').select2({
        templateResult: function (state) {
            var originalOption = state.element;
            if (!state.id)
                return state.text; // optgroup
            return '<span class="select-label ' + $(originalOption).data('color') + '"> </span> ' + state.text;
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });
    setTimeout(function () {
        $('#successMessage').fadeOut('fast');
    }, 800);
    setTimeout(function () {
        $('#failMessage').fadeOut('fast');
    }, 800);
    $('.search-data').typeahead({
        source: function (query, process) {
            var action = this.$element.attr('data-name');
            var dataId = this.$element.attr('id');
            return   $.ajax({
                type: "POST",
                url: "" + action + "/search?name=" + query,
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
            location.href = "" + action + "/view/" + vId;
            return selectData;

        }
    });

    $('.stage-inner').slimScroll({
        height: '600px',
        alwaysVisible: true
    });
    $('.slimScrollDiv').css('overflow', 'visible');
    $(document).on('click', '.view-modal', function (e) {
        var dealId = $(this).attr('data-id');
        var action = $(this).attr('data-name');
        var dealName = $(this).attr('data-deal');
        $('#uDealM .modal-title').text(dealName);
        $('#uDealM #mBody').html('<div class="loader-modal"></div>');
        $.ajax({
            type: "POST",
            url: "admins/" + action + "/" + dealId,
            data: {dealId: dealId},
            success: function (data) {
                $('#uDealM #mBody').html(data);

            }
        });
    });
    $('#uDealSM').on('show.bs.modal', function (e) {
        var dealId = $(e.relatedTarget).attr('data-id');
        var action = $(e.relatedTarget).attr('data-name');
        $('#uDealSM .modal-title').text(action);
        $('#uDealSM #mBody').html('<div class="loader-modal"></div>');
        $.ajax({
            type: "POST",
            url: "admins/" + action + "/" + dealId,
            data: {control: 0},
            success: function (data) {
                $('#uDealSM #mBody').html(data);

            }
        });
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
    

    $('body').on('click', '.load_more', function () {
        var stageId = $(this).attr('data-id');
        var page = $('#stage_' + stageId).val();
        $(this).hide(); //hide load more button on click
        $('.stage-inner #' + stageId + ' .animation_image').show(); //show loading image 
        if (page != '0') {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "admins/load?stage=" + stageId + "&page=" + page,
                success: function (data) {
                    $('.stage-inner #' + stageId + ' .load-li').remove();
                    $('.stage-inner   #' + stageId).append(data.deals);
                    $('#stage_' + stageId).val(data.page);
                }
            });
        }
    });
    $('[ref="popover"]').popover({
        trigger: 'hover',
        placement: 'top'
    });
    $(document).on("click", '.language-li', function (e) {
        $('.loader').show();
        var lng = $(this).attr("data-lng");
        $.ajax({
            type: "POST",
            url: "settings/language/" + lng,
            success: function (data) {
                location.reload();
            }
        });
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

});
$('.datepickerDateT').datepicker({format: 'dd-mm-yyyy', autoclose: true}).datepicker("setDate", new Date());
$('#timepicker').timepicker({
}).focus(function () {
    $(this).next().trigger('click');
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
                $('#delM').modal('hide');
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
$(document).on("click", '.an-alert .close', function (e) {
    var id = $(this).attr("data-id");
    $.ajax({
        type: "GET",
        url: "announcements/read/" + id,
        dataType: 'json',
        success: function (data) {
        }
    });

});