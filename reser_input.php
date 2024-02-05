<?php 
date_default_timezone_set("Asia/Seoul");

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>환자 예약</title>
    <link rel="stylesheet" href="css/emrstyles.css">
    
</head>

<body>
    <div class="container">
        <h1>환자 예약</h1>

        <form action="reser_plus.php" method="post">
            <label for="ptid">환자 번호:</label>
            <input type="text" id="ptid" name="ptid" required pattern="\d{7}" title="7자리 숫자를 입력해주세요.">
            <button type="button" onclick="searchPatientByID()">환자 검색</button>

            <!-- 환자 이름으로 검색 -->
            <label for="ptname_search">환자 이름으로 검색:</label>
            <input type="text" id="ptname_search">
            <button type="button" onclick="searchPatientByName()">이름으로 검색</button>

            <!-- 검색 결과 표시 영역 -->
            <div id="searchResults"></div>

            <label for="ptname">환자 이름:</label>
            <input type="text" id="ptname" name="ptname" required>

            <label for="gender">성별:</label>
                <select id="gender" name="gender">
                    <option value="1">남자</option>
                    <option value="2">여자</option>
                    <option value="3">그 외</option>
                </select>
                <label for="doctor">담당의:</label>
                <select id="doctor" name="doctor">
                    <option value="김원장">김원장</option>
                    <option value="박원장">박원장</option>
                    <option value="이원장">이원장</option>
                </select>
            <!-- 예약 시간 선택 -->
                <label for="reser_time_input">예약 시간:</label>
                <input type="datetime-local" id="reser_time_input" name="reser_time_input" required>

            <!-- Hidden inputs -->
                <input type="hidden" id="reser_date" name="reser_date">
                <input type="hidden" id="reser_time_hidden" name="reser_time"> 
                <input type="hidden" id="server_time" name="server_time"> <!-- 추가한 부분 -->


            <input type="submit" value="등록">
        </form>
    </div>
    <script>
        //여기서 시간처리
        function fetchServerTime(callback) {
            fetch('get_current_time.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('server_time').value = data.currentTime;
            });
        }
    
    document.getElementById('reser_time_input').addEventListener('change', function() {
    const reserTime = new Date(this.value);
    reserTime.setMinutes(reserTime.getMinutes() + reserTime.getTimezoneOffset());//시간대보정(추가a-1)
    const reserDate = reserTime.toISOString().slice(0, 10); // YYYY-MM-DD 형식의 날짜
    const reserHourMin = reserTime.toISOString().slice(11, 16); // HH:MM 형식의 시간
    
    document.getElementById('reser_date').value = reserDate;
    document.getElementById('reser_time_hidden').value = reserHourMin;
});

       
        function searchPatientByID() {
         let ptid = document.getElementById('ptid').value;
        fetch('search_patient.php?ptid=' + ptid)
        .then(response => response.json())
        .then(data => {
            // 환자 정보 화면에 표시 (예: 이름, 성별)
            if (data.success) {
                document.getElementById('ptname').value = data.ptname;
                document.getElementById('gender').value = data.gender;
                // 다른 필드도 이와 같은 방식으로 추가
            } else {
                alert('환자 정보를 찾을 수 없습니다.');
            }
                    });
                                    }

        function searchPatientByName() {
    let ptname = document.getElementById('ptname_search').value;
    fetch('search_patient.php?ptname=' + ptname)
        .then(response => response.json())
        .then(data => {
            let resultsDiv = document.getElementById('searchResults');
            resultsDiv.innerHTML = ""; // 기존 결과 지우기
            data.forEach(patient => {
                // 결과를 화면에 표시
                resultsDiv.innerHTML += `${patient.ptid} - ${patient.ptname} - ${patient.age} - ${patient.gender}<br>`;
            });
        });
                                        }
     

    </script>
</body>

</html>

