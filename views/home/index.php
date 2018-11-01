<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>主页</title>
	
	<link rel="stylesheet" href="../../css/shen/bootstrap.min.css" />
	<link href="../../css/shen/animate.css" rel="stylesheet" media="screen">
	<link href="../../lib/et-line-font/style.css" rel="stylesheet" />
	<link rel="stylesheet" href="../../css/shen/styles.css" />
	<link href="../../lib/font/css/font-awesome.min.css" rel="stylesheet">

	<link href="../../css/carousel.css" rel="stylesheet" type="text/css"/>	
	<link href="../../css/index.css" rel="stylesheet" type="text/css"/>

</head>

<body>
<?php

	require("../../services/photographyService.php");
	
	$photoList = getPhotographyHome("",0,6);
	

 ?>


<div class="nav-top">
    <div class="nav-logo"></div>
    <div class="nav-link ">
        <a href="../home/index.php">首页</a>
        <a href="../weddingDress/index.php">婚纱定制</a>
        <a href="../photographyPackage/index.php">婚纱摄影</a>
        <a href="../photography/index.php">旅拍写真</a>
        <a href="../aboutUs/index.php">关于我们</a>
        <a href="../mycenter/index.php" id="myInfo">个人中心</a>
    </div>
    <div class="nav-textTitle">FOREVER</div>
    <div class="nav-textInfo">
        <p>一次惊艳，一生回味</p>

        <p>SIT AMET,</p>

        <p>CONSECTETUR</p>

        <p>ADIPISCING ELIT.</p>

        <div class="nav-more">MORE</div>
    </div>
</div>

<div class="page-body">
    <div class="page-welcome">
        <div class="page-welcome-left">
            <img src="../../images/5.png"/>
            <span class="page-welcome-title"></span>
        </div>
        <div class="page-welcome-right"></div>
    </div>

    <div class="page-body-hotPic">
        <div class="hotPic-title">

            <!--  -->

            <div class="hd04 h7">
                <i></i>
                <a alt="推荐" titl="婚纱摄影" href="../photographyPackage/index.php" title="查看更多 婚纱样片作品">
                    <span>热门城市旅拍，用独特的拍摄风格留住这一刻！</span>

                </a></div>

            <!--  -->


        </div>
        <div class="hotPic-info">
            <div class="mianc">


                <div class="main">
                    <div class="mianc">

                        <!-- Demo start -->
                        <div id="container">
                            <ul>
                                <?php foreach ($photoList["photoGraphy"] as $key => $value) {
                                ?>

                                <li>
                                    <a href="../photography/index.php?areaId=<?=$value['areaId']?>">
                                        <img src="../../images/<?=$value['images'][2]?>" width="423px" title="<div class='img-logo'>
							<div class='innerbox'>Best wishes… today and always.</div>
                        
							</div>">
                                    </a>

                                    <div class="photoTitle"><a
                                            href="../photography/index.php?areaId=<?=$value['areaId']?>"><?=$value['name']?></a>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- Demo end -->

                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="page-body-hotDress">
        <div class="hotDress-title">
            <!--  -->

            <div class="hd05 h7">
                <i></i>
                <a alt="推荐" titl="婚纱摄影" href="../weddingDress/index.php" title="查看更多婚纱样式">
                    <span>匠心制作独家海外婚纱，尽情期待不一样的爱的火花！</span>

                </a></div>

            <!--  -->
        </div>
        <div class="hotDress-info">
            <article class="jq22-container">

                <div class="caroursel poster-main" data-setting='{
				        "width":1300,
				        "height":800,
				        "posterWidth":600,
				        "posterHeight":800,
				        "scale":0.9,
				        "dealy":"2000",
				        "algin":"middle"
				    }'>
                    <ul class="poster-list">
                        <li class="poster-item"><a href="../weddingDress/index.php"><img src="../../images/12.jpg"
                                                                                         width="600px"
                                                                                         height="800px"></a></li>
                        <li class="poster-item"><a href="../weddingDress/index.php"><img src="../../images/13.jpg"
                                                                                         width="600px"
                                                                                         height="800px"></a></li>
                        <li class="poster-item"><a href="../weddingDress/index.php"><img src="../../images/14.jpg"
                                                                                         width="600px"
                                                                                         height="800px"></a></li>
                        <li class="poster-item"><a href="../weddingDress/index.php"><img src="../../images/15.jpg "
                                                                                         width="600px"
                                                                                         height="800px"></a></li>
                        <li class="poster-item"><a href="../weddingDress/index.php"><img src="../../images/16.jpg"
                                                                                         width="600px"
                                                                                         height="800px"></a></li>
                        <li class="poster-item"><a href="../weddingDress/index.php"><img src="../../images/17.jpg"
                                                                                         width="600px"
                                                                                         height="800px"></a></li>
                        <li class="poster-item"><a href="../weddingDress/index.php"><img src="../../images/18.jpg"
                                                                                         width="600px"
                                                                                         height="800px"></a></li>

                    </ul>


                    <div class="poster-btn poster-prev-btn"></div>
                    <div class="poster-btn poster-next-btn"></div>

                </div>
            </article>


        </div>
    </div>

