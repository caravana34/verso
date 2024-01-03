<link href="https://fonts.cdnfonts.com/css/nasalization-2" rel="stylesheet">

<style>
    .items_text{
        font-family: 'Nasalization', sans-serif !important;
        font-weight: normal !important;
        text-transform: capitalize !important;
        color: #28a9bf !important;
    }
</style>



<!-- Add OT -->
<div class="modal fade" id="add_operationtheatre" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Equipo de Procedimientos</h4> 
            </div>
            <div>
               <form id="form_operationtheatre" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                    <div class="modal-body pb0 ptt10">
                        <input type="hidden" value="<?php echo $opdid ?>" name="opdid" class="form-control" id="ipdid" /> 
                        <input type="hidden" value="<?php echo $id_visit ?>" name="case_id" /> 
                        <input type="hidden" id="patient_diag">
                        <div class="row">
                            <!-------- -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha de Procedimiento</label>
                                    <small class="req"> *</small> 
                                      <input type="text" id="dates" name="appointment_date"  class="form-control date-appointment" value="<?php echo $doctor_app[0]->date ?>" readonly>
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                            </div><!----END---- -->
                            <!-------- -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Procedimiento</label>
                                    <div class="input-group">
                                        <input type="text" id="procedure_name" name="procedure_name" value="  <?= $doctor_app[0]->reason_consultation ?>" class="form-control" placeholder="Cirugía" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;" readonly>
                                        <div class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;">
                                           <i class="fa fa-group"></i>
                                        </div>
                                    </div>
                                </div>
                            </div><!----END---- -->
                            <!-----------DOCTOR----------------->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">
                                      <?php echo $this->lang->line('specialist'); ?>
                                   </label>
                                    <small class="req"> *</small>
                                    <div>
                                        <select id="doctor_id" name="especialist" class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true">
                                           <option value="<?= $doctor_app[0]->doctor?>" hidden>
                                               <?php echo $result['result']['name'] ?> <?php echo $result['result']['surname'] ?>
                                           </option> 
                                               <?php foreach ($doctors as $key => $value): ?>
                                           <option  value="<?= $value['id'] ?>">
                                               <p class="capitalize">
                                                   <?php echo ucwords(strtolower($value["name"] . " " . $value["surname"] ." (". $value["employee_id"].")")) ?>
                                               </p>
                                           </option> 
                                               <?php endforeach ?>
                                       </select>
                                        <span class="text-danger"><?php echo form_error('rdoctor'); ?></span>
                                    </div>
                                </div>
                            </div><!--END DOCTOR-->
