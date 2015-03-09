<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Relatorios_gen extends CI_Controller {
    
    function __construct() {
        parent::__construct();

        $this->load->model('Relatorios_model','relatorio');
        $this->load->model('Novo_documento_model', 'documentoModel');
        $this->load->model('User_model', 'user');
        $this->user->logged();

       // $this->load->library('PHPJasperXML/class/PHPJasperXML');
       // $this->PHPJasperXML->xml_dismantle($xml);
       // $this->PHPJasperXML->outpage("I");  
    }
    
    public function index() {

        $data['estados'] = $this->documentoModel->load_estados(); 

        $this->load->view('templates/header');
        $this->load->view('pesquisa/gera_relatorio_view', $data);
        $this->load->view('templates/footer');
        
    }

    public function gera_relatorio()
    {

        echo "index carregada";

       

        $this->load->helper('mpdf');
 
        $html = "<html>";
        $html .= "<head></head>";
        $html .= "<body>Meu arquivo de teste</body>";
        $html .= "</html>";
 
        // Opcional: Também é possivel carregar uma view inteira...
        //$html = $this->load->view('uma_view_qualquer', null, true);
 
        pdf($html);

    }

       public function gera_word2()
    {

      $this->load->library('word');

       setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );

        date_default_timezone_set( 'America/Sao_Paulo' );  


        $dataGeracao = date("d/m/Y H:i:s ");

        $dataDateI = $this->input->post('dataI'); 
        $dataDateF =  $this->input->post('dataF'); 
        $estadoDest = $this->input->post('estadoDestino');
        $id_estado_dest = $this->input->post('idEstadoDestino');


        ////Codigo contendo os dados a serem impressos no documento word...

        //Data inicial...
        $dataTemp1 = explode("/", $dataDateI);
        $dia1 = $dataTemp1[0];
        $mes1 = $dataTemp1[1];
        $ano1 = $dataTemp1[2];
        $dataFinal1 = $ano1."/".$mes1."/".$dia1;

        //Data final...
        $dataTemp2 = explode("/", $dataDateF);
        $dia2 = $dataTemp2[0];
        $mes2 = $dataTemp2[1];
        $ano2 = $dataTemp2[2];
        $dataFinal2 = $ano2."/".$mes2."/".$dia2;

        $dataIni = $dataFinal1;
        $dataFim = $dataFinal2; 

        $dataRelatorio = $this->relatorio->load_documentos($dataDateI ,$dataDateF, $id_estado_dest);

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
                $dataDocumento['endereco'] = "";
            }
           $endereçoDeposito = $this->relatorio->load_endereco_wrs_relatorio($data->ROW_ID);

            //var_dump($endereçoDeposito);

           if($endereçoDeposito != null) {
                $dataDocumento['endereco_deposito'] = $endereçoDeposito;   
            }else
            {
                $dataDocumento['endereco_deposito'] = '';
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

            //var_dump($imagens);

             if($imagens != null) {
                $dataDocumento['imagens'] = $imagens;   
            }else
            {
                $dataDocumento['imagens'][0] = ' ';
            }

            array_push($dadosArray , $dataDocumento);
        }

        //Implementar função para exibir o total de todos os tipos de veiculos do relatório

        $tipoVeiculos = $this->documentoModel->load_type_veiculo(); //Implementar...

        //var_dump($tipoVeiculos);
        $totalTempArray= array();
        $totaisArray = array( );

        $totaisPresosArray = array();
        $totaisVeiculosArray = array();
        $totaisCaixasArray = array();
        $totaisDepositosArray = array();
        
        //for para retornar o total de cada tipo de veiculo...
        foreach ($tipoVeiculos as $veiculos) {
           $totalTemp[0] = $this->relatorio->load_total_categoria_veiculos($veiculos->tpve_cod,$dataDateI ,$dataDateF, $id_estado_dest);
           $totalTemp[1] = $veiculos->tpve_nome;
           array_push($totaisArray , $totalTemp);
        }
        //var_dump($totaisArray);
        //die();


         //Caulcular os acumulados do ano...

        for($i = 1; $i <=12; $i++){
            $indice = $i;

            $presosComNome = $this->relatorio->load_presos_normais_mes($indice, $id_estado_dest);
            $presosDeclarados = $this->relatorio->load_presos_mes($indice, $id_estado_dest);
            $presosRedundantes = $this->relatorio->load_presos_redundantes_mes($indice, $id_estado_dest);

            $totaisPresosArray[$indice] = $presosComNome + ($presosDeclarados[0]->totalPreso - $presosRedundantes[0]->totalPresoRedundate);
            $totaisVeiculosArray[$indice] = $this->relatorio->load_veiculos_mes($indice, $id_estado_dest);
            $totaisDepositosArray[$indice] = $this->relatorio->load_depositos_mes($indice, $id_estado_dest);

            $caixasNormais = $this->relatorio->load_caixas_mes($indice, $id_estado_dest);
            $caixasDeposito = $this->relatorio->load_caixas_wrs_mes($indice, $id_estado_dest);

            //var_dump($caixasNormais);
            //var_dump($caixasDeposito);

            $totaisCaixasArray[$indice] = $caixasNormais[0]->qty + $caixasDeposito[0]->quantidade_deposito;
        }

        $dados['acumuladosPresos'] = $totaisPresosArray;

        $dados['acumuladosVeiculos'] = $totaisVeiculosArray;

        $dados['acumuladosCaixas'] = $totaisCaixasArray;

        $dados['acumuladosDepositos'] = $totaisDepositosArray;

        //Trás todos os presos normalmente
        $dados['totalDetidos'] = $this->relatorio->total_detidos($dataDateI ,$dataDateF, $id_estado_dest);
        //Trás todos os presos declarados no campo no documento...
        $dados['totalDetidosDocumento'] = $this->relatorio->total_detidos_documento($dataDateI ,$dataDateF, $id_estado_dest);
        //Trás todos os presos reduntdantes...
        $dados['totalDetidosRedundantes'] = $this->relatorio->total_detidos_redundante($dataDateI ,$dataDateF, $id_estado_dest);


        $dados['totaisCategorias'] = $totaisArray;

        $dados['estados'] = $this->documentoModel->load_estados();

        $dados['cidades'] = $this->documentoModel->load_cidades();

        $dados['totalOcorrencias'] = $this->relatorio->total_ocorrencias($dataDateI ,$dataDateF, $id_estado_dest);

        $dados['totalVeiculos'] = $this->relatorio->total_veiculos_relatorio($dataDateI ,$dataDateF, $id_estado_dest);
        
        $dados['totalDepositos'] = $this->relatorio->total_depositos($dataDateI ,$dataDateF ,$id_estado_dest);
        
        $dados['totalCaminhao'] = $this->relatorio->total_veiculos_caminhao_relatorio($dataDateI ,$dataDateF, $id_estado_dest);
        
        $dados['totalOnibus'] = $this->relatorio->total_veiculos_onibus_relatorio($dataDateI ,$dataDateF ,$id_estado_dest);

        $caixasCigarros = $this->relatorio->total_caixa_cigarros($dataDateI ,$dataDateF ,$id_estado_dest);
        $cigarrosWsr = $this->relatorio->total_caixa_cigarros_wrs($dataDateI ,$dataDateF ,$id_estado_dest);

        $dados['caixasCigarros'] = $caixasCigarros;
        $dados['caixasCigarrosWrs'] = $cigarrosWsr;
 
        $dados['totalCxCigarros'] = $caixasCigarros[0]->qty + $cigarrosWsr[0]->quantidade_deposito;

        $dados['pacotesCigarros'] = $caixasCigarros[0]->qty;
        $dados['pacotesCigarrosWrs'] = $cigarrosWsr[0]->quantidade_deposito;

        $dados['totalPacotes'] = $caixasCigarros[0]->qty + $cigarrosWsr[0]->quantidade_deposito;

        $dados['estadoDestino'] = $estadoDest;
        $dados['relatorioIni'] = $dataDateI; 
        $dados['relatorioFim'] = $dataDateF;
        $dados['conteudo'] = $dadosArray;
       // $this->load->view('pesquisa/gera_relatorio_final_view', $dadosArray);

        ////////////////// Manda os dados gerados para serem tranformardos em .doc ///////////////////////

       //$htmlRelatorio =  $this->load->view('pesquisa/gera_relatorio_final_view', $dados);

       $htmlRelatorio =  $this->load->view('pesquisa/gera_relatorio_final_alterado_view', $dados);
      

      new Word($htmlRelatorio);
    }

    public function visualizarRel()
    {
        $dataIni = $this->input->post('dataInicial');
        $dataFim = $this->input->post('dataFinal');

        $estadoDestino = $this->input->post('destinoCarga');

        //Data inicial...
        $dataTemp1 = explode("/", $dataIni);
        $dia1 = $dataTemp1[0];
        $mes1 = $dataTemp1[1];
        $ano1 = $dataTemp1[2];
        $dataFinal1 = $ano1."/".$mes1."/".$dia1;

        //Data final...
        $dataTemp2 = explode("/", $dataFim);
        $dia2 = $dataTemp2[0];
        $mes2 = $dataTemp2[1];
        $ano2 = $dataTemp2[2];
        $dataFinal2 = $ano2."/".$mes2."/".$dia2;

        //var_dump($dataFinal1);
        //var_dump($dataFinal2);
        //die;

        $dataIni = $dataFinal1;
        $dataFim = $dataFinal2; 

       
        $dataRelatorio = $this->relatorio->load_documentos($dataIni ,$dataFim, $estadoDestino);

         //$caixasCigarros = $this->relatorio->total_veiculos_relatorio($dataIni ,$dataFim);

          //var_dump($caixasCigarros);

        $dadosArray = array( );

        foreach ($dataRelatorio as $data) 
        {
           //echo $data->ROW_ID;
           //echo "<br>";

           $dataDocumento['data'] = $data;

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


            //Anexos do documento...

            $lista_anexos = $this->relatorio->load_anexos_relatorio($data->ROW_ID);

            //var_dump($lista_anexos);

            if($lista_anexos != null){
                $dataDocumento['anexos'] = $lista_anexos;
            }else{
                $dataDocumento['anexos'][0] = "";
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

        $destino = "";

        if($estadoDestino != "")
        {
          $destino = $this->relatorio->load_nome_estado_destino($estadoDestino);
        }
        else
        {
          $destino = "Todos os estados";
        }



        //Implementar função para exibir o total de todos os tipos de veiculos do relatório

        $tipoVeiculos = $this->documentoModel->load_type_veiculo(); //Implementar...

        //var_dump($tipoVeiculos);
        $totalTempArray= array();
        $totaisArray = array( );
        $totaisPresosArray = array();
        $totaisVeiculosArray = array();
        $totaisCaixasArray = array();
        $totaisDepositosArray = array();
        
        //for para retornar o total de cada tipo de veiculo...
        foreach ($tipoVeiculos as $veiculos) {
           $totalTemp[0] = $this->relatorio->load_total_categoria_veiculos($veiculos->tpve_cod,$dataIni ,$dataFim, $estadoDestino);
           $totalTemp[1] = $veiculos->tpve_nome;
           array_push($totaisArray , $totalTemp);
        }
        //var_dump($totaisArray);
        //die();

        //Caulcular os acumulados do ano...

        for($i = 1; $i <=12; $i++){
            $indice = $i;

            $presosComNome = $this->relatorio->load_presos_normais_mes($indice, $estadoDestino);
            $presosDeclarados = $this->relatorio->load_presos_mes($indice, $estadoDestino);
            $presosRedundantes = $this->relatorio->load_presos_redundantes_mes($indice, $estadoDestino);

            $totaisPresosArray[$indice] = $presosComNome + ($presosDeclarados[0]->totalPreso - $presosRedundantes[0]->totalPresoRedundate);
            //$totaisPresosArray[$indice] = $this->relatorio->load_presos_mes($indice, $estadoDestino);
            $totaisVeiculosArray[$indice] = $this->relatorio->load_veiculos_mes($indice, $estadoDestino);
            $totaisDepositosArray[$indice] = $this->relatorio->load_depositos_mes($indice, $estadoDestino);

            $caixasNormais = $this->relatorio->load_caixas_mes($indice, $estadoDestino);
            $caixasDeposito = $this->relatorio->load_caixas_wrs_mes($indice, $estadoDestino);

            //var_dump($caixasNormais);
            //var_dump($caixasDeposito);

            $totaisCaixasArray[$indice] = $caixasNormais[0]->qty + $caixasDeposito[0]->quantidade_deposito;
        }

        //Trás todos os presos normalmente
        $dados['totalDetidos'] = $this->relatorio->total_detidos($dataIni ,$dataFim, $estadoDestino);
        //Trás todos os presos declarados no campo no documento...
        $dados['totalDetidosDocumento'] = $this->relatorio->total_detidos_documento($dataIni ,$dataFim, $estadoDestino);
        //Trás todos os presos reduntdantes...
        $dados['totalDetidosRedundantes'] = $this->relatorio->total_detidos_redundante($dataIni ,$dataFim, $estadoDestino);

        $dados['acumuladosPresos'] = $totaisPresosArray;

        $dados['acumuladosVeiculos'] = $totaisVeiculosArray;

        $dados['acumuladosCaixas'] = $totaisCaixasArray;

        $dados['acumuladosDepositos'] = $totaisDepositosArray;

        $dados['totaisCategorias'] = $totaisArray;
        
        $dados['totalVeiculos'] = $this->relatorio->total_veiculos_relatorio($dataIni ,$dataFim, $estadoDestino);

        $dados['estados'] = $this->documentoModel->load_estados();
         
        $dados['cidades'] = $this->documentoModel->load_cidades();

        //Totais deste relatório
        $dados['totalOcorrencias'] = $this->relatorio->total_ocorrencias($dataIni ,$dataFim, $estadoDestino);
        
        $dados['totalDepositos'] = $this->relatorio->total_depositos($dataIni ,$dataFim, $estadoDestino);
        
        $dados['totalCaminhao'] = $this->relatorio->total_veiculos_caminhao_relatorio($dataIni ,$dataFim, $estadoDestino);
        
        $dados['totalOnibus'] = $this->relatorio->total_veiculos_onibus_relatorio($dataIni ,$dataFim, $estadoDestino); 

        $caixasCigarros = $this->relatorio->total_caixa_cigarros($dataIni ,$dataFim, $estadoDestino);
        $cigarrosWsr = $this->relatorio->total_caixa_cigarros_wrs($dataIni ,$dataFim, $estadoDestino);

        $dados['caixasCigarros'] = $caixasCigarros;
        $dados['caixasCigarrosWrs'] = $cigarrosWsr;
 
        $dados['totalCxCigarros'] = $caixasCigarros[0]->qty + $cigarrosWsr[0]->quantidade_deposito;

        $dados['pacotesCigarros'] = $caixasCigarros[0]->qty;
        $dados['pacotesCigarrosWrs'] = $cigarrosWsr[0]->quantidade_deposito;

        $dados['totalPacotes'] = $caixasCigarros[0]->qty + $cigarrosWsr[0]->quantidade_deposito;
        //Fim dos Totais...


        $dados['estadoDestino'] = $destino;
        $dados['dataRI'] = $dataIni;
        $dados['dataRF'] = $dataFim; 

        $dados['conteudo'] = $dadosArray;

        //var_dump($dados['dataF']);
        //var_dump($dados['dataI']);
        //die;

        $this->load->view('templates/header');
        $this->load->view('pesquisa/visualizar_relatorio_view', $dados);
        $this->load->view('templates/footer');
    }

    public function relatorio_mes()
    {


        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );

        date_default_timezone_set( 'America/Sao_Paulo' );  


        $dataGeracao = date("d/m/Y H:i:s ");

        $dataDateI = $this->input->post('dataI');
        $dataDateF =  $this->input->post('dataF');




        $dataEx = explode("/",  $this->input->post('dataI'));
        $month = $dataEx[1];
        $day = $dataEx[2];
        $year = $dataEx[0];

        $dataI = $day."/".$month."/".$year;

        $dataEx2 = explode("/", $this->input->post('dataF'));
        $month2 = $dataEx2[1];
        $day2 = $dataEx2[2];
        $year2 = $dataEx2[0];

        $dataF = $day2."/".$month2."/".$year2;

        echo $dataGeracao;

        //die;

        $this->load->library('word');
        //our docx will have 'lanscape' paper orientation
        $section = $this->word->createSection(array('orientation'=>'vertical'));

        //sessão para os estilos de texto....
        $this->word->addFontStyle('TStyle', array('bold'=>true, 'calibri'=>true, 'size'=>20));
        $this->word->addParagraphStyle('pTStyle', array('spaceAfter'=>100));

        $this->word->addFontStyle('SimpleStyle', array('bold'=>false, 'calibri'=>true, 'size'=>18));
        $this->word->addFontStyle('SimStyle', array('bold'=>false, 'arial'=>true, 'size'=>12));


        // Add text elements
        $section->addText('Data do relatorio gerado : '.$dataGeracao);
        $section->addTextBreak(15);


        $this->word->addFontStyle('TStyle', array('bold'=>true, 'calibri'=>true, 'size'=>28));
        $this->word->addParagraphStyle('pTStyle', array('align'=>'center', 'spaceAfter'=>100));
        $section->addText('Relatorio de apreensao do periodo de :', 'TStyle', 'pTStyle');
        $section->addText($dataI.' a '.$dataF,  'TStyle', 'pTStyle');
        $section->addTextBreak(15);


        ////Codigo contendo os dados a serem impressos no documento word...

        $dataRelatorio = $this->relatorio->load_documentos($dataDateI ,$dataDateF, $estadoDestino);

        $dadosArray = array( );

        foreach ($dataRelatorio as $data) 
        {
           echo $data->ROW_ID;
           echo "<br>";

           $dataDocumento['data'] = $data;

            $documento = $this->relatorio->load_documento_completo($data->ROW_ID);


            $section->addText('-----------------//------------------------------------//------------------', 'SimStyle');
            $section->addTextBreak(1);


            foreach ($documento as $doct) 
            {

                $dataEx3 = explode("-", $doct->arrest_date);
                $month3 = $dataEx3[1];
                $day3 = $dataEx3[2];
                $year3 = $dataEx3[0];

                $dataOcorrencia = $day3."-".$month3."-".$year3;

                //  echo strftime( '%A, %d de %B de %Y', strtotime( date( 'Y-m-d' ) ) );

                $section->addText('Em  '.strftime( '%d de %B de %Y', strtotime( $dataOcorrencia ) ), 'SimStyle');

                $section->addText('Auto de Apresentação e Apreensão '.$doct->IPL ,'SimpleStyle');
               
                $section->addText('IPL - '.$doct->IPL.' - '. $doct->forca_seguranca ,'SimpleStyle');
                if($doct->link_arrest != null)
                {
                  $section->addText('Link para a reportagem : '.$doct->link_arrest, 'SimStyle');
                }
                if($doct->operation != null)
                {
                  $section->addText('Nome da operaçâo : '.$doct->operation, 'SimStyle');
                }

                if($doct->operation != null)
                {
                  $section->addText('Nome da operaçâo : '.$doct->operation, 'SimStyle');
                  $section->addText('Resumo da operacao : '.$doct->summary, 'SimStyle');
                }
            
                
                $section->addTextBreak(1);
               
            }

            $section->addText('Nesta data foram aprendidos : ', 'SimStyle');

            /* Lista de veiculos apreendidos... */

             $veiculos = $this->relatorio->load_documento_auto($data->ROW_ID);

             if( $veiculos != null){

               //$section->addText('Veiculos envolvidos','SimpleStyle');
               $section->addTextBreak(1);

               /*
            
                  public 'ID_vehicle' => string '27' (length=2)
  public 'ROW_ID' => string '123' (length=3)
  public 'category' => string '1' (length=1)
  public 'model' => string '291' (length=3)
  public 'brand' => string '12' (length=2)
  public 'chassi' => string '' (length=0)
  public 'renavan' => string '' (length=0)
  public 'placa' => string '' (length=0)
  public 'nome_estado' => null
  public 'cidade_nome' => null
  public 'mode_nome' => string '2002' (length=4)
  public 'marc_nome' => string 'BMW' (length=3)
  public 'tpve_nome' => string 'AUTOMÓVEL' (length=10)

               */


             foreach ($veiculos as $veic) {

               if($veic->marc_nome != '')
              {
                $veiculoNome = $veic->marc_nome;
              }else{
                $veiculoNome = " ";
              }

               if($veic->mode_nome != '')
              {
                $veiculoModelo = $veic->mode_nome;
              }
              else{
                $veiculoModelo = " ";
              }

              /*`Placa */
              if($veic->placa != '')
              {
                $veiculoPlaca = "Placa : ".$veic->placa;
              }else{
                $veiculoPlaca = " ";
              }
              /* Chassi */
              if($veic->chassi != '')
              {
                $veiculoChassi = "Chassi : ".$veic->chassi;
              }else{
                $veiculoChassi = " ";
              }

              /* Renavam */  
              if($veic->renavan != '')
              {
                $veiculoRenavam = "Chassi : ".$veic->renavan;
              }else{
                $veiculoRenavam = " ";
              }

              /* cidade e estado */
              if($veic->cidade_nome != '')
              {
                $veiculoCidade = "Proveniente de  : ".$veic->cidade_nome;
              }else{
                $veiculoCidade = " ";
              }


               if($veic->uf_estado != '')
              {
                if($veiculoCidade != " ")
                {
                  $veiculoEstado = "/".$veic->uf_estado;
                }else{
                  $veiculoEstado = "Proveniente de : ".$veic->uf_estado;
                }
              }else{
                $veiculoEstado = " ";
              }

                
                //$section->addText('Veiculos envolvidos','SimpleStyle');
                //$section->addTextBreak(1);
                $section->addText('Veiculo  : '.$veiculoNome.' '.$veiculoModelo.' '.$veiculoPlaca.' '.$veiculoChassi.' '.$veiculoCidade.''.$veiculoEstado, 'SimStyle');
                
                $section->addTextBreak(1);

                }
            } //Fim do if de veiculos envolvidos.........................................
            else{
               // $section->addText('Veiculos envolvidos : 0', 'SimStyle');
                $section->addTextBreak(1);
            }


            /* lista dos produtos apreendidos... */

               $mercadorias = $this->relatorio->load_mercadoria_relatorio($data->ROW_ID);
                //var_dump($veiculos);

            if( $mercadorias != null){

               //$section->addText('Mercadorias apreendidas','SimpleStyle');
               $section->addTextBreak(1);

             foreach ($mercadorias as $merc) {
                
                //$section->addText('Veiculos envolvidos','SimpleStyle');
                //$section->addTextBreak(1);
                $section->addText('Aproximadamente '.$merc->qty. ' '.$merc->unidade_medida.' de '.$merc->nome_produto, 'SimStyle');
                if($merc->nome_marca != null)
                {
                  $section->addText('O produto era da marca : '.$merc->nome_marca, 'SimStyle');
                }
                if($merc->nome_tabacalera != null )
                {
                  $section->addText('Tabacalera : '.$merc->nome_tabacalera, 'SimStyle');
                }
                
                //$section->addText('Marca - modelo :'.." - "., 'SimStyle');
                $section->addTextBreak(1);

                }
            } //Fim do if de mercadorias apreendidas.........................................
            else{
                //$section->addText('Mercadorias Apreendidas : 0', 'SimStyle');
                $section->addTextBreak(1);
            }


            /*Endereço da apreensão....................................................*/




            /*Lista de envolvidos aprenedidos .........................................*/

             $envolvidos = $this->relatorio->load_documento_envolvidos($data->ROW_ID);

            if( $envolvidos != null){

               $section->addText('As mercadorias estavam em poder de: ','SimpleStyle');
               $section->addTextBreak(1);

             foreach ($envolvidos as $pessoas) {
                
                //$section->addText('Veiculos envolvidos','SimpleStyle');
                //$section->addTextBreak(1);

              if($pessoas->father != '')
              {
                $filho = "filho de ";
              }
              else
              {
                $filho = " ";
              }

               if($pessoas->mother != '')
              {
                $filho = "filho de ";
              }
              else
              {
                $filho = " ";
              }
              /////////////////////////////////////////////////

              if($pessoas->father != '')
              {
                $paiEnvolvido = $pessoas->father;
              }
              else
              {
                $paiEnvolvido = "";
              }

              if($pessoas->mother != '')
              {
                if($paiEnvolvido != '')
                {
                  $maeEnvolvido = " e ".$pessoas->mother;
                }
                else{
                  $maeEnvolvido = $pessoas->mother;
                }
              }
              else
              {
                $maeEnvolvido = "";
              }
              //////////////////////////////////////////////////

              if($pessoas->birth_dt != '')
              {
                $dataEx4 = explode("-", $pessoas->birth_dt);
                  $month4 = $dataEx4[1];
                  $day4 = $dataEx4[2];
                  $year4 = $dataEx4[0];
                  $dataNascDet =  ", nascido aos ".$day4."/".$month4."/".$year4;
              }else
              {
                $dataNascDet = "";
              }

              if($pessoas->birth_dt != '')
              {

              }


        if($pessoas->nome != '')
        {
          $cidadeNasc = "em ".$pessoas->nome;
        }
        else{
          $cidadeNasc = " ";
        }

        if($pessoas->nome_estado != '')
        {
          if($cidadeNasc != '')
          {
            $estadoNasc =  "/".$pessoas->uf;
          }
          else{
            $estadoNasc =  "em ".$pessoas->uf;
          }
          
        }
        else{
          $estadoNasc = '';
        }

        /* se possuir CPF */

        if($pessoas->CPF != '' )
        {
          $cpfEnvolvido = "Portador do CPF ".$pessoas->CPF;
        }else
        {
          $cpfEnvolvido = "";
        }

        /* se possuir rg */

        if($pessoas->rg != '' )
        {
          if($cpfEnvolvido != '')
          {
            $rgEnvolvido =  "Portador do RG ".$pessoas->rg;
          }
          else{
            $rgEnvolvido =  "e do RG ".$pessoas->rg;
          }
        }else
        {
          $rgEnvolvido = "";
        }

        /* Endereço do envolvido */

        if($pessoas->address != '' )
        {
          $enderecoResidencia = "residente em ".$pessoas->address;
        }else
        {
          $enderecoResidencia = "";
        }

        /* estado e cidade do individuo */
         if($pessoas->end_Cid != '')
        {
          $cidadeEnd = "em ".$pessoas->end_Cid;
        }
        else{
          $cidadeEnd = "";
        }

        if($pessoas->end_uf != '')
        {
          if($cidadeEnd != ' ')
          {
            $estadoEnd =  "/".$pessoas->end_uf;
          }
          else{
            $estadoEnd =  "em ".$pessoas->end_uf;
          }
          
        }
        else{
          $estadoEnd = '';
        }

        /* telefone do detido  */

        if($pessoas->telefone != '' )
        {
          $telefoneDetido = "Celular  ".$pessoas->telefone;
        }else
        {
          $telefoneDetido = "";
        }

              
                /*Paragrafo responsavel pelos dados dos detidos */
                $section->addText( strtoupper($pessoas->name).', nascido no '.$pessoas->nome_pais.' '.$filho.' '.$paiEnvolvido.' '.$maeEnvolvido.' '.$dataNascDet. ' '.
                  $cidadeNasc."".$estadoNasc." ,". $cpfEnvolvido. " ".$rgEnvolvido." ,".$enderecoResidencia." ".$cidadeEnd."".$estadoEnd.
                  "".$telefoneDetido, 'SimStyle');
                
                $section->addTextBreak(1);

                }
            } //Fim do if de veiculos envolvidos........................................
            else{
               // $section->addText('Pessoas envolvidas nesta ocorrencia: 0', 'SimStyle');
                $section->addTextBreak(1);
            }

            //Fim da exibição de envolvidos.............................................




            //var_dump($documento);

           //$dataDocumento['documento'] = $documento;

           $endereço = $this->relatorio->load_documento_endereco($data->ROW_ID);
            //var_dump($endereço);
           /*

            IMPRIMIR TODOS OS ENDEREÇOS RELACIONADOS A ESSA OCORRENCIA...
            foreach ($endereço[0] as $end) { 
                
                $section->addText('Endereco da ocorrencia','SimpleStyle');
                
                $section->addText('Endereço : '.$end->address, 'SimStyle');
                
                $section->addText('Bairro : '.$end->district, 'SimStyle');
           
                $section->addText('Cidade - estado :'.$end->nome." - ".$end->nome_estado, 'SimStyle');
                $section->addTextBreak(1);

                object(stdClass)[47]
                  public 'ID_addr' => string '113' (length=3)
                  public 'address' => string 'Rua da ocorrencia' (length=17)
                  public 'nunber' => string '125' (length=3)
                  public 'complement' => string 'Ocorrencia' (length=10)
                  public 'district' => string 'Bairro' (length=6)
                  public 'nome_estado' => string 'Acre' (length=4)
                  public 'nome' => string 'Assis Brasil' (length=12)


            }
            */
            if($endereço != null)
            {

              if($endereço[0]->address != '')
              {
                $logradouro = $endereço[0]->address;
              }
              else {
                $logradouro = " ";
              }

              if($endereço[0]->nunber != '')
              {
                $numeroEnd = "numero ".$endereço[0]->nunber;
              }else{
                $numeroEnd = "";
              }

              if($endereço[0]->nunber != '')
              {
                $numeroEnd = "numero ".$endereço[0]->nunber;
              }else{
                $numeroEnd = "";
              }

              if($endereço[0]->complement != '')
              {
                $complementEnd = " com a referencia ".$endereço[0]->complement;
              }else{
                $complementEnd = "";
              }

              if($endereço[0]->district != '')
              {
                $bairroEnd = " no bairro ".$endereço[0]->district;
              }else{
                $bairroEnd = "";
              }

              if($endereço[0]->nome != '')
              {
                $cidadeEnd = " na cidade de  ".$endereço[0]->nome;
              }else{
                $cidadeEnd = "";
              }

              if($endereço[0]->uf != '')
              {
                if($endereço[0]->nome != '')
                {
                  $estadoEnd = "/".$endereço[0]->uf;
                }else{
                  $estadoEnd = "no estado de ".$endereço[0]->uf;
                }
              }else{
                $estadoEnd = "";
              }



                $section->addText('A referida apreensâo ocorreu nas proximidade do endereço : '.$logradouro.' '.$numeroEnd.' '.$complementEnd.' '.$bairroEnd.' '.$cidadeEnd.' '.$estadoEnd ,'SimStyle');

                $section->addTextBreak(1);
            }

            //Fim da exibição de endereços..............................................

            //Inicio da exibição de envolvidos..........................................
      /*
             object(stdClass)[33]
      public 'ID_contact' => string '16' (length=2)
      public 'name' => string 'Individuo A' (length=11)
      public 'CPF' => string '13609613726' (length=11)
      public 'rg' => string '' (length=0)
      public 'passport' => string '' (length=0)
      public 'father' => string '' (length=0)
      public 'mother' => string '' (length=0)
      public 'birth_dt' => string '2014-09-09' (length=10)
      public 'nome_pais' => string 'Brasil' (length=6)
      public 'nome_estado' => string 'EspÃ­rito Santo' (length=15)
      public 'nome' => string 'Acioli' (length=6)
      */

           



            //Inicio de exibição das mercadorias apreendidas.............................

                //Inicio da exibição de veiculos 
               

            //Fim da exibição das mercadorias apreenção..................................

            //Inicio do endereço do deposio .............................................

            $endereçoDeposito = $this->relatorio->load_endereco_wrs_relatorio($data->ROW_ID);

            if($endereçoDeposito != null)
            {

               if($endereçoDeposito[0]->address != '')
              {
                $logradouroDept = $endereçoDeposito[0]->address;
              }
              else {
                $logradouroDept = " ";
              }

              if($endereçoDeposito[0]->nunber != '')
              {
                $numeroDept = "numero ".$endereçoDeposito[0]->nunber;
              }else{
                $numeroDept = "";
              }

              if($endereçoDeposito[0]->complement != '')
              {
                $complementDept = " com a referencia ".$endereçoDeposito[0]->complement;
              }else{
                $complementDept = "";
              }

              if($endereçoDeposito[0]->district != '')
              {
                $bairroDept = " no bairro ".$endereçoDeposito[0]->district;
              }else{
                $bairroDept = "";
              }

              if($endereçoDeposito[0]->nome != '')
              {
                $cidadeDept = " na cidade de  ".$endereçoDeposito[0]->nome;
              }else{
                $cidadeDept = "";
              }

              if($endereçoDeposito[0]->uf != '')
              {
                if($endereçoDeposito[0]->nome != '')
                {
                  $estadoDept = "/".$endereçoDeposito[0]->uf;
                }else{
                  $estadoDept = "no estado de ".$endereçoDeposito[0]->uf;
                }
              }else{
                $estadoDept = "";
              }



                $section->addText('Os seguintes produtos foram apreendidos no seguinte endereço : '.$logradouroDept.' '.$numeroDept.' '.$complementDept.' '.$bairroDept.' '.$cidadeDept.' '.$estadoDept ,'SimStyle');

                $section->addTextBreak(1);

            }
            else{
                  $section->addText(' ', 'SimStyle');
                  $section->addTextBreak(1);
            }


            //Fim do endereço do deposito................................................


            //Inicio dos produtos do deposito............................................

            $produtoDeposito = $this->relatorio->load_armazem_relatorio($data->ROW_ID);
            $produtos_armazens = $this->relatorio->load_armazem_relatorio($data->ROW_ID);

            if( $produtoDeposito != null){

               //$section->addText('Produtos apreendidos no deposito','SimpleStyle');
               //$section->addTextBreak(1);

             foreach ($produtoDeposito as $produtosDep) {


              if($produtosDep->nome_produto != '')
              {
                $nomeProdutoDept = $produtosDep->nome_produto;
              }else{
                $produtoDept = " ";
              }
              /* quantidade */

               if($produtosDep->quantidade_deposito != '')
              {
                $quantProdutoDept = $produtosDep->quantidade_deposito;
              }else{
                $quantProdutoDept = " ";
              }

              /* Unidade de medida */

              if($produtosDep->unidade_medida != '')
              {
                $unidadeProdutoDept = $produtosDep->unidade_medida;
              }else{
                $unidadeProdutoDept = " ";
              }


              /* nome da marca  */
              if($produtosDep->nome_marca){
                $marcaProd = " ,da marca :".$produtosDep->nome_marca;
              }else{
                $marcaProd = "";
              }

               /* tabacalera  */
              if($produtosDep->nome_marca){
                $tabacaleraProd = " ,da tabacalera :".$produtosDep->nome_tabacalera;
              }else{
                $tabacaleraProd = "";
              }
                
                //$section->addText('Veiculos envolvidos','SimpleStyle');
                //$section->addTextBreak(1);
                $section->addText(''.$quantProdutoDept.' '.$unidadeProdutoDept.' de '.$nomeProdutoDept.' '.$marcaProd.' '.$tabacaleraProd, 'SimStyle');
                
                //$section->addText('Marca : '.$produtosDep->nome_marca, 'SimStyle');
                
                //$section->addText('Tabacalera : '.$produtosDep->nome_tabacalera, 'SimStyle');
                
               // $section->addText('Marca - modelo :'.$produtosDep->qty." - ".$produtosDep->unidade_medida, 'SimStyle');
                $section->addTextBreak(1);

                }
            } //Fim do if de veiculos envolvidos.........................................
            else{
                //$section->addText('deposito  : 0', 'SimStyle');
                $section->addTextBreak(1);
            }

            //Fim dos produtos do deposito...............................................

            //Inicio das imagens da ocorrencia............................................

            $imagens = $this->relatorio->load_documento_imagens($data->ROW_ID);

            if( $imagens != null){


               $section->addText('Imagens da ocorrencia','SimpleStyle');
               $section->addTextBreak(1);

             foreach ($imagens as $img) {
                
                //$section->addText('Fotos da Ocorrencia','SimpleStyle');
                //$section->addTextBreak(1);
                //$section->addText('Nome da imagem  : '.$img->title_image, 'SimStyle');
                //$section->addImage(FCPATH.'/imagens_doct/'.$img->nome_image_doct);
                //$section->addTextBreak(1);
        
                $section->addImage(FCPATH.'/imagens_doct/'.$img->nome_image_doct, array('width'=>210, 'height'=>210));
                //$section->addTextBreak(1);
        
               // $section->addImage(FCPATH.'/imagens_doct/'.$img->nome_image_doct, array('width'=>100, 'height'=>100, 'align'=>'right'));
                
              
                $section->addTextBreak(1);

                }
            } //Fim do if de Imagens da ocorrencia...
            else{
                $section->addText('-', 'SimStyle');
                $section->addTextBreak(1);
            }



            /*
             <h3>Veiculo envolvido</h3>
            <p>Tipo do veiculo : <?php echo $veiculos->tpve_nome ?></p>
            <p>Marca do veiculo : <?php echo $veiculos->marc_nome ?></p>
            <p>Modelo do veiculo : <?php echo $veiculos->mode_nome ?></p>
            <p>Placa : <?php echo $veiculos->placa ?></p>
            <p>Chassi : <?php echo $veiculos->chassi ?></p>
            <p>Estado : <?php echo $veiculos->nome_estado ?></p>

            <h3>Endereço da ocorrencia</h3>
        <p>Cidade da ocorrencia : <?php echo $ocorrencia['endereco'][0]->nome_estado ?></p>
        <p>Estado da ocorrencia : <?php echo $ocorrencia['endereco'][0]->nome ?></p>
        <p>Endereço : <?php echo $ocorrencia['endereco'][0]->address ?></p>
        <p>Numero : <?php echo $ocorrencia['endereco'][0]->nunber ?></p>
        <p>Complemento : <?php echo $ocorrencia['endereco'][0]->complement ?></p>
        <p>Bairro : <?php echo $ocorrencia['endereco'][0]->district ?></p>


           $dataDocumento['endereco'] = $endereço;   

            $veiculos = $this->relatorio->load_documento_auto($data->ROW_ID);
            var_dump($veiculos);

            $dataDocumento['veiculos'] = $veiculos;

            array_push($dadosArray , $dataDocumento);*/


        }


            /* Data inicial e data final   $dataDateI ,$dataDateF */  

            $totalVeiculos = $this->relatorio->total_veiculos_relatorio($dataDateI ,$dataDateF);
            $totalDepositos = $this->relatorio->total_depositos($dataDateI ,$dataDateF);
            $totalCaminhao = $this->relatorio->total_veiculos_caminhao_relatorio($dataDateI ,$dataDateF);
            $totalOnibus = $this->relatorio->total_veiculos_onibus_relatorio($dataDateI ,$dataDateF);

           /*Adição de tabela com dados */

            /*
            for($i = 1; $i <= 2; $i++) {
            $table->addRow();
            $table->addCell(2000)->addText("Cell $i");
            $table->addCell(2000)->addText("Cell $i");
            $table->addCell(2000)->addText("Cell $i");
            $table->addCell(2000)->addText("Cell $i");
            $text = ($i % 2 == 0) ? 'X' : '';
            $table->addCell(500)->addText($text);
            }
            */


            $section->addTextBreak(1);

            $styleTable = array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80);
            $styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');
            // Define cell style arrays
            $styleCell = array('valign'=>'center');
            $styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);
            // Define font style for first row
            $fontStyle = array('bold'=>true, 'align'=>'center');


            $table = $section->addTable('resumoDoMes');

            $this->word->addTableStyle('resumoDoMes', $styleTable, $styleFirstRow);

             // Add row
            $table->addRow(900);
            // Add cells
            $table->addCell(6000, $styleCell)->addText('Resumo do relatorio ', $styleTable);
            
            $table->addRow();
            $table->addCell(2000, $styleCell)->addText(' Caixas de cigarros', $styleTable);
            $table->addCell(2000, $styleCell)->addText(' '.$totalVeiculos.' veiculos', $styleTable);
            $table->addCell(2000, $styleCell)->addText(' '.$totalCaminhao.' Caminhoes', $styleTable);
            $table->addCell(2000, $styleCell)->addText(' '.$totalOnibus.' Onibus', $styleTable);
            $table->addCell(2000, $styleCell)->addText(' '.$totalDepositos.' Depositos', $styleTable);


             $section->addTextBreak(1);






        $section->addText('Data de inicio do relatorio :'.$dataI);
        $section->addTextBreak(1);

        $section->addText('Data do fim do relatorio :'.$dataF);
        $section->addTextBreak(3);


         
       // $section->addText('I am inline styled.', array('name'=>'Verdana', 'color'=>'006699'));
        //$section->addTextBreak(1);
         
       // $this->word->addFontStyle('rStyle', array('bold'=>true, 'italic'=>true, 'size'=>16));
       // $this->word->addParagraphStyle('pStyle', array('align'=>'center', 'spaceAfter'=>100));
       // $section->addText('I am styled by two style definitions.', 'rStyle', 'pStyle');
        //$section->addText('I have only a paragraph style definition.', null, 'pStyle');


        $filename='Teste_de_relatorio.docx'; //NOME DO ARQUIVO A SER SALVO

        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
         
        $objWriter = PHPWord_IOFactory::createWriter($this->word, 'Word2007');
        $objWriter->save('php://output');
       

    }


    public function gerar_doc()
    {
        
        $this->load->library('word');
        //our docx will have 'lanscape' paper orientation
        $section = $this->word->createSection(array('orientation'=>'vertical'));

        // Add text elements
        $section->addText('Hello World!');
        $section->addTextBreak(1);
         
        $section->addText('I am inline styled.', array('name'=>'Verdana', 'color'=>'006699'));
        $section->addTextBreak(1);
         
        $this->word->addFontStyle('rStyle', array('bold'=>true, 'italic'=>true, 'size'=>16));
        $this->word->addParagraphStyle('pStyle', array('align'=>'center', 'spaceAfter'=>100));
        $section->addText('I am styled by two style definitions.', 'rStyle', 'pStyle');
        $section->addText('I have only a paragraph style definition.', null, 'pStyle');

        $filename='just_some_random_name.docx'; //save our document as this file name
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
         
        $objWriter = PHPWord_IOFactory::createWriter($this->word, 'Word2007');
        $objWriter->save('php://output');

    }
