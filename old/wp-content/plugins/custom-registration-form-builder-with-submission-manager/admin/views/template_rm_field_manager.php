<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
add_thickbox();
$allowed_c_fields = RM_Utilities::get_allowed_conditional_fields();
?>


<!--------WP Menu Bar

<div class="wpadminbar">Hi</div>

<div class="adminmenublock">
test</div>------->


<div class="rmagic">

    <!-----Operationsbar Starts----->
    <form method="post" id="rm_field_manager_form">
        <input type="hidden" name="rm_slug" value="" id="rm_slug_input_field">
        <div class="operationsbar">
            <div class="rmtitle"><?php echo RM_UI_Strings::get("TITLE_FORM_FIELD_PAGE"); ?></div>
            <div class="icons">
                
            </div>
            <div class="nav">
                <ul>
<!--                    <li onclick="window.history.back()"><a href="javascript:void(0)"><?php //echo RM_UI_Strings::get("LABEL_BACK"); ?></a></li>-->
              <li ><a href="#rm-field-selector" onclick='CallModalBox(this)'><?php echo RM_UI_Strings::get('LABEL_ADD_NEW_FIELD'); ?></a></li>
              <li ><a href="#rm-widget-selector" onclick='CallModalBox(this)'><?php echo RM_UI_Strings::get('LABEL_ADD_NEW_WIDGET'); ?></a></li>      
              <li id="rm-duplicate-field" class="rm_deactivated" onclick="jQuery.rm_do_action('rm_field_manager_form', 'rm_field_duplicate')"><a href="javascript:void(0)"><?php echo RM_UI_Strings::get('LABEL_DUPLICATE'); ?></a></li>  
                    
                    <li id="rm-delete-field" class="rm_deactivated"  onclick="jQuery.rm_do_action('rm_field_manager_form', 'rm_field_remove')"><a href="javascript:void(0)"><?php echo RM_UI_Strings::get('LABEL_REMOVE'); ?></a></li>
                    <li class="rm-form-toggle"><?php echo RM_UI_Strings::get('LABEL_TOGGLE_FORM'); ?>
                        <select id="rm_form_dropdown" name="form_id" onchange = "rm_load_page(this, 'field_manage')">
                            <?php
                            foreach ($data->forms as $form_id => $form)
                                if ($data->form_id == $form_id)
                                    echo "<option value=$form_id selected>$form</option>";
                                else
                                    echo "<option value=$form_id>$form</option>";
                            ?>
                        </select></li> 
                        <?php
                        $design_link_class = $design_link_tooltip = "";
                        if($data->theme == 'classic') {
                            $design_link_class = "class='rm_deactivated'";
                            $design_link_tooltip = "Form design customization is not applicable for Classic theme. To enable please change theme in Global Settings >> General Settings.";
                        }
                        ?>
                        <li title="<?php echo $design_link_tooltip; ?>"><a <?php echo $design_link_class; ?> href="?page=rm_form_sett_view&rdrto=rm_field_manage&rm_form_id=<?php echo $data->form_id; ?>">Design</a></li>
                        <li><a id="rm_form_preview_action" class="thickbox rm_form_preview_btn" href="<?php echo add_query_arg(array('form_prev' => '1','form_id' => $data->form_id),  get_permalink($data->prev_page)); ?>&TB_iframe=true&width=900&height=600">Preview</a></li>
