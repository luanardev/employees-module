<div class="row">
    <div class="col-lg-2 col-md-12 col-sm-12">                    
        <div class="nav flex-column nav-pills offset-lg-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Personal Info</a>
            <a class="nav-link"  data-toggle="pill" href="#employment" role="tab" aria-controls="employment" aria-selected="false">Employment</a>
            <a class="nav-link"  data-toggle="pill" href="#spouse" role="tab" aria-controls="spouse" aria-selected="false">Spouse Info</a>
            <a class="nav-link"  data-toggle="pill" href="#kinsman" role="tab" aria-controls="kinsman" aria-selected="false">Next of Kin</a>
            <a class="nav-link"  data-toggle="pill" href="#dependants" role="tab" aria-controls="dependants" aria-selected="false">Dependants</a>
            <a class="nav-link"  data-toggle="pill" href="#experience" role="tab" aria-controls="experience" aria-selected="false">Experience</a>
            <a class="nav-link"  data-toggle="pill" href="#qualifications" role="tab" aria-controls="qualifications" aria-selected="false">Qualifications</a>
            <a class="nav-link"  data-toggle="pill" href="#awards" role="tab" aria-controls="awards" aria-selected="false">Awards</a>
            <a class="nav-link"  data-toggle="pill" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
        </div>                      
    </div>
    <div class="col-lg-10 col-md-12 col-sm-12">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" >
                <livewire:employees::registration.profile-wizard />
            </div>

            <div class="tab-pane fade" id="employment" role="tabpanel" >
                <livewire:employees::registration.employment-wizard />
            </div>

            <div class="tab-pane fade show" id="spouse" role="tabpanel" >
                <livewire:employees::registration.spouse-wizard  />
            </div>

            <div class="tab-pane fade show" id="kinsman" role="tabpanel" >
                <livewire:employees::registration.kinsman-wizard />
            </div>

            <div class="tab-pane fade show" id="dependants" role="tabpanel" >
                <livewire:employees::registration.dependant-wizard />
            </div>

            <div class="tab-pane fade" id="experience" role="tabpanel" >
                <livewire:employees::registration.experience-wizard />
            </div>

            <div class="tab-pane fade" id="qualifications" role="tabpanel" >
                <livewire:employees::registration.qualification-wizard />
            </div>

            <div class="tab-pane fade" id="awards" role="tabpanel" >
                <livewire:employees::registration.award-wizard />
            </div>

            <div class="tab-pane fade" id="documents" role="tabpanel" >
                <livewire:employees::registration.document-wizard/>
            </div>
        </div>
    </div>
</div>