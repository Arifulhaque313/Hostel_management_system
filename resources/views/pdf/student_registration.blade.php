<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Permission Slip for Students Photos/ Artworks/ Performances</title>
</head>
<body>
    <div class="container">
        
        <div>
            <div class="img">
                <img src="{{ public_path('/images/logo.png') }}" alt="" height="58px">
            </div>
            <center><h2 style="color: #111827"><b>Student Details</b></h2></center>

            <div class="student_registration">
                
                <table style="width: 100%">
                    <h3>Student's Personal Info</h3>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                    <tr>
                        <td>{{$regRequest->student_name}}</td>
                        <td>{{$regRequest->email}}</td>
                    </tr>  

                    <br> 
                    <tr>
                        <th>Mobile Number</th>
                        <th>Date Of Birth</th>
                    </tr>
                    <tr>
                        <td>{{$regRequest->mobile_number}}</td>
                        <td>{{$regRequest->birthdate}}</td>
                    </tr>

                    <br> 
                    <tr>
                        <th>Student Type</th>
                        <th>Grade</th>
                    </tr>
                    <tr>
                        <td>{{$regRequest->student_type}}</td>
                        <td>{{$regRequest->grade}}</td>
                    </tr>

                    <br> 
                    <tr>
                        <th>Address</th>
                        <th>Gender</th>
                    </tr>
                    <tr>
                        <td>{{$regRequest->address}}</td>
                        <td>{{$regRequest->gender}}</td>
                    </tr>

                    <br>
                    <h3 style="color: #111827">Others Info</h3>

                    <tr>
                        <th>Guardian's Name</th>
                        <th>Home Number</th>
                    </tr>
                    <tr>
                        <td>{{$regRequest->guardian_name}}</td>
                        <td>{{$regRequest->home_number}}</td>
                    </tr>

                    <br> 
                    <tr>
                        <th>Emergency Number</th>
                        <th>Work Number</th>
                    </tr>
                    <tr>
                        <td>{{$regRequest->emergency_number}}</td>
                        <td>{{$regRequest->work_number}}</td>
                    </tr>
                </table>
               
            </div>

            <div class="signature">
                 <p class="border-top"> &nbsp; Signature  &nbsp;</p>
            </div>
        </div>
        
    </div>




    <style>
        body{
            font-family: sans-serif;
        }
        .container{
            /* margin: 5% 5%; */
            margin-top: 60px;
            border: 1px solid rgb(196, 192, 192);
            border-radius: 10px;
            padding: 30px 0px 30px 0px;
        }
        .img{
            text-align: center
        }
        h2{
            text-align: center;   
        }

        /* p{
            font-size: 18px;
            margin: auto auto auto 30px;
        } */
        .underline{
            text-decoration: underline;
        }
        .student_registration table{
            padding: 0px 0px 0px 100px;

        }
        .student_registration tr th{
            text-align: left;
            width: 50%;
            color:#6b7280
        }
        .student_registration tr td{
            text-align: left;
            width: 50%;
            color: #111827;
        }
        .signature{
            margin-top: 50px;
            text-align: right;
            margin-right: 60px;  
            color: #111827;
        }
        .border-top{
            display: inline-block;
            border-top: 1px solid #111827;
        }
       
    </style>
    
</body>
</html>