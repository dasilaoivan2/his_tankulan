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
                <td style="font-size: 16pt; font-weight: bold">HOUSEHOLD OWNERSHIP REPORT</td>
            </tr>
            <tr>
                <td style="font-size: 14pt; font-weight: bold; text-transform:uppercase">{{$ownership->name}}</td>
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
                <td style="border: solid black 1px; background: lightgray;">NO.</td>
                <td style="border: solid black 1px; background: lightgray;">HOUSEHOLD NAME</td>
                <td style="border: solid black 1px; background: lightgray;">TYPE</td>
                <td style="border: solid black 1px; background: lightgray;">CLASSIFICATION</td>
                <td style="border: solid black 1px; background: lightgray;">HEAD OF FAMILY</td>
                <td width="50px" style="border: solid black 1px; background: lightgray;"># OF RESIDENT(S)</td>
                <td style="border: solid black 1px; background: lightgray;">ADDRESS</td>
                <td width="70px" style="border: solid black 1px; background: lightgray;">INCOME</td>
            </tr>
            @php
            $count = 0;
            $count_head = 0;
            @endphp


            @foreach($households as $household)

            @php
                $count++;
                
            @endphp

            <tr>
                <td style="border: solid black 1px;">{{$count}}</td>
                <td style="border: solid black 1px; text-transform: uppercase;">{{$household->residence_name}}</td>
                <td style="border: solid black 1px; text-transform: uppercase;">{{$household->type->name}}</td>
                <td style="border: solid black 1px; text-transform: uppercase;">{{$household->classification->name}}</td>
                <td style="border: solid black 1px; text-transform: uppercase">
                @foreach($household->citizensHead as $head)

                @php
                $count_head++;
                
                @endphp

                    {{$count_head}}. {{$head->fullname()}}<br>
                @endforeach
                </td>
                <td style="border: solid black 1px; text-transform: uppercase; text-align:center">{{$household->citizens->count()}}</td>
                <td style="border: solid black 1px; text-transform: uppercase;">{{$household->address_detail}}, {{$household->zone->name}}</td>
                <td style="border: solid black 1px; text-transform: uppercase;">{{$household->income}}</td>
                
                
            </tr>
            @php
                $count_head = 0;
                
                @endphp
            @endforeach
        </table>
        <br>

        <table style="text-align: center;">
            <tr>
                <td>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx NOTHING FOLLOWS xxxxxxxxxxxxxxxxxxxxxxxxxxx</td>
            </tr>
        </table>

        






    </div>



    <script>
        function printwindow() {
            window.print();
        }
    </script>
</body>

</html>