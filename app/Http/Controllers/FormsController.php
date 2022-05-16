<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Form;
use Carbon\Carbon;

class FormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::orderBy('created_at','desc')->get();
        return view('forms.index')->with('forms', $forms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|max:50',
            'image' => 'image|required|mimes:png|dimensions:max_width=170,max_height=156',
            'end' => 'nullable',
            'active' => 'boolean'
        ]);

            //'nullable' means it is not required; max:1999 - max size of the image

        //Handle file upload
        if($request->hasFile('image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);

            // make thumbnails
            $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/images/'.$thumbStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //current date
       // $current_time = Carbon::now()->toDateTimeString();
        $currentDate = date('Y-m-d');
        $currentDate = date('Y-m-d', strtotime($currentDate));
        
            //Create a new Form
            $form = new Form;
            $form->text = $request->input('text');
            $form->image = $fileNameToStore;
            $form->end = $request->input('end');

        if ((!isset($form->end)) || ($currentDate <= $form->end)){
            $form->active = '1';
        } else {
            $form->active = '0';
        }

        /*$end_time = $form->end;
            if(!isset($form->end)) {
                $form->active = '1';
            } elseif ($end_time->gt($current_time)) {
                $form->active = '1';
            } else {
                $form->active = '0';
            }
        */
            //added after authentication
            //$form->user_id = auth()->user()->id;
            $form->save();
          
        return redirect('/livecam/unos')->with('success', 'Post Created');
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
        $form = Form::find($id);

        // Check for correct user
        //if(auth()->user()->id !== $post->user_id){
          //  return redirect('/posts')->with('error', 'Unauthorized Page');
        //}
        return view('forms.edit')->with('form', $form);
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
        $this->validate($request, [
            'text' => 'required',
            'image' => 'image|required|max:1999'
        ]);

            //'nullable' means it is not required; max:1999 - max size of the image

        //Handle file upload
        if($request->hasFile('image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);

            // make thumbnails
            $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/images/'.$thumbStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }



            //Create a new Form
            $form = Form::find($id);
            $form->text = $request->input('text');
            $form->image = $fileNameToStore;
            //added after authentication
            //$form->user_id = auth()->user()->id;
            $form->save();
        return redirect('/livecam/prikaz')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = Form::find($id);

        
        if($form->image !== 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/images/'.$form->image);
        }

        $form->delete();
        return redirect('/livecam/prikaz')->with('success', 'Post Removed');
    }
}
