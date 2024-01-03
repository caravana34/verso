<?php 
//     echo "<pre>";
//     print_r($custom_fields_value);
//     exit;

?>

<style>
  /*     icon1{
        color:#1563B0;
    } */

  .table_inner {
    overflow: auto;
    width: auto;
    white-space: normal;
    border-collapse: collapse;
    max-height: fit-content;
  }

  .font-tab {
    font-size: 20px;
    color: #1563B0;
  }

  .panel-default >.panel-heading {
      border-radius: 10px !important;
      background: linear-gradient(to right,#777373 ,#a59d9d, #aeafaf 100%) !important;
      color: #fff;
  }
  

</style>



<?php
    $currency_symbol = $this->customlib->getHospitalCurrencyFormat();
    $genderList = $this->customlib->getGender();
    $case_reference_id=$result['case_reference_id'];
    $categorylist = $this->operationtheatre_model->category_list();
?>


  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>backend/multiselect/css/jquery.multiselect.css">
  <script src="<?php echo base_url(); ?>backend/multiselect/js/jquery.multiselect.js"></script>

  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12 itemcol">
          <div class="nav-tabs-custom relative">

            <div style="display: flex; align-items: center;">
              <div class="col-md-7">
                <?php
                        $fecha = new DateTime($doctor_app[0]->time);
                        $start_time = $fecha->format('h:i:s A');
                        $fecha->add(new DateInterval('PT'.$doctor_duration[0]->consult_duration.'M'));

                        date_default_timezone_set("America/Bogota");
                        $currentTime = new DateTime();

                        $started = $currentTime->format('h:i:s') === $doctor_app[0]->time ? 'started' : 'not_started';

                    ?>
                  <h4 class="items_text" style="font-size:25px;"><i class="fas fa-file-medical" style="font-size:24px"></i> Cirugía</h4>
                  <h5>
                    <span class="mt-5" style="margin-right: 5px;"><?php echo $doctor_app[0]->date; ?></span>
                    <span class="mt-5" style="margin-right: 5px;"><?= $start_time." - ".$fecha->format('h:i:s A') ?></span>
                    <span <?= $result_time=$result['result']['refference']=="Abierta" ? "" : "hidden" ?> class="mt-5" style="margin-right: 5px;" id="time_progress"></span>
                  </h5>
              </div>

              <!-- readonly
                          disabled -->

              <?php $result_state_readonly = $result['result']['refference'] == "Abierta" ? "" : "readonly" ?>
              <?php $result_state_disabled = $result['result']['refference'] == "Abierta" ? "" : "disabled" ?>

              <div class="" style="position: absolute; right: 10px;">
                <button id="openModalBtn" class="btn btn-md get_opd_detail" data-opdid="<?php echo $opdid; ?>">Ver Detalle</button>
                <button id="openModalBtnprint" class="btn btn-md print_opd_clini" data-opdid="<?php echo $opdid; ?>">Imprimir</button>
                <button id="openModalBtnprint2" class="btn btn-md printBill" data-opdid="<?php echo $opdid; ?>">Factura</button>
                <button onclick="confirmar_opd('<?= $result['result']['id']?>', '<?= $id?>', '<?= $id_visit->id?>')" id="confirmar" class="btn btn-danger btn-md" <?= $result_state_disabled ?> type="button"><?= $result_state = $result['result']['refference'] =="Abierta" ? "Finalizar" : "Finalizada" ?></button>
              </div>
            </div>

            <ul class="nav nav-tabs navlistscroll" style="border-top: 1px solid #ddd; margin-top: 5px;">
              <?php if ($this->rbac->hasPrivilege('opd_lab_investigation', 'can_view')): ?>
              <li> <a href="#overview" class="active" data-toggle="tab" aria-expanded="true"><i class="icon1 fa fa-th font-tab"></i> Visión general</a></li>
              <?php endif ?>
              <?php if ($this->rbac->hasPrivilege('opd_lab_investigation', 'can_view')): ?>
              <li> <a href="#pre_anesthetic" class="active" data-toggle="tab" aria-expanded="true"><i class="icon1 fa fa-th font-tab"></i> Consulta preanestesica </a></li>
              <?php endif ?>

              <?php if ($this->rbac->hasPrivilege('opd_operation_theatre', 'can_view')) { ?>
              <li>
                <a href="#admision_cirugia" data-toggle="tab" aria-expanded="true">
                        <i class="icon1 fas fa-file-medical font-tab"></i> 
                        Admisión - Preoperatorio
                      </a>
              </li>
              <?php }  ?>

              <?php if ($this->rbac->hasPrivilege('opd_timeline', 'can_view')) { ?>
              <li>
                <a href="#transoperatorio_cirugia" data-toggle="tab" aria-expanded="true">
                          <i class= "icon1 far fa-address-book font-tab"></i> 
                          Transoperatorio
                      </a>
              </li>
              <?php } ?>

              <?php if ($this->rbac->hasPrivilege('opd_timeline', 'can_view')) { ?>
              <li>
                <a href="#postsoperatorio_cirugia" data-toggle="tab" aria-expanded="true">
                          <i class="icon1 fas fa-notes-medical" style='font-size:20px;color:#1563B0'></i> 
                          Post operatorio
                      </a>
              </li>
              <?php } ?>
            </ul>


            <div class="tab-content pt6">

              <div class="tab-pane tab-content-height active" id="overview">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 border-r">
                    <div class="box-header border-b mb10 pl-0" style="padding: 12px;">
                      <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14" style="margin-right: 20px;">
                        <?php echo $result['result']['patient_name'] ;?>
                        <?php echo $result['result']['guardian_name'] ;?>
                        <?php echo $result['result']['id'] ;?>
                      </h3>
                      <div class="pull-right">
                        <a href="
                                          <?php echo base_url() ." admin/patient/profile/ ".$result['result']['patient_id'] ."/ ". $result['result']["id "] ?>" id="" class="btn btn-md revisitpatient" style="background:#1563B0; color:#fff;border-radius: 30px;"
                          data-toggle="tooltip" title="Perfil">
                                          <i class="fas fa-arrow-circle-left"></i> Paciente
                                      </a>
                      </div>
                      <div class="pull-right">
                        <div class="editviewdelete-icon pt8 text-center">
                          <input type="hidden" name="visitid" id="visitid" class="form-control" />
                          <input type="hidden" id="patient_diag">
                          <input type="hidden" id="result_opdid" name="" value="
                                          <?php echo $result['id'] ?>">
                          <input type="hidden" id="result_pid" name="" value="
                                          <?php echo $result['patient_id'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 col-sm-12 ptt10">
                        <?php
                                              $image = $result['result']['image'];
                                              if (!empty($image)) {
                                                  $file = $result['result']['image'];
                                              } else {
                                                  $file = "uploads/patient_images/no_image.png";
                                              } ?>
                          <img style="width:auto !important; height:90px !important;" class="profile-user-img img-responsive img-rounded" src="
                                      <?php echo base_url(); ?>
                                      <?php echo $file.img_time() ?>">
                      </div>
                      <!--./col-lg-5-->
                      <div class="col-lg-9 col-md-8 col-sm-12">
                        <table class="table table-bordered mb0">
                          <tr>
                            <td class="bolds" style="padding:0px">
                              <?php echo $this->lang->line('age'); ?>:
                            </td>
                            <td style="padding:0px">
                              <span>
                                                  <?php echo $this->customlib->getPatientAge($result['result']['age'],$result['result']['month'],$result['result']['day']); ?>
                                                  </span>
                            </td>
                          </tr>
                          <tr>
                            <td class="bolds" style="padding:0px">
                              <?php echo $this->lang->line('gender'); ?>
                            </td>
                            <td style="padding:0px">
                              <?php echo $result['result']['gender']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="bolds" style="padding:0px">
                              <?php echo $this->lang->line('guardian_name')?>
                            </td>
                            <td style="padding:0px">
                              <?php echo $result['result']['guardian_name']; ?>
                            </td>
                          </tr>
                          <tr>
                            <!--                                                         <td class="bolds">
                                              <?php echo $this->lang->line('phone'); ?></td> -->
                            <td class="bolds" style="padding:0px">Tipo de Documento</td>
                            <td style="padding:0px">
                              <?php echo $result['result']['insurance_validity']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="bolds" style="padding:0px">
                              <?php echo $this->lang->line('identification_number'); ?>
                            </td>
                            <td style="padding:0px">
                              <?php echo $result['result']['identification_number']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="bolds" style="padding:0px">
                              <?php echo $this->lang->line('blood_group'); ?>
                            </td>
                            <td style="padding:0px">
                              <?php echo $result['result']['blood_group_name']; ?>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <!--./col-lg-7-->
                    </div>
                    <!--./row-->
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <hr class="hr-panel-heading hr-10">
                        <p>
                          <strong>
                                              <i class="fas fa-user-injured"></i> 
                                              Motivo Consulta
                                          </strong>
                        </p>
                        <hr class="hr-panel-heading hr-10">
                        <table class="table table-bordered mb0">
                          <ul>
                            <li>
                              <?= $doctor_app[0]->reason_consultation ?>
                            </li>
                          </ul>
                        </table>
                      </div>
                    </div>
                    <hr class="hr-panel-heading hr-10">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <hr class="hr-panel-heading hr-10">
                      <p>
                        <strong>
                                          <i class="fas fa-briefcase-medical"></i> Notas de enfermería
                                      </strong>
                      </p>
                      <hr class="hr-panel-heading hr-10">
                      <div class="timeline-header no-border pb1">
                        <div id="timeline_list">
                          <?php if (empty($nurse_note)) { ?>
                          <?php } else { ?>
                          <ul class="timeline timeline-inverse">
                            <?php for ($i=0; $i <$recent_record_count; $i++) { if (!empty($nurse_note[$i])) { $id = $nurse_note[$i]['id']; ?>
                            <li class="time-label">
                              <span class="bg-blue">
                                              <?php echo $this->customlib->YYYYMMDDHisTodateFormat($nurse_note[$i]['date']); ?>
                                          </span>
                            </li>
                            <li>
                              <i class="fa fa-list-alt bg-blue"></i>
                              <div class="timeline-item">
                                <h3 class="timeline-header text-aqua">
                                  <?php echo $nurse_note[$i]['name'].' '.$nurse_note[$i]['surname']." ( ".$nurse_note[$i]['employee_id']." )" ; ?>
                                </h3>
                                <div class="timeline-body">
                                  <?php echo $this->lang->line('note') ."
                                              </br>". nl2br($nurse_note[$i]['note']); ?>
                                </div>
                                <div class="timeline-body">
                                  <?php echo $this->lang->line('comment') ."
                                          </br> ". nl2br($nurse_note[$i]['comment']); ?>
                                </div>
                                <?php foreach ($nursenote[$id] as $ckey => $cvalue) {
                                                          if (!empty($cvalue['staffname'])) {
                                                              $comment_by =  " (". $cvalue['staffname']." ".$cvalue['staffsurname'].": " .$cvalue['employee_id'].")";
                                                              $comment_date = $this->customlib->YYYYMMDDHisTodateFormat($cvalue['created_at'], $this->customlib->getHospitalTimeFormat());
                                                          }?>
                                <div class="timeline-body">
                                  <?php echo nl2br($cvalue['comment_staff']);
                                                              if($is_discharge) { if ($this->rbac->hasPrivilege('nurse_note', 'can_delete')) { ?>
                                  <?php }}?>
                                  <div class="text-right mb0 ptt10">
                                    <?php echo $comment_date." ". $comment_by ?>
                                  </div>
                                </div>
                                <?php  } ?>
                              </div>
                            </li>
                            <?php }} ?>
                            <li>
                              <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                      <hr>
                    </div>
                  </div>
                  <!--./col-lg-6-->
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <hr class="hr-panel-heading hr-10">
                    <div class="col-md-12 d-flex" style="line-height: normal;">
                      <div class="col-md-6">
                        <p class="text-uppercase font14">
                          <span class="bolds">Medico consultor: &nbsp;</span>
                          <?php echo $result['result']['name'] ?>
                          <?php echo $result['result']['surname'] ?>
                        </p>
                        <p class="font14">
                          <span class="text-uppercase bolds">Mensaje: &nbsp;</span>
                          <?php echo $doctor_app[0]->message; ?>
                        </p>
                        <hr class="hr-panel-heading hr-10">
                      </div>
                      <div class="col-md-6">
                        <div class="text-center text-light" style="margin.top:15px;">
                          <?php 
                                          if (empty($DataAll)) { 
                                      ?>
                          <a href="#" class="btn btn-md" style="background:#1563B0; color:#fff; border-radius: 30px; margin-bottom:15px;" onclick="add_equipo('<?= $opdid ?>')" data-toggle="tooltip" data-original-title="Historia Clínica">
                                          <i class="fa fa-group"></i>  
                                          Equipo
                                      </a>
                          <?php 
                                      } else {
                                      echo '<p class="">
                                                  <strong style="color:#1563b0;font-size:23px;">
                                                  <i class="fa fa-group"></i> datos del equipo 
                                                  </strong>
                                              </p>';
                                      } ?>
                        </div>
                      </div>
                    </div>
                    <!--./col-lg-5-->
                    <div class="col-lg-12 col-md-12 col-sm-12 " style="border:solid #1563b0 0.5px;border-radius:15px;padding:25px;">
                      <?php if (!empty($DataAll)) {
                                      $operation = reset($DataAll);
                                  ?>
                      <div class=" col-12 pull-right">
                        <input type="hidden" value="
                                      <?php echo $operation['id']; ?>">
                        <i class="fas fa-edit ml-2" onclick="editot(
                                          <?php echo $operation['id']; ?>)" style='font-size:23px; padding:15px; color:#1563b0;' title="Actualizar">
                                      </i>
                      </div>
                      <p>
                        <strong style=" color:#1563b0;">Nº:</strong>
                        <?php echo $operation['id']; ?>
                      </p>
                      <p>
                        <strong style=" color:#1563b0;">Fecha: </strong>
                        <?php echo $operation['date']; ?>
                      </p>
                      <p>
                        <strong style=" color:#1563b0;">Tipo de operación: </strong>
                        <?php echo $operation['operation_type']; ?>
                      </p>
                      <p>
                        <strong style=" color:#1563b0;">Vía: </strong>
                        <?php echo $operation['Via']; ?>
                      </p>
                      <p>
                        <strong style=" color:#1563b0;">Lateralidad: </strong>
                        <?php echo $operation['Laterality']; ?>
                      </p>
                      <p>
                        <strong style=" color:#1563b0;">Anestesiólogo: </strong>
                        <?php echo $anestesiologo[0]->name." ".$anestesiologo[0]->surname; ?>
                      </p>
                      <p>
                        <strong style=" color:#1563b0;">Descripción De Anestecia: </strong>
                        <?php echo $operation['descrition_anaethesia']; ?>
                      </p>
                      <p>
                        <strong style=" color:#1563b0;">Enfermero: </strong>
                        <?php echo $aux_enfermeria[0]->name." ".$aux_enfermeria[0]->surname; ?>
                      </p>
                      <p>
                        <strong style=" color:#1563b0;">Descripción procedimiento: </strong>
                        <?php echo $operation['remark']; ?>
                      </p>
                      <p>
                        <strong style=" color:#1563b0;">sugerencias y conclusiones: </strong>
                        <?php echo $operation['Surgery_conclusions']; ?>
                      </p>
                      <p>
                        <strong style=" color:#1563b0;">resultado: </strong>
                        <?php echo $operation['result']; ?>
                      </p>
                      <?php
                                  } else {
                                      echo "<p>No hay datos disponibles.</p>";
                                  } ?>
                    </div>
                  </div>
                  <!--./col-lg-6-->
                </div>
                <!--./row-->
              </div>
              <!--#/overview-->



              <div class="tab-pane" id="pre_anesthetic">
                <div class="box-tab-header" style="margin: 0px !important;">
                  <div style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                    <h4 class="box-tab-title" style="margin:0px; padding:15px;">Consulta preanestésica</h4>
                  </div>
                </div>
                <div class="download_label">
                  <?php echo composePatientName($result['patient_name'],$result['patient_id']) . " " . $this->lang->line('opd_details'); ?>
                </div>
                <?php foreach($result['custom'] as $key=>$value){ if($value->custom_field_id==62){ $field_value= $value->field_value;}} ?>
                <div class="row">
                  <form id="insert_pre_anesthetic" method="post" accept-charset="utf-8" class="ptt10">

                    <div class="panel-body">
                      <div class="col-lg-3 col-md-4 col-sm-12 ptt10">
                        <?php
                                      $image = $result['result']['image'];
                                      if (!empty($image)) {
                                          $file = $result['result']['image'];
                                      } else {
                                          $file = "uploads/patient_images/no_image.png";
                                      } ?>
                          <img style="width:auto !important; height:90px !important;" class="profile-user-img img-responsive img-rounded" src="
                              <?php echo base_url(); ?>
                              <?php echo $file.img_time() ?>">
                      </div>
                      <!--./col-lg-5-->
                      <div class="col-lg-9 col-md-8 col-sm-12">
                        <table class="table table-bordered mb0">
                          <tr>
                            <td class="bolds" style="padding:0px">
                              <?php echo $this->lang->line('age'); ?>:
                            </td>
                            <td style="padding:0px">
                              <span>
                                          <?php echo $this->customlib->getPatientAge($result['result']['age'],$result['result']['month'],$result['result']['day']); ?>
                                          </span>
                            </td>
                          </tr>
                          <tr>
                            <td class="bolds" style="padding:0px">
                              <?php echo $this->lang->line('gender'); ?>
                            </td>
                            <td style="padding:0px">
                              <?php echo $result['result']['gender']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="bolds" style="padding:0px">
                              <?php echo $this->lang->line('guardian_name')?>
                            </td>
                            <td style="padding:0px">
                              <?php echo $result['result']['guardian_name']; ?>
                            </td>
                          </tr>
                          <tr>
                            <!--                                                         <td class="bolds">
                                      <?php echo $this->lang->line('phone'); ?></td> -->
                            <td class="bolds" style="padding:0px">Tipo de Documento</td>
                            <td style="padding:0px">
                              <?php echo $result['result']['insurance_validity']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="bolds" style="padding:0px">
                              <?php echo $this->lang->line('identification_number'); ?>
                            </td>
                            <td style="padding:0px">
                              <?php echo $result['result']['identification_number']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="bolds" style="padding:0px">
                              <?php echo $this->lang->line('blood_group'); ?>
                            </td>
                            <td style="padding:0px">
                              <?php echo $result['result']['blood_group_name']; ?>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <!--./col-lg-7-->

                    </div>
                    <!--./row-->


                    <div class="row">
                      <div class="col-sm-12">
                        <div id="accordion1" class="panel-group" style="margin: 15px 20px;">
                          <div class="panel panel-default" style="border-radius: 20px;">
                            <div class="panel-heading" style="border-radius: 10px; background-color: #a2cddf; color: #444;">
                              <h4 class="panel-title" style="color: #444;">
                                <a class="collapsed" style="color: #fff;" role="button" data-toggle="collapse" data-parent="#accordion0" href="#general_information" aria-expanded="false">
                                    <i class="more-less fa fa-plus" style="color: #1563b0;"></i>
                                     Información general
                                </a>
                              </h4>
                            </div>
                            <div id="general_information" class="panel-collapse collapse">
                              <div class="panel-body">

                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label for="medication_indication">Información general</label>
                                    <textarea name="general_information" class="form-control" autocomplete="off" style="resize: none;" <?= $result_state_readonly?>></textarea>
                                  </div>
                                </div>

                                <div class="col-lg-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <label for="appointment_priority">Lateralidad:</label>
                                    <div class="input-group">
                                      <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-sort-amount-up"></i></span>
                                      <select class="form-control" id="appointment_priority" name="appointment_priority" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                          <option value="" hidden>Lateralidad</option>
                                          <option value="Alta" >Alta</option>
                                          <option value="Media">Media</option>
                                          <option value="Baja">Baja</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-lg-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <label for="appointment_priority">Cirujanó:</label>
                                    <div class="input-group">
                                      <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-sort-amount-up"></i></span>
                                      <select class="form-control" id="appointment_priority" name="appointment_priority" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                          <option value="" hidden>Seleccione</option>
                                          <option value="Alta" >Alta</option>
                                          <option value="Media">Media</option>
                                          <option value="Baja">Baja</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-sm-12">
                        <div id="accordion2" class="panel-group" style="margin: 15px 20px;">
                          <div class="panel panel-default" style="border-radius: 20px;">
                            <div class="panel-heading" style="border-radius: 10px; background-color: #a2cddf; color: #444;">
                              <h4 class="panel-title" style="color: #444;">
                                <a class="collapsed" style="color: #fff;" role="button" data-toggle="collapse" data-parent="#accordion1" href="#diagnosis" aria-expanded="false" aria-controls="collapseExample6">
                                    <i class="more-less fa fa-plus" style="color: #1563b0;"></i>
                                     Diagnósticos
                                </a>
                              </h4>
                            </div>
                            <div id="diagnosis" class="panel-collapse collapse">
                              <div class="panel-body">

                                <div class="row" style="margin: 0px 0px; padding: 7px;">
                                  <div class="row" style="margin: 0px 0px 0px 0px; padding: 3px;">
                                    <div class="row" style="justify-content: center; margin-bottom: 10px;">
                                      <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="form-group">
                                          <label>Diagnóstico</label>
                                          <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span>
                                            <input type="text" class="form-control search_text" id="search_diagnosis" name="preanesthetic_diagnosis" onkeyup="filter_diagnosis()" placeholder="Buscar diagnostico" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                            <span class="text-danger"></span>
                                          </div>
                                          <div class="usersearchlist">
                                            <ul class="list-group scroll-container mb-3" style="position: absolute; z-index: 100; width: 100%;" id="diagnosis_result" hidden>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                     <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                          <label for="" class="control-label">Tipo de diagnóstico</label>
                                          <small class="req"> *</small>
                                          <select id="type_diagnostic" name="" class="form-control" autocomplete="off">
                                              <option value="">Tipo de diagnóstico</option>
                                              <option value="Impresión Diagnóstica">Impresión Diagnóstica</option>
                                              <option value=" Confirmado Nuevo" selected="selected"> Confirmado Nuevo</option>
                                              <option value=" Confirmado Repetido"> Confirmado Repetido</option>
                                          </select>
                                          <span class="text-danger"></span>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="" class="control-label">Nota diagnóstico</label>
                                          <textarea id="note_diagnostic" name="" class="form-control"></textarea>
                                          <span class="text-danger"></span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card-body">
                                    </div>
                                  </div>

                                  <div class="col-md-12" style="">
                                    <div class="col-md-12 mb-5" style="padding: 15px 5px; gap: 12px; display: flex; justify-content: end;">
                                      <div class="">
                                        <button type="button" data-loading-text="Procesando..." onclick="table_diagnosis(`primario`)" class="btn pull-right" style="background: #1563B0 !important; color: #fff;" autocomplete="off"><i class="fa fa-plus"></i> Diagnóstico Primario</button>
                                      </div>
                                      <div class="">
                                        <button type="button" onclick="table_diagnosis(`secundario`)" class="btn pull-right" style="background: #1563B0 !important; color: #fff;" autocomplete="off"><i class="fa fa-plus"></i> Diagnóstico Secundario</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="" style="margin-bottom: 15px; padding: 3px;">
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


                    <div class="row">
                      <div class="col-sm-12">
                        <div id="accordion3" class="panel-group" style="margin: 15px 20px;">
                          <div class="panel panel-default" style="border-radius: 20px;">
                            <div class="panel-heading" style="border-radius: 10px; background-color: #a2cddf; color: #444;">
                              <h4 class="panel-title" style="color: #444;">
                                <a class="collapsed" style="color: #fff;" role="button" data-toggle="collapse" data-parent="#accordion2" href="#antecedentes" aria-expanded="false" aria-controls="collapseExample6">
                                    <i class="more-less fa fa-plus" style="color: #1563b0;"></i>
                                    Antecedentes
                                </a>
                              </h4>
                            </div>
                            <div id="antecedentes" class="panel-collapse collapse">
                              <div class="panel-body">

                                <div class="row" style="margin: 0px 0px; padding: 7px;">
                                  <div class="row" style="margin: 25px 0px; padding: 3px;">
                                    <div class="row" style="display: flex; justify-content: center;">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="col-md-12" style="display: flex; margin-bottom: 5px; gap: 9px; justify-content: space-between;">
                                          <div class="col-9">
                                            <label for="checkbox_pathological" class="control-label" style="display: inline;">
                                                <i class="fas fa-notes-medical" style="font-size: 15px; color: #1563B0;"></i> 
                                                Patológicos
                                            </label>
                                          </div>
                                          <div class="col-3">
                                            <span class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="checkbox_pathological" onclick="check_antecedentes('pathological')">No refiere
                                                </label>
                                            </span>
                                          </div>
                                        </div>
                                        <textarea id="" name="" class="form-control" autocomplete="off"></textarea>
                                        <span class="text-danger"></span>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="col-md-12" style="display: flex; margin-bottom: 5px; gap: 9px; justify-content: space-between;">
                                          <div class="col-9">
                                            <label for="" class="control-label" style="display: inline;">
                                                <i class="fas fa-notes-medical" style="font-size: 15px; color: #1563B0;"></i> 
                                                Familiares
                                            </label>
                                          </div>
                                          <div class="col-3">
                                            <span class="form-check">
                                                  <label class="form-check-label">
                                                      <input type="checkbox" class="form-check-input" name="optradio" onclick="check_antecedentes('custom_fields[opd][76]')">No refiere
                                                  </label>
                                              </span>
                                          </div>
                                        </div>
                                        <textarea id="preanesthetic_pathological" name="preanesthetic_pathological" class="form-control" autocomplete="off"></textarea>
                                        <span class="text-danger"></span>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="col-md-12" style="display: flex; margin-bottom: 5px; gap: 9px; justify-content: space-between;">
                                          <div class="col-9">
                                            <label for="checkbox_pharmacological" class="control-label" style="display: inline;">
                                                <i class="fas fa-notes-medical" style="font-size: 15px; color: #1563B0;"></i> 
                                                Farmacológicos
                                            </label>  
                                          </div>
                                          <div class="col-3">
                                            <span class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="checkbox_pharmacological" onclick="check_antecedentes('pharmacological')">No refiere
                                                </label>
                                            </span>
                                          </div>
                                        </div>
                                        <textarea id="preanesthetic_pharmacological" name="preanesthetic_pharmacological" class="form-control" autocomplete="off"></textarea>
                                        <span class="text-danger"></span>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="col-md-12" style="display: flex; margin-bottom: 5px; gap: 9px; justify-content: space-between;">
                                          <div class="col-9">
                                            <label for="checkbox_transfusions" class="control-label" style="display: inline;">
                                                <i class="fas fa-notes-medical" style="font-size: 15px; color: #1563B0;"></i> 
                                                Transfusiones
                                            </label>
                                          </div>
                                          <div class="col-3">
                                              <span class="form-check">
                                                  <label class="form-check-label">
                                                      <input type="checkbox" class="form-check-input" id="checkbox_transfusions" name="checkbox_transfusions" onclick="check_antecedentes('transfusions')">No refiere
                                                  </label>
                                              </span>
                                          </div>
                                        </div>
                                        <textarea id="preanesthetic_transfusions" name="preanesthetic_transfusions" class="form-control" autocomplete="off"></textarea>
                                        <span class="text-danger"></span>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="col-md-12" style="display: flex; margin-bottom: 5px; gap: 9px; justify-content: space-between;">
                                          <div class="col-9">
                                            <label for="checkbox_toxic" class="control-label" style="display: inline;">
                                                <i class="fas fa-notes-medical" style="font-size: 15px; color: #1563B0;"></i> 
                                                Tóxicos
                                            </label>
                                          </div>
                                          <div class="col-3">
                                            <span class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" id="checkbox_toxic" name="checkbox_toxic" onclick="check_antecedentes('toxic')">No refiere
                                                </label>
                                            </span>
                                          </div>
                                        </div>
                                        <textarea id="preanesthetic_toxic" name="preanesthetic_toxic" class="form-control" autocomplete="off"></textarea>
                                        <span class="text-danger"></span>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="col-md-12" style="display: flex; margin-bottom: 5px; gap: 9px; justify-content: space-between;">
                                          <div class="col-9">
                                            <label for="checkbox_ginecobstetrico" class="control-label" style="display: inline;">
                                                <i class="fas fa-notes-medical" style="font-size: 15px; color: #1563B0;"></i> 
                                                Ginecobstetrico
                                            </label>
                                          </div>
                                          <div class="col-3">
                                            <span class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" id="checkbox_ginecobstetrico" name="checkbox_ginecobstetrico" onclick="check_antecedentes('ginecobstetrico')">No refiere
                                                </label>
                                            </span>
                                          </div>
                                        </div>
                                        <textarea id="preanesthetic_ginecobstetrico" name="preanesthetic_ginecobstetrico" class="form-control" autocomplete="off"></textarea>
                                        <span class="text-danger"></span>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="col-md-12" style="display: flex; margin-bottom: 5px; gap: 9px; justify-content: space-between;">
                                          <div class="col-9">
                                            <label for="custom_fields[opd][76]" class="control-label" style="display: inline;">
                                                <i class="fas fa-notes-medical" style="font-size: 15px; color: #1563B0;"></i> 
                                                Alérgicos
                                            </label>
                                          </div>
                                          <div class="col-3">
                                            <span class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox" class="form-check-input" name="optradio" onclick="check_antecedentes('custom_fields[opd][76]')">No refiere
                                                                        </label>
                                                                    </span>
                                          </div>
                                        </div>
                                        <textarea id="" name="" class="form-control" autocomplete="off"></textarea>
                                        <span class="text-danger"></span>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="col-md-12" style="display: flex; margin-bottom: 5px; gap: 9px; justify-content: space-between;">
                                          <div class="col-9">
                                            <label for="checkbox_surgical" class="control-label" style="display: inline;">
                                                <i class="fas fa-notes-medical" style="font-size: 15px; color: #1563B0;"></i> 
                                                Quirúrgicos
                                            </label>
                                          </div>
                                          <div class="col-3">
                                            <span class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="checkbox_surgical" onclick="check_antecedentes('surgical')">No refiere
                                                </label>
                                            </span>
                                          </div>
                                        </div>
                                        <textarea id="preanesthetic_surgical" name="preanesthetic_surgical" class="form-control" autocomplete="off"></textarea>
                                        <span class="text-danger"></span>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="col-md-12" style="display: flex; margin-bottom: 5px; gap: 9px; justify-content: space-between;">
                                          <div class="col-9">
                                            <label for="checkbox_pharmacotherapy" class="control-label" style="display: inline;">
                                                <i class="fas fa-notes-medical" style="font-size: 15px; color: #1563B0;"></i> 
                                                Tratamiento Farmacológico
                                            </label>
                                          </div>
                                          <div class="col-3">
                                              <span class="form-check">
                                                  <label class="form-check-label">
                                                      <input type="checkbox" class="form-check-input" id="checkbox_pharmacotherapy" name="checkbox_pharmacotherapy" onclick="check_antecedentes('pharmacotherapy')">No refiere
                                                  </label>
                                              </span>
                                          </div>
                                        </div>
                                        <textarea id="preanesthetic_pharmacotherapy" name="preanesthetic_pharmacotherapy" class="form-control" autocomplete="off"></textarea>
                                        <span class="text-danger"></span>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="col-md-12" style="display: flex; margin-bottom: 5px; gap: 9px; justify-content: space-between;">
                                          <div class="col-9">
                                            <label for="checkbox_socioeconomic" class="control-label" style="display: inline;">
                                                <i class="fas fa-notes-medical" style="font-size: 15px; color: #1563B0;"></i> 
                                                Socioeconómicos
                                            </label>
                                          </div>
                                          <div class="col-3">
                                            <span class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" id="checkbox_socioeconomic" name="checkbox_socioeconomic" onclick="check_antecedentes('socioeconomic')">No refiere
                                                </label>
                                            </span>
                                          </div>
                                        </div>
                                        <textarea id="preanesthetic_socioeconomic" name="preanesthetic_socioeconomic" class="form-control" autocomplete="off"></textarea>
                                        <span class="text-danger"></span>
                                      </div>
                                    </div>
                                    
                                    
                                     <div class="col-lg-2 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label for="presurgical_pain_scale">Escala de dolor prequirúrgica</label>
                                            <div class="input-group">
                                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-sort-amount-up"></i></span>
                                              <select class="form-control" id="presurgical_pain_scale" name="presurgical_pain_scale" style="border-radius: 0px 10px 10px 0px !important;">
                                                  <option value="" hidden>Seleccione</option>
                                                  <option value="1">1/10</option>
                                                  <option value="2">2/10</option>
                                                  <option value="3">3/10</option>
                                                  <option value="4">4/10</option>
                                                  <option value="5">5/10</option>
                                                  <option value="6">6/10</option>
                                                  <option value="7">7/10</option>
                                                  <option value="8">8/10</option>
                                                  <option value="9">9/10</option>
                                                  <option value="10">10/10</option>
                                              </select>
                                            </div>
                                         </div>
                                      </div>
                                    
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                          <label for="pharmacological_history">Historial farmacológico</label>
                                          <textarea name="pharmacological_history" id="pharmacological_history" class="form-control" autocomplete="off" style="resize: none;"></textarea>
                                        </div>
                                      </div>
                                    
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                          <label for="preanesthetic_paraclinics">Paraclínicos</label>
                                          <textarea name="preanesthetic_paraclinics" id="preanesthetic_paraclinics" class="form-control" autocomplete="off" style="resize: none;"></textarea>
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

                    <div class="row">
                      <div class="col-sm-12">
                        <div id="accordion4" class="panel-group" style="margin: 15px 20px;">
                          <div class="panel panel-default" style="border-radius: 20px;">
                            <div class="panel-heading" style="border-radius: 10px; background-color: #a2cddf; color: #444;">
                              <h4 class="panel-title" style="color: #444;">
                                <a class="collapsed" style="color: #fff;" role="button" data-toggle="collapse" data-parent="#accordion3" href="#physical_exam" aria-expanded="false">
                                    <i class="more-less fa fa-plus" style="color: #1563b0;"></i>
                                    Examen fisico preanestecia.
                                </a>
                              </h4>
                            </div>
                            <div id="physical_exam" class="panel-collapse collapse">
                              <div class="panel-body">

                                <div class="row" style="margin: 0px 0px;padding: 7px;">
                                  <div class="row" style="margin: 0px;padding: 0px;">
                                    <div class="row" style="display: flex;justify-content: center;">
                                      <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                        <b>Medidas Antropométricas</b>
                                      </div>
                                    </div>
                                    <div class="row" style="display: flex;justify-content: center;align-items: end;">
                                      <div class="col-md-3">
                                        <div style="margin: 20px 0px 0px 0px; font-size:15px;" class="col-12">
                                          <div class="col-2">
                                            <label for="patient size" class="control-label">
                                                <b>Talla</b>
                                                <small class="req"> *</small>
                                            </label>
                                          </div>
                                          <div class="row" style="display: flex;padding:0px 29px 15px 8px;align-items: baseline;">
                                            <div class="col-6" style="width: -webkit-fill-available;">
                                              <div class="input-group">
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                  <i class="fa fa-tags" style="color:#337ab7;"></i>
                                                </span>
                                                <div class="col-6" style="width: -webkit-fill-available;">
                                                  <input type="number" style="border-radius: 0px 10px 10px 0px !important;" onchange="imc()" id="talla_custom" name="patient_size" class="form-control" value="" placeholder="" autocomplete="off">
                                                </div>
                                              </div>
                                            </div>
                                            &nbsp;
                                            <div class="col-2" style="margin-bottom:4px;">
                                              <b><span>Cm</span></b>
                                            </div>
                                            <span class="text-danger"></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div style="margin: 20px 5px 0px 0px; font-size: 15px;" class="col-12">
                                          <div class="col-2">
                                            <label for="patient_weight" class="control-label">
                                             <b>Peso</b><small class="req"> *</small></label>
                                          </div>
                                          <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                            <div class="col-6" style="width: -webkit-fill-available;">
                                              <div class="input-group">
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                   <i class="fas fa-download" style="color:#337ab7;"></i>
                                                </span><input type="number" onchange="imc()" style="border-radius: 0px 10px 10px 0px !important;" id="peso_custom" name="patient_weight" class="form-control" value="" placeholder="">
                                              </div>
                                            </div>
                                            &nbsp;
                                            <div class="col-2" style="margin-bottom:4px;">
                                              <b><span> Kg </span></b>
                                            </div>
                                            <span class="text-danger"></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div style="margin: 0px 0px 26px 0px;font-size:15px;" class="col-12">
                                          <div class="col-2"><label for="patient_imc" class="control-label">
                                             <b>IMC</b><small class="req">*</small></label>
                                          </div>
                                          <div class="col-6" style="width: -webkit-fill-available;">
                                            <div class="input-group">
                                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                 <i class="fa fa-edit" style="color:#337ab7;"></i>
                                              </span>
                                              <div class="col-6" style="width: -webkit-fill-available;">
                                                <input type="text" id="imc_custom" style="border-radius: 0px 10px 10px 0px !important;" class="form-control" value="patient_imc" name="patient_imc" placeholder="">
                                              </div>
                                            </div>
                                            <span class="text-danger"></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div style="margin: 8px 0px;font-size:15px;" class="col-12">
                                          <div class="row" style="padding:0px 25px 18px 25px;">
                                            <div class="row">
                                              <div class="col-4">
                                                <label for="classification_imc" class="control-label">
                                                  <b>Clasificación IMC</b>
                                                </label>
                                              </div>
                                              <div class="col-6" style="width: -webkit-fill-available;">
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                     <i class="fa fa-external-link-square" style="color:#337ab7;"></i>
                                                  </span>
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <input style="border-radius: 0px 10px 10px 0px !important;" type="text" id="clasified_custom" name="classification_imc" class="form-control" value="" placeholder="" disabled="">
                                                    </div>
                                                  </div>
                                                </div>
                                                <span class="text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row" style="margin: 0px;padding: 0px;">
                                      <div class="row" style="display: flex;justify-content: center;">
                                        <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                          <b>Signos Vitales</b>
                                        </div>
                                      </div>
                                      <div class="row" style="display: flex;justify-content: center;align-items: end;">
                                        <div class="col-md-3">
                                          <div style="margin: 20px 5px 0px 0px;font-size:15px;" class="col-12">
                                            <div class="col-2">
                                              <label for="heart_rate" class="control-label">
                                                 <b>Frecuencia Cardíaca</b>
                                                 <small class="req"> *</small>
                                              </label>
                                            </div>
                                            <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                              <div class="col-6" style="width: -webkit-fill-available;">
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                       <i class="fas fa-heart" style="color:#337ab7;"></i>
                                                  </span>
                                                  <div class="col-4" style="width: -webkit-fill-available;">
                                                    <input type="number" style="border-radius: 0px 10px 10px 0px !important;" id="heart_rate" name="cheart_rate" class="form-control" value="" placeholder="">
                                                  </div>
                                                </div>
                                              </div>
                                              &nbsp;
                                              <div class="col-2" style="margin-bottom:4px;">
                                                <b><span>LPM</span></b>
                                              </div>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div style="margin: 20px 0px 0px 0px;font-size:15px;" class="col-12">
                                            <div class="col-2">
                                              <label for="breathin_frequency" class="control-label">
                                                 <b>Frecuencia Respiratoria</b><small class="req"> *</small>
                                              </label>
                                            </div>
                                            <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                              <div class="col-6" style="width: -webkit-fill-available;">
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                      <i class="fas fa-prescription-bottle" style="color:#337ab7;"></i>
                                                  </span>
                                                  <div class="col-4" style="width: -webkit-fill-available;">
                                                    <input type="number" id="breathin_frequency" name="breathin_frequency" style="border-radius: 0px 10px 10px 0px !important;" class="form-control" value="" placeholder="">
                                                  </div>
                                                </div>
                                              </div>
                                              &nbsp;
                                              <div class="col-2" style="margin-bottom:4px;">
                                                <b><span>SRPM</span></b>
                                              </div>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-2">
                                          <div style="margin: 20px 5px 0px 0px;font-size:15px;" class="col-12">
                                            <div class="col-2">
                                              <label for="patient_temperature" class="control-label">
                                                   <b>Temperatura</b>
                                                   <small class="req"> *</small>
                                              </label>
                                            </div>
                                            <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                              <div class="col-6" style="width: -webkit-fill-available;">
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                      <i class="fas fa-thermometer" style="color:#337ab7;"></i>
                                                  </span>
                                                  <div class="col-4" style="width: -webkit-fill-available;">
                                                    <input type="number" id="patient_temperature" style="border-radius: 0px 10px 10px 0px !important;" name="patient_temperature" class="form-control" value="" placeholder="">
                                                  </div>
                                                </div>
                                              </div>
                                              &nbsp;
                                              <div class="col-2" style="margin-bottom:4px;">
                                                <b><span>°C</span></b>
                                              </div>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-2">
                                          <div style="margin: 20px 5px 0px 0px;font-size:15px;" class="col-12">
                                            <div class="col-2">
                                              <label for="patient_saturation" class="control-label">
                                                  <b>Saturación de 02 sin Oxígeno</b>
                                              </label>
                                            </div>
                                            <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                              <div class="col-6" style="width: -webkit-fill-available;">
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                      <i class="fas fa-thermometer" style="color:#337ab7;"></i>
                                                  </span>
                                                  <div class="col-4" style="width: -webkit-fill-available;">
                                                    <input type="text" id="patient_saturation" style="border-radius: 0px 10px 10px 0px !important;" name="patient_saturation" class="form-control" value="" placeholder="">
                                                  </div>
                                                </div>
                                              </div>
                                              &nbsp;
                                              <div class="col-2" style="margin-bottom:4px;">
                                                <b><span>%</span></b>
                                              </div>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-2">
                                          <div style="margin: 20px 5px 0px 0px;font-size:15px;" class="col-12">
                                            <div class="col-2">
                                              <label for="patient_saturation_oxygen" class="control-label">
                                                   <b>Saturación de O2 con Oxígeno</b>
                                              </label>
                                            </div>
                                            <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                              <div class="col-6" style="width: -webkit-fill-available;">
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                     <i class="fas fa-thermometer" style="color:#337ab7;"></i>
                                                  </span>
                                                  <div class="col-4" style="width: -webkit-fill-available;">
                                                    <input type="text" id="patient_saturation_oxygen" name="patient_saturation_oxygen" style="border-radius: 0px 10px 10px 0px !important;" class="form-control" value="" placeholder="">
                                                  </div>
                                                </div>
                                              </div>
                                              &nbsp;
                                              <div class="col-2" style="margin-bottom:4px;">
                                                <b><span>%</span></b>
                                              </div>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row" style="margin: 0px;padding: 0px;">
                                      <div class="row" style="display: flex;justify-content: center;">
                                        <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                          <b>Presión Arterial</b>
                                        </div>
                                      </div>
                                      <div class="row" style="display: flex;justify-content: center;align-items: end;">
                                        <div class="col-md-3">
                                          <div style="margin: 20px 0px 0px 0px;font-size:15px;" class="col-12">
                                            <div class="col-2">
                                              <label for="systolic_blood_pressure" class="control-label">
                                                <b>Presión Arterial Sistólica </b>
                                                <small class="req"> *</small>
                                              </label>
                                            </div>
                                            <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                              <div class="col-6" style="width: -webkit-fill-available;">
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                    <i class="fa fa-heart" style="color:#337ab7;"></i>
                                                    </span><input type="number" style="border-radius: 0px 10px 10px 0px !important;" id="systolic_blood_pressure" name="systolic_blood_pressure" class="form-control" value="" placeholder="">
                                                </div>
                                              </div>
                                              &nbsp;
                                              <div class="col-2" style="margin-bottom: 4px;">
                                                <b><span> mmHg </span></b>
                                              </div>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div style="margin: 20px 0px 0px 0px;font-size:15px;" class="col-12">
                                            <div class="col-2">
                                              <label for="diastolic_blood_pressure" class="control-label">
                                                  <b>Presión Arterial Diastólica </b>
                                                  <small class="req"> *</small>
                                               </label>
                                            </div>
                                            <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                              <div class="col-6" style="width: -webkit-fill-available;">
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                      <i class="fa fa-heart" style="color:#337ab7;"></i>
                                                  </span>
                                                  <input type="number" style="border-radius: 0px 10px 10px 0px !important;" id="diastolic_blood_pressure" name="diastolic_blood_pressure" class="form-control " value="" placeholder="">
                                                </div>
                                              </div>
                                              &nbsp;
                                              <div class="col-2" style="margin-bottom:4px;">
                                                <b><span> mmHg </span></b>
                                              </div>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group" style="margin: 18px 0px 21px 0px;font-size:15px;">
                                            <label for="position_blood_pressure" class="control-label">Posición Presión Arterial</label><small class="req"> *</small>
                                            <div class="col-6" style="width: -webkit-fill-available;">
                                              <div class="input-group">
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                    <i class="fa fa-tint" style="color:#337ab7;font-size: 15px"> </i>
                                                </span>
                                                <select id="position_blood_pressure" name="position_blood_pressure" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                                   <option value="">Selecione</option>
                                                   <option id="causaExterna2" value="Sentado">Sentado</option>
                                                   <option id="causaExterna2" value=" Acostado boca arriba"> Acostado boca arriba</option>
                                                </select>
                                                <span class="text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group" style="margin: 18px 0px 21px 0px;font-size:15px;">
                                            <label for="location_blood_pressure" class="control-label">Lugar Presión Arterial</label><small class="req"> *</small>
                                            <div class="col-6" style="width: -webkit-fill-available;">
                                              <div class="input-group">
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                    <i class="fa fa-tint" style="color:#337ab7;font-size: 15px"> </i>
                                                </span>
                                                <select id="location_blood_pressure" name="location_blood_pressure" style="border-radius: 0px 10px 10px 0px !important;" class="form-control">
                                                   <option value="">Selecione</option>
                                                   <option id="causaExterna2" value="Brazo derecho">Brazo derecho</option>
                                                   <option id="causaExterna2" value=" Brazo izquierdo"> Brazo izquierdo</option>
                                                </select>
                                                <span class="text-danger"></span>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row" style="margin: 15px 0px;padding: 3px;">
                                        <div class="row" style="margin-bottom: 10px;padding: 0px;">
                                          <div class="row" style="display: flex;justify-content: center;margin-bottom: 21px;">
                                            <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                              <b>Apariencia General</b>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <div class="col-md-12" style="display:flex; margin-bottom:5px;gap:0px;justify-content: space-between;">
                                                <div class="col-9">
                                                <label for="checkbox_general_condition" class="control-label" style="display: inline;">
                                                 <i class="fas fa-notes-medical" style="font-size:15px;color:#1563B0;"></i> 
                                                 Estado general del paciente
                                                 </label><br>
                                                  <span style="color:#1563B0;display: inline;">
                                                 <small>Apariencia general</small>
                                                 </span>
                                                </div>
                                                <div class="col-3">
                                                  <span class="form-check" style="display: inline;">
                                                     <label class="form-check-label">
                                                       <input type="checkbox" class="form-check-input" name="checkbox_general_condition" onclick="check_sistemas('general_condition')">Normal
                                                     </label>
                                                  </span>
                                                </div>
                                              </div>
                                              <textarea id="patient_general_condition" name="patient_general_condition" class="form-control"></textarea>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <div class="col-md-12" style="display:flex; margin-bottom:5px;gap:0px;justify-content: space-between;">
                                                <div class="col-9">
                                                  <label for="checkbox_head_and_neck" class="control-label" style="display: inline;">
                                                   <i class="fas fa-notes-medical" style="font-size:15px;color:#1563B0;"></i> 
                                                    Cabeza y cuello
                                                   </label><br>
                                                  <span style="color:#1563B0;display: inline;">
                                                   <small> Zonas: Ojos, Naríz, Boca, Cuello, Cráneo</small>
                                                   </span>
                                                </div>
                                                <div class="col-3">
                                                  <span class="form-check" style="display: inline;">
                                                     <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" id="checkbox_head_and_neck" name="checkbox_head_and_neck" onclick="check_sistemas('head_and_neck')">Normal
                                                     </label>
                                                  </span>
                                                </div>
                                              </div>
                                              <textarea id="head_and_neck" name="head_and_neck" class="form-control"></textarea>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <div class="col-md-12" style="display:flex; margin-bottom:5px;gap:9px;justify-content: space-between;">
                                                <div class="col-9">
                                                  <label for="patient_chest" class="control-label" style="display: inline;">
                                                  <i class="fas fa-notes-medical" style="font-size:15px;color:#1563B0;"></i> 
                                                   Torax
                                                  </label><br>
                                                  <span style="color:#1563B0;">
                                                    <small>Zonas: Corazón, mamas y tórax</small>
                                                  </span>
                                                </div>
                                                <div class="col-3">
                                                  <span class="form-check">
                                                     <label class="form-check-label" style="display: inline;">
                                                     <input type="checkbox" class="form-check-input" id="checkbox_patient_chest" name="checkbox_patient_chest" onclick="check_sistemas('patient_chest')">Normal
                                                     </label>
                                                  </span>
                                                </div>
                                              </div>
                                              <textarea id="patient_chest" name="patient_chest" class="form-control"></textarea>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <div class="col-md-12" style="display:flex; margin-bottom:5px;justify-content: space-between;">
                                                <div class="col-9">
                                                  <label for="patient_gastrointestinal" class="control-label" style="margin:0px;">
                                                   <i class="fas fa-notes-medical" style="font-size:15px;color:#1563B0;"></i> 
                                                   Gastrointestinal
                                                  </label><br>
                                                  <span style="color:#1563B0;">
                                                    <small>Zonas: Abdomen, recto y ano</small>
                                                  </span>
                                                </div>
                                                <div class="col-3">
                                                  <span class="form-check">
                                                     <label class="form-check-label" style="display: inline;">
                                                        <input type="checkbox" class="form-check-input" name="optradio" onclick="check_sistemas('patient_gastrointestinal')">Normal
                                                     </label>
                                                  </span>
                                                </div>
                                              </div>
                                              <textarea id="patient_gastrointestinal" name="patient_gastrointestinal" class="form-control"></textarea>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <div class="col-md-12" style="display:flex; margin-bottom:5px;justify-content: space-between;">
                                                <div class="col-9">
                                                  <label for="patient_genetourinario" class="control-label" style="margin:0px;">
                                                   <i class="fas fa-notes-medical" style="font-size:15px;color:#1563B0;"></i> 
                                                   Genetourinario
                                                   </label><br>
                                                   <span style="color:#1563B0;display: inline;">
                                                   <small>Zonas: Genitales (masculinos, femeninos)</small>
                                                   </span>
                                                </div>
                                                <div class="col-3">
                                                   <span class="form-check" style="display: inline;">
                                                     <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="checkbox_patient_genetourinario" onclick="check_sistemas('patient_genetourinario')">Normal
                                                     </label>
                                                   </span>
                                                </div>
                                              </div>
                                              <textarea id="patient_genetourinario" name="patient_genetourinario" class="form-control"></textarea>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <div class="col-md-12" style="display:flex; margin-bottom:5px;gap:0px;justify-content: space-between;">
                                                <div class="col-9">
                                                  <label for="patient_osteomuscular" class="control-label" style="display: inline">
                                                   <i class="fas fa-notes-medical" style="font-size:15px;color:#1563B0;"></i> 
                                                   Osteomuscular
                                                   </label><br>
                                                  <span style="color:#1563B0;display: inline">
                                                   <small>Zonas: Columna, articulaciones, tronco y extremidades</small>
                                                   </span>
                                                </div>
                                                <div class="col-3">
                                                  <span class="form-check" style="display: inline;">
                                                     <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="checkbox_patient_osteomuscular" onclick="check_sistemas('patient_osteomuscular')">Normal
                                                     </label>
                                                  </span>
                                                </div>
                                              </div>
                                              <textarea id="patient_osteomuscular" name="patient_osteomuscular" class="form-control"></textarea>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <div class="col-md-12" style="display:flex; margin-bottom:5px;gap:0px;justify-content: space-between;">
                                                <div class="col-9">
                                                  <label for="vascular_peripheral" class="control-label" style="display: inline;">
                                                   <i class="fas fa-notes-medical" style="font-size:15px;color:#1563B0;"></i> 
                                                   Vascular Periférico
                                                  </label><br>
                                                  <span style="color:#1563B0;display: inline;">
                                                     <small> Zonas: Todo lo que compete al corazón</small>
                                                  </span>
                                                </div>
                                                <div class="col-3">
                                                  <span class="form-check" style="display: inline;">
                                                     <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="checkbox_vascular_peripheral" onclick="check_sistemas('vascular_peripheral')">Normal
                                                     </label>
                                                  </span>
                                                </div>
                                              </div>
                                              <textarea id="vascular_peripheral" name="vascular_peripheral" class="form-control"></textarea>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <div class="col-md-12" style="display:flex; margin-bottom:5px;gap:0px;justify-content: space-between;">
                                                <div class="col-9">
                                                  <label for="skin_and_annexes" class="control-label" style="display: inline; ">
                                                     <i class="fas fa-notes-medical" style="font-size:15px;color:#1563B0;"></i> 
                                                     Piel y anexos
                                                   </label><br>
                                                   <span style="color:#1563B0;display: inline;">
                                                      <small> Zonas: Textura, turgencia, pigmentación, lesiones, uñas y cabello</small>
                                                   </span>
                                                </div>
                                                <div class="col-3">
                                                   <span class="form-check" style="display: inline;">
                                                       <label class="form-check-label">
                                                          <input type="checkbox" class="form-check-input" name="checkbox_skin_and_annexes" onclick="check_sistemas('skin_and_annexes')">Normal
                                                       </label>
                                                   </span>
                                                </div>
                                              </div>
                                              <textarea id="skin_and_annexes" name="skin_and_annexes" class="form-control"></textarea>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <div class="col-md-12" style="display:flex; margin-bottom:5px;gap:0px;justify-content: space-between;">
                                                <div class="col-9">
                                                  <label for="patient_neurological" class="control-label" style="display: inline;">
                                                   <i class="fas fa-notes-medical" style="font-size:15px;color:#1563B0;"></i> 
                                                   Neurológico
                                                   </label><br>
                                                  <span style="color:#1563B0;display: inline;">
                                                  <small>Zonas: Conciencia, reflejos, fuerza muscular, pares craneales</small>
                                                  </span>
                                                </div>
                                                <div class="col-3">
                                                  <span class="form-check" style="display: inline;">
                                                     <label class="form-check-label">
                                                     <input type="checkbox" class="form-check-input" name="checkbox_patient_neurological" onclick="check_sistemas('patient_neurological')">Normal
                                                     </label>
                                                  </span>
                                                </div>
                                              </div>
                                              <textarea id="patient_neurological" name="patient_neurological" class="form-control"></textarea>
                                              <span class="text-danger"></span>
                                            </div>
                                          </div>
                                          
                                          <div class="content">
                                              <div class="col-3 col-md-3 col-sm-3">
                                                  <div class="form-group">
                                                      <label for="preanesthetic_teeth">Dentadura</label><small></small>
                                                      <div class="input-group">
                                                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-prescription-bottle-alt"></i></span>
                                                        <input type="text" class="form-control" autocomplete="off" id="preanesthetic_teeth" name="preanesthetic_teeth" placeholder="" style="border-radius: 0px 10px 10px 0px !important;">
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-3 col-md-3 col-sm-3">
                                                  <div class="form-group">
                                                      <label for="">Predictores ventilación dificil</label>
                                                      <div class="input-group">
                                                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-wheelchair"></i></span>
                                                        <select name="" class="form-control" id="" style="border-radius: 0px 10px 10px 0px !important;">
                                                            <option value="" hidden></option>
                                                            <option value="">No presenta</option>
                                                            <option value="">Obesidad</option>
                                                            <option value="">Roncador</option>
                                                            <option value="">Edad (menor o igual a 1 año o mayor o igual a 55 años)</option>
                                                            <option value="">Alteraciónes anatómicas</option>
                                                            <option value="">Miscélaneos ( adéntulo, barbado, materna)</option>
                                                        </select>
                                                      </div>
                                                  </div>
                                              </div>

                                             <div class="col-3 col-md-3 col-sm-3">
                                                  <div class="form-group">
                                                      <label for="mallampati_scale">Escala de Mallampati</label>
                                                      <div class="input-group">
                                                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-wheelchair"></i></span>
                                                        <select class="form-control" id="mallampati_scale" name="mallampati_scale" style="border-radius: 0px 10px 10px 0px !important;">
                                                            <option value="" hidden></option>
                                                            <option value="I">I</option>
                                                            <option value="II">II</option>
                                                            <option value="III">III</option>
                                                            <option value="IV">IV</option>
                                                        </select>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label for="oral_opening">Apertura oral</label><small></small>
                                                    <div class="input-group">
                                                      <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-prescription-bottle-alt"></i></span>
                                                      <input type="text" class="form-control" autocomplete="off" id="oral_opening" name="oral_opening" placeholder="" style="border-radius: 0px 10px 10px 0px !important;">
                                                    </div>
                                                </div>
                                              </div>

                                              <div class="col-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label for="cervical_extension">Extención cervical</label><small></small>
                                                    <div class="input-group">
                                                      <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-prescription-bottle-alt"></i></span>
                                                      <input type="text" class="form-control" autocomplete="off" id="cervical_extension" name="cervical_extension" placeholder="" style="border-radius: 0px 10px 10px 0px !important;">
                                                    </div>
                                                </div>
                                              </div>

                                             <div class="col-3 col-md-3 col-sm-3">
                                                 <div class="form-group">
                                                    <label for="thyromental_distance">Distancia tiromentoniana</label><small></small>
                                                    <div class="input-group">
                                                      <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-prescription-bottle-alt"></i></span>
                                                      <input type="text" class="form-control" autocomplete="off" id="thyromental_distance" name="thyromental_distance" placeholder="" style="border-radius: 0px 10px 10px 0px !important;">
                                                    </div>
                                                 </div>
                                              </div>

                                              <div class="col-sm-12">
                                                <div class="form-group">
                                                  <label for="preanesthetic_observations">Observaciónes</label>
                                                  <textarea id="preanesthetic_observations" name="preanesthetic_observations" class="form-control" autocomplete="off" style="resize: none;"></textarea>
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
                      </div>
                    </div>



<!--                     <div class="col-lg-6 col-md-6 col-sm-6" style="margin-top:10px;">
                      <div class="form-group">
                        <label>Diagnóstico</label>
                        <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span>
                          <input type="text" class="form-control search_text" id="search_diagnosis" name="preanesthetic_diagnosis" onkeyup="filter_diagnosis()" placeholder="Buscar diagnostico" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                          <span class="text-danger"></span>
                        </div>
                        <div class="usersearchlist">
                          <ul class="list-group scroll-container mb-3" style="position: absolute; z-index: 100; width: 100%;" id="diagnosis_result" hidden>
                          </ul>
                        </div>
                      </div>
                    </div> -->

                    <div class="col-lg-6 col-md-6 col-sm-6" style="margin-top:10px;">
                      <div class="form-group">
                        <label>Examenes y Ayudas diagnósticas</label>
                        <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span>
                          <input type="text" class="form-control search_text" id="search_cups" onkeyup="cups_structure()" placeholder="Buscar prestación" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                          <span class="text-danger"></span>
                        </div>
                        <div class="usersearchlist">
                          <ul class="list-group scroll-container mb-3" style="position: absolute; z-index: 100;" id="cups_result" hidden>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-4 col-sm-4">
                      <div class="form-group">
                        <label>Ayuda diagnóstica</label>
                        <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-hands-helping"></i></span>
                          <input type="text" class="form-control" autocomplete="off" value="" id="product_cups" name="product_cups" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                          <span class="text-danger"></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4 mb-5">
                      <div class="form-group">
                        <label>Código</label>
                        <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-file-code"></i></span>
                          <input type="text" class="form-control" autocomplete="off" id="codigo_cups" value="" name="codigo_cups" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                          <span class="text-danger"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4">
                      <div class="form-group">
                        <label>Cantidad</label>
                        <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-sort-amount-up"></i></span>
                          <input type="number" class="form-control" autocomplete="off" id="" name="quantity_procedure" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                          <span class="text-danger"></span>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4">
                      <div class="form-group">
                        <label for="appointment_priority">Prioridad:</label>
                        <div class="input-group">
                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-sort-amount-up"></i></span>
                          <select class="form-control" id="appointment_priority" name="appointment_priority" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                <option value="" hidden>Seleccione</option>
                                <option value="Alta" >Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                              </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="medication_indication">Observación</label>
                        <textarea name="observations" class="form-control" autocomplete="off" style="resize: none;" <?= $result_state_readonly?>></textarea>
                      </div>
                    </div>

                    <div class="modal-footer" style="border: none;">
                      <div class="pull-right">
                        <button type="submit" class="btn border" style="background:#1563b0; color:#fff;" autocomplete="off" <?= $result_state_disabled?>><i class="fa fa-check-circle"></i> Guardar</button>
                      </div>
                    </div>

                  </form>

                  <div class="col-md-12">
                    <div class="blood-body">
                      <div class="blood-pull-left blood-title">Procedimientos realizados en esta consulta</div>
                    </div>
                    <div class="box box-primary">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="table-responsive mailbox-messages">
                              <table class="table table-hover table-striped">
                                <thead>
                                  <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Prioridad</th>
                                    <th>Información general</th>
                                    <th>Diagnóstico</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($procedures_opd as $key => $value): ?>
                                  <tr>
                                    <td>
                                      <?= $value->code_cup ?>
                                    </td>
                                    <td>
                                      <?= $value->procedure_name ?>
                                    </td>
                                    <td>
                                      <?= $value->procedure_cant ?>
                                    </td>
                                    <td>
                                      <?= $value->appointment_priority ?>
                                    </td>
                                    <td>
                                      <?= $value->general_information ?>
                                    </td>
                                    <td>
                                      <?= $value->nombre_diag ?>
                                    </td>
                                  </tr>
                                  <?php endforeach ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="tab-pane tab-content-height " id="admision_cirugia">
                <div class="box-tab-header">
                  <h3 class="box-tab-title">Admisión</h3>
                </div>
                <!-----------tab-------------- -->
                <div class="table_inner">
                  <div class="col-md-12 itemcol">
                    <div class="nav-tabs-custom relative" style="margin:20px">
                      <ul class="nav nav-tabs">
                        <li class="active">
                          <a href="#Enfermeria" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-notes-medical" style='font-size:15px;color:#1563B0;'></i> Notas de enfermería
                                          </a>
                        </li>
                        <li>
                          <a href="#Signos_Vitales" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-heartbeat" style='font-size:15px;color:#1563B0;'></i> Signos Vitales
                                          </a>
                        </li>
                        <li>
                          <a href="#ListaChequeoQuirúrgico" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-file-medical" style='font-size:15px;color:#1563B0;'></i> Lista Chequeo Quirúrgico
                                          </a>
                        </li>
                        <li>
                          <a href="#HorasQuirúrgicas" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-thermometer" style='font-size:15px;color:#1563B0;'></i> Equipo quirúrgicos
                                          </a>
                        </li>
                        <li>
                          <a href="#medic_surgery_trans_2" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-clock" style='font-size:15px;color:#1563B0;'></i> Horas Quirúrgicas
                                          </a>
                        </li>
                        <li>
                          <a href="#Medicamentos" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-pills" style='font-size:15px;color:#1563B0;'></i> Medicamentos
                                          </a>
                        </li>

                      </ul>
                      <div class="tab-content pt6" style="margin:10px;">
                        <!-- --ListaChequeoQuirúrgico--------- -->
                        <div class="tab-pane tab-content-height" id="ListaChequeoQuirúrgico">
                          <div class="box-tab-header">
                            <h3 class="box-tab-title">Lista Chequeo Quirúrgicos</h3>
                            <div class="row" style="display: flex; justify-content: flex-start;">
                              <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                <b>Lista de chequeo-Al ingreso al Quirófano</b>
                              </div>
                            </div>
                            <div class="row" style="margin: 0px;padding: 0px;">
                              <form id="Form_chequeo_1" accept-charset="utf-8" method="post">
                                <input type="hidden" name="surgery_id" value="<?php echo $opdid; ?>">
                                <div class="form-group row">
                                  <label class="col-sm-6 col-md-6 col-form-label">Ha confirmado el paciente su identidad, sitio quirúrgico, el procedimiento y su consentimiento?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[1]" value="1" id="si1" <?=$check_list_one[ 'p_1']==='1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si1">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[1]" value="0" id="no1" <?=$check_list_one[ 'p_1']==='0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no1">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-6 col-md-6 col-form-label">Se ha marcado el sitio quirurgico?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[2]" value="1" id="si2" <?=$check_list_one[ 'p_2']==='1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si2">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[2]" value="0" id="no2" <?=$check_list_one[ 'p_2']==='0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no2">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Se ha completado la comprobacion de los aparatos de anestesia y la medicacion anestesica?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[3]" value="1" id="si3" <?=$check_list_one[ 'p_3']==='1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si3">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[3]" value="0" id="no3" <?=$check_list_one[ 'p_3']==='0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no3">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Se ha colocado el pulsionamiento al paciente y funciona?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[4]" value="1" id="si4" <?=$check_list_one[ 'p_4']==='1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si4">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[4]" value="0" id="no4" <?=$check_list_one[ 'p_4']==='0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no4">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Se ha completado la comprobacion de los aparatoss de anestesia y la medicacion anestesica?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[5]" value="1" id="si5" <?=$check_list_one[ 'p_5']==='1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si5">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[5]" value="0" id="no5" <?=$check_list_one[ 'p_5']==='0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no5">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Tiene el paciente, alergias conocidas?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[6]" value="1" id="si6" <?=$check_list_one[ 'p_6']==='1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si6">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[6]" value="0" id="no6" <?=$check_list_one[ 'p_6']==='0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no6">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Tiene el paciente, via arterea dificil/riesgo de aspiracion?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[7]" value="1" id="si7" <?=$check_list_one[ 'p_7']==='1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si7">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[7]" value="0" id="no7" <?=$check_list_one[ 'p_7']==='0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no7">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Tiene el paciente, riesgo de hemorragia > 500 ml (7ml/kg en niños)?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[8]" value="1" id="si8" <?=$check_list_one[ 'p_8']==='1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si8">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[8]" value="0" id="no8" <?=$check_list_one['p_8'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no8">No</label>
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Observaciones</label>
                                      <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                    </div>
                                  </div>
                                </div>
                                <button type="submit" id="Save_Chequeo1" data-loading-text="Procesando..." class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> Guardar</button>
                              </form>
                            </div>
                            <hr class="my-4" style="border-width: 2px; border-color: #ccc;">
                            <div class="row" style="display: flex; justify-content: flex-start;">
                              <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                <b>Lista de chequeo-Antes de realizar insición quirúrgica</b>
                              </div>
                            </div>
                            <div class="row" style="margin: 0px;padding: 0px;">
                              <form id="Form_chequeo_2" accept-charset="utf-8" method="post">
                                <input type="hidden" name="surgery_id" value="<?php echo $opdid; ?>">
                                <label style="font-size: 15px; color: black;">Cirujano:</label>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Se confirma que todos los miembros del eqiopo se hayan presentado con su nombre completo y cargo?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[9]" value="1" id="si9" <?=$check_list_one['p_9'] === '1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si9">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[9]" value="0" id="no9" <?=$check_list_one['p_9'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no9">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Se confirma la identidad del paciente, sitio quirúrgico y procedimiento?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[10]" value="1" id="si10" <?=$check_list_one['p_10'] === '1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si10">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[10]" value="0" id="no10" <?=$check_list_one['p_10'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no10">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Se ha administrado profilaxis antibiotica en los ultimos 60 minutos?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[11]" value="1" id="si11" <?=$check_list_one['p_11'] === '1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si11">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[11]" value="0" id="no11" <?=$check_list_one['p_11'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no11">No</label>
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <label style="font-size: 15px; color: black;">Provisión de eventos críticos:</label>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Se analiza cuales pueden ser los pasos críticos o no sistematizados?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[12]" value="1" id="si12" <?=$check_list_one['p_12'] === '1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si12">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[12]" value="0" id="no12" <?=$check_list_one['p_12'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no12">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Se estima cuánto durará la operación?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[13]" value="1" id="si1" <?=$check_list_one['p_13'] === '1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si13">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[13]" value="0" id="no1" <?=$check_list_one['p_13'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no13">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Se menciona la pérdida de sangre prevista?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[14]" value="1" id="si14" <?=$check_list_one['p_14'] === '1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si14">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[14]" value="0" id="no14" <?=$check_list_one['p_14'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no14">No</label>
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <label style="font-size: 15px; color: black;">Anestesista:</label>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Tiene el paciente, alergias conocidas?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[15]" value="1" id="si15" <?=$check_list_one['p_15'] === '1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si15">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[15]" value="0" id="no15" <?=$check_list_one['p_15'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no15">No</label>
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <label style="font-size: 15px; color: black;">Equipo de enfermería:</label>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Se ha confirmado la esterilidad de los paquetes(con los resultados de los indicadores)?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[16]" value="1" id="si16" <?=$check_list_one['p_16'] === '1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si16">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[16]" value="0" id="no16" <?=$check_list_one['p_16'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no16">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Hay dudas o problemas relacionados con el instrumental o los equipos?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[17]" value="1" id="si17" <?=$check_list_one['p_17'] === '1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si17">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[17]" value="0" id="no17" <?=$check_list_one['p_17'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no17">No</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-12 col-md-6 col-form-label">Pueden visualizarse las imagenes diagnósticas esenciales?</label>
                                  <div class="col-sm-1 col-md-1 d-flex">
                                    <div class="form-check">
                                      <input type="radio" class="form-check-input" name="respuesta[18]" value="1" id="si18" <?=$check_list_one['p_18'] === '1' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="si18">Sí</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 5px;">
                                      <input type="radio" class="form-check-input" name="respuesta[18]" value="0" id="no18" <?=$check_list_one['p_18'] === '0' ? 'checked' : ''?>>
                                      <label class="form-check-label" for="no18">No</label>
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Observaciones</label>
                                      <textarea name="remarks2" id="remarks2" class="form-control"></textarea>
                                    </div>
                                  </div>
                                </div>
                                <button type="submit" id="Save_Chequeo2" data-loading-text="Procesando..." class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> Guardar</button>
                              </form>
                            </div>
                          </div>

                        </div>
                        <!--END--ListaChequeoQuirúrgico-->
                        <!-- --HorasQuirúrgicas--------- -->
                        <div class="tab-pane tab-content-height" id="HorasQuirúrgicas">
                          <div class="col-12 m-4" style="padding:10px;">
                            Horas Quirúrgicas
                          </div>
                        </div>
                        <!--END--HorasQuirúrgicas-->
                        <!-- --medic_surgery_trans--------- -->
                        <div class="tab-pane tab-content-height" id="medic_surgery_trans_2">
                          Transoperatorio
                        </div>
                        <!--END--medic_surgery_trans-->
                        <!-- --Signos_Vitales--------- -->
                        <div class="tab-pane tab-content-height" id="Signos_Vitales">
                          <div class="row" style="margin: 0px;padding: 0px;">
                            <form id="signos_form" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                              <input type="hidden" name="surgery_id" value="<?php echo $opdid; ?>">
                              <div class="col-md-12" style="margin: 0px;padding: 0px;">
                                <div class="row" style="display: flex;justify-content: center;">
                                  <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                    <b>Signos Vitales</b>
                                  </div>
                                </div>

                                <div class="col-sm-2 col-md-2">
                                  <div class="form-group">
                                    <label>Fecha<small class="req"> *</small>
                                                                  </label>
                                    <input type="text" name="date" value="" class="form-control datetime">
                                  </div>
                                </div>

                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label for="pwd">Hora</label>
                                    <div class="bootstrap-timepicker">
                                      <div class="bootstrap-timepicker-widget dropdown-menu">
                                        <table>
                                          <tbody>
                                            <tr>
                                              <td><a href="#" data-action="incrementHour"><i class="glyphicon glyphicon-chevron-up"></i></a></td>
                                              <td class="separator">&nbsp;</td>
                                              <td><a href="#" data-action="incrementMinute"><i class="glyphicon glyphicon-chevron-up"></i></a></td>
                                              <td class="separator">&nbsp;</td>
                                              <td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-up"></i></a></td>
                                            </tr>
                                            <tr>
                                              <td><input type="text" name="hour" class="bootstrap-timepicker-hour form-control" maxlength="2"></td>
                                              <td class="separator">:</td>
                                              <td><input type="text" name="minute" class="bootstrap-timepicker-minute form-control" maxlength="2"></td>
                                              <td class="separator">&nbsp;</td>
                                              <td><input type="text" name="meridian" class="bootstrap-timepicker-meridian form-control" maxlength="2"></td>
                                            </tr>
                                            <tr>
                                              <td><a href="#" data-action="decrementHour"><i class="glyphicon glyphicon-chevron-down"></i></a></td>
                                              <td class="separator"></td>
                                              <td><a href="#" data-action="decrementMinute"><i class="glyphicon glyphicon-chevron-down"></i></a></td>
                                              <td class="separator">&nbsp;</td>
                                              <td><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-down"></i></a></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input type="text" name="time" class="form-control timepicker" id="add_dose_time" value="" autocomplete="off">
                                          <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <span class="text-danger"></span>
                                  </div>
                                </div>

                                <div class="col-md-2">
                                  <div style="margin: 0px 0px 0px 0px;font_size:15px;" class="col-12">
                                    <div class="col-2">
                                      <label for="" class="control-label">
                                                                          <b>Talla</b>
                                                                          <small class="req"> *</small>
                                                                      </label>
                                    </div>
                                    <div class="row" style="display: flex;padding:0px 29px 15px 8px;align-items: baseline;">
                                      <div class="col-6" style="width: -webkit-fill-available;">
                                        <div class="input-group">
                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                                                  <i class="fa fa-tags" style="color:#337ab7;"></i>
                                                                              </span>
                                          <div class="col-6" style="width: -webkit-fill-available;">
                                            <input type="number" style="border-radius: 0px 10px 10px 0px !important;" onchange="" id="talla" name="talla" class="form-control" value="" placeholder="">
                                          </div>
                                        </div>
                                      </div>
                                      &nbsp;
                                      <div class="col-2" style="margin-bottom:4px;">
                                        <b><span>Cm</span></b>
                                      </div><span class="text-danger"></span>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-2">
                                  <div style="margin: 0px 5px 0px 0px;font_size:15px;" class="col-12">
                                    <div class="col-2">
                                      <label for="" class="control-label">
                                                                          <b>Peso</b>
                                                                          <small class="req"> *</small>
                                                                      </label>
                                    </div>
                                    <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                      <div class="col-6" style="width: -webkit-fill-available;">
                                        <div class="input-group">
                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                                                  <i class="fas fa-download" style="color:#337ab7;"></i>
                                                                              </span><input type="number" onchange="" style="border-radius: 0px 10px 10px 0px !important;" id="peso_custom" name="peso" class="form-control"
                                            value="" placeholder="">
                                        </div>
                                      </div>
                                      &nbsp;
                                      <div class="col-2" style="margin-bottom:4px;">
                                        <b><span> Kg </span></b>
                                      </div><span class="text-danger"></span>
                                    </div>
                                  </div>

                                </div>

                                <div class="col-md-2">
                                  <div style="margin: 0px 5px 0px 0px;font_size:15px;" class="col-12">
                                    <div class="col-2">
                                      <label for="" class="control-label">
                                                                          <b>Frecuencia Cardíaca</b>
                                                                          <small class="req"> *</small>
                                                                      </label>
                                    </div>
                                    <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                      <div class="col-6" style="width: -webkit-fill-available;">
                                        <div class="input-group">
                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                                                  <i class="fas fa-heart" style="color:#337ab7;"></i>
                                                                              </span>
                                          <div class="col-4" style="width: -webkit-fill-available;">
                                            <input type="number" id="" style="border-radius: 0px 10px 10px 0px !important;" name="frec_card" class="form-control" value="" placeholder="">
                                          </div>
                                        </div>
                                      </div>
                                      &nbsp;
                                      <div class="col-2" style="margin-bottom:4px;">
                                        <b><span>LPM</span></b>
                                      </div><span class="text-danger"></span>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-2">
                                  <div style="margin: 0px 0px 0px 0px;font_size:15px;" class="col-12">
                                    <div class="col-2">
                                      <label for="" class="control-label">
                                                                          <b>Frecuencia Respiratoria</b>
                                                                          <small class="req"> *</small>
                                                                      </label>
                                    </div>
                                    <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                      <div class="col-6" style="width: -webkit-fill-available;">
                                        <div class="input-group">
                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                                                  <i class="fas fa-prescription-bottle" style="color:#337ab7;"></i>
                                                                              </span>
                                          <div class="col-4" style="width: -webkit-fill-available;">
                                            <input type="number" id="" name="frec_res" style="border-radius: 0px 10px 10px 0px !important;" class="form-control" value="" placeholder="">
                                          </div>
                                        </div>
                                      </div>
                                      &nbsp;
                                      <div class="col-2" style="margin-bottom:4px;">
                                        <b><span>SRPM</span></b>
                                      </div><span class="text-danger"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row" style="margin: 0px;padding: 0px;">

                                <div class="row" style="display: flex;justify-content: center;align-items: end;">
                                  <div class="col-md-2">
                                    <div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                                      <div class="col-2">
                                        <label for="" class="control-label">
                                                                              <b>Temperatura</b>
                                                                              <small class="req"> *</small>
                                                                          </label>
                                      </div>
                                      <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                        <div class="col-6" style="width: -webkit-fill-available;">
                                          <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                                                      <i class="fas fa-thermometer" style="color:#337ab7;"></i>
                                                                                  </span>
                                            <div class="col-4" style="width: -webkit-fill-available;">
                                              <input type="number" id="" style="border-radius: 0px 10px 10px 0px !important;" name="temperatura" class="form-control" value="" placeholder="">
                                            </div>
                                          </div>
                                        </div>
                                        &nbsp;
                                        <div class="col-2" style="margin-bottom:4px;">
                                          <b><span>°C</span></b>
                                        </div><span class="text-danger"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                                      <div class="col-2">
                                        <label for="" class="control-label">
                                                                              <b>Saturación de 02 sin Oxígeno</b>
                                                                          </label>
                                      </div>
                                      <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                        <div class="col-6" style="width: -webkit-fill-available;">
                                          <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                                                      <i class="fas fa-thermometer" style="color:#337ab7;"></i>
                                                                                  </span>
                                            <div class="col-4" style="width: -webkit-fill-available;">
                                              <input type="text" id="" style="border-radius: 0px 10px 10px 0px !important;" name="sat_oxi_sin" class="form-control" value="" placeholder="">
                                            </div>
                                          </div>
                                        </div>
                                        &nbsp;
                                        <div class="col-2" style="margin-bottom:4px;">
                                          <b><span>%</span></b>
                                        </div><span class="text-danger"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                                      <div class="col-2">
                                        <label for="" class="control-label">
                                                                              <b>Saturación de O2 con Oxígeno</b>
                                                                          </label>
                                      </div>
                                      <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                        <div class="col-6" style="width: -webkit-fill-available;">
                                          <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                                                      <i class="fas fa-thermometer" style="color:#337ab7;"></i>
                                                                                  </span>
                                            <div class="col-4" style="width: -webkit-fill-available;">
                                              <input type="text" id="" style="border-radius: 0px 10px 10px 0px !important;" name="sat_oxi_con" class="form-control" value="" placeholder="">
                                            </div>
                                          </div>
                                        </div>
                                        &nbsp;
                                        <div class="col-2" style="margin-bottom:4px;">
                                          <b><span>%</span></b>
                                        </div><span class="text-danger"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                                      <div class="col-2">
                                        <label for="" class="control-label">
                                                                              <b>Presión Arterial Sistólica </b>
                                                                              <small class="req"> *</small>
                                                                          </label>
                                      </div>
                                      <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                        <div class="col-6" style="width: -webkit-fill-available;">
                                          <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                                                      <i class="fa fa-heart" style="color:#337ab7;"></i>
                                                                                  </span>
                                            <input type="number" style="border-radius: 0px 10px 10px 0px !important;" id="" name="presi_sis" class="form-control" value="" placeholder="">
                                          </div>
                                        </div>&nbsp;
                                        <div class="col-2" style="margin-bottom:4px;">
                                          <b><span> mmHg </span></b>
                                        </div><span class="text-danger"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                                      <div class="col-2">
                                        <label for="" class="control-label">
                                                                              <b>Presión Arterial Diastólica </b>
                                                                              <small class="req"> *</small>
                                                                          </label>
                                      </div>
                                      <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                        <div class="col-6" style="width: -webkit-fill-available;">
                                          <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                                                      <i class="fa fa-heart" style="color:#337ab7;"></i>
                                                                                  </span><input type="number" style="border-radius: 0px 10px 10px 0px !important;" id="" name="presi_dia" class="form-control "
                                              value="" placeholder="">
                                          </div>
                                        </div>&nbsp;
                                        <div class="col-2" style="margin-bottom:4px;">
                                          <b><span> mmHg </span></b>
                                        </div><span class="text-danger"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group" style="margin: 18px 0px 21px 0px;font_size:15px;">
                                      <label for="" class="control-label">Posición Presión Arterial</label><small class="req"> *</small>
                                      <div class="col-6" style="width: -webkit-fill-available;">
                                        <div class="input-group">
                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                          <i class="fa fa-tint" style="color:#337ab7;font-size: 15px"> </i>
                                          </span>
                                          <select id="" style="border-radius: 0px 10px 10px 0px !important;" name="posi_pres" class="form-control">
                                              <option value="">Selecione</option>
                                              <option id="causaExterna2" value="Sentado">Sentado</option>
                                              <option id="causaExterna2" value=" Acostado boca arriba"> Acostado boca arriba</option>
                                          </select>
                                          <span class="text-danger"></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row" style="margin: 0px;padding: 0px;">
                                <div class="row" style="display: flex;justify-content: center;align-items: end;">
                                  <div class="col-md-3">
                                    <div class="form-group" style="margin: 18px 0px 21px 0px;font_size:15px;">
                                      <label for="" class="control-label">Lugar Presión Arterial</label><small class="req"> *</small>
                                      <div class="col-6" style="width: -webkit-fill-available;">
                                        <div class="input-group">
                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                              <i class="fa fa-tint" style="color:#337ab7;font-size: 15px"> </i>
                                          </span>
                                          <select id="" style="border-radius: 0px 10px 10px 0px !important;" name="lugar_pres" class="form-control">
                                              <option value="">Selecione</option>
                                              <option  value="Brazo derecho">Brazo derecho</option>
                                              <option  value=" Brazo izquierdo"> Brazo izquierdo</option>
                                          </select>
                                          <span class="text-danger"></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                                      <label for="" class="control-label">Resultado glucometría</label><small class="req"> *</small>
                                      <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                        <div class="col-6" style="width: -webkit-fill-available;">
                                          <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                <i class="fas fa-heart" style="color:#337ab7;"></i>
                                            </span>
                                            <div class="col-4" style="width: -webkit-fill-available;">
                                              <input type="number" id="" style="border-radius: 0px 10px 10px 0px !important;" name="glucometria" class="form-control" value="" placeholder="">
                                            </div>
                                          </div>
                                        </div>
                                        &nbsp;
                                        <div class="col-2" style="margin-bottom:4px;">
                                          <b><span>Mg/dl</span></b>
                                        </div><span class="text-danger"></span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Observaciones</label>
                                    <textarea name="remark" id="remark" class="form-control"></textarea>

                                  </div>
                                </div>
                              </div>
                              <button type="submit" id="signos_addbtn" data-loading-text="Procesando..." class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> Guardar</button>
                            </form>
                          </div>
                          <div class="content">
                            <table class="table table-bordered table-striped mt-5 mb-5" id="signos_vitales">
                              <thead>
                                <tr>
                                  <th>Fecha</th>
                                  <th>Tiempo</th>
                                  <th>Peso</th>
                                  <th>Talla</th>
                                  <th>Temperatura</th>
                                  <th>Presión <br>Diastólica</th>
                                  <th>Presión <br>Sistólica</th>
                                  <th>Frecuencia <br>Cardíaca</th>
                                  <th>Frecuencia <br>Respiratoria</th>
                                  <th>Glucometría</th>
                                  <th>Comentario</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($signos_vitales as $key =>$s): ?>
                                <tr>
                                  <td>
                                    <?php echo $s->date; ?>
                                  </td>
                                  <td>
                                    <?php echo $s->time; ?>
                                  </td>
                                  <td>
                                    <?php echo $s->peso; ?>
                                  </td>
                                  <td>
                                    <?php echo $s->talla; ?>
                                  </td>
                                  <td>
                                    <?php echo $s->temperatura; ?>
                                  </td>
                                  <td>
                                    <?php echo ($s->presion_dia); ?>
                                  </td>
                                  <td>
                                    <?php echo ($s->presion_sis); ?>
                                  </td>
                                  <td>
                                    <?php echo $s->frec_card; ?>
                                  </td>
                                  <td>
                                    <?php echo $s->frec_resp; ?>
                                  </td>
                                  <td>
                                    <?php echo ($s->glucometria); ?>
                                  </td>
                                  <td>
                                    <?php echo ($s->remark); ?>
                                  </td>
                                </tr>
                                <?php endforeach ?>

                              </tbody>


                            </table>
                          </div>
                        </div>
                        <!--END--Signos_Vitales-->
                        <!--------Medicamentos------ -->
                        <div class="tab-pane tab-content-height" id="Medicamentos">

                          <div class="tab-pane" id="medication">
                            <div class="box-tab-header">
                              <h3 class="box-tab-title">
                                <?php echo $this->lang->line("medication"); ?>
                              </h3>
                              <div class="box-tab-tools">
                                <?php if ($this->rbac->hasPrivilege('opd_medication', 'can_add')) {   if($is_discharge){ ?>
                                <a href="#" class="btn btn-sm btn-primary dropdown-toggle addmedication" onclick="addmedicationModal()" data-toggle='modal'><i class="fa fa-plus"></i> <?php echo $this->lang->line("add_medication_dose"); ?></a>
                                <?php }} ?>
                              </div>
                            </div>
                            <!--./box-tab-header-->

                            <div class="download_label">
                              <?php echo composePatientName($result['patient_name'],$result['patient_id']) . " " . $this->lang->line('opd_details'); ?>
                            </div>
                            <div class="table_inner">
                              <table class="table table-striped table-bordered table-hover ajaxlist_med" cellspacing="0" width="">
                                <?php 
                                                                              if(!empty($medication)){ ?>
                                <thead>
                                  <th class="hard_left">
                                    <?php echo $this->lang->line("date"); ?> </th>
                                  <th class="next_left">
                                    <?php echo $this->lang->line("medicine_name"); ?>
                                  </th>
                                  <?php 
                                                                                  if (!empty($max_dose)) {
                                                                                      $dosage_count = $max_dose;
                                                                                  } else{
                                                                                      $dosage_count = 0;
                                                                                  }

                                                                                  for ($x = 1; $x <= $dosage_count; $x++) { ?>

                                  <th class="sticky-col" width="150">
                                    <?php echo $this->lang->line("dose").''.$x  ;?>
                                  </th>
                                  <?php }
                                                                                  ?>
                                </thead>
                                <tbody>
                                  <?php 
                                                                              $count = 1;
                                                                          foreach ($medication as $medication_key => $medication_value){

                                                                          $pharmacy_id = $medication_value['pharmacy_id'];
                                                                          $medicine_category_id = $medication_value['medicine_category_id'];
                                                                          $date = $medication_value['date']; ?>
                                  <tr>
                                    <?php $subcount = 1; foreach ($medication_value['dosage'][$date] as $mkey => $mvalue) { 
                                                                              $date = $this->customlib->YYYYMMDDTodateFormat($medication_value['date']);
                                                                                  ?>
                                    <td class="hard_left">
                                      <?php if($subcount==1){ echo $date."<br>(".date('l', strtotime($medication_value['date'])).")"; }else{
                                                                                      echo "<span class='fa-level-span'><i class='fa fa-level-up fa-level-roated' aria-hidden='true'></i></span>";
                                                                                  } ?></td>
                                    <td class="next_left">
                                      <?php echo $mvalue['name'] ?>
                                    </td>
                                    <?php 
                                                                              for ($x = 0; $x <= $dosage_count; $x++){
                                                                                  if (array_key_exists($x,$mvalue['dose_list']))
                                                                                      {
                                                                                          $medicine_id = $mvalue['dose_list'][$x]['pharmacy_id'];
                                                                                          $medicine_category_id = $mvalue['dose_list'][$x]['medicine_category_id'];
                                                                                          $add_index= $x;
                                                                                          if ($this->rbac->hasPrivilege('opd_medication', 'can_edit')) { 
                                                                                              $medication_edit = "<a href='#' class='btn btn-default btn-xs' data-toggle='tooltip' data-original-title='".$this->lang->line('edit')."' onclick='medicationDoseModal(" .$mvalue['dose_list'][$x]['id'].")'><i class='fa fa-pencil'></i></a>"; 
                                                                                          }else{
                                                                                              $medication_edit = "";
                                                                                          }

                                                                                          if ($this->rbac->hasPrivilege('opd_medication', 'can_delete')) { 
                                                                                              $medication_delete = "<a  class='btn btn-default btn-xs delete_record_dosage' data-toggle='tooltip' data-original-title='".$this->lang->line('delete')."' data-record-id='".$mvalue['dose_list'][$x]['id']."'><i class='fa fa-trash'></i></a>"; 
                                                                                          }else{
                                                                                              $medication_delete = "";
                                                                                          }                                  

                                                                                      ?>
                                    <td class="dosehover">
                                      <?php echo $this->lang->line('time').": ".date('h:i A',strtotime($mvalue['dose_list'][$x]['time']))."</a><span>".$medication_edit."</span><span>".$medication_delete."</span></br>". $mvalue['dose_list'][$x]['medicine_dosage']." ".$mvalue['dose_list'][$x]['unit']; if($mvalue['dose_list'][$x]['remark']!=''){ echo " <br>".$this->lang->line('remark').": ".$mvalue['dose_list'][$x]['remark'] ;}?></td>
                                    <?php
                                                                                      }
                                                                                      else
                                                                                      {
                                                                                      ?>
                                      <td class="dosehover">
                                        <?php 
                                                                                      if($add_index+1== $x){
                                                                                          ?>
                                        <?php if ($this->rbac->hasPrivilege('opd_medication', 'can_add')) {
                                                                                          if($is_discharge){
                                                                                      ?>
                                        <a href="#" class="btn btn-sm btn-primary dropdown-toggle addmedication" onclick="medicationModal('<?php echo $medicine_category_id;?>','<?php echo $medicine_id ;?>','<?php echo $date;?>')" data-toggle='modal'><i class="fa fa-plus"></i>

                                                                                          </a>
                                        <?php }} ?>
                                        <?php
                                                                                      } 
                                                                                      ?>
                                      </td>
                                      <?php
                                                                                      }
                                                                                  ?>



                                        <?php }   ?>


                                  </tr>
                                  <?php $subcount++; }
                                                                              }  ?>

                                </tbody>
                                <?php }else{ ?>

                                <tr>
                                  <td>
                                    <div class="alert alert-danger">
                                      <?php echo $this->lang->line('no_record_found'); ?>
                                    </div>
                                  </td>
                                </tr>

                                <?php   } ?>
                              </table>

                            </div>
                          </div>

                        </div>
                        <!--END--Medicamentos-->
                        <!--------Enfermeria------ -->
                        <div class="tab-pane tab-content-height active" id="Enfermeria">
                          <div class="table_inner">Notas de enfermería
                            <div class="box-tab-header">
                              <h3 class="box-tab-title">Notas de</h3>
                              <div class="box-tab-tools">
                                <a href="#" class="btn btn-sm btn-primary dropdown-toggle addnursenote" onclick="holdModal('add_nurse_note')" data-toggle="modal"><i class="fas fa-plus"></i> Agregar nota de enfermera</a>
                              </div>
                              <hr class="hr-panel-heading hr-10">
                              <p>
                                <strong><i class="fas fa-briefcase-medical"></i> Notas de enfermería</strong>
                              </p>
                              <hr class="hr-panel-heading hr-10">
                              <div class="timeline-header no-border pb1">
                                <div id="timeline_list">
                                  <?php if (empty($nurse_note)) { ?>
                                  <?php } else { ?>
                                  <ul class="timeline timeline-inverse">
                                    <?php
                                                                  for ($i=0; $i <$recent_record_count; $i++) { 
                                                                      if (!empty($nurse_note[$i])) { 
                                                                      $id = $nurse_note[$i]['id'];
                                                                  ?>
                                      <li class="time-label">
                                        <span class="bg-blue">   
                                                                      <?php echo $this->customlib->YYYYMMDDHisTodateFormat($nurse_note[$i]['date']); ?></span>
                                      </li>
                                      <li>
                                        <i class="fa fa-list-alt bg-blue"></i>
                                        <div class="timeline-item">
                                          <h3 class="timeline-header text-aqua">
                                            <?php echo $nurse_note[$i]['name'].' '.$nurse_note[$i]['surname']." ( ".$nurse_note[$i]['employee_id']." )" ; ?> </h3>

                                          <div class="timeline-body">
                                            <?php echo $this->lang->line('note') ."</br>". nl2br($nurse_note[$i]['note']); ?>
                                          </div>

                                          <div class="timeline-body">
                                            <?php echo $this->lang->line('comment') ."</br> ". nl2br($nurse_note[$i]['comment']); ?>
                                          </div>

                                          <?php foreach ($nursenote[$id] as $ckey => $cvalue) { 
                                                                                      if (!empty($cvalue['staffname'])) {
                                                                                      $comment_by =  " (". $cvalue['staffname']." ".$cvalue['staffsurname'].": " .$cvalue['employee_id'].")";
                                                                                      $comment_date = $this->customlib->YYYYMMDDHisTodateFormat($cvalue['created_at'], $this->customlib->getHospitalTimeFormat());
                                                                                      }

                                                                                      ?>
                                          <div class="timeline-body">
                                            <?php echo nl2br($cvalue['comment_staff']);  
                                                                                          if($is_discharge) { if ($this->rbac->hasPrivilege('nurse_note', 'can_delete')) { ?>

                                            <?php }}?>
                                            <div class="text-right mb0 ptt10">
                                              <?php echo $comment_date." ". $comment_by ?>
                                            </div>
                                          </div>
                                          <?php  } ?>

                                        </div>
                                      </li>
                                      <?php }} ?>
                                      <li><i class="fa fa-clock-o bg-gray"></i></li>
                                      <?php } ?>
                                  </ul>
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

              <div class="tab-pane tab-content-height" id="transoperatorio_cirugia">
                <div class="box-tab-header">
                  <h3 class="box-tab-title">Trans Operatorio</h3>
                  <div class="box-tab-tools">
                    <a href="#" class="btn btn-sm btn-primary dropdown-toggle addprescription" data-toggle="modal"><i class="fas fa-plus"></i> Agregar receta</a>
                  </div>
                </div>
                <!--./box-tab-header-->
                <div class="table_inner">
                  <!-----------tab------->
                  <div class="col-md-12 itemcol">
                    <div class="nav-tabs-custom relative" style="margin:10px">
                      <ul class="nav nav-tabs">
                        <li class="active">
                          <a href="#notes_enfer_transoper" data-toggle="tab" aria-expanded="true">
                                    <i class="fas fa-notes-medical" style='font-size:15px;color:#1563B0;'></i> Notas de enfermería
                                    </a>
                        </li>
                        <li>
                          <a href="#listq_transoper" data-toggle="tab" aria-expanded="true">
                                    <i class="fas fa-file-medical" style='font-size:15px;color:#1563B0;'></i> Lista Chequeo Quirúrgico
                                    </a>
                        </li>
                        <li>
                          <a href="#Equipo_Qui_transoper" data-toggle="tab" aria-expanded="true">
                                    <i class="fas fa-thermometer" style='font-size:15px;color:#1563B0;'></i> Equipo quirúrgicos
                                    </a>
                        </li>
                        <li>
                          <a href="#horasq_transoper" data-toggle="tab" aria-expanded="true">
                                    <i class="fas fa-clock" style='font-size:15px;color:#1563B0;'></i> Horas Quirúrgicas
                                    </a>
                        </li>
                        <li>
                          <a href="#Signos_Vitales_transoper" data-toggle="tab" aria-expanded="true">
                                    <i class="fas fa-heartbeat" style='font-size:15px;color:#1563B0;'></i> Signos Vitales
                                    </a>
                        </li>
                        <li>
                          <a href="#Medicamentos_transoper" data-toggle="tab" aria-expanded="true">
                                    <i class="fas fa-pills" style='font-size:15px;color:#1563B0;'></i> Medicamentos
                                    </a>
                        </li>
                      </ul>
                      <div class="tab-content pt6" style="margin:10px;">
                        <!-- --ListaChequeoQuirúrgico--------- -->
                        <div class="tab-pane tab-content-height active" id="Listrgico">
                          <div class="box-tab-header">
                            <h3 class="box-tab-title">Lista Chequeo Quirúrgico</h3>
                          </div>
                        </div>
                        <!--END--ListaChequeoQuirúrgico-->
                        <!-- --HorasQuirúrgicas--------- -->
                        <div class="tab-pane tab-content-height" id="Horasrúrgicas">
                          <div class="col-12 m-4" style="padding:10px;">
                            Horas Quirúrgicas
                          </div>
                        </div>
                        <!--END--HorasQuirúrgicas-->
                        <!-- --medic_surgery_trans--------- -->
                        <div class="tab-pane tab-content-height" id="Equipo_Qui_transoper">
                          <p>
                            Prueba
                          </p>
                        </div>
                        <!--END--medic_surgery_trans-->
                        <!-- --Signos_Vitales--------- -->
                        <div class="tab-pane tab-content-height" id="Si_Vitales">
                          Signos Vitales
                        </div>
                        <!--END--Signos_Vitales-->
                        <!--------Medicamentos------ -->
                        <div class="tab-pane tab-content-height" id="Meamentos">
                          Medicamentos
                        </div>
                        <!--END--Medicamentos-->
                        <!--------Enfermeria------ -->
                        <div class="tab-pane tab-content-height" id="Enmeria">
                          Notas de enfermería
                        </div>
                        <!--END--Enfermeria-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane tab-content-height" id="postsoperatorio_cirugia">
                <div class="box-tab-header">
                  <h3 class="box-tab-title">Post Operatorio</h3>
                  <div class="box-tab-tools">
                    <a href="#" class="btn btn-sm btn-primary dropdown-toggle addconsultant" onclick="holdModal('add_instruction')" data-toggle="modal"><i class="fas fa-plus"></i> Registro de consultores</a>
                  </div>
                </div>
                <div class="table_inner">
                  <div class="col-md-12 itemcol">
                    <div class="nav-tabs-custom relative" style="margin:20px">
                      <ul class="nav nav-tabs">
                        <li class="active">
                          <a href="#ListaChequeoQuirúrgico" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-file-medical" style='font-size:15px;color:#1563B0;'></i> Signos Vitales
                                          </a>
                        </li>
                        <li>
                          <a href="#HorasQuirúrgicas" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-thermometer" style='font-size:15px;color:#1563B0;'></i> Administración de medicamentos
                                          </a>
                        </li>
                        <li>
                          <a href="#medic_surgery_trans" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-clock" style='font-size:15px;color:#1563B0;'></i> Escala Aldrete
                                          </a>
                        </li>
                        <li>
                          <a href="#Signos_Vitales" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-heartbeat" style='font-size:15px;color:#1563B0;'></i> Escala del Dolor
                                          </a>
                        </li>
                        <li>
                          <a href="#Medicamentos" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-pills" style='font-size:15px;color:#1563B0;'></i> Notas de Enfermería
                                          </a>
                        </li>
                        <li>
                          <a href="#Enfermeria" data-toggle="tab" aria-expanded="true">
                                              <i class="fas fa-notes-medical" style='font-size:15px;color:#1563B0;'></i> Recomendaciones o 
                                          </a>
                        </li>
                      </ul>
                      <div class="tab-content pt6" style="margin:10px;">
                        <!-- --ListaChequeoQuirúrgico--------- -->
                        <div class="tab-pane tab-content-height active" id="ListaChequeoQuirúrgico">
                          <div class="box-tab-header">
                            <h3 class="box-tab-title">Lista Chequeo Quirúrgico</h3>
                          </div>
                        </div>
                        <!--END--ListaChequeoQuirúrgico-->
                        <!-- --HorasQuirúrgicas--------- -->
                        <div class="tab-pane tab-content-height" id="HorasQuirúrgicas">
                          <div class="col-12 m-4" style="padding:10px;">
                            Horas Quirúrgicas
                          </div>
                        </div>
                        <!--END--HorasQuirúrgicas-->
                        <!-- --medic_surgery_trans--------- -->
                        <div class="tab-pane tab-content-height" id="medic_surgery_trans">

                          <div clas="col-md-6">
                            <label>Actividad motora:</label>
                            <select id="" name="" class="form-control" multiple="">
                                              <option value="">Seleccione</option>
                                              <option value="2">2 puntos: Mueve extremidades voluntariamente o sobre solicitud.</option>
                                              <option value="1">1 punto: Mueve extremidades solo en respuesta a estímulos táctiles.</option>
                                              <option value="0">0 puntos: No hay movimiento.</option>
                                          </select>
                            <br>
                            <label>Respiración:</label>
                            <select id="" name="" class="form-control" multiple="">
                                              <option value="">Seleccione</option>
                                              <option value="2">2 puntos: Espontánea, profunda y regular.</option>
                                              <option value="1">1 punto: Espontánea, pero irregular.</option>
                                              <option value="0">0 puntos: Ausente o requiere asistencia.</option>
                                          </select>
                            <br>
                            <label> Circulación:</label>
                            <select id="" name="" class="form-control" multiple="">
                                              <option value="">Seleccione</option>
                                              <option value="2">2 puntos: Presión arterial dentro del 20% de los valores preanestésicos o de referencia.</option>
                                              <option value="1">1 punto: Presión arterial fuera del 20% pero dentro del 49% de los valores preanestésicos o de referencia.</option>
                                              <option value="0">0 puntos: Presión arterial fuera del 50% de los valores preanestésicos o de referencia.</option>
                                          </select>
                            <br>
                            <label> Conciencia:</label>
                            <select id="" name="" class="form-control" multiple="">
                                              <option value="">Seleccione</option>
                                              <option value="2">2 puntos: Totalmente despierto.</option>
                                              <option value="1">1 punto: Somnoliento pero responde a la estimulación verbal.</option>
                                              <option value="0">0 puntos: No despierto o responde solo a estímulos dolorosos.</option>
                                          </select>
                            <br>
                            <label> Saturación de oxígeno:</label>
                            <select id="" name="" class="form-control" multiple="">
                                              <option value="">Seleccione</option>
                                              <option value="2">2 puntos: Saturación de oxígeno mayor al 92% en aire ambiente.</option>
                                              <option value="1">1 punto: Saturación de oxígeno menor al 92% en aire ambiente, pero mejora con oxígeno suplementario.</option>
                                              <option value="0">0 puntos: Saturación de oxígeno menor al 92% en aire ambiente y no mejora con oxígeno suplementario.</option>
                                          </select>


                          </div>
                          <div class="col-md-6">

                          </div>

                        </div>
                        <!--END--medic_surgery_trans-->
                        <!-- --Signos_Vitales--------- -->
                        <div class="tab-pane tab-content-height" id="Signos_Vitales">
                          Signos Vitales
                        </div>
                        <!--END--Signos_Vitales-->
                        <!--------Medicamentos------ -->
                        <div class="tab-pane tab-content-height" id="Medicamentos">
                          Medicamentos
                        </div>
                        <!--END--Medicamentos-->
                        <!--------Enfermeria------ -->
                        <div class="tab-pane tab-content-height" id="Enfermeria">
                          Notas de enfermería
                        </div>
                        <!--END--Enfermeria-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>


    </section>
    </div>


    <div class="modal fade" id="myMedicationModal" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
          <div class="modal-header modal-media-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <?php if ($this->rbac->hasPrivilege('ipd_medication', 'can_add')) { ?>
            <h4 class="modal-title">
              <?php echo $this->lang->line("add_medication_dose"); ?>
            </h4>
            <?php } ?>
          </div>
          <form id="add_medicationdose" accept-charset="utf-8" method="post" class="ptt10">
            <div class="scroll-area">
              <div class="modal-body pt0 pb0">
                <div class="row">
                  <input type="hidden" name="opdid" id="mipdid" value="<?php echo $opdid ?>">
                  <input type="hidden" name="medicine_name_id" id="mpharmacy_id" value="">
                  <input type="hidden" name="date" id="mdate" value="">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                      <input type="text" name="date" id="add_dose_date" class="form-control date">
                      <span class="text-danger"><?php echo form_error('date'); ?></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="pwd"><?php echo $this->lang->line("time"); ?></label>
                      <div class="bootstrap-timepicker">
                        <div class="form-group">
                          <div class="input-group">
                            <input type="text" name="time" class="form-control timepicker" id="add_dose_time" value="<?php echo set_value('time'); ?>">
                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <span class="text-danger"><?php echo form_error('time'); ?></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line("medicine_category"); ?></label> <small class="req"> *</small>
                      <select class="form-control medicine_category_medication select2" style="width:100%" id="add_dose_medicine_category" name='medicine_category_id'>
                                        <option value="<?php echo set_value('medicine_category_id'); ?>"><?php echo $this->lang->line('select'); ?>
                                        </option>
                                            <?php foreach ($medicineCategory as $dkey => $dvalue) {
                                            ?>
                                            <option value="<?php echo $dvalue["id"]; ?>"><?php echo $dvalue["medicine_category"] ?>
                                            </option>
                                                    <?php }?>
                                        </select>
                      <span class="text-danger"><?php echo form_error('medicine_category_id'); ?></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line("medicine_name"); ?></label> <small class="req"> *</small>
                      <select class="form-control select2 medicine_name_medication" style="width:100%" id="add_dose_medicine_id" name='medicine_name_id'>
                                        <option value=""><?php echo $this->lang->line('select'); ?>
                                            </option>
                                        </select>
                      <span class="text-danger"><?php echo form_error('medicine_name_id'); ?></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line("dosage"); ?></label> <small class="req"> *</small>
                      <select class="form-control select2 dosage_medication" style="width:100%" id="mdosage" onchange="" name='dosage'>
                                        <option value=""><?php echo $this->lang->line('select'); ?>
                                        </option>
                                </select>
                      <span class="text-danger"><?php echo form_error('dosage'); ?></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label><?php echo $this->lang->line("remarks"); ?></label>
                      <textarea name="remark" id="remark" class="form-control"></textarea>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" id="add_medicationdosebtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right">
                        <i class="fa fa-check-circle"></i> 
                        <?php echo $this->lang->line('save'); ?>
                    </button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <?php $this->load->view('admin/patient/Surgery/notas_enfermeria') ?>
    <?php $this->load->view('admin/patient/Surgery/dosis_medicamentos') ?>

    <script>
      $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
      });
    </script>


    <script>
      function addmedicationModal() {
        document.querySelector("#add_medication").reset();
        $("#mmedicine_id").val("").trigger("change");
        holdModal('myaddMedicationModal');
      }
    </script>

    <script>
      $(function() {
        $(".timepicker").timepicker({
          defaultTime: '12:00 PM'
        });
      });

      function holdModal(modalId) {
        $('#' + modalId).modal({
          backdrop: 'static',
          keyboard: false,
          show: true
        });
      }

      $(document).on('change', '.medicine_category_medication', function() {

        var medicine_category = $(this).val();
        console.log(medicine_category);

        $('.medicine_name_medication').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");
        getMedicineForMedication(medicine_category, "");
        getMedicineDosageForMedication(medicine_category);
      });

      function get_dosagename(id) {
        $.ajax({
          url: '<?php echo base_url(); ?>admin/pharmacy/get_dosagename',
          type: "POST",
          data: {
            dosage_id: id
          },
          dataType: 'json',
          success: function(res) {
            if (res) {
              $('#medicine_dosage_medication').val(res.dosage_unit);
            } else {

            }
          }
        });
      }


      function getMedicineDosageForMedication(medicine_category) {

        var div_data = "<option value=''>Select</option>";
        if (medicine_category != "") {
          $.ajax({
            url: '<?php echo base_url();?>admin/pharmacy/get_medicine_dosage',
            type: "POST",
            data: {
              medicine_category_id: medicine_category
            },
            dataType: 'json',
            success: function(res) {

              $.each(res, function(i, obj) {
                var sel = "";
                div_data += "<option value='" + obj.id + "'>" + obj.dosage + " " + obj.unit + "</option>";

              });
              $('.dosage_medication').html(div_data);
              $(".dosage_medication").select2("val", '');

            }
          });
        }
      }


      function getMedicineForMedication(medicine_category, medicine_id) {
        var div_data = "<option value=''>Select</option>";
        if (medicine_category != "") {
          $.ajax({
            url: '<?php echo base_url();?>admin/pharmacy/get_medicine_name',
            type: "POST",
            data: {
              medicine_category_id: medicine_category
            },
            dataType: 'json',
            success: function(res) {

              $.each(res, function(i, obj) {
                var sel = "";
                div_data += "<option value='" + obj.id + "'>" + obj.medicine_name + "</option>";

              });
              $('.medicine_name_medication').html(div_data);
              $(".medicine_name_medication").select2("val", medicine_id);
              $("#mmedicine_edit_id").val(medicine_id).trigger("change");
            }
          });
        }
      }
    </script>



    <script>
      $("form.chgstatus_form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
          type: "POST",
          url: url,
          data: form.serialize(), // serializes the form's elements.
          dataType: "JSON",
          success: function(data) {
            if (data.status == 0) {
              var message = "";
              $.each(data.error, function(index, value) {

                message += value;
              });
              errorMsg(message);
            } else {

              successMsg(data.message);

              window.location.reload(true);
            }
          }
        });
      });

      $(document).ready(function(e) {
        $("#add_medication").on('submit', (function(e) {
          e.preventDefault();
          $("#add_medicationbtn").button('loading');
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/addmedicationdoseopd',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
              $("#add_medicationbtn").button('loading');
            },
            success: function(data) {
              if (data.status == "fail") {
                var message = data.message;
                $.each(data.error, function(index, value) {
                  message += value;
                });
                errorMsg(message);
              } else {
                var message = data.message;
                $('#myaddMedicationModal').modal('hide');
                $('.ajaxlist_med').load(location.href + ' .ajaxlist_med');
                successMsg(data.message);
              }
              $("#add_medicationbtn").button('reset');
            },
            error: function() {
              $("#add_medicationbtn").button('reset');
            },

            complete: function() {
              $("#add_medicationbtn").button('reset');
            }
          });
        }));
      });

      $(function() {
        $(".timepicker").timepicker({
          defaultTime: '12:00 PM'
        });
      });



      $(document).ready(function(e) {

        var table;

        // Function to initialize DataTable
        function initDataTable() {
          table = $('#diagnosticos').DataTable({
            "paging": false,
            "info": false,
            "searching": false
          });
        }

        $("#add_medicationdose").on('submit', (function(e) {
          //             $("#add_medicationdosebtn").button('loading');
          e.preventDefault();
          $.ajax({
            url: '<?php echo base_url();?>admin/patient/addmedicationdoseopd',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
              $("#add_medicationdosebtn").button('loading');
            },
            success: function(data) {
              if (data.status == "fail") {
                var message = data.message;
                $.each(data.error, function(index, value) {
                  message += value;
                });
                errorMsg(message);
              } else {
                $('#myMedicationModal').modal('hide');
                $('.ajaxlist_med').load(location.href + ' .ajaxlist_med');
                successMsg(data.message);
              }
              $("#add_medicationdosebtn").button('reset');

            },
            error: function() {
              $("#add_medicationdosebtn").button('reset');
            },

            complete: function() {
              $("#add_medicationdosebtn").button('reset');
            }
          });
        }));

      });


      window.onload = function() {
        var showAlert = localStorage.getItem('showAlert');
        if (showAlert) {
          console.log("sesion");
          successMsg(showAlert);
          //             window.location.href = '#admision_cirugia';
          localStorage.removeItem('showAlert');
        }
      };

      function addmedicationModal() {
        document.querySelector("#add_medication").reset();
        $("#mmedicine_id").val("").trigger("change");
        holdModal('myaddMedicationModal');
      }


      $('#myaddMedicationModal').on('hidden.bs.modal', function() {
        $('#add_medication').find('input:text, input:password, input:file, textarea').val('');
        $('#add_medication').find('select option:selected').removeAttr('selected');
        $('#add_medication').find('input:checkbox, input:radio').removeAttr('checked');
        $('.medicine_category_medication').val("").trigger("change");
        $('.medicine_name_medication').val("").trigger("change");
        $('.dosage_medication').val("").trigger("change");
        $('#mtime').val('12:00 PM');
      });

      function medicationModal(medicine_category_id, pharmacy_id, date) {

        var div_data = "<option value=''><?php echo $this->lang->line('select'); ?></option>";
        if (medicine_category_id != "") {
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getMedicineDoseDetails',
            type: "POST",
            data: {
              medicine_category_id: medicine_category_id
            },
            dataType: 'json',
            success: function(res) {
              $.each(res, function(i, obj) {
                var sel = "";
                div_data += "<option value='" + obj.id + "'>" + obj.dosage + " " + obj.unit + "</option>";

              });

              $("#mdosage").html(div_data);

              $("#add_dose_medicine_category").select2("val", medicine_category_id);
              $("#mdosage").select2("val", '');
              getMedicineForMedication(medicine_category_id, pharmacy_id);

              $("#add_dose_date").val(date);

              holdModal('myMedicationModal');
            },
          });
        }

      }

      function medicationDoseModal(medication_id) {
        $.ajax({
          url: '<?php echo base_url(); ?>admin/patient/getMedicationDoseDetails',
          type: "POST",
          data: {
            medication_id: medication_id
          },
          dataType: 'json',
          success: function(data) {
            $("#date_edit_medication").val(data.date);
            $("#dosagetime").val(data.dosagetime);
            $('select[id="medicine_dose_id"] option[value="' + data.medicine_dosage_id + '"]').attr("selected", "selected");
            $("#medicine_dose_edit_id").select2().select2('val', data.medicine_dosage_id);
            $("#mmedicine_category_edit_id ").val(data.medicine_category_id).trigger('change');
            getMedicineForMedication(data.medicine_category_id, data.pharmacy_id);
            $("#medicine_dosage_remark").val(data.remark);
            $("#medication_id").val(data.id);
            <?php if ($this->rbac->hasPrivilege('ipd_medication', 'can_delete')) {  ?>
            $('#edit_delete').html("<a href='#' class='delete_record_dosage' data-record-id='" + medication_id + "' data-toggle='tooltip' title='<?php echo $this->lang->line('delete'); ?>' data-target='' data-toggle='modal'  data-original-title='<?php echo $this->lang->line('delete'); ?>'><i class='fa fa-trash'></i></a>");
            <?php } ?>
            holdModal('myMedicationDoseModal');
          },
        });
      }

      //function delete_record_dosage(id) {
      $(document).on('click', '.delete_record_dosage', function() {

        if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
          var id = $(this).data('recordId');
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/deletemedicationdosage',
            type: "POST",
            data: {
              medication_id: id
            },
            dataType: 'json',
            success: function(data) {
              successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
              window.location.reload(true);
            }
          })
        }
      });


      var diagnosticos = [];

      function cie_structure() {
        $.ajax({
          url: "https://www.datos.gov.co/resource/n7k8-72d2.json",
          type: 'GET',
          dataType: 'json',
          success: (resp) => {
            console.log(resp);
            let ciediez = resp;
            let text = "";
            let text2 = "";
            for (let property of ciediez) {
              text += `<a onclick="select_diagnostic('${property.cie10}','${property.descripcion_diagnostico}','second')" href="#"><li style="border: transparent;"class="list-group-item list-hover">${property.cie10} - ${property.descripcion_diagnostico}</li></a>`;
              text2 += `<a onclick="select_diagnostic('${property.cie10}','${property.descripcion_diagnostico}','primary')" href="#"><li style="border: transparent;"class="list-group-item list-hover">${property.cie10} - ${property.descripcion_diagnostico}</li></a>`;
            }
            //                 var total = diagnosticos.push('${property.cie10}','${property.descripcion_diagnostico}');
            console.log(diagnosticos);
            //                   document.getElementById("lista_second").innerHTML=text;
            document.getElementById("lista_diagnosis").innerHTML = text2;


          }
        });
      }

      $(document).ready(function(e) {
        $("#signos_form").on('submit', (function(e) {
          //             var nurse_id = $("#nurse_field").val();
          //             $("#nurse_set").val(nurse_id);
          //             $("#signos_addbtn").button('loading');
          e.preventDefault();
          $.ajax({
            url: '<?php echo base_url(); ?>admin/surgery/add_signos_vitales',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

              if (data.status == "fail") {

                var message = "";
                $.each(data.error, function(index, value) {

                  message += value;
                });
                errorMsg(message);
              } else {
                $('#signos_form')[0].reset();
                $('#Signos_Vitales').load(location.href + ' #Signos_Vitales');
                successMsg(data.message);

                //                         window.location.reload(true);

              }
              $("#nurse_notebtn").button('reset');

            },
            error: function() {

            }
          });


        }));
      });
      $(document).ready(function(e) {
        $("#Form_chequeo_1").on('submit', (function(e) {
          //             var nurse_id = $("#nurse_field").val();
          //             $("#nurse_set").val(nurse_id);
          //             $("#signos_addbtn").button('loading');
          e.preventDefault();
          $.ajax({
            url: '<?php echo base_url(); ?>admin/surgery/Save_Chequeo_One',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

              if (data.status == "fail") {
                var message = "";
                $.each(data.error, function(index, value) {
                  message += value;
                });
                errorMsg(message);
              } else {
                $('#Form_chequeo_1')[0].reset();
                $('#ListaChequeoQuirúrgico').load(location.href + ' #ListaChequeoQuirúrgico');
                successMsg(data.message);
                //                         window.location.reload(true);
              }
              $("#Save_Chequeo1").button('reset');

            },
            error: function() {

            }
          });


        }));
      });
      $(document).ready(function(e) {
        $("#Form_chequeo_2").on('submit', (function(e) {
          //             var nurse_id = $("#nurse_field").val();
          //             $("#nurse_set").val(nurse_id);
          //             $("#signos_addbtn").button('loading');
          e.preventDefault();
          $.ajax({
            url: '<?php echo base_url(); ?>admin/surgery/Save_Chequeo_Two',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

              if (data.status == "fail") {

                var message = "";
                $.each(data.error, function(index, value) {

                  message += value;
                });
                errorMsg(message);
              } else {
                $('#Form_chequeo_2')[0].reset();
                $('#ListaChequeoQuirúrgico').load(location.href + ' #ListaChequeoQuirúrgico');
                successMsg(data.message);
                //                         window.location.reload(true);
              }
              $("#Save_Chequeo2").button('reset');

            },
            error: function() {

            }
          });


        }));
      });

      function removeratr(type, nombre_diag, nota_diag, tipo_diag, state, id) {

        var select_diag2 = "";
        var nota = "";
        var tipo = "";
        console.log(state);
        if (state == "read") {
          var rowData = [nombre_diag, nota_diag, tipo_diag, type, " "];
          var newRow = table.row.add(rowData).draw().node();
          $(newRow).find('td:last').html('<button class="deleteRow">Eliminar</button>');

          // Add click event to the delete button
          $(newRow).find('.deleteRow').click(function() {
            table.row($(newRow)).remove().draw();
            delete_diag(id);
          });
        } else {

          if (type == "primario") {
            var diagnostico = document.getElementById('diagnostic').value;
            var tipoDiagnostico = document.getElementById('type_diagnostic').value;
            var notaDiagnostico = document.getElementById('note_diagnostic').value;
            var id_patient = document.getElementById('patient_diag').value;
            var id_visit = document.getElementById('visitid').value;
            var rowData = [diagnostico, notaDiagnostico, tipoDiagnostico, type, " "];
            var newRow = table.row.add(rowData).draw().node();

            var myJSON = JSON.stringify({
              "diagnostic": diagnostico,
              "note_diagnostic": notaDiagnostico,
              "type_diagnostic": tipoDiagnostico,
              "category_diagnostic": type,
              "id_visit": id_visit,
              "id_patient": id_patient
            });
            $.ajax({

              url: "<?=base_url('admin/Patient/patient_diagnostic')?>",
              data: myJSON,
              type: 'POST',
              success: (resp) => {
                console.log(resp);
              },
              error: function() {
                console.error("No es posible completar la operación");
              }
            });

            // Add a delete button to the new row
            $(newRow).find('td:last').html('<button class="deleteRow">Eliminar</button>');

            // Add click event to the delete button
            $(newRow).find('.deleteRow').click(function() {
              table.row($(newRow)).remove().draw();
              delete_diag(id_visit);
            });


            // Clear input fields after adding data
            document.getElementById('diagnostic').value = '';
            document.getElementById('type_diagnostic').value = '';
            document.getElementById('note_diagnostic').value = '';


            //         select_diag2 = document.getElementById("searchFilter").value;
            //         nota = document.getElementById('custom_fields[opd][57]').value;
            //         tipo = document.getElementById('custom_fields[opd][62]').value;
            //         cosntruct_table_second_diag(select_diag2,tipo,nota,"Diagnóstico Primario");




          }

          if (type == "secundario") {
            var id_visit = document.getElementById('visitid').value;
            var id_patient = document.getElementById('patient_diag').value;
            diagnostico = document.getElementById('diagnostic').value;
            tipoDiagnostico = document.getElementById('type_diagnostic').value;
            notaDiagnostico = document.getElementById('note_diagnostic').value;
            table = $('#diagnosticos').DataTable();

            rowData = [diagnostico, notaDiagnostico, tipoDiagnostico, type, " "];
            newRow = table.row.add(rowData).draw().node();

            var myJSON = JSON.stringify({
              "diagnostic": diagnostico,
              "note_diagnostic": notaDiagnostico,
              "type_diagnostic": tipoDiagnostico,
              "category_diagnostic": type,
              "id_visit": id_visit,
              "id_patient": id_patient
            });
            $.ajax({
              url: "<?=base_url('admin/Patient/patient_diagnostic')?>",
              data: myJSON,
              type: 'POST',
              success: (resp) => {
                console.log(resp);
              },
              error: function() {
                console.error("No es posible completar la operación");
              }
            });

            // Add a delete button to the new row
            $(newRow).find('td:last').html('<button class="deleteRow">Eliminar</button>');

            // Add click event to the delete button
            $(newRow).find('.deleteRow').click(function() {
              table.row($(newRow)).remove().draw();
              delete_diag(id_visit);
            });
          }
        }
        //     table.ajax.reload();
      }




      $("#insert_pre_anesthetic").on('submit', (function(e) {
        e.preventDefault();
        $("#insert_pre_anesthetic_btn").button('loading');
        $.ajax({
          url: "<?= base_url('admin/Surgery/add_pre_anesthetic/'.$result['result']["
          patient_id "].'/'.$id_visit->id.'/'.$result['result']['id'])?>",
          type: "POST",
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {
            $("#insert_pre_anesthetic_btn").button('loading');
          },
          success: function(data) {
            if (data.status == "fail") {
              var message = data.message;
              $.each(data.error, function(index, value) {
                message += value + `<br>`;
              });
              errorMsg(message);
            } else {
              //                       successMsg(data.message);
              localStorage.setItem('showAlert', data.message);
              window.location.reload(true);
            }
            $("#insert_pre_anesthetic_btn").button('reset');
          },
          error: function() {
            $("#insert_pre_anesthetic_btn").button('reset');
          },

          complete: function() {
            $("#insert_pre_anesthetic_btn").button('reset');
          }
        });
      }));


      function cups_structure() {

        let search_cups = document.getElementById("search_cups").value.toUpperCase();
        let cups_result = document.getElementById("cups_result");

        $.ajax({
          url: `https://www.datos.gov.co/resource/9zcz-bjue.json?$where=codigoprocedimiento%20like%20'%25${search_cups}%25'%20OR%20descripcion%20like%20'%25${search_cups}%25'%20OR%20codigocups%20like%20'%25${search_cups}%25'&$limit=10&$offset=0`,
          type: 'GET',
          dataType: 'json',
          data: {
            "$$app_token": "SRFsensloxdn0TDPB95X5rzpN"
          },
          success: (resp) => {
            console.log(resp);

            let cups = resp;
            if (search_cups.length != 0) {
              cups_result.removeAttribute("hidden");
            } else if (search_cups.length == 0) {
              cups_result.setAttribute("hidden", false);
            }
            //             let uniqueMedicines = removeDuplicatesMedicines(cups);
            //             console.log(uniqueMedicines);
            let cups_list = "";
            for (let property of cups) {
              cups_list += `<li class="list-group-item list-hover" onclick="addCups({ codigo:'${property.codigoprocedimiento}',
                                                                                            producto:'${property.descripcion}',
                                                                                          })">
                                    <div class="col-xs-10 col-sm-9">
                                        <span class="name"><strong>Codigo Cups: </strong>${property.codigocups}</span><br>
                                        <span><strong>Descripción: </strong>${property.descripcion}</span><br>
                                        <span><strong>Codigo Procedemiento: </strong>${property.codigoprocedimiento}</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>`;
            }

            document.getElementById("cups_result").innerHTML = cups_list;

          }
        });

        document.addEventListener('click', function(event) {
          const targetElement = event.target;

          if (targetElement !== search_cups && !cups_result.contains(targetElement)) {
            document.getElementById("search_cups").value = "";
            cups_result.setAttribute("hidden", false);
          }
        });
      }

      function addCups({
        codigo,
        producto
      }) {

        let codigo_cups = document.getElementById('codigo_cups');
        let product_cups = document.getElementById('product_cups');
        let cups_result = document.getElementById('cups_result');
        let search_cups = document.getElementById('search_cups');


        document.addEventListener('click', function(event) {
          const targetElement = event.target;
          if (targetElement !== search_cups && cups_result.contains(targetElement)) {
            search_cups.value = "";
            cups_result.setAttribute("hidden", false);
            search_cups.value = "";
          }
        });

        codigo_cups.value = `${codigo}`;
        product_cups.value = `${producto}`;

      }

      function filter_diagnosis() {

        let search_diagnosis = document.getElementById("search_diagnosis");
        let diagnosis_result = document.getElementById("diagnosis_result")
        let element = diagnosis_result.getElementsByTagName("li");
        let searchTerm = search_diagnosis.value.toUpperCase();

        if (search_diagnosis.length != 0) {

          diagnosis_result.removeAttribute("hidden");

          for (let i = 0; i < element.length; i++) {
            let a = element[i];
            let txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(searchTerm) > -1) {
              element[i].style.display = "";
            } else {
              element[i].style.display = "none";
            }
          }

        } else {
          diagnosis_result.setAttribute("hidden", false);
        }
      }


      window.addEventListener('load', () => {

        let search_diagnosis = document.getElementById("search_diagnosis").value;
        let diagnosis_result = document.getElementById("diagnosis_result");

        $.ajax({
          //             url: `https://www.datos.gov.co/resource/n7k8-72d2.json?$where=cie10%20like%20'%25${search_diagnosis}%25'%20OR%20descripcion_diagnostico%20like%20'%25${search_diagnosis}%25'%20OR%20periodo_de_consulta%20like%20'%25${search_diagnosis}%25'&$limit=10&$offset=0`,
          url: "<?=base_url('uploads/json_cie/cie_10.json')?>",
          type: 'GET',
          dataType: 'json',
          data: {
            "$$app_token": "SRFsensloxdn0TDPB95X5rzpN"
          },
          success: (resp) => {
            console.log(resp);
            const diagnosis = resp;
            let diagnosis_list = "";
            for (let property of diagnosis) {
              diagnosis_list += `<li class="list-group-item list-hover" onclick="add_diagnosis({ codigo:'${property.Codigo}',
                                                                                                     nombre:'${property.Nombre}'
                                                                                                   })">
                                      <div class="col-xs-10 col-sm-9" style="width: 100%">
                                          <span class="name">${property.Codigo} - ${property.Descripcion} - ${property.Nombre}</span>
                                      </div>
                                      <div class="clearfix"></div>
                                  </li>`;
            }

            document.getElementById("diagnosis_result").innerHTML = diagnosis_list;
          }
        });
      });


      function add_diagnosis({
        codigo,
        nombre
      }) {

        let search_diagnosis = document.getElementById("search_diagnosis");
        let diagnosis_result = document.getElementById("diagnosis_result");
        search_diagnosis.value = codigo + ' - ' + nombre;


        document.addEventListener('click', function(event) {
          const targetElement = event.target;

          if (targetElement !== search_diagnosis && diagnosis_result.contains(targetElement)) {
            diagnosis_result.setAttribute("hidden", false);
          }
        });

        //          fetch('<?= base_url("admin/appointment/update_block_days/") ?>', {
        //               method: "POST",
        //               headers: {
        //                 "Content-Type": "application/json"
        //               },
        //               body: JSON.stringify({
        //                   codigo: codigo,
        //                   descripcion: descripcion,
        //                   id_patient: "<?=$result['result']["patient_id"]?>",
        //                   id_visit: "<?=$id_visit->id?>"
        //               })
        //          })
        //         .then(response => response.json())
        //         .then(data => {
        //            console.log(data);


        //         }).catch(error => console.error(error));

      }
      
             function table_diagnosis(type) {

                const diagnostico = document.getElementById('search_diagnosis').value;
                const tipoDiagnostico = document.getElementById('type_diagnostic').value;
                const notaDiagnostico = document.getElementById('note_diagnostic').value;
                const id_patient = document.getElementById('patient_diag').value;

                const myJSON = JSON.stringify({
                      "diagnostic": diagnostico,
                      "note_diagnostic": notaDiagnostico,
                      "type_diagnostic": tipoDiagnostico,
                      "category_diagnostic": type,
                      "opd_id": '<?= $opdid ?>',
                      "id_patient": id_patient
                });
          
                $.ajax({
                  url: "<?=base_url('admin/Patient/patient_diagnostic')?>",
                  data: myJSON,
                  type: 'POST',
                  dataType: 'json',
                  success: (resp) => {
                      console.log(resp);
                      if(resp.state === 'fail'){ 
                          let message = '';
                          for(let error of Object.values(resp.errors)){
                            message += error+'<br>';
                          }
                          errorMsg(message); 
                      } else {
                          console.log(resp);
                          successMsg(resp.msg);
                          $('#diagnosticos').DataTable().ajax.reload();
                      }
                  },
                  error: function() {
                    console.error("No es posible completar la operación");
                  }
                });

//                 document.getElementById('diagnostic').value = '';
//                 document.getElementById('type_diagnostic').value = '';
//                 document.getElementById('note_diagnostic').value = '';

        }


       function delete_diag(id) {
            console.log(id);
            const myJSON = JSON.stringify({
              "id": id
            });
         
            $.ajax({
              url: "<?=base_url('admin/Patient/patient_diagnostic_delete')?>",
              data: myJSON,
              type: 'POST',
              dataType: 'json',
              success: (resp) => {

                 if(resp.state === 'success'){   
                      successMsg(resp.msg);
                 } else {
                      errorMsg(resp.msg);
                 }

                 $('#diagnosticos').DataTable().ajax.reload();
                
              },
              error: function() {
                console.error("No es posible completar la operación");
              }
            });
        }
      
      
      function imc() {

          let talla2 = document.getElementById('talla_custom').value;
          let talla = talla2 / 100;
          console.log(talla2);
          let peso = document.getElementById('peso_custom').value;
          if (talla2 == '' || peso == '') {
            var imc = 0;
            $("#imc_f").val(imc);
          } else {
            var imc = Math.round(peso / (talla * talla));
            let clasified = "";
            if (imc < 18.5) {
              clasified = "Bajo Peso";
            } else if (imc > 18.5 && imc < 24.9) {
              clasified = "Normal";
            } else if (imc > 24.9 && imc < 29.9) {
              clasified = "Sobrepeso";
            } else if (imc >= 30) {
              clasified = "Obesidad";
            }
            $("#imc_custom").val(imc);
            $("#clasified_custom").val(clasified);
            $("#clasificacion_imc").val(clasified);
            $("#imc_f").val(imc);
            console.log(clasified);
          }
          $("#imc_custom").val(imc);
          console.log(imc);

      }
      
      
      document.addEventListener('DOMContentLoaded', function() {
        
          let table_diagnosticos = $('#diagnosticos').DataTable({
                dom: 'rti',
                responsive: true,
                scrollCollapse: false,
                ordering: false,
                info: false,
                ajax: {
                    url: '<?= base_url('admin/patient/get_diagnosis'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                      opd_id: "<?=$opdid?>"
                    },
                    dataSrc: function (data) {
                      console.log(data);
                      return data.diagnosis;
                    }
                },
                columns: [
                    { data: "nombre_diag" },
                    { data: "nota_diag" },
                    { data: "tipo_diag" },
                    { data: "categoria_diag" },
                    {
                        data: null,
                        render: function (data) {
                          return `<button type='button' class="btn btn-danger btn-md" onclick='delete_diag(${data.id_diagnosis})'>Eliminar</button>`;
                        }
                    }
                ]
            });
 
      });

      

      
      
