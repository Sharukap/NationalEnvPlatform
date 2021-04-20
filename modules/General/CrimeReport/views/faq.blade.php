@extends('home')

@section('cont')

<kbd><a href="/crime-report/newcrime" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
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
                <h1 class="page-title">FAQs - Crime Report Module </h1>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="clearfix mb-0">
                                <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> How to make a complaint?</a>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">Select an organization to forward your complaint. The administrators will review and reassign if necessary.Description of the complaint Area Name and Location to be marked on map too.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> What if the complainant does not have an account and the complaint is made by someone else on their behalf?</a>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">Tick the box “Creating on behalf of non-registered user” and include the name and email of the complainant so he/she can be informed on the action taken.</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i> How can I know whether my request is approved or not?</a>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">Visit the requests tab from the side mounted navbar.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection