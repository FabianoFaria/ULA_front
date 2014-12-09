<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Novo_documento extends CI_Controller {
    
    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->model('User_model', 'user');
        $this->load->model('Novo_documento_model', 'documentoModel');
        $this->load->model('Atualizar_documento_model', 'atualizarDoct');
        $this->user->logged();
    }
    
    public function index() {

        $data['estados'] = $this->documentoModel->load_estados(); 
        $data['cidades'] = $this->documentoModel->load_cidades();
        $data['unidades_seguranca'] = $this->documentoModel->load_seguranca();
        $data['IPL'] = $this->geraIPL();  

        //Data de libraryes

        $this->load->helper('form');
        
        //Load templates
        $this->load->view('templates/header');
        $this->load->view('login/novo_documento_view', $data);
        $this->load->view('templates/footer');
        
    }

    public function geraIPL()
    {
        $dateNow = date("Y");
        $dayNow = date("d");
        $hourNow = date("H");
        $minNow = date("i");

        $randomN = rand(0, 999);

        $stringDate = $randomN."".$minNow."/".$dateNow;

        return $stringDate;
    }

    public function echou()
    {
        echo "nanana";
    }

    public function cadastrarProtocolo() {

    $user_name = $this->session->userdata('username');
    $dataAtualizacao = date('y-m-d H:i:s');


        var_dump($this->input->post('dataOps'));
       // die;

        $finalDate = "";
        

        if(($this->input->post('dataOps')) == "")
        {
             $finalDate = date('y-m-d');
        }else
        if(strstr($this->input->post('dataOps'), '/', true)){
            //echo "/";
            //die;

            $dataEx = explode("/", $this->input->post('dataOps'));
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

        $data['IPL'] = strtoupper(strtr($this->input->post('Ipl_manual') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $data['qualification'] = $this->input->post('qualificacao');
        $data['security_unit'] = $this->input->post('unidade_seguranca');
        $data['arrest_date'] = $finalDate;
        $data['link_arrest'] = $this->input->post('linkOps');
        $data['summary'] = strtoupper(strtr($this->input->post('resumoOps') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $data['operation'] =   strtoupper(strtr($this->input->post('nomeOps') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
        $data['arrest_destination'] = $this->input->post('destinoCarga');
        $data['CREATED_BY'] = $user_name;
        $data['CREATED'] = $dataAtualizacao;
        $data['UPDATE_BY'] = $user_name;
        $data['LAST_UPDATE'] = $dataAtualizacao;


        $Row_id = null;

        $Row_id = $this->documentoModel->cadastrar_doc($data);

        if ($Row_id != null) {
          
            //Salvar o registro do documento na tabela main

            $Novo_main = null;

            $rowOBJ = $Row_id[0]; //Objeto para recuperar o id do documento

            //var_dump($rowOBJ);

          // die();

            //Salvar o documento na tabela MAIN

            $row_main['ROW_ID'] = $rowOBJ->ROW_ID; 
            $row_main['parent_TBL'] = 'tbl_doct';
            $row_main['parent_id'] = $rowOBJ->ROW_ID;
            $row_main['CHILD_ID'] = null;
            $row_main['CHILD_TBL'] = null;
            $row_main['CREATED_BY'] = $user_name;
            $row_main['CREATED'] = $dataAtualizacao;

            //var_dump($row_main);
            //die;

           $Novo_main = $this->documentoModel->cadastrar_main($row_main); 

           //Redirecionar para a pagina de detalhes do documento
           $param = $rowOBJ->ROW_ID; //Salvar o endereço na tabela main
           redirect('detalhes_documento/index/'.$param.'');

        
        }
    }


    public function cadastro_endereco()
    {
        $user_name = $this->session->userdata('username');
        $dataAtualizacao = date('y-m-d H:i:s');

            $dataAdr['ROW_ID'] = $this->input->post('Row_id');
            $dataAdr['address'] = strtoupper(strtr($this->input->post('endereco') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
            $dataAdr['nunber'] = strtoupper(strtr($this->input->post('numero_addr') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
            $dataAdr['complement'] = strtoupper(strtr($this->input->post('complemento') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
            $dataAdr['district'] = strtoupper(strtr($this->input->post('bairro') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
            $dataAdr['country'] = $this->input->post('pais_apr');
            $dataAdr['city'] = $this->input->post('cidade_apr');
            $dataAdr['state'] = $this->input->post('estado_apr');
            $dataAdr['zipcode'] = $this->input->post('CEP');
            $dataAdr['CREATED_BY'] = $user_name;
            $dataAdr['CREATED'] = $dataAtualizacao;


            $Row_adr = null;
            $Row_adr = $this->documentoModel->cadastrar_endereco($dataAdr);

            $AdrOBJ = $Row_adr[0]; //Objeto para recuperar o id do endereço...

           
            //var_dump($this->input->post('Row_id'));

             //die();

            if($Row_adr != null)
            {
                $param = $AdrOBJ->ID_addr; //Salvar o endereço na tabela main

                $Novo_main = null;

                $row_main['ROW_ID'] = $this->input->post('Row_id');
                $row_main['parent_TBL'] = 'tbl_doct';
                $row_main['parent_id'] = $this->input->post('Row_id');
                $row_main['CHILD_ID'] = $AdrOBJ->ID_addr;
                $row_main['CHILD_TBL'] = 'tbl_addr';
                $row_main['CREATED_BY'] = $user_name;
                $row_main['CREATED'] = $dataAtualizacao;

                $Novo_main = $this->documentoModel->cadastrar_main($row_main);

                redirect(base_url().'index.php/detalhes_documento/getTheRow/'.$this->input->post('Row_id').'');
            }

    }




     public function cadatrar_veiculo()
    {

        $user_name = $this->session->userdata('username');
        $dataAtualizacao = date('y-m-d H:i:s');

       //  $row->ROW_ID;
         $dataAuto['ID_vehicle'] = $this->input->post('id_auto');
         $dataAuto['ROW_ID'] = $this->input->post('row_id');  
         $dataAuto['category'] = $this->input->post('cat_veiculo');          
         $dataAuto['model'] = $this->input->post('mod_veiculo');
         $dataAuto['brand'] = $this->input->post('mark_veiculo');
         $dataAuto['chassi'] = strtoupper(strtr($this->input->post('chassi') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
         $dataAuto['renavan'] = strtoupper(strtr($this->input->post('renavan') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
         $dataAuto['placa'] = strtoupper(strtr($this->input->post('placa_n') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
         $dataAuto['city'] = $this->input->post('cidade_apr');
         $dataAuto['state'] = $this->input->post('estado_apr');
         $dataAuto['detalhes_veiculos'] = strtoupper(strtr($this->input->post('detalhes_veiculos') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));

        $Row_auto = null;
        if($this->input->post('id_auto') != null)
        {   
            $dataAuto['UPDATE_BY'] = $user_name;
            $dataAuto['LAST_UPDATE'] = $dataAtualizacao;

            $Row_auto = $this->atualizarDoct->atualiza_auto($dataAuto);
        } else
        {
            $dataAuto['CREATED_BY'] = $user_name;
            $dataAuto['CREATED'] = $dataAtualizacao;
            $Row_auto = $this->documentoModel->cadastrar_veiculo($dataAuto);

            $rowOBJ = $Row_auto[0];

            $param = $rowOBJ->ID_vehicle; //Salvar o endereço na tabela main

                            $Novo_main = null;

                            $row_main['ROW_ID'] = $this->input->post('row_id');
                            $row_main['parent_TBL'] = 'tbl_doct';
                            $row_main['parent_id'] = $this->input->post('row_id');
                            $row_main['CHILD_ID'] = $param;
                            $row_main['CHILD_TBL'] = 'tbl_vehicle';

                            $Novo_main = $this->documentoModel->cadastrar_main($row_main);
        }


        if($Row_auto != false)
        {
            redirect('/detalhes_documento/getTheRow/'.$this->input->post('row_id').'');
        }

    }

     public function cadastrar_mercadoria()
    {
        $user_name = $this->session->userdata('username');
        $dataAtualizacao = date('y-m-d H:i:s');

         
           //$row->ROW_ID;
             $dataMercadoria['ID_HAUL'] = $this->input->post('id_haul');
             $dataMercadoria['ROW_ID'] = $this->input->post('row_id');  
             $dataMercadoria['product'] = $this->input->post('listProdutos');          
             $dataMercadoria['unit'] = $this->input->post('medida');
             $dataMercadoria['qty'] = $this->input->post('quantidade');
             $dataMercadoria['brand'] = $this->input->post('marca');
             $dataMercadoria['tabacalera'] = $this->input->post('tabacalera');

             //if(($this->input->post('marca')) == -1 )
            // {
             //   $dataMercadoria['brand'] = "Nenhuma";
            // }else
            // {
             //    $dataMercadoria['brand'] = $this->input->post('marca');    
            // }

             //var_dump($dataMercadoria);
             //die;

            $Row_haul = 0;

            if($this->input->post('id_haul') != null)
            {   
                $dataMercadoria['UPDATED_BY'] = $user_name;
                $dataMercadoria['LAST_UPDATE'] = $dataAtualizacao;

                $Row_haul = $this->atualizarDoct->atualiza_merc($dataMercadoria);
            } 
                else
            {
                $dataMercadoria['CREATED_BY'] = $user_name;
                $dataMercadoria['CREATED'] = $dataAtualizacao;
                $dataMercadoria['UPDATED_BY'] = $user_name;
                $dataMercadoria['LAST_UPDATE'] = $dataAtualizacao;

                $Row_haul = $this->documentoModel->cadastrar_mercadoria($dataMercadoria);

                $rowOBJ = $Row_haul[0];

                $param = $rowOBJ->ID_HAUL; //Salvar o endereço na tabela main

                            $Novo_main = null;

                            $row_main['ROW_ID'] = $this->input->post('row_id');
                            $row_main['parent_TBL'] = 'tbl_doct';
                            $row_main['parent_id'] = $this->input->post('row_id');
                            $row_main['CHILD_ID'] = $param;
                            $row_main['CHILD_TBL'] = 'tbl_haul';

                            $Novo_main = $this->documentoModel->cadastrar_main($row_main);

            }
            if($Row_haul != 0)
                {
                    redirect('/detalhes_documento/getTheRow/'.$this->input->post('row_id').'');
                }

    }

     public function cadastrar_envolvido()
    {
        $user_name = $this->session->userdata('username');
        $dataAtualizacao = date('y-m-d H:i:s');

        
           //  $row->ROW_ID;
           // $dataEx = explode("/", $this->input->post('nascimento'));
           // $month = $dataEx[0];
           // $day = $dataEx[1];
           // $year = $dataEx[2];
           // $finalDate = $year."-".$month."-".$day;


            // var_dump($this->input->post('dataOps'));
           // die;

            $finalDate = "";
            

            if(($this->input->post('nascimento')) == "")
            {
                 $finalDate = "";
            }else
            if(strstr($this->input->post('nascimento'), '/', true)){
                //var_dump($this->input->post('nascimento'));
                //echo "/";
                //die;

                $dataEx = explode("/", $this->input->post('nascimento'));
                $month = $dataEx[1];
                $day = $dataEx[0];
                $year = $dataEx[2];
                $finalDate = $year."-".$month."-".$day;
            }else
            if(strstr($this->input->post('nascimento'), '-', true))
            {
                $finalDate = $this->input->post('nascimento');
            }

            //var_dump($finalDate);
            //die;

             $dataEnvolvido['ID_contact'] = $this->input->post('contact_id');
             $dataEnvolvido['ROW_ID'] = $this->input->post('row_id');  
             $dataEnvolvido['name'] = strtoupper(strtr($this->input->post('nomeD') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
             $dataEnvolvido['genre'] = $this->input->post('genero');          
             $dataEnvolvido['CPF'] = $this->input->post('CPF');
             $dataEnvolvido['rg'] = $this->input->post('rg');
             $dataEnvolvido['passport'] = $this->input->post('passaporte');
             $dataEnvolvido['profession'] = strtoupper(strtr($this->input->post('profissaoInst') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
             $dataEnvolvido['father'] = strtoupper(strtr($this->input->post('nome_pai') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
             $dataEnvolvido['mother'] = strtoupper(strtr($this->input->post('nome_mae') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
             $dataEnvolvido['birth_dt'] = $finalDate;
             //$dataEnvolvido['endereco_contato'] = $this->input->post('endereco_contato');
             $dataEnvolvido['birth_city'] = $this->input->post('cidade_nascimento');
             $dataEnvolvido['birth_state'] = $this->input->post('estado_nascimento');
             $dataEnvolvido['birth_country'] = $this->input->post('pais_nascimento');

             $dataEnvolvido['telefone'] = $this->input->post('telefone');
             $dataEnvolvido['marca_telefone'] = $this->input->post('marca_telefone');
             $dataEnvolvido['modelo_telefone'] = $this->input->post('modelo_telefone');
             $dataEnvolvido['IMEI'] = $this->input->post('IMEI');
             $dataEnvolvido['operadora'] = $this->input->post('operadora');
             $dataEnvolvido['comentarios_detidos'] = strtoupper(strtr($this->input->post('comentariosDet'),"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));

             //Dados para salvar os dados do endereço do envolvido...


             $dataAdr['ID_addr'] = null;
             if($this->input->post('row_id') != ""){
                $dataAdr['ID_addr'] = $this->input->post('Addr_id');
             }

             $dataAdr['ROW_ID'] = $this->input->post('row_id');
             $dataAdr['address'] = strtoupper(strtr($this->input->post('endereco_contato') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
             $dataAdr['nunber'] = strtoupper(strtr($this->input->post('numero_addr_contato') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
             $dataAdr['complement'] = strtoupper(strtr($this->input->post('complemento') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
             $dataAdr['district'] = strtoupper(strtr($this->input->post('bairro') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
             $dataAdr['country'] = $this->input->post('pais_detido');
             $dataAdr['city'] = $this->input->post('cidade_apr');
             $dataAdr['state'] = $this->input->post('estado_apr');
             $dataAdr['zipcode'] = $this->input->post('CEP');
             $dataAdr['CREATED_BY'] = $user_name;
             $dataAdr['CREATED'] = $dataAtualizacao;
             $dataAdr['UPDATE_BY'] = $user_name;
             $dataAdr['LAST_UPDATE'] = $dataAtualizacao;

             //var_dump($dataAdr);
             //die;


            $Row_Deti = 0;
             if($this->input->post('contact_id') != null)
            {   
                $dataEnvolvido['UPDATE_BY'] = $user_name;
                $dataEnvolvido['LAST_UPDATE'] = $dataAtualizacao;

                $Row_Deti = $this->atualizarDoct->atualiza_contact($dataEnvolvido);
            } 
                else
            {
                $dataEnvolvido['UPDATE_BY'] = $user_name;
                $dataEnvolvido['LAST_UPDATE'] = $dataAtualizacao;
                $dataEnvolvido['CREATED_BY'] = $user_name;
                $dataEnvolvido['CREATED'] = $dataAtualizacao;

                $Row_Deti = $this->documentoModel->cadastrar_envolvido($dataEnvolvido);

                $rowOBJ = $Row_Deti[0];

                $param = $rowOBJ->ID_contact; //Salvar o detido na tabela main

                            $Novo_main = null;

                            $row_main['ROW_ID'] = $this->input->post('row_id');
                            $row_main['parent_TBL'] = 'tbl_doct';
                            $row_main['parent_id'] = $this->input->post('row_id');
                            $row_main['CHILD_ID'] = $param;
                            $row_main['CHILD_TBL'] = 'tbl_contact';

                            $Novo_main = $this->documentoModel->cadastrar_main($row_main);

            }

            ///Inicio do cadastro do endereço do detido

            //Cadastrar o endereço do deposito...

            if($dataAdr['ID_addr'] != null)
            {
                $this->atualizarDoct->atualizar_endereco_wrs($dataAdr);

                $wrs_addr = $dataAdr['ID_addr'];
                $id_temp_addr = $wrs_addr;
            }else{
                $wrs_addr = $this->documentoModel->cadastrar_endereco_wrs($dataAdr);

                $rowOBJAddr = $wrs_addr[0];
                $id_temp_addr = $rowOBJAddr->ID_addr;
            }


            //Salvar relação na tabela tbl_wrs_addr...
            //$rowOBJ = $Row_Depo[0];
            $id_temp_wrs = $rowOBJ->ID_wrs;



            if(($param != 0) && ($id_temp_addr != 0))
            {
                $con_adrr['id_con'] = $param;
                $con_adrr['id_addr'] = $id_temp_addr;
                $con_adrr['CREATED_BY'] = $user_name;
                $con_adrr['CREATED'] = $dataAtualizacao;
                $con_adrr['UPDATED_BY'] =  $user_name;
                $con_adrr['LAST_UPDATE'] = $dataAtualizacao;

                $wrs_addr = $this->documentoModel->cadastra_con_addr($con_adrr);
            }

             ///fim do cadastro do endereço do detido


            if($Row_Deti != 0)
            {
                redirect('/detalhes_documento/getTheRow/'.$this->input->post('row_id').'');
            }

    }   //Fim da funcao


     public function cadastrar_deposito()
    {
        $user_name = $this->session->userdata('username');
        $dataAtualizacao = date('y-m-d H:i:s');
      
                $dataDeposito['ID_wrs'] = $this->input->post('id_local');
                $dataDeposito['ROW_ID'] = $this->input->post('row_id');  
               //$dataDeposito['endereco'] = $this->input->post('endereco');          
               //$dataDeposito['tipo_wrs'] = $this->input->post('tipo_wrs');

                $dataDeposito['produto_deposito'] = $this->input->post('produto_wrs'); 
                $dataDeposito['unidade_produto_deposito'] = $this->input->post('unidade_wrs');          
                $dataDeposito['marca_produto_deposito'] = $this->input->post('marca_wrs');
                $dataDeposito['quantidade_deposito'] = $this->input->post('quantidade_wrs');          
                $dataDeposito['tabacalera_produto_deposito'] = $this->input->post('tabacalera_wrs');



                $dataEnderecoWrs['ROW_ID'] = $this->input->post('row_id');
                $dataEnderecoWrs['address'] = strtoupper(strtr($this->input->post('endereco') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
                $dataEnderecoWrs['nunber'] = strtoupper(strtr($this->input->post('numero_wrs') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
                $dataEnderecoWrs['complement'] = strtoupper(strtr($this->input->post('complemento') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
                $dataEnderecoWrs['district'] = strtoupper(strtr($this->input->post('bairro') ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
                $dataEnderecoWrs['state'] = $this->input->post('estado_apr');
                $dataEnderecoWrs['city'] = $this->input->post('cidade_apr');
                $dataEnderecoWrs['zipcode'] = $this->input->post('CEP');
                $dataEnderecoWrs['ID_addr'] = $this->input->post('id_addr');
                $dataEnderecoWrs['CREATED_BY'] = $user_name;
                $dataEnderecoWrs['CREATED'] = $dataAtualizacao;
                $dataEnderecoWrs['UPDATE_BY'] = $user_name;
                $dataEnderecoWrs['LAST_UPDATE'] = $dataAtualizacao;
                //$Row_Depo = $this->documentoModel->cadastrar_depodito($dataDeposito);

                //var_dump($dataDeposito);
                //die;

            $Row_Depo = 0;
            $wrs_addr = 0;
            $rowOBJ = 0;
            $id_temp_addr = 0;

            //Cadastrar atualizar o que foi apreendido...

             if($this->input->post('id_local') != null)
            {   
                $dataDeposito['UPDATED_BY'] = $user_name;
                $dataDeposito['LAST_UPDATE'] = $dataAtualizacao;

                $this->atualizarDoct->atualiza_wrs($dataDeposito);
                $Row_Depo = $this->input->post('id_local');
            } 
                else
            {

                $dataDeposito['CREATED_BY'] = $user_name;
                $dataDeposito['CREATED'] = $dataAtualizacao;
                $dataDeposito['UPDATED_BY'] = $user_name;
                $dataDeposito['LAST_UPDATE'] = $dataAtualizacao;

                $Row_Depo = $this->documentoModel->cadastrar_depodito($dataDeposito);

                $rowOBJ = $Row_Depo[0];

                $param = $rowOBJ->ID_wrs; //Salvar o wrs na tabela main

                            $Novo_main = null;

                            $row_main['ROW_ID'] = $this->input->post('row_id');
                            $row_main['parent_TBL'] = 'tbl_doct';
                            $row_main['parent_id'] = $this->input->post('row_id');
                            $row_main['CHILD_ID'] = $param;
                            $row_main['CHILD_TBL'] = 'tbl_wrs';
                            $row_main['UPDATED_BY'] =  $user_name;
                            $row_main['LAST_UPDATE'] = $dataAtualizacao;

                            $Novo_main = $this->documentoModel->cadastrar_main($row_main);


            }

            //Cadastrar o endereço do deposito...

            if($dataEnderecoWrs['ID_addr'] != null)
            {
                $this->atualizarDoct->atualizar_endereco_wrs($dataEnderecoWrs);

                $wrs_addr = $dataEnderecoWrs['ID_addr'];
                $id_temp_addr = $wrs_addr;
            }else{
                $wrs_addr = $this->documentoModel->cadastrar_endereco_wrs($dataEnderecoWrs);

                $rowOBJAddr = $wrs_addr[0];
                $id_temp_addr = $rowOBJAddr->ID_addr;
            }


            //Salvar relação na tabela tbl_wrs_addr...
            $rowOBJ = $Row_Depo[0];
            $id_temp_wrs = $rowOBJ->ID_wrs;



            if(($id_temp_wrs != 0) && ($id_temp_addr != 0))
            {
                $wrs_adrr['id_wrs'] = $id_temp_wrs;
                $wrs_adrr['id_addr'] = $id_temp_addr;
                $wrs_adrr['CREATED_BY'] = $user_name;
                $wrs_adrr['CREATED'] = $dataAtualizacao;
                $wrs_adrr['UPDATED_BY'] =  $user_name;
                $wrs_adrr['LAST_UPDATE'] = $dataAtualizacao;

                $wrs_addr = $this->documentoModel->cadastra_wrs_addr($wrs_adrr);
            }






              if($Row_Depo != 0)
                {
                    redirect('/detalhes_documento/getTheRow/'.$this->input->post('row_id').'');
                }
    } //Fim da funcao

    public function cadastrar_anexo_arquivo()
    {
        $user_name = $this->session->userdata('username');
        $dataAtualizacao = date('y-m-d H:i:s');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        

        $row_id = $this->input->post('row_id');


                $file_to_upload = $this->input->post('file_send');

               // 'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/files/",
               //           'upload_url'      => base_url()."files/",

                $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads";
                $config['upload_url'] = base_url()."/uploads";
                $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|txt|zip|tar|';
                $config['max_size'] = '100000';
                $config['encrypt_name'] = true;

                $this->upload->initialize($config);

                $this->load->library('upload', $this->config);
                if($this->upload->do_upload('file_send'))
                {
                    echo "file upload success";

                    $data_upload = $this->upload->data();

                    $dataAnexo['ID_anexos'] = $this->input->post('ID_anexo');
                    $dataAnexo['id_row'] = $this->input->post('row_id');  
                    $dataAnexo['nome_arquivo'] = $this->input->post('file_name');          
                    $dataAnexo['location'] = $data_upload['file_name'];


                    $Row_File = 0;
                     if($this->input->post('ID_anexo') != null)
                    {   

                        $dataAnexo['UPDATE_BY'] = $user_name;
                        $dataAnexo['LAST_UPDATE'] = $dataAtualizacao;
                        $Row_File = $this->atualizarDoct->atualiza_anexo($dataAnexo);
                    } 
                    else
                    {

                        $dataAnexo['CREATED_BY'] = $user_name;
                        $dataAnexo['CREATED'] = $dataAtualizacao;
                        $Row_File = $this->documentoModel->cadastrar_anexos($dataAnexo);

                        $rowOBJ = $Row_File[0];

                        $param = $rowOBJ->ID_anexos; //Salvar o wrs na tabela main

                            $Novo_main = null;

                            $row_main['ROW_ID'] = $this->input->post('row_id');
                            $row_main['parent_TBL'] = 'tbl_doct';
                            $row_main['parent_id'] = $this->input->post('row_id');
                            $row_main['CHILD_ID'] = $param;
                            $row_main['CHILD_TBL'] = 'tbl_anexos';

                            $Novo_main = $this->documentoModel->cadastrar_main($row_main);

                        
                    }

                    if($Row_File != 0)
                    {
                        redirect('/detalhes_documento/getTheRow/'.$this->input->post('row_id').'');
                    }


                }
                else
                {
                    echo "file upload failed";

                    redirect( base_url("/index.php/continuar_documento/NotasAnexos/".$row_id.""));

                     echo display_errors();
                }


    }// Fim da funcão...

    public function chamaCidade($id)
    {

        $type = $this->input->post('type');

        $list_cidades = $this->documentoModel->load_cidades_ajx($id); 

        $dataCidades = array();


        foreach ($list_cidades as $cidades) {
            $dataCidades = $cidades;

            echo "<option value='".$cidades->id."'>".$cidades->nome."</option>";
        }
        
        return $dataCidades;       

    }

    public function chamaMarcas($id)
    {

        $type = $this->input->post('type');

        $list_marcas = $this->documentoModel->load_marcas_veiculo($id);

        $dataMarcas = array();


        foreach ($list_marcas as $marcas) {
            $dataMarcas = $marcas;

            //var_dump($marcas);

            echo "<option value='".$marcas->marc_cod."'>".$marcas->marc_nome."</option>";
        }
        
        return $dataMarcas;       

    }

    public function chamaModelos($id)
    {

        $type = $this->input->post('type');

        $list_modelos = $this->documentoModel->load_modelos_veiculo($id);

        $dataModelos = array();


        foreach ($list_modelos as $modelos) {
            $dataModelos = $modelos;

            //var_dump($marcas);

            echo "<option value='".$modelos->mode_cod."'>".$modelos->mode_nome."</option>";
        }
        
        return $dataModelos;       

    }


    public function cadastrar_image_doct()
    {
        $user_name = $this->session->userdata('username');
        $dataAtualizacao = date('y-m-d h:i:s');
        

        $row_id = $this->input->post('row_id');

            $file_to_upload = $this->input->post('file_send');

               // 'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/files/",
               //           'upload_url'      => base_url()."files/",
            

                $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/imagens_doct";
                $config['upload_url'] = base_url()."/imagens_doct";
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '100000';
                $config['encrypt_name'] = true;

                $this->upload->initialize($config);

                $this->load->library('upload', $this->config);
                if($this->upload->do_upload('file_send'))
                {
                    echo "file upload success";

                    $data_upload = $this->upload->data();

                    $dataImage['ID_image'] = $this->input->post('ID_image');
                    $dataImage['id_row'] = $this->input->post('row_id');  
                    $dataImage['title_image'] = $this->input->post('file_name');          
                    $dataImage['nome_image_doct'] = $data_upload['file_name'];

                    //var_dump($dataAnexo);
                   // die;

                    $Row_File = 0;
                     if($this->input->post('ID_image') != null)
                    {   

                        $dataImage['UPDATE_BY'] = $user_name;
                        $dataImage['LAST_UPDATE'] = $dataAtualizacao;
                        $Row_File = $this->atualizarDoct->atualiza_image($dataImage);
                    } 
                    else
                    {
                        $dataImage['CREATED_BY'] = $user_name;
                        $dataImage['CREATED'] = $dataAtualizacao;
                        $Row_File = $this->documentoModel->cadastrar_imagem($dataImage);

                        $rowOBJ = $Row_File[0];

                        $param = $rowOBJ->id_image; //Salvar o wrs na tabela main

                            $Novo_main = null;

                            $row_main['ROW_ID'] = $this->input->post('row_id');
                            $row_main['parent_TBL'] = 'tbl_doct';
                            $row_main['parent_id'] = $this->input->post('row_id');
                            $row_main['CHILD_ID'] = $param;
                            $row_main['CHILD_TBL'] = 'tbl_image_doct';

                            $Novo_main = $this->documentoModel->cadastrar_main($row_main);

                        
                    }

                    if($Row_File != 0)
                    {

                        redirect('/detalhes_documento/getTheRow/'.$this->input->post('row_id').'');
                    }


                }
                else
                {
                    echo "file upload failed";

                    redirect( base_url("/index.php/continuar_documento/Imagens_doct/".$row_id.""));

                     echo display_errors();
                }

    }// Fim da funcão...

}