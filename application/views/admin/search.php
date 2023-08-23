<style>
  .btn{
    background:#1563B0; 
    
    border-radius: 5px;
  }
  
  .btn:hover{
      color: #1563b0;
      background:#3387d6;
      border-left-color: #fff;
    }
  
  .a:hover{
      color: #000 !important;
    }
  
  .modal-header h4 {
        color: #fff !important;

    }
  
/*       .table.dataTable tbody tr {
        background-color: #187502;
    }
  
  
    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #9C0A3B;
    }
  
    .table.dataTable tbody tr:hover {
        background-color: #69AB1D;
    } */
</style>

<?php
  $currency_symbol = $this->customlib->getHospitalCurrencyFormat();
  $genderList = $this->customlib->getGender();
  $marital_status = $this->config->item('marital_status');
  $bloodgroup = $this->config->item('bloodgroup');
?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="search_text" id="search_text" value="<?php echo $search_text; ?>">
                <div class="box box-info">
                    <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"><?php echo form_error('Opd'); ?> 
                                <?php
                                echo $this->lang->line('patient_list');
                                ?>
                            </h3>    
                       
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('patient', 'can_add')) { ?>
<!--                                 <a data-toggle="modal" onclick="holdModal('editModal2')" id="addp" class="btn  btn-sm newpatient" style="background:#1563B0; color:#fff;border-radius: 5px;"><i class="fa fa-plus"></i>  <?php echo $this->lang->line('add_new_patient'); ?></a>  -->
                                <?php
                            }
                            if ($this->rbac->hasPrivilege('patient_import', 'can_view')) {
                                ?>
                                <a data-toggle="" href="<?php echo base_url() ?>admin/patient/import" id="addp" class="btn  btn-sm" style="background:#1563B0; color:#fff;border-radius: 5px;"><i class="fa fa-upload"></i>  <?php echo $this->lang->line('import_patient'); ?></a> 
                            <?php } 
                            if ($this->rbac->hasPrivilege('enabled_disabled', 'can_view')) {
                                ?>
<!--                             <a  href="<?php echo base_url() ?>admin/admin/disablepatient" class="btn btn-sm" style="background:#1563B0; color:#fff;border-radius: 5px;"><i class="fa fa-reorder"></i> <?php echo $this->lang->line('disabled_patient_list'); ?></a> -->
                            <?php } ?> 
                           <?php if ($this->rbac->hasPrivilege('patient', 'can_add')): ?>
                                <a data-toggle="modal" id="add" onclick="holdModal('myModalpa')" class="btn btn-sm newpatient" style="background:#1563B0; color:#fff;border-radius: 5px;"><i class="fa fa-plus"></i>  <?php echo $this->lang->line('add_new_patient'); ?></a> 
                           <?php endif ?>
                        </div>     
                    </div>
                    <div class="box-body">                      
                        <div class="">
                              <?php if ($this->rbac->hasPrivilege('patient', 'can_delete')) {
                                ?>
                            <button type="submit" class="btn pull-right btn-sm mt10 delete_selected" style="background:#1563B0; color:#fff;border-radius: 5px;" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> "><i class="fa fa-trash"></i>  <?php echo $this->lang->line('delete_selected');?></button>
                        <?php } ?>
                        </div> 
                         
                        <table class="table table-striped table-bordered table-hover ajaxlist" data-export-title="<?= $this->lang->line('patient_list'); ?>" >
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkAll"> #</th>     
                                    <th><?php echo $this->lang->line('patient_name'); ?></th>
                                    <th><?php echo $this->lang->line('age'); ?></th>
                                    <th><?php echo $this->lang->line('gender'); ?></th>
                                    <th>Documento</th>
                                    <th>EPS</th>
                                    <th><?php echo $this->lang->line('guardian_name'); ?></th>
                                    <th>Teléfono</th>
                                    <th><?php echo $this->lang->line('dead'); ?></th>
                                    <?php if (!empty($fields)) {
                                        foreach ($fields as $fields_key => $fields_value) {
                                         ?>
                                        <th><?php echo ucfirst($fields_value->name); ?></th>
                                    <?php } } ?> 
                                    <th class="noExport"><?php echo $this->lang->line('action'); ?></th>                      
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>                       
                    <!-- </form> -->
                    </div>
                </div>
            </div>  
        </div> 
    </section>
</div>


