<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slider;
use App\Subcategory;
use Illuminate\Http\Request;

class FrontProductController extends Controller {
    public function index() {
        $products               = Product::latest()->limit(6)->get();
        $randomActiveProducts   = Product::inRandomOrder()->limit(3)->get();
        $randomActiveProductIDs = [];
        foreach ($randomActiveProducts as $product) {
            array_push($randomActiveProductIDs, $product->id);
        }
        $randomItemProducts = Product::whereNotIn('id', $randomActiveProductIDs)->limit(3)->get();
        $sliders            = Slider::get();
        return view('frontend.product', compact('products', 'randomActiveProducts', 'randomItemProducts', 'sliders'));
    }

    public function show($id) {
        $product        = Product::find($id);
        $similarProduct = Product::inRandomOrder()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(3)
            ->get();
        return view('frontend.show', compact('product', 'similarProduct'));
    }

    public function allProduct(Request $request, $name) {
        $category   = Category::where('slug', $name)->first();
        $categoryID = $category->id;
        if ($request->subcategory) {
            $products            = $this->filterProducts($request);
            $filterSubcategories = $this->getSubcategoriesID($request);
        } elseif ($request->min || $request->max) {
            $products = $this->filterByPrice($request);
        } else {
            $products = Product::where('category_id', $category->id)->get();
        }
        $subcategories = Subcategory::where('category_id', $category->id)->get();
        $slug          = $name;

        return view('frontend.category', compact('products', 'subcategories', 'slug', 'categoryID'));
    }

    public function filterProducts(Request $request) {
        $subID       = [];
        $subcategory = Subcategory::whereIn('id', $request->subcategory)->get();
        foreach ($subcategory as $sub) {
            array_push($subID, $sub->id);
        }
        $products = Product::whereIn('subcategory_id', $subID)->get();
        return $products;
    }

    public function getSubcategoriesID(Request $request) {
        $subId       = [];
        $subcategory = Subcategory::whereIn('id', $request->subcategory)->get();
        foreach ($subcategory as $sub) {
            array_push($subId, $sub->id);
        }

        return $subId;
    }
    public function filterByPrice(Request $request) {
        $categoryID = $request->categoryId;
        $product    = Product::whereBetween('price', [$request->min, $request->max])
            ->where('category_id', $categoryID)
            ->get();
        return $product;
    }

    public function moreProduct(Request $request) {
        if ($request->search) {
            $products = Product::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('additional_info', 'like', '%' . $request->search . '%')
                ->paginate(20);
            return view('frontend.allproduct', compact('products'));
        }
        $products = Product::latest()->paginate(20);
        return view('frontend.allproduct', compact('products'));
    }
}
