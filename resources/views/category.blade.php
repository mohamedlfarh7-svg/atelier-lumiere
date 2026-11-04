<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categoryName }} - ATELIER LUMIÈRE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .modal-scroll::-webkit-scrollbar { width: 6px; }
        .modal-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-slate-800" x-data="{ 
    mobileMenu: false,
    openModal: false, 
    openAddModal: false, 
    selectedProduct: null,
    addImagePreview: null
}">

    <!-- ================= HEADER ================= -->
    <header class="relative py-3 sm:py-4 lg:py-6 px-3 sm:px-5 lg:px-12 flex justify-between items-center bg-white border-b border-slate-100 sticky top-0 z-40">

        <!-- Logo -->
        <a href="/" class="text-base sm:text-lg lg:text-xl font-serif tracking-widest uppercase flex items-center space-x-1.5 sm:space-x-2 shrink-0">
            <span class="font-bold text-slate-900">ATELIER</span> 
            <span class="font-light text-blue-600">LUMIÈRE</span>
        </a>

        <!-- Nav Desktop : SEULEMENT à lg (≥1024px) -->
        <nav class="hidden lg:flex space-x-6 xl:space-x-10 text-sm tracking-wide font-medium">
            <a href="/" class="text-slate-600 hover:text-slate-900 transition">Accueil</a>
            <a href="/boules-de-neige" class="{{ $slug == 'boules-de-neige' ? 'text-slate-900 border-b border-slate-900 pb-1' : 'text-slate-600 hover:text-slate-900' }}">Boules de Neige</a>
            <a href="/nounours" class="{{ $slug == 'nounours' ? 'text-slate-900 border-b border-slate-900 pb-1' : 'text-slate-600 hover:text-slate-900' }}">Nounours</a>
            <a href="/parfums" class="{{ $slug == 'parfums' ? 'text-slate-900 border-b border-slate-900 pb-1' : 'text-slate-600 hover:text-slate-900' }}">Parfums</a>
            <a href="/cadeaux" class="{{ $slug == 'cadeaux' ? 'text-slate-900 border-b border-slate-900 pb-1' : 'text-slate-600 hover:text-slate-900' }}">Cadeaux</a>
        </nav>

        <!-- Actions droite -->
        <div class="flex items-center space-x-1.5 sm:space-x-2 lg:space-x-3 shrink-0">

            @auth
                <!-- Desktop seulement (lg+) : Gérer + Déconnexion -->
                <div class="hidden lg:flex items-center space-x-2 xl:space-x-3">
                    
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="border border-rose-200 text-rose-600 px-4 py-2 text-xs uppercase tracking-wider rounded-full hover:bg-rose-50 transition whitespace-nowrap">
                            Déconnexion
                        </button>
                    </form>
                </div>
            @else
                <!-- Desktop seulement : Admin login -->
               
            @endauth

            <!-- BURGER : visible jusqu'à lg (< 1024px) -->
            <button @click="mobileMenu = !mobileMenu"
                    :aria-expanded="mobileMenu ? 'true' : 'false'"
                    aria-controls="mobile-menu"
                    aria-label="Menu"
                    class="lg:hidden w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-700 transition">
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

            <a href="/" @click="mobileMenu = false" class="block px-4 py-2.5 sm:py-3 rounded-xl text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Accueil</a>
            <a href="/boules-de-neige" @click="mobileMenu = false" class="flex items-center justify-between px-4 py-2.5 sm:py-3 rounded-xl text-sm transition {{ $slug == 'boules-de-neige' ? 'bg-slate-100 font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50' }}">
                <span>Boules de Neige</span>
                @if($slug == 'boules-de-neige')<span class="w-2 h-2 rounded-full bg-blue-600"></span>@endif
            </a>
            <a href="/nounours" @click="mobileMenu = false" class="flex items-center justify-between px-4 py-2.5 sm:py-3 rounded-xl text-sm transition {{ $slug == 'nounours' ? 'bg-slate-100 font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50' }}">
                <span>Nounours</span>
                @if($slug == 'nounours')<span class="w-2 h-2 rounded-full bg-blue-600"></span>@endif
            </a>
            <a href="/parfums" @click="mobileMenu = false" class="flex items-center justify-between px-4 py-2.5 sm:py-3 rounded-xl text-sm transition {{ $slug == 'parfums' ? 'bg-slate-100 font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50' }}">
                <span>Parfums</span>
                @if($slug == 'parfums')<span class="w-2 h-2 rounded-full bg-blue-600"></span>@endif
            </a>
            <a href="/cadeaux" @click="mobileMenu = false" class="flex items-center justify-between px-4 py-2.5 sm:py-3 rounded-xl text-sm transition {{ $slug == 'cadeaux' ? 'bg-slate-100 font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50' }}">
                <span>Cadeaux</span>
                @if($slug == 'cadeaux')<span class="w-2 h-2 rounded-full bg-blue-600"></span>@endif
            </a>

            <!-- Zone Admin (auth-aware) -->
            <div class="pt-2 mt-2 border-t border-slate-100 space-y-1">
                @auth
                    <a href="{{ route('admin.index', ['category' => $slug]) }}" @click="mobileMenu = false" class="flex items-center justify-center gap-2 px-4 py-2.5 sm:py-3 rounded-xl text-xs uppercase tracking-wider font-bold bg-slate-900 text-white hover:bg-slate-800 transition">
                        ⚙️ Gérer Admin
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 sm:py-3 rounded-xl text-xs uppercase tracking-wider font-bold border border-rose-200 text-rose-600 hover:bg-rose-50 transition">
                            Déconnexion
                        </button>
                    </form>
                @else
                   
                @endauth
            </div>
        </div>
    </header>

    <!-- ================= MAIN ================= -->
    <main class="max-w-7xl mx-auto px-3 sm:px-5 lg:px-12 py-6 sm:py-8 lg:py-16">

        <!-- Titre + filtres -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-6 sm:mb-8 lg:mb-12 border-b border-slate-200 pb-5 sm:pb-6 lg:pb-8 gap-4 lg:gap-6">
            <div class="w-full lg:w-auto">
                <p class="text-[10px] sm:text-xs uppercase tracking-widest text-slate-500 mb-1.5 sm:mb-2">@auth Panneau d'Administration @else Collection Exclusive @endauth</p>
                <h1 class="text-2xl sm:text-3xl lg:text-5xl font-serif text-slate-900">{{ $categoryName }}</h1>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-3 lg:gap-4 w-full lg:w-auto">
                @auth
                    <button @click="openAddModal = true; addImagePreview = null" class="bg-emerald-600 text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-full text-xs uppercase tracking-widest hover:bg-emerald-700 transition shadow-md whitespace-nowrap self-start sm:self-auto">
                        + Ajouter un produit
                    </button>
                @endauth

                <!-- Filtres tags : wrap propre sur tablette -->
                <div class="flex flex-wrap gap-1.5 sm:gap-2 w-full sm:w-auto">
                    <a href="{{ url('/' . $slug) }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ !$tag || $tag == 'Tous' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:border-slate-900' }}">Tous</a>
                    @if($slug == 'boules-de-neige')
                        <a href="{{ url('/boules-de-neige?tag=Grand') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Grand' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Grand</a>
                        <a href="{{ url('/boules-de-neige?tag=Moyen') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Moyen' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Moyen</a>
                        <a href="{{ url('/boules-de-neige?tag=Petite') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Petite' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Petite</a>
                    @elseif($slug == 'nounours')
                        <a href="{{ url('/nounours?tag=Coup de cœur') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Coup de cœur' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Coup de cœur</a>
                        <a href="{{ url('/nounours?tag=Édition douce') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Édition douce' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Édition douce</a>
                    @elseif($slug == 'parfums')
                        <a href="{{ url('/parfums?tag=Femme') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Femme' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Femme</a>
                        <a href="{{ url('/parfums?tag=Homme') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Homme' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Homme</a>
                    @elseif($slug == 'cadeaux')
                        <a href="{{ url('/cadeaux?tag=Romantique') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Romantique' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Romantique</a>
                        <a href="{{ url('/cadeaux?tag=Anniversaire') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Anniversaire' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Anniversaire</a>
                        <a href="{{ url('/cadeaux?tag=Naissance') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Naissance' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Naissance</a>
                        <a href="{{ url('/cadeaux?tag=Merci') }}" class="px-3 sm:px-4 lg:px-5 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-[11px] lg:text-xs uppercase tracking-wider transition {{ $tag == 'Merci' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 text-slate-600' }}">Merci</a>
                    @endif
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 sm:px-6 py-3 sm:py-4 rounded-2xl mb-5 sm:mb-6 lg:mb-8 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Products Grid : 1 → 2 → 3 (tablette paysage) → 4 (desktop) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5 lg:gap-6 xl:gap-8">
            @forelse($products as $product)
                <div class="bg-white rounded-2xl sm:rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between border border-slate-100 group">
                    <div>
                        <div class="relative h-52 sm:h-56 lg:h-60 xl:h-64 overflow-hidden bg-slate-100">
                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @if($product->tag)
                                <span class="absolute top-3 left-3 sm:top-4 sm:left-4 bg-white/90 backdrop-blur text-slate-900 text-[10px] uppercase font-semibold tracking-wider px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full shadow-sm">
                                    {{ $product->tag }}
                                </span>
                            @endif
                        </div>
                        <div class="p-4 sm:p-5 lg:p-6">
                            <h3 class="font-serif text-base sm:text-lg text-slate-900 mb-1">{{ $product->name }}</h3>
                            <p class="text-xs text-slate-500 mb-3 lg:mb-4 line-clamp-2">{{ $product->description }}</p>
                            <span class="font-bold text-slate-900">{{ $product->price }} DH</span>
                        </div>
                    </div>

                    <div class="p-4 sm:p-5 lg:p-6 pt-0">
                        @auth
                            <div class="flex flex-col xl:flex-row gap-2">
                                <a href="{{ route('admin.index', ['category' => $slug]) }}" class="flex-1 bg-amber-500 text-white py-2.5 lg:py-3 rounded-full text-[11px] lg:text-xs uppercase tracking-widest text-center hover:bg-amber-600 transition">
                                    Gérer
                                </a>
                                <form action="{{ route('admin.destroy', ['category' => $slug, 'id' => $product->id]) }}" method="POST" class="flex-1" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-rose-600 text-white py-2.5 lg:py-3 rounded-full text-[11px] lg:text-xs uppercase tracking-widest hover:bg-rose-700 transition">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @else
                            <button @click="openModal = true; selectedProduct = { id: '{{ $product->id }}', name: '{{ addslashes($product->name) }}', price: '{{ $product->price }}', category: '{{ $slug }}', image: '{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}' }" class="w-full bg-slate-900 text-white py-2.5 lg:py-3 rounded-full text-[11px] lg:text-xs uppercase tracking-widest hover:bg-slate-800 transition">
                                Commander
                            </button>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 sm:py-20 text-center">
                    <p class="text-slate-400 text-sm">Aucun produit disponible pour le moment dans cette catégorie.</p>
                </div>
            @endforelse
        </div>

    </main>

    <!-- ================= CHECKOUT MODAL (CLIENT) ================= -->
    @guest
    <div x-show="openModal" x-cloak class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-start sm:items-center justify-center p-3 sm:p-4 lg:p-6 overflow-y-auto">
        <div @click.away="openModal = false" class="bg-white rounded-[24px] lg:rounded-[32px] w-full max-w-lg lg:max-w-4xl shadow-2xl relative overflow-hidden flex flex-col lg:flex-row max-h-[92vh] lg:max-h-[90vh] my-auto">
            
            <button @click="openModal = false" aria-label="Fermer" class="absolute top-3 right-3 lg:top-5 lg:right-5 z-50 w-9 h-9 lg:w-10 lg:h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-slate-500 hover:text-slate-900 shadow-sm transition-all hover:rotate-90">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Image : empilée sur mobile/tablette, à gauche sur lg+ -->
            <div class="w-full lg:w-5/12 relative bg-slate-100 shrink-0 h-40 sm:h-52 lg:h-auto lg:min-h-full">
                <img :src="selectedProduct?.image" alt="Produit" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                <div class="absolute bottom-3 left-4 right-4 lg:bottom-6 lg:left-6 lg:right-6 text-white">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-white/70 font-bold mb-1">Votre sélection</p>
                    <h4 class="font-serif text-lg lg:text-2xl" x-text="selectedProduct?.name"></h4>
                </div>
            </div>

            <!-- Form -->
            <div class="w-full lg:w-7/12 p-5 sm:p-6 lg:p-8 xl:p-10 overflow-y-auto modal-scroll bg-white">
                <div class="mb-5 lg:mb-6">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-blue-600 font-bold mb-2">Finaliser la commande</p>
                    <h3 class="font-serif text-2xl lg:text-3xl text-slate-900">Vos coordonnées</h3>
                </div>

                <form action="{{ route('order.submit') }}" method="POST" class="space-y-3.5 lg:space-y-4" x-data="{ selectedCity: 'Casablanca', shippingCost: 20 }">
    @csrf
    <input type="hidden" name="category" x-model="selectedProduct?.category">
    <input type="hidden" name="product_id" x-model="selectedProduct?.id">

    <div>
        <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">Nom complet</label>
        <input type="text" name="name" required placeholder="Votre nom" class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 lg:px-5 py-3 lg:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800">
    </div>

    <div>
        <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">Téléphone</label>
        <input type="text" name="phone" required placeholder="06 00 00 00 00" class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 lg:px-5 py-3 lg:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800">
    </div>

    <div>
        <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">Ville</label>
        <select name="city" required 
                x-model="selectedCity" 
                @change="shippingCost = (selectedCity === 'Casablanca') ? 20 : 35"
                class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 lg:px-5 py-3 lg:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800 cursor-pointer">
            <option value="Casablanca">Casablanca (20 DH)</option>
            <option value="Rabat">Rabat (35 DH)</option>
            <option value="Marrakech">Marrakech (35 DH)</option>
            <option value="Tanger">Tanger (35 DH)</option>
            <option value="Agadir">Agadir (35 DH)</option>
            <option value="Autre">Autre ville (35 DH)</option>
        </select>
    </div>

    <div>
        <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">Adresse de livraison</label>
        <textarea name="address" required rows="2" placeholder="Quartier, rue, numéro..." class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 lg:px-5 py-3 lg:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800 resize-none"></textarea>
    </div>

    <div class="bg-slate-50 border border-slate-200/60 rounded-2xl p-4 lg:p-5 mt-4 space-y-3">
        <div class="flex justify-between text-sm text-slate-600 gap-3">
            <span class="truncate" x-text="selectedProduct?.name"></span>
            <span class="font-semibold text-slate-900 whitespace-nowrap" x-text="selectedProduct?.price + ' DH'"></span>
        </div>
        <div class="flex justify-between text-sm text-slate-600">
            <span>Livraison</span>
            <span class="font-semibold text-slate-900" x-text="shippingCost + ' DH'"></span>
        </div>
        <div class="border-t border-slate-200 pt-3 flex justify-between items-center">
            <span class="font-bold text-slate-900">Total à payer</span>
            <span class="font-bold text-lg text-slate-900" x-text="(parseFloat(selectedProduct?.price || 0) + parseInt(shippingCost)).toFixed(2) + ' DH'"></span>
        </div>
    </div>

    <button type="submit" class="w-full bg-[#121c2c] text-white py-3.5 lg:py-4 rounded-full text-xs uppercase tracking-[0.2em] font-medium hover:bg-slate-800 transition shadow-lg flex items-center justify-center space-x-2 mt-4 group">
        <span>Confirmer la commande</span>
        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </button>