<!--                        <li><a href="#rm-form-publish" onclick="CallModalBox(this)">Publish</a></li>-->
                </ul>
            </div>

        </div>
        <!--------Operationsbar Ends----->
                
        <?php
        if($data->total_page > 1)
            echo "<div class='rmnotice'>".RM_UI_Strings::get('MULTIPAGE_DEGRADE_WARNING')."</div>";
        ?>
        


        <div class="rm-field-creator">
            <div id="rm_form_page_tabs">
                

                    <div class="field-selector-pills">
                        
                          <div class="rm-field-manager-sorting-tip">
                                        <div class="rm-slab-drag-handle">
                                            <span class="">
                                                <img alt="" src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))) . 'images/rm-drag.png'; ?>">
                                            </span>
                                        </div>
                            <div class="rm-field-manager-sorting">Use grab handles to sort order </div>
                                    </div>
    <?php //foreach($data->form_pages as $k => $fpage)//for ($i = 1; $i <= $data->total_page; $i++)
    {$i = 1;
        ?>
                            <div id="rm_form_page<?php echo '_' . $i; ?>">
                                <div class="rm-custom-fields-page">
                                 
                                    <div class="rmrow">
<!--                                        <a class="rm_deactivated" href="javascript:void(0)">Rename Page</a>                                        
                                        <a class="rm_deactivated" href="javascript:void(0)">Delete Page</a>
                                       -->
                                    </div>
<ul class="rm-field-container rm_sortable_form_fields">
                                        <?php
                                        if ($data->fields_data)
                                        {
                                            foreach ($data->fields_data as $field_data)
                                            {
                                                
                                                ?>
                                            

                                                <li id="<?php echo $field_data->field_id ?>">
                                                    <div class="rm-custom-field-page-slab">
                                                        <div class="rm-slab-drag-handle">
                                                            <span class="rm_sortable_handle">
                                                                <img alt="" src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))) . 'images/rm-drag.png'; ?>">
                                                            </span>
                                                        </div>
                                                        <div class="rm-slab-info">
                                                            <input type="checkbox" name="rm_selected[]" onclick="rm_on_field_selection()" value="<?php echo $field_data->field_id; ?>" <?php if ($field_data->is_field_primary == 1) echo "disabled"; ?>>
                                                            <span><?php echo $field_data->field_label; ?>
                                                                <sup><?php echo $data->field_types[$field_data->field_type] ?></sup></span>

                                                        </div>
                                                        <div class="rm-slab-buttons">
                                                            <?php if (empty($field_data->is_field_primary) && in_array($field_data->field_type, $allowed_c_fields)): 
                                                                $f_options= maybe_unserialize($field_data->field_options); 
                                                                $c_count= '';
                                                                if(isset($f_options->conditions) && isset($f_options->conditions['rules']) && count($f_options->conditions['rules'])>0){
                                                                    $c_count= ''.count($f_options->conditions['rules']).'';
                                                                }
                                                            ?>    
                                                            <a href="javascript:void(0)" onClick="showConditionFormModal(<?php echo $field_data->field_id; ?>)"><?php echo RM_UI_Strings::get('LABEL_ADD_CONDITION'); ?> <span class="rm-conditions-badge"><?php echo $c_count; ?></span></a>    
                                                            <?php endif; ?>
                                                            <a onclick="edit_field_in_page('<?php echo $field_data->field_type;?>',<?php echo $field_data->field_id;?>)" href="javascript:void(0)"><?php echo RM_UI_Strings::get("LABEL_EDIT"); ?></a>

                                                            <?php
                                                            //var_dump($field_data->is_field_primary);die;
                                                            if ($field_data->is_field_primary == 1)
                                                            {
                                                                ?>
                                                                <a href="javascript:void(0)" class="rm_deactivated"><?php echo RM_UI_Strings::get("LABEL_DELETE"); ?></a>

                                                                <?php
                                                            } else
                                                            {
                                                                ?>

                                                                <a href="<?php echo '?page=rm_field_manage&rm_form_id=' . $data->form_id . '&rm_field_id=' . $field_data->field_id . '&rm_action=delete"'; ?>"><?php echo RM_UI_Strings::get("LABEL_DELETE"); ?></a>
                    <?php
                }
                ?>
                                                        </div>
                                                    </div>
                                                </li>

                                                <?php
                                            }
                                        } else
                                        {
                                            echo RM_UI_Strings::get('NO_FIELDS_MSG');
                                        }
                                        ?>    </ul>
                                    
                               
                                </div>

                            </div>
        <?php
        }
        ?>
                            <!-- Begin: Submit Field -->
                        <?php 
                            $submit_label = ($data->form_options->form_submit_btn_label) ? $data->form_options->form_submit_btn_label : "Submit";
                            $prev_label = ($data->form_options->form_prev_btn_label) ? $data->form_options->form_prev_btn_label : RM_UI_Strings::get('LABEL_PREV_FORM_PAGE');
                            $next_label = ($data->form_options->form_next_btn_label) ? $data->form_options->form_next_btn_label : "Next";
                            $btn_align = ($data->form_options->form_btn_align) ? $data->form_options->form_btn_align : "center";
                            $ralign_check_state = $lalign_check_state = $calign_check_state = "";
                            if($btn_align === "right")
                                $ralign_check_state = "checked";
                            else if($btn_align === "left")
                                $lalign_check_state = "checked";
                            else
                                $calign_check_state = "checked";
                            
                            $hideprev_check_state = (isset($data->form_options->no_prev_button) && $data->form_options->no_prev_button) ? 'checked': "";
                        ?>
                        <div class="rm-field-submit-field-holder">
                            <div class="rm-field-submit-field">
                                <div class="rm-field-submit-field-btn-container rm-field-btn-align-<?php echo $btn_align; ?>">
                                    &#8203;<!-- Zero width space character is added to workaround webkit bug where clicking outside the div enables editing of the content. -->
                                    
                                    <div class="rm-field-sub-btn rm_field_btn" id="rm_field_sub_button" title="Click to edit button label" contenteditable="true" spellcheck="false">
                                        <?php echo htmlentities(stripslashes($submit_label)); ?>
                                    </div>
                                    &#8203;
                                </div>
                                <div class="rm-field-submit-field-options">
                                    <div class="rm-field-submit-field-option-row rm-field-submit-hide-prev">&nbsp;</div>
                                    <div class="rm-field-submit-field-option-row rm-field-submit-alignment">
                                        <input type="radio" name="rm_field_submit_field_align" value="left" id="rm_field_submit_field_align_left" <?php echo $lalign_check_state; ?> ><label for="rm_field_submit_field_align_left">Left</label>
                                        <input type="radio" name="rm_field_submit_field_align" value="center" id="rm_field_submit_field_align_center" <?php echo $calign_check_state; ?> ><label for="rm_field_submit_field_align_center">Center</label>
                                        <input type="radio" name="rm_field_submit_field_align" value="right" id="rm_field_submit_field_align_right" <?php echo $ralign_check_state; ?> ><label for="rm_field_submit_field_align_right">Right</label>
                                    </div>
                                    <div class="rm-field-submit-field-option-row rm-field-submit-ajax-loader" style="visibility: hidden">
                                        Updating...
                                    </div>
                                </div>
                            </div>
                            <div class="rm-field-submit-field-hint">Click on buttons to edit label</div>
                        </div>
                        <!-- End: Submit Field -->
                                                    
                        </div>
                    </div>


                </div>


                <!----Slab View---->

               
            </form>    
            <?php 
                // Including field condition template
                include RM_ADMIN_DIR."views/template_rm_field_conditions.php";  
             ?>
    <!--- Field Selector PopUp -->


