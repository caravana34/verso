<style>
  .btn{
    background:#1563B0; 
/*     color:#fff; */
    border-radius: 5px;
  }
  
  .btn:hover{
            color: #1563B0;
            background:#3387d6;
            border-left-color: #fff;
          }
  .modal-header h4 {
      color: #fff !important;
    }
    
   .modalbtnpatient {
    padding-left: 0px;
    line-height: 0px;
      }
  .name_link a:hover{
      color: #232BF7 !important;
      border-left-color: #fff !important;
    }
  
  input.form-control.error-input{
    border-color: red !important;
  }
  

</style>




<?php
$currency_symbol = $this->customlib->getHospitalCurrencyFormat();
$genderList      = $this->customlib->getGender_Patient();
date_default_timezone_set("America/Bogota");
$currentDateTime = new DateTime(); 
$result_currentDate = $currentDateTime->format('Y/m/d');
// $result_currentTime = $currentDateTime->format('H:m:s');

// echo "<pre>";
// print_r();
// exit; 

?>
<style>
  .bootstrap-datetimepicker-widget{overflow: visible !important}
</style>
<div class="content-wrapper">
  <!-- Main content --> 
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="row" style="margin: 10px;">
              <div class="row" >
              <div class="col-lg-3" >
                <h3 style="margin:0px">
                  <strong>Citas</strong>
                </h3>
              </div>
              <div class="box-tools pull-right">
                <?php if ($this->rbac->hasPrivilege('appointment', 'can_add')) {?>


                <a data-toggle="modal" data-target="#myModal" class="btn btn-sm addappointment" style="background:#1563B0; color:#fff;border-radius: 5px;"> <i class="fa fa-plus"></i> <?php echo $this->lang->line('add_appointment'); ?></a>
                <a data-toggle="modal" id="add" onclick="holdModal('myModalpa')" class="btn btn-sm addappointment" style="color:#fff;"><i class="fa fa-plus"></i> Paciente nuevo</a>
                <?php }?>
