<?php
$userLabel = ""; 
$passwordLabel = "";
$statusMsg = "";

if(isset($_POST['userSubmit'])){
    //fetch data from json
    $data = file_get_contents('../jsonDB/userInfo.json');
    //decode into php array
    $data = json_decode($data);

    // This will be triggred after hit submit
    if(isset($_POST['userSubmit'])){
        //getting th valu of input field value
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];

        //Loop, this will check if the username is exist in JSON file
        foreach($data as $row){
            if($row->username == $username){
                $userLabel = "Usrname exist";
                break;
            }else{
                $userLabel = "";
            }
        }

        // This will check if the entered password was match
        if($password != $passwordConfirm){
            $passwordLabel = "Password did not match";
        }

        // Array to insert your data to JSON
        if(empty($userLabel) && empty($passwordLabel)){
            //data in out POST
            $input = array(
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'username' => $username,
                'password' => $password
            );

            //append the input to our array
            $data[] = $input;
            //encode back to json
            $data = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents('../jsonDB/userInfo.json', $data);

            $statusMsg = "Registration was success!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGH Shop</title>>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="images/logo.jpg">

</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h1>Registration</h1>
            </div>
            <div class="col-md-12">
                <?php if(!empty($statusMsg)){ ?>
                <div class="alert alert-success"><?php echo $statusMsg; ?> <span><a href="../index.html">Login here..</span></a></div>
                <?php } ?>
            </div>
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" required="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required="">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter contact no" required="">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter username"  required="">
                        <p><?php echo $userLabel ?></p>
                    </div>
                    <div class="form-group">
                        <label>Create password</label>
                        <input type="password" class="form-control" name="password" required="">
                        <p><?php echo $passwordLabel ?></p>
                    </div>
                    <div class="form-group">
                        <label>Re-Type password</label>
                        <input type="password" class="form-control" name="passwordConfirm" required="">
                    </div>
                    
                    <a href="../index.html" class="btn btn-secondary">Cancel</a>
                    <input type="hidden" name="id" value="<?php echo $uniqID = crc32(uniqid()); ?>">
                    <input type="submit" name="userSubmit" class="btn btn-success" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>