@extends('allegro::layouts.admin.app')

@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <!--div class="page-title">
              <div class="title_left">
                <h3>Form Wizards</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
                </div>
              </div>
            </div-->
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create <small>Auction</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- Smart Wizard -->
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps test">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Step 1<br />
                                              <small>Step 1 description</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br />
                                              <small>Step 2 description</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Step 3<br />
                                              <small>Step 3 description</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Step 4<br />
                                              <small>Step 4 description</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      <div id="step-1">
                               

                        <form class="form-horizontal form-label-left" id="add_auction" ref="form">
                          @csrf

            
                          <input type="hidden" name="_token" value="{{csrf_field()}}" v-model="store.token" >
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="action-name">Auction Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="action-name" required="required" v-model="store.auction_name"  name="auction_name" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category-id"> Category <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="category_id" name="category_id" class="form-control col-md-7 col-xs-12" v-model="store.category_id" required="required">
                                <option value="">Select Category</option>
                                @foreach($categories->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                              <input type="hidden" name="check_auction" value="0" id="check_auction" />
                            </div>
                          </div>
                          <div class="form-group">
                          <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                           <button type="button" class="addauction btn btn-success">Add</button>
                            <a href="javascript:void();" v-on:click="submit">SUBMIT</a>  
                          </div>
                          </div>
                        </form>
                      </div>
                      <div id="step-2">
                            <form class="form-horizontal form-label-left" novalidate>

                              <!--p>For alternative validation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a>
                              </p-->
                              <span class="section">Auction Info</span>

                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Auction Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="text">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Select Category <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="category_info_id" name="category_id" class="form-control col-md-7 col-xs-12" required="required">
                                  <option>Select Category</option>
                                  @foreach($categories->categories as $category)
                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                                </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Confirm Email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="email" id="email2" name="confirm_email" data-validate-linked="email" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="number" id="number" name="number" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website URL <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="url" id="website" name="website" required="required" placeholder="www.website.com" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Occupation <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="occupation" type="text" name="occupation" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label for="password" class="control-label col-md-3">Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telephone <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="tel" id="telephone" name="phone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Textarea <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <textarea id="textarea" required="required" name="textarea" class="form-control col-md-7 col-xs-12"></textarea>
                                </div>
                              </div>
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                  <input type="hidden" name="check_info_auction" value="0" id="check_info_auction" />
                                  <button type="button" class="btn btn-primary">Cancel</button>
                                  <button id="send" type="button" class="btn btn-success">Submit</button>
                                </div>
                              </div>
                            </form>
                      </div>
                      <div id="step-3">
                        <h2 class="StepTitle">Step 3 Content</h2>
                        <p>
                          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                          eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                          in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                      </div>


                    </div>
                    <!-- End SmartWizard Content -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
          <script>
          $(document).ready(function(){
            //https://github.com/mstratman/jQuery-Smart-Wizard
            $('#wizard').smartWizard({
                // Properties
                  selected: 0,  // Selected Step, 0 = first step   
                  keyNavigation: true, // Enable/Disable key navigation(left and right keys are used if enabled)
                  enableAllSteps: false,  // Enable/Disable all steps on first load
                  transitionEffect: 'fade', // Effect on navigation, none/fade/slide/slideleft
                  contentURL:null, // specifying content url enables ajax content loading
                  contentURLData:null, // override ajax query parameters
                  contentCache:true, // cache step contents, if false content is fetched always from ajax url
                  cycleSteps: false, // cycle step navigation
                  enableFinishButton: false, // makes finish button enabled always
                  hideButtonsOnDisabled: false, // when the previous/next/finish buttons are disabled, hide them instead
                  errorSteps:[],    // array of step numbers to highlighting as error steps
                  labelNext:'Next', // label for Next button
                  labelPrevious:'Previous', // label for Previous button
                  labelFinish:'Finish',  // label for Finish button        
                  noForwardJumping:leaveAStepCallback,
                  ajaxType: 'POST',
                // Events
                  onLeaveStep:leaveAStepCallback,
                  onFinish:null, // triggers when leaving a step
                  onShowStep: showstep,  // triggers when showing a step
                  buttonOrder: ['finish', 'next', 'prev']  // button order, to hide a button remove it from the list
              }); 
 //               $("#wizard").smartWizard('goForward','here'});
                  // $('#wizard').smartWizard({
                  //     onLeaveStep:leaveAStepCallback,
                  //     onFinish:onFinishCallback
                  //   });
              $(".addauction").on("click",function(){
                                      var form_data = $("#add_auction").serialize();
                      var url  = "{{ url('admin/auction/add') }}";
                      //alert(url);

                              $.ajax({
                                      type: "POST",
                                      url: url,
                                      data: form_data, 
                                      success: function( response ) {
                                        response = jQuery.parseJSON(response);
                                        console.log(response.error);
                                        if(response.error != "0"){
                                          alert(response.error);
                                          return false;
                                        }else{
                                          var check_auction = $("#check_auction").val(1);
                                          $(".buttonNext").trigger( "click" );
                                        } 
                                      }
                                  });
              });

                  function leaveAStepCallback(obj, context){
                      //alert("Leaving step " + context.fromStep + " to go to step " + context.toStep);
                        if(context.fromStep == 1){
                          //check_info_auction
                            var check_auction = $("#check_auction").val();
                            
                              if(check_auction == 0){
                                alert("please fill auction name and category.");
                                return false;
                              }else{
                                return true;
                              }

                        }else if(context.fromStep == 2){
                          var check_info_auction = $("#check_info_auction").val();
                          if(check_info_auction == 0){
                                alert("please fill all detail.");
                                return false;
                              }else{
                                return true;
                              }
                          return false;
                        }
                      //return validateSteps(context.fromStep); // return false to stay on step and true to continue navigation 
                  }

                  function onFinishCallback(objs, context){
                      if(validateAllSteps()){
                          $('form').submit();
                      }
                  }
 
                  function showstep(obj, context){
                   // alert("showing step " + context.fromStep + " to go to step " + context.toStep);
                    return ;
                  }

                  // Your Step validation logic
                  function validateSteps(stepnumber){
                    alert(stepnumber);
                      isStepValid = false; //if has errors
                      return isStepValid;
                      // validate step 1
                      if(stepnumber == 1){
                          // Your step validation logic
                          // set isStepValid = false if has errors
                      }
                      // ...      
                  }
                  function validateAllSteps(){
                      var isStepValid = true;
                      // all step validation logic     
                      return isStepValid;
                  }   

          });   
        </script>

        <script src="{{asset('js/app.js')}}" ></script>
        <script>
          


        </script>
        <!-- /page content -->
@endsection        