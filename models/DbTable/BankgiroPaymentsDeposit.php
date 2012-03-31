<?php

class Economy_Model_DbTable_BankgiroPaymentsDeposit extends Zend_Db_Table_Row_Abstract
{
    protected 	$_tableClass		= 'Economy_Model_DbTable_BankgiroPaymentsDeposits';
    protected 	$_primary			= 'deposit_id';

    /**
	* Bankgiro account number.
	* Max length: 10
	* Can be zero padded.
	* @var int
	*/
	protected	$_bankgiroAccountNumber = 'bankgiro_account_number';

	/**
	* Plusgiro account number.
	* Max length: 10
	* Can be zero padded.
	* @var string
	*/
	protected	$_plusgiroAccountNumber = 'plusgiro_account_number';

	/**
	* Bank account number.
	* Divided into clearing number and account number.
	* Max length clearing number: 4
	* Max length account number: 12
	* Can be zero padded.
	* @var array
	*/
	protected	$_bankAccountNumber = 'bank_account_number';

	/**
	* Currency.
	* Possible values: "SEK", "EUR".
	* @var string
	*/
	protected	$_currency = 'currency';

	/**
	* Deposit number.
	* Unique per bankgiro account number and year.
	* Max length: 5
	* Can be zero padded.
	* @var int
	 */
	protected	$_depositNumber = 'deposit_number';

	/**
	* Payment date.
	* YYYYMMDD
	* @var string
	*/
	protected	$_paymentDate = 'payment_date';

	/**
	* Payment value.
	* Max length: 18
	* Can be zero padded.
	* @var int
	*/
	protected	$_paymentValue = 'payment_value';

	/**
	* Type of payment.
	* Possible values "K", "D", "S".
	* @var unknown_type
	*/
	protected	$_paymentType = 'payment_type';

	/**
	* Checks if '_'.$propertyCamelCase is a property of the class
	 * @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param	string $propertyCamelCase
	* @return	bool
	*/
	static function isProperty($propertyCamelCase)
	{
		if (	array_key_exists('_'.$propertyCamelCase, get_class_vars(__CLASS__))	)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	* Sets $propertyName table column to given $value.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param	string $propertyName
	* @param	mixed $value
	* @return	Economy_Model_DbTable_BankgiroPaymentsTransaction|boolean
	*/
	public function setColumn( $propertyName, $value )
	{
		if ( $this->isProperty($propertyName) )
		{
			$this->{$this->{'_'.$propertyName}} = $value;
			return $this;
		}
		else
		{
			return false;
		}
	}

	/**
	* Gets $propertyName table value.
	* @author	Daniel Josefsson <dannejosefsson@gmail.com>
	* @since	v0.2
	* @param	string $propertyName
	* @return	mixed|boolean
	*/
	public function getColumn( $propertyName )
	{
		if ( $this->isProperty($propertyName) )
		{
			return $this->{$this->{'_'.$propertyName}};
		}
		else
		{
			return false;
		}
	}

    public function addAmount($value)
    {
    	if (null == ($currentValue = $this->getColumn('paymentValue') )	)
    	{
    		$currentValue = 0;
    	}
    	return $this->setColumn('paymentValue', $currentValue + $value);
    }


    /**
    * Returns object parameters as an associative array.
    * @author	Daniel Josefsson <dannejosefsson@gmail.com>
    * @since	v0.2
    * @return	array of strings
    */
    public function toArray()
    {
    return get_object_vars($this);
    }
}
