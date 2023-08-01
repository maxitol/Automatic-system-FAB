<x-app-layout>
    <x-slot name="header" >
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Создание отчета об оценки движимого имущества') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" target="_blank" enctype="multipart/form-data" action="{{ route('reportDownload') }}">
                        @csrf

                            <!--<div>
                                <x-input-label for="customer" :value="__('Заказчик:')"/>
                                <select id="customer" class="search-select block mt-1 w-full" name="customer" style="border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));" required>
                                    <option selected style="display: none"  disabled></option>
                                    @foreach($customers as $index => $customer)
                                        <option value="{{ $customer['id'] }}">{{ $customer['fio'] }}</option>
                                    @endforeach
                                </select>
                            </div>-->
                            <div >
                                <x-input-label for="order" :value="__('Заказ №:')"/>
                                <select id="order" class="search-select block mt-1 w-full" name="order" style="border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));" required>
                                    <option selected style="display: none"  disabled></option>
                                    @foreach($orders as $index => $order)
                                        <option value="{{ $order['id'] }}">{{ $order['id'] . " -> ( " . \App\Models\customers::find($order['customer'])->fio . " (" . '«' . \App\Models\customers::find($order['customer'])->type . '» ' . \App\Models\customers::find($order['customer'])->name .")" . " )" }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--<div class="mt-4">
                                <x-input-label for="contract" :value="__('Договор №:')"/>
                                <select id="contract" class="search-select block mt-1 w-full" name="contract" style="border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));" required>
                                    <option selected style="display: none"  disabled></option>
                                    @foreach($contracts as $index => $contract)
                                        <option value="{{ $contract['id'] }}"> $contract['id'] }}</option>
                                    @endforeach
                                </select>
                            </div>-->
                        <div class="mt-4">
                            <x-input-label for="technicalCondition" :value="__('Общее техническое состояние объекта:')"/>
                            <x-text-input class="block mt-1 w-full" type="text" name="technicalCondition" id="technicalCondition" maxlength="50" required/>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="cause" :value="__('Цель оценки:')"/>
                            <x-text-input class="block mt-1 w-full" type="text" name="cause" id="cause" maxlength="50" required/>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="document" :value="__('Документы заказчика:')"/>
                            <x-text-input class="block mt-1 w-full" type="text" name="document" id="document" maxlength="250" required/>
                        </div>
                            <div class="flex">
                            <div  class="mt-4">
                                <x-input-label for="evaluatinDate" :value="__('Дата оценки:')"/>
                                <x-text-input class="block mt-1" type="date" name="evaluatinDate" id="evaluatinDate" maxlength="255" value="{{ now('Europe/Samara')->format('Y-m-d') }}" required/>
                            </div>
                        <div class="mt-4" style="margin-left: 30px">
                            <x-input-label style="margin-bottom: 10px" for="application" :value="__('Прикрепить приложение для отчета:')"/>
                            <x-text-input class="defaultbtn block mt-1 w-full" style="display: none" type="file" name="application[]" id="application" maxlength="30" multiple />
                            <div class="flex">
                            <button type="button" style="height: 25px;" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 uploadFiles">{{ __('Загрузить файлы') }}</button>
                            <span style="margin-left: 5px" class="file-count">Нет выбранных файлов</span>
                            </div>
                        </div>
                            </div>

<hr class="mt-4">
                        <div class="flex items-center gap-4 mt-4" >
                            <x-primary-button class="downloadReport">{{ __('Сохранить отчёт') }}</x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
