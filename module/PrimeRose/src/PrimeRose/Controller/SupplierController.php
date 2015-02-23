<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PrimeRose\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

use PrimeRose\Form\SupplierForm;
use PrimeRose\Model\Entity\Supplier;
use PrimeRose\Model\Entity\Address;

class SupplierController extends AbstractActionController
{
    protected $_supplierTable;
    protected $_addressTable;
    protected $_supplierAddressTable;

    public function indexAction()
    {

        $suppliers = $this->getSupplierTable()->fetchAll();

        // change address id to Objects;
        // probably better ways to do this in ZF2
        foreach ($suppliers as $k => &$s) {
            if (is_array($s->getAddress()))
            {
                $addresses = array();
                foreach ($s->getAddress() as $key => $id) 
                {
                    $addresses[] = $this->getAddressTable()->getAddress($id);
                }

                $s->setAddress($addresses);
            }
        }


        return new ViewModel(array(
                //attribute access in template 
                'suppliers' => $suppliers
            ));
    }
	public function addAction()
	{
        //initialise form
        $form = new SupplierForm();

        $form->get('submit')->setValue('Add');
        
        $supplier = new Supplier();
        $form->bind($supplier);

        $request = $this->getRequest();
        if ($request->isPost()) {
             // $form->setInputFilter($supplier->getInputFilter());
             $form->setData($request->getPost());
            // check validity on fields 
            if ($form->isValid()) {
                // save supplier
                $id = $this->getSupplierTable()->save($supplier);
                $addressTable = $this->getAddressTable();
                // add addresses based on the fieldset
                foreach ($supplier->getAddress() as $key => $address) {
                    $aid = $addressTable->save($address);
                    // add relationships
                    $this->getSupplierAddressTable()->save($id, $aid);
                }

                // Redirect to list of albums
                return $this->redirect()->toRoute('primerose/supplier');
             }
         }

        return array('form' => $form);
    }

    public function deleteAction() 
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        //if no id is given - redirect
        if (!$id) 
            return $this->redirect()->toRoute('primerose');
        
        // get all addresses 
        $addresses = $this->getSupplierAddressTable()->getAddressBySupplier($id);
        // delete foriegn relation
        $this->getSupplierAddressTable()->deleteBySupplier($id);
        // remove supplier and the list of addresses 
        $this->getSupplierTable()->remove($id);
        foreach ($addresses as $id) {
            $this->getAddressTable()->delete($id);
        }
        
        // redirect to the updated list  
        return $this->redirect()->toRoute('primerose/supplier');
    }


    public function getSupplierTable() 
    {
        if (!$this->_supplierTable) 
        {
            // dependency injection
            $sm = $this->getServiceLocator();
            $this->_supplierTable = $sm->get('PrimeRose\Model\SupplierTable');
        }
        return $this->_supplierTable;
    }

    public function getAddressTable() 
    {
        if (!$this->_addressTable) 
        {
            $sm = $this->getServiceLocator();
            $this->_addressTable = $sm->get('PrimeRose\Model\AddressTable');
        }
        return $this->_addressTable;
    }
    public function getSupplierAddressTable() 
    {
        if (!$this->_supplierAddressTable) 
        {
            $sm = $this->getServiceLocator();
            $this->_supplierAddressTable = $sm->get('PrimeRose\Model\SupplierAddressTable');
        }
        return $this->_supplierAddressTable;
    }
}
