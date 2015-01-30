<?php
class Pesquisa_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function load_docs_ajx($termo)
    {
    	$this->db->like('tbl_doct.IPL', $termo);
        $this->db->join('tbl_unidade_seguranca', 'tbl_unidade_seguranca.id_unidade = tbl_doct.security_unit', 'left');
    	$this->db->where('tbl_doct.status_doct', 0);
		$this->db->order_by("tbl_doct.IPL", "asc"); 
		$query = $this->db->get('tbl_doct');
		return $query->result();
    }


     function load_pessoas_ajx($termo)
    {
        $this->db->like('tbl_contact.name', $termo);
        $this->db->or_like('tbl_contact.CPF', $termo);
        $this->db->or_like('tbl_contact.rg', $termo);
        $this->db->or_like('tbl_contact.passport', $termo);
        $this->db->or_like('tbl_contact.father', $termo); 
        $this->db->or_like('tbl_contact.mother', $termo); 
        $this->db->or_like('tbl_contact.telefone', $termo); 
        $this->db->where('tbl_contact.deletado', 0);
        $this->db->order_by("tbl_contact.name", "asc"); 
        $query = $this->db->get('tbl_contact');
        return $query->result();
    }


    function load_veiculos_ajx($termo)
    {
        $this->db->like('tbl_vehicle.placa', $termo);
        $this->db->or_like('tbl_vehicle.chassi', $termo);
        $this->db->or_like('tbl_vehicle.renavan', $termo);
        $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_vehicle.state', 'left');
        $this->db->join('tbl_cidades', 'tbl_cidades.id = tbl_vehicle.city', 'left');
        $this->db->join('tbl_tipo_veiculo','tbl_tipo_veiculo.tpve_cod = tbl_vehicle.category', 'left');
        $this->db->join('tbl_marcas','tbl_marcas.marc_cod = tbl_vehicle.brand', 'left');
        $this->db->join('tbl_modelos','tbl_modelos.mode_cod = tbl_vehicle.model', 'left');
        $this->db->order_by("tbl_vehicle.placa", "asc"); 
        $query = $this->db->get('tbl_vehicle');
        return $query->result();
    }

    function load_enderecos_ajx($termo)
    {
        $this->db->like('tbl_addr.address', $termo);
        $this->db->or_like('tbl_addr.district', $termo);
        $this->db->or_like('tbl_addr.zipcode', $termo);
        $this->db->join('tbl_cidades','tbl_cidades.id = tbl_addr.city', 'left');
        $this->db->join('tbl_estados','tbl_estados.id_estado = tbl_addr.state', 'left');
        $this->db->order_by("tbl_addr.state", "asc"); 
        $query = $this->db->get('tbl_addr');
        return $query->result();
    }

    function envolvidoPessoas($idPessoas)
    {
        $this->db->select('*');
        $this->db->join('tbl_main', 'tbl_main.parent_id = tbl_addr.city', 'left');
        $this->db->where();
        $query = $this->db->get('tbl_doct');
        return $query->result();

    }

    function envolvidoVeiculo($idVeiculos)
    {
        $this->db->select('*');
        $this->db->join('tbl_main', 'tbl_main.parent_id = tbl_doct.ROW_ID');
        $this->db->join('tbl_vehicle','tbl_vehicle.ID_vehicle = tbl_main.CHILD_ID');
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_contact');
        $this->db->where('tbl_vehicle.ID_vehicle', $idVeiculos);
        $query = $this->db->get('tbl_doct');
        return $query->result();
    }

    function envolvimentoEndereco($idAddr)
    {
        $this->db->select('*');
        $this->db->join();
        $this->db->where();
        $query = $this->db->get('tbl_doct');
        return $query->result();
    }


 }


?>