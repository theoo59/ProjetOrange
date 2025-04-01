<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alarme</title>
    <style>
        body {
            background-color: black;
            color: #FF7900;
            font-family: Arial, sans-serif;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 10px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 400px;
        }

        .logo {
            width: 100px;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .title {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
        }

        .box {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            color: white;
            width: 100%;
            max-width: 320px;
            margin-top: 20px;
        }

        /* Centrage et taille fixe des boutons */
        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .btn {
            border: none;
            padding: 12px 0;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
            text-decoration: none;
            text-align: center;
            width: 140px; /* Taille fixe */
            display: inline-block; /* Évite que <a> prenne toute la place */
        }

        /* Désactivation (orange comme le logo) */
        .btn-danger {
            background-color: #FF7900; /* Orange */
            color: black;
        }

        .btn-danger:hover {
            background-color: #e66a00; /* Teinte plus foncée d'orange */
            transform: scale(1.05);
        }

        /* Annuler (gris) */
        .btn-secondary {
            background-color: gray;
            color: white;
        }

        .btn-secondary:hover {
            background-color: darkgray;
            transform: scale(1.05);
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 480px) {
            .logo {
                width: 50px;
            }

            .title {
                font-size: 1.8rem;
            }

            .box {
                width: 90%;
            }

            .buttons {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/orange-logo.png') }}" alt="Logo" class="logo">
        <h1 class="title">Bienvenue !</h1>
        <div class="box">
            <h1>Désactivation de la chambre {{ $chambre->idChambre }}</h1>
            <form action="{{ route('chambre.desactiver.post', ['id' => $chambre->idChambre]) }}" method="POST">
                @csrf
                <div class="buttons">
                    <a href="{{ route('compterendu', ['id' => $chambre->idChambre]) }}" class="btn btn-danger">Désactiver</a>
                    <a href="{{ route('technicienDashboard') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
