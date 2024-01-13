<?php

        $connection = mysqli_connect("localhost", "root", "", "2ndmech");

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_POST['submit'])) {

        
            $image = file_get_contents($_FILES["image"]["tmp_name"]);
            $image = mysqli_real_escape_string($connection, $image);

            if ($_FILES['image']['error'] > 0) {
                die('Upload Error: ' . $_FILES['image']['error']);
            }

            $image = file_get_contents($_FILES["image"]["tmp_name"]);
            
            if ($image === false) {
                die('Error reading image file');
            }

            $name = $_POST['name'];
            $fName = $_POST['fName'];
            $mName = $_POST['mName'];
            $DOB = $_POST['DOB'];
            $aadharNo = $_POST['aadharNo'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $fphone = $_POST['fphone'];
            $address = $_POST['address'];
            $umis = $_POST['umis'];
            $emis = $_POST['emis'];
            $allotmentOrder = $_POST['allotmentOrder'];
            $accNo = $_POST['accNo'];
            $bloodgroub = $_POST['bloodgroub'];
            $registernumber = $_POST['registernumber'];


            $sql = "INSERT INTO class (image, name, fName, mName, DOB, aadharNo, email, phone, fphone, address, umis, emis, allotmentOrder, accNo, bloodgroub, registernumber) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($connection, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $image, $name, $fName, $mName, $DOB, $aadharNo, $email, $phone, $fphone, $address, $umis, $emis, $allotmentOrder, $accNo, $bloodgroub, $registernumber);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<script>location.replace("index.php")</script>';
                } else {
                    echo "Something went wrong: " . mysqli_stmt_error($stmt);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Statement preparation failed: " . mysqli_error($connection);
            }
        }

        mysqli_close($connection);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student Registration Form </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="registration-container">
        <h2> Registration Form:-</h2>
        <section class="details-section">
            <form  class="registration-form" method="POST"  enctype="multipart/form-data" autocomplete="off">
                <h4> Personal Details </h4>
                <section class="top-section">
                    <section class="personal-details">
                        <div class="three-details-item">
                            <label for="name">
                                <p>Full Name</p>
                                <input type="text" name="name" id="name" placeholder="Enter your name" >
                            </label>
                            <label for="fName">
                                <p> Father Name </p>
                                <input type="text" name="fName" id="fName" placeholder="Enter father name" >
                            </label>
                            <label for="mName">
                                <p>Mother Name</p>
                                <input type="text" name="mName" id="mName" placeholder="Enter mother name" >
                            </label>
                        </div>
    
                        <div class="three-details-item">
                            <label for="DOB">
                                <p>Date of Birth <span>Ex:(08-12-2003)</span></p>
                                <input type="text" name="DOB" id="DOB" placeholder="Enter your DOB" >
                            </label>
                            <label for="aadharNo">
                                <p>Aadhar Card </p>
                                <input type="text" name="aadharNo" id="aadharNo" oninput="formatAccountNumber()" maxlength="16" placeholder="Enter aadhar number" >
                            </label>
                            <label for="email">
                                <p>E-mail</p>
                                <input type="email" name="email" id="email" placeholder="Enter your e-mail" >
                            </label>
                        </div>
                        
                        <div class="three-details-item">
                            <label for="ph">
                                <p> Mobile Number</p>
                                <input type="number" name="phone" id="ph" placeholder="Enter your mobile number" >
                            </label>
    
                            <label for="fphone">
                                <p> Father Number</p>
                                <input type="number" name="fphone" id="fph" placeholder="Enter Father mobile number" >
                            </label>
    
                            <label for="address">
                                <p> Address </p>
                                <textarea name="address" id="address" cols="46" rows="3" placeholder="Enter your Address" ></textarea>
                            </label>
                        </div>
                    </section>
                    
                    <section class="img-details">
                        <img id="img" src="tp.png" alt="">
                        <input type="file" name="image" id="input" accept="image/*" onchange="checkFileSize()">
                    </section>
                </section>
                
                <hr>
               
                <h4> Other Details &nbsp; </h4>
                <div class="bottom-section">
                    <section class="identity-details">
                        <div class="three-details-item">
                            <label for="umis">
                                <p> UMIS ID </p>
                                <input type="number" name="umis" id="umis" placeholder="Enter your umis ID">
                            </label>
                            <label for="emis">
                                <p> EMIS ID </p>
                                <input type="number" name="emis" id="emis" placeholder="Enter your emis ID">
                            </label>
                            <label for="allotmentOrder">
                                <p> Allotment Order </p>
                                <input type="text" name="allotmentOrder" id="allotmentOrder"
                                    placeholder="Enter Allotment Order">
                            </label>
                        </div>
                        <div class="three-details-item">
                            <label for="accNo">
                                <p> Account Number </p>
                                <input type="number" name="accNo" id="accNo" placeholder="Enter account number">
                            </label>
                            <label for="religion">
                                <p> Blood Groub </p>
                                <select id="bloodgroub" name="bloodgroub" style="outline: none;width: 300px;height: 35px;font-size: 0.9rem;border-radius: 0.3rem;border: 1px solid rgb(143, 145, 145);padding: 0.2rem;background-color: rgb(243, 244, 245);" >
                                    <option value="">Choose One</option>
                                    <option value="A+ve">A+ve</option>
                                    <option value="B+ve">B+ve</option>
                                    <option value="AB+ve">AB+ve</option>
                                    <option value="A-ve">A-ve</option>
                                    <option value="B-ve">B-ve</option>
                                    <option value="O+ve">O+ve</option>
                                    <option value="O-ve">O-ve</option>
                                </select>
                               <!-- <input type="text" name="bloodgroub" id="bloodgroub" placeholder="Enter your bloodgroub"> -->
                            </label>
                            <label for="registernumber">
                                <p> Register Number </p>
                                <input type="number" name="registernumber" id="registernumber" placeholder="Enter your registernumber">
                            </label>
                        </div>
                    </section>
                    <button class="submit-btn" type="submit" value="upload" name="submit">Save</button>
                    <a class="open-link" href="view.php">open link</a>
                </div>
            </form>
        </section>
    </section>

    <script>
  

        const image = document.querySelector("#img");
        const input = document.querySelector("#input");

            input.addEventListener("change", () => {
            image.src = URL.createObjectURL(input.files[0]);
            });
        
            function checkFileSize() {
            var fileInput = document.getElementById('input');

            if (fileInput && fileInput.files && fileInput.files.length > 0) {
                var fileSize = fileInput.files[0].size;
                var fileSizeInKB = fileSize / 1024;

                if (fileSizeInKB > 150) {
                    alert('File size should be 150KB or less. Please choose a smaller file.');
                    fileInput.value = ''; 
                } else {
                    alert('Image upload successful');
                }
            } else {
                alert('Please select a file before uploading.');
            }
        }

        function formatAccountNumber() {
            let input = document.getElementById('aadharNo');
            let value = input.value.replace(/\s/g, ''); 
            let formattedValue = '';

            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                formattedValue += ' '; 
                }
                formattedValue += value[i];
            }

            input.value = formattedValue;
            }
                
    
    </script>
   
</body>

</html>