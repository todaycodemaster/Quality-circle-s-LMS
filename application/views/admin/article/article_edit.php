<section role="main" class="content-body">
	<header class="page-header">
		<h2>Article Management</h2>
	
	</header>

	<!-- start: page -->
	<div class="row">		
		<div class="col-lg-12">
			
				<article class="card">
					<header class="card-header">
						<div class="card-actions">	
							<!--  -->
							<a class="btn btn-default" href="<?php echo base_url();?>admin/video" id="btn_list"><i class="fa fa-table"></i> Article List </a>
						</div>
		
						<h2 class="card-title">Article</h2>
					</header>
					<div class="card-body">
						<form id="category_add_form" action="<?php echo base_url();?>admin/article/add" enctype="multipart/form-data" method="POST" novalidate="novalidate">
							<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
							<!-- <input type="hidden" name="wcm_cat_id" id="wcm_cat_id" value="<?php echo isset($category['wcm_cat_id'])?$category['wcm_cat_id']:''; ?>"> -->
							<div class="form-group row">
								<label class="col-sm-3 control-label text-sm-right pt-2">Article Title <span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8">
									<input type="text" id="article_title" name="article_title" class="form-control" placeholder="eg.: Demo Article" required="" maxlength="50" value="<?php echo isset($video['article_title'])?$video['article_title']:''; ?>">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label text-sm-right pt-2">Link(YouTube embed code) <span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8">
	<textarea rows="5" cols="5" id="article_link" name="article_link" class="form-control" placeholder="<iframe width="853" height="480" src="https://www.youtube.com/embed/-7PM9tGKyo8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen" required=""><?php echo isset($video['article_link'])? $video['article_link']:''; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label text-sm-right pt-2">Description<span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8 editArea">
									<!-- <textarea class="note-codable form-control" role="textbox" aria-multiline="true" name="video_desc" id="video_description"><?php echo isset($video['video_desc'])? $video['video_desc']:''; ?></textarea> -->
									<textarea class="form-control form-control-lg" id="checkbox" name="article_desc" placeholder="Please Enter Description" rows="3" ><?php echo isset($video['article_desc'])? $video['article_desc']:''; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label text-sm-right pt-2">Status<span class="required">*</span></label>
								<div class="col-lg-6 col-sm-8">
									<select class="form-control" name="status">
										<option value="">Select Status</option>
										<option value="1" <?php echo isset($video['status']) && ($video['status'] == 1) ? 'selected' : '' ?> selected="">Active</option>
										<option <?php echo isset($video['status']) && ($video['status'] == 0) ? 'selected' : '' ?> value="0">InActive</option>
									</select>
								</div>
							</div>	
						</form>
						<!--<div class="row">
							<div class="col-md-2">
								<a class="btn btn-default modal-basic" href="#modalBasic" id="btn_add"><i class="fa fa-plus"></i> <?=$term["addnew"]?></a>
							</div>
							<div class="col-md-8">
								<table class="table table-responsive-md table-bordered mb-0" id="datatable_category_standard">
								</table>
							</div>
						</div>-->

					</div>
					<footer class="card-footer">
						<div class="row">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary" id="btn_save"><?=$term["save"]?></button>
								<button type="reset" class="btn btn-default"><?=$term["reset"]?></button>
							</div>
						</div>
					</footer>
				</article>
			
		</div>						
	</div>
	
	<!-- end: page -->
</section>
<div id="modalBasic" class="modal-block mfp-hide">
	<section class="card">
		<header class="card-header">
			<h2 class="card-title" id="standard_modal"></h2>
		</header>
		<div class="card-body">
			<div class="modal-wrapper">
				<div class="modal-text row">
					<input type="hidden" id="standard_id" name="standard_id">
					<label class="col-sm-3 control-label text-sm-right pt-2">Name</label>
					<div class="col-sm-8">
						<input type="text" id="standard_name" name="standard_name" class="form-control" >
					</div>
					
				</div>
			</div>
		</div>
		<footer class="card-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm">Confirm</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</section>
</div>


