						<p id="js-color-profile" class="d-none">
						<span class="color-primary-50"></span>
						<span class="color-primary-100"></span>
						<span class="color-primary-200"></span>
						<span class="color-primary-300"></span>
						<span class="color-primary-400"></span>
						<span class="color-primary-500"></span>
						<span class="color-primary-600"></span>
						<span class="color-primary-700"></span>
						<span class="color-primary-800"></span>
						<span class="color-primary-900"></span>
						<span class="color-info-50"></span>
						<span class="color-info-100"></span>
						<span class="color-info-200"></span>
						<span class="color-info-300"></span>
						<span class="color-info-400"></span>
						<span class="color-info-500"></span>
						<span class="color-info-600"></span>
						<span class="color-info-700"></span>
						<span class="color-info-800"></span>
						<span class="color-info-900"></span>
						<span class="color-danger-50"></span>
						<span class="color-danger-100"></span>
						<span class="color-danger-200"></span>
						<span class="color-danger-300"></span>
						<span class="color-danger-400"></span>
						<span class="color-danger-500"></span>
						<span class="color-danger-600"></span>
						<span class="color-danger-700"></span>
						<span class="color-danger-800"></span>
						<span class="color-danger-900"></span>
						<span class="color-warning-50"></span>
						<span class="color-warning-100"></span>
						<span class="color-warning-200"></span>
						<span class="color-warning-300"></span>
						<span class="color-warning-400"></span>
						<span class="color-warning-500"></span>
						<span class="color-warning-600"></span>
						<span class="color-warning-700"></span>
						<span class="color-warning-800"></span>
						<span class="color-warning-900"></span>
						<span class="color-success-50"></span>
						<span class="color-success-100"></span>
						<span class="color-success-200"></span>
						<span class="color-success-300"></span>
						<span class="color-success-400"></span>
						<span class="color-success-500"></span>
						<span class="color-success-600"></span>
						<span class="color-success-700"></span>
						<span class="color-success-800"></span>
						<span class="color-success-900"></span>
						<span class="color-fusion-50"></span>
						<span class="color-fusion-100"></span>
						<span class="color-fusion-200"></span>
						<span class="color-fusion-300"></span>
						<span class="color-fusion-400"></span>
						<span class="color-fusion-500"></span>
						<span class="color-fusion-600"></span>
						<span class="color-fusion-700"></span>
						<span class="color-fusion-800"></span>
						<span class="color-fusion-900"></span>
					</p>

					<footer class="page-footer" role="contentinfo">
						<div class="d-flex align-items-center flex-1 text-muted">
							<span class="hidden-md-down fw-700"><strong>Copyright © 2020</strong> - Hore. All right reserved.</span>
						</div>
					</footer>

				</div>
			</div>
		</div>

		<script src="<?php echo base_url(); ?>assets/js/vendors.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/app.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/datagrid/datatables/datatables.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/notifications/toastr/toastr.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dependency/moment/moment.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/formplugins/select2/select2_3_5_4.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootbox/bootbox.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dependency/numeral/numeral.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dependency/formatcurrency/jquery.formatCurrency.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dependency/accounting/accounting.js"></script>

		<script type="text/javascript">
			var example_gridsize = $("#example-gridsize");

			$("#gridrange").on("input change", function()
			{
				example_gridsize.attr("placeholder", ".col-" + $(this).val());
				example_gridsize.parent().removeClass().addClass("col-" + $(this).val())
			});
		</script>
	</body>
</html>