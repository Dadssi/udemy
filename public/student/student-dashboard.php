<?php
session_start();
require_once '../../classes/database/Database.php';
require_once '../../classes/users/User.php';
require_once '../../classes/course/Tag.php';
require_once '../../classes/course/Course.php';
require_once '../../classes/utils/Category.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header('Location: ../login.php');
    exit;
}
$userId = $_SESSION['user_id'];
$userInfo = User::getInfoUser($userId);

$categories = Category::getAllCategories();

$tags = Tag::getAllTags();

$courses = Course::getAllCourses();
foreach($courses as $course) {
    echo '<pre>';
    print_r($course) . '<br>';
    echo '</pre>';
}

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
        <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        </style>
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
            <aside id="default-sidebar" class="fixed top-0 left-0 w-72 h-full z-50 transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-primary">
                    <ul class="space-y-2 font-medium">
                        <li>
                            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <img src="../assets/imgs/logo.png" alt="logo-udemy">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn-toggle flex items-center p-2 text-secondary rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group" data-target="my-profile">
                            <svg class="w-5 h-5 text-secondary transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5Zm0 2c-3.315 0-10 1.672-10 5v2h20v-2c0-3.328-6.685-5-10-5Z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">MON PROFILE</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn-toggle flex items-center p-2 text-secondary rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group" data-target="my-courses">
                            <svg class="flex-shrink-0 w-5 h-5 text-secondary transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">BIBLIOTHÈQUE DES COURS</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn-toggle flex items-center p-2 text-secondary rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group" data-target="add-course">
                            <svg class="flex-shrink-0 w-5 h-5 text-secondary transition duration-75  group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                                <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                                <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">MES COURS</span>
                            </a>
                        </li>
                        <li>
                            <a href="../logout.php" class="flex items-center p-2 text-primary rounded-lg bg-secondary  hover:bg-secondaryhover">
                            <svg class="flex-shrink-0 w-5 h-5 text-primary transition duration-75 group-hover:text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Se déconnecter</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
            <!-- SIDEBAR END -->
            <div class="p-4 sm:ml-72">
                <!-- MON PROFILE START -->
                <div id="my-profile" class=" content-div hidden bg-white dark:bg-primary rounded-xl shadow-2xl w-full p-8 transition-all duration-300 animate-fade-in">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 text-center mb-8 md:mb-0">
                            <img src="../<?php echo htmlspecialchars($userInfo['photo']) ?>" alt="<?php echo htmlspecialchars($userInfo['last_name']) ?>" class="rounded-full w-48 h-48 mx-auto mb-4 border-4 border-indigo-800 dark:border-secondary transition-transform duration-300 hover:scale-105">
                            <h1 class="text-2xl font-bold text-indigo-800 dark:text-white mb-2"><?php echo htmlspecialchars($userInfo['first_name']) . ' ' . htmlspecialchars($userInfo['last_name']) ?></h1>
                            <p class="text-gray-600 dark:text-gray-300">role : <span class="font-semibold"> <?php echo htmlspecialchars($userInfo['role']) ?></span></p>
                            <button class="mt-4 bg-secondary text-primary px-4 py-2 rounded-lg hover:bg-secondaryhover transition-colors duration-300">Modifier Profile</button>
                        </div>
                        <div class="md:w-2/3 md:pl-8">
                            <h2 class="text-xl font-semibold text-indigo-800 dark:text-white mb-4">A propos :</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-6">
                                Développeur logiciel passionné avec 5 ans d'expérience dans les technologies web. 
                                J'aime créer des applications conviviales et résoudre des problèmes complexes.
                            </p>
                            <h2 class="text-xl font-semibold text-indigo-800 dark:text-white mb-4">Compétences :</h2>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">JavaScript</span>
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">React</span>
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">Node.js</span>
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">Python</span>
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">SQL</span>
                            </div>
                            <h2 class="text-xl font-semibold text-indigo-800 dark:text-white mb-4">Email :</h2>
                            <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-800 dark:text-blue-900" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                    <?php echo htmlspecialchars($userInfo['email']) ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                echo '<pre>';
                var_dump($courses);
                echo '</pre>';
                ?>
                <!-- MON PROFILE END -->
                <!-- BIBLIOTHEQUE DES COURS START -->
                <div id="my-courses" class=" content-div hidden container mx-auto p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($courses as $course) : ?>
                        <?php $courseData = $course->toArray(); ?>
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                            <div class="relative h-[8%]">
                                <div class="absolute top-2 right-4 bg-secondary backdrop-blur-sm px-3 py-1 rounded-full shadow-md flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                    </svg>
                                    <span class="text-sm font-semibold text-navy">238</span>
                                </div>
                            </div>
                            <iframe src='<?php echo htmlspecialchars($courseData['video_url']) ?>'></iframe>
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-xl font-bold text-primary truncate"><?php echo htmlspecialchars($courseData['title']) ?></h3>
                                </div>
                                <p class="text-gray-600 text-sm mb-6 line-clamp-2"><?php echo htmlspecialchars($courseData['description']) ?></p>
                                <div class="flex items-center mb-6">
                                    <img src="/api/placeholder/32/32" alt="Teacher" class="h-8 w-8 rounded-full ring-2 ring-primary"/>
                                    <span class="ml-2 text-sm font-medium text-navy">Prof. Sarah Martin</span>
                                </div>
                                <button class="w-full px-4 py-2 bg-secondary text-primary rounded-lg 
                                            transform transition duration-300 hover:from-mustard hover:to-mustard-dark 
                                            hover:shadow-lg focus:ring-2 focus:ring-mustard focus:ring-opacity-50">
                                    S'inscrire au cours
                                </button>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <!-- BIBLIOTHEQUE DES COURS END -->
                <!-- AJOUTER COURS START -->
                <div id="add-course" class=" content-div hidden max-w-3xl mx-auto bg-gray-200 p-6 rounded-lg shadow-lg mt-10">
                    <h1 class="text-2xl font-bold text-primary mb-6 text-center">AJOUTER UN COURS</h1>
                    <form action="../process-course.php" method="POST">
                        <div class="mb-4">
                            <label for="course-title" class="block text-primary font-medium mb-2">Titre du cours :</label>
                            <input type="text" id="course-title" name="course-title" placeholder="Titre du cours" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"/>
                        </div>
                        <div class="mb-4">
                            <label for="course-description" class="block text-primary font-medium mb-2">Description du cours :</label>
                            <textarea id="course-description" name="course-description" placeholder="Description du cours" rows="4" 
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </textarea>
                        </div>
                        <div class="mb-4">
                            <label for="content-type" class="block text-primary font-medium mb-2">Type de contenu :</label>
                            <select id="content-type" name="content-type" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                <option selected>Choisir type Contenu</option>
                                <option value="video">VIDEO</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="content-link" class="block text-primary font-medium mb-2">
                                Lien du contenu :
                            </label>
                            <input type="text" id="content-link" name="content-link" placeholder="Lien du contenu" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"/>
                        </div>

                        <div class="mb-4">
                            <label for="course-category" class="block text-primary font-medium mb-2">Catégorie du cours</label>
                            <select 
                                id="course-category" name="course-category" 
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                <option selected>CATEGORIE DU COURS</option>
                                <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo htmlspecialchars($category['id']) ?></label>"><?php echo htmlspecialchars($category['name']) ?></label></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-primary font-medium mb-2">
                                Tags :
                            </label>
                            <div class="flex flex-wrap gap-3">
                                <?php foreach ($tags as $tag) : ?>
                                <label class="flex items-center gap-2 text-gray-600">
                                <input type="checkbox" name="tags[]" value="tag1" class="h-4 w-4 text-primary border-gray-300 focus:ring-primary"/>
                                <?php echo htmlspecialchars($tag['name']) ?></label>
                                <?php endforeach ?>
                            </div>
                        </div>

                        <!-- Bouton Ajouter -->
                        <div class="text-center">
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg shadow-md hover:bg-secondary hover:shadow-lg transition-all duration-200 ease-in-out transform hover:scale-105">
                                Ajouter le cours
                            </button>
                        </div>
                    </form>
                </div>
                <!-- AJOUTER COURS END -->
                <!-- STATISTIQUES START -->
                 <div id="statistics" class="content-div hidden">
                    <h1>page statistiques</h1>
                 </div>
                <!-- STATISTIQUES END -->
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
// ----------------------------------------------------------------
// Toggle dark mode based on system preference
if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }

        // Add hover effect to skill tags
        const skillTags = document.querySelectorAll('.bg-indigo-100');
        skillTags.forEach(tag => {
            tag.addEventListener('mouseover', () => {
                tag.classList.remove('bg-indigo-100', 'text-indigo-800');
                tag.classList.add('bg-blue-900', 'text-white');
            });
            tag.addEventListener('mouseout', () => {
                tag.classList.remove('bg-blue-900', 'text-white');
                tag.classList.add('bg-indigo-100', 'text-indigo-800');
            });
        });
