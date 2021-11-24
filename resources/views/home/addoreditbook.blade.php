<?php
/*
 * @author      MOHAMMAD Ali Heidari
 * @email       h.mohammad026@gmail.com
 * @date        2021-11-15
 */
?>

@section('title')
    افزودن/ویرایش کتاب
@endsection
@extends('layouts.app')

@Push('css')
    <link rel="stylesheet" href="{{ URL::asset('css/selectpage.css') }}" />
@endpush

@Push('js')
    <script type="text/javascript" src="{{ URL::asset('js/selectpage.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var data = [
                @foreach($categories as $category)
                {id: {{$category->id}}, name: "{{$category->name}}" },
                @endforeach
            ];
            $('input[name="categories"]').selectPage({
                showField : 'name',
                keyField : 'id',
                data : data,
                listSize : 5,
                pageSize : 5,
                lang : 'fa',
                orderBy : ['id asc']
            })
        });

    </script>
@endpush

@section('content')
    <h2 class="mb-10 text-2xl font-medium">افزودن/ویرایش کتاب</h2>
    <div class="mt-15 sm:mt-0">
        <div class="md:grid md:grid-cols-1 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form class="bg-white shadow-md" autocomplete="off" method="post" action="{{route('home.addoreditbook', ['id' => request('id')])}}">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">نام کامل کتاب *</label>
                                    <input name="name" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="{{$book != null ? $book->name : ''}}" required>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">دسته بندی ها</label>
                                    <input name="categories" value="{{$book_categories != null ? implode(',',$book_categories) : ''}}" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">نویسنده</label>
                                    <input name="author" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="{{$book != null ? $book->author : ''}}">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">شابک</label>
                                    <input name="shabak" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="number" maxlength="13" value="{{$book != null ? $book->shabak : ''}}">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">سریال</label>
                                    <input name="serial" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="{{$book != null ? $book->serial : ''}}">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">انتشارات</label>
                                    <input name="publisher" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="{{$book != null ? $book->publisher : ''}}">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">سال انتشار</label>
                                    <input name="year" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" maxlength="4" type="number" value="{{$book != null ? $book->year : ''}}">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">نسخه</label>
                                    <input name="version" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="{{$book != null ? $book->version : ''}}">
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

