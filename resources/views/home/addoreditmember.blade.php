
@section('title')
    افزودن/ویرایش عضو
@endsection
@extends('layouts.app')

@Push('css')
<link rel="stylesheet" href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
@endpush

@Push('js')
<script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[name="expire"]').persianDatepicker({
            format: 'YYYY/MM/DD HH:mm:ss',
            initialValue: true,
            initialValueType: 'gregorian',
            calendar:{
                persian: {
                    locale: 'fa'
                }
            }
        });
        @if ($member == null)
        document.getElementById("jensiyat").selectedIndex = -1;
        @endif
    });

</script>
@endpush

@section('content')
    <h2 class="mb-10 text-2xl font-medium">افزودن/ویرایش عضو</h2>
    <div class="mt-15 sm:mt-0">
        <div class="md:grid md:grid-cols-1 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form class="bg-white shadow-md" autocomplete="off" method="post" action="{{route('home.addoreditmember', ['id' => request('id')])}}">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">نام کامل *</label>
                                    <input name="fullname" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="{{$member != null ? $member->fullname : ''}}" required>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">ایمیل</label>
                                    <input name="email" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="{{$member != null ? $member->email : ''}}">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">کد ملی</label>
                                    <input name="codeMeli" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="number" maxlength="10" value="{{$member != null ? $member->codeMeli : ''}}">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">کد پستی</label>
                                    <input name="codePosti" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="number" maxlength="10" value="{{$member != null ? $member->codePosti : ''}}">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">شماره تماس</label>
                                    <input name="phone" autocomplete="off" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" maxlength="11" type="number" value="{{$member != null ? $member->phone : ''}}">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">آدرس محل سکونت *</label>
                                    <input name="fullAddress" autocomplete="off" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="{{$member != null ? $member->fullAddress : ''}}" required>
                                </div>

                                @if ($member != null)
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">اتمام عضویت *</label>
                                    <input name="expire" class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" style="direction: ltr" type="text" value="{{$member != null ? $member->expire : date('Y-m-d H:i:s')}}" required>
                                </div>
                                @else
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="inline-status" class="block text-sm font-medium text-gray-700 mb-1">اتمام عضویت *</label>
                                        <div class="relative">
                                            <select name="expire" class="block appearance-none w-full bg-white-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i:s', strtotime('+'.$i.' year'))}}">{{ $i }} سال دیگر</option>
                                                @endfor
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="inline-status" class="block text-sm font-medium text-gray-700 mb-1">جنسیت *</label>
                                    <div class="relative">
                                        <select id="jensiyat" name="jensiyat" class="block appearance-none w-full bg-white-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                                            <option value="man" {{$member != null && $member->jensiyat == 'man' ? ' selected' : ''}}>آقا</option>
                                            <option value="women" {{$member != null && $member->jensiyat == 'women' ? ' selected' : ''}}>خانم</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="inline-status" class="block text-sm font-medium text-gray-700 mb-1">وضعیت عضو</label>
                                    <div class="relative">
                                        <select name="active" class="block appearance-none w-full bg-white-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="inline-status">
                                            <option value="1">فعال</option>
                                            <option value="0" {{$member != null && $member->active == 0 ? ' selected' : ''}}>مسدود شده</option>
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