<!--                 <a href="<?php echo base_url("admin/onlineappointment/patientschedule"); ?>" class="btn btn-sm" style="background:#1563B0; color:#fff;border-radius: 5px;"><i class="fa fa-reorder"></i> Búsqueda por doctor</a>
                <a href="<?php echo base_url("admin/onlineappointment/patientqueue"); ?>" class="btn btn-sm" style="background:#1563B0; color:#fff;border-radius: 5px;"><i class="fa fa-reorder"></i> Citas del día</a> -->
              </div>
           </div>     
          </div>
            <hr>
            <div class="row" style="margin: 10px 0px 10px 0px;" >
              <div class="col-lg-12">
                <div class="col-lg-3">
                    <label for="" style="margin-right: 10px;">Fecha</label>
                    <select id="fecha_id"  onchange="enviar_fecha('limpiar')" name=""  class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true" >
                        <option value="1">Citas de Hoy</option>   
                        <option value="2">Todas las citas</option>   
                        <option value="4">Citas en los próximos 7 días</option>
                        <option value="5">Citas recientemente agendadas</option> 
                    </select>
                  </div>
                <?php if ($user_role_id != 3): ?>
                  <div class="col-lg-3">
                    <label for="fecha_inicial" style="margin-right: 10px;">Doctor</label>
                    <select id="doctor_id" onchange="enviar_fecha()" name="" class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true">
                        <option value="" hidden>Todos los doctores</option> 
                        <?php foreach ($doctors as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?php echo $value["name"] . " " . $value["surname"] ." (". $value["employee_id"].")" ?></option> 
                        <?php endforeach ?>
                    </select>
                  </div>
                <?php endif ?>
                <div class="col-lg-3">
                      <label for="fecha_inicial" style="margin-right: 10px;">Fecha Inicial</label>
                      <div class="">
                          <div class="input-group">
                              <input type="text" onchange="enviar_fecha_parametros()" value="" id="fecha_inicial" class="form-control date" name="" placeholder="Fecha Inicial" autocomplete="off" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;"><span class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;"><i class="fa fa-calendar"></i></span>
                          </div>
                          <span class="text-danger"></span>
                      </div>
                </div>
                <div class="col-lg-3">
                       <label for="fecha_final" style="margin-right: 10px;">Fecha Final</label>
                      <div class="">
                          <div class="input-group"> 
                              <input type="text" onchange="enviar_fecha_parametros()" id="fecha_final" value="" class="form-control date" name="" placeholder="Fecha Final" autocomplete="off" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;"><span class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;"><i class="fa fa-calendar"></i></span>
                          </div>
                          <span class="text-danger" hidden>Ingresa fecha inicial</span>
                      </div>
                </div>
              </div>
            </div>
          
            
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="download_label"><?php echo $this->lang->line('appointed_patient_list'); ?></div>
            <div class="">
              <table class="table table-striped table-bordered table-hover ajaxlist" data-export-title="<?php echo $this->lang->line('appointment_details'); ?>" >
                <thead>
                  <tr>
                    <th width="15%"><?php echo $this->lang->line('patient_name'); ?></th>
                    <th width="10%">Documento Identidad</th>
                    <th width="15%">Motivo de consulta</th>
<!--                     <th><?php echo $this->lang->line('gender'); ?></th> -->
                    <th><?php echo $this->lang->line('source'); ?></th>
                    <th width="15%"><?php echo $this->lang->line('doctor'); ?></th>
                    <th><?php echo $this->lang->line('appointment_date'); ?></th>
                    <th width="5%">Hora de inicio</th>
                    <?php if ($this->module_lib->hasActive('live_consultation')) { ?>
                    <th><?php echo $this->lang->line('live_consultant'); ?></th>
                    
                    <?php } ?>
                    <?php 
                      if (!empty($fields)) {
                      foreach ($fields as $fields_key => $fields_value) {
                    ?>
                    <th ><?php echo $fields_value->name; ?></th>
                    <?php
                    } 
                    }
                    ?> 
                     <th width="5%">Hora de finalización</th>
                    <th width="5%">Fecha de creación</th>
                    <th width="100" class="text-right"><?php echo $this->lang->line('status'); ?></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="myModal"  aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-media-content">
      <div class="modal-header modal-media-header">
        <button type="button" class="close pt4" data-dismiss="modal">&times;</button>
        <div class="row">
          <div class="col-sm-8 col-xs-8">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-5 col-xs-9">
                    <div class="p-2 select2-full-width">
                        <select class="form-control patient_list_ajax" form="formadd" id="addpatient_id" name='patient_id'>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-1">
                    <div class=" p-2" >
                       <?php if ($this->rbac->hasPrivilege('patient', 'can_add')) {?>
                        <a data-toggle="modal" id="add" onclick="holdModal('myModalpa')" class="btn btn-sm" style="color:#fff !important;"><i class="fa fa-plus"></i>  <span><?php echo $this->lang->line('new_patient'); ?></span></a>
                        <?php }?>
                    </div>    
                </div>     
            </div>
          </div><!--./col-sm-8-->
        </div><!-- ./row -->
      </div>
      <form id="formadd" accept-charset="utf-8" method="post">
        <div class="">
        <div class="modal-body pb0">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputFile"><?php echo $this->lang->line('doctor'); ?></label>
                    <small class="req"> *</small>
                    <div>
                      <select class="form-control select2 doctor_select2" name="doctorid" onchange="getDoctorShift(this);getDoctorFees(this);get_specialist(this,'add');reset_all()" <?php
                        if ((isset($disable_option)) && ($disable_option == true)) {
                        echo 'disabled';
                        }
                        ?> name='doctor' id="doctorid" style="width:100%" >
                        <option value="<?php echo set_value('doctor'); ?>"><?php echo $this->lang->line('select') ?></option>
                        <?php foreach ($doctors as $dkey => $dvalue) {
                        ?>
                        <option value="<?php echo $dvalue["id"]; ?>" <?php
                        if ($doctor_select == $dvalue['id']) {
                        echo 'selected';
                        }
                        ?>><?php echo $dvalue["name"] . " " . $dvalue["surname"] ." (". $dvalue["employee_id"].")" ?></option>
                        <?php }?>
                      </select>
                      <input type="hidden" name="charge_id" value="" id="charge_id" />
                    </div>
                    <span class="text-danger"><?php echo form_error('doctor'); ?></span>
                  </div>
                </div>
                <div class="col-sm-3" style="display:none;">
                  <div class="form-group">
                    <label for="doctor_fees"><?php echo $this->lang->line("doctor_fees"); ?></label>
                    <small class="req"> *</small>
                    <div>   
                        <input type="text" name="amount" id="doctor_fees" class="form-control" readonly="readonly" >
                    </div>
                    <span class="text-danger"><?php echo form_error('doctor_fees'); ?></span>
                  </div>
                </div>
                <div class="col-sm-3" style="display:none;">
                    <div class="form-group">
                        <label for="pwd"><?php echo $this->lang->line('shift'); ?></label><span class="req"> *</span>
                        <select name="global_shift" id="global_shift" class="select2" style="width:100%">
                          
                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group" style="position: relative; overflow:visible !important">
                    <label><?php echo $this->lang->line('appointment_date'); ?></label>
                    <small class="req"> *</small>
                    <div class="input-group">
                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-calendar-check" style="color:#1563B0;"></i></span> 
                        <input type="text" id="datetimepicker" name="date" class="form-control date" style="border-radius: 0px 10px 10px 0px !important;">
                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="slot"><?php echo $this->lang->line('slot'); ?></label>
                        <span class="req"> *</span>
                        <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-user-clock" style="color:#1563B0;"></i></span> 
                            <select name="slot" id="slot" onchange="validateTime(this);getSlotByShift('add')" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error('slot'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3" style="display: none;">
                  <div class="form-group">
                    <label for="exampleInputFile"><?php echo $this->lang->line('appointment_priority'); ?></label>
                    <div class="input-group">
                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-poll-h" style="color:#1563B0;"></i></span>
                        <select class="form-control select2 appointment_priority_select2"  name='priority' style="width:100%; border-radius: 0px 10px 10px 0px !important;">
                          <?php foreach ($appoint_priority_list as $dkey => $dvalue) { ?>
                          <option value="<?= $result = $dvalue["appoint_priority"] == 'Normal' ? $dvalue["id"] : ''?>"> <?php echo $dvalue["appoint_priority"]; ?></option>
                          <?php }?>
                        </select>
                    </div>
                    <span class="text-danger"><?php echo form_error('doctor'); ?></span>
                  </div>
                </div>
                <div class="col-sm-3" style="display: none;">
                  <div class="form-group">
                      <label><?php echo $this->lang->line('payment_mode'); ?></label>
                      <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-poll-h" style="color:#1563B0;"></i></span>
                          <select class="form-control" name="payment_mode" style="border-radius: 0px 10px 10px 0px !important;">
                          <?php foreach ($payment_mode as $key => $value) { ?>
                              <option value="<?= $result = $value == 'Dinero en efectivo' ? $key : ''?>"><?php echo $value ?></option>
                          <?php } ?>
                          </select>    
                          <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                      </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                      <label>Responsable de consulta</label><small class="req"> *</small>
                      <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-file-invoice-dollar" style="color:#1563B0;"></i></span>
                          <select class="form-control" name="responsible" style="border-radius: 0px 10px 10px 0px !important;">
                              <option value="" hidden>Seleccione</option>
                              <option value="EPS">Eps</option>
                              <option value="PARTICULAR">Particular</option>
                              <option value="POLIZA">Poliza</option>
                          </select>    
                          <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                      </div>
                  </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="appointment_status"><?php echo $this->lang->line('status'); ?><small class="req"> *</small></label>
                        <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-exchange-alt" style="color:#1563B0;"></i></span>
                          <select name="appointment_status" onchange="appointmentstatus()" class="form-control" id="appointment_status" style="border-radius: 0px 10px 10px 0px !important;">
                              <option value="pending"><?php echo $this->lang->line('pending'); ?></option>
  <!--                             <?php foreach ($appointment_status as $appointment_status_key => $appointment_status_value) {  ?>
                              <option value="<?php echo $appointment_status_key ?>"><?php echo $appointment_status_value ?></option>
                              <?php } ?> -->
                          </select>
                       </div>
                    </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                      <label for="reason_consultation">Motivo de consulta</label><small class="req"> *</small>
                      <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-user-injured" style="color:#1563B0;"></i></span>
                          <select class="form-control" id="reason_consultation" name="reason_consultation" style="border-radius: 0px 10px 10px 0px !important;">
                          </select>    
                          <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                      </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                      <label for="type_visit">Tipo de cita</label><small class="req"> *</small>
                      <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-th-list" style="color:#1563B0;"></i></span>
                          <select class="form-control" id="type_visit" name="type_visit" style="border-radius: 0px 10px 10px 0px !important;">
                              <option value="" hidden>Seleccione</option>
                              <option value="Consulta primera vez">Consulta primera vez</option>
                              <option value="Renovacion de ordenes">Renovación de órdenes</option>
                              <option value="Renovacion de medicamentos">Renovación de medicamentos</option>
                              <option value="Otros">Otros</option>
                          </select>    
                          <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                      </div>
                  </div>
                </div>
                <div class="col-sm-3" id="other_type_visit">
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                      <label for="type_visit">Categoría Paciente</label><small class="req"> *</small>
                      <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-th-list" style="color:#1563B0;"></i></span>
                          <select class="form-control" id="category_visit" name="category_visit" style="border-radius: 0px 10px 10px 0px !important;">
                              <option value="" hidden>Seleccione</option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="C">C</option>
                          </select>    
                          <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                      </div>
                  </div>
                </div>
                <div class="cheque_div" style="display: none;">                        
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('cheque_no'); ?></label><small class="req"> *</small> 
                            <input type="text" name="cheque_no" id="cheque_no" class="form-control">
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('cheque_date'); ?></label><small class="req"> *</small> 
                            <input type="text" name="cheque_date" id="cheque_date" class="form-control date">
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('attach_document'); ?></label>
                            <input type="file" class="filestyle form-control" name="document">
                            <span class="text-danger"><?php echo form_error('document'); ?></span> 
                        </div>
                    </div>
                      
                </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="message"><?php echo $this->lang->line('message'); ?> </label>                 
                  <textarea rows="5" name="message" id="note" class="form-control" style="resize: none;"></textarea>
                  <span class="text-danger"><?php echo form_error('message'); ?></span>
                </div>
              </div>
              <?php if ($this->module_lib->hasActive('live_consultation')) { ?>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputFile"><?php echo $this->lang->line('live_consultant_on_video_conference'); ?></label>
                  <small class="req">*</small>
                  <div>
                  <select name="live_consult" id="live_consult" class="form-control">
                      <?php foreach ($yesno_condition as $yesno_key => $yesno_value) {
                          ?>
                          <option value="<?php echo $yesno_key ?>" <?php
                                  if ($yesno_key == 'no') {
                                      echo "selected";
                                  }
                                  ?> ><?php echo $yesno_value ?>
                          </option>
                          <?php } ?>
                  </select>
                  </div>
                  <span class="text-danger"><?php echo form_error('live_consult'); ?></span>
                </div>
              </div>
              <?php } ?>
              <div class="">
              <?php echo display_custom_fields('appointment',0 ); ?>
              </div>
                <div class="col-md-12">
                              
                    <div class="form-group">
                        <span id="slots_label"></span>
                    </div>
                </div>

                <input type="hidden" id="slot_id" name="slot1" />
                    <div class="col-md-12">
                       <div id="slot1"></div>
                    </div>
                </div> 
              </div><!--./row-->
            </div><!--./col-md-12-->
          </div><!--./row-->
        </div><!--./modal-body-->
         <div class="modal-footer">
            <div class="pull-right">
              <button type="submit" id="formaddbtn"  data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn" style="color:#fff;"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
            </div>
            <div class="pull-right" style="margin-right: 10px; ">
                <button type="submit"  data-loading-text="<?php echo $this->lang->line('processing') ?>" name="save_print" class="btn pull-right printsavebtn" style="color:#fff;"><i class="fa fa-print"></i> <?php echo $this->lang->line('save_print'); ?></button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- dd -->

<div class="modal fade" id="rescheduleModal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-media-content">
      <div class="modal-header modal-media-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $this->lang->line('reschedule'); ?></h4>
      </div>
      <form id="rescheduleform" accept-charset="utf-8" method="post">
        <div class="">
          <div class="modal-body pb0">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <input type="hidden" id="rdates">
                  <input type="hidden" id="message_reason">
                  <!-- inputs agregados al modal -->
                  
                  <div class="col-sm-3">
                      <div class="form-group">
                        <label for="date_time_opd">Paciente</label>
                        <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-user"></i></span> 
                            <input type="text" name="name_patient" id="name_patient" class="form-control"  style="border-radius: 0px 10px 10px 0px !important;" readonly>
                        </div>
                    </div>
                  </div> 

                  <div class="col-sm-3">
                      <div class="form-group">
                        <label for="date_time_opd">Hora</label>
                        <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-clock"></i></span> 
                            <input type="text" name="" id="r_dates_time" class="form-control"  style="border-radius: 0px 10px 10px 0px !important;" readonly>
                        </div>
                    </div>
                  </div>
                  
                 <div class="col-sm-3">
                    <div class="form-group">
                        <label>Responsable de consulta</label><small class="req"> *</small>
                        <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-file-invoice-dollar" style="color:#1563B0;"></i></span>
                            <select class="form-control" id="edit_responsible" name="edit_responsible" style="border-radius: 0px 10px 10px 0px !important;" autocomplete="off">
                                <option value="" hidden>Seleccione</option>
                                <option value="EPS">Eps</option>
                                <option value="PARTICULAR">Particular</option>
                                <option value="POLIZA">Poliza</option>
                            </select>    
                            <span class="text-danger"></span>
                        </div>
                    </div>
                  </div>
                  
                 <div class="col-sm-3">
                    <div class="form-group">
                        <label for="edit_reason_consultation">Motivo de consulta</label><small class="req"> *</small>
                        <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-user-injured" style="color:#1563B0;"></i></span>
                            <select class="form-control" id="edit_reason_consultation" name="edit_reason_consultation" style="border-radius: 0px 10px 10px 0px !important;" autocomplete="off">
                            </select>    
                            <span class="text-danger"></span>
                        </div>
                    </div>
                  </div>
                  
                 <div class="col-sm-3">
                    <div class="form-group">
                        <label for="edit_type_visit">Tipo de cita</label><small class="req"> *</small>
                        <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-th-list" style="color:#1563B0;"></i></span>
                            <select class="form-control" id="edit_type_visit" name="edit_type_visit" style="border-radius: 0px 10px 10px 0px !important;" autocomplete="off">
                                <option value="" hidden>Seleccione</option>
                                <option value="Consulta primera vez">Consulta primera vez</option>
                                <option value="Renovacion de ordenes">Renovación de órdenes</option>
                                <option value="Renovacion de medicamentos">Renovación de medicamentos</option>
                                <option value="Otros">Otros</option>
                            </select>    
                            <span class="text-danger"></span>
                        </div>
                    </div>
                  </div>
                  
                  <div class="col-sm-3" id="edit_other_visit" style="display: none;">
                      <div class="form-group">
                        <label>Otros</label>
                          <input type="text" placeholder="tipo de cita" class="form-control">
                      </div>
                  </div>

                  <!-- modal original -->
                  <input type="hidden" name="appointment_id" id="appointment_id">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputFile">
                      <?php echo $this->lang->line('doctor'); ?></label>
                      <small class="req"> *</small>
                      <div>
                        <select name="rdoctor" class="form-control" onchange="getDoctorShift(this);getDoctorFeesEdit(this);get_specialist(this,'edit');reset_all()" style="width:100%" id="rdoctor" >
                          <option value="<?php echo set_value('doctor'); ?>"><?php echo $this->lang->line('select') ?></option>
                          <?php foreach ($doctors as $dkey => $dvalue) {
                          ?>
                          <option value="<?php echo $dvalue["id"]; ?>"><?php echo $dvalue["name"] . " " . $dvalue["surname"]." (".$dvalue["employee_id"].")" ?></option>
                          <?php }?>
                        </select>
                        <span class="text-danger"><?php echo form_error('rdoctor'); ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="doctor_fees"><?php echo $this->lang->line("doctor_fees"); ?></label>
                      <small class="req"> *</small>
                      <div>   
                          <input type="" name="doctor_fees" id="rdoctor_fees_edit" class="form-control"  readonly >
                      </div>
                      <span class="text-danger"><?php echo form_error('doctor_fees'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3" style="display:none">
                    <div class="form-group">
                        <label for="pwd"><?php echo $this->lang->line('shift'); ?></label><span class="req"> *</span>
                        <select name="rglobal_shift" id="rglobal_shift_edit" onchange="" class="select2" style="width:100%">
                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                        </select>
                        <span class="text-danger"><?php echo form_error('rglobal_shift'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('appointment_date') ?></label>
                      <small class="req"> *</small>
                      <input type="text" id="dates" name="appointment_date"  class="form-control date" value="<?php echo set_value('dates'); ?>">
                      <span class="text-danger"><?php echo form_error('appointment_date'); ?></span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="slot"><?php echo $this->lang->line('slot'); ?></label>
                        <span class="req"> *</span>
                        <select name="rslot" id="rslot_edit" onchange="getSlotByShift('update')" class="form-control">
                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                        </select>
                        <input type="hidden" id="rslot_edit_field" />
                      <input type="hidden" id="time_opd" />
                        <span class="text-danger"><?php echo form_error('rslot'); ?></span>
                    </div>
                  </div>
                   <div class="col-sm-3" style="display:none;">
                    <div class="form-group">
                      <label for="exampleInputFile">
                      <?php echo $this->lang->line('appointment_priority'); ?></label>
                      <div>
                        <select class="form-control select2" name='priority' style="width:100%" id="edit_appoint_priority" >
                        <?php foreach ($appoint_priority_list as $dkey => $dvalue) {
                        ?>
                        <option value="<?php echo $dvalue["id"]; ?>"><?php echo $dvalue["appoint_priority"]; ?></option>
                        <?php }?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group">
                        <label for="appointment_status"><?php echo $this->lang->line('status'); ?><small class="req"> *</small></label>
                        <select name="edit_appointment_status" onchange="editappointmentstatus()" class="form-control" id="edit_appointment_status">
                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                            <?php foreach ($appointment_status as $appointment_status_key => $appointment_status_value) {  ?>
                            <option value="<?php echo $appointment_status_key ?>" ><?php echo $appointment_status_value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>  
                  
                   <div id="person_cancel" class="col-sm-3" style="display:none;">
                      <div class="form-group">
                            <label>Persona que cancela</label>
                            <div class="input-group">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-user"></i></span> 
                              <input type="text" name="person_cancel" id="cancel_person" style="border-radius: 0px 10px 10px 0px !important;" placeholder="" value="" class="form-control" autocomplete="off">
                            </div>
                        </div>
                   </div>
                   <div  class="col-sm-3" style="">
                     <a href='#' id ="charge_appointment" onclick="openNewWindow()"> </a>
                   </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="message"><?php echo $this->lang->line('message'); ?></label>
                      <textarea rows="5" name="message" id="message" class="form-control" style="resize: none;" ><?php echo set_value('message'); ?></textarea>
                      <span class="text-danger"><?php echo form_error('message'); ?></span>
                    </div>
                  </div>
                        <?php if ($this->module_lib->hasActive('live_consultation')) { ?>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('live_consultant_on_video_conference'); ?></label> <small class="req">*</small>
                      <select name="live_consult" id="edit_liveconsult" class="form-control">
                        <?php foreach ($yesno_condition as $yesno_key => $yesno_value) {
                            ?>
                            <option value="<?php echo $yesno_key ?>" <?php
                                    if ($yesno_key == 'no') {
                                        echo "selected";
                                    }
                                    ?> ><?php echo $yesno_value ?>
                            </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="" id="customfield" ></div> 
                   <div class="col-md-12">
                              
                    <div class="form-group">
                        <span id="edit_slots_label"></span>
                    </div>
                </div>

                <input type="hidden" id="edit_slot_id" name="edit_slot" />
                    <div class="col-md-12">
                       <div id="edit_slot"></div>
                    </div>
                  <!-- <div class="" id="customfield" ></div>  -->
                </div><!--./row-->
              </div><!--./col-md-12-->
            </div><!--./row-->
          </div><!--./modal-body-->
        </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button type="submit" id="rescheduleformbtn" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn pull-right" ><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>




<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-media-content">
      <div class="modal-header modal-media-header">
        <button type="button" class="close" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('close'); ?>" data-dismiss="modal">&times;</button>
<!--         <div class="modalicon">
          <div id="edit_delete">
            <a href="#" data-target="#editModal" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a><a href="#" data-toggle="tooltip" onclick="delete_recordById('<?php echo base_url(); ?>admin/appointment/delete/#', '<?php echo $this->lang->line('success_message') ?>')" data-original-title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" ></i></a></div>
        </div> -->
        <h4 class="modal-title"><?php echo $this->lang->line('appointment_details'); ?></h4>
      </div>
      <div class="modal-body pt0 pb0">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <form id="view" accept-charset="utf-8" method="get" class="pt5 pb5">
              <div class="table-responsive">
                <table class="table mb0 table-striped table-bordered examples">
                    <tr>
                      <th width="15%"><?php echo $this->lang->line('patient_name'); ?></th>
                      <td width="35%"><span id='patient_names'></span></td>
<!--                       <th width="15%"><?php echo $this->lang->line('appointment_no'); ?></th> -->
                      <th width="15%"><?php echo $this->lang->line('doctor'); ?></th>
                      <td width="35%"><span id='doctors'></span></td>
                    </tr>
                  
                    <tr>
                      <th width="15%"><?php echo $this->lang->line('age'); ?></th>
                      <td width="35%"><span id='patient_age'></span></td>
<!--                       <th width="15%"><?php echo 'Appointment S.No.'  ; ?></th> -->
<!--                        <td width="35%"><span id="appointmentsno"></span></td> -->
                      <th width="15%">Motivo de consulta</th>
                      <td width="35%"><span id='appointpriority'></span></td>

                    </tr>
                    <tr>
                      <th width="15%"><?php echo $this->lang->line('gender'); ?></th>
                      <td width="35%"><span id="genders"></span>
                      
                      <th width="15%">Responsable</th>
                      <td width="35%"><span id="source"></span></td>  
                      
                    </tr>

                    <tr>
                      <th width="15%"><?php echo $this->lang->line('email'); ?></th>
                      <td width="35%"><span id='emails'></span></td>
                      
                      <th width="15%">Día y hora de la cita</th>
                      <td width="35%"><span id='dating'></span></td>
                    </tr>
                     <tr>
                        <th width="15%"><?php echo $this->lang->line('phone'); ?></th>
                        <td width="35%"><span id="phones"></span> </td>
                        <th width="15%"><?php echo $this->lang->line('slot'); ?></th>
                        <td width="35%"><span id='doctor_shift_view' style="text-transform: capitalize;"></span></td>
                        </td>
                     </tr>

                    <tr>
                     <th width="15%"><?php echo $this->lang->line('department'); ?></th>
                      <td width="35%"><span id="department_name"></span></td>
                      <th width="15%"><?php echo $this->lang->line('message'); ?></th>
                      <td width="35%"><span id="messages"></span></td>
                    </tr>
                  <tr>
                     <th width="15%">Municipio</th>
                     <td width="35%"><span id="municipalities_name"></span></td>
                     <th width="15%"><?php echo $this->lang->line('status'); ?></th>
                     <td width="35%"><span id='status' style="text-transform: capitalize;"></span></td>
                    </tr>
                
                   <tr>
                      <th width="15%">Vivienda</th>
                      <td width="35%"><span id="home_name"></span></td>
                    </tr>
              

                    <?php if ($this->module_lib->hasActive('live_consultation')) { ?>
                    <tr>
                      <th width="15%"><?php echo $this->lang->line('live_consultation'); ?></th>
                      <td width="35%"><span id="liveconsult"></span></td>
<!--                       <th width="15%"><?php echo $this->lang->line('status'); ?></th>
                      <td width="35%"><span id='status' style="text-transform: capitalize;"></span></td> -->
                    </tr>
                    <?php } ?>
                    <tr>


                    </tr>
              
                     <tr  id="payrow" style="display:none">
                      <th width="15%"><?php echo $this->lang->line('cheque_no'); ?></th>
                      <td width="35%"><span id='spn_chequeno'></span></td>
                      <th width="15%"><?php echo $this->lang->line('cheque_date'); ?></th>
                      <td width="35%"><span id="spn_chequedate"></span>
                      </td>
                    </tr>
                    <tr id="paydocrow" style="display:none">
                       <th width="15%"><?php echo $this->lang->line('document'); ?></th>
                      <td width="35%" id='spn_doc'><span ></span></td>
                    </tr>
 
                  <div id="custom_fields_value">
                  </div>
              
                </table>
                  <table class="table mb0 table-striped table-bordered examples" id="field_data">
                  </table>
                  
              </div>
                <span id="id_patient" hidden></span>
                <span id="id_opd" hidden></span>
                <span id="doctor_id" hidden></span>
                <input type="text" hidden></input>
                <div class="modal-footer">
                   <div class="pull-right">
                      <?php if($user_role_id !=8): ?>
                        <button onclick="view_appointment()" type="button" class="btn" style="background:#1563B0; color:#fff;border-radius: 5px;" autocomplete="off"><i class="fa fa-check-circle"></i> VER PACIENTE</button>
                     <?php endif; ?>
                   </div>
                </div>
            </form>
          </div><!--./col-md-12-->
        </div><!--./row-->
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('admin/patient/patientupdate') ?>    
<?php $this->load->view('admin/patient/patientaddmodal') ?>
<?php $this->load->view('admin/patient/patienttest') ?>
<?php $this->load->view('admin/patient/patientPaymentAdd') ?>


<script>
   $(document).on('change','.payment_mode',function(){
      var mode=$(this).val();
      if(mode == "Cheque"){
        $('.filestyle','#addPaymentModal').dropify();
        $('.cheque_div').css("display", "block");
      }else{
        $('.cheque_div').css("display", "none");
      }
    });
  
    function view_appointment() {
      let patient = document.getElementById('id_patient').textContent;
      let opd = document.getElementById('id_opd').textContent;
      let doctorid = document.getElementById('doctor_id').textContent;
      
      console.log(doctorid);
      
      if(opd ==""){
        errorMsg("debe aprobar cita");
        $('#viewModal').modal('hide');
      }else{
        
      let base_url = "<?= base_url() ?>";
      window.location.href = `${base_url}admin/patient/visitdetails/${patient}/${opd}`;
      }
    }
</script>

<script type="text/javascript">
  $(function () {
    $('#easySelectable').easySelectable();
  })
</script>
<script type="text/javascript">
  $(function () {
    $('.select2').select2()
  });

  function holdModal(modalId) {
    $('#' + modalId).modal({
      backdrop: 'static',
      keyboard: false,
      show: true
    });
  }

  (function ($) {
    //selectable html elements
    $.fn.easySelectable = function (options) {
      var el = $(this);
      var options = $.extend({
      'item': 'li',
      'state': true,
      onSelecting: function (el) {

      },
      onSelected: function (el) {

      },
      onUnSelected: function (el) {

      }
      }, options);
      el.on('dragstart', function (event) {
        event.preventDefault();
      });
        el.off('mouseover');
        el.addClass('easySelectable');
        if (options.state) {
        el.find(options.item).addClass('es-selectable');
        el.on('mousedown', options.item, function (e) {
        $(this).trigger('start_select');
        var offset = $(this).offset();
        var hasClass = $(this).hasClass('es-selected');
        var prev_el = false;
        el.on('mouseover', options.item, function (e) {
        if (prev_el == $(this).index())
        return true;
        prev_el = $(this).index();
        var hasClass2 = $(this).hasClass('es-selected');
      if (!hasClass2) {
        $(this).addClass('es-selected').trigger('selected');
        el.trigger('selected');
        options.onSelecting($(this));
        options.onSelected($(this));
      } else {
        $(this).removeClass('es-selected').trigger('unselected');
        el.trigger('unselected');
        options.onSelecting($(this))
        options.onUnSelected($(this));
      }
      });
      if (!hasClass) {
        $(this).addClass('es-selected').trigger('selected');
        el.trigger('selected');
        options.onSelecting($(this));
        options.onSelected($(this));
      } else {
        $(this).removeClass('es-selected').trigger('unselected');
        el.trigger('unselected');
        options.onSelecting($(this));
        options.onUnSelected($(this));
      }
      var relativeX = (e.pageX - offset.left);
      var relativeY = (e.pageY - offset.top);
      });
      $(document).on('mouseup', function () {
        el.off('mouseover');
      });
      } else {
        el.off('mousedown');
      }
    };
  })(jQuery);
</script>
<script type="text/javascript">
  $(document).ready(function (e) {


//     $("form#formadd button[type=submit]").click(function() {            
//         $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
//         $(this).attr("clicked", "true");
//     });


  $("#formadd").on('submit', (function (e) {
    var did = $("#doctorid").val();
    $("#doctorinputid").val(did); 
    console.log(did);
    $("#formaddbtn").button('loading');
      e.preventDefault();
      $.ajax({
        url: baseurl+'admin/appointment/add',
        type: "POST",
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            console.log(data.status);
            if (data.status == "fail" ){
                var message = "";
                $.each(data.error, function (index, value) {
                    message += value;
                });
                errorMsg(message);
            } else {
                successMsg(data.message);
//                 enviar_fecha();
                table.ajax.reload();
                $('#myModal').modal('hide');
//                 localStorage.setItem('showAlert', data.message);
//                 window.location.reload(true);
            }
            $("#formaddbtn").button('reset');
        },
          error: function () {
        }
    });
  })); 
}); 

function printAppointment(id){
     $('#myModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $("#global_shift").select2().select2("val", '');
    });
    
    $.ajax({
            url: base_url+'admin/appointment/printAppointmentBill',
            type: "POST",
            data: {'appointment_id': id},
            dataType: 'json',
               beforeSend: function() {
                           
               },
            success: function (data) {      
           popup(data.page);
            },

             error: function(xhr) { // if error occured
          alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");    
               
      },
      complete: function() {
           
     
      }
        });
}

   function popup(data) {
        var base_url = '<?php echo base_url() ?>';
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
           
        }, 500);

        return true;
    }
$(document).ready(function (e) {
$("#formedit").on('submit', (function (e) {
  $("#formeditbtn").button('loading');
  e.preventDefault();
    $.ajax({
      url: baseurl+'admin/appointment/update',
      type: "POST",
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.status == "fail") {
        var message = "";
        $.each(data.error, function (index, value) {
        message += value;
      });
      errorMsg(message);
      } else {
        successMsg(data.message);
//         window.location.reload(true);
      }
        $("#formeditbtn").button('reset');
      },
      error: function () {

      }
    });
  }));

  $("#datetimepicker").on("change", function (e) {
    if($("#global_shift").val() != ''){
        getShift();
    }
  });

  $("#dates").on("change", function (e) {
    if($("#global_shift_edit").val() != ''){
        getShiftEdit();
    }
  });

//   $("#rdates").on("dp.change", function (e) {
//     if($("#rglobal_shift_edit").val() != ''){
//         getreschsduleShift();
//     }
//   });
  
  function restarMinutos(horaStr, minutes) {
      const [hora, minutos, segundos] = horaStr.split(":");
      let nuevaHora = parseInt(hora);
      let nuevosMinutos = parseInt(minutos) - minutes;

      if (nuevosMinutos < 0) {
        nuevaHora -= Math.ceil(Math.abs(nuevosMinutos) / 60);
        nuevosMinutos = 60 - Math.abs(nuevosMinutos) % 60;
      }

      return `${nuevaHora.toString().padStart(2, '0')}:${nuevosMinutos.toString().padStart(2, '0')}:${segundos}`;
  }
  
  
  function sumarMinutos(fechaHoraStr) {
      const [hora, minutos, segundos] = fechaHoraStr.split(":");
      let nuevaHora = parseInt(hora);
      let nuevosMinutos = parseInt(minutos) + 20;

      if (nuevosMinutos >= 60) {
        nuevaHora += Math.floor(nuevosMinutos / 60);
        nuevosMinutos %= 60;
      }

      nuevaHora %= 24; // Para asegurarnos que la hora no exceda las 24 horas

      return `${nuevaHora.toString().padStart(2, '0')}:${nuevosMinutos.toString().padStart(2, '0')}:${segundos}`;
  }
  
  function rescheduleFormHandler(e) {
      var base_url = '<?php echo base_url() ?>';
      let patient = document.getElementById('id_patient').textContent;
      let opd = document.getElementById('id_opd').textContent;
      let appointment_id = document.getElementById('appointment_id').value;
    
      // Validar si la fecha es hoy y el tiemo corresponde con la cita
      let edit_status = $("#edit_appointment_status").val();
      let edit_day = $("#dates").val();
      let time_opd = $("#time_opd").val();
      let date = "<?= $result_currentDate ?>";
      let user_role_id = "<?= $user_role_id ?>";
    
      const [month, day, year] = edit_day.split(/\D/); // Divide la cadena por cualquier caracter no numérico
      console.log(edit_day.split(/\D/));
      let new_edit_day = `${year}/${month.padStart(2, '0')}/${day.padStart(2, '0')}`;
      const final_time_opd = sumarMinutos(time_opd);
    
      const fechaActual = new Date();

      // Obtener la hora, minutos y segundos de la fecha actual
      const horaActual = fechaActual.getHours();
      const minutosActuales = fechaActual.getMinutes();
      const segundosActuales = fechaActual.getSeconds();

      // Formatear la hora actual en un string con el formato "hh:mm:ss"
      let current_time = `${horaActual.toString().padStart(2, '0')}:${minutosActuales.toString().padStart(2, '0')}:${segundosActuales.toString().padStart(2, '0')}`;

      time_opd = user_role_id == 8 ? restarMinutos(time_opd, 30) : time_opd;
//       time = user_role_id == 3 ? restarMinutos(time_opd, 10) : current_time;

      console.log(`fecha cita: ${time_opd}`);
      console.log(`fecha actual: ${current_time}`);
      $("#rescheduleformbtn").button('loading');
      e.preventDefault();

      if(true){
        
        //desarrollo cliniverso
        $.ajax({
          url: baseurl+'admin/appointment/reschedule',
          type: "POST",
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            if (data.status == "fail") {
                let message = "";
                $.each(data.error, function (index, value) {
                message += value;
              });
              errorMsg(message);
            }else{
               if(edit_status == "cancel"){
                 window.location.reload(true);
                 var message = "la cita fue cancelada"
                 errorMsg(message);
               }else if(edit_status == "approved"){
                  let msg = "Cita inicializada con exito";
                  localStorage.setItem('showAlert', data.message);
                  $.ajax({
                      url: baseurl+'admin/appointment/getDetailsAppointment',
                      type: "GET",
                      data: {appointment_id: appointment_id},
                      dataType: 'json',
                      success: function (data) {
                        console.log(data);
                        $('#preview_charges').html('');
                        $("#id_opd").html(data.opd_details_id);
//                         window.location.href = base_url+'admin/patient/visitdetails/'+patient+'/'+data.opd_details_id;
                        $('#rescheduleModal').modal('hide');
                        $("#payment_case_id").val(data.case_reference_id);
                        $("#payment_opd_id").val(data.opd_details_id);
                        $("#patient_id").val(data.patient_id);
                        table.ajax.reload();
                        var url =`${baseurl}admin/bill/index/${data.case_reference_id}`;
                        window.open(url, '_blank');
//                         $('#add_chargeModal').modal('show');myPaymentModal
//                         $('#myPaymentModal').modal('show');
                        
//                         $("#net_amount").val('22000');
//                         var charge=`<tr><td>${data.date}</td><td>${data.date}</td><td>${data.date}</td><td>${data.date}</td><td>${data.amount}</td><td>${data.date}</td></tr>`;
//                         $('#preview_charges').append(charge);
//                         var date_date = document.createTextNode(data.date);
//                         document.getElementById('id_charges_vale').appendChild(date_date);
//                         var appointment = document.createTextNode(data.appointment_no);
//                         document.getElementById('id_charges_n').appendChild(appointment);
//                         $('.print_charge').attr('data-record-id' , data.id);
//                         console.log(data.id);
                      }
                  });
               }else if(edit_status == "llegada"){
                   var message = "el paciente ha llegado"
                   successMsg(message);
                   $('#rescheduleModal').modal('hide');
                   table.ajax.reload();
               }else if(edit_status == "Confirmar"){
                   var message = "Se actualizo el estado a confirmado";
                   successMsg(message);
                   $('#rescheduleModal').modal('hide');
                   table.ajax.reload();
               }else if(edit_status == "pending"){
                   var message = "Se actualizo el estado a confirmado";
                   successMsg(message);
                   $('#rescheduleModal').modal('hide');
                   table.ajax.reload();  
               }
            }
            $("#rescheduleformbtn").button('reset');
          },
          error: function () {
//               $("#rescheduleformbtn").button('loading');
            $("#rescheduleformbtn").button('reset');
          }
        });
         
      } else{
         errorMsg(`Aun no se ha cumplido el tiempo de la cita o ya acabo.`);
         $("#rescheduleformbtn").button('reset');
      }
  }
  
  
  
 
  $("#rescheduleform").on('submit', rescheduleFormHandler);});
  
