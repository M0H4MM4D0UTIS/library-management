
@section('title')
    اعضا
@endsection
@extends('layouts.app')

@section('content')
    <div class="mt-12">
        <a href="{{route('home.addoreditmember')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
            <svg style="display: unset" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            افزودن عضو جدید
        </a>
        <h2 class="mt-14 text-2xl font-medium">اعضا</h2>
        <div class="mt-4">
            <div class="flex flex-col">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    نام
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    کد عضو
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    وضعیت
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    شروع عضویت
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    style="text-align: start">
                                    پایان عضویت
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach ($members as $member)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-right">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                     src="{{ Gravatar::get((!empty($member->email) ? $member->email : 'default@default.com'), ['size'=>256] )}}"
                                                     alt=""/>
                                            </div>
                                            <div class="mx-2">
                                                <div class="text-sm leading-5 font-medium text-gray-900">{{$member->fullname}}</div>
                                                <div class="text-sm leading-5 text-gray-500">{{$member->email}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        {{$member->id}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                  <span
                                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{$member->active == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}}">
                                    {{$member->active == 1 ? 'فعال' : 'مسدود شده'}}
                                  </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500 text-center" style="direction: ltr">

                                        {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i:s', strtotime($member->created))}}

                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500 text-center">
                                        {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i:s', strtotime($member->expire))}}
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-center">
                                        <a href="{{route('home.addoreditmember', ['id' => $member->id])}}" class="text-indigo-600 hover:text-indigo-900">ویرایش</a>
                                        <form action="{{route('home.deletemember', ['id' => $member->id])}}" method="post" style="display: none">
                                            @method('delete')
                                            @csrf
                                            <input class="btn btn-default" id="deleteE{{$member->id}}" type="submit" value="Delete" />
                                        </form>
                                        <a href="#" onclick="if(confirm('از حذف عضو {{$member->fullname}} مطمئن هستید؟')) {document.getElementById('deleteE{{$member->id}}').click(); return false;} else {return false;}" class="text-indigo-600 hover:text-indigo-900">حذف</a>
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
