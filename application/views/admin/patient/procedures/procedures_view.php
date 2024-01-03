<?php
$currency_symbol = $this->customlib->getHospitalCurrencyFormat();
?>
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<style>
.table_inner {
  overflow: auto;
  width: auto;
  white-space: normal;
  max-height: auto;
  border-collapse: collapse;
}
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row"> 
            <div class="col-md-12">
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title titlefix">Procedimientos</h3>
                        <div class="box-tools addmeeting">
                            <?php if ($this->rbac->hasPrivilege('opd_patient', 'can_add')) { ?>                
                               <a onclick="holdModal('appointment_gastro')" class="btn btn-sm" style="background:#1563B0; color:#fff;border-radius: 5px;"><i class="fa fa-plus"></i> Agregar cita</a> 
                            <?php } ?> 
                        </div> 
                    </div><!-- /.box-header -->
                  
                  <div class="row" style="margin: 10px 0px 10px 0px;" >
                      <div class="col-lg-12">

                        <?php if ($user_role_id != 3): ?>
                          <div class="col-lg-3">
                            <label for="fecha_inicial" style="margin-right: 10px;">Doctor</label>
                            <select id="doctor_id"  class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true">
                                <option value="" >Todos los doctores</option> 
                                <?php foreach ($doctors as $key => $value): ?>
                                <option  value="<?= $value['id'] ?>"><p class="capitalize">
                                  <?php echo ucwords(strtolower($value["name"] . " " . $value["surname"] ." (". $value["employee_id"].")")) ?></p></option> 
                                <?php endforeach ?>
                            </select>
                          </div>
                        <?php endif ?>
                        
                         <div class="row " style="margin-bottom:10px" >
                          <div class="col-lg-3">
                              <label for="" style="margin-right: 10px;">Fecha</label>
                              <select id="fecha_id" onchange="enviar_fecha('limpiar')" class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true" >
                                  <option value="2">Citas de Hoy</option>   
                                  <option value="1">Todas las citas</option>   
                                  <option value="4">Citas en los próximos 7 días</option>
                                  <option value="5">Citas recientemente agendadas</option> 
                              </select>
                            </div>
                            <div class="col-lg-2">
                                    <label for="fecha_inicial" style="margin-right: 10px;">Fecha Inicial</label>
                                    <div class="">
                                        <div class="input-group">
                                            <input type="text" onchange="enviar_fecha_parametros()" value="" id="fecha_inicial" class="form-control date" name="" placeholder="Fecha Inicial" autocomplete="off" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;"><span class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <span class="text-danger"></span>
                                    </div>
                              </div>
                              <div class="col-lg-2">
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
                   </div>
                  
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover ajaxlist" data-export-title="<?php echo $this->lang->line('opd_patient'); ?>">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('patient_name'); ?></th>
                                    <th>Documento identidad</th>
                                    <th>Tipo de atención</th>
                                    <th><?php echo $this->lang->line('source'); ?></th>
                                    <th><?php echo $this->lang->line('doctor'); ?></th>
                                    <th><?php echo $this->lang->line('appointment_date'); ?></th>
                                    <?php if ($this->module_lib->hasActive('live_consultation')) { ?>
                                    <th><?php echo $this->lang->line('live_consultant'); ?></th>
                                    <?php } ?>
                                    <?php if (!empty($fields)): ?>
                                      <?php foreach($fields as $fields_key => $fields_value): ?>
                                        <th><?php echo $fields_value->name; ?></th>
                                      <?php endforeach ?> 
                                    <?php endif ?>
                                    <th>Tipo de cita</th>
                                    <th><?php echo $this->lang->line('status'); ?></th>
                                </tr>
                            </thead>
<!--                             <tbody>
                            </tbody> -->
                        </table>
                    </div>
                  
                </div>  
            </div>
        </div> 
    </section>
</div>  


