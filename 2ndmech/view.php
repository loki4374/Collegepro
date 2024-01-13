<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=1024">
  <title>Student Details</title>
  <link rel="stylesheet" href="view.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  <section class="registration-container" style="display:flex;  justify-content: space-between;">
    <h2><i class="fa-solid fa-user"></i>&nbsp;STUDENT DETAILS </h2>
    <marquee behavior="smooth" direction="left" width="600px" > All details are recorded based on student consent... &nbsp;Design By Mechanical Department... <img src="mechanical.png" width="30px"alt=""></marquee>
    <div class="sidebar-right">
      <input type="text" id="find" placeholder="Search here...." onkeyup="search()">

   
      

      <img class="dark-logo" src="moon.png" alt="moon-img" id="icon" style=" width: 30px;height:30px;
      cursor: pointer;  border-radius:13px ;">
    </div>
     
  </section> 

  <?php
    $connection = mysqli_connect("localhost", "root", "", "2ndmech");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $db = mysqli_select_db($connection, "2ndmech");

    $sql = "SELECT * FROM class";
    $run = mysqli_query($connection, $sql);
    $id = 1;

    while ($row = mysqli_fetch_array($run)) {
        $name = $row['name'];
        $fName = $row['fName'];
        $mName = $row['mName'];
        $DOB = $row['DOB'];
        $aadharNo = $row['aadharNo'];
        $email = $row['email'];
        $phone = $row['phone'];
        $fphone = $row['fphone'];
        $address = $row['address'];
        $umis = $row['umis'];
        $emis = $row['emis'];
        $allotmentOrder = $row['allotmentOrder'];
        $accNo = $row['accNo'];
        $bloodgroub = $row['bloodgroub'];
        $registernumber = $row['registernumber'];
    ?>

    <div class="main">
      <section class="profile-container">
        <form class="registration-form">
          <div class="image-section">
            <img class="tp-img" src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" alt="User Image">
            <h4><?= $row['name'] ?></h4><br>
            <p>BE-Mechanical Engineering</p><br>
            <h3><?= $row['registernumber'] ?></h3><br>
            <h3><img class="blood-img" src="blood.png" alt="" width="20px" height="25px">&nbsp;<?= $row['bloodgroub'] ?></h3>
           
          </div>
          <hr>

          <div class="personal-section">
            <div class="label-tag">
              <label for="">Father Name</label><br>
              <label for="">Mother Name</label><br>
              <label for="">Mobile Number</label><br>
              <label for="">Father Number</label><br>
              <label for="">Email-ID</label><br>
              <label for="">Date Of Birth</label><br>
              <label for="">Card Number</label><br>
              <label for="">Allotment Order</label><br>
            </div>
            <div class="value-tag">
              <label><?= $row['fName'] ?></label><br>
              <label><?= $row['mName'] ?></label><br>
              <label><?= $row['phone'] ?></label><br>
              <label><?= $row['fphone'] ?></label><br>
              <label><?= $row['email'] ?></label><br>
              <label><?= $row['DOB'] ?></label><br>
              <label><?= $row['aadharNo'] ?></label><br>
              <label><?= $row['allotmentOrder'] ?></label><br>
            </div>
          </div>
          <hr>
          
          <div class="other-section">
            <div class="tag">
              <label for="">Account No</label>
              <label for="">UMIS</label>
              <label for="">EMIS</label>
              <label for="">Address:</label>
            </div>
            <div class="tag-2">
              <label><?= $row['accNo'] ?></label>
              <label><?= $row['umis'] ?></label>
              <label><?= $row['emis'] ?></label>
              <label><?= $row['address'] ?></label>
            </div><br>
            <a  class="delbtn " href="del.php?del=<?php echo $id ?>">Remove</a> 
            </div>
          </div>
          
        </form>
      </section>
    </div>

    <?php
      $id++;
    }
    mysqli_close($connection);
    ?>

    <script>
         var icon = document.getElementById("icon");

            icon.onclick = function(){
            document.body.classList.toggle("dark-theme");
            if(document.body.classList.contains("dark-theme")){
                icon.src = "sun.png";
            }else{
                icon.src = "moon.png";
            }
          }

          function search() {
    let filter = document.getElementById('find').value.toUpperCase();
    let items = document.querySelectorAll('.profile-container');
    
    for (let i = 0; i < items.length; i++) {
        let h4 = items[i].getElementsByTagName('h4')[0];
        let value = h4.innerHTML || h4.innerText || h4.textContent;

        if (value.toUpperCase().indexOf(filter) > -1) {
            items[i].style.display = "";
        } else {
            items[i].style.display = "none";
        }
    }
}

    </script>
    
</body>
</html>
