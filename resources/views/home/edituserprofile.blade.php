
@section('title')
    ویرایش پروفایل کاربر شماره
    {{$user->id}}
@endsection
@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-medium">ویرایش اپراتور
        {{$user->name}}
    - کد کاربری
    {{$user->id}}</h2><br>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-1 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form class="bg-white shadow-md" method="post" action="{{route('home.edituserprofile', ['id' => $user->id])}}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="inline-full-name" class="block text-sm font-medium text-gray-700 mb-1">نام</label>
                                    <input name="name" autocomplete="given-name" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="{{ $user->name }}">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email_address" class="block text-sm font-medium text-gray-700 mb-1">آدرس ایمیل</label>
                                    <input type="email" name="email" autocomplete="email" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-email" value="{{ $user->email }}">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="inline-password" class="block text-sm font-medium text-gray-700 mb-1">رمزعبور جدید</label>
                                    <input name="password" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-password" type="password" placeholder="******************">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="inline-password-confirmation" class="block text-sm font-medium text-gray-700 mb-1">تکرار رمزعبور</label>
                                    <input name="password_confirmation" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-password-confirmation" type="password" placeholder="******************">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="inline-status" class="block text-sm font-medium text-gray-700 mb-1">وضعیت اکانت</label>
                                    <div class="relative">
                                        <select name="status" class="block appearance-none w-full bg-white-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="inline-status">
                                            <option value="1">فعال</option>
                                            <option value="0" {{$user->status == 0 ? ' selected' : ''}}>مسدود شده</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
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
