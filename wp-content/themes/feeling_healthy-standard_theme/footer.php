<p>&nbsp;</p> <!-- YOU TRY WITHOUT IT ON A DYNAMICALLY GROWING FORM AND A STICKY FOOTER! - NK -->

</div><!-- WRAPPER -->

</div><!-- FRAME -->

<div id="footer-wrapper">

<div id="footer">
	<div id="footer-contact">
		<p>30 Schild Street Yarraville VIC 3013 Australia</p>
		<p><strong>T</strong>03 9687 5333</p>
		<p><strong>E</strong><a href="mailto:reception@feelinghealthy.com.au">reception@feelinghealthy.com.au</a></p>
	</div>

	<div id="footnote">
		<p>&copy; Copyright  <?php echo date("Y") ?> Feeling Healthy. All Rights Reserved.</p>
	</div> 

</div> 

</div>

<?php wp_footer(); ?>

<!-- CENTRING BACKGROUND DROP SHADOWS -->
<div id="background-frame">
	<div id="background-fill"></div>
</div>

<!-- NEWSLETTER SUBSCRIBE MODAL -->

<div id="newsletter-modal">
	<div class="subscribe-close">
		<img src="<?php bloginfo('template_directory'); ?>/images/close.png" title="" alt="" />
	</div>
	<div class="subscribe-form">
		<h3>Sign up to our latest newsletter and offers</h3>
		<?php //echo do_shortcode('[gravityform id="6" name="Newsletter Registration" title="false" description="false" ajax="true"]') ?>

		<?php include 'mailchimp.inc.php' ?>
	</div>
</div>

<div id="newsletter-modal-veil"></div>

<!-- GOOGLE ANALYTICS -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42465963-1', 'feelinghealthy.com.au');
  ga('send', 'pageview');

</script>

</body>

</html>