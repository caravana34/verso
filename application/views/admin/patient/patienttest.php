<?php  $currency_symbol = $this->customlib->getHospitalCurrencyFormat();
$genderList = $this->customlib->getGender();
// $case_reference_id=$result['case_reference_id'];
$custom_cliniverso = $result['custom'];
$result_param =$result['result'];
// $data["charge_type"]       = $this->chargetype_model->getChargeTypeByModule("opd");
$charge_type        = $this->chargetype_model->getChargeTypeByModule("opd");
$chargeData =$result['chargesdata'];
// $doctors = json_encode($doctors);
$charge_category    = $this->charge_category_model->getCategoryByModule("opd");
// echo "<pre>";
// print_r($data);
// exit;
?>

<style>
    .btn{
        color:#fff;
        background-color:#1563B0;
    } 
    
/*         .ritt{
            text-align: right;
    } */
</style>



<div class="modal fade" id="add_chargeModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog pup100  " role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-media-header" style="background:#1563B0; color:#fff; padding-top:15px;padding-bottom:15px;">
                <button type="button" class="close pupclose" data-dismiss="modal" style="margin-right:7px;">&times;</button>
                <h4 class="modal-title" style="margin-left:7px;"><?php echo $this->lang->line('add_charges'); ?></h4>
            </div>
            <form id="add_charges" accept-charset="utf-8"  method="post" class="ptt10">
                <div class="pup-scroll-area">
                    <div class="modal-body pt5">                    
                        <div class="col-md-12">
                            <div class="col-lg-12 col-md-12 col-sm-12">                           
                                <input type="hidden" name="opd_id" value="" >
                                <input type="hidden" name="patient_charge_id" id="patient_charge_id" value="0">
                                <input type="hidden" name="organisation_id" id="organisation_id" value="<?php echo $visitdata['organisation_id'] ?>" > 
                                <div class="col-md-12">
                                    <div class="col-lg-12 mb-5 pd-0" style="display:flex;margin-bottom: 35px; padding: 0px;">
                                        <div class="col-lg-4">
                                            <div class="col-lg-4">
                                                  <label style=""> Nº de factura</label>
                                                  <div class="input-group" style="display:flex;margin-bottom: 35px; padding: 0px;">
                                                      <input type="text" class="col-sm-3 form-control" id="" style="border-radius: 10px 0px 0px 10px !important;" placeholder="ejm.CL">
                                                      <input type="number" class="col-sm-3 form-control" id="" style="border-radius: 0px 10px 10px 0px !important;"placeholder="Ejm. 2355">
                                                      <span class="text-danger">
                                                    </span>
                                                  </div> 
                                              </div>
                                         </div>
                                        <div class="col-lg-4">
                                            <div class="col-lg-4 ritt">
                                                <label style="">fecha de la factura</label>
                                                <div class="input-group" style="">
                                                    <span class="input-group-addon itt" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-calendar-o"></i></span>
                                                    <input type="date" class="form-control text-right" id="" style="border-radius: 0px 10px 10px 0px !important;"placeholder="">
                                                </div> 
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-lg-12 mb-5 pd-0" style="">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-4 m-3 ml-5" style="">
                                                <div class="m-2 mt-2 mb-4">
                                                    <h4 class="text-left" style="color:#a09d9d;">
                                                        <i class="fas fa-id-card fa-lg text-primary" style="font-size:20px;color:#1563B0;"></i>
                                                        <strong> Información del paciente</strong>
                                                    </h4>
                                                </div>
                                                <div class="m-2">
                                                    <p style="display: inline;"><strong><?php echo $this->lang->line('notification_appointment_created'); ?>: </strong></p>
                                                    <p style="display: inline;" id="dataCread"></p>
                                                </div>
                                                <div class="m-2">
                                                    <p style="display: inline;"><strong><?php echo $this->lang->line('patient_name'); ?>: </strong></p>
                                                    <p style="display: inline;" id="patient_name_bill"></p>
                                                </div>
                                                <div class="m-2">
                                                    <p style="display: inline;"><strong><?php echo $this->lang->line('birth_date'); ?>: </strong></p>
                                                    <p style="display: inline;" id="dobdb"></p>
                                                </div>
                                                <div class="m-2">
                                                    <p style="display: inline;"><strong><?php echo $this->lang->line('age'); ?>: </strong></p>
                                                    <p style="display: inline;" id="Age"></p>
                                                </div>
                                                <div class="m-2">
                                                      <p style="display: inline;"><strong>Tipo de afiliación: </strong></p>
                                                    <div class="form-check" style="display: inline;">
                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                        <label class="form-check-label" for="exampleRadios1">Cotizante</label>
                                                    </div>
                                                    <div class="form-check" style="display: inline;">
                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                                        <label class="form-check-label" for="exampleRadios2">Beneficiario</label>
                                                    </div>
                                                </div>
                                                <div class="m-2">
                                                      <p style="display: inline;"><strong>Categoría: </strong></p>
                                                    <div class="form-check" style="display: inline;">
                                                        <input class="form-check-input" type="radio" name="categoria" id="exampleRadios1" value="option1" checked>
                                                        <label class="form-check-label" for="exampleRadios1">A</label>
                                                    </div>
                                                    <div class="form-check" style="display: inline;">
                                                        <input class="form-check-input" type="radio" name="categoria" id="exampleRadios2" value="option2">
                                                        <label class="form-check-label" for="exampleRadios2">B</label>
                                                    </div>
                                                    <div class="form-check" style="display: inline;">
                                                        <input class="form-check-input" type="radio" name="categoria" id="exampleRadios2" value="option2">
                                                        <label class="form-check-label" for="exampleRadios2">C</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- --------------------------- -->
                                            <div class="col-lg-4  m-3" style="">
                                                <div class="m-2">
                                                    <h4 class="text-left" style="color:#a09d9d;">
                                                        <i class="fas fa-notes-medical" style="font-size:20px;color:#1563B0;"></i>
                                                        <strong> Información del responsable</strong>
                                                    </h4>
                                                </div>
                                                <div class="m-2">
                                                    <p style="display: inline;"><strong>Responsable: </strong></p>
                                                    <p style="display: inline;" id="nameData"></p>
                                                </div>
                                                <div class="m-2">
                                                    <p style="display: inline;"><strong>Concepto: </strong></p>
                                                    <p style="display: inline;" id=""></p>
                                                </div>
                                                <div class="m-2">
                                                    <p style="display: inline;"><strong>Eps: </strong></p>
                                                    <p style="display: inline;" id="valorEPS"></p>
                                                </div>
                                              <div class="m-5 mb-3">
                                                    <label style="display: inline;"><strong>Autorización: </strong></label>
                                                    <input type="text" class="col-6 form-control" id="idData" style="display: inline;"  placeholder=""> 
                                                </div>
                                              
                                            </div>
                                          <div class="col-lg-4 m-3" style=" ">
                                                <h4 class="text-left" style="color:#a09d9d;">
                                                  <i class="fa fa-newspaper-o ftlayer" style="font-size:20px;color:#1563B0;"></i>
                                                  <strong>Tipo de factura</strong>
                                                </h4>  
                                              <div class="m-2 mb-3">
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="factura" id="exampleRadios1" value="option1" checked>
                                                      <label class="form-check-label" for="exampleRadios1"> 1 factura por paciente</label>
                                                  </div>
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="factura" id="exampleRadios2" value="option2">
                                                      <label class="form-check-label" for="exampleRadios2"> Prefactura</label>
                                                  </div>
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="factura" id="exampleRadios2" value="option2">
                                                      <label class="form-check-label" for="exampleRadios2"> Facturar Copago/CM</label>
                                                  </div>
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="factura" id="exampleRadios2" value="option2">
                                                      <label class="form-check-label" for="exampleRadios2"> Recibo de Pago</label>
                                                  </div>
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="factura" id="exampleRadios2" value="option2">
                                                      <label class="form-check-label" for="exampleRadios2"> Paciente Particular</label>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                      <hr>
                                    </div>
                                   <!-- -------------------------- -->
                                 <div class="col-md-12 mb-5  pd-0" style="margin-bottom: 15px; padding: 0px; margin:10px;">
                                    <div class="m-2">
                                        <div class="row">
                                            <div class="col-md-12" style="display: inline;">
                                                <label for="">Descripción de la Factura</label>
                                                <textarea id="descript_bill" name="descrip_bill" rows="2" cols="30">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- -------------------------- -->
                                <div class="col-lg-12 mb-5  pd-0" style="background:#e3e5e8; margin-bottom: 15px; padding-right:10px; margin:10px; margin-right:20px;">
                                    <div class="row d-flex">
                                       <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Código:</label>
                                                 <input type="text" class="form-control search_text" id="search_cups" onkeyup="cups_structure()" placeholder="Buscar prestación" autocomplete="off" <?=$result_state_readonly?>>
                                                <div class="usersearchlist">
                                                    <ul class="list-group scroll-container mb-3" style="position: absolute; z-index: 100;" id="cups_result" hidden>        
                                                    </ul>
                                                </div>
                                                <span class="text-danger"><?php echo form_error(); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Descripción del Código</label>
                                                <input type="text" class="form-control" autocomplete="off" id="codigo_cups" value="" name="codigo_cups" placeholder="" style="" readonly>
