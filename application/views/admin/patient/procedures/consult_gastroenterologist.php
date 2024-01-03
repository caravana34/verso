<link href="https://fonts.cdnfonts.com/css/nasalization-2" rel="stylesheet">

<style>
    .items_text{
        font-family: 'Nasalization', sans-serif !important;
        font-weight: normal !important;
        text-transform: capitalize !important;
        color: #28a9bf !important;
    }
    
    icon1{
        color:#1563B0;
    }
   
  .table_inner {
      overflow: auto;
      width: auto;
      white-space: normal;
      border-collapse: collapse;
      max-height: fit-content;
    }
  
  

</style>

<?php

  $currency_symbol = $this->customlib->getHospitalCurrencyFormat();
  $genderList = $this->customlib->getGender();
  // $case_reference_id= $result['case_reference_id'];
  $custom_cliniverso = $result['custom'];
  $result_param= $result['result'];
  $case_reference_id=$result['case_reference_id'];
  $categorylist = $this->operationtheatre_model->category_list();
//   echo "<pre>";
//   print_r($opdid);
//   exit;


  function space($s){

      switch ($s) {
              case 3:
                  echo "País";
                  break;
              case 4:
                  echo "Departamento";
                  break;
              case 5:
                  echo "Municipio";
                  break;
              case 7:
                  echo "Acompañante";
                  break;
              case 8:
                  echo "Cédula";
                  break;
              case 9:
                  echo "Huella";
                  break;
              case 10:
                  echo "Regimen";
                  break;
              case 11:
                  echo "Teléfono De Acompañante";
                  break;
              case 12:
                  echo "EPS";
                  break;
              case 13:
                  echo "Categoría discapacidad";
                  break;
              case 14:
                  echo "Estrato";
                  break;
              case 15:
                  echo "Teléfono de contacto auxiliar";
                  break;
              case 16:
                  echo "Estado de afiliación";
                  break;
              case 18:
                  echo "IMC";
                  break;
              case 19:
                  echo "Talla";
                  break;
              case 24:
                  echo "Voluntad Anticipada";
                  break;
              case 25:
                  echo "Dirección";
                  break;
              case 26:
                  echo "Zona de residencia";
                  break;
              case 28:
                  echo "Voluntad anticipada";
                  break;
              case 29:
                  echo "Observaciones";
                  break;
              case 30:
                  echo "Teléfono Principal";
                  break;
              case 31:
                  echo "Plan Complementario";
                  break;
              case 34:
                  echo "Antecedentes";
                  break;
              case 32:
                  echo "Motivo de consulta *";
                  break;
              case 36:
                  echo "Peso";
                  break;
              case 37:
                  echo "Clasificación IMC";
                  break;
              case 38:
                  echo "Frecuencia Cardíaca(FC)";
                  break;
              case 39:
                  echo "Frecuencia Respiratoria(FR)";
                  break;
              case 43:
                  echo "Revisión por sistemas";
                  break;
              case 44:
                  echo "Presión Arterial sistólica";
                  break;
              case 45:
                  echo "Presión Arterial diastólica";
                  break;
              case 46:
                  echo "Posición Presión Arterial";
                  break;
              case 47:
                  echo "Lugar Presión Arterial";
                  break;
              case 49:
                  echo "Temperatura";
                  break;
              case 52:
                  echo "SA02 sin oxígeno";
                  break;
              case 54:
                  echo "SAO2 con Oxígeno";
                  break;
              case 57:
                  echo "Diagnóstico";
                  break;
              case 58:
                  echo "Enfermedad actual";
                  break;
              case 59:
                  echo "Diagnóstico Principal";
                  break;
              case 62:
                  echo "Tipo de Diagnóstico principal";
                  break;
              case 64:
                  echo "Analisis";
                  break;
              case 65:
                  echo "Plan";
                  break;
              case 69:
                  echo "Causa Externa";
                  break;
              case 70:
                  echo "Arl";
                  break;
              case 72:
                  echo "Diagnóstico Secundarios";
                  break;
              case 75:
                  echo "Antecedentes Socioeconómicos";
                  break;
              case 76:
                  echo "Antecedentes Patológicos";
                  break;
              case 77:
                  echo "Antecedentes Familiares";
                  break;
              case 78:
                  echo "Antecedentes Farmacológicos";
                  break;
              case 79:
                  echo "Antecedentes Transfusiones";
                  break;
              case 80:
                  echo "Hábitos";
                  break;
              case 81:
                  echo "Ginecobstetrico";
                  break;
               case 74:
                  echo "Diagnóstico secundario";
                  break;
                  case 83:
                  echo "Torax";
                  break;
              case 84:
                  echo "Gastrointestinal";
                  break;
              case 85:
                  echo "Genetourinario";
                  break;
              case 86:
                  echo "Osteomuscular";
                  break;
              case 87:
                  echo "Neurológico";
                  break;
              case 88:
                  echo "Vascular Periférico";
                  break;
              case 89:
                  echo "Piel y anexos";
                  break;
              case 90:
                  echo "Cabeza y Cuello";
                  break;
              case 91:
                  echo "Estado General del paciente";
                  break;
              case 92:
                  echo "Alérgicos";
                  break;
              case 93:
                  echo "Quirúrgicos";
                  break;
              case 95:
                  echo "Tratamiento farmacológico";
                  break;
              case 96:
                  echo "Escala Eva";
                  break;

      }
  }

  ?>







<?php
$currency_symbol = $this->customlib->getHospitalCurrencyFormat();
$genderList = $this->customlib->getGender();
$case_reference_id=$result['case_reference_id'];
$categorylist = $this->operationtheatre_model->category_list();
?>

<script src="<?php echo base_url('/') ?>backend/js/Chart.bundle.js"></script>
<script src="<?php echo base_url('/') ?>backend/js/utils.js"></script>



