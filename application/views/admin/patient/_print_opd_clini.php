
<link href="https://fonts.cdnfonts.com/css/nasalization-2" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sh-print.css">

<style>
  
  body {margin:20px;
    padding:0
  }
  .header {
      position: relative;
      top: -2;
   }
  
  .header_clini{
     display: flex;
     z-index:3;
     font-weight: normal !important;
     font-family: 'Nasalization', sans-serif !important;
     text-transform: capitalize !important;
     align-items: center;
     color: #40AABF !important;
     justify-content: center;
     margin-bottom:10px;
     padding:10px;
     border-radius:10px;
     font-size:20px;
/*      height: 20px; */
/*      background-color: rgba(255, 255, 255, 0.5); */
/*      background-image: url(<?php// echo base_url('uploads/own_cliniverso/imgs/barracolor.png') ?>); */
     background-size:cover;
/*      height:auto; */
    
  }
  
  .items_text{
    font-family: 'Nasalization', sans-serif !important;
    font-weight: normal !important;
    text-transform: capitalize !important;
    color: #28a9bf !important;
  }
  
  .header_clini h3{
    margin:0;
  }
  
  .pprinta4{
    position: relative;
    z-index:1 !important;
  }
  
  .print-area2 {
      position: relative;
      background-image: url(<?php echo base_url('uploads/own_cliniverso/imgs/histo_fondo.webp') ?>); /* Reemplaza con la ruta de tu imagen */
      background-repeat: no-repeat;
/*       background-size:  contain; */
      z-index:0;
/*       height: 1040px; */
    }
  
  .header_name{
        display: inline;
        color: #28a9bf !important;
        background-color:#fff;
        text-decoration:underline;
        margin:0px;
  }
  
  .print-area1 {
      position: relative;
      background-image: url(<?php echo base_url('uploads/own_cliniverso/imgs/histo_fondo.png') ?>); /* Reemplaza con la ruta de tu imagen */
      background-repeat: no-repeat;
      background-size:  contain;
      z-index:0;
/*       height: 1040px; */
    }

</style>
<?php $currency_symbol = $this->customlib->getHospitalCurrencyFormat(); ?>

<?php
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
    } } ?>
  