<div class="modal fade" id="rescheduleModal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-media-content">
      <div class="modal-header modal-media-header">
        <button type="button" class="close pt4" data-dismiss="modal" autocomplete="off">×</button>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <div class="p-2 select2-full-width">
                    <select class="form-control patient_list_ajax" form="rescheduleform" id="addpatient_id" name='patient_id'>
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
      </div>
      <form id="rescheduleform" accept-charset="utf-8" method="post">
        <div class="">
          <div class="modal-body pb0">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <input type="hidden" id="rdates">
                  <input type="hidden" id="message_reason">
                  <input type="hidden" id="edit_patient_id" name="edit_patient_id">
                  <input type="hidden" id="edit_appointment_id">

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
                  
                <div id="edit_input_slot">
                </div>

<!--                 <input type="hidden" id="edit_slot_id" name="edit_slot" /> -->
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
                      <td width="35%"><span id="responsible"></span></td>  
                      
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
                        <td width="35%"><span id="doctor_shift_view" ></span></td>
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
                       <th width="15%">Tipo de cita</th>
                       <td width="35%"><span id="type_appointment"></span></td>
                    </tr>
                
                    <tr>
                      <th width="15%">Vivienda</th>
                      <td width="35%"><span id="home_name"></span></td>
                      <th width="15%"><?php echo $this->lang->line('status'); ?></th>
                      <td width="35%"><span id='status' style="text-transform: capitalize;"></span></td>
                    </tr>
              
                  <div>
                    <tr id="content_doctors" hidden>
                        <th>Anesthetist</th>
                        <td><span id="view_operation_anesthetist"></span></td>
                        <th>Auxiliar de enfermeria</th>
                        <td><span id="view_nursing_assistant"></span></td>
                    </tr>
                  </div>


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
                      <td width="35%"><span id="spn_chequedate"></span></td>
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
                <input type="text" hidden></input>
                <div class="modal-footer">
                   <div class="pull-right">

                        <button onclick="editpatient()" type="button" class="btn" style="background:#1563B0; color:#fff;border-radius: 5px;" autocomplete="off"><i class="fa fa-check-circle"></i> EDITAR PACIENTE</button>

                   </div>
                  <?php if($userdata['role_id'] != 6) : ?>
                   <div class="pull-right" style="margin-right: 5px;">

                        <button id="view_appointment" type="button" class="btn" style="background:#1563B0; color:#fff;border-radius: 5px;" autocomplete="off"><i class="fa fa-check-circle"></i> VER PACIENTE</button>

                   </div>
                  <?php endif ?>
                </div>
            </form>
          </div><!--./col-md-12-->
        </div><!--./row-->
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">

  
      function viewreschedule(id){
        
          $('#rescheduleModal').modal('show');
          $('#appointment_id').val(id);
          console.log(id);
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
              if(data.patient_id !=null){
                  $('#edit_patient_id').val(data.patient_id);
              }
              $('#edit_appointment_id').val(data.id);

              $("#r_dates_time").val(data.time);
              $("#rslot_edit_field").val(data.shift_id); 
              $("#time_opd").val(data.time);
              $("#date_time_opd").val(data.date+' '+data.time); 
              $("#id_patient").html(data.patient_id);
              $("#id_opd").html(data.opd_details_id);
              $("#message").val(data.message);
              $("#message_reason").val(data.reason_consultation);

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
              $('select[id="edit_responsible"] option[value="' + data.responsible + '"]').attr("selected", "selected");
              $('select[id="edit_appointment_status"] option[value="' + data.appointment_status + '"]').attr("selected", "selected");
              get_specialist(data.doctor,'edit');
              $("#rdoctor").trigger("change");
              $("#dates").val(result).trigger("change");

              getDoctorShift("",data.doctor,data.global_shift_id);
            }
          });
     }

     $("#rescheduleform").on('submit', function (e) {
       
          let appointment_id = document.getElementById('appointment_id').value;
          $("#rescheduleformbtn").button('loading');
          e.preventDefault();

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
                 if(edit_status == "Cancelada"){
                     $('#rescheduleModal').modal('hide');
                     var message = "la cita fue cancelada"
                     errorMsg(message);
                 }else if(edit_status == "Aprobada"){
                    $.ajax({
                        url: baseurl+'admin/appointment/getDetailsAppointment',
                        type: "GET",
                        data: {appointment_id: appointment_id},
                        dataType: 'json',
                        success: function (data) {
                          $('#preview_charges').html('');
                          $("#id_opd").html(data.opd_details_id);
                          $('#rescheduleModal').modal('hide');
                          $("#payment_case_id").val(data.case_reference_id);
                          $("#payment_opd_id").val(data.opd_details_id);
                          $("#patient_id").val(data.patient_id);
                          table.ajax.reload();
                          var url =`${baseurl}admin/bill/index/${data.case_reference_id}`;
                          window.open(url, '_blank');
                        }
                    });
                 }else if(edit_status == "Confirmada"){
                     var message = "Se actualizo el estado a confirmado";
                     successMsg(message);
                     $('#rescheduleModal').modal('hide');
                     table.ajax.reload();
                 }else if(edit_status == "Agendada"){
                     var message = "Se actualizó";
                     successMsg(message);
                     $('#rescheduleModal').modal('hide');
                     table.ajax.reload();  
                 }
              }
              $("#rescheduleformbtn").button('reset');
            },
            error: function () {
              $("#rescheduleformbtn").button('reset');
            }
         });
     });


     $("#rescheduleModal").on('hidden.bs.modal', function (e) {
          var appointment = $("#edit_appointment_id").val();
          console.log(appointment);
          $.ajax({
              url: baseurl+'admin/appointment/getpatient_id',
              type: "GET",
              data: {appointment_id: appointment},
              dataType: 'json',
              success: function (data) {
                console.log(data);
              }
          });
         reset_all();
     });   
  
    function reset_all(){
      $("#slot1").html("");
      $("#slot").empty();
      $("#datetimepicker").val("");
//       $("#global_shift").select2("val", "");
//       $("#doctor_id").val("");
      $("#edit_slot").html("");
      $("#rslot_edit").empty();
      $("#dates").val("");
//       $("#rglobal_shift_edit").select2("val", "");
      $("#message_reason").val("");
    
      $("#list_input_slot").html("");
      $("#edit_input_slot").html("");
    }
  

      // desarrollo cliniverso
  
