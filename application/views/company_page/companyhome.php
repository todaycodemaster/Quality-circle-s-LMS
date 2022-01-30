<section class="companyhomeBanner"></section>
<!--<div style="height: 600px;width: 100%;background-color:black;opacity: 0.3;position: absolute;top: 70px;">

</div>-->
<div class="cover-text" style="margin-top: 70px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 bannerTextBox">
                <h1>Quality Circle Virtual Academy</h1>
                <p>Where Technology meets Learning in the Global Parade Square</p>
            </div>

            <div class="col-md-12 bannerTextBox">
                <p>Virtual Learning;</p>
                <p>It is in the minds eye. It’s not with you it is in you!!!</p>
            </div>
        </div><!--row-->
    </div><!--container-->
</div>
<section class="sectionBox">
	<div class="container"> 
		<h2 class="titleH2 text-center">On Demand Training</h2>
		<div class="row">
		<?php if(!empty($demandCourses)){ ?>	
			<?php foreach($demandCourses as $course){ ?>
			<div class="col-md-4 col-sm-4 col-xs-6 col-full">
				<div class="courseBox">
					<div class="courseImg">
                    	<?php
							$imgName = end(explode('/', $course['img_path']));
							$ext = pathinfo($imgName, PATHINFO_EXTENSION);
							if($imgName != '' && file_exists(getcwd().'/'.$course['img_path']) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){
						?>
							<img style="cursor: pointer" src="<?php echo base_url($course['img_path']); ?>" onclick="javascript:view_course(<?php echo $course['id'] ?>)">
					   	<?php }else{ ?>
							<img style="cursor: pointer" src="<?php echo base_url().'assets/uploads/on-demand-default.png'; ?>" onclick="javascript:view_course(<?php echo $course['id'] ?>)">
               			<?php } ?>
					</div><!--courseImg-->
					<div class="courseInfo">
						<h5 style="cursor: pointer" onclick="javascript:view_course(<?php echo $course['id'] ?>)"><?php echo ucfirst($course['title'])?></h5>
						<ul class="courseUl">
							<li style="height:25px">
								<a href="#"><?php echo $course['first_instructor']['email']?></a>
							</li>
							<li>                           
							<?php echo $course['course_self_time']; ?>
                            </li>
                            <?php $start_date = date("M d, Y", strtotime($course['start_at'])); ?>
                            <li> Start Date: <?php echo $start_date; ?></li>
             				<li> End Date: <?php echo date("M d, Y", strtotime($course['end_at']));?></li>
							<li> Price: $<?= $course['pay_price']?></li>
							<li> Discount: <?= $course['discount']?>%</li>
							<li> Cost: $<?= $course['amount']?></li>
						</ul>
					</div><!--courseInfo-->
					<div class="coursePrice">
						<div class="row">
							<div class="col-sm-6 col-xs-6">
								<span class="price" style="font-size: 22px;">
								<?php echo $course['pay_type'] == 0 ? 'Onsite Training' : '$'.number_format($course['amount'],2); ?>
								</span>
							</div>
							<div class="col-sm-6 col-xs-6">
                                <?php if(is_null($course['is_pay']['id'])){ ?>
									<a href="javascript:enroll(<?php echo $course['id'] ?>,<?php echo $course['pay_type'] ?>)" class="btnBlue">Enroll Now</a>
								<?php
									
									/*
									$active = 'No';
                                	$start_at = strtotime($course['start_at']);
                                    $end_at = strtotime($course['end_at']);
                                    
                                    $currentDate = time();
                                    if($currentDate >= $start_at && $currentDate <= $end_at){
                                        $active = 'Yes';
                                    }
									if($active == 'Yes'){
								?>
                                    <a href="javascript:enroll(<?php echo $course['id'] ?>,<?php echo $course['pay_type'] ?>)" class="btnBlue">Enroll Now</a>
                                <?php }else{ ?>
                                	<?php $startdatetime = date('d, M Y h:i:sa',$start_at); ?>
                                	<a href="javascript:void(0)" onclick='swal({title: "Please wait until course is started! Course start date time is: <?php echo $startdatetime ;?>"});'  class="btnBlue">Enroll Now</a>
                                <?php } */ ?>                                    
                                <?php }else {?>
                                    <a href="javascript:view_course_detail(<?php echo $course['id'] ?>,0)" class="btnBlue">Access Course</a>
                                <?php }?>
							</div>
						</div><!--row-->
					</div><!--coursePrice-->
				</div><!--courseBox-->
			</div><!--col-4-->
			<?php } } else{ ?>
				<div class="col-md-4 col-sm-6 col-xs-6 col-full">
                    <div class="courseBox">
                        <div class="courseImg">
                            <img style="cursor: pointer" src="<?php echo base_url().'assets/uploads/on-demand-default.png'; ?>">
                            <?php /*?><h2 style=" color:#666;margin-top: 94px;text-align: center;">No Record Found!</h2><?php */?>
                        </div> <!--courseImg-->                      
                    </div><!--courseBox-->
                </div><!--col-4-->
		<?php } ?>
		</div><!--row-->
		<div class="row">
			<div class="col-sm-12 text-center">
				<a href="<?php echo base_url($company['company_url'])?>/demand" class="browseAll">Browse All</a>
			</div>
		</div>	
	</div><!--container-->
