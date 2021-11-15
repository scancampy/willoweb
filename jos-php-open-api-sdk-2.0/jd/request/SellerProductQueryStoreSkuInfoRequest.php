<?php
class SellerProductQueryStoreSkuInfoRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.seller.product.QueryStoreSkuInfo";
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
                                    	                        	                                            		                                    	                   			private $skuId;
    	                        
	public function setSkuId($skuId){
		$this->skuId = $skuId;
         $this->apiParas["skuId"] = $skuId;
	}

	public function getSkuId(){
	  return $this->skuId;
	}

                                                 	                        	                                                                                                                                                                                                                                                                                                               private $storeId;
                              public function setStoreId($storeId ){
                 $this->storeId=$storeId;
                 $this->apiParas["storeId"] = $storeId;
              }

              public function getStoreId(){
              	return $this->storeId;
              }
                                                                                                                                        	                   			private $scrollId;
    	                        
	public function setScrollId($scrollId){
		$this->scrollId = $scrollId;
         $this->apiParas["scrollId"] = $scrollId;
	}

	public function getScrollId(){
	  return $this->scrollId;
	}

                        	                   			private $fetchSize;
    	                        
	public function setFetchSize($fetchSize){
		$this->fetchSize = $fetchSize;
         $this->apiParas["fetchSize"] = $fetchSize;
	}

	public function getFetchSize(){
	  return $this->fetchSize;
	}

                            }





        
 

