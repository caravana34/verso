<style>
  .btn{
    background:#1563B0; 
    color:#fff;
    border-radius: 5px;
  }
  
  .btn:hover{
            color: #d4d5db;
            background:#3387d6;
/*             border-left-color: #fff; */
          }


</style>



<?php
$genderList = $this->customlib->getGender_Patient();
$marital_status = $this->config->item('marital_status');
$bloodgroup = $this->config->item('bloodgroup');
$ocupations = $this->config->item('ocupations');
?>
<div class="modal fade" id="myModalpa" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header" style=" background:linear-gradient(#b7b5b3, #7c7b7a);">
                <button type="button" class="close" data-dismiss="modal" style="color:#1563B0;" >&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_patient'); ?></h4> 
            </div>
            <form id="formaddpa" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post"> 
                <div class="scroll-area">
                    <div class="modal-body pt0 pb0">
                        <div class="ptt10">
                            <div class="row row-eq">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="d-flex row">
                                            <div  class="col-lg-4 col-md-4 col-sm-4">
                                            </div>
<!--                                           <input type="hidden" id="custom_fields[patient][4]" name="custom_fields[patient][4]" value="">
                                          <input type="hidden" id="custom_fields[patient][5]" name="custom_fields[patient][5]" value=""> -->
                                            <div  class="col-lg-4 col-md-4 col-sm-4">
                                                <div style="background-color:#1563b0; margin-bottom:15px;border-radius:8px;padding: 6px;" class="border border-primary">
                                                    <h4 class="modal-title text-center" style="color:#fff;margin: 0px;">Información Personal <i class="fa fa-user"></i></h4>
                                                </div>
                                            </div>
                                            <div  class="col-lg-4 col-md-4 col-sm-4">
                                            </div>
                                        </div>
                                      <div class="row" style="border: solid #373838 1px;margin: 5px;border-radius: 13px;padding: 7px;">
                                        <div class="row" style="margin-right: 5px; margin-left: 5px;">
                                          <div class="col-lg-4 col-md-4 col-sm-4">
                                              <div class="form-group">
                                              <label><?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-user" style="color:#1563B0;"></i></span>
                                                    <input id="name" name="name" style="border-radius: 0px 10px 10px 0px !important;" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                                 </div>
                                            </div>
                                          </div>
                                          <div class="col-lg-4 col-md-4 col-sm-4">
                                              <div class="form-group">
                                                    <label><?php echo $this->lang->line('last_name') ?></label>
                                                    <div class="input-group">
                                                      <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-user" style="color:#1563B0;"></i></span> 
                                                      <input type="text" name="guardian_name" id="" style="border-radius: 0px 10px 10px 0px !important;" placeholder="" value="<?php echo set_value('guardian_name'); ?>" class="form-control">
                                                    </div>
                                                </div>
                                          </div>
                                          <div class="col-lg-4 col-md-4 col-sm-4">
                                              <div class="form-group">
                                                  <label for="exampleInputFile">
                                                      <?php echo $this->lang->line('patient_photo'); ?>
                                                  </label>
                                                  <div>
                                                    <input class="filestyle form-control" type='file' name='file' id="file" size='20' data-height="26" />
                                                  </div>
                                                  <span class="text-danger"><?php echo form_error('file'); ?></span>
                                              </div>
                                          </div>
                                        </div>
                                        <div class="col-lg-4 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label for="validity"><?php echo $this->lang->line("tpa_validity"); ?></label> 
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-id-card" style="color:#1563B0;"></i></span> 
                                                  <select class="form-control" name="validity" id="addformgender" style="border-radius: 0px 10px 10px 0px !important;">
                                                      <option value="CC: Cédula de ciudadanía">CC: Cédula de ciudadanía</option>
                                                      <option value="CE: Cédula de extranjería">CE: Cédula de extranjería</option>
                                                      <option value="CD: Carné Diplomático">CD: Carné Diplomático</option>
                                                      <option value="PA: Pasaporte">PA: Pasaporte</option>
                                                      <option value="SC: Salvoconducto de permanencia">SC: Salvoconducto de permanencia</option>
                                                      <option value="PT: Permiso temporal de permanencia">PT: Permiso temporal de permanencia</option>
                                                      <option value="PE: Permiso especial de permanencia">PE: Permiso especial de permanencia</option>
                                                      <option value="RC: Registro civil">RC: Registro civil</option>
                                                      <option value="TI: Tarjeta de identidad">TI: Tarjeta de identidad</option>
                                                      <option value="CN: Certificado de nacido vivo">CN: Certificado de nacido vivo</option>
                                                      <option value="AS: Adulto sin identificar">AS: Adulto sin identificar</option>
                                                      <option value="MS: Menor sin identificar">MS: Menor sin identificar</option>
                                                      <option value="DE: Documento extranjero">DE: Documento extranjero</option>
                                                      <option value="SI: Sin identificación">SI: Sin identificación</option>
                                                  </select>
                                                 </div> 
                                            </div> 
                                        </div>
                                        <div class="col-lg-4 col-md-3 col-sm-3">
                                            
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("national_identification_number"); ?></label>
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-hashtag" style="color:#1563B0;"></i></span> 
                                                  <input name="identification_number" id="edit_identification_number" style="border-radius: 0px 10px 10px 0px !important;" placeholder="Número de identificación" class="form-control" value="" />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-md-4 col-sm-12">  
                                            <div class="row">  
                                                <div class="col-sm-12">
                                                    
                                                    <div class="form-group">
                                                        <label> <?php echo $this->lang->line('gender'); ?></label>
                                                        <div class="input-group">
                                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-venus-mars" style="color:#1563B0;"></i></span> 
                                                          <select class="form-control" name="gender" id="addformgender" style="border-radius: 0px 10px 10px 0px !important;" >
                                                              <option value="" selected hidden><?php echo $this->lang->line('select'); ?></option>
                                                              <option value="Hombre">Hombre</option>
                                                              <option value="Mujer">Mujer</option>
                                                              <option value="Indeterminado">Indeterminado</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>  
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                              <!--   Custom Field, identity_gender     -> address                             -->
                                              <label for="address"><?php echo $this->lang->line('identity_gender'); ?></label>
                                              <div class="input-group">
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-genderless" style="color:#1563B0;"></i></span> 
                                                <select name="address"  class="form-control"  style="border-radius: 0px 10px 10px 0px !important;">
                                                    <option value="" selected hidden><?php echo $this->lang->line('select'); ?></option>
                                                    <option value="01: Masculino">Masculino</option>
                                                    <option value="02: Femenino">Femenino</option>
                                                    <option value="03: Transgénero">Transgénero</option>
                                                    <option value="04: Neutro">Neutro</option>
                                                    <option value="05: No lo declara">No lo declara</option>
                                                </select>
                                              </div> 
                                          </div> 
                                        </div>
                                        <div class="col-md-8 col-sm-12">  
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="form-group">
                                                        <!--                        Custom Field, ethnic identity                                  -->
                                                        <label for="pwd"><?php echo $this->lang->line('ethnic_identity'); ?></label>
                                                        <div class="input-group">
                                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-users" style="color:#1563B0;"></i></span> 
                                                          <select name="contact" id="" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                                              <option value="" selected hidden><?php echo $this->lang->line('select'); ?></option>
                                                              <option value="01: Indígena">Indígena</option>
                                                              <option value="02: ROM(Gitanos)">ROM(Gitanos)</option>
                                                              <option value="03: Raizal (San Andrés y Providencia)">Raizal (San Andrés y Providencia)</option>
                                                              <option value="04: Palenquero de San Basilio de Palenque">Palenquero de San Basilio de Palenque</option>
                                                              <option value="05: Negro(a)">Negro(a)</option>
                                                              <option value="06: Afrocolombiano(a)">Afrocolombiano(a)</option>
                                                              <option value="99: Ninguna de las anteriores">Ninguna de las anteriores</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                              </div>
                                              <div class="col-sm-6">
                                                <div class="form-group">
                                                <label><?php echo $this->lang->line('email'); ?></label>
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-envelope" style="color:#1563B0;"></i></span> 
                                                  <input type="text" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" id="addformemail" value="<?php echo set_value('email'); ?>" name="email" class="form-control">
                                                  <span class="text-danger"><?php echo form_error('email'); ?></span>
                                                </div>
                                            </div>
                                              </div> 
                                              
                                            </div>  
                                        </div>
                                        <!--./col-md-6-->  
                                       
<!--                                         <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                               <label for="pwd"><?php echo $this->lang->line('marital_status'); ?></label>
                                               <div class="input-group">
                                               <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-ring"></i></span>
                                                <select name="marital_status" id="" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php foreach ($marital_status as $mkey => $mvalue) {
                                                        ?>
                                                        <option value="<?php echo $mvalue; ?>" <?php if (set_value('marital_status') == $mkey) echo "selected"; ?>><?php echo $mvalue; ?></option>
                                                    <?php } ?>
                                                </select>
                                              </div>
                                             </div>
                                        </div> -->
                                        <div class="col-md-12 col-sm-12"> 
                                            <div class="row"> 
<!--                                                 <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label><?php echo $this->lang->line('blood_group'); ?></label>
                                                        
                                                        <select class="form-control" name="blood_group">
                                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                            <?php foreach ($bloodgroup as $bgkey => $bgvalue) {
                                                                ?>
                                                                <option value="<?php echo $bgvalue ?>" <?php echo set_select('blood_group', $bgvalue, set_value('blood_group')); ?>><?php echo $bgvalue ?></option>           

                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                </div> -->
                                              <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                   <label for="pwd"><?php echo $this->lang->line('marital_status'); ?></label>
                                                   <div class="input-group">
                                                   <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-ring" style="color:#1563B0;"></i></span>
                                                    <select name="marital_status" id="" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                                        <?php foreach ($marital_status as $mkey => $mvalue) {
                                                            ?>
                                                            <option value="<?php echo $mvalue; ?>" <?php if (set_value('marital_status') == $mkey) echo "selected"; ?>><?php echo $mvalue; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                  </div>
                                                 </div>
                                            </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="dob"><?php echo $this->lang->line('date_of_birth'); ?></label> 
                                                        <div class="input-group">
                                                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-calendar" style="color:#1563B0;"></i></span>
                                                               <input type="text" name="dob"  id="birth_date" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" class="form-control date patient_dob" /><?php echo set_value('dob'); ?>
                                                          </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4" id="calculate">
                                                    <div class="form-group">
                                                        <label><?php echo $this->lang->line('age').' ('.$this->lang->line('yy_mm_dd').')'; ?> </label><small class="req"> *</small> 
                                                        <div style="clear: both;overflow: hidden;">
                                                            <input type="text" placeholder="<?php echo $this->lang->line('year'); ?>" name="age[year]" id="age_year" value="" class="form-control patient_age_year" style="width: 31%; float: left;">

                                                            <input type="text" id="age_month" placeholder="<?php echo $this->lang->line('month'); ?>" name="age[month]" value="" class="form-control patient_age_month" style="width: 31%;float: left; margin-left: 4px;">
                                                            <input type="text" id="age_day" placeholder="<?php echo $this->lang->line('day'); ?>" name="age[day]" value="" class="form-control patient_age_day" style="width: 31%;float: left; margin-left: 4px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div><!--./col-md-6--> 
                                        
                                        
                                        
                                        
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('scholarship'); ?></label>
                                                <div class="input-group">
                                                     <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-graduation-cap" style="color:#1563B0;"></i></span>
                                                    <input type="text" placeholder="" name="note" id="note" class="form-control" style="border-radius: 0px 10px 10px 0px !important;" value="<?php echo set_value('note'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="insurance_id"><?php echo $this->lang->line("profession"); ?></label>
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-university" style="color:#1563B0;"></i></span>
                                                  <input type="text" name="insurance_id" id="" placeholder="" class="form-control" style="border-radius: 0px 10px 10px 0px !important;" value="<?php echo set_value('insurance_id'); ?>">
                                               </div> 
                                            </div> 
                                        </div>
                                        <div class="col-sm-4">
                                          
                                            <div class="form-group">
                                                <label for="email"><?php echo $this->lang->line('ocupation'); ?></label>
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-briefcase"></i></span>
                                                  <select name="known_allergies" id="" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                                      <option value=""><?php echo $this->lang->line('select') ?></option>
                                                      <?php foreach ($ocupations as $okey => $ovalue) {
                                                          ?>
                                                          <option value="<?php echo $ovalue; ?>" <?php if (set_value('ocupations') == $okey) echo "selected"; ?>><?php echo $ovalue; ?></option>
                                                      <?php } ?>
                                                  </select>
                                                </div> 
                                            </div>
                                            
                                        </div> 
                                      </div>
                                        <div class="">
                                            
                                            <?php
                                            echo display_custom_fields('patient', 0);
                                            ?>
                                            
                                        </div>  
                                    </div><!--./row--> 
                                </div><!--./col-md-8--> 
                            </div><!--./row--> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="submit" id="formaddpabtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn pull-right" ><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                    </div>
                </div>
            </form> 
        
        </div>
    </div>    
</div>
<script type="text/javascript">

  $(document).ready(function (e) {
    departamentos();
  });
  function removeDuplicates(array) {
      const uniqueArray = [];
      const map = new Map();

      for (const item of array) {
        const key = item.departamento;
        if (!map.has(key)) {
          map.set(key, true);
          uniqueArray.push(item);
        }
      }

      return uniqueArray;
  }
  
</script>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#formaddpa").on('submit', (function (e) {
        let clicked_submit_btn= $(this).closest('form').find(':submit');
            
            document.getElementById('custom_fields[patient][5]').value = $("#municipio").val();
            document.getElementById('custom_fields[patient][4]').value = $("#departamento").val();
            
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/addpatient',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                 beforeSend: function() {
                 clicked_submit_btn.button('loading') ; 

                },
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        $("#myModalpa").modal('toggle');
                        $('.ajaxlist').DataTable().ajax.reload();
                        addappointmentModal(data.id, 'myModal');
                    }
                        clicked_submit_btn.button('reset'); 
                },
                 error: function(xhr) { // if error occured
        alert('<?php echo $this->lang->line("error_occurred_please_try_again"); ?>');

         clicked_submit_btn.button('reset') ; 
             },
    complete: function() {
     clicked_submit_btn.button('reset') ; 
    }
            });
        }));
    });

    function addappointmentModal(patient_id = '', modalid) {
      
        var div_data = '';
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getpatientDetails/add',
            type: "POST",
            data: {id:patient_id},
            dataType: 'json',
            success: function (data) {
                var option = new Option(data.patient_name+" ("+data.id+")", data.id, true, true);
                $(".patient_list_ajax").append(option).trigger('change');

                $("#" + modalid).modal('show');
                holdModal(modalid);
            }
        })
    }

