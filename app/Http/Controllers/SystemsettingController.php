<?php

namespace App\Http\Controllers;

use App\Models\systemsetting;
use Illuminate\Http\Request;

class SystemsettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('permission:systemsetting-list', ['only' => ['index','show']]);
    //     $this->middleware('permission:systemsetting-edit', ['only' => ['edit','update']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systemsettings = systemsetting::latest()->get();
        return view('systemsettings.index', compact('systemsettings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'phone' => 'nullable|max:30',
            'mobile' => 'required|max:30',
            'address1' => 'nullable|max:255',
            'address2' => 'nullable|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'favicon' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'facebook_url' => 'required|url|max:255',
            'twitter_url' => 'required|url|max:255',
            'linkedin_url' => 'required|url|max:255',
            'instagram_url' => 'required|url|max:255',
            'stripe_publish_key' => 'required',
            'stripe_secret_key' => 'required',
        ]);
        Systemsetting::create($request->all());

        return redirect()->route('systemsettings.index')
                        ->with('success', 'Systemsetting created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Systemsetting  $systemsetting
     * @return \Illuminate\Http\Response
     */
    public function show(Systemsetting $systemsetting)
    {
        return view('systemsettings.show', compact('systemsetting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Systemsetting  $systemsetting
     * @return \Illuminate\Http\Response
     */
    public function edit(Systemsetting $systemsetting)
    {
        return view('systemsettings.edit', compact('systemsetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Systemsetting  $systemsetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Systemsetting $systemsetting)
    {
        request()->validate([
           'name' => 'required|max:100',
           'email' => 'required|max:100',
           'phone' => 'nullable|max:30',
           'mobile' => 'required|max:30',
           'address1' => 'nullable|max:255',
           'address2' => 'nullable|max:255',
           'facebook_url' => 'required|url|max:255',
           'twitter_url' => 'required|url|max:255',
           'linkedin_url' => 'required|url|max:255',
           'instagram_url' => 'required|url|max:255',
        ]);

        $logo_file = $request->file('logo_file');
        if ($logo_file) {
            $logo_file = $request->file('logo_file');
            $logo_filename = date('YmdHi') . "_logo".$logo_file->getClientOriginalName();
            $logo_file->move(public_path('uploads'), $logo_filename);
            $request['logo'] = $logo_filename;
            if ($request['old_logo_file'] != '' && $request['logo'] != $request['old_logo_file']) {
                if (File::exists(public_path('uploads/'.$request['old_logo_file']))) {
                    File::delete(public_path('uploads/'.$request['old_logo_file']));
                }
            }
        }

        $favicon_file = $request->file('favicon_file');
        if ($favicon_file) {
            $favicon_file = $request->file('favicon_file');
            $favicon_filename = date('YmdHi') . "_favicon".$favicon_file->getClientOriginalName();
            $favicon_file->move(public_path('uploads'), $favicon_filename);
            $request['favicon'] = $favicon_filename;
            if ($request['old_favicon_file'] != '' && $request['favicon'] != $request['old_favicon_file']) {
                if (File::exists(public_path('uploads/'.$request['old_favicon_file']))) {
                    File::delete(public_path('uploads/'.$request['old_favicon_file']));
                }
            }
        }

        $systemsetting->update($request->all());
        return redirect()->route('systemsettings.index')
                        ->with('success', 'Systemsetting updated successfully');
    }

    public function allsystemsettings(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
        );

        $totalData = Systemsetting::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $settings = Systemsetting::offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
        } else {
            $search = $request->input('search.value');

            $settings =  Systemsetting::where('id', 'LIKE', "%{$search}%")
                        ->orWhere('name', 'LIKE', "%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();

            $totalFiltered = Systemsetting::where('id', 'LIKE', "%{$search}%")
                             ->orWhere('name', 'LIKE', "%{$search}%")
                             ->count();
        }

        $data = array();
        if (!empty($settings)) {
            foreach ($settings as $setting) {
                $show =  route('systemsettings.show', $setting->id);
                $edit =  route('systemsettings.edit', $setting->id);

                $nestedData['id'] = $setting->id;
                $nestedData['name'] = $setting->name;

                $nestedData['options'] = '';
                if (auth()->user()->can('systemsetting-edit')) {
                    $nestedData['options'] .= "&nbsp;<a href='{$edit}' title='EDIT' class='btn btn-primary btn-sm'><span class='fa fa-edit'></span></a>";
                }

                $data[] = $nestedData;
            }
        }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);
    }
}
