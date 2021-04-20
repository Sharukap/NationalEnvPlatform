

@extends('home')

@section('cont')

<kbd><a href="/tree-removal/form" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
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
				<h1 class="page-title">FAQs - Tree Removal Module</h1>
				<div class="accordion" id="accordionExample">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h2 class="clearfix mb-0">
								<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> what is this form for?</a>
							</h2>
						</div>
						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="card-body"> This form collects the necessary data to determine a tree removal request can be approved or not. It is meant to replace it's physical counterpart.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> what are the required fields?</a>
							</h2>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
							<div class="card-body">District, Grama Sevaka Division, Activity Organization (The organization you determine should handle the request), Land title (a unique title given to identify your land), Map coordinate has to be selected, Number of Trees (the number of trees to be removed), Description (A description about the need for the tree removal form)</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingThree">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i> What if we are making for an unregistered user? </a>
							</h2>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
							<div class="card-body">If the tree removal request is made for an external user by the currently logged in user, simply check the "Creating on behalf of non-registered user" checkbox and fill in the NIC and the email of the non-registered user.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFour">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-chevron-circle-down"></i> How do I mark coordinates?</a>
							</h2>
						</div>
						<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
							<div class="card-body">If your device location is enabled, the app will locate you. From your point drag and move the map to where the land of the tree removal in question exists. From there use the tooltip available at the top right hand corner of the map to select either a polygon, polyline, marker or rectangle to mark your coordinates. Select one option and demarcate your area. This does not have to be an exact location as it will be checked onsite by ministry personnel. If a mistake is made, use the bin button to remove the drawn shapes. </div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFive">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-chevron-circle-down"></i> What is I already have a KML file with all the coordinates?</a>
							</h2>
						</div>
						<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
							<div class="card-body">Click on the Choose file button, under Upload a KML file section and click upload and avoid drawing coordinates. </div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingSix">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"><i class="fa fa-chevron-circle-down"></i>  How many coordinates can i mark ? </a>
							</h2>
						</div>
						<div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
							<div class="card-body">As many as required.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingSeven">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"><i class="fa fa-chevron-circle-down"></i> How can i view my request ? </a>
							</h2>
						</div>
						<div id="collapseSix" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
							<div class="card-body">Visit the requests tab from the side mounted navbar.</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</body>

@endsection