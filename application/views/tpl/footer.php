			</main>
		</div>
	</div>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url('assets/js/jquery-3.5.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script>
	$(document).ready(function(){
		//Cerrar alertas automaticamente
		if($('.alert-remove-fsc').length){
			setInterval(function(){ $('.alert-remove-fsc').remove(); }, 6000);
		}
	});
	</script>
	</body>
</html>