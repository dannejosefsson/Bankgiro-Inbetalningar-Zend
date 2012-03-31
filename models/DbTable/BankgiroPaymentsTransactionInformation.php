<?php

class Economy_Model_DbTable_BankgiroPaymentsTransactionInformation extends Zend_Db_Table_Row_Abstract
{
    protected 	$_tableClass		= 'Economy_Model_DbTable_BankgiroPaymentsTransactionInformations';
    protected	$_primary			= 'information_id';
    /**
    * Transaction code.
    * Possible values "20", "21", "22", "23".
    * Max length: 2
    * @var int
    */
    protected	$_transactionId		= 'transaction_id';
    /**
    * Transaction information.
    * Max value: 99
    * @var int
    */
    protected 	$_informationRow	= 'information_row';
    /**
     * Transaction information.
     * Max length: 50
     * @var string
     */
    protected	$_information		= 'information';

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
