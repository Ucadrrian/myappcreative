<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Models\Category;
use App\Http\Models\Comics;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use App\Http\Models\CGallery;


class ComicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($status)
    {
        switch ($status) {
            case '0':
                $comics = Comics::with(['cat'])->where('status','0')->orderBy('id','desc')->paginate(25);
                break;
            case '1':
                $comics = Comics::with(['cat'])->where('status','1')->orderBy('id','desc')->paginate(25);
            break;

            case 'all':
                $comics = Comics::with(['cat'])->orderBy('id','desc')->paginate(25);
            break;

            case 'trash':
                $comics= Comics::with(['cat'])->onlyTrashed()->orderBy('id','desc')->paginate(25);
            break;
                break;
        }

        $data = ['comics' => $comics];
        return view('admin.comics.home', $data);
    }

    public function getComicsAdd()
    {
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.comics.add', $data);
    }

    public function postComicsAdd(Request  $request)
    {
        $rules = [
            'name' => 'required',
            'img' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
            'codigo' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre del Comcis es requerido',
            'img.required' => 'Seleccione una imagen destacada',
            'img.image' => 'El archivo no es una imagen',
            'codigo.required' => 'El codigo del producto es requerido',
            'content.required' => 'La descripción del comics es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')->with(
                'typealert',
                'danger'
            )->withInput();
        else :
            $path = '/' . date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

            $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;
            $file_file = $upload_path . '/' . $path . '/' . $filename;

            $comics = new Comics;
            $comics->status = '0';
            $comics->name = e($request->input('name'));
            $comics->slug = Str::slug($request->input('name'));
            $comics->category_id = $request->input('category');
            $comics->file_path = date('Y-m-d');
            $comics->image = $filename;
            $comics->codigo = e($request->input('codigo'));
            $comics->content = e($request->input('content'));
            if ($comics->save()) :
                if ($request->hasFile('img')) :
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($upload_path . '/' . $path . '/t_' . $filename);
                endif;
                return redirect('/admin/comics')->with('message', 'Guardado con éxito.')->with(
                    'typealert',
                    'success'
                );
            endif;
        endif;
    }

    public function getComicsEdit($id)
    {
        $c = Comics::findOrFail($id);
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'c' => $c];
        return view('admin.comics.edit', $data);
    }

    public function postComicsEdit($id, Request  $request)
    {
        
        $rules=[
            'name'=>'required',
            'content'=>'required',
            'img'=>'image',
            'codigo'=>'required',

        ];

        $messages=[
            'name.required'=>'El nombre del producto es requerido',
            'img.image'=>'El archivo no es una imagen',
            'codigo.required'=>'El codigo del producto es requerido',
            'content.required'=>'La descripción del producto es requerido',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')->with(
                'typealert',
                'danger'
            )->withInput();
        else :
            $comics = Comics::findOrFail($id);
            $ipp =$comics->file_path;
            $ip=$comics->image;
            $comics->status = $request->input('status');
            $comics->name = e($request->input('name'));
            $comics->category_id = $request->input('category');
            if ($request->hasFile('img')) :
                $path = '/' . date('Y-m-d');
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

                $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;
                $file_file = $upload_path . '/' . $path . '/' . $filename;
                $comics->file_path = date('Y-m-d');
                $comics->image = $filename;
            endif;
            $comics->codigo = e($request->input('codigo'));
            $comics->content = e($request->input('content'));
            if ($comics->save()) :
                if ($request->hasFile('img')) :
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($upload_path . '/' . $path . '/t_' . $filename);
                    unlink($upload_path.'/'.$ipp.'/'.$ip);
                    unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                endif;
                return back()->with('message','Actualizado con éxito.')->with('typealert','success');
            endif;
        endif;
    }

    public function postComicsGalleryAdd($id, Request $request){
        $rules=[
            'file_image'=>'required|image'

        ];

        $messages=[
            'file_image.required'=>'Seleccione una imagen ',
            'file_image.image'=>'El archivo no es una imagen'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error.')->with(
                'typealert','danger')->withInput();
            else:
                if ($request->hasFile('file_image')) :
                    $path = '/' . date('Y-m-d');
                    $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                    $upload_path = Config::get('filesystems.disks.uploads.root');
                    $name = Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));
    
                    $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;
                    $file_file = $upload_path . '/' . $path . '/' . $filename;

                    $g = new CGallery;
                    $g->comic_id  = $id;
                    $g->file_path = date('Y-m-d');
                    $g->file_name= $filename;

                    if($g->save()):
                        if($request->hasFile('file_image')):
                            $fl = $request->file_image->storeAs($path,$filename,'uploads');
                            $img = Image::make($file_file);
                            $img->fit(256,256, function($constraint){
                                $constraint->upsize();
                            });
                            $img->save($upload_path.'/'.$path.'/t_'.$filename);
                        endif;
                        return back()->with('message','Imagen sudida con éxito.')->with(
                            'typealert','success');
                    endif;

                endif;
    
            endif;

    }

    public function getComicsGalleryDelete($id , $gid)
    {
        $g = CGallery::findOrFail($gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');
        if($g->comic_id != $id){
            return back()->with('message','La Imagen no se puede Eliminar.')->with(
                'typealert','danger');
        }else{
            if($g->delete()):
                unlink($upload_path.'/'.$path.'/'.$file);
                unlink($upload_path.'/'.$path.'/t_'.$file);
            return back()->with('message','Imagen borrada con éxisto.')->with(
                    'typealert','success');
            endif;
        }

    }
}
