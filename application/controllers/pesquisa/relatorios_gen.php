<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Relatorios_gen extends CI_Controller {
    
    function __construct() {
        parent::__construct();

        $this->load->model('Relatorios_model','relatorio');
        $this->load->model('User_model', 'user');
        $this->user->logged();

       // $this->load->library('PHPJasperXML/class/PHPJasperXML');
       // $this->PHPJasperXML->xml_dismantle($xml);
       // $this->PHPJasperXML->outpage("I");  
    }
    
    public function index() {

        $this->load->view('templates/header');
        $this->load->view('pesquisa/gera_relatorio_view');
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

    public function visualizarRel()
    {
        $dataIni = $this->input->post('dataInicial');
        $dataFim = $this->input->post('dataFinal');

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

        /*
            string '08/09/2014' (length=10)

string '24/09/2014' (length=10)


        */

       // echo $dataIni;
       // echo "</br>";
       // echo $dataFim;
       //die;

        $dataRelatorio = $this->relatorio->load_documentos($dataIni ,$dataFim);

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
            //Mercadorias....
            $mercadorias = $this->relatorio->load_mercadoria_relatorio($data->ROW_ID);
             if($mercadorias != null) {
                $dataDocumento['mercadorias'] = $mercadorias;   
            }else
            {
                $dataDocumento['mercadorias'][0] = "";
            }

            //Pessoas envolvidas...

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

            //Armazens casas locais...

            $armazens = $this->relatorio->load_documento_envolvidos($data->ROW_ID);
             if($armazens != null) {
                $dataDocumento['armazens'] = $armazens;   
            }else
            {
                $dataDocumento['armazens'][0] = "";
            }

            //Imagens da operação...


            array_push($dadosArray , $dataDocumento);
        }
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
        $this->word->addFontStyle('SimStyle', array('bold'=>false, 'arial'=>true, 'size'=>14));


        // Add text elements
        $section->addText('Data do relatorio gerado : '.$dataGeracao);
        $section->addTextBreak(15);


        $this->word->addFontStyle('TStyle', array('bold'=>true, 'calibri'=>true, 'size'=>28));
        $this->word->addParagraphStyle('pTStyle', array('align'=>'center', 'spaceAfter'=>100));
        $section->addText('Relatorio de apreensao do periodo de :', 'TStyle', 'pTStyle');
        $section->addText($dataI.' a '.$dataF,  'TStyle', 'pTStyle');
        $section->addTextBreak(15);


        ////Codigo contendo os dados a serem impressos no documento word...

        $dataRelatorio = $this->relatorio->load_documentos($dataDateI ,$dataDateF);

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

                $dataOcorrencia = $day3."/".$month3."/".$year3;

               
                $section->addText('Detalhes da ocorrencia : '.$doct->IPL ,'SimpleStyle');
                $section->addTextBreak(1);
                $section->addText('Data da operacao : '.$dataOcorrencia, 'SimStyle');
                $section->addTextBreak(1);
                $section->addText('Forca de seguranca : '.$doct->forca_seguranca, 'SimStyle');
                $section->addTextBreak(1);
                $section->addText('Nome da operacao : '.$doct->operation, 'SimStyle');
                $section->addTextBreak(1);
                $section->addText('Resumo da operacao : '.$doct->summary, 'SimStyle');
                $section->addTextBreak(1);
               
            }


            /*


        <h3>Detalhes da ocorrencia</h3>

        <p>Data da ocorrencia : <?php echo $ocorrencia['documento'][0]->arrest_date?></p>
        </br>
        <p>Força de segurança : <?php echo $ocorrencia['documento'][0]->forca_seguranca?></p>
        <p>Nome da operação : <?php echo $ocorrencia['documento'][0]->operation?></p>
        <p>Resumo da operação : <?php echo $ocorrencia['documento'][0]->summary?></p>
        
        */
            



            //var_dump($documento);

           //$dataDocumento['documento'] = $documento;

           $endereço = $this->relatorio->load_documento_endereco($data->ROW_ID);
            //var_dump($endereço);

            foreach ($endereço as $end) {
                
                $section->addText('Endereco da ocorrencia','SimpleStyle');
                $section->addTextBreak(1);
                $section->addText('Endereço : '.$end->address, 'SimStyle');
                $section->addTextBreak(1);
                $section->addText('Bairro : '.$end->district, 'SimStyle');
                $section->addTextBreak(1);
                $section->addText('Cidade - estado :'.$end->nome." - ".$end->nome_estado, 'SimStyle');
                $section->addTextBreak(1);

            }


             $veiculos = $this->relatorio->load_documento_auto($data->ROW_ID);
            //var_dump($veiculos);
              

            if( $veiculos != null){

               $section->addText('Veiculos envolvidos','SimpleStyle');
               $section->addTextBreak(1);

             foreach ($veiculos as $veic) {
                
                //$section->addText('Veiculos envolvidos','SimpleStyle');
                //$section->addTextBreak(1);
                $section->addText('Veiculo  : '.$veic->tpve_nome, 'SimStyle');
                $section->addTextBreak(1);
                $section->addText('Placa : '.$veic->placa, 'SimStyle');
                $section->addTextBreak(1);
                $section->addText('Chassi : '.$veic->chassi, 'SimStyle');
                $section->addTextBreak(1);
                $section->addText('Marca - modelo :'.$veic->marc_nome." - ".$veic->mode_nome, 'SimStyle');
                $section->addTextBreak(1);

                }
            } //Fim do if de veiculos envolvidos...
            else{
                $section->addText('-----------------//------------------------------------//------------------', 'SimStyle');
                $section->addTextBreak(3);
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

    public function gera_word()
    {
      
    }
}