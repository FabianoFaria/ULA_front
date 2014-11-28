<?php 
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//require_once APPPATH."/third_party/PHPWord.php"; 
 
//class Word2 extends PhpWord { 
  //  public function __construct() { 
    //    parent::__construct(); 
    //} 
//}

class Word {
    public function __construct( $html, $nome = 'file.doc', $destino = null ) {
        if (!$destino):
             header('Content-type: application/vnd.ms-word');
             header('Content-type: application/force-download');
             header('Content-Disposition: attachment; filename="' . $nome . '"');
             header('Pragma: no-cache');
             echo $html;                  
         else:         
             file_put_contents($destino.'/'.$nome, $html);             
         endif;
    }
}