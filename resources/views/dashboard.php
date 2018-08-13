<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	    <link rel="stylesheet" href="./css/normalize.css">
	    <link rel="stylesheet" href="./css/main.min.css">
	    <link rel="stylesheet" href="./css/styles.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	    
	    <title>Broker API</title>
	</head>

	<body class="dashboard">
		<header>
			<div class="container">
				<div class="row">
					<div class="col-6">
						<h1><a href="/">Panoramic Contractors Limited</a></h1>
					</div>
					<div class="col-6">
						<nav>
							<ul class="navigation">
								<li><a href="/dashboard">Dashboard</a></li>
								<li><a href="/properties" class="show-properties">Property</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header>

		<main role="main">
			<div class="sub-nav">
				<div class="container">
					<div class="row">
						<div class="col-6">
							<h2>Dashboard</h2>
						</div>
					</div>
				</div>
			</div>

			<div class="properties-wrapper">
				<div class="container">
					<div class="properties-table cardview hide">
						<div class="row">
							<div class="col">
								<table id="property-list" class="" style="width:100%">
							        <thead>
							            <tr>
							            	<th>ID</th>
							                <th>Listing No</th>
							                <th>List Type</th>
							                <th>Property Type</th>
							                <th>Status</th>
							                <th>Zone</th>
							                <th>List Price</th>
							            </tr>
							        </thead>
							    </table>
					    	</div>
					    </div>
					</div>

					<div class="property-insert">
						<!-- Owner -->
						<div class="row">
							<div class="col">
								<form class="owner cardview">
									<h3>Owner <button type="button" class="load-owners">Load Owners</button><span class="image-container loader-gif hide"><img src="./img/arrow.gif"/></span></h3>
									<input type="text" class="owner_id" name="owner_id" id="owner_id" value="" hidden disabled="" />
									<div class="input-grp">
										<p>
											<select class="existing-owners" disabled="">
												<option value="default">Select existing</option>
											</select>
										</p>
									</div>

									<div class="row">
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="name" name="name" placeholder="Name" id="name" />
													<input type="text" class="primary_phone" name="primary_phone" placeholder="Primary Phone" id="primary_phone" />
													<input type="email" class="email" name="email" placeholder="Email" id="email" />
												</p>
											</div>
										</div>
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="organisation" name="organisation" placeholder="Organisation" id="organisation" />
													<input type="text" class="secondary_phone" name="secondary_phone" placeholder="Secondary Phone" id="secondary_phone" />
													<input type="text" class="fax" name="fax" placeholder="Fax" id="fax" />
												</p>
											</div>
										</div>
									</div>

									<div class="input-grp">
										<p>
											<input type="text" class="address" name="address" placeholder="Address" id="address" />
										</p>
									</div>

									<h3>Contact</h3>
									<div class="row">
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="contact" name="contact" placeholder="Contact Name" id="contact" />
													<input type="text" class="contact_phone" name="contact_phone" placeholder="Contact Phone" id="contact_phone" />
												</p>
											</div>
										</div>
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="contact_fax" name="contact_fax" placeholder="Contact Fax" id="contact_fax" />
													<input type="email" class="contact_email" name="contact_email" placeholder="Primary Phone" id="contact_email" />
												</p>
											</div>
										</div>
									</div>

									<div class="input-grp">
										<p>
											<label>Notes</label>
											<textarea class="note"></textarea>
										</p>
									</div>

									<div class="image-container saving"></div>
								</form>
							</div>
						</div>

						<!-- Property -->
						<div class="row">
							<div class="col">
								<form class="property cardview">
									<div class="row">
										<div class="col">
											<h3>Property</h3>
											<input type="text" class="property_id" name="property_id" id="property_id" value="" hidden disabled="" />
										</div>
										<div class="col">
											<span><input type="text" class="list_no" name="list_no" placeholder="List No | required" style="margin: -6px 0 0 0"></span>
										</div>
									</div>
									<div class="input-grp">
										<p>
											<select class="ltype_id">
												<option value="default">Select List Type | required</option>
											</select>
										</p>

										<p>
											<select class="ptype_id">
												<option value="default">Select Property Type | required</option>
											</select>
										</p>

										<p>
											<select class="zone_id">
												<option value="default">Select Zone | required</option>
											</select>
										</p>
									</div>

									<div class="row">
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="status" name="status" placeholder="Status | required" id="status"/>
													<input type="text" class="commission" name="commission" placeholder="Commission" id="commission"/>
													<input type="text" class="service_charge" name="service_charge" placeholder="Service Charge" id="service_charge"/>
												</p>
											</div>
										</div>
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="deed_no" name="deed_no" placeholder="Deed No" id="deed_no"/>
													<input type="text" class="Price" name="Price" placeholder="Price" id="Price"/>
													<input type="text" class="fees" name="fees" placeholder="Fees" id="fees"/>
												</p>
											</div>
										</div>
									</div>

									<div class="input-grp">
										<p>
											<label>Description</label>
											<textarea class="note"></textarea>
										</p>
									</div>

									<div class="input-grp">
										<p>
											<label>Directions</label>
											<textarea class="note"></textarea>
										</p>
									</div>
									<div class="image-container saving"></div>
								</form>
							</div>
						</div>

						<!-- Address -->
						<div class="row">
							<div class="col">
								<form class="location_address cardview">
									<h3>Address</h3>
									<input type="text" class="address_id" name="address_id" value="" hidden disabled="" />
									<div class="row">
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="address_line1" name="address_line1" placeholder="Address Line 1" id="address_line1" />
													<input type="text" class="address_line2" name="address_line2" placeholder="Address Line 2" id="address_line2" />
													<input type="text" class="address_line3" name="address_line3" placeholder="Address Line 3" id="address_line3" />
												</p>
											</div>
										</div>
									</div>
									<div class="image-container saving"></div>
								</form>
							</div>
						</div>

						<!-- Levels -->
						<div class="row">
							<div class="col">
								<form class="levels cardview">
									<h3>Levels</h3>
									<div class="floors" data-levels="1">
										<div class="row">
											<div class="col">
												<div class="input-grp">
													<p>
														<input type="text" data-row="1" class="floor row_1" name="floor" data-index="1" placeholder="Floor"/>
														<input type="text" class="level_id row_1" name="level_id" data-index="1" value="" hidden disabled="" />
													</p>
												</div>
											</div>
											<div class="col">
												<div class="input-grp">
													<p>
														<input type="text" data-row="1" class="net_internal row_1" name="net_internal" data-index="1" placeholder="Net Internal"/>
													</p>
												</div>
											</div>
											<div class="col">
												<div class="input-grp">
													<p>
														<input type="text" data-row="1" class="common row_1" name="common" data-index="1" placeholder="Common"/>
													</p>
												</div>
											</div>
											<div class="col">
												<div class="input-grp">
													<p>
														<input type="text" data-row="1" class="rentable row_1" name="rentable" data-index="1" placeholder="Rentable"/>
													</p>
												</div>
											</div>
											<div class="col">
												<div class="input-grp">
													<p>
														<input type="text" data-row="1" class="gross row_1" name="gross" data-index="1" placeholder="Gross"/>
													</p>
												</div>
											</div>
											<div class="col">
												<div class="input-grp">
													<p>
														<input type="text" data-row="1" class="rent_psf row_1" name="rent_psf" data-index="1" placeholder="Rent/SF"/>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="input-grp">
										<p>
											<input type="button" data-index="1" class="new btn btn-primary row_1" value="Add"/>
										</p>
									</div>
									<div class="image-container saving"></div>
								</form>
							</div>
						</div>

						<!-- Accommodations -->
						<div class="row">
							<div class="col">
								<form class="accommodations cardview">
									<h3>Accommodations</h3>
									<input type="text" class="accommodation_id" name="accommodation_id" id="accommodation_id" value="" hidden disabled="" />
									<div class="row">
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="bedrooms" name="bedrooms" placeholder="Bedrooms" id="bedrooms" />
													<input type="text" class="kitchen" name="kitchen" placeholder="Kitchen" id="kitchen" />
													<input type="text" class="dining" name="dining" placeholder="Dining" id="dining" />
													<input type="text" class="powder" name="powder" placeholder="Powder" id="powder" />
													<input type="text" class="maid" name="maid" placeholder="Maid" id="maid" />
													<input type="text" class="study" name="study" placeholder="Study" id="study" />
													<input type="text" class="porch" name="porch" placeholder="Porch" id="porch" />
												</p>
											</div>
										</div>
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="baths" name="baths" placeholder="Baths" id="baths" />
													<input type="text" class="living" name="living" placeholder="Living" id="living" />
													<input type="text" class="tvroom" name="tvroom" placeholder="TV Room" id="tvroom" />
													<input type="text" class="storage_room" name="storage_room" placeholder="Storage" id="storage_room" />
													<input type="text" class="family" name="family" placeholder="Family" id="family" />
													<input type="text" class="laundry" name="laundry" placeholder="Laundry" id="laundry" />
													<input type="text" class="parking" name="parking" placeholder="Parking" id="parking" />
												</p>
											</div>
										</div>
									</div>

									<div class="input-grp">
										<p>
											<input type="text" class="other" name="other" placeholder="Other" id="other" />
										</p>
									</div>
									<div class="image-container saving"></div>
								</form>
							</div>
						</div>

						<!-- Construction -->
						<div class="row">
							<div class="col">
								<form class="construction cardview">
									<h3>Construction</h3>
									<input type="text" class="construct_id" name="construct_id" id="construct_id" value="" hidden disabled="" />
									<div class="row">
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="age" name="age" placeholder="Age" id="age" />
													<input type="text" class="ceiling" name="ceiling" placeholder="Ceiling" id="ceiling" />
													<input type="text" class="walls" name="walls" placeholder="Walls" id="walls" />
												</p>
											</div>
										</div>
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="floors" name="floors" placeholder="Floors" id="floors" />
													<input type="text" class="structure" name="structure" placeholder="Structure" id="structure" />
													<input type="text" class="roof" name="roof" placeholder="Roof" id="roof" />
												</p>
											</div>
										</div>
									</div>
									<div class="image-container saving"></div>
								</form>
							</div>
						</div>

						<!-- Features -->
						<div class="row">
							<div class="col">
								<form class="features cardview">
									<h3>Features</h3>
									<input type="text" class="feature_id" name="feature_id" id="feature_id" value="" hidden disabled="" />
									<div class="row">
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="ac" name="ac" placeholder="AC" id="ac" />
													<input type="text" class="security" name="security" placeholder="Security" id="security" />
													<input type="text" class="pool" name="pool" placeholder="Pool" id="pool" />
													<input type="text" class="w_tanks" name="w_tanks" placeholder="Water Tanks" id="w_tanks" />
													<input type="text" class="w_heater" name="w_heater" placeholder="Water Heater" id="w_heater" />
												</p>
											</div>
										</div>
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="generator" name="generator" placeholder="Generator" id="generator" />
													<input type="text" class="elevator" name="elevator" placeholder="Elevator" id="elevator" />
													<input type="text" class="partition" name="partition" placeholder="Partition" id="partition" />
													<input type="text" class="fence" name="fence" placeholder="Fence" id="fence" />
												</p>
											</div>
										</div>
									</div>
									<div class="image-container saving"></div>
								</form>
							</div>
						</div>

						<!-- Details -->
						<div class="row">
							<div class="col">
								<form class="details cardview">
									<h3>Details</h3>
									<input type="text" class="detail_id" name="detail_id" id="detail_id" value="" hidden disabled="" />
									<div class="row">
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="land_size" name="land_size" placeholder="Land Size" id="land_size" />
													<label>Mortgage Info</label>
													<textarea class="mortgage_info"></textarea>
													<input type="text" class="rent" name="rent" placeholder="Rent" id="rent" />
													<input type="text" class="tenure" name="tenure" placeholder="Tenure" id="tenure" />
													<input type="text" class="ren_opt" name="ren_opt" placeholder="Ren Opt" id="ren_opt" />
												</p>
											</div>
										</div>
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="building_size" name="building_size" placeholder="Building Size" id="building_size" />
													<label>Misc Info</label>
													<textarea class="misc_info"></textarea>
													<input type="text" class="furnishings" name="furnishings" placeholder="Furnishings" id="furnishings" />
													<input type="text" class="years" name="years" placeholder="Years" id="years" />
													<input type="text" class="topo" name="topo" placeholder="Topo" id="topo" />
												</p>
											</div>
										</div>
									</div>

									<div class="input-grp">
										<p>
											<label>Viewing Info</label>
											<textarea class="viewing_info"></textarea>
										</p>
									</div>
									<div class="image-container saving"></div>
								</form>
							</div>
						</div>

						<!-- Tax -->
						<div class="row">
							<div class="col">
								<form class="tax cardview">
									<h3>Tax</h3>
									<input type="text" class="tax_id" name="tax_id" id="tax_id" value="" hidden disabled="" />
									<div class="row">
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="taxes" name="taxes" placeholder="Taxes" id="taxes" />
													<input type="text" class="wasa" name="wasa" placeholder="WASA" id="wasa" />
													<input type="text" class="maintenance" name="maintenance" placeholder="Maintenance" id="maintenance" />
												</p>
											</div>
										</div>
										<div class="col">
											<div class="input-grp">
												<p>
													<input type="text" class="insurance" name="insurance" placeholder="Insurance" id="insurance" />
													<input type="text" class="comp_cert" name="comp_cert" placeholder="Comp Cert" id="comp_cert" />
												</p>
											</div>
										</div>
									</div>
									<div class="image-container saving"></div>
								</form>
							</div>
						</div>

						<!-- Clone -->
						<div class="reuseable hide">
							<div class="col">
								<div class="input-grp">
									<p>
										<input type="text" class="floor" name="floor" placeholder="Floor"/>
										<input type="text" class="level_id" name="level_id" value="" hidden disabled="" />
									</p>
								</div>
							</div>
							<div class="col">
								<div class="input-grp">
									<p>
										<input type="text" class="net_internal" name="net_internal" placeholder="Net Internal"/>
									</p>
								</div>
							</div>
							<div class="col">
								<div class="input-grp">
									<p>
										<input type="text" class="common" name="common" placeholder="Common"/>
									</p>
								</div>
							</div>
							<div class="col">
								<div class="input-grp">
									<p>
										<input type="text" class="rentable" name="rentable" placeholder="Rentable"/>
									</p>
								</div>
							</div>
							<div class="col">
								<div class="input-grp">
									<p>
										<input type="text" class="gross" name="gross" placeholder="Gross"/>
									</p>
								</div>
							</div>
							<div class="col">
								<div class="input-grp">
									<p>
										<input type="text" class="rent_psf" name="rent_psf" placeholder="Rent/SF"/>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="./js/main.min.js"></script>
	</body>
</html>