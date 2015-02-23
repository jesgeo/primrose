<?php
namespace PrimeRose\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

use PrimeRose\Model\Entity\Address;

class AddressFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('category');
        $this
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new Address())
        ;
        $this->setLabel('Addresses');
        $this->add(array(
            'name' => 'line1',
            'type' => 'Text',
            'options' => array(
                'label' => 'Address Line 1',
            ),
        ));
        $this->add(array(
            'name' => 'line2',
            'type' => 'Text',
            'options' => array(
                'label' => 'Address Line 2',
            ),
        ));
        $this->add(array(
            'name' => 'town',
            'type' => 'Text',
            'options' => array(
                'label' => 'Town',
            ),
        ));
        $this->add(array(
            'name' => 'postcode',
            'type' => 'Text',
            'options' => array(
                'label' => 'Post Code',
            ),
        ));
        $this->add(array(
            'name' => 'tel',
            'type' => 'Text',
            'options' => array(
                'label' => 'Telephone',
            ),
        ));
        $this->add(array(
            'name' => 'fax',
            'type' => 'Text',
            'options' => array(
                'label' => 'Fax',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'text',
            'options' => array(
                'label' => 'Email',
            ),
        ));
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'line1' => array(
                'required' => true,
            ),
        );
    }
}
?>