<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Category;

use App\HomeCategory;

use App\Product;

use App\Language;



class   CategoryController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $sort_search =null;

        $categories = Category::orderBy('created_at', 'desc');

        if ($request->has('search')){

            $sort_search = $request->search;

            $categories = $categories->where('name', 'like', '%'.$sort_search.'%');

        }

        $categories = $categories->paginate(15);

        return view('categories.index', compact('categories', 'sort_search'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('categories.create');

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $category = new Category;

        $category->name = $request->name;

        $category->meta_title = $request->meta_title;

        $category->meta_description = $request->meta_description;

        if ($request->slug != null) {

            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

        }

        else {

            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str_random(5);

        }

        if ($request->commision_rate != null) {

            $category->commision_rate = $request->commision_rate;

        }



        $data = openJSONFile('en');

        $data[$category->name] = $category->name;

        saveJSONFile('en', $data);

        if($request->hasFile('thumbnail')){

            $image = $request->thumbnail;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->storeAs('uploads/categories/thumbnail',$filename);
            $category->thumbnail = 'uploads/categories/thumbnail/'.$filename;

        }

        $banners = array();

        if($request->hasFile('banner')){

            foreach($request->banner as $key => $image) {
                //$category->banner = $request->file('banner')->store('uploads/categories/banner');
                //$image = $request->banner;
                $ext = $image->getClientOriginalExtension();
                $filename = uniqid() . '.' . $ext;
                $path = $image->storeAs('uploads/categories/banner', $filename);
//                $category->banner = 'uploads/categories/banner/' . $filename;

                array_push($banners, $path);
            }

            $category->banner = json_encode($banners);

        }

        if($request->hasFile('icon')){

            //$category->icon = $request->file('icon')->store('uploads/categories/icon');
             $image = $request->icon;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->storeAs('uploads/categories/icon',$filename);
            $category->icon = 'uploads/categories/icon/'.$filename;

        }



        if($category->save()){

            flash(__('Category has been inserted successfully'))->success();

            return redirect()->route('categories.index');

        }

        else{

            flash(__('Something went wrong'))->error();

            return back();

        }

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $category = Category::findOrFail(decrypt($id));

        return view('categories.edit', compact('category'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        $category = Category::findOrFail($id);



        foreach (Language::all() as $key => $language) {

            $data = openJSONFile($language->code);

            unset($data[$category->name]);

            $data[$request->name] = "";

            saveJSONFile($language->code, $data);

        }



        $category->name = $request->name;

        $category->meta_title = $request->meta_title;

        $category->meta_description = $request->meta_description;

        if ($request->slug != null) {

            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

        }

        else {

            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str_random(5);

        }


         if($request->hasFile('thumbnail')){

           // $category->banner = $request->file('banner')->store('uploads/categories/banner');
            $image = $request->thumbnail;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->storeAs('uploads/categories/thumbnail',$filename);
            $category->thumbnail = 'uploads/categories/thumbnail/'.$filename;

        }

        $banners = array();

        if($request->has('previous_banners')){
            foreach($request->previous_banners as $key => $image) {
                array_push($banners, $image);
            }
        }

        if($request->hasFile('banner')){

            foreach($request->banner as $key => $image) {
                $ext = $image->getClientOriginalExtension();
                $filename = uniqid() . '.' . $ext;
                $path = $image->storeAs('uploads/categories/banner', $filename);

                array_push($banners, $path);
            }
        }

        if(count($banners) > 0)
            $category->banner = json_encode($banners);

        if($request->hasFile('icon')){

            //$category->icon = $request->file('icon')->store('uploads/categories/icon');
             $image = $request->icon;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->storeAs('uploads/categories/icon',$filename);
            $category->icon = 'uploads/categories/icon/'.$filename;

        }
        if ($request->commision_rate != null) {

            $category->commision_rate = $request->commision_rate;

        }



        if($category->save()){

            flash(__('Category has been updated successfully'))->success();

            return redirect()->route('categories.index');

        }

        else{

            flash(__('Something went wrong'))->error();

            return back();

        }

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $category = Category::findOrFail($id);

        foreach ($category->subcategories as $key => $subcategory) {

            foreach ($subcategory->subsubcategories as $key => $subsubcategory) {

                $subsubcategory->delete();

            }

            $subcategory->delete();

        }



        Product::where('category_id', $category->id)->delete();

        HomeCategory::where('category_id', $category->id)->delete();



        if(Category::destroy($id)){

            foreach (Language::all() as $key => $language) {

                $data = openJSONFile($language->code);

                unset($data[$category->name]);

                saveJSONFile($language->code, $data);

            }

            if($category->thumbnail != null){

                //unlink($category->thumbnail);

            }

            if($category->banner != null){

                //($category->banner);

            }

            if($category->icon != null){

                //unlink($category->icon);

            }

            flash(__('Category has been deleted successfully'))->success();

            return redirect()->route('categories.index');

        }

        else{

            flash(__('Something went wrong'))->error();

            return back();

        }

    }



    public function updateFeatured(Request $request)

    {

        $category = Category::findOrFail($request->id);

        $category->featured = $request->status;

        if($category->save()){

            return 1;

        }

        return 0;

    }

}

