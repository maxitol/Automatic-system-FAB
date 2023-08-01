<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Новости') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                            @foreach($news as $index => $new)
                            <fieldset> <div style="display: flex"><legend style="  background-color: rgb(31 41 55);color: white;padding: 5px 10px;border-radius: 0.375rem;--tw-border-opacity: 1;">{{ __('Публикация от ') }}{{ date("d.m.y H:i:s",strtotime($new['created_at'])) }}

                                </legend>
                                @can('view', auth()->user())
                                    <a class="deleteNew" id="{{ $new['id'] }}" title="Удалить публикацию" style="display: inline-table;margin-left: 2px;margin-top: 4px;}"><img style="display: -webkit-inline-box;height: 20px; width: 20px" src="/images/rem.png"></a>
                                @endcan
                                </div>
                                <textarea style="height: 255px;border:1px solid; border-radius: 0.375rem;--tw-border-opacity: 1;border-color: rgb(209 213 219 / var(--tw-border-opacity));width: 100%;resize: none;" disabled="disabled" readonly>{{ $new['news']}}</textarea></fieldset>
                                <br>
                                <hr>
                                <br>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