<!--                             <div class="col-sm-6">
                                   <hr>
                                  <div class="form-group">
                                        <div class="form-group">
                                            <label class="" style="">Via<small class="req"> *</small> </label>
                                            <input type="hidden" id="">
                                            <select name="via" id="medicatioFaseOperatoria" style="width: 100%" class="form-control">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                    </div>
                                   <hr>
                                </div> -->
                            <!-------- -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Anestesiólogo<small class="req"> *</small> </label>
                                        <input type="hidden" id="nurse_set">
                                        <select name="anestesiologo" <?php if ($disable_option == true) { echo "disabled"; } ?> style="width: 100%" id="nurse_field" class="form-control select2">
                                            <option value="">No aplica</option>
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($anestesiologiaDoctors as $key => $doctor): ?>
                                                <option <?php if ((isset($speAnestesiologia)) && ($speAnestesiologia == $doctor["id"])) { echo "selected"; } ?> value="<?php echo $doctor["id"] ?>">
                                                    <?php echo composeStaffNameByString($doctor["name"], $doctor["surname"], $doctor["employee_id"]); ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div><!----END---- -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Auxiliar de enfermeria<small class="req"> *</small> </label>
                                        <input type="hidden" id="nurse_set">
                                        <select name="nurse" <?php if ($disable_option == true) { echo "disabled"; } ?> style="width: 100%" id="nurse_field" class="form-control select2">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <option value="No_aplica"><strong>No aplica</strong></option>
                                                <?php foreach ($nurse as $key => $value) { ?>
                                            <option  <?php if ((isset($nurse_select)) && ($nurse_select == $dvalue["id"])) { echo "selected"; } ?> value="<?php echo $value["id"] ?>">
                                                <?php echo composeStaffNameByString($value["name"],$value["surname"],$value["employee_id"]); ?>
                                            </option>
                                                <?php } ?>
                                        </select>
                                    </div> 
                                </div>
                            </div><!----END---- --> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="" style="">Tipo de anestesia<small class="req"> *</small> </label>
                                        <input type="hidden" id="">
                                        <select name="Des_anestecia" id="medicatioFaseOperatoria" style="width: 100%" class="form-control">
                                            <option value="No_aplica">No aplica</option>
                                            <option value="local">local</option>
                                            <option value="Sedacion">Sedación</option>
                                            <option value="General">General</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="" style="">Lateralidad<small class="req"> *</small> </label>
                                        <input type="hidden" id="">
                                        <select name="lateralidad" id="medicatioFaseOperatoria" style="width: 100%" class="form-control">
                                            <option value="No_aplica">No aplica</option>  
                                            <option value="Izquierdo">Izquierdo</option>
                                            <option value="Derecho">Derecho</option>
                                            <option value="Bilateral">Bilateral</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <!----------COMPLICACIONES---------- -->
                            <div class="col-sm-12">
                                <div class="col-12">
                                    <div class="row">
                                        <hr>
                                        <div class="form-group">
                                            <label class="col-form-label" style="display: inline-block; margin-left:10px; border-right: 1px solid #ccc; padding-right: 10px;">Complicación <small class="req"> *</small></label>
                                            <div class="form-check" style="display: inline-block; margin-left:12px;">
                                                <input class="form-check-input" type="radio" name="complications" id="exampleRadios1" onclick="check_si()">
                                                <label class="form-check-label" for="exampleRadios1" style="display: inline; border-right: 1px solid #ccc; padding-right: 10px;">Si</label>
                                            </div>
                                            <div class="form-check" style="display: inline-block;margin-left:12px;">
                                                <input class="form-check-input" type="radio" name="complications" onclick="check_no()" id="exampleRadios2">
                                                <label class="form-check-label" for="exampleRadios2" style="display: inline;">No</label>
                                            </div>
                                            <textarea name="complicationsData" id="complicationsData" class="form-control" style="margin-left:10px;width:900px;" placeholder="Breve descripción en caso de si"></textarea>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- END COMPLICACIONES -->
                            <!---------------------DIAGNOSTICO--------------------- -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="accordion10" class="panel-group" style="margin: 15px 20px;">
                                        <div class="panel panel-default" style="border-radius:20px;">
                                            <div class="panel-heading" @click="cie_structure()">
                                                <h4 class="panel-title" style="color:#444;">
                                                    <a class="collapsed items_text" style="" role="button" data-toggle="collapse" data-parent="#accordion10" href="#diagnostico" aria-expanded="false" aria-controls="collapseExample6">
                                                        <i class="more-less fa fa-plus" style="color:#1563b0;"></i>
                                                        Diagnóstico
                                                    </a>
                                                </h4>
                                            </div>

                                            <div id="diagnostico" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="row" style="margin: 0px 0px;padding: 7px;">
                                                        <div class="row" style="margin: 0px 0px 0px 0px;padding: 3px;">
                                                            <div class="row" style="justify-content: center;margin-bottom:10px;">
                                                                <div class="">
                                                                    <div class="col-md-12" style="margin-top:5px;max-height:300px; overflow: auto;">
                                                                        <label>Búsqueda de diagnóstico</label>
                                                                        <input id="searchFilter" onkeyup="filter_diagnosis()" value="" name="second_diag" type="text" class="form-control" placeholder="Búsqueda de diagnóstico">
                                                                    </div>
                                                                    <div class="usersearchlist col-md-12" style="margin-top:5px;max-height:300px; overflow: auto;">
                                                                        <ul class="list-group scroll-container mb-3" id="lista2" hidden>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-9" style="margin-top:5px;max-height:300px; overflow: auto;">
                                                                    <label>Diagnóstico</label>
                                                                    <input id="diagnostic" onkeyup="" value="" name="" type="text" class="form-control" placeholder="diagnóstico">
                                                                </div>
                                                                <div class="col-md-3" style="margin-top:5px">
                                                                    <div class="form-group">
                                                                        <label for="" class="control-label">Tipo de diagnóstico</label><small class="req"> *</small><select id="type_diagnostic" name="" class="form-control" autocomplete="off"> Confirmado Nuevo&gt;<option value="">Tipo de diagnóstico</option><option value="Impresión Diagnóstica">Impresión Diagnóstica</option><option value=" Confirmado Nuevo" selected="selected"> Confirmado Nuevo</option><option value=" Confirmado Repetido"> Confirmado Repetido</option></select>
                                                                        <span class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group"><label for="" class="control-label">Nota diagnóstico</label><textarea id="note_diagnostic" name="" class="form-control"></textarea><span class="text-danger"></span></div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" style="">
                                                            <div class="col-md-12 mb-5" style="padding:15px 5px;gap: 12px;display:flex;justify-content: end;">
                                                                <div class="">
                                                                    <button type="button" data-loading-text="Procesando..." onclick="table_diagnosis(`primario`)" class="btn pull-right" style="background:#1563B0 !important; color:#fff;" autocomplete="off"><i class="fa fa-plus"></i> Diagnóstico Primario</button>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" onclick="table_diagnosis(`secundario`)" class="btn pull-right" style="background:#1563B0 !important; color:#fff;" autocomplete="off"><i class="fa fa-plus"></i> Diagnóstico Secundario</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="" style="margin-bottom: 15px;padding: 3px;">
                                                        <div class="content">
                                                            <table class="table table-bordered table-striped mt-5 mb-5" id="diagnosticos">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Diagnóstico</th>
                                                                        <th>Nota Diagnóstico</th>
                                                                        <th>Tipo de Diagnóstico</th>
                                                                        <th>Categoría Diagnóstico</th>
                                                                        <th>Acción</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END DIAGNOSTICO-->
                            <!----------------------CAUSA EXTERNA Y FINALIDAD------------- -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="causaExternaFinalidad10" class="panel-group" style="margin: 15px 20px;">
                                        <div class="panel panel-default" style="border-radius:20px;">
                                            <div class="panel-heading" @click="cie_structure()" style="border-radius:10px;">
                                                <h4 class="panel-title" style="color:#444;">
                                                    <a class="collapsed items_text" style="" role="button" data-toggle="collapse" data-parent="#causaExternaFinalidad10" href="#Finalidad10" aria-expanded="false" aria-controls="collapseExample6">
                                                        <i class="more-less fa fa-plus" style="color: #28a9bf"></i>
                                                        Causa externa y finalidad
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="Finalidad10" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="">
                                                        <div class="col-sm-4"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="selectCausasExterna" class="control-label">Búsqueda Causa Externa</label>
                                                            <select id="selectCausasExterna" class="form-control" onchange="CausaExterna()">
                                                                  <option value="" selected>Seleccione Causa Externa</option>
                                                                  <option value="Accidente de trabajo">Accidente de trabajo</option>
                                                                  <option value="Accidente de tránsito">Accidente de tránsito</option>
                                                                  <option value="Accidente ofídico">Accidente ofídico</option>
                                                                  <option value="Enfermedad general">Enfermedad General</option>
                                                                  <option value="Evento catastrófico">Evento catastrófico</option>
                                                                  <option value="Lesión auto infligida">Lesión auto infligida</option>
                                                                  <option value="Lesión por agresión">Lesión por agresión</option>
                                                                  <option value="Otra">Otra</option>
                                                                  <option value="Otro tipo de accidente">Otro tipo de accidente</option>
                                                                  <option value="Sospecha de maltrato físico">Sospecha de maltrato físico</option>
                                                                  <option value="Sospecha de abuso sexual">Sospecha de abuso sexual</option>
                                                                  <option value="Sospecha de maltrato emocional">Sospecha de maltrato emocional</option>
                                                              </select>
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin: 0px 0px;padding: 7px;">
                                                        <div class="row" style="margin: 25px 0px;padding: 3px;">
                                                            <div class="row" style="display: flex;justify-content: center;margin-bottom:30px;">
                                                                <div class="col-md-9">
                                                                    <div class="form-group">
                                                                        <label for="mostrarInput">Causa Externa</label>
                                                                        <div class="input-group">
                                                                            <input type="text" id="mostrarInput" name="ot_result" value="" class="form-control" placeholder="" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;" readonly>
                                                                            <div class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;">
                                                                                <i class="fa fa-group"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--END CAUSA EXTERNA Y FINALIDAD-->    
                        <!-------- -->
