<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;
use App\Models\CategoryBook;
use App\Models\Lended;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_members = Member::all()->count();
        $count_members_last_week = Member::where('created', '>=', date('Y-m-d', strtotime('-7 days')))->count();
        $count_lended = Lended::all()->count();
        $count_back_lended = Lended::where('tahvil', 1)->count();
        $count_book = Book::all()->count();
        $count_book_last_month = Book::where('created', '>=', date('Y-m-d', strtotime('-30 days')))->count();
        $count_user = User::all()->count();
        $count_not_back_lended = Lended::where([
            ['tahvil', '=', '0'],
        ])->whereRaw('tarikhTahvil <= now()')->orderBy('tarikhTahvil', 'asc')->count();
        return view('home.home', compact('count_not_back_lended', 'count_user','count_book_last_month','count_book','count_back_lended','count_lended','count_members', 'count_members_last_week'));
    }
    public function profile(Request $request)
    {
        $user = Auth::user();

        return view('home.profile', compact('user'));
    }
    public function editprofile(Request $request)
    {
        $userDetails = Auth::user();
        $this->validate(request(), [
            'name' => 'required|max:255|unique:users,name,'.$userDetails->id,
            'email' => 'required|email|max:255|unique:users,email,'.$userDetails->id,
            'password' => "nullable|string|min:6|same:password_confirmation",
            'password_confirmation' => "nullable|string|min:6|same:password",
        ]);

        $user = User::find($userDetails ->id);
        $user->name = request('name');
        $user->email = request('email');
        if(!empty(request('password'))){
            $user->password = Hash::make(request('password'));
        }

        $user->save();

        return back()->with('success', 'تغییرات با موفقیت انجام شد');
    }
    public function users(){
        $users = User::all();
        return view('home.users', ['users'=>$users]);
    }
    public function deleteuser(Request $request, $id = 0){
        if($id <= 0)
            return back()->with('error', __("کد اپراتور اشتباه است"));
        if($id == 1)
            return back()->with('error', __("امکان حذف مدیر اصلی نیست!"));
        if(Auth::user()->id != 1)
            return back()->with('error', __("حذف کاربران تنها توسط مدیر اصلی با کد 1 امکان پذیر است"));

        if(Auth::user()->id == $id)
            return back()->with('error', __("امکان حذف اکانت خود را ندارید! فقط مدیر اصلی میتواند"));

        $name = User::find($id)->name;
        User::destroy($id);
        return back()->with('success', __(" حذف کاربر$name با موفقیت انجام شد "));
    }
    public function edituserprofile(Request $request, $id = 0){
        if($id <= 0) return back()->with('error', __("کد اپراتور اشتباه است"));
        $currentUser = Auth::user();
        if($currentUser->id != 1)
            return back()->with('error', __("شما دسترسی ویرایش پروفایل دیگران را ندارید! تنها مدیر اصلی با کد 1 این دسترسی را دارد"));
        if ($request->isMethod('patch')) {
            $user = User::find($id);
            $this->validate(request(), [
                'name' => 'required|max:255|unique:users,name,'.$user->id,
                'email' => 'required|email|max:255|unique:users,email,'.$user->id,
                'password' => "nullable|string|min:6|same:password_confirmation",
                'password_confirmation' => "nullable|string|min:6|same:password",
                'status' => "required|integer|min:0|max:1",
            ]);
            $user->name = request('name');
            $user->email = request('email');
            $user->status = ($id == 1 ? 1 : intval(request('status', 1)));
            if(!empty(request('password'))){
                $user->password = Hash::make(request('password'));
            }
            $user->save();
            return redirect(route('home.users'))->with('success',__("ویرایش کاربر {$user->name} با کد {$user->id} با موفقیت انجام شد"));
        }
        $user = User::find($id);
        return view('home.edituserprofile', ['user'=>$user]);
    }
    public function addnewuser(Request $request){
        if ($request->isMethod('post')) {
            $this->validate(request(), [
                'name' => 'required|max:255|unique:users,name',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => "required|string|min:6",
            ]);
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => Hash::make(request('password'))
            ]);
            return redirect(route('home.users'))->with('success',__("افزودن کاربر {$user->name} با کد {$user->id} با موفقیت انجام شد"));
        }
        return view('home.addnewuser');
    }

    public function categories(Request $request){
        $categories = Category::all();
        return view('home.categories', ['categories' => $categories]);
    }
    public function addoreditcategory(Request $request, $id = 0){
        $category = ($id > 0 ? Category::all()->find($id) : null);
        if ($request->isMethod('post')) {
            $this->validate(request(), [
                'name' => 'required|max:190'.($id <= 0 ? '|unique:categories,name' : ''),
                'description' => 'nullable|string|max:190',
                'id' => "nullable|integer",
            ]);
            if($id > 0 && $category != null){
                $category->name = request('name');
                $category->description = request('description');
                $category->save();
                return redirect(route('home.categories'))->with('success',__("ویرایش دسته بندی {$category->name} با کد {$category->id} با موفقیت انجام شد"));
            } else {
                $addcategory = Category::create([
                    'name' => request('name'),
                    'description' => request('description'),
                    'id' => ($id > 0 ? $id : null)
                ]);
                return redirect(route('home.categories'))->with('success',__("افزودن دسته بندی {$addcategory->name} با کد {$addcategory->id} با موفقیت انجام شد"));
            }

        }
        return view('home.addoreditcategory', ['category' => $category]);
    }
    public function deletecategory(Request $request, $id = 0){
        if($id <= 0)
            return back()->with('error', __("کد دسته بندی اشتباه است"));
        $category = Category::all()->find($id);
        if(!$category)
            return back()->with('error', __("دسته بندی پیدا نشد"));
        $category->delete();
        return redirect(route('home.categories'))->with('success',__("حذف دسته بندی {$category->name} با کد {$category->id} با موفقیت انجام شد"));

    }

    public function members(Request $request){
        $members = Member::all();
        return view('home.members', ['members' => $members]);
    }

    public function addoreditmember(Request $request, $id = 0){
        $member = ($id > 0 ? Member::all()->find($id) : null);
        if ($request->isMethod('post')) {
            $this->validate(request(), [
                'fullname' => 'required|max:190'.($id <= 0 ? '|unique:members,fullname' : ''),
                'email' => 'nullable|email|max:190'.($id <= 0 ? '|unique:members,email' : ''),
                'codeMeli' => 'nullable|numeric|digits_between:10,10',
                'codePosti' => 'nullable|numeric|digits_between:10,10',
                'phone' => 'nullable|numeric|digits_between:11,11',
                'fullAddress' => 'required|string|max:190',
                'expire' => 'required|string|max:190',
                'jensiyat' => 'required|string|in:man,women,unknown',
                'active' => "required|integer|min:0|max:1",
                'id' => "nullable|integer",
            ]);
            $parameters = $request->only(array('fullname', 'email', 'codeMeli', 'codePosti', 'phone', 'fullAddress', 'expire', 'jensiyat', 'active',));
            $parameters['expire'] = \Morilog\Jalali\CalendarUtils::convertNumbers($parameters['expire'], true);
            $parameters['expire'] = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s', $parameters['expire'])->format('Y-m-d H:i:s');


            if($id > 0 && $member != null){
                $parameters['id'] = $id;

                $member->fill($parameters);
                $member->save();
                return redirect(route('home.members'))->with('success',__("ویرایش عضو {$member->fullname} با کد {$member->id} با موفقیت انجام شد"));
            } else {
                $parameters['createdby'] = Auth::user()->id;
                $addmember = Member::create($parameters);
                return redirect(route('home.members'))->with('success',__("افزودن عضو {$addmember->fullname} با کد {$addmember->id} با موفقیت انجام شد"));
            }

        }
        return view('home.addoreditmember', ['member' => $member]);
    }
    public function deletemember(Request $request, $id = 0){
        if($id <= 0)
            return back()->with('error', __("کد عضو اشتباه است"));
        $member = Member::all()->find($id);
        $name = $member->fullname;
        if(!$member)
            return back()->with('error', __("عضو مورد نظر پیدا نشد"));
        $member->delete();
        return back()->with('success', __(" حذف کاربر$name با موفقیت انجام شد "));
    }
    public function books(Request $request){
        $books = Book::all();
        return view('home.books', ['books' => $books]);
    }
    public function addoreditbook(Request $request, $id = 0){
        $book = ($id > 0 ? Book::all()->find($id) : null);
        if ($request->isMethod('post')) {
            $this->validate(request(), [
                'name' => 'required|max:190',
                'author' => 'nullable|string|max:190',
                'serial' => 'nullable|string|max:190',
                'categories' => 'nullable|string',
                'publisher' => 'nullable|string|max:190',
                'version' => 'nullable|string|max:190',
                'shabak' => 'nullable|numeric|digits_between:10,13',
                'year' => 'nullable|numeric|digits_between:2,4',
                'id' => "nullable|integer",
            ]);
            $parameters = $request->only(array('name', 'author', 'serial', 'publisher', 'version', 'shabak', 'year'));
            $input_categories = request('categories');
            if($id > 0 && $book != null){
                $parameters['id'] = $id;
                $book->fill($parameters);
                $book->save();
                if(!empty($input_categories))
                    $book->setCategory(explode(',', $input_categories));
                return redirect(route('home.books'))->with('success',__("ویرایش کتاب {$book->name} با کد {$book->id} با موفقیت انجام شد"));
            } else {
                $parameters['createdby'] = Auth::user()->id;
                $book = Book::create($parameters);
                if(!empty($input_categories))
                    $book->setCategory(explode(',', $input_categories));
                return redirect(route('home.books'))->with('success',__("افزودن کتاب {$book->name} با کد {$book->id} با موفقیت انجام شد"));
            }

        }
        $categories = Category::all();
        $book_categories = ($book != null ? CategoryBook::where(['book_id' => $book->id])->pluck('category_id')->toArray(): null);
        return view('home.addoreditbook', ['book' => $book, 'categories' => $categories, 'book_categories' => $book_categories]);
    }
    public function deletebook(Request $request, $id = 0){
        if($id <= 0)
            return back()->with('error', __("کد کتاب اشتباه است"));
        $book = Book::all()->find($id);
        $name = $book->name;
        if(!$book)
            return back()->with('error', __("کتاب مورد نظر پیدا نشد"));
        $book->delete();
        return back()->with('success', __(" حذف کتاب $name با موفقیت انجام شد "));
    }
    public function ammanatketabjadid(Request $request){
        if($request->isMethod('post')){
            $this->validate(request(), [
                'membername' => 'required|string|max:190',
                'bookname' => 'required|string|max:190',
                'tarikhTahvil' => 'required|string|max:190',
            ]);
            $tarikhTahvil = \Morilog\Jalali\CalendarUtils::convertNumbers($request->input('tarikhTahvil'), true);
            $tarikhTahvil = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s',  $tarikhTahvil)->format('Y-m-d H:i:s');
            if(intval($request->input('membername')) > 0){
                $memberid = Member::all()->find(intval($request->input('membername')))->id;
            } else {
                $memberid = Member::where('fullname', $request->input('membername'))->first()->id;
            }

            if(intval($request->input('bookname')) > 0){
                $book_id = Book::all()->find(intval($request->input('bookname')))->id;
            } else {
                $book_id = Book::where('name', $request->input('bookname'))->first()->id;
            }

            if(!$memberid || intval($memberid) <= 0 || !$book_id || intval($book_id) <= 0)
                return back()->with('error', __("اسم کتاب یا نام عضو وارد شده صحیح نیست"));

            $ammanatketabjadid = Lended::create([
                'book_id' => $book_id,
                'memberid' => $memberid,
                'operatorid' => Auth::user()->id,
                'tarikhTahvil' => $tarikhTahvil,
                'tahvil' => 0,
            ]);
            if($ammanatketabjadid){
                return redirect(route('home.ammanatdade'))->with('success', __("ثبت امانت کتاب جدید با موفقیت انجام شد"));
            } else {
                return redirect(route('home.ammanatdade'))->with('error', __("خطا در ثبت امانت کتاب جدید !"));
            }
        }
        return view('home.ammanatketabjadid');
    }
    public function ammanatdade(Request $request){
        if($request->isMethod('post') && !empty($request->input('search'))){
            $lended = Lended::join('members', 'lended.memberid', '=', 'members.id')
                ->join('books', 'lended.book_id', '=', 'books.id')
                ->where('members.fullname', 'like', '%'.$request->input('search').'%')
                ->Orwhere('books.name', 'like', '%'.$request->input('search').'%')
                ->get(['lended.*']);
        } else {
            $lended = Lended::all();
        }
        return view('home.ammanatdade', ['lended' => $lended]);
    }
    public function deletelended(Request $request){
        $this->validate(request(), [
            'id' => 'required|integer',
        ]);
        $id = intval($request->input('id'));
        if($id <= 0)
            return back()->with('error', __("کد امانت کتاب اشتباه است"));
        $lended = Lended::all()->find($id);
        if(!$lended)
            return back()->with('error', __("رکورد امانت کتاب مورد نظر پیدا نشد"));
        $lended->delete();
        return back()->with('success', __("حذف رکورد امانت کتاب با موفقیت انجام شد"));
    }
    public function lendedchangestatus(Request $request, $id = 0){
        if($id <= 0)
            return back()->with('error', __("کد رکورد امانت کتاب اشتباه است"));
        $lended = Lended::all()->find($id);
        if(!$lended)
            return back()->with('error', __("رکورد امانت کتاب مورد نظر پیدا نشد"));
        $lended->tahvil = !$lended->tahvil;
        $lended->save();
        return back()->with('success', __("وضعیت رکورد امانت کتاب با موفقیت تغییر یافت"));
    }
    public function notifications(Request $request, $id = 0){

        $lended = Lended::where([
            ['tahvil', '=', '0'],
            //['tarikhTahvil', '<=', date('Y-m-d H:i:s')],
        ])->whereRaw('tarikhTahvil <= now()')->orderBy('tarikhTahvil', 'asc')->get();
        $notifications = [];
        if($lended->count() > 0){
            foreach ($lended as $lend){
                array_push($notifications, [/*'status' => 'error', */'msg' => "عضو '<a href='"
                    .route('home.addoreditmember', ['id' => $lend->member->id])
                    ."' class='underline' target='_blank'>".$lend->member->fullname
                    ."</a>' کتاب '{$lend->book->name}' را در تاریخ مقرر ".
                    \Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($lend->tarikhTahvil))
                    ." برنگردانده است "]);
            }
        }
        return view('home.notifications', ['notifications' => $notifications]);
    }
}
