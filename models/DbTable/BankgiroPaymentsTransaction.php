<?php

class Economy_Model_DbTable_BankgiroPaymentsTransaction extends Zend_Db_Table_Row_Abstract
{
    protected 	$_tableClass					= 'Economy_Model_DbTable_BankgiroPaymentsTransactions';
    protected	$_primary						= 'transaction_id';
    /**
    * Transaction code.
    * Possible values "20", "21", "22", "23".
    * Max length: 2
    * @var int
    */
    protected	$_transactionCode				= 'transaction_code';
    /**
     * Sender Bankgiro account number.
     * Max length: 10
     * @var int
     */
    protected	$_senderBankgiroAccountNumber	= 'sender_bankgiro_account_number';
    /**
     * Amount.
     * Last two digits are ören.
     * Max length 18
     * @var int
     */
    protected	$_amount						= 'amount';
    /**
     * Reference
     * Can be both int or string. Depends on $_referenceCode.
     * Max length: 25
     * @var mixed
     */
    protected	$_reference						= 'reference';
    /**
     * Reference code
     * Length: 1
     * Tells what kind of reference $_reference is.
     * @var int
     */
    protected	$_referenceCode					= 'reference_code';
    /**
     * Channel code
     * Length: 1
     * @var int
     */
    protected	$_channelCode					= 'channel_code';
    /**
     * Serial number
     * Contains a two year unique serial number.
     * Is also used as image key.
     * Length: 12
     * @var string
     */
    protected	$_serialNumber					= 'serial_number';
    /**
     * Image marker
     * Tells if a image is connected to the transaction.
     * @var bool
     */
    protected	$_imageMarker					= 'image_marker';
    /**
     * Deduction code
     * Used when transaction code is "21"
     * Tells if there are any reminder of the invoice.
     * Length: 1
     * @var int
     */
    protected	$_deductionCode					= 'deduction_code';
    /**
     * Name of the sender, part 1
     * Max length of string: 35
     * @var string
     */
    protected	$_name1							= 'name1';
    /**
     * Name of the sender, part 2
     * Max length of string: 35
     * @var string
     */
    protected	$_name2							= 'name2';
    /**
     * Adress
     * Max length: 35
     * @var string
     */
    protected	$_address						= 'address';
    /**
     * Postal number
     * Max length: 9
     * @var string
     */
    protected	$_postalNumber					= 'postal_number';
    /**
     * City
     * Max length: 35
     * @var string
     */
    protected	$_city							= 'city';
    /**
     * Country
     * Max length: 35
     * Country is blank if it is a domestic transaction.
     * @var string
     */
    protected	$_country						= 'country';
    /**
     * Countrycode
     * Max code length: 2
     * Country code is blank if it is a domestic transaction.
     * @var string
     */
    protected	$_countryCode					= 'country_code';
    /**
     * Sender organisation number
     * Max length: 12
     * @var int
     */
    protected	$_organisationNumber			= 'organisation_number';

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
