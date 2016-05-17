<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\SimpleModel;
use Validator, Redirect, Session, DB, Auth; 
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Image; 
class SimpleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('user')->paginate(2);
        return view('simple_project.showDbAlldata', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
         $validator = Validator::make($data->all(), [
            'form_name' => 'required|min:4|max:25',
            'form_email' => 'required|email|min:8|max:35',
            'form_password' => 'required|min:8|max:25',
            'form_file' => 'required|mimes:jpg,png,jpeg|max:200',

        ]);
        
        if ($validator->fails()) {
            return redirect('form')
                        ->withErrors($validator)
                        ->withInput();
        }else{

            //img version 1.0
            /*$img_obj = $data->file('form_file');
            $upload ='uploads';
            $fileName=$img_obj->getClientOriginalName();
            $success = $img_obj->move($upload, $fileName);*/
            //end img version 1.0

            
            // checking file is valid.
            if (Input::file('form_file')->isValid()) {
                
                //img version 2.0
                //$img_obj=Input::file('form_file');
                //$img_obj = $data->file('form_file');
                //$destinationPath = 'uploads'; // upload path
                //$extension = Input::file('form_file')->getClientOriginalExtension(); // getting image extension
                //$fileName = rand(11111,99999).uniqid().date('Y-m-d-H-i-s').'.'.$extension; // renameing image
               // $success=$img_obj->move($destinationPath, $fileName); // uploading file to given path      
                //end img version 2.0
                
                //Start img version 3.0
                $image = Input::file('form_file');
                $extension = Input::file('form_file')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).uniqid().date('Y-m-d-H-i-s').'.'.$extension; // renameing image
                //$fileName  = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/' . $fileName);
                $success=Image::make($image->getRealPath())->resize(200, 200)->save($destinationPath);
                //End img version 3.0

                if($success){
                    $table = new SimpleModel;
                    $table->name = $data->Input("form_name");
                    $table->email = $data->Input("form_email");
                    $table->password = $data->Input("form_password");
                    $table->photo = $fileName;
                    $table->save();
                    return redirect('form')->with('success','Data has been inserted successully');
                }                
            }else{
                    return redirect('form')->with('unsuccess','Fail, Try again');
            }
        }
        //print_r($table);
        //exit();
        //return Redirect::to('form');
        /*
            //For Fillable
        $input=$data->all();
        SimpleModel::create($input);*/
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
    public function edit($user_id)
    {
        $dbUpdateData = SimpleModel::findOrFail($user_id);
        return view('simple_project.edit')->with('dbUpdateData',$dbUpdateData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $formData, $id)
    {
            $validator = Validator::make($formData->all(), [
            'form_file' => 'required|mimes:jpg,png,jpeg|max:200',
        ]);
        
        if ($validator->fails()) {
            return redirect('edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }else{

                //Start img version 3.0
                $image = Input::file('form_file');
                $extension = Input::file('form_file')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).uniqid().date('Y-m-d-H-i-s').'.'.$extension; // renameing image
                //$fileName  = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/' . $fileName);
                $success=Image::make($image->getRealPath())->resize(200, 200)->save($destinationPath);
                //End img version 3.0
           
            if($success){
                $table = SimpleModel::findOrFail($id);
                $table=[
                    'name'       => $formData->Input("form_name"),
                    'email'      => $formData->Input("form_email"),
                    'password'   => $formData->Input("form_password"),
                    'photo'      => $fileName,
                ];
                SimpleModel::where('user_id', $id)->update($table);
                return redirect('showalldata')->with('updated','Data has been updated successully');
                
                }
            }
        /*
        $inputData=$request->all();
        $table=SimpleModel::findOrfail($user_id);
        $table->update($inputData);
        return redirect('Success');*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table=SimpleModel::find($id);
        $table->delete();
        return redirect('showalldata');
    }
}
