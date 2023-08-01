<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Добавление нового договора') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" target="_blank" id="contractForm">
                        @csrf

                            <div >
                                <x-input-label for="customer" :value="__('Заказчик:')"/>
                                <select id="customer" class="search-select block mt-1 w-full" name="customer" style="border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));">
                                    <option selected style="display: none"  disabled></option>
                                    @foreach($customers as $index => $customer)
                                    <option value="{{ $customer['id'] }}">{{ $customer['fio'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="sum" :value="__('Сумма договора:')"/>
                                <x-text-input class="block mt-1 w-full" type="text" name="sum" id="sum" maxlength="30" required/>
                            </div>
                        <div class="mt-4">
                            <x-input-label for="objects" :value="__('Объекты оценки:')"/>
                            <textarea class="block mt-1 w-full" type="text" name="objects" id="objects" maxlength="255" required style="height: 120px;resize: none;border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));" ></textarea>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="contacts" :value="__('Контактная информация заказчика:')"/>
                            <textarea class="block mt-1 w-full" type="text" name="contacts" id="contacts" maxlength="255" required style="height: 120px;resize: none;border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));" ></textarea>
                        </div>
                                <div class="mt-4">
                                    <x-input-label for="date" :value="__('Дата оформления договора:')"/>
                                    <x-text-input class="block mt-1 " type="date" name="date" id="date" maxlength="30" required/>
                                </div>

                        <p style="padding-top: 20px">*Все поля обязательны для заполнения</p>
                        <div style="margin-top: 20px"><label for="download">Автоматически заполнить и скачать договор</label><input id="checkb" style="margin-left: 10px"type="checkbox" name="download"></div>
                        <div class="flex items-center gap-4" style="padding-top: 25px">
                            <x-primary-button class="addButtonContract">{{ __('Добавить новый договор') }}</x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
