<?php


//namespace PhpOffice\PhpWord;

	/**
 * Header file
 */
use PhpWord\Autoloader;
use \Settings;
use PhpWord\IOFactory;

error_reporting(E_ALL);
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');

require_once __DIR__ . '\PhpWord2\Autoloader.php';
require_once __DIR__ . '\PhpWord2\Settings.php';

require_once __DIR__ . '\PhpWord2\DocumentProperties.php';
require_once __DIR__ . '\PhpWord2\Settings.php';

Autoloader::register();
Settings::loadConfig();

//////////////******************************************/////////////////////////////

class DocumentProperties
{
    /** @const string Property type constants */
    const PROPERTY_TYPE_BOOLEAN = 'b';
    const PROPERTY_TYPE_INTEGER = 'i';
    const PROPERTY_TYPE_FLOAT = 'f';
    const PROPERTY_TYPE_DATE = 'd';
    const PROPERTY_TYPE_STRING = 's';
    const PROPERTY_TYPE_UNKNOWN = 'u';

    /**
     * Creator
     *
     * @var string
     */
    private $creator;

    /**
     * LastModifiedBy
     *
     * @var string
     */
    private $lastModifiedBy;

    /**
     * Created
     *
     * @var int
     */
    private $created;

    /**
     * Modified
     *
     * @var int
     */
    private $modified;

    /**
     * Title
     *
     * @var string
     */
    private $title;

    /**
     * Description
     *
     * @var string
     */
    private $description;

    /**
     * Subject
     *
     * @var string
     */
    private $subject;

    /**
     * Keywords
     *
     * @var string
     */
    private $keywords;

    /**
     * Category
     *
     * @var string
     */
    private $category;

    /**
     * Company
     *
     * @var string
     */
    private $company;

    /**
     * Manager
     *
     * @var string
     */
    private $manager;

    /**
     * Custom Properties
     *
     * @var array
     */
    private $customProperties = array();

    /**
     * Create new DocumentProperties
     */
    public function __construct()
    {
        $this->creator        = '';
        $this->lastModifiedBy = $this->creator;
        $this->created        = time();
        $this->modified       = time();
        $this->title          = '';
        $this->subject        = '';
        $this->description    = '';
        $this->keywords       = '';
        $this->category       = '';
        $this->company        = '';
        $this->manager        = '';
    }

    /**
     * Get Creator
     *
     * @return string
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set Creator
     *
     * @param  string $value
     * @return self
     */
    public function setCreator($value = '')
    {
        $this->creator = $this->setValue($value, '');

        return $this;
    }

    /**
     * Get Last Modified By
     *
     * @return string
     */
    public function getLastModifiedBy()
    {
        return $this->lastModifiedBy;
    }

    /**
     * Set Last Modified By
     *
     * @param  string $value
     * @return self
     */
    public function setLastModifiedBy($value = '')
    {
        $this->lastModifiedBy = $this->setValue($value, $this->creator);

        return $this;
    }

    /**
     * Get Created
     *
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set Created
     *
     * @param  int $value
     * @return self
     */
    public function setCreated($value = null)
    {
        $this->created = $this->setValue($value, time());

        return $this;
    }

    /**
     * Get Modified
     *
     * @return int
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set Modified
     *
     * @param  int $value
     * @return self
     */
    public function setModified($value = null)
    {
        $this->modified = $this->setValue($value, time());

        return $this;
    }

    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set Title
     *
     * @param  string $value
     * @return self
     */
    public function setTitle($value = '')
    {
        $this->title = $this->setValue($value, '');

        return $this;
    }

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set Description
     *
     * @param  string $value
     * @return self
     */
    public function setDescription($value = '')
    {
        $this->description = $this->setValue($value, '');

        return $this;
    }

    /**
     * Get Subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set Subject
     *
     * @param  string $value
     * @return self
     */
    public function setSubject($value = '')
    {
        $this->subject = $this->setValue($value, '');

        return $this;
    }

    /**
     * Get Keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set Keywords
     *
     * @param string $value
     * @return self
     */
    public function setKeywords($value = '')
    {
        $this->keywords = $this->setValue($value, '');

        return $this;
    }

