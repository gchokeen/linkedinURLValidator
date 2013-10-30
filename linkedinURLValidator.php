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
				return array('valid'=>1,'type'=>'person','customized'=>$is_customized);
			}
			else if($this->is_company()){
				
				return array('valid'=>1,'type'=>'company');
			}
			else{
				return array('valid'=>0);
			}
			
		}
		else{
			return array('valid'=>0,'error'=>'This is not a valid url');
		}
		
	}
	
	public function is_person(){
		
		$this->pattern = '/((http?|https)\:\/\/)?([a-zA-Z]+)\.linkedin.com\/[a-z]{2}\/[a-zA-Z0-9]{5,30}/i';
		
		preg_match($this->pattern, $this->url, $this->result);
		
		return $this->result;
	}
	
	public function is_company(){
		
		$this->pattern = '/((http?|https)\:\/\/)?([a-zA-Z]+)\.linkedin.com\/company\/[a-zA-Z0-9]{5,30}/i';
		
		preg_match($this->pattern, $this->url, $this->result);

		return $this->result;		
		
	}
	
	
	public function  get_company_id(){
		if($result=$this->is_company()){
			
			return $lastSegment = basename(parse_url($result[0], PHP_URL_PATH));
			
		}
		else{
			return false;
		}
	}
	
	
	
	/*
	 * @return: 0-not customized, 1 - customized
	*/	
	public function is_customized(){

		$this->pattern = '/((http?|https)\:\/\/)?([a-zA-Z]+)\.linkedin.com\/pub\//i';
		
		preg_match($this->pattern, $this->url, $this->result);
		
		return (count($this->result)==0?1:0);		
		
	}
	
	private function is_url($url){
	
		if(filter_var($url, FILTER_VALIDATE_URL) === FALSE)
		{
			return false;
		}else{
			return true;
		}
	}
	
	/*
	 *convert_global_url method will convert the linkedin public url with www
	 *@method : convert_global_url
	 *
	 */
	public function convert_global_url(){

		$this->pattern = '#(https?://)?\w+\.linkedin.com(?=[/\s]|$)#i';
		
		$this->result = preg_replace($this->pattern,'http://www.linkedin.com', $this->url);
		
		return $this->result;	
	}
}


?>