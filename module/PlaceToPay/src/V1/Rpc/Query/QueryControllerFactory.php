<?php
namespace PlaceToPay\V1\Rpc\Query;

class QueryControllerFactory
{
    public function __invoke($controllers)
    {
        return new QueryController();
    }
}
