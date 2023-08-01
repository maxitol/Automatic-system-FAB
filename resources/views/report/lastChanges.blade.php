<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Отчёт: Изменения справочников') }}
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

                <form  method="post" action="{{ route('lastChangesSend') }}" class="p-6">
                    @csrf


                        <span style="font-weight: bolder">Укажите параметры</span>
                        <div class="mt-4">
                            <x-input-label for="type" :value="__('Тип справочника:')"/>
                            <select id="type" class="block mt-1 w-full" name="type" style="border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));">
                                <option selected style="display: none" disabled></option>
                                <option value="Договор">Договор</option>
                                <option value="Заказ">Заказ</option>
                                <option value="Заказчик">Заказчик</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="user" :value="__('Пользователь:')"/>
                            <select id="user" class="search-select block mt-1 w-full" name="user" style="border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));">
                                <option selected style="display: none" disabled></option>
                                @foreach($nameUsers as $index => $nameUser)
                                    <option value="{{ $nameUser['name'] }}">{{ $nameUser['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div style="display: flex">
                    <div class="mt-4">
                        <x-input-label for="startdate" :value="__('Период с:')"/>
                        <x-text-input class="block mt-1 " type="date" name="startdate" id="startdate"  />
                    </div>

                    <div style="margin-left: 20px" class="mt-4">
                        <x-input-label for="finishdate" :value="__('Период по:')"/>
                        <x-text-input class="block mt-1 " type="date" name="finishdate" id="finishdate"  />
                    </div>
                        </div>

                    <div class="flex items-center gap-4" style="padding-top: 25px">
                        <x-primary-button>{{ __('Создать отчёт') }}</x-primary-button>
                    </div>
                </form>

            </div>
            @if(isset($changes))
                @if(count($changes) == 0)
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <p style="font-size: 30px">{{ __('Пустая выборка')}}</p>
                    </div>
                @else
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <p style="font-size: 30px">{{ __('Отчет по измением в справочниках')}}</p>
                    <hr>
                    @if($startdate != '' || $finishdate != '')
                         <p style="font-size: 20px">{{ __('За период: ')}}@if($startdate != '') с {{ date('d.m.Y', strtotime($startdate)) }}@endif @if($finishdate != '') по {{ date('d.m.Y', strtotime($finishdate)) }}@endif</p>
                    @endif
                    @if($user != '')
                        <p style="font-size: 20px">{{ __('По изменениям пользователя: ' . $user)}}</p>
                    @endif
                    @if($type != '')
                        <p style="font-size: 20px">{{ __('По типу справочника: ' . $type)}}</p>
                    @endif
                    <hr>
                    <table style = "margin-top: 10px;width: 100%;" id="table">
                        <thead>
                        <tr style = "background-color: rgb(243 244 246)">
                            <th>#id</th>
                            <th>Справочник</th>
                            <th>Номер записи</th>
                            <th>Дата и время изменения</th>
                            <th>Пользователь</th>
                            <th>Поле</th>
                            <th>Значение до изменения</th>
                            <th>Значение после изменения</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($changes as $index => $change)
                            <tr>
                                <td style="text-align: center">{{ $change['id'] }}</td>
                                <td>{{ $change['type'] }}</td>
                                <td>{{ $change['typeId'] }}</td>
                                <td>{{ date('d.m.Y H:i:s', strtotime($change['date'])) }}</td>
                                <td>{{ $change['user'] }}</td>
                                <td>{{ $change['typeColumn'] }}</td>
                                <td>{{ $change['oldValue'] }}</td>
                                <td>{{ $change['newValue'] }}</td>
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
