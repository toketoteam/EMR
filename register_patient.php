<?php 
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>외래환자 등록</title>
    <link rel="stylesheet" href="css/emrstyles.css">
</head>

<body>
    <div class="container">
        <h1>외래 환자 등록</h1>

        <form action="pt_plus.php" method="post">
            <label for="ptid">환자 번호:</label>
            <input type="text" id="ptid" name="ptid" required pattern="\d{7}" title="7자리 숫자를 입력해주세요.">

            <label for="ptname">환자 이름:</label>
            <input type="text" id="ptname" name="ptname" required>

            <label for="gender">성별:</label>
                <select id="gender" name="gender">
                    <option value="1">남자</option>
                    <option value="2">여자</option>
                    <option value="3">그 외</option>
                </select>

            <label for="birthdate">생년월일 (예: 19940821):</label>
            <input type="text" id="birthdate" name="birthdate" required pattern="\d{8}" title="8자리 숫자를 입력해주세요.">

            <label for="insurances">보험 구분:</label>
                <select id="insurances" name="insurances">
                    <option value="1">일반(비급여)</option>
                    <option value="2">건강보험</option>
                    <option value="3">사보험</option>
                    <option value="4">산재보험</option>
                </select>



            <input type="submit" value="등록">
        </form>
    </div>
</body>

</html>

