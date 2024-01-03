
<style>
  
        td {
            border: 1px solid black;
            height: 15px;
        }
    
  .propios_slot{
      background:#1563B0 !important;
  }
  
  .btn{
      background:#1563B0; 
  /*     color:#fff; */
      border-radius: 5px;
  }
  
  .capitalize {
      text-transform: uppercase;
  }
  
  .fc .fc-daygrid-event-harness {
      width: fit-content !important;
  }
  
  /* Estilo para las fechas festivas */
  .festivo {
      background-color: #FFD2D2 !important;
      pointer-events: none; /* Deshabilita la interacción con las fechas festivas */
  }
    
/*   .fc-timegrid-event-harness { height: 90px !important; } */
  
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
      color: #000 !important;
      border-left-color: #fff !important;
   }
  
   input.form-control.error-input{
     border-color: red !important;
   }
 
   .fc-dayGridMonth-view .fc-event {
      font-size: 12px; 
      padding: 2px 4px; 
      height: 20px; 
   }
  
  .fc-event{
    padding: 3px !important;
  }
  
  .fc-list-item:hover {
    background-color: lightgray;
    cursor: pointer;
  }
  
  .custom-calendar{
    width: 99%;
  }
  
 .custom-calendar:hover{
    background: blue;
  }
  
  .fc-today {
    background-color: rgba(21, 99, 176, 0.5) !important;
  }
  
  .fc-today div  a {
    color: #ffffff;
  }
  
  .fc-highlight-now {
    background-color: #FFD700; 
    opacity: 0.3; 
  }
  
  .fc-time-grid-slot.fc-today {
    background-color: #FFD700; 
  }
  
  .fc-holiday {
    background-color: rgba(198, 0, 0, 0.5) !important;
    color: black !important; 
    pointer-events: none;
    cursor: not-allowed;
  }
  
/*   .fc-holiday div a {
    color: black;
  } */
  
/*   .fc-timegrid-slot {
      height: 16em !important;
      border-bottom: 0 !important;
  }
   */
/* Tamaño de los slots */
  .fc-timegrid-slot {
      height: 4em !important;
      border-bottom: 0 !important;
  }
  
  .custom-calendar{
    border-radius: 5px !important;
/*     margin: 0px !important; */
  }
  
  .fc-list-event-title{
    display: none;
  }
  .fc-list-event-time {
    display: none;
  }
  .fc-list-event-graphic{
    display: none;
  }
  
  .hover-event{
    min-height: 6em !important;
  }
  
  .hover-event > h5{
    margin: 0px;
  }
  
  /* color del alendario */
  .fc-view-harness {
    background-color: rgb(51, 134, 190, 0.5);
/*     background-color: rgba(51, 190, 134, 0.5); */
    border-radius: 5px;
  }

  /* Color no bussiness */
/*   .fc-non-business{
    background-color: rgba(115, 113, 112, 0.5) !important;
  } */
  
  .custom_slots{
    align-items: center;
  }
  
  .custom_slots a{
    margin: 0px !important;
  }
  
  .time-grid-custom{
    flex-direction: column;
    margin-bottom: 5px;
  }
  
  .time-grid-custom h5{
    margin: 1px !important;
  }
  
  .fc .fc-timegrid-bg-harness {
        background-color: rgba(115, 113, 112, 0.1); 
        opacity: 1;
  }
  
/*   .fc .fc-scroller-liquid-absolute {
      overflow-y: hidden !important;
  } */

  .flex-grow {
    display: flex;
    flex-grow: 1;
  }
  
  .tippy-content{
    display: flex;
  }
  
  .hover-event-week{
     min-height: 11em !important;
     width: 100% !important;
  }


  .fc-header-toolbar{
/*       background-color: rgb(51, 134, 190, 0.5); */
      margin-bottom: 5px !important;  
/*       padding: 5px !important;  */
  }
  
/*   .fc-toolbar-title {
    font-family: sans-serif;
    font-size: 1.5rem !important;
    margin-top: 10px !important;
  } */
  
  .fc .fc-scrollgrid {
      border-collapse: collapse;
  }
  
  .bootstrap-datetimepicker-widget{
    overflow: visible !important;
  }
  
  .available-time{
    background-color: rgba(116, 184, 47, 0.5);
  }
  
   #appointment_calendar {
      height: 430px !important;
   }
  
  .not-working-doctor{
      background-color: #c9c9c9 !important;
      pointer-events: none;
  }

  @media (max-height: 1080px){
      #appointment_calendar {
      height: 780px !important;
    }
  }

  @media (max-height: 2160px){
      #appointment_calendar {
      height: 1080px !important;
    }
  }

  @media (max-height: 768px){
      #appointment_calendar {
      height: 450px !important;
    }
  }
  

</style>

  <style>
      table.dataTable tbody td {
        word-break: break-word;
        vertical-align: top;
      }

      .scroll-container {
        max-height: 280px;
        overflow-y: scroll;
        overflow-x: hidden;
      }

      /* Personaliza el estilo del scroll */

      .scroll-container::-webkit-scrollbar {
        width: 8px;
      }

      .scroll-container::-webkit-scrollbar-track {
        background-color: #f1f1f1;
      }

      .scroll-container::-webkit-scrollbar-thumb {
        background-color: #25538f;
        border-radius: 4px;
      }

      .scroll-container::-webkit-scrollbar-thumb:hover {
        background-color: #555;
      }

      .list-hover:hover {
        background: rgb(240, 240, 240);
        cursor: pointer;
      }

      .disabled {
        cursor: not-allowed;
        pointer-events: none;
      }
      
      .eva {
         height: 224px !important;
        }
    </style>


<?php
$currency_symbol = $this->customlib->getHospitalCurrencyFormat();
$genderList      = $this->customlib->getGender_Patient();
date_default_timezone_set("America/Bogota");
$currentDateTime = new DateTime(); 
$result_currentDate = $currentDateTime->format('Y/m/d');
// $result_currentTime = $currentDateTime->format('H:m:s');
// $this->appointment_status = $this->config->item('public_holidays');}
// $holidays = $this->public_holidays = $this->config->item('public_holidays');
// echo "<pre>";
// print_r($doctor_select);
// exit; 
?>

<div class="content-wrapper">
  <!-- Main content --> 
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="row" style="display: flex; margin: 0px 5px 0px 5px;">
                  <div class="flex-grow">
                    <h3 style="margin: 0px">
                      <strong>Agendas</strong>
                    </h3>
                  </div>
                  <div class="flex-grow">
                     <div id="">
                       <small class="label cita_agendada" data-toggle='tooltip' title='Agendamiento' >Agendada</small>
                       <small class="label cita_confirmada" data-toggle='tooltip' title='Confirmación'>Confirmada</small>
                       <small class="label cita_cancelada" data-toggle='tooltip' title='Cancelación' >Cancelada</small>
                       <small class="label cita_no_asistida" data-toggle='tooltip' title='Inasistencia'>No Asistida</small>
                       <small class="label cita_aprobada" data-toggle='tooltip' title='Aprobación' >Aprobada</small>
                       <small class="label cita_firmada" data-toggle='tooltip' title='Finalización' >Firmada</small>
                       <small class="label cita_bloqueada" data-toggle='tooltip' title='Bloqueos' >Bloqueada</small>
                     </div>
                  </div>
                  <div>           
                      <?php if ($this->rbac->hasPrivilege('appointment', 'can_add')) {?>
                      <a data-toggle="modal" onclick="holdModal('myModal')" class="btn btn-sm addappointment" style="background:#1563B0; color:#fff;border-radius: 5px;"> <i class="fa fa-plus"></i> <?php echo $this->lang->line('add_appointment'); ?></a>
                      <a data-toggle="modal" id="add" onclick="holdModal('myModalpa')" class="btn btn-sm addappointment" style="color:#fff;"><i class="fa fa-plus"></i> Paciente nuevo</a>
                      <a data-toggle="modal" id="add" onclick="holdModal('stopModal')" class="btn btn-sm addappointment" style="color:#fff;"><i class="fa fa-plus"></i> Bloquear Agenda</a>

                      <?php }?>
      <!--            <a href="<?php echo base_url("admin/onlineappointment/patientschedule"); ?>" class="btn btn-sm" style="background:#1563B0; color:#fff;border-radius: 5px;"><i class="fa fa-reorder"></i> Búsqueda por doctor</a>
                      <a href="<?php echo base_url("admin/onlineappointment/patientqueue"); ?>" class="btn btn-sm" style="background:#1563B0; color:#fff;border-radius: 5px;"><i class="fa fa-reorder"></i> Citas del día</a> -->
                  </div>  
            </div>     
          </div>
          
