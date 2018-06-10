<div class="blog">
	<?php foreach ($posts as $a): ?>
	    <article class="post-preview">
			<img src="<?php echo $a['thumbnail']; ?>" />
			<div class="date">
				<?php
				echo strtolower(date_format($a['date'], 'jS F Y'));
				 ?>
			</div>
			<h3>
				<a href="<?php echo $a['link']; ?>">
				<?php echo $a['title']; ?>
				</a>
			</h3>
			<div class="sample-text">
				<?php echo $a['subtitle']; ?>
			</div>
			<div class="comments">
				20 comments
			</div>
			<a class="continue-reading" href="<?php echo $a['link']; ?>">
				continue-reading...
			</a>
		</article>
	<?php endforeach; ?>
</div>