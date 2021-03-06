<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-airplay mr-1"></i> {{__('tableau de bord')}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                            <a href="{{route('home')}}" class="dropdown-item">{{__('tableau de bord')}}</a>
                            {{--                            <a href="{{route('any', 'dashboard-2')}}" class="dropdown-item">Dashboard 2</a>--}}
                            {{--                            <a href="{{route('any', 'dashboard-3')}}" class="dropdown-item">Dashboard 3</a>--}}
                            {{--                            <a href="{{route('any', 'dashboard-4')}}" class="dropdown-item">Dashboard 4</a>--}}
                        </div>
                    </li>
                    @hasrole('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="dripicons-store"></i> {{__('Agences')}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                            <a href="{{route('agencies.index')}}" class="dropdown-item">{{__('Liste des Agences')}}</a>
                            <a href="{{route('agencies.create')}}" class="dropdown-item">{{__('Cr??er une Agence')}}</a>
                        </div>
                    </li>
                    @endhasrole
                    @unlessrole('user')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="dripicons-user"></i> {{__('Utilisateurs')}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                            <a href="{{route('users.index')}}" class="dropdown-item">{{__('Liste des Utilisateurs')}}</a>
                            <a href="{{route('users.create')}}" class="dropdown-item">{{__('Cr??er un Utilisateur')}}</a>
                        </div>
                    </li>
                    @endunlessrole
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="dripicons-user"></i> {{__('Clients')}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                            <a href="{{route('clients.index')}}" class="dropdown-item">{{__('Liste des Clients')}}</a>
                            @hasrole('admin')
                            <a href="{{route('socials.index')}}" class="dropdown-item">{{__('Liste des Sociales')}}</a>
{{--                            <a href="{{route('socials.create')}}" class="dropdown-item">{{__('Cr??er une Pers.Sociale')}}</a>--}}
                            @endhasrole
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-card-account-details-outline"></i> {{__('Abonnements')}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-card-account-details-outline"></i> {{__('Abonnements')}} <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                    <a href="{{route('subscriptions.index')}}" class="dropdown-item">{{__('Liste des Abonnements')}}</a>
                                    @unlessrole('admin')
                                    <a href="{{route('subscriptions.create')}}" class="dropdown-item">{{__('Cr??er un Abonnement')}}</a>
                                    @endunlessrole
                                </div>
                            </div>

{{--                            <div class="dropdown">--}}
{{--                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"--}}
{{--                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    <i class="mdi mdi-card-bulleted-outline"></i> {{__('Cat??gories')}} <div class="arrow-down"></div>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu" aria-labelledby="topnav-email">--}}
{{--                                    <a href="{{route('subscriptionCategories.index')}}" class="dropdown-item">{{__('Liste des Categories')}}</a>--}}
{{--                                    <a href="{{route('subscriptionCategories.create')}}" class="dropdown-item">{{__('Cr??er une Categorie')}}</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            @hasrole('admin')--}}
{{--                            <div class="dropdown">--}}
{{--                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"--}}
{{--                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    <i class="mdi mdi-update"></i> {{__('P??riodes')}} <div class="arrow-down"></div>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu" aria-labelledby="topnav-email">--}}
{{--                                    <a href="{{route('subscriptionPeriods.index')}}" class="dropdown-item">{{__('Liste des P??riodes')}}</a>--}}
{{--                                    <a href="{{route('subscriptionPeriods.create')}}" class="dropdown-item">{{__('Cr??er une P??riode')}}</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @endhasrole--}}
                        </div>
                    </li>
                    @hasrole('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-shuffle"></i> {{__('Lignes')}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-shuffle"></i> {{__('Lignes')}} <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                    <a href="{{route('lines.index')}}" class="dropdown-item">{{__('Liste des Lignes')}}</a>
                                    <a href="{{route('lines.create')}}" class="dropdown-item">{{__('Cr??er une ligne')}}</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe-mail mr-1"></i> {{__('Stations')}} <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <a href="{{route('stations.index')}}" class="dropdown-item">{{__('Liste des Station')}}</a>
                                    <a href="{{route('stations.create')}}" class="dropdown-item">{{__('Cr??er une Station')}}</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bus-alt mr-1"></i> {{__('Bus')}} <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <a href="{{route('buses.index')}}" class="dropdown-item">{{__('Liste des Bus')}}</a>
                                    <a href="{{route('buses.create')}}" class="dropdown-item">{{__('Cr??er un Bus')}}</a>
                                </div>
                            </div>

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-school"></i> {{__('Etablissments')}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                            <a href="{{route('institutions.index')}}" class="dropdown-item">{{__('Liste des Etablissements')}}</a>
                            <a href="{{route('institutions.create')}}" class="dropdown-item">{{__('Cr??er une Etablissement')}}</a>
                        </div>
                    </li>
                    @endhasrole
                    @unlessrole('user')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-archive"></i> {{__('Stock')}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topnav-apps">
                            <div class="dropdown dropdown-menu-right">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="dripicons-user-id"></i> {{__('Stock')}} <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu " aria-labelledby="topnav-ecommerce">
                                    <a href="{{route('chains.index')}}" class="dropdown-item">{{__('Reception des stocks')}}</a>
                                    <a href="{{route('chains.create')}}" class="dropdown-item">{{__('Ajouter un Stock')}}</a>
                                </div>
                            </div>
                            <div class="dropdown dropdown-menu-right">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class=" mdi mdi-archive-arrow-down"></i> {{__('Demandes')}} <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                    <a href="{{route('demands.index')}}" class="dropdown-item">{{__('Liste des Demandes')}}</a>
                                    @hasrole('supervisor')
                                    <a href="{{route('demands.create')}}" class="dropdown-item">{{__('Cr??er une Demande')}}</a>
                                    @endhasrole
                                </div>
                            </div>
                            {{--                            <div class="dropdown">--}}
                            {{--                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"--}}
                            {{--                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                            {{--                                    <i class="mdi mdi-archive-arrow-up"></i> {{__('Livraisons')}} <div class="arrow-down"></div>--}}
                            {{--                                </a>--}}
                            {{--                                <div class="dropdown-menu" aria-labelledby="topnav-email">--}}
                            {{--                                    <a href="{{route('deliveries.index')}}" class="dropdown-item">{{__('Liste des Livraisons')}}</a>--}}
                            {{--                                    <a href="{{route('deliveries.create')}}" class="dropdown-item">{{__('Cr??er une Livraison')}}</a>--}}
                            {{--                                     </div>--}}
                            {{--                            </div>--}}
                            <div class="dropdown dropdown-menu-right">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-arrow-collapse-left"></i> {{__('Retour Stock')}} <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <a href="{{route('declarations.index')}}" class="dropdown-item">{{__('Liste des Retours')}}</a>
                                    @hasrole('supervisor')
                                    <a href="{{route('declarations.create')}}" class="dropdown-item">{{__('Cr??er un Retour')}}</a>
                                    @endhasrole
                                </div>
                            </div>
                        </div>
                    </li>
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a href="#" class="nav-link dropdown-toggle arrow-none"  id="topnav-dashboard" role="button"--}}
{{--                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            <i class="dripicons-graph-line"></i> {{__('Rapports')}}--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu" aria-labelledby="topnav-dashboard">--}}
{{--                            <a href="{{route('rapports')}}" class="dropdown-item">{{__('Liste des Rapports')}}</a>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle arrow-none"  id="topnav-dashboard" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="dripicons-archive"></i> {{__('Logs')}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topnav-dashboard">
                            <a href="{{route('logs.index')}}" class="dropdown-item">{{__('Liste des logs')}}</a>
                        </div>
                    </li>
                    @endunlessrole

                    </li>


                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> <!-- end topnav-->
