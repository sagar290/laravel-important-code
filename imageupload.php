<?php  
use DB;
use File;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class imageUploadController extends Controller
{

/*                  
	<input type="file" name="publicationAttach[]" />
	<input type="file" name="publicationAttach[]" />
	<input type="file" name="publicationAttach[]" />
*/

public function multipleImageUpload() {


			$attach_array = $request->file('publicationAttach');
			            $countattcah = count($attach_array);
			            $attach = [];
			            for ($i=0; $i < $countattcah ; $i++) { 
			                
			                // $code = str_random(5);
			                // $uniqName = md5($attach_array[$i]->getClientOriginalName());
			                // $temp_name = str_replace(' ','',$uniqName);
			                $attachName = str_random(10);
			                $attachExt = $attach_array[$i]->getClientOriginalExtension();
			                $fileWithExt = $attachName.'.'.$attachExt;
			                $attach[] = [
			                    'attachment_name' => $attachName,
			                    'attachment_type' => $attachExt,
			                    'attachment_url' => 'uploads/materials/'.$fileWithExt,
			                    'publication_id' => $publicationId,
			                    'created_by' => 1,
			                    'updated_by' => 1
			                ];

			                $success = $attach_array[$i]->move('uploads/publication',$fileWithExt);

			            }
    }
/*                  
	<input type="file" name="material" />
*/
    public function singleImageUpload() {

    	$material = $request->file('material');
            //Retriving File Size
            $bytes = File::size($material);
            $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
            for ($i = 0; $bytes > 1024; $i++) {
                $bytes /= 1024;
            }
            $material_size = round($bytes, 2) . ' ' . $units[$i];
            $material_original_extension = $material->getClientOriginalExtension();
            $new_material_name = $material_name.'.'.$material_original_extension;
            $success = $material->move('uploads/materials',$new_material_name);
    }        

}