window.onload = function() {
  var showAlert = localStorage.getItem('showAlert');
  if (showAlert) {
    successMsg(showAlert);
    localStorage.removeItem('showAlert');
  }
};

function get_PatientDetails(id) {
  $("#patient_name").html("patient_name");
  $('#gender option').removeAttr('selected');
  $.ajax({
    url: baseurl+'admin/patient/patientDetails',
    type: "POST",
    data: {id: id},
    dataType: 'json',
    success: function (res) {
      if (res) {
      $('#patient_name').val(res.patient_name);
      $('#patientid').val(res.id);      
      $('#guardian_name').html(res.guardian_name);
      $('#phone').val(res.mobileno);
      $('#email').val(res.email);
      $("#age").html(res.age);
      $("#bp").html(res.bp);
      $("#month").html(res.month);
      $("#symptoms").html(res.symptoms);
      $("#known_allergies").html(res.known_allergies);
      $("#address").html(res.address);
      $("#height").html(res.height);
      $("#weight").html(res.weight);
      $("#marital_status").html(res.marital_status);
      $('#gender option[value="'+res.gender+'"]').attr("selected","selected");
    } else {
      $('#patient_name').val('');
      $('#phone').val("");
      $('#email').val("");
      $("#note").val("");
    }
  }
  });
}

