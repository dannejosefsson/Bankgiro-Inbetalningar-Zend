<?php
/**
* Economy_Model_BankgiroPaymentsDeposit
*
* A class made to contain a deposit parsed from Bankgiro Inbetalningar files.
*
* @copyright	Copyright © 2012 Daniel Josefsson. All rights reserved.
* @license		GPL v3
* @author		Daniel Josefsson <dannejosefsson@gmail.com>
* @version		v0.2
*/
class Economy_Model_BankgiroPaymentsDeposit
{
	/**
	* Payment count.
	* @var int
	*/
	protected	$_paymentCount;

	/**
	 * Deduction count.
	 * @var int
	 */
	protected	$_deductionCount;

	/**
	* Array storing errors
	* @var array of strings
	 */
	protected	$_errors;

	protected	$_depositTableRow;

	/**
	* Transactions
	* Stores posts from 20 to 29
	* @var array BankgiroPaymentsTransaction
	*/
	protected	$_transactions;
	protected	$_transactionsTable;

	/**
	*
	*
	* @since	v0.2
	* @param	array/string $options
	*/
	public function __construct( $options = null )
	{
		if ( is_array($options) )
		{
			if (array_key_exists('depositRow', $options))
			{
				$this->setTableRow($options['depositRow']);
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
			$this->setTableRow(new Economy_Model_DbTable_BankgiroPaymentsDeposit());
		}
		$this->_errors = array();
		$this->setPaymentCount(0)->setDeductionCount(0);
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
		$this->_depositTableRow = $tableRow;
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
		return $this->_depositTableRow;
	}

	/**
	* Adds or subtracts value depending on $postType
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param	string $postType
	* @param	int $value
	* @return	BankgiroPaymentsDeposit
	*/
	public function updatePaymentValue( $postType, $value )
	{
		if ( '20' == $postType )
		{
			// Value is positive.
		}
		elseif ( '21' == $postType )
		{
			$value = -$value;
		}
		$this->getTableRow()->addAmount($value);
		return $this;
	}

	/**
	* Returns payment count.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	*/
	public function getPaymentCount()
	{
		return $this->_paymentCount;
	}

	/**
	* Returns deduction count.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	*/
	public function getDeductionCount()
	{
		return $this->_deductionCount;
	}

	/**
	* Returns payment type.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.1
	*/
	public function getPaymentType()
	{
		return $this->_paymentType;
	}

	/**
	* Sets new payment date.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.1
	* @param 	int $paymentDate
	* @return	BankgiroPaymentDeposit
	*/
	public function setPaymentDate( $paymentDate )
	{
	$this->_paymentDate = $paymentDate;
	return $this;
	}

	/**
	* Sets new payment value.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.1
	* @param 	int $paymentValue
	* @return	BankgiroPaymentDeposit
	*/
	public function setPaymentValue( $paymentValue )
	{
	$this->_paymentValue = $paymentValue;
	return $this;
	}

	/**
	* Increment payment count.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	BankgiroPaymentDeposit
	*/
	public function incrementPaymentCount()
	{
		$this->_paymentCount++;
		return $this;
	}

	/**
	* Increment deduction count.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	BankgiroPaymentDeposit
	*/
	public function incrementDeductionCount()
	{
		$this->_deductionCount++;
		return $this;
	}

	/**
	* Sets payment count.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.1
	* @param 	int $paymentCount
	* @return	BankgiroPaymentDeposit
	*/
	public function setPaymentCount( $paymentCount )
	{
		$this->_paymentCount = $paymentCount;
		return $this;
	}

	/**
	* Sets deduction count.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.1
	* @param 	int $deductionCount
	* @return	BankgiroPaymentDeposit
	*/
	public function setDeductionCount( $deductionCount )
	{
		$this->_deductionCount = $deductionCount;
		return $this;
	}

	/**
	* Sets new payment type.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.1
	* @param 	int $paymentType
	* @return	BankgiroPaymentDeposit
	*/
	public function setPaymentType( $paymentType )
	{
	$this->_paymentType = $paymentType;
	return $this;
	}

	/**
	* Returns transactions.
	* @author	Daniel Josefsson
	* @since	v0.2
	*/
	public function getTransactions()
	{
		return $this->_transactions;
	}

	/**
	* Sets new transactions.
	* @author	Daniel Josefsson
	* @since	v0.2
	* @param	int $transactions
	* @return	BankgiroPaymentsTransaction
	*/
	public function setTransactions( $transactions )
	{
		$this->_transactions = $transactions;
		return $this;
	}

	/**
	* Add new transaction.
	* Increments deposit count or deduction count depending on post type.
	* @author	Daniel Josefsson
	* @since	v0.2
	* @return	BankgiroPaymentsTransaction
	*/
	public function addTransaction($postType)
	{
		$this->getBankgiroPaymentsTransactionsTable();
		$this->_transactions[] = new Economy_Model_BankgiroPaymentsTransaction(array('transactionRow' => $this->_transactionsTable->createRow()));

		if ( '20' == $postType )
		{
			$this->incrementPaymentCount();
		}
		elseif ( '21' == $postType )
		{
			$this->incrementDeductionCount();
		}
		return $this;
	}

	/**
	* Return index to the latest inserted transaction.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	int $keyToTransaction
	*/
	public function lastTransactionIndex()
	{
		end($this->_transactions);
		return key($this->_transactions);
	}

	/**
	 * Returns wanted transaction
	 * @author	Daniel Josefsson <dannejosefsson@gmail.com>
	 * @since	v0.2
	 * @param 	int $index
	 * @return	BankgiroPaymentsDeposit
	 */
	public function getTransaction( $index )
	{
		return $this->_transactions[$index];
	}

	/**
	* Returns errors.
	* @author	Daniel Josefsson
	* @since	v0.2
	* @return	array of strings
	*/
	public function getErrors()
	{
		return $this->_errors;
	}

	/**
	 * Sets new error.
	 * @author	Daniel Josefsson
	 * @since	v0.2
	 * @param	string $errors
	 * @return	BankgiroPaymentsDeposit
	 */
	public function setError( $error )
	{
		$this->_errors[] = $error;
		return $this;
	}

	/**
	* Returns the extra references count of this deposit
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	int	$extraReferencesCount
	 */
	public function getExtraReferencesCount()
	{
		$extraReferencesCount = 0;
		foreach ($this->_transactions as $transaction)
		{
			$extraReferencesCount += $transaction->getExtraReferencesCount();
		}
		return $extraReferencesCount;
	}

	/**
	* Sets Economy_Model_DbTable_BankgiroPaymentsTransactions table.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param	Economy_Model_DbTable_BankgiroPaymentsTransactions $dbTable
	* @throws 	Exception
	* @return 	Economy_Model_BankgiroPaymentsDeposit
	*/
	public function setBankgiroPaymentsTransactionsTable($dbTable)
	{
		if (is_string($dbTable))
		{
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Economy_Model_DbTable_BankgiroPaymentsTransactions)
		{
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_transactionsTable = $dbTable;
		return $this;
	}

	/**
	* Get BankgiroPaymentsTransactions table.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @return	Economy_Model_DbTable_BankgiroPaymentsTransactions
	*/
	public function getBankgiroPaymentsTransactionsTable()
	{
		if (null === $this->_transactionsTable)
		{
			$this->setBankgiroPaymentsTransactionsTable('Economy_Model_DbTable_BankgiroPaymentsTransactions');
		}
		return $this->_transactionsTable;
	}

	/**
	* Parses line,given with the syntax of posts 5 and 15 in Bankgiro Inbetalningar.
	* Transfers lines with post type 20-29 to BankgiroPaymentsTransaction objects for
	* parsing.
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
			case '05':
				$return = $this->parseOpeningPost($postData);
				break;
			case '15':
				$return = $this->parseSummationPost($postData);
				break;
			case '20':
			case '21':
				$transactionIndex = $this->addTransaction($postType)->lastTransactionIndex();
				$return = $this->getTransaction($transactionIndex)->parsePost($line);
				$value = $this->getTransaction($transactionIndex)->getAmount();
				$this->updatePaymentValue($postType, $value);
				break;
			default:
				$transactionIndex = $this->lastTransactionIndex();
				$return = $this->getTransaction($transactionIndex)->parsePost($line);
				break;
		}
		return $return;
	}

	/**
	* Parses opening post (05).
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	string	$lineData
	* @return	bool
	*/
	private function parseOpeningPost( $lineData )
	{
		$this->getTableRow()->setColumn('bankgiroAccountNumber', (int) substr($lineData, 0, 10));
		$this->getTableRow()->setColumn('plusgiroAccountNumber', ltrim(substr($lineData, 10, 10), "0 "));
		$this->getTableRow()->setColumn('currency', substr($lineData, 20, 3));
		// Reserved placeholders (lineData[23-77]) are not used.
		return true;
	}

	/**
	* Parses summation post (15).
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param 	string	$lineData
	* @return	bool
	*/
	private function parseSummationPost( $lineData )
	{
		$this->getTableRow()->setColumn('bankAccountNumber', (int) substr($lineData, 0, 35));
		$this->getTableRow()->setColumn('paymentDate', substr($lineData, 35, 8));
		$this->getTableRow()->setColumn('depositNumber', (int) substr($lineData, 43, 5));
		$return = true;
		$return = $this->checkConsistancy(	$this->getTableRow()->getColumn('paymentValue'),
											(int) substr($lineData, 48, 18),
											"payment value");

		$return = $this->checkConsistancy(	$this->getTableRow()->getColumn('currency'),
											substr($lineData, 66, 3),
											"currency");

		$return = $this->checkConsistancy(	$this->getPaymentCount() +
											$this->getDeductionCount(),
											(int) substr($lineData, 69, 8),
											"payment count");
		$this->getTableRow()->setColumn('paymentType', substr($lineData, 77, 1));
		return $return;
	}

	/**
	 * Check if the value of left and right are the same.
	 * If not; trow an error with the dynamic variableName.
	 * @author	Daniel Josefsson <dannejosefsson@gmail.com>
	 * @since	v0.2
	 * @param 	mixed	$left
	 * @param 	mixed	$right
	 * @param 	string	$variableName
	 * @return 	boolean
	 */
	private function checkConsistancy( $left, $right, $variableName )
	{
		if (is_int($left) && is_int($right) && !((int) $left - (int) $right))
		{
			return true;
		}
		elseif ( is_string($left) && is_string($right) && !strcmp($left, $right) )
		{
			return true;
		}
		else
		{
			$error = "Parsed and given $variableName are not consistent. ";
			$error .= "Parsed: ".$left." Given: ".$right;
			$this->setError($error);
			return false;
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
		// Parameters from table row.
		$rowArray = $this->getTableRow()->toArray();
		foreach ($rowArray['_data'] as $key => $value)
		{
			$array[$key] = $value;
		}
		foreach ($this->_transactions as $transaction)
		{
			$array['transaction'][] = $transaction->toArray();
		}
		return $array;
	}

	public function save()
	{
		$this->getTableRow()->save();
		foreach ($this->_transactions as $transaction)
		{
			$transaction->save();
		}
	}
}
