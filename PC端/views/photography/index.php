<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>主页</title>
	<link href="../../css/index.css" rel="stylesheet" type="text/css"/>
	<link href="../../css/ps.css" rel="stylesheet" type="text/css"/>
	
	<!--必要样式-->
	<link rel='stylesheet prefetch' href='../../lib/css/slick.min.css'>
	<link rel='stylesheet prefetch' href='../../lib/css/slick-theme.min.css'>
	<link type="text/css" href="../../lib/css/jq22.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../lib/css/bootstrap.min.css"/>

    <!--脚本-->
    <script src="../../lib/js/jquery-1.11.0.min.js"></script>

</head>
<body>
<?php 
  	include("../../inc/header.php");
?>
<?php 
     require("../../services/photographyService.php")
 ?>
<?php 
//获取所有的照片

	$areas=getAreas();
	$areaId=1;
	if(array_key_exists('areaId',$_REQUEST)){
		$areaId=$_REQUEST['areaId'];
		echo "<script> $(function(){ $('html, body').animate({ scrollTop: $('.ps-main').offset().top },0); }) </script>";
	} 
	$list=[];
    //获取信息
	$list=getPhotography($areaId);
 ?>
<div class="page-body" id="main">

	<h2 class="ps-title">最新客照，没有最美只有更美！</h2>
	<div class="slideshow">
		 <div class="slider">
		    <div class="item">
				<img src="../../images/ps3.jpg" />
			</div>
			<div class="item">
				<img src="../../images/lunbo5.jpg" />
			</div>
			<div class="item">
				<img src="../../images/lunbo6.jpg" />
			</div>
			<div class="item">
				<img src="../../images/lunbo4.jpg" />
			</div>
		</div>
	</div>
	<div class="ps-body">

		<div class="ps-nav" id="psBody">
			<div>
				<span class="ps-navtitle1">拍摄场景</span>
				<br>
				<span class="ps-navtitle2">CUSTOMER WEDDING PHOTOS</span>
				<br>
				<hr>
				<hr style="width:50%;margin-left:25%;margin-top:-21px;height:3px;border:none;border-top:3px solid #F44336;"/>
			</div>
			<ul>
				<?php 
					foreach ($areas as $item) {
				 ?>
				<li>
					<a href="index.php?areaId=<?php echo $item['id']?>"
					   style="<?php echo $item['id']==$areaId ? "background-color:#f44336;color:white;":"";  ?>">
				    <?php echo $item['name'];?>	
				</a>
				</li>

				<?php 
				}
				?>

			</ul>
		</div>

		<div class="ps-main" id="psMain">

			<?php 
				foreach ($list as $item) {
					foreach($item['image'] as $index=>$value){		
			 ?>
		 	
	          <img class="lazy" data-original="../../images/<?php echo $item['image'][$index]?>"/>

	        <?php 
			    }}
	         ?>
	            
		</div>	
	</div>


<!-- 锚链接，回到顶部 -->
<div id="tbox">

	<a id="gotop" href="javascript:void(0)"></a>
	<a id="jianyi" target="_blank" href="http://www.jq22.com"></a>

</div>

<!-- 代码结束 -->

<!-- --><?php
//   include("../../inc/foot.php");
//?>

    <script type="text/javascript" src='../../lib/js/jquery.easing.min.js'></script>
	<script type="text/javascript" src='../../lib/js/slick.min.js'></script>
	<script type="text/javascript" src='../../js/ps.js'></script>
	<script type="text/javascript" src="../../lib/js/jquery-1.11.0.min.js"></script>
	<script src="../../lib/js/jquery.lazyload.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function(){
			$('.lazy').lazyload({effect:"fadeIn"});
		});
		$('.nav-link a:eq(3)').css('color','red');
	</script>
</body>
</html>