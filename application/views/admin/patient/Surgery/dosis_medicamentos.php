<div class="modal fade" id="myaddMedicationModal" role="dialog" aria-labelledby="myModalLabel">
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
</div>
<!-- -->
