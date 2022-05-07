<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>{{$employee->name()}}</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <style>
            .id-card{
                display: block;
                font-size: 8px;
                width: auto;
                height: auto;
            }

            .id-card .id-card-header{
                height: 40px;
                font-family: 'Segoe UI';
                font-weight:bolder;
                background-color: #01911b;
                text-align: center;
            }

            .id-card .id-card-header .id-card-header-title{
                text-transform: uppercase;
            }

            .id-card .id-card-header .id-card-header-address{
                font-family: 'verdana';
                font-weight:bold;
                font-size:6px;
            }

            .id-card .id-card-body{
                display: block;
            }

            .id-card .id-card-body .id-card-info{
                position: absolute;
                font-family: Helvetica;
                display: block;
                width: 150px;
                margin-left:10px;
                height: auto;
            }

            .id-card .id-card-body .id-card-info .id-card-info-header{
                text-align:center;
            }

            .id-card .id-card-body .id-card-info .id-card-info-header .id-label{
                font-size:10px; 
                font-weight:bolder;
            }

            .id-card .id-card-body .id-card-info .id-card-info-header .id-number{
                font-size:11px; 
                border: solid 1px; 
                border-radius:4px; 
                font-weight:bolder;
            }

            .id-card .id-card-body .id-card-info .field-label {
                display: inline-block;
                text-align: right;
            }

            .id-card .id-card-body .id-card-info .field-value {
                display: inline-block;
                width: auto;
                text-align: right;
                font-weight:bolder;
                padding-left: 10px;
            }

            .id-card .id-card-body .id-card-logo{
                display: block;
                float: left;
            }

            .id-card .id-card-body .id-card-logo img{
                position: absolute;
                width: 70px;
                height: 80px;
            }

            .id-card .id-card-body .id-card-photo{
                display: block;
                float: right;
            }

            .id-card .id-card-body .id-card-photo img{
                position: absolute;
                width: 70px;
                height: 80px;
            }
            
            .id-card .id-card-footer{
                position: relative;
                top:65%;
                display: block;
                height: auto;
             
            }

            .id-card .id-card-footer .id-card-barcode{
                position: absolute;
                left:20%;

            }

            .id-card .id-card-footer .id-card-signature{
                display: block;
                font-family: Helvetica;
                font-weight:bold;   
               
            }

            .id-card .id-card-footer .id-card-signature .authority{            
                font-size: 5px;
                float:left;
                text-align: left;
            }

            .id-card .id-card-footer .id-card-signature .authority img{
                width:50px;
                height: 20px;
            }

            .id-card .id-card-footer .id-card-signature .holder{
                font-size: 5px;
                float:right;
                text-align: center;
                
            }

            .id-card .id-card-footer .id-card-signature .holder img{
                width:50px;
                height: 20px;

            }
         
        </style>

    </head>
    <body>
        <main>
            @php  
                $company_name = OrgSettings::get('company_name'); 
                $company_logo = OrgSettings::get('company_logo'); 
                $company_address = OrgSettings::get('company_address'); 
                $company_telephone = OrgSettings::get('company_telephone'); 
            @endphp

            <div class="id-card">
                <div class="id-card-header" >
                    <p class="id-card-header-title mb-0 py-1" >{{$company_name}}</p>
                    <p class="id-card-header-address mb-0">
                        {{$company_address}}<br/>
                        Tel:{{$company_telephone}}
                    </p>
                </div>

                <div class="id-card-body">
                    <div class="row">
                        <div class="col-sm float-left mb-0 py-0">
                            <div class="id-card-logo py-1">
                                <img src="{{ asset("storage/{$company_logo}") }}" class="img-fluid" />
                            </div>
                            
                        </div>
                        <div class="col-sm float-left mb-0 py-0">
                            <div class="id-card-info">
                                <div class="id-card-info-header">
                                    <p class="mb-1 py-1 display-h4"><strong>{{strtoupper($employee->campus->name)}}</strong></p>

                                    <p class="mb-0 id-label">
                                        STAFF ID
                                    </p>
                                    <p class="mb-2 id-number">
                                        {{$employee->id}}
                                    </p>
                                    
                                </div>

                                <div class="id-card-info-body">
                                    
                                    <p class="mb-0">
                                        <span class="field-label">First Name : </span>
                                        <span class="text-bold field-value">{{$employee->firstname}}</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="field-label">Last Name : </span>
                                        <span class="text-bold field-value">{{$employee->lastname}}</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="field-label">Department : </span>
                                        <span class="text-bold field-value">{{$employee->division()}}</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="field-label">Expire Date : </span>
                                        <span class="text-bold field-value">{{$employee->endDate()}}</span>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm float-right mb-0 py-0">
                            <div class="id-card-photo">
                                <img src="{{ asset("storage/".$employee->avatar) }}" class="img-fluid" />
                            </div>        
                        </div>
                    </div>

                    
                </div>

                <div class="id-card-footer">
                    <div class="id-card-barcode">
                        {!!DNS1D::getBarcodeHTML("{$employee->id}", 'S25')!!}
                    </div>

                    <div class="id-card-signature">

                        <div class="authority">
                            <p> 
                                Registrar's Signature <br/>
                                <img src="{{ asset("storage/".$employee->signature) }}" />
                            </p>
                        </div>
                    
                        <div class="holder">
                            <p> 
                                Holders's Signature <br/>
                                <img src="{{ asset("storage/".$employee->signature) }}" />
                            </p>
                        </div>
                    </div>
                   
                </div>
            </div>


        </main>
    </body>
</html>