    /**
     * Get Category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set Category
     *
     * @param string $value
     * @return self
     */
    public function setCategory($value = '')
    {
        $this->category = $this->setValue($value, '');

        return $this;
    }

    /**
     * Get Company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set Company
     *
     * @param string $value
     * @return self
     */
    public function setCompany($value = '')
    {
        $this->company = $this->setValue($value, '');

        return $this;
    }

    /**
     * Get Manager
     *
     * @return string
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set Manager
     *
     * @param string $value
     * @return self
     */
    public function setManager($value = '')
    {
        $this->manager = $this->setValue($value, '');

        return $this;
    }

    /**
     * Get a List of Custom Property Names
     *
     * @return array of string
     */
    public function getCustomProperties()
    {
        return array_keys($this->customProperties);
    }

    /**
     * Check if a Custom Property is defined
     *
     * @param string $propertyName
     * @return boolean
     */
    public function isCustomPropertySet($propertyName)
    {
        return isset($this->customProperties[$propertyName]);
    }

    /**
     * Get a Custom Property Value
     *
     * @param string $propertyName
     * @return string
     */
    public function getCustomPropertyValue($propertyName)
    {
        if ($this->isCustomPropertySet($propertyName)) {
            return $this->customProperties[$propertyName]['value'];
        } else {
            return null;
        }
    }

    /**
     * Get a Custom Property Type
     *
     * @param string $propertyName
     * @return string
     */
    public function getCustomPropertyType($propertyName)
    {
        if ($this->isCustomPropertySet($propertyName)) {
            return $this->customProperties[$propertyName]['type'];
        } else {
            return null;
        }
    }

    /**
     * Set a Custom Property
     *
     * @param string $propertyName
     * @param mixed $propertyValue
     * @param string $propertyType
     *   'i': Integer
     *   'f': Floating Point
     *   's': String
     *   'd': Date/Time
     *   'b': Boolean
     * @return self
     */
    public function setCustomProperty($propertyName, $propertyValue = '', $propertyType = null)
    {
        $propertyTypes = array(
            self::PROPERTY_TYPE_INTEGER,
            self::PROPERTY_TYPE_FLOAT,
            self::PROPERTY_TYPE_STRING,
            self::PROPERTY_TYPE_DATE,
            self::PROPERTY_TYPE_BOOLEAN
        );
        if (($propertyType === null) || (!in_array($propertyType, $propertyTypes))) {
            if ($propertyValue === null) {
                $propertyType = self::PROPERTY_TYPE_STRING;
            } elseif (is_float($propertyValue)) {
                $propertyType = self::PROPERTY_TYPE_FLOAT;
            } elseif (is_int($propertyValue)) {
                $propertyType = self::PROPERTY_TYPE_INTEGER;
            } elseif (is_bool($propertyValue)) {
                $propertyType = self::PROPERTY_TYPE_BOOLEAN;
            } else {
                $propertyType = self::PROPERTY_TYPE_STRING;
            }
        }

        $this->customProperties[$propertyName] = array(
            'value' => $propertyValue,
            'type' => $propertyType
        );
        return $this;
    }

    /**
     * Convert document property based on type
     *
     * @param string $propertyValue
     * @param string $propertyType
     * @return mixed
     */
    public static function convertProperty($propertyValue, $propertyType)
    {
        $conversion = self::getConversion($propertyType);

        switch ($conversion) {
            case 'empty': // Empty
                return '';
            case 'null': // Null
                return null;
            case 'int': // Signed integer
                return (int) $propertyValue;
            case 'uint': // Unsigned integer
                return abs((int) $propertyValue);
            case 'float': // Float
                return (float) $propertyValue;
            case 'date': // Date
                return strtotime($propertyValue);
            case 'bool': // Boolean
                return ($propertyValue == 'true') ? true : false;
        }

        return $propertyValue;
    }

