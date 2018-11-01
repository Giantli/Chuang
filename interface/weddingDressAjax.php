<?php
    header("Content-type:application/json;charset=utf-8");

    header("Access-Control-Allow-Origin:*"); //*号表示所有域名都可以访问
    header("Access-Control-Allow-Method:POST,GET");

    require_once("../services/weddingDressService.php");
    require_once("util/constants.php");

    // 处理对weddingDress对象的操作

    $methodList = ["list" , "create" , "edit" , "id"];

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
    * 获取所有weddingDress,参数无
    */
    if($method == "list"){

        $weddingDress = getWeddingDresses();

        if(!is_null($weddingDress)){
            $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $weddingDress);
        }
    }

    /*
     * 获取特定weddingDress,参数：id
     * */
    if($method == "id"){

        $id = $_GET['id'];

        $weddingDress = getDressById($id);

        if(!is_null($weddingDress)){
            $result = buildResponseResult(CODE_RESPONSE_SUCCESS , MESSAGE_RESPONSE_SUCCESS , $weddingDress);
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