<!--             <div class="row" style="margin: 10px 0px 10px 0px;" >
              <div class="col-lg-12">
              </div>
            </div> -->
          
            <!-- Desarrollo de calendario -->
          
    <div class="row">     
       <div class="col-md-12 itemcol">
            <div class="nav-tabs-custom relative" style="margin:10px">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#calendar_clini" onclick="refetch_events_cal()" data-toggle="tab" aria-expanded="true"><i class="fas fa-calendar"></i> Calendario</a></li>
                  <li><a href="#table_clini"  data-toggle="tab" aria-expanded="true"><i class="fas fa-table"></i> Tabla</a></li>
                  <li><a href="#agendas_table_clini"  data-toggle="tab" aria-expanded="true"><i class="fas fa-table"></i> Agendas Clínicas</a></li>
                  <div class="d-flex" style="justify-content: end; margin: 6px 5px 0px 0px; padding: 0px;">
                         <?php if ($user_role_id != 3): ?>
                            <div class="col-3 col-md-3 col-sm-3" style="">
                              <div class="form-group">
                                <div>
                                  <div class="input-group" style="margin:;">
                                    <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-calendar-check-o"></i></span>
                                    <input onchange="refetch_events()" type="date" name="" id="dateInput" placeholder="" class="form-control" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;">
                                    <span class="text-danger"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3">
          <!--                     <label for="fecha_inicial" style="margin-right: 10px;">Doctor</label> -->
                              <select id="doctor_id"  name="" class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true">
                                  <option value="" hidden>Todos los doctores</option> 
                                  <?php foreach ($doctors as $key => $value): ?>
                                  <option  value="<?= $value['id'] ?>"><p class="capitalize">
                                    <?php echo ucwords(strtolower($value["name"] . " " . $value["surname"] ." (". $value["employee_id"].")")) ?></p></option> 
                                  <?php endforeach ?>
                              </select>
                            </div>
                          <?php endif ?>
                  </div>
                  
                </ul>
              
                <div class="tab-content pt6" style="margin:10px;">
                      <div class="tab-pane tab-content-height active" id="calendar_clini">
                        <div class="chart">
                            <div id="appointment_calendar"></div>
                        </div>
                      </div>
                      <div class="tab-pane tab-content-height" id="table_clini">
                          <div class="row" style="margin-bottom:10px" >
                              <div class="col-lg-3">
                                <label for="" style="margin-right: 10px;">Fecha</label>
                                <select id="fecha_id"  onchange="enviar_fecha('limpiar')" name=""  class="form-control select2" style="width:100%" tabindex="-1" aria-hidden="true" >
                                    <option value="2">Todas las citas</option>   
                                    <option value="1">Citas de Hoy</option>   
                                    <option value="4">Citas en los próximos 7 días</option>
                                    <option value="5">Citas recientemente agendadas</option> 
                                </select>
                              </div>
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
                                        <th width="20%"><?php echo $this->lang->line('doctor'); ?></th>
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
                    <!--                     <th width="5%">Fecha de creación</th> -->
                                        <th width="100" class="text-right"><?php echo $this->lang->line('status'); ?></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>
                          </div> 
                      </div>
                      <div class="tab-pane tab-content-height" id="agendas_table_clini">
                        <div class="chart">
                            <div id="agendas">
                               <table>
                                  <tr>
                                      <td></td>
                                      <td>Carlos</td>
                                      <td>Pedro</td>
                                      <td>Juan</td>
                                      <td>Victor</td>
                                      <td>Maria</td> 
                                      <td>Josefina</td>
                                  </tr>
                                  <tr>
                                      <td>10:00 - 10:10</td>
                                      <td doctor="34" hora="10.1"></td>
                                      <td doctor="34" hora="10.2"></td>
                                      <td doctor="34" hora="10.2"></td>
                                      <td doctor="34" hora="10.3"></td>
                                      <td doctor="34" hora="10.4"></td> 
                                      <td doctor="34" hora="10.5"></td>
                                  </tr>


                                  <tr>
                                      <td>10:10 - 10:20</td>
                                      <td rowspan="2"> Cita medica</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td> 
                                      <td></td>

                                  </tr>
                                  <tr>
                                      <td>10:20 - 10:30</td>

                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td> 
                                      <td></td>

                                  </tr>
                                  <tr>
                                      <td>10:30 - 10:40</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td> 
                                      <td></td>

                                  </tr>
                                  <tr>
                                      <td>10:40 - 10:50</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td> 
                                      <td></td>

                                  </tr>
                              </table>
                            </div>
                        </div>
                      </div> 
                  </div>
                </div>  
          </div>
       </div>
    </div>

          
          </div><!-- /.box-header -->
          
          
        </div>
      </div>
  </section>
</div>

<div class="modal fade" id="vigencia_Modal" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-media-content">
      <div class="modal-header modal-media-header">
        <button type="button" class="close pt4" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $this->lang->line('appointment_details'); ?></h4>
      </div>
      <div class="modal-body pt0 pb0">
        <div class="row">
        La agenda del doctor seleccionado no esta vigente por favor actualice la viegencia en el modulo de Agendamiento.
        
       </div>
      </div>
    </div>
  </div>
</div>

  <div class="modal fade" id="myModal"  aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-media-content">
        <div class="modal-header modal-media-header">
          <button type="button" class="close pt4" data-dismiss="modal">&times;</button>
          <div class="row">
            <p id="doctor_ver">

            </p>
            <div class="col-sm-8 col-xs-8">
              <div class="row">
                  <div class="col-lg-10 col-md-10 col-sm-5 col-xs-9">
                      <div class="p-2 select2-full-width">
                          <select class="form-control patient_list_ajax" form="formadd" id="select_patient_id" name='patient_id'>
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
                            <label for="type_visit">Tipo de consulta</label><small class="req"> *</small>
                            <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-th-list" style="color:#1563B0;"></i></span>
                                <select class="form-control" id="type_visit" name="type_visit" style="border-radius: 0px 10px 10px 0px !important;">
                                    <option value="" hidden>Seleccione</option>
                                    <option value="consulta_externa">Consulta externa</option>
                                    <option value="cirugia">Cirugia</option>
                                    <option value="procedimientos">Procedimientos</option>
                                    <option value="ingreso">Ingreso</option>
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
                                  <option value="PAC">PAC</option>
                              </select>    
                              <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                          </div>
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label>Eps responsable </label><small class="req"> *</small>
                          <div class="input-group">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-file-invoice-dollar" style="color:#1563B0;"></i></span>
                              <select class="form-control" name="responsible_eps" style="border-radius: 0px 10px 10px 0px !important;">
                                  <option value="" hidden>Seleccione</option>
                                  <option value="SURA EPS">SURA EPS</option>
                                  <option value="ALIANSALUD">ALIANSALUD</option>
                                  <option value="ANAS WAYUU EPSI  MALLAMAS EPSI">ANAS WAYUU EPSI  MALLAMAS EPSI</option>
                                  <option value="ASOCIACION INDIGENA DEL CAUCA">ASOCIACION INDIGENA DEL CAUCA</option>
                                  <option value="ASMET SALUD">ASMET SALUD</option>
                                  <option value="CAPITAL SALUD">CAPITAL SALUD</option>
                                  <option value="COOSALUD">COOSALUD</option>
                                  <option value="CAJACOPI ATLANTICO">CAJACOPI ATLANTICO</option>
                                  <option value="CAPRESOCA">CAPRESOCA</option>
                                  <option value="COMFACHOCO">COMFACHOCO </option>
                                  <option value="COMFAORIENTE">COMFAORIENTE</option>
                                  <option value="COMFENALCO VALLE">COMFENALCO VALLE</option>
                                  <option value="COMPENSAR">COMPENSAR</option>
                                  <option value="DUSAKAWI EPSI">DUSAKAWI EPSI</option>
                                  <option value="EMSSANAR">EMSSANAR</option>
                                  <option value="EPS FAMILIAR DE COLOMBIA">EPS FAMILIAR DE COLOMBIA</option>          
                                  <option value="EPM - EMPRESAS PUBLICAS DE MEDELLIN">EPM - EMPRESAS PUBLICAS DE MEDELLIN </option>
                                  <option value="FAMISANAR">FAMISANAR</option>
                                  <option value="FONDO DE PASIVO SOCIAL DE FERROCARRILES NACIONALES DE COLOMBIA">FONDO DE PASIVO SOCIAL DE FERROCARRILES NACIONALES DE COLOMBIA </option>
                                  <option value="PIJAOS SALUD EPSI">PIJAOS SALUD EPSI</option>
                                  <option value="MUTUAL SER">MUTUAL SER</option>
                                  <option value="NUEVA EPS">NUEVA EPS</option>
                                  <option value="SALUD TOTAL">SALUD TOTAL</option>
                                  <option value="SANITAS">SANITAS</option>
                                  <option value="SERVICIO OCCIDENTAL DE SALUD">SERVICIO OCCIDENTAL DE SALUD</option>
                                  <option value="SALUD MIA">SALUD MIA</option>
                                  <option value="SAVIA SALUD">SAVIA SALUD</option>
                                  <option value="SALUD BÓLIVAR">SALUD BÓLIVAR</option>
                              </select>    
                              <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                          </div>
                      </div>
                    </div> 
                      <div class="col-sm-3">
                      <div class="form-group">
                        <label for="doctorid"><?php echo $this->lang->line('doctor'); ?></label>
                        <small class="req"> *</small>
                        <div>
                          <select class="form-control select2 doctor_select2" onchange="getDoctorShift(this);getDoctorFees(this);get_specialist(this,'add');reset_all();" <?php
                            if ((isset($disable_option)) && ($disable_option == true)) {
                            echo 'disabled';
                            }
                            ?> name="doctorid" id="doctorid" style="width:100%" >
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
                      <label>Procedimientos</label>
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
                  <div class="col-lg-4 col-md-4 col-sm-2">
                        <div class="form-group">
                          <label>Producto</label>
                          <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" autocomplete="off" value="" id="product_cups" name="product_cups" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                            <span class="text-danger"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-2 mb-5">
                        <div class="form-group">
                          <label>Codigo</label>
                          <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" autocomplete="off" id="codigo_cups" value="" name="codigo_cups" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" readonly>
                            <span class="text-danger"></span>
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
                     


    <!--                 <div class="col-sm-3">
                      <div class="form-group">
                        <label for="exampleInputFile"><?php echo $this->lang->line('doctor'); ?></label>
                        <small class="req"> *</small>
                        <div>
                          <select class="form-control select2 doctor_select2" name="doctorid" onchange="getDoctorShift(this);getDoctorFees(this);get_specialist(this,'add');reset_all();" <?php
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
                    </div> -->
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
                        <div class="form-group" style="position: relative; overflow:visible !important">
                          <label>Dia de consulta</label>
                          <small class="req"> *</small>
                          <div class="input-group">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-calendar-check" style="color:#1563B0;"></i></span> 
                              <input type="text" id="datetimepicker" name="date" class="form-control date-appointment" style="border-radius: 0px 10px 10px 0px !important;">
                              <span class="text-danger"><?php echo form_error('date'); ?></span>
                          </div>
                        </div>
                      </div>
                    <div class="col-md-3">
                          <div class="form-group">
                              <label for="slot"><?php echo $this->lang->line('slot'); ?></label>
                              <span class="req">*</span>
                              <div class="input-group">
                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-user-clock" style="color:#1563B0;"></i></span> 
                                  <select name="slot" id="slot" onchange="validateTime(this);getSlotByShift('add')" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                      <option value=""><?php echo $this->lang->line('select'); ?></option>
                                  </select>
                                  <span class="text-danger"><?php echo form_error('slot'); ?></span>
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
                                <input type="text" name="cheque_date" id="cheque_date" class="form-control date-appointment">
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
    <!--                     <input type="hidden" id="slot_id" name="slot1" /> -->
                    <div id="list_input_slot">
                    </div>

                    <div class="col-md-12">
                       <div id="slot1"></div>
                    </div>
                  </div> 
                </div><!--./row-->
              </div><!--./col-md-12-->
