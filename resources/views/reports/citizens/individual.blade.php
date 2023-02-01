<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Household Information System</title>
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
                <td style="font-size: 16pt; font-weight: bold">INDIVIDUAL CITIZEN REPORT</td>
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
                    <td>{{$citizen->household->type->name}}</td>
                    <td width="150px"></td>
                    <td class="font-normal bold">Household Classification:</td>
                    <td>{{$citizen->household->classification->name}}</td>
                </tr>

            </table>

            <table>
                <tr>
                    <td class="font-normal bold">Household Address:</td>
                    <td>{{$citizen->household->address_detail}} {{$citizen->household->zone->name}} {{$citizen->household->barangay->name}} Manolo Fortich, Bukidnon 8703</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="font-normal bold">Residence Name:</td>
                    <td>{{$citizen->household->residence_name}}</td>
                    <td width="150px"></td>
                    <td class="font-normal bold">Income:</td>
                    <td>{{$citizen->household->income}}</td>
                </tr>

            </table>



        </fieldset>

        <br>

        <fieldset id="household">
            <!-- <div class="picture">
                <img style="width: 1in" src="{{asset('storage/photo/'.$citizen->photo)}}">
            </div> -->
            <legend>CITIZEN INFORMATION</legend>


            <table>
                <tr>
                    <td class="font-normal bold">Fullname:</td>
                    <td width="500px" style="text-transform: uppercase;">{{$citizen->fullname()}}</td>
                    <td class="font-normal bold">Age:</td>
                    <td style="text-transform: uppercase;">{{$citizen->age()}}</td>
                    <td class="font-normal bold">Gender:</td>
                    <td>{{$citizen->gender->name}}</td>
                    <td width="50px"></td>
                    <td rowspan="3"><img style="width: 1in" src="{{asset('storage/photo/'.$citizen->photo)}}"></td>


                </tr>

            
                <tr>
                    <td class="font-normal bold">Birthdate:</td>
                    <td>{{\Carbon\Carbon::parse($citizen->birthdate)->format('F d, Y')}}</td>
                    <td class="font-normal bold">Family Role:</td>
                    <td>{{$citizen->familyrole->name}}</td>
                    <td width="100px"></td>

                </tr>
         
                <tr>
                    <td class="font-normal bold">Contact No.:</td>
                    <td width="100px">{{$citizen->contact_no}}</td>
                    <td class="font-normal bold">Email Address:</td>
                    <td width="100px">{{$citizen->email}}</td>
                    <td width="100px"></td>

                </tr>
            </table>



            <table>
                <tr>
                    <td class="font-normal bold">Permanent Address:</td>
                    <td>{{$citizen->permanent_address}}</td>
                </tr>

            </table>
            <br>


            <table>
                <tr>
                    <td class="font-normal bold">Category:</td>
                </tr>
            </table>

            <table st style="margin-left: 20px;">
                <tr>
                    @if($citizen->categories->count() > 0)
                    @foreach($citizen->categories as $category)
                    <td class="font-normal">{{$category->name}}</td>
                    @endforeach
                    @else
                    <td class="font-normal bolder">No category</td>
                    @endif
                </tr>
            </table>

            <table>
                <tr>
                    <td class="font-normal bold">Programs:</td>
                </tr>
            </table>

            <table st style="margin-left: 20px;">
                <tr>
                    @if($citizen->programs->count() > 0)
                    @foreach($citizen->programs as $program)
                    <td class="font-normal">{{$program->name}}</td>
                    @endforeach
                    @else
                    <td class="font-normal bolder">No program benefit</td>
                    @endif
                </tr>
            </table>

            <table>
                <tr>
                    <td class="font-normal bold">Pending Cases:</td>
                </tr>
            </table>

            <table st style="margin-left: 20px;">
                <tr>
                    @if($citizen->pendingcases->count() > 0)
                    @foreach($citizen->pendingcases as $pendingcase)
                    <td class="font-normal">{{$pendingcase->name}}</td>
                    @endforeach
                    @else
                    <td class="font-normal bolder">No pending case</td>
                    @endif
                </tr>
            </table>




        </fieldset>






    </div>



    <script>
        function printwindow() {
            window.print();
        }
    </script>
</body>

</html>