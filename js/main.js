// function formatDate(date) {
//     let d = new Date(date),
//         month = '' + (d.getMonth() + 1),
//         day = '' + d.getDate(),
//         year = d.getFullYear();

//     if (month.length < 2) 
//         month = '0' + month;
//     if (day.length < 2) 
//         day = '0' + day;

//     return [year, month, day].join('-');
// }

$(document).ready(function() {
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }).on('changeDate', function(e) {
        let formattedDate = formatDate(e.date);
        
        getWaitListByDate(formattedDate);
    });
});