<div id="rm-field-selector" class="rm-modal-view" style="display:none">
    <div class="rm-modal-overlay"></div> 

    <div class="rm-modal-wrap">
        <div class="rm-modal-titlebar">
            <div class="rm-modal-title"> Choose a field type</div>
            <span  class="rm-modal-close">&times;</span>
        </div>
        <div class="rm-modal-container">
        <div class="rmrow">
            <div class="rm-field-selector">
                <?php require RM_ADMIN_DIR."views/template_rm_field_picker.php"; ?>
            </div>
        </div>
        </div>
    </div>
</div>

<!---End Field Selector PopUp -->

<!--- Widget Selector PopUp -->


<div id="rm-widget-selector" class="rm-modal-view" style="display:none">
    <div class="rm-modal-overlay"></div> 

    <div class="rm-modal-wrap">
        <div class="rm-modal-titlebar">
            <div class="rm-modal-title">MagicWidgets</div>
            <span  class="rm-modal-close">&times;</span>
        </div>
        <div class="rm-modal-container">
        <div class="rmrow">
            <div class="rm-widget-selector">
                <?php require RM_ADMIN_DIR."views/template_rm_widget_picker.php"; ?>
            </div>
        </div>
        </div>
    </div>
</div>

<!---End Widget Selector PopUp -->

