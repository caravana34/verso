<?php  $currency_symbol = $this->customlib->getHospitalCurrencyFormat();
$genderList = $this->customlib->getGender();
// $case_reference_id=$result['case_reference_id'];
$custom_cliniverso = $result['custom'];
$result_param=$result['result'];
$charge_type        = $this->chargetype_model->getChargeTypeByModule("opd","appointment");?>



<div class="modal fade" id="add_chargeModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog pup100  " role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close pupclose" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_charges'); ?></h4> 
            </div>
            <form id="add_charges" accept-charset="utf-8"  method="post" class="ptt10">
                <div class="pup-scroll-area">
                    <div class="modal-body pt0">                    
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">                           
                                <input type="hidden" name="opd_id" value="" >
                                <input type="hidden" name="patient_charge_id" id="patient_charge_id" value="0">
                                <input type="hidden" name="organisation_id" id="organisation_id" value="<?php echo $visitdata['organisation_id'] ?>" > 
                              
                                <div class="row">
                                   <div class="col-lg-12 mb-5 pd-0" style="margin-bottom: 15px; padding: 0px;">
                                     <div class="col-lg-6">
                                       <div class="mt-3">
                                          <label>Buscar nombre del cargo</label>
                                          <div class="input-group">
                                              <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-search"></i></span> 
                                              <input type="text" class="form-control search_text" id="search_procedure" onkeyup="busqueda()" placeholder="Buscar cargo" autocomplete="off" style="border-radius: 0px 10px 10px 0px !important;">
                                              <span class="text-danger"></span>
                                          </div> 
                                      </div>
                                       <div class="usersearchlist">
                                          <ul class="list-group scroll-container mb-3" style="position: absolute; z-index: 100; width=" id="procedure" hidden>        
                                          </ul>
                                       </div>
                                     </div>
                                    </div>      
                                 </div>
                              
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="displayblock"><?php echo $this->lang->line('charge_type'); ?><small class="req"> *</small></label>     
                                            <select name="charge_type" id="add_charge_type" class="form-control charge_type select2" style="width: 100%">
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php foreach ($charge_type as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>">
                                                <?php echo $value->charge_type; ?>
                                                </option>
                                                <?php } ?>
                                            </select>                                                
                                            <span class="text-danger"><?php echo form_error('charge_type'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('charge_category'); ?></label><small class="req"> *</small> 
                                            <select name="charge_category" id="charge_category" style="width: 100%" class="form-control select2 charge_category" >
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('charge_category'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('charge_name'); ?></label><small class="req"> *</small>
                                                <select name="charge_id" id="charge_id" style="width: 100%" class="form-control addcharge select2 " >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                            <span class="text-danger"><?php echo form_error('code'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('standard_charge') . " (" . $currency_symbol . ")" ?></label>
                                            <input type="text" readonly name="standard_charge" id="addstandard_charge" class="form-control" value="<?php echo set_value('standard_charge'); ?>">                                        
                                            <span class="text-danger"><?php echo form_error('standard_charge'); ?></span>
                                        </div>
                                    </div>                            
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('tpa_charge') . " (" . $currency_symbol . ")" ?></label>
                                            <input type="text" readonly name="schedule_charge" id="addscd_charge" placeholder="" class="form-control" value="<?php echo set_value('schedule_charge'); ?>">    
                                            <span class="text-danger"><?php echo form_error('schedule_charge'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('qty'); ?></label><small class="req"> *</small> 
                                        <input type="text" name="qty" id="qty" class="form-control" value="1"> 
                                            <span class="text-danger"><?php echo form_error('qty'); ?></span>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="divider"></div>
                                    <div class="row">                                            
                                        <div class="col-sm-5">
                                            <table class="printablea4">
                                                <tr>
                                                    <th width="40%"><?php echo $this->lang->line('total') . " (" . $currency_symbol . ")"; ?></th>
                                                    <td width="60%" colspan="2" class="text-right ipdbilltable">
                                                        <input type="text" placeholder="Total" value="0" name="apply_charge" id="apply_charge" style="width: 30%; float: right" class="form-control total" readonly /></td>
                                                </tr>
                                                <tr>
                                                    <th><?php echo $this->lang->line('tax') . " (" . $currency_symbol . ")"; ?></th>
                                                    <td class="text-right ipdbilltable"><h4 style="float: right;font-size: 12px; padding-left: 5px;"> %</h4>
                                                    <input type="text" placeholder="<?php echo $this->lang->line('tax'); ?>" name="charge_tax" id="charge_tax" class="form-control charge_tax" readonly style="width: 70%; float: right;font-size: 12px;"/></td>
                                                    <td class="text-right ipdbilltable"><input type="text" placeholder="<?php echo $this->lang->line('tax'); ?>" name="tax" value="0" id="tax" style="width: 50%; float: right" class="form-control tax" readonly/></td>
                                                </tr>
                                                <tr>
                                                    <th><?php echo $this->lang->line('net_amount') . " (" . $currency_symbol . ")"; ?></th>
                                                    <td colspan="2" class="text-right ipdbilltable"><input type="text" placeholder="Net Amount" value="0" name="amount" id="final_amount" style="width: 30%; float: right" class="form-control net_amount" readonly/></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label><?php echo $this->lang->line('charge_note'); ?></label>
                                                        <textarea name="note" id="edit_note" rows="3" class="form-control edit_charge_note"  ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-sm-6-->
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('date'); ?></label> <small class="req"> *</small>                                            
                                                <input id="charge_date" name="date" placeholder="" type="text" class="form-control datetime" />
                                            </div>
                                            <button type="submit"  data-loading-text="<?php echo $this->lang->line('processing') ?>" name="charge_data" value="add" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('add') ?></button>
                                        </div>                                   
                                    </div><!--./row-->
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12" class="table-responsive ptt10">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th><?php echo $this->lang->line('date')?></th>
                                            <th><?php echo $this->lang->line('charge_type')?></th>
                                            <th><?php echo $this->lang->line('charge_category')?></th>
                                            <th><?php echo $this->lang->line('charge_name')?></th>
                                            <th class="text-right"><?php echo $this->lang->line('standard_charge').' ('. $currency_symbol .')'; ?></th>
                                            <th class="text-right"><?php echo $this->lang->line('tpa_charge').' ('. $currency_symbol .')'; ?></th>
                                            <th class="text-right"><?php echo $this->lang->line('qty')?></th>
                                            <th class="text-right"><?php echo $this->lang->line('total').' ('. $currency_symbol .')'; ?></th>
                                            <th class="text-right"><?php echo $this->lang->line('tax').' ('. $currency_symbol .')'; ?></th>
                                            <th class="text-right"><?php echo $this->lang->line('net_amount').' ('. $currency_symbol .')'; ?></th>
                                            <th class="text-right"><?php echo $this->lang->line('action')?></th>
                                        </tr>
                                        <tbody id="preview_charges">                                 
                                    
                                        </tbody>
                                    </table>
                             
                                </div>
                            </div>
                        </div>
                    </div> <!-- scroll-area -->
                    <div class="modal-footer sticky-footer"> 
                        <div class="pull-right">                        
                            <button type="submit"  data-loading-text="<?php echo $this->lang->line('processing') ?>" value="save" name="charge_data" class="btn btn-info"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save') ?></button>
                        </div>
                    </div> 
                </form>
                  </div>
              </div>     
          </div>
<script>

$(document).ready(function (e) {
        $("#add_charges button[type=submit]").click(function() {
        $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
        $(this).attr("clicked", "true");
    });

        $("#add_charges").on('submit', (function (e) {
            e.preventDefault();
            var $this = $("button[type=submit][clicked=true]");
            var form = $(this);
            var form_data = form.serializeArray();
            var button_val=$this.attr('value');
            form_data.push({name: "add_type", value: button_val});
            $.ajax({ 
                url: '<?php echo base_url(); ?>admin/charges/add_opdcharges',
                type: "post", 
                data: form_data,
                dataType: 'json',
                beforeSend: function () {
             $("#add_chargesbtn").button('loading');
               
            },
                success: function (res) {
                    if (res.status == "fail") {
                        var message = "";
                        $.each(res.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else if(res.status == "new_charge") {
                        var data=res.data;
                        var row_id=makeid(8);
                
                
                        var charge='<tr id="'+row_id+'"><td>'+data.date+'<input type="hidden" name="pre_date[]" value="'+data.date+'"></td><td>'+data.charge_type_name+'</td><td>'+data.charge_category+'</td><td>'+data.charge_name+'<input type="hidden" name="pre_charge_id[]" value="'+data.charge_id+'"><br><h6>'+data.note+'<input type="hidden" name="pre_note[]" value="'+data.note+'"></h6></td><td class="text-right">'+data.standard_charge+'<input type="hidden" name="pre_standard_charge[]" value="'+data.standard_charge+'"><input type="hidden" name="pre_tax_percentage[]" value="'+data.tax_percentage+'"></td><td class="text-right">'+data.tpa_charge+'<input type="hidden" name="pre_tpa_charges[]" value="'+data.tpa_charge+'"></td><td class="text-right">'+data.qty+'<input type="hidden" name="pre_qty[]" value="'+data.qty+'"></td><td class="text-right">'+data.amount+'<input type="hidden" name="pre_total[]" value="'+data.amount+'"></td><td class="text-right">'+data.tax+'<input type="hidden" name="pre_tax[]" value="'+data.tax+'"><input type="hidden" name="pre_apply_charge[]" value="'+data.apply_charge+'"></td><td class="text-right">'+data.net_amount+'<input type="hidden" name="pre_net_amount[]" value="'+data.net_amount+'"></td><td><button type="button" class="closebtn delete_row" data-row-id="'+row_id+'" data-record-id="'+data.charge_id+'" autocomplete="off"><i class="fa fa-remove"></i></button></td></tr>';
                        $('#preview_charges').append(charge);
                        
                        
                        console.log(charge);
                       charge_reset();
                    }else{
                         successMsg(res.message);
                        window.location.reload(true);
                    }
                   
                },
                error: function () {
                    $("#add_chargesbtn").button('reset');
                },
                complete: function () {
                    $("#add_chargesbtn").button('reset');
                }
            });
        }));
    });


$(document).on('click','.print_charge',function(){    

      var $this = $(this);
         var record_id=$this.data('recordId')
       $this.button('loading');
      $.ajax({
          url: '<?php echo base_url(); ?>admin/patient/printCharge',
          type: "POST",
          data:{'id':record_id,'type':'opd'},
          dataType: 'json',
           beforeSend: function() {
                 $this.button('loading');
      
          },
          success: function(res) {
           popup(res.page);
          },
             error: function(xhr) { // if error occured
          alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                  $this.button('reset');
              
         },
              complete: function() {
                   $this.button('reset');
                 
             }
      });
  });




</script>
