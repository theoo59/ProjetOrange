<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte Rendu</title>
    <style>
        body {
            background-color: black;
            color: #FF7900;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 800px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            margin-right: 15px;
        }

        h1 {
            font-size: 2rem;
            text-align: center;
        }

        .content {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            color: white;
            width: 100%;
            max-width: 800px;
        }

        textarea {
            width: 100%;
            height: 300px;
            background-color: #222;
            color: white;
            border: 1px solid #FF7900;
            padding: 10px;
            border-radius: 5px;
            font-size: 1rem;
            resize: none;
        }

        button {
            background-color: #FF7900;
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            color: black;
            margin-top: 10px;
            width: 100%;
            max-width: 300px;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #e66a00;
            transform: scale(1.05);
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                text-align: center;
            }

            .logo {
                width: 60px;
                margin-bottom: 10px;
                margin-right: 0;
            }

            h1 {
                font-size: 1.5rem;
            }

            .content {
                width: 90%;
                padding: 15px;
            }

            textarea {
                height: 200px;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ asset('images/orange-logo.png') }}" alt="Logo Orange" class="logo">
        <h1>Compte Rendu</h1>
    </div>

    <div class="content">
        <form action="{{ route('compterendu.store', ['id' => $chambre->idChambre]) }}" method="POST">
            <textarea name="compte_rendu" placeholder="Écrire le compte rendu de l'intervention ici..."></textarea>
            <button type="submit">Envoyer le compte rendu</button>
        </form>
    </div>

</body>
</html>
