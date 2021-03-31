		<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
						<div class="modal-body modal-body-sub_agile">
						<div class="col-md-12 modal_body_left modal_body_left1">
						<h3 class="agileinfo_sign">Order  <span>History</span></h3>
                                                <div id="emptyfields"></div>
							<div class="styled-input agile-styled-input-top">
                                                            <input type="text" name="phone" id="phone" required="">
								<label>Phone Number</label>
								<span></span>
							</div>
							<div class="styled-input">
                                                            <input type="text" name="billno" id="bill" required=""> 
								<label>Order number</label>
								<span></span>
							</div> 
                                                <input type="submit" value="PROCEED" id="ohist">
                                                <script>
                                                $('#ohist').click(function(){
                                                   var phone=$('#phone').val();
                                                   var billno=$('#bill').val();
                                                   
                                                   var ldbtn=$('#ohist');
                                                   
                                                   if(phone===''||billno===''){
                                                     $('#emptyfields').html("<div class='alert alert-warning alert-dismissible show' role='alert'><strong id='empt'>Empty Field!</strong><button type='button' style='color:red; font-size:1.2em' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");  
                                                   }
                                                   else {
                                                   $.ajax({
                                                            url	:	"loginval.php",
                                                            method	:	"POST",
                                                            data	:	{phone:phone,billno:billno},
                                                            beforeSend: function(){
                                                                    ldbtn.val('Requesting..');
                                                                  },
                                                            complete: function(){
                                                               ldbtn.val('Sent');
                                                            },
                                                            success	:	function(data){
                                                                    if(data==='Success'){
                                                                       ldbtn.val('Redirecting..'); 
                                                                       window.location.href="ohist";
                                                                    }
                                                                    else if(data==='Incorrect') {
                                                                        ldbtn.val('Login');
                                                                      $('#emptyfields').html("<div class='alert alert-warning alert-dismissible show' role='alert'><strong id='empt'>Incorrect Details</strong><button type='button' style='color:red; font-size:1.2em' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");  
                                                                    }
                                                                    else {
                                                                        ldbtn.val('Login');
                                                                        $('#emptyfields').html("<div class='alert alert-warning alert-dismissible show' role='alert'><strong id='empt'>Error!</strong><button type='button' style='color:red; font-size:1.2em' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");  
                                                                    }
                                                            }
                                                    });
                                                    }
                                                });
                                                </script>
						 
														

						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //Modal content-->
			</div>
		</div>
<!-- //Modal1 -->
<!-- Modal2 -->
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
						<div class="modal-body modal-body-sub_agile">
						<div class="col-md-8 modal_body_left modal_body_left1">
						<h3 class="agileinfo_sign">Sign Up <span>Now for great offers</span></h3>
						 <form action="registerval.php" method="post">
							<div class="styled-input agile-styled-input-top">
								<input type="text" name="Name" required="">
								<label>Name</label>
								<span></span>
							</div>
							<div class="styled-input">
								<input type="text" name="Phone" required=""> 
								<label>Phone Number</label>
								<span></span>
							</div>
							<div class="styled-input">
								<input type="email" name="Email" required=""> 
								<label>Email</label>
								<span></span>
							</div> 
							<div class="styled-input">
								<input type="password" name="Password" required=""> 
								<label>Password</label>
								<span></span>
							</div> 
							<div class="styled-input">
								<input type="password" name="repassword" required=""> 
								<label>Retype password</label>
								<span></span>
							</div> 
							<input type="submit" value="Sign Up">
						</form>
						   <ul class="social-nav model-3d-0 footer-social w3_agile_social top_agile_third">
															<li><a href="https://www.facebook.com/Queensclassycollections/" class="facebook">
																  <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
															<li><a href="https://www.instagram.com/queensclassycollections/" class="instagram">
																  <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
							</ul>														<div class="clearfix"></div>
														<p><a href="#">By clicking register, I agree to your terms</a></p>

						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //Modal content-->
			</div>
		</div>