    /**
     * Convert document property type
     *
     * @param string $propertyType
     * @return string
     */
    public static function convertPropertyType($propertyType)
    {
        $typeGroups = array(
            self::PROPERTY_TYPE_INTEGER => array('i1', 'i2', 'i4', 'i8', 'int', 'ui1', 'ui2', 'ui4', 'ui8', 'uint'),
            self::PROPERTY_TYPE_FLOAT   => array('r4', 'r8', 'decimal'),
            self::PROPERTY_TYPE_STRING  => array('empty', 'null', 'lpstr', 'lpwstr', 'bstr'),
            self::PROPERTY_TYPE_DATE    => array('date', 'filetime'),
            self::PROPERTY_TYPE_BOOLEAN => array('bool'),
        );
        foreach ($typeGroups as $groupId => $groupMembers) {
            if (in_array($propertyType, $groupMembers)) {
                return $groupId;
            }
        }

        return self::PROPERTY_TYPE_UNKNOWN;
    }

    /**
     * Set default for null and empty value
     *
     * @param mixed $value
     * @param mixed $default
     * @return mixed
     */
    private function setValue($value, $default)
    {
        if ($value === null || $value == '') {
            $value = $default;
        }

        return $value;
    }

    /**
     * Get conversion model depending on property type
     *
     * @param string $propertyType
     * @return string
     */
    private static function getConversion($propertyType)
    {
        $conversions = array(
            'empty' => array('empty'),
            'null'  => array('null'),
            'int'   => array('i1', 'i2', 'i4', 'i8', 'int'),
            'uint'  => array('ui1', 'ui2', 'ui4', 'ui8', 'uint'),
            'float' => array('r4', 'r8', 'decimal'),
            'bool'  => array('bool'),
            'date'  => array('date', 'filetime'),
        );
        foreach ($conversions as $conversion => $types) {
            if (in_array($propertyType, $types)) {
                return $conversion;
            }
        }

        return 'string';
    }
}

use PhpOffice\PhpWord\Collection\Endnotes;
use PhpOffice\PhpWord\Collection\Footnotes;
use PhpOffice\PhpWord\Collection\Titles;
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Exception\Exception;

/**
 * PHPWord main class
 */
class PhpWord
{
    /**
     * Default font settings
     *
     * @const string|int
     * @deprecated 0.11.0 Use Settings constants
     */
    const DEFAULT_FONT_NAME = Settings::DEFAULT_FONT_NAME;
    const DEFAULT_FONT_SIZE = Settings::DEFAULT_FONT_SIZE;
    const DEFAULT_FONT_COLOR = Settings::DEFAULT_FONT_COLOR;
    const DEFAULT_FONT_CONTENT_TYPE = Settings::DEFAULT_FONT_CONTENT_TYPE;

    /**
     * Document properties object
     *
     * @var DocumentProperties
     */
    private $documentProperties;

    /**
     * Collection of sections
     *
     * @var \PhpOffice\PhpWord\Element\Section[]
     */
    private $sections = array();

    /**
     * Collection of titles
     *
     * @var \PhpOffice\PhpWord\Collection\Titles
     */
    private $titles;

    /**
     * Collection of footnotes
     *
     * @var \PhpOffice\PhpWord\Collection\Footnotes
     */
    private $footnotes;

    /**
     * Collection of endnotes
     *
     * @var \PhpOffice\PhpWord\Collection\Endnotes
     */
    private $endnotes;

    /**
     * Create new
     */
    public function __construct()
    {
        $this->documentProperties = new DocumentProperties();
        $this->titles = new Titles();
        $this->footnotes = new Footnotes();
        $this->endnotes = new Endnotes();
    }

    /**
     * Get document properties object
     *
     * @return DocumentProperties
     */
    public function getDocumentProperties()
    {
        return $this->documentProperties;
    }

    /**
     * Set document properties object
     *
     * @param DocumentProperties $documentProperties
     * @return self
     */
    public function setDocumentProperties(DocumentProperties $documentProperties)
    {
        $this->documentProperties = $documentProperties;

        return $this;
    }

    /**
     * Get all sections
     *
     * @return \PhpOffice\PhpWord\Element\Section[]
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Create new section
     *
     * @param array $settings
     * @return \PhpOffice\PhpWord\Element\Section
     */
    public function addSection($settings = null)
    {
        $section = new Section(count($this->sections) + 1, $settings);
        $section->setPhpWord($this);
        $this->sections[] = $section;

        return $section;
    }

    /**
     * Get titles
     *
     * @return \PhpOffice\PhpWord\Collection\Titles
     */
    public function getTitles()
    {
        return $this->titles;
    }

