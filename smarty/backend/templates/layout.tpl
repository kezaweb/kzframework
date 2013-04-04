<!DOCTYPE html PUBdtC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <style type="text/css" src="/backend/css/bootstrap.min.css"></style>
    <link href="/backend/css/bootstrap.css" rel="stylesheet">
    <link href="/backend/css/kzf.css" rel="stylesheet">    
    <link href="/backend/css/font-awesome.min.css" rel="stylesheet" >
	<!--[if IE 7]>
	<link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css">
	<![endif]-->
    <script src="/backend/js/jquery-1.9.1.min.js"></script>
    <script src="/backend/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.cookie.js"></script>
	<script type="text/javascript" src="js/jquery.hotkeys.js"></script>
	<script type="text/javascript" src="js/jquery.jstree.js"></script>    
    <script src="/backend/js/kzf.js"></script>
  <title>{block name=title}KZFramework{/block}</title>
</head>


<body>
	<div class="navbar">
	   	<div class="navbar-inner">
		    <div class="container">
				<!-- Be sure to leave the brand out there if you want it shown -->
				<a class="brand" href="/backend" data-target="kzf-content" data-group="active-1">KZFramework</a>
				<ul class="nav menu">
					<li><a target="container" href="/backend/tree" data-target="kzf-content" data-group="active-1">Tree</a></li>
					<li><a target="container" href="/backend/templates" data-target="kzf-content" data-group="active-1">Templates</a></li>
					<li><a target="container" href="/backend/rules" data-target="kzf-content" data-group="active-1">Rules</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="kzf-content">
	{block 'content'} 
	
	{/block}
	</div>
	
	
	<!-- load box -->
	<div id="load-kzf-content">
		{html_image file='img/35load.gif'}&nbsp; &nbsp;Loading page...	
	</div>
	
</body>

</html>
