<?php 
    require_once 'core/init.php';
    if(Input::exists()){
        // Check token session
        if(Token::check(Input::get('token'))){
            // Validate value
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array(
                    'required'  => true,
                    'min'       => 2,
                    'max'       => 20,
                    'unique'    => 'users'
                ),
                'email' =>  array(
                    'required'  => true,
                    'validate_email' => true
                ),
                'password' => array(
                    'required' => true,
                    'min'      => 6,
                    'max'      => 20
                ),
                'password_again' => array(
                    'required'  => true,
                    'matches'   => 'password'
                )
            ));
            
            if($validation->passed()){
                // register
                Redirect::to(404);
                $user = new User();
                try{
                    $user->create(array(
                        'username'  => Input::get('username'),
                        'password'  => passwordHash::generate_bcrypt(Input::get('password')),
                        'name'      => Input::get('name'),
                        'joined'    => date('d-m-Y H:i:s'),
                    ));
                }catch(Exception $e){
                    die($e->getMessage());
                }
                #$hash_password = passwordHash::generate_bcrypt(Input::get('password'));
#                if (password_verify(Input::get('password'), $hash_password)) {
#                    echo 'Password is valid!'; die;
#                    //echo passwordHash::generate_bcrypt($password); die;
#                } else {
#                    echo 'Invalid password.'; die;
#                }
                Session::flash('success', 'Ban dang ky thanh cong');
                //Redirect::to('index.php');
            }else{
                // errors
                $errors = $validate->errors();
                echo "<pre>";print_r($errors);
            }
        }
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Ðang ký</title>
  </head>
  <body>
    <form class="" action="register.php" method="post">
      <div class="from-control">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo Input::get('username'); ?>" placeholder="Username" autocomplete="off">
      </div>
      <div class="from-control">
        <label for="username">Email</label>
        <input type="email" name="email" value="<?php echo Input::get('email'); ?>" placeholder="Email" autocomplete="off">
      </div>
      <div class="from-control">
        <label for="password">Password</label>
        <input type="text" name="password" value="" placeholder="Password" >
      </div>
      <div class="from-control">
        <label for="Password_again">Password again</label>
        <input type="text" name="password_again" value="" placeholder="Password again" >
      </div>
      <div class="from-control">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo Input::get('name'); ?>" placeholder="Name" autocomplete="off">
      </div>
      <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
      <div class="from-control">
        <input type="submit" name="register" value="Register">
      </div>
    </form>
  </body>
</html>
