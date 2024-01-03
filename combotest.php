<?php

on('contextmenu', '.visit-time-cell', function(e) {
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
        console.log("Selected action:", action); 
        handleAction(action, idx);
        $(this).remove();
    });

    $contextMenu.blur(function() {
        $(this).remove();
    });
});
?>