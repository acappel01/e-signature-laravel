<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>jQuery Signature Pad & Canvas Image</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link href="{{ URL::asset('assets/css/jquery.signaturepad.css') }}" rel="stylesheet">
		<script src="{{ URL::asset('http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('assets/js/numeric-1.2.6.min.js') }}"></script> 
		<script src="{{ URL::asset('assets/js/bezier.js') }}"></script>
		<script src="{{ URL::asset('assets/js/jquery.signaturepad.js') }}"></script>
		<script type='text/javascript' src="{{ URL::asset('https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js') }}"></script>
		<script src="{{ URL::asset('assets/js/json2.min.js') }}"></script>
		
		
		<style type="text/css">
			body{
				font-family:monospace;
				text-align:center;
			}
			#btnSaveSign {
				color: #fff;
				background: #f99a0b;
				padding: 5px;
				border: none;
				border-radius: 5px;
				font-size: 20px;
				margin-top: 10px;
			}
			#signArea{
				width:304px;
				margin: 50px auto;
			}
			.sign-container {
				width: 60%;
				margin: auto;
			}
			.sign-preview {
				width: 150px;
				height: 50px;
				border: solid 1px #CFCFCF;
				margin: 10px 5px;
			}
			.tag-ingo {
				font-family: cursive;
				font-size: 12px;
				text-align: left;
				font-style: oblique;
			}
		</style>
	</head>
	<body>
 
		<h2>Learn Infinity | jQuery Signature Pad & Canvas Image</h2>
		
		<div id="signArea" >
			<h2 class="tag-ingo">Put signature below,</h2>
			<div class="sig sigWrapper" style="height:auto;">
				<div class="typed"></div>
				<canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
			</div>
		</div>
		
		<button id="btnSaveSign">Save Signature</button>
		
		<div class="sign-container">
		
			<ul>
				@foreach($images as $image)
					<li style="float:left;text-decoration:none;list-style:none;margin-right:10px;border:2px solid #f9f7f9;">
						<img src="{{ URL::asset('assets/images/')}}/{{$image->image}}" alt="image">
					</li>
				@endforeach
			</ul>
		</div>
		
		
		<script>
			$(document).ready(function() {
				$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
			});

			$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
			});
			
			$("#btnSaveSign").click(function(e){
				
				html2canvas([document.getElementById('sign-pad')], {
					onrendered: function (canvas) {
						var canvas_img_data = canvas.toDataURL('image/png');
						// var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
					
						//ajax call to save image inside folder
						$.ajax({
							url: '{{route('store_signature')}}',
							data: { image:canvas_img_data },
							type: 'post',
							success: function (response) {
							   console.log(response);
							},
							error: function (res) {
								var error = res.responseJSON;
								console.log(error);
							},
						});
					}
				});
			});
		  </script> 
		
 
	</body>
</html>