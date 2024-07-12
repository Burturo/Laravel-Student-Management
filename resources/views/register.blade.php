<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
  <div class="container">
    <form method="POST" action="{{ route('registration') }}" class="conteneur card d-flex flex-row mx-auto">
      @csrf
      <div class="col-12 col-lg-6 p-4 d-flex flex-column">
        <div class="text-center">
          <h2>Inscription</h2>
        </div>
        <!-- Nom d'utilisateur -->
        <div class="mb-2 mt-4">
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Nom d'utilisateur">
          @error('name')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <!-- Adresse E-mail -->
        <div class="mb-2 mt-4">
          <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="Adresse E-mail">
          @error('email')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <!-- Mot de Passe -->
        <div class="mb-2 mt-4">
          <input type="password" class="form-control" id="password" name="password" required placeholder="Mot de Passe">
          @error('password')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <!-- Confirmez le mot de passe -->
        <div class="mb-2 mt-4">
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Confirmez le mot de passe">
        </div>
        <!-- Direction -->
        <div class="mb-2 mt-4">
          <select class="form-select" name="direction" required>
            <option value="" disabled selected>Sélectionner la direction</option>
            <option value="Etudiant">Etudiant</option>
            <option value="Professeur">Professeur</option>
          </select>
          @error('direction')
              <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <!-- Bouton pour soumettre le formulaire -->
        <input type="submit" name="submit" class="btn btn-bleu my-4" value="S'inscrire">
        <!-- Lien vers la page de connexion -->
        <div class="form-btn text-center">
          <p>Vous avez déjà un compte ? <a class="register-link" href="{{ route('login') }}">Retour</a></p>
        </div>
      </div>
      <div class="col d-none d-md-inline-flex">
        <div class="image-connexion">
          <div class="image">
            <img width="100%" height="100%" class="img-logo" src="/images/programme.jpg" alt="">
          </div>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
