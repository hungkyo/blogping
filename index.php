<?php
if ($_POST['submit']) {
	$blogName = $_POST['blogName'];
	$homeUrl = $_POST['homeUrl'];
	$rssUrl = $_POST['rssUrl'];
	if (!$homeUrl || $homeUrl == 'undefined') {
		die("Please let me know your Blog Home URL!");
	}
	if (!$blogName || $blogName == 'undefined') {
		die("Please let me know your Blog Name (Title)!");
	}
	if (!$rssUrl || $rssUrl == 'undefined') {
		die("I cannot ping without your RSS URL!");
	}
	include "ping.php";
	$ping = new Ping();
	$ping->setInfo('url', $homeUrl)
		->setInfo('blogname', $blogName)
		->setInfo('rss2_url', $rssUrl);
	foreach ($pingServers AS $pingServer) {
		$ping->ping($pingServer);
	}
	die("Done!");
}
?>
<!DOCTYPE html>
<html class="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>The Absolute Free Ping Service</title>
	<meta name="description"
	      content="Get your wordpress indexed fast with our free ping service. Ping over 100 web directories for free!">
	<meta name="viewport" content="width=device-width, user-scalable=no, minimal-ui">

	<link rel="icon" type="image/png" href="skin/images/favicon.ico">

	<link href='http://fonts.googleapis.com/css?family=Lato:300,700,300italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="skin/css/font-awesome.min.css">
	<link rel="stylesheet" href="skin/css/app.css">
	<script src="skin/js/modernizr.js"></script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=334690143352258&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<div id="preloader">
	<img src="skin/images/loader.gif" alt="Loading" id="loading-img">
</div>
<!-- preloader -->

<div class="page">
	<div class="content">

		<header class="logo">
			<h1><i>&nbsp;</i>Ping Your Blog Now</h1>

			<h3>It's F**king Free!</h3>
		</header>
		<!-- logo end -->

		<section class="subscribe">
			<p>Fill The Below Form To Ping</p>

			<form id="signup" action="index.php" method="post">
				<input type="text" name="homeUrl" id="homeUrl" autocapitalize="none"
				       placeholder="Let Me Know Your Blog's URL">
				<input type="text" name="blogName" id="blogName" autocapitalize="none"
				       placeholder="Your Blog Name Goes Here">
				<input type="text" name="rssUrl" id="rssUrl" autocapitalize="none" placeholder="And... Your Feed URL">
				<input type="submit" value="GO! INDEX Me Now!">

				<p id="response"></p><!-- response end -->
			</form>
		</section>
		<!-- subscribe end -->

		<footer class="social">
			<h1>Sharing is FREE!</h1>
			<p style="margin-bottom: 0px;">˅˅˅˅˅˅˅˅</p>
			<div class="fb-like" data-href="http://ping.mucas.info/" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
			<p style="margin-bottom: 0px;">&</p>
			<div class="g-plusone" data-annotation="inline" data-width="150"></div>
			<p></p>
			<h2>Don't be afraid, let me know what's up!</h2>
			<p></p>
			<div class="fb-comments" data-href="http://ping.mucas.info" data-width="600px" data-numposts="15" data-colorscheme="dark"></div>
		</footer>
		<!-- social end -->

	</div>
	<!-- content end -->
</div>
<!-- page end -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
	$("form").submit(function () {
		$("form submit").prop("disabled",true);
		$('#response').html('<img src="skin/images/13.gif"/><br/>Please Wait...');
		$('#response').show();
		var actionLink = $(this).attr("action");
		var data = {};
		$("form input").each(function () {
			if ($(this).attr('id') != undefined) {
				data[$(this).attr('id')] = $(this).val();
			}
		});
		data.submit = true;
		$.ajax({
			url: actionLink,
			data: data,
			async: true,
			type: 'POST',
			success: function (html) {
				$('#response').text(html);
				var waitHide = window.setTimeout(function(){
					$('#response').hide();
					$("form submit").prop("disabled",false);
				},6000);
			}
		});
		return false;
	});
</script>
<script src="skin/js/plugins.js"></script>
<script src="skin/js/init.js"></script>
<script>
	(function (i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function () {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
			m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-51163197-4', 'auto');
	ga('send', 'pageview');

</script>
</body>
</html>