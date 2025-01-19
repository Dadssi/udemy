<?php
session_start();
require_once '../autoload.php';
require_once '../config/config.php';

PageManager::setTitle("Login");
PageManager::setDescription("page d'authentification à la plateforme Udemy");
include '../includes/header.php';

// ---------------------------------------


// ---------------------------------------
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    </head>
    <body class="h-full bg-gradient-to-br from-gray-200 via-gray-50 to-gray-200">




    <section class="h-full flex items-center justify-center p-4">
        <div x-data="{ email: '', password: '', name: '' }" 
            class="bg-primary backdrop-blur-lg rounded-3xl p-8 shadow-2xl w-full max-w-md transform hover:scale-105 transition-all duration-300 lg:my-6"
            x-init="
                gsap.from($el, {opacity: 0, y: 50, duration: 1, ease: 'back'});
                gsap.from('.input-field', {opacity: 0, x: -50, stagger: 0.2, duration: 0.8, ease: 'power2.out'});
                gsap.from('.btn', {opacity: 0, scale: 0.5, duration: 0.5, delay: 1, ease: 'elastic.out(1, 0.5)'});
            ">
            <h2 class="text-4xl mb-6 lg:mb-8 font-extrabold text-secondary mb-6 text-center animate-pulse">S'inscrire</h2>



            <form class="space-y-6" action="process-register.php" method="POST">


                <div class="input-field relative">
                    <label for="first-name"></label>
                    <input x-model="first-name" type="text" id="first-name" name="first_name" required class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200 transition duration-200" placeholder="Prénom">
                    <i class="fas fa-user absolute right-3 top-3 text-secondary"></i>
                </div>


                <div class="input-field relative">
                    <label for="last-name"></label>
                    <input x-model="last-name" type="text" id="last-name" name="last_name" required class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200 transition duration-200" placeholder="Nom">
                    <i class="fas fa-user absolute right-3 top-3 text-secondary"></i>
                </div>


                <div class="input-field relative">
                    <label for="role"></label>
                    <select x-model="role" type="role" id="role" name="role" required class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200 transition duration-200">
                        <option value="" selected class="text-primary">Choisir un Rôle</option>
                        <option value="teacher" class="text-primary">Enseignant</option>
                        <option value="student" class="text-primary">Etudiant</option>
                    </select>
                </div>


                <div class="input-field relative">
                    <label for="email"></label>
                    <input x-model="email" type="email" id="email" name="email" required class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200 transition duration-200" placeholder="Email">
                    <i class="fas fa-envelope absolute right-3 top-3 text-secondary"></i>
                </div>


                <div class="input-field relative">
                    <label for="first-name"></label>
                    <input x-model="password" type="password" id="password" name="password" required class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200 transition duration-200" placeholder="Mot de Passe">
                    <i class="fas fa-lock absolute right-3 top-3 text-secondary"></i>
                </div>


                <button type="submit" name="login" class="w-full bg-secondary hover:bg-secondaryhover text-primary font-bold py-3 px-4 rounded-lg hover:opacity-90 focus:ring-4 focus:ring-purple-300 transition duration-300 transform hover:scale-105">
                    S'inscrire
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>







            <p class="text-white text-center mt-6">Bienvenue à Udemy</p>
            
        </div>
    </section>








    <?php include '../includes/footer.php'; ?>
    <script>
        gsap.to('.fab', {
            y: -10,
            stagger: 0.1,
            duration: 0.8,
            repeat: -1,
            yoyo: true,
            ease: 'power1.inOut'
        });
    </script>
    </body>
</html>


