// ATS Score Animation

function setATS(score){

let bar = document.querySelector(".progress-bar");

bar.style.width = score + "%";

bar.innerHTML = score + "%";

}


// Simple notification

function showMessage(msg){

alert(msg);

}


// Confirm Delete CV

function deleteCV(){

let confirmDelete = confirm("Are you sure you want to delete this CV?");

if(confirmDelete){

alert("CV Deleted");

}

}


// Dashboard animation

window.onload = function(){

let cards = document.querySelectorAll(".cv-card");

cards.forEach((card,i)=>{

card.style.opacity = 0;

setTimeout(()=>{

card.style.transition="0.5s";

card.style.opacity = 1;

}, i*200);

});

}