<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'db2');


// LOGIN STUDENT
    if (isset($_POST['login_user'])) {
      $matric = mysqli_real_escape_string($db, $_POST['matric']);
      $ic = mysqli_real_escape_string($db, $_POST['ic']);

      if (empty($matric)) {
        array_push($errors, "Student ID is required");
      }
      if (empty($ic)) {
        array_push($errors, "Student IC is required");
      }

      if (count($errors) == 0) {
        //$password = md5($password);
        $query = "SELECT * FROM student WHERE studentid='$matric' AND studentic='$ic'";
        $results = mysqli_query($db, $query);

        $sql1 = "SELECT * FROM student WHERE studentid='$matric'";
        $result1 = $db->query($sql1);

          if (mysqli_num_rows($results) == 1) {
          $row = mysqli_fetch_assoc($result1);
          $_SESSION['studentName'] = $row["studentName"];
          $_SESSION['studentProgram'] = $row["studentProgram"];
          $_SESSION['studentid'] = $row["studentid"];
          $_SESSION['studentic'] = $row["studentic"];
          $_SESSION['success'] = "Successfully Login";
          header('location: index.php');
          } else {
          array_push($errors, "Wrong Student ID/Student IC combination");
          }
        }
      }


    // LOGIN ADMIN
    if (isset($_POST['login_admin'])) {
      $username = mysqli_real_escape_string($db, $_POST['username']);
      $password = mysqli_real_escape_string($db, $_POST['password']);

      if (empty($username)) {
        array_push($errors, "Username is required");
      }
      if (empty($password)) {
        array_push($errors, "Password is required");
      }

      if (count($errors) == 0) {
        //$password = md5($password);
        $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);

        $sql1 = "SELECT * FROM admin WHERE username='$username'";
        $result1 = $db->query($sql1);
          if (mysqli_num_rows($results) == 1) {
          $row = mysqli_fetch_assoc($result1);
          $_SESSION['username'] = $username;
          $_SESSION['fullname'] = $row["fullname"];
          $_SESSION['success'] = "Successfully Login";
          header('location: adminindex.php');
          } else {
          array_push($errors, "Wrong username/password combination");
          }
        }
      }


      // Search Student
    if (isset($_POST['search_id'])) {
      $type = "";
      $studentid = mysqli_real_escape_string($db, $_POST['studentid']);
      $type = mysqli_real_escape_string($db, @$_POST['type']);

      if (empty($studentid)) {
        array_push($errors, "Student ID is required");
      }
      if (empty($type)) {
        array_push($errors, "Please select insert/update");
      }

      $query = "SELECT * FROM student WHERE studentid='$studentid'";
      $results = mysqli_query($db, $query);
      $user = mysqli_fetch_assoc($results);


      if(!$user && $studentid != "")
      {
        array_push($errors, "Student ID doesn't exist");
      }

      if (count($errors) == 0) {
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['studentName'] = $user["studentName"];
          $_SESSION['studentProgram'] = $user["studentProgram"];
          $_SESSION['studentid'] = $user["studentid"];
          $_SESSION['studentic'] = $user["studentic"];
        }

        if ($type == 'insert'){ header('location: admininsert.php');}
        else {  header('location: adminupdate.php');}

      }
    }


    // Insert summon
    if (isset($_POST['submit_summon'])) {
      $serialnum = mysqli_real_escape_string($db, $_POST['serialnum']);
      $offenseid = mysqli_real_escape_string($db, $_POST['offenseid']);
      $dateissue = mysqli_real_escape_string($db, $_POST['dateissue']);
      $location = mysqli_real_escape_string($db, $_POST['location']);
      $paid = mysqli_real_escape_string($db, $_POST['paid']);

      if (empty($serialnum) || empty($offenseid) || empty($dateissue) || empty($location)) 
      { array_push($errors, "Every section is required"); }

      $studentidtemp = $_SESSION['studentid'];

      if (count($errors) == 0) {
        $query = "INSERT INTO summon (serialnum,dateissue,location,offenseid,studentid,paid) VALUES ('$serialnum', '$dateissue', '$location', '$offenseid', '$studentidtemp','No')";
        mysqli_query($db, $query);
        $_SESSION['success'] = "Success!<br>Serial Number : $serialnum";
      }
    }


      // Update paid
      if (isset($_POST['update_submit'])) {
        $serialnum = mysqli_real_escape_string($db, $_POST['serialnum']);

        $query = "UPDATE summon SET paid='Paid' WHERE serialnum = '$serialnum'";
        mysqli_query($db, $query);
        header('location: adminupdate.php');
      }

      // Serial Number To PDF
      if (isset($_POST['to_pdf'])) {
        $serialnum = mysqli_real_escape_string($db, $_POST['serialnum']);

        $query = "SELECT * FROM summon WHERE serialnum = '$serialnum'";
        mysqli_query($db, $query);

        $result1 = $db->query($query);
        $row = mysqli_fetch_assoc($result1);

        $_SESSION['serialnum'] = $serialnum;
        $_SESSION['dateissue'] = $row["dateissue"];
        $_SESSION['location'] = $row["location"];
        $_SESSION['offenseid'] = $row["offenseid"];
        $_SESSION['paid'] = $row["paid"];

        header('location: summon.php');
      }




?>