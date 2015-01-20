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


    public function tabacaleras_cadastradas()
    {
        $data['tabacaleras'] = $this->dadosDiversos->carrega_tabacalera();

        //Load templates
        $this->load->view('templates/header');
        $this->load->view('login/tabacaleras_cadastradas_view', $data);
        $this->load->view('templates/footer');

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



    public function unidade_seguranca_cadastrados()
    {
        $data['unidades_seguranca'] = $this->dadosDiversos->carrega_unidades_seguranca();
        //Load templates
        $this->load->view('templates/header');
        $this->load->view('login/unidade_seguranca_cadastrados_view', $data);
        $this->load->view('templates/footer');

    }

    public function editar_unidade($id_unidade)
    {
        $unidades_seguranca = $this->dadosDiversos->carregar_unidade_seg($id_unidade);

        $data['unidade_seg'] = $unidades_seguranca;
        $data['atualizado'] = null;

        //Load templates
        $this->load->view('templates/header');
        $this->load->view('login/modal_edit_seguranca_view', $data);
        $this->load->view('templates/footer');
    }

    public function atualizar_unidade_seguranca()
    {
        $unidades_seguranca = $_POST['nova_unidade'];
        $sigla_unidade = $_POST['sigla_unidade'];
        $id_unidade_seg = $_POST['id_unit'];

        $dataSeg['id_unidade'] = $id_unidade_seg;
        $dataSeg['nome_sigla_unidade'] = $sigla_unidade;
        $dataSeg['forca_seguranca'] = $unidades_seguranca;


        $this->dadosDiversos->atualizar_unidade_seguranca($dataSeg);

        $data['atualizado'] = "ok";
        $data['unidades_seguranca'] = $this->dadosDiversos->carrega_unidades_seguranca();

        //Load templates
        $this->load->view('templates/header');
        $this->load->view('login/unidade_seguranca_cadastrados_view', $data);
        $this->load->view('templates/footer');
    }

    public function atualizar_produto()
    {
        $IDproduto = $_POST['id_produto'];
        $statusProduto = $_POST['novoStatus'];

        $dataProduto['id_produto'] = $IDproduto;
        $dataProduto['deletado'] = $statusProduto;

         $this->dadosDiversos->atualizar_produto($dataProduto);

        exit(json_encode(array('status' => 'Atualizado', 'produto' => $IDproduto, 'status_prod' => $statusProduto)));

    }

    public function atualizar_tabacalera()
    {
        $IDtabacalera = $_POST['id_tabacalera'];
        $statusTabacalera = $_POST['novoStatus'];

        $dataTabacalera['id_tabacalera'] = $IDtabacalera;
        $dataTabacalera['deletado'] = $statusTabacalera;

         $this->dadosDiversos->atualizar_tabacalera($dataTabacalera);

        exit(json_encode(array('status' => 'Atualizado', 'tabacalera' => $IDtabacalera, 'status_taba' => $statusTabacalera)));
    }

    public function deletar_produto($id_prod)  
    {

    }

    public function cadProduto()
    {
        $produto = $_POST['nome_produto'];

        $dataProduto['nome_produto'] = $produto;
        $dataProduto['deletado'] = 0;

        $Row_prod = $this->dadosDiversos->cadastrar_produto($dataProduto);

         if(!empty($Row_prod))
       {

        exit(json_encode(array('status' => 'cadastrado', 'produto' => 'OK')));
       }else
       {
        exit(json_encode(array('status' => 'erro', 'produto' => 'vazio' )));
       }
    } 

    public function cadUnidade()
    {
        $unidade_seg = $_POST['nome_unidade'];
        $sigla_unidade = $_POST['sigla_unidade'];

        $dataUnidade['nome_sigla_unidade'] = $sigla_unidade;
        $dataUnidade['forca_seguranca'] = $unidade_seg;

        $Row_prod = $this->dadosDiversos->cadastrar_unidade_seguranca($dataUnidade);

         if(!empty($Row_prod))
       {

        exit(json_encode(array('status' => 'cadastrado', 'unidade' => 'OK')));
       }else
       {
        exit(json_encode(array('status' => 'erro', 'unidade' => 'vazio' )));
       }
    }

    public function cadTabacalera()
    {
        $tabacalera = $_POST['nome_tabacalera'];

        $dataTabacalera['nome_tabacalera'] = $tabacalera;
        $dataTabacalera['deletado'] = 0;

        $Row_tabaca = $this->dadosDiversos->cadastrar_tabacalera($dataTabacalera);

         if(!empty($Row_tabaca))
       {

        //exit(json_encode(array('status' => 'cadastrado', 'tabacalera' => 'OK')));
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'cadastrado', 'tabacalera' => 'OK'));
       }else
       {
        //exit(json_encode(array('status' => 'erro', 'tabacalera' => 'vazio' )));
         header('Content-Type: application/json');
        echo json_encode(array('status' => 'erro', 'tabacalera' => 'vazio' ));
       }
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