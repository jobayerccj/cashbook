<?php 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\UserRole;
use Illuminate\Support\Facades\DB;

/**
     * This function has been used to upload an image
     * @param string $request(form's fields for validation)
     * @param string $filename
     * @param string $destinationPath
     * @param integer $max_size
     * @return string json_encoded result
     * @author Jobayer Islam
     */
function upload($request, $filename = 'myfile', $all_type= false, $file_type='image|mimes:jpeg,bmp,png,jpg', $destinationPath = 'uploads/_temp', $max_size="5000") {

    if(!$all_type){
        $v = Validator::make($request, [
            $filename => "$file_type|max:$max_size"
        ]);
    }
    
    if (isset($v) && $v->fails())
    {   
        $response=[
                'error'=>true,
                'success'=>false,
                'errorMessage'=>$v->errors(),
                'fileName'=>''
            ];
            
        echo json_encode($response);
    }
    else{
            if (Input::file($filename)->isValid()) {
            $user = Auth::user();
            
            $extension = Input::file($filename)->getClientOriginalExtension(); // getting image extension
            $fileName = $user->id.'-'.time(). '-' .uniqid() . '.' . $extension; // renameing image
            Input::file($filename)->move($destinationPath, $fileName); // uploading file to given path
            $response=[
                'error'=>false,
                'success'=>true,
                'errorMessage'=>'',
                'fileName'=>$fileName
            ];
            
            echo json_encode($response);
        } else {
            $response=[
                'error'=>true,
                'success'=>false,
                'errorMessage'=>getErrorMessage(),
                'fileName'=>''
            ];
            echo json_encode($response);
        }

        
    }  
}


?>