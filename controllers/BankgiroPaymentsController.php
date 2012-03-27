<?php
// TODO: extractOcrAction
// TODO: viewOcrAction
class Economy_BankgiroPaymentsController extends Zend_Controller_Action
{
	protected $_bankgiro;

	//Queries
	protected $_queries = array('extractFile' => 'bankgiroPaymentsFile',);
	public function ocrAction()
	{
		$this->_bankgiro = new Economy_Model_BankgiroPaymentsFiles();
		$this->view->file_form = $this->_bankgiro->getUploadForm();
		$this->_bankgiro->validateUploadForm();
		$this->view->bankgiroPaymentsFiles = $this->_bankgiro->fetchAll();
		$this->view->queries = $this->_queries;
	}

	public function extractFileAction()
	{
		$this->_bankgiro = new Economy_Model_BankgiroPaymentsFiles();
		$bankgiroPaymentFileRow = $this->_bankgiro->fetchRow('bankgiroFileId', $status = $this->getRequest()->getParam($this->_queries['extractFile']));
		$bankgiroFile = $this->_bankgiro->addFile($bankgiroPaymentFileRow);
		$bankgiroFile->parseFile();
		$this->view->test = $bankgiroFile->getTableRow();//
	}

	public function indexAction(  )
	{
		;
	}
}