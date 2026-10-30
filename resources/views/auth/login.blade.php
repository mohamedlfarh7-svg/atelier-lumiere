<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - ATELIER LUMIÈRE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; }
        .font-serif { font-family: 'Playfair Display', serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col justify-between" x-data="{ mobileMenu: false }">

    <!-- ================= HEADER ================= -->
    <header class="relative py-4 md:py-6 px-4 sm:px-6 md:px-12 flex justify-between items-center bg-white border-b border-slate-100 w-full sticky top-0 z-40">

        <!-- Logo -->
        <a href="/" class="text-lg md:text-xl font-serif tracking-widest uppercase flex items-center space-x-2 shrink-0">
            <span class="font-bold text-slate-900">ATELIER</span> 
            <span class="font-light text-blue-600">LUMIÈRE</span>
        </a>

        <!-- Navigation Desktop (≥ md) -->
        <nav class="hidden md:flex space-x-8 lg:space-x-10 text-sm tracking-wide font-medium text-slate-600">
            <a href="/" class="hover:text-slate-900 transition">Accueil</a>
            <a href="/boules-de-neige" class="hover:text-slate-900 transition">Boules de Neige</a>
            <a href="/nounours" class="hover:text-slate-900 transition">Nounours</a>
            <a href="/parfums" class="hover:text-slate-900 transition">Parfums</a>
            <a href="/cadeaux" class="hover:text-slate-900 transition">Cadeaux</a>
        </nav>

        <!-- Actions droite -->
        <div class="flex items-center space-x-2 sm:space-x-3 shrink-0">

            <!-- Bouton Admin (caché sur très petit écran, visible sm+) -->
            <a href="/admin/login" class="hidden sm:flex border border-slate-300 px-4 md:px-5 py-2 text-xs uppercase tracking-wider rounded-full hover:bg-slate-900 hover:text-white transition items-center space-x-2 bg-white text-slate-700">
                <span>👤</span> <span class="font-medium">Admin</span>
            </a>

            <!-- BOUTON BURGER (visible < md) -->
            <button @click="mobileMenu = !mobileMenu"
                    :aria-expanded="mobileMenu ? 'true' : 'false'"
                    aria-controls="mobile-menu"
                    aria-label="Menu"
                    class="md:hidden w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-700 transition">
                <svg x-show="!mobileMenu" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenu" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- ========== PANEL MENU MOBILE ========== -->
        <div id="mobile-menu"
             x-show="mobileMenu"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.away="mobileMenu = false"
             @keydown.escape.window="mobileMenu = false"
             class="md:hidden absolute top-full left-0 right-0 bg-white border-b border-slate-100 shadow-xl px-3 sm:px-4 py-3 space-y-1">

            <p class="px-3 pt-1 pb-2 text-[10px] uppercase tracking-[0.2em] text-slate-400 font-bold">Navigation</p>

            <a href="/" @click="mobileMenu = false" class="block px-4 py-3 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Accueil</a>
            <a href="/boules-de-neige" @click="mobileMenu = false" class="block px-4 py-3 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Boules de Neige</a>
            <a href="/nounours" @click="mobileMenu = false" class="block px-4 py-3 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Nounours</a>
            <a href="/parfums" @click="mobileMenu = false" class="block px-4 py-3 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Parfums</a>
            <a href="/cadeaux" @click="mobileMenu = false" class="block px-4 py-3 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Cadeaux</a>

            <div class="pt-2 mt-2 border-t border-slate-100">
                <a href="/admin/login" @click="mobileMenu = false" class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-xs uppercase tracking-wider font-bold bg-slate-900 text-white hover:bg-slate-800 transition">
                    <span>👤</span> Admin
                </a>
            </div>
        </div>
    </header>

    <!-- ================= MAIN (Login Card) ================= -->
    <main class="flex-1 flex items-center justify-center px-4 sm:px-6 py-8 sm:py-10 my-4 sm:my-8">
        <div class="bg-white rounded-[24px] sm:rounded-[32px] max-w-lg w-full p-6 sm:p-8 md:p-10 shadow-xl border border-slate-100/80 flex flex-col items-center">
            
            <!-- Top Icon -->
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-blue-600 mb-5 sm:mb-6 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>

            <!-- Title -->
            <div class="text-center mb-6 sm:mb-8">
                <p class="text-[10px] sm:text-[11px] uppercase tracking-[0.25em] text-slate-400 font-semibold mb-2">Espace Privé</p>
                <h1 class="font-serif text-2xl sm:text-3xl md:text-4xl text-slate-900 mb-2">Administration</h1>
                <p class="text-xs text-slate-500">Consultez et gérez les commandes reçues.</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="w-full bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl mb-5 sm:mb-6 text-xs text-center font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Global Errors -->
            @if($errors->any())
                <div class="w-full bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-2xl mb-5 sm:mb-6 text-xs">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="w-full space-y-4 sm:space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 sm:mb-2 font-bold">Adresse e-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                           class="w-full bg-slate-50/50 border border-slate-200/80 rounded-2xl px-4 sm:px-5 py-3 sm:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800 placeholder-slate-400">
                    @error('email')
                        <span class="text-xs text-rose-600 mt-1.5 inline-block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center mb-1.5 sm:mb-2 gap-2">
                        <label for="password" class="block text-[11px] uppercase tracking-wider text-slate-500 font-bold">Mot de passe</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[11px] text-blue-600 hover:text-blue-800 transition whitespace-nowrap">Mot de passe oublié ?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                           class="w-full bg-slate-50/50 border border-slate-200/80 rounded-2xl px-4 sm:px-5 py-3 sm:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800 placeholder-slate-400">
                    @error('password')
                        <span class="text-xs text-rose-600 mt-1.5 inline-block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
                    <label for="remember_me" class="ml-2 text-xs text-slate-600 cursor-pointer">Se souvenir de moi</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-[#121c2c] text-white py-3.5 sm:py-4 rounded-full text-xs uppercase tracking-[0.2em] font-medium hover:bg-slate-800 transition shadow-lg flex items-center justify-center space-x-2 mt-2 group">
                    <span>Se connecter</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>

            <!-- Info Box -->
            <div class="w-full mt-6 sm:mt-8 bg-blue-50/50 border border-blue-100 rounded-2xl p-3.5 sm:p-4 text-center">
                <p class="text-[11px] font-semibold text-blue-900 uppercase tracking-wider mb-1">Accès réservé</p>
                <p class="text-xs text-blue-700/80">Utilisez vos identifiants d'administration.</p>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="py-5 sm:py-6 text-center text-xs text-slate-400 px-4">
        &copy; {{ date('Y') }} ATELIER LUMIÈRE. Tous droits réservés.
    </footer>

</body>
</html>