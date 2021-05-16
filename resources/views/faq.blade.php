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

<!-- Tree Removal Modal -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="treeHelp" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
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
							<div class="card-body">
								<ul>
									<li>District</li>
									<li>Grama Sevaka Division</li>
									<li>Activity Organization (The organization you determine should handle the request)</li>
									<li>Land title (a unique title given to identify your land)</li>
									<li>Map coordinate has to be selected</li>
									<li>Number of Trees (the number of trees to be removed)</li>
									<li>Description (A description about the need for the tree removal form)</li>
								</ul>
							</div>
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
							<div class="card-body">
								<ul>
									<li> If your device location is enabled, the app will locate you. From your point drag and move the map to where the land of the tree removal <br>
										in question exists. From there use the tooltip available at the top right hand corner of the map to select either a polygon, polyline,
										marker <br> or rectangle to mark your coordinates.</li><br>
									<li>Select one option and demarcate your area. This does not have to be an exact location as
										it will be checked onsite by ministry personnel.<br> If a mistake is made, use the bin button to remove the drawn shapes.</li>
								</ul>
							</div>
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
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"><i class="fa fa-chevron-circle-down"></i> How many coordinates can i mark ? </a>
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
						<div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
							<div class="card-body">Visit the requests tab from the side mounted navbar.</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Development Project Modal -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="devHelp" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h1 class="page-title">FAQs - Development Project Module</h1>
				<div class="accordion" id="accordionExample1">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h2 class="clearfix mb-0">
								<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> what is this form for ?</a>
							</h2>
						</div>
						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1">
							<div class="card-body">This form collects the necessary data to determine if a development project request can be approved or not. It is meant to replace it's physical counterpart.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> what are the required fields ?</a>
							</h2>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample1">
							<div class="card-body">
								<ul>
									<li>A Title (The name given to the project)</li>
									<li>District</li>
									<li>Grama Sevaka Division</li>
									<li>Activity Organization (The organization you determine should handle the request)</li>
									<li>Description (A description about the need for the tree removal form</li>
									<li> Land title (a unique title given to identify your land)</li>
									<li> Map coordinate has to be marked</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingThree">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i> How do I mark coordinates ? </a>
							</h2>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample1">
							<div class="card-body">
								<ul>
									<li>If your device location is enabled, the app will locate you. From your point drag and move the map to where the land of the ongoing project. From there use the tooltip available at the top right hand corner of the map to select either a polygon, polyline, marker or rectangle to mark your coordinates.</li><br>
									<li>Select one option and demarcate your area. This does not have to be an exact location as it will be checked onsite by ministry personnel. If a mistake is made, use the bin button to remove the drawn shapes. </li>
								</ul>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFour">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-chevron-circle-down"></i> How can i view my request ?</a>
							</h2>
						</div>
						<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample1">
							<div class="card-body"> Visit the requests tab from the side mounted navbar.</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Complaints Modal -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="complaintsHelp" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h1 class="page-title">FAQs - Crime Report Module </h1>
				<div class="accordion" id="accordionExample2">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h2 class="clearfix mb-0">
								<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> How to make a complaint?</a>
							</h2>
						</div>
						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample2">
							<div class="card-body">Select an organization to forward your complaint. The administrators will review and reassign if necessary.Description of the complaint Area Name and Location to be marked on map too.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> What if the complainant does not have an account and the complaint is made by someone else on their behalf?</a>
							</h2>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample2">
							<div class="card-body">Tick the box “Creating on behalf of non-registered user” and include the name and email of the complainant so he/she can be informed on the action taken.</div>
						</div>
					</div>

					<div class="card">
						<div class="card-header" id="headingThree">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i> How can I know whether my request is approved or not?</a>
							</h2>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample2">
							<div class="card-body">Visit the requests tab from the side mounted navbar.</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Species Help -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="speciesHelp" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h1 class="page-title">FAQs - Species Management Module</h1>
				<div class="accordion" id="accordionExample3">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h2 class="clearfix mb-0">
								<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> How to fill up the description box?</a>
							</h2>
						</div>
						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample3">
							<div class="card-body">Using the description box in the form, You can enter the details and features of the new Species you found.This will help the authorized parties to get an quick idea abount the Eco-ystem you found.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> How to mark the location?</a>
							</h2>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample3">
							<div class="card-body">
								<ul>
									<li>If your device location is enabled, the app will locate you. From your point drag and move the map to where the land or the new Eco-System exists. From there use the tooltip available at the top right hand corner of the map to select either a polygon, polyline, marker or rectangle to mark your coordinates.</li><br>
									<li>Select one option and demarcate your area. This does not have to be an exact location as it will be checked onsite by ministry personnel. If a mistake is made, use the bin button to remove the drawn shapes.</li>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingThree">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i> Can i mark coordinates using multiple shapes ?</a>
							</h2>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample3">
							<div class="card-body"> Yes </div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFour">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-chevron-circle-down"></i> How can I know whether my request is approved or not?</a>
							</h2>
						</div>
						<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample3">
							<div class="card-body">You can check the status of the request using the status column in the main page. If your request is acepted by the authorized parties it will say Active, if not it will notify as Inactive.</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Ecosystem Help -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="ecoHelp" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h1 class="page-title">FAQs - Eco-System Module</h1>
				<div class="accordion" id="accordionExample4">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h2 class="clearfix mb-0">
								<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> How to fill up the description box ?</a>
							</h2>
						</div>
						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample4">
							<div class="card-body">
								<ul>

									<li> Using the description box in the form, You can enter the details and features of the new Eco-System you found.This will help the authorized parties to get an quick idea abount the Eco-ystem you found. </li>
							</div>
							</ul>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> How do I mark coordinates?</a>
							</h2>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample4">
							<div class="card-body">
								<ul>
									<li> If your device location is enabled, the app will locate you. From your point drag and move the map to where the land of the tree removal <br>
										in question exists. From there use the tooltip available at the top right hand corner of the map to select either a polygon, polyline,
										marker <br> or rectangle to mark your coordinates.</li><br>
									<li>Select one option and demarcate your area. This does not have to be an exact location as
										it will be checked onsite by ministry personnel.<br> If a mistake is made, use the bin button to remove the drawn shapes.</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-header" id="headingThree">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i>Can i mark coordinates using multiple shapes ?</a>
							</h2>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample4">
							<div class="card-body"> Yes </div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFour">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-chevron-circle-down"></i> Is it necessary to put the description ?</a>
							</h2>
						</div>
						<div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample4">
							<div class="card-body">
								<ul>
									<li>
										No it is not. But if you have any special notices, then you can use the description box to keep a note.</li>
							</div>
							</ul>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFive">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><i class="fa fa-chevron-circle-down"></i> How can I know whether my request is approved or not?</a>
							</h2>
						</div>
						<div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample4">
							<div class="card-body">
								<ul>
									<li>You can check the status of the request using the status column in the main page. If your request is acepted by the authorized parties it will say Active, if not it will notify as Inactive.</li>
							</div>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Environment Restoration Modal -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="restorationHelp" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h1 class="page-title">FAQs - Environment Restoration Module</h1>
				<div class="accordion" id="accordionExample5">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h2 class="clearfix mb-0">
								<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> What is the restoration form ? </a>
							</h2>
						</div>
						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample5">
							<div class="card-body">This form is used to collect information on the restoration activities carried out in the critical ecosystems of our country. It would allow the relevant authorities to be informed of such activities being carried out .</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> How do I fill restoration project name and restored land title name ?</a>
							</h2>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample5">
							<div class="card-body">Restoration project name refers to the unique project name you may assign to your restoration project. Restored land parcel title refers to the title of the land parcel you are carrying out your restoration in.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingThree">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i> How to fill the field "Governing organizations for the land parcel" ?</a>
							</h2>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample5">
							<div class="card-body">This is a optional entry field for the applicant where if they are informed of the governing bodies for that relevant land parcel, they may add in. Please note that this field is optional and the organization that this form needs to be submitted to should be entered in the 'Organization to be submitted to' field.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFour">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-chevron-circle-down"></i> Can I add multiple disjoint map areas which my project would be restoring ?</a>
							</h2>
						</div>
						<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample5">
							<div class="card-body">Yes you can, our map allows you to demarcate multiple sets of coordinates on the map
								.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFive">
							<h2 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><i class="fa fa-chevron-circle-down"></i> How do I fill the species table ?</a>
							</h2>
						</div>
						<div id="collapseFive" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample5">
							<div class="card-body">For each tree species type restoted , you can enter the generic name of the species restored (you may select based on the typeahead options received), quantity of that species type restored, height, dimensions and special remarks if any. If you wish to add more species types and it's data, click on the add button and repeat process.</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- How to fill map modal -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="mapHelp" role="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h3>Overview</h3>
				<img src="../images/shapes/overview.PNG" class="img-fluid" alt="Responsive image">
				<div>
					<dl>
						<dt>How do I begin drawing a particular shape?</dt>
						<dd>Click on any of the shapes (polyline, polygon, rectangle, marker) to begin drawing with them.</dd>
						<dt>I drew shapes but made an error, how do I clear the map?</dt>
						<dd>If an error was made when drawing a layer, click on the bin button and confirm to delete all layers.</dd>
						<dt>How do I search for a location?</dt>
						<dd>Clicking the search button allows you to search for a location.</dd>
						<dt>What if I don't know the exact coordinates to mark on the map?</dt>
						<dd>The location does not have to be EXACT, mark as close to your land as possible. It will be checked by ministry personnel via an onsite visit.</dd>
					</dl>
				</div>
				<hr>
				<h3>Shapes</h3>
				<img src="../images/shapes/all_shapes.PNG" class="img-fluid" alt="Responsive image">
				<hr>
				<h3>Polygon</h3>
				<img src="../images/shapes/polygon.PNG" class="img-fluid" alt="Responsive image">
				<div>
					<dl>
						<dt>I haven't saved the polygon to the map and I want to remove it.</dt>
						<dd>If the polygon is not the way you want it, click the "cancel" button on the top right corner of the map.</dd>
						<dt>I made a mistake when clicking the last point, how can i remove just the last point?</dt>
						<dd>Click on "delete last point" at the top right hand corner of the map to delete the last point.</dd>
						<dt>How can I finish drawing the polygon?</dt>
						<dd>Click on the starting point to finish drawing the polygon.</dd>
					</dl>
				</div>
				<hr>
				<h3>Polyline</h3>
				<img src="../images/shapes/polyline.PNG" class="img-fluid" alt="Responsive image">
				<div>
					<dl>
						<dt>I haven't saved the polygon to the map and I want to remove it.</dt>
						<dd>If the polyline is not the way you want it, click the "cancel" button on the top right corner of the map.</dd>
						<dt>I made a mistake when clicking the last point, how can i remove just the last point?</dt>
						<dd>Click on "delete last point" on the top right hand corner of the map to delete the last point drawn.</dd>
						<dt>How can I finish drawing the polyline?</dt>
						<dd>Click on the last point again to finish drawing the polygon.</dd>
					</dl>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>