function getBed(bed_group, bed = '', active, htmlid = 'bed_no') {
        var div_data = "";
        $('#' + htmlid).html("<option value='l'><?php echo $this->lang->line('loading') ?></option>");
        $("#" + htmlid).select2("val", 'l');
        $.ajax({
            url: baseurl+'admin/setup/bed/getbedbybedgroup',
            type: "POST",
            data: {bed_group: bed_group, bed_id: bed, active: active},
            dataType: 'json',
            success: function (res) {
                $.each(res, function (i, obj)
                {                  
                    div_data += "<option value=" + obj.id + ">" + obj.name + "</option>";
                });
                $("#" + htmlid).html("<option value=''><?php echo $this->lang->line('select') ?></option>");
                $('#' + htmlid).append(div_data);
                $("#" + htmlid).select2().select2('val', bed);
            }
        });
    }
  
      $("#rescheduleModal").on('hidden.bs.modal', function (e) {
        reset_all();
         
     });

    function viewreschedule(id){
      $('#rescheduleModal').modal('show');
      $('#appointment_id').val(id);
      
      $.ajax({
        url: baseurl+'admin/appointment/getDetailsAppointment',
        type: "GET",
        data: {appointment_id: id},
        dataType: 'json',
        success: function (data) {
          console.log(data);
          var result_date = data.date.split('-');
          var result = `${result_date[1]}/${result_date[2]}/${result_date[0]}`;
          console.log(result);
          $('#customfield').html(data.custom_fields_value);
          $("#name_patient").val(data.patients_name);
          $("#rdoctor").val(data.doctor);
          $("#doctor_id").val(data.doctor);
          $("#dates").val(result);
          $("#rglobal_shift_edit").val(data.shift_id);
//           $("#rdates").val(data.date);
          $("#r_dates_time").val(data.time);
//           $("#rslot_edit").val(data.shift_id);
          $("#rslot_edit_field").val(data.shift_id); 
          $("#time_opd").val(data.time);
          $("#date_time_opd").val(data.date+' '+data.time); 
          $("#id_patient").html(data.patient_id);
          $("#id_opd").html(data.opd_details_id);
          $("#message").val(data.message);
          $("#message_reason").val(data.reason_consultation);

//         $("#edit_slot").val(data.time);
          
//           $("body").delegate(".appointment_date", "focusin", function () {

//               $(this).datepicker({
//                   todayHighlight: false,
//                   format: 'yyyy-mm-dd',
//                   setDate: data.date,
//                   autoclose: true,
//               });
//           });
          
          $("#rdoctor_select").val(data.doctor).trigger("change");
          $("#edit_responsible").val(data.responsible).trigger("change");
          
          
          if(data.type_visit != 'Consulta primera vez' && data.type_visit != 'Renovacion de ordenes' && data.type_visit != 'Renovacion de medicamentos'){
                $("#edit_type_visit").val('Otros').trigger("change");
                $('select[id="edit_type_visit"] option[value="' + 'Otros' + '"]').attr("selected", "selected");
                $('#edit_type_visit').removeAttr('name');
                $('#edit_other_visit').css('display', 'block');
                $('#edit_other_visit input').attr('name', 'edit_type_visit');
                $('#edit_other_visit input').val(data.type_visit);
          } else{
              $("#edit_type_visit").val(data.type_visit).trigger("change");
              $('select[id="edit_type_visit"] option[value="' + data.type_visit + '"]').attr("selected", "selected");
          }
          
          if(data.appointment_status=="cancel"){
            $("#person_cancel").css("display", "block");
            $("#cancel_person").val(data.cancel_person);
          }

          $("#edit_appointment_status").val(data.appointment_status).trigger("change");
//           $("#rslot_edit").val(data.shift_id).trigger("change");
//           $("#edit_appoint_priority").val(data.priority).trigger("change");
          
          $('select[id="edit_responsible"] option[value="' + data.responsible + '"]').attr("selected", "selected");
          $('select[id="edit_appointment_status"] option[value="' + data.appointment_status + '"]').attr("selected", "selected");
//           $('select[id="rdoctor_select"] option[value="' + data.doctor + '"]').attr("selected", "selected");
//           $('select[id="rslot_edit"] option[value="' + data.shift_id + '"]').attr("selected", "selected");
//           $('select[id="edit_liveconsult"] option[value="' + data.live_consult + '"]').attr("selected", "selected");
          get_specialist(data.doctor,'edit');
          $("#rdoctor").trigger("change");
          $("#dates").val(result).trigger("change");

          getDoctorShift("",data.doctor,data.global_shift_id);
        }
      });
    }