</div><!--./row-->
            </div><!--./modal-body-->

           <div class="content" id="table_patient_visits" style="display: none;">
              <h4>Visitas anteriores del paciente.</h4>
              <div class="staff-members">
                  <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover">
                              <thead>
                                  <th><?php echo $this->lang->line('opd_no'); ?></th>
                                  <th>Id visita</th>
                                  <th><?php echo $this->lang->line('appointment_date'); ?></th>
                                  <th>Doctor</th>
                                  <th>Estado</th>
                                  <th>Acciones</th>
  <!--                                                         <th>Medicamentos</th> -->
                              </thead>
                              <tbody id="patient_visits">
                              </tbody>
                      </table>
                  </div> 
              </div><!--./staff-members-->
           </div>

           <div class="modal-footer">
              <div class="pull-right">
                <button type="submit" id="formaddbtn"  data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn" style="color:#fff;"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
              </div>
              <div class="pull-right" style="margin-right: 10px; ">
                  <button type="submit"  data-loading-text="<?php echo $this->lang->line('processing') ?>" name="save_print" class="btn pull-right printsavebtn" style="color:#fff;"><i class="fa fa-print"></i> <?php echo $this->lang->line('save_print'); ?></button>
              </div>
           </div>
         </form>
      </div>
    </div>
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
         <div class="modal-body" style="padding-bottom: unset !important;">
           <form id="rescheduleform" accept-charset="utf-8" method="post">
             <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <input type="hidden" id="rdates">
                    <input type="hidden" id="message_reason">
                    <input type="hidden" id="edit_patient_id" name="edit_patient_id">
                    <input type="hidden" id="edit_appointment_id">

                    <!-- inputs agregados al modal -->
                  
                  
                  
                 <div class="col-sm-3">
                    <div class="form-group">
                        <label for="type_visit">Tipo de consulta</label><small class="req"> *</small>
                        <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-th-list" style="color:#1563B0;"></i></span>
                            <select class="form-control" id="edit_type_visit" name="edit_type_visit" style="border-radius: 0px 10px 10px 0px !important;">
                                <option value="" hidden>Seleccione</option>
                                <option value="consulta_externa">Consulta externa</option>
                                <option value="cirugia">Cirugia</option>
                                <option value="procedimientos">Procedimientos</option>
                                <option value="ingreso">Ingreso</option>
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
                              <select class="form-control" id="edit_responsible" name="edit_responsible" style="border-radius: 0px 10px 10px 0px !important;" autocomplete="off">
                                  <option value="" hidden>Seleccione</option>
                                  <option value="EPS">Eps</option>
                                  <option value="PARTICULAR">Particular</option>
                                  <option value="POLIZA">Poliza</option>
                                  <option value="PAC">PAC</option>
                              </select>    
                              <span class="text-danger"></span>
                          </div>
                      </div>
                    </div>

                   
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label>Eps responsable</label><small class="req"> *</small>
                          <div class="input-group">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-file-invoice-dollar" style="color:#1563B0;"></i></span>
                              <select class="form-control" id="edit_responsible" name="edit_responsible" style="border-radius: 0px 10px 10px 0px !important;">
                                  <option value="" hidden>Seleccione</option>
                                  <option value="SURA EPS">SURA EPS</option>
                                  <option value="ALIANSALUD">ALIANSALUD</option>
                                  <option value="ANAS WAYUU EPSI  MALLAMAS EPSI">ANAS WAYUU EPSI  MALLAMAS EPSI</option>
                                  <option value="ASOCIACION INDIGENA DEL CAUCA">ASOCIACION INDIGENA DEL CAUCA</option>
                                  <option value="ASMET SALUD">ASMET SALUD</option>
                                  <option value="CAPITAL SALUD">CAPITAL SALUD</option>
                                  <option value="COOSALUD">COOSALUD</option>
                                  <option value="CAJACOPI ATLANTICO">CAJACOPI ATLANTICO</option>
                                  <option value="CAPRESOCA">CAPRESOCA</option>
                                  <option value="COMFACHOCO">COMFACHOCO </option>
                                  <option value="COMFAORIENTE">COMFAORIENTE</option>
                                  <option value="COMFENALCO VALLE">COMFENALCO VALLE</option>
                                  <option value="COMPENSAR">COMPENSAR</option>
                                  <option value="DUSAKAWI EPSI">DUSAKAWI EPSI</option>
                                  <option value="EMSSANAR">EMSSANAR</option>
                                  <option value="EPS FAMILIAR DE COLOMBIA">EPS FAMILIAR DE COLOMBIA</option>          
                                  <option value="EPM - EMPRESAS PUBLICAS DE MEDELLIN">EPM - EMPRESAS PUBLICAS DE MEDELLIN </option>
                                  <option value="FAMISANAR">FAMISANAR</option>
                                  <option value="FONDO DE PASIVO SOCIAL DE FERROCARRILES NACIONALES DE COLOMBIA">FONDO DE PASIVO SOCIAL DE FERROCARRILES NACIONALES DE COLOMBIA </option>
                                  <option value="PIJAOS SALUD EPSI">PIJAOS SALUD EPSI</option>
                                  <option value="MUTUAL SER">MUTUAL SER</option>
                                  <option value="NUEVA EPS">NUEVA EPS</option>
                                  <option value="SALUD TOTAL">SALUD TOTAL</option>
                                  <option value="SANITAS">SANITAS</option>
                                  <option value="SERVICIO OCCIDENTAL DE SALUD">SERVICIO OCCIDENTAL DE SALUD</option>
                                  <option value="SALUD MIA">SALUD MIA</option>
                                  <option value="SAVIA SALUD">SAVIA SALUD</option>
                                  <option value="SALUD BÓLIVAR">SALUD BÓLIVAR</option>
                              </select>    
                              <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
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
                      <label>procedimientos</label>
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
                  
                  
                  <div class="col-sm-3">
                      <div class="form-group">
                          <label for="edit_reason_consultation">Procedmientos Cirugía</label><small class="req"> *</small>
                          <div class="input-group">
                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-user-injured" style="color:#1563B0;"></i></span>
                              <select class="form-control" id="" name="" style="border-radius: 0px 10px 10px 0px !important;" autocomplete="off">
                              </select>    
                              <span class="text-danger"></span>
                          </div>
                      </div>
                    </div>
                  
                  
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

  <!--                  <div class="col-sm-3">
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
                    </div> -->


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
  <!--                   <div class="col-sm-3">
                      <div class="form-group">
                        <label for="doctor_fees"><?php echo $this->lang->line("doctor_fees"); ?></label>
                        <small class="req"> *</small>
                        <div>   
                            <input type="" name="doctor_fees" id="rdoctor_fees_edit" class="form-control"  readonly >
                        </div>
                        <span class="text-danger"><?php echo form_error('doctor_fees'); ?></span>
                      </div>
                    </div> -->
                    <div class="col-sm-3" style="display:none">
                      <div class="form-group">
                          <label for="rglobal_shift_edit"><?php echo $this->lang->line('shift'); ?></label><span class="req"> *</span>
                          <select name="rglobal_shift" id="rglobal_shift_edit" onchange="" class="select2" style="width:100%">
                              <option value=""><?php echo $this->lang->line('select'); ?></option>
                          </select>
                          <span class="text-danger"><?php echo form_error('rglobal_shift'); ?></span>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="dates">Dia de la consulta</label>
                        <small class="req"> *</small>
                        <input type="text" id="dates" name="appointment_date"  class="form-control date-appointment" value="<?php echo set_value('dates'); ?>">
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
                            <label for="type_visit">Categoría paciente</label><small class="req"> *</small>
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
                  
               </div><!--./col-md-12-->
             </div>
           </form>         
           <div class="modal-footer">
              <div class="pull-right">
                <button type="submit" id="rescheduleformbtn" form='rescheduleform' data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn pull-right" ><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
              </div>
           </div>
        </div><!--./modal-body-->
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

