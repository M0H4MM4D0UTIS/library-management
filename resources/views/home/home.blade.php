
@section('title')
    داشبورد
@endsection
@extends('layouts.app')

@section('content')

    <div class="mx-auto w-full">
        <div>
            <!-- Card stats -->
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/3 px-4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                        تعداد کل اعضا
                                    </h5>
                                    <span class="font-semibold text-xl text-gray-800">
                          {{number_format($count_members)}}
                        </span>
                                </div>
                                <div class="relative w-auto px-2 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-indigo-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-4">
                      <span class="text-red-500 mr-2">
                        <i class="fas fa-arrow-down"></i>
                        {{number_format($count_members_last_week)}}
                      </span>
                                <span class="whitespace-no-wrap">
                         ثبت نام در یک هفته گذشته
                      </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                        تعداد کل امانت داده ها
                                    </h5>
                                    <span class="font-semibold text-xl text-gray-800">
                          {{number_format($count_lended)}}
                        </span>
                                </div>
                                <div class="relative w-auto px-2 flex-initial">
                                    <div
                                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                        <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                             stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-4">
                      <span class="text-red-500 mr-2">
                        <i class="fas fa-arrow-down"></i>{{number_format($count_back_lended)}}
                      </span>
                                <span class="whitespace-no-wrap">
                        پس گرفته شده
                                    ({{number_format(($count_back_lended / $count_lended) * 100, 0)}}%)
                      </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                        تعداد کل کتاب ها
                                    </h5>
                                    <span class="font-semibold text-xl text-gray-800">
                          {{$count_book}}
                        </span>
                                </div>
                                <div class="relative w-auto px-2 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-4">
                      <span class="text-red-500 mr-2">
                        <i class="fas fa-arrow-up"></i> {{number_format($count_book_last_month)}}
                      </span>
                                <span class="whitespace-no-wrap">
                        اضافه شده در یک ماه گذشته
                      </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12">
        <div class="mt-4">
            <div class="flex flex-col">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6">
                    <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full  table-fixed">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="w-1/1 px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">

                                </th>
                                <th class="w-1/6 px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                <th class="w-1/7 px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-yellow-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="mx-2">
                                            <div class="text-sm leading-5 font-medium text-gray-900">تعداد اپراتورها/مدیران</div>

                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{$count_user}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="{{route('home.users')}}" target="_blank" class="text-blue-400 text-sm">مشاهده</a>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="mx-2">
                                            <div class="text-sm leading-5 font-medium text-gray-900">تعداد کتاب های امانت داده شده که موعد آنها بدون تحویل گذشته است</div>

                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{$count_not_back_lended}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="{{route('home.notifications')}}" target="_blank" class="text-blue-400 text-sm">مشاهده</a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
