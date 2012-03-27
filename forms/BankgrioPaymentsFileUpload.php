<?php

class Economy_Form_BankgrioPaymentsFileUpload extends Zend_Form
{

    public function init()
    {
    	$method = 'post';
    	$this	->setMethod($method)
    			->setAttrib('enctype', 'multipart/form-data')
    			->setAttrib('filter', array('StripTags', 'StringTrim'));

    	$uploadField = $this->addElement('file', 'the_file')->getElement('the_file');
    	$uploadField->setDestination(APPLICATION_PATH.'/../upload/ocr')
    				->addValidator('Count', false, 1)
    	// Not sure if 100k is enough. Should be though.
    				->addValidator('Size', false, 102400)
			    	->addValidator('MimeType', false, array('text/plain'))
			    	//->addValidator('Extension', false, ',txt')
    				->removeDecorator('DtDdWrapper');
    	$this->addElement('submit', 'add_ocr_file', array(	'label' => 'Ladda upp Bankgiro Inbetalningar fil', 'class' => 'main-button'	));
    }
}