
@section('title')
    افزودن کاربر جدید
@endsection
@extends('layouts.app')

@section('content')
    <h2 class="mb-10 text-2xl font-medium">افزودن اپراتور جدید</h2>
    <div class="mt-15 sm:mt-0">
        <div class="md:grid md:grid-cols-1 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form class="bg-white shadow-md" method="post" action="{{route('home.addnewuser')}}">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="inline-full-name" class="block text-sm font-medium text-gray-700 mb-1">نام</label>
                                    <input name="name" autocomplete="given-name" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email_address" class="block text-sm font-medium text-gray-700 mb-1">آدرس ایمیل</label>
                                    <input type="email" name="email" autocomplete="email" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-email" value="">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="inline-password" class="block text-sm font-medium text-gray-700 mb-1">رمزعبور</label>
                                    <input name="password" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-password" type="password" placeholder="******************">
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                ایجاد
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
