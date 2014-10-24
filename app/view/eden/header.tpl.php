<?php if(isset($siteLogo)): ?><img class='site-logo' src='<?=$this->url->asset("img/$siteLogo?>")?>' alt='Logo'/><?php endif;?>
<hgroup>
	<?php if(isset($siteTitle)): ?><h1 class='site-title'><?=$siteTitle?></h1><?php endif;?>
	<?php if(isset($siteSlogan)): ?><h4 class='site-slogan'><?=$siteSlogan?></h4><?php endif;?>
</hgroup>
