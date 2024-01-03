<style type="text/css">
    .relative label.text-danger{position: absolute; left:5px; bottom:0;}
</style>
<div class="row clearfix">
    <div class="col-md-12 column">    
        <form method="POST" id="form_<?php echo $day; ?>" class="commentForm autoscroll">
            <input type="hidden" name="day" value="<?php echo $day; ?>">
            <input type="hidden" name="doctor" value="<?php echo $doctor; ?>">
            <input type="hidden" name="shift" value="<?php echo $shift; ?>">
            <div class="">   
                <table class="table table-bordered table-hover order-list tablewidthRS" id="tab_logic">
                    <thead>
                        <tr>
                            <th>
                                <?php echo $this->lang->line('time_from'); ?>
                            </th>
                            <th>
                                <?php echo $this->lang->line('time_to'); ?>
                            </th>
                            <th class="text-right">
                                <?php echo $this->lang->line('action') ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($prev_record)) {
                            $counter = 1;
                            foreach ($prev_record as $prev_rec_key => $prev_rec_value) {
                                ?>
                            <input type="hidden" name="prev_array[]" value="<?php echo $prev_rec_value->id; ?>">
                            <tr id='addr0'>
                                <td>
                                    <input type="hidden" name="total_row[]" value="<?php echo $counter; ?>">
                                    <input type="hidden" name="prev_id_<?php echo $counter; ?>" value="<?php echo $prev_rec_value->id; ?>">
                                    <div class="input-group">
                                        <input type="text" name="time_from_<?php echo $counter; ?>" class="form-control time_from time" id="time_from_<?php echo $counter; ?>" value="<?php echo ($prev_rec_value->start_time != "") ? $prev_rec_value->start_time :  $prev_rec_value->start_time;?>">
                                        <div class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="time_to_<?php echo $counter; ?>" class="form-control time_to time" id="time_to_<?php echo $counter; ?>" value="<?php echo ($prev_rec_value->end_time != "") ? $prev_rec_value->end_time :  $prev_rec_value->end_time;?>">
                                        <div class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right" width="30">
                                <?php if ($this->rbac->hasPrivilege('online_appointment_slot', 'can_delete')) { ?>
                                   
                                  <button class="ibtnDel btn btn-danger btn-sm btn-danger"> <i class="fa fa-trash"></i></button>
                                
                                  <?php } ?>
                                </td>
                               <td class="text-right" width="30">
                                <?php if ($this->rbac->hasPrivilege('online_appointment_slot', 'can_delete')) { ?>
                                   
                                  <button onclick="block_space()" class="btn btn-danger btn-sm btn-primary"> <i class="fas fa-user-slash"></i></button>
                                
                                  <?php } ?>
                                </td>
                            </tr>
                            <?php
                            $counter ++;
                        }
                    } else {
                        ?>
                        <tr id='addr0'>
                            <td>
                                <input type="hidden" name="total_row[]" value="<?php echo $total_count; ?>">
                                <input type="hidden" name="prev_id_<?php echo $total_count; ?>" value="0">
                                <div class="input-group">
                                    <input type="text" name="time_from_<?php echo $total_count; ?>" class="form-control time_from time" id="time_from_<?php echo $total_count; ?>" aria-invalid="false">
                                    <div class="input-group-addon">
                                        <span class="fa fa-clock-o"></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="time_to_<?php echo $total_count; ?>" class="form-control time_to time" id="time_to_<?php echo $total_count; ?>" aria-invalid="false">
                                    <div class="input-group-addon">
                                        <span class="fa fa-clock-o"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right" width="30">
                            <?php if ($this->rbac->hasPrivilege('online_appointment_slot', 'can_delete')) { ?>
                                <button class="ibtnDel btn btn-danger btn-sm btn-danger"> <i class="fa fa-trash"></i></button>
                            <?php } ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php if ($this->rbac->hasPrivilege('online_appointment_slot', 'can_add')) { ?>
            <a id="add_row" class="addrow addbtnright btn btn-primary btn-sm pull-left"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_new'); ?></a>
            <?php } ?>
            </div>
            <?php if ($this->rbac->hasPrivilege('online_appointment_slot', 'can_edit')) { ?>
                <button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" data-loading-text="<?php echo $this->lang->line('processing'); ?>" type="submit"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
            <?php } ?>
          </form>
      
          <?php if ($this->rbac->hasPrivilege('online_appointment_slot', 'can_edit')) { ?>
            <?php echo $status_blocked; ?>
              <button class="btn btn-primary btn-sm pull-right" onclick="holdModal('dateModal_<?= $day ?>')";  style="margin-right:20px;" data-loading-text="<?php echo $this->lang->line('processing'); ?>" type="button"><i class="fas fa-user-slash"></i> Bloquear</button>
          <?php } ?>
    </div>
</div>

<div class="modal fade" id="dateModal_<?= $day ?>"  aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-media-content">
        <div class="modal-header modal-media-header">
            <button type="button" class="close pupclose" data-dismiss="modal">×</button>
            <h4 class="modal-title">Bloquear agenda</h4> 
        </div>
       <div class="modal-body pb0">
         <form id="lock_form" accept-charset="utf-8" method="post">
           
            <div class="row">
              
                <div class="col-lg-3">
                  <div class="input-group">
                    <select id="doctor_id"  name="" class="form-control select2" tabindex="-1" aria-hidden="true">
                        <option value="" hidden>Todos los doctores</option> 
                        <?php foreach ($doctors as $key => $value): ?>
                        <option  value="<?= $value['id'] ?>"><p class="capitalize">
                          <?php echo ucwords(strtolower($value["name"] . " " . $value["surname"] ." (". $value["employee_id"].")")) ?></p></option> 
                        <?php endforeach ?>
                    </select>
                  </div>
                </div>
              
              
<!--                 <div class="col-lg-3">
                    <select id="day_selected" class="form-control" aria-hidden="true">
                       <?php

                              $daysTranslations = [
                                  'Monday'    => 'Lunes',
                                  'Tuesday'   => 'Martes',
                                  'Wednesday' => 'Miércoles',
                                  'Thursday'  => 'Jueves',
                                  'Friday'    => 'Viernes',
                                  'Saturday'  => 'Sábado',
                                  'Sunday'    => 'Domingo'
                              ];
                         ?>
                         <?php if($days_doctor): ?>
                               <option value="Todos" selected>Todos</option>
                               <?php foreach($days_doctor as $key => $value): ?>
                               <option value="<?= $value->day ?>" <?= $value->day === $day ? 'selected' : ''?>><?= $daysTranslations[$value->day] ?></option>
                               <?php endforeach ?>
                         <?php else: ?>
                               <?php foreach($daysTranslations as $doctor_day => $dia): ?>
                               <option value="<?=$doctor_day?>"><?= $dia ?></option>
                               <?php endforeach ?>
                               <option value="Todos" selected>Todos</option>
                         <?php endif ?>
                    </select>
                </div> -->
 
                <div class="col-lg-3">
                  <div class="input-group">
                    <input type="text" id="doctor_start_lock" name="" class="form-control time_from date" aria-invalid="false" placeholder="Fecha inicial" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;">
                    <div class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>    
                </div>

                <div class="col-lg-3">
                  <div class="input-group">
                    <input type="text" id="doctor_end_lock" name="" class="form-control time_from date" aria-invalid="false" placeholder="Fecha final" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;">
                    <div class=" input-group-addon" style="border-radius: 0px 10px 10px 0px !important;">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12" style="margin-top: 5px;">
                  <div class="form-group">
                    <label for="comment">Razón de bloqueo de Agenda</label>
                    <textarea class="form-control" rows="3" id="blocking_reason" name="blocking_reason" style="resize: none;"></textarea>
                  </div>
                </div>
            </div>

         </form>
       </div>
       <div class="modal-footer">
          <div class="pull-right">
            <button type="submit" id="lock_form_btn" form="lock_form" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-sm"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
          </div>
          <div class="pull-right" style="margin-right: 10px;">
              <button type="submit" data-loading-text="<?php echo $this->lang->line('processing') ?>" name="save_print" class="btn pull-right btn-sm"><i class="fa fa-print"></i> <?php echo $this->lang->line('save_print'); ?></button>
          </div>
       </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    var form_id = "<?php echo $day ?>";
    $(function () {
        $('form#form_' + form_id).on('submit', function (event) {
        $('form#form_' + form_id).button('loading');

            $('input[id^="time_from_"]').each(function () {
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Required"
                    }
                });
            });

            $('input[id^="time_to_"]').each(function () {
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Required"
                    }
                });
            });

            // prevent default submit action         
            event.preventDefault();

            // test if form is valid 
            if ($('form#form_' + form_id).validate().form()) {
                var target = $('.nav-tabs .active a').attr("href");
                var target_id = $('.nav-tabs .active a').attr("id");
                var ajax_data = $('.nav-tabs .active a').data();

                $.ajax({
                    type: 'POST',
                    url: base_url + "admin/onlineappointment/saveDoctorShift",
                    data: $('#form_' + form_id).serialize(),
                    dataType: 'json',
                    beforeSend: function () {

                    },
                    success: function (data) {
                        $(target).html(data.html);
                        if (data.status == 1) {
                            successMsg(data.message);
                            $(target).html("");
                            getShiftdata(target, target_id, ajax_data);
                        } else if(data.status == 3) {
                             var message = '<?php echo $this->lang->line("shift_start_time_should_be_greater_than_end_time"); ?>';
                            alert(message);
                        } else if(data.status == 4){
                            var message = '<?php echo $this->lang->line("shift_timing_overlapping"); ?>';
                            alert(message);
                        } else if(data.status == 5){
                            var message = '<?php echo $this->lang->line("time_should_be_under_global_shift"); ?>';
                            alert(message);
                        } else {
                            var list = $('<ul/>');
                            $.each(data.error, function (key, value) {
                                if (value != "") {
                                    list.append(value);
                                }
                            });
                            errorMsg(list);
                        }
                        $('form#form_' + form_id).button('reset');
                    },
                    error: function (xhr) { // if error occured

                    },
                    complete: function () {

                    }
                });
            } else {
                var message = '<?php echo $this->lang->line("does_not_validate"); ?>';
                errorMsg('<?php echo $this->lang->line("invalid_input"); ?>')
                console.log(message);
                $('form#form_' + form_id).button('reset');
            }
        });

        // initialize the validator
        $('form#form_' + form_id).validate({
            errorClass: 'text-danger'
        });
    });
  
  document.getElementById('lock_form').addEventListener("submit", function (e) {
    e.preventDefault();
    
    let id_doctor = '<?= $doctor ?>';
    let start_time = $("#doctor_start_lock").val();
    let end_time = $("#doctor_end_lock").val();
//     let day_selected = document.getElementById('day_selected').value;
    let blocking_reason = document.getElementById('blocking_reason').value;

     $.ajax({
        url: '<?php echo base_url(); ?>admin/Onlineappointment/blocked_calendar',
        data : {
//           day:day_selected,
          doctor:id_doctor,
          start: start_time,
          end:end_time,
          reason: blocking_reason
        },
        type: 'POST',
        dataType: 'json',
        success:(resp)=> {
            console.log(resp.errors);
            let message = '';
            $('#dateModal_<?= $day ?>').modal('hide');
            if(resp.state === 'fail'){
                for (const error of Object.values(resp.errors)) {
                    message += error+'<br>';
                }
                errorMsg(message);
            } else {
                message = resp.msg;
                successMsg(message);
            }
        },
        error: function() {
          console.error("No es posible completar la operación");
        }
    });
 });
  

  
 function holdModal(modalId) {

    let doctor_selected = document.getElementById("doctor").value;
    $('select[id="doctor_id"] option[value="' + doctor_selected + '"]').attr("selected", "selected");

    $('#' + modalId).modal({
      backdrop: 'static',
      keyboard: false,
      show: true
    });
  }
  
</script>