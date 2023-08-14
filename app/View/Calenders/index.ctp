<?php
/**
 * View for calender home page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Create Event Modal --> 
<div class="modal fade" id="eventM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Create Event'); ?></h4>
            </div>
            <?php echo $this->Form->create('Calender', array('url' => array('controller' => 'Calenders', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body tab-modal">

                <div class="tab-content">

                    <div class="form-group">
                        <?php echo $this->Form->input('Event.title', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => __('Title'))); ?>	
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('Event.description', array('type' => 'textarea', 'row' => 2, 'class' => 'form-control input-inline input-medium', 'placeholder' => __('Description'))); ?>	
                    </div>
                    <div class="form-group">
                        <div class="form-group col-sm-6">
                            <label><?php echo __('Start Date'); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php echo $this->Form->input('Event.start_date', array('type' => 'text', 'class' => 'form-control datepickerDateT', 'autocomplete' => false)); ?>	                       
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label><?php echo __('End Date'); ?></label> 
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php echo $this->Form->input('Event.end_date', array('type' => 'text', 'class' => 'form-control datepickerDate', 'autocomplete' => false)); ?>	
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->input('Event.status', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array('1' => 'Public', '2' => 'Private'))); ?>	
                    </div>
                    <div class="form-group color-button" data-toggle="buttons">
                        <label class="btn btn-1 active"><input type="radio" name="data[Event][color]" value="D9434E" checked></label>
                        <label class="btn btn-2"><input type="radio" name="data[Event][color]" value="E3643E"></label>
                        <label class="btn btn-3"><input type="radio" name="data[Event][color]" value="F59B43"></label>
                        <label class="btn btn-4"><input type="radio" name="data[Event][color]" value="F5BA42"></label>
                        <label class="btn btn-5"><input type="radio" name="data[Event][color]" value="B1C252"></label>
                        <label class="btn btn-6"><input type="radio" name="data[Event][color]" value="3BB85D"></label>
                        <label class="btn btn-7"><input type="radio" name="data[Event][color]" value="3BBEB0"></label>
                        <label class="btn btn-8"><input type="radio" name="data[Event][color]" value="3BB1D9"></label>
                        <label class="btn btn-9"><input type="radio" name="data[Event][color]" value="4B8CDC"></label>
                        <label class="btn btn-10"><input type="radio" name="data[Event][color]" value="7277D5"></label>
                        <label class="btn btn-11"><input type="radio" name="data[Event][color]" value="B276D8"></label>
                        <label class="btn btn-12"><input type="radio" name="data[Event][color]" value="D870AD"></label>
                        <label class="btn btn-13"><input type="radio" name="data[Event][color]" value="A5ADB8"></label>
                        <label class="btn btn-14"><input type="radio" name="data[Event][color]" value="31353C"></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">			
                <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Task modal -->
<div class="modal fade" id="taskM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Task Details'); ?></h4>
            </div>
            <div class="modal-body">						
            </div>
            <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Event Details modal -->
<div class="modal fade" id="upM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Event Details'); ?></h4>
            </div>
            <div class="modal-body">						
            </div>
            <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- / modal -->
<!-- Content -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Calendar'); ?></h1>
                    <div class="pull-right top-page-ui">                      
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#eventM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Create Event'); ?>
                        </a>                       
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Calender -->
                        <div id="calendar"></div>
                        <!--End Calender -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!--Theme Jquery -->
<?php echo $this->Html->css('fullcalendar.css'); ?>
<?php echo $this->Html->script('fullcalendar.min.js'); ?>
<!--End Theme Jquery -->
<script>
    $(document).ready(function () {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var calendar = $('#calendar').fullCalendar({
            disableDragging: true,                   
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            buttonText: {
                prev: '<i class="fa fa-chevron-left"></i>',
                next: '<i class="fa fa-chevron-right"></i>'
            },
            events: <?php echo $tasks; ?>,
            eventRender: function (event, element) {
                if (event.icon) {
                    element.find(".fc-event-title").prepend("<i class='fa fa-" + event.icon + "'></i> ");
                }
                if (event.events) {
                    if (event.status == 1) {
                        element.find(".fc-event-title").prepend("<i class='fa fa-globe'></i> ");
                    } else {
                        element.find(".fc-event-title").prepend("<i class='fa fa-lock'></i> ");
                    }
                }
                element.find(".closeit").click(function () {
                    $.get('calenders/delete/' + event.id, function (response) {
                        if (response.bug == '0') {
                            $('#calendar').fullCalendar('removeEvents', event._id);
                            successMsg();
                        }
                    }, 'json');
                });
            },
            eventClick: function (event) {
                if (event.icon) {
                    $.ajax({
                        type: "POST",
                        url: "calenders/task/" + event.id,
                        success: function (data) {
                            $('#taskM').modal('show');
                            $('#taskM .modal-body').html(data);
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "calenders/event/" + event.id,
                        success: function (data) {
                            $('#upM').modal('show');
                            $('#upM .modal-body').html(data);
                        }
                    });
                }
            }
        });
    });

</script>