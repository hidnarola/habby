<?php

class Seo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    public function get_page_meta($page){
        return $this->db->where('page',$page)->get('seo')->row_array();
    }
}

?>