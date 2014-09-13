<?php
class Novo_documento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
 
    /* salvar dados */
    function cadastrar_doc($data) {
        $this->db->insert('tbl_doct', $data);
        $this->db->select_max('ROW_ID');
        $queryRow = $this->db->get('tbl_doct');

        return $queryRow->result();
    }
    function cadastrar_endereco($data_adr) {
        $this->db->insert('tbl_addr', $data_adr);
        $this->db->select_max('ID_addr');
        $RowAdr = $this->db->get('tbl_addr');

        return $RowAdr->result();
    }

    function cadastrar_veiculo($data_auto) {
        $this->db->insert('tbl_vehicle', $data_auto);
        $this->db->select_max('ID_vehicle');
        $RowAuto = $this->db->get('tbl_vehicle');

        return $RowAuto->result();
    }

    function cadastrar_mercadoria($data_haul) {
        $this->db->insert('tbl_haul', $data_haul);
        $this->db->select_max('ID_HAUL');
        $RowHaul = $this->db->get('tbl_haul');

        return $RowHaul->result();
    }

    function cadastrar_envolvido($data_detido) {
        $this->db->insert('tbl_contact', $data_detido);
        $this->db->select_max('ID_contact');
        $RowDetido = $this->db->get('tbl_contact');

        return $RowDetido->result();
    }

    function cadastrar_depodito($data_deposito) {
        $this->db->insert('tbl_wrs', $data_deposito);
        $this->db->select_max('ID_wrs');
        $RowDeposito = $this->db->get('tbl_wrs');

        return $RowDeposito->result();
    }

    function cadastrar_anexos($data_anexo) {
        $this->db->insert('tbl_anexos', $data_anexo);
        $this->db->select_max('ID_anexos');
        $RowAnexo = $this->db->get('tbl_anexos');

        return $RowAnexo->result();
    }

    function cadastrar_imagem($data_imagem) {

        $this->db->insert('tbl_image_doct', $data_imagem);
        $this->db->select_max('id_image');
        $RowAnexo = $this->db->get('tbl_image_doct');

        return $RowAnexo->result();
    }

    function cadastrar_main($data_main)
    {
     $this->db->insert('tbl_main', $data_main);
     $this->db->select_max('ID_main');
     $RowMain = $this->db->get('tbl_main');   
    }



    /* carregar dados */

    function load_paises()
    {
        $query = $this->db->get('tbl_pais');
        return $query->result();
    }

    function load_estados()
    {
        $query = $this->db->get('tbl_estados');
        return $query->result();
    }

    function load_cidades() /* sem o id do estado ainda*/
    {
        $query = $this->db->get('tbl_cidades');
        return $query->result();
    }
    function load_city_estado($id_estado)
    {
        $this->db->select('*');
        $this->db->where('estado', $id_estado);
        $cidades = $this->db->get('tbl_cidades');
        return $cidades->result();
    }

    function load_cidades_ajx($id) /* sem o id do estado ainda*/
    {
        $query = $this->db->get_where('tbl_cidades', array('estado' => $id));
        return $query->result();
    }

    function load_tipo_veiculo()
    {
        $query = $this->db->get('tbl_tipo_veiculo');
        return $query->result();
    }

    function load_marcas_veiculo($id)
    {
        $this->db->select('tpve_cod, tbl_marcas.marc_cod, marc_nome');
        $this->db->join('tbl_marcas', 'tbl_marcas.marc_cod = marca_vs_tipo.marc_cod');
        $this->db->where('tpve_cod', $id);
        $query = $this->db->get('marca_vs_tipo');
        return $query->result();
    }

    function load_modelos_veiculo($id)
    {
        $this->db->select('marc_cod, mode_cod, mode_nome');
        $this->db->where('marc_cod', $id);
        $query = $this->db->get('tbl_modelos');
        return $query->result();
    }

    function load_seguranca()
    {
        $this->db->select('*');
        $query = $this->db->get('tbl_unidade_seguranca');
        return $query->result();
    }

}