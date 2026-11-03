<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ ucfirst($category) }} - ATELIER LUMIÈRE</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .modal-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .modal-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>

<body class="text-slate-800" x-data="{
    mobileMenu: false,
    openEditModal: false,
    editProduct: {
        id: '',
        name: '',
        tag: '',
        price: '',
        image: '',
        imagePreview: null,
        description: ''
    },
    openOrdersModal: false,
    openOrderDetailsModal: false,
    selectedOrder: null,
    orderCount: {{ $pendingOrdersCount ?? 0 }}
}">

<header class="relative py-4 md:py-6 px-4 sm:px-6 md:px-12 flex justify-between items-center bg-white border-b border-slate-100 sticky top-0 z-40">

    <a href="/" class="text-lg md:text-xl font-serif tracking-widest uppercase flex items-center space-x-2">
        <span class="font-bold text-slate-900">ATELIER</span>
        <span class="font-light text-blue-600">LUMIÈRE</span>
    </a>

    <nav class="hidden lg:flex space-x-8 text-sm tracking-wide font-medium">

        <a href="/admin/boules-de-neige"
           class="{{ $category == 'boules-de-neige' ? 'text-slate-900 font-bold border-b-2 border-slate-900 pb-1' : 'text-slate-500 hover:text-slate-900' }}">
            Boules de Neige
        </a>

        <a href="/admin/nounours"
           class="{{ $category == 'nounours' ? 'text-slate-900 font-bold border-b-2 border-slate-900 pb-1' : 'text-slate-500 hover:text-slate-900' }}">
            Nounours
        </a>

        <a href="/admin/parfums"
           class="{{ $category == 'parfums' ? 'text-slate-900 font-bold border-b-2 border-slate-900 pb-1' : 'text-slate-500 hover:text-slate-900' }}">
            Parfums
        </a>

        <a href="/admin/cadeaux"
           class="{{ $category == 'cadeaux' ? 'text-slate-900 font-bold border-b-2 border-slate-900 pb-1' : 'text-slate-500 hover:text-slate-900' }}">
            Cadeaux
        </a>

    </nav>

    <div class="flex items-center space-x-2 sm:space-x-4">

        <button
            type="button"
            @click="openOrdersModal = true"
            class="relative w-9 h-9 md:w-10 md:h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-slate-200 transition"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                ></path>
            </svg>

            <span
                x-show="orderCount > 0"
                x-text="orderCount"
                class="absolute -top-1 -right-1 min-w-[20px] h-5 px-1 bg-rose-600 text-white text-[10px] font-bold rounded-full flex items-center justify-center ring-2 ring-white"
            ></span>
        </button>

        <a href="/{{ $category }}"
           class="hidden sm:flex items-center space-x-2 bg-slate-100 text-slate-700 px-5 py-2.5 text-xs uppercase tracking-wider rounded-full hover:bg-slate-200 transition">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                ></path>
            </svg>

            <span>Boutique</span>
        </a>

        <button
            type="button"
            @click="mobileMenu = !mobileMenu"
            class="lg:hidden w-9 h-9 md:w-10 md:h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 hover:bg-slate-200 transition"
        >
            <svg x-show="!mobileMenu" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>

            <svg x-show="mobileMenu"
                 class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24"
                 style="display:none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

    </div>

    <div
        x-show="mobileMenu"
        x-transition.opacity
        @click.away="mobileMenu = false"
        class="lg:hidden absolute top-full left-0 right-0 bg-white border-b border-slate-100 shadow-lg px-4 py-3 space-y-1"
        style="display:none;"
    >

        <a href="/admin/boules-de-neige"
           class="block px-4 py-3 rounded-xl text-sm {{ $category == 'boules-de-neige' ? 'bg-slate-100 font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50' }}">
            Boules de Neige
        </a>

        <a href="/admin/nounours"
           class="block px-4 py-3 rounded-xl text-sm {{ $category == 'nounours' ? 'bg-slate-100 font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50' }}">
            Nounours
        </a>

        <a href="/admin/parfums"
           class="block px-4 py-3 rounded-xl text-sm {{ $category == 'parfums' ? 'bg-slate-100 font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50' }}">
            Parfums
        </a>

        <a href="/admin/cadeaux"
           class="block px-4 py-3 rounded-xl text-sm {{ $category == 'cadeaux' ? 'bg-slate-100 font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50' }}">
            Cadeaux
        </a>

        <a href="/{{ $category }}"
           class="block px-4 py-3 rounded-xl text-sm text-blue-600 font-medium sm:hidden hover:bg-blue-50">
            ← Voir la boutique
        </a>

    </div>

