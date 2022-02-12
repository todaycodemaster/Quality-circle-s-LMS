<style type="text/css">
	.navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover{
		color:#000!important;
	}
	.logo img{
		height: 40px;
	}
</style>
<!-- Bootstrap -->
<link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.png" />
<link href="<?php echo base_url(); ?>assets/css_company/main-style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css_company/responsive.css" rel="stylesheet">
<script src="https://www.paypal.com/sdk/js?client-id=AfvvmSMlwXTgLnGoXB9ygA7DXst7RDSb0dvScr8NvByZoUUUbrk3X9gGs-R8pXkeZnM8q9XRehZelBfD"> </script>
<script type="text/javascript" src="https://sandbox-assets.secure.checkout.visa.com/checkout-widget/resources/js/integration/v1/sdk.js"></script>
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->
<script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>

<section role="main" class="content-body" style="width:85%;">
    <header class="page-header">
        <h2>Virtual Instructor Led Training</h2>

        <div class="right-wrapper">
        </div>
    </header>    
	
    <input type="hidden" id="base_url" value="<?= base_url()?>">
	<div class="row demand-page">
		<div class="col-lg-12">
			<section class="card" style="padding: 0px">
		<header class="card-header">		
		<h2 class="card-title">Training List</h2>
	</header>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="catalogBox">
                	<div class="row">
						<div class="col-sm-12">
                        
							<div class="sortPanel">
								<div class="sortSet">                                             
                                    <select id="course_id" name="course_id" style="border: 1px solid #ccc !important;padding: 8px 10px !important;">
                                        <option value=""> Select Course </option>
                                        <?php foreach($coursesfilter as $courseitem){
											if($courseitem['start_at'] != ''){
											$currentday = time();
											$startDateL = strtotime($courseitem['start_at']);
											$durationL = $courseitem['duration'] - 1;
											$enddateL = strtotime('+'.$durationL.' days', $startDateL);
		
											if($currentday <= $enddateL){
											//if(strtotime($courseitem['start_at']) >= $currentdays){
										?>
                                            <option value="<?php echo $courseitem['id']; ?>" <?php $courses_id==$courseitem['id']?print 'selected':print ''; ?>> <?php echo $courseitem['title']; ?></option>
                                        <?php } } } ?>
                                    </select>
								</div><!--sortSet-->
							</div><!--sortPanel-->
						</div><!--col-12-->
					</div><!--row-->					
					<div class="row">
						<?php if($free_course_list || $paid_course_list){?>
							<div class="col-sm-12">
								<?php foreach($free_course_list as $free_course){									
									if($free_course['date_str'] != '' || $free_course['date_str'] != 0){
										if($course['course_self_time'] == "Time Restricted"){
											$showDuration = $free_course['duration'] > 1 ? $free_course['duration']. " Days" : $free_course['duration']." Day";
											$duration = $free_course['duration'] - 1;
											$enddate = strtotime('+'.$duration .' days', strtotime($free_course['start_day']. " " . $free_course['end_time']));
											$currentdays = time();
										}else{
											$enddate = $free_course['duration'] * 8 * 24 * 60;
											$currentdays = $free_course['session_time']?$free_course['session_time']:0;
										}
										// $startDateI = $free_course['date_str'];

										// $durationI = $free_course['duration'] - 1;
										// $enddateI = strtotime('+'.$duration .' days', $startDateI);
										if($currentdays <= $enddate){  ?> 								
										<div class="whitePanel">
											<div class="row">
												<div class="col-lg-4 col-md-5 col-sm-6">
													<div class="leftImgBox">
														<?php
															$imgName = end(explode('/', $free_course['img_path']));
															if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName)){								
														?>
															<img src="<?php echo base_url($free_course['img_path']); ?>" class="rounded img-fluid" alt="learnerlearner">
														<?php }else{ ?>
															<img src="<?php echo base_url().'assets/uploads/vilt-default.png'; ?>" class="rounded img-fluid" alt="learnerlearner">                                		
														<?php } ?>
													</div><!--leftImgBox-->
												</div><!--col-4-->
												
												<?php
													$showDuration = $free_course['duration'] > 1 ? $free_course['duration']. " Days" : $free_course['duration']." Day";												
													$duration = $free_course['duration'] - 1;
													$enddate = strtotime($free_course['start_at'] .'+'.$duration .'days');
												?>
												<div class="col-lg-8 col-md-7 col-sm-6 courseInfo">
													<h5><?php echo ucfirst($free_course['title']);?>, <?php echo $showDuration; ?></h5>
													<ul class="courseUl">
														<li>
															<a href="#"><?=$free_course['instructor_email']?>(instructor email address)</a>
														</li>
														<li style="color:#090;">
														Start Date: <?php echo date("M d, Y h:i:sa", strtotime($free_course['start_at']));?>
														</li>
														<li style="color:#090;">
														<?php if($duration > 0){ ?>
															End Date: <?php echo date("M d, Y h:i:sa", $enddate);?>
														<?php }else{ ?>
															End Date: <?php echo date("M d, Y", $enddate).' 11:59:59pm';?>
														<?php } ?>
														</li>                                                    
														<li>
														<?=nl2br(substr($free_course['about'],0,300));?>...
														</li>                                                    
													</ul>  
													<?php if($free_course['enroll_id'] == ''){ ?>
													<a class="btnBlue" href="javascript:booknow(<?=$free_course['course_id']?>,<?=$free_course['course_time_id']?>)" >
														<?=$term["enrollnow"]?>
													</a>
													<?php }else { ?>
														<a class="btnBlue" href="javascript:viewcourse(<?=$free_course['course_id']?>)" >
															<?=$term["viewcourse"]?>
														</a>
													<?php } ?>
													<a href="<?=base_url()?>learner/live/viewclass/<?=$free_course['training_id']?>" class="btnBlue">Course Details</a>
												</div><!--col-8-->
											</div><!--row-->
										</div><!--whitePanel-->
									<?php } 
									} 
								} ?>

								<?php foreach($paid_course_list as $paid_course){		
									if($course['course_self_time'] == "Time Restricted"){
										$showDuration = $paid_course['duration'] > 1 ? $paid_course['duration']. " Days" : $paid_course['duration']." Day";
										$duration = $paid_course['duration'] - 1;
										$enddate = strtotime('+'.$duration .' days', strtotime($paid_course['start_at']. " " . $paid_course['end_time']));
										$currentdays = time();
									}else{
										$enddate = $paid_course['duration'] * 8 * 24 * 60;
										$currentdays = $paid_course['session_time']?$paid_course['session_time']:0;
									}
									
									if($currentdays <= $enddate){ ?> 
										<div class="whitePanel">
											<div class="row">
												<div class="col-lg-4 col-md-5 col-sm-6">
													<div class="leftImgBox">
														<?php
															$imgName = end(explode('/', $paid_course['img_path']));
															if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName)){								
														?>
															<img src="<?php echo base_url($paid_course['img_path']); ?>" class="rounded img-fluid" alt="learnerlearner">
														<?php }else{ ?>
															<img src="<?php echo base_url().'assets/uploads/vilt-default.png'; ?>" class="rounded img-fluid" alt="learnerlearner">                                		
														<?php } ?>
													</div><!--leftImgBox-->
												</div><!--col-4-->
												
												<?php
													$showDuration = $paid_course['duration'] > 1 ? $paid_course['duration']. " Days" : $paid_course['duration']." Day";												
													$duration = $paid_course['duration'] - 1;
													$enddate = strtotime($paid_course['start_at'] .'+'.$duration .'days');
												?>
												<div class="col-lg-8 col-md-7 col-sm-6 courseInfo">
													<h5><?php echo ucfirst($paid_course['title']);?>, <?php echo $showDuration; ?></h5>
													<ul class="courseUl">
														<li>
															<a href="#"><?=$paid_course['instructor_email']?>(instructor email address)</a>
														</li>
														<li style="color:#090;">
														Start Date: <?php echo date("M d, Y h:i:sa", strtotime($paid_course['start_at']));?>
														</li>
														<li style="color:#090;">
														<?php if($duration > 0){ ?>
															End Date: <?php echo date("M d, Y h:i:sa", $enddate);?>
														<?php }else{ ?>
															End Date: <?php echo date("M d, Y", $enddate).' 11:59:59pm';?>
														<?php } ?>
														<p>USD $: <?= $paid_course['pay_price']?></p>

														</li>                                                    
														<li>
														<?=nl2br(substr($paid_course['about'],0,300));?>...
														</li>                                                    
													</ul>  
													<?php if(!$paid_course['pay_id']){ ?>
														<a class="btnBlue" href="<?=base_url()?>pricing/payment/<?=$paid_course['course_id']?>/course" >
															Pay Now
														</a>
													<?php }else if(!$paid_course['enroll_id']){ ?>
														<a class="btnBlue" href="javascript:booknow(<?=$paid_course['course_id']?>,<?=$paid_course['course_time_id']?>)" >
															<?=$term["enrollnow"]?>
														</a>
													<?php } else{?>
														<a class="btnBlue" href="javascript:booknow(<?=$paid_course['course_id']?>,<?=$paid_course['course_time_id']?>)" >
															<?=$term["viewcourse"]?>
														</a>
													<?php }?>
													<!-- <a href="<?=base_url()?>learner/live/viewclass/<?=$paid_course['training_id']?>" class="btnBlue">Course Details</a> -->
												</div><!--col-8-->
											</div><!--row-->
										</div><!--whitePanel-->
									<?php } 
								} ?>
							</div><!--col-12-->
							<div class="col-sm-12 paginationBox">
	                            <?php echo $links ?>
							</div><!--col-12-->
						<?php }else{ ?>
							<div class="col-sm-12">
								<p style="text-align: center">No record found.</p>
							</div>
						<?php } ?>
					</div><!--row-->
				</div><!--courseBox-->
			</div><!--col-12-->
		</div><!--row-->
	</div><!--container-->
