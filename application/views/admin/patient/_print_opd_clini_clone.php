
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
     color: #28a9bf !important;
     justify-content: center;
     margin-bottom:10px;
     padding:10px;
     border-radius:10px;
     font-size:20px;
/*      background-color: rgba(255, 255, 255, 0.5); */
     background-image: url(<?php echo base_url('uploads/own_cliniverso/imgs/barracolor.png') ?>);
     background-size:auto;
     height:auto;
    
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
      background-size:  contain;
      z-index:0;
      height: 1040px;
    }
  
  .header_name{
        display: inline;
        color: #28a9bf !important;
        background-color:#fff;
  }
  
  .print-area1 {
      position: relative;
      background-image: url(<?php echo base_url('uploads/own_cliniverso/imgs/histo_fondo.png') ?>); /* Reemplaza con la ruta de tu imagen */
      background-repeat: no-repeat;
      background-size:  contain;
      z-index:0;
      height: 1040px;
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
                echo "Análisis";
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
    } } ?>
  
  <div class="print-area" >
  <div class="row">
        <p class="header" style=" display: inline;margin-left:10px;">
          <i> Paciente: <?php echo $result['patient_name'];?> <?php echo $result['guardian_name'];?></i>
        </p>
    <div class="col-md-12 print-area2" >
      <?php if (!empty($print_details[0]['print_header'])) { ?>
      <div class="" style="margin-bottom:10px;">
        <img src="<?php if (!empty($print_details[0]['print_header'])) {  echo base_url() . $print_details[0]['print_header'].img_time(); } ?>" class="img-responsive border-radius:10px;" style=" margin-top:10px; height:100px; width: 100%;">
      </div>
      <?php } ?>
      <div class="card mt-3">
        <div class="card-body">
          <div class="col-md-12">
            <div class="col-md-12" style="width: -webkit-fill-available;display:flex; margin:0px 0px 5px 0px; gap:9px;">
              <div class="col-lg-6 col-md-6 col-sm-6  mt-4 mb-4" style="padding:10px;border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                <p>
                  <strong class="items_text"><?php echo $this->lang->line("opd_id"); ?></strong>:
                  <?php echo $opd_prefix.$result["opd_details_id"];?>
                </p>
