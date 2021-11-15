<?php
class SellerO2ostorePageQueryStoreBaseInfoRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.seller.o2ostore.pageQueryStoreBaseInfo";
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

                        	                   			private $venderId;
    	                        
	public function setVenderId($venderId){
		$this->venderId = $venderId;
         $this->apiParas["venderId"] = $venderId;
	}

	public function getVenderId(){
	  return $this->venderId;
	}

                        	                   			private $storeCityCode;
    	                        
	public function setStoreCityCode($storeCityCode){
		$this->storeCityCode = $storeCityCode;
         $this->apiParas["storeCityCode"] = $storeCityCode;
	}

	public function getStoreCityCode(){
	  return $this->storeCityCode;
	}

                        	                   			private $pageSize;
    	                        
	public function setPageSize($pageSize){
		$this->pageSize = $pageSize;
         $this->apiParas["pageSize"] = $pageSize;
	}

	public function getPageSize(){
	  return $this->pageSize;
	}

                        	                   			private $storeId;
    	                        
	public function setStoreId($storeId){
		$this->storeId = $storeId;
         $this->apiParas["storeId"] = $storeId;
	}

	public function getStoreId(){
	  return $this->storeId;
	}

                        	                   			private $storeStreetCode;
    	                        
	public function setStoreStreetCode($storeStreetCode){
		$this->storeStreetCode = $storeStreetCode;
         $this->apiParas["storeStreetCode"] = $storeStreetCode;
	}

	public function getStoreStreetCode(){
	  return $this->storeStreetCode;
	}

                        	                   			private $inputer;
    	                        
	public function setInputer($inputer){
		$this->inputer = $inputer;
         $this->apiParas["inputer"] = $inputer;
	}

	public function getInputer(){
	  return $this->inputer;
	}

                        	                   			private $pageNo;
    	                        
	public function setPageNo($pageNo){
		$this->pageNo = $pageNo;
         $this->apiParas["pageNo"] = $pageNo;
	}

	public function getPageNo(){
	  return $this->pageNo;
	}

                        	                   			private $storeProvinceCode;
    	                        
	public function setStoreProvinceCode($storeProvinceCode){
		$this->storeProvinceCode = $storeProvinceCode;
         $this->apiParas["storeProvinceCode"] = $storeProvinceCode;
	}

	public function getStoreProvinceCode(){
	  return $this->storeProvinceCode;
	}

                        	                   			private $storeRegionCode;
    	                        
	public function setStoreRegionCode($storeRegionCode){
		$this->storeRegionCode = $storeRegionCode;
         $this->apiParas["storeRegionCode"] = $storeRegionCode;
	}

	public function getStoreRegionCode(){
	  return $this->storeRegionCode;
	}

                        	                   			private $storeName;
    	                        
	public function setStoreName($storeName){
		$this->storeName = $storeName;
         $this->apiParas["storeName"] = $storeName;
	}

	public function getStoreName(){
	  return $this->storeName;
	}

                        	                   			private $status;
    	                        
	public function setStatus($status){
		$this->status = $status;
         $this->apiParas["status"] = $status;
	}

	public function getStatus(){
	  return $this->status;
	}

                        	                            }





        
 