<div class="print-area" >
    <div class="row">
        <p class="header" style=" display: inline;margin-left:10px;">
            <i> Paciente: <?php echo $result['patient_name'];?> <?php echo $result['guardian_name'];?></i>
        </p>
        <div class="col-md-12 print-area1" >
            <?php if (!empty($print_details[0]['print_header'])) { ?>
                <div class="" style="margin-bottom:10px;">
                    <img src="<?php if (!empty($print_details[0]['print_header'])) {  echo base_url() . $print_details[0]['print_header'].img_time(); } ?>" class="img-responsive border-radius:10px;" style=" margin-top:10px; height:100px; width: 100%;">
                </div>
            <?php } ?>      
            <div class="col-md-12" style="width: -webkit-fill-available;display:flex; margin:0px 0px 5px 0px; gap:9px;">
                <div class="col-lg-5 col-md-5 col-sm-5 mt-4 mb-1" style="padding:10px;border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                    <p>
                        <strong class="items_text">Número de evento</strong>:
                        <?php echo $opd_prefix.$result["opd_details_id"];?>
                    </p>
                    <p>
                        <strong class="items_text"><?php echo $this->lang->line("appointment_date") ; ?> </strong>:
                        <?php echo $result["mydate"]; ?>
                    </p>
                    <p>
                        <strong class="items_text"><?php echo $this->lang->line('consultant_doctor'); ?> </strong>:
                        <?php echo $result["name"] . " " . $result["surname"].' ('. $result["employee_id"] .')' ?>
                    </p>
                    <p class="">
                        <div>
                            <strong class="items_text">Especialidad </strong>:
                        </div>
                        <?php echo $result["reason_consultation"]; ?>
                    </p>
                    <div class="col-12 m-2">
                        <p style=" display: inline;">
                            <strong class="items_text">EPS:</strong>
                        </p>
                        <?php foreach($fields_patient as $key=>$value): ?>
                        <?php if($value->custom_field_id == 12){ ?>
                            <p style=" display: inline;">
                            <?php echo $value->field_value ?>
                            </p>
                        <?php  } ?>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7  mt-4 mb-1" style="padding:10px; border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                    <div class="col-12 m-2">
                        <p style=" display: inline;">
                            <strong class="items_text"><?php echo $this->lang->line('patient_name'); ?>:</strong>
                        </p>
                        <p style=" display: inline;">
                            <?php echo $result['patient_name'];?>
                            <?php echo $result['guardian_name'];?>
                        </p>
                    </div>
                    <div class="col-md-12 m-2">
                        <p style=" display: inline;">
                            <strong class="items_text"><?php echo $this->lang->line("identification_number"); ?>:</strong>
                        </p>
                        <p style=" display: inline; font-size:;10px">
                            <?php echo $result["identification_number"] ?>
                        </p>
                    </div>
                    <div class="col-md-12 m-2">
                        <div class="col-md-6 m-2">
                            <p style=" display: inline;">
                                <strong class="items_text"><?php echo $this->lang->line("gender"); ?></strong>
                            </p>
                            <p style=" display: inline;">
                                <?php echo $result["gender"] ?>
                            </p>
                        </div>
                        <div class="col-md-6 m-2">
                            <p style=" display: inline;"><strong class="items_text"><?php echo $this->lang->line('marital_status'); ?></strong></p>
                            <p style=" display: inline;">
                            <?php echo $result['marital_status'] ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 m-2">
                        <p style=" display: inline;">
                            <strong class="items_text"><?php echo $this->lang->line("birth_date"); ?>:</strong>
                        </p>
                        <p style=" display: inline;">
                            <?php echo $result["dob"]; ?>
                        </p>
                    </div>
                    <div class="col-12 m-2">
                        <p style=" display: inline;">
                            <strong class="items_text"><?php echo $this->lang->line("age"); ?>:</strong>
                        </p>
                        <p style=" display: inline;">
                            <?php echo $this->customlib->getPatientAge($result['age'],$result['month'],$result['day']); ?>
                        </p>
                    </div>
                    <div class="col-12 m-2">
                        <p style=" display: inline;">
                            <strong class="items_text"><?php echo $this->lang->line("email"); ?>:</strong>
                        </p>
                        <p style=" display: inline;">
                            <?php echo $result['email']; ?>
                        </p>
                    </div>
                    <div class="col-12 m-2">
                        <p style=" display: inline;">
                            <strong class="items_text"><?php echo $this->lang->line("address"); ?>:</strong>
                        </p>
                        <p style=" display: inline;">
                            <?php foreach($fields_patient as $key=>$value): ?>
                            <?php if($value->custom_field_id == 25){ ?>
                        <p style=" display: inline;">
                            <?php echo $value->field_value ?>
                        </p>
                            <?php  } ?>
                            <?php endforeach ?>
                        </p>
                    </div>
                    <div class="col-12 m-2">
                        <p style=" display: inline;">
                            <strong class="items_text">Acudiente:</strong>
                        </p>
                        <p style=" display: inline;">
                            <?php foreach($fields_patient as $key=>$value): ?>
                            <?php if($value->custom_field_id == 7){ ?>
                        <p style=" display: inline;">
                            <?php echo $value->field_value ?>
                        </p>
                            <?php  } ?>
                            <?php endforeach ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 " style="width: -webkit-fill-available;padding:10px;border-radius:15px; border: 1px solid #9b9898;margin:8px 0px 0px 8px;">
                <div class="row">
                    <!-------------------MOTIVO DE CONSULTA----------------------------- -->
                    <?php if (isset($fields) && !empty($fields)) : ?>
                        <?php foreach($fields as $key=>$value): ?>
                            <?php if($value->custom_field_id == 32){ ?>
                                <p>
                                    <strong class="items_text">Motivo de Consulta: </strong><?php echo $value->field_value ?>
                                </p>
                            <?php  } ?>
                            <?php endforeach ?>
                        <?php else : ?>
                        <p class="text-center">No hay datos disponibles.</p>
                     <?php endif ?><!---END---MOTIVO DE CONSULTA -->
                    <!-------------------ENFERMEDAD ACTUAL----------------------------- -->  
                    <?php if (isset($fields) && !empty($fields)) : ?>
                        <?php foreach($fields as $key=>$value): ?>
                            <?php if($value->custom_field_id == 58){ ?>
                                <p style="display: inline;"><strong class="items_text">Enfermedad actual:</strong> <?php echo $value->field_value ?> </p>
                                <?php  } ?>
                            <?php endforeach ?>
                        <?php else : ?>
                        <p class="text-center">No hay datos disponibles.</p>
                    <?php endif ?><!--END-ENFERMEDAD ACTUAL -->
                    <!-------------------REVISIÓN POR SISTEMA----------------------------- -->
                    <?php foreach ($fields as $key =>$s): ?>
                        <?php if($s->custom_field_id == 43){?>
                            <p><strong class="items_text"> Revisión Por sistemas: </strong><?php echo $s->field_value; ?></p>
                        <?php } ?>
                    <?php endforeach ?><!----END-REVISIÓN POR SISTEMA-->
                    <!-------------------ANALISIS----------------------------- -->
                    <?php if (isset($fields) && !empty($fields)) : ?>
                            <?php foreach ($fields as $key =>$s): ?>
                                <?php if( $s->custom_field_id == 64){?>
                                    <p class=""><strong class="items_text"> 
                                        <?php space($s->custom_field_id); ?></strong>: <?php echo $s->field_value; ?>.
                                    </p>
                                <?php } ?>
                            <?php endforeach ?>
                         <?php else : ?>
                            <p class="text-center">No hay datos disponibles.</p>
                    <?php endif ?><!----END-ANALISIS-->
                </div>
            </div>
            <!-------------------antecedentes----------------------------- -->        
            <div class="col-lg-12 col-md-12 col-sm-12" style="width: -webkit-fill-available; padding: 10px; border-radius: 15px; border: 1px solid #9b9898; margin: 8px 0px 0px 8px;">
                <div class="row">
                    <div class="col-12">
                        <?php if (!empty($fields)) : ?>
                            <div class="header_clini col-md-12 img-responsive">
                                <p class="text-center">Antecedentes</p>
                            </div>
                                <p>
                                <?php foreach ($fields as $key => $s) : ?>
                                    <?php if (
                                        in_array($s->custom_field_id, [77, 76, 75, 78, 79, 80, 81, 93, 92, 95])
                                    ) : ?>
                                        <strong class="items_text"><?php space($s->custom_field_id); ?></strong>: <?php echo $s->field_value; ?>.
                                    <?php endif ?>
                                <?php endforeach ?>
                              </p>
                              <?php else : ?>
                        <?php endif ?>

                        <?php if (empty($fields)) : ?>
                            <p class="text-center">No hay datos disponibles.</p>
                        <?php endif ?>
                    </div>
                </div>
            </div><!--END-antecedentes-->

            <!-------------------EXAMEN FISICO----------------------------- --> 
            <div class="col-md-12" style="width: -webkit-fill-available; padding: 10px; border-radius: 15px; border: 1px solid #9b9898; margin: 8px 0px 0px 8px; margin-bottom: 10px;">
                <div class="row d-flex" style="justify-content: space-between">
                    <div class="col-md-12">
                        <p class="text-center items_text" style="font-size: 20px; margin-bottom: 10px;">Examen Físico</p>
                        <p style="text-align: justify;">
                            <?php foreach ($fields as $s): ?>
                                <?php $allowed_custom_field_ids = [19, 38, 37, 18, 49, 36, 83, 84, 85, 86, 39, 44, 52, 90, 91, 96, 54, 47, 45, 87, 88, 89];
                                if (in_array($s->custom_field_id, $allowed_custom_field_ids)) : ?>
                                    <strong class="items_text"><?php space($s->custom_field_id); ?>: </strong>
                                    <?php echo $s->field_value; ?><?php if ($s->custom_field_id == 36) {
                                        echo ("Kg");
                                    } elseif ($s->custom_field_id == 49) {
                                        echo ("°C");
                                    } elseif ($s->custom_field_id == 19) {
                                        echo ("Cm");
                                    } elseif ($s->custom_field_id == 38) {
                                        echo ("LPM");
                                    }
                                    ?>.
                                <?php endif ?>
                            <?php endforeach ?>
                        </p>
                    </div>
                </div>
            </div><!--END--EXAMEN FISICO -->
           <!-- -------------------------DIANOSTICOS------------------ -->
                <?php if (isset($diagnosis) && !empty($diagnosis)) : ?>
                    <div class="col-md-12" style="width: -webkit-fill-available; padding: 10px; border-radius: 15px; border: 1px solid #9b9898; margin: 8px 0px 0px 8px; margin-bottom: 10px;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="text-center items_text" style="font-size:20px;">Diagnósticos</p>
                            <div class="col-md-12 text-center">
                                <strong class="items_text" style="color: #0000; font-size:20px;">Primario</strong>
                            </div>
                            <?php foreach ($diagnosis as $s) : ?>
                                <?php if ($s->categoria_diag == "primario") : ?>
                                    <p style="word-break: break-word;">
                                        <strong class="items_text">Tipo Diagnóstico</strong>
                                        <?php echo str_replace("_", " ", $s->tipo_diag); ?>.
                                        <strong class="items_text">Nombre Diagnóstico</strong>
                                        <?php echo str_replace("_", " ", $s->nombre_diag); ?>
                                    </p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-12 text-center mt-3" style="margin-top:30px;">
                            <strong style="color:; font-size:20px;">Secundarios</strong>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <ul>
                                <?php foreach ($diagnosis as $s) : ?>
                                    <?php if ($s->categoria_diag == "secundario") : ?>
                                        <li class="">
                                            <strong>Tipo Diagnóstico</strong><br>
                                            <p style="word-break: break-word;">
                                                <?php echo str_replace("_", " ", $s->tipo_diag); ?>
                                            </p>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <ul>
                                <?php foreach ($diagnosis as $s) : ?>
                                    <?php if ($s->categoria_diag == "secundario") : ?>
                                        <li class="">
                                            <strong>Nombre Diagnóstico</strong><br>
                                            <p style="word-break: break-word;">
                                                <?php echo str_replace("_", " ", $s->nombre_diag); ?>
                                            </p>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php else : ?>
                    <p class="text-center items_text " style="font-size:20px; margin-top:10px;"><strong>No hay Diagnósticos</strong></p>

                <?php endif; ?><!--END-DIAGNOSTICOS-->
        </div>
        <div class="col-md-12 print-area1" >
            <!-- -------------------------MEDICAMENTOS------------------ -->
            <?php if (isset($medications) && !empty($medications)) : ?>
                <div class="col-md-12" style="width: -webkit-fill-available; padding: 10px; border-radius: 15px; border: 1px solid #9b9898; margin: 8px 0px 0px 8px; margin-bottom: 10px;margin">
                    <div class="col-md-12">
                        <div class="header_clini col-md-12 mb-2 img-responsive">
                            <p>Medicamentos</p>
                        </div>
                        <?php foreach ($medications as $value) : ?>
                            <div class="col-md-12 m-2" style="height: 150px;">
                                <p class="items_text" style="display: inline;">Principio activo: <?= $value->footer_note ?></p>
                                <p class="items_text" style="display: inline;">Concentración: <?= $value->finding_description ?></p>
                                <p class="items_text" style="display: inline;">Dosis: <?= $value->dosage ?> </p>
                                <p class="items_text" style="display: inline;">Periodicidad: <?= $value->dose_interval_id ?></p>
                                <p class="items_text" style="display: inline;">Durante: <?= $value->dose_duration_id ?></p>
                                <p class="items_text" style="display: inline;">Indicaciones <?= $value->instruction ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div><!--END-MEDICAMENTOS-->
                    <?php else : ?>
                        <p class="text-center items_text" style="font-size:20px; margin-top:10px;"><strong> no hay Medicamentos</strong></p>
            <?php endif; ?>
            <!-- ---------------------INCAPCIDADES--------------------- -->
                <?php if (isset($inabilities) && !empty($inabilities)) : ?>
                    <div class="col-md-12" style="width: -webkit-fill-available; padding: 10px; border-radius: 15px; border: 1px solid #9b9898; margin: 8px 0px 0px 8px; margin-bottom: 10px;margin">
                        <div class="header_clini col-md-12 mb-2 img-responsive">
                            <p>Incapacidades</p>
                        </div>
                        <?php else : ?>
                    <?php endif ?>
                    <div class="col-md-12 m-2" style="">
                        <?php if (isset($inabilities) && !empty($inabilities)) : ?>
                            <?php foreach($inabilities as $inability): ?>
                                <div class="col-md-6 m-2">
                                    <div class="col-6 m-2">
                                        <p>
                                            <strong  class="items_text">Nº de Incapacidad: </strong>
                                            <?php echo $inability->id_inability; ?>
                                        </p>
                                        <p>
                                            <strong  class="items_text">Fecha Inicial: </strong>
                                            <?php echo $inability->inability_initial_date; ?>
                                        </p>
                                        <p>
                                            <strong  class="items_text">Duración: </strong>
                                            <?php echo $inability->inability_duration; ?>
                                        </p>
                                        <p>
                                            <strong  class="items_text">Tipo de Incapacidad: </strong>
                                            <?php echo $inability->inability_type_disability; ?>
                                        </p>
                                        <p>
                                            <strong  class="items_text">Nº de Incapacidad: </strong>
                                            <?php echo $inability->id_inability; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 m-2">
                                    <div class="col-6 m-2">
                                        <p>
                                            <strong  class="items_text">Clasificacion: </strong>
                                            <?php echo $inability->inability_classification; ?>
                                        </p>
                                        <p>
                                            <strong  class="items_text">fecha final: </strong>
                                            <?php echo $inability->inability_final_date; ?>
                                        </p>
                                        <p>
                                            <strong  class="items_text">Diagnóstico: </strong>
                                            <?php echo $inability->inability_diagnosis; ?>
                                        </p>
                                        <p>
                                            <strong  class="items_text">Observaciones: </strong>
                                            <?php echo $inability->inability_observation; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php else : ?>
                    <p class="text-center items_text" style="font-size:20px; margin-top:10px;"><strong>No hay datos de incapacidades</strong></p>
                <?php endif ?>
            <!-- ---------------------INf. REMICION--------------------- -->
                <?php if (isset($remisions) && !empty($remisions)) : ?>
                    <div class="col-md-12" style="width: -webkit-fill-available; padding: 10px; border-radius: 15px; border: 1px solid #9b9898; margin: 8px 0px 0px 8px; margin-bottom: 10px;margin">
                        <div class="header_clini col-md-12 mb-2 img-responsive">
                            <p>Información remisiones</p>
                        </div>
                        <div class="col-md-12 m-2" style="">
                            <?php foreach($remisions as $value): ?>
                                <div class="col-md-6 m-2">
                                    <div class="col-6 m-2">
                                        <p>
                                            <strong  class="items_text">Fecha: </strong>
                                            <?= $value->create_at ?>
                                        </p>
                                        <p>
                                            <strong  class="items_text">Código procedimiento: </strong>
                                            <?= $value->remision_code ?>
                                        </p>
                                        <p>
                                            <strong  class="items_text">Responsable: </strong>
                                            <?= $value->referred_to ?>
                                        </p>
                                    </div>
                                 </div>
                                 <div class="col-md-6 m-2">
                                    <div class="col-6 m-2">
                                         <p>
                                            <strong  class="items_text">Motivo de remisión: </strong>
                                            <?= $value->remision_motive ?>
                                        </p>
                                         <p>
                                            <strong  class="items_text">Procedimiento: </strong>
                                            <?= $value->remision_name?>
                                        </p>
                                    </div>
                                  </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <p class="text-center items_text" style="font-size:20px; margin-top:10px;"><strong>No hay Remisiones</strong></p>
                    <?php endif ?>
                <!--END--INf. REMICION-->
            <!-- ---------------Información Paraclínicos------------------- -->
                <?php if (!empty($paraclini_clini)) : ?>
                    <div class="col-md-12 m-2 mb-4" style="width: -webkit-fill-available; padding: 10px; border-radius: 15px; border: 1px solid #9b9898; margin: 8px 0px 0px 8px; margin-bottom: 10px;margin">
                        <div class="header_clini col-md-12 mb-2 img-responsive">
                            <p>Información Paraclínicos</p>
                        </div>
                        <?php else : ?>
                    <?php endif ?>
                    <?php if (isset($paraclini_clini) && !empty($paraclini_clini)) : ?>
                        <?php foreach($paraclini_clini as $value): ?>
                            <div class="col-md-6 m-2">
                                <p>
                                    <strong  class="items_text">Procedimiento: </strong>
                                    <?= $value->product_para ?>
                                </p>
                            </div>
                            <div class="col-md-6 m-2">
                                <p>
                                    <strong  class="items_text">Código procedimiento: </strong>
                                    <?= $value->codigo_para ?>
                                </p>
                                <br>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <?php else : ?>
                        <p class="text-center items_text" style="font-size:20px; margin-top:10px; margin-bottom:150px;"><strong>No hay Información Paraclínicos</strong></p>
            <?php endif ?>
        </div>
        <div class="col-md-12" style="position:relative; align-items:baseline;">
        <hr>
            <div class="col-md-6" style="">
                <p>
                    <strong  class="items_text">Firmado por</strong>:
                    <?php echo $result["name"] . " " . $result["surname"].' ('. $result["employee_id"] .')' ?>
                </p>
                <p>
                    <strong  class="items_text">Cédula</strong>:
                    <?php echo  $result["employee_id"]; ?>
                </p>
                <p>
                    <strong  class="items_text">Reg Médico</strong>:
                    <?php echo  $result["employee_id"]; ?>
                </p>
                <p>
                    <strong class="items_text">Especialidad</strong>:
                    <?php echo  $result["specialist_name"]; ?>
                </p>
              </div>
              <div class="col-md-6" >
                  <div>
                      <img src="<?php echo base_url() . 'uploads/hospital_content/logo/1.png'; ?>" class="img-responsive border-radius:10px;" style="height:100px; width: 100%;">
                  </div>
              </div>
            <hr>
        </div>
        <!-- --------------------------------- -->
    </div>
</div>
   