<div class="modal fade" id="editModal2"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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

                                                <div style="background-color: #1563b0; margin-bottom:15px;border-radius:8px;padding: 6px;" class="border border-primary">
                                                    <h4 class="modal-title text-center" style="color:#fff;margin:0px;">Información Personal <i class="fa fa-user"></i></h4>
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
                                         <?php if($user['role_id'] != 8): ?>
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
                                          <?php endif ?>
                                        <div class="col-md-6 col-sm-12"> 
                                            <div class="row"> 
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="dob"><?php echo $this->lang->line('date_of_birth'); ?></label> 
<!--                                                         <input type="text" name="dob" id="epatient_dob" placeholder="<?php echo set_value('dob'); ?>"  class="form-control date patient_dob" /> -->
                                                          <div class="input-group">
                                                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-calendar"></i></span>
                                                               <input type="text" name="dob"  placeholder="<?php echo set_value('dob'); ?>" style="border-radius: 0px 10px 10px 0px !important;" class="form-control date editpatient_dob" /><?php echo set_value('dob'); ?>
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
                                                <label for="email"><?php echo $this->lang->line('ocupation'); ?></label>
                                                <div class="input-group">
                                                     <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-briefcase"></i></span>
                                                     <input type="text" name="known_allergies" id="eknown_allergies" placeholder="" class="form-control" style="border-radius: 0px 10px 10px 0px !important;" value="<?php echo set_value('known_allergies'); ?>">
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
                                        </div>  
                                        <div class="" id="customfield2">
                                           
                                        </div> 
                                    
                            </div><!--./row-->    
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
<?php $this->load->view('admin/patient/patientaddmodal') ?>

<!-- //========datatable start===== -->
<script type="text/javascript">
    (function ($) {
        'use strict';
        $(document).ready(function(){
            var search_text=$('#search_text').val();
            initDatatable('ajaxlist','admin/admin/getpatientdatatable',{'search_text':search_text},[],100,[{"bSortable": false, "aTargets": [0,8] }]);
        })
    }(jQuery))
   
