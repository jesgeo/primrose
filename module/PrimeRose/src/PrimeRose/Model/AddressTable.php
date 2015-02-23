<?php


namespace PrimeRose\Model;


use Zend\Db\TableGateway\TableGateway;
use PrimeRose\Model\Entity\Address;

use Zend\Db\Sql\Select;

class AddressTable  {

    protected $table = 'addresses';

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) 
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }


    public function getAddress($id) {
        $row = $this->tableGateway->select(array('address_id' => (int) $id))->current();
        if (!$row)
            return false;

        $address = new Address(array(
                    'id' => $row->id,
                    'line1' => $row->line1,
                    'line2' => $row->line2,
                    'town' => $row->town,
                    'postcode' => $row->postcode,
                    'tel' => $row->tel,
                    'fax' => $row->fax,
                    'email' => $row->email,
                ));
        return $address;
    }

    public function save(Address $addr){

        $data = array(
                'address_line_1' => $addr->getLine1(),
                'address_line_2' => $addr->getLine2(),
                'town' => $addr->getTown(),
                'post_code' => $addr->getPostcode(),
                'telephone' => $addr->getTel(),
                'fax' => $addr->getFax(),
                'email' => $addr->getEmail(),
            );
        $id = (int) $addr->getId();
        if ($id == 0)
        {
            $this->tableGateway->insert($data);
            return $this->tableGateway->lastInsertValue;
        }
    }

    public function delete ($id){
        $this->tableGateway->delete(array('address_id' => (int)$id));
    }
    
}


?>