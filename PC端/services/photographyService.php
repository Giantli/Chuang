<?php
    require_once("dbHelper.php");

/**
 * 获取分类地区列表
 * 返回值：执行成功，返回地区列表数组； 执行失败，返回null;
 */
    function getAreas(){
        $sql = "select id , name from areas";
        $result = executeQuery($sql);
        $list=null;
        if($result){
            $list = [];
            foreach ($result as $item) {
                $list[] = [
                    "id" => $item[0],
                    "name" => $item[1]
                ];
            }
            return $list;
        }
        return $list;
    }
/**
 * 获取套餐列表
 * 返回值：执行成功，返回用户列表数组；执行失败，返回null
 */

    function getPhotographyPackages($areaId="",$versionId="",$startIndex="",$pageSize=""){
        $sql1="select t1.id,t2.name,t3.name,t1.name,t1.price,t1.image from photographypackage t1 INNER JOIN areas t2 ON t1.areaId=t2.id INNER JOIN 
         photographyversion t3 on t1.versionId=t3.id WHERE 1=1";
        $sql2="select count(1) from photographypackage t1 INNER JOIN areas t2 ON t1.areaId=t2.id INNER JOIN 
         photographyversion t3 on t1.versionId=t3.id WHERE 1=1";
        if(""!=$areaId){
            $sql1.=" and '{$areaId}'=t2.id ";
            $sql2.=" and '{$areaId}'=t2.id ";
        }
        if(""!=$versionId){
            $sql1.=" and '{$versionId}'=t2.id ";
            $sql2.=" and '{$versionId}'=t2.id ";
        }
        if(""!= $startIndex&&""!= $pageSize){
            $sql1.=" limit {$startIndex},{$pageSize};";
        }
        else{
            $sql1.=";";
        }
        $sql=$sql1.$sql2;
        $list=null;
        $result=executeMultiQuery($sql);
        if(!is_null($sql)){
            $photographyPackages=[];
            foreach ($result[0] as $item){
                $photographyPackages[]=[
                    "id"=>$item[0],
                    "areaName"=>$item[1],
                    "versionName"=>$item[2],
                    "name"=>$item[3],
                    "price"=>$item[4],
                    "image"=>$item[5]
                ];
            }
            $list['photographyPackages']=$photographyPackages;
            $list['totalRows']=$result[1][0][0];
        }
        return $list;

    }
/**
 * 获取单个套餐
 * 返回值：执行成功，返回单个套餐；执行失败，返回null
 */
    function getPhotographyPackageById($id){
        $sql="select t1.id,t1.versionId,t2.name,t3.name,t1.name,t1.price,t1.image from photographypackage t1 INNER JOIN areas t2 ON t1.areaId=t2.id INNER JOIN 
         photographyversion t3 on t1.versionId=t3.id WHERE t1.id='{$id}'";
        $result=executeQuery($sql);
        if($result){
            $list=[];
            foreach ($result as $item){
                $list=[
                    "id"=>$item[0],
                    "versionId"=>$item[1],
                    "areaName"=>$item[2],
                    "versionName"=>$item[3],
                    "name"=>$item[4],
                    "price"=>$item[5],
                    "image"=>$item[6]
                ];
            }
            return $list;
        }
        return false;
    }
/**
 * 获取套餐版本
 * 返回值：执行成功，返回套餐列表；执行失败，返回null
 */
    function getPhotographyPackageByVersion($areaid){
        $sql="select t1.id,t2.name,t3.name,t1.name,t1.price,t1.image from photographypackage t1 INNER JOIN areas t2 ON t1.areaId=t2.id INNER JOIN 
             photographyversion t3 on t1.versionId=t3.id WHERE t1.versionId='{$areaid}'";
        $result=executeQuery($sql);
        if($result){
            $list=[];
            foreach ($result as $item){
                $list[]=[
                    "id"=>$item[0],
                    "areaName"=>$item[1],
                    "versionName"=>$item[2],
                    "name"=>$item[3],
                    "price"=>$item[4],
                    "image"=>$item[5]
                ];
            }

            return $list;
        }
        return false;
    }
/**
 * 获取各个地区客照
 * 参数： 给定一个id，获取对应地区的客照。给定分页的索引和每页显示个数
 * 返回值：执行成功，返回地区客照列表数组； 执行失败，返回null;
 */
function getPhotography($areaId = ""){
    $sql="select t1.id,t1.name,t2.name,t1.images,t1.time from photography t1 INNER JOIN areas t2 on t1.areaId=t2.id where 1=1";
    if(""!=$areaId){
        $sql.=" and t1.areaId='{$areaId}'";
    }
    $result=executeQuery($sql);
    $list=null;
    if(!is_null($result)){
        $list=[];
        foreach($result as $item){
            $list[]=[
                "id"=>$item[0],
                "name"=>$item[1],
                "areaName"=>$item[2],
                "image"=>explode(",",$item[3]),
                "time"=>$item[4]
            ];
        }
        return $list;

    }
    return $list;

}




/**
 * 获取各个地区客照
 * 参数： 给定一个id，获取对应地区的客照。给定分页的索引和每页显示个数
 * 返回值：执行成功，返回地区客照列表数组； 执行失败，返回null;
 */
    function getPhotographyHome($id="",$startIndex =0 , $pageSize = 5){
        $sql1 = "select t1.id 

     , t1.name ,t1.areaId

     , t1.images , t1.time,t2.name 

     from photography t1
                     INNER JOIN areas t2 on t1.areaId=t2.id 

     where 1=1";
        $sql2="select count(1) from photography where 1=1";

        if("" != $id){
            $sql1 .= " and t1.id 

    =$id";
        }
        $sql1 .= " limit {$startIndex} , {$pageSize};";
        $sql = $sql1 . $sql2;

        $result = executeMultiQuery($sql);
        $list = null;
        if(!is_null($result)){
            $lists = [];
            foreach ($result[0] as $item) {
                $lists[] = [
                    "id" => $item[0],
                    "name" => $item[1],
                    "areaId"=>$item[2],
                    "images" => explode(',',$item[3]),
                    "time" => $item[4],
                    "areaName"=>$item[5]

                ];
            }
            $list["photoGraphy"] = $lists;
            $list["totalRows"] = $result[1][0][0];
        }

        return $list;
    }