<!--                         <div class="col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('assistant_consultant') . " " . '1'; ?></label>
                                <input type="text" name="ass_consultant_1" class="form-control">                     
                            </div>
                        </div><!----END---- -->
                        <!-------- -->
<!--                         <div class="col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('assistant_consultant') . " " . '2'; ?></label>
                                <input type="text" name="ass_consultant_2" class="form-control">
                            </div>
                        </div><!----END---- --> 
                        <!-------- -->
                        <!-------- -->
<!--                         <div class="col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('result'); ?></label>
                                <textarea name="ot_result" id="" class="form-control"></textarea>
                            </div>
                        </div>-->
                        <!----END---- --> 
                        <!---Des. de procedimiento- -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Observaciones de procedimiento</label>
                                <textarea name="Des_procedimiento" id="ot_result" class="form-control"></textarea>
                            </div>
                        </div><!----END Anestecia-- -->
                        <!---Des. de procedimiento- -->
<!--                         <div class="col-sm-12">
                            <div class="form-group">
                                <label>Descripción de Anestesia</label>
                                <textarea name="Des_anestecia" id="ot_result" class="form-control"></textarea>
                            </div>
                        </div>-->
                        <!----END Des. Anesteciao--- --> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Análisis y Plan</label>
                                <textarea name="Conclusionoes_sugerencias" id="ot_result" class="form-control"></textarea>
                            </div>
                        </div><!----END Des. Anesteciao--- -->
                        <div class="">
                            <?php echo display_custom_fields('operationtheatre'); ?>
                        </div>
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <div class="pull-right">
                            <button type="submit" id="form_addoperationtheatrbtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </div>
                </form>
            </div> <!-- scroll-area -->
        </div>
    </div> 
