<?php
header("Content-type:application/json;charset=utf-8");

 header("Access-Control-Allow-Origin:*"); //*号表示所有域名都可以访问
 header("Access-Control-Allow-Method:POST,GET");

require_once("../services/photographyService.php");
require_once("util/constants.php");

// 处理对photography对象的操作

$methodList = ["photographypackagelist" , "photographylist" , "arealist" , "create" , "edit" , "id"];

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
 * 获取所有photographyPackage,参数无
 */
if($method == "photographypackagelist"){
    $photographyPackage = getPhotographyPackages();

    if(!is_null($photographyPackage)){
        $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $photographyPackage);
    }
}

/**
 * 获取所有photography,参数无
 */
if($method == "photographylist"){
    $areaId = $_POST["areaId"];
    $photography = getPhotography($areaId);

    if(!is_null($photography)){
        $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $photography);
    }
}

/**
 * 获取分类地区，参数无
 */
if($method == "arealist"){
    $areas = getAreas();
    if(!is_null($areas)){
        $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $areas);
    }
}

/**
 * 获取特定套餐，参数id
 * */
if($method == "id"){
    $id = $_GET["id"];
    $Photography = getPhotographyPackageById($id);
    if(!is_null($Photography)){
        $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $Photography);
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