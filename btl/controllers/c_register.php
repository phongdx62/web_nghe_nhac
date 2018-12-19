<?php 
	if(isset($_POST["ok"]))
	{
		$f = addslashes(stripslashes($_POST["fname"]));
		$l = addslashes(stripslashes($_POST["lname"]));
		$u = addslashes(stripslashes($_POST["user"]));
		$e = addslashes(stripslashes($_POST["email"]));
		$p = addslashes(stripslashes($_POST["pass"]));
	}

	$err = array();	
	$err["register"] = $err["re_pass"] = NULL;

	if(isset($f) && isset($l) && isset($u) && isset($e) && isset($p))
	{	
	  	if($p != $_POST["re_pass"])
		{
			$err["re_pass"] = "<p style='color: red;'>* Bạn nhập lại mật khẩu không đúng</p>";
		}
  		else
  		{
  			require("../models/m_user.php");
  			$base_url='localhost/btl/public/library/';
         	$activation=md5($e.time());

			$user = new user();
			$user->set_fname($f);
			$user->set_lname($l);
			$user->set_email($e);
			$user->set_name($u);
			$user->set_pass($p);
			$register = $user->m_register($activation);
			if($register == 'fail')
			{
				$err["register"] = "<p style='color: red;'>* Tài khoản đã tồn tại</p>";
			}
			else
			{
				//Soạn mail
         		include('../public/library/send_mail.php');
         		include('../public/library/class.phpmailer.php');
         		include('../public/library/class.smtp.php');

         		$title = 'Thư xác nhận';
			    $content = 'Hi, <br/> <br/> Chúng tôi cần đảm bảo bạn là con người. Vui lòng bấm vào đường dẫn dưới đây để hoàn tất việc đăng ký thành viên:
	. <br/> <br/> <a href="'.$base_url.'activation.php'.'?code='.$activation.'">'.$base_url.'activation.php'.'?code='.$activation.'</a>';
			    $nTo = $u;
			    $mTo = $e;

		        //Gửi mail     
			    $mail = send_mail($title, $content, $nTo, $mTo);
			    if($mail==1)
			    	$err["register"] = "<p style='color: #C71585;'>Thư của bạn đã được gửi đi, hãy kiếm tra hộp thư đến để xem kết quả.</p>";
			    else 
		    		$err["register"] = "<p style='color: red;'>* Có lỗi</p>";
			}
			$user->disconnect();								
	  	}	  												    
	}			 		
?>
