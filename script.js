document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('emr-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const patientName = event.target.patientName.value;
        const patientAge = event.target.patientAge.value;
        const diagnosis = event.target.diagnosis.value;

        // 여기서 원하는 처리를 진행하면 됩니다.
        console.log('환자 이름:', patientName);
        console.log('환자 나이:', patientAge);
        console.log('진단:', diagnosis);

        // 입력값 초기화
        form.reset();
    });
});
