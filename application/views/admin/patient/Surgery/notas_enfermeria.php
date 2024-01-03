


<div class="modal fade" id="add_nurse_note" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close close_button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_nurse_note') ; ?> </h4> 
            </div>

            <form id="nurse_note_form" accept-charset="utf-8" enctype="multipart/form-data" method="post">   
       
                <div class="scroll-area">
                    <div class="modal-body pb0 ptt10">
                            <input type="hidden" name="surgery_id" value="<?php echo $opdid; ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('date'); ?>
                                        <small class="req"> *</small>
                                        </label> 
                                        <input type="text" name="date" value="" class="form-control datetime">
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('nurse'); ?><small class="req"> *</small> </label>
                                        <input type="hidden" name="nurse" id="nurse_set">
                                        <select name="nurse_field" <?php 
                                        if ($disable_option == true) { echo "disabled"; } ?> style="width: 100%" id="nurse_field" class="form-control select2">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($nurse as $key => $value) { ?>
                                            <option  <?php if ((isset($nurse_select)) && ($nurse_select == $dvalue["id"])) { echo "selected"; } ?> value="<?php echo $value["id"] ?>"><?php echo composeStaffNameByString($value["name"],$value["surname"],$value["employee_id"]); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('note') ?> <small class="req"> *</small> </label>
                                        <textarea name="note" style="height:50px" class="form-control"></textarea>
                                    </div> 
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('comment'); ?> <small class="req"> *</small> </label>
                                        <textarea name="comment" style="height:50px" class="form-control"></textarea>
                                    </div> 
                                </div>
                                
                                <div class="">
                                        <?php echo display_custom_fields('ipdnursenote'); ?>
                                </div>
                            </div>
                    </div>
                </div>    
                <div class="modal-footer">    
                    <button type="submit" id="nurse_notebtn" data-loading-text="<?php echo $this->lang->line('processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                </div>  
            </form>


        </div>
    </div> 
    
</div>

<script>
   function holdModal(modalId) {
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

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
                       $('#add_nurse_note').modal('hide');
                       $('#nurse_note_form')[0].reset();
                       $('#timeline_list').load(location.href + ' #timeline_list'); 
                       successMsg(data.message);
                                                 
//                         window.location.reload(true);

                    }
                    $("#nurse_notebtn").button('reset');

                },
                error: function () {
                   
                }
            });


        }));
    });
  
  
</script>
