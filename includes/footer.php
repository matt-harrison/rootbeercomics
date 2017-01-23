		</div>
		<div id="footer">
			<div class="line mAuto p10 bdrBox bgWhite">
				<div id="copyright" class="unit size1of3 bdrBox mobile">
					<span>Copyright © <?= date('Y'); ?> Matt Harrison</span>
				</div>
				<?php if (isset($_COOKIE['username'])) { ?>
					<div id="login" class="unit size1of3 bdrBox mobile">
						<a href="/login/"><?= $_COOKIE['username']; ?></a><br/>
						<?php if ($_COOKIE['username'] == 'matt!') {?>
							<p class="mb0"><a href="/post/">create post</a></p>
							<p class="mb0">
								<a href="/mybooks/">books</a>
								<span> | </span>
								<a href="/mycomics/">comics</a>
								<span> | </span>
								<a href="/mymovies/">movies</a>
							</p>
						<?php } ?>
					</div>
				<?php } else { ?>
					<div class="unit size1of3 bdrBox mobile">&nbsp;</div>
				<?php } ?>
				<div id="social" class="unit size1of3 bdrBox txtR mobile">
					<a href="http://www.instagram.com/rootbeercomics" target="_blank" class="mr20">instagram</a>
					<a href="http://www.facebook.com/rootbeercomics" target="_blank" class="mr20">facebook</a>
					<a href="http://www.twitter.com/rootbeercomics" target="_blank" class="mr20">twitter</a>
					<a href="http://www.rootbeercomics.tumblr.com" target="_blank">tumblr</a>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="/includes/js/search.js"></script>
		<script type="text/javascript" src="/includes/js/comics.js"></script>
		<script type="text/javascript" src="/includes/js/archive.js"></script>
	</body>
</html>
