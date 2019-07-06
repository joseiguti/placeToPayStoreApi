<?php
namespace PlaceToPay\V1\Rest\Orders;

use Zend\Db\Adapter\AdapterInterface;
#use Zend\Db\Sql\Insert;


class OrdersMapper
{
    protected $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function create($data)
    {
        /*
        $tableGateWay = new \Zend\Db\TableGateway\TableGateway('orders', $this->adapter);
        
        $newData = [
        
            'customer_name'     => isset($data->customer_name) ? $data->customer_name : NULL,
            
            'customer_email'    => isset($data->customer_email) ? $data->customer_email : NULL,
            
            'customer_mobile'   => isset($data->customer_mobile) ? $data->customer_mobile : NULL,
            
            'status'            => 'CREATED',
            
            'created_at'        => date("Y-m-d H:i:s"), 
            
            'updated_at'        => date("Y-m-d H:i:s")
        ];
        
        $tableGateWay->insert($newData);

        $lastInsertId = $tableGateWay->getAdapter()->getDriver()->getLastGeneratedValue('historical_id_seq');
        */
        //return array ('last_insert_id' => $lastInsertId);
        
        $placeToPay = new \Dnetix\Redirection\PlaceToPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://dev.placetopay.com/redirection/',
        ]);
        
        $reference = 'prd001';
        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => 'Corbata',
                'amount' => [
                    'currency' => 'USD',
                    'total' => 120,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => 'http://example.com/response?reference=' . $reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];
        
        $response = $placeToPay->request($request);
        
        
        if ($response->isSuccessful()) {
            // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
            // Redirect the client to the processUrl or display it on the JS extension
            //header('Location: ' . $response->processUrl());
            return ['request_id' => $response->requestId(), 'processUrl' => $response->processUrl()];
        } else {
            // There was some error so check the message and log it
            return ['message' => $response->status()->message()];
        }
        
    }
}
