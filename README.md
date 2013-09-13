linkedinURLValidator
====================

linkedinURLValidator class is used to validate the linkedin public url.


##How to use


```

$validator = new linkedinURLValidator($url);

$result = $validator->validate();

if($result['valide']){
	
	echo 'Url is valide linkedin public profile url';
}
else{
	echo 'Url is not linkedin public profile url';
}


```
