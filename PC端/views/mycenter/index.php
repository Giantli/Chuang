<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人中心</title>
	<link href="../../css/index.css" rel="stylesheet" type="text/css"/>
</head>

<body>
	<?php 
	    include("../../inc/header.php");
	    include("../../services/ordersService.php")
	?>
	<script>var id = sessionStorage.getItem('username');</script>
	<?php
	// $id = "<script>document.write(id);</script>";

	// var_dump($id);

	$userId = $_GET['userId'];

	if(!$userId){
	    echo "<script language='javascript'>

			var userId = sessionStorage.getItem('username'); 

			location.href='?userId='+userId; 

			</script>";
	}

	//根据用户Id获取婚纱订单列表
	$weddingList = getWeddingDressOrders($userId);
	// var_dump($userId);

	//根据用户Id获取摄影订单列表
	$photographyList = getPhotographyOrders($userId);

	$photographyOrders = $photographyList['photographyOrders'];

	//var_dump($photographyOrders);

	?>
	<div class="page-body">
    <div class="page2">
        <div class="man"></div>
        <a id="login-btn" href="login.php">立即登录</a>

        <div class="woman"></div>
    </div>
    <!-- page1 start-->
    <div class="page1" style="display:none">
        <div class="center-left">
            <div class="center-left-title">
                <h2>我的个人中心</h2>
            </div>
            <div class="header">
                <img src="../../images/header2.png" width="80%">
            </div>
            <div class="username"></div>
            <ul>
                <li class="actived1"><a class="actived">个人信息</a></li>
                <li><a>婚纱预订</a></li>
                <li><a>摄影预约</a></li>
                <li><a>注销账号</a></li>
            </ul>
        </div>
        <div class="center-outer">
            <div class="center-right">
                <div class="single-info">
                    <div class="single-info-title"></div>
                    <div class="image">
                        <img src="../../images/header2.png" width="400"/>
                    </div>
                    <div class="info">
                        <b id="nickname">昵称：</b><br/>
                        <b id="phone">手机号：</b><br/>
                    </div>
                </div>
                <div class="buy-dress">
                    <div class="single-info-title"></div>
                    <!-- 列表 -->
                    <div class="cart">
                        <div>
                            <h2>婚纱预订列表</h2>
                        </div>
                        <div class="cart-info">
                            <div class="cart-head">
                                <div class="cart-image">图片</div>
                                <div class="cart-name">名称</div>
                                <div class="cart-amount">数量</div>
                                <div class="cart-price">单价</div>
                                <div class="cart-price">尺寸</div>
                                <div class="cart-count">操作</div>
                            </div>

                            <div class="cart-lists">
                                <?php   foreach($weddingList['weddingDressOrders'] as $value){?>
                                <div>
                                    <div>
                                        <img src="../../images/<?=$value['weddingDressImage'][0]?>" width="80px"
                                             height="100px">
                                    </div>
                                    <div><?=$value['weddingDressName']?></div>
                                    <div><?=$value['amount']?></div>
                                    <div><?=$value['price']?></div>
                                    <div><?=$value['size']?></div>
                                    <div>
                                        <button type="button"
                                                onclick="deleteWed(this)" value="<?=$value['id']?>">
                                            取消
                                        </button>
                                    </div>
                                </div>

                                <?php } ?>
                            </div>

                        </div>
                    </div>
                    <!-- end -->
                </div>
                <div class="buy-photo">
                    <div class="single-info-title"></div>
                    <!-- 列表 -->
                    <div class="cart">
                        <div>
                            <h2>摄影预订列表</h2>
                        </div>
                        <div class="cart-info">
                            <div class="cart-head">
                                <div class="cart-image">图片</div>
                                <div class="cart-name">名称</div>
                                <!-- <div class="cart-amount">数量</div> -->
                                <div class="cart-price">单价</div>
                                <div class="cart-count">操作</div>
                            </div>

                            <div class="cart-lists">
                                <?php   foreach($photographyOrders as $photographyOrder){?>
                                <div>
                                    <div>
                                        <img src="../../images/<?=$photographyOrder['image']?>" width="120px"
                                             height="200px">
                                    </div>
                                    <div><?=$photographyOrder['photographyPackageName']?></div>
                                    <!-- <div><?=$photographyOrder['amount']?></div> -->
                                    <div><?=$photographyOrder['price']?></div>
                                    <div>
                                        <button class="del-btn" type="button"
                                                onclick="deletePho(this)" value="<?=$photographyOrder['id']?>">
                                            取消
                                        </button>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                    <!-- end -->
                </div>

            </div>
        </div>
    </div>
    <!-- page  end -->
</div>
	<script src="../../js/jquery.min.js"></script>
	<?php 
	  include("../../inc/foot.php");
	?>


	<script>
//        删除婚纱
        function deleteWed(obj) {
            var self=obj;
            var wedId = obj.value;
            console.log(wedId);
            $.ajax({
                type:'POST',
                url:'../../interface/ordersAjax.php?method=weddressDelete',
                data:{wedId:wedId},
                success:function(response){
                    console.log(response);
                    obj.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode);
                }
            })
        }
//删除摄影
function deletePho(obj) {
    var self=obj;
    var phoId = obj.value;
    $.ajax({
        type:'POST',
        url:'../../interface/ordersAjax.php?method=wedphoDelete',
        data:{phoId:phoId},
        success:function(response){
            console.log(response);
            obj.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode);
        }
    })
}



        window.onload = function(e){
		$('.nav-link a:eq(5)').css('color','red');
	    var value = sessionStorage.getItem("username");
	    var page1 = document.querySelector('.page1');
	    var page2 = document.querySelector('.page2');
	    if(value!=null){
			page1.style.display = 'block';
			page2.style.display = 'none';
		}

		var lists = document.querySelectorAll('.center-left ul a');


		var infoboxs = document.querySelectorAll('.center-right>div');
            lists[3].addEventListener('click',function(){
                sessionStorage.removeItem('username');
                sessionStorage.removeItem('weddingdressId');
                sessionStorage.removeItem('photographyPackageId');
                location.href='login.php';
            },false);



		infoboxs[1].style.display = 'none';
		infoboxs[2].style.display = 'none';
		for(var i = 0 ; i < lists.length; i ++){
			lists[i].index = i;
			lists[i].onclick = function(e){
				var preList = document.querySelector(".actived");
				lists[preList.index].className = "";
				this.className ='actived';
	            if(this.index!==3){
	            	for(var j = 0 ; j < infoboxs.length; j ++){
					infoboxs[j].style.display = 'none';
					 infoboxs[this.index].className ="";
				}
	            infoboxs[this.index].style.display = 'block';
	            }
				

			}
		}
		var user = JSON.parse(sessionStorage.getItem('user'));
		var username = document.querySelector('.username');
		var nick = document.querySelector('#nickname');
		var phone = document.querySelector('#phone');
		console.log(user);
		console.log(nick);
		username.innerText = user.nickname +'的个人中心';
		nick.innerText += user.nickname;
	    phone.innerText += user.phone;
	}
	</script>
</body>
</html>