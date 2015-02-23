<?php


namespace PrimeRose\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;


use PrimeRose\Model\Entity\Supplier;

class SupplierTable extends AbstractTableGateway {

    protected $table = 'suppliers';

    public function __construct(Adapter $adapter) 
    {
        $this->adapter = $adapter;
    }

    public function fetchAll() 
    {
        // use left join to fetch address details
        $resultSet = $this->select(function (Select $select) {
                    // $select->columns(array('suppliers.supplier_id' => 'supplier_id'), false);
                    $select->join(arraY('sa' => 'supplier_addresses'), 
                        'suppliers.supplier_id=sa.supplier_id',
                        array('address_id'),
                        $select::JOIN_LEFT);
                    $select->order('supplier_name asc');
                });
        $entities = array();

        foreach ($resultSet as $row) {
            // append to the record if it exists
            if (!isset($entities[$row->supplier_id]))
            {
                $entity = new Supplier();
                $entity->setId($row->supplier_id)
                        ->setName($row->supplier_name);
                // if an address exist - add it to the list
                if ($row->address_id > 0) 
                    $entity->addAddress($row->address_id);
                $entities[$row->supplier_id] = $entity;
            } else {
                $entities[$row->supplier_id]->addAddress($row->address_id);
            }
        }
        return $entities;
    }

    public function save(Supplier $supplier)
    {
        $data = array(
            'supplier_name' => $supplier->getName()
        );

        $id = (int) $supplier->getId();
        if ($id == 0)
        {
            $this->insert($data);
            return $this->lastInsertValue;
        }
    }

    public function remove($id)
    {
        $this->delete(array('supplier_id' => (int)$id ));
    }


}

?>