<?php $this->load->view('admin/patient/patientPaymentAdd') ?>

<?php $this->load->view('admin/patient/patientupdate') ?>    
<?php $this->load->view('admin/patient/patientaddmodal') ?>
  <!-- Desarrollo de factura_modal -->
<?php $this->load->view('admin/patient/patienttest',$doctors) ?>
  <!-- Desarrollo de factura_modal  -->
<!-- <script src="<?php echo base_url() ?>backend/js/Chart.bundle.js"></script>
<script src="<?php echo base_url() ?>backend/js/utils.js"></script> -->

<!-- Desarrollo de calendario -->

<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/locales/es.js"></script>
<script src="https://unpkg.com/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6.3.0/dist/tippy-bundle.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>


<script>
    
    document.addEventListener('DOMContentLoaded', function () {
      
//       let eliminar = document.getElementById('btnEliminar'); 
      const calendarEl = document.getElementById('appointment_calendar'); 
      let tooltip = document.getElementById('tooltip');
      
      let holidays = ['2023-10-16', '2023-11-6', '2023-11-13', '2023-12-08', '2023-12-25'];
      let does_not_work = true;
      let array_doctor_daily = [];
      let base_url = "<?= base_url(); ?>";
      let user_role_id = "<?= $user_role_id ?>";
      
      const calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'local',
        slotDuration: '00:10:00', 
        slotLabelInterval: '01:00:00',
        initialView: 'timeGridDay',
        allDaySlot: false,
        editable: true,
        selectable: true,
        nowIndicator: true,
        events: base_url+"admin/appointment/appointment_calendar/",
        
//         slotEventOverlap: false,
//         slotMinTime: '08:00:00', // Hora de inicio (por ejemplo, 08:00 AM)
//         slotMaxTime: '18:00:00', // Hora máxima visible (por ejemplo, 06:00 PM)
        locale: 'es',
        headerToolbar: {
          left: 'today,prev,next title',
//           center: 'title',
//           right: 'dayGridMonth,timeGridWeek,timeGridDay,listDay'
          right: 'timeGridDay,timeGridWeek,dayGridMonth,listDay,customView'

        },
        
        views: {
          timeGrid: {
            slotLabelFormat: {
              hour: '2-digit', 
              minute: '2-digit'
            }
          },
          customView: { 
             type: 'timeGrid',
             duration: { day: 1},
             buttonText: 'Agenda Clínicas',
          }
        },
        selectConstraint: {
          start: '00:01', // Hora de inicio del bloqueo
          end: '23:59',   // Hora de fin del bloqueo
          dow: [1, 2, 3, 4, 5], // Días de la semana a bloquear (Lunes a Viernes)
          ranges: [
            // Puedes agregar más rangos si es necesario
            {
              start: '2023-11-17', // Fecha de inicio del bloqueo
              end: '2023-11-25'    // Fecha de fin del bloqueo
            }
          ]
        },
        
        customButtons: {
          
            timeGridWeek: {
                text: 'Semana',
                click: function() {
                      calendar.changeView('timeGridWeek');
                      custom_view_resouces();
                } 
            },
            timeGridDay: {
                text: 'Dia',
                click: function() {
                      calendar.changeView('timeGridDay');
                      custom_view_resouces();

                } 
            },
            customView: {
              text: 'Agenda Clínicas',
              click: function(event) {
                if (!this.classList.contains('fc-button-active')) {
                      calendar.changeView('customView');
                      custom_view_resouces();
                  }
              },
            },
            today: {
             text: 'Hoy',
             click: function() {
                calendar.today();
                custom_view_resouces();
              },
            },
            next: {
              click: function() {
                calendar.next(); 
                custom_view_resouces();
              },
            },
            prev: {
              click: function() {
                calendar.prev(); 
                custom_view_resouces();
              },
            },
        },
        
        slotLabelContent: function(arg) {
           if(arg.view.type === 'customView'){
             
                 calendar.setOption('slotLabelInterval', '00:10:00');

                 let start = moment(arg.date);
                 let end = start.clone().subtract(10, 'minutes'); // Clona y resta 10 minutos al tiempo original

                 if (start.format('HH:mm') == '00:00') {
                    end = moment('00:00', 'HH:mm');
                 }

                 return {
                    html: '<span>' + end.format('HH:mm') + ' - ' + start.format('HH:mm') + '</span>',
                 };
           } else {
             calendar.setOption('slotLabelInterval', '01:00:00');
             return moment(arg.date).format('HH:mm');
           }
        },

          datesSet: function (info) {

              console.log(info);

              let today = "<?= $currentDateTime->format('Y-m-d') ?>";
              let todayCells = calendarEl.querySelectorAll('.fc-day[data-date="' + today + '"]');

              todayCells.forEach(function (cell) {
                cell.classList.add('fc-today');
              });

              holidays.forEach(function (holiday) {
                  let holidayCells = calendarEl.querySelectorAll('.fc-day[data-date="' + holiday + '"]');
                  if (holidayCells.length > 0) {
                      holidayCells.forEach(function (cell) {
                          if (cell) {
                              console.log(cell);
                              cell.classList.add('fc-holiday');
                          }
                      });
                  }
              });


         },

        select: function (info) {
          
            let doctor_id = document.getElementById('doctor_id').value;

            if(doctor_id !== '' && info.view.type !== 'dayGridMonth'){
              
                 let selectedDay = info.start.getDay(); // Día de la semana (0: domingo, 1: lunes, ..., 6: sábado)

                 let startHour = new Date(info.startStr).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: false});
                 let endHour = new Date(info.endStr).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: false});

                 let businessHours = calendar.getOption('businessHours');
                 let filteredBusinessHours = businessHours.filter(function (interval) {
                    return interval.daysOfWeek.includes(selectedDay);
                 });

                let close_slots = false;

                filteredBusinessHours.forEach(function (interval) {
//                   console.log('Día de la semana:', selectedDay);
//                   console.log('Hora de inicio:', interval.startTime);
//                   console.log('Hora de finalización:', interval.endTime);

                    if (startHour >= interval.startTime && endHour <= interval.endTime) {
                        close_slots = true;
                    } 
                });

                if(close_slots == false){
                   errorMsg('No puedes agendar en esta hora fuera del horario laboral.');
                   does_not_work = false;
                } else {
                   close_slots = false;
                   does_not_work = true;
                }
               
            }

        },
 
        dayCellContent: function (arg) {

           const date = new Date(arg.date);
           let doctor_id = document.getElementById('doctor_id').value;
           let fc_timegrid_slot = calendarEl.querySelectorAll(`.fc-timegrid-slot-lane`);
           let holiday = calendarEl.querySelector('.fc-holiday');

            fc_timegrid_slot.forEach((element) => {
                  if (element.classList.contains('available-time')) {
                      element.classList.remove('available-time');
                      element.innerHTML = ``;
                  }
            });
          
           console.log(holiday);
          
           if(doctor_id !== '' && arg.view.type === 'timeGridDay'){

                 let businessHours = calendar.getOption('businessHours');

                 if(businessHours){
                      let filteredBusinessHours = businessHours.filter(function (interval) {
                         return interval.daysOfWeek.includes(date.getDay());
                      });
                   
                      let doctor_information = <?php echo json_encode($doctors) ?>;
                      
                      
                      let doctor_selected = doctor_information.filter((item) => item.id === doctor_id);
                        console.log(doctor_information);
                        
                   
                       async function fetchData(doctor_id) {
                          try {
                            const blocked_days = await fetch('<?= base_url("admin/appointment/update_block_days/") ?>'+doctor_id, {
                              method: "POST",
                              headers: {
                                "Content-Type": "application/json"
                              },
                              body: JSON.stringify({ id_doctor: doctor_id })
                            });

                            const lock_days = await blocked_days.json();
                            return lock_days;
                          } catch (error) {
                            console.error('Error fetching data:', error);
                          }
                        }

                        // Call the async function
                       const val_lock = fetchData(doctor_id);
                      console.log(val_lock);
                   
                      filteredBusinessHours.forEach(function (interval) {
                        
                          fc_timegrid_slot.forEach((element) => {  
                              const dataTimeAttributeValue = element.getAttribute('data-time').split(':').slice(0, 2).join(':');
                              if(dataTimeAttributeValue >= interval.startTime && dataTimeAttributeValue < interval.endTime){
                                  element.classList.add('available-time');
                                if(user_role_id == 3){
                                  element.innerHTML = `<h6 style="margin-left: 5px; color: write;">${doctor_information[0].name} - ${doctor_information[0].specialist_doc} - Disponible.</h6>`;
                                 }else{
                                  element.innerHTML = `<h6 style="margin-left: 5px; color: write;">${doctor_selected[0].name} - ${doctor_selected[0].specialist_doc} - Disponible.</h6>`;
                                 }
                              }
                          });

                      });
                   
                 }

           } else if(doctor_id !== '' && arg.view.type === 'timeGridWeek'){
                console.log('entro aqui timeGridWeek');
                let gridcell = calendarEl.querySelectorAll(`.gridcell`);
             
                console.log(gridcell);
             
                gridcell.forEach((element) => {
                  console.log(element);
                });
                       
           } 
          
          if(arg.view.type === 'timeGridMonth'){
               return date.getDate();
          }

       },
        
        dateClick: function (info) {
        
//          console.log(calendarEl.querySelectorAll('.fc-holiday'));
            let element = info.jsEvent.target;
            let holiday = calendarEl.querySelector('.fc-holiday');
            let tippy_content = calendarEl.querySelector('.tippy-content');
            let doctor_id = document.getElementById('doctor_id');
            let today = "<?= $currentDateTime->format('Y-m-d') ?>";
            let start_date = info.date.toISOString().split('T')[0];
            let array_errors = [];
         
            if(!tippy_content && doctor_id.value == ""){
                  array_errors['doctor'] = 'Debe seleccionar el doctor para agendar una cita.';
            }

            if (!tippy_content && start_date < today) {
                  array_errors['previous_date'] = 'No puedes insertar una cita en una fecha anterior a hoy.';
            }
          
            if(!tippy_content && holiday !== null){
              
                  if(info.view.type == 'dayGridMonth' || info.view.type == 'timeGridWeek'){
                     if(!element.classList.contains('fc-highlight')){
                         array_errors['holiday_date'] = 'Hoy es un día festivo y no se pueden agendar citas.';
                     }
                  } else {
                      array_errors['holiday_date'] = 'Hoy es un día festivo y no se pueden agendar citas.';
                  } 
              
            }
         
            if(info.view.type == 'timeGridWeek' && holiday === null){
              holiday = true;
            }else if(info.view.type == 'timeGridDay' && holiday === null){
              holiday = true;
            }
         
            console.log(holiday);

            if(!tippy_content && holiday && start_date >= today && doctor_id.value != "" && does_not_work){

                var date_ver = new Date(info.date).toLocaleDateString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' });
                var hora = new Date(info.date).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true });
