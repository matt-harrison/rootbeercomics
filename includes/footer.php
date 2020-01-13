		</div>
		<div id="footer" class="wFull">
			<div class="flex spaceBetween alignCenter wrap">
				<img src="/images/nav/copyright.png" alt="Copyright © <?= date('Y'); ?> Matt Harrison"/>
				<?php if (isSuperuser()) {?>
					<p class="flex spaceBetween">
						<a href="/post/" class="p20">post</a>
						<a href="/mybooks/" class="p20">books</a>
						<a href="/mycomics/" class="p20">comics</a>
						<a href="/mymovies/" class="p20">movies</a>
					</p>
				<?php } ?>
			</div>
		</div>
	</body>
</html>