</script>
<!-- //========datatable end===== -->
<script type="text/javascript">   
    function showdate(value) {
        if (value == 'period') {
            $('#fromdate').show();
            $('#todate').show();
        } else {
            $('#fromdate').hide();
            $('#todate').hide();
        }
    }

    function holdModal(modalId) {
        
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function getpatientData(id) {
        $('#modal_head').html("<?php echo $this->lang->line('patient_details'); ?>");
        $.ajax({
            url: baseurl+'admin/patient/getpatientDetails',
            type: "POST",
            data: {id: id},
            dataType: 'json',
            success: function (data) {

                if (data.is_active == 'yes') {
                    var link = "<?php if ($this->rbac->hasPrivilege('enabled_disabled', 'can_view')) { ?><a href='#' data-toggle='tooltip' title='<?php echo $this->lang->line('disable'); ?>' onclick='patient_deactive(" + id + ")' data-placement='bottom' data-original-title='<?php echo $this->lang->line('disable'); ?>'><i class='fa fa-thumbs-o-down'></i></a><?php } ?>";
                } else {
                    var link = "<?php if ($this->rbac->hasPrivilege('enabled_disabled', 'can_view')) { ?><a href='#' data-toggle='tooltip' title='<?php echo $this->lang->line('enable'); ?>' onclick='patient_active(" + id + ")' data-original-title='<?php echo $this->lang->line('enable'); ?>'><i class='fa fa-thumbs-o-up'></i></a> <?php } if ($this->rbac->hasPrivilege('patient', 'can_delete')) { ?><a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo $this->lang->line('delete'); ?>'><i class='fa fa-trash'></i></a> <?php } ?>";
                }
                
                var table_html = '';
                $.each(data.field_data, function (i, obj)
                {
                    if (obj.field_value == null) {
                        var field_value = "";
                    } else {
                        var field_value = obj.field_value;
                    }
                    var name = obj.name ;
                    table_html += "<p><b><span id='vcustom_name'>" + capitalizeFirstLetter(name) + "</span></b> <span id='vcustom_value'>" + field_value + "</span></p>";
                });

                $("#field_data").html(table_html);
                $("patientid").val(data.id);
                $("#patient_name").html(data.patient_name+" ("+data.id+")");
                $("#guardian").html(data.guardian_name);
                $("#patients_id").html(data.patient_unique_id);
                $("#genders").html(data.gender);
                $("#marital_status").html(data.marital_status);
                $("#contact").html(data.mobileno);
                $("#email").html(data.email);
                $("#address").html(data.address);
                $("#is_active").html(data.is_active);
                $('select[id="blood_groups"] option[value="' + data.blood_bank_product_id + '"]').attr("selected", "selected"); 
                $("#age").html(data.patient_age);
                $("#allergies").html(data.known_allergies);
                $("#insurance_id").html(data.insurance_id);
                $("#validity").html(data.insurance_validity);
                $("#identification_number").html(data.identification_number);
                $("#blood_group").html(data.blood_group_name);
                $("#note").html(data.note);
                $("#image").attr("src", '<?php echo base_url() ?>' + data.image+'<?php echo img_time(); ?>');
                $('#edit_delete').html("<?php if ($this->rbac->hasPrivilege('patient', 'can_edit')) { ?><a href='#' onclick='editRecord(" + id + ")' data-toggle='tooltip' data-placement='bottom' title='<?php echo $this->lang->line('edit'); ?>' data-target='' data-toggle='modal'   data-original-title='<?php echo $this->lang->line('edit'); ?>'><i class='fa fa-pencil'></i></a><?php } ?> " + link + "");                
                holdModal('myModal');
                patientvisit(id);
            },
        });
    }

    function patientvisit(id){
        $.ajax({
            url: baseurl+'admin/patient/patientvisit',
            type: "POST",
            data: {id: id},
            dataType: 'json',
            success: function (data) {
                $('#visit_report_id').html(data);
            }
        });
    }
  
//     function editRecord(id) {
//         $.ajax({
//             url: '<?php echo base_url(); ?>admin/patient/getpatientDetails',
//             type: "POST",
//             data: {id: id},
//             dataType: 'json',
//             success: function (data) { 
               
//                 $("#eupdateid").val(data.id);
//                 $('#customfield').html(data.custom_fields_value);
//                 $("#ename").val(data.patient_name);
//                 $("#eguardian_name").val(data.guardian_name);
//                 $("#emobileno").val(data.mobileno);
//                 $("#eemail").val(data.email);
//                 $("#eaddress").val(data.address);
//                 $("#age_year").val(data.age);
//                 $("#age_month").val(data.month);
//                 $("#age_day").val(data.day);
//                 $(".editpatient_dob").val(data.dob);
//                 $("#enote").val(data.note);
//                 $("#exampleInputFile").attr("data-default-file", '<?php echo base_url() ?>' + data.image);
//                 $(".dropify-render").find("img").attr("src", '<?php echo base_url() ?>' + data.image);
//                 $("#eknown_allergies").val(data.known_allergies);
//                 $('select[id="blood_groups"] option[value="' + data.blood_bank_product_id + '"]').attr("selected", "selected");
//                 $('select[id="egenders"] option[value="' + data.gender + '"]').attr("selected", "selected");
//                 $('select[id="marital_statuss"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
//                 $("#edit_insurance_id").val(data.insurance_id);
//                 $("#insurance_validity").val(data.insurance_validity);
//                 $("#edit_identification_number").val(data.identification_number);
//                 $("#blood_group").html(data.blood_group_name);
//                 $("#myModal").modal('hide');
//                 holdModal('editModal');

//             },
//         });
//     }

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
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                    $("#formeditpabtn").button('reset');
                },
                error: function () {
					
                }
            });
        }));
    });
    
    function delete_record(id) {
        if (confirm(<?php echo "'".$this->lang->line('patient_delete_alert_message')."'"; ?>)) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deletePatient',
                type: "POST",
                data: {delid: id},
                dataType: 'json',
                success: function (data) {
                    successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                    $("#myModal").modal("hide");
                    table.ajax.reload();
                }
            })
        }
    }

    function patient_deactive(id) {
        if (confirm(<?php echo "'" . $this->lang->line('are_you_sure_to_deactivate_account') . "'"; ?>)) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deactivePatient',
                type: "POST",
                data: {id: id},
                dataType: 'json',
                success: function (data) {
                    if (data.status == "fail") {
                        var message = (data.message);
                        errorMsg(message);
                    } else {
                        successMsg(<?php echo "'" . $this->lang->line('record_disable') . "'"; ?>);                    
                        window.getpatientData(id);
                    }                   
                }
            })
        }
    }

    function CalculateAgeInQCe(DOB, txtAge, Txndate) {
        if (DOB.value != '') {
            now = new Date(Txndate)
            var txtValue = DOB;
            if (txtValue != null)
                dob = txtValue.split('/');
            if (dob.length === 3) {
                born = new Date(dob[2], dob[1] * 1 - 1, dob[0]);
                if (now.getMonth() == born.getMonth() && now.getDate() == born.getDate()) {
                    age = now.getFullYear() - born.getFullYear();
                } else {
                    age = Math.floor((now.getTime() - born.getTime()) / (365.25 * 24 * 60 * 60 * 1000));
                }
                if (isNaN(age) || age < 0) {
                    
                } else {
                    if (now.getMonth() > born.getMonth()) {
                        var calmonth = now.getMonth() - born.getMonth();
                    } else {
                        var calmonth = born.getMonth() - now.getMonth();
                    }
                    $("#eage_year").val(age);
                    $("#eage_month").val(calmonth);
                    return age;
                }
            }
        }
    }   

    function patient_active(id) {       
        if (confirm(<?php echo "'" . $this->lang->line('are_you_sure_to_active_account') . "'"; ?>)) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/activePatient',
                type: "POST",
                data: {activeid: id},
                dataType: 'json',
                success: function (data) {                    
                    successMsg(<?php echo "'" . $this->lang->line('record_active') . "'"; ?>);                    
                    window.getpatientData(id);                    
                }
            })
        }
    }
 
    $(document).on('click','.delete_selected',function(){       
      var $this = $(this);   
       let obj =  [];       
       $('input:checkbox.enable_delete').each(function () {
       (this.checked ? obj.push($(this).val()) : "");
 });
if (confirm('<?php echo $this->lang->line('patient_delete_alert_message'); ?>')) {
      $.ajax({
          url: base_url+'admin/patient/bulk_delete',          
          type: "POST",
          dataType: 'json',
          data:{'delete_id':obj},
           beforeSend: function() {
            $this.button('loading');               
          },
          success: function(res) {     
          $this.button('reset');        
         if(res.status == 1){
            successMsg(res.msg);
            table.ajax.reload();
         }else{
                var message = "";
                $.each(res.error, function (index, value) {
                    message += value;
                });
                errorMsg(message);
         }
          },
          error: function(xhr) { // if error occured
             alert("<?php echo $this->lang->line('error_occured_please_try_again'); ?>");
             $this.button('reset');                
      },
      complete: function() {
            $this.button('reset');
              
      }
      });
  }
  }); 
