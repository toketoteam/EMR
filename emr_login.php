<?php
date_default_timezone_set("Asia/Seoul");

$db_host = "localhost";
$db_user = "root";
$db_password = "qwer";
$db_name = "emrs";

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name); // 데이터베이스 접속
if ($mysqli->connect_error) {
    die('Connection failed : ' . $mysqli->connect_error); 
}
$error = ""; // 에러 메시지 초기화

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $password = $_POST["password"];
    
    $stmt = $mysqli->prepare("SELECT * FROM emr_login WHERE id = ? AND pw = ?");
    $stmt->bind_param("ss", $id, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user) {
        header("Location: emr_main.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <style>
        ul {
            list-style: none;
        }

        li {
            margin: 20px 0;
        }

        li label {
            width: 120px;
            display: inline-block;
        }

        fieldset {
            margin: 15px;
            width: 400px; 
            margin: 0 auto;
        }

        .btn_login {
            background-color: rgb(61, 186, 228);
            border: none;
            color: white;
            padding: 15px 30px;
            text-align: center;
            display: block;
            margin: 0 auto;
        }

        .btn_login:active {
            background-color: darkcyan;
        }

        a {
            text-decoration: none;
            color: gray;
        }

        .bottom-links {
            text-align: center; /* 중앙 정렬 */
        }

        .bottom-links h2 {
            display: inline-block; /* 항목들을 수평 정렬 */
            font-size: 10px;       /* 글자 크기 조절 */
            margin: 0 5px;        /* 각 항목 사이의 간격 */
        }
        legend{
            font-weight: bold;         /* 볼드 적용 */
            font-size: 25px;          /* 글자 크기 증가 */
            font-family: 'Arial'; 

        }
        input#id:focus {
    border-color: skyblue; /* 하늘색으로 테두리 색상 설정 */
    outline: none;         /* 브라우저 기본 아웃라인 제거 */
        }
        input#pwd:focus {
    border-color: skyblue; /* 하늘색으로 테두리 색상 설정 */
    outline: none;         /* 브라우저 기본 아웃라인 제거 */
}

    </style>
</head>

<body>
    <form action="emr_login.php" method="post">
        <fieldset>
            <legend>LOGIN</legend>
            <ul>
                <li>
                    <label for="id"><span style="color:rgb(61, 186, 228);">아이디 </span></label>
                    <input type="text" id="id" name="id">
                </li>
                <li>
                    <label for="pwd"><span style="color:rgb(61, 186, 228);">비밀번호</span></label>
                    <input type="password" id="pwd" name="password">
                </li>
                <li>
                    <input type="checkbox" value="remblog"> 로그인 상태 유지
                </li>
                <li>
                    <button class="btn_login" type="submit">로그인</button>
                </li>
            </ul>
        </fieldset>
        <?php if(!empty($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    </form>

</body>

</html>
