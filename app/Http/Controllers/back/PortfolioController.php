<?php


namespace App\Http\Controllers\back;

use App\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $portfolios = Portfolio::orderBy('id', 'DESC')->paginate(20);
        return view('back.portfolios.portfolios', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.portfolios.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'فیلد عنوان را وارد نمایید'
        ];
        $validatedData = $request->validate([
            'name' => 'required',

        ], $messages);

        $portfolio = new Portfolio();
        $portfolio->name = $request ->input ('name');
        $portfolio->tag = $request ->input ('tag');
        $portfolio->link = $request ->input ('link');
        $portfolio->description = $request ->input ('description');
        if ($request->hasfile('image'))
        {
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = public_path('/images/');
            $file->move($location,$filename);
//            $filename = resize($filename,250 , 250);
            $portfolio->image = $filename;
//            return ($article->image);
//            $file = $file->getClientOriginalName() ;

//            $filenamethumbs = resize($file,150 , 150);
//            $locationthumbs = public_path('/images/thumbs');
//            $filenamethumbs->move( $locationthumbs,   $filenamethumbs);


        }
        else{
//            return  $request;
            $portfolio->image='';
        }
        $portfolio->save();
//        return  view('back/articles/articles')->with('article',$article);
//        return redirect(route('admin.portfolios'))->with('success');






//        try {
//            $portfolio->create($request->all());
////            dd($portfolio);
//        } catch (Exception $exception) {
//
//            return redirect(route('admin.portfolios.create'))->with('warning', $exception->getCode());
//        }

        $msg = "ذخیره ی نمونه کار جدید با موفقیت انجام شد";
        return redirect(route('admin.portfolios'))->with('success', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }


    public function edit(Portfolio $portfolio)
    {
        $portfolios = Portfolio::all();
        return view('back.portfolios.edit', compact('portfolios'));
    }



    public function update(Request $request, Portfolio $portfolio)
    {


        $messages = [
            'name.required' => 'فیلد عنوان را وارد نمایید'

        ];
        $validatedData = $request->validate([
            'name' => 'required',

        ], $messages);

        try {
            $portfolio->update($request->all());
            $portfolio->save();

//            $portfolio->categories()->sync($request->categories);
        } catch (Exception $exception) {

            return redirect(route('admin.portfolios.edit'))->with('warning', $exception->getCode());
        }

        $msg = "بروزرسانی نمونه کار با موفقیت انجام شد";
        return redirect(route('admin.portfolios'))->with('success', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(portfolio $portfolio)
    {
        try {
            $portfolio->delete();
        } catch (Exception $exception) {
            return redirect(route('admin.portfolios'))->with('warning', $exception->getCode());
        }

        $msg = "آیتم مورد نظر حذف گردید";
        return redirect(route('admin.portfolios'))->with('success', $msg);
    }
}
