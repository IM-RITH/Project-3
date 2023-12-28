<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::get();
        return view('admin.faq', compact('faqs'));
    }
    public function add_section()
    {
        return view('admin.faq_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        $obj = new Faq();
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        $obj->save();
        return redirect()->route('admin_faq')->with('success', 'FAQ Added Successfully');
    }
    public function edit($id)
    {
        $single_faq = Faq::find($id);

        return view('admin.faq_edit', compact('single_faq'));
    }
    public function update(Request $request, $id)
    {
        $obj = Faq::find($id);
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        $obj->update();
        return redirect()->route('admin_faq')->with('success', 'FAQ Updated Successfully');
    }
    // delete function
    public function delete($id)
    {
        $obj = Faq::find($id);
        $obj->delete();
        return redirect()->route('admin_faq')->with('success', 'FAQ Deleted Successfully');
    }
}