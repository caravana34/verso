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
        $fields_html = '<div>
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4 border border-primary" style="background-color: #034885; margin:5px;border-radius:8px;padding: 6px;">
                                        <h4 class="card-title text-center" style="color:#fff;margin: 10px;">Ubicación <i class="fa fa-map-marker"></i></h4>
                                    </div><div class="col-sm-4"></div></div><hr>
                                    <div class="row" style="border: solid #011E38 1px;margin: 5px;border-radius: 13px;padding: 7px;">'.$html["location"].'</div></div>
                                <div class="col-sm-6">
                                    <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4 border border-primary" style="background-color: #034885; margin:5px;border-radius:8px;padding: 6px;">
                                        <h4 class="card-title text-center" style="color:#fff;margin: 10px;">Contacto <i class="fa fa-phone"></i></h4>
                                    </div><div class="col-sm-4"></div></div><hr>
                                    <div class="row" style="border: solid #011E38 1px;margin: 5px;border-radius: 13px;padding: 7px;">'.$html["contact"].' </div></div>
                            </div>
                            <div class="col-sm-12">
                            <div class="row" style="margin-top:10px; margin-bottom:10px;">
                            <div class="col-sm-4"></div>
                                <div class="col-sm-4 border border-primary" style="background-color: #034885; margin:5px;border-radius:8px;padding: 6px;">
                                    <h4 class="card-title text-center" style="color:#fff;margin: 10px;">Afiliación <i class="fa fa-folder-open"></i></h4>
                                </div><div class="col-sm-4"></div></div><hr>
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
                }else{
                    $field['bs_column'] = ($field['bs_column']/2);
                    $html["fisico_antro"] .= builder_custom_fields_opd_own($field, $belongs_to, $rel_id);  
                }

        }
        
        $fields_html = '<div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p>
                                                  <button class="btn" style="border-radius:10px;width: -webkit-fill-available;margin:10px;background-color:#034885; color: #fff;" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                                                      <b>Motivo de consulta</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                  </button>
                                                </p>
                                                <div class="collapse in" id="collapseExample3" >
                                                  <div class="card card-body" >
                                                      <div class="">
                                                            <div class="col-sm-4"></div>
                                                        </div>
                                                        <div class="row conatainer" style="margin: 2px;padding: 5px 12px;">'.$html["motivo_consulta"].'</div>
                                                    </div>   
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>
                                                  <button class="btn" style="border-radius:10px;width: -webkit-fill-available;margin:10px;background-color:#034885; color: #fff;" type="button" data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
                                                      <b>Revisión por sistemas</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                  </button>
                                                </p>
                                                <div class="collapse in" id="collapseExample4" >
                                                  <div class="card card-body" >
                                                      <div class="">
                                                            <div class="col-sm-4"></div>
                                                        </div>
                                                        <div class="row" style="margin: 5px;padding: 7px;">'.$html["revision_sistemas"].' </div>
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                            
                                            <div class="row">
                                            <div class="col-sm-12">
                                                <p>
                                                
                                                <div id="accordion" class="panel-group">
                                                     <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseExample6" aria-expanded="false" aria-controls="collapseExample6">
                                                                    <i class="more-less fa fa-plus"></i>
                                                                    Examén Físico</a>

                                                                </h4>
                                                            </div>
                                                            <div id="collapseExample6" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class="">
                                                                        <div class="col-sm-4"></div>
                                                                    </div>
                                                                    <div class="row" style="margin: 0px 0px;padding: 7px;">
                                                                        <div class="row" style="border: solid #011E38 1px;margin: 25px 0px;padding: 3px;border-radius: 13px">
                                                                            <div class="row" style="display: flex;justify-content: center;">
                                                                                <div class="pt5 col-3 text-primary mb-3" style="font-size:19px;font-weight: bold;">
                                                                                    <b>Medidas antropométricas</b>
                                                                                </div>
                                                                            </div>
                                                                            '.$html["fisico_antro"].' 
                                                                        </div>
                                                                    </div>
                                                                    <div class="row" style="border: solid #011E38 1px;margin: 25px 0px;padding: 3px;border-radius: 13px">
                                                                        <div class="row" style="margin: 0px;padding: 0px;">
                                                                            <div class="row" style="display: flex;justify-content: center;">
                                                                                <div class="pt5 col-3 text-primary mb-3" style="font-size:19px;font-weight: bold;">
                                                                                    <b>Signos Vitales</b>
                                                                                </div>
                                                                            </div>
                                                                            '.$html["fisico"].' 
                                                                        </div>
                                                                     </div>
                                                                     <div class="row" style="border: solid #011E38 1px;margin: 25px 0px;padding: 3px;border-radius: 13px">
                                                                        <div class="row" style="margin: 0px;padding: 0px;">
                                                                            <div class="row" style="display: flex;justify-content: center;">
                                                                                <div class="pt5 col-3 text-primary mb-3" style="font-size:19px;font-weight: bold;">
                                                                                    <b>Presión Arterial (PA)</b>
                                                                                </div>
                                                                            </div>
                                                                            '.$html["fisico_vitales_presion"].' 
                                                                        </div>
                                                                     </div>
                                                                      <div class="row" style="border: solid #011E38 1px;margin: 25px 0px;padding: 3px;border-radius: 13px">
                                                                            <div class="row" style="margin: 0px;padding: 0px;">
                                                                                <div class="row mb-3" style="display: flex;justify-content: center; margin-bottom: 10px;">
                                                                                    <div class="pt5 col-3 text-primary mb-3" style="font-size:19px;font-weight: bold;">
                                                                                        <b>Temperatura /Saturación de Oxígeno (SA02)</b>
                                                                                    </div>
                                                                                </div>
                                                                                '.$html["fisico_vitales"].' 
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                     </div>
                                               </div>
                                                <script type="text/javascript">
                                                    function toggleIcon(e) {
                                                        $(e.target)
                                                                .prev(".panel-heading")
                                                                .find(".more-less")
                                                                .toggleClass("fa-plus fa-minus");
                                                    }
                                                    $(".panel-group").on("hidden.bs.collapse", toggleIcon);
                                                    $(".panel-group").on("shown.bs.collapse", toggleIcon);
                                                </script>
                                                        
                                                  <button class="btn" style="border-radius:10px;width: -webkit-fill-available;margin:10px;background-color:#034885; color: #fff;" type="button" data-toggle="collapse" data-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample">
                                                      <b>Examén Físico</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                  </button>
                                                </p>
                                                <div class="collapse in" id="collapseExample5" >
                                                  <div class="card card-body" >
                                                      <div class="">
                                                            <div class="col-sm-4"></div>
                                                        </div>
                                                        <div class="row" style="border: solid #011E38 1px;margin: 5px;border-radius: 13px;padding: 7px;">
                                                            <div class="row" style="border: solid #011E38 1px;margin: 3px;padding: 3px;border-radius: 13px">
                                                                <div class="row" style="display: flex;justify-content: center;">
                                                                    <div class="pt5 col-3 text-primary mb-3" style="font-size:19px;font-weight: bold;">
                                                                        <b>Medidas antropométricas</b>
                                                                    </div>
                                                                </div>
                                                                '.$html["fisico_antro"].' 
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin: 15px 0px;border-radius: 13px;padding: 7px;">
                                                            <div class="row" style="border: solid #011E38 1px;margin: 3px;padding: 3px;border-radius: 13px">
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="row" style="display: flex;justify-content: center;">
                                                                        <div class="pt5 col-3 text-primary mb-3" style="font-size:19px;font-weight: bold;">
                                                                            <b>Signos Vitales</b>
                                                                        </div>
                                                                    </div>
                                                                    '.$html["fisico"].' 
                                                                </div>
                                                             </div>
                                                            <div class="row" style="margin: 15px 0px;border-radius: 13px;padding: 7px;">
                                                            <div class="row" style="border: solid #011E38 1px;margin: 3px;padding: 3px;border-radius: 13px">
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="row" style="display: flex;justify-content: center;">
                                                                        <div class="pt5 col-3 text-primary mb-3" style="font-size:19px;font-weight: bold;">
                                                                            <b>Presión Arterial</b>
                                                                        </div>
                                                                    </div>
                                                                    '.$html["fisico_vitales_presion"].' 
                                                                </div>
                                                             </div>
                                                        </div>
                                                         
                                                         </div>
                                                         <div class="row" style="border: solid #011E38 1px;margin: 5px;border-radius: 13px;padding: 7px;">
                                                            <div class="row" style="border-radius: 13px;padding: 0px;">
                                                                <div class="row" style="margin: 0px;padding: 0px;">
                                                                    <div class="row mb-3" style="display: flex;justify-content: center; margin-bottom: 10px;">
                                                                        <div class="pt5 col-3 text-primary mb-3" style="font-size:19px;font-weight: bold;">
                                                                            <b>Temperatura/Saturación de Oxígeno</b>
                                                                        </div>
                                                                    </div>
                                                                    '.$html["fisico_vitales"].' 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div>
                                             </div>
                                             
                                             <div class="row">
                                        <div class="col-sm-12">
                                                <p>
                                                  <button class="btn" style="border-radius:10px;width: -webkit-fill-available;margin:10px;background-color:#034885; color: #fff;" type="button" data-toggle="collapse" data-target="#collapseExample7" aria-expanded="false" aria-controls="collapseExample">
                                                      <b>Antecedentes</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                  </button>
                                                </p>
                                                <div class="collapse" id="collapseExample7" >
                                                  <div class="card card-body" >
                                                      <div class="">
                                                            <div class="col-sm-4"></div>
                                                        </div>
                                                        <div class="row conatainer" style="margin: 2px 4px;padding: 5px 12px;">'.$html["antecedentes"].'</div>
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
//         echo $field_id;
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
    
    function render_input_field_opd($name, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {
//         print_r($name);
//         exit;
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
            $input .= '<div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12"><div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';

            if ($label != '') {
                $input .= '<div class="col-2"><label for="' . $name . '" class="control-label"><b>' . $label . '</b></label></div>';
            }
            if ($validation) {
                $input .= '<div class="col-2"><small class="req"> *</small></div>&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;"><input type="' . $type . '" onclick="imc()" id="talla_custom"' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder=""></div>&nbsp;<div class="col-2" style="margin-bottom:4px;"> <b><span>Cm</span></b></div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div></div>';
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

            $input .= '<div style="margin: 20px 5px 0px 0px;font_size:15px;" class="col-12"><div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';

            if ($label != '') {
                $input .= '<div class="col-2"><label for="' . $name . '" class="control-label"><b>' . $label . '</b></label></div>';
            }
            if ($validation) {
                $input .= '<div class="col-2"><small class="req"> *</small></div>&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;"><input type="' . $type . '" onchange="imc()" id="peso_custom""' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder=""></div>&nbsp; <div class="col-2" style="margin-bottom:4px;"><b><span> Kg </span></b></div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div></div>';


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

            $input .= '<div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12"><div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';

            if ($label != '') {
                $input .= '<div class="col-2"><label for="' . $name . '" class="control-label"><b>' . $label . '</b></label></div>&nbsp;&nbsp;&nbsp;';
            }
            if ($validation) {
                $input .= '<div class="col-2"><small class="req"> *</small></div>&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $input .= '<input type="' . $type . '" id="imc_custom""' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="" disabled>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div></div>';
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

            $input .= '<div style="margin: -4px 0px;font_size:15px;" class="col-12"><div class="row" style="padding:0px 25px 15px 25px;">';

            if ($label != '') {
                $input .= '<div class="row"><div class="col-4"><label for="' . $name . '" class="control-label"><b>' . $label . '</b></label></div>';
            }
            if ($validation) {
                $input .= "<div class='col-2'><small class='req'> *</small></div></div>";
            }
            $input .= '<div class="row"><div class="col-12"><input style="width: -webkit-fill-available;" type="' . $type . '" id="clasified_custom_imc"' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="" disabled></div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div></div></div>';
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
            $input .= '<div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12"><div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';

            if ($label != '') {
                $input .= '<div class="col-2"><label for="' . $name . '" class="control-label"><b>' . $label . '</b></label></div>';
            }
            if ($validation) {
                $input .= '<div class="col-2"><small class="req"> *</small></div>&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;"><input type="' . $type . '" id=""' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder=""></div>&nbsp;<div class="col-2" style="margin-bottom:4px;"> <b><span>Lpm</span></b></div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div></div>';
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
            $input .= '<div style="margin: 20px 0px 0px 0px;font_size:15px;" class="col-12"><div class="row" style="display: flex;padding:0px 19px 15px 8px;align-items: baseline;">';

            if ($label != '') {
                $input .= '<div class="col-2"><label for="' . $name . '" class="control-label"><b>' . $label . '</b></label></div>';
            }
            if ($validation) {
                $input .= '<div class="col-2"><small class="req"> *</small></div>&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $input .= '<div class="col-6" style="width: -webkit-fill-available;"><input type="' . $type . '" id=""' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder=""></div>&nbsp;<div class="col-2" style="margin-bottom:4px;"> <b><span>rpm</span></b></div>';

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
                $input .= '<div class="row"><div class="col-2"><label for="' . $name . '" class="control-label"><b>' . $label . '</b></label></div>';
            }
            if ($validation) {
                $input .= "<div class='col-2'><small class='req'> *</small></div></div>";
            }
            $input .= '<div class="row"><input type="' . $type . '" id=""' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="" disabled></div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div></div></div>';
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
            $input .= '<div class="row"><input type="' . $type . '" id=""' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '" placeholder="" disabled></div>';

            $input .= '<span class="text-danger">' . form_error($name) . '</span>';
            $input .= '</div></div></div>';
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
        
        if($name=='custom_fields[patient][3]'){
                $input .= '<select id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' disabled>';
                foreach ($options as $option_key => $option_value) {
                    $input .= '<option value="" ' . set_select($name, $option_value, (set_value($name, $value) == $option_value ) ? TRUE : FALSE) .' >' . $option_value . '</option>';
                }
                $input .= '</select>';
                $input .= '<span class="text-danger">' . form_error($name) . '</span>';
                $input .= '</div>';
                return $input;
            }else{
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
    }
    
    function render_select_field_opd($name, $options, $belong_to, $field_id, $validation, $label = '', $value = '', $type = 'text', $input_class = '') {

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

        if($belong_to == "patient"){
            $CI = &get_instance();
            $sql = 'SELECT * FROM `custom_fields` 
                    INNER JOIN custom_field_values ON custom_field_values.belong_table_id='.$rel_id.' 
                    AND custom_field_values.custom_field_id=custom_fields.id 
                    WHERE belong_to ="'.$belong_to.'" 
                    AND custom_field_values.custom_field_id='.$field_id.'
                    ORDER BY custom_field_values.id DESC LIMIT 1';

            $query = $CI->db->query($sql);
            $result = $query->row();
            if (!empty($result)) {
                $field_value = $result->field_value;
            }else{
                $field_value = "";
            }            
        }else{
            $field_value = "";
        }
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