//               var tiempo_final = hora.setMinutes(hora.getMinutes() + 10);
                var formData = new FormData();
                formData.append("date", date_ver);
                formData.append("doctorid", $("#doctor_id").val());
                formData.append("time", hora);
                console.log(date_ver);
                var partes = hora.split(/:| /);

                // Obtener la hora, los minutos y los segundos
                var horas = parseInt(partes[0]);
                var minutos = parseInt(partes[1]);
                var segundos = parseInt(partes[2]);

                // Obtener el AM/PM
                var ampm = partes[3];

                // Sumar 10 minutos a la hora
                minutos += 10;

                // Verificar si se pasa a la siguiente hora
                if (minutos >= 60) {
                  horas += 1;
                  minutos -= 60;
                }
              
                //desarrollando

                // Formatear la hora resultante
                var horaFinal = horas.toString().padStart(2, '0') + ":" + minutos.toString().padStart(2, '0') + ":" + segundos.toString().padStart(2, '0') + " " + ampm;
                var global_shift_id = 8;
                console.log(horaFinal);
                function getShiftData() {
                    return new Promise(function (resolve, reject) {
                          $.ajax({
                            url: baseurl + 'admin/onlineappointment/getShift',
                            type: "POST",
                            data: { doctor: $("#doctor_id").val(), date: date_ver, global_shift: 8 },
                            dataType: 'json',
                            success: function (res) {
                              // Resuelve la promesa con los datos obtenidos
                              resolve(res);
                            },
                            error: function (xhr, status, error) {
                              // Rechaza la promesa en caso de error
                              reject(error);
                            }
                          });
                    });
                }

                getShiftData().then(function (data) {
                  
                  let hora = new Date(info.date).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true });

                  data.forEach(function(obj) {
                      if (obj.start_time.includes("PM") && hora.includes("PM") ) {
                        var id = obj.id;
                          formData.append("slot",id);
                          console.log("ID with 'PM' in start_time: " + id);
                      }else if(obj.start_time.includes("AM") && hora.includes("AM") ){
                        var id = obj.id;
                        formData.append("slot",id);
                      }
                  });


                 $.ajax({
                        url: baseurl+'admin/appointment/add_calendar',
                        type: "POST",
                        data:  formData,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                           console.log(data);
                          if(data==0){
                               errorMsg('Ya hay una cita programada para esta hora.');
                               console.log("ya existe una cita");
                           }else{
                             
                               viewreschedule(data);
                               refetch_events();
                             
                           }
                        },
                          error: function () {
                        }
                    });

                })
                .catch(function (error) {
                  console.error(error);
                });

                formData.append("time_finish", horaFinal);
                formData.append("global_shift_id", global_shift_id);


                $("#datetimepicker").datepicker("setDate", date_ver);
                var event = new Event('change', { bubbles: true });
                document.getElementById('datetimepicker').dispatchEvent(event);
                $("#datetimepicker").val(date_ver).trigger("change");
                getShift();
              
            } else {
              
  
                if(Object.keys(array_errors).length > 0){
                  
                  let message = '';
                  for (const index in array_errors) {
                    const value = array_errors[index];
                    message += value+`<br>`;
                  }

                  errorMsg(message);
                } 
  
            }
          
