<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Панель управления пользователями системы') }}
            </h2>
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150" style="padding-top:20px; padding-left: 0px">
                            <div>{{'Функции панели'}}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('addNews')">
                            {{ __('Добавить новость') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('userPanel')">
                            {{ __('Панель управления пользователями') }}
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
                    <div class="flex items-center gap-4" style="padding-bottom: 25px" style="padding-bottom: 25px" >
                        <a href="{{ route('newUser') }}"><x-primary-button>{{ __('Добавить нового пользователя') }}</x-primary-button></a>
                    </div>
                    <table style = "width: 100%;" id="table">
                        <thead>
                        <tr style = "background-color: rgb(243 244 246)">
                            <th>#id</th>
                            <th>ФИО</th>
                            <th>Электронная почта</th>
                            <th>Роль</th>
                            <th>Удаление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td style="text-align: center">{{ $user['id'] }}</td>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user['role'] }}</td>
                                <td style="width: 50px;text-align: center"><a class="deleteUser" id="{{ $user['id'] }}" title="Удалить пользователя" style="display: inline-table;}"><img style="display: -webkit-inline-box;height: 20px; width: 20px" src="/images/minus.png"></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
