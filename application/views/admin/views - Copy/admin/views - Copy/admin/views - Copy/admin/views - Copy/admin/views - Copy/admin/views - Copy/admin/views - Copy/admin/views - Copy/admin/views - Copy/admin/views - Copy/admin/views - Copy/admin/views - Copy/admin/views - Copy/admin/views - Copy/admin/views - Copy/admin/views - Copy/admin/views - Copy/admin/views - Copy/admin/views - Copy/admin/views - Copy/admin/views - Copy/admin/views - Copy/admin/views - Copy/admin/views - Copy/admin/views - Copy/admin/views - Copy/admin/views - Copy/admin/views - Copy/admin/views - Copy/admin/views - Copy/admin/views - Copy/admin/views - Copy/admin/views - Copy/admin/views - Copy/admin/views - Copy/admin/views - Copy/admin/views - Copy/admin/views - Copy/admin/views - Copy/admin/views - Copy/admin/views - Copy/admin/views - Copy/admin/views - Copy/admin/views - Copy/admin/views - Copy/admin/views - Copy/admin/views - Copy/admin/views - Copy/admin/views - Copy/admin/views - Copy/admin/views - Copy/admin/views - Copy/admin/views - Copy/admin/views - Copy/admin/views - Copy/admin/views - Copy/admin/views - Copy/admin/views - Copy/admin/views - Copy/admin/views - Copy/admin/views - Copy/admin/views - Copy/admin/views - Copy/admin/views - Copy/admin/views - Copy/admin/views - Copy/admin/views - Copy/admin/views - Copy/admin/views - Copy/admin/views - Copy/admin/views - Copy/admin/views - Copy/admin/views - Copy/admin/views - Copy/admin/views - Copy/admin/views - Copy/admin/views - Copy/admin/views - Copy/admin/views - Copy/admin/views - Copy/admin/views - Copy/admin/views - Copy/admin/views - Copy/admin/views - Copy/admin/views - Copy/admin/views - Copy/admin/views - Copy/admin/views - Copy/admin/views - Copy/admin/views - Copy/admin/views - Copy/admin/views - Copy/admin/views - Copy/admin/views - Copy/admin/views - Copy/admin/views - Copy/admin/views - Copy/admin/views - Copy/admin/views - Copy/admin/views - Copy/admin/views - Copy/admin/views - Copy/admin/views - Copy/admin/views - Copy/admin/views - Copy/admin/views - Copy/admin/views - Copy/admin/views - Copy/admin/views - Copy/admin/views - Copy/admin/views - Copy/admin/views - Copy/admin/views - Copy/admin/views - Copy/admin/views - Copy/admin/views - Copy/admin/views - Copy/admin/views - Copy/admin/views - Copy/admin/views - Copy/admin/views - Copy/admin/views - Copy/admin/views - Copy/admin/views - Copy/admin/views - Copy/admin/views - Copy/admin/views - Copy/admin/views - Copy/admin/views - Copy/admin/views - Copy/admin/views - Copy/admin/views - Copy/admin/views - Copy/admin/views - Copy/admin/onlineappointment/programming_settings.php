<script src="<?php echo base_url(); ?>backend/custom/jquery.validate.min.js"></script>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-2">
                <?php
                  $this->load->view('admin/onlineappointment/appointmentSidebar');
                ?> 
            </div>
            <div class="col-md-10">
                <?php if ($this->rbac->hasPrivilege('online_appointment_slot', 'can_view')) { ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Bloqueos realizados</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lock_modal">
                                Bloquear agendas
                            </button>
                        </div>
                    </div>
                     <div class="box-body">
                        <form action="<?php echo site_url('admin/onlineappointment/') ?>" id="doctor_form" method="post" accept-charset="utf-8">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                            </div>
                        </form>
                        <div class="content">
                             <table class="table table-striped table-bordered table-hover ajaxlist" data-export-title="<?php echo $this->lang->line('appointment_details'); ?>" >
                                 <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>INICIO</th>
                                      <th>FIN</th>
                                      <th>RAZON</th>
                                      <th>DOCTOR</th>
                                      <th>FECHA</th>
                                      <th>ACCIONES</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                             </table>
                        </div>
                     </div>
                </div>
               <?php } ?>
           </div>
        </div>
    </section>
</div>

<div class="modal fade" id="lock_modal"  aria-labelledby="myModalLabel">
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
                    <select id="doctor_id"  name="" class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true">
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
                         <option value="Todos" selected>Todos</option>
                         <option value="Monday">Lunes</option>
                         <option value="Tuesday">Martes</option>
                         <option value="Wednesday">Miércoles</option>
                         <option value="Thursday">Jueves</option>
                         <option value="Friday">Viernes</option>
                         <option value="Saturday">Sábado</option>
                         <option value="Sunday">Domingo</option>
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
                    <label for="reason_lock">Razón de bloqueo de Agenda</label>
                    <textarea class="form-control" rows="3" id="reason_lock" name="reason_lock" style="resize: none;"></textarea>
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


