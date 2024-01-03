<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
    .header {
      position: fixed;
      top: -2;
   }
  
  .header_clini{
         display: flex;
         align-items: center;
         justify-content: center;
         margin-bottom:10px; 
         border-radius:10px;
         background-color: rgba(255, 255, 255, 0.5);
         background-image: url(<?php echo base_url('uploads/own_cliniverso/imgs/barracolor.png') ?>);
         background-size: cover;

      }

      .header_clini h3{
        margin:0;
      }
    
    
    
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    
  </div>
</nav>
  
<div class="container-fluid text-center" style="background-image: url(<?php echo base_url('uploads/own_cliniverso/imgs/histo_fondo.png') ?>);">    
  <div class="row content" style="background-image: url(<?php echo base_url('uploads/own_cliniverso/imgs/histo_fondo.png') ?>);">
    <?php if (!empty($print_details[0]['print_header'])) { ?>
      <div class="pprinta4" style="margin-bottom:20px;">
        <p class="header" style=" display: inline;margin-left:10px;">
         <i> Paciente: <?php echo $result['patient_name'];?> <?php echo $result['guardian_name'];?></i>  
        </p>

        <img src="<?php if (!empty($print_details[0]['print_header'])) {  echo base_url() . $print_details[0]['print_header'].img_time(); } ?>" class="img-responsive border-radius:10px;" style=" margin-top:20px; height:100px; width: 100%;position:relative;z-index: 1;">
      </div>
      <?php } ?>
    
    <div class="col-sm-12 text-left"> 
       <div class="col-md-12">
            <div class="col-md-12" style="width: -webkit-fill-available;display:flex; margin:0px 0px 5px 0px; gap:9px;">
                <div class="col-lg-6 col-md-6 col-sm-6  mt-4 mb-4" style="padding:10px;border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                    <p>
                        <strong><?php echo $this->lang->line("opd_id"); ?></strong>: 
                        <?php echo $opd_prefix.$result["opd_details_id"];?> 
                    </p>
                    <p>
                        <strong><?php echo $this->lang->line("checkup_id") ; ?></strong> : 
                        <?php echo $checkup_prefix.$result["id"] ?>
                    </p>
                    <p>
                        <strong><?php echo $this->lang->line("appointment_date") ; ?> </strong>: 
                        <?php echo $result["mydate"]; ?>
                    </p>
                    <p>
                        <strong><?php echo $this->lang->line('consultant_doctor'); ?> </strong>:
                        <?php echo $result["name"] . " " . $result["surname"].' ('. $result["employee_id"] .')' ?>
                    </p>
                    <p class="">
                        <div >
                          <strong>Motivo de Consulta </strong>:
                        </div>
                        <?php echo $result["reason_consultation"]; ?>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6  mt-4 mb-4" style="padding:10px; border-radius:15px; border: 1px solid #9b9898; margin-bottom:10px;">
                          <div class="col-12 m-2">
                              <p style=" display: inline;">
                                  <strong><?php echo $this->lang->line('patient_name'); ?>:</strong>
                              </p>
                              <p style=" display: inline;">
                                  <?php echo $result['patient_name'];?> <?php echo $result['guardian_name'];?>
                              </p>
                          </div>
                          <div class="col-12 m-2">
                            <p style=" display: inline;">
                                <strong><?php echo $this->lang->line("identification_number"); ?>:</strong>
                            </p>

                            <p style=" display: inline; font-size:;10px">
                                <?php echo $result["identification_number"] ?>
                            </p>
                        </div>
                        <div class="col-6 m-2">
                            <p style=" display: inline;">
                                <strong><?php echo $this->lang->line("gender"); ?></strong>
                            </p>
                            <p style=" display: inline;">
                                <?php echo $result["gender"] ?>
                            </p>
                        </div>
                        <div class="col-6 m-2">
                            <p style=" display: inline;"><strong><?php echo $this->lang->line('marital_status'); ?></strong></p>
                            <p style=" display: inline;"><?php echo $result['marital_status'] ?></p>
                        </div>
                          <div class="col-12 m-2">
                              <p style=" display: inline;">
                                  <strong><?php echo $this->lang->line("birth_date"); ?>:</strong>
                              </p>
                              <p style=" display: inline;">
                                  <?php echo $result["dob"]; ?>
                              </p>
                          </div>
                          <div class="col-12 m-2">
                              <p style=" display: inline;">
                                  <strong><?php echo $this->lang->line("age"); ?>:</strong>
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
                                  <strong>Acudiente:</strong>
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
                                  <strong>EPS:</strong>
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
    </div>
    <div class="col-sm-2 sidenav">
        <div class="well">
          <div class="col-md-12" style="width: -webkit-fill-available; margin-bottom:5px;padding:10px;">
            <div class="header_clini col-md-12 mb-2 img-responsive" style="">
              <h3 class="text-center"><strong class="" style="font-size:20px;color:#fff;"> Motivo de Consulta</strong></h3>
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
        </div>
          <div class="well">
          <div class="col-md-12" style="width: -webkit-fill-available; margin-bottom:5px;padding:10px;">
            <div class="header_clini col-md-12 mb-2 img-responsive" style="">
              <h3 class="text-center"><strong class="" style="font-size:20px;color:#fff;"> Motivo de Consulta</strong></h3>
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
        </div>
            viewport<div class="well">
          <div class="col-md-12" style="width: -webkit-fill-available; margin-bottom:5px;padding:10px;">
            <div class="header_clini col-md-12 mb-2 img-responsive" style="">
              <h3 class="text-center"><strong class="" style="font-size:20px;color:#fff;"> Motivo de Consulta</strong></h3>
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
                          ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
                        </h4>
                        <h4>
                          ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
                        </h4>
                        <h4>
                          ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
                        </h4>
                        <h4>
                          ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
                        </h4>
                        <h4>
                          ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
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
        </div>
            <div class="well">
          <div class="col-md-12" style="width: -webkit-fill-available; margin-bottom:5px;padding:10px;">
            <div class="header_clini col-md-12 mb-2 img-responsive" style="">
              <h3 class="text-center"><strong class="" style="font-size:20px;color:#fff;"> Motivo de Consulta</strong></h3>
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
                          <?php echo $value->field_value ?><?php echo $value->field_value ?>
                           <?php echo $value->field_value ?><?php echo $value->field_value ?>
                           <?php echo $value->field_value ?><?php echo $value->field_value ?>
                           <?php echo $value->field_value ?><?php echo $value->field_value ?>
                           <?php echo $value->field_value ?><?php echo $value->field_value ?>
                           <?php echo $value->field_value ?><?php echo $value->field_value ?>
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
        </div>
      <div class="well">
        <div class="col-md-12" style="width: -webkit-fill-available;margin-bottom:10px;padding:10px;|">
                          
          <div class="header_clini col-md-12 mb-2 img-responsive" >
                <div class="row">
                    <h3 class="text-center"><strong style="color:#fff; font-size:20px;"> Enfermedad actual</strong></h3>
                </div>
           </div>  
              <?php if (isset($fields) && !empty($fields)) : ?>
                <?php foreach($fields as $key=>$value): ?>
                    <?php if($value->custom_field_id == 58){ ?>
                      <div class="col-md-12" style="height:120px;"><p style="display: inline;"> <?php echo $value->field_value ?> </p></div>   
                    <?php  } ?>
                <?php endforeach ?>
              <?php else : ?>
                    <p class="text-center">No hay datos disponibles.</p>
              <?php endif ?>
          </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
