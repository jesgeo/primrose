<?php


namespace PrimeRose\Model\Entity;

class Address {

    protected $_id;
    protected $_line1;
    protected $_line2;
    protected $_town;
    protected $_postcode;
    protected $_tel;
    protected $_fax;
    protected $_email;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($s, $value) {
        $method = 'set' . $s;
        if (!method_exists($this, $method)) {
            // throw new Exception('Invalid Method');
        }
        $this->$method($value);
    }

    public function __get($s) {
        $method = 'get' . $s;
        if (!method_exists($this, $method)) {
            // throw new Exception('Invalid Method');
            // return;
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
        $this->_id    = (isset($data['address_id'])) ? $data['address_id'] : null;
        $this->_line1 = (isset($data['address_line_1'])) ? $data['address_line_1'] : null;
        $this->_line2 = (isset($data['address_line_2'])) ? $data['address_line_2'] : null;
        $this->_town = (isset($data['town'])) ? $data['town'] : null;
        $this->_postcode = (isset($data['postcode'])) ? $data['postcode'] : null;
        $this->_tel = (isset($data['telephone'])) ? $data['telephone'] : null;
        $this->_fax = (isset($data['fax'])) ? $data['fax'] : null;
        $this->_email = (isset($data['email'])) ? $data['email'] : null;
    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
        return $this;
    }

    public function getLine1() {
        return $this->_line1;
    }

    public function setLine1($s) {
        $this->_line1 = $s;
        return $this;
    }

    public function getLine2() {
        return $this->_line2;
    }

    public function setLine2($s) {
        $this->_line2 = $s;
        return $this;
    }

    public function getTown() {
        return $this->_town;
    }

    public function setTown($s) {
        $this->_town = $s;
        return $this;
    }

    public function getPostcode() {
        return $this->_postcode;
    }

    public function setPostcode($s) {
        $this->_postcode = $s;
        return $this;
    }

    public function getTel() {
        return $this->_tel;
    }

    public function setTel($s) {
        $this->_tel = $s;
        return $this;
    }

    public function getFax() {
        return $this->_fax;
    }

    public function setFax($s) {
        $this->_fax = $s;
        return $this;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function setEmail($s) {
        $this->_email = $s;
        return $this;
    }



}

?>