</div>
<!-- Edit Operation Theatre -->
<!-------------------PROCENDIMIENTOS MENORES --------------------------->
<div class="modal fade" id="add_operationSmall" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Notas de Procedimiento menor</h4> 
            </div>
            <div>
               <form id="form_operationtheatreSmall" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                    <div class="modal-body pb0 ptt10">
                        <input type="hidden" value="<?php echo $opdid ?>" name="opdid" class="form-control" id="ipdid" /> 
                        <input type="hidden" value="<?php echo $result['case_reference_id'];?>" name="case_id" /> 
                        <div class="row">
                            <!-------- -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('operation_date'); ?></label>
                                    <small class="req"> *</small> 
                                      <input type="text" id="dates" name="appointment_date"  class="form-control date-appointment" value="<?php echo $doctor_app[0]->date ?>" readonly>
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                            </div><!----END---- -->
                            <div class="col-sm-12">
                               <div class="form-group">
                                  <label for="exampleInputFile">
                                      <?php echo $this->lang->line('doctor'); ?>
                                   </label>
                                  <small class="req"> *</small>
                                  <div>
                                      <select id="doctor_id"  name="especialist" class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true">
                                           <option value="<?= $doctor_app[0]->doctor?>" hidden>
                                               <?php echo $result['result']['name'] ?> <?php echo $result['result']['surname'] ?>
                                           </option> 
                                               <?php foreach ($doctors as $key => $value): ?>
                                           <option  value="<?= $value['id'] ?>">
                                               <p class="capitalize">
                                                   <?php echo ucwords(strtolower($value["name"] . " " . $value["surname"] ." (". $value["employee_id"].")")) ?>
                                               </p>
                                           </option> 
                                               <?php endforeach ?>
                                       </select>
                                        <span class="text-danger"><?php echo form_error('rdoctor'); ?></span>
                                  </div>
                                </div>
                            </div><!--END DOCTOR-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('result'); ?></label>
                                    <textarea name="ot_result" id="" class="form-control"></textarea>
                                </div>
                            </div><!----END---- -->
                            <!---Des. de procedimiento- -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Descripción de procedimiento</label>
                                    <textarea name="Des_procedimiento" id="ot_result" class="form-control"></textarea>
                                </div>
                            </div><!----END Anestecia-- -->
                            <!---Des. de procedimiento- -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Descripción de Anestesia</label>
                                    <textarea name="Des_anestecia" id="ot_result" class="form-control"></textarea>
                                </div>
                            </div><!----END Des. Anesteciao--- -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Conclusiones y sugerencias</label>
                                    <textarea name="Conclusionoes_sugerencias" id="ot_result" class="form-control"></textarea>
                                </div>
                            </div><!----END Des. Anesteciao--- -->
                            <div class="">
                            <?php echo display_custom_fields('operationtheatre'); ?>
                        </div>
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <div class="pull-right">
                            <button type="submit" id="form_operationtheatreSmallbtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </div>
                </form>
            </div> <!-- scroll-area -->
        </div>
    </div> 
