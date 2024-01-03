<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
         <div class="col-md-2">
                <div class="box border0">
                    <?php $this->load->view("admin/charges/sidebar"); ?>
                </div>
            </div>
            <div class="col-md-10">
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Lista de resoluciones</h3>
                        <div class="box-tools pull-right">
                        <?php if ($this->rbac->hasPrivilege('unit_type', 'can_add')) { ?>
                            <button type="button" data-record-id="0" class="btn btn-primary btn-sm addunittype add_unit_type_modal" id="load2" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo $this->lang->line('processing') ?>"><i class="fa fa-plus"></i> Agregar resolución</button>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover ajaxlist" data-export-title="<?php echo $this->lang->line('unit_type_list'); ?>">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Resolución</th>
                                        <th>Prefijo</th>
                                        <th>Empresa</th>
                                        <th>Modalidad</th>
                                        <th>Desde</th>
                                        <th>Hasta</th>
                                        <th>Desde</th>
                                        <th>Hasta</th>
                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="">
                        <div class="mailbox-controls">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-mid" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><div id="modal_title"></div></h4>
            </div>

            <form id="formadd" action="<?php echo site_url('admin/resoluciones/add') ?>"  method="post" accept-charset="utf-8" class="ptt10">
                <input type="hidden" name="id" id="id" value="0">
                    <div class="modal-body pt0 pb0">
                      <div class="form-group">
                            <label>Empresa</label><small class="req"> *</small>
                            <input name="" id="resolucion_empresa" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('unit'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Resolución</label><small class="req"> *</small>
                            <input name="resolucion" id="resolucion" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('unit'); ?></span>
                        </div>
                      
                      <div class="form-group">
                            <label>Prefijo</label><small class="req"> *</small>
                            <input name="prefix" id="prefix" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('unit'); ?></span>
                        </div>
                      <div class="form-group">
                            <label>Desde #</label><small class="req"> *</small>
                            <input name="desde_num" id="desde_num" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('unit'); ?></span>
                        </div>
                      <div class="form-group">
                            <label>Hasta #</label><small class="req"> *</small>
                            <input name="hasta_num" id="hasta_num" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('unit'); ?></span>
                        </div>
                       <div class="form-group">
                            <label>Desde Fecha</label><small class="req"> *</small>
                            <input name="desde_fecha" id="desde_fecha" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('unit'); ?></span>
                        </div>
                      <div class="form-group">
                            <label>Hasta Fecha</label><small class="req"> *</small>
                            <input name="hasta_fecha" id="hasta_fecha" type="text" class="form-control" />
                            <span class="text-danger"><?php echo form_error('unit'); ?></span>
                        </div>
                    </div><!--./modal-body-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pull-right" id="load2" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo $this->lang->line('processing'); ?>"><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('save'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
 $(document).ready(function(){
    $('#unitModal').modal({
        backdrop: 'static',
        keyboard: false,
        show:false
    });
 });
 
 $(document).on('click','.edit_unittype',function(){
     var record_id=$(this).data('recordId');
     var btn = $(this);
     $.ajax({
          url: base_url+'admin/resoluciones/getByResId',
          type: "POST",
          data: {'id':record_id},
          dataType: 'JSON',
              beforeSend: function(){
           btn.button('loading');
           },

          success: function (data) {
              console.log(data);
         if (data.status == 0) {
                  var message = "";
                  $.each(data.error, function (index, value) {
                      message += value;
                  });
                  errorMsg(message);
              } else {
                  $('#resolucion').val(data.result.resolution);
                  $('#resolucion_empresa').val(data.result.comercial_name);
                  $('#prefix').val(data.result.prefix);
                  $('#desde_num').val(data.result.since_num);
                  $('#hasta_num').val(data.result.from_to_num);
                  $('#desde_fecha').val(data.result.since);
                  $('#hasta_fecha').val(data.result.from_to);
                  $('#id').val(data.result.id);
                  $('#unitModal').modal('show');
              }
           btn.button('reset');
          },
          error: function () {
         btn.button('reset');
          },
          complete: function(){
           btn.button('reset');
          }
            });
 });

    $(document).on('click','.addunittype',function(){
       var record_id=$(this).data('recordId');
       $('#unitModal').modal('show');
      $('#resolucion_empresa').val('CLINIVERSO SAS');
    });

    $(document).on('click','.delect_record',function(e){
        if (confirm(<?php echo "'" . $this->lang->line('delete_confirm') . "'"; ?>)) {
        var record_id=$(this).data('recordId');
          $.ajax({
                url: base_url+'admin/resoluciones/delete',
                type: "POST",
                data: {'id':record_id},
                dataType: 'JSON',
                    beforeSend: function(){ 
                 },

                success: function (data) {
                    console.log(data);
               if (data.status == 0) {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                         successMsg(data.message);

                        $('.ajaxlist').DataTable().ajax.reload();
                    } 
                },
                error: function () {

                },
                complete: function(){ 
   }
            });
}
        });

    $('#unitModal').on('hidden.bs.modal', function (e) {
     $("form#formadd").find('input:text,input:password,input:file').val('');
     $("#id").val('');
    })
    $(document).on('submit','form#formadd',function(e){

            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var btn = form.find("button[type=submit]");

            $.ajax({
                url: url,
                type: "POST",
                data: form.serialize(),
                dataType: 'JSON',
                    beforeSend: function(){
                 btn.button('loading');
                 },

                success: function (data) {
               if (data.status == 0) {
                        var message = "";
                        $.each(data.error, function (index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                         $('#unitModal').modal('hide');
                        $('.ajaxlist').DataTable().ajax.reload();
                    }
                 btn.button('reset');
                },
                error: function () {

                },
                complete: function(){
                    btn.button('reset');
                }
            });
        });

    $('.add_unit_type_modal').click(function(){
        $('#modal_title').empty();
        $('#modal_title').append('Agregar Resolución');
    })

    $(document).on('click','.edit_unit_type_modal',function(){
        $('#modal_title').empty();
        $('#modal_title').append('Editar Resolución');
    })
</script>
<script type="text/javascript">
    $('.aa').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 8000);
});
</script>
<!-- //========datatable start===== -->
<script type="text/javascript">
    $(document).ready(function () {
        initDatatable('ajaxlist','admin/resoluciones/getdatatable');
    });
</script>
<!-- //========datatable end===== -->