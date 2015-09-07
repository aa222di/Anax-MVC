

<h1 id='comments' class='grid'>Kommentera</h1>


<div class='comments' id='comments'>	
 	<div class='grid'>

 	<?php foreach ($comments as $comment):
 		$comment = $comment->getProperties(); 
		extract($comment);
 		?>	

	 	<img src="<?= get_gravatar($email,80) ?>" class='grid-1-8'>
		<div class='comment grid-7-8'>
			<header class='comment-header'>
				<a href ='<?=$web ?>'><h3><?=$name?></h3></a>
				<span>- <?=getTimeAgo($timestamp); ?> ago
				<a href="<?=$this->url->create('comment/delete/' . $id) ?>" title='remove comment'>Remove comment</a>
				<a href="<?=$this->url->create('comment/update/' . $id) ?>"  title='edit comment'>Edit comment</a>
			</header>
			<p><?=$comment?></p>
			<hr>
		</div>

		<?php endforeach; ?>

	</div>

</div>


