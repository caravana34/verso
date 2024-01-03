<?php
    $currency_symbol = $this->customlib->getHospitalCurrencyFormat();
    $genderList = $this->customlib->getGender();
    $case_reference_id=$result['case_reference_id'];
    $categorylist = $this->operationtheatre_model->category_list();
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/multiselect/css/jquery.multiselect.css">
<script src="<?php echo base_url(); ?>backend/multiselect/js/jquery.multiselect.js"></script>


<!-- ---------------------myMedicationModal------------------------- -->
<div class="modal fade" id="myMedicationModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <?php if ($this->rbac->hasPrivilege('ipd_medication', 'can_add')) { ?>
                <h4 class="modal-title"><?php echo $this->lang->line("add_medication_dose"); ?></h4> 
                <?php } ?>
            </div>
        <form id="add_medicationdose" accept-charset="utf-8" method="post" class="ptt10">  
            <div class="scroll-area">
                <div class="modal-body pt0 pb0">
                    <div class="row">
                        <input type="hidden" name="ipdid" id="mipdid" value="<?php echo $ipdid ?>" >
                        <input type="hidden" name="medicine_name_id" id="mpharmacy_id" value="" >
                        <input type="hidden" name="date"  id="mdate" value="" >
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                                  <input type="text" name="date" id="add_dose_date" class="form-control date">
                                  <span class="text-danger"><?php echo form_error('date'); ?></span>
                                  <input type="hidden" name="ipdid" value="<?php echo $ipdid ?>">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="pwd"><?php echo $this->lang->line("time"); ?></label>
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
                                  <label><?php echo $this->lang->line("medicine_category"); ?></label> <small class="req"> *</small>
                                  <select class="form-control medicine_category_medication select2" style="width:100%" id="add_dose_medicine_category" name='medicine_category_id'>
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
                              <select class="form-control select2 medicine_name_medication" style="width:100%"  id="add_dose_medicine_id" name='medicine_name_id'>
                                      <option value=""><?php echo $this->lang->line('select'); ?>
                                          </option>
                                      </select>
                                  <span class="text-danger"><?php echo form_error('medicine_name_id'); ?></span>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label><?php echo $this->lang->line("dosage"); ?></label> <small class="req"> *</small>
                              <select class="form-control select2 dosage_medication" style="width:100%"  id="mdosage" onchange="" name='dosage'>
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
                    <button type="submit" id="add_medicationdosebtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                </div>  
          </form>  
        </div>
    </div> 
</div><!-- -END---myMedicationModal-- -->

<!-- ---------------------myaddMedicationModal------------------------- -->

<!-- <div class="modal fade" id="myaddMedicationModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line("add_medication_dose"); ?></h4> 
            </div>
            <form id="add_medication" accept-charset="utf-8" method="post" class="ptt10">    
                <div class="scroll-area">
                    <div class="modal-body pt0 pb0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="text-primary" style="font-size:15px;color:#1563B0;">Fase OperatorÍa<small class="req"> *</small> </label>
                                        <input type="hidden" id="">
                                        <select name="Fase_OperatorÍa" style="width: 100%" id="" class="form-control">
                                            <option value="">Admisión</option>
                                            <option value="">Transoperatorio</option>
                                            <option value="" >Postoperatorio</option>
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
        </div>
    </div> 
