<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="style.css">
  <style media="screen">


  </style>

  <title>Ex5 - PHP Page</title>
</head>
<body>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <!-- Brand -->
      <a class="navbar-brand" href="#">Logo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="#">
              Info Tech
            </a>
          </li>
          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown">
              Interests
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="intreIntro.html">Interest: Intro</a>
              <a class="dropdown-item" href="intreVideo.html">Interest: Video</a>
              <a class="dropdown-item" href="intreScreen.html">Interest: Screencast</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
        </ul>
      </div>
    </nav>
    <div>
      <?php
      // display in browser the value of $_POST associative array as initial test
      // use echo function and its parameter needs to be a string and use . operator to combine strings
  /*    echo ("HTML = " . $_POST['HTML']);
      echo ("<br>");
      echo ("CSS = " . $_POST['CSS']);
      echo ("<br>");
      echo ("PHP = " . $_POST['PHP']);
      echo ("<br>");
      echo ("JavaScript = " . $_POST['JavaScript']);
      echo ("<br>");
      echo ("MySQL = " . $_POST['MySQL']);
      echo ("<br>");
      echo ("ScreencastOMatic = " . $_POST['ScreencastOMatic']);
      echo ("<br>");
      echo ("Flickr = " . $_POST['Flickr']);
      echo ("<br>");
      echo ("Pixlr = " . $_POST['Pixlr']);
      echo ("<br>");
      echo ("GoogleDrive = " . $_POST['GoogleDrive']);
      echo ("<br>");
      echo ("Atom = " . $_POST['Atom']);
      echo ("<br>");
*/

      // use function displayPostArray to be able to display contents of $_POST
      // in a way that is flexible in terms of items stored in $_POST
      displayPostArray($_POST);

      // ADDED in Step 7

      // want to connect to MySQL database
      // first load into memory the database credentials defined in login file
      require_once 'login_Palmer.php'; // remember to change to your lastname
      // use database credentials to connect to MySQL
      $db_connect = mysqli_connect($db_hostname, $db_username, $db_password);
      // test if successful in connecting to MySQL
      if (!$db_connect) die("Unable to connect to MySQL: " . mysqli_error($db_connect));
      // test if successful in connecting to your database
      mysqli_select_db($db_connect, $db_database) or die("Unable to select database: " . mysqli_error($db_connect));

      //
      // test to make sure that each tool is non-empty ...
      // just to make sure in case JavaScript validation gets by passed
      if (isset($_POST['HTML']) &&
          isset($_POST['CSS']) &&
          isset($_POST['PHP']) &&
          isset($_POST['JavaScript']) &&
          isset($_POST['MySQL']) &&
          isset($_POST['ScreencastOMatic']) &&
          isset($_POST['Flickr']) &&
          isset($_POST['Pixlr']) &&
          isset($_POST['GoogleDrive']) &&
          isset($_POST['Atom'])
      	)
      {
      	// assign to variables after "cleansing" data by using function mysqli_fix_string (defined further down)
      	$tool1 = mysqli_fix_string($db_connect, $_POST['HTML']);
      	$tool2 = mysqli_fix_string($db_connect, $_POST['CSS']);
        $tool3 = mysqli_fix_string($db_connect, $_POST['PHP']);
        $tool4 = mysqli_fix_string($db_connect, $_POST['JavaScript']);
        $tool5 = mysqli_fix_string($db_connect, $_POST['MySQL']);
        $tool6 = mysqli_fix_string($db_connect, $_POST['ScreencastOMatic']);
        $tool7 = mysqli_fix_string($db_connect, $_POST['Flickr']);
        $tool8 = mysqli_fix_string($db_connect, $_POST['Pixlr']);
        $tool9 = mysqli_fix_string($db_connect, $_POST['GoogleDrive']);
        $tool10 = mysqli_fix_string($db_connect, $_POST['Atom']);
      	// create query for entering data in to MySQL table = tools
      	// need to specify which attributes we are providing since we don't provide all attributes
      	$query = "INSERT INTO tools (HTML, CSS, PHP, JavaScript, MySQL, ScreencastOMatic, Flickr, Pixlr, GoogleDrive, Atom) VALUES" .
              "('$tool1', '$tool2', '$tool3', '$tool4', '$tool5', '$tool6', '$tool7', '$tool8', '$tool9', '$tool10')";
      	// testing if successful inserting data in table
      	if (!mysqli_query($db_connect, $query))
                  echo "INSERT failed: $query<br>" .
                  mysqli_error($db_connect) . "<br><br>";
      }

      // ADDED in Step 8

      echo "Display contents of table = 'tools' <br><hr>";
      $query = "SELECT * FROM tools";
      $result = mysqli_query($db_connect, $query);
      if (!$result) die ("Database access failed: " . mysqli_error($db_connect));
      $rows = mysqli_num_rows($result);
      for ($j = 0 ; $j < $rows ; ++$j){
      	$row = mysqli_fetch_row($result);
      	// need to consult table to identify correct index for field
      	echo '  HTML: ' . $row[0] . '<br>';
        echo '  CSS: ' . $row[1] . '<br>';
        echo '  PHP: ' . $row[2] . '<br>';
        echo '  JavaScript: ' . $row[3] . '<br>';
        echo '  MySQL: ' . $row[4] . '<br>';
        echo '  ScreencastOMatic: ' . $row[5] . '<br>';
        echo '  Flickr: ' . $row[6] . '<br>';
        echo '  Pixlr: ' . $row[7] . '<br>';
        echo '  GoogleDrive: ' . $row[8] . '<br>';
      	echo '  Atom: ' . $row[9] . '<br><hr>';
      }

      // ADDED in Step 9

      echo "Display AVERAGE SCORES for table = 'tools'<br><hr>";
      // create query that returns SUM of scores for each tool
      $query = "SELECT SUM(HTML), SUM(CSS), SUM(PHP), SUM(JavaScript), SUM(MySQL), SUM(ScreencastOMatic), SUM(Flickr), SUM(Pixlr), SUM(GoogleDrive), SUM(Atom) FROM tools";
      // $result will return a single row of SUMs
      $result = mysqli_query($db_connect, $query);
      if (!$result) die ("Database access failed: " . mysqli_error($db_connect));
      // fetch first (and only row) and this will be regular array
      $firstrow = mysqli_fetch_row($result);
      // add div tag with class .results applied using \ to escape " quotation marks
      // Note: don't mix singe and double quotation marks
      echo '<div class=\'resultStyle\'>';
      // display SUM values and Average with is SUM / $rows (the latter computed further up)

      echo '<div id="border">';

      echo '<table class="table table-striped">';
      echo '<tr><td>' . '  <div id="result">HTML</div>: AVE = <div id="result">' . number_format($firstrow[0] / $rows, 2) . '</div></td></tr>';
      echo '<tr><td>' . '  <div id="result">CSS</div>: AVE = <div id="result">' . number_format($firstrow[1] / $rows, 2) . '</div></td></tr>';
      echo '<tr><td>' . '  <div id="result">PHP</div>: AVE = <div id="result">' . number_format($firstrow[2] / $rows, 2) . '</div><br>';
      echo '<tr><td>' . '  <div id="result">JavaScript</div>: AVE = <div id="result">' . number_format($firstrow[3] / $rows, 2) . '</div></td></tr>';
      echo '<tr><td>' . '  <div id="result">MySQL</div>: AVE = <div id="result">' . number_format($firstrow[4] / $rows, 2) . '</div></td></tr>';
      echo '<tr><td>' . '  <div id="result">ScreencastOMatic</div>: AVE = <div id="result">' . number_format($firstrow[5] / $rows, 2) . '</div></td></tr>';
      echo '<tr><td>' . '  <div id="result">Flickr</div>: AVE = <div id="result">' . number_format($firstrow[6] / $rows, 2) . '</div></td></tr>';
      echo '<tr><td>' . '  <div id="result">Pixlr</div>: AVE = <div id="result">' . number_format($firstrow[7] / $rows, 2) . '</div></td></tr>';
      echo '<tr><td>' . '  <div id="result">GoogleDrive</div>: AVE = <div id="result">' . number_format($firstrow[8] / $rows, 2) . '</div></td></tr>';
      echo '<tr><td>' . '  <div id="result">Atom</div>: AVE = <div id="result">' . number_format($firstrow[9] / $rows, 2) . '</div></td></tr><hr>';
      // add closing div tag
      echo '</table>';

      echo '</div>'; //border
      echo '</div>'; //result style

      // define functions ... it is okay that they are defined after they are being called
      //
      function displayPostArray ($postarray) {
        // echo ("displayPostArray.<br>");

        // want to loop through each item of associative array
        // Use of => is similar to the regular = assignment operator,
        // except that you are assigning a value to an index and not to a variable.
        // "as" is used to assign a specific element of array to variable $tool
        // and => is used to assign value associated with $tool to the variable $score
        foreach ($postarray as $tool => $score)
        {
          echo "$tool" . " = " . "$score<br>";
        }
        //
      }

      // create function to make sure date sent to database is safe
      // passes each retrieved item through the mysqli_real_escape_string function to strip out any characters
      // that a hacker may have inserted in order to break into or alter your database
      function mysqli_fix_string($db_connect, $string)
      {
          if (get_magic_quotes_gpc()) $string = stripslashes($string);
          return mysqli_real_escape_string($db_connect, $string);
      }
      ?>
    </div>
  </div>
</body>
</html>
