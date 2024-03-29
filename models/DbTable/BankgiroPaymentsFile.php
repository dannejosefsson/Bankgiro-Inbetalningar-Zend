<?php

class Economy_Model_DbTable_BankgiroPaymentsFile extends Zend_Db_Table_Row_Abstract
{
    protected 	$_tableClass	= 'Economy_Model_DbTable_BankgiroPaymentsFiles';
    protected 	$_primary		= 'file_id';
    protected 	$_filename		= 'filename';
    protected 	$_addedBy		= 'added_by';
    protected 	$_timeAdded		= 'time_added';
    /**
    * Layout type
    * Max length: 20
    * @var string
    */
    protected $_layout			= 'layout';
    /**
     * Version
     * Max length: 2
     * @var int
     */
    protected $_version			= 'version';
    /**
     * Timestamp
     * @var MySQL timestamp
     */
    protected $_timeCreated		= 'time_created';
    /**
     * Microseconds
     * Length: 6
     * @var string
     */
    protected $_microSeconds	= 'micro_seconds';
    /**
     * Test marker
     * Values: 'P' or 'T'
     * Length: 1
     * @var string
     */
    protected $_testMarker		= 'test_marker';
    /**
    * Bool telling if the file data is parsed into the database.
    * @var bool
     */
    protected $_treated			= 'treated';

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
    * Checks if $primary is a primary of the class
    * @author	Daniel Josefsson <dannejosefsson@gmail.com>
    * @since	v0.2
    * @param	string primary
    * @return	bool
    */
    public function isPrimary($primary)
    {
    	if (	is_array($this->_primary) 	)
    	{
    		if ( in_array($primary, $this->_primary) )
    		{
    			return true;
    		}
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
    	elseif ($this->isPrimary($propertyName))
    	{
    		return $propertyName;
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
