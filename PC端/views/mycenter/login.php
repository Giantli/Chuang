<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
    <link href="../../css/index.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div id="login">

<div class="login-box">
<p>
<div class="login-title">
</div>
</p>
<div class="login-info">

 <p>
   <label>手机号：</label><input type="text" name="logintel" id="logintel">
   <span class="telS">请输入手机号</span>
 </p>
 <p>
   <label>密  码：</label><input type="password" name="loginpsw" id="loginpsw">
   <span class="pswS">请输入密码</span>
 </p>
 <p>
   <button id="log-btn" type="button">登录</button>
   <button id="log-cancel" type="button">取消</button id="log-cancel" type="button">
 </p>
 <p>
   <a id="reg">注册新账户</a>
 </p>

 </div>

 <div class="reg-info" style="display:none">


 <p>
   <label>手机号：</label><input type="text"  name="regtel" id="regtel">
   <span class="regtelS">请输入手机号</span>
 </p>
 <p>
   <label>昵  称：</label><input type="text"  name="regnickname" id="regnickname">
   <span class="regnameS">请输入昵称</span>
 </p>
 <p>
   <label>密  码：</label><input type="password"  name="regpsw" id="regpsw">
   <span class="regpswS">请输入密码</span>
 </p>
 <p>
   <label>确认密码：</label><input type="password"  name="regconfirmpsw" id="regconfirmpsw">
   <span class="confimpswS">请输入确认密码</span>
 </p>
 <p>
   <button id="reg-btn" type="button">注册</button>
   <button id="reg-cancel" type="button">取消</button>
 </p>
 <p>
   <a id="log">登录账户</a>
 </p>

 </div>
