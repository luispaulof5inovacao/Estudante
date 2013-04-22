<?php
namespace Estudante;
// Add these import statements:
use Estudante\Model\Estudante;
use Estudante\Model\EstudanteTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ), 
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    // Add this method:
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Estudante\Model\EstudanteTable' =>  function($sm) {
                    $tableGateway = $sm->get('EstudanteTableGateway');
                    $table = new EstudanteTable($tableGateway);
                    return $table;
                },
                'EstudanteTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
//                    print_r($dbAdapter);
//                    die("");
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Estudante());                  
                    return new TableGateway('estudante', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
    
    
}