<?php
    include ('includes/logic/connect.php');
    if (isset($_POST['go'])) {
        $clientName = $conn->real_escape_string($_REQUEST['clientName']);
        $admissionDate = $conn->real_escape_string($_REQUEST['admissionDate']);
        $lengthStay = $conn->real_escape_string($_REQUEST['lengthStay']);
        $dischargeDate = $conn->real_escape_string($_REQUEST['dischargeDate']);
        $primaryTherapist = $conn->real_escape_string($_REQUEST['primaryTherapist']);
        $secondaryTherapist = $conn->real_escape_string($_REQUEST['secondaryTherapist']);
     //Test
        //$admissionNo = "SELECT (CONCAT"
        $sql = "INSERT INTO clientAdmission (clientId, admissionDate, lengthStay, dischargeDate, primaryTherapist, secondaryTherapist)
                VALUES ((SELECT id FROM clientInfo WHERE fullName = '$clientName'), '$admissionDate', '$lengthStay', NULLIF('$dischargeDate',''), '$primaryTherapist', NULLIF('$secondaryTherapist',''))";  
 
        $conn->query($sql);
    }
?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">

        <title>Client Admission Information</title>
        <!-- add icon link -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/falcon.png">

<!-- Live Search Styling -->
        <style>
            body{
                font-family: var(--bs-font-sans-serif);
            }
            /* Formatting search box */
            .search-box{
                width: 49%;
                position: relative;
                display: inline-block;
                font-size: inherit;
            }
            .search-box input[type="text"]{
                height: 36px;
                padding: 5px 10px;
                border: 1px solid #CCCCCC;
                font-size: inherit;
            }
            .result{
                position: absolute;        
                z-index: 999;
                top: 100%;
                left: 0;
            }
            .search-box input[type="text"], .result{
                width: 100%;
                box-sizing: border-box;
            }
            /* Formatting result items */
            .result p{
                margin: 0;
                padding: 7px 10px;
                border: 1px solid #CCCCCC;
                border-top: none;
                cursor: pointer;
                background: #FFFFFF;
            }
            .result p:hover{
                background: #f2f2f2;
            }

            .mandatory {
            color : red;
            }
        </style>
<!-- These scripts are for Live Search -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.search-box input[type="text"]').on("keyup input", function(){
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    if(inputVal.length){
                        $.get("includes/logic/client-search.php", {term: inputVal}).done(function(data){
                            // Display the returned data in browser
                            resultDropdown.html(data);
                        });
                    } else{
                        resultDropdown.empty();
                    }
                });
                
                // Set search input value on click of result item
                $(document).on("click", ".result p", function(){
                    $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result").empty();
                });
            });
        </script>

    </head>
    <body>
        <div class="container">

            <div class="d-flex justify-content-center">
                <img src="assets/img/LWC_Logo.png" height="300" width="300" alt="Responsive image" >
            </div>
            <br>
            
            <h1 text-align=center>Client Admission Information</h1>
            
            
            <br>
            <form method="post" enctype="multipart/form-data">
                <!-- <div class="row">
                    <div class="col-md-6 col-sm-6"> -->
                        <div class="search-box">
                        <span class= "mandatory">*</span><label for="clientName">Client Name:</label>
                            <input id="clientName" type="text" name="clientName" minlength="4" maxlength="40" class="form-control" required="required" placeholder="Client Name" autocomplete="off">
                            <div class="result"></div>
                        </div>
                    <!-- </div>
                </div> -->
                <br>
                <br>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                        <span class= "mandatory">*</span><label for="admissionDate">Date of Admission:</label>
                            <input id="admissionDate" onchange="checkFilledname();" type="date" name="admissionDate" minlength="4" maxlength="10" class="form-control" required="required" placeholder="Admission Date">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                        <span class= "mandatory">*</span><label for="lengthStay">Length of Stay (days):</label>
                            <input id="lengthStay" onchange="checkFilledname();" type="number" name="lengthStay" minlength="4" maxlength="10" class="form-control" required="required" placeholder="Length of Stay">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label for="dischargeDate">Date of Discharge:</label>
                            <input id="dischargeDate" onchange="checkFilledname();" type="date" name="dischargeDate" minlength="4" maxlength="10" class="form-control" placeholder="Discharge Date">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                        <span class= "mandatory">*</span><label for="primaryTherapist">Primary Therapist:</label>
                            <input id="primaryTherapist" onchange="checkFilledname();" type="text" name="primaryTherapist" minlength="4" maxlength="40" class="form-control" required="required" placeholder="Primary Therapist">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                        <label for="secondaryTherapist">Secondary Therapist:</label>
                            <input id="secondaryTherapist" onchange="checkFilledname();" type="text" name="secondaryTherapist" minlength="4" maxlength="40" class="form-control" placeholder="Secondary Therapist">
                        </div>
                    </div>
                </div>
                <br>   
                <br>
                <br> 
                <button type="button" class="btn btn-danger">Cancel</button>
                          
                <button type="submit" name="go" class="btn btn-success">Save</button>
            </form>
            
            
        </div>

        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