<div class="content-wrapper" >
    <section class="content">
         <div class="box box-primary">
            <div style="display: flex; align-items: center;">
                <div class="col-md-7">
                    <?php
                        $opdidtwo = $doctor_app[0]->opdid ?? '';
                        $appointmentTime = new DateTime($doctor_app[0]->time ?? 'now');
                        $startTime = $appointmentTime->format('g:i A');

                        $appointmentTime->add(new DateInterval('PT' . ($doctor_duration[0]->consult_duration ?? 0) . 'M'));

                        $currentTime = new DateTime();
                        $status = ($currentTime->format('H:i:s') === $doctor_app[0]->time) ? 'started' : 'not_started';
                    ?>
                <h4 class=" items_text" style="font-size:25px;"><i class='fas fa-file-medical' style='font-size:24px'></i> Procedimientos</h4>
                <button id="openModalBtn" class="btn btn-md get_opd_detail" data-opdid="<?= $opdid ?>">Ver Detalle</button>
                <button id="openModalBtnprint" class="btn btn-md print_opd_clini_procedure" data-opdid="<?= $opdid ?>">Imprimir</button>
                <button id="openModalBtnprint2" class="btn btn-md printBill" data-opdid="<?= $opdid ?>">Factura</button>
                <h5>
                    <span><strong>Fecha:</strong> <?= $doctor_app[0]->date ?? '' ?></span>
                    <span>
                        <strong>Hora de inicio:</strong> <?= $startTime ?> -
                        <strong>Hora final:</strong> <?= $appointmentTime->format('g:i A') ?>
                    </span>
                    <span <?= ($result['result']['refference'] ?? '') == "Abierta" ? "" : "hidden" ?> id="time_progress"></span>
                </h5>
                <!-- readonly disabled -->
                <?php $result_state_readonly = $result['result']['refference']=="Abierta" ? "" : "" ?>
                <?php $result_state_disabled = $result['result']['refference']=="Abierta" ? "" : "" ?>
                <div class="" style="position: absolute; right: 10px;">
                  <button onclick="confirmar_opd('<?= $result['result']['id']?>', '<?= $id?>', '<?= $id_visit[0]->id?>')" id="confirmar" class="btn btn-danger btn-sm mt-5" <?= $result_state_disabled?> type="button"><?= $result_state = $result['result']['refference']=="Abierta" ? "Finalizar" : "Finalizada" ?></button>
                </div>
             </div>
            </div>
            <div class="box border0 mb0">
                <div class="nav-tabs-custom border0 mb0" id="tabs">
                    <div class="scrtabs-tab-container" style="visibility: visible;">
                        <div class="scrtabs-tab-scroll-arrow scrtabs-js-tab-scroll-arrow-left" style="display: block;">
                            <span class="fa fa-chevron-left"></span>
                        </div>
                        <div class="scrtabs-tabs-fixed-container" style="width: 997px;">
                            <div class="scrtabs-tabs-movable-container" style="width: 1740px; left: 0px;">
                                <ul class="nav nav-tabs navlistscroll">
                                    <li class="active">
                                        <a href="#overview" data-toggle="tab" aria-expanded="true">
                                            <i class="icon1 fa fa-th" style='font-size:25px;color:#1563B0;'></i>
                                            Visión general
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#procedure_Mayores" data-toggle="tab" aria-expanded="true">
                                            <i class="icon1 fas fa-first-aid" style='font-size:25px;color:#1563B0'></i> 
                                            Procedimientos Mayores
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#procedure_Menores" data-toggle="tab" aria-expanded="true">
                                            <i class="icon1 fas fa-file-medical" style='font-size:25px;color:#1563B0'></i> 
                                            Procedimientos Menores
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="scrtabs-tab-scroll-arrow scrtabs-js-tab-scroll-arrow-right" style="display: block;">
                            <span class="fa fa-chevron-right"></span>
                        </div>
                    </div>
                    <div class="tab-content">
                        <!-- ----------------VISTA GENERAL----------------------- -->
                        <div class="tab-pane tab-content-height active" id="overview">
                            <div class="row">
                                <div id="read_history" class="col-lg-6 col-md-6 col-sm-12 border-r">
                              <div class="box-header border-b mb10 pl-0" style="padding: 12px;">
                                <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14" style="margin-right: 20px;">
                                  <?php echo $result['result']['patient_name'] ;?>
                                  <?php echo $result['result']['guardian_name'] ;?>
                                  <?php echo $result['result']['id'] ;?>
                                </h3>
                                <div class="pull-right">
                                  <a href="<?php echo base_url() ."admin/patient/profile/".$result['result']['patient_id'] ."/". $result['result']["id"] ?>" id="" class="btn btn-md revisitpatient" style="background:#1563B0; color:#fff;border-radius: 30px;" data-toggle="tooltip"
                                    title="Perfil">
                                      <i class="fas fa-arrow-circle-left"></i> Paciente</a>
                                </div>
                                <div class="pull-right">
                                  <div class="editviewdelete-icon pt8 text-center">
                                    <input type="hidden" id="result_opdid" name="" value="<?php echo $result['id'] ?>">
                                    <input type="hidden" id="result_pid" name="" value="<?php echo $result['patient_id'] ?>">
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
                                    <img style="width:auto !important; height:90px !important;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url(); ?><?php echo $file.img_time() ?>">
                                </div>
                                <!--./col-lg-5-->
                                <div class="col-lg-9 col-md-8 col-sm-12">
                                  <table class="table table-bordered mb0">
                                    <tr>
                                      <td class="bolds" style="padding:0px">
                                        <?php echo $this->lang->line('age'); ?>: </td>
                                      <td style="padding:0px"><span><?php echo $this->customlib->getPatientAge($result['result']['age'],$result['result']['month'],$result['result']['day']); ?></span></td>
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
                                      <!--                                                         <td class="bolds"><?php echo $this->lang->line('phone'); ?></td> -->
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
                                        <?php echo $result['result']['blood_group_name']; ?> </td>
                                    </tr>

                                  </table>
                                </div>
                                <!--./col-lg-7-->
                              </div>
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
                                    <div class="col-lg-12 col-md-12 col-sm-12">
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
                                                             <?php echo $this->lang->line('note') ."</br>". nl2br($nurse_note[$i]['note']); ?> 
                                                         </div>
                                                          <div class="timeline-body">
                                                            <?php echo $this->lang->line('comment') ."</br> ". nl2br($nurse_note[$i]['comment']); ?> 
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
                                                                <div class="text-right mb0 ptt10"> <?php echo $comment_date." ". $comment_by ?></div>
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
                                      </div>
                                  </div>
                              </div>
                              <!--./col-lg-6-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
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
                                        </div> 
                                        
                                    </div>
                                    <!--./col-lg-5-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 " style="border:solid #1563b0 0.5px;border-radius:15px;padding:25px;">
                                        <?php
                                              if (!empty($DataSmall)) {
                                                  $infoOpeSmall = reset($DataSmall);
                                                  ?>
                                                  <div class=" col-12 pull-right">
                                                      <input type="hidden" value="<?php echo $infoOpeSmall['id']; ?>">
                                                      <i class="fas fa-edit ml-2" onclick="editotSmall(<?php echo $infoOpeSmall['id']; ?>)" style='font-size:23px; padding:15px; color:#1563b0;' title="Actualizar"></i>
                                                  </div>
                                                  <p><strong style=" color:#1563b0;">Nº:</strong><?php echo $infoOpeSmall['id']; ?></p>
                                                  <p><strong style=" color:#1563b0;">Fecha: </strong><?php echo $infoOpeSmall['date']; ?></p>
                                                  <p><strong style=" color:#1563b0;">Tipo de operación: </strong><?php echo $infoOpeSmall['operation_type']; ?></p>
                                                  <p><strong style=" color:#1563b0;">Descripción De Anestecia: </strong><?php echo $infoOpeSmall['descrition_anaethesia']; ?></p>
                                                  <p><strong style=" color:#1563b0;">Descripción procedimiento: </strong><?php echo $infoOpeSmall['remark']; ?></p>
                                                  <p><strong style=" color:#1563b0;">sugerencias y conclusiones: </strong><?php echo $infoOpeSmall['Surgery_conclusions']; ?></p>
                                                  <p><strong style=" color:#1563b0;">resultado: </strong><?php echo $infoOpeSmall['result']; ?></p>
                                                  <?php
                                              } else {
                                                  echo "<p>No hay datos disponibles.</p>";
                                              }
                                          ?>
                                    </div>
                                 </div> <!--./col-lg-6-->
                            </div><!--./row-->
                        </div><!--END-VISTA GENERAL-->
                       <!-------------------procedure_Mayores----------------------------------- -->
                        <div class="tab-pane tab-content-height " id="procedure_Mayores">
                            <div class="box border0 mb0">
                                <div class="" style="width: -webkit-fill-available;padding:10px;border-radius:15px; border: 1px solid #28A9BF; margin-bottom:10px;">
                                    <div class="nav-tabs-custom border0 mb0" id="nested-tabs">
                                    <div class="scrtabs-tab-container" style="visibility: visible;">
                                        <div class="scrtabs-tab-scroll-arrow scrtabs-js-tab-scroll-arrow-left" style="display: block;">
                                            <span class="fa fa-chevron-left"></span>
                                        </div>
                                        <div class="scrtabs-tabs-fixed-container" style="width: 997px;">
                                            <div class="scrtabs-tabs-movable-container" style="width: 1740px; left: 0px;">
                                                <ul class="nav nav-tabs nav">
                                                    <li class="active">
                                                        <a href="#procedure_admision" data-toggle="tab" aria-expanded="true" style="font-family: 'Nasalization', sans-serif !important;">
                                                            <i class="icon1 fas fa-walking" style='font-size:25px;color:#1563B0;'></i>
                                                            Ingreso
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#procedure_transoperatorio" data-toggle="tab" aria-expanded="true" style="font-family: 'Nasalization', sans-serif !important;">
                                                            <i class="icon1 fas fa-stethoscope" style='font-size:25px;color:#1563B0'></i> 
                                                            durante el procedimiento
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#procedure_postoperatorio" data-toggle="tab" aria-expanded="true" style="font-family: 'Nasalization', sans-serif !important;">
                                                            <i class="icon1 fas fa-diagnoses" style='font-size:25px;color:#1563B0'></i> 
                                                            finalización del procedimiento
                                                        </a>
                                                    </li>
                                                     
                                                  <li class="">
                                                     <div class="col-md-6">
                                                          <div class="text-center text-light" style="margin.top:15px;">
                                                              <?php 
                                                                  if (empty($DataSmall)) { 
                                                              ?>
                                                                  <a href="#" class="btn btn-md" style="background:#1563B0; color:#fff; border-radius: 30px; margin-bottom:15px;" onclick="add_equipoSmall('<?php echo $opdid; ?>')" data-toggle="tooltip" data-original-title="Historia Clínica">
                                                                      <i class="fa fa-group"></i>  
                                                                      Descripción
                                                                  </a>
                                                              <?php 
                                                                  } else {
                                                                      echo '<p class=""><strong style="color:#1563b0;font-size:23px;"><i class="fa fa-group"></i> Descripción de procedimiento </strong></p>';
                                                                  } 
                                                              ?>
                                                          </div>                                                     
                                                      </div> 
                                                  </li>
                                                </ul>
                                            </div>
                                          
                                        </div>
                                        <div class="scrtabs-tab-scroll-arrow scrtabs-js-tab-scroll-arrow-right" style="display: block;">
                                            <span class="fa fa-chevron-right"></span>
                                        </div>
                                    </div>
                                      
                                    <div class="tab-content">
                                        <!-- -----------------------Admisión------------------------- -->
                                        <div class="tab-pane tab-content-height active" id="procedure_admision">
                                            <div class="box-tab-header">
                                                <h3 class="box-tab-title items_text" style="font-size:22px;">Ingreso</h3>
                                            </div>  
                                            <!-- -----------TAB TABLASAdmisión ---------- -->
                                            <div class="row">
                                                <!-- -------------TABAL COLOMNA 1------------------ -->
                                                <div id="read_history" class="col-lg-4 col-md-4col-sm-12 border-r">
                                                    <div class="row">
                                                    <!-- -------------NOTAS DE ENFERMERIA----------- -->
                                                        <div class="col-lg-12 col-md-4 col-sm-12" style="overflow-y: scroll; height:450px;">
                                                            <div class="box-tab-header">
                                                                <h3 class="box-tab-title">
                                                                    <i class="fas fa-briefcase-medical" style='font-size:24px; color:#1563B0;'></i> 
                                                                    <strong style="color:#1563B0">
                                                                        Notas de enfermería
                                                                    </strong>
                                                                </h3>

                                                                <div class="box-tab-tools">
                                                                    <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background:#1563b0;color:#fff;border-radius:15px;" data-opdid="<?php echo $opdid; ?>" data-tab="Enfermeria">
                                                                        +
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-header no-border pb1">
                                                                <div id="timeline_list">
                                                                    <?php if (empty($Admision_nn)) { ?>
                                                                    <?php } else { ?>
                                                                    <ul class="timeline timeline-inverse">
                                                                        <?php for ($i=0; $i <$recent_record_count; $i++) { if (!empty($Admision_nn[$i])) { $id = $Admision_nn[$i]['id']; ?>
                                                                        <li class="time-label">
                                                                            <span class="bg-blue">
                                                                                <?php echo $this->customlib->YYYYMMDDHisTodateFormat($Admision_nn[$i]['date']); ?>
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <i class="fa fa-list-alt bg-blue"></i>
                                                                            <div class="timeline-item">
                                                                                <h3 class="timeline-header text-aqua"> 
                                                                                    <?php echo $Admision_nn[$i]['name'].' '.$Admision_nn[$i]['surname']." ( ".$Admision_nn[$i]['employee_id']." )" ; ?>
                                                                                </h3>
                                                                                <div class="timeline-body">
                                                                                    <?php echo $this->lang->line('note') ."</br>". nl2br($Admision_nn[$i]['note']); ?> 
                                                                                </div>
                                                                                <div class="timeline-body">
                                                                                    <?php echo $this->lang->line('comment') ."</br> ". nl2br($Admision_nn[$i]['comment']); ?> 
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
                                                        </div><!--END--NOTAS DE ENFERMERIA -->
                                                    </div>
                                                </div><!--END---TABAL COLOMNA 1 -->
                                                <!--SIG.VITALES-->
                                                <div class="col-lg-8 col-md-7 col-sm-12 mt-3" style="overflow-y: scroll; height:450px;">
                                                    <div class="tab-content-height">
                                                        <div class="box-tab-header mb-2">
                                                            <h3 class="box-tab-title" style="color:#1563B0;">
                                                                <i class="fas fa-file-medical-alt" style='font-size:24px; color:#1563B0;'></i>
                                                                <strong>Notas de Signos vitales</strong>
                                                            </h3>
                                                            <div class="box-tab-tools">
                                                                 <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background:#1563b0;color:#fff;border-radius:15px;" data-opdid="<?php echo $opdid; ?>" data-tab="Signos_Vitales_admision">
                                                                     Registros de signos vitales
                                                                 </button>
                                                            </div>
                                                        </div>
                                                        <table class="table table-hover table-striped mt-5 mb-5" id="signos_vitales">
                                                            <thead>
                                                                <tr>
                                                                    <th style="background:#00C9EF; color:#fff;">Fecha</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Tiempo</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Peso</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Talla</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Temperaturas</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Pres. Diastólica</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Pres. Sistólicaa</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Frec. Cardíaca</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Frec. Respiratoria</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Observaciones</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Acción</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                               <?php foreach ($Admision_sv as $key =>$signos_vitales): ?>
                                                                <tr>
                                                                    <td><?php echo $signos_vitales->date; ?></td>
                                                                    <td><?php echo $signos_vitales->time; ?></td>
                                                                    <td><?php echo $signos_vitales->peso; ?></td>
                                                                    <td><?php echo $signos_vitales->talla; ?></td>
                                                                    <td><?php echo $signos_vitales->temperatura; ?></td>
                                                                    <td><?php echo $signos_vitales->presion_dia; ?></td>
                                                                    <td><?php echo $signos_vitales->presion_sis; ?></td>
                                                                    <td><?php echo $signos_vitales->frec_card; ?></td>
                                                                    <td><?php echo $signos_vitales->frec_resp; ?></td>
                                                                    <td><?php echo $signos_vitales->remark; ?></td>
                                                                    <td>
                                                                        <input type="hidden" value="<?php echo $signos_vitales->id; ?>">
                                                                        <i class='fas fa-edit ml-2' style='font-size:18px;' onclick='ModalSignosVitales(<?php echo $signos_vitales->id; ?>)' style='font-size:22px; padding:2px;'  data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" title="Actualizar"></i>
                                                                        <i class="fa fa-trash delete_signos_vitales" data-id="<?php echo $signos_vitales->id; ?>" style='font-size:22px; padding:2px;' title="Eliminar"></i>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                    </div><!-- ---END-----TABLA DE SIG. VITALES------- -->    
                                                </div><!--END-SIG. VITALES-->
                                                <!------------------ADMICION--Medicamentos-------------------- -->
                                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3" style="">
                                                    <hr class="hr-panel-heading hr-10">
                                                    <div class="tab-pane tab-content-height" id="Medicamentos">
                                                        <div class="box-tab-header mb-2" style="margin-top:40px;">
                                                            <h3 class="box-tab-title" style="color:#1563B0;">
                                                                <i class="fas fa-pills" style='font-size:24px;color:#1563B0;'></i>
                                                                <strong>Notas medicamentos</strong>
                                                            </h3>
                                                            <div class="box-tab-tools">
                                                                 <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background:#1563b0;color:#fff;border-radius:15px;" data-opdid="<?php echo $opdid; ?>" data-tab="Medicamentos1">
                                                                     Registros de medicamentos
                                                                 </button>
                                                            </div>
                                                        </div>
                                                        <div class="table_inner">
                                                            <table class="table table-striped table-bordered table-hover ajaxlist_med">
                                                                <?php if(!empty($medication)){ ?>
                                                                <thead>
                                                                    <th class="hard_left">
                                                                      <?php echo $this->lang->line("date"); ?>
                                                                    </th>
                                                                    <th class="next_left">
                                                                      <?php echo $this->lang->line("medicine_name"); ?>
                                                                    </th>
                                                                    <?php if (!empty($max_dose)) {
                                                                            $dosage_count = $max_dose;
                                                                           } else{
                                                                              $dosage_count = 0;
                                                                           }
                                                                       for ($x = 1; $x <= $dosage_count; $x++) { ?>
                                                                     <th class="sticky-col" width="150">
                                                                       <?php echo $this->lang->line("dose").''.$x  ;?>
                                                                     </th>
                                                                        <?php } ?>
                                                                </thead>
                                                                <tbody>
                                                                <?php $count = 1; 
                                                                    foreach ($medication as $medication_key => $medication_value){
                                                                      $pharmacy_id = $medication_value['pharmacy_id'];
                                                                      $medicine_category_id = $medication_value['medicine_category_id'];
                                                                      $date = $medication_value['date']; ?>
                                                                    <tr>
                                                                          <?php $subcount = 1; foreach ($medication_value['dosage'][$date] as $mkey => $mvalue) {
                                                                              $date = $this->customlib->YYYYMMDDTodateFormat($medication_value['date']); ?>
                                                                       <td class="hard_left">
                                                                        <?php if($subcount==1){ echo $date."<br>(".date('l', strtotime($medication_value['date'])).")"; 
                                                                              }else{ echo "<span class='fa-level-span'><i class='fa fa-level-up fa-level-roated' aria-hidden='true'></i></span>"; } ?>
                                                                       </td>
                                                                       <td class="next_left">
                                                                           <?php echo $mvalue['name'] ?>
                                                                       </td>
                                                                            <?php for ($x = 0; $x <= $dosage_count; $x++){
                                                                              if (array_key_exists($x,$mvalue['dose_list'])) {
                                                                                  $medicine_id = $mvalue['dose_list'][$x]['pharmacy_id'];
                                                                                  $medicine_category_id = $mvalue['dose_list'][$x]['medicine_category_id'];
                                                                                  $add_index= $x;
                                                                              if ($this->rbac->hasPrivilege('ipd_medication', 'can_edit')) {
                                                                                    $medication_edit = "<a href='#' class='btn btn-default btn-xs' data-toggle='tooltip' data-original-title='".$this->lang->line('edit')."' onclick='medicationDoseModal(" .$mvalue['dose_list'][$x]['id'].")'><i class='fa fa-pencil'></i></a>";
                                                                                    }else{
                                                                                    $medication_edit = "";
                                                                                    }
                                                                              if ($this->rbac->hasPrivilege('opd_medication', 'can_delete')) { 
                                                                                    $medication_delete = "<a  class='btn btn-default btn-xs delete_record_dosage' data-toggle='tooltip' data-original-title='".$this->lang->line('delete')."' data-record-id='".$mvalue['dose_list'][$x]['id']."'><i class='fa fa-trash'></i></a>"; 
                                                                                    }else{ $medication_delete = ""; }  ?>
                                                                          <td class="dosehover">
                                                                                <?php echo $this->lang->line('time').": ".date('h:i A',strtotime($mvalue['dose_list'][$x]['time']))."</a><span>".$medication_edit."</span><span>".$medication_delete."</span></br>". $mvalue['dose_list'][$x]['medicine_dosage']." ".$mvalue['dose_list'][$x]['unit']; if($mvalue['dose_list'][$x]['remark']!=''){ echo " <br>".$this->lang->line('remark').": ".$mvalue['dose_list'][$x]['remark'] ;}?>
                                                                          </td>
                                                                                <?php }else { ?>
                                                                          <td class="dosehover">
                                                                                <?php if($add_index+1== $x){ ?>
                                                                                    <?php if ($this->rbac->hasPrivilege('opd_medication', 'can_add')) {
                                                                                  if($is_discharge){ ?>
                                                                                  <a href="#" class="btn btn-sm btn-primary dropdown-toggle addmedication" onclick="medicationModal('<?php echo $medicine_category_id;?>','<?php echo $medicine_id ;?>','<?php echo $date;?>')" data-toggle='modal'>
                                                                                      <i class="fa fa-plus"></i>
                                                                                  </a>
                                                                                    <?php }} ?>
                                                                                <?php } ?>
                                                                            </td>
                                                                                <?php }?>
                                                                                <?php } ?>
                                                                    </tr>
                                                                            <?php $subcount++; }} ?>
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
                                                </div><!---END--Medicamentos -->
                                            </div><!--END--TAB TABLAS Admisión-->
                                        </div><!-- -END--Admisión -->
                                        <!-- -----------------------Post Operatori------------------- -->
                                        <div class="tab-pane tab-content-height" id="procedure_postoperatorio">
                                            <div class="box-tab-header">
                                                <h3 class="box-tab-title items_text" style="font-size:22px;">finalización del procedimiento</h3>                   
                                            </div>
                                            <!-- -----------TAB TABLAS PoestOper.---------- -->
                                            <div class="row">
                                                <!-- -------------TABAL COLOMNA 1------------------ -->
                                                <div id="read_history" class="col-lg-4 col-md-4col-sm-12 border-r">
                                                    <div class="row">
                                                        <!-- -------------NOTAS DE ENFERMERIA----------- -->
                                                        <div class="col-lg-12 col-md-4 col-sm-12" style="overflow-y: scroll; height: 450px;">
                                                            <div class="box-tab-header mb-2">
                                                                <h3 class="box-tab-title" style="color:#1563B0;">
                                                                    <i class="fas fa-briefcase-medical" style='font-size:24px; color:#1563B0;'></i> 
                                                                    <strong>Notas de enfermería</strong>
                                                                </h3>
                                                                <div class="box-tab-tools">
                                                                     <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background:#1563b0;color:#fff;border-radius:15px;" data-opdid="<?php echo $opdid; ?>" data-tab="Enfermeria">
                                                                        Registros de enfermería
                                                                     </button>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-header no-border pb1">
                                                                <div id="timeline_list">
                                                                    <?php if (empty($Postoperatorio_nn)) { ?>
                                                                    <?php } else { ?>
                                                                    <ul class="timeline timeline-inverse">
                                                                        <?php for ($i=0; $i <$recent_record_count; $i++) { if (!empty($Postoperatorio_nn[$i])) { $id = $Postoperatorio_nn[$i]['id']; ?>
                                                                        <li class="time-label">
                                                                            <span class="bg-blue">
                                                                                <?php echo $this->customlib->YYYYMMDDHisTodateFormat($Postoperatorio_nn[$i]['date']); ?>
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <i class="fa fa-list-alt bg-blue"></i>
                                                                            <div class="timeline-item">
                                                                                <h3 class="timeline-header text-aqua"> 
                                                                                    <?php echo $Postoperatorio_nn[$i]['name'].' '.$Postoperatorio_nn[$i]['surname']." ( ".$Postoperatorio_nn[$i]['employee_id']." )" ; ?>
                                                                                </h3>
                                                                                <div class="timeline-body">
                                                                                    <?php echo $this->lang->line('note') ."</br>". nl2br($Postoperatorio_nn[$i]['note']); ?> 
                                                                                </div>
                                                                                <div class="timeline-body">
                                                                                    <?php echo $this->lang->line('comment') ."</br> ". nl2br($Postoperatorio_nn[$i]['comment']); ?> 
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
                                                        </div><!--END--NOTAS DE ENFERMERIA -->
                                                    </div>
                                                </div><!--END---TABAL COLOMNA 1 -->  
                                                 <!--SIG.VITALES-->
                                                <div class="col-lg-8 col-md-7 col-sm-12" style="overflow-y: scroll; height: 450px;">
                                                    <div class="tab-content-height">
                                                        <div class="box-tab-header mb-2">
                                                            <h3 class="box-tab-title" style="color:#1563B0;">
                                                                <i class="fas fa-file-medical-alt" style='font-size:24px; color:#1563B0;'></i> 
                                                                <strong>Notas de Signos vitales</strong>
                                                            </h3>
                                                            <div class="box-tab-tools">
                                                                 <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background:#1563b0;color:#fff;border-radius:15px;" data-opdid="<?php echo $opdid; ?>" data-tab="Signos_Vitales_admision">
                                                                     Registros de signos vitales
                                                                 </button>
                                                            </div>
                                                        </div>
                                                        <table class="table table-hover table-striped mt-5 mb-5" id="signos_vitales">
                                                            <thead>
                                                                <tr>
                                                                    <th style="background:#00C9EF; color:#fff;">Fecha</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Tiempo</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Peso</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Talla</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Temperaturas</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Pres. Diastólica</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Pres. Sistólicaa</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Frec. Cardíaca</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Frec. Respiratoria</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Observaciones</th>
                                                                    <th style="background:#00C9EF; color:#fff;">Acción</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($Postoperatorio_sv as $key =>$signos_vitales): ?>
                                                                <tr>
                                                                    <td><?php echo $signos_vitales->date; ?></td>
                                                                    <td><?php echo $signos_vitales->time; ?></td>
                                                                    <td><?php echo $signos_vitales->peso; ?></td>
                                                                    <td><?php echo $signos_vitales->talla; ?></td>
                                                                    <td><?php echo $signos_vitales->temperatura; ?></td>
                                                                    <td><?php echo $signos_vitales->presion_dia; ?></td>
                                                                    <td><?php echo $signos_vitales->presion_sis; ?></td>
                                                                    <td><?php echo $signos_vitales->frec_card; ?></td>
                                                                    <td><?php echo $signos_vitales->frec_resp; ?></td>
                                                                    <td><?php echo $signos_vitales->remark; ?></td>
                                                                    <td>
                                                                        <input type="hidden" value="<?php echo $signos_vitales->id; ?>">
                                                                        <i class='fas fa-edit ml-2' style='font-size:18px;' onclick='ModalSignosVitales(<?php echo $signos_vitales->id; ?>)' style='font-size:22px; padding:2px;'  data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" title="Actualizar"></i>
                                                                        <i class="fa fa-trash delete_signos_vitales" data-id="<?php echo $signos_vitales->id; ?>" style='font-size:22px; padding:2px;' title="Eliminar"></i>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                    </div><!-- ---END-----TABLA DE SIG. VITALES------- -->    
                                                </div><!--END-SIG. VITALES-->
                                                <!------------------ADMICION--Medicamentos-------------------- -->
                                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3" style="">
                                                    <hr class="hr-panel-heading hr-10">
                                                    <div class="box-tab-header mb-2"style="margin-top:40px;">
                                                        <h3 class="box-tab-title" style="color:#1563B0;">
                                                            <i class="fas fa-pills" style='font-size:24px;color:#1563B0;'></i> 
                                                            <strong>Notas Medicamentos</strong>
                                                        </h3>
                                                        <div class="box-tab-tools">
                                                             <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background:#1563b0;color:#fff;border-radius:15px;" data-opdid="<?php echo $opdid; ?>" data-tab="Medicamentos1">
                                                                 Registros de medicamentos
                                                             </button>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane tab-content-height" id="Medicamentos">
                                                        <div class="table_inner">
                                                            <table class="table table-striped table-bordered table-hover ajaxlist_med">
                                                                <?php if(!empty($medication)){ ?>
                                                                <thead>
                                                                    <th class="hard_left">
                                                                      <?php echo $this->lang->line("date"); ?>
                                                                    </th>
                                                                    <th class="next_left">
                                                                      <?php echo $this->lang->line("medicine_name"); ?>
                                                                    </th>
                                                                    <?php if (!empty($max_dose)) {
                                                                            $dosage_count = $max_dose;
                                                                           } else{
                                                                              $dosage_count = 0;
                                                                           }
                                                                       for ($x = 1; $x <= $dosage_count; $x++) { ?>
                                                                     <th class="sticky-col" width="150">
                                                                       <?php echo $this->lang->line("dose").''.$x  ;?>
                                                                     </th>
                                                                        <?php } ?>
                                                                </thead>
                                                                <tbody>
                                                                <?php $count = 1; 
                                                                    foreach ($medication as $medication_key => $medication_value){
                                                                      $pharmacy_id = $medication_value['pharmacy_id'];
                                                                      $medicine_category_id = $medication_value['medicine_category_id'];
                                                                      $date = $medication_value['date']; ?>
                                                                    <tr>
                                                                          <?php $subcount = 1; foreach ($medication_value['dosage'][$date] as $mkey => $mvalue) {
                                                                              $date = $this->customlib->YYYYMMDDTodateFormat($medication_value['date']); ?>
                                                                       <td class="hard_left">
                                                                        <?php if($subcount==1){ echo $date."<br>(".date('l', strtotime($medication_value['date'])).")"; 
                                                                              }else{ echo "<span class='fa-level-span'><i class='fa fa-level-up fa-level-roated' aria-hidden='true'></i></span>"; } ?>
                                                                       </td>
                                                                       <td class="next_left">
                                                                           <?php echo $mvalue['name'] ?>
                                                                       </td>
                                                                            <?php for ($x = 0; $x <= $dosage_count; $x++){
                                                                              if (array_key_exists($x,$mvalue['dose_list'])) {
                                                                                  $medicine_id = $mvalue['dose_list'][$x]['pharmacy_id'];
                                                                                  $medicine_category_id = $mvalue['dose_list'][$x]['medicine_category_id'];
                                                                                  $add_index= $x;
                                                                              if ($this->rbac->hasPrivilege('ipd_medication', 'can_edit')) {
                                                                                    $medication_edit = "<a href='#' class='btn btn-default btn-xs' data-toggle='tooltip' data-original-title='".$this->lang->line('edit')."' onclick='medicationDoseModal(" .$mvalue['dose_list'][$x]['id'].")'><i class='fa fa-pencil'></i></a>";
                                                                                    }else{
                                                                                    $medication_edit = "";
                                                                                    }
                                                                              if ($this->rbac->hasPrivilege('opd_medication', 'can_delete')) { 
                                                                                    $medication_delete = "<a  class='btn btn-default btn-xs delete_record_dosage' data-toggle='tooltip' data-original-title='".$this->lang->line('delete')."' data-record-id='".$mvalue['dose_list'][$x]['id']."'><i class='fa fa-trash'></i></a>"; 
                                                                                    }else{ $medication_delete = ""; }  ?>
                                                                          <td class="dosehover">
                                                                                <?php echo $this->lang->line('time').": ".date('h:i A',strtotime($mvalue['dose_list'][$x]['time']))."</a><span>".$medication_edit."</span><span>".$medication_delete."</span></br>". $mvalue['dose_list'][$x]['medicine_dosage']." ".$mvalue['dose_list'][$x]['unit']; if($mvalue['dose_list'][$x]['remark']!=''){ echo " <br>".$this->lang->line('remark').": ".$mvalue['dose_list'][$x]['remark'] ;}?>
                                                                          </td>
                                                                                <?php }else { ?>
                                                                          <td class="dosehover">
                                                                                <?php if($add_index+1== $x){ ?>
                                                                                    <?php if ($this->rbac->hasPrivilege('opd_medication', 'can_add')) {
                                                                                  if($is_discharge){ ?>
                                                                                  <a href="#" class="btn btn-sm btn-primary dropdown-toggle addmedication" onclick="medicationModal('<?php echo $medicine_category_id;?>','<?php echo $medicine_id ;?>','<?php echo $date;?>')" data-toggle='modal'>
                                                                                      <i class="fa fa-plus"></i>
                                                                                  </a>
                                                                                    <?php }} ?>
                                                                                <?php } ?>
                                                                            </td>
                                                                        <?php }?>
                                                                                <?php } ?>
                                                                    </tr>
                                                                    <?php $subcount++; }} ?>
                                                                </tbody>
                                                                    <?php }else{ ?>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="alert alert-danger">
                                                                                <?php echo $this->lang->line('no_record_found'); ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div><!---END--Medicamentos -->
                                            </div><!--END--TAB TABLAS PostOper.-->
                                        </div><!--END--Post Operatorio-->
                                        <!-- -----------------------Trans Operatorio----------------- --> 
                                        <div class="tab-pane tab-content-height" id="procedure_transoperatorio">
                                        <div class="box-tab-header">
                                            <h3 class="box-tab-title items_text" style="font-size:22px;">finalización del procedimiento</h3>
                                            <div class="box-tab-tools">
                                            </div>
                                        </div>
                                        <!-- -----------TAB TABLAS TransOper.---------- -->
                                        <div class="row">
                                            <!-- -------------TABAL COLOMNA 1------------------ -->
                                            <div id="read_history" class="col-lg-4 col-md-4col-sm-12 border-r">
                                                <div class="row">
                                                    <!-- -------------NOTAS DE ENFERMERIA----------- -->
                                                    <div class="col-lg-12 col-md-4 col-sm-12" style="overflow-y: scroll; height: 450px;">
                                                        <div class="box-tab-header mb-2"style="margin:20px;">
                                                            <h3 class="box-tab-title" style="color:#1563B0;">
                                                                <i class="fas fa-briefcase-medical" style='font-size:24px; color:#1563B0;'></i> 
                                                                <strong> Notas de enfermería</strong>
                                                            </h3>
                                                            <div class="box-tab-tools">
                                                                 <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background:#1563b0;color:#fff;border-radius:15px;" data-opdid="<?php echo $opdid; ?>" data-tab="Enfermeria">
                                                                    Registros de enfermería
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="timeline-header no-border pb1">
                                                            <hr> 
                                                            <div id="timeline_list">
                                                                <?php if (empty($Transoperatorio_nn)) { ?>
                                                                <?php } else { ?>
                                                                <ul class="timeline timeline-inverse">
                                                                    <?php for ($i=0; $i <$recent_record_count; $i++) { if (!empty($Transoperatorio_nn[$i])) { $id = $Transoperatorio_nn[$i]['id']; ?>
                                                                    <li class="time-label">
                                                                        <span class="bg-blue">
                                                                            <?php echo $this->customlib->YYYYMMDDHisTodateFormat($Transoperatorio_nn[$i]['date']); ?>
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <i class="fa fa-list-alt bg-blue"></i>
                                                                        <div class="timeline-item">
                                                                            <h3 class="timeline-header text-aqua"> 
                                                                                <?php echo $Transoperatorio_nn[$i]['name'].' '.$Transoperatorio_nn[$i]['surname']." ( ".$Transoperatorio_nn[$i]['employee_id']." )" ; ?>
                                                                            </h3>
                                                                            <div class="timeline-body">
                                                                                <?php echo $this->lang->line('note') ."</br>". nl2br($Transoperatorio_nn[$i]['note']); ?> 
                                                                            </div>
                                                                            <div class="timeline-body">
                                                                                <?php echo $this->lang->line('comment') ."</br> ". nl2br($Transoperatorio_nn[$i]['comment']); ?> 
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
                                                    </div><!--END--NOTAS DE ENFERMERIA -->
                                                </div>
                                            </div><!--END-SIG. VITALES-->
                                            <!-----SIG.VITALES------>
                                            <div class="col-lg-8 col-md-8 col-sm-12" style="overflow-y: scroll; height: 450px;">
                                                <div class="tab-content-height">
                                                    <div class="box-tab-header mb-2"style="margin-top:20px;">
                                                        <h3 class="box-tab-title" style="color:#1563B0;">
                                                            <i class="fas fa-file-medical-alt" style='font-size:24px; color:#1563B0;'></i>  
                                                            <strong> Notas de Signos vitales</strong>
                                                        </h3>
                                                        <div class="box-tab-tools">
                                                             <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background:#1563b0;color:#fff;border-radius:15px;" data-opdid="<?php echo $opdid; ?>" data-tab="Signos_Vitales_admision">
                                                                 Registros de signos vitales
                                                             </button>
                                                        </div>
                                                    </div>
                                                    <table class="table table-hover table-striped mt-5 mb-5" id="signos_vitales">
                                                        <thead>
                                                            <tr>
                                                                <th style="background:#00C9EF; color:#fff;">Fecha</th>
                                                                <th style="background:#00C9EF; color:#fff;">Tiempo</th>
                                                                <th style="background:#00C9EF; color:#fff;">Peso</th>
                                                                <th style="background:#00C9EF; color:#fff;">Talla</th>
                                                                <th style="background:#00C9EF; color:#fff;">Temperaturas</th>
                                                                <th style="background:#00C9EF; color:#fff;">Pres. Diastólica</th>
                                                                <th style="background:#00C9EF; color:#fff;">Pres. Sistólicaa</th>
                                                                <th style="background:#00C9EF; color:#fff;">Frec. Cardíaca</th>
                                                                <th style="background:#00C9EF; color:#fff;">Frec. Respiratoria</th>
                                                                <th style="background:#00C9EF; color:#fff;">Observaciones</th>
                                                                <th style="background:#00C9EF; color:#fff;">Acción</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <hr>
                                                            <?php foreach ($Transoperatorio_sv as $key =>$signos_vitales): ?>
                                                            <tr>
                                                                <td><?php echo $signos_vitales->date; ?></td>
                                                                <td><?php echo $signos_vitales->time; ?></td>
                                                                <td><?php echo $signos_vitales->peso; ?></td>
                                                                <td><?php echo $signos_vitales->talla; ?></td>
                                                                <td><?php echo $signos_vitales->temperatura; ?></td>
                                                                <td><?php echo $signos_vitales->presion_dia; ?></td>
                                                                <td><?php echo $signos_vitales->presion_sis; ?></td>
                                                                <td><?php echo $signos_vitales->frec_card; ?></td>
                                                                <td><?php echo $signos_vitales->frec_resp; ?></td>
                                                                <td><?php echo $signos_vitales->remark; ?></td>
                                                                <td>
                                                                    <input type="hidden" value="<?php echo $signos_vitales->id; ?>">
                                                                    <i class='fas fa-edit ml-2' style='font-size:18px;' onclick='ModalSignosVitales(<?php echo $signos_vitales->id; ?>)' style='font-size:22px; padding:2px;'  data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" title="Actualizar"></i>
                                                                    <i class="fa fa-trash delete_signos_vitales" data-id="<?php echo $signos_vitales->id; ?>" style='font-size:22px; padding:2px;' title="Eliminar"></i>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach ?>
                                                        </tbody>
                                                    </table>
                                                </div><!-- ---END-----TABLA DE SIG. VITALES------- -->    
                                            </div><!--END--VITALES-- -->
                                            <!------------------ADMICION--Medicamentos-------------------- -->
                                            <div class="col-lg-12 col-md-12 col-sm-12 mt-4" style="margin-top:10px;">
                                                <div class="box-tab-header mb-2"style="margin-top:40px;">
                                                    <h3 class="box-tab-title" style="color:#1563B0;">
                                                        <i class="fas fa-pills" style='font-size:24px;color:#1563B0;'></i>  
                                                        <strong> Notas Medicamentos</strong>
                                                    </h3>
                                                    <div class="box-tab-tools">
                                                         <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background:#1563b0;color:#fff;border-radius:15px;" data-opdid="<?php echo $opdid; ?>" data-tab="Medicamentos1">
                                                             Registros de medicamentos
                                                         </button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane tab-content-height" id="Medicamentos">
            <!--                                         <div class="box-tab-tools">
                                                        <a href="#" class="btn btn-sm btn-primary dropdown-toggle addmedication" onclick="addmedicationModal()" data-toggle="modal">
                                                            <i class="fa fa-plus"></i> Agregar dosis de medicamento
                                                        </a>
                                                    </div> -->
                                                    <div class="table_inner">
                                                        <table class="table table-striped table-bordered table-hover ajaxlist_med">
                                                            <?php if(!empty($medication)){ ?>
                                                            <thead>
                                                                <th class="hard_left">
                                                                  <?php echo $this->lang->line("date"); ?>
                                                                </th>
                                                                <th class="next_left">
                                                                  <?php echo $this->lang->line("medicine_name"); ?>
                                                                </th>
                                                                <?php if (!empty($max_dose)) { 
                                                                       $dosage_count = $max_dose;
                                                                       } else{
                                                                          $dosage_count = 0;
                                                                       }
                                                                   for ($x = 1; $x <= $dosage_count; $x++) { ?>
                                                                 <th class="sticky-col" width="150">
                                                                   <?php echo $this->lang->line("dose").''.$x  ;?>
                                                                 </th>
                                                                   <?php } ?>
                                                            </thead>
                                                            <tbody>
                                                            <?php $count = 1; 
                                                                foreach ($medication as $medication_key => $medication_value){
                                                                  $pharmacy_id = $medication_value['pharmacy_id'];
                                                                  $medicine_category_id = $medication_value['medicine_category_id'];
                                                                  $date = $medication_value['date']; ?>
                                                                <tr>
                                                                      <?php $subcount = 1; foreach ($medication_value['dosage'][$date] as $mkey => $mvalue) {
                                                                          $date = $this->customlib->YYYYMMDDTodateFormat($medication_value['date']); ?>
                                                                   <td class="hard_left">
                                                                    <?php if($subcount==1){ echo $date."<br>(".date('l', strtotime($medication_value['date'])).")"; 
                                                                          }else{ echo "<span class='fa-level-span'><i class='fa fa-level-up fa-level-roated' aria-hidden='true'></i></span>"; } ?>
                                                                   </td>
                                                                   <td class="next_left">
                                                                       <?php echo $mvalue['name'] ?>
                                                                   </td>
                                                                        <?php for ($x = 0; $x <= $dosage_count; $x++){
                                                                          if (array_key_exists($x,$mvalue['dose_list'])) {
                                                                              $medicine_id = $mvalue['dose_list'][$x]['pharmacy_id'];
                                                                              $medicine_category_id = $mvalue['dose_list'][$x]['medicine_category_id'];
                                                                              $add_index= $x;
                                                                          if ($this->rbac->hasPrivilege('ipd_medication', 'can_edit')) {
                                                                                $medication_edit = "<a href='#' class='btn btn-default btn-xs' data-toggle='tooltip' data-original-title='".$this->lang->line('edit')."' onclick='medicationDoseModal(" .$mvalue['dose_list'][$x]['id'].")'><i class='fa fa-pencil'></i></a>";
                                                                                }else{
                                                                                $medication_edit = "";
                                                                                }
                                                                          if ($this->rbac->hasPrivilege('opd_medication', 'can_delete')) { 
                                                                                $medication_delete = "<a  class='btn btn-default btn-xs delete_record_dosage' data-toggle='tooltip' data-original-title='".$this->lang->line('delete')."' data-record-id='".$mvalue['dose_list'][$x]['id']."'><i class='fa fa-trash'></i></a>"; 
                                                                                }else{ $medication_delete = ""; }  ?>
                                                                      <td class="dosehover">
                                                                            <?php echo $this->lang->line('time').": ".date('h:i A',strtotime($mvalue['dose_list'][$x]['time']))."</a><span>".$medication_edit."</span><span>".$medication_delete."</span></br>". $mvalue['dose_list'][$x]['medicine_dosage']." ".$mvalue['dose_list'][$x]['unit']; if($mvalue['dose_list'][$x]['remark']!=''){ echo " <br>".$this->lang->line('remark').": ".$mvalue['dose_list'][$x]['remark'] ;}?>
                                                                      </td>
                                                                            <?php }else { ?>
                                                                      <td class="dosehover">
                                                                            <?php if($add_index+1== $x){ ?>
                                                                                <?php if ($this->rbac->hasPrivilege('opd_medication', 'can_add')) {
                                                                              if($is_discharge){ ?>
                                                                              <a href="#" class="btn btn-sm btn-primary dropdown-toggle addmedication" onclick="medicationModal('<?php echo $medicine_category_id;?>','<?php echo $medicine_id ;?>','<?php echo $date;?>')" data-toggle='modal'>
                                                                                  <i class="fa fa-plus"></i>
                                                                              </a>
                                                                                <?php }} ?>
                                                                            <?php } ?>
                                                                        </td>
                                                                            <?php }?>
                                                                            <?php } ?>
                                                                </tr>
                                                                        <?php $subcount++; }} ?>
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
                                            </div><!---END--Medicamentos -->
                                        </div><!--END--TAB TABLAS TransOper.-->
                                    </div><!--END--Tran Operatorio-->
                                    </div>
                                </div>
                               </div>
                            </div>
                        </div>
                         <!-- ----------------Proc. Menores----------------------- -->
                        <div class="tab-pane tab-content-height" id="procedure_Menores">
                            <div class="row">
                                <div class="box-tab-header">
                                    <h3 class="box-tab-title" style="margin-left:10px;font-size:20px;">Procedimientos Menores</h3>
                                </div> 
                                <div id="read_history" class="col-lg-12 col-md-12 col-sm-12 border-r">
                                    <div class="box-header border-b mb10 pl-0" style="padding: 12px;">
                                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14" style="margin-right: 20px;">
                                          <?php echo $result['result']['patient_name'] ;?>
                                          <?php echo $result['result']['guardian_name'] ;?>
                                          <?php echo $result['result']['id'] ;?>
                                        </h3>
                                        <div class="pull-right">
                                          <a href="<?php echo base_url() ."admin/patient/profile/".$result['result']['patient_id'] ."/". $result['result']["id"] ?>" id="" class="btn btn-md revisitpatient" style="background:#1563B0; color:#fff;border-radius: 30px;" data-toggle="tooltip"
                                            title="Perfil">
                                              <i class="fas fa-arrow-circle-left"></i> Paciente
                                          </a>
                                        </div>
                                        <div class="pull-right">
                                            <div class="editviewdelete-icon pt8 text-center">
                                                <input type="hidden" id="result_opdid" name="" value="<?php echo $result['id'] ?>">
                                                <input type="hidden" id="result_pid" name="" value="<?php echo $result['patient_id'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                <!--./col-lg-7-->
                              </div>
                                  <div class="row">
                                      <div class="col-lg-12 col-md-12 col-sm-12">
                                          <p>
                                            <strong>
                                                <i class="fas fa-user-injured"></i> 
                                                Motivo del procedimiento
                                            </strong>
                                
                                                <ul>
                                                    <li>
                                                        <?= $doctor_app[0]->reason_consultation ?>
                                                    </li>
                                                </ul>
                                    
                                          </p>
                                       </div>
                                  </div>
                              </div>
                                <!--./col-lg-6-->
                                <div class="col-lg-12 col-md-12 col-sm-12">
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
                                        </div> 
                                       <div class="col-md-6">
                                            <div class="text-center text-light" style="margin.top:15px;">
                                               
                                                    <a href="#" class="btn btn-md" style="background:#1563B0; color:#fff; border-radius: 30px; margin-bottom:15px;" onclick="add_equipo('<?php echo $opdid; ?>', '<?php echo $id_visit ?>')" data-toggle="tooltip" data-original-title="Historia Clínica">
                                                        <i class="fa fa-group"></i>  
                                                        Equipo
                                                    </a>
                                               
                                            </div>                                                     
                                        </div> 
                                       
                                    </div>
                                    <!--./col-lg-5-->
                                    <div class="" style="margin:50px; margin-bottom:5px;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 " style="border:solid #1563b0 0.5px;border-radius:15px;padding:25px;">
                                            <?php if (!empty($DataAll)) { $operation = reset($DataAll);?>
                                            <div class=" col-12 pull-right">
                                                <input type="hidden" value="<?php echo $operation['id']; ?>">
                                                <i class="fas fa-edit ml-2" onclick="editot(<?php echo $operation['id']; ?>,<?php echo $operation_theatre['id']; ?> )" style='font-size:23px; padding:15px; color:#1563b0;' title="Actualizar"></i>
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
<!--                                             <p>
                                                <strong style=" color:#1563b0;">Vía: </strong>
                                                <?php// echo $operation['Via']; ?>
                                            </p> -->
                                            <p>
                                                <strong style=" color:#1563b0;">Lateralidad: </strong>
                                                <?php echo $operation['Laterality']; ?>
                                            </p>
                                            <p>
                                                <strong style=" color:#1563b0;">Anestesiólogo: </strong>
                                                <?php if (!empty($anestesiologo[0]->name)): ?>
                                                    <?php echo $anestesiologo[0]->name." ".$anestesiologo[0]->surname; ?>
                                                <?php else: ?>
                                                    <?php echo $operation['anesthetist']; ?>
                                                <?php endif; ?>
                                            </p>
                                            <p>
                                                <strong style=" color:#1563b0;">Descripción De Anestecia: </strong>
                                                <?php echo $operation['descrition_anaethesia']; ?>
                                            </p>
                                            <p>
                                                <strong style=" color:#1563b0;">Enfermero: </strong>
                                                <?php if (!empty($aux_enfermeria[0]->name)): ?>
                                                    <?php echo $aux_enfermeria[0]->name . " " . $aux_enfermeria[0]->surname; ?>
                                                <?php else: ?>
                                                    <?php echo $operation['ass_consultant_1']; ?>
                                                <?php endif; ?>
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
                                            <?php } else { echo "<p>No hay datos disponibles.</p>"; } ?>
                                        </div>
                                        <div class="" style="margin-bottom: 15px;padding: 3px;">
                                            <div class="content">
                                                <table class="table table-bordered table-striped mt-5 mb-5" id="diagnosticos2">
                                                    <thead>
                                                        <tr>
                                                            <th>Diagnóstico</th>
                                                            <th>Nombre de diagnostico</th>
                                                            <th>Nota Diagnóstico</th>
                                                            <th>Tipo de Diagnóstico</th>
                                                            <th>Categoría Diagnóstico</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <hr>
                                                        <?php foreach ($diagnosis as $key =>$DataDiagnosis): ?>
                                                        <tr>
                                                            <td><?php echo $DataDiagnosis->id_diagnosis; ?></td>
                                                            <td><?php echo $DataDiagnosis->nombre_diag; ?></td>
                                                            <td><?php echo $DataDiagnosis->nota_diag; ?></td>
                                                            <td><?php echo $DataDiagnosis->tipo_diag; ?></td>
                                                            <td><?php echo $DataDiagnosis->categoria_diag; ?></td>
                                                            <td>
                                                                <input type="hidden" value="<?php echo $DataDiagnosis->id_diagnosis; ?>">
                                                                <i class="fa fa-trash delete_diagnosticos" data-id="<?php echo $DataDiagnosis->id_diagnosis; ?>" style='font-size:22px; padding:2px;' title="Eliminar"></i>
                                                            </td>

                                                        </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!--./col-lg-6-->
                            </div><!--./row-->
                        </div><!--END-Proc. Menores-->
                    </div>
                 </div>
            </div>
        </div>
    </section>
</div>
<!-- -----------------MODA ALL TIS TAB----------------------- -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:1150px;">
        <div class="modal-content">
            <!-----------tab-------------- -->
            <div class="table_inner">
                <div class="col-md-12 itemcol">
                    <div class="nav-tabs-custom relative" style="margin:20px">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" id="Enfermeria-tab" data-toggle="tab" href="#Enfermeria" aria-controls="Enfermeria" aria-expanded="true">
                                    <i class="fas fa-notes-medical" style='font-size:15px;color:#1563B0;'></i> Notas de enfermería
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Signos_Vitales_admision-tab" data-toggle="tab" href="#Signos_Vitales_admision" aria-controls="Signos_Vitales_admision" aria-expanded="false">
                                    <i class="fas fa-heartbeat" style='font-size:15px;color:#1563B0;'></i> Signos Vitales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Medicamentos1-tab" data-toggle="tab" href="#Medicamentos1" aria-controls="Medicamentos1" aria-expanded="true">
                                    <i class="fas fa-pills" style='font-size:15px;color:#1563B0;'></i> Medicamentos
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content pt6" style="margin:10px;">
                            <!-- --Signos_Vitales--------- -->
                            <div class="tab-pane fade" id="Signos_Vitales_admision">
                                <!---------------Medidas Antropométrica------------------ -->    
                                <div class="row" style="margin: 0px;padding: 0px;">
                                    <form id="signos_form" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="surgery_id" value="<?php echo $opdid; ?>" id="">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="text-primary" style="font-size:15px;color:#1563B0;">Fase Operatoría<small class="req"> *</small> </label>
                                                <input type="hidden" id="">
                                                <select name="Fase_Operatoria" style="width: 100%" id="" class="form-control">
                                                    <option value="Admision">Admisión</option>
                                                    <option value="Transoperatorio">Transoperatorio</option>
                                                    <option value="Postoperatorio" >Postoperatorio</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row" style="display: flex;justify-content: center;">
                                        <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                            <b>Medidas Antropométricas</b>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <div class="form-group">
                                            <label>Fecha<small class="req"> *</small>
                                            </label> 
                                            <input type="text" name="date" value="" class="form-control datetime">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="pwd">Hora</label>
                                            <div class="bootstrap-timepicker"><div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a href="#" data-action="incrementHour"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" name="hour" class="bootstrap-timepicker-hour form-control" maxlength="2"></td> <td class="separator">:</td><td><input type="text" name="minute" class="bootstrap-timepicker-minute form-control" maxlength="2"></td> <td class="separator">&nbsp;</td><td><input type="text" name="meridian" class="bootstrap-timepicker-meridian form-control" maxlength="2"></td></tr><tr><td><a href="#" data-action="decrementHour"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div><div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a href="#" data-action="incrementHour"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" name="hour" class="bootstrap-timepicker-hour form-control" maxlength="2"></td> <td class="separator">:</td><td><input type="text" name="minute" class="bootstrap-timepicker-minute form-control" maxlength="2"></td> <td class="separator">&nbsp;</td><td><input type="text" name="meridian" class="bootstrap-timepicker-meridian form-control" maxlength="2"></td></tr><tr><td><a href="#" data-action="decrementHour"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" name="time" class="form-control timepicker" id="" value="" autocomplete="off">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
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
                                                        </span>
                                                        <input type="number" onchange="" style="border-radius: 0px 10px 10px 0px !important;" id="peso_custom" name="peso" class="form-control" value="" placeholder="">
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="col-2" style="margin-bottom:4px;">
                                                    <b><span> Kg </span></b>
                                                </div><span class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!----------------Signos Vitales------------------ -->
                                <div class="row" style="margin: 0px;padding: 0px;">
                                    <div class="row" style="display: flex;justify-content: center;">
                                        <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                            <b>Signos Vitales</b>
                                        </div>
                                    </div>
                                    <div class="row" style="display: flex;justify-content: center;align-items: end;">
                                        <div class="col-md-3">
                                            <div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                                                <div class="col-2">
                                                    <label for="custom_fields[opd][38]" class="control-label">
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
                                        <div class="col-md-3">
                                        <div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                                            <div class="col-2">
                                                <label for="custom_fields[opd][39]" class="control-label">
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
                                                </div>
                                                <span class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                                            <div class="col-2">
                                                <label for="custom_fields[opd][49]" class="control-label">
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
                                                            <input type="number" style="border-radius: 0px 10px 10px 0px !important;" name="temperatura" class="form-control" value="" placeholder="">
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
                                                <label for="custom_fields[opd][52]" class="control-label">
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
                                                            <input type="text" name="sat_oxi_sin" style="border-radius: 0px 10px 10px 0px !important;" class="form-control" value="" placeholder="">
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
                                                <label for="custom_fields[opd][54]" class="control-label">
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
                                                            <input type="text"  style="border-radius: 0px 10px 10px 0px !important;" name="sat_oxi_con" class="form-control" value="" placeholder="">
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
                                </div>
                            </div><!---END--Signos Vitales--- -->
                            <!----------------Presión Arterial------------------ -->
                            <div class="row" style="margin: 0px;padding: 0px;">
                                <div class="row" style="display: flex;justify-content: center;">
                                    <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                        <b>Presión Arterial</b>
                                    </div>
                                </div>
                                <div class="row" style="display: flex;justify-content: center;align-items: end;">
                                    <div class="col-md-3">
                                        <div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                                            <div class="col-2">
                                                <label for="custom_fields[opd][44]" class="control-label">
                                                    <b>Presión Arterial Sistólica </b>
                                                    <small class="req"> *</small>
                                                </label>
                                            </div>
                                            <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                                <div class="col-6" style="width: -webkit-fill-available;">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                            <i class="fa fa-heart" style="color:#337ab7;"></i>
                                                        </span><input type="number" style="border-radius: 0px 10px 10px 0px !important"; name="presi_sis" class="form-control " value="" placeholder="">
                                                    </div>
                                                </div>&nbsp;
                                                <div class="col-2" style="margin-bottom:4px;">
                                                    <b><span> mmHg </span></b>
                                                </div><span class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                                            <div class="col-2">
                                                <label for="custom_fields[opd][45]" class="control-label">
                                                    <b>Presión Arterial Diastólica </b>
                                                    <small class="req"> *</small>
                                                </label>
                                            </div>
                                            <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                                <div class="col-6" style="width: -webkit-fill-available;">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                            <i class="fa fa-heart" style="color:#337ab7;"></i>
                                                        </span><input type="number" style="border-radius: 0px 10px 10px 0px !important;"  id="" name="presi_dia" class="form-control " value="" placeholder="">
                                                    </div>
                                                </div>&nbsp;
                                                <div class="col-2" style="margin-bottom:4px;">
                                                    <b><span> mmHg </span></b>
                                                </div><span class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="margin: 18px 0px 21px 0px;font_size:15px;"><label for="custom_fields[opd][46]" class="control-label">Posición Presión Arterial</label><small class="req"> *</small>
                                            <div class="col-6" style="width: -webkit-fill-available;">
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                        <i class="fa fa-tint" style="color:#337ab7;font-size: 15px"> </i>
                                                    </span><select id="" style="border-radius: 0px 10px 10px 0px !important;" name="posi_pres" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <option id="causaExterna2" value="Sentado">Sentado</option>
                                                        <option id="causaExterna2" value=" Acostado boca arriba"> Acostado boca arriba</option>
                                                    </select><span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" style="margin: 18px 0px 21px 0px;font_size:15px;"><label for="" class="control-label">Lugar Presión Arterial</label><small class="req"> *</small>
                                            <div class="col-6" style="width: -webkit-fill-available;">
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                        <i class="fa fa-tint" style="color:#337ab7;font-size: 15px"> </i>
                                                    </span><select id="" style="border-radius: 0px 10px 10px 0px !important;" name="lugar_pres" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <option id="causaExterna2" value="Brazo derecho">Brazo derecho</option>
                                                        <option id="causaExterna2" value=" Brazo izquierdo"> Brazo izquierdo</option>
                                                    </select><span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--END--Presión Arterial-->
                                 <!----------Escala de clasificación Asa------------- -->
                                <div class="row" style="margin: 0px;padding: 0px;">
                                <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                    <b>Escala de clasificación Asa</b>
                                </div>
                                    <div class="">
                                      <div class="col-md-6">
                                          <div class="form-group" style="margin: 18px 0px 21px 0px;font_size:15px;"><label for="" class="control-label">Escala Asa</label><small class="req"> *</small>
                                              <div class="col-6" style="width: -webkit-fill-available;">
                                                  <div class="input-group">
                                                      <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                          <i class="fa fa-tint" style="color:#337ab7;font-size: 15px"> </i>
                                                      </span>
                                                      <select id="" style="border-radius: 0px 10px 10px 0px !important;" name="" class="form-control" autocomplete="off">
                                                          <option value="">Selecione</option>
                                                          <option id="" value="ASAI">ASA I - Paciente sano</option>
                                                          <option id="" value="ASAII"> ASA II - Paciente con enfermedad sistémica moderada</option>
                                                          <option id="" value="ASAIII">ASA III - Paciente con enfermedad sistémica severa </option>
                                                          <option id="" value="ASAIV"> ASA IV - Paciente con enfermedad sistémica severa</option>
                                                          <option id="" value="ASAV">ASA V - Paciente moribundo cuya supervivencia es nula si no se le realiza la cirugía</option>
                                                          <option id="" value="ASAVI"> ASA VI - Paciente declarado con muerte cerebral, soporte vital para procuración de organos</option>
                                                      </select>
                                                      <span class="text-danger"></span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div><!--END--Escala de clasificación Asa -->
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observaciones</label> 
                                        <textarea name="remark" id="remark" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                                <div class="row" style="margin: 0px;padding: 0px;">
                                <button type="submit" id="signos_addbtn" data-loading-text="Procesando..." class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> Guardar</button>
                            </div>
                        </form>    
                                </div><!--END--Signos_Vitales-->
                                <!------ADMICION--Medicamentos------ -->
                            <div class="tab-pane fade" id="Medicamentos1">
                                <div class="box-tab-tools">
<!--                                     <a href="#" class="btn btn-sm btn-primary dropdown-toggle addmedication" onclick="addmedicationModal()" data-toggle="modal">
                                        <i class="fa fa-plus"></i> Agregar dosis de medicamento
                                    </a> -->
                                </div>
                                <form id="add_medication" accept-charset="utf-8" method="post" class="ptt10">    
                                    <div class="scroll-area">
                                        <div class="modal-body pt0 pb0">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="text-primary" style="font-size:15px;color:#1563B0;">Fase Operatoría<small class="req"> *</small> </label>
                                                            <input type="hidden" id="" value="<?php echo $opdid; ?>">
                                                            <select name="Fase_Operatoria" style="width: 100%" id="" class="form-control">
                                                                <option value="Admision">Admisión</option>
                                                                <option value="Transoperatorio">Transoperatorio</option>
                                                                <option value="Postoperatorio" >Postoperatorio</option>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                                                        <input type="text" name="date" id="date" class="form-control date">
                                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                                        <input type="hidden" name="opdid" value="<?php echo $opdid ?>">
                                                    </div>
                                                </div> 
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pwd"><?php echo $this->lang->line("time"); ?></label>
                                                        <div class="bootstrap-timepicker">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text" name="time" class="form-control timepicker" id="mtime" value="<?php echo set_value('time'); ?>">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-clock-o"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger"><?php echo form_error('time'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">                       
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><?php echo $this->lang->line("medicine_category"); ?></label> <small class="req"> *</small>
                                                        <select class="form-control medicine_category_medication select2" style="width:100%" id="mmedicine_category_id" name='medicine_category_id'>
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
                                                    <select class="form-control select2 medicine_name_medication" style="width:100%"  id="mmedicine_id" name='medicine_name_id'>
                                                            <option value=""><?php echo $this->lang->line('select'); ?>
                                                                </option>
                                                            </select>
                                                        <span class="text-danger"><?php echo form_error('medicine_name_id'); ?></span>
                                                    </div>
                                                </div> 
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><?php echo $this->lang->line("dosage"); ?></label> <small class="req"> *</small>
                                                    <select class="form-control select2 dosage_medication" style="width:100%"  id="dosage" onchange="get_dosagename(this.value)" name='dosage'>
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
                                                        <textarea  name="remark" id="remark" class="form-control"></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="modal-footer">
                                        <button type="submit" id="add_medicationbtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                                    </div>  
                                </form> 
                            </div><!--END-ADMICION-Medicamentos-->
                            <!--------Enfermeria------ -->
                            <div class="tab-pane fade" id="Enfermeria">
                                <div class="box-tab-header">
                                    <h3 class="box-tab-title"> Notas de enfermería</h3>
<!--                                 <div class="box-tab-tools">
                                    <a href="#" class="btn btn-sm btn-primary dropdown-toggle addnursenote" onclick="holdModal('add_nurse_note')" data-toggle="modal"><i class="fas fa-plus"></i> Agregar nota de enfermera</a>
                                </div> -->
                                   <form id="nurse_note_form" accept-charset="utf-8" enctype="multipart/form-data" method="post">   
                                        <div class="scroll-area">
                                            <div class="modal-body pb0 ptt10">
                                                  <input type="hidden" name="procedure_id" value="<?php echo $opdid; ?>">
                                                  <div class="col-12">
                                                      <div class="form-group">
                                                          <div class="form-group">
                                                              <label class="text-primary" style="font-size:15px;color:#1563B0;">Fase Operatoría<small class="req"> *</small> </label>
                                                              <input type="hidden" id="">
                                                              <select name="Fase_Operatoria" style="width: 100%" id="" class="form-control">
                                                                  <option value="Admision">Admisión</option>
                                                                  <option value="Transoperatorio">Transoperatorio</option>
                                                                  <option value="Postoperatorio" >Postoperatorio</option>
                                                              </select>
                                                          </div> 
                                                      </div>
                                                  </div>
                                                  <div class="row">
                                                      <div class="col-sm-6">
                                                          <div class="form-group">
                                                              <label><?php echo $this->lang->line('date'); ?>
                                                              <small class="req"> *</small>
                                                              </label> 
                                                              <input type="text" name="date" value="" class="form-control datetime">
                                                          </div>
                                                      </div>
                                                      <div class="col-sm-6">
                                                          <div class="form-group">
                                                              <label><?php echo $this->lang->line('nurse'); ?><small class="req"> *</small> </label>
                                                          <input type="hidden" name="nurse" id="nurse_set">
                                                              <select name="nurse_field" <?php 
                                                              if ($disable_option == true) { echo "disabled"; } ?> style="width: 100%" id="nurse_field" class="form-control select2">
                                                                  <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                                  <?php foreach ($nurse as $key => $value) { ?>
                                                                  <option  <?php if ((isset($nurse_select)) && ($nurse_select == $dvalue["id"])) { echo "selected"; } ?> value="<?php echo $value["id"] ?>"><?php echo composeStaffNameByString($value["name"],$value["surname"],$value["employee_id"]); ?></option>
                                                                  <?php } ?>
                                                              </select>
                                                          </div> 
                                                      </div>
                                                      <div class="col-sm-12">
                                                          <div class="form-group">
                                                              <label><?php echo $this->lang->line('note') ?> <small class="req"> *</small> </label>
                                                              <textarea name="note" style="height:50px" class="form-control"></textarea>
                                                          </div> 
                                                      </div>
                                                      <div class="col-sm-12">
                                                          <div class="form-group">
                                                              <label><?php echo $this->lang->line('comment'); ?> <small class="req"> *</small> </label>
                                                              <textarea name="comment" style="height:50px" class="form-control"></textarea>
                                                          </div> 
                                                      </div>

                                                      <div class="">
                                                          <?php echo display_custom_fields('ipdnursenote'); ?>
                                                      </div>
                                                  </div>
                                            </div>
                                        </div>    
                                        <div class="modal-footer">    
                                            <button type="submit" id="nurse_notebtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                                        </div>  
                                    </form>
                                </div>
                            </div><!--END--Enfermeria-->
                        </div>
                    </div><!--end--tab-->
                </div>
            </div><!--END--MODA ALL TIS TAB -->
        </div>
    </div>
</div><!--END--MODA ALL TIS TAB -->
<!-- --------------modalActualizarsigVItales--------------------- -->
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog container-xl mt-5" role="document">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-media-header">
                    <button type="button" class="close close_button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Formulario de signos Vitales </h4> 
                </div>
                <div class="modal-body">
                <!---------------------INPUT-------------------------------- -->
                <!---------------Medidas Antropométrica------------------ -->    
                <div class="row" style="margin: 0px;padding: 0px;">
                    <form id="signos_form_update" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="updatasurgery_id" id="SigVi_Id" value="">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="text-primary" style="font-size:15px;color:#1563B0;">Fase Operatoría<small class="req"> *</small> </label>
                                    <input type="hidden" id="">
                                    <select name="updataFaseOperatoria" id="SigVi_FaseOperatoria" style="width: 100%" class="form-control">
                                        <option value="Admision">Admisión</option>
                                        <option value="Transoperatorio">Transoperatorio</option>
                                        <option value="Postoperatorio">Postoperatorio</option>
                                    </select>
                                </div> 
                            </div>
                        </div>
                        <div class="row" style="display: flex;justify-content: center;">
                            <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                <b>Medidas Antropométricas</b>
                            </div>
                        </div>
                      <div class="col-sm-3 col-md-3">
                          <div class="form-group">
                              <label>Fecha<small class="req"> *</small>
                              </label> 
                              <input type="text" name="updatadate" id="SigVi_Date" value="" class="form-control datetime">
                          </div>
                      </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pwd">Hora</label>
                                <div class="bootstrap-timepicker"><div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a href="#" data-action="incrementHour"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" name="hour" class="bootstrap-timepicker-hour form-control" maxlength="2"></td> <td class="separator">:</td><td><input type="text" name="minute" class="bootstrap-timepicker-minute form-control" maxlength="2"></td> <td class="separator">&nbsp;</td><td><input type="text" name="meridian" class="bootstrap-timepicker-meridian form-control" maxlength="2"></td></tr><tr><td><a href="#" data-action="decrementHour"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div><div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a href="#" data-action="incrementHour"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><input type="text" name="hour" class="bootstrap-timepicker-hour form-control" maxlength="2"></td> <td class="separator">:</td><td><input type="text" name="minute" class="bootstrap-timepicker-minute form-control" maxlength="2"></td> <td class="separator">&nbsp;</td><td><input type="text" name="meridian" class="bootstrap-timepicker-meridian form-control" maxlength="2"></td></tr><tr><td><a href="#" data-action="decrementHour"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="updatatime" id="SigVi_Time" class="form-control timepicker" id="" value="" autocomplete="off">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                                                <input type="number" style="border-radius: 0px 10px 10px 0px !important;" onchange="" id="SigVi_Talla" name="updatatalla" class="form-control" value="" placeholder="">
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
                        <div class="col-md-3">
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
                                            </span>
                                            <input type="number" onchange="" style="border-radius: 0px 10px 10px 0px !important;" id="SigVi_Peso" name="updatapeso" class="form-control" value="" placeholder="">
                                        </div>
                                    </div>
                                    &nbsp;
                                    <div class="col-2" style="margin-bottom:4px;">
                                        <b><span> Kg </span></b>
                                    </div><span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----------------Signos Vitales------------------ -->
                    <div class="row" style="margin: 0px;padding: 0px;">
                        <div class="row" style="display: flex;justify-content: center;">
                            <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                <b>Signos Vitales</b>
                            </div>
                        </div>
                        <div class="row" style="display: flex;justify-content: center;align-items: end;">
                            <div class="col-md-3">
                                <div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                                    <div class="col-2">
                                        <label for="custom_fields[opd][38]" class="control-label">
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
                                                    <input type="number" style="border-radius: 0px 10px 10px 0px !important;" name="updatafrec_card" id="SigVi_Frec_card" class="form-control" value="" placeholder="">
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
                            <div class="col-md-3">
                                <div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                                    <div class="col-2">
                                        <label for="custom_fields[opd][39]" class="control-label">
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
                                                    <input type="number" id="SigVi_Frec_resp" name="updatafrec_res" style="border-radius: 0px 10px 10px 0px !important;" class="form-control" value="" placeholder="">
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
                            <div class="col-md-2">
                                <div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                                    <div class="col-2">
                                        <label for="custom_fields[opd][49]" class="control-label">
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
                                                    <input type="number" style="border-radius: 0px 10px 10px 0px !important;" name="updatatemperatura" id="SigVi_temperatura" class="form-control" value="" placeholder="">
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
                                        <label for="custom_fields[opd][52]" class="control-label">
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
                                                    <input type="text" id="SigVi_sat_oxi_sin" name="updatasat_oxi_sin" style="border-radius: 0px 10px 10px 0px !important;" class="form-control" value="" placeholder="">
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
                                        <label for="custom_fields[opd][54]" class="control-label">
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
                                                    <input type="text"  style="border-radius: 0px 10px 10px 0px !important;" name="updatasat_oxi_con" id="SigVi_Sat_oxi_con" class="form-control" value="" placeholder="">
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
                        </div>
                    </div><!---END--Signos Vitales--- -->
                    <!----------------Presión Arterial------------------ -->
                    <div class="row" style="margin: 0px;padding: 0px;">
                        <div class="row" style="display: flex;justify-content: center;">
                            <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                <b>Presión Arterial</b>
                            </div>
                        </div>
                        <div class="row" style="display: flex;justify-content: center;align-items: end;">
                            <div class="col-md-3">
                                <div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                                    <div class="col-2">
                                        <label for="custom_fields[opd][44]" class="control-label">
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
                                                <input type="number" style="border-radius: 0px 10px 10px 0px !important"; name="updatapresi_sis" id="SigVi_presion_sis" class="form-control " value="" placeholder="">
                                            </div>
                                        </div>&nbsp;
                                        <div class="col-2" style="margin-bottom:4px;">
                                            <b><span> mmHg </span></b>
                                        </div><span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                                    <div class="col-2">
                                        <label for="custom_fields[opd][45]" class="control-label">
                                            <b>Presión Arterial Diastólica </b>
                                            <small class="req"> *</small>
                                        </label>
                                    </div>
                                    <div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">
                                        <div class="col-6" style="width: -webkit-fill-available;">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                    <i class="fa fa-heart" style="color:#337ab7;"></i>
                                                </span><input type="number" style="border-radius: 0px 10px 10px 0px !important;"  id="SigVi_presion_dia" name="updatapresi_dia" class="form-control " value="" placeholder="">
                                            </div>
                                        </div>&nbsp;
                                        <div class="col-2" style="margin-bottom:4px;">
                                            <b><span> mmHg </span></b>
                                        </div><span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" style="margin: 18px 0px 21px 0px;font_size:15px;"><label for="custom_fields[opd][46]" class="control-label">Posición Presión Arterial</label><small class="req"> *</small>
                                    <div class="col-6" style="width: -webkit-fill-available;">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                <i class="fa fa-tint" style="color:#337ab7;font-size: 15px"> </i>
                                            </span><select id="" style="border-radius: 0px 10px 10px 0px !important;" name="updataposi_pres" class="form-control">
                                                <option value="">Selecione</option>
                                                <option id="causaExterna2" value="Sentado">Sentado</option>
                                                <option id="causaExterna2" value=" Acostado boca arriba"> Acostado boca arriba</option>
                                            </select><span class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" style="margin: 18px 0px 21px 0px;font_size:15px;"><label for="" class="control-label">Lugar Presión Arterial</label><small class="req"> *</small>
                                    <div class="col-6" style="width: -webkit-fill-available;">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                <i class="fa fa-tint" style="color:#337ab7;font-size: 15px"> </i>
                                            </span><select id="" style="border-radius: 0px 10px 10px 0px !important;" name="updatalugar_pres" class="form-control">
                                                <option value="">Selecione</option>
                                                <option id="causaExterna2" value="Brazo derecho">Brazo derecho</option>
                                                <option id="causaExterna2" value=" Brazo izquierdo"> Brazo izquierdo</option>
                                            </select><span class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           </div>
                          </div><!--END--Presión Arterial-->
                          <!----------Escala de clasificación Asa------------- -->
                          <div class="row" style="margin: 0px;padding: 0px;">
                              <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                  <b>Escala de clasificación Asa</b>
                              </div>
                              <div class="">
                                  <div class="col-md-6">
                                      <div class="form-group" style="margin: 18px 0px 21px 0px;font_size:15px;"><label for="" class="control-label">Escala Asa</label><small class="req"> *</small>
                                          <div class="col-6" style="width: -webkit-fill-available;">
                                              <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                      <i class="fa fa-tint" style="color:#337ab7;font-size: 15px"> </i>
                                                  </span>
                                                  <select id="" style="border-radius: 0px 10px 10px 0px !important;" name="" class="form-control" autocomplete="off">
                                                      <option value="">Selecione</option>
                                                      <option id="" value="ASAI">ASA I - Paciente sano</option>
                                                      <option id="" value="ASAII"> ASA II - Paciente con enfermedad sistémica moderada</option>
                                                      <option id="" value="ASAIII">ASA III - Paciente con enfermedad sistémica severa </option>
                                                      <option id="" value="ASAIV"> ASA IV - Paciente con enfermedad sistémica severa</option>
                                                      <option id="" value="ASAV">ASA V - Paciente moribundo cuya supervivencia es nula si no se le realiza la cirugía</option>
                                                      <option id="" value="ASAVI"> ASA VI - Paciente declarado con muerte cerebral, soporte vital para procuración de organos</option>
                                                  </select>
                                                  <span class="text-danger"></span>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div><!--END--Escala de clasificación Asa -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Observaciones</label> 
                                    <textarea name="remark" id="SigVi_remark" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 0px;padding: 0px;">
                            <button type="submit" id="signos_form_updatebtn" data-loading-text="Procesando..." class="btn btn-info pull-right" style="background:#337ab7;border-radius:7px;colo:#fff;">
                                <strong><i class="fa fa-check-circle"></i> Guardar</strong>
                            </button>
                        </div>
                    </form> <!----END-INPUT----- -->   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background:#337ab7;border-radius:7px;color:#fff;">
                        <strong>Cerrar</strong>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div><!-----end--modalActualizarsigVItales-- -->
<!--------------modalNotasOperacion--------------------------->
<div class="modal fade modalNotasOperacion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="">
  <div class="modal-dialog" style="width: 1300px;" >
    <div class="modal-content">
        <div class="modal-header modal-media-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Notas de Procedimientos</h4> 
        </div>
        <div class="modal-body ">
            <div class="row" style="padding-left:150px;">
                <!--./col-lg-5-->
                <?php foreach ($operation_theatre as $key =>$ope_theatre): ?>
                <div class="col-lg-3 col-md-3 col-sm-3 " style="border: solid 0.5px #1563b0; border-radius:15px; margin:10px; padding:5px; margin-left:90;">
                    <ul>
                        <li class="">
                            <div class=" col-12 pull-right">
                                <input type="hidden" value="<?php echo $ope_theatre['id']; ?>">
                                <i class="fas fa-edit ml-2" onclick="editot(<?php echo $ope_theatre['id']; ?>)" style='font-size:23px; padding:2px; color:#1563b0;' title="Actualizar"></i>
                                <i class="fa fa-trash delete_signos_vitales" data-id="<?php echo $ope_theatre['id']; ?>" style='font-size:25px; padding:2px; color:#1563b0;' title="Eliminar"></i>
                            </div>
                            <p><strong>Nº:</strong><?php echo $ope_theatre['id']; ?></p>
                            <p><strong>Fecha: </strong><?php echo $ope_theatre['date']; ?></p>
                            <p><strong>Tipo de operación: </strong><?php echo $ope_theatre['operation_type']; ?></p>
                            <p><strong>Via: </strong><?php echo $ope_theatre['Via']; ?></p>
                            <p><strong>Lateralida: </strong><?php echo $ope_theatre['Laterality']; ?></p>
                            <p><strong>Anestesiólogo: </strong>
                                <?php if ($ope_theatre['anesthetist'] == "" || $ope_theatre['anesthetist'] == null): ?>
                                    No aplica.</p>
                                <?php else: ?>
                                    <?php echo $ope_theatre['anesthetist']; ?>.</p>
                                <?php endif; ?>
                            <p><strong>Descripción De Anestecia: </strong><?php echo $ope_theatre['descrition_anaethesia']; ?></p>
                            <p><strong>Enfermero: </strong><?php echo $ope_theatre['ass_consultant_1']; ?></p>
                            <p><strong>Descripción procedimiento: </strong><?php echo $ope_theatre['remark']; ?></p>
                            <p><strong>sugerencias y conclusiones: </strong><?php echo $ope_theatre['Surgery_conclusions']; ?></p>
                            <p><strong>resultado: </strong><?php echo $ope_theatre['result']; ?></p>
                       </li>
                    </ul>
                </div>
                <?php endforeach ?>
            </div>  
        </div>
    </div>
  </div>
</div><!--END-modalNotasOperacion-->
<!--------------edit_operationtheatre--------------------------->
<div class="modal fade " id="edit_operationtheatre" role="dialog" aria-labelledby="myModalLabel" style="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editra Procedimientos</h4> 
            </div>
           <form id="form_editoperationtheatre" accept-charset="utf-8" enctype="multipart/form-data" method="post" class="ptt10" onsubmit="return validarFormulario();">    
            <div class="scroll-area"> 
                <div class="modal-body pt0 pb0">
                    <div class="row">
                        <input type="" value="<?php echo $operation_theatre['id']; ?>" name="opdid" class="form-control" id="opdid" /> 
                        <input type="" value="" name="otid" class="form-control" id="otid" /> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('operation_date'); ?></label>
                                <small class="req"> *</small> 
                                <input type="text" value="" id="edate" name="OperTheatredate" class="form-control datetime">
                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Cirugía</label>
                                <div class="input-group">
                                    <input type="text" id="procedure_name" name="OperTheatrename" value="<?php echo $doctor_app[0]->procedure_name ?>" class="form-control" placeholder="Cirugía" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;" readonly>
                                    <div class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;">
                                       <i class="fa fa-group"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!----END---- -->
                        <div class="col-sm-6">
                            <hr>
                              <div class="form-group">
                                  <div class="form-group">
                                        <label class="" style="">Lateralidad<small class="req"> *</small> </label>
                                        <input type="hidden" id="">
                                        <select name="OperTheatreLateralidad" id="Laterality" style="width: 100%" class="form-control">
                                            <option value="No_aplica">No aplica</option>
                                            <option value="Izquierdo">Izquierdo</option>
                                            <option value="Derecho">Derecho</option>
                                            <option value="Bilateral">Bilateral</option>
                                        </select>
                                    </div>
                              </div>
                            <hr>
                        </div><!----END---- -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputFile">
                                    <?php echo $this->lang->line('consultant_doctor'); ?>
                                </label> <small class="req"> *</small> 
                                <select id="doctor_id"  name="OperTheatrEspecialist" class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true">
                                           <?php if ($result['result']['name'] == ''): ?>
                                                 <option value="No_aplica">No aplica</option>
                                           <?php else: ?>
                                                 <option value="<?= $doctor_app[0]->doctor?>" hidden>
                                                    <?php echo $result['result']['name'] ?> <?php echo $result['result']['surname'] ?>
                                                 </option>
                                           <?php endif; ?>
                                       
                                           <?php foreach ($doctors as $key => $value): ?>
                                       <option  value="<?= $value['id'] ?>">
                                           <p class="capitalize">
                                               <?php echo ucwords(strtolower($value["name"] . " " . $value["surname"] ." (". $value["employee_id"].")")) ?>
                                           </p>
                                       </option> 
                                           <?php endforeach ?>
                                   </select>
                                <span class="text-danger"><?php echo form_error('consultant_doctor'); ?></span>
                            </div>
                        </div><!----END---- -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('anesthetist'); ?><small class="req"> *</small> </label>
                                    <input type="hidden" id="">
                                    <select name="OperTheatraAnestesiologo" id="Anestesiologo" <?php if ($disable_option == true) { echo "disabled"; } ?> style="width: 100%" class="form-control select2">
                                        <option value=""><?php echo $anestesiologo[0]->name." ".$anestesiologo[0]->surname; ?></option>
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
                       <!-------- -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Auxiliar de enfermeria<small class="req"> *</small> </label>
                                    <input type="hidden" id="nurse_set">
                                    <select name="OperTheatraNurse" id="NurseOpe" <?php if ($disable_option == true) { echo "disabled"; } ?> style="width: 100%" class="form-control select2">
                                        <option value="" ><?php echo $aux_enfermeria[0]->name." ".$aux_enfermeria[0]->surname; ?></option>
                                        <option value="" ><?php echo $this->lang->line('select'); ?></option>
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
                                <label><?php echo $this->lang->line('result'); ?></label>
                                <textarea name="OperTheatraResult" id="desc_result" class="form-control"></textarea>
                            </div>
                        </div><!----END---- -->
                        <!---Des. de procedimiento- -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Descripción de procedimiento</label>
                                <textarea name="OperTheatraDesProcedimiento" id="desc_remark" class="form-control"></textarea>
                            </div>
                        </div><!----END Anestecia-- -->
                        <!---Des. de procedimiento- -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Descripción de Anestesia</label>
                                <textarea name="OperTheatraDesAnestecia" id="desc_anaethesia" class="form-control"></textarea>
                            </div>
                        </div><!----END Des. Anesteciao--- -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Conclusiones y sugerencias</label>
                                <textarea name="OperTheatraConclusionoesSugerencias" id="Surg_conclusions" class="form-control"></textarea>
                            </div>
                        </div><!----END Des. Anesteciao--- -->
                        <div class="">
                            <?php echo display_custom_fields('operationtheatre'); ?>
                        </div>
                        <div id="custom_field_ot">
                        </div>
                   </div>
                </div>
              </div><!-- scroll-area -->
              <div class="modal-footer">
                  <div class="pull-right">
                      <button type="submit" id="form_editoperationtheatrebtn" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                 </div>
              </div>
            </form>
        </div>
    </div> 
</div><!--END-edit_operationtheatre-->
<!--------------edit_operationtheatreSmalll--------------------------->
<div class="modal fade " id="edit_operationtheatreSmalll" role="dialog" aria-labelledby="myModalLabel" style="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line("edit_operation"); ?></h4> 
            </div>
           <form id="form_editoperationtheatreSmall" accept-charset="utf-8" enctype="multipart/form-data" method="post" class="ptt10" onsubmit="return validarFormulario();">    
            <div class="scroll-area"> 
                <div class="modal-body pt0 pb0">
                    <div class="row">
                        <input type="hidden" value="<?php echo $ipdid ?>" name="opdid" class="form-control" id="opdid" /> 
                        <input type="hidden" value="idOperTheatre" name="otid" class="form-control" id="otidSm" /> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('operation_date'); ?></label>
                                <small class="req"> *</small> 
                                <input type="text" value="" id="edateSm" name="OperTheatredate" class="form-control datetime">
                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputFile">
                                    <?php echo $this->lang->line('consultant_doctor'); ?>
                                </label> <small class="req"> *</small> 
                                <select id="doctor_id"  name="OperTheatrEspecialist" class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true">
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
                                <span class="text-danger"><?php echo form_error('consultant_doctor'); ?></span>
                            </div>
                        </div><!----END---- --> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('result'); ?></label>
                                <textarea name="OperTheatraResult" id="desc_resultSm" class="form-control"></textarea>
                            </div>
                        </div><!----END---- -->
                        <!---Des. de procedimiento- -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Descripción de procedimiento</label>
                                <textarea name="OperTheatraDesProcedimiento" id="desc_remarkSm" class="form-control"></textarea>
                            </div>
                        </div><!----END Anestecia-- -->
                        <!---Des. de procedimiento- -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Descripción de Anestesia</label>
                                <textarea name="OperTheatraDesAnestecia" id="desc_anaethesiaSm" class="form-control"></textarea>
                            </div>
                        </div><!----END Des. Anesteciao--- -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Conclusiones y sugerencias</label>
                                <textarea name="OperTheatraConclusionoesSugerencias" id="Surg_conclusionsSm" class="form-control"></textarea>
                            </div>
                        </div><!----END Des. Anesteciao--- -->
                        <div class="">
                            <?php echo display_custom_fields('operationtheatre'); ?>
                        </div>
                        <div id="custom_field_ot">
                        </div>
                   </div>
                </div>
              </div><!-- scroll-area -->
              <div class="modal-footer">
                  <div class="pull-right">
                      <button type="submit" id="form_editoperationtheatreSmallbtn" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                 </div>
              </div>
            </form>
        </div>
    </div> 
</div><!--END-edit_operationtheatreSmalll-->

<?php $this->load->view('admin/patient/procedures/notas_enfermeria') ?>    
<?php $this->load->view('admin/patient/procedures/dosis_medicamentos') ?> 
<?php $this->load->view('admin/patient/procedures/equipo_modal') ?> 

<script>
  
        // Escucha el evento clic en los botones
    document.querySelectorAll('.btn').forEach(function(button) {
        button.addEventListener('click', function() {
            // Obtiene el atributo 'data-tab' del botón clicado
            var tabName = this.getAttribute('data-tab');

            // Activa la pestaña correspondiente en el modal
            $('.modal .nav-tabs a#'+ tabName +'-tab').tab('show');
        });
    });
  
//  ------------------edit operatopn all-------------------------------------------
 function editot($opdid) {
          var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $.ajax({
            url: '<?php echo base_url(); ?>admin/operationtheatre/getotDetails',
            type: "POST",
            data: {id: $opdid},
            dataType: 'json',
            success: function (data) {
               console.log(data);
                $("#otid").val(data.id);
                $("#edate").val(data.otdate);
                $("#id_ope_type").val(data.operation_type);
                $("#eass_consultant_2").val(data.ass_consultant_2);

                var nurseValue = data.ass_consultant_1;
                $("#NurseOpe").val(nurseValue);
               
                var viaValue = data.Via;
                $("#Via").val(viaValue);
                
                var LateralityValue = data.Laterality;
                $("#Laterality").val(LateralityValue);
                
                var Anestesiologo = data.anesthetist;
                $("#Anestesiologo").val(Anestesiologo);
                
                $("#eanaethesia_type").val(data.anaethesia_type);Anestesiologo
                $("#eot_technician").val(data.ot_technician);
                $("#desc_result").val(data.result);
                $("#desc_remark").val(data.remark);
                $("#desc_anaethesia").val(data.descrition_anaethesia);
                $("#Surg_conclusions").val(data.Surgery_conclusions);
                $("#eot_assistant").val(data.ot_assistant);
                $("#custom_field_ot").html(data.custom_fields_value);
                $("#edit_operationtheatre #econsultant_doctorid").select2().select2('val', data.consultant_doctor);
                $("#edit_operationtheatre #eoperation_name").select2().select2('val', data.operation_id);
                
                holdModal('edit_operationtheatre');
            },
        });
    }
//  -----------------END-edit operatopn all-------------------------------------------
    
//  ------------------edit operatopn small-------------------------------------------
 function editotSmall($opdid) {
          var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $.ajax({
            url: '<?php echo base_url(); ?>admin/operationtheatre/getotDetails',
            type: "POST",
            data: {id: $opdid},
            dataType: 'json',
            success: function (data) {
//                console.log(data);
                $("#otidSm").val(data.id);
                $("#edateSm").val(data.otdate);
                $("#id_ope_typeSm").val(data.operation_type);
                $("#eass_consultant_2Sm").val(data.ass_consultant_2);
                
                $("#eanaethesia_typeSm").val(data.anaethesia_type);Anestesiologo
                $("#eot_technicianSm").val(data.ot_technician);
                $("#desc_resultSm").val(data.result);
                $("#desc_remarkSm").val(data.remark);
                $("#desc_anaethesiaSm").val(data.descrition_anaethesia);
                $("#Surg_conclusionsSm").val(data.Surgery_conclusions);
                $("#eot_assistantSm").val(data.ot_assistant);
                $("#custom_field_otSm").html(data.custom_fields_value);
                $("#edit_operationtheatreSmalll #econsultant_doctorid").select2().select2('val', data.consultant_doctor);
                $("#edit_operationtheatreSmalll #eoperation_name").select2().select2('val', data.operation_id);
                
                holdModal('edit_operationtheatreSmalll');
            },
        });
    }
//  -----------------END-edit operatopn small-------------------------------------------
  
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
  
  
     function addmedicationModal() {        
        holdModal('myaddMedicationModal');
    } 
    
 //------------- updata_operation_theatre --------------------------
         $(document).ready(function (e) {
            $("#form_editoperationtheatre").on('submit', (function (e) {
//                 e.preventDefault();
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/Procedimientos/updata_operation_theatre',
                    type: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if (data.status == "fail") {
                            var message = "";
                            $.each(data.error, function (index, value) {

                                message += value;
                            });
                            errorMsg(message);
                        } else {
                           $('#form_editoperationtheatre')[0].reset();
                          $('#exampleModal').modal('hide');
                           successMsg(data.message);
                          $('#Signos_Vitales_admision').load(location.href + ' #Signos_Vitales_admision'); 
    //                         window.location.reload(true);

                        }
                        $("#form_editoperationtheatrebtn").button('reset');

                    },
                    error: function () {

                    }
                });


            }));
        });
//-------end-updata_operation_theatre-------
//------------- updata_operation_theatre small--------------------------
         $(document).ready(function (e) {
            $("#form_editoperationtheatreSmall").on('submit', (function (e) {
//                 e.preventDefault();
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/Procedimientos/updata_operation_theatre',
                    type: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if (data.status == "fail") {
                            var message = "";
                            $.each(data.error, function (index, value) {

                                message += value;
                            });
                            errorMsg(message);
                        } else {
                           $('#form_editoperationtheatreSmall')[0].reset();
                          $('#exampleModal').modal('hide');
                           successMsg(data.message);
                          $('#procedure_Menores').load(location.href + ' #procedure_Menores'); 
    //                         window.location.reload(true);

                        }
                        $("#form_editoperationtheatreSmallbtn").button('reset');

                    },
                    error: function () {

                    }
                });


            }));
        });
//-------end-updata_operation_theatre small-------   
    
//------------- insert form --------------------------
           $(document).ready(function (e) {
            $("#signos_form").on('submit', (function (e) {
    //             var nurse_id = $("#nurse_field").val();
    //             $("#nurse_set").val(nurse_id);
    //             $("#signos_addbtn").button('loading');
//                 e.preventDefault();
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/surgery/add_signos_vitales',
                    type: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log(data)
                        if (data.status == "fail") {
                            var message = "";
                            $.each(data.error, function (index, value) {

                                message += value;
                            });
                            errorMsg(message);
                        } else {
                           $('#signos_form')[0].reset();
                           $('#Signos_Vitales_admision').load(location.href + ' #Signos_Vitales_admision'); 
                           successMsg(data.message);
                            window.location.reload(true);
                        }
                        $("#nurse_notebtn").button('reset');

                    },
                    error: function () {

                    }
                });
            }));
        });
//-------end------ insert form -------
  
    function ModalSignosVitales(id) {
      $.ajax({
          url: '<?php echo base_url(); ?>admin/Procedimientos/details_signos_vitales/'+id,
          type: 'POST',
          success:(resp)=> {
              var resp = JSON.parse(resp);
//               console.log(resp.signos_vitales[0]);
              $("#SigVi_Id").val(resp.signos_vitales[0].id);
              $("#SigVi_Date").val(resp.signos_vitales[0].date);
              var reportType = resp.signos_vitales[0].report_type;
                $("#SigVi_FaseOperatoria").val(reportType);
              $("#SigVi_Data").val(resp.signos_vitales[0].date);
              $("#SigVi_Time").val(resp.signos_vitales[0].time);
              $("#SigVi_Talla").val(resp.signos_vitales[0].talla);
              $("#SigVi_Peso").val(resp.signos_vitales[0].peso);
              $("#SigVi_Frec_card").val(resp.signos_vitales[0].frec_card);
              $("#SigVi_Frec_resp").val(resp.signos_vitales[0].frec_resp);
              $("#SigVi_temperatura").val(resp.signos_vitales[0].temperatura);
              $("#SigVi_Sat_oxi_con").val(resp.signos_vitales[0].sat_oxi_con);
              $("#SigVi_sat_oxi_sin").val(resp.signos_vitales[0].sat_oxi_sin);
              $("#SigVi_presion_dia").val(resp.signos_vitales[0].presion_dia);
              $("#SigVi_presion_sis").val(resp.signos_vitales[0].presion_sis);
              $("#SigVi_remark").val(resp.signos_vitales[0].remark);
              $("#SigVi_generated_by").val(resp.signos_vitales[0].generated_by);
            },
            error: function() {
                 console.error("No es posible completar la operación");
            }
      });
    }
//------------- upddatform --------------------------
         $(document).ready(function (e) {
            $("#signos_form_update").on('submit', (function (e) {
    //             var nurse_id = $("#nurse_field").val();
    //             $("#nurse_set").val(nurse_id);
//                 $("#signos_form_updatebtn").button('loading');
//                 e.prseventDefault();
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/Procedimientos/update_sig_vitales',
                    type: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
//                         console.log(data);
                        if (data.status == "fail") {
                            var message = "";
                            $.each(data.error, function (index, value) {

                                message += value;
                            });
                            errorMsg(message);
                        } else {
                           $('#signos_form_update')[0].reset();
                          $('#exampleModal').modal('hide');
                           successMsg(data.message);
                          $('#Signos_Vitales_admision').load(location.href + ' #Signos_Vitales_admision'); 
                            window.location.reload(true);

                        }
                        $("#signos_form_updatebtn").button('reset');

                    },
                    error: function () {

                    }
                });


            }));
        });
       //-------end------upddatform-------
  
       //--------delete_signos_vitales----------
       $(document).on('click', '.delete_signos_vitales', function() {
            if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
                var id = $(this).data('id');  // Asegúrate de obtener el 'id' correctamente
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/Procedimientos/deleteSigVitales',
                    type: 'POST',
                    data: { SigVitales_id: id },
                    dataType: 'json',
                    success: function(data) {
//                         console.log(data);
                        $('#Signos_Vitales_admision').load(location.href + ' #Signos_Vitales_admision');
                        window.location.reload(true);
                        var message = data.message;
                        successMsg(message);
                    },
                    error: function() {
                        alert('Error en la solicitud al servidor');
                    }
                });
            }
        });
