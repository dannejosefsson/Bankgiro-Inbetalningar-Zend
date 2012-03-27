<?php

class Economy_Model_DbTable_BankgiroPaymentsFile extends Zend_Db_Table_Row_Abstract
{
    protected 	$_tableClass	= 'Economy_Model_DbTable_BankgiroPaymentsFiles';
    protected 	$_primary		= 'bankgiro_file_id';
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
     * Length: 1
     * @var string
     */
    protected $_testMarker		= 'test_marker';
    /**
    * Bool telling if the file data is parsed into the database.
    * @var bool
     */
    protected $_treated			= 'treated';

    protected static	$_columnNames = array	(	'filename'			=> 'filename',
		    										'bankgiroFileId'	=> 'bankgiro_file_id',
		    										'addedBy'			=> 'added_by',
		    										'timeAdded'			=> 'time_added',
    												'layout'			=> 'layout',
    												'version'			=> 'version',
    												'timeCreated'		=> 'time_created',
    												'microSeconds'		=> 'micro_seconds',
    												'testMarker'		=> 'test_marker',
    												'treated'			=> 'treated',
		    									);

    static function getColumnName($columnCamelCase)
    {
    	if (	array_key_exists($columnCamelCase, self::$_columnNames)	)
    	{
    		 return  self::$_columnNames[$columnCamelCase];
    	}
    	else
    	{
    		return null;
    	}
    }

    public function setColumn( $columnName, $value )
    {
    	$this->${$this->getColumnName($columnName)} = $value;
    }

    public function getColumn( $columnName )
    {
    	$this->${$this->getColumnName($columnName)};
    }

}