</section><!--sectionBox-->

<section class="sectionBox">
    <div class="container">
        <h2 class="titleH2 text-center">Instructor Led Training</h2>
        <div class="row">
		<?php if(!empty($trainCourses)){ ?>
            <?php foreach ($trainCourses as $course){ if($course['date_str'] != '' || $course['date_str'] != 0){ ?>
                <div class="col-md-4 col-sm-6 col-xs-6 col-full">
                    <div class="courseBox">
                        <div class="courseImg">
							<?php
                                $imgName = end(explode('/', $course['img_path']));
								$ext = pathinfo($imgName, PATHINFO_EXTENSION);
                                if($imgName != '' && file_exists(getcwd().'/'.$course['img_path']) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){							
                            ?>
                                <img style="cursor: pointer" src="<?php echo base_url($course['img_path']); ?>" onclick="javascript:view_ILT_course(<?php echo $course['course_time_id'] ?>)">
                            <?php }else{ ?>
                                <img style="cursor: pointer" src="<?php echo base_url().'assets/uploads/ilt-default.png'; ?>" onclick="javascript:view_ILT_course(<?php echo $course['course_time_id'] ?>)">                                		
                            <?php } ?>
                        </div> <!--courseImg-->

                        <div class="courseInfo">
                            <h5 style="padding-bottom: 15px;"><?php echo ucfirst($course['title'])?></h5>                    
                            <ul class="courseUl">
                            	<li style="height:25px"><a href="#"><?php echo $course['first_instructor']['email']?></a></li>
                                <li>                            
                                <?php echo $course['course_self_time']; ?>
                                </li>
                                <?php
									
									$showDuration = $course['duration'] > 1 ? $course['duration']. " Days" : $course['duration']." Day";
									$duration = $course['duration'] - 1;
									$enddate = strtotime('+'.$duration .' days', strtotime($course['start_day']. " " . $course['end_time']));
								?>
                                <li>Duration: <?php echo $showDuration; ?> </li>
                                <li> Start Date: <?php echo date("M d, Y h:i:sa", strtotime($course['start_day'] . " " . $course['start_time']));?></li>
								<li> End Date: <?php echo date("M d, Y h:i:sa", $enddate);?></li>
                                <li> Price: $<?= $course['pay_price']?></li>
								<li> Discount: <?= $course['discount']?>%</li>
								<li> Cost: $<?= $course['amount']?></li>
                            </ul>
						</div>
						<div class="row coursePrice">
							<div class="col-sm-6 col-xs-6">
								<span class="price" style="font-size: 22px;">
								<?php echo $course['pay_type'] == 0 ? 'Onsite Training' : '$'.$course['amount']; ?>
								</span>
							</div>
							<?php if($course['pay_type']){
									$pay = $course['pay_type'];
								}else{
									$pay = '0';
								}
							?>
							<div class="col-sm-6 col-xs-6">
								<a href="javascript:enroll_virtual(<?php echo $course['id'] ?>,<?php echo $pay ?>,<?php echo $course['virtual_course_time_id'] ?>,<?php echo $course['course_id']; ?>)" class="btnBlue">Enroll Now</a>
								<?php /*
									$activev = 'No';
									$start_datev = strtotime($course['start_at']);
									$currentDatevilt = time();
									if($currentDatevilt >= $start_datev && $currentDatevilt <= $enddate){
										$activev = 'Yes';
									}
									if($activev == 'Yes'){
								?>
								<a href="javascript:enroll_virtual(<?php echo $course['virtual_course_time_id'] ?>,<?php echo $pay; ?>,'<?php echo $course['url']?>')" class="enrollNow">Enroll Now</a>
								<?php } else{ ?>
								<?php
									$startdatetime = date('d, M Y h:i:sa',strtotime($course['start_at']));
								?>
									<a href="javascript:void(0)" onclick='swal({title: "Please wait until course is started! Course start date time is: <?php echo $startdatetime ;?>"});' class="enrollNow">Enroll Now</a>
								<?php } */?>
							</div>
						</div><!--row-->
                    </div><!--courseBox-->
                </div><!--col-4-->
		<?php } } } else{ ?>
				<div class="col-md-4 col-sm-6 col-xs-6 col-full">
                    <div class="courseBox">
                        <div class="courseImg">
                        	<?php /*?><h2 style=" color:#666;margin-top: 94px;text-align: center;">No Record Found!</h2><?php */?>
                            <img style="cursor: pointer" src="<?php echo base_url().'assets/uploads/ilt-default.png'; ?>"> 
                        </div> <!--courseImg-->                      
                    </div><!--courseBox-->
                </div><!--col-4-->
		<?php } ?>
        </div><!--row-->

        <div class="row">
            <div class="col-sm-12 text-center">
                <a href="<?php echo base_url($company['company_url'])?>/training" class="browseAll">Browse All</a>
            </div>
        </div>

    </div><!--container-->
