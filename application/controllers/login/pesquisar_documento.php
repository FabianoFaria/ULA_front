<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pesquisar_documento extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->user->logged();
    }
    
    public function index() {

        $this->load->view('templates/header');
        $this->load->view('pesquisa/pesquisar_documento_view');
        $this->load->view('templates/footer');
        
    }
}