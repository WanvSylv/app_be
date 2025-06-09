<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
               <!-- Profile Section -->
<li class="sidebar-item">
    <a class="sidebar-link has-arrow waves-effect waves-dark profile-dd" href="javascript:void(0)" aria-expanded="false">
        <img src="{{ asset('assets/images/users/1.jpg') }}" class="rounded-circle ms-2" width="30" height="30" alt="Photo de profil">
        <span class="hide-menu">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
        <li class="sidebar-item">
            <a href="{{ route('logout') }}" class="sidebar-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mdi mdi-logout"></i>
                <span class="hide-menu">Déconnexion</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>    
                <!-- Dashboard -->
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('dashboard') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                
              @role('SuperAdmin')
    <!-- Bibliothèque -->
    <li class="sidebar-item">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-library-books"></i>
            <span class="hide-menu">Bibliothèque</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
                <a href="{{ route('bibliotheques.create') }}" class="sidebar-link">
                    <i class="mdi mdi-plus-box"></i>
                    <span class="hide-menu">Ajout</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('bibliotheques.index') }}" class="sidebar-link">
                    <i class="mdi mdi-format-list-bulleted"></i>
                    <span class="hide-menu">Liste</span>
                </a>
            </li>
        </ul>
    </li>
@endrole

                
                <!-- Abonnés -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi-account-multiple"></i>
                        <span class="hide-menu">Abonnés</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('abonnes.create') }}" class="sidebar-link">
                                <i class="mdi mdi-account-plus"></i>
                                <span class="hide-menu">Ajout</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('abonnes.index') }}" class="sidebar-link">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span class="hide-menu">Liste</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Abonnements -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-cash-multiple"></i>
                        <span class="hide-menu">Abonnements</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('abonnements.create') }}" class="sidebar-link">
                                <i class="mdi mdi-plus-circle"></i>
                                <span class="hide-menu">Faire un abonnement</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('abonnements.index') }}" class="sidebar-link">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span class="hide-menu">Liste</span>
                            </a>
                        </li>
                    </ul>
                </li>

                 <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-book-open"></i>
                        <span class="hide-menu">Pêts</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('prets.create') }}" class="sidebar-link">
                                <i class="mdi mdi-plus-box"></i>
                                <span class="hide-menu">Ajout</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('prets.index') }}" class="sidebar-link">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span class="hide-menu">Liste des prêts</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Livres -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-book-open"></i>
                        <span class="hide-menu">Livres</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('livres.create') }}" class="sidebar-link">
                                <i class="mdi mdi-plus-box"></i>
                                <span class="hide-menu">Ajout</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('livres.index') }}" class="sidebar-link">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span class="hide-menu">Liste</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Catégories -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-label"></i>
                        <span class="hide-menu">Catégories</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('categories.create') }}" class="sidebar-link">
                                <i class="mdi mdi-plus-box"></i>
                                <span class="hide-menu">Ajout</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('categories.index') }}" class="sidebar-link">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span class="hide-menu">Liste</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
