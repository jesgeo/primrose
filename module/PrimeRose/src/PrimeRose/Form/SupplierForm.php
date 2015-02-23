<?php 
namespace PrimeRose\Form;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\Form\Form;
use PrimeRose\Model\Entity\Supplier;

use Zend\Validator\StringLength;
use Zend\Validator\NotEmpty;
use Zend\Validator\EmailAddress;
use Zend\Validator\Date;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class SupplierForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('supplier');
        $this->setHydrator(new ClassMethodsHydrator());
        $this->add(array(
            'name' => 'supplier_id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Supplier Name',
            ),
        ));
       $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'address',
            'options' => array(
                'label' => 'Addresses',
                'count' => 2,
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => array(
                    'type' => 'PrimeRose\Form\AddressFieldset',
                ),
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));


        // filter - example
        $inputFilter = new InputFilter();
        $factory = new InputFactory();

        $inputFilter->add($factory->createInput(array(
                    'name' => 'supplier_id',
                    'filters' => array(
                        array('name' => 'Int'),
                    ),
                )));

        $inputFilter->add($factory->createInput(array(
                    'name' => 'name',
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
        $this->setInputFilter($inputFilter);
    }
}
?>