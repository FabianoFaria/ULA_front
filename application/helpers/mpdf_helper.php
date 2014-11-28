<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function pdf($html, $filename=null)
{
    require_once("mpdf/mpdf.php");
 
    $mpdf = new mPDF();
 
    //$mpdf->allow_charset_conversion=true;
    //$mpdf->charset_in='iso-8859-1';
 
    //Exibir a pagina inteira no browser
    //$mpdf->SetDisplayMode('fullpage');
 
    //Cabeçalho: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
    //$mpdf->SetHeader('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Texto no cabeçalho');
 
    //Rodapé: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
    //$mpdf->SetFooter('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Texto no rodapé');
 
    $mpdf->WriteHTML($html);
 
    // define um nome para o arquivo PDF
    if($filename == null){
        $filename = date("Y-m-d_his").'_impressao.pdf';
    }

    $path   =   APPPATH.'relatorios/';

    var_dump($path);

    if(is_dir($path)){
        $mpdf->Output($path.$filename,'F');

        redirect('relatorio_gerado'.$filename); 

        //base_url("/assets/js/jquery-1.9.1.js");
    }else{
        echo 'error';
    }
 
   // $mpdf->Output($filename, 'F');

    //I: send the file inline to the browser. The plug-in is used if available. The name given by filename is used when one selects the "Save as" option on the link generating the PDF.
    //D: send to the browser and force a file download with the name given by filename.
    //F: save to a local file with the name given by filename (may include a path).
    //S: return the document as a string. filename is ignored.
}
 
/* End of file mpdf_pdf_pi.php */
/* Location: ./system/plugins/mpdf_pi.php */