function viewDetail(id) {
  $('#viewModal').modal('show');
  $.ajax({
    url: baseurl+'admin/appointment/getDetailsAppointment',
    type: "GET",
    data: {appointment_id: id},
    dataType: 'json',
    success: function (data) {
      console.log(data);
      $("#header_appoint").css("background-color", data.banner_color);
      $("#header_appoint").css("min-height", "min-height: 16.43px");
      $("#header_appoint").css("border-bottom", "1px solid");
      $("#header_appoint").css("padding", "10px 15px");
      
      var table_html = '';
      $.each(data.field_data, function (i, obj)
      {
          if (obj.field_value == null) {
            var field_value = "";
          } else {
            var field_value = obj.field_value;
          }

          var name = obj.name ;
          var is_patient = obj.visible_on_patient_panel ;
          if(is_patient==1){
            table_html += "<tr><th width='15%'><span id='vcustom_name'>" + capitalizeFirstLetter(name) + "</span></th> <td width='85%'><span id='vcustom_value'>" + field_value + "</span></td></tr><th></th><td></td>";
          }

      });
      $.each(data.custom_fields_patient, function (i, obj)
      {
          if (obj.custom_field_id == 30) {
            var field_value_phone = obj.field_value;
            $("#phones").html(field_value_phone);
          } 
        
         if (obj.custom_field_id == 4) {
            var field_value_deparment = obj.field_value;
            $("#department_name").html(field_value_deparment);
          } 
        if (obj.custom_field_id == 5) {
            var field_value_municipalities = obj.field_value;
            $("#municipalities_name").html(field_value_municipalities);
          }
        if (obj.custom_field_id == 26) {
            var field_value_home = obj.field_value;
            $("#home_name").html(field_value_home);
          }


      });
      
      var fecha = data.date.split(' ');

  $("#field_data").html(table_html);
  $("#dating").html(fecha[0] + " - " + data.time);  
  $("#appointmentno").html(data.appointment_no);
  $("#appointmentsno").html(data.appointment_serial_no);
  $("#patient_names").html(data.patients_name);
  $("#custom_fields_value").html(data.custom_fields_patient);    
  $("#genders").html(data.patients_gender);
  $("#emails").html(data.patient_email);
  $("#id_patient").html(data.patient_id);
  $("#id_opd").html(data.opd_details_id);    
  $("#appointpriority").html(data.reason_consultation);
  
  $("#doctors").html(data.name + " " + data.surname+" ("+data.employee_id+")");
  $("#messages").html(data.message);
  $("#opd_time").html(data.time);
  $("#liveconsult").html(data.edit_live_consult);
  $("#global_shift_view").html(data.global_shift_name);
  $("#doctor_shift_view").html(data.doctor_shift_name);
  $("#source").html(data.responsible);
  
  $("#payment_note").html(data.payment_note);
  $("#patient_age").html(data.patient_age);

  if(data.payment_mode=="Cheque"){
    $("#payrow").show();
    $("#paydocrow").show();
    $("#spn_chequeno").html(data.cheque_no);
    $("#spn_chequedate").html(data.cheque_date);
    $("#spn_doc").html(data.doc);
  }else{
    $("#payrow").hide();
    $("#paydocrow").hide();
    $("#spn_chequeno").html("");
    $("#spn_chequedate").html("");
  }
  

    $("#pay_amount").html('<?php echo $currency_symbol; ?>'+data.amount);
    $("#payment_mode").html(data.payment_mode);
    $("#trans_id").html(data.transaction_id);  
      
    var label = "";
    if (data.appointment_status == "approved") {
      var text = "Aprobado";
      var label = "class='label label-success'";  
    } else if (data.appointment_status == "pending") { 
      var text = "Agendado";
      var label = "class='label label-warning'";  
    } else if (data.appointment_status == "cancel") {
      var text = "Cancelado";
      var label = "class='label label-danger'";   
    } else if (data.appointment_status == "Confirmar") {
      var text = "Confirmado";
      var label = "class='label' style='background-color: #4faf74;'";   
    }else if (data.appointment_status == "Termino") {
      var text = "Termino";
      var label = "class='label' style='background-color: #779eb3;'";   
    }else if (data.appointment_status == "Termino") {
      var text = "Cerrada";
      var label = "class='label' style='background-color: ##f5d442;'";   
    }
     
      

  $("#status").html("<small " + label + " >" + text + "</small>");
  $("#edit_delete").html("<a href='#' data-toggle='tooltip'  onclick='printAppointment(" + id +")' data-original-title='<?php echo $this->lang->line('print'); ?>'><i class='fa fa-print'></i></a> <?php if ($this->rbac->hasPrivilege('appointment', 'can_delete')) {?><a href='#' data-toggle='tooltip'  onclick='delete_record(" + id +")' data-original-title='<?php echo $this->lang->line('delete'); ?>'><i class='fa fa-trash'></i></a><?php }?> ");

  },
  });
}