//-------end------delete_signos_vitales------

    ////---------------------- ddiagnostico-------------
  function add_equipo(opd,id_visit){
      console.log(opd, id_visit);
      holdModal('add_operationtheatre');
      
      $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getopdvisitdetails',
            //             url: '<?php echo base_url(); ?>admin/patient/getvisitdetailsdata',
            type: "GET",
            data: {
              visitid: id_visit
            },
            dataType: 'json',
            success: function(data) {
              console.log(data);
//               $exampleDestroy.val(data.cons_doctor).select2('destroy').select2();
//               $('#customfield').html(data.custom_fields_value);
//               var textarea_reason = document.getElementById('reason');
//               textarea_reason.textContent = data.reason_consultation;
//               $('#rmarital_status').html(data.marital_status);
//               $('#listname').html(data.patient_name);
//               $('#guardian').html(data.guardian_name);
//               $('#rgender').html(data.gender);
//               $('#rage').html(data.patient_age);
//               $('#ra').val(data.opd_details_id);
//               $('#edit_consdoc').val(data.cons_doctor);
//               $('#email').html(data.email);
//               $('#tpa_validity').html(data.insurance_validity);
//               $('#identification_number').html(data.identification_number);
              $('#patient_diag').val(data.patient_id);
//               $("#appointmentdate").val(data.date);
// //               $('#visitid').val(visitid);
//               $('#visit_transaction_id').val(data.transaction_id);
//               $("#edit_case").val(data.case_type);
//               $("#symptoms_description").val(data.symptoms);
//               $("#edit_casualty").val(data.casualty);
//               $("#edit_oldpatient").val(data.patient_old);
//               $("#edit_refference").val(data.refference);
//               $("#edit_revisit_note").val(data.note);
//               $('select[id="edit_organisation"] option[value="' + data.organisation_id + '"]').attr("selected", "selected");
//               $("#edit_height").val(data.height);
//               $("#edit_weight").val(data.weight);
//               $("#edit_bp").val(data.bp);
//               $("#edit_pulse").val(data.pulse);
//               $("#edit_temperature").val(data.temperature);
//               $("#edit_respiration").val(data.respiration);
//               $("#edit_paymentmode").val(data.payment_mode);
//               $("#edit_opdid").val(data.opdid);
//               $("#eknown_allergies").val(data.visit_known_allergies);
//               $("#edit_visit_payment_date").val(data.payment_date);
//               $("#edit_visit_payment").val(data.amount);
//               $("#visit_payment_mode").val(data.payment_mode).prop('selected');
//               $(".visit_payment_mode").trigger('change');
//               $("#edit_visit_cheque_no").val(data.cheque_no);
//               $("#edit_visit_cheque_date").val(data.cheque_date);
//               $("#edit_visit_payment_note").val(data.payment_note);
//               $("#viewModal").modal('hide');
//               holdModal('revisitModal');
              get_diagnosis(data.opdid);
//               imc();
              cie_structure();
            },
          });
  }
   
        function filter_diagnosis() {
         
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("searchFilter");
        console.log(input.value.length);
        filter = input.value.toUpperCase();
        ul = document.getElementById("lista2");
        console.log(ul);
        if (input.value.length != 0) {
          ul.removeAttribute("hidden");
        } else if (input.value.length == 0) {
          ul.setAttribute("hidden", false);
        }
        li = ul.getElementsByTagName("li");

        for (i = 0; i < li.length; i++) {
          a = li[i];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
          } else {
            li[i].style.display = "none";
          }
        }
    }
    
    function cie_structure() {
          $.ajax({
            url: "<?=base_url('uploads/json_cie/cie_10.json')?>",
            type: 'GET',
            dataType: 'json',
            success: (resp) => {
              console.log(resp);
              let ciediez = resp;
              let text = "";
              let text2 = "";
              for (let property of ciediez) {
                text += `<a onclick="select_diagnostic('${property.Codigo}','${property.Descripcion}','second')" href="#"><li style="border: transparent;"class="list-group-item list-hover">${property.Codigo} - ${property.Descripcion} - ${property.Nombre}</li></a>`;
                text2 += `<a onclick="select_diagnostic('${property.Codigo}','${property.Descripcion}','primary')" href="#"><li style="border: transparent;"class="list-group-item list-hover">${property.Codigo} - ${property.Descripcion} - ${property.Nombre} </li></a>`;
              }
              //                 var total = diagnosticos.push('${property.cie10}','${property.descripcion_diagnostico}');
              //                   document.getElementById("lista_second").innerHTML=text;
//               console.log(diagnosticos);
              document.getElementById("lista2").innerHTML = text2;


            }
          });
        }
    
            function select_diagnostic(code, description, type) {
          
                 console.log(code);
                 console.log(description);
                 console.log(type);
              
              if (type == "primary") {

                  var lista2 = document.getElementById("lista2");
                  lista2.setAttribute("hidden", false);
                  var select_diag2 = "";
                  select_diag2 = document.getElementById("searchFilter");
                  select_diag2.value = `${code} - ${description}`;
                  document.getElementById("diagnostic").value = select_diag2.value;

              }

              if (type == "second") {
                  var lista_second = document.getElementById("lista_second");
                  lista_second.setAttribute("hidden", false);
                  var select_diag = "";
                  select_diag = document.getElementById("second_diag");
                  select_diag.value = `${code}-${description}`;
                  console.log(select_diag.value);
              }
          
//               let lista_second = document.getElementById("lista_second");
//               lista_second.setAttribute("hidden", false);
              document.getElementById("searchFilter").value = "";
          }
    
            function table_diagnosis(type) {

                const diagnostico = document.getElementById('diagnostic').value;
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
            var myJSON = JSON.stringify({
              "id": id
            });
         
            $.ajax({
              url: "<?=base_url('admin/Patient/patient_diagnostic_delete')?>",
              data: myJSON,
              type: 'POST',
              dataType: 'json',
              success: (resp) => {
                console.log(resp);
                $('#diagnosticos').DataTable().ajax.reload();
              },
              error: function() {
                console.error("No es posible completar la operación");
              }
            });
        }
    
    
    function get_diagnosis(id){     
      // Destruir la instancia DataTable si ya existe
            if ($.fn.DataTable.isDataTable('#diagnosticos')) {
                $('#diagnosticos').DataTable().destroy();
            }
            console.log(id);
            $('#diagnosticos').DataTable({
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
                      opd_id: id
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
                          return `<button type='button' class='btn btn-sm btn-default' onclick='delete_diag(${data.id_diagnosis})'>Eliminar</button>`;
                        }
                    }
                ]
            });
        }
