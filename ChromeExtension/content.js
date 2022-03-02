		 
var k = 0;
var progb = document.getElementById("bar");
var results = "";
var uid = 0;
 document.querySelector('form').addEventListener('submit', function (event, results) {
    event.preventDefault();
    var password = document.getElementById('password').value;
    //alert("1");
	chrome.storage.local.get(['uid'],function(result){
		// console.log('uid is ' + result.uid);
		uid = result.uid;
		//alert(uid);
	//});
	if(password === ""){
		alert("Error");
		return;
	}else{
          //alert("Error4");
          var xmlhttp = new XMLHttpRequest();
          var password = document.getElementById("password").value;  
          var data = "password=" +password + "&user_id=" + uid;
		  console.log(data);
		  xmlhttp.onreadystatechange = function() {
			  if (this.readyState == 4 && this.status == 200) { 

					
					
					//Converts the results into a JS object allowing it to be referenced like example below with length score. have also included a thing that shows the layout of the output sorry for messing with yours had to make sure i hadnt broke it and thought of a solution Sorry
					//{"scores":{"lengthScore":1,"capitalScore":1,"lowerScore":0,"numericScore":0,"complexScore":0,"repeatingScore":6,"consecutiveScore":0},"dict":{"exactMatch":true,"wordsInDict":true}}
					results = JSON.parse(this.responseText);
					if (results.dict.exactMatch == true){
						//document.getElementById("demo").innerHTML = 'LENGTH score ' + results.scores.lowerScore + ' and your password has been found in a dictionary';
						//alert(results.scores.capitalScore);
					}else{
						//document.getElementById("demo").innerHTML = 'your LENGTH score is ' + results.scores.lengthScore + ' and your password has not been found in a dictionary';
					}
					
					k = (results.scores.lengthScore * 2) + (results.scores.lowerScore * 1) + (results.scores.capitalScore * 2) + (results.scores.numericScore * 1) + (results.scores.complexScore * 3) + (results.scores.repeatingScore * 1) + (results.scores.consecutiveScore * 1);
					progb.value = k;
					progb.getElementsByTagName("span")[0].textContent = k;
					
					
/* 					document.getElementById("thing").innerHTML = 'overall score:' + k;
					document.getElementById("lower").innerHTML = 'lower score:' + results.scores.lowerScore;
					document.getElementById("upper").innerHTML = 'upper score:' + results.scores.capitalScore;
					document.getElementById("number").innerHTML = 'number score:' + results.scores.numericScore;
					document.getElementById("symbol").innerHTML = 'symbol score:' + results.scores.complexScore;
					document.getElementById("repeating").innerHTML = 'repeating score:' + results.scores.repeatingScore;
					document.getElementById("consecutive").innerHTML = 'consecutive score:' + results.scores.consecutiveScore; */
					
					
					
					if(results.scores.lengthScore < 2){
						var length = document.getElementById("lengthBox");
						length.style.backgroundColor = "#980404";
					}
 					if(results.scores.capitalScore < 2 || results.scores.numericScore < 2 || results.scores.complexScore < 2){
						var complex = document.getElementById("complexityBox");
						complex.style.backgroundColor = "#980404";
					}
					if(results.scores.repeatingScore < 2){
						var repeating = document.getElementById("repeatingBox");
						repeating.style.backgroundColor = "#980404";
					}
					if(results.scores.consecutiveScore < 2){
						var consecutive = document.getElementById("patternBox");
						consecutive.style.backgroundColor = "#980404";
					} 
					if(results.usedBefore == true){
						var reuse = document.getElementById("reusingBox");
						reuse.style.backgroundColor = "#980404";
					}
					if(results.dict.exactMatch == true && results.dict.wordsInDict == true){
						var dictionary = document.getElementById("dictionaryBox");
						dictionary.style.backgroundColor = "#980404";
					}
					
 				var ctx = document.getElementById('myChart');
				var myChart = new Chart(ctx, {
					type: 'radar',
					data: {
						
						labels: ['Length', 'Capital', 'Lower', 'Number', 'Symbol', 'Repeating', 'Pattern'],
						datasets: [{
							label: '',
							 borderWidth: 1,
							//
							data: [results.scores.lengthScore, results.scores.capitalScore, results.scores.lowerScore, results.scores.numericScore, results.scores.complexScore, results.scores.repeatingScore, results.scores.consecutiveScore],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
								'rgba(255, 99, 132, 1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],

						}]
					},
					options: {
						 scales: {
							 r: {
								angleLines: {
									display: false
								},
								suggestedMin: -1,
								suggestedMax: 6
							}
						 }
					}
				});  
			}		
		}

	}
				
	xmlhttp.open("POST", "https://***REMOVED***/~***REMOVED***/Super_Duper_Password_Utility_Tool_9001/main.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(data);

//alert(this.readyState);

//count(results);
//Where the storage.local bracket ends
	});
});
//Aidan Code 
/* function Advanced() {
 	var bar = document.getElementById("bar");
 	var chart = document.getElementById("chart");
 	if (bar.style.display === "none") {
 		bar.style.display = "block";
 		chart.style.display = "none";
 	} else {
 		bar.style.display = "none";
 		chart.style.display = "block";
 	}
} */

//Gordon Code
document.getElementById('Advanced').addEventListener('click',function(){
	//var link = document.getElementById('Advanced');
	//alert("test1")
	var bar = document.getElementById("bar");
	var chart = document.getElementById("chart");
	var txt = document.getElementById("txt");
	
	if (bar.style.display === "none") {
		bar.style.display = "block";
		chart.style.display = "none";
		txt.style.display = "none";
	} else {
		bar.style.display = "none";
		chart.style.display = "block";
		txt.style.display = "block";
	}
});

document.getElementById('FAQ').addEventListener('click',function(){
	//window.location.href = "https://***REMOVED***/~***REMOVED***/Super_Duper_Password_Utility_Tool_9001/FAQ.php";
	window.location.replace('./FAQ.php');
});
	
document.getElementById('lengthButton').addEventListener('click',function(){
	var content = document.getElementById("length");
	content.style.backgroundColor = "red";
	if (content.style.display === "none") {
		content.style.display = "block";
	}else{
		content.style.display = "none";
	}
});
document.getElementById('complexityButton').addEventListener('click',function(){
	var content = document.getElementById("complexity");
	
	if (content.style.display === "none") {
		content.style.display = "block";
	}else{
		content.style.display = "none";
	}
});
document.getElementById('repeatingButton').addEventListener('click',function(){
	var content = document.getElementById("repeating");
	
	if (content.style.display === "none") {
		content.style.display = "block";
	}else{
		content.style.display = "none";
	}
});
document.getElementById('patternButton').addEventListener('click',function(){
	var content = document.getElementById("pattern");
	
	if (content.style.display === "none") {
		content.style.display = "block";
	}else{
		content.style.display = "none";
	}
});
document.getElementById('reusingButton').addEventListener('click',function(){
	var content = document.getElementById("reusing");
	
	if (content.style.display === "none") {
		content.style.display = "block";
	}else{
		content.style.display = "none";
	}
});
document.getElementById('dictionaryButton').addEventListener('click',function(){
	var content = document.getElementById("dictionary");
	
	if (content.style.display === "none") {
		content.style.display = "block";
	}else{
		content.style.display = "none";
	}
});

document.getElementById("signin").addEventListener('click', function(){

	window.location.replace('./sign_in.html');
	

 });

var acc = document.getElementsByClassName("accordion");
for (var i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
		//alert("test");
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight) {
			panel.style.maxHeight = null;
		} else {
			panel.style.maxHeight = "500px"//panel.scrollHeight + "px";
		} 
	});
}