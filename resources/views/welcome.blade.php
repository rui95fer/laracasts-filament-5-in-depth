<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
<header class="w-full lg:max-w-4xl max-w-83.75 text-sm mb-6 not-has-[nav]:hidden">
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>
<x-feature-card :feature="App\Models\Feature::query()
            ->whereNot('status', App\Enums\Feature\FeatureStatus::Cancelled)
            ->where('id', 3)
            ->withCount(['votes', 'comments'])
            ->withExists(['votes as hasVoted' => fn ($q) => $q->where('user_id', auth()->id())])
            ->first()"/>
<section class="w-full max-w-4xl mx-auto">
    <div class="mb-12 text-center">
        <span
            class="inline-flex items-center gap-2 px-3 py-1 mb-4 text-xs font-medium tracking-wider uppercase rounded-full bg-violet-500/10 text-violet-500 dark:bg-violet-400/10 dark:text-violet-400">
            <span class="w-1.5 h-1.5 rounded-full bg-violet-500 dark:bg-violet-400 animate-pulse"></span>
            Product Roadmap
        </span>
        <h2 class="text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
            Shape the Future
        </h2>
        <p class="mt-3 text-zinc-500 dark:text-zinc-400">
            Vote on features you want us to build next
        </p>
    </div>

    <div class="flex flex-wrap items-center justify-center gap-2 mb-8">
        <button type="button"
                class="px-4 py-2 text-sm font-medium transition-all rounded-lg cursor-pointer bg-zinc-900 text-white dark:bg-white dark:text-zinc-900">
            All Features
        </button>
        <button type="button"
                class="px-4 py-2 text-sm font-medium transition-all rounded-lg cursor-pointer text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800">
            Proposed
        </button>
        <button type="button"
                class="px-4 py-2 text-sm font-medium transition-all rounded-lg cursor-pointer text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800">
            Planned
        </button>
        <button type="button"
                class="px-4 py-2 text-sm font-medium transition-all rounded-lg cursor-pointer text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800">
            In Progress
        </button>
        <button type="button"
                class="px-4 py-2 text-sm font-medium transition-all rounded-lg cursor-pointer text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800">
            Completed
        </button>
    </div>

    <div class="space-y-4">
        <article
            class="group relative overflow-hidden rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 transition-all hover:border-violet-500/50 hover:shadow-lg hover:shadow-violet-500/5">
            <div
                class="absolute inset-0 bg-linear-to-r from-violet-500/5 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative flex gap-6">
                <div class="flex flex-col items-center shrink-0">
                    <button type="button"
                            class="flex flex-col cursor-pointer items-center justify-center w-16 h-20 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 transition-all hover:border-violet-500 hover:bg-violet-50 dark:hover:bg-violet-500/10 group/vote">
                        <svg class="w-5 h-5 text-zinc-400 transition-colors group-hover/vote:text-violet-500"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
                        </svg>
                        <span class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">247</span>
                    </button>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                                Real-time Collaboration
                            </h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-2">
                                Enable multiple team members to work on projects simultaneously with live cursors,
                                instant updates, and seamless conflict resolution.
                            </p>
                        </div>
                        <span
                            class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Planned
                        </span>
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                        <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                            </svg>
                            32 comments
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                            </svg>
                            Core Feature
                        </span>
                    </div>
                </div>
            </div>
        </article>

        <article
            class="group relative overflow-hidden rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 transition-all hover:border-violet-500/50 hover:shadow-lg hover:shadow-violet-500/5">
            <div
                class="absolute inset-0 bg-linear-to-r from-violet-500/5 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative flex gap-6">
                <div class="flex flex-col items-center shrink-0">
                    <button type="button"
                            class="flex flex-col cursor-pointer items-center justify-center w-16 h-20 rounded-xl border border-violet-500 bg-violet-50 dark:bg-violet-500/10 group/vote">
                        <svg class="w-5 h-5 text-violet-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M5 15l7-7 7 7"/>
                        </svg>
                        <span class="mt-1 text-xl font-bold text-violet-600 dark:text-violet-400">189</span>
                        <span class="text-[10px] text-violet-500 font-medium">VOTED</span>
                    </button>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                                AI-Powered Analytics
                            </h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-2">
                                Get intelligent insights and predictions powered by machine learning. Automatically
                                identify trends and anomalies in your data.
                            </p>
                        </div>
                        <span
                            class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                            In Progress
                        </span>
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                        <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                            </svg>
                            18 comments
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                            </svg>
                            AI / ML
                        </span>
                    </div>
                </div>
            </div>
        </article>

        <article
            class="group relative overflow-hidden rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 transition-all hover:border-violet-500/50 hover:shadow-lg hover:shadow-violet-500/5">
            <div
                class="absolute inset-0 bg-linear-to-r from-violet-500/5 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative flex gap-6">
                <div class="flex flex-col items-center shrink-0">
                    <button type="button"
                            class="flex flex-col cursor-pointer items-center justify-center w-16 h-20 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 transition-all hover:border-violet-500 hover:bg-violet-50 dark:hover:bg-violet-500/10 group/vote">
                        <svg class="w-5 h-5 text-zinc-400 transition-colors group-hover/vote:text-violet-500"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
                        </svg>
                        <span class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">156</span>
                    </button>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                                Dark Mode Support
                            </h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-2">
                                Full dark mode support across the entire application with automatic system preference
                                detection and manual toggle option.
                            </p>
                        </div>
                        <span
                            class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>
                            Completed
                        </span>
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                        <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                            </svg>
                            45 comments
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                            </svg>
                            UI / UX
                        </span>
                    </div>
                </div>
            </div>
        </article>

        <article
            class="group relative overflow-hidden rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 transition-all hover:border-violet-500/50 hover:shadow-lg hover:shadow-violet-500/5">
            <div
                class="absolute inset-0 bg-linear-to-r from-violet-500/5 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative flex gap-6">
                <div class="flex flex-col items-center shrink-0">
                    <button type="button"
                            class="flex flex-col cursor-pointer items-center justify-center w-16 h-20 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 transition-all hover:border-violet-500 hover:bg-violet-50 dark:hover:bg-violet-500/10 group/vote">
                        <svg class="w-5 h-5 text-zinc-400 transition-colors group-hover/vote:text-violet-500"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
                        </svg>
                        <span class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">98</span>
                    </button>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                                API Webhooks
                            </h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-2">
                                Configure custom webhooks to receive real-time notifications about events in your
                                workspace. Integrate with Slack, Discord, and more.
                            </p>
                        </div>
                        <span
                            class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span>
                            Proposed
                        </span>
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                        <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                            </svg>
                            12 comments
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                            </svg>
                            Integrations
                        </span>
                    </div>
                </div>
            </div>
        </article>

        <article
            class="group relative overflow-hidden rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 transition-all hover:border-violet-500/50 hover:shadow-lg hover:shadow-violet-500/5">
            <div
                class="absolute inset-0 bg-linear-to-r from-violet-500/5 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative flex gap-6">
                <div class="flex flex-col items-center shrink-0">
                    <button type="button"
                            class="flex flex-col cursor-pointer items-center justify-center w-16 h-20 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 transition-all hover:border-violet-500 hover:bg-violet-50 dark:hover:bg-violet-500/10 group/vote">
                        <svg class="w-5 h-5 text-zinc-400 transition-colors group-hover/vote:text-violet-500"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
                        </svg>
                        <span class="mt-1 text-xl font-bold text-zinc-900 dark:text-white">76</span>
                    </button>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                                Mobile App (iOS & Android)
                            </h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-2">
                                Native mobile applications for iOS and Android with push notifications, offline support,
                                and biometric authentication.
                            </p>
                        </div>
                        <span
                            class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Planned
                        </span>
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                        <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                            </svg>
                            28 comments
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                            </svg>
                            Mobile
                        </span>
                    </div>
                </div>
            </div>
        </article>
    </div>

    <div class="flex items-center justify-center gap-2 mt-8">
        <button type="button"
                class="p-2 transition-colors rounded-lg cursor-pointer text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 disabled:opacity-50 disabled:cursor-not-allowed"
                disabled>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <span
            class="px-4 py-2 text-sm font-medium rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-white">1</span>
        <button type="button"
                class="px-4 py-2 text-sm font-medium transition-colors rounded-lg cursor-pointer text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800">
            2
        </button>
        <button type="button"
                class="px-4 py-2 text-sm font-medium transition-colors rounded-lg cursor-pointer text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800">
            3
        </button>
        <button type="button"
                class="p-2 transition-colors rounded-lg cursor-pointer text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</section>

</body>
</html>