<div class="modal fade" id="edit_lock_modal"  aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-media-content">
        <div class="modal-header modal-media-header">
            <button type="button" class="close pupclose" data-dismiss="modal">×</button>
            <h4 class="modal-title">Editar bloqueo</h4> 
        </div>
       <div class="modal-body pb0">
         <form id="edit_lock_form" accept-charset="utf-8" method="post">
            <input type="hidden" id="id_lock_calendar" name="id_lock_calendar">
           
            <div class="row">
                <div class="col-lg-3">
                  <div class="input-group">
                    <select id="edit_doctor_id"  name="" class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true">
                        <option value="" hidden>Todos los doctores</option> 
                        <?php foreach ($doctors as $key => $value): ?>
                        <option  value="<?= $value['id'] ?>"><p class="capitalize">
                          <?php echo ucwords(strtolower($value["name"] . " " . $value["surname"] ." (". $value["employee_id"].")")) ?></p></option> 
                        <?php endforeach ?>
                    </select>
                  </div>
                </div>
               
<!--                 <div class="col-lg-3">
                    <select id="edit_day_selected" class="form-control" aria-hidden="true">
                         <option value="Todos" selected>Todos</option>
                         <option value="Monday">Lunes</option>
                         <option value="Tuesday">Martes</option>
                         <option value="Wednesday">Miércoles</option>
                         <option value="Thursday">Jueves</option>
                         <option value="Friday">Viernes</option>
                         <option value="Saturday">Sábado</option>
                         <option value="Sunday">Domingo</option>
                    </select>
                </div> -->
                 
                <div class="col-lg-3">
                  <div class="input-group">
                    <input type="text" id="edit_start_lock" name="edit_start_lock" class="form-control time_from date" aria-invalid="false" placeholder="Fecha inicial" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;">
                    <div class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>    
                </div>
               
                <div class="col-lg-3">
                  <div class="input-group">
                    <input type="text" id="edit_end_lock" name="edit_end_lock" class="form-control time_from date" aria-invalid="false" placeholder="Fecha final" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;">
                    <div class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              
               <div class="col-lg-3">
                    <select id="edit_status" class="form-control" aria-hidden="true">
                         <option value="" selected>Estado</option>
                         <option value="1">Activo</option>
                         <option value="0">Inactivo</option>
                    </select>
                </div>
               
                <div class="col-lg-12" style="margin-top: 5px;">
                  <div class="form-group">
                    <label for="edit_lock_reason">Razón de bloqueo de Agenda</label>
                    <textarea class="form-control" rows="3" id="edit_lock_reason" name="lock_reason" style="resize: none;"></textarea>
                  </div>
                </div>
            </div>
           
         </form>
         
       </div>
       <div class="modal-footer">
          <div class="pull-right">
            <button type="submit" id="edit_lock_btn" form="edit_lock_form" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-sm"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
          </div>
          <div class="pull-right" style="margin-right: 10px;">
              <button type="submit" data-loading-text="<?php echo $this->lang->line('processing') ?>" name="save_print" class="btn pull-right btn-sm"><i class="fa fa-print"></i> <?php echo $this->lang->line('save_print'); ?></button>
          </div>
       </div>
    </div>
  </div>
