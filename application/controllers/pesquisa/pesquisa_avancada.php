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


        echo "<tr> <th> IPL </th><th> Operação </th><th>Unidade de segurança</th><th>Data da apreensão</th>  </tr>  <tbody id='listResultadosRow'>";

        foreach ($list_documentos as $documentos) {
            //$dataCidades = $cidades;

            $dataEx = explode("-", $documentos->arrest_date);
            $month = $dataEx[1];
            $day = $dataEx[2];
            $year = $dataEx[0];

            $dataF = $day."/".$month."/".$year;

            echo "<tr><td><a href=".base_url()."index.php/detalhes_documento/getTheRow/".$documentos->ROW_ID.">".$documentos->IPL."</a></td><td>".$documentos->operation."</td><td>".$documentos->forca_seguranca."</td><td>".$dataF."</td></tr>";
        }
        
       // return $dataCidades;       

    }

    public function chamaPessoas($value)
    {
        $type = $this->input->post('type');

        $list_pessoas = $this->pesquisaAVD->load_pessoas_ajx($value); 

        $dataCidades = array();

        echo "<tr> <th> Nome do detido </th><th>RG</th><th>CPF</th><th>Data nascimento</th>  </tr>  <tbody id='listResultadosRow'>";

        foreach ($list_pessoas as $documentos) {
            //$dataCidades = $cidades;

            $dataEx = explode("-", $documentos->birth_dt);
            $month = $dataEx[1];
            $day = $dataEx[2];
            $year = $dataEx[0];

            $dataF = $day."/".$month."/".$year;


            echo "<tr> <td>  ".$documentos->name." </td><td>  ".$documentos->rg." </td><td> ".$documentos->CPF."  </td><td> ".$dataF." </td>   </tr>";
        }

        echo "</tbody>";
        
       // return $dataCidades;       
    }

    public function chamaVeiculo($value)
    {
        $type = $this->input->post('type');

        $list_veiculos = $this->pesquisaAVD->load_veiculos_ajx($value); 

        $dataCidades = array();

        echo "<tr> <th>Marca </th><th>modelo</th><th>placa</th><th> UF </th>  </tr>  <tbody id='listResultadosRow'>";

        foreach ($list_veiculos as $veiculos) {
            //$dataCidades = $cidades;

            echo "<tr> <td> ".$veiculos->marc_nome."</td><td> ".$veiculos->mode_nome."</td><td> ".$veiculos->placa."</td><td> ".$veiculos->uf."</td>   </tr>";
        }

        echo "</tbody>";
        
       // return $dataCidades;       
    }

    public function chamaEnd($value)
    {
        $type = $this->input->post('type');

        $list_enderecos = $this->pesquisaAVD->load_enderecos_ajx($value); 

        $dataCidades = array();

        echo "<tr> <th>Logradouro </th><th>Cidade</th><th>UF</th><th> CEP </th>  </tr>  <tbody id='listResultadosRow'>";

        foreach ($list_enderecos as $enderecos) {
            //$dataCidades = $cidades;

            //$dataEx = explode("-", $enderecos->arrest_date);
            //$month = $dataEx[1];
            //$day = $dataEx[2];
            //$year = $dataEx[0];

            //$dataF = $day."/".$month."/".$year;


            echo "<tr> <td>".$enderecos->address."</td><td>".$enderecos->nome."</td><td>".$enderecos->uf."</td><td>".$enderecos->zipcode."</td>   </tr>";
        }

        echo "</tbody>";
        
       // return $dataCidades;       
        
    }


} //Fim do controller