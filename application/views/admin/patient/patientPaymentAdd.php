<div class="modal fade" id="myPaymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_payment'); ?></h4> 
            </div>
             <form id="add_payment" accept-charset="utf-8" method="post" class="ptt10" >
                <div class="">
                    <div class="modal-body pt0 pb0">
                            <input type="hidden" name="opd_id" id="payment_opd_id" class="form-control" value="">
                            <input type="hidden" name="case_reference_id" id="payment_case_id" class="form-control" value="">
                            <input type="hidden" id="patient_id" name="patient_id" value="">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small> 
                                                
                                                <input type="text" name="payment_date" id="date" class="form-control datetime" autocomplete="off">
                                                <span class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('amount') . " (" . $currency_symbol . ")"; ?></label><small class="req"> *</small> 
                                        
                                                <input type="text" name="amount" id="amount" class="form-control" value="<?php echo number_format((float)($total-$total_payment), 2, '.', ''); ?>">  
                                                 <input type="hidden" id="net_amount" name="net_amount"  class="form-control" value="">  
                                                <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('payment_mode'); ?></label> 
                                                <select class="form-control payment_mode" name="payment_mode">

                                                <?php foreach ($payment_mode as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $key ?>" <?php
                                                    if ($key == 'cash') {
                                                        echo "selected";
                                                    }
                                                    ?>><?php echo $value ?></option>
                                                <?php } ?>
                                                </select>    
                                                <span class="text-danger"><?php echo form_error('apply_charge'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row cheque_div" style="display: none;">
                                
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('cheque_no'); ?></label><small class="req"> *</small> 
                                                <input type="text" name="cheque_no" id="cheque_no" class="form-control">
                                                <span class="text-danger"><?php echo form_error('cheque_no'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('cheque_date'); ?></label><small class="req"> *</small> 
                                                <input type="text" name="cheque_date" id="cheque_date" class="form-control date">
                                                <span class="text-danger"><?php echo form_error('cheque_date'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('attach_document'); ?></label>
                                                <input type="file" class="filestyle form-control"   name="document">
                                                <span class="text-danger"><?php echo form_error('document'); ?></span> 
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('note'); ?></label> 
                                                <input type="text" name="note" id="note" class="form-control"/>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                        </div>
                    </div>
                </div><!-- scroll-area -->  
                <div class="modal-footer">
                      <button type="submit" id="add_paymentbtn" data-loading-text="<?php echo $this->lang->line('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                </div>
             </form>              
        </div>
    </div>
 </div>
<script>
$(document).on('click','.addpayment',function(){     
       $('#myPaymentModal').modal('show');
});
 $(document).ready(function (e) {
        $("#add_payment").on('submit', (function (e) {
            e.preventDefault();         
            $.ajax({
                url: base_url+'admin/payment/addOPDPayment',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                 beforeSend: function(){
                  $("#add_paymentbtn").button("loading");
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
                        window.location.reload(true);
                    }
                    $("#add_paymentbtn").button("reset");
                },
                 error: function () {
                 $("#add_paymentbtn").button('reset');
                },
  
                complete: function(){
                 $("#add_paymentbtn").button('reset');
                }
            });
        }));
    });


</script>
