
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, ">
    <meta name="description" content="Ample is powerful and clean admin dashboard template, inpired from Google's Material Design">
    <meta name="robots" content="noindex,nofollow">
    <title>Gestion bibliotheque</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ampleadmin/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
   
</head>

<body>
    <div class="main-wrapper">
        <script>
            document.querySelector('form').addEventListener('submit', function(event) {
                console.log('Formulaire soumis', new FormData(this));
            });
         </script>
            
        <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#233242" stroke-width="2"></path>
          <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#233242" stroke-width="2"></path>
          <path id="teabag" fill="#233242" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
          <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#233242"></path>
          <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#233242" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
        
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box p-4 bg-white rounded">
                <div>
                    <div class="logo text-center">
                        <span class="db"><img src="{{ asset('assets/images/logos/logo-icon.png') }}" alt="logo" /></span>
                        <h5 class="font-weight-medium mb-3 mt-1">INSCRIPTION</h5>
                    </div>
                    <!-- Form -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control form-input-bg" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Votre nom" required>
                                    <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                                </div>
                                
                                <div class="mb-3">
                                    <label for="prenom">Prénoms</label>
                                    <input type="text" class="form-control form-input-bg" id="prenom" name="prenom" value="{{ old('prenom') }}" placeholder="Vos prénoms" required>
                                    <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                                </div>
                                
                                <div class="mb-3">
                                    <label for="tel">Numéro de téléphone</label>
                                    <input type="text" class="form-control form-input-bg" id="tel" name="tel" value="{{ old('tel') }}" placeholder="Votre numéro" required>
                                    <x-input-error :messages="$errors->get('tel')" class="mt-2" />
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email">Adresse email</label>
                                    <input type="email" class="form-control form-input-bg" id="email" name="email" value="{{ old('email') }}" placeholder="Votre email" required>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control form-input-bg" id="password" name="password" placeholder="*****" required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_confirmation">Confirmer le mot de passe</label>
                                    <input type="password" class="form-control form-input-bg" id="password_confirmation" name="password_confirmation" placeholder="*****" required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                                
                                <div class="mb-3">
                                    <label for="bibliotheque_id">Bibliothèque</label>
                                    <select class="form-control" id="bibliotheque_id" name="bibliotheque_id" required>
                                        <option value="">-- Sélectionnez --</option>
                                        @foreach($bibliotheques as $bibliotheque)
                                            <option value="{{ $bibliotheque->id }}" {{ old('bibliotheque_id') == $bibliotheque->id ? 'selected' : '' }}>
                                                {{ $bibliotheque->nom }} {{ $bibliotheque->ville }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('bibliotheque_id')" class="mt-2" />
                                </div>
                                
                                <div class="mb-3">
                                    <input type="checkbox" id="checkbox-signup" name="checkbox-signup" required>
                                    <label for="checkbox-signup">J'accepte les termes et conditions</label>
                                </div>
                                
                                <div class="text-center">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">S'inscrire</button>
                                </div>
                            </form>
                            
                            <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.querySelector('form').addEventListener('submit', function(event) {
                                    console.log('Formulaire soumis', new FormData(this));
                                });
                            });
                            </script>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }} "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $(".preloader ").fadeOut();
    </script>
</body>

</html>