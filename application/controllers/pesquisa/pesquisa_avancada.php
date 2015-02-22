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
        $this->load->model('Detalhes_documento_model','DetalhesModel');
        $this->load->model('Relatorios_model','relatorio');
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

    public function chamaDoctData($value)
    {
        $type = $this->input->post('type');

        $list_documentos = $this->pesquisaAVD->load_docs_date_ajx($value);

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
    }

    public function chamaPessoas($value)
    {
        $type = $this->input->post('type');

        $list_pessoas = $this->pesquisaAVD->load_pessoas_ajx($value); 

        $dataCidades = array();

        echo "<tr> <th> Nome do detido </th><th>RG</th><th>CPF</th> <th>Documentos</th> <th>Data Doc.</th> </tr>  <tbody id='listResultadosRow'>";

        foreach ($list_pessoas as $documentos) {
            //$dataCidades = $cidades;

            $dataEx = explode("-", $documentos->arrest_date);
            $month = $dataEx[1];
            $day = $dataEx[2];
            $year = $dataEx[0];

            $dataF = $day."/".$month."/".$year;


            echo "<tr> <td>  ".$documentos->name." </td><td>  ".$documentos->rg." </td><td> ".$documentos->CPF."  </td> <td><a href='".base_url()."index.php/pesquisa/pesquisa_avancada/envolvimentoPessoas/".$documentos->ID_contact."'>listar documentos</a> </td> <td> ".$dataF."  </td> </tr>";
        }

        echo "</tbody>";
        
       // return $dataCidades;       
    }

    public function chamaVeiculo($value)
    {
        $type = $this->input->post('type');

        $list_veiculos = $this->pesquisaAVD->load_veiculos_ajx($value); 

        $dataCidades = array();

        echo "<tr> <th>Marca </th><th>modelo</th><th>placa</th> <th> Ação </th><th> Data Doc. </th> </tr>  <tbody id='listResultadosRow'>";

        foreach ($list_veiculos as $veiculos) {

            //Data final...
            $dataTemp2 = explode("-", $veiculos->arrest_date);
            $dia2 = $dataTemp2[0];
            $mes2 = $dataTemp2[1];
            $ano2 = $dataTemp2[2];
            $dataFinal3 = $ano2."/".$mes2."/".$dia2;

            //$dataCidades = $cidades;
            if(!is_numeric($veiculos->model))
            {$model = $veiculos->model;}
            else{$model = $veiculos->mode_nome;}

            echo "<tr> <td> ".$veiculos->marc_nome."</td><td> ".$model."</td><td> ".$veiculos->placa."</td><td> <a href='".base_url()."index.php/pesquisa/pesquisa_avancada/envolvimentoVeiculo/".$veiculos->ID_vehicle."'>listar documentos</a> </td><td> ".$dataFinal3."</td> </tr>";
        }

        echo "</tbody>";
        
       // return $dataCidades;       
    }

    public function chamaVeiculoTipo($tipoVeiculo)
    {
        $list_veiculos = $this->pesquisaAVD->load_tipo_veiculos_ajx($tipoVeiculo);

        $dataCidades = array();

        echo "<tr><th>Tipo </th><th>modelo</th><th>placa</th> <th> Ação </th><th> Data doc. </th> </tr>  <tbody id='listResultadosRow'>";

        foreach ($list_veiculos as $veiculos) {

            //Data final...
            $dataTemp2 = explode("-", $veiculos->arrest_date);
            $dia2 = $dataTemp2[0];
            $mes2 = $dataTemp2[1];
            $ano2 = $dataTemp2[2];
            $dataFinal2 = $ano2."/".$mes2."/".$dia2;

            //$dataCidades = $cidades;
            if(!is_numeric($veiculos->model))
            {$model = $veiculos->model;}
            else{$model = $veiculos->mode_nome;}

            echo "<tr><td> ".$veiculos->tpve_nome."</td><td> ".$model."</td><td> ".$veiculos->placa."</td><td> <a href='".base_url()."index.php/pesquisa/pesquisa_avancada/envolvimentoVeiculo/".$veiculos->ID_vehicle."'>listar documentos</a> </td><td> ". $dataFinal2."</td> </tr>";
        }

        echo "</tbody>";
        
       // return $dataCidades;   
    }

    public function chamaEnd($value)
    {
        $type = $this->input->post('type');

        $list_enderecos = $this->pesquisaAVD->load_enderecos_ajx($value); 

        $dataCidades = array();

        echo "<tr> <th>Logradouro </th><th>Cidade</th><th> CEP </th> <th> Ação </th>  <th> Data Doc. </th></tr>  <tbody id='listResultadosRow'>";

        foreach ($list_enderecos as $enderecos) {
            //$dataCidades = $cidades;

            $dataEx = explode("-", $enderecos->arrest_date);
            $month = $dataEx[1];
            $day = $dataEx[2];
            $year = $dataEx[0];

            $dataF = $day."/".$month."/".$year;


            echo "<tr> <td>".$enderecos->address."</td><td>".$enderecos->nome."</td><td>".$enderecos->zipcode."</td> <td><a href='".base_url()."index.php/pesquisa/pesquisa_avancada/envolvimentoEndereco/".$enderecos->ID_addr."'>listar documentos</a> </td><td>".$dataF."</td>   </tr>";
        }

        echo "</tbody>";
        
       // return $dataCidades;       
        
    }

    public function chamaEndCidades($value)
    {
        $list_enderecos = $this->pesquisaAVD->load_enderecos_cidades_ajx($value); 

        $dataCidades = array();

        echo "<tr> <th>Cidade</th><th>Logradouro</th><th> CEP </th> <th> Ação </th> <th> Data Doc. </th> </tr>  <tbody id='listResultadosRow'>";

        foreach ($list_enderecos as $enderecos) {
            //$dataCidades = $cidades;

            $dataEx = explode("-", $enderecos->arrest_date);
            $month = $dataEx[1];
            $day = $dataEx[2];
            $year = $dataEx[0];

            $dataT = $day."/".$month."/".$year;


            echo "<tr> <td>".$enderecos->nome."</td><td>".$enderecos->address."</td><td>".$enderecos->zipcode."</td> <td><a href='".base_url()."index.php/pesquisa/pesquisa_avancada/envolvimentoEndereco/".$enderecos->ID_addr."'>listar documentos</a> </td> <td>".$dataT."</td>  </tr>";
        }

        echo "</tbody>";
        
       // return $dataCidades;       
        
    }

    public function envolvimentoPessoas($id_pessoa) 
    {

        $data[0] =  $this->DetalhesModel->load_single_contato($id_pessoa);
        $data['registros'] = $this->pesquisaAVD->envolvidoPessoas($id_pessoa);

        $this->imprimirRelatorioIndividual($data);

    }

    public function envolvimentoVeiculo($id_veiculo)
    {
        $data[0] =  $this->DetalhesModel->load_single_auto($id_veiculo);
        $data['registros'] = $this->pesquisaAVD->envolvidoVeiculo($id_veiculo);

        $this->imprimirRelatorioIndividual($data);

    }

    public function envolvimentoEndereco($id_endereco)
    {
        $data[0] = $this->DetalhesModel->load_single_addr($id_endereco);
        $data['registros'] = $this->pesquisaAVD->envolvidoEndereco($id_endereco);

        $this->imprimirRelatorioIndividual($data);
    }


    /// Gera a tela de exibição do relatorio 

    public function imprimirRelatorioIndividual($dadosRelatorio)
    {
      

        //var_dump($dadosRelatorio);

        $dados['extra'] = $dadosRelatorio[0];

        $dadosArray = array( );

        foreach ($dadosRelatorio['registros'] as $data) 
        {
           //echo $data->ROW_ID;
           //die;
           //echo "<br>";

           //$dataDocumento['data'] = $data;

            $documento = $this->relatorio->load_documento_completo($data->ROW_ID);

            //var_dump($documento);

           $dataDocumento['documento'] = $documento;

           //Endereços....
           $endereço = $this->relatorio->load_documento_endereco($data->ROW_ID);
            //var_dump($endereço);
           if($endereço != null) {
                $dataDocumento['endereco'] = $endereço;   
            }else
            {
                $dataDocumento['endereco'][0] = "";
            }


            //Endereços deposito....
           $endereçoDeposito = $this->relatorio->load_endereco_wrs_relatorio($data->ROW_ID);
            //var_dump($endereçoDeposito);
           if($endereçoDeposito != null) {
                $dataDocumento['endereco_deposito'] = $endereçoDeposito;   
            }else
            {
                $dataDocumento['endereco_deposito'][0] = "";
            }
            //var_dump($dataDocumento['endereco_deposito']);


            //Mercadorias....
            $mercadorias = $this->relatorio->load_mercadoria_relatorio($data->ROW_ID);
             if($mercadorias != null) {
                $dataDocumento['mercadorias'] = $mercadorias;   
            }else
            {
                $dataDocumento['mercadorias'][0] = "";
            }

            //var_dump($mercadorias);

            //Pessoas envolvidas...
            //$envolvidos = $this->relatorio->load_documento_envolvidos($data->ROW_ID);
            $envolvidos = $this->relatorio->load_documento_envolvidos($data->ROW_ID);
             if($envolvidos != null) {

                //var_dump($envolvidos);

                $dataDocumento['envolvidos'] = $envolvidos;     
            }else
            {
                $dataDocumento['envolvidos'][0] = "";
            }

            //var_dump($dataDocumento['envolvidos']);

            //Veiculos....
            $veiculos = $this->relatorio->load_documento_auto($data->ROW_ID);
            //var_dump($veiculos);

            $dataDocumento['veiculos'] = $veiculos;


            //Produtos aprendidos por depositos....

            $produtos_armazens = $this->relatorio->load_armazem_relatorio($data->ROW_ID);
             if($produtos_armazens != null) {

                //var_dump($produtos_armazens);

                $dataDocumento['produto_armazens'] = $produtos_armazens;   
            }else
            {
                $dataDocumento['produto_armazens'][0] = "";
            }



            //Imagens da operação...

            $imagens = $this->relatorio->load_documento_imagens($data->ROW_ID);
             if($imagens != null) {
                $dataDocumento['imagens'] = $imagens;   
            }else
            {
                $dataDocumento['imagens'][0] = "";
            }

        

            array_push($dadosArray , $dataDocumento);
        }



        $dados['conteudo'] = $dadosArray;


        $this->load->view('templates/header');
        $this->load->view('pesquisa/documentos_pesquisa_view', $dados);
        $this->load->view('templates/footer');
    }


    ////gera o ralatorio e .Doc do relatorio individual 

    public function gera_relatorio_individual()
    {
        $this->load->library('word');

        $idObj = $this->input->post('idObjeto');
        $typeData = $this->input->post('tipoDado');

        if($typeData == 'auto')
        {
            $dataf[0] =  $this->DetalhesModel->load_single_auto($idObj);
            $dataF['registros'] = $this->pesquisaAVD->envolvidoVeiculo($idObj);
        }else
        if($typeData == 'Pessoa'){
            $dataF[0] =  $this->DetalhesModel->load_single_contato($idObj);
            $dataF['registros'] = $this->pesquisaAVD->envolvidoPessoas($idObj);
        }else
        if($typeData == 'addr'){
            $dataF[0] =  $this->DetalhesModel->load_single_addr($idObj);
            $dataF['registros'] = $this->pesquisaAVD->envolvidoEndereco($idObj);
        }

         //var_dump($dataF[0]);


        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );

        date_default_timezone_set( 'America/Sao_Paulo' );  



        $dataGeracao = date("d/m/Y H:i:s ");

        $dataDateI = $this->input->post('dataI'); 
        $dataDateF =  $this->input->post('dataF'); 
        $estadoDest = $this->input->post('estadoDestino');
        $id_estado_dest = $this->input->post('idEstadoDestino');


        ////Codigo contendo os dados a serem impressos no documento word...


        $dataRelatorio = $dataF['registros'];

        $dadosArray = array( );

        foreach ($dataRelatorio as $data) 
        {

           $dataDocumento['data'] = $data;

            $documento = $this->relatorio->load_documento_completo($data->ROW_ID);

           $dataDocumento['documento'] = $documento;
           $endereço = $this->relatorio->load_documento_endereco($data->ROW_ID);
            //var_dump($endereço);
           if($endereço != null) {
                $dataDocumento['endereco'] = $endereço;   
            }else
            {
                $dataDocumento['endereco'][0] = "";
            }
           $endereçoDeposito = $this->relatorio->load_endereco_wrs_relatorio($data->ROW_ID);
            //var_dump($endereçoDeposito);
           if($endereçoDeposito != null) {
                $dataDocumento['endereco_deposito'] = $endereçoDeposito;   
            }else
            {
                $dataDocumento['endereco_deposito'][0] = "";
            }
            $mercadorias = $this->relatorio->load_mercadoria_relatorio($data->ROW_ID);
             if($mercadorias != null) {
                $dataDocumento['mercadorias'] = $mercadorias;   
            }else
            {
                $dataDocumento['mercadorias'][0] = "";
            }

            $envolvidos = $this->relatorio->load_documento_envolvidos($data->ROW_ID);
             if($envolvidos != null) {
                $dataDocumento['envolvidos'] = $envolvidos;     
            }else
            {
                $dataDocumento['envolvidos'][0] = "";
            }

            //Veiculos....
            $veiculos = $this->relatorio->load_documento_auto($data->ROW_ID);
            //var_dump($veiculos);

            $dataDocumento['veiculos'] = $veiculos;

            $produtos_armazens = $this->relatorio->load_armazem_relatorio($data->ROW_ID);
             if($produtos_armazens != null) {

                $dataDocumento['produto_armazens'] = $produtos_armazens;   
            }else
            {
                $dataDocumento['produto_armazens'][0] = "";
            }

            $imagens = $this->relatorio->load_documento_imagens($data->ROW_ID);
             if($imagens != null) {
                $dataDocumento['imagens'] = $imagens;   
            }else
            {
                $dataDocumento['imagens'][0] = "";
            }

            array_push($dadosArray , $dataDocumento);
        }

        $dados['estados'] = $this->documentoModel->load_estados();

        $dados['cidades'] = $this->documentoModel->load_cidades();

        $dados['tipoObj'] = $typeData;
        $dados['extra'] = $dataF[0];
        $dados['conteudo'] = $dadosArray;

       // var_dump($dados['extra']);

       // $this->load->view('pesquisa/gera_relatorio_final_view', $dadosArray);

        ////////////////// Manda os dados gerados para serem tranformardos em .doc ///////////////////////

       $htmlRelatorio =  $this->load->view('pesquisa/gera_relatorio_individual_view', $dados);
      

      new Word($htmlRelatorio);
    }


} //Fim do controller