<!--                 <p>
                  <strong class="items_text"><?php echo $this->lang->line("checkup_id") ; ?></strong> :
                  <?php echo $checkup_prefix.$result["id"] ?>
                </p> -->
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
                    <strong class="items_text">Motivo de Consulta </strong>:
                  </div>
                  <?php echo $result["reason_consultation"]; ?>
                </p>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6  mt-4 mb-4" style="padding:10px; border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                <div class="col-12 m-2">
                  <p style=" display: inline;">
                    <strong class="items_text"><?php echo $this->lang->line('patient_name'); ?>:</strong>
                  </p>
                  <p style=" display: inline;">
                    <?php echo $result['patient_name'];?>
                    <?php echo $result['guardian_name'];?>
                  </p>
                </div>
                <div class="col-12 m-2">
                  <p style=" display: inline;">
                    <strong class="items_text"><?php echo $this->lang->line("identification_number"); ?>:</strong>
                  </p>

                  <p style=" display: inline; font-size:;10px">
                    <?php echo $result["identification_number"] ?>
                  </p>
                </div>
                <div class="col-6 m-2">
                  <p style=" display: inline;">
                    <strong class="items_text"><?php echo $this->lang->line("gender"); ?></strong>
                  </p>
                  <p style=" display: inline;">
                    <?php echo $result["gender"] ?>
                  </p>
                </div>
                <div class="col-6 m-2">
                  <p style=" display: inline;"><strong class="items_text"><?php echo $this->lang->line('marital_status'); ?></strong></p>
                  <p style=" display: inline;">
                    <?php echo $result['marital_status'] ?>
                  </p>
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
                    <strong><?php echo $this->lang->line("address"); ?>:</strong>
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
            </div>
          </div>
          <div class="col-md-12" style="width: -webkit-fill-available; margin-bottom:5px;padding:10px;height:110px">
            <div class="header_clini col-md-12 mb-2 img-responsive" style="">
              <p class="text-center"> Motivo de Consulta</p>
            </div>

            <div class="col-md-12">
              <table class="col-md-12 table table-responsive-md invoice-items">
                <tbody>
                  <?php if (isset($fields) && !empty($fields)) : ?>
                  <?php foreach($fields as $key=>$value): ?>
                  <?php if($value->custom_field_id == 32){ ?>
                  <td>
                    <ul>
                      <li>
                        <h4>
                          <?php echo $value->field_value ?>
                        </h4>
                      </li>
                      <ul>
                  </td>
                  <?php  } ?>
                  <?php endforeach ?>
                  <?php else : ?>
                  <p class="text-center">No hay datos disponibles.</p>
                  <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-12" style="width: -webkit-fill-available;margin-bottom:10px;padding:10px;height:120px">

            <div class="header_clini col-md-12 mb-2 img-responsive">
              <div class="row">
                <p class="text-center"> Enfermedad actual</p>
              </div>
            </div>
            <?php if (isset($fields) && !empty($fields)) : ?>
            <?php foreach($fields as $key=>$value): ?>
            <?php if($value->custom_field_id == 58){ ?>
            <div class="col-md-12" >
              <ul>
                <li>
                  <h4>
                   <p style="display: inline;">  <?php echo $value->field_value ?> </p>
                  </h4>
                </li>
              <ul>
            </div>
            <?php  } ?>
            <?php endforeach ?>
            <?php else : ?>
            <p class="text-center">No hay datos disponibles.</p>
            <?php endif ?>
          </div>
          <div class="col-md-12" style="width: -webkit-fill-available;margin-bottom:10px;padding:10px;height:360px;">

            <div class="header_clini col-md-12 mb-2 img-responsive">
              <p class="text-center">Antecedentes</p>
            </div>
            <div class="row" >
              <!--./col-lg-5-->
              <div class="col-lg-6 col-md-6 col-sm-6">
                <?php if (isset($fields) && !empty($fields)) : ?>
                <?php foreach ($fields as $key =>$s): ?>
                <ul>
                  <?php if($s->custom_field_id == 77 || $s->custom_field_id == 76 || $s->custom_field_id == 75 || $s->custom_field_id == 78){?>
                  <li>
                    <p> <strong class="items_text"><?php space($s->custom_field_id); ?></strong>:<br>
                      <?php echo $s->field_value; ?>
                    </p>
                  </li>
                  <?php } ?>
                </ul>
                <?php endforeach ?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <?php foreach ($fields as $key =>$s): ?>
                <ul>
                  <?php if($s->custom_field_id == 79  || $s->custom_field_id == 80 || $s->custom_field_id == 81){?>
                  <li>
                    <p><strong class="items_text"> <?php space($s->custom_field_id); ?>:</strong><br>
                      <?php echo $s->field_value; ?>
                    </p>
                  </li>
                  <?php } ?>
                </ul>
                <?php endforeach ?>
                <?php else : ?>
                <p class="text-center">No hay datos disponibles.</p>
                <?php endif ?>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>

    <div class="col-md-12 print-area1" >
          <p class="col-md-12 header_name" style="">
             <i> Paciente: <?php echo $result['patient_name'];?> <?php echo $result['guardian_name'];?></i>
           </p>
          <div class="col-md-12" style="width: -webkit-fill-available; margin-bottom:10px;padding:10px;height:520px">
            <div class="header_clini col-md-12 mb-2 img-responsive">
              <p class="text-center"> Examen Físico</p>
            </div>
            <div class="row d-flex" style="justify-content:space-between">
              <div class="col-md-6">
                <?php foreach ($fields as $key =>$s): ?>
                <ul>
                  <?php if($s->custom_field_id == 19 || $s->custom_field_id == 38 || $s->custom_field_id == 37 || $s->custom_field_id == 18 || $s->custom_field_id == 49 || $s->custom_field_id == 36 || $s->custom_field_id == 83 || $s->custom_field_id == 84 || $s->custom_field_id == 85 || $s->custom_field_id == 86 ){?>
                  <li>
                    <p>
                      <b class="items_text"><?php space($s->custom_field_id); ?></b> -
                      <?php echo $s->field_value; ?>
                      <?php if($s->custom_field_id == 36){echo ("Kg");}elseif($s->custom_field_id == 49){echo ("°C");}elseif($s->custom_field_id == 19){echo ("Cm");}elseif($s->custom_field_id == 38){echo ("LPM");} ?>
                    </p>
                  </li>
                  <?php } ?>
                </ul>
                <?php endforeach ?>
              </div>
              <div class="col-md-6">
                <?php foreach ($fields as $key =>$s): ?>
                <ul>
                  <?php if($s->custom_field_id == 39 || $s->custom_field_id == 44 || $s->custom_field_id == 52 || $s->custom_field_id == 54 || $s->custom_field_id == 47 || $s->custom_field_id == 45 || $s->custom_field_id == 87 || $s->custom_field_id == 88 || $s->custom_field_id == 89){?>
                  <li>
                    <p>
                      <b class="items_text"> <?php space($s->custom_field_id); ?></b> -
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
          <div class="col-md-12" style="width: -webkit-fill-available; margin-bottom:10px;padding:10px;height:410px">

            <div class="header_clini col-md-12 mb-2 img-responsive">
              <p>Análisis y plan</p>
            </div>

            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12" >
                <?php if (isset($fields) && !empty($fields)) : ?>
                <?php foreach ($fields as $key =>$s): ?>
                <ul>
                  <?php if( $s->custom_field_id == 64){?>
                  <li class=""><strong class="items_text"> <?php space($s->custom_field_id); ?></strong><br>
                    <?php echo $s->field_value; ?>
                  </li>

                  <?php } ?>
                  <?php if( $s->custom_field_id == 65){?>
                  <li class=""><strong> <?php space($s->custom_field_id); ?></strong><br>
                    <?php echo $s->field_value; ?>
                  </li>

                  <?php } ?>
                </ul>
                <?php endforeach ?>
                <?php else : ?>
                <p class="text-center">No hay datos disponibles.</p>
                <?php endif ?>
              </div>
            </div>
          </div>
         
    </div>
    <div class="col-md-12 print-area1" >
      <p class="col-md-12 header_name" style="">
         <i> Paciente: <?php echo $result['patient_name'];?> <?php echo $result['guardian_name'];?></i>
       </p>
       <div class="col-md-12" style="width: -webkit-fill-available;margin-bottom:10px;padding:10px; height:260px;">
            <div class="header_clini col-md-12 mb-2 mt-3 img-responsive">
              <p>Diagnósticos</p>
            </div>
            <div class="col-md-12">
              <!--./col-lg-5-->
              <div class="col-md-12 text-center">
                <strong class="items_text" style="color:#0000; font-size:20px;">Primario</strong>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <?php if (isset($diagnosis) && !empty($diagnosis)) : ?>
                <?php foreach ($diagnosis as $key =>$s): ?>
                <ul>
                  <?php if($s->categoria_diag =="primario"):?>
                  <li class="">
                    <strong class="items_text">Tipo Diagnóstico</strong><br>
                    <p  style="word-break: break-word;">
                      <?php echo str_replace("_"," ",$s->tipo_diag); ?>
                    </p>
                  </li>
                  <?php endif ?>
                </ul>
                <?php endforeach ?>
                <?php else : ?>
                <p class="text-center">No hay datos disponibles.</p>
                <?php endif ?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <?php if (isset($diagnosis) && !empty($diagnosis)) : ?>
                <?php foreach ($diagnosis as $key =>$s): ?>
                <ul>
                  <?php if($s->categoria_diag =="primario"):?>
                  <li class="">
                    <strong class="items_text">Nombre Diagnóstico</strong><br>
                    <p style="word-break: break-word;">
                      <?php echo str_replace("_"," ",$s->nombre_diag); ?>
                    </p>
                  </li>
                  <?php endif ?>
                </ul>
                <?php endforeach ?>
                <?php else : ?>
                <p class="text-center">No hay datos disponibles.</p>
                <?php endif ?>
              </div>
            </div>
            <div class="col-md-12">

              <?php if($s->categoria_diag =="secundario"):?>

              <div class="col-md-12 text-center mt-3" style="margin-top:30px;">
                <strong style="color:; font-size:20px;">Secundarios</strong>
              </div>
              <?php endif ?>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <?php if (isset($diagnosis) && !empty($diagnosis)) : ?>
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
                <?php else : ?>
                <?php endif ?>
              </div>
            </div>
          </div>
        
      <div class="col-12 mt-3 mt-4 mb-4" style=" margin:10px 0px 10px 0px;padding:10px;">
            <div class="col-md-12">
              <?php if (isset($medications) && !empty($medications)) : ?>
              <?php foreach($medications as $value): ?>
              <div class="col-md-12 m-2">
                <div class="header_clini col-md-12 mb-2 mt-3 img-responsive">
                  <p>Medicamentos</p>
                </div>
              </div>
              <div class="col-md-12 m-2" style="height:210px;">
                <div class="col-md-6 m-2">
                  <ul>
                    <p  class="items_text"style=" display: inline;"><strong>Principio activo: </strong></p>
                    <p style=" display: inline;">
                    <?= $value->footer_note ?>
                    </p><br>

                    <p  class="items_text"style=" display: inline;"><strong>Concentración: </strong></p>
                    <p style=" display: inline;">
                    <?= $value->finding_description  ?>
                    </p><br>

                    <p  class="items_text"style=" display: inline;"><strong>Dosis</strong></p>
                    <p style=" display: inline;">
                    <?= $value->dosage ?>
                    </p>
                   </ul>
                </div>
                <div class="col-md-6 m-2">
                  <ul>
                    <p  class="items_text"style=" display: inline;"><strong>Periodicidad: </strong></p>
                    <p style=" display: inline;">
                      <?= $value->dose_interval_id ?>
                    </p><br>

                    <p  class="items_text"style=" display: inline;"><strong>Durante:</strong></p>
                    <p style=" display: inline;">
                      <?= $value->dose_duration_id ?>
                    </p><br>
                    <p  class="items_text"style=" display: inline;"><strong>Indicaciones</strong></p>
                    <p style=" display: inline;">
                      <?= $value->instruction ?>
                    </p>
                  </ul>
                </div>
              </div>
              <?php endforeach ?>
              <?php else : ?>
              <p class="text-center">No hay datos disponibles.</p>
              <?php endif ?>
            </div>
          </div>
         <!-- ---------------------------------------------------- -->
      <div class="col-12 mt-3 mt-4 mb-4 " style=" margin:10px 0px 10px 0px;padding:10px;">
      <div class="header_clini col-md-12 mb-2 img-responsive">
        <p>Incapacidades</p>
      </div>
      <div class="col-md-12 m-2" style="height:200px;">
        <?php if (isset($inabilities) && !empty($inabilities)) : ?>
        <?php foreach($inabilities as $inability): ?>
        <div class="col-md-6 m-2">
          <ul>
            <div class="col-6 m-2">
              <p class="items_text" style=" display: inline;">Nº de Incapacidad: </p>
              <p style=" display: inline;">
                <?php echo $inability->id_inability; ?>
              </p>
            </div>
            <div class="col-6 m-2">
              <p class="items_text" style=" display: inline;">Fecha Inicial: </p>
              <p style=" display: inline;">
                <?php echo $inability->inability_initial_date; ?>
              </p>
            </div>
            <div class="col-6 m-2">
              <p class="items_text" style=" display: inline;">Duración:: </p>
              <p style=" display: inline;">
                <?php echo $inability->inability_duration; ?>
              </p>
            </div>
            <div class="col-6 m-2">
              <p class="items_text" style=" display: inline;">Tipo de Incapacidad: </p>
              <p style=" display: inline;">
                <?php echo $inability->inability_type_disability; ?>
              </p>
            </div>
          </ul>
        </div> 
        <div class="col-md-6 m-2">
          <ul>
          <div class="col-6 m-2">
            <p class="items_text" style=" display: inline;">Clasificacion: </p>
            <p style=" display: inline;">
              <?php echo $inability->inability_classification; ?>
            </p>
          </div>
          <div class="col-6 m-2">
            <p class="items_text" style=" display: inline;">Durante: </p>
            <p style=" display: inline;">
              <?= $inability->dose_duration_id ?>
            </p>
          </div>
          <div class="col-6 m-2">
            <p class="items_text" style=" display: inline;">Diagnóstico: </p>
            <p style=" display: inline;">
              <?php echo $inability->inability_diagnosis; ?>
            </p>
          </div>
          <div class="col-6 m-2">
            <p class="items_text" style=" display: inline;">Observaciones: </p>
            <p style=" display: inline;">
              <?php echo $inability->inability_observation; ?>
            </p>
          </div>
         </ul>  
        </div>
        <?php endforeach ?>
        <?php else : ?>
        <?php endif ?>
      </div>
    </div>
    <!-- ---------------------------------------- -->
      
      <div class="col-12 mt-3 mt-4 mb-4 " style="margin:10px 0px 10px 0px;padding:10px;">
      <div class="header_clini col-md-12 mb-2 img-responsive">
        <p>Información remisiones</p>
      </div>
      <div class="col-md-12 m-2" style="height:220px;">
        <?php if (isset($remisions) && !empty($remisions)) : ?>
        <?php foreach($remisions as $value): ?>
        <div class="col-md-6 m-2">
          <ul>
            <div class="col-6 m-2">
              <p  class="items_text" style=" display: inline;">Fecha: </p>
              <p style=" display: inline;">
                <?= $value->create_at ?>
              </p>
            </div>
            <div class="col-6 m-2">
              <p  class="items_text" style=" display: inline;">Código procedimiento: </p>
              <p style=" display: inline;">
                <?= $value->remision_code ?>
              </p>
            </div>
             <div class="col-6 m-2">
                  <p  class="items_text" style=" display: inline;">Responsable: </p>
                  <p style=" display: inline;">
                  <?= $value->referred_to ?>
                  </p>
                </div>
             </div>
         </ul> 
         <div class="col-md-6 m-2">
          <ul>  
            
            <div class="col-6 m-2">
              <p  class="items_text" style=" display: inline;">Motivo de remisión: </p>
              <p style=" display: inline;">
              <?= $value->remision_motive ?>
              </p>
            </div>
            <div class="col-6 m-2">
              <p  class="items_text" style=" display: inline;">Procedimiento: </p>
              <p style=" display: inline;">
              <?= $value->remision_name?>
              </p>
            </div>
          </ul>
        </div>
        <?php endforeach ?>
        <?php else : ?>
        <?php endif ?>
      </div>

    </div>
    </div>  
   <div class="col-md-12  print-area1" style="margin:10px 0px 10px 0px;padding:10px;">
     <p class="col-md-12 header_name" style="">
         <i> Paciente: <?php echo $result['patient_name'];?> <?php echo $result['guardian_name'];?></i>
       </p>
      <div class="col-md-12 m-2 mb-" style="height:700px;" >
      <div class="header_clini col-md-12 mb-2 img-responsive">
        <p>Información Paraclínicos</p>
      </div>
        <?php if (isset($paraclini_clini) && !empty($paraclini_clini)) : ?>
        <?php foreach($paraclini_clini as $value): ?>

        <div class="col-md-6 m-2">
          <p  class="items_text" style=" display: inline;">Procedimiento: </p>
          <p style=" display: inline;">
            <?= $value->product_para ?>
          </p>
        </div>
        <div class="col-md-6 m-2">
          <p  class="items_text" style=" display: inline;">Código procedimiento: </p>
          <p style=" display: inline;">
            <?= $value->codigo_para ?>
          </p>
        <br><br>
        </div>
        <?php endforeach ?>
        <?php else : ?>
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
    </div>

    
    <!-- --------------------------------- -->
    
  </div>
  
</div>
   





