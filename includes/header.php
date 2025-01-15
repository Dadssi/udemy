<?php
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(dirname(__FILE__)));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo PageManager::getTitle(); ?></title>
    <meta name="description" content="<?php echo PageManager::getDescription(); ?>">
    <!-- Autres balises meta et liens CSS -->
</head>
<body>
    <header>
        <!-- Votre navigation et autres éléments du header -->
    </header>
    <main>


	
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
	<nav class="relative px-4 py-4 flex justify-between items-center bg-primary">
		<a class="text-3xl font-bold leading-none" href="#">
			<div class="logo w-1/4">
				<img src="../public/assets/imgs/logo.png" alt="logo-udemy">
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