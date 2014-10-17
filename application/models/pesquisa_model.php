<?php
class Pesquisa_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function load_docs_ajx($termo)
    {
    	$this->db->like('tbl_doct.IPL', $termo);
    	$this->db->where('tbl_doct.status_doct', 0);
		$this->db->order_by("tbl_doct.IPL", "asc"); 
		$query = $this->db->get('tbl_doct');
		return $query->result();
    }

 }


?>