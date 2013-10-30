<?php 


require_once 'linkedinURLValidator.php';

$url = 'http://www.linkedin.com/company/xxxxxxx';

$validator = new linkedinURLValidator($url);

$result = $validator->validate();


if($result['valid'] && $result['type'] == 'company'){

    echo 'Url is valid linkedin company url ';
    echo $validator->get_company_id();
}
else if($result['valid']){

    echo 'Url is valid linkedin public profile url';
}
else{
    echo 'Url is not linkedin public profile url';
}


