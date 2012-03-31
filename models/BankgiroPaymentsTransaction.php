<?php
/**
* Economy_Model_BankgiroPaymentsTransaction
*
* A class made to contain a payment post parsed from Bankgiro Inbetalningar files.
*
* @copyright	Copyright © 2012 Daniel Josefsson. All rights reserved.
* @license		GPL v3
* @author		Daniel Josefsson <dannejosefsson@gmail.com>
* @version		v0.1
*/
class Economy_Model_BankgiroPaymentsTransaction
{
	protected	$_transactionTableRow;

	/**
	* Information
	* Stores data from information post type (25).
	* Up to 99 information posts can be transmitted.
	* Max length of string: 50
	* @var Economy_Model_DbTable_BankgiroPaymentsTransactionInformations
	*/
	protected	$_informationTable;
	protected	$_informationRows;

	/**
	* Array with extra references
	* @var array of BankgiroPaymentTransaction
	 */
	protected	$_extraReferences;
	protected	$_extraReferencesTable;

	/**
	*
	* @since	v0.2
	*/
	public function __construct( $options = null )
	{
		if ( is_array($options) )
		{
			if (array_key_exists('transactionRow', $options))
			{
				$this->setTableRow($options['transactionRow']);
			}
		}
		elseif ( is_string( $options ) )
		{

		}
		elseif (is_bool($options))
		{
		}
		else
		{
			$this->setTableRow(new Economy_Model_DbTable_BankgiroPaymentsTransaction());
		}
		$this->getBankgiroPaymentsTransactionInformationsTable();
		$this->_extraReferences = array();
		$this->_informationRows = array();
	}

	/**
	* Sets table row
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param	string $tableRow
	* @return	Economy_Model_BankgiroPaymentsDeposit
	*/
	public function setTableRow( $tableRow )
	{
		$this->_transactionTableRow = $tableRow;
		return $this;
	}

	/**
	 * Returns table row
	 * @author	Daniel Josefsson <dannejosefsson@gmail.com>
	 * @since	v0.2
	 * @return	Economy_Model_DbTable_BankgiroPaymentsDeposit
	 */
	public function getTableRow()
	{
		return $this->_transactionTableRow;
	}