</section><!--sectionBox-->

<section class="sectionBox">
	<div class="container">
		<h2 class="titleH2 text-center">Virtual Instructor Led Training</h2>
		<div class="row">	
		<?php if(!empty($virtualCourses)) {  ?>		
		<?php foreach($virtualCourses as $course){ ?>				
			<div class="col-md-4 col-sm-4 col-xs-6 col-full">
				<div class="courseBox">
					<div class="courseImg">
                    	<?php
							$imgName = end(explode('/', $course['virtual_course_path']));
							$ext = pathinfo($imgName, PATHINFO_EXTENSION);							
							if($imgName != '' && file_exists(getcwd().'/'.$course['virtual_course_path']) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){
							?>
                            	<img style="cursor: pointer" src="<?php echo base_url($course['virtual_course_path']); ?>" onclick="javascript:view_live(<?php echo $course['virtual_course_time_id'] ?>)">
                            <?php }else{ ?>
                            	<img style="cursor: pointer" src="<?php echo base_url().'assets/uploads/vilt-default.png'; ?>" onclick="javascript:view_live(<?php echo $course['virtual_course_time_id'] ?>)">
                            <?php } ?>
					</div><!--courseImg-->
					<div class="courseInfo">
						<h5 style="cursor: pointer" onclick="javascript:view_live(<?php echo $course['virtual_course_time_id'] ?>)"><?php echo ucfirst($course['title'])?></h5>
						<ul class="courseUl">
							<li style="height:25px"><a href="#"><?php echo $course['first_instructor']['email']?></a></li>
							<li>                            
							<?php echo $course['course_self_time']; ?>
                            </li>
                            <?php									
								$showDuration = $course['duration'] > 1 ? $course['duration']. " Days" : $course['duration']." Day";
								$duration = $course['duration'] - 1;
								$enddate = strtotime('+'.$duration .' days', strtotime($course['startday']. " " . $course['end_time']));
							?>
							<li>Duration: <?php echo $showDuration; ?> </li>
							<li> Start Date: <?php echo date("M d, Y h:i:sa", strtotime($course['startday'] . " " . $course['start_time']));?></li>
							<li> End Date: <?php echo date("M d, Y h:i:sa", $enddate);?></li>
							<li> Price: $<?= $course['pay_price']?></li>
							<li> Discount: <?= $course['discount']?>%</li>
							<li> Cost: $<?= $course['amount']?></li>
						</ul>
					</div><!--courseInfo-->
					<div class="coursePrice">
						<div class="row">
							<div class="col-sm-6 col-xs-6">
								<span class="price" style="font-size: 22px;">
								<?php echo $course['pay_type'] == 0 ? 'Onsite Training' : '$'.$course['amount']; ?>
								</span>
							</div>
							<?php if($course['pay_type']){
									$pay = $course['pay_type'];
								}else{
									$pay = '0';
								}
							?>
							<div class="col-sm-6 col-xs-6">
                                <a href="javascript:enroll_virtual(<?php echo $course['id'] ?>,<?php echo $pay ?>,<?php echo $course['virtual_course_time_id'] ?>,<?php echo $course['course_id']; ?>)" class="btnBlue">Enroll Now</a>
                            	<?php /*
									$activev = 'No';
									$start_datev = strtotime($course['start_at']);
									$currentDatevilt = time();
									if($currentDatevilt >= $start_datev && $currentDatevilt <= $enddate){
										$activev = 'Yes';
									}
									if($activev == 'Yes'){
								?>
								<a href="javascript:enroll_virtual(<?php echo $course['virtual_course_time_id'] ?>,<?php echo $pay; ?>,'<?php echo $course['url']?>')" class="enrollNow">Enroll Now</a>
                                <?php } else{ ?>
                                <?php
									$startdatetime = date('d, M Y h:i:sa',strtotime($course['start_at']));
								?>
                                	<a href="javascript:void(0)" onclick='swal({title: "Please wait until course is started! Course start date time is: <?php echo $startdatetime ;?>"});' class="enrollNow">Enroll Now</a>
                                <?php } */?>
							</div>
						</div><!--row-->
					</div><!--coursePrice-->
				</div><!--courseBox-->
			</div><!--col-4-->
		<?php } } else {  ?>
				<div class="col-md-4 col-sm-6 col-xs-6 col-full">
                    <div class="courseBox">
                        <div class="courseImg">
                            <img style="cursor: pointer" src="<?php echo base_url().'assets/uploads/vilt-default.png'; ?>">
                            <?php /*?><h2 style=" color:#666;margin-top: 94px;text-align: center;">No Record Found!</h2><?php */?>
                        </div> <!--courseImg-->                      
                    </div><!--courseBox-->
                </div><!--col-4-->
		<?php } ?>
		</div><!--row-->
		<div class="row">
			<div class="col-sm-12 text-center">
				<a href="<?php echo base_url($company['company_url'])?>/classes" class="browseAll">Browse All</a>
			</div>
		</div>
		
	</div><!--container-->
