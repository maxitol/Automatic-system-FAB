<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Справочник: Договоры') }}
            </h2>
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150" style="padding-top:20px; padding-left: 0px">
                            <div>{{'Показать список справочников'}}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('databases.orders')">
                            {{ __('Заказы') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('databases.customers')">
                            {{ __('Заказчики') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('databases.contracts')">
                            {{ __('Договоры') }}
                        </x-dropdown-link>

                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" >
                    <div class="flex items-center gap-4" style="padding-bottom: 25px;width: 100%;justify-content: space-between;" >
                        <div>
                            <a href="{{ route('databases.addContracts') }}"><x-primary-button>{{ __('Добавить новый договор') }}</x-primary-button></a>
                        </div>
                        <div class="container">
                            <div style="display: flex">
                                    <span id="clear-input" title="Сброс" style="display: none;">&times;</span>
                                    <div>
                                        <input type="text" id="search-input" maxlength= "25" placeholder="Поиск по таблице" class="searchbar"/>
                                    </div>
                                </div>
                            <img src="https://images-na.ssl-images-amazon.com/images/I/41gYkruZM2L.png" id="search-button" alt="search icon" class="button">
                        </div>
                    </div>
                    <div class="htable">
                    <table style = "width: 100%;" id="table">
                        <thead>
                        <tr style = "background-color: rgb(243 244 246)">
                            <th>№ Договора</th>
                            <th>Заказчик</th>
                            <th>Объекты оценки</th>
                            <th>Дата договора</th>
                            <th>Редактирование</th>
                            <th>Заказы</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contracts as $index => $contract)
                                <tr id="idOrder-{{ $contract['id'] }}">
                                <td style="text-align: center">{{ $contract['id'] }}</td>
                                <td>{{ $contract['fio'] }}</td>
                                <td>{{ $contract['objects'] }}</td>
                                <td>{{ date('d.m.Y', strtotime($contract['date'])) }}</td>

                                    <td style="width: 60px;text-align: center">
                                        <a href="{{ route('databases.editContractsForm', ['id' => $contract['id']]) }}" class="editOrder" id="{{ $contract['id'] }}" title="Изменить строку" style="display: inline-table;}"><img style="display: -webkit-inline-box;height: 20px; width: 20px;margin-right: 20px;" src="/images/edit.png"></a>
                                        @can('view', auth()->user())
                                        <a class="deleteContract" id="{{ $contract['id'] }}" title="Удалить строку" style="display: inline-table;}"><img style="display: -webkit-inline-box;height: 20px; width: 20px" src="/images/minus.png"></a>
                                        @endcan
                                    </td>
                                    <td style="text-align: center"><div><a href="{{ route('databases.addOrders', ['id' => $contract['id']]) }}" title="Добавить заказ к договору"><img style="display: -webkit-inline-box;height: 20px; width: 20px;" src="/images/plus.png"></a></div></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
