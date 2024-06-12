<?php

namespace App\Http\Controllers\V1;

use App\Filters\V1\GalleriesFilter;
use App\Http\Controllers\Controller;

use App\Http\Resources\V1\GalleryResource;
use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Http\Resources\V1\GalleryCollection;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new GalleriesFilter();
        [$sort, $queryItems] = $filter->transform($request);

        $galleries = Gallery::where($queryItems);
        
        return new GalleryCollection($galleries->paginate()->withQueryString());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request)
    {
        $gallery = Gallery::create($request->all());
        return new GalleryResource($gallery);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}