////////////////////////////////////////////////////////////////////********


////////////////////////////////////////////////////////////////////********


/////////////////////////////////Funções para a nova versão do phpWord //////////////////////
/**
 * Write documents
 *
 * @param \PhpOffice\PhpWord\PhpWord $phpWord
 * @param string $filename
 * @param array $writers
 */
public function getEndingNotes($writers)
{
    $result = '';

    // Do not show execution time for index
    if (!IS_INDEX) {
        $result .= date('H:i:s') . " Done writing file(s)" . EOL;
        $result .= date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB" . EOL;
    }

    // Return
    if (CLI) {
        $result .= 'The results are stored in the "results" subdirectory.' . EOL;
    } else {
        if (!IS_INDEX) {
            $types = array_values($writers);
            $result .= '<p>&nbsp;</p>';
            $result .= '<p>Results: ';
            foreach ($types as $type) {
                if (!is_null($type)) {
                    $resultFile = 'results/' . SCRIPT_FILENAME . '.' . $type;
                    if (file_exists($resultFile)) {
                        $result .= "<a href='{$resultFile}' class='btn btn-primary'>{$type}</a> ";
                    }
                }
            }
            $result .= '</p>';
        }
    }

    return $result;
}

public function write($phpWord, $filename, $writers)
{
    $result = '';

    // Write documents
    foreach ($writers as $writer => $extension) {
        $result .= date('H:i:s') . " Write to {$writer} format";
        if (!is_null($extension)) {
            $xmlWriter = IOFactory::createWriter($phpWord, $writer);
            $xmlWriter->save(__DIR__ . "/{$filename}.{$extension}");
            rename(__DIR__ . "/{$filename}.{$extension}", __DIR__ . "/results/{$filename}.{$extension}");

            // Finally, write the document:
            $objWriter = \PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save('helloWorld.docx');

        } else {
            $result .= ' ... NOT DONE!';
        }
        $result .= EOL;
    }

    $result .= $this->getEndingNotes($writers);

    return $result;
}


    public function gera_word()
    {

      $this->load->library('word2');


        // Set writers
        $writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');

        // Set PDF renderer
        if (Settings::getPdfRendererPath() === null) {
            $writers['PDF'] = null;
        }

        // Return to the caller script when runs by CLI
        //if (CLI) {
         //   return;
        //}

        // Set titles and names
        //$pageHeading = str_replace('_', ' ', SCRIPT_FILENAME);
        $pageHeading = "page heading";


        //$pageTitle = IS_INDEX ? 'Welcome to ' : "{$pageHeading} - ";

        $pageTitle = "titulo da pagina";
        //$pageTitle .= 'PHPWord';
        //$pageHeading = IS_INDEX ? '' : "<h1>{$pageHeading}</h1>";

        // Populate samples
        $files = '';
        if ($handle = opendir('.')) {
            while (false !== ($file = readdir($handle))) {
                if (preg_match('/^Sample_\d+_/', $file)) {
                    $name = str_replace('_', ' ', preg_replace('/(Sample_|\.php)/', '', $file));
                    $files .= "<li><a href='{$file}'>{$name}</a></li>";
                }
            }
            closedir($handle);
        }



      //include_once 'Sample_Header.php';
      require_once APPPATH."third_party/PHPWord2/PhpWord.php";


      // New Word Document
      echo date('H:i:s') , " Create new PhpWord object";
      $phpWord = new \PhpOffice\PhpWord\PhpWord();
      $phpWord->addFontStyle('rStyle', array('bold' => true, 'italic' => true, 'size' => 16, 'allCaps' => true, 'doubleStrikethrough' => true));
      $phpWord->addParagraphStyle('pStyle', array('align' => 'center', 'spaceAfter' => 100));
      $phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));

      // New portrait section
      $section = $phpWord->addSection();

      // Simple text
      $section->addTitle('Welcome to PhpWord', 1);
      $section->addText('Hello World!');

      // Two text break
      $section->addTextBreak(2);

      // Defined style
      $section->addText('I am styled by a font style definition.', 'rStyle');
      $section->addText('I am styled by a paragraph style definition.', null, 'pStyle');
      $section->addText('I am styled by both font and paragraph style.', 'rStyle', 'pStyle');

      $section->addPageBreak();

      // Inline font style
      $fontStyle['name'] = 'Times New Roman';
      $fontStyle['size'] = 20;
      $fontStyle['bold'] = true;
      $fontStyle['italic'] = true;
      $fontStyle['underline'] = 'dash';
      $fontStyle['strikethrough'] = true;
      $fontStyle['superScript'] = true;
      $fontStyle['color'] = 'FF0000';
      $fontStyle['fgColor'] = 'yellow';
      $fontStyle['smallCaps'] = true;
      $section->addText('I am inline styled.', $fontStyle);

      $section->addTextBreak();

      // Link
      $section->addLink('http://www.google.com', 'Google');
      $section->addTextBreak();

      // Image
      //$section->addImage('resources/_earth.jpg', array('width'=>18, 'height'=>18));

      // Save file
      //echo write($phpWord, basename(__FILE__, '.php'), $writers);
      //if (!CLI) {
          //include_once 'Sample_Footer.php';
     // }
      // Save file
      echo $this->write($phpWord, basename(__FILE__, '.php'), $writers);
      if (!CLI) {
          //include_once 'Sample_Footer.php';
      }
    }
}

