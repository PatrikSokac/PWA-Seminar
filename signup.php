<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript" src="jquery-1.11.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>

    <script>        
        $(function() {
            $("form[name='registracija']").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 5,
                    
                },
                Email: {
                    required: true,
                    minlength: 5,
                    
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                password_confirmation:{
                    required: true,
                    equalTo: "#password",
                }
            },
            messages: {
                username: {
                    required: "Potrebno je upisati username",
                    minlength: "Username nesmije biti manje od 5 znakova",
                },
                Email: {
                    required: "Potrebno je upisati Email",
                    minlength: "Email nesmije biti manje od 5 znakova",
                },
                password: {
                    required: "Potrebno je upisati lozinku",
                    minlenght: "Lozinka nesmije biti manje od 8 znakova",
                },
                password_confirmation: {
                    required: "Potrebno je upisati lozinku",
                    equalTo: "Lozinke trebaju biti iste"
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
            });
        });
    </script>
</head>
<body>
    <header style="background-color: #8ae4ff;">
        <div class="header-flex">
            <img src="slike/logo.png" alt="Logo">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#" style="color: #fff;">Registriraj se</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="conteiner">
        <form id="signupForm" action="process-signup.php" method="post" name="registracija">

            <div>
                <label for="username">Username: </label>
                <input type="text" id="username" name="username">
            </div>

            <div>
                <label for="Email">Email: </label>
                <input type="text" id="Email" name="Email">  
            </div>

            <div>
                <label for="password">Password: </label>
                <input type="password" id="password" name="password">  
            </div>

            <div>
                <label for="password_confirmation">Confirm password: </label>
                <input type="password" id="password_confirmation" name="password_confirmation">  
            </div>

            <button type="submit">Sign Up</button>
        </form>
    </div>
    
    <footer style="background-color: #8ae4ff;">
        <p>Patik Sokac 13.06.2024 | Tehničko Veleučilište Zagreb | Home</p>
    </footer>
</body>
</html>
