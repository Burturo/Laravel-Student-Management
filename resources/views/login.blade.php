<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <style>
    </style>
</head>
<body>
    <div class="container">
        <!-- Début du conteneur principal. -->
        <form action="{{ route('authentification') }}" method="post" class="conteneur card d-flex flex-row mx-auto">
            @csrf
            <!-- Début du formulaire de connexion. -->
            <div class="col-12 col-lg-6 p-4 d-flex flex-column">
                <div class="row text-center">
                    <h2>Connexion</h2>
                    <label>Salut, entrez vos coordonnées pour vous connecter</label>
                </div>
                <div class="mt-4">
                    <label for="InputEmail" class="form-label">Adresse mail</label>
                    <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" name="email" placeholder="Adresse E-mail" required>
                    <!-- Champ pour l'adresse email. -->
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2 mt-4">
                    <label for="InputPassword" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="InputPassword" aria-describedby="emailHelp" name="password" placeholder="Mot de Passe" required>
                    <!-- Champ pour le mot de passe. -->
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <input type="submit" name="submit" class="btn btn-bleu text-white my-4" value="Se Connecter">
                <!-- Bouton pour soumettre le formulaire. -->
                <div>
                    <div class="bottom-text text-center">
                        <p>Vous n'avez pas de compte ? <a class="register-link" href="{{ route('register') }}">S'inscrire</a></p>
                        <!-- Lien vers la page d'inscription si l'utilisateur n'a pas de compte. -->
                    </div>
                </div>
            </div>
            <div class="col d-none d-md-inline-flex">
                <div class="image-connexion">
                    <div class="image1">
                        <img width="100%" height="100%" class="img-logo" src="/images/azerty.jpg" alt="">
                        <!-- Image d'illustration pour la connexion. -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
