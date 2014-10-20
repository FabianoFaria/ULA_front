<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once APPPATH."/third_party/PHPWord2.php"; 
 
class Word2 extends PhpWord { 
    public function __construct() { 
        parent::__construct(); 
    } 
}