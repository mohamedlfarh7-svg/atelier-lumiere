<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATELIER LUMIÈRE - Des cadeaux qui restent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    screens: {
                        'hero': '900px',
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; overflow-x: hidden; }
        .font-serif { font-family: 'Playfair Display', serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-slate-800" x-data="{ mobileMenu: false }">

    <!-- ================= HEADER ================= -->
    <header class="relative py-4 md:py-6 px-4 sm:px-6 md:px-8 lg:px-12 flex justify-between items-center bg-[#f8fafc]/95 backdrop-blur-md absolute top-0 left-0 right-0 z-40">

        <!-- Logo -->
        <a href="/" class="text-lg md:text-xl font-serif tracking-widest uppercase flex items-center space-x-2 shrink-0">
            <span class="font-bold text-slate-900">ATELIER</span> 
            <span class="font-light text-blue-600">LUMIÈRE</span>
        </a>

        <!-- Nav Desktop (≥ lg) -->
        <nav class="hidden lg:flex space-x-8 text-sm tracking-wide font-medium">
            <a href="/" class="text-slate-900 border-b-2 border-blue-600 pb-1">Accueil</a>
            <a href="/boules-de-neige" class="text-slate-500 hover:text-slate-900 transition">Boules de Neige</a>
            <a href="/nounours" class="text-slate-500 hover:text-slate-900 transition">Nounours</a>
            <a href="/parfums" class="text-slate-500 hover:text-slate-900 transition">Parfums</a>
            <a href="/cadeaux" class="text-slate-500 hover:text-slate-900 transition">Cadeaux</a>
        </nav>

        <!-- Actions droite -->
        <div class="flex items-center space-x-1.5 sm:space-x-2 lg:space-x-3 shrink-0">

            @auth
                <!-- Desktop seulement : Panneau Admin + Déconnexion -->
                <div class="hidden lg:flex items-center space-x-2 xl:space-x-3">
                    <a href="{{ route('admin.index', ['category' => 'boules-de-neige']) }}" class="bg-slate-900 text-white px-4 xl:px-5 py-2.5 text-xs uppercase tracking-wider rounded-full hover:bg-slate-800 transition flex items-center space-x-2 whitespace-nowrap">
                        <span>⚙️</span><span>Panneau Admin</span>
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="border border-rose-200 text-rose-600 px-4 py-2 text-xs uppercase tracking-wider rounded-full hover:bg-rose-50 transition whitespace-nowrap">
                            Déconnexion
                        </button>
                    </form>
                </div>
            @else
                <!-- Desktop seulement : Admin login -->
                <a href="{{ route('admin.login') }}" class="hidden lg:flex border border-slate-300 bg-white px-4 xl:px-5 py-2.5 text-xs uppercase tracking-wider rounded-full hover:bg-slate-900 hover:text-white transition items-center space-x-2 text-slate-700 shadow-sm whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Admin</span>
                </a>
            @endauth

            <!-- BURGER : visible jusqu'à lg (< 1024px) -->
            <button @click="mobileMenu = !mobileMenu"
                    :aria-expanded="mobileMenu ? 'true' : 'false'"
                    aria-controls="mobile-menu"
                    aria-label="Menu"
                    class="lg:hidden w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white/80 backdrop-blur border border-slate-200 hover:bg-white flex items-center justify-center text-slate-700 transition shadow-sm">
                <svg x-show="!mobileMenu" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenu" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- ========== PANEL MENU (mobile + tablette) ========== -->
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
             class="lg:hidden absolute top-full left-0 right-0 bg-white border-b border-slate-100 shadow-xl px-3 sm:px-4 py-3 space-y-1 max-h-[calc(100vh-80px)] overflow-y-auto">

            <p class="px-3 pt-1 pb-2 text-[10px] uppercase tracking-[0.2em] text-slate-400 font-bold">Navigation</p>

            <a href="/" @click="mobileMenu = false" class="flex items-center justify-between px-4 py-2.5 sm:py-3 rounded-xl text-sm bg-slate-100 font-bold text-slate-900">
                <span>Accueil</span>
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
            </a>
            <a href="/boules-de-neige" @click="mobileMenu = false" class="block px-4 py-2.5 sm:py-3 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Boules de Neige</a>
            <a href="/nounours" @click="mobileMenu = false" class="block px-4 py-2.5 sm:py-3 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Nounours</a>
            <a href="/parfums" @click="mobileMenu = false" class="block px-4 py-2.5 sm:py-3 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Parfums</a>
            <a href="/cadeaux" @click="mobileMenu = false" class="block px-4 py-2.5 sm:py-3 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Cadeaux</a>

            <!-- Zone Admin (auth-aware) -->
            <div class="pt-2 mt-2 border-t border-slate-100 space-y-1">
                @auth
                    <a href="{{ route('admin.index', ['category' => 'boules-de-neige']) }}" @click="mobileMenu = false" class="flex items-center justify-center gap-2 px-4 py-2.5 sm:py-3 rounded-xl text-xs uppercase tracking-wider font-bold bg-slate-900 text-white hover:bg-slate-800 transition">
                        ⚙️ Panneau Admin
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 sm:py-3 rounded-xl text-xs uppercase tracking-wider font-bold border border-rose-200 text-rose-600 hover:bg-rose-50 transition">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('admin.login') }}" @click="mobileMenu = false" class="flex items-center justify-center gap-2 px-4 py-2.5 sm:py-3 rounded-xl text-xs uppercase tracking-wider font-bold border border-slate-300 text-slate-700 hover:bg-slate-900 hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Admin
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- ================= HERO ================= -->
    <section class="relative bg-[#f8fafc] pt-24 md:pt-28 lg:pt-20 pb-10 sm:pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 lg:px-12">

            <!-- Grille : Ketba f-lisr (1ère colonne) w Photo f-liman (2ème colonne) b-tariqa dyal video m9asmin fl-wast -->
            <div class="grid grid-cols-1 hero:grid-cols-2 gap-8 lg:gap-12 items-center">

                <!-- 1. Colonne Texte (A LISRA) -->
                <div class="py-8 sm:py-12 md:py-16 lg:py-20 hero:pr-8">
                    <p class="text-[10px] sm:text-[11px] uppercase tracking-[0.25em] text-slate-700 mb-4 sm:mb-6 flex items-center space-x-3 font-semibold">
                        <span class="w-8 sm:w-10 h-[1px] bg-blue-600 inline-block"></span>
                        <span>DES CADEAUX QUI RESTENT</span>
                    </p>
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-[80px] font-serif mb-4 sm:mb-6 leading-[1.05] text-[#121c2c] font-normal tracking-tight">
                        Offrez un peu de <br>
                        <span class="italic text-blue-600 font-normal">merveilleux.</span>
                    </h1>
                    <p class="text-slate-600 mb-8 sm:mb-10 max-w-md text-sm md:text-base leading-relaxed">
                        Des attentions choisies avec soin à Casablanca, pour transformer chaque occasion en un souvenir précieux.
                    </p>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                        <a href="#collections" class="bg-[#121c2c] text-white px-6 sm:px-8 py-3.5 sm:py-4 rounded-full text-xs uppercase tracking-[0.15em] hover:bg-slate-800 transition flex items-center justify-center space-x-3 shadow-xl shadow-slate-900/10 font-semibold">
                            <span>Découvrir les cadeaux</span>
                            <span>→</span>
                        </a>
                        <a href="#collections" class="border border-slate-300 bg-white text-slate-700 px-6 sm:px-8 py-3.5 sm:py-4 rounded-full text-xs uppercase tracking-[0.15em] hover:bg-slate-50 transition font-semibold text-center">
                            Voir les collections
                        </a>
                    </div>

                    <!-- Features Bar -->
                    <div class="grid grid-cols-3 gap-4 sm:gap-8 mt-10 sm:mt-16 pt-6 sm:pt-8 border-t border-slate-200 max-w-lg">
                        <div>
                            <h4 class="text-xs sm:text-sm font-bold text-slate-900">24-48h</h4>
                            <p class="text-[10px] sm:text-xs text-slate-500 mt-1">Livraison rapide</p>
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-bold text-slate-900">Avec soin</h4>
                            <p class="text-[10px] sm:text-xs text-slate-500 mt-1">Prêt à offrir</p>
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-bold text-slate-900">Au Maroc</h4>
                            <p class="text-[10px] sm:text-xs text-slate-500 mt-1">Partout chez vous</p>
                        </div>
                    </div>
                </div>

                <!-- 2. Colonne Image (F-LIMAN) b-nafs taswira l-asliya -->
                <div class="relative w-full">
                    <div class="relative h-64 sm:h-80 md:h-96 hero:h-[520px] lg:h-[600px] rounded-[24px] sm:rounded-[28px] overflow-hidden shadow-xl">
                        <img src="https://media.istockphoto.com/id/1772604575/photo/fragrance-spray-man-and-perfume-applying-cologne-scent-water-skin-care-beauty-product-and.webp?a=1&b=1&s=612x612&w=0&k=20&c=5FIidS40BeICkG0swLERiQ2N47iD33eGIevjHKkeJnM=" 
                             alt="Homme élégant" 
                             class="w-full h-full object-cover object-center grayscale contrast-110 opacity-90">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                        <!-- Badge -->
                        <div class="absolute bottom-3 left-3 sm:bottom-4 sm:left-4 bg-white/95 backdrop-blur-md px-4 py-2.5 sm:px-5 sm:py-3 rounded-xl shadow-lg border border-slate-100">
                            <p class="text-[9px] sm:text-[10px] uppercase tracking-[0.2em] text-blue-600 font-bold mb-0.5">LA SÉLECTION DU MOMENT</p>
                            <h4 class="font-serif text-xs sm:text-sm text-slate-900 font-semibold">Maison des Roses</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= COLLECTIONS ================= -->
    <section id="collections" class="bg-[#f7f8fa]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-10 lg:px-12 py-12 sm:py-16 md:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8 lg:gap-12 mb-8 sm:mb-10 md:mb-16">
                <div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif text-slate-900 leading-[0.95]">
                        Une attention pour chaque<br class="hidden sm:block">
                        histoire
                    </h2>
                </div>
                <div class="flex lg:justify-end lg:items-end">
                    <p class="text-sm md:text-base text-slate-500 max-w-md leading-relaxed">
                        Quatre collections, chacune imaginée pour dire les choses que les mots ne suffisent pas toujours à exprimer.
                    </p>
                </div>
            </div>

            <!-- Grid Masonry -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 md:gap-6 items-start">
                <div class="flex flex-col gap-4 sm:gap-5 md:gap-6">
                    <a href="/boules-de-neige" class="group relative h-[280px] sm:h-[320px] md:h-[360px] lg:h-[390px] xl:h-[410px] rounded-[24px] sm:rounded-[28px] overflow-hidden block">
                        <img src="https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=1200" alt="Boules de Neige" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-6 md:p-7 lg:p-8 flex items-end justify-between gap-3 sm:gap-5">
                            <div>
                                <p class="text-[9px] sm:text-[10px] md:text-[11px] uppercase tracking-[0.22em] text-white/75 mb-1.5 sm:mb-2 font-semibold">UN PEU DE MAGIE SOUS VERRE</p>
                                <h3 class="font-serif text-2xl sm:text-3xl md:text-[38px] leading-none text-white">Boules de Neige</h3>
                            </div>
                            <span class="shrink-0 w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full border border-white/40 bg-white/5 backdrop-blur-sm flex items-center justify-center text-white transition-all duration-300 group-hover:bg-white group-hover:text-slate-900 group-hover:border-white text-sm sm:text-base">→</span>
                        </div>
                    </a>

                    <a href="/parfums" class="group relative h-[340px] sm:h-[400px] md:h-[460px] lg:h-[470px] xl:h-[520px] rounded-[24px] sm:rounded-[28px] overflow-hidden block">
                        <img src="https://images.unsplash.com/photo-1523293182086-7651a899d37f?q=80&w=1200" alt="Parfums" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-6 md:p-7 lg:p-8 flex items-end justify-between gap-3 sm:gap-5">
                            <div>
                                <p class="text-[9px] sm:text-[10px] md:text-[11px] uppercase tracking-[0.22em] text-white/75 mb-1.5 sm:mb-2 font-semibold">VOTRE SILLAGE, VOTRE SIGNATURE</p>
                                <h3 class="font-serif text-2xl sm:text-3xl md:text-[38px] leading-none text-white">Parfums</h3>
                            </div>
                            <span class="shrink-0 w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full border border-white/40 bg-white/5 backdrop-blur-sm flex items-center justify-center text-white transition-all duration-300 group-hover:bg-white group-hover:text-slate-900 group-hover:border-white text-sm sm:text-base">→</span>
                        </div>
                    </a>
                </div>

                <div class="flex flex-col gap-4 sm:gap-5 md:gap-6">
                    <a href="/nounours" class="group relative h-[340px] sm:h-[400px] md:h-[460px] lg:h-[470px] xl:h-[520px] rounded-[24px] sm:rounded-[28px] overflow-hidden block">
                        <img src="https://images.unsplash.com/photo-1563245372-f21724e3856d?q=80&w=1200" alt="Nounours" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-6 md:p-7 lg:p-8 flex items-end justify-between gap-3 sm:gap-5">
                            <div>
                                <p class="text-[9px] sm:text-[10px] md:text-[11px] uppercase tracking-[0.22em] text-white/75 mb-1.5 sm:mb-2 font-semibold">DES CÂLINS À GARDER TOUJOURS</p>
                                <h3 class="font-serif text-2xl sm:text-3xl md:text-[38px] leading-none text-white">Nounours</h3>
                            </div>
                            <span class="shrink-0 w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full border border-white/40 bg-white/5 backdrop-blur-sm flex items-center justify-center text-white transition-all duration-300 group-hover:bg-white group-hover:text-slate-900 group-hover:border-white text-sm sm:text-base">→</span>
                        </div>
                    </a>

                    <a href="/cadeaux" class="group relative h-[280px] sm:h-[320px] md:h-[360px] lg:h-[390px] xl:h-[410px] rounded-[24px] sm:rounded-[28px] overflow-hidden block">
                        <img src="https://images.unsplash.com/photo-1513201099705-a9746e1e201f?q=80&w=1200" alt="Cadeaux" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-6 md:p-7 lg:p-8 flex items-end justify-between gap-3 sm:gap-5">
                            <div>
                                <p class="text-[9px] sm:text-[10px] md:text-[11px] uppercase tracking-[0.22em] text-white/75 mb-1.5 sm:mb-2 font-semibold">L'ART DÉLICAT DE FAIRE PLAISIR</p>
                                <h3 class="font-serif text-2xl sm:text-3xl md:text-[38px] leading-none text-white">Cadeaux</h3>
                            </div>
                            <span class="shrink-0 w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full border border-white/40 bg-white/5 backdrop-blur-sm flex items-center justify-center text-white transition-all duration-300 group-hover:bg-white group-hover:text-slate-900 group-hover:border-white text-sm sm:text-base">→</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= LES PLUS AIMÉS ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 lg:px-12 py-12 sm:py-14 md:py-16">
        <div class="text-center mb-8 sm:mb-10 md:mb-12">
            <p class="text-[10px] sm:text-[11px] uppercase tracking-[0.25em] text-blue-600 font-bold mb-2 sm:mb-3">NOS COUPS DE CŒUR</p>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-slate-900">Les plus aimés</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5 md:gap-6">
            @php
                $allFeatured = collect()->concat($boules)->concat($nounours)->concat($parfums)->concat($cadeaux);
            @endphp

            @foreach($allFeatured as $product)
                <div class="group cursor-pointer">
                    <div class="relative h-64 sm:h-72 md:h-80 rounded-[20px] sm:rounded-[24px] md:rounded-[28px] overflow-hidden bg-slate-100 mb-3 sm:mb-4">
                        @if($product->tag)
                            <span class="absolute top-3 left-3 sm:top-4 sm:left-4 bg-white/90 backdrop-blur text-[10px] font-bold uppercase tracking-wider px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full z-20 text-slate-800">
                                {{ $product->tag }}
                            </span>
                        @endif
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    </div>
                    <div class="flex justify-between items-start px-1 gap-3">
                        <div class="min-w-0">
                            <h4 class="font-serif text-base sm:text-lg text-slate-900 truncate">{{ $product->name }}</h4>
                            <p class="text-xs text-slate-500 mt-1">Emballage cadeau inclus</p>
                        </div>
                        <span class="text-sm font-bold text-blue-700 whitespace-nowrap">{{ $product->price }} DH</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="border-t border-slate-200 py-10 sm:py-12 md:py-16 px-4 sm:px-6 md:px-8 lg:px-12 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 sm:gap-10 md:gap-12">
            <div class="sm:col-span-2 md:col-span-1">
                <h4 class="font-serif text-lg sm:text-xl tracking-widest uppercase text-slate-900 mb-3 sm:mb-4">ATELIER <span class="text-blue-600 font-light">LUMIÈRE</span></h4>
                <p class="text-xs text-slate-500 leading-relaxed max-w-xs">Des présents raffinés, préparés avec cœur et livrés partout au Maroc.</p>
            </div>
            <div>
                <h5 class="text-[11px] font-bold uppercase tracking-widest text-slate-900 mb-3 sm:mb-4">COLLECTIONS</h5>
                <ul class="space-y-2.5 sm:space-y-3 text-xs text-slate-500 font-medium">
                    <li><a href="/boules-de-neige" class="hover:text-blue-600 transition">Boules de Neige</a></li>
                    <li><a href="/nounours" class="hover:text-blue-600 transition">Nounours</a></li>
                    <li><a href="/parfums" class="hover:text-blue-600 transition">Parfums</a></li>
                    <li><a href="/cadeaux" class="hover:text-blue-600 transition">Cadeaux</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-[11px] font-bold uppercase tracking-widest text-slate-900 mb-3 sm:mb-4">NOUS CONTACTER</h5>
                <ul class="space-y-2.5 sm:space-y-3 text-xs text-slate-500 font-medium">
                    <li>Casablanca, Maroc</li>
                    <li>+212 6 00 00 00 00</li>
                    <li class="break-all">bonjour@atelierlumiere.ma</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-8 sm:mt-10 md:mt-12 pt-6 sm:pt-8 border-t border-slate-100 text-center text-[10px] sm:text-[11px] text-slate-400">
            &copy; {{ date('Y') }} Atelier Lumière. Pensé avec soin à Casablanca.
        </div>
    </footer>

</body>
</html>