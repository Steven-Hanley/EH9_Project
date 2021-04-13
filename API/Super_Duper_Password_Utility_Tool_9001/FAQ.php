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
        <h1 id="title">Frequently Asked Questions</h1>
        <div class="accordion-setup">
            <div class="card">
                <button class="accordion">Example 1</button>
                <div class="panel">
                    <p>asdasd</p>
                </div>
            </div>
            <div class="card">
                <button class="accordion">Example 2</button>
                <div class="panel">
                    <p>asdasd</p>
                </div>
            </div>
            <div class="card">
                <button class="accordion">Example 3</button>
                <div class="panel">
                    <p>asdasd</p>
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