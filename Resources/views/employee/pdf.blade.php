<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>{{$employee->name()}}</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        
        <style>           
            .page-break {
                page-break-after: always;
            }

            .logo{
                display: block;
                text-align: center;
            }

            .logo img{
                position: absolute;
                top: 5%;
                left: 50%;                             
                transform: translate(-50%, -5%);
                max-width: 150px;
                max-height: 150px;
            }

            .field-label {
                display: inline-block;
                width: 200px;
                text-align: right;
            }

            .field-value {
                display: inline-block;
                width: auto;
                text-align: right;
                padding-left: 50px;
                
            }
         </style>

    </head>
    <body>

        <main>
            @php 
                $logo = OrgSettings::get('company_logo'); 
            @endphp
            <!-- Front page -->
            <div class="row">
                <div class="col-md-12"> 
                    
                    <!-- Logo -->
                    <div class="logo">
                        <img src="{{ asset("storage/{$logo}") }}" class="img-fluid" />                       
                    </div>
                    
                    <!-- Front page text -->
                    <div class="text-center" style="margin-top: 300px">
                        <h2>Staff Record</h2>
                        <h3>For</h3>
                        <h2>{{$employee->fullname()}}</h2>                
                        <h4 class="text-muted">{{$employee->employment->getDesignation()}}</h4>                
                    </div>
                    
                    <!-- Front page date -->
                    <div class="text-center" style="margin-top: 300px">
                        <h5>{{now()->format('d-M-Y')}}</h5>               
                    </div>
                </div>              
            </div>
            <!-- End Front page -->
        
            <!-- page break -->
            <div class="page-break"></div>

            <!-- Start page-->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="py-4 mb-3">A. Personal Information</h4>
                    <p class="mb-3">
                        <span class="text-bold field-label"> Employee Number : </span>                           
                        <span class="text-bold field-value">{{$employee->id}}</span>                            
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label"> National ID : </span>                           
                        <span class="text-bold field-value">{{$employee->national_id}}</span>                            
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label"> Title : </span>                           
                        <span class="text-bold field-value">{{$employee->title}}</span>                            
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label"> Firstname : </span>                           
                        <span class="text-bold field-value">{{$employee->firstname}}</span>                            
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label"> Lastname : </span>                           
                        <span class="text-bold field-value">{{$employee->lastname}}</span>                            
                    </p>
                    @isset($employee->middlename)
                    <p class="mb-3">
                        <span class="text-bold field-label"> Middlename : </span>                           
                        <span class="text-bold field-value">{{$employee->middlename}}</span>                            
                    </p>
                    @endif
                    <p class="mb-3">
                        <span class="text-bold field-label">Gender : </span>
                        <span class="text-bold field-value">{{$employee->gender}}</span>
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label">Marital Status : </span>
                        <span class="text-bold field-value">{{$employee->marital_status}}</span>
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label">Date of Birth : </span>
                        <span class="text-bold field-value">{{$employee->dateOfBirth()}}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Home Village : </span>
                        <span class="text-bold field-value">{{ $employee->home_village }}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Home T/A : </span>
                        <span class="text-bold field-value">{{ $employee->home_authority }}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Home District : </span>
                        <span class="text-bold field-value">{{ $employee->home_district }}</span>
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label">Residence Country : </span>
                        <span class="text-bold field-value">{{ $employee->residence_country }}</span>
                    </p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <h4 class="py-4 mb-3">B. Contact Information</h4>
                    <p class="mb-3">
                        <span class="text-bold field-label">Contact Address : </span>
                        <span class="text-bold field-value">{{$employee->contact_address}}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Official Email : </span>
                        <span class="text-bold field-value">{{$employee->official_email}}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Personal Email : </span>
                        <span class="text-bold field-value">{{$employee->personal_email}}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Phone Number 1 : </span>
                        <span class="text-bold field-value">{{$employee->phone1}}</span>
                    </p>
                    
                    @isset($employee->phone2)
                    <p class="mb-3">
                        <span class="text-bold field-label">Phone Number 2 : </span>
                        <span class="text-bold field-value">{{$employee->phone2}}</span>
                    </p>
                    @endisset

                </div>
            </div>
            <!-- End page -->

            <!-- page break -->
            <div class="page-break"></div>

            <!-- Start page-->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="py-4 mb-3">C. Employment Information</h4>

                    <p class="mb-3">
                        <span class="text-bold field-label"> Job Position : </span>                           
                        <span class="text-bold field-value">{{$employee->employment->getDesignation() }}</span>                            
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label"> Grade Scale : </span>                           
                        <span class="text-bold field-value">{{$employee->employment->gradeScale() }}</span>                            
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label"> Department : </span>                           
                        <span class="text-bold field-value">{{$employee->employment->getDepartment() }}</span>                            
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label"> Section : </span>                           
                        <span class="text-bold field-value">{{$employee->employment->getSection() }}</span>                            
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label"> Campus : </span>                           
                        <span class="text-bold field-value">{{$employee->employment->getCampus() }}</span>                            
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Employee Category : </span>
                        <span class="text-bold field-value">{{$employee->employment->getCategory() }}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Appointment Type : </span>
                        <span class="text-bold field-value">{{$employee->employment->getType() }}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Appointment Date : </span>
                        <span class="text-bold field-value">{{$employee->employment->startDate()}}</span>
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label">Period Of Service : </span>
                        <span class="text-bold field-value">{{$employee->employment->elapsedPeriod()}}</span>
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label">Remaining Period : </span>
                        <span class="text-bold field-value">{{$employee->employment->remainingPeriod()}}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Employment Status : </span>
                        <span class="text-bold field-value">{{ $employee->employment->getStatus() }}</span>
                    </p>
                </div>               
            </div>
            <!-- End page -->

            <!-- page break -->
            <div class="page-break"></div>

            <!-- Start page-->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="py-4 mb-3">D. Spouse Information</h4>
                
                    <p class="mb-3">
                        <span class="text-bold field-label"> Title : </span>                           
                        <span class="text-bold field-value">{{$employee->spouse->title}}</span>                            
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label"> Firstname : </span>                           
                        <span class="text-bold field-value">{{$employee->spouse->firstname}}</span>                            
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label"> Lastname : </span>                           
                        <span class="text-bold field-value">{{$employee->spouse->lastname}}</span>                            
                    </p>
                    @isset($employee->spouse->middlename)
                    <p class="mb-3">
                        <span class="text-bold field-label"> Middlename : </span>                           
                        <span class="text-bold field-value">{{$employee->spouse->middlename}}</span>                            
                    </p>
                    @endisset
                    <p class="mb-3">
                        <span class="text-bold field-label">Gender : </span>
                        <span class="text-bold field-value">{{$employee->spouse->gender}}</span>
                    </p>
                
                    <p class="mb-3">
                        <span class="text-bold field-label">Date of Birth : </span>
                        <span class="text-bold field-value">{{$employee->spouse->dateOfBirth()}}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Contact Address : </span>
                        <span class="text-bold field-value">{{$employee->spouse->contact_address}}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Phone Number 1 : </span>
                        <span class="text-bold field-value">{{$employee->spouse->phone1}}</span>
                    </p>

                    @isset($employee->spouse->phone2)
                    <p class="mb-3">
                        <span class="text-bold field-label">Phone Number 2 : </span>
                        <span class="text-bold field-value">{{$employee->spouse->phone2}}</span>
                    </p>
                    @endisset

                    <p class="mb-3">
                        <span class="text-bold field-label">Home Village : </span>
                        <span class="text-bold field-value">{{ $employee->spouse->home_village }}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Home T/A : </span>
                        <span class="text-bold field-value">{{ $employee->spouse->home_authority }}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Home District : </span>
                        <span class="text-bold field-value">{{ $employee->spouse->home_district }}</span>
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label">Residence Country : </span>
                        <span class="text-bold field-value">{{ $employee->spouse->residence_country }}</span>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4 class="py-4 mb-3">E. Next of Kin</h4>
                
                    <p class="mb-3">
                        <span class="text-bold field-label"> Name : </span>                           
                        <span class="text-bold field-value">{{$employee->kinsman->name()}}</span>                            
                    </p>
                    <p class="mb-3">
                        <span class="text-bold field-label"> Relation : </span>                           
                        <span class="text-bold field-value">{{$employee->kinsman->relation}}</span>                            
                    </p>
                
                    <p class="mb-3">
                        <span class="text-bold field-label">Occupation : </span>
                        <span class="text-bold field-value">{{$employee->kinsman->occupation}}</span>
                    </p>
                
                    <p class="mb-3">
                        <span class="text-bold field-label">Organisation : </span>
                        <span class="text-bold field-value">{{$employee->kinsman->organisation}}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Contact Address : </span>
                        <span class="text-bold field-value">{{$employee->kinsman->contact_address}}</span>
                    </p>

                    <p class="mb-3">
                        <span class="text-bold field-label">Phone Number 1 : </span>
                        <span class="text-bold field-value">{{$employee->kinsman->phone1}}</span>
                    </p>

                    @isset($employee->kinsman->phone2)
                    <p class="mb-3">
                        <span class="text-bold field-label">Phone Number 2 : </span>
                        <span class="text-bold field-value">{{$employee->kinsman->phone2}}</span>
                    </p>
                    @endisset

                    
                </div>
            </div>
            <!-- End page -->

            <!-- page break -->
            <div class="page-break"></div>

            <!-- Start page-->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="py-4 mb-3">F. Dependants</h4>

                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                                <th>Relation</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($employee->dependants as $key=> $dependant )
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$dependant->fullname()}}</td>
                                <td>{{$dependant->gender}}</td>
                                <td>{{$dependant->dateOfBirth()}}</td>
                                <td>{{$dependant->relation}}</td>
                            </tr>
                            @endforeach                           
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End page -->

            <!-- page break -->
            <div class="page-break"></div>

            <!-- Start page-->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="py-4 mb-3">G. Academic/Professional Qualifications</h4>

                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Specialty</th>
                                <th>Institution</th>
                                <th>Country</th>
                                <th>Year</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($employee->qualifications as $key=> $qualification )
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$qualification->name}}</td>
                                <td>{{$qualification->getLevel()}}</td>
                                <td>{{$qualification->specialization}}</td>
                                <td>{{$qualification->institution}}</td>
                                <td>{{$qualification->country}}</td>
                                <td>{{$qualification->year}}</td>
                            </tr>
                            @endforeach                           
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- End page -->

            <!-- page break -->
            <div class="page-break"></div>

            <!-- Start page-->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="py-4 mb-3">H. Academic/Professional Awards</h4>

                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Institution</th>
                                <th>Country</th>
                                <th>Year</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($employee->awards as $key=> $award )
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$award->name}}</td>
                                <td>{{$award->institution}}</td>
                                <td>{{$award->country}}</td>
                                <td>{{$award->year}}</td>
                            </tr>
                            @endforeach                           
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- End page -->

            <!-- page break -->
            <div class="page-break"></div>

            <!-- Start page-->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="py-4 mb-3">I. Career Progress</h4>

                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Designation</th>
                                <th>Progress</th>
                                <th>Grade</th>
                                <th>Notch</th>
                                <th>Date</th>>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($employee->orderedProgress() as $key => $progress )
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$progress->getDesignation()}}</td>
                                <td>{{$progress->getType()}}</td>
                                <td>{{$progress->grade}}</td>
                                <td>{{$progress->notch}}</td>
                                <td>{{$progress->startDate()}}</td>
                            </tr>
                            @endforeach                           
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End page -->

        </main>

        <!-- Script for adding Page Number -->
        <script type="text/php">
            if (isset($pdf)) {
                $text = "page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width) / 2;
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
        <!-- End script --> 

    </body>
</html>