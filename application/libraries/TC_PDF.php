<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '../../third_party/tcpdf/tcpdf.php';

class TC_PDF extends TCPDF
{
    
    public function __construct($orientation = 'P', $format = 'LETTER') {
        parent::__construct($orientation, 'mm', $format, true, 'UTF-8', false, false);
    }

    
} 
