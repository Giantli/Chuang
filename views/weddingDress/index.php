<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>婚纱定制</title>
	<link href="../../css/wrapper.css" rel="stylesheet" type="text/css"/>
	<link href="../../css/index.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/weddingDress.css" rel="stylesheet" type="text/css"/>
    <script src="../../lib/js/jquery-1.11.0.min.js"></script>
</head>

<body>
<?php

    require("../../services/weddingDressService.php");

    $result=getPendulums();

    $style=getStyles();


    $pendulumId="";

    $styleId="";
    if(array_key_exists("pendulumId",$_REQUEST)){
        $pendulumId=$_REQUEST['pendulumId'];
    }
    else{
        $pendulumId="";
    }

    if(array_key_exists("styleId",$_REQUEST)){
        $styleId=$_REQUEST['styleId'];
    }
    else{
        $styleId="";
    }



    $pageIndex=0;

    $pageSize=12;

    $totalPageCount = 0;


    if(array_key_exists("currentPage" , $_REQUEST)){
        $pageIndex = intval($_REQUEST["currentPage"]);
    }
    if(array_key_exists("currentPage" , $_REQUEST)||array_key_exists("styleId",$_REQUEST)||array_key_exists("pendulumId",$_REQUEST)){
        echo "<script> $(function(){ $('html, body').animate({scrollTop: $('.diy-tip').offset().top }, 0); })</script>";
    }



    $list=getWeddingDresses($pendulumId,$styleId,$pageIndex * $pageSize,$pageSize);


    $totalPageCount = ceil($list["totalRows"] / $pageSize);



?>
<?php 
  include("../../inc/header.php");

  echo "<script>$(function() { $('.nav-link a:eq(1)').addClass('actived'); });</script>";
?>








<div class="page-body">
<!--   <div class="diy-pic">
  	</div> -->



<div class="wrapper">
  <div class="cols">
    <div class="col" ontouchstart="this.classList.toggle('hover');">
      <div class="container">
        <div class="front">
          <div class="inner">
            <p>水岸</p>
                  <span>行到水穷处，心细嗅蔷薇</span>
          </div>
        </div>
        <div class="back">
          <div class="inner">
            <p>远方不远，与此岸相邻</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<div class="diy-tip"><p>梦幻一针一线堆积一件有生命的嫁纱 在爱情的长跑里  怎能少了“它”的见证</p>
	<p>I have a dream accumulation in the love life of the marriage yarn running in how little it witnessed</p>

</div>


<div class="diy-type">
	<div>
		<span>款式：</span>
        <a class="<?php echo $styleId==''?'actived':'' ?>" href="index.php?pendulumId=<?php echo $pendulumId ?>" >全部款式</a>

		<?php foreach ($result as $item){ ?>
            <a class="<?php echo $item['id']==$styleId?'actived':'' ?>" href="index.php?styleId=<?php echo $item['id'] ?>&pendulumId=<?php echo $pendulumId ?>"><?php echo $item["name"]; ?></a>
    <?php } ?>

	</div>
	<div>
		<span>摆形：</span>
        <a class="<?php echo $pendulumId==''?'actived':'' ?>" href="index.php?styleId=<?php echo $styleId ?>" >全部摆型</a>

		<?php 
		  foreach ($style as $item) {
		?>

		<a class="<?php echo $item['id']==$pendulumId?'actived':'' ?>" href="index.php?pendulumId=<?php echo $item['id'] ?>&styleId=<?php echo $styleId ?>"><?php echo $item["name"]; ?></a>

		<?php 
		  }
    ?>

	</div>
</div>



<div class="diy-content">


<?php 
  foreach ($list["weddingClothes"] as $item) {
?>


	
<div><a href="dressDetail.php?id=<?php echo $item['id'] ?>" target="_blank">

<img src="../../images/<?php echo $item['images'][0] ?>">
<div class="imgTitle">

	<div class="icon1"></div>
<div><?php echo $item["name"] ?></div>
<div class="icon2"></div>

</div>

<div class="picTitle">

<div><?php echo $item["name"] ?></div>

<div>
	<?php echo '￥'.$item["price"] ?>
</div>

<div class="picCover">
	
</div>

</div>
</a>

</div>





<?php 

}


 ?>




</div>



<div class="diy-pageIdx">
	 	<?php for($i = 0 ; $i < $totalPageCount; $i++) {?>
			
			<a href="index.php?currentPage=<?php echo $i; ?>&styleId=<?php echo $styleId ?>&pendulumId=<?php echo $pendulumId?>" class="<?php echo $pageIndex==$i?'actived':'' ?>"><?php echo $i + 1; ?></a>
			
	 	<?php } ?>

</div>





</div>
<?php 
  include("../../inc/foot.php");
?>
<script>
    $('.nav-link a:eq(1)').css('color','red');
</script>



<!-- <script type="text/javascript">
	
var pages=document.querySelectorAll(".diy-pageIdx a");

console.log(pages[0]);

pages[0].className="actived";

for (var i = 0 ; i <pages.length; i++) {

	pages[i].onclick=function(){

		console.log(this);


document.querySelector(".actived").className="";

this.className="actived";


	}
	
}



</script> -->


</body>
</html>