//            const elements_one = document.querySelectorAll('[style*="z-index: 6666"]');
//            const elements_two = document.querySelectorAll('[style*="z-index: 9999"]');
//            elements_one.forEach(element => {
//               element.style.zIndex = '1';
//            });
//           elements_two.forEach(element => {
//               element.style.zIndex = '2';
//            });
          
       }, 
        
        eventClick: function (info) {
         
//             console.log(info.el.parentNode);
            // Obtén el contenedor del evento
//             let eventContainer = info.el.parentNode;
//             let tooltipElement = eventContainer.querySelector('.tooltip-content');
//             let tooltips = document.querySelectorAll('.tooltip-content');
//             let html = "";
          
//             const elements = document.querySelectorAll('[style*="z-index: 9999"]');

//             elements.forEach(element => {
//               if (element !== eventContainer) {
//                   element.style.zIndex = '1';
//               }
//             });
          
//             const estilo = eventContainer.style;
//             let tippy_content = eventContainer.querySelector('.tippy-content');
          
//             const computedStyle = window.getComputedStyle(eventContainer);
//             const zIndex = computedStyle.getPropertyValue('z-index');

//             if(zIndex === '2'){
//                 eventContainer.style.zIndex = '6666';
//             } else if(zIndex === '1') {
//                 eventContainer.style.zIndex = '9999';
//             } else if(zIndex === '9999'){
//                eventContainer.style.zIndex = '2';
//             } else {
//                eventContainer.style.zIndex = '1';
//             }
   
        },
        
        eventDrop: function (info) {
          
              $.ajax({
                  url: "<?= base_url('admin/Appointment/update_event'); ?>",
                  method: "POST",
                  data: {
                      id_appointment: info.event.extendedProps.data.id_appointment,
                      start_date: new Date(info.event.startStr).toLocaleDateString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' }),
                      end_date: new Date(info.event.endStr).toLocaleDateString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' }),
                      start_time: new Date(info.event.startStr).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false}),
                      end_time: new Date(info.event.endStr).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false})
                  },
                  dataType: "json",
                  success: (result) => {
                    
                      console.log(result);
                      
                      if(result.state === 'success'){
                        console.log(result.state)
                      }
                    
                  },
                  error: (error) => {
                      console.log(error); 
                  }
              });

        },
        
        eventDidMount: function (info) {
          
             let trElement = info.el;

             if(info.view.type === 'dayGridMonth'){
               
                  const tooltip = tippy(trElement, {
                      content: `${info.event.extendedProps.options_html}`,
                      allowHTML: true,
                      trigger: 'click', // Mostrar el tooltip al hacer clic
                      interactive: true,
                  });

                  info.el.addEventListener('click', function () {
                      tooltip.show();
                  });
               
             } else if(info.view.type == 'timeGridWeek'){
               
                 let element = trElement.parentNode;
                 element.classList.add('custom_slots');
               
             } else if(info.view.type == 'listDay'){
               
                  let content = `<div class="d-flex justify-content-between" style="margin-left: 5px;">
                                       <div class="d-flex">
                                          <h5><strong>Tiempo:</strong> ${info.event.extendedProps.data.time} - ${info.event.extendedProps.data.time_finish} </h5>&nbsp;
                                          <h5><strong>Doctor:</strong> ${info.event.extendedProps.data.name} ${info.event.extendedProps.data.surname}</h5>&nbsp;&nbsp;
                                          <h5><strong>Estado:</strong> <small class="label ${info.event.extendedProps.status_color}" style="border-color: 1px solid white;">${info.event.extendedProps.data.appointment_status}</small></h5>
                                        </div>
                                        <div>
                                            ${info.event.extendedProps.options_html}
                                        </div>
                                   </div>`;
               
                  info.el.innerHTML = content;
               
             }
          
             array_doctor_daily.push(info.event.extendedProps.data.doctor);
             array_doctor_daily = [...new Set(array_doctor_daily)];
          
        },
        
        eventContent: function (info) {
          
          if (info.view.type === 'dayGridMonth') {
            
              return {
                  html: `${info.event.extendedProps.data.time} - ${info.event.extendedProps.data.time_finish}`
              };
            
          } else if(info.view.type === 'timeGridWeek') {
              return {
                html: `<div class="">
                           <div class="d-flex time-grid-custom">
                              <h5>${info.event.extendedProps.data.time} - ${info.event.extendedProps.data.time_finish} </h5>
                              <h5><strong>Doctor:</strong> ${info.event.extendedProps.data.name} ${info.event.extendedProps.data.surname}</h5>
                              <h5><strong>Estado:</strong> <small class="label ${info.event.extendedProps.status_color}">${info.event.extendedProps.data.appointment_status}</small></h5>
                            </div>
                            <div>
                                ${info.event.extendedProps.options_html}
                            </div>
                       </div>`
             };
            
          } else if(info.view.type === 'timeGridDay'){
              return {
                html: `<div class="d-flex justify-content-between" style="margin-left: 5px; flex-wrap: wrap;">
                           <div class="d-flex">
                              <h5><strong>Tiempo:</strong> ${info.event.extendedProps.data.time} - ${info.event.extendedProps.data.time_finish} </h5>&nbsp;
                              <h5><strong>Doctor:</strong> ${info.event.extendedProps.data.name} ${info.event.extendedProps.data.surname}</h5>&nbsp;&nbsp;
                              <h5><strong>Estado:</strong> <small class="label ${info.event.extendedProps.status_color}" style="border-color: 1px solid white;">${info.event.extendedProps.data.appointment_status}</small></h5>
                            </div>
                            <div>
                                ${info.event.extendedProps.options_html}
                            </div>
                       </div>`
              };       
          } else if(info.view.type === 'customView'){
              return {
                html: `<div class="">
                           <div class="d-flex time-grid-custom">
                              <h5>${info.event.extendedProps.data.time} - ${info.event.extendedProps.data.time_finish} </h5>
                              <h5><strong>Doctor:</strong> ${info.event.extendedProps.data.name} ${info.event.extendedProps.data.surname}</h5>
                              <h5><strong>Estado:</strong> <small class="label ${info.event.extendedProps.status_color}">${info.event.extendedProps.data.appointment_status}</small></h5>
                            </div>
                            <div>
                                ${info.event.extendedProps.options_html}
                            </div>
                       </div>`
             };
          }

        },
  
        eventMouseEnter: function (info) {
          
              if(info.view.type === 'dayGridMonth'){

                    const tooltip = tippy(info.el, {
                        content: `<div>
                                    <h5><strong>Inicio:</strong> ${info.event.extendedProps.data.time}</h5>
                                    <h5><strong>Final:</strong> ${info.event.extendedProps.data.time_finish} </h5>
                                    <h5><strong>Nombre doctor:</strong> ${info.event.extendedProps.data.name}</h5>
                                    <h5><strong>Apellido doctor:</strong> ${info.event.extendedProps.data.surname}</h5>
                                    <h5><strong>Estado: </strong> <small class="label ${info.event.extendedProps.status_color}">${info.event.extendedProps.data.appointment_status}</small></h5>
                                  </div>`,

                        allowHTML: true,
  //                       placement: 'rigth',
                        offset: [10, 10]
                  });

                  tooltip.show();
              } else if(info.view.type === 'timeGridDay'){
                 info.el.parentNode.classList.add('hover-event');
              } else if(info.view.type === 'timeGridWeek'){
                
                   info.el.parentNode.classList.add('hover-event-week');
                
                   let eventContainer = info.el.parentNode;
                   const elements_one = document.querySelectorAll('[style*="z-index: 6666"]');
                   const elements_two = document.querySelectorAll('[style*="z-index: 9999"]');
                   const computedStyle = window.getComputedStyle(eventContainer);
                   const zIndex = computedStyle.getPropertyValue('z-index');

                   elements_one.forEach(element => {
                      element.style.zIndex = '1';
                   });
                  elements_two.forEach(element => {
                      element.style.zIndex = '2';
                   });

                  if(zIndex === '2'){
                      eventContainer.style.zIndex = '6666';
                  } else if(zIndex === '1') {
                      eventContainer.style.zIndex = '9999';
                  } else if(zIndex === '9999'){
                     eventContainer.style.zIndex = '2';
                  } else {
                     eventContainer.style.zIndex = '1';
                  }       
           }

        },
        
        eventMouseLeave: function (info) {
          
           info.el.parentNode.classList.remove('hover-event-week');
          
//            let hover_event = document.querySelectorAll('.hover-event');
           info.el.parentNode.classList.remove('hover-event');

//            if(hover_event){
//                hover_event.forEach(element => {
//                  element.classList.remove('hover-event');
//                });
//            }

           if(info.view.type == 'timeGridWeek'){
            
                   const elements_one = document.querySelectorAll('[style*="z-index: 6666"]');
                   const elements_two = document.querySelectorAll('[style*="z-index: 9999"]');
                   elements_one.forEach(element => {
                      element.style.zIndex = '1';
                   });
                  elements_two.forEach(element => {
                      element.style.zIndex = '2';
                   });
           }

          if(info.view.type == 'dayGridMonth'){
                const tooltip = info.el.parentNode;
          }
       },
    });

    calendar.render();
      
      
      function custom_view_resouces(){
        
//            console.log('entro a custom_view_resouces');
//            console.log(calendar.view.type);
//            console.log(array_doctor_daily.length);
        
//           console.log(calendar.view.type);
//           let custom_resource = calendarEl.querySelectorAll('.custom_resource');
        
        
          
        let custom_resource = calendarEl.querySelector('#custom_resource');
        let doctor_information = <?php echo json_encode($doctors) ?>;
        let fc_timegrid_cols = calendarEl.querySelector('.fc-timegrid-cols tr[role="row"]');
        let grid_cells = fc_timegrid_cols.querySelectorAll('td[role="gridcell"].custom_resource');
        let grid_cell = fc_timegrid_cols.querySelector('td[role="gridcell"]');

        let thead_element = calendarEl.querySelector("thead[role='presentation']");
        let column_header = thead_element.querySelector("th[role='columnheader']");
        
         if (custom_resource && grid_cells.length > 0) {
            console.log('remove elements');
            grid_cells.forEach(function (cell) {
                cell.remove();
            });

            custom_resource.remove();
         }
        
          console.log(custom_resource);
          console.log(grid_cells);

         let colspan = thead_element.querySelector('th[colspan]');
        
         if(colspan){
             colspan.removeAttribute('colspan');
         }
        
        var currentDate = calendar.getDate(); 
//                 var currentStart = calendar.view.currentStart;
        let events_date = new Date(currentDate).toLocaleDateString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' });

        console.log('Fecha actual en la página del calendario:', events_date);

        let allEvents = calendar.getEvents();
        let eventsForDate = allEvents.filter(function(event) {
          return new Date(event.startStr).toLocaleDateString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' }) === events_date;
        });

        let doctors_events = [];

        eventsForDate.forEach(function(index, i) {
          doctors_events.push(index.extendedProps.data.doctor);
        });

        doctors_events = [...new Set(doctors_events)];
           
        console.log(doctors_events);

         if(calendar.view.type === 'customView' && doctors_events.length > 0){
            
                console.log('entro a customView');
                console.log(custom_resource);
                console.log(grid_cells.length);

//                 console.log(grid_cell);
//                 console.log(grid_cell.getAttribute('data-date'));
//                 console.log(grid_cell.classList.contains('fc-today'));

//                 console.log('Fecha de inicio de la vista actual:', currentStart);
            
//                grid_cell.remove();

//                console.log(array_doctor_daily);
//                console.log(custom_resource);
//                console.log(grid_cells.length);

//                if(custom_resource === null && grid_cells.length === 0){
                 
                    console.log('se añadio el html');
                    column_header.setAttribute('colspan', doctors_events.length);

                    let resources = document.createElement('tr');
                    resources.setAttribute('role', 'row');
                    resources.setAttribute('id', 'custom_resource');

                    resources.innerHTML = `<th aria-hidden="true" class="fc-timegrid-axis">
                                                <div class="fc-timegrid-axis-frame"></div>
                                            </th>`;
                 
                    thead_element.insertAdjacentElement('beforeend', resources);

                    for (let i = 0; i < doctors_events.length; i++) {
                      
                         const matchingDoctor = doctor_information.find(item => item.id === doctors_events[i]);
                         const doctorName = matchingDoctor ? matchingDoctor.name : '';
                      
                         let column_resource = `<td role="gridcell" data-resource-id="${doctors_events[i]}" data-date="${grid_cell.getAttribute('data-date')}" class="fc-day fc-day-thu fc-day-future fc-timegrid-col custom_resource ${grid_cell.classList.contains('fc-today') ? 'fc-today' : ''} ${grid_cell.classList.contains('fc-holiday') ? 'fc-holiday' : ''}">
                                                   <div class="fc-timegrid-col-frame">
                                                      <div class="fc-timegrid-col-bg"></div>
                                                      <div class="fc-timegrid-col-events"></div>
                                                      <div class="fc-timegrid-now-indicator-container"></div>
                                                      <div class="fc-timegrid-col-misc"></div>
                                                   </div>
                                                </td>`;
                      
                        let newTH = `<th role="columnheader" colspan="1" data-resource-id="${doctors_events[i]}" data-date="${grid_cell.getAttribute('data-date')}" class="fc-col-header-cell fc-resource ${grid_cell.classList.contains('fc-today') ? 'fc-today' : ''} ${grid_cell.classList.contains('fc-holiday') ? 'fc-holiday' : ''}">
                                          <div class="fc-scrollgrid-sync-inner">
                                              <span class="fc-col-header-cell-cushion">${doctorName}</span>
                                          </div>
                                      </th>`;

                          resources.insertAdjacentHTML('beforeend', newTH);
                          fc_timegrid_cols.insertAdjacentHTML('beforeend', column_resource);
                    }

//                 } else {
//                      if(custom_resource != null && grid_cells.length > 0){
//                           console.log('remove custom');
//                           grid_cells.forEach(function(cell){
//                                cell.remove();
//                           });
//                           custom_resource.remove();
//                      }
//                 }
         } else {
             doctors_events = [];
         }
      }
      
      function getEventsForDate(date) {
          let allEvents = calendar.getEvents();
          let eventsForDate = allEvents.filter(function(event) {
            return event.start.toDate().toDateString() === date.toDateString();
          });
          return eventsForDate;
      }

      function refetch_events(){
          let doctor_id = document.getElementById('doctor_id').value;

          calendar.getEvents().forEach(event => {
            event.remove();
          });

          calendar.getEventSources().forEach(function(source) {
              source.remove();
          });

          calendar.refetchEvents();
          calendar.addEventSource(base_url+"admin/appointment/appointment_calendar/"+doctor_id);
           var selectedDate = document.getElementById('dateInput').value;

            // Navigate to the selected date
            if (selectedDate) {
              var date = new Date(selectedDate + 'T00:00:00');
              calendar.gotoDate(date);
            }
        
      }
      window.refetch_events = refetch_events;

        // Formulario agregar citas.
       $("#formadd").on('submit', (function (e) {

          var did = $("#doctorid").val();
          $("#doctorinputid").val(did); 
  //         console.log(did);
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
  //               console.log(data.status);
                if (data.status == "fail" ){
                    var message = "";
                    $.each(data.error, function (index, value) {
                        message += value+`<br>`;
                    });
                    errorMsg(message);
                } else {
                    successMsg(data.message);
                    table.ajax.reload();
                    $('#myModal').modal('hide');
                }
                refetch_events();
                $("#formaddbtn").button('reset');
            },
              error: function () {
            }
        });
      }));
      
     $("#doctor_id").on("change", function (e) {
       
          let doctor_id = document.getElementById('doctor_id').value;

          if(doctor_id != ''){
              refetch_events();
              update_hidden_days(doctor_id);
//               update_block_days(doctor_id);
          } else {
              calendar.setOption('hiddenDays', null);
              calendar.setOption('businessHours', null);
              calendar.setOption('slotLaneClassNames', null);
          }

          enviar_fecha();
//           vigencia_check(doctor_id);
      });
      
      
