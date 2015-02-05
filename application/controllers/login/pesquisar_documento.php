<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pesquisar_documento extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->user->logged();
        $this->load->model('Novo_documento_model', 'documentoModel');
    }
    
    public function index() {

        $data['estados'] = $this->documentoModel->load_estados(); 
        $data['cidades'] = $this->documentoModel->load_cidades();

        $data['tipo_veiculos'] = $this->documentoModel->load_tipo_veiculo();


        $this->load->view('templates/header');
        $this->load->view('pesquisa/pesquisar_cadastros_view', $data);
        $this->load->view('templates/footer');
        
    }
}