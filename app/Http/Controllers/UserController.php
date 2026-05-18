<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Seller;
use App\Models\Userlogin;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Article;
use App\Models\AttributeValue;
use App\Models\Item_images;
use App\Models\Tag;
use Illuminate\Contracts\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\VarLikeIdentifier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;

class UserController extends Controller
{


    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:15',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $validation->errors();
        } else {
            $input = $request->all();
            $input["password"] =  bcrypt($input["password"]);
            $user = User::create($input);

            $data['token'] = $user->createToken("MyApi")->plainTextToken;
            $user["name"] = $user->name;

            return [
                'success' => true,
                "result" => $data,
                "msg" => "User Register Successfully"
            ];
        }
    }

    public function Login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                "result" => "User Not Found",
                "success" => false
            ];
        }

        // Only runs if login is successful
        $data['token'] = $user->createToken("MyApi")->plainTextToken;
        $data['name'] = $user->name;

        return [
            'success' => true,
            "result" => $data,
            "msg" => "User Logged In Successfully"
        ];
    }

    public function getData()
    {
        return  Article::all();
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:220',
            'containt' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];

        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ], 400);
        }

        $data = $request->only(['title', 'containt', 'description']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }
        $article = Article::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Article Created SuccessFully',
            'data' => $article
        ], 201);
    }


    public function update(Request $request)
    {

        $rules = [
            'title' => 'required|string|max:220',
            'containt' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ], 400);
        }

        $article = Article::find($request->id);
        $article->title = $request->title;
        $article->containt = $request->containt;
        $article->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $article->image = $imageName;
        }

        if ($article->save()) {
            return ["result" => "api data is updated"];
        }
        return ["result" => "api data is not updated"];
    }

    public function delete($id)
    {
        $article = Article::destroy($id);

        if ($article) {
            return ["result" => "Data has been Deleted"];
        } else {
            return ["result" => "Operation Has Been Failed"];
        }
    }

    public function Search($title)
    {
        $Search = Article::where('title', 'like', "%{$title}%")->get();

        if ($Search->isNotEmpty()) {
            return ["result" => $Search];
        } else {
            return ["result" => "Record Not Found"];
        }
    }


    public function Authentication(Request $request)
    {
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validation)) {
            $request->session()->regenerate();
            return redirect('dashbord');
        } else {
            return redirect('login')->with('error', 'Invalid credentials');
        }
    }

    public function dashbord()
    {
        return view('dashbord');
    }

    public function logout()
    {
        Auth::logout();
        return view('login');
    }

    //  one to one relationship.. 
    public function listAll()
    {
        $seller = Seller::with('ProductData')->get();
        return response()->json($seller);
    }
    //one to many relationship..
    public function OneToMany()
    {
        $sellers = Seller::with('products')->get();
        return response()->json($sellers);
    }
    public function getsellerProducts($id)
    {
        $seller = Seller::with('products')->find($id);
        return response()->json($seller);
    }

    public function manyToOne()
    {
        $seller = Product::with('Seller')->get();
        return response()->json($seller);
    }

    public function getProductsBySeller($id)
    {
        $product = Product::with('Seller')->find($id);
        return response()->json($product);
    }

    public function Manytomany($id)
    {
        $user = User::findorFail($id);
        $roles = $user->roles;
        return response()->json($roles);
    }

    public function assignRolesToUser(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $roleids = $request->input('roles');  // fixed key name
        $user->roles()->attach($roleids);
        return response()->json(['message' => 'Roles assigned successfully']);
    }

    public function userLogin()
    {
        return view('userLogin');
    }

    public function userAuth(Request $request)
    {
        // session()->forget('admin_logged_in');
        session()->flush();

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = Userlogin::where('username',  $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['user' => "User doesn't exist"]);
        }
        session()->put('user_logged_in', true);
        session(['user_id' => $user->id]);
        session()->put('user', $user->username);
        session()->put('role', 'user');
        return redirect('/product-listing');
    }
    public function userProductList()
    {
        $ProductData = Item::paginate(8);
        return view('userProductList', compact('ProductData'));
    }

    public function UserLogout(Request $request)
    {
        $request->session()->flush();
        return redirect('user-login');
    }

   public function productDetails(Request $request, $id)
{
    $productDetails = Item::with([
        'images',
        'categories',
        'tags',
        'variant.variantValues.attributeValue'
    ])->findOrFail($id);

    $cartCount = session('user_id') ? Cart::where('user_id', session('user_id'))->count() : 0;

    $selectedColor = $request->query('color') ?? $request->input('selected_color') ?? $request->input('color');
    $selectedSize = $request->query('size') ?? $request->input('selected_size') ?? $request->input('size');

    $colorOptions  = collect();
    $sizeOptions   = collect();

    if ($productDetails->variant->isNotEmpty()) {
        // ✅ Color options
        $colorOptions = $productDetails->variant
            ->flatMap(function($v) {
                return $v->variantValues
                    ->filter(fn($attrVal) => $attrVal->attributeValue && $attrVal->attributeValue->attribute_id == 1)
                    ->map(function($attrVal) use ($v) {
                        return (object)[
                            'id' => $attrVal->attribute_value_id,
                            'value' => $attrVal->attributeValue->value,
                            'stock' => $v->stock,
                        ];
                    });
            })->unique('id')->values();

        // ✅ Size options (same format)
        $sizeOptions = $productDetails->variant
            ->flatMap(function($v) {
                return $v->variantValues
                    ->filter(fn($attrVal) => $attrVal->attributeValue && $attrVal->attributeValue->attribute_id == 2)
                    ->map(function($attrVal) use ($v) {
                        return (object)[
                            'id' => $attrVal->attribute_value_id,
                            'value' => $attrVal->attributeValue->value,
                            'stock' => $v->stock,
                        ];
                    });
            })->unique('id')->values();
    }

    $fallbackColor = optional($productDetails->images->first())->color;
    $currentColor = $selectedColor ?: $fallbackColor;

    $defaultImages = $currentColor
        ? $productDetails->images->where('color', $currentColor)
        : $productDetails->images;

    return view('productDetails', [
        'productDetails' => $productDetails,
        'cartCount' => $cartCount,
        'color' => $colorOptions,
        'size' => $sizeOptions,
        'defaultColor' => $currentColor,
        'defaultImages' => $defaultImages,
        'selectedColor' => $selectedColor,
        'selectedSize' => $selectedSize,
    ]);
}

    public function addMultipleImg($id)
    {
        $Image = Item::with('images')->findOrFail($id);
        return view('addMultipleImg', compact('Image'));
    }

    public function sendImg(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        if ($request->hasFile('images')) {
            $colors = $request->input('color');

            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                Item_images::create([
                    'item_id' => $item->id,
                    'images' => $path,
                    'color' => $colors
                ]);
            }
        }
        return redirect()->route('multiple', $item->id)->with('success', 'Image uploaded  Successfully');
    }
    public function searchProduct(Request $request)
    {
        $search = $request->search;

        $query = Item::query();

        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        $ProductData = $query->paginate(8)->appends(['search' => $search]);

        return view('userProductList', compact('ProductData'))
            ->with('search', $search);
    }

    public function registration(Request $request)
    {
        $register = new Userlogin();
        $register->username = $request->username;
        $register->email = $request->email;
        $register->password = Hash::make($request->password);
        if ($register->save()) {
            return redirect()->route('user.login');
        }
    }
    public function getImagesByColor($itemId, $color)
    {
        $images = Item_images::where('item_id', $itemId)
            ->where('color', $color)
            ->pluck('images');

        return response()->json($images);
    }
}
