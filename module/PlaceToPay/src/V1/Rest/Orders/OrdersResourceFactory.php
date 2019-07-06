<?php
namespace PlaceToPay\V1\Rest\Orders;

class OrdersResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('PlaceToPay\V1\Rest\Orders\OrdersMapper');
                                  
        return new OrdersResource($mapper);
    }
}
