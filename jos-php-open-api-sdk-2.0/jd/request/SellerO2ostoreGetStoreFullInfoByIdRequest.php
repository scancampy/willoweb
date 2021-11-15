<?php
class SellerO2ostoreGetStoreFullInfoByIdRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.seller.o2ostore.getStoreFullInfoById";
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
                                                        		                                    	                   			private $ip;
    	                        
	public function setIp($ip){
		$this->ip = $ip;
         $this->apiParas["ip"] = $ip;
	}

	public function getIp(){
	  return $this->ip;
	}

                        	                   			private $storeId;
    	                        
	public function setStoreId($storeId){
		$this->storeId = $storeId;
         $this->apiParas["storeId"] = $storeId;
	}

	public function getStoreId(){
	  return $this->storeId;
	}

                        	                   			private $inputer;
    	                        
	public function setInputer($inputer){
		$this->inputer = $inputer;
         $this->apiParas["inputer"] = $inputer;
	}

	public function getInputer(){
	  return $this->inputer;
	}

                        	                            }





        
 

