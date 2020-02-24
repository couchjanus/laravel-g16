<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Enums\CategoryEnumStatusType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate();
        $title = 'Categories Management';
        $status = CategoryEnumStatusType::toSelectArray();
        return view('admin.categories.index', compact('categories', 'title', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Category';
        // $categories = Category::pluck('name', 'id');
        $categories = Category::get()->toTree();
        $status = CategoryEnumStatusType::toSelectArray();
        return view('admin.categories.create', compact('title', 'status', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:191|min:3',
            'description' => 'nullable|string',
        ]);
        
        // Переданные данные не прошли проверку
        if ($validator->fails()) {
            return redirect('admin/categories/create')
                    ->withErrors($validator)
                    ->withInput();
        }

        $validator->after(function ($validator) {
            if ($this->somethingElseIsInvalid()) {
                $validator->errors()->add('name', 'Something is wrong with this field!');
            }
        });
        
        Category::create($request->all());
        return redirect(route('admin.categories.index'))->with('success', 'Category Created Successfully!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show')->withCategory($category)->withTitle('Show Category');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit(Category $category)
    {
        
        $categories = Category::get()->toTree();
        $status = CategoryEnumStatusType::toSelectArray();
        return view('admin.categories.edit')->withCategory($category)->withTitle('Edit Category')->withStatus($status)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, 
            [
            'name' => [
                'required',
                'max' >= 191,
                'min' >= 3,
                Rule::unique('categories')->ignore($category->id),
                ],
            'description' => 
                [
                    'nullable',
                    'string',
                ]
        ]);

        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }

    public function trashed()
    {
        $categories = Category::onlyTrashed()->paginate();
        $title = 'Trashed Categories';
        return view('admin.categories.trashed', compact('title', 'categories'));
    }

    public function restore($id)
    {
        Category::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect(route('admin.categories.trashed'));
    }

    public function categoryDestroy($id)
    {
        $category = Category::withTrashed()
                ->findOrFail($id);
        $category->forceDelete();
        return redirect()->route('admin.categories.index');
    }
    
    public function force($id)
    {
        Category::trash($id)->forceDelete();
        return redirect()->route('admin.categories.index')->with('success', 'Category Deleted Successfully!');
    }
}
