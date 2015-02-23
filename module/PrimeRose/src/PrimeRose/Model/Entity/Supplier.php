<?php


namespace PrimeRose\Model\Entity;

use Zend\Validator\StringLength;
use Zend\Validator\NotEmpty;
use Zend\Validator\EmailAddress;
use Zend\Validator\Date;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Supplier {

    protected $_id;
    protected $_name;
    
    protected $_addresses;

    protected $inputFilter;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function exchangeArray($data){
        $this->_id    = (isset($data['supplier_id'])) ? $data['supplier_id'] : null;
        $this->_name = (isset($data['name'])) ? $data['name'] : null;
        $this->_addresses = (isset($data['addresses'])) ? $data['addresses'] : null;
    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
        return $this;
    }

    public function getName() {
        return $this->_name;
    }

    public function setName($name) {
        $this->_name = $name;
        return $this;
    }

    public function addAddress($address) {
        $this->_addresses[] = $address;
        return $this;
    }

    public function deleteAddress($address) {
        if( ($pos = array_search($address, $this->_addresses)) !== false)
            unset($this->_addresses[$pos]);
        return $this;
    }

    public function getAddress(){
        return $this->_addresses;
    }

    public function setAddress($a) {
        $this->_addresses = $a;
        return $this;
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'supplier_id',
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'supplier_name',
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                            ),
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 50,
                                ),
                            ),
                        ),
                    )));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }


}

?>