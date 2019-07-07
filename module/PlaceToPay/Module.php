<?php
namespace PlaceToPay;

use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }
    
    public function getServiceConfig(){
        
        return [
            
            'factories' => [
                
                'PlaceToPay\V1\Rest\Orders\OrdersMapper' => function ($sm){
                    
                    return new \PlaceToPay\V1\Rest\Orders\OrdersMapper(new \Zend\Db\Adapter\Adapter(
                        $sm->get('config')['db']['adapters']['Mysql']),
                        $sm->get('config')['placetopay']);
                },
                
                
            ]
            
        ];
        
    }
}
