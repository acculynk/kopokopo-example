<!-- Given b=param1, a=param2, c=param3
The base string = "a=param2&b=param1&c=param3"
symmetric_key = Your API key from your Kopo Kopo account
signature = Base64.encode(HMAC.digest(base_string, symmetric_key, SHA1 algorithm))
The signature generated is then passed as one of the parameters in the JSON body. To verify authenticity of the request, generate the signature using the the same operation above. The two signatures should match.
 -->


<?php 


	$symmetric_key = "";	//api key here

	$params = array(
		"service_name" => "MPESA", 
	    "business_number" => "888555", 
	    "transaction_reference" => "DE45GK45", 
	    "internal_transaction_id" => 3222, 
	    "transaction_timestamp" => "2013-03-18T13:57:00Z", 
	    "transaction_type" => "Paybill",
	    "account_number" => "445534", 
	    "sender_phone" => "+254903119111", 
	    "first_name" => "John", 
	    "middle_name" => "K", 
	    "last_name" => "Doe", 
	    "amount" => 4000, 
	   "currency" => "KES", 
	);


	$base_string = implode('&', array_map(
	    function ($value, $key) {
	        if(is_array($value)){
	            return $key.'='.implode('&'.$key.'[]=', $value);
	        }else{
	            return $key.'='.$value;
	        }
	    }, 
	    $params, 
	    array_keys($params)
	));

	//set to true to output raw binary data
	//if you leave the boolean part the default is false 

	$signature = base64_encode(hash_hmac('sha1', $base_string, $symmetric_key,false));

	//use your signature  
	echo $signature;
?>