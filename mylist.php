<?php 
  session_start(); 
  include("models/m_music.php");
  $music = new music();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./public/core/css/all.min.css">
    <link rel="stylesheet" href="./public/core/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/core/css/style.css">     
    <link rel="stylesheet" href="./public/core/css/style-header.css">
    <link rel="stylesheet" href="./public/core/css/music-content.css">
    <link rel="stylesheet" href="./public/core/css/style-footer.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="js/mediaelement-and-player.min.js"></script>
    <link rel="stylesheet" href="css/style.css" media="screen">
    <!-- end Audio Player CSS & Scripts -->
    
    <title>List nhạc</title>
  </head>
  <body>

    <!-- ======================== Header ======================== -->
    
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #181412; height: 90px; font-family: 'Helvetica', sans-serif;">
    
      <a class="navbar-brand mr-4 ml-3" href="./index.php">
        <img src="./public/core/image/logo.png"  alt="logo">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <form class="form-inline my-2 my-lg-0 " action="mylist.php" method="post">
        <input class="form-control mr-sm-2" type="search" placeholder="Tìm" aria-label="Search" name="key">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"
        name="ok">Tìm kiếm</button>
      </form>
    
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Image and text -->
        <nav class="navbar navbar-dark" style="background-color: #181412;">

        <div class="navbar-brand ml-4 mr-3 d-flex" style="" href="#">
            <span class="" style=" color: #9befe0;margin-top: 7px;">
              <i class="fas fa-circle"></i>
            </span>
            <div class="dropdown">
              <a class="btn btn-secondary dropdown-toggle abc" href="./admin/admin.php" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Thể loại
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">Pop</a>
                <a class="dropdown-item" href="#">HipHop</a>
                <a class="dropdown-item" href="#">Rock</a>
                <a class="dropdown-item" href="#">Balad</a>
              </div>
            </div>
          </div>
                  
          <a class="navbar-brand mx-4" href="#">
            <span class="mr-3" style=" color: #fae639;">
              <i class="fas fa-circle "></i>
            </span>
            Bài hát
          </a>
          
          <?php 
            if(isset($_SESSION["name"]))
            {
          ?>    
                <a class='navbar-brand mx-4' href='./mylist.php'>
                  <span class='mr-3' style=' color: #f573a0;'>
                    <i class='fas fa-circle'> 
                    </i>
                  </span>
                  MyList
                </a>
              </nav>
              </div>
              <div class='info-user'>
                <div class='dropdown' style='background-color: #181412;'>
                  <button class= 'btn btn-secondary dropdown-toggle abc' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                 <?php echo $_SESSION["name"]." "; ?> 
                  </button>
                  <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                    <a class='dropdown-item' href='profile.php'>Thông tin cá nhân</a>
                    <a class='dropdown-item' href='#'>Nhạc yêu thích</a>
                    <a class='dropdown-item' href='#'>Playlist của tôi</a>
                    <a class='dropdown-item' href='#'>Nghe gần đây</a>
                    <a class='dropdown-item' href='logout.php'>Đăng xuất</a>
                  </div>
                <div>  
              </div>
          <?php  
            }            
            else
            { 
          ?>                
              <a class='navbar-brand mx-4' href='./login.php'>
                <span class='mr-3' style=' color: #f573a0;'>
                  <i class='fas fa-circle'>
                  </i>
                </span>
                Đăng nhập
              </a>
              </nav>
              </div>
          <?php    
            }      
          ?>
  </nav>

  <!-- ======================== Content ======================== -->
    <div class="body">
      <div style="background: rgb(0,0,0);background: linear-gradient(90deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 0%);width: 100%;height: 100%;">
      <div style="height: 20px; width: 100%"></div>
      <div class="container">
      <div class="row">
        <div class="col-sm-9">
          <div class="player">
            <div style="background: rgb(0,0,0);background: linear-gradient(90deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 0%);width: 100%;height: 100%;">
            <div class="cover"></div>
            <div class="title"></div>
            <div class="artist"></div>
            
            <div class="controls">
              <div class="rew">
                <i class="fas fa-backward" ></i>
              </div>
              <div class="play">
                <i class="fas fa-play-circle" ></i>
           
              </div>
              <div class="pause">
                <i class="fas fa-pause-circle" ></i>
              </div>
              <div class="fwd">
                <i class="fas fa-forward" ></i>
              </div>
              
            </div>
            </div>
           <!--  <div class="audio-player">
                <img class="cover" src="./image/slider.jpg" alt="">
                <audio id="audio-player" src="./mp3/06.mp3" type="audio/mp3" controls="controls"></audio>
            </div> -->
          </div>

          <div class="viewlist" id="style-1">
            <ul class="playlist">             

                <?php  
                  if (isset($_REQUEST['ok'])) 
                  {
                    // Gán hàm addslashes để chống sql injection
                    $key = addslashes($_POST['key']);
   
                    // Nếu $key rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
                    if (empty($key)) 
                    {
                      echo "<p style= 'color:red;'>* Dữ liệu tìm kiếm không được để trống</p>";
                    } 
                    else
                    {
                      $music->m_search($key);
                    }
                  }
                  else
                  {
                    $sql = "SELECT * FROM music ms
                            INNER JOIN mylist ml
                            ON ms.id = ml.id
                            INNER JOIN users us
                            ON ml.userid = us.userid";

                    $music->query($sql);
                 
                    $dem=1;  
                    while ($data = $music->fetch_assoc()) 
                    {
                      echo"<li audiourl='../public/core/$data[mp3]' cover='../public/core/$data[img]' artist='$data[song]'>";
                        echo"<div class='bai-hat-tuan'>";

                          echo"<div class='number'>$dem</div>";
                          echo"<div class='info'>";
                            echo"<div><a id='id-name' href='#'>$data[song]</a></div>";
                            echo"<div class='singer'><a id='id-singer' href='#'>$data[singer]</a></div>";
                          echo"</div>";
                          echo"<div class='view-count'></div> ";          

                        echo"</div>";
                      echo"</li>";
                      $dem++;
                    }
                    $music->disconnect();
                  }
              ?>  
            </ul>
            <div class="force-overflow"></div>
          </div>
        </div>
        <div class="col-sm-3">
          abc
        </div>
      </div>
      </div>
      <div style="height: 20px; width: 100%"></div>s    
    </div>



  <!-- ======================== Footer ======================== -->
  
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #181412;font-family: 'Helvetica',sans-serif; height: 40px;">
    
      <a class="navbar-brand ml-5" style="color: #fff; opacity: .4; font-size: .8em;" href="">
        Copyright 2018 Personal NP
      </a>
      

      <div class="collapse navbar-collapse footer-left " id="navbarSupportedContent">
        <!-- Image and text -->
        <nav class="navbar navbar-dark" style="background-color: #181412; height: 40px; margin-left: 66%;">
          <a class="navbar-brand mx-4" style="font-size: .9em;" href="#">            
            Get Personal
          </a>
          <a class="navbar-brand mx-4" style="font-size: .9em;" href="#">            
            Legal
          </a>
          <a class="navbar-brand mx-4" style="font-size: .9em;" href="#">            
            Cookies
          </a>
        </nav>     
      </div> 

  </nav>  
  
  <div class="go-home fixed-bottom" style="bottom: 1rem; left: 94%;">
    <a href="./index.php"><i class="fas fa-home fa-3x " style="color: #3ea24c;"></i></a>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./public/core/js/jquery-3.3.1.slim.min.js"></script>
    
    <script src="./public/core/js/popper.min.js"></script>
    <script src="./public/core/js/bootstrap.min.js"></script>
    <script src="./public/core/js/main.js"></script>
    <script src="./public/core/js/content.js"></script>
  </body>
</html>