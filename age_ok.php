<?php
    $age = $_POST['user_age'];   

    if($age > 18)
    {
        echo "<script>alert('18세이상면 input페이지이동')</script>"; 
        //페이지이동 첫번째방법
        echo "<script>location.href='input_test.html'</script>";
    }
    else{
        echo "<script>alert('미성년이라 input2페이지이동!')</script>"; 
         //페이지이동 두번째방법
        echo "<script>location.replace('input_test2.html')</script>";
    }
    
?>