//       function update_block_days(doctor_id){
//         console.log(doctor_id);
//         $.ajax({
//              url: "<?= base_url("admin/appointment/update_block_days") ?>",
//               method: "POST",
//               data: {
//                 id_doctor: doctor_id
//               },
//               dataType: "json",
//               success:(resp)=> {
//                 console.log(resp);
//               },
//               error: function() {
//                    console.error("No es posible completar la operación");

//               }

//         });
//       }
      
      function vigencia_check(doctor_id){
        
        var myJSON = JSON.stringify({"doctor_id":doctor_id});
        $.ajax({
            url: "<?= base_url("admin/appointment/vigencia_check") ?>",
            type: 'POST',
            data: {
                id_doctor: doctor_id
            },
            success:(resp)=> {
              resp = JSON.parse(resp);
              console.log(resp.vigencia[0].start_date);
              console.log(resp.vigencia[0].end_date);
              let currentDate = new Date();
              let start_date = new Date(resp.vigencia[0].start_date);
              let end_date = new Date(resp.vigencia[0].end_date);
              console.log(start_date);
              console.log(end_date);
              console.log(currentDate);
              if (currentDate >= start_date && currentDate <= end_date) {
                console.log('The current date is within the range.');
//                 holdModal('vigencia_Modal');
              } else {
                holdModal('vigencia_Modal');
              }
            },
            error: function() {
                 console.error("No es posible completar la operación");
            }
        });  
        
      }
      
      window.addEventListener("load", function (event) {
        let user_role_id_2 = "<?= $user_role_id ?>";
          if(user_role_id_2 == 3){

              let id_doctor = "<?= $doctor_select ?>";
              update_hidden_days(id_doctor);

          }
        });
      
      
      function update_hidden_days(doctor_id){

              $.ajax({
                  url: "<?= base_url("admin/appointment/hidden_days") ?>",
                  method: "POST",
                  data: {
                    id_doctor: doctor_id
                  },
                  dataType: "json",
                  success: function(r) { 
                       let result = r.doctor_days;
                       let array_days = [];
                    
                        $.each(result, function (i, obj)
                        {                  
                           var diaDeLaSemana = obj;
                            switch (diaDeLaSemana) {
                              case "Sunday":
                                array_days.push(0);
                                console.log("Hoy es do.");
                                break;
                              case "Monday":
                                array_days.push(1);
                                console.log("Hoy es luns.");
                                break;
                              case "Tuesday":
                                array_days.push(2);
                                console.log("Hoy es mart.");
                                break;
                              case "Wenesday":
                                array_days.push(3);
                                console.log("Es fin de mierc.");
                                break;
                              case "Thursday":
                                array_days.push(4);
                                console.log("Hoy es jueves.");
                                break;
                              case "Friday":
                                array_days.push(5);
                                console.log("Hoy es viernes.");
                                break;
                              case "Saturday":
                                array_days.push(6);
                                console.log("Hoy es sabado.");
                                break;
                            }
                        });
                    
                      var sortedArray = array_days.slice().sort(function(a, b) {
                          return a - b;
                      });
                    
                       let doctor_slots = [];
                       let day_doctor = '';

                       for(let property of r.doctor_slots){
                           day_doctor = property.DAY === 'Sunday' ? 0 : property.DAY === 'Monday' ? 1 : property.DAY === 'Tuesday' ? 2
                                        : property.DAY === 'Wednesday' ? 3 : property.DAY === 'Thursday' ? 4
                                        : property.DAY === 'Friday' ? 5 : property.DAY === 'Saturday' ? 6 : '';
                           if(day_doctor !== ''){
                                doctor_slots.push({
                                  daysOfWeek: [day_doctor],
                                  startTime: property.start_time.split(':').slice(0, 2).join(':'),
                                  endTime: property.end_time.split(':').slice(0, 2).join(':')
                                }); 
                            } 
                       }

                      calendar.setOption('hiddenDays', sortedArray);
                      calendar.setOption('businessHours', doctor_slots);

                  },
                  error: function (error) {
                      console.log(error); 
                  }
              });

      }
      

      // Formulario resgendamiendo de citas
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
  
  $("#rescheduleform").on('submit', function (e) {

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
               if(edit_status == "Cancelada"){
                 $('#rescheduleModal').modal('hide');
                 var message = "la cita fue cancelada";
                 errorMsg(message);
                 table.ajax.reload();
               }else if(edit_status == "Aprobada"){
                  $('#rescheduleModal').modal('hide');
                  var message = "la cita fue cancelada";
                  errorMsg(message);
                 
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
            
            refetch_events();

            $("#rescheduleformbtn").button('reset');
//           
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
  });
      
     $("#rescheduleModal").on('hidden.bs.modal', function (e) {
          var appointment = $("#edit_appointment_id").val();
       

          $.ajax({
              url: baseurl+'admin/appointment/getpatient_id',
              type: "GET",
              data: {appointment_id: appointment},
              dataType: 'json',
              success: function (data) {
                console.log(data);

                refetch_events();

              }
         });
       
         reset_all();
         $('.patient_list_ajax').val(null).trigger('change');
    });   
  });
     

