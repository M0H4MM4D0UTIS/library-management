<?php
/*
 * @author      MOHAMMAD Ali Heidari
 * @email       h.mohammad026@gmail.com
 * @date        2021-11-19
 */
?>

@section('title')
    اطلاعیه ها
@endsection
@extends('layouts.app')

@section('content')
    <div class="mt-12">
        <h2 class="mt-14 text-2xl font-medium">اطلاعیه ها</h2>
        <div class="mt-4">
            <div class="flex flex-col">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6">
                    <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <tbody class="bg-white">
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-right{{isset($notification['status']) && $notification['status'] == 'error' ? ' text-red-500' : ''}}">
                                        <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 rounded-b rounded-t " role="alert">
                                            <p class="text-sm">{!! $notification['msg'] !!}</p>
                                        </div>
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

