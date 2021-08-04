<!DOCTYPE html>
<html lang="">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="{{asset('public/backEnd/')}}/img/favicon.png" type="image/png"/>
    <title>Digital Academic ERP</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery-ui.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery.data-tables.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/flaticon.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/software.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" media="print"
          href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/js/select2/select2.css"/>
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/infix.css"/>
    <style>
        h2,h5{color: whitesmoke}
        .card-body {
            padding: 5.25rem;
        }

        .single-report-admit .card-header {
            background-position: right;
            margin-top: -5px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 20px;
        }
        .form-control{
          font-size: 11px !important;
          border: 1px solid #d73cff !important;
        }
#overlay {
  background: url(https://eskooly.com/img/Preloader_1.gif) center no-repeat #fff;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  opacity: .9;
  z-index: 9999;
  color:black;
  
}
#msg,#wrongemail,#msgok,#msg1,#wrongkey,#msgok1,#divCheckPasswordMatch{
		display:none;
		}
    </style>
</head>


<body class="admin">
 <div id="overlay" style="display:none;"></div>
<div class="container">
    <div class="col-md-6 offset-3  mt-40">


            <ul id="progressbar">
                <li class="active"><a href="{{url('/install')}}">welcome</a></li>
                <li class="active">verification</li> 
                <li>Environment</li>
                <li>System Setup</li>
            </ul>


        <div class="card">
            <div class="single-report-admit">
                <div class="card-header">
                    <h2 class="text-center text-uppercase">VERIFICATION</h2>
                </div>
            </div>
            <div class="card-body">
                @if(Session::has('message-danger'))
                    <p class="text-danger">** {{ Session::get('message-danger') }}</p>
                @endif
                 @if ($errors->any()) 
                    Ops sorry ! Please enter valid input!
                       @foreach ($errors->all() as $error)
                          <p class="text-danger">** {{$error}}</p>
                       @endforeach 
                 @endif


               <form method="post" action="{{url('check-verified-input')}}">
                   {{csrf_field()}}
                   <div class="form-group">
                       <label for="user">Registered Email :</label>
                       <input type="text" class="form-control " name="envatouser" onblur="checkMailStatus()" id="email" required="required"  placeholder="Enter Your Purchase Email">
                       <span class="text-danger" id="wrongemail" style="font-size:10px;">Sorry ! This email Address is not/already Registered with us.</span>					   
                   </div>
                   <div class="form-group">
                       <label for="purchasecode">Serial Key:</label>
                       <input type="text" class="form-control" id="key" name="purchasecode" onchange="checkKeyStatus()" required="required" placeholder="Enter Your Digital Academic ERP Purchase Key">
					   <span class="text-danger" id="wrongkey" style="font-size:10px;">Sorry ! This Serial Key is  incorrect or expired.</span>
                   </div>
                   <div class="form-group">
                       <label for="domain">Installation Domain:</label>
                       <input type="text" class="form-control" name="installationdomain" required="required"  placeholder="Enter Your Installation Domain">
                   </div>
                   <input type="submit" value="Next" class="offset-3 col-sm-6 primary-btn fix-gr-bg mt-40" style="background-color: rebeccapurple;color: whitesmoke">
               </form>
            </div>
        </div>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function checkMailStatus(){
    //alert("came");
	$("#overlay").show();
var reg=$("#email").val();// value in field email
$.ajax({
    type:'post',
        url:'https://eskooly.com/verification/verify.php',// put your real file name 
        data:{email: reg},
        success:function(msg){
			if(msg=="ERROR"){
		  
		  $("#email").focus();
		  $("#wrongemail").slideDown("slow");
		  $("#overlay").hide();
			}else{
				
			$("#wrongemail").slideUp("slow");
			$("#overlay").hide();
			
			}
         // alert(msg); // your message will come here.     
        }
 });
}
function checkKeyStatus(){
    //alert("came");
	$("#overlay").show();
var reg1=$("#key").val();// value in field email
$.ajax({
    type:'post',
        url:'https://eskooly.com/verification/verify.php',// put your real file name 
        data:{serialkey: reg1},
        success:function(msg1){
			if(msg1=="ERROR"){
		  
		  $("#key").focus();
		  $("#wrongkey").slideDown("slow");
		  $("#overlay").hide();
			}else{
			
			
			$("#wrongkey").slideUp("slow");
			$("#overlay").hide();
			update();
			}
         // alert(msg); // your message will come here.     
        }
 });
}

function update() {
   var val1=$("#email").val();
   var val2=$("#key").val();
 $.ajax({
    type:'post',
        url:'https://eskooly.com/verification/verify.php',// put your real file name 
        data:{remail: val1, rekey:val2},
        success:function(msg){
			if(msg=="ERROR"){
		    location.reload();
			}else{
				
			
			}
         // alert(msg); // your message will come here.     
        }
 });
 

};
</script>
</body>
</html>
