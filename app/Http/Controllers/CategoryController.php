<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query()->latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::query()->where('parent_id', 0)->get();
        $attributes = Attribute::all();
        return view('admin.categories.create', compact('parentCategories', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'parent_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_is_filter_ids' => 'required',
            'variation_id' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $category = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'icon' => $request->icon,
                'description' => $request->description,
            ]);

            foreach ($request->attribute_ids as $attributeId) {
                $attribute = Attribute::query()->findOrFail($attributeId);
                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attributeId, $request->attribute_is_filter_ids) ? 1 : 0,
                    'is_variation' => $request->variation_id == $attributeId ? 1 : 0
                ]);
            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            alert()->error( 'مشکل در ایجاد دسته بندی', $e->getMessage())->persistent('حله');
            return redirect()->back();
        }
        alert()->success( 'با تشکر', 'دسته بندی  مورد نظر ایجاد شد.');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
