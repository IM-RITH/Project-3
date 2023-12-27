<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseItem;
use Illuminate\Http\Request;

class AdminWhyChooseController extends Controller
{
    public function index()
    {
        $why_choose_items = WhyChooseItem::get();
        return view('admin.why_choose_item', compact('why_choose_items'));
    }
    public function add_section()
    {
        return view('admin.why_choose_item_add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
            'text' => 'required',
        ]);
        $why_choose = new WhyChooseItem();
        $why_choose->icon = $request->icon;
        $why_choose->heading = $request->heading;
        $why_choose->text = $request->text;
        $why_choose->save();
        return redirect()->route('admin_why_choose_item')->with('success', 'Job Category Added Successfully');
    }
    public function edit($id)
    {
        // $single_job_category = JobCategory::where('id', $id)->first();
        $single_why_choose_item = WhyChooseItem::find($id);

        return view('admin.why_choose_item_edit', compact('single_why_choose_item'));
    }
    public function update(Request $request, $id)
    {
        //  $single_job_category = JobCategory::where('id', $id)->first();
        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
            'text' => 'required',
        ]);
        $why_choose = WhyChooseItem::find($id);
        $why_choose->icon = $request->icon;
        $why_choose->heading = $request->heading;
        $why_choose->heading = $request->heading;
        $why_choose->update();
        return redirect()->route('admin_why_choose_item')->with('success', 'Job Category Updated Successfully');
    }
    // delete function
    public function delete($id)
    {
        $why_choose = WhyChooseItem::find($id);
        $why_choose->delete();
        return redirect()->route('admin_why_choose_item')->with('success', 'Job Category Deleted Successfully');
    }
}
