<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
</head>
<style>
    body {
        position: relative;
        height: 100vh;
        padding: 0px;
        margin: 0px;
    }

    form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0px 0px 1px #00000047;
        border: 1px solid #cecece;
        width: 480px;
        height: 500px; 
    
        .form-header {
            display: grid;
            place-items: center;
            padding: 30px;
            margin: 0px;

            h4 {
                padding: 0px;
                margin: 0px;
            }
        }

        .form-body {
            padding: 30px;
            margin: 0px;

            .form-group {
                margin-bottom: 15px;
                padding: 0px;
                position: relative;

                i {
                    position: absolute;
                    top: 60%;
                    left: 13px;
                    font-size: 16px;
                    color: #8c8f92;
                }

                label {
                    font-size: 14px;
                    letter-spacing: .5px;
                    text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                    margin-bottom: 5px;
                }

                input {
                    border: 1px solid #dee2e6;
                    padding: 10px 40px 10px 40px;
                }

                input::placeholder {
                    font-size: 14px;
                    letter-spacing: .5px;
                    text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                    color: #8c8f92;
                }

                input:focus {
                    border: 1.5px solid #e74c3c;
                    border-color: #1f2328;
                    letter-spacing: .5px;
                    color: #1f2328;
                    outline: none;
                    box-shadow: 0px 0px 5px rgba(23, 32, 42, 0.8);
                }
            }
        }
    }
</style>
<body>
    <form action="{{ route('userLogin') }}" method="POST">
        @csrf
        <div class="form-header">
            <h5 class="form-title">Company Name</h5>
        </div>

        <div class="form-body">
            <div class="form-group">
                <i class="fa-solid fa-envelope"></i>
                <label for="inputUserName">Username</label>
                <input type="text" class="form-control" id="inputUserName" name="inputUserName" placeholder="Username">
            </div>
    
            <div class="form-group">
                <i class="fa-solid fa-lock"></i>
                <label for="inputUserPassword">Password</label>
                <input type="password" class="form-control" id="inputUserPassword" name="inputUserPassword" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</body>
</html>
