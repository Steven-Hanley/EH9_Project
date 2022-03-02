
document.getElementById('sign_in').addEventListener('click',function(event)
{    
event.preventDefault();
const username = document.getElementById('username').value;
var password = document.getElementById('password').value;

if(username && password)
{  
    var xmlhttp = new XMLHttpRequest();
    var data ="username=" + username + "&password=" + password;
    //alert(data);
    xmlhttp.onreadystatechange = function()
    {
        if(this.readyState==4|| this.responseText==200)
        { 
                   
                var result = JSON.parse(xmlhttp.responseText);
                
                
                 if(result.status=="login")
                 {    
                    var uid = result.cookie;
                     chrome.storage.local.set({'uid': uid},function(){
                         console.log("uid is" + uid);
                     });
                     
                alert('You have successfully logged in.')
                 window.location.replace("./PasswordCheck.html");
                 }else{
                     console.log(result);
                     alert('nope');
                     window.location.reload();

                }
        }

    }
        xmlhttp.open("POST", "https://***REMOVED***/~***REMOVED***/Super_Duper_Password_Utility_Tool_9001/connection.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded",false);
        xmlhttp.send(data);  

}



        
});
