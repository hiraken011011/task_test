<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactForm;
use Illuminate\Support\Facades\DB;
use App\Services\CheckFormData;
use App\Http\Requests\StoreContactForm;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // エロクワント ORマッパー
        // $contacts = ContactForm::all(); // DBのデータを全て持ってこれる

        // クエリビルダー
        $contacts = DB::table('contact_forms')
        ->select('id', 'your_name', 'title', 'created_at') // selectで表示させる列の選択
        ->orderBy('created_at', 'desc')
        ->get();

        // dd($contacts);
        return view('contact.index', compact('contacts')); // .の前がフォルダ、.の後がファイル名。つまり contact/index.php
        // $マークを入れず、compact関数 で $contacts を view/contact/index.blade.php へ受け渡す
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contact.create'); // .の前がフォルダ、.の後がファイル名。つまり contact/create.php
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactForm $request)
    {
        // vendor/laravel/framework/src/illminate/Request.php の Requestクラス

        $contact = new ContactForm;

        $contact->your_name = $request->input('your_name'); // formのデータを持ってくる
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age'); // formのデータを持ってくる
        $contact->contact = $request->input('contact'); // formのデータを持ってくる

        $contact->save(); // saveというメソッドで保存

        return redirect('contact/index'); // 最初の画面に戻す
        // dd($your_name, $title); // 取れているか確認
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $contact = ContactForm::find($id);
        // dd($contact);

        // app/Services/ContactFormData.php から 値を取ってきてる
        $gender = CheckFormData::checkGender($contact);
        $age = CheckFormData::checkAge($contact);

        return view('contact.show',
        compact('contact','gender','age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact = ContactForm::find($id);

        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = ContactForm::find($id);

        $contact->your_name = $request->input('your_name'); // formのデータを持ってくる
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age'); // formのデータを持ってくる
        $contact->contact = $request->input('contact'); // formのデータを持ってくる

        $contact->save(); // saveというメソッドで保存

        return redirect('contact/index'); // 最初の画面に戻す
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contact = ContactForm::find($id);
        $contact->delete();

        return redirect('contact/index'); // 最初の画面に戻す
    }
}
