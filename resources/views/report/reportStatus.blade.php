<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Отчёт: Заказы по статусу') }}
            </h2>
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150" style="padding-top:20px; padding-left: 0px">
                            <div>{{'Показать список отчетов'}}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('reportDateDocument')">
                            {{ __('Заказы за период') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('reportStatus')">
                            {{ __('Заказы по статусу') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('reportSum')">
                            {{ __('Прибыль за период') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('lastChanges')">
                            {{ __('Изменения справочников') }}
                        </x-dropdown-link>

                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <form  method="post" action="{{ route('reportStatusSend') }}" class="p-6">
                    @csrf

                    <div style="display: flex; width: 100%;">
                        <span style="margin-top: 27px;font-weight: bolder">Выберете статус заказа</span>
                        <div style="padding-left: 20px">
                            <x-input-label for="status" :value="__('Статус заказа:')"/>
                            <select id="status" name="status" style="border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));">
                                <option selected style="display: none" disabled></option>
                                <option value="0">0 - (В работе)</option>
                                <option value="1">1 - (Завершен)</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center gap-4" style="padding-top: 25px">
                        <x-primary-button>{{ __('Создать отчёт') }}</x-primary-button>
                    </div>
                </form>

            </div>
            @if(isset($orders) && count($orders) != 0)
                @if(count($orders) == 0)
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <p style="font-size: 30px">{{ __('Пустая выборка')}}</p>
                    </div>>

                @else
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <p style="font-size: 30px">{{ __('Отчет по статусу заказов: ' . $status)}}</p>
                    <hr>
                    <p style="font-size: 20px">{{ __('Количество заказов за период: ' . count($orders))}}</p>
                    <hr>
                    <table style = "margin-top10px;width: 100%;" id="table">
                        <thead>
                        <tr style = "background-color: rgb(243 244 246)">
                            <th>#id</th>
                            <th>Заказчик</th>
                            <th>Объект заказа</th>
                            <th>Дата заказа</th>
                            <th>Номер договора</th>
                            <th>Сумма заказа</th>
                            <th>Статус заказа</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $index => $order)
                            <tr>
                                <td style="text-align: center">{{ $order['id'] }}</td>
                                <td>{{ $order['fio'] }}</td>
                                <td>{{ $order['object'] }}</td>
                                <td>{{ date('d.m.Y', strtotime($order['date'])) }}</td>
                                <td>{{ $order['contract'] }}</td>
                                <td>{{ $order['sum'] }}</td>
                                <td>{{ $order['status'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                @endif
            @endif
        </div>
    </div>

</x-app-layout>
