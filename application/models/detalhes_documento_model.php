<?php

// "Deixei o vaso se partir... só me resta saber quanto ouro precisarei para preencher suas rachaduras... e seguir adiante..."
// https://www.youtube.com/watch?v=NLzpXciijjA
// Foi tão rápido quando um sonho... mas foi tão intenso quanto uma tempestade... assim é a vida, algumas coisas só duram o suficiente para serem memoráveis...
 


class Detalhes_documento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /* Carregar dados */
    public function load_Ipls($row_id)
    {   
        $this->db->select('*');
        $this->db->join('tbl_estados','tbl_estados.id_estado = tbl_doct.arrest_destination');
        $this->db->join('tbl_unidade_seguranca','tbl_unidade_seguranca.id_unidade = tbl_doct.security_unit');
    	$lastDoct = $this->db->get_where('tbl_doct', array('ROW_ID' => $row_id));
    	return $lastDoct->result();
    }

    public function load_unidade_seg($row_id)
    {
        $this->db->select('forca_seguranca');
        $this->db->join('tbl_unidade_seguranca', 'tbl_unidade_seguranca.id_unidade = tbl_doct.security_unit');
        $lastDoct = $this->db->get_where('tbl_doct', array('ROW_ID' => $row_id));
        return $lastDoct->result();
    }

    public function load_Addr($idRow)
    {  
        $this->db->select('tbl_addr.ID_addr, tbl_addr.ROW_ID, tbl_addr.address, tbl_addr.nunber, tbl_addr.complement, tbl_addr.district, tbl_addr.city, tbl_addr.state, tbl_addr.zipcode, tbl_addr.country');
        //, tbl_estados.nome_estado, tbl_cidades.nome as cidade_nome
       // $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_addr.state');
       // $this->db->join('tbl_cidades', 'tbl_addr.city = tbl_cidades.id' );
        $this->db->where('ROW_ID', $idRow); 
    	$endereco =	$this->db->get('tbl_addr');

    	return $endereco->result();
    }

    public function load_Addr_estado($id_estado)
    {
        $this->db->select('*');
        $this->db->where('id_estado',$id_estado);
        $estadoAdr = $this->db->get('tbl_estados');
        return $estadoAdr->result();
    }

    public function load_Addr_city($id_cidade)
    {
        $this->db->select('*');
        $this->db->where('id',$id_cidade);
        $estadoAdr = $this->db->get('tbl_cidades');
        return $estadoAdr->result();
    }

    public function load_Auto($idRow)
    {   
        $this->db->select('tbl_vehicle.ID_vehicle, tbl_vehicle.ROW_ID, tbl_vehicle.category, tbl_vehicle.model, tbl_vehicle.brand, tbl_vehicle.chassi, tbl_vehicle.renavan, tbl_vehicle.placa, tbl_estados.nome_estado as nome_estado, tbl_cidades.nome as cidade_nome, tbl_modelos.mode_nome, tbl_marcas.marc_nome, tbl_tipo_veiculo.tpve_nome');
        $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_vehicle.state', 'left');
        $this->db->join('tbl_cidades', 'tbl_cidades.id = tbl_vehicle.city', 'left');
        $this->db->join('tbl_tipo_veiculo','tbl_tipo_veiculo.tpve_cod = tbl_vehicle.category', 'left');
        $this->db->join('tbl_marcas','tbl_marcas.marc_cod = tbl_vehicle.brand', 'left');
        $this->db->join('tbl_modelos','tbl_modelos.mode_cod = tbl_vehicle.model', 'left');
    	$this->db->where('tbl_vehicle.ROW_ID', $idRow);
        $automoveis = $this->db->get('tbl_vehicle');

        //var_dump($automoveis);
       // die;
    	return $automoveis->result();
    }

    public function load_Mercadoria($idRow)
    {
        $this->db->select('*');
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_haul.tabacalera');
        $this->db->join('tbl_produtos','tbl_produtos.id_produto = tbl_haul.product');
        $this->db->join('tbl_marcas_produtos','tbl_marcas_produtos.id_marca = tbl_haul.brand');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_haul.unit');
    	$mercadorias = $this->db->get_where('tbl_haul', array('ROW_ID' => $idRow));
    	return $mercadorias->result();
    }

    public function load_Contato($idRow)
    {
    	$envolvidos = $this->db->get_where('tbl_contact', array('ROW_ID' => $idRow));
    	return $envolvidos->result();
    }

    public function load_Armazem($idRow)
    {
        $this->db->select('*');
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_wrs.tabacalera_produto_deposito');
        $this->db->join('tbl_produtos','tbl_produtos.id_produto = tbl_wrs.produto_deposito');
        $this->db->join('tbl_marcas_produtos','tbl_marcas_produtos.id_marca = tbl_wrs.marca_produto_deposito');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_wrs.unidade_produto_deposito');
		$locais = $this->db->get_where('tbl_wrs', array('ROW_ID' => $idRow));
    	return $locais->result();
    }
    public function load_anexos($idRow)
    {
        $anexos = $this->db->get_where('tbl_anexos', array('id_row' => $idRow));
        return $anexos->result();
    }
    public function load_images($idRow)
    {
        $fotos = $this->db->get_where('tbl_image_doct', array('id_row' => $idRow));
        return $fotos->result();
    }

    //Comandos para carregar dados de apenas um unico registro

    public function load_single_auto($id_auto)
    {
        $this->db->select('*');
        $this->db->join('tbl_tipo_veiculo','tbl_tipo_veiculo.tpve_cod = tbl_vehicle.category');
        $this->db->join('tbl_marcas','tbl_marcas.marc_cod = tbl_vehicle.brand');
        $this->db->join('tbl_modelos','tbl_modelos.mode_cod = tbl_vehicle.model');
        //$this->db->join('tbl_cidades','tbl_cidades.id = tbl_vehicle.city');
        //$this->db->join('tbl_estados','tbl_estados.id_estado = tbl_vehicle.state');
        $auto = $this->db->get_where('tbl_vehicle', array('ID_vehicle' => $id_auto));
        return $auto->result();
    }

    public function load_single_Haul($id_haul)
    {
        $this->db->select('*');
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_haul.tabacalera');
        $this->db->join('tbl_produtos','tbl_produtos.id_produto = tbl_haul.product');
        $this->db->join('tbl_marcas_produtos','tbl_marcas_produtos.id_marca = tbl_haul.brand');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_haul.unit');
        $haul = $this->db->get_where('tbl_haul', array('ID_HAUL' => $id_haul));
        return $haul->result();
    }

    public function load_single_contato($id_Contato)
    {
        $this->db->join('tbl_pais','tbl_pais.Id_pais = tbl_contact.birth_country');
       // $this->db->join('tbl_estados','tbl_estados.id_estado = tbl_contact.birth_state');
       // $this->db->join('tbl_cidades','tbl_cidades.id = tbl_contact.birth_city');
        $haul = $this->db->get_where('tbl_contact', array('ID_contact' => $id_Contato));
        return $haul->result();
    }

    public function load_single_wrs($id_wrs)
    {
        $this->db->select('*');
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_wrs.tabacalera_produto_deposito');
        $this->db->join('tbl_produtos','tbl_produtos.id_produto = tbl_wrs.produto_deposito');
        $this->db->join('tbl_marcas_produtos','tbl_marcas_produtos.id_marca = tbl_wrs.marca_produto_deposito');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_wrs.unidade_produto_deposito');
        $wrs = $this->db->get_where('tbl_wrs', array('ID_wrs' => $id_wrs));
        return $wrs->result();
    }

    public function load_single_anexo($id_anexo)
    {
        $wrs = $this->db->get_where('tbl_anexos', array('ID_anexos' => $id_anexo));
        return $wrs->result();
    }

    public function load_single_image($id_image)
    {
        $full_image = $this->db->get_where('tbl_image_doct', array('id_image' => $id_image));
        return $full_image->result();
    }

}