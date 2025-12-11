<?php

namespace App\Http\Controllers;

use App\Models\Blog\Event;
use App\Models\Projects\Project;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
                  $events = Event::orderBy('created_at','DESC')->limit(5)->get();
            if(!$events){
                return response()->json([
                    'success' => false,
                    'message' => 'No Events Found',
                ]);
            }
            $events = $events->map(function($event){
                return [

                    'id' => $event->id,
                    'location' => $event->location,
                    'date' => $event->date,
                    'description' => $event->description,
                    'image' => $event->image_url,

                ];
            });



//        $projects = Project::inRandomOrder()
//            ->select('id', 'name', 'location','main_description', 'date', 'mainImage')
//            ->limit(5)
//            ->get();
//        $projects = $projects->map(function($project){
//            return [
//                'id' => $project->id,
//                'name' => $project->name,
//                'location' => $project->location,
//                'main_description' => $project->main_description,
//                'date' => $project->date,
//                'mainImage' => $project->mainImage_url,
//            ];
//        });
        return response()->json([
                'success' => true,
                'event' => $events,
//                'projects' => $projects,
            ]);



    }
}
