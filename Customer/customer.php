<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include '../inc/header/header.php';
    include '../config.php';


    ?>
    <title>Customer</title>
</head>

<body>
    <section class="side-navbar">
        <?php include '../inc/nav/nav.php' ?>


        <div class="container-fluid content-body">
            <div class="row">
                <div class="page-content-header">

                    <h1 class="Page-Title pop">Customer</h1>
                    <hr class="Page-Title-hr">

                    <?php
                    // define variables and set to empty values
                    $titleErr =  $fnameErr =  $lnameErr = $teleErr = $districtErr = $mnameErr = '';
                    $title = $fname = $lname = $tele = $district = $mname = '';
                    $titlebol = $fnamebol = $lnamebol = $telebol = $districtbol = $mnamebol = '';

                    // Validating Form Submitted Data
                    if (isset($_POST['submit_button'])) {

                        //title Validation
                        if (($_POST["title"]) == 'Select Title' && empty($_POST["title"])) {
                            $titleErr = "Title is required";
                            echo '<div class="alert alert-danger" role="alert">' . $title . '</div>';
                            echo '<br>';
                            $titlebol = false;
                        } else {
                            $title = validation($_POST["title"]);
                            $titlebol = true;
                        }

                        //First Name Validation
                        if (empty($_POST["first-name"])) {
                            $fnameErr = "First Name is required";
                            echo '<div class="alert alert-danger" role="alert">' . $fnameErr . '</div>';
                            echo '<br>';
                            $fnamebol = false;
                        } else {
                            $fname = validation($_POST["first-name"]);
                            $fnamebol = true;

                            // check if First Name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
                                $fnameErr = "First Name - Only letters and white space allowed";
                                echo '<div class="alert alert-danger" role="alert">' . $fnameErr . '</div>';
                                echo '<br>';
                                $fnamebol = false;

                            }
                        }
                        //Middle Name Validation
                        if (empty($_POST["middle-name"])) {
                            $mnameErr = "Middle Name is required";
                            echo '<div class="alert alert-danger" role="alert">' . $mnameErr . '</div>';
                            echo '<br>';
                            $mnamebol = false;
                        } else {
                            $mname = validation($_POST["middle-name"]);
                            $mnamebol = true;


                            // check if Last Name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z-' ]*$/", $mname)) {
                                $mnameErr = "Middle Name - Only letters and white space allowed";
                                echo '<div class="alert alert-danger" role="alert">' . $mnameErr . '</div>';
                                echo '<br>';
                                $mnamebol = false;
                            }
                        }
                        //Last Name Validation
                        if (empty($_POST["last-name"])) {
                            $lnameErr = "Last Name is required";
                            echo '<div class="alert alert-danger" role="alert">' . $lnameErr . '</div>';
                            echo '<br>';
                            $lnamebol = false;
                        } else {
                            $lname = validation($_POST["last-name"]);
                            $lnamebol = true;


                            // check if Last Name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
                                $lnameErr = "Last Name - Only letters and white space allowed";
                                echo '<div class="alert alert-danger" role="alert">' . $lnameErr . '</div>';
                                echo '<br>';
                                $lnamebol = true;

                            }
                        }
                        //Phone Number Validation
                        if (empty($_POST["telephone"])) {
                            $teleErr = "Telephone Number is required";
                            echo '<div class="alert alert-danger" role="alert">' . $teleErr . '</div>';
                            echo '<br>';
                            $telebol = false;
                        } else {
                            $tele = validation($_POST["telephone"]);
                            $telebol = true;

                            //check if phone number is a valid phone number
                            if (!preg_match('/^[0-9]{9,14}\z/', $tele)) {
                                $teleErr = "Phone Number - Only Numbers allowed";
                                echo '<div class="alert alert-danger" role="alert">' . $teleErr . '</div>';
                                echo '<br>';
                                $telebol = false;

                            }
                        }

                        //Distric Validation
                        if (empty($_POST["district"])) {
                            $districtErr = "District is required.";
                            echo '<div class="alert alert-danger" role="alert">' . $districtErr . '</div>';
                            echo '<br>';
                            $districtbol = false;

                        } else {
                            $district = validation($_POST["district"]);
                            $districtbol = true;
                        }

                        header("Refresh: 3");
                    }

                    function validation($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    // Inserting Data into Database 
                    if ($titlebol === true &&  $fnamebol === true && $lnamebol === true && $telebol === true && $districtbol === true && $mnamebol === true ) {
                        $query = "INSERT INTO customer(title,first_name,middle_name,last_name,contact_no,district) VALUES ('$title','$fname','$mname','$lname','$tele','$district')";
                        if ($connect->query($query) === TRUE) {
                            echo '<div class="alert alert-success" role="alert"> Form Successfully Submitted. New Customer created Successfully.  </div>';
                            header("Refresh: 3");
                        } else {
                            echo '<div class="alert alert-danger" role="alert"> Form Submission Faild. Please Retry.  </div>' . $query . "<br>" . $connect->error;
                            mysqli_close($connect);
                            header("Refresh: 3");
                        }
                    }
                    ?>
                    <div class="customer-flex-content">

                        <!-- Card start from here  -->
                        <div class="card cs">
                            <div class="card-body cs">
                                <!-- Form start From here  -->
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="form-group">
                                        <label class="form-label me-1 mb-0">Title</label>
                                        <select class="form-select" name="title">
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Dr">Dr</option>
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="form-label me-1 mb-0">First Name</label>
                                        <input type="text" class="input-class" name="first-name">
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="form-label me-1 mb-0">Middle Name</label>
                                        <input type="text" class="input-class" name="middle-name">
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="form-label me-1 mb-0">Last Name</label>
                                        <input type="text" class="input-class" name="last-name">
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="form-label cn me-1 mb-0">Contact Number</label>
                                        <input type="tel" name="telephone" class="input-class cn">
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="form-label d me-1 mb-0">District</label>
                                        <select class="form-select" name="district">
                                            <?php
                                            $dselect = "SELECT id, district FROM district";
                                            $dresult = mysqli_query($connect , $dselect);

                                            while($result = mysqli_fetch_assoc($dresult)){

                                                echo "<option value=\"{$result['id']}\">{$result['district']}</option>";

                                            }
                                            
                                            
                                            ?>
                                        
                                        </select>
                                    </div>


                                    <input type="submit" name="submit_button" value="Register Customer" class="btn mt-4 submit-btn">
                                </form>
                                <!-- form ends from here  -->

                            </div>
                        </div>

                        <!-- Card start from here  -->
                        <div class="card cst">
                            <div class="card-body cst">
                            <?php
                                // SQL query to select data from database
                                    $select = "SELECT * FROM customer";
                                    $result = $connect -> query($select);
                                    $connect->close();      
                            ?>
                                <table class="table">
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            First Name
                                        </th>
                                        <th>
                                            Middle Name
                                        </th>
                                        <th>
                                            Last Name
                                        </th>
                                        <th>
                                            Contact No
                                        </th>
                                        <th>
                                            District
                                        </th>
                                        

                                    </tr>
                                        <?php 
                                        
                                        while($rows = $result->fetch_assoc()){

                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $rows['id'];?>
                                        </td>

                                        <td>
                                            <?php echo $rows['title'];?>
                                        </td>

                                        <td>
                                            <?php echo $rows['first_name'];?>
                                        </td>

                                        <td>
                                            <?php echo $rows['middle_name'];?>
                                        </td>

                                        <td>
                                            <?php echo $rows['last_name'];?>
                                        </td>

                                        <td>
                                            <?php echo $rows['contact_no'];?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $rows['district'];?>
                                        </td>

                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>










    <?php
    include '../inc/scripts/scripts.php';
    ?>
</body>

</html>