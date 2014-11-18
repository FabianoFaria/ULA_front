<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cadastro_conteudo extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('User_model', 'user');
        $this->load->model('cadastro/Dados_diversos_model', 'dadosDiversos');
        $this->user->logged();
    }


    public function index() 
    {
       

    }

    public function produtos_cadastrados()
    {
        $data['produtos'] = $this->dadosDiversos->carrega_produtos();
        $data['marcas_produtos'] = $this->dadosDiversos->carrega_marcas();

        //Load templates
        $this->load->view('templates/header');
        $this->load->view('login/produtos_cadastrados_view', $data);
        $this->load->view('templates/footer');

    }

    public function atualizar_produto($id_prod)
    {

    }

    public function deletar_produto($id_prod)
    {

    }


    public function veiculos_cadastrados()
    {
        $data['modelo_auto'] = $this->dadosDiversos->carrega_modelos_automoveis($idRow);
        $data['marcas_auto'] = $this->dadosDiversos->carrega_marcas_automoveis($idRow);
        $data['marcas_auto'] = $this->dadosDiversos->carrega_tipo_automoveis($idRow);

        //Load templates
        $this->load->view('templates/header');
        $this->load->view('login/detalhes_documento_view', $data);
        $this->load->view('templates/footer');

    }

    public function tipo_veiculos_cadastrados($id_prod)
    {

    }

    public function modelos_cadastrados($id_prod)
    {

    }


}