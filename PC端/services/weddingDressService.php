<?php 
	require_once("dbHelper.php");
	/**
	* 获取婚纱摆型列表
	* 返回值：执行成功，返回地区列表数组； 执行失败，返回null;
	*/

	function getPendulums(){
		$sql="select id,name from pendulum";
		$result=executeQuery($sql);
		$list=null;
		if($result){
			$list=[];
			foreach($result as $item){
				$list[]=[
					"id"=>$item[0],
					"name"=>$item[1]
				];

			}
			return $list;
		}
		return $list;
	}

	/**
	* 获取婚纱款式列表
	* 返回值：执行成功，返回地区列表数组； 执行失败，返回null;
	*/

	function getStyles(){
		$sql="select id,name from style";
		$result=executeQuery($sql);
		$list=null;
		if($result){
			$list=[];
			foreach($result as $item){
				$list[]=[
					"id"=>$item[0],
					"name"=>$item[1]
				];

			}
			return $list;
		}
		return $list;
	}

	/**
	* 获取婚纱列表
	* 返回值：执行成功，返回地区列表数组； 执行失败，返回null;
	*/
	function getWeddingDresses($pendulumId="",$styleId="",$startIndex="",$pageSize=""){
		$sql1="select t1.id,t1.name,t1.image,t2.name,t3.name,t1.price from weddingdress t1 INNER JOIN pendulum t2 on t1.pendulumId=t2.id INNER JOIN style t3 on t1.styleId=t3.id where 1=1 ";
		$sql2="select count(1) from weddingdress t1 INNER JOIN pendulum t2 on t1.pendulumId=t2.id INNER JOIN style t3 on t1.styleId=t3.id where 1=1";
		if(""!=$pendulumId){
            $sql1.=" and t1.pendulumId='{$pendulumId}' ";
            $sql2.=" and t1.pendulumId='{$pendulumId}' ";
        }
        if(""!=$styleId){
            $sql1.=" and t1.styleId='{$styleId}' ";
            $sql2.=" and t1.styleId='{$styleId}' ";
        }
        if(""!= $startIndex&&""!= $pageSize){
            $sql1.=" limit {$startIndex},{$pageSize};";
        }
		else{
            $sql1.=";";
		}
		$sql=$sql1.$sql2;
		$result=executeMultiQuery($sql);
		$list=null;

		if(!is_null($result)){
			$lists=[];
			foreach ($result[0] as $item) {
				$lists[]=[
					"id"=>$item[0],
					"name"=>$item[1],
					"images"=>explode(',',$item[2]),
					"pendulumName"=>$item[3],
					"styleName"=>$item[4],
					"price"=>$item[5]
				];

			}
			$list['weddingClothes']=$lists;
			$list['totalRows']=$result[1][0][0];
		}
		return $list;

	}

/**
 * 获取特定婚纱详情
 * 参数：给出婚纱对应的id
 * 返回值：不成功返回false，成功返回对应数组
 */
function getDressById($id){
    $sql="select t1.id , t1.name ,t1.image,t1.pendulumId,t1.styleId,t1.price,t2.name ,t3.name 
    FROM weddingdress t1 INNER JOIN pendulum t2 ON t1.pendulumId=t2.id 
     INNER JOIN style t3 ON t1.styleId=t3.id 
     WHERE t1.id ='$id'";
    $result = executeQuery($sql);
    if($result){
        $list = [];
        foreach($result as $item){
            $list = [
                "id"=>$item[0],
                "name"=>$item[1],
                "images"=>explode(',',$item[2]),
                "pendulumId"=>$item[3],
                "styleId"=>$item[4],
                "price"=>$item[5],
                "pendulumName"=>$item[6],
                "styleName"=>$item[7]

            ];
        }
        return $list;
    }
    return false;
}



