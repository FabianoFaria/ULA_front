<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pesquisa_avancada extends CI_Controller {
    
    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->model('User_model', 'user');
        $this->load->model('Novo_documento_model', 'documentoModel');
        $this->load->model('pesquisa_model', 'pesquisaAVD');
        $this->user->logged();
    }

     public function index() {


        $this->load->view('templates/header');
        $this->load->view('pesquisa/pesquisar_documento_view');
        $this->load->view('templates/footer');
        
    }

    public function gerarRelatorios()
    {
        $this->load->view('templates/header');
        $this->load->view('pesquisa/gera_relatorio_view');
        $this->load->view('templates/footer');
    }

    public function chamaDoct($value)
    {

         $type = $this->input->post('type');

        $list_documentos = $this->pesquisaAVD->load_docs_ajx($value); 

        $dataCidades = array();


        foreach ($list_documentos as $documentos) {
            //$dataCidades = $cidades;

            $dataEx = explode("-", $documentos->arrest_date);
            $month = $dataEx[1];
            $day = $dataEx[2];
            $year = $dataEx[0];

            $dataF = $day."/".$month."/".$year;

            echo "<tr><td><a href=".base_url()."index.php/detalhes_documento/getTheRow/".$documentos->ROW_ID.">".$documentos->IPL."</a></td><td>".$documentos->operation."</td><td>".$documentos->security_unit."</td><td>".$dataF."</td></tr>";
        }
        
       // return $dataCidades;       

    }


} //Fim do controller