</div>
          
          
<script type="text/javascript">
  
  
  function get_lock_doctor(data){
      console.log(data);

      let id_lock = document.getElementById('id_lock_calendar');
      let edit_lock_reason = document.getElementById('edit_lock_reason');
      let edit_start_lock = document.getElementById('edit_start_lock');
      let edit_end_lock = document.getElementById('edit_end_lock');
      let edit_doctor_id = document.getElementById('edit_doctor_id');
      let edit_status = document.getElementById('edit_status');
      let event = new Event('change', { bubbles: true });

    
      id_lock.value = data.id_lock_calendar;

      edit_doctor_id.value = data.id_doctor;
      edit_doctor_id.dispatchEvent(event);
    
      edit_status.value = data.status;

      edit_start_lock.value = new Date(data.start_date).toLocaleDateString('en-US', {day: '2-digit', month: '2-digit', year: 'numeric', timeZone: 'UTC'});
      edit_start_lock.dispatchEvent(event);
      edit_end_lock.value = new Date(data.end_date).toLocaleDateString('en-US', {day: '2-digit', month: '2-digit', year: 'numeric', timeZone: 'UTC'});
      edit_end_lock.dispatchEvent(event);
      edit_lock_reason.value = data.blocking_reason;

  }
  

 document.addEventListener('DOMContentLoaded', function () {
    'use strict';
   
      const doctor_id = document.getElementById('doctor_id');
      const edit_doctor_id = document.getElementById('edit_doctor_id');
   
//       function doctor_days(id_doctor){
           
//              let day_selected = document.getElementById('day_selected');
//              let edit_day_selected = document.getElementById('edit_day_selected');

//              $.ajax({
//                   url: '<?= base_url("admin/appointment/hidden_days") ?>',
//                   data : {
//                     id_doctor: id_doctor
//                   },
//                   type: 'POST',
//                   dataType: 'json',
//                   success:(resp)=> {
//                       console.log(resp);
//                       let translate_days = {
//                           'Monday': 'Lunes',
//                           'Tuesday': 'Martes',
//                           'Wednesday': 'Miércoles',
//                           'Thursday': 'Jueves',
//                           'Friday': 'Viernes',
//                           'Saturday': 'Sábado',
//                           'Sunday': 'Domingo'
//                       };
//                       let options_days = '<option value="Todos" selected>Todos</option>';
//                       for(let day of Object.values(resp.doctor_days)){
//                           options_days += `<option value="${day}">${translate_days[day]}</option>`;
//                       }
                    
//                       day_selected.innerHTML = options_days;
//                       edit_day_selected.innerHTML = options_days;

// //                       let message = '';
// //                       if(resp.state === 'fail'){
// //                           for (const error of Object.values(resp.errors)) {
// //                               message += error+'<br>';
// //                           }
// //                           errorMsg(message);
// //                       } else {
// //                           message = resp.msg;
// //                           successMsg(message);
// //                       }
//                   },
//                   error: function() {
//                     console.error("No es posible completar la operación");
//                   }
//               });
        
//       }
   
//      doctor_id.addEventListener('change', function(e) {
//           e.preventDefault();
//           doctor_days(doctor_id.value);
//      });

//      edit_doctor_id.addEventListener('change', function(e) {
//           e.preventDefault();
//           doctor_days(edit_doctor_id.value);
//      });

   
     document.getElementById('lock_form').addEventListener("submit", function (e) {
        e.preventDefault();
       
        let id_doctor =  document.getElementById('doctor_id').value;
        let start_time =  document.getElementById('doctor_start_lock').value;
        let end_time = document.getElementById('doctor_end_lock').value;
//         let day_selected = document.getElementById('day_selected').value;
        let reason_lock = document.getElementById('reason_lock').value;

         $.ajax({
            url: '<?php echo base_url(); ?>admin/Onlineappointment/blocked_calendar',
            data : {
//               day:day_selected,
              doctor:id_doctor,
              start: start_time,
              end:end_time,
              reason: reason_lock
            },
            type: 'POST',
            dataType: 'json',
            success:(resp)=> {
                console.log(resp.errors);
                let message = '';
                $('#lock_modal').modal('hide');
                if(resp.state === 'fail'){
                    for (const error of Object.values(resp.errors)) {
                        message += error+'<br>';
                    }
                    errorMsg(message);
                } else {
                    message = resp.msg;
                    successMsg(message);
//                     table.ajax.reload(true);
                }
            },
            error: function() {
              console.error("No es posible completar la operación");
            }
        });
     });
   
    document.getElementById('edit_lock_form').addEventListener("submit", function (e) {
        e.preventDefault();
       
        let id_lock =  document.getElementById('id_lock_calendar').value;
        let edit_doctor_id =  document.getElementById('edit_doctor_id').value;
        let edit_start_lock =  document.getElementById('edit_start_lock').value;
        let edit_end_lock = document.getElementById('edit_end_lock').value;
        let edit_status = document.getElementById('edit_status').value;
//         let edit_day_selected = document.getElementById('edit_day_selected').value;
        let edit_lock_reason = document.getElementById('edit_lock_reason').value;

         $.ajax({
            url: '<?php echo base_url(); ?>admin/Onlineappointment/update_lock_calendar',
            data : {
              id_lock: id_lock,
//               day: edit_day_selected,
              doctor: edit_doctor_id,
              start: edit_start_lock,
              end: edit_end_lock,
              reason: edit_lock_reason,
              status: edit_status
            },
            type: 'POST',
            dataType: 'json',
            success:(resp)=> {
                console.log(resp.errors);
                let message = '';
                if(resp.state === 'fail'){
                    for (const error of Object.values(resp.errors)) {
                        message += error+'<br>';
                    }
                    errorMsg(message);
                } else {
                    $('#edit_lock_modal').modal('hide');
                    message = resp.msg;
                    successMsg(message);
//                     table.ajax.reload(true);
                }
            },
            error: function() {
              console.error("No es posible completar la operación");
            }
        });
     });
   
     $(document).on('hidden.bs.modal', function (e) {
       
          console.log('entro aqui');
       
          document.getElementById('doctor_id').value = "";
          document.getElementById('doctor_start_lock').value = "";
          document.getElementById('doctor_end_lock').value = "";
//           document.getElementById('day_selected').value = "";
          document.getElementById('reason_lock').value = "";
     })
   

     initDatatable('ajaxlist', `admin/Onlineappointment/blocked_datatable`, [], [], 25);
 });
  
</script>