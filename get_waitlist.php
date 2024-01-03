<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "qwer";
$db_name = "emrs";

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($mysqli->connect_error) {
    die('Connection failed : ' . $mysqli->connect_error);
}

if (isset($_POST['reser_date'])) {
    $selectedDate = $_POST['reser_date'];

    // Prepared statement 사용
    $stmt = $mysqli->prepare("SELECT * FROM pt_reser WHERE reser_date = ? ORDER BY reser_time ASC");
    $stmt->bind_param("s", $selectedDate);

    // 순번 카운터 초기화
    $sequence_number = 1;
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $sequence_number++ . "</td>"; // 순번 카운터 사용 후 1씩 증가
        echo "<td>" . $row["ptid"] . "</td>";
        echo "<td>" . $row["ptname"] . "</td>";
        echo "<td>" . $row["age"] . "</td>";
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
            echo "<td>예약</td>";
        } else if ($pt_state == 2) {
            echo "<td>접수</td>";
        } else if ($pt_state == 3) {
            echo "<td>방문</td>";
        } else if ($pt_state == 4) {
            echo "<td>진료완료</td>";
        }
        echo "<td data-idx='" . $row["ptid"] . "' class='visit-time-cell'>" . $row["visit_time"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "Error: " . $stmt->error;
}
}
?>