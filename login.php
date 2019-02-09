<?php
    require_once 'core/init.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Đăng nhập</title>
  </head>
  <body>
    <div class="container">
      <!-- Content here -->
      <div class="row">
      <?php
        if(Input::exists()){
            
            if(Token::check(Input::get('token'))){
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'username'  => array('required' => true),
                    'password'  => array('required' => true)
                ));
                
                if($validation->passed()){
                    $user = new User();
                    if($user->login(Input::get('username'), Input::get('password'))){
                        Redirect::to('index.php');
                    }else{
                        echo '<p>' .Session::get('login_false'). '</p>';
                    }   
                } else{
                    foreach($validation->errors() as $error){
                        echo $error . '<br />';
                    }
                }
                
                
            }
        }
    ?>
      </div>
      <div class="row justify-content-md-center" style="margin-top: 100px;">
          <div class="alert alert-primary" role="alert">
            <h1>Đăng nhập</h1>
        </div>
      </div>
      <div class="row justify-content-md-center">
        <form action="login.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Tên đăng nhập</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Nhập tên đăng nhập">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Mật khẩu</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Mật khẩu">
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Ghi nhớ đăng nhập</label>
          </div>
          <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
          <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>