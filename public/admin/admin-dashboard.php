<?php
session_start();
require_once '../../autoload.php';
require_once '../../classes/users/Admin.php';
// require_once '../process-categorie.php';
// require_once '../../config/config.php';
// require_once '../../classes/utils/PageManager.php'

// PageManager::setTitle("Admin-Tableau de bord");
// PageManager::setDescription("Tableau de Bord de l'Administrateur UDEMY");

// include '../../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$users = Admin::getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                extend: {
                    colors: {
                    clifford: '#da373d',
                    primary : '#002147',
                    primaryhover : '#022e61',
                    secondary : '#FDC800',
                    secondaryhover : '#dbfd00'
                    }
                }
                }
            }
        </script>
        <title>Document</title>
    </head>
    <body>
        <!-- NAVBAR START -->
        <nav class="relative px-4 py-4 flex justify-between items-center bg-primary">
            <a class="text-3xl font-bold leading-none" href="#">
                <div class="logo w-1/4">
                </div>
            </a>
            <div class="lg:hidden">
                <button class="navbar-burger flex items-center text-secondary p-3">
                    <svg class="block h-5 w-5 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Mobile menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg>
                </button>
            </div>
            <ul class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6">
                <li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Accueil</a></li>
                <li class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </li>
                <li><a class="text-sm text-secondary font-bold" href="#">A propos</a></li>
                <li class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </li>
                <li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Cours</a></li>
                <li class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </li>
                <li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Nous Contacter</a></li>
                <li class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </li>
            </ul>
            <a class="hidden lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-white hover:bg-gray-100 text-sm text-primary font-bold  rounded-xl transition duration-200" href="#">S'inscrire</a>
            <a class="hidden lg:inline-block py-2 px-6 bg-secondary hover:bg-secondaryhover text-sm text-primary font-bold rounded-xl transition duration-200" href="../public/login.php">Se Connecter</a>
        </nav>
        <div class="navbar-menu relative z-50 hidden">
            <div class="navbar-backdrop fixed inset-0 bg-primary opacity-25"></div>
            <nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-primary border-r border-primary overflow-y-auto shadow-2xl">
                <div class="flex items-center mb-8">
                    <a class="mr-auto text-3xl font-bold leading-none" href="#">
                        <div class="logo w-1/4">
                            <img src="../public/assets/imgs/logo.png" alt="logo-udemy">
                        </div>
                    </a>
                    <button class="navbar-close">
                        <svg class="h-6 w-6 text-secondary cursor-pointer hover:text-secondaryhover" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <ul>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-gray-100 hover:bg-primaryhover hover:text-white rounded" href="#">Accueil</a>
                        </li>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-gray-100 hover:bg-primaryhover hover:text-white rounded" href="#">A propos</a>
                        </li>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-gray-100 hover:bg-primaryhover hover:text-white rounded" href="#">Cours</a>
                        </li>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-gray-100 hover:bg-primaryhover hover:text-white rounded" href="#">Nous Contacter</a>
                        </li>
                    </ul>
                </div>
                <div class="mt-auto">
                    <div class="pt-6">
                        <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center text-primary font-semibold leading-none bg-white hover:bg-gray-100 rounded-xl" href="#">S'inscrire</a>
                        <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-primary font-semibold bg-secondary hover:bg-secondaryhover rounded-xl" href="#">Se Connecter</a>
                    </div>
                    <p class="my-4 text-xs text-center text-gray-400">
                        <span>Copyright © 2025</span>
                    </p>
                </div>
            </nav>
        </div>
        <!-- NAVBAR END -->
        <div class="">
            <!-- SIDEBAR START -->
            <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
            </button>
            <aside id="default-sidebar" class="fixed top-0 left-0 w-72 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-primary">
                    <ul class="space-y-2 font-medium">
                        <li>
                            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <img src="../assets/imgs/logo.png" alt="logo-udemy">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-secondary rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="flex-shrink-0 w-5 h-5 text-secondary transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">GESTION DES UTILISATEURS</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-secondary rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="flex-shrink-0 w-5 h-5 text-secondary transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" 
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 2a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h2a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3H5Zm0 9a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h2a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3H5Zm8-7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-2a3 3 0 0 1-3-3V5Zm3 9a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h2a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3h-2Z"/>
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">GESTION DES CATEGORIES</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-secondary rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="flex-shrink-0 w-5 h-5 text-secondary transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" 
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M17.707 10.293 9.707 2.293A1 1 0 0 0 9 2H3a1 1 0 0 0-1 1v6c0 .266.105.52.293.707l8 8a1 1 0 0 0 1.414 0l6-6a1 1 0 0 0 0-1.414ZM4.5 7.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"/>
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">GESTION DES TAGS</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-secondary rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="flex-shrink-0 w-5 h-5 text-secondary transition duration-75  group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                                <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                                <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">GESTION DE CONTENU</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-secondary rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-secondary transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                            </svg>
                            <span class="ms-3">STATISTIQUES</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-secondary rounded-lg  hover:bg-gray-7OO dark:hover:bg-gray-700 group">
                                <svg class="flex-shrink-0 w-5 h-5 text-secondary transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">DEMANDES DE VALIDATION</span>
                                <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-1 text-sm font-medium text-primary bg-secondary rounded-full">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="../logout.php" class="flex items-center p-2 text-primary bg-secondary rounded-lg  hover:bg-secondaryhover">
                                <svg class="flex-shrink-0 w-5 h-5 text-primary transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Se déconnecter</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </aside>
            <!-- SIDEBAR END -->
            <div class="p-4 sm:ml-72 bg-gray-200">



                <!-- GESTION DES UTILISATEURS -->
                <div id="manage-users" class="section hidden">
                    <div class="p-6 max-w-6xl mx-auto bg-white rounded-lg shadow-lg my-8">
                    <!-- En-tête avec recherche et filtres -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-2xl font-bold text-primary">Gestion des Utilisateurs :</h2>
                                <button id="filterToggle" class="flex items-center px-4 py-2 bg-primary hover:bg-primaryhover rounded-lg transition-colors text-secondary">
                                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 4h18M3 12h18M3 20h18"></path>
                                    </svg>
                                    Filtres
                                    <svg class="w-4 h-4 ml-2 transform transition-transform duration-200" id="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M6 9l6 6 6-6"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Barre de recherche -->
                            <div class="relative">
                                <input type="text" id="searchInput" placeholder="Rechercher un utilisateur..."
                                class="w-full px-4 py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                />
                                <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="M21 21l-4.35-4.35"></path>
                                </svg>
                            </div>
                            <!-- Panneau de filtres -->
                            <div class="filter-panel mt-4" id="filterPanel">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <select class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Statut</option>
                                        <option value="actif">Actif</option>
                                        <option value="suspendu">Suspendu</option>
                                    </select>
                                    <select class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Rôle</option>
                                        <option value="visitor">Visiteur</option>
                                        <option value="author">Auteur</option>
                                        <option value="admin">administrateur</option>
                                    </select>
                                    <select class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Nombre d'articles</option>
                                        <option value="0-5">0-10 articles</option>
                                        <option value="6-15">11-20 articles</option>
                                        <option value="15+">20+ articles</option>
                                    </select>
                                    <select class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Date d'inscription</option>
                                        <option value="today">Aujourd'hui</option>
                                        <option value="week">Cette semaine</option>
                                        <option value="month">Ce mois</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Tableau -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-secondary">
                                        <th class="px-2 py-3 text-left text-xs font-semi-bold text-primary uppercase tracking-wider">Utilisateur</th>
                                        <th class="px-2 py-3 text-left text-xs font-semi-bold text-primary uppercase tracking-wider">Email</th>
                                        <th class="px-2 py-3 text-left text-xs font-semi-bold text-primary uppercase tracking-wider">Rôle</th>
                                        <th class="px-2 py-3 text-left text-xs font-semi-bold text-primary uppercase tracking-wider">Statut</th>
                                        <th class="px-2 py-3 text-left text-xs font-semi-bold text-primary uppercase tracking-wider">Validité</th>
                                        <th class="px-2 py-3 text-left text-xs font-semi-bold text-primary uppercase tracking-wider">Date d'inscription</th>
                                        <th class="px-2 py-3 text-left text-xs font-semi-bold text-primary uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200" id="userTableBody">
                                    <?php foreach ($users as $user) : ?>
                                    <tr class="odd:bg-blue-50  even:bg-blue-100 hover:bg-blue-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-gray-900"><?php echo htmlspecialchars($user['last_name']) . " " . htmlspecialchars($user['first_name']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-500"><?php echo htmlspecialchars($user['email']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"><?php echo htmlspecialchars($user['role']) ?></span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($user['status']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-500"><?php echo htmlspecialchars($user['is_validated']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-500"><?php echo date('Y-m-d', strtotime($user['created_at'])); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="openModal(categoryModal)" class="text-indigo-600 hover:text-indigo-900 mr-3">Modifier</button>
                                            <button class="text-red-600 hover:text-red-900">Supprimer</button>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="flex items-center justify-between mt-6">
                            <div class="text-sm text-gray-700">
                                Affichage de 1 à 5 sur 50 résultats
                            </div>
                            <div class="flex gap-2">
                                <button class="px-3 py-1 border border-gray-300 rounded-md hover:bg-gray-50">Précédent</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md bg-blue-500 text-white">1</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md hover:bg-gray-50">2</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md hover:bg-gray-50">3</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md hover:bg-gray-50">Suivant</button>
                            </div>
                        </div>
                    </div>
                </div>







                <!-- GESTION DES CATEGORIES -->
                <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
                    <h1 class="text-2xl font-bold text-center text-primary mb-6">GESTION DES CATÉGORIES</h1>
                    <form class="space-y-4" method="POST" action="../process-categorie.php">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom de la catégorie</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description de la catégorie</label>
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-secondary text-white py-2 px-4 rounded-md hover:bg-primary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Ajouter
                        </button>
                    </form>
                    <!-- Tableau des catégories existantes -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Catégories existantes</h2>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-primary">
                                <tr>
                                    <th scope="col" class="w-1/5 px-6 py-3 text-left text-xs font-semi-bold text-gray-500 uppercase tracking-wider">Catégorie</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semi-bold text-gray-500 uppercase tracking-wider">Description</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (!empty($categories)) : ?>
                                <?php foreach ($categories as $category) : ?>
                                <tr>
                                    <td class="w-1/5 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($category['name']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($category['description']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else : ?>
                            <p>Aucune catégorie disponible.</p>
                        <?php endif; ?>
                    </div>
                </div>












            </div>





























            



































        <!-- <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="grid grid-cols-4 gap-4 mb-4">
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
            </div>
            <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
            </div>
            <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    </p>
                </div>
            </div>
        </div> -->










    </div>


</div>
<script>
// Burger menus
document.addEventListener('DOMContentLoaded', function() {
    // open
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');

    if (burger.length && menu.length) {
        for (var i = 0; i < burger.length; i++) {
            burger[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    // close
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (close.length) {
        for (var i = 0; i < close.length; i++) {
            close[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    if (backdrop.length) {
        for (var i = 0; i < backdrop.length; i++) {
            backdrop[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }
});
</script>
</body>
</html>

