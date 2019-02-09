<?php
	require_once 'core/init.php';

	// $user = DB::getInstance()->query("select username from users where username=?",
	// 		array('alex'));
	// $user = DB::getInstance()->action('SELECT * FROM', 'users', array('username', '=', 'alex'));

	// $user = DB::getInstance()->get('users', array('username', '=', 'admin'));
	$table = 'users';
	$fields = array(
				'username' 	=> 'admin_update',
				'password'	=> '123456',
				'salt'		=> 'salt',
				'name'		=> 'admin_update',
				'joined'	=> '2019-02-06 00:00:00',
				'group_permissions'	=> '1'
			);
	$id = '8';
    
    $user = new User();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <!-- Content here -->
                <h1>Trang chu</h1>
            </div>
            <div class="row">
                <?php if(Session::exists('success')) : ?>
                <div class="alert alert-primary" role="alert">
            	 <?php echo Session::flash('success'); ?>
                </div>
                <?php endif; ?>
                <?php if(Session::exists('login_success')) : ?>
                <div class="alert alert-primary" role="alert">
            	 <?php echo Session::flash('login_success'); ?>
                </div>
                <?php endif; ?>
                <?php if($user->isLoggedIn()) : ?>
                <div class="alert alert-primary" role="alert">
                    <p>Hello <a href="#" class="alert-link"><?php echo escape($user->data()->username); ?></a> | 
                        <a href="logout.php" class="alert-link">Thoát</a>
                    </p>
                </div>
                <?php else : ?>
                <div class="alert alert-primary" role="alert">
                    <p>Bạn cần <a class="alert-link" href="login.php">đăng nhập</a> hoặc <a href="register.php" class="alert-link">đăng ký</a></p>
                </div>
                <?php endif; ?>
             </div>
             <?php if($user->isLoggedIn()) : ?>
             <div class="row">   
                <h3>Danh sach tai khoan</h3>
                <table class="table table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Username</th>
                      <th scope="col">Name</th>
                      <th scope="col">Date create</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $user = new User();
                    #echo "<pre>"; print_r($user->getAll()); die;
                    $listUsers = $user->getAll();
                    foreach($listUsers as $luser) : ?>
                        <tr>
                          <th scope="row"><?php echo $luser->username; ?></th>
                          <td><?php echo $luser->name; ?></td>
                          <td><?php echo $luser->joined; ?></td>
                        </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div><!-- .container -->
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>