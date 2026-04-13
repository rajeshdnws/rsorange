<?php


namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

 
     public function store(Request $request)
{
    $request->validate([
        'type' => 'required|in:banner,slider',
        'slug' => 'required|string|unique:banners,slug',
        'image' => 'required_if:type,banner|image|mimes:jpeg,png,jpg|max:2048',
        'slider_data.*.title' => 'nullable|string',
        'slider_data.*.description' => 'nullable|string',
        'slider_data.*.image' => 'required_if:type,slider|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->type === 'banner') {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/banners'), $imageName);

        Banner::create([
            'type' => 'banner',
            'slug' => $request->slug,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'is_active' => $request->has('is_active'),
        ]);
    } else {
        foreach ($request->slider_data as $slide) {
            $image = $slide['image'];
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('uploads/banners'), $imageName);

            Banner::create([
                'type' => 'slider',
                'slug' => $request->slug, // shared for all slider entries
                'title' => $slide['title'],
                'description' => $slide['description'],
                'image' => $imageName,
                'is_active' => $request->has('is_active'),
            ]);
        }
    }

    return redirect()->route('banner.index')->with('success', 'Banner(s) added successfully!');


    }

    public function show(Banner $banner)
    {
        return view('banner.show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.create', compact('banner'));
    }

  public function update(Request $request, Banner $banner)
{
    $request->validate([
        'type' => 'required|in:banner,slider',
        'slug' => 'required|string',
        'title' => 'nullable|string',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'slider_data.*.title' => 'nullable|string',
        'slider_data.*.description' => 'nullable|string',
        'slider_data.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->type === 'banner') {
        $data = [
            'type' => 'banner',
            'slug' => $request->slug,
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/banners'), $imageName);
            $data['image'] = $imageName;
        }

        $banner->update($data);
    } else {
        // Delete all sliders with the same slug
        Banner::where('slug', $banner->slug)->delete();

        foreach ($request->slider_data as $slide) {
            $imageName = null;

            if (isset($slide['image'])) {
                $image = $slide['image'];
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('uploads/banners'), $imageName);
            }

            Banner::create([
                'type' => 'slider',
                'slug' => $request->slug,
                'title' => $slide['title'],
                'description' => $slide['description'],
                'image' => $imageName,
                'is_active' => $request->has('is_active'),
            ]);
        }
    }

    return redirect()->route('banner.index')->with('success', 'Banner updated successfully!');
}

public function destroy(Banner $banner)
{
    if ($banner->type === 'slider') {
        $sliders = Banner::where('slug', $banner->slug)->get();

        foreach ($sliders as $slide) {
            if ($slide->image && file_exists(public_path('uploads/banners/' . $slide->image))) {
                unlink(public_path('uploads/banners/' . $slide->image));
            }
            $slide->delete();
        }

    } else {
        if ($banner->image && file_exists(public_path('uploads/banners/' . $banner->image))) {
            unlink(public_path('uploads/banners/' . $banner->image));
        }
        $banner->delete();
    }

    return redirect()->route('banner.index')->with('success', 'Banner deleted successfully!');
}

    public function toggleStatus(Banner $banner)
    {
        $banner->is_active = !$banner->is_active;
        $banner->save();
        return back()->with('success', 'Status updated!');
    }
}
