<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PrimeRose;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use PrimeRose\Model\SupplierTable;
use PrimeRose\Model\AddressTable;
use PrimeRose\Model\SupplierAddressTable;
use PrimeRose\Model\Entity\Address;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig() 
    {
        return array(
            'factories' => array(
                'PrimeRose\Model\SupplierTable' => function($sm) 
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new SupplierTable($dbAdapter);
                    return $table;
                },
                'PrimeRose\Model\SupplierAddressTable' => function($sm) 
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new SupplierAddressTable($dbAdapter);
                    return $table;
                },
                'PrimeRose\Model\AddressTable' => function($sm) 
                {
                    $tableGateway = $sm->get('AddressTableGateway');
                    $table = new AddressTable($tableGateway);
                    return $table;
                },
                'AddressTableGateway' => function($sm)
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Address());
                    return new TableGateway('addresses', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