class IOFactory
{
    /**
     * Create new writer
     *
     * @param PhpWord $phpWord
     * @param string $name
     * @return \PhpOffice\PhpWord\Writer\WriterInterface
     * @throws \PhpOffice\PhpWord\Exception\Exception
     */
    public static function createWriter(PhpWord $phpWord, $name = 'Word2007')
    {
        $class = 'PhpOffice\\PhpWord\\Writer\\' . $name;
        if (class_exists($class) && self::isConcreteClass($class)) {
            return new $class($phpWord);
        } else {
            throw new Exception("\"{$name}\" is not a valid writer.");
        }
    }

    /**
     * Create new reader
     *
     * @param string $name
     * @return \PhpOffice\PhpWord\Reader\ReaderInterface
     * @throws \PhpOffice\PhpWord\Exception\Exception
     */
    public static function createReader($name = 'Word2007')
    {
        $class = 'PhpOffice\\PhpWord\\Reader\\' . $name;
        if (class_exists($class) && self::isConcreteClass($class)) {
            return new $class();
        } else {
            throw new Exception("\"{$name}\" is not a valid reader.");
        }
    }

    /**
     * Loads PhpWord from file
     *
     * @param string $filename The name of the file
     * @param string $readerName
     * @return PhpWord
     */
    public static function load($filename, $readerName = 'Word2007')
    {
        $reader = self::createReader($readerName);

        return $reader->load($filename);
    }

    /**
     * Check if it's a concrete class (not abstract nor interface)
     *
     * @param string $class
     * @return bool
     */
    private static function isConcreteClass($class)
    {
        $reflection = new \ReflectionClass($class);

        return !$reflection->isAbstract() && !$reflection->isInterface();
    }

}