<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Continuando_documento extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model', 'user');
        $this->load->model('Novo_documento_model', 'documentoModel');
        $this->load->model('Continuando_documento_model', 'Cont_doct');
        $this->load->model('Detalhes_documento_model', 'DetalhesModel');
        $this->user->logged();
    }
    
    public function index() {

        
        
    }

    public function continueDoc($idRow)
    {
         $data['estados'] = $this->documentoModel->load_estados(); 
         $data['cidades'] = $this->documentoModel->load_cidades();
         $data['unidades_seguranca'] = $this->documentoModel->load_seguranca();
    	 $data['ROW_id'] = $idRow;
    	 $data['documento'] = $this->Cont_doct->load_doct($idRow);


    	//Data de libraryes

        $this->load->helper('form');
        $this->load->helper('url');
        
        //Load templates
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_documento_view', $data);
        $this->load->view('templates/footer');


    }

    public function Endereco($idRow)
    {
        $data['id_Row'] = $idRow;
        $data['ROW_id'] = $idRow;

        $data['paises'] = $this->documentoModel->load_paises();
        $data['estados'] = $this->documentoModel->load_estados(); 
        $data['cidades'] = $this->documentoModel->load_cidades();
        $data['estadoAdr'] = null;
        $data['cidadeAdr'] = null;
        $data['cidadesSingle'] = null;

        $data['endereco'] = $this->Cont_doct->load_endereco($idRow); //load_endereco_doct
        //Estrutura para tornar o endereço optativo
        if($data['endereco'] != null)
        {
            if($data['endereco'][0]->state != null)
            {
                $data['estadoAdr'] = $this->DetalhesModel->load_Addr_estado($data['endereco'][0]->state);
                $data['cidadesSingle'] = $this->documentoModel->load_city_estado($data['endereco'][0]->state);

                //var_dump($data['cidades']);
                //die;
            }else
            {
                $data['estadoAdr'] = null;
            }

            if($data['endereco'][0]->city != null)
            {
             $data['cidadeAdr'] = $this->DetalhesModel->load_Addr_city($data['endereco'][0]->city);
            }else
            {
                $data['cidadeAdr'] = null;
            }
        }

        $data['documento'] = $this->Cont_doct->load_doct($idRow);

        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_endereco_view', $data);
        $this->load->view('templates/footer');
    }

     public function CadEndereco($idRow)
    {
        $data['id_Row'] = $idRow;
        $data['ROW_id'] = $idRow;

        $data['paises'] = $this->documentoModel->load_paises();
        $data['estados'] = $this->documentoModel->load_estados(); 
        $data['cidades'] = $this->documentoModel->load_cidades();
        $data['estadoAdr'] = null;
        $data['cidadeAdr'] = null;
        $data['cidadesSingle'] = null;

        $data['endereco'] = null;

        $data['documento'] = $this->Cont_doct->load_doct($idRow);

        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_endereco_view', $data);
        $this->load->view('templates/footer');
    }


    public function Mercadorias($idRow)
    {   
        $data['row_haul'] = null; //variavel setada para null em caso de nova mercadoria
        $data['id_Row'] = $idRow;
        $data['documento'] = $this->Cont_doct->load_doct($idRow);
        $data['unidades_medidas'] = $this->Cont_doct->load_unidades_medidas();
        $data['produtos'] = $this->Cont_doct->load_produtos();
        $data['marcas_prod'] = $this->Cont_doct->load_marcas_prod();
        $data['tabacaleira'] = $this->Cont_doct->load_tabacalera();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_mercadorias_view', $data);
        $this->load->view('templates/footer');
    }

    public function Detidos($idRow)
    {
        $data['row_contact'] = null;
        $data['id_Row'] = $idRow;
        $data['paises'] = $this->documentoModel->load_paises();
        $data['estados'] = $this->documentoModel->load_estados();
        $data['cidades'] = $this->documentoModel->load_cidades();
        $data['operadoras'] = $this->documentoModel->load_operadoras();
        $data['endereco'] = null;

        //var_dump($data['operadoras']);
        //die;

        $data['documento'] = $this->Cont_doct->load_doct($idRow);
        //$data['endereco'] = $this->Cont_doct->load_endereco_detido($idRow);

        $data['estadoAdr'] = null;
        $data['cidadeAdr'] = null;
        $data['cidadesSingle'] = null;


        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('cadastro/cadastrar_Detidos_view', $data);
        $this->load->view('templates/footer');
    }

    public function recuperaDetidoCpf()
    {
        $CpfProcurar = $_POST['cpfDetidoP'];

        $detido = $this->load_pessoa_cpf_in_cad($CpfProcurar);

        var_dump($detido);

         echo json_encode(array('status' => 'status', 'msg' => 'msg', 'file_new_name' => 'file_new_name', 'id_frame' => 'id_frame' ));
    }

    public function recuperaDetidoRG()
    {
        
    }

    public function Veiculos($idRow)
    {   
        $data['row_Auto'] = null; //Dado settado em null pois essa função é para cadastrar novo carro
        $data['id_Row'] = $idRow;
        $data['documento'] = $this->Cont_doct->load_doct($idRow);
        $data['estados'] = $this->documentoModel->load_estados(); 
        $data['cidades'] = $this->documentoModel->load_cidades();
        $data['tipo_veiculos'] = $this->documentoModel->load_tipo_veiculo();
        $data['cidadeAdr'] = null;
        $data['estadoAdr'] = null;

        $data['cidadeAdd'] = null;
        $data['estadoAdd'] = null;
        $data['cidadeAdd2'] = null;
        $data['estadoAdd2'] = null;


        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_automoveis_view', $data);
        $this->load->view('templates/footer');
    }

    public function Depositos($idRow)
    {
        $data['singleS'] = null;
        $data['row_local'] = null;
        $data['id_Row'] = $idRow;
        $data['endereco'] = $this->Cont_doct->load_endereco_wrs($idRow);
       
        if($data['endereco'] != null)
        {
            $data['singleS'] = $this->documentoModel->load_city_estado($data['endereco'][0]->state);
        }
      
        $data['documento'] = $this->Cont_doct->load_doct($idRow);

        $data['estados'] = $this->documentoModel->load_estados(); 
        $data['cidades'] = $this->documentoModel->load_cidades();

        $data['unidades_medidas'] = $this->Cont_doct->load_unidades_medidas();
        $data['produtos'] = $this->Cont_doct->load_produtos();
        $data['marcas_prod'] = $this->Cont_doct->load_marcas_prod();
        $data['tabacaleira'] = $this->Cont_doct->load_tabacalera();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_locais_view', $data);
        $this->load->view('templates/footer');
    }

    public function NotasAnexos($idRow)
    {
        $data['row_anexo'] = null;
        $data['id_Row'] = $idRow;
        $data['documento'] = $this->Cont_doct->load_doct($idRow);
       // $data['anexos'] = $this->Cont_doct->load_anexos($idRow);

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_nota_anexos_view', $data);
        $this->load->view('templates/footer');
    }

    public function Imagens_doct($idRow)
    {
        $data['row_image'] = null;
        $data['id_Row'] = $idRow;
        $data['documento'] = $this->Cont_doct->load_doct($idRow);
       // $data['anexos'] = $this->Cont_doct->load_anexos($idRow);

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('cadastro/dados_image_doct_view', $data);
        $this->load->view('templates/footer');
    }

}