// ----------------------------------------------------------------
// Sélectionner tous les boutons avec une classe commune
const buttons = document.querySelectorAll('.btn-toggle');

// Fonction pour afficher une div et cacher les autres
function showDiv(targetId) {
    // Masquer toutes les divs avec une classe commune
    document.querySelectorAll('.content-div').forEach((div) => {
        if (div.id === targetId) {
            div.classList.remove('hidden');
        } else {
            div.classList.add('hidden');
        }
    });
}

// Ajouter des écouteurs d'événements à chaque bouton
buttons.forEach((button) => {
    button.addEventListener('click', () => {
        // Récupérer l'ID cible depuis un attribut data-target
        const targetId = button.getAttribute('data-target');
        showDiv(targetId);
    });
});

// Afficher la première div par défaut
document.querySelector('.content-div').classList.remove('hidden');
// ----------------------------------------------------------------------
// Récupérer le bouton et la barre latérale
// const sidebarToggle = document.querySelector('[data-drawer-toggle="default-sidebar"]');
// const sidebar = document.getElementById('default-sidebar');

// // Fonction pour afficher/masquer la barre latérale
// sidebarToggle.addEventListener('click', () => {
//     sidebar.classList.toggle('-translate-x-full'); // Afficher ou cacher la barre latérale
// });

// ----------------------------------------------------------------------

// Récupérer le bouton, la barre latérale, l'overlay et tous les liens de la barre latérale
const sidebarToggle = document.querySelector('[data-drawer-toggle="default-sidebar"]');
const sidebar = document.getElementById('default-sidebar');
const overlay = document.getElementById('sidebar-overlay');
const sidebarLinks = sidebar.querySelectorAll('a'); // Tous les liens dans la barre latérale

// Fonction pour afficher/masquer la barre latérale et l'overlay
sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full'); // Afficher ou cacher la barre latérale
    overlay.classList.toggle('hidden'); // Afficher ou cacher l'overlay
});

// Masquer la barre latérale en cliquant sur l'overlay
overlay.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full'); // Masquer la barre latérale
    overlay.classList.add('hidden'); // Masquer l'overlay
});

// Masquer la barre latérale lorsqu'un lien est cliqué
sidebarLinks.forEach(link => {
    link.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full'); // Masquer la barre latérale
        overlay.classList.add('hidden'); // Masquer l'overlay
    });
});


</script>
</body>
</html>

