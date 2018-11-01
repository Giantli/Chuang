<?php
header("Content-type:application/json;charset=utf-8");

header("Access-Control-Allow-Origin:*"); //*号表示所有域名都可以访问
header("Access-Control-Allow-Method:POST,GET");

require_once("../services/ordersService.php");
require_once("util/constants.php");

$method = $_REQUEST["method"];

if(!array_key_exists("method", $_REQUEST)){
    echo json_encode(buildResponseResult(CODE_PARAM_INVALID , MESSAGE_PARAM_INVALID));
    exit();
}

$method = strtolower($method);

$result = buildResponseResult(CODE_RESPONSE_FAILURE , MESSAGE_RESPONSE_FAILURE);

if($method == "weddingdresslist"){

    $id=$_REQUEST["id"];

    $list= getWeddingDressOrders($id);
    $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $list);
}

if($method == "photographylist"){

    $id=$_REQUEST["id"];

    $list= getPhotographyOrders($id);
    $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $list);
}

if($method == "weddress"){
    $size= $_REQUEST["size"];
    $amount = $_REQUEST["amount"];
    $id=$_REQUEST["id"];
    $user=$_REQUEST["user"];

    $list= weddingDressOrders($id,$amount,$size,$user);
    $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $list);
}

if($method == "photography"){
    $memberId = $_REQUEST["memberId"];
    $photographyPackageId = $_REQUEST["photographyPackageId"];

    $list= photographyOrders($memberId , $photographyPackageId);
    $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $list);
}

/*完成*/
if($method=='weddressdelete'){
    $wedId=$_REQUEST["wedId"];
    $list=deleteWeddingDressOrders($wedId);
    $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $list);
}

/*完成*/
if($method=='wedphodelete'){
    $phoId=$_REQUEST["phoId"];
    $list=deleteWeddingPhoOrders($phoId);
    $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $list);
}


if($method=='weddresscancel'){
    $wedId=$_REQUEST["wedId"];
    $list=cancelWeddingDressOrders($wedId);
    $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $list);
}

if($method=='wedphocancel'){
    $phoId=$_REQUEST["phoId"];
    $list=cancelWeddingPhoOrders($phoId);
    $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $list);
}

/*删除*/
if($method=='deleteweddingdressorders'){
    $wedId=$_REQUEST["wedId"];
    $list=deleteWDOrders($wedId);
    $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $list);
}

if($method=='deletephotographyorders'){
    $phoId=$_REQUEST["phoId"];
    $list=deletePgpOrders($phoId);
    $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $list);
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