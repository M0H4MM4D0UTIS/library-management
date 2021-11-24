<?php
/*
 * @author      MOHAMMAD Ali Heidari
 * @email       h.mohammad026@gmail.com
 * @date        2021-11-18
 */
?>

@section('title')
ثبت امانت دادن کتاب
@endsection
@extends('layouts.app')

@Push('css')
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
    <style>
        .autocomplete-suggestions { border: 1px solid #999; background: #b8c2cc; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; cursor: pointer;}
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }

    </style>
@endpush

@Push('js')
    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.autocomplete.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name="tarikhTahvil"]').persianDatepicker({
                format: 'YYYY/MM/DD HH:mm:ss',
                calendar:{
                    persian: {
                        locale: 'fa'
                    }
                }
            });
            $('input[name="membername"]').autocomplete({
                serviceUrl: '{{route('home.api.autocomplete.membername')}}',
                minChars: 1,
                type: 'POST',
                dataType: 'json',
                showNoSuggestionNotice: true,
                noSuggestionNotice: 'هیچ کاربری با این اسم یافت نشد',
                params: {
                    _token: '{{csrf_token()}}'
                },
                onSelect: function (suggestion) {
                    if(typeof suggestion.active != 'undefined' && suggestion.active != true){
                        alert(' عضو "'+suggestion.value+'" مسدود شده است و امکان امانت دادن کتاب نیست ');
                        setTimeout(function(){
                            $('input[name="membername"]').val('');
                        },500);
                    }
                    if(typeof suggestion.expired != 'undefined' && suggestion.expired == true){
                        alert(' زمان عضویت عضو "'+suggestion.value+'" تمام شده است و باید قبل از امانت دادن کتاب، عضویت آن را تمدید کنید ');
                    }
                },
                deferRequestBy: 300,
            });

            $('input[name="bookname"]').autocomplete({
                serviceUrl: '{{route('home.api.autocomplete.bookname')}}',
                minChars: 1,
                type: 'POST',
                dataType: 'json',
                showNoSuggestionNotice: true,
                noSuggestionNotice: 'هیچ کتابی با این اسم یافت نشد',
                params: {
                    _token: '{{csrf_token()}}'
                },
                deferRequestBy: 300,
            });

        });

    </script>
@endpush

@section('content')
<h2 class="mb-10 text-2xl font-medium">ثبت امانت دادن کتاب</h2>
<div class="mt-15 sm:mt-0">
    <div class="md:grid md:grid-cols-1 md:gap-6">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form class="bg-white shadow-md" method="post" action="{{route('home.ammanatketabjadid')}}">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="" class="block text-sm font-medium text-gray-700 mb-1">نام کامل عضو/کدعضویت *</label>
                                <input type="text" placeholder="برای جستجو چیزی بنویسید.." value="{{!empty($membername) ?? $membername}}" name="membername" autocomplete="off" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" required>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="" class="block text-sm font-medium text-gray-700 mb-1">نام کتاب *</label>
                                <input type="text" placeholder="برای جستجو چیزی بنویسید.." value="{{!empty($bookname) ?? $bookname}}" name="bookname" autocomplete="off" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" required>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="" class="block text-sm font-medium text-gray-700 mb-1">تاریخ تحویل *</label>
                                <input name="tarikhTahvil" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" style="direction: ltr" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            ذخیره
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

