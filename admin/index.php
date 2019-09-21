<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <style>
        body{
            background: #8a2020
        }

        div.loginContainer{
            display: flex;
            align-items: center;
            height: 100%;
        }

        div.login{
            padding: 20px 35px;
            border-radius:5px;
            background: rgba(255,255,255,0.2);
            box-shadow: 0px 0px 6px 0px #fff;
        }

        label{
            color: #fff
        }

        .btn{
            background: #8a2020;
            color: #fff
        }

        div#forgotPW{
            margin-top:-4px;
            text-align:center;
        }
        
       a#forgotPassword{
           color: #fff;
       } 
    </style>
    
    <div class="loginContainer">
        <div class='col-3 login container'>
            <form method="post" action="sezioni">
                <div class='form-group'><label for='username'><small>Username</small></label><input type='text' name='username' class='form-control' required/></div>
                <div class='form-group'><label for='password'><small>Password</small></label><input type='password' name='password' class='form-control' required/></div>
                <div class='form-group'><input type='submit' name='submit' value='Accedi' class='btn form-control'/></div>
            </form>
        </div> 
    </div>