</div><!-- -END---myaddMedicationModal-- -->
<!-- -->
<!-- ---------------------myMedicationDoseModal------------------------ -->
<div class="modal fade" id="myMedicationDoseModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modalicon"> 
                    <div id='edit_delete'></div>
                </div>
                <h4 class="modal-title"><?php echo $this->lang->line('edit_medication_dose'); ?></h4> 
            </div>
                <form id="update_medication" accept-charset="utf-8" method="post" class="ptt10">
                    <div class="modal-body pt0 pb0">
                        <input type="hidden" name="medication_id" class="" id="medication_id" value="">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="text-primary" style="font-size:15px;color:#1563B0;">Fase Operatoría<small class="req"> *</small> </label>
                                    <input type="hidden" id="">
                                    <select name="FaseOperatoria_id" id="medicatioFaseOperatoria" style="width: 100%" class="form-control">
                                        <option value="Admision">Admisión</option>
                                        <option value="Transoperatorio">Transoperatorio</option>
                                        <option value="Postoperatorio">Postoperatorio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input type="text" name="date" id="date_edit_medication" class="form-control date">
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                        <input type="hidden" name="ipdid" value="<?php echo $ipdid ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line("time"); ?></label>
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
                                        <label><?php echo $this->lang->line("medicine_category"); ?></label> <small class="req"> *</small>
                                        <select class="form-control medicine_category_medication select2" style="width:100%" id="mmedicine_category_edit_id" name='medicine_category_id'>
                                            <option value="<?php echo set_value('medicine_category_id'); ?>"><?php echo $this->lang->line('select'); ?>
                                            </option>
                                                <?php foreach ($medicineCategory as $dkey => $dvalue) { ?>
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
                                    <select class="form-control select2 medicine_name_medication" style="width:100%"  id="mmedicine_edit_id" name='medicine_name_id'>
                                            <option value=""><?php echo $this->lang->line('select'); ?>
                                                </option>
                                            </select>
                                        <span class="text-danger"><?php echo form_error('medicine_name_id'); ?></span>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line("dosage"); ?></label> <small class="req"> *</small>
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
                                        <textarea  name="remark" id="medicine_dosage_remark" class="form-control"></textarea>
                                      
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
</div><!--END---myMedicationDoseModal-- -->


<script>
    
   $(function () {
        $(".timepicker").timepicker({defaultTime: '12:00 PM'});
    });
  
   function holdModal(modalId) {
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
  
   $(document).on('change','.medicine_category_medication',function(){

       var medicine_category=$(this).val();
        console.log(medicine_category);

      $('.medicine_name_medication').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");
         getMedicineForMedication(medicine_category,"");
         getMedicineDosageForMedication(medicine_category);
    });
  
  function get_dosagename(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/pharmacy/get_dosagename',
            type: "POST",
            data: {dosage_id: id},
            dataType: 'json',
            success: function (res) {
                if (res) {
                    $('#medicine_dosage_medication').val(res.dosage_unit);
                } else {

                }
            }
        });
    }
  
  
  function getMedicineDosageForMedication(medicine_category) {

              var div_data = "<option value=''>Select</option>";
              if(medicine_category != ""){
                $.ajax({
                  url: '<?php echo base_url();?>admin/pharmacy/get_medicine_dosage',
                  type: "POST",
                  data: {medicine_category_id: medicine_category},
                  dataType: 'json',
                  success: function (res) {

                      $.each(res, function (i, obj)
                      {
                          var sel = "";
                          div_data += "<option value='" + obj.id + "'>" + obj.dosage + " " + obj.unit + "</option>";

                      });
                      $('.dosage_medication').html(div_data);
                      $(".dosage_medication").select2("val", '');

                  }
              });
            }
          }


        function getMedicineForMedication(medicine_category,medicine_id) {
            var div_data = "<option value=''>Select</option>";
            if(medicine_category != ""){
                $.ajax({
                  url: '<?php echo base_url();?>admin/pharmacy/get_medicine_name',
                  type: "POST",
                  data: {medicine_category_id: medicine_category},
                  dataType: 'json',
                  success: function (res) {

                      $.each(res, function (i, obj)
                      {
                          var sel = "";
                          div_data += "<option value='" + obj.id + "'>" + obj.medicine_name + "</option>";

                      });
                      $('.medicine_name_medication').html(div_data);
                      $(".medicine_name_medication").select2("val", medicine_id);
                      $("#mmedicine_edit_id").val(medicine_id).trigger("change");
                  }
              });
            }
          }


</script>


