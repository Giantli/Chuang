<?php
	header("Content-type:application/json;charset=utf-8");

	header("Access-Control-Allow-Origin:*"); //*号表示所有域名都可以访问
    header("Access-Control-Allow-Method:POST,GET");

	require_once("../services/membersService.php");
	require_once("util/constants.php");

	// 处理对members对象的操作

	$methodList = ["login" , "register" , "create" , "editphone" , "editpassword" , "editnickname"];

	$method = $_REQUEST["method"];

	if(!array_key_exists("method", $_REQUEST)){
		echo json_encode(buildResponseResult(CODE_PARAM_INVALID , MESSAGE_PARAM_INVALID));
		exit();
	}

	$method = strtolower($method);

	if(!in_array($method , $methodList)){

		echo json_encode(buildResponseResult(CODE_REQUEST_NOT_FOUND , MESSAGE_REQUEST_NOT_FOUND));
		exit();
	}


	$result = buildResponseResult(CODE_RESPONSE_FAILURE , MESSAGE_RESPONSE_FAILURE);

	/**
	* 登录时传递参数：phone , password
	*/
	if($method == "login"){
		$phone = $_POST["phone"];
		$password = $_POST["password"];

		$login = login($phone, $password);

		if(!is_null($login)){
			$result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $login);
		}
	}

	/**
	* 注册时传递参数：phone , nickName , password 
	*/
	if($method == "register"){
		$phone = $_REQUEST["phone"];
		$password = $_REQUEST["password"];
		$nickname = $_REQUEST["nickname"];

        $id = md5(uniqid().microtime());

		$register = register($id , $phone , $nickname , $password);

		if(0 == $register){
		   $result =  buildResponseResult(CODE_PARAM_INVALID , MESSAGE_PARAM_INVALID);
		}
		elseif (-1 == $register) {
			$result =  buildResponseResult(CODE_RESPONSE_FAILURE , MESSAGE_PARAM_EXISTS);
		}
		elseif(1 == $register){
            $register = [
                'id'=>$id,
                'nickname'=>$nickname,
                'phone'=>$phone
            ];
			$result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $register);
		}
	}


	/*修改手机号*/
	if($method == "editphone"){
        $phone = $_REQUEST["phone"];
        $id = $_REQUEST["id"];

        $edit = updatePhone($id , $phone);

        if(0 == $edit){
            $result =  buildResponseResult(CODE_PARAM_INVALID , MESSAGE_PARAM_INVALID);
        }
        elseif (-1 == $edit) {
            $result =  buildResponseResult(CODE_RESPONSE_FAILURE , MESSAGE_PARAM_EXISTS);
        }
        elseif(1 == $edit){
            $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $edit);
        }
    }

    /*修改密码*/
    if($method == "editpassword"){
        $oldPassword = $_REQUEST["oldPassword"];
        $newPassword = $_REQUEST["newPassword"];
        $id = $_REQUEST["id"];

        $edit2 = updatePassword($id , $oldPassword , $newPassword);

        if(!is_null($edit2)){
            $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $edit2);
        }
    }




    /*修改昵称*/
    if($method == "editnickname"){
        $nickname = $_REQUEST["nickname"];

        $id = $_REQUEST["id"];

        $edit1 = updateNickname($id , $nickname);

        if(!is_null($edit1)){
            $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $edit1);
        }
    }

echo json_encode($result);

	/**返回值**/

	function buildResponseResult($code , $msg , $data = null){
		return [
			"code" => $code,
			"message" => $msg,
			"data" => $data
		];
	}