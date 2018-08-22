$("#draggable").draggable({
    containment: "#container",
    scroll: false
});

$( "#resizable" ).resizable({
    grid:10,
    maxHeight: 100,
    maxWidth: 300,
    resize: function(event, ui){
        if($("#resizable").width() > 300){
            alert("Size: 300!");
        }
    }
});

$("#draggable2").draggable();
$("#droppable").droppable({
    accept: "#draggable2",
    drop: function(event, ui){
        $(this).addClass("ui-state-highlight")
                .find("p").html("Dropped!");
    }
});

$( "#accordion" ).accordion();

$("#sortable").sortable();
$( "#sortable" ).disableSelection();