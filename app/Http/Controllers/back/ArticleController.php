<?php

namespace App\Http\Controllers\back;

use App\Article;
use App\Category;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

//use \Cviebrock\EloquentSluggable\Services\SlugService;


class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::orderBy('id', 'DESC')->paginate(5);
        return view('back.articles.articles', compact('articles'));
    }


    public function create()
    {

        $categories = Category::all()->pluck('name','id');

        return view('back.articles.create', compact('categories'));
    }


    public function store(Request $request)
    {

            $validatedData = $request->validate([
                'name' => 'required',
              'slug' => 'required|unique:categories'
            ]);
        $article = new Article();
        try {
            $article = $article->create($request->all());
            $article->categories()->attach($request->categories);
        } catch (Exception $exception) {
            switch ($exception->getCode()) {
                case 23000:
                    $msg = "نام مستعار وارد شده تکراری است";
                    break;
            }
            return redirect(route('admin.articles.create'))->with('warning', $msg);
        }




//          $article = new Article();
//            $article->name = $request->input('name');
//            $article->slug = $request->input('slug');
//            $article->description = $request->input('description');
//            $article->status = $request->input('status');
//            $article->user_id = $request->input('user_id');
//            $article->image = $request->input('image');
//            return $article->image ;

        if($request->hasFile('image'))
        {

            $file = $request->file('image');

            $filename = time().'.'.$file->getClientOriginalExtension();
            $name=$file->getClientOriginalName();

            $image_path = public_path('/images/');
            $file-> move($image_path,$name);
            $article->image = $name;

        }
        else{

            $article->image ='';
        }

        $article->save();
        $msg = "ذخیره ی مطلب جدید با موفقیت انجام شد";
        return redirect(route('admin.articles'))->with('success', $msg);

    }


    public function show(Article $article)
    {
        //
    }


    public function edit(Article $article)
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('back.articles.edit', compact('article', 'categories'));
    }


    public function update(Request $request, Article $article)
    {
        $messages = [
            'name.required' => 'فیلد عنوان را وارد نمایید',
            'slug.unique' => 'فیلد نام مستعار تکراری است.عنوان را عوض کنید',
            'slug.required' => 'فیلد نام مستعار اجباری است'
        ];
        $validatedData = $request->validate([
            'name' => 'required',
           'slug' => 'required|unique:categories'
        ], $messages);
             try {
          $article->update($request->all());
//            return $article;
           $article->save();

          $article->categories()->sync($request->categories);

       } catch (Exception $exception) {
           switch ($exception->getCode()) {
               case 23000:
                  $msg = "نام مستعار وارد شده تکراری است";
                  break;
    }
           return redirect(route('admin.articles.create'))->with('warning', $msg);
       }


//$input = $request->all();
//        return $input;
//        $article->fill($article)->save();
//            return $article;
        if($request->hasFile('image')) {
            $file = $request->file('image');
//        return $file;
            $file_name = $file->getClientOriginalName();
//        return $file_name;
            $image_path = public_path('/images/');
            $file->move($image_path, $file_name);
            $article->image = $file_name;
            $article->save();
        }
        $msg = "ذخیره ی مطلب جدید با موفقیت انجام شد";
        return redirect(route('admin.articles'))->with('success', $msg);

//

//        return $inputs;
//        $file=$article->image;
//
//        $filename = time().'.'.$file->getClientOriginalExtension();
//
//        return $name;

//        foreach ($inputs as $input) {//this statement will loop through all files.
//            return $input;
//            $file_name = $input->getClientOriginalName(); //Get file original name
//            $file->move($image_path , $file_name);
//            // move files to destination folder
//            return $file;
//        }

//        $file-> move($image_path,$file);
//        return $file;
//        $article->image = $file;
////        $article->fill($input)->save();
//return $article;





//        if ($request->hasFile('file')) {
//            $destinationPath = 'path/th/save/file/';
//            $files = $request->file('file'); // will get all files
//
//            foreach ($files as $file) {//this statement will loop through all files.
//                $file_name = $file->getClientOriginalName(); //Get file original name
//                $file->move($destinationPath , $file_name); // move files to destination folder
//            }
//        }


//        $filename = time().'.'.$file->getClientOriginalExtension();

//return $name;

//            $thumbnail_path = public_path('/images/thumbnail/');






//        $article->update($request->all());
//          return $article;
//        $article->save();

//        try {
//            $article->update($request->all());
////            return $article;
//            $article->save();
//
//            $article->categories()->sync($request->categories);
//        } catch (Exception $exception) {
//            switch ($exception->getCode()) {
//                case 23000:
//                    $msg = "نام مستعار وارد شده تکراری است";
//                    break;
            }
//            return redirect(route('admin.articles.create'))->with('warning', $msg);
//        }

//        $msg = "ذخیره ی مطلب جدید با موفقیت انجام شد";
//        return redirect(route('admin.articles'))->with('success', $msg);



    public function destroy(Article $article)
    {
        try {
            $article->delete();
        } catch (Exception $exception) {
            return redirect(route('admin.articles'))->with('warning', $exception->getCode());
        }

        $msg = "آیتم مورد نظر حذف گردید";
        return redirect(route('admin.articles'))->with('success', $msg);
    }

    public function updatestatus(Article $article)
    {
        if ($article->status == 1) {
            $article->status = 0;
        } else {
            $article->status = 1;
        }

        $article->save();
        $msg = "بروزرسانی با موفقیت انجام شد";
        return redirect(route('admin.articles'))->with('success', $msg);

    }


    public function getUploadForm()
    {

        $images = Image::get();
        foreach ($images as $image) {
            echo $image->file;

        }

        return view('upload-image', compact('images'));

    }



    public function createDirecrotory()
    {
        $paths = [
            'image_path' => public_path('images/'),
            'thumbnail_path' => public_path('images/thumbs/')
        ];

        foreach ($paths as $key => $path) {
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
        }

        $this->imagesPath = $paths['image_path'];
        $this->thumbnailPath = $paths['thumbnail_path'];
    }

    /**
     * Post upload form
     */
    public function postUploadForm(Request $request)
    {
        $request->validate([
            'upload.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->hasFile('upload')) {

            $this->createDirecrotory();

            foreach ($request->upload as $file) {

                $image = Image::make($file);
                // you can also use the original name
                $imageName = time().'-'.$file->getClientOriginalName();

                // save original image
                $image->save($this->imagesPath.$imageName);

                // resize and save thumbnail
                $image->resize(150,150);
                $image->save($this->thumbnailPath.$imageName);

                $upload = new Image();
                $upload->file = $imageName;
                $upload->save();

            }

            return back()->with('success', 'Your images has been successfully Upload.');
        }
    }

    public  function fileUpload(Request $request){

        if($request->hasFile('image'))
        {

            $file = $request->file('image');

            $filename = time().'.'.$file->getClientOriginalExtension();

            $image_path = public_path('/images/');
//            $thumbnail_path = public_path('/images/thumbnail/');

            $file-> move($image_path,$filename);
            $article->image = $filename;

        }
        else{

            $article->image ='';
        }
    }

}
