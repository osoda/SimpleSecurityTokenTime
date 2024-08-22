<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Security Token Time</title>
  <link rel="stylesheet" href="public/lib/jquery/jQueryUI/css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="public/lib/bootstrap/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="Public/styles.css"> -->
</head>

<body>
  <div class="container">
    <div class="border rounded mt-3 mb-3 p-4">
      <h4>Admin Security Token Time</h4>
      <br>
      <div class="row">
        <div class="col-md-5">

          <div class="form-inline">
            <input class="form-control mr-sm-2" type="text" id="securityToken" disabled>
            <button class="btn btn-outline-success my-2 my-sm-0" id="btnLoadToken">Load</button>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="progress mt-2" style="max-width: 300px;">
            <div class="progress-bar bg-success" role="progressbar" id="progressBar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <span id="time">03:00</span>
        </div>
      </div>

    </div>
    <div class="border rounded mb-3 p-4">
      <h4>Client</h4>
      <br>
      <div class="row">
        <div class="col-md-5">
          <label for='msgToken'>Input the Token</label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="form-inline">
            <input type='number' id='tokenToEval' placeholder='Security Token' class='form-control mr-sm-2'>
            <button class="btn btn-outline-primary my-2 my-sm-0" id="btnSendToken">Send</button>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div></div>


  <script type="text/javascript" src="public/lib/jquery/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="public/simpleSecurityTokenTime.js"></script>
</body>

</html>