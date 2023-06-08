<?php
$usernameLabel = ""; 
$passwordLabel = "";
$statusMsg = "";

if(isset($_POST['userSubmit'])){
    //fetch data from json
    $data = file_get_contents('../jsonDB/userInfo.json');
    //decode into php array
    $data = json_decode($data);

    // this code will be trigered after you press login 
    if(isset($_POST['userSubmit'])){
        //getting th value of input field value
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        //Loop, this will check if the username is exist in JSON file
        $index = 0;
        foreach($data as $row){
            if($row->username == $input_username){ // if correct, it will proceed to check if password is correct
            
                if($input_password == $row->password){
                    $_SESSION['index'] = $index;
                    header('location: ../index.html?index='.$index.''); // If correct redirect to Main page
                    // $passwordLabel = "correct password";
                }
                else{
                    $passwordLabel = "Incorrect password";
                    break;
                }
            }
            elseif($row->username != $input_username){
                $usernameLabel = "Username not found";
            }
            else{
                $statusMsg = "Something went wrong";
            }
            $index++;
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
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h1>Login page</h1> 
            </div>
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter username" value="<?php if(isset($_POST['userSubmit'])){ echo $_POST['username'];}?>" required="">
                            <p><?= $usernameLabel ?></p> 
                    </div>
                    <div class="form-group">
                        <label>Enter your password</label>
                        <input type="password" class="form-control" name="password" required="">
                        <p><?php echo $passwordLabel ?></p>
                    </div>
                    <input type="submit" name="userSubmit" class="btn btn-success" value="Login">
                    <div class="col-md-12">
                             <a href="privacy.html" class="text-decoration-none">
                                <h5 class="m-0 display-5 font-weight-semi-bold"><br><span class="text-primary font-weight-bold border px-3 mr-1">Pivacy Policy</span></h5>
                             </a>
                            </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>