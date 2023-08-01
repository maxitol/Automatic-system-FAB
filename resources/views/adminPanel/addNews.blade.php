<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Добавление новости') }}
            </h2>
        </div>
        <div class="hidden sm:flex sm:items-center">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150" style="padding-top:20px; padding-left: 0px">
                        <div>{{'Показать список функций'}}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('addNews')">
                        {{ __('Добавить новость') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('userPanel')">
                        {{ __('Панель управления пользователями') }}
                    </x-dropdown-link>

                </x-slot>
            </x-dropdown>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" id="newForm">
                        @csrf

                        <div style="display: flex; width: 100%">
                            <textarea style="width: 100%; height: 558px; resize: none" type="text" name="text" id="text" max="50" required></textarea>
                        </div>

                        <div class="flex items-center gap-4" style="padding-top: 25px">
                            <x-primary-button class="addButtonNews">{{ __('Опубликовать новость') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