//       document.getElementById('rescheduleform').addEventListener('submit', function(e) {
//             e.preventDefault(); 

//             fetch(baseurl + 'admin/appointment/reschedule', {
//                 method: 'POST',
//                 body: new FormData(this),
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.status === "fail") {
//                     let message = "";
//                     data.error.forEach(value => {
//                         message += value;
//                     });
//                     errorMsg(message);
//                 } else {
                  
//                     if(edit_status == "Cancelada"){
//                        var message = "la cita fue cancelada"
//                        errorMsg(message);
//                     }else if(edit_status == "Aprobada"){

//                         fetch(baseurl+'admin/appointment/getDetailsAppointment', {
//                             method: 'POST',
//                             body: {appointment_id: appointment_id}
//                         })
//                         .then(response => response.json())
//                         .then(data => {
//                             console.log(data);
//                         })
//                         .catch(error => {
//                             console.error(error);
//                         });

//                     }else if(edit_status == "Confirmada"){

//                     }else if(edit_status == "Agendada"){

//                     }
                  
//                 }
//                 document.getElementById('rescheduleformbtn').removeAttribute('disabled'); // Reemplaza button('reset') de jQuery
//             })
//             .catch(error => {
//                 errorMsg("Error en la solicitud");
//                 document.getElementById('rescheduleformbtn').removeAttribute('disabled');
//             });

//         } else {
//             errorMsg("Aun no se ha cumplido el tiempo de la cita o ya acabo.");
//             document.getElementById('rescheduleformbtn').removeAttribute('disabled');
//         }
//     });

//     document.getElementById('rescheduleModal').addEventListener('hidden.bs.modal', function(e) {
//         var appointment = document.getElementById('edit_appointment_id').value;

//         fetch(baseurl + 'admin/appointment/getpatient_id?appointment_id=' + appointment)
//             .then(response => response.json())
//             .then(data => {
//                 console.log(data);
//             })
//             .catch(error => {
//                 console.error(error);
//             });
//     });

  
   document.getElementById('doctor_id').addEventListener('change', function(e) {
      enviar_fecha();
   });

   function holdModal(modalId) {
      $('#' + modalId).modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
   }
  
   function formatDateToISO(dateString) {
        // La fecha original está en formato "mes/día/año"
        const [month, day, year] = dateString.split('/');
        // La función Date espera el mes en base 0, por lo que restamos 1 al mes.
        const date = new Date(year, month - 1, day);
        // Usamos el método toISOString() para obtener la fecha en formato ISO.
        return date.toISOString().slice(0, 10);
   }

  

      function enviar_fecha_parametros(){ 
            let fecha_inicial= $("#fecha_inicial").val();
            let fecha_final= $("#fecha_final").val();

            if(fecha_inicial != '' && fecha_final != ''){
                const doctor_id = $("#doctor_id").val();
                const view = 'procedures';

                fecha_inicial = moment(new Date(fecha_inicial)).format('YYYY-MM-DD');
                fecha_final = moment(new Date(fecha_final)).format('YYYY-MM-DD');

                initDatatable('ajaxlist',`admin/appointment/get_appointment_datatable/${fecha_inicial}/${fecha_final}/${doctor_id}/${view}`,[],[],25);
            }else{
                console.log("ingresa parametros")
                successMsg('Debe de ingresar las 2 fechas para filtrar');
            }
       }

 
  function enviar_fecha(type=null){

      if(type == "limpiar"){
          $("#fecha_inicial").val("");
          $("#fecha_final").val("");
      }
      const view = 'procedures';
      let fecha = $("#fecha_id").val();
      const doctor_id = $("#doctor_id").val();
      let type2 = "sin_lapso";
      initDatatable('ajaxlist',`admin/appointment/get_appointment_datatable/${type2}/${fecha}/${doctor_id}/?view=${encodeURIComponent(view)}`,[],[],25);

 }
  
 function viewDetail(id) {

      $('#viewModal').modal('show');
      $.ajax({
        url: baseurl+'admin/appointment/getDetailsAppointment',
        type: "GET",
        data: {
          appointment_id: id
        },
        dataType: 'json',
        success: function (data) {
          console.log(data);
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
          $("#global_shift_view").html(data.time_finish);
          $("#responsible").html(data.organisation_name);
          $("#doctor_shift_view").html(data.time+"-"+data.time_finish);
          $("#payment_note").html(data.payment_note);
          $("#patient_age").html(data.patient_age);
          $("#type_appointment").text(data.type_visit);

          let contentDoctors = $("#content_doctors");

          if (data.doctors_team != null) {
              // contentDoctors.css('display', 'block');
              contentDoctors.removeAttr('hidden');
              $("#view_operation_anesthetist").text(`${data.doctors_team.name_anesthetist} ${data.doctors_team.surname_anesthetist}`);
              $("#view_nursing_assistant").text(`${data.doctors_team.name_consultant_1} ${data.doctors_team.surname_consultant_1}`);
          } else {
              // contentDoctors.css('display', 'none');
              contentDoctors.attr('hidden', true);
          }


          if(data.payment_mode=="Cheque"){ 
              $("#payrow").show();
              $("#paydocrow").show();
              $("#spn_chequeno").html(data.cheque_no);
              $("#spn_chequedate").html(data.cheque_date);
              $("#spn_doc").html(data.doc);
          }else {    
              $("#payrow").hide();
              $("#paydocrow").hide();
              $("#spn_chequeno").html("");
              $("#spn_chequedate").html("");
          }


          $("#pay_amount").html('<?php echo $currency_symbol; ?>'+data.amount);
          $("#payment_mode").html(data.payment_mode);
          $("#trans_id").html(data.transaction_id);  


          var label = "";
          if (data.appointment_status == "Aprobada") {
            var text = "Aprobada";
            var label = "class='label cita_aprobada'";  
          } else if (data.appointment_status == "Agendada") { 
            var text = "Agendada";
            var label = "class='label cita_agendada'";  
          } else if (data.appointment_status == "Cancelada") {
            var text = "Cancelada";
            var label = "class='label cita_cancelada'";   
          } else if (data.appointment_status == "Confirmada") {
            var text = "Confirmada";
            var label = "class='label cita_confirmada'";   
          }else if (data.appointment_status == "Firmada") {
            var text = "Firmada";
            var label = "class='label cita_firmada'";  
          }else if (data.appointment_status == "Bloqueada") {
            var text = "Bloqueada";
            var label = "class='label cita_bloqueada'";  
          }

          let appointment_detail = document.getElementById('view_appointment');
          appointment_detail.onclick = () => view_appointment(id);

          $("#status").html("<small " + label + " >" + text + "</small>");
          $("#edit_delete").html("<a href='#' data-toggle='tooltip' onclick='printAppointment(" + id +")' data-original-title='<?php echo $this->lang->line('print'); ?>'><i class='fa fa-print'></i></a> <?php if ($this->rbac->hasPrivilege('appointment', 'can_delete')) {?><a href='#' data-toggle='tooltip' onclick='delete_record(" + id +")' data-original-title='<?php echo $this->lang->line('delete'); ?>'><i class='fa fa-trash'></i></a><?php }?> ");

        },
    });
}
  
  function editappointmentstatus(){
        var category = $("#category_visit").val();
        var edit_appointment_status = $('#edit_appointment_status').val();
        if(edit_appointment_status=="Cancelada"){
          $("#person_cancel").css("display", "block");
        }else{
          $("#person_cancel").css("display", "none");
        }
        var doctor_id = $('#rdoctor').val();    
        if(edit_appointment_status == 'Aprobada') {
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
                payments(category);
            }
          });
          $("#rescheduleform").trigger('submit');
        }else{
            $('#rdoctor_fees_edit').val('0');
        }
    }
  
  function payments(category){
    console.log(category);
  }
  
  
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
              div_data += '<option value="Consulta Otorrinolaringologia">Consulta Otorrinolaringología</option>';
              div_data += '<option value="Control Otorrinolaringologia">Control Otorrinolaringología</option>';
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
            } else if(i.specialist_doc == 'Anestesiologia') {
              div_data += '<option value="Consulta preanestésica">Consulta preanestésica</option>';
              div_data += '<option value="Control preanestésica">Control preanestésica</option>';
            }else {
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
    function getSlotByShift(type){
    
        if(type === 'add'){
          
            console.log(type);
            var shift = $("#slot").val();
            var div_data = "";
            var date = $("#datetimepicker").val();
            var doctor = $("#doctorid").val();
//             var global_shift = $("#global_shift").val();
            var global_shift = $("#rglobal_shift_edit").val();
           var visit = "";
          
        }else{
          
            console.log(type);
            
            var shift = Number($("#rslot_edit").val());
          
            var div_data = "";
            var date = $("#dates").val();
            var doctor = $("#rdoctor").val();
            var visit = $("#appointment_id").val();
            var global_shift = 8;
//             var global_shift = $("#rglobal_shift_edit").val();

        }

        if(shift!=''){
          
            // ocultar tabla de visitas
            $('#table_patient_visits').css('display', 'none');
          
            $.ajax({
                url: '<?php echo base_url(); ?>site/getSlotByShift',
                type: "POST",
                data: {shift:shift,doctor:doctor,date:date,global_shift:global_shift,visit:visit},
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
 
    function view_appointment(id_appointment) {

       fetch('<?= base_url("admin/appointment/type_appointment/") ?>', {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json"
                  },
                  body: JSON.stringify({id_appointment: id_appointment})
             })
            .then(response => response.json())
            .then(data =>{
               console.log(data);
               if(data.state == 'fail'){
                   $('#viewModal').modal('hide');
                   errorMsg(data.msg);
               } else {
                  window.location.href = data.url;
               }

             }).catch(error => console.error(error));

         }
  
 
</script>

<!-- //========datatable start===== -->
<!-- <script type="text/javascript">
  
  ( function ( $ ) {
    'use strict';
    $(document).ready(function () {
      let type2 = "sin_lapso";
      initDatatable('ajaxlist','admin/Procedimientos/getProcedureDatatable/'+type2,[],[],25);
    });
  } ( jQuery ) ) 
  
</script> -->
<script type="text/javascript">
  
document.addEventListener('DOMContentLoaded', function () {
     'use strict';
      const view = 'procedures';
      initDatatable("ajaxlist", `admin/appointment/get_appointment_datatable/?view=${encodeURIComponent(view)}`, [], [], 25);
});
  
</script>



<!-- //========datatable end===== -->
 <?php $this->load->view('admin/patient/patientaddmodal'); ?>