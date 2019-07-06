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
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'place-to-pay.rest.orders',
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
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'PlaceToPay\\V1\\Rest\\Orders\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'PlaceToPay\\V1\\Rest\\Orders\\Controller' => [
                0 => 'application/vnd.place-to-pay.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'PlaceToPay\\V1\\Rest\\Orders\\Controller' => [
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
        ],
    ],
];