function delete_record(id) {
  if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
    $.ajax({
      url: baseurl+'admin/appointment/delete/' + id,
      type: "POST",
      data: {patient_id: id},
      dataType: 'json',
      success: function (res) {
        if (res.status == 'success') {
          $('#viewModal').modal('hide');
          successMsg(res.message);
          table.ajax.reload();
      }
      }
    })
  }
}

</script>
<script type="text/javascript">
  function askconfirm() {

    if (confirm("<?php echo $this->lang->line('approve_appointment'); ?>") ) {
      return true;
    } else {
      return false;
    }

  } 
  
  $('#myModal').on('hidden.bs.modal', function () {
    $(".appointment_priority_select2").select2("val", "");
    $(".doctor_select2").select2("val", "");
    $("#addpatient_id").select2("val", "");
    $('#formadd').find('input:text, input:password, input:file, textarea').val('');
    $('#formadd').find('select option:selected').removeAttr('selected');
    $('#formadd').find('input:checkbox, input:radio').removeAttr('checked');
    
  });

  $(".modalbtnpatient").click(function(){   
    $('#formaddpa').trigger("reset");
    $(".dropify-clear").trigger("click");
  });

  
  $(document).ready(function (e) {
      $('#myModal,#viewModal,#myModaledit').modal({
          backdrop: 'static',
          keyboard: false,
          show:false
      });
  });
</script> 
<script type="text/javascript">
  function appointmentstatus(){
      var appointment_status = $('#appointment_status').val();
      var doctor_id = $('#doctorid').val();    
      if(appointment_status == 'approved'){
        $.ajax({
            url: baseurl+'admin/appointment/getDoctorFees/',
            type: "POST",
            data: {doctor_id: doctor_id},
            dataType: 'json',
            success: function (res) {
              $("#doctor_fees").val(res.fees);
              $("#charge_id").val(res.charge_id);
              $("#charge_appointment").html("<h6>cobros</h6>");
          }
        });
      }else{
          $('#doctor_fees').val('0');
      }
  }
  
  function openNewWindow() {
            // The URL you want to open in the new window/tab
            

            // Open a new window/tab
//             window.open(url, '_blank');
            
        }
  
  function editappointmentstatus(){
      
      var edit_appointment_status = $('#edit_appointment_status').val();
      if(edit_appointment_status=="cancel"){
        $("#person_cancel").css("display", "block");
      }else{
        $("#person_cancel").css("display", "none");
      }
      var doctor_id = $('#rdoctor').val();    
      if(edit_appointment_status == 'approved') {
        $.ajax({
            url: baseurl+'admin/appointment/getDoctorFees/',
            type: "POST",
            data: {doctor_id: doctor_id},
            dataType: 'json',
            success: function (res) {
              console.log(res);
              $("#rdoctor_fees_edit").val(res.fees);
              $("#charge_id_edit").val(res.charge_id);
              $("#charge_appointment").html("<h6>cobros</h6>");
          }
        });
//         $("#rescheduleform").trigger('submit');
      }else{
          $('#rdoctor_fees_edit').val('0');
      }
  }

  function getDoctorFees(object){
      let doctor_id = object.value;    
     $.ajax({
      url: baseurl+'admin/appointment/getDoctorFees/',
      type: "POST",
      data: {doctor_id: doctor_id},
      dataType: 'json',
      success: function (res) {
        $("#doctor_fees").val(res.fees);
        $("#charge_id").val(res.charge_id);
        
      }
    })
  }

  function getDoctorFeesEdit(object){           
      let doctor_id = object.value;
      $.ajax({
          url: baseurl+'admin/appointment/getDoctorFees/',
          type: "POST",
          data: {doctor_id: doctor_id},
          dataType: 'json',
          success: function (res) {
            $("#doctor_fees_edit").val(res.fees);
            $("#rdoctor_fees_edit").val(res.fees);
            $("#charge_id_edit").val(res.charge_id);
             editappointmentstatus();
          }
      })
  }
</script>
<script>
  function getShift(){

      var div_data = "";
      var date = $("#datetimepicker").val();
      var doctor = $("#doctorid").val();
      var global_shift = $("#global_shift").val();
      console.log(date);
    
      $.ajax({
          url: baseurl+'admin/onlineappointment/getShift',
          type: "POST",
          data: {doctor: doctor, date: date, global_shift:global_shift},
          dataType: 'json',
          success: function(res){
              $.each(res, function (i, obj)
              {
                  div_data += "<option value=" + obj.id + ">" + obj.start_time +" - "+ obj.end_time +"</option>";
              });
              $("#slot").html("<option value=''><?php echo $this->lang->line('select'); ?></option>");
              $('#slot').append(div_data);
              
          }
      });  
      
  }

  function getShiftEdit(){

      var div_data = "";
      var date = $("#dates").val();
      var doctor = $("#rdoctor").val();
      var global_shift = $("#rglobal_shift_edit").val();
      var shift_id_ser = $("#rslot_edit_field").val();
    
    
      $.ajax({
          url: baseurl+'admin/onlineappointment/getShift',
          type: "POST",
          data: {doctor: doctor, date: date, global_shift:global_shift},
          dataType: 'json',
          success: function(res){
              $.each(res, function (i, obj)
              {
                  div_data += "<option value=" + obj.id + ">" + obj.start_time +" - "+ obj.end_time +"</option>";
              });
            
              $("#rslot_edit").html("<option value=''><?php echo $this->lang->line('select'); ?></option>");
              $('#rslot_edit').append(div_data);
              $("#rslot_edit").val($("#rslot_edit_field").val()).trigger('change');
          }
      });
  }

  function getreschsduleShift(){
    
      var div_data = "";
//       var rslot = "";
      var date = $("#rdates").val();
      var doctor = $("#rdoctor").val();
      var global_shift = $("#rglobal_shift_edit").val();
    
      $.ajax({
          url: baseurl+'admin/onlineappointment/getShift',
          type: "POST",
          data: {doctor: doctor, date: date, global_shift:global_shift},
          dataType: 'json',
          success: function(res){
              $.each(res, function (i, obj)
              {
                  div_data += "<option value=" + obj.id + ">" + obj.start_time +" - "+ obj.end_time +"</option>";
//                   rslot += obj.id;
              });
              $("#rslot_edit").html("<option value=''><?php echo $this->lang->line('select'); ?></option>");
              $('#rslot_edit').append(div_data);
              $("#rslot_edit").val($("#rslot_edit_field").val()).trigger('change');
//               $('select[id="rslot_edit"] option[value="' + rslot + '"]').attr("selected", "selected");
          }
      });
  }
  
  

  
  
  
  $(document).on('change', '#doctorid', function(event) {
    
//     console.log("cambios");
  
//       document.getElementById('slot').selectedIndex=0;
//       document.getElementById('global_shift').selectedIndex=0;
//       document.getElementById('datetimepicker').value="";
//         if(document.getElementById('datetimepicker').value=""){
          
//           document.getElementById('slot1').outerHTML="";
//         }
    });
  
  function get_specialist(id,type){
           console.log(id.value);
           console.log(type);
           let doctor_id = id.value;
           let data = [];
           data = <?php echo json_encode($doctors) ?>;
           let div_data = "";
           div_data += '<option value="" hidden>Seleccione</option>';
           let specialist_doc = "";
    
            data.forEach((i, obj) => {
              if (i.id == doctor_id) {
                console.log(i.specialist_doc);
                if (i.specialist_doc == 'Otorrinolaringologia') {
                  div_data += '<option value="Consulta Otorrinonaringologia">Consulta Otorrinonaringología</option>';
                  div_data += '<option value="Control Otorrinonaringologia">Control Otorrinonaringología</option>';
                } else if(i.specialist_doc == 'Ortopedia traumatologia') {
                  div_data += '<option value="Consulta ortopedia">Consulta ortopedia</option>';
                  div_data += '<option value="Control ortopedia">Control ortopedia</option>';
                } else if(i.specialist_doc == 'Cirugia general') {
                  div_data += '<option value="Consulta cirugía general">Consulta cirugía general</option>';
                  div_data += '<option value="Control cirugía general">Control cirugía general</option>';
                } else if(i.specialist_doc == 'Neurocirugia') {
                  div_data += '<option value="Consulta neurocirugía">Consulta neurocirugía</option>';
                  div_data += '<option value="Control neurocirugía">Control neurocirugía</option>';
                } else if(i.specialist_doc == 'Cirugia maxilofacial') {
                  div_data += '<option value="Consulta maxilofacial">Consulta maxilofacial</option>';
                  div_data += '<option value="Control maxilofacial">Control maxilofacial</option>';
                } else if(i.specialist_doc == 'Cirugia vascular') {
                  div_data += '<option value="Consulta cirugía vascular">Consulta cirugía vascular</option>';
                  div_data += '<option value="Control cirugía vascular">Control cirugia vascular</option>';
                } else if(i.specialist_doc == 'Urologia') {
                  div_data += '<option value="Consulta urología">Consulta urología</option>';
                  div_data += '<option value="Control urología">Control urología</option>';
                } else {
                  div_data += `<option value="Consulta cirugía vascular">Consulta cirugía vascular</option>
                                <option value="Control cirugía vascular">Control cirugia vascular</option>
                                <option value="Consulta maxilofacial">Consulta maxilofacial</option>
                                <option value="Control maxilofacial">Control maxilofacial</option>
                                <option value="Consulta urología">Consulta urología</option>
                                <option value="Control urología">Control urología</option>
                                <option value="Consulta neurocirugía">Consulta neurocirugía</option>
                                <option value="Control neurocirugía">Control neurocirugía</option>`;
                }
              }         
            });
    
            if(type=="add"){
              document.getElementById('reason_consultation').innerHTML = div_data;
            }else{
              var reason_consul = $("#message_reason").val();
              if(reason_consul==''){
                div_data += `<option value="" selected>Seleccione</option>`;
              }else{
                div_data += `<option value="${reason_consul}" selected>${reason_consul}</option>`;
              }
              document.getElementById('edit_reason_consultation').innerHTML = div_data;
//               select.value = reason_consul;
            }
    
           
    
  }

  function getDoctorShift(obj,doctor_id = null,global_shift_id=null){
    
      
        if(doctor_id == null){
          var doctor_id = obj.value;
        }
        var select = "";
        var select_box = "<option value=''><?php echo $this->lang->line('select'); ?></option> ";
        $.ajax({
            type: 'POST',
            url: base_url + "admin/onlineappointment/doctorshiftbyid",
            data: {doctor_id:doctor_id},
            dataType: 'json',
            success: function(res){
            
                $.each(res, function(i, list){
                    select_box += "<option value='"+ list.id +"' selected>"+ list.name +"</option>";
                });
                $("#global_shift").html(select_box);
                $("#global_shift_edit").html(select_box);
                $("#rglobal_shift_edit").html(select_box);
                if(global_shift_id!=null){
                  $("#global_shift_edit").val(global_shift_id).trigger('change');
                  $("#rglobal_shift_edit").val(global_shift_id).trigger('change');      
                }
                  getShiftEdit();
           }
        });
    }

    function validateTime(obj){
      let id = obj.value;
      let date = $("#datetimepicker").val();
      if(id){
        $.ajax({
            url: baseurl+'admin/onlineappointment/getshiftbyid',
            type: "POST",
            data: {id:id,date:date},
            dataType: 'json',
            success: function(res){
//               if(res.status){
//                 alert("<?php echo $this->lang->line("appointment_time_is_expired"); ?>");
//               }
            }
        });
      }
      
    }
  
  function getSlotByShift(type){
    
        if(type === 'add'){
          
            console.log(type);
            var shift = $("#slot").val();
            var div_data = "";
            var date = $("#datetimepicker").val();
            var doctor = $("#doctorid").val();
//             var global_shift = $("#global_shift").val();
            var global_shift = $("#rglobal_shift_edit").val();
          
        }else{
          
            console.log(type);
            
            var shift = Number($("#rslot_edit").val());
          
            var div_data = "";
            var date = $("#dates").val();
            var doctor = $("#rdoctor").val();
            var global_shift = 8;
//             var global_shift = $("#rglobal_shift_edit").val();

        }

        if(shift!=''){
          
            $.ajax({
                url: '<?php echo base_url(); ?>site/getSlotByShift',
                type: "POST",
                data: {shift:shift,doctor:doctor,date:date,global_shift:global_shift},
                dataType: 'json',
                success: function(res){
                    $.each(res.result, function (i, obj)
                    { 
                         div_data += "<span id='slot_"+ i +"'' onclick = 'setSlot("+ i +")' style='cursor:pointer;' class=' "+ obj.class +"' data-filled='"+ obj.filled +"' >"+ obj.time + "</span>";
                    });
                  
                    if(type === 'add'){
                          $("#slot1").html("");
                          $("#slots_label").html("<label><b><?php echo $this->lang->line('available_slots'); ?></b><small class='req'> *</small></label>");
                          if(div_data == ""){
                              div_data += '<div class="alert alert-danger" role="alert"><?php echo $this->lang->line('no_slot_available'); ?></div>';
                          }
                          $('#slot1').html(div_data);
                          if(date == ""){
                              $('#slot1').html("");
                          }  
                    } else {
                        $("#edit_slot").html("");
                        $("#edit_slots_label").html("<label><b><?php echo $this->lang->line('available_slots'); ?></b><small class='req'> *</small></label>");
                        if(div_data == ""){
                            div_data += '<div class="alert alert-danger" role="alert"><?php echo $this->lang->line('no_slot_available'); ?></div>';
                        }
                        $('#edit_slot').html(div_data);
                        if(date == ""){
                            $('#edit_slot').html("");
                        }
                    }
    
                }
            });
        }else{
            $('#slot1').html("");
            $('#edit_slot').html("");

        }
    }
  function reset_all(){
      $("#slot1").html("");
      $("#slot").empty();
      $("#datetimepicker").val("");
      $("#global_shift").select2("val", "");
    
      $("#edit_slot").html("");
      $("#rslot_edit").empty();
      $("#dates").val("");
      $("#rglobal_shift_edit").select2("val", "");
      $("#message_reason").val("");
    }
  
  function setSlot(id){
    
    
        if($("#slot_"+id).data("filled") === "filled"){
            alert("<?php echo $this->lang->line('not_available'); ?>");
        }else{
            $("#slot_id").val(id);
            $("#edit_slot_id").val(id);
            $(".bg-primary").addClass("badge-success-soft");
            $(".bg-primary").removeClass(".bg-primary");
            $("#slot_"+id).removeClass("badge-success-soft");
            $("#slot_"+id).addClass("bg-primary");
        }
    }

  function formatDateToISO(dateString) {
    // La fecha original está en formato "mes/día/año"
    const [month, day, year] = dateString.split('/');
    // La función Date espera el mes en base 0, por lo que restamos 1 al mes.
    const date = new Date(year, month - 1, day);
    // Usamos el método toISOString() para obtener la fecha en formato ISO.
    return date.toISOString().slice(0, 10);
  }
  
  function enviar_fecha(type){
    if(type=="limpiar"){
       $("#fecha_inicial").val("");
        $("#fecha_final").val("");
       }
    var fecha = $("#fecha_id").val();
    var doctor_id = $("#doctor_id").val();
    
    let type2 = "sin_lapso";
    
    console.log(doctor_id); 
    
    

    initDatatable('ajaxlist','admin/appointment/getappointmentdatatable/'+type2+'/'+fecha+'/'+doctor_id,[],[],25);

  }
  
    function enviar_fecha_parametros(){
      
    var fecha_inicial= $("#fecha_inicial").val();
    var fecha_final= $("#fecha_final").val();
      
    if(fecha_inicial != '' && fecha_final != ''){
      
    var doctor_id = $("#doctor_id").val();
    console.log(fecha_inicial);
    console.log(fecha_final);
      
      console.log(formatDateToISO(fecha_inicial));
      console.log(formatDateToISO(fecha_final));
      fecha_inicial= formatDateToISO(fecha_inicial);
      fecha_final= formatDateToISO(fecha_final);
      initDatatable('ajaxlist','admin/appointment/getappointmentdatatable/'+fecha_inicial+'/'+fecha_final+'/'+doctor_id,[],[],25);
    }else{
      console.log("ingresa parametros")
    }
    
  }

