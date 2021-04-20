@extends('home')

@section('cont')

<kbd><a href="/env-restoration/create" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
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
                <h1 class="page-title">FAQs - Environment Restoration Module</h1>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="clearfix mb-0">
                                <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> What is the restoration form ? </a>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">This form is used to collect information on the restoration activities carried out in the critical ecosystems of our country. It would allow the relevant authorities to be informed of such activities being carried out .</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> How do I fill restoration project name and restored land title name ?</a>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">Restoration project name refers to the unique project name you may assign to your restoration project. Restored land parcel title refers to the title of the land parcel you are carrying out your restoration in.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i> How to fill the field "Governing organizations for the land parcel" ?</a>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">This is a optional entry field for the applicant where if they are informed of the governing bodies for that relevant land parcel, they may add in. Please note that this field is optional and the organization that this form needs to be submitted to should be entered in the 'Organization to be submitted to' field.</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-chevron-circle-down"></i> Can I add multiple disjoint map areas which my project would be restoring ?</a>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
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
                        <div id="collapseFive" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">For each tree species type restoted , you can enter the generic name of the species restored (you may select based on the typeahead options received), quantity of that species type restored, height, dimensions and special remarks if any. If you wish to add more species types and it's data, click on the add button and repeat process.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection