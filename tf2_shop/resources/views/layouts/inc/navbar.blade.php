<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<nav class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
    <!-- Logo -->
    <a href="{{ route('home') }}" wire:navigate class="mx-auto md:mx-0 flex items-center">
        <span class="self-center text-5xl whitespace-nowrap">TradePlaza</span>
    </a>

    <!-- Search Form -->
    <form action="{{ route('products.search') }}" method="GET" class="flex-grow flex items-center mx-4">
        <div class="relative w-full">
            <input type="search" name="query" id="search-dropdown"
                class="block p-2.5 w-full z-20 text-[1.25rem] text-white bg-transparent rounded-[1.25rem] border-[#FF9D00] border-[0.125rem] placeholder-white"
                placeholder="Search" value="{{ request('query') }}" required />
            <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </form>

    <!-- Nav Links -->
    <div class="flex items-center space-x-6 mx-auto md:mx-0 mt-4 md:mt-0">

        <a href="{{ route('products.index') }}" class="text-[#FF9D00] font-tf2 flex flex-col items-center">
            <img src="{{ asset('icons/navigation/sell.svg') }}" class="w-[2.5rem] h-[2.5rem] mx-auto">sell
        </a>

        <a href="{{ route('cart.index') }}" class="text-[#FF9D00] font-tf2 flex flex-col items-center relative">
            <img src="{{ asset('icons/navigation/cart.svg') }}" class="w-[2.em] h-[2.5rem] mx-auto">cart
            @if ($cartCount > 0)
                <span
                    class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-600 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
            @endif
        </a>

        <a href="{{ route('contact') }}" class="text-[#FF9D00] font-tf2 flex flex-col items-center">
            <img src="{{ asset('icons/navigation/contact.svg') }}" class="w-[2.5rem] h-[2.5rem] mx-auto">contact us
        </a>

        @auth
            <!-- If user is logged in: Show Profile + Logout -->
            <a href="{{ route('profile') }}" wire:navigate class="text-[#FF9D00] font-tf2 flex flex-col items-center">
                <img src="{{ asset('icons/navigation/profile.svg') }}" class="w-[2.5rem] h-[2.5rem] mx-auto">profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-[#FF9D00] font-tf2 flex flex-col items-center focus:outline-none">
                    <img src="{{ asset('icons/navigation/logout.svg') }}" type="svg" class="w-[2.5rem] h-[2.5rem] mx-auto">log out
                </button>
            </form>
        @else
            <!-- If user is guest: Show Sign In -->
            <a href="{{ route('register') }}" wire:navigate class="text-[#FF9D00] font-tf2 flex flex-col items-center">
                <img src="{{ asset('icons/navigation/login.svg') }}" class="w-[2.5rem] h-[2.5rem] fill-[#FF9D00] mx-auto">sign up
            </a>
        @endauth

    </div>
</nav>
