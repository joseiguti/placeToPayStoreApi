<?php
namespace PlaceToPay\V1\Rest\Orders;

use Zend\Db\Adapter\AdapterInterface;


class OrdersMapper
{
    
    protected $adapter;
    
    private $placeToPayConfig = [];

    public function __construct(AdapterInterface $adapter, $placeToPayConfig)
    {
        $this->adapter = $adapter;
        
        $this->placeToPayConfig = $placeToPayConfig;
        
    }
    
    public function getAll (){

        $tableGateWay = new \Zend\Db\TableGateway\TableGateway('orders', $this->adapter);
        
        $response = $tableGateWay->select();
        
        return $response;
    }
    
    public function getOrderById ($id){
        
        $tableGateWay = new \Zend\Db\TableGateway\TableGateway('orders', $this->adapter);
        
        $response = $tableGateWay->select(['id'=>$id]);
        
        return $response;
    }
    
    public function update ($id, $data){
        
        $tableGateWay = new \Zend\Db\TableGateway\TableGateway('orders', $this->adapter);
        
        $newData = [
            
            'updated_at' => date("Y-m-d H:i:s")
        ];
        
        if (is_object($data)){
            
            $newData['status'] = ($data->status=='APPROVED')?'APPROVED':'REJECTED';
            
            $response = $tableGateWay->update($newData,['request_id'=>$id]);
            
        }else{
        
            if (isset($data['request_id']))
            
                $newData['request_id'] = $data['request_id'];
            
            $response = $tableGateWay->update($newData,['id'=>$id]);
        }
        
        return $response;
    }

    public function create($data)
    {
        
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
        
        $placeToPay = new \Dnetix\Redirection\PlaceToPay($this->placeToPayConfig);
        
        $reference = $data->unique_code;
        
        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => $data->name,
                'amount' => [
                    'currency' => 'USD',
                    'total' => $data->price,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => $data->urlReturn.$lastInsertId,
            'ipAddress' => $data->ip,
            'userAgent' => $data->userAgent,
        ];
        
        $response = $placeToPay->request($request);
        
        if ($response->isSuccessful()) {
            // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
            // Redirect the client to the processUrl or display it on the JS extension
            //header('Location: ' . $response->processUrl());
            
            $updateReturn = $this->update($lastInsertId, ['request_id' => $response->requestId()]);
            
            return [
                
                'request_id'        => $response->requestId(),
                
                'processUrl'        => $response->processUrl(),
                
                'last_insert_id'    => $lastInsertId,
                
                'updateReturn'      => $updateReturn,
            ];
            
        } else {
            // There was some error so check the message and log it
            return [
                'message' => $response->status()->message(),
                
                'dataSent' => $data,
                
            ];
        }
        
    }
}
