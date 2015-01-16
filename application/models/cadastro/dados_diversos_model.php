<?php
class Dados_diversos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function carrega_tabacalera()
    {
        $this->db->select('*');
        $query = $this->db->get('tbl_tabacalera');
        return $query->result();
    }

    function cadastrar_tabacalera($dadosTaba)
    {
        $this->db->insert('tbl_tabacalera', $dadosTaba);
        $this->db->select_max('id_tabacalera');
        $RowTaba = $this->db->get('tbl_tabacalera');

        return $RowTaba->result();
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

    function cadastrar_produto($dataProduto)
    {
        $this->db->insert('tbl_produtos', $dataProduto);
        $this->db->select_max('id_produto');
        $RowProd = $this->db->get('tbl_produtos');

        return $RowProd->result();
    }

    function cadastrar_unidade_seguranca($dataUnidade)
    {
        $this->db->insert('tbl_unidade_seguranca', $dataUnidade);
        $this->db->select_max('id_unidade');
        $RowProd = $this->db->get('tbl_unidade_seguranca');

        return $RowProd->result();
    }

    function atualizar_produto($dataProduto)
    {
        $this->db->where('id_produto', $dataProduto['id_produto']);
        $this->db->update('tbl_produtos', $dataProduto);

        return true;
    }

    function carrega_unidades_seguranca()
    {
        $this->db->select('*');
        $query = $this->db->get('tbl_unidade_seguranca');
        return $query->result();
    }

    function carregar_unidade_seg($id_unidade)
    {
        $this->db->select('*');
        $this->db->where('id_unidade', $id_unidade);
        $this->db->from('tbl_unidade_seguranca');
        $unidade = $this->db->get();
        return $unidade->result();
    }

    function atualizar_unidade_seguranca($dataUnidade)
    {
        $this->db->where('id_unidade', $dataUnidade['id_unidade']);
        $this->db->update('tbl_unidade_seguranca', $dataUnidade);

        return true;
    }

    function atualizar_tabacalera($dataTabacalera)
    {
        $this->db->where('id_tabacalera', $dataTabacalera['id_tabacalera']);
        $this->db->update('tbl_tabacalera', $dataTabacalera);

        return true;
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