<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travaux</title>
    <link rel="stylesheet" href="{{ asset('css/SidebarTest.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome-free-6.5.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
        <div class="sidebar close" id="side_nav">
            <div class="logo-details py-2">
                <i class="fa-solid fa-graduation-cap"></i>
                <span class="logo_name">Cours_Travaux</span>
                <i class="fa-solid ms-5  fa-xmark btn-ferme" type="button"></i>
            </div>
            <div class="profile mt-2 p-2">
                <img height="32px" class="img-profile" src="/images/img_profil.jpg"></i>
                <span class="profile_name ms-3">Burturo</span>
                <i class="fa-solid ms-5  fa-xmark btn-ferme" type="button"></i>
            </div>
            <ul class="nav-links">
                <li>
                    <a style="height: 50px;">
                        <i class="fa-solid fa-house"></i>
                        <span class="link_name">Tableau de bord</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name title-hover" href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    </ul>
                </li>
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class="fa fa-solid fa-person-chalkboard"></i>
                            <span class="link_name">Cours</span>
                        </a>
                        <i class="fa fa-solid fa-angle-down arrow"></i>
                    </div>
                    <ul class="sub-menu">
                        <li>
                            <a class="link_name title-hover titre border-bottom border-white mb-2" href="#">Cours</a>
                        </li>
                        <li>
                            <a href="{{ route('courses.index') }}">Liste des cours</a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <div class="iocn-link">
                        <a href="#">
                            <i class="bi bi-person-workspace"></i>
                            <span class="link_name">Travaux</span>
                        </a>
                        <i class="fa-solid fa-angle-down arrow"></i>
                    </div>
                    <ul class="sub-menu">
                        <li>
                            <a class="link_name title-hover titre border-bottom border-white mb-2" href="#">Travaux</a>
                        </li>
                        <li>
                            <a>Liste des travaux</a>
                        </li>
                    </ul>
                </li>
                <li class="footer">
                    <div class="footer-details">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <div class="footer-content">
                                <img src="/images/box-arrow-right.svg" alt="footer">
                            </div>

                            <div class="name-job">
                                <div class="footer_name">Se déconnecter</div>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="home-section">
            <nav class="navbar navbar-expand-md other position-fixed shadow">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2 side_btn" type="button"><i class="fa fa-stream"></i></button>
                    </div>
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-angle-down rotate-icon"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="navbar-element">
                            <div class="col d-flex align-items-center">
                                <i class="fa-solid fa-bars-staggered fa-bars"></i>
                                <h5 class="m-0 ms-3">Travaux</h5>
                            </div>
                            <div class="col-1 d-flex justify-content-between ">
                                <div class="notification">
                                    <i class="bi bi-bell"></i>
                                </div>
                                <button class="btn p-0 dropdown-toggle" type="button" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Fr
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><button class="dropdown-item"><img width="25px" src="/img/fr.png"> French</button></li>
                                    <li><button class="dropdown-item"><img width="25px" src="/img/en.png"> English</button></li>
                                </ul>

                                <i class="bi bi-gear"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="scroolAsignSubj h-100 px-4 pt-5 haut-rendbody">
                <div class="d-flex flex-column py-2 px-4 mt-3" style="height: 90vh;">
                    <h4 class="border-bottom border-black mb-2">Liste des travaux</h1>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="col-4">
                            <input class="search searchbar searchbartable py-1 bg-light " type="text" placeholder="search" />
                        </div>
                        <div class="col-3 d-flex justify-content-end">
                            @if ($userType !== 'Professeur')
                                <button type="button" class="btn btn-custom-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Envoyer
                                </button>
                            @endif
                        </div>
                    </div>

                    @if ($userType !== 'Professeur')
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr class="trline">
                                    <th class="tdline">Code</th>
                                    <th class="tdline">Libellé</th>
                                    <th class="tdline">Description</th>
                                    <th class="tdline">Type</th>
                                    <th class="tdline">Document</th>
                                    <th class="tdline">Date</th>
                                    <th class="tdline text-end">
                                        <div class="position-text-action">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($travaux as $travail)
                                    <tr>
                                        <td>{{ $travail->id }}</td>
                                        <td>{{ $travail->displayname }}</td>
                                        <td>{{ $travail->description }}</td>
                                        <td>{{ $travail->type }}</td>
                                        <td>
                                            @if($travail->document)
                                                <a href="{{ asset('storage/' . $travail->document) }}" target="_blank">Voir le document</a>
                                            @else
                                                Aucun document
                                            @endif
                                        </td>
                                        <td>{{ $travail->due_date }}</td> <!-- Assurez-vous que 'date' est un objet Date valide -->
                                        <td class="tdline d-flex justify-content-end my-1">
                                            <a href="#" class="btn btn-outline-primary me-2"><i class="fa-regular fa-eye"></i></a>
                                            <a href="#" class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $travail->id }}"><i class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $travail->id }}"><i class="fa-regular fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr class="trline">
                                        <th class="tdline">Code</th>
                                        <th class="tdline">Libellé</th>
                                        <th class="tdline">Description</th>
                                        <th class="tdline">Expéditeur</th>
                                        <th class="tdline">Type</th>
                                        <th class="tdline">Document</th>
                                        <th class="tdline text-end">
                                            <div class="position-text-action">Action</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($travaux as $travail)
                                        <tr>
                                        <td>{{ $travail->id }}</td>
                                        <td>{{ $travail->displayname }}</td>
                                        <td>{{ $travail->description }}</td>
                                        <td>{{ $travail->Person->firstname }}</td>
                                        <td>{{ $travail->type }}</td>

                                        <td>
                                            @if($travail->document)
                                                <a href="{{ asset('storage/' . $travail->document) }}" target="_blank">Voir le document</a>
                                            @else
                                                Aucun document
                                            @endif
                                        </td>
                                            <td class="tdline d-flex justify-content-end">
                                                <form action="{{ route('travaux.download', $travail->id) }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="btn btn-custom-primary text-white my-1"><i class="fa-solid fa-download"></i>  Télécharger</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            @endif

                @foreach ($travaux as $travail)
                        <div class="modal fade" id="editModal{{ $travail->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel{{ $travail->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $travail->id }}">Modifier le travail</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('travaux.update', $travail->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Libellé</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $travail->displayname }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description">{{ $travail->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="type" class="form-label">Type de cours :</label>
                                                <select class="form-select" aria-label="Default select example" id="type" name="type">
                                                    <option value="" {{ $travail->type == '' ? 'selected' : '' }}>Sélectionner le type de cours</option>
                                                    <option value="TP" {{ $travail->type == 'TP' ? 'selected' : '' }}>Travaux Pratique</option>
                                                    <option value="TD" {{ $travail->type == 'TD' ? 'selected' : '' }}>Travaux Dirrigé</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="file">Document</label>
                                                <input type="file" class="form-control" id="file" name="file">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Modifier</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="deleteModal{{ $travail->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel{{ $travail->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $travail->id }}">Supprimer le cours</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('travaux.destroy', $travail->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <p>Êtes-vous sûr de vouloir supprimer ce cours ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Créer un nouveau travail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for creating a new course -->
                        <form action="{{ route('travaux.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nom :</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Entrez le nom du cours">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Type de cours :</label>
                                <select class="form-select" aria-label="Default select example" name="type">
                                    <option value="" selected>Sélectionner le type de cours</option>
                                    <option value="TP">Travaux Pratique</option>
                                    <option value="TD">Travaux Dirrigé</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Télécharger un fichier</label>
                                <input class="form-control" type="file" id="formFile" name="file">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


          <!-- Modal -->

  <script src="{{ asset('js/SidebarTest.js') }}" asp-append-version="true"></script>
    <script src="{{ asset('js/jquery.min.js') }}" asp-append-version="true"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" asp-append-version="true"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
