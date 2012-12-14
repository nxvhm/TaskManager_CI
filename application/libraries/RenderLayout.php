<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RenderLayout
{
    /**
    ** Render header, body and footer 
    *@params string Name of the view
    *@params string Name of the view  
    *@params array  Array or Object for passing to the view
    *@return void
    **/
    public function init($header = null, $body= null, $dynamicData = null, $footer = null){
        /**Get CI instance**/
        $CI =& get_instance();
        /**Load Header if specified**/
        if($header != null){
            $CI->load->view($header);
        }
        /**Load Body**/
        if($body != null){
            if($dynamicData != null){
                $CI->load->view($body, $dynamicData);
            }else{
                $CI->load->view($body);
            }
        }
        /**Load Footer**/
        if($footer != null){
            $CI->load->view($footer);
        }
    }
}

?>
