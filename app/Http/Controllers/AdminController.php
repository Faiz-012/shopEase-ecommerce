<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\UserTable;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Item;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{


    public function Logincheck(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|min:3|max:15',
            'password' => 'required'
        ]);

        $admin = User::where('name', $request->name)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['user' => 'Invalid Credentials']);
        }

        Auth::login($admin);
        $admin->load('roles');

        return redirect()->route('Form')->with('name', $admin->name);
    }


    public function logOut(Request $request)
    {
        $request->session()->flush();
        return redirect('log-in');
    }

    public function create()
    {
        $categories = Categorie::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('crudoperation.form', compact('categories', 'tags'));
    }


    public function addProduct(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'category_ids' => 'array',
            'tag_ids' => 'array',
        ]);

        $product = new Item();
        $product->name = $request->name;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('images', 'public');
            $product->image = '/storage/' . $path;
        };
        $product->description = $request->description;
        $product->price = $request->price;

        if ($product->save()) {
            $product->categories()->sync($request->category_ids ?? []);
            $product->tags()->sync($request->tag_ids ?? []);
            return redirect('listing');
        }
        return ["result" => "Operation Failed"];
    }

    public function productList(Request $request)
    {

        $search = $request->input('search');

        if ($search) {
            $ProductData = Item::with(['categories', 'tags'])
                ->where('name', 'like', "%{$search}%")->get();
        } else {
            $ProductData = Item::with(['categories', 'tags'])
                ->orderby('id', 'desc')
                ->paginate(4);
        }
        Session(['admin_product' => true]);
        return view(
            'crudoperation.productListing',
            [
                'product' => $ProductData,
                'search' => $search
            ]
        );
    }

    public function updateData($id)
    {
        $product = Item::with(['categories', 'tags'])->findOrFail($id);
        $categories = Categorie::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('crudoperation.editproduct', compact('product', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'category_ids' => 'array',
            'tag_ids' => 'array',
        ]);

        $ProductData = Item::findOrFail($id);
        $ProductData->name = $request->name;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $ProductData->image = '/storage/' . $path;
            $path = $request->file('image')->store('images', 'public');
            $ProductData->image = '/storage/' . $path;
        };
        // $path = $request->file('image')->store('images', 'public');
        // $ProductData->image = '/storage/' . $path;


        $ProductData->description = $request->description;
        $ProductData->price = $request->price;

        if ($ProductData->save()) {
            $ProductData->categories()->sync($request->category_ids ?? []);
            $ProductData->tags()->sync($request->tag_ids ?? []);
            return redirect('listing');
        } else {
            return "Operation Failed";
        }
    }
    function deleteData($id)
    {
        $ProductData = Item::destroy($id);
        if ($ProductData) {
            return redirect()->route('listing')->with('message ', 'product hasbeen deleted!');
        } else {
            return ('Operation Failed');
        }
    }

    public function multipleRecodsDelete(Request $request)
    {
        $ProductData = Item::destroy($request->ids); // ✅ flat array
        if ($ProductData) {
            return redirect('listing');
        } else {
            return ["result" => "Operation Failed"];
        }
    }

    public function searchData(Request $request)
    {
        $data =  Item::where('name', 'like', "%$request->search%")->get();
        if ($data->isEmpty()) {
            return view('crudoperation.productListing', [
                'product' => $data,
                'search' => $request->search,
                'message' => 'No Result found!'
            ]);
        } else {
            return view(
                'crudoperation.productListing',
                [
                    'product' => $data,
                    'search' => $request->search,
                ]
            );
        }
    }

    public function dumypage()
    {
        return "faizan";
    }
    public function primary()
    {
        return "good";
    }

    //tags
    public function index()
    {
        $tags = Tag::orderBy('name')->paginate(6);
        return view('tag', ['tags' => $tags]);
    }

    public function tagStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'slug' => 'nullable|string|max:255|unique:tags,slug',
        ]);
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = $request->slug ?? Str::slug($request->name);
        if ($tag->save()) {
            return redirect()->route('tags.index')->with('success', 'Tag has been Created successfully!');
        }
    }

    public function removeTags($id)
    {
        $tags = Tag::find($id);
        $tags->delete();
        return redirect()->back()->with('success', 'Tag deleted successfully!');
    }

    //  Category view..
    public function createCategory()
    {
        $category = Categorie::all();
        return view('category', ['category' => $category]);
    }

    // Category Create..
    public function categoryStore(Request $request)
    {
        $category = new Categorie();
        $category->name = $request->name;
        $category->slug = $request->slug;
        if ($category->save()) {
            return redirect()->route('viewcategory')->with('success', 'Category has been Created Successfully!');
        }
    }


    public function removeCategory($id)
    {
        $category = Categorie::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category has been Deleted');
    }
}