    /**
     * Add new title
     *
     * @param \PhpOffice\PhpWord\Element\Title $title
     * @return int
     */
    public function addTitle($title)
    {
        return $this->titles->addItem($title);
    }

    /**
     * Get footnotes
     *
     * @return \PhpOffice\PhpWord\Collection\Footnotes
     */
    public function getFootnotes()
    {
        return $this->footnotes;
    }

    /**
     * Add new footnote
     *
     * @param \PhpOffice\PhpWord\Element\Footnote $footnote
     * @return int
     */
    public function addFootnote($footnote)
    {
        return $this->footnotes->addItem($footnote);
    }

    /**
     * Get endnotes
     *
     * @return \PhpOffice\PhpWord\Collection\Endnotes
     */
    public function getEndnotes()
    {
        return $this->endnotes;
    }

    /**
     * Add new endnote
     *
     * @param \PhpOffice\PhpWord\Element\Endnote $endnote
     * @return int
     */
    public function addEndnote($endnote)
    {
        return $this->endnotes->addItem($endnote);
    }

    /**
     * Get default font name
     *
     * @return string
     */
    public function getDefaultFontName()
    {
        return Settings::getDefaultFontName();
    }

    /**
     * Set default font name
     *
     * @param string $fontName
     */
    public function setDefaultFontName($fontName)
    {
        Settings::setDefaultFontName($fontName);
    }

    /**
     * Get default font size
     *
     * @return integer
     */
    public function getDefaultFontSize()
    {
        return Settings::getDefaultFontSize();
    }

    /**
     * Set default font size
     *
     * @param int $fontSize
     */
    public function setDefaultFontSize($fontSize)
    {
        Settings::setDefaultFontSize($fontSize);
    }

    /**
     * Set default paragraph style definition to styles.xml
     *
     * @param array $styles Paragraph style definition
     * @return \PhpOffice\PhpWord\Style\Paragraph
     */
    public function setDefaultParagraphStyle($styles)
    {
        return Style::setDefaultParagraphStyle($styles);
    }

    /**
     * Adds a paragraph style definition to styles.xml
     *
     * @param string $styleName
     * @param array $styles
     * @return \PhpOffice\PhpWord\Style\Paragraph
     */
    public function addParagraphStyle($styleName, $styles)
    {
        return Style::addParagraphStyle($styleName, $styles);
    }

    /**
     * Adds a font style definition to styles.xml
     *
     * @param string $styleName
     * @param mixed $fontStyle
     * @param mixed $paragraphStyle
     * @return \PhpOffice\PhpWord\Style\Font
     */
    public function addFontStyle($styleName, $fontStyle, $paragraphStyle = null)
    {
        return Style::addFontStyle($styleName, $fontStyle, $paragraphStyle);
    }

    /**
     * Adds a table style definition to styles.xml
     *
     * @param string $styleName
     * @param mixed $styleTable
     * @param mixed $styleFirstRow
     * @return \PhpOffice\PhpWord\Style\Table
     */
    public function addTableStyle($styleName, $styleTable, $styleFirstRow = null)
    {
        return Style::addTableStyle($styleName, $styleTable, $styleFirstRow);
    }

    /**
     * Adds a numbering style
     *
     * @param string $styleName
     * @param mixed $styles
     * @return \PhpOffice\PhpWord\Style\Numbering
     */
    public function addNumberingStyle($styleName, $styles)
    {
        return Style::addNumberingStyle($styleName, $styles);
    }

    /**
     * Adds a hyperlink style to styles.xml
     *
     * @param string $styleName
     * @param mixed $styles
     * @return \PhpOffice\PhpWord\Style\Font
     */
    public function addLinkStyle($styleName, $styles)
    {
        return Style::addLinkStyle($styleName, $styles);
    }

    /**
     * Adds a heading style definition to styles.xml
     *
     * @param int $depth
     * @param mixed $fontStyle
     * @param mixed $paragraphStyle
     * @return \PhpOffice\PhpWord\Style\Font
     */
    public function addTitleStyle($depth, $fontStyle, $paragraphStyle = null)
    {
        return Style::addTitleStyle($depth, $fontStyle, $paragraphStyle);
    }

