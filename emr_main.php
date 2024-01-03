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

function calculateAge($birthdate) {
    $birthdate = DateTime::createFromFormat('Ymd', $birthdate);
    $today = new DateTime();
    $interval = $today->diff($birthdate);
    return $interval->y;  // 연령을 년수로 반환
}


$today = date('Y-m-d');  // 오늘 날짜를 구함
// $query = "SELECT * FROM pt_reser WHERE reser_date = '$today' ORDER BY reser_time ASC"; 31.10
$query = "SELECT pt_reser.*, pt_table.birthdate FROM pt_reser 
          JOIN pt_table ON pt_reser.ptid = pt_table.ptid 
          WHERE reser_date = '$today' ORDER BY reser_time ASC";

$result = $mysqli->query($query);


?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- 이하 그리드 Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">
    
<!-- User Defined Styles -->
<link rel="stylesheet" href="css/emr_main.css">
<style>
    .Icon { background-color: #81c7d4; } /* 바탕색 변경 */
    .pt_view { background-color: #81c7d4; } /* 바탕색 변경 */
    .pt_info { background-color: #7ab2eb; } /* 바탕색 변경 */
    .wait_list { background-color: #e1f5fe; } /* 바탕색 변경 */
    .pt_scription { background-color: #d1c4e9; } /* 바탕색 변경 */
    .nurse_memo { background-color: #ffcc80; } /* 바탕색 변경 */
    .calendar { background-color: #72c6b6; } /* 바탕색 변경 */
    </style>

</head>
<body>

<div class="container-fluid">
    <div class="row menu">
        <div class="Icon col-12">
        <!--여기에 버튼구현-->
        <div>
        <button type="button" class="pt_admin">환자 관리</button>
        <button type="button" class="reser_admin">예약 관리</button>
        <button type="button" class="preex_view">예진 현황</button>
        <button type="button" class="prescrip_admin">처방 관리</button>
        <button type="button" class="insep_admin">검사 관리</button>
        <button type="button" class="etcB">기타</button>
        </div>
        </div>
        <div class="pt_view col-12">
        <label>Patient View</label>
        </div>
    </div>
    <div class="row main_view">
        <div class="pt_info col-md-3">
   <label>Patient Info</label>
<form id="patientInfoForm">
    <div class="row mb-3">
        <div class="col-md-4"> <!-- 환자 번호의 크기 줄임 -->
            <label for="patientNumber" class="form-label">환자 번호</label>
            <input type="text" class="form-control" id="patientNumber" placeholder="번호">
        </div>
        <div class="col-md-5"> <!-- 보험 구분의 길이 늘림 -->
 <label for="pt_ins" class="form-label">보험구분</label>
        <select class="form-control" id="pt_ins">
            <option value="1">일반(비급여)</option>
            <option value="2">건강보험</option>
            <option value="3">사보험</option>
            <option value="4">산재</option>
        </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-5">
            <label for="patientName" class="form-label">환자 이름</label>
            <input type="text" class="form-control" id="patientName" placeholder="이름">
        </div>
        <div class="col-md-3">
          <label for="pt_gender" class="form-label">성별</label>
        <select class="form-control" id="pt_gender">
            <option value="1">남자</option>
            <option value="2">여자</option>
            <option value="3">그외</option>
        </select>
    </div>
    </div>
    <div class="mb-3">
        <label for="contact" class="form-label">연락처</label>
        <input type="text" class="form-control" id="contact" placeholder="010-XXXX-XXXX">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">주소</label>
        <input type="text" class="form-control" id="address" placeholder="주소">
    </div>
    <div class="mb-3">
        <label for="dob" class="form-label">생년월일</label>
        <input type="text" class="form-control datepickerInfo" id="dob">
    </div>
    <div>
        <button type="button" class="editButton">수정</button>
        <button type="button" class="saveButton">저장</button>
        <span id="editingStatus" style="color: red;"></span>
    </div>
</form>
 </div>



        <div class="wait_list col-md-9">
        <label>Wait List</label>
        <table class="table">
        <thead>
            <tr>
                <th>순번</th>
                <th>ID</th>
                <th>이름</th>
                <th>나이</th>
                <th>성별</th>
                <th>담당의</th>
                <th>예약시간</th>
                <th>상태</th>
                <th>방문 시각</th>
            </tr>
        </thead>
        <tbody id="waitListTableBody">
            <?php
            // 순번 카운터 초기화
            $sequence_number = 1;
            while($row = $result->fetch_assoc()) {
                $age = calculateAge($row['birthdate']);  // birthdate를 기반으로 나이 계산
                echo "<tr>";
                echo "<td>" . $sequence_number++ . "</td>"; // 순번 카운터 사용 후 1씩 증가
                echo "<td>" . $row["ptid"] . "</td>";
                echo "<td>" . $row["ptname"] . "</td>";
                echo "<td>" . $age . "</td>";  // 여기서 계산된 나이를 사용
                $gender = $row["gender"];
                if ($gender == 1) {
                    echo "<td>남자</td>";
                    } else if ($gender == 2) {
                        echo "<td>여자</td>";
                        } else {
                            echo "<td>그 외</td>";
                                }
                echo "<td>" . $row["wanjang"] . "</td>";
                echo "<td>" . substr($row["reser_time"], 0, 5) . "</td>";
                $pt_state = $row["pt_state"];
                if ($pt_state == 1) {
                    echo "<td class='state-cell'>예약</td>";
                    } else if ($pt_state == 2) {
                       echo "<td class='state-cell'>접수</td>";
                        } else if ($pt_state == 3) {
                        echo "<td class='state-cell'>방문</td>";
                        } else if ($pt_state == 4) {
                        echo "<td class='state-cell'>진료완료</td>";
                        }
                        echo "<td data-idx='" . $row["ptid"] . "' class='visit-time-cell'>" . $row["visit_time"] . "</td>";
                        echo "</tr>";
            }
            ?>
        </tbody>
    </table>
        </div>
    </div>
    <div class="row memo">
        <div class="pt_scription col-md-4">
        <label>Prescription</label>
        </div>
        <div class="nurse_memo col-md-5">
        <label>Nurse Memo</label>
        </div>
        <div class="calendar col-md-3">
        <label id="datepicker">Calendar</label>
        </div>
</div>

    </div>
</div>

<!-- 필요한 JavaScript 파일 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.ko.min.js"></script>
<script src="js/main.js"></script>

<script>
// 여기에 함수 추가

function formatDate(date) {
    let d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

$(document).ready(function(){
    $('#datepicker').datepicker({
    format: "yyyy-mm-dd",
    language: "ko",
    autoclose: true
    
}).on("changeDate", function(e) {
    let dateToSend = formatDate(e.date); //날짜 형식 변환
});
 $('.datepickerInfo').datepicker({
        format: 'yyyy-mm-dd',
        language: 'ko',
        autoclose: true,
        todayHighlight: true
    });

});

function getWaitListByDate(selectedDate) {
 
    $.post('get_waitlist.php', { reser_date: selectedDate }, function(data) {
        $('#waitListTableBody').html(data);  // 반환된 데이터로 테이블 내용 업데이트
        
    });
}
//이하 waitlist 마우스클릭반응함수
function handleAction(action, id, newTime) {
    let postData = {action, id};
    
    if (action === "visit") {
        // 서버에서 시간을 가져오기 위한 AJAX 요청
        $.getJSON('get_current_time.php', function(data) {
            postData.visit_time = data.currentTime;
            // 시간을 가져온 후의 나머지 작업을 여기서 진행해야 합니다.
            sendRequest(postData, action, id);
        });
    } else if (action === "modify" && newTime) {
        postData.new_time = newTime;
        sendRequest(postData, action, id);
    }
    else if (action === "visitcancel") {
        sendRequest(postData, action, id);
    }
    else if (action === "cancel") {
        sendRequest(postData, action, id);  // 예약 취소 요청
    }
    else {
        sendRequest(postData, action, id);
    }
}
    function sendRequest(postData, action, id) {
    fetch("handleAction.php", {
        method: "POST",
        body: JSON.stringify(postData),
        headers: { "Content-Type": "application/json" }
    })
    .then(response => {
          if (!response.ok) {
        throw new Error("Network response was not ok");
    }
    return response.json();})
    .then(data => {
        const $cell = $(`.visit-time-cell[data-idx=${id}]`);
        const $stateCell = $cell.closest('tr').find('td:nth-child(8)'); // 상태 열 선택
        if (data.status === 'success') {
            switch(action) {
                case 'wait':
                    break;
                case 'visit':
                    $cell.text(postData.visit_time); // 방문 시각 업데이트
                     $stateCell.text("방문"); // 상태 업데이트
                    break;
                case 'cancel':
                    $cell.closest('tr').remove(); // 행 삭제
                    break;
                case 'modify':
                      $cell.closest('tr').find('td:nth-child(7)').text(data.newTime);  // 변경된 예약 시간 업데이트
                break;
            }
        } else {
            alert("액션 처리 중 오류가 발생했습니다: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error occurred:", error);
        alert("서버에서 오류 응답을 받았습니다.");
    });
}

//이하 info에 필요한스크립트
// 환자 정보 불러오기
$(document).on('click', '#waitListTableBody tr', function() {
    const ptid = $(this).find('td:nth-child(2)').text();

    $.post('get_patient_info.php', { ptid: ptid }, function(data) {
        if(data && data.status === 'success') {
            $('#patientNumber').val(data.ptid);
            $('#patientName').val(data.ptname);
            $('#contact').val(data.contact);
            $('#address').val(data.address);
            $('#dob').val(data.birthdate);
            $('#pt_gender').val(data.gender);
            $('#pt_ins').val(data.insurance);

        } else {
            alert("환자 정보를 불러오는 데 실패했습니다.");
        }
    }, 'json');
});

// 수정 버튼 클릭 이벤트
$(document).on('click', '.editButton', function() {
    $('#infoGrid input').prop('disabled', false); // 입력 활성화
    $(this).addClass('active-edit'); // 수정 버튼 스타일 적용
    $('#editingStatus').text('수정중...');  // "수정중" 메시지 표시
});

// 저장 버튼 클릭 이벤트
$(document).on('click', '.saveButton', function() {
    const data = {
        ptid: $('#patientNumber').val(),
        ptname: $('#patientName').val(),
        contact: $('#contact').val(),
        address: $('#address').val(),
        birthdate: $('#dob').val(),
        gender: $('#pt_gender').val(),
        insurance: $('#pt_ins').val()

    };

    $.post('save_patient_info.php', data, function(response) {
        if(response.status === 'success') {
            alert('정보가 성공적으로 저장되었습니다.');
            $('#infoGrid input').prop('disabled', true); // 입력 비활성화
            $('.editButton').removeClass('active-edit'); // 수정 버튼 스타일 초기화
            $('#editingStatus').text('');  // "수정중" 메시지 숨기기
        } else {
            alert('저장 중 오류가 발생했습니다.');
        }
    }, 'json');
});


//info수정저장 스타일액션
$(document).on('click', '.editButton', function() { // "수정" 버튼 클릭 이벤트
    $('#infoGrid input').prop('disabled', false).addClass('active-edit');
});

//메뉴박스 환자관리
$(document).on('click', '.pt_admin', function() {
   window.open('register_patient.php', 'window_name', 'width=500, height=550, location=no, status=no, scrollbars=yes');
});

//메뉴박스 예약관리
$(document).on('click', '.reser_admin', function() {
   window.open('reser_input.php', 'window_name', 'width=500, height=700, location=no, status=no, scrollbars=yes');
});





//이하 우클릭 콤보박스
$(document).on('contextmenu', '.visit-time-cell', function(e) {
    e.preventDefault();

    const idx = $(this).data('idx');
    const $contextMenu = $('<select class="context-menu">')
        .append($('<option>').val('wait').text('상태변경'))
        .append($('<option>').val('visit').text('방문확인'))
        .append($('<option>').val('cancel').text('예약취소'))
        .append($('<option>').val('modify').text('예약변경'));

    $(this).html($contextMenu);
    
    $contextMenu.focus();

$contextMenu.change(function() {
    const action = $(this).val();
    if (action === 'modify') {
        const newTime = prompt("새로운 예약 시간을 입력해주세요 (HH:MM 형식)", $(this).closest('tr').find('td:nth-child(7)').text());
        if (newTime && newTime.match(/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/)) {
            handleAction(action, idx, newTime);
        } else {
            alert('올바른 시간 형식으로 입력해주세요.');
        }
    } else if (action === 'cancel') {
        if (confirm('정말로 예약을 취소하시겠습니까?')) {
            handleAction(action, idx);
     }
    } else {
        handleAction(action, idx);
    }
    $(this).remove();
});

    $contextMenu.blur(function() {
        $(this).remove();
    });
});



</script>


</body>
</html>
