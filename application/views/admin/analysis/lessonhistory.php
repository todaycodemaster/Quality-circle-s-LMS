<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["analysisstatistics"]?></h2>
	
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title"><?=$term["lessonhistory"]?></h2>
				</header>
				<div class="card-body">
					<table class="table table-responsive-md table-hover mb-0" id="datatable_training_history" >
					</table>
					
				</div>
			</section>
		</div>
	</div>
<script>
	var $history_table = $('#datatable_training_history');

	jQuery(document).ready(function() { 	

		$history_table.dataTable({
			"ordering": true,
			"info": true,
			"searching": true,

			"ajax": {
	            "type": "POST",
	            "async": true,
				"url": "getlessonlist",
				"data": {'log_id':<?php echo $log_id;?>},
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
	        },
	        
	        "columnDefs": [{
                "targets": [9],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if(cellData == 'pass'){
                        $(td).html('<span class="badge badge-success">Pass</span>');
                    } else {
                        $(td).html('<span class="badge badge-info">Open</span>');
                    }
                }
            } ],     																	
	        "columns": [
	        	{ "title": "<?=$term["companyname"]?>", "data": "company_name", "class": "text-left", "width":60 },
	        	{ "title": "<?=$term["firstname"]?>", "data": "first_name", "class": "text-left", "width":60 },
	        	{ "title": "<?=$term["lastname"]?>", "data": "last_name", "class": "text-left", "width":60 },
				{ "title": "<?=$term["category"]?>", "data": "category_name", "class": "text-left", "width":100, "visible": true },
				{ "title": "<?=$term["topictitle"]?>", "data": "training_title", "class": "text-left", "width":"100" },
				{ "title": "<?=$term["lessontitle"]?>", "data": "lesson_title", "class": "text-left", "width":"*" },
				{ "title": "<?=$term["lessontype"]?>", "data": "lesson_type", "class": "text-center", "width":100 },
				{ "title": "<?=$term["startdate"]?>", "data": "start_at", "class": "text-left", "width":"100"},
				{ "title": "<?=$term["enddate"]?>", "data": "end_at", "class": "text-left", "width":"100" },
				{ "title": "<?=$term["status"]?>", "data": "state", "class": "text-center", "width":100 },
			],
			"lengthMenu": [
	            [5, 10, 20, 50, 150, -1],
	            [5, 10, 20, 50, 150, "All"] // change per page values here
	        ],
	        "scrollY": false,
			"scrollX": true,
			"scrollCollapse": false,
			"jQueryUI": true,							
			
			"paging": true,
			"pagingType": "full_numbers",			
	        "pageLength": 150, // default record count per page

			dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			bProcessing: true,			
		});
	});
	</script>
	<!-- end: page -->
</section>