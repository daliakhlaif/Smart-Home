
var d;
function change(n){
    if(n==1||d==1) {document.getElementById("first").innerHTML=document.getElementById("div1").innerHTML;}
    if(n==2||d==2) {document.getElementById("first").innerHTML=document.getElementById("div2").innerHTML;}
    if(n==3||d==3) {document.getElementById("first").innerHTML=document.getElementById("div3").innerHTML;}
    if(n==4||d==4) {document.getElementById("first").innerHTML=document.getElementById("div4").innerHTML;}
    if(n==5||d==5) {document.getElementById("first").innerHTML=document.getElementById("div5").innerHTML;}
    if(n==6||d==6) {document.getElementById("first").innerHTML=document.getElementById("div6").innerHTML;}
    if(n==7||d==7) {document.getElementById("first").innerHTML=document.getElementById("div7").innerHTML;}
    if(n==8||d==8) {document.getElementById("first").innerHTML=document.getElementById("div8").innerHTML;}

}
const params = new URLSearchParams(window.location.search);
params.has('test');
params.get(d);
alert(params);
// function imgfun(n){
//     var imgID=document.getElementById(n);
//     if(imgID.src.match("images/gheart.png")) {imgID.src="images/nheart.png";  }
//     else imgID.src="images/gheart.png";
// }

var mybutton = document.getElementById("myBtn");

// When the user scrolls down 70px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    if (document.body.scrollTop > 70 || document.documentElement.scrollTop > 70) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}