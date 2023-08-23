<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('display_custom_fields')) {

    function display_custom_fields($belongs_to, $rel_id = false, $where = array()) {
        $CI = &get_instance();
        $CI->db->from('custom_fields');
        $CI->db->where('belong_to', $belongs_to);
        $CI->db->order_by('custom_fields.weight', 'asc');
       
        $query = $CI->db->get();
        $result = $query->result_array();
        
        if($belongs_to == "opd"){
            $fields_html = display_custom_fields_opd_own($result, $belongs_to, $rel_id);
            return $fields_html;
            
        }else{
            $fields_html = '';
            foreach ($result as $result_key => $field) {
                $fields_html .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);
            }
        }

        if($belongs_to == "patient"){
            $fields_html = display_custom_fields_patient_own($result, $belongs_to, $rel_id);
        }else{
            $fields_html = '';
            foreach ($result as $result_key => $field) {
                $fields_html .= builder_custom_fields_patient_own($field, $belongs_to, $rel_id);
            }
        }
        
        return $fields_html;
    }
    
    function display_custom_fields_patient_own($result, $belongs_to, $rel_id){
        $html = ["location"=>'',"contact"=>'',"membership"=>''];
        
        
        foreach ($result as $result_key => $field) {
                $field['bs_column'] = ($field['bs_column']*2);
                    
                if($field['block'] == "location"){
                    $html["location"] .= builder_custom_fields_patient_own($field, $belongs_to, $rel_id); 
                }elseif($field['block'] == "contact"){
                    $html["contact"] .= builder_custom_fields_patient_own($field, $belongs_to, $rel_id);  
                }else{
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["membership"] .= builder_custom_fields_patient_own($field, $belongs_to, $rel_id);    
                }

        }
        $fields_html = '<style>
                          .base_head {
                                border-radius:10px !important;
                                background-color:#1563b0 !important;
                                margin-bottom:5px;
                                border-radius:8px;
                                padding: 6px;
                                color:#fff !important;
                            }
                            
                            .input-group .input-group-addon {
                                 color:#1563b0;}

                        </style>
                        <div>
                            <div class="row" style="margin-top:20px;">
                                <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="base_head col-sm-4 border border-primary">
                                        <h4 class="card-title text-center" style="color:#fff;margin:0px">Ubicación <i class="fa fa-map-marker"></i></h4>
                                    </div><div class="col-sm-4"></div></div><hr>
                                    <div class="row" style="border: solid #011E38 1px;margin: 5px;border-radius: 13px;padding: 7px;">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">Departamento</label>
                                            <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                              <i class="fa fa-map-marker"></i>
                                            </span>
                                            <select  onchange="send_department(`add`)" id="departamento" name=""  class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                            </select>
                                            <span class="text-danger"></span>
                                             </div>
                                            </div>
                                          </div>
                                          
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="control-label">Municipio</label>
                                                <div class="input-group">
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                  <i class="fa fa-map-marker"></i>
                                                </span>
                                                <select id="municipio"  onchange="enter_ubication(`add`)" name="" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                                  </select>
                                                <span class="text-danger"></span>
                                               </div>
                                              </div>
                                           </div>
                                           <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="control-label">Departamento</label>
                                                <div class="input-group">
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                  <i class="fa fa-map-marker"></i>
                                                </span>
                                                <select  onchange="send_department(`edit`)" id="departamento_edit" name=""  class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                                </select>
                                                <span class="text-danger"></span>
                                                 </div>
                                                </div>
                                              </div>
                                          
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="control-label">Municipio</label>
                                                <div class="input-group">
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                  <i class="fa fa-map-marker"></i>
                                                </span>
                                                <select id="municipio_edit" onchange="enter_ubication(`edit`)" name="" class="form-control" style="border-radius: 0px 10px 10px 0px !important;">
                                                  </select>
                                                <span class="text-danger"></span>
                                               </div>
                                              </div>
                                           </div>
                                           
                                    '.$html["location"].'
                                     
                                    </div>
                                    </div>
                                    
                                    </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="base_head  col-sm-4 border border-primary" style="background-color: #1563b0; margin:5px;border-radius:8px;padding: 6px;">
                                        <h4 class="card-title text-center" style="color:#fff;margin: 0px;">Contacto <i class="fa fa-phone"></i></h4>
                                    </div><div class="col-sm-4"></div></div><hr>
                                    <div class="row" style="border: solid #011E38 1px;margin: 5px;border-radius: 13px;padding: 7px;">'.$html["contact"].' </div></div>
                            </div>
                            <div class="col-sm-12">
                            <div class="row" style="margin-top:10px; margin-bottom:10px;">
                            <div class="col-sm-5"></div>
                                <div class="base_head col-sm-2 border border-primary">
                                    <h4 class="card-title text-center" style="color:#fff;margin: 0px;">Afiliación <i class="fa fa-folder-open"></i></h4>
                                </div><div class="col-sm-5"></div></div><hr>
                            <div class="row" style="border: solid #011E38 1px;margin: 5px;border-radius: 13px;padding: 7px;">'.$html["membership"].'</div></div>
                        </div>';
        return $fields_html;
    }

    function builder_custom_fields_patient_own($field, $belongs_to, $rel_id){
        
        $type = $field['type'];

        $label = ucfirst($field['name']);
        
        $field_name = 'custom_fields[' . $field['belong_to'] . '][' . $field['id'] . ']';
        if ($field['bs_column'] == '' || $field['bs_column'] == 0) {
            $field['bs_column'] = 12;
        }
        $input_class = "";
        $value = "";
        if ($rel_id !== false) {
            $return_value = get_custom_field_value($rel_id, $field['id'], $belongs_to);
            if (!empty($return_value)) {
                $value = $return_value->field_value;
            }
        }
        
        $fields_html = '<div class="col-md-' . $field['bs_column'] . '">';
        if ($field['type'] == 'input' || $field['type'] == 'number') {
            $type = $field['type'] == 'input' ? 'text' : 'number';
            $fields_html .= render_input_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'textarea') {
            $fields_html .= render_textarea_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'select') {
            $options = optionSplit($field['field_values']);
            $fields_html .= render_select_field($field_name, $options, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'multiselect') {
            $options = optionSplit($field['field_values']);
            $fields_html .= render_multiselect_field($field_name, $options, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'checkbox') {
            $options = optionSplit($field['field_values']);
            $fields_html .= render_checkbox_field($field_name, $options, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'date_picker') {
            $type = $field['type'];
            $fields_html .= render_date_picker_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'date_picker_time') {
            $type = $field['type'];
            $fields_html .= render_date_picker_time_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'colorpicker') {
            $type = $field['type'];
            $fields_html .= render_colorpicker_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'link') {
            $type = $field['type'];
            $fields_html .= render_link_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'file') {
            $type = $field['type'];
            $fields_html .= render_file_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class, $rel_id);
        }
        $fields_html .= '</div>';
        
        return $fields_html;
    }
    
    function builder_custom_fields_opd_own($field, $belongs_to, $rel_id){
        
        $type = $field['type'];

        $label = ucfirst($field['name']);
        
        $field_name = 'custom_fields[' . $field['belong_to'] . '][' . $field['id'] . ']';
        if ($field['bs_column'] == '' || $field['bs_column'] == 0) {
            $field['bs_column'] = 12;
        }
        $input_class = "";
        $value = "";
        if ($rel_id !== false) {
            $return_value = get_custom_field_value($rel_id, $field['id'], $belongs_to);
            if (!empty($return_value)) {
                $value = $return_value->field_value;
            }
        }
        
        $fields_html = '<div class="col-md-' . $field['bs_column'] . '">';
        if ($field['type'] == 'input' || $field['type'] == 'number') {
            $type = $field['type'] == 'input' ? 'text' : 'number';
            $fields_html .= render_input_field_opd($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'textarea') {
            $fields_html .= render_textarea_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'select') {
            $options = optionSplit($field['field_values']);
            $fields_html .= render_select_field_opd($field_name, $options, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'multiselect') {
            $options = optionSplit($field['field_values']);
            $fields_html .= render_multiselect_field($field_name, $options, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'checkbox') {
            $options = optionSplit($field['field_values']);
            $fields_html .= render_checkbox_field($field_name, $options, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'date_picker') {
            $type = $field['type'];
            $fields_html .= render_date_picker_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'date_picker_time') {
            $type = $field['type'];
            $fields_html .= render_date_picker_time_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'colorpicker') {
            $type = $field['type'];
            $fields_html .= render_colorpicker_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'link') {
            $type = $field['type'];
            $fields_html .= render_link_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
        } elseif ($field['type'] == 'file') {
            $type = $field['type'];
            $fields_html .= render_file_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class, $rel_id);
        }
        $fields_html .= '</div>';
        
        return $fields_html;
    }
    
    function display_custom_fields_opd_own($result, $belongs_to, $rel_id){
         $html = ["motivo_consulta"=>'',"revision_sistemas"=>'',"fisico"=>'',"antecedentes"=>''];
        
        
        foreach ($result as $result_key => $field) {
                $field['bs_column'] = ($field['bs_column']*2);
                    
                if($field['block'] == "motivo_consulta"){
                    $html["motivo_consulta"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id); 
                }elseif($field['block'] == "revision_sistemas"){
                    $html["revision_sistemas"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }elseif($field['block'] == "antecedentes"){
                    $html["antecedentes"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id); 
                }elseif($field['block'] == "fisico"){
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["fisico"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);    
                }elseif($field['block'] == "fisico_vitales"){
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["fisico_vitales"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }elseif($field['block'] == "fisico_vitales_presion"){
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["fisico_vitales_presion"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }elseif($field['block'] == "fisico_vitales_temp"){
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["fisico_vitales_temp"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }elseif($field['block'] == "diagnostico"){
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["diagnostico"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }elseif($field['block'] == "EnfermedadActual"){
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["EnfermedadActual"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }elseif($field['block'] == "analisis"){
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["analisis"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }elseif($field['block'] == "plan"){
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["plan"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }elseif($field['block'] == "causaExterna"){
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["causaExterna"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }else{
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["fisico_antro"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }

        }
        $fields_html = '<style>
                          .panel-default>.panel-heading {
                                border-radius:10px !important;
                                background-color:#cbcaca !important;
                                color:#fff;
                            }
                            
                            .modal-header {
                                background: linear-gradient(to right,#100f0f96 ,#bbabab, #100f0f96 100%) !important;
                            }
                            
                            .modal-header h4 {
                                color: #f7f2f2 !important;
                            }
                            
                            .panel-default>.panel-heading {
                                border-radius: 10px !important;
                                background: linear-gradient(to right,#777373 ,#a59d9d, #aeafaf 100%) !important;
                                color: #fff;
                            }
                            
                            .btn {
                                /* background-color: #cbcaca !important; */
                                border-color: #1563b0;
                                /* color: #fff; */
                            }

                        </style>
                              <div>
                                <div class="row">
                                            <div class="col-sm-12"> 
                                                <div id="accordion2" class="panel-group" style="margin:15px 20px;">
                                                     <div class="panel panel-default" style="border-radius:20px;">
                                                            <div class="panel-heading" style="border-radius:10px;background-color:#a2cddf">
                                                                <h4 class="panel-title">
                                                                    <a class=""  style="color:#fff;" role="button" data-toggle="collapse" data-parent="#accordion2" href="#mot_consul_sistemas" aria-expanded="true" aria-controls="mot_consul_sistemas">
                                                                    <i class="more-less fa fa-minus" style="color:#1563b0;" ></i>
                                                                    Motivo de Consulta</a>

                                                                </h4>
                                                            </div>
                                                            <div id="mot_consul_sistemas" class="panel-collapse collapse in" aria-expanded="true">
                                                                <div class="panel-body">
                                                                    <div class="">
                                                                        <div class="col-sm-4"></div>
                                                                    </div>
                                                                    <div class="row" style="margin: 0px 0px;padding: 7px;">
                                                                        <div class="row" style="border:margin: 25px 0px;padding: 3px;">
                                                                            <div class="row" style="display: flex;justify-content: center;">
                                                                            </div>
                                                                            '.$html["motivo_consulta"].'
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div>
                                               </div>
                                           </div>
                                           
                                           
                                           
                                        <div class="row">
                                            <div class="col-sm-12"> 
                                                <div id="accordionenferact" class="panel-group" style="margin:15px 20px;">
                                                     <div class="panel panel-default" style="border-radius:20px;">
                                                            <div class="panel-heading" style="border-radius:10px;background-color:#a2cddf">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed"  style="color:#fff;" role="button" data-toggle="collapse" data-parent="#accordionenferact" href="#enferact" aria-expanded="true" aria-controls="mot_consul_sistemas">
                                                                    <i class="more-less fa fa-plus" style="color:#1563b0;" ></i>
                                                                    Enfermedad Actual</a>
                                                                </h4>
                                                            </div>
                                                            <div id="enferact" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class="">
                                                                        <div class="col-sm-4"></div>
                                                                    </div>
                                                                    <div class="row" style="margin: 15px 0px;padding: 3px;">
                                                                        <div class="row" style="margin: 0px;padding: 0px;">
                                                                            <div class="row" style="display: flex;justify-content: center;">
                                                                            </div>
                                                                            '.$html["EnfermedadActual"].'
                                                                        </div>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div>
                                               </div>
                                           </div>   
                                           
                                           
                                           
                                        <div class="row">
                                            <div class="col-sm-12"> 
                                                <div id="accordion8" class="panel-group" style="margin:15px 20px;">
                                                     <div class="panel panel-default" style="border-radius:20px;">
                                                            <div class="panel-heading" style="border-radius:10px;background-color:#a2cddf">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed"  style="color:#fff;" role="button" data-toggle="collapse" data-parent="#accordion8" href="#mot_sistemas" aria-expanded="true" aria-controls="mot_consul_sistemas">
                                                                    <i class="more-less fa fa-plus" style="color:#1563b0;" ></i>
                                                                    Revisión por Sistemas</a>
                                                                </h4>
                                                            </div>
                                                            <div id="mot_sistemas" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class="">
                                                                        <div class="col-sm-4"></div>
                                                                    </div>
                                                                    <div class="row" style="margin: 15px 0px;padding: 3px;">
                                                                        <div class="row" style="margin: 0px;padding: 0px;">
                                                                            <div class="row" style="display: flex;justify-content: center;">
                                                                            </div>
                                                                            '.$html["revision_sistemas"].'
                                                                        </div>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div>
                                               </div>
                                           </div>                  
                                               
                                
                                        
                                            <div class="row">
                                            <div class="col-sm-12">
                                                
                                                 <div id="accordion3" class="panel-group" style="margin:15px 20px;">
                                                     <div class="panel panel-default" style="border-radius:20px;">
                                                            <div class="panel-heading" style="border-radius:10px;background-color:#a2cddf; color:#444;">
                                                                <h4 class="panel-title" style="color:#444;">
                                                                    <a class="collapsed" style="color:#fff;" role="button" data-toggle="collapse" data-parent="#accordion2" href="#antecedentes" aria-expanded="false" aria-controls="collapseExample6">
                                                                    <i class="more-less fa fa-plus" style="color:#1563b0;"></i>
                                                                    Antecedentes</a>
                                                                </h4>
                                                            </div>
                                                            <div id="antecedentes" class="panel-collapse collapse">
                                                                <div class="panel-body" >
                                                                    <div class="">
                                                                        <div class="col-sm-4"></div>
                                                                    </div>
                                                                    <div class="row" style="margin: 0px 0px;padding: 7px;">
                                                                        <div class="row" style="border:margin: 25px 0px;padding: 3px;">
                                                                            <div class="row" style="display: flex;justify-content: center;">
                                                                            </div>
                                                                            '.$html["antecedentes"].'
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div>
                                               </div>
                                           </div>
                                            <div class="row">
                                    
                                            <div class="col-sm-12">
                                                
                                                
                                                <div id="accordion" class="panel-group" style="margin:15px 20px;">
                                                     <div class="panel panel-default" style="border-radius:20px;">
                                                            <div class="panel-heading" style="border-radius:10px;background-color:#a2cddf">
                                                                <h4 class="panel-title" >
                                                                    <a class="collapsed" style="color:#fff;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseExample6" aria-expanded="false" aria-controls="collapseExample6">
                                                                    <i class="more-less fa fa-plus" style="color:#1563b0;"></i>
                                                                    Examén Físico</a>
                                                                </h4>
                                                            </div>
                                                            
                                                            <div id="collapseExample6" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class="">
                                                                        <div class="col-sm-4"></div>
                                                                    </div>
                                                                    <div class="row" style="margin: 0px 0px;padding: 7px;">
                                                                            <div class="row" style="margin: 0px;padding: 0px;">
                                                                                <div class="row" style="display: flex;justify-content: center;">
                                                                                    <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                                                                        <b>Medidas Antropométricas</b>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row" style="display: flex;justify-content: center;align-items: end;">
                                                                                '.$html["fisico_antro"].' 
                                                                                </div>
                                                                            </div>
                                                                            <div class="row" style="margin: 0px;padding: 0px;">
                                                                                <div class="row" style="display: flex;justify-content: center;">
                                                                                    <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                                                                        <b>Signos Vitales</b>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row" style="display: flex;justify-content: center;align-items: end;">
                                                                                '.$html["fisico"].' '.$html["fisico_vitales_temp"].' '.$html["fisico_vitales"].' 
                                                                                </div>
                                                                            </div>
                                                                     
                                                                            <div class="row" style="margin: 0px;padding: 0px;">
                                                                                <div class="row" style="display: flex;justify-content: center;">
                                                                                    <div class="col-3 text-primary mb-3" style="padding:15px;font-size:19px;font-weight: bold;">
                                                                                        <b>Presión Arterial</b>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row" style="display: flex;justify-content: center;align-items: end;">
                                                                                '.$html["fisico_vitales_presion"].' 
                                                                                </div>
                                                                            </div>
                                                                     </div>
                                                                     
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                     </div>
                                               </div>
                                               <div class="row">
                                                <div class="col-sm-12">
                                                <div id="accordion10" class="panel-group" style="margin: 15px 20px;">
                                                     <div class="panel panel-default" style="border-radius:20px;">
                                                            <div class="panel-heading" @click="cie_structure()" >
                                                                <h4 class="panel-title" style="color:#444;">
                                                                    <a class="collapsed" style="color:#fff;" role="button" data-toggle="collapse" data-parent="#accordion10" href="#diagnostico" aria-expanded="false" aria-controls="collapseExample6">
                                                                    <i class="more-less fa fa-plus" style="color:#1563b0;"></i>
                                                                    Diagnóstico</a>
                                                                </h4>
                                                            </div>
                                                            <div id="diagnostico" class="panel-collapse collapse">
                                                                <div class="panel-body" >
                                                                    
                                                                    <div class="row" style="margin: 0px 0px;padding: 7px;">
                                                                        <div class="row" style="border:margin: 25px 0px;padding: 3px;">
                                                                            <div class="row" style="justify-content: center;margin-bottom:30px;">
                                                                              <div class="col-md-12">
                                                                                <div class="col-md-12" style="margin-top:5px;max-height:300px; overflow: auto;">
                                                                                    <input id="searchFilter" onkeyup="filter2()" value="" name="second_diag" type="text" class="form-control" placeholder="Búsqueda de diagnóstico" ;></input>
                                                                                </div>
                                                                                <div class="usersearchlist col-md-12" style="margin-top:5px;max-height:300px; overflow: auto;">
                                                                                      <ul class="list-group scroll-container mb-3" id="lista2" hidden>        
                                                                                      </ul>
                                                                                 </div>
                                                                              </div> 
                                                                            </div>
                                                                            '.$html["diagnostico"].'
                                                                        </div>
                                                                        <div class="row" style="border:margin: 25px 0px;padding: 3px;">
                                                                          <div class="col-md-12" style="margin:35px -9px;">
                                                                              <div class="pull-right">
                                                                                      <button type="button" onclick="removeratr(`primario`)" class="btn btn-success pull-right" autocomplete="off"><i class="fa fa-plus"></i>  Diagnósticos</button>
                                                                                  </div> 
                                                                              </div>
                                                                        </div>
                                                                        <div id= "new_diag" class="row" style="border:margin: 25px 0px;padding: 3px;" hidden>
                                                                              <div class="col-md-9">
                                                                                <label>Otros diagnósticos</label>
                                                                                <input id="second_diag" onkeyup="filter()" value="" name="second_diag" type="text" class="form-control" placeholder="Otros diagnósticos"></input>
                                                                                <div class="usersearchlist" style="margin-top:5px;max-height:300px; overflow: auto;">
                                                                                    <ul class="list-group scroll-container mb-3" id="lista_second" hidden>        
                                                                                    </ul>
                                                                               </div>
                                                                              </div>
                                                                              <div class="col-md-3">
                                                                              <div class="form-group">
                                                                              <label for="" class="control-label">Tipo de diagnóstico</label>
                                                                                <select id="second_diag_confirm" class="form-control">
                                                                                  <option selected>Tipo de diagnóstico</option>
                                                                                  <option value="Impresión Diagnóstica">Impresión Diagnóstica</option>
                                                                                  <option value="Confirmado Nuevo">Confirmado Nuevo</option>
                                                                                  <option value="Confirmado Repetido">Confirmado Repetido</option>
                                                                                </select>
                                                                                </div>
                                                                              </div>
                                                                              <div class="col-md-12">
                                                                                <label>Nota otros diagnósticos</label>
                                                                                <textarea id="second_diag_text" type="text" class="form-control" placeholder="Otros diagnósticos"></textarea>
                                                                              </div>
                                                                              
                                                                              <div class="col-md-12" style="margin:35px -9px;">
                                                                              <div class="pull-right">
                                                                                      <button type="button" onclick="removeratr(`secundario`)" class="btn pull-right" autocomplete="off"><i class="fa fa-check-circle"></i> Guardar</button>
                                                                                  </div> 
                                                                              </div>
                                                                        </div>
                                                                         
                                                                        <div id="table_new" class="row" style="border:margin: 25px 0px;padding: 3px;" hidden>
                                                                              <div class="col-md-12">
                                                                                <div class="table-responsive mailbox-messages">
                                                                                  <table class="table table-hover table-striped">
                                                                                      <thead>
                                                                                          <tr>
                                                                                              <th> Codigo</th>
                                                                                              <th>Diagnóstico</th>
                                                                                              <th>Nota</th>
                                                                                              <th>Opciones</th>
                                                                                          </tr>
                                                                                      </thead>
                                                                                      <tbody id="table_diag">
                                                                                        
                                                                                       </tbody>
                                                                                  </table>
                                                                              </div>
                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div>
                                               </div>
                                           </div>
                                           
                                           <div class="row">
                                                <div class="col-sm-12">
                                                <div id="causaExternaFinalidad10" class="panel-group" style="margin: 15px 20px;">
                                                     <div class="panel panel-default" style="border-radius:20px;">
                                                            <div class="panel-heading" @click="cie_structure()" style="border-radius:10px;background-color:#a2cddf; color:#444;">
                                                                <h4 class="panel-title" style="color:#444;">
                                                                    <a class="collapsed" style="color:#fff;" role="button" data-toggle="collapse" data-parent="#causaExternaFinalidad10" href="#Finalidad10" aria-expanded="false" aria-controls="collapseExample6">
                                                                    <i class="more-less fa fa-plus" style="color:#1563b0;"></i>
                                                                    Causa externa y finalidad</a>
                                                                </h4>
                                                            </div>
                                                            <div id="Finalidad10" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class="">
                                                                        <div class="col-sm-4"></div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="" class="control-label">Búsqueda Causa Externa</label>
                                                                            
                                                                            <select id="causaExterna" class="form-control" onchange="causaexterna()"">
                                                                                  <option value="" selected>Seleccione Causa Externa</option>
                                                                                  <option value="Accidente de trabajo">Accidente de trabajo</option>
                                                                                  <option value="Accidente de tránsito">Accidente de tránsito</option>
                                                                                  <option value="Accidente ofídico">Accidente ofídico</option>
                                                                                  <option value="Otro tipo de accidente">Otro tipo de accidente</option>
                                                                                  <option value="Evento catastrófico">Evento catastrófico</option>
                                                                                  <option value="Lesión por agresión">Lesión por agresión</option>
                                                                                  <option value="Otra">Otra</option>
                                                                                  <option value="Sospecha de maltrato físico">Sospecha de maltrato físico</option>
                                                                                  <option value="Sospecha de abuso sexual">Sospecha de abuso sexual</option>
                                                                                  <option value="Sospecha de maltrato emocional">Sospecha de maltrato emocional</option>
                                                                                  <option value="Lesión auto infligida">Lesión auto infligida</option>
                                                                                </select>
                                                                            <span class="text-danger"></span>
                                                                            </div>
                                                                        </div>
                                                                    <div class="row" style="margin: 0px 0px;padding: 7px;">
                                                                        <div class="row" style="border:margin: 25px 0px;padding: 3px;">
                                                                            <div class="row" style="display: flex;justify-content: center;margin-bottom:30px;">
                                                                            
                                                                           </div>
                                                                            '.$html["causaExterna"].'
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div>
                                               </div>
                                           </div>
                                           
                                           <div class="row">
                                            <div class="col-sm-12"> 
                                                <div id="accordionana" class="panel-group" style="margin:15px 20px;">
                                                     <div class="panel panel-default" style="border-radius:20px;">
                                                            <div class="panel-heading" style="border-radius:10px;background-color:#a2cddf">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed"  style="color:#fff;" role="button" data-toggle="collapse" data-parent="#accordionana" href="#ana" aria-expanded="true" aria-controls="mot_consul_sistemas">
                                                                    <i class="more-less fa fa-plus" style="color:#1563b0;" ></i>
                                                                    Análisis</a>
                                                                </h4>
                                                            </div>
                                                            <div id="ana" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class="">
                                                                        <div class="col-sm-4"></div>
                                                                    </div>
                                                                    <div class="row" style="margin: 15px 0px;padding: 3px;">
                                                                        <div class="row" style="margin: 0px;padding: 0px;">
                                                                            <div class="row" style="display: flex;justify-content: center;">
                                                                            </div>
                                                                            '.$html["analisis"].'
                                                                        </div>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div>
                                               </div>
                                           </div>  
                                           
                                           <div class="row">
                                            <div class="col-sm-12"> 
                                                <div id="accordionplan" class="panel-group" style="margin:15px 20px;">
                                                     <div class="panel panel-default" style="border-radius:20px;">
                                                            <div class="panel-heading" style="border-radius:10px;background-color:#a2cddf">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed"  style="color:#fff;" role="button" data-toggle="collapse" data-parent="#accordionplan" href="#mot_plan" aria-expanded="true" aria-controls="mot_consul_sistemas">
                                                                    <i class="more-less fa fa-plus" style="color:#1563b0;" ></i>
                                                                    Plan</a>
                                                                </h4>
                                                            </div>
                                                            <div id="mot_plan" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class="">
                                                                        <div class="col-sm-4"></div>
                                                                    </div>
                                                                    <div class="row" style="margin: 15px 0px;padding: 3px;">
                                                                        <div class="row" style="margin: 0px;padding: 0px;">
                                                                            <div class="row" style="display: flex;justify-content: center;">
                                                                            </div>
                                                                            '.$html["plan"].'
                                                                        </div>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div>
                                               </div>
                                           </div>  
                                           
                                        </div>
                                    </div> 
                                </div>
                            </div>';
//         echo ($fields_html);
        return $fields_html;
    }
        
//     function display_custom_fields_patient($belongs_to, $rel_id = false, $where = array()) {
//         $CI = &get_instance();
//         $CI->db->from('custom_fields');
//         $CI->db->where('belong_to', $belongs_to);
//         $CI->db->order_by('custom_fields.belong_to', 'asc');
        
//         $query = $CI->db->get();
//         $result = $query->result_array();
//         $fields_html = '';

//         foreach ($result as $result_key => $field) {
//             $type = $field['type'];
//             if($field['visible_on_patient_panel'] == 0){
//                 continue;
//             }

//             $label = ucfirst($field['name']);
//             $field_name = 'custom_fields[' . $field['belong_to'] . '][' . $field['id'] . ']';
//             if ($field['bs_column'] == '' || $field['bs_column'] == 0) {
//                 $field['bs_column'] = 12;
//             }
//             $input_class = "";
//             $value = "";
//             if ($rel_id !== false) {

//                 $return_value = get_custom_field_value($rel_id, $field['id'], $belongs_to);
//                 if (!empty($return_value)) {
//                     $value = $return_value->field_value;
//                 }
//             }

//             $fields_html .= '<div class="col-md-' . $field['bs_column'] . '">';
//             if ($field['type'] == 'input' || $field['type'] == 'number') {
//                 $type = $field['type'] == 'input' ? 'text' : 'number';
//                 $fields_html .= render_input_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
//             } elseif ($field['type'] == 'textarea') {
//                 $fields_html .= render_textarea_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
//             } elseif ($field['type'] == 'select') {
//                 $options = optionSplit($field['field_values']);
//                 $fields_html .= render_select_field($field_name, $options, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
//             } elseif ($field['type'] == 'multiselect') {
//                 $options = optionSplit($field['field_values']);
//                 $fields_html .= render_multiselect_field($field_name, $options, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
//             } elseif ($field['type'] == 'checkbox') {
//                 $options = optionSplit($field['field_values']);
//                 $fields_html .= render_checkbox_field($field_name, $options, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
//             } elseif ($field['type'] == 'date_picker') {
//                 $type = $field['type'];
//                 $fields_html .= render_date_picker_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
//             } elseif ($field['type'] == 'date_picker_time') {
//                 $type = $field['type'];
//                 $fields_html .= render_date_picker_time_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
//             } elseif ($field['type'] == 'colorpicker') {
//                 $type = $field['type'];
//                 $fields_html .= render_colorpicker_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
//             } elseif ($field['type'] == 'link') {
//                 $type = $field['type'];
//                 $fields_html .= render_link_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
//             } elseif ($field['type'] == 'file') {
//                 $type = $field['type'];
//                 $fields_html .= render_file_field($field_name, $field['belong_to'], $field['id'], $field['validation'], $label, $value, $type, $input_class);
//             }
//             $fields_html .= '</div>';
//         }
//         return $fields_html;
//     }

    function render_input_field($name, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {

        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';

        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }
      
        if($name=='custom_fields[patient][4]' || $name=='custom_fields[patient][5]'){
          $input .= '<div class="form-group" style="display:none">';
        }else{
          $input .= '<div class="form-group">';
        }

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
      
        if($name=='custom_fields[patient][5]' 
           || $name=='custom_fields[patient][25]' 
           || $name=='custom_fields[patient][4]')
        {
          $input .='<div class="input-group">
                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                            <i class="fa fa-map-marker"></i>
                        </span>';
        }
        if($name=='custom_fields[patient][11]' 
           || $name=='custom_fields[patient][15]' 
           || $name=='custom_fields[patient][30]')
        {
          $input .='<div class="input-group">
                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                            <i class="fa fa-phone"></i>
                        </span>';
        }
        if($name=='custom_fields[patient][7]'){
          $input .='<div class="input-group">
                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                            <i class="fa fa-users"></i>
                        </span>';
        }
        if($name=='custom_fields[patient][66]'){
          $input .='<div class="input-group">
                        <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                            <i class="fa fa-hospital-o"></i>
                        </span>';
        }
      
        $input .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" style="border-radius: 0px 10px 10px 0px !important;">';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';
        if($name=='custom_fields[patient][5]' 
           || $name=='custom_fields[patient][25]' 
           || $name=='custom_fields[patient][11]' 
           || $name=='custom_fields[patient][15]' 
           || $name=='custom_fields[patient][30]' 
           || $name=='custom_fields[patient][7]' 
           || $name=='custom_fields[patient][12]' 
           || $name=='custom_fields[patient][66]' 
           || $name=='custom_fields[patient][4]')
        {
          $input .='</div>';
        }

        return $input;
    }
    
    function render_input_field_opd($name, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {
//         print_r($name);
//         exit;
        
        
        if($name=='custom_fields[opd][70]'){
            
            $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }

            $input .= '<div id="arl_cause" class="form-group" hidden>';

            if ($label != '') {
                $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
            }
            if ($validation) {
                $input .= "<small class='req'> *</small>";
            }
            $input .= '<input type="' . $type . '" id="searchFilter" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' placeholder="¿Cuál?">';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>';
            
            return $input;
            
        }
        
        if($name=='custom_fields[opd][59]'){
            
            $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }

            $input .= '<div class="form-group">';

            if ($label != '') {
                $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
            }
            if ($validation) {
                $input .= "<small class='req'>*</small>";
            }
            $input .= '<input type="' . $type . '" id="'.$name.'" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" " >';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>';
            
            return $input;
            
        }
        
        if($name=='custom_fields[opd][19]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }
            $input .= '<div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                            <div class="col-2">
                                <label for="' . $name . '" class="control-label">
                                    <b>' . $label . '</b>
                                    <small class="req"> *</small>
                                </label>';

            if ($label != '') {
                $input .= '</div>';
            }
            if ($validation) {
                $input .= '<div class="row" style="display: flex;padding:0px 29px 15px 8px;align-items: baseline;">';
                
                $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                                    <i class="fa fa-tags"  style="color:#337ab7;"></i>
                                                </span> ';
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <input type="' . $type . '"  style="border-radius: 0px 10px 10px 0px !important;" onchange="imc()" id="talla_custom" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="">
                       </div>
                    </div>
                </div>
                       &nbsp;
                       <div class="col-2" style="margin-bottom:4px;"> 
                            <b><span>Cm</span></b>
                        </div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div></div>';
            return $input;
            
        }
        
        
        if($name=='custom_fields[opd][44]' || 
           $name=='custom_fields[opd][45]' ){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }
            $input .= '<div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                            <div class="col-2">
                                <label for="' . $name . '" class="control-label">
                                    <b>' . $label . 'hola1 </b>
                                    <small class="req"> *</small>
                                </label>';

            if ($label != '') {
                $input .= '</div>';
            }
            if ($validation) {
                $input .= '<div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                    <i class="fa fa-heart"  style="color:#337ab7;"></i>
                                </span>';
                            
            $input .=  '<input  type="' . $type . '" style="border-radius: 0px 10px 10px 0px !important;  id="' . $name . '"   name="' . $name . '"   class="form-control ' . $input_class . '"  ' . $_input_attrs . ' value="' . $value . '" placeholder="">    
                            </diV>
                        </div>&nbsp;
                            <div class="col-2" style="margin-bottom:4px;">
                                <b><span> mmHg </span></b>
                            </div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>
                    </div>';
            return $input;
            
        }
        
        if($name=='custom_fields[opd][36]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }

            $input .= '<div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                            <div class="col-2">
                                <label for="' . $name . '" class="control-label">
                                    <b>' . $label . '</b>
                                    <small class="req"> *</small>
                                </label>';

            if ($label != '') {
                $input .= '</div>';
            }
            if ($validation) {
                $input .= '<div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                    <i class="fas fa-download"  style="color:#337ab7;"></i>
                                </span>';
            
             $input .='<input type="' . $type . '" onchange="imc()" style="border-radius: 0px 10px 10px 0px !important;" id="peso_custom" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="">
                       </div>
                        </div>
                            &nbsp; 
                        <div class="col-2" style="margin-bottom:4px;">
                            <b><span> Kg </span></b>
                        </div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>
                    </div>';


            return $input;
            
        }
        if($name=='custom_fields[opd][18]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }

            $input .= '<div style="margin: 0px 0px 15px 0px;font_size:15px;" class="col-12">
                            <div class="col-2"><label for="' . $name . '" class="control-label">
                                <b>' . $label . '</b>
                                <small class="req"> *</small>
                            </label>';

            if ($label != '') {
                $input .= '</div>';
            }
            if ($validation) {
                $input .= '<div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';
            }
            
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                    <i class="fa fa-edit"  style="color:#337ab7;"></i>
                                </span>';
            
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <input type="' . $type . '" id="imc_custom" style="border-radius: 0px 10px 10px 0px !important;"  name="' .$name. '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="" disabled>
                        </div>
                        </div>';
                        

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>
                    </div>';
            return $input;
            
        }
        if($name=='custom_fields[opd][37]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }

            $input .= '<div style="margin: -4px 0px;font_size:15px;" class="col-12">
                            <div class="row" style="padding:0px 25px 18px 25px;">';

            if ($label != '') {
                $input .= '<div class="row">
                                <div class="col-4">
                                    <label for="' . $name . '" class="control-label">
                                        <b>' . $label . '</b>
                                    </label>
                                </div>';
            }
            if ($validation) {
                $input .= "<div class='col-2'>
                            <small class='req'> *</small>
                            </div>
                        </div>";
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                    <i class="fa fa-external-link-square"  style="color:#337ab7;"></i>
                                </span>';
            $input .= '<div class="row">
                            <div class="col-12">
                               <input style="border-radius: 0px 10px 10px 0px !important;" style="width: -webkit-fill-available;" type="' . $type . '" id="clasified_custom" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="" disabled>
                           </div>
                        </div>
                        </div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>
                    </div>
                </div>';
            return $input;
            
        }
        if($name=='custom_fields[opd][38]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }
            $input .= '<div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                            <div class="col-2">
                                <label for="' . $name . '" class="control-label">
                                    <b>' . $label . '</b>
                                    <small class="req"> *</small>
                                </label>';

            if ($label != '') {
                $input .= '</div>';
            }
            if ($validation) {
                $input .= '<div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                    <i class="fas fa-heart"  style="color:#337ab7;"></i>
                                </span>';
            
            $input .= '<div class="col-4" style="width: -webkit-fill-available;">
                            <input type="' . $type . '" id="' . $name . '"  style="border-radius: 0px 10px 10px 0px !important;" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="">
                        </div>
                    </div>
                </div>
                            &nbsp;
                        <div class="col-2" style="margin-bottom:4px;"> 
                            <b><span>LPM</span></b>
                        </div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>
                    </div>';
            return $input;
            
        }
        if($name=='custom_fields[opd][49]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }
            $input .= '<div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                            <div class="col-2">
                                <label for="' . $name . '" class="control-label">
                                    <b>' . $label . '</b>
                                    <small class="req"> *</small>
                                </label>';

            if ($label != '') {
                $input .= '</div>';
            }
            if ($validation) {
                $input .= '<div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                    <i class="fas fa-thermometer"  style="color:#337ab7;"></i>
                                </span>';
            
            $input .= '<div class="col-4" style="width: -webkit-fill-available;">
                            <input type="' . $type . '" id="' . $name . '"  style="border-radius: 0px 10px 10px 0px !important;" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="">
                        </div>
                    </div>
                </div>
                            &nbsp;
                        <div class="col-2" style="margin-bottom:4px;"> 
                            <b><span>LPM</span></b>
                        </div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>
                    </div>';
            return $input;
            
        }
        if($name=='custom_fields[opd][52]'
            || $name=='custom_fields[opd][54]')
        {
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }
            $input .= '<div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12">
                            <div class="col-2">
                                <label for="' . $name . '" class="control-label">
                                    <b>' . $label . '</b>
                                    <small class="req"> *</small>
                                </label>';

            if ($label != '') {
                $input .= '</div>';
            }
            if ($validation) {
                $input .= '<div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                    <i class="fas fa-thermometer"  style="color:#337ab7;"></i>
                                </span>';
            
            $input .= '<div class="col-4" style="width: -webkit-fill-available;">
                            <input type="' . $type . '" id="' . $name . '"  style="border-radius: 0px 10px 10px 0px !important;" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="">
                        </div>
                    </div>
                </div>
                            &nbsp;
                        <div class="col-2" style="margin-bottom:4px;"> 
                            <b><span>LPM</span></b>
                        </div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>
                    </div>';
            return $input;
            
        }
        
        if($name=='custom_fields[opd][39]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }
            $input .= '<div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12">
                            <div class="col-2">
                                <label for="' . $name . '" class="control-label">
                                    <b>' . $label . '</b>
                                    <small class="req"> *</small>
                                </label>';

            if ($label != '') {
                $input .= '</div>';
            }
            if ($validation) {
                $input .= '<div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';
            }
            
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                    <i class="fas fa-prescription-bottle"  style="color:#337ab7;"></i>
                                </span>';
            $input .= '<div class="col-4" style="width: -webkit-fill-available;">
                          <input type="' . $type . '" id="' . $name . '" name="' . $name . '" style="border-radius: 0px 10px 10px 0px !important;" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="">
                      </div>
                      </div>
                      </div>
                      &nbsp;
                        <div class="col-2" style="margin-bottom:4px;"> 
                            <b><span>SRPM</span></b>
                        </div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div></div>';
            return $input;
            
        }
        if($name=='custom_fields[opd][41]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }

            $input .= '<div style="margin: -4px 0px;font_size:15px;" class="col-12"><div class="row" style="padding:14px 42px 21px 42px;">';

            if ($label != '') {
                $input .= '<div class="row"><div class="col-2">
                                <label for="' . $name . '" class="control-label">
                                    <b>' . $label . '</b>
                                </label>
                          </div>';
            }
            if ($validation) {
                $input .= "<div class='col-2'>
                                <small class='req'> *</small>
                            </div>
                        </div>";
            }
            $input .= '<div class="row">
                        <input type="' . $type . '" id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="" disabled>
                      </div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>
                    </div>
                </div>';
            return $input;
            
        }
        if($name=='custom_fields[opd][42]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
                $value = $_POST['custom_fields'][$belong_to][$field_id];
            }
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }

            $input .= '<div style="margin: -4px 0px;font_size:15px;" class="col-12"><div class="row" style="padding:14px 42px 21px 42px;">';

            if ($label != '') {
                $input .= '<div class="row"><div class="col-2"><label for="' . $name . '" class="control-label"><b>' . $label . '</b></label></div>';
            }
            if ($validation) {
                $input .= "<div class='col-2'><small class='req'> *</small></div></div>";
            }
            $input .= '<div class="row"><input type="' . $type . '" id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="" disabled></div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div></div></div>';
            return $input;
            
        }
        if($name=='custom_fields[opd][72]'){
          $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';

        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group" hidden>';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '">';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';


        return $input;
        }
        if($name=='custom_fields[opd][73]'){
          $input = '';
          $_form_group_attr = '';
          $_input_attrs = '';

          if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
              $value = $_POST['custom_fields'][$belong_to][$field_id];
          }
          if (!empty($input_class)) {
              $input_class = ' ' . $input_class;
          }

          $input .= '<div class="form-group" hidden>';

          if ($label != '') {
              $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
          }
          if ($validation) {
              $input .= "<small class='req'> *</small>";
          }
          $input .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '">';

          $input .= '<span class="text-danger">' . form_error($name) . '</span>';
          $input .= '</div>';


          return $input;
        }
     
      
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';

        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '">';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';


        return $input;
    }

    function render_textarea_field($name, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {
        
//         if($name=='custom_fields[opd][34]'){
            
//         $input = '';
        
//         $input .= '<div class="standalone-container"><div name="" id="snow-container" ><div id="socioeconomicos" ><p ><b>Socioeconómicos:</b><br><br></p></div><p id="patologicos"><b>Patológicos:</b><br><br></p><p id="familiares"><b>Familiares:</b><br><br></p><p id="farmacologicos"><b>Farmacológicos:</b><br><br></p><p id="transfusiones"><b>Transfusiones:</b><br><br></p><p id="habitos"><b>Hábitos:</b><br><br></p><p id="ginecobstetricos"><b>Ginecobstetricos:</b><br><br></p></div></div>';

//         return $input;
            
//         }
      
      
      
      if($name=='custom_fields[opd][74]'){
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';
        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group" hidden>';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<textarea id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' >' . $value . '</textarea>';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';


        return $input;
        
      }
      // desarrollo Juan inputs antecedentes
      if($name=='custom_fields[opd][75]'|| $name=='custom_fields[opd][75]' || $name=='custom_fields[opd][76]' || $name=='custom_fields[opd][77]' || $name=='custom_fields[opd][78]' || $name=='custom_fields[opd][79]' || $name=='custom_fields[opd][80]' || $name=='custom_fields[opd][81]'){
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';
        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';

        if ($label != '') {
    $input .= '<div class="row" style="box-sizing: border-box;">
                <div class="col-5 d-flex ml-2 justify-content-between">
                    <label for="' . $label . '" class="control-label">
                        ' . $label . '
                    </label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="optradio" onclick="check_antecedentes(\'' . $name . '\')">Ningún valor
                        </label>
                    </div>
                </div>
            </div>
            ';
              }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<textarea id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' >' . $value . '</textarea>';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';


        return $input;
        
      }
      
      
      if($name=='custom_fields[opd][32]' || $name=='custom_fields[opd][43]' || $name=='custom_fields[opd][57]' || $name=='custom_fields[opd][58]' | $name=='custom_fields[opd][64]' | $name=='custom_fields[opd][65]' ){
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';
        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label"></label>';
        }
        if ($validation) {
            $input .= "<small class='req'>Requerido *</small>";
        }
        $input .= '<textarea id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' >' . $value . '</textarea>';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';


        return $input;
        
      }
        
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';
        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<textarea id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' >' . $value . '</textarea>';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';


        return $input;
        
    }

//     function render_select_field($name, $options, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {

        
//         $input = '';
//         $_form_group_attr = '';
//         $_input_attrs = '';

//         if (!empty($input_class)) {
//             $input_class = ' ' . $input_class;
//         }

//         $input .= '<div class="form-group">';

//         if ($label != '') {
//             $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
//         }
//         if ($validation) {
//             $input .= "<small class='req'> *</small>";
//         }
        
//         if($name=='custom_fields[patient][3]'){
//           $input .='<div class="input-group"><span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-map-marker"></i></span>';
//         }
//         if($name=='custom_fields[patient][3]'){
//                 $input .= '<select id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' style="border-radius: 0px 10px 10px 0px !important;" disabled>';
//                 foreach ($options as $option_key => $option_value) {
//                     $input .= '<option value="" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) .' >' . $option_value . '</option>';
//                 }
//                 $input .= '</select>';
//                 $input .= '<span class="text-danger">' . form_error($name) . '</span>';
//                 $input .= '</div></div>';
//                 return $input;
//         }elseif($name=='custom_fields[patient][4]' || $name=='custom_fields[patient][14]'  || $name=='custom_fields[patient][26]'){
          
//               $input .='<div class="input-group"><span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-map-marker"></i></span>';
//               $input .= '<select id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' style="border-radius: 0px 10px 10px 0px !important;">'; 
//                foreach ($options as $option_key => $option_value) {
//                     $input .= '<option value="" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) .' >' . $option_value . '</option>';
//                 }
//                 $input .= '</select>';
//                 $input .= '<span class="text-danger">' . form_error($name) . '</span>';
//                 $input .= '</div></div>';
//                 return $input;
        
          
//           }elseif($name=='custom_fields[patient][16]' || $name=='custom_fields[patient][10]'  || $name=='custom_fields[patient][31]'){
          
//               $input .='<div class="input-group"><span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-medkit"></i></span>';
//               $input .= '<select id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' style="border-radius: 0px 10px 10px 0px !important;">'; 
//                foreach ($options as $option_key => $option_value) {
//                     $input .= '<option value="" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) .' >' . $option_value . '</option>';
//                 }
//                 $input .= '</select>';
//                 $input .= '<span class="text-danger">' . form_error($name) . '</span>';
//                 $input .= '</div></div>';
//                 return $input;
        
          
//           }elseif($name=='custom_fields[patient][13]'){
          
//               $input .='<div class="input-group"><span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-wheelchair"></i></span>';
//               $input .= '<select id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' style="border-radius: 0px 10px 10px 0px !important;">'; 
//                foreach ($options as $option_key => $option_value) {
//                     $input .= '<option value="" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) .' >' . $option_value . '</option>';
//                 }
//                 $input .= '</select>';
//                 $input .= '<span class="text-danger">' . form_error($name) . '</span>';
//                 $input .= '</div></div>';
//                 return $input;
        
          
//           }elseif($name=='custom_fields[patient][28]' || $name=='custom_fields[patient][67]'){
          
//               $input .='<div class="input-group"><span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-user-plus"></i></span>';
//               $input .= '<select id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' style="border-radius: 0px 10px 10px 0px !important;">'; 
//                foreach ($options as $option_key => $option_value) {
//                     $input .= '<option value="" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) .' >' . $option_value . '</option>';
//                 }
//                 $input .= '</select>';
//                 $input .= '<span class="text-danger">' . form_error($name) . '</span>';
//                 $input .= '</div></div>';
//                 return $input;
        
          
//           }else{


//           $input .= '<select id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . '>';  
//           $input .= '<option value="">Select</option>';
//           foreach ($options as $option_key => $option_value) {
//               $input .= '<option value="' . $option_value . '" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) . '>' . $option_value . '</option>';
//           }
//           $input .= '</select>';
//           $input .= '<span class="text-danger">' . form_error($name) . '</span>';
//           $input .= '</div>';
//           return $input;
//       }
//     }
    function render_select_field($name, $options, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {

        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';

        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        if ($name=='custom_fields[patient][10]' || $name=='custom_fields[patient][16]' || $name=='custom_fields[patient][12]' ){
          $input .='<div class="input-group"><span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-hospital-o"></i></span>';
        }
        if ($name=='custom_fields[patient][3]' || $name=='custom_fields[patient][4]' || $name=='custom_fields[patient][14]' || $name=='custom_fields[patient][26]'){
          $input .='<div class="input-group"><span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-map-marker"></i></span>';
        }
        if ($name=='custom_fields[patient][31]'){
          $input .='<div class="input-group"><span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fas fa-dungeon"></i></span>';
        }
       if ($name=='custom_fields[patient][28]' || $name=='custom_fields[patient][24]' || $name=='custom_fields[patient][13]' || $name=='custom_fields[patient][67]'){
          $input .='<div class="input-group"><span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;"><i class="fa fa-newspaper-o ftlayer"></i></span>';
        }
      
       if ($name=='custom_fields[patient][4]'){
          $input .= '<select id="' . $name . '" onchange="department()" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' style="border-radius: 0px 10px 10px 0px !important;">';
        }else{
           $input .= '<select id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' style="border-radius: 0px 10px 10px 0px !important;">';
       
        }
        $input .= '<option value="">Select</option>';
        foreach ($options as $option_key => $option_value) {
            $input .= '<option value="' . $option_value . '" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) . '>' . $option_value . '</option>';
        }
        $input .= '</select>';
        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';
        if ($name=='custom_fields[patient][10]' || $name=='custom_fields[patient][16]' || $name=='custom_fields[patient][12]' || $name=='custom_fields[patient][3]' || $name=='custom_fields[patient][4]' 
            || $name=='custom_fields[patient][14]' || $name=='custom_fields[patient][26]' || $name=='custom_fields[patient][31]' || $name=='custom_fields[patient][28]' || $name=='custom_fields[patient][24]' 
            || $name=='custom_fields[patient][13]' || $name=='custom_fields[patient][67]'){
          $input .='</div>';
        }
        return $input;   
    }

    function render_select_field_opd($name, $options, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {
        if($name=='custom_fields[opd][60]'){
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label><select id="demo" class="form-select form-control h-auto py-2" data-msg-required="" placeholder="" name="" required>

                    </select>';

            return $input;
        }
        if($name=='custom_fields[opd][69]'){
            
        }
        
        
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';
        
         if($name=='custom_fields[opd][69]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';
            
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }

            $input .= '<div class="form-group">';

            if ($label != '') {
                $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
            }
            if ($validation) {
                $input .= "<small class='req'> *</small>";
            }
            $input .= '<select id="'.$name.'"  name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . '>';
            $input .= '<option value="">Selecione</option>';
            foreach ($options as $option_key => $option_value) {
                $input .= '<option id="causaExterna2" value="' . $option_value . '" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) . '>' . $option_value . '</option>';
            }
            $input .= '</select>';
            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>';
            return $input;
        }
        
        if($name=='custom_fields[opd][46]'
          || $name=='custom_fields[opd][47]'){
             $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';
            
            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }

            $input .= '<div class="form-group">';

            if ($label != '') {
                $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
            }
            if ($validation) {
                $input .= "<small class='req'> *</small>";
            }
            
            $input .= '<div class="col-6" style="width: -webkit-fill-available;">
                            <div class="input-group">
                                <span class="input-group-addon" style="border-radius: 10px 0px 0px 10px !important;">
                                    <i class="fa fa-tint" style="color:#337ab7;font-size: 15px" > </i>
                                </span>';
            $input .= '<select id="'.$name.'"  style="border-radius: 0px 10px 10px 0px !important;"  name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . '>';
            $input .= '<option value="">Selecione</option>';
            foreach ($options as $option_key => $option_value) {
                $input .= '<option id="causaExterna2" value="' . $option_value . '" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) . '>' . $option_value . '</option>';
            }
            $input .= '</select>';
            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>
                    </div>
                    </div>';
            return $input;
        }

        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
      
        
      
       if($name=='custom_fields[opd][62]'){
            $input = '';
            $_form_group_attr = '';
            $_input_attrs = '';

            if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }
            
            $input .= '<div class="form-group" >';

            if ($label != '') {
                $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
            }
            if ($validation) {
                $input .= "<small class='req'> *</small>";
            }
            
            $input .= '<select id="' . $name . '"  name="' . $name . '" class="form-control' . $input_class . '"  '. $_input_attrs . '>' . $value . '>';
            
          
            $input .= '<option value="">Tipo de diagnóstico</option>';
            foreach ($options as $option_key => $option_value) {
                $input .= '<option value="' . $option_value . '" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) . '>' . $option_value . '</option>';
            }
            $input .= '</select>';
            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>';

            return $input;
            
        }
       if($name=='custom_fields[opd][72]'){
          $input = '';
          $_form_group_attr = '';
          $_input_attrs = '';
         if (!empty($input_class)) {
                $input_class = ' ' . $input_class;
            }

            $input .= '<div class="form-group " style="display:none" hidden>';

            if ($label != '') {
                $input .= '';
            }
            if ($validation) {
                $input .= "<small class='req'> *</small>";
            }
            $input .= '<select id="' . $name . '"  name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . '  >';
            $input .= '<option value="">Select</option>';
            foreach ($options as $option_key => $option_value) {
                $input .= '<option value="' . $option_value . '" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) . '>' . $option_value . '</option>';
            }
            $input .= '</select>';
            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div>';
            return $input;
         
       }
        
        $input .= '<select id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . '>';
        $input .= '<option value="">Select</option>';
        foreach ($options as $option_key => $option_value) {
            $input .= '<option value="' . $option_value . '" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) . '>' . $option_value . '</option>';
        }
        $input .= '</select>';
        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';
        
        return $input;
    }

    function render_multiselect_field($name, $options, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {
        
        
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';

        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<select id="' . $name . '" name="' . $name . '[]" class="form-control' . $input_class . '" ' . $_input_attrs . ' multiple  >' . $value . '>';
        $input .= '<option value="">Select</option>';
        foreach ($options as $option_key => $option_value) {

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                if (isset($_POST[$name]) && in_array($option_value, $name)) {
                    $chk_status = TRUE;
                } else {
                    $chk_status = FALSE;
                }
            } elseif ($value != "" && in_array($option_value, explode(",", $value))) {
                $chk_status = TRUE;
            } else {
                $chk_status = FALSE;
            }


            $input .= '<option value="' . $option_value . '" ' . set_select($name, $option_value, $chk_status) . '>' . $option_value . '</option>';
        }

        $input .= '</select>';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';


        return $input;
    }

    function render_checkbox_field($name, $options, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {


        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';

        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }
        $input .= '<div class="form-group">';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<div class="checkbox">';
        foreach ($options as $option_key => $option_value) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
              

                if (isset($_POST[$name]) && in_array($option_value, $name)) {
                    $chk_status = TRUE;
                } else {
                    $chk_status = FALSE;
                }
            } elseif ($value != "" && in_array($option_value, explode(",", $value))) {
                $chk_status = TRUE;
            } else {
                $chk_status = FALSE;
            }
            $input .= '<label class="checkbox-inline">';

            $input .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '[]"  value="' . $option_value . '" ' . set_checkbox($name, $option_value, $chk_status) . '>' . $option_value . '</label>';
            $input .= '</label>';
        }

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';
        $input .= '</div>';
        return $input;
    }

    function render_date_picker_field($name, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';
        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<input  id="' . $name . '" name="' . $name . '" class="form-control date' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '">';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';


        return $input;
    }

    function render_date_picker_time_field($name, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';
        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<input  id="' . $name . '" name="' . $name . '" class="form-control datetime' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '">';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';


        return $input;
    }

    function render_colorpicker_field($name, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';
        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';

        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<input  id="' . $name . '" name="' . $name . '" class="form-control color' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '">';

        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';


        return $input;
    }
    
    function render_file_field($name, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'file', $input_class = '', $rel_id) {
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';
        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

//         if($belong_to == "patient"){
//             $CI = &get_instance();
//             $sql = 'SELECT custom_fields.* FROM custom_fields 
//                     INNER JOIN custom_field_values ON custom_field_values.belong_table_id='.$rel_id.' 
//                     AND custom_field_values.custom_field_id=custom_fields.id 
//                     WHERE belong_to ="'.$belong_to.'" 
//                     AND custom_field_values.custom_field_id='.$field_id.'
//                     ORDER BY custom_field_values.id DESC LIMIT 1';

//             $query = $CI->db->query($sql);
//             $result = $query->row();
// //           echo "<pre>";
// //           print_r($result);
// //           exit;
//             if (!empty($result)) {
//                 $field_value = $result->field_value;
//             }else{
//                 $field_value = "";
//             }            
//         }else{
//             $field_value = "";
//         }
        $input .= '<div class="form-group">';

        if ($label != '') {
            if($field_value != ""){
                $input .= '<div class="row"><div class="col-md-8">
                                    <label for="' . $name . '" class="control-label">' . $label . '</label>
                                </div>
                                    <div class="col-md-4">
                                        <a href="'.base_url().$field_value.'" download="">Ver archivo</a>
                                </div>
                            </div>';
                
            }else{
                $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
            }
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }

        $input .=   '<div class="dropify-wrapper" style="height: 28px;">';
        $input .= '<input type="file" id="' . $name . '" name="' . $name . '" class="filestyle form-control-file ' . $input_class . '" size="20" data-height="26">';
        $input .= '</div>';
        $input .= '</div>';
        
        return $input;
    }

    function render_link_field($name, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {
        $input = '';
        $_form_group_attr = '';
        $_input_attrs = '';

        if (isset($_POST['custom_fields'][$belong_to][$field_id])) {
            $value = $_POST['custom_fields'][$belong_to][$field_id];
        }
        if (!empty($input_class)) {
            $input_class = ' ' . $input_class;
        }

        $input .= '<div class="form-group">';
        if ($label != '') {
            $input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
        }
        if ($validation) {
            $input .= "<small class='req'> *</small>";
        }
        $input .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '">';
        $input .= '<span class="text-danger">' . form_error($name) . '</span>';
        $input .= '</div>';
        return $input;
    }

    function get_custom_field_value($rel_id, $field_id, $belongs_to) {
        $CI = &get_instance();
        $sql = 'SELECT * FROM `custom_fields` INNER JOIN custom_field_values on custom_field_values.belong_table_id=' . $CI->db->escape($rel_id) . ' and custom_field_values.custom_field_id=custom_fields.id WHERE belong_to =' . $CI->db->escape($belongs_to) . ' and custom_field_values.custom_field_id=' . $CI->db->escape($field_id);

        $query = $CI->db->query($sql);
        return $query->row();
    }

    function optionSplit($values) {
        return explode(',', $values);
    }

    function removeBreak($option_value) {
        return preg_replace('/<br\\s*?\\/?>\\s*$/', '', $option_value);
    }

    function get_custom_table_values($table_id, $belongs_to) {
        $CI = &get_instance();
        $sql = 'SELECT custom_field_values.*,custom_fields.name,custom_fields.visible_on_table,custom_fields.visible_on_print,custom_fields.visible_on_patient_panel, custom_fields.id as cid,custom_fields.type,custom_fields.belong_to  FROM `custom_field_values` RIGHT JOIN custom_fields on custom_fields.id=custom_field_values.custom_field_id  and belong_table_id=' . $CI->db->escape($table_id) . ' WHERE custom_fields.belong_to=' . $CI->db->escape($belongs_to) . ' ORDER by custom_fields.id asc';

        $query = $CI->db->query($sql);
        return $query->result();
    }

    function get_custom_fields($belongs_to) {
        $CI = &get_instance();
        $sql = 'SELECT custom_fields.*  FROM `custom_fields` WHERE custom_fields.belong_to=' . $CI->db->escape($belongs_to) . ' ORDER by custom_fields.id asc';

        $query = $CI->db->query($sql);
        return $query->result();
    }

    function get_captcha_editable_fields()
    {
        $fields = array(
            'userlogin'  => lang('user_login'),
            'login'      => lang('staff_login'),
            'appointment'  => lang('online_appointment')
        );
        return $fields;
    }

}