	/**
	* Sets Economy_Model_DbTable_BankgiroPaymentsTransactionInformations table.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	Economy_Model_DbTable_BankgiroPaymentsTransactionInformations $dbTable
	* @throws 	Exception
	* @return 	Economy_Model_BankgiroPaymentsTransaction
	*/
	public function setBankgiroPaymentsTransactionInformationsTable($dbTable)
	{
		if (is_string($dbTable))
		{
		$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Economy_Model_DbTable_BankgiroPaymentsTransactionInformations)
		{
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_informationTable = $dbTable;
		return $this;
	}

	/**
	* Get BankgiroPaymentsTransactionInformation table.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	Economy_Model_DbTable_BankgiroPaymentsTransactionInformations
	*/
	public function getBankgiroPaymentsTransactionInformationsTable()
	{
		if (null === $this->_informationTable)
		{
			$this->setBankgiroPaymentsTransactionInformationsTable('Economy_Model_DbTable_BankgiroPaymentsTransactionInformations');
		}
		return $this->_informationTable;
	}

	/**
	* Sets extra references (Economy_Model_DbTable_BankgiroPaymentsTransactions) table.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param	Economy_Model_DbTable_BankgiroPaymentsTransactions $dbTable
	* @throws 	Exception
	* @return 	Economy_Model_BankgiroPaymentsTransaction
	*/
	public function setBankgiroPaymentsExtraReferencesTable($dbTable)
	{
		if (is_string($dbTable))
		{
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Economy_Model_DbTable_BankgiroPaymentsTransactions)
		{
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_extraReferencesTable = $dbTable;
		return $this;
	}

	/**
	* Get extra references table.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	Economy_Model_DbTable_BankgiroPaymentsTransactions
	*/
	public function getBankgiroPaymentsExtraReferencesTable()
	{
		if (null === $this->_extraReferencesTable)
		{
			$this->setBankgiroPaymentsExtraReferencesTable('Economy_Model_DbTable_BankgiroPaymentsTransactions');
		}
		return $this->_extraReferencesTable;
	}

	/**
	* Sets new information.
	* @author	Daniel Josefsson
	* @since	v0.1
	* @param	int $information
	* @return	BankgiroPaymentsTransaction
	*/
	public function setInformation( $information )
	{
		$this->_informationRows[] = $this->_informationTable->createRow();
		$this->_informationRows[sizeof($this->_informationRows) - 1]
					->setColumn('informationRow', sizeof($this->_informationRows))
					->setColumn('information', $information);
		return $this;
	}

	/**
	* Returns extra references.
	* @author	Daniel Josefsson
	* @since	v0.2
	* @return	array of BankgiroPaymentsTransaction
	*/
	public function getExtraReferences()
	{
		return $this->_extraReferences;
	}

	/**
	* Sets new extra reference.
	* @author	Daniel Josefsson
	* @since	v0.2
	* @param	BankgiroPaymentsTransaction $extraReference
	* @return	BankgiroPaymentsTransaction $this
	*/
	public function setExtraReference( BankgiroPaymentsTransaction $extraReference )
	{
		$this->_extraReferences[] = $extraReference;
		return $this;
	}

	/**
	* Return index to the latest inserted extra reference.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	int $keyToExtraReference
	*/
	public function lastExtraReferenceIndex()
	{
		end($this->_extraReferences);
		return key($this->_extraReferences);
	}

	/**
	* Returns wanted extra reference
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	int $index
	* @return	BankgiroPaymentsTransaction $extraReference
	*/
	public function getExtraReference( $index )
	{
		return $this->_extraReferences[$index];
	}

	/**
	* Add new extra reference.
	* Increments reference count.
	* @author	Daniel Josefsson
	* @since	v0.2
	* @param	string 						$postType
	* @return	BankgiroPaymentsTransaction $this
	*/
	public function addExtraReference($postType)
	{
		$this->getBankgiroPaymentsExtraReferencesTable();
		$this->_extraReferences[] = new Economy_Model_BankgiroPaymentsTransaction(array('transactionRow' => $this->_extraReferencesTable->createRow()));

		return $this;
	}

	/**
	* Return the extra references count.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	int
	*/
	public function getExtraReferencesCount()
	{
		return sizeof($this->_extraReferences);
	}

	/**
	* Returns transaction amount.
	* @author	Daniel Josefsson
	* @since	v0.2
	* @return	int
	*/
	public function getAmount()
	{
		return $this->getTableRow()->getColumn('amount');
	}

	/**
	* Parses line,given with the syntax of posts 20 to 29 in Bankgiro Inbetalningar.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param	string $line
	* @return	boolean
	*/
	public function parsePost( $line )
	{
		$return = false;
		$postType = substr($line, 0, 2);
		$postData = substr($line, 2);
		switch ($postType)
		{
			case '20':
				$return = $this->parsePaymentPost($line);
				break;
			case '21':
				$return = $this->parseDeductionPost($line);
				break;
			case '22':
			case '23':
				$extraReferenceIndex = $this->addExtraReference($postType)->lastExtraReferenceIndex();
				$return = $this->getExtraReference($extraReferenceIndex)->parsePaymentPost($line);
				break;
			case '25':
				$return = $this->parseInformationPost($postData);
				break;
			case '26':
				$return = $this->parseNamePost($postData);
				break;
			case '27':
				$return = $this->parseAddress1Post($postData);
				break;
			case '28':
				$return = $this->parseAddress2Post($postData);
				break;
			case '29':
				$return = $this->parseOrganisationNumberPost($postData);
			default:
				break;
		}
		return $return;
	}

	/**
	* Parses payment post (20).
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	string	$post
	* @return	bool
	*/
	private function parsePaymentPost( $post )
	{
		$this->getTableRow()->setColumn('transactionCode', substr($post, 0, 2));
		$this->getTableRow()->setColumn('senderBankgiroAccountNumber', (int) substr($post, 2, 10));
		$this->getTableRow()->setColumn('referenceCode', (int) substr($post, 55, 1));
		$this->getTableRow()->setColumn('reference', trim(substr($post, 12, 25), ' '));
		$this->getTableRow()->setColumn('amount', (int) substr($post, 37, 18));
		$this->getTableRow()->setColumn('channelCode', (int) substr($post, 56, 1));
		$this->getTableRow()->setColumn('serialNumber', substr($post, 57, 12));
		$this->getTableRow()->setColumn('imageMarker', (int) substr($post, 69, 1));
		// Reserved placeholders (post[70-79]) are not used.
		return true;
	}

	/**
	* Parses deduction post (21).
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	string				$post
	* @return	bool
	*/
	private function parseDeductionPost( $post )
	{
		$this->parsePaymentPost($post);
		$this->getTableRow()->setColumn('deductionCode', (int) substr($post, 70, 1));
		// Reserved placeholders (post[70-79]) are not used.
		return true;
	}

	/**
	* Parses information post (25).
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	string	$postData
	* @return	bool
	*/
	private function parseInformationPost( $postData )
	{
		$this->setInformation(trim(substr($postData, 0, 50), ' '));
		// Reserved placeholders (postData[50-77]) are not used.
		return true;
	}

	/**
	* Parses name post (26).
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	string	$postData
	* @return	bool
	*/
	private function parseNamePost( $postData )
	{
		$this->getTableRow()->setColumn('name1', trim(substr($postData, 0, 35), ' '));
		$this->getTableRow()->setColumn('name2', trim(substr($postData, 35, 35), ' '));
		// Reserved placeholders (postData[70-77]) are not used.
		return true;
	}

	/**
	* Parses first address post (27).
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	string	$postData
	* @return	bool
	*/
	private function parseAddress1Post( $postData )
	{
		$this->getTableRow()->setColumn('address', trim(substr($postData, 0, 35), ' '));
		$this->getTableRow()->setColumn('postalNumber', trim(substr($postData, 35, 9), ' '));
		// Reserved placeholders (postData[44-77]) are not used.
		return true;
	}

	/**
	* Parses second address post (28).
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	string	$postData
	* @return	bool
	*/
	private function parseAddress2Post( $postData )
	{
		$this->getTableRow()->setColumn('city', trim(substr($postData, 0, 35), ' '));
		$this->getTableRow()->setColumn('country', trim(substr($postData, 35, 35), ' '));
		$this->getTableRow()->setColumn('countryCode', trim(substr($postData, 70, 2), ' '));
		// Reserved placeholders (postData[72-77]) are not used.
		return true;
	}

	/**
	* Parses organisation number post (29).
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	string	$postData
	* @return	bool
	*/
	private function parseOrganisationNumberPost( $postData )
	{
		$this->getTableRow()->setColumn('organisationNumber', (int) substr($postData, 0, 12));
		// Reserved placeholders (postData[12-77]) are not used.
		return true;
	}

	public function toArray(  )
	{
		$array = array();
		// Parameters from table row.
		$rowArray = $this->getTableRow()->toArray();
		foreach ($rowArray['_data'] as $key => $value)
		{
			$array[$key] = $value;
		}
		// Parameters from information rows
		foreach ($this->_informationRows as $informationRow)
		{
			$info = $informationRow->toArray();
			$array['information'][$info['_data']['information_row']]
				= array('information_id' => $info['_data']['information_id'],
						'information' => $info['_data']['information']);
		}
		// Parameters from extra references.
		foreach ($this->_extraReferences as $key => $extraReference)
		{
			$array['extra_reference'][$key] = $extraReference->toArray();
		}
		return $array;
	}


	public function save()
	{
		$this->getTableRow()->save();
		foreach ($this->_informationRows as $informationRow)
		{
			$informationRow->save();
		}
		foreach ($this->_extraReferences as $extraReference)
		{
			$extraReference->save();
		}

	}
}
