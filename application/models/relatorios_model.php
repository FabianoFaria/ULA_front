<?php
class Relatorios_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }



    /* carregar dados para o relatorio */

    function load_documentos($data1 , $data2)
    {	
    	//$data1 ="2014-08-01";
    	//$data2 ="2014-08-30";

    	$this->db->select('ROW_ID');
    	$where = "tbl_doct.arrest_date BETWEEN '$data1%' AND '$data2%'";
		$this->db->where($where);
		$this->db->where('tbl_doct.status_doct','0');
		$query = $this->db->get('tbl_doct');
        return $query->result();  



		//$dateRange = "tdate BETWEEN '$start_date%' AND '$end_date%'";
		//$this->db->where($dateRange, NULL, FALSE);  

		//$this->db->select('*');
		 //$this->db->where('arrest_date BETWEEN '.$data1.' AND '.$data2.'', NULL, FALSE);
		 //$this->db->order_by('arrest_date', 'asc');

		// $query = $this->db->get('tbl_doct');
         //return $query->result();  

    	//$this->db->where('','');
        //$query = $this->db->get('tbl_doct');
        //return $query->result();
    }


    function load_documento_completo($idDoct)
    {
    	// public 'ROW_ID' => string '45' (length=2)
        //$this->db->distinct('tbl_main.parent_id');
    	//$this->db->select('*');
    	//$this->db->where('tbl_main.parent_id', $idDoct);
    	//$this->db->join('tbl_doct','tbl_doct.ROW_ID = tbl_main.parent_id');
        $this->db->select('*');
        $this->db->join('tbl_unidade_seguranca','tbl_unidade_seguranca.id_unidade = tbl_doct.security_unit');
        $this->db->where('tbl_doct.ROW_ID', $idDoct);
    	$query = $this->db->get('tbl_doct');
        return $query->result();  
    }

    function load_documento_endereco($idDoct)
    {
    	// public 'ROW_ID' => string '45' (length=2)

    	$this->db->select('*');
    	//$this->db->distinct('ROW_ID');
    	$this->db->join('tbl_addr','tbl_addr.ROW_ID = tbl_main.parent_id');
        $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_addr.state');
        $this->db->join('tbl_cidades', 'tbl_addr.city = tbl_cidades.id' );
        $this->db->where('tbl_addr.ROW_ID', $idDoct);
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_addr');
    	$query = $this->db->get('tbl_main');
        return $query->result();  
    }


    function load_documento_auto($idDoct)
    {
    	// public 'ROW_ID' => string '45' (length=2)
        $this->db->distinct('tbl_vehicle.ID_vehicle');
    	$this->db->select('tbl_vehicle.ID_vehicle, tbl_vehicle.ROW_ID, tbl_vehicle.category, tbl_vehicle.model, tbl_vehicle.brand, tbl_vehicle.chassi, tbl_vehicle.renavan, tbl_vehicle.placa, tbl_estados.nome_estado as nome_estado, tbl_cidades.nome as cidade_nome, tbl_modelos.mode_nome, tbl_marcas.marc_nome, tbl_tipo_veiculo.tpve_nome');
        $this->db->join('tbl_vehicle','tbl_vehicle.ROW_ID = tbl_main.parent_id');
        $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_vehicle.state');
        $this->db->join('tbl_cidades', 'tbl_cidades.id = tbl_vehicle.city');
        $this->db->join('tbl_tipo_veiculo','tbl_tipo_veiculo.tpve_cod = tbl_vehicle.category');
        $this->db->join('tbl_marcas','tbl_marcas.marc_cod = tbl_vehicle.brand');
        $this->db->join('tbl_modelos','tbl_modelos.mode_cod = tbl_vehicle.model');
    	$this->db->where('tbl_main.parent_id', $idDoct);
    	$this->db->where('tbl_main.CHILD_TBL', 'tbl_vehicle');
    	$query = $this->db->get('tbl_main');
        return $query->result();  
    }

    function load_documento_imagens($idDoct)
    {
    	// public 'ROW_ID' => string '45' (length=2)

    	$this->db->select('*');
    	$this->db->distinct('ROW_ID');
    	$this->db->where('tbl_main.parent_id', $idDoct);
    	$this->db->where('tbl_main.CHILD_TBL', 'tbl_image_doct');
    	$this->db->join('tbl_image_doct','tbl_image_doct.ROW_ID = tbl_main.parent_id');
    	$query = $this->db->get('tbl_main');
        return $query->result();  
    }



}



?>