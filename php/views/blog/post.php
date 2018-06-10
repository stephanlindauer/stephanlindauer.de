<div class="blogpost">
		<noscript>unfortunately the content on this page cannot be displayed correctly without javascript</noscript>
	    <article class="post">
			<img src="<?php echo $post['thumbnail']; ?>" />
			<div class="date">
				<?php
				echo strtolower(date_format($post["date"], 'jS F Y'));
				 ?>
			</div>
			<h3>
				<?php echo $post['title']; ?>
			</h3>
			<div class="postbody">
				<?php echo $post['content']; ?>
			</div>
			<div class="comments">
				20 comments
			</div>
			<div id="disqus_thread"></div>
		</article>
	    <script type="text/javascript">
	        var disqus_shortname = 'stephanlindauer';
	        (function() {
	            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
	            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
	            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	        })();
	    </script>
</div>
