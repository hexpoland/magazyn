<!DOCTYPE html>
  <head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <meta charset="utf-8">

  	<style>

    /* http://css-tricks.com/perfect-full-page-background-image/ */
    html {
      background: url(img/background.jpg) no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }

    body {
      padding-top: 120px;
      font-size: 16px;
      font-family: "Open Sans",serif;
      background: transparent;
    }

    h1my {
      margin-top: 12px;
      font-family: PTC55F;
      src:url("font\PTC55F.ttf");
      font-weight: 400;
      font-size: 30px;
        color: #000000;
    }



    /* Override B3 .panel adding a subtly transparent background */
    .panel {
        height: 300px;
        width: 450px;
        border-radius: 5px;
      background-color: rgba(234, 229, 229, 0.92);

        box-shadow: 20px 10px 30px rgba(16, 16, 16, 0.76);
    }

    .margin-base-vertical {
      margin: 40px 0;
    }
    .hrmy{
       background-color:rgb(8, 8, 8);
    }

  </style>

  </head>


<html>
<body>



<center>

  <div class="container">
  <div class="row">
  <div class="col-md-6 col-md-offset-3 panel panel-default">
  <h1my>MagazynCzesciZbytecznych</h1my>

	<form method="POST" action="login.php">
	<div class="form-group">
	<table cellpadding="1" cellspacing="2" width="300" >
	<td width="0"><label for="emailField">Email:</label></td><td>
  <p class="input-group">
  <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
  <input type="email" id="emailField" name="email" class="form-control" placeholder="jan@kowalski.pl" maxlength="80"></td></tr>
	</p>
	<td><br></td>
	<tr><td width="80"><label for="passwordField">Hasło:</label></td><td>
<p class="input-group">
  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
  <input type="password" id="passwordField" name="haslo" class="form-control" placeholder="hasło" maxlength="32"></td></tr>
	</p>
  <td><br></td>
	<tr><br/><td align="center" colspan="5">
	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-log-in"></span> Login</button>
	<a class="btn btn-info" role="button" href="rejestracja.php"><span class="glyphicon glyphicon-book"></span> Rejestracja</a>

	</td>
	</tr>

  </table>
  <p></p>
    <small class="text-muted">Coding by hex wolaqu@poczta.onet.pl</small>


</form>
</div>
</div>
</div>
</div>



</center>

</body>
</html>
