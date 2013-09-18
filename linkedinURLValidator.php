<?php 

/*
 * linkedinURLValidator class is used to validate the linkedin public url.
 * 
 * @package: linkedinURLValidator
 * @author: Gowri sankar <gchokeen@gmail.com>
 * @link: http://www.code-cocktail.in
 */

class linkedinURLValidator{
	
	private $url;
	private $pattern;
	private $result;
	
	public function __construct($url){			
		
		$this->url = $url;
		$this->pattern = '';
		$this->result = '';
		
	}
	

	public function validate(){
		
		if($this->is_url($this->url)){
			
			$is_customized = $this->is_customized();
			
			if($this->is_person() ||  $is_customized){
				return array('valide'=>true,'type'=>'person','customized'=>$is_customized);
			}
			else if($this->is_company()){
				
				return array('valide'=>true,'type'=>'company');
			}
			else{
				return array('valide'=>false);
			}
			
		}
		else{
			return array('valide'=>false);
		}
		
	}
	
	public function is_person(){
		
		$this->pattern = '/((http?|https)\:\/\/)?www.linkedin.com\/[a-z]{2}\/[a-zA-Z0-9]{5,30}/i';
		
		preg_match($this->pattern, $this->url, $this->result);
		
		return $this->result;
	}
	
	public function is_company(){
		
		$this->pattern = '/((http?|https)\:\/\/)?www.linkedin.com\/company\//i';
		
		preg_match($this->pattern, $this->url, $this->result);
		
		return $this->result;		
		
	}
	
	/*
	 * @return: 0-not customized, 1 - customized
	*/	
	public function is_customized(){

		$this->pattern = '/((http?|https)\:\/\/)?www.linkedin.com\/pub\//i';
		
		preg_match($this->pattern, $this->url, $this->result);
		
		
		return (count($this->result)!=0?0:1);		
		
	}
	
	private function is_url($url){
	
		if(filter_var($url, FILTER_VALIDATE_URL) === FALSE)
		{
			return false;
		}else{
			return true;
		}
	}	
		
}


?>