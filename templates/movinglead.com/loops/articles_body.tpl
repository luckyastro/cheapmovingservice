<div class="article">
	<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/bg2.jpg">*/ ?>
	<?php /*<img src="{image}">*/ ?>
	<div class="article-content">
		<a href="{link}"><h2>{title}</h2></a>
		<ul class="article-info">
			<li>Author: <a href="#"><?php echo $conf['s_name']; ?> Staff</a></li>
			<?php /*<li>Date Posted: <a href="#">July 1, 2017</a></li>*/ ?>
			<li>Category: <a href="{link}">{category}</a></li>
		</ul>

		<p>{teaser}</p>
		
		<a href="{link}" class="btn-common inverse">READ MORE</a>
	</div>
</div>