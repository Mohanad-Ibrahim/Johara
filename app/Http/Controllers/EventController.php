<?php

namespace App\Http\Controllers;

use App\Models\Blog\Event;
use App\Models\Projects\Project;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('created_at', 'DESC')->limit(5)->get();

        $remainingCount = 5 - $events->count();

        $projects = collect();
        if ($remainingCount > 0) {
            $projects = Project::inRandomOrder()
                ->select('id', 'name', 'location', 'main_description', 'date', 'mainImage')
                ->limit($remainingCount)
                ->get();
        }

        $formattedEvents = $events->map(fn($event) => [
            'id' => $event->id,
            'type' => 'event',
            'location' => $event->location,
            'description' => $event->description,
            'date' => $event->date,
            'image' => $event->image_url,
        ]);

        $formattedProjects = $projects->map(fn($project) => [
            'id' => $project->id,
            'type' => 'project',
            'name' => $project->name,
            'location' => $project->location,
            'description' => $project->main_description,
            'date' => $project->date,
            'image' => $project->mainImage_url,
        ]);

        $combined = $formattedEvents->merge($formattedProjects);

        return response()->json([
            'success' => true,
            'message' => 'Latest 5 items (Events supplemented by Projects)',
            'data' => $combined,
        ]);
    }
}
