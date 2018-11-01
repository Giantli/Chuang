<?php 
	require_once("dbHelper.php");

	/**
	* 获取用户列表(后台管理平台)
	* 参数：$key="",$startIndex=0,$pageSize=12
	* 返回值：执行成功，返回用户列表数组；执行失败，返回null
	*/
	function getAllMembers($key="",$startIndex=0,$pageSize=12){
		$sql1="select id,phone,header,nickname from members where 1=1";
		$sql2="select count(1) from members";
		if(""!=$key){
            $sql1.=" and INSTR(name,'{$key}')>0 or INSTR(phone,'{$key}')>0 ";
            $sql2.=" and INSTR(name,'{$key}')>0 or INSTR(phone,'{$key}')>0 ";
        }
        $sql1.=" limit {$startIndex},{$pageSize};";
        $sql=$sql1.$sql2;
		$result=executeMultiQuery($sql);
		$list=null;
		if(!is_null($result)){
            $members=[];
            foreach ($result[0] as $item){
                $members[]=[
                    "id"=>$item[0],
                    "phone"=>$item[1],
                    "header"=>$item[2],
                    "nickname"=>$item[3]
                ];
            }
            $list['members']=$members;
            $list['totalRows']=$result[1][0][0];
        }
        return $list;
	}



	/**
	* 用户登录
	* 参数：手机号phone , 密码password
	* 返回值：执行成功，返回用户信息列表数组；用户名密码错误，返回null ；执行失败，返回FALSE，联系管理员
	*/
	function login($phone, $password){

		$password = md5($password);

		$sql = "select id , phone , header , nickName from members where phone = '{$phone}' and password = '{$password}'";

		$result = executeQuery($sql);

		// print_r($result);

		if(is_bool($result)){
			return false;
		}
	
		$list = null;
		foreach ($result as $item) {
			$list = [
				"id" => $item[0],
				"phone" => $item[1],
				"header" => $item[2],
				"nickname" => $item[3]
			];
		}
		return $list;
	}

	/**
	* 用户注册
	* 参数：手机号phone , 昵称nickName ，密码password
	* 返回值：注册成功：返回影响行数1；信息格式不正确返回0；手机号已注册返回-1；数据库错误返回FALSE
	*/
	function register($id , $phone , $nickName , $password){


		$phone = format($phone);

		$nickName = format($nickName);

		$password = format($password);

		if(!preg_match('/^1[3578]\d{9}$/' , $phone)){//>电话号码长度为11位的数字，必须以18、13、15、17开头
			return 0;
		}
		else{
			$checkPhone = executeQuery("select * from members where phone = '{$phone}'");//电话号码是否注册

			if($checkPhone){
				return -1;
			}
		}

		if(!preg_match("/^[A-Za-z][0-9A-Za-z]{3,19}$/" , $nickName)){//用户名必须是长度为4-20位的字母、数字的组合,并且以字母开头
			return 0;
		}

		if(!preg_match('/^\S{6,12}$/', $password)){//密码为6-12位的非空白字符
			return 0;
		}

		$password = md5($password);

		$sql = "insert into members(id , password , phone , nickname) value('{$id}' , '{$password}' , '{$phone}' , '{$nickName}')";

        //$list = "select id , phone , nickname , header from members where phone = '{$phone}'";
		return executeNonQuery($sql); //成功返回1
	}
//验证
function format($data){
    $data = trim($data);
    $data = stripcslashes($data);//去除反斜杠
    $data = htmlspecialchars($data);//转化为html实体

    return $data;
}
	/**
	* 修改密码
	* 参数：用户名id , 旧密码oldPassword , 密码newPassword
	* 返回值：修改成功返回影响行数1， 修改失败返回FALSE
	*/
	function updatePassword($id , $oldPassword , $newPassword){
        $newPassword = format($newPassword);

        if(!preg_match('/^\S{6,12}$/', $newPassword)){//密码为6-12位的非空白字符
            return 0;
        }

		$oldPassword = md5($oldPassword);
		$newPassword = md5($newPassword);

		$sql = "update managers set password = '{$newPassword}' where id = '{$id}' and password = '{$oldPassword}'";

		return executeNonQuery($sql);
	}

    /**
     * 修改手机号
     * 参数：用户名id , 旧密码oldPassword , 密码newPassword
     * 返回值：修改成功返回影响行数1， 修改失败返回FALSE
     */
    function updatePhone($id , $phone){
        $phone = format($phone);

        if(!preg_match('/^1[3578]\d{9}$/' , $phone)){//>电话号码长度为11位的数字，必须以18、13、15、17开头
            return 0;
        }
        else{
            $checkPhone = executeQuery("select * from members where phone = '{$phone}'");//电话号码是否注册

            if($checkPhone){
                return -1;
            }
        }

        $sql = "update members set phone = '{$phone}' where id = '{$id}'";

        return executeNonQuery($sql);

    }

    /*修改昵称*/
    function updateNickname($id , $nickname){
        $nickname = format($nickname);

        if(!preg_match("/^[A-Za-z][0-9A-Za-z]{3,19}$/" , $nickname)){//用户名必须是长度为4-20位的字母、数字的组合,并且以字母开头
            return 0;
        }

        $sql = "update members set nickname = '$nickname' where id = '{$id}'";

        return executeNonQuery($sql);

    }

	/**
	* 更新用户信息
	* 参数：用户信息数组$member
	* 返回值：修改成功返回影响行数1， 修改失败返回FALSE
	*/
	function updateMemberMessage($member){
		$sql = "update members set phone = '{$member["phone"]}' , nickname = '{$member["nickName"]}' , header = '{$member["header"]}' where id = '{$member["id"]}'";

		return executeNonQuery($sql);

	}

	/**
	* 获取当前用户信息
	* 参数：id
	* 返回值：修改成功返回影响行数1， 修改失败返回FALSE
	*/
	function getMemberById($id=""){
		$sql="select id , phone , nickname , header from members where id = '{$id}'";

		$result=executeQuery($sql);
		$list=null;
		if($result){
			// print_r($result);
			$list = [
				"id" => $result[0][0],
				"phone" => $result[0][1],
				"nickName" => $result[0][2],
				"header" => $result[0][3]
			];
				
			
			return $list;
		}
		return $list;
	}


	/*测试*/

	/*$res = register("18852981716" , "a1asd" , "123456");
	print_r($res) ;

	if(0 == $res){
		echo "参数错误";
	}
	elseif (-1 == $res) {
		echo "手机号已注册";
	}
	elseif (is_bool($res)) {
		echo "500";
	}
	else{
		echo "succed";
	}

	$list = [];

	if(is_null($list)){
		echo "null";
	}*/