</div>
<div class="hotNews">

</div>
<div class="news">
    <!--/.header-->
    <div id="#top"></div>
    <section id="home">
        <div class="banner-container">
            <div class="container">
                <div class="heading text-center">
                    <h2>YOU & ME</h2>

                    <h3>We Are Getting Married</h3><h5>On 26 Dec 2017</h5></div>
                <div class="countdown styled"></div>

            </div>
        </div>
        <div class="web-content">
            <section id="services">


                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="aligncenter"><h2 class="aligncenter">服务咨询</h2>为您定制专属服务，可纪念的美好，可定格的回忆</div>
                            <br>
                        </div>
                    </div>

                    <div class="services">
                        <div class="skill-home-solid clearfix">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 text-center">
                                    <span class="icons c1"><i class="icon-ribbon"></i></span>

                                    <div class="box-area">
                                        <a href="../news/index.php">新人必看：拍婚纱照前必须知道的事</a>

                                        <p>每个女孩子都有一个梦想，有一天穿上洁白的婚纱做他最美的新娘。 婚姻是人生中的大事，婚纱照更是必不可少，想要拍好婚纱照需要做哪些准备呢？
                                            怎样拍出最自然唯美最适合自己的婚纱照？铂爵婚纱全球旅拍就带您了解拍婚纱照前需要知道的事情。</p></div>
                                </div>
                                <div class="col-sm-6 col-md-6 text-center">
                                    <span class="icons c2"><i class="icon-profile-female"></i></span>

                                    <div class="box-area">
                                        <a href="../news/news01.php">选婚纱远比你想象的累 想要轻松先了解这些！</a>

                                        <p>
                                            婚纱从来都是女人非常重视的具有仪式感的礼服，一直对婚纱充满了各种期待和幻想。But,有一些新娘反映，由于选婚纱期间，试纱太多，竟把自己的热情都磨灭得差不多，以至于婚礼当天穿着婚纱也没有特别的感觉！如果由于选婚纱过多，试婚纱方法不对的话，破幻了新娘们从小的美丽幻想，那就适得其反了。在此，小编就把试婚纱，怎样选择适合自己的婚纱以及费用各种问题都分享给大家。</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 text-center">
                                    <span class="icons c3"><i class="icon-gift"></i></span>

                                    <div class="box-area">
                                        <a href="../news/news02.php">拍婚纱照要换几套衣服，这些衣服要怎么选？</a>

                                        <p>
                                            如果给你一个机会，拍婚纱照可以自由选择服装数量，但只能拍一天，你会选多少套？相信大部分都会说“当然越多越好啦！反正多穿又不花钱！渍渍渍！就知道你会这样想！作为经验丰富的婚纱摄影小编觉得宝宝们还是先听听过来人怎么说！</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 text-center">
                                    <span class="icons c4"><i class="icon-wine"></i></span>

                                    <div class="box-area">
                                        <a href="../news/news03.php">该淡季拍还是旺季？扒一扒淡旺季拍婚纱照的优缺点</a>

                                        <p>
                                            现在正5月，不是很热也不冷，这个天气估计是不少伙伴筹划着拍婚纱照了，现在旺季拍婚纱照场景多，但是有些人会说旺季拍摄肯定会贵，那么淡季旺季拍婚纱照有哪些区别呢？淡季拍还是旺季拍呢？下面就扒一扒淡旺季拍婚纱照的各种优缺点吧。</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </section>
            <section id="aboutUs">
                <div class="container">
                    <div class="row feature design">
                        <div class="six columns right">
                            <a href="">关于我们</a>

                            <p>企业规模大
                                核心团队，强大保障
                                团队个性化服务
                                全新体验，专属定制
                            </p>
                        </div>
                        <div class="six columns feature-media left"><img src="../../lib/images/picture-136.png" alt="">
                        </div>
                    </div>
                </div>
            </section>
            <section id="address">
                <div class="container">
                    <div class="row">
                        <div class="six columns feature-media right"><img src="../../lib/images/picture-137.png" alt="">
                        </div>

                    </div>
                </div>
            </section>
            a
            <footer>
                <div class="container">
                    <div class="clear"></div>
                    <!--CLEAR FLOATS-->

                </div>
            </footer>
            <!--/.page-section-->
        </div>
    </section>

</div>
<?php 
  include("../../inc/foot.php");
?>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/jquery.carousel.js"></script>
<script src="../../js/animations.js"></script>
<script src="../../js/jquery.sliphover.min.js"></script>
<script src="../../js/modernizr-latest.js"></script> 
<script src="../../js/bootstrap.min.js"></script> 
<script src="../../js/jquery.nav.js"></script> 
<script src="../../js/waypoints.js"></script> 
<script src="../../js/Backstretch.js" type="text/javascript"></script> 

<script src="../../js/custom.js" type="text/javascript"></script> 
<script src="../../js/jquery.countdown.js"></script>



<script>
 $(function(e){
	 $('.nav-link a:eq(0)').css('color','red');
 	 Caroursel.init($('.caroursel'));
      $('#container').sliphover();
	  

 	
 })
 

</script>

</body>
</html>