    /**
     * Load template by filename
     *
     * @param  string $filename Fully qualified filename.
     * @return Template
     * @throws \PhpOffice\PhpWord\Exception\Exception
     */
    public function loadTemplate($filename)
    {
        if (file_exists($filename)) {
            return new Template($filename);
        } else {
            throw new Exception("Template file {$filename} not found.");
        }
    }

    /**
     * Create new section
     *
     * @param array $settings
     * @return \PhpOffice\PhpWord\Element\Section
     * @deprecated 0.10.0
     * @codeCoverageIgnore
     */
    public function createSection($settings = null)
    {
        return $this->addSection($settings);
    }
}


class Settings
{
    /**
     * Zip libraries
     *
     * @const string
     */
    const ZIPARCHIVE = 'ZipArchive';
    const PCLZIP     = 'PclZip';
    const OLD_LIB    = 'PhpOffice\\PhpWord\\Shared\\ZipArchive'; // @deprecated 0.11

    /**
     * PDF rendering libraries
     *
     * @const string
     */
    const PDF_RENDERER_DOMPDF = 'DomPDF';
    const PDF_RENDERER_TCPDF  = 'TCPDF';
    const PDF_RENDERER_MPDF   = 'MPDF';

    /**
     * Measurement units multiplication factor
     *
     * Applied to:
     * - Section: margins, header/footer height, gutter, column spacing
     * - Tab: position
     * - Indentation: left, right, firstLine, hanging
     * - Spacing: before, after
     *
     * @const string
     */
    const UNIT_TWIP  = 'twip'; // = 1/20 point
    const UNIT_CM    = 'cm';
    const UNIT_MM    = 'mm';
    const UNIT_INCH  = 'inch';
    const UNIT_POINT = 'point'; // = 1/72 inch
    const UNIT_PICA  = 'pica'; // = 1/6 inch = 12 points

    /**
     * Default font settings
     *
     * OOXML defined font size values in halfpoints, i.e. twice of what PhpWord
     * use, and the conversion will be conducted during XML writing.
     */
    const DEFAULT_FONT_NAME = 'Arial';
    const DEFAULT_FONT_SIZE = 10;
    const DEFAULT_FONT_COLOR = '000000';
    const DEFAULT_FONT_CONTENT_TYPE = 'default'; // default|eastAsia|cs

    /**
     * Compatibility option for XMLWriter
     *
     * @var bool
     */
    private static $xmlWriterCompatibility = true;

    /**
     * Name of the class used for Zip file management
     *
     * @var string
     */
    private static $zipClass = self::ZIPARCHIVE;

    /**
     * Name of the external Library used for rendering PDF files
     *
     * @var string
     */
    private static $pdfRendererName = null;

    /**
     * Directory Path to the external Library used for rendering PDF files
     *
     * @var string
     */
    private static $pdfRendererPath = null;

    /**
     * Measurement unit
     *
     * @var int|float
     */
    private static $measurementUnit = self::UNIT_TWIP;

    /**
     * Default font name
     *
     * @var string
     */
    private static $defaultFontName = self::DEFAULT_FONT_NAME;

    /**
     * Default font size
     * @var int
     */
    private static $defaultFontSize = self::DEFAULT_FONT_SIZE;

    /**
     * Return the compatibility option used by the XMLWriter
     *
     * @return bool Compatibility
     */
    public static function hasCompatibility()
    {
        return self::$xmlWriterCompatibility;
    }

    /**
     * Set the compatibility option used by the XMLWriter
     *
     * This sets the setIndent and setIndentString for better compatibility
     *
     * @param bool $compatibility
     * @return bool
     */
    public static function setCompatibility($compatibility)
    {
        $compatibility = (bool)$compatibility;
        self::$xmlWriterCompatibility = $compatibility;

        return true;
    }

    /**
     * Get zip handler class
     *
     * @return string
     */
    public static function getZipClass()
    {
        return self::$zipClass;
    }

    /**
     * Set zip handler class
     *
     * @param  string $zipClass
     * @return bool
     */
    public static function setZipClass($zipClass)
    {
        if (in_array($zipClass, array(self::PCLZIP, self::ZIPARCHIVE, self::OLD_LIB))) {
            self::$zipClass = $zipClass;
            return true;
        }

        return false;
    }

