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
        $this->db->join('tbl_unidade_seguranca','tbl_unidade_seguranca.id_unidade = tbl_doct.security_unit', 'left');
        $this->db->where('tbl_doct.ROW_ID', $idDoct);
    	$query = $this->db->get('tbl_doct');
        return $query->result();  
    }

    function load_documento_endereco($idDoct)
    {
    	// public 'ROW_ID' => string '45' (length=2)

    	//$this->db->select('*');        tbl_addr. 
        $this->db->select('tbl_addr.ID_addr, tbl_addr.address, tbl_addr.nunber, tbl_addr.complement, tbl_addr.district, tbl_estados.nome_estado, tbl_cidades.nome');
    	//$this->db->distinct('ROW_ID');
    	$this->db->join('tbl_addr','tbl_addr.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_addr.state', 'left');
        $this->db->join('tbl_cidades', 'tbl_addr.city = tbl_cidades.id', 'left');
        //$this->db->join('tbl_con_addr','tbl_con_addr.id_addr != tbl_addr.ID_addr');
       // $this->db->join('tbl_wrs_addr','tbl_wrs_addr.id_addr != tbl_addr.ID_addr');
        $this->db->where('tbl_addr.ROW_ID', $idDoct);
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_addr');
    	$query = $this->db->get('tbl_main');
        return $query->result();  
    }

    function load_mercadoria_relatorio($idDoct)
    {
        $this->db->select('*');
        $this->db->join('tbl_haul','tbl_haul.ID_HAUL = tbl_main.CHILD_ID');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_haul.unit', 'left');
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_haul.tabacalera', 'left');
        $this->db->join('tbl_marcas','tbl_marcas.marc_cod = tbl_haul.brand', 'left');
        $this->db->join('tbl_produtos','tbl_produtos.id_produto = tbl_haul.product', 'left');
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_haul');
        $this->db->where('tbl_main.parent_id', $idDoct);
        $query = $this->db->get('tbl_main');
        return $query->result();  
    }

    function load_documento_auto($idDoct)
    {
    	// public 'ROW_ID' => string '45' (length=2)
        $this->db->distinct('tbl_vehicle.ID_vehicle');
    	$this->db->select('tbl_vehicle.ID_vehicle, tbl_vehicle.ROW_ID, tbl_vehicle.category, tbl_vehicle.model, tbl_vehicle.brand, tbl_vehicle.chassi, tbl_vehicle.renavan, tbl_vehicle.placa, tbl_estados.nome_estado as nome_estado, tbl_cidades.nome as cidade_nome, tbl_modelos.mode_nome, tbl_marcas.marc_nome, tbl_tipo_veiculo.tpve_nome');
        $this->db->join('tbl_vehicle','tbl_vehicle.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_vehicle.state', 'left');
        $this->db->join('tbl_cidades', 'tbl_cidades.id = tbl_vehicle.city', 'left');
        $this->db->join('tbl_tipo_veiculo','tbl_tipo_veiculo.tpve_cod = tbl_vehicle.category', 'left');
        $this->db->join('tbl_marcas','tbl_marcas.marc_cod = tbl_vehicle.brand', 'left');
        $this->db->join('tbl_modelos','tbl_modelos.mode_cod = tbl_vehicle.model', 'left');
    	$this->db->where('tbl_main.parent_id', $idDoct);
    	$this->db->where('tbl_main.CHILD_TBL', 'tbl_vehicle');
    	$query = $this->db->get('tbl_main');
        return $query->result();  
    }

    function load_documento_imagens($idDoct)
    {
    	// public 'ROW_ID' => string '45' (length=2) nome_image_doct  title_image

    	$this->db->select('tbl_image_doct.nome_image_doct, tbl_image_doct.title_image');
    	$this->db->distinct('tbl_main.ID_main');
        $this->db->join('tbl_image_doct','tbl_image_doct.id_row = tbl_main.parent_id');
    	$this->db->where('tbl_main.parent_id', $idDoct);
    	$this->db->where('tbl_main.CHILD_TBL', 'tbl_image_doct');
    	$query = $this->db->get('tbl_main');
        return $query->result();  
    }

    function load_documento_envolvidos($idDoct)
    {
        $this->db->select('tbl_contact.ID_contact, tbl_contact.name, tbl_contact.CPF, tbl_contact.rg, tbl_contact.passport, tbl_contact.father, tbl_contact.mother, tbl_contact.birth_dt, tbl_pais.nome_pais, tbl_estados.nome_estado, tbl_cidades.nome');
        $this->db->join('tbl_contact','tbl_contact.ID_contact = tbl_main.CHILD_ID');
        $this->db->join('tbl_pais', 'tbl_pais.Id_pais = tbl_contact.birth_country', 'left');
        $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_contact.birth_state', 'left');
        $this->db->join('tbl_cidades', 'tbl_cidades.id = tbl_contact.birth_city', 'left');
        $this->db->where('tbl_main.parent_id', $idDoct);
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_contact');
        $query = $this->db->get('tbl_main');
        return $query->result();
    }

    function load_documento_warehouse($idDoct)
    {
        $this->db->select('*');
        $this->db->join('tbl_wrs','tbl_wrs.ID_wrs = tbl_main.parent_id');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_wrs.unidade_produto_deposito', 'left');
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_wrs.tabacalera_produto_deposito', 'left');
        $this->db->join('tbl_marcas','tbl_marcas.marc_cod = tbl_wrs.marca_produto_deposito', 'left');
        $this->db->join('tbl_produtos','tbl_produtos.id_produto = tbl_wrs.produto_deposito', 'left');
        $this->db->where('tbl_main.parent_id', $idDoct);
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_wrs');
        $query = $this->db->get('tbl_main');
        return $query->result();
    }

}



?>