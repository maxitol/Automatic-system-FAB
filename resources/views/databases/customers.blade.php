<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Справочник: Заказчики') }}
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
                    <div class="flex items-center gap-4" style="padding-bottom: 25px; width: 100%;justify-content: space-between;" >
                    <div>
                        <a href="{{ route('databases.addCustomers') }}"><x-primary-button>{{ __('Добавить нового заказчика') }}</x-primary-button></a>
                    </div>
                        <div class="container" >
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
                            <th>#id</th>
                            <th>ФИО заказчика</th>
                            <th>Вид заказчика</th>
                            <th>Контакты</th>
                            <th>Наименование организации</th>
                            <th>Редактирование</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $index => $customer)
                            <tr>
                                <td style="text-align: center">{{ $customer['id'] }}</td>
                                <td>{{ $customer['fio'] }}</td>
                                <td>{{ $customer['type'] }}</td>
                                <td>{{ $customer['contacts'] }}</td>
                                <td>{{ $customer['name'] }}</td>

                                    <td style="width: 60px;text-align: center"><a href="{{ route('databases.editCustomersForm', ['id' => $customer['id']]) }}"title="Изменить строку" style="display: inline-table;}" ><img style="display: -webkit-inline-box;height: 20px; width: 20px;margin-right: 20px;" src="/images/edit.png"></a>
                                        @can('view', auth()->user())
                                        <a class="deleteCustomer" id="{{ $customer['id'] }}" title="Удалить строку" style="display: inline-table;}"><img style="display: -webkit-inline-box;height: 20px; width: 20px" src="/images/minus.png"></a>
                                        @endcan
                                    </td>

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