</header>


<main class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12 py-8 md:py-12">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 md:mb-10 gap-3 sm:gap-4">

        <div>
            <p class="text-[11px] uppercase tracking-[0.2em] text-blue-600 font-bold mb-1">
                Gestion Administrative
            </p>

            <h1 class="text-2xl md:text-4xl font-serif text-slate-900 capitalize">
                Produits : {{ str_replace('-', ' ', $category) }}
            </h1>
        </div>

        <a href="/{{ $category }}"
           class="inline-flex items-center space-x-2 border border-slate-300 text-slate-700 px-5 py-2.5 md:px-6 md:py-3 rounded-full text-xs uppercase tracking-wider hover:bg-slate-50 transition">
            <span>← Retour à la catégorie</span>
        </a>

    </div>


    @if(session('success'))

        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 md:px-6 py-3 md:py-4 rounded-2xl mb-6 md:mb-8 text-sm flex items-center space-x-3">

            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>

            <span>{{ session('success') }}</span>
        </div>

    @endif


    <div class="bg-white rounded-[20px] md:rounded-[24px] shadow-sm border border-slate-200/60 overflow-hidden">

        {{-- MOBILE --}}

        <div class="md:hidden divide-y divide-slate-100">

            @forelse($products as $product)

                <div class="p-4 flex flex-col gap-3">

                    <div class="flex items-center gap-3">

                        <img
                            src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-16 h-16 object-cover rounded-xl shadow-sm border border-slate-100 shrink-0"
                        >

                        <div class="min-w-0 flex-1">

                            <p class="font-bold text-slate-900 text-sm truncate">
                                {{ $product->name }}
                            </p>

                            <p class="text-xs text-slate-400 mt-0.5 line-clamp-2">
                                {{ $product->description }}
                            </p>

                            <p class="text-sm font-bold text-slate-900 mt-1">
                                {{ $product->price }}
                                <span class="text-xs font-normal text-slate-500">DH</span>
                            </p>

                        </div>

                    </div>


                    @if($product->tag)

                        <span class="self-start bg-blue-50 text-blue-700 border border-blue-100 text-[10px] uppercase font-bold tracking-wider px-3 py-1.5 rounded-full">
                            {{ $product->tag }}
                        </span>

                    @else

                        <span class="self-start text-xs text-slate-400 italic">
                            Aucun tag
                        </span>

                    @endif


                    <div class="flex gap-2">

                        {{-- MODIFIER MOBILE --}}

                        <button
                            type="button"
                            @click="
                                openEditModal = true;
                                editProduct = {
                                    id: {{ $product->id }},
                                    name: {{ Illuminate\Support\Js::from($product->name) }},
                                    tag: {{ Illuminate\Support\Js::from($product->tag) }},
                                    price: {{ Illuminate\Support\Js::from($product->price) }},
                                    image: {{ Illuminate\Support\Js::from($product->image) }},
                                    description: {{ Illuminate\Support\Js::from($product->description) }},
                                    imagePreview: null
                                };
                            "
                            class="flex-1 inline-flex items-center justify-center gap-1.5 bg-amber-50 text-amber-600 border border-amber-200 px-3 py-2.5 rounded-xl text-xs font-bold hover:bg-amber-500 hover:text-white hover:border-amber-500 transition-all duration-300"
                        >

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                ></path>
                            </svg>

                            <span>Modifier</span>

                        </button>


                        <form
                            action="{{ route('admin.destroy', ['category' => $category, 'id' => $product->id]) }}"
                            method="POST"
                            class="flex-1"
                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full inline-flex items-center justify-center gap-1.5 bg-rose-50 text-rose-600 border border-rose-200 px-3 py-2.5 rounded-xl text-xs font-bold hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all duration-300"
                            >

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>

                                <span>Supprimer</span>

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="py-16 text-center">

                    <div class="flex flex-col items-center justify-center space-y-3">

                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">

                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                ></path>
                            </svg>

                        </div>

                        <p class="text-slate-400 text-sm font-medium">
                            Aucun produit trouvé dans cette catégorie.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- DESKTOP --}}

        <div class="hidden md:block overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <thead>

                    <tr class="border-b border-slate-100 bg-slate-50 text-[11px] uppercase tracking-wider text-slate-500 font-bold">

                        <th class="py-5 px-6">Produit</th>
                        <th class="py-5 px-6">Tag</th>
                        <th class="py-5 px-6">Prix</th>
                        <th class="py-5 px-6 text-right">Actions</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100 text-sm">

                    @forelse($products as $product)

                        <tr class="hover:bg-slate-50/80 transition-colors group">

                            <td class="py-4 px-6">

                                <div class="flex items-center space-x-4">

                                    <img
                                        src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-14 h-14 object-cover rounded-xl shadow-sm border border-slate-100"
                                    >

                                    <div>

                                        <p class="font-bold text-slate-900">
                                            {{ $product->name }}
                                        </p>

                                        <p class="text-xs text-slate-400 mt-0.5 line-clamp-1 max-w-[200px]">
                                            {{ $product->description }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="py-4 px-6">

                                @if($product->tag)

                                    <span class="bg-blue-50 text-blue-700 border border-blue-100 text-[10px] uppercase font-bold tracking-wider px-3 py-1.5 rounded-full">
                                        {{ $product->tag }}
                                    </span>

                                @else

                                    <span class="text-xs text-slate-400 italic">
                                        Aucun
                                    </span>

                                @endif

                            </td>


                            <td class="py-4 px-6 font-bold text-slate-900">

                                {{ $product->price }}

                                <span class="text-xs font-normal text-slate-500">
                                    DH
                                </span>

                            </td>


                            <td class="py-4 px-6 text-right">

                                <div class="flex flex-col sm:flex-row sm:justify-end gap-2">

                                    {{-- MODIFIER DESKTOP --}}

                                    <button
                                        type="button"
                                        @click="
                                            openEditModal = true;
                                            editProduct = {
                                                id: {{ $product->id }},
                                                name: {{ Illuminate\Support\Js::from($product->name) }},
                                                tag: {{ Illuminate\Support\Js::from($product->tag) }},
                                                price: {{ Illuminate\Support\Js::from($product->price) }},
                                                image: {{ Illuminate\Support\Js::from($product->image) }},
                                                description: {{ Illuminate\Support\Js::from($product->description) }},
                                                imagePreview: null
                                            };
                                        "
                                        class="inline-flex items-center justify-center space-x-1.5 bg-amber-50 text-amber-600 border border-amber-200 px-4 py-2 rounded-xl text-xs font-bold hover:bg-amber-500 hover:text-white hover:border-amber-500 transition-all duration-300"
                                    >

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                            ></path>
                                        </svg>

                                        <span>Modifier</span>

                                    </button>


                                    <form
                                        action="{{ route('admin.destroy', ['category' => $category, 'id' => $product->id]) }}"
                                        method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="w-full inline-flex items-center justify-center space-x-1.5 bg-rose-50 text-rose-600 border border-rose-200 px-4 py-2 rounded-xl text-xs font-bold hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all duration-300"
                                        >

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                ></path>
                                            </svg>

                                            <span>Supprimer</span>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="py-20 text-center">

                                <div class="flex flex-col items-center justify-center space-y-3">

                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">

                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                            ></path>
                                        </svg>

                                    </div>

                                    <p class="text-slate-400 text-sm font-medium">
                                        Aucun produit trouvé dans cette catégorie.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</main>


{{-- NOTIFICATIONS MODAL --}}

<div
    x-show="openOrdersModal"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-start sm:items-center justify-center p-3 sm:p-6 overflow-y-auto"
    style="display:none;"
>

    <div
        @click.away="openOrdersModal = false"
        class="bg-white rounded-[24px] sm:rounded-[32px] w-full max-w-2xl shadow-2xl relative overflow-hidden flex flex-col max-h-[90vh] sm:max-h-[85vh] my-auto"
    >

        <div class="p-4 sm:p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50 shrink-0">

            <div>

                <h3 class="font-serif text-xl sm:text-2xl text-slate-900">
                    Nouvelles Commandes
                </h3>

                <p class="text-xs text-slate-500 mt-1">
                    Commandes en attente de validation
                </p>

            </div>

            <button
                type="button"
                @click="openOrdersModal = false"
                class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-900 transition shrink-0"
            >
                ✕
            </button>

        </div>


        <div class="p-4 sm:p-6 overflow-y-auto modal-scroll space-y-3 flex-1">

            @forelse($pendingOrders ?? [] as $order)

                <div
                    @click="selectedOrder = {{ json_encode($order) }}; openOrdersModal = false; openOrderDetailsModal = true;"
                    class="flex items-center justify-between gap-3 p-3 sm:p-4 bg-white border border-slate-200 rounded-2xl cursor-pointer hover:border-blue-400 hover:shadow-md transition-all group"
                >

                    <div class="flex items-center space-x-3 sm:space-x-4 min-w-0">

                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl overflow-hidden border border-slate-100 shadow-sm shrink-0">

                            <img
                                src="{{ Str::startsWith($order['product_image'], 'http') ? $order['product_image'] : asset('storage/' . $order['product_image']) }}"
                                alt="{{ $order['product_name'] }}"
                                class="w-full h-full object-cover"
                            >

                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-bold text-slate-900 truncate">
                                {{ $order['product_name'] }}
                            </p>

                            <p class="text-xs text-slate-500 mt-0.5 truncate">
                                {{ $order['name'] }} · {{ $order['city'] }}
                            </p>

                            <p class="text-xs font-bold text-emerald-600 mt-1">
                                {{ $order['total_price'] }} DH
                            </p>

                        </div>

                    </div>

                    <span class="text-xs font-bold text-blue-600 group-hover:translate-x-1 transition-transform shrink-0">
                        Voir →
                    </span>

                </div>

            @empty

                <div class="text-center py-10">
                    <p class="text-slate-400 text-sm">
                        Aucune nouvelle commande pour le moment.
                    </p>
                </div>

            @endforelse

        </div>

    </div>

</div>


{{-- ORDER DETAILS MODAL --}}

<div
    x-show="openOrderDetailsModal"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] flex items-start sm:items-center justify-center p-3 sm:p-6 overflow-y-auto"
    style="display:none;"
