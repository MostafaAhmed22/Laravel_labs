

@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container mx-auto px-4 mt-12 max-w-5xl">
    <!-- Alpine.js Carousel Controller -->
    <div x-data="{ 
        activeSlide: 0, 
        slides: [
            { title: 'trika', subtitle: '', img: 'https://via.placeholder.com/1200x500/810000/ffffff?text=Trika+Magic' },
            { title: 'trika', subtitle: '', img: 'https://via.placeholder.com/1200x500/810000/ffffff?text=El+Majico' },
            { title: 'trika goal', subtitle: 'ahly - zamalek', img: 'https://via.placeholder.com/1200x500/810000/ffffff?text=The+Derby+King' }
        ],
        next() { this.activeSlide = (this.
         + 1) % this.slides.length },
        prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length }
    }" 
    class="relative overflow-hidden rounded-2xl bg-gray-900 shadow-xl border border-gray-800">
        
        <!-- Slides Wrapper -->
        <div class="relative h-[450px]">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" 
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute inset-0">
                    
                    <!-- Background Image with Overlay -->
                    <img :src="slide.img" :alt="slide.title" class="absolute inset-0 h-full w-full object-cover opacity-80" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    
                    <!-- Text Caption Content -->
                    <div class="absolute inset-x-0 bottom-0 p-8 text-center md:text-left md:p-12">
                        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl capitalize" x-text="slide.title"></h2>
                        <template x-if="slide.subtitle">
                            <p class="mt-2 text-sm text-gray-300 uppercase tracking-widest font-semibold" x-text="slide.subtitle"></p>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <!-- Left / Right Navigation Controls -->
        <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 rounded-full bg-white/20 p-3 text-white backdrop-blur-sm transition hover:bg-white/30 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>

        <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 rounded-full bg-white/20 p-3 text-white backdrop-blur-sm transition hover:bg-white/30 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>

        <!-- Slide Indicators -->
        <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 gap-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" 
                        :class="activeSlide === index ? 'w-8 bg-white' : 'w-2 bg-white/50'"
                        class="h-2 rounded-full transition-all duration-300 focus:outline-none">
                </button>
            </template>
        </div>

    </div>
</div>
@endsection