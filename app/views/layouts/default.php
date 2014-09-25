
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>DietKAY</title>
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
padding-top: 60px;
}
</style>
</head>
<body>
<div class="navbar navbar-fixed-top">
<div class="navbar-inner">

<a style = "padding-left: 60px" class="brand" href="#">ThreadBoard</a>

<?php if(isset($_SESSION['id'])): ?>
<!-- nav -->
 <div class = "row-fluid">
<div style="float: right; width: 210px; height: 0px;">
     <a class = "brand" href="<?php say(url('thread/index'));?>" > 
     <i class = "icon-home"></i>
    </a>  &nbsp; &nbsp;
    
    <a   name = "update" class = "brand" href="<?php say(url('user/update'));?>"><i class = "icon-cog"></i>
    </a> &nbsp; &nbsp;
    <a name = "logout" class = "brand" href="<?php say(url('thread/logout'));?>"
    onClick = "return confirm('Are you sure you want to logout?')"><i class = "icon-off"></i>
    </a> 
    </div></div>

 <!-- nav -->
<?php endif ?>



</div>
</div>
<div class="container">
<?php echo $_content_ ?>
</div>
<script>
console.log(<?php say(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
</script>
</body>
</html>