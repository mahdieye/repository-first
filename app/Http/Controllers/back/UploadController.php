<?php
//
//namespace App\Http\Controllers\back;
//
//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
//use App\Images;
//use Image;
//use File;
//
//class UploadController extends Controller
//{
//    public $imagesPath = '';
//    public $thumbnailPath = '';
//
//    /**
//     * Upload form
//     */
//    public function getUploadForm()
//    {
//        $images = Images::get();
//        return view('upload-image', compact('images'));
//        return $images;
//    }
//
//    /**
//     * @function CreateDirectory
//     * create required directory if not exist and set permissions
//     */
//    public function createDirecrotory()
//    {
//        $paths = [
//            'image_path' => public_path('images/'),
//            'thumbnail_path' => public_path('images/thumbs/')
//        ];
//
//        foreach ($paths as $key => $path) {
//            if(!File::isDirectory($path)){
//                File::makeDirectory($path, 0777, true, true);
//            }
//        }
//
//        $this->imagesPath = $paths['image_path'];
//        $this->thumbnailPath = $paths['thumbnail_path'];
//    }
//
//    /**
//     * Post upload form
//     */
//    public function postUploadForm(Request $request)
//    {
//        $request->validate([
//            'upload.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
//        ]);
//
//        if($request->hasFile('upload')) {
//
//            $this->createDirecrotory();
//
//            foreach ($request->upload as $file) {
//
//                $image = Image::make($file);
//                // you can also use the original name
//                $imageName = time().'-'.$file->getClientOriginalName();
//
////                 save original image
//                $image->save($this->imagesPath.$imageName);
//
//                // resize and save thumbnail
//                $image->resize(150,150);
//                $image->save($this->thumbnailPath.$imageName);
//
//                $upload = new Images();
//                $upload->file = $imageName;
//                $upload->save();
//
//            }
//
//            return back()->with('success', 'Your images has been successfully Upload.');
//        }
//    }
//}


namespace App\Http\Controllers\back;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        return back()
            ->with('success', 'عکس شما با موفقیت اپلود شد.')
            ->with('image', $imageName);
    }
}