//       document.getElementById('patient_diagnosis').addEventListener('keyup',
//       function () {

//           const search_diagnosis = this.value;
//           let diagnosis_content = document.getElementById("patient_diagnosis_result");

//           fetch(`<?= base_url('admin/patient/search_diagnosis') ?>`, {
//               method: "POST",
//               headers: {
//                   "Content-Type": "application/json"
//               },
//               body: JSON.stringify({
//                   search_term: search_diagnosis
//               })
//           })
//           .then(response => response.json())
//           .then(data => {
//               console.log(data);
//               let diagnosis_result = "";
//               for(let item of data){
                
//                   diagnosis_result += `<li class="list-group-item list-hover" onclick="addCups({ nombre:'${item.Nombre}',
//                                                                                                     descripcion:'${item.Descripcion}',
//                                                                                                   })">
//                                             <div class="col-xs-10 col-sm-9">
//                                                 <span class="name"><strong>Nombre: </strong>${item.Nombre}</span><br>
//                                                 <span><strong>Descripción: </strong>${item.Descripcion}</span><br>
//                                             </div>
//                                             <div class="clearfix"></div>
//                                         </li>`;
//               }

//               diagnosis_content.innerHTML = diagnosis_result;

//           }).catch(error => console.error(error));
//       });
      
      
 </script>