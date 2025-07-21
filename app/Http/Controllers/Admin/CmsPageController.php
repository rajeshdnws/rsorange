<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Models\CmsPage;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $pages = CmsPage::latest()->get();
    return view('cms.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
                return view('cms.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
            'title' => 'required|string|max:255',
            'alias' => 'required|unique:cms_pages,alias',
            'status' => 'required|boolean',
            'banner' => 'nullable|image',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
        ]);

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('banners', 'public');
        }

        CmsPage::create($data);
        return redirect()->route('admin.dashboard')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $page = CmsPage::findOrFail($id);
        return view('cms.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = CmsPage::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'alias' => 'required|string|unique:cms_pages,alias,' . $id,
            'status' => 'required|boolean',
            'banner' => 'nullable|image',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
        ]);

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('banners', 'public');
        }

        $page->update($data);

        return redirect()->route('cms-pages.index')->with('success', 'CMS Page updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $page = CmsPage::findOrFail($id);

    if ($page->banner && \Storage::disk('public')->exists($page->banner)) {
        \Storage::disk('public')->delete($page->banner);
    }

    $page->delete();

    return redirect()->route('cms-pages.index')->with('success', 'CMS Page and banner deleted successfully.');
}
}