<script>
  
  
  
    $("form.chgstatus_form").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           dataType:"JSON",
           success: function(data)
           {
               if (data.status == 0) {
                    var message = "";
                    $.each(data.error, function (index, value) {

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
  
  
  
   $(document).ready(function (e) {
        $("#nurse_note_form").on('submit', (function (e) {
            var nurse_id = $("#nurse_field").val();
            $("#nurse_set").val(nurse_id);
//             $("#nurse_notebtn").button('loading');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/add_nurse_note',
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
                    $("#nurse_notebtn").button('reset');

                },
                error: function () {
                   
                }
            });


        }));
    });
   
  
//   $(document).ready(function (e) {
//         $("#add_medicationdose").on('submit', (function (e) {
// //             $("#add_medicationdosebtn").button('loading');
//             e.preventDefault();
//             $.ajax({
//                 url: '<?php echo base_url();?>admin/patient/addmedicationdoseopd',
//                 type: "POST",
//                 data: new FormData(this),
//                 dataType: 'json',
//                 contentType: false,
//                 cache: false,
//                 processData: false,
//                  beforeSend: function(){
//                 $("#add_medicationdosebtn").button('loading');
//                  },
//                 success: function (data) {
//                     if (data.status == "fail") {
//                         var message = data.message;
//                         $.each(data.error, function (index, value) {
//                             message += value;
//                         });
//                         errorMsg(message);
//                     } else {
//                         var message = data.message;
//                         $('#myMedicationModal').modal('hide');
//                         $('.ajaxlist_med').load(location.href + ' .ajaxlist_med');
//                         successMsg(data.message);
//                     }
//                     $("#add_medicationdosebtn").button('reset');
//                 },
//                 error: function () {
//                  $("#add_medicationdosebtn").button('reset');
//                 },
  
//                 complete: function(){
//                 $("#add_medicationdosebtn").button('reset');
//                 }
//             });
//         }));
   
//     });
  
  window.onload = function() {
          var showAlert = localStorage.getItem('showAlert');
          if (showAlert) {
            successMsg(showAlert);
            localStorage.removeItem('showAlert');
          }
        };
  
//   $(document).ready(function (e) {
//         $("#add_medication").on('submit', (function (e) {
//             e.preventDefault();
//             $("#add_medicationbtn").button('loading');
//             $.ajax({
//                 url: '<?php echo base_url(); ?>admin/patient/addmedicationdoseopd',
//                 type: "POST",
//                 data: new FormData(this),
//                 dataType: 'json',
//                 contentType: false,
//                 cache: false,
//                 processData: false,
//                  beforeSend: function(){
//                 $("#add_medicationbtn").button('loading');
//                  },
//                 success: function (data) {
//                     if (data.status == "fail") {
//                         var message = data.message;
//                         $.each(data.error, function (index, value) {
//                             message += value;
//                         });
//                         errorMsg(message);
//                     } else {
//                         var message = data.message;
//                         $('#myMedicationModal').modal('hide');
//                         $('.ajaxlist_med').load(location.href + ' .ajaxlist_med');
//                         successMsg(data.message);
//                     }
//                     $("#add_medicationbtn").button('reset');
//                 },
//                 error: function () {
//                  $("#add_medicationbtn").button('reset');
//                 },
  
//                 complete: function(){
//                 $("#add_medicationbtn").button('reset');
//                 }
//             });
//         }));
//     });
  
  
//   function addmedicationModal() {
//           document.querySelector("#add_medication").reset();
//           $("#mmedicine_id").val("").trigger("change");
//           holdModal('myaddMedicationModal');
//         }


//         $('#myaddMedicationModal').on('hidden.bs.modal', function() {
//           $('#add_medication').find('input:text, input:password, input:file, textarea').val('');
//           $('#add_medication').find('select option:selected').removeAttr('selected');
//           $('#add_medication').find('input:checkbox, input:radio').removeAttr('checked');
//           $('.medicine_category_medication').val("").trigger("change");
//           $('.medicine_name_medication').val("").trigger("change");
//           $('.dosage_medication').val("").trigger("change");
//           $('#mtime').val('12:00 PM');
//         });
  
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
            data: {medication_id: medication_id},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $("#date_edit_medication").val(data.date);
//                 var reportType = resp.signos_vitales[0].report_type;
//                 $("#medicatioFaseOperatoria").val(data.reportType);
                $('select[id="medicatioFaseOperatoria"] option[value="' + data.report_type + '"]').attr("selected", "selected");
                $("#dosagetime").val(data.dosagetime);
                $('select[id="medicine_dose_id"] option[value="' + data.medicine_dosage_id + '"]').attr("selected", "selected");
                $("#medicine_dose_edit_id").select2().select2('val', data.medicine_dosage_id);
                $("#mmedicine_category_edit_id ").val(data.medicine_category_id).trigger('change');
                getMedicineForMedication(data.medicine_category_id,data.pharmacy_id);
                $("#medicine_dosage_remark").val(data.remark);
                $("#medication_id").val(data.id);
                <?php if ($this->rbac->hasPrivilege('ipd_medication', 'can_delete')) {  ?>
                $('#edit_delete').html("<a href='#' class='delete_record_dosage' data-record-id='"+ medication_id + "' data-toggle='tooltip' title='<?php echo $this->lang->line('delete'); ?>' data-target='' data-toggle='modal'  data-original-title='<?php echo $this->lang->line('delete'); ?>'><i class='fa fa-trash'></i></a>");
                <?php } ?>
                holdModal('myMedicationDoseModal');
            },
        });
    }
    
    //function delete_record_dosage(id) {
    $(document).on('click','.delete_record_dosage',function(){
        
        if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
            var id=$(this).data('recordId');
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deletemedicationdosage',
                type: "POST",
                data: {medication_id: id},
                dataType: 'json',
                success: function (data) {
                    successMsg(<?php echo "'" . $this->lang->line('delete_message') . "'"; ?>);
                    var message = data.message;
//                         $('#myMedicationModal').modal('hide');
                        $('.ajaxlist_med').load(location.href + ' .ajaxlist_med');
//                         successMsg(data.message);
                }
            })
        }
    });
    
    
         $(document).ready(function (e) {
        $("#update_medication").on('submit', (function (e) {
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
                 beforeSend: function(){
                $("#update_medicationbtn").button('loading');
                 },
                success: function (data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        var message = data.message;
                        $('#myMedicationDoseModal').modal('hide');
                        $('.ajaxlist_med').load(location.href + ' .ajaxlist_med');
                        successMsg(data.message);
                    }
                    $("#update_medicationbtn").button('reset');
                },
                error: function () {
                 $("#update_medicationbtn").button('reset');
                },
  
                complete: function(){
                $("#update_medicationbtn").button('reset');
                }
            });
        }));
    });
    
    
 </script>


<!-- var message = data.message;
$('#myaddMedicationModal').modal('hide');
$('.ajaxlist_med').load(location.href + ' .ajaxlist_med'); 
successMsg(data.message); -->

