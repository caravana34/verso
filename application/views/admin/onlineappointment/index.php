<link href="https://fonts.cdnfonts.com/css/nasalization-2" rel="stylesheet">
<script src="<?php echo base_url(); ?>backend/custom/jquery.validate.min.js"></script>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-2">
                <?php $this->load->view('admin/onlineappointment/appointmentSidebar');?> 
            </div>
            <div class="col-md-10">
                <?php if ($this->rbac->hasPrivilege('online_appointment_slot', 'can_view')) { ?>
                <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Apertura de agendas</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <form action="<?php echo site_url('admin/onlineappointment/') ?>" id="doctor_form" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('doctor'); ?><small class="req"> *</small></label>
                                            <select autofocus="" style="width: 100%" onchange="getDoctorShift()" id="doctor" name="doctor" class="select2" >
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php foreach ($doctors as $doctor) { ?>
                                                <option value="<?php echo $doctor['id'] ?>" <?php
                                                if (set_value('doctor') == $doctor['id']) {
                                                        echo "selected=selected";
                                                    }
                                                    ?>><?php echo $doctor['name'] . " " . $doctor['surname']; ?> (<?php echo $doctor['employee_id'] ?>)</option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('doctor'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3" style="display: none;">
                                          <div class="form-group">
                                              <label><?php echo $this->lang->line("shift"); ?><small class="req"> *</small></label>
                                              <select autofocus="" id="shift" name="shift" class="form-control" >
                                                  <option value=""><?php echo $this->lang->line('select'); ?></option>
                                              </select>
                                              <span class="text-danger"><?php echo form_error('shift'); ?></span>
                                          </div>
                                     </div>
                                    <div class="col-lg-3 col-md-3 mt-5">
                                        <label></label>
                                        <div class="form-group">
                                            <button type="button" onclick="search()" class="btn btn-primary btn-sm"><?php echo $this->lang->line('search'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                      
                            <hr/>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label><?php echo $this->lang->line("consultation_duration"); ?><small class="req"> *</small></label>
                                        <input type="number" name="consult_time" form="" value="<?php echo isset($duration) ? $duration : '10'; ?>" placeholder="" class="form-control" id="consult_time"/>
                                    </div>
                                </div>
                            <div class="col-md-3" hidden>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('charge_category'); ?></label>
                                    <select name="charge_category" style="width: 100%" form="" class="form-control charge_category select2">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php foreach ($charge_category as $key => $value) : ?>
                                            <option value="<?php echo $value['id']; ?>" <?php echo ($value['id'] == 36) ? 'selected' : ''; ?>>
                                                <?php echo $value['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                                <div class="col-md-3" >
                                    <div class="input-group">
                                        <label> Tipo de Agendamiento</label>
                                        <select name="type_opd" id="type_opd" form="" class="form-control type_opd select2">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($type_opd as $key => $value) {
                                                ?>
                                                <option value="<?php echo $value; ?>">
                                                <?php echo $key; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-3" hidden>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('charge'); ?></label><small class="req"> *</small>
                                            <select name="charge_id" form="" class="form-control charge select2">
                                                <option value=""><?php echo $this->lang->line('select')?></option>
                                                <?php if(!empty($charge)){ 
                                                    foreach ($charge as $charge_key => $charge_value) {
                                                ?>
                                                <option <?php echo isset($charge_id)?$charge_id==$charge_value['id']?"selected":"" :''; ?> value="<?php echo $charge_value['id']; ?>">
                                                <?php echo $charge_value['name']; ?></option>
                                                <?php }} ?>
                                            </select>
                                    </div>
                                </div>
                              
                                <div class="col-md-3" hidden>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('amount'); ?></label>
                                        <input type="text" class="form-control standard_charge" value="<?php echo isset($appointment_charge)?amountFormat($appointment_charge):''; ?>" disabled="disabled" />
                                    </div>
                                </div>
                              
                              <div class="col-md-3">
                                <label>Inicio vigencia</label>
                                <div class="input-group" style="margin-right: 5px;">
                                  <input type="text" id="doctor_start_date" name="doctor_start_date" class="form-control date-today" aria-invalid="false" placeholder="Fecha inicial" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;">
                                  <div class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-md-3">
                                <label>final vigencia</label>
                                <div class="input-group">
                                  <input type="text" id="doctor_end_date" name="doctor_end_date" class="form-control date-today" aria-invalid="false" placeholder="Fecha final" style="border-radius: 10px 0px 0px 10px !important; margin-bottom: 0px !important;">
                                  <div class="input-group-addon" style="border-radius: 0px 10px 10px 0px !important;">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                </div>
                              </div>
                              
                           </div>
                      </div>                    
                    <?php if (isset($days)) { ?>
                    <div class="box-header ptbnull"></div>
                    <div class="nav-tabs-custom border0">
                        <ul class="nav nav-tabs" id="myTabs">
                            <?php
                            $count = 1;
                            foreach ($days as $days_key => $days_value) {
                                $cls = "";
                                if ($count == 1) {
                                } ?>
                                <li <?php echo $cls; ?>><a href="#tab_<?php echo $count; ?>" data-s="<?php echo set_value("shift") ?>" data-d="<?php echo set_value("doctor"); ?>" data-day="<?php echo $days_key; ?>" data-toggle="tab" aria-expanded="true"><?php echo $days_value; ?></a></li>
                                <?php $count++; } ?>
                          </ul>
                        <div class="tab-content">
                            <?php
                            $count = 1;
                            foreach ($days as $days_key => $days_value) {
                                $cls = "class='tab-pane'";
                                if ($count == 1) {
                                    
                                } ?>
                            <div <?php echo $cls; ?> id="tab_<?php echo $count; ?>">
                            </div>
                        <?php $count++; }?>
                        </div>
                    </div>
                </div>
                <?php } } ?>
    </section>
</div>
      
      
<div class="modal fade" id="lock_modal"  aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-media-content">
       <div class="modal-header modal-media-header">
         <button type="button" class="close pt4" data-dismiss="modal">&times;</button>
         <div class="row">
         </div>
       </div>
       <div class="modal-body pb0">
         <form id="lock_form" accept-charset="utf-8" method="post">

         </form>
       </div>
       <div class="modal-footer">
          <div class="pull-right">
            <button type="submit" id="lock_form_btn" form="lock_form" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn" style="color:#fff;"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
          </div>
          <div class="pull-right" style="margin-right: 10px;">
              <button type="submit" data-loading-text="<?php echo $this->lang->line('processing') ?>" name="save_print" class="btn pull-right printsavebtn" style="color:#fff;"><i class="fa fa-print"></i> <?php echo $this->lang->line('save_print'); ?></button>
          </div>
       </div>
    </div>
  </div>
</div>
      
  
<script type="text/javascript">
    $(document).on('focus', '.time', function () {
        var $this = $(this);
        $this.datetimepicker({
            format: 'LT'
        });
    });
    var tot_count = 0;
    var doctor = '<?php echo set_value('doctor') ?>';

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href"); // activated tab
        var target_id = $(e.target).attr("id"); // activated tab
        var ajax_data = $(e.target).data(); // activated tab
        $(target).html("");
        getShiftdata(target, target_id, ajax_data);
    })

    function getShiftdata(target, target_id, ajax_data) {
        $("#consult_time").attr("form","form_"+ajax_data.day);
        $("#consult_fee").attr("form","form_"+ajax_data.day);
        $(".charge_category").attr("form","form_"+ajax_data.day);
        $(".charge").attr("form","form_"+ajax_data.day);
        $("#doctor_start_date").attr("form","form_"+ajax_data.day);
        $("#doctor_end_date").attr("form","form_"+ajax_data.day);
        $("#type_opd").attr("form","form_"+ajax_data.day);
        $.ajax({
            type: 'POST',
            url: base_url + "admin/onlineappointment/getShiftdata",
            data: {'day': ajax_data.day, 'doctor': ajax_data.d, 'shift' : ajax_data.s, 'status_blocked':ajax_data.status_blocked},
            dataType: 'json',
            beforeSend: function () {
                $(target).addClass('show');
            },
            success: function (data) {
                $(target).html(data.html);
                tot_count = data.total_count + 1;
                console.log(data.prev_record);
                if(data.prev_record.length > 0){
                    lock_date_day(data.prev_record);
                }
            },
            error: function (xhr) { // if error occured

            },
            complete: function () {
                $(target).removeClass('show');
            }
        });
    }
  
    function lock_date_day(data){
        $("#doctor_start_date").val(data[0].start_date);
        $("#doctor_end_date").val(data[0].end_date);
    }
  
    $(document).ready(function () {
        $(".select2").select2();
        $('#myTabs a:first').tab('show');
        var counter = 0;

        $(document).on("click", ".addrow", function () {
            var newRow = $("<tr>");
            var cols = "";
            cols += `<td><input type="hidden" name="total_row[]" value="${tot_count}"><input type="hidden" name="prev_id_${tot_count}" value="0"><div class="input-group"><input type="text" name="time_from_${tot_count}" class="form-control time_from time" id="time_from_${tot_count}"  aria-invalid="false"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></td>`;

            cols += `<td><div class="input-group"><input type="text" name="time_to_${tot_count}" class="form-control time_to time" id="time_to_${tot_count}"  aria-invalid="false"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></td>`;

            cols += '<td width="30" class="text-right"><button type="button" class="ibtnDel btn btn-danger btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>';
            newRow.append(cols);

            $("table.order-list").append(newRow);

            tot_count++;
        });

        $(document).on("click", ".ibtnDel", function (event) {
              if($(this).closest('tr').prev('input').val()){
                var msg = '<?php echo $this->lang->line("are_you_sure_you_want_to_delete"); ?>';
              if (confirm(msg)) {
              $(this).closest("tr").remove();
                counter -= 1
                 }
        return false;

    }else{
          $(this).closest("tr").remove();
                counter -= 1
    }
        });

        if($("#doctor").val() != ''){
            prev_val = <?php echo set_value("shift")!=''?set_value("shift"):0 ?>;
            getDoctorShift(prev_val);
        }
       getchargecode_init(36,"");
    });
</script>
<script>
    function getDoctorShift(prev_val = 8){
        var doctor_id = $("#doctor").val();
        var select_box = "<option value=''><?php echo $this->lang->line('select'); ?></option> ";
        $.ajax({
            type: 'POST',
            url: base_url + "admin/onlineappointment/doctorshiftbyid",
            data: {doctor_id:doctor_id},
            dataType: 'json',
            success: function(res){
                $.each(res, function(i, list){
                    selected = list.id == prev_val ? "selected" : "";
                    select_box += "<option value='"+ list.id +"' "+selected+">"+ list.name +"</option>";
                });
                $("#shift").html(select_box);
           }
        });
    }
    
    function search(){
        $( "#doctor_form" ).submit();
    }   
   
  
</script>
<script>
     $(document).on('select2:select','.charge_category',function(){
            var charge_category=$(this).val();          
            $('.charge').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");
            getchargecode(charge_category,"");
     });

    function getchargecode(charge_category,charge_id) {
      var div_data = "<option value=''>Select</option>";
      if(charge_category != ""){
          $.ajax({
            url: base_url+'admin/charges/getchargeDetails',
            type: "POST",
            data: {charge_category: charge_category},
            dataType: 'json',
            success: function (res) {              
                $.each(res, function (i, obj)
                {
                    var sel = "";
                    div_data += "<option value='" + obj.id + "'>" + obj.name + "</option>";
                });
                $('.charge').html(div_data);
                $(".charge").select2("val", charge_id);             
            }
        });
      }
    }
  
        function getchargecode_init(charge_category, charge_id) {
          var div_data = "";
          if (charge_category != "") {
              $.ajax({
                  url: base_url + 'admin/charges/getchargeDetails',
                  type: "POST",
                  data: { charge_category: charge_category },
                  dataType: 'json',
                  success: function (res) {
                      $.each(res, function (i, obj) {
                          var sel = (obj.id == charge_id || obj.id == 2545) ? 'selected' : '';
                          div_data += "<option value='" + obj.id + "' " + sel + ">" + obj.name + "</option>";
                      });
                      $('.charge').html(div_data);

                      // Initialize select2 and set the selected option
                      $(".charge").select2({
                         
                      }).val(2545).trigger('change');
                  }
              });
          }
      }
  

    $(document).on('select2:select','.charge',function(){
        var charge=$(this).val();
        var orgid = $("#organisation").val();
        var apply_amount=0;

        $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/getChargeById',
                type: "POST",
                data: {charge_id: charge, organisation_id: 0},
                dataType: 'json',
                success: function (res) {
                    let standard_charge = parseFloat(res.standard_charge)+parseFloat(res.standard_charge*res.percentage/100)
                    $('.standard_charge').val(standard_charge.toFixed(2));
                }
        });
    });
</script>