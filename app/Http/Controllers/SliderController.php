<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller {
    public function index() {
        $sliders = Slider::get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create() {
        return view('admin.slider.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,png',
        ]);
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('slider', $filename, 'public');
            Slider::create([
                'image' => $filename,
            ]);
        }

        // $image = $request->file('image')->store('public/slider');

        notify()->success('Slider created successfully');
        return redirect()->route('slider.index');
    }

    public function destroy($id) {
        $slider = Slider::find($id);
        $image  = '/public/slider/' . $slider->image;
        $slider->delete();
        Storage::delete($image);
        notify()->success('Slider deleted successfully');
        return redirect()->back();
    }
}
