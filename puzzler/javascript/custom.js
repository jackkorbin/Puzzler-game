$(document).ready(function(){
    window.onkeydown = move;
});

var right = 1;
var bottom = 1;



var pos = 9;
var istimer = 0;

$('.fa-arrow-down').hide();
$('.fa-arrow-right').hide();
$('.fa-arrow-up').show();
$('.fa-arrow-left').show();

function move(e){
    var p = e.which;
    //alert('hi');
    
    
    //updatescore();
    
    
    $('#cursor').animate({
        'height':'160px',
        'width':'160px',
        'margin':'-5px'
    },50);
    
    
    if(p==37){ // left <--
         //alert(37);
        if( right != 3 ){
            moveleft();
            starttimer();
        }
        
    }
    
    else if(p==39){ // right -->
         //alert('39');
        if( right != 1 ){
            moveright();
            starttimer();
            if( check() ){
                solved = 1;
                solved_result();
            }
        }
    }
    
    else if(p==38){ // up
         //alert('38');
        if( bottom != 3 ){
            moveup();
            starttimer();
        }
    }
    
    else if(p==40){ // down
         //alert('40');
        if( bottom != 1 ){
            movedown();
            starttimer();
            if( check() ){
                solved = 1;
                solved_result();
            }
        }
     }
    
    //pos = 13 - (3*bottom) - right;
    
    
    
    if( right == 1 ){
        if( bottom == 1 ){
            $('.fa-arrow-down').hide();
            $('.fa-arrow-right').hide();
            $('.fa-arrow-up').show();
            $('.fa-arrow-left').show();
            
        }
        else if( bottom == 2 ){
            $('.fa-arrow-down').show();
            $('.fa-arrow-right').hide();
            $('.fa-arrow-up').show();
            $('.fa-arrow-left').show();
        }
        else {
            $('.fa-arrow-down').show();
            $('.fa-arrow-right').hide();
            $('.fa-arrow-up').hide();
            $('.fa-arrow-left').show();
        }
    }
    else if( right == 2 ){
        if( bottom == 1 ){
            $('.fa-arrow-down').hide();
            $('.fa-arrow-right').show();
            $('.fa-arrow-up').show();
            $('.fa-arrow-left').show();
            
        }
        else if( bottom == 2 ){
            $('.fa-arrow-down').show();
            $('.fa-arrow-right').show();
            $('.fa-arrow-up').show();
            $('.fa-arrow-left').show();
        }
        else {
            $('.fa-arrow-down').show();
            $('.fa-arrow-right').show();
            $('.fa-arrow-up').hide();
            $('.fa-arrow-left').show();
        }
    }
    else{
        if( bottom == 1 ){
            $('.fa-arrow-down').hide();
            $('.fa-arrow-right').show();
            $('.fa-arrow-up').show();
            $('.fa-arrow-left').hide();
            
        }
        else if( bottom == 2 ){
            $('.fa-arrow-down').show();
            $('.fa-arrow-right').show();
            $('.fa-arrow-up').show();
            $('.fa-arrow-left').hide();
        }
        else {
            $('.fa-arrow-down').show();
            $('.fa-arrow-right').show();
            $('.fa-arrow-up').hide();
            $('.fa-arrow-left').hide();
        }
    }
    
    $('#cursor').animate({
        'height':'150px',
        'width':'150px',
        'margin':'0px'
    },50);
    
   /* 
    console.log( 'pos:'+pos );
    console.log( 'boxleft:'+boxleft );
    console.log( 'boxright:'+boxright );
    console.log( 'boxup:'+boxup );
    console.log( 'boxdown:'+boxdown );
    */

    
}

