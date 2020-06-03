<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Admin\Contents;

use App\Admin\Contentcategories;

class ContentsController extends Controller
{

	public function index()
	{
		//$contents=Contents::paginate(10);
		
		$contents=Contents::all();
		
		return view('admin.contents.index')->with('contents',$contents);
	}
	
    public function add()
	{		
		$categories=Contentcategories::getactiveData();
		
		return view('admin.contents.add')->with('categories',$categories);
	}
	
    public function store(Request $request)
	{
		$content=new Contents;
		if($files=$request->file('image')){
        request()->validate([

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);
		$content->image=$imageName;
		}		
		
		if($files=$request->file('banner')){
        request()->validate([

            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        $bannerImage = time().'.'.request()->banner->getClientOriginalExtension();

        request()->banner->move(public_path('images'), $bannerImage);
		
		$content->banner_image=$bannerImage;
		}			
		$content->category=$request->input('category');	
		$content->title=$request->input('title');
		$content->slug=$this->createSlug($request->input('title'));
		$content->subtitle=$request->input('subtitle');
		$content->description=$request->input('description');
		
		$content->metatitle=$request->input('metatitle');
		$content->metakey=$request->input('metakey');
		$content->metadesc=$request->input('metadesc');
		
		$content->save();
		
		return redirect('/admin/contents')->with('status','Data added successfully');
	}
	
	public function edit($id='')
	{
		$content=Contents::findOrfail($id);
		$categories=Contentcategories::getactiveData();
		return view('admin.contents.edit')->with('content',$content)->with('categories',$categories);
	}
	
	public function update(Request $request,$id='')
	{
		$content=Contents::find($id);
		if($files=$request->file('image')){
        request()->validate([

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);
		$content->image=$imageName;
		}	
		if($request->input('remove')=="Y")
		{
		$path = public_path()."/images/".$content->image;
		unlink($path);
		$content->image="";
		}	
		
		if($files=$request->file('banner')){
        request()->validate([

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        $bannerImage = time().'.'.request()->banner->getClientOriginalExtension();

        request()->banner->move(public_path('images'), $bannerImage);
		$content->banner_image=$bannerImage;
		}	
		if($request->input('remove2')=="Y")
		{
		$path = public_path()."/images/".$content->banner_image;
		unlink($path);
		$content->banner_image="";
		}	
		if($content->title!=$request->input('title'))
		{
		$content->slug=$this->createSlug($request->input('title'));
		}
		$content->category=$request->input('category');
		$content->title=$request->input('title');
		$content->subtitle=$request->input('subtitle');
		$content->description=$request->input('description');
		
		$content->metatitle=$request->input('metatitle');
		$content->metakey=$request->input('metakey');
		$content->metadesc=$request->input('metadesc');
		
		$content->update();
		
		return redirect('/admin/contents')->with('status','Data updated successfully.');
	}
	
	public function delete($id='')
	{
		$content=Contents::findOrfail($id);
		
		$content->delete();
		return redirect('/admin/contents')->with('status','Data deleted successfully.');
	}
	
	public function order(Request $request)
	{
		$id_ary = $request->input('sort_order');
		foreach($request->input('sort_order') as $key=>$val) {
		$content=Contents::findOrfail($key);
		$content->sort_order=$val;
		$content->update();
		}

		return redirect('/admin/contents')->with('status','Sort order updated successfully.');
	}
	
	public function status($id,$status)
	{
		if($status==1)
		{
		$status=0;
		}
		else
		{
		$status=1;
		}
		$content=Contents::findOrfail($id);
		$content->status=$status;
		$content->update();
		
		return redirect('/admin/contents')->with('status','Status updated successfully.');

	}
	
	public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Contents::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
	
}
