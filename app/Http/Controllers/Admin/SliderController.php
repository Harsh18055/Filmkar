<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class SliderController extends Controller
{
     public function slider()
    {
        $sliders = slider::all();
        return view('admin/slider');
    }
    
   
 
 

public function store(Request $request)
{
    $slider = slider::find(36);
  
    //Talent
    if ($request->hasFile('talent')) {
        
        // $talentFile = $request->file('talent');
        // $sliderFileName = time() . '_' . $talentFile->getClientOriginalName();
        // $talentFile->move(public_path('assets/slider/talent'), $sliderFileName);
        
        $x=1;
        $file=$request->file('talent');
        $sliderFileName=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        $img=\Image::make($file);
        $filePath = public_path('assets/slider/talent/' . $sliderFileName);
        $img->save($filePath, 30);
    }
    else{
         $sliderFileName = $slider->talent;
    }
    
    // Job
     if ($request->hasFile('job')) {
         
        //  $jobFile = $request->file('job');
        // $job = time() . '_' . $jobFile->getClientOriginalName();
        // $jobFile->move(public_path('assets/slider/job'), $job);
        
        $x=1;
        $file=$request->file('job');
        $job=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        $img=\Image::make($file);
        $filePath = public_path('assets/slider/job/' . $job);
        $img->save($filePath, 30);
        
    }else{
         $job = $slider->job;
    }
    
    // Event
     if ($request->hasFile('event')) {
        // $eventFile = $request->file('event');
        // $event = time() . '_' . $eventFile->getClientOriginalName();
        // $eventFile->move(public_path('assets/slider/event'), $event);
        
        $x=1;
        $file=$request->file('event');
        $event=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        $img=\Image::make($file);
        $filePath = public_path('assets/slider/event/' . $event);
        $img->save($filePath, 30);
    }else{
         $event = $slider->event;
    }
    
    // Moive
     if ($request->hasFile('moive')) {
        // $moiveFile = $request->file('moive');
        // $moive = time() . '_' . $moiveFile->getClientOriginalName();
        // $moiveFile->move(public_path('assets/slider/moive'), $moive);
        
         
        $x=1;
        $file=$request->file('moive');
        $moive=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        $img=\Image::make($file);
        $filePath = public_path('assets/slider/moive/' . $moive);
        $img->save($filePath, 30);
    }else{
         $moive = $slider->moive;
    }
    
    // Organisation
     if ($request->hasFile('organisation')) {
        // $organisationFile = $request->file('organisation');
        // $organisation = time() . '_' . $organisationFile->getClientOriginalName();
        // $organisationFile->move(public_path('assets/slider/organisation'), $organisation);
        
        $x=1;
        $file=$request->file('organisation');
        $organisation=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        $img=\Image::make($file);
        $filePath = public_path('assets/slider/organisation/' . $organisation);
        $img->save($filePath, 30);
    }else{
         $organisation = $slider->organisation;
    }

    $slider->talent = $sliderFileName;
    $slider->job = $job;
    $slider->event = $event;
    $slider->moive = $moive;
    $slider->organisation = $organisation;

    $slider->save();

    return redirect()->route('slider')->with('success', 'Slider image uploaded successfully!');
}

}
