<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Добавление нового заказа к Договору №'. $idCon) }}
            </h2>
        </div>
    </x-slot>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="post" target="_blank" id="orderForm">
                            @csrf
                                <div>
                                    <input name="customer" id="customer" type="hidden" value="{{ $contract['customer'] }}"/>
                                </div>
                                <div>
                                    <input name="contract" id="contract" type="hidden" value="{{ $idCon }}"/>
                                </div>


                                <div >
                                    <x-input-label for="sum" :value="__('Сумма заказа:')" />
                                    <x-text-input class="block mt-1 w-full" type="text" name="sum" id="sum" maxlength="30" required />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="object" :value="__('Объект заказа:')" />
                                    <x-text-input class="block mt-1 w-full" type="text" name="object" id="object" maxlength="255" required />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="date" :value="__('Дата:')"/>
                                    <x-text-input class="block mt-1" type="date" name="date" id="date" required />
                                </div>


                            <p style="padding-top: 20px">*Все поля обязательны для заполнения</p>
                            <div class="flex items-center gap-4" style="padding-top: 25px">
                                <x-primary-button class="addButtonOrder">{{ __('Добавить новый заказ') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
