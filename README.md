# Wordpress Backoffice Form Builder

```
	$settings_name = "My Form";
	$settings_shortname = "wpbfb_my_form";
	
	 $options = array (
	            array( "name" => $settings_name, "type" => "title"),
	            array( "name" => "General", "type" => "section"),
	            array( "type" => "open"), //Open the form
	            
	            //Select Box
	            array(
	                "name" => "Select Box",
	                "desc" => "Select Box Description",
	                "id" => $settings_shortname."_my_select", //select id
	                "type" => "select", //field type
	                "options" => array( 
						            array('id' => 'true', 'name' => 'True'),
						            array('id' => 'false', 'name' => 'False'),
						        );,//options array
	                "std" => "true" //Default value
	            ),
	            
                //Textarea
                array(
                    "name" => "My Textarea",
                    "desc" => "My Textarea Description",
                    "id" => $shortname."_my_text_area",
                    "type" => "textarea",
                    "cols" => "50", //Textarea Columns
                    "rows" => "10", //Textarea Rows
                    "std" => "" //Default value
                );
	            
	            
	            //Text
                array(
                    "name" => "My Text",
                    "desc" => "My Text Description",
                    "id" => $shortname."_my_text,
                    "type" => "text",
                    "std" => "" //Default value
                );
                
                //Image
                array(
                    "name" => "My Image",
                    "desc" => "My Image Description",
                    "id" => $shortname."_my_image",
                    "type" => "image",
                    "size" => "36",
                    "std" => "" //Default value
                );
                
                
	            //Checkbox
	            
	            
	            
	            //Radio button
	            Coming soon - Not supported yet
	                
	            //multiselect
	            array(
	                "name" => "My Multiselect",
	                "desc" => "My Multiselect Description",
	                "id" => $shortname."_my_multiselect",
	                "type" => "multiselect",
	                "size" => 10,
	                "options" => array(
	                                 array( 'id' => '1', 'name' => 'Option 1')
	                                ,array( 'id' => '2', 'name' => 'Option 2')
	                                ,array( 'id' => '3', 'name' => 'Option 3')
	                                ,array( 'id' => '4', 'name' => 'Option 4')
	                            ),,
	                "std" => "0" //Default value
	            ),
	            
	            
	            array( "type" => "close") //Close the form
	        );
	
	
	$my_form = new wpbfb_FormBuilder();
	$my_form->wpbfb_form_builder_admin($settings_name,$settings_shortname,$options);

```

##Create a page

```

	/* Add to Left Menu*/
	add_menu_page($settings_name, //Page Title
	    $name, //Menu Title
	    'administrator', //Capapility
	    basename(__FILE__),  //Menu Slug
	    'my_function' //Function
	);

```

## Save the values

```
    if ((isset($_GET['page']))&&( '/'.$_GET['page'] == __FILE__ )) {
        if ((isset($_REQUEST['action']))&&( 'save' == $_REQUEST['action'] )) {
            foreach ($options as $value) {
                if($value['type']=='multiselect'){
                    $value['id'] = str_replace(']','',$value['id']);
                    $value['id'] = str_replace('[','',$value['id']);
                }
                if( isset( $_REQUEST[ $value['id'] ] ) ) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
                }
                else {
                    delete_option($value['id']);
                }
            }
            header("Location: YOUR_PAGE_PATH.php&saved=true");
            die;
        }
        else if ((isset($_REQUEST['action']))&&( 'reset' == $_REQUEST['action'] )) {
            foreach ($options as $value) {
                delete_option( $value['id'] );
            }
            header("Location: YOUR_PAGE_PATH.php&reset=true");
            die;
        }
    }
        
```

##Use the options
```

get_option( 'my_field_id');

```
