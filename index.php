<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <meta content="telephone=no,email=no" name="format-detection" />
    <title>YOYO随机习题</title>
    <meta charset="UTF-8">
    <style>
        body{
            padding:20px;
            background-color: #fff;
        }
        body,div,input{font-size:18px;font-family: "微软雅黑";}
        .nav{font-size:12px;}
        .nav a{font-size:12px;padding-left:12px;}
        .list{width:100%;}
        .item{clear:both;width:100%;height:40px;}
        .item-left{width:90px;float:left;height:24px;line-height:24px;}
        .item-right{float:left;height:24px;}
        .answer-box{float:left;border:1px solid #ddd;width:40px;height:20px;line-height:18px;padding:2px 3px;margin:0;font-size:18px;}
        .icon{float:left;margin-top:0px;margin-left:10px;}
        .icon img{width:24px;height:24px;}

        #score{position: fixed;top:46px;right:30px;text-align:center;color:red;font-size:40px;}
        #score span{color:#000;font-size:18px;}
        a.hl{
            color:red;
            padding-left:12px;
            background-image:url('img/arraw-right.png');
            background-repeat:no-repeat;
            background-size:10px;
            background-position: 2px;
        }
        a{text-decoration:none;}
        a:hover{color:red;}
        a:link{color:#333;}
        a.next{font-size:14px;color:red;font-weight:normal;}

    </style>
</head>

<body>
<script>
    var score=0;
    function chk(id){
        var v1 = document.getElementById("item-"+id+"-p1").innerHTML;
        var v2 = document.getElementById("item-"+id+"-p2").innerHTML;
        var answer = parseInt(parseInt(v1)+parseInt(v2));
        var userAnswer = document.getElementById("v-"+id).value;
        if(userAnswer!='0'){
            userAnswer = parseInt(userAnswer);
        }
        if(userAnswer){
            if(answer==userAnswer){
                document.getElementById("chk-icon-"+id).innerHTML = "<img src='./img/smile-green.png' />";
                score = score + 10;
            }else{
                var history = document.getElementById("chk-icon-"+id).innerHTML;
                if(history.indexOf('smile-green.png')!=-1){
                    score = score - 10;
                }
                document.getElementById("chk-icon-"+id).innerHTML = "<img src='./img/wrong-fill.png' />";
            }
        }
        document.getElementById("score").innerHTML = '<span>得分</span>' + score;
    }
</script>
<div class="nav" id="nav">
    题型选择：<a href="./?t=1">20以内</a>  <a href="./?t=2">40以内</a>  <a href="./?t=3">40以上</a>
</div>
<h3>随机习题&nbsp;&nbsp;&nbsp;&nbsp;<a class="next" href="javascript:window.location.reload();"> 换一批题目 </a></h3>
<hr style='height:0px;border:1px solid #bbb;' />
<div class="list">
<?php
$type = @$_GET['t'];
$type = !empty($type) ? $type : 1;
$rand_min = 10;
$rand_max = 20;
$plus_rand_min = 1;
$plus_rand_max = 9;

if($type=='2'){
    $rand_min = 10;
    $rand_max = 20;
    $plus_rand_min = 10;
    $plus_rand_max = 19;
}elseif($type=='3'){
    $rand_min = 20;
    $rand_max = 50;
    $plus_rand_min = 20;
    $plus_rand_max = 49;
}

for($i=1;$i<=10;$i++){
    $math = "<label id='item-$i-p1'>".mt_rand($rand_min,$rand_max)."</label>\n + \n";
    $math = $math . "<label id='item-$i-p2'>";
    $math = $math . mt_rand($plus_rand_min,$plus_rand_max);
    $math = $math . "</label>\n";
    echo("<div class='item'>\n");
    echo("<div class='item-left'>\n".$math." = </div>\n");
    echo("<div class='item-right'>\n");
    echo("<input type='number' onkeypress='return chkNum(event.keyCode,this)' onkeyup='chkValueMax($i,this.value);' id='v-$i' class='answer-box' onchange='chk($i)'>\n");
    echo("<div class='icon' id='chk-icon-$i'></div>\n");
    echo("</div>\n");
    echo("</div>\n");
}
echo("\n");
?>
</div>
<div id='score'></div>

<script type="text/javascript">
    var nav = document.getElementById("nav");
    var links = nav.getElementsByTagName("a");
    var currenturl = document.location.href;
    var last = 0;
    for (var i=0;i<links.length;i++)
    {
        var linkurl =  links[i].getAttribute("href").substr(2,100);
        if(currenturl.indexOf(linkurl)!=-1)
        {
            last = i;
        }
    }
    links[last].className = "hl";



    function chkNum(key,thisInput){
        if(key==13){
            focusNextInput(thisInput)
        }else {
            if (!String.fromCharCode(key).match(/[0-9\.]/)) {
                return false;
            }
        }
    }

    function focusNextInput(thisInput){
        var inputs = document.getElementsByTagName("input");
        for(var i = 0;i<inputs.length;i++){
            // 如果是最后一个，则焦点回到第一个
            if(i==(inputs.length-1)){
                inputs[0].focus();
                break;
            }else if(thisInput == inputs[i]){
                inputs[i+1].focus();
                break;
            }
        }
    }

    function chkValueMax(id,val){
        var ret = document.getElementById('v-'+id).value;
        if(val>99){
            document.getElementById('v-'+id).value = ret.substring(0,2);
        }
    }
</script>
</body>
</html>