//   document.addEventListener('DOMContentLoaded', function() {
//        var elementos = document.querySelectorAll('.appoiment_alert');

//       if (elementos.length > 0) {
//         console.log('Elementos encontrados:');

//         elementos.forEach(function(elemento, indice) {
//           var valor = elemento.textContent;
//           console.log('Valor del elemento', indice + 1 + ':', valor);
//         });
//       } else {
//         console.log('No se encontraron elementos con la clase especificada.');
//       }
//   });
  

  function alert_appoiment(){
    
      var elementos = document.querySelectorAll('.appoiment_alert');

      if (elementos.length > 0) {
        console.log('Elementos encontrados:');

        elementos.forEach(function(elemento, indice) {
          var valor = elemento.textContent;
          console.log('Valor del elemento', indice + 1 + ':', valor);
        });
      } else {
        console.log('No se encontraron elementos con la clase especificada.');
      }

//     let alert = document.querySelectorAll('#appoiment_alert');
    
//     if (alert.length > 0) {
//       console.log('Posiciones con resultados:');

//       alert.forEach(function(elemento, indice) {
//         console.log('Posición:', indice);
//       });
//     } else {
//       console.log('No se encontraron resultados.');
//     }
    
//     let alert = Array.from(document.querySelectorAll('#appoiment_alert'));
//     alert.forEach(property => console.log(property));
//     console.log(Array.from(alert));
  }
  
  window.addEventListener('load', alert_appoiment);
  
  function aproved(id){
    console.log(id);
    $.ajax({
          url: baseurl+'admin/appointment/resupdate/'+id,
          type: "POST",
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            console.log(data);
//             if (data.status == "fail") {
//             var message = "";
//             $.each(data.error, function (index, value) {
//             message += value;
//           });
//           errorMsg(message);
//           } else {
//             localStorage.setItem('showAlert', data.message);
//             window.location.reload(true);
//           }
//             $("#rescheduleformbtn").button('reset');
          },
          error: function () {

          }
        });
  }
  
  
  var type_visit = document.getElementById('type_visit');
  
  type_visit.addEventListener('change', (event) => {

     if(event.target.value === "Otros"){
        document.getElementById('other_type_visit').innerHTML = `<div class="form-group">
                                                                          <label>Otros</label>
                                                                          <input type="text" id="appoinment_type" name="type_visit" placeholder="tipo de cita" class="form-control">
                                                                       </div>`;
        type_visit.removeAttribute("name");
     } else {
        type_visit.setAttribute("name", 'type_visit');
        document.getElementById('other_type_visit').innerHTML = "";
     }
 });
  
//   $('edit_type_visit').on('change', () => {
    
//   });
  
  document.getElementById('edit_type_visit').addEventListener('change', (event) => {
     if(event.target.value === "Otros"){
        document.getElementById('edit_type_visit').removeAttribute("name");
        document.querySelector('#edit_other_visit').style.display = "block";
        document.querySelector('#edit_other_visit input').setAttribute("name", 'edit_type_visit');
     } else {
        document.querySelector('#edit_other_visit input').removeAttribute("name");
        document.querySelector('#edit_other_visit').style.display = "none";
        document.getElementById('edit_type_visit').setAttribute("name", 'edit_type_visit');
     }
 });
  
  
</script>
<script type="text/javascript">
( function ( $ ) {
  'use strict';
  $(document).ready(function () {
    let type2 = "sin_lapso";
    initDatatable('ajaxlist','admin/appointment/getappointmentdatatable/'+type2,[],[],25);
  });
} ( jQuery ) ) 
  
</script>
<!-- //========datatable end===== -->





