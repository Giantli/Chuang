<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>主页</title>
	<link href="../../css/index.css" rel="stylesheet" type="text/css"/>
	<link href="../../css/photographyDetail.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="../../lib/js/jquery-1.11.0.min.js">
</script><script type="text/javascript" src="../../lib/js/jquery.SuperSlide.2.1.1.js"></script>
</head>

<body>
<?php
    require("../../services/photographyService.php");

    $id="";
    $areaId="";
    if(array_key_exists('id',$_REQUEST)){
        $id=$_REQUEST['id'];
    }

    $photoPackage=getPhotographyPackageById($id);
    $areaId=$photoPackage['versionId'];
    $versionPhotoPackage=getPhotographyPackageByVersion($areaId);

?>
<?php 
  include("../../inc/header.php");
?>
<div class="page-body">
	<h4 class="psd-title1"></h4>
	<h1 class="psd-title2">LASTED WEDDING最新样片</h1>
	<h4 class="psd-title3"></h4>
	<div class="psd-head">
		<div class="psd-Img">
		<img src="../../images/<?php echo $photoPackage['image'] ?>"/>
		<div class="psd-cover"><?php echo $photoPackage['name'] ?>&nbsp;&nbsp;&nbsp;￥<?php echo $photoPackage['price'] ?>  &nbsp;&nbsp;（点击可查看大图#）</div>

		</div>
		<div class="psd-info">
			<h1 style="color:#F44336;text-align:left;">PHOTO INFORMATION</h1>
			<br>
			<h4 style="color:grey;">MR RIGHT PHOTO WEDDING STUDIO</h4>
			<br>
			<h1 style="color:#F44336;font-family:'微软雅黑';text-align:left;"><?php echo $photoPackage['name'] ?></h1>
			<br>
			<h4 style="color:grey;">POST TIME:2016.05.28</h4>
			<br>
			<h2 style="color:grey;"> 套餐价格：￥<?php echo $photoPackage['price'] ?></h2>
			
			<br>
			<button class="psd-add">加入预约</button>
      <br>
      <br>
      <a href="../photographyPackage/index.php" style="color:blue;text-decoration: none;"><<返回列表</a>
       
		</div>
	</div>
	<div class="psd-mid1">
			
    <div class="psd-mid1div"><div class="psd-smallTit">系列&推荐</div></div>
    <br>
      <div class="picScroll-left">
      <div class="hd">
        <a class="prev" href="javascript:void(0)"><img src="../../images/left.png" /></a>
            <a class="next" href="javascript:void(0)"><img src="../../images/right.png"/></a>
      </div>
      <div class="bd">
        <ul class="picList">
            <?php foreach ($versionPhotoPackage as $item){ ?>
                <li>
                    <div class="pic"><a href="#"><img src="../../images/<?php echo $item['image'] ?>" /></a></div>
                    <div class="title"><a href="#"><?php echo $item['name'] ?></a></div>
                </li>
            <?php } ?>
        </ul>
      </div>
    </div>
	</div>
	<div class="psd-mid2">
			
      <div class="psd-mid2div"><div class="psd-smallTit">店长&推荐</div></div>
      <br>
       <div class="psd-midImg1">
          <p>
          <span data-text="环">环</span>
          <span data-text="球">球</span>
          <span data-text="旅">旅</span>
          <span data-text="拍">拍</span>
          <span data-text=",">,</span>
          <span data-text="私">私</span>
          <span data-text="人">人</span>
          <span data-text="订">订</span>
          <span data-text="制">制</span>
         </p>
       </div>
      <div class="psd-otherImg">
          <h4>看了又看</h4>
          <img src="../../images/tc101.jpg">
          <img src="../../images/tc301.jpg">
          <img src="../../images/tc401.jpg">
      </div>
      <br>
      <!--内容部分-->
      <div class="psd-midImgs">
        <div class="psd-midImgsTitle">
          <div>
            <a href="" style="color:#C67E12;">新店开业-免费赠送多重婚嫁大礼包</a>
            <p style="color:#C1C1C1;font-size: 14px;">MR RIGHT NEW SHOP OPENING CEREMONY PERSENT</p>
            <br>
            <p>MR RIGHT新店盛大开业送惊喜啦，内部优惠，限量升级，活动期间前88名<br>享多重婚嫁大礼包...</p>
          </div>
          <div>
            <a href="">环球旅拍-限时优惠活动</a>
            <p style="color:#C1C1C1;font-size: 14px;">MR RIGHT WEDDING IN LOVING SERVICE</p>
              <br>
            <p>限时特价，价值12000元环球旅拍，仅售9999，环球时尚爱情手札之旅;<br>环球爱恋游玩之旅...</p>
        </div>
       </div>
          <div class="psd-Titles1">
              <dd>用镜头旅行，独特视角打造婚纱大片</dd>
          </div>
          <div class="psd-midImages1">
            <img src="../../images/00(1).jpg">
            <img src="../../images/00(2).jpg">
            <img src="../../images/00(3).jpg">
          </div>
          <div class="psd-Titles1">
              <dd>千余款国际知名礼服品牌量身定制</dd>
          </div>
          <div class="psd-midImages3">
            <img src="../../images/a70.jpg">
            <img src="../../images/a80.jpg">
            <img src="../../images/b24.jpg">
          </div>
          <div class="psd-Titles1">
              <dd>专业团队,六大承诺保驾护航</dd>
          </div>
          <div class="psd-midImages2">
            <img src="../../images/flow7.png">
          </div>
      </div>
      
	</div>

	<h4 class="psd-mid3">

	<span style="color:black;display:block;height:10px;">&nbsp;&nbsp;&nbsp;&nbsp;温馨提示：档期有限，请至少提前<span style="color:blue;">3个月</span>预定拍摄档期</span>
	<br>
	<span style="color:grey;">&nbsp;&nbsp;&nbsp;&nbsp;郑重声明：该频道所展示的作品均来自MR RIGHT摄影摄影真实客户的照片，并经由客户本人同意授权发布。未经客户本人许可，任何机构不得转载用于其它商业用途。<br>
	Solemnly declare: this channel shows the works are from MR RIGHT photography photos of real customers, and through the customer I authorize release. Any institution shall not be reproduced without permission by the customer himself, used for other commercial purposes.</span>
	</h4>
    <div class="success">预订成功</div>
</div>

<div  class="psd-contact"><a href=""><img src="../../images/contact.png" width="250"></a></div>
<?php 
  include("../../inc/foot.php");
?>
<script src="../../lib/js/postbird-img-glass.min.js"></script>
<script>
    $('.nav-link a:eq(2)').css('color','red');

        //图片放大
        PostbirdImgGlass.init({
            domSelector: ".psd-Img img",
            animation: true
        });
    var success = document.querySelector('.success');
    var addCart = document.querySelector('.psd-add');

        addCart.onclick=function(){
            var photographyPackageId = location.search.substr(4);
            var memberId = sessionStorage.getItem('username');
            if(memberId == null){
                sessionStorage.setItem('photographyPackageId',photographyPackageId);
                location.href="../mycenter/login.php";
                return false;
            }
            $.get("../../interface/ordersAjax.php",{memberId:memberId,photographyPackageId:photographyPackageId,method:'photography'} ,
                function(response){
                    console.log(response);
                });
            success.style.display='block';
            setTimeout(function () {
                success.style.display = 'none';
            },3000);
        }


        
</script>
<script type="text/javascript">
    jQuery(".picScroll-left").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:3,trigger:"click"});
</script>

 
</body>
</html>