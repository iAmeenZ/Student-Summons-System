<?php include('server.php') ?>
<?php 
  if (!isset($_SESSION['studentid'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: first.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['studentid']);
    header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 70%;
      font-size: 16px;
      margin-left: auto;
      margin-right: auto;
    }
    .adam {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 70%;
      font-size: 13px;
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
    .buton
    {
      border: 0px solid black;
      background-color: transparent;
      width: 0px;
      height: 0px;
    }
    .buton:hover
    {
        cursor: pointer;
    }
  </style>
  <title>Summons Check</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
  <h2>Summons check</h2>
</div>
<div class="content" style="text-align: center;">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success">
        <h3 style="font-family: arial;">
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>


    <!-- logged in user information -->
    <?php  if (isset($_SESSION['studentid'])) : ?>
      <h3><strong>WELCOME <?php echo $_SESSION['studentName']; ?></strong></h3>
      <p style="font-size: 20px; text-align: right;"> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
    <?php endif ?>
    <br><hr><br>

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
    <br><br>
    <p style="font-size: 20px; text-align: center;">My Summon(s)</p><br>
<div>
<table class="table table-bordered table-striped">
  

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
          <td>
          <form action='summon.php' method='POST'>
            <input style='opacity: 0%; width:0px; margin:-50px -5px -5px -5px;' type='radio' name='serialnum' value='" . $row["serialnum"] . "' checked></input>
            <button style='color:blue; outline: none; display:center; margin:-50px -50px -10px -10px;' type='submit' class='buton' name='to_pdf'>" . $row["serialnum"] ."</button>
          </form>
          </td>
          <td>" . $row["offenseid"] ."</td>
          <td>" . $row1["typeOfOffense"] . "</td>
          <td>" . $row["dateissue"] ."</td>
          <td>" . $row["location"] ."</td>";

            if ($row["paid"] == 'No')
            {
                echo "
                  <td style='color:red;'><i>" . $row["paid"] . "<i>
                  </td>
                </tr>";
            }
            else
            {
                echo "
                  <td style='color:rgb(0, 190, 0);'><i>" . $row["paid"] . "<i></td>
                </tr>";
            }
        }
      } else {
         echo "<br><i style='font-size:19px;'>No summons</i>";
      }


?>

</table>



<br>
</div>
    
</body>
</html>