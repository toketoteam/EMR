<?php
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>검색 결과</title>
</head>

<body>
    <h2>검색 결과</h2>
    <ul id="searchResultsList"></ul>

    <script>
        // 부모 창으로부터 검색 결과 데이터를 받아옴
        const searchData = window.opener.searchData;
        const searchResultsList = document.getElementById('searchResultsList');

        if (searchData.length > 0) {
            searchData.forEach(patient => {
                const listItem = document.createElement('li');
                listItem.textContent = `${patient.ptid} - ${patient.ptname} - ${patient.age} - ${patient.gender}`;
                searchResultsList.appendChild(listItem);
            });
        } else {
            const noResultsMessage = document.createElement('p');
            noResultsMessage.textContent = '검색 결과가 없습니다.';
            searchResultsList.appendChild(noResultsMessage);
        }
    </script>
</body>

</html>
