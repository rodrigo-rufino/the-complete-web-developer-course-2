
var start = new Date().getTime();
var time = 0;

makeShapeRandom();

document.getElementById("shape").onclick = function(){
    document.getElementById("shape").style.display = "none";
    var end = new Date().getTime();                    
    time = (end - start)/1000;
    var text = "You took " + time + "s to react!";
    console.log(text);
    document.getElementById("reactionTime").innerHTML = text;
    makeShapeRandom();
}

function makeShapeAppear(){
    
    var randomTopPosition = Math.random()*500;
    var randomLeftPosition = Math.random()*500;
    document.getElementById("shape").style.top = randomTopPosition + "px";
    document.getElementById("shape").style.left = randomLeftPosition + "px";
    document.getElementById("shape").style.backgroundColor = getRandomColor();
    
    document.getElementById("shape").style.display = "block";
    
    start = new Date().getTime();
}

function makeShapeRandom(){
    var randomTime = Math.random()*2000;
    console.log(randomTime);
    setTimeout(makeShapeAppear, randomTime);    
}

function getRandomColor(){
    var letters = "0123456789ABCDEF";
    var color = "#";
    for (var i =0; i<6; i++){
        color += letters[Math.floor(Math.random()*16)];
    }
    return color;
}