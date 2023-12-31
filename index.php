<!DOCTYPE html>
<html lang="en">
  <head>
    <title>NFL Teams | ACME Sports</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="See the latest NFL teams list. Get the best NFL football team coverage at ACME Sports.">
    <meta name="robots" content="index, follow">

    <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" >
      (function ($) {
        $(document).ready(function(){
          new DataTable('table.table', {
          info: false,
          searching: false,
          paging: false
});
        });
      })(jQuery);
	  </script>
  </head>
  <body style="background-image: url('./images/nfl-main.png');background-size: 217px;background-color: #ecf2f7 !important;">
    <div class="container py-3" style="background: #fff;">
      <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
          <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="./images/logo.png" alt="ACME Sports Logo" width="186" height="112"/>
          </a>
    
        </div>
    
        <div class="p-3 pb-md-4 mx-auto text-center">
          <h1 class="display-4 fw-normal">NFL Teams</h1>
        </div>
      </header>
    
      <main>
        <?php

        $json_data = file_get_contents("http://delivery.chalk247.com/team_list/NFL.JSON?api_key=74db8efa2a6db279393b433d97c2bc843f8e32b0");
        $nfl_teams = json_decode($json_data, true);

        if(!empty($nfl_teams)){
          // Group teams by conference and division
          $teamsByConferenceAndDivision = array();
  
          foreach ($nfl_teams['results']['data']['team'] as $team) {
              $conference = $team['conference'];
              $division = $team['division'];
  
              $teamsByConferenceAndDivision[$conference][$division][] = $team;
          }
  
          // Display the team data as tables under corresponding division and conference
          foreach ($teamsByConferenceAndDivision as $conference => $divisions) {
              echo "<h3 class='mt-5'>$conference</h3>";
  
              foreach ($divisions as $division => $teams) {
                  echo "<div class='table-responsive'>";
                  echo "<h5 class='mt-3 text-uppercase'>$division</h5>";
                  echo "<table id='teams' class='table table-hover align-middle'>";
                  echo "<thead class= 'table-primary'>";
                  echo "<tr>";
                  echo "<th>Team</th>";
                  echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";
                  foreach ($teams as $team) {
                      echo "<tr>";
                      echo "<td>" .$team['display_name']. ' ' .$team['nickname'] . "</td>";
                      echo "</tr>";
                  }
                  echo "</tbody>";
                  echo "</table>";
                  echo "</div>";
              }
          }
      }
    
       ?>
      </main>
    
      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="./images/footer-logo.png" alt="ACME Sports Footer Icon" width="48" height="48">
            <small class="d-block mb-3 text-muted">&copy; 2023 ACME Sports</small>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html>
