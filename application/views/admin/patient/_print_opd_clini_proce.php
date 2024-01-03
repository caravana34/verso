
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
            <!--------------------datos personales------------------------------- -->
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
            </div><!--END--datos personales-->
            <!---------------------------DASTOS DEL EQUIPO--------------------------------- --> 
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-1" style="width: -webkit-fill-available;padding:10px;border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                <?php
                    if (!empty($DataAll)) {
                        $operation = reset($DataAll);
                        ?>
                        <p class="text-center items_text " style="font-size:20px;margin-bottom:5px;margin-top:18px;">Informción del equipo</p>
                        <div class=" col-12 pull-right">
                            <input type="hidden" value="<?php echo $operation['id']; ?>">
                            <i class="fas fa-edit ml-2" onclick="editot(<?php echo $operation['id']; ?>)" style='font-size:23px; padding:15px; color:#1563b0;' title="Actualizar"></i>
                        </div>
                        <p>
                            <strong class="items_text">Nº:</strong><?php echo $operation['id']; ?>.
                            <strong class="items_text">Fecha: </strong><?php echo $operation['date']; ?>.
                            <strong class="items_text">Tipo de operación: </strong><?php echo $operation['operation_type']; ?>.
                            <strong class="items_text">Vía: </strong><?php echo $operation['Via']; ?>.
                            <strong class="items_text">Lateralidad: </strong><?php echo $operation['Laterality']; ?>.
                            <strong class="items_text">Anestesiólogo: </strong><?php echo $anestesiologo[0]->name." ".$anestesiologo[0]->surname; ?>.
                            <strong class="items_text">Descripción De Anestecia: </strong><?php echo $operation['descrition_anaethesia']; ?>.
                            <strong class="items_text">Enfermero: </strong><?php echo $aux_enfermeria[0]->name." ".$aux_enfermeria[0]->surname; ?>.
                            <strong class="items_text">Descripción procedimiento: </strong><?php echo $operation['remark']; ?>.
                            <strong class="items_text">sugerencias y conclusiones: </strong><?php echo $operation['Surgery_conclusions']; ?>.
                            <strong class="items_text">resultado: </strong><?php echo $operation['result']; ?>.
                        </p>
                        <?php
                    } else {
                        echo "<p class='items_text text-center'>no hay Informción del equipo.</p>";
                    }
                ?>
            </div><!---END--DASTOS DEL EQUIPO-->
            <!---------------------------PROCENDIMIENTOS MENORES--------------------------------- -->
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-1" style="width: -webkit-fill-available;padding:10px;border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                <?php
                    if (!empty($DataSmall)) {
                        $operation = reset($DataSmall);
                        ?>
                        <p class="text-center items_text " style="font-size:20px;margin-bottom:5px;margin-top:18px;">Procedimientos menores</p>
                        <div class=" col-12 pull-right">
                            <input type="hidden" value="<?php echo $operation['id']; ?>">
                            <i class="fas fa-edit ml-2" onclick="editot(<?php echo $operation['id']; ?>)" style='font-size:23px; padding:15px; color:#1563b0;' title="Actualizar"></i>
                        </div>
                        <p>
                            <strong class="items_text">Nº:</strong><?php echo $operation['id']; ?>.
                            <strong class="items_text">Fecha: </strong><?php echo $operation['date']; ?>.
                            <strong class="items_text">Tipo de operación: </strong><?php echo $operation['operation_type']; ?>.
                            <strong class="items_text">Vía: </strong><?php echo $operation['Via']; ?>.
                            <strong class="items_text">Lateralidad: </strong><?php echo $operation['Laterality']; ?>.
                            <strong class="items_text">Anestesiólogo: </strong><?php echo $anestesiologo[0]->name." ".$anestesiologo[0]->surname; ?>.
                            <strong class="items_text">Descripción De Anestecia: </strong><?php echo $operation['descrition_anaethesia']; ?>.
                            <strong class="items_text">Enfermero: </strong><?php echo $aux_enfermeria[0]->name." ".$aux_enfermeria[0]->surname; ?>.
                            <strong class="items_text">Descripción procedimiento: </strong><?php echo $operation['remark']; ?>.
                            <strong class="items_text">sugerencias y conclusiones: </strong><?php echo $operation['Surgery_conclusions']; ?>.
                            <strong class="items_text">resultado: </strong><?php echo $operation['result']; ?>.
                        </p>
                        <?php
                    } else {
                        echo "<p class='items_text text-center'> no hay Procedimientos menores.</p>";
                    }
                ?>
            </div><!--END-PROCENDIMIENTOS MENORES-->
            <!---------------------------ADMISION--------------------------------- -->
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-1" style="width: -webkit-fill-available;padding:10px;border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                <?php if (!empty($Admision_sv) or !empty($Admision_nn)) { ?>
                <p class="text-center items_text " style="font-size:20px;margin-bottom:25px;">Datos de admisión</p>
                <!---------SIG.VITALES.admición--------------- -->
                <div class="col-12">
                    <hr>
                    <p class="text-center items_text " style="font-size:20px;margin-bottom:8px;margin-top:23px;">signos vitales</p>
                    <?php foreach ($Admision_sv as $key =>$signos_vitales): ?>
                    <p class="" style="margin-bottom:30px;">
                        <strong class="items_text">Fecha: </strong><?php echo $signos_vitales->date; ?>.
                        <strong class="items_text">Tiempo: </strong><?php echo $signos_vitales->time; ?>.
                        <strong class="items_text">Peso: </strong><?php echo $signos_vitales->peso; ?>.
                        <strong class="items_text">Talla: </strong><?php echo $signos_vitales->talla; ?>.
                        <strong class="items_text">Temperaturas: </strong><?php echo $signos_vitales->temperatura; ?>.
                        <strong class="items_text">Pres. Diastólica: </strong><?php echo $signos_vitales->presion_dia; ?>.
                        <strong class="items_text">Pres. Sistólica: </strong><?php echo $signos_vitales->presion_sis; ?>.
                        <strong class="items_text">Frec. Cardíaca: </strong><?php echo $signos_vitales->frec_card; ?>.
                        <strong class="items_text">Frec. Respiratoria: </strong><?php echo $signos_vitales->frec_resp; ?>.
                        <strong class="items_text">Observaciones: </strong><?php echo $signos_vitales->remark; ?>.
                        <hr>
                    </p>
                    <?php endforeach ?>                
                </div><!--END--SIG.VITALES.admición-->
                <!---------ENFER.admición--------------- -->
                <div class="col-12" style="margin-bottom:20px;">
                    <p class="text-center items_text " style="font-size:20px;margin-bottom:8px;margin-top:23px;">Enfermeria</p>
                        <?php if (empty($Admision_nn)) { ?>
                        <?php } else { ?>
                            <?php for ($i=0; $i <$recent_record_count; $i++) { if (!empty($Admision_nn[$i])) { $id = $Admision_nn[$i]['id']; ?>
                                <P>
                                    <strong class="items_text">Fechas:</strong>
                                    <?php echo $this->customlib->YYYYMMDDHisTodateFormat($Admision_nn[$i]['date']); ?>
                                </P>
                                <P>
                                    <strong class="items_text">Nombre enfermera:</strong>
                                    <?php echo '<strong>' . $Admision_nn[$i]['employee_id'] . '</strong>' . ' ' . $Admision_nn[$i]['name'] . ' ' . $Admision_nn[$i]['surname']; ?>
                                </P>
                                <P>
                                    <strong class="items_text">-<?php echo $this->lang->line('note'); ?></strong> 
                                    <?php echo $Admision_nn[$i]['note'] ;?>
                                </P>
                                <p>
                                    <strong class="items_text">-<?php echo $this->lang->line('comment'); ?></strong>
                                     <?php echo $Admision_nn[$i]['comment'] ;?>
                                </p>                          
                            <?php }} ?> 
                        <?php } ?>                          
                </div><!--END-ENFER.admición -->
                   <?php
                        } else {
                        echo "<p class='items_text text-center'> no hay Datos de admisión.</p>";
                    }
                ?>
            </div><!--END-ADMISION-->
        </div>
        <div class="col-md-12 print-area1" >
            <!---------------------------TRANSOOERATORIO--------------------------------- -->
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-1" style="width: -webkit-fill-available;padding:10px;border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                <?php if (!empty($Transoperatorio_sv) or !empty($Transoperatorio_nn)) { ?>
                <p class="text-center items_text " style="font-size:20px;margin-bottom:25px;">Datos transOperatorios</p>
                <!---------SIG.VITALES.admición--------------- -->
                <div class="col-12">
                    <hr>
                    <p class="text-center items_text " style="font-size:20px;margin-bottom:10px;margin-top:23px;">Signos vitales</p>
                    <?php foreach ($Transoperatorio_sv as $key =>$signos_vitales): ?>
                    <p class="" style="margin-bottom:30px;">
                        <strong class="items_text">Fecha: </strong><?php echo $signos_vitales->date; ?>.
                        <strong class="items_text">Tiempo: </strong><?php echo $signos_vitales->time; ?>.
                        <strong class="items_text">Peso: </strong><?php echo $signos_vitales->peso; ?>.
                        <strong class="items_text">Talla: </strong><?php echo $signos_vitales->talla; ?>.
                        <strong class="items_text">Temperaturas: </strong><?php echo $signos_vitales->temperatura; ?>.
                        <strong class="items_text">Pres. Diastólica: </strong><?php echo $signos_vitales->presion_dia; ?>.
                        <strong class="items_text">Pres. Sistólica: </strong><?php echo $signos_vitales->presion_sis; ?>.
                        <strong class="items_text">Frec. Cardíaca: </strong><?php echo $signos_vitales->frec_card; ?>.
                        <strong class="items_text">Frec. Respiratoria: </strong><?php echo $signos_vitales->frec_resp; ?>.
                        <strong class="items_text">Observaciones: </strong><?php echo $signos_vitales->remark; ?>.
                    <hr>
                    </p>
                    <?php endforeach ?>
                </div><!--END--SIG.VITALES.admición-->
                <!---------ENFER.admición--------------- -->
                <div class="col-12" style="margin-bottom:20px;">
                    <p class="text-center items_text " style="font-size:20px;margin-bottom:8px;margin-top:23px;">Enfe$Transoperatorio_nnrmeria</p>
                    <?php if (empty($Transoperatorio_nn)) { ?>
                    <?php } else { ?>
                        <?php for ($i=0; $i <$recent_record_count; $i++) { if (!empty($Transoperatorio_nn[$i])) { $id = $Transoperatorio_nn[$i]['id']; ?>
                            <P>
                                <strong class="items_text">Fechas:</strong>
                                <?php echo $this->customlib->YYYYMMDDHisTodateFormat($Transoperatorio_nn[$i]['date']); ?>
                            </P>
                            <P>
                                <strong class="items_text">Nombre enfermera:</strong>
                                <?php echo '<strong>' . $Transoperatorio_nn[$i]['employee_id'] . '</strong>' . ' ' . $Transoperatorio_nn[$i]['name'] . ' ' . $Transoperatorio_nn[$i]['surname']; ?>
                            </P>
                            <P>
                                <strong class="items_text">-<?php echo $this->lang->line('note'); ?></strong> 
                                <?php echo $Transoperatorio_nn[$i]['note'] ;?>
                            </P>
                            <p>
                                <strong class="items_text">-<?php echo $this->lang->line('comment'); ?></strong>
                                 <?php echo $Transoperatorio_nn[$i]['comment'] ;?>
                            </p>                          
                        <?php }} ?> 
                    <?php } ?>   
                </div><!--END-ENFER.admición -->
                <?php
                    } else {
                        echo "<p class='items_text text-center'> no hay Datos transOperatorios.</p>";
                    }
                ?>
            </div><!--TRANSOOERATORIO-->
            <!---------POSOPERTORIO---------------- -->
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-1" style="width: -webkit-fill-available;padding:10px;border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                <?php if (!empty($Postoperatorio_sv) or !empty($Postoperatorio_nn)) { ?>
                    <p class="text-center items_text " style="font-size:20px;margin-bottom:25px;">Datos PosOperatorios</p>
                    <!---------SIG.VITALES.admición--------------- -->
                    <div class="col-12">
                        <hr>
                        <p class="text-center items_text " style="font-size:20px;margin-bottom:8px;margin-top:23px;">Signos vitales</p>
                        <?php foreach ($Postoperatorio_sv as $key =>$signos_vitales): ?>
                        <p class="" style="margin-bottom:30px;">
                            <strong class="items_text">Fecha: </strong><?php echo $signos_vitales->date; ?>.
                            <strong class="items_text">Tiempo: </strong><?php echo $signos_vitales->time; ?>.
                            <strong class="items_text">Peso: </strong><?php echo $signos_vitales->peso; ?>.
                            <strong class="items_text">Talla: </strong><?php echo $signos_vitales->talla; ?>.
                            <strong class="items_text">Temperaturas: </strong><?php echo $signos_vitales->temperatura; ?>.
                            <strong class="items_text">Pres. Diastólica: </strong><?php echo $signos_vitales->presion_dia; ?>.
                            <strong class="items_text">Pres. Sistólica: </strong><?php echo $signos_vitales->presion_sis; ?>.
                            <strong class="items_text">Frec. Cardíaca: </strong><?php echo $signos_vitales->frec_card; ?>.
                            <strong class="items_text">Frec. Respiratoria: </strong><?php echo $signos_vitales->frec_resp; ?>.
                            <strong class="items_text">Observaciones: </strong><?php echo $signos_vitales->remark; ?>.
                            <hr>
                        </p>
                        <?php endforeach ?>
                    </div><!--END--SIG.VITALES.admición-->
                    <!---------ENFER.admición--------------- -->
                    <div class="col-12" style="margin-bottom:20px;">
                        <p class="text-center items_text " style="font-size:20px;margin-bottom:8px;margin-top:23px;">Enfermeria</p>
                        <?php if (empty($Postoperatorio_nn)) { ?>
                        <?php } else { ?>
                            <?php for ($i=0; $i <$recent_record_count; $i++) { if (!empty($Postoperatorio_nn[$i])) { $id = $Postoperatorio_nn[$i]['id']; ?>
                                <P>
                                    <strong class="items_text">Fechas:</strong>
                                    <?php echo $this->customlib->YYYYMMDDHisTodateFormat($Postoperatorio_nn[$i]['date']); ?>
                                </P>
                                <P>
                                    <strong class="items_text">Nombre enfermera:</strong>
                                    <?php echo '<strong>' . $Postoperatorio_nn[$i]['employee_id'] . '</strong>' . ' ' . $Postoperatorio_nn[$i]['name'] . ' ' . $Postoperatorio_nn[$i]['surname']; ?>
                                </P>
                                <P>
                                    <strong class="items_text">-<?php echo $this->lang->line('note'); ?></strong> 
                                    <?php echo $Postoperatorio_nn[$i]['note'] ;?>
                                </P>
                                <p>
                                    <strong class="items_text">-<?php echo $this->lang->line('comment'); ?></strong>
                                     <?php echo $Postoperatorio_nn[$i]['comment'] ;?>
                                </p>                          
                            <?php }} ?> 
                        <?php } ?>
                    </div><!--END-ENFER.admición -->
                <?php
                    } else {
                        echo "<p class='items_text text-center'> no hay Datos PosOperatorios.</p>";
                    }
                ?>
            </div><!--END-POSOPERTORIO-->
            <!---------MEDICAMENTOS--------------- -->
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-1" style="width: -webkit-fill-available;padding:10px;border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                <!---------SIG.VITALES.admición--------------- -->
                <?php if (!empty($medication)) { ?>
                    <div class="table_inner" style="margin-bottom:20px;">
                        <p class="text-center items_text " style="font-size:20px;margin-bottom:25px;">Notas de los medicamentos</p>
                            <?php foreach ($medication as $medication_key => $medication_value) {
                                $pharmacy_id = $medication_value['pharmacy_id'];
                                $medicine_category_id = $medication_value['medicine_category_id'];
                                $date = $medication_value['date']; ?>
                                <p>
                                    <?php
                                    $subcount = 1;
                                    foreach ($medication_value['dosage'][$date] as $mkey => $mvalue) {
                                        $date = $this->customlib->YYYYMMDDTodateFormat($medication_value['date']); ?>
                                        <strong class="items_text">Fecha: </strong>
                                        <?php if ($subcount == 1) { echo $date . '<strong class="items_text">. día: </strong>' . date('l', strtotime($medication_value['date'])); } ?>
                                        <?php for ($x = 0; $x <= $dosage_count; $x++) {
                                            $medicine_id = $mvalue['dose_list'][$x]['pharmacy_id'];
                                            $medicine_category_id = $mvalue['dose_list'][$x]['medicine_category_id'];
                                            $add_index = $x;
                                        ?>
                                            <strong class="items_text"><?php echo $this->lang->line('time') ?> </strong><?php echo date('h:i A', strtotime($mvalue['dose_list'][$x]['time'])) ?>.
                                            <strong class="items_text">Medicamento: </strong><?php echo $mvalue['name'] ?>.
                                            <strong class="items_text">Dosis: </strong><?php echo $mvalue['dose_list'][$x]['medicine_dosage'] . " " . $mvalue['dose_list'][$x]['unit']; ?>.
                                            <strong class="items_text"><?php echo $this->lang->line('remark') ?>: </strong> <?php echo $mvalue['dose_list'][$x]['remark'] ?>.
                                        <?php } ?>
                                </p>
                            <?php $subcount++; } ?>
                        <?php } ?>
                    </div><!--END-ENFER.admición -->
                <?php
                    } else {
                        echo "<p class='items_text text-center'>No hay Notas de los medicamentos.</p>";
                    }
                ?>
            </div><!--END-TRANSOOERATORIO-->
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
</div>
      
   





