<?php

class Economy_Model_DbTable_BankgiroPaymentsTransaction extends Zend_Db_Table_Row_Abstract
{
    protected 	$_tableClass		= 'Economy_Model_DbTable_BankgiroPaymentsTransaction';
    /*protected 	$_primary			= 'invoice_file_id';
    protected 	$_filename			= 'filename';
    protected 	$_added_by			= 'added_by';
    protected 	$_time_added		= 'time_added';
    protected	$_time_extracted	= 'time_extracted';

    protected static	$_columnNames = array	(	'fileName'		=> 'filename',
		    										'invoiceFileId'	=> 'invoice_file_id',
		    										'addedBy'		=> 'added_by',
		    										'timeAdded'		=> 'time_added',
		    										'timeExtracted'	=> 'timeExtracted',
		    									);
	*/
    static function getColumnName($columnCamelCase)
    {
    	if (	array_key_exists($columnCamelCase, self::$_columnNames)	)
    	{
    		 return  self::$_columnNames[$columnCamelCase];
    	}
    	else
    	{
    		return NULL;
    	}
    }

}