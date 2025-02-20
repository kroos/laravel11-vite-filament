	@if ($errors->any())
		<div class="bs-col-sm-12 bs-d-flex bs-align-items-center bs-justify-content-center">
			<ul class="bs-list-group">
				@foreach ($errors->all() as $error)
					<li class="bs-list-group-item bs-list-group-item-danger">{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
