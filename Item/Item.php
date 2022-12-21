<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include '../inc/header/header.php';
    include '../config.php';

    ?>
    <link rel="stylesheet" href="style.css">

    <title>Item</title>
</head>

<body>
    <section class="side-navbar">

        <?php include '../inc/nav/nav.php' ?>

        <div class="container-fluid content-body">
            <div class="row">
                <div class="page-content-header">

                    <h1 class="Page-Title pop">Item</h1>
                    <hr class="Page-Title-hr">

                    <?php
                    // define variables and set to empty values
                    $item_code_err =  $item_name_err =  $quantity_err = $unit_price_err = $item_cat_err = $item_sub_cat_err = '';
                    $item_code = $item_name = $item_cat = $item_sub_cat = $quantity = $unit_price ='';
                    $item_code_bol = $item_name_bol = $item_cat_bol = $item_sub_cat_bol = $quantity_bol = $unit_price_bol = '';

                     // Validating Form Submitted Data
                    if (isset($_POST['submit_button'])) {

                        //Item Code Validation
                        if (empty($_POST["item_code"])) {
                            $item_code_err = "Item Code is required";
                            echo '<div class="alert alert-danger" role="alert">' . $item_code_err . '</div>';
                            echo '<br>';
                            $item_code_bol = false;
                        } else {
                            $item_code = validation($_POST["item_code"]);
                            $item_code_bol = true;
                            if(!preg_match("/^[A-Z0-9]*$/",$item_code)){
                                $item_code_err = "Item Code - Only Capital Letters and Numbers allowed";
                                echo '<div class="alert alert-danger" role="alert">' . $item_code_err . '</div>';
                                echo '<br>';
                                $item_code_bol = false;
                            }
                        }

                        //Item Name Validation
                        if (empty($_POST["item_name"])) {
                            $item_name_err = "Item Name is required";
                            echo '<div class="alert alert-danger" role="alert">' . $item_name_err . '</div>';
                            echo '<br>';
                            $item_name_bol = false;
                        } else {
                            $item_name = validation($_POST["item_name"]);
                            $item_name_bol = true;

                            // check if Item  Name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z0-9-' ]*$/", $item_name)) {
                                $item_name_err = "Item Name - Only letters , numbers and white space allowed";
                                echo '<div class="alert alert-danger" role="alert">' . $item_name_err . '</div>';
                                echo '<br>';
                                $item_name_bol = false;

                            }
                        }


                        //Item Category Validation
                        if (empty($_POST["item_category"])) {
                            $item_cat_err = "Item Category is required";
                            echo '<div class="alert alert-danger" role="alert">' . $item_cat_err . '</div>';
                            echo '<br>';
                            $item_cat_bol = false;
                        } else {
                            $item_cat = validation($_POST["item_category"]);
                            $item_cat_bol = true;
                        }

                         //Item Sub Category Validation
                         if (empty($_POST["item_sub_category"])) {
                            $item_sub_cat_err = "Item Category is required";
                            echo '<div class="alert alert-danger" role="alert">' . $item_sub_cat_err . '</div>';
                            echo '<br>';
                            $item_sub_cat_bol = false;
                        } else {
                            $item_sub_cat = validation($_POST["item_sub_category"]);
                            $item_sub_cat_bol = true;
                        }


                        //Item Quantity Validation
                        if (empty($_POST["item_quantity"])) {
                            $quantity_err = "Quantity is required";
                            echo '<div class="alert alert-danger" role="alert">' . $quantity_err . '</div>';
                            echo '<br>';
                            $quantity_bol = false;
                        } else {
                            $quantity = validation($_POST["item_quantity"]);
                            $quantity_bol = true;

                            //check if quantity is valid 
                            if (!preg_match('/^[0-9]*$/', $quantity)) {
                                $quantity_err = "Quantity - Only Numbers allowed";
                                echo '<div class="alert alert-danger" role="alert">' . $quantity_err . '</div>';
                                echo '<br>';
                                $quantity_bol = false;

                            }
                        }


                        //Item unit Price Validation
                        if (empty($_POST["item_unit_price"])) {
                            $unit_price_err = "Unit Price is required";
                            echo '<div class="alert alert-danger" role="alert">' . $unit_price_err . '</div>';
                            echo '<br>';
                            $unit_price_bol = false;
                        } else {
                            $unit_price = validation($_POST["item_unit_price"]);
                            $unit_price_bol = true;

                            //check if quantity is valid 
                            if (!preg_match('/^[0-9].*$/', $unit_price)) {
                                $quantity_err = "Unit Price - Only Numbers and (.) Dot allowed";
                                echo '<div class="alert alert-danger" role="alert">' . $quantity_err . '</div>';
                                echo '<br>';
                                $quantity_bol = false;
                            }
                        }

                        header("Refresh: 5");
                    }

                    function validation($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    // Inserting Data into Database 
                    if ($item_code_bol === true &&  $item_name_bol === true && $item_cat_bol === true && $item_sub_cat_bol === true && $quantity_bol === true && $unit_price_bol === true ) {
                        $query = "INSERT INTO item(item_code,item_category,item_subcategory,item_name,quantity,unit_price) VALUES ('$item_code','$item_cat','$item_sub_cat','$item_name','$quantity','$unit_price')";
                        if ($connect->query($query) === TRUE) {
                            echo '<div class="alert alert-success" role="alert"> Form Successfully Submitted. New Item created Successfully.  </div>';
                            header("Refresh: 3");
                        } else {
                            echo '<div class="alert alert-danger" role="alert"> Form Submission Faild. Please Retry.  </div>' . $query . "<br>" . $connect->error;
                            mysqli_close($connect);
                            header("Refresh: 3");
                        }
                    }
                    ?>
                    <div class="item-flex-content">

                        <!-- Card start from here  -->
                        <div class="card item">
                            <div class="card-body item">
                                <!-- Form start From here  -->
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="form-group">
                                        <label class="form-label me-1 mb-0">Item Code</label>
                                        <input type="text" class="input-class" name="item_code">
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="form-label me-1 mb-0">Item Name</label>
                                        <input type="text" class="input-class" name="item_name">
                                    </div>

                                    <hr>

                
                                    <div class="form-group">
                                        <label class="form-label  me-1 mb-0">Item Category</label>
                                        <select class="form-select" name="item_category">
                                            <?php
                                            $cselect = "SELECT id, category FROM item_category";
                                            $cresult = mysqli_query($connect , $cselect);

                                            while($result = mysqli_fetch_assoc($cresult)){

                                                echo "<option value=\"{$result['id']}\">{$result['category']}</option>";

                                            }
                                            
                                            ?>
                                        
                                        </select>
                                    </div>
                                            <hr>

                                    <div class="form-group">
                                        <label class="form-label  me-1 mb-0">Item Sub Category</label>
                                        <select class="form-select" name="item_sub_category">
                                            <?php
                                            $dselect = "SELECT id, sub_category FROM item_subcategory";
                                            $dresult = mysqli_query($connect , $dselect);

                                            while($result = mysqli_fetch_assoc($dresult)){

                                                echo "<option value=\"{$result['id']}\">{$result['sub_category']}</option>";

                                            }
                                            
                                            ?>
                                        
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="form-label cn me-1 mb-0">Quantity</label>
                                        <input type="tel" name="item_quantity" class="input-class cn">
                                    </div>

                                    <hr>        

                                    <div class="form-group">
                                        <label class="form-label cn me-1 mb-0">Unit Price</label>
                                        <input type="tel" name="item_unit_price" class="input-class cn">
                                    </div>


                                    <hr>
                                    <input type="submit" name="submit_button" value="Register Item" class="btn mt-4 submit-btn">
                                </form>
                                <!-- form ends from here  -->

                            </div>
                        </div>

                        <!-- Card start from here  -->
                        <div class="card itemt">
                            <div class="card-body itemt">
                                <?php
                                // SQL query to select data from database
                                $select = "SELECT * FROM item";
                                $result = $connect->query($select);
                                $connect->close();
                                ?>
                                <table class="table">
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Item Code
                                        </th>
                                        <th>
                                            Item Category
                                        </th>
                                        <th>
                                            Item Subcategory
                                        </th>
                                        <th>
                                            Item Name
                                        </th>
                                        <th>
                                            Quantity
                                        </th>
                                        <th>
                                            Unit Price
                                        </th>


                                    </tr>
                                    <?php

                                    while ($rows = $result->fetch_assoc()) {

                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $rows['id']; ?>
                                            </td>

                                            <td>
                                                <?php echo $rows['item_code']; ?>
                                            </td>

                                            <td>
                                                <?php echo $rows['item_category']; ?>
                                            </td>

                                            <td>
                                                <?php echo $rows['item_subcategory']; ?>
                                            </td>

                                            <td>
                                                <?php echo $rows['item_name']; ?>
                                            </td>

                                            <td>
                                                <?php echo $rows['quantity']; ?>
                                            </td>

                                            <td>
                                                <?php echo $rows['unit_price']; ?>
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