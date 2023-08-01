<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Изменение заказа №' . $order['id']) }}
            </h2>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" target="_blank" id="orderEditForm">
                        @csrf
                        <p>Заказ относится к договору № {{ $order['contract']  }}</p>

                            <div class="mt-4">
                                <x-input-label for="customer" :value="__('Заказчик:')"/>
                                <select id="customer" class="search-select block mt-1 w-full"  name="customer" style="border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));">
                                    <option selected style="display: none" value="{{ $order['customer']  }}">{{ $order['fio'] }}</option>
                                    @foreach($customers as $index => $customer)
                                        <option value="{{ $customer['id'] }}">{{ $customer['fio'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="object" :value="__('Объект заказа:')" />
                                <x-text-input class="block mt-1 w-full" type="text" name="object" id="object" maxlength="300" required value="{{ $order['object'] }}"/>
                            </div>


                            <div class="mt-4">
                                <x-input-label for="sum" :value="__('Сумма заказа:')" />
                                <x-text-input class="block mt-1 w-full" type="text" name="sum" id="sum" maxlength="30" required value="{{ $order['sum'] }}"/>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="status" :value="__('Статус заказа:')"/>
                                <select class="block mt-1 w-full" id="status" name="status" style="border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));">
                                    <option selected style="display: none" value="{{ $order['status'] }}">{{ $order['status'] }}</option>
                                    <option value="0">0 - (В работе)</option>
                                    <option value="1">1 - (Завершен)</option>
                                </select>
                            </div>
                        <div class="mt-4">
                            <x-input-label for="date" :value="__('Дата:')"/>
                            <x-text-input class="block mt-1 " type="date" name="date" id="date" required value="{{ $order['date'] }}"/>
                        </div>

                        <div class="flex items-center gap-4" style="padding-top: 25px">
                            <x-primary-button class="editButtonOrder">{{ __('Сохранить') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