</script>
<script type="text/javascript">
       $(".patient_dob").on('changeDate', function(event, date) {
          
           var birth_date = $(".patient_dob").val();
           
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/getpatientage',
                type: "POST",
                dataType: "json",
                data: {birth_date:birth_date},
                success: function (data) {
                  $('.patient_age_year').val(data.year); 
                  $('.patient_age_month').val(data.month);
                  $('.patient_age_day').val(data.day);
                }
           });
});
</script> 
<script>
   function departamentos(){
     $( "#departamento_edit" ).parent().parent().css( "display", "none" );
     $( "#municipio_edit" ).parent().parent().css( "display", "none" );
    $.ajax({
        url : `https://www.datos.gov.co/resource/xdk5-pm3f.json?$select=departamento&$group=departamento`,
        type : 'GET',
        dataType : 'json',
        data: {
          "$$app_token" : "SRFsensloxdn0TDPB95X5rzpN"
        },
        success : (resp) => {
          var opt_departamento ="";
          var deparment = removeDuplicates(resp);
          var deparment = deparment.sort();
          opt_departamento += "<option value='' hidden>Departamento</option>";
          deparment.forEach(function(element) {
             opt_departamento +=`<option value='${element.departamento}'>${element.departamento}</option>`;
          });
          document.getElementById("departamento").innerHTML=opt_departamento;
          document.getElementById("municipio").innerHTML= "<option value='' hidden>Municipios</option>";
        }   
      });
        
  }
  
  
  function send_department(type){
    
    if(type == 'add'){
      var departamento = document.getElementById("departamento").value;
      $( "#municipio" ).html('');
      console.log(departamento);
    }else{
      $( "#municipio_edit" ).val('');
     
      var departamento = document.getElementById("departamento_edit").value;
    }
    $.ajax({
        url : `https://www.datos.gov.co/resource/xdk5-pm3f.json?$select=municipio&departamento=${departamento}&$order=municipio ASC`,
        type : 'GET',
        dataType : 'json',
        data: {
          "$$app_token" : "SRFsensloxdn0TDPB95X5rzpN"
        },
        success : (resp) => {
          
          console.log(resp);
          var municipalities = "";
          municipalities += "<option value='' hidden>Municipios</option>";
          resp.forEach(function(element) {
             municipalities += `<option value='${element.municipio}'>${element.municipio}</option>`;
          });
          if(type == 'add'){
              document.getElementById("municipio").innerHTML=municipalities;
          }else{
            document.getElementById("municipio_edit").innerHTML=municipalities;
          }
          
        }   
      });
  }
  
  function enter_ubication(type){
      if(type == 'add'){
        var departamento = document.getElementById('departamento').value;
        var municipio = document.getElementById('municipio').value;
        console.log(municipio);
        document.getElementById('custom_fields[patient][4]').value = departamento;
        document.getElementById('custom_fields[patient][5]').value = municipio;
      }else{
        var departamento = document.getElementById('departamento_edit').value;
        var municipio = document.getElementById('municipio_edit').value;
        document.getElementById('custom_fields[patient][5]').value = municipio;
        document.getElementById('custom_fields[patient][4]').value = departamento;
      }
  }


</script>