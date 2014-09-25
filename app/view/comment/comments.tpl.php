

<h1 id='comments' class='grid'>Kommentera</h1>

<?php if (is_array($comments)) : ?>
<div class='comments'>
<?php foreach ($comments as $id => $comment) : 
	extract($comment);
 ?>		
 	<div class='grid'>
	 	<img src="<?= get_gravatar($mail,80) ?>" class='grid-1-8'>
		<div class='comment grid-7-8'>
			<header class='comment-header'>
				<a href ='<?= $web ?>'><h3><?=$name?></h3></a>
				<span>- <?=getTimeAgo($timestamp); ?> ago - 
				<?=getLocation($ip);?></span>
				<a href="<?=$this->url->create('comment/remove') . '?id=' . $id. '&pageId=' . $pageId?>" title='remove comment'>Remove comment</a>
				<a href="<?=$this->url->create($pageId) . '?id=' . $id . '#comments'?>" title='edit comment'>Edit comment</a>
			</header>
			<p><?=$content?></p>
			<hr>
		</div>
	</div>
<?php endforeach; ?>
</div>
<?php endif; ?>
