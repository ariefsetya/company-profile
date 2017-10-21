<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;
use App\Templates;
use App\Contents;
use App\Subcontents;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function masterlist($table)
    {
        $data['data'] = $this->getData($table);
        $array_join = [];
        foreach ($data['data']['fields'] as $key) {
            if($key['join']!=""){
                $array_join[] = $key['join'];
            }
        }


        $data['data']['all'] = $data['data']['model']::with($array_join)->get();
        // dd($data);
        $data['data']['paged'] = $data['data']['model']::paginate(10);
        return view('master.all')->with($data);
    }

    public function masteradd($table)
    {
        $data['data'] = $this->getData($table);
        foreach ($data['data']['fields'] as $key) {
            if($key['type']=="select" and $key['join']!=""){
            $data['data']['join'][$key['join']]['all'] = $key['model']::all();
            } 
        }
        return view('master.add')->with($data);
    }

    public function getData($table)
    {
        $field['pages'] = [
            'model'=>Pages::class,
            'table'=>$table,
            'type'=>'1',
            'fields'=>
                [
                    [
                        'name'=>'Title',
                        'field'=>'title',
                        'type'=>'string',
                        'value'=>'',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ],
                    [
                        'name'=>'Slug',
                        'field'=>'slug',
                        'type'=>'slug',
                        'value'=>'title',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ]
                ]
            ];
        $field['subcontents'] = [
            'model'=>Subcontents::class,
            'table'=>$table,
            'type'=>'1',
            'fields'=>
                [
                    [
                        'name'=>'Content',
                        'field'=>'content_id',
                        'type'=>'select',
                        'value'=>'title',
                        'join'=>'contents',
                        'model'=>Contents::class,
                        'required'=>true,
                    ],
                    [
                        'name'=>'Title',
                        'field'=>'title',
                        'type'=>'string',
                        'value'=>'',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ],
                    [
                        'name'=>'Slug',
                        'field'=>'slug',
                        'type'=>'slug',
                        'value'=>'title',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ],
                    [
                        'name'=>'Description',
                        'field'=>'description',
                        'type'=>'text',
                        'value'=>'',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ]
                ]
            ];
        $field['contents'] = [
            'model'=>Contents::class,
            'table'=>$table,
            'type'=>'1',
            'fields'=>
                [
                    [
                        'name'=>'Page',
                        'field'=>'page_id',
                        'type'=>'select',
                        'value'=>'title',
                        'join'=>'pages',
                        'model'=>Pages::class,
                        'required'=>true,
                    ],
                    [
                        'name'=>'Title',
                        'field'=>'title',
                        'type'=>'string',
                        'value'=>'',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ],
                    [
                        'name'=>'Slug',
                        'field'=>'slug',
                        'type'=>'slug',
                        'value'=>'title',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ],
                    [
                        'name'=>'Image',
                        'field'=>'image',
                        'type'=>'image',
                        'value'=>'upload',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ],
                    [
                        'name'=>'Position',
                        'field'=>'position',
                        'type'=>'order',
                        'value'=>'0',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ],
                    [
                        'name'=>'Template',
                        'field'=>'template_id',
                        'type'=>'select',
                        'value'=>'title',
                        'join'=>'templates',
                        'model'=>Templates::class,
                        'required'=>false,
                    ]
                ]
            ];
        $field['templates'] = [
            'model'=>Templates::class,
            'table'=>$table,
            'type'=>'1',
            'fields'=>
                [
                    [
                        'name'=>'Title',
                        'field'=>'title',
                        'type'=>'string',
                        'value'=>'',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ],
                    [
                        'name'=>'Content',
                        'field'=>'content',
                        'type'=>'text',
                        'value'=>'',
                        'join'=>'',
                        'model'=>'',
                        'required'=>true,
                    ]
                ]
            ];

        return $field[$table];
    }

    public function mastersave($table)
    {
        $data = $this->getData($table);
        $a = new $data['model'];
        foreach ($data['fields'] as $key) {
            if(in_array($key['type'], ['string','text'])){
                // echo $a->{$key->['field']};
                $a->{$key['field']} = Input::get($key['field']);
            }else if($key['type']=="slug"){
                $a->{$key['field']} = str_slug(Input::get($key['value']));
            }else if($key['type']=="select"){
                $a->{$key['field']} = Input::get($key['field'])==null?0:Input::get($key['field']);
            }else{
                $a->{$key['field']} = "";
            }
        }
        $a->save();

        if($a->id!=null){
            return redirect()->route('masterlist',[$table]);
        }else{
            return redirect()->route('masteradd',[$table]);
        }
    }

    public function masteredit($table,$id)
    {
        $data['data'] = $this->getData($table);
        foreach ($data['data']['fields'] as $key) {
            if($key['type']=="select" and $key['join']!=""){
                $data['data']['join'][$key['join']]['all'] = $key['model']::all();
            } 
        }

        $data['data']['edit'] = $data['data']['model']::find($id);
        // dd($data);
        return view('master.edit')->with($data);
    }

    public function masterupdate($table)
    {
        $data = $this->getData($table);
        $id = Input::get('id');
        $a = $data['model']::find($id);
        // dd($a);
        foreach ($data['fields'] as $key) {
            if(in_array($key['type'], ['string','text'])){
                $a->{$key['field']} = Input::get($key['field']);
            }else if($key['type']=="slug"){
                $a->{$key['field']} = str_slug(Input::get($key['value']));
            }else if($key['type']=="select"){
                $a->{$key['field']} = Input::get($key['field'])==null?0:Input::get($key['field']);
            }else{
                $a->{$key['field']} = "";
            }
        }
        $a->save();

        if($a->id!=null){
            return redirect()->route('masterlist',[$table]);
        }else{
            return redirect()->route('masteredit',[$table,$id]);
        }
    }

    public function masterdelete($table,$id)
    {
        $data['data'] = $this->getData($table);

        $data['data']['model']::find($id)->delete();
        // dd($data);
        return redirect()->route('masterlist',[$table]);
    }
    public function page($page)
    {
        $data = \App\Pages::whereSlug($page)->first();
        return view('home')->with(array('data'=>$data));
    }
}
