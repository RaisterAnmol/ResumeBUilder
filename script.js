function setATSScore(score){

const progress = document.getElementById("gaugeProgress");
const needle = document.getElementById("needle");
const scoreText = document.getElementById("score");
const status = document.getElementById("status");

const circumference = 251;

let offset = circumference - (score/100) * circumference;

progress.style.strokeDashoffset = offset;

let rotation = (score * 1.8) - 90;

needle.style.transform = "rotate("+rotation+"deg)";

scoreText.innerHTML = score;

/* status message */

if(score < 40)
status.innerHTML = "Poor Resume";

else if(score < 70)
status.innerHTML = "Average Resume";

else if(score < 90)
status.innerHTML = "Good Resume";

else
status.innerHTML = "Excellent Resume";

}