<!--                                                 <input type="text" name="schedule_charge" id="" placeholder="" id="cups_result" class="form-control" value="">     -->
                                                <span class="text-danger"><?php echo form_error(''); ?></span>
                                            </div>
                                        </div>
                                       <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Cups categoría</label><small class="req"> *</small> 
                                            <select name="" id="" class="form-control select2 charge_cups" style="width: 100%">
                                                
                                            </select>
                                            <span class="text-danger"><?php echo form_error('charge_category'); ?></span>
                                        </div>
                                    </div>
                                       
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>%</label>
                                                <input type="number" name="" id="" placeholder="100" class="form-control" value="100">    
                                                <span class="text-danger"><?php echo form_error(''); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Cantidad</label>
                                                <input type="number" name="" id="" placeholder="1" class="form-control" value="1">    
                                                <span class="text-danger"><?php echo form_error(''); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Valor Unitario</label>
                                                <input type="number" name="" id="final_amount_top" placeholder="" class="form-control" value="">    
                                                <span class="text-danger"><?php echo form_error(''); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Subtotal</label>
                                                <input type="number" name="" id="" placeholder="" class="form-control" value="">    
                                                <span class="text-danger"><?php echo form_error(''); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <!--------------------------------------------------- -->
                                <div class="row" style="padding-left:10px">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="displayblock"><?php echo $this->lang->line('charge_type'); ?><small class="req"> *</small></label>     
                                            <select name="charge_type" id="add_charge_type" class="form-control charge_type select2" style="width: 100%">
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php foreach ($charge_type as $key => $value) { ?>
                                                <option value="<?php echo $value->id; ?>"> <?php echo $value->charge_type; ?></option>
                                                <?php } ?>
                                            </select>                                                
                                            <span class="text-danger"><?php echo form_error('charge_type'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('charge_category'); ?></label><small class="req"> *</small> 
                                            <select name="charge_category" id="charge_category" class="form-control select2 charge_category" style="width: 100%">
                                                <?php foreach ($chargeData['chargesdata'] as $charge) { ?>
                                                    <option value="<?php echo $charge->id; ?>"><?php echo $charge->name; ?></option>
                                                <?php } ?>  
                                            </select>
                                            <span class="text-danger"><?php echo form_error('charge_category'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('charge_name'); ?> hola</label><small class="req"> *</small>
                                                <select name="charge_id" id="charge_id" style="width: 100%" class="form-control charge select2 " >
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
                                        <div class="col-sm-4">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group" style="padding-left:10px">
                                                        <div class="m-2 mb-3" style="margin-bottom:10px;">
                                                            <h4 class="text-center" style="color:#a09d9d;"><strong>Total a pagar</strong></h4>
                                                        </div> 
                                                        <div class="m-2 mb-3">
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="radio" name="totalpagar" id="exampleRadios1" value="option1" checked>
                                                              <label class="form-check-label" for="exampleRadios1"> Efectivo</label>
                                                            </div>
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="radio" name="totalpagar" id="exampleRadios2" value="option2">
                                                              <label class="form-check-label" for="exampleRadios2">Tarjeta Debito</label>
                                                            </div>
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="radio" name="totalpagar" id="exampleRadios2" value="option2">
                                                              <label class="form-check-label" for="exampleRadios2">Tarjeta Credito</label>
                                                            </div>
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="radio" name="totalpagar" id="exampleRadios2" value="option2">
                                                              <label class="form-check-label" for="exampleRadios2"> Cheque</label>
                                                            </div>
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="radio" name="totalpagar" id="exampleRadios2" value="option2">
                                                              <label class="form-check-label" for="exampleRadios2"> Consignación</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!---------./col-sm-6------------>
                                        <div class="col-sm-4">
                                            <table class="printablea4">
                                                <div class="m-2 mb-3" style="margin-bottom:10px;">
                                                    <h4 class="text-center" style="color:#a09d9d;"><strong>Total a pagar</strong></h4>
                                                </div> 
                                                <tr>
                                                    <th><?php echo $this->lang->line('subtotal') . " (" . $currency_symbol . ")"; ?>: </th>
<!--                                                     <td class="text-right ipdbilltable"><h4 style="float: right;font-size: 12px; padding-left: 5px;"> %</h4> -->
<!--                                                     <input type="text" placeholder="<?php echo $this->lang->line('tax'); ?>" name="charge_tax" id="charge_tax" class="form-control charge_tax" readonly style="width: 70%; float: right;font-size: 12px;"/></td> -->
                                                    <td class="text-right ipdbilltable">
                                                        <input type="text" placeholder="<?php echo $this->lang->line('tax'); ?>" name="tax" value="0" id="tax" style="width: 30%; float: right" class="form-control tax" readonly/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>CPG/CM: </th>
                                                    <td colspan="2" class="text-right ipdbilltable">
                                                        <input type="text" placeholder="Net Amount" value="0" name="amount" id="final_amount" style="width: 30%; float: right" class="form-control net_amount" readonly/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th width="40%"><?php echo $this->lang->line('total') . " (" . $currency_symbol . ")"; ?>: </th>
                                                    <td width="60%" colspan="2" class="text-right ipdbilltable">
                                                        <input type="text" placeholder="Total" value="0" name="apply_charge" id="apply_charge" style="width: 30%; float: right" class="form-control total" readonly />
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-3">
<!--                                             <div class="form-group">
                                                <label><?php echo $this->lang->line('date'); ?></label> <small class="req"> *</small>                                            
                                                <input id="charge_date" name="date" placeholder="" type="text" class="form-control datetime" />
                                            </div> -->
                                            <button type="submit"  data-loading-text="<?php echo $this->lang->line('processing') ?>" name="charge_data" value="add" class="btn pull-right"  style="margin-top:40%;">
                                                <i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save') ?>
                                            </button>
                                        </div>                                   
                                    </div>
                                    <!------------./row--------------->
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12" class="table-responsive ptt10">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
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
                    </div> 
                    <!-------- scroll-area -------------------->
                    <div class="modal-footer sticky-footer"> 
                        <div class="pull-right">                        
                            <button type="submit"  data-loading-text="<?php echo $this->lang->line('processing') ?>" value="save" name="charge_data" class="btn mt-auto "><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save') ?></button>
                        </div>
                    </div> 
                </form>
                  </div>
              </div>     
          </div>

    
<script>


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
      });name
  });
  
  
  
     function billopd_clini_mod(data){
      console.log(data);
      holdModal('add_chargeModal');
      if(data.patient.guardian_name != null && data.patient.guardian_name != "" ){
        $("#patient_name_bill").text(data.patient.patient_name+" "+data.patient.guardian_name);
        var descript = "Atención para"+" "+data.patient.patient_name+" "+data.patient.guardian_name + " por concepto de" + " "+data.appointment[0].reason_consultation;
         $("#descript_bill").text(descript);
      }else{
        $("#patient_name_bill").text(data.patient.patient_name);
         var descript = "Atención para "+ data.patient.patient_name+" por concepto de" +" "+data.appointment[0].reason_consultation;
         $("#descript_bill").text(descript);
      }
      $("#dataCread").text(data.patient.created_at);
      $("#Age").text(data.patient.age);
      $("#dobdb").text(data.patient.dob);
      
      
    $.each(data.patient_custom, function (i, obj)
      {
            console.log(obj.custom_field_id);
            if(obj.custom_field_id == 12){
//                   console.log(obj.field_value);
                var eps = obj.field_value;
                var name = obj.name;
                var id = obj.id;

                 $("#valorEPS").text(eps);
                 $("#nameData").text(name);
                 $("#idData").val(id);
               }
      });
  }
  
  

  function billopd_clini(data,opd){
    console.log(data);
    console.log(opd);
//       holdModal('add_chargeModal');
//      window.open("https://clinify.co/cliniverso_dev/admin/bill/opd_visit_detail/4642/961#Charges", "PopupWindow", "width=600,height=400");
//         window.open("https://clinify.co/cliniverso_dev/admin/bill/opd_visit_detail/"+data.patient.id+"/"+opd+"#Charges", "PopupWindow", "width=" + screen.width + ",height=" + screen.height);
        window.open("<?= base_url('admin/bill/opd_visit_detail/') ?>" + data.patient.id + "/" +opd+ "#charges", "_blank");

      
      if(data.patient.guardian_name != null ){
        $("#patient_name_bill").text(data.patient.patient_name+" "+data.patient.guardian_name);
        var descript = "Atención para"+" "+data.patient.patient_name+ " por concepto de" + " "+data.appointment[0].reason_consultation;
         $("#descript_bill").text(descript);
      }else{
        $("#patient_name_bill").text(data.patient.patient_name);
         var descript = "Atención para "+ data.patient.patient_name+" por concepto de " +" "+data.appointment[0].reason_consultation;
         $("#descript_bill").text(descript);
      }
      $("#dataCread").text(data.patient.created_at);
      $("#Age").text(data.patient.age);
      $("#dobdb").text(data.patient.dob);
      
      
    $.each(data.patient_custom, function (i, obj)
      {
            console.log(obj.custom_field_id);
            if(obj.custom_field_id == 12){
//                   console.log(obj.field_value);
                var eps = obj.field_value;
                var name = obj.name;
                var id = obj.id;

                 $("#valorEPS").text(eps);
                 $("#nameData").text(name);
                 $("#idData").val(id);
               }
      });
  }
  
 $(document).on('change','.charge_type',function(){
        var charge_type=$(this).val();     
        $('.charge_category').html("<option value=''><?php echo $this->lang->line('loading') ?> </option>");
        getcharge_category(charge_type,"");

    });
 function getcharge_category(id) {
        var div_data = "";
        $('#charge_category').html("<option value='l'><?php echo $this->lang->line('loading') ?></option>");
        $("#charge_category").select2("val", 'l');

        $.ajax({
            url: '<?php echo base_url(); ?>admin/charges/get_charge_category',
            type: "POST",
            data: {
                charge_type: id
            },
            dataType: 'json',
            success: function (res) {
                $.each(res, function (i, obj)
                {
                    var sel = "";
                    div_data += "<option value='" + obj.id + "'>" + obj.name + "</option>";
                });
                
                $('#charge_category').html("<option value=''><?php echo $this->lang->line('select'); ?></option>");
                $('#charge_category').append(div_data);
                $("#charge_category").select2("val", '');
            }
        });
    }  
  
   $(document).on('select2:select','.charge_category',function(){
        var charge_category=$(this).val();      
        $('.charge').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");   
//         $('.charge').html("<option value=''><?php echo $this->lang->line('loading') ?></option>");
        getchargecode(charge_category,"");
 });
  
 function getchargecode(charge_category,charge_id) {      
   
   console.log(charge_category);
   charge_id = $("#charge_category").val();
   console.log(charge_id);
      var div_data = "<option value=''><?php echo $this->lang->line('select'); ?></option>";
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
//                 $(".charge").select2("val", charge_id);
//                 $('.addcharge').html(div_data);
//                 $(".addcharge").select2("val", charge_id);             
            }
        });
      }
    }
  
  function cups_charges(charge){
    
        var orgid=$('#organisation_id').val();
        $('#qty').val('1');
       
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getChargeById',
            type: "POST",
            data: {charge_id: charge, organisation_id: orgid},
            dataType: 'json',
            success: function (res) {
                if (res) {
                    var quantity=$('#qty').val();
                    $('#apply_charge').val(parseFloat(res.standard_charge) * quantity);
                    $('#addstandard_charge').val(res.standard_charge);
                    $('#addscd_charge').val(res.org_charge);
                    $('#charge_tax').val(res.percentage);
                    var standard_charge= res.standard_charge;
                    var schedule_charge= res.org_charge;
                    var discount_percent= 0;
                    var total_charge=(schedule_charge == null )? standard_charge:schedule_charge;
                    var apply_charge=isNaN(parseFloat(total_charge)*parseFloat(quantity))?0 : parseFloat(total_charge)*parseFloat(quantity);
                    var discount_amount= (apply_charge*discount_percent)/100;
                    $('#apply_charge').val(apply_charge.toFixed(2));
                    var final_amount=apply_charge-discount_amount;
                    $('#tax').val(((final_amount*res.percentage)/100).toFixed(2));
                    $('#final_amount').val((final_amount+((final_amount*res.percentage)/100)).toFixed(2));
                    $('#final_amount_top').val((final_amount+((final_amount*res.percentage)/100)).toFixed(2));
                }
            }
        });
  }
    
  
    
  
     $(document).on('select2:select','.charge',function(){
              var charge = $(this).val();
              cups_charges(charge);
//               $("#add_charge_type").val("");
//               $("#add_charge_type").select2("val", "");
      });
  
    $(document).on('select2:select','.charge_cups',function(){
              var charge = $(this).val();
               cups_charges(charge);
               $("#add_charge_type").select2("val", "");
      });
  

  
  
  
  
  