</script>
<script type="text/javascript">  

$(".newpatient").click(function(){	
	$('#formaddpa').trigger("reset");
	$(".dropify-clear").trigger("click");
});	

$(".modalbtnpatient").click(function(){	
	$('#formaddpa').trigger("reset");
	$(".dropify-clear").trigger("click");
});

$("input[name='checkAll']").click(function () {
    $("input[name='patient[]']").not(this).prop('checked', this.checked);
});

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

    window.onload = function() {
      let showAlert = localStorage.getItem('showAlert');
      if (showAlert) {
        successMsg(showAlert);
        localStorage.removeItem('showAlert');
      }
    };

    function addappointmentModal(patient_id = '', modalid) {        
        var div_data = '';
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getpatientDetails',
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
  
   function departamentos(municipio,departamento){
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
          opt_departamento += "<option value='' hidden>"+departamento+"</option>";
          deparment.forEach(function(element) {
             opt_departamento +="<option value="+element.departamento+">"+element.departamento+"</option>";
          });
          document.getElementById("departamento").innerHTML=opt_departamento;
          document.getElementById("municipio").innerHTML= "<option value='' hidden>"+municipio+"</option>";
//                 $('select[id="municipio"] option[value="' + municipio + '"]').attr("selected", "selected");
//                 $('select[id="departamento"] option[value="' + departamento + '"]').attr("selected", "selected");
        }   
      });
                
  }
  
  
  
  
  function send_department(){
    var departamento = document.getElementById("departamento").value;
    
    $.ajax({
        url : `https://www.datos.gov.co/resource/xdk5-pm3f.json?departamento=${departamento}`,
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
            console.log(element.municipio);
             municipalities += `<option value="${element.municipio}">${element.municipio}</option>`;
          });
          
          document.getElementById("municipio").innerHTML=municipalities;
          
        }   
      });
  }
  
   