function moveleft(){
    $('#cursor').animate({
        'right':'+=150px'
    },100);
    right++;



    var div = pos - 1;
    $('.box'+div).animate({
        'right':'-=150px'
    },100);



    $('.box'+div).removeClass('box'+div).addClass('box'+pos);
    pos = 13 - (3*bottom) - right;
}
function moveright(){
    $('#cursor').animate({
        'right':'-=150px'
    },50);
    right--;

    var div = pos + 1;
    $('.box'+div).animate({
        'right':'+=150px'
    },50);
    $('.box'+div).removeClass('box'+div).addClass('box'+pos);
    pos = 13 - (3*bottom) - right;
}
function moveup(){
    $('#cursor').animate({
        'bottom':'+=150px'
    },50);
    bottom++;

    var div = pos - 3;
    $('.box'+div).animate({
        'bottom':'-=150px'
    },50);
    $('.box'+div).removeClass('box'+div).addClass('box'+pos);
    pos = 13 - (3*bottom) - right;
}
function movedown(){
    $('#cursor').animate({
        'bottom':'-=150px'
    },50);
    bottom--;

    var div = pos + 3;
    $('.box'+div).animate({
        'bottom':'+=150px'
    },50);
    $('.box'+div).removeClass('box'+div).addClass('box'+pos);
    pos = 13 - (3*bottom) - right;
}

var start = 1;
var next;
var puzzle = $('.puzzle').html();

function changeimage(){
    
    
    
    next = Math.ceil(Math.random()*9);
    //console.log(start);
    //console.log(next);
    if( start != next ){
    
        resetcursor();
        var array = $('.row img');
        for( i=0; i < array.length; i++ ){

            var src = $(array[i]).attr("src");
            //alert(src);
            $(array[i]).attr("src",src.replace("puzzleimages/"+start,"puzzleimages/"+next));
        }

        var src = $('.whole img').attr('src');
        $('.whole img').attr('src',src.replace('puzzleimages/'+start,'puzzleimages/'+next));

        //var temp = start;
        start = next;
        //next = temp;
        //random();
    }
    else {
        changeimage();
    }
}

function resetall(){
    
    $('.puzzle').html(puzzle);
    right = 1;
    bottom = 1;
    pos = 9;
    
    $('.whole').html('<img src="puzzleimages/1/puzzle.jpg">');
    solved = 1;
    
}

function resetcursor(){
    
    if( right == 3 ){
        moveright();
        moveright();
    }
    else if( right == 2 ){
        moveright();
    }
    
    if( bottom == 3 ){
        movedown();
        movedown();
    }
    else if( bottom == 2 ){
        movedown();
    }
    
    $('.fa-arrow-down').hide();
    $('.fa-arrow-right').hide();
    $('.fa-arrow-up').show();
    $('.fa-arrow-left').show();
    
    
    
    setTimeout(scramble, 300);
    
}

var arr = [ [0,2,3,1,8,6,7,4,5], 
            [0,2,4,7,3,1,5,6,8], 
            [0,5,3,4,8,2,7,6,1], 
            [0,3,7,8,6,4,1,2,5], 
            [0,1,6,7,2,8,5,4,3], 
            [0,5,2,6,4,7,3,8,1], 
            [0,4,5,2,7,1,6,8,3], 
            [0,8,4,2,5,7,1,3,6], 
            [0,7,1,2,8,4,6,5,3] ];
var next = 0;
function scramble(){
    
    var randomj = Math.floor(Math.random()*9);

    if( next == randomj ){
        scramble();
        return;
    }
        console.log(randomj);
    /*
    var arr = [0];
    while(arr.length < 9){
      var randomnumber=Math.ceil(Math.random()*8);
      var found=false;
      for(var i=0;i<arr.length;i++){
        if(arr[i]==randomnumber){found=true;break}
      }
      if(!found)arr[arr.length]=randomnumber;
    }
    */
    
    var array = $('.row img');
    for( i=1; i < 9; i++ ){
        var j = arr[randomj][i];
       // console.log(j);
        if( $('.box'+i+' img').length !== 0 ){
            var src = $('.box'+i+' img').attr("src");
            var n = src.substring(13,14);
            //alert(n);
            $('.box'+i+' img').attr("src",src.replace(src,"puzzleimages/"+n+"/"+j+".jpg"));
        }
    }
    next = randomj;
    solved = 0;
    
}
resetcursor();

var solvedarr = [1,2,3,4,5,6,7,8];
var solved = 0;
function check(){
    var array = $('.row img');
    var numb = [];
    for( i=1; i < 9; i++ ){
        //var j = arr[randomj][i];
       // console.log(j);
        if( $('.box'+i+' img').length !== 0 ){
            var src = $('.box'+i+' img').attr("src");
            var n = src.substring(15,16);
            numb[numb.length]=n; 
        }
    }
    //console.log(numb);
    
    var i = 8;
    while( i-- ){
        if( solvedarr[i] != numb[i] ){
            i = 100;
            break;
        }
    }
    
    if( i != 100 ){
        //Match
        return 1;
    }
    else{
        return 0;
    }
    
}

