@extends('layouts.app')

@section('content')
	<div class="col-sm-12 d-flex flex-column align-items-center justify-content-center">

		<div class="col-sm-8 row justify-content-center align-items-center m-2 border border-success">
			<h1 class="text-center animate__animated animate__bounce">An animated element</h1>
		</div>

		<div class="col-sm-8 row text-center align-items-center m-2 border border-success">
				<div class="tw">
					<p class="text-3xl font-bold underline">Hello tailwindcss</p>
					<button class="btn btn-primary">Bootstrap Button</button>
				</div>
				<p>If you want to use tailwindcss class, please wrap it with "tw" class. This has been made to resolve conflicts between bootstrap and tailwindcss</p>
				<p>{{ __('<div class="tw"><p class="text-3xl font-bold underline">Hello tailwindcss</p></div>') }}</p>
		</div>

		<div class="col-sm-8 row justify-content-center align-items-center m-2 border border-success">
			<p class="">Placeholder text to demonstrate some <a href="#" data-toggle="tooltip" data-bs-title="Default tooltip">inline links</a> with tooltips. This is now just filler, no killer. Content placed here just to mimic the presence of <a href="#" data-toggle="tooltip" data-bs-title="Another tooltip">real text</a>. And all that just to give you an idea of how tooltips would look when used in real-world situations. So hopefully you've now seen how <a href="#" data-toggle="tooltip" data-bs-title="Another one here too">these tooltips on links</a> can work in practice, once you use them on <a href="#" data-toggle="tooltip" data-bs-title="The last tip!">your own</a> site or project.
			</p>
		</div>

		<div class="col-sm-8 row justify-content-center align-items-center m-2 border border-success">
			<div class="row col-sm-6 border border-primary">
				<label for="select2" class="col-form-label col-sm-4">Select 2:</label>
				<div class="col-sm-8 my-auto">
					<select name="select2" id="select2" class="form-select form-select-sm col-sm-8" placeholder="Please choose">
						<option value="">Please choose</option>
						<option value="1">Pick 1</option>
						<option value="2">Pick 2</option>
					</select>
				</div>
			</div>
		</div>

		<div class="col-sm-8 row justify-content-center align-items-center m-2 border border-success">
			<div class="row col-sm-6 border border-primary">
				<label for="dp" class="col-form-label col-sm-4">jQuery-ui Datepicker:</label>
				<div class="col-sm-8 my-auto">
					<input type="text" id="dp" name="datepicker" class="form-control form-control-sm">
				</div>
			</div>
			<figure class="text-start">
				<blockquote class="blockquote">
					<p>
						$("#dp").jqueryuiDatepicker({</br>
							dateFormat: 'yy-mm-dd',</br>
						});</br>
					</p>
				</blockquote>
				<figcaption class="blockquote-footer">
					For all jQuery-UI method, u can prefix it with "jquery", this to avoid a conflicts between bootstrap method and jQuery-UI method.
				</figcaption>
			</figure>
		</div>

		<div class="col-sm-8 row justify-content-center align-items-center m-2 border border-success">
			<div class="col-sm-4 my-auto">
				<button id="button1" class="m-1 btn btn-primary"><i class="fa-regular fa-user fa-beat"></i> Primary button</button>
				<button id="button2" class="m-1 btn btn-secondary"><i class="fa-solid fa-bomb fa-beat"></i> secondary button</button>
				<button id="button3" class="m-1 btn btn-outline-primary"><i class="bi bi-airplane-engines"></i> third button</button>
				<button id="button4" class="m-1 btn btn-outline-primary"><span class="mdi mdi-ab-testing"></span> fourth button</button>
			</div>
		</div>

		<div class="col-sm-8 row justify-content-center align-items-center m-2 border border-success">
			<table id="table_id" class="table table-sm table-hover">
				<thead>
						<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start date</th>
								<th>Salary</th>
						</tr>
				</thead>
				<tbody>
						<tr>
								<td>Tiger Nixon</td>
								<td>System Architect</td>
								<td>Edinburgh</td>
								<td>61</td>
								<td>25 Apr 2011</td>
								<td>$320,800</td>
						</tr>
						<tr>
								<td>Garrett Winters</td>
								<td>Accountant</td>
								<td>Tokyo</td>
								<td>63</td>
								<td>25 Jul 2011</td>
								<td>$170,750</td>
						</tr>
						<tr>
								<td>Ashton Cox</td>
								<td>Junior Technical Author</td>
								<td>San Francisco</td>
								<td>66</td>
								<td>12 Jan 2009</td>
								<td>$86,000</td>
						</tr>
						<tr>
								<td>Cedric Kelly</td>
								<td>Senior Javascript Developer</td>
								<td>Edinburgh</td>
								<td>22</td>
								<td>29 Mar 2012</td>
								<td>$433,060</td>
						</tr>
						<tr>
								<td>Airi Satou</td>
								<td>Accountant</td>
								<td>Tokyo</td>
								<td>33</td>
								<td>28 Nov 2008</td>
								<td>$162,700</td>
						</tr>
						<tr>
								<td>Brielle Williamson</td>
								<td>Integration Specialist</td>
								<td>New York</td>
								<td>61</td>
								<td>2 Dec 2012</td>
								<td>$372,000</td>
						</tr>
						<tr>
								<td>Herrod Chandler</td>
								<td>Sales Assistant</td>
								<td>San Francisco</td>
								<td>59</td>
								<td>6 Aug 2012</td>
								<td>$137,500</td>
						</tr>
						<tr>
								<td>Rhona Davidson</td>
								<td>Integration Specialist</td>
								<td>Tokyo</td>
								<td>55</td>
								<td>14 Oct 2010</td>
								<td>$327,900</td>
						</tr>
						<tr>
								<td>Colleen Hurst</td>
								<td>Javascript Developer</td>
								<td>San Francisco</td>
								<td>39</td>
								<td>15 Sep 2009</td>
								<td>$205,500</td>
						</tr>
						<tr>
								<td>Sonya Frost</td>
								<td>Software Engineer</td>
								<td>Edinburgh</td>
								<td>23</td>
								<td>13 Dec 2008</td>
								<td>$103,600</td>
						</tr>
						<tr>
								<td>Jena Gaines</td>
								<td>Office Manager</td>
								<td>London</td>
								<td>30</td>
								<td>19 Dec 2008</td>
								<td>$90,560</td>
						</tr>
						<tr>
								<td>Quinn Flynn</td>
								<td>Support Lead</td>
								<td>Edinburgh</td>
								<td>22</td>
								<td>3 Mar 2013</td>
								<td>$342,000</td>
						</tr>
						<tr>
								<td>Charde Marshall</td>
								<td>Regional Director</td>
								<td>San Francisco</td>
								<td>36</td>
								<td>16 Oct 2008</td>
								<td>$470,600</td>
						</tr>
						<tr>
								<td>Haley Kennedy</td>
								<td>Senior Marketing Designer</td>
								<td>London</td>
								<td>43</td>
								<td>18 Dec 2012</td>
								<td>$313,500</td>
						</tr>
						<tr>
								<td>Tatyana Fitzpatrick</td>
								<td>Regional Director</td>
								<td>London</td>
								<td>19</td>
								<td>17 Mar 2010</td>
								<td>$385,750</td>
						</tr>
				</tbody>
			</table>
		</div>

		<div class="col-sm-8 row justify-content-center align-items-center m-2 border border-success">
			<canvas id="myChart"></canvas>
		</div>

		<div class="col-sm-8 row justify-content-center align-items-center m-2 border border-success">
			<div id="calendar"></div>
		</div>
	</div>
