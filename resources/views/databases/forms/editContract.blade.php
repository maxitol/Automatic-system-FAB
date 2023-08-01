<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Изменение договора №' . $contract['id']) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" target="_blank" id="contractEditForm">
                        @csrf

                        <div style=" width: 100%">

                            <div >
                                <x-input-label for="customer" :value="__('Заказчик:')"/>
                                <select id="customer" class="search-select block mt-1 w-full" name="customer" style=" border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));">
                                    <option selected style="display: none" value="{{ $contract['customer'] }}">{{ $contract['fio'] }}</option>
                                    @foreach($customers as $index => $customer)
                                        <option value="{{ $customer['id'] }}">{{ $customer['fio'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="objects" :value="__('Объекты оценки:')"/>
                                <textarea type="text" class="block mt-1 w-full" name="objects" id="objects" maxlength="255" required style="height: 120px;resize: none; border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));" >{{ $contract['objects'] }}</textarea>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="date" :value="__('Дата оформления договора:')"/>
                                <x-text-input type="date" class="block mt-1 " name="date" id="date" maxlength="30" required value="{{ $contract['date'] }}"/>
                            </div>
                            </div>

                        <div class="flex items-center gap-4" style="padding-top: 25px">
                            <x-primary-button class="editButtonContract">{{ __('Сохранить') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
