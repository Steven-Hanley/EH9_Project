<!DOCTYPE html>
<title>FAQ</title>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        * {
            box-sizing: border-box;
        }

        .accordion {
            max-width: 600px;
            display: block;
            margin: 10px auto;
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }

        body {
            margin: 0;
            font-family: sans-serif;
        }

        .container {
            max-width: 600px;
            display: block;
            margin: 10px auto;
        }

        .card {
            float: inherit;
        }

        #title {
            text-align: center;
        }

        .active, .accordion:hover {
            background-color: #ccc;
        }

        .accordion:after {
            content: '\002B';
            color: #777;
            font-weight: bold;
            float: right;
            margin-left: 5px;
        }

        .active:after {
            content: "\2212";
        }

        .panel {
            padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;

            max-width: 600px;
            display: block;
            margin: 10px auto;
        }
    </style>
</head> 
<body>
    <div class="container">
        <h2 id="title">Frequently Asked Questions: Super Duper Password Utility Tool 9001</h1>
        <div class="accordion-setup">
            <div class="card">
                <button class="accordion">
                    What is Super Duper Password Utility Tool 9001</button>
                <div class="panel">
                    <p>A tool developed for Chrome and Android applications
                    designed to help Abertay students with their password security.
                    It is designed to educate users on their passwords and how they
                    can create more secure passwords.</p>
                </div>
            </div>
            <div class="card">
                <button class="accordion">
                How does it work?</button>
                <div class="panel">
                    <p>The application is designed to be intuitive to
                    all levels of users and uses two main methods of displaying
                    advice to users. Users who submit their password via the form
                    are immediately assessed on the quality and characteristics of 
                    their passwords via textual output. They are then given the
                    option to view a radar graph which allows for further details on all
                    characterisitcs of that submitted password to be shown to the user.
                    <br><br>
                    Staff and students who have their accounts signed in with the system
                    can also submit their passwords and be offered to save that password 
                    into the system, allowing the application to tell if that same user
                    is reusing that password. The application is also available without being 
                    a member of Abertay university, however the application will not store or 
                    display data about password reuse for that unauthenticated user.
                    </p>
                </div>
            </div>
            <div class="card">
                <button class="accordion">
                What is a Radar Graph</button>
                <div class="panel">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    
    <!--
    <div class="container">
        <div class="accordion">
            <div class="card">
                <div class="card-header">
                    <h1>Example 1 <span class="fa fa-minus"></span></h1>
                </div>
                <div class="card-body">
                    <p>asdasd</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1>Example 2 <span class="fa fa-plus"></span></h1>
                </div>
                <div class="card-body">
                    <p>asdasd</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1>Example 3 <span class="fa fa-plus"></span></h1>
                </div>
                <div class="card-body">
                    <p>asdasd</p>
                </div>
            </div>
        </div>
    </div>
    -->
    

    <script>
        var acc = document.getElementsByClassName("accordion");
        for (var i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                } 
            });
        }
    </script>
</body>
</html>