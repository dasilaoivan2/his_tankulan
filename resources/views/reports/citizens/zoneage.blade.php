<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Household Information System</title>
    <link href="{{asset('storage/logo/tankulan_logo.png')}}" rel="icon">
</head>
<style>
    body {
        font-family: "Calibri";
        margin: 0px;
    }

    body.long-size {
        width: 8.5in;
        height: 13in;
        /* border: solid 1px black; */
        /* page-break-after: always; */
    }

    .text {
        font-size: 8px;
    }

    .header {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        /*border: solid black 1px;*/
        /*border-collapse: collapse;*/
    }

    #logo1 {
        position: relative;

    }

    #logo2 {
        position: absolute;
        top: 30px;
        left: 80px;
    }

    .border {
        border: solid black 1px;
        border-collapse: collapse;
    }

    .content {
        width: 100%;
        float: left;
        /*display: block;*/
        font-size: 11pt;
    }

    .title {
        font-weight: bold;
        font-size: 14pt;
    }

    .data {
        font-size: 12pt;
    }

    .title-indent {
        text-indent: 30px;
    }

    .data-indent {
        text-indent: 30px;
    }

    ul.d {
        list-style-type: lower-alpha;
    }

    .font-normal {
        font-size: 12pt;
    }

    .font-11 {
        font-size: 11pt;
    }

    .bold {
        font-weight: bold;
    }

    .bolder {
        font-weight: bolder;
    }

    .underline {
        text-decoration: underline;
    }

    .text-justify {
        text-align: justify;
    }

    .text-center {
        text-align: center;
    }

    .bg-gray {
        background-color: lightblue;

    }

    .border-bottom {
        border-bottom: solid 2px black;
    }

    .qr {
        /*border: 1px solid black;*/
        background-repeat: no-repeat;
        display: inline-flex;

    }

    .center {
        margin: auto;
        width: 100%;
        padding: 10px;
    }

    fieldset {
        position: relative;
    }

    /* For legend positioning */

    #household legend {
        padding: 0;
        font-size: 14pt;
        font-weight: bolder;
    }

    /* Remove padding */



    #household table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12pt;
        margin-bottom: 10px;
    }

    .picture {
        left: 688px;
        top: 119px;
        width: 1in;
        height: 1in;
        border: solid 1px black;
        position: absolute;
    }

    #logo-bg {
        position: absolute;
        opacity: 5%;
    }
</style>

<body class="long-size">
    <div id="logo-bg">
        <img style="width: 8.5in" src="{{asset('storage/logo/tankulan_logo.png')}}">
    </div>

    <div id="logo2">
        <img style="width: 110px" src="{{asset('storage/logo/tankulan_logo.png')}}">
    </div>

    <br>
    <br>

    <div class="header">
        <table>
            <tr>
                <td style="font-size: 16pt; font-weight: bold">Republic of the Philippines</td>
            </tr>

            <tr>
                <td style="font-size: 14pt; font-weight: bold">Province of Bukidnon</td>
            </tr>


            <tr>
                <td style="font-size: 14pt; font-weight: bold">MUNICIPALITY OF MANOLO FORTICH</td>
            </tr>

            <tr>
                <td style="font-size: 14pt; font-weight: bold">_______________________________________</td>
            </tr>

            <tr>
                <td style="font-size: 18pt; font-weight: bold">BARANGAY TANKULAN</td>
            </tr>
        </table>
        <br>
        <br>

        <table>
            <tr>
                <td style="font-size: 16pt; font-weight: bold; text-transform:uppercase">{{$age->name}} REPORT</td>
            </tr>
            <tr>
                <td style="font-size: 14pt; font-weight: bold; text-transform:uppercase">Age between

                    @if($age->id != 1)

                    {{$age->from}} - {{$age->to}}
                    years

                    @else


                    0 - 11 months


                    @endif


                    Old
                </td>
            </tr>
            </tr>

            <tr>
                <td style="font-size: 12pt; font-weight: bold; text-transform:uppercase">{{$zone->name}}</td>
            </tr>
        </table>
    </div>

    <br>
    <br>

    <div class="content">
        <table>
            <tr>
                <td width="150px" style="font-size: 12pt; font-weight: bold; margin-left: 10px">MALE:</td>
                <td style="font-size: 12pt; font-weight: bold; margin-left: 10px">{{$gender_records->male}}</td>
                <td width="850px" style="font-size: 12pt; font-weight: bold; margin-left: 10px"></td>
            </tr>
            <tr>
                <td width="150px" style="font-size: 12pt; font-weight: bold; margin-left: 10px">FEMALE:</td>
                <td style="font-size: 12pt; font-weight: bold; margin-left: 10px">{{$gender_records->female}}</td>
            </tr>
            <tr>
                <td width="150px" style="font-size: 16pt; font-weight: bold; margin-left: 10px">TOTAL:</td>
                <td width="150px" style="font-size: 16pt; font-weight: bold; margin-left: 10px">{{$gender_records->all}}</td>
            </tr>

        </table>
        <br>
        
        <table>
            <tr>
                <td style="border: solid black 1px; background: lightgray;">NO.</td>
                <td style="border: solid black 1px; background: lightgray;">LASTNAME</td>
                <td style="border: solid black 1px; background: lightgray;">FIRSTNAME</td>
                <td style="border: solid black 1px; background: lightgray;">MIDDLENAME</td>
                <td width="35px" style="border: solid black 1px; background: lightgray;">EXT.</td>
                <td style="border: solid black 1px; background: lightgray;">BIRTHDATE</td>
                <td style="border: solid black 1px; background: lightgray;">AGE</td>
                <td style="border: solid black 1px; background: lightgray;">CONTACT NO.</td>
            </tr>
            @php
            $count = 0
            @endphp


            @foreach($citizens as $citizen)

            @php
            $count++
            @endphp

            <tr>
                <td style="border: solid black 1px;">{{$count}}</td>
                <td style="border: solid black 1px; text-transform: uppercase;">{{$citizen->lastname}}</td>
                <td style="border: solid black 1px; text-transform: uppercase;">{{$citizen->firstname}}</td>
                <td style="border: solid black 1px; text-transform: uppercase;">{{$citizen->middlename}}</td>
                <td width="35px" style="border: solid black 1px; text-transform: uppercase;">{{$citizen->suffixname}}</td>
                <td style="border: solid black 1px; text-transform: uppercase;">{{\Carbon\Carbon::parse($citizen->birthdate)->format('M d, Y')}}</td>
                <td style="border: solid black 1px; text-transform: uppercase;">
                    @if($citizen->age() < 1) @if($citizen->ageMonth() < 1) {{\Carbon\Carbon::parse($citizen->birthdate)->diff(\Carbon\Carbon::now())->format('%d day(s)')}} @else {{\Carbon\Carbon::parse($citizen->birthdate)->diff(\Carbon\Carbon::now())->format('%m month(s)')}} @endif @else {{\Carbon\Carbon::parse($citizen->birthdate)->diff(\Carbon\Carbon::now())->format('%y')}} @endif <!-- {{\Carbon\Carbon::parse($citizen->birthdate)->age}} -->
                </td>
                <td style="border: solid black 1px; text-transform: uppercase;">{{$citizen->contact_no}}</td>
            </tr>
            @endforeach
        </table>
        <br>

        <table style="text-align: center;">
            <tr>
                <td>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx NOTHING FOLLOWS xxxxxxxxxxxxxxxxxxxxxxxxxxx</td>
            </tr>
        </table>

        <!-- dd{{$citizens}} -->






    </div>



    <script>
        function printwindow() {
            window.print();
        }
    </script>
</body>

</html>