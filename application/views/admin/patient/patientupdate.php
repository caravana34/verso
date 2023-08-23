<?php
  $currency_symbol = $this->customlib->getHospitalCurrencyFormat();
  $genderList = $this->customlib->getGender();
  $marital_status = $this->config->item('marital_status');
  $bloodgroup = $this->config->item('bloodgroup');
  $ocupations = $this->config->item('ocupations');
?>
<div class="modal fade" id="editModal2"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal" style="color:#1563B0;">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('patient_details'); ?></h4> 
            </div><!--./modal-header-->             
            <form id="formeditpa" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                
                <div class="modal-body pt0 pb0">
                    <input id="eupdateid" name="updateid" placeholder="" type="hidden" class="form-control" value="" />
                                <div class="row">
                                        <div class="d-flex row">
                                            <div  class="col-lg-4 col-md-4 col-sm-4">
                                            </div>
                                            <div  class="col-lg-4 col-md-4 col-sm-4">
                                                <div style="background:#1563B0; margin-bottom:15px;border-radius:8px;padding: 6px;" class="border border-primary">
                                                    <h4 class="modal-title text-center" style="color:#fff; margin:0px;">Información Personal <i class="fa fa-user"></i></h4>
<!--                                                     <h6 class="card-subtitle text-muted text-center" style="margin-top: 0px;">Support card subtitle</h6> -->
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
                                                      <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-user"></i></span> 
                                                      <input id="ename" name="name" style="border-radius: 0px 10px 10px 0px !important;" placeholder="" type="text" class="form-control" value="<?php echo set_value('name'); ?>"  />
                                                      <span class="text-danger"><?php echo form_error('name'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('last_name') ?></label>
                                                    <div class="input-group">
                                                      <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-user"></i></span> 
                                                      <input type="text" name="guardian_name" id="eguardian_name" style="border-radius: 0px 10px 10px 0px !important;" placeholder="" value="<?php echo set_value('guardian_name'); ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">
                                                        <?php echo $this->lang->line('patient_photo'); ?>
                                                    </label>
                                                    <div>
                                                        <input class="filestyle form-control-file" type='file' name='file' id="exampleInputFile" size='20' data-height="26" data-default-file="<?php echo base_url() ?>uploads/patient_images/no_image.png" >
                                                    </div>
                                                    <span class="text-danger"><?php echo form_error('file'); ?></span>
                                                </div>
                                            </div>
                                         </div>   
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="form-group">
                                              <label for="validity"><?php echo $this->lang->line("tpa_validity"); ?></label>
                                              <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-id-card"></i></span> 
                                                  <select class="form-control" name="validity" id="insurance_validity" style="border-radius: 0px 10px 10px 0px !important;" >
                                                      <option value="" hidden><?php echo $this->lang->line('select'); ?></option>
                                                      <option value="CC: Cédula de ciudadanía" <?php if (set_value('validity') == "CC: Cédula de ciudadanía") echo "selected"; ?>>CC: Cédula de ciudadanía</option>
                                                      <option value="CE: Cédula de extranjería" <?php if (set_value('validity') == "CE: Cédula de extranjería") echo "selected"; ?>>CE: Cédula de extranjería</option>
                                                      <option value="CD: Carné Diplomático" <?php if (set_value('validity') == "CD: Carné Diplomático") echo "selected"; ?>>CD: Carné Diplomático</option>
                                                      <option value="PA: Pasaporte" <?php if (set_value('validity') == "PA: Pasaporte") echo "selected"; ?>>PA: Pasaporte</option>
                                                      <option value="SC: Salvoconducto de permanencia" <?php if (set_value('validity') == "SC: Salvoconducto de permanencia") echo "selected"; ?>>SC: Salvoconducto de permanencia</option>
                                                      <option value="PT: Permiso temporal de permanencia" <?php if (set_value('validity') == "PT: Permiso temporal de permanencia") echo "selected"; ?>>PT: Permiso temporal de permanencia</option>
                                                      <option value="PE: Permiso especial de permanencia" <?php if (set_value('validity') == "PE: Permiso especial de permanencia") echo "selected"; ?>>PE: Permiso especial de permanencia</option>
                                                      <option value="RC: Registro civil" <?php if (set_value('validity') == "RC: Registro civil") echo "selected"; ?>>RC: Registro civil</option>
                                                      <option value="TI: Tarjeta de identidad" <?php if (set_value('validity') == "TI: Tarjeta de identidad") echo "selected"; ?>>TI: Tarjeta de identidad</option>
                                                      <option value="CN: Certificado de nacido vivo" <?php if (set_value('validity') == "CN: Certificado de nacido vivo") echo "selected"; ?>>CN: Certificado de nacido vivo</option>
                                                      <option value="AS: Adulto sin identificar" <?php if (set_value('validity') == "AS: Adulto sin identificar") echo "selected"; ?>>AS: Adulto sin identificar</option>
                                                      <option value="MS: Menor sin identificar" <?php if (set_value('validity') == "MS: Menor sin identificar") echo "selected"; ?>>MS: Menor sin identificar</option>
                                                      <option value="DE: Documento extranjero" <?php if (set_value('validity') == "DE: Documento extranjero") echo "selected"; ?>>DE: Documento extranjero</option>
                                                      <option value="SI: Sin identificación" <?php if (set_value('validity') == "SI: Sin identificación") echo "selected"; ?>>SI: Sin identificación</option>
                                                  </select>
                                               </div> 
                                            </div> 
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("national_identification_number"); ?></label>
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-hashtag"></i></span> 
                                                  <input name="identification_number" id="edit_identification_number" style="border-radius: 0px 10px 10px 0px !important;" placeholder="<?php echo set_value('identification_number'); ?>" class="form-control" value="<?php echo set_value('identification_number'); ?>" />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 col-sm-12">  
                                            <div class="row">  
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label> <?php echo $this->lang->line('gender'); ?></label>
                                                        <div class="input-group">
                                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-venus-mars"></i></span> 
                                                          <select class="form-control" name="gender" id="egenders" style="border-radius: 0px 10px 10px 0px !important;" >
                                                              <option value="" hidden><?php echo $this->lang->line('select'); ?></option>
                                                              <option value="Hombre" <?php if (set_value('gender') == "Hombre") echo "selected"; ?>>Hombre</option>
                                                              <option value="Mujer" <?php if (set_value('gender') == "Mujer") echo "selected"; ?>>Mujer</option>
                                                              <option value="Indeterminado" <?php if (set_value('gender') == "Indeterminado") echo "selected"; ?>>Indeterminado</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <!--                        Custom Field, identity_gender     -> address                             -->
                                                        <label for="address"><?php echo $this->lang->line('identity_gender'); ?></label>
                                                        <div class="input-group">
                                                          <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-genderless"></i></span> 
                                                          <select name="address"  class="form-control" id="eaddress" style="border-radius: 0px 10px 10px 0px !important;">
                                                              <option value="" selected hidden><?php echo $this->lang->line('select'); ?></option>
                                                              <option value="01: Masculino" <?php if (set_value('address') == "01: Masculino") echo "selected"; ?>>Masculino</option>
                                                              <option value="02: Femenino" <?php if (set_value('address') == "02: Femenino") echo "selected"; ?>>Femenino</option>
                                                              <option value="03: Transgénero" <?php if (set_value('address') == "03: Transgénero") echo "selected"; ?>>Transgénero</option>
                                                              <option value="04: Neutro" <?php if (set_value('address') == "04: Neutro") echo "selected"; ?>>Neutro</option>
                                                              <option value="05: No lo declara" <?php if (set_value('address') == "05: No lo declara") echo "selected"; ?>>No lo declara</option>
                                                          </select>
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div>  
                                        </div>
                                        <!--./col-md-6--> 
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <!--                        Custom Field, ethnic identity                                  -->
                                                <label for="pwd"><?php echo $this->lang->line('ethnic_identity'); ?></label>
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-users"></i></span> 
                                                  <select name="contact" id="emobileno" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                                      <option value="" selected hidden><?php echo $this->lang->line('select'); ?></option>
                                                      <option value="01: Indígena" <?php if (set_value('mobileno') == "01: Indígena") echo "selected"; ?>>Indígena</option>
                                                      <option value="02: ROM(Gitanos)" <?php if (set_value('mobileno') == "02: ROM(Gitanos)") echo "selected"; ?>>ROM(Gitanos)</option>
                                                      <option value="03: Raizal (San Andrés y Providencia)" <?php if (set_value('mobileno') == "03: Raizal (San Andrés y Providencia)") echo "selected"; ?>>Raizal (San Andrés y Providencia)</option>
                                                      <option value="04: Palenquero de San Basilio de Palenque" <?php if (set_value('mobileno') == "04: Palenquero de San Basilio de Palenque") echo "selected"; ?>>Palenquero de San Basilio de Palenque</option>
                                                      <option value="05: Negro(a)" <?php if (set_value('mobileno') == "05: Negro(a)") echo "selected"; ?>>Negro(a)</option>
                                                      <option value="06: Afrocolombiano(a)" <?php if (set_value('mobileno') == "06: Afrocolombiano(a)") echo "selected"; ?>>Afrocolombiano(a)</option>
                                                      <option value="99: Ninguna de las anteriores" <?php if (set_value('mobileno') == "99: Ninguna de las anteriores") echo "selected"; ?>>Ninguna de las anteriores</option>
                                                  </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('email'); ?></label>
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-envelope"></i></span> 
                                                  <input type="text" placeholder="" style="border-radius: 0px 10px 10px 0px !important;" id="eemail" value="<?php echo set_value('email'); ?>" name="email" class="form-control">
                                                  <span class="text-danger"><?php echo form_error('email'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                               <label for="pwd"><?php echo $this->lang->line('marital_status'); ?></label>
                                               <div class="input-group">
                                               <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-ring"></i></span>
                                                <select name="marital_status" id="marital_statuss" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php foreach ($marital_status as $mkey => $mvalue) {
                                                        ?>
                                                        <option value="<?php echo $mvalue; ?>" <?php if (set_value('marital_status') == $mkey) echo "selected"; ?>><?php echo $mvalue; ?></option>
                                                    <?php } ?>
                                                </select>
                                              </div>
                                             </div>
                                        </div>
                                         <div class="col-sm-3">
                                              <div class="form-group">
                                                  <label><?php echo $this->lang->line('blood_group'); ?></label>
                                                  <div class="input-group">
                                                    <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-heart"></i></span>
                                                    <select class="form-control" id="blood_groups" name="blood_group" style="border-radius: 0px 10px 10px 0px !important;">
                                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                        <?php foreach ($bloodgroup as $bgkey => $bgvalue) {
                                                            ?>
                                                            <option value="<?php echo $bgkey ?>" <?php echo set_select('blood_group', $bgvalue, set_value('blood_group')); ?>><?php echo $bgvalue ?></option>           

                                                        <?php } ?>

                                                    </select>
                                                  </div>
                                              </div>
                                          </div>
                                        <div class="col-md-6 col-sm-12"> 
                                            <div class="row"> 
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="dob"><?php echo $this->lang->line('date_of_birth'); ?></label> 
<!--                                                         <input type="text" name="dob" id="epatient_dob" placeholder="<?php echo set_value('dob'); ?>"  class="form-control date patient_dob" /> -->
                                                          <div class="input-group">
                                                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-calendar"></i></span>
                                                               <input type="text" name="dob"  value="" placeholder="<?php echo set_value('dob'); ?>" style="border-radius: 0px 10px 10px 0px !important;" class="form-control date editpatient_dob" /><?php echo set_value('dob'); ?>
                                                          </div>
                                                     </div>
                                                </div>
                                                <div class="col-sm-6" id="calculate">
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
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo $this->lang->line('scholarship'); ?></label>
                                                <div class="input-group">
                                                     <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-graduation-cap"></i></span>
                                                    <input type="text" placeholder="" name="note" id="enote" class="form-control" style="border-radius: 0px 10px 10px 0px !important;" value="<?php echo set_value('note'); ?>">
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="insurance_id"><?php echo $this->lang->line("profession"); ?></label>
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-university"></i></span>
                                                  <input type="text" name="insurance_id" id="edit_insurance_id" placeholder="" class="form-control" style="border-radius: 0px 10px 10px 0px !important;" value="<?php echo set_value('insurance_id'); ?>">
                                               </div> 
                                            </div> 
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="email"><?php echo $this->lang->line('ocupation'); ?></label>
                                                <div class="input-group">
                                                  <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-briefcase"></i></span>
                                                  <select name="known_allergies" id="eknown_allergies" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
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
                                        <div class="" id="customfield2">
                                           
                                        </div> 
                                    
                            </div><!--./row-->    
                    </div>                 
                        <div class="modal-footer">
                            <div class="pull-right">
                                <button type="submit" id="formeditpabtn" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn "><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </div>
                    </form>
            
        </div>
    </div>    
</div>

<script>
  
  
      function editRecord2(id) {
        window.id_record = id;
        var idres = id;
        $('.output').html(idres);
        
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getpatientDetails/update',
            type: "POST",
            data: {id: id},
            dataType: 'json',
            success: function (data) { 
                console.log(data);
                $("#eupdateid").val(data.id);
                $('#customfield2').html(data.custom_fields_value);
                $("#ename").val(data.patient_name);
                $("#eguardian_name").val(data.guardian_name);
                $("#emobileno").val(data.mobileno);
                $("#eemail").val(data.email);
                $("#eaddress").val(data.address);       
                      $.ajax({
                          url: '<?php echo base_url(); ?>admin/patient/getpatientage',
                          type: "POST",
                          dataType: "json",
                          data: {birth_date:data.dob},
                          success: function (data) {
                            $("#age_year").val(data.year);
                            $("#age_month").val(data.month);
                            $("#age_day").val(data.day);
                          }
                     });

                $(".editpatient_dob").val(data.dob);
                $("#enote").val(data.note);
                $("#exampleInputFile").attr("data-default-file", '<?php echo base_url() ?>' + data.image);
                $(".dropify-render").find("img").attr("src", '<?php echo base_url() ?>' + data.image);

                  
                if(data.known_allergies == '' ){
                   $("#eknown_allergies").addClass('error-input');
                }else if(data.email==''){
                      $("#eemail").addClass('error-input');   
                 }
              
                $("#eknown_allergies").val(data.known_allergies);
                $('select[id="blood_groups"] option[value="' + data.blood_bank_product_id + '"]').attr("selected", "selected");
                
                $('select[id="egenders"] option[value="' + data.gender + '"]').attr("selected", "selected");
                $('select[id="marital_statuss"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                $("#edit_insurance_id").val(data.insurance_id);
                $("#insurance_validity").val(data.insurance_validity);
                $("#edit_identification_number").val(data.identification_number);
                $("#blood_group").html(data.blood_group_name);
                
                
                let municipio = document.getElementById('custom_fields[patient][5]').value;
                
                let departamento = document.getElementById('custom_fields[patient][4]').value;
                departamentos_2(municipio,departamento);
                holdModal('editModal2');
                $( "#municipio" ).parent().parent().css( "display", "none" );
                $( "#departamento" ).parent().parent().css( "display", "none" );
            },
        });
    }
    //edit desarrollo cliniverso
   $(".editpatient_dob").on('changeDate', function(event, date) {         
           var birth_date = $(".editpatient_dob").val();         
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
  
   function departamentos_2(municipio,departamento){
     console.log(municipio);
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
          opt_departamento += "<option value='' hidden>"+departamento+"</option>";
          deparment.forEach(function(element) {
             opt_departamento +=`<option value='${element.departamento}'>${element.departamento}</option>`;
          });
          document.getElementById("departamento_edit").innerHTML=opt_departamento;
          document.getElementById("municipio_edit").innerHTML= "<option value='' hidden>"+municipio+"</option>";
//                 $('select[id="municipio"] option[value="' + municipio + '"]').attr("selected", "selected");
//                 $('select[id="departamento"] option[value="' + departamento + '"]').attr("selected", "selected");
        }   
      });
                
  }
  
  
  
  

  
  $(document).ready(function (e) {
        $("#formeditpa").on('submit', (function (e) {
            $("#formeditpabtn").button('loading');
          
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/update',
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
//                         window.location.reload(true);
                        $('#editModal2').modal('hide');
                        successMsg(data.message);
//                         setTimeout(function() {
//                                 location.reload();
//                               }, 900);
                      
                    }
                    $("#formeditpabtn").button('reset');
                },
                error: function () {
					
                }
            });
        }));
    });
   
</script>
