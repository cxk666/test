<?php  
    session_start();
    if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册")  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        $psw_confirm = $_POST["confirm"];  
        if($user == "" || $psw == "" || $psw_confirm == "")  
        {  
            echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";  
        }  
        else 
        {  
            if($psw == $psw_confirm)  
            {  
                $db = new PDO('mysql:host=localhost;dbname=vt', 'root', '');
                $sql = 'SELECT * FROM `vt` WHERE `id`=:user';
                $p = $db->prepare($sql);
                $p->execute([':user' => $user]);
                $res = $p->fetchAll();
                //print_r($res);
                if(count($res)>0) {
                // success
                //$_SESSION['user'] = $user;
                    echo "<script>alert('用户名已存在！');history.go(-1);</script>";
                }
                else{
                    $sql="INSERT INTO vt (`id`,`secret`)
                    VALUE ('$user','$psw')";
                    $db->exec($sql);
                    //$_SESSION['user']=$user;
                    echo "<script>alert('注册成功！');</script>";
                }
            }  
            else 
            {  
                echo "<script>alert('密码不一致！'); history.go(-1);</script>";  
            }  
        }  
    }  
    else 
    {  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
    }  
?>