//   ----------------------------------------------------------------------
     function cups_structure(){
      
      let search_cups = document.getElementById("search_cups").value.toUpperCase();
      let cups_result = document.getElementById("cups_result");
      
      
      $.ajax({
        url : `https://www.datos.gov.co/resource/9zcz-bjue.json?$where=codigoprocedimiento%20like%20'%25${search_cups}%25'%20OR%20descripcion%20like%20'%25${search_cups}%25'%20OR%20codigocups%20like%20'%25${search_cups}%25'&$limit=10&$offset=0`,
        type : 'GET',
        dataType : 'json',
        data: {
              "$$app_token" : "SRFsensloxdn0TDPB95X5rzpN"
            },
        success : (resp) => {
        console.log(resp);
            
         let cups = resp;
          if (search_cups.length != 0) {
                cups_result.removeAttribute("hidden");
              } else if (search_cups.length == 0) {
                cups_result.setAttribute("hidden", false);
              }
//             let uniqueMedicines = removeDuplicatesMedicines(cups);
//             console.log(uniqueMedicines);
         let cups_list ="";
         for (let property of cups ) {
                cups_list += `<li class="list-group-item list-hover" onclick="addCups({ codigo:'${property.codigocups}',
                                                                                          producto:'${property.descripcion}',
                                                                                        })">
                                  <div class="col-xs-10 col-sm-9">
                                      <span class="name"><strong>Código Cups: </strong>${property.codigocups}</span><br>
                                      <span><strong>Descripción: </strong>${property.descripcion}</span><br>
                                      <span><strong>Código Procedemiento: </strong>${property.codigoprocedimiento}</span>
                                  </div>
                                  <div class="clearfix"></div>
                              </li>`;
         } 

         document.getElementById("cups_result").innerHTML= cups_list;
          
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
//   --------------------------------------------------------------------
    function addCups({codigo,producto}){
    
    
      let codigo_cups = document.getElementById('codigo_cups');
      let product_cups = document.getElementById('product_cups');
      let cups_result = document.getElementById('cups_result');
      let search_cups = document.getElementById('search_cups');
      let charge_id = document.getElementById('charge_id');
      let charge_cups = document.getElementById('charge_cups');
    
    
     document.addEventListener('click', function(event) {
        const targetElement = event.target;
          
            if (targetElement !== search_cups && cups_result.contains(targetElement)) {
                search_cups.value = "";
                cups_result.setAttribute("hidden", false);
              
                search_cups.value = "";  
             }
        });
      
      document.addEventListener('click', function(event) {
        const targetElement = event.target;
            if(targetElement !== charge_id  && cups_result.contains(targetElement)){
//                 charge_cups.value = "";
                 cups_result.setAttribute("hidden", false)
//                  charge_cups.value = ""; 
                       }
        });
        
//       document.addEventListener('click', function(event) {
//           const targetElement = event.target;
//         console.log("ggggg " + targetElement.id);
//             let select2_container = document.getElementById('select2--container');
//           if (targetElement.id === "select2-charge_id-container") {
            
//             select2_container.value = "<option value=''><?php echo $this->lang->line('select'); ?></option>";
            
// //               alert('Element clicked!' + select2_container.value);
//           }
//       });

        
//         charge_id.addEventListener('change', function() {
// //             alert('Element clicked!');
//             // Obtener el valor seleccionado
//             const selectedValue = charge_id.value;

//             // Hacer algo con el valor seleccionado, por ejemplo, mostrarlo en la consola
//             console.log('Elemento seleccionado:', selectedValue);
//         });
        


      
      




        codigo_cups.value = `${codigo} - ${producto}` ;
//         document.getElementById('description_cup').value=producto;
    
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
        
          var div_data_cups ="<option value=''>Seleccione</option>";
      
      
         $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/search_by_cups',
            type: "POST",
            data: {codigo:codigo},
            dataType: 'json',
            success: function (res) {
                $.each(res, function (i, obj)
                {
                  console.log(obj.id);
//                     var sel = "";
                    div_data_cups += "<option value='" + obj.id + "'>" + obj.name + "</option>";
                    
                });
                $('.charge_cups').html(div_data_cups);
           
            }
        });
      
   
  
         }
  
 $(document).ready(function(e) {
          $("#add_charges button[type=submit]").click(function() {
            $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
            $(this).attr("clicked", "true");
          });

          $("#add_charges").on('submit', (function(e) {
            e.preventDefault();
            var $this = $("button[type=submit][clicked=true]");
            var form = $(this);
            var form_data = form.serializeArray();
            var button_val = $this.attr('value');
            form_data.push({
              name: "add_type",
              value: button_val
            });
            $.ajax({
              url: '<?php echo base_url(); ?>admin/charges/add_opdcharges',
              type: "post",
              data: form_data,
              dataType: 'json',
              beforeSend: function() {
                $("#add_chargesbtn").button('loading');

              },
              success: function(res) {
                if (res.status == "fail") {
                  var message = "";
                  $.each(res.error, function(index, value) {
                    message += value;
                  });
                  errorMsg(message);
                } else if (res.status == "new_charge") {
                  var data = res.data;
                  var row_id = makeid(8);


                  var charge = '<tr id="' + row_id + '"><td>' + data.date + '<input type="hidden" name="pre_date[]" value="' + data.date + '"></td><td>' + data.charge_type_name + '</td><td>' + data.charge_category + '</td><td>' + data.charge_name + '<input type="hidden" name="pre_charge_id[]" value="' + data.charge_id + '"><br><h6>' + data.note + '<input type="hidden" name="pre_note[]" value="' + data.note + '"></h6></td><td class="text-right">' + data.standard_charge + '<input type="hidden" name="pre_standard_charge[]" value="' + data.standard_charge + '"><input type="hidden" name="pre_tax_percentage[]" value="' + data.tax_percentage + '"></td><td class="text-right">' + data.tpa_charge + '<input type="hidden" name="pre_tpa_charges[]" value="' + data.tpa_charge + '"></td><td class="text-right">' + data.qty + '<input type="hidden" name="pre_qty[]" value="' + data.qty + '"></td><td class="text-right">' + data.amount + '<input type="hidden" name="pre_total[]" value="' + data.amount + '"></td><td class="text-right">' + data.tax + '<input type="hidden" name="pre_tax[]" value="' + data.tax + '"><input type="hidden" name="pre_apply_charge[]" value="' + data.apply_charge + '"></td><td class="text-right">' + data.net_amount + '<input type="hidden" name="pre_net_amount[]" value="' + data.net_amount + '"></td><td><button type="button" class="closebtn delete_row" data-row-id="' + row_id + '" data-record-id="' + data.charge_id + '" autocomplete="off"><i class="fa fa-remove"></i></button></td></tr>';
                  $('#preview_charges').append(charge);

                  charge_reset();
                } else {
                  successMsg(res.message);
                  window.location.reload(true);
                }

              },
              error: function() {
                $("#add_chargesbtn").button('reset');
              },
              complete: function() {
                $("#add_chargesbtn").button('reset');
              }
            });
          }));
        });
   function makeid(length) {
      var result = '';
      var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      var charactersLength = characters.length;
      for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random()*charactersLength));
      }
      return result;
    }

</script>
