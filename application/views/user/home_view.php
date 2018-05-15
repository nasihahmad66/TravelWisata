<script src="<?= base_url() ?>assets/main/user_home.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/main/css/home.css">
<script type="text/html" id="travelItem">
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<img data-bind="attr:{src: IMAGE_PATCH}" class="img-responsive" style="width:100%; height: 200px" alt="Image">
				<h5 data-bind="text: NAMA_WISATA"></h5>
				<span data-bind="text: KOTA"></span>
				<p class="max-paragraf" data-bind="text: KETERANGAN"></p>
			</div> 
			<div class="card-footer">
				<div class="pull-right">
					<button class="btn btn-success" data-bind="click: function(data) {console.log(data)}">pesan</button>
				</div>
			</div>
		</div>
	</div>
</script>

<?php
	$this->load->view($loader); 
 ?>
<div class="row" data-bind="template:{name:'travelItem', foreach:home.dataMasterWisata}, visible: !model.Processing()">
</div>