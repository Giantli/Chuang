<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>主页</title>
	<link href="../../css/index.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="../../css/choosePlace.css" type="text/css">
	<script src="../../lib/js/jquery-1.11.0.min.js"></script>
</head>

<body>
	<?php 
	  	include("../../inc/header.php");
	?>

	<?php  
		require("../../services/photographyService.php");

		$areas = getAreas();

		$areaId = "";
		$versionId="";
		$pageIndex = 0;
		$pageSize = 9;
		$totalPageCount = 0;

		// 分页
		if(array_key_exists("currentPage", $_REQUEST)){
			$pageIndex = intval($_REQUEST['currentPage']);
			if($pageIndex==4){
				echo "<script> $(function(){ $('.choose-place-panel').css('height','920px')});</script>";
			}

		}

		$list = getPhotographyPackages($areaId , $versionId , $pageIndex * $pageSize , $pageSize);

		$photographyPackages = $list['photographyPackages'];

		$totalPageCount = ceil($list["totalRows"] / $pageSize);


		/*print_r($list);
		print_r($photographyPackages);*/

	?>

	<div class="page-body">

		<div class="choose-place-panel">

			<div class="nav-place">
				<div class="nav-place-choose">
					<ul>
						<!-- <li style="display: none"><a href="javascript:;" data-id="0" class="hover"></a></li> -->

						<?php  
							foreach ($areas as $index=>$area) {
						?>
								<li><a href="../photography/index.php?areaId=<?=$index + 1?>" data-id="1"><?=$area["name"]?></a></li>

						<?php	
							}
						?>
					</ul>
				</div>
			</div>

			<div style="clear: both"></div>

			<div class="con">
				<?php 
				
					foreach ($photographyPackages as $photographyPackage) {
				?>
						<div class="con-divall" onclick="getPackage(<?php echo $photographyPackage['id'] ?>)">
						<div class="con-div">
							<div class="con-div-img"><a  target="_blank"><img  src="<?='../../images/' . $photographyPackage['image']?>"></a></div>
							<div class="con-div-text">
								<div class="salename"><a  target="_blank"> <?=$photographyPackage['name']?>
									</a></div>
								<div class="price"><a  target="_blank"><?='￥' . $photographyPackage['price']?>
									</a></div>
							</div>
						</div>
				</div>
				<?php		
					}
				?>
				<div class="pages">
			 	<?php for($i = 0 ; $i < $totalPageCount; $i++) {?>
					<a href="index.php?currentPage=<?=$i?>" class="<?=$pageIndex == $i ? 'actived' : ''?>" ><?=$i + 1?></a>
			 	<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php 
	  include("../../inc/foot.php");
	?>
	<script src="../../lib/js/jquery.lazyload.min.js"></script>
	<script>
		$(function() {
			$('.nav-link a:eq(2)').css('color','red');
			$("img").lazyload({effect: "fadeIn"});
		});
		function getPackage(id){
			window.location.href='photographyDetail.php?id='+id;
		}
	</script>
</body>
</html>