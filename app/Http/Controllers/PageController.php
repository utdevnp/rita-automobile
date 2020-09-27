<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Page;

use App\HomeCategory;

use App\Language;



class   PageController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public static $arrPositions = [
        "Header",
    ];

    public static $arrTypes = [
        "Content",
        "Link",
    ];

    public function index(Request $request)

    {

        $sort_search =null;

        $pages = Page::orderBy('position', 'asc')->orderBy('weight', 'asc');

        if ($request->has('search')){

            $sort_search = $request->search;

            $pages = $pages->where('name', 'like', '%'.$sort_search.'%');

        }

        $pages = $pages->paginate(15);

        return view('pages.index', compact('pages', 'sort_search'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('pages.create');

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $page = new Page;

        $page->name = $request->name;

        $page->position = $request->position;

        $page->type = $request->type;

        if($request->description) {
            $page->description = $request->description;
        }
        elseif($request->link) {
            $page->description = $request->link;
        }

        $page->parentId = $request->parentId;

        $page->video = $request->video;

        $page->weight = $request->weight;

        $page->status = 1;

        $page->meta_title = $request->meta_title;

        $page->meta_description = $request->meta_description;

        if ($request->slug != null) {

            $page->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

        }

        else {

            $page->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str_random(5);

        }

        $data = openJSONFile('en');

        $data[$page->name] = $page->name;

        saveJSONFile('en', $data);

        if($request->hasFile('banner')){

            $image = $request->banner;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->storeAs('uploads/pages/banner',$filename);
            $page->banner = 'uploads/pages/banner/'.$filename;

        }

        if($page->save()){

            flash(__('Page has been inserted successfully'))->success();

            return redirect()->route('pages.index');

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

        $page = Page::findOrFail(decrypt($id));

        $parentRes = Page::where([['position', $page->position], ['parentId', 0]], ['id', '!=', $page->id])->orderBy('weight', 'asc')->get();

        $page->parents = $parentRes;

        return view('pages.edit', compact('page'));

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

        $page = Page::findOrFail($id);



        foreach (Language::all() as $key => $language) {

            $data = openJSONFile($language->code);

            unset($data[$page->name]);

            $data[$request->name] = "";

            saveJSONFile($language->code, $data);

        }



        $page->name = $request->name;

        $page->position = $request->position;

        $page->type = $request->type;

        if($request->description) {
            $page->description = $request->description;
        }
        elseif($request->link) {
            $page->description = $request->link;
        }

        $page->parentId = $request->parentId;

        $page->video = $request->video;

        $page->weight = $request->weight;

        $page->status = $request->status;

        $page->meta_title = $request->meta_title;

        $page->meta_description = $request->meta_description;

        if ($request->slug != null) {

            $page->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

        }

        else {

            $page->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str_random(5);

        }


         if($request->hasFile('banner')){

           // $category->banner = $request->file('banner')->store('uploads/categories/banner');
            $image = $request->banner;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->storeAs('uploads/pages/banner',$filename);
            $page->banner = 'uploads/pages/banner/'.$filename;

        }

        if($page->save()){

            flash(__('Page has been updated successfully'))->success();

            return redirect()->route('pages.index');

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

        $page = Page::findOrFail($id);


        Page::where('parentId', $page->id)->delete();

        Page::where('id', $page->id)->delete();

        //HomeCategory::where('id', $category->id)->delete();

        if(Page::destroy($id)){

            foreach (Language::all() as $key => $language) {

                $data = openJSONFile($language->code);

                unset($data[$page->name]);

                saveJSONFile($language->code, $data);

            }

            if($page->banner != null){

                unlink($page->banner);

            }

            flash(__('Page has been deleted successfully'))->success();

            return redirect()->route('pages.index');

        }

        else{

            flash(__('Something went wrong'))->error();

            return back();

        }

    }



    public function updateStatus(Request $request)

    {

        $page = Page::findOrFail($request->id);

        $page->status = $request->status;

        if($page->save()){

            return 1;

        }

        return 0;

    }

    public function updateWeight(Request $request)

    {
        $prevPosition = $request->prevPosition;
        $prevParent = $request->prevParent;
        $prevWeight = $request -> prevWeight;
        $position = $request->position;
        $parentId = $request->parentId;

        if($prevPosition == $position && $prevParent == $parentId) {
            return $prevWeight;
        } else {

            if (!empty($position)) {
                $result = Page::select('weight')->where([['position', $position], ['parentId', $parentId]])->orderBy('weight', 'desc')->limit(1)->get();
                //dd($result);
                if(count($result) > 0) {
                    $weight = $result[0]->weight;
                    return ($weight + 10);
                } else {
                    return 10;
                }
            } else {
                return '';
            }
        }

    }

    public function getParents(Request $request)

    {

        $selected = $request->selected;
        $position = $request->position;
        $id = $request->id;

        $page = Page::where([['position', $position], ['parentId', 0], ['id', '!=', $id]])->orderBy('weight', 'asc')->get();

        //dd($page);

        $msg = '<select class="form-control demo-select2" name="parentId" id="parentId" onchange="updateWeight();">
                                <option value="0">Select Parent</option>';
        foreach ($page as $key => $pages) {
            //if($id != $pages->id) {
                $msg .= '<option value="' . $pages->id . '"';
                if ($pages->id == $selected) {
                    $msg .= ' selected';
                }
                $msg .= '>' . $pages->name . '</option>';
            //}
        }
        $msg .= '</select>';

        return $msg;
    }

}

