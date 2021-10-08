<?php include('server.php') ?>
<?php 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: adminindex.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: adminlogin.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    .inputas
    {
      height: 25px;
      width: 50px;
      padding: 0 0 0 0;
      font-size: 13px;
      border-radius: 5px;
      border: 1px solid gray;
        }
    .container{
      text-align: center;
    }
    .button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 15px 40px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 15px;
      cursor: pointer;
      outline: none;
    }
    .button:hover
    {
      background-color: rgb(76, 159, 80);
    }
    .button:active
    {
      background-color: rgb(76, 147, 80);
      transform: translateY(2px);
    }
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 70%;
      font-size: 16px;
      margin-left: auto;
      margin-right: auto;
    }

    td, th {
      border: 1px solid black;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: white;
    }
    label
    {
      font-family: arial;
      font-size: 16px;
    }
  </style>
  <title>Summons Check</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="headeradmin">
  <h2>Summons check</h2>
</div>
<div class="content" style="text-align: center;">
    
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <p><strong>WELCOME <?php echo $_SESSION['fullname']; ?></strong></p>
      <br>
      <p style="font-size: 20px; text-align: right;"> <a href="adminindex.php?logout='1'" style="color: red;">Logout</a> </p>
    <?php endif ?>
    <br><hr>
<div class="container">
  <button class="button" onclick="location.href = 'adminindex.php'">Back</button>
  </div>
  <br>

  <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

<table>
  <tr>
    <td><strong>Student ID</strong></td>
    <td><?php echo $_SESSION["studentid"] ?></td>
  </tr>
  <tr>
    <td><strong>Student IC</strong></td>
    <td><?php echo $_SESSION["studentic"] ?></td>
  </tr>
  <tr>
    <td><strong>Student Name</strong></td>
    <td><?php echo $_SESSION["studentName"] ?></td>
  </tr>
  <tr>
    <td><strong>Student Program</strong></td>
    <td><?php echo $_SESSION["studentProgram"] ?></td>
  </tr>
</table>
<br>

    <?php include('errors.php'); ?>
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>
<br>
<p style="font-size: 20px; text-align: center;"><?php echo $_SESSION["studentName"] ?>'s Summon(s)</p><br>

<table>
  

<?php


        $studentid = $_SESSION["studentid"];
        $sql = "SELECT * FROM summon WHERE studentid='$studentid'";
        $result = $db->query($sql);
        
        if ($result->num_rows > 0) {
          echo"<tr>
            <th>Serial Number</th>
            <th>Offense ID</th>
            <th>Offense Type</th>
            <th>Date</th>
            <th>Location</th>
            <th style='column-width: 105spx;'>Status</th>
          </tr>";
            // output data of each row
        while($row = $result->fetch_assoc()) {
          $offenseidtemp = $row["offenseid"];
          $sql1 = "SELECT typeOfOffense FROM offense WHERE offenseid='$offenseidtemp'";
          $result1 = $db->query($sql1);
          $row1 = $result1->fetch_assoc();

        echo "
          <tr>
          <td>" . $row["serialnum"] ."</td>
          <td>" . $row["offenseid"] ."</td>
          <td>" . $row1["typeOfOffense"] . "</td>
          <td>" . $row["dateissue"] ."</td>
          <td>" . $row["location"] ."</td>";

            if ($row["paid"] == 'No')
            {
                echo "
                <form action='adminupdate.php' method='post'>
                  <td style='color:red;'><i>" . $row["paid"] . "<i>

                
                  <input style='opacity: 0%; width:0px;' type='radio' name='serialnum' value='" . $row["serialnum"] . "' checked></input>
                  <input style='outline: none;' type='submit' class='inputas' name='update_submit' value='Paid'>
                </form>

                  </td>
                </tr>";
            }
            else
            {
                echo "<td style='color:rgb(0, 190, 0);'><i>" . $row["paid"] . "<i></td>
                </tr>";
            }
        }
      } else {
         echo "<br><i style='font-size:19px;'>This student has no summons</i>";
      }


?>

</table>


<br><br>


</div>
    
</body>
</html>