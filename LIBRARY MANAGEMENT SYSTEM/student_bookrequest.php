<?php
	session_start();
	$connect = mysqli_connect("localhost:3307", "root", "root", "library");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			REQUESTED BOOKS
		</title>
	  <link rel="stylesheet" type="text/css" href="style.css">
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<style type="text/css">
	  body {
	    background-image: url('images/FORALL.jpeg');
	    background-repeat: no-repeat;
	    background-attachment: fixed;
	    background-size: cover;
			font-family: "Lato", sans-serif;
			transition: background-color .5s;
	  }
		footer {
		  position: fixed;
		  left: 0;
		  bottom: 0;
		  width: 100%;
		  color: white;
		  text-align: center;
		}
	  .srch{
	    padding-left: 800px;
	  }
	  table, th, td {
	    border:1px solid black;
	  }
	  th {
	    padding: 25px;
	  }
	  td {
	    padding: 15px;
	  }
	  table {
	    border-spacing: 5px;
	  }
		.sidenav {
		  height: 100%;
		  width: 0;
		  position: fixed;
		  z-index: 1;
		  top: 0;
		  left: 0;
		  background-color: #5f4cd2a1;
		  overflow-x: hidden;
		  transition: 0.5s;
		  padding-top: 60px;
			margin-top: 110px;
		}
		.sidenav a {
		  padding: 8px 8px 8px 32px;
		  text-decoration: none;
		  font-size: 15px;
		  color: #FFFFFF;
		  display: block;
		  transition: 0.3s;
		}
		.sidenav a:hover {
		  color: #f1f1f1;
			background-color: #131315a1;
		}
		.sidenav .closebtn {
		  position: absolute;
		  top: 0;
		  right: 25px;
		  font-size: 36px;
		  margin-left: 50px;
		}
		#main {
		  transition: margin-left .5s;
		  padding: 16px;
		}
		@media screen and (max-height: 450px) {
		  .sidenav {padding-top: 15px;}
		  .sidenav a {font-size: 18px;}
		}
		</style>
	</head>
	<body text="#ffffff">
		<header>
			<div class="logo">
				<img src="images/logo.png">
			</div>
			<nav>
				<ul>
					<li><a href=""><div style="color: black">
						<?php
							echo "   Welcome-".$_SESSION['studentID']; ?> </div></a></li>
					<li><a href="student_welcome.php">HOME</a></li>
					<li><a href="student_feedback.php">FEEDBACK</a></li>
					<li><a href="logout.php">LOGOUT</a></li>
				</ul>
			</nav>
		</header>
		<div id="mySidenav" class="sidenav" >
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<a href="student_viewprofile.php">PROFILE</a>
			<a href="student_bookdetails.php">BOOKS</a>
			<a href="student_bookrequest.php">BOOKS REQUESTED</a>
			<a href="student_bookissue.php">ISSUE INFORMATION</a>
			<a href="student_finepay.php">FINES</a>
		</div>
		<div id="main">
			<span style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776; open</span>
			<script>
				function openNav() {
					document.getElementById("mySidenav").style.width = "250px";
					document.getElementById("main").style.marginLeft = "250px";
					document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
				}
				function closeNav() {
					document.getElementById("mySidenav").style.width = "0";
					document.getElementById("main").style.marginLeft= "0";
					document.body.style.backgroundColor = "white";
				}
			</script>
		</div>
	  <center>
	    <font face = "Wildwest" color= white size = "5">List of Books Requested</font><br /><br>
	    <?php
	    	if(isset($_SESSION['studentID']))
	      {
	        // we are merging 2 tables as we require the name of the book also
	        $q = mysqli_query($connect,"SELECT i.bid, b.Name, i.approve, i.issuedate, i.returndate FROM issue_book i, books b WHERE i.StudentID='$_SESSION[studentID]' and i.bid=b.bid and i.approve=''");
	        if(mysqli_num_rows($q) == 0)
	        {
	          echo " There is no pending Request";
	        }
	        else
	        {
	          echo "<table class='table table-bordered table-hover' border='1' style='width:80%' align='center' class='center'>";
		          echo "<tr align='center' style='background-color: #71899e73'>";
			          echo "<th>";  echo"Book ID"; echo "</th>";
			          echo "<th>";  echo"Book Name"; echo "</th>";
			          echo "<th>";  echo"Approve Status"; echo "</th>";
			          echo "<th>";  echo"Issue Date"; echo "</th>";
			          echo "<th>";  echo"Return Date"; echo "</th>";
		          echo "</tr>";
		          while($row = mysqli_fetch_assoc($q))
		          {
		            echo "<tr align='center' style='background-color: #40488440'>";
		            echo "<td>";  echo $row['bid'];  echo "</td>";
		            echo "<td>";  echo $row['Name'];  echo "</td>";
		            echo "<td>";  echo $row['approve'];  echo "</td>";
		            echo "<td>";  echo $row['issuedate'];  echo "</td>";
		            echo "<td>";  echo $row['returndate'];  echo "</td>";
		            echo "</tr>";
		          }
	          echo "</table>";
	        }
	      }
      ?>
    </center>
	  <footer>
	    <p style="color:white;  text-align: center; ">&copy; 2020 Online Library Management System | Designed With Love</p>
	  </footer>
	</body>
</html>
