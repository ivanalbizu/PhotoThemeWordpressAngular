		<footer>
		  <div class="container">
				<div class="row">
					<div class="col-sm-6">
						<span class="pull-left footer-sign"><?php bloginfo( 'name' ); ?> &copy; <?php echo date("Y"); ?> Copyright</span>
					</div>
					<div class="col-sm-6">
						<a class="pull-right footer-sign" href="http://ivanalbizu.eu/">Maquetaci&oacute;n &amp; Programaci&oacute;n &ndash; Iv&aacute;n Albizu</a>
					</div>
				</div>
		  </div>
		</footer>

		<?php wp_footer(); ?>

		<!-- Modal -->
		<div id="about" class="modal" data-keyboard="false" data-backdrop="static" role="dialog">
		  <div class="modal-dialog">
				<a href="javascript:void(0)" class="close" data-dismiss="modal"></a>
		    <div ng-controller="UserCtrl as vm" class="modal-content">
					<div class="col-sm-4">
						<div class="container-user-image">
							<img ng-src="{{vm.user.avatar_urls['96']}}" alt="" />
						</div>
					</div>
					<div class="col-sm-8">
						<h3><?php bloginfo( 'name' ); ?></h3>
						<h4><?php bloginfo( 'description' ); ?></h4>
						<div ng-bind-html="vm.user.description"></div>
						<a href="{{vm.user.url}}">{{vm.user.url}}</a>
					</div>
		    </div>
		  </div>
		</div>
	</body>
	<script>
		jQuery(function(){
			jQuery('#nav-main a').click(function(){
	      jQuery('.navbar-toggle:visible').click();
	    });
		});
	</script>
</html>
