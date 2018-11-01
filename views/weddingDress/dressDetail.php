<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>婚纱详情</title>
	<link href="../../css/dressDetail.css" rel="stylesheet" type="text/css"/>
	<link href="../../css/index.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php 
  include("../../inc/header.php");

  require("../../services/weddingDressService.php");

  $id=$_GET['id'];
  $list=getDressById($id);

  // print_r($list['images'][0]);

  $number=substr($list['id'],0,13);




?>

<div class="page-body">

	<div class="dressInfo">

		<div class="showDress">
	
			<div class="showImg">

				<img src="../../images/<?=$list['images'][0]?>">

			</div>

			<div class="littleImg">
	
				<div>
					<img src="../../images/<?=$list['images'][0]?>">

				</div>

				<div>
					<img src="../../images/<?=$list['images'][1]?>">

				</div>

				<div>
					<img src="../../images/<?=$list['images'][2]?>">

				</div>

			</div>

			
		</div>

		<div class="dressIntroduce">
	
			<div class="title">
				<?=$list['name']?>

			</div>

			<div class="price">
				<span>专柜价：</span>￥<?=$list['price']?>
			</div>

			<form action="" method="post">

			<div><label>选择尺码:</label> 
			
				<select id="wedSize">
					<option>S</option>
					<option>M</option>
					<option>L</option>
					<option>XL</option>
					<option>XXL</option>
				</select>

			</div>

			<div>
				<label>数量:</label>
				<input type="number" value="1" id="wedAmount">套
			</div>

			<div><button type="button" id="addCart">加入预订架</button></div>

			</form>

			<div class="tip">
				<p>定制周期：</p>
				<p>婚纱：20-25天左右（可加急） / 礼服：20天左右（可加急）
				温纯提示：请各位新娘提前两个月定制为宜。</p>

			</div>
			<div class="tip">
				<p>定制流程：</p>
				<p>1. 确认客户的款式、面料要求及量体信息。<br/>
				2. 按照客户需求生产制作。若生产时因生产工艺问题需修改设计，需征得客户同意后再修改。<br/>
				3. 婚纱制作完成后，先人台试穿并拍照发给客户确认。<br/>
				4. 顾客确认后寄出婚纱。快递信息可在个人中心查看。<br/>
				注：量身定制的婚纱礼服，可终身享受每年一次的免费修改尺寸服务。
			</p>

			</div>
		</div>

		<div class="dressRecommod">
			<div>热销商品推荐</div>
			<div class="hotDress">
				<img src="../../images/b80.jpg">
				<div>爱若向阳</div>
			</div>
				<div class="hotDress">
			<img src="../../images/l40.jpg">
			<div>爱若向阳</div>
			</div>
			<div class="hotDress">
			<img src="../../images/a40.jpg">
			<div>爱若向阳</div>
			</div>

		</div>

		<canvas id="myCanvas"></canvas>

	</div>
	<div class="poster">
	</div>
  <div>
  	<div class="tag">
  		<div>商品介绍</div>
  	</div>

  	<table>
  		
		<tr>
			<td>商品名称：<?=$list['name']?></td>
			<td>商品编号：<?=$number?></td>
			<td>上市时间：2017春季</td>
		</tr>
		<tr>
			<td>尺码：S，M，L，XL，XXL</td>
			<td>婚纱摆型：<?=$list['pendulumName']?></td>
			<td>婚纱款型：<?=$list['styleName']?></td>
		</tr>
  	</table>
  </div>

<div>
	<div class="tag">
  		<div>样品展示</div>
  	</div>

  	<div class="productDetail">


  		<div class="msg">
  			它不仅仅是爱情的见证，还可以连接未来，我们要让它把“爱心”带进幸福的生活里<br/>
  			感动恒久，眷恋一生
  		</div>
  		
				<div>
					<img src="../../images/<?=$list['images'][3]?>">

				</div>

				<div>
					<img src="../../images/<?=$list['images'][4]?>">

				</div>

				<div>
					<img src="../../images/<?=$list['images'][5]?>">

				</div>
  	</div>

</div>


<div class="success">预订成功</div>



</div>


<?php 
  include("../../inc/foot.php");
?>


<script type="text/javascript" src="../../lib/js/jquery-1.11.0.min.js"></script>
<script>

	$(function() { $('.nav-link a:eq(1)').css('color','red')});


var images=document.querySelectorAll('.littleImg div img');
    var showImg=document.querySelector('.showImg img');
    var canvas=document.querySelector('#myCanvas');
    var addCart=document.querySelector('#addCart');
    var success=document.querySelector('.success');
 
    
    var context=canvas.getContext('2d');
    for(var i = 0 ; i < images.length ; i ++){

            images[i].onclick = function(e){
                showImg.src = this.src;
                
            }
        }

    showImg.onmousemove= function (e) {

    	canvas.style.display="block";
        var img=showImg;
        var x= e.offsetX-100;
        var y= e.offsetY-50;
  		context.clearRect(0,0,canvas.width,canvas.height);

        context.drawImage(img,x,y,200,200,0,0,canvas.width,canvas.height);
    }

 showImg.onmouseout= function (e) {
       canvas.style.display="none";
    }

function hide(){

success.style.display='none';

}

addCart.onclick=function(){
    var size=document.querySelector('#wedSize');
	var amount=document.querySelector('#wedAmount');
    console.log(size.value);
	console.log(amount.value);
	var id=location.search.substr(4);
	console.log(id);
//	return false;

    var user=sessionStorage.getItem('username');
	if(user==null){
		sessionStorage.setItem('weddingdressId',id);
		location.href="../mycenter/login.php";
		return false;
	}
	console.log(sessionStorage.getItem('username'));

	$.get("../../interface/ordersAjax.php",{size:size.value,amount:amount.value,id:id,user:user,method:'weddress'} ,
		function(response){
		console.log(response);
//		if(response.code == 100){
//			var list = response.data;
//			console.log(list);
//		}
	});
success.style.display='block';
setTimeout('hide()',3000);
}
</script>















</body>
</html>