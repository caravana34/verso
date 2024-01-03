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
                                <a data-toggle="modal" id="add" onclick="holdModal('myModalpa')" class="btn btn-sm newpatient" style="background:#1563B0; color:#fff;border-radius: 5px;"><i class="fa fa-plus"></i> Nuevo paciente</a> 
                           <?php endif ?>
                                    <?php if ($this->rbac->hasPrivilege('patient', 'can_delete')) {
                                      ?>
                                  <a type="submit" class="btn btn-sm  delete_selected" style="background:#1563B0; color:#fff;border-radius: 5px;" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i class="fa fa-trash"></i>  <?php echo $this->lang->line('delete_selected');?></a>
                              <?php } ?>
                              
                        </div>     
                    </div>
                    <div class="box-body">                      
                         
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
                        table.ajax.reload();
//                         window.location.reload(true);
                      
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
  
  
//   function editRecord2(id) {
//         window.id_record = id;
//         var idres = id;
//         $('.output').html(idres);
        
//         $.ajax({
//             url: '<?php echo base_url(); ?>admin/patient/getpatientDetails/update',
//             type: "POST",
//             data: {id: id},
//             dataType: 'json',
//             success: function (data) { 
//                 console.log(data);
//                 $("#eupdateid").val(data.id);
//                 $('#customfield2').html(data.custom_fields_value);
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
//                 let municipio = document.getElementById('custom_fields[patient][5]').value;
//                 let departamento = document.getElementById('custom_fields[patient][4]').value;
//                 departamentos(municipio,departamento);
//                 holdModal('editModal2');
// //                 departamentos();


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
<?php $this->load->view('admin/patient/patientupdate') ?>    
<?php $this->load->view('admin/patient/patientaddmodal') ?>


