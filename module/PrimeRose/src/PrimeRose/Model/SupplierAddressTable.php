<?php


namespace PrimeRose\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;


use PrimeRose\Model\Entity\Supplier;

class SupplierAddressTable extends AbstractTableGateway {

    protected $table = 'supplier_addresses';

    public function __construct(Adapter $adapter) 
    {
        $this->adapter = $adapter;
    }


    public function save($supplier, $address)
    {
        $data = array(
            'supplier_id' => $supplier,
            'address_id' => $address,
        );

        // $id = (int) $supplier->getId();
        // if ($id == 0)
        // {
            $this->insert($data);
        // }
    }

    public function deleteBySupplier($supplier){
        $this->delete(array('supplier_id' => (int)$supplier ));
    }

    public function getAddressBySupplier($supplier){
        $set = $this->select(array('supplier_id' => (int) $supplier));

        $addresses = array();
        foreach ($set as $row) {
            $addresses[] = $row->address_id;
        }
        return $addresses;

    }
}

?>