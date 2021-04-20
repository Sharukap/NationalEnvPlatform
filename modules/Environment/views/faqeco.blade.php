@extends('home')

@section('cont')

<kbd><a href="/environment/createrequest" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
</br>


<head>

	<style>
		body {
			background: #fff;
		}

		.accordion .card {
			background: none;
			border: none;
		}

		.accordion .card .card-header {
			background: none;
			border: none;
			padding: .4rem 1rem;
			font-family: "Roboto", sans-serif;
		}

		.accordion .card-header h2 span {
			float: left;
			margin-top: 10px;
		}

		.accordion .card-header .btn {
			color: #2f2f31;
			font-size: 1.04rem;
			text-align: left;
			position: relative;
			font-weight: 500;
			padding-left: 2rem;
		}

		.accordion .card-header i {
			font-size: 1.2rem;
			font-weight: bold;
			position: absolute;
			left: 0;
			top: 9px;
		}

		.accordion .card-header .btn:hover {
			color: #ff8300;
		}

		.accordion .card-body {
			color: #324353;
			padding: 0.5rem 3rem;
		}

		.page-title {
			margin: 3rem 0 3rem 1rem;
			font-family: "Roboto", sans-serif;
			position: relative;
		}

		.page-title::after {
			content: "";
			width: 80px;
			position: absolute;
			height: 3px;
			border-radius: 1px;
			background: #73bb2b;
			left: 0;
			bottom: -15px;
		}

		.accordion .highlight .btn {
			color: #74bd30;
		}

		.accordion .highlight i {
			transform: rotate(180deg);
		}
	</style>

</head>

<body>

	<div class="container-lg">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-title">FAQs - Eco-System Module</h1>
				<div class="accordion" id="accordionExample">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h2 class="clearfix mb-0">
								<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> How to fill up the description box ?</a>
							</h2>
						</div>
						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="card-body">Using the description box in the form, You can enter the details and features of the new Eco-System you found.This will help the authorized parties to get an quick idea abount the Eco-ystem you found.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> How do I mark coordinates?</a>
							</h2>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
							<div class="card-body">If your device location is enabled, the app will locate you. From your point drag and move the map to where the land or the new Eco-System exists. From there use the tooltip available at the top right hand corner of the map to select either a polygon, polyline, marker or rectangle to mark your coordinates. Select one option and demarcate your area. This does not have to be an exact location as it will be checked onsite by ministry personnel. If a mistake is made, use the bin button to remove the drawn shapes. </div>
						</div>
					</div>

					<div class="card">
						<div class="card-header" id="headingThree">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i>Can i mark coordinates using multiple shapes ?</a>
							</h2>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
							<div class="card-body"> Yes </div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFour">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-chevron-circle-down"></i> Is it necessary to put the description ?</a>
							</h2>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
							<div class="card-body">No it is not. But if you have any special notices, then you can use the description box to keep a note.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFive">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><i class="fa fa-chevron-circle-down"></i> How can I know whether my request is approved or not?</a>
							</h2>
						</div>
						<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
							<div class="card-body">You can check the status of the request using the status column in the main page. If your request is acepted by the authorized parties it will say Active, if not it will notify as Inactive.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

@endsection