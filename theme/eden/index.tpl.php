<!doctype html>
<html class='no-js <?php if(isset($themeclass)) echo $themeclass?>' lang='<?=$lang?>'>
<head>
<meta charset='utf-8'/>
<title><?=$title . $title_append?></title>
<?php if(isset($favicon)): ?><link rel='icon' href='<?=$this->url->asset($favicon)?>'/><?php endif; ?>
<?php foreach($stylesheets as $stylesheet): ?>
<link rel='stylesheet' type='text/css' href='<?=$this->url->asset($stylesheet)?>'/>
<?php endforeach; ?>
<?php if(isset($style)): ?><style><?=$style?></style><?php endif; ?>
<script src='<?=$this->url->asset($modernizr)?>'></script>
</head>

<body>
<div id='container'>	
<header id='site-header'>
	<div class='wrapper'>
	<?php if(isset($header)) echo $header?>
	<?php if ($this->views->hasContent('header')) : ?>
		<?php $this->views->render('header')?>
	<?php endif; ?>

	<?php if ($this->views->hasContent('navbar')) : ?>
		<?php $this->views->render('navbar')?>	
	<?php endif; ?>
	</div>
</header>

	
	<?php if ($this->views->hasContent('flash')) : ?>
	<div class='flash'>
		<?php $this->views->render('flash')?>
	</div>
	<?php endif; ?>

<div id='site-content-1' class='wrapper site-content'>

	<?php if ($this->views->hasContent('featured-1', 'featured-2', 'featured-3')) : ?>
	<section id='wrap-featured'>
	    <div id='featured-1'><?php $this->views->render('featured-1')?></div>
	    <div id='featured-2'><?php $this->views->render('featured-2')?></div>
	    <div id='featured-3'><?php $this->views->render('featured-3')?></div>
	</section>
	<?php endif; ?>

	<?php if ($this->views->hasContent('flash-2')) : ?>
	</div>
	<div class='flash flash-2'>
		<?php $this->views->render('flash-2')?>
	</div>
	<div id='site-content-2' class='wrapper site-content'>
	<?php endif; ?>

	
	<?php if(isset($main)) echo $main?>
	<?php if ($this->views->hasContent('main')) : ?>
	<main>
		<?php $this->views->render('main')?>
	</main>
	<?php endif; ?>
	

	<?php if ($this->views->hasContent('sidebar')) : ?>
	<aside>
		<?php $this->views->render('sidebar')?>
	</aside>
	<?php endif; ?>

	<?php if ($this->views->hasContent('flash-3')) : ?>
	</div>
	<div class='flash flash-3'>
		<?php $this->views->render('flash-3')?>
	</div>
	<div id='site-content-3' class='wrapper site-content'>
	<?php endif; ?>



	<?php if ($this->views->hasContent('triptych-1', 'triptych-2', 'triptych-3')) : ?>
	<section id='wrap-triptych'>
	    <div id='triptych-1'><?php $this->views->render('triptych-1')?></div>
	    <div id='triptych-2'><?php $this->views->render('triptych-2')?></div>
	    <div id='triptych-3'><?php $this->views->render('triptych-3')?></div>
	</section>
	<?php endif; ?>

</div>
</div>

<footer id='site-footer'>
	<div class='wrapper'>
		<?php if(isset($footer)) echo $footer?>
		<?php $this->views->render('footer')?>
	</div>
</footer>



<?php if(isset($jquery)):?><script src='<?=$this->url->asset($jquery)?>'></script><?php endif; ?>

<?php if(isset($javascript_include)): foreach($javascript_include as $val): ?>
<script src='<?=$this->url->asset($val)?>'></script>
<?php endforeach; endif; ?>

<?php if(isset($google_analytics)): ?>
<script>
  var _gaq=[['_setAccount','<?=$google_analytics?>'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php endif; ?>

</body>
</html>