function solved_result(){
    
    if( solved == 1 ){
        var score = updatescore();
        setTimeout(function(){
                alert("Final Score : "+score);
                resettimer();
                scramble();
                sharescore(score);
        },200);
    }
    
}
var hscore = 0; 
function updatescore(){
    var score = minute*60*10 + second*10 + milsec;
    score = Math.floor( 92451/score )+'0';
    $('.score span').html(score);
    if( hscore < score ){
        hscore = score;
        $('.h-score span').html(hscore);
    }
    return score;
    
}

function sharescore(score){
   
    
    $.ajax({
        type:'POST',
        url : 'shareonfacebook.php',
        data : {
            score : score
        },
        success : function(data){
            
        }
    });
    
}


$('.changeimg').click(function(){
    changeimage();
    resettimer();
});
$('.resetimg').click(function(){
    resetall();
    resettimer();
});
$('.random').click(function(){
    resetcursor();
    resettimer();
});


function inarrows()
{
    console.log('inarrows!');
    $('.fa-arrow-down').animate({
        "bottom":"5px"
    },500);
    $('.fa-arrow-up').animate({
        "top":"5px"
    },500);
    $('.fa-arrow-left').animate({
        "left":"5px"
    },500);
    $('.fa-arrow-right').animate({
        "right":"5px"
    },500);
    
    setTimeout(expandarrows, 1000);

}
function expandarrows()
{
    console.log('expandarrows!');
    $('.fa-arrow-down').animate({
        "bottom":"20px"
    },500);
    $('.fa-arrow-up').animate({
        "top":"20px"
    },500);
    $('.fa-arrow-left').animate({
        "left":"20px"
    },500);
    $('.fa-arrow-right').animate({
        "right":"20px"
    },500);
    setTimeout(inarrows, 2000);
}
//inarrows();
//setInterval(inarrows, 200);









/**********************
/*************************
COUNTDOWN.js
****************************/

var milsec = 0;
var second = 0;
var minute = 0;
var hour = 0;

var secondfunc;
var minutefunc;
var hourfunc;
var milisecfunc;

function counter(i,n){
    if( i < n-1 ) {
        return ++i;
    }
    else {
        return 0;
    }
}
function secondinc(){

    second = counter(second,60);

    if( second < 10 ){
        var sec = '0'+second; 
        $('.sec').html(sec);
    }
    else {
        $('.sec').html(second);
    }
    
}
function minuteinc(){
    minute = counter(minute,600);
    if( minute < 10 ){
        $('.min').html('0'+minute);
    }
    else{
        $('.min').html(minute);
    }
}
function hourinc(){
    hour = counter(hour,60);
    if( hour < 10 ){
        $('.hour').html('0'+hour);
    }
    else {
        $('.hour').html(hour);
    }
}
function milisecinc(){
    milsec = counter(milsec,10);
    if( milsec < 10 ){
        $('.milisec').html('0'+milsec);
    }
    else {
        $('.milisec').html(milsec);
    }
    
}

function starttimer(){
    
    if( istimer == 0 ){
        milisecfunc = setInterval(milisecinc, 100);
        secondfunc = setInterval(secondinc, 1000);
        minutefunc = setInterval(minuteinc, 1000*60);
        //hourfunc = setInterval(hourinc, 1000*60*60);
        istimer = 1;
    }
    
}
function stoptimer(){
    clearInterval(milisecfunc);
    clearInterval(secondfunc);
    clearInterval(minutefunc);
    //clearInterval(hourfunc);
    
    istimer = 0;
}
function resettimer(){
    clearInterval(milisecfunc);
    clearInterval(secondfunc);
    clearInterval(minutefunc);
    //clearInterval(hourfunc);
    
    second = 0;
    minute = 0;
    hour = 0;
    milisec = 0;
    
    $('.sec').html("00");
    $('.min').html("00");
    //$('.hour').html("00");
    $('.milisec').html("00");
    
    istimer = 0;
}

$('.resettimer').click(function(){
    resettimer();
});
$('.starttimer').click(function(){
    starttimer();
});
$('.stoptimer').click(function(){
    stoptimer();
});