<script>
	var $table = $('#datatable_category_standard');

	var frm = $('#category_add_form');
	frm.validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
			
		},
		errorPlacement: function( error, element ) {
			var placement = element.closest('.input-group');
			if (!placement.get(0)) {
				placement = element;
			}
			if (error.text() !== '') {
				placement.after(error);
			}
		}
	});

	$('#btn_add').click (function(){
		$('#standard_modal').html('Add standard');
		$('#standard_id').val('0');
		$('#standard_name').val('');
	});

	function update(id,name){
		$('#btn_add').click();
		$('#standard_modal').html('Update standard');
		$('#standard_id').val(id);
		$('#standard_name').val(name);
	};
	
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});

	/*
	Modal Confirm
	*/
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		$.ajax({
            url: "<?php echo base_url() ?>admin/category/saveStandard",
            type: 'POST',
            data: {'standard_id':$('#standard_id').val(),
        			'standard_name':$('#standard_name').val(),
        			'category_id':<?php echo $id;?>},
            dataType : 'json',
            success: function(data){
                
               $.magnificPopup.close();
               $table.DataTable().ajax.reload();
				new PNotify({
					title: 'Success!',
					text: 'Modal Confirm Message.',
					type: 'success'
				}); 		  
            }
        });
		
	});

	function deleteStandard(id) 
	{	
		(new PNotify({
            title: "<?php echo $term['confirmation']; ?>",
            text: "<?php echo $term['areyousuretodelete']; ?>",
			icon: 'fas fa-question',
			confirm: {
				confirm: true
			},
			button: {
				closer: false,
				sticker: false
			},
			addclass: 'stack-modal',
			stack: {
				'dir1': 'down',
				'dir2': 'right',
				'modal':true
			}
		})).get().on('pnotify.confirm', function(){
			$.ajax({
                url: '<?php echo base_url() ?>admin/category/delete_standard',
                type: 'POST',
                data: {id:id},
                dataType : 'json',
                success: function (data, status, xhr) {	
                	$table.DataTable().ajax.reload('', false);	
				},
				error: function(){
					new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['youcantdeletethisitem']; ?>',
						type: 'error'
					});		
				}
			});				
		});
	}
	// function deleteStandard(id) {
	// 	$.ajax({
 //            url: "<?php echo base_url() ?>admin/category/delete_standard",
 //            type: 'POST',
 //            data: {'id':id},
 //            dataType : 'json',
 //            success: function(data){
                
 //               $table.DataTable().ajax.reload();
	// 			new PNotify({
	// 				title: 'Success!',
	// 				text: 'Modal Confirm Message.',
	// 				type: 'success'
	// 			}); 		  
 //            }
 //        });
		
	// };

	jQuery(document).ready(function() { 
		$table.dataTable({
			"ordering": true,
			"info": true,
			"searching": false,

			"ajax": {
                "type": "POST",
                "async": true,
				"url": "<?php echo base_url()?>admin/video/getStandardList",
				"data": {category_id: '<?php echo $id;?>'},		
				"dataSrc": "data",
				"dataType": "json",
				"cache":    false,
            },
            
            "columnDefs": [ {
				"targets": [2],
				"createdCell": function (td, cellData, rowData, row, col) {
				    if (rowData['video_title'] != "Online Courses" && rowData['video_title'] != "Live Classes" && rowData['video_title'] != "ILT")
					    $(td).html('<a href="javascript:update('+rowData.id+',\''+rowData.video_title+'\')"><i class="fas fa-pencil-alt"></i></a><span class="w-20"></span><a href="javascript:deleteStandard('+cellData+')" class="delete-row"><i class="far fa-trash-alt"></i></a>');
					else
					    $(td).html('');
				    //$(td).addClass('actions-hover actions-fade');
				}
			}],
            "columns": [
                { "title": "<?=$term["no"]?>", "data": "no", "class": "text-left", "width":"80" },
				{ "title": "Standard", "data": "video_title", "class": "text-left", "width":150, "visible": true },
				{ "title": "<?=$term["action"]?>", "data": "id", "class": "text-left", "width":"80" },
			],
			"lengthMenu": [
                [5, 10, 20, 50, 150, -1],
                [5, 10, 20, 50, 150, "All"] // change per page values here
            ],
            "scrollY": false,
			"scrollX": true,
			"scrollCollapse": false,
			"jQueryUI": true,							
			
			"paging": false,
			"pagingType": "full_numbers",			
            "pageLength": 150, // default record count per page

			dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			bProcessing: true,			
		});
		
		$('.modal-basic').magnificPopup({
			type: 'inline',
			preloader: false,
			modal: true
		});
		
	});

	$('#btn_save').on('click', function(e){

			event.preventDefault();

			if(frm.valid()) {

				console.log('submit');
				frm.submit();
			} else {
				console.log('invalide');
			}
		});
</script>
