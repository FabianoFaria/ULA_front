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

    public function load_pessoa_cpf_in_cad($cpfAlvo)
    {
        $this->db->select('*');
        $this->db->from('tbl_contact');
        $this->db->where('CPF', $cpfAlvo);
        $resultado = $this->db->get();
        return $resultado->result();
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
       // $this->db->join('tbl_wrs_addr', 'tbl_addr.ID_addr ='.$idRow);
        //$this->db->join('tbl_wrs_addr', 'tbl_wrs_addr.id_addr != tbl_addr.ID_addr');
        //$this->db->where('tbl_addr.ID_addr !=','tbl_wrs_addr.id_addr');
        $this->db->where('ROW_ID', $idRow); 
    	$endereco =	$this->db->get('tbl_addr');

    	return $endereco->result();
    }

    public function load_Addr_detalhes_doc($idRow)
    {
       $this->db->select('tbl_addr.ID_addr, tbl_addr.ROW_ID, tbl_addr.address, tbl_addr.nunber, tbl_addr.complement, tbl_addr.district, tbl_addr.city, tbl_addr.state, tbl_addr.zipcode, tbl_addr.country');
       $this->db->join('tbl_main', 'tbl_main.CHILD_ID = tbl_addr.ID_addr');
       $this->db->where('tbl_addr.ROW_ID', $idRow); 
       $endereco = $this->db->get('tbl_addr');

       return $endereco->result();
    }

    public function load_wrs_Addr($idRow)
    {  
        $this->db->select('tbl_addr.ID_addr, tbl_addr.ROW_ID, tbl_addr.address, tbl_addr.nunber, tbl_addr.complement, tbl_addr.district, tbl_addr.city, tbl_addr.state, tbl_addr.zipcode, tbl_addr.country');
        //, tbl_estados.nome_estado, tbl_cidades.nome as cidade_nome
       // $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_addr.state');
       // $this->db->join('tbl_cidades', 'tbl_addr.city = tbl_cidades.id' );
       // $this->db->join('tbl_wrs_addr', 'tbl_addr.ID_addr ='.$idRow);
        //$this->db->join('tbl_wrs_addr', 'tbl_wrs_addr.id_addr != tbl_addr.ID_addr');
        $this->db->where('tbl_addr.ID_addr !=','tbl_wrs_addr.id_addr');
        $this->db->where('ROW_ID', $idRow); 
        $endereco = $this->db->get('tbl_addr');

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
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_haul.tabacalera', 'left');
        $this->db->join('tbl_produtos','tbl_produtos.id_produto = tbl_haul.product', 'left');
        $this->db->join('tbl_marcas_produtos','tbl_marcas_produtos.id_marca = tbl_haul.brand', 'left');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_haul.unit', 'left');
    	$mercadorias = $this->db->get_where('tbl_haul', array('ROW_ID' => $idRow));
    	return $mercadorias->result();
    }

    public function carregarContatoCpf($cpfBuscar)
    {
        $this->db->select('*');
        $this->db->from('tbl_contact');
        $this->db->where('CPF', $cpfBuscar);
        $contato = $this->db->get();
        return $contato->result();

    }

    public function carregarContatoCompleto($id_Contato)
    {
       // $this->db->select('tbl_contact.ID_contact, tbl_contact.name, tbl_contact.genre, tbl_contact.CPF, tbl_contact.rg, tbl_contact.passport,
       //     tbl_contact.passport, tbl_contact.profession, tbl_contact.father, tbl_contact.mother, tbl_contact.mother, tbl_contact.birth_dt,
       //     tbl_contact.birth_city, tbl_contact.birth_state, tbl_contact.birth_country, tbl_contact.telefone, tbl_contact.marca_telefone, 
      //      tbl_contact.modelo_telefone, tbl_contact.IMEI, tbl_contact.operadora, tbl_contact.comentarios_detidos, tbl_addr.nome_estado AS ');
        $this->db->select('*');
        $this->db->from('tbl_contact');
        $this->db->join('tbl_con_addr', 'tbl_con_addr.id_con = tbl_contact.ID_contact');
        $this->db->join('tbl_addr', 'tbl_addr.ID_addr = tbl_con_addr.id_addr');
        $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_addr.state', 'left');
        $this->db->join('tbl_cidades', 'tbl_cidades.id = tbl_addr.city', 'left');
        //$this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_contact.birth_state', 'left');
        //$this->db->join('tbl_cidades', 'tbl_cidades.id = tbl_contact.birth_city', 'left');
        $this->db->where('ID_contact', $id_Contato);
        $contatoCompleto = $this->db->get();
        
        //var_dump($contatoCompleto->result());

        return $contatoCompleto->result();
    }

    public function cidadeNasci($id)
    {
      $this->db->select('*');
      $this->db->from('tbl_cidades');
      $this->db->where('id', $id);
      $cidadeNas = $this->db->get();
      return $cidadeNas->result();
    }

    public function load_Contato($idRow)
    {
        //$this->db->where('deletado', 0);
    	//$envolvidos = $this->db->get_where('tbl_contact', array('ROW_ID' => $idRow));
    	//return $envolvidos->result();

        $this->db->select('*');
        $this->db->from('tbl_contact');
        $this->db->join('tbl_main','tbl_main.CHILD_ID = tbl_contact.ID_contact');
        $this->db->where('tbl_main.parent_id', $idRow);
        $this->db->where('tbl_main.CHILD_TBL','tbl_contact');
        $envolvidos = $this->db->get();
        return $envolvidos->result();



    }

    public function load_Armazem($idRow)
    {
        $this->db->select('*');
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_wrs.tabacalera_produto_deposito', 'left');
        $this->db->join('tbl_produtos','tbl_produtos.id_produto = tbl_wrs.produto_deposito', 'left');
        $this->db->join('tbl_marcas_produtos','tbl_marcas_produtos.id_marca = tbl_wrs.marca_produto_deposito', 'left');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_wrs.unidade_produto_deposito', 'left');
        $this->db->where('tbl_wrs.deletado', 0);
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
        $this->db->join('tbl_tipo_veiculo','tbl_tipo_veiculo.tpve_cod = tbl_vehicle.category', 'left');
        $this->db->join('tbl_marcas','tbl_marcas.marc_cod = tbl_vehicle.brand' , 'left');
        $this->db->join('tbl_modelos','tbl_modelos.mode_cod = tbl_vehicle.model', 'left');
        $this->db->join('tbl_cidades','tbl_cidades.id = tbl_vehicle.city', 'left');
        $this->db->join('tbl_estados','tbl_estados.id_estado = tbl_vehicle.state', 'left');
        $auto = $this->db->get_where('tbl_vehicle', array('ID_vehicle' => $id_auto));
        return $auto->result();
    }

    public function load_single_Haul($id_haul)
    {
        $this->db->select('*');
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_haul.tabacalera', 'left');
        $this->db->join('tbl_produtos','tbl_produtos.id_produto = tbl_haul.product', 'left');
        $this->db->join('tbl_marcas_produtos','tbl_marcas_produtos.id_marca = tbl_haul.brand', 'left');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_haul.unit');
        $haul = $this->db->get_where('tbl_haul', array('ID_HAUL' => $id_haul));
        return $haul->result();
    }

    public function load_single_contato($id_Contato)
    {
        $this->db->join('tbl_pais','tbl_pais.Id_pais = tbl_contact.birth_country');
       // $this->db->join('tbl_estados','tbl_estados.id_estado = tbl_contact.birth_state');
       // $this->db->join('tbl_cidades','tbl_cidades.id = tbl_contact.birth_city');
        $this->db->join('tbl_operadora','tbl_operadora.id_operadora = tbl_contact.operadora', 'left');
        $haul = $this->db->get_where('tbl_contact', array('ID_contact' => $id_Contato));
        return $haul->result();
    }

    public function load_single_wrs($id_wrs)
    {
        $this->db->select('*');
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_wrs.tabacalera_produto_deposito', 'left');
        $this->db->join('tbl_produtos','tbl_produtos.id_produto = tbl_wrs.produto_deposito', 'left');
        $this->db->join('tbl_marcas_produtos','tbl_marcas_produtos.id_marca = tbl_wrs.marca_produto_deposito', 'left');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_wrs.unidade_produto_deposito', 'left');
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