<!--- Publish PopUp -->
<div id="rm-form-publish" class="rm-modal-view" style="display:none">
    <div class="rm-modal-overlay"></div>

    <div class="rm-modal-wrap">
        <div class="rm-modal-titlebar">
            <div class="rm-modal-title">Publish Form</div>
            <span  class="rm-modal-close">&times;</span>
        </div>
        <div class="rm-modal-container">
             <?php //require RM_ADMIN_DIR."views/template_rm_form_publish_info.php"; ?>
        </div>
    </div>
</div>
<!---End Publish PopUp -->

    <?php 
    $rm_promo_banner_title = "Unlock multi-page and all custom field types by upgrading";
    //include RM_ADMIN_DIR.'views/template_rm_promo_banner_bottom.php';
    ?>
    
    
        </div>

        <pre class='rm-pre-wrapper-for-script-tags'><script>
          
             jQuery(document).ready(function () {
                 var prev_href = jQuery("#rm_form_preview_action").attr("href");
                rm_setup_thickbox_dimensions(prev_href);
                jQuery(window).resize(function(){
                    rm_setup_thickbox_dimensions(prev_href);
                });
                
                rm_init_submit_field();
             });
             
             function rm_setup_thickbox_dimensions(_prev_href) {
            /* Seemingly hackish way to configure WP Thickbox's dimension according to user display size without using CSS, but hey, it works.*/
                var $prev_link = jQuery("#rm_form_preview_action");
                var prev_href = _prev_href || $prev_link.attr("href");
                var index = prev_href.indexOf("&width=900&height=600"),
                    prev_href_base = prev_href.substr(0,index),
                    cx = window.innerWidth*95/100,
                    cy = window.innerHeight*95/100;
                
                var new_href = prev_href_base+"&width="+cx+"&height="+cy;
                jQuery(".rm_form_preview_btn").each(function(){
                    jQuery(this).attr("href", new_href);
                });
            }
            
            function rm_dismiss_tutorial(ele, act_id){
                var data = {
                                'action': 'rm_one_time_action_update',
                                'action_id': act_id,
                                'state': 'true'
                        };
                jQuery(ele).closest('.rm_inpage_tuts').hide();                
                jQuery.post(ajaxurl, data, function(response) {});
            }
            
            function get_current_form_page() {
                return  1;
            }

            function add_new_field_to_page(field_type) {
                var curr_form_page =  1;
                var loc = "?page=rm_field_add&rm_form_id=<?php echo $data->form_id; ?>&rm_form_page_no=" + curr_form_page + "&rm_field_type";
                if (field_type !== undefined)
                    loc += ('=' + field_type);
                window.location = loc;
            }
            
            function edit_field_in_page(field_type, field_id) {
                if (field_type == undefined || field_id == undefined)
                    return;
                var curr_form_page = 1;// = (jQuery("#rm_form_page_tabs").tabs("option", "active")) + 1;
                if(["HTMLP","HTMLH","Divider","Spacing","RichText","Timer","Link","YouTubeV","Iframe"].indexOf(field_type)>=0)
                    var loc = "?page=rm_field_add_widget&rm_form_id=<?php echo $data->form_id; ?>&rm_form_page_no=" + curr_form_page + "&rm_field_type";
                else
                    var loc = "?page=rm_field_add&rm_form_id=<?php echo $data->form_id; ?>&rm_form_page_no=" + curr_form_page + "&rm_field_type";
                loc += ('=' + field_type);
                loc += "&rm_field_id="+field_id;
                window.location = loc;
            }

            function add_new_page_to_form() {
                var loc = "?page=rm_field_manage&rm_form_id=<?php echo $data->form_id; ?>&rm_action=add_page";
                window.location = loc;
            }

            function delete_page_from_page() {
                if (confirm('This will remove the page along with all the contained fields! Proceed?')) {
                var curr_form_page =  1;
                var loc = "?page=rm_field_manage&rm_form_id=<?php echo $data->form_id; ?>&rm_form_page_no=" + curr_form_page + "&rm_action=delete_page";
                window.location = loc;
                }
            }

            function rename_form_page() {
                var new_name = prompt("Please enter new name", "New Page");
                if (new_name != null)
                {
                    var curr_form_page = 1;
                    var loc = "?page=rm_field_manage&rm_form_id=<?php echo $data->form_id; ?>&rm_form_page_no=" + curr_form_page + "&rm_form_page_name=" + new_name + "&rm_action=rename_page";
                    window.location = loc;
                }
            }
            
            function rm_on_field_selection(){
                var selected_fields = jQuery("input[name='rm_selected[]']:checked");
                if(selected_fields.length > 0) {   
                    jQuery("#rm-duplicate-field").removeClass("rm_deactivated");
                    jQuery("#rm-delete-field").removeClass("rm_deactivated");
                    } else {
                    jQuery("#rm-duplicate-field").addClass("rm_deactivated");
                    jQuery("#rm-delete-field").addClass("rm_deactivated");
                }
           }     
           
           function rm_init_submit_field() {
                jQuery(".rm_field_btn").on("keydown", function(e){
                    if(e.keyCode === 13 || e.keyCode === 27) {
                        jQuery(this).blur();
                        window.getSelection().removeAllRanges();
                    } 
                })
                
                var last_label;
                
                jQuery(".rm_field_btn").on("focus", function(e){
                        var temp = jQuery(this).text().trim();
                        if(temp.length)
                            last_label = temp;
                })
                
                jQuery(".rm_field_btn").on("blur", function(e){
                        var temp = jQuery(this).text().trim();
                        if(temp.length <= 0)
                            jQuery(this).text(last_label);
                        else
                            rm_update_submit_field();
                })
                
                jQuery("input[name='rm_field_submit_field_align']").change(function(e){
                        var $btn_container = jQuery(".rm-field-submit-field-btn-container");
                        $btn_container.removeClass("rm-field-btn-align-left rm-field-btn-align-center rm-field-btn-align-right");
                        $btn_container.addClass("rm-field-btn-align-"+jQuery(this).val());
                        rm_update_submit_field();
                })
                
            }
            
            function rm_update_submit_field(){
                var data = {
                                'submit_btn_label': jQuery("#rm_field_sub_button").text().trim(),                                
                                'btn_align': jQuery("[name='rm_field_submit_field_align']:checked").val(),
                            };
                            
                var data = {
                                'action': 'rm_update_submit_field',
                                'data': data,
                                'form_id': <?php echo $data->form_id; ?>
                            };
                jQuery(".rm-field-submit-ajax-loader").css("visibility", "visible");
                jQuery.post(ajaxurl, data, function (response) {
                    jQuery(".rm-field-submit-ajax-loader").css("visibility", "hidden");
                });
            }
            
        </script></pre> 
        <?php

        function get_current_form_page_no()
        {
            ?><pre class='rm-pre-wrapper-for-script-tags'><script>               
                return (jQuery("#rm_form_page_tabs").tabs("option", "active")) + 1;
             </script></pre><?php
        }
        ?>
 
<script>
         
   function CallModalBox(ele) {
            jQuery(jQuery(ele).attr('href')).toggle();
        }
        jQuery(document).ready(function () {
            jQuery('.rm-modal-close, .rm-modal-overlay').click(function () {
                jQuery(this).parents('.rm-modal-view').hide();
            });
        });
    </script>