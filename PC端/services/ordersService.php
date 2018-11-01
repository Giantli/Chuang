<?php 
	require_once("dbHelper.php");
	
	/**
	* 获取婚纱订单列表，并分页
	* 参数：用户id , 起始索引，每页显示行数
	* 返回值：婚纱列表$list['weddingDressOrders'] ， 页数$list["totalRows"]
	*/
function getWeddingDressOrders($memberId = '' , $startIndex = "" , $pageSize = ""){
    $sql1 = "select t1.id 

 , t2.phone , t3.name 

 ,t3.image, t1.time, t1.amount ,  t1.size , t1.state,t3.price from weddingdressorders t1 INNER JOIN  members t2 on t1.memberId = t2.id 

 INNER JOIN weddingdress t3 on t1.weddingClothesId = t3.id 

 where 1 = 1 ";

    $sql2 = "select count(1) from weddingdressorders t1 INNER JOIN  members t2 on t1.memberId = t2.id 

 INNER JOIN weddingdress t3 on t1.weddingClothesId = t3.id 

 where 1 = 1 ";

    if('' != $memberId){
        $sql1 .= " and t1.memberId = '{$memberId}'";
        $sql2 .= " and memberId = '{$memberId}'";
    }
    if(""!= $startIndex&&""!= $pageSize){
        $sql1.=" limit {$startIndex},{$pageSize};";
    }
    else{
        $sql1.=";";
    }
    $sql = $sql1 . $sql2;

    $result=executeMultiQuery($sql);

    $list = null;
    if($result){
        $list = [];
        $weddingDressOrders = [];
        foreach ($result[0] as $item) {
            $weddingDressOrders[] = [
                "id" => $item[0],
                "phone" => $item[1],
                "weddingDressName" => $item[2],
                "weddingDressImage"=>explode(',',$item[3]),
                "time" => $item[4],
                "amount" => $item[5],
                "size" => $item[6],
                "state" => $item[7],
                "price"=>$item[8]
            ];

        }

        $list['weddingDressOrders'] = $weddingDressOrders;

        $list["totalRows"] = $result[1][0][0];

        return $list;
    }

    return $list;
}



 /**
	* 获取摄影订单列表，并分页
	* 参数：用户id , 起始索引，每页显示行数
	* 返回值：婚纱列表$list['weddingDressOrders'] ， 页数$list["totalRows"]
	*/
	function getPhotographyOrders($memberId = '' , $startIndex = "" , $pageSize = ""){
		$sql1 = "select t1.id , t2.phone , t3.name , t1.time , t1.state , t3.image , t3.price ,t4.name area , t5.name version
                    from photographyorders t1 
                    
                    INNER JOIN  members t2 on t1.memberId = t2.id 
                    
                    INNER JOIN photographypackage t3 on t1.photographyPackageId = t3.id 
                    
                    INNER JOIN areas t4 on t3.areaId = t4.id
                    
                    INNER JOIN photographyversion t5 on t3.versionId = t5.id
                    
                    where 1 = 1";

		$sql2 = "select count(1) from photographyorders where 1=1";

		if('' != $memberId){
			$sql1 .= " and t1.memberId = '{$memberId}'";
			$sql2 .= " and memberId = '{$memberId}'";
		}


        if(""!= $startIndex&&""!= $pageSize){
            $sql1.=" limit {$startIndex},{$pageSize};";
        }
        else{
            $sql1.=";";
        }


		$sql = $sql1 . $sql2;

		$result = executeMultiQuery($sql);
		
		$list = null;

		if($result){
			$list = [];
			$photographyOrders = [];
			foreach ($result[0] as $item) {
				$photographyOrders[] = [
					"id" => $item[0],
					"phone" => $item[1],
					"photographyPackageName" => $item[2],
					"time" => $item[3],
					"state" => $item[4],
                    "image" => $item[5],
                    "price" => $item[6],
                    "area" => $item[7],
                    "version" => $item[8]
				];
			}
			$list['photographyOrders'] = $photographyOrders;

			$list["totalRows"] = $result[1][0][0];


			return $list;
		}

		return $list;
	}

	/**
	* 婚纱预定
	* 参数：婚纱Id , 数量$amount, 尺寸$size, 用户Id;
	* 返回值：成功返回1；失败返回false;
	*/
   function weddingDressOrders($weddingClothesId,$amount,$size,$memberId){
       $sql="insert into weddingdressorders(id,memberId,weddingClothesId,time,amount,size,state)
             VALUE(UUID(),'{$memberId}','{$weddingClothesId}',NOW(),{$amount},'{$size}','1');";
       return executeNonQuery($sql);
   }


   	/**
	* 摄影预约
	* 参数：婚纱Id , 数量$amount, 尺寸$size, 用户Id;
	* 返回值：成功返回1；失败返回false;
	*/
	function photographyOrders($memberId , $photographyPackageId){
		$sql = "insert into photographyorders(id , memberId , photographyPackageId , time , state) value(UUID() , '{$memberId}' , '{$photographyPackageId}' , NOW() , '1')";


		return executeNonQuery($sql);
	}

/**
 * 完成摄影订单列表
 * 参数：用户id
 */
function deleteWeddingDressOrders($wedId = ''){
    $sql="update weddingdressorders set state='0' where id='$wedId'";
    return executeNonQuery($sql);
}


function deleteWeddingPhoOrders($phoId = ''){
    $sql="update photographyorders set state='0' where id='$phoId'";
    return executeNonQuery($sql);
}

/**
 * 取消摄影订单列表
 * 参数：用户id
 */
function cancelWeddingDressOrders($wedId = ''){
    $sql="update weddingdressorders set state='-1' where id='$wedId'";
    return executeNonQuery($sql);
}


function cancelWeddingPhoOrders($phoId = ''){
    $sql="update photographyorders set state='-1' where id='$phoId'";
    return executeNonQuery($sql);
}
/**
* 删除
 */
function deleteWDOrders($wedId = ''){
    $sql="delete from weddingdressorders  where id='$wedId'";
    return executeNonQuery($sql);
}


function deletePgpOrders($phoId = ''){
    $sql="delete from photographyorders  where id='$phoId'";
    return executeNonQuery($sql);
}


