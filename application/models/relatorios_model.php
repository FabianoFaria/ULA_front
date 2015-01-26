<?php
class Relatorios_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }



    /* carregar dados para o relatorio */

    function load_documentos($data1 , $data2, $estado)
    {	
    	//$data1 ="2014-08-01";
    	//$data2 ="2014-08-30";

    	$this->db->select('ROW_ID');
    	$where = "tbl_doct.arrest_date BETWEEN '$data1%' AND '$data2%'";
        if($estado != "")
        {
            $this->db->where('tbl_doct.arrest_destination', $estado);
        }
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

    function load_nome_estado_destino($estadoDestino)
    {
        $this->db->select('*');
        $this->db->where('tbl_estados.id_estado', $estadoDestino);
        $query = $this->db->get('tbl_estados');
        return $query->result();  
    }


    function load_documento_completo($idDoct)
    {
    	// public 'ROW_ID' => string '45' (length=2)
        //$this->db->distinct('tbl_main.parent_id');
    	//$this->db->select('*');
    	//$this->db->where('tbl_main.parent_id', $idDoct);
    	//$this->db->join('tbl_doct','tbl_doct.ROW_ID = tbl_main.parent_id');
        $this->db->select('*');
         $this->db->order_by("tbl_doct.arrest_date", "desc"); 
        $this->db->join('tbl_unidade_seguranca','tbl_unidade_seguranca.id_unidade = tbl_doct.security_unit', 'left');
        $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_doct.arrest_destination', 'left');
        $this->db->where('tbl_doct.ROW_ID', $idDoct);
    	$query = $this->db->get('tbl_doct');
        return $query->result();  
    }

    function load_documento_endereco($idDoct)
    {
    	// public 'ROW_ID' => string '45' (length=2)

    	//$this->db->select('*');        tbl_addr. 
        $this->db->select('tbl_addr.ID_addr, tbl_addr.address, tbl_addr.nunber, tbl_addr.complement, tbl_addr.district, tbl_estados.nome_estado, tbl_estados.uf, tbl_cidades.nome');
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

    /*
          object(stdClass)[56]
      public 'ID_main' => string '300' (length=3)
      public 'ROW_ID' => string '131' (length=3)
      public 'parent_id' => string '131' (length=3)
      public 'parent_TBL' => string 'tbl_doct' (length=8)
      public 'CHILD_ID' => string '40' (length=2)
      public 'CHILD_TBL' => string 'tbl_haul' (length=8)
      public 'UPDATED_BY' => string 'qwe' (length=3)
      public 'LAST_UPDATE' => string '2014-09-28 19:08:40' (length=19)
      public 'CREATED_BY' => string 'qwe' (length=3)
      public 'CREATED' => string '2014-09-28 19:08:40' (length=19)
      public 'ID_HAUL' => string '40' (length=2)
      public 'product' => string '3' (length=1)
      public 'unit' => string '3' (length=1)
      public 'qty' => string '23' (length=2)
      public 'brand' => string '' (length=0)
      public 'tabacalera' => string '' (length=0)
      public 'id_unidade_medida' => string '3' (length=1)
      public 'sigla_unidade' => string 'un' (length=2)
      public 'unidade_medida' => string 'Unidades' (length=8)
      public 'id_tabacalera' => null
      public 'nome_tabacalera' => null
      public 'descricao' => null
      public 'deletado' => string '0' (length=1)
      public 'id_marca' => null
      public 'nome_marca' => null
      public 'img_logo' => null
      public 'id_produto' => string '3' (length=1)
      public 'nome_produto' => string 'Cds' (length=3)
    */



    function load_mercadoria_relatorio($idDoct)
    {
        $this->db->select('tbl_haul.ID_HAUL, tbl_haul.qty, tbl_produtos.nome_produto, tbl_marcas_produtos.nome_marca, tbl_tabacalera.nome_tabacalera, tbl_unidade_medidas.unidade_medida');
        $this->db->join('tbl_haul','tbl_haul.ID_HAUL = tbl_main.CHILD_ID');
        $this->db->join('tbl_unidade_medidas','tbl_unidade_medidas.id_unidade_medida = tbl_haul.unit', 'left');
        $this->db->join('tbl_tabacalera','tbl_tabacalera.id_tabacalera = tbl_haul.tabacalera', 'left');
        $this->db->join('tbl_marcas_produtos','tbl_marcas_produtos.id_marca = tbl_haul.brand', 'left');
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
    	$this->db->select('tbl_vehicle.ID_vehicle, tbl_vehicle.ROW_ID, tbl_vehicle.category, tbl_vehicle.model, tbl_vehicle.brand, tbl_vehicle.cor_veiculo, tbl_vehicle.chassi, tbl_vehicle.renavan, tbl_vehicle.placa, tbl_vehicle.placa_extra, tbl_vehicle.placa_extra2, tbl_estados.nome_estado as nome_estado, tbl_estados.uf as uf_estado, tbl_cidades.nome as cidade_nome, tbl_modelos.mode_nome, tbl_marcas.marc_nome, tbl_tipo_veiculo.tpve_nome');
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
        //tbl_contact.ID_contact, tbl_contact.name, tbl_contact.CPF, tbl_contact.rg, tbl_contact.passport, tbl_contact.father, tbl_contact.mother, tbl_contact.birth_dt, tbl_pais.nome_pais, tbl_estados.nome_estado, tbl_cidades.nome'
        //paisL.nome_pais, tbl_addr.
        $this->db->select('tbl_contact.ID_contact, tbl_contact.name, tbl_contact.CPF, tbl_contact.rg, tbl_contact.profession, tbl_contact.passport, tbl_contact.father, tbl_contact.mother,
         tbl_contact.birth_dt, tbl_pais.nome_pais, tbl_estados.nome_estado, tbl_estados.uf, tbl_cidades.nome,tbl_addr.ID_addr, tbl_addr.address, tbl_addr.nunber, 
         tbl_addr.complement, tbl_addr.district, paisL.nome_pais as end_pais, estadoL.nome_estado as end_est, estadoL.uf as end_uf, cidadeL.nome as end_Cid,
         tbl_contact.telefone ,tbl_contact.marca_telefone ,tbl_contact.IMEI ,tbl_contact.operadora, tbl_operadora.nome_operadora');
        $this->db->join('tbl_contact','tbl_contact.ID_contact = tbl_main.CHILD_ID');
        $this->db->join('tbl_pais', 'tbl_pais.Id_pais = tbl_contact.birth_country', 'left');
        $this->db->join('tbl_estados', 'tbl_estados.id_estado = tbl_contact.birth_state', 'left');
        $this->db->join('tbl_cidades', 'tbl_cidades.id = tbl_contact.birth_city', 'left');
        $this->db->join('tbl_con_addr','tbl_con_addr.id_con = tbl_contact.ID_contact', 'left');
        $this->db->join('tbl_addr','tbl_addr.ID_addr = tbl_con_addr.id_addr', 'left');
        $this->db->join('tbl_operadora','tbl_operadora.id_operadora = tbl_contact.operadora', 'left');

        $this->db->join('tbl_pais AS paisL', 'paisL.Id_pais = tbl_addr.country', 'left');
        $this->db->join('tbl_estados AS estadoL', 'estadoL.id_estado = tbl_addr.state', 'left');
        $this->db->join('tbl_cidades AS cidadeL', 'cidadeL.id = tbl_addr.city', 'left');

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

    function load_armazem_relatorio($idRow)
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

    //Carregar o endereço do deposito... falta adaptar...

    function load_endereco_wrs_relatorio($idRow)
    {
        $this->db->select('*');
        $this->db->join('tbl_cidades','tbl_cidades.id = tbl_addr.city', 'left');
        $this->db->join('tbl_estados','tbl_estados.id_estado = tbl_addr.state', 'left');
        $this->db->join('tbl_main', 'tbl_main.parent_id = tbl_addr.ROW_ID');
        $this->db->join('tbl_wrs_addr', 'tbl_wrs_addr.id_addr = tbl_addr.ID_addr');
        $this->db->join('tbl_wrs','tbl_wrs.ID_wrs = tbl_wrs_addr.id_wrs');
        $this->db->where('tbl_wrs.deletado', 0);
        $this->db->where('tbl_addr.ROW_ID', $idRow);
        $queryDoct = $this->db->get('tbl_addr');
        return $queryDoct->result();
    }

    function total_veiculos_relatorio($inicio, $final, $id_estado)
    {

        /*
        $this->db->count_all('tbl_vehicle.ID_vehicle');
        $this->db->distinct('tbl_vehicle.ID_vehicle');
        $this->db->join('tbl_vehicle','tbl_vehicle.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->where('tbl_main.parent_id', $idDoct);
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_vehicle');
        $query = $this->db->get('tbl_main');
        return $query->result();
        */


        $this->db->select('*');
        $this->db->join('tbl_main','tbl_doct.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_vehicle');
        $where = "tbl_doct.arrest_date BETWEEN '$inicio%' AND '$final%'";
        $this->db->where($where);
        if($id_estado != "")
            {
                $this->db->where('tbl_doct.arrest_destination', $id_estado);
            }
        $this->db->where('tbl_doct.status_doct','0');
        $query = $this->db->get('tbl_doct');
        return $query->num_rows();  

    }

    function total_veiculos_caminhao_relatorio($inicio, $final, $id_estado)
    {
        $this->db->select('*');
        $this->db->join('tbl_main','tbl_doct.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_vehicle');
        $this->db->join('tbl_vehicle','tbl_vehicle.ID_vehicle = tbl_main.CHILD_ID', 'left');
        $this->db->where('tbl_vehicle.category', '2');
        $where = "tbl_doct.arrest_date BETWEEN '$inicio%' AND '$final%'";
        $this->db->where($where);
        if($id_estado != "")
        {
            $this->db->where('tbl_doct.arrest_destination', $id_estado);
        }
        $this->db->where('tbl_doct.status_doct','0');
        $query = $this->db->get('tbl_doct');
        return $query->num_rows();  

    }

    function total_veiculos_onibus_relatorio($inicio, $final, $id_estado)
    {
        $this->db->select('*');
        $this->db->join('tbl_main','tbl_doct.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_vehicle');
        $this->db->join('tbl_vehicle','tbl_vehicle.ID_vehicle = tbl_main.CHILD_ID', 'left');
        $this->db->where('tbl_vehicle.category', '5');
        $where = "tbl_doct.arrest_date BETWEEN '$inicio%' AND '$final%'";
        $this->db->where($where);
        if($id_estado != "")
        {
            $this->db->where('tbl_doct.arrest_destination', $id_estado);
        }
        $this->db->where('tbl_doct.status_doct','0');
        $query = $this->db->get('tbl_doct');
        return $query->num_rows();  

    }

    function total_caixa_cigarros($inicio, $final, $id_estado)
    {
        //$this->db->select('*');
        $this->db->select_sum('tbl_haul.qty');
        $this->db->join('tbl_main','tbl_doct.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_haul');
        $this->db->join('tbl_haul','tbl_haul.ID_HAUL = tbl_main.CHILD_ID', 'left');
        $this->db->where('tbl_haul.product', '10');
        $this->db->where('tbl_haul.unit', '7');
        $where = "tbl_doct.arrest_date BETWEEN '$inicio%' AND '$final%'";
        $this->db->where($where);
        if($id_estado != "")
        {
            $this->db->where('tbl_doct.arrest_destination', $id_estado);
        }
        $this->db->where('tbl_doct.status_doct','0');
        $query = $this->db->get('tbl_doct');
        return $query->result();

    }

    function total_caixa_cigarros_wrs($inicio, $final, $id_estado)
    {
        //$this->db->select('*');
        $this->db->select_sum('tbl_wrs.quantidade_deposito');
        $this->db->join('tbl_main','tbl_doct.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_wrs');
        $this->db->join('tbl_wrs','tbl_wrs.ID_wrs = tbl_main.CHILD_ID', 'left');
        $this->db->where('tbl_wrs.produto_deposito', '10');
        $this->db->where('tbl_wrs.unidade_produto_deposito', '7');
        $where = "tbl_doct.arrest_date BETWEEN '$inicio%' AND '$final%'";
        $this->db->where($where);
        if($id_estado != "")
        {
            $this->db->where('tbl_doct.arrest_destination', $id_estado);
        }
        $this->db->where('tbl_doct.status_doct','0');
        $query = $this->db->get('tbl_doct');
        return $query->result();

    }

    function total_depositos($inicio, $final, $id_estado)
    {
        $this->db->select('*');
        $this->db->join('tbl_main','tbl_doct.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_wrs');
        $where = "tbl_doct.arrest_date BETWEEN '$inicio%' AND '$final%'";
        $this->db->where($where);
        if($id_estado != "")
        {
            $this->db->where('tbl_doct.arrest_destination', $id_estado);
        }
        $this->db->where('tbl_doct.status_doct','0');
        $query = $this->db->get('tbl_doct');
        return $query->num_rows();
    }

    function total_detidos($inicio, $final, $id_estado)
    {
        $this->db->select('*');
        $this->db->join('tbl_main','tbl_doct.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_contact');
        $this->db->join('tbl_contact','tbl_contact.ID_contact = tbl_main.CHILD_ID', 'left');
        $where = "tbl_doct.arrest_date BETWEEN '$inicio%' AND '$final%'";
        $this->db->where($where);
        if($id_estado != "")
        {
            $this->db->where('tbl_doct.arrest_destination', $id_estado);
        }
        $this->db->where('tbl_doct.status_doct','0');
        $this->db->where('tbl_contact.name !=',' ');
        $query = $this->db->get('tbl_doct');
        return $query->num_rows();
    }

    function total_ocorrencias($inicio, $final, $id_estado)
    {
        $this->db->select('*');
        $this->db->join('tbl_main','tbl_doct.ROW_ID = tbl_main.parent_id', 'left');
        $this->db->where('tbl_main.CHILD_TBL', null);
        $where = "tbl_doct.arrest_date BETWEEN '$inicio%' AND '$final%'";
        $this->db->where($where);
        if($id_estado != "")
        {
            $this->db->where('tbl_doct.arrest_destination', $id_estado);
        }
        $this->db->where('tbl_doct.status_doct','0');
        $query = $this->db->get('tbl_doct');
        return $query->num_rows();
    }

}

?>