</form>
            </div>
        </div>
    </div>
    @endguest

    <!-- ================= ADMIN ADD PRODUCT MODAL ================= -->
    @auth
    <div x-show="openAddModal" x-cloak class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-start sm:items-center justify-center p-3 sm:p-4 lg:p-6 overflow-y-auto">
        <div @click.away="openAddModal = false" class="bg-white rounded-[24px] lg:rounded-[32px] w-full max-w-lg lg:max-w-5xl shadow-2xl relative overflow-hidden flex flex-col lg:flex-row max-h-[92vh] lg:max-h-[90vh] my-auto">
            
            <button @click="openAddModal = false" aria-label="Fermer" class="absolute top-3 right-3 lg:top-5 lg:right-5 z-50 w-9 h-9 lg:w-10 lg:h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-slate-500 hover:text-slate-900 shadow-sm transition-all hover:rotate-90">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Image upload : empilé jusqu'à lg -->
            <div class="w-full lg:w-5/12 relative h-44 sm:h-52 lg:h-auto lg:min-h-[500px] bg-slate-100 shrink-0">
                
                <input type="file" name="image" form="addProductForm" accept="image/*" required
                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30" 
                       @change="addImagePreview = URL.createObjectURL($event.target.files[0])">

                <template x-if="addImagePreview">
                    <img :src="addImagePreview" class="absolute inset-0 w-full h-full object-cover z-10" alt="Aperçu">
                </template>

                <template x-if="!addImagePreview">
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-400 z-10 space-y-2 sm:space-y-3 p-4 sm:p-6 text-center">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 rounded-full bg-white shadow-sm flex items-center justify-center text-blue-500 mb-1 sm:mb-2">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-600">Ajouter une image</span>
                        <span class="text-xs text-slate-400">Cliquez ou glissez-déposez ici</span>
                    </div>
                </template>

                <div class="absolute inset-0 bg-slate-900/40 z-20 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none text-white">
                    <span class="bg-white/90 text-slate-900 text-xs font-bold px-4 py-2 rounded-full shadow-lg">Changer l'image</span>
                </div>
            </div>

            <!-- Form -->
            <div class="w-full lg:w-7/12 p-5 sm:p-6 lg:p-8 xl:p-10 overflow-y-auto modal-scroll bg-white">
                
                <div class="mb-5 sm:mb-6 lg:mb-8">
                    <p class="text-[10px] uppercase tracking-[0.25em] text-blue-600 font-bold mb-2">Nouveau Produit</p>
                    <h3 class="font-serif text-2xl lg:text-3xl text-slate-900">Détails du produit</h3>
                    <p class="text-xs text-slate-500 mt-2">Remplissez les informations pour ajouter un produit à {{ $categoryName }}.</p>
                </div>

                <form id="addProductForm" action="{{ route('admin.store', ['category' => $slug]) }}" method="POST" enctype="multipart/form-data" class="space-y-4 lg:space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">Nom du produit</label>
                        <input type="text" name="name" required class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 lg:px-5 py-3 lg:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800">
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">Tag / Catégorie</label>
                        <select name="tag" class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 lg:px-5 py-3 lg:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800 cursor-pointer">
                            <option value="">Sélectionnez un tag (Optionnel)</option>
                            @if($slug == 'boules-de-neige')
                                <option value="Grand">Grand</option>
                                <option value="Moyen">Moyen</option>
                                <option value="Petite">Petite</option>
                            @elseif($slug == 'nounours')
                                <option value="Coup de cœur">Coup de cœur</option>
                                <option value="Édition douce">Édition douce</option>
                            @elseif($slug == 'parfums')
                                <option value="Femme">Femme</option>
                                <option value="Homme">Homme</option>
                            @elseif($slug == 'cadeaux')
                                <option value="Romantique">Romantique</option>
                                <option value="Anniversaire">Anniversaire</option>
                                <option value="Naissance">Naissance</option>
                                <option value="Merci">Merci</option>
                            @endif
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">Prix (DH)</label>
                        <input type="number" step="0.01" name="price" required class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 lg:px-5 py-3 lg:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800">
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">Description</label>
                        <textarea name="description" rows="3" class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 lg:px-5 py-3 lg:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800 resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 text-white py-3.5 lg:py-4 rounded-full text-xs uppercase tracking-[0.2em] font-medium hover:bg-emerald-700 transition shadow-lg flex items-center justify-center space-x-2 mt-4 group">
                        <span>Enregistrer le produit</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endauth

</body>
</html>