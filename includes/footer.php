		</div>
		<div id="footer">
			<div class="flex spaceBetween p10 bgWhite">
				<div id="copyright" class="mobile">
					<span>Copyright © <?= date('Y'); ?> Matt Harrison</span>
				</div>
				<?php if (isset($_COOKIE['username'])) { ?>
					<div id="login" class="mobile">
						<?php if ($_COOKIE['username'] == 'matt!') {?>
							<p class="mb0"><a href="/post/">post</a>
								<span> | </span>
								<a href="/mybooks/">books</a>
								<span> | </span>
								<a href="/mycomics/">comics</a>
								<span> | </span>
								<a href="/mymovies/">movies</a>
							</p>
						<?php } ?>
					</div>
				<?php } ?>
				<div id="social" class="txtR mobile">
					<a href="http://www.instagram.com/rootbeercomics" target="_blank" class="mr20">instagram</a>
					<a href="http://www.facebook.com/rootbeercomics" target="_blank" class="mr20">facebook</a>
					<a href="http://www.twitter.com/rootbeercomics" target="_blank" class="mr20">twitter</a>
					<a href="http://www.rootbeercomics.tumblr.com" target="_blank">tumblr</a>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="/includes/js/toggle.js"></script>
	</body>
</html>