    /**
     * Set details of the external library for rendering PDF files
     *
     * @param string $libraryName
     * @param string $libraryBaseDir
     * @return bool Success or failure
     */
    public static function setPdfRenderer($libraryName, $libraryBaseDir)
    {
        if (!self::setPdfRendererName($libraryName)) {
            return false;
        }

        return self::setPdfRendererPath($libraryBaseDir);
    }

    /**
     * Return the PDF Rendering Library
     */
    public static function getPdfRendererName()
    {
        return self::$pdfRendererName;
    }

    /**
     * Identify the external library to use for rendering PDF files
     *
     * @param string $libraryName
     * @return bool
     */
    public static function setPdfRendererName($libraryName)
    {
        $pdfRenderers = array(self::PDF_RENDERER_DOMPDF, self::PDF_RENDERER_TCPDF, self::PDF_RENDERER_MPDF);
        if (!in_array($libraryName, $pdfRenderers)) {
            return false;
        }
        self::$pdfRendererName = $libraryName;

        return true;
    }


    /**
     * Return the directory path to the PDF Rendering Library
     */
    public static function getPdfRendererPath()
    {
        return self::$pdfRendererPath;
    }

    /**
     * Location of external library to use for rendering PDF files
     *
     * @param string $libraryBaseDir Directory path to the library's base folder
     * @return bool Success or failure
     */
    public static function setPdfRendererPath($libraryBaseDir)
    {
        if ((file_exists($libraryBaseDir) === false) || (is_readable($libraryBaseDir) === false)) {
            return false;
        }
        self::$pdfRendererPath = $libraryBaseDir;

        return true;
    }

    /**
     * Get measurement unit
     *
     * @return string
     */
    public static function getMeasurementUnit()
    {
        return self::$measurementUnit;
    }

    /**
     * Set measurement unit
     *
     * @param string $value
     * @return bool
     */
    public static function setMeasurementUnit($value)
    {
        $units = array(self::UNIT_TWIP, self::UNIT_CM, self::UNIT_MM, self::UNIT_INCH,
            self::UNIT_POINT, self::UNIT_PICA);
        if (!in_array($value, $units)) {
            return false;
        }
        self::$measurementUnit = $value;

        return true;
    }

    /**
     * Get default font name
     *
     * @return string
     */
    public static function getDefaultFontName()
    {
        return self::$defaultFontName;
    }

    /**
     * Set default font name
     *
     * @param string $value
     * @return bool
     */
    public static function setDefaultFontName($value)
    {
        if (is_string($value) && trim($value) !== '') {
            self::$defaultFontName = $value;
            return true;
        }

        return false;
    }

    /**
     * Get default font size
     *
     * @return integer
     */
    public static function getDefaultFontSize()
    {
        return self::$defaultFontSize;
    }

    /**
     * Set default font size
     *
     * @param int $value
     * @return bool
     */
    public static function setDefaultFontSize($value)
    {
        $value = intval($value);
        if ($value > 0) {
            self::$defaultFontSize = $value;
            return true;
        }

        return false;
    }

    /**
     * Load setting from phpword.yml or phpword.yml.dist
     *
     * @param string $filename
     * @return array
     */
    public static function loadConfig($filename = null)
    {
        // Get config file
        $configFile = null;
        $configPath = __DIR__ . '/../../';
        if ($filename !== null) {
            $files = array($filename);
        } else {
            $files = array("{$configPath}phpword.ini", "{$configPath}phpword.ini.dist");
        }
        foreach ($files as $file) {
            if (file_exists($file)) {
                $configFile = realpath($file);
                break;
            }
        }

        // Parse config file
        $config = array();
        if ($configFile !== null) {
            $config = @parse_ini_file($configFile);
            if ($config === false) {
                return $config;
            }
        }

        // Set config value
        foreach ($config as $key => $value) {
            $method = "set{$key}";
            if (method_exists(__CLASS__, $method)) {
                self::$method($value);
            }
        }

        return $config;
    }

    /**
     * Return the compatibility option used by the XMLWriter
     *
     * @deprecated 0.10.0
     * @codeCoverageIgnore
     */
    public static function getCompatibility()
    {
        return self::hasCompatibility();
    }
}



/*////////////////////////////////////////////****************///////////////////////



?>