</script>
<script>
     $(document).on('click','.view_detail',function(){
         var id=$(this).data('recordId');
          var module_name = $(this).data('moduleType');          
         PatientPathologyDetails(id,$(this), module_name);
       });

        function PatientPathologyDetails(id,btn_obj,module_name){
         var modal_view=$('#viewDetailReportModal');
         var $this = btn_obj;   
        $.ajax({
            url: base_url+'admin/patient/getPatientPathologyDetails',
            type: "POST",
            data: {'id': id,'module_name':module_name},
            dataType: 'json',
            beforeSend: function() {
              $this.button('loading');
                modal_view.addClass('modal_loading');
                
               },
            success: function (data) {        
                        
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
<script>    
//     document.getElementById("headreport").style.display = "block";
//     document.getElementById("print").style.display = "block";
//     document.getElementById("btnExport").style.display = "block";
//     document.getElementById("printhead").style.display = "none";

//     function printDiv() {
//         document.getElementById("print").style.display = "none";
//         document.getElementById("btnExport").style.display = "none";
//         var divElements = document.getElementById('visit_report').innerHTML;
//         var oldPage = document.body.innerHTML;
//         document.body.innerHTML =
//             "<html><head><title>Patient Bill Report</title></head><body>" +
//             divElements + "</body>";
//         window.print();
//         document.body.innerHTML = oldPage;
//         location.reload(true);
//     }
  
 
</script>
<script>
    var array1 = new Array();
    var array2 = new Array();
    var array3 = new Array();
    var array4 = new Array();
    var array5 = new Array();
    var array6 = new Array();
    var array7 = new Array();
    var n = 7; //Total table
    for (var x = 1; x <= n; x++) {
        array1[x - 1] = x;
        array2[x - 1] = x + 'th';
    }

    var tablesToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets>',
            templateend = '</x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head>',
            body = '<body>',
            tablevar = '<table>{table',
            tablevarend = '}</table>',
            bodyend = '</body></html>',
            worksheet = '<x:ExcelWorksheet><x:Name>',
            worksheetend = '</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet>',
            worksheetvar = '{worksheet',
            worksheetvarend = '}',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            },
            wstemplate = '',
            tabletemplate = '';

        return function(table, name, filename) {
            var tables = table;
            for (var i = 0; i < tables.length; ++i) {
                wstemplate += worksheet + worksheetvar + i + worksheetvarend + worksheetend;
                tabletemplate += tablevar + i + tablevarend;
            }

            var allTemplate = template + wstemplate + templateend;
            var allWorksheet = body + tabletemplate + bodyend;
            var allOfIt = allTemplate + allWorksheet;
            var ctx = {};
            for (var j = 0; j < tables.length; ++j) {
                ctx['worksheet' + j] = name[j];
            }

            for (var k = 0; k < tables.length; ++k) {
                var exceltable;
                if (!tables[k].nodeType) exceltable = document.getElementById(tables[k]);
                ctx['table' + k] = exceltable.innerHTML;
            }

            window.location.href = uri + base64(format(allOfIt, ctx));
        }
    })();
  
  
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
                $("#age_year").val(data.age);
                $("#age_month").val(data.month);
                $("#age_day").val(data.day);
                $(".editpatient_dob").val(data.dob);
                $("#enote").val(data.note);
                $("#exampleInputFile").attr("data-default-file", '<?php echo base_url() ?>' + data.image);
                $(".dropify-render").find("img").attr("src", '<?php echo base_url() ?>' + data.image);
                $("#eknown_allergies").val(data.known_allergies);
                $('select[id="blood_groups"] option[value="' + data.blood_bank_product_id + '"]').attr("selected", "selected");
                
                $('select[id="egenders"] option[value="' + data.gender + '"]').attr("selected", "selected");
                $('select[id="marital_statuss"] option[value="' + data.marital_status + '"]').attr("selected", "selected");
                $("#edit_insurance_id").val(data.insurance_id);
                $("#insurance_validity").val(data.insurance_validity);
                $("#edit_identification_number").val(data.identification_number);
                $("#blood_group").html(data.blood_group_name);

                $("#myModal").modal('hide');
                let municipio = document.getElementById('custom_fields[patient][5]').value;
                let departamento = document.getElementById('custom_fields[patient][4]').value;
                departamentos(municipio,departamento);
                holdModal('editModal2');
//                 departamentos();


            },
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
                        successMsg(data.message);
                        $('#editModal2').modal('hide');
                        setTimeout(function() {
                                location.reload();
                              }, 900);
                      
                    }
                    $("#formeditpabtn").button('reset');
                },
                error: function () {
					
                }
            });
        }));
    });
 
  function enter_ubication(){
            var departamento = document.getElementById('departamento').value;
            var municipio = document.getElementById('municipio').value;
            console.log(municipio);
            document.getElementById('custom_fields[patient][4]').value = departamento;
            document.getElementById('custom_fields[patient][5]').value = municipio;
  }
 
</script>