>

    <div
        @click.away="openOrderDetailsModal = false"
        class="bg-white rounded-[24px] sm:rounded-[32px] w-full max-w-4xl shadow-2xl relative overflow-hidden flex flex-col md:flex-row max-h-[92vh] sm:max-h-[90vh] my-auto"
    >

        <button
            type="button"
            @click="openOrderDetailsModal = false"
            class="absolute top-3 right-3 md:top-5 md:right-5 z-50 w-9 h-9 md:w-10 md:h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-slate-500 hover:text-slate-900 shadow-sm transition-all hover:rotate-90"
        >

            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                ></path>
            </svg>

        </button>


        <div class="w-full md:w-5/12 relative bg-slate-100 shrink-0 h-48 sm:h-64 md:h-auto md:min-h-full">

            <img
                :src="selectedOrder?.product_image?.startsWith('http')
                    ? selectedOrder.product_image
                    : '/storage/' + selectedOrder?.product_image"
                alt="Produit"
                class="absolute inset-0 w-full h-full object-cover"
            >

            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

            <div class="absolute bottom-4 left-4 right-4 md:bottom-6 md:left-6 md:right-6 text-white">

                <p class="text-[10px] uppercase tracking-[0.2em] text-white/70 font-bold mb-1">
                    Produit commandé
                </p>

                <h4
                    class="font-serif text-lg md:text-2xl"
                    x-text="selectedOrder?.product_name"
                ></h4>

                <div class="mt-2 inline-flex bg-white/20 backdrop-blur rounded-lg px-3 py-1">

                    <span
                        class="text-sm font-bold"
                        x-text="selectedOrder?.total_price + ' DH'"
                    ></span>

                </div>

            </div>

        </div>


        <div class="w-full md:w-7/12 p-5 sm:p-8 md:p-10 overflow-y-auto modal-scroll bg-white flex flex-col">

            <div class="mb-5 md:mb-6 border-b border-slate-100 pb-4">

                <p class="text-[10px] uppercase tracking-[0.2em] text-blue-600 font-bold mb-2">
                    Finaliser la commande
                </p>

                <h3 class="font-serif text-2xl md:text-3xl text-slate-900">
                    Détails du client
                </h3>

            </div>


            <div class="space-y-3 sm:space-y-4 mb-6 md:mb-8 flex-1">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">

                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">

                        <p class="text-[10px] uppercase text-slate-500 font-bold mb-1">
                            Client
                        </p>

                        <p
                            class="font-bold text-slate-900"
                            x-text="selectedOrder?.name"
                        ></p>

                    </div>

                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">

                        <p class="text-[10px] uppercase text-slate-500 font-bold mb-1">
                            Téléphone
                        </p>

                        <p
                            class="font-bold text-slate-900"
                            x-text="selectedOrder?.phone"
                        ></p>

                    </div>

                </div>


                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">

                    <p class="text-[10px] uppercase text-slate-500 font-bold mb-1">
                        Ville
                    </p>

                    <p
                        class="font-bold text-slate-900"
                        x-text="selectedOrder?.city"
                    ></p>

                </div>


                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">

                    <p class="text-[10px] uppercase text-slate-500 font-bold mb-1">
                        Adresse de livraison
                    </p>

                    <p
                        class="font-bold text-slate-900 leading-relaxed"
                        x-text="selectedOrder?.address"
                    ></p>

                </div>


                <div class="bg-slate-50 border border-slate-200/60 rounded-2xl p-4 sm:p-5 space-y-3 mt-4">

                    <div class="flex justify-between text-sm text-slate-600">

                        <span>Frais de livraison</span>

                        <span
                            class="font-semibold text-slate-900"
                            x-text="selectedOrder?.shipping_fee + ' DH'"
                        ></span>

                    </div>

                    <div class="border-t border-slate-200 pt-3 flex justify-between items-center">

                        <span class="font-bold text-slate-900">
                            Total à payer
                        </span>

                        <span
                            class="font-bold text-lg text-emerald-600"
                            x-text="selectedOrder?.total_price + ' DH'"
                        ></span>

                    </div>

                </div>

            </div>


            <div class="flex flex-col sm:flex-row gap-3 mt-auto pt-4">

                <form
                    :action="'/admin/order/' + selectedOrder?.id + '/accept'"
                    method="POST"
                    class="flex-1"
                >

                    @csrf

                    <button
                        type="submit"
                        @click="orderCount = Math.max(0, orderCount - 1); openOrderDetailsModal = false;"
                        class="w-full bg-emerald-600 text-white py-3.5 sm:py-4 rounded-full text-xs uppercase tracking-widest hover:bg-emerald-700 transition shadow-lg font-bold flex items-center justify-center space-x-2"
                    >

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            ></path>
                        </svg>

                        <span>Valider</span>

                    </button>

                </form>


                <form
                    :action="'/admin/order/' + selectedOrder?.id + '/refuse'"
                    method="POST"
                    class="flex-1"
                >

                    @csrf

                    <button
                        type="submit"
                        @click="orderCount = Math.max(0, orderCount - 1); openOrderDetailsModal = false;"
                        class="w-full bg-rose-50 text-rose-600 border border-rose-200 py-3.5 sm:py-4 rounded-full text-xs uppercase tracking-widest hover:bg-rose-600 hover:text-white transition shadow-sm font-bold flex items-center justify-center space-x-2"
                    >

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>

                        <span>Refuser</span>

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- EDIT MODAL --}}

