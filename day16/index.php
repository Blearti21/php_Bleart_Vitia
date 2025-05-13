<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">

<body>
<style>


html,
body {
height: 100%;
}


body {
display: flex;
align-items: center;
padding-top: 40px;
padding-bottom: 40px;
background-color: #f5f5f5;
}


.form-signin {
width: 100%;
max-width: 330px;
padding: 15px;
margin: auto;
}


.form-signin .checkbox {
font-weight: 400;
}


.form-signin .form-floating:focus-within {
z-index: 2;
}


.form-signin input[type="email"] {
margin-bottom: -1px;
border-bottom-right-radius: 0;
border-bottom-left-radius: 0;
}


.form-signin input[type="password"] {
margin-bottom: 10px;
border-top-left-radius: 0;
border-top-right-radius: 0;
}
.form-floating{
margin: 10px;
}
</style>
</head>
 <body class="text-center">
    <main class="form-signin">
        <form action="register.php" method="post">
            <img class="mb-4" src="https://www.google.com/imgres?q=digital%20school&imgurl=https%3A%2F%2Fictkosovo.eu%2Fwp-content%2Fuploads%2F2023%2F03%2Fdigital-school-1.png&imgrefurl=https%3A%2F%2Fictkosovo.eu%2Fdigital-school%2F&docid=RHIjYeK3u3M_1M&tbnid=Y-rtKphUpjGxpM&vet=12ahUKEwiK4dDqh6GNAxUORfEDHWazDuoQM3oECGwQAA..i&w=768&h=768&hcb=2&ved=2ahUKEwiK4dDqh6GNAxUORfEDHWazDuoQM3oECGwQAA" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Register</h1>

            <div class="form-floating">
                <input type="text" name="form-control" id="floatingInput" placeholder="Emri" name="emri">
                <label for="flotingInput">Emri </label>
            </div>
            <div class="form-floating">
                <input type="text" name="form-control" id="floatingInput" placeholder="Username" name="username">
                <label for="flotingInput">Username </label>
            </div>
            <div class="form-floating">
                <input type="email" name="form-control" id="floatingInput" placeholder="Email" name="email">
                <label for="flotingInput">Email </label>
            </div>
            <div class="form-floating">
                <input type="password" name="form-control" id="floatingInput" placeholder="Password" name="password">
                <label for="flotingInput">password </label>
            </div>
            <div class="form-floating">
                <input type="password" name="form-control" id="floatingInput" placeholder="Confirm Password" name="confirm_Password">
                <label for="flotingInput">Confirm Password  </label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember me">
                </label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign up</button>
            <span> Already have an account: </span> <a href="login.php">Sign in</a>



        </form>
    </main>

</body>
</html>