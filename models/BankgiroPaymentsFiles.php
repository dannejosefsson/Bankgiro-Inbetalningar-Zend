<?php
/**
* Economy_Model_BankgiroPayments
*
* A class made for hold Bankgiro Inbetalningar structs.
*
* @author		Daniel Josefsson <dannejosefsson@gmail.com>
* @copyright	Copyright © 2012 Daniel Josefsson. All rights reserved.
* @license		GPL v3
* @version		v0.2
* @uses			Economy_Model_BankgiroPaymentsDeposit
*/
class Economy_Model_BankgiroPaymentsFiles
{
	/**
	* Instance of Economy_Model_DbTable_BankgiroPaymentsFiles
	* @var Economy_Model_DbTable_BankgiroPaymentsFiles $_bankgiroTable
	*/
	protected $_bankgiroTable;

	/**
	* Array containg Economy_Model_BankgiroPaymentFile
	* @var array of Economy_Model_BankgiroPaymentFile $_bankgiroFiles
	*/
	protected $_bankgiroFiles;

	/**
	* Array storing errors
	* @var array of strings
	*/
	protected $_errors;

	/**
	* Returns errors.
	* @author	Daniel Josefsson
	* @since	v0.1
	* @return	array of strings
	*/
	public function getErrors()
	{
		return $this->_errors;
	}

	/**
	 * Sets new error.
	 * @author	Daniel Josefsson
	 * @since	v0.1
	 * @param	string $errors
	 * @return	BankgiroPaymentsDeposit
	 */
	public function setError( $error )
	{
		$this->_errors[] = $error;
		return $this;
	}

	/**
	* Add a new file to the file list.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	Economy_Model_DbTable_BankgiroPaymentsFile $fileRow
	* @return	Economy_Model_BankgiroPaymentsFile
	 */
	public function addFile( Economy_Model_DbTable_BankgiroPaymentsFile $fileRow )
	{
		return $this->_bankgiroFiles[] = new Economy_Model_BankgiroPaymentsFile(array('fileRow' => $fileRow));
	}

	/**
	* Sets Economy_Model_DbTable_BankgiroPaymentsFiles table.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param Economy_Model_BankgiroPaymentsFiles $dbTable
	* @throws Exception
	* @return Economy_Model_BankgiroPayments
	*/
	public function setBankgiroPaymentsFilesTable($dbTable)
	{
	if (is_string($dbTable))
	{
		$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Economy_Model_DbTable_BankgiroPaymentsFiles)
		{
		throw new Exception('Invalid table data gateway provided');
			}
			$this->_bankgiroTable = $dbTable;
		return $this;
	}

	/**
	* Get BankgiroPaymentsFiles table.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	Economy_Model_DbTable_BankgiroPaymentsFiles
	*/
	public function getBankgiroPaymentsFilesTable()
	{
		if (null === $this->_bankgiroTable)
		{
			$this->setBankgiroPaymentsFilesTable('Economy_Model_DbTable_BankgiroPaymentsFiles');
		}
		return $this->_bankgiroTable;
	}

	/**
	* Add a Economy_Model_BankgiroPaymentsFile to Economy_Model_BankgiroPaymentsFiles table.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param	string $fileName
	* @return	Economy_Model_DbTable_BankgiroPaymentsFile
	*/
	public function addFileRow( $filename, $addedBy )
	{
		// Load table if not loaded.
    	$this->getBankgiroPaymentsFilesTable();
    	return $this->_bankgiroTable->createRow()	->setColumn('filename', $filename)
    												->setColumn('addedBy', $addedBy);
	}

	/**
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param	string $columnName
	* @param	string $value
	* @return	Economy_Model_DbTable_BankgiroPaymentsFile
	*/
	public function fetchRow ($columnName, $value)
	{
		$tempRow = $this->getBankgiroPaymentsFilesTable()->createRow();
		$select = $this->_bankgiroTable->select();
		$select->where($tempRow->getColumn($columnName).' = ?', $value);
		return $this->_bankgiroTable->fetchRow($select);
	}

	public function fetchAll() {
		$table = $this->getBankgiroPaymentsFilesTable();
		$select = $table->select();
		$select	->setIntegrityCheck(false)
		->from($table->info('name'))
		->join(	'users',$table->info('name').'.added_by = users.id',
		array('username' => 'users.username'	)	);
		return $this->_bankgiroTable->fetchAll($select);
	}

	public function getUploadForm()
	{
		// Create the upload-file-form
		$this->_fileForm = new Economy_Form_BankgrioPaymentsFileUpload();
		return $this->_fileForm;
	}

	public function validateUploadForm()
	{
		$theForm = $this->_fileForm;
		// Load form if not loaded.
		if (null == $theForm)
		{
			$theForm = $this->getUploadForm();
			$this->_ = $theForm;
		}

		if (	$theForm->getElement('the_file')->isUploaded() && $theForm->getElement('the_file')->isValid($theForm->getElement('the_file')->getFileInfo())	)
		{
			// Save file
			$theForm->getElement('the_file')->receive();

			// Change the name to the time extended name
			$fullFilename = $theForm->getElement('the_file')->getFileName();

			//Add the file to the database
			$auth= Zend_Auth::getInstance();
			$read = $auth->getStorage()->read();
			$this->addFileRow($fullFilename, $read['user_id'])->save();

			return 1;

		}
		else
		{
			return 0;
		}
	}

	/**
	* Returns object parameters as an associative array.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	array of strings
	*/
	public function toArray()
	{
		$array = array();

		foreach ($this->_bankgiroFiles as $bankgiroFile)
		{
			$array['bankgiroFile'][] = $bankgiroFile->toArray();
		}
		return $array;
	}
}
