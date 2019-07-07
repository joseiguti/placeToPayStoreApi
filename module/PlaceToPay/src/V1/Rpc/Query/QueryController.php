<?php
namespace PlaceToPay\V1\Rpc\Query;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

class QueryController extends AbstractActionController
{
    public function queryAction()
    {
        $placetopay = new \Dnetix\Redirection\PlacetoPay([
        
            'login' => '6dd490faf9cb87a9862245da41170ff2',
        
            'tranKey' => '024h1IlD',
        
            'url' => 'https://dev.placetopay.com/redirection/',
        ]);
        
        $request_id = $this->params()->fromRoute('request_id');
        
        $response = $placetopay->query($request_id);
        
        if ($response->isSuccessful()) {
        
            if ($response->status()->isApproved()) {

                return new ViewModel(
                
                    ['status' => 'APPROVED']
                    
                );
                
            }
            
        } else {
            
            return new ViewModel(
            
                ['status' => $response->status()->message()]
            
            );
        }
        
    }
    
}
