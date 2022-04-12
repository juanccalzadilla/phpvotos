<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
</head>
<body class="bg-danger">
    <div class="bg-white w-50 mx-auto my-5 p-4">
        <form class="" id="form">
            <label class="form-label">Email</label>
            <input type="text" class="form-control mx-auto mb-3" id="user" placeholder="Email@">
            <label class="form-label">Password</label>
            <input type="password" class="form-control m-auto" id="pass" placeholder="Password">
            <button type="submit" class=" btn btn-success w-100 my-3" id="btn-sub">Log in</button>
            <a type="button" class="btn btn-dark w-100 my-3" href="./registerVIEW.php"id="btn-up">Sign up</a>

        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="src/app.js"></script>

</body>

</html>