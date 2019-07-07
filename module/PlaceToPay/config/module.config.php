<?php
return [
    'service_manager' => [
        'factories' => [
            \PlaceToPay\V1\Rest\Orders\OrdersResource::class => \PlaceToPay\V1\Rest\Orders\OrdersResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'place-to-pay.rest.orders' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/pay[/:orders_id]',
                    'defaults' => [
                        'controller' => 'PlaceToPay\\V1\\Rest\\Orders\\Controller',
                    ],
                ],
            ],
            'place-to-pay.rest.products' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/products[/:products_id]',
                    'defaults' => [
                        'controller' => 'PlaceToPay\\V1\\Rest\\Products\\Controller',
                    ],
                ],
            ],
            'place-to-pay.rpc.query' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/query[/:request_id]',
                    'defaults' => [
                        'controller' => 'PlaceToPay\\V1\\Rpc\\Query\\Controller',
                        'action' => 'query',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'place-to-pay.rest.orders',
            1 => 'place-to-pay.rest.products',
            2 => 'place-to-pay.rpc.query',
        ],
    ],
    'zf-rest' => [
        'PlaceToPay\\V1\\Rest\\Orders\\Controller' => [
            'listener' => \PlaceToPay\V1\Rest\Orders\OrdersResource::class,
            'route_name' => 'place-to-pay.rest.orders',
            'route_identifier_name' => 'orders_id',
            'collection_name' => 'orders',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \PlaceToPay\V1\Rest\Orders\OrdersEntity::class,
            'collection_class' => \PlaceToPay\V1\Rest\Orders\OrdersCollection::class,
            'service_name' => 'Orders',
        ],
        'PlaceToPay\\V1\\Rest\\Products\\Controller' => [
            'listener' => 'PlaceToPay\\V1\\Rest\\Products\\ProductsResource',
            'route_name' => 'place-to-pay.rest.products',
            'route_identifier_name' => 'products_id',
            'collection_name' => 'products',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \PlaceToPay\V1\Rest\Products\ProductsEntity::class,
            'collection_class' => \PlaceToPay\V1\Rest\Products\ProductsCollection::class,
            'service_name' => 'products',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'PlaceToPay\\V1\\Rest\\Orders\\Controller' => 'Json',
            'PlaceToPay\\V1\\Rest\\Products\\Controller' => 'Json',
            'PlaceToPay\\V1\\Rpc\\Query\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'PlaceToPay\\V1\\Rest\\Orders\\Controller' => [
                0 => 'application/vnd.place-to-pay.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'PlaceToPay\\V1\\Rest\\Products\\Controller' => [
                0 => 'application/vnd.place-to-pay.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'PlaceToPay\\V1\\Rpc\\Query\\Controller' => [
                0 => 'application/vnd.place-to-pay.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
        ],
        'content_type_whitelist' => [
            'PlaceToPay\\V1\\Rest\\Orders\\Controller' => [
                0 => 'application/vnd.place-to-pay.v1+json',
                1 => 'application/json',
            ],
            'PlaceToPay\\V1\\Rest\\Products\\Controller' => [
                0 => 'application/vnd.place-to-pay.v1+json',
                1 => 'application/json',
            ],
            'PlaceToPay\\V1\\Rpc\\Query\\Controller' => [
                0 => 'application/vnd.place-to-pay.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \PlaceToPay\V1\Rest\Orders\OrdersEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'place-to-pay.rest.orders',
                'route_identifier_name' => 'orders_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \PlaceToPay\V1\Rest\Orders\OrdersCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'place-to-pay.rest.orders',
                'route_identifier_name' => 'orders_id',
                'is_collection' => true,
            ],
            \PlaceToPay\V1\Rest\Products\ProductsEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'place-to-pay.rest.products',
                'route_identifier_name' => 'products_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \PlaceToPay\V1\Rest\Products\ProductsCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'place-to-pay.rest.products',
                'route_identifier_name' => 'products_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-apigility' => [
        'db-connected' => [
            'PlaceToPay\\V1\\Rest\\Products\\ProductsResource' => [
                'adapter_name' => 'Mysql',
                'table_name' => 'products',
                'hydrator_name' => \Zend\Hydrator\ArraySerializable::class,
                'controller_service_name' => 'PlaceToPay\\V1\\Rest\\Products\\Controller',
                'entity_identifier_name' => 'id',
                'table_service' => 'PlaceToPay\\V1\\Rest\\Products\\ProductsResource\\Table',
            ],
        ],
    ],
    'zf-content-validation' => [
        'PlaceToPay\\V1\\Rest\\Products\\Controller' => [
            'input_filter' => 'PlaceToPay\\V1\\Rest\\Products\\Validator',
        ],
        'PlaceToPay\\V1\\Rpc\\Query\\Controller' => [
            'input_filter' => 'PlaceToPay\\V1\\Rpc\\Query\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'PlaceToPay\\V1\\Rest\\Products\\Validator' => [
            0 => [
                'name' => 'unique_code',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '100',
                        ],
                    ],
                ],
            ],
            1 => [
                'name' => 'name',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '100',
                        ],
                    ],
                ],
            ],
            2 => [
                'name' => 'description',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '65535',
                        ],
                    ],
                ],
            ],
            3 => [
                'name' => 'url_pic',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '200',
                        ],
                    ],
                ],
            ],
            4 => [
                'name' => 'price',
                'required' => true,
                'filters' => [],
                'validators' => [],
            ],
        ],
        'PlaceToPay\\V1\\Rpc\\Query\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'queryResult',
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'PlaceToPay\\V1\\Rpc\\Query\\Controller' => \PlaceToPay\V1\Rpc\Query\QueryControllerFactory::class,
        ],
    ],
    'zf-rpc' => [
        'PlaceToPay\\V1\\Rpc\\Query\\Controller' => [
            'service_name' => 'Query',
            'http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'route_name' => 'place-to-pay.rpc.query',
        ],
    ],
];
