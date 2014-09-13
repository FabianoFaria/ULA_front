<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detalhes_documento extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('User_model', 'user');
        $this->load->model('Novo_documento_model', 'documentoModel');
        $this->load->model('Continuando_documento_model', 'Cont_doct');
        $this->load->model('Detalhes_documento_model', 'DetalhesModel');
        $this->user->logged();
    }
    
    public function index($idRow) {
        $data['Ultimo_documento'] = $this->DetalhesModel->load_Ipls($idRow);
        $data['unidade_seguranca'] = $this->DetalhesModel->load_unidade_seg($idRow);
        $data['endereco'] =  $this->DetalhesModel->load_Addr($idRow);
        $data['cidadeAdr'] = null;
        $data['estadoAdr'] = null;

        if(!empty($data['endereco']))
        {
            if($data['endereco'][0]->state != "")
            {
                $data['estadoAdr'] = $this->DetalhesModel->load_Addr_estado($data['endereco'][0]->state);
            }else
            {
                $data['estadoAdr'] = null;
            }

            if($data['endereco'][0]->city != "")
            {
             $data['cidadeAdr'] = $this->DetalhesModel->load_Addr_city($data['endereco'][0]->state);
            }else
            {
                $data['cidadeAdr'] = null;
            }
        }
        // var_dump($data['estadoAdr']);
        //var_dump($data['cidadeAdr']);
         //die; 

      //  array
  //0 => 
    //object(stdClass)[23]
      //public 'ID_addr' => string '90' (length=2)
      //public 'ROW_ID' => string '117' (length=3)
      //public 'address' => string 'Rua alvorada' (length=12)
      //public 'nunber' => string '234342' (length=6)
      //public 'complement' => string '' (length=0)
      //public 'district' => string '' (length=0)
      //public 'city' => string '2004' (length=4)
      //public 'state' => string '09' (length=2)
      //public 'zipcode' => string '' (length=0)
      //public 'country' => string '33' (length=2)
      //public 'nome_estado' => string 'GoiÃ¡s' (length=6)
      //public 'cidade_nome' => string 'Alto Alvorada' (length=13)


        //var_dump($data['endereco']);
        //die;

        $data['automoveis'] =  $this->DetalhesModel->load_Auto($idRow);
        $data['mercadorias'] =  $this->DetalhesModel->load_Mercadoria($idRow);
        $data['envolvidos'] =  $this->DetalhesModel->load_Contato($idRow);
        $data['locais'] =  $this->DetalhesModel->load_Armazem($idRow);
        $data['anexos'] = $this->DetalhesModel->load_anexos($idRow);
        $data['fotos'] =  $this->DetalhesModel->load_images($idRow);
        $this->load->helper('form');
        
        //Load templates
        $this->load->view('templates/header');
        $this->load->view('login/detalhes_documento_view', $data);
        $this->load->view('templates/footer');
        
    }

    public function getTheRow($row_id)
    {
        $this->index($row_id);
    }

    public function atualizar_auto($row_id, $row_Auto)
    {

        $data['row_Auto'] = $row_Auto;
        $data['id_Row'] = $row_id;
        $data['automoveis'] =  $this->DetalhesModel->load_single_auto($row_Auto);
        $data['documento'] = $this->Cont_doct->load_doct($row_id);
        $data['estados'] = $this->documentoModel->load_estados(); 
        $data['cidades'] = $this->documentoModel->load_cidades();
        $data['tipo_veiculos'] = $this->documentoModel->load_tipo_veiculo();

        //load templates
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_automoveis_view', $data);
        $this->load->view('templates/footer');
    }

    public function atualizar_mercadoria($row_id, $row_Haul)
    {

        $data['row_haul'] = $row_Haul;
        $data['id_Row'] = $row_id;
        $data['mercadoria'] =  $this->DetalhesModel->load_single_Haul($row_Haul);
        $data['documento'] = $this->Cont_doct->load_doct($row_id);
        $data['unidades_medidas'] = $this->Cont_doct->load_unidades_medidas();
        $data['produtos'] = $this->Cont_doct->load_produtos();
        $data['marcas_prod'] = $this->Cont_doct->load_marcas_prod();
        $data['tabacaleira'] = $this->Cont_doct->load_tabacalera();


        //load templates
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_mercadorias_view', $data);
        $this->load->view('templates/footer');
    }

    public function atualizar_contato($row_id, $row_contact)
    {
        $data['row_contact'] = $row_contact;
        $data['id_Row'] = $row_id;
        $data['paises'] = $this->documentoModel->load_paises();
        $data['estados'] = $this->documentoModel->load_estados(); 
        $data['cidades'] = $this->documentoModel->load_cidades();
        $data['endereco'] = $this->Cont_doct->load_endereco($row_id);
        $data['contato'] =  $this->DetalhesModel->load_single_contato($row_contact);
        $data['documento'] = $this->Cont_doct->load_doct($row_id);

        //load templates
        $this->load->view('templates/header');
        $this->load->view('cadastro/cadastrar_Detidos_view', $data);
        $this->load->view('templates/footer');
    }

    public function atualizar_warehouse($row_id, $row_local)
    {

        $data['row_local'] = $row_local;
        $data['id_Row'] = $row_id;
        $data['local'] =  $this->DetalhesModel->load_single_wrs($row_local);
        $data['documento'] = $this->Cont_doct->load_doct($row_id);

        $data['endereco'] = $this->Cont_doct->load_endereco($row_id);

        $data['unidades_medidas'] = $this->Cont_doct->load_unidades_medidas();
        $data['produtos'] = $this->Cont_doct->load_produtos();
        $data['marcas_prod'] = $this->Cont_doct->load_marcas_prod();
        $data['tabacaleira'] = $this->Cont_doct->load_tabacalera();

        //load templates
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_locais_view', $data);
        $this->load->view('templates/footer');
    }

    public function atualizar_anexos($row_id, $row_anexo)
    {

        $data['row_anexo'] = $row_anexo;
        $data['id_Row'] = $row_id;
        $data['anexo'] =  $this->DetalhesModel->load_single_anexo($row_anexo);
        $data['documento'] = $this->Cont_doct->load_doct($row_id);

        //load templates
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_nota_anexos_view', $data);
        $this->load->view('templates/footer');
    }

    public function atualizar_img($row_id, $row_image)
    {

        $data['row_image'] = $row_image;
        $data['id_Row'] = $row_id;
        $data['image_full'] =  $this->DetalhesModel->load_single_image($row_image);
        $data['documento'] = $this->Cont_doct->load_doct($row_id);

        //load templates
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_image_doct_view', $data);
        $this->load->view('templates/footer');
    }


}