<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MEDICAL CERTIFICATE</title>
</head>

<style>
    * {
        font-family: DejaVu Sans, sans-serif;
    }

    img {
        width: 100px;
        height: 100px;
    }

    .image_2 {
        width: 100px;
        height: 100px;
        position: absolute;
        margin-left: 513px;
        top: 83px;
    }


    .text-title {
        text-align: center;
        position: absolute;
        margin-left: 142px;
        top: 50px;
        font-weight: lighter;
        font-size: 15px;
    }

    .text-title_big {
        text-align: center;
        font-size: 15px;
        margin-left: 117px;
        position: absolute;
        top: 75px;
    }

    .text-title_small {
        text-align: center;
        margin-left: 260px;
        position: absolute;
        top: 120px;
    }

    .text-title_semi {
        margin-left: 160px;
        position: absolute;
        top: 140px;
        text-align: center;
    }

    .container {
        position: relative;
        top: 20;
        width: 100%;
        height: 80vh;

    }
</style>

<body>
    <div style="font-size: 13px; padding:10px;">
        MEDICAL CERTIFICATE NO. <span style="font-weight:bold;">{{ $certificate->certificateID }}</span>
    </div>
    <div style="border: 1px solid black; padding:40px;">
        <div class="image">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSj7eJhMLleCk5-e1m_160MvasYxClHjs8-KeEDfpVLScpqoB2H8sOz3sKA0XwOoN2oqsc&usqp=CAU"
                alt="">
        </div>
        <div class="text-title">
            <h3>UNIVERSITY OF NUEVA CACERES</h3>
        </div>
        <div class="text-title_big">
            <h1>MEDICAL CERTIFICATE</h1>
        </div>
        <div class="text-title_small">
            <h5>from</h5>
        </div>
        <div class="text-title_semi">
            <h4>Health Service Department</h4>
        </div>
        <div class="image_1">
            <img class="image_2"
                src="https://unc.edu.ph/wp-content/uploads/2022/04/79794414_111016303724059_5940762222245445632_n-800x800.jpg"
                alt="">
        </div>
    </div>
    <div class="container">
        <div style="position: absolute; float: right;">Date: <span
                style="text-decoration: underline; padding:3px; font-weight:bold; top:50;"> {{ date('F j, Y') }}</span>
        </div>
        <div style="position: relative; top:40; margin:1rem; font-weight:bold;">
            To Whom it May Concern:
        </div>
        <div style="position: relative; top:40; margin:40px;">
            THIS IS TO CERTIFY that <span style="text-transform: uppercase; font-weight:bold">{{$certificate->patient->student->first_name ?? $certificate->patient->employee->first_name ??""}} {{$certificate->patient->student->last_name ?? $certificate->patient->employee->last_name ??""}}</span>
            , <span style="text-transform: uppercase; font-weight:bold;">{{$certificate->patient->student->student_department ?? $certificate->patient->employee->student_department ??""}} </span>
        </div>
    </div>
</body>

</html>
