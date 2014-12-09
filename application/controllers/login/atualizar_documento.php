<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Atualizar_documento extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Atualizar_documento_model', 'atualizar');
        $this->load->model('User_model', 'user');
        $this->user->logged();
    }
    
    public function index() {

        $data['last_docs'] = $this->atualizar->load_ultimos_Ipls();

        $this->load->view('templates/header');
        $this->load->view('login/atualizar_documento_view',$data);
        $this->load->view('templates/footer');
        
    }

    public function view($row_id)
    {
        echo $row_id;
        redirect('detalhes_documento/getTheRow/'.$row_id.'');
    }

    //Funções para atualizar os dados das tabelas...

/******************************************************************************************/

    public function atualizaDoc()
    {

        //$user_name = $this->session->userdata('nome_usr');
        $user_name = $this->session->userdata('username');
        $dataAtualizacao = date('y-m-d H:i:s');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');

       
        if(($this->input->post('dataOps')) == "")
        {
             $finalDate = date('y-m-d');
        }else
        if(strstr($this->input->post('dataOps'), '/', true)){
            //echo "/";
            //die;

            $tempData =explode(" ", $this->input->post('dataOps'));

            $dataEx = explode("/", $tempData[0]);

            //var_dump($dataEx);

            $month = $dataEx[1];
            $day = $dataEx[0];
            $year = $dataEx[2];
            $finalDate = $year."-".$month."-".$day;

        }else
        if(strstr($this->input->post('dataOps'), '-', true))
        {
            $finalDate = $this->input->post('dataOps');
        }

            //var_dump($finalDate);
            //die;


        $data['ROW_ID'] = $this->input->post('Row_id');
        $data['IPL'] = $this->input->post('IPLValue');
        $data['qualification'] = $this->input->post('qualificacao');
        $data['security_unit'] = $this->input->post('unidade_seguranca');
        $data['arrest_date'] = $finalDate;
        $data['link_arrest'] = $this->input->post('linkOps');
        $data['summary'] = strtoupper(strtr($this->input->post('resumoOps') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $data['operation'] = strtoupper(strtr($this->input->post('nomeOps') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $data['arrest_destination'] = $this->input->post('destinoCarga');
        $data['UPDATE_BY'] = $user_name;
        $data['LAST_UPDATE'] = $dataAtualizacao;
        

        //var_dump($data);
       // die;

        $update = null;

        $update = $this->atualizar->atualiza_doct($data);

        if($update == true)
        {
            redirect('/detalhes_documento/getTheRow/'.$this->input->post('Row_id').'');
        }

    }

    public function atualizaAddr()
    {
        $user_name = $this->session->userdata('username');
        $dataAtualizacao = date('y-m-d H:i:s');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');

       //  $row->ROW_ID;
         $dataAdr['Adr_ID'] = $this->input->post('Addr_id');          
         $dataAdr['ROW_ID'] = $this->input->post('Row_id');
         $dataAdr['address'] = strtoupper(strtr($this->input->post('endereco') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
         $dataAdr['nunber'] = strtoupper(strtr($this->input->post('numero_addr') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
         $dataAdr['complement'] = strtoupper(strtr($this->input->post('complemento') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
         $dataAdr['district'] = strtoupper(strtr($this->input->post('bairro') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
         $dataAdr['country'] = $this->input->post('pais_apr');
         $dataAdr['city'] = $this->input->post('cidade_apr');
         $dataAdr['state'] = $this->input->post('estado_apr');
         $dataAdr['zipcode'] = $this->input->post('CEP');
         $dataAdr['UPDATED_BY'] = $user_name;
         $dataAdr['LAST_UPDATE'] = $dataAtualizacao;

        $Row_adr = false;
        $Row_adr = $this->atualizar->atualiza_addr($dataAdr);

        if($Row_adr != false)
        {
            redirect('detalhes_documento/getTheRow/'.$this->input->post('Row_id').'');
        }

    }


    public function Atualizar_veiculo()
    {
        $user_name = $this->session->userdata('username');
        $dataAtualizacao = date('y-m-d H:i:s');
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');

        
       //  $row->ROW_ID;
         $dataAuto['ID_auto'] = $this->input->post('');
         $dataAuto['ROW_ID'] = $this->input->post('row_id');  
         $dataAuto['category'] = $this->input->post('cat_veiculo');          
         $dataAuto['model'] = $this->input->post('mod_veiculo');
         $dataAuto['brand'] = $this->input->post('mark_veiculo');
         $dataAuto['chassi'] =  strtoupper(strtr($this->input->post('chassi') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
         $dataAuto['renavan'] =  strtoupper(strtr($this->input->post('renavan') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
         $dataAuto['placa'] =  strtoupper(strtr($this->input->post('placa_n') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
         $dataAuto['city'] = $this->input->post('cidade');
         $dataAuto['state'] = $this->input->post('estado');
         $dataAuto['UPDATE_BY'] = $user_name;
         $dataAuto['LAST_UPDATE'] = $dataAtualizacao;
         
        // $dataAuto['city'] = $this->input->post('cidade_apr');
       //  $dataAuto['state'] = $this->input->post('estado_apr');

        $Row_auto = null;
        $Row_auto = $this->documentoModel->cadastrar_veiculo($dataAuto);

        if($Row_auto != false)
        {
            redirect('/detalhes_documento/getTheRow/'.$this->input->post('row_id').'');
        }

    }

    /* funcão para apagar o documento... */
/*************************************************************************************/

    public function deletar_doct($ID_ROW)
    {
        $resultado = $this->atualizar->deleta_doct($ID_ROW);

        if($resultado == true)
        {
            redirect('/area_restrita');
        }

    }

    /* funcoes para apagar documentos... */
/***********************************************************************************/

    public function deletar_mercadoria($ID_ROW, $ID_haul)
    {
        $resultado = $this->atualizar->deleta_mercadoria($ID_haul);

        if($resultado == true)
        {
            redirect('/detalhes_documento/getTheRow/'.$ID_ROW.'');
        }

    }

    public function deleta_pessoas($ID_ROW, $ID_contat)
    {
        $resultado = $this->atualizar->deleta_pessoas($ID_contat);

        if($resultado == true)
        {
            redirect('/detalhes_documento/getTheRow/'.$ID_ROW.'');
        }

    }

    public function deleta_auto($ID_ROW, $ID_auto)
    {
        $resultado = $this->atualizar->deleta_automoveis($ID_auto);

        if($resultado == true)
        {
            redirect('/detalhes_documento/getTheRow/'.$ID_ROW.'');
        }

    }

    public function deleta_wrs($ID_ROW, $ID_wrs)
    {
        $resultado = $this->atualizar->deleta_wrs($ID_wrs);

        if($resultado == true)
        {
            redirect('/detalhes_documento/getTheRow/'.$ID_ROW.'');
        }

    }

    public function deleta_anexo ($ID_ROW, $ID_anexo)
    {

        $resultado = $this->atualizar->deleta_anexos($ID_anexo);

        if($resultado == true)
        {
            redirect('/detalhes_documento/getTheRow/'.$ID_ROW.'');
        }

    }

    public function deleta_image ($ID_ROW, $ID_image)
    {

        $resultado = $this->atualizar->deleta_image($ID_image);

        if($resultado == true)
        {
            redirect('/detalhes_documento/getTheRow/'.$ID_ROW.'');
        }

    }

}