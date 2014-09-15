<!DOCTYPE html>
<html>
    <head>
        <title>&#9730; morning rain alert - free morning rain check SMS service</title>
        <link href='http://fonts.googleapis.com/css?family=Dosis|Chau+Philomene+One' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="scripts/jquery.textbox-hinter.min.js"></script>
        <style>
            h1 {
                font-family: 'Chau Philomene One', sans-serif;
            }
            p {
                font-family: 'Dosis', sans-serif;
                color: #222;
                text-align: justify;
            }
            a {
                color: #222;
            }
            #container {
                width: 400px;
                margin-left: auto;
                margin-right: auto;
                padding: 30px;
            }
            #contact {
                margin-left: 20px;
            }
            img {
                vertical-align: middle;
            }
            .hint {
                color: #888;
            }
            .field input {
                height: 100%;
                width: 100%;
                border: 1px solid #222;
                padding: 5px;
                margin-left: 10px;
            }
            .note {
                font-style: italic;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#zipcode').tbHinter({
                    text: '90210 ',
                    styleClass: 'hint'
                });
                $('#mobile').tbHinter({
                    text: '212 555 5555',
                    styleClass: 'hint'
                });
                $('#email').tbHinter({
                    text: 'first.last@gmail.com',
                    styleClass: 'hint'
                });
                $("#subscribe").submit(function() {
                    var zipcode = $("#zipcode").val();
                    var mobile = $("#mobile").val();
                    var email = $("#email").val();
                    if (zipcode.length != 5) {
                        alert("Please enter a 5-digit zip code in the first field.");
                        return false;
                    }
                    if (mobile == "212 555 5555" && email == "first.last@gmail.com") {
                        alert("Please enter a phone number or an email address.");
                        return false;
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="container">
            <h1>&#9730; morning rain alert</h1>
            <p>
                Thanks for signing up for rain alerts! You'll hear
                back from us at 7am if it's going to rain.
            </p>
            <p>
                To unsubscribe, simply go back to <a href="http://morningraincheck.com">
                the home page</a>, enter your phone number and email, and press
                the unsubscribe button.
            </p>
    </body>
</html>
