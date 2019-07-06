<?php
namespace PlaceToPay\V1\Rest\Orders;

class OrdersEntity
{
    public $id;
    
    public $customer_name;
    
    public $customer_email;
    
    public $customer_mobile;
    
    public $status;
    
    public $created_at;
    
    public $updated_at;
    
    public function getArrayCopy()
    {
        return array(
    
            'id'                => $this->id,
            
            'customer_name'     => $this->customer_name,
            
            'customer_email'    => $this->customer_email,
            
            'customer_mobile'   => $this->customer_mobile,
            
            'status'            => $this->status,
            
            'created_at'        => $this->created_at,
            
            'updated_at'        => $this->updated_at,
    
        );
    }
    
    public function exchangeArray(array $array)
    {
    
        $this->id               = $array['id'];
    
        $this->customer_name    = $array['customer_name'];
        
        $this->customer_email   = $array['customer_email'];
        
        $this->customer_mobile  = $array['customer_mobile']; 
        
        $this->status           = $array['status'];
        
        $this->created_at       = $array['created_at'];
        
        $this->updated_at       = $array['updated_at'];
    }
    
}
