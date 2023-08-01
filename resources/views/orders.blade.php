<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Оценка имущества') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="position-relative" >
                        <div style="margin: auto;width: 320px;border: 1px solid; border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));">
                        <a href="{{ route('evaluation.report') }}"><x-primary-button style="margin: auto; margin-top:20px;width: 290px; height: 80px; display: block" >{{ __('Создать ОТЧЕТ ОБ ОЦЕНКЕ движимого имущество') }}</x-primary-button></a>
                        <a href="{{ route('evaluation.rules') }}"><x-primary-button style="margin: auto; margin-top:20px; margin-bottom:20px;width: 290px; height: 80px; display: block" >{{ __('Документация') }}</x-primary-button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
