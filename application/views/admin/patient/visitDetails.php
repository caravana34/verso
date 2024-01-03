  <?php

  $currency_symbol = $this->customlib->getHospitalCurrencyFormat();
  $genderList = $this->customlib->getGender();
  // $case_reference_id= $result['case_reference_id'];
  $custom_cliniverso = $result['custom'];
  $result_param= $result['result'];
//   echo "<pre>";
//   print_r($result['result']['patient_id']);
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

    <style>
      table.dataTable tbody td {
        word-break: break-word;
        vertical-align: top;
      }

      .disabled {
        cursor: not-allowed;
        pointer-events: none;
      }
      
      .eva {
         height: 224px !important;
        }
    </style>

    <script src="<?php echo base_url('/') ?>backend/js/Chart.bundle.js"></script>
    <script src="<?php echo base_url('/') ?>backend/js/utils.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('/'); ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
    <script src="<?php echo base_url('/'); ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
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
                    <h4 style="">Consulta Externa</h4>
                    <h5>
                      <span class="mt-5" style="margin-right: 5px;"><?php echo $doctor_app[0]->date; ?></span>
                      <span class="mt-5" style="margin-right: 5px;"><?= $start_time." - ".$fecha->format('h:i:s A') ?></span>
                      <span <?= $result_time= $result[ 'result'][ 'refference']=="Abierta" ? "" : "hidden" ?> class="mt-5" style="margin-right: 5px;" id="time_progress"></span>
                    </h5>
                </div>

                <!-- readonly
                          disabled -->

                <?php $result_state_readonly = $result['result']['refference'] == "Abierta" ? "" : "readonly" ?>
                <?php $result_state_disabled = $result['result']['refference'] == "Abierta" ? "" : "disabled" ?>

                <div class="" style="position: absolute; right: 10px;">
                  <button id="openModalBtn" class="btn btn-md get_opd_detail" data-opdid="<?php echo $opdid; ?>">Ver Detalle</button>
                  <button id="openModalBtnprint" class="btn btn-md print_opd_clini" data-opdid="<?php echo $opdid; ?>">Imprimir</button>
                  <a class="btn btn-md" href="<?php echo base_url() ."admin/patient/api_hl4_standard/".$result['result']["id"] ."/". $result['result']['patient_id'] ?>" data-opdid="<?php echo $opdid; ?>">Enviar</a>
                  <?php if($userdata['role_id'] != 8): ?>
                  <button type="button" onclick="confirmar_opd('<?= $result['result']['id']?>', '<?= $id?>', '<?= $id_visit?>')" id="confirmar" class="btn btn-danger btn-md" <?= $result_state_disabled?> ><?= $result_state = $result['result']['refference'] =="Abierta" ? "Finalizar" : "Finalizada" ?></button>
                  <?php endif ?>
                </div>

              </div>



              <ul class="nav nav-tabs navlistscroll" style="border-top: 1px solid #ddd; margin-top: 5px;">
                <li><a href="#overview" class="active" data-toggle="tab" aria-expanded="true"><i class="fa fa-th"></i> <?php echo $this->lang->line('overview'); ?></a></li>
                <?php if ($this->rbac->hasPrivilege('checkup', 'can_view')) { ?>
<!--                 <li><a href="#activity" data-toggle="tab" aria-expanded="true"><i class="fas fa-school"></i> Visitas</a></li> -->
                <?php } ?>
                  <?php if ($this->rbac->hasPrivilege('opd_lab_investigation', 'can_view')) { ?>
                  <li><a href="#labinvestigation" data-toggle="tab" aria-expanded="true"><i class="fas fa-briefcase-medical"></i> Medicamentos</a></li>
                  <?php } ?>

                  <?php if ($this->rbac->hasPrivilege('opd_operation_theatre', 'can_view')) { ?>
                  <li><a href="#operationtheatre" data-toggle="tab" aria-expanded="true"><i class="fas fa-notes-medical"></i> Ordenes Médicas</a></li>

                  <?php }  ?>

                  <?php if ($this->rbac->hasPrivilege('opd_timeline', 'can_view')) { ?>
                  <li><a href="#paraclinicos" data-toggle="tab" aria-expanded="true"><i class="fas fa-sitemap"></i> Paraclínicos </a></li>
                  <?php } ?>


                  <?php if ($this->rbac->hasPrivilege('opd_timeline', 'can_view')) { ?>
                  <li><a href="#timeline" data-toggle="tab" aria-expanded="true"><i class="fas fa-wheelchair"></i> Incapacidad</a></li>

                  <?php } ?>

                  <?php if ($this->rbac->hasPrivilege('opd_timeline', 'can_view')) { ?>
                  <li><a href="#remisions" data-toggle="tab" aria-expanded="true"><i class="fas fa-user-clock"></i> Remisiones</a></li>
                  <?php } ?>
                 <?php if ($this->rbac->hasPrivilege('opd_timeline', 'can_view')) { ?>
                  <li><a href="#notas_medicas" data-toggle="tab" aria-expanded="true"><i class="fas fa-user-clock"></i> Notas Aclaratorías</a></li>
                  <?php } ?>


<!--                   <?php if ($this->rbac->hasPrivilege('opd_timeline', 'can_view')) { ?>
                  <li><a href="#charges" data-toggle="tab" aria-expanded="true"><i class="fas fa-folder-plus"></i> Cargos</a></li>
                  <?php } ?> -->

<!--                   <?php if ($this->rbac->hasPrivilege('opd_timeline', 'can_view')) { ?>
                  <li><a href="#payment" data-toggle="tab" aria-expanded="true"><i class="fas fa-hand-holding-usd"></i> Pagos</a></li>
                  <?php } ?> -->

<!--                   <?php if ($this->rbac->hasPrivilege('opd_timeline', 'can_view')) { ?>
                  <li><a href="#chronology" data-toggle="tab" aria-expanded="true"><i class="fas fa-stream"></i> Cronologia</a></li>
                  <?php } ?> -->

              </ul>


              <div class="tab-content pt6">
                <div class="tab-pane tab-content-height  active" id="overview">

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
                          }

                          ?>
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
                                <?php echo $result['result']['email']; ?>
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
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <hr class="hr-panel-heading hr-10">
                          <p>
                            <strong><i class="fas fa-user-injured"></i>  Motivo Consulta</strong>
                            <p>
                              <hr class="hr-panel-heading hr-10">
                              <table class="table table-bordered mb0">

                                <ul>
                                  <li>
                                    <?= $doctor_app[0]->reason_consultation ?>
                                  </li>
                                </ul>

                              </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <hr class="hr-panel-heading hr-10">
                          <p>
                            <strong><i class="fas fa-briefcase-medical"></i> Tratamiento Actual</strong>
                          </p>
                          <hr class="hr-panel-heading hr-10">
                          <table class="table table-bordered mb0">

                            <?php foreach ($result['custom'] as $key =>$s): ?>
                            <ul>
                              <?php if($s->custom_field_id == 58){?>

                              <li>
                                <?php echo $s->field_value; ?>
                              </li>
                              <?php } ?>
                            </ul>

                            <?php endforeach ?>
                          </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <hr class="hr-panel-heading hr-10">
                          <p>
                            <strong><i class="fas fa-briefcase-medical"></i> Revisión por sistemas</strong>
                          </p>
                          <hr class="hr-panel-heading hr-10">
                          <table class="table table-bordered mb0">

                            <?php foreach ($result['custom'] as $key =>$s): ?>
                            <ul>
                              <?php if($s->custom_field_id == 43){?>

                              <li>
                                <?php echo $s->field_value; ?>
                              </li>
                              <?php } ?>
                            </ul>

                            <?php endforeach ?>
                          </table>
                        </div>
                      </div>
                      <hr class="hr-panel-heading hr-10">
                      <h5>
                        <strong><i class="fas fa-search-plus"></i> Antecedentes</strong>
                      </h5>
                      <hr class="hr-panel-heading hr-10">
                      <div class="row">
                        <!--./col-lg-5-->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <?php foreach ($result['custom'] as $key =>$s): ?>
                          <ul>
                            <?php if($s->custom_field_id == 77 || $s->custom_field_id == 76 || $s->custom_field_id == 75 || $s->custom_field_id == 78 || $s->custom_field_id == 80){?>

                            <li>
                              <p>
                                <?php space($s->custom_field_id); ?>:
                                <?php echo $s->field_value; ?>
                              </p>
                            </li>
                            <?php } ?>
                          </ul>

                          <?php endforeach ?>

                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                          <?php foreach ($result['custom'] as $key =>$s): ?>
                          <ul>
                            <?php if($s->custom_field_id == 80 || $s->custom_field_id == 81 || $s->custom_field_id == 93 || $s->custom_field_id == 92 || $s->custom_field_id == 95){?>

                            <li>
                              <p>
                                <?php space($s->custom_field_id); ?>:
                                <?php echo $s->field_value; ?>
                              </p>
                            </li>
                            <?php } ?>
                          </ul>

                          <?php endforeach ?>

                        </div>
                      </div>
                      <!--./row-->
                      <hr class="hr-panel-heading hr-10">
                      <h5>
                        <strong><i class="fas fa-running"></i> Examen Físico</strong>
                      </h5>
                      <hr class="hr-panel-heading hr-10">
                      <div class="row d-flex" style="justify-content:space-between">
                        <div class="col-md-6">
                          <?php foreach ($result['custom'] as $key =>$s): ?>
                          <ul>
                            <?php if($s->custom_field_id == 19 || $s->custom_field_id == 38 || $s->custom_field_id == 37 || $s->custom_field_id == 18 || $s->custom_field_id == 49 || $s->custom_field_id == 36 || $s->custom_field_id == 83 || $s->custom_field_id == 84 || $s->custom_field_id == 85 || $s->custom_field_id == 86 ){?>
                            <li>
                              <p>
                                <b><?php space($s->custom_field_id); ?></b> -
                                <?php echo $s->field_value; ?>
                                <?php if($s->custom_field_id == 36){echo ("Kg");}elseif($s->custom_field_id == 49){echo ("°C");}elseif($s->custom_field_id == 19){echo ("Cm");}elseif($s->custom_field_id == 38){echo ("LPM");} ?>
                              </p>
                            </li>
                            <?php } ?>
                          </ul>
                          <?php endforeach ?>
                        </div>
                        <div class="col-md-6">
                          <?php foreach ($result['custom'] as $key =>$s): ?>
                          <ul>
                            <?php if($s->custom_field_id == 39 || $s->custom_field_id == 44 || $s->custom_field_id == 52 || $s->custom_field_id == 54 || $s->custom_field_id == 47 || $s->custom_field_id == 45 || $s->custom_field_id == 87 || $s->custom_field_id == 88 || $s->custom_field_id == 89){?>
                            <li>
                              <p>
                                <b> <?php space($s->custom_field_id); ?></b> -
                                <?php echo $s->field_value; ?>
                                <?php if($s->custom_field_id == 39){echo ("RPM");}elseif($s->custom_field_id == 44 || $s->custom_field_id == 45){echo ("mmHg");}?>
                              </p>
                            </li>
                            <?php } ?>
                          </ul>
                          <?php endforeach ?>
                        </div>

                      </div>

                    </div>
                    <!--./col-lg-6-->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      
                      <div class="col-md-8 d-flex " style="flex-direction: column; line-height: normal;">
<!--                           <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Medico consultor: &nbsp;</h3> -->
                          <p class="text-uppercase font14">
                            <span class="bolds">Médico consultor: &nbsp;</span>
                            <?php echo $result['result']['name'] ?>
                            <?php echo $result['result']['surname'] ?>
                          </p>
                          <p class="font14">
                            <span class="text-uppercase bolds">Mensaje: &nbsp;</span>
                             <?php echo $doctor_app[0]->message; ?>
                          </p>
                      </div>
                      
                      <div class="box-header border-b mb10 pl-0" style="padding: 12px;">
                        
<!--                         <div class="pull-right">
                          <div class="editviewdelete-icon pt8">

                          </div>
                        </div> -->

                        <div class="pull-right">
                          <div class="text-center text-light">
                            <?php if ($this->rbac->hasPrivilege('opd_patient', 'can_edit')) { ?>
                            <a href="#" class="btn btn-md revisitpatient <?= $result_state_disabled?>" onclick="editRecord('<?php echo $id_visit; ?>');" style="background:#1563B0; color:#fff;border-radius: 30px;" data-target="#revisitModal" data-toggle="tooltip" data-original-title="Historia Clínica"><i class="fa fa-stethoscope"></i>  Consulta</a>

                            <?php } ?>
                            <?php if ($this->rbac->hasPrivilege('opd_patient', 'can_delete')) { ?>
                            <!--                                                           <a class="" href="#" onclick="delete_patient('<?php echo $result['id'] ?>','<?php echo $result['patient_id'] ?>')"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete_patient'); ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a> -->

                            <?php } if ($this->rbac->hasPrivilege('opd_patient_discharge', 'can_view')) { ?>
                            <!--                                                       <a class="patient_discharge" href="#"    data-toggle="tooltip" title="<?php echo $this->lang->line('patient_discharge'); ?>"><i class="fa fa-hospital-o"></i> -->
                            </a>
                            <?php } if(!$is_discharge){
                                                if ($this->rbac->hasPrivilege('opd_patient_discharge_revert', 'can_view')) { ?>
                            <!--                                                            <a data-toggle="tooltip" class="" onclick="discharge_revert('<?php echo $result['case_reference_id']; ?>')" href="#" title="<?php echo $this->lang->line('discharge_revert')?>"><i class="fa fa-undo"> </i></a> -->
                            <?php
                                            } } ?>
                              <input type="hidden" id="result_opdid" name="" value="<?php echo $result['id'] ?>">
                              <input type="hidden" id="result_pid" name="" value="<?php echo $result['patient_id'] ?>">

                          </div>
                        </div>
                      </div>


                      <h5>
                        <strong><i class="fas fa-notes-medical"></i> Diagnósticos</strong>
                      </h5>
                      <hr class="hr-panel-heading hr-10">
                      <div class="col-md-12"> <strong>Primarios</strong> </div>
                      <div class="col-md-12">
                        <!--./col-lg-5-->

                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <?php foreach ($diagnosis as $key =>$s): ?>
                          <ul>
                            <?php if($s->categoria_diag =="primario"):?>
                            <li class="">
                              <strong>Tipo Diagnóstico</strong><br>
                              <p style="word-break: break-word;">
                                <?php echo str_replace("_"," ",$s->tipo_diag); ?>
                              </p>
                            </li>
                            <?php endif ?>
                          </ul>
                          <?php endforeach ?>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <?php foreach ($diagnosis as $key =>$s): ?>
                          <ul>
                            <?php if($s->categoria_diag =="primario"):?>
                            <li class="">
                              <strong>Nombre Diagnóstico</strong><br>
                              <p style="word-break: break-word;">
                                <?php echo str_replace("_"," ",$s->nombre_diag); ?>
                              </p>
                            </li>
                            <?php endif ?>
                          </ul>
                          <?php endforeach ?>
                        </div>
                      </div>
                      <hr class="hr-panel-heading hr-10">

                      <div class="col-md-12"> <strong>Secundarios</strong> </div>
                      <div class="row">
                        <!--./col-lg-5-->

                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <?php foreach ($diagnosis as $key =>$s): ?>
                          <ul>
                            <?php if($s->categoria_diag =="secundario"):?>
                            <li class="">
                              <strong>Tipo Diagnóstico</strong><br>
                              <p style="word-break: break-word;">
                                <?php echo str_replace("_"," ",$s->tipo_diag); ?>
                              </p>
                            </li>
                            <?php endif ?>
                          </ul>
                          <?php endforeach ?>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <?php foreach ($diagnosis as $key =>$s): ?>
                          <ul>
                            <?php if($s->categoria_diag =="secundario"):?>
                            <li class="">
                              <strong>Nombre Diagnóstico</strong><br>
                              <p style="word-break: break-word;">
                                <?php echo str_replace("_"," ",$s->nombre_diag); ?>
                              </p>
                            </li>
                            <?php endif ?>
                          </ul>
                          <?php endforeach ?>
                        </div>
                      </div>


                      <hr class="hr-panel-heading hr-10">
                      <h5>
                        <strong><i class="fas fa-chart-area"></i> Analisis</strong>
                      </h5>
                      <hr class="hr-panel-heading hr-10">
                      <div class="row">
                        <!--./col-lg-5-->
                        <div class="col-lg-12 col-md-12 col-sm-12">

                          <?php foreach ($result['custom'] as $key =>$s): ?>
                          <ul>
                            <?php if( $s->custom_field_id == 64){?>
                            <li class="">
                              <?php echo $s->field_value; ?>
                            </li>

                            <?php } ?>
                          </ul>
                          <?php endforeach ?>

                        </div>

                      </div>

                      <div class="blood-body">
                        <div class="blood-pull-left blood-title">Envío de medicamentos</div>
                      </div>
                      <div class="box box-primary">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                  <thead>
                                    <tr>
                                      <th>Principio activo</th>
                                      <th>Concentración</th>
                                      <th>Forma Farmacéutica</th>
                                      <th>Vía</th>
                                      <th>Dosis</th>
                                      <th>Periodicidad</th>
                                      <th>Durante</th>
                                      <th>Total</th>
                                      <th>Pos</th>
                                      <th>Indicaciones</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach($medications as $value): ?>
                                    <tr>
                                      <td>
                                        <?= $value->header_note ?>
                                      </td>
                                      <td>
                                        <?= $value->footer_note ?>
                                      </td>
                                      <td>
                                        <?= $value->finding_description  ?>
                                      </td>
                                      <td>Via</td>
                                      <td>
                                        <?= $value->dosage ?>
                                      </td>
                                      <td>
                                        <?= $value->dose_interval_id ?>
                                      </td>
                                      <td>
                                        <?= $value->dose_duration_id ?>
                                      </td>
                                      <td>Total</td>
                                      <td>Pos</td>
                                      <td>
                                        <?= $value->instruction ?>
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
                  <!--./row-->
                </div>
                <!--#/overview-->
                <?php if ($this->rbac->hasPrivilege('checkup', 'can_view')): ?>