@endsection

@section('js')

// tooltip
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});

$('#button1').click(function(){
	alert("Thanks");
});

$('#button2').click(function(){
	swal.fire('Title', 'message', 'info');
});

console.log('test');

$('#select2').select2({
	theme: 'bootstrap-5',
});

console.log(moment().format('D MMMM YYYY'));

$("#dp").jqueryuiDatepicker({
	dateFormat: 'yy-mm-dd',
});

DataTable.datetime('D MMM YYYY');
$('#table_id').DataTable({
	'lengthMenu': [ [30, 60, 100, -1], [30, 60, 100, 'All'] ],
	'columnDefs': [
		{ type: 'date', 'targets': [4] },
	],
	'order': [[ 0, 'desc' ]],
	'responsive': true,
	'autoWidth': false,
	// 'fixedHeader': true,
	'dom': 'Bfrtip',
});


const ctx = document.getElementById('myChart');
new Chart(ctx, {
	type: 'bar',
	data: {
		labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
		datasets: [{
			label: '# of Votes',
			data: [12, 19, 3, 5, 2, 3],
			borderWidth: 1
		}]
	},
	options: {
		scales: {
			y: {
				beginAtZero: true
			}
		}
	}
});

let calendarEl = document.getElementById('calendar');
let calendar = new Calendar(calendarEl, {
	plugins: [
		multiMonthPlugin,
		dayGridPlugin,
		timeGridPlugin,
		listPlugin,
		momentPlugin,
		bootstrap5Plugin,
	],
	aspectRatio: 1.3,
	height: 2000,
	weekNumbers: true,
	titleFormat: 'D MMMM, YYYY',  // momentPlugin
	themeSystem: 'bootstrap5',   // bootstrap5Plugin
	initialView: 'multiMonthYear',
	headerToolbar: {
		left: 'prev,next today',
		center: 'title',
		right: 'multiMonthYear,dayGridMonth,timeGridWeek'
	},

	// events: {
	// 	url: '{{ route('dashboard') }}',
	// 	method: 'GET',
	// 	extraParams: {
	// 		_token: '{!! csrf_token() !!}',
	// 	},
	// },

	events: [
		{
			title: 'Event 1',
			start: '{{ now() }}', // Date of the event
			description: 'Description of Event 1'
		},
		{
			title: 'Event 2',
			start: '{{ now()->subdays(2) }}', // Date and time
			end: '{{ now()->subday() }}', // Optional end time
			description: 'Description of Event 2'
		},
		{
			title: 'Event 3',
			start: '{{ now()->subdays(6) }}',
			description: 'Description of Event 3'
		}
	],
	eventClick: function(info) {
		// alert(info.event.title + "\n" + info.event.extendedProps.description);
		swal.fire({
			title: info.event.title,
			text: info.event.extendedProps.description,
			icon: 'info',
		});
	},
	eventDidMount: function(info) {
		$(info.el).tooltip({
			title: info.event.extendedProps.description,
			placement: 'top',
			trigger: 'hover',
			container: 'body'
		});
	},
	eventTimeFormat: { // like '14:30:00'
		hour: '2-digit',
		minute: '2-digit',
		second: '2-digit',
		hour12: true
	},

});
calendar.render();

@endsection
