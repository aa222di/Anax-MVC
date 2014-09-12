<section class='logo-section'>
	<img class='sitelogo' src='<?=$this->url->asset("img/smiley.png")?>' alt='Big Smiley'/>
</section>
<section class='sub-section'>
		<div class='grid'>
		<h1 class='sitetitle grid-1-4'><?=$siteTitle?></h1>
		<?php if ($this->views->hasContent('navbar')) : ?>
		<div id='navbar' class='grid-3-4'>
		<?php $this->views->render('navbar')?>
		</div>
		<?php endif; ?>
	</div>
</section>
