<?php
//
//namespace App\Http\Controllers;
//
//use Illuminate\Http\Request;
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
////
////                // save original image
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
//
////            $data = $request->input('image');
////            $photo = $request->file('image')->getClientOriginalName();
////            $destination = base_path() . '/public/uploads';
////            $request->file('image')->move($destination, $photo);
////
//
//
//
//
//
//            if ($request->hasFile('image')) {
//    // your code here
//}
//
//            return back()->with('success', 'Your images has been successfully Upload.');
////            return redirect(route('admin.articles.create'))->with('success', 'Your images has been successfully Upload.');
//        }
//    }
//}
