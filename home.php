<?php

include("config.php");
$email = $_SESSION['email'];
$haslo = $_SESSION['haslo'];
    if ((empty($email)) AND (empty($haslo))) {
echo '<br>Nie byłeś zalogowany albo zostałeś wylogowany<br><a href="index.php">Strona Główna</a><br>';
exit;
}
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE `email`='$email' AND `haslo`='$haslo' LIMIT 1"));
    if (empty($user[id]) OR !isset($user[id])) {
echo '<br>Zaloguj się.<br>';
exit;
}

#SYSTEM DODAWANIE KOMENTAZRY NA STRONIE


if($_SESSION['zalogowany']==true){

$wynik=mysql_query("SELECT * FROM comment"); #pobierz wszystkie komentarze z bazy


echo '<head>
    <meta charset="utf-8">

  </head>
  <html>
  <body>


  <div class=container>
  <div class="row">
  <div class="col-md-8">

 	<h3>1.Zapytaj o część na forum <span class="glyphicon glyphicon-comment"></span></h3>

  <div class="row">
  <div class="col-md-7">
  <form role=form method="post" action="indeks.php?id=1" >
  <div class="form-group">

  <label for="comment"></label>
  <p algin=right>
  <textarea  name="comment" class="form-control" rows="5" placeholder="Napisz wiadomość do wszystkich"></textarea>
  </p>
  <p></p>
  <button type="reset"	class="btn btn-info btn-sm">Wyczyść</button>
  <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-comment"></span> Wyślij</button>
  </form>

  </div>
</div>
</div>


  <div class="container">

  <div class="row">
    <div class="col-md-8">
      <h4 class="page-header">Tablica:</h4>
        <section class="comment-list">';

while($r = mysql_fetch_assoc($wynik)) {   #wyluskaj ilosc komentarzy do tablicy $r
		if($r[id]%2==0||$r[id]==0){
		echo '
       		<div class="row">
            <div class="col-md-2 col-sm-2 hidden-s">
              <figure class="thumbnail">
                <img class="img-responsive" src="img/avatar.jpg">
                <figcaption class="text-center">'.$r[user].'</figcaption>
              </figure>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user"><i class="fa fa-user"></i>'.$r[user].'</div>
                    <time class="comment-date" datetime="'.$r[Data].'"><i class="fa fa-clock-o"></i>'.$r[Data].'</time>
                  </header>
                  <div class="comment-post">
                    <p>
                      '.$r[message].'
                    </p>
                  </div>
                  <p class="text-right">';
                  if($root){
                    echo "<a href=\"indeks.php?c=del&cid=".$r[id]."\" class=\"btn btn-danger btn-sm\"><span class=\"glyphicon glyphicon-remove-sign\"></span> usuń</a>";

                  }

                  echo '
                  <a href="#" title="Odpowiedz" class="btn btn-info btn-sm" data-toggle="popover" data-placement="right" data-content=""><i class="fa fa-reply">
                  </i> odpowiedz</a>

                </div>
              </div>
            </div>
          </div> ';
}else{
          echo'
          <div class="row">
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow right">
                <div class="panel-body panel-primary">
                  <header class="text-left">
                    <div class="comment-user"><i class="fa fa-user"></i>'.$r[user].'</div>
                    <time class="comment-date" datetime="'.$r[Data].'"><i class="fa fa-clock-o"></i>'.$r[Data].'</time>
                  </header>
                  <div class="comment-post">
                    <p>'.$r[message].'
                    </p>
                  </div>
                  <p class="text-right">';
                  if($root){
                    echo "<a href=\"indeks.php?c=del&cid=".$r[id]."\" class=\"btn btn-danger btn-sm\"><span class=\"glyphicon glyphicon-remove-sign\"></span> usuń</a>";

                  }

                  echo '
                  <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-reply"></i> odpowiedz</a>

                </div>
              </div>
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs">
              <figure class="thumbnail">
                <img class="img-responsive" src="img/avatar.jpg">
                <figcaption class="text-center">'.$r[user].'</figcaption>
              </figure>
            </div>
          </div>
			';
		}

      };





          echo'</div>
        	</section>
    		</div>
  			</div>
</div>


  </div>
  ';
}

?>

<style type="text/css">

	/*font Awesome http://fontawesome.io*/
@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
/*Comment List styles*/
.panel-primary {
     background-color: rgba(15, 15, 15, 0.2);
}
.comment-list .row {

  margin-bottom: 0px;
}
.comment-list .panel .panel-heading {

  padding: 4px 15px;
  position: absolute;
  border:none;
  /*Panel-heading border radius*/
  border-top-right-radius:5px;
  top: 1px;

}
.comment-list .panel .panel-heading.right {
  border-right-width: 0px;
  /*Panel-heading border radius*/
  border-top-left-radius:5px;
  right: 16px;
}
.comment-list .panel .panel-heading .panel-body {


  padding-top: 6px;
}
.comment-list figcaption {
  /*For wrap text is thumbnail*/
  word-wrap: break-word;
}
/* Portrait tablets and medium desktops */
@media (min-width: 768px) {
  .comment-list .arrow:after, .comment-list .arrow:before {
    content: "";
    position: absolute;
    width: 0;
    height: 0;
    border-style: solid;
    border-color: transparent;

  }
  .comment-list .panel.arrow.left:after, .comment-list .panel.arrow.left:before {
    border-left: 0;
  }
  /*****Left Arrow*****/
  /*Outline effect style*/
  .comment-list .panel.arrow.left:before {
    left: 0px;
    top: 30px;
    /*Use boarder color of panel*/
    border-right-color: inherit;
    border-width: 16px;
  }
  /*Background color effect*/
  .comment-list .panel.arrow.left:after {
    left: 1px;
    top: 31px;
    /*Change for different outline color*/
    border-right-color: #FFFFFF;

    border-width: 15px;
  }
  /*****Right Arrow*****/
  /*Outline effect style*/
  .comment-list .panel.arrow.right:before {
    right: -16px;
    top: 30px;
    /*Use boarder color of panel*/
    border-left-color: inherit;
    border-width: 16px;
  }
  /*Background color effect*/
  .comment-list .panel.arrow.right:after {
    right: -14px;
    top: 31px;
    /*Change for different outline color*/
    border-left-color: #FFFFFF;
    border-width: 15px;
  }
}
.comment-list .comment-post {

  margin-top: 6px;
}


</style>
