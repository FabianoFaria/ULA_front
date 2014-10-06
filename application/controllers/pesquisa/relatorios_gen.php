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
                $dataDocumento['envolvidos'] = $envolvidos;   
            }else
            {
                $dataDocumento['envolvidos'][0] = "";
            }

            /*
                object(stdClass)[34]
      public 'ID_main' => string '215' (length=3)
      public 'ROW_ID' => string '123' (length=3)
      public 'parent_id' => string '123' (length=3)
      public 'parent_TBL' => string 'tbl_doct' (length=8)
      public 'CHILD_ID' => string '16' (length=2)
      public 'CHILD_TBL' => string 'tbl_contact' (length=11)
      public 'UPDATED_BY' => string 'Niguem' (length=6)
      public 'LAST_UPDATE' => string '2014-09-16 02:56:24' (length=19)
      public 'CREATED_BY' => string 'qwe' (length=3)
      public 'CREATED' => string '2014-09-13 20:31:18' (length=19)
      public 'ID_contact' => string '16' (length=2)
      public 'name' => string 'Individuo A' (length=11)
      public 'CPF' => string '13609613726' (length=11)
      public 'rg' => string '' (length=0)
      public 'passport' => string '' (length=0)
      public 'father' => string '' (length=0)
      public 'mother' => string '' (length=0)
      public 'birth_dt' => string '2014-09-09' (length=10)
      public 'birth_city' => string '1743' (length=4)
      public 'birth_state' => string '08' (length=2)
      public 'birth_country' => string '33' (length=2)
      public 'ADDR_PR_ID' => null
      public 'phone_PR_ID' => null
      public 'UPDATE_BY' => string 'qwe' (length=3)
      public 'telefone' => string '' (length=0)
      public 'marca_telefone' => string '' (length=0)
      public 'modelo_telefone' => string '' (length=0)
      public 'IMEI' => string '' (length=0)
      public 'operadora' => string '' (length=0)
      public 'deletado' => string '0' (length=1)
      public 'Id_pais' => string '33' (length=2)
      public 'nome_pais' => string 'Brasil' (length=6)
      public 'country_name' => string 'BRAZIL' (length=6)
      public 'id_estado' => string '08' (length=2)
      public 'uf' => string 'ES' (length=2)
      public 'nome_estado' => string 'EspÃ­rito Santo' (length=15)
      public 'id' => string '1743' (length=4)
      public 'estado' => string '08' (length=2)
      public 'nome' => string 'Acioli' (length=6)
            */

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

            /*
                 public 'ID_main' => string '294' (length=3)
                  public 'ROW_ID' => string '131' (length=3)
                  public 'parent_id' => string '131' (length=3)
                  public 'parent_TBL' => string 'tbl_doct' (length=8)
                  public 'CHILD_ID' => string '11' (length=2)
                  public 'CHILD_TBL' => string 'tbl_image_doct' (length=14)
                  public 'UPDATED_BY' => string 'Niguem' (length=6)
                  public 'LAST_UPDATE' => string '0000-00-00 00:00:00' (length=19)
                  public 'CREATED_BY' => string 'qwe' (length=3)
                  public 'CREATED' => string '2014-09-25 03:07:44' (length=19)
                  public 'id_image' => string '11' (length=2)
                  public 'id_row' => string '131' (length=3)
                  public 'title_image' => string 'Foto A' (length=6)
                  public 'nome_image_doct' => string '13d6d38b47e0d6a9b714618e37751984.jpg' (length=36)
                  public 'UPDATE_BY' => string 'Ninguem' (length=7)

            */

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
               
                $section->addText('Data da operacao : '.$dataOcorrencia, 'SimStyle');
             
                $section->addText('Forca de seguranca : '.$doct->forca_seguranca, 'SimStyle');
                
                $section->addText('Nome da operacao : '.$doct->operation, 'SimStyle');
            
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
           /*

            IMPRIMIR TODOS OS ENDEREÇOS RELACIONADOS A ESSA OCORRENCIA...
            foreach ($endereço[0] as $end) { 
                
                $section->addText('Endereco da ocorrencia','SimpleStyle');
                
                $section->addText('Endereço : '.$end->address, 'SimStyle');
                
                $section->addText('Bairro : '.$end->district, 'SimStyle');
           
                $section->addText('Cidade - estado :'.$end->nome." - ".$end->nome_estado, 'SimStyle');
                $section->addTextBreak(1);

            }*/
            if($endereço != null)
            {
                $section->addText('Endereco da ocorrencia','SimpleStyle');
                
                $section->addText('Endereço : '.$endereço[0]->address, 'SimStyle');
                
                $section->addText('Bairro : '.$endereço[0]->district, 'SimStyle');
           
                $section->addText('Cidade - estado :'.$endereço[0]->nome." - ".$endereço[0]->nome_estado, 'SimStyle');
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

            $envolvidos = $this->relatorio->load_documento_envolvidos($data->ROW_ID);

            if( $envolvidos != null){

               $section->addText('Pessoas envolvidos','SimpleStyle');
               $section->addTextBreak(1);

             foreach ($envolvidos as $pessoas) {
                
                //$section->addText('Veiculos envolvidos','SimpleStyle');
                //$section->addTextBreak(1);
                $section->addText('Nome do envolvido  : '.$pessoas->name, 'SimStyle');
                
                $section->addText('CPF : '.$pessoas->CPF, 'SimStyle');
                
                $section->addText('RG : '.$pessoas->rg, 'SimStyle');
                
                $section->addText('Estado - Cidade :'.$pessoas->nome_estado." - ".$pessoas->nome, 'SimStyle');
                $section->addTextBreak(1);

                }
            } //Fim do if de veiculos envolvidos........................................
            else{
                $section->addText('Pessoas envolvidas nesta ocorrencia: 0', 'SimStyle');
                $section->addTextBreak(1);
            }

            //Fim da exibição de envolvidos.............................................

            //Inicio da exibição de veiculos 
             $veiculos = $this->relatorio->load_documento_auto($data->ROW_ID);
            //var_dump($veiculos);
              

            if( $veiculos != null){

               $section->addText('Veiculos envolvidos','SimpleStyle');
               $section->addTextBreak(1);

             foreach ($veiculos as $veic) {
                
                //$section->addText('Veiculos envolvidos','SimpleStyle');
                //$section->addTextBreak(1);
                $section->addText('Veiculo  : '.$veic->tpve_nome, 'SimStyle');
                
                $section->addText('Placa : '.$veic->placa, 'SimStyle');
                
                $section->addText('Chassi : '.$veic->chassi, 'SimStyle');
                
                $section->addText('Marca - modelo :'.$veic->marc_nome." - ".$veic->mode_nome, 'SimStyle');
                $section->addTextBreak(1);

                }
            } //Fim do if de veiculos envolvidos.........................................
            else{
                $section->addText('Veiculos envolvidos : 0', 'SimStyle');
                $section->addTextBreak(1);
            }


            //Inicio de exibição das mercadorias apreendidas.............................

                //Inicio da exibição de veiculos 
                $mercadorias = $this->relatorio->load_mercadoria_relatorio($data->ROW_ID);
                //var_dump($veiculos);

            if( $mercadorias != null){

               $section->addText('Mercadorias apreendidas','SimpleStyle');
               $section->addTextBreak(1);

             foreach ($mercadorias as $merc) {
                
                //$section->addText('Veiculos envolvidos','SimpleStyle');
                //$section->addTextBreak(1);
                $section->addText('Produto   : '.$merc->nome_produto, 'SimStyle');
                
                $section->addText('Marca : '.$merc->nome_marca, 'SimStyle');
                
                $section->addText('Tabacalera : '.$merc->nome_tabacalera, 'SimStyle');
                
                $section->addText('Marca - modelo :'.$merc->qty." - ".$merc->unidade_medida, 'SimStyle');
                $section->addTextBreak(1);

                }


            } //Fim do if de veiculos envolvidos.........................................
            else{
                $section->addText('Mercadorias Apreendidas : 0', 'SimStyle');
                $section->addTextBreak(1);
            }

            //Fim da exibição das mercadorias apreenção..................................

            //Inicio do endereço do deposio .............................................

            $endereçoDeposito = $this->relatorio->load_endereco_wrs_relatorio($data->ROW_ID);

            if($endereçoDeposito != null)
            {
                $section->addText('Endereço do deposito','SimpleStyle');
                $section->addTextBreak(1);
                
                $section->addText('Endereço : '.$endereçoDeposito[0]->address, 'SimStyle');
                
                $section->addText('Bairro : '.$endereçoDeposito[0]->district, 'SimStyle');
           
                $section->addText('Cidade - estado :'.$endereçoDeposito[0]->nome." - ".$endereçoDeposito[0]->nome_estado, 'SimStyle');
                $section->addTextBreak(1);
            }
            else{
                  $section->addText(' ', 'SimStyle');
                  $section->addTextBreak(1);
            }


            //Fim do endereço do deposito................................................


            //Inicio dos produtos do deposito............................................

            $produtoDeposito = $this->relatorio->load_armazem_relatorio($data->ROW_ID);

            if( $produtoDeposito != null){

               $section->addText('Produtos apreendidos no deposito','SimpleStyle');
               $section->addTextBreak(1);

             foreach ($produtoDeposito as $produtosDep) {
                
                //$section->addText('Veiculos envolvidos','SimpleStyle');
                //$section->addTextBreak(1);
                $section->addText('Produto   : '.$produtosDep->nome_produto, 'SimStyle');
                
                $section->addText('Marca : '.$produtosDep->nome_marca, 'SimStyle');
                
                $section->addText('Tabacalera : '.$produtosDep->nome_tabacalera, 'SimStyle');
                
                $section->addText('Marca - modelo :'.$produtosDep->qty." - ".$produtosDep->unidade_medida, 'SimStyle');
                $section->addTextBreak(1);

                }
            } //Fim do if de veiculos envolvidos.........................................
            else{
                $section->addText('Veiculos envolvidos : 0', 'SimStyle');
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
                $section->addText('Nome da imagem  : '.$img->title_image, 'SimStyle');
                //$section->addImage(FCPATH.'/imagens_doct/'.$img->nome_image_doct);
                //$section->addTextBreak(1);
        
                $section->addImage(FCPATH.'/imagens_doct/'.$img->nome_image_doct, array('width'=>210, 'height'=>210, 'align'=>'right'));
                $section->addTextBreak(1);
        
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