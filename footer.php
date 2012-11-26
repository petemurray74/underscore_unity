	</div><!-- end main -->
<div class="row"><div class="twelve columns gap"><hr /></div></div>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div id="footer" class="row">
			<div class="four columns">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('FooterSidebar1') ) : ?>
				<?php endif; ?>
			</div>
			<div class="four columns end">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('FooterSidebar2') ) : ?>
				<?php endif; ?>
			</div>		
		</div><!-- #footer -->
	</footer><!-- .site-footer -->	
	</div><!-- end 12 cols -->	
</div><!-- #wrapper -->

<?php wp_footer();?>
</body>
</html>
