
<div class="row">
	<div class="col-lg-2 col-md-12 col-sm-12">
		<div class="">
			<div class="">
				<div class=" nav flex-column nav-pills offset-lg-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link active" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
					<a class="nav-link"  data-toggle="pill" href="#designation" role="tab" aria-controls="designation" aria-selected="false">Designation</a>
					<a class="nav-link"  data-toggle="pill" href="#grade" role="tab" aria-controls="grade" aria-selected="false">Job Grade</a>
					<a class="nav-link"  data-toggle="pill" href="#employee-category" role="tab" aria-controls="employee-category" aria-selected="false">Employee Category</a>
					<a class="nav-link"  data-toggle="pill" href="#employment-type" role="tab" aria-controls="employment-type" aria-selected="false">Employment Type</a>
					<a class="nav-link"  data-toggle="pill" href="#employment-status" role="tab" aria-controls="employment-status" aria-selected="false">Employment Status</a>
					<a class="nav-link"  data-toggle="pill" href="#progress-type" role="tab" aria-controls="progress-type" aria-selected="false">Progress Type</a>
					<a class="nav-link"  data-toggle="pill" href="#qualification-level" role="tab" aria-controls="qualification-level" aria-selected="false">Qualification Level</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-10 col-md-12 col-sm-12">
		<div class="tab-content" id="v-pills-tabContent">
			<div class="tab-pane fade show active" id="general" role="tabpanel" >
				<livewire:employees::settings.general-config />
			</div>

			<div class="tab-pane fade" id="designation" role="tabpanel" >
				<livewire:employees::settings.designation-config  />
			</div>

			<div class="tab-pane fade" id="grade" role="tabpanel" >
				<livewire:employees::settings.grade-config  />
			</div>

			<div class="tab-pane fade" id="employee-category" role="tabpanel" >
				<livewire:employees::settings.employee-category-config  />
			</div>

			<div class="tab-pane fade" id="employment-type" role="tabpanel" >
				<livewire:employees::settings.employment-type-config  />
			</div>

			<div class="tab-pane fade" id="employment-status" role="tabpanel" >
				<livewire:employees::settings.employment-status-config  />
			</div>
			
			<div class="tab-pane fade" id="progress-type" role="tabpanel" >
				<livewire:employees::settings.progress-type-config  />
			</div>

			<div class="tab-pane fade" id="qualification-level" role="tabpanel" >
				<livewire:employees::settings.qualification-level-config  />
			</div>
		</div>
	</div>
</div>