</div>
</div>
<script src="../../js/jquery.min.js"></script>
<script>
    window.onload = function(e){
        $('.nav-link a:eq(5)').css('color','red');



        $('#reg').bind('click',function(e){
            $('.login-info').css({"animation":" bounceOut 0.5s  forwards","display":"none"});
            $('.reg-info').css({"animation":" bounceIn 0.5s  forwards","display":"block"});

        });

        $('#log').bind('click',function(e){
            $('.reg-info').css({"animation":" bounceOut 0.5s  forwards","display":"none"});
            $('.login-info').css({"animation":" bounceIn 0.5s  forwards","display":"block"});

        });

        $('#reg-cancel').bind('click',function(e){
            window.location.href='index.php';

        });
        $('#log-cancel').bind('click',function(e){
            window.location.href='index.php';

        });

        $('#login-btn').bind("click",function(e){
            $("#login").css({"animation":" bounceIn 0.3s  forwards","display":"block"});
        });
        /**************************登录验证*******************************************/
        var logintel = document.getElementById('logintel');
        var loginpsw = document.getElementById('loginpsw');
        var telS = document.querySelector('.telS');
        var pswS = document.querySelector('.pswS');
        var regtel = document.getElementById('regtel');
        var regnickname = document.getElementById('regnickname');
        var regpsw = document.getElementById('regpsw');
        var regconfirmpsw = document.getElementById('regconfirmpsw');
        var regtelS = document.querySelector('.regtelS');
        var regnameS = document.querySelector('.regnameS');
        var regpswS = document.querySelector('.regpswS');
        var confimpswS = document.querySelector('.confimpswS');


        $('#log-btn').bind('click',function(){

            if(!telValid(logintel)){
                return false;
            }

            if(!passwordValid(loginpsw)){
                return false;
            }
            $.ajax({
                type:'POST',
                url:'../../interface/membersAjax.php?method=login',
                data:{phone:logintel.value,password:loginpsw.value},
                success:function(response){
                    if(response.code==100){
                        sessionStorage.setItem("username", response.data.id);
                        sessionStorage.setItem("user",JSON.stringify(response.data));
                        console.log(response.data);
                        if(sessionStorage.getItem('weddingdressId')){
                            location.href='../weddingDress/dressDetail.php?id='+sessionStorage.getItem('weddingdressId');
                            return false;
                        }

                        if(sessionStorage.getItem('photographyPackageId')){
                            location.href='../photographyPackage/photographyDetail.php?id='+sessionStorage.getItem('photographyPackageId');
                            return false;
                        }
                        window.location.href='../../views/mycenter/index.php';

                    }

                },
                dataType:'json'
            });


        });



        logintel.onblur = function (){
            telValid(logintel);
        };
        loginpsw.onblur = function (){
            passwordValid(loginpsw);
        };


        /**************************注册验证*******************************************/
        var formreg = document.querySelector('#form-reg');

        $('#reg-btn').bind('click',function(){
            if(!telValid1(regtel)){
                return false;
            }
            if(!nameValid(regnickname)){
                return false;
            }
            if(!passwordValid1(regpsw)){
                return false;
            }
            if(!confirmPswValid(regconfirmpsw,regpsw)){
                return false;
            }
            $.ajax({
                type:'POST',
                url:'../../interface/membersAjax.php?method=register',
                data:{phone:regtel.value,password:regpsw.value,nickName:regnickname.value},
                success:function(response){
                    if(response.code==100){
                        window.location.href='../../views/mycenter/login.php';
                    }
                    if(response.code==101){
                        regtelS.innerText='手机号已注册';
                        regtelS.className = 'error';
                    }
                },
                dataType:'json'
            });


        });


        /********************************/
        regtel.onblur = function(){
            telValid1(regtel);
        }
        regnickname.onblur = function(){
            nameValid(regnickname);
        }

        regpsw.onblur = function(){
            passwordValid1(regpsw);
        }

        regconfirmpsw.onblur = function(){
            confirmPswValid(regconfirmpsw,regpsw);
        }


        /***********************************************************/
        function nameValid(userName){
            var pattern =  /^[a-zA-Z]\w{3,19}/;
            if(!pattern.test(userName.value)){
                regnameS.innerText = '*用户名格式不正确';
                regnameS.className = 'error';
                return false;
            }
            regnameS.innerText = '有效';
            regnameS.className = 'right';
            return true;

        }
        function passwordValid(userPwd){
            var pattern =  /\S{6,12}/;
            if(!pattern.test(userPwd.value)){
                pswS.innerText = '*密码格式不正确';
                pswS.className = 'error'
                return false;
            }
            pswS.innerText = '有效';
            pswS.className = 'right'
            return true;
        }
        function passwordValid1(userPwd){
            var pattern =  /\S{6,12}/;
            if(!pattern.test(userPwd.value)){
                regpswS.innerText = '*密码格式不正确';
                regpswS.className = 'error'
                return false;
            }
            regpswS.innerText = '有效';
            regpswS.className = 'right'
            return true;
        }

        function confirmPswValid(confirmPwd,userPwd){
            if(confirmPwd.value.length == 0){
                confimpswS.innerText = '*确认密码不能为空';
                confimpswS.className = 'error'
                return false;
            }
            if(userPwd.value != confirmPwd.value){
                confimpswS.innerText = '*两次输入密码不一致';
                confimpswS.className = 'error'
                return false;
            }
            confimpswS.innerText = '有效';
            confimpswS.className = 'right'
            return true;
        }
        function telValid(tel){
            var pattern = /^1[8357]\d{9}/;
            if(!pattern.test(tel.value)){
                telS.innerText = '*电话格式不正确';
                telS.className = 'error';
                return false;
            }
            telS.innerText = '有效';
            telS.className = 'right'
            return true;
        }
        function telValid1(tel){
            var pattern = /^1[8357]\d{9}/;
            if(!pattern.test(tel.value)){
                regtelS.innerText = '*电话格式不正确';
                regtelS.className = 'error';
                return false;
            }
            regtelS.innerText = '有效';
            regtelS.className = 'right'
            return true;
        }
    }
</script>
</body>
</html>