<!--                 <div class="tab-pane" id="activity">
                  <div class="box-tab-header">
                    <h3 class="box-tab-title">
                      <?php echo $this->lang->line('checkups'); ?>
                    </h3>
                    <div class="box-tab-tools">
                      <?php if ($this->rbac->hasPrivilege('checkup', 'can_add')) { if($is_discharge){ ?>

                      <a href="#" onclick="getRevisitRecord('<?php echo $visitdata['visitid'] ?>')" class="btn btn-sm revisitrecheckup" style="background:#1563B0; color:#fff;border-radius: 5px;" data-toggle="modal" title=""><i class="fa fa-plus"></i> <?php echo $this->lang->line('new_checkup'); ?></a>
                      <?php }} ?>
                    </div>
                  </div>

                  <div class="download_label">
                    <?php echo composePatientName($result['patient_name'],$result['patient_id']) . " " . $this->lang->line('opd_details'); ?>
                  </div>
                  <div class="table-responsive">
                    <h5>
                      <?php echo $opd_prefix.$result['id']; ?>
                    </h5>
                    <table class="table table-striped table-bordered table-hover ajaxlist" cellspacing="0" width="" data-export-title="<?php echo composePatientName($result['patient_name'],$result['patient_id']) . " " . $this->lang->line('opd_details'); ?>">
                      <thead>
                        <th>
                          <?php echo $this->lang->line('checkup_id'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('appointment_date'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('consultant'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('reference'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('symptoms'); ?>
                        </th>
                        <?php 
                          if (!empty($fields)) {
                              foreach ($fields as $fields_key => $fields_value) {
                                  ?>
                        <th>
                          <?php echo $fields_value->name; ?>
                        </th>
                        <?php
                                } 
                            } 
                        ?>
                          <th class="text-right noExport">
                            <?php echo $this->lang->line('action') ?>
                          </th>

                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div> -->
                <?php endif ?>


                <div class="tab-pane" id="operationtheatre">
                  <div class="box-tab-header" style="margin: 0px !important;">
                    <div style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                      <h4 class="box-tab-title" style="margin:0px; padding:15px;">Procedimientos - Imagenología - Hemocomponentes</h4>
                    </div>
                  </div>
                  <div class="download_label">
                    <?php echo composePatientName($result['patient_name'],$result['patient_id']) . " " . $this->lang->line('opd_details'); ?>
                  </div>
                  <?php foreach($result['custom'] as $key=>$value){ if($value->custom_field_id==62){ $field_value= $value->field_value;}} ?>
                  <div class="row">
                    <form id="add_procedure" method="post" accept-charset="utf-8" class="ptt10">
                      <div class="col-lg-6" style="margin-top: 10px !important;">
                        <div class="form-group">
                          <label>Diagnósticos para este procedimiento</label>
                          <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-stethoscope"></i></span>
                            <select class="form-control mt-2 " id="" name="diagnosis_main" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                              <option value="" hidden>Diagnosticos</option>
                              <?php foreach ($diagnosis as $key =>$s): ?>
                              <option value="<?= $s->nombre_diag; ?>"><?= $s->nombre_diag; ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>
                      </div>

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
                        <label for="medication_indication">Observación </label>
                        <textarea name="medication_observation" class="form-control" autocomplete="off" style="resize: none;" <?= $result_state_readonly?>></textarea>
                      </div>
                    </div>
                      
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="diagnostic_help">Ayuda diagnóstica</label>
                        <textarea name="diagnostic_help" class="form-control" autocomplete="off" style="resize: none;" <?= $result_state_readonly?> placeholder="Solo registre este campo si no encuentra la ayuda diagnostica."></textarea>
                      </div>
                    </div>
                      <!--                                        <div class="col-lg-2 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label> Destino</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-map-marked"></i></span> 
                                                    <select class="form-control mt-2 " id="" name="" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                                        <option value="" hidden> Seleccione el destino</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                  </select>
                                                </div>
                                            </div>
                                        </div>
                                      </div>

                                     <div class="mt-5">
                                        <div class="col-lg-2 col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label>Prioridad</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-signal"></i></span> 
                                                    <select class="form-control " id="" name="" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                                        <option value="" hidden>Prioridad </option>
                                                        <option value="1">Prioridad baja</option>
                                                        <option value="2">Prioridad media</option>
                                                        <option value="3">Prioridad Alta</option>
                                                    </select>
                                              </div>
                                            </div>
                                        </div>

                                            <div class="col-lg-3 col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <label>Lateralidad</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-receipt"></i></span> 
                                                        <select class="form-control " id="" name="" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                                            <option value="" hidden>Lateralidad</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                          <div class="col-lg-3 col-md-4 col-sm-4">
                                              <div class="form-group">
                                                  <label>Enfasis</label>
                                                  <div class="input-group">
                                                      <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-id-card-alt"></i></span> 
                                                      <select class="form-control " id="" name="" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                                          <option value="" hidden>Días</option>
                                                          <option value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                      </select>
                                                   </div> 
                                              </div>
                                          </div>
                                           <div class="col-lg-3 col-md-4 col-sm-4">
                                              <div class="form-group">
                                                  <label>Total</label><small>&nbsp;<i class="fa fa-search"></i></small> 
                                                  <div class="input-group">
                                                    <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span> 
                                                    <input type="text" class="form-control" autocomplete="off" id="" name="medication_total" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                                                    <span class="text-danger"></span>
                                                  </div>
                                              </div>
                                           </div> -->

                      <div class="modal-footer" style="border: none;">
                        <div class="pull-right">
                          <button type="submit" id="add_procedurebtn" class="btn border" style="background:#1563b0; color:#fff;" autocomplete="off" <?= $result_state_disabled?>><i class="fa fa-check-circle"></i> Guardar</button>
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
                                      <th>Observación</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach($procedures_opd as $key => $value): ?>
                                    <?php if($value->diagnostic_help == ''): ?>
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
                                          <?= $value->observation ?>
                                        </td>
                                      </tr>
                                    <?php endif ?>
                                    <?php endforeach ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="blood-body">
                        <div class="blood-pull-left blood-title">Ayudas diagnosticas.</div>
                      </div>
                      <div class="box box-primary">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                  <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Ayuda diagnosticas</th>
                                      <th>Fecha de creación</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach($procedures_opd as $key => $value): ?>
                                    <?php if($value->diagnostic_help != ''): ?>
                                      <tr>
                                        <td>
                                          <?= $value->id_procedures ?>
                                        </td>
                                        <td>
                                          <?= $value->diagnostic_help ?>
                                        </td>
                                        <td>
                                          <?= $value->create_at ?>
                                        </td>
                                      </tr>
                                    <?php endif ?>
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
                <div class="tab-pane" id="paraclinicos">
                  <div class="box-tab-header" style="margin: 0px !important;">
                    <div style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                      <h4 class="box-tab-title" style="margin:0px; padding:15px;">Paraclínico</h4>
                    </div>
                  </div>
                  <div class="download_label">
                    <?php echo composePatientName($result['patient_name'],$result['patient_id']) . " " . $this->lang->line('opd_details'); ?>
                  </div>
                  <?php foreach($result['custom'] as $key=>$value){ if($value->custom_field_id==62){ $field_value= $value->field_value;}} ?>
                  <div class="row">
                    <form id="add_paraclini" method="post" accept-charset="utf-8" class="ptt10">

                      <input type="hidden" id="codigo_para" name="codigo_para">
                      <input type="hidden" id="product_para" name="product_para">

                      <div class="col-lg-6" style="margin-top: 10px !important;">
                        <div class="form-group">
                          <label>Diagnósticos para estos Paraclínicos</label>
                          <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-stethoscope"></i></span>
                            <select class="form-control mt-2 " id="" name="diagnosis_main" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                               <option value="" hidden>Diagnosticos</option>
                              <?php foreach ($diagnosis as $key =>$s): ?>
                               <option value="<?= $s->nombre_diag; ?>"><?= $s->nombre_diag; ?></option>

                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-4 col-sm-4" style="margin-top: 10px !important;">
                        <div class="form-group">
                          <label>Paraclínicos</label>
                          <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control search_text" id="paraclinic_input" onkeyup="paraclinic()" placeholder="Buscar procedimiento" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                            <span class="text-danger"></span>
                          </div>
                          <div class="usersearchlist">
                            <ul class="list-group scroll-container mb-3" style="position: absolute; z-index: 100;" id="paraclini_result" hidden>
                            </ul>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="description_procedure">Descripción Paraclínicos</label>
                          <textarea name="description_procedure" class="form-control" autocomplete="off" style="resize: none;" <?= $result_state_readonly?> placeholder="Solo registre este campo si no encuentra el procedimiento"></textarea>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="modal-footer" style="border: none;">
                          <div class="pull-right">
                            <button type="submit" id="add_paraclinibtn" class="btn border" style="background:#1563b0; color:#fff;" autocomplete="off" <?= $result_state_disabled?>><i class="fa fa-check-circle"></i> Guardar</button>
                          </div>
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
                                      <th>Fecha</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach($paraclini_clini as $key => $value): ?>
                                      <?php if($value->description_procedure == ''): ?>
                                      <tr>
                                        <td>
                                          <?= $value->codigo_para ?>
                                        </td>
                                        <td>
                                          <?= $value->product_para ?>
                                        </td>
                                        <td>
                                          <?= $value->create_at ?>
                                        </td>
                                      </tr>
                                      <?php endif ?>
                                    <?php endforeach ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="blood-body">
                        <div class="blood-pull-left blood-title">Descripción procedimiento</div>
                      </div>
                      <div class="box box-primary">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                  <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Descripción</th>
                                      <th>Fecha</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach($paraclini_clini as $key => $value): ?>
                                      <?php if($value->description_procedure != ''): ?>
                                      <tr>
                                        <td>
                                          <?= $value->id ?>
                                        </td>
                                        <td>
                                          <?= $value->description_procedure ?>
                                        </td>
                                        <td>
                                          <?= $value->create_at ?>
                                        </td>
                                      </tr>
                                      <?php endif ?>
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
                    <table class="table table-striped table-bordered table-hover">
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


                <div class="tab-pane" id="labinvestigation">

                  <div class="box-tab-header">
                    <div style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                      <h4 class="box-tab-title" style="margin:0px; padding:15px;">Medicamentos</h4>
                    </div>
                  </div>

                  <form id="insert_medication" accept-charset="utf-8" class="ptt10">
                    <div class="row">
                      <div class="col-lg-6">
                        <div>
                          <label>Medicamentos</label>
                          <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control search_text" id="search_medicine" onkeyup="busqueda()" placeholder="Buscar medicamento" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                            <span class="text-danger"></span>
                          </div>
                        </div>
                        <div class="usersearchlist">
                          <ul class="list-group scroll-container mb-3" style="position: absolute; z-index: 100; width: 100%;" id="result_incodol" hidden>
                          </ul>
                        </div>
                      </div>

                    
                      <div class="col-lg-6">
                        <div>
                          <label>Medicamentos PBS</label>
                          <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control search_text" id="search_pbs" onkeyup="pbs_medications()" placeholder="Buscar medicamento" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                            <span class="text-danger"></span>
                          </div>
                        </div>
                        <div class="usersearchlist">
                          <ul class="list-group scroll-container mb-3" style="position: absolute; z-index: 100; width: 100%;" id="medicines_pbs" hidden>
                          </ul>
                        </div>
                      </div>


                      <!--                            <div class="col-lg-6" style="padding-top: 10px !important;">
                                  <div class="form-group">
                                      <label>Diagnósticos presuntos</label>
                                      <div class="input-group">
                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-diagnoses"></i></span> 
                                          <select class="form-control mt-2 " id="" name="diagnosis_presumed" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                             <option value="" hidden>Diagnósticos</option>
                                            <?php foreach ($result['custom'] as $key =>$s): ?>
                                            <?php if($s->custom_field_id == 29 || $s->custom_field_id == 58 || $s->custom_field_id == 62):?>
                                              <option value="<?= $s->field_value; ?>"><?= $s->field_value; ?></option>
                                             <?php endif ?>
                                            <?php endforeach ?>
                                         </select>
                                     </div>
                                  </div>
                              </div> -->

                      <!--                            <div class="col-lg-12 mb-5 pd-0" style="margin-bottom: 15px; padding: 0px;">
                             </div> -->


                      <div class="col-lg-12" style="padding: 0px; margin-top: 5px;">
   
                        <div class="">
                          
                         <div class="col-lg-6">
                            <div class="form-group">
                              <label>Diagnósticos para este medicamento</label>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-stethoscope"></i></span>
                                <select class="form-control mt-2 " id="" name="diagnosis_main" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                   <option value="" hidden>Diagnosticos</option>
                                    <?php foreach ($diagnosis as $key =>$s): ?>
                                     <option value="<?= $s->nombre_diag; ?>"><?= $s->nombre_diag; ?></option>

                                    <?php endforeach ?>
                                  </select>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label>Principio activo</label><small></small>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-prescription-bottle-alt"></i></span>
                                <input type="text" class="form-control" autocomplete="off" id="active_principle" name="active_principle" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label>Forma farmacéutica</label><small></small>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-flask"></i></span>
                                <input type="text" class="form-control" autocomplete="off" id="pharmaceutical" name="pharmaceutical_form" style="border-radius: 0px 10px 10px 0px !important;" placeholder="" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label>Concentración</label><small></small>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-prescription-bottle"></i></span>
                                <input type="text" class="form-control" autocomplete="off" id="concentration" name="medication_concentration" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="mt-5">
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label>Vía</label><small></small>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-exchange-alt"></i></span>
                                <input type="text" class="form-control" autocomplete="off" id="medication_through" name="medication_through" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label> Dosis</label>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-list-ol"></i></span>
                                <select class="form-control mt-2 information" id="medication_dose" name="medication_dose" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                    <option value="" hidden>Dosis</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label> Cada</label>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important; padding: 0px !important; width: 16%; border: none; margin-left: 5px;"><input type="text" class="form-control information" id="medication_periodicity" name="medication_periodicity" autocomplete="off" style="border-radius: 10px 0px 0px 10px !important; border-right: none; padding: 6px;" placeholder="000" <?= $result_state_readonly?> ></span>
                                <select class="form-control mt-2 information" id="medication_each" name="medication_each" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important; width: 100%;" <?= $result_state_readonly?>>
                                    <option value="" hidden>Tiempo</option>
                                    <option value="Minutos">Minutos</option>
                                    <option value="Horas">Horas</option>
                                    <option value="Dias">Dias</option>
                                    <option value="Semanas">Semanas</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label>Durante</label>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important; padding: 0px !important; width: 16%; border: none; margin-left: 5px;"><input type="text" class="form-control information" id="medication_time" name="medication_time" autocomplete="off" style="border-radius: 10px 0px 0px 10px !important; border-right: none; padding: 6px;" placeholder="000" <?= $result_state_readonly?> ></span>
                                <select class="form-control information" id="medication_during" name="medication_during" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important; width: 100%;" <?= $result_state_readonly?>>
                                                  <option value="" hidden>Tiempo</option>
                                                  <option value="Dias">Dias</option>
                                                  <option value="Semanas">Semanas</option>
                                                  <option value="Meses">Meses</option>
                                                  <option value="Años">Años</option>
                                             </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label>Cantidad</label><small></small>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-poll-h"></i></span>
                                <input type="text" class="form-control" autocomplete="off" id="medication_total" name="medication_total" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-4 col-sm-4" hidden>
                            <div class="form-group">
                              <label>Producto</label><small></small>
                              <input type="text" class="form-control" autocomplete="off" id="medicine_product" name="medicine_product" placeholder="">
                              <span class="text-danger"></span>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-4 col-sm-4" hidden>
                            <div class="form-group">
                              <label>Titular</label><small></small>
                              <input type="text" class="form-control" autocomplete="off" id="holder_name" name="holder_name" placeholder="">
                              <span class="text-danger"></span>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-4 col-sm-4" hidden>
                            <div class="form-group">
                              <label>Nombre comercial</label><small></small>
                              <input type="text" class="form-control" autocomplete="off" id="trade_name" name="trade_name" placeholder="">
                              <span class="text-danger"></span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="medication_indication">Indicaciones </label>
                          <textarea name="medication_indication" class="form-control" autocomplete="off" style="resize: none;" <?= $result_state_readonly?>></textarea>
                        </div>
                      </div>
                      
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="medical_formula">Formula médica</label>
                          <textarea name="medical_formula" class="form-control" autocomplete="off" style="resize: none;" <?= $result_state_readonly?> placeholder="Solo registre este campo si no encuentra el medicamento"></textarea>
                        </div>
                      </div>

                      <div style="margin-right: 10px;">
                        <div class="pull-right">
                          <button type="submit" id="insert_medicationbtn" class="btn pull-right" style="background:#1563b0; color:#fff;" autocomplete="off" <?= $result_state_disabled?>><i class="fa fa-check-circle"></i> Guardar</button>
                        </div>
                      </div>

                  </form>
                    

                    <div class="col-md-12 mt-5">
                        <div class="blood-body">
                          <div class="blood-pull-left blood-title">Medicamentos asignados a esta visita</div>
                        </div>
                        <div class="box box-primary">
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive mailbox-messages">
                                  <table class="table table-hover table-striped">
                                    <thead>
                                      <tr>
                                        <th>Principio activo</th>
                                        <th>Concentración</th>
                                        <th>Forma Farmacéutica</th>
                                        <th>Vía</th>
                                        <th>Dosis</th>
                                        <th>Periodicidad</th>
                                        <th>Durante</th>
                                        <th>Total</th>
                                        <th>Indicaciones</th>
                                        <!--                                                                 <th>Pos</th> -->
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach($medications as $value): ?>
                                        <?php if($value->medical_formula == ""): ?>
                                          <tr>
                                            <td>
                                              <?= $value->header_note ?>
                                            </td>
                                            <td>
                                              <?= $value->footer_note ?>
                                            </td>
                                            <td>
                                              <?= $value->finding_description  ?>
                                            </td>
                                            <td>
                                              <?= $value->medication_via ?>
                                            </td>
                                            <td>
                                              <?= $value->dosage ?>
                                            </td>
                                            <td>
                                              <?= $value->dose_interval_id ?>
                                            </td>
                                            <td>
                                              <?= $value->dose_duration_id ?>
                                            </td>
                                            <td>
                                              <?= $value->medication_total ?>
                                            </td>
                                            <td>
                                              <?= $value->instruction ?>
                                            </td>
                                          </tr>
                                        <?php endif ?>
                                      <?php endforeach ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="blood-body">
                          <div class="blood-pull-left blood-title">Formulas médicas</div>
                        </div>
                         <div class="box box-primary">
                            <div class="box-body">
                               <div class="row">
                                 <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped">
                                    <thead>
                                      <tr>
                                        <th>Id</th>
                                        <th>Concentración</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach($medications as $value): ?>
                                        <?php if($value->medical_formula != ''): ?>
                                          <tr>
                                            <td>
                                              <?= $value->id ?>
                                            </td>
                                            <td>
                                              <?= $value->medical_formula ?>
                                            </td>
                                          </tr>
                                        <?php endif ?>
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



                <!-- Charges -->
                <?php if ($this->rbac->hasPrivilege('opd_charges', 'can_view')) { ?>
                <div class="tab-pane" id="charges">
                  <!--                               <div class="" style="background-color:#d5d5d5;padding:2px !important;border-radius:7px; color:#000;!important;">
                                    <h4 class="box-tab-title" style="margin:0px; padding:15px;">Cargos</h4>
                                </div> -->
                  <div class="box-tab-header" style="padding:15px; background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                    <h3 class="box-tab-title">
                      <?php echo $this->lang->line('charges'); ?>
                    </h3>

                    <div class="box-tab-tools">
                      <?php if ($this->rbac->hasPrivilege('opd_charges', 'can_add')) { 
                                            if($is_discharge){ ?>
                      <a data-toggle="modal" onclick="holdModal('add_chargeModal')" class="btn btn-sm addcharges" style="background:#1563b0;color:#fff;margin:2px;"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_charges') ?></a>
                      <?php }
                                        } ?>
                    </div>
                  </div>

                  <div class="download_label">
                    <?php echo composePatientName($result['patient_name'],$result['patient_id']) . " " . $this->lang->line('opd_details'); ?>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover example">
                      <thead>
                        <th>
                          <?php echo $this->lang->line('date'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('name'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('charge_type'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('charge_category'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('qty'); ?>
                        </th>
                        <th class="text-right">
                          <?php echo $this->lang->line('standard_charge') . ' (' . $currency_symbol . ')'; ?> </th>
                        <th class="text-right">
                          <?php echo $this->lang->line('tpa_charge') . ' (' . $currency_symbol . ')';?>
                        </th>
                        <th class="text-right">
                          <?php echo $this->lang->line('tax'); ?>
                        </th>
                        <th class="text-right">
                          <?php echo $this->lang->line('applied_charge') . ' (' . $currency_symbol . ')'; ?>
                        </th>
                        <th class="text-right">
                          <?php echo $this->lang->line('amount') . ' (' . $currency_symbol . ')'; ?>
                        </th>
                        <th class="text-right noExport">
                          <?php echo $this->lang->line('action') ?>
                        </th>
                      </thead>
                      <tbody>
                        <?php $total = 0; if (!empty($charges_detail)) {
                                                  foreach ($charges_detail as $charges_key => $charges_value) {
                                                      $tax_amount = ($charges_value['apply_charge']*$charges_value['tax']/100) ;
                                                      $taxamount = amountFormat($tax_amount);
                                                      $total += $charges_value["amount"]; ?>
                        <tr>
                          <td>
                            <?php echo $this->customlib->YYYYMMDDHisTodateFormat($charges_value['date'],$this->customlib->getHospitalTimeFormat()); ?>
                          </td>
                          <td class="">
                            <?php echo $charges_value["name"]; ?>
                            <div class="bill_item_footer text-muted">
                              <label><?php if($charges_value["note"] !=''){ echo $this->lang->line('charge_note').': ';} ?></label>
                              <?php echo $charges_value["note"]; ?>
                            </div>
                          </td>
                          <td style="text-transform: capitalize;">
                            <?php echo $charges_value["charge_type"] ?>aqui esta todo</td>
                          <td style="text-transform: capitalize;">
                            <?php echo $charges_value["charge_category_name"] ?>
                          </td>
                          <td style="text-transform: capitalize;">
                            <?php echo $charges_value['qty']." ".$charges_value["unit"]; ?>
                          </td>
                          <td class="text-right">
                            <?php echo $charges_value["standard_charge"] ?>
                          </td>
                          <td class="text-right">
                            <?php echo $charges_value["org_charge"] ?>
                          </td>
                          <td class="text-right">
                            <?php echo "(".$charges_value["tax"]."%) ".$taxamount ;?>
                          </td>
                          <td class="text-right">
                            <?php echo $charges_value["apply_charge"] ?>
                          </td>
                          <td class="text-right">
                            <?php echo $charges_value["amount"] ?>
                          </td>
                          <td class="text-right">
                            <a href="javascript:void(0);" class="btn btn-default btn-xs print_charge" data-toggle="tooltip" title="" data-loading-text="<?php echo $this->lang->line('please_wait') ;?>" data-record-id="<?php echo $charges_value['id']; ?>" data-original-title="<?php echo $this->lang->line('print');?>">
                                                          <i class="fa fa-print"></i>
                                                          </a>
                            <?php 
                                                          if($is_discharge){
                                                              if ($this->rbac->hasPrivilege('opd_charges', 'can_edit')) { ?>
                            <a href='javascript:void(0);' class='btn btn-default btn-xs edit_charge' data-loading-text='<?php echo $this->lang->line(' please_wait ') ;?>' data-toggle='tooltip' data-record-id='<?php echo $charges_value[' id ']; ?>' title="<?php echo  $this->lang->line('edit')?>">
                                                                  <i class='fa fa-pencil'></i>
                                                                </a>
                            <?php } } if ($this->rbac->hasPrivilege('opd_charges', 'can_delete')) {
                                                              if($is_discharge){ ?>
                            <a href="javascript:void(0);" onclick="deleteOpdPatientCharge('<?php echo $charges_value['id']; ?>')" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('delete'); ?>">
                                                                  <i class="fa fa-trash"></i>
                                                                </a>
                            <?php } }?>
                          </td>
                        </tr>
                        <?php } } ?>
                      </tbody>
                      <tr class="box box-solid total-bg">
                        <td colspan='10' class="text-right">
                          <?php echo $this->lang->line('total') . " : " . $currency_symbol . "" . amountFormat($total); ?>
                          <input type="hidden" id="charge_total" name="charge_total" value="<?php echo $total ?>">
                        </td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- -->
                <!--payment -->
                <?php } if ($this->rbac->hasPrivilege('opd_payment', 'can_view')) { ?>
              
<!--                 <div class="tab-pane" id="payment">
                  <div class="box-tab-header">
                    <div style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                      <h4 class="box-tab-title" style="margin:0px; padding:15px;">Información de los pagos</h4>
                    </div>
                  </div>
                  <div class="box-tab-header">
                    <h3 class="box-tab-title">
                      <?php echo $this->lang->line('payments'); ?>
                    </h3>
                    <?php if ($this->rbac->hasPrivilege('opd_payment', 'can_add')) {
                                            if($is_discharge){ ?>
                    <div class="box-tab-tools">
                      <a href="#" class="btn btn-sm dropdown-toggle addpayment" style="background:#1563b0;color:#fff;" data-toggle='modal'><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_payment'); ?></a>
                    </div>
                    <?php } } ?>
                  </div>
                  <div class="download_label">
                    <?php echo $this->lang->line('payments'); ?>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover example">
                      <thead>
                        <th>
                          <?php echo $this->lang->line('transaction_id'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('date'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('note'); ?>
                        </th>
                        <th>
                          <?php echo $this->lang->line('payment_mode'); ?>
                        </th>
                        <th class="text-right">
                          <?php echo $this->lang->line('paid_amount') . " (" . $currency_symbol . ")"; ?>
                        </th>

                        <th class="text-right noExport">
                          <?php echo $this->lang->line('action') ?>
                        </th>
                      </thead>
                      <tbody>

                        <?php
                                          $total_payment = 0;
                                              if (!empty($payment_details)) {
                                                  $total_payment = 0;
                                                  foreach ($payment_details as $payment) {
                                                      if (!empty($payment['amount'])) {
                                                          $total_payment += $payment['amount'];

                                                      } ?>
                          <tr>
                            <td>
                              <?php echo $this->customlib->getSessionPrefixByType('transaction_id').$payment['id']; ?>
                            </td>
                            <td>
                              <?php echo $this->customlib->YYYYMMDDHisTodateFormat($payment['payment_date'],$this->customlib->getHospitalTimeFormat()); ?>
                            </td>
                            <td>
                              <?php echo $payment["note"] ?>
                            </td>
                            <td>
                              <?php echo $this->lang->line(strtolower($payment["payment_mode"]))."<br>";

                                                          if($payment['payment_mode'] == "Cheque"){
                                                               if($payment['cheque_no']!=''){
                                         echo $this->lang->line('cheque_no') . ": ".$payment['cheque_no'];

                                      echo "<br>";
                                  }
                                      if($payment['cheque_date']!='' && $payment['cheque_date']!='0000-00-00'){
                                         echo $this->lang->line('cheque_date') .": ".$this->customlib->YYYYMMDDTodateFormat($payment['cheque_date']);
                                     }


                                       }
                                                          ?>


                            </td>
                            <td class="text-right">
                              <?php echo $payment["amount"] ?>
                            </td>

                            <td class="text-right">
                              <?php         if ($payment['payment_mode'] == "Cheque" && $payment['attachment'] != "")  {
                                                                                  ?>
                              <a href='<?php echo site_url(' admin/transaction/download/ '.$payment['id ']);?>' class='btn btn-default btn-xs' title='<?php echo $this->lang->line(' download '); ?>'><i class='fa fa-download'></i></a>
                              <?php
                                                                              }
                                                                           ?>

                                <a href="javascript:void(0);" class="btn btn-default btn-xs print_trans" data-toggle="tooltip" title="" data-loading-text="<?php echo $this->lang->line('please_wait') ;?>" data-record-id="<?php echo $payment['id']; ?>" data-original-title="<?php echo $this->lang->line('print') ;?>">
                                                                      <i class="fa fa-print"></i>
                                                                  </a>
                                <?php if (!empty($payment["document"])) { ?>
                                <a href="<?php echo base_url(); ?>admin/payment/download/<?php echo $payment[" document "]; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                                                      <i class="fa fa-download"></i>
                                                                  </a>
                                <?php } ?>

                                <a href="javascript:void(0);" class="btn btn-default btn-xs editpayment" data-toggle="tooltip" title="" data-payment-amount="<?php echo $payment[" amount "] ?>" data-record-id="<?php echo $payment['id']; ?>" data-original-title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>

                                <?php
                                                               if($is_discharge){ 
                                                              if ($this->rbac->hasPrivilege('opd_payment', 'can_delete')) { ?>
                                  <a href="javascript:void(0);" onclick="deletePayment('<?php echo $payment['id']; ?>')" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash"></i></a>
                                  <?php } } ?>
                            </td>
                          </tr>

                          <?php } }?>
                      </tbody>
                      <tr class="box box-solid total-bg">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">
                          <?php echo $this->lang->line('total') . " : " . $currency_symbol . "" . number_format((float)$total_payment, 2, '.', ''); ?>
                        </td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                </div> -->
                <!-- -->
                <?php } ?>
                <!-- ------- -->
                <div class="tab-pane" id="timeline">
                  <!------------------------------------Incapacidad------------------------- -->
                  <div class="box-tab-header">
                    <div style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                      <h4 class="box-tab-title" style="margin:0px; padding:15px;">Información Incapacidad</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="">
                      <form method="post" action="<?= base_url('admin/Patient/saveInability/'.$result['result']["patient_id"].'/'.$result['result']['id'])?>" onsubmit="return validarFormulario()">
                        <!--                                   <div class="col-lg-12 col-md-4 col-sm-4">
                                      <div class="form-group">
                                          <label>Incapacidad Numero</label>
                                          <div class="input-group"> 
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                    <i class="fas fa-users"></i></span> 
                                                <input type="text" name="id_inability" id="" class="form-control" 
                                                       placeholder="" autocomplete="off" 
                                                       value="Nº de incapacidad  <?= $contador ?>" style="border-radius: 0px 10px 10px 0px !important; width:250px;" <?= $result_state_readonly?>>
                                                <span class="text-danger"></span>
                                          </div> 
                                      </div>
                                    </div> -->
                        <div class="col-4 col-md-4 col-sm-4">
                          <div class="form-group">
                            <label>Fecha Inicial:</label>
                            <div class="input-group" style="margin:;">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                    <?= $inabilityQuery ?>
                                                    <i class="fa fa-calendar-check-o"></i></span>
                              <input type="date" for="fechaInicial" name="inability_initial_date" id="myDateInput" class="form-control" placeholder="" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                              <span class="text-danger"></span>
                            </div>
                            <p class="text-danger" id="pUnoFecha" style="display:none;">se nesecita la fecha inicial</p>
                          </div>
                        </div>
                        <div class="col-4 col-md-4 col-sm-4" style="">
                          <div class="form-group">
                            <label>Fecha Final:</label>
                            <div>
                              <div class="input-group" style="margin:;">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-calendar-check-o"></i></span>
                                <input type="date" name="inability_final_date" id="endDate" placeholder="" class="form-control" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                <span class="text-danger"></span>
                              </div>
                              <p class="text-danger" id="pDosFecha" style="display:none;">se nesecita la fecha final</p>
                            </div>
                          </div>
                        </div>
                        <!-------------------/.row dater------------------- -->
                        <div class="col-4 col-md-4 col-sm-4" style="">
                          <div class="form-group">
                            <label>Duración:</label>
                            <div>
                              <div class="input-group" style="margin:;">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa fa-calendar"></i></span>
                                <input type="text" for="fechaFinal" name="inability_duration" id="duracion" placeholder="Tiempo de Incapacidad" class="form-control" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                <span class="text-danger"></span>
                              </div>
                              <p class="text-danger" for="fechaFinal" id="pDuracion" style="display:none;">Necesita una duración*</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-4 col-md-4 col-sm-4" style="margin-left:; margin-top: 15px; ">
                          <div class="form-group">
                            <!--                        Custom Field, identity_gender     -> address                             -->
                            <label for="address">Tipo de Incapacidad:</label>
                            <div class="input-group">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-wheelchair"></i></span>
                              <select name="inability_type_disability" class="form-control" id="tipoIncapacidad" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                          <option value="" selected hidden><?php echo $this->lang->line('select'); ?></option>
                                          <option value="01: Enfermedad General" >Enfermedad General</option>
                                          <option value="02: Enfermedad Profesional" >Enfermedad Profesional</option>
                                          <option value="03: Accidente de Trabajo">Accidente de Trabajo</option>
                                          <option value="05: Licencia de Maternidad">Licencia de Maternidad</option>
                                         <option value="05: Licencia de Paternidad">Licencia de Paternidad</option>
                                      </select>
                            </div>
                          </div>
                          <p class="text-danger" id="pTipoIncapacidad" style="display:none;">Se necesita el tipo de incapacidad*</p>
                        </div>
                        <div class="col-4 col-md-4 col-sm-4" style="margin-left:; margin-top: 15px; ">
                          <div class="form-group">
                            <label for="address">Clasificacion:</label>
                            <div class="input-group">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-line-chart"></i></span>
                              <select name="inability_classification" class="form-control" id="Clasificacion" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                          <option value="" selected hidden><?php echo $this->lang->line('select'); ?></option>
                                          <option value="01: Inicial" <?php if (set_value('address') == "01: Masculino") echo "selected"; ?>>Inicial</option>
                                          <option value="02: Prorroga" <?php if (set_value('address') == "02: Femenino") echo "selected"; ?>>Prorroga</option>
                                      </select>
                            </div>
                          </div>
                          <p class="text-danger" id="pClasificacion" style="display:none;">Es necesario una Clasificación*</p>
                        </div>
                        <div class="col-4 col-md-4 col-sm-4" style="margin-left:; margin-top: 15px; ">
                          <div class="form-group">
                            <label for="address">Diagnóstico:</label>
                            <div class="input-group">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-bullhorn"></i></span>
                              <select name="inability_diagnosis" id="diagnosticoUno" class="form-control" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                          <option value="" hidden>Diagnosticos</option>
                                          <?php foreach ($diagnosis as $key =>$s): ?>
                                           <option value="<?= $s->nombre_diag; ?>"><?= $s->nombre_diag; ?></option>

                                          <?php endforeach ?>
                                        </select>
                            </div>
                          </div>
                          <p class="text-danger" id="pDiagnostico" style="display:none;">Nesecita un Diagnostico para proseguir*</p>
                        </div>
                        <!-----------------/. diagnostico----------- -->
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Observaciones:</label>
                            <textarea style="height:50px" name="inability_observation" class="form-control" id="observaciones" <?= $result_state_readonly?> ></textarea>
                          </div>
                          <p class="text-danger" id="pObservaciones" style="display:none;">Por favor, ingrese un Diagnóstico*</p>
                        </div>
                        <div class="col-sm-12 mt-5" style="">
                          <button id="" type="submit" class='btn pull-right' style="background:#1563b0; color:#fff;" <?= $result_state_disabled?> onclick=validarFormulario()>
                           <i class="fa fa-edit"></i> Guardar </button>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12 itemcol" style="margin-top:20px;">
                      <div class="blood-body">
                        <div class="blood-pull-left blood-title">Incapacidades de esta visita</div>
                      </div>
                      <div class="box box-primary">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                  <thead>
                                    <tr>
                                      <th>Nº </th>
                                      <th>Fecha Inicial</th>
                                      <th>Fecha Final</th>
                                      <th>Duración:</th>
                                      <th>Tipo de Incapacidad</th>
                                      <th>Clasificacion</th>
                                      <th>Diagnóstico</th>
                                      <th>Observaciones</th>
                                      <!--                                                                 <th>Acciones</th> -->
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($inabilities as $inability) { ?>
                                    <tr>
                                      <td>
                                        <?php echo $inability->id_inability; ?>
                                      </td>
                                      <td>
                                        <?php echo $inability->inability_initial_date; ?>
                                      </td>
                                      <td>
                                        <?php echo $inability->inability_final_date; ?>
                                      </td>
                                      <td>
                                        <?php echo $inability->inability_duration; ?>
                                      </td>
                                      <td>
                                        <?php echo $inability->inability_type_disability; ?>
                                      </td>
                                      <td>
                                        <?php echo $inability->inability_classification; ?>
                                      </td>
                                      <td>
                                        <?php echo $inability->inability_diagnosis; ?>
                                      </td>
                                      <td>
                                        <?php echo $inability->inability_observation; ?>
                                      </td>
                                      <!--                                                           <td width="18%" style="vertical-align:middle">
                                                                <div class="row" style="display:flex;">
                                                                    <div class="col">
                                                                        <div class="col">
                                                                            <a href="#" title="Referencia">
                                                                                <div class="text-center text-40" style="background-color: #68b068; margin: 5px; border-radius: 6px; width: 30px; height: 30px; display: flex; 
                                                                                            justify-content: center; align-items: center;">
                                                                                    <i class="fa fa-print fa-lg text-white"></i>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="col">
                                                                            <a href="#" title="Referencia">
                                                                                <div class="text-center text-40" style="background-color: #567eba; margin: 5px; border-radius: 6px; width: 30px; height: 30px; display: flex; 
                                                                                    justify-content: center; align-items: center;">
                                                                                    <i class="fa fa-calendar-check-o fa-lg text-white"></i>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="col">
                                                                            <a href="#" title="Referencia">
                                                                                <div class="text-center text-40" style="background-color: #bc8f37; margin: 5px; border-radius: 6px; width: 30px; height: 30px; display: flex; 
                                                                                    justify-content: center; align-items: center;">
                                                                                    <i class="fas fa-file-invoice fa-lg text-white"></i>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>  
                                                                </div>                                        
                                                            </td> -->
                                    </tr>
                                    <?php } ?>
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
                <div class="tab-pane" id="remisions">
                  <!----------------------------------------------------------- -->
                  <div class="box-tab-header">
                    <div style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                      <h4 class="box-tab-title" style="margin:0px; padding:15px;">Información remisiones</h4>
                    </div>
                  </div>
                  <div class="row">
                    
                    <form id="insert_remision" accept-charset="utf-8">
                      
                       <div class="col-lg-12 mb-5 pd-0" style="margin-bottom: 15px; padding: 0px;">

                          <div class="col-lg-6">
                              <label>Diagnóstico principal</label>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-stethoscope"></i></span>
                                <select class="form-control mt-2 " name="diagnosis_main" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                                    <option value="" hidden>Diagnosticos</option>
                                    <?php foreach ($diagnosis as $key =>$s): ?>
                                    <option value="<?= $s->nombre_diag; ?>"><?= ucfirst(strtolower($s->nombre_diag)); ?></option>
                                    <?php endforeach ?>
                                </select>
                              </div>
                          </div>

                          <div class="col-lg-6">
                            <label>Nombre del servicio</label>
                            <div class="input-group">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-user"></i></span>
                              <input type="text" class="form-control search_text" id="reps_name" onkeyup="sura_cups()" placeholder="Nombre del servicio" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;" <?= $result_state_readonly?>>
                              <span class="text-danger"></span>
                            </div>
                            <div class="usersearchlist mt-5">
                              <ul class="list-group scroll-container mb-3" style="position: absolute; z-index: 100; width: 100%;" id="result_sura_cups" hidden>
                              </ul>
                            </div>
                          </div>
                      
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Nombre remisión</label><small></small>
                            <div class="input-group">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-exchange-alt"></i></span>
                              <input type="text" class="form-control" autocomplete="off" id="remision_name" name="remision_name" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                            </div>
                          </div>
                        </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                              <label>Codigo remisión</label><small></small>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-exchange-alt"></i></span>
                                <input type="text" class="form-control" autocomplete="off" id="remision_code" name="remision_code" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                              </div>
                            </div>
                          </div>


                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="medication_indication">Motivo remisión</label>
                              <textarea class="form-control" name="remision_motive" autocomplete="off" style="resize: none;" <?= $result_state_readonly?>></textarea>
                              <span class="text-danger"></span>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="medication_indication">Tratamiento </label>
                              <textarea class="form-control" name="remision_treatment" autocomplete="off" style="resize: none;" <?= $result_state_readonly?>></textarea>
                              <span class="text-danger"></span>
                            </div>
                          </div>

                          <div style="margin-right: 10px;">
                            <div class="pull-right">
                              <button type="submit" id="insert_remisionbtn" class="btn pull-right" style="background:#1563b0; color:#fff;" autocomplete="off" <?= $result_state_disabled ?>><i class="fa fa-check-circle"></i> Guardar</button>
                            </div>
                          </div>

                     </div>
                  </form>

                  <div class="col-lg-12 mb-5 pd-0">
                    <div class="blood-body">
                      <div class="blood-pull-left blood-title">Remisiones realizadas en esta visita</div>
                    </div>
                    <div class="box box-primary">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="table-responsive mailbox-messages">
                              <table class="table table-hover table-striped">
                                <thead>
                                  <tr>
                                    <th>Fecha</th>
                                    <th>Nombre del servicio</th>
                                    <th>Motivo</th>
                                    <th>Tratamiento</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($remisions as $remision):?>
                                  <tr>
                                    <td>
                                      <?php echo $remision->create_at; ?>
                                    </td>
                                    <td>
                                      <?php echo $remision->remision_code; ?>
                                    </td>
                                    <td>
                                      <?php echo $remision->remision_motive; ?>
                                    </td>
                                    <td>
                                      <?php echo $remision->remision_treatment; ?>
                                    </td>
                                    <tr>
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

                <div class="tab-pane" id="position">
                  <!----------------------------------------------------------- -->
                  <div class="box-tab-header">
                    <div style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                      <h4 class="box-tab-title" style="margin:0px; padding:15px;">Información de los cargos</h4>
                    </div>
                  </div>
                  <div class="col" style="padding-top: 12px;">
                  </div>
                </div>

<!--                 <div class="tab-pane" id="chronology">
                  <div class="box-tab-header">
                    <div style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                      <h4 class="box-tab-title" style="margin:0px; padding:15px;">Información de la cronología</h4>
                    </div>
                  </div>
                  <div class="col" style="padding-top: 12px;">
                  </div>
                </div>
               -->
              
              
               
                 <div class="tab-pane" id="notas_medicas">
                    <div> <button id="myTimelineButton" class="btn btn-sm pull-right" style="background:#1563B0; color:#fff;" autocomplete="off">
                                                          <i class="fa fa-plus"></i> Agregar                                    </button>
                    </div>
                    <br>
                    <div class="timeline-header no-border">
                      <div id="timeline_list">
                        <div class="timeline-header no-border">
                                        <div id="timeline_list">
                                            <?php
                                        if (empty($timeline_list)) {
                                                ?>
                                               
                                            <?php } else {
        ?>
                                                <ul class="timeline timeline-inverse">

                                                    <?php $i=0 ;
                                                        foreach ($timeline_list as $key => $value) {

                                                             ++$i;
                                                            if($i <= $recent_record_count)
                                                            {
                                                            ?>
                                                        <li class="time-label">
                                                            <span class="bg-blue">    <?php echo $this->customlib->YYYYMMDDTodateFormat($value['timeline_date']); ?>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-list-alt bg-blue"></i>
                                                            <div class="timeline-item">

                                                                <?php if (!empty($value["document"])) {?>
                                                                    <span class="time"><a class="defaults-c text-right" data-toggle="tooltip" title="" href="<?php echo base_url() . "patient/dashboard/download_patient_timeline/" . $value["id"] . "/" . $value["document"] ?>" data-original-title="<?php echo $this->lang->line('download'); ?>"><i class="fa fa-download"></i></a></span>
                                                                <?php }?>
                                                                <h3 class="timeline-header text-aqua"> <?php echo $value['title']; ?> </h3>
                                                                <div class="timeline-body">
                                                                    <?php echo $value['description']; ?>

                                                                </div>

                                                            </div>
                                                        </li>
                                                    <?php } } ?>
                                                    <li><i class="fa fa-clock-o bg-gray"></i></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                        <br>
                        <div class="alert alert-info">ningún record fue encontrado</div>

                      </div>
                    </div>
                  </div>
              
              
            </div>
          </div>
      </section>
      </div>
      <!--new edit modal-->
      <div class="modal fade" id="editModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog pup100" role="document">
          <form id="formedit1" accept-charset="utf-8" enctype="multipart/form-data" method="post" class="ptt10">
            <div class="modal-content modal-media-content">
              <div class="modal-header modal-media-header">
                <button type="button" class="close pupclose" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                  <?php echo $this->lang->line('edit_visit_details'); ?>
                </h4>
              </div>

            </div>
            <!--./modal-header-->

            <div class="pup-scroll-area">
              <div class="modal-body pt0 pb0">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row row-eq">
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div id="ajax_load"></div>


                        <div class="row">
                          <div class="col-md-12">
                            <div class="dividerhr"></div>
                          </div>
                          <!--./col-md-12-->
                          <!--                                              <input type="hidden" name="visitid" id="visitid" class="form-control" />
                                                   <input type="hidden" name="visit_transaction_id" id="visit_transaction_id" class="form-control" />
                                                  <input type="hidden" name="type" id="type" value="visit" class="form-control" /> -->
                          <div class="col-sm-2 col-xs-4">
                            <div class="form-group">
                              <label for="pwd"><?php echo $this->lang->line('height'); ?></label>
                              <input id="edit_height" name="height" type="text" class="form-control" />
                            </div>
                          </div>
                          <div class="col-sm-2 col-xs-4">
                            <div class="form-group">
                              <label for="pwd"><?php echo $this->lang->line('weight'); ?></label>
                              <input id="edit_weight" name="weight" type="text" class="form-control" />
                            </div>
                          </div>
                          <div class="col-sm-2 col-xs-4">
                            <div class="form-group">
                              <label for="pwd"><?php echo $this->lang->line('bp'); ?></label>
                              <input name="bp" type="text" name="bp" class="form-control" id="edit_bp" />
                            </div>
                          </div>
                          <div class="col-sm-2 col-xs-4">
                            <div class="form-group">
                              <label for="pwd"><?php echo $this->lang->line('pulse'); ?></label>
                              <input id="edit_pulse" name="pulse" type="text" class="form-control" />
                            </div>
                          </div>
                          <div class="col-sm-2 col-xs-4">
                            <div class="form-group">
                              <label for="pwd"><?php echo $this->lang->line('temperature'); ?></label>
                              <input id="edit_temperature" name="temperature" type="text" class="form-control" />
                            </div>
                          </div>
                          <div class="col-sm-2 col-xs-4">
                            <div class="form-group">
                              <label for="pwd"><?php echo $this->lang->line('respiration'); ?></label>
                              <input name="respiration" class="form-control" id="edit_respiration" type="text" class="form-control" />
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="exampleInputFile">
                                                              <?php echo $this->lang->line('symptoms_type'); ?></label>
                              <div><select name='symptoms_type' id="act" class="form-control select2 act" style="width:100%">
                                                                  <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                                  <?php foreach ($symptomsresulttype as $dkey => $dvalue) {
                                                                      ?>
                                                                  <option value="<?php echo $dvalue["id"]; ?>"><?php echo $dvalue["symptoms_type"] ;?></option>

                                                              <?php } ?>
                                                              </select>
                              </div>
                              <span class="text-danger"><?php echo form_error('symptoms_type'); ?></span>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="exampleInputFile"> 
                                                              <?php echo $this->lang->line('symptoms') ; ?></label>
                              <div id="dd" class="wrapper-dropdown-3">
                                <input class="form-control filterinput" type="text">
                                <ul class="dropdown scroll150 section_ul">
                                  <li><label class="checkbox"><?php echo $this->lang->line('select'); ?></label></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              <label><?php echo $this->lang->line('symptoms_description'); ?></label>
                              <textarea class="form-control" id="symptoms_description" name="symptoms"></textarea>
                            </div>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label for="pwd"><?php echo $this->lang->line('note'); ?></label>
                              <textarea rows="3" class="form-control" id="edit_revisit_note" name="revisit_note"></textarea>
                            </div>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label for="email"><?php echo $this->lang->line('any_known_allergies'); ?></label>
                              <textarea name="known_allergies" rows="3" id="eknown_allergies" placeholder="" class="form-control"><?php echo set_value('address'); ?></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12 col-xs-12">
                              <div class="form-group">
                                <div id="customfield3"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--./row-->

                      </div>
                      <!--./col-md-8-->
                      <div class="col-lg-4 col-md-4 col-sm-4 col-eq ptt10">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label><?php echo $this->lang->line('appointment_date'); ?></label>
                              <small class="req"> *</small>
                              <input name="appointment_date" class="form-control datetime" id="appointmentdat" placeholder="" type="text" class="form-control datetime" />
                              <span class="text-danger"><?php echo form_error('appointment_date'); ?></span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleInputFile">
                                                          <?php echo $this->lang->line('case'); ?></label>
                              <div><input class="form-control" type='text' name="case" id="edit_case" />
                              </div>
                              <span class="text-danger"><?php echo form_error('case'); ?></span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleInputFile">
                                                          <?php echo $this->lang->line('casualty'); ?></label>
                              <div>
                                <select name="casualty" id="edit_casualty" class="form-control">
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
                              <span class="text-danger"><?php echo form_error('case'); ?></span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleInputFile">
                                                          <?php echo $this->lang->line('old_patient'); ?></label>
                              <div>
                                <select name="old_patient" id="edit_oldpatient" class="form-control">
                                                                  <?php foreach ($yesno_condition as $yesno_key => $yesno_value) { ?>
                                                                      <option value="<?php echo $yesno_key ?>"  ><?php echo $yesno_value ?>
                                                                      </option>
                                                                  <?php } ?>
                                                              </select>
                              </div>
                              <span class="text-danger"><?php echo form_error('case'); ?></span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleInputFile">
                                                                  <?php echo $this->lang->line('tpa'); ?></label>
                              <div><select class="form-control" onchange="get_Charges(this.value)" id="edit_organisation" name='organisation'>
                                                                  <option value="0"><?php echo $this->lang->line('select'); ?></option>
                                                                  <?php foreach ($organisation as $orgkey => $orgvalue) {
                                                                      ?>
                                                                      <option value="<?php echo $orgvalue["id"]; ?>"><?php echo $orgvalue["organisation_name"] ?></option>   
                                                                  <?php } ?>
                                                              </select>
                              </div>
                              <span class="text-danger"><?php echo form_error('refference'); ?></span>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleInputFile">
                                                          <?php echo $this->lang->line('reference'); ?></label>
                              <div><input type="text" name="refference" class="form-control" id="edit_refference" />
                              </div>
                              <span class="text-danger"><?php echo form_error('refference'); ?></span>
                            </div>
                          </div>


                          <div class="col-sm-12">
                            <div class="form-group">
                              <label><?php echo $this->lang->line('consultant_doctor'); ?></label><small class="req"> *</small>
                              <select onchange="" name="consultant_doctor" <?php if ($disable_option==true) { echo "disabled"; } ?> style="width:100%" class="form-control select2" id="edit_consdocto">
                                                                  <option value=""><?php echo $this->lang->line('select'); ?></option>

                                                                  <?php foreach ($doctors as $dkey => $dvvalue) { ?>
                                                                      <option value="<?php echo $dvvalue["id"] ?>"><?php echo composeStaffNameByString($dvvalue["name"] , $dvvalue["surname"],$dvvalue["employee_id"]); ?></option>
                                                                  <?php } ?>
                                                              </select>
                              <?php if ($disable_option == true) { ?>
                              <input type="hidden" name="consultant_doctor" value="<?php echo $doctor_select ?>">
                              <?php } ?>
                            </div>
                            <span class="text-danger"><?php echo form_error('refference'); ?></span>
                          </div>


                          <div class="col-sm-6">
                            <div class="form-group">
                              <label><?php echo $this->lang->line('payment_date'); ?></label><small class="req"> *</small>

                              <input type="text" name="payment_date" id="edit_visit_payment_date" class="form-control datetime" autocomplete="off">
                              <input type="hidden" class="form-control" id="edit_visit_payment_id" name="edit_payment_id">
                              <span class="text-danger"></span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label><?php echo $this->lang->line('amount'). " (" . $currency_symbol . ")" ?></label><small class="req"> *</small> <input type="text" name="amount" id="edit_visit_payment" class="form-control" value="">

                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="pwd"><?php echo $this->lang->line('payment_mode'); ?></label>
                              <select class="form-control visit_payment_mode" name="payment_mode" id="visit_payment_mode">

                                                                  <?php foreach ($payment_mode as $key => $value) {
                                                                      ?>
                                                                      <option value="<?php echo $key ?>" <?php
                                                                      if ($key == 'cash') {
                                                                          echo "selected";
                                                                      }
                                                                      ?>><?php echo $value ?></option>
                                                                  <?php } ?>
                                                          </select>
                            </div>
                          </div>
                          <!--  <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label for="pwd"><?php echo $this->lang->line('paid_amount') . " (" . $currency_symbol . ")" ; ?></label><small class="req"> *</small> 
                                                      <input type="text" name="paid_amount" id="paid_amount" class="form-control">    
                                                      <span class="text-danger"><?php echo form_error('paid_amount'); ?></span>
                                                  </div>
                                              </div> -->
                          <div class="cheque_div" style="display: none;">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label><?php echo $this->lang->line('cheque_no'); ?></label><small class="req"> *</small>
                                <input type="text" name="cheque_no" id="edit_visit_cheque_no" class="form-control">
                                <span class="text-danger"></span>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label><?php echo $this->lang->line('cheque_date'); ?></label><small class="req"> *</small>
                                <input type="text" name="cheque_date" id="edit_visit_cheque_date" class="form-control date">
                                <span class="text-danger"></span>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label><?php echo $this->lang->line('attach_document'); ?></label>
                                <input type="file" class="filestyle form-control" name="document">
                                <span class="text-danger"><?php echo form_error('document'); ?></span>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label><?php echo $this->lang->line('payment_note'); ?></label>
                              <input type="text" name="note" id="edit_visit_payment_note" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <!--./row-->
                      </div>
                      <!--./col-md-4-->
                    </div>
                    <!--./row-->
                  </div>
                  <!--./col-md-12-->
                </div>
                <!--./row-->
              </div>
            </div>

            <div class="box-footer sticky-footer">
              <div class="pull-right">
                <button type="submit" id="formeditbtn1" name="save" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle" ></i> <span><?php echo $this->lang->line('save'); ?></span></button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- end new added modal-->


      <!-- Add Charges -->
      <div class="modal fade" id="edit_chargeModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-media-content">
            <div class="box-tab-header">
              <div style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca; background-blend-mode: multiply,multiply; color:#fff;">
                <h4 class="box-tab-title" style="margin:0px; padding:15px;">Información de los cargos</h4>
              </div>
            </div>
            <form id="edit_charges" accept-charset="utf-8" method="post" class="ptt10">
              <div class="scroll-area">
                <div class="modal-body pt0">

                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                      <input type="hidden" name="opd_id" value="<?php echo $result['id'] ?>">
                      <input type="hidden" name="patient_charge_id" id="editpatient_charge_id" value="0">
                      <input type="hidden" name="organisation_id" id="editorganisation_id" value="<?php echo $visitdata['organisation_id'] ?>">

                      <div class="row">

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('charge_type'); ?></label><small class="req"> *</small>

                            <select name="charge_type" id="editcharge_type" class="form-control editcharge_type select2" style="width:100%">
                                                  <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                  <?php foreach ($charge_type as $key => $value) {
                                                      ?>
                                                      <option value="<?php echo $value->id; ?>">
                                                      <?php echo $value->charge_type; ?>
                                                      </option>
                                                  <?php } ?>
                                              </select>
                            <span class="text-danger"><?php echo form_error('charge_type'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('charge_category'); ?></label><small class="req"> *</small>

                            <select name="charge_category" id="editcharge_category" style="width: 100%" class="form-control select2 editcharge_category">
                                                  <option value=""><?php echo $this->lang->line('select'); ?></option>
                                              </select>
                            <span class="text-danger"><?php echo form_error('charge_category'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('charge_name'); ?></label><small class="req"> *</small>
                            <select name="charge_id" id="editcharge_id" style="width: 100%" class="form-control editcharge select2 ">
                                                  <option value=""><?php echo $this->lang->line('select'); ?></option>
                                              </select>
                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('standard_charge') . " (" . $currency_symbol . ")" ?></label>
                            <input type="text" readonly name="standard_charge" id="editstandard_charge" class="form-control" value="<?php echo set_value('standard_charge'); ?>">

                            <span class="text-danger"><?php echo form_error('standard_charge'); ?></span>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('tpa_charge') . " (" . $currency_symbol . ")" ?></label>
                            <input type="text" readonly name="schedule_charge" id="editscd_charge" placeholder="" class="form-control" value="<?php echo set_value('schedule_charge'); ?>">
                            <span class="text-danger"><?php echo form_error('schedule_charge'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('qty'); ?></label><small class="req"> *</small>
                            <input type="text" name="qty" id="editqty" class="form-control" value="1">
                            <span class="text-danger"><?php echo form_error('qty'); ?></span>
                          </div>
                        </div>
                      </div>

                      <div class="divider"></div>

                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('date'); ?></label> <small class="req"> *</small>

                            <input id="editcharge_date" name="date" placeholder="" type="text" class="form-control datetime" />
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="row">

                            <div class="col-sm-12">
                              <div class="form-group">
                                <label><?php echo $this->lang->line('charge_note'); ?></label>
                                <textarea name="note" id="edit_note" rows="3" class="form-control"></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--./col-sm-6-->


                        <div class="col-sm-6">

                          <table class="printablea4">


                            <tr>
                              <th width="40%">
                                <?php echo $this->lang->line('total') . " (" . $currency_symbol . ")"; ?>
                              </th>
                              <td width="60%" colspan="2" class="text-right ipdbilltable">
                                <input type="text" placeholder="Total" value="0" name="apply_charge" id="editapply_charge" style="width: 30%; float: right" class="form-control total" readonly /></td>
                            </tr>
                            <tr>
                              <th>
                                <?php echo $this->lang->line('tax') . " (" . $currency_symbol . ")"; ?>
                              </th>
                              <td class="text-right ipdbilltable">
                                <h4 style="float: right;font-size: 12px; padding-left: 5px;"> %</h4>
                                <input type="text" placeholder="<?php echo $this->lang->line('tax'); ?>" name="charge_tax" id="editcharge_tax" class="form-control charge_tax" readonly style="width: 70%; float: right;font-size: 12px;" /></td>

                              <td class="text-right ipdbilltable">
                                <input type="text" placeholder="<?php echo $this->lang->line('tax'); ?>" name="tax" value="0" id="edittax" style="width: 50%; float: right" class="form-control tax" readonly/>

                              </td>
                            </tr>
                            <tr>
                              <th>
                                <?php echo $this->lang->line('net_amount') . " (" . $currency_symbol . ")"; ?>
                              </th>
                              <td colspan="2" class="text-right ipdbilltable">
                                <input type="text" placeholder="Net Amount" value="0" name="amount" id="editfinal_amount" style="width: 30%; float: right" class="form-control net_amount" readonly/></td>
                            </tr>
                          </table>


                        </div>

                      </div>
                      <!--./row-->
                    </div>

                  </div>
                </div>

              </div>
              <!-- scroll-area -->
              <div class="modal-footer">

                <button type="submit" data-loading-text="<?php echo $this->lang->line('processing') ?>" name="charge_data" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save') ?></button>

              </div>
            </form>

          </div>
        </div>

      </div>
      <div class="modal fade" id="add_chargeModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog pup100  " role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close pupclose" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                <?php echo $this->lang->line('add_charges'); ?>
              </h4>
            </div>
            <form id="add_charges" accept-charset="utf-8" method="post" class="ptt10">
              <div class="pup-scroll-area">
                <div class="modal-body pt0">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <input type="hidden" name="opd_id" value="<?php echo $result['id'] ?>">
                      <input type="hidden" name="patient_charge_id" id="patient_charge_id" value="0">
                      <input type="hidden" name="organisation_id" id="organisation_id" value="<?php echo $visitdata['organisation_id'] ?>">

                      <div class="row">
                        <div class="col-lg-12 mb-5 pd-0" style="margin-bottom: 15px; padding: 0px;">
                          <div class="col-lg-6">
                            <div class="mt-3">
                              <label>Buscar nombre del cargo</label>
                              <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control search_text" id="search_procedure" onkeyup="busqueda()" placeholder="Buscar cargo" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;">
                                <span class="text-danger"></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label class="displayblock"><?php echo $this->lang->line('charge_type'); ?><small class="req"> *</small></label>
                            <select name="charge_type" id="add_charge_type" class="form-control charge_type select2" style="width: 100%">
                                                  <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                  <?php foreach ($charge_type as $key => $value) { ?>
                                                  <option value="<?php echo $value->id; ?>">
                                                  <?php echo $value->charge_type; ?>
                                                  </option>
                                                  <?php } ?>
                                              </select>
                            <span class="text-danger"><?php echo form_error('charge_type'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('charge_category'); ?></label><small class="req"> *</small>
                            <select name="charge_category" id="charge_category" style="width: 100%" class="form-control select2 charge_category">
                                                  <option value=""><?php echo $this->lang->line('select'); ?></option>
                                              </select>
                            <span class="text-danger"><?php echo form_error('charge_category'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('charge_name'); ?></label><small class="req"> *</small>
                            <select name="charge_id" id="charge_id" style="width: 100%" class="form-control addcharge select2 ">
                                                      <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                  </select>
                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('standard_charge') . " (" . $currency_symbol . ")" ?></label>
                            <input type="text" readonly name="standard_charge" id="addstandard_charge" class="form-control" value="<?php echo set_value('standard_charge'); ?>">
                            <span class="text-danger"><?php echo form_error('standard_charge'); ?></span>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('tpa_charge') . " (" . $currency_symbol . ")" ?></label>
                            <input type="text" readonly name="schedule_charge" id="addscd_charge" placeholder="" class="form-control" value="<?php echo set_value('schedule_charge'); ?>">
                            <span class="text-danger"><?php echo form_error('schedule_charge'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('qty'); ?></label><small class="req"> *</small>
                            <input type="text" name="qty" id="qty" class="form-control" value="1">
                            <span class="text-danger"><?php echo form_error('qty'); ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="divider"></div>
                      <div class="row">
                        <div class="col-sm-5">
                          <table class="printablea4">
                            <tr>
                              <th width="40%">
                                <?php echo $this->lang->line('total') . " (" . $currency_symbol . ")"; ?>
                              </th>
                              <td width="60%" colspan="2" class="text-right ipdbilltable">
                                <input type="text" placeholder="Total" value="0" name="apply_charge" id="apply_charge" style="width: 30%; float: right" class="form-control total" readonly /></td>
                            </tr>
                            <tr>
                              <th>
                                <?php echo $this->lang->line('tax') . " (" . $currency_symbol . ")"; ?>
                              </th>
                              <td class="text-right ipdbilltable">
                                <h4 style="float: right;font-size: 12px; padding-left: 5px;"> %</h4>
                                <input type="text" placeholder="<?php echo $this->lang->line('tax'); ?>" name="charge_tax" id="charge_tax" class="form-control charge_tax" readonly style="width: 70%; float: right;font-size: 12px;" /></td>
                              <td class="text-right ipdbilltable"><input type="text" placeholder="<?php echo $this->lang->line('tax'); ?>" name="tax" value="0" id="tax" style="width: 50%; float: right" class="form-control tax" readonly/></td>
                            </tr>
                            <tr>
                              <th>
                                <?php echo $this->lang->line('net_amount') . " (" . $currency_symbol . ")"; ?>
                              </th>
                              <td colspan="2" class="text-right ipdbilltable"><input type="text" placeholder="Net Amount" value="0" name="amount" id="final_amount" style="width: 30%; float: right" class="form-control net_amount" readonly/></td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-sm-4">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label><?php echo $this->lang->line('charge_note'); ?></label>
                                <textarea name="note" id="edit_note" rows="3" class="form-control edit_charge_note"></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--./col-sm-6-->
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('date'); ?></label> <small class="req"> *</small>
                            <input id="charge_date" name="date" placeholder="" type="text" class="form-control datetime" />
                          </div>
                          <button type="submit" data-loading-text="<?php echo $this->lang->line('processing') ?>" name="charge_data" value="add" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('add') ?></button>
                        </div>
                      </div>
                      <!--./row-->
                      <hr>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12" class="table-responsive ptt10">
                      <table class="table table-striped table-bordered table-hover">
                        <tr>
                          <th>
                            <?php echo $this->lang->line('date')?>
                          </th>
                          <th>
                            <?php echo $this->lang->line('charge_type')?>
                          </th>
                          <th>
                            <?php echo $this->lang->line('charge_category')?>
                          </th>
                          <th>
                            <?php echo $this->lang->line('charge_name')?>
                          </th>
                          <th class="text-right">
                            <?php echo $this->lang->line('standard_charge').' ('. $currency_symbol .')'; ?>
                          </th>
                          <th class="text-right">
                            <?php echo $this->lang->line('tpa_charge').' ('. $currency_symbol .')'; ?>
                          </th>
                          <th class="text-right">
                            <?php echo $this->lang->line('qty')?>
                          </th>
                          <th class="text-right">
                            <?php echo $this->lang->line('total').' ('. $currency_symbol .')'; ?>
                          </th>
                          <th class="text-right">
                            <?php echo $this->lang->line('tax').' ('. $currency_symbol .')'; ?>
                          </th>
                          <th class="text-right">
                            <?php echo $this->lang->line('net_amount').' ('. $currency_symbol .')'; ?>
                          </th>
                          <th class="text-right">
                            <?php echo $this->lang->line('action')?>
                          </th>
                        </tr>
                        <tbody id="preview_charges">

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- scroll-area -->
              <div class="modal-footer sticky-footer">
                <div class="pull-right">
                  <button type="submit" data-loading-text="<?php echo $this->lang->line('processing') ?>" value="save" name="charge_data" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save') ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Edit Operation Theatre -->

      <div class="modal fade" id="edit_operationtheatre" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-mid" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                <?php echo $this->lang->line("edit_operation"); ?>
              </h4>
            </div>
            <div class="scroll-area">
              <div class="modal-body pt0 pb0">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <form id="form_editoperationtheatre" accept-charset="utf-8" enctype="multipart/form-data" method="post" class="ptt10">
                      <div class="row">
                        <input type="hidden" value="<?php echo $opdid ?>" name="opdid" class="form-control" id="opdid" />
                        <input type="hidden" value="" name="otid" class="form-control" id="otid" />


                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('operation_category'); ?></label>
                            <small class="req"> *</small>
                            <select name="eoperation_category" id="eoperation_category" class="form-control select2" onchange="getcategory(this.value)" style="width:100%">
                                                      <option value=""><?php echo $this->lang->line('select') ?></option>
                                                      <?php foreach($categorylist as $operation){ ?>
                                                      <option value="<?php echo $operation['id']; ?>"><?php echo $operation['category']; ?></option>
                                                  <?php } ?>
                                                  </select>
                            <span class="text-danger"><?php echo form_error('operation_category'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('operation_name'); ?></label>
                            <small class="req"> *</small>

                            <div>
                              <select name="eoperation_name" id="eoperation_name" class="form-control select2" style="width:100%">
                                                      <option value=""><?php echo $this->lang->line('select') ?></option>
                                                      <?php foreach($operationlist as $operation){ ?>
                                                      <option value="<?php echo $operation['id']; ?>"><?php echo $operation['operation']; ?></option>
                                                  <?php } ?>
                                                  </select>
                            </div>
                            <span class="text-danger"><?php echo form_error('operation_name'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('operation_date'); ?></label>
                            <small class="req"> *</small>
                            <input type="text" value="" id="edate" name="date" class="form-control datetime">
                            <span class="text-danger"><?php echo form_error('date'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="exampleInputFile">
                                                      <?php echo $this->lang->line('consultant_doctor'); ?></label> <small class="req"> *</small>
                            <div>
                              <select class="form-control select2" <?php if ($disable_option==true) { echo "disabled"; } ?> style="width:100%" id='econsultant_doctorid' name='consultant_doctor' >
                                                          <option value="<?php echo set_value('consultant_doctor'); ?>"><?php echo $this->lang->line('select') ?></option>
                                                          <?php foreach ($doctors as $dkey => $dvalue) {
                                                              ?>
                                              <option value="<?php echo $dvalue["id"]; ?>" <?php
                                                                      if ((isset($doctor_select)) && ($doctor_select == $dvalue["id"])) {
                                                                          echo "selected";
                                                                      }
                                                                      ?>><?php echo composeStaffNameByString($dvalue["name"] , $dvalue["surname"],$dvalue["employee_id"]); ?></option>   
                                                                      <?php } ?>
                                                      </select>
                              <input type="hidden" id="econsultant_doctorname" name="consultant_doctor">
                            </div>
                            <span class="text-danger"><?php echo form_error('consultant_doctor'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('assistant_consultant') . " " . '1'; ?></label>
                            <input type="text" name="ass_consultant_1" id="eass_consultant_1" class="form-control">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('assistant_consultant') . " " . '2'; ?></label>
                            <input type="text" name="ass_consultant_2" id="eass_consultant_2" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('anesthetist'); ?></label>
                            <input type="text" name="anesthetist" id="eanesthetist" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('anesthesia_type'); ?></label>
                            <input type="text" name="anaethesia_type" id="eanaethesia_type" class="form-control">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('ot_technician'); ?></label>
                            <input type="text" name="ot_technician" id="eot_technician" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('ot_assistant'); ?></label>
                            <input type="text" value="" name="ot_assistant" id="eot_assistant" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('remark'); ?></label>
                            <textarea name="eot_remark" id="eot_remark" class="form-control"></textarea>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('result'); ?></label>
                            <textarea name="eot_result" id="eot_result" class="form-control"></textarea>
                          </div>
                        </div>
                        <div id="custom_fields_ot">

                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- scroll-area -->
            <div class="modal-footer">
              <div class="pull-right">
                <button type="submit" id="form_editoperationtheatrebtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>


      <div class="modal fade" id="confirm_appointment" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-mid" role="document">
          <div class="modal-dialog" style=" max-width: 360px; width: 90%;" role="document">
            <div class="modal-content modal-media-content">
              <div class="modal-header modal-media-header">
                <button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Finalizar cita</h4>
              </div>
              <form id="status_opd" accept-charset="utf-8" method="post" class="ptt10">
                <div class="modal-body pt0 pb0" style="background-image: url('<?php echo base_url("uploads/staff_images/imagneRotoComprimida.webp "); ?>'); background-size: contain; background-repeat: no-repeat; background-position: right center;">
                  <strong class="mb-3">
                       ¿Desea finalizar la atención para el paciente?
                     </strong>
                  <p>
                    Antes de finalizar esta consulta<br>revisa detalladamente la
                    <br> información registrada en la<br> historia clínica.
                    <!--                       Antes de considerar la firma, revisa minuciosamente la información<br> en la historia clínica para asegurarte de que todos los<br>
                        detalles relevantes estén registrados de manera precisa.<br> Esto incluye síntomas, diagnósticos,
                        tratamientos, medicamentos,<br> resultados de exámenes y cualquier otra información<br>pertinente. -->
                  </p>
                  <div class="row">
                    <div class="form-group">
                      <div class="col-sm-7">
                        <label class=" control-label">Firmar Historia Clínica</label>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="form-group">
                          <label>Firma digital</label>
                          <input type="file" class="filestyle form-control" name="digital_signature">
                          <div style="margin-top: 8px;text-align-last: center;">
                            <img src="<?php echo base_url("uploads/staff_documents/".$doctor_app[0]->doctor."/otherdocument".$doctor_app[0]->doctor.".png"); ?>" style="width:140px">
                          </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" id="status_opd_btn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" style="margin-left: 10px; color:#fff; background:#1563B0 !important;" class="btn btn-info pull-right">Finalizar</button>
                  <button type="button" style="color:#fff; background:#1563B0 !important;" class="btn btn-info pull-right" data-dismiss="modal">Cancelar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="myaddMedicationModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-mid" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                <?php echo $this->lang->line("add_medication_dose"); ?>
              </h4>
            </div>
            <form id="add_medication" accept-charset="utf-8" method="post" class="ptt10">
              <div class="modal-body pt0 pb0">
                <div class="row">
                  <div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                      <input type="text" name="date" id="date" class="form-control date">
                      <span class="text-danger"><?php echo form_error('date'); ?></span>
                      <input type="hidden" name="opdid" value="<?php echo $opdid ?>">
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label for="pwd"><?php echo $this->lang->line("time"); ?></label><small class="req"> *</small>
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
                  <div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line("medicine_category"); ?></label><small class="req"> *</small>
                      <select class="form-control medicine_category_medication select2" style="width:100%" id="mmedicine_category_id" name='medicine_category_id'>
                                                  <option value="<?php echo set_value('medicine_category_id'); ?>"><?php echo $this->lang->line('select') ?>
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
                  <div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line("medicine_name"); ?></label><small class="req"> *</small>
                      <select class="form-control select2 medicine_name_medication" style="width:100%" id="mmedicine_id" name='medicine_name_id'>
                                                  <option value=""><?php echo $this->lang->line('select') ?>
                                                      </option>
                                                  </select>
                      <span class="text-danger"><?php echo form_error('medicine_name_id'); ?></span>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line("dosage"); ?></label><small class="req"> *</small>
                      <select class="form-control select2 dosage_medication" style="width:100%" id="dosage" onchange="get_dosagename(this.value)" name='dosage'>
                                                  <option value=""><?php echo $this->lang->line('select') ?>
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

              <div class="modal-footer">
                <button type="submit" id="add_medicationbtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="myMedicationModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-mid" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                <?php echo $this->lang->line("add_medication_dose"); ?>
              </h4>
            </div>
            <form id="add_medicationdose" accept-charset="utf-8" method="post" class="ptt10">
              <div class="modal-body pt0 pb0">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                      <input type="text" name="date" id="add_dose_date" class="form-control date">
                      <span class="text-danger"><?php echo form_error('date'); ?></span>
                      <input type="hidden" name="opdid" value="<?php echo $opdid ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="pwd"><?php echo $this->lang->line("time"); ?></label><small class="req"> *</small>
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
                      <label><?php echo $this->lang->line("medicine_category"); ?></label><small class="req"> *</small>
                      <select class="form-control medicine_category_medication select2" style="width:100%" id="add_dose_medicine_category" name='medicine_category_id'>
                                      <option value=""><?php echo $this->lang->line('select') ?>
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
                      <label><?php echo $this->lang->line("medicine_name"); ?></label><small class="req"> *</small>
                      <select class="form-control select2 medicine_name_medication" style="width:100%" id="add_dose_medicine_id" name='medicine_name_id'>
                                      <option value=""><?php echo $this->lang->line('select') ?>
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
              <div class="modal-footer">
                <button type="submit" id="add_medicationdosebtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="myMedicationDoseModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-mid" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modalicon">
                <?php if ($this->rbac->hasPrivilege('opd_medication', 'can_delete')) { ?>
                <div id='edit_delete_medication'></div>
                <?php } ?>
              </div>
              <h4 class="modal-title">
                <?php echo  $this->lang->line("edit_medication_dose"); ?>
              </h4>
            </div>
            <form id="update_medication" accept-charset="utf-8" method="post" class="ptt10">
              <div class="modal-body pt0 pb0">
                <input type="hidden" name="medication_id" id="medication_id" value="">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                      <input type="text" name="date" id="date_edit_medication" class="form-control date">
                      <span class="text-danger"><?php echo form_error('date'); ?></span>
                      <input type="hidden" name="opdid" value="<?php echo $opdid ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="pwd"><?php echo $this->lang->line("time"); ?></label><small class="req"> *</small>
                      <div class="bootstrap-timepicker">
                        <div class="form-group">
                          <div class="input-group">
                            <input type="text" name="time" class="form-control timepicker" id="dosagetime" value="<?php echo set_value('time'); ?>">
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
                      <label><?php echo $this->lang->line("medicine_category"); ?></label><small class="req"> *</small>
                      <select class="form-control medicine_category_medication select2" style="width:100%" id="mmedicine_category_edit_id" name='medicine_category_id'>
                                              <option value="<?php echo set_value('medicine_category_id'); ?>"><?php echo $this->lang->line('select') ?>
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
                      <label><?php echo $this->lang->line("medicine_name"); ?></label><small class="req"> *</small>
                      <select class="form-control select2 medicine_name_medication" style="width:100%" id="mmedicine_edit_id" name='medicine_name_id'>
                                              <option value=""><?php echo $this->lang->line('select') ?>
                                                  </option>
                                              </select>
                      <span class="text-danger"><?php echo form_error('medicine_name_id'); ?></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label><?php echo $this->lang->line("dosage"); ?></label><small class="req"> *</small>
                      <select class="form-control  select2" style="width:100%" id="medicine_dose_edit_id" name='dosage_id'>
                                          <option value="<?php echo set_value('dosage_id'); ?>"><?php echo $this->lang->line('select'); ?>
                                          </option>
                                          <?php foreach ($dosage as $key => $value) { ?>
                                          <option value="<?php echo $value["id"]; ?>"><?php echo $value["dosage"]." ".$value['unit'] ; ?>
                                                  </option>

                                          <?php } ?>
                                          </select>
                      <span class="text-danger"><?php echo form_error('dosage_id'); ?></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label><?php echo $this->lang->line("remarks"); ?></label>
                      <textarea name="remark" id="medicine_dosage_remark" class="form-control"></textarea>

                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" id="update_medicationbtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
              </div>

            </form>
          </div>
        </div>
      </div>
      <!-- -->


      <!--lab investigation modal-->
      <div class="modal fade" id="viewDetailReportModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-toggle="tooltip" title="<?php echo $this->lang->line('clase'); ?>" data-dismiss="modal">&times;</button>
              <div class="modalicon">
                <div id='action_detail_report_modal'>

                </div>
              </div>
              <h4 class="modal-title" id="modal_head"></h4>
            </div>
            <div class="modal-body ptt10 pb0">
              <div id="reportbilldata"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- end lab investigation modal-->


      <!-- Timeline -->
      <div class="modal fade" id="myTimelineModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-mid" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                Agregar Nota Médica
              </h4>
            </div>
            <div class="scroll-area">
              <div class="modal-body pt0 pb0">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <form id="add_timeline" accept-charset="utf-8" enctype="multipart/form-data" method="post" class="ptt10">
                      <div class="row">
                        <div class=" col-md-12">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('title'); ?></label><small class="req"> *</small>
                            <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $id ?>">
                            <input id="timeline_title" name="timeline_title" placeholder="" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('timeline_title'); ?></span>
                          </div>
                          <div class="form-group">
                            <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                            <input id="timeline_date" name="timeline_date" value="<?php echo set_value('timeline_date', date($this->customlib->getHospitalDateFormat())); ?>" placeholder="" type="text" class="form-control date" />
                            <span class="text-danger"><?php echo form_error('timeline_date'); ?></span>
                          </div>
                          <div class="form-group">
                            <label><?php echo $this->lang->line('description'); ?></label>
                            <textarea id="timeline_desc" name="timeline_desc" placeholder="" class="form-control"></textarea>
                            <span class="text-danger"><?php echo form_error('description'); ?></span>
                          </div>

                          <div class="form-group">
                            <label><?php echo $this->lang->line('attach_document'); ?></label>
                            <div><input id="timeline_doc_id" name="timeline_doc" placeholder="" type="file" class="filestyle form-control" data-height="40" value="<?php echo set_value('timeline_doc'); ?>" />
                              <span class="text-danger"><?php echo form_error('timeline_doc'); ?></span></div>
                          </div>
                          <div class="form-group">
                            <label class="vertical-align-middle"><?php echo $this->lang->line('visible_to_this_person'); ?></label>
                            <input id="visible_check" checked="checked" name="visible_check" value="yes" placeholder="" type="checkbox" />

                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="pull-right">
                <button type="submit" data-loading-text="<?php echo $this->lang->line('processing') ?>" id="add_timelinebtn" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>

              </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- -->

      <!-- Edit Timeline -->
      <div class="modal fade" id="myTimelineEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-mid" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                <?php echo $this->lang->line('edit_timeline'); ?>
              </h4>
            </div>
            <div class="scroll-area">
              <div class="modal-body pt0 pb0">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <form id="edit_timeline" accept-charset="utf-8" enctype="multipart/form-data" method="post" class="ptt10">
                      <div class="row">


                        <div class=" col-md-12">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('title'); ?></label><small class="req"> *</small>
                            <input type="hidden" name="patient_id" id="epatientid" value="">
                            <input type="hidden" name="timeline_id" id="etimelineid" value="">
                            <input id="etimelinetitle" name="timeline_title" placeholder="" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('timeline_title'); ?></span>
                          </div>
                          <div class="form-group">
                            <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                            <!-- <input id="etimelinedate" name="timeline_date" value="<?php echo set_value('timeline_date', date($this->customlib->getHospitalDateFormat())); ?>" placeholder="" type="text" class="form-control date"  />-->
                            <input type="text" name="timeline_date" class="form-control date" id="etimelinedate" />
                            <span class="text-danger"><?php echo form_error('timeline_date'); ?></span>
                          </div>
                          <div class="form-group">
                            <label><?php echo $this->lang->line('description'); ?></label>
                            <textarea id="timelineedesc" name="timeline_desc" placeholder="" class="form-control"></textarea>
                            <span class="text-danger"><?php echo form_error('description'); ?></span>
                          </div>

                          <div class="form-group">
                            <label><?php echo $this->lang->line('attach_document'); ?></label>
                            <div><input id="etimeline_doc_id" name="timeline_doc" placeholder="" type="file" class="filestyle form-control" data-height="40" value="<?php echo set_value('timeline_doc'); ?>" />
                              <span class="text-danger"><?php echo form_error('timeline_doc'); ?></span></div>
                          </div>
                          <div class="form-group">
                            <label class="vertical-align-middle"><?php echo $this->lang->line('visible_to_this_person'); ?></label>
                            <input id="evisible_check" name="visible_check" value="yes" placeholder="" type="checkbox" />

                          </div>
                        </div>


                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="pull-right">
                <button type="submit" data-loading-text="<?php echo $this->lang->line('processing') ?>" id="edit_timelinebtn" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="edit_prescription" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                <?php echo $this->lang->line('edit') . " " . $this->lang->line('prescription'); ?>
              </h4>
            </div>

            <div class="modal-body pt0 pb0" id="editdetails_prescription">
            </div>

          </div>
        </div>
      </div>

      <div class="modal fade" id="add_prescription" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog pup100" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close pupclose" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"></h4>
            </div>
            <form id="form_prescription" accept-charset="utf-8" enctype="multipart/form-data" method="post" class="">
              <div class="pup-scroll-area">
                <div class="modal-body pt0 pb0">

                </div>
                <!--./modal-body-->
              </div>
              <div class="modal-footer sticky-footer">
                <div class="pull-right">
                  <button type="submit" name="save_print" value="save_print" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info  btn-sm"><i class="fa fa-print"></i> <?php echo $this->lang->line('save_print'); ?>

                        <button type="submit" name="save" value="save" class="btn btn-primary btn-sm" id="form_prescriptionbtn" data-loading-text="<?php echo $this->lang->line('processing') ?>"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?> </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>


      <div class="modal fade" id="viewModal" role="dialog">
        <div class="modal-dialog modal-dialog modal-lg" role="document">
          <div class="modal-content ">
            <div class="modal-header">
              <button type="button" data-toggle="tooltip" data-original-title="Close" class="close" data-dismiss="modal">&times;</button>
              <div class="modalicon">
                <div id='edit_delete'>
                  <?php if ($this->rbac->hasPrivilege('revisit', 'can_edit')) { ?>
                  <a href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                  <?php
                          }

                          if ($this->rbac->hasPrivilege('revisit', 'can_delete')) {
                              ?>
                    <a href="#" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash"></i></a>
                    <?php } ?>
                </div>
              </div>
              <h4 class="modal-title">
                <?php echo $this->lang->line('visit_details'); ?>
              </h4>
            </div>

            <div class="modal-body pt0 pb0">

            </div>

          </div>
        </div>
      </div>

      <div class="modal fade" id="prescriptionview" tabindex="-1" role="dialog" aria-labelledby="follow_up">
        <div class="modal-dialog modal-mid modal-lg" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modalicon">
                <div id='edit_deleteprescription'>

                </div>
              </div>
              <h4 class="modal-title">
                <?php echo $this->lang->line('prescription'); ?>
              </h4>
            </div>
            <div class="modal-body pt0 pb0" id="getdetails_prescription">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="prescriptionviewmanual" tabindex="-1" role="dialog" aria-labelledby="follow_up">
        <div class="modal-dialog modal-mid modal-lg" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modalicon">
                <div id='edit_deleteprescriptionmanual'>

                </div>
              </div>
              <h4 class="modal-title">
                <?php echo $this->lang->line('prescription'); ?>
              </h4>
            </div>
            <div class="modal-body pt0 pb0" id="getdetails_prescriptionmanual">

            </div>
          </div>
        </div>
      </div>

      <!-- desarrollo dario editmodal-->
      <div class="modal fade" id="revisitModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close pupclose" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                <?php echo $this->lang->line('patient_details'); ?>
              </h4>
            </div>
            <!-- form edit by desarollo cliniverso -->
            <form id="formedit" accept-charset="utf-8" enctype="multipart/form-data" method="post">
              <div class="pup-scroll-area">
                <div class="modal-body pt0 pb0">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row row-eq">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div id="ajax_load"></div>
                          <div class="row ptt10 mb-2" style="margin: 10px;" id="patientDetails">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                              <input type="hidden" name="password" id="revisit_password">
                              <input type="hidden" name="patientid" id="pid">
                              <input type="hidden" id="patient_diag">
                              <input type="hidden" name="mobileno" id="pmobileno">
                              <input type="hidden" name="email" id="pemail">
                              <!--                                         <input type="hidden" id="quill_html" name="custom_fields[opd][34]"> -->
                              <input type="hidden" id="clasificacion_imc" name="custom_fields[opd][37]">
                              <input type="hidden" id="imc_f" name="custom_fields[opd][18]">
                              <!--                                         <input type="hidden" id="anteced" name="custom_fields[opd][34]"> -->
                              <input type="hidden" id="appoint_id_visit" value="<?php echo $appoint_id_visit; ?>" name="appoint_id_visit">
                              <input type="hidden" name="visitid" id="visitid" class="form-control" />
                              <input type="hidden" name="visit_transaction_id" id="visit_transaction_id" class="form-control" />
                              <input type="hidden" name="type" id="type" value="opd" class="form-control" />
                              <input type="hidden" name="opdid" id="ra" class="form-control" />
                              <input type="hidden" id="edit_consdoc" name="consultant_doctor" value="">

                              <ul class="singlelist">
                                <li class="pt5 text-primary" style="font-size:19px;font-weight: bold;">
                                  <span id="listname"></span> <span id="guardian"></span>
                                </li>
                              </ul>
                              <ul class="multilinelist" style="margin-bottom:5px; font-size:15px;">
                                <li>
                                  <i class="fas fa-venus-mars fa-lg text-primary" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('gender'); ?>"></i>
                                  <span id="rgender"></span>
                                </li>
                                <li>
                                  <i class="fas fa-ring fa-lg text-primary" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('marital_status'); ?>"></i>
                                  <span id="rmarital_status"></span>
                                </li>
                                <li>
                                  <i class="fas fa-hourglass-half fa-lg text-primary" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('age'); ?>"></i>
                                  <span id=""><?php echo $this->customlib->getPatientAge($result['result']['age'],$result['result']['month'],$result['result']['day']); ?></span>
                                </li>
                                <li>
                                  <i class="fa fa-archive fa-lg text-primary" data-toggle="tooltip" data-placement="top" title="Voluntad anticipada"></i>

                                  <?php foreach($custom_fields_data as $key=>$value):?>
                                  <?php if($value->custom_field_id == 28){?>
                                  <span id="voluntad_anticipada"><?php echo $value->field_value; ?></span>
                                  <?php } ?>
                                  <?php endforeach?>
                                </li>

                              </ul>
                              <ul class="multilinelist" style="margin-bottom:5px; font-size:15px;">
                                <li>
                                  <i class="fa fa-envelope fa-lg text-primary" data-toggle="tooltip" data-placement="right" title="<?php echo $this->lang->line('email'); ?>"></i>
                                  <span id="email"></span>

                                </li>
                                <li>
                                  <i class="fa fa-h-square fa-lg text-primary" data-toggle="tooltip" data-placement="right" title="Eps"></i>
                                  <?php foreach($custom_fields_data as $key=>$value):?>
                                  <?php if($value->custom_field_id == 12){?>
                                  <span id="eps_data"><?php echo $value->field_value; ?></span>
                                  <?php } ?>
                                  <?php endforeach?>

                                </li>
                                <li>
                                  <i class="fa fa-medkit fa-lg text-primary" data-toggle="tooltip" data-placement="right" title="Regimen especial"></i>

                                  <?php foreach($custom_fields_data as $key=>$value):?>
                                  <?php if($value->custom_field_id == 10){?>
                                  <span id="regimen"><?php echo $value->field_value; ?></span>
                                  <?php } ?>
                                  <?php endforeach?>
                                </li>



                              </ul>
                              <ul class="multilinelist" style="margin-bottom:5px; font-size:15px;">

                                <li>
                                  <i class="fas fa-id-card fa-lg text-primary" data-toggle="tooltip" data-placement="right" title="Número de identificación"></i>
                                  <span id="tpa_validity"></span> - <span>Documento:</span>&nbsp;<span id="identification_number"></span>

                                </li>

                              </ul>


                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                              <img width="115" height="115" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url(); ?><?php echo $file.img_time() ?>">
                            </div>
                            <!-- ./col-md-3 -->
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label><?php echo $this->lang->line('appointment_date'); ?></label>
                                <small class="req">*</small>
                                <input name="appointment_date" class="form-control" id="appointmentdate" placeholder="" type="text" readonly>

                                <span class="text-danger"><?php echo form_error('appointment_date'); ?></span>
                              </div>


                              <div class="form-group">
                                <label for="consultant_doctor">
                                                          <?php echo $this->lang->line('consultant_doctor'); ?></label><small class="req"> *</small>
                                <div><select name='consultant_doctor' id="edit_consdoctor" class="form-control select2" <?php if ($disable_option==true) { echo "disabled"; } ?> style="width:100%" disabled >
                                                              <option value=""><?php echo $doctor_select ?></option>
                                                              <?php foreach ($doctors as $dkey => $dvalue) {
                                                                  ?>
                                                                  <option value="<?php echo $dvalue["id"]; ?>" <?php
                                                                          if ((isset($doctor_select)) && ($doctor_select == $dvalue["id"])) {
                                                                              echo "selected";
                                                                          }
                                                                          ?> ><?php echo $dvalue["name"] . " " . $dvalue["surname"]." (".$dvalue["employee_id"].")" ?></option>   
                                                              <?php } ?>
                                                          </select>
                                  <?php if ($disable_option == true) { ?>
                                  <input type="hidden" name="consultant_doctor" value="<?php echo $doctor_select ?>">
                                  <?php } ?>
                                </div>
                                <span class="text-danger"><?php echo form_error('consultant_doctor'); ?></span>
                                <input id="edit_consdoc" type="hidden" name="consultant_doc">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-12 col-xs-12">
                              <div class="form-group">
                                <div id="customfield"></div>
                              </div>
                            </div>
                          </div>
                          <!--./row-->
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-eq ptt10" style="display:none;">
                          <div class="row">

                            <!--                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label for="revisit_case">
                                                      <?php echo $this->lang->line('case'); ?></label>
                                                      <div><input class="form-control" type='text' id="revisit_case" name='case' />
                                                      </div>
                                                      <span class="text-danger"><?php echo form_error('case'); ?></span>
                                                  </div>
                                              </div> -->
                            <!--                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label for="casualty">
                                                      <?php echo $this->lang->line('casualty'); ?></label>
                                                      <div>

                                                      <select name="casualty" class="form-control casualty">
                                                          <?php foreach ($yesno_condition as $yesno_key => $yesno_value) {
                                                              ?>
                                                              <option value="<?php echo $yesno_key ?>" <?php
                                                                      if ($yesno_key == 'no') {
                                                                          echo "selected";
                                                                      }
                                                                      ?> ><?php echo $yesno_value ?></option>
                                                              <?php } ?>
                                                      </select>
                                                      </div>
                                                      <span class="text-danger"><?php echo form_error('casualty'); ?></span>
                                                  </div>
                                              </div> -->
                            <!--                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label for="old_patient">
                                                      <?php echo $this->lang->line('old_patient'); ?></label>
                                                      <div>

                                                      <select name="old_patient" class="form-control">
                                                          <?php foreach ($yesno_condition as $yesno_key => $yesno_value) {
                                                              ?>
                                                              <option value="<?php echo $yesno_key ?>" <?php
                                                                      if ($yesno_key == 'no') {
                                                                          echo "selected";
                                                                      }
                                                                      ?> ><?php echo $yesno_value ?></option>
                                                              <?php } ?>
                                                      </select>
                                                      </div>
                                                      <span class="text-danger"><?php echo form_error('old_patient'); ?></span>
                                                  </div>
                                              </div> -->
                            <!--                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label for="rorganisation">
                                                              <?php echo $this->lang->line('tpa'); ?></label>
                                                      <div><select class="form-control" onchange="get_Charges(this.value)" id="rorganisation" name='organisation' >
                                                              <option value="0"><?php echo $this->lang->line('select') ?></option>
                                                              <?php foreach ($organisation as $orgkey => $orgvalue) {
                                                                  ?>
                                                                  <option value="<?php echo $orgvalue["id"]; ?>" <?php
                                                                          if ((isset($org_select)) && ($org_select == $orgvalue["id"])) {
                                                                              echo "selected";
                                                                          }
                                                                          ?>><?php echo $orgvalue["organisation_name"]  ;?></option>   
                                                              <?php } ?>
                                                          </select>
                                                      </div>
                                                      <span class="text-danger"><?php echo form_error('refference'); ?></span>
                                                  </div>
                                              </div>   -->

                            <!--                                             <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label for="revisit_refference">
                                                      <?php echo $this->lang->line('reference'); ?></label>
                                                      <div><input class="form-control" type='text' id="revisit_refference" name='refference' />
                                                      </div>
                                                      <span class="text-danger"><?php echo form_error('refference'); ?></span>
                                                  </div>
                                              </div> -->



                            <!--                                     <div class="col-md-6">
                                              <div class="form-group">
                                                  <label> <?php echo $this->lang->line('charge_category'); ?></label>
                                           <select name="charge_category" style="width: 100%" class="form-control charge_category select2">
                                              <option value=""><?php echo $this->lang->line('select'); ?></option>
                                              <?php foreach ($charge_category as $key => $value) {
                                                  ?>
                                                  <option value="<?php echo $value['id']; ?>">
                                                  <?php echo $value['name']; ?>
                                                  </option>
                                                  <?php } ?>
                                          </select>

                                                  <span class="text-danger"><?php echo form_error('charge_category'); ?></span>
                                              </div>
                                          </div>  -->

                            <!--                                             <div class="col-md-6">
                                                  <div class="form-group">
                                              <label><?php echo $this->lang->line('charge'); ?></label><small class="req"> *</small>
                                              <select name="charge_id" style="width: 100%" class="form-control charge select2">
                                              <option value=""><?php echo $this->lang->line('select')?></option>
                                              </select>
                                                      <span class="text-danger"><?php echo form_error('charge_id'); ?></span>
                                                  </div>
                                              </div> -->
                            <!--                                             <div class="col-md-6">
                                              <div class="form-group"> 
                                                      <label for="exampleInputEmail1"><?php echo $this->lang->line('tax'); ?></label>
                                                      <div class="input-group">
                                                          <input type="text" class="form-control right-border-none" name="percentage" id="percentage" readonly autocomplete="off">
                                                          <span class="input-group-addon "> %</span>
                                                      </div>
                                                  </div>
                                              </div> -->
                            <!--                                             <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label><?php echo $this->lang->line('standard_charge') . " (" . $currency_symbol . ")" ?></label>
                                                      <input type="text" readonly name="standard_charge" id="standard_charge" class="form-control" value="<?php echo set_value('standard_charge'); ?>"> 

                                                      <span class="text-danger"><?php echo form_error('standard_charge'); ?></span>
                                                  </div>
                                              </div>  -->
                            <!--                                             <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label><?php echo $this->lang->line('applied_charge') . " (" . $currency_symbol . ")" ?></label><small class="req"> *</small><input type="text" name="amount" id="apply_charge" onkeyup="update_amount(this.value)" class="form-control">    
                                                      <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                                                  </div>
                                              </div> -->
                            <!--                                             <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label><?php echo $this->lang->line('amount'). " (" . $currency_symbol . ")" ?></label><small class="req"> *</small><input type="text" name="apply_amount" readonly id="apply_amount" class="form-control">    

                                                  </div>
                                              </div> -->
                            <div class="col-sm-6" style="display:none;">
                              <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('payment_mode'); ?></label>
                                <select name="payment_mode" class="form-control payment_mode" hidden="hidden">
                                                          <?php foreach ($payment_mode as $payment_key => $payment_value) {
                                                              ?>
                                                              <option value="<?php echo $payment_key ?>" <?php
                                                                      if ($payment_key == 'cash') {
                                                                          echo "selected";
                                                                      }
                                                                      ?> ><?php echo $payment_value ?></option>
                                                              <?php } ?>
                                                      </select>
                              </div>
                            </div>

                            <div class="col-md-6" style="display:none;">
                              <div class="form-group">
                                <label><?php echo $this->lang->line('paid_amount'); ?></label><small class="req"> *</small>
                                <input type="text" name="paid_amount" id="paid_amount" class="form-control">
                                <span class="text-danger"></span>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6" style="display:none;">
                              <div class="billingbox text-center">
                                <a href="https://clinify.co/cliniverso_dev/admin/bill/issueblood">
                                  <div class="billingbox-icon"><i class="fas fa-tint"></i></div>
                                  <p>Problema de sangre</p>
                                </a>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6" style="border-radius: 10px;" style="display:none;">
                              <p>
                                <button class="btn btn-primary" style="display:none;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                      Button with data-target
                                                    </button>
                              </p>
                              <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                </div>
                              </div>
                            </div>
                            <div class="cheque_div" style="display: none;">

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $this->lang->line('cheque_no'); ?></label><small class="req"> *</small>
                                  <input type="text" name="cheque_no" id="cheque_no" class="form-control">
                                  <span class="text-danger"><?php echo form_error('cheque_no'); ?></span>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label><?php echo $this->lang->line('cheque_date'); ?></label><small class="req"> *</small>
                                  <input type="text" name="cheque_date" id="cheque_date" class="form-control date">
                                  <span class="text-danger"><?php echo form_error('cheque_date'); ?></span>
                                </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label for="document_file"><?php echo $this->lang->line('attach_document'); ?></label>
                                  <input type="file" id="document_file" class="filestyle form-control" name="document">
                                  <span class="text-danger"><?php echo form_error('document'); ?></span>
                                </div>
                              </div>
                            </div>

                            <?php if ($this->module_lib->hasActive('live_consultation')) { ?>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="live_consult">
                                                        <?php echo $this->lang->line('live_consultation'); ?></label>
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
                            <?php  } ?>

                          </div>
                          <!--./row-->
                        </div>
                        <!--./col-md-4-->
                      </div>
                      <!--./row-->
                    </div>
                    <!--./col-md-12-->
                  </div>
                  <!--./row-->
                </div>
              </div>
              <div class="box-footer sticky-footer">

                <div class="pull-right">
                  <button type="button" data-dismiss="modal" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-info pull-right" style="background:#1563B0 !important; color:#fff;"><i class="fa fa-check-circle" ></i> <span><?php echo $this->lang->line('save'); ?></span></button>
                </div>

                <div class="pull-right" style="margin-right: 10px; ">
                  <button type="button" data-dismiss="modal" data-loading-text="<?php echo $this->lang->line('processing') ?>" name="save_print" class="btn btn-info pull-right printsavebtn" style="background:#1563B0 !important; color:#fff;"><i class="fa fa-print"></i> Cerrar e imprimir</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- -->

      <div class="modal fade" id="myModaledit" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                <?php echo $this->lang->line('patient_details'); ?>
              </h4>
            </div>
            <!--./modal-header-->
            <form id="formeditpa" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
              <div class="modal-body pt0 pb0">
                <input id="eupdateid" name="updateid" placeholder="" type="hidden" class="form-control" value="" />
                <div class="row row-eq">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row ptt10">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>
                          <input id="ename" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>" />
                          <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label><?php echo $this->lang->line('guardian_name') ?></label>
                          <input type="text" name="guardian_name" id="eguardian_name" placeholder="" value="" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label> <?php echo $this->lang->line('gender'); ?></label>
                              <select class="form-control" name="gender" id="egenders">
                                                              <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                              <?php
                                                              foreach ($genderList as $key => $value) {
                                                                  ?>
                                                                  <option value="<?php echo $key; ?>" <?php if (set_value('gender') == $key) echo "selected"; ?>><?php echo $value; ?></option>
                                                                  <?php
                                                              }
                                                              ?>
                                                          </select>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="dob"><?php echo $this->lang->line('date_of_birth'); ?></label>
                              <input type="text" name="dob" id="birth_date" placeholder="" class="form-control date patient_dob" />
                              <?php echo set_value('dob'); ?>
                            </div>
                          </div>

                          <div class="col-sm-5" id="calculate">
                            <div class="form-group">
                              <label><?php echo $this->lang->line('age').' ('.$this->lang->line('yy_mm_dd').')'; ?> </label><small class="req"> *</small>
                              <div style="clear: both;overflow: hidden;">
                                <input type="text" placeholder="<?php echo $this->lang->line('year'); ?>" name="age[year]" id="age_year" value="" class="form-control patient_age_year" style="width: 30%; float: left;">

                                <input type="text" id="age_month" placeholder="<?php echo $this->lang->line('month'); ?>" name="age[month]" value="" class="form-control patient_age_month" style="width: 36%;float: left; margin-left: 4px;">
                                <input type="text" id="age_day" placeholder="<?php echo $this->lang->line('day'); ?>" name="age[day]" value="" class="form-control patient_age_day" style="width: 26%;float: left; margin-left: 4px;">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--./col-md-6-->
                      <div class="col-md-6 col-sm-12">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label> <?php echo $this->lang->line('blood_group'); ?></label>
                              <select class="form-control" id="blood_groups" name="blood_group">
                                                              <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                              <?php
                                                                  foreach ($bloodgroup as $key => $value) {
                                                                      ?>
                                                                    <option value="<?php echo $key; ?>" <?php if (set_value('blood_group') == $key) {
                                                                      echo "selected";
                                                                     }
                                                                  ?>><?php echo $value; ?></option>
                                                                  <?php
                                                                  }
                                                              ?>
                                                          </select>
                              <span class="text-danger"><?php echo form_error('blood_group'); ?></span>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="pwd"><?php echo $this->lang->line('marital_status'); ?></label>
                              <select name="marital_status" id="marital_statuss" class="form-control">
                                                              <option value=""><?php echo $this->lang->line('select') ?></option>
                                                              <?php foreach ($marital_status as $key => $value) {
                                                                  ?>
                                                                  <option value="<?php echo $value; ?>" <?php if (set_value('marital_status') == $key) echo "selected"; ?>><?php echo $value; ?></option>
                                                              <?php } ?>
                                                          </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleInputFile">
                                                              <?php echo $this->lang->line('patient') . " " . $this->lang->line('photo'); ?>
                                                          </label>
                              <div>
                                <input class="filestyle form-control-file" type='file' name='file' id="exampleInputFile" size='20' data-height="26" data-default-file="<?php echo base_url() ?>uploads/patient_images/no_image.png">
                              </div>
                              <span class="text-danger"><?php echo form_error('file'); ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--./col-md-6-->
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="pwd"><?php echo $this->lang->line('phone'); ?></label>
                          <input id="emobileno" autocomplete="off" name="contact" type="text" placeholder="" class="form-control" value="<?php echo set_value('mobileno'); ?>" />
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label><?php echo $this->lang->line('email'); ?></label>
                          <input type="text" placeholder="" id="eemail" value="<?php echo set_value('email'); ?>" name="email" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="address"><?php echo $this->lang->line('address'); ?></label>
                          <input name="address" id="eaddress" placeholder="" class="form-control" />
                          <?php echo set_value('address'); ?>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="pwd"><?php echo $this->lang->line('remarks'); ?></label>
                          <textarea name="note" id="enote" class="form-control"><?php echo set_value('note'); ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="email"><?php echo $this->lang->line('any_known_allergies'); ?></label>
                          <textarea name="known_allergies" id="eknown_allergies" placeholder="" class="form-control"><?php echo set_value('address'); ?></textarea>
                        </div>
                      </div>
                      <div class="" id="customfieldpatient">

                      </div>
                    </div>
                    <!--./row-->
                  </div>
                  <!--./col-md-8-->
                </div>
                <!--./row-->
              </div>

              <div class="modal-footer">
                <div class="pull-right">
                  <button type="submit" id="formeditpabtn" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-info"><?php echo $this->lang->line('save'); ?></button>
                </div>
              </div>
            </form>


          </div>
        </div>
      </div>
      <!-- discharged summary   -->
      <div class="modal fade" id="myModaldischarged" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modalicon">
                <div id='summary_print'>
                </div>
              </div>
              <h4 class="modal-title">
                <?php echo $this->lang->line('discharged') . " " . $this->lang->line('summary') ?>
              </h4>
              <div class="row">
              </div>
              <!--./row-->
            </div>
            <form id="formdishrecord" accept-charset="utf-8" enctype="multipart/form-data" method="post">
              <div class="modal-body pt0 pb0">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <div class="row row-eq">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="ptt10">
                          <div id="evajax_load"></div>
                          <div class="row" id="">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <ul class="multilinelist">
                                <li> <label for="pwd"><?php echo $this->lang->line('name'); ?></label>
                                  <span id="disevlistname"></span>
                                </li>
                                <li>
                                  <label for="pwd"><?php echo $this->lang->line('age'); ?></label>
                                  <span id="disevage"></span>
                                </li>
                                <li>
                                  <label for="pwd"><?php echo $this->lang->line('gender'); ?></label>
                                  <span id="disevgenders"></span>
                                </li>
                              </ul>
                              <ul class="multilinelist">
                                <li>
                                  <label><?php echo $this->lang->line('admission') . " " . $this->lang->line('date') ?></label>
                                  <span id="disedit_admission_date"></span>
                                </li>
                                <li>
                                  <label><?php echo $this->lang->line('discharged') . " " . $this->lang->line('date') ?></label>
                                  <span id="disedit_discharge_date"></span>
                                </li>
                              </ul>
                              <ul class="singlelist">
                                <li>
                                  <label><?php echo $this->lang->line('address')?></label>
                                  <span id="disevaddress"></span>
                                </li>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('diagnosis'); ?></label>
                                <input name="diagnosis" id='disdiagnosis' rows="3" class="form-control">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('operation'); ?></label>
                                <input name="operation" id='disoperation' class="form-control">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('note'); ?></label>
                                <textarea name="note" id='disevnoteipd' rows="3" class="form-control"><?php echo set_value('note'); ?></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="dividerhr"></div>
                            </div>
                            <!--./col-md-12-->
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('investigations'); ?></label>
                                <textarea name="investigations" id='disinvestigations' rows="3" class="form-control"><?php echo set_value('note'); ?></textarea>
                              </div>
                            </div>

                            <div class="col-sm-8">
                              <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('treatment_at_home'); ?></label>
                                <textarea name="treatment_at_home" id='distreatment_at_home' rows="3" class="form-control"><?php echo set_value('note'); ?></textarea>
                              </div>
                            </div>
                          </div>
                          <input name="patient_id" id="disevpatients_id" type="hidden">
                          <input type="hidden" id="disupdateid" name="updateid">
                          <input type="hidden" id="disopdid" name="opdid">
                        </div>
                      </div>
                    </div>
                    <!--./row-->
                  </div>
                  <!--./col-md-12-->
                </div>
                <!--./row-->
              </div>
              <div class="modal-footer">
                <div class="pull-right">
                  <button type="submit" id="formdishrecordbtn" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-info pull-right"> <?php echo $this->lang->line('save'); ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="patient_discharge" tabindex="-1" role="dialog" aria-labelledby="follow_up">
        <div class="modal-dialog modal-mid modal-lg" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modalicon">
                <div id='allpayments_print'>
                </div>
                <div id='deathdoc_download'>
                </div>
              </div>
              <h4 class="modal-title">
                <?php echo $this->lang->line('patient_discharge'); ?>
              </h4>
            </div>
            <div class="modal-body pb0" id="patient_discharge_result">

            </div>
          </div>
        </div>
      </div>
      <!-- discharged summary   -->

      <div class="modal fade" id="myPaymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-mid" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                <?php echo $this->lang->line('add_payment'); ?>
              </h4>
            </div>
            <form id="add_payment" accept-charset="utf-8" method="post" class="ptt10">
              <div class="">
                <div class="modal-body pt0 pb0">
                  <input type="hidden" name="opd_id" id="payment_opd_id" class="form-control" value="<?php echo $opdid; ?>">
                  <input type="hidden" name="case_reference_id" id="payment_opd_id" class="form-control" value="<?php echo $result['result']['case_reference_id']; ?>">
                  <input type="hidden" name="patient_id" value="<?php echo $id; ?>">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>

                            <input type="text" name="payment_date" id="date" class="form-control datetime" autocomplete="off">
                            <span class="text-danger"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?></label><small class="req"> *</small>

                            <input type="text" name="amount" id="amount" class="form-control" value="<?php echo number_format((float)($total-$total_payment), 2, '.', ''); ?>">
                            <input type="hidden" name="net_amount" class="form-control" value="<?php echo $total-$total_payment ; ?>">
                            <span class="text-danger"><?php echo form_error('amount'); ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('payment_mode'); ?></label>
                            <select class="form-control payment_mode" name="payment_mode">

                                  <?php foreach ($payment_mode as $key => $value) {
                                      ?>
                                      <option value="<?php echo $key ?>" <?php
                                      if ($key == 'cash') {
                                          echo "selected";
                                      }
                                      ?>><?php echo $value ?></option>
                                  <?php } ?>
                                  </select>
                            <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="row cheque_div" style="display: none;">

                        <div class="col-md-4">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('cheque_no'); ?></label><small class="req"> *</small>
                            <input type="text" name="cheque_no" id="cheque_no" class="form-control">
                            <span class="text-danger"><?php echo form_error('cheque_no'); ?></span>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('cheque_date'); ?></label><small class="req"> *</small>
                            <input type="text" name="cheque_date" id="cheque_date" class="form-control date">
                            <span class="text-danger"><?php echo form_error('cheque_date'); ?></span>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('attach_document'); ?></label>
                            <input type="file" class="filestyle form-control" name="document">
                            <span class="text-danger"><?php echo form_error('document'); ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label><?php echo $this->lang->line('note'); ?></label>
                            <input type="text" name="note" id="note" class="form-control" />
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- scroll-area -->
              <div class="modal-footer">
                <button type="submit" id="add_paymentbtn" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- -->
      <div class="modal fade" id="view_ot_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modalicon">


                <div id='action_detail_modal'>

                </div>


              </div>

              <h4 class="modal-title">
                <?php echo $this->lang->line('operation_details'); ?>
              </h4>
            </div>
            <div class="modal-body min-h-3">
              <div id="show_ot_data"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-mid" role="document">
          <div class="modal-content modal-media-content">
            <form id="editpaymentform" accept-charset="utf-8" method="post">
              <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modalicon">
                </div>

                <h4 class="modal-title">Alerta Medicamentos</h4>
              </div>
              <div class="modal-body ">

                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                      <div id="message_vade" class="col-md-12">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <div class="modal fade" id="editpayment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-mid" role="document">
          <div class="modal-content modal-media-content">
            <form id="editpaymentform" accept-charset="utf-8" method="post">
              <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modalicon">
                </div>

                <h4 class="modal-title">
                  <?php echo $this->lang->line('payment_details'); ?>
                </h4>
              </div>
              <div class="modal-body ">
                <!-- <div clas="row">
                       <div clas="col-md-12">
                          <label><?php echo $this->lang->line('amount'); ?></label> <span class="req">*</span>
                           <input type="text" class="form-control" id="edit_payment" name="edit_payment" >
                           <input type="hidden" class="form-control" id="edit_payment_id" name="edit_payment_id" >
                       </div>

                     </div> -->
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>


                          <input type="text" name="payment_date" id="payment_date" class="form-control datetime" autocomplete="off">
                          <input type="hidden" class="form-control" id="edit_payment_id" name="edit_payment_id">
                          <span class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?></label><small class="req"> *</small>

                          <input type="text" name="amount" id="edit_payment" class="form-control" value="">

                          <span class="text-danger"><?php echo form_error('amount'); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?php echo $this->lang->line('payment_mode'); ?></label>
                          <select class="form-control payment_mode" name="payment_mode" id="payment_mode">

                                                  <?php foreach ($payment_mode as $key => $value) {
                                                      ?>
                                                      <option value="<?php echo $key ?>" <?php
                                                      if ($key == 'cash') {
                                                          echo "selected";
                                                      }
                                                      ?>><?php echo $value ?></option>
                                                  <?php } ?>
                                                  </select>
                          <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="row cheque_div" style="display: none;">

                      <div class="col-md-4">
                        <div class="form-group">
                          <label><?php echo $this->lang->line('cheque_no'); ?></label><small class="req"> *</small>
                          <input type="text" name="cheque_no" id="edit_cheque_no" class="form-control">
                          <span class="text-danger"><?php echo form_error('cheque_no'); ?></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label><?php echo $this->lang->line('cheque_date'); ?></label><small class="req"> *</small>
                          <input type="text" name="cheque_date" id="edit_cheque_date" class="form-control date">
                          <span class="text-danger"><?php echo form_error('cheque_date'); ?></span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label><?php echo $this->lang->line('attach_document'); ?></label>
                          <input type="file" class="filestyle form-control" name="document">
                          <span class="text-danger"><?php echo form_error('document'); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label><?php echo $this->lang->line('note'); ?></label>
                          <input type="text" name="note" id="edit_payment_note" class="form-control" />
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" id="editpaymentbtn" data-loading-text="Processing..." class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- //========datatable start===== -->

      <!-- ----------------------datecurrent--------------- -->


      <script>
        // Obtener el elemento input
        var dateInput = document.getElementById('myDateInput');
        var dateInputEnd = document.getElementById('endDate')
        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().slice(0, 10);

        dateInput.value = formattedDate;
        dateInputEnd.value = formattedDate;
      </script>

      <script>
        function calcularDuracion() {
          var startDateValue = document.getElementById('myDateInput').value;
          var endDateValue = document.getElementById('endDate').value;

          var startDate = new Date(startDateValue);
          var endDate = new Date(endDateValue);

          if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
            document.getElementById('duracion').value = 'Por favor, ingresa fechas válidas.';
            return;
          }

          var oneDayInMillis = 24 * 60 * 60 * 1000; // Un día en milisegundos
          var difference = endDate - startDate;
          var days = Math.floor(difference / oneDayInMillis);

          // Sumar un día al resultado
          days += 1;

          document.getElementById('duracion').value = days + ' Días';
        }

        document.getElementById('endDate').addEventListener('change', calcularDuracion);
        document.getElementById('myDateInput').addEventListener('change', calcularDuracion);
      </script>

      <!-- ----------------------datecurrent--------------- -->

      <!-- ----------------------datecacualatio--------------- -->
      <script>
        function calcularFechas() {
          const numero = document.getElementById("duracion").value;
          if (!isNaN(numero)) {
            const hoy = new Date();
            const fechaInicial = new Date(hoy);
            const fechaFinal = new Date(hoy);

            fechaFinal.setDate(hoy.getDate() + parseInt(numero));

            // Formatear las fechas en formato "yyyy-mm-dd" para asignarlas a los inputs tipo date
            document.getElementById("myDateInput").valueAsDate = fechaInicial;
            document.getElementById("endDate").valueAsDate = fechaFinal;
          } else {
            alert("Por favor ingrese un número válido en la duración.");
            document.getElementById("duracion").value = "";
            document.getElementById("myDateInput").value = "";
            document.getElementById("endDate").value = "";
          }
        }

        document.getElementById('duracion').addEventListener('input', calcularFechas);
      </script>
      <!-- ---------------------/.-datecacualatio------------- -->

      <!-- -----------------Validation--------------------- -->
      <script>
        function validarFormulario() {
          var idDuracion = document.querySelector('input[name="inability_duration"]').value;
          var idInabilityTypeDisability = document.querySelector('select[name="inability_type_disability"]').value;
          var idInabilityClassification = document.querySelector('select[name="inability_classification"]').value;
          var idInabilityObservation = document.querySelector('textarea[name="inability_observation"]').value;
          var idDiagnosticoUno = document.querySelector('select[name="inability_diagnosis"]').value;

          var pDuracion = document.getElementById('pDuracion');
          var pTipoIncapacidad = document.getElementById('pTipoIncapacidad');
          var pClasificacion = document.getElementById('pClasificacion');
          var pObservaciones = document.getElementById('pObservaciones');
          var pDiagnosticoUno = document.getElementById('pDiagnostico');

          if (idDuracion.trim() === '') {
            pDuracion.style.display = 'block';
            return false;
          } else {
            pDuracion.style.display = 'none';
          }

          if (idInabilityTypeDisability.trim() === '') {
            pTipoIncapacidad.style.display = 'block';
            return false;
          } else {
            pTipoIncapacidad.style.display = 'none';
          }

          if (idInabilityClassification.trim() === '') {
            pClasificacion.style.display = 'block';
            return false;
          } else {
            pClasificacion.style.display = 'none';
          }

          if (idDiagnosticoUno.trim() === '') {
            pDiagnosticoUno.style.display = 'block';
            return false;
          } else {
            pDiagnosticoUno.style.display = 'none';
          }

          if (idInabilityObservation.trim() === '') {
            pObservaciones.style.display = 'block';
            return false;
          } else {
            pObservaciones.style.display = 'none';
          }


          return true;
        }
      </script>


      <!-- <script>
  function validarFormulario() {
      var idDuracion = document.getElementById("duracion").value;
      if(idDuracion === ''){
      var parrafo = document.getElementById("pDuracion");
          parrafo.style.display = "block";
      }

    var fechaIcapasiDAD = document.getElementById("tipoIncapacidad").value;
      if(fechaIcapasiDAD === ''){
      var parrafo = document.getElementById("pTipoIncapacidad");
          parrafo.style.display = "block";
      }


    var idClasificacion = document.getElementById("Clasificacion").value;
    var idDiagnostico = document.getElementById("diagnostico").value;
    var idObservaciones = document.getElementById("observaciones").value;
    }
  </script> -->
      <!-- -----------------and Validation-------------------->


      <script type="text/javascript">
        $(document).on('click', '.print_ot_bill', function() {
          var $this = $(this);
          var record_id = $this.data('recordId');
          $this.button('loading');
          $.ajax({
            url: '<?php echo base_url(); ?>admin/operationtheatre/print_otdetails',
            type: "POST",
            data: {
              'id': record_id
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');

            },
            success: function(res) {
              popup(res.page);
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
      </script>


      <!-- <script type="text/javascript">

  ( function ( $ ) {
       var opdid = "<?php echo $this->uri->segment(5); ?>"; 
       var patient_id = "<?php echo $this->uri->segment(4); ?>";
      'use strict';
      $(document).ready(function () {
          $('#view_ot_modal,#myPaymentModal,#viewModal,#add_chargeModal').modal({
            backdrop: 'static',
            keyboard: false,
            show:false
       })
          initDatatable('ajaxlist','admin/patient/getvisitdatatable/'+ opdid);


      }); 

  } ( jQuery ) )


  </script> -->

      <!-- //========datatable end===== -->

      <script type="text/javascript">
        var datetime_format = '<?php echo strtr($this->customlib->getHospitalDateFormat(true, true), ['
        d ' => '
        DD ', '
        m ' => '
        MM ', '
        Y ' => '
        YYYY ', '
        H ' => '
        hh ', '
        i ' => '
        mm ']) ?>';


        $(document).on('click', '.add-btn', function() {
          var s = "";
          s += "<div class='row'>";
          s += "<input name='rows[]' type='hidden' value='" + rows + "'>";
          s += "<div class='col-md-6'>";
          s += "<div class='form-group'>";
          s += "<label for='act'>Act</label>";
          s += "<select class='form-control act select2' id='act' name='act" + rows + "' data-row_id='" + rows + "'>";
          s += "<option value=''>--Select--</option>";
          s += $('#act-template').html();
          s += "</select>";
          s += "<small class='text text-danger help-inline'></small>";
          s += "</div>";
          s += "</div>";
          s += "<div class='col-md-5'>";
          s += "<label for='validationDefault02'>Section</label>";
          s += "<div id='dd' class='wrapper-dropdown-3'>";
          s += "<input class='form-control filterinput' type='text'>";
          s += "<ul class='dropdown scroll150 section_ul'>";
          s += "<li><label class='checkbox'>--Select--</label></li>";
          s += "</ul>";
          s += "</div>";
          s += "</div>";
          s += "<div class='col-md-1'>";
          s += "<div class='form-group'>";
          s += "<label for='removebtn'>&nbsp;</label>";
          s += "<button type='button' class='form-control btn btn-sm btn-danger remove_row'><i class='fa fa-remove'></i></button>";
          s += "</div>";
          s += "</div>";
          s += "</div>";
          $(".multirow").append(s);
          $('.select2').select2();
          link = 2;
          rows++;
        });
      </script>

      <script type="text/html" id="act-template">


        <?php foreach ($symptomsresulttype as $dkey => $dvalue) {
                                                              ?>
        <option value="<?php echo $dvalue[" id "]; ?>">
          <?php echo $dvalue["symptoms_type"] ;?>
        </option>
        <?php
      }
      ?>
      </script>

      <script>
        $(document).on('change', '.act', function() {
          $this = $(this);
          var sys_val = $(this).val();

          var row_id = $this.data('row_id');
          var section_ul = $(this).closest('div.row').find('ul.section_ul');

          var sel_option = "";
          $.ajax({
            type: 'POST',
            url: base_url + 'admin/patient/getPartialsymptoms',
            data: {
              'sys_id': sys_val,
              'row_id': row_id
            },
            dataType: 'JSON',
            beforeSend: function() {

              $('ul.section_ul').find('li:not(:first-child)').remove();
              $("div.wrapper-dropdown-3").removeClass('active');

            },
            success: function(data) {

              section_ul.append(data.record);

            },
            error: function(xhr) { // if error occured
              alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");

            },
            complete: function() {

            }
          });

        });
      </script>
      <script type="text/javascript">
        $(function() {

          $(".timepicker").timepicker({
            defaultTime: '12:00 PM'
          });
        });


        $(document).on('select2:select', '.medicine_category_medication', function() {
            var medicine_category = $(this).val();
            $('.medicine_name_medication').html("<option value=''><?php echo $this->lang->line('loading'); ?></option>");
            getMedicineForMedication(medicine_category, "");
            getMedicineDosageForMedication(medicine_category);
        });

        function getMedicineForMedication(medicine_category, medicine_id) {

          var div_data = "<option value=''><?php echo $this->lang->line('select'); ?></option>";
          if (medicine_category != "") {
            $.ajax({
              url: base_url + 'admin/pharmacy/get_medicine_name',
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
                $("#add_dose_medicine_id").val(medicine_id).trigger("change");
              }
            });
          }
        }

        function getMedicineDosageForMedication(medicine_category) {
          var div_data = "<option value=''><?php echo $this->lang->line('select'); ?></option>";
          if (medicine_category != "") {
            $.ajax({
              url: base_url + 'admin/pharmacy/get_medicine_dosage',
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
                  //console.log(res.dosage_unit);
                  $('#medicine_dosage_medication').val(res.dosage_unit);
                } else {

                }
              }
            });
        }


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
                  successMsg(data.message);
                  window.location.reload(true);
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


        $(document).ready(function(e) {
          $("#insert_medication").on('submit', (function(e) {
            e.preventDefault();
            $("#insert_medicationbtn").button('loading');
            $.ajax({
              url: "<?= base_url('admin/Patient/add_opd_prescription/'.$result['result']['patient_id'].'/'.$id_visit.'/'.$result['result']['id'])?>",
              type: "POST",
              data: new FormData(this),
              dataType: 'json',
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function() {
                $("#insert_medicationbtn").button('loading');
              },
              success: function(data) {

                if (data.status == "fail") {
                  var message = data.message;
                  $.each(data.error, function(index, value) {
                    message += `${value}<br>`;
                  });
                  errorMsg(message);
                } else {
                  localStorage.setItem('showAlert', data.message);
                  window.location.reload(true);
                }
                $("#insert_medicationbtn").button('reset');
              },
              error: function() {
                $("#insert_medicationbtn").button('reset');
              },

              complete: function() {
                $("#insert_medicationbtn").button('reset');
              }
            });
          }));
        });


        $("#insert_remision").on('submit', function(e) {
          e.preventDefault();

          $("#insert_remisionbtn").button('loading');

          $.ajax({
            url: "<?= base_url('admin/Patient/add_opd_remision/'.$result['result']["patient_id"].'/'.$id_visit.'/'.$result['result']['id'])?>",
            method: "POST",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
              console.log(result);

              if (result.status === "fail") {
                let message = "";
                $.each(result.errors, function(index, value) {
                  message += `${value}<br>`;
                });
                errorMsg(message);
              } else {
                localStorage.setItem('showAlert', result.message);
                window.location.reload(true);
              }
              $("#insert_remisionbtn").button('reset');
            },
            error: function(error) {
              console.log(error);
            }
          });
        });


        $("#add_paraclini").on('submit', function(e) {
          e.preventDefault();

          $("#add_paraclinibtn").button('loading');
          console.log("addclini");

          $.ajax({
            url: "<?= base_url('admin/Patient/add_paraclini/'.$result['result']["patient_id"].'/'.$id_visit.'/'.$result['result']['id'])?>",
            method: "POST",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
              console.log(result);

              if (result.status === "fail") {
                let message = "";
                $.each(result.errors, function(index, value) {
                  message += `${value}<br>`;
                });
                errorMsg(message);
              } else {
                localStorage.setItem('showAlert', result.message);
                window.location.reload(true);
              }
              $("#add_paraclinibtn").button('reset');
            },
            error: function(error) {
              console.log(error);
            }
          });
        });



        $(document).ready(function(e) {
          $("#add_procedure").on('submit', (function(e) {
            e.preventDefault();
            $("#add_procedurebtn").button('loading');
            $.ajax({
              url: "<?= base_url('admin/Patient/insert_procedure/'.$result['result']["patient_id"].'/'.$id_visit.'/'.$result['result']['id'])?>",
              type: "POST",
              data: new FormData(this),
              dataType: 'json',
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function() {
                $("#add_procedurebtn").button('loading');
              },
              success: function(data) {
                if (data.status == "fail") {
                  var message = data.message;
                  $.each(data.error, function(index, value) {
                    message += value+`<br>`;
                  });
                  errorMsg(message);
                } else {
                  //                       successMsg(data.message);
                  localStorage.setItem('showAlert', data.message);
                  window.location.reload(true);
                }
                $("#add_procedurebtn").button('reset');
              },
              error: function() {
                $("#add_procedurebtn").button('reset');
              },

              complete: function() {
                $("#add_procedurebtn").button('reset');
              }
            });
          }));
        });



        $(document).on('click', '.remove_row', function() {
          $this = $(this);
          $this.closest('.row').remove();

        });
        
        $(document).mouseup(function(e) {
          var container = $(".wrapper-dropdown-3"); // YOUR CONTAINER SELECTOR

          if (!container.is(e.target) // if the target of the click isn't the container...
            &&
            container.has(e.target).length === 0) // ... nor a descendant of the container
          {
            $("div.wrapper-dropdown-3").removeClass('active');
          }
        });

        $(document).on('click', '.filterinput', function() {

          if (!$(this).closest('.wrapper-dropdown-3').hasClass("active")) {
            $(".wrapper-dropdown-3").not($(this)).removeClass('active');
            $(this).closest("div.wrapper-dropdown-3").addClass('active');
          }


        });

        $(document).on('click', 'input[name="section[]"]', function() {
          $(this).closest('label').toggleClass('active_section');
        });

        $(document).on('keyup', '.filterinput', function() {

          var valThis = $(this).val().toLowerCase();
          var closer_section = $(this).closest('div').find('.section_ul > li');

          var noresult = 0;
          if (valThis == "") {
            closer_section.show();
            noresult = 1;
            $('.no-results-found').remove();
          } else {
            closer_section.each(function() {
              var text = $(this).text().toLowerCase();
              var match = text.indexOf(valThis);
              if (match >= 0) {
                $(this).show();
                noresult = 1;
                $('.no-results-found').remove();
              } else {
                $(this).hide();
              }
            });
          };
          if (noresult == 0) {
            closer_section.append('<li class="no-results-found">No results found.</li>');
          }
        });
        
      </script>
        
      <script type="text/javascript">
        function holdModal(modalId) {
          $("#report_document").dropify();
          $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
          });
        }


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

              $('#dosagetime').timepicker('setTime', timeConvert(data.time));

              $('select[id="medicine_dose_id"] option[value="' + data.medicine_dosage_id + '"]').attr("selected", "selected");
              $("#medicine_dose_edit_id").select2().select2('val', data.medicine_dosage_id);
              $("#mmedicine_category_edit_id ").val(data.medicine_category_id).trigger('change');
              getMedicineForMedication(data.medicine_category_id, data.pharmacy_id);
              $("#medicine_dosage_remark").val(data.remark);
              $("#medication_id").val(data.id);
              $('#edit_delete_medication').html("<a href='#' class='delete_record_dosage' data-record-id='" + medication_id + "' data-toggle='tooltip' title='<?php echo $this->lang->line('delete'); ?>' data-target='' data-toggle='modal'  data-original-title='<?php echo $this->lang->line('delete'); ?>'><i class='fa fa-trash'></i></a>");

              holdModal('myMedicationDoseModal');
            },
          });
        }

        $(document).ready(function(e) {

          $(document).on('click', '.delete_record_dosage', function() {
            if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
              var id = $(this).data('recordId');

              $.ajax({
                url: base_url + 'admin/patient/deletemedication',
                type: "POST",
                data: {
                  'id': id
                },
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(data) {
                  successMsg(data.message);
                  window.location.reload(true);
                },
                error: function() {
                  alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                },

                complete: function() {

                }
              });
            }
          });

          $("#add_medicationdose").on('submit', (function(e) {
            e.preventDefault();
            $("#add_medicationdosebtn").button('loading');
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/addmedicationdoseopd',
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
                  successMsg(data.message);
                  window.location.reload(true);
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

        $(document).ready(function(e) {
          $("#update_medication").on('submit', (function(e) {
            e.preventDefault();
            $("#update_medicationbtn").button('loading');
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/updatemedication',
              type: "POST",
              data: new FormData(this),
              dataType: 'json',
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function() {
                $("#update_medicationbtn").button('loading');
              },
              success: function(data) {
                if (data.status == "fail") {
                  var message = "";
                  $.each(data.error, function(index, value) {
                    message += value;
                  });
                  errorMsg(message);
                } else {
                  successMsg(data.message);
                  window.location.reload(true);
                }
                $("#update_medicationbtn").button('reset');
              },
              error: function() {
                $("#update_medicationbtn").button('reset');
              },

              complete: function() {
                $("#update_medicationbtn").button('reset');
              }
            });
          }));
        });


        $(function() {
          //Initialize Select2 Elements
          $(function() {
            var hash = window.location.hash;
            hash && $('ul.nav-tabs a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function(e) {
              $(this).tab('show');
              var scrollmem = $('body').scrollTop();
              window.location.hash = this.hash;
              $('html,body').scrollTop(scrollmem);
              var pid = $("#result_pid").val();
              var opdid = $("#result_opdid").val();
              if (this.hash == '#charges') {

              } else if (this.hash == '#payment') {

              } else if (this.hash == '#diagnosis') {

              }
            });
          });
        });


        function getdatavalue(dataurl) {

          var pid = $("#result_pid").val();
          var opdid = $("#result_opdid").val();
          var base_url = '<?php echo base_url(); ?>';
          var url = base_url + dataurl;
          $.ajax({
            url: url,
            type: 'POST',
            data: {
              pid: pid,
              opdid: opdid
            },
            success: function(result) {

              $('#datadiganosis').html(result);
            }
          });
        }

        $(function() {
          $("#compose-textareas,#compose-textareanew").wysihtml5({
            toolbar: {
              "image": false,
            }
          });
        });

        function edit_prescription(id) {
          //console.log(id);
          $.ajax({
            url: base_url + 'admin/prescription/editopdPrescription',
            dataType: 'JSON',
            data: {
              'prescription_id': id
            },
            type: "POST",
            beforeSend: function() {
              $('.modal-title', "#add_prescription").html('');

            },
            success: function(res) {
              $('.modal-title', "#add_prescription").html('<?php echo $this->lang->line('
                edit_prescription '); ?>');

              $('#prescriptionview').modal('hide');
              $('.modal-body', "#add_prescription").html(res.page);
              var medicineTable = $('.modal-body', "#add_prescription").find('table#tableID');
              medicineTable.find('.select2').select2();
              $('.modal-body', "#add_prescription").find('.multiselect2').select2({
                placeholder: 'Select',
                allowClear: false,
                minimumResultsForSearch: 2
              });


              medicineTable.find("tbody tr").each(function() {

                var medicine_category_obj = $(this).find("td select.medicine_category");
                var post_medicine_category_id = $(this).find("td input.post_medicine_category_id").val();
                var post_medicine_id = $(this).find("td input.post_medicine_id").val();
                var dosage_id = $(this).find("td input.post_dosage_id").val();
                var medicine_dosage = getDosages(post_medicine_category_id, dosage_id);

                $(this).find('.medicine_dosage').html(medicine_dosage);
                $(this).find('.medicine_dosage').select2().select2('val', dosage_id);

                getMedicine(medicine_category_obj, post_medicine_category_id, post_medicine_id);

              });
              $('#add_prescription').modal('show');
            },

            complete: function() {
              $(function() {
                $("#compose-textareas,#compose-textareanew").wysihtml5({
                  toolbar: {
                    "image": false,
                  }
                });
              });

            },
            error: function(xhr) { // if error occured
              alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");


            }
          });
        }

        function editDiagnosis(id) {
          //alert(patient_id);
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/editDiagnosis',
            type: "POST",
            data: {
              id: id
            },
            dataType: 'json',
            success: function(data) {
              // console.log(data);
              $("#eid").val(data.id);
              $("#epatient_id").val(data.patient_id);
              $("#ereporttype").val(data.report_type);
              $("#ereportdate").val(data.report_date);
              $("#edescription").val(data.description);
              $("#ereportcenter").val(data.report_center);
              holdModal('edit_diagnosis');

            },
          });
        }
        
        
        $(document).on('click', '.editot', function() {
          let id = $(this).data('recordId');
          $.ajax({
            url: '<?php echo base_url(); ?>admin/operationtheatre/getotDetails',
            type: "POST",
            data: {
              id: id
            },
            dataType: 'json',
            success: function(data) {
              console.log(data);
              $("#otid").val(data.id);

              $('#eoperation_category').select2().select2('val', data.category_id);

              getcategory(data.category_id, data.operation_id);
              $('#edate').datetimepicker({
                format: datetime_format,

              });

              $('#edate').data("DateTimePicker").date(new Date(data.date));


              $("#eass_consultant_1").val(data.ass_consultant_1);
              $("#eass_consultant_2").val(data.ass_consultant_2);
              $("#eanesthetist").val(data.anesthetist);
              $("#eanaethesia_type").val(data.anaethesia_type);
              $("#eot_technician").val(data.ot_technician);
              $("#eot_assistant").val(data.ot_assistant);
              $("#eot_remark").val(data.remark);
              $("#eot_result").val(data.result);

              $('#econsultant_doctorid').select2().select2('val', data.consultant_doctor);
              $('#custom_fields_ot').html(data.custom_fields_value);
              $('#eoperation_name').select2().select2('val', data.operation_id);
              holdModal('edit_operationtheatre');

            },
          });
        });


        $(document).ready(function(e) {
          $("#form_editoperationtheatre").on('submit', (function(e) {
            $("#form_editoperationtheatrebtn").button('loading');
            var cons = $("#cons_doctor").val();
            $("#cons_name").val(cons);
            e.preventDefault();
            var did = $("#econsultant_doctorid").val();

            $("#econsultant_doctorname").val(did);

            $.ajax({
              url: '<?php echo base_url(); ?>admin/operationtheatre/update',
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
                  successMsg(data.message);
                  window.location.reload(true);
                }
                $("#form_editoperationtheatrebtn").button('reset');
              },
              error: function() {

              }
            });
          }));
        });



        //     function getchargecode(charge_category) {
        //         var div_data = "";
        //         $('#code').html("<option value='l'><?php echo $this->lang->line('loading') ?></option>");
        //         $("#code").select2("val", 'l');


        //         $.ajax({
        //             url: '<?php echo base_url(); ?>admin/charges/getchargeDetails',
        //             type: "POST",
        //             data: {charge_category: charge_category},
        //             dataType: 'json',
        //             success: function (res) {

        //                 $.each(res, function (i, obj)
        //                 {
        //                     var sel = "";
        //                     div_data += "<option value='" + obj.id + "'>" + obj.code + " - " + obj.description + "</option>";

        //                 });

        //                 $('#code').html("<option value=''><?php echo $this->lang->line('select'); ?></option>");

        //                 $('#code').append(div_data);
        //                 $("#code").select2("val", '');

        //                 $('#standard_charge').val('');
        //                 $('#apply_charge').val('');
        //             }
        //         });
        //     }

        $(document).ready(function(e) {
          $("#form_editdiagnosis").on('submit', (function(e) {

            $("#form_editdiagnosisbtn").button('loading');
            e.preventDefault();
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/update_diagnosis',
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
                  successMsg(data.message);
                  window.location.reload(true);
                }
                $("#form_editdiagnosisbtn").button('reset');
              },
              error: function() {

              }
            });
          }));
        });


        // desarrollo cliniverso
        $(document).on('click', '.get_opd_detail', function() {
          var visitid = <?php echo $id_visit ?>;
          var opdid = <?php echo $opdid ?>;
          var $this = $(this);
          //alert(opdid)
          $.ajax({
            url: base_url + 'admin/patient/getopdDetails',
            type: "POST",
            data: {
              visit_id: visitid,
              opd_id: opdid
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');
            },
            success: function(data) {
              var patient_id = "<?php echo $result["
              id "] ?>";
              $('#edit_delete').html("<?php if ($this->rbac->hasPrivilege('revisit', 'can_edit')) { ?><a href='#'' onclick='editRecord(" + visitid + ");' data-target='#editModal' data-toggle='tooltip'  data-original-title='<?php echo $this->lang->line('edit'); ?>'><i class='fa fa-pencil'></i></a><?php } ?><?php if ($this->rbac->hasPrivilege('revisit', 'can_delete')) { ?><a href='#' data-toggle='tooltip'  onclick='delete_record(" + opdid + ")' data-original-title='<?php echo $this->lang->line('delete'); ?>'><i class='fa fa-trash'></i></a><?php } ?>");
              $('#viewModal .modal-body').html(data.page);
              $('#viewModal').modal('show');
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

//         $(document).on('click', '#add_newcharge', function() {

//         });

//         var table;

        // Function to initialize DataTable
//         function initDataTable() {
//           table = $('#diagnosticos').DataTable({
//             "paging": false,
//             "info": false,
//             "searching": false
//           });
//         }


        function editRecord(visitid) {


//           var $exampleDestroy = $('#edit_consdoctor').select2();
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getopdvisitdetails',
            //             url: '<?php echo base_url(); ?>admin/patient/getvisitdetailsdata',
            type: "GET",
            data: {
              visitid: visitid
            },
            dataType: 'json',
            success: function(data) {
              console.log(data);
//               $exampleDestroy.val(data.cons_doctor).select2('destroy').select2();
              $('#customfield').html(data.custom_fields_value);
              var textarea_reason = document.getElementById('reason');
              textarea_reason.textContent = data.reason_consultation;
              $('#rmarital_status').html(data.marital_status);
              $('#listname').html(data.patient_name);
              $('#guardian').html(data.guardian_name);
              $('#rgender').html(data.gender);
              $('#rage').html(data.patient_age);
              $('#ra').val(data.opd_details_id);
              $('#edit_consdoc').val(data.cons_doctor);
              $('#email').html(data.email);
              $('#tpa_validity').html(data.insurance_validity);
              $('#identification_number').html(data.identification_number);
              $('#patient_diag').val(data.patient_id);
              $("#appointmentdate").val(data.date);
              $('#visitid').val(visitid);
              $('#visit_transaction_id').val(data.transaction_id);
              $("#edit_case").val(data.case_type);
              $("#symptoms_description").val(data.symptoms);
              $("#edit_casualty").val(data.casualty);
              $("#edit_oldpatient").val(data.patient_old);
              $("#edit_refference").val(data.refference);
              $("#edit_revisit_note").val(data.note);
              $('select[id="edit_organisation"] option[value="' + data.organisation_id + '"]').attr("selected", "selected");
              $("#edit_height").val(data.height);
              $("#edit_weight").val(data.weight);
              $("#edit_bp").val(data.bp);
              $("#edit_pulse").val(data.pulse);
              $("#edit_temperature").val(data.temperature);
              $("#edit_respiration").val(data.respiration);
              $("#edit_paymentmode").val(data.payment_mode);
              $("#edit_opdid").val(data.opdid);
              $("#eknown_allergies").val(data.visit_known_allergies);
              $("#edit_visit_payment_date").val(data.payment_date);
              $("#edit_visit_payment").val(data.amount);
              $("#visit_payment_mode").val(data.payment_mode).prop('selected');
              $(".visit_payment_mode").trigger('change');
              $("#edit_visit_cheque_no").val(data.cheque_no);
              $("#edit_visit_cheque_date").val(data.cheque_date);
              $("#edit_visit_payment_note").val(data.payment_note);
              $("#viewModal").modal('hide');
              holdModal('revisitModal');
              get_diagnosis(data.opdid);
              imc();
              cie_structure();
            },
          });
        }

        function delete_record(id) {
          if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/deleteVisit/' + id,
              type: "POST",
              data: {
                id: id
              },
              dataType: 'json',
              success: function(data) {
                successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                window.location.reload(true);
              }
            })
          }
        }

        function deleteot(id) {
          if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
            $.ajax({
              url: '<?php echo base_url(); ?>admin/operationtheatre/delete/' + id,
              type: "POST",
              data: {
                id: id
              },
              dataType: 'json',
              success: function(data) {
                successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                window.location.reload(true);
              }
            });
          }
        }

        function delete_patient(id, patient_id) {
          if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/deleteOPDPatient',
              type: "POST",
              data: {
                'id': id
              },
              dataType: 'json',
              success: function(data) {
                successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                window.location.href = '<?php echo base_url() ?>admin/patient/profile/' + patient_id;
              }
            });
          }
        }

        function getEditRecord(id) {

          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getpatientDetails',
            type: "POST",
            data: {
              id: id
            },
            dataType: 'json',
            success: function(data) {
              $("#eupdateid").val(data.id);
              $('#customfieldpatient').html(data.custom_fields_value);
              $("#ename").val(data.patient_name);
              $("#eguardian_name").val(data.guardian_name);
              $("#emobileno").val(data.mobileno);
              $("#eemail").val(data.email);
              $("#eaddress").val(data.address);
              $("#age_year").val(data.age);
              $("#age_month").val(data.month);
              $("#age_day").val(data.day);
              $("#birth_date").val(data.dob);
              $("#enote").val(data.note);
              $("#exampleInputFile").attr("data-default-file", '<?php echo base_url() ?>' + data.image);
              $(".dropify-render").find("img").attr("src", '<?php echo base_url() ?>' + data.image);
              $("#eknown_allergies").val(data.known_allergies);
              $('select[id="blood_groups"] option[value="' + data.blood_bank_product_id + '"]').attr("selected", "selected");
              $('select[id="egenders"] option[value="' + data.gender + '"]').attr("selected", "selected");
              $('select[id="marital_statuss"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
              $("#myModal").modal('hide');
              holdModal('myModaledit');
            },
          });
        }

        function editTimeline(id) {
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/editTimeline',
            type: "POST",
            data: {
              id: id
            },
            dataType: 'json',
            success: function(data) {
              var date_format = '<?php echo $results = strtr($this->customlib->getHospitalDateFormat(), ['
              d ' => '
              dd ', '
              m ' => '
              MM ', '
              Y ' => '
              yyyy ',]) ?>';
              var dt = new Date(data.timeline_date).toString(date_format);
              $("#etimelineid").val(data.id);
              $("#epatientid").val(data.patient_id);
              $("#etimelinetitle").val(data.title);
              $("#etimelinedate").val(dt);

              $("#timelineedesc").val(data.description);
              if (data.status == '') {

              } else {
                $("#evisible_check").attr('checked', true);
              }

              holdModal('myTimelineEditModal');

            },
          });
        }

        function getRecordDischarged(id, opdid) {
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getopdDetailsSummary',
            type: "POST",
            data: {
              patient_id: id,
              opd_id: opdid
            },
            dataType: 'json',
            success: function(data) {

              $('#disevlistname').html(data.patient_name);
              $('#disevguardian').html(data.guardian_name);
              $('#disevlistnumber').html(data.mobileno);
              $('#disevemail').html(data.email);
              if (data.age == "") {
                $("#disevage").html("");
              } else {
                if (data.age) {
                  var age = data.age + " " + "Years";
                } else {
                  var age = '';
                }
                if (data.month) {
                  var month = data.month + " " + "Month";
                } else {
                  var month = '';
                }
                if (data.dob) {
                  var dob = "(" + data.dob + ")";
                } else {
                  var dob = '';
                }

                $("#disevage").html(age + "," + month + " " + dob);
              }
              $("#disevaddress").html(data.address);
              $("#disenote").html(data.note);
              $("#disevgenders").html(data.gender);
              $("#disevmarital_status").html(data.marital_status);
              $("#disedit_admission_date").html(data.appointment_date);
              $("#disedit_discharge_date").html(data.discharge_date);
              $("#disopdid").val(data.opdid);
              $("#disupdateid").val(data.summary_id);
              $("#disevpatients_id").val(data.pid);
              $("#disinvestigations").val(data.summary_investigations);
              $("#disevnoteipd").val(data.summary_note);
              $("#disdiagnosis").val(data.disdiagnosis);
              $("#disoperation").val(data.disoperation);
              $("#distreatment_at_home").val(data.summary_treatment_home);
              $('#summary_print').html("<?php if ($this->rbac->hasPrivilege('discharged_summary', 'can_view')) { ?><a href='#' data-toggle='tooltip' onclick='printData(" + data.summary_id + ")'   data-original-title='<?php echo $this->lang->line('print'); ?>'><i class='fa fa-print'></i></a> <?php } ?>");
              holdModal('myModaldischarged');
            },
          });
        }

        function printData(insert_id) {
          var base_url = '<?php echo base_url() ?>';
          $.ajax({
            url: base_url + 'admin/patient/getopdsummaryDetails/' + insert_id,
            type: 'POST',
            data: {
              id: insert_id,
              print: 'yes'
            },
            success: function(result) {
              popup(result);
            }
          });
        }

        $(document).ready(function(e) {
          $("#formeditpa").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/update',
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
                  successMsg(data.message);
                  window.location.reload(true);
                }
                $("#formeditpabtn").button('reset');
              },
              error: function() {

              }
            });
          }));
        });

        function getRecord_id(visitid) {

          $.ajax({
            url: base_url + 'admin/prescription/addopdPrescription',
            dataType: 'JSON',
            data: {
              'visit_detail_id': visitid
            },
            type: "POST",
            beforeSend: function() {
              $('.modal-title', "#add_prescription").html('');
            },
            success: function(res) {

              $('.modal-title', "#add_prescription").html('<?php echo $this->lang->line('
                add_prescription '); ?>');
              $('.modal-body', "#add_prescription").html(res.page);
              $('.modal-body', "#add_prescription").find('table').find('.select2').select2();
              $('.modal-body', "#add_prescription").find('.multiselect2').select2({
                placeholder: 'Select',
                allowClear: false,
                minimumResultsForSearch: 2
              });

              $('#add_prescription').modal('show');
            },

            complete: function() {
              $("#compose-textareass,#compose-textareaneww").wysihtml5({
                toolbar: {
                  "image": false,
                }
              });

            },
            error: function(xhr) {
              alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
            }
          });
        }

        $(document).ready(function(e) {
          $("#formedit").on('change', (function(e) {
            console.log("update");
            console.log(e.target.id);


            if (e.target.id == "diagnostic" || e.target.id == "type_diagnostic" || e.target.id == "note_diagnostic" || e.target.id == "searchFilter") {
              console.log(e.target.id);
            } else {
              console.log("no es 59");
              $("#formeditbtn").button("loading");
              e.preventDefault();

              $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/opd_detail_update',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                  if (data.status == "fail") {
                    var message = "";
                    $("#formeditbtn").button("reset");
                    $.each(data.error, function(index, value) {
                      message += value;
                    });
                    errorMsg(message);
                  } else {
                    successMsg(data.message);
                    //                         window.location.reload(true);
                  }
                  $("#formeditbtn").button("reset");
                },
                error: function() {

                }
              });
            }
          }));
        });
        
        $(document).ready(function(e) {
          $("#revisitModal").on('hidden.bs.modal', function(e) {
            window.location.reload(true);
          });
        });


        $(document).ready(function(e) {
          $("form#form_prescription button[type=submit]").click(function() {
            $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
            $(this).attr("clicked", "true");
          });

          $("#form_prescription").on('submit', (function(e) {

            var sub_btn_clicked = $("button[type=submit][clicked=true]");
            var sub_btn_clicked_name = sub_btn_clicked.attr('name');
            e.preventDefault();
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/add_opd_prescription',
              type: "POST",
              data: new FormData(this),
              dataType: 'json',
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                if (data.status == "0") {
                  var message = "";
                  $.each(data.error, function(index, value) {
                    message += value;
                  });
                  errorMsg(message);
                } else {
                  successMsg(data.message);

                  if (sub_btn_clicked_name === "save_print") {
                    printprescription(data.visitid, true);
                  }
                  $('#add_prescription').modal('hide');
                  $('.ajaxlist').DataTable().ajax.reload();

                }
                sub_btn_clicked.button('reset');
              },
              error: function() {
                $("#form_prescriptionbtn").button('reset');
              },
              complete: function() {
                $("#form_prescriptionbtn").button('reset');
              }
            });
          }));
        });

        $(document).ready(function(e) {
          $("#form_operationtheatre").on('submit', (function(e) {
            var did = $("#consultant_doctorid").val();
            $("#consultant_doctorname").val(did);
            $("#form_operationtheatrebtn").button('loading');
            e.preventDefault();
            $.ajax({
              url: '<?php echo base_url(); ?>admin/operationtheatre/add',
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
                  successMsg(data.message);
                  window.location.reload(true);
                }
                $("#form_operationtheatrebtn").button('reset');
              },
              error: function() {

              }
            });
          }));
        });

        var prescription_rows = 2;
        $(document).on('click', '.add-record', function() {

          var table = document.getElementById("tableID");
          var table_len = (table.rows.length);

          var id = parseInt(table_len);

          var rowCount = $('#tableID tr').length;
          var cat_row = "";
          var medicine_row = "";
          var dose_row = "";
          var dose_interval_row = "";
          var dose_duration_row = "";
          var instruction_row = "";
          if (table_len == 0) {
            cat_row = "<label><?php echo $this->lang->line('medicine_category'); ?></label>";
            medicine_row = "<label><?php echo $this->lang->line('medicine'); ?></label>";
            dose_row = " <label><?php echo $this->lang->line("
            dose "); ?></label>";
            dose_interval_row = " <label><?php echo $this->lang->line("
            dose_interval "); ?></label>";
            dose_duration_row = " <label><?php echo $this->lang->line("
            dose_duration "); ?></label>";
            instruction_row = " <label><?php echo $this->lang->line("
            instruction "); ?></label>";
          }

          var div = "<input type='hidden' name='rows[]' value='" + prescription_rows + "' autocomplete='off'><div id=row1><div class='col-lg-2 col-md-4 col-sm-6 col-xs-6'><div '>" + cat_row + "<select class='form-control select2 medicine_category'  name='medicine_cat_" + prescription_rows + "'  id='medicine_cat" + prescription_rows + "'><option value='<?php echo set_value('medicine_category_id'); ?>'><?php echo $this->lang->line('select'); ?></option><?php foreach ($medicineCategory as $dkey => $dvalue) { ?><option value='<?php echo $dvalue["
          id "]; ?>'><?php echo $dvalue["
          medicine_category "] ?></option><?php } ?></select></div></div><div class='col-lg-2 col-md-4 col-sm-6 col-xs-6'><div>" + medicine_row + "<select class='form-control select2 medicine_name' data-rowId='" + prescription_rows + "'  name='medicine_" + prescription_rows + "' id='search-query" + prescription_rows + "'><option value='l'><?php echo $this->lang->line('select') ?></option></select><small id='stock_info_" + prescription_rows + "''> </small></div></div><div class='col-lg-2 col-md-4 col-sm-6 col-xs-6'><div>" + dose_row + "<select  class='form-control select2 medicine_dosage' name='dosage_" + prescription_rows + "' id='search-dosage" + prescription_rows + "'><option value='l'><?php echo $this->lang->line('select'); ?></option></select></div></div><div class='col-lg-2 col-md-4 col-sm-6 col-xs-6'><div>" + dose_interval_row + " <select  class='form-control select2 interval_dosage' name='interval_dosage_" + prescription_rows + "' id='search-interval-dosage" + prescription_rows + "'><option value='<?php echo set_value('interval_dosage_id'); ?>'><?php echo $this->lang->line('select'); ?></option><?php foreach ($intervaldosage as $dkey => $dvalue) { ?><option value='<?php echo $dvalue["
          id "]; ?>'><?php echo $dvalue["
          name "] ?></option><?php } ?></select></div></div><div class='col-lg-2 col-md-4 col-sm-6 col-xs-6'><div>" + dose_duration_row + "<select class='form-control select2 duration_dosage' name='duration_dosage_" + prescription_rows + "' id='search-duration-dosage" + prescription_rows + "'><option value='<?php echo set_value('duration_dosage_id'); ?>'><?php echo $this->lang->line('select') ?></option><?php foreach ($durationdosage as $dkey => $dvalue) { ?><option value='<?php echo $dvalue["
          id "]; ?>'><?php echo $dvalue["
          name "] ?></option><?php } ?></select></div></div><div class='col-lg-2 col-md-4 col-sm-6 col-xs-6'><div>" + instruction_row + "<textarea style='height:28px' name='instruction_" + prescription_rows + "' class=form-control id=description></textarea></div></div></div>";

          var table_row = "<tr id='row" + prescription_rows + "'><td>" + div + "</td><td><button type='button' onclick='delete_row(" + prescription_rows + ")' data-row-id='" + prescription_rows + "' class='closebtn delete_row'><i class='fa fa-remove'></i></button></td></tr>";
          //$(table).find('tbody').append(table_row);
          $('#tableID').append(table_row).find('.select2').select2();

          $('.modal-body', "#add_prescription").find('table#tableID').find('.select2').select2();
          prescription_rows++;
        });

        function delete_row(id) {
          var table = document.getElementById("tableID");
          var rowCount = table.rows.length;
          $("#row" + id).html("");
        }

        $(document).ready(function(e) {
          $("#add_timeline").on('submit', (function(e) {
            $("#add_timelinebtn").button('loading');
            var patient_id = $("#patient_id").val();
            console.log(patient_id);
            e.preventDefault();
            $.ajax({
              url: "<?php echo site_url("admin/timeline/add_patient_timeline") ?>",
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
                  successMsg(data.message);
                  $.ajax({
                    url: '<?php echo base_url(); ?>admin/timeline/patient_timeline/'+patient_id,
                    success: function(res) {
                      console.log(res);
                      $('#timeline_list').html(res);
                      $('#myTimelineModal').modal('toggle');
                    },
                    error: function() {
                      alert("Fail")
                    }
                  });
                  window.location.reload(true);
                }
                $("#add_timelinebtn").button('reset');
              },
              error: function(e) {
                alert("Fail");
              }
            });
          }));
        });

        $(document).ready(function(e) {
          $("#edit_timeline").on('submit', (function(e) {
            $("#edit_timelinebtn").button('loading');
            var patient_id = $("#patient_id").val();
            e.preventDefault();
            $.ajax({
              url: "<?php echo site_url("admin/timeline/edit_patient_timeline") ?>",
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
                  successMsg(data.message);
                  window.location.reload(true);
                }
                $("#edit_timelinebtn").button('reset');
              },
              error: function(e) {
                alert("Fail");
                console.log(e);
              }
            });
          }));
        });

        function delete_timeline(id) {
          var patient_id = $("#patient_id").val();
          if (confirm('<?php echo $this->lang->line("delete_confirm") ?>')) {
            $.ajax({
              url: '<?php echo base_url(); ?>admin/timeline/delete_patient_timeline/' + id,
              success: function(res) {
                $.ajax({
                  url: '<?php echo base_url(); ?>admin/timeline/patient_timeline/' + patient_id,
                  success: function(res) {

                    $('#timeline_list').html(res);
                    successMsg('<?php echo $this->lang->line('
                      delete_message ') ?>');
                  },
                  error: function() {
                    alert("Fail")
                  }
                });
              },
              error: function() {
                alert("Fail")
              }
            });
          }
        }

        function view_prescription(visitid) {
          $.ajax({
            url: '<?php echo base_url(); ?>admin/prescription/getPrescription/' + visitid,
            success: function(res) {
              $("#getdetails_prescription").html(res);
            },
            error: function() {
              alert("Fail")
            }
          });
          holdModal('prescriptionview');
        }

        function viewmanual_prescription(visitid) {
          $.ajax({
            url: '<?php echo base_url(); ?>admin/prescription/getPrescriptionmanual/' + visitid,
            success: function(res) {
              $("#getdetails_prescriptionmanual").html(res);
              $('#edit_deleteprescriptionmanual').html("<?php if ($this->rbac->hasPrivilege('prescription', 'can_view')) { ?><a href='#'' onclick='printprescriptionmanual(" + visitid + ")'   data-original-title='<?php echo $this->lang->line('print'); ?>' title='<?php echo $this->lang->line('print'); ?>'><i class='fa fa-print'></i></a><?php } ?>");
            },
            error: function() {
              alert("Fail")
            }
          });
          holdModal('prescriptionviewmanual');
        }
        
      </script>
      <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/animate.min.css">
      <script type="text/javascript">
        
        $(document).ready(function() {
          $(".dshow").click(function() {
            $('.sidebarlists').fadeIn(1000);
            $('.sidebarlists').show();
            $('.dshow').hide();
            $('.sidebarlists').removeClass('animated slideInRight faster').addClass('animated slideInLeft faster');
            $('.dhide').show();
            $('.itemcol').removeClass('col-md-12').addClass('col-md-9');
          });

          $(".dhide").click(function() {
            $('.sidebarlists').fadeOut(1000);
            $('.sidebarlists').hide();
            $('.dshow').show();
            $('.dhide').hide();
            $('.sidebarlists').addClass('animated slideInLeft faster').removeClass('animated slideInRight faster');
            $('.itemcol').addClass('col-md-12').removeClass('col-md-9');

          });
        });
        
      </script>
      <script type="text/javascript">
        $(document).ready(function(e) {
          $('.select2').select2();
        });

        $(document).ready(function(e) {
          $("#formrevisit").on('submit', (function(e) {
            $("#formrevisitbtn").button('loading');
            e.preventDefault();
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/add_revisit',
              type: "POST",
              data: new FormData(this),
              dataType: 'json',
              contentType: false,
              processData: false,
              success: function(data) {
                if (data.status == "fail") {
                  var message = "";
                  $.each(data.error, function(index, value) {
                    message += value;
                  });
                  errorMsg(message);
                } else {
                  successMsg(data.message);
                  window.location.reload(true);
                }

                $("#formrevisitbtn").button('reset');
              },
              error: function() {

              }
            });
          }));
        });

        function makeid(length) {
          var result = '';
          var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
          var charactersLength = characters.length;
          for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
          }
          return result;
        }

        function getRevisitRecord(visitid) {
          $('.select2-selection__rendered').html("");
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getvisitDetails',
            type: "POST",
            data: {
              visitid: visitid
            },
            dataType: 'json',
            success: function(data) {
              $("#patientname").html(data.patients_name);
              $('#guardian').html(data.guardian_name);
              $('#rgender').html(data.gender);
              $("#listnumber").html(data.mobileno);
              $("#remail").html(data.email);
              $("#rblood_group").html(data.blood_group_name);
              $("#raddress").html(data.address);
              $("#rmarital_status").html(data.marital_status);
              $("#rtpa_id").html(data.insurance_id);
              $("#rtpa_validity").html(data.tpa_validity);
              $("#ridentification_number").html(data.identification_number);
              $("#rallergies").html(data.any_known_allergies);
              $("#rnote").html(data.note);

              if (data.image != null) {
                $("#patient_image").attr("src", "<?php echo base_url(); ?>" + data.image + "<?php echo img_time(); ?>");
              } else {
                $("#patient_image").attr("src", "<?php echo base_url(); ?>uploads/patient_images/no_image.png");
              }

              var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['
              d ' => '
              dd ', '
              m ' => '
              MM ', '
              Y ' => '
              yyyy ',]) ?>';
              var dob_format = new Date(data.dob).toString(date_format);

              $("#rage").html(data.patient_age);
              $("#revisit_id").val(data.id);
              $("#revisit_name").val(data.patient_name);
              $('#revisit_guardian').val(data.guardian_name);
              $("#revisit_contact").val(data.mobileno);
              $("#revisit_date").val(data.appointment_date);
              $("#revisit_case").val(data.case_type);
              $("#pid").val(data.patientid);
              $("#revisit_refference").val(data.refference);
              $("#revisit_email").val(data.email);
              if (data.live_consult) {
                $("#live_consultvisit").val(data.live_consult);
              }
              $("#esymptoms").val(data.symptoms);
              $("#revisit_age").val(data.age);
              $("#revisit_month").val(data.month);
              $("#revisit_height").val(data.height);
              $("#revisit_weight").val(data.weight);
              $("#revisit_bp").val(data.bp);
              $("#revisit_pulse").val(data.pulse);
              $("#revisit_temperature").val(data.temperature);
              $("#revisit_respiration").val(data.respiration);
              $("#revisit_blood_group").val(data.blood_group);
              $("#revisi_tax").val(data.tax);
              $("#revisit_address").val(data.address);
              $("#revisit_note").val(data.note);
              $('select[id="revisit_old_patient"] option[value="' + data.old_patient + '"]').attr("selected", "selected");
              $('select[id="revisit_doctor"] option[value="' + data.cons_doctor + '"]').attr("selected", "selected");
              $('select[id="revisit_organisation"] option[value="' + data.organisation_id + '"]').attr("selected", "selected");
              $('select[id="revisit_organisation"]').attr("disabled", true);
              holdModal('revisitModal');
            },
          })
        }

        function printprescription(visitid) {
          var base_url = '<?php echo base_url() ?>';
          $.ajax({
            url: base_url + 'admin/prescription/printPrescription',
            type: 'GET',
            data: {
              visitid: visitid
            },
            dataType: "json",
            success: function(result) {
              popup(result.page);
            }
          });
        }

        function printprescriptionmanual(visitid) {
          var base_url = '<?php echo base_url() ?>';
          $.ajax({
            url: base_url + 'admin/prescription/getPrescriptionmanual/' + visitid,
            type: 'POST',
            data: {
              payslipid: visitid,
              print: 'yes'
            },
            success: function(result) {
              $("#testdata").html(result);
              popup(result);
            }
          });
        }

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

        function deleteOpdPatientDiagnosis(patient_id, id) {
          if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/deleteOpdPatientDiagnosis/' + patient_id + '/' + id,
              success: function(res) {
                successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                window.location.reload(true);
              }
            })
          }
        }

        function deleteOpdPatientCharge(id) {
          if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/deleteOpdPatientCharge/' + id,
              success: function(res) {
                successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                window.location.reload(true);
              }
            })
          }
        }

        function deletePayment(id) {
          if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/deletePayment/' + id,
              success: function(res) {
                successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                window.location.reload(true);
              }
            })
          }
        }

        var attr = {};

        $(document).ready(function(e) {
          $("#formdishrecord").on('submit', (function(e) {
            $("#formdishrecordbtn").button('loading');
            e.preventDefault();
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/add_opddischarged_summary',
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
                  successMsg(data.message);
                  window.location.reload(true);
                }
                $("#formdishrecordbtn").button('reset');
              },
              error: function() {

              }
            });
          }));
        });


        window.onload = function() {
          var showAlert = localStorage.getItem('showAlert');
          if (showAlert) {
            successMsg(showAlert);
            localStorage.removeItem('showAlert');
          }
        };

        function getMedicineName(id) {
          console.log(id);
          var category_selected = $("#medicine_cat" + id).val();
          var arr = category_selected.split('-');
          var category_set = arr[0];
          div_data = '';
          $("#search-query" + id).html("<option value='l'><?php echo $this->lang->line('loading') ?></option>");
          $('#search-query' + id).select2("val", +id);
          $.ajax({
            type: "POST",
            url: base_url + "admin/pharmacy/get_medicine_name",
            data: {
              'medicine_category_id': category_selected
            },
            dataType: 'json',
            success: function(res) {
              console.log(res);
              $.each(res, function(i, obj) {
                var sel = "";
                div_data += "<option value='" + obj.medicine_name + "'>" + obj.medicine_name + "</option>";
              });

              $("#search-query" + id).html("<option value=''><?php echo $this->lang->line('select'); ?></option>");
              $('#search-query' + id).append(div_data);
              $('#search-query' + id).select2("val", '');
              getMedicineDosage(id);
            }
          });
        };

        function getMedicineDosage(id) {
          var category_selected = $("#medicine_cat" + id).val();
          var arr = category_selected.split('-');
          var category_set = arr[0];
          div_data = '';
          $("#search-dosage" + id).html("<option value='l'><?php echo $this->lang->line('loading') ?></option>");
          $.ajax({
            type: "POST",
            url: base_url + "admin/pharmacy/get_medicine_dosage",
            data: {
              'medicine_category_id': category_selected
            },
            dataType: 'json',
            success: function(res) {
              $.each(res, function(i, obj) {
                var sel = "";
                div_data += "<option value='" + obj.dosage + "'>" + obj.dosage + "</option>";
              });
              $("#search-dosage" + id).html("<option value=''><?php echo $this->lang->line('select'); ?></option>");
              $('#search-dosage' + id).append(div_data);
            }
          });
        }

        function getcharge_category(id) {
          var div_data = "";
          $('#charge_category').html("<option value='l'><?php echo $this->lang->line('loading') ?></option>");
          $("#charge_category").select2("val", 'l');

          $.ajax({
            url: '<?php echo base_url(); ?>admin/charges/get_charge_category',
            type: "POST",
            data: {
              charge_type: id
            },
            dataType: 'json',
            success: function(res) {
              $.each(res, function(i, obj) {
                var sel = "";
                div_data += "<option value='" + obj.name + "'>" + obj.name + "</option>";
              });
              $('#charge_category').html("<option value=''><?php echo $this->lang->line('select'); ?></option>");
              $('#charge_category').append(div_data);
              $("#charge_category").select2("val", '');
            }
          });
        }

        function update_amount(apply_charge) {
          var apply_amount = apply_charge;
          var tax_percentage = $('#percentage').val();
          if (tax_percentage != '' && tax_percentage != 0) {
            apply_amount = (parseFloat(apply_charge) * tax_percentage / 100) + (parseFloat(apply_charge));
            $('#revisit_amount').val(apply_amount);
          } else {
            $('#revisit_amount').val(apply_amount);
          }
        }

        $(document).on('select2:select', '.charge', function() {
          var charge = $(this).val();
          var orgid = $("#revisit_organisation").val();

          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getChargeById',
            type: "POST",
            data: {
              charge_id: charge,
              organisation_id: orgid
            },
            dataType: 'json',
            success: function(res) {
              if (res) {
                var tax = res.percentage;
                var quantity = $('#qty').val();
                $('#percentage').val(tax);
                $('#apply_chargevisit').val(parseFloat(res.standard_charge) * quantity);
                $('#standard_chargevisit').val(res.standard_charge);

                if (res.org_charge == null) {
                  if (res.percentage == null) {
                    apply_amount = parseFloat(res.standard_charge);
                  } else {
                    apply_amount = (parseFloat(res.standard_charge) * res.percentage / 100) + (parseFloat(res.standard_charge));
                  }

                  $('#apply_chargevisit').val(res.standard_charge);
                  $('#revisit_amount').val(apply_amount.toFixed(2));
                  $('#paid_amount').val(apply_amount.toFixed(2));

                } else {
                  if (res.percentage == null) {
                    apply_amount = parseFloat(res.org_charge);
                  } else {
                    apply_amount = (parseFloat(res.org_charge) * res.percentage / 100) + (parseFloat(res.org_charge));
                  }

                  $('#apply_chargevisit').val(res.org_charge);
                  $('#revisit_amount').val(apply_amount.toFixed(2));
                  $('#paid_amount').val(apply_amount.toFixed(2));

                }
              } else {

              }
            }
          });
        });

        $(document).on('change', '.charge_type', function() {
          var charge_type = $(this).val();
          console.log(charge_type);
          $('.charge_category').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");
          getcharge_category(charge_type, "");
        });

        function getcharge_category(charge_type, charge_category) {
          var div_data = "";
          if (charge_type != "") {

            $.ajax({
              url: base_url + 'admin/charges/get_charge_category',
              type: "POST",
              data: {
                charge_type: charge_type
              },
              dataType: 'json',
              success: function(res) {
                $.each(res, function(i, obj) {
                  var sel = "";
                  div_data += "<option value='" + obj.id + "'>" + obj.name + "</option>";
                });
                $('.charge_category').html("<option value=''><?php echo $this->lang->line('select'); ?></option>");
                $('.charge_category').append(div_data);
                $('.charge_category').select2("val", charge_category);
              }
            });
          }
        }

        $(document).on('change', '.editcharge_type', function() {
          var charge_type = $(this).val();
          $('.editcharge_category').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");
          geteditcharge_category(charge_type, "");
        });

        function geteditcharge_category(charge_type, charge_category) {
          var div_data = "";
          if (charge_type != "") {

            $.ajax({
              url: base_url + 'admin/charges/get_charge_category',
              type: "POST",
              data: {
                charge_type: charge_type
              },
              dataType: 'json',
              success: function(res) {
                $.each(res, function(i, obj) {
                  var sel = "";
                  div_data += "<option value='" + obj.id + "'>" + obj.name + "</option>";
                });
                $('.editcharge_category').html("<option value=''><?php echo $this->lang->line('select'); ?></option>");
                $('.editcharge_category').append(div_data);
                $('.editcharge_category').select2("val", charge_category);
              }
            });
          }
        }

        $(document).on('select2:select', '.charge_category', function() {
          var charge_category = $(this).val();
          console.log(charge_category);
          $('.charge').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");
          $('.addcharge').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");
          var charge_id = $('#add_charge_type').val();
          getchargecode(charge_category, charge_id);
        });

        function getchargecode(charge_category, charge_id) {
          console.log(charge_id);
          var div_data = "<option value=''><?php echo $this->lang->line('select'); ?></option>";
          if (charge_category != "") {
            $.ajax({
              url: base_url + 'admin/charges/getchargeDetails',
              type: "POST",
              data: {
                charge_category: charge_category
              },
              dataType: 'json',
              success: function(res) {
                console.log(res);
                $.each(res, function(i, obj) {
                  var sel = "";
                  div_data += "<option value='" + obj.id + "'>" + obj.name + "</option>";
                });
                $('.charge').html(div_data);
                $(".charge").select2("val", charge_id);
                $('.addcharge').html(div_data);
                $(".addcharge").select2("val", charge_id);
              }
            });
          }
        }

        $(document).on('select2:select', '.editcharge_category', function() {
          var charge_category = $(this).val();
          $('.charge').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");
          $('.editcharge').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");
          geteditchargecode(charge_category, "");
        });

        function geteditchargecode(charge_category, charge_id) {
          console.log(charge_id);
          var div_data = "<option value=''><?php echo $this->lang->line('select'); ?></option>";
          if (charge_category != "") {
            $.ajax({
              url: base_url + 'admin/charges/getchargeDetails',
              type: "POST",
              data: {
                charge_category: charge_category
              },
              dataType: 'json',
              success: function(res) {

                $.each(res, function(i, obj) {
                  var sel = "";
                  div_data += "<option value='" + obj.id + "'>" + obj.name + "</option>";
                });
                $('.charge').html(div_data);
                $(".charge").select2("val", charge_id);
                $('.editcharge').html(div_data);
                $(".editcharge").select2("val", charge_id);
              }
            });
          }
        }

        $(document).ready(function(e) {
          $("#add_bill").on('submit', (function(e) {
            if (confirm('<?php echo $this->lang->line('
                are_you_sure ')?>')) {
              $("#save_button").button('loading');
              e.preventDefault();
              $.ajax({
                url: "<?php echo site_url("admin/payment/addopdbill ") ?>",
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
                    successMsg(data.message);
                    window.location.reload = true;
                  }
                  $("#save_button").button('reset');
                  location.reload();
                },
                error: function(e) {
                  alert("Fail");
                  console.log(e);
                }
              });
            } else {
              return false;
            }

          }));
        });

        $(document).ready(function(e) {
          $("#add_charges button[type=submit]").click(function() {
            $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
            $(this).attr("clicked", "true");
          });

          $("#add_charges").on('submit', (function(e) {
            e.preventDefault();
            var $this = $("button[type=submit][clicked=true]");
            var form = $(this);
            var form_data = form.serializeArray();
            var button_val = $this.attr('value');
            form_data.push({
              name: "add_type",
              value: button_val
            });
            $.ajax({
              url: '<?php echo base_url(); ?>admin/charges/add_opdcharges',
              type: "post",
              data: form_data,
              dataType: 'json',
              beforeSend: function() {
                $("#add_chargesbtn").button('loading');

              },
              success: function(res) {
                if (res.status == "fail") {
                  var message = "";
                  $.each(res.error, function(index, value) {
                    message += value;
                  });
                  errorMsg(message);
                } else if (res.status == "new_charge") {
                  var data = res.data;
                  var row_id = makeid(8);


                  var charge = '<tr id="' + row_id + '"><td>' + data.date + '<input type="hidden" name="pre_date[]" value="' + data.date + '"></td><td>' + data.charge_type_name + '</td><td>' + data.charge_category + '</td><td>' + data.charge_name + '<input type="hidden" name="pre_charge_id[]" value="' + data.charge_id + '"><br><h6>' + data.note + '<input type="hidden" name="pre_note[]" value="' + data.note + '"></h6></td><td class="text-right">' + data.standard_charge + '<input type="hidden" name="pre_standard_charge[]" value="' + data.standard_charge + '"><input type="hidden" name="pre_tax_percentage[]" value="' + data.tax_percentage + '"></td><td class="text-right">' + data.tpa_charge + '<input type="hidden" name="pre_tpa_charges[]" value="' + data.tpa_charge + '"></td><td class="text-right">' + data.qty + '<input type="hidden" name="pre_qty[]" value="' + data.qty + '"></td><td class="text-right">' + data.amount + '<input type="hidden" name="pre_total[]" value="' + data.amount + '"></td><td class="text-right">' + data.tax + '<input type="hidden" name="pre_tax[]" value="' + data.tax + '"><input type="hidden" name="pre_apply_charge[]" value="' + data.apply_charge + '"></td><td class="text-right">' + data.net_amount + '<input type="hidden" name="pre_net_amount[]" value="' + data.net_amount + '"></td><td><button type="button" class="closebtn delete_row" data-row-id="' + row_id + '" data-record-id="' + data.charge_id + '" autocomplete="off"><i class="fa fa-remove"></i></button></td></tr>';
                  $('#preview_charges').append(charge);

                  charge_reset();
                } else {
                  successMsg(res.message);
                  window.location.reload(true);
                }

              },
              error: function() {
                $("#add_chargesbtn").button('reset');
              },
              complete: function() {
                $("#add_chargesbtn").button('reset');
              }
            });
          }));
        });

        $(document).on('click', '.delete_row', function(e) {
          var del_row_id = $(this).data('rowId');
          var del_record_id = $(this).data('recordId');
          var result = confirm("<?php echo $this->lang->line('delete_confirm')?>");
          if (result) {
            $('#row' + del_row_id).remove();
          }

          if (del_record_id > 0) {

            $.ajax({
              url: "<?php echo site_url("admin/patient/deletemedicine"); ?>",
              type: "POST",
              data: {
                prescription_detail_id: del_record_id
              },
              success: function(data) {}
            });
          }
        });

        function makeid(length) {
          var result = '';
          var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
          var charactersLength = characters.length;
          for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
              charactersLength));
          }
          return result;
        }

        function charge_reset() {
          $("#charge_category").select2("val", '');
          $("#add_charge_type").select2("val", '');
          $("#charge_id").select2("val", '');
          $("#addstandard_charge").val('');
          $("#addscd_charge").val('');
          $("#qty").val('');
          $("#standard_charge").val('');
          $("#schedule_charge").val('');
          $("#charge_date").val('');
          $("#edit_note").val('');
          $("#charge_tax").val('');
          $("#tax").val('');
          $("#final_amount").val('');
          $("#apply_charge").val('');

        }

        $(document).ready(function(e) {
          $("#edit_charges").on('submit', (function(e) {
            e.preventDefault();
            let button_clicked = $("button[type=submit]", this);
            $.ajax({
              url: base_url + 'admin/charges/edit_opdcharges',
              type: "POST",
              data: new FormData(this),
              dataType: 'json',
              contentType: false,
              cache: false,
              processData: false,

              beforeSend: function() {
                button_clicked.button("loading");
              },
              success: function(data) {
                if (data.status == "fail") {
                  var message = "";
                  $.each(data.error, function(index, value) {
                    message += value;
                  });
                  errorMsg(message);
                } else {
                  successMsg(data.message);
                  window.location.reload(true);
                }
                button_clicked.button("reset");
              },
              error: function() {
                button_clicked.button('reset');
              },

              complete: function() {
                button_clicked.button('reset');
              }
            });
          }));
        });

        $(document).ready(function(e) {
          $("#add_payment").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
              url: base_url + 'admin/payment/addOPDPayment',
              type: "POST",
              data: new FormData(this),
              dataType: 'json',
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function() {
                $("#add_paymentbtn").button("loading");
              },
              success: function(data) {
                if (data.status == "fail") {
                  var message = "";
                  $.each(data.error, function(index, value) {
                    message += value;
                  });
                  errorMsg(message);
                } else {
                  successMsg(data.message);
                  window.location.reload(true);
                }
                $("#add_paymentbtn").button("reset");
              },
              error: function() {
                $("#add_paymentbtn").button('reset');
              },

              complete: function() {
                $("#add_paymentbtn").button('reset');
              }
            });
          }));
        });



        function calculate() {
          var discount_percent = $("#discount_percent").val();
          var tax_percent = $("#tax_percent").val();
          var other_charge = $("#other_charge").val();
          var paid_amount = $("#paid_amountpa").val();
          var total_amount = $("#total_amount").val();
          var subtotal_amount = parseFloat(total_amount) + parseFloat(other_charge);

          if (discount_percent != '') {
            var discount = (subtotal_amount * discount_percent) / 100;
            $("#discount").val(discount.toFixed(2));
          } else {
            var discount = $("#discount").val();
          }

          if (tax_percent != '') {
            var tax = ((subtotal_amount - discount) * tax_percent) / 100;
            $("#tax").val(tax.toFixed(2));
          } else {
            var tax = $("#tax").val();
          }

          var gross_total = parseFloat(total_amount) + parseFloat(other_charge) + parseFloat(tax) - parseFloat(discount);
          var net_amount = parseFloat(total_amount) + parseFloat(other_charge) + parseFloat(tax) - parseFloat(discount);
          var net_amount_payble = parseFloat(net_amount) - parseFloat(paid_amount);
          $("#gross_total").val(gross_total.toFixed(2));
          $("#net_amount").val(net_amount.toFixed(2));
          $("#grass_amount").val(net_amount.toFixed(2));
          $("#grass_amount_span").html(net_amount.toFixed(2));
          $("#net_amount_span").html(net_amount_payble.toFixed(2));
          $("#net_amount_payble").val(net_amount_payble.toFixed(2));
          $("#save_button").show();
          $("#printBill").show();
        }

        function printBill(patientid, opdid) {
          var total_amount = $("#total_amount").val();
          var discount = $("#discount").val();
          var other_charge = $("#other_charge").val();
          var gross_total = $("#gross_total").val();
          var tax = $("#tax").val();
          var net_amount = $("#net_amount").val();
          var status = $("#status").val();
          var base_url = '<?php echo base_url() ?>';
          $.ajax({
            url: base_url + 'admin/payment/getOPDBill/',
            type: 'POST',
            data: {
              patient_id: patientid,
              opdid: opdid,
              total_amount: total_amount,
              discount: discount,
              other_charge: other_charge,
              gross_total: gross_total,
              tax: tax,
              net_amount: net_amount,
              status: status
            },
            success: function(result) {
              $("#testdata").html(result);
              popup(result);
            }
          });
        }
      </script>
      <script type="text/javascript">
        $(document).on('change', '.chgstatus_dropdown', function() {
          $(this).parent('form.chgstatus_form').submit()

        });

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

        $(".addcharges").click(function() {
          $('#add_charges').trigger("reset");
          $('#select2-charge_category-container').html("");
          $('#select2-code-container').html("");
        });

        $(".revisitrecheckup").click(function() {
          $('#formrevisit').trigger("reset");
        });

        $("#myPaymentModal").on('hidden.bs.modal', function(e) {
          $(".filestyle").next(".dropify-clear").trigger("click");
          $('.cheque_div').css("display", "none");
          $('form#add_payment').find('input:text, input:password, input:file, textarea').val('');
          $('form#add_payment').find('select option:selected').removeAttr('selected');
          $('form#add_payment').find('input:checkbox, input:radio').removeAttr('checked');
        });

        $(document).on('click', '.addpayment', function() {
          $('#myPaymentModal').modal('show');
        });

        $(".adddiagnosis").click(function() {
          $('#form_diagnosis').trigger("reset");
          $(".dropify-clear").trigger("click");
        });

        $(".addtimeline").click(function() {
          $('#add_timeline').trigger("reset");
          $(".dropify-clear").trigger("click");
        });

        $(".prescription").click(function() {
          $('#form_prescription').trigger("reset");
          $('#select2-medicine_cat0-container').html('');
          $('#select2-search-query0-container').html('');
          $('#select2-search-dosage0-container').html('');
          var table = document.getElementById("tableID");
          var table_len = (table.rows.length);
          for (i = 1; i < table_len; i++) {
            delete_row(i);
          }
        });
      </script>

      <script type="text/javascript">
        $(document).ready(function() {
          $("#radiologyOpt").select2({

            placeholder: 'Select',
            allowClear: false,
            minimumResultsForSearch: 2
          });
          $("#pathologyOpt").select2({

            placeholder: 'Select',
            allowClear: false,
            minimumResultsForSearch: 2
          });
        });
      </script>
      <script type="text/javascript">
        $(document).on('change', '.payment_mode', function() {
          var mode = $(this).val();

          if (mode == "Cheque") {

            $('.filestyle', '#myPaymentModal').dropify();
            $(".date").trigger("change");
            $('.cheque_div').css("display", "block");

          } else {

            $('.cheque_div').css("display", "none");
          }
        });

        $(document).on('change', '.visit_payment_mode', function() {
          var mode = $(this).val();

          if (mode == "Cheque") {

            $('.filestyle', '#myPaymentModal').dropify();
            $(".date").trigger("change");
            $('.cheque_div').css("display", "block");

          } else {

            $('.cheque_div').css("display", "none");
          }
        });

        $(document).on('select2:select', '.medicine_category', function() {
          getMedicine($(this), $(this).val(), 0);
          selected_medicine_category_id = $(this).val();
          var medicine_dosage = getDosages(selected_medicine_category_id);
          $(this).closest('tr').find('.medicine_dosage').html(medicine_dosage);
        });

        function getMedicine(med_cat_obj, val, medicine_id) {
          var medicine_colomn = med_cat_obj.closest('tr').find('.medicine_name');
          medicine_colomn.html("");
          $.ajax({
            url: '<?php echo base_url(); ?>admin/pharmacy/get_medicine_name',
            type: "POST",
            data: {
              medicine_category_id: val
            },
            dataType: 'json',
            beforeSend: function() {
              medicine_colomn.html("<option value=''><?php echo $this->lang->line('loading') ?></option>");

            },
            success: function(res) {
              var div_data = "<option value=''><?php echo $this->lang->line('select'); ?></option>";
              $.each(res, function(i, obj) {
                var sel = "";
                if (medicine_id == obj.id) {
                  sel = "selected";
                }
                div_data += "<option value=" + obj.id + " " + sel + ">" + obj.medicine_name + "</option>";

              });

              medicine_colomn.html(div_data);
              medicine_colomn.select2("val", medicine_id);

            }
          });
        }
      </script>

      <script type="text/javascript">
        function getDosages(medicine_category_id) {
          var dosage_opt = "<option value=''><?php echo $this->lang->line('select') ?></option>";
          var sss = '<?php echo json_encode($category_dosage); ?>';
          var aaa = JSON.parse(sss);
          if (aaa[medicine_category_id]) {
            $.each(aaa[medicine_category_id], function(key, item) {
              dosage_opt += "<option value='" + item.id + "'>" + item.dosage + "</option>";
            });
          }
          return dosage_opt;
        }
      </script>

      <script type="text/javascript">
        $(document).on('click', '.print_visit', function() {
          var $this = $(this);
          var record_id = $this.data('recordId')
          $this.button('loading');
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/printVisit',
            type: "POST",
            data: {
              'visit_detail_id': record_id
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');

            },
            success: function(res) {
              popup(res.page);
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

        $(document).on('click', '.print_trans', function() {
          var $this = $(this);
          var record_id = $this.data('recordId')
          $this.button('loading');
          $.ajax({
            url: '<?php echo base_url(); ?>admin/transaction/printTransaction',
            type: "POST",
            data: {
              'id': record_id
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');

            },
            success: function(res) {
              popup(res.page);
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

        $(document).on('click', '.print_charge', function() {

          var $this = $(this);
          var record_id = $this.data('recordId')
          $this.button('loading');
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/printCharge',
            type: "POST",
            data: {
              'id': record_id,
              'type': 'opd'
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');

            },
            success: function(res) {
              popup(res.page);
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

        $(document).on('change keyup input paste', '#qty', function() {
          var quantity = $(this).val();
          var standard_charge = $('#addstandard_charge').val();
          var schedule_charge = $('#addscd_charge').val();
          var tax_percent = $('#charge_tax').val();
          var total_charge = (schedule_charge == "") ? standard_charge : schedule_charge;
          var apply_charge = isNaN(parseFloat(total_charge) * parseFloat(quantity)) ? 0 : parseFloat(total_charge) * parseFloat(quantity);
          $('#apply_charge').val(apply_charge.toFixed(2));
          var discount_percent = 0;
          var discount_amount = isNaN((apply_charge * discount_percent) / 100) ? 0 : (apply_charge * discount_percent) / 100;
          var final_amount = apply_charge - discount_amount;
          $('#discount').val(discount_amount);
          $('#tax').val(((final_amount * tax_percent) / 100).toFixed(2));
          $('#final_amount').val((final_amount + ((final_amount * tax_percent) / 100)).toFixed(2));
        });

        $(document).on('change keyup input paste', '#editqty', function() {
          var quantity = $(this).val();
          var standard_charge = $('#editstandard_charge').val();
          var schedule_charge = $('#editscd_charge').val();
          var tax_percent = $('#editcharge_tax').val();
          var total_charge = (schedule_charge == "") ? standard_charge : schedule_charge;
          var apply_charge = isNaN(parseFloat(total_charge) * parseFloat(quantity)) ? 0 : parseFloat(total_charge) * parseFloat(quantity);
          $('#editapply_charge').val(apply_charge.toFixed(2));
          var discount_percent = 0;
          var discount_amount = isNaN((apply_charge * discount_percent) / 100) ? 0 : (apply_charge * discount_percent) / 100;
          var final_amount = apply_charge - discount_amount;
          $('#editdiscount').val(discount_amount);
          $('#edittax').val(((final_amount * tax_percent) / 100).toFixed(2));
          $('#editfinal_amount').val((final_amount + ((final_amount * tax_percent) / 100)).toFixed(2));
        });
      </script>

      <script type="text/javascript">
        $(document).on('click', '.edit_charge', function() {
          var edit_charge_id = $(this).data('recordId');
          var createModal = $('#edit_chargeModal');
          var $this = $(this);
          $this.button('loading');
          $.ajax({
            url: base_url + 'admin/patient/getCharge',
            type: "POST",
            data: {
              'id': edit_charge_id
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');
            },
            success: function(res) {
              console.log(res.result);
              $('#editstandard_charge').val(res.result.standard_charge);
              if (res.result.tpa_charge > 0) {
                $('#editscd_charge').val(res.result.tpa_charge);
              }
              $('#editqty').val(res.result.qty);
              $('#editcharge_tax').val(res.result.percentage);
              $('#editapply_charge').val(res.result.apply_charge);
              $('#editfinal_amount').val(res.result.amount);
              $('#editcharge_date').val(res.result.charge_date);
              $('#editorg_id').val(res.result.org_charge_id);
              $('#editpatient_charge_id').val(res.result.id);
              var tax_charge = (res.result.apply_charge * res.result.percentage) / 100;
              $('#edittax').val(tax_charge.toFixed(2));
              $('#edit_note').val(res.result.note);
              $('#editcharge_type').select2('val', res.result.charge_type_master_id);
              $('#edit_chargeModal').modal({
                backdrop: 'static'
              });
              geteditcharge_category(res.result.charge_type_master_id, res.result.charge_category_id);
              geteditchargecode(res.result.charge_category_id, res.result.charge_id);
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

        $(document).on('select2:select', '.addcharge', function() {
          var charge = $(this).val();
          var orgid = $('#editorganisation_id').val();
          $('#qty').val('1');
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getChargeById',
            type: "POST",
            data: {
              charge_id: charge,
              organisation_id: orgid
            },
            dataType: 'json',
            success: function(res) {
              if (res) {
                var quantity = $('#qty').val();
                $('#apply_charge').val(parseFloat(res.standard_charge) * quantity);
                $('#addstandard_charge').val(res.standard_charge);
                $('#addscd_charge').val(res.org_charge);
                $('#charge_tax').val(res.percentage);
                var standard_charge = res.standard_charge;
                var schedule_charge = res.org_charge;
                var discount_percent = 0;
                var total_charge = (schedule_charge == null) ? standard_charge : schedule_charge;
                var apply_charge = isNaN(parseFloat(total_charge) * parseFloat(quantity)) ? 0 : parseFloat(total_charge) * parseFloat(quantity);
                var discount_amount = (apply_charge * discount_percent) / 100;
                $('#apply_charge').val(apply_charge.toFixed(2));
                var final_amount = apply_charge - discount_amount;
                $('#tax').val(((final_amount * res.percentage) / 100).toFixed(2));
                $('#final_amount').val((final_amount + ((final_amount * res.percentage) / 100)).toFixed(2));
              }
            }
          });
        });

        $(document).on('select2:select', '.editcharge', function() {
          var charge = $(this).val();
          var orgid = $('#organisation_id').val();

          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getChargeById',
            type: "POST",
            data: {
              charge_id: charge,
              organisation_id: orgid
            },
            dataType: 'json',
            success: function(res) {
              if (res) {
                var quantity = $('#editqty').val();
                $('#editapply_charge').val(parseFloat(res.standard_charge) * quantity);
                $('#editstandard_charge').val(res.standard_charge);
                $('#editscd_charge').val(res.org_charge);
                $('#editcharge_tax').val(res.percentage);
                var standard_charge = res.standard_charge;
                var schedule_charge = res.org_charge;
                var discount_percent = 0;
                var total_charge = (schedule_charge == null) ? standard_charge : schedule_charge;
                var apply_charge = isNaN(parseFloat(total_charge) * parseFloat(quantity)) ? 0 : parseFloat(total_charge) * parseFloat(quantity);
                var discount_amount = (apply_charge * discount_percent) / 100;
                $('#editapply_charge').val(apply_charge.toFixed(2));
                var final_amount = apply_charge - discount_amount;
                $('#edittax').val(((final_amount * res.percentage) / 100).toFixed(2));
                $('#editfinal_amount').val((final_amount + ((final_amount * res.percentage) / 100)).toFixed(2));
              }
            }
          });
        });

        $(document).on('change', '.death_status', function() {
          var status = $(this).val();
          if (status == "1") {
            $('.filestyle', '#addPaymentModal').dropify();
            $('.filestyle', '#add_refund').dropify();
            $('.death_status_div').css("display", "block");
            $('.reffer_div').css("display", "none");
          } else if (status == "2") {
            $('.reffer_div').css("display", "block");
            $('.death_status_div').css("display", "none");
          } else {
            $('.reffer_div').css("display", "none");
            $('.death_status_div').css("display", "none");
          }
        });

        $(document).on('click', '.patient_discharge', function() {
          var case_reference_id = "<?php echo $case_reference_id;?>";
          var payment_modal = $('#patient_discharge');
          payment_modal.addClass('modal_loading');
          payment_modal.modal('show');
          $.ajax({
            url: base_url + 'admin/bill/patient_discharge/' + case_reference_id,
            type: "POST",
            data: {
              'module_type': 'opd'
            },
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(data) {

              $('.modal-body', payment_modal).html(data.page);
              $('.filestyle', '#patient_discharge').dropify();
              $('.date', '#patient_discharge').trigger("change");
              payment_modal.removeClass('modal_loading');
            },

            error: function(xhr) { // if error occured
              alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");

            },
            complete: function() {
              payment_modal.removeClass('modal_loading');

            }
          });
        });

        $(document).on('submit', '#patient_discharge', function(e) {
          e.preventDefault();
          var clicked_btn = $("button[type=submit]");

          var form = $(this);
          var btn = clicked_btn;
          btn.button('loading');
          $.ajax({
            url: form.attr('action'),
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
              if (data.status == "fail") {
                var message = "";
                $.each(data.error, function(index, value) {
                  message += value;
                });
                errorMsg(message);
              } else {
                successMsg(data.message);
                window.location.reload(true);
              }
              btn.button('reset');
            },
            error: function() {

            },
            complete: function() {
              btn.button('reset');
            }
          });
        });




        $(document).on('click', '.print_dischargecard', function() {
          var $this = $(this);
          var record_id = $this.data('recordId');
          var case_id = $this.data('case_id');
          $this.button('loading');
          $.ajax({
            url: '<?php echo base_url(); ?>admin/bill/print_dischargecard',
            type: "POST",
            data: {
              'id': record_id,
              'case_id': case_id,
              'module_type': 'opd'
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');

            },
            success: function(res) {
              popup(res.page);
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

        $(document).on('click', '.viewot', function() {
          var $this = $(this);
          var record_id = $this.data('recordId');
          $this.button('loading');
          $.ajax({
            url: base_url + 'admin/operationtheatre/otdetails',
            type: "POST",
            data: {
              ot_id: record_id
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');

            },
            success: function(data) {
              $('#view_ot_modal').modal('show');
              $('#show_ot_data').html(data.page);
              $('#action_detail_modal').html(data.actions);
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

        $(document).ready(function(e) {
          $('#patient_discharge').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
          });
        });
      </script>
      <script>
        function getcategory(id, operation = null) {
          var div_data = "";
          $('#operation_name').html("<option value='l'><?php echo $this->lang->line('loading') ?></option>");
          $.ajax({
            url: '<?php echo base_url(); ?>admin/operationtheatre/getoperationbycategory',
            type: "POST",
            data: {
              id: id
            },
            dataType: 'json',
            async: false,
            success: function(res) {
              $.each(res, function(i, obj) {
                var sel = "";
                if ((operation != '') && (operation == obj.id)) {
                  sel = "selected";
                }
                div_data += "<option value=" + obj.id + " " + sel + ">" + obj.operation + "</option>";
              });
              $("#operation_name").html("<option value=''>Select</option>");
              $('#operation_name').append(div_data);
              $("#operation_name").select2().select2('val', operation);
              if (operation != "") {
                $("#eoperation_name").html("<option value=''>Select</option>");
                $('#eoperation_name').append(div_data);
                $("#eoperation_name").select2().select2('val', operation);
              }
            }
          });
        }
      </script>

      <script>
        $(document).on('click', '.view_report', function() {
          var id = $(this).data('recordId');
          var lab = $(this).data('typeId');
          getinvestigationparameter(id, $(this), lab);
        });

        function getinvestigationparameter(id, btn_obj, lab) {
          var modal_view = $('#viewDetailReportModal');
          var $this = btn_obj;
          $.ajax({
            url: base_url + 'admin/patient/getinvestigationparameter',
            type: "POST",
            data: {
              'id': id,
              'lab': lab
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');
              modal_view.addClass('modal_loading');

            },
            success: function(data) {
              $('#viewDetailReportModal .modal-body').html(data.page);
              $('#viewDetailReportModal #action_detail_report_modal').html(data.actions);
              $('#viewDetailReportModal').modal('show');
              modal_view.removeClass('modal_loading');
            },

            error: function(xhr) { // if error occured
              alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
              $this.button('reset');
              modal_view.removeClass('modal_loading');
            },
            complete: function() {
              $this.button('reset');
              modal_view.removeClass('modal_loading');

            }
          });
        }
      </script>

      <script type="text/javascript">
        $(document).on('click', '.print_bill', function() {
          var id = $(this).data('recordId');

          var $this = $(this);
          var lab = $(this).data('typeId');
          $.ajax({
            url: base_url + 'admin/patient/printpathoparameter',
            type: "POST",
            data: {
              'id': id,
              'lab': lab
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');
            },
            success: function(data) {
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
      </script>

      <script>
        $(document).on('change', '.findingtype', function() {
          $this = $(this);

          var section_ul = $(this).closest('div.row').find('ul.section_ul');
          var finding_id = $(this).val();
          div_data = "";
          $.ajax({
            type: 'POST',
            url: base_url + 'admin/patient/findingbycategory',
            data: {
              'finding_id': finding_id
            },
            dataType: 'JSON',

            beforeSend: function() {
              // setting a timeout
              $('ul.section_ul').find('li:not(:first-child)').remove();
            },
            success: function(data) {
              section_ul.append(data.record);

            },
            error: function(xhr) { // if error occured
              alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");

            },
            complete: function() {

            }
          });
        });

        $(document).on('change', '.findinghead', function() {

          $this = $(this);
          var head_id = $(this).val();
          div_data = "";
          $.ajax({
            type: 'POST',
            url: base_url + 'admin/patient/getfinding',
            data: {
              'head_id': head_id
            },
            success: function(res) {
              $("#finding_description").val(res);

            },
          });
        });

        $('.close_button').click(function() {
          $('#form_operationtheatre')[0].reset();
          $("#operation_category").select2().select2('val', '');
          $("#operation_name").select2().select2('val', '');
          $("#consultant_doctorid").select2().select2('val', '');
        })
      </script>

      <script type="text/javascript">
        function delete_prescription(visitid) {
          if (confirm('Are you sure')) {
            $.ajax({
              url: '<?php echo base_url(); ?>admin/prescription/deletePrescription/' + visitid,
              success: function(res) {
                window.location.reload(true);
              },
              error: function() {
                alert("Fail")
              }
            });
          }
        }

        $(document).ready(function(e) {
          $('#viewDetailReportModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
          });
        });

        function discharge_revert(case_id) {
          var base_url = '<?php echo base_url() ?>';
          $.ajax({
            type: 'POST',
            url: base_url + 'admin/bill/discharge_revert',
            data: {
              'module_type': 'opd',
              'case_id': case_id
            },
            dataType: 'json',

            success: function(res) {
              if (res.status == 'success') {
                successMsg(res.message);
                window.location.reload(true);
              } else {
                errorMsg(res.message);
              }
            },
          });
        }

        $(document).on('change', '.revisit_payment_mode', function() {
          var mode = $(this).val();
          if (mode == "Cheque") {
            $('.filestyle', '#revisitModal').dropify();
            $(".date").trigger("change");
            $('.revisit_cheque_div').css("display", "block");

          } else {
            $('.revisit_cheque_div').css("display", "none");
          }
        });
      </script>

      <script type="text/javascript">
        $(".patient_dob").on('changeDate', function(event, date) {
          var birth_date = $(".patient_dob").val();

          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getpatientage',
            type: "POST",
            dataType: "json",
            data: {
              birth_date: birth_date
            },
            success: function(data) {
              $('.patient_age_year').val(data.year);
              $('.patient_age_month').val(data.month);
              $('.patient_age_day').val(data.day);
            }
          });
        });
      </script>
      <script>
        $(document).on('click', '.editpayment', function() {
          var $this = $(this);
          var record_id = $this.data('recordId');
          var amount = $this.data('paymentAmount');
          $("#edit_payment").val(amount);
          $("#edit_payment_id").val(record_id);
          $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getopdpaymentdetails',
            type: 'post',
            data: {
              'payment_id': record_id
            },
            dataType: 'json',
            success: function(data) {
              $("#payment_mode").val(data.payment_mode).prop('selected');

              $(".payment_mode").trigger('change');
              $("#edit_cheque_no").val(data.cheque_no);
              $("#edit_cheque_date").val(data.cheque_date);
              $("#payment_date").val(data.payment_date);
              $("#edit_payment_note").val(data.note);
            }
          });

          $('#editpayment_modal').modal('show');
          //$this.button('loading');

        });
      </script>
      <script>
        //desarrollo cliniverso


        $(document).ready(function(e) {
          $("#editpaymentform").on('submit', (function(e) {
            e.preventDefault();
            $("#editpaymentbtn").button('loading');
            var payment_id = $("#edit_payment_id").val();
            var payment = $("#edit_payment").val();
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/editpayment',
              type: "POST",
              data: new FormData(this),
              dataType: 'json',
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function() {
                $("#editpaymentbtn").button('loading');
              },
              success: function(data) {
                if (data.status == 0) {
                  var message = data.message;
                  $.each(data.error, function(index, value) {
                    message += value;
                  });
                  errorMsg(message);
                } else {
                  successMsg(data.message);
                  window.location.reload(true);
                }
                $("#editpaymentbtn").button('reset');
              },
              error: function() {
                $("#editpaymentbtn").button('reset');
              },

              complete: function() {
                $("#editpaymentbtn").button('reset');
              }
            });
          }));
        });



        function getRevisitRecord2(opdid, id) {
          console.log(opdid);
          console.log(id);
          var listname = document.getElementById("listname").value;
          console.log(listname);
          var password = makeid(5);

          $('.select2-selection__rendered').html("");
          if (opdid == "" || listname == undefined) {
            $.ajax({
              url: '<?php echo base_url(); ?>admin/patient/getpatientDetails',
              type: "POST",
              data: {
                id: id
              },
              dataType: 'json',
              success: function(data) {
                console.log(data);
                console.log(data.guardian_name);
                console.log(data.eps);
                //                         $("#eupdateid").val(data.id);
                //                         $("#ename").val(data.patient_name);
                //                         $("#eguardian_name").val(data.guardian_name);
                //                         $("#emobileno").val(data.mobileno);
                //                         $("#eemail").val(data.email);
                //                         $("#eaddress").val(data.address);
                //                         $("#eage_year").val(data.age);
                //                         $("#eage_month").val(data.month);
                //                         $("#ebirth_date").val(data.dob);
                //                         $("#enote").val(data.note);
                //                         $("#exampleInputFile").attr("data-default-file", '<?php echo base_url() ?>' + data.image);
                //                         $(".dropify-render").find("img").attr("src", '<?php echo base_url() ?>' + data.image); 
                //                         $("#eknown_allergies").val(data.known_allergies); 
                //                         $('select[id="blood_groups"] option[value="' + data.blood_group + '"]').attr("selected", "selected");
                //                         $('select[id="egenders"] option[value="' + data.gender + '"]').attr("selected", "selected");
                //                         $('select[id="marital_statuss"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                //                         $("#myModal").modal('hide');
                //                         holdModal('myModaledit');
                $("#revisit_id").val(data.id);
                $("#eps_data").html(data.eps);
                $("#voluntad_anticipada").html(data.voluntad_anticipada);
                $("#regimen").html(data.regimen);
                $("#revisit_password").val(password);
                $("#listname").html(data.patient_name);
                //$('#revisit_guardian').val(data.guardian_name);
                $('#guardian').html(data.guardian_name);
                $('#rgender').html(data.gender);
                $("#revisit_contact").val(data.mobileno);
                $("#listnumber").html(data.mobileno);
                $("#pmobileno").val(data.mobileno);
                $("#appointment_date").val(data.appointment_date);
                $("#revisit_case").val(data.case_type);
                $("#pid").val(id);
                $("#revisit_allergies").val(data.known_allergies);
                $("#revisit_note").val(data.note);
                $("#revisit_refference").val(data.refference);
                $("#pemail").val(data.email);
                $("#remail").html(data.email);
                $("#rage").html(data.patient_age);
                $("#revisit_month").val(data.month);
                $("#revisit_height").val(data.height);
                $("#revisit_weight").val(data.weight);
                $("#revisit_bp").val(data.bp);
                $("#revisit_pulse").val(data.pulse);
                $("#esymptoms").val(data.symptoms);
                $("#revisit_temperature").val(data.temperature);
                $("#revisit_respiration").val(data.respiration);
                $("#revisit_blood_group").val(data.blood_group);
                $("#rblood_group").html(data.blood_group_name);
                $("#revisi_tax").val(data.tax);
                $("#revisit_address").val(data.address);
                $("#raddress").html(data.address);
                $("#rmarital_status").html(data.marital_status);
                $("#any_known_allergies").html(data.any_known_allergies);
                $("#remarks").html(data.note);
                $("#tpa_id").html(data.insurance_id);

                $("#tpa_validity").html(data.insurance_validity);
                $("#identification_number").html(data.identification_number);
                //                         $("#consultant_doctor").select2("val", data.cons_doctor);
                $('select[id="revisit_old_patient"] option[value="' + data.old_patient + '"]').attr("selected", "selected");
                $('select[id="rorganisation"] option[value="' + data.organisation_id + '"]').attr("selected", "selected");
                $('select[id="revisit_gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
                $('select[id="revisit_marital_status"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                holdModal('revisitModal');

              },
            });
          } else {

            $.ajax({
              url: base_url + 'admin/patient/getopdvisitdata',
              type: "POST",
              data: {
                opdid: opdid
              },
              dataType: 'json',
              success: function(data) {

                $("#revisit_id").val(data.id);

                $("#revisit_password").val(password);
                $("#listname").html(data.patient_name);
                //$('#revisit_guardian').val(data.guardian_name);
                $('#guardian').html(data.guardian_name);
                $('#rgender').html(data.gender);
                $("#revisit_contact").val(data.mobileno);
                $("#listnumber").html(data.mobileno);
                $("#pmobileno").val(data.mobileno);
                $("#appointment_date").val(data.appointment_date);
                $("#revisit_case").val(data.case_type);
                $("#pid").val(data.patientid);
                $("#revisit_allergies").val(data.known_allergies);
                $("#revisit_note").val(data.note);
                $("#revisit_refference").val(data.refference);
                $("#pemail").val(data.email);
                $("#remail").html(data.email);
                if (data.live_consult) {
                  $("#live_consultrevisit").val(data.live_consult);
                }

                if (data.image != '') {
                  $("#patient_image").attr("src", "<?php echo base_url(); ?>" + data.image);
                } else {
                  $("#patient_image").attr("src", "<?php echo base_url(); ?>uploads/patient_images/no_image.png");
                }

                $("#rage").html(data.patient_age);
                $("#revisit_month").val(data.month);
                $("#revisit_height").val(data.height);
                $("#revisit_weight").val(data.weight);
                $("#revisit_bp").val(data.bp);
                $("#revisit_pulse").val(data.pulse);
                $("#esymptoms").val(data.symptoms);
                $("#revisit_temperature").val(data.temperature);
                $("#revisit_respiration").val(data.respiration);
                $("#revisit_blood_group").val(data.blood_group);
                $("#rblood_group").html(data.blood_group_name);
                $("#revisi_tax").val(data.tax);
                $("#revisit_address").val(data.address);
                $("#raddress").html(data.address);
                $("#rmarital_status").html(data.marital_status);
                $("#any_known_allergies").html(data.any_known_allergies);
                $("#remarks").html(data.note);
                $("#tpa_id").html(data.insurance_id);

                $("#tpa_validity").html(data.insurance_validity);
                $("#identification_number").html(data.identification_number);
                $("#consultant_doctor").select2("val", data.cons_doctor);
                $('select[id="revisit_old_patient"] option[value="' + data.old_patient + '"]').attr("selected", "selected");
                $('select[id="rorganisation"] option[value="' + data.organisation_id + '"]').attr("selected", "selected");
                $('select[id="revisit_gender"] option[value="' + data.gender + '"]').attr("selected", "selected");
                $('select[id="revisit_marital_status"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                holdModal('revisitModal');
              },

            })

          }
        }

        function buscarPalabra(objeto, palabra) {
          let options = "";
          for (const clave of objeto) {
            if (typeof clave.codigocups === 'string') {
              if (clave.descripcion_min.includes(palabra)) {
                options += `<option value="${clave.codigocups}">${clave.descripcion_min}</option>`;
                console.log(clave.codigocups);
              }
            } else if (typeof clave.codigocups === 'object') {
              console.log("Entro aqui");
              buscarPalabra(clave.codigocups, palabra); // Llamada recursiva para objetos anidados
            }
          }
          document.getElementById(palabra).innerHTML = options;
        }

        //       document.addEventListener('click',
        //       function filterInitial(event){
        //               const input_lname = document.getElementById("lname");
        // //               let cups = document.getElementById("cups");
        //               input_lname.value = "<?= $field_value?>";
        // //               filtered(input_lname, cups, "li");
        //               filtercups();
        //       }); 


        //      function filtercups(){
        //         var input, filter, ul, li, a, i, txtValue;
        //         input = document.getElementById("lname");
        //         filter = input.value.toUpperCase();
        //         ul = document.getElementById("cups");
        //         if (input.value.length != 0) {
        //           ul.removeAttribute("hidden");
        //         } else if (input.value.length == 0) {
        //           ul.setAttribute("hidden", false);
        //         }
        //         li = ul.getElementsByTagName("li");

        //         for (i = 0; i < li.length; i++) {
        //           a = li[i];
        //           txtValue = a.textContent || a.innerText;
        //           if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //             li[i].style.display = "";
        //           } else {
        //             li[i].style.display = "none";
        //           }
        //         }
        //       }

        function busqueda() {
          let input_lname, cups, input_medicines, medicines, input_cups, cups_result, input_procedure, procedure
          input_medicines = document.getElementById("search_medicine");
          input_lname = document.getElementById("lname");
          input_procedure = document.getElementById("search_procedure");

          //         procedure = document.getElementById("procedure");
          //         filtered(input_procedure, procedure, "li");

          input_cups = document.getElementById("search_cups");

          cups_result = document.getElementById("cups_result");
          filtered(input_cups, cups_result, "li");

          medicines = document.getElementById("result_incodol");
          filtered(input_medicines, medicines, "li");

          //         cups = document.getElementById("cups");
          //         filtered(input_lname, cups, "li");
        }


        function filtered(element, content, search) {
          let filter, li, a, i, txtValue;
          filter = element.value.toUpperCase();
          if (element.value.length != 0) {
            content.removeAttribute("hidden");
          } else if (element.value.length == 0) {
            content.setAttribute("hidden", false);
          }
          li = content.getElementsByTagName(search);
          for (i = 0; i < li.length; i++) {
            a = li[i];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              li[i].style.display = "";
            } else {
              li[i].style.display = "none";
            }
          }

          document.addEventListener('click', function(event) {
            const targetElement = event.target;

            if (targetElement !== element && !content.contains(targetElement)) {
              element.value = "";
              content.setAttribute("hidden", false);
            }
          });
        }

        function removeDuplicatesMedicines(array) {
          const uniqueArray = [];
          const map = new Map();

          for (const item of array) {
            const key = item.descripcioncomercial;
            if (!map.has(key)) {
              map.set(key, true);
              uniqueArray.push(item);
            }
          }

          return uniqueArray;
        }


      function pbs_medications() {
          let input_medicines_pbs = document.getElementById("search_pbs").value.toUpperCase();
          let medicines_result = document.getElementById("medicines_pbs");
          $.ajax({
              url: `https://www.datos.gov.co/resource/a7iv-sme8.json?$where=atc%20like%20'%25${input_medicines_pbs}%25'%20OR%20principioactivo%20like%20'%25${input_medicines_pbs}%25'%20OR%20descripcionatc%20like%20'%25${input_medicines_pbs}%25'%20OR%20concentracion%20like%20'%25${input_medicines_pbs}%25'&$limit=30&$offset=0`,
              type: 'GET',
              dataType: 'json',
              data: {
                  "$$app_token": "SRFsensloxdn0TDPB95X5rzpN"
              },
              success: (resp) => {
                  let uniquePrincipiosActivos = new Set();
                  let medicines_list_pbs = "";
                  let medicines_pbs = resp;
                  if (input_medicines_pbs.length != 0) {
                      medicines_result.removeAttribute("hidden");
                  } else if (input_medicines_pbs.length == 0) {
                      medicines_result.setAttribute("hidden", false);
                  }
                  //desarrollo cliniverso -- cambio a input de medicamentos
                  for (let property of medicines_pbs) {
                      // Verificar si el principio activo ya ha sido agregado
                      if (!uniquePrincipiosActivos.has(property.principioactivo)) {
                          uniquePrincipiosActivos.add(property.principioactivo);

                          medicines_list_pbs += `<li class="list-group-item list-hover" onclick="addMedication({expediente:'${property.expediente}',
                                                                                                              producto:'${property.producto}',
                                                                                                              principioactivo:'${property.principioactivo}',
                                                                                                              formafarmaceutica:'${property.formafarmaceutica}',
                                                                                                              viaadministracion:'${property.viaadministracion}',
                                                                                                              unidadmedida:'${property.unidadmedida}',
                                                                                                              unidadreferencia:'${property.unidadreferencia}',
                                                                                                              cantidad:'${property.cantidad}',
                                                                                                              descripcionatc:'${property.descripcionatc}',
                                                                                                              descripcioncomercial:'${property.descripcioncomercial}',
                                                                                                              atc:'${property.atc}',
                                                                                                            })">
                                                  <div class="col-xs-10 col-sm-9" style="width: 100%;">
                                                      <span class="name"><strong>Codigo atc: </strong>${property.atc} / <strong>Principio activo: </strong>${property.principioactivo} /<strong>Principio activo min: </strong>${property.unidadreferencia}</span>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </li>`;
                      }
                  }
                  medicines_result.innerHTML = medicines_list_pbs;
              }
          });

          document.addEventListener('click', function(event) {
            const targetElement = event.target;

            if (targetElement !== input_medicines_pbs && !medicines_result.contains(targetElement)) {
              document.getElementById("search_pbs").value = "";
              medicines_result.setAttribute("hidden", false);
            }
          });
        }

        //       function medication_structure(
        //           {
        //              Codigo_Atc,
        //              Principio,
        //              principioactivo_min
        //            }
        //       ){

        //          console.log(Codigo_Atc);
        //          console.log(Principio);
        //          console.log(principioactivo_min);
        //          let  split_principio = Principio.split(/\s\+\s/);
        //           let  split_Codigo_Atc = Codigo_Atc.split(/\s\/\s/);
        //           let id_docLength = split_principio.length;
        //           console.log(id_docLength);

        //          console.log(split_Codigo_Atc);   

        //          let input_medicines = document.getElementById("search_pbs").value.toUpperCase();
        //          let medicines_result = document.getElementById("medicines");

        //         var url_search = `https://www.datos.gov.co/resource/i7cb-raxc.json?atc= ${split_Codigo_Atc[0]}&descripcionatc= ${split_principio[0]}`;
        //          let myTimer = setInterval(() => {
        //            console.log(url_search);
        //          $.ajax({
        //             url : url_search,
        //             type : 'GET',
        //             dataType : 'json',
        //             data: {
        //               "$$app_token" : "SRFsensloxdn0TDPB95X5rzpN"
        //             },
        //             success : (resp) => {
        //             console.log(id_docLength);
        //               console.log(resp);
        //               let medicines = resp;
        //               if(resp!=''){
        //                 let medicines = resp;
        //                 clearInterval(myTimer);
        //               }else{
        //                     if(id_docLength >1 && resp ==''){
        //     //               $.each(split_principio, function (i, obj){
        //     //                 split_principio.length
        //     //               });
      
        //                   for (let i = 1; i < split_principio.length; i++) {
        //                     console.log(`Index: ${i}, Value: ${split_principio[i]}`);
        //                     url_search = `https://www.datos.gov.co/resource/i7cb-raxc.json?atc= ${Codigo_Atc[0]}&descripcionatc= ${split_principio[i]}`;
        //                     console.log(split_principio.length);
        //                     var colength = split_principio.length-1;
        //                     console.log(url_search);
        //                     if(i == colength){
        //                       clearInterval(myTimer);
        //                       }  
        //                     let medicines = resp;
        //                   }
        //                    console.log(split_principio);
        //                  }
        //                 clearInterval(myTimer);
        //               }

        //             if (input_medicines.length != 0) {
        //                 medicines_result.removeAttribute("hidden");
        //             } else if (input_medicines.length == 0) {
        //               medicines_result.setAttribute("hidden", false);
        //             }
        //             let uniqueMedicines = removeDuplicatesMedicines(medicines);
        //             console.log(uniqueMedicines);
        //             let medicines_list ="";
        //             let option_via ="";
        //             for (let property of uniqueMedicines ) {
        //                 medicines_list += `<li class="list-group-item list-hover" onclick="addMedication({expediente:'${property.expediente}',
        //                                                                                                   producto:'${property.producto}',
        //                                                                                                   titular:'${property.titular}',
        //                                                                                                   principioactivo:'${property.principioactivo}',
        //                                                                                                   formafarmaceutica:'${property.formafarmaceutica}',
        //                                                                                                   viaadministracion:'${property.viaadministracion}',
        //                                                                                                   unidadmedida:'${property.unidadmedida}',
        //                                                                                                   cantidad:'${property.cantidad}',
        //                                                                                                   cantidadcum:'${property.cantidadcum}',
        //                                                                                                   estadocum:'${property.estadocum}',
        //                                                                                                   descripcionatc:'${property.descripcionatc}',
        //                                                                                                   descripcioncomercial:'${property.descripcioncomercial}',
        //                                                                                                   atc:'${property.atc}',
        //                                                                                                 })">
        //                                       <div class="col-xs-10 col-sm-9">
        //                                           <span class="name"><strong>Expediente: </strong>${property.expediente}</span><br>
        //                                           <span class="name"><strong>Producto: </strong>${property.producto}</span><br>
        //                                           <span class="name"><strong>Descripción comercial: </strong>${property.descripcioncomercial}</span><br>
        //                                           <span class="name"><strong>Principio activo: </strong>${property.principioactivo}</span><br>
        //                                           <span class="name"><strong>Descripción atc: </strong>${property.descripcionatc}</span><br>
        //                                       </div>
        //                                       <div class="clearfix"></div>
        //                                   </li>`;

        //             } 

        //            document.getElementById("medicines").innerHTML= medicines_list;
        //            document.getElementById("search_pbs").value = "";
        //            document.getElementById("medicines_pbs").setAttribute("hidden", false);
        //           }   
        //         });
        //         },100);
        //          document.addEventListener('click', function(event) {
        //           const targetElement = event.target;
        //           let input = document.getElementById("search_pbs");

        //           if (targetElement !== input_medicines && !medicines_result.contains(targetElement)) {
        //             document.getElementById("search_medicine").value = "";
        //             medicines_result.setAttribute("hidden", false);
        //           }
        //         });
        //       }

        function addMedication({
          expediente,
          producto,
          titular,
          principioactivo,
          formafarmaceutica,
          viaadministracion,
          unidadmedida,
          cantidad,
          cantidadcum,
          estadocum,
          descripcionatc,
          descripcioncomercial,
          atc
        }) {
          console.log(principioactivo);
          //                                                                                                {principioactivo: '${property.principio}',
          //                                                                                                  cantidad: '${property.DOSIS}',
          //                                                                                                  formafarmaceutica: '${property.PRESENTACIÓN}
          let myJSON = JSON.stringify({
            "atc": atc,
            "descripcionatc": descripcionatc
          });


          $.ajax({
            url: baseurl + 'admin/patient/medication_alert',
            type: "POST",
            data: myJSON,
            dataType: 'json',
            cache: false,
            processData: false,
            success: function(data) {
              console.log(data.status);
              if (data.status == "success") {
                holdModal('alert_modal');
                document.getElementById("message_vade").innerHTML = `<h3>${data.message}</h3>`;
                //                   successMsg(data.message);
              } else {

              }
              $("#formaddbtn").button('reset');
            },
            error: function() {}
          });


          let search_pbs = document.getElementById("search_pbs");
          let medicines = document.getElementById("medicines_pbs");

          let input_medicines = document.getElementById("search_medicine");
          let result_incodol = document.getElementById("result_incodol");

          let medication_dose = document.getElementById("medication_dose");
          let medication_periodicity = document.getElementById("medication_periodicity");
          let medication_time = document.getElementById("medication_time");
          let medication_total = document.getElementById("medication_total");
          let medication_during = document.getElementById("medication_during");
          let medication_each = document.getElementById("medication_each");


          document.addEventListener('click', function(event) {
            const targetElement = event.target;

            if (targetElement !== search_pbs && medicines.contains(targetElement) || targetElement !== input_medicines && result_incodol.contains(targetElement)) {
              search_pbs.value = "";
              medicines.setAttribute("hidden", false);
              input_medicines.value = "";
              result_incodol.setAttribute("hidden", false);

              medication_dose.selectedIndex = 0;
              medication_during.selectedIndex = 0;
              medication_each.selectedIndex = 0;
              medication_periodicity.value = "";
              medication_time.value = "";
              medication_total.value = "";
            }

          });

          let creation = document.getElementById('creation_medicine');
          let concentration = document.getElementById('concentration');
          let form_pharmaceutical = document.getElementById('pharmaceutical');
          let active_principle = document.getElementById('active_principle');
          let medication_through = document.getElementById('medication_through');
          let medicine_product = document.getElementById('medicine_product');
          let holder_name = document.getElementById('holder_name');
          let trade_name = document.getElementById('trade_name');


          active_principle.value = `${principioactivo}`;
          concentration.value = unidadmedida ? cantidad + ' ' + unidadmedida : cantidad;
          //          concentration.value = `${producto}`;
          form_pharmaceutical.value = `${formafarmaceutica}`;
          medication_through.value = viaadministracion ? viaadministracion : '';

          medicine_product.value = `${producto}`;
          holder_name.value = `${titular}`;
          trade_name.value = `${descripcioncomercial}`;
        }


        $("talla_custom").change(function() {
          alert("The text has been changed.");
        });

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
      </script>
      <!--by desarrollo cliniverso -->



      <script>

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
        
        

          function cosntruct_table_second_diag(dato, tipo, nota, clase) {
            $("#custom_fields[opd][74]").val();
            let tblDatos = document.getElementById('table_diag').insertRow(0);
            let col1 = tblDatos.insertCell(0);
            let col2 = tblDatos.insertCell(1);
            let col3 = tblDatos.insertCell(2);
            let col4 = tblDatos.insertCell(3);
            let col5 = tblDatos.insertCell(4);
            col1.innerHTML = dato;
            col2.innerHTML = tipo;
            col3.innerHTML = nota;
            col4.innerHTML = clase;
            col5.innerHTML = `<button type="button" onclick="removerCelda(this,'${dato}')" class="btn btn-warning pull-right" autocomplete="off"><i class="fa fa-minus"></i> Quitar</button>`;
        }


        function addDataToRow(data) {
          // Add the data to the DataTable
          var newRow = table.row.add(data).draw().node();

          // Add a delete button to the new row
          $(newRow).find('td:last').html('<button class="deleteRow">Eliminar</button>');

          // Add click event to the delete button
          $(newRow).find('.deleteRow').click(function() {
            table.row($(newRow)).remove().draw();
          });
          table.ajax.reload();
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


        function get_diagnosis(id){
          
            console.log(id);
          
            if ($.fn.DataTable.isDataTable('#diagnosticos')) {
                $('#diagnosticos').DataTable().destroy();
            }
          
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
                if(resp.state == 'success'){
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
        

        function array_diag(diag, position) {
          var j = position++;
          console.log(j++);
          console.log(position);
        }

        function removerCelda(elementoBoton, code) {
          var fila = elementoBoton.parentNode.parentNode; // Obtiene la fila actual
          fila.remove(); // Remueve toda la fila
          console.log(code);
          console.log(diagnosticos);
          diagnosticos.forEach(element => bag(element));

          function bag(element) {
            console.log(element);
            var select_diag2 = "";
            var nota = "";
            var tipo = "";
            select_diag2 = document.getElementById("second_diag").value;
            nota = document.getElementById('second_diag_text').value;
            tipo = document.getElementById('second_diag_confirm').value;
            var code2 = select_diag2 + "-" + nota + "-" + tipo;
            if (element == code2) {
              var palabraBuscada = element;

              var indice = diagnosticos.indexOf(palabraBuscada);
              if (indice !== -1) {
                diagnosticos.splice(indice, 1); // Elimina 1 elemento en el índice encontrado
                console.log(diagnosticos);
              } else {
                console.log("La palabra no se encontró en el array.");
              }

              console.log(diagnosticos); // Muestra el array actualizado
              //               var dial =JSON.stringify([diagnosticos]);
              //               console.log(dial);
              //               console.log(JSON.stringify({ x: [10, undefined, function(){}, Symbol('')] }));
              //                console.log(JSON.stringify({ x: diagnosticos }));
              var text_split = diagnosticos.toString();
              var text = text_split.split(',');
              console.log(text_split);

              console.log(code);
            }
          }
        }


        function buscarPalabra(objeto, palabra) {
          let options = "";
          for (const clave of objeto) {
            if (typeof clave.CÓDIGO === 'string') {
              if (clave.CÓDIGO.includes(palabra)) {
                options += `<option value="${clave.CÓDIGO}">${clave.CÓDIGO}</option>`;
                console.log(clave.CÓDIGO);
              }
            } else if (typeof clave.CÓDIGO === 'object') {
              console.log("Entro aqui");
              buscarPalabra(clave.CÓDIGO, palabra); // Llamada recursiva para objetos anidados
            }
          }
          document.getElementById(palabra).innerHTML = options;

        }


        //     window.addEventListener('load', 
        //         function cups_structure(){
        //           $.ajax({
        //             url : "https://www.datos.gov.co/resource/9zcz-bjue.json",
        //             type : 'GET',
        //             dataType : 'json',
        //             success : (resp) => {
        //             console.log(resp);
        //             let cups = resp;
        //              let cups_option ="";
        //              for (let property of cups ) {
        //                   cups_option += "<option value="+property.codigocups+" >"+property.codigocups+"-"+property.descripcion_min+"</option>";
        //              } 
        //              document.getElementById("cups").innerHTML=cups_option;
        //           }   
        //       });

        // filtrar cups normales desde la api

        //     window.addEventListener('load', 
        //     function cups_structure(){
        //       $.ajax({
        //         url : "<?=base_url('uploads/json/procedemientosiss2000.json')?>",
        //         type : 'GET',
        //         dataType : 'json',
        //         success : (resp) => {
        //         console.log(resp);



        //          let cups = resp;
        //          let cups_list ="";
        //          for (let property of cups ) {
        //                 cups_list += `<li class="list-group-item list-hover" onclick="add_destine({ codigo:'${property.Codigo}',
        //                                                                                           producto:'${property.Procedimiento}',
        //                                                                                         })">
        //                                   <div class="col-xs-10 col-sm-9">
        //                                       <span class="name"><strong>Codigo: </strong>${property.Codigo}</span><br>
        //                                       <span><strong>Descripcion: </strong>${property.Procedimiento}</span>
        //                                   </div>
        //                                   <div class="clearfix"></div>
        //                               </li>`;
        //          } 

        //         document.getElementById("cups").innerHTML= cups_list;
        // //      document.getElementById("procedure").innerHTML= cups_list;

        //       }   
        //     });  
        //   });

        // filtrar cups desde el archivo ecxel convertido a json "es diferente".
        function paraclinic() {

          let search_paraclini = document.getElementById("paraclinic_input").value.toUpperCase();
          let paraclini_result = document.getElementById("paraclini_result");
          console.log(search_paraclini);

          let url = ``;

          if (/^[0-9]+$/.test(search_paraclini)) {
            url = `https://www.datos.gov.co/resource/s5f2-yivs.json?$where=codigolaboratorio= ${search_paraclini}&$limit=100&$offset=0`
          } else {
            url = `https://www.datos.gov.co/resource/s5f2-yivs.json?$where=descripcion%20like%20'%25${search_paraclini}%25'&$limit=100&$offset=0`
          }

          $.ajax({
            //         url : `https://www.datos.gov.co/resource/s5f2-yivs.json?$where=codigolaboratorio%20like%20'%25${search_paraclini}%25'%20OR%20descripcio%20like%20'%25${search_paraclini}%25'%20OR%20codigocups%20like%20'%25${search_paraclini}%25'&$limit=10&$offset=0`,

            url: url,
            type: 'GET',
            dataType: 'json',
            data: {
              "$$app_token": "SRFsensloxdn0TDPB95X5rzpN"
            },
            success: (resp) => {
              console.log(resp);

              let paraclini = resp;
              if (paraclini.length != 0) {
                paraclini_result.removeAttribute("hidden");
              } else if (paraclini.length == 0) {
                paraclini_result.setAttribute("hidden", false);
              }
              //             let uniqueMedicines = removeDuplicatesMedicines(cups);
              //             console.log(uniqueMedicines);
              let paraclini_list = "";
              for (let property of paraclini) {
                paraclini_list += `<li class="list-group-item list-hover" onclick="add_paraclini({ codigo:'${property.codigolaboratorio}',
                                                                                            producto:'${property.descripcion}',
                                                                                          })">
                                    <div class="col-xs-10 col-sm-9" style="width: 100%;">
                                        <span class="name"><strong>Codigo Cups: </strong>${property.codigocups}</span><br>
                                        <span><strong>Descripción: </strong>${property.descripcion}</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>`;
              }

              document.getElementById("paraclini_result").innerHTML = paraclini_list;

            }
          });


          //       document.addEventListener('click', function(event) {
          //           const targetElement = event.target;

          //           if (targetElement !== search_paraclini && !paraclini_result.contains(targetElement)) {
          //             search_paraclini.value = "";
          //             paraclini_result.setAttribute("hidden", false);
          //           }
          //       });

        }
        
        // Función para quitar tildes y convertir a minúsculas
          function normalizeString(input) {
            return input.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toUpperCase();
          }

         

          // Normalizar el valor del input

       

        function cups_structure() {
            
            let search_cups = document.getElementById("search_cups").value;
            let cups_result = document.getElementById("cups_result");
            search_cups = normalizeString(search_cups);


            $.ajax({
              url: `https://www.datos.gov.co/resource/9zcz-bjue.json?$where=codigoprocedimiento%20like%20'%25${search_cups}%25'%20OR%20descripcion%20like%20'%25${search_cups}%25'%20OR%20codigocups%20like%20'%25${search_cups}%25'&$limit=60&$offset=0`,
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



        function add_paraclini({
          codigo,
          producto
        }) {

            let paraclini_result = document.getElementById('paraclini_result');
            let product_para = document.getElementById('product_para');
            let codigo_para = document.getElementById('codigo_para');
            let search_paraclini = document.getElementById('search_paraclini');
            let paraclinic_input = document.getElementById('paraclinic_input');

            codigo_para.value = `${codigo}`;
            product_para.value = `${producto}`;
            paraclinic_input.value = producto;

            document.addEventListener('click', function(event) {
              const targetElement = event.target;

              if (targetElement !== search_paraclini && paraclini_result.contains(targetElement)) {
                paraclini_result.setAttribute("hidden", false);

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

              //                 medication_dose.selectedIndex = 0;
              //                 codigo_cups.value = "";
              //                 product_cups.value = ""; 
              search_cups.value = "";
            }
          });


          codigo_cups.value = `${codigo}`;
          product_cups.value = `${producto}`;


          //         let myJSON = JSON.stringify({"atc": atc, "descripcionatc": descripcionatc});


          //          $.ajax({
          //             url: baseurl+'admin/patient/medication_alert',
          //             type: "POST",
          //             data: myJSON,
          //             dataType: 'json',
          //             cache: false,
          //             processData: false,
          //             success: function (data) {
          //                 console.log(data.status);
          //                 if (data.status == "success" ){
          //                   holdModal('alert_modal');
          //                   document.getElementById("message_vade").innerHTML=`<h3>${data.message}</h3>`;
          // //                   successMsg(data.message);
          //                 } else {

          //                 }
          //                 $("#formaddbtn").button('reset');
          //             },
          //               error: function () {
          //             }
          //         });


        }


      window.addEventListener('load',
        function orales_incodol() {
          $.ajax({
            url: "<?= base_url('');?>/uploads/json/orales_incodol.json",
            type: 'GET',
            dataType: 'json',
            success: (resp) => {
              console.log(resp);
              let incodol = resp;
              let data_incodol = "";
              for (let property of incodol) {
                data_incodol += `<li class="list-group-item list-hover" onclick="addMedication({principioactivo: '${property.principio}',
                                                                                                 cantidad: '${property.DOSIS}',
                                                                                                 formafarmaceutica: '${property.PRESENTACIÓN}'})">
                                      <div class="col-xs-10 col-sm-9" style="width: 100%;">
                                          <span class="name">
                                               <strong>Presentaciòn: </strong>${property.PRESENTACIÓN}/
                                               <strong>Principio: </strong>${property.principio}/
                                               <strong>Dosis: </strong>${property.DOSIS}/
                                          </span>
                                      </div>
                                      <div class="clearfix"></div>
                                  </li>`;
              }

              document.getElementById("result_incodol").innerHTML = data_incodol;

            }
          });
        });



        function get_medicines() {
          //         console.log("medicines");
          $.ajax({
            url: "<?= base_url('');?>/uploads/json/orales_incodol.json",
            type: 'GET',
            dataType: 'json',
            success: (resp) => {
              console.log(resp);
              let incodol = resp;
              let text_categories = "";
              let text_medicines = "";
              let text_dosis = "";
              for (let property of incodol) {
                text_categories += "<option value=" + property.PRESENTACIÓN + ">" + property.PRESENTACIÓN + "</option>";
                text_medicines += "<option value=" + property.DOSIS + " >" + property.principio + "</option>";
                text_dosis += "<option value=" + property.PRESENTACIÓN + ">" + property.DOSIS + "</option>";
              }
              document.getElementById("incodol_categories").innerHTML = text_categories;
              document.getElementById("incodol_medicines").innerHTML = text_medicines;
              document.getElementById("incodol_dosis").innerHTML = text_dosis;
            }
          });
        }

        function filtercategories() {
          var input_categories, filter_categories, ul_categories, li_categories, a_categories, i_categories, txtValue_categories, txtValue;
          input_categories = document.getElementById("incodol_categories");
          filter_categories = input.value.toUpperCase();
          ul_categories = document.getElementById("incodol_medicines");
          li_categories = ul_categories.getElementsByTagName("option");
          for(i_categories = 0; i_categories < li_categories.length; i_categories++) {
            a_categories = li_categories[i_categories];
            txtValue_categories = a_categories.textContent || a_categories.innerText;

            if (txtValue.toUpperCase().indexOf(filter_categories) > -1) {
              li_categories[i_categories].style.display = "";
            } else {
              li_categories[i_categories].style.display = "none";
            }
          }
        }


        function filter() {
          var input, filter, ul, li, a, i, txtValue;
          input = document.getElementById("second_diag");
          filter = input.value.toUpperCase();
          ul = document.getElementById("lista_second");

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
          console.log("reset");
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




        $(document).on('change', '.custom_fields[patient][4]', function() { 
            var mode = $(this).val();
            console.log(mode);
        });

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

        const selectElements = document.querySelectorAll('.information');
        const valoresSeleccionados = Array.from(selectElements).map(() => '');
        selectElements.forEach((selectElement, index) => {
          selectElement.addEventListener('change', actualizarResultado);
          selectElement.addEventListener('keyup', actualizarResultado);

          function actualizarResultado(event) {
            const valorSeleccionado = event.target.value;
            valoresSeleccionados[index] = valorSeleccionado;

            let medication_dose, medication_periodicity, medication_time, medication_total, medication_during, medication_each;
            medication_dose = document.getElementById("medication_dose");
            medication_periodicity = document.getElementById("medication_periodicity");
            medication_time = document.getElementById("medication_time");
            medication_total = document.getElementById("medication_total");
            medication_during = document.getElementById("medication_during");
            medication_each = document.getElementById("medication_each");

            if (valoresSeleccionados.every(valor => valor !== '') && medication_periodicity.value !== '' && medication_time.value !== '') {

              let dose, each, during, periodicity, time
              during = medication_during.options[medication_during.selectedIndex].value;
              each = medication_each.options[medication_each.selectedIndex].value;
              dose = medication_dose.options[medication_dose.selectedIndex].value;
              periodicity = medication_periodicity.value;
              time = medication_time.value;
              const factorDuracion = getFactorDuracion(during);
              const factorIntervalo = getFactorIntervalo(each);
              console.log(dose);
              console.log(each);
              console.log(factorDuracion);
              console.log(factorIntervalo);
              const cantidadDosis = (time * factorDuracion / (periodicity * factorIntervalo));
              console.log(cantidadDosis);
              const cantidadMedicamentos = Math.ceil(dose * cantidadDosis);
              console.log(cantidadMedicamentos);


              medication_total.value = cantidadMedicamentos;

            }

          }

        });

        function getFactorDuracion(unidadDuracion) {
          const unidadesDuracion = {
            Semanas: 7,
            Meses: 30,
            Años: 365,
            Dias: 1,
          };

          return unidadesDuracion[unidadDuracion] || 1;
        }

        function getFactorIntervalo(unidadIntervalo) {
          const unidadesIntervalo = {
            Minutos: 1 / (60 * 24),
            Horas: 1 / 24,
            Dias: 1,
            Semanas: 7,
          };

          return unidadesIntervalo[unidadIntervalo] || 1;
        }
      </script>
        
        
      <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        
     <script type="text/javascript">
       
      function confirmar_opd(id_user, id_opd, id_visit) {
          holdModal('confirm_appointment');
          const formBtnOpd = document.getElementById('status_opd_btn');
          const check_status = document.getElementById('check_status');
          const signed_checkbox = document.getElementById('signed_checkbox');

          $("#status_opd").on('submit', (function(e) {

              $("#status_opd_btn").button('loading');
              e.preventDefault();

              $.ajax({
                url: `<?= base_url('admin/patient/change_state_opd/')?>${id_user}/${id_opd}/${id_visit}`,
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(resp) {
                    if (resp.status === "fail") {
                        let message = '';
                        for (const error of Object.values(resp.errors)) {
                            message += error+'<br>';
                        }
                        errorMsg(message);
                    } else {    
                        localStorage.setItem('showAlert', resp.msg);
                        window.location.reload('true');
                    }

                    $("#status_opd_btn").button('reset');
                },
                error: function(error) {
                    console.error(error);
                }
              });
          }));
       }

        window.addEventListener('load', startTime);

        function startTime() {

          const timeInitial = "<?= $doctor_app[0]->time?>";
          const timeDuring = "<?= $fecha->format('H:i:s')?>";


          var today = new Date();
          var hours = today.getHours();
          var minutes = today.getMinutes();
          var seconds = today.getSeconds();
          ap = (hours < 12) ? "<span>AM</span>" : "<span>PM</span>";
          hours = (hours == 0) ? 12 : hours;
          hours = (hours > 12) ? hours - 12 : hours;
          //Add a zero in front of numbers<10
          hours = checkTime(hours);
          minutes = checkTime(minutes);
          seconds = checkTime(seconds);


          if (`${hours}:${minutes}:${seconds}` === timeDuring) {

            $.ajax({
              url: baseurl + 'admin/patient/finish_attention',
              type: "POST",
              dataType: 'json',
              cache: false,
              processData: false,
              success: function(data) {
                if (data.status == "success") {
                  console.log('entro aqui');
                  successMsg('Se termino la cita');
                } else {
                  console.log('entro al else');
                }
              },
              error: function() {}
            });

          } else {
            document.getElementById("time_progress").innerHTML = `<strong>Hora actual: </strong>${hours}:${minutes}:${seconds} ${ap}`;
            setTimeout(startTime, 1000);
          }
        }

        function checkTime(i) {
          if (i < 10) {
            i = "0" + i;
          }
          return i;
        }

        function check_antecedentes(fieldId) {
          document.getElementById(fieldId).value = "No refiere";
        }

        function check_sistemas(fieldId) {
          document.getElementById(fieldId).value = "Normal";
        }
      </script>
      <script type="text/javascript">
        function toggleIcon(e) {
          $(e.target)
            .prev(".panel-heading")
            .find(".more-less")
            .toggleClass("fa-plus fa-minus");
        }
        $(".panel-group").on("hidden.bs.collapse", toggleIcon);
        $(".panel-group").on("shown.bs.collapse", toggleIcon);
      </script>

      <script type="text/javascript">
        $(document).on('click', '#add_newcharge', function() {

        });

        $(document).on('click', '.printBill', function() {

          var opd_id = <?php echo $opdid ?>;

          var $this = $(this);

          $.ajax({
            url: base_url + 'admin/patient/printbill',
            type: "POST",
            data: {
              opd_id: opd_id
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');
            },
            success: function(data) {
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






        $(document).on('click', '.print_opd_clini', function() {

          var opd_id = <?php echo $opdid ?>;

          var $this = $(this);

          $.ajax({
            url: base_url + 'admin/patient/print_opd_clini',
            type: "POST",
            data: {
              opd_id: opd_id
            },
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');
            },
            success: function(data) {
              popup(data.page);
              console.log(data);
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
      </script>
      <script>

        function sura_cups() {
          var search = document.getElementById("reps_name").value;
          $.ajax({
            url: "<?= base_url('');?>/patient/json_data/"+search,
            type: 'GET',
            
            success: (resp) => {;
              console.log(resp);
              var sura_cups = resp;
              let result_sura_cups = document.getElementById("result_sura_cups");
              let sura_cups_list = "";
              if (sura_cups.length != 0) {
                result_sura_cups.removeAttribute("hidden");
              } else if (sura_cups.length == 0) {
                result_sura_cups.setAttribute("hidden", false);
              }
              for (let property of sura_cups) {
                sura_cups_list += `<li class="list-group-item list-hover" onclick="addsura_cups({codigo: '${property.codigo}',
                                                                                                      descripcion: '${property.descripcion}'})">
                                              <div class="col-xs-10 col-sm-9" style="width: 100%;">
                                                  <span class="name">
                                                       <strong>Codigo: </strong>${property.codigo}/
                                                       <strong>Nombre: </strong>${property.descripcion}
                                                  </span>
                                              </div>
                                              <div class="clearfix"></div>
                                          </li>`;
              }

              document.getElementById("result_sura_cups").innerHTML = sura_cups_list;

              var input, filter, ul, li, a, i, txtValue;
              input = document.getElementById("reps_name");
              console.log(input.value.length);
              filter = input.value.toUpperCase();
              ul = document.getElementById("result_sura_cups");
              console.log(ul);
              if (input.value.length != 0) {
                document.getElementById("result_sura_cups").removeAttribute("hidden");
              } else if (input.value.length == 0) {
                document.getElementById("result_sura_cups").setAttribute("hidden", false);
              }
              li = document.getElementById("result_sura_cups").getElementsByTagName("li");

              for (i = 0; i < li.length; i++) {
                a = li[i];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  li[i].style.display = "";
                } else {
                  li[i].style.display = "none";
                }
              }

            },
            error: function(error) {
              console.log(error);

            }
          });

          let result_sura_reps = document.getElementById("result_sura_cups");
          let reps_name = document.getElementById("reps_name");

          document.addEventListener('click', function(event) {
            const targetElement = event.target;
            if (targetElement !== reps_name && !result_sura_reps.contains(targetElement)) {
              reps_name.value = '';
              result_sura_reps.setAttribute("hidden", false);
            }
          });

        }


        function addsura_cups({
          codigo,
          descripcion
        }) {

          let result_sura_reps = document.getElementById("result_sura_cups");
          let reps_name = document.getElementById("reps_name");

          let remision_code = document.getElementById('remision_code');
          let remision_name = document.getElementById('remision_name');
          let remision_motive = document.getElementById('remision_motive');
          let remision_treatment = document.getElementById('remision_treatment');
          let remision_type = document.getElementById('remision_type');

          remision_code.value = codigo;
          remision_name.value = descripcion;

          reps_name.value = '';
          result_sura_reps.setAttribute("hidden", false);


        }

       //notas medicas 
       $("#myTimelineButton").click(function () {
            $("#reset").click();
            $('.transport_fees_title').html("<b>Agregar Nota Médica</b>");
            $('#myTimelineModal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        });
  

//     $(document).ready(function (e) {
//         $("#timelineform").on('submit', (function (e) {
//             $("#timelinebtn").button('loading');
//             var staff_id = <?php echo $doctor_app[0]->doctor; ?>;
//             e.preventDefault();
//             $.ajax({
//                 url: "<?php echo site_url("admin/timeline/add_staff_timeline") ?>",
//                 type: "POST",
//                 data: new FormData(this),
//                 dataType: 'json',
//                 contentType: false,
//                 cache: false,
//                 processData: false,
//                 success: function (data) {
//                     if (data.status == "fail") {
//                         var message = "";
//                         $.each(data.error, function (index, value) {
//                             message += value;
//                         });
//                         errorMsg(message);
//                     } else {
//                         successMsg(data.message);
//                         $.ajax({
//                             url: '<?php echo base_url(); ?>admin/timeline/staff_timeline/' + staff_id,
//                             success: function (res) {
//                                 $('#timeline_list').html(res);
//                                 $('#myTimelineModal').modal('toggle');
//                             },
//                             error: function () {
//                                 alert("Fail")
//                             }
//                         });

//                     }
//                     $("#timelinebtn").button('reset');
//                 },
//                 error: function (e) {
//                     alert("Fail");
//                     console.log(e);
//                 }
//             });
//         }));
//     });

// $('#myTimelineModal').on('hidden.bs.modal', function () {
//     $(this).find('form').trigger('reset');
//     $(".dropify-clear").click(); 
// })


//     function editstaffTimeline(id) {
//         $.ajax({
//             url: '<?php echo base_url(); ?>admin/patient/editstaffTimeline',
//             type: "POST",
//             data: {id: id},
//             dataType: 'json',
//             success: function (data) {
//                 var date_format = '<?php echo $result = strtr($this->customlib->getHospitalDateFormat(), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy']) ?>';
//                 var dt = new Date(data.timeline_date).toString(date_format);
//                 $("#etimelineid").val(id);
//                 $("#estaffid").val(data.staff_id);
//                 $("#etimelinetitle").val(data.title);
//                 $("#etimelinedate").val(dt);
//                 $("#timelineedesc").val(data.description);
//                 if (data.status == '') {
//                 } else
//                 {
//                     $("#evisible_check").attr('checked', true);
//                 }
//                 holdModal('myTimelineEditModal');
//             },
//         });
//     }

//     function delete_timeline(id) {
//         var staff_id = $("#staff_id").val();
//         if (confirm('<?php echo $this->lang->line("delete_confirm"); ?>')) {
//             $.ajax({
//                 url: '<?php echo base_url(); ?>admin/timeline/delete_staff_timeline/' + id,
//                 success: function (res) {
//                     $.ajax({
//                         url: '<?php echo base_url(); ?>admin/timeline/staff_timeline/' + staff_id,
//                         success: function (res) {
//                             $('#timeline_list').html(res);
//                             successMsg('<?php echo $this->lang->line('delete_message') ?>');
//                         },
//                         error: function () {
//                             alert("Fail")
//                         }
//                     });
//                 },
//                 error: function () {
//                     alert("Fail")
//                 }
//             });
//         }
//     }
        
        
      </script>





      <!-- //========datatable end===== -->