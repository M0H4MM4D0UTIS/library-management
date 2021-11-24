<?php
/*
 * @author      MOHAMMAD Ali Heidari
 * @email       h.mohammad026@gmail.com
 * @date        2021-11-19
 */
?>

@section('title')
    کتاب های امانت داده شده
@endsection
@extends('layouts.app')

@section('content')
    <div class="mt-12">
        <a href="{{route('home.ammanatketabjadid')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
            <svg style="display: unset" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>ثبت امانت دادن جدید</a>
        @if(request()->isMethod('post') && !empty(request()->input('search')))
            <h3 class="mt-14 mb-2 text-1xl font-medium">نتیجه جستجو
                '{{request()->input('search')}}':</h3>
        @else
            <h2 class="mt-14 mb-2 text-2xl font-medium">کتاب ها</h2>
        @endif


        <form action="{{route('home.ammanatdade')}}" method="post">
            {{ csrf_field() }}
            {{ method_field('post') }}
            <div class="pt-2 relative mx-auto text-gray-600">
                <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                       type="search" name="search" placeholder="جستجو کاربر یا کتاب ..">
                <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                         viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                         width="512px" height="512px">
                    <path
                        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                  </svg>
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    جستجو
                </button>
            </div>
        </form>
        <div class="mt-4">
            <div class="flex flex-col">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6">
                    <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full table-fixed">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="w-1/6 px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider" style="text-align: start">کتاب</th>
                                <th class="w-1/6 px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider" style="text-align: start">عضو</th>
                                <th class="w-1/6 px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider" style="text-align: start">اپراتور</th>
                                <th class="w-1/6 px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider" style="text-align: start">وضعیت</th>
                                <th class="w-1/8 px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider" style="text-align: start">تحویل</th>
                                <th class="w-1/8 px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider" style="text-align: start">امانت دادن</th>
                                <th class="w-1/4 px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach ($lended as $lend)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-right">
                                        <div class="flex items-center">
                                            <div class="mx-2">
                                                <div class="text-sm leading-5 font-medium text-gray-900" title=" کد کتاب {{$lend->book->id}}">{{$lend->book->name}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td title=" کد عضو {{$lend->member->id}}" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500 text-right">
                                        {{$lend->member->fullname}}
                                    </td>
                                    <td title=" کد اپراتور {{$lend->operator->id}}" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500 text-right">
                                        {{$lend->operator->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500 text-right">
                                        @if($lend->tahvil)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">تحویل داده</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">تحویل نداده</span>
                                        @endif
                                    </td>
                                    <td title="{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i:s', strtotime($lend->tarikhTahvil))}}" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500 text-right" style="direction: ltr">
                                        {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($lend->tarikhTahvil))}}
                                    </td>
                                    <td title="{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i:s', strtotime($lend->created))}}" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500 text-right" style="direction: ltr">
                                        {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($lend->created))}}
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-center">
                                        <a href="{{route('home.lendedchangestatus', ['id' => $lend->id])}}" class="{{$lend->tahvil ?  'text-red-600 hover:text-red-400' : 'text-green-500 hover:text-green-700' }}">تغییر وضعیت</a>
                                        <form action="{{route('home.deletelended', ['id' => $lend->id])}}" method="post" style="display: none">
                                            @method('delete')
                                            @csrf
                                            <input class="btn btn-default" id="deleteE{{$lend->id}}" type="submit" value="Delete" />
                                        </form>
                                        <a href="#" onclick="if(confirm('از حذف  رکورد امانت دادن کتاب {{$lend->book->name}} به عضو {{$lend->member->fullname}} مطمئن هستید؟')) {document.getElementById('deleteE{{$lend->id}}').click(); return false;} else {return false;}" class="text-red-500 hover:text-red-600">حذف</a>
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

@endsection


