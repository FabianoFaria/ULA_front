<?php
class Dados_diversos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function carrega_produtos()
    {
    	$this->db->select('*');
    	$query = $this->db->get('tbl_produtos');
        return $query->result();
    }

    function carrega_marcas()
    {
    	$this->db->select('*');
    	$query = $this->db->get('tbl_marcas_produtos');
        return $query->result();
    }


    /** carregar veiculos **/

    function carrega_modelos_automoveis()
    {
    	$this->db->select('*');
    	$query = $this->db->get('tbl_modelos');
        return $query->result();
    }

    function carrega_marcas_automoveis()
    {
    	$this->db->select('*');
    	$query = $this->db->get('tbl_marcas');
        return $query->result();
    }

    function carrega_tipo_automoveis()
    {
    	$this->db->select('*');
    	$query = $this->db->get('tbl_tipo_veiculo');
        return $query->result();
    }


}