</section><!--sectionBox-->
</div>
</div>
</section>


<script type="text/javascript">
	paypal.Buttons({
		style: {
			layout:  'horizontal',
			color:   'gold',
			shape:   'rect',
			label:   'paypal',
			tagline: 'false'
		},
		createOrder: function(data, actions) {
		// This function sets up the details of the transaction, including the amount and line item details.
		return actions.order.create({
			purchase_units: [{
			amount: {
				value: '0.01'
			}
			}]
		});
		},
		onApprove: function(data, actions) {
		// This function captures the funds from the transaction.
		return actions.order.capture().then(function(details) {
			// This function shows a transaction success message to your buyer.
			alert('Transaction completed by ' + details.payer.name.given_name);
		});
		}
	}).render('#paypal-button-container');
	var isLogin = "<?php echo $this->session->userdata ('isLoggedIn')?>";
	$(function(){
        $("ul.pagination a").addClass('page-link');
    });
	function booknow(course_id,id) {
        $.ajax({
            url: $('#base_url').val()+'learner/live/booknow',
            type: 'POST',
            data: {'course_time_id': id, 'course_id': course_id},
            success: function (data, status, xhr) { 
                new PNotify({
                    title: 'Success',
                    text: 'Success Book Now',
                    type: 'success'
                });
                location.reload();
            },
            error: function(data){
                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['alreadybooking']; ?>',
                    type: 'warning'
                });
            }
        });
    }
	function pay_now(course_id,training_id, course_time_id, price) {
        swal({
			title: "You have to pay $"+price+" to take part in this course",
			buttons: true
		}).then((willDelete) => {
			if (willDelete) {
			$.ajax({
				url: "<?php echo base_url() ?>learner/live/pay_course",
				type: 'POST',
				data: {'course_id':training_id,'time_id':course_time_id,'vilt_course_id':course_id},
				dataType : 'json',
				success: function(data){
					if(data == 'success') {
						swal({
							title: "You have successfully enroll this course. Please wait until course is started!",
						});
						setTimeout(function(){ location.reload(); }, 10000);
					}else{
						swal({
							title: " Error!",
						});
					}
								
				}
			});
			} else {
			// return;
			}
		});
    }
	function enroll(id,pay_type,time_id){
		if(!isLogin){
			showLogin();
		}else{
			if(pay_type == 0){
				window.location = '<?=base_url()?>learner/demand/detail_course/' + id+'/'+time_id;
			}else if(pay_type == 1){
				swal({
				  title: "Are you sure?",
				  buttons: true
				}).then((willDelete) => {
				  if(willDelete) {
					window.location = "<?=base_url()?>learner/demand/pay_course/"+ id+'/'+time_id;
				  }else{
				    return;
				  }
				});
			}
		}
	}
	
	function view_course(id,time_id){
        if(!isLogin){
            showLogin();
        }else{
            window.location = '<?=base_url()?>learner/demand/detail_course/' + id+'/'+time_id;
        }
    }
	$("#course_id").on('change',(function () {
        window.location = $('#base_url').val()+ 'learner/live?course='+$("#course_id").val();
    }));
</script>


