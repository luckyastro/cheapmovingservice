<section class="page-banner">
	<div class="container">
		<h1>MOVING TIPS & GUIDES</h1>
	</div>
</section>

<section class="page-content page-articles">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-push-4">
				<div class="article-single">
					<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/bg2.jpg">*/ ?>
					<h1>{heading}</h1>
					<ul class="article-info">
						<li>By: <a href="#">{site} Staff</a></li>
						<li>Date Posted: <a href="#">{date}</a></li>
						<li>Category: <a href="#">{category}</a></li>
					</ul>

					<p>{article_text}</p>

					<br /><br />
					
					<?php /*
					<h3>LEAVE A COMMENT</h3>
					<form  class="form-common">
						<div class="row">
							<div class="col-sm-6">
					            <input type="text" name="fullname" placeholder="Full Name">
							</div>
							<div class="col-sm-6">
					            <input type="text" name="email" placeholder="Email">
							</div>
						</div>
						<textarea rows="3" cols="50" placeholder="Your message"></textarea>
			            <input type="submit" value="Submit" class="submitbtn">
					</form>
					*/ ?>

				</div>
				
				<h1>Featured Articles</h1>
				
				{random_articles}

			</div>

			<div class="col-sm-4 col-sm-pull-8">
				<div class="sidebar-box">
					<h2 class="sidebar-heading">Search</h2>
					<div class="sidebar-searchbox">
						<form method="post" action="/articles.php">
						<input type="text" name="string" placeholder="Search Keywords">
						<button name="submit" type="submit"></button>
						</form>
					</div>
				</div>

				<?php /*
				<div class="sidebar-box">
					<h2 class="sidebar-heading">Category</h2>
					<ul>
						<li><a href="#">Category 1</a></li>
						<li><a href="#">Category 2</a></li>
						<li><a href="#">Category 3</a></li>
						<li><a href="#">Category 4</a></li>
						<li><a href="#">Category 5</a></li>
						<li><a href="#">Category 6</a></li>
					</ul>
				</div>
				*/ ?>
				
				<?php /*
				<div class="sidebar-box">
				
				<?php if ( $hide_google == false ) { ?>
				<?php echo show_ads( 'responsive' ); ?>
				<?php } ?>
				
				<?php if ( $hide_google == false ) { ?>
				<?php echo show_ads( 'matched-content' ); ?>
				<?php } ?>
					
				</div>
				*/ ?>

				<div class="sidebar-box">
					<h2 class="sidebar-heading">Popular Posts</h2>
					
					<?php echo get_articles( 10, 'random', 'bar-item', '<li>', '</li>', '<ul class="sidebar-posts">', '</ul>' ); ?>
					
					<?php /*
					<ul class="sidebar-posts">
						<li>
							<a href="#" class="bar-item">
								<img src="images/bg2.jpg">
								<span class="post-title">Lorem Ipsum Dolor Lorem Ipsum Dolor Lorem Ipsum Dolor</span>
								<span class="post-date">20 June</span>
							</a>
						</li>
						<li>
							<a href="#" class="bar-item">
								<img src="images/bg2.jpg">
								<span class="post-title">Lorem Ipsum Dolor Lorem Ipsum Dolor Lorem Ipsum Dolor</span>
								<span class="post-date">20 June</span>
							</a>
						</li>
						<li>
							<a href="#" class="bar-item">
								<img src="images/bg2.jpg">
								<span class="post-title">Lorem Ipsum Dolor Lorem Ipsum Dolor Lorem Ipsum Dolor</span>
								<span class="post-date">20 June</span>
							</a>
						</li>
					</ul>
					*/ ?>
					
				</div>

				<div class="sidebar-box">
					<h2 class="sidebar-heading">Article Suggestions</h2>
					<p class="sidebar-text">Want to see an article about a particular moving topic? Let us know! We'd love to hear from you. Please <a href="/contact.php">contact us</a> and we'll put our expert researchers and content writers on the case.</p>
				</div>

				<div class="sidebar-box">
					<h2 class="sidebar-heading">Popular Searches</h2>
					<div class="sidebar-tags">
						<a href="/articles.php">Movers</a>
						<a href="/articles.php">Distance Moving</a>
						<a href="/articles.php">Mover</a>
						<a href="/articles.php">Moving Company</a>
						<a href="/articles.php">Cheap Movers</a>
						<a href="/articles.php">Discount Movers</a>
					</div>
				</div>

			</div>

		</div>

	</div>
</section>