</section><!--sectionBox-->

<a class="mb-1 mt-1 mr-1 modal-basic btn btn-default alert-modal" href="#modalCenter" hidden></a>
<div id="modalCenter" class="modal-block mfp-hide">
   <section class="card">
      <div class="card-body">
         <div class="modal-wrapper">
            <div class="modal-text text-center">
               <p style="font-size:25px">You don’t have permission to access this user course. Please contact Administrator</p>
               <a style="background-color:green" class="btn btn-primary modal-confirm" href="mailto: admin@qualitycircleint.com"/> Contact</a>
               <button class="btn btn-default modal-dismiss">Cancel</button>
            </div>
         </div>
      </div>
   </section>
</div>

<script type="text/javascript"> 
	var company_url = "<?= base_url($company['company_url'])?>";
    var isLogin = "<?php echo $this->session->userdata ( 'isLoggedIn' )?>";
	var email = "<?php echo $this->session->userdata ( 'email' )?>";
    var user_type = "<?php echo $this->session->userdata('user_type')?>";
	var userId = "<?php echo $this->session->userdata('userId')?>";
	
	function enroll(id,pay_type){
		var temp = 1;
		if(temp == 1){
			if(!isLogin){
				showLogin();
			}else{
				if(pay_type == 0){
					window.location = company_url + '/demand/detail/' + id
				}else if(pay_type == 1){
					swal({
					  title: "Are you sure?",
					  buttons: true
					})
					.then((willDelete) => {
					  if (willDelete) {
						//window.location = company_url + '/demand/detail/' + id;	
						window.location = 'https://shop.gosmartacademy.com/shop/?add-to-cart='+id+'&user_id='+userId;
					  } else {
						return;
					  }
					});
				}
			}
		}
	}

    function view_course_detail(id){
        if(!isLogin){
            showLogin();
        }else{
            window.location = company_url + '/demand/detail/' + id;
        }
    }
	
	function enroll_virtual(id,pay_type,time_id,course_id){			
		if(!isLogin){
			showLogin();
		}else{
			if(pay_type == 1){
				if(user_type !== "Learner"){
					// window.location = "<?php echo VILT_URL?>"+id;
				}else{
					swal({
					  title: "You have to pay $99 to take part in this course",
					  buttons: true
					}).then((willDelete) => {
					  if (willDelete) {
						$.ajax({
							url: "<?php echo base_url() ?>learner/live/pay_course",
							type: 'POST',
							data: {'course_id':id,'time_id':time_id,'vilt_course_id':course_id},
							dataType : 'json',
							success: function(data){
								if(data == 'success') {
									swal({
									  title: "You have successfully enroll for this course!",
									});
									setTimeout(function(){ window.location.reload() }, 10000);
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
			}else if(pay_type == 0){
				$.ajax({
					url: "<?php echo base_url() ?>admin/inviteuser/get_Inviteuser",
					type: 'POST',
					data: {
							'email':email,
							'type':'1',
							'course_id':id,
							'time_id':time_id
						},
					dataType : 'json',
					success: function(data){
						var cnt = data;
						if(cnt == 1) {
							$.ajax({
								url: "<?php echo base_url() ?>learner/live/pay_course",
								type: 'POST',
								data: {'course_id':id,'time_id':time_id,'vilt_course_id':course_id},
								dataType : 'json',
								success: function(data){
									if(data == 'success') {
										swal({
										  title: "You have successfully enroll for this course!",
										});
										setTimeout(function(){ window.location.reload() }, 10000);
									}else{
										swal({
										  title: " Error!",
										});
									}
								}
							});							
						}else{
							//$('.alert-modal').click();
							swal({title: "You don’t have permission to access this user course. Please contact Administrator"});
						}
					}
				});
				
			}
		}
   }

	/*function enroll_virtual(id,pay_type,url){
		var temp = 1;
		if(temp == 1){
			if(!isLogin){
				showLogin();
			}else{
				if(pay_type == 0){
					if(user_type !== "Learner"){
						window.location = "<?php echo VILT_URL?>"+id;
					}else{
						if(url == null || url == undefined || url == ''){
							swal({
								title: "VILT Url Error!",
								text:"VILT is not available now. Please wait or contact your instructor"
							});
						}else{
							window.location = url+id;
						}
					}
				}else if(pay_type == 1){
					swal({
					  title: "Are you sure?",
					  buttons: true
					})
					.then((willDelete) => {
					  if (willDelete) {
					  //	window.location = company_url + '/classes/detail/' + id;	
					  } else {
						return;
					  }
					});
				}
			}
		}
	}*/
	
	function view_course(id){
		location.href = "<?php echo base_url($company['company_url'].'/demand/view/')?>"+id;
	}
    function view_ILT_course(id){
        location.href = "<?php echo base_url($company['company_url'].'/training/view/')?>"+id;
    }
	function view_live(id){
		location.href = "<?php echo base_url($company['company_url'].'/classes/view/')?>"+id;
	}
</script>