</script>



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
  
   function refetch_events_cal(){
     refetch_events();
   }
  
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
    if(modalId == "myModal"){
        var doctor_id_2 = document.getElementById('doctor_id').value;

         if(doctor_id_2 !=""){
          console.log(doctor_id_2);
          doctor_id_2  = parseInt(doctor_id_2);
//               document.getElementById('doctorid').value = doctor_id_2;
           $("#doctorid").val(doctor_id_2).trigger("change");
           
         }
     }
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
// $(document).ready(function (e) {
// });
  
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

          $("#rdoctor_select").val(data.doctor).trigger("change");
          $("#edit_responsible").val(data.responsible).trigger("change");

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


    function viewDetail(id) {
      $('#viewModal').modal('show');
      $.ajax({
        url: baseurl+'admin/appointment/getDetailsAppointment',
        type: "GET",
        data: {appointment_id: id},
        dataType: 'json',
        success: function (data) {
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
          $("#source").html(data.responsible);
          $("#doctor_shift_view").html(data.time+"-"+data.time_finish);
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
    $('#table_patient_visits').css('display', 'none');
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
      if(appointment_status == 'Aprobada'){
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
  
  function payments(category){
    
    console.log(category);
  }
  
  function openNewWindow() {
            // The URL you want to open in the new window/tab
            

            // Open a new window/tab
//             window.open(url, '_blank');
            
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
      var global_shift = 8;
      console.log(date);
      console.log(global_shift);
      console.log(doctor);
      
    
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
                }else if(i.specialist_doc == 'Anestesiologia') {
                      div_data += '<option value="Consulta preanestésica">Consulta urología</option>';
                      div_data += '<option value="Control urología">Control urología</option>';
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
  function reset_all(){
      $("#slot1").html("");
      $("#slot").empty();
      $("#datetimepicker").val("");
      $("#global_shift").select2("val", "");
//       $("#doctor_id").val("");
      $("#edit_slot").html("");
      $("#rslot_edit").empty();
      $("#dates").val("");
      $("#rglobal_shift_edit").select2("val", "");
      $("#message_reason").val("");
    
      $("#list_input_slot").html("");
      $("#edit_input_slot").html("");
    }
  
  function setSlot(id){

        if($("#slot_"+id).data("filled") === "filled"){
            alert("<?php echo $this->lang->line('not_available'); ?>");
        }else{

             // agrega los inputs que seleccione con su id y lo remueve cuando deseleciona.

              let inputHtml = `<input type="hidden" name="add_slot[]" value="${id}">`;
              $('#list_input_slot').append(inputHtml);
          
              const addSlots = document.querySelectorAll('input[name="add_slot[]"]');
              const uniqueValues = new Set();
          
              addSlots.forEach(function(input) {
                  const value = input.value;
                  if (!uniqueValues.has(value)) {
                         uniqueValues.add(value);
                         console.log('entro al aqui');
                  } else {
                      $('input[name="add_slot[]"][value="' + input.value + '"]').remove();
                  }
              });

              let editInputHtml = `<input type="hidden" name="edit_slot[]" value="${id}">`;
              $('#edit_input_slot').append(editInputHtml);
          
              const editSlot = document.querySelectorAll('input[name="edit_slot[]"]');
              const uniqueSlots = new Set();
          
              editSlot.forEach(function(input) {
                const value = input.value;
                if (!uniqueSlots.has(value)) {
                  uniqueSlots.add(value);
                } else {
                  $('input[name="edit_slot[]"][value="' + input.value + '"]').remove();
                  input.remove();
                }
              });


               if($("#slot_"+id).hasClass('badge-success-soft')){
                      $("#slot_"+id).removeClass("badge-success-soft");
                      $("#slot_"+id).addClass("badge-warning-soft");
               }else if($("#slot_"+id).hasClass('badge-danger-soft')){
                 $("#slot_"+id).removeClass("badge-danger-soft");
                      $("#slot_"+id).addClass("badge-warning-soft");
               }else if($("#slot_"+id).hasClass('badge-warning-soft')){
                 $("#slot_"+id).removeClass("badge-warning-soft");
                      $("#slot_"+id).addClass("badge-success-soft");
               }else{
                    $("#slot_"+id).removeClass("propios_slot");
                    $("#slot_"+id).addClass("badge-warning-soft");   
//                     $(".bg-primary").addClass("badge-success-soft");
  //                   $(".bg-primary").removeClass(".bg-primary");

//                     $("#slot_"+id).addClass("badge-success-soft");
//                     $("#slot_"+id).removeClass(".bg-primary");  
               }
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
  
  function enviar_fecha(type=null){
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
   function cups_structure() {

          let search_cups = document.getElementById("search_cups").value.toUpperCase();
          let cups_result = document.getElementById("cups_result");


          $.ajax({
            url: `https://www.datos.gov.co/resource/9zcz-bjue.json?$where=codigoprocedimiento%20like%20'%25${search_cups}%25'%20OR%20descripcion%20like%20'%25${search_cups}%25'%20OR%20codigocups%20like%20'%25${search_cups}%25'&$limit=100&$offset=0`,
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
                cups_list += `<li class="list-group-item list-hover" onclick="addCups({ codigo:'${property.codigocups}',
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
  

  function print_visit_bill(opd_id){

  //      var $this = $(this);
      console.log(opd_id);

       $.ajax({
          url: base_url+'admin/patient/print_opd_clini',
          type: "POST",
          data: {opd_id: opd_id},
          dataType: 'json',
          beforeSend: function() {
  //           $this.button('loading');
          },
          success: function (data) {
            console.log(data);
            popup(data.page);
          },
          error: function(xhr) { // if error occured
              alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
//             $this.button('reset');
          },
          complete: function() {
//                     $this.button('reset');
          }
       });
  }

 
//   document.getElementById('doctorid').addEventListener('change', function(event) {
//     console.log('El valor seleccionado cambió a: ', event.target.value);
//   });
  
</script>

<script>

$( document ).ready(function() {
    
    $("td").click(function(){
        var doctor = $( this ).attr("doctor")
        var hora = $( this ).attr("hora")

        alert(doctor + " - "+ hora);
    });

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

<script type="text/javascript">
  
  
  function agenda_clinicas(){
      $.ajax({
        url: base_url+'admin/appointment/agendas_clinicas',
        type: "POST",
        data: {opd_id: opd_id},
        dataType: 'json',
        beforeSend: function() {
        //           $this.button('loading');
        },
        success: function (data) {
          console.log(data);
         
        },
        error: function(xhr) { // if error occured
          alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
        //             $this.button('reset');
        },
        complete: function() {
        //                     $this.button('reset');
        }
      });
  }

</script>


