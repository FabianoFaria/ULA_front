<?php 

//namespace PhpOffice\PhpWord;


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
 * Header file
 */
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;
 
require_once APPPATH."/third_party/PHPWord2/PhpWord.php";
require_once APPPATH."/third_party/PHPWord2/Settings.php";
require_once APPPATH."/third_party/PHPWord2/Style.php";
require_once APPPATH."/third_party/PHPWord2/DocumentProperties.php"; 

require_once APPPATH."/third_party/PHPWord2/Collection/AbstractCollection.php";
require_once APPPATH."/third_party/PHPWord2/Collection/Endnotes.php"; 
require_once APPPATH."/third_party/PHPWord2/Collection/Footnotes.php";
require_once APPPATH."/third_party/PHPWord2/Collection/Titles.php";

require_once APPPATH."/third_party/PHPWord2/Element/AbstractElement.php";
require_once APPPATH."/third_party/PHPWord2/Element/AbstractContainer.php";
require_once APPPATH."/third_party/PHPWord2/Element/Section.php";
require_once APPPATH."/third_party/PHPWord2/Element/Title.php";

require_once APPPATH."/third_party/PHPWord2/Shared/String.php";


require_once APPPATH."/third_party/PHPWord2/Style/AbstractStyle.php";
require_once APPPATH."/third_party/PHPWord2/Style/Alignment.php";
require_once APPPATH."/third_party/PHPWord2/Style/Border.php";
require_once APPPATH."/third_party/PHPWord2/Style/Paragraph.php";
require_once APPPATH."/third_party/PHPWord2/Style/Font.php";
require_once APPPATH."/third_party/PHPWord2/Style/Section.php";
require_once APPPATH."/third_party/PHPWord2/Style/Spacing.php";
 
class Word2 extends PhpWord { 
    public function __construct() { 
        parent::__construct(); 
    } 
}