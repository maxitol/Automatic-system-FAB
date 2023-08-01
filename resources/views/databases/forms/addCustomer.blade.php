<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Добавление нового заказчика') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" id="customerForm"target="_blank">
                        @csrf


                            <div>
                                <x-input-label for="fio" :value="__('ФИО*:')"/>
                                <x-text-input class="block mt-1 w-full" type="text" name="fio" id="fio" maxlength="30" required/>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="type" :value="__('Вид заказчика*:')" />
                                <select class="block mt-1 w-full" id="type" value="Выберите тип" name="type" required style="border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));">
                                    <option selected style="display: none" disabled ></option>
                                    <option value="Физическое лицо">Физическое лицо</option>
                                    <option value="ИП">ИП</option>
                                    <option value="ООО">ООО</option>
                                    <option value="Юридическое лицо">Юридическое лицо</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="contacts" :value="__('Контакты*:')" />
                                <x-text-input class="block mt-1 w-full" type="text" name="contacts" id="contacts" maxlength="30" required/>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="name" :value="__('Наименование организации:')"/>
                                <x-text-input  class="block mt-1 w-full" type="text" name="name" id="name" maxlength="30" />
                            </div>


                            <p style="padding-top: 20px">*Данне поля обязательны к заполнению</p>
                        <div class="flex items-center gap-4" style="padding-top: 25px">
                            <x-primary-button class="addButtonCustomer">{{ __('Добавить нового заказчика') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