</div>
<!-- PROCENDIMIENTOS MENORES -->


<script>
    $(document).ready(function (e) {
          $("#form_operationtheatre").on('submit', (function (e) {
               var did = $("#consultant_doctorid").val();
              $("#consultant_doctorname").val(did);
              $("#form_operationtheatrebtn").button('loading');
//               e.preventDefault();
              $.ajax({
                  url: '<?php echo base_url(); ?>admin/Procedimientos/add_equipo',
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
                          window.location.reload(true);
                      }
                      $("#form_operationtheatrebtn").button('reset');
                  },
                  error: function () {
                  }
              });
          }));
      });
    
        $(document).ready(function (e) {
          $("#form_operationtheatreSmall").on('submit', (function (e) {
               var did = $("#consultant_doctorid").val();
              $("#consultant_doctorname").val(did);
              $("#form_operationtheatreSmallbtn").button('loading');
//               e.preventDefault();
              $.ajax({
                  url: '<?php echo base_url(); ?>admin/Procedimientos/add_equipo',
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
                          window.location.reload(true);
                      }
                      $("#form_operationtheatreSmallbtn").button('reset');
                  },
                  error: function () {
                  }
              });
          }));
      });
    
    $(document).on('change', '.custom_fields[patient][4]', function() {
        var mode = $(this).val();
        console.log(mode);
    });
    
    function check_si() {
        document.getElementById('complicationsData').value = "Si, ";
        document.getElementById('complicationsData').readOnly = false;
    }

    function check_no() {
        document.getElementById('complicationsData').value = "No";
        document.getElementById('complicationsData').readOnly = true;
    }
    
        function CausaExterna() {
            // Obtener el elemento de selección
            var seleccion = document.getElementById("selectCausasExterna");

            // Obtener el valor seleccionado
            var valorSeleccionado = seleccion.value;

            // Mostrar el valor en el input
            document.getElementById("mostrarInput").value = valorSeleccionado;
        }

  
</script> 



