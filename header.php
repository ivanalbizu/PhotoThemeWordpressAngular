<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" ng-app="app">

<head>
	<base href="/wphoto/">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title(''); ?><?php if( wp_title( '', false ) ) { echo ' :'; } ?> <?php bloginfo( 'name' ); ?></title>

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link href="//www.google-analytics.com" rel="dns-prefetch">
	<link href="<?php the_favicon_url(); ?>" rel="shortcut icon">
	<link href="<?php the_apple_touch_url(); ?>" rel="apple-touch-icon-precomposed" sizes="144x144">

	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="Squarespace" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<header>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div id="nav-main" class="container">
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
				<a class="navbar-brand" href="#/">
					<h1><?php bloginfo( 'title' ); ?></h1> &ndash; <h2><?php bloginfo( 'description' ); ?></h2>
				</a>
		  </div>
		  <div class="navbar-collapse collapse">
		    <ul class="nav navbar-nav navbar-right">
					<li ng-class="{active: activetab=='/posts'}"><a href="#/posts/">blog</a></li>
					<li ng-class="{active: activetab=='/portfolios'}"><a href="#/portfolios/">portfolio</a></li>
					<li data-toggle="modal" data-target="#about"><a href="javascript:void(0)">about</a></li>
		    </ul>
			</div>
	  </div>
	</nav>
</header>
