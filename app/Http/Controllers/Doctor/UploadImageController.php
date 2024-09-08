<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload;
use App\Models\Image;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    use Upload;
    public function index()
    {

        return view("doctor.upload.index");
    }

    public function upload(Request $request)
    {




        $data = []; // Initialize the $data array

        $Image = Image::first();


        if ($request->hasFile('front_banner_image')) {
            $data['front_banner_image'] = $this->Action($request,'front_banner_image',$Image ? $Image->front_banner_image : NULL);
        }
        if ($request->hasFile('front_image_one')) {
            $data['front_image_one'] = $this->Action($request,'front_image_one',$Image ? $Image->front_image_one : NULL);
        }
        if ($request->hasFile('front_image_two')) {
            $data['front_image_two'] = $this->Action($request,'front_image_two',$Image ? $Image->front_image_two : NULL);
        }
        if ($request->hasFile('employee_image_lg')) {
            $data['employee_image_lg'] = $this->Action($request,'employee_image_lg',$Image ? $Image->employee_image_lg : NULL);
        }
        if ($request->hasFile('employee_image_sm')) {
            $data['employee_image_sm'] = $this->Action($request,'employee_image_sm',$Image ? $Image->employee_image_sm : NULL);
        }

        // Use updateOrCreate to update the existing record or create a new one if it doesn't exist
        Image::updateOrCreate(
            ['id' => 1], // Conditions to find the record
            $data       // Data to update or create the record with
        );

        return redirect()->back()->with('Success', 'تم رفع الصور بنجاح');
    }

    private function Action(Request $request,$input,$image)
    {
        // Check if there's an existing image and if the file exists
        if ($image && file_exists(public_path('storage/' . $image))) {

            unlink(public_path('storage/' . $image));
        }
        // Upload the new image
        return  $this->uploadImage($request, $input, 'uploads/images');
    }

    public function destory($name)
    {
        $Image = Image::first();
      if($name == 'front_banner_image')
      {
        if(file_exists(public_path('storage/' . $Image->front_banner_image))) {

            unlink(public_path('storage/' . $Image->front_banner_image));
        }
       $Image->update([
        'front_banner_image' => NULL
       ]);
    
      }
      if($name == 'front_image_one')
      {
        if(file_exists(public_path('storage/' . $Image->front_image_one))) {

            unlink(public_path('storage/' . $Image->front_image_one));
        }
       $Image->update([
        'front_image_one' => NULL
       ]);
    
      }
      if($name == 'front_image_two')
      {
        if(file_exists(public_path('storage/' . $Image->front_image_two))) {

            unlink(public_path('storage/' . $Image->front_image_two));
        }
       $Image->update([
        'front_image_two' => NULL
       ]);
    
      }
      if($name == 'employee_image_lg')
      {
        if(file_exists(public_path('storage/' . $Image->employee_image_lg))) {

            unlink(public_path('storage/' . $Image->employee_image_lg));
        }
       $Image->update([
        'employee_image_lg' => NULL
       ]);
    
      }
      if($name == 'employee_image_sm')
      {
        if(file_exists(public_path('storage/' . $Image->employee_image_sm))) {

            unlink(public_path('storage/' . $Image->employee_image_sm));
        }
       $Image->update([
        'employee_image_sm' => NULL
       ]);
    
      }

      return redirect()->back();
     

    }   
}