<div
    x-show="openEditModal"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-start sm:items-center justify-center p-3 sm:p-6 overflow-y-auto"
    style="display:none;"
>

    <div
        @click.away="openEditModal = false"
        class="bg-white rounded-[24px] sm:rounded-[32px] w-full max-w-5xl shadow-2xl relative overflow-hidden flex flex-col md:flex-row max-h-[92vh] sm:max-h-[90vh] my-auto"
    >

        <button
            type="button"
            @click="openEditModal = false"
            class="absolute top-3 right-3 md:top-5 md:right-5 z-50 w-9 h-9 md:w-10 md:h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-slate-500 hover:text-slate-900 shadow-sm transition-all hover:rotate-90"
        >

            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                ></path>
            </svg>

        </button>


        <div class="w-full md:w-5/12 relative h-48 sm:h-60 md:h-auto md:min-h-[500px] bg-slate-100 shrink-0">

            <input
                type="file"
                name="image"
                form="editForm"
                accept="image/*"
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30"
                @change="
                    if ($event.target.files && $event.target.files[0]) {
                        editProduct.imagePreview = URL.createObjectURL($event.target.files[0]);
                    }
                "
            >


            <template x-if="editProduct.imagePreview || (editProduct.image && !editProduct.imagePreview)">

                <img
                    :src="
                        editProduct.imagePreview
                        ? editProduct.imagePreview
                        : (
                            editProduct.image.startsWith('http')
                            ? editProduct.image
                            : '/storage/' + editProduct.image
                        )
                    "
                    class="absolute inset-0 w-full h-full object-cover z-10 transition-opacity duration-300"
                    alt="Aperçu"
                >

            </template>


            <template x-if="!editProduct.imagePreview && !editProduct.image">

                <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-400 z-10 space-y-3">

                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                        ></path>
                    </svg>

                    <span class="text-sm font-medium">
                        Aucune image
                    </span>

                </div>

            </template>


            <div class="absolute inset-0 bg-slate-900/50 z-20 opacity-0 hover:opacity-100 transition-opacity flex flex-col items-center justify-center pointer-events-none text-white space-y-2">

                <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur flex items-center justify-center">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                        ></path>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                        ></path>
                    </svg>

                </div>

                <span class="text-xs font-bold uppercase tracking-wider">
                    Changer l'image
                </span>

            </div>

        </div>


        <div class="w-full md:w-7/12 p-5 sm:p-8 md:p-10 overflow-y-auto modal-scroll bg-white">

            <div class="mb-6 md:mb-8">

                <p class="text-[10px] uppercase tracking-[0.25em] text-blue-600 font-bold mb-2">
                    Modification
                </p>

                <h3 class="font-serif text-2xl md:text-3xl text-slate-900">
                    Détails du produit
                </h3>

                <p class="text-xs text-slate-500 mt-2">
                    Mettez à jour les informations ci-dessous.
                </p>

            </div>


            <form
                id="editForm"
                :action="'/admin/{{ $category }}/' + editProduct.id"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-4 sm:space-y-5"
            >

                @csrf
                @method('PUT')


                <div>

                    <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">
                        Nom du produit
                    </label>

                    <input
                        type="text"
                        name="name"
                        x-model="editProduct.name"
                        required
                        class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 sm:px-5 py-3 sm:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800"
                    >

                </div>


                <div>

                    <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">
                        Tag / Catégorie
                    </label>

                    <select
                        name="tag"
                        x-model="editProduct.tag"
                        class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 sm:px-5 py-3 sm:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800 cursor-pointer"
                    >

                        <option value="">
                            Sélectionnez un tag (Optionnel)
                        </option>


                        @if($category == 'boules-de-neige')

                            <option value="Grand">Grand</option>
                            <option value="Moyen">Moyen</option>
                            <option value="Petite">Petite</option>

                        @elseif($category == 'nounours')

                            <option value="Coup de cœur">Coup de cœur</option>
                            <option value="Édition douce">Édition douce</option>

                        @elseif($category == 'parfums')

                            <option value="Femme">Femme</option>
                            <option value="Homme">Homme</option>

                        @elseif($category == 'cadeaux')

                            <option value="Romantique">Romantique</option>
                            <option value="Anniversaire">Anniversaire</option>
                            <option value="Naissance">Naissance</option>
                            <option value="Merci">Merci</option>

                        @endif

                    </select>

                </div>


                <div>

                    <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">
                        Prix (DH)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        x-model="editProduct.price"
                        required
                        class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 sm:px-5 py-3 sm:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800"
                    >

                </div>


                <div>

                    <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1.5 font-bold">
                        Description
                    </label>

                    <textarea
                        name="description"
                        x-model="editProduct.description"
                        rows="3"
                        class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 sm:px-5 py-3 sm:py-3.5 text-sm focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition text-slate-800 resize-none"
                    ></textarea>

                </div>


                <button
                    type="submit"
                    class="w-full bg-[#121c2c] text-white py-3.5 sm:py-4 rounded-full text-xs uppercase tracking-[0.2em] font-medium hover:bg-slate-800 transition shadow-lg flex items-center justify-center space-x-2 mt-4 group"
                >

                    <span>
                        Enregistrer les modifications
                    </span>

                    <svg
                        class="w-4 h-4 transform group-hover:translate-x-1 transition-transform"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"
                        ></path>
                    </svg>

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>