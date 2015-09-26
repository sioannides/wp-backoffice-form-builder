<?php
    class wpbfb_FormBuilder{
        public function wpbfb_form_builder_admin($name,$shortname,$options) {
            $i=0;
            ?>

            <div class="col-lg-12">
            <h2><strong><?php echo $name; ?></strong> Settings</h2>
            <div class="col-lg-12">
            <form method="post" role="form">
            <table class="wp-list-table widefat fixed pages" style="width:70%">
            <?php foreach ($options as $value) {
                switch ( $value['type'] ) {
                    case "open":
                        ?>

                        <?php
                        break;
                    case "close":
                        ?>
                        </div>
                        </div>
                        <br />
                        <?php
                        break;
                    case "diviter":
                        ?>
                        <tr>
                            <td>
                                <hr/>
                            </td>
                        </tr>
                        <?php
                        break;
                    case "title":
                        ?>
                        <?php echo $value['name']; ?>
                        <?php
                        break;
                    case 'text':
                        ?>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
                                    <input
                                        class="form-control"
                                        name="<?php echo $value['id']; ?>"
                                        id="<?php echo $value['id']; ?>"
                                        type="<?php echo $value['type']; ?>"
                                        value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
                                    <br/>
                                    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                                </div>
                            </td>
                        </tr>
                        <?php
                        break;
                    case 'textarea':
                        ?>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
                            <textarea
                                name="<?php echo $value['id']; ?>"
                                type="<?php echo $value['type']; ?>"
                                cols="<?php echo $value['cols']; ?>"
                                rows="<?php echo $value['rows']; ?>"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
                                    <?php if(trim($value['desc'])!=''){ ?>
                                        <br/>
                                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                        break;
                    case 'select':
                        ?>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
                                    <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                                        <?php foreach ($value['options'] as $option) { ?>
                                            <option value="<?php echo $option['id'];?>" <?php if (get_option( $value['id'] ) == $option['id']) { echo 'selected="selected"'; } ?>><?php echo $option['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if(trim($value['desc'])!=''){ ?>
                                        <br/>
                                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                        <?php
					        break;
					        case 'multiselect':
					    ?>
					    <tr>
					        <td>
					            <div class="checkbox">
					                <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
					                <select multiple="multiple" size="<?php echo $value['size']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					                    <?php
					                        $value['id'] = str_replace(']','',$value['id']);
					                        $value['id'] = str_replace('[','',$value['id']);
					                        $selected_options = get_option( $value['id']);
					                    ?>
					                    <?php foreach ($value['options'] as $option) { ?>
					                        <option value="<?php echo $option['id']; ?>" <?php if (in_array($option['id'],$selected_options)) { echo 'selected="selected"'; } ?>><?php echo $option['name']; ?></option>
					                    <?php } ?>
					                </select>
					                <?php if(trim($value['desc'])!=''){ ?>
					                    <br/>
					                    <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
					                <?php } ?>
					            </div>
					        </td>
					    </tr>
                        <?php
                        break;
                    case "checkbox":
                        ?>
                        <tr>
                            <td>
                                <div class="regular-text">
                                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
                                    <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
                                    <input
                                        class="form-control"
                                        type="checkbox"
                                        name="<?php echo $value['id']; ?>"
                                        id="<?php echo $value['id']; ?>"
                                        value="true" <?php echo $checked; ?> />
                                    <br/>
                                    <?php if(trim($value['desc'])!=''){ ?>
                                        <br/>
                                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                        break;
                    case "diviter":
                        ?>
                        <tr>
                            <td>
                                <hr/>
                            </td>
                        </tr>
                        <?php
                        break;
                    case "image":
                        ?>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></label><br/>
                                    <input
                                        class="regular-text"
                                        size="<?php echo $value['size']; ?>"
                                        name="<?php echo $value['id']; ?>"
                                        id="<?php echo $value['id']; ?>"
                                        type="text"
                                        value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
                                    <input class="button button-primary" id="<?php echo $value['id']; ?>_button" type="button" value="Upload Image" />
                                    <?php if(trim($value['desc'])!=''){ ?>
                                        <br/>
                                        <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
                                    <?php } ?>
                                </div>
                                <script>
                                    jQuery(document).ready(function () {
                                        jQuery('#<?php echo $value['id']; ?>_button').click(function () {
                                            uploadID = jQuery(this).prev('input'); /*grab the specific input*/
                                            formfield = jQuery('#<?php echo $value['id']; ?>').attr('name');
                                            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                                            return false;
                                        });
                                        window.send_to_editor = function (html) {
                                            imgurl_<?php echo $value['id']; ?> = jQuery('img', html).attr('src');
                                            uploadID.val(imgurl_<?php echo $value['id']; ?>);
                                            tb_remove();
                                        }
                                    });
                                </script>
                            </td>
                        </tr>

                        <?php
                        break;
                    case "section":
                        $i++;
                        ?>

                        <tr>
                            <td align="right">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <span class="submit"><input name="save<?php echo $i; ?>" type="submit"  class="button button-primary" value="Save changes" /></span>
                                        <div class="clearfix"></div>
                                    </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <h3><?php echo $value['name']; ?></h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="form-group">
                        <?php break;
                }
            }
            ?>
            <input type="hidden" name="action" value="save" />
            </table>
            </form>

            <form method="post">
                <p class="submit">
                    <input class="button action" name="reset" type="submit" value="Reset" />
                    <input type="hidden" name="action" value="reset" />
                </p>
            </form>

            </div>
        <?php
        }
}
?>