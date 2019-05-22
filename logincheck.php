<?php  
    session_start();
    // $_SESSION['username'] = $user;
    // $user = $_SESSION['xxx'];
    if(isset($_POST["submit"]) && $_POST["submit"] == "登陆")  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        if($user == "" || $psw == "")  
        {  
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";  
        }  
        else 
        {  
            $db = new PDO('mysql:host=localhost;dbname=vt', 'root', '');
            $sql = 'SELECT * FROM `vt` WHERE `id`=:user AND `secret`=:psw';
            $p = $db->prepare($sql);
            $p->execute([':user' => $user, ':psw' => $psw]);
            $res = $p->fetchAll();
            //print_r($res);
            if(count($res)>0) {
                // success
                $_SESSION['user'] = $user;
                echo "<script>alert('登陆成功！')</script>";
            } else {
                //failed
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
            }
        }  
    }  
    else 
    {  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
    }  

   

?>