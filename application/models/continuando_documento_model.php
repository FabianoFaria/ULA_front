<?php
class Continuando_documento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /* Carregar dados */

    public function load_doct($idRow)
    {
        $this->db->select('*');
        $this->db->join('tbl_estados','tbl_estados.id_estado = tbl_doct.arrest_destination');
        $this->db->join('tbl_unidade_seguranca','tbl_unidade_seguranca.id_unidade = tbl_doct.security_unit');
    	$queryDoct = $this->db->get_where('tbl_doct', array('ROW_ID' => $idRow));
    	return $queryDoct->result();
    }

    function load_estados()
    {
        $query = $this->db->get('tbl_estados');
        return $query->result();
    }

    function load_paises()
    {
        $query = $this->db->get('tbl_pais');
        return $query->result();
    }

    public function load_endereco($idRow)
    { 
        $this->db->select('*');
        $this->db->join('tbl_pais','tbl_pais.Id_pais = tbl_addr.country');
        //$this->db->join('tbl_cidades','tbl_cidades.id = tbl_addr.city');
        //$this->db->join('tbl_estados','tbl_estados.id_estado = tbl_addr.state');
        $queryDoct = $this->db->get_where('tbl_addr', array('ROW_ID' => $idRow));
        return $queryDoct->result();
    }

    public function load_unidades_medidas()
    {
        $queryDoct = $this->db->get_where('tbl_unidade_medidas');
        return $queryDoct->result();
    }

    public function load_produtos()
    {

        $queryDoct = $this->db->get('tbl_produtos'); 
        return $queryDoct->result();
    }

     public function load_marcas_prod()
    {
        $queryDoct = $this->db->get('tbl_marcas_produtos');
        return $queryDoct->result();
    }

     public function load_tabacalera()
    {
        $queryDoct = $this->db->get('tbl_tabacalera');
        return $queryDoct->result();
    }

}