//-----end diagnosticos---------------------
    
//--------delete_diagnosticos----------
        $(document).on('click', '.delete_diagnosticos', function() {
            var id = $(this).data('id'); // Asegúrate de obtener el 'id' correctamente
            if (confirm('<?php echo addslashes($this->lang->line('delete_confirm')); ?>')) {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/Procedimientos/deleteDiagnosticos',
                    type: 'POST',
                    data: {
                        Diagnosticos_id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        // $('#Signos_Vitales_admision').load(location.href + ' #Signos_Vitales_admision');
                        window.location.reload(true);
                        var message = data.message;
                        successMsg(message);
                    },
                    error: function() {
                        alert('Error en la solicitud al servidor');
                    }
                });
            }
        });
        //-------end------delete_diagnosticos------


    function causaexterna() {
        var causaExterna = document.getElementById("causaExterna").value;
        if (causaExterna == "Accidente de trabajo") {
            var arl,
                arl = document.getElementById("arl_cause");
            arl.removeAttribute("hidden");
        } else if (causaExterna != "Accidente de trabajo") {
            arl = document.getElementById("arl_cause");
            arl.setAttribute("hidden", false);
        }
        var causa = document.getElementById("causaExterna").value;
        document.getElementById("custom_fields[opd][69]").value = causa;
    }
    
    
    
    function add_equipoSmall(opd){
     console.log(opd);
     holdModal('add_operationSmall');
   }

      $(document).ready(function (e) {
        $("#add_medication").on('submit', (function (e) {
//             e.preventDefault();
            $("#add_medicationbtn").button('loading');
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/addmedicationdoseopd',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                 beforeSend: function(){
                $("#add_medicationbtn").button('loading');
                 },
                success: function (data) {
                    if (data.status == "fail") {
                        var message = data.message;
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        var message = data.message;
                        $('#myMedicationModal').modal('hide');
                        $('.ajaxlist_med').load(location.href + ' .ajaxlist_med');
                        successMsg(data.message);
                    }
                    $("#add_medicationbtn").button('reset');
                },
                error: function () {
                 $("#add_medicationbtn").button('reset');
                },
  
                complete: function(){
                $("#add_medicationbtn").button('reset');
                }
            });
        }));
    });
    
    
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
    
     $(document).on('click', '.print_opd_clini_procedure', function() {

          var opd_id = <?php echo $opdid ?>;

          var $this = $(this);
          $.ajax({
            url: base_url + 'admin/patient/print_opd_clini_procedures',
            type: "POST",
            data: {
              opd_id: opd_id
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');
            },
            success: function(data) {
//               console.log(data);
              popup(data.page);
            },

            error: function(xhr) { // if error occured
              alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
              $this.button('reset');

            },
            complete: function() {
              $this.button('reset');

            }
          });
        });
        function popup(data) {
                var base_url = '<?php echo base_url() ?>';
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                frame1.css({
                  "position": "absolute",
                  "top": "-1000000px"
                });
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                //Create a new HTML document.
                frameDoc.document.write('<html>');
                frameDoc.document.write('<head>');
                frameDoc.document.write('<title></title>');
                frameDoc.document.write('</head>');
                frameDoc.document.write('<body>');
                frameDoc.document.write(data);
//                   console.log(data);
          
                frameDoc.document.write('</body>');
                frameDoc.document.write('</html>');
                frameDoc.document.close();
                setTimeout(function() {
                  window.frames["frame1"].focus();
                  window.frames["frame1"].print();
                  frame1.remove();
                }, 500);
                return true;
              }
  
  
</script>
 









  