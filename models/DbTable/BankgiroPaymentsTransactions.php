<?php

class Economy_Model_DbTable_BankgiroPaymentsTransactions extends Zend_Db_Table_Abstract
{
    protected $_name        = 'bankgiro_transactions';
    protected $_rowClass	= 'Economy_Model_DbTable_BankgiroPaymentsTransaction';
}