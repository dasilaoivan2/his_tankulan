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
        font-size: x-large;
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
                <td style="font-size: 16pt; font-weight: bold">HOUSEHOLD REPORT</td>
            </tr>
        </table>
    </div>

    <br>
    <br>

    <div class="content">

        <fieldset id="household">
            <legend>HOUSEHOLD INFORMATION</legend>


            <table>
                <tr>
                    <td class="font-normal bold">Household Type:</td>
                    <td>{{$household->type->name}}</td>
                    <td width="150px"></td>
                    <td class="font-normal bold">Household Classification:</td>
                    <td>{{$household->classification->name}}</td>
                </tr>

            </table>

            <table>
                <tr>
                    <td class="font-normal bold">Household Address:</td>
                    <td>{{$household->address_detail}} {{$household->zone->name}} {{$household->barangay->name}} Manolo Fortich, Bukidnon 8703</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="font-normal bold">Residence Name:</td>
                    <td>{{$household->residence_name}}</td>
                    <td width="50px"></td>
                    <td class="font-normal bold">Income:</td>
                    <td>{{$household->income}}</td>
                    <td width="50px"></td>
                    <td class="font-normal bold">Residents:</td>
                    <td>{{$household->citizens->count()}}</td>
                </tr>

            </table>



        </fieldset>

        <br>

        <fieldset id="household">
            
            <legend>RESIDENTS</legend>

            <table>
               <thead>
                <tr>
                    <td class="font-normal bold">#</td>
                    <td class="font-normal bold">Fullname</td>
                    <td class="font-normal bold">Birthdate</td>
                    <td class="font-normal bold">Age</td>
                    <td class="font-normal bold">Gender</td>
                    <td class="font-normal bold">Role</td>
                </tr>
                </thead>

                <tbody>
                    <?php $count = 0 ?>
                @foreach($household->citizensOrderByRole as $citizen)
                <?php $count++ ?>
                <tr>
                    <td class="font-normal" style="text-transform: uppercase;">{{$count}}</td>
                    <td class="font-normal" style="text-transform: uppercase;">{{$citizen->fullnameLastname()}}</td>
                    <td class="font-normal" style="text-transform: uppercase;">{{\Carbon\Carbon::parse($citizen->birthdate)->format('F d, Y')}}</td>
                    <td class="font-normal" style="text-transform: uppercase;">{{$citizen->age()}}</td>
                    <td class="font-normal" style="text-transform: uppercase;">{{$citizen->gender->name}}</td>
                    <td class="font-normal" style="text-transform: uppercase;">{{$citizen->familyrole->name}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>


            
            <br>


            




        </fieldset>






    </div>



    <script>
        function printwindow() {
            window.print();
        }
    </script>
</body>

</html>