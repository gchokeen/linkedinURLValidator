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

		if($this->is_person()){
			return array('valide'=>true,'type'=>'person');
		}
		else if($this->is_company()){
			
			return array('valide'=>true,'type'=>'company');
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
	
	public function is_customized(){

		$this->pattern = '/((http?|https)\:\/\/)?www.linkedin.com\/pub\//i';
		
		preg_match($this->pattern, $this->url, $this->result);
		
		return $this->result;		
		
	}
		
}



?>