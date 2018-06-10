<nav role="navigation">
	<ul>
		<?php
		function getClassIfActive( $linkTo ) {
			global $bootstrap;
			if ( $linkTo == $bootstrap -> controllerName ) {
				echo "class='active'";
			}
		}
		?>
		<!-- <li>
			<a href="/blog" 	<?php getClassIfActive("blog") ?> 		>blog</a>
		</li> -->
		<li>
			<a href="/about" 	<?php getClassIfActive("about") ?>		>about</a>
		</li>
		<li>
			<a href="/projects" <?php getClassIfActive("projects") ?> 		>projects</a>
		</li>
		<li>
			<a href="/contact" 	<?php getClassIfActive("contact") ?>	>contact</a>
		</li>
	</ul>
</nav>
