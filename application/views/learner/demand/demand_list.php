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

<section role="main" class="content-body" style="width:initial;">
    <header class="page-header">
        <h2>On Demand Course</h2>

        <div class="right-wrapper">
        </div>
    </header>

	<div class="row demand-page">
		<div class="col-lg-12">
			<section class="card" style="padding: 0px">
		<header class="card-header">
		<div class="card-actions">
            <a href="<?=base_url()?>learner/demand/viewCourseHistory" class="btn btn-default">Course History </a>
		</div>
		<h2 class="card-title">On Demand Course List</h2>
	</header>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="catalogBox">
					<div class="row">
						<div class="col-sm-12">
							<div class="sortPanel">
								<div class="sortSet">
                                    <select id="category_id" name="category_id">
                                        <option value="0"> Select Category </option>
                                        <?php foreach($category as $item){ ?>
                                            <option value="<?php echo $item['id']; ?>" <?php $category_id==$item['id']?print 'selected':print ''; ?>> <?php echo $item['name']; ?></option>
                                        <?php }  ?>
                                    </select>
                                     
                                    <select id="course_id" name="course_id" style="border: 1px solid #ccc !important;padding: 8px 10px !important;">
                                        <option value="0"> Select Course </option>
                                        <?php foreach($coursesfilter as $courseitem){
											$endday = strtotime($courseitem->end_at);	
																		
											$currentday = time();
											if($currentday <= $endday){
										?>
                                            <option value="<?php echo $courseitem->id; ?>" <?php $courses_id==$courseitem->id?print 'selected':print ''; ?>> <?php echo $courseitem->title; ?></option>
                                        <?php } } ?>
                                    </select>
								</div><!--sortSet-->
							</div><!--sortPanel-->
						</div><!--col-12-->
					</div><!--row-->
					
					<div class="row">
						<?php if($free_course_list || $paid_course_list){?>
							<div class="col-sm-12">
								<?php foreach($free_course_list as $free_course):
									$enddays = strtotime($free_course['end_at']);	
									$currentdays = time();
									if($currentdays <= $enddays){
								?>
                                
									<div class="whitePanel">
										<div class="row">
											<div class="col-lg-4 col-md-5 col-sm-6">
												<div class="leftImgBox">
                                                <?php
													$imgName = end(explode('/', $free_course['img_path']));
													if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName)){								
												?>
													<img src="<?php echo base_url($free_course['img_path']); ?>">
                                               <?php }else{ ?>
               										<img src="<?php echo base_url().'assets/uploads/on-demand-default.png'; ?>">                                		
                                               <?php } ?>
												</div><!--leftImgBox-->
											</div><!--col-4-->
											<div class="col-lg-8 col-md-7 col-sm-6 courseInfo">
												<h5><?php echo ucfirst($free_course['title']);?></h5>
												<ul class="courseUl">
													<!-- <li>
														<a href="#"><?php echo $free_coursefirst_instructor['email']?></a>
													</li> -->
													<li><?php echo $free_course['course_self_time']; ?></li>
                                                    <span style="color:#090;"><li> Start Date: <?php echo date("M d, Y", strtotime($free_course['start_at']));?></li></span>
             										<span style="color:#090;"><li> End Date: <?php echo date("M d, Y", strtotime($free_course['end_at']));?></li></span>
												</ul>
		     	                               	<?php if(is_null($course->is_pay['id'])){?>
												    <a href="javascript:enroll(<?php echo $free_course['id'] ?>,<?php echo $free_course['pay_type'] ?>,'0')" class="btnBlue">Enroll Now</a>
		                                        <?php }else {?>
		                                            <a href="javascript:view_course(<?php echo $free_course['id'] ?>,0)" class="btnBlue">Access Course</a>
		                                        <?php }?>
												<a href="<?=base_url()?>learner/demand/view_course/<?=$free_course['id']?>" class="btnBlue">View Course</a>
											</div><!--col-8-->
										</div><!--row-->
									</div><!--whitePanel-->
								<?php  } endforeach; ?>

								<?php foreach($paid_course_list as $paid_course):
									$enddays = strtotime($paid_course['end_at']);	
																
									$currentdays = time();
									if($currentdays <= $enddays){
								?>
                                
									<div class="whitePanel">
										<div class="row">
											<div class="col-lg-4 col-md-5 col-sm-6">
												<div class="leftImgBox">
                                                <?php
													$imgName = end(explode('/', $paid_course['img_path']));
													if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName)){								
												?>
													<img src="<?php echo base_url($paid_course['img_path']); ?>">
                                               <?php }else{ ?>
               										<img src="<?php echo base_url().'assets/uploads/on-demand-default.png'; ?>">                                		
                                               <?php } ?>
												</div><!--leftImgBox-->
											</div><!--col-4-->
											<div class="col-lg-8 col-md-7 col-sm-6 courseInfo">
												<h5><?php echo ucfirst($paid_course['title']);?></h5>
												<ul class="courseUl">
													<!-- <li>
														<a href="#"><?php echo $paid_coursefirst_instructor['email']?></a>
													</li> -->
													<li><?php echo $paid_course['course_self_time']; ?></li>
                                                    <span style="color:#090;"><li> Start Date: <?php echo date("M d, Y", strtotime($paid_course['start_at']));?></li></span>
             										<span style="color:#090;"><li> End Date: <?php echo date("M d, Y", strtotime($paid_course['end_at']));?></li></span>
													<span style="color:#090;"><li>USD $: <?= $paid_course['pay_price']?></li></span>

												</ul>
												<?php if(!$paid_course['pay_id']){ ?>
													<div style="width:150px;" id="paypal-button-container"></div>
													<img style="width:150px; float:left" alt="Visa Checkout" class="v-button" role="button" src="https://sandbox.secure.checkout.visa.com/wallet-services-web/xo/button.png">

													<!-- <a class="btnBlue" href="javascript:pay_now(<?=$paid_course['course_id']?>,<?=$paid_course['training_id']?>,<?=$paid_course['course_time_id']?>,<?=$paid_course['pay_price']?>)" >
														Pay Now
													</a> -->
                                                <?php }else if(!$paid_course['enroll_id']){ ?>
													<a class="btnBlue" href="javascript:booknow(<?=$paid_course['course_id']?>,<?=$paid_course['course_time_id']?>)" >
														<?=$term[enrollnow]?>
													</a>
												<?php } else{?>
													<a style = "float:left; margin-top:-20px; margin-left: 20px" class="btnBlue" href="javascript:booknow(<?=$paid_course['course_id']?>,<?=$paid_course['course_time_id']?>)" >
														<?=$term[viewcourse]?>
													</a>
												<?php }?>
												<a  style = "float:left; margin-top:-20px; margin-left: 20px" href="<?=base_url()?>learner/demand/view_course/<?=$paid_course['id']?>" class="btnBlue">View Course</a>
											</div><!--col-8-->
										</div><!--row-->
									</div><!--whitePanel-->
								<?php  } endforeach; ?>
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
    var isLogin = "<?php echo $this->session->userdata ('isLoggedIn')?>";
	var email = "<?php echo $this->session->userdata ( 'email' )?>";
	var userId = "<?php echo $this->session->userdata('userId')?>";
	$(function(){
        $("ul.pagination a").addClass('page-link');
    });

    $("#category_id").on('change',(function () {
        window.location = '<?=base_url()?>learner/demand?category=' + $("#category_id").val();
    }));
	
	$("#course_id").on('change',(function () {
        window.location = '<?=base_url()?>learner/demand?course=' + $("#course_id").val();
    }));
	
	function enroll(id,pay_type,time_id){	
		if(!isLogin){
			showLogin();
		}else{
			if(pay_type == 0){
				window.location = '<?=base_url()?>learner/demand/detail_course/' + id+'/'+time_id;
			}else if(pay_type == 1){							
				$.ajax({
		            url: "<?php echo base_url() ?>admin/inviteuser/get_Inviteuser",
		            type: 'POST',
		            data: {'email':email,'type':'2','course_id':id},
		            dataType : 'JSON',
		            success: function(data){
		                var cnt = data;
		                if(cnt == 1) {
		                	window.location = '<?=base_url()?>learner/demand/detail_course/' + id+'/'+time_id;
		                }else{
		                	swal({
							  title: "You have to pay $99 to take part in this course",
							  buttons: true
							}).then((willDelete) => {
							  if (willDelete) {
							  	//window.location = company_url + '/classes/detail/' + id;	
								window.location = 'https://shop.gosmartacademy.com/shop/?add-to-cart='+id+'&user_id='+userId;
							  } else {
							    return;
							  }
							});
		                }		                		  
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
</script>