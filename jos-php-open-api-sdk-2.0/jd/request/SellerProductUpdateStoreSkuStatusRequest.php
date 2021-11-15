<?php
class SellerProductUpdateStoreSkuStatusRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.seller.product.UpdateStoreSkuStatus";
	}
	
	public function getApiParas(){
	    if(empty($this->apiParas)){
            return "{}";
        }
        return json_encode($this->apiParas);
	}
	
	public function check(){
		
	}
	
	public function putOtherTextParam($key, $value){
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}

    private  $version;

    public function setVersion($version){
        $this->version = $version;
    }

    public function getVersion(){
        return $this->version;
    }
                                    	                                                 	                        	                                                                                                                                                                                                                                                                                                               private $storeId;
                              public function setStoreId($storeId ){
                 $this->storeId=$storeId;
                 $this->apiParas["storeId"] = $storeId;
              }

              public function getStoreId(){
              	return $this->storeId;
              }
                                                                                                                                                                                                                                                                                                                                              private $state;
                              public function setState($state ){
                 $this->state=$state;
                 $this->apiParas["state"] = $state;
              }

              public function getState(){
              	return $this->state;
              }
                                                                                                                                                                                                                                                                                                                                              private $skuId;
                              public function setSkuId($skuId ){
                 $this->skuId=$skuId;
                 $this->apiParas["skuId"] = $skuId;
              }

              public function getSkuId(){
              	return $this->skuId;
              }
                                                                                                                }





        
 

