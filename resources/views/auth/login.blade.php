<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background-color: #222;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        .login-box input {
            background-color: #444;
            border: none;
            color: white;
        }
        .login-box input::placeholder {
            color: #bbb;
        }
        .btn-orange {
            background-color: #FF7900;
            border: none;
            color: black;
        }
        .btn-orange:hover {
            background-color: darkorange;
        }
        .logo {
            width: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="{{ asset('images/orange-logo.png') }}" alt="Logo" class="logo">
        <h2 class="mb-3">Connexion</h2>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="ldap" class="form-control" placeholder="Identifiant LDAP (8 chiffres)" required pattern="\d{8}">
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="btn btn-orange w-100">